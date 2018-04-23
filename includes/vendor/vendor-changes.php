<?php
add_action( 'parse_query', 'ampforwp_correct_query_front_page' );
function ampforwp_correct_query_front_page(WP_Query $query){
	if ( ampforwp_is_front_page() && ampforwp_get_frontpage_id()){
		$query->is_home     = false;
		$query->is_page     = true;
		$query->is_singular = true;
		$query->set( 'page_id', ampforwp_get_frontpage_id() );
	}elseif( ampforwp_is_home() && $query->is_main_query() ){
		$query->is_home     = true;
		$query->is_page     = false;
		$query->is_singular = true;
		$query->set( 'offset', '1' );
	}elseif( is_archive() && $query->is_archive ){

		
	}
}

add_filter("ampforwp_content_sanitizers", 'content_sanitizers_remove_blacklist', 999);
add_filter("amp_content_sanitizers", 'content_sanitizers_remove_blacklist', 999);
function content_sanitizers_remove_blacklist($sanitizer_classes){
	if(isset($sanitizer_classes['AMP_Blacklist_Sanitizer'])) {
		unset($sanitizer_classes['AMP_Blacklist_Sanitizer']);
		$sanitizer_classes['AMP_Tag_And_Attribute_Sanitizer']= array();
	}
	if(isset($sanitizer_classes['AMP_Base_Sanitizer'])) {
		unset($sanitizer_classes['AMP_Base_Sanitizer']);
		
	}
		return $sanitizer_classes;
}

add_action( 'init', 'remove_amp_init', 100 );
function remove_amp_init(){
	remove_action( 'admin_init', 'AMP_Options_Manager::register_settings' );
	remove_action( 'wp_loaded', 'amp_post_meta_box' );
	remove_action( 'wp_loaded', 'amp_add_options_menu' );
	remove_action( 'parse_query', 'amp_correct_query_when_is_front_page' );
}