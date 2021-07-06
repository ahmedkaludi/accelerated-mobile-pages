<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php' );

class AMP_Gallery_Embed_Handler extends AMP_Base_Embed_Handler {
	private static $script_slug = 'amp-carousel';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-carousel-0.2.js';

	public function register_embed() {
		add_shortcode( 'gallery', array( $this, 'shortcode' ) );
	}

	public function unregister_embed() {
		remove_shortcode( 'gallery' );
	}

	public function get_scripts() {
		if ( ! $this->did_convert_elements ) {
			return array();
		}

		return array( self::$script_slug => self::$script_src );
	}

	public function shortcode( $attr ) {
		$post = get_post();

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) ) {
				$attr['orderby'] = 'post__in';
			}
			$attr['include'] = $attr['ids'];
		}

		$atts = shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'include'    => '',
			'exclude'    => '',
			//'size'       => array( $this->args['width'], $this->args['height'] ),
			//'size'		=> isset($attr['size'])? $attr['size']:'thumbnail',
			'size'		=> 'large'
		), $attr, 'gallery' );

		$id = intval( $atts['id'] );

		if ( ! empty( $atts['include'] ) ) {
			$attachments = get_posts( array(
				'include' => $atts['include'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
				'fields' => 'ids',
			) );
		} elseif ( ! empty( $atts['exclude'] ) ) {
			$attachments = get_children( array(
				'post_parent' => $id,
				'exclude' => $atts['exclude'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
				'fields' => 'ids',
			) );
		} else {
			$attachments = get_children( array(
				'post_parent' => $id,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
				'fields' => 'ids',
			) );
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		$urls = array();
		foreach ( $attachments as $attachment_id ) {
			list( $url, $width, $height ) = wp_get_attachment_image_src( $attachment_id, $atts['size'], true );

			if ( ! $url ) {
				continue;
			}

			$urls[] = apply_filters('amp_gallery_image_params', array(
				'url' => $url,
				'width' => $width,
				'height' => $height,
			),$attachment_id);
		}
		return $this->render( array(
			'images' => $urls,
		) );
	}

	public function render( $args ) {
		global $redux_builder_amp,$carousel_markup_all;
		$this->did_convert_elements = true;
		
		$args = wp_parse_args( $args, array(
			'images' => false,
		) );
		
		if ( empty( $args['images'] ) ) {
			return '';
		}

		/*Filter*/
		$carousel_markup = $amp_image_lightbox = '';
		
		$carousel_markup_all = array(
			'1'=>array(
						'main-html'=>'{{with_carousel}}
						{{amp_image_lightbox}}',
						'image-with-caption-html'=>'<figure><div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div><figcaption {{openbrack}}class{{closebrack}}="expanded? \'expanded\' : \'\'" on="tap:AMP.setState({expanded: !expanded})" tabindex="0" role="button" >{{main_images_caption}}<span {{openbrack}}text{{closebrack}}="expanded ? \'less\' : \'more\'">more</span> </figcaption></figure>',
						'image-without-caption-html' =>'<div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div>',
						'gallery_css' => '.cls-btn { background: #0d0d0d; border: none;position: absolute;right: 10px;}
						.cls-btn:after{content:"X";display:inline-block;color:#fff;font-size:20px;padding:20px;}',

						'scripts' => array()
									),
			'2' => array(
						'main-html'=>'{{with_carousel}}
						{{with_carousel_thumbnail}}
						{{amp_image_lightbox}}',
						'image-with-caption-html'=>'<figure><div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div><figcaption {{openbrack}}class{{closebrack}}="expanded? \'expanded\' : \'\'" on="tap:AMP.setState({expanded: !expanded})" tabindex="0" role="button" >{{main_images_caption}}<span {{openbrack}}text{{closebrack}}="expanded ? \'less\' : \'more\'">more</span> </figcaption></figure>',
						'image-without-caption-html' =>'<div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div>',
						'carousel_with_thumbnail_html'=>'<button on="tap:carousel-with-carousel-preview-{{unique_id}}.goToSlide(index={{unique_index}})" class="amp-carousel-slide amp-scrollable-carousel-slide">{{thumbnail}}</button>',
						'gallery_css' => '
							.carousel-preview button{padding:0;}
							.carousel-preview amp-img{height:40px;width:60px;position:relative;}
							.carousel-preview {width: 100%;display: inline-block;text-align: center;margin: 20px 0px;}
							.carousel-preview .amp-carousel-img img {object-fit: fill;}
							.cls-btn { background: #0d0d0d; border: none;position: absolute;right: 10px;}
							.cls-btn:after{content:"X";display:inline-block;color:#fff;font-size:20px;padding:20px;}
							',
						'scripts' => array()
									),
			'3' => array(
						'main-html'=>'<div class="gal_w">{{with_images}}</div>
						{{amp_image_lightbox}}',
						'image-with-caption-html'=>'<figure><div class="ampforwp-gallery-item amp-carousel-containerd3">{{main_images}}<figcaption>{{main_images_caption}}</figcaption></div></figure>',
						'image-without-caption-html' =>'{{main_images}}',
						'gallery_css' => '
							.gal_w{display:inline-block;width:100%}
							.gal_w amp-img{background:#f1f1f1;height:134px;width:150px;position: relative;float:left;margin:10px;}
							.cls-btn{background:#0d0d0d;border:none;position: absolute;right: 10px;}
							.cls-btn:after{content:"X";display:inline-block;color:#fff;font-size:20px;padding:20px;}
							',
						'scripts' => array()
									),
		);

		$carousel_markup_all = apply_filters("ampforwp_manage_gallery_markup", $carousel_markup_all);
		//Default markup
		$markup =  $carousel_markup_all[1];
		if( isset($redux_builder_amp['ampforwp-gallery-design-type']) &&  isset($carousel_markup_all[$redux_builder_amp['ampforwp-gallery-design-type'] ] ) ){
			$markup =  $carousel_markup_all[$redux_builder_amp['ampforwp-gallery-design-type']];
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
				$amp_image_lightbox = '<amp-image-lightbox id="gallery-lightbox" layout="nodisplay">
					      <div on="tap:gallery-lightbox.close" role="button"
					          tabindex="0">
					          <button class="cls-btn" on="tap:gallery-lightbox.close"
					            role="button" tabindex="0"></button>
					      </div>
					    </amp-image-lightbox>';
			}
			$amp_images[$key] = AMP_HTML_Utils::build_tag(
				'amp-img',
				$amp_img_arr
			);

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

	        $amp_images_small[$key] = AMP_HTML_Utils::build_tag(
				'amp-img',
				array(
					'src' => $smallimage,
					'width' => $smallwidth,
					'height' =>  $smallheight,
					'layout' => 'fill',
					'class'  => 'amp-carousel-img',
				)
			);

			//Image markups loading
			$returnHtml = '';
			//Check if the attachment has caption or not
			if(isset($image['caption']) && $image['caption'] != '' && isset($markup['image-with-caption-html']) && $markup['image-with-caption-html'] != ''){
				// To enable the carousel magic
				$caption = $image['caption'];
				// Append the caption with image
				$returnHtml = isset($markup['image-with-caption-html'])? $markup['image-with-caption-html']:'';
				$returnHtml = str_replace('{{main_images}}', $amp_images[$key] , $returnHtml);
				$returnHtml = str_replace('{{main_images_caption}}', wp_kses_data( $caption ), $returnHtml);
				// Replace the openbrack with [ and closebrack with ]
				$returnHtml = str_replace('{{openbrack}}', '[', $returnHtml);
				$returnHtml = str_replace('{{closebrack}}', ']', $returnHtml);
				if( strlen($caption) < 200){
					$returnHtml = str_replace('<span [text]="expanded ? \'less\' : \'more\'">more</span>', '', $returnHtml);
					$returnHtml = preg_replace('/<span(.*?)>(.*?)<\/span>/', '', $returnHtml);
				}
			}
			elseif( isset($markup['image-without-caption-html']) ){
				// If there is no caption
				$returnHtml = isset($markup['image-without-caption-html'])? $markup['image-without-caption-html'] :'';
				$returnHtml = str_replace('{{main_images}}', $amp_images[$key] , $returnHtml);
			}
			
			$images[$key] = apply_filters('amp_gallery_images', $returnHtml, $image, $markup);
		}// foreach Closed

		//replacements
			$r = rand(1,100);
			$carousel_args = array(
								'width' => $this->args['width'],
								'height' => $this->args['height'],
								'type' => 'slides',
								'controls'	=>'',
								'layout' => 'responsive',
								'class'  => 'collapsible-captions',
								'id' => 'carousel-with-carousel-preview-'.$r
							);
			$c_args = array('loop'=>'', 'autoplay'=>'');
			$carousel_filter = apply_filters('ampforwp_carousel_args',$c_args);
			$carousel_args = array_merge($carousel_args,$carousel_filter);

			$amp_carousel = AMP_HTML_Utils::build_tag( 
							'amp-carousel',
							$carousel_args,
							implode( PHP_EOL, $images ));

			$amp_carousel_with_thumbnail_nav = apply_filters('amp_thumbnail_images', $amp_images_small, $r, $markup);
			$amp_carousel_thumbnail ='';
			if(!empty($amp_carousel_with_thumbnail_nav)){
				$amp_carousel_thumbnail = AMP_HTML_Utils::build_tag(
								'amp-carousel',
								array(
									'width' => 'auto',
									'height' => 48,
									'type' => 'carousel',
									'layout' => 'fixed-height',
									'class'  => 'carousel-preview'
								),
								implode( PHP_EOL, $amp_carousel_with_thumbnail_nav ));
			
			}
		$amp_carousel_thumbnail = apply_filters('amp_gallery_markup', $amp_carousel_thumbnail);
		$returnCompleteHtml = $markup['main-html'];
		//last changes
		$returnCompleteHtml = str_replace('{{with_carousel}}', $amp_carousel, $returnCompleteHtml);
		$returnCompleteHtml = str_replace('{{with_carousel_thumbnail}}', $amp_carousel_thumbnail, $returnCompleteHtml);
		$returnCompleteHtml = str_replace('{{amp_image_lightbox}}', $amp_image_lightbox, $returnCompleteHtml);
		$returnCompleteHtml = str_replace('{{with_images}}', implode( PHP_EOL, $images ), $returnCompleteHtml);
		return $returnCompleteHtml;
	}
}// Class closed

// Add Caption in the Gallery Image
add_filter('amp_gallery_images','ampforwp_new_gallery_images', 10, 3);

add_filter('amp_thumbnail_images','ampforwp_new_thumbnail_images',10,3);