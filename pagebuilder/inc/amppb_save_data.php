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
 * Allowlist-only: strips all HTML tags (script/img/svg/event handlers, etc.).
 * Applied at both save and render so stored payloads cannot execute.
 *
 * @param mixed $html Raw scripts_data value.
 * @return string Sanitized value safe for head output.
 */
function ampforwp_pagebuilder_sanitize_scripts_data( $html ) {
	if ( ! is_string( $html ) || $html === '' ) {
		return '';
	}
	return wp_kses_post( $html );
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
