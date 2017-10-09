<?php do_action('ampforwp_before_featured_image_hook',$this);
$featured_image = $this->get( 'featured_image' );
if($featured_image || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) ){
	if ( $featured_image ) {
		$amp_html = $featured_image['amp_html'];
		$caption = $featured_image['caption'];
	}
	else {
		$amp_img_src = ampforwp_cf_featured_image_src();
		$amp_html = "<amp-img src='$amp_img_src' width=300 height=250 layout=responsive ></amp-img>";
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