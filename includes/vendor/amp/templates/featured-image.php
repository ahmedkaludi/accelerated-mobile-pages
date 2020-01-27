<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$featured_image = $this->get( 'featured_image' );

if ( empty( $featured_image ) ) {
	return;
}

$amp_html = $featured_image['amp_html'];
$caption = $featured_image['caption'];
?>
<figure class="amp-wp-article-featured-image wp-caption">
	<?php 
	if(function_exists('ampforwp_add_fallback_element')){
		$amp_html = ampforwp_add_fallback_element($amp_html,'amp-img');
	}
	echo $amp_html; // amphtml content; no kses ?>
	<?php if ( $caption ) : ?>
		<p class="wp-caption-text">
			<?php echo wp_kses_data( $caption ); ?>
		</p>
	<?php endif; ?>
</figure>
