<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( AMP__VENDOR__DIR__ . '/includes/sanitizers/class-amp-base-sanitizer.php' );
/**
 * Class AMP_Gallery_Block_Sanitizer.
 *
 */

/**
 * Class AMP_Gallery_Block_Sanitizer
 *
 * Modifies gallery block to match the block's AMP-specific configuration.
 */
class AMP_Gallery_Block_Sanitizer extends AMP_Base_Sanitizer {

	/**
	 * Value used for width of amp-carousel.
	 *
	 * @since 1.0
	 *
	 * @const int
	 */
	const FALLBACK_WIDTH = 600;

	/**
	 * Value used for height of amp-carousel.
	 *
	 * @since 1.0
	 *
	 * @const int
	 */
	const FALLBACK_HEIGHT = 480;

	/**
	 * Tag.
	 *
	 * @var string Ul tag to identify wrapper around gallery block.
	 * @since 1.0
	 */
	public static $tag = 'ul';

	/**
	 * Array of flags used to control sanitization.
	 *
	 * @var array {
	 *      @type int  $content_max_width Max width of content.
	 *      @type bool $carousel_required Whether carousels are required. This is used when amp theme support is not present, for back-compat.
	 * }
	 */
	protected $args;

	/**
	 * Default args.
	 *
	 * @var array
	 */
	protected $DEFAULT_ARGS = array(
		'carousel_required' => true,
	);

	/**
	 * Sanitize the gallery block contained by <ul> element where necessary.
	 *
	 * @since 0.2
	 */
	public function sanitize() {
		$nodes     = $this->dom->getElementsByTagName( self::$tag );
		$num_nodes = $nodes->length;
		if ( 0 === $num_nodes ) {
			return;
		}

		for ( $i = $num_nodes - 1; $i >= 0; $i-- ) {
			$node = $nodes->item( $i );

			// We're looking for <ul> elements that at least one child.
			if ( 0 === count( $node->childNodes ) ) {
				continue;
			}

			$attributes      = AMP_DOM_Utils::get_node_attributes_as_assoc_array( $node );
			if ( !isset($attributes['class']) || ( isset($attributes['class']) && ! preg_match('/wp-block-gallery/', $attributes['class']) ) ) {
				continue;
			}
			$is_amp_lightbox = isset( $attributes['data-amp-lightbox'] ) && true === filter_var( $attributes['data-amp-lightbox'], FILTER_VALIDATE_BOOLEAN );
			$is_amp_carousel = ! empty( $this->args['carousel_required'] ) || ( isset( $attributes['data-amp-carousel'] ) && true === filter_var( $attributes['data-amp-carousel'], FILTER_VALIDATE_BOOLEAN ) );

			// We are only looking for <ul> elements which have amp-carousel / amp-lightbox true.
			if ( ! $is_amp_carousel && ! $is_amp_lightbox ) {
				continue;
			}

			// If lightbox is set, we should add lightbox feature to the gallery images.
			if ( $is_amp_lightbox ) {
				$this->add_lightbox_attributes_to_image_nodes( $node );
				$this->maybe_add_amp_image_lightbox_node();
			}

			// If amp-carousel is not set, nothing else to do here.
			if ( ! $is_amp_carousel ) {
				continue;
			}

			$images = array();
			$urls = array();
			// If it's not AMP lightbox, look for links first.
			if ( ! $is_amp_lightbox ) {
				foreach ( $node->getElementsByTagName( 'a' ) as $element ) {
					$images[] = $element;
				}
			}

			if( $node->getElementsByTagName( 'amp-anim' )){
				foreach ( $node->getElementsByTagName( 'amp-anim' ) as $element ) {
					$url = $element->getAttribute('src');
					$width = $element->getAttribute('width');
					$height = $element->getAttribute('height');
					$attachment_id = attachment_url_to_postid($url);
					if ( empty( $images ) ) {
						$images[] = $element;
					}
					$urls[] = apply_filters('amp_gallery_image_params', array(
								'url' => $url,
								'width' => $width,
								'height' => $height,
							),$attachment_id);
					
				}
			}

			$fig_item = $node->getElementsByTagName( 'figure');
			$ni =0;
			// If not linking to anything then look for <amp-img>.
			foreach ( $node->getElementsByTagName( 'amp-img' ) as $element ) {
				$caption = $fig_item->item($ni)->nodeValue;
				$ni++;
				$url = $element->getAttribute('src');
				$width = $element->getAttribute('width');
				$height = $element->getAttribute('height');
				if ( empty( $images ) ) {
					$images[] = $element;
				}
				$urls[] =  array(
								'url' => $url,
								'width' => $width,
								'height' => $height,
								'caption' => $caption
							);
			}

			// Skip if no images found.
			if ( empty( $images ) ) {
				continue;
			}
			$amp_carousel_node = $this->render( array(
								'images' => $urls,
							), $node );

			$node->parentNode->replaceChild( $amp_carousel_node, $node );
		}
		$this->did_convert_elements = true;
	}

