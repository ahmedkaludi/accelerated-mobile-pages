<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* This file will contain all the extra code that works like a supporting.
1. Register AMP menu
	1.1 AMP Header menu
	1.2 Footer Menu
2. Newsletter code
*/
// 1. AMP menu code
// Registering Custom AMP menu for this plugin
// 1.1 AMP Header menu
if (! function_exists( 'ampforwp_menu') ) {
	function ampforwp_menu() {
	if(ampforwp_get_setting('ampforwp-amp-menu-swift') == true || (ampforwp_design_selector()!=4 && true == ampforwp_get_setting('ampforwp-amp-menu')))	{
	  register_nav_menus(
	    array(
	      'amp-menu' => esc_html__( 'AMP Menu','accelerated-mobile-pages' ),
	    )
	  );
	  if(ampforwp_design_selector()==4 && ampforwp_get_setting('primary-menu') == true){
	  register_nav_menus(
	    array(
	      'amp-alternative-menu' => esc_html__( 'AMP Alternative Menu - Below the Header','accelerated-mobile-pages' ),
	    )
	  );
	  }
	  }
	  // 1.2 Footer Menu	
	  if(ampforwp_get_setting('swift-menu') == true){
	  register_nav_menus(
			array(
			  'amp-footer-menu' => esc_html__( 'AMP Footer Menu','accelerated-mobile-pages' ),
			)
		);	
	}
	}
	add_action( 'init', 'ampforwp_menu' );
}

// 1.2 Footer Menu	
add_action( 'init', 'ampforwp_footermenu' );
if ( ! function_exists( 'ampforwp_footermenu') ) {
	function ampforwp_footermenu() {
		register_nav_menus(
			array(
			  'amp-footer-menu' => esc_html__( 'AMP Footer Menu','accelerated-mobile-pages' ),
			)
		);
	}
}


// 2. Newsletter code
require_once( AMPFORWP_PLUGIN_DIR . '/includes/newsletter.php' );

// 3. Some Extra Styling for Admin area
// Moved to functions.php 

add_action( 'admin_enqueue_scripts', 'ampforwp_add_admin_upgread_script' );
function ampforwp_add_admin_upgread_script($hook){
	if('toplevel_page_amp_options'==$hook){
		wp_enqueue_script( 'ampforwp_admin_module_upgreade', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/module-upgrade.js', array( 'jquery', 'updates' ), AMPFORWP_VERSION, true );
	}
}
/* 
 * If WP version is greater then 5.3 then add a custom class in the body 
*/
add_filter('admin_body_class', 'ampforwp_custom_admin_body_class', 11);
function ampforwp_custom_admin_body_class($classes){
	global $wp_version;
	if (version_compare( $wp_version, '5.3', '>=') ){
		$classes .= ' new-wp-version ';
	}
	return $classes;
}?>