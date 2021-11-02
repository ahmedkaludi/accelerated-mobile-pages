<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( AMP__VENDOR__DIR__ . '/includes/sanitizers/class-amp-base-sanitizer.php' );
require_once( AMP__VENDOR__DIR__ . '/includes/utils/class-amp-image-dimension-extractor.php' );

/**
 * Converts <img> tags to <amp-img> or <amp-anim>
 */
class AMP_Img_Sanitizer extends AMP_Base_Sanitizer {
	const FALLBACK_WIDTH = 600;
	const FALLBACK_HEIGHT = 400;

	protected $is_lightbox = false;

	protected $scripts = array();

	public static $tag = 'img';

	private static $anim_extension = '.gif';

	private static $script_slug = 'amp-anim';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-anim-0.1.js';
	
	private static $script_slug_lightbox = 'amp-image-lightbox';
	private static $script_src_lightbox = 'https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js';

	public function sanitize() {

		$nodes = $this->dom->getElementsByTagName( self::$tag );
		$need_dimensions = array();

		$num_nodes = $nodes->length;

		if ( 0 === $num_nodes ) {
			return;
		}

		for ( $i = $num_nodes - 1; $i >= 0; $i-- ) {
			$node = $nodes->item( $i );

			// Add Foo Gallery Support
			if ( $node->hasAttribute( 'data-src-fg' ) ) {
				$image_scr_from_data_src   = $node->getAttribute( 'data-src-fg' ) ;
				if ( ! $node->hasAttribute( 'src' ) || '' === $node->getAttribute( 'src' ) || strpos($node->getAttribute( 'src' ), 'data:image') !== false ) {
					$node->setAttribute( 'src', $image_scr_from_data_src );
				}
			}

			if ( ! $node->hasAttribute( 'src' ) || '' === $node->getAttribute( 'src' ) ) {
				$node->parentNode->removeChild( $node );
				continue;
			}
			if ( ! is_numeric( $node->getAttribute( 'srcset' ) ) && true == ampforwp_get_setting('ampforwp-amp-img-lightbox')) {
				if(!$node->getAttribute( 'srcset' )){
					$image_src = $node->getAttribute( 'src' );
					preg_match('/(.*-(\d{3}x\d{3}.))/', $image_src , $image_src_matches);
					if($image_src_matches){
					 	$img_name = explode('/',$image_src);
					    $img_name = end($img_name);
					    $img_croped = explode('-',$img_name);
					    $img_croped = end($img_croped);
					    $img_ext = wp_check_filetype($image_src);
					    $img_ext = $img_ext['ext'];
					    $new_img_url = str_replace("-$img_croped",".$img_ext",$image_src);
					    if ( $new_img_url ) {
					    	$node->setAttribute( 'srcset', esc_url($new_img_url) );
					    }
					}
				}
			}

			if( $node->getAttribute( 'src' )){
				if (strpos($node->getAttribute( 'src' ), '../wp-content') !== false) {
				    $site_url = content_url();
				    $image_complete_src = str_replace('../wp-content', $site_url, $node->getAttribute( 'src' ));
				    $node->setAttribute('src',$image_complete_src);
				}
			}
			
			// Determine which images need their dimensions determined/extracted.
			if ( ! is_numeric( $node->getAttribute( 'width' ) ) || ! is_numeric( $node->getAttribute( 'height' ) ) ) {
				$need_dimensions[ $node->getAttribute( 'src' ) ][] = $node;
			} else {
				$this->adjust_and_replace_node( $node );
			}
		}

		$this->determine_dimensions( $need_dimensions );
		$this->adjust_and_replace_nodes_in_array_map( $need_dimensions );
	}

