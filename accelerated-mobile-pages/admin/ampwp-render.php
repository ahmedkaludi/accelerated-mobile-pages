<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'AmpWP_render' ) ) {
	/**
	 * Class that deals with all aspects of rendering the mobile website
	 *
	 * @package AmpWP
	 * @since 1.0
	 */
	class AmpWP_render {

		/**
		 * Initialize the rendering of the mobile website
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function ampwp_render_theme() {
			// Apply theme filters
			add_filter( 'theme_root', array( &$this, 'ampwp_set_theme_root' ) );
			add_filter( 'theme_root_uri', array (&$this, 'ampwp_set_theme_uri' ) );
			add_filter( 'template', array( &$this, 'ampwp_set_template' ) );
		}

		/**
		 * Sets the blogs template to the AmpWP template
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function ampwp_set_template() {
			return $_SESSION['AMPWP_MOBILE_THEME'];
		}

		/**
		 * Sets the theme root to the AmpWP theme directory
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function ampwp_set_theme_root() {
			return WP_CONTENT_DIR . '/plugins/accelerated-mobile-pages/themes/' ;
		}

		/**
		 * Sets the path to the themes directory
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function ampwp_set_theme_uri() {
			return WP_CONTENT_DIR . '/wp-content' . '/plugins/accelerated-mobile-pages/themes/';
		}
	}
}