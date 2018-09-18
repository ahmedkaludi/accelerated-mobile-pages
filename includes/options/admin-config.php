<?php
//Admin Panel Options        
if ( ! class_exists( 'Redux' ) ) {
    return;
}
// Option name where all the Redux data is stored.
$opt_name = "redux_builder_amp";
$comment_desc = "";
$amptfad = '<strong>DID YOU KNOW?</strong></br ><a href="https://ampforwp.com/amp-theme-framework/"  target="_blank">You can create your own <strong>Custom theme with AMP Theme Framework</strong></a>';
// #1093 Display only If AMP Comments is Not Installed
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
   if(!is_plugin_active( 'amp-comments/amp-comments.php' )){
$comment_AD_URL = "http://ampforwp.com/amp-comments/#utm_source=options-panel&utm_medium=comments-tab&utm_campaign=AMP%20Plugin";
$comment_desc = '<a href="'.$comment_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/comments-banner.png" width="560" height="85" /></a>';
}
// Display only If AMP Cache is Not Installed
$cache_desc ="";
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
   if(!is_plugin_active( 'amp-cache/ampforwp-cache.php' )){
$cache_AD_URL = "http://ampforwp.com/amp-cache/#utm_source=options-panel&utm_medium=performance-tab&utm_campaign=AMP%20Plugin";
$cache_desc = '<a href="'.$cache_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp_cache_b.png" width="560" height="85" /></a>';
}
// If CTA is not Activated
$cta_desc = "";
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
   if(!is_plugin_active( 'AMP-cta/amp-cta.php' )){
$cta_AD_URL = "http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=call-to-action_banner_in_notification_bar&utm_campaign=AMP%20Plugin";
$cta_desc = '<a href="'.$cta_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/cta-banner.png" width="560" height="85" /></a>';
}
$all_extensions_data = array();
global $all_extensions_data;
$extension_listing_array = array(
                        array(
                            'name'=>'ADS for WP',
                            'desc'=>'A Revolutionary way of adding ADS in your WordPress',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/click.png',
                            'price'=>'$29',
                            'url_link'=>'http://ampforwp.com/ads-for-wp/#utm_source=options-panel&utm_medium=extension-tab_advanced-amp-ads&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'ads-for-wp/ads-for-wp.php',
                            'item_name'=>'ADS for WP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('ads-for-wp/ads-for-wp.php')? 1: 2),
                            'settingUrl'=>admin_url('edit.php?post_type=ads-for-wp-ads'),
                        ),
                        array(
                            'name'=>'Advanced AMP ADS',
                            'desc'=>'Add Advertisement directly in the content',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/click.png',
                            'price'=>'$29',
                            'url_link'=>'http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=extension-tab_advanced-amp-ads&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-incontent-ads/amptoolkit-incontent-ads.php',
                            'item_name'=>'Advanced AMP Ads',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-incontent-ads/amptoolkit-incontent-ads.php')? 1:2),
                            'settingUrl'=>'{ampforwp-incontent-ads-subsection}',
                        ),
                        array(
                            'name'=>'Contact Form 7',
                            'desc'=>'Add Contact Us Form in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/cf7.png',
                            'price'=>'$39',
                            'url_link'=>'http://ampforwp.com/contact-form-7/#utm_source=options-panel&utm_medium=extension-tab_cf7&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-cf7/amp-cf7.php',
                            'item_name'=>'Contact Form 7 for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-cf7/amp-cf7.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-cf7-subsection}',
                        ),
                        array(
                            'name'=>'Gravity Forms',
                            'desc'=>'Add Gravity Forms Support in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/gf.png',
                            'price'=>'$79',
                            'url_link'=>'http://ampforwp.com/gravity-forms/#utm_source=options-panel&utm_medium=extension-tab_gf&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-gravity-forms/amp-gravity-forms.php',
                            'item_name'=>'Gravity Forms',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-gravity-forms/amp-gravity-forms.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-gf-subsection}',
                        ),
                        array(
                            'name'=>'bbPress For AMP',
                            'desc'=>'Add bbPress Forum Compatibility to your AMP version',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/bbp-icon.png',
                            'price'=>'$89',
                            'url_link'=>'http://ampforwp.com/bbpress/#utm_source=options-panel&utm_medium=extension-tab_bbpress-for-wordpress&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'bbpress-for-amp/bbpress-for-amp.php',
                            'item_name'=>'bbPress for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('bbpress-for-amp/bbpress-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Ninja Forms for AMP',
                            'desc'=>'Add Ninja Forms Support in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/nf.png',
                            'price'=>'$79',
                            'url_link'=>'http://ampforwp.com/ninja-forms/#utm_source=options-panel&utm_medium=extension-tab_gf&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-ninja-forms/amp-ninja-forms.php',
                            'item_name'=>'Ninja Forms',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-ninja-forms/amp-ninja-forms.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-nf-subsection}',
                        ),
                        array(
                            'name'=>'WP Forms for AMP',
                            'desc'=>'Add WP Forms Support in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/wpf.png',
                            'price'=>'$79',
                            'url_link'=>'http://ampforwp.com/wp-forms/#utm_source=options-panel&utm_medium=extension-tab_gf&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'wp-forms-for-amp/amp-wpforms.php',
                            'item_name'=>'WP Forms for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('wp-forms-for-amp/amp-wpforms.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-wpf-subsection}',
                        ),
                        array(
                            'name'=>'Email Opt-in Forms',
                            'desc'=>'Capture Leads with Email Subscription.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/email.png',
                            'price'=>'$79',
                            'url_link'=>'http://ampforwp.com/opt-in-forms/#utm_source=options-panel&utm_medium=extension-tab_opt-in-forms&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-optin/amp-optin.php',
                            'item_name'=>'Opt-in-Forms for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-optin/amp-optin.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-optin-subsection}'
                        ),
                        array(
                            'name'=>'AMP Cache',
                            'desc'=>'AMP Cache is a Revolutionary Cache System for AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/cache-icon.png',
                            'price'=>'$89',
                            'url_link'=>'http://ampforwp.com/amp-cache/#utm_source=options-panel&utm_medium=extension-tab_cache&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-cache/ampforwp-cache.php',
                            'item_name'=>'AMP Cache',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-cache/ampforwp-cache.php')? 1 : 2),
                            'settingUrl'=>'{opt-go-amp-cache}',
                        ),
                        array(
                            'name'=>'PWA For WordPress',
                            'desc'=>'Add Progressive Web App support for WordPress website',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/pwa-icon.png',
                            'price'=>'$89',
                            'url_link'=>'http://ampforwp.com/pwa/#utm_source=options-panel&utm_medium=extension-tab_pwa-for-wordpress&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'pwa-for-wordpress/amp-pwa.php',
                            'item_name'=>'PWA For WordPress',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('pwa-for-wordpress/amp-pwa.php')? 1 : 2),
                            'settingUrl'=>admin_url( 'admin.php?page=ampforwp-pwa' ),
                        ), 
                        array(
                            'name'=>'AMP Popup',
                            'desc'=>'Pop-Up Functionality for AMP in WordPress. Most easiest and the best way to include Pop-Up in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/pwa-icon.png',
                            'price'=>'$39',
                            'url_link'=>'#',
                            'plugin_active_path'=> 'amp-popup/amp-popup.php',
                            'item_name'=>'AMP Popup',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-popup/amp-popup.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Call To Action (CTA)',
                            'desc'=>'Higher Visibility & More Conversions',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/mac-click.png',
                            'price'=>'$29',
                            'url_link'=>'http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=extension-tab_amp-cta&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-cta/amp-cta.php',
                            'item_name'=>'Call To Action for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-cta/amp-cta.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-cta-subsection}',
                        ),
                        array(
                            'name'=>'AMP WooCommerce Pro',
                            'desc'=>'Advanced WooCommerce in AMP in two clicks.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/woo.png',
                            'price'=>'$79',
                            'url_link'=>'https://ampforwp.com/woocommerce/#utm_source=options-panel&utm_medium=extension-tab_woocommerce&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-woocommerce-pro/amp-woocommerce.php',
                            'item_name'=>'WooCommerce',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-woocommerce-pro/amp-woocommerce.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-wcp-subsection}',
                        ),

                        array(
                            'name'=> 'EDD for AMP',
                            'desc'=> 'EDD compatibility with AMP',
                            'img_src'=> AMPFORWP_IMAGE_DIR . '/edd-icon.png',
                            'price'=> '$19',
                            'url_link'=>'https://ampforwp.com/edd-for-amp/#utm_source=options-panel&utm_medium=extension-tab_edd-for-amp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'edd-for-amp/edd-for-amp.php',
                            'item_name'=>'EDD for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('edd-for-amp/edd-for-amp.php')? 1 : 2),
                        ),

                        array(
                            'name'=>'AMP Layouts',
                            'desc'=>'Design system built for AMP that makes easy to create your own AMP website.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/amplayouts.png',
                            'price'=>'$89',
                            'url_link'=>'https://ampforwp.com/amp-layouts/#utm_source=options-panel&utm_medium=extension-tab_amp-layouts&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-layouts/amp-layouts.php',
                            'item_name'=>'AMP Layouts',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-layouts/amp-layouts.php')? 1 : 2),
                            'settingUrl'=>'{amp-theme-settings}',
                        ),                      

                        array(
                            'name'=>'Newspaper AMP Theme',
                            'desc'=>'Advanced News Magazine theme built for AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/click.png',
                            'price'=>'$49',
                            'url_link'=>'http://ampforwp.com/themes/newspaper/#utm_source=options-panel&utm_medium=extension-tab_themes/newspaper&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-newspaper-theme/ampforwp-custom-theme.php',
                            'item_name'=>'Newspaper Theme for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-newspaper-theme/ampforwp-custom-theme.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-theme-subsection}',
                        ),

                        array(
                            'name'=>'ACF for AMP',
                            'desc'=>'Easily add ACF support in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/acf.png',
                            'price'=>'$29',
                            'url_link'=>'http://ampforwp.com/acf-amp/#utm_source=options-panel&utm_medium=extension-tab_opt-in-forms&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'acf-for-amp-v2/amp-acf.php',
                            'item_name'=>'ACF for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('acf-for-amp-v2/amp-acf.php')? 1 : 2),
                            'settingUrl'=>admin_url('edit.php?post_type=amp_acf'),
                        ),
                        array(
                            'name'=>'AMP Comments',
                            'desc'=>'You can now allow the same comment functionality on AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/comments.png',
                            'price'=>'$29.99',
                            'url_link'=>'https://ampforwp.com/amp-comments/#utm_source=options-panel&utm_medium=extension-tab_amp-comments&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-comments/amp-comments.php',
                            'item_name'=>'AMP Comments',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-comments/amp-comments.php')? 1: 2),
                            'settingUrl'=>'{ampforwp-cmt-subsection}',
                        ),
                        array(
                            'name'=>'Star Ratings',
                            'desc'=>'Star Review Ratings for AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/star.png',
                            'price'=>'$19',
                            'url_link'=>'http://ampforwp.com/amp-ratings/#utm_source=options-panel&utm_medium=extension-tab_amp-ratings&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-rating/amp-rating.php',
                            'item_name'=>'AMP Rating',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-rating/amp-rating.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-ratings-subsection}',
                        ),
                        array(
                            'name'=>'Custom Post Type',
                            'desc'=>'Enable Custom Post type support in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/comments.png',
                            'price'=>'$19',
                            'url_link'=>'http://ampforwp.com/custom-post-type/#utm_source=options-panel&utm_medium=extension-tab_custom-post-type&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-custom-post-type/amp-custom-post-type.php',
                            'item_name'=>'Custom Post Type Support for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-custom-post-type/amp-custom-post-type.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-cpt-subsection}',
                        ), 

                        array(
                            'name'=>'AMP Stories',
                            'desc'=>'A Revolutionary new way to share your stories',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/cache-icon.png',
                            'price'=>'$79',
                            'url_link'=>'https://ampforwp.com/amp-stories/#utm_source=options-panel&utm_medium=extension-tab_stories&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-stories/ampforwp-stories.php',
                            'item_name'=>'AMP Stories',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-stories/ampforwp-stories.php')? 1 : 2),
                            'settingUrl'=>admin_url( 'edit.php?post_type=ampforwp_story' ),
                        ),
                        array(
                            'name'=>'Structured Data for WP',
                            'desc'=>'Structured Data for your site and for AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/sd-icon.png',
                            'price'=>'$29',
                            'url_link'=>'https://ampforwp.com/structuredata-for-wp/#utm_source=options-panel&utm_medium=extension-tab_structuredata-for-wp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'structured-data-for-wp/structured-data-for-wp.php',
                            'item_name'=>'Structured Data for WP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('structured-data-for-wp/structured-data-for-wp.php')? 1: 2),
                          //'settingUrl'=>'',
                        ),
                        array(
                            'name'=>'Polylang For AMP',
                            'desc'=>'Polylang compatibility with AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/polylang-icon.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/polylang-for-amp/#utm_source=options-panel&utm_medium=extension-tab_polylang-for-amp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'polylang-for-amp/amp_polylang.php',
                            'item_name'=>'Polylang For AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('polylang-for-amp/amp_polylang.php')? 1: 2),
                        ),
                        array(
                            'name'=>'WPML For AMP',
                            'desc'=>'WPML compatibility with AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/wpml-icon.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/wpml-for-amp/#utm_source=options-panel&utm_medium=extension-tab_wpml-for-amp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'wpml-for-amp/wpml_for_amp.php',
                            'item_name'=>'WPML For AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('wpml-for-amp/wpml_for_amp.php')? 1: 2),
                        ),
                        array(
                            'name'=>'AMP Teaser',
                            'desc'=>'AMP Teaser automatically clips the content based on your selection',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/teaser-icon.png',
                            'price'=>'$29',
                            'url_link'=>'https://ampforwp.com/amp-teaser/#utm_source=options-panel&utm_medium=extension-tab_amp-teaser&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-teaser/amp-teaser.php',
                            'item_name'=>'AMP Teaser',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-teaser/amp-teaser.php')? 1: 2),
                            'settingUrl'=>'{ampforwp-teaser-subsection}',
                        ),
                        array(
                            'name'=>'View All Extensions',
                            'desc'=>'See all the extensions available for AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/comments.png',
                            'price'=>'FREE',
                            'url_link'=>'https://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=extension-tab_amp-more-comingsoon&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> '',
                            'item_name'=>'',
                            'store_url'=>'',
                            'is_activated'=>2,
                            'settingUrl'=>'',
                        ),
                    );

$extension_listing_array = apply_filters( 'ampforwp_extension_lists_filter', $extension_listing_array );
$all_extensions_data = $extension_listing_array;
$ampforwp_extension_list_html = '';
$ampforwp_nameOfUser = "";
$ampforwp_is_productActivated = false;
function ampforwp_sort_extension_array($a, $b){
    if ($a['is_activated'] == $b['is_activated']) {
        return 0;
    }
    return ($a['is_activated'] < $b['is_activated']) ? -1 : 1;
}
usort($extension_listing_array, 'ampforwp_sort_extension_array');
foreach ($extension_listing_array as $key => $extension) {
    $currentStatus = "";

    $onclickUrl = '<a href="'.$extension['url_link'].'" target="_blank">';
    $onclickUrlclose = '</a>';
    $settingPageUrl = '';
    $pluginReview = '<div class="extension_btn">From: '.$extension['price'].'</div>';
    if($extension['plugin_active_path'] != "" && is_plugin_active($extension['plugin_active_path']) ){
        $ampforwp_is_productActivated = true;
        $currentStatus = "not-active invalid";
        $pathExploded = explode("/", $extension['plugin_active_path']);
        $pathExploded = $pathExploded[0];
        if(isset($extension['settingUrl']) && $extension['settingUrl']!=""){

            $settingPageUrl = '<div class="extension-menu-call"><a href="'.$extension['settingUrl'].'" class="amp_extension_settings"><i class="dashicons-before dashicons-admin-generic"></i> Settings</a></div>';
        }

        $amplicense = '';
        $onclickUrl = $amp_license_response = $allResponseData = $onclickUrlclose= '';
        $allResponseData = array('success'=>'',
                                'license'=> '',
                                'item_name'=> '',
                                'expires'=> '',
                                'customer_name'=> '',
                                'customer_email'=> '',
                                );
        $selectedOption = get_option('redux_builder_amp',true);
        if(isset($selectedOption['amp-license'][$pathExploded])){
            $amplicense = $selectedOption['amp-license'][$pathExploded]['license'];
        }
        $verify = '<button type="button" id="'.$pathExploded.'" class="redux-ampforwp-ext-activate">Activate</button>';
        if(isset($selectedOption['amp-license'][$pathExploded]['status']) && $selectedOption['amp-license'][$pathExploded]['status']==='valid'){
             $currentStatus = 'active valid';
             $verify = '<button type="button" id="'.$pathExploded.'" class="redux-ampforwp-ext-deactivate">Deactivate</button>';
            if($ampforwp_nameOfUser=="" && isset($selectedOption['amp-license'][$pathExploded]['all_data']['customer_name'])){
                $ampforwp_nameOfUser = $selectedOption['amp-license'][$pathExploded]['all_data']['customer_name'];
            }

            if(isset($selectedOption['amp-license'][$pathExploded]['all_data']) && $selectedOption['amp-license'][$pathExploded]['all_data']!=""){
                $allResponseData = $selectedOption['amp-license'][$pathExploded]['all_data'];
                $remainingExpiresDays = floor( ( strtotime($allResponseData['expires'] )- time() )/( 60*60*24 ) );
                if($remainingExpiresDays>0){
                    $amp_license_response = $remainingExpiresDays." Days Remaining. <a href='https://accounts.ampforwp.com/order/?edd_license_key=".$amplicense."&download_id=".$allResponseData['item_name']."'>Renew License</a>";
                }else{ $amp_license_response = "Expired! <a href='https://accounts.ampforwp.com/order/?edd_license_key=".$amplicense."&download_id=".$allResponseData['item_name']."'>Renew your license</a>"; }
            }
        }

        $pluginReview = '<input id="redux_builder_amp_amp-license_'.$pathExploded.'_license" type="text" value="'. str_replace(substr($amplicense, 0, strlen($amplicense)-4), '**', $amplicense).'"  onclick="return false;">  
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][license]" type="hidden" value="'. $amplicense.'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][item_name]" type="hidden" value="'.$extension['item_name'].'"> 
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][store_url]" type="hidden" value="'.$extension['store_url'].'"> 
             <input name="redux_builder_amp[amp-license]['.$pathExploded.'][plugin_active_path]" type="hidden" value="'.$extension['plugin_active_path'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][name]" type="hidden" value="'.$extension['name'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][status]" type="hidden" value="'.$selectedOption['amp-license'][$pathExploded]['status'].'">';
             $pluginReview .= '<input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][success]" type="hidden" value="'.$allResponseData['success'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][license]" type="hidden" value="'.$allResponseData['license'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][item_name]" type="hidden" value="'.$allResponseData['item_name'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][expires]" type="hidden" value="'.$allResponseData['expires'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][customer_name]" type="hidden" value="'.$allResponseData['customer_name'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][customer_email]" type="hidden" value="'.$allResponseData['customer_email'].'">
            ';
        
        $pluginReview .= $verify. "<br/>".$amp_license_response;
        if(isset($selectedOption['amp-license'][$pathExploded]['message']) && $selectedOption['amp-license'][$pathExploded]['message']!=""){
            $pluginReview .= "<div class='afw-license-response-message'>".$selectedOption['amp-license'][$pathExploded]['message']."</div>";
        }
        
    }
    $secondPageClickClass = '';
    if($extension['is_activated']==1 && strpos($ampforwp_extension_list_html, "Your Installed Extensions")===false){
        $ampforwp_extension_list_html .= "<h3 style='display:block;'>Your Installed Extensions</h3><ul>";
    }elseif($extension['is_activated']==2 && strpos($ampforwp_extension_list_html, "All Extensions")===false){
            $ampforwp_extension_list_html .= "</ul><h3 style='display:block;'>All Extensions</h3><ul>";  
            $secondPageClickClass = 'goToSecondPage';
    }
    $ampforwp_extension_list_html .= '<li class="first '.$currentStatus.' '.$secondPageClickClass.'" data-ext-details=\''.json_encode($extension).'\'>
        '.$onclickUrl.'
        <div class="align_left"><img src="'.$extension['img_src'].'" /></div>
        <div class="extension_desc">
        <h2>'.$extension['name'].'</h2>
        <p>'.$extension['desc'].'</p>
        '.$pluginReview.'
        </div>
    '.$onclickUrlclose.' '.$settingPageUrl.'</li>';
}

$extension_listing = '
<div class="extension_listing">
<p style="font-size:13px">Take your AMP to the next level with these premium extensions which gives you advanced features.</p>

   
'.$ampforwp_extension_list_html.'

</ul>
</div>
';

// #2267
function ampforwp_check_extensions(){
	global $all_extensions_data;
	if($all_extensions_data){
		foreach ($all_extensions_data as $extension ) {
			$is_extension_active = $extension['is_activated'];
			if( 1 === $is_extension_active){
				return true;
			}
		}
	}
	
	return false;
}

$freepro_listing = '
<div class="fp-wr">
    <div class="fp-img">
        <img src="'.AMPFORWP_IMAGE_DIR . '/Bitmap.png" />
        <span class="ov"></span>
    </div>
    <div class="fp-cnt">
            <h1>Upgrade to Pro</h1>
            <p>Take your AMP to the next level with more beautiful themes, great extensions and more powerful features.</p>
            <a class="buy" href="#upgrade">BUY NOW</a>
    </div>
    <div class="pvf">
        <div class="ext">
            <div class="ex-1 e-1">
                <img src="'.AMPFORWP_IMAGE_DIR . '/ex-1.png" />
                <h4>Extensions</h4>
                <p>Includes a suite of advanced features like Ads, Email Optin, Contact Forms, E-Commerce, CTA, Cache and 15+ premium extensions.</p>
            </div>
            <div class="ex-1 e-2">
                <img src="'.AMPFORWP_IMAGE_DIR . '/ex-2.png" />
                <h4>Designs</h4>
                <p>Wide Variety of AMP Theme Designs included with AMP Layouts. We are dedicated to release 2-3 new designs every month.</p>
            </div>
            <div class="ex-1 e-3">
                <img src="'.AMPFORWP_IMAGE_DIR . '/ex-3.png" />
                <h4>Dedicated Support</h4>
                <p>Get private ticketing help from our full-time staff who helps you with the technical issues.</p>
            </div>
        </div><!-- /. ext -->
        <div class="pvf-cnt">
            <div class="pvf-tlt">
                <h2>Compare Pro vs. Free Version</h2>
                <span>See what you\'ll get with the professional version</span>
            </div>
            <div class="pvf-cmp">
                <div class="fr">
                    <h1>FREE</h1>
                    <div class="fr-fe">
                        <div class="fe-1">
                            <h4>Continious Development</h4>
                            <p>We take bug reports and feature requests seriously. We’re continiously developing & improve this product for last 2 years with passion and love.</p>
                        </div>
                        <div class="fe-1">
                            <h4>300+ Features</h4>
                            <p>We\'re constantly expanding the plugin and make it more useful. We have wide variety of features which will fit any use-case.</p>
                        </div>
                        <div class="fe-1">
                            <h4>Design</h4>
                            <p>We have 4 Built in themes for AMP which elevates your AMP exeprience.</p>
                        </div>
                        <div class="fe-1">
                            <h4>Technical Support</h4>
                            <p>We have a full time team which helps you with each and every issue regarding AMP.</p>
                        </div>
                    </div><!-- /. fr-fe -->
                </div><!-- /. fr -->
                <div class="pr">
                    <h1>PRO</h1>
                    <div class="pr-fe">
                        <span>Everything in Free, and:</span>
                        <div class="fet">
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Advertisement</h4>
                                </div>
                                <p>Advanced Ad slots, Incontent ads & Supports all Ad networks.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>AMP Cache</h4>
                                </div>
                                <p>Revolutionary cache system for AMP which makes it insanely fast.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Contact Forms</h4>
                                </div>
                                <p>Gravity Forms and Contact form 7 Support for the AMP.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>E-Commerce</h4>
                                </div>
                                <p>WooCommerce & Easy Digital Downloads Support.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Email Optin</h4>
                                </div>
                                <p>Native Email optin forms to capture email with 17+ company integrations.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Call To Action</h4>
                                </div>
                                <p>Get your message, product or offering to your visitors.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Localization</h4>
                                </div>
                                <p>Integrates with WPML, Polylang and WeGlot to provide localization.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Structured Data</h4>
                                </div>
                                <p>Advanced Schema integration in AMP and WordPress.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Advanced Custom Field</h4>
                                </div>
                                <p>Built-in tools to help you impliment ACF easily in AMP.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Ratings</h4>
                                </div>
                                <p>Easily add Rating to the posts. Supports 3 popular rating plugins.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Design Catalogue</h4>
                                </div>
                                <p>AMP Layouts has 6 pre-built designs, We are constantly adding every week.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Dedicated Support</h4>
                                </div>
                                <p>With a Dedicated person helping you with the extension setup and questions.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Continious Updates</h4>
                                </div>
                                <p>We\'re continiously updating our premium features and releasing them.</p>
                            </div>
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>Innovation</h4>
                                </div>
                                <p>Be the first one to get the innovative features that we build in the future.</p>
                            </div>
                        </div><!-- /. fet -->
                        <div class="pr-btn">
                            <a href="#upgrade">Upgrade to Pro</a>
                        </div><!-- /. pr-btn -->
                    </div><!-- /. pr-fe -->
                </div><!-- /.pr -->
            </div><!-- /. pvf-cmp -->
        </div><!-- /. pvf-cnt -->
        <div id="upgrade" class="amp-upg">
            <div class="upg-t">
                <h2>Let\'s Upgrade Your AMP</h2>
                <span>Choose your plan and upgrade in minutes!</span>
            </div>
            <div class="pri-lst">
                <div class="pri-tb">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=1&utm_medium=freevspro&utm_campaign=AMP%20Plugin">
                        <h5>PERSONAL</h5>
                        <span class="amt"><sup>$</sup>149</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">1 Site License</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">Save $800+</span>
                        <span class="pri-by">Buy Now</span>
                    </a>
                </div>
                <div class="pri-tb rec">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=2&utm_medium=freevspro&utm_campaign=AMP%20Plugin">
                        <h5>MULTIPLE</h5>
                        <span class="amt"><sup>$</sup>199</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">3 Site License</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">Save 55%</span>
                        <span class="pri-by">Buy Now</span>
                        <span class="rcm">RECOMMENDED</span>
                    </a>
                </div>
                <div class="pri-tb">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=3&utm_medium=freevspro&utm_campaign=AMP%20Plugin">
                        <h5>WEBMASTER</h5>
                        <span class="amt"><sup>$</sup>249</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">10 Site License</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">Save 83%</span>
                        <span class="pri-by">Buy Now</span>
                    </a>
                </div>
                <div class="pri-tb">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=4&utm_medium=freevspro&utm_campaign=AMP%20Plugin">
                        <h5>FREELANCER</h5>
                        <span class="amt"><sup>$</sup>299</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">25 Site License</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">Save 90%</span>
                        <span class="pri-by">Buy Now</span>
                    </a>
                </div>
                <div class="pri-tb">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=5&utm_medium=freevspro&utm_campaign=AMP%20Plugin">
                        <h5>AGENCY</h5>
                        <span class="amt"><sup>$</sup>499</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">Unlimited</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">UNLIMITED</span>
                        <span class="pri-by">Buy Now</span>
                    </a>
                </div>
            </div><!-- /.pri-lst -->
            <div class="tru-us">
                <img src="'.AMPFORWP_IMAGE_DIR . '/rating.png" />
                <h2>Trusted by more that 130000+ Users!</h2>
                <p>More than 130k Websites, Blogs & E-Commerce website are powered by our AMP making it the #1 Rated AMP plugin in WordPress Community.</p>
                <a href="https://wordpress.org/support/plugin/accelerated-mobile-pages/reviews/?filter=5" target="_blank">Read The Reviews</a>
            </div>
        </div><!--/ .amp-upg -->
        <div class="ampfaq">
            <h4>Frequently Asked Questions</h4>
            <div class="faq-lst">
                <div class="lt">
                    <ul>
                        <li>
                            <span>Is there a setup fee?</span>
                            <p>No. There are no setup fees on any of our plans</p>
                        </li>
                        <li>
                            <span>what\'s the time span for your contracts?</span>
                            <p>All the plans are year-to-year which are subscribed annually.</p>
                        </li>
                        <li>
                            <span>What payment methods are accepted?</span>
                            <p>All the plans are year-to-year which are subscribed annually.</p>
                        </li>
                        <li>
                            <span>Do you offer support if I need help?</span>
                            <p>Yes! Top-notch customer support for our paid customers is key for a quality product, so we’ll do our very best to resolve any issues you encounter via our support page.</p>
                        </li>
                    </ul>
                </div>
                <div class="rt">
                    <ul>
                        <li>
                            <span>Can I cancel my membership at any time?</span>
                            <p>Yes. You can cancel your membership by contacting us.</p>
                        </li>
                        <li>
                            <span>Can I change my plan later on?</span>
                            <p>Yes. You can upgrade or downgrade your plan by contacting us.</p>
                        </li>
                        <li>
                            <span>Do you offer refunds?</span>
                            <p>You are fully protected by our 100% Money Back Guarantee Unconditional. If during the next 14 days you experience an issue that makes the plugin unusable and we are unable to resolve it, we’ll happily offer a full refund.</p>
                        </li>
                        <li>
                            <span>Do I get updates for the premium plugin?</span>
                            <p>All the plans are year-to-year which are subscribed annually.</p>
                        </li>
                    </ul>
                </div>
            </div><!-- /.faq-lst -->
            <div class="f-cnt">
                <span>I have other pre-sale questions, can you help?</span>
                <p>All the plans are year-to-year which are subscribed annually.</p>
                <a href="https://ampforwp.com/support/?utm_medium=freevspro&utm_campaign=AMP%20Plugin#contact">Contact a Human</a>
            </div><!-- /.f-cnt -->
        </div><!-- /.faq -->
    </div><!-- /. pvf -->
