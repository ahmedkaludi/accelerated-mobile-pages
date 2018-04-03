<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Activate the license
 */
function ampForWP_extension_activate_license() {
    //Get Data from Redux data
    $selectedOption = get_option('redux_builder_amp',true);
      if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license']){
            foreach ($selectedOption['amp-license'] as $ext_key => $ext_value) {
                $amplicense = $ext_value['license'];
                $item_name  = $ext_value['item_name'];
                $store_url  = $ext_value['store_url'];
                $plugin_active_path  = (isset($ext_value['plugin_active_path'])? $ext_value['plugin_active_path'] : "");
                if($store_url!="" && isset($ext_value['status']) && $ext_value['status']==='valid'){
                    continue;
                }
                // data to send in our API request
                $api_params = array(
                    'edd_action' => 'activate_license',
                    'license'    => $amplicense,
                    'item_name'  => urlencode( $item_name ), // the name of our product in EDD
                    'url'        => home_url()
                );

                // Call the custom API.
                $response = wp_remote_post( $store_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
                 $message = '';
                // make sure the response came back okay
                if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

                    if ( is_wp_error( $response ) ) {
                        $message = $response->get_error_message();
                    } else {
                        $message = __( 'An error occurred, please try again.', 'ampforwp-extension-updater' );
                    }

                } else {
                    $response = wp_remote_retrieve_body( $response );
                    $license_data = json_decode( $response );
                    if ( false === $license_data->success ) {
                        switch( $license_data->error ) {
                            case 'expired' :
                                $message = sprintf(
                                    __( 'Your license key expired on %s.', 'ampforwp-extension-updater' ),
                                    date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
                                );
                                $message .= "<a href='".$store_url."/checkout-2/?edd_license_key=16ed15c13524cc7e00346eeb3f76e412'>Renew Link</a>";
                                break;

                            case 'revoked' :

                                $message = __( 'Your license key has been disabled.', 'ampforwp-extension-updater' );
                                break;

                            case 'missing' :

                                $message = __( 'Invalid license.', 'ampforwp-extension-updater' );
                                break;

                            case 'invalid' :
                            case 'site_inactive' :

                                $message = __( 'Your license is not active for this URL.', 'ampforwp-extension-updater' );
                                break;

                            case 'item_name_mismatch' :

                                $message = sprintf( 
                                    __( 'This appears to be an invalid license key for %s.', 'ampforwp-extension-updater' ),
                                    $item_name
                                );
                                break;

                            case 'no_activations_left':

                                $message = __( 'Your license key has reached its activation limit.', 'ampforwp-extension-updater' );
                                break;

                            default :

                                $message = __( 'An error occurred, please try again.', 'ampforwp-extension-updater' );
                                break;
                        }

                    }

                }//else Closed
                // Check if anything passed on a message constituting a failure
                $status = false;
                if ( ! empty( $message ) ) {
                    if(is_object($license_data)){
                        $status = $license_data->error;
                    }else{
                        $status = "An error occurred, Error type not found.";
                    }
                }else{
                    $status = $license_data->license;
                    $limit = ampforwp_set_plugin_limit( true, $license_data, $ext_value);
                    $selectedOption['amp-license'][$ext_key]['limit'] =  $limit;
                    $selectedOption['amp-license'][$ext_key]['all_data'] =  json_decode($response,true);
                }

                // Set the license limit
                // First parameter must be true to force an update (e.g. after upgrading)
               

                // $license_data->license will be either "valid" or "invalid"
                /*update_option( 'amp_ads_license_status', $license_data->license );
                wp_redirect( admin_url( 'edit.php?post_type=tracked-plugin&page=' . AMP_ADS_LICENSE_PAGE ) );
                exit();*/

                $selectedOption['amp-license'][$ext_key]['status'] =  $status;
                $selectedOption['amp-license'][$ext_key]['message'] =  $message;
                
            }
            update_option( 'redux_builder_amp', $selectedOption );
            
            //wp_redirect( admin_url( '?page=amp_options&tab=2' ) );

        }



}
add_action( 'redux/options/redux_builder_amp/saved', 'ampForWP_extension_activate_license');

/***********************************************
* Illustrates how to deactivate a license key.
* This will decrease the site count
***********************************************/

function ampforwp_deactivate_license() {

    // listen for our activate button to be clicked
    if( isset( $_POST['ampforwp_license_deactivate'] ) ) {

        // retrieve the license from the database
        $selectedOption = get_option('redux_builder_amp',true);
        $license = '';//trim( get_option( 'amp_ads_license_key' ) );
        $pluginItemName = '';
        $pluginItemStoreUrl = '';
        if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license']){
           $pluginsDetail = $selectedOption['amp-license'][$_POST['ampforwp_license_deactivate']];
           $license = $pluginsDetail['license'];
           $pluginItemName = $pluginsDetail['item_name'];
           $pluginItemStoreUrl = $pluginsDetail['store_url'];
        }
        
        // data to send in our API request
        $api_params = array(
            'edd_action' => 'deactivate_license',
            'license'    => $license,
            'item_name'  => urlencode( $pluginItemName ), // the name of our product in EDD
            'url'        => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post( $pluginItemStoreUrl, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

        // make sure the response came back okay
        if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

            if ( is_wp_error( $response ) ) {
                $message = $response->get_error_message();
            } else {
                $message = __( 'An error occurred, please try again.', 'advanced-amp-ads' );
            }

            /*$base_url = admin_url( 'plugins.php?page=' . AMP_ADS_LICENSE_PAGE );
            $redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

            wp_redirect( $redirect );*/
            echo json_encode(array('status'=>500,"message"=>$message,"test"=>$selectedOption['amp-license'][$_POST['ampforwp_license_deactivate']], "dsc"=>$pluginItemStoreUrl));
            exit();
        }

        // decode the license data
        $license_data = json_decode( wp_remote_retrieve_body( $response ) ,true);

        // $license_data->license will be either "deactivated" or "failed"
        if( $license_data->license == 'deactivated' ) {
            delete_option( 'amp_ads_license_status' );
        }
        if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license']){
           $selectedOption['amp-license'][$_POST['ampforwp_license_deactivate']]['status']= 'invalid';
           $selectedOption['amp-license'][$_POST['ampforwp_license_deactivate']]['license']= '';
           update_option( 'redux_builder_amp', $selectedOption );
        }
        echo json_encode(array('status'=>200,"message"=>$message));
       /* wp_redirect( admin_url( 'edit.php?post_type=tracked-plugin&page=' . AMP_ADS_LICENSE_PAGE ) );*/
        exit();

    }
}
add_action( 'wp_ajax_ampforwp_deactivate_license', 'ampforwp_deactivate_license' );
//add_action( 'admin_init', 'ampforwp_deactivate_license');


