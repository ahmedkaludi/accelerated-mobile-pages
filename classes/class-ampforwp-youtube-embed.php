<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
use AMPforWP\AMPVendor\AMP_Base_Embed_Handler;
use AMPforWP\AMPVendor\AMP_HTML_Utils;
$file_path = AMP__VENDOR__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php';
if( file_exists($file_path) ){
	require_once $file_path;
}

// Much of this class is borrowed from Jetpack embeds
class AMPforWP_YouTube_Embed_Handler extends AMP_Base_Embed_Handler {
	const SHORT_URL_HOST = 'youtu.be';
	// Only handling single videos. Playlists are handled elsewhere.
	const URL_PATTERN = '#https?://(?:www\.)?(?:youtube.com/(?:v/|e/|embed/|watch[/\#?])|youtu\.be/).*#i';
	const RATIO = 0.5625;

	protected $DEFAULT_WIDTH = 600;
	protected $DEFAULT_HEIGHT = 338;

	private static $script_slug = 'amp-youtube';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-youtube-0.1.js';

	function __construct( $args = array() ) {
		parent::__construct( $args );

		if ( isset( $this->args['content_max_width'] ) ) {
			$max_width = $this->args['content_max_width'];
			$this->args['width'] = $max_width;
			$this->args['height'] = round( $max_width * self::RATIO );
		}
	}

	function register_embed() {
		wp_embed_register_handler( 'amp-youtube', self::URL_PATTERN, array( $this, 'oembed' ), -1 );
		add_shortcode( 'youtube', array( $this, 'shortcode' ) );
		add_filter( 'wp_video_shortcode_override', array( $this, 'video_override') , 10, 2 );
	}

	public function unregister_embed() {
		wp_embed_unregister_handler( 'amp-youtube', -1 );
		remove_shortcode( 'youtube' );
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
		} elseif ( function_exists ( 'ampforwp_youtube_shortcode' ) ) {
			$url = ampforwp_youtube_shortcode( $attr );
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

		$this->did_convert_elements = true;
		// Return it with a filter for the modification purpose #1378
		$attrs = array(
				'data-videoid' => $args['video_id'],
				'layout' => 'responsive',
				'width' => $this->args['width'],
				'height' => $this->args['height'],
				);
		if(ampforwp_get_setting('ampforwp-amp-video-docking')==true){
				$attrs['dock'] = '#dock-slot';
		}
		if(ampforwp_get_setting('ampforwp-amp-video-lightbox')==true){
				$attrs['autoplay'] = true;
		}
		$attrs = ampforwp_amp_consent_check( $attrs );
		return AMP_HTML_Utils::build_tag('amp-youtube',apply_filters('amp_youtube_params', $attrs) );
	}

	private function get_video_id_from_url( $url ) {
		$video_id = false;
		$parsed_url = parse_url( $url );
		if(!isset($parsed_url['host'])){
			$parsed_url['host'] = '';
		}
		if ( self::SHORT_URL_HOST === substr( $parsed_url['host'], -strlen( self::SHORT_URL_HOST ) ) ) {
			// youtu.be/{id}
			$parts = explode( '/', $parsed_url['path'] );
			if ( ! empty( $parts ) ) {
				$video_id = $parts[1];
			}
		} else {
			// ?v={id} or ?list={id}
			if(isset($parsed_url['query'])){
			  parse_str( $parsed_url['query'], $query_args );
		    }

			if ( isset( $query_args['v'] ) ) {
				$video_id = $this->sanitize_v_arg( $query_args['v'] );
			}
		}

		if ( empty( $video_id ) ) {
			// /(v|e|embed)/{id}
			$parts = explode( '/', $parsed_url['path'] );

			if ( in_array( $parts[1], array( 'v', 'e', 'embed' ) ) ) {
				$video_id = $parts[2];
			}
		}

		return $video_id;
	}

	private function sanitize_v_arg( $value ) {
		// Deal with broken params like `?v=123?rel=0`
		if ( false !== strpos( $value, '?' ) ) {
			$value = strtok( $value, '?' );
		}

		return $value;
	}
	/**
	 * Override the output of YouTube videos.
	 *
	 * This overrides the value in wp_video_shortcode().
	 * The pattern matching is copied from WP_Widget_Media_Video::render().
	 *
	 * @param string $html Empty variable to be replaced with shortcode markup.
	 * @param array  $attr The shortcode attributes.
	 * @return string|null $markup The markup to output.
	 */
	public function video_override( $html, $attr ) {
		if ( ! isset( $attr['src'] ) ) {
			return $html;
		}
		$src             = $attr['src'];
		$youtube_pattern = '#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#';
		if ( 1 === preg_match( $youtube_pattern, $src ) ) {
			return $this->shortcode( [ $src ] );
		}
		return $html;
	}
}