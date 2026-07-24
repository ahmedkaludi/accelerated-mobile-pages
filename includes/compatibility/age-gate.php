<?php
/**
 * Age Gate (https://wordpress.org/plugins/age-gate/) — AMP compatibility.
 *
 * Renders a full-page, non-dismissable AMP age verification overlay. Works with
 * AMP Cache because verification state is checked client-side (amp-list) and
 * cookies are set via dynamic admin-ajax endpoints.
 *
 * @package AMPforWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether Age Gate AMP overlay is enabled in AMPforWP settings.
 *
 * @since 1.1.14
 *
 * @return bool
 */
function ampforwp_age_gate_compat_is_enabled() {
	if ( ! apply_filters( 'ampforwp_age_gate_amp_enabled', true ) ) {
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
 * Whether Age Gate + AMP integration should run.
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
 * Age Gate settings and copy for the AMP overlay.
 *
 * @since 1.1.14
 *
 * @return array<string, mixed>
 */
function ampforwp_age_gate_get_display_config() {
	$config = array(
		'headline'      => esc_html__( 'Age Verification', 'accelerated-mobile-pages' ),
		'subheadline'   => '',
		'challenge'     => esc_html__( 'Please confirm you are old enough to view this content.', 'accelerated-mobile-pages' ),
		'label_yes'     => esc_html__( 'Yes', 'accelerated-mobile-pages' ),
		'label_no'      => esc_html__( 'No', 'accelerated-mobile-pages' ),
		'failed'        => esc_html__( 'You are not old enough to view this content', 'accelerated-mobile-pages' ),
		'required_age'  => 18,
		'default_age'   => 18,
		'language'      => 'en',
		'logo'          => '',
		'logo_width'    => 0,
		'logo_height'   => 0,
		'logo_alt'      => '',
		'button_order'  => 'yes-no',
	);

	if ( ! class_exists( 'AgeGate\\Common\\Settings' ) || ! function_exists( 'age_gate_content' ) ) {
		return apply_filters( 'ampforwp_age_gate_display_config', $config );
	}

	$settings        = AgeGate\Common\Settings::getInstance();
	$content         = age_gate_content();
	$restriction_age = (int) $content->getAge();
	$lang            = ! empty( $settings->language ) ? $settings->language : 'en';
	$default_age     = (int) ( $settings->{$lang}['defaultAge'] ?? $settings->defaultAge ?? 18 );

	if ( ! empty( $settings->headline ) ) {
		$config['headline'] = wp_strip_all_tags( sprintf( $settings->headline, $default_age ) );
	}
	if ( ! empty( $settings->subheadline ) ) {
		$config['subheadline'] = wp_strip_all_tags( sprintf( $settings->subheadline, $default_age ) );
	}
	if ( ! empty( $settings->labelButtons ) ) {
		$config['challenge'] = wp_strip_all_tags( sprintf( $settings->labelButtons, $default_age ) );
	}
	if ( ! empty( $settings->labelYes ) ) {
		$config['label_yes'] = wp_strip_all_tags( $settings->labelYes );
	}
	if ( ! empty( $settings->labelNo ) ) {
		$config['label_no'] = wp_strip_all_tags( $settings->labelNo );
	}
	if ( ! empty( $settings->errorFailed ) ) {
		$config['failed'] = wp_strip_all_tags( $settings->errorFailed );
	}

	$config['required_age'] = $restriction_age;
	$config['default_age']  = $default_age;
	$config['language']     = ! empty( $settings->language ) ? $settings->language : 'en';
	$config['button_order'] = ! empty( $settings->buttonOrder ) ? $settings->buttonOrder : 'yes-no';

	if ( ! empty( $settings->logo ) ) {
		$config['logo']        = esc_url( $settings->logo );
		$config['logo_width']  = (int) $settings->logoWidth;
		$config['logo_height'] = (int) $settings->logoHeight;
		$config['logo_alt']    = ! empty( $settings->logoAlt ) ? wp_strip_all_tags( $settings->logoAlt ) : '';
	}

	return apply_filters( 'ampforwp_age_gate_display_config', $config );
}

/**
 * Whether the current content requires age verification (ignores visitor cookies).
 *
 * Used so cached AMP HTML always includes the overlay; amp-list hides it when passed.
 *
 * @since 1.1.14
 *
 * @return bool
 */
function ampforwp_age_gate_content_requires_verification() {
	if ( ! function_exists( 'age_gate_is_restricted' ) ) {
		return false;
	}

	if ( ! class_exists( 'AgeGate\\Common\\Settings' ) || ! class_exists( 'AgeGate\\Utility\\Cookie' ) ) {
		return age_gate_is_restricted();
	}

	$settings    = AgeGate\Common\Settings::getInstance();
	$pass_name   = AgeGate\Utility\Cookie::$prefix . $settings->getCookieName();
	$failed_name = AgeGate\Utility\Cookie::$prefix . $settings->getCookieName() . '_failed';
	$saved       = array(
		'pass'   => isset( $_COOKIE[ $pass_name ] ) ? $_COOKIE[ $pass_name ] : null,
		'failed' => isset( $_COOKIE[ $failed_name ] ) ? $_COOKIE[ $failed_name ] : null,
	);

	unset( $_COOKIE[ $pass_name ], $_COOKIE[ $failed_name ] );
	$requires = age_gate_is_restricted();

	if ( null !== $saved['pass'] ) {
		$_COOKIE[ $pass_name ] = $saved['pass'];
	}
	if ( null !== $saved['failed'] ) {
		$_COOKIE[ $failed_name ] = $saved['failed'];
	}

	return $requires;
}

/**
 * Whether the AMP age gate overlay should be rendered for this request.
 *
 * Always renders when content is restricted so cached AMP HTML includes the gate;
 * returning visitors with a valid cookie hide it via the status amp-list call.
 *
 * @since 1.1.14
 *
 * @return bool
 */
function ampforwp_age_gate_should_render_overlay() {
	if ( ! ampforwp_age_gate_compat_is_enabled() || ! ampforwp_age_gate_compat_is_ready() ) {
		return false;
	}

	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return false;
	}

	if ( ! function_exists( 'ampforwp_is_amp_endpoint' ) || ! ampforwp_is_amp_endpoint() ) {
		return false;
	}

	if ( is_feed() || is_embed() || is_trackback() || is_customize_preview() ) {
		return false;
	}

	if ( ! ampforwp_age_gate_content_requires_verification() ) {
		return false;
	}

	return (bool) apply_filters( 'ampforwp_age_gate_show_overlay', true );
}

/**
 * Send AMP CORS headers for admin-ajax form/list requests.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_send_amp_headers() {
	$home      = home_url( '/' );
	$site_host = wp_parse_url( $home, PHP_URL_SCHEME ) . '://' . wp_parse_url( $home, PHP_URL_HOST );

	$source_origin = $site_host;
	if ( ! empty( $_GET['__amp_source_origin'] ) ) {
		$source_origin = esc_url_raw( wp_unslash( $_GET['__amp_source_origin'] ) );
	} elseif ( ! empty( $_SERVER['HTTP_ORIGIN'] ) ) {
		$source_origin = esc_url_raw( wp_unslash( $_SERVER['HTTP_ORIGIN'] ) );
	}

	header( 'AMP-Access-Control-Allow-Source-Origin: ' . esc_url_raw( $site_host ) );
	header( 'Access-Control-Allow-Origin: ' . $source_origin );
	header( 'Access-Control-Allow-Credentials: true' );
	header( 'Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin' );
	header( 'Content-Type: application/json; charset=UTF-8' );
}

/**
 * Prevent page and object caches from storing Age Gate AJAX responses.
 *
 * Status checks must vary by visitor cookie; a cached "not passed" response
 * leaves the overlay stuck on after verification.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_prevent_response_cache() {
	if ( ! defined( 'DONOTCACHEPAGE' ) ) {
		define( 'DONOTCACHEPAGE', true );
	}

	if ( ! defined( 'DONT_CACHE_PAGE' ) ) {
		define( 'DONT_CACHE_PAGE', true );
	}

	nocache_headers();
	header( 'Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0' );
	header( 'Vary: Cookie' );

	if ( function_exists( 'do_action' ) ) {
		do_action( 'litespeed_control_set_nocache', 'ampforwp age gate ajax' );
	}
}

/**
 * Disable caching for dynamic Age Gate admin-ajax handlers.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_maybe_prevent_response_cache() {
	if ( ! wp_doing_ajax() || empty( $_REQUEST['action'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}

	$action = sanitize_key( wp_unslash( $_REQUEST['action'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( 0 === strpos( $action, 'ampforwp_age_gate' ) ) {
		ampforwp_age_gate_prevent_response_cache();
	}
}

/**
 * Convert Age Gate cookie length to a unix timestamp for setcookie().
 *
 * Age Gate JS mode returns a day count for the browser library, not a timestamp.
 * Passing that value directly to setcookie() creates an already-expired cookie.
 *
 * @since 1.1.14
 *
 * @param int|float|string $cookie_length Cookie length from Age Gate Submit response.
 * @param AgeGate\Common\Settings|null $settings Age Gate settings instance.
 * @return int Unix timestamp, or 0 for session cookie.
 */
function ampforwp_age_gate_cookie_expires( $cookie_length, $settings = null ) {
	if ( empty( $cookie_length ) || ! is_numeric( $cookie_length ) ) {
		if ( ! $settings instanceof AgeGate\Common\Settings && class_exists( 'AgeGate\\Common\\Settings' ) ) {
			$settings = AgeGate\Common\Settings::getInstance();
		}

		return $settings instanceof AgeGate\Common\Settings
			? ampforwp_age_gate_get_cookie_expires( $settings )
			: strtotime( '+365 days' );
	}

	$cookie_length = (int) $cookie_length;

	if ( $cookie_length > time() ) {
		return $cookie_length;
	}

	if ( ! $settings instanceof AgeGate\Common\Settings && class_exists( 'AgeGate\\Common\\Settings' ) ) {
		$settings = AgeGate\Common\Settings::getInstance();
	}

	if ( $settings && ! empty( $settings->method ) && 'js' === $settings->method && empty( $settings->useLocalStorage ) ) {
		return strtotime( '+' . max( 1, $cookie_length ) . ' days' );
	}

	if ( $cookie_length > 0 && $cookie_length < YEAR_IN_SECONDS ) {
		return strtotime( '+' . $cookie_length . ' days' );
	}

	return $cookie_length;
}

/**
 * Signed token for cache-safe pass / pixel requests.
 *
 * @since 1.1.14
 *
 * @param int $age Required age for the current content.
 * @return string
 */
function ampforwp_age_gate_pass_token( $age ) {
	return hash_hmac( 'sha256', 'ampforwp_age_gate_pass_' . (int) $age, wp_salt( 'auth' ) );
}

/**
 * Cookie expiry from Age Gate "Remember length" (and time unit) settings.
 *
 * @since 1.1.14
 *
 * @param AgeGate\Common\Settings $settings Age Gate settings.
 * @return int Unix timestamp (never session-only).
 */
function ampforwp_age_gate_get_cookie_expires( $settings ) {
	$length = 365;
	$unit   = 'days';

	if ( isset( $settings->rememberLength ) && is_numeric( $settings->rememberLength ) ) {
		$length = (int) $settings->rememberLength;
	}

	if ( ! empty( $settings->rememberTime ) && is_string( $settings->rememberTime ) ) {
		$unit = $settings->rememberTime;
	}

	$length = (int) apply_filters( 'age_gate/cookie/length', $length );
	$unit   = apply_filters( 'age_gate/cookie/time', $unit );

	if ( $length <= 0 ) {
		$length = 365;
		$unit   = 'days';
	}

	$expires = strtotime( '+' . $length . ' ' . $unit );

	return $expires > time() ? $expires : strtotime( '+365 days' );
}

/**
 * Cookie value Age Gate expects after a successful Yes (mirrors Submit.php).
 *
 * @since 1.1.14
 *
 * @param AgeGate\Common\Settings $settings     Age Gate settings.
 * @param int                     $content_age  Required age for the current content.
 * @return int
 */
function ampforwp_age_gate_get_pass_cookie_value( $settings, $content_age ) {
	if ( ! empty( $settings->anonymous ) ) {
		return 1;
	}

	return (int) $content_age;
}

/**
 * Persist an Age Gate cookie and sync it for the current request.
 *
 * Uses SameSite=Lax so first-party AMP requests reliably store the cookie.
 *
 * @since 1.1.14
 *
 * @param string $name    Cookie name (without prefix).
 * @param mixed  $value   Cookie value.
 * @param int    $expires Unix timestamp, or 0 for session cookie.
 * @return bool
 */
function ampforwp_age_gate_write_cookie( $name, $value, $expires = 0 ) {
	if ( class_exists( 'AgeGate\\Utility\\Cookie' ) ) {
		AgeGate\Utility\Cookie::setDomain();
		$cookie_name = AgeGate\Utility\Cookie::$prefix . $name;

		$result = AgeGate\Utility\Cookie::set( $name, $value, $expires ? (int) $expires : 0 );
		if ( '' === (string) $value ) {
			unset( $_COOKIE[ $cookie_name ] );
		} else {
			$_COOKIE[ $cookie_name ] = $value;
		}

		return $result;
	}

	$cookie_name = $name;
	$path        = COOKIEPATH ? COOKIEPATH : '/';

	$result = setcookie(
		$cookie_name,
		(string) $value,
		array(
			'expires'  => $expires ? (int) $expires : 0,
			'path'     => $path,
			'domain'   => COOKIE_DOMAIN,
			'secure'   => is_ssl(),
			'httponly' => false,
			'samesite' => 'Lax',
		)
	);

	if ( '' === (string) $value ) {
		unset( $_COOKIE[ $cookie_name ] );
	} else {
		$_COOKIE[ $cookie_name ] = $value;
	}

	return $result;
}

/**
 * Store the Age Gate pass value in the visitor cookie.
 *
 * @since 1.1.14
 *
 * @param AgeGate\Common\Settings $settings Age Gate settings.
 * @param int                     $age      Required content age.
 * @param int                     $expires  Optional unix expiry override.
 * @return bool
 */
function ampforwp_age_gate_store_pass( $settings, $content_age, $expires = null ) {
	if ( null === $expires ) {
		$expires = ampforwp_age_gate_get_cookie_expires( $settings );
	}

	$cookie_value = ampforwp_age_gate_get_pass_cookie_value( $settings, $content_age );

	ampforwp_age_gate_write_cookie( $settings->getCookieName(), $cookie_value, $expires );
	ampforwp_age_gate_write_cookie( $settings->getCookieName() . '_failed', '', time() - YEAR_IN_SECONDS );

	return true;
}

/**
 * Store the Age Gate failed cookie.
 *
 * @since 1.1.14
 *
 * @param AgeGate\Common\Settings $settings Age Gate settings.
 * @return bool
 */
function ampforwp_age_gate_store_failed( $settings ) {
	$expires = ampforwp_age_gate_get_cookie_expires( $settings );

	ampforwp_age_gate_write_cookie( $settings->getCookieName() . '_failed', 1, $expires );

	return true;
}

/**
 * Check whether the visitor has failed Age Gate and is locked out.
 *
 * @since 1.1.14
 *
 * @return bool
 */
function ampforwp_age_gate_is_lockout( $required_age = null ) {
	if ( ! class_exists( 'AgeGate\\Common\\Settings' ) || ! class_exists( 'AgeGate\\Utility\\Cookie' ) ) {
		return false;
	}

	if ( ampforwp_age_gate_visitor_has_passed( $required_age ) ) {
		return false;
	}

	$settings = AgeGate\Common\Settings::getInstance();
	if ( ! empty( $settings->rechallenge ) ) {
		return false;
	}

	$failed_cookie = $settings->getCookieName() . '_failed';

	return (bool) AgeGate\Utility\Cookie::get( $failed_cookie );
}

/**
 * Resolve a post ID from an AMP or canonical URL.
 *
 * @since 1.1.14
 *
 * @param string $url Page URL, possibly ending in /amp/.
 * @return int Post ID, or 0 when not found.
 */
function ampforwp_age_gate_post_id_from_url( $url ) {
	$post_id = url_to_postid( $url );
	if ( $post_id > 0 ) {
		return $post_id;
	}

	$path = wp_parse_url( $url, PHP_URL_PATH );
	if ( ! is_string( $path ) || '' === $path ) {
		return 0;
	}

	$stripped = preg_replace( '#(/amp/?)$#', '', untrailingslashit( $path ) );
	if ( $stripped === $path ) {
		return 0;
	}

	return url_to_postid( home_url( $stripped ) );
}

/**
 * Bootstrap the main query from the AMP page being verified.
 *
 * admin-ajax.php has no post context; Age Gate needs it to resolve content age.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_bootstrap_from_request() {
	static $bootstrapped = false;

	if ( $bootstrapped ) {
		return;
	}

	$post_id = 0;

	if ( ! empty( $_REQUEST['post_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$post_id = (int) $_REQUEST['post_id']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	}

	if ( $post_id <= 0 && ! empty( $_REQUEST['redirect_to'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$redirect = esc_url_raw( wp_unslash( $_REQUEST['redirect_to'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$post_id  = ampforwp_age_gate_post_id_from_url( $redirect );
	}

	if ( $post_id <= 0 && ! empty( $_SERVER['HTTP_REFERER'] ) ) {
		$referer = esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) );
		$post_id = ampforwp_age_gate_post_id_from_url( $referer );
	}

	if ( $post_id <= 0 ) {
		return;
	}

	$post_object = get_post( $post_id );
	if ( ! $post_object instanceof WP_Post ) {
		return;
	}

	global $wp_query, $post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

	$post = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	setup_postdata( $post );
	$wp_query = new WP_Query( // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		array(
			'p'         => $post_id,
			'post_type' => $post_object->post_type,
		)
	);

	$bootstrapped = true;
}

/**
 * Read the Age Gate pass cookie value from the current request.
 *
 * @since 1.1.14
 *
 * @param AgeGate\Common\Settings $settings Age Gate settings.
 * @return string|null
 */
function ampforwp_age_gate_get_pass_cookie( $settings ) {
	$cookie_name = $settings->getCookieName();
	$prefix      = '';

	if ( class_exists( 'AgeGate\\Utility\\Cookie' ) ) {
		$prefix = AgeGate\Utility\Cookie::$prefix;
		
		// Try Age Gate's method first
		$value = AgeGate\Utility\Cookie::get( $cookie_name );
		if ( null !== $value && '' !== (string) $value ) {
			return (string) $value;
		}
	}

	// Direct cookie checks with all possible variations
	$possible_names = array(
		$prefix . $cookie_name,
		$cookie_name,
		'age_gate', // Common default name
	);

	foreach ( $possible_names as $name ) {
		if ( isset( $_COOKIE[ $name ] ) && '' !== $_COOKIE[ $name ] ) {
			return (string) sanitize_text_field( wp_unslash( $_COOKIE[ $name ] ) );
		}
	}

	return null;
}

/**
 * Whether the visitor has a valid Age Gate pass cookie for the required age.
 *
 * @since 1.1.14
 *
 * @param int|null $required_age Required age for the current content.
 * @return bool
 */
function ampforwp_age_gate_visitor_has_passed( $required_age = null ) {
	if ( ! class_exists( 'AgeGate\\Common\\Settings' ) ) {
		return function_exists( 'age_gate_is_restricted' ) ? ! age_gate_is_restricted() : false;
	}

	// Bootstrap from request during AJAX calls
	if ( wp_doing_ajax() ) {
		ampforwp_age_gate_bootstrap_from_request();
	}

	// Get settings and check for cookie
	$settings     = AgeGate\Common\Settings::getInstance();
	$cookie_value = ampforwp_age_gate_get_pass_cookie( $settings );

	// If no cookie, definitely not passed
	if ( null === $cookie_value || '' === $cookie_value ) {
		return false;
	}

	// Determine required age
	if ( null === $required_age || $required_age <= 0 ) {
		if ( function_exists( 'age_gate_content' ) ) {
			$required_age = (int) age_gate_content()->getAge();
		} else {
			$required_age = 18;
		}
	}

	$required_age = (int) $required_age;

	// Check if cookie value meets requirement
	if ( ! empty( $settings->anonymous ) ) {
		return (int) $cookie_value > 0;
	}

	return (int) $cookie_value >= $required_age;
}

/**
 * Build amp-list status payload for the current visitor.
 *
 * @since 1.1.14
 *
 * @param int $required_age Required age for the AMP page.
 * @return array<string, mixed>
 */
function ampforwp_age_gate_build_status_response( $required_age = 0 ) {
	ampforwp_age_gate_bootstrap_from_request();

	$config = ampforwp_age_gate_get_display_config();
	if ( $required_age <= 0 ) {
		$required_age = (int) $config['required_age'];
	}

	$passed  = ampforwp_age_gate_visitor_has_passed( $required_age );
	$lockout = ampforwp_age_gate_is_lockout( $required_age );

	return array(
		'passed'  => $passed,
		'lockout' => $lockout,
		'message' => $lockout ? $config['failed'] : '',
	);
}

/**
 * Safe return URL after pass/fail (same host only).
 *
 * @since 1.1.14
 *
 * @return string
 */
function ampforwp_age_gate_get_return_url() {
	$redirect = '';

	if ( ! empty( $_GET['redirect_to'] ) ) {
		$redirect = esc_url_raw( wp_unslash( $_GET['redirect_to'] ) );
	} elseif ( ! empty( $_REQUEST['redirect_to'] ) ) {
		$redirect = esc_url_raw( wp_unslash( $_REQUEST['redirect_to'] ) );
	} elseif ( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
		$redirect = esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) );
	}

	if ( empty( $redirect ) ) {
		$redirect = home_url( '/' );
	}

	$home_host = wp_parse_url( home_url(), PHP_URL_HOST );
	$url_host  = wp_parse_url( $redirect, PHP_URL_HOST );

	if ( empty( $home_host ) || empty( $url_host ) || $home_host !== $url_host ) {
		return home_url( '/' );
	}

	return $redirect;
}

