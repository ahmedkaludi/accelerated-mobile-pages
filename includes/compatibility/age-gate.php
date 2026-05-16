<?php
/**
 * Age Gate (https://wordpress.org/plugins/age-gate/) — AMP compatibility.
 *
 * AMP cannot run Age Gate’s front-end verification. When the visitor has not
 * passed Age Gate for the current request, send them to the canonical (non-AMP)
 * URL so verification can complete there. Cookie name and restriction logic
 * follow Age Gate (see {@see age_gate_is_restricted()}).
 *
 * @package AMPforWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Query argument used to remember the AMP URL when sending visitors to non-AMP for Age Gate.
 */
define( 'AMPFORWP_AGE_GATE_RETURN_QUERY_VAR', 'ampforwp_amp_return' );
/**
 * Whether Age Gate redirect is enabled in AMPforWP settings.
 *
 * If the option was never saved (sites updated before the toggle existed), defaults to enabled
 * so behavior matches the original integration.
 *
 * @since 1.1.14
 *
 * @return bool
 */
function ampforwp_age_gate_compat_is_enabled() {
	if ( ! apply_filters( 'ampforwp_age_gate_redirect_enabled', true ) ) {
		return false;
	}

	$setting = ampforwp_get_setting( 'ampforwp-age-gate-compat' );
	if ( '' === $setting || null === $setting ) {
		$redux = get_option( 'redux_builder_amp', array() );
		if ( ! is_array( $redux ) || ! array_key_exists( 'ampforwp-age-gate-compat', $redux ) ) {
			return true;
		}
	}

	return (bool) $setting || '1' === (string) $setting;
}

/**
 * Whether Age Gate + AMP redirect integration should run.
 *
 * @since 1.1.14
 *
 * @return bool
 */
function ampforwp_age_gate_compat_is_ready() {
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	return function_exists( 'is_plugin_active' ) && is_plugin_active( 'age-gate/age-gate.php' ) && function_exists( 'age_gate_is_restricted' );
}

/**
 * Build the non-AMP URL for the current request (paired AMP / ?amp= / takeover fallbacks).
 *
 * @since 1.1.14
 *
 * @return string Escaped URL safe for wp_safe_redirect.
 */
function ampforwp_age_gate_non_amp_url() {
	$url = '';

	if ( function_exists( 'ampforwp_get_non_amp_url' ) ) {
		$url = ampforwp_get_non_amp_url();
	}

	if ( empty( $url ) && function_exists( 'ampforwp_get_setting' ) && ampforwp_get_setting( 'amp-core-end-point' ) ) {
		$scheme = is_ssl() ? 'https://' : 'http://';
		$host   = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
		$uri    = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
		if ( $host && $uri ) {
			$full = esc_url_raw( $scheme . $host . $uri );
			$url  = remove_query_arg( 'amp', $full );
		}
	}

	if ( empty( $url ) ) {
		global $wp;
		$request = isset( $wp->request ) ? $wp->request : '';
		$amp_var = defined( 'AMPFORWP_AMP_QUERY_VAR' ) ? AMPFORWP_AMP_QUERY_VAR : 'amp';

		if ( $request === $amp_var ) {
			$url = home_url( '/' );
		} else {
			$path = preg_replace( '#/' . preg_quote( $amp_var, '#' ) . '/?$#', '', $request );
			$url  = home_url( user_trailingslashit( $path ) );
		}
	}

	/**
	 * Filters the non-AMP URL used when redirecting from AMP for Age Gate.
	 *
	 * @since 1.1.14
	 *
	 * @param string $url Non-AMP destination URL.
	 */
	$url = apply_filters( 'ampforwp_age_gate_redirect_url', $url );

	return esc_url_raw( $url );
}

/**
 * Full AMP URL for the current request.
 *
 * @since 1.1.14
 *
 * @return string
 */
function ampforwp_age_gate_get_current_amp_url() {
	$scheme = is_ssl() ? 'https://' : 'http://';
	$host   = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	$uri    = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';

	if ( empty( $host ) || empty( $uri ) ) {
		return '';
	}

	return esc_url_raw( $scheme . $host . $uri );
}

/**
 * Extract a validated AMP return URL from a URL that may contain the query argument.
 *
 * @since 1.1.14
 *
 * @param string $url Page or referer URL.
 * @return string
 */
function ampforwp_age_gate_extract_return_from_url( $url ) {
	if ( empty( $url ) ) {
		return '';
	}

	$query = wp_parse_url( $url, PHP_URL_QUERY );
	if ( empty( $query ) ) {
		return '';
	}

	$args = array();
	wp_parse_str( $query, $args );

	if ( empty( $args[ AMPFORWP_AGE_GATE_RETURN_QUERY_VAR ] ) ) {
		return '';
	}

	$amp_url = esc_url_raw( $args[ AMPFORWP_AGE_GATE_RETURN_QUERY_VAR ] );
	if ( empty( $amp_url ) || ! ampforwp_age_gate_is_valid_amp_return_url( $amp_url ) ) {
		return '';
	}

	return $amp_url;
}

