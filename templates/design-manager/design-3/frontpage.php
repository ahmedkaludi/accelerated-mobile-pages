<?php global $redux_builder_amp;
 global $wp;
 //WPML Static Front Page Support #1111
 include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 	$post_id = get_option('page_on_front');	
 }
 else{
 	$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
 }
$template = new AMP_Post_Template( $post_id );?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $template->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8"> 
	<?php do_action( 'amp_post_template_head', $template ); ?>
	<style amp-custom>
		<?php $template->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $template ); ?>
	</style>
</head>
<body <?php ampforwp_body_class('single-post design_3_wrapper');?>>
	<?php do_action('ampforwp_body_beginning', $template); ?>
	<?php $template->load_parts( array( 'header-bar' ) ); ?>
	<?php do_action( 'ampforwp_after_header', $template ); ?>
	<?php do_action('ampforwp_frontpage_above_loop',$template, $post_id) ?>
	<?php do_action('ampforwp_frontpage_below_loop') ?>
    <?php do_action( 'amp_post_template_above_footer', $template ); ?>
	<?php $template->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $template ); ?>
</body>
</html>