/**
 * Validate pass/fail token for the given age.
 *
 * @since 1.1.14
 *
 * @param int    $age   Required age.
 * @param string $token Signed token.
 * @return bool
 */
function ampforwp_age_gate_verify_token( $age, $token ) {
	return ! empty( $token ) && hash_equals( ampforwp_age_gate_pass_token( $age ), $token );
}

/**
 * AJAX: return whether the visitor has already passed Age Gate.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_ajax_status() {
	ampforwp_age_gate_prevent_response_cache();

	$required_age = isset( $_REQUEST['age'] ) ? (int) $_REQUEST['age'] : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	ampforwp_age_gate_send_amp_headers();

	if ( ! ampforwp_age_gate_compat_is_ready() ) {
		wp_send_json(
			array(
				'passed'  => true,
				'lockout' => false,
				'message' => '',
			)
		);
	}

	wp_send_json( ampforwp_age_gate_build_status_response( $required_age ) );
}

/**
 * AJAX: handle Yes / No age gate submission for AMP.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_ajax_submit() {
	ampforwp_age_gate_prevent_response_cache();

	$config = ampforwp_age_gate_get_display_config();

	ampforwp_age_gate_send_amp_headers();

	/* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized */
	$token = isset( $_REQUEST['amp_token'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['amp_token'] ) ) : '';
	$age   = isset( $_REQUEST['amp_age'] ) ? (int) $_REQUEST['amp_age'] : (int) $config['required_age'];

	if ( empty( $token ) || ! hash_equals( ampforwp_age_gate_pass_token( $age ), $token ) ) {
		wp_send_json(
			array(
				'passed'  => false,
				'lockout' => false,
				'message' => esc_html__( 'Invalid request.', 'accelerated-mobile-pages' ),
			),
			403
		);
	}

	if ( ! ampforwp_age_gate_compat_is_ready() || ! class_exists( 'AgeGate\\Common\\Form\\Submit' ) ) {
		wp_send_json(
			array(
				'passed'  => false,
				'lockout' => false,
				'message' => $config['failed'],
			)
		);
	}

	$post_data = wp_unslash( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification.Missing

	if ( empty( $post_data['age_gate'] ) || ! is_array( $post_data['age_gate'] ) ) {
		$post_data['age_gate'] = array();
	}

	if ( ! isset( $post_data['age_gate']['confirm'] ) && isset( $_POST['age_gate']['confirm'] ) ) {
		$post_data['age_gate']['confirm'] = wp_unslash( $_POST['age_gate']['confirm'] );
	}

	if ( empty( $post_data['age_gate']['age'] ) ) {
		$post_data['age_gate']['age'] = $age;
	}

	if ( empty( $post_data['age_gate']['lang'] ) ) {
		$post_data['age_gate']['lang'] = $config['language'];
	}

	$settings = AgeGate\Common\Settings::getInstance();
	$confirm  = isset( $post_data['age_gate']['confirm'] ) ? (string) $post_data['age_gate']['confirm'] : '';
	$pass_url = ampforwp_age_gate_ajax_url(
		'ampforwp_age_gate_pass',
		array(
			'age'   => $age,
			'token' => $token,
		)
	);

	// AMP uses Yes/No buttons only — set cookies directly instead of Age Gate Submit
	// validation (which expects date/dropdown fields when inputType is not "buttons").
	if ( '1' === $confirm ) {
		ampforwp_age_gate_store_pass( $settings, $age );

		do_action(
			'age_gate/passed',
			array(
				'status' => true,
				'data'   => array(
					'user_age' => ! empty( $settings->anonymous ) ? 1 : $age,
				),
			)
		);

		wp_send_json(
			array(
				'passed'        => true,
				'lockout'       => false,
				'message'       => '',
				'passCookieUrl' => $pass_url,
			)
		);
	}

	if ( '0' === $confirm ) {
		ampforwp_age_gate_store_failed( $settings );

		wp_send_json(
			array(
				'passed'  => false,
				'lockout' => empty( $settings->rechallenge ),
				'message' => $config['failed'],
			)
		);
	}

	$response = ( new AgeGate\Common\Form\Submit( $post_data, $settings ) )->validate();

	if ( ! empty( $response['status'] ) ) {
		$expires = ampforwp_age_gate_cookie_expires( $response['cookieLength'] ?? 0, $settings );
		ampforwp_age_gate_store_pass( $settings, (int) $post_data['age_gate']['age'], $expires );

		do_action( 'age_gate/passed', $response );

		wp_send_json(
			array(
				'passed'        => true,
				'lockout'       => false,
				'message'       => '',
				'passCookieUrl' => $pass_url,
			)
		);
	}

	if ( ! empty( $response['set_cookie'] ) ) {
		ampforwp_age_gate_store_failed( $settings );
	}

	$message = $config['failed'];
	if ( ! empty( $response['errors'] ) && is_array( $response['errors'] ) ) {
		$first_error = reset( $response['errors'] );
		if ( is_string( $first_error ) && '' !== $first_error ) {
			$message = wp_strip_all_tags( $first_error );
		}
	}

	wp_send_json(
		array(
			'passed'  => false,
			'lockout' => empty( $settings->rechallenge ),
			'message' => $message,
		)
	);
}

