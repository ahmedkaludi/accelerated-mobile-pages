<?php global $redux_builder_amp , $wp;
 include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 	$post_id = get_option('page_on_front');
 	
 }
 else{
 	$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
 }
$template = new AMP_Post_Template( $post_id );?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<?php
		$amp_custom_content_enable = get_post_meta($template->data['post_id'], 'ampforwp_custom_content_editor_checkbox', true);
		if ( ! $amp_custom_content_enable ) {
			$amp_component_scripts = $template->data['amp_component_scripts'];
			foreach ($amp_component_scripts as $ampforwp_service => $ampforwp_js_file) {
				if ( $ampforwp_service  ==  'amp-sidebar' || $ampforwp_service  ==  'amp-analytics' ) {
					continue;
				} ?>
				<script custom-element="<?php echo $ampforwp_service; ?>"  src="<?php echo $ampforwp_js_file; ?>" async></script> <?php
			}
		}	 ?>
	<style amp-custom>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body <?php ampforwp_body_class('single-post design_2_wrapper');?> >
	<?php do_action('ampforwp_body_beginning', $this); ?>
	<?php $this->load_parts( array( 'header-bar' ) ); ?>

	<?php do_action( 'ampforwp_design_2_frontpage_title', $template ); ?>

	<?php do_action( 'ampforwp_after_header', $template ); ?> 
	<?php do_action('ampforwp_frontpage_above_loop',$template, $post_id) ?>

	<?php do_action('ampforwp_frontpage_below_loop',$template, $post_id) ?>
	<?php do_action( 'amp_post_template_above_footer', $template ); ?>
	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $template ); ?>

</body>
</html>
