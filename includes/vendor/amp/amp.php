<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Plugin Name: AMP
 * Description: Add AMP support to your WordPress site.
 * Plugin URI: https://github.com/automattic/amp-wp
 * Author: Automattic
 * Author URI: https://automattic.com
 * Version: 0.4.2
 * Text Domain: amp
 * License: GPLv2 or later
 */
// Make sure the `amp` query var has an explicit value.
// Avoids issues when filtering the deprecated `query_string` hook.
if ( ! function_exists('AMPforWP\\AMPVendor\\amp_force_query_var_value') ) {
	function amp_force_query_var_value( $query_vars ) {
		if ( isset( $query_vars[ AMP_QUERY_VAR ] ) && '' === $query_vars[ AMP_QUERY_VAR ] ) {
			$query_vars[ AMP_QUERY_VAR ] = 1;
		}
		return $query_vars;
	}
}


if ( ! function_exists('AMPforWP\\AMPVendor\\amp_maybe_add_actions') ) {
	function amp_maybe_add_actions() {
		if ( ! is_singular() || is_feed() ) {
			return;
		}

		$is_amp_endpoint = is_amp_endpoint();

		// Cannot use `get_queried_object` before canonical redirect; see https://core.trac.wordpress.org/ticket/35344
		global $wp_query;
		$post = $wp_query->post;

		$supports = post_supports_amp( $post );

		if ( ! $supports ) {
			if ( $is_amp_endpoint ) {
				wp_safe_redirect( get_permalink( $post->ID ) , 301);
				exit;
			}
			return;
		}

		if ( $is_amp_endpoint ) {
			amp_prepare_render();
		} else {
			amp_add_frontend_actions();
		}
	}
}

if ( ! function_exists('AMPforWP\\AMPVendor\\amp_load_classes') ) {
	function amp_load_classes() {
		require_once( AMP__VENDOR__DIR__ . '/includes/class-amp-post-template.php' ); // this loads everything else
	}
}

if ( ! function_exists('AMPforWP\\AMPVendor\\amp_add_frontend_actions') ) {
	function amp_add_frontend_actions() {
		require_once( AMP__VENDOR__DIR__ . '/includes/amp-frontend-actions.php' );
	}
}

if ( ! function_exists('AMPforWP\\AMPVendor\\amp_add_post_template_actions') ) {
	function amp_add_post_template_actions() {
		require_once( AMP__VENDOR__DIR__ . '/includes/amp-post-template-actions.php' );
		require_once( AMP__VENDOR__DIR__ . '/includes/amp-post-template-functions.php' );
	}
}
if ( ! function_exists('AMPforWP\\AMPVendor\\amp_prepare_render') ) {
	function amp_prepare_render() {
		add_action( 'template_redirect', 'AMPforWP\\AMPVendor\\amp_render' );
	}
}
if ( ! function_exists('AMPforWP\\AMPVendor\\amp_render') ) {
	function amp_render() {
		amp_load_classes();
		$post_id = get_queried_object_id();
		do_action( 'pre_amp_render_post', $post_id );
		$post = get_queried_object();
		if ( $post instanceof WP_Post && function_exists('amp_activate')) {
			amp_render_post( $post );
			exit;
		}
		if ( !function_exists('amp_activate')) {
		global $ampforwpTemplate;
		amp_add_post_template_actions();
		$template = $ampforwpTemplate = new AMP_Post_Template( $post_id );
		$template->load();
		// Set Header: last modified information
		$last_modified = true;
		$last_modified = apply_filters('ampforwp_update_last_modified_header', $last_modified);
		if( is_singular() && $post_id && $last_modified) {
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	    }
		exit;
		}
	}
}
/**
 * Bootstraps the AMP customizer.
 *
 * If the AMP customizer is enabled, initially drop the core widgets and menus panels. If the current
 * preview page isn't flagged as an AMP template, the core panels will be re-added and the AMP panel
 * hidden.
 *
 * @internal This callback must be hooked before priority 10 on 'plugins_loaded' to properly unhook
 *           the core panels.
 *
 * @since 0.4
 */
if ( ! function_exists('AMPforWP\\AMPVendor\\_amp_bootstrap_customizer') ) {
	function _amp_bootstrap_customizer() {
		/**
		 * Filter whether to enable the AMP template customizer functionality.
		 *
		 * @param bool $enable Whether to enable the AMP customizer. Default true.
		 */
		$amp_customizer_enabled = apply_filters( 'amp_customizer_is_enabled', true );

		if ( true === $amp_customizer_enabled ) {
			amp_init_customizer();
		}
	}
	add_action( 'plugins_loaded', 'AMPforWP\\AMPVendor\\_amp_bootstrap_customizer', 9 );
}