</div><!-- /. fp-wr -->';


$gettingstarted_extension_listing = '
<div class="extension_listing getting_started_listing">
<p style="font-size:13px">Take your AMP to the next level with these premium extensions which gives you advanced features.</p>
<ul>
    <li class="first"><a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=gettingstarted-amp-ads&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/click.png" /></div>
        <div class="extension_desc">
        <h2>Advanced AMP ADS</h2>
        <p>Add Advertisement directly in the content</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/opt-in-forms/#utm_source=options-panel&utm_medium=gettingstarted_opt-in-forms&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/email.png" /></div>
        <div class="extension_desc">
        <h2>Email Opt-in Forms</h2>
        <p>Capture Leads with Email Subscription.</p>
        <div class="extension_btn">From: $79</div>
        </div>
    </a></li>
    <li class="first"><a href="http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=gettingstarted_amp-cta&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/mac-click.png" /></div>
        <div class="extension_desc">
        <h2>Call To Action (CTA)</h2>
        <p>Higher Visibility & More Conversions</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/custom-post-type/#utm_source=options-panel&utm_medium=gettingstarted_custom-post-type&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/comments.png" /></div>
        <div class="extension_desc">
        <h2>Custom Post Type</h2>
        <p>Enable Custom Post type support in AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>

    <li class="first"><a href="http://ampforwp.com/acf-amp/#utm_source=options-panel&utm_medium=gettingstarted_acf&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/acf.png" /></div>
        <div class="extension_desc">
        <h2>Advanced Custom Fields</h2>
        <p>Easily add ACF support in AMP.</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/doubleclick-for-publishers/#utm_source=options-panel&utm_medium=gettingstarted_doubleclick&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/dfp.png" /></div>
        <div class="extension_desc">
        <h2>DoubleClick For Publishers</h2>
        <p>Enable DFP Support for AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>


    <li class="first"><a href="http://ampforwp.com/amp-ratings/#utm_source=options-panel&utm_medium=gettingstarted_amp-ratings&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/star.png" /></div>
        <div class="extension_desc">
        <h2>Star Ratings</h2>
        <p>Star Review Ratings for AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>
    <li class="second"><a href="https://ampforwp.com/woocommerce/" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/woo.png" /></div>
        <div class="extension_desc">
        <h2>AMP WooCommerce Pro</h2>
        <p>Advanced WooCommerce in AMP in two clicks.</p>
        <div class="extension_btn">From: $79</div>
        </div>
    </a></li>

    <li class="first"><a href="http://ampforwp.com/amp-category-base-remove-support/#utm_source=options-panel&utm_medium=gettingstarted_amp-category-base-remove-support&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/puzzel.png" /></div>
        <div class="extension_desc">
        <h2>Category Base Removal</h2>
        <p>Remove Category Base Support in AMP</p>
        <div class="extension_btn">FREE</div>
        </div>
    </a></li>
    <li class="second"><a href="https://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=gettingstarted_amp-more-comingsoon&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/comments.png" /></div>
        <div class="extension_desc">
        <h2>View All Extensions</h2>
        <p>See all the extensions available for AMP</p>
<div class="extension_btn">View All</div>        </div>
    </a></li>


</ul>
</div>
';


$single_extension_listing = '
<div class="extension_listing single_ex_listing">
<h3>Increase the Revenue, Leads and Conversation with these Handpicked extensions</h3>
<ul>
    <li class="first"><a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=gettingstarted-amp-ads&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/click.png" /></div>
        <div class="extension_desc">
        <h2>Advanced AMP ADS</h2>
        <p>Add Advertisement directly in the content</p>
        <div class="extension_btn">View Details</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/opt-in-forms/#utm_source=options-panel&utm_medium=gettingstarted_opt-in-forms&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/email.png" /></div>
        <div class="extension_desc">
        <h2>Email Opt-in Forms</h2>
        <p>Capture Leads with Email Subscription.</p>
        <div class="extension_btn">View Details</div>
        </div>
    </a></li>
    <li class="first"><a href="http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=gettingstarted_amp-cta&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/mac-click.png" /></div>
        <div class="extension_desc">
        <h2>Call To Action (CTA)</h2>
        <p>Higher Visibility & More Conversions</p>
        <div class="extension_btn">View Details</div>
        </div>
    </a></li>
 </ul>
</div>
';

$upcomingLayoutsDesign = '';
$layouts = array();
if( is_admin() ){
    $layouts = ampforwp_upcomming_layouts_demo();
}
if(is_array($layouts)){
    foreach($layouts as $k=>$val){
    	$upcomingLayoutsDesign .=  '<div class="amp_layout_upcomming"> 
        <div class="amppb_ad-layout-layout">
            <div class="amppb_ad-layout-wrapper">
            <div class="amppb_ad-layout_pro"><a href="https://ampforwp.com/amp-layouts/" target="_blank">PRO</a></div>
                <h4 class="amppb_ad-layout-title">'.$val['name'].'</h4>
                <div class="amppb_ad-layout-screenshot"> <img src="'.$val['image'].'" onclick="window.open(\''.$val['link'].'\')"> </div>
                <div class="amppb_ad-layout-button">
                    <a target="_blank" href="'.$val['link'].'" class="button">View Theme</a> 
                </div>
            </div>
        </div>
    </div>';
    }
}
// GDPR iso codes
$eu_iso_codes = array(
                        'al' => 'Albania',
                        'ad' => 'Andorra',
                        'at' => 'Austria',
                        'by' => 'Belarus',
                        'be' => 'Belgium',
                        'ba' => 'Bosnia and Herzegovina',
                        'bg' => 'Bulgaria',
                        'hr' => 'Croatia',
                        'cy' => 'Cyprus',
                        'cz' => 'Czech Republic',
                        'dk' => 'Denmark',
                        'ee' => 'Estonia',
                        'fo' => 'Faroe Islands',
                        'fi' => 'Finland',
                        'fr' => 'France',
                        'de' => 'Germany',
                        'gi' => 'Gibraltar',
                        'gr' => 'Greece',
                        'hu' => 'Hungary',
                        'is' => 'Iceland',
                        'ie' => 'Ireland',
                        'im' => 'Isle of Man',
                        'it' => 'Italy',
                        'xs' => 'Kosovo',
                        'lv' => 'Latvia',
                        'lt' => 'Lithuania',
                        'lu' => 'Luxembourg',
                        'mk' => 'The former Yugoslav Republic of Macedonia',
                        'mt' => 'Malta',
                        'md' => 'Moldova',
                        'mc' => 'Monaco',
                        'me' => 'Montenegro',
                        'nl' => 'Netherlands',
                        'no' => 'Norway',
                        'pl' => 'Poland',
                        'pt' => 'Portugal',
                        'ro' => 'Romania',
                        'ru' => 'Russia',
                        'rs' => 'Serbia',
                        'sk' => 'Slovakia',
                        'si' => 'Slovenia',
                        'es' => 'Spain',
                        'se' => 'Sweden',
                        'ch' => 'Switzerland',
                        'ua' => 'Ukraine',
                        'uk' => 'United Kingdom',
                        'rs'=> 'Yugoslavia',
                );

// All the possible arguments for Redux.
//$amp_redux_header = '<span id="name"><span style="color: #4dbefa;">U</span>ltimate <span style="color: #4dbefa;">W</span>idgets</span>';
$proDetailsProvide = '<a class="premium_features_btn_txt" href="https://ampforwp.com/membership/#utm_source=options-panel&utm_medium=view_pro_features_btn&utm_campaign=AMP%20Plugin" target="_blank">'.__('Get more out of AMP','accelerated-mobile-pages').'</a> <a class="premium_features_btn" href="https://ampforwp.com/membership/#utm_source=options-panel&utm_medium=view_pro_features_btn&utm_campaign=AMP%20Plugin" target="_blank">Get PRO Version</a> ';
if($ampforwp_nameOfUser!=""){
    $proDetailsProvide = "<span class='extension-menu-call'><span class='activated-plugins'>Hello, ".$ampforwp_nameOfUser."</span> <a class='' href='".admin_url('admin.php?page=amp_options&tabid=opt-go-premium')."'><i class='dashicons-before dashicons-admin-generic'></i></a></span>";
}elseif($ampforwp_is_productActivated){
    $proDetailsProvide = "<span class='extension-menu-call'>One more Step <a class='premium_features_btn' href='".admin_url('admin.php?tabid=opt-go-premium&page=amp_options')."'>Enter license here</a></span>";
}
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'              => 'redux_builder_amp', // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'          =>  __( 'AMPforWP Options','accelerated-mobile-pages' ), // Name that appears at the top of your panel
    'menu_type'             => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'        => true, // Show the sections below the admin menu item or not
    'menu_title'            => __( 'AMP', 'accelerated-mobile-pages' ),
    'page_title'            => __('Accelerated Mobile Pages Options','accelerated-mobile-pages'),
    'display_version'       => AMPFORWP_VERSION,
    'update_notice'         => false,
    'intro_text'            => $proDetailsProvide,
    'global_variable'       => '', // Set a different name for your global variable other than the opt_name
    'dev_mode'              => false, // Show the time the page took to load, etc
    'customizer'            => false, // Enable basic customizer support,
    'async_typography'      => false, // Enable async for fonts,
    'disable_save_warn'     => true,
    'open_expanded'         => false,
    // OPTIONAL -> Give you extra features
    'page_priority'         => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'           => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'      => 'manage_options', // Permissions needed to access the options panel.
    'last_tab'              => '', // Force your panel to always open to a specific tab (by id)
    'page_icon'             => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
    'page_slug'             => 'amp_options', // Page slug used to denote the panel
    'save_defaults'         => true, // On load save the defaults to DB before user clicks save or not
    'default_show'          => false, // If true, shows the default value next to each field that is not the default value.
    'default_mark'          => '', // What to print by the field's title if the value shown is default. Suggested: *
    'admin_bar'             => false,
    'admin_bar_icon'        => 'dashicons-admin-generic', 
    // CAREFUL -> These options are for advanced use only
    'output'                => false, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'            => false, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
    'footer_credit'         => false, // Disable the footer credit of Redux. Please leave if you can help it.
    'footer_text'           => "",
    'show_import_export'    => true,
    'system_info'           => true,

);