	/**
	 * Get carousel height by containing images.
	 *
	 * @param DOMElement $element The UL element.
	 * @return int Height.
	 */
	protected function get_carousel_height( $element ) {
		$images     = $element->getElementsByTagName( 'amp-img' );
		$num_images = $images->length;
		$max_height = 0;
		$max_width  = 0;
		if ( 0 === $num_images ) {
			return self::FALLBACK_HEIGHT;
		}
		foreach ( $images as $image ) {
			/**
			 * Image.
			 *
			 * @var DOMElement $image
			 */
			$image_height = $image->getAttribute( 'height' );
			if ( is_numeric( $image_height ) ) {
				$max_height = max( $max_height, $image_height );
			}
			$image_width = $image->getAttribute( 'height' );
			if ( is_numeric( $image_width ) ) {
				$max_width = max( $max_width, $image_width );
			}
		}

		if ( ! empty( $this->args['content_max_width'] ) && $max_height > 0 && $max_width > $this->args['content_max_width'] ) {
			$max_height = ( $max_width * $this->args['content_max_width'] ) / $max_height;
		}

		return ! $max_height ? self::FALLBACK_HEIGHT : $max_height;
	}

	/**
	 * Set lightbox related attributes to <amp-img> within gallery.
	 *
	 * @param DOMElement $element The UL element.
	 */
	protected function add_lightbox_attributes_to_image_nodes( $element ) {
		$images     = $element->getElementsByTagName( 'amp-img' );
		$num_images = $images->length;
		if ( 0 === $num_images ) {
			return;
		}
		$attributes = array(
			'data-amp-lightbox' => '',
			'on'                => 'tap:' . self::AMP_IMAGE_LIGHTBOX_ID,
			'role'              => 'button',
			'tabindex'          => 0,
		);

		for ( $j = $num_images - 1; $j >= 0; $j-- ) {
			$image_node = $images->item( $j );
			foreach ( $attributes as $att => $value ) {
				$image_node->setAttribute( $att, $value );
			}
		}
	}

