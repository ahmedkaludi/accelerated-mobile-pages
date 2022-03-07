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
						'widget_ampforwp_categories_widget',
						'ampforwp_plugin_info',
						'ampforwp_structure_data_module_upgrade'
					);
	$post_meta_array = array(
							'use_ampforwp_page_builder',
							'ampforwp_page_builder_enable',
							'amp-page-builder',
							'ampforwp_custom_content_editor',
							'ampforwp_custom_content_editor_checkbox',
							'ampforwp_custom_sidebar_select',
							'ampforwp-amp-on-off',
							'ampforwp-redirection-on-off',
							'ampforwp-wpautop',
							);

	if ( is_multisite() ) {

		// for site options in Multisite
		delete_site_option($option_name);
		if(is_array($optionsArray)){
			foreach ($optionsArray as $key => $optionName) {
				delete_site_option($optionName);
			}
		}

		// Post Meta
		if(is_array($post_meta_array)){
			foreach ($post_meta_array as $post_meta ) {
				delete_post_meta_by_key( $post_meta ); 
			}
		}
		delete_site_option('ampforwp_option_panel_view_type');
	}else{
		delete_option($option_name);
		if(is_array($optionsArray)){
			foreach ($optionsArray as $key => $optionName) {
				delete_option($optionName);
			}
		}

		// Post Meta
		if(is_array($post_meta_array)){
			foreach ($post_meta_array as $post_meta ) {
				delete_post_meta_by_key( $post_meta ); 
			}
		}
		delete_option('ampforwp_option_panel_view_type');
		delete_option("ampforwp_feedback_remove_notice");
		delete_option("ampforwp_dismiss_discount_btn");
		delete_option("ampforwp_tpd_remove_notice");
	}
}