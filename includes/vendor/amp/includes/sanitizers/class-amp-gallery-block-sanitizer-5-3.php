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
	 * Expected class of the wrapper around the gallery block.
	 *
	 * @since 1.0
	 *
	 * @var string
	 */
	public static $class = 'wp-block-gallery';
	/**
	 * Sanitize the gallery block contained by <ul> element where necessary.
	 *
	 * @since 0.2
	 */
	public function sanitize() {
		$xpath       = new \DOMXPath( $this->dom );
		$class_query = 'contains( concat( " ", normalize-space( @class ), " " ), " wp-block-gallery " )';
		$expr        = sprintf(
			'//ul[ %s ]',
			implode(
				' or ',
				[
					sprintf( '( parent::figure[ %s ] )', $class_query ),
					$class_query,
				]
			)
		);
		$query       = $xpath->query( $expr );
		foreach ( $query as $node ) {
			/**
			 * Element
			 *
			 * @var DOMElement $node
			 */
			// In WordPress 5.3, the Gallery block's <ul> is wrapped in a <figure class="wp-block-gallery">, so look for that node also.
			$gallery_node = isset( $node->parentNode ) && AMP_DOM_Utils::has_class( $node->parentNode, self::$class ) ? $node->parentNode : $node;
			$attributes   = AMP_DOM_Utils::get_node_attributes_as_assoc_array( $gallery_node );
			$is_amp_lightbox = isset( $attributes['data-amp-lightbox'] ) && true === filter_var( $attributes['data-amp-lightbox'], FILTER_VALIDATE_BOOLEAN );
			$is_amp_carousel = (
				! empty( $this->args['carousel_required'] )
				||
				filter_var( $node->getAttribute( 'data-amp-carousel' ), FILTER_VALIDATE_BOOLEAN )
				||
				filter_var( $node->parentNode->getAttribute( 'data-amp-carousel' ), FILTER_VALIDATE_BOOLEAN )
			);
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
			$images = [];
			// If not linking to anything then look for <amp-img>.
			if ( empty( $images ) ) {
				foreach ( $node->getElementsByTagName( 'amp-img' ) as $element ) {
					$images[] = $element;
				}
			}
			// Skip if no images found.
			if ( empty( $images ) ) {
				continue;
			}
			list( $width, $height ) = $this->get_carousel_dimensions( $node );
			$amp_carousel = AMP_DOM_Utils::create_node(
				$this->dom,
				'amp-carousel',
				[
					'width'  => $width,
					'height' => $height,
					'type'   => 'slides',
					'layout' => 'responsive',
				]
			);
			$urls = array();
			foreach ( $images as $element ) {
				$possible_caption_text = $this->possibly_get_caption_text( $element );
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
					'caption' => $possible_caption_text
				);
			}
			if ( empty( $images ) ) {
				continue;
			}
			$amp_carousel_node = $this->render( array(
				'images' => $urls,
			), $gallery_node );
			$gallery_node->parentNode->replaceChild( $amp_carousel_node, $gallery_node );
		}
		$this->did_convert_elements = true;
	}
	/**
	 * Gets the caption of an image, if it exists.
	 *
	 * @param DOMElement $element The element for which to search for a caption.
	 * @return string|null The caption for the image, or null.
	 */
	public function possibly_get_caption_text( $element ) {
		$caption_tag = 'figcaption';
		if ( isset( $element->nextSibling->nodeName ) && $caption_tag === $element->nextSibling->nodeName ) {
			return $element->nextSibling->childNodes;
		}
		// If 'Link To' is selected, the image will be wrapped in an <a>, so search for the sibling of the <a>.
		if ( isset( $element->parentNode->nextSibling->nodeName ) && $caption_tag === $element->parentNode->nextSibling->nodeName ) {
			return $element->parentNode->nextSibling->childNodes;
		}
		return null;
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
				if ( isset($image['caption'])  && is_object($image['caption'])) {
					$figure_node = AMP_DOM_Utils::create_node($this->dom, 'figure', array());
					$fig_caption = AMP_DOM_Utils::create_node($this->dom, 'figcaption', array('on'=>"tap:AMP.setState({expanded: !expanded})",'tabindex'=>0,'role'=>'button'));
					$captionlength = $image['caption']->length;
					for ($i=0 ;$i < $captionlength;$i++){
						$fig_caption->appendChild($image['caption']->item(0));
					}
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
			$amp_carousel = AMP_DOM_Utils::create_node($this->dom,
				'amp-carousel',
				array(
					'width' => 600,
					'height' => 480,
					'type' => 'slides',
					'layout' => 'responsive',
					'class'  => 'collapsible-captions',
					'id' => 'carousel-with-carousel-preview-'.$r
				)
			);
			foreach ($amp_images as $amp_image) {
				$amp_carousel->appendChild( $amp_image );
			}
			$captiondom = $this->ampforwp_set_block_gallery_caption($node,$node->parentNode);
			if ($captiondom) {
				$main_dic = AMP_DOM_Utils::create_node($this->dom, 'div', array('class'=>'amp-carousel-wrapper') );
				$main_dic->appendChild( $amp_carousel );
				$main_dic->appendChild( $captiondom );
				$amp_carousel =	$main_dic;	
			}
		}
		if ( 2 == ampforwp_get_setting('ampforwp-gallery-design-type') ) {
			$button_nodes = array();

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
				if ( isset($image['caption']) && is_object($image['caption']) ) {
					$captionlength = $image['caption']->length;
					for ($i=0 ;$i < $captionlength;$i++){
						$fig_caption->appendChild($image['caption']->item(0));
					}
				}
				$figure_node->appendChild($fig_caption);
				$gal_div->appendChild( $figure_node );
				$i++;
			}
			$this->ampforwp_set_block_gallery_caption($node,$gal_div);
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
	protected function ampforwp_set_block_gallery_caption($node,$append){
		$domData = $this->dom->saveHTML();
		if(preg_match_all('/<figcaption class="blocks-gallery-caption">(.*?)<\/figcaption>/', $domData, $fc)!==false){
			$block_gcnode = AMP_DOM_Utils::create_node($this->dom, 'figcaption', array('class'=>'ampforwp-blocks-gallery-caption') );
			if(isset($fc[1][0])){
				$block_gcnode->nodeValue = $fc[1][0];
				return $block_gcnode;
			}
		}
		return "";
	}
	/**
	 * Get carousel height by containing images.
	 *
	 * @param DOMElement $element The UL element.
	 * @return array {
	 *     Dimensions.
	 *
	 *     @type int $width  Width.
	 *     @type int $height Height.
	 * }
	 */
	protected function get_carousel_dimensions( $element ) {
		/**
		 * Elements.
		 *
		 * @var DOMElement $image
		 */
		$images     = $element->getElementsByTagName( 'amp-img' );
		$num_images = $images->length;
		$max_aspect_ratio = 0;
		$carousel_width   = 0;
		$carousel_height  = 0;
		if ( 0 === $num_images ) {
			return [ self::FALLBACK_WIDTH, self::FALLBACK_HEIGHT ];
		}
		foreach ( $images as $image ) {
			if ( ! is_numeric( $image->getAttribute( 'width' ) ) || ! is_numeric( $image->getAttribute( 'height' ) ) ) {
				continue;
			}
			$width  = (float) $image->getAttribute( 'width' );
			$height = (float) $image->getAttribute( 'height' );
			$this_aspect_ratio = $width / $height;
			if ( $this_aspect_ratio > $max_aspect_ratio ) {
				$max_aspect_ratio = $this_aspect_ratio;
				$carousel_width   = $width;
				$carousel_height  = $height;
			}
		}
		return [ $carousel_width, $carousel_height ];
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
	echo $amp_image_lightbox;
}