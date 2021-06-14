<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php global $redux_builder_amp;?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<?php do_action('amp_experiment_meta', $this); ?>
    <link rel="preconnect" href="//cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<?php
	$lightbox = '';
    if( false == ampforwp_get_setting('ampforwp-amp-img-lightbox') ){
    	$lightbox = 'data-amp-auto-lightbox-disable ';
	}?>
<body <?php echo esc_attr($lightbox); ?><?php ampforwp_body_class('single-post design_2_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>
	<main>
		<article class="amp-wp-article">
			<?php do_action('ampforwp_post_before_design_elements') ?>
			<?php $this->load_parts( apply_filters( 'ampforwp_design_elements', array( 'empty-filter' ) ) ); ?>
			<?php do_action('ampforwp_post_after_design_elements') ?>
		</article>
	</main>

<?php do_action( 'amp_post_template_above_footer', $this ); ?>	
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>