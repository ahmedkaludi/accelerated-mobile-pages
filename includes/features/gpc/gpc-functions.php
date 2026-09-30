<?php
/**
 * Global Privacy Control (GPC) support for AMP.
 *
 * Detects Sec-GPC via amp-consent checkConsentHref and serves /.well-known/gpc.json.
 *
 * @package AMPforWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether GPC compliance is enabled in settings.
 *
 * @return bool
 */
function ampforwp_is_gpc_enabled() {
	return (bool) ampforwp_get_setting( 'amp-gpc-compliance-switch' );
}

/**
 * Whether the current request includes an active GPC signal.
 *
 * @return bool
 */
function ampforwp_has_gpc_signal() {
	$has_gpc = false;

	if ( isset( $_SERVER['HTTP_SEC_GPC'] ) && (string) $_SERVER['HTTP_SEC_GPC'] === '1' ) {
		$has_gpc = true;
	}

	/**
	 * Filter whether the current request has an active GPC signal.
	 *
	 * @param bool $has_gpc Whether Sec-GPC / GPC is present.
	 */
	return (bool) apply_filters( 'ampforwp_has_gpc_signal', $has_gpc );
}

/**
 * Protocol-relative admin-ajax URL for amp-consent checkConsentHref.
 *
 * @return string
 */
function ampforwp_get_gpc_check_consent_url() {
	$url = admin_url( 'admin-ajax.php?action=ampforwp_check_consent' );
	$url = preg_replace( '#^https?:#', '', $url );
	return $url;
}

/**
 * Send AMP CORS headers for consent XHR endpoints.
 *
 * @return void
 */
