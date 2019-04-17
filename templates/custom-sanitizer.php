<?php
use AMPforWP\AMPVendor\AMP_DOM_Utils;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once( AMP__VENDOR__DIR__ . '/includes/utils/class-amp-dom-utils.php' );
require_once( AMP__VENDOR__DIR__ . '/includes/sanitizers/class-amp-base-sanitizer.php' );
require_once( AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php' );
require_once( AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-playlist-embed-handler.php' );

class AMPFORWP_Content {
	private $content;
	private $amp_content = '';
	public $amp_scripts = array();
	private $amp_styles = array();
	private $args = array();
	private $embed_handler_classes = array();
	private $sanitizer_classes = array();

	public function __construct( $content, $embed_handler_classes, $sanitizer_classes, $args = array() ) {
		$this->content = $content;
		$this->args = $args;
		$this->embed_handler_classes = $embed_handler_classes;
		$this->sanitizer_classes = $sanitizer_classes;

		$this->transform();
	}

	public function get_amp_content() {
		return $this->amp_content;
	}

	public function get_amp_scripts() {
		return $this->amp_scripts;
	}

	public function get_amp_styles() {
		return $this->amp_styles;
	}

	private function transform() {
		$content = $this->content;

		// // First, embeds + the_content filter
		$embed_handlers = $this->register_embed_handlers();
		$content = apply_filters( 'ampforwp_the_content', $content );
		$this->unregister_embed_handlers( $embed_handlers );

		// Then, sanitize to strip and/or convert non-amp content
		$content = $this->sanitize( $content );

		$this->amp_content = $content;
	}

	private function add_scripts( $scripts ) {
		$this->amp_scripts = array_merge( $this->amp_scripts, $scripts );
	}

	private function add_styles( $styles ) {
		$this->amp_styles = array_merge( $this->amp_styles, $styles );
	}

	private function register_embed_handlers() {
		$embed_handlers = array();

		foreach ( $this->embed_handler_classes as $embed_handler_class => $args ) {
			if ( class_exists('AMPforWP\\AMPVendor\\'.$embed_handler_class) ) {
				$embed_handler_class = 'AMPforWP\\AMPVendor\\'.$embed_handler_class;
			}
			$embed_handler = new $embed_handler_class( array_merge( $this->args, $args ) );

			if ( ! is_subclass_of( $embed_handler, 'AMPforWP\\AMPVendor\\AMP_Base_Embed_Handler' ) ) {
				_doing_it_wrong( __METHOD__, sprintf( esc_html__( 'Embed Handler (%s) must extend `AMP_Embed_Handler`', 'accelerated-mobile-pages' ), esc_html($embed_handler_class) ), '0.1' );
				continue;
			}

			$embed_handler->register_embed();
			$embed_handlers[] = $embed_handler;
		}

		return $embed_handlers;
	}

	private function unregister_embed_handlers( $embed_handlers ) {
		foreach ( $embed_handlers as $embed_handler ) {
			 $this->add_scripts( $embed_handler->get_scripts() );
			 $embed_handler->unregister_embed();
		}
	}

	private function sanitize( $content ) {
		list( $sanitized_content, $scripts, $styles ) = AMPFORWP_Content_Sanitizer::sanitize( $content, $this->sanitizer_classes, $this->args );

		$this->add_scripts( $scripts );
		$this->add_styles( $styles );

		return $sanitized_content;
	}
}

class AMPFORWP_Content_Sanitizer {
	public static function sanitize( $content, $sanitizer_classes, $global_args = array() ) {
		$scripts = array();
		$styles = array();
		$dom = AMP_DOM_Utils::get_dom_from_content( $content );

		foreach ( $sanitizer_classes as $sanitizer_class => $args ) {
				if ( class_exists('AMPforWP\\AMPVendor\\'.$sanitizer_class) ) {
					$sanitizer_class = 'AMPforWP\\AMPVendor\\'.$sanitizer_class;
					$amp_base_sanitizer = 'AMPforWP\\AMPVendor\\AMP_Base_Sanitizer';
				}
				elseif(function_exists('amp_activate') && class_exists('AMP_Base_Sanitizer') ) {
					$amp_base_sanitizer = 'AMP_Base_Sanitizer';
				}
				if ( ! class_exists( $sanitizer_class ) ) {
					_doing_it_wrong( __METHOD__, sprintf( esc_html__( 'Sanitizer (%s) class does not exist', 'accelerated-mobile-pages' ), esc_html( $sanitizer_class ) ), '0.4.1' );
					continue;
				}

				$sanitizer = new $sanitizer_class( $dom, array_merge( $global_args, $args ) );
				if ( ! is_subclass_of( $sanitizer, $amp_base_sanitizer) ) {
					_doing_it_wrong( __METHOD__, sprintf( esc_html__( 'Sanitizer (%s) must extend `AMP_Base_Sanitizer`', 'accelerated-mobile-pages' ), esc_html( $sanitizer_class ) ), '0.1' );
					continue;
				}


			$sanitizer->sanitize();

			$scripts = array_merge( $scripts, $sanitizer->get_scripts() );
			$styles = array_merge( $styles, $sanitizer->get_styles() );
		}

		$sanitized_content = AMP_DOM_Utils::get_content_from_dom( $dom );

		return array( $sanitized_content, $scripts, $styles );
	}
}