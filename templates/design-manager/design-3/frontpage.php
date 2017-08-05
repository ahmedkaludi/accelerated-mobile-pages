<?php global $redux_builder_amp;
 global $wp;
$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
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
					if ( $ampforwp_service  ==  'amp-sidebar' || $ampforwp_service  ==  'amp-analytics') {
						continue;
					} ?>
				<script custom-element="<?php echo $ampforwp_service; ?>"  src="<?php echo $ampforwp_js_file; ?>" async></script> <?php
			}
		}	 ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="single-post <?php ampforwp_the_body_class(); ?> design_3_wrapper">
	
	<?php $this->load_parts( array( 'header-bar' ) ); ?>

	<?php do_action( 'ampforwp_design_3_frontpage_title', $template ); ?>

	<?php do_action( 'ampforwp_after_header', $template ); ?>
	<?php do_action('ampforwp_frontpage_above_loop',$template, $post_id) ?>

	<?php do_action('ampforwp_frontpage_below_loop') ?>
    <?php do_action( 'amp_post_template_above_footer', $this ); ?>
	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>