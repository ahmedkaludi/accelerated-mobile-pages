<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function amp_get_permalink( $post_id ) {
	$pre_url = apply_filters( 'amp_pre_get_permalink', false, $post_id );
	$amp_url = '';
	if ( false !== $pre_url ) {
		return $pre_url;
	}

	$structure = get_option( 'permalink_structure' );
	if ( empty( $structure ) ) {
		$amp_url = add_query_arg( AMP_QUERY_VAR, 1, get_permalink( $post_id ) );
	} else {
			$get_permalink = get_permalink( $post_id );
			if( $get_permalink != false){
				$amp_url = trailingslashit( $get_permalink );
 				$amp_url = ampforwp_end_point_controller($amp_url);
 			}
	 	}

	return apply_filters( 'amp_get_permalink', $amp_url, $post_id );
}

function post_supports_amp( $post ) {
	// Because `add_rewrite_endpoint` doesn't let us target specific post_types :(
	if ( ! post_type_supports( $post->post_type, AMP_QUERY_VAR ) ) {
		return false;
	}

	if ( post_password_required( $post ) ) {
		return false;
	}

	if ( true === apply_filters( 'amp_skip_post', false, $post->ID, $post ) ) {
		return false;
	}

	return true;
}

/**
 * Are we currently on an AMP URL?
 *
 * Note: will always return `false` if called before the `parse_query` hook.
 */
function is_amp_endpoint() {
	return false !== get_query_var( AMP_QUERY_VAR, false );
}

function amp_get_asset_url( $file ) {
	return plugins_url( sprintf( 'assets/%s', $file ), AMPFORWP__FILE__ );
}