/**
 * Read and validate the stored AMP return URL from the request.
 *
 * Checks the query string, current page URL, and Referer (for Age Gate JS/AJAX REST calls).
 *
 * @since 1.1.14
 *
 * @return string Safe AMP URL or empty string.
 */
function ampforwp_age_gate_get_return_amp_url() {
	if ( ! empty( $_REQUEST[ AMPFORWP_AGE_GATE_RETURN_QUERY_VAR ] ) ) {
		$url = esc_url_raw( wp_unslash( $_REQUEST[ AMPFORWP_AGE_GATE_RETURN_QUERY_VAR ] ) );
		if ( ! empty( $url ) && ampforwp_age_gate_is_valid_amp_return_url( $url ) ) {
			return $url;
		}
	}

	if ( ! empty( $_SERVER['REQUEST_URI'] ) ) {
		$scheme = is_ssl() ? 'https://' : 'http://';
		$host   = isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
		if ( $host ) {
			$from_page = ampforwp_age_gate_extract_return_from_url(
				esc_url_raw( $scheme . $host . wp_unslash( $_SERVER['REQUEST_URI'] ) )
			);
			if ( $from_page ) {
				return $from_page;
			}
		}
	}

	if ( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
		$from_referer = ampforwp_age_gate_extract_return_from_url(
			esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) )
		);
		if ( $from_referer ) {
			return $from_referer;
		}
	}

	return '';
}

/**
 * Ensure a return URL belongs to this site and points at an AMP endpoint.
 *
 * @since 1.1.14
 *
 * @param string $url Candidate URL.
 * @return bool
 */
function ampforwp_age_gate_is_valid_amp_return_url( $url ) {
	$home_host = wp_parse_url( home_url(), PHP_URL_HOST );
	$url_host  = wp_parse_url( $url, PHP_URL_HOST );

	if ( empty( $home_host ) || empty( $url_host ) || $home_host !== $url_host ) {
		return false;
	}

	$path = trim( (string) wp_parse_url( $url, PHP_URL_PATH ), '/' );
	$query = (string) wp_parse_url( $url, PHP_URL_QUERY );

	if ( function_exists( 'ampforwp_is_amp_inURL' ) && ampforwp_is_amp_inURL( $path ) ) {
		return true;
	}

	if ( function_exists( 'ampforwp_get_setting' ) && ampforwp_get_setting( 'amp-core-end-point' ) ) {
		return ( false !== strpos( $query, 'amp=' ) );
	}

	$amp_var = defined( 'AMPFORWP_AMP_QUERY_VAR' ) ? AMPFORWP_AMP_QUERY_VAR : 'amp';

	return ( $path === $amp_var || false !== strpos( $path, $amp_var . '/' ) );
}

/**
 * Append the AMP return URL to a non-AMP redirect target.
 *
 * @since 1.1.14
 *
 * @param string $non_amp_url Non-AMP URL.
 * @param string $amp_url     Original AMP URL.
 * @return string
 */
function ampforwp_age_gate_add_return_arg( $non_amp_url, $amp_url ) {
	if ( empty( $non_amp_url ) || empty( $amp_url ) ) {
		return $non_amp_url;
	}

	return add_query_arg( AMPFORWP_AGE_GATE_RETURN_QUERY_VAR, $amp_url, $non_amp_url );
}

/**
 * After Age Gate passes on non-AMP, send the user back to the AMP URL they requested.
 *
 * @since 1.1.14
 *
 * @param string $redirect Age Gate redirect URL.
 * @param array  $data     Submission data.
 * @return string
 */
function ampforwp_age_gate_filter_success_redirect( $redirect, $data ) {
	unset( $data );

	if ( ! ampforwp_age_gate_compat_is_enabled() ) {
		return $redirect;
	}

	$amp_url = ampforwp_age_gate_get_return_amp_url();
	if ( ! empty( $amp_url ) ) {
		return $amp_url;
	}

	return $redirect;
}

/**
 * Enqueue a small script so Age Gate JS mode redirects back to AMP after AJAX verification.
 *
 * @since 1.1.14
 * @return void
 */
