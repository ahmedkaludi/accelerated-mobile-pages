<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;?>
<?php use AMPforWP\AMPVendor\AMP_Post_Template;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php global $redux_builder_amp,$wp;
	$post_id = '';
	$post_id = ampforwp_get_frontpage_id();

$template = new AMP_Post_Template( $post_id );?>
<!doctype html>
<html amp <?php 
//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo AMP_HTML_Utils::build_attributes_string( $template->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">  
	<?php do_action( 'amp_post_template_head', $template ); ?>
	<style amp-custom>
	<?php $template->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $template ); ?>
	</style>
</head>
<body <?php ampforwp_body_class('single-post amp-wp-frontpage design_1_wrapper');?>>
	<?php do_action('ampforwp_body_beginning', $template); ?>
	<?php $template->load_parts( array( 'header-bar' ) ); ?>
	<?php do_action( 'below_the_header_design_1', $template ); ?>
	<?php do_action('ampforwp_frontpage_above_loop',$template, $post_id) ?>	
	<?php do_action('ampforwp_frontpage_below_loop',$template, $post_id) ?>
	<?php do_action( 'amp_post_template_above_footer', $template ); ?>
	<?php $template->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $template ); ?>
</body>
</html>