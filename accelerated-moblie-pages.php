<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: Accelerated Mobile Pages for WordPress
Version: 0.7
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: http://AhmedKaludi.com/
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

function add_rel_info() { ?>
<link rel="amphtml" href="<?php the_permalink(); ?>/?amp" />
<?php }
add_action( 'wp_head', 'add_rel_info' );


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
?>