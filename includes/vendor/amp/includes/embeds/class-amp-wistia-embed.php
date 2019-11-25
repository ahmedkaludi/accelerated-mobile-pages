<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php' );

class AMP_Wistia_Embed_Handler extends AMP_Base_Embed_Handler {
	const SHORT_URL_HOST = 'wistia.com';
	const URL_PATTERN = '#https?:\/\/(?:www|support|fast|(.*?))\.wistia\.com/(?:v/|embed/|medias/)(?:medias/)?#i';
	const RATIO = 0.5625;

	protected $DEFAULT_WIDTH = 512;
	protected $DEFAULT_HEIGHT = 360;

	private static $script_slug = 'amp-wistia-player';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-wistia-player-0.1.js';

	function __construct( $args = array() ) {
		parent::__construct( $args );

		if ( isset( $this->args['content_max_width'] ) ) {
			$max_width = $this->args['content_max_width'];
			$this->args['width'] = $max_width;
			$this->args['height'] = round( $max_width * self::RATIO );
		}
	}

	function register_embed() {
		wp_embed_register_handler( 'amp-wistia-player', self::URL_PATTERN, array( $this, 'oembed' ), -1 );
		add_shortcode( 'wistia', array( $this, 'shortcode' ) );
	}

	public function unregister_embed() {
		wp_embed_unregister_handler( 'amp-wistia-player', -1 );
		remove_shortcode( 'wistia' );
	}

	public function get_scripts() {
		if ( ! $this->did_convert_elements ) {
			return array();
		}

		return array( self::$script_slug => self::$script_src );
	}

	public function shortcode( $attr ) {
		$url = false;
		$video_id = false;
		if ( isset( $attr[0] ) ) {
			$url = ltrim( $attr[0] , '=' );
		} elseif ( function_exists( 'shortcode_new_to_old_params' ) ) {
			$url = shortcode_new_to_old_params( $attr );
		}

		if ( empty( $url ) ) {
			return '';
		}

		$video_id = $this->get_video_id_from_url( $url );

		return $this->render( array(
			'url' => $url,
			'video_id' => $video_id,
		) );
	}

	public function oembed( $matches, $attr, $url, $rawattr ) {
		return $this->shortcode( array( $url ) );
	}

	public function render( $args ) {
		$args = wp_parse_args( $args, array(
			'video_id' => false,
		) );

		if ( empty( $args['video_id'] ) ) {
			return AMP_HTML_Utils::build_tag( 'a', array( 'href' => esc_url( $args['url'] ), 'class' => 'amp-wp-embed-fallback' ), esc_html( $args['url'] ) );
		}

		if ( checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) {
			$this->did_convert_elements = false;
		} else {
			$this->did_convert_elements = true;
		}
		
		$attrs = array(
				'data-media-hashed-id' => $args['video_id'],
				'width' => $this->args['width'],
				'height' => $this->args['height'],
				'layout' => 'responsive',
			);
		$attrs = ampforwp_amp_consent_check($attrs);
		return AMP_HTML_Utils::build_tag(
			'amp-wistia-player',$attrs);
	}

	private function get_video_id_from_url( $url ) {
		$video_id = false;
		$parsed_url = parse_url( $url );

		if ( self::SHORT_URL_HOST === substr( $parsed_url['host'], -strlen( self::SHORT_URL_HOST ) ) ) {
			$parts = explode( '/', $parsed_url['path'] );
			if ( ! empty( $parts ) ) {
				$video_id = end($parts);
			}
		}

		return $video_id;
	}
}
