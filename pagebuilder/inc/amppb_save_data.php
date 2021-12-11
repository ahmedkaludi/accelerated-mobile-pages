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
function amppb_save_post( $post_id, $post ){
 
    /* Stripslashes Submitted Data */
    $request = stripslashes_deep( $_POST );
 
    /* Verify/validate */
    if ( ! isset( $request['amppb_nonce'] ) || ! wp_verify_nonce( $request['amppb_nonce'], 'amppb_nonce_action' ) ){
        return $post_id;
    }
    

    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
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
    //Script
    preg_match_all("/<script(?:(?!src).)*>(.*?)<\/script>/",$submitted_data['settingdata']['scripts_data'], $outremove, PREG_SET_ORDER);
    if($outremove && count($outremove)>0){
        foreach($outremove as $unwanted){
            $submitted_data['settingdata']['scripts_data'] = str_replace($unwanted[0], '', $submitted_data['settingdata']['scripts_data']);
        }
    }

    //Style 
    $submitted_data['settingdata']['style_data']=strip_tags($submitted_data['settingdata']['style_data']);
    $submitted_data = json_encode($submitted_data);

    $submitted_data = wp_slash($submitted_data);
    
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