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
add_action( 'admin_enqueue_scripts', 'ampforwp_add_admin_styling' );
function ampforwp_add_admin_styling(){
	global $redux_builder_amp;
	// Style file to add or modify css inside admin area
	wp_register_style( 'ampforwp_admin_css', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/admin-style.css', false, AMPFORWP_VERSION );
    wp_enqueue_style( 'ampforwp_admin_css' );

    // Admin area scripts file
	wp_register_script( 'ampforwp_admin_js', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/admin-script.js', false, AMPFORWP_VERSION );

	// Localize the script with new data
    wp_localize_script( 'ampforwp_admin_js', 'redux_data', $redux_builder_amp );
    wp_localize_script( 'ampforwp_admin_js', 'ampforwp_nonce', wp_create_nonce('ampforwp-verify-request') );

    wp_enqueue_script( 'ampforwp_admin_js' );
}

add_action( 'admin_enqueue_scripts', 'ampforwp_add_admin_upgread_script' );
function ampforwp_add_admin_upgread_script($hook){
	if('toplevel_page_amp_options'==$hook){
		wp_enqueue_script( 'ampforwp_admin_module_upgreade', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/module-upgrade.js', array( 'jquery', 'updates' ), AMPFORWP_VERSION, true );
	}
}
 ?>