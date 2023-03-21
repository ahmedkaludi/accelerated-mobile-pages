<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Callbacks for adding AMP-related things to the admin.

define( 'AMP_VENDOR_CUSTOMIZER_QUERY_VAR', 'customize_amp' );

/**
 * Sets up the AMP template editor for the Customizer.
 */
function amp_init_customizer() {
	require_once( AMP__VENDOR__DIR__ . '/includes/admin/class-amp-customizer.php' );

        /**
         * Yuki Theme Compatibility
         * for updating code which 
         * theme not doing
         * @since 1.0.82
         */
		
        if( ('Yuki' == apply_filters( 'current_theme', get_option( 'current_theme' ) )) || ('Yuki Blogger' == apply_filters( 'current_theme', get_option( 'current_theme' ) ))  ) {
            if ( ! class_exists( '_WP_Editors' ) )
                require( ABSPATH . WPINC . '/class-wp-editor.php' );
        }
        
	// Drop core panels (menus, widgets) from the AMP customizer
	add_filter( 'customize_loaded_components', array( 'AMPforWP\\AMPVendor\\AMP_Template_Customizer', '_unregister_core_panels' ) );

	// Fire up the AMP Customizer
	add_action( 'customize_register', array( 'AMPforWP\\AMPVendor\\AMP_Template_Customizer', 'init' ), 500 );

	// Add some basic design settings + controls to the Customizer
	add_action( 'amp_init', array( 'AMPforWP\\AMPVendor\\AMP_Customizer_Design_Settings', 'init' ) );

	// Add a link to the Customizer
	add_action( 'admin_menu', 'AMPforWP\\AMPVendor\\amp_add_customizer_link' );
}

/**
 * Registers a submenu page to access the AMP template editor panel in the Customizer.
 */
function amp_add_customizer_link() {
	// Teensy little hack on menu_slug, but it works. No redirect!
	$menu_slug = add_query_arg( array(
		'autofocus[panel]'         => AMP_Template_Customizer::PANEL_ID,
		'return'                   => rawurlencode( admin_url() ),
		AMP_VENDOR_CUSTOMIZER_QUERY_VAR   => true,
	), 'customize.php' );

	// Add the theme page.
	$page = add_theme_page(
		esc_html__( 'AMP', 'accelerated-mobile-pages' ),
		esc_html__( 'AMP', 'accelerated-mobile-pages' ),
		'edit_theme_options',
		$menu_slug
	);
}

function amp_admin_get_preview_permalink() {
	/**
	 * Filter the post type to retrieve the latest of for use in the AMP template customizer.
	 *
	 * @param string $post_type Post type slug. Default 'post'.
	 */
	$post_type = (string) apply_filters( 'amp_customizer_post_type', 'post' );

	if ( ! post_type_supports( $post_type, 'amp' ) ) {
		return;
	}

	$post_ids = get_posts( array(
		'post_status'      => 'publish',
		'post_type'        => $post_type,
		'posts_per_page'   => 1,
		'fields'           => 'ids',
	) );

	if ( empty( $post_ids ) ) {
		return false;
	}

	$post_id = $post_ids[0];

	return amp_get_permalink( $post_id );
}
