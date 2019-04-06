<?php do_action('ampforwp_before_featured_image_hook',$this);
global $redux_builder_amp, $post;
$featured_image = "";
$amp_html 		= "";
$caption 		= "";
$featured_image = $this->get( 'featured_image' );
if($featured_image || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) || true == $redux_builder_amp['ampforwp-featured-image-from-content'] || (function_exists('has_post_video') && has_post_video($post->ID)) ){
	// Featured Video SmartMag theme Compatibility #2559
	if(class_exists('Bunyad') && Bunyad::posts()->meta('featured_video') ){
			global $wp_embed;
			$videoContent = Bunyad::posts()->meta('featured_video');
  		  	$featured_video = $wp_embed->autoembed($videoContent);
 			$amp_html = ampforwp_content_sanitizer($featured_video);
  	} // Featured Video Plus Compatibility #2394 #2583
	elseif(function_exists('has_post_video') && has_post_video($post->ID)){ 
		ob_start();
		get_the_post_video();
		$videoContent = ob_get_contents();
		ob_clean();
		ob_end_clean();
		$amp_html = ampforwp_content_sanitizer($videoContent);
	}elseif (  $featured_image ) {
		$amp_html = $featured_image['amp_html'];
		$caption = $featured_image['caption'];
	}
	elseif ( ampforwp_is_custom_field_featured_image() ) {
		$amp_img_src 	= ampforwp_cf_featured_image_src();
		$amp_img_width 	= ampforwp_cf_featured_image_src('width');
		$amp_img_height = ampforwp_cf_featured_image_src('height');
		if( $amp_img_src ){			
			$amp_html = "<amp-img src='$amp_img_src' width=$amp_img_width height=$amp_img_height layout=responsive ></amp-img>";
		}
	}
	elseif( true == ampforwp_get_setting('ampforwp-featured-image-from-content') && ampforwp_get_featured_image_from_content() ){
		$amp_html = ampforwp_get_featured_image_from_content();
	}
		if( $amp_html ) {	
			?>
			<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
				<div class="post-featured-img">
					<figure class="amp-wp-article-featured-image wp-caption">
						<?php echo $amp_html; // amphtml content; no kses ?>
						<?php if ( $caption ) : ?>
							<p class="wp-caption-text">
								<?php echo wp_kses_data( $caption ); ?>
							</p>
						<?php endif; ?> 
					</figure>
				</div>
			</div> <?php 
		}
	}else{
		if (has_post_thumbnail( $post_id ) ){
			$thumb_id = get_post_thumbnail_id($post_id);
			$image_size = apply_filters( 'ampforwp_featured_image', 'full' ); 
			$image = wp_get_attachment_image_src( $thumb_id, $image_size );
				if( $image ) {	
					if(empty($image[1])){
					$image[1] = 750;
					}
					if(empty($image[2])){
					$image[2] = 500;
					}
				$image_output = "<amp-img src='$image[0]' $srcet width='$image[1]' height='$image[2]' layout=responsive alt='$alt'></amp-img>";
			?>
			<figure class="amp-wp-article-featured-image">
				<?php echo $image_output; ?>
			</figure>
			<?php 
		}
		}
	}

do_action('ampforwp_after_featured_image_hook',$this); ?>