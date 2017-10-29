<?php do_action('ampforwp_before_featured_image_hook',$this);
global $redux_builder_amp, $post;

$amp_html = "";
$caption = "";
$featured_image = "";

$featured_image = $this->get( 'featured_image' );
if($featured_image || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) || $redux_builder_amp['ampforwp-featured-image-from-content'] == true ) {
	if ( $featured_image )  {
		$amp_html = $featured_image['amp_html'];
		$caption = $featured_image['caption']; 
	}
	elseif ( ampforwp_is_custom_field_featured_image() ) {
		$amp_img_src = ampforwp_cf_featured_image_src();
		$amp_html = "<amp-img src='$amp_img_src' width=300 height=250 layout=responsive ></amp-img>";
	}
	elseif($redux_builder_amp['ampforwp-featured-image-from-content'] == true){
		$amp_html = ampforwp_get_featured_image_from_content();
	}	
		if( $amp_html ) {
			?>
			<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
				<figure class="amp-wp-article-featured-image wp-caption">
					<?php echo $amp_html; // amphtml content; no kses ?>
					<?php if ( $caption ) : ?>
						<p class="wp-caption-text">
							<?php echo wp_kses_data( $caption ); ?>
						</p>
					<?php endif; ?>
				</figure>
			</div> <?php
		}
}
do_action('ampforwp_after_featured_image_hook',$this); ?>