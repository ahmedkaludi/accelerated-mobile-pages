<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php' );

// Much of this class is borrowed from Jetpack embeds
class AMP_Reddit_Embed_Handler extends AMP_Base_Embed_Handler {
	const URL_PATTERN = '#http(s|):\/\/www.reddit\.com(\/\#\!\/|\/)([a-zA-Z0-9_]{1,20})\/(.*?)\/comments\/([a-zA-Z0-9_]{1,20})\/([a-zA-Z0-9_]{1,20})#i';

	private static $script_slug = 'amp-reddit';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-reddit-0.1.js';

	public function register_embed() {
		add_shortcode( 'reddit', array( $this, 'shortcode' ) );
		wp_embed_register_handler( 'amp-reddit', self::URL_PATTERN, array( $this, 'oembed' ), -1 );
	}

	public function unregister_embed() {
		remove_shortcode( 'reddit' );
		wp_embed_unregister_handler( 'amp-reddit', -1 );
	}

	public function get_scripts() {
		if ( ! $this->did_convert_elements ) {
			return array();
		}

		return array( self::$script_slug => self::$script_src );
	}

	function shortcode( $attr ) {
		$attr = wp_parse_args( $attr, array(
			'reddit' => false,
		) );

		if ( empty( $attr['reddit'] ) && ! empty( $attr[0] ) ) {
			$attr['reddit'] = $attr[0];
		}

		$url = false;
		preg_match( self::URL_PATTERN, $attr['reddit'], $matches );
		if ( isset( $matches[0] )) {
			$url = $matches[0];
		}

		if ( empty( $url ) ) {
			return '';
		}
		$this->did_convert_elements = true;
		$attrs = array(
				'data-src' => $url,
				'layout' => 'responsive',
				'width' => $this->args['width'],
				'height' => $this->args['height'],
				'data-embedtype'=>"post"
			);
		$attrs = ampforwp_amp_consent_check( $attrs );
		return AMP_HTML_Utils::build_tag('amp-reddit',$attrs);
	}

	function oembed( $matches, $attr, $url, $rawattr ) {
		$url = false;

		if ( isset( $matches[0] )) {
			$url = $matches[0];
		}

		if ( ! $url ) {
			return '';
		}

		return $this->shortcode( array( 'reddit' => $url ) );
	}
}
