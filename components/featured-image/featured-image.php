<?php 
function ampforwp_framework_get_featured_image(){
	do_action('ampforwp_before_featured_image_hook');
	global $post, $redux_builder_amp;
	$post_id 		= $post->ID;
	$featured_image = "";
	$amp_html 		= "";
	$caption 		= "";
	if( ampforwp_is_front_page() ){
		$post_id = ampforwp_get_frontpage_id();
	}
	if( true == ampforwp_has_post_thumbnail() )	{
		if (has_post_thumbnail( $post_id ) ){
		 	$thumb_id = get_post_thumbnail_id($post_id);
			$image = wp_get_attachment_image_src( $thumb_id, 'full' ); 
			$caption = get_the_post_thumbnail_caption( $post_id ); 
			$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
			if($thumb_alt){
				$alt = $thumb_alt;
			}
			else{
				$alt = get_the_title( $post_id );
			}
			$alt = esc_attr($alt);
			if( $image ){			
				$amp_html = "<amp-img src='$image[0]' width='$image[1]' height='$image[2]' layout=responsive alt='$alt'></amp-img>";
			}
		}
		elseif ( ampforwp_is_custom_field_featured_image() ) {
			$amp_img_src 	= ampforwp_cf_featured_image_src();
			$amp_img_width 	= ampforwp_cf_featured_image_src('width');
			$amp_img_height = ampforwp_cf_featured_image_src('height');
			if( $amp_img_src ){			
				$amp_html = "<amp-img src='$amp_img_src' width=$amp_img_width height=$amp_img_height layout=responsive ></amp-img>";
			}
		}
		elseif ( true == ampforwp_get_setting('ampforwp-featured-image-from-content') && ampforwp_get_featured_image_from_content() ){
			$amp_html = ampforwp_get_featured_image_from_content();
			$amp_html = preg_replace('#sizes="(.*)"#', "layout='responsive'", $amp_html);
		} 
		if( $amp_html ){ ?>
			<figure class="amp-featured-image"> <?php  
				echo $amp_html;
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