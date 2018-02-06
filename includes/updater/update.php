<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function amp_ads_license_menu() {
    add_plugins_page( 'Plugin License', 'Plugin License', 'manage_options', AMP_ADS_LICENSE_PAGE, 'AMP_ADS_LICENSE_PAGE' );
}
add_action( 'admin_menu', 'amp_ads_license_menu');

function AMP_ADS_LICENSE_PAGE() {
    $license = get_option( 'amp_ads_license_key' );
    $status  = get_option( 'amp_ads_license_status' );
    ?>
    <div class="wrap">
        <h2><?php _e( 'License', 'advanced-amp-ads' ); ?></h2>
        <form method="post" action="options.php">

            <?php settings_fields( 'amp_ads_plugin_license'); ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                            <?php _e( 'License Key', 'advanced-amp-ads' ); ?>
                        </th>
                        <td>
                            <input id="amp_ads_license_key" name="amp_ads_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
                            <p class="description" for="amp_ads_license_key"><?php _e( 'Enter your license key', 'advanced-amp-ads' ); ?></p>
                        </td>
                    </tr>
                    <?php if( false !== $license && '' != $license ) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e( 'Action', 'advanced-amp-ads' ); ?>
                            </th>
                            <td>
                                <?php if( $status !== false && $status == 'valid' ) { ?>
                                    <?php wp_nonce_field( 'advanced_amp_ads_nonce', 'advanced_amp_ads_nonce' ); ?>
                                    <input type="submit" class="button-secondary" name="amp_ads_license_deactivate" value="<?php _e( 'Deactivate License', 'advanced-amp-ads' ); ?>"/>
                                <?php } else {
                                    wp_nonce_field( 'advanced_amp_ads_nonce', 'advanced_amp_ads_nonce' ); ?>
                                    <input type="submit" class="button-secondary" name="amp_ads_license_activate" value="<?php _e( 'Activate License', 'advanced-amp-ads' ); ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if( false !== $license && '' != $license ) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e( 'Status', 'advanced-amp-ads' ); ?>
                            </th>
                            <td>
                                <?php if( $status !== false && $status == 'valid' ) { ?>
                                    <span style="color: green;"><span class="dashicons dashicons-yes"></span> <?php _e( 'Active', 'advanced-amp-ads' ); ?></span>
                                <?php } else { ?>
                                    <span style="color: red;"><span class="dashicons dashicons-no-alt"></span> <?php _e( 'Inactive', 'advanced-amp-ads' ); ?></span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
            <?php submit_button(); ?>

        </form>
    <?php
}

function amp_ads_register_option() {
    // creates our settings in the options table
    register_setting( 'amp_ads_plugin_license', 'amp_ads_license_key', 'amp_ads_sanitize_license' );
}
add_action( 'admin_init', 'amp_ads_register_option');

function amp_ads_sanitize_license( $new ) {
    $old = get_option( 'amp_ads_license_key' );
    if( $old && $old != $new ) {
        delete_option( 'amp_ads_license_status' ); // new license has been entered, so must reactivate
    }
    return $new;
}

/**
 * Activate the license
 */
function amp_ads_activate_license() {

    // listen for our activate button to be clicked
    if( isset( $_POST['amp_ads_license_activate'] ) ) {

        // run a quick security check
        if( ! check_admin_referer( 'advanced_amp_ads_nonce', 'advanced_amp_ads_nonce' ) )
            return; // get out if we didn't click the Activate button

        // retrieve the license from the database
        $license = trim( get_option( 'amp_ads_license_key' ) );

        // data to send in our API request
        $api_params = array(
            'edd_action' => 'activate_license',
            'license'    => $license,
            'item_name'  => urlencode( AMP_ADS_ITEM_NAME ), // the name of our product in EDD
            'url'        => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post( AMP_ADS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

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

        }

        // Check if anything passed on a message constituting a failure
        if ( ! empty( $message ) ) {
            $base_url = admin_url( 'base_url' . AMP_ADS_LICENSE_PAGE );
            $redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

            wp_redirect( $redirect );
            exit();
        }
        
        // Set the license limit
        // First parameter must be true to force an update (e.g. after upgrading)
        amp_ads_set_plugin_limit( true, $license_data );

        // $license_data->license will be either "valid" or "invalid"
        update_option( 'amp_ads_license_status', $license_data->license );
        wp_redirect( admin_url( 'edit.php?post_type=tracked-plugin&page=' . AMP_ADS_LICENSE_PAGE ) );
        exit();
    }
}
add_action( 'admin_init', 'amp_ads_activate_license');


/***********************************************
* Illustrates how to deactivate a license key.
* This will decrease the site count
***********************************************/

function amp_ads_deactivate_license() {

    // listen for our activate button to be clicked
    if( isset( $_POST['amp_ads_license_deactivate'] ) ) {

        // run a quick security check
        if( ! check_admin_referer( 'advanced_amp_ads_nonce', 'advanced_amp_ads_nonce' ) )
            return; // get out if we didn't click the Activate button

        // retrieve the license from the database
        $license = trim( get_option( 'amp_ads_license_key' ) );


        // data to send in our API request
        $api_params = array(
            'edd_action' => 'deactivate_license',
            'license'    => $license,
            'item_name'  => urlencode( AMP_ADS_ITEM_NAME ), // the name of our product in EDD
            'url'        => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post( AMP_ADS_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

        // make sure the response came back okay
        if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

            if ( is_wp_error( $response ) ) {
                $message = $response->get_error_message();
            } else {
                $message = __( 'An error occurred, please try again.', 'advanced-amp-ads' );
            }

            $base_url = admin_url( 'plugins.php?page=' . AMP_ADS_LICENSE_PAGE );
            $redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

            wp_redirect( $redirect );
            exit();
        }

        // decode the license data
        $license_data = json_decode( wp_remote_retrieve_body( $response ) );

        // $license_data->license will be either "deactivated" or "failed"
        if( $license_data->license == 'deactivated' ) {
            delete_option( 'amp_ads_license_status' );
        }

        wp_redirect( admin_url( 'edit.php?post_type=tracked-plugin&page=' . AMP_ADS_LICENSE_PAGE ) );
        exit();

    }
}
add_action( 'admin_init', 'amp_ads_deactivate_license');


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