function ampforwp_age_gate_pass_handler() {
	ampforwp_age_gate_prevent_response_cache();

	$config = ampforwp_age_gate_get_display_config();
	$age    = isset( $_REQUEST['age'] ) ? (int) $_REQUEST['age'] : (int) $config['required_age'];
	$token  = isset( $_REQUEST['token'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['token'] ) ) : '';

	if ( ! ampforwp_age_gate_verify_token( $age, $token ) ) {
		wp_die( esc_html__( 'Invalid age verification request.', 'accelerated-mobile-pages' ), '', array( 'response' => 403 ) );
	}

	if ( ampforwp_age_gate_compat_is_ready() && class_exists( 'AgeGate\\Common\\Settings' ) ) {
		$settings = AgeGate\Common\Settings::getInstance();
		ampforwp_age_gate_store_pass( $settings, $age );

		do_action(
			'age_gate/passed',
			array(
				'status' => true,
				'data'   => array(
					'user_age' => ampforwp_age_gate_get_pass_cookie_value( $settings, $age ),
				),
			)
		);
	}

	wp_safe_redirect( ampforwp_age_gate_get_return_url(), 302 );
	exit;
}

/**
 * AJAX fallback: set pass cookie and redirect back to the AMP page.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_pass_ajax_handler() {
	ampforwp_age_gate_prevent_response_cache();

	$config = ampforwp_age_gate_get_display_config();
	$age    = isset( $_REQUEST['age'] ) ? (int) $_REQUEST['age'] : (int) $config['required_age'];
	$token  = isset( $_REQUEST['token'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['token'] ) ) : '';

	if ( ! ampforwp_age_gate_verify_token( $age, $token ) ) {
		ampforwp_age_gate_send_amp_headers();
		wp_send_json(
			array(
				'passed'  => false,
				'message' => esc_html__( 'Invalid age verification request.', 'accelerated-mobile-pages' ),
			),
			403
		);
	}

	if ( ampforwp_age_gate_compat_is_ready() && class_exists( 'AgeGate\\Common\\Settings' ) ) {
		$settings = AgeGate\Common\Settings::getInstance();
		ampforwp_age_gate_store_pass( $settings, $age );

		do_action(
			'age_gate/passed',
			array(
				'status' => true,
				'data'   => array(
					'user_age' => ampforwp_age_gate_get_pass_cookie_value( $settings, $age ),
				),
			)
		);
	}

	ampforwp_age_gate_send_amp_headers();
	header( 'AMP-Redirect-To: ' . esc_url_raw( ampforwp_age_gate_get_return_url() ) );

	wp_send_json(
		array(
			'passed' => true,
		)
	);
}

/**
 * GET handler: record failed verification and return to the AMP page.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_fail_handler() {
	ampforwp_age_gate_prevent_response_cache();

	$config = ampforwp_age_gate_get_display_config();
	$age    = isset( $_REQUEST['age'] ) ? (int) $_REQUEST['age'] : (int) $config['required_age'];
	$token  = isset( $_REQUEST['token'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['token'] ) ) : '';

	if ( ! ampforwp_age_gate_verify_token( $age, $token ) ) {
		wp_die( esc_html__( 'Invalid age verification request.', 'accelerated-mobile-pages' ), '', array( 'response' => 403 ) );
	}

	if ( ampforwp_age_gate_compat_is_ready() && class_exists( 'AgeGate\\Common\\Settings' ) ) {
		$settings = AgeGate\Common\Settings::getInstance();
		ampforwp_age_gate_store_failed( $settings );
	}

	wp_safe_redirect( ampforwp_age_gate_get_return_url(), 302 );
	exit;
}

/**
 * AJAX: return whether the visitor has already passed Age Gate.
 *
 * @since 1.1.14
 *
 * @param string $action AJAX action name.
 * @param array  $args   Optional query arguments.
 * @return string
 */
