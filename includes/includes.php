<?php
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
	      'amp-menu' => __( 'AMP Menu','accelerated-mobile-pages' ),
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
			  'amp-footer-menu' => __( 'AMP Footer Menu','accelerated-mobile-pages' ),
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

    wp_enqueue_script( 'ampforwp_admin_js' );
}

// 73. View AMP Site below View Site In Dashboard #1076
add_action( 'admin_bar_menu', 'ampforwp_visit_amp_in_admin_bar',999 );
function ampforwp_visit_amp_in_admin_bar($admin_bar) {
	$get_permalink_structure = get_option('permalink_structure');
	if ( $get_permalink_structure ) {
		$url = get_home_url().'/' . AMPFORWP_AMP_QUERY_VAR;
	} else {
		$url = get_home_url().'?amp=1';
	}
	$args = array(
	    'parent' => 'site-name',
	    'id'     => 'view-amp',
	    'title'  => 'Visit AMP',
	    'href'   =>  $url ,
	    'meta'   => false
	);
	$admin_bar->add_node( $args );       
}