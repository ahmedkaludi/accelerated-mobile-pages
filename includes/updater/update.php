<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Activate the license
 */
function ampForWP_extension_activate_license() {
    /*if(!isset($_POST['redux_builder_amp']['amp-license'])){
        print_r($_POST);die;
        echo "yes";die;
        return;
    }
*/
    $selectedOption = get_option('redux_builder_amp',true);
      if( isset($selectedOption['amp-license']) && "" != $selectedOption['amp-license']){
            foreach ($selectedOption['amp-license'] as $ext_key => $ext_value) {
                $amplicense = $ext_value['license'];
                $item_name  = $ext_value['item_name'];
                $store_url  = $ext_value['store_url'];
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
                // make sure the response came back okay
                if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

                    if ( is_wp_error( $response ) ) {
                        $message = $response->get_error_message();
                    } else {
                        $message = __( 'An error occurred, please try again.', 'advanced-amp-ads' );
                    }

                } else {
                    $license_data = json_decode( wp_remote_retrieve_body( $response ) );
                    if ( false === $license_data->success ) {
                        switch( $license_data->error ) {
                            case 'expired' :
                                $message = sprintf(
                                    __( 'Your license key expired on %s.', 'advanced-amp-ads' ),
                                    date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
                                );
                                break;

                            case 'revoked' :

                                $message = __( 'Your license key has been disabled.', 'advanced-amp-ads' );
                                break;

                            case 'missing' :

                                $message = __( 'Invalid license.', 'advanced-amp-ads' );
                                break;

                            case 'invalid' :
                            case 'site_inactive' :

                                $message = __( 'Your license is not active for this URL.', 'advanced-amp-ads' );
                                break;

                            case 'item_name_mismatch' :

                                $message = sprintf( 
                                    __( 'This appears to be an invalid license key for %s.', 'advanced-amp-ads' ),
                                    AMP_ADS_ITEM_NAME
                                );
                                break;

                            case 'no_activations_left':

                                $message = __( 'Your license key has reached its activation limit.', 'advanced-amp-ads' );
                                break;

                            default :

                                $message = __( 'An error occurred, please try again.', 'advanced-amp-ads' );
                                break;
                        }

                    }

                }//else Closed
                // Check if anything passed on a message constituting a failure
                $status = false;
                if ( ! empty( $message ) ) {
                    $status = false;
                }else{
                    $status = $license_data->license;
                    amp_ads_set_plugin_limit( true, $license_data );
                    $selectedOption['amp-license'][$ext_key]['message'] =  json_decode($license_data,true);
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
           $license = $pluginItemName['license'];
           $pluginItemName = $pluginItemName['item_name'];
           $pluginItemStoreUrl = $pluginItemName['store_url'];
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
            $selectedOption['']
            echo json_encode(array('status'=>500,"message"=>$message));
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

function amp_ads_check_license() {

    global $wp_version;

    $license = trim( get_option( 'amp_ads_license_key' ) );

    $api_params = array(
        'edd_action' => 'check_license',
        'license' => $license,
        'item_name' => urlencode( AMP_ADS_ITEM_NAME ),
        'url'       => home_url()
    );

    // Call the custom API.
    $response = wp_remote_post( AMP_ADS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

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
function amp_ads_admin_notices() {
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
add_action( 'admin_notices', 'amp_ads_admin_notices' );

function amp_ads_set_plugin_limit( $force=false, $license_data='' ) {

    global $wp_version;
    
    $limit = trim( get_option( 'amp_ads_license_limit' ) );
    // If limit is set
    if( ! $force && $limit !== false ) {
        return $limit;
    }

    // If we haven't passed in any license data, get it now
    // Avoid doubling up on HTTP requests
    if( empty( $license_data ) ) {
        
        $license = trim( get_option( 'amp_ads_license_key' ) );

        $api_params = array(
            'edd_action'    => 'check_license',
            'license'       => $license,
            'item_name'     => urlencode( AMP_ADS_ITEM_NAME ),
            'url'           => home_url()
        );

        // Call the custom API.
        //$response = wp_remote_post( AMP_ADS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
        $response = wp_remote_post( AMP_ADS_STORE_URL, array( 'timeout' => 15, 'body' => $api_params ) );

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
    
    update_option( 'amp_ads_license_limit', intval( $limit ) );
    
    return $limit;
    
}