/************************************
* this illustrates how to check if
* a license key is still valid
* the updater does this for you,
* so this is only needed if you
* want to do something custom
*************************************/

function ampforwp_check_extension_license() {

    global $wp_version;

    //$license = trim( get_option( 'amp_ads_license_key' ) );

    $selectedOption = get_option('redux_builder_amp',true);
    $license = '';//trim( get_option( 'amp_ads_license_key' ) );
    $pluginItemName = '';
    $pluginItemStoreUrl = '';
    if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license']){
       $pluginsDetail = $selectedOption['amp-license'][$_POST['ampforwp_license_deactivate']];
       $license = $pluginsDetail['license'];
       $pluginItemName = $pluginsDetail['item_name'];
       $pluginItemStoreUrl = $pluginsDetail['store_url'];
    }

    $api_params = array(
        'edd_action' => 'check_license',
        'license' => $license,
        'item_name' => urlencode( $pluginItemName ),
        'url'       => home_url()
    );

    // Call the custom API.
    $response = wp_remote_post( $pluginItemStoreUrl, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

    if ( is_wp_error( $response ) )
        return false;

    $license_data = json_decode( wp_remote_retrieve_body( $response ) );

    if( $license_data->license == 'valid' ) {
        echo 'valid'; exit;
        // this license is still valid
    } else {
        echo 'invalid'; exit;
        // this license is no longer valid
    }
}

/**
 * This is a means of catching errors from the activation method above and displaying it to the customer
 */
function ampforwp_admin_notices() {
    if ( isset( $_GET['sl_activation'] ) && ! empty( $_GET['message'] ) ) {

        switch( $_GET['sl_activation'] ) {

            case 'false':
                $message = urldecode( $_GET['message'] );
                ?>
                <div class="error">
                    <p><?php echo $message; ?></p>
                </div>
                <?php
                break;

            case 'true':
            default:
                // Developers can put a custom success message here for when activation is successful if they way.
                break;

        }
    }
}
add_action( 'admin_notices', 'ampforwp_admin_notices' );

function ampforwp_set_plugin_limit( $force=false, $license_data='', $data) {

    global $wp_version;
    
    $limit = isset($data['limit']) ? trim( $data['limit'] ) : false;
    // If limit is set
    if( ! $force && $limit !== false ) {
        return $limit;
    }

    // If we haven't passed in any license data, get it now
    // Avoid doubling up on HTTP requests
    if( empty( $license_data ) ) {
        
        $license = trim( isset($data['license']) ? $data['license'] : "" );
        $store_url =  isset($data['store_url']) ? $data['store_url'] : "" ;
        $item_name =  isset($data['item_name']) ? $data['item_name'] : "" ;

        $api_params = array(
            'edd_action'    => 'check_license',
            'license'       => $license,
            'item_name'     => urlencode( $item_name ),
            'url'           => home_url()
        );

        // Call the custom API.
        //$response = wp_remote_post( AMP_ADS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
        $response = wp_remote_post( $store_url, array( 'timeout' => 15, 'body' => $api_params ) );

        if ( is_wp_error( $response ) )
            return false;

        $license_data = json_decode( wp_remote_retrieve_body( $response ) );
        
    }

    $limit = 0;
    
    if( $license_data->license != 'valid' ) {
        // This license is not valid
        $limit = -1;
    } else if( isset( $license_data->license_limit ) ) {
        // Using the license_limit to define how many plugins can be tracked
        $limit = $license_data->license_limit;
    }
    
    //update_option( 'amp_ads_license_limit', intval( $limit ) );
    
    return $limit;
    
}


function ampforwp_plgins_update_message_according_pluginOpt( $plugin_data, $r )
{
    $selectedOption = get_option('redux_builder_amp',true);
    $license_key = '';//trim( get_option( 'amp_ads_license_key' ) );
    $pluginItemName = '';
    $pluginItemStoreUrl = '';
    $pluginstatus = '';
    if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license']){
       $pluginsDetail = $selectedOption['amp-license']['amp-ads-google-adsense'];
       $license_key = $pluginsDetail['license'];
       $pluginItemName = $pluginsDetail['item_name'];
       $pluginItemStoreUrl = $pluginsDetail['store_url'];
       $pluginstatus = $pluginsDetail['status'];
    }

    if($license_key==""){
        echo "<a href='".self_admin_url("?page=amp_options&tab=29")."'>Please enter key</a>";
    }
    if($pluginstatus!="valid"){
        echo "<a href='".self_admin_url("?page=amp_options&tab=29")."'>Please enter a valid key</a>";
    }

}