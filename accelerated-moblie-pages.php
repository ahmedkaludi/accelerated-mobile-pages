<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP Toolbox - Accelerated Mobile Pages for WordPress
Version: 0.8.5.3
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: http://ampforwp.com/
License: GPL2
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Rewrite the Endpoints after the plugin is activate, as priority is set to 11
function ampforwp_add_custom_post_support() {

	add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK | EP_PAGES | EP_ROOT );
	add_post_type_support( 'page', AMP_QUERY_VAR );

}
add_action( 'init', 'ampforwp_add_custom_post_support',11);

define('AMPFORWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

/* 
 * Load Files only in the backend 
 * As we don't need plugin activation code to run everytime the site loads
 */
if ( is_admin()) {
	require_once AMPFORWP_PLUGIN_DIR . '/classes/class-tgm-plugin-activation.php';
}

if ( ! class_exists( 'Ampforwp_Init', false ) ) {
	class Ampforwp_Init {

		public function __construct(){

			// Load Files required for the plugin to run 
			require AMPFORWP_PLUGIN_DIR .'/includes/includes.php';

			require AMPFORWP_PLUGIN_DIR .'/classes/class-init.php';
			new Ampforwp_Loader;	
			
		}
	}
}
/* 
 * Start the plugin.
 * Gentlemen start your engines
 */
function ampforwp_plugin_init() {
	if ( defined( 'AMP__FILE__' ) && defined('AMPFORWP_PLUGIN_DIR') ) {
		new Ampforwp_Init;
	}
}
add_action('init','ampforwp_plugin_init',9);