<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: Accelerated Mobile Pages for WordPress
Version: 0.7.7
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: http://ampforwp.com/
License: GPL2
*/
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Load the core class
require_once( dirname( __FILE__ ) . '/admin/ampwp-core.php' );
if ( class_exists( 'Ampwp_core' ) ) {
	// New AmpWP object
	$ampwp_core = new Ampwp_core;

	// Shut down the plugin on deactivation for old versions of WordPress
	register_deactivation_hook( __FILE__, array( &$ampwp_core, 'ampwp_load_deactivation' ) );
 
	// Start a session if not started already
	if ( ! session_id() ) {
		@session_start();
	}
	// Initialize the AmpWP check logic and rendering
	$ampwp_core->ampwp_load_site();	
}

/*
 * Add "amphtml" in the main theme to target it to the AMP page 
*/
add_action( 'wp_head', 'ampwp_rel_info_on_off',2 );
function ampwp_rel_info_on_off() { 
	global $redux_builder_amp;
	$current_page_id	= get_queried_object_id(); 

	// Hide AMPHTML on Specific Pages
	$amp_pages = $redux_builder_amp['amp-multi-select-pages'];
	if ( $amp_pages ) {
		foreach($amp_pages as $i => $item) {
			$hide_on_pages = $item;
			if ( $hide_on_pages == $current_page_id ) {
		    	remove_action( 'wp_head', 'ampwp_add_rel_info' );
			}
		}
	}
	// Hide AMPHTML on Specific Posts
	$amp_posts = $redux_builder_amp['amp-multi-select-posts'];
	if ( $amp_posts ) {
		foreach($amp_posts as $i => $item) {
			$hide_on_posts = $item;
			if ( $hide_on_posts == $current_page_id ) {
		    	remove_action( 'wp_head', 'ampwp_add_rel_info' );
			}
		}
	}
}

add_action( 'wp_head', 'ampwp_add_rel_info' );
function ampwp_add_rel_info() {

	$amp_url = trailingslashit( get_permalink() ); ?>
	<?php // TO DO: Add support for archives, and other parts and stuff..
    	if ( is_home() ) { ?>
    		<link rel="amphtml" href="<?php echo get_home_url(); ?>?amp" /> <?php 
    	} else { ?>
    		<link rel="amphtml" href="<?php echo $amp_url; ?>?amp" /> <?php 
    	}
}


// Registering Custom AMP menu for this plugin
if (! function_exists( 'register_amp_menu') ) {
	function register_amp_menu() {
        add_theme_support( 'custom-logo' );

	  register_nav_menus(
	    array(
	      'amp-menu' => __( 'AMP Menu' ),
	    )
	  );
	}
	add_action( 'init', 'register_amp_menu' );
}
require_once( dirname( __FILE__ ) . '/options/admin-init.php' );
require_once( dirname( __FILE__ ) . '/admin/ampwp-newsletter.php' );
?>