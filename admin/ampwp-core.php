<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Ampwp_core' ) ) {
	/**
	 * The core AmpWP class where the magic happens
	 *
	 * @package AmpWP
	 * @since 1.0
	 */
	class Ampwp_core {

		/**
		 * Deactivates the plugin
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function ampwp_load_deactivation() {
			// Shutdown this plugin (nothing here for now)
		}
		/**
		 * Does the checks and decides whether to render a mobile or normal website
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function ampwp_load_site() {

			// Check whether to show the AMP version or not.
			// Checks if the user is in the dashboard, then reset the layout to normal view and Deactivates AMP layout.
			if ( is_admin() ) {

				session_unset();
				session_destroy();
				$_SESSION['AMPWP_MOBILE_ACTIVE']		= '';
				$_SESSION['AMPWP_MOBILE_BROWSER']	= '';
				$_SESSION['AMPWP_MOBILE_THEME']		= '';

			} else {

				if ( ( isset( $_GET['killsession'] ) ) ) {
					session_unset();
					session_destroy();
					$_SESSION['AMPWP_MOBILE_ACTIVE']		= '';
					$_SESSION['AMPWP_MOBILE_BROWSER']	= '';
					$_SESSION['AMPWP_MOBILE_THEME']		= '';
				}

				// Check if mobile sesison var exists
				// Also, check if ?amp or ?noamp is set. If so, establish the session var so that subsequent page calls will render in the desired mode.
				if ( ( ! isset( $_SESSION['AMPWP_MOBILE_ACTIVE'] ) || ( trim( $_SESSION['AMPWP_MOBILE_ACTIVE'] ) == '') ) || ( isset( $_GET['amp'] ) ) || ( isset( $_GET['noamp'] ) ) ) {
					require_once( dirname( __FILE__ ) . '/ampwp-check.php' );
					$ampwp_check = new AmpWP_check;
					$ampwp_check->ampwp_detect_device();
				}

				if ( $_SESSION['AMPWP_MOBILE_ACTIVE'] === TRUE ) {
					// Double check session var for theme, fall back on default if any problems
					if ( ! isset( $_SESSION['AMPWP_MOBILE_THEME'] ) || ( trim( $_SESSION['AMPWP_MOBILE_THEME'] ) == '') ) {
						$_SESSION['AMPWP_MOBILE_THEME']		=  'default';
					}
	 
					require_once( dirname( __FILE__ ) . '/ampwp-render.php' );

					$ampwp_render = new AmpWP_render();
					$ampwp_render->ampwp_render_theme();
				}
			}
		}
	}
}