<?php
/**
 * Uninstall AMP For wp
 *
 */// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
$redux_builder_amp = get_option('redux_builder_amp',true);
if(isset($redux_builder_amp['ampforwp-delete-on-uninstall']) && $redux_builder_amp['ampforwp-delete-on-uninstall']==1){
		
	$option_name = 'redux_builder_amp';
	
	$optionsArray = array(
						'ampforwp_rewrite_flush_option',
						'AMPforwp_db_version',
						'AMP-category-base-removal-status',
						'redux_support_hash',
						'ampforwp_exclude_post',
						'ampforwp_cpt_generated_post_types',
						'ampforwp_custom_post_types',
						'amp_customizer',
						'ampforwp_design',
						'ampforwp_default_pages_to',
						'ampforwp_installer_completed',
						'redux_builder_amp-transients',

						);
	if ( is_multisite() ) {

		// for site options in Multisite
		delete_site_option($option_name);
		if(is_array($optionsArray)){
			foreach ($optionsArray as $key => $optionName) {
				delete_site_option($optionName);
			}
		}

	}else{
		
		delete_option($option_name);
		if(is_array($optionsArray)){
			foreach ($optionsArray as $key => $optionName) {
				delete_option($optionName);
			}
		}
	}
	 
	
	// drop a custom database table
	/*global $wpdb;
	$wpdb->query("");*/

}

