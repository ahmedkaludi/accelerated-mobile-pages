<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/* 
Most of the code is taken from class-amp-gallery-embed.php and Slider Revolution https://revolution.themepunch.com/
*/
require_once( AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php' );

class AMP_Rev_Slider_Embed_Handler extends AMPforWP\AMPVendor\AMP_Base_Embed_Handler {
	private static $script_slug = 'amp-carousel';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-carousel-0.2.js';

	public function register_embed() {
		add_shortcode( 'rev_slider', array( $this, 'shortcode' ) );
	}

	public function unregister_embed() {
		remove_shortcode( 'rev_slider' );
	}

	public function get_scripts() {
		if ( ! $this->did_convert_elements ) {
			return array();
		}

		return array( self::$script_slug => self::$script_src );
	}

	public function shortcode( $args, $mid_content = null ) {
		global $post,$revSliderVersion;
		extract(shortcode_atts(array('alias'	=> ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('settings' => ''), $args, 'rev_slider'));
		extract(shortcode_atts(array('order'	=> ''), $args, 'rev_slider'));
		// Below version 6.0
		if( !empty($revSliderVersion) && 6 > $revSliderVersion ){
			if($settings !== '') $settings = json_decode(str_replace(array('({', '})', "'"), array('[', ']', '"'), $settings) ,true);
			if($order !== '') $order = explode(',', $order);
			
	        $sliderAlias = ($alias != '') ? $alias : RevSliderFunctions::getVal($args,0);
			$gal_ids = RevSliderFunctionsWP::check_for_shortcodes($mid_content); 
			ob_start();
			if(!empty($gal_ids)){ //add a gallery based slider
				$slider = RevSliderOutput::putSlider($sliderAlias, '', $gal_ids);
			}else{
				$slider = RevSliderOutput::putSlider($sliderAlias, '', array(), $settings, $order);
			}
			$content = ob_get_contents();
			ob_clean();
			ob_end_clean();
			$ids = array();
			$slides = $slider->getSlidesForOutput(true,'',$gal_ids);
			foreach ($slides as $slide) {
				$bgtype = $slide->getParam('background_type', 'image');
				$img_data = wp_get_attachment_metadata( $slide->getImageID() );
				
				if($bgtype == 'external'){
					$url = esc_url($slide->getParam('slide_bg_external', ''));
					$imgalt = esc_attr($slide->getParam('alt_attr', ''));
					$img_title = esc_attr($slide->getParam('title_attr', ''));
					$img_w = $slide->getParam('ext_width', '1920');
					$img_h = $slide->getParam('ext_height', '1080');
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => $url,
						'width' => intval($img_w),
						'height' => intval($img_h),
						'bgtype' => esc_attr($bgtype)
					),$attachment_id);
				}elseif( $bgtype == 'image'){
					$img_data = wp_get_attachment_metadata( $slide->getImageID() );
					$url = $slide->getImageUrl();
					$attachment_id = $slide->getImageID();
					$width = 480;
					$height = 270;
					if(isset($img_data['width'])){
						$width = $img_data['width'];
					}
					if(isset($img_data['height'])){
						$height = $img_data['height'];
					}	
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => $url,
						'width' => intval($width),
						'height' => intval($height),
						'bgtype' => esc_attr($bgtype)
					),$attachment_id);
				}elseif( $bgtype == 'youtube' ){
					$youtube_id = $slide->getParam('slide_bg_youtube', '');
					$cover_img = $slide->getImageUrl();
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => $youtube_id,
						'width' => '480',
						'height' => '270',
						'bgtype' => esc_attr($bgtype),
						'cover_img' => $cover_img
					),$attachment_id);
				}
			}
		}
		// Version 6.0+
		elseif ( defined('RS_REVISION') && 6.0 <= RS_REVISION ) {
			extract(shortcode_atts(array('alias'	=> ''), $args, 'rev_slider'));
			extract(shortcode_atts(array('settings' => ''), $args, 'rev_slider'));
			extract(shortcode_atts(array('order'	=> ''), $args, 'rev_slider'));
			extract(shortcode_atts(array('usage'	=> ''), $args, 'rev_slider'));
			$output = new RevSliderOutput();
			$slider_alias = ($alias != '') ? $alias : $output->get_val($args, 0); //backwards compatibility
			
			$output->set_custom_order($order);
			$output->set_custom_settings($settings);

			$gallery_ids = $output->check_for_shortcodes($mid_content); //check for example on gallery shortcode and do stuff
			if($gallery_ids !== false) $output->set_gallery_ids($gallery_ids);
			
			ob_start();
			$slider = $output->add_slider_to_stage($slider_alias, $usage);
			$content = ob_get_contents();
			ob_clean();
			ob_end_clean();
			$slides = $slider->get_slides_for_output(true,'',$gallery_ids);
			foreach ($slides as $slide) {
				$bgtype = $slide->get_param(array('bg', 'type'),'');
				$layers = $slide->getLayers();
				$image_id = $slide->image_id;
				$url = $slide->image_url;
				if ( $image_id ) {
				 	$img_data = wp_get_attachment_metadata( $image_id );
				}
				if($bgtype == 'external' || !empty($layers)){
					$url = esc_url($slide->get_param(array('bg','externalSrc'), ''));
					$imgalt = esc_attr($slide->get_param('alt_attr', ''));
					$img_title = esc_attr($slide->get_param('title_attr', ''));
					$img_w = $slide->get_param('ext_width', '1920');
					$img_h = $slide->get_param('ext_height', '1080');
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => $url,
						'width' => intval($img_w),
						'height' => intval($img_h),
						'bgtype' => esc_attr($bgtype)
					),$image_id);
					if(!empty($layers)){
						foreach ($layers as $key => $layer) {
							if($layer['type'] == 'video'){
								$video_url = esc_attr($layer['media']['mp4Url']);;
								$video_url = str_replace('http:','https:',$video_url);
								$cover_img = esc_attr($layer['media']['posterUrl']);
								$urls[] = apply_filters('amp_gallery_image_params', array(
									'url' => esc_url($video_url),
									'width' => '480',
									'height' => '270',
									'bgtype' => esc_attr($layer['type']),
									'cover_img' => esc_url($cover_img)
								),$image_id);
							}
						}
					}
				}elseif( $bgtype == 'image' || !empty($layers) ){
					$width = 480;
					$height = 270;
					if(isset($img_data['width'])){
						$width = $img_data['width'];
					}
					if(isset($img_data['height'])){
						$height = $img_data['height'];
					}
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => $url,
						'width' => intval($width),
						'height' => intval($height),
						'bgtype' => esc_attr($bgtype)
					),$image_id);
					if(!empty($layers)){
						foreach ($layers as $key => $layer) {
							if($layer['type'] == 'video'){
								$video_url = esc_attr($layer['media']['mp4Url']);;
								$video_url = str_replace('http:','https:',$video_url);
								$cover_img = esc_attr($layer['media']['posterUrl']);
								$urls[] = apply_filters('amp_gallery_image_params', array(
									'url' => esc_url($video_url),
									'width' => '480',
									'height' => '270',
									'bgtype' => esc_attr($layer['type']),
									'cover_img' => esc_url($cover_img)
								),$image_id);
							}
						}
					}
				}elseif( $bgtype == 'youtube' || !empty($layers) ){
					$youtube_id = $slide->get_param(array('bg','youtube'), '');
					$cover_img = $slide->get_param(array('bg','image'), '');
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => esc_attr($youtube_id),
						'width' => '480',
						'height' => '270',
						'bgtype' => esc_attr($bgtype),
						'cover_img' => esc_attr($cover_img)
					),$image_id);
					if(!empty($layers)){
						foreach ($layers as $key => $layer) {
							if($layer['type'] == 'video'){
								$video_url = esc_attr($layer['media']['mp4Url']);;
								$video_url = str_replace('http:','https:',$video_url);
								$cover_img = esc_attr($layer['media']['posterUrl']);
								$urls[] = apply_filters('amp_gallery_image_params', array(
									'url' => esc_url($video_url),
									'width' => '480',
									'height' => '270',
									'bgtype' => esc_attr($layer['type']),
									'cover_img' => esc_url($cover_img)
								),$image_id);
							}
						}
					}
				}elseif( $bgtype == 'vimeo' || !empty($layers) ){
					$vimeo_id = $slide->get_param(array('bg','vimeo'), '');
					$cover_img = $slide->get_param(array('bg','image'), '');
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => esc_attr($vimeo_id),
						'width' => '480',
						'height' => '270',
						'bgtype' => esc_attr($bgtype),
						'cover_img' => esc_attr($cover_img)
					),$image_id);
					if(!empty($layers)){
						foreach ($layers as $key => $layer) {
							if($layer['type'] == 'video'){
								$video_url = esc_attr($layer['media']['mp4Url']);;
								$video_url = str_replace('http:','https:',$video_url);
								$cover_img = esc_attr($layer['media']['posterUrl']);
								$urls[] = apply_filters('amp_gallery_image_params', array(
									'url' => esc_url($video_url),
									'width' => '480',
									'height' => '270',
									'bgtype' => esc_attr($layer['type']),
									'cover_img' => esc_url($cover_img)
								),$image_id);
							}
						}
					}
				}elseif($bgtype == 'html5' || !empty($layers)){
					$html5_url = $slide->get_param(array('bg','mpeg'), '');
					$html5_url = str_replace('http:','https:',$html5_url);
					$cover_img = $slide->get_param(array('bg','image'), '');
					$urls[] = apply_filters('amp_gallery_image_params', array(
						'url' => esc_url($html5_url),
						'width' => '480',
						'height' => '270',
						'bgtype' => esc_attr($bgtype),
						'cover_img' => esc_url($cover_img)
					),$image_id);
					if(!empty($layers)){
						foreach ($layers as $key => $layer) {
							if($layer['type'] == 'video'){
								$video_url = esc_attr($layer['media']['mp4Url']);;
								$video_url = str_replace('http:','https:',$video_url);
								$cover_img = esc_attr($layer['media']['posterUrl']);
								$urls[] = apply_filters('amp_gallery_image_params', array(
									'url' => esc_url($video_url),
									'width' => '480',
									'height' => '270', 
									'bgtype' => esc_attr($layer['type']),
									'cover_img' => esc_url($cover_img)
								),$image_id);
							}
						}
					}
				}
			}
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
						'gallery_css' => '.cls-btn{background:#0d0d0d;border:none;position: absolute;right: 10px;}
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
							.cls-btn{background:#0d0d0d;border:none;position: absolute;right: 10px;}
							.cls-btn:after{content:"X";display:inline-block;color:#fff;font-size:20px;padding:20px;}
							.carousel-preview button{padding:0;}
							.carousel-preview amp-img{height:40px;width:60px;position:relative;}
							.carousel-preview {width: 100%;display: inline-block;text-align: center;margin: 20px 0px;}
							',
						'scripts' => array()
									),
			'3' => array(
						'main-html'=>'<div class="gal_w">{{with_images}}</div>
						{{amp_image_lightbox}}',
						'image-with-caption-html'=>'',
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
		$tag_type = '';
		foreach ( $args['images'] as $key => $image ) {
			if($image['bgtype'] =="image" || $image['bgtype'] =="external" ){
				$amp_img_arr = array(
					'src' => $image['url'],
					'width' => $image['width'],
					'height' => $image['height'],
					'layout' => 'fill',
					'class'  => 'amp-carousel-img',
				);
				$tag_type = 'amp-img';
			}elseif( $image['bgtype'] =="youtube"){
				$amp_img_arr = array(
					'data-videoid'=> $image['url'],
					'width' => $image['width'],
					'height' => $image['height'],
					'layout'=>'responsive',
					'class'  => 'amp-carousel-img',
					'data-param-playlist'=> $image['url'],
					'data-param-modestbranding'=> '1',
					'autoplay' => '',
				);
				$tag_type = 'amp-youtube';
			}elseif( $image['bgtype'] =="vimeo"){
				$amp_img_arr = array(
					'data-videoid'=> $image['url'],
					'width' => $image['width'],
					'height' => $image['height'],
					'layout'=>'responsive',
					'class'  => 'amp-carousel-img',
					'autoplay' => '',
				);
				$tag_type = 'amp-vimeo';
			}elseif( $image['bgtype'] =="html5"){
				$amp_img_arr = array(
					'src'=> $image['url'],
					'width' => $image['width'],
					'height' => $image['height'],
					'layout'=>'responsive',
					'class'  => 'amp-carousel-img',
					'poster' => $image['cover_img'],
					'controls' => '',
					'autoplay' => '',
				);
				$tag_type = 'amp-video';
			}
			elseif( $image['bgtype'] =="video"){
				$amp_img_arr = array(
					'src'=> $image['url'],
					'width' => $image['width'],
					'height' => $image['height'],
					'layout'=>'responsive',
					'class'  => 'amp-carousel-img',
					'poster' => $image['cover_img'],
					'controls' => '',
					'autoplay' => '',
				);
				$tag_type = 'amp-video';
			}
			if(  3 == ampforwp_get_setting('ampforwp-gallery-design-type') || true == ampforwp_get_setting('ampforwp-gallery-lightbox') ){
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
				$tag_type,
				$amp_img_arr
			);

			$upload_dir = wp_upload_dir();
			$upload_url = $upload_dir['baseurl'];
			if( $tag_type == 'amp-img'){
				if ( false === strpos( $image['url'], $upload_url ) ) {
					$smallimage  = $image['url'];
		            $smallwidth = 120;
		            $smallheight = 60;
				}else{
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
				}
			}elseif( $tag_type == 'amp-youtube'){
	            	$smallimage  = $image['cover_img'];
	            	$smallwidth = 120;
	            	$smallheight = 60;
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