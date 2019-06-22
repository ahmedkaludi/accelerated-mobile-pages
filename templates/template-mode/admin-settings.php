<?php
add_filter('ampforwp_enabled_setting_options', 'add_theme_mode_support');
add_filter("redux/options/redux_builder_amp/sections", 'ampforwp_settings_to_cache');
function add_theme_mode_support($modesArray){
	$modesArray[] ='template-mode-amp';
	return $modesArray;
}
if ( ! function_exists( 'ampforwp_settings_to_cache' ) ) {
    function ampforwp_settings_to_cache($sections){
    	$seoSection = array();
    	$unsetArray = array('basic','design', 'opt-structured-data', 'amp-notifications', 'ampforwp-push-notifications', 'disqus-comments', 'fb-instant-article', 'hide-amp-section', 'amp-advance', 'amp-translator', 'amp-theme-settings', 'amp-theme-global-subsection', 'amp-theme-header-settings', 'amp-theme-homepage-settings', 'amp-single', 'amp-theme-footer-settings', 'amp-theme-page-settings', 'amp-social', 'ampforwp-date-section', 'amp-design', 'opt-text-subsection', 'amp-content-builder', 'amp-contact', 'amp-e-commerce', 'opt-go-premium', 'opt-choose', 'opt-plugins-manager');
    	$backupArray = array( 'amp-ads', 'analytics', 'pwa-for-wp', 'amp-performance', 'amp-seo');
    	
    	$pwaField = array();
    	foreach($sections as $key => $sec){
    		if( in_array($sec['id'], $backupArray) ){
    			if($sec['id']=='pwa-for-wp'){
    				$pwaField = $sec['fields'];
    				unset($sections[$key]);
    			}if($sec['id']=='amp-performance'){
    				$sections[$key]['fields'] = array_merge($sec['fields'], $pwaField);
    			}else{
    				$seoSection[] = $sec;
    				unset($sections[$key]);
    			}
    		}
	    	if( in_array($sec['id'], $unsetArray) ){
	    		unset($sections[$key]);
	    	}
    	}
    	$template_mode =  array(array(
				            'id' => 'template-mode-amp',
				            'title' => 'Settings',
				            'icon'  => 'el el-cogs',
				            'priority' => 1,
				            'fields' => array()
				        )
    				);
    	$template_mode = array_merge($template_mode, $seoSection);
    	$sections = array_merge($template_mode, $sections);
    	
        return $sections;
    }
}