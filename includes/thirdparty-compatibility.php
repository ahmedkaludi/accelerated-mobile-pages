<?php
//Remove ResponsifyWP #1131
add_action('plugins_loaded', 'ampforwp_filter_remove_function_responsifywp');
function ampforwp_filter_remove_function_responsifywp(){
  if(is_plugin_active('responsify-wp/responsify-wp.php')){
	add_filter('rwp_add_filters','removeFilterOfResponsify');
	function removeFilterOfResponsify($filter){
	  return '';
	}
  }
}

// Strange spaces when using Sassy Social Share #1185
add_filter('heateor_sss_disable_sharing','ampforwp_removing_sassy_social_share');
function ampforwp_removing_sassy_social_share(){
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		return 1;
	}
}

// Remove Schema theme Lazy Load #1170

add_action('pre_amp_render_post','schema_lazy_load_remover');
function schema_lazy_load_remover(){
	remove_filter( 'wp_get_attachment_image_attributes', 'mts_image_lazy_load_attr', 10, 3 );
	remove_filter('the_content', 'mts_content_image_lazy_load_attr');
}

//Updater to check license
require_once AMPFORWP_PLUGIN_DIR . '/includes/updater/update.php';


if(!function_exists('ampforwp_amp_nonamp_convert')){
	function ampforwp_amp_nonamp_convert($ampData, $type=""){
		$returnData = '';
		if("check" === $type){
			return ampforwp_is_non_amp('non_amp_check_convert');
		}
		if(!ampforwp_is_non_amp('non_amp_check_convert')){
			return $ampData;
		}
		switch($type){
			case 'filter':
				$returnData = str_replace(array(
												"amp-img",
												"<style amp-custom>",
												"<amp-sidebar ",
												"</amp-sidebar>",
												),
											array(
												"img",
												"<style>",
												"<sidebar ",
												"</sidebar>",
												)
											, $ampData);
				/*$returnData = preg_replace("/<style>(.*?)<\/style>/i", function($match){
					
										$match[0] .= '.cntr img{width:100%;height:auto;}';
																	return $match[0];
																}, $returnData);*/
				$nonampCss = '.cntr img{width:100% !important;height:auto !important;}';
				$re = '/<style type="text\/css">(.*?)<\/style>/';
				$subst = "<style type=\"text/css\">$1 ".$nonampCss."</style>";
				$returnData = preg_replace($re, $subst, $returnData);
			break;
		}
		return $returnData;
	}
}
