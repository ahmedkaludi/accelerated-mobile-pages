<?php do_action('ampforwp_before_featured_image_hook',$this);

$featured_image = $this->get( 'featured_image' );

if ( $featured_image )  {
	$amp_html = $featured_image['amp_html'];
	$caption = $featured_image['caption']; ?>
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
do_action('ampforwp_after_featured_image_hook',$this); ?>