function ampforwp_age_gate_enqueue_return_script() {
	if ( ! ampforwp_age_gate_compat_is_enabled() || ! ampforwp_age_gate_compat_is_ready() ) {
		return;
	}

	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
		return;
	}

	$amp_url = ampforwp_age_gate_get_return_amp_url();
	if ( empty( $amp_url ) ) {
		return;
	}

	$version = defined( 'AMPFORWP_VERSION' ) ? AMPFORWP_VERSION : '1.0';
	wp_register_script( 'ampforwp-age-gate-return', false, array(), $version, true );
	wp_enqueue_script( 'ampforwp-age-gate-return' );

	$inline = '(function(){var u=' . wp_json_encode( $amp_url ) . ';function go(){if(u){window.location.href=u;}}';
	$inline .= 'window.addEventListener("age_gate_passed",go);';
	$inline .= 'document.addEventListener("age_gate_passed",go);})();';

	wp_add_inline_script( 'ampforwp-age-gate-return', $inline );
}

/**
 * If Age Gate cookie is set but the return query arg remains, redirect to AMP.
 *
 * @since 1.1.14
 * @return void
 */
function ampforwp_age_gate_return_to_amp_after_pass() {
	if ( ! ampforwp_age_gate_compat_is_enabled() || ! ampforwp_age_gate_compat_is_ready() ) {
		return;
	}

	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}

	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
		return;
	}

	if ( function_exists( 'age_gate_is_restricted' ) && age_gate_is_restricted() ) {
		return;
	}

	$amp_url = ampforwp_age_gate_get_return_amp_url();
	if ( empty( $amp_url ) ) {
		return;
	}

	$current = ( is_ssl() ? 'https://' : 'http://' );
	$current .= isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	$current .= isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';

	if ( esc_url_raw( $current ) === esc_url_raw( $amp_url ) ) {
		return;
	}

	wp_safe_redirect( $amp_url, 302 );
	exit;
}

/**
 * Redirect AMP requests to non-AMP when Age Gate still applies.
 *
 * Runs before {@see ampforwp_redirection()} (priority 10).
 *
 * @since 1.1.14
 * @return void
 */
function ampforwp_age_gate_compat_template_redirect() {
	if ( ! ampforwp_age_gate_compat_is_enabled() ) {
		return;
	}

	if ( ! ampforwp_age_gate_compat_is_ready() ) {
		return;
	}

	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}
	if ( function_exists( 'wp_is_json_request' ) && wp_is_json_request() ) {
		return;
	}

	if ( is_feed() || is_embed() || is_trackback() || is_customize_preview() ) {
		return;
	}

	if ( ! function_exists( 'ampforwp_is_amp_endpoint' ) || ! ampforwp_is_amp_endpoint() ) {
		return;
	}

	if ( ! age_gate_is_restricted() ) {
		return;
	}

	$target = ampforwp_age_gate_non_amp_url();
	if ( empty( $target ) ) {
		return;
	}

	$current = ( is_ssl() ? 'https://' : 'http://' );
	$current .= isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	$current .= isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';

	if ( $target === esc_url_raw( $current ) ) {
		return;
	}

	$amp_url = ampforwp_age_gate_get_current_amp_url();
	$target  = ampforwp_age_gate_add_return_arg( $target, $amp_url );

	wp_safe_redirect( $target, 302 );
	exit;
}

/**
 * Age Gate fields for the Advance Settings section.
 *
 * @since 1.1.14
 *
 * @return array<int, array<string, mixed>>
 */
function ampforwp_age_gate_advance_fields() {
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	if ( ! is_plugin_active( 'age-gate/age-gate.php' ) ) {
		return array();
	}

	return array(
		array(
			'id'               => 'ampforwp-age-gate-compat',
			'type'             => 'switch',
			'title'            => esc_html__( 'Age Gate Support', 'accelerated-mobile-pages' ),
			'tooltip-subtitle' => esc_html__(
				'When enabled, visitors who have not passed Age Gate are sent to the non-AMP page to verify, then returned to the AMP URL they opened.',
				'accelerated-mobile-pages'
			),
			'desc'             => sprintf(
				/* translators: %s: Age Gate plugin name */
				esc_html__( 'Requires the %s plugin. Uses the same cookies and restriction rules as your Age Gate configuration.', 'accelerated-mobile-pages' ),
				'Age Gate'
			),
			'default'          => 1,
			'true'             => esc_html__( 'Enabled', 'accelerated-mobile-pages' ),
			'false'            => esc_html__( 'Disabled', 'accelerated-mobile-pages' ),
		),
	);
}

add_action( 'template_redirect', 'ampforwp_age_gate_compat_template_redirect', 5 );
add_action( 'template_redirect', 'ampforwp_age_gate_return_to_amp_after_pass', 6 );
add_action( 'wp_enqueue_scripts', 'ampforwp_age_gate_enqueue_return_script', 20 );
add_filter( 'age_gate/success/redirect', 'ampforwp_age_gate_filter_success_redirect', 10, 2 );
