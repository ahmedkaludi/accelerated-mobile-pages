<?php

require_once( AMP__DIR__ . '/includes/sanitizers/class-amp-base-sanitizer.php' );
require_once( AMP__DIR__ . '/includes/utils/class-amp-image-dimension-extractor.php' );

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
				if ( ! $node->hasAttribute( 'src' ) || '' === $node->getAttribute( 'src' ) ) {
					$node->setAttribute( 'src', $image_scr_from_data_src );
				}
			}

			if ( ! $node->hasAttribute( 'src' ) || '' === $node->getAttribute( 'src' ) ) {
				$node->parentNode->removeChild( $node );
				continue;
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
				if ( ! $node instanceof DOMElement ) {
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
					$width = $dimensions['width'];
				}
				if ( isset( $dimensions['height'] ) ) {
					$height = $dimensions['height'];
				}
				if ( ! is_numeric( $node->getAttribute( 'width' ) ) ) {
					// Let width have the right aspect ratio based on the height attribute.
					if ( is_numeric( $node->getAttribute( 'height' ) ) && isset( $dimensions['height'] ) && isset( $dimensions['width'] ) ) {
						$width = round( ( floatval( $node->getAttribute( 'height' ) ) * $dimensions['width'] ) / $dimensions['height'] );
					}
					$node->setAttribute( 'width', $width );
					if ( ! isset( $dimensions['width'] ) ) {
						$class .= ' amp-wp-unknown-width';
					}
				}
				if ( ! is_numeric( $node->getAttribute( 'height' ) ) ) {
					// Let height have the right aspect ratio based on the width attribute.
					if ( is_numeric( $node->getAttribute( 'width' ) ) && isset( $dimensions['width'] ) && isset( $dimensions['height'] ) ) {
						$height = round( ( floatval( $node->getAttribute( 'width' ) ) * $dimensions['height'] ) / $dimensions['width'] );
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
		if ( $this->is_lightbox ) {
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
				case 'class':
				case 'srcset':
				case 'sizes':
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
