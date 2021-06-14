<?php
if (true == ampforwp_get_setting('amp-server-side-rendering')) {
	add_filter('ampforwp_the_content_last_filter', 'ampforwp_add_optimizer_addon',12);// phpcs:ignore PHPCompatibility.Constants.NewConstants.php_int_minFound
}
function ampforwp_add_optimizer_addon($output_buffer){
	$ssr_settings = add_filter(
			'amp_enable_ssr', true, defined( 'PHP_INT_MIN' ) ? PHP_INT_MIN : ~PHP_INT_MAX // phpcs:ignore PHPCompatibility.Constants.NewConstants.php_int_minFound
		);
	if(!$ssr_settings){ return $output_buffer; }
	if(!class_exists('AmpProject\Optimizer\Transformer\AmpRuntimeCss')){
		require_once AMPFORWP_PLUGIN_DIR."/includes/vendor/css-parser/autoload.php";
	}

	$transformationEngine = new AmpProject\Optimizer\TransformationEngine(new AmpProject\Optimizer\DefaultConfiguration());
	$errorCollection      = new AmpProject\Optimizer\ErrorCollection; 

	$optimizedHtml = $transformationEngine->optimizeHtml( $output_buffer,$errorCollection);

	//Handle and log the error
	if($errorCollection->count()>0){
		foreach ($errorCollection as $error) {
			new WP_Error( $error->getCode(),  $error->getMessage());
		}
	}
	return $optimizedHtml;
}