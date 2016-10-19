<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP Toolbox - Accelerated Mobile Pages for WordPress
Version: 0.8.7 Beta
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: http://ampforwp.com/
Donate link: https://www.paypal.me/Kaludi/5
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



add_action('amp_customizer_init','ampforwp_add_new_controls');

function ampforwp_add_new_controls(){

	add_action('amp_customizer_register_settings','ampforwp_customizer_settings');

	add_action('amp_customizer_register_ui','ampforwp_register_customizer_ui');
}

function ampforwp_customizer_settings( $wp_customize) {

	// New Color Option Created
	$wp_customize->add_setting( 'ampforwp[ampforwp_color]', array(
		'type'              => 'option',
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage'
	) );


	// New Color Option Created
	$wp_customize->add_setting( 'ampforwp_customizer[style]', array(
		'type'              => 'option',
		'default'			=> 'three',
		'transport'         => 'postMessage'
	) );

}




function ampforwp_register_customizer_ui( $wp_customize ) {
	// Header text color control.
	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'ampforwp_header_color', array(
			'settings'   => 'ampforwp[ampforwp_color]',
			'label'    => __( 'New Control', 'amp' ),
			'section'  => 'amp_design',
			'priority' => 10
		) )
	);


	// Background color scheme
	$wp_customize->add_control( 'ampforwp_color_scheme', array(
		'settings'   => 'ampforwp_customizer[style]',
		'label'      => __( 'design Contols', 'amp' ),
		'section'    => 'amp_design',
		'type'       => 'radio',
		'priority'   => 40,
		'choices'    => new_radio_controls(),
	));

}

function new_radio_controls(){
	return array(
			'light'   => __( 'one', 'amp'),
			'dark'    => __( 'two', 'amp' ),
			'three'    => __( 'three', 'amp' ),
	);
}


	// function register_customizer_ui( $wp_customize ) {
		

	

	// 	// Header background color control.
	// 	$wp_customize->add_control(
	// 		new WP_Customize_Color_Control( $wp_customize, 'amp_header_background_color', array(
	// 			'settings'   => 'amp_customizer[header_background_color]',
	// 			'label'    => __( 'Header Background & Link Color', 'amp' ),
	// 			'section'  => 'amp_design',
	// 			'priority' => 20
	// 		) )
	// 	);

	// 	// Background color scheme
	// 	$wp_customize->add_control( 'amp_color_scheme', array(
	// 		'settings'   => 'amp_customizer[color_scheme]',
	// 		'label'      => __( 'Color Scheme', 'amp' ),
	// 		'section'    => 'amp_design',
	// 		'type'       => 'radio',
	// 		'priority'   => 30,
	// 		'choices'    => self::get_color_scheme_names(),
	// 	));
	// }
