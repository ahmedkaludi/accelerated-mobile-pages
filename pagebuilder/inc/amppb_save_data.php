<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'amppb_save_post', 10, 2 );
/**
 * Save Page Builder Data When Saving Page
 */
function ampforwp_isjson($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}

/**
 * Sanitize Page Builder head HTML (scripts_data).
 *
 * Allowlist: AMP CDN loader scripts and application/json (or ld+json) config
 * blocks only. Strips XSS vectors (img/svg/onerror, inline JS, non-AMP src).
 *
 * Allowed examples:
 * <script async custom-element="amp-access" src="https://cdn.ampproject.org/v0/amp-access-0.1.js"></script>
 * <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
 *
 * @param mixed $html Raw scripts_data value.
 * @return string Sanitized AMP-only head markup.
 */
function ampforwp_pagebuilder_sanitize_scripts_data( $html ) {
	if ( ! is_string( $html ) || $html === '' ) {
		return '';
	}

	if ( ! preg_match_all( '/<script\b([^>]*)>(.*?)<\/script\s*>/is', $html, $matches, PREG_SET_ORDER ) ) {
		return '';
	}

	$allowed = array();

	foreach ( $matches as $match ) {
		$attrs = $match[1];
		$body  = trim( $match[2] );

		// amp-access / amp-analytics style JSON config (no src, no executable JS).
		if ( preg_match( '/\btype\s*=\s*([\'"])(application\/(?:ld\+)?json)\1/i', $attrs, $type_m )
			&& ! preg_match( '/\bsrc\s*=/i', $attrs ) ) {
			$decoded = json_decode( $body );
			if ( json_last_error() !== JSON_ERROR_NONE ) {
				continue;
			}
			$id_attr = '';
			if ( preg_match( '/\bid\s*=\s*([\'"])([^\'"]+)\1/i', $attrs, $id_m ) ) {
				$id_attr = ' id="' . esc_attr( $id_m[2] ) . '"';
			}
			// Re-encode so </script> cannot break out of the tag.
			$safe_body = wp_json_encode( $decoded, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES );
			if ( false === $safe_body ) {
				continue;
			}
			$allowed[] = '<script type="' . esc_attr( $type_m[2] ) . '"' . $id_attr . '>' . $safe_body . '</script>';
			continue;
		}

		// AMP extension / runtime loaders must have an empty body (no inline JS).
		if ( '' !== $body ) {
			continue;
		}

		if ( ! preg_match( '/\bsrc\s*=\s*([\'"])(https:\/\/cdn\.ampproject\.org\/[^\'"\s]+)\1/i', $attrs, $src_m ) ) {
			continue;
		}

		$src = esc_url( $src_m[2], array( 'https' ) );
		if ( ! $src || 0 !== strpos( $src, 'https://cdn.ampproject.org/' ) ) {
			continue;
		}

		$is_runtime = (bool) preg_match( '#^https://cdn\.ampproject\.org/v0\.js$#i', $src );
		$custom_attr = '';

		if ( preg_match( '/\bcustom-element\s*=\s*([\'"])(amp-[a-z0-9-]+)\1/i', $attrs, $ce_m ) ) {
			$custom_attr = ' custom-element="' . esc_attr( $ce_m[2] ) . '"';
		} elseif ( preg_match( '/\bcustom-template\s*=\s*([\'"])(amp-[a-z0-9-]+)\1/i', $attrs, $ct_m ) ) {
			$custom_attr = ' custom-template="' . esc_attr( $ct_m[2] ) . '"';
		} elseif ( ! $is_runtime ) {
			continue;
		}

		$tag  = '<script';
		$tag .= preg_match( '/\basync\b/i', $attrs ) ? ' async' : '';
		$tag .= $custom_attr;
		$tag .= ' src="' . esc_url( $src ) . '"></script>';

		$allowed[] = $tag;
	}

	return implode( "\n", $allowed );
}

function amppb_save_post( $post_id, $post ){
 
    /* Stripslashes Submitted Data */
    $request = stripslashes_deep( $_POST );
 
    /* Verify/validate — nonce is bound to the post ID being saved */
    if ( ! isset( $request['amppb_nonce'] ) || ! wp_verify_nonce( $request['amppb_nonce'], 'amppb_nonce_action_' . $post_id ) ){
        return $post_id;
    }
    

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
         return $post_id;
    }
    /* Do not save on autosave */
    if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    
    /* == Save, Delete, or Update Page Builder Data == */
 
    $ampforwp_pagebuilder_enable = isset( $request['ampforwp_page_builder_enable'] ) ?  sanitize_text_field($request['ampforwp_page_builder_enable'])  : null;
    update_post_meta( $post_id, 'ampforwp_page_builder_enable', $ampforwp_pagebuilder_enable );
    
    /* Get (old) saved page builder data */
    $saved_data = get_post_meta( $post_id, 'amp-page-builder', true );
 
    /* Get new submitted data and sanitize it. */
    $submitted_data = isset( $request['amp-page-builder'] ) &&  ampforwp_isjson($request['amp-page-builder']) ? $request['amp-page-builder'] : null;


    $submitted_data = json_decode($submitted_data,true);
    if ( ! is_array( $submitted_data ) ) {
        $submitted_data = null;
    }

    if ( is_array( $submitted_data ) ) {
        if ( ! isset( $submitted_data['settingdata'] ) || ! is_array( $submitted_data['settingdata'] ) ) {
            $submitted_data['settingdata'] = array();
        }
        // Allowlist sanitizer — do not use blocklist regex for scripts_data.
        $scripts_data = isset( $submitted_data['settingdata']['scripts_data'] ) ? $submitted_data['settingdata']['scripts_data'] : '';
        $submitted_data['settingdata']['scripts_data'] = ampforwp_pagebuilder_sanitize_scripts_data( $scripts_data );

        // Style
        $style_data = isset( $submitted_data['settingdata']['style_data'] ) ? $submitted_data['settingdata']['style_data'] : '';
        $submitted_data['settingdata']['style_data'] = wp_strip_all_tags( $style_data );
        $submitted_data = wp_json_encode( $submitted_data );
        $submitted_data = wp_slash( $submitted_data );
    }
    
    /* New data submitted, No previous data, create it  */
    if ( $submitted_data && '' == $saved_data ){
        add_post_meta( $post_id, 'amp-page-builder', $submitted_data, true );
    }
    /* New data submitted, but it's different data than previously stored data, update it */
    elseif( $submitted_data ){
        update_post_meta( $post_id, 'amp-page-builder', $submitted_data );
    }
    
    /* New data submitted is empty, but there's old data available, delete it. */
    elseif ( empty( $submitted_data ) && $saved_data ){
        delete_post_meta( $post_id, 'amp-page-builder' );
    }
}
