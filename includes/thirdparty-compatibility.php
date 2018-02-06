<?php
//Remove ResponsifyWP #1131
add_action('plugins_loaded', 'ampforwp_filter_remove_function_responsifywp');
function ampforwp_filter_remove_function_responsifywp(){
  if(is_plugin_active('responsify-wp/responsify-wp.php')){
	add_filter('rwp_add_filters','removeFilterOfResponsify');
	function removeFilterOfResponsify($filter){
	  return '';
	}
  }
}

// Strange spaces when using Sassy Social Share #1185
add_filter('heateor_sss_disable_sharing','ampforwp_removing_sassy_social_share');
function ampforwp_removing_sassy_social_share(){
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		return 1;
	}
}

// Remove Schema theme Lazy Load #1170

add_action('pre_amp_render_post','schema_lazy_load_remover');
function schema_lazy_load_remover(){
	remove_filter( 'wp_get_attachment_image_attributes', 'mts_image_lazy_load_attr', 10, 3 );
	remove_filter('the_content', 'mts_content_image_lazy_load_attr');
}


require_once AMPFORWP_PLUGIN_DIR . '/includes/updater/update.php';





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
	  			$item_name 	= $ext_value['item_name'];
	  			$store_url 	= $ext_value['store_url'];
	  			if($store_url!="" && $ext_value['status']==='valid'){
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
		        }

		        // Set the license limit
		        // First parameter must be true to force an update (e.g. after upgrading)
		        amp_ads_set_plugin_limit( true, $license_data );

		        // $license_data->license will be either "valid" or "invalid"
		        /*update_option( 'amp_ads_license_status', $license_data->license );
		        wp_redirect( admin_url( 'edit.php?post_type=tracked-plugin&page=' . AMP_ADS_LICENSE_PAGE ) );
		        exit();*/

		        $selectedOption['amp-license'][$ext_key]['status'] =  $status;
		        $selectedOption['amp-license'][$ext_key]['message'] =  $message;
		        $selectedOption['amp-license'][$ext_key]['message'] =  json_decode($license_data,true);
	  		}
	  		update_option( 'redux_builder_amp', $selectedOption );
	  		
	  		wp_redirect( admin_url( '?page=amp_options&tab=2' ) );

        }



}
add_action( 'redux/options/redux_builder_amp/saved', 'ampForWP_extension_activate_license');
