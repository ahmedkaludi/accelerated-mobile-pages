<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!doctype html>
<html amp <?php 
//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="preconnect" href="//cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body <?php ampforwp_body_class('single-post design_1_wrapper');?>>
	<?php do_action('ampforwp_body_beginning', $this); ?>
	<?php $this->load_parts( array( 'header-bar' ) ); ?>
	<?php do_action( 'below_the_header_design_1', $this ); ?>

	<div class="amp-wp-article">
		<article class="amp-wp-article-header">
			<?php do_action('ampforwp_post_before_design_elements') ?>
			<h2 class="amp-wp-title"><?php global $redux_builder_amp; 
				$allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>';
				//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo wp_strip_all_tags(ampforwp_translation($redux_builder_amp['amp-translator-fourohfour'],'Oops! That page can’t be found.'),$allowed_tags); ?></h2>
			<?php do_action('ampforwp_post_after_design_elements') ?>
		</article>
	</div>

	<?php do_action( 'amp_post_template_above_footer', $this ); ?>
	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>