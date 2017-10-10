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
	if (! function_exists( 'ampforwp_footermenu') ) {
		function ampforwp_footermenu() {
			global $redux_builder_amp;	 
			if ( isset($redux_builder_amp['amp-design-selector']) && ($redux_builder_amp['amp-design-selector'] == 1 ||
				 $redux_builder_amp['amp-design-selector'] == 2 || 
				 $redux_builder_amp['amp-design-selector'] == 3 )) {			
				register_nav_menus(
					array(
					  'amp-footer-menu' => __( 'AMP Footer Menu','accelerated-mobile-pages' ),
					)
				);
			}
		}
	}


// 2. Newsletter code
	require_once( AMPFORWP_PLUGIN_DIR . '/includes/newsletter.php' );

// 3. Some Extra Styling for Admin area
	add_action( 'admin_enqueue_scripts', 'ampforwp_add_admin_styling' );
	function ampforwp_add_admin_styling(){
		wp_register_style( 'ampforwp_admin_css', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'ampforwp_admin_css' );
	}
?>