	public function render( $args, $node ) {
		global $redux_builder_amp,$carousel_styling;
		$this->did_convert_elements = true;
		
		$args = wp_parse_args( $args, array(
			'images' => false,
		) );
		
		if ( empty( $args['images'] ) ) {
			return '';
		}

		/*Filter*/
		$carousel_markup = $amp_image_lightbox = '';
		$carousel_styling = '';
		//Default markup
		$markup = 1;
		if ( ampforwp_get_setting('ampforwp-gallery-design-type') ) {
			$markup = ampforwp_get_setting('ampforwp-gallery-design-type');
		}

		$amp_images = array();
		foreach ( $args['images'] as $key => $image ) {
			$amp_img_arr = array(
					'src' => $image['url'],
					'width' => $image['width'],
					'height' => $image['height'],
					'caption' => $image['caption'],
					'layout' => 'fill',
					'class'  => 'amp-carousel-img',
				);
			if( 3 == ampforwp_get_setting('ampforwp-gallery-design-type') || true == ampforwp_get_setting('ampforwp-gallery-lightbox') ){
				$design3_additional_attr = array('on'=> 'tap:gallery-lightbox', 'role'=>'button', 
                	'tabindex'=>$key);
				$amp_img_arr = array_merge($amp_img_arr, $design3_additional_attr);
				$amp_image_lightbox = true;
			}
			$amp_image_node = AMP_DOM_Utils::create_node( $this->dom, 'amp-img', $amp_img_arr );
			$amp_images[$key] = $amp_image_node;
			if ( 3 != ampforwp_get_setting('ampforwp-gallery-design-type') ) {
				$image_div = AMP_DOM_Utils::create_node( $this->dom, 'div', array('class'=>'ampforwp-gallery-item amp-carousel-container') );
			 	$image_div->appendChild($amp_image_node);
				if ( isset($image['caption']) ) {
					$figure_node = AMP_DOM_Utils::create_node($this->dom, 'figure', array());
					$fig_caption = AMP_DOM_Utils::create_node($this->dom, 'figcaption', array('on'=>"tap:AMP.setState({expanded: !expanded})",'tabindex'=>0,'role'=>'button'));
					$fig_caption->nodeValue = $image['caption'];
					$figure_node->appendChild($image_div);
					$figure_node->appendChild($fig_caption);
					$amp_images[$key] = $figure_node;
				}
				else
					$amp_images[$key] = $image_div;
			}

			if ( 2 == ampforwp_get_setting('ampforwp-gallery-design-type') ) {
				//Small Thumbnail Images
				$thumb_url = ampforwp_aq_resize( $image['url'], 120, 60, true, false ); //resize & crop the image
	           if($thumb_url!=false){
					$smallimage   =  $thumb_url[0];
					$smallwidth   =  $thumb_url[1];
					$smallheight  =  $thumb_url[2];
	            }else{
	            	$smallimage  = $image['url'];
	            	$smallwidth = $image['width'];
	            	$smallheight = $image['height'];
	            }

	            $amp_images_small[$key] = AMP_DOM_Utils::create_node(
	            							$this->dom, 
	            							'amp-img', 
	            							array(
												'src' => $smallimage,
												'width' => $smallwidth,
												'height' =>  $smallheight,
												'layout' => 'fill',
												'class'  => 'amp-carousel-img',
											)
            							);

			}
			
		}// foreach Closed

		//replacements
		$r = rand(1,100);
		if ( 3 != ampforwp_get_setting('ampforwp-gallery-design-type') ){
			$carousel_args = array(
									'width' => 600,
									'height' => 480,
									'type' => 'slides',
									'layout' => 'responsive',
									'class'  => 'collapsible-captions',
									'id' => 'carousel-with-carousel-preview-'.$r
								);
			$c_args = array('loop'=>'', 'autoplay'=>'');
			$carousel_filter = apply_filters('ampforwp_carousel_args',$c_args);
			$carousel_args = array_merge($carousel_args,$carousel_filter);

			$amp_carousel = AMP_DOM_Utils::create_node($this->dom, 
								'amp-carousel',	
								$carousel_args
							);
			foreach ($amp_images as $amp_image) {				
				$amp_carousel->appendChild( $amp_image );
			}
		}

		if ( 2 == ampforwp_get_setting('ampforwp-gallery-design-type') ) {
			$carousel_args = array(
									'width' => 'auto',
									'height' => 48,
									'type' => 'carousel',
									'layout' => 'fixed-height',
									'class'  => 'carousel-preview'
								);
			$c_args = array('loop'=>'', 'autoplay'=>'');
			$carousel_filter = apply_filters('ampforwp_carousel_args',$c_args);
			$carousel_args = array_merge($carousel_args,$carousel_filter);
			$button_nodes = array();
			$amp_carousel_thumbnail = AMP_DOM_Utils::create_node(
								$this->dom, 
								'amp-carousel',
								$carousel_args
							);
			foreach ($amp_images_small as $key => $value) {
				$button_node = AMP_DOM_Utils::create_node(
									$this->dom, 
									'button',
									array(
										'on'=>'tap:carousel-with-carousel-preview-'.$r.'.goToSlide(index='.$key.')',
										'class'=>'amp-carousel-slide amp-scrollable-carousel-slide')
								);
				$button_node->appendChild($value);
				$amp_carousel_thumbnail->appendChild($button_node);
			}
			$node->parentNode->insertBefore($amp_carousel_thumbnail,$node->nextSibling);
			add_action('amp_post_template_css', 'AMPforWP\\AMPVendor\\ampforwp_gal_des_2');
		}

		elseif ( 3 == ampforwp_get_setting('ampforwp-gallery-design-type') ) {
			$gal_div = AMP_DOM_Utils::create_node($this->dom, 'div', array('class'=>'gal_w') );
			$i = 0;
			foreach ($amp_images as $amp_image) {
				$figure_node = AMP_DOM_Utils::create_node($this->dom, 'figure', array('class'=>'ampforwp-gallery-item amp-carousel-containerd3'));
				$figure_node->appendChild($amp_image);
				$fig_caption = AMP_DOM_Utils::create_node($this->dom, 'figcaption', array());
				$fig_caption->nodeValue = $args['images'][$i]['caption'];
				$figure_node->appendChild($fig_caption);
				$gal_div->appendChild( $figure_node );
				$i++;	
			}
			$amp_carousel = $gal_div;
			add_action('amp_post_template_css', 'AMPforWP\\AMPVendor\\ampforwp_gal_des_3');
		}
		if ( $amp_image_lightbox ) {
			add_action('ampforwp_after_post_content', 'AMPforWP\\AMPVendor\\ampforwp_gallery_lightbox');
		}
		if($markup == 1){
			add_action('amp_post_template_css', 'AMPforWP\\AMPVendor\\ampforwp_gal_des_1');
		}
		add_filter('amp_post_template_data','ampforwp_carousel_bind_script');
		add_action('amp_post_template_css', 'ampforwp_additional_style_carousel_caption');
		return $amp_carousel;
	}
}