function ampforwp_gpc_send_amp_cors_headers() {
	$site_url = wp_parse_url( home_url() );
	$amp_site = '';
	if ( ! empty( $site_url['scheme'] ) && ! empty( $site_url['host'] ) ) {
		$amp_site = $site_url['scheme'] . '://' . $site_url['host'];
	}

	$source_origin = $amp_site;
	if ( isset( $_REQUEST['__amp_source_origin'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$source_origin = esc_url_raw( wp_unslash( $_REQUEST['__amp_source_origin'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	}

	$origin = '';
	if ( ! empty( $_SERVER['HTTP_ORIGIN'] ) ) {
		$origin = esc_url_raw( wp_unslash( $_SERVER['HTTP_ORIGIN'] ) );
	}

	header( 'Content-Type: application/json' );
	if ( $origin ) {
		header( 'Access-Control-Allow-Origin: ' . $origin );
		header( 'Access-Control-Allow-Credentials: true' );
	}
	if ( $source_origin ) {
		header( 'AMP-Access-Control-Allow-Source-Origin: ' . esc_url_raw( $source_origin ) );
		header( 'Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin' );
	}
}

/**
 * Remote consent check used by amp-consent checkConsentHref.
 *
 * When GPC is present, auto-reject so data-block-on-consent keeps ads/analytics blocked.
 * When GDPR is also enabled, require consent for the EEA geo group (matchedGeoGroup).
 *
 * @return void
 */
function ampforwp_check_consent() {
	if ( ! ampforwp_is_gpc_enabled() ) {
		status_header( 403 );
		wp_send_json( array( 'error' => 'gpc_disabled' ), 403 );
	}

	ampforwp_gpc_send_amp_cors_headers();

	$raw_body = file_get_contents( 'php://input' );
	$body     = array();
	if ( is_string( $raw_body ) && $raw_body !== '' ) {
		$decoded = json_decode( $raw_body, true );
		if ( is_array( $decoded ) ) {
			$body = $decoded;
		}
	}

	$matched_geo = '';
	if ( ! empty( $body['matchedGeoGroup'] ) && is_string( $body['matchedGeoGroup'] ) ) {
		$matched_geo = sanitize_text_field( $body['matchedGeoGroup'] );
	}

	$response = array(
		'consentRequired' => false,
	);

	if ( ampforwp_has_gpc_signal() ) {
		$response = array(
			'consentRequired'   => true,
			'consentStateValue' => 'rejected',
			'expireCache'       => true,
			'consentString'     => 'GPC',
			'consentMetadata'   => array(
				'consentStringType' => 4, // GLOBAL_PRIVACY_PLATFORM
				'gppSectionId'      => 'GPC',
			),
		);
	} elseif ( ampforwp_get_setting( 'amp-gdpr-compliance-switch' ) && 'eea' === $matched_geo ) {
		// Mirror GDPR geoOverride: prompt EEA visitors when GPC did not already opt them out.
		$response = array(
			'consentRequired' => true,
		);
	}

	/**
	 * Filter the amp-consent checkConsentHref JSON response for GPC.
	 *
	 * @param array $response     Response payload.
	 * @param array $body         Decoded AMP POST body.
	 * @param string $matched_geo Geo group from amp-geo, if any.
	 */
	$response = apply_filters( 'ampforwp_gpc_check_consent_response', $response, $body, $matched_geo );

	echo wp_json_encode( $response );
	exit;
}
add_action( 'wp_ajax_ampforwp_check_consent', 'ampforwp_check_consent' );
add_action( 'wp_ajax_nopriv_ampforwp_check_consent', 'ampforwp_check_consent' );

/**
 * Serve /.well-known/gpc.json when GPC support is enabled.
 *
 * @return void
 */
function ampforwp_serve_gpc_json() {
	if ( ! ampforwp_is_gpc_enabled() ) {
		return;
	}

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	$path        = wp_parse_url( $request_uri, PHP_URL_PATH );
	if ( ! is_string( $path ) ) {
		return;
	}

	$path = untrailingslashit( $path );
	if ( substr( $path, -strlen( '/.well-known/gpc.json' ) ) !== '/.well-known/gpc.json'
		&& $path !== '/.well-known/gpc.json' ) {
		return;
	}

	$data = array(
		'gpc'        => true,
		'lastUpdate' => gmdate( 'Y-m-d' ),
	);

	/**
	 * Filter the contents of /.well-known/gpc.json.
	 *
	 * @param array $data Well-known GPC payload.
	 */
	$data = apply_filters( 'ampforwp_gpc_well_known_data', $data );

	status_header( 200 );
	header( 'Content-Type: application/json; charset=utf-8' );
	header( 'Cache-Control: public, max-age=86400' );
	echo wp_json_encode( $data );
	exit;
}
add_action( 'template_redirect', 'ampforwp_serve_gpc_json', 0 );

/**
 * Register amp-consent script for GPC-only mode (GDPR off).
 *
 * @param array $data AMP template data.
 * @return array
 */
function ampforwp_gpc_consent_scripts( $data ) {
	if ( empty( $data['amp_component_scripts']['amp-consent'] ) ) {
		$data['amp_component_scripts']['amp-consent'] = 'https://cdn.ampproject.org/v0/amp-consent-0.1.js';
	}
	return $data;
}

/**
 * Minimal amp-consent markup when GPC is on and GDPR is off.
 *
 * @return void
 */
function ampforwp_gpc_only_consent_output() {
	if ( ! ampforwp_is_gpc_enabled() ) {
		return;
	}
	if ( ampforwp_get_setting( 'amp-gdpr-compliance-switch' ) ) {
		return;
	}

	$check_url = ampforwp_get_gpc_check_consent_url();
	?>
	<amp-consent id="ampforwpConsent" layout="nodisplay">
		<script type="application/json"><?php
		echo wp_json_encode(
			array(
				'consentInstanceId' => 'ampforwp-consent',
				'consentRequired'   => 'remote',
				'checkConsentHref'  => $check_url,
			)
		);
		?></script>
	</amp-consent>
	<?php
}

/**
 * Bootstrap GPC-only consent UI and scripts when GDPR is disabled.
 *
 * @return void
 */
function ampforwp_gpc_init() {
	if ( ! ampforwp_is_gpc_enabled() ) {
		return;
	}

	// GDPR path already outputs amp-consent; only hook when GPC-only.
	if ( ampforwp_get_setting( 'amp-gdpr-compliance-switch' ) ) {
		return;
	}

	add_filter( 'amp_post_template_data', 'ampforwp_gpc_consent_scripts', 15 );
	add_action( 'amp_footer_link', 'ampforwp_gpc_only_consent_output' );
	if ( function_exists( 'is_plugin_active' ) && is_plugin_active( 'amp/amp.php' ) ) {
		add_action( 'amp_post_template_footer', 'ampforwp_gpc_only_consent_output' );
	}
}
add_action( 'amp_init', 'ampforwp_gpc_init' );
