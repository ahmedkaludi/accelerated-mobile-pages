<?php do_action('ampforwp_before_featured_image_hook',$this);
global $redux_builder_amp, $post;
$amp_html 		= "";
$caption 		= "";
$featured_image = "";
$featured_image = $this->get( 'featured_image' );
if($featured_image || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) || true == $redux_builder_amp['ampforwp-featured-image-from-content'] ){
	if ( $featured_image ) {
		$amp_html = $featured_image['amp_html'];
		$caption = $featured_image['caption'];
	}
	if ( ampforwp_is_custom_field_featured_image() ) {
		$amp_img_src 	= ampforwp_cf_featured_image_src();
		$amp_img_width 	= ampforwp_cf_featured_image_src('width');
		$amp_img_height = ampforwp_cf_featured_image_src('height');
		if( $amp_img_src ){			
			$amp_html = "<amp-img src='$amp_img_src' width=$amp_img_width height=$amp_img_height layout=responsive ></amp-img>";
		}
	}
	if( true == $redux_builder_amp['ampforwp-featured-image-from-content'] && ampforwp_get_featured_image_from_content()) {
		$amp_html = ampforwp_get_featured_image_from_content();
	}
		if( $amp_html ) {	
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
	}
do_action('ampforwp_after_featured_image_hook',$this);