function ampforwp_age_gate_ajax_url( $action, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'action' => $action,
		)
	);

	return add_query_arg( $args, admin_url( 'admin-ajax.php' ) );
}

/**
 * Output the AMP age gate overlay markup.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_output() {
	static $rendered = false;

	if ( $rendered || ! ampforwp_age_gate_should_render_overlay() ) {
		return;
	}

	$rendered = true;

	$config       = ampforwp_age_gate_get_display_config();
	$required_age = (int) $config['required_age'];
	$pass_token   = ampforwp_age_gate_pass_token( $required_age );
	$return_url   = ( is_ssl() ? 'https://' : 'http://' );
	$return_url  .= isset( $_SERVER['HTTP_HOST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) : '';
	$return_url  .= isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	$return_url   = esc_url_raw( $return_url );

	$yes_url = ampforwp_age_gate_ajax_url(
		'ampforwp_age_gate_pass',
		array(
			'age'         => $required_age,
			'token'       => $pass_token,
			'redirect_to' => $return_url,
		)
	);
	$yes_ajax_url = ampforwp_age_gate_ajax_url(
		'ampforwp_age_gate_pass_ajax',
		array(
			'age'         => $required_age,
			'token'       => $pass_token,
			'redirect_to' => $return_url,
		)
	);
	$no_url = ampforwp_age_gate_ajax_url(
		'ampforwp_age_gate_fail',
		array(
			'age'         => $required_age,
			'token'       => $pass_token,
			'redirect_to' => $return_url,
		)
	);
	$status_url    = ampforwp_age_gate_ajax_url(
		'ampforwp_age_gate_status',
		array(
			'age'         => $required_age,
			'post_id'     => get_queried_object_id(),
			'redirect_to' => $return_url,
		)
	);
	$lockout       = ampforwp_age_gate_is_lockout( $required_age );
	$show_no_first = ( 'no-yes' === $config['button_order'] );

	?>
	<amp-list class="ampforwp-age-gate-list"
		layout="fixed"
		width="1"
		height="1"
		src="<?php echo esc_url( $status_url ); ?>"
		credentials="include"
		single-item
		items=".">
		<div placeholder class="ampforwp-age-gate-overlay ampforwp-age-gate-overlay--loading"></div>
		<template type="amp-mustache">
			{{^passed}}
			<div id="ampforwp-age-gate-overlay" class="ampforwp-age-gate-overlay">
				<div class="ampforwp-age-gate-panel">
			<?php if ( ! empty( $config['logo'] ) ) : ?>
				<div class="ampforwp-age-gate-logo">
					<amp-img src="<?php echo esc_url( $config['logo'] ); ?>"
						<?php if ( $config['logo_width'] && $config['logo_height'] ) : ?>
							width="<?php echo esc_attr( $config['logo_width'] ); ?>"
							height="<?php echo esc_attr( $config['logo_height'] ); ?>"
						<?php else : ?>
							width="200"
							height="80"
							layout="responsive"
						<?php endif; ?>
						alt="<?php echo esc_attr( $config['logo_alt'] ); ?>">
					</amp-img>
				</div>
			<?php endif; ?>

			<h2 class="ampforwp-age-gate-headline"><?php echo esc_html( $config['headline'] ); ?></h2>

			<p class="ampforwp-age-gate-age">
				<?php
				printf(
					/* translators: %d: minimum age from Age Gate default age setting */
					esc_html__( 'Minimum age: %d', 'accelerated-mobile-pages' ),
					(int) $config['default_age']
				);
				?>
			</p>

			<?php if ( ! empty( $config['subheadline'] ) ) : ?>
				<p class="ampforwp-age-gate-subheadline"><?php echo esc_html( $config['subheadline'] ); ?></p>
			<?php endif; ?>

			{{#lockout}}
				<div class="ampforwp-age-gate-error">
					<?php echo esc_html( $config['failed'] ); ?>
				</div>
			{{/lockout}}
			{{^lockout}}
				<p class="ampforwp-age-gate-challenge"><?php echo esc_html( $config['challenge'] ); ?></p>

				<div class="ampforwp-age-gate-buttons">
					<?php if ( $show_no_first ) : ?>
						<a href="<?php echo esc_url( $no_url ); ?>" class="ampforwp-age-gate-btn ampforwp-age-gate-btn--no">
							<?php echo esc_html( $config['label_no'] ); ?>
						</a>
					<?php endif; ?>

					<a href="<?php echo esc_url( $yes_url ); ?>" class="ampforwp-age-gate-btn ampforwp-age-gate-btn--yes">
						<?php echo esc_html( $config['label_yes'] ); ?>
					</a>

					<?php if ( ! $show_no_first ) : ?>
						<a href="<?php echo esc_url( $no_url ); ?>" class="ampforwp-age-gate-btn ampforwp-age-gate-btn--no">
							<?php echo esc_html( $config['label_no'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			{{/lockout}}
				</div>
			</div>
			{{/passed}}
		</template>
	</amp-list>
	<?php
}

/**
 * Register AMP component scripts for the age gate overlay.
 *
 * @since 1.1.14
 *
 * @param array<string, mixed> $data Template data.
 * @return array<string, mixed>
 */
function ampforwp_age_gate_amp_data( $data ) {
	if ( ! ampforwp_age_gate_should_render_overlay() ) {
		return $data;
	}

	$scripts = array(
		'amp-list'     => 'https://cdn.ampproject.org/v0/amp-list-0.1.js',
		'amp-mustache' => 'https://cdn.ampproject.org/v0/amp-mustache-0.2.js',
	);

	foreach ( $scripts as $component => $src ) {
		if ( empty( $data['amp_component_scripts'][ $component ] ) ) {
			$data['amp_component_scripts'][ $component ] = $src;
		}
	}

	return $data;
}

/**
 * CSS for the AMP age gate overlay.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_css() {
	if ( ! ampforwp_age_gate_should_render_overlay() ) {
		return;
	}
	?>
	.ampforwp-age-gate-list{
		position:fixed;
		top:0;
		left:0;
		width:1px;
		height:1px;
		z-index:2147483647;
		overflow:visible;
	}
	.ampforwp-age-gate-overlay{
		position:fixed;
		top:0;
		right:0;
		bottom:0;
		left:0;
		z-index:2147483646;
		display:flex;
		align-items:center;
		justify-content:center;
		padding:20px;
		background:rgba(0,0,0,.92);
		box-sizing:border-box;
	}
	.ampforwp-age-gate-overlay--hidden,
	.ampforwp-age-gate-overlay[hidden]{
		display:none;
	}
	.ampforwp-age-gate-status{
		position:absolute;
		width:1px;
		height:1px;
		overflow:hidden;
		clip:rect(0,0,0,0);
	}
	.ampforwp-age-gate-error--hidden,
	.ampforwp-age-gate-prompt--hidden{
		display:none;
	}
	.ampforwp-age-gate-panel{
		width:100%;
		max-width:520px;
		padding:28px 24px;
		background:#fff;
		color:#222;
		text-align:center;
		border-radius:4px;
		box-shadow:0 10px 40px rgba(0,0,0,.35);
		box-sizing:border-box;
	}
	.ampforwp-age-gate-logo{
		margin-bottom:16px;
	}
	.ampforwp-age-gate-headline{
		margin:0 0 12px;
		font-size:28px;
		line-height:1.2;
	}
	.ampforwp-age-gate-age{
		margin:0 0 12px;
		font-size:18px;
		line-height:1.4;
		font-weight:600;
	}
	.ampforwp-age-gate-subheadline,
	.ampforwp-age-gate-challenge{
		margin:0 0 18px;
		font-size:16px;
		line-height:1.5;
	}
	.ampforwp-age-gate-error{
		margin:0 0 18px;
		padding:12px 14px;
		background:#fdecea;
		color:#b71c1c;
		font-size:15px;
		line-height:1.45;
		border-radius:3px;
	}
	.ampforwp-age-gate-buttons{
		display:flex;
		flex-wrap:wrap;
		gap:10px;
		justify-content:center;
	}
	.ampforwp-age-gate-form--yes{
		display:inline;
		margin:0;
		padding:0;
	}
	.ampforwp-age-gate-btn{
		display:inline-block;
		min-width:120px;
		padding:12px 24px;
		border:0;
		border-radius:3px;
		font-size:15px;
		font-weight:600;
		cursor:pointer;
		text-decoration:none;
		line-height:1.2;
		box-sizing:border-box;
	}
	.ampforwp-age-gate-btn--yes{
		background:#222;
		color:#fff;
	}
	.ampforwp-age-gate-btn--no{
		background:#f3f3f3;
		color:#222;
		border:1px solid #ccc;
	}
	<?php
}

/**
 * Hook age gate assets and markup into AMP templates.
 *
 * @since 1.1.14
 *
 * @return void
 */
function ampforwp_age_gate_amp_init() {
	if ( ! ampforwp_age_gate_compat_is_enabled() || ! ampforwp_age_gate_compat_is_ready() ) {
		return;
	}

	add_filter( 'amp_post_template_data', 'ampforwp_age_gate_amp_data', 20 );
	add_action( 'amp_post_template_css', 'ampforwp_age_gate_css' );
	add_action( 'ampforwp_body_beginning', 'ampforwp_age_gate_output', 1 );

	if ( is_plugin_active( 'amp/amp.php' ) ) {
		add_action( 'amp_post_template_footer', 'ampforwp_age_gate_output', 1 );
	}
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
				'When enabled, AMP pages show a full-page age verification popup. Yes hides the gate and shows the site; No keeps the popup visible with a rejection message. Compatible with AMP Cache.',
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

add_action( 'init', 'ampforwp_age_gate_maybe_prevent_response_cache', 0 );
add_action( 'amp_init', 'ampforwp_age_gate_amp_init' );
add_action( 'wp_ajax_ampforwp_age_gate_status', 'ampforwp_age_gate_ajax_status' );
add_action( 'wp_ajax_nopriv_ampforwp_age_gate_status', 'ampforwp_age_gate_ajax_status' );
add_action( 'wp_ajax_ampforwp_age_gate_submit', 'ampforwp_age_gate_ajax_submit' );
add_action( 'wp_ajax_nopriv_ampforwp_age_gate_submit', 'ampforwp_age_gate_ajax_submit' );
add_action( 'wp_ajax_ampforwp_age_gate_pass', 'ampforwp_age_gate_pass_handler' );
add_action( 'wp_ajax_nopriv_ampforwp_age_gate_pass', 'ampforwp_age_gate_pass_handler' );
add_action( 'wp_ajax_ampforwp_age_gate_pass_ajax', 'ampforwp_age_gate_pass_ajax_handler' );
add_action( 'wp_ajax_nopriv_ampforwp_age_gate_pass_ajax', 'ampforwp_age_gate_pass_ajax_handler' );
add_action( 'wp_ajax_ampforwp_age_gate_fail', 'ampforwp_age_gate_fail_handler' );
add_action( 'wp_ajax_nopriv_ampforwp_age_gate_fail', 'ampforwp_age_gate_fail_handler' );
