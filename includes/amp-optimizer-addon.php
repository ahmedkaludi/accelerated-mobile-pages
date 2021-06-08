<?php
add_filter('ampforwp_the_content_last_filter', 'ampforwp_add_optimizer_addon',9);// phpcs:ignore PHPCompatibility.Constants.NewConstants.php_int_minFound
function ampforwp_add_optimizer_addon($output_buffer){
	$ssr_settings = add_filter(
			'amp_enable_ssr', true, defined( 'PHP_INT_MIN' ) ? PHP_INT_MIN : ~PHP_INT_MAX // phpcs:ignore PHPCompatibility.Constants.NewConstants.php_int_minFound
		);
	if(!$ssr_settings){ return $output_buffer; }
	if(!class_exists('AmpProject\Optimizer\Transformer\AmpRuntimeCss')){
		require_once AMPFORWP_PLUGIN_DIR."/includes/vendor/css-parser/autoload.php";
	}
	$configurationData =  [
		AmpProject\Optimizer\Transformer\AmpRuntimeCss::class => [
				AmpProject\Optimizer\Configuration\AmpRuntimeCssConfiguration::CANARY => true,
			],
		AmpProject\Optimizer\Configuration::KEY_TRANSFORMERS => [
			AmpProject\Optimizer\Transformer\AmpBoilerplate::class, //1
			AmpProject\Optimizer\Transformer\PreloadHeroImage::class, //2
			AmpProject\Optimizer\Transformer\AmpRuntimeCss::class, // 3
			AmpProject\Optimizer\Transformer\ReorderHead::class, //4


			// AmpProject\Optimizer\Transformer\RewriteAmpUrls::class,
			AmpProject\Optimizer\Transformer\ServerSideRendering::class, // 5
			AmpProject\Optimizer\Transformer\TransformedIdentifier::class,
		],
	];

	$transformationEngine = new AmpProject\Optimizer\TransformationEngine(new AmpProject\Optimizer\DefaultConfiguration($configurationData));
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