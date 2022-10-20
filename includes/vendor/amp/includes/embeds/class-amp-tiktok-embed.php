<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php' );

class AMP_Tiktok_Embed_Handler extends AMP_Base_Embed_Handler {
	const URL_PATTERN = '#https?://(www\.)?tiktok\.com\/@.*?\/video\/(\d+)#i';

	protected $DEFAULT_WIDTH = 325;
	protected $DEFAULT_HEIGHT = 575;

	private static $script_slug = 'amp-tiktok-page';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-tiktok-0.1.js';

	public function register_embed() {
		wp_embed_register_handler( 'amp-tiktok-page', self::URL_PATTERN, array( $this, 'oembed' ), -1 );
	}

	public function unregister_embed() {
		wp_embed_unregister_handler( 'amp-tiktok-page', -1 );
	}

	public function get_scripts() {
		if ( ! $this->did_convert_elements ) {
			return array();
		}

		return array( self::$script_slug => self::$script_src );
	}

	public function oembed( $matches, $attr, $url, $rawattr ) {
		$src=isset($matches[2])?$matches[2]:'';
		return $this->render( array( 'src' => $src ) );
	}

	public function render( $args ) {
		$args = wp_parse_args( $args, array(
			'src' => false,
		) );

		if ( empty( $args['src'] ) ) {
			return '';
		}

		$this->did_convert_elements = true;
		$attrs = array(
				'data-src' => $args['src'],
				'width' => $this->args['width'],
				'height' => $this->args['height'],
			);
		$attrs = ampforwp_amp_consent_check( $attrs );
		return AMP_HTML_Utils::build_tag('amp-tiktok',$attrs);
	}
}
