<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Ampforwp_Loader', false ) ) {
	class Ampforwp_Loader {
		public function __construct() {
			$this->load_required_files();
		}
		public function load_required_files() {
			require AMPFORWP_PLUGIN_DIR . '/templates/features.php';
		}
	}
} ?>