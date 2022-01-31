<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_framework_get_featured_image(){
	do_action('ampforwp_before_featured_image_hook');
	global $post, $redux_builder_amp;
	$post_id 		= $post->ID;
	$featured_image = $image_size = "";
	$amp_html 		= "";
	$caption 		= "";
	$f_vid 			= "";
	$srcet 			= '';
	if( ampforwp_is_front_page() ){
		$post_id = ampforwp_get_frontpage_id();
	}
	if( true == ampforwp_has_post_thumbnail() )	{
		// Featured Video SmartMag theme Compatibility #2559
		if(class_exists('Bunyad') && Bunyad::posts()->meta('featured_video') ){
			global $wp_embed;
			$f_vid = 'f_vid';
			$videoContent = Bunyad::posts()->meta('featured_video');
  		  	$featured_video = $wp_embed->autoembed($videoContent);
 			$amp_html = ampforwp_content_sanitizer($featured_video);
  		}
  		// Featured Video Plus Compatibility #2394 #2583
		elseif(function_exists('has_post_video') && has_post_video($post_id)){
			$videoContent = get_the_post_video();
			$amp_html = ampforwp_content_sanitizer($videoContent);
		}elseif (has_post_thumbnail( $post_id ) ){
		 	$thumb_id = get_post_thumbnail_id($post_id);
		 	$post_content = $post->post_content;
			if ( ampforwp_webp_featured_image() && true !== apply_filters('ampforwp_allow_featured_image', false) && ( false !== strpos( $post_content, 'wp-image-' . $thumb_id ) || false !== strpos( $post_content, 'attachment_' . $thumb_id ) ) ) {
				return;
			}
			$image_size = ampforwp_get_setting('swift-featued-image-size');
		 	$image_size = apply_filters( 'ampforwp_featured_image_size', $image_size ); 
			$image = wp_get_attachment_image_src( $thumb_id, $image_size );
			$caption = get_the_post_thumbnail_caption( $post_id ); 
			$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
			$thumbnail_srcset  = wp_get_attachment_image_srcset( $thumb_id, $image_size);
			if ( $thumbnail_srcset && 'full' == ampforwp_get_setting('swift-featued-image-size') ) {
				$srcet = $thumbnail_srcset;
			}
			if($thumb_alt){
				$alt = $thumb_alt;
			}
			else{
				$alt = get_the_title( $post_id );
			}
			if(class_exists('transposh_plugin')){
		       $alt = strtok($alt, " ");
		    }
			$alt = convert_chars( stripslashes( $alt ) );
			if(function_exists('fifu_show_elements')){
				$fifu_image_url = get_post_meta($post_id, 'fifu_image_url', true);
				if($fifu_image_url){
					$size = getimagesize(get_the_post_thumbnail_url());
					if(isset($size[0])){
						$image[1] = $size[0];
					}
					if(isset($size[1])){
						$image[2] = $size[1];
					}
				}
			}
			if( $image ){
				if(empty($image[1])){
					$image[1] = 1000;
				}
				if(empty($image[2])){
					$image[2] = 600;
				}
				if ( empty($srcet) ) {
					$srcet = $image[0];
				}
				$amp_html = '<amp-img data-hero src="'.esc_url($image[0]).'" srcset="'.esc_html($srcet).'" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" layout="responsive" alt="'.esc_attr($alt).'"></amp-img>';
			}
		}
		elseif ( ampforwp_is_custom_field_featured_image() ) {
			$amp_img_src 	= ampforwp_cf_featured_image_src();
			$amp_img_width 	= ampforwp_cf_featured_image_src('width');
			$amp_img_height = ampforwp_cf_featured_image_src('height');
			if( $amp_img_src ){
				$amp_html = "<amp-img src='".esc_url($amp_img_src)."' width=".esc_attr($amp_img_width)." height=".esc_attr($amp_img_height)." layout='responsive' ></amp-img>";
			}
		}
		elseif( true == ampforwp_get_setting('ampforwp-featured-image-from-content') && ampforwp_get_featured_image_from_content() ){
			$amp_html = ampforwp_get_featured_image_from_content();
			$amp_html = preg_replace('#sizes="(.*)"#', "layout='responsive'", $amp_html);
		}
		$amp_html = apply_filters('ampforwp_modify_featured_image',$amp_html);
		if( $amp_html ){ ?>
			<figure class="amp-featured-image <?php echo esc_html($f_vid); ?>"> <?php  
				if(function_exists('ampforwp_add_fallback_element')){
 					$amp_html = ampforwp_add_fallback_element($amp_html,'amp-img');
   				}
   				echo $amp_html; // escaped above
				 if ( $caption ) : ?>
					<p class="wp-caption-text">
						<?php echo wp_kses_data( $caption ); ?>
					</p>
				<?php endif; ?>
			</figure>
		<?php do_action('ampforwp_after_featured_image_hook');
		}
	}
}