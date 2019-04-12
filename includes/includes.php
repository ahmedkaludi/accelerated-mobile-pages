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
	  register_nav_menus(
	    array(
	      'amp-menu' => esc_html__( 'AMP Menu','accelerated-mobile-pages' ),
	    )
	  );
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
 ?>