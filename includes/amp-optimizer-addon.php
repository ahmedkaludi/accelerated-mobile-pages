<?php
require_once AMPFORWP_PLUGIN_DIR."/includes/vendor/optimizer/autoload.php";

use AmpProject\Optimizer\Configuration;
use AmpProject\Optimizer\DefaultConfiguration;
use AmpProject\Optimizer\TransformationEngine;
use AmpProject\Optimizer\Transformer;
use AmpProject\Optimizer\ErrorCollection;


add_filter('ampforwp_the_content_last_filter', 'ampforwp_add_optimizer_addon',defined( 'PHP_INT_MIN' ) ? PHP_INT_MIN : ~PHP_INT_MAX);// phpcs:ignore PHPCompatibility.Constants.NewConstants.php_int_minFound
function ampforwp_add_optimizer_addon($output_buffer){
	$ssr_settings = add_filter(
			'amp_enable_ssr', true, defined( 'PHP_INT_MIN' ) ? PHP_INT_MIN : ~PHP_INT_MAX // phpcs:ignore PHPCompatibility.Constants.NewConstants.php_int_minFound
		);
	if(!$ssr_settings){ return $output_buffer; }
	
	$configurationData = [
		Transformer\AmpRuntimeCss::class => [
				Configuration\AmpRuntimeCssConfiguration::CANARY => true,
			],
		Configuration::KEY_TRANSFORMERS => [
			Transformer\AmpBoilerplate::class, //1
			Transformer\PreloadHeroImage::class, //2
			Transformer\AmpRuntimeCss::class, // 3
			Transformer\ReorderHead::class, //4


			// Transformer\RewriteAmpUrls::class,
			Transformer\ServerSideRendering::class, // 5
			Transformer\TransformedIdentifier::class,
		],
	];

	$transformationEngine = new TransformationEngine(new DefaultConfiguration($configurationData));
	$errorCollection      = new ErrorCollection; 

	$optimizedHtml = $transformationEngine->optimizeHtml( $output_buffer,$errorCollection);

	//Handle and log the error
	if($errorCollection->count()>0){
		foreach ($errorCollection as $error) {
			new WP_Error( $error->getCode(),  $error->getMessage());
		}
	}
	return $optimizedHtml;
}


