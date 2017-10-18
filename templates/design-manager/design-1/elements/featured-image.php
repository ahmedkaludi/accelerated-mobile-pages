<?php do_action('ampforwp_before_featured_image_hook',$this);
global $redux_builder_amp, $post;
$featured_image = $this->get( 'featured_image' );
if($featured_image || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) || $redux_builder_amp['ampforwp-featured-image-from-content'] == true ){
	if ( $featured_image ) {
		$amp_html = $featured_image['amp_html'];
		$caption = $featured_image['caption'];
	}
	elseif ( ampforwp_is_custom_field_featured_image() ) {
		$amp_img_src = ampforwp_cf_featured_image_src();
		$amp_html = "<amp-img src='$amp_img_src' width=300 height=250 layout=responsive ></amp-img>";
	}
	else{
		$image_arguments = array(
						        'post_type' => 'attachment',
						        'post_mime_type' => 'image',
						        'post_parent' => $post->ID,
						        'numberposts' => 1
						    );
        $content_images = get_children($image_arguments);
        if ($content_images) {
            foreach ($content_images as $image) {
            	$featured_id = $image->ID;
		        $image_html =	wp_get_attachment_image( $featured_id, 'large' );
		     	$amp_html_sanitizer = new AMPFORWP_Content( $image_html, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array() ) ) );
		        $amp_html =  $amp_html_sanitizer->get_amp_content();
			 } 
		}
            wp_reset_postdata();
	}	
		?>
		<figure class="amp-wp-article-featured-image wp-caption">
			<?php echo $amp_html; // amphtml content; no kses ?>
			<?php if ( $caption ) : ?>
				<p class="wp-caption-text">
					<?php echo wp_kses_data( $caption ); ?>
				</p>
			<?php endif; ?>
		</figure>
		<?php 
	}
do_action('ampforwp_after_featured_image_hook',$this);