	/**
	 * Figure out width and height attribute values for images that don't have them by
	 * attempting to determine actual dimensions and setting reasonable defaults otherwise.
	 *
	 * @param array $need_dimensions List of Img src url to node mappings corresponding to images that need dimensions.
	 */
	private function determine_dimensions( $need_dimensions ) {

		$dimensions_by_url = AMP_Image_Dimension_Extractor::extract( array_keys( $need_dimensions ) );
		$class = "";

		foreach ( $dimensions_by_url as $url => $dimensions ) {
			foreach ( $need_dimensions[ $url ] as $node ) {
				if ( ! $node instanceof \DOMElement ) {
					continue;
				}
				$class = $node->getAttribute( 'class' );
				if ( ! $class ) {
					$class = '';
				}
				if ( ! $dimensions ) {
					$class .= ' amp-wp-unknown-size';
				}

				$width  = isset( $this->args['content_max_width'] ) ? $this->args['content_max_width'] : self::FALLBACK_WIDTH;
				$height = self::FALLBACK_HEIGHT;
				if ( isset( $dimensions['width'] ) ) {
					$dimensions['width']  = (int)$dimensions['width'];
					$width = $dimensions['width'];
				}
				if ( isset( $dimensions['height'] ) ) {
					$dimensions['height']  = (int)$dimensions['height'];
					$height = $dimensions['height'];
				}

				if ( ! is_numeric( $node->getAttribute( 'width' ) ) ) {

					// Let width have the right aspect ratio based on the height attribute.
					if ( is_numeric( $node->getAttribute( 'height' ) ) && isset( $dimensions['height'] ) && 0 !== $dimensions['height'] && isset( $dimensions['width'] ) ) {
						$width = round( ( floatval( $node->getAttribute( 'height' ) ) * $dimensions['width'] ) / $dimensions['height'] );
					}
					if($width==0){
						$width = self::FALLBACK_WIDTH;
					}
					$node->setAttribute( 'width', $width );
					if ( ! isset( $dimensions['width'] ) ) {
						$class .= ' amp-wp-unknown-width';
					}
				}
				if ( ! is_numeric( $node->getAttribute( 'height' ) ) ) {

					// Let height have the right aspect ratio based on the width attribute.
					if ( is_numeric( $node->getAttribute( 'width' ) ) && isset( $dimensions['width'] ) && 0 !== $dimensions['width'] && isset( $dimensions['height'] ) ) {
						$height = round( ( floatval( $node->getAttribute( 'width' ) ) * $dimensions['height'] ) / $dimensions['width'] );
					}
					if($height==0){
						$height = self::FALLBACK_HEIGHT;
					}
					$node->setAttribute( 'height', $height );
					if ( ! isset( $dimensions['height'] ) ) {
						$class .= ' amp-wp-unknown-height';
					}
				}
				$node->setAttribute( 'class', trim( $class ) );
			}
		}
	}

	/**
	 * Make final modifications to DOMNode
	 *
	 * @param DOMNode $node The DOMNode to adjust and replace
	 */
	private function adjust_and_replace_node( $node ) {
		$old_attributes = AMP_DOM_Utils::get_node_attributes_as_assoc_array( $node );
		$old_attributes = apply_filters('amp_img_attributes', $old_attributes);
		$new_attributes = $this->filter_attributes( $old_attributes );
		$new_attributes = $this->enforce_sizes_attribute( $new_attributes );
		// Use responsive images when a theme supports wide and full-bleed images.
		if ( ! empty( $this->args['align_wide_support'] ) && $node->parentNode && 'figure' === $node->parentNode->nodeName && preg_match( '/(^|\s)(alignwide|alignfull)(\s|$)/', $node->parentNode->getAttribute( 'class' ) ) ) {
			$new_attributes['layout'] = 'responsive';
		} else {
			$new_attributes['layout'] = 'intrinsic';
		}
		// Remove sizes attribute since it causes headaches in AMP and because AMP will generate it for us. See <https://github.com/ampproject/amphtml/issues/21371>.
		unset( $new_attributes['sizes'] );
		if ( $this->is_gif_url( $new_attributes['src'] ) ) {
			$this->did_convert_elements = true;
			$new_tag = 'amp-anim';
		} else {
			$new_tag = 'amp-img';
		}
		$new_node = AMP_DOM_Utils::create_node( $this->dom, $new_tag, $new_attributes );
		$node->parentNode->replaceChild( $new_node, $node );
		
		if ( isset($new_attributes['on']) && '' != $new_attributes['on'] ) {
			if(is_singular() || ampforwp_is_front_page()){
				add_action('amp_post_template_footer', 'ampforwp_amp_img_lightbox');
			}
			$this->is_lightbox = true;
		}
	}

	/**
	 * Now that all images have width and height attributes, make final tweaks and replace original image nodes
	 *
	 * @param array $node_lists Img DOM nodes (now with width and height attributes).
	 */
	private function adjust_and_replace_nodes_in_array_map( $node_lists ) {
		foreach ( $node_lists as $node_list ) {
			foreach ( $node_list as $node ) {
				$this->adjust_and_replace_node( $node );
			}
		}
	}

	public function get_scripts() {
		if ( $this->is_lightbox && (is_singular() || ampforwp_is_front_page())) {
			$this->scripts[self::$script_slug_lightbox] = self::$script_src_lightbox;
		}


		if ( $this->did_convert_elements ) {
			$this->scripts[self::$script_slug] = self::$script_src;
		}

		return $this->scripts;
	}

	private function filter_attributes( $attributes ) {
		$out = array();

		foreach ( $attributes as $name => $value ) {
			switch ( $name ) {
				case 'src':
				case 'alt':
				case 'id':
				case 'class':
				case 'srcset':
				case 'sizes':
				case 'itemprop':
				case 'on':
				case 'role':
				case 'tabindex':
				case 'layout':
					$out[ $name ] = $value;
					break;

				case 'width':
				case 'height':
					$out[ $name ] = $this->sanitize_dimension( $value, $name );
					break;

				default;
					break;
			}
		}

		return $out;
	}

	private function is_gif_url( $url ) {
		$ext = self::$anim_extension;
		$path = AMP_WP_Utils::parse_url( $url, PHP_URL_PATH );
		return substr( $path, -strlen( $ext ) ) === $ext;
	}
}
