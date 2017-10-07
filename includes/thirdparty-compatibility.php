<?php
//Remove ResponsifyWP #1131
add_action('plugins_loaded', 'my_functions');
function my_functions(){
  if(is_plugin_active('responsify-wp/responsify-wp.php')){
	add_filter('rwp_add_filters','removeFilterOfResponsify');
	function removeFilterOfResponsify($filter){
	  return '';
	}
  }
}