function ampforwp_gal_des_1(){
	echo '.cls-btn{background:#0d0d0d;border:none;position: absolute;right: 10px;}.cls-btn:after{content:"X";display:inline-block;color:#fff;font-size:20px;padding:20px;}';
}

function ampforwp_gal_des_2(){
	echo ".carousel-preview button{padding:0;}.carousel-preview amp-img{height:40px;width:60px;position:relative;}.carousel-preview {width: 100%;display: inline-block;text-align: center;margin: 20px 0px;}.cls-btn{background:#0d0d0d;border:none;position: absolute;right: 10px;}.cls-btn:after{content:\"X\";display:inline-block;color:#fff;font-size:20px;padding:20px;}";
}
function ampforwp_gal_des_3(){
	echo '.gal_w{display:inline-block;width:100%}.gal_w amp-img{background:#f1f1f1;height:134px;width:150px;position: relative;float:left;margin:10px;}.cls-btn{background:#0d0d0d;border:none;position: absolute;right: 10px;}.cls-btn:after{content:"X";display:inline-block;color:#fff;font-size:20px;padding:20px;}';
}
function ampforwp_gallery_lightbox(){
	$amp_image_lightbox = '';
	$amp_image_lightbox = '<amp-image-lightbox id="gallery-lightbox" layout="nodisplay">
					      <div on="tap:gallery-lightbox.close" role="button"
					          tabindex="0">
					          <button class="cls-btn" on="tap:gallery-lightbox.close"
					            role="button" tabindex="0"></button>
					      </div>
					    </amp-image-lightbox>';
	echo $amp_image_lightbox; // nothing to escaped
}