Redux::setArgs( "redux_builder_amp", $args );




    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'accelerated-mobile-pages' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'accelerated-mobile-pages' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'accelerated-mobile-pages' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'accelerated-mobile-pages' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'accelerated-mobile-pages' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Basic Field', 'accelerated-mobile-pages' ),
        'id'     => 'basic',
        'desc'   => __( 'Basic field with no subsections.', 'accelerated-mobile-pages' ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'opt-blank',
                'title'    => __( 'Example Text', 'accelerated-mobile-pages' ),
                'desc'     => __( 'Example description.', 'accelerated-mobile-pages' ),
                'tooltip-subtitle' => __( 'Example subtitle.', 'accelerated-mobile-pages' ),
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Settings', 'accelerated-mobile-pages' ),
        'id'    => 'basic',
        'desc'  => __( '<div class="amp-faq">Thank you for using Accelerated Mobile Pages plugin. '. ' ' .

                      sprintf( __( '  <h2 style="width: 150px;float: right;
    padding: 8px 11px;background: #4CAF50;
    font-size: 13px;margin: -40px 0 0 10px;
    border-radius: 5px;line-height: 22px;position:relative;top:30px"><a style="color: #fff;text-decoration: none;" href="https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages?rate=5#postform">Like this plugin? <br /> Leave a 5 Star Rating</a></h2>We are actively working on updating the plugin. We have built user friendly options which allows you to make changes on your AMP version.', 'accelerated-mobile-pages' ), 'accelerated-mobile-pages' )                      
			               . '<div style="width:100%;margin:20px 0px 10px 0px" class="getstarted_wrapper">
            <div class="getstarted_options">
            <p><b>Getting Started</b></p>
				<ul class="getstarted_ul">
					<li><a href="https://ampforwp.com/tutorials/article-categories/installation-updating/" target="_blank">Installation & Setup</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/settings-options/" target="_blank">Settings & Options</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/setup-amp/" target="_blank">Setup AMP</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/page-builder/" target="_blank">Page Builder</a></li>
				</ul>  
            </div>
            <div class="getstarted_options">
            <p><b>Useful Links</b></p>
				<ul class="getstarted_ul">
					<li><a href="https://ampforwp.com/tutorials/article-categories/extension/" target="_blank">Extensions & Themes Docs</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/extending/" target="_blank">Developers Docs</a></li>
					<li><a href="https://ampforwp.com/amp-theme-framework/" target="_blank">Create a Custom Theme for AMP</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/how-to/" target="_blank">General How To\'s</a></li>
				</ul>  
            </div>
            <div class="getstarted_options" style="padding-bottom: 33px;width: 16%;" >
            <p><b>Get Stable Updates</b></p>
                <ul class="getstarted_ul">
                    <li style="list-style:none;"><a href="https://ampforwp.com/beta-test/" target="_blank">Become a Beta Tester and Help us Push Stable Updates</a></li>
                </ul>  
            </div>
            <div class="clear"></div>
            </div>'
           . '<p><strong>' . __( '1. <a href="https://ampforwp.com/priority-support/" target="_blank">Fixing AMP Validation Errors</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We will personally take care that your website’s AMP version is perfectly validated. We will make sure that your AMP version gets approved and indexed by Google Webmaster Tools properly and we will even keep an eye on AMP updates from Google and implement them into your website.' ) . '</p>'
			               . '<p><strong>' . __( '2. <a href="https://ampforwp.com/help/#support-forum" target="_blank">Community Support Forum</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We have a special community support forum where you can ask us questions and get help about your AMP related questions. Delivering a good user experience means alot to us and so we try our best to reply each and every question that gets asked.' ) . '</p>'
			               . '<p><strong>' . __( '3. <a href="https://ampforwp.com/help/#contact" target="_blank">Hire Us / Other queries</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We try to answer each and every email, so remember to give us some time. For any other queries, please use the contact form. Please be descriptive as possible.' ) . '</p>'
			               . '<p><strong>' . __( '4. <a href="http://ampforwp.com/new/" target="_blank"> What\'s New in this Version?</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'If you want to know whats new in the latest version of the plugin, then please use this link. ') . '</p>'

						         . '</p></div>
                                 <br /><p><h3>Take AMP to the Next Level with Premium Extensions</h3></p>
                                 ' .$gettingstarted_extension_listing

				 , 'accelerated-mobile-pages' ),
        'icon'  => 'el el-cogs'
    ) );
    
    function ampforwp_default_logo_settings($param=""){
        $custom_logo_id = '';
        $image          = '';
        $value          = '';
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $image = wp_get_attachment_image_src( $custom_logo_id , 'full');
        if( $image ){
            return $image[0];
        }
        return $value;
    }
    function ampforwp_custom_logo_dimensions_options(){
        $selectedOption = get_option('redux_builder_amp',true);
        $opCheck = $selectedOption['ampforwp-custom-logo-dimensions'];
        if($opCheck==1){
            return 'prescribed';
        }else{
            return 'flexible';
        }
    }
    function ampforwp_get_cpt_generated_post_types() {
        $options = '';
        $options = get_option('ampforwp_cpt_generated_post_types');
        return $options;
    }
    $amp_cpt_option = array();
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $ampforwp_cpt_plugin_check = is_plugin_active( 'amp-custom-post-type/amp-custom-post-type.php' );
    if ( false == $ampforwp_cpt_plugin_check ) {   
        $amp_cpt_option = array(
                    'id'      => 'ampforwp-custom-type',
                    'type'    => 'select',
                    'title'   => __('Custom Post Types', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'   => __('Enable AMP Support on Custom Post Types', 'accelerated-mobile-pages'),
                    'multi'   => true,
                    //'data' => 'post_type',
                    'options' => ampforwp_get_cpt_generated_post_types(),
                );
    }

    // AMP to WP Default value
    function ampforwp_amp2wp_default(){
        $default = 0;
        $theme = '';
        $theme = wp_get_theme(); // gets the current theme

        if ( 'AMP WordPress Theme' == $theme->name || 'AMP WordPress Theme' == $theme->parent_theme ) {
            $default = 1;
        }
        return $default;
    }

        Redux::setSection( $opt_name, array(
        'title'      => __( 'General', 'accelerated-mobile-pages' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'accelerated-mobile-pages' ) . '<a href="http://docs.reduxframework.com/core/fields/text/" target="_blank">http://docs.reduxframework.com/core/fields/text/</a>',
        'id'         => 'opt-text-subsection',
        'subsection' => true,
        'fields'     => array(
           array(
                       'id' => 'amp-logo',
                       'type' => 'section',
                       'title' => __('Branding', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),

             array(
                'id'       => 'opt-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Logo', 'accelerated-mobile-pages'),
                'tooltip-subtitle'=>__('Upload a logo for the AMP version. (Recommended logo size: 190x36)', 'accelerated-mobile-pages'),
                'default' => array('url' => ampforwp_default_logo_settings() ),
            ),
           array(
                'id'       => 'ampforwp-custom-logo-dimensions',
                'title'    => __('Resize', 'accelerated-mobile-pages'),
                'type'     => 'switch',
                'default'  => 0,
            ),
            array(
                'id'       => 'ampforwp-custom-logo-dimensions-options',
                'title'    => __('Resize Method', 'accelerated-mobile-pages'),
                'type'     => 'select',
                'class' => 'child_opt child_opt_arrow',
                'default'  => '100',
                'options'     => array(
                    'flexible'   => 'Flexible Width',
                    'prescribed' => 'Fixed Width'
                ),
                'default' => ampforwp_custom_logo_dimensions_options(),
                'required'=>array('ampforwp-custom-logo-dimensions','=','1'),
            ),
           array(
                'id'       => 'ampforwp-custom-logo-dimensions-slider',
                'title'    => __('Resize Your Logo', 'accelerated-mobile-pages'),
                'type'     => 'amp_slider',
                'class' => 'child_opt',
                'default'  => '100',
                'min'      => 0,
                'max'      => 100,
                'required'=>array('ampforwp-custom-logo-dimensions-options','=','flexible'),
            ),
            array(
                'class' => 'child_opt',
                'id'       => 'opt-media-width',
                'type'     => 'text',
                'title'    => __('Logo Width', 'accelerated-mobile-pages'),
                'tooltip-subtitle'    => __('Default width is 190 pixels', 'accelerated-mobile-pages'),
                'default' => '190',
                 'required'=>array('ampforwp-custom-logo-dimensions-options','=','prescribed'),
            ),
           array(
                'class' => 'child_opt',
                'id'       => 'opt-media-height',
                'type'     => 'text',
                'title'    => __('Logo Height', 'accelerated-mobile-pages'),
                'tooltip-subtitle'    => __('Default height is 36 pixels', 'accelerated-mobile-pages'),
                'default' => '36',
                'required'=>array('ampforwp-custom-logo-dimensions-options','=','prescribed'),

            ),
           array(
                       'id' => 'amp-support',
                       'type' => 'section',
                       'title' => __('AMP Support', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
           array(
               'id'        =>'amp-on-off-for-all-posts',
               'type'      => 'switch',
               'title'     => __('Posts', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __('Enable AMP Support on Posts', 'accelerated-mobile-pages'),
               'default'   => 1,
//               'desc'      => __( 'Re-Save permalink if you make changes in this option, please have a look <a href="https://ampforwp.com/flush-rewrite-urls/">here</a> on how to do it', 'accelerated-mobile-pages' ),
            ),
			array(
               'id'        =>'amp-on-off-for-all-pages',
               'type'      => 'switch',
               'title'     => __('Pages', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __('Enable AMP Support on Pages.', 'accelerated-mobile-pages'),
               'default'   => 1,
//               'tooltip-subtitle'      => __( '<a href="https://ampforwp.com/flush-rewrite-urls/">Re-Save permalink</a> if you make changes in this option, please have a look here on how to do it', 'accelerated-mobile-pages' ),
            ),
           array(
               'id'       => 'ampforwp-homepage-on-off-support',
               'type'     => 'switch',
               'title'    => __('Homepage', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('Enable AMP Support on Homepage.', 'accelerated-mobile-pages'),
               'default'  => '1'
            ),
           array(
                'id'        =>'amp-frontpage-select-option',
                'type'      => 'switch',
                'title'     => __('Custom Front Page', 'accelerated-mobile-pages'),
                'default'   => 0,
                'tooltip-subtitle'  => __('Set Custom Front Page as Homepage', 'accelerated-mobile-pages'),
                'true'      => 'true',
                'false'     => 'false',
                'required'  => array('ampforwp-homepage-on-off-support','=','1'),
//                'desc'      => __( 'Re-Save permalink if front page or custom post page\'s pagination is not working. Please have a look <a href="https://ampforwp.com/flush-rewrite-urls/">here</a> on how to do it', 'accelerated-mobile-pages' ),
            ),
           array(
                'id'       => 'amp-frontpage-select-option-pages',
                'type'     => 'select',
               'class' => 'child_opt child_opt_arrow',
                'title'    => __('Select Page as Front Page', 'accelerated-mobile-pages'),
                'required' => array('amp-frontpage-select-option', '=' , '1'),
                // Must provide key => value pairs for select options
                'data'     => 'page',
                'args'     => array(
                    'post_type' => 'page',
                    'posts_per_page' => 500
                ),
                'default'  => '2',
            ),
           array(
               'id'       => 'ampforwp-title-on-front-page',
               'type'     => 'switch',
               'class' => 'child_opt',
               'url'      => true,
               'title'    => __('Title on Static Front Page', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('Enable/Disable display of title on the Static Front Page.', 'accelerated-mobile-pages'),
               'default' => 0,
               'required' => array('amp-frontpage-select-option', '=' , '1'),
            ),

           array(
               'id'       => 'ampforwp-archive-support',
               'type'     => 'switch',
               'title'    => __('Archives [Category & Tags]', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('Enable AMP Support on Archives.', 'accelerated-mobile-pages'),
               'default'  => '0'
             ),
           $amp_cpt_option,
            array(
               'id'       => 'ampforwp-amp-convert-to-wp',
               'type'     => 'switch',
               'title'    => __('Convert AMP to WP theme (Beta)', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('It makes your AMP & Non-AMP Same! (AMP will output AMP Compatible code, while WordPress will have the WP code but with the same design)', 'accelerated-mobile-pages'),
               'default'  => ampforwp_amp2wp_default(),
               'required' => array('amp-design-selector', '=' , '4'),
             ),
           array(
               'id'       => 'ampforwp-amp-takeover',
               'type'     => 'switch',
               'title'    => __('AMP Takeover (Beta)', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('Make your non-amp to load the AMP (AMP & NON-AMP both will be AMP with same design)', 'accelerated-mobile-pages'),
               'default'  => '0'
             ),

          //  array(
          //      'id'       => 'amp-ad-places',
          //      'type'     => 'select',
          //      'title'    => __( 'Ads on Page', 'accelerated-mobile-pages' ),
          //      'tooltip-subtitle' => __( 'select your preferece for Ads on Post Types', 'accelerated-mobile-pages' ),
          //      'options'  => array(
          //          '1' => __('Only on Posts', 'accelerated-mobile-pages' ),
          //          '2' => __('Only on Pages', 'accelerated-mobile-pages' ),
          //          '3' => __('on Both', 'accelerated-mobile-pages' ),
          //      ),
          //      'default'  => '3'
          //  ),

      )
    ) );//END

   // AMP Content Page Builder SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Page Builder', 'accelerated-mobile-pages' ),
      'class'       =>'',
       'id'         => 'amp-content-builder',
       'class'      => 'ampforwp-new-element',
       'subsection' => true,
       'fields' => array( 
            array(
                'id'       => 'ampforwp-page-builder-info',
                'type'     => 'raw',
                'desc' => '<div style="background: #FFF9C4;
    display: inline-block;
    padding: 10px 20px;
    margin-top: 0px;
    left: 0;
    line-height: 1.6;
    position: absolute;
    left: 0px;
    top: 15px;
    font-size: 15px;"><b>Introducing  AMP Page Builder 3.0</b>, Re-Engineered in Vue.js! <br /> <a href="https://ampforwp.com/tutorials/article/amp-page-builder-installation/" target="_blank">Learn how to use this Feature</a></div>
    
    <iframe style="position: absolute;left: 0px;margin-top: 67px;" width="600" height="400" src="https://www.youtube.com/embed/QTbkn2rHyqM" frameborder="0" allowfullscreen></iframe>
    
    ',
            ),
        )
       )

   ) ;

    $AD_URL = "http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=advertisement-tab&utm_campaign=AMP%20Plugin";
    $desc = '';
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if(!is_plugin_active( 'amp-incontent-ads/amptoolkit-incontent-ads.php' ) ){

        $desc = '<a href="'.$AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-retina.png" width="560" height="85" /></a>';
        }

     // ADS SECTION
 Redux::setSection( $opt_name, array(
            'title'      => __( 'Advertisement', 'accelerated-mobile-pages' ),
            'desc' => $desc,
            'id'         => 'amp-ads',
            'subsection' => true,
            'fields'     => array(
           array(
                       'id' => 'amp-ads_1',
                       'type' => 'section',
                       'title' => __('Advertisement Positions', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
                // Ad 1 Starts
                array(
                    'id'        =>'enable-amp-ads-1',
                    'type'      => 'switch',
                    'title'     => __('AD #1', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'desc'  => __('Below the Header (SiteWide)', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-1',
                        'type'     => 'select',
                        'title'    => __('AD Size', 'accelerated-mobile-pages'),
                        'required' => array('enable-amp-ads-1', '=' , '1'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '1' => __('300x250','accelerated-mobile-pages'),
                            '2' => __('336x280','accelerated-mobile-pages'),
                            '3' => __('728x90','accelerated-mobile-pages'),
                            '4' => __('300x600','accelerated-mobile-pages'),
                            '5' => __('320x100','accelerated-mobile-pages'),
                            '6' => __('200x50','accelerated-mobile-pages'),
                            '7' => __('320x50','accelerated-mobile-pages'),                      ),
                        'default'  => '2',
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-text-feild-client-1',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-1', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        => 'enable-amp-ads-text-feild-slot-1',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required' => array('enable-amp-ads-1', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-1',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-1', '=' , '1'),
                    ),
            // Ad 1 ends

            // Ad 2 Starts
                 array(
                    'id'=>'enable-amp-ads-2',
                    'type' => 'switch',
                    'title' => __('AD #2', 'accelerated-mobile-pages'),
                    'default' => 0,
                    'desc'     => __('Below the Footer (SiteWide)', 'accelerated-mobile-pages'),
                    'true' => 'Enabled',
                    'false' => 'Disabled',
                    ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-2',
                        'type'     => 'select',
                        'title'    => __('AD Size', 'accelerated-mobile-pages'),
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '1' => '300x250',
                            '2' => '336x280',
                            '3' => '728x90',
                            '4' => '300x600',
                            '5' => '320x100',
                            '6' => '200x50',
                            '7' => '320x50'
                        ),
                        'default'  => '2',
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'       =>'enable-amp-ads-text-feild-client-2',
                        'type'     => 'text',
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                        'title'    => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'     => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'       => 'enable-amp-ads-text-feild-slot-2',
                        'type'     => 'text',
                        'title'    => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'     => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-2',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                    ),
            // Ad 2 ends

            // Ad 3 starts
                 array(
                        'id'        => 'enable-amp-ads-3',
                        'type'      => 'switch',
                        'title'     => __('AD #3', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'desc'  => __('Above the Post Content', 'accelerated-mobile-pages'),
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    ),
                 array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'        => 'made-amp-ad-3-global',
                        'type'      => 'select',
                        'title'     => __('Display on', 'accelerated-mobile-pages'),
                        'options'   => array (
                                            '1'    => 'Single',
                                            '2'    => 'Pages',
                                            '3'    => 'Custom Post Types',
                                            '4'    => 'Global'
                                         ),
                        'multi'     => true,
                        'default'   => '1',
                        'desc'  => __('Display the Ad on only post or on all posts and pages ', 'accelerated-mobile-pages'),
                        'required'  => array('enable-amp-ads-3', '=' , '1')
                    ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'        => 'enable-amp-ads-select-3',
                        'type'      => 'select',
                        'title'     => __('AD Size', 'accelerated-mobile-pages'),
                        'required'  => array('enable-amp-ads-3', '=' , '1'),
                        // Must provide key => value pairs for select options
                        'options'   => array(
                                '1'     => '300x250',
                                '2'     => '336x280',
                                '3'     => '728x90',
                                '4'     => '300x600',
                                '5' => '320x100',
                                '6' => '200x50',
                                '7' => '320x50'
                        ),
                        'default'  => '2',
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-text-feild-client-3',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-3', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        => 'enable-amp-ads-text-feild-slot-3',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('enable-amp-ads-3', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-3',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-3', '=' , '1'),
                    ),
            // Ad 3 ends

            // Ad 4 Starts
                array(
                    'id'        => 'enable-amp-ads-4',
                    'type'      => 'switch',
                    'title'     => __('AD #4', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'desc'  => __('Below the Post Content (Single Post)', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-4',
                        'type'     => 'select',
                        'title'    => __('AD Size', 'accelerated-mobile-pages'),
                        'required' => array('enable-amp-ads-4', '=' , '1'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '1' => __('300x250','accelerated-mobile-pages'),
                            '2' => __('336x280','accelerated-mobile-pages'),
                            '3' => __('728x90','accelerated-mobile-pages'),
                            '4' => __('300x600','accelerated-mobile-pages'),
                            '5' => __('320x100','accelerated-mobile-pages'),
                            '6' => __('200x50','accelerated-mobile-pages'),
                            '7' => __('320x50','accelerated-mobile-pages')
                        ),
                        'default'  => '2',
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-text-feild-client-4',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-4', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        => 'enable-amp-ads-text-feild-slot-4',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('enable-amp-ads-4', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-4',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-4', '=' , '1'),
                    ),
            // Ad 4 ends

            //Ad 5 Starts
            array(
                'id'        => 'enable-amp-ads-5',
                'type'      => 'switch',
                'title'     => __('AD #5', 'accelerated-mobile-pages'),
                'default'   => 0,
                'desc'  => __('Below The Title (Single Post)', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
                        'class' => 'child_opt child_opt_arrow',
                    'id'       => 'enable-amp-ads-select-5',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'accelerated-mobile-pages'),
                    'required' => array('enable-amp-ads-5', '=' , '1'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        '1' => __('300x250','accelerated-mobile-pages'),
                        '2' => __('336x280','accelerated-mobile-pages'),
                        '3' => __('728x90','accelerated-mobile-pages'),
                        '4' => __('300x600','accelerated-mobile-pages'),
                        '5' => __('320x100','accelerated-mobile-pages'),
                        '6' => __('200x50','accelerated-mobile-pages'),
                        '7' => __('320x50','accelerated-mobile-pages')
                    ),
                    'default'  => '2',
                ),
                array(
                        'class' => 'child_opt',
                    'id'        =>'enable-amp-ads-text-feild-client-5',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-5', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                        'class' => 'child_opt',
                    'id'        => 'enable-amp-ads-text-feild-slot-5',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-5', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
                array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-5',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-5', '=' , '1'),
                    ),

            //Ad 6 Starts
            array(
                'id'        => 'enable-amp-ads-6',
                'type'      => 'switch',
                'title'     => __('AD #6', 'accelerated-mobile-pages'),
                'default'   => 0,
                'desc'  => __('Above the Related Posts (Single Post)', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
                        'class' => 'child_opt child_opt_arrow',
                    'id'       => 'enable-amp-ads-select-6',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'accelerated-mobile-pages'),
                    'required' => array('enable-amp-ads-6', '=' , '1'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        '1' => __('300x250','accelerated-mobile-pages'),
                        '2' => __('336x280','accelerated-mobile-pages'),
                        '3' => __('728x90','accelerated-mobile-pages'),
                        '4' => __('300x600','accelerated-mobile-pages'),
                        '5' => __('320x100','accelerated-mobile-pages'),
                        '6' => __('200x50','accelerated-mobile-pages'),
                        '7' => __('320x50','accelerated-mobile-pages')
                    ),
                    'default'  => '2',
                ),
                array(
                        'class' => 'child_opt',
                    'id'        =>'enable-amp-ads-text-feild-client-6',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-6', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                        'class' => 'child_opt',
                    'id'        => 'enable-amp-ads-text-feild-slot-6',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-6', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
                array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-6',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-6', '=' , '1'),
                ),

           array(
                        'id' => 'amp-ads_2',
                       'type' => 'section',
                       'title' => __('Ad Performance', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),

           array(
                        'id' => 'amp-ads_2',
                       'type' => 'section',
                       'title' => __('Ad Performance', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
                array(
                    'id'        =>'ampforwp-ads-data-loading-strategy',
                    'type'      => 'switch',
                    'title'     => __('Optimize For Viewability', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'tooltip-subtitle'  => __('This will increase the loading speed of the Ads', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
           array(
                        'id' => 'amp-ads_3',
                       'type' => 'section',
                       'title' => __('General', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
                array(
                    'id'        =>'ampforwp-ads-sponsorship',
                    'type'      => 'switch',
                    'title'     => __('Sponsorship Label', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                array(
                        'id'        =>'ampforwp-ads-sponsorship-label',
                        'type'      => 'text',
                        'required'  => array('ampforwp-ads-sponsorship', '=' , '1'),
                        'title'     => __('Sponsorship Label Text', 'accelerated-mobile-pages'),
                        'class' => 'child_opt child_opt_arrow',
                        'default'   => '',
                        'placeholder'=> 'Sponsored'
                    ),

            ),
        ) );

    if ( ! function_exists('ampforwp_seo_default') ) {
        function ampforwp_seo_default() {
            $default = '';
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
            if ( is_plugin_active('wordpress-seo/wp-seo.php') ) {
                $default = 1;
            }
            elseif ( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) {
                $default = 2;
            }
            return $default;
        }
    }
 // SEO SECTION
  Redux::setSection( $opt_name, array(
      'title'      => __( 'SEO', 'accelerated-mobile-pages' ),
      'id'         => 'amp-seo',
      'subsection' => true,
       'fields'     => array(
            array(
                  'id' => 'ampforwp-seo-general-section',
                  'type' => 'section',
                  'title' => __('General', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1,
              ),
            array(
               'id'       => 'ampforwp-seo-meta-description',
               'type'     => 'switch',
               'title'     => __('Meta Description', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => __('The meta tag that displays in head', 'accelerated-mobile-pages'),
               'default'  => 0
            ),

            array(
               'id'       => 'ampforwp-seo-custom-additional-meta',
               'type'     => 'textarea',
               'title'    => __('Head Section', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('Adds additional Meta to the head section', 'accelerated-mobile-pages', 'accelerated-mobile-pages'),
               'placeholder'  => __('<!-- Paste your Additional HTML , that goes between <head> </head> tags -->','accelerated-mobile-pages')
            ),
            array(
                  'id' => 'ampforwp-seo-plugins-section',
                  'type' => 'section',
                  'title' => __('SEO Plugin Integration', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                    'accordion-open'=> 1,
              ),
           array(
                'id'       => 'ampforwp-seo-selection',
                'type'     => 'select',
                'title'    => __('Select SEO Plugin', 'accelerated-mobile-pages'),
                'options'  => array(
                    '1'       => 'Yoast',
                    '2'     => 'All in One SEO'
                ),
                'default'  => ampforwp_seo_default(),
            ),
           array( 
               'class' => 'child_opt child_opt_arrow',
               'id'       => 'ampforwp-seo-yoast-meta',
               'type'     => 'switch',
               'tooltip-subtitle'     => __('Adds Social and Open Graph Meta Tags from Yoast', 'accelerated-mobile-pages'),
               'title'    => __( 'Meta Tags from Yoast', 'accelerated-mobile-pages' ),
               'default'  => '1',
               'required'  => array('ampforwp-seo-selection', '=' , '1'),
           ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-yoast-description',
               'type'     => 'switch',
               'tooltip-subtitle'     => __('Adds Yoast Custom description to ld+json for AMP page', 'accelerated-mobile-pages'),
               'title'    => __( 'Yoast Description in ld+json', 'accelerated-mobile-pages' ),
               'default'  => 0,
               'required'  => array('ampforwp-seo-selection', '=' , '1'),
           ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-yoast-canonical',
               'type'     => 'switch',
               'tooltip-subtitle'     => __('Pull Canonical from Yoast for AMP pages', 'accelerated-mobile-pages'),
               'title'    => __( 'Canonical from Yoast', 'accelerated-mobile-pages' ),
               'default'  => 0,
               'required'  => array('ampforwp-seo-selection', '=' , '1'),
           ),
           array(
                'id'       => 'ampforwp-seo-aioseo',
                'type'     => 'info',
                'style'    => 'success',
                'desc'     => __("All in One SEO works out of the Box with our plugin. It deosn't requires any extra config except Canonicals.", 'accelerated-mobile-pages'),
                'required' => array('ampforwp-seo-selection', '=', '2')
            ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-aioseo-canonical',
               'type'     => 'switch',
               'tooltip-subtitle'     => __('Pull Canonical from All In One SEO for AMP pages', 'accelerated-mobile-pages'),
               'title'    => __( 'Canonical from All In One SEO', 'accelerated-mobile-pages' ),
               'default'  => 0,
               'required'  => array('ampforwp-seo-selection', '=' , '2'),
           ),
            array(
                'id' => 'ampforwp-seo-index-noindex-sub-section',
                'type' => 'section',
                'title' => __('Advanced Indexing', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1,
            ),
            array(
               'id'       => 'amp-inspection-tool',
               'type'     => 'switch',
               'title'    => __('URL Inspection Tool Compatibility', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __("You can read about it <a target='_blank' href='https://webmasters.googleblog.com/2018/06/new-url-inspection-tool-more-in-search.html'>here</a>",'accelerated-mobile-pages'),
               'default' => 1,
            ),
           array(
               'id'       => 'ampforwp-robots-archive-sub-pages-sitewide',
               'type'     => 'switch',
               'title'    => __('Archive subpages (sitewide)', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __("Such as /page/2 so on and so forth",'accelerated-mobile-pages'),
               'default' => 0,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-author-pages',
               'type'     => 'switch',
               'title'    => __('Author Archives', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __("Enable it to set Indexing for Author Archives",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-date-pages',
               'type'     => 'switch',
               'title'    => __('Date Archives', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __("Enable it to set Indexing for Date Archives",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-category-pages',
               'type'     => 'switch',
               'title'    => __('Categories', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __("Enable it to set Indexing for Categories",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-tag-pages',
               'type'     => 'switch',
               'title'    => __('Tags', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __("Enable it to set Indexing for Tags",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),


       )

  )

  );

  // Performance SECTION
  Redux::setSection( $opt_name, array(
        'title'      => __( 'Performance', 'accelerated-mobile-pages' ),
        'id'         => 'amp-performance',
        'desc' => $cache_desc,
        'subsection' => true,
        'fields'     => array(
            array(
                  'id' => 'ampforwp-performance',
                  'type' => 'section',
                  'title' => __('Performance Enhancement', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                    'accordion-open'=> 1,
              ),

           array(
               'id'       => 'ampforwp_cache_minimize_mode',
               'type'     => 'switch',
               'title'     => __('Minify', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => __('Improve the Page Speed and Loading time with Minification option', 'accelerated-mobile-pages'),
               'default'  => 0
           ),

       )

  )

  );

  function ampforwp_get_default_analytics($param=""){
    $options = $default = ''; 
    $options = get_option('redux_builder_amp', true);
    $default = $options['amp-analytics-select-option'];
    if($param == $default){
        return true;
    }
    else
        return false;
    }

 // Analytics SECTION
   Redux::setSection( $opt_name,    array(
                'title' => __('Analytics'),
                // 'icon' => 'el el-th-large',
                'subsection' => true,
                'fields' =>
                    array(
                    array(
                        'id'       => 'amp-analytics-select-option',
                        'type'     => 'select',
                        'title'    => __( 'Analytics Type', 'accelerated-mobile-pages' ),
                        'class'    => 'hide',
                        'tooltip-subtitle' => __( 'Select your Analytics provider.', 'accelerated-mobile-pages' ),
                        'options'  => array(
                            '1' => __('Google Analytics', 'accelerated-mobile-pages' ),
                            '2' => __('Segment Analytics', 'accelerated-mobile-pages' ),
                            '3' => __('Matomo (Piwik) Analytics', 'accelerated-mobile-pages' ),
                            '4' => __('Quantcast Measurement', 'accelerated-mobile-pages' ),
                            '5' => __('comScore', 'accelerated-mobile-pages' ),
                            '6' => __('Effective Measure', 'accelerated-mobile-pages' ),
                            '7' => __('StatCounter', 'accelerated-mobile-pages' ),
                            '8' => __('Histats Analytics', 'accelerated-mobile-pages'),
                            '9' => __('Yandex Metrika', 'accelerated-mobile-pages'),
                            '10' => __('Chartbeat Analytics', 'accelerated-mobile-pages'),
                            '11' => __('Alexa Metrics', 'accelerated-mobile-pages'),
                            '12' => __('AFS Analytics', 'accelerated-mobile-pages'),
                            '13' => __('Adobe Analytics', 'accelerated-mobile-pages'),
                        ),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                        'default'  => '1',
                    ),  
                array(
                      'id' => 'ampforwp-analytics_1',
                      'type' => 'section',
                      'title' => __('Primary Analytic Providers', 'accelerated-mobile-pages'),
                      'indent' => true,
                      'layout_type' => 'accordion',
                        'accordion-open'=> 1, 
                  ),
                        // Google Analytics                 
                     array(
                        'id' => 'ampforwp-ga-switch',
                        'type'  => 'switch',
                        'title' => 'Google Analytics',
                        'default' => ampforwp_get_default_analytics('1'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                      array(
                          'class' => 'child_opt child_opt_arrow',
                          'id'       => 'ga-feild',
                          'type'     => 'text',
                          'title'    => __( 'Tracking ID', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1'),
                            array('ampforwp-ga-field-advance-switch', '=' , '0')
                          ),
                          'tooltip-subtitle' => __( 'Enter your Google Analytics ID. Example: UA-XXXXX-Y', 'accelerated-mobile-pages' ),
                          'default'  => 'UA-XXXXX-Y',
                      ),
         
                      // Advance Tracking options for Google Analytics
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-ga-field-advance-switch',
                          'type'     => 'switch',
                          'title'    => __( 'Advanced Google Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1')
                          ),
                          'default'  => 0,
                      ),
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-ga-field-anonymizeIP',
                          'type'     => 'switch',
                          'title'    => __( 'IP Anonymization', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1')
                          ),
                          'default'  => 1,
                      ),
                      array(
                          'class' => 'child_opt',
                        'id'       => 'ampforwp-ga-field-advance',
                        'type'     => 'ace_editor',
                        'title'    => __('Analytics Code in JSON Format', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'    => __('Tutorial: <a href="https://ampforwp.com/tutorials/article/add-advanced-google-analytics-amp/" target="_blank">How To Add Advanced Google Analytics in AMP?</a>', 'accelerated-mobile-pages'),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1'),
                            array('ampforwp-ga-field-advance-switch', '=' , '1')
                        ),
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'desc'     => '',
                        'default'  => __('{
    "vars": {
        "account": "UA-xxxxxxx-x"  //Replace this with your Tracking ID
    },
    "triggers": {
        "trackPageview": {
            "on": "visible",
            "request": "pageview",
        },
    /** 
     * Enter your Advanced Analytics code here
    */
    }
}','accelerated-mobile-pages')
                    ),
                      //GTM
                        array(
                            'id'       => 'amp-use-gtm-option',
                            'type'     => 'switch',
                            'title'    => __( 'Google Tag Manager', 'accelerated-mobile-pages' ),
                            'tooltip-subtitle' => __( 'Enable GTM Support in AMP.', 'accelerated-mobile-pages' ),
                            'default'  => 0,
                        ),
                        array(
                            'class'=>'child_opt child_opt_arrow',
                            'id'            =>'amp-gtm-id',
                            'type'          => 'text',
                            'title'         => __('Tag Manager ID (Container ID)','accelerated-mobile-pages'),
                            'default'       => '',
                            'tooltip-subtitle'  => __('Eg: GTM-5XXXXXP (<a href="https://ampforwp.com/tutorials/article/gtm-in-amp/" style="color:#f1f1f1;">Getting Started?</a>)','accelerated-mobile-pages'),
                            //  'validate' => 'not_empty',
                              'required' => array(
                                array('amp-use-gtm-option', '=' , '1')
                              ),
                        ),
                       array(
                           'class' => 'child_opt',
                           'id'            =>'amp-gtm-analytics-type',
                           'type'          => 'text',
                           'title'         => __('Analytics Type','accelerated-mobile-pages'),
                           'default'       => '',
                           'desc'  => __('Eg: googleanalytics','accelerated-mobile-pages'),
                            // 'validate' => 'not_empty',
                             'required' => array(
                               array('amp-use-gtm-option', '=' , '1')
                             ),
                       ),
                        array(
                            'class'=>'child_opt',
                            'id'            =>'amp-gtm-analytics-code',
                            'type'          => 'text',
                            'title'         => __('Analytics ID','accelerated-mobile-pages'),
                            'default'       => '',
                            'tooltip-subtitle'  => 'Eg: UA-XXXXXX-Y',
                  // 'validate' => 'not_empty',
                              'required' => array(
                              array('amp-use-gtm-option', '=' , '1')),
                        ),
                        array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-gtm-field-anonymizeIP',
                          'type'     => 'switch',
                          'title'    => __( 'IP Anonymization', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '1'),
                          ),
                          'default'  => 1,
                      ),
                    // Google Cliend ID API
                      array(
                        'id'       => 'ampforwp-ga-clientid-api-gtm',
                        'type' => 'info',
                        'style' => 'info',
                        'desc' => '<a href="https://ampforwp.com/tutorials/article/set-google-amp-client-id-api/" target="_blank">Check this Tutorial to set it up</a>',
                        'title'    => __('Set up Google AMP Client ID API', 'accelerated-mobile-pages'),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '1'),
                          ),
                        ),
                array(
                      'id' => 'ampforwp-analytics_2',
                      'type' => 'section',
                      'title' => __('General Analytics Providers', 'accelerated-mobile-pages'),
                      'indent' => true,
                      'layout_type' => 'accordion',
                        'accordion-open'=> 1, 
                  ),
                    array(
                        'id'            =>'amp-fb-pixel',
                        'type'          => 'switch',
                        'title'         => __('Facebook Pixel','accelerated-mobile-pages'),
                        'default'       => 0,
                    ),
                    array(
                        'id'            =>'amp-fb-pixel-id',
                        'type'          => 'text',
                        'title'         => __('Facebook Pixel ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'desc'  => 'Example: 153246987501548',
                          'required' => array(
                          array('amp-fb-pixel', '=' , '1')),
                    ),                        // Segment Analytics 
                      array(
                        'id' => 'ampforwp-Segment-switch',
                        'type'  => 'switch',
                        'title' => 'Segment Analytics',
                        'default' => ampforwp_get_default_analytics('2'),
                    ),
                      array(
                        'id'       => 'sa-feild',
                        'type'     => 'text',
                        'title'    => __( 'Segment Analytics', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => __( 'Enter your Segment Analytics Key.', 'accelerated-mobile-pages' ),
                        'required' => array(
                          array('ampforwp-Segment-switch', '=' , '1')
                        ),
                        'default'  => 'SEGMENT-WRITE-KEY',
                      ),
                     // Piwik Analytics 
                      array(
                        'id' => 'ampforwp-Piwik-switch',
                        'type'  => 'switch',
                        'title' => 'Matomo (Piwik) Analytics',
                        'default' => ampforwp_get_default_analytics('3'),
                    ),
                      array(
                          'id'       => 'pa-feild',
                          'type'     => 'text',
                          'title'    => __( ' Matomo (Piwik) Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Piwik-switch', '=' , '1')
                          ),
                          'desc'     => __( 'Example: https://piwik.example.org/piwik.php?idsite=YOUR_SITE_ID&rec=1&action_name=TITLE&urlref=DOCUMENT_REFERRER&url=CANONICAL_URL&rand=RANDOM', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => __('Enter your Matomo (Piwik) Analytics URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                      // Quantcast 
                        array(
                        'id' => 'ampforwp-Quantcast-switch',
                        'type'  => 'switch',
                        'title' => 'Quantcast Measurement',
                        'default' => ampforwp_get_default_analytics('4'),
                    ),
                      array(
                        'id'            =>'amp-quantcast-analytics-code',
                        'type'          => 'text',
                        'title'         => __('p-code','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                        array('ampforwp-Quantcast-switch', '=' , '1')),
                      ),
                      // comScore  
                      array(
                        'id' => 'ampforwp-comScore-switch',
                        'type'  => 'switch',
                        'title' => 'comScore',
                        'default' => ampforwp_get_default_analytics('5'),
                    ),
                      array(
                        'id'            =>'amp-comscore-analytics-code-c1',
                        'type'          => 'text',
                        'title'         => __('C1','accelerated-mobile-pages'),
                        'default'       => 1,
                        'required' => array(
                        array('ampforwp-comScore-switch', '=' , '1')),
                      ),
                      array(
                        'id'            =>'amp-comscore-analytics-code-c2',
                        'type'          => 'text',
                        'title'         => __('C2','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                        array('ampforwp-comScore-switch', '=' , '1')),
                      ),
                    // Effective Measure  
                        array(
                        'id' => 'ampforwp-Effective-switch',
                        'type'  => 'switch',
                        'title' => 'Effective Measure',
                        'default' => ampforwp_get_default_analytics('6'),
                    ),
                      array(
                          'id'       => 'eam-feild',
                          'type'     => 'text',
                          'title'    => __( 'Effective Measure Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Effective-switch', '=' , '1')
                          ),
                          'desc'     => __( 'Example: https://s.effectivemeasure.net/d/6/i?pu=CANONICAL_URL&ru=DOCUMENT_REFERRER&rnd=RANDOM', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => __('Enter your Effective Measure URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                     // StatCounter 
                      array(
                        'id' => 'ampforwp-StatCounter-switch',
                        'type'  => 'switch',
                        'title' => 'StatCounter',
                        'default' => ampforwp_get_default_analytics('7'),
                    ),
                      array(
                          'id'       => 'sc-feild',
                          'type'     => 'text',
                          'title'    => __( 'StatCounter', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-StatCounter-switch', '=' , '1')
                          ),
                          'desc'     => __( 'Example: https://c.statcounter.com/PROJECT_ID/0/SECURITY_CODE/1/', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => __('Enter your StatCounter URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                    // Histats Analytics  
                      array(
                        'id' => 'ampforwp-Histats-switch',
                        'type'  => 'switch',
                        'title' => 'Histats Analytics',
                        'default' => ampforwp_get_default_analytics('8'),
                    ),
                       array(
                          'id'       => 'histats-feild',
                          'type'     => 'text',
                          'title'    => __( 'Histats Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Histats-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter your Histats Analytics ID.', 'accelerated-mobile-pages' ),
                          'desc' => 'Tutorial: <a href="https://ampforwp.com/tutorials/how-to-get-histats-analytics-id/">How to get Histats Analytics ID for AMP?</a>',
                          'default'  => '',
                      ),
                     // Yandex Metrika  
                       array(
                        'id' => 'ampforwp-Yandex-switch',
                        'type'  => 'switch',
                        'title' => 'Yandex Metrika',
                        'default' => ampforwp_get_default_analytics('9'),
                    ),
                       array(
                        'id'            =>'amp-Yandex-Metrika-analytics-code',
                        'type'          => 'text',
                        'title'         => __('Yandex Metrika Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('ampforwp-Yandex-switch', '=' , '1')),
                        'tooltip-subtitle' => __( 'Enter your Counter ID.', 'accelerated-mobile-pages' ),
                      ),
                      // Chartbeat Analytics 
                       array(
                        'id' => 'ampforwp-Chartbeat-switch',
                        'type'  => 'switch',
                        'title' => 'Chartbeat Analytics',
                        'default' => ampforwp_get_default_analytics('10'),
                    ),
                  
                       array(
                        'id'            =>'amp-Chartbeat-analytics-code',
                        'type'          => 'text',
                        'title'         => __('Chartbeat Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('ampforwp-Chartbeat-switch', '=' , '1')),
                        'tooltip-subtitle' => __( 'Enter your Account ID.', 'accelerated-mobile-pages' ),
                      ),
                     // Alexa Metrics
                         array(
                        'id' => 'ampforwp-Alexa-switch',
                        'type'  => 'switch',
                        'title' => 'Alexa Metrics',
                        'default' => ampforwp_get_default_analytics('11'),
                    ),
                     array(
                          'id'       => 'ampforwp-alexa-account',
                          'type'     => 'text',
                          'title'    => __( 'Alexa Metrics Account', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Alexa-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter Account Number given by Alexa Metrics', 'accelerated-mobile-pages' ),
                          'default'  => '',
                      ),
                      array(
                          'id'       => 'ampforwp-alexa-domain',
                          'type'     => 'text',
                          'title'    => __( 'Alexa Metrics Domain', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Alexa-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter the domain', 'accelerated-mobile-pages' ),
                          'default'  => '',
                      ),
                    // AFS Analytics
                         array(
                        'id' => 'ampforwp-afs-analytics-switch',
                        'type'  => 'switch',
                        'title' => 'AFS Analytics',
                        'default' => ampforwp_get_default_analytics('12'),
                    ),
                    array(
                          'id'       => 'ampforwp-afs-siteid',
                          'type'     => 'text',
                          'title'    => __( 'Website ID', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-afs-analytics-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter the Website ID', 'accelerated-mobile-pages' ),
                          'default'  => '',
                          'desc' => 'example: 00000003',
                      ),
                    //Adobe Analytics
                    array(
                        'id' => 'ampforwp-adobe-analytics-switch',
                        'type'  => 'switch',
                        'title' => 'Adobe Analytics',
                        'default' => ampforwp_get_default_analytics('13'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                    array(
                          'id'       => 'ampforwp-adobe-host',
                          'type'     => 'text',
                          'title'    => __( 'Host Name', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-adobe-analytics-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter the Website domain', 'accelerated-mobile-pages' ),
                          'default'  => '',
                          'desc' => 'example: metrics.example.com',
                    ),
                    array(
                          'id'       => 'ampforwp-adobe-reportsuiteid',
                          'type'     => 'text',
                          'title'    => __( 'ReportSuite ID', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-adobe-analytics-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter the ReportSuite ID', 'accelerated-mobile-pages' ),
                          'default'  => '',
                          'desc' => 'example: 00000003',
                    ),
                    //Adobe Analytics
                    )
             )
   );
    //Get options for Structured Data Type
    if( !function_exists('ampforwp_get_sd_types') ){
        function ampforwp_get_sd_types(){
            $options = array();
            $options = array(
                'BlogPosting'   => 'BlogPosting',
                'NewsArticle'   => 'NewsArticle',
                'Recipe'        => 'Recipe',
                'Product'       => 'Product',
                'VideoObject'   => 'VideoObject',
                'Article'       => 'Article',
                'WebPage'       => 'WebPage'
            );
            return $options;
        }
    }
 
if( ! is_plugin_active('structured-data-for-wp/structured-data-for-wp.php') ) {
    add_filter('ampforwp_sd_custom_fields', 'ampforwp_add_extra_fields');
    function ampforwp_add_extra_fields($fields){
        $post_types = '';
        $custom_fields = array();
        $extra_fields = array();
        $post_types = get_option('ampforwp_custom_post_types');
        if($post_types){
            foreach ($post_types as $post_type) {
                if( $post_type == 'post' || $post_type == 'page' ) {
                            continue;
                }
                $custom_fields[] = array(
                  'id'       => 'ampforwp-sd-type-'. $post_type,
                  'type'     => 'select',
                  'title'    => __($post_type, 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => __('Select the Structured Data Type for '.$post_type, 'accelerated-mobile-pages'),
                  'options'  =>  ampforwp_get_sd_types(),
                  'default'  => 'BlogPosting',
                );
                $extra_fields = array_merge($extra_fields, $custom_fields);
            }
        }
        array_splice($fields, 2, 0,  $extra_fields);
        return $fields;
     }
}

add_filter('ampforwp_sd_custom_fields', 'ampforwp_add_sd_fields');
function ampforwp_add_sd_fields($fields){ 
    if( is_plugin_active('structured-data-for-wp/structured-data-for-wp.php') ) {
           $fields[] = array(
                       'id' => 'amp-cf7-SSL-info',
                       'type' => 'info',
                       'desc' =>"<div style='background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-30px -14px -18px -17px;'><span style='color:#303F9F;'> Note: </span> Structure data Extension is activated, you can setup the <a href=".admin_url( 'admin.php?page=structured_data_options&tab=5' )." target='_blank' >Schema Type Here</a></div>"
                   );

           return $fields;
    }
    else {
          $fields[] =         array(
                      'id' => 'ampforwp-sd_1',
                      'type' => 'section',
                      'title' => __('Schema & Structured Data', 'accelerated-mobile-pages'),
                      'indent' => true,
                      'layout_type' => 'accordion',
                        'accordion-open'=> 1, 
                  );
    $fields[] =   array(
                      'id'       => 'ampforwp-sd-type-posts',
                      'type'     => 'select',
                      'title'    => __('Posts', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => __('Select the Structured Data Type for Posts', 'accelerated-mobile-pages'),
                      'options'  => ampforwp_get_sd_types(),
                      'default'  => 'BlogPosting',
            );
    $fields[] =   array(
                      'id'       => 'ampforwp-sd-type-pages',
                      'type'     => 'select',
                      'title'    => __('Pages', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => __('Select the Structured Data Type for Pages', 'accelerated-mobile-pages'),
                      'options'  =>  ampforwp_get_sd_types(),
                      'default'  => 'BlogPosting',
            );
          $fields[] = array(
                      'id' => 'ampforwp-sd_2',
                      'type' => 'section',
                      'title' => __('Default Values Setup', 'accelerated-mobile-pages'),
                      'indent' => true,
                      'layout_type' => 'accordion',
                        'accordion-open'=> 1, 
                  );

        $fields[] =   array(
                      'id'       => 'amp-structured-data-logo',
                      'type'     => 'media',
                      'url'      => true,
                      'title'    => __('Default Structured Data Logo', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => __('Upload the logo you want to show in Google Structured Data. ', 'accelerated-mobile-pages'),
            );
    $fields[] =   array(
                      'id'       => 'ampforwp-sd-logo-dimensions',
                      'title'    => __('Custom Logo Size', 'accelerated-mobile-pages'),
                      'type'     => 'switch',
                      'default'  => 0,
            );
    $fields[] =   array(
                    'class'=>'child_opt child_opt_arrow',
                      'id'       => 'ampforwp-sd-logo-width',
                      'type'     => 'text',
                      'title'    => __('Logo Width', 'accelerated-mobile-pages'),
                      'tooltip-subtitle'    => __('Default width is 600 pixels', 'accelerated-mobile-pages'),
                      'default' => '600',
                      'required'=>array('ampforwp-sd-logo-dimensions','=','1'),
            );
    $fields[] =   array(
                    'class'=>'child_opt',
                    'id'       => 'ampforwp-sd-logo-height',
                    'type'     => 'text',
                    'title'    => __('Logo Height', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'    => __('Default height is 60 pixels', 'accelerated-mobile-pages'),
                    'default' => '60',
                    'required'=>array('ampforwp-sd-logo-dimensions','=','1'),
            );
    $fields[] =   array(
                      'id'      => 'amp-structured-data-placeholder-image',
                      'type'    => 'media',
                      'url'     => true,
                      'title'   => __('Default Post Image', 'accelerated-mobile-pages'),
                      'tooltip-subtitle'    => __('Upload the Image you want to show as Placeholder Image.', 'accelerated-mobile-pages'),
                      'placeholder'  => __('when there is no featured image set in the post','accelerated-mobile-pages'),
            );
    $fields[] =   array(
                      'id'       => 'amp-structured-data-placeholder-image-width',
                      'title'    => __('Default Post Image Width', 'accelerated-mobile-pages'),
                      'type'     => 'text',
                      'placeholder' => '550',
                      'tooltip-subtitle' => __('Please don\'t add "PX" in the image size.','accelerated-mobile-pages'),
                      'default'  => '700'
            );
    $fields[] =   array(
                      'id'       => 'amp-structured-data-placeholder-image-height',
                      'title'    => __('Default Post Image Height', 'accelerated-mobile-pages'),
                      'type'     => 'text',
                      'placeholder' => '350',
                      'tooltip-subtitle' => __('Please don\'t add "PX" in the image size.','accelerated-mobile-pages'),
                      'default'  => '550'
             );
    $fields[] =   array(
                      'id'      => 'amporwp-structured-data-video-thumb-url',
                      'type'    => 'media',
                      'url'     => true,
                      'title'   => __('Default Thumbnail for VideoObject', 'accelerated-mobile-pages'),
                      'tooltip-subtitle'    => __('Upload the Thumbnail you want to show as Video Thumbnail.', 'accelerated-mobile-pages'),
                      'placeholder'  => __('When there is no thumbnail set for the video','accelerated-mobile-pages'),
            );
    return $fields;
    }
}
// Structured Data
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Structured Data', 'accelerated-mobile-pages' ),
        'id'         => 'opt-structured-data',
        'subsection' => true,
        'fields'     => apply_filters('ampforwp_sd_custom_fields', $fields = array()
        ),
    ) );


    // Notifications SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Notice Bar & GDPR', 'accelerated-mobile-pages' ),
          'desc'       => $cta_desc ,
       'id'         => 'amp-notifications',
       'class'      => 'ampforwp_new_features ',
       'subsection' => true,
       'fields'     => array(
           array(
            'id' => 'ampforwp-notice_2',
            'type' => 'section',
            'title' => __('Notice Bar (Cookie Consent)', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
            'required'  => array('amp-gdpr-compliance-switch', '=' , '0')
                  ),
           
           array(
               'id'        =>'amp-enable-notifications',
               'type'      => 'switch',
               'title'     => __('Notifications', 'accelerated-mobile-pages'),
               'default'   => '',
               'tooltip-subtitle'  => __('Show notifications on all of your AMP pages for cookie purposes, or anything else.', 'accelerated-mobile-pages'),
               'true'      => 'Enabled',
               'false'     => 'Disabled',
               'required'  => array('amp-gdpr-compliance-switch', '=' , '0')
           ),
           array(
           'class' => 'child_opt child_opt_arrow',
           'id'       => 'amp-notification-text',
           'title'    => __('Notice Content', 'accelerated-mobile-pages'),
           'type'     => 'text',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => __('This website uses cookies.','accelerated-mobile-pages'),
           'placeholder' => __('Enter Text here','accelerated-mobile-pages'),
           ),
            array(
           'class' => 'child_opt',
           'id'       => 'amp-accept-button-text',
           'title'    => __('Button Text', 'accelerated-mobile-pages'),
           'type'     => 'text',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => __('Accept','accelerated-mobile-pages'),
           'placeholder' => __('Enter Text here','accelerated-mobile-pages'),
           ),

           array(
            'id' => 'ampforwp-notice_1',
            'type' => 'section',
            'title' => __('GDPR (General Data Protection Regulation)', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
                  ),
           array(
               'id'        =>'amp-gdpr-compliance-switch',
               'type'      => 'switch',
               'title'     => __('GDPR Compliancy', 'accelerated-mobile-pages'),
               'default'   => 0,
               'tooltip-subtitle' => 'Currently It is available to only EEA countries. Check <a href="https://github.com/ampproject/amphtml/blob/master/extensions/amp-geo/0.1/amp-geo-presets.js" target="_blank">here</a> for the list of EEA Countries'
           ),
           array(
                    'id'    => 'gdpr-type',
                   'title'  => __('GDPR Designs', 'accelerated-mobile-pages'),
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Header 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/gdpr-1.png'
                                ),
                        '2' => array(
                                'alt'=>' Header 2 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/gdpr-2.png'
                                ),
                    ),
                   'default'=> '1',
                   'required' => array( array('amp-gdpr-compliance-switch', '=' , '1') ),
            ),
           array(
               'class'  => 'child_opt child_opt_arrow',
               'id'        =>'amp-gdpr-compliance-headline-text',
               'type'      => 'text',
               'title'     => __('Headline Text', 'accelerated-mobile-pages'),
               'default'   => 'Headline',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'tooltip-subtitle'  => 'This is the message that you want to share with the audience',
               'id'        =>'amp-gdpr-compliance-textarea',
               'type'      => 'textarea',
               'title'     => __('Message to Visitor', 'accelerated-mobile-pages'),
               'subtitle'     => __('', 'accelerated-mobile-pages'),
               'default'   => '',
               'required' =>  array(  array('amp-gdpr-compliance-switch', '=' , '1', ), array('gdpr-type', '=' , '1' ) ),
           ),
           
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-accept-text',
               'type'      => 'text',
               'title'     => __('Accept Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Accept',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-reject-text',
               'type'      => 'text',
               'title'     => __('Reject Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Reject',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-settings-text',
               'type'      => 'text',
               'title'     => __('Settings Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Privacy Settings',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-for-more-privacy-info',
               'type'      => 'text',
               'title'     => __('For More information', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __('text before the privacy page button.', 'accelerated-mobile-pages'),
               'default'   => 'For More information about Privacy',
               'required' =>  array(  array('amp-gdpr-compliance-switch', '=' , '1', ), array('gdpr-type', '=' , '1' ) ),
           ),
          
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-select-privacy-page',
               'type'      => 'select',
               'title'     => __('Select the Privacy Page', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __('Select the Privacy Page to display.', 'accelerated-mobile-pages'),
               'default'   => 0,
               'data'      => 'pages',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-privacy-page-button-text',
               'type'      => 'text',
               'title'     => __('Privacy Page Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Click Here',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),

            array(
            'id' => 'ampforwp-notice_popup',
            'type' => 'section',
            'title' => __('PopUp for AMP', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1,
                  ),
           array(
           'class' => 'child_opt child_opt_arrow',
           'id'   => 'info_normal_amp_popup',
           'type'     => 'info',
            'desc' => '<a href="https://ampforwp.com/amp-popup/"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/popup_ext.png" width="560" height="85" /></a>',   
           ),               
       ),  

   ) );

    // Push Notifications section
   Redux::setSection( $opt_name, array(
          'title'       => __( 'Push Notifications', 'accelerated-mobile-pages' ),
//          'icon'        => 'el el-podcast',
          'id'          => 'ampforwp-push-notifications',
          'desc'        => " ",
          'subsection'  => true,
          'fields'      => array(

          array(
            'id' => 'ampforwp-pushnot-1',
            'type' => 'section',
            'title' => __('Push Notification Support', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          ),
                    array(
                            'id'        => 'ampforwp-web-push-onesignal',
                            'type'      => 'switch',
                            'title'     => 'OneSignal',
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/one-signal-in-amp/" target="_blank">View Integration Tutorial</a> (HTTPS is required)',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            ),
                    array(
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 1 ),
                                    ),   
                            'id'        => 'ampforwp-one-signal-app-id',
                            'type'      => 'text',
                            'title'     => 'APP ID',
                            'class' => 'child_opt child_opt_arrow',
                            ),
                    array(
                       'id' => 'ampforwp-onesignal-positioning',
                       'type' => 'section',
                       'title' => __('Positioning', 'accelerated-mobile-pages'),
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 1 ),
                                        array( 'amp-use-pot', '=' , 0 )
                                    ),   
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
                    ),
                    array(
                            'id'        => 'ampforwp-web-push-onesignal-below-content',
                            'type'      => 'switch',
                            'title'     => 'Below the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  1,
                            'tooltip-subtitle'  => 'Show Subscribe Button Below the Content',
                            'required'  => array('ampforwp-web-push-onesignal', '=' , '1'),
                            ),                   
                    array(
                            'id'        => 'ampforwp-web-push-onesignal-above-content',
                            'type'      => 'switch',
                            'title'     => 'Above the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            'tooltip-subtitle'  => 'Show Subscribe Button Above the Content',
                            'required'  => array('ampforwp-web-push-onesignal', '=' , '1'),
                            ),
                    array(
                       'id' => 'translation',
                       'type' => 'section',
                       'title' => __('Translation', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                    ),
                    array(
                       'id'       => 'ampforwp-onesignal-translator-subscribe',
                       'type'     => 'text',
                       'title'    => __('Subscribe', 'accelerated-mobile-pages'),
                       'default'  => __('Subscribe to updates','accelerated-mobile-pages'),
                       'placeholder'=>__('Add some text','accelerated-mobile-pages'),
                   ),
                     array(
                       'id'       => 'ampforwp-onesignal-translator-unsubscribe',
                       'type'     => 'text',
                       'title'    => __('Unsubsribe', 'accelerated-mobile-pages'),
                       'default'  => __('Unsubscribe from updates','accelerated-mobile-pages'),
                       'placeholder'=>__('Add some text','accelerated-mobile-pages'),
                   ),
                   array(
                       'id' => 'ampforwp-onesignal-exper',
                       'type' => 'section',
                       'title' => __('Experimental', 'accelerated-mobile-pages'),
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 1 ),
                                        array( 'amp-use-pot', '=' , 0 )
                                    ),   
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
                    ),
                   array(
                            'id'        => 'ampforwp-onesignal-http-site',
                            'type'      => 'switch',
                            'title'     => 'HTTP Site',
                            'tooltip-subtitle'  => 'For HTTP Sites Only',
                            'required'  => array('ampforwp-web-push-onesignal', '=' , '1'),
                            'true'      => 'true',
                            'false'     => 'false',
                            'default'   => 0
                        ),
                    array(
                            'id'        => 'ampforwp-onesignal-subdomain',
                            'type'      => 'text',
                            'title'     => 'Subdomain',
                            'desc'      => __('Example: ampforwp', 'accelerated-mobile-pages'),
                            'required'  => array(
                                            array('ampforwp-web-push-onesignal', '=' , '1'),
                                            array('ampforwp-onesignal-http-site', '=','1')),
                        ),
                )
            ) 
    );
 // contact form 7 
$forms_support[] =  array(
            'id' => 'ampforwp-cfs_1',
            'type' => 'section',
            'title' => __('CF7 Compatibility', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          );
$forms_support[] =  array(
               'id'        =>'amp-enable-contactform',
               'type'      => 'switch',
               'title'     => __('Contact Form 7 Support', 'accelerated-mobile-pages'),
               'default'   => '',
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           );

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
    if(!is_plugin_active( 'amp-cf7/amp-cf7.php' ) ){
            $forms_support[]= array(
                'id'   => 'info_normal_cf7',
                'type' => 'info',
                'required' => array('amp-enable-contactform', '=' , '1'),
                 'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/contact-form-7/#utm_source=options-panel&utm_medium=cf7-tab_cf7_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Contact Form 7 extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/contact-form-7/#utm_source=options-panel&utm_medium=cf7-tab_cf7_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Click here for more info</a>)</div></div>',               
                   );
        }
    // Gravity Forms 
        $forms_support[] =  array(
            'id' => 'ampforwp-cfs_2',
            'type' => 'section',
            'title' => __('Gravity Forms Compatibility', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
        );
        $forms_support[] = array(
            'id'        =>'amp-enable-gravityforms_support',
            'type'      => 'switch',
            'title'     => __('Gravity Forms Support', 'accelerated-mobile-pages'),
            'default'   => '',
            'true'      => 'Enabled',
            'false'     => 'Disabled',
        );
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
    if(!is_plugin_active( 'amp-gravity-forms/amp-gravity-forms.php' ) ){
        $forms_support[]= array(
                        'id'   => 'info_normal_2',
                        'type' => 'info',
                        'required' => array('amp-enable-gravityforms_support', '=' , '1'),
                        'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/gravity-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Gravity Forms extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/gravity-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Click here for more info</a>)</div></div>',               
        );
    }
    // Ninja Forms 
        $forms_support[] =  array(
            'id' => 'ampforwp-ninja-forms',
            'type' => 'section',
            'title' => __('Ninja Forms Compatibility', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
        );
        $forms_support[] = array(
            'id'        =>'amp-enable-ninja-forms-support',
            'type'      => 'switch',
            'title'     => __('Ninja Forms Support', 'accelerated-mobile-pages'),
            'default'   => '',
            'true'      => 'Enabled',
            'false'     => 'Disabled',
        );
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
    if(!is_plugin_active( 'amp-gravity-forms/amp-ninja-forms.php' ) ){
        $forms_support[]= array(
                        'id'   => 'info_normal_2',
                        'type' => 'info',
                        'required' => array('amp-enable-ninja-forms-support', '=' , '1'),
                        'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/ninja-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Ninja Forms extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/ninja-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Click here for more info</a>)</div></div>',               
        );
    }
 
   // Contact Form SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Contact Form', 'accelerated-mobile-pages' ),
//          'desc'       => 'Contact forms will automatically be converted into AMP compatible.',
       'id'         => 'amp-contact',
       'subsection' => true,
       'fields'     => $forms_support

   ) );

// comments 
 Redux::setSection( $opt_name, array(
    'title'      => __( 'Comments', 'accelerated-mobile-pages' ),
    'desc' => $comment_desc,
    'id'         => 'disqus-comments',
    'subsection' => true,
    'fields'     => array(
    	array(  
	            'id' => 'ampforwp-display-comments',
	            'type' => 'section',
	            'title' => __('Display', 'accelerated-mobile-pages'),
	            'indent' => true,
	            'layout_type' => 'accordion',
	            'accordion-open'=> 1, 
	          ),
	      array(
	                 'id'       => 'ampforwp-display-on-pages',
	                 'type'     => 'switch',
	                 'title'    => __('Display on Pages', 'accelerated-mobile-pages'),
	                 'tooltip-subtitle' => __('Enable/Disable comments on pages using this switch.', 'accelerated-mobile-pages'),
	                 'default'  => 1
	             ),
	       array(
	                 'id'       => 'ampforwp-display-on-posts',
	                 'type'     => 'switch',
	                 'title'    => __('Display on Posts', 'accelerated-mobile-pages'),
	                 'tooltip-subtitle' => __('Enable/Disable comments on posts using this switch.', 'accelerated-mobile-pages'),
	                 'default'  => 1
	             ),
    	
        array(  
            'id' => 'ampforwp-comments',
            'type' => 'section',
            'title' => __('Discussion', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          ),
        array(
                'title'     =>__('WordPress Comments','accelerated-mobile-pages'),
                'id'        => 'wordpress-comments-support',
                'tooltip-subtitle'  => __('Enable/Disable WordPress comments using this switch.', 'accelerated-mobile-pages'),
                'type'      => 'switch',
                'default'  => 1,
                ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-number-of-comments',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('This refers to the normal comments','accelerated-mobile-pages'),
                         'title'    => __('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array('wordpress-comments-support' , '=' , 1
                                        ),
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-display-avatar',
                         'type'     => 'switch',
                         'title'    => __('Display on User Avatar', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable user Avatar.', 'accelerated-mobile-pages'),
                         'default'  => 1,
                          'required' => array('wordpress-comments-support' , '=' , 1
                                        ),
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Disqus', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Disqus comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0
                     ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-disqus-comments-name',
                         'type'     => 'text',
                         'title'    => __('Disqus Name', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Eg: https://xyz.disqus.com', 'accelerated-mobile-pages'),
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                         'default'  => ''
                     ),

                     array(
                        'class' => 'child_opt', 
                         'id'       => 'ampforwp-disqus-host-position',
                         'type'     => 'switch',
                         'title'    => __('Host on AMPforWP API', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Use AMPforWP secure servers to serve Comments file. Recommended if your site is non HTTPS', 'accelerated-mobile-pages'),
                         'default'  => 1,
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                     ),

                     array(
                        'class' => 'child_opt', 
                         'id'       => 'ampforwp-disqus-host-file',
                         'type'     => 'text',
                         'title'    => __('Disqus Host File', 'accelerated-mobile-pages'),
                         'desc' => '<a href="https://ampforwp.com/host-disqus-comments/" target="_blank"> Click here to know, How to Setup Disqus Host file on your servers </a>',
                         'tooltip-subtitle' => __('Enter the URL of host file', 'accelerated-mobile-pages'),
                         'placeholder' => 'https://comments.example.com/disqus.php',
                         'required' => array('ampforwp-disqus-host-position', '=' , '0'),
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-layout',
                         'title'    => __('Disqus Layout', 'accelerated-mobile-pages'),
                         'type'     => 'select',
                         'options'     => array(
                            'fixed'   => 'Fixed',
                            'responsive' => 'Responsive'
                         ),
                         'default' => 'responsive',
                         'required'=>array('ampforwp-disqus-comments-support','=','1'),
                    ),

                     array(
                         'id'       => 'ampforwp-disqus-height',
                         'type'     => 'text',
                         'title'    => __('Disqus Iframe Height', 'accelerated-mobile-pages'),
                         'placeholder' => 'Enter the height',
                         'default' => '420',
                         'required' => array('ampforwp-disqus-layout', '=' , 'fixed'),
                     ),
                     array(
                         'id'       => 'ampforwp-facebook-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Facebook Comments', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Facebook comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-number-of-fb-no-of-comments',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the number of comments','accelerated-mobile-pages'),
                         'title'    => __('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array(
                            array('ampforwp-facebook-comments-support', '=' , 1),
                         ),
                    ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-fb-comments-lang',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the Language code','accelerated-mobile-pages'),
                         'title'    => __('Language', 'accelerated-mobile-pages'),
                         'desc' => '<a href="https://developers.facebook.com/docs/internationalization" target="_blank">Locales and Languages Supported by Facebook </a>',
                         'default'  => get_locale(),
                         'required' => array(
                            array('ampforwp-facebook-comments-support', '=' , 1)
                         ),
                    ),
                     //Vuukle options
                    array(
                         'id'       => 'ampforwp-vuukle-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Vuukle Comments', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Vuukle comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-vuukle-comments-apiKey',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the API key of Vuukle','accelerated-mobile-pages'),
                         'title'    => __('API Key', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'desc'     => "For Example xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                         'required' => array(
                            array('ampforwp-vuukle-comments-support', '=' , 1),
                         ),
                    ),
                     //SpotIM Options
                    array(
                         'id'       => 'ampforwp-spotim-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Spot.IM Conversation', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => __('Enable/Disable Spot.IM Conversation using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-spotim-comments-apiKey',
                         'type'     => 'text',
                         'tooltip-subtitle'     => __('Enter the SPOT_ID of Spot.IM','accelerated-mobile-pages'),
                         'title'    => __('SPOT ID', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'desc'     => "For Example xxxxxxxx-xxxx-xxxx-xxxx",
                         'required' => array(
                            array('ampforwp-spotim-comments-support', '=' , 1),
                         ),
                    ),

                 )
 ) );

function fb_instant_article() {
    $feedname = '';
    $fb_instant_article_feed = ''; 
    $input = ''; 

    $feedname   = 'instant_articles';
    $fb_instant_article_feed = trailingslashit( site_url() ).$feedname ;
    $input      =  '<a href=" '. $fb_instant_article_feed  . '" target="_blank">' .  esc_url( $fb_instant_article_feed ). '</a>' ;

    return strip_tags($input, '<a>');
}

// Facebook Instant Articles
Redux::setSection( $opt_name, array(
   'title'      => __( 'Instant Articles', 'accelerated-mobile-pages' ),
   'id'         => 'fb-instant-article',
   'subsection' => true,
   'fields'     => array(
        array(  
            'id' => 'ampforwp-fbia_1',
            'type' => 'section',
            'title' => __('Facebook Instant Articles Setup', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          ),
                     array(
                        'id'        =>'fb-instant-article-switch',
                        'type'      => 'switch',
                        'title'     => __('Instant Articles', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => __('Re-Save permalink when you enable this option, please have a look <a href="https://ampforwp.com/flush-rewrite-urls/">here</a> on how to do it', 'accelerated-mobile-pages'),
                    ),    
                    array(
                        'id'       => 'fb-instant-article-feed-url',
                        'type' => 'info',
                        'style' => 'critical',
                        'desc' => fb_instant_article(),
                        'title'    => __('Facebook Instant Articles Feed URL', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'    => 'fb-instant-page-id',
                        'type'  => 'text',
                        'title' => __('Facebook Page ID', 'accelerated-mobile-pages'),
                        'desc' => __('Follow <a href="https://www.facebook.com/instant_articles/signup" target="_blank">these instructions</a> to sign up to Instant Articles and get your Facebook Page ID.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),

           array(
                       'id' => 'amp-fbia_2',
                       'type' => 'section',
                       'title' => __('Facebook Instant Articles Settings', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
                       'required'  => array('fb-instant-article-switch', '=', 1),
            ),
                    array(
                        'id'       => 'ampforwp-fb-instant-article-posts',
                        'type'      => 'text',
                        'title'     => __('Number of Posts', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Enter the number of posts to generate for Instant Articles.', 'accelerated-mobile-pages'),
                         'desc' => __('Leave this empty to generate All Posts.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1),
                        'default'   => '50'
                    ),
                    array(
                        'id'       => 'ampforwp-instant-article-author-meta',
                        'type'      => 'switch',
                        'title'     => __('Author Meta', 'accelerated-mobile-pages'),
                        'default'   => 1, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'tooltip-subtitle' => __('Enable/Disable Author Meta', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'ampforwp-instant-article-author-bio',
                        'type'      => 'switch',
                        'title'     => __('Author Bio', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'tooltip-subtitle' => __('Enable/Disable Author Bio', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'ampforwp-ia-related-articles',
                        'type'      => 'switch',
                        'title'     => __('Related Articles', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'tooltip-subtitle' => __('Show/Hide Related Articles', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),  
                    array(
                        'id'       => 'fb-instant-article-ads',
                        'type'      => 'switch',
                        'title'     => __('Advertisement', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => __('Switch this on to enable advertising on Instant Article pages.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fb-instant-article-ad-type',
                        'type'      => 'select',
                        'title'     => __('Select Advertisement Format', 'accelerated-mobile-pages'),
                        'default'   => '1',
                        'desc' => __('Select the type of advertising on Instant Article pages you want to display.', 'accelerated-mobile-pages'),
                        'options'   => array(
                            '1'     => 'Facebook Audience Network',
                            '2'     => 'Custom iframe URL',
                            '3'     => 'Custom Embed Code'
                        ),
                        'required'  => array('fb-instant-article-ads', '=', 1)
                    ),
                    array(
                        'id'       => 'fb-instant-article-ad-id',
                        'type'     => 'text',
                        'title'    => __('Enter your Audience Network Placement ID', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('You can find out more about this <a href="https://developers.facebook.com/docs/instant-articles/monetization/audience-network">here</a>. ', 'accelerated-mobile-pages'),
                        'desc' => __('<a href="https://ampforwp.com/tutorials/article/how-to-enter-audience-network-placement-id-of-advertisement-in-the-instant-article/" target="_blank">Click here</a> on how to get Audience Network Placement Id.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-ad-type', '=', '1')
                    ),
                    array(
                        'id'       => 'fb-instant-article-custom-iframe-ad',
                        'type'     => 'text',
                        'placeholder'=> 'https://www.adserver.com/ss',
                        'title'    => __('Enter your Custom iframe ad source URL'),
                        'required'  => array('fb-instant-article-ad-type', '=', '2')
                    ),
                    array(
                        'id'       => 'fb-instant-article-custom-embed-ad',
                        'type'     => 'textarea',
                        'placeholder'=> '',
                        'title'    => __('Enter your Custom Embed ad code'),
                        'required'  => array('fb-instant-article-ad-type', '=', '3')
                    ),
                    array(
                        'id'       => 'fb-instant-article-ad-density-setup',
                        'type'     => 'select',
                        'title'    => __('How often should ads show in Instant Article pages', 'accelerated-mobile-pages'),
                        'options'  => array(
                            'default' => __('Every 250 words', 'accelerated-mobile-pages' ),
                            'medium' => __('Every 350 words', 'accelerated-mobile-pages' ),
                            'low' => __('Every 500 words', 'accelerated-mobile-pages' ),
                        ),
                        'required'  => array('fb-instant-article-ads', '=', 1),
                        'default'  => 'default',
                    ),
                    array(
                        'id'       => 'fb-instant-article-analytics',
                        'type'      => 'switch',
                        'title'     => __('Analytics', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => __('Switch this on to enable analytics on Instant Article pages.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fb-instant-article-analytics-code',
                        'type'     => 'textarea',
                        'title'    => __('Enter your Analytics script code', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Do not enter iframe tag. Find out more about support <a href="https://developers.facebook.com/docs/instant-articles/analytics">here</a> ', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-analytics', '=', 1)
                    ),
                     array(
                        'id'       => 'fb-instant-crawler-ingestion',
                        'type' => 'switch',
                        'title'    => __('Crawler Ingestion', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Add ia:markup meta tag. Find out more about<a href="https://developers.facebook.com/docs/instant-articles/crawler-ingestion" target="_blank">here</a> ', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fbia-header-text-area',
                        'type'     => 'textarea',
                        'title'    => __('Custom HTML in Head Tag', 'accelerated-mobile-pages'),
                        'desc' => __('Add custom HTML in Head Tag in Instant Articles Markup. Click <a href="https://developers.facebook.com/docs/instant-articles/guides/articlecreate" target="_blank">here</a> for more info on Instant Articles Markup', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fbia-body-text-area',
                        'type'     => 'textarea',
                        'title'    => __('Custom HTML in Body Tag', 'accelerated-mobile-pages'),
                        'desc' => __('Add custom HTML in Body Tag in Instant Articles Markup. Click <a href="https://developers.facebook.com/docs/instant-articles/guides/articlecreate" target="_blank">here</a> for more info on Instant Articles Markup', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fbia-footer-text-area',
                        'type'     => 'textarea',
                        'title'    => __('Custom HTML in Footer Tag', 'accelerated-mobile-pages'),
                        'desc' => __('Add custom HTML in Footer Tag in Instant Articles Markup. Click <a href="https://developers.facebook.com/docs/instant-articles/guides/articlecreate" target="_blank">here</a> for more info on Instant Articles Markup', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
    ),
   )
);

 // Hide AMP Bulk Tools
Redux::setSection( $opt_name, array(
   'title'      => __( 'Hide AMP Bulk Tools', 'accelerated-mobile-pages' ),
   'id'         => 'hide-amp-section',
   'subsection' => true,
   'desc'       => 'Here are some Advanced options to help you exclude AMP from your prefered pages',
   'fields'     => array(

                        array(
                           'id'       => 'amp-pages-meta-default',
                           'type'     => 'select',
                           'title'    => __( 'Individual AMP Page (Bulk Edit)', 'accelerated-mobile-pages' ),
                           'tooltip-subtitle' => __( 'Allows you to Show or Hide AMP from All pages, so it can be changed individually later. This option will change the  Default value of AMP metabox in Pages', 'accelerated-mobile-pages' ),
                           'desc' => __( 'NOTE: Changes will overwrite the previous settings.', 'accelerated-mobile-pages' ),
                           'options'  => array(
                               'show' => __('Show by Default', 'accelerated-mobile-pages' ),
                               'hide' => __('Hide by default', 'accelerated-mobile-pages' ),
                           ),
                           'default'  => 'show',
                           'required'=>array('amp-on-off-for-all-pages','=','1'),
                        ),       
                        array(
                        'id'        =>'hide-amp-categories',
                        'type'      => 'checkbox_hierarchy',
                        'title'     => __('Select Categories to Hide AMP'),
                        'tooltip-subtitle' => __( 'Hide AMP from all the posts of a selected category.', 'accelerated-mobile-pages' ),
                        'default'   => 0, 
                        'data'      => 'category_list_hierarchy',
                        ), 
                        array(
                        'id'        =>'hide-amp-tags-bulk-option',
                        'type'      => 'checkbox',
                        'title'     => __('Select Tags to Hide AMP'),
                        'tooltip-subtitle' => __( 'Hide AMP from all the posts of a selected tags.', 'accelerated-mobile-pages' ),
                        'default'   => 0, 
                        'data'      => 'tags',

                       ),
                    )   
                 )
    );

 // Advance Settings SECTION
Redux::setSection( $opt_name, array(
   'title'      => __( 'Advance Settings', 'accelerated-mobile-pages' ),
   'desc'       => __( 'This section has some advanced settings, please use it with care','accelerated-mobile-pages'),
   'id'         => 'amp-advance',
   'subsection' => true,
   'fields'     => array(

                   /* array(
                        'id'       => 'ampforwp-homepage-on-off-support',
                        'type'     => 'switch',
                        'title'    => __('Homepage Support', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Enable/Disable Home page using this switch.', 'accelerated-mobile-pages'),
                        'default'  => '1'
                    ),*/

                    array(
                        'id'       => 'amp-mobile-redirection',
                        'type'     => 'switch',
                        'title'    => __('Mobile Redirection', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('
                        Enable AMP for your mobile users. Give your visitors a Faster mobile User Experience.','accelerated-mobile-pages'),
                        'default' => 0,

                    ),
                    array(
                        'id'       => 'convert-internal-nonamplinks-to-amp',
                        'type'     => 'switch',
                        'title'    => __('Change Internal Links to AMP', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Enable if you want all your links inside the article to go to /amp/. All the outbound links will remain untouched.','accelerated-mobile-pages'),
                        'default' => 0,
                    ),
                    // End-point option
                     array(
                        'id'       => 'amp-core-end-point',
                        'type'     => 'switch',
                        'title'    => ('Change End Point to ?amp'),
                        'default' => 0,
                        'tooltip-subtitle' => 'Enable this option when /amp/ is giving 404 after resaving the permalink settings.',
                        'desc'     => __( 'Making endpoints to ?amp will help you get the amp in tricky setups with taxonomies & post typs. Question mark in the url will not make any difference in the SEO.' ),
                    ),
                    array(
                        'id'       => 'amp-header-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => __('Enter HTML in Head', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => __('check your markup here (enter markup between HEAD tag) : https://validator.ampproject.org/', 'accelerated-mobile-pages'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'amp-body-text-area',
                        'type'     => 'textarea',
                        'title'    => __('Enter HTML in Body (beginning of body tag) ', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => __('check your markup here (enter markup in the beginning of body tag) : https://validator.ampproject.org/', 'accelerated-mobile-pages'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'amp-footer-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => __('Enter HTML in Footer', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => __('check your markup here (enter markup between BODY tag) : https://validator.ampproject.org/',
                        'accelerated-mobile-pages'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'ampforwp-auto-amp-menu-link',
                        'type'     => 'switch',
                        'title'    => __('Auto Add AMP in Menu URL', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Automatically add <code>AMP</code> at the end of menu url', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,
                        //'required'  => array('ampforwp-amp-menu', '=' , '1')
                    ),
					//Category Base Removal in AMP
					array(
                        'id'       => 'ampforwp-category-base-removel-link',
                        'type'     => 'switch',
                        'title'    => __('Category base remove in AMP', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Category base removal in <code>AMP</code> from url', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,
                        
                    ),
					//Tag base Removal in AMP
					array(
                        'id'       => 'ampforwp-tag-base-removal-link',
                        'type'     => 'switch',
                        'title'    => __('Tag base remove in AMP', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Tag base remove in <code>AMP</code> from url', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,
                        
                    ),
                    // Featured Image from Custom Fields
                    array(
                        'id'       => 'ampforwp-custom-fields-featured-image-switch',
                        'type'     => 'switch',
                        'title'    => __('Featured Image from Custom Fields', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('This will allow you to add Featured Image from Custom Fields', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                    array(
                       'id'       => 'ampforwp-custom-fields-featured-image',
                       'type'     => 'text',
                       'title'    => __('Custom Field For Featured Image', 'accelerated-mobile-pages'),
                       'default'  => __ ('','accelerated-mobile-pages'),
                       'placeholder'=>__('Write the Custom Field of Featured Image','accelerated-mobile-pages'),
                       'required' => array( 'ampforwp-custom-fields-featured-image-switch', '=' , 1 )
                   ),
                    // Grab the First Image for Featured Image if there is none
                    array(
                        'id'       => 'ampforwp-featured-image-from-content',
                        'type'     => 'switch',
                        'title'    => __('Featured Image from The Content', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Show the first image of the content as Featured Image if there is no featured image', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                    // Duplicate Featured Image
                    array(
                        'id'       => 'ampforwp-duplicate-featured-image',
                        'type'     => 'switch',
                        'title'    => __('Duplicate Featured Image', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Turn On the support if you want to show the Featured Image if it already exists in post content.', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                    // Retina Images
                    array(
                        'id'       => 'ampforwp-retina-images',
                        'type'     => 'switch',
                        'title'    => __('Retina Images', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Enable if your current images looking blured on Apple Devices.', 'accelerated-mobile-pages'),
                        'default'   => 0,                        
                    ),
                     array(
                        'id'       => 'ampforwp-retina-images-res',
                        'type'     => 'select',
                        'options'  => array(
                            '2'   => '2x',
                            '3'   => '3x',
                            '4'   => '4x',
                        ),
                        'title'    => __('Retina Images Resolution', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Select the Resolution', 'accelerated-mobile-pages'),
                        'default'   => '2',   
                        'required' => array('ampforwp-retina-images', '=', 1)
                    ),
                    array(
                        'id'       => 'amp-meta-permissions',
                        'type'     => 'select',
                        'title'    => __('Show Metabox in Post Editor to', 'accelerated-mobile-pages'),
                        'options'  => array(
                            'all'       => 'All users who can post',
                            'admin'     => 'Only to Admin'
                        ),
                        'default'  => 'all',
                    ),
                     array(
                        'id'       => 'ampforwp-development-mode',
                        'type'     => 'switch',
                        'title'    => __('Dev Mode in AMP'),
                        'tooltip-subtitle' => __('This will enable the Development mode in AMP', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                      array(
                        'id'       => 'ampforwp-development-mode-notice',
                        'type'     => 'info',
                        'style'    => 'info',
                        'desc'     => __('Add /amp at the end of url to view the AMP version of the site. Search Engines will not be able to Crawl the AMP site when in Dev Mode.', 'accelerated-mobile-pages'),
                        'title'    => __('Dev Mode', 'accelerated-mobile-pages'),
                        'required' => array('ampforwp-development-mode', '=', 1)
                    ),
                      array(
                        'id'       => 'ampforwp-update-notification-bar',
                        'type'     => 'switch',
                        'title'    => __('Plugin Update Notification Bar'),
                        'tooltip-subtitle' => __('Enable/Disable the Plugin Update Notification Bar', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 1,                        
                    ),
                    array(
                        'id'       => 'ampforwp-wptexturize',
                        'type'     => 'switch',
                        'title'    => __('Disable wptexturize'),
                        'tooltip-subtitle' => __('Enable this option to Disable wptexturize Globally', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ), 
                    array(
                        'id'       => 'ampforwp-content-builder',
                        'type'     => 'switch',
                        'title'    => __('Legacy Page Builder (widgets)', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Build AMP Landing pages in minutes.', 'accelerated-mobile-pages'),
                        'true'      => 'true',                
                        'false'     => 'false',
                        'default'   => 0
                    ),
                    // Delete Data on Deletion
                    array(
                        'id'       => 'ampforwp-delete-on-uninstall',
                        'type'     => 'switch',
                         'title'    => __('Delete Data on Uninstall?', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'tooltip-subtitle'      => __('Enable this if you would like AMPforWP to completely remove all of its data when uninstalling via Plugins > Delete.'),
                    ),
   ),

) );

// WooCommerce Compatibility
$e_commerce_support[] =  array(
            'id' => 'ampforwp-woocommerce',
            'type' => 'section',
            'title' => __('WooCommerce Compatibility', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          );
$e_commerce_support[] =  array(
               'id'        =>'amp-enable-woocommerce',
               'type'      => 'switch',
               'title'     => __('WooCommerce Support', 'accelerated-mobile-pages'),
               'default'   => '',
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           );
     if(!is_plugin_active( 'amp-woocommerce/amp-woocommerce.php' ) && !is_plugin_active( 'amp-woocommerce-pro/amp-woocommerce.php' ) ){
        $e_commerce_support[]= array(
            'id'   => 'info_normal_woocommerce',
            'type' => 'info',
            'required' => array('amp-enable-woocommerce', '=' , '1'),
             'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires a free extension <a href="https://wordpress.org/plugins/amp-woocommerce/" target="_blank">AMP WooCommerce</a>.<br /> <div style="margin-top:4px;">(<a href="https://wordpress.org/plugins/amp-woocommerce/" target="_blank">'.__('Click here for more info','accelerated-mobile-pages').'</a>)</div></div>',               
               );
    }
    elseif ( is_plugin_active( 'amp-woocommerce/amp-woocommerce.php' ) && !is_plugin_active( 'amp-woocommerce-pro/amp-woocommerce.php' ) ) {
        $e_commerce_support[]= array(
            'id'   => 'info_normal_woocommerce_pro',
            'type' => 'info',
            'required' => array('amp-enable-woocommerce', '=' , '1'),
            'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>Pro Version:</b> Everything in Free, and Archives, Gallery, Cart, Variants & Attributes, Rating & Reviews Support.<a href="https://ampforwp.com/woocommerce/" target="_blank"></a><br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/woocommerce/" target="_blank">'.__('Click here for more info','accelerated-mobile-pages').'</a>)</div></div>',                
        );
    }
    elseif ( is_plugin_active( 'amp-woocommerce-pro/amp-woocommerce.php' ) ) {
        $e_commerce_support[]= array(
            'id'   => 'info_woocommerce_pro',
            'type' => 'info',
            'style' => 'success',
            'required' => array('amp-enable-woocommerce', '=' , '1'),
            'desc'     => __(' AMP WooCommerce is activated', 'accelerated-mobile-pages'),           
        );
    }
 // EDD Compatibility
$e_commerce_support[] =  array(
            'id' => 'ampforwp-edd-compatibility',
            'type' => 'section',
            'title' => __('Easy Digital Downloads Compatibility', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          );
$e_commerce_support[] = array(
               'id'        =>'amp-edd-support',
               'type'      => 'switch',
               'title'     => __('Easy Digital Downloads Support', 'accelerated-mobile-pages'),
               'default'   => '',
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           );
    if(!is_plugin_active( 'edd-for-amp/edd-for-amp.php' ) ){
        $e_commerce_support[]= array(
                        'id'   => 'info_normal_edd',
                        'type' => 'info',
                        'required' => array('amp-edd-support', '=' , '1'),
                        'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/edd-for-amp/" target="_blank">EDD for AMP extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/edd-for-amp/" target="_blank">'.__('Click here for more info','accelerated-mobile-pages').'</a>)</div></div>',              
           );}
 
   // E Commerce SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'E-Commerce', 'accelerated-mobile-pages' ),
       'id'         => 'amp-e-commerce',
       'subsection' => true,
       'fields'     => $e_commerce_support
    ) );
   
   // Translation Panel
           Redux::setSection( $opt_name, array(
               'title'      => __( 'Translation Panel', 'accelerated-mobile-pages' ),
               'desc'       => __( 'Please translate the following words of page accordingly else default content is in English Language', 'accelerated-mobile-pages' ),
               'id'         => 'amp-translator',
               'subsection' => true,
               'fields'     => array(
                   array(
                       'id'       => 'amp-use-pot',
                       'type'     => 'switch',
                       'title'    => __('Use POT file method of Translation', 'accelerated-mobile-pages'),
                       'tooltip-subtitle' => __('Else you can use normal translation method', 'accelerated-mobile-pages'),
                       'desc'     => __('Use this if you want Multilingual Translations', 'accelerated-mobile-pages'),
                       'default'  => 0
                   ),
                   array(
                       'id'       => 'amp-translator-breadcrumbs-homepage-text',
                       'type'     => 'text',
                       'title'    => __('Breadcrumbs Homepage Title', 'accelerated-mobile-pages'),
                       'default'  => __('Homepage','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-fourohfour',
                       'type'     => 'text',
                       'title'    => __('404 Error', 'accelerated-mobile-pages'),
                       'default'  => __('Oops! That page can’t be found.','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-more-posts-text',
                       'type'     => 'text',
                       'title'    => __('Show more Posts', 'accelerated-mobile-pages'),
                       'default'  => __('Show more Posts','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-previous-posts-text',
                       'type'     => 'text',
                       'title'    => __('Show previous Posts', 'accelerated-mobile-pages'),
                       'default'  => __('Show previous Posts','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-top-text',
                       'type'     => 'text',
                       'title'    => __('Top', 'accelerated-mobile-pages'),
                       'default'  => __('Top','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-non-amp-page-text',
                       'type'     => 'text',
                       'title'    => __('View Non-AMP Version', 'accelerated-mobile-pages'),
                       'default'  => __('View Non-AMP Version','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-related-text',
                       'type'     => 'text',
                       'title'    => __('Related Post', 'accelerated-mobile-pages'),
                       'default'  => __('Related Post','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-recent-text',
                       'type'     => 'text',
                       'title'    => __('Recent Posts', 'accelerated-mobile-pages'),
                       'default'  => __('Recent Posts','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-navigate-text',
                       'type'     => 'text',
                       'title'    => __('Navigate', 'accelerated-mobile-pages'),
                       'default'  => __('Navigate','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-on-text',
                       'type'     => 'text',
                       'title'    => __('On', 'accelerated-mobile-pages'),
                       'default'  => __('On','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-next-text',
                       'type'     => 'text',
                       'title'    => __('Next', 'accelerated-mobile-pages'),
                       'default'  => __('Next','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-previous-text',
                       'type'     => 'text',
                       'title'    => __('Previous', 'accelerated-mobile-pages'),
                       'default'  => __('Previous','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-page-text',
                       'type'     => 'text',
                       'title'    => __('Page', 'accelerated-mobile-pages'),
                       'default'  => __('Page','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archives-text',
                       'type'     => 'text',
                       'title'    => __('Archives', 'accelerated-mobile-pages'),
                       'default'  => __('Archives','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-breadcrumbs-search-text',
                       'type'     => 'text',
                       'title'    => __('Search results for', 'accelerated-mobile-pages'),
                       'default'  => __('Search results for','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-error-404-text',
                       'type'     => 'text',
                       'title'    => __('Error 404', 'accelerated-mobile-pages'),
                       'default'  => __('Error 404','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-footer-text',
                       'type'     => 'textarea',
                       'title'    => __('Footer', 'accelerated-mobile-pages'),
                       'default'  => __('All Rights Reserved','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-categories-text',
                       'type'     => 'text',
                       'title'    => __('Categories', 'accelerated-mobile-pages'),
                       'default'  => __('Categories: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-tags-text',
                       'type'     => 'text',
                       'title'    => __('Tags', 'accelerated-mobile-pages'),
                       'default'  => __('Tags: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-by-text',
                       'type'     => 'text',
                       'title'    => __('By', 'accelerated-mobile-pages'),
                       'default'  => __('By','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-published-by',
                       'type'     => 'text',
                       'title'    => __('Published by', 'accelerated-mobile-pages'),
                       'default'  => __('Published by','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-in-designthree',
                       'type'     => 'text',
                       'title'    => __('in', 'accelerated-mobile-pages'),
                       'default'  =>__( 'in','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-view-comments-text',
                       'type'     => 'text',
                       'title'    => __('View Comments', 'accelerated-mobile-pages'),
                       'default'  => __('View Comments','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-leave-a-comment-text',
                       'type'     => 'text',
                       'title'    => __('Leave a Comment', 'accelerated-mobile-pages'),
                       'default'  => __('Leave a Comment','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-comments-closed',
                       'type'     => 'text',
                       'title'    => __('Comments are closed.', 'accelerated-mobile-pages'),
                       'default'  => __('Comments are closed.','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-at-text',
                       'type'     => 'text',
                       'title'    => __('at', 'accelerated-mobile-pages'),
                       'default'  => __('at','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-says-text',
                       'type'     => 'text',
                       'title'    => __('says', 'accelerated-mobile-pages'),
                       'default'  =>__( 'says','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-Edit-text',
                       'type'     => 'text',
                       'title'    => __('Edit', 'accelerated-mobile-pages'),
                       'default'  => __('Edit','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-ago-date-text',
                       'type'     => 'text',
                       'title'    => __('ago', 'accelerated-mobile-pages'),
                       'default'  => __('ago','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-modified-date-text',
                       'type'     => 'text',
                       'title'    => __('This post was last modified on ', 'accelerated-mobile-pages'),
                       'default'  => __('This post was last modified on ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archive-cat-text',
                       'type'     => 'text',
                       'title'    => __('Category (archive title)', 'accelerated-mobile-pages'),
                       'default'  => __('Category: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archive-tag-text',
                       'type'     => 'text',
                       'title'    => __('Tag (archive title)', 'accelerated-mobile-pages'),
                       'default'  => __('Tag: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-more-text',
                       'type'     => 'text',
                       'title'    => __('View More Posts (Widget Button)', 'accelerated-mobile-pages'),
                       'default'  => __('View More Posts','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                    array(
                       'id'       => 'amp-translator-next-read-text',
                       'type'     => 'text',
                       'title'    => __('Next Read', 'accelerated-mobile-pages'),
                       'default'  => __('Next Read: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                    array(
                       'id'       => 'amp-translator-read-more',
                       'type'     => 'text',
                       'title'    => __('Read More', 'accelerated-mobile-pages'),
                       'default'  => __('Read More','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                    ),
                    array(
                       'id'       => 'amp-translator-via-text',
                       'type'     => 'text',
                       'title'    => __('via', 'accelerated-mobile-pages'),
                       'default'  => __('via','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                     array(
                       'id'       => 'amp-translator-share-text',
                       'type'     => 'text',
                       'title'    => __('Share', 'accelerated-mobile-pages'),
                       'default'  => __('Share','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-search-text',
                       'type'     => 'text',
                       'title'    => __(' You searched for: ', 'accelerated-mobile-pages'),
                       'default'  => __(' You searched for: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-search-no-found',
                       'type'     => 'text',
                       'title'    => __(' It seems we can\'t find what you\'re looking for. ', 'accelerated-mobile-pages'),
                       'default'  => __(' It seems we can\'t find what you\'re looking for. ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                     array(
                       'id'       => 'amp-translator-and-text',
                       'type'     => 'text',
                       'title'    => __(' and ', 'accelerated-mobile-pages'),
                       'default'  => __(' and ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id' => 'design-3-search-subsection',
                       'type' => 'section',
                       'title' => __('Search bar Translation Text', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'required' => array( 'amp-use-pot', '=' , 0 ),
                       'layout_type' => 'accordion',
                        'accordion-open'=> 0,
                   ),
                   array(
                      'id'       => 'ampforwp-search-placeholder',
                      'type'     => 'text',
                      'title'    => __('Type Here', 'accelerated-mobile-pages'),
                      'default'  => 'Type Here','accelerated-mobile-pages'),
                      'desc' => __('This is the text that gets shown in for Search Box','accelerated-mobile-pages'),
                      'placeholder'=>__('write here','accelerated-mobile-pages'),
                      'required' => array( 'amp-use-pot', '=' , 0 )

                  ),
                  array(
                     'id'       => 'ampforwp-search-label',
                     'type'     => 'text',
                     'title'    => __('Type your search query and hit enter', 'accelerated-mobile-pages'),
                     'desc' => __('This is the text that gets shown above Search Box','accelerated-mobile-pages'),
                     'default'  => __('Type your search query and hit enter: ','accelerated-mobile-pages'),
                     'placeholder'=>__('write here','accelerated-mobile-pages'),
                     'required' => array( 'amp-use-pot', '=' , 0 )

                 )
    ) );


// Appearance Section
Redux::setSection( $opt_name, array(
              'title'      => __( 'Design', 'accelerated-mobile-pages' ),
              'icon' => 'el el-adjust-alt',
              'desc'  => ''

        ));

    //get All design
    function amp_extra_plugin_theme_header($headers){
        $headers['AMP Theme Name'] = "AMP";
        $headers['AMP Theme Demo'] = "AMP Demo";
        return $headers;
    }
    add_filter("extra_plugin_headers","amp_extra_plugin_theme_header");
    $themeDesign = array(
			array(
                'demo_link' => 'https://ampforwp.com/demo/#one',
				'upgrade'=>true,
				'title'=>__('Design One', 'accelerated-mobile-pages' ),
				'value'=>1,
				'alt'=>__('Design One', 'accelerated-mobile-pages' ),
				'img'=>AMPFORWP_PLUGIN_DIR_URI.'/images/design-1.png',
			),
			array(
                'demo_link' => 'https://ampforwp.com/demo/#two',
				'upgrade'=>true,
				'title'=>__('Design Two', 'accelerated-mobile-pages' ),
				'value'=>2,
				'alt'=>__('Design Two', 'accelerated-mobile-pages' ),
				'img'=>AMPFORWP_PLUGIN_DIR_URI.'/images/design-2.png',
			),
			array(
                'demo_link' => 'https://ampforwp.com/demo/#three',
				'upgrade'=>true,
				'title'=>__('Design Three', 'accelerated-mobile-pages' ),
				'value'=>3,
				'alt'=>__('Design Three', 'accelerated-mobile-pages' ),
				'img'=>AMPFORWP_PLUGIN_DIR_URI.'/images/design-3.png',
			),
            array(
                'demo_link' => 'https://ampforwp.com/demo/amp-pagebuilder/amp/',
                'upgrade' => true,
                'title' => __('Swift', 'accelerated-mobile-pages' ),
                'value' => 4,
                'alt' => __('Swift', 'accelerated-mobile-pages' ),
                'img' => AMPFORWP_PLUGIN_DIR_URI.'/images/swift.png',
            ),
        );
    if(count(get_plugins())>0){
        foreach (get_plugins() as $key => $value) {
            $plugin = get_plugin_data(WP_PLUGIN_DIR.'/'.$key);
            if(!empty($plugin['AMP'])){//$plugin['AMP']
				$imageUrl = '';
				if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR.$value['TextDomain'].'/screenshot.png')){
					$imageUrl = plugins_url($value['TextDomain'].'/screenshot.png');
				}
                $themeDesign[] = array(
                                    'demo_link' => $plugin['AMP Demo'],
									'upgrade'=>true,
									'title'=>$plugin['AMP'],
									'value'=>$value['TextDomain'],
									'alt'=>$plugin['AMP'],
									'img'=>$imageUrl,
								);
            }
        }
    }
    // Themes Section
 Redux::setSection( $opt_name, array(
                'title'      => __( 'Themes', 'accelerated-mobile-pages' ),                'class' => 'ampforwp-new-element',

        'id'         => 'amp-theme-settings',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'amp-design-selector',
                'class' => 'amp-design-selector',
                'type'     => 'demolink_image_select',
                'title'    => __( 'Themes Selector', 'accelerated-mobile-pages' ),
                'subtitle' => __( 'Select your design from dropdown or <br /><a href="https://ampforwp.com/themes/" style="position: relative;
    top: 20px;text-decoration: none;
    background: #eee;padding: 5px 8px 5px 9px;
    border-radius: 30px;" target="_blank">View More AMP Themes →</a>', 'accelerated-mobile-pages' ),
                'options'  => $themeDesign,
                'default'  => '4'
                ),
            array(
                'id'       => 'ampforwp_layouts_core',
                'type'     => 'raw',
                'subtitle'     => '<a class="amp-layouts-desc" href="https://ampforwp.com/amp-layouts/" target="_blank">What is Layouts?</a>',
                'title'    => __('AMP Layouts', 'accelerated-mobile-pages'),
                'full_width'=>true, 
                'class'     =>(!is_plugin_active('amp-layouts/amp-layouts.php')? '': 'hide'),//,
                'markdown'=> true,
                'desc'      => '<div class="amp-layout-class">
                                <div class="amp_layouts_container">
                                    '.$upcomingLayoutsDesign.'
                                </div>
                            </div>',
                
                
            ),
            array(
                'id'   => 'info_theme_framework',
                'type' => 'info',
                'style' => 'success',
                'desc' => $amptfad
            ),

            
            )
        ) );
/*---------------------*/

    // Global Theme Settings
  Redux::setSection($opt_name, array(
        'title'      => __( 'Global', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-global-subsection',
        'subsection' => true,
        'fields'     => array(
           array(
                       'id' => 'colorscheme-section',
                       'type' => 'section',
                       'title' => __('Color Scheme', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            // Swift
            array(
                    'id'        => 'swift-color-scheme',
                    'title'     => __('Global Color Scheme', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => __('Choose the color for title, anchor link','accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                    'color'      => '#005be2',
                     ),
                    'required' => array(
                        array('amp-design-selector', '=' , '4')
                     )
            ),
             array(
                    'id'        => 'amp-opt-color-rgba-colorscheme',
                    'type'      => 'color_rgba',
                    'title'     => __('Color Scheme','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#F42F42',
                    ),
                    'required' => array(
                        array('amp-design-selector', '=' , '3')
                     )
              ),
             array(
                    'id'        => 'amp-opt-color-rgba-font',
                    'type'      => 'color_rgba',
                    'title'     => __('Color Scheme Font Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#fff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                    )
              ), 
              // Design 3  
             array(
                    'id'        => 'amp-opt-color-rgba-link',
                    'type'      => 'color_rgba',
                    'title'     => __('Anchor Link Color','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#f42f42',
                    ),
                    'required' => array(
                        array('amp-design-selector', '=' , '3')
                    )
              ), 
             // Design 2
             array(
                    'id'        => 'amp-opt-color-rgba-link-design2',
                    'type'      => 'color_rgba',
                    'title'     => __('Anchor Link Color','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#0a89c0',
                    ),
                    'required' => array(
                        array('amp-design-selector', '=' , '2')
                    )
              ),
              // Design 1 
             array(
                    'id'        => 'amp-opt-color-rgba-link-design1',
                    'type'      => 'color_rgba',
                    'title'     => __('Anchor Link Color','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#0a89c0',
                    ),
                    'required' => array(
                        array('amp-design-selector', '=' , '1')
                    )
              ), 
             array(
                    'id'        => 'amp-opt-color-rgba-colorscheme-call',
                    'type'      => 'color_rgba',
                    'title'     => __('Call Button Color','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#0a89c0',
                    ),
                    'required' => array(
                        array('ampforwp-callnow-button', '=' , '1')
                    )
             ),
            
   array(
               'id' => 'typography-section',
               'type' => 'section',
               'title' => __('Typography', 'accelerated-mobile-pages'),
               'indent' => true,
                'required' => array(
                    array('amp-design-selector', '=' , '4')
                ),
                'layout_type' => 'accordion',
                'accordion-open'=> 1,
    ),
          array(
                'id'        =>'google_font_api_key',
                'type'      =>'text',
                'title'     =>__('Google Font API key','accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('You can get the Link <a target="_blank" href="https://developers.google.com/fonts/docs/developer_api?refresh=1&pli=1#APIKey">form here</a>','accelerated-mobile-pages'),
                'default'   =>'',
                'required' => array(
                    array('amp-design-selector', '=' , '4')
                )

            ),

            array(
                'id'       => 'amp_font_selector',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-families',
                'title'    => __( 'Global Font Family ', 'accelerated-mobile-pages' ),
                'tooltip-subtitle' => __( 'Select your design from dropdown or ', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'None',
                ),
                'default'  => '',
                'required' => array(
                    array('amp-design-selector', '=' , '4')
                )

            ),

            array(
                'id'       => 'amp_font_type',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-family-weights',
                'multi'    => true,
                'title'    => __( 'Global Font Weight Selector', 'accelerated-mobile-pages' ),
                'tooltip-subtitle' => __( 'Select your design from dropdown', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'none',
                ),
                'default'  => '',
                'required' => array(
                    array('amp-design-selector', '=' , '4')
                )

            ),
          array(
                'id'        =>'google_current_font_data',
                'type'      =>'text',
                'class'     => 'hide',
                'title'     =>__('Google Font Current Font','accelerated-mobile-pages'),
                'default'   =>'',
                'required' => array(
                    array('amp-design-selector', '=' , '4')
                )
            ),








           array(
                    'id'       => 'content-font-family-enable',
                    'type'     => 'switch',
                    'class'    => 'ampforwp-google-font-class',
                    'title'    => __('Content Font Selector', 'accelerated-mobile-pages'),
                    'required' => array(
                                    array('amp-design-selector', '=' , '4')
                                    ),
                    'default'  => '0' ,
                    'required' => array(
                        array('amp-design-selector', '=' , '4')
                    )   
            ),
          array(
                'id'       => 'amp_font_selector_content_single',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-families',
                'title'    => __( 'Content Font Family Selector', 'accelerated-mobile-pages' ),
                'tooltip-subtitle' => __( 'Select your design from dropdown or ', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'None',
                ),
                'default'  => '',
                'required' => array(
                    array('amp-design-selector', '=' , '4'),
                    array('content-font-family-enable', '=' , '1'),
                )

            ),

            array(
                'id'       => 'amp_font_type_content_single',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-family-weights',
                'multi'    => true,
                'title'    => __( 'Content Font Family Weight Selector', 'accelerated-mobile-pages' ),
                'tooltip-subtitle' => __( 'Select your design from dropdown', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'none',
                ),
                'default'  => '',
                'required' => array(
                    array('amp-design-selector', '=' , '4'),
                    array('content-font-family-enable', '=' , '1')
                )

            ),
          array(
                'id'        =>'google_current_font_data_content_single',
                'type'      =>'text',
                'class'     => 'hide',
                'title'     =>__('Google Font Current Font','accelerated-mobile-pages'),
                'default'   =>'',
                'required' => array(
                    array('amp-design-selector', '=' , '4')
                )
            ),

          array(
                   'id' => 'general_sdbar',
                   'type' => 'section',
                   'title' => __('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
          array(
                    'id'    => 'gnrl-sidebar',
                    'type'  => 'switch',
                    'title' => __('Sidebar', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
          array(
                    'id'    => 'gbl-sidebar',
                    'class' => 'child_opt child_opt_arrow',
                    'type'  => 'switch',
                    'title' => __('Homepage Sidebar', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array( array('gnrl-sidebar', '=' , '1') ),
            ),
            array(
                    'id'        => 'sidebar-bgcolor',
                    'class' => 'child_opt child_opt_arrow',
                    'type'      => 'color_rgba',
                    'title'     => __('Sidebar Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#f7f7f7',
                    ),
                    'required' => array( array('gbl-sidebar', '=',1) )
            ),
            array(
                    'id'       => 'sbr-heading-color',
                    'type'     => 'color_rgba',
                    'class' => 'child_opt',
                    'title'    => __('Heading', 'accelerated-mobile-pages'),
                    'default'  => array(
                        'color'     => '#333',
                    ),
                    'required' => array(
                      array('gbl-sidebar','=',1)
                    )           
            ),
            array(
                    'id'       => 'sbr-text-color',
                    'type'     => 'color_rgba',
                    'class' => 'child_opt',
                    'title'    => __('Text', 'accelerated-mobile-pages'),
                    'default'  => array(
                        'color'     => '#333',
                    ),
                    'required' => array(
                      array('gbl-sidebar','=',1)
                    )           
            ),
            array(
                    'id'    => 'swift-sidebar',
                    'class' => 'child_opt child_opt_arrow',
                    'type'  => 'switch',
                    'title' => __('Single Sidebar', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'required' => array( array('single-design-type', '=' , '4'), 
                                            array('gnrl-sidebar', '=' , '1'), 
                                ),
            ),
            
           array(
                       'id' => 'design-advanced',
                       'type' => 'section',
                       'title' => __('Advanced', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
             array(
                    'id'       => 'css_editor',
                    'type'     => 'ace_editor',
                    'title'    => __('Custom CSS', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => __('You can customize the Stylesheet of the AMP version by using this option.', 'accelerated-mobile-pages'),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'desc'     => '',
                    'default'  => __('/******* Paste your Custom CSS in this Editor *******/','accelerated-mobile-pages')
            ),

        )
    ));

    // Header Elements default Color
    function ampforwp_get_element_default_color() {
        $default_value = get_option('redux_builder_amp', true);
        $default_value = $default_value['amp-opt-color-rgba-colorscheme']['color'];
        if ( empty( $default_value ) ) {
          $default_value = '#333';
        }
      return $default_value;
    }

  // Header Section
  Redux::setSection( $opt_name, array(
                'title'      => __( 'Header', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-header-settings',
        'subsection' => true,
        'tab'       => true,
        'fields'     => array(
            // Swift
            // Tab 1
           array(
                       'id' => 'header_section_1',
                       'type' => 'section',
                       'title' => __('Header Design', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            array(
                    'id'    => 'header-type',
                   'title'  => __('Header Type', 'accelerated-mobile-pages'),
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Header 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/head-1.png'
                                ),
                        '2' => array(
                                'alt'=>' Header 2 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/head-2.png'
                                ),
                        '3' => array(
                                'alt'=>' Header 3 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/head-3.png',
                                ),
                    ),
                   'default'=> '1',
//                   'max-width' => 200,
//                   'max-height'=> 60,
                   'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
           array(
                       'id' => 'header_section_2',
                       'type' => 'section',
                       'title' => __('Navigation Menu Design', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            array(
                    'id'    => 'menu-type',
                   'title'  => __('Menu Type', 'accelerated-mobile-pages'),
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Menu overlay 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/menu-1.png'
                                ),
                    ),
                   'default'=> '1',
//                   'max-width' => 200,
 //                   'max-height'=> 60,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
             ),
            array(
                    'id'       => 'menu-search',
                    'type'     => 'switch',
                    'title'    => __('Menu Search', 'accelerated-mobile-pages'),
                    'required' => array(
                    array('amp-design-selector', '=' , '4')
                    ),
                    'default'  => '1'         
            ),
            array(
                'id'       => 'amp-swift-menu-cprt',
                'type'     => 'switch',
                'title'    => __( 'Menu Copyright', 'accelerated-mobile-pages' ),
                'required' => array(
                    array('amp-design-selector', '=' , '4')
                ),
                'default'  => '1'
            ),
            array(
                    'id'       => 'primary-menu',
                    'type'     => 'switch',
                    'title'    => __('Alternative Menu', 'accelerated-mobile-pages'),
                    'true'      => 'true',
                    'false'     => 'false',
                    'default'   => '1',
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'             => 'primary-menu-padding-control',
                    'type'           => 'spacing',
                    'output'         => array('.p-menu'),
                    'class' => 'child_opt child_opt_arrow',
                    'mode'           => 'padding',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => __('Alt Menu Padding', 'accelerated-mobile-pages'),
                    'default'            => array(
                        'padding-top'     => '12px', 
                        'padding-right'   => '25px', 
                        'padding-bottom'  => '12px', 
                        'padding-left'    => '25px',
                        'units'          => 'px', 
                    ),
                    'required' => array(
                      array('primary-menu','=',1)
                    )       
            ),
            array(
                'class' => 'child_opt',
                'id'        => 'primary-menu-text-scheme',
                'title'     => __('Alt Menu Text', 'accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'rgba'  => 'rgb(53, 53, 53)',
                    ),
                    'required' => array(
                      array('primary-menu','=',1)
                    )  
              ),
            array(
                'class' => 'child_opt',
                'id'        => 'primary-menu-background-scheme',
                'title'     => __('Alt Menu Background', 'accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'rgba'  => 'rgb(239, 239, 239)',
                    ),
                    'required' => array(
                      array('primary-menu','=',1)
                    )  
              ),
            array(
                'id'       => 'drp-dwn',
                'type'     => 'switch',
                'class' => 'child_opt child_opt_arrow',
                'title'    => __('Dropdown Support', 'accelerated-mobile-pages'),
                'true'      => 'true',
                'false'     => 'false',
                'default'   => 0,
                'required' => array( array('primary-menu','=',1) ),
            ),
            array(
                'id'        => 'signin-button',
                'title'     => __('Button Customize', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('You can do the customization here ','accelerated-mobile-pages'),
                'type'      => 'switch',
                'default'   => '0',
                    'required' => array(
                      array('header-type','=',2)
                    )  
              ),
            array(
                'id'        => 'signin-button-text',
                'title'     => __('Button Text', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('You can write your required text ','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => 'Sign up free',
                    'required' => array(
                      array('signin-button','=',1)
                    )  
              ),
            array(
                'id'        => 'signin-button-link',
                'title'     => __('Button Link', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('You can add the Link here ','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => '#',
                    'required' => array(
                      array('signin-button','=',1)
                    )  
              ),
            array(
                'id'        => 'signin-button-style',
                'title'     => __('Button Styles', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('You can change the button here','accelerated-mobile-pages'),
                'type'      => 'switch',
                'default'   => '0',
                    'required' => array(
                      array('signin-button','=',1)
                    )  
              ),
            array(
                'id'        => 'signin-button-border-line',
                'title'     => __('Button Border Line', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('You can change the button border line','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => '2',
                    'required' => array(
                      array('signin-button-style','=',1)
                    )  
              ),
            array(
                'id'        => 'signin-button-text-color',
                'title'     => __('Button Text Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('Choose the color for Button Texxt','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'rgba'  => 'rgb(0, 0, 0)',
                    ),
                'required' => array(
                  array('signin-button-style','=',1)
                )  
            ),
            array(
                'id'        => 'signin-button-border-color',
                'title'     => __('Button Border Line Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('Choose the color for Button Border Line','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'rgba'  => 'rgb(0, 0, 0)',
                    ),
                'required' => array(
                  array('signin-button-style','=',1)
                )  
            ),
            array(
                    'id'    => 'border-type',
                   'title'  => __('Border Type', 'accelerated-mobile-pages'),
                   'type'   => 'select',
                   'options'=> array(
                        '1' =>  'Square',
                        '2' =>  'Round',
                        '3' => 'Custom'
                    ),
                   'default'=> '1',
                   'required' => array( array('signin-button', '=' ,1) ),
            ),
            array(
                'id'        => 'border-radius',
                'title'     => __('Customize Border Radius', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('You can change the border radius','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => '10',
                    'required' => array(
                      array('border-type','=',3)
                    )  
              ),
             array(
                    'id'       => 'ampforwp-amp-menu',
                    'type'     => 'switch',
                    'title'    => __('Navigation Menu', 'accelerated-mobile-pages'),
                    'desc'       => __( 'Add Menus to your AMP pages by clicking on this <a href="'.trailingslashit(get_admin_url()).'nav-menus.php?action=locations">link</a>' , 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => __('Enable/Disable Menu from header', 'accelerated-mobile-pages'),
                    'true'      => 'true',
                    'false'     => 'false',
                    'default'   => 1,
                    'required' => array(array('amp-design-selector', '!=' , '4')),

            ),
           array(
                       'id' => 'header_section_3',
                       'type' => 'section',
                       'title' => __('Header Settings', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            // Call Now button
             array(
                    'id'       => 'ampforwp-callnow-button',
                    'type'     => 'switch',
                    'title'    => __('Call Now Button', 'accelerated-mobile-pages'),
                    'true'      => 'true',
                    'false'     => 'false',
                    'required' => array(
                        array('amp-design-selector', '!=' , '1')
                    ),
                    'default'   => 0
             ),
             array(
                    'id'        =>'enable-amp-call-numberfield',
                 'class' => 'child_opt child_opt_arrow',
                    'type'      => 'text',
                    'required'  => array(
                        array('ampforwp-callnow-button', '=' , '1'),
                        array('amp-design-selector', '!=' , '1')
                    ),
                    'title'     => __('Enter Phone Number', 'accelerated-mobile-pages'),
                    'default'   => '',
             ),
             array(
                    'id'        =>'amp-on-off-support-for-non-amp-home-page',
                    'type'      => 'switch',
                    'title'     => __('Non-AMP link in Header', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => __('If you want users in header to go to non-AMP website from the Header', 'accelerated-mobile-pages'),
                    'default'   => 0,
            ),
             array(
                    'id'        => 'amp-opt-sticky-head',
                    'type'      => 'switch',
                    'title'     => __('Make Header UnSticky','accelerated-mobile-pages'), 
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                    ),
                    'tooltip-subtitle'     => __('Turning it ON will remove the sticky head from the design.', 'accelerated-mobile-pages' ),
                    'default'  => '0'
            ),
             array(
                    'id'       => 'amp-design-3-search-feature',
                    'type'     => 'switch',
                    'title'    => __( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '3')
                    ),
                    'default'  => '0'
            ),
             
             array(
                    'id'       => 'amp-design-2-search-feature',
                    'type'     => 'switch',
                    'title'    => __( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '2')
                    ),
                    'default'  => '0'
            ),

             array(
                    'id'       => 'amp-design-1-search-feature',
                    'type'     => 'switch',
                    'title'    => __( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '1')
                    ),
                    'default'  => '0'
            ),
            array(
                    'id'       => 'amp-swift-search-feature',
                    'type'     => 'switch',
                    'title'    => __( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '4')
                    ),
                    'default'  => '1'
            ),
            array(
                'id'        => 'amp-sticky-header', 
                "type"      =>"switch",
                'title'     =>"Sticky Header ",
                'default'   => 0,
                'required'  => array(
                    array('amp-design-selector', '=' , '4')
                )
            ),
             array(
                    'id'        => 'amp-opt-color-rgba-headercolor',
                    'type'      => 'color_rgba',
                    'title'     => __('Header Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#FFFFFF',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                    )
            ),
              array(
                    'id'        => 'amp-opt-color-rgba-headerelements',
                    'type'      => 'color_rgba',
                    'title'     => __('Header Elements','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => ampforwp_get_element_default_color(),
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                    )
            ),
             // Tab 1 end    
             /* array(
                   'id' => 'header-tab-1-end',
                   'type' => 'section',
                   'title' => __('Tab 1', 'accelerated-mobile-pages'),
                   'end'  => true,
                   /*'required' => array(
                            array('amp-design-selector', '=' , '4')
                    ),
               ),*/
            // Tab 2
            array(
                   'id' => 'header-tab-2',
                   'type' => 'section',
                   'title' => __('Advanced Header Options', 'accelerated-mobile-pages'),
                   'indent' => true,
                   //'start'  => true,
                   //'label' => 'Tab 2',
                   'required' => array(
                            array('amp-design-selector', '=' , '4')
                    ),
                   'layout_type' => 'accordion',
                    'accordion-open'=> 0,
             ),
            array(
                    'id'    => 'customize-options',
                    'type'  => 'switch',
                    'title' => __('Advanced Header Design', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'       => 'swift-width-control',
                    'class' => 'child_opt',
                    'type'     => 'text',
                    'title'    => __('Header Width', 'accelerated-mobile-pages'),
                    'default'  => '1100px',
                    'required' => array(
                      array('customize-options','=',1)
                    )           
            ),
            array(
                    'class' => 'child_opt',
                    'id'       => 'swift-height-control',
                    'type'     => 'text',
                    'title'    => __('Header Height', 'accelerated-mobile-pages'),
                    'default'  => '60px',
                    'required' => array(
                      array('customize-options','=',1)
                    )           
            ),
            array(
                    'class' => 'child_opt',
                    'id'    => 'margin-padding-options',
                    'type'  => 'switch',
                    'title' => __('Margin / Padding ', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array(
                      array('customize-options','=',1)
                    ) 
            ),
            array(
                    'class' => 'child_opt',
                    'id'             => 'swift-padding-control',
                    'type'           => 'spacing',
                    'output'         => array('.header'),
                    'mode'           => 'padding',
                    'units'          => array('px','%'),
                    'units_extended' => 'false',
                    'title'          => __('Padding', 'accelerated-mobile-pages'),
                    'default'            => array(
                        'padding-top'     => '0px', 
                        'padding-right'   => '0px', 
                        'padding-bottom'  => '0px', 
                        'padding-left'    => '0px',
                        'units'          => 'px', 
                    ),
                    'required' => array(
                      array('margin-padding-options','=',1)
                    )       
            ),
            array(
                    'class' => 'child_opt',
                    'id'             => 'swift-margin-control',
                    'type'           => 'spacing',
                    'output'         => array('.header'),
                    'mode'           => 'margin',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => __('Margin', 'accelerated-mobile-pages'),
                    'default'            => array(
                        'margin-top'     => '0px', 
                        'margin-right'   => '0px', 
                        'margin-bottom'  => '0px', 
                        'margin-left'    => '0px',
                        'units'          => 'px', 
                    ),
                    'required' => array(
                      array('margin-padding-options','=',1)
                    )       
            ),
             array(
                    'class' => 'child_opt',
                    'id'    => 'border-line',
                    'type'  => 'switch',
                    'title' => __('Border and Boxshadow', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array(
                      array('customize-options','=',1)
                    ) 
            ),

            array(
                    'class' => 'child_opt',
                  'id'       => 'swift-border-line-control',
                  'type'     => 'text',
                  'title'    => __('Border', 'accelerated-mobile-pages'), 
                  'tooltip-subtitle'     => __('Border at the bottom', 'accelerated-mobile-pages'),
                  'default'  => '1',
                  'required' => array(
                        array('border-line','=',1)
                      )  
              ),
            array(
                    'class' => 'child_opt',
                  'id'       => 'swift-border-color-control',
                  'type'     => 'color_rgba',
                  'title'    => __('Border Color', 'accelerated-mobile-pages'), 
                  'default'  => array(
                        'rgba'     => 'rgba(0,0,0,0.12)', 
                    ),
                  'required' => array(
                        array('border-line','=',1)
                      )  
              ),
            array(
                    'class' => 'child_opt',
                  'id'       => 'swift-boxshadow-checkbox-control',
                  'type'     => 'switch',
                  'title'    => __('Box Shadow', 'accelerated-mobile-pages'), 
                  'default'  => 0,
                  'required' => array(
                        array('border-line','=',1)
                      )  
              ),


            array(
                    'class' => 'child_opt',
                'id'        => 'swift-background-scheme',
                'title'     => __('Header Background', 'accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'rgba'  => 'rgba(255, 255, 255, 255)',
                    ),
                    'required' => array(
                      array('customize-options','=',1)
                    )  
              ),
              array(
                    'class' => 'child_opt',
                    'id'        => 'swift-header-overlay',
                    'title'     => __('Menu Background', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'rgba'  => 'rgba(20, 20, 22, 0.9)',
                         ),
                    'required' => array(
                        array('customize-options','=',1)
                      )
              ),
              array(
                    'class' => 'child_opt',
                    'id'        => 'swift-element-color-control',
                    'title'     => __('Header Elements', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => __('Color of the Text and Icons on top of Header','accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#333',
                     ),
                    'required' => array(
                        array('customize-options','=',1)
                      )
              ),
              array(
                    'class' => 'child_opt',
                    'id'        => 'swift-element-overlay-color-control',
                    'title'     => __('Menu Color', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'rgba'  => 'rgba(255, 255, 255, 0.8)',
                     ),
                    'required' => array(
                        array('customize-options','=',1)
                      )
              ),
              array(
                    'class' => 'child_opt',
                    'id'        => 'swift-element-menu-border-color',
                    'title'     => __('Menu Border Color ', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'rgba'  => 'rgb(47, 47, 47, 1)',
                     ),
                    'required' => array(
                        array('customize-options','=',1)
                      )
              ),

              
            array(
                    'class' => 'child_opt',
                    'id'    => 'header-position-type',
                   'title'  => __('Menu Overlay Position', 'accelerated-mobile-pages'),
                   'type'   => 'select',
                   'options'=> array(
                        '1' =>  'Left',
                        '2' =>  'Right'
                    ),
                   'default'=> '1',
                  'required' => array(
                      array('customize-options','=',1)
                    )    
            ),
            array(
                    'class' => 'child_opt',
                    'id'       => 'header-overlay-width',
                    'type'     => 'text',
                    'title'    => __('Menu Overlay Width', 'accelerated-mobile-pages'),
                    'default'  => '90%',
                    'required' => array(
                      array('customize-options','=',1)
                    )           
            ),
            
            // Tab 2 end
            /*array(
                   'id' => 'header-tab-2-end',
                   'type' => 'section',
                   'title' => __('Tab 2', 'accelerated-mobile-pages'),
                   'end'  => true,
                   'required' => array(
                            array('amp-design-selector', '=' , '4')
                    ),
             ),*/

          )
        )
      );


  //code for fetching ctegories to show as a list in redux settings
    if(get_categories()){
       $categories = get_categories( array(
                                          'orderby' => 'name',
                                          'order'   => 'ASC'
                                          ) );
      $categories_array = '';
      $categories_array = array();
       if ( $categories ) :
            foreach ($categories as $cat ) {
                    $cat_id = $cat->cat_ID;
                    $key = "".$cat_id;
                    //building assosiative array of ID-cat_name
                    $categories_array[ $key ] = $cat->name;
            }
        endif;
    }
    //End of code for fetching ctegories to show as a list in redux settings
    $ampforwp_home_loop = array();
    $ampforwp_home_loop = get_option('ampforwp_custom_post_types');
    $ampforwp_home_loop['post'] = 'Posts';
    unset($ampforwp_home_loop['page']);

 // HomePage Section
  Redux::setSection( $opt_name, array(
                'title'      => __( 'HomePage', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-homepage-settings',
        'subsection' => true,
        'fields'     => array(
                array(
                       'id' => 'ampforwp-homepage-section-general',
                       'type' => 'section',
                       'title' => __('General', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
                array(
                        'id'       => 'amp-design-3-featured-slider',
                        'type'     => 'switch',
                        'title'    => __( 'Featured Slider', 'accelerated-mobile-pages' ),
                        'required' => array(
                           array('amp-design-selector', '=' , '3')
                        ),
                        'default'  => '1'
                ),
                 array(
                        'id'       => 'amp-design-3-category-selector',
                        'type'     => 'select',
                        'class'    => 'child_opt',
                        'title'    => __( 'Featured Slider Category', 'accelerated-mobile-pages' ),
                        'options'  => $categories_array,
                        'required' => array(
                          array('amp-design-selector', '=' , '3'),
                          array('amp-design-3-featured-slider', '=' , '1')
                        ),
                ),
                 array(
                        'id'        =>'ampforwp-featur-slider-num-posts',
                        'type'      =>'text',
                        'class'    => 'child_opt',
                        'title'     =>__('Number of Posts','accelerated-mobile-pages'),
                        'required' => array(
                                        array('amp-design-3-featured-slider', '=' , '1'),
                                    ),
                        'validate'  =>'numeric',
                        'default'   =>'4',
                ),
                 array(
                        'id'        => 'ampforwp-featur-slider-autop',
                        'type'      => 'switch',
                        'class'    => 'child_opt',
                        'title'     => __('Autoplay', 'accelerated-mobile-pages'),
                        'default'   => '1',
                        'required' => array(
                         array('amp-design-3-featured-slider', '=' , '1'),
                     )
                ),
                 array(
                        'id'        =>'ampforwp-featur-slider-autop-delay',
                        'type'      =>'text',
                        'class'    => 'child_opt',
                        'title'     =>__('Delay in Autoplay','accelerated-mobile-pages'),
                        'required' => array(
                                        array('ampforwp-featur-slider-autop', '=' , '1'),
                                    ),
                        'validate'  =>'numeric',
                        'default'   =>'4000',
                ),
            // Excerpt Length for design1 #1013
                array(

                        'id'        => 'excerpt-option',
                        'type'      => 'switch',
                        'title'     => __('Excerpt', 'accelerated-mobile-pages'),
                        'default'   => '1',
                ),
                array(
                        'id'        =>'amp-design-1-excerpt',
                        'type'      =>'text',
                        'tooltip-subtitle'  =>__('Enter the number of words Eg: 10','accelerated-mobile-pages'),
                        'title'     =>__('Excerpt Length','accelerated-mobile-pages'),
                        'required' => array(
                         array('amp-design-selector', '=' , '1'),
                         array('excerpt-option', '=' , '1'),
                             ),
                        'validate'  =>'numeric',
                        'default'   =>'20',
                ),
                array(
                        'id'        => 'ampforwp-design1-cats-home',
                        'type'      => 'switch',
                        'title'     => __('Category label', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '1'),
                     )
                ),

            // Excerpt Length for design2 #1122
                array(
                        'id'        =>'amp-design-2-excerpt',
                        'type'      =>'text',
                        'tooltip-subtitle'  =>__('Enter the number of words Eg: 10','accelerated-mobile-pages'),
                        'title'     =>__('Excerpt Length','accelerated-mobile-pages'),
                        'required' => array(
                         array('amp-design-selector', '=' , '2')),
                        'validate'  =>'numeric',
                        'default'   =>'20',
                ),
                array(

                        'id'        => 'excerpt-option-design-2',
                        'type'      => 'switch',
                        'title'     => __('Excerpt on Small Screens', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '2'),
                         array('excerpt-option', '=' , '1'),
                     )                        
                ),

            // Excerpt Length for design3 #1122
                 array(
                        'id'        =>'amp-design-3-excerpt',
                        'type'      =>'text',
                        'tooltip-subtitle'  =>__('Enter the number of words Eg: 10','accelerated-mobile-pages'),
                        'title'     =>__('Excerpt Length','accelerated-mobile-pages'),
                        'required' => array(
                         array('amp-design-selector', '=' , '3'),
                         array('excerpt-option', '=' , '1') ),
                        'validate'  =>'numeric',
                        'default'   =>'15',
                ),
                array(
                        'id'        => 'excerpt-option-design-3',
                        'type'      => 'switch',
                        'title'     => __('Excerpt on Small Screens', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '3'),
                         array('excerpt-option', '=' , '1'),
                     )                         
                ),
 
             // Featured Time
                array(
                        'id'        =>'amp-design-1-featured-time',
                        'type'      =>'switch',
                        'title'     =>__('Published Time','accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Display published time of the post on homepage', 'accelerated-mobile-pages'),
                        'required' => array(array('amp-design-selector', '=' , '1') ), 
                        'default'   =>'1',
                ),

                array(
                        'id'        =>'amp-design-3-featured-time',
                        'type'      =>'switch',
                        'title'     =>__('Published Time','accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Display published time of the post on homepage', 'accelerated-mobile-pages'),
                        'required' => array(array('amp-design-selector', '=' , '3') ), 
                        'default'   =>'1',
                ),

            // Homepage thumbnail
                array(
                        'id'       => 'ampforwp-homepage-posts-image-modify-size',
                        'type'     => 'switch',
                        'title'    => __('Override Homepage Thumbnail Size', 'accelerated-mobile-pages'),
                        'required' => array( array( 'amp-design-selector','!=',3 ) ),
                        'default'  => 0,
                 ),
                array(
                    'class' => 'child_opt child_opt_arrow',
                        'id'       => 'ampforwp-homepage-posts-design-1-2-width',
                        'type'     => 'text',
                        'title'    => __('Image Width', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Defaults to 100', 'accelerated-mobile-pages'),
                        'default'  => 100,
                        'required' => array(
                          array('amp-design-selector','!=',3),
                          array('amp-design-selector','!=',4),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                    'class' => 'child_opt',
                        'id'       => 'ampforwp-homepage-posts-design-1-2-height',
                        'type'     => 'text',
                        'title'    => __('Image Height', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Defaults to 75', 'accelerated-mobile-pages'),
                        'default'  => 75,
                        'required' => array(
                          array('amp-design-selector','!=',3),
                          array('amp-design-selector','!=',4),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                    'class' => 'child_opt',
                        'id'       => 'ampforwp-swift-homepage-posts-width',
                        'type'     => 'text',
                        'title'    => __('Image Width', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Defaults to 346', 'accelerated-mobile-pages'),
                        'default'  => 346,
                        'required' => array(
                          array('amp-design-selector','=',4),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                    'class' => 'child_opt',
                        'id'       => 'ampforwp-swift-homepage-posts-height',
                        'type'     => 'text',
                        'title'    => __('Image Height', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Defaults to 188', 'accelerated-mobile-pages'),
                        'default'  => 188,
                        'required' => array(
                          array('amp-design-selector','=',4),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                       'id' => 'ampforwp-homepage-section-loop',
                       'type' => 'section',
                       'title' => __('Loop Display Controls', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
                array(
                        'id'       => 'ampforwp-homepage-loop-type',
                        'type'     => 'select',
                        'title'    => __( 'Post Type in Loop', 'accelerated-mobile-pages' ),
                        'options'  => $ampforwp_home_loop,
                        'default'   => 'post',
                ),
                array(
                        'id'       => 'ampforwp-homepage-loop-cats',
                        'type'     => 'select',
                        'title'    => __( 'Exclude Categories', 'accelerated-mobile-pages' ),
                        'data'  => 'categories',
                        'multi'    => true
                ),
                array(
                    'id'    => 'ampforwp-homepage-loop-readmore-link',
                    'type'  => 'switch',
                    'title' => __('Read More Link', 'accelerated-mobile-pages'),
                    'default'   => 0,
                ),


        )
    ));

$single_page_options = array(
                array(
                       'id' => 'ampforwp-single_section_1',
                       'type' => 'section',
                       'title' => __('Single Post Design', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
            // Swift
            array(
                    'id'    => 'single-design-type',
                   'title'  => __('Single Design', 'accelerated-mobile-pages'),
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Single Design 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/single-3.png'
                                ),
                        '4' => array(
                                'alt'=>' Single Design With Sidebar ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/single-2.png'
                                ),
                        
                    ),
                   'default'=> '1',
//                   'max-width' => 200,
//                   'max-height'=> 60,
                   'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            
            array(
                       'id' => 'ampforwp-single_section_2',
                       'type' => 'section',
                       'title' => __('Single Elements', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
            array(
                    'id'    => 'swift-featued-image',
                    'type'  => 'switch',
                    'title' => __('Featured Image', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'    => 'swift-date',
                    'type'  => 'switch',
                    'title' => __('Published Date', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
          // Lightbox 
           array(
              'id'       => 'ampforwp-amp-img-lightbox',
              'type'     => 'switch',
              'default'  =>  '0',
              'title'    => __('Lightbox for Images', 'accelerated-mobile-pages'),
           ),
           // Dropcap 
           array(
              'id'       => 'ampforwp-dropcap',
              'type'     => 'switch',
              'default'  =>  '0',
              'title'    => __('Dropcap', 'accelerated-mobile-pages'),
           ),    
         //Breadcrumb ON/OFF
          array(
              'id'       => 'ampforwp-bread-crumb',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => __('Breadcrumbs', 'accelerated-mobile-pages'),
           ),
          //Breadcrumb for Tags
          array(
                'class' => 'child_opt child_opt_arrow', 
                'id'       => 'ampforwp-bread-crumb-type',
                'type'     => 'select',
                'tooltip-subtitle'     => __('Select option to enable breadcrumb with tags or category','accelerated-mobile-pages'),
                'title'    => __('Select Breadcrumb Type', 'accelerated-mobile-pages'),
                'options'  => array(
                    'tags' => 'Tags',
                    'category' => 'Category',
                ),
                'default'  => 'category',
                'required' => array('ampforwp-bread-crumb' , '=' , 1),
            ),
          //Categories  ON/OFF
         array(
              'id'       => 'ampforwp-cats-single',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => __('Categories', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => __('Enable or Disable Categories in Single', 'accelerated-mobile-pages'),              
             'required' => array( array('amp-design-selector', '!=' , '4') )
           ),
         //Tags  ON/OFF
         array(
              'id'       => 'ampforwp-tags-single',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => __('Tags', 'accelerated-mobile-pages'),
           ),
          //Categories and Tags Links
          array(
              'id'       => 'ampforwp-cats-tags-links-single',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => __('Categories & Tags Links', 'accelerated-mobile-pages'),
              'required'  => array('ampforwp-archive-support', '=' , '1'),
           ),
          // Social Icons ON/OFF
          array(
              'id'        => 'enable-single-social-icons',
              'type'      => 'switch',
              'title'     => __('Sticky Social Icons', 'accelerated-mobile-pages'),
              'default'   => 1,
          ),
          // Excerpt ON/OFF
          array(
              'id'        => 'enable-excerpt-single',
              'type'      => 'switch',
              'title'     => __('Excerpt', 'accelerated-mobile-pages'),
              'default'   => 0,
              'tooltip-subtitle'  => __('Excerpt will be displayed above content', 'accelerated-mobile-pages'),
          ),
          //deselectable next previous links
          array(
              'id'        => 'enable-single-next-prev',
              'type'      => 'switch',
              'title'     => __('Next-Previous Links', 'accelerated-mobile-pages'),
              'default'   => 1,
          ),
         // Author name 
         array(
             'id'       => 'amp-author-name',
             'type'     => 'switch',
             'title'    => __( 'Author Name', 'accelerated-mobile-pages' ),
             'default'  => '1',
             'required' => array('amp-design-selector' , '=' , '4')
         ),
          // Author Bio
         array(
             'id'       => 'amp-author-description',
             'type'     => 'switch',
             'title'    => __( 'Author Bio', 'accelerated-mobile-pages' ),
             'default'  => '1',
         ),
        // Pagination //#1015 
        array(
            'id'       => 'amp-pagination',
            'type'     => 'switch',
            'title'    => __( 'Post Pagination', 'accelerated-mobile-pages' ),
           'default'   => 1,
           'tooltip-subtitle'  => __('Enable the feature to add Pagination in single', 'accelerated-mobile-pages'),
        ),
        array(
            'id'       => 'ampforwp-pagination-select',
                'class' => 'child_opt child_opt_arrow',
            'type'     => 'select',
            'title'    => __('Post Pagination Type', 'accelerated-mobile-pages'),
            'options'  => array(
                '1' => 'Numbering',
                '2' => 'Next-Previous',
            ),
            'default'  => '1',
            'required' => array('amp-pagination' , '=' , '1'),
        ),
            array(
                       'id' => 'ampforwp-single_section_3',
                       'type' => 'section',
                       'title' => __('Related Post Settings', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
          // Related Post
            array(
                    'id'       => 'ampforwp-single-related-posts-switch',
                    'type'     => 'switch',
                    'title'    => __( 'Related Posts', 'accelerated-mobile-pages' ),
                   'default'   => 1,
            ),
            array(
                   'id'    => 'rp_design_type',
                   'title'  => __('Related Post Designs', 'accelerated-mobile-pages'),
                   'class' => 'child_opt child_opt_arrow',
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Single Design 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/rlp-1.png'
                                ),
                        '2' => array(
                                'alt'=>' Single Design With Sidebar ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/rlp-2.png'
                                ),
                        // '3' => array(
                        //         'alt'=>' Single Design With Sidebar ',
                        //         'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/rlp-3.png'
                        //         ),
                        
                    ),
                   'default'=> '1',
//                   'max-width' => 200,
//                   'max-height'=> 60,
                   'required' => array( array('amp-design-selector', '=' , '4'),
                                 array('ampforwp-single-related-posts-switch', '=' , '1'),
                                 array('single-design-type', '=' , '1')
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-select-type-of-related',
                    'type'     => 'select',
                'class' => 'child_opt child_opt_arrow',
                    'title'    => __('Related Post by', 'accelerated-mobile-pages'),
                    'data'     => 'page',
                'tooltip-subtitle' => __('select the type of related posts', 'accelerated-mobile-pages'),
                    'options'  => array(
                        '1' => 'Tags',
                        '2' => 'Categories',
                    ),
               'default'  => '2',
               'required' => array( 
                                array('ampforwp-single-related-posts-switch', '=' , '1'),
                              //  array('ampforwp-related-posts-yarpp-switch', '=' , '0')  
                            ),
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-image',
                    'type'     => 'switch',
                'class' => 'child_opt',
                    'title'    => __('Image', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-excerpt',
                    'type'     => 'switch',
                'class' => 'child_opt',
                    'title'    => __('Excerpt', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-link',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => __('Link to Non-AMP', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-order-of-related-posts',
                    'type'     => 'switch',
                'class' => 'child_opt',
                    'title'    => __('Sort Related Posts Randomly', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1'),
                                //    array('ampforwp-related-posts-yarpp-switch', '=' , '1') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-number-of-related-posts',
                    'type'     => 'text',
                'class' => 'child_opt',
                    'title'    => __('Number of Related Post', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '3',
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1'),
                                //    array('ampforwp-related-posts-yarpp-switch', '=' , '1') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-related-posts-days-switch',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => __('By Last X Days', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => __('Show Related Posts From Past Few Days', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1'),
                                //    array('ampforwp-related-posts-yarpp-switch', '=' , '0')  
                                ),
            ),
            array(
                    'id'       => 'ampforwp-related-posts-days-text',
                    'type'     => 'text',
                    'class' => 'child_opt',
                    'title'    => __('Number of Days', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '7',
                    'required' => array( 
                                    array('ampforwp-related-posts-days-switch', '=' , '1'),
                                //    array('ampforwp-related-posts-yarpp-switch', '=' , '0') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-inline-related-posts',
                    'type'     => 'switch',
                    'title'    => __('In-Content Related Post', 'accelerated-mobile-pages'),
                'tooltip-subtitle' => __('Insert Related Posts between the content', 'accelerated-mobile-pages'),
                'default'  => 0,
            ),
            array(
                    'id'       => 'ampforwp-inline-related-posts-type',
                    'type'     => 'select',
                    'title'    => __('In-content Related Post by', 'accelerated-mobile-pages'),
                    'class' => 'child_opt child_opt_arrow',
                    'options'  => array(
                        '1' => 'Tags',
                        '2' => 'Categories',
                    ),
               'default'  => '2',
               'required' => array( array('ampforwp-inline-related-posts', '=' , '1') ),
            ),
            array(
                    'id'       => 'ampforwp-inline-related-posts-order',
                    'type'     => 'switch',
                'class' => 'child_opt',
                    'title'    => __('Sort Related Posts Randomly', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array( array('ampforwp-inline-related-posts', '=' , '1') ),
            ),
            array(
                    'id'       => 'ampforwp-number-of-inline-related-posts',
                    'type'     => 'text',
                'class' => 'child_opt',
                    'title'    => __('Display No. of Related Posts', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                'default'  => '3',
                'required' => array( array('ampforwp-inline-related-posts', '=' , '1') ),
            ),
            array(
                    'id'       => 'ampforwp-inline-related-posts-display-type',
                    'type'     => 'select',
                    'title'    => __('Related Post Display', 'accelerated-mobile-pages'),
                    'class' => 'child_opt child_opt_arrow',
                    'options'  => array(
                        'middle' => 'After 50% of Content',
                        'paragraphs' => 'X number of paragraphs',
                    ),
               'default'  => 'middle',
               'required' => array( array('ampforwp-inline-related-posts', '=' , '1') ),
            ),
            array(
                    'id'       => 'ampforwp-related-posts-after-number-of-paragraphs',
                    'type'     => 'text',
                    'class' => 'child_opt',
                    'title'    => __('Related Post After No. of Paragraphs', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '3',
                    'required' => array( array('ampforwp-inline-related-posts', '=' , '1'),array('ampforwp-inline-related-posts-display-type', '=' , 'paragraphs') ),
            ),
            array(
                   'id' => 'single-tab-2',
                   'type' => 'section',
                   'title' => __('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 0,
             ),
         // Author Pages
         array(
             'id'       => 'ampforwp-author-page-url',
             'type'     => 'switch',
             'title'    => __( 'Link to Author Pages', 'accelerated-mobile-pages' ),
             'default'  => '0',
         ),
            array(
                'id'       => 'ampforwp-swift-recent-posts',
                'type'     => 'switch',
                'title'    => __('Recent Posts', 'accelerated-mobile-pages'),
                'tooltip-subtitle' => __('To enable & disable recent posts', 'accelerated-mobile-pages'),
                'default'  => 1,
            ),
            array(
                    'id'    => 'single-new-features',
                    'type'  => 'switch',
                    'title' => __('Advanced Single Options', 'accelerated-mobile-pages'),
                    'default'   => 0,
            ),
            array(
                    'id'       => 'breadcrumb-border',
                    'type'     => 'switch',
                    'title'    => __('Breadcrumbs Border', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( array('single-new-features', '=' , '1'),array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'       => 'ampforwp-underline-content-links',
                    'type'     => 'switch',
                    'title'    => __('Underline on Links', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( array('single-new-features', '=' , '1') ),
            ),
            // Content  h1 - h6 font sizes //#2059 
            array(
                'id'       => 'swift_cnt',
                'type'     => 'switch',
                'title'    => __( 'Heading Font Sizes', 'accelerated-mobile-pages' ),
               'default'   => 0,
               'tooltip-subtitle'  => __('Enable the Heading to add Font Sizes in single', 'accelerated-mobile-pages'),
            ),
            array(
                'id'       => 'swift_cnt_h1',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => __('H1', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h1_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => __('H1 Font Size', 'accelerated-mobile-pages'),
                'default'  => '28px',
                'required' => array('swift_cnt_h1' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h2',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => __('H2', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h2_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => __('H2 Font Size', 'accelerated-mobile-pages'),
                'default'  => '25px',
                'required' => array('swift_cnt_h2' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h3',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => __('H3', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h3_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => __('H3 Font Size', 'accelerated-mobile-pages'),
                'default'  => '22px',
                'required' => array('swift_cnt_h3' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h4',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => __('H4', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h4_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => __('H4 Font Size', 'accelerated-mobile-pages'),
                'default'  => '19px',
                'required' => array('swift_cnt_h4' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h5',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => __('H5', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h5_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => __('H5 Font Size', 'accelerated-mobile-pages'),
                'default'  => '17px',
                'required' => array('swift_cnt_h5' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h6',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => __('H6', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h6_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => __('H6 Font Size', 'accelerated-mobile-pages'),
                'default'  => '15px',
                'required' => array('swift_cnt_h6' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                       'id' => 'ampforwp-single_section_5',
                       'type' => 'section',
                       'title' => __('WordPress Content Gallery', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
            array(
                   'id'    => 'ampforwp-gallery-design-type',
                   'title'  => __('Select Gallery Designs', 'accelerated-mobile-pages'),
                   'class' => 'child_opt child_opt_arrow',
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Single Design 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/g-1.png'
                                ),
                        '2' => array(
                                'alt'=>' Single Design With Sidebar ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/g-2.png'
                                ),
                        '3' => array(
                                'alt'=>' Single Design With Sidebar ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/g-3.png'
                                ),
                        
                    ),
                   'default'=> '1',
//                   'max-width' => 200,
//                   'max-height'=> 60,
                   'required' => array( array('amp-design-selector', '=' , '4'),
                                 
                                ),
            ),
            array(
               'id' => 'single-sneakp-section', 
               'type' => 'section',
               'title' => __('Content Sneak Peek', 'accelerated-mobile-pages'),
               'indent' => true,
               'layout_type' => 'accordion',
                'accordion-open'=> 1,
             ),
            array(
                'id'       => 'content-sneak-peek',
                'type'     => 'switch',
                //'class'    => 'child_opt',
                'title'    => __('Content Sneak Peek', 'accelerated-mobile-pages'),
                'default'  => 0,
            ),
            array(
                'id'       => 'content-sneak-peek-height',
                'type'     => 'text',
                'class'    => 'child_opt',
                'title'    => __('Content Height', 'accelerated-mobile-pages'),
                'default'  => '600px',
                'required' => array('content-sneak-peek' , '=' , '1'),
            ),
            array(
                'id'       => 'content-sneak-peek-btn-text',
                'type'     => 'text',
                'class'    => 'child_opt',
                'title'    => __('Button Text', 'accelerated-mobile-pages'),
                'default'  => 'Show Full Article',
                'required' => array('content-sneak-peek' , '=' , '1'),
            ),
            array(
                'id'        => 'content-sneak-peek-txt-color',
                'title'     => __('Text Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('Choose the color for button\'s text','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'class'    => 'child_opt',
                'default'   => array(
                'color'      => '#fff',
                 ),
                'required' => array(
                    array('content-sneak-peek', '=' , '1')
                 )
            ),
            array(
                'id'        => 'content-sneak-peek-btn-color',
                'title'     => __('Button Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => __('Choose the color for button','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'class'    => 'child_opt',
                'default'   => array(
                'color'      => '#000',
                 ),
                'required' => array(
                    array('content-sneak-peek', '=' , '1')
                 )
            ),

//             array(
//                  'id' => 'ampforwp-comments-banner',
//                  'type' => 'select',
//                   'desc' =>  $comment_desc,
//                  'title' => __(' df', 'accelerated-mobile-pages'),
//                 'class'    => 'new-class',
//
//                //  'desc'       => ' <br /><a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"  target="_blank"><img class="ampforwp-post-builder-img" src="'.AMPFORWP_IMAGE_DIR . '/amp-post-builder.png" width="489" height="72" /></a>',
//              ),
//
    $fields = array(
        'id'   => 'info_normal',
        'type' => 'info',
        'class' => 'extension_banner_bg',
        'desc' => $single_extension_listing 
    )
);
/*Yarpp enable option
    if( is_plugin_active( 'yet-another-related-posts-plugin/yarpp.php' )){
        $yarpp_options = array(array(
                    'id'       => 'ampforwp-related-posts-yarpp-switch',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => __('YARPP Compatibility', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => __('Related post options can be used from the YARPP Plugin', 'accelerated-mobile-pages'),
                    'default' => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1') 
                                ),
            ));
        array_splice($single_page_options, 23, 0, $yarpp_options);
    }else{
        foreach ($single_page_options as $key => $optionArray) {
            if(isset($optionArray['id']) && $optionArray['id']=='ampforwp-number-of-related-posts'){
                $requiredValues = $optionArray['required'];
                foreach ($requiredValues as $reqkey => $reqValue) {
                    if($reqValue[0]=='ampforwp-related-posts-yarpp-switch'){
                        unset($single_page_options[$key]['required'][$reqkey]);
                    }
                }
            }elseif(isset($optionArray['id']) && $optionArray['id']=='ampforwp-single-select-type-of-related'){
                $requiredValues = $optionArray['required'];
                foreach ($requiredValues as $reqkey => $reqValue) {
                    if($reqValue[0]=='ampforwp-related-posts-yarpp-switch'){
                        unset($single_page_options[$key]['required'][$reqkey]);
                    }
                }
            }elseif(isset($optionArray['id']) && $optionArray['id']=='ampforwp-related-posts-days-switch'){
                $requiredValues = $optionArray['required'];
                foreach ($requiredValues as $reqkey => $reqValue) {
                    if($reqValue[0]=='ampforwp-related-posts-yarpp-switch'){
                        unset($single_page_options[$key]['required'][$reqkey]);
                    }
                }
            }elseif(isset($optionArray['id']) && $optionArray['id']=='ampforwp-related-posts-days-text'){
                $requiredValues = $optionArray['required'];
                foreach ($requiredValues as $reqkey => $reqValue) {
                    if($reqValue[0]=='ampforwp-related-posts-yarpp-switch'){
                        unset($single_page_options[$key]['required'][$reqkey]);
                    }
                }
            }elseif(isset($optionArray['id']) && $optionArray['id']=='ampforwp-single-order-of-related-posts'){
                $requiredValues = $optionArray['required'];
                foreach ($requiredValues as $reqkey => $reqValue) {
                    if($reqValue[0]=='ampforwp-related-posts-yarpp-switch'){
                        unset($single_page_options[$key]['required'][$reqkey]);
                    }
                }
            }
        }
    }*/
   // Single Section
  Redux::setSection( $opt_name, array(
        'title'      => __( 'Single', 'accelerated-mobile-pages' ),
//        'desc'       => __( 'Additional Options to control the look of Single  <a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"> Click here </a> ', 'accelerated-mobile-pages' ),
        'id'         => 'amp-single',
        'subsection' => true,
        'fields'     => $single_page_options
    ) );


  // Footer Section
  Redux::setSection( $opt_name, array(
                'title'      => __( 'Footer', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-footer-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                   'id' => 'footer-tab-1',
                   'type' => 'section',
                   'title' => __('Footer Design', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),
                // Swift
                  array(
                    'id'    => 'footer-type',
                   'title'  => __('Footer Type', 'accelerated-mobile-pages'),
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Footer Design 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/footer-1.png'
                                ),
                    ),
                   'default'=> '1',
//                   'max-width' => 200,
//                   'max-height'=> 60,
                   'required' => array( array('amp-design-selector', '=' , '4') ),
                ),
                    array(
                   'id' => 'footer-tab-3', 
                   'type' => 'section',
                   'title' => __('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),

                 array(
                        'id'    => 'swift-menu',
                        'type'  => 'switch',
                        'title' => __('Menu', 'accelerated-mobile-pages'),
                        'default'   => 1,
                        'required' => array( array('amp-design-selector', '=' , '4') ),
                        'tooltip-subtitle'       => __( 'Add Menus to your AMP pages by clicking on this <a href="'.trailingslashit(get_admin_url()).'nav-menus.php?action=locations">link</a>' , 'accelerated-mobile-pages'),
                ),
                array(
                        'id'       => 'amp-footer-link-non-amp-page',
                        'type'     => 'switch',
                        'title'    => __('Link to Non-AMP page in Footer', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 1
                ),

                array(
                        'id'       => 'ampforwp-footer-top',
                        'type'     => 'switch',
                        'title'    => __('Back to Top link', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 1,
                        'required'  => array(
                                        array('amp-design-selector', '!=' , '3') 
                                    )
                ),
                array(
                        'id'       => 'ampforwp-footer-top-design3',
                        'type'     => 'switch',
                        'title'    => __('Back to Top link', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => __('Enable / Disable Link to top of the page in the footer', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,
                        'required'  => array( array( 'amp-design-selector', '=' , '3' ) )
                ),

                array(
                        'id'       => 'amp-design-3-credit-link',
                        'type'     => 'switch',
                        'title'    => __( 'Credit link', 'accelerated-mobile-pages' ),
                        'required' => array(
                          array('amp-design-selector', '=' , '3')
                        ),
                        'default'  => '1'
                ),
                array(
                        'id'       => 'ampforwp-nofollow-view-nonamp',
                        'type'     => 'switch',
                        'title'    => __('Make "View Non-AMP" link nofollow', 'accelerated-mobile-pages'),
                        'default'   => 0
                ),
            array(
                   'id' => 'footer-tab-2',
                   'type' => 'section',
                   'title' => __('Advanced Footer Options', 'accelerated-mobile-pages'),
                   'indent' => true,
                   //'start'  => true,
                   //'label' => 'Tab 2',
                   'required' => array(
                            array('amp-design-selector', '=' , '4')
                    ),
                   'layout_type' => 'accordion',
                    'accordion-open'=> 0,
             ),
            array(
                    'id'    => 'footer-customize-options',
                    'type'  => 'switch',
                    'title' => __('Advanced Footer Design', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'        => 'swift-footer-txt-clr',
                    'title'     => __('Footer Text Color', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#888888',
                         ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'        => 'swift-footer-link-clr',
                    'title'     => __('Footer Link Color', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#fcc118',
                         ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'        => 'swift-footer-link-hvr',
                    'title'     => __('Footer Link Hover Color', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#888888',
                         ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'        => 'swift-footer-bg',
                    'title'     => __('Footer 1 Background', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#182733',
                         ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'        =>"ftr1-gapping",
                    'type'      =>'spacing',
                    'title'     => __('Footer 1 Gapping', 'accelerated-mobile-pages'),
                    'units'          => array('px','%'),
                    'default'   =>array(
                                        'padding-top'     => '70px', 
                                        'padding-right'   => '0px', 
                                        'padding-bottom'  => '70px', 
                                        'padding-left'    => '0px',
                                        'units'          => 'px', 
                                    ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
             ),
            array(
                    'id'       => 'swift-footer1-cntnsize',
                    'type'     => 'text',
                    'title'    => __('Footer 1 Font Size', 'accelerated-mobile-pages'),
                    'default'  => '14px',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'       => 'swift-head-size',
                    'type'     => 'text',
                    'title'    => __('Footer 1 Heading Font Size', 'accelerated-mobile-pages'),
                    'default'  => '12px',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
            ),
            array(
                    'id'       => 'swift-head-fntwgth',
                    'type'     => 'text',
                    'title'    => __('Footer 1 Heading Font Weight', 'accelerated-mobile-pages'),
                    'default'  => '500',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
            ),
            array(
                    'id'        => 'swift-footer-heading-clr',
                    'title'     => __('Footer 1 Heading Color', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#999',
                         ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'        => 'swift-footer2-bg',
                    'title'     => __('Footer 2 Background', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#2e2b2e',
                         ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'        =>"ftr2-gapping",
                    'type'      =>'spacing',
                    'title'     => __('Footer 2 Gapping', 'accelerated-mobile-pages'),
                    'units'          => array('px','%'),
                    'default'   =>array(
                                        'padding-top'     => '50px', 
                                        'padding-right'   => '0px', 
                                        'padding-bottom'  => '50px', 
                                        'padding-left'    => '0px',
                                        'units'          => 'px', 
                                    ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
             ),
            array(
                    'id'       => 'swift-footer2-fntsize',
                    'type'     => 'text',
                    'title'    => __('Footer 2 Font Size', 'accelerated-mobile-pages'),
                    'default'  => '12px',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
            ),
            array(
                    'id'        => 'swift-footer-brdrclr',
                    'title'     => __('Footer 2 Border Color', 'accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#eee',
                         ),
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'    => 'footer2-position-type',
                   'title'  => __('Footer 2 Menu Position', 'accelerated-mobile-pages'),
                   'type'   => 'select',
                   'options'=> array(
                        '1' =>  'Center',
                        '2' =>  'Inline'
                    ),
                   'default'=> '1',
                  'required' => array(
                      array('footer-customize-options','=',1)
                    )    
            ),

        )
    ));

  // Page Section
  Redux::setSection( $opt_name, array(
                'title'      => __( 'Page', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-page-settings',
        'subsection' => true,
        'fields'     => array(
/*            // Pages Separator
             array(
                       'id' => 'Page',
                       'type' => 'section',
                       'title' => __('Pages', 'accelerated-mobile-pages'),
                       'indent' => true,
                   ),*/
                array(
                   'id' => 'page-tab-1', 
                   'type' => 'section',
                   'title' => __('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),

         // Meta ON/OFF Pages
            array(
                  'id'       => 'featured_image_swift_page',
                  'type'     => 'switch',
                  'default'  =>  '0',
                  'title'    => __('Featured Image', 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => __('Enable Featured Image on Pages.'),
                  'required' => array('amp-design-selector','=','4'),
            ),
            array(
                      'id'       => 'meta_page',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => __('Meta Information', 'accelerated-mobile-pages'),
                  ),
             array(
                      'id'       => 'ampforwp_subpages_list',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => __('Subpages/ChildPages', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => __('Shows a List of Subpages'),                  
                  ),
             array(
                      'id'       => 'ampforwp-page-social',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => __('Social Icons', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => __('Enable Social Sharing on Pages'),                  
                  ),
             array(
                      'id'       => 'ampforwp-page-sticky-social',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => __('Sticky Social Icons', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => __('Enable Social Sticky Icons on Pages'),                  
                  ),
            )
    ));

    // Social Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social', 'accelerated-mobile-pages' ),
        'id'         => 'amp-social',
        'desc'      => __('All the Social sharing and the social profile related settings are here','accelerated-mobile-pages'),
        'subsection' => true,
        'fields'     => array(
        array(
           'id' => 'social-shre',
           'type' => 'section',
           'title' => __('Social Sharing', 'accelerated-mobile-pages'),
           'indent' => true,
           //'start'  => true,
           //'label' => 'Tab 2',
           'layout_type' => 'accordion',
            'accordion-open'=> 1,
         ),
        // Social Icons Position [Swift] #1722
            array(
                'id'       => 'swift-social-position',
                'type'     => 'select',
                'title'    => __( 'Position', 'accelerated-mobile-pages' ),
                'options'  => array(
                                'default' => 'Single Sidebar (left side)',
                                'above-content' => 'Above Content',
                                'below-content' => 'Below Content'
                                ),
                'default'  => 'default',
                'required' => array(array('amp-design-selector', '=', '4') )
            ), 
          // Facebook Like 
          array(
              'id'        =>  'ampforwp-facebook-like-button',
              'type'      =>  'switch',
              'title'     =>  __('Facebook Like Button', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Facebook ON/OFF
          array(
              'id'        =>  'enable-single-facebook-share',
              'type'      =>  'switch',
              //'required'  => array('enable-single-social-icons', '=' , '1'),
              'title'     =>  __('Facebook', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Facebook app ID
          array(
               'id'       => 'amp-facebook-app-id',
               'title'    => __('Facebook App ID', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('In order to use Facebook share you need to register an app ID, <a href="https://developers.facebook.com/apps" target="_blank" style="color:#93FCFF;" >You can register one here: https://developers.facebook.com/apps.', 'accelerated-mobile-pages'),
               'type'     => 'text',
               'required'  => array('enable-single-facebook-share', '=' , '1'),
               'placeholder'  => __('Enter your facebook app id','accelerated-mobile-pages'),
               'default'  => '',
               'required' => array(
                    array('amp-design-selector', '!=' , '4')
                ),
          ),
          // Twitter ON/OFF
          array(
              'id'        =>  'enable-single-twitter-share',
              'type'      =>  'switch',
              'title'     =>  __('Twitter', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          array(
              'id'        =>  'enable-single-twitter-share-handle',
              'type'      =>  'text',
              'title'     =>  __('Twitter Handle', 'accelerated-mobile-pages'),
              'required'  => array('enable-single-twitter-share', '=' , '1'),
              'placeholder'  => __('Eg: @xyx','accelerated-mobile-pages'),
              'default'   =>  '',
          ),
           array(
              'id'        =>  'enable-single-twitter-share-link',
              'type'      =>  'switch',
              'title'     =>  __('Pretty Permalinks for Twitter Share?', 'accelerated-mobile-pages'),
              'tooltip-subtitle'  => __('Enable this to have pretty links for twitter sharing'),
              'default'   =>  0,
              'required'  => array('enable-single-twitter-share', '=' , '1'),
          ),
          // GooglePlus ON/OFF
          array(
              'id'        =>  'enable-single-gplus-share',
              'type'      =>  'switch',
              'title'     =>  __('GooglePlus', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // Email ON/OFF
          array(
              'id'        =>  'enable-single-email-share',
              'type'      =>  'switch',
              'title'     =>  __('Email', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // Pinterest ON/OFF
          array(
              'id'        =>  'enable-single-pinterest-share',
              'type'      =>  'switch',
              'title'     =>  __('Pinterest', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // LinkedIn ON/OFF
          array(
              'id'        =>  'enable-single-linkedin-share',
              'type'      =>  'switch',
              'title'     =>  __('LinkedIn', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // WhatsApp
          array(
              'id'        =>  'enable-single-whatsapp-share',
              'type'      =>  'switch',
              'title'     =>  __('WhatsApp', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // LINE
          array(
              'id'        =>  'enable-single-line-share',
              'type'      =>  'switch',
              'title'     =>  __('Line', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
           // VKontakte
          array(
              'id'        =>  'enable-single-vk-share',
              'type'      =>  'switch',
              'title'     =>  __('VKontakte', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Odnoklassniki
          array(
              'id'        =>  'enable-single-odnoklassniki-share',
              'type'      =>  'switch',
              'title'     =>  __('Odnoklassniki', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Reddit
          array(
              'id'        =>  'enable-single-reddit-share',
              'type'      =>  'switch',
              'title'     =>  __('Reddit', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Tumblr
          array(
              'id'        =>  'enable-single-tumblr-share',
              'type'      =>  'switch',
              'title'     =>  __('Tumblr', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Telegram
          array(
              'id'        =>  'enable-single-telegram-share',
              'type'      =>  'switch',
              'title'     =>  __('Telegram', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Digg
          array(
              'id'        =>  'enable-single-digg-share',
              'type'      =>  'switch',
              'title'     =>  __('Digg', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // StumbleUpon
          array(
              'id'        =>  'enable-single-stumbleupon-share',
              'type'      =>  'switch',
              'title'     =>  __('StumbleUpon', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Wechat
          array(
              'id'        =>  'enable-single-wechat-share',
              'type'      =>  'switch',
              'title'     =>  __('Wechat', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Viber
          array(
              'id'        =>  'enable-single-viber-share',
              'type'      =>  'switch',
              'title'     =>  __('Viber', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
           // Hatena BookMark
           array(
              'id'        =>  'enable-single-hatena-bookmarks',
              'type'      =>  'switch',
              'title'     =>  __('Hatena Bookmarks', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
        // Pocket
           array(
              'id'        =>  'enable-single-pocket-share',
              'type'      =>  'switch',
              'title'     =>  __('Pocket', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Yummly
          array(
              'id'        =>  'enable-single-yummly-share',
              'type'      =>  'switch',
              'title'     =>  __('Yummly', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '4')
        ),
          ),
        array(
               'id' => 'social-prfl',
               'type' => 'section',
               'title' => __('Social Media Profile Links', 'accelerated-mobile-pages'),
               'indent' => true,
               //'start'  => true,
               //'label' => 'Tab 2',
               'required' => array(
                        array('amp-design-selector', '=' , '4')
                ),
               'layout_type' => 'accordion',
                'accordion-open'=> 1,
             ),
             array(
                'id'       => 'menu-social',
                'type'     => 'switch',
                'title'    => __('Menu Social Profile', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array(
                        array('amp-design-selector', '=' , '4')
                ),     
            ),
            array(
                    'id'       => 'enbl-fb',
                    'type'     => 'switch',
                    'title'    => __('Facebook', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social', '=' ,1)
                    )     
            ),
            array(
                    'id'       => 'enbl-fb-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Facebook URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-fb','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-tw',
                    'type'     => 'switch',
                    'title'    => __('Twitter', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-tw-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Twitter URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-tw','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-gol',
                    'type'     => 'switch',
                    'title'    => __('Google', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-gol-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Google URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-gol','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-lk',
                    'type'     => 'switch',
                    'title'    => __('Linkedin', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-lk-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Linkedin URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-lk','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-pt',
                    'type'     => 'switch',
                    'title'    => __('Pinterest', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-pt-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Pinterest URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-pt','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-yt',
                    'type'     => 'switch',
                    'title'    => __('Youtube', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-yt-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Youtube URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-yt','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-inst',
                    'type'     => 'switch',
                    'title'    => __('Instagram', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-inst-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Instagram URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-inst','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-vk',
                    'type'     => 'switch',
                    'title'    => __('VKontakte', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-vk-prfl-url',
                    'type'     => 'text',
                    'title'    => __('VKontakte URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-vk','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-rd',
                    'type'     => 'switch',
                    'title'    => __('Reddit', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-rd-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Reddit URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-rd','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-tbl',
                    'type'     => 'switch',
                    'title'    => __('Tumblr', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-tbl-prfl-url',
                    'type'     => 'text',
                    'title'    => __('Tumblr URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-tbl','=',1)
                    )           
            ),
          array(
       'id' => 'social-media-profiles-subsection',
       'type' => 'section',
       'title' => __('Social Media Profiles (Design #3)', 'accelerated-mobile-pages'),
       'tooltip-subtitle' => __('Please enter your personal/organizational social media profiles here', 'accelerated-mobile-pages'),
       'indent' => true,
       'required' => array(
                array('amp-design-selector', '=' , '3')
        ),
       'layout_type' => 'accordion',
        'accordion-open'=> 1,
     ),
          //#1
          array(
              'id'        =>  'enable-single-twittter-profile',
              'type'      =>  'switch',
              'title'     =>  __('Twitter ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-twittter-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Twitter URL', 'accelerated-mobile-pages'),
              'default'   =>  '#',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-twittter-profile', '=' , '1')
              ),
          ),
          //#2
          array(
              'id'        =>  'enable-single-facebook-profile',
              'type'      =>  'switch',
              'title'     =>  __('Facebook ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-facebook-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Facebook URL', 'accelerated-mobile-pages'),
              'default'   =>  '#',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-facebook-profile', '=' , '1')
              ),
          ),
          //#3
          array(
              'id'        =>  'enable-single-pintrest-profile',
              'type'      =>  'switch',
              'title'     =>  __('Pintrest ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-pintrest-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Pintrest URL', 'accelerated-mobile-pages'),
              'default'   =>  '#',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-pintrest-profile', '=' , '1')
              ),
          ),
          //#4
          array(
              'id'        =>  'enable-single-google-plus-profile',
              'type'      =>  'switch',
              'title'     =>  __('Google Plus ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-google-plus-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Google Plus URL', 'accelerated-mobile-pages'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-google-plus-profile', '=' , '1')
              ),
          ),
          //#5
          array(
              'id'        =>  'enable-single-linkdin-profile',
              'type'      =>  'switch',
              'title'     =>  __('LinkedIn', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-linkdin-profile-url',
              'type'      =>  'text',
              'title'     =>  __('LinkedIn URL', 'accelerated-mobile-pages'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-linkdin-profile', '=' , '1')
              ),
          ),
          //#6
          array(
              'id'        =>  'enable-single-youtube-profile',
              'type'      =>  'switch',
              'title'     =>  __('Youtube ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-youtube-profile-url',
              'type'      =>  'text',
              'default'   =>  '#',
              'title'     =>  __('Youtube URL', 'accelerated-mobile-pages'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-youtube-profile', '=' , '1')
              ),
          ),
          //#7
          array(
              'id'        =>  'enable-single-instagram-profile',
              'type'      =>  'switch',
              'title'     =>  __('Instagram ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-instagram-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  __('Instagram URL', 'accelerated-mobile-pages'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-instagram-profile', '=' , '1')
              ),
          ),
          //#8
          array(
              'id'        =>  'enable-single-VKontakte-profile',
              'type'      =>  'switch',
              'title'     =>  __('VKontakte ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-VKontakte-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  __('VKontakte URL', 'accelerated-mobile-pages'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-VKontakte-profile', '=' , '1')
              ),
          ),
          //#9
          //removed whatsapp
          //#10
          array(
              'id'        =>  'enable-single-reddit-profile',
              'type'      =>  'switch',
              'title'     =>  __('Reddit', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-reddit-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Reddit URL', 'accelerated-mobile-pages'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-reddit-profile', '=' , '1')
              ),
          ),
          //#11
          array(
              'id'        =>  'enable-single-snapchat-profile',
              'type'      =>  'switch',
              'title'     =>  __('Snapchat ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-snapchat-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Snapchat URL', 'accelerated-mobile-pages'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-snapchat-profile', '=' , '1')
              ),
          ),
          //#12
          array(
              'id'        =>  'enable-single-Tumblr-profile',
              'type'      =>  'switch',
              'title'     =>  __('Tumblr', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-Tumblr-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Tumblr URL', 'accelerated-mobile-pages'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-Tumblr-profile', '=' , '1')
              ),
          ),
        )
    ) );


    // Date SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Date', 'accelerated-mobile-pages' ),
       'id'         => 'ampforwp-date-section',
       'subsection' => true,
        'fields'     => array(
            // Date on Single Design 3
             array(
                'id'       => 'amp-design-3-date-feature',
                'type'     => 'switch',
                'title'    => __( 'Date in Posts', 'accelerated-mobile-pages' ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'tooltip-subtitle'     => __('Display date along with author and category in posts', 'accelerated-mobile-pages' ),
                'default'  => '0'
            ),
                array(
                   'id' => 'date-tab-1', 
                   'type' => 'section',
                   'title' => __('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),
            // Show Date As
             array(
                    'id'       => 'ampforwp-post-date-global',
                    'type'     => 'select',
                    'title'    => __( 'Show Date As', 'accelerated-mobile-pages' ),
                    'options'  => array(
                                    '1' => 'Published Date',
                                    '2' => 'Modified Date'
                                    ),
                    'default'  => '1',
            ), 
            // Date Format
             array(
                    'id'        =>'ampforwp-post-date-format',
                    'type'      =>'select',
                    'title'     =>__('Date Format','accelerated-mobile-pages'),
                    'tooltip-subtitle' => __('Select the Date Format of Posts', 'accelerated-mobile-pages'),
                    'options'   => array(
                                    '1' => 'Ago',
                                    '2' => 'Traditional view'
                                    ), 
                    'default'   =>'1',
            ),
            array(
                    'id'        =>'ampforwp-post-date-format-text',
                    'type'      =>'text',
                    'title'     =>__('Text for the Date Format','accelerated-mobile-pages'),
                    'desc'  =>__('Example: English - % days ago, Spain - ago % days','accelerated-mobile-pages'),
                    'required' => array( array('ampforwp-post-date-format', '=', '1') ),
                    'default'   =>'% days ago',
            ),
        // Post Modified Date
          array(
              'id'        => 'post-modified-date',
              'type'      => 'switch',
              'title'     => __('Modified Date Notice', 'accelerated-mobile-pages'),
              'default'   => 0,
              'tooltip-subtitle'  => __('Show Modified date of an article at the end of the post.', 'accelerated-mobile-pages'),
          ),        
        )

    ) );
   $redux_option = get_option('redux_builder_amp',true);
   if ( 4 == $redux_option['amp-design-selector'] ) {
    $post_builder = '';
   }
   else{
    $post_builder = '<br /><a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"  target="_blank"><img class="ampforwp-post-builder-img" src="'.AMPFORWP_IMAGE_DIR . '/amp-post-builder.png" width="489" height="72" /></a>';
    }
    // Misc SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Misc', 'accelerated-mobile-pages' ),
       'desc'       => $post_builder,
       'id'         => 'amp-design',
       'subsection' => true,
        'fields'     => array(
                array(
                   'id' => 'misc-tab-1', 
                   'type' => 'section',
                   'title' => __('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),

                // RTL
                array(
                        'id'        =>'amp-rtl-select-option',
                        'type'      => 'switch',
                        'title'     => __('RTL Support', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'tooltip-subtitle'  => __('Enable Right to Left language support', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                    ),
           array(
               'id'       => 'ampforwp-sub-categories-support',
               'type'     => 'switch',
               'title'    => __('Sub-Categories under Category', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => __('Display sub-categories on category pages', 'accelerated-mobile-pages'),
               'default'  => '0'
             ),
        )

    ) );
    
// Extension Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Extensions', 'accelerated-mobile-pages' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'accelerated-mobile-pages' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-go-premium',
        'subsection' => false,
        'desc' => $extension_listing,
        'icon' => 'el el-puzzle',
//        'desc' => '<a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=extension-tab_advanced-amp-ads&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-extension.png" width="345" height="500" /></a>
//
//        <a href="http://ampforwp.com/custom-post-type/#utm_source=options-panel&utm_medium=extension-tab_custom-post-type&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-custom-post-type-extension.png" width="345" height="500" /></a>
//
//        <a href="http://ampforwp.com/doubleclick-for-publishers/#utm_source=options-panel&utm_medium=extension-tab_doubleclick&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-DoubleClick-extensions.png" width="345" height="500" /></a>
//
//        <a href="http://ampforwp.com/amp-ratings/#utm_source=options-panel&utm_medium=extension-tab_amp-ratings&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-rating-extension.png" width="345" height="500" /></a>
//
//
//        <a href="http://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=extension-tab_coming-soon&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/extension-coming-soon.png" width="345" height="500" /></a>',
//        'icon' => 'el el-puzzle',
    ) );

if(!ampforwp_check_extensions()){
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Free vs Pro', 'accelerated-mobile-pages' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'accelerated-mobile-pages' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-choose',
        'subsection' => false,
       'desc' => $freepro_listing,
        'icon' => 'el el-heart',
    ) );
}


// Priority Support
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Fix AMP Errors', 'accelerated-mobile-pages' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'accelerated-mobile-pages' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-go-premium-support',
        'subsection' => false,
        'desc' => '        <a href="http://ampforwp.com/priority-support/#utm_source=options-panel&utm_medium=extension-tab_priority_support&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-support-banner" src="'.AMPFORWP_IMAGE_DIR . '/priority-support-banner.png" width="345" height="500" /></a>',
        'icon' => 'el el-hand-right',
    ) );



// Plugin Manager
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Plugins Manager', 'accelerated-mobile-pages' ),
        'id'         => 'opt-plugins-manager',
        'subsection' => false,
        'desc'  => 'You can Disable Plugins only in AMP which are causing AMP validation errors. <a href="http://ampforwp.com/plugins-manager" target="_blank">More Information.</a>',
        'icon'  => 'el el-magic',
       'fields' => array(

            array(
                'id'       => 'ampforwp-plugin-manager-core',
                'type'     => 'switch',
                 'title'    => __('Enable Plugin Manager', 'accelerated-mobile-pages'),
                'default'   => 0
            ),
           array(
//        'title'    => __('Notification text', 'accelerated-mobile-pages'),
        'id'   => 'info_normal',
        'type' => 'info',
           'required' => array('ampforwp-plugin-manager-core', '=' , '1'),
                'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/plugins-manager" target="_blank">AMP Plugin Manager</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/plugins-manager" target="_blank">Click here for more info</a>)</div></div>',               
           ),
        )        
) );

Redux::setExtensions( $opt_name, AMPFORWP_PLUGIN_DIR.'includes/options/extensions/demolink_image_select' );
/*
* <--- END SECTIONS
*/
