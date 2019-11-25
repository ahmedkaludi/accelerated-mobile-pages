<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
add_filter('ampforwp_enabled_setting_options', 'add_theme_mode_support');
add_filter("redux/options/redux_builder_amp/sections", 'ampforwp_settings_to_cache');
add_action( 'admin_footer', 'ampforwp_enqueue_template_mode_scripts' );
function add_theme_mode_support($modesArray){
	$modesArray[] ='template-mode-amp';
	return $modesArray;
}
if ( ! function_exists( 'ampforwp_settings_to_cache' ) ) {
    function ampforwp_settings_to_cache($sections){
    	$seoSection = array();
    	$unsetArray = array('basic','design', 'opt-structured-data', 'amp-notifications', 'ampforwp-push-notifications', 'disqus-comments', 'fb-instant-article', 'hide-amp-section', 'amp-advance', 'amp-translator', 'amp-theme-settings', 'amp-theme-global-subsection', 'amp-theme-header-settings', 'amp-theme-homepage-settings', 'amp-single', 'amp-theme-footer-settings', 'amp-theme-page-settings', 'amp-social', 'ampforwp-date-section', 'amp-design', 'opt-text-subsection', 'amp-content-builder', 'amp-contact', 'amp-e-commerce', 'opt-choose', 'opt-plugins-manager','ampforwp-new-ux');
        $unsetArray = apply_filters('amp_template_mode_hide_opt_array',$unsetArray);
    	$backupArray = array( 'amp-ads', 'analytics', 'pwa-for-wp', 'amp-performance', 'amp-seo');
        $backupArray = apply_filters('amp_template_mode_show_opt_array',$backupArray);
    	
    	$pwaField = array();
    	foreach($sections as $key => $sec){
    		if( in_array($sec['id'], $backupArray) ){
    			if($sec['id']=='pwa-for-wp'){
    				$pwaField = $sec['fields'];
    				unset($sections[$key]);
    			}
                if($sec['id']=='amp-performance'){
    				$sec['fields'] = array_merge($sec['fields'], $pwaField);
    			}
                $seoSection[] = $sec;
                unset($sections[$key]);
    		}
	    	if( in_array($sec['id'], $unsetArray) ){
                $sections[$key]['class'] = 'hidden';
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
function ampforwp_enqueue_template_mode_scripts(){
        ?> <script>
            jQuery('a[href*="admin.php?page=amp_options&tab=0"]').parents('li').find('li').each(
                function(i,k){
                    if(i>1){
                        $(this).hide();
                    }
                });
            </script>
        <?php
}