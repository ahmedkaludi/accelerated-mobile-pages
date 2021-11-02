<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Admin Panel Options        
if ( ! class_exists( 'ReduxCore\ReduxFramework\Redux' ) ) {
    return;
}
//Require features
require_once AMPFORWP_PLUGIN_DIR."includes/features/advertisement/ads-options.php";
require_once AMPFORWP_PLUGIN_DIR."includes/features/performance/performance-options.php";
require_once AMPFORWP_PLUGIN_DIR."includes/features/analytics/analytics-options.php";
require_once AMPFORWP_PLUGIN_DIR."includes/features/structure-data/structured-data-options.php";
require_once AMPFORWP_PLUGIN_DIR."includes/features/notice-bar/notice-bar-options.php";
require_once AMPFORWP_PLUGIN_DIR."includes/features/push-notification/push-notification-options.php";
require_once AMPFORWP_PLUGIN_DIR."includes/features/contact-form/contact-form-options.php";
require_once AMPFORWP_PLUGIN_DIR."includes/features/pagebuilders-support/pagebuilders_support.php";

// Option name where all the Redux data is stored.
$opt_name = "redux_builder_amp";
$comment_desc = "";
$newspaper_theme_check = array();
$amptfad = '<strong>DID YOU KNOW?</strong></br ><a href="https://ampforwp.com/amp-theme-framework/"  target="_blank">You can create your own <strong>Custom theme with AMP Theme Framework</strong></a>';
// #1093 Display only If AMP Comments is Not Installed
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
   if(!is_plugin_active( 'amp-comments/amp-comments.php' )){
$comment_AD_URL = "http://ampforwp.com/amp-comments/#utm_source=options-panel&utm_medium=comments-tab&utm_campaign=AMP%20Plugin";
$comment_desc = '<a href="'.$comment_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/comments-banner.png" width="560" height="85" /></a>';
}
/*$wpbakery_for_ampchecker = $divi_pb_for_ampchecker = $elemntr_pb_for_ampchecker = array();
if(!is_plugin_active( 'amp-pagebuilder-compatibility/amp-pagebuilder-compatibility.php' )){
    $wpbakery_for_ampchecker = array( 
                    'id'   => 'wpbakery_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-wpbakery-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
    $divi_pb_for_ampchecker = array( 
                    'id'   => 'divi_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-divi-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
    $elemntr_pb_for_ampchecker = array( 
                    'id'   => 'elemntr_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-elementor-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
}   
     $pb_for_amp[] =  array(
                'id' => 'ampforwp-pagebuilder-accor',
                'type' => 'section',
                'title' => esc_html__('AMPforWP PageBuilder', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
    $pb_for_amp[] = array(
               'id'       => 'ampforwp-pagebuilder',
               'type'     => 'switch',
               'title'    => esc_html__('AMPforWP PageBuilder', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the AMP PageBuilder', 'accelerated-mobile-pages'),
               'default'  => true
             );
     $pb_for_amp[] =  array(
                'id' => 'ampforwp-wpbakery-pb-for-amp-accor',
                'type' => 'section',
                'title' => esc_html__('WPBakery Page Builder Compatibility', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
     $pb_for_amp[] = array(
               'id'       => 'ampforwp-wpbakery-pb-for-amp',
               'type'     => 'switch',
               'title'    => esc_html__('WPBakery Page Builder Support','accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the WPBakery Page Builder support for AMP', 'accelerated-mobile-pages'),
               'default'  => false
            );
    $pb_for_amp[] = $wpbakery_for_ampchecker;
    $pb_for_amp[] =  array(
                'id' => 'ampforwp-divi-pb-for-amp-accor',
                'type' => 'section',
                'title' => esc_html__('Divi Builder Compatibility', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
    $pb_for_amp[] = array(
               'id'       => 'ampforwp-divi-pb-for-amp',
               'type'     => 'switch',
               'title'    => esc_html__('Divi Builder Support','accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the Divi Builder support for AMP', 'accelerated-mobile-pages'),
               'default'  => false
            );
    $pb_for_amp[] = $divi_pb_for_ampchecker;
    $pb_for_amp[] =  array(
                'id' => 'ampforwp-elementor-pb-for-amp-accor',
                'type' => 'section',
                'title' => esc_html__('Elementor Compatibility', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
    $pb_for_amp[] = array(
               'id'       => 'ampforwp-elementor-pb-for-amp',
               'type'     => 'switch',
               'title'    => esc_html__('Elementor Support','accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the Elementor support for AMP', 'accelerated-mobile-pages'),
               'default'  => false
            ); 
    $pb_for_amp[] = $elemntr_pb_for_ampchecker;*/

$all_extensions_data = $jetpack_rp = $sassy_ss = $amp_endpoint = array();
if(class_exists( 'Jetpack_RelatedPosts' )){
    $jetpack_rp =  array(
                    'id'       => 'ampforwp-jetpack-related-posts',
                    'type'     => 'switch',
                    'title'    => esc_html__('Jetpack Related Post', 'accelerated-mobile-pages'),
                    'default'  => '1',
                );
}
if(function_exists('heateor_sss_save_default_options')){
    $sassy_ss =  array(
                    'id'       => 'ampforwp-sassy_social-switch',
                    'type'     => 'switch',
                    'title'    => esc_html__('Sassy Social Share', 'accelerated-mobile-pages'),
                    'default'  => '1',
                );
}
    $get_permalink_structure = get_option('permalink_structure');
    if ($get_permalink_structure) { 
        $amp_endpoint = array(
                        'id'       => 'amp-core-end-point',
                        'type'     => 'switch',
                        'title'    => esc_html__('Change End Point to ?amp','accelerated-mobile-pages'),
                        'default' => 0,
                        'tooltip-subtitle' => esc_html__('Enable this option when /amp/ is giving 404 after resaving the permalink settings.','accelerated-mobile-pages'),
                        'desc' => esc_html__( 'Making endpoints to ?amp will help you get the amp in tricky setups with taxonomies & post typs. Question mark in the url will not make any difference in the SEO.','accelerated-mobile-pages' ),
                    );
    }
global $all_extensions_data;
$extension_listing_array = array(
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
                            'name'=>'Caldera Forms for AMP',
                            'desc'=>'Add Caldera Form in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/cf.png',
                            'price'=>'$39',
                            'url_link'=>'http://ampforwp.com/caldera-forms-for-amp',
                            'plugin_active_path'=> 'caldera-forms-for-amp/caldera-forms-for-amp.php',
                            'item_name'=>'Caldera Forms for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('caldera-forms-for-amp/caldera-forms-for-amp.php')? 1 : 2),
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
                            'name'=>'Liveblog For AMP',
                            'label' => 'Liveblog For AMP',
                            'desc'=>'Add Liveblog Support in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/amp-icon.png',
                            'price'=>'$79',
                             'url_link'=>'https://ampforwp.com/addons/liveblog-for-amp/#utm_source=options-panel&utm_medium=extension-tab_gf&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'liveblog-for-amp/liveblog-for-amp.php',
                            'item_name'=>'Liveblog For AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('liveblog-for-amp/liveblog-for-amp.php')? 1 : 2),
                            'settingUrl'=>'',
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
                            'item_name'=>'Ninja Forms for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-ninja-forms/amp-ninja-forms.php')? 1 : 2),
                            'settingUrl'=>'{ampforwp-nf-subsection}',
                        ),
                        array(
                            'name'=>'Pinterest for AMP',
                            'label' => 'Pinterest for AMP',
                            'desc'=>'Pinterest compatibility with AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/amp-icon.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/addons/pinterest-for-amp/#utm_source=options-panel&utm_medium=extension-tab_polylang-for-amp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'pinterest-for-amp/pinterest-for-amp.php',
                            'item_name'=>'Pinterest for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('pinterest-for-amp/pinterest-for-amp.php')? 1: 2),
                        ),
                        array(
                            'name'=>'Conversion Goals Tracking for AMP',
                             'class'=>'new-ext',
                            'desc'=>'Conversion & Goals Tracking in Google Analytics is made easy in AMP.',
                           'img_src'=>AMPFORWP_IMAGE_DIR . '/conversion_goal_tracking.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/conversion-goals-tracking-for-amp//#utm_source=options-panel&utm_medium=extension-tab_conversion_goals_tracking_for_amp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'conversion-goals-tracking-for-amp/conversion-goals-tracking-for-amp.php',
                            'item_name'=>'Conversion Goals Tracking for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('conversion-goals-tracking-for-amp/conversion-goals-tracking-for-amp.php')? 1 : 2),
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
                            'name'=>'AMP Popup',
                            'desc'=>'Pop-Up Functionality for AMP in WordPress. Most easiest and the best way to include Pop-Up in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/pwa-icon.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/amp-popup/',
                            'plugin_active_path'=> 'amp-popup/amp-popup.php',
                            'item_name'=>'AMP Popup',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-popup/amp-popup.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'AMP Pagebuilder Compatibility',
                            'desc'=>'Page Builder Functionality for AMP in WordPress. Most easiest and the best way to include Page Builder in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/pwa-icon.png',
                            'price'=>'$89',
                            'url_link'=>'http://ampforwp.com/page-builder-compatibility-for-amp/#utm_source=options-panel&utm_medium=extension-tab_pagebuilder-for-amp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-pagebuilder-compatibility/amp-pagebuilder-compatibility.php',
                            'item_name'=>'AMP Pagebuilder Compatibility',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-pagebuilder-compatibility/amp-pagebuilder-compatibility.php')? 1 : 2),
                            'settingUrl'=>'{amp-content-builder}',
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
                            'name'=>'Classipress for AMP',
                            'desc'=>'Amp Compatibility for Classipress Theme',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/cp.png',
                            'price'=>'$19',
                            'url_link'=>'http://ampforwp.com/classipress-for-amp',
                            'plugin_active_path'=> 'classipress-for-amp/classipress-for-amp.php',
                            'item_name'=>'Classipress for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('classipress-for-amp/classipress-for-amp.php')? 1 : 2),
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
                            'name'=>'Facebook Chat For AMP',
                            'desc'=>'Facebook Chat for AMP in WordPress. Most easiest and the best way to include Facebook Chat in AMP.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/comments.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/facebook-chat-for-amp/',
                            'plugin_active_path'=> 'facebook-chat-for-amp/facebook-chat-for-amp.php',
                            'item_name'=>'Facebook Chat For AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('facebook-chat-for-amp/facebook-chat-for-amp.php')? 1 : 2),
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
                            'name'=>'AMP Email',
                            'label' => 'AMP Email',
                            'desc'=>'You can send emails with AMP features(AMP4Email).',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/email.png',
                            'price'=>'$29.99',
                            'url_link'=>'https://ampforwp.com/addons/amp-email/#utm_source=options-panel&utm_medium=extension-tab_amp-comments&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-email/amp-email.php',
                            'item_name'=>'AMP Email',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-email/amp-email.php')? 1: 2),
                            'settingUrl'=>'',
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
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/amp-stories.png',
                            'price'=>'$79',
                            'url_link'=>'https://ampforwp.com/amp-stories/#utm_source=options-panel&utm_medium=extension-tab_stories&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'amp-stories/ampforwp-stories.php',
                            'item_name'=>'AMP Stories',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('amp-stories/ampforwp-stories.php')? 1 : 2),
                            'settingUrl'=>admin_url( 'edit.php?post_type=ampforwp_story' ),
                        ),
                        array(
                            'name'=>'Shortcodes Ultimate',
                            'desc'=>'This is an extension of Shortcodes Ultimate plugin for AMP Compatibility',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/amp-SU.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/shortcodes-ultimate/#utm_source=options-panel&utm_medium=extension-tab_shortcodes_ultimate&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'shortcodes-ultimate-for-amp/shortcodes-ultimate-for-amp.php',
                            'item_name'=>'Shortcodes Ultimate',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('shortcodes-ultimate-for-amp/shortcodes-ultimate-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Structured Data for WP',
                            'desc'=>'Structured Data for your site and for AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/sd-icon.png',
                            'price'=>'FREE',
                            'url_link'=>'https://ampforwp.com/structuredata-for-wp/#utm_source=options-panel&utm_medium=extension-tab_structuredata-for-wp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'structured-data-for-wp/structured-data-for-wp.php',
                            'item_name'=>'Structured Data for WP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>2,
                          //'settingUrl'=>'',
                        ),
                        array(
                            'name'=>'Purge AMP CDN Cache',
                            'class'=>'new-ext',
                            'label' => 'Purge AMP CDN Cache',
                            'desc'=>'Purge AMP CDN Cache on one click. Editors can update/purge the google cdn cache of amp post and pages in one click.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/cache-icon.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/addons/purge-amp-cdn-cache/#utm_source=options-panel&utm_medium=extension-tab_purge-amp-cdn-cache&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'purge-amp-cdn-cache/purge-amp-cdn-cache.php',
                            'item_name'=>'Purge AMP CDN Cache',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('purge-amp-cdn-cache/purge-amp-cdn-cache.php')? 1 : 2),
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
                            'name'=>'The Event Calendar for AMP',
                            'desc'=>'This is an extension of The Events Calendar For Amp',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/amp-SU.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/addons/the-event-calender-for-amp/#utm_source=options-panel&utm_medium=extension-tab_shortcodes_ultimate&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'the-events-calendar-for-amp/the-events-calendar-for-amp.php',
                            'item_name'=>'The Event Calender for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('the-events-calendar-for-amp/the-events-calendar-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Table Of Content Plus For AMP',
                            'desc'=>'This is an extension of Table Of Content For AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/amp-SU.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/table-of-contents-plus/#utm_source=options-panel&utm_medium=extension-tab_tableofcontent&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'table-of-content-plus-for-amp/table-of-content-plus-for-amp.php',
                            'item_name'=>'Table Of Content Plus For AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('table-of-content-plus-for-amp/table-of-content-plus-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Easy Table of Contents for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Easy Table of Contents Plugin Compatibility in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/easytoc-icon.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/easy-table-of-contents-for-amp/',
                            'plugin_active_path'=> 'easy-table-of-contents-for-amp/easy-table-of-contents-for-amp.php',
                            'item_name'=>'Easy Table of Contents for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('easy-table-of-contents-for-amp/easy-table-of-contents-for-amp.php')? 1 : 2),
                        ), 
                        array(
                            'name'=>'Floating Button for AMP',
                            'class'=>'new-ext',
                            'desc'=>'You can add floating button in AMP with the help of this extension',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/floating-icon.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/floating-button-for-amp/',
                            'plugin_active_path'=> 'floating-button-for-amp/floating-button-for-amp.php',
                            'item_name'=>'Floating Button for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('floating-button-for-amp/floating-button-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'JW Player Compatibility for AMP',
                            'class'=>'new-ext',
                            'desc'=>'JW Player for WordPress (By ilGhera) Compatibility in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/jwplayerforwp.png',
                            'price'=>'$9',
                            'url_link'=>'https://ampforwp.com/addons/jw-player-compatibility-for-amp/',
                            'plugin_active_path'=> 'jw-player-compatibility-for-amp/jwplayercompatibilityforamp.php',
                            'item_name'=>'JW Player Compatibility for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('jw-player-compatibility-for-amp/jwplayercompatibilityforamp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'CCPA for AMP',
                            'class'=>'new-ext',
                            'desc'=>'This extension allows you to comply with the privacy rules of CCPA',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/ccpa_for_amp.png',
                            'price'=>'$29',
                            'url_link'=>'https://ampforwp.com/addons/ccpa-for-amp/',
                            'plugin_active_path'=> 'ccpa-for-amp/ccpaforamp.php',
                            'item_name'=>'CCPA for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('ccpa-for-amp/ccpaforamp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Subdomain Endpoints for AMP',
                            'class'=>'new-ext',
                            'desc'=>'This extension allows you to add your own custom amp Endpoints as subdomian.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/subdomain-image.jpg',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/subdomain-endpoints-for-amp/#utm_source=options-panel&utm_medium=extension-tab_subdomain_endpoints_for_amp&utm_campaign=AMP%20Plugin',
                            'plugin_active_path'=> 'subdomain-endpoints-for-amp/subdomain-endpoints-for-amp.php',
                            'item_name'=>'Subdomain Endpoints for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('subdomain-endpoints-for-amp/subdomain-endpoints-for-amp.php')? 1 : 2),
                            'settingUrl'=>'{amp-subdomain-subsection}',
                        ),
                        array(
                            'name'=>'LuckyWP Table of Contents for AMP',
                            'class'=>'new-ext',
                            'desc'=>'This extension automatically adds LuckyWP Table of Contents functionality in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/LuckyWpTOCforAMP.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/addons/luckywp-table-of-contents-for-amp/',
                            'plugin_active_path'=> 'luckywp-table-of-contents-for-amp/luckywp-table-of-contents-for-amp.php',
                            'item_name'=>'LuckyWP Table of Contents for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('luckywp-table-of-contents-for-amp/luckywp-table-of-contents-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'iZooto for AMP',
                            'class'=>'new-ext',
                            'desc'=>'iZooto integration for amp',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/izooto-for-amp.png',
                            'price'=>'$29',
                            'url_link'=>'https://ampforwp.com/addons/izooto-for-amp/',
                            'plugin_active_path'=> 'izooto-for-amp/izooto-for-amp.php',
                            'item_name'=>'iZooto for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('izooto-for-amp/izooto-for-amp.php')? 1 : 2)
                        ),
                        array(
                            'name'=>'AAWP for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Display Amazon Affiliate links , nice product boxes, bestseller list ,comparison tables and much more! in AMP Pages.',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/aawp-for-amp-logo.png',
                            'price'=>'$79',
                            'url_link'=>'https://ampforwp.com/addons/aawp-for-amp/',
                            'plugin_active_path'=> 'aawp-for-amp/aawp-for-amp.php',
                            'item_name'=>'AAWP for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('aawp-for-amp/aawp-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Formidable forms for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Formidable forms Support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/Formidable-Forms-for-amp.png',
                            'price'=>'$79',
                            'url_link'=>'https://ampforwp.com/addons/formidable-forms-for-amp/',
                            'plugin_active_path'=> 'formidable-forms-for-amp/formidable-forms-for-amp.php',
                            'item_name'=>'Formidable forms for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('formidable-forms-for-amp/formidable-forms-for-amp.php')? 1 : 2),
                        ), 
                        array(
                            'name'=>'Reading Progress Bar for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Allows you to Add Reading Progress Bar support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/reading-progress-bar-for-amp.png',
                            'price'=>'$29',
                            'url_link'=>'https://ampforwp.com/addons/reading-progress-bar-for-amp/',
                            'plugin_active_path'=> 'reading-progress-bar-for-amp/reading-progress-bar-for-amp.php',
                            'item_name'=>'Reading Progress Bar for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('reading-progress-bar-for-amp/reading-progress-bar-for-amp.php')? 1 : 2),
                        ),  
                        array(
                            'name'=>'Ultimate Membership Pro Compatibility for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Ultimate Membership Pro Support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/ultimate-membership-pro-for-amp.png',
                            'price'=>'$89',
                            'url_link'=>'https://ampforwp.com/addons/ultimate-membership-pro-compatibility-for-amp/',
                            'plugin_active_path'=> 'ultimate-membership-pro-compatibility-for-amp/ultimate-membership-pro-compatibility-for-amp.php',
                            'item_name'=>'Ultimate Membership Pro Compatibility for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('ultimate-membership-pro-compatibility-for-amp/ultimate-membership-pro-compatibility-for-amp.php')? 1 : 2),
                        ), 
                        array(
                            'name'=>'Forminator for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Forminator forms Support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/forminator-for-amp.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/forminator-for-amp/',
                            'plugin_active_path'=> 'forminator-for-amp/forminator-for-amp.php',
                            'item_name'=>'Forminator for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('forminator-for-amp/forminator-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Smart Sticky Header for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Adds Smart Sticky Header in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/Sticky_Header.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/addons/smart-sticky-header-for-amp/',
                            'plugin_active_path'=> 'smart-sticky-header-for-amp/smart-sticky-header-for-amp.php',
                            'item_name'=>'Smart Sticky Header for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('smart-sticky-header-for-amp/smart-sticky-header-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Happyforms for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Happy forms Support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/happyforms-for-amp.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/happyforms-for-amp/',
                            'plugin_active_path'=> 'happyforms-for-amp/happyforms-for-amp.php',
                            'item_name'=>'Happyforms for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('happyforms-for-amp/happyforms-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Paid Memberships PRO for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Paid Memberships PRO Support in AMP',
                            'img_src'=> AMPFORWP_IMAGE_DIR . '/paid-memberships-pro-for-amp.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/paid-memberships-pro-for-amp/',
                            'plugin_active_path'=> 'paid-memberships-pro-for-amp/paid-memberships-pro-for-amp.php',
                            'item_name'=>'Paid Memberships PRO for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('paid-memberships-pro-for-amp/paid-memberships-pro-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Recipe Compatibility for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Recipes Support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/recipe-compatibility-for-amp.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/recipe-compatibility-for-amp/',
                            'plugin_active_path'=> 'recipe-compatibility-for-amp/recipe-compatibility-for-amp.php',
                            'item_name'=>'Recipe Compatibility for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('recipe-compatibility-for-amp/recipe-compatibility-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Polls for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Polls Support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/polls-for-amp.png',
                            'price'=>'$39',
                            'url_link'=>'https://ampforwp.com/addons/polls-for-amp/',
                            'plugin_active_path'=> 'polls-for-amp/polls-for-amp.php',
                            'item_name'=>'Polls for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('polls-for-amp/polls-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Post Views for AMP',
                            'class'=>'new-ext',
                            'desc'=>'Add Post Views Support in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/postviews-for-amp.png',
                            'price'=>'$29',
                            'url_link'=>'https://ampforwp.com/addons/postviews-for-amp/',
                            'plugin_active_path'=> 'postviews-for-amp/postviews-for-amp.php',
                            'item_name'=>'Post Views for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('postviews-for-amp/postviews-for-amp.php')? 1 : 2),
                        ),
                        array(
                            'name'=>'Transposh for AMP',
                            'class'=>'new-ext',
                            'desc'=>'This extension automatically adds Transposh WordPress Translation functionality in AMP',
                            'img_src'=>AMPFORWP_IMAGE_DIR . '/transposh-for-amp.png',
                            'price'=>'$19',
                            'url_link'=>'https://ampforwp.com/addons/transposh-for-amp/',
                            'plugin_active_path'=> 'transposh-for-amp/transposh-for-amp.php',
                            'item_name'=>'Transposh for AMP',
                            'store_url'=>'https://accounts.ampforwp.com',
                            'is_activated'=>(is_plugin_active('transposh-for-amp/transposh-for-amp.php')? 1 : 2),
                        ),
                    );
        $viewAllExtensions = array(
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
                );

$extension_listing_array = apply_filters( 'ampforwp_extension_lists_filter', $extension_listing_array );
$all_extensions_data = $extension_listing_array;
$ampforwp_extension_list_html = '';
$ampforwp_nameOfUser = "";
$ampforwp_is_productActivated = false;
function ampforwp_sort_extension_array($a, $b){
    if ($a['is_activated'] == $b['is_activated'] && isset($a['label']) && isset($b['label'])) {
        return strcmp(strtolower($a['name']), strtolower($b['name']));
    }
    return ($a['is_activated'] < $b['is_activated']) ? -1 : 1;
}
usort($extension_listing_array, 'ampforwp_sort_extension_array');
//add view all extensions
array_push($extension_listing_array, $viewAllExtensions);

foreach ($extension_listing_array as $key => $extension) {
    $currentStatus = "";

    $onclickUrl = '<a href="'.$extension['url_link'].'" target="_blank">';
    $onclickUrlclose = '</a>';
    $settingPageUrl = $pluginReview = '';
    if(isset($extension['is_activated']) && $extension['is_activated']!=1){
        $pluginReview = '<div class="extension_btn">From: '.esc_html($extension['price']).'</div>';
    }
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
        $selectedOption = (array) get_option('redux_builder_amp',true);
        if(isset($selectedOption['amp-license'][$pathExploded])){
            while ( strlen($selectedOption['amp-license'][$pathExploded]['license']) > 32 ) {
                  $selectedOption['amp-license'][$pathExploded]['license'] = base64_decode($selectedOption['amp-license'][$pathExploded]['license']);
            }
            $amplicense = $selectedOption['amp-license'][$pathExploded]['license'];
        }
        $verify = '<button type="button" id="'.$pathExploded.'" class="redux-ampforwp-ext-activate">Activate</button>';
        $license_status = '';
        if(isset($selectedOption['amp-license'][$pathExploded]['status']) && $selectedOption['amp-license'][$pathExploded]['status']==='valid'){
            $license_status = $selectedOption['amp-license'][$pathExploded]['status'];
             $currentStatus = 'active valid';
             $verify = '<button type="button" id="'.$pathExploded.'" class="redux-ampforwp-ext-deactivate">'.esc_html__('Deactivate', 'accelerated-mobile-pages').'</button> <span class="ampforwp-ext-refresh" style="cursor:pointer" id="'.esc_attr($pathExploded).'"><i class="dashicons dashicons-before dashicons-update"></i>'.esc_html__('Refresh', 'accelerated-mobile-pages').'</span>';
            if($ampforwp_nameOfUser=="" && isset($selectedOption['amp-license'][$pathExploded]['all_data']['customer_name'])){
                $ampforwp_nameOfUser = $selectedOption['amp-license'][$pathExploded]['all_data']['customer_name'];
            }

            if(isset($selectedOption['amp-license'][$pathExploded]['all_data']) && $selectedOption['amp-license'][$pathExploded]['all_data']!=""){
                $allResponseData = $selectedOption['amp-license'][$pathExploded]['all_data'];
                $remainingExpiresDays = floor( ( strtotime($allResponseData['expires'] )- time() )/( 60*60*24 ) );
                $lifetime_lic = isset($allResponseData['expires']) ? $allResponseData['expires'] : '' ;
                if($lifetime_lic == 'lifetime' ){
                $remainingExpiresDays = 'Lifetime';
                $amp_license_response = "<span class='license-tenure'>".esc_html__('Your License is valid for', 'accelerated-mobile-pages')." ".esc_html($remainingExpiresDays)."</span>. <a href='https://accounts.ampforwp.com/order/?edd_license_key=".esc_attr($amplicense)."&download_id=".esc_attr($allResponseData['item_name'])."' style='display:inline-block;' class='license-renew-a'>".esc_html__('Renew License', 'accelerated-mobile-pages')."</a>";
            }
                else if($remainingExpiresDays>0){
                    $amp_license_response = "<span class='license-tenure'>".esc_html($remainingExpiresDays)."  ".esc_html__('Days Remaining', 'accelerated-mobile-pages')."</span>. <a href='https://accounts.ampforwp.com/order/?edd_license_key=".esc_attr($amplicense)."&download_id=".esc_attr($allResponseData['item_name'])."' class='license-renew-a'>".esc_html__('Renew License', 'accelerated-mobile-pages')."</a>";
                }else{ $amp_license_response = "<span class='license-tenure expire'>".esc_html__('Expired', 'accelerated-mobile-pages')."!</span> <a href='https://accounts.ampforwp.com/order/?edd_license_key=".esc_attr($amplicense)."&download_id=".esc_attr($allResponseData['item_name'])."'  class='license-renew-a'>".esc_html__('Renew your license', 'accelerated-mobile-pages')."</a>"; }
            }
        }
        if ( '' == $allResponseData['success'] && '' == $allResponseData['success'] ) {        
        $pluginReview = '<input id="redux_builder_amp_amp-license_'.$pathExploded.'_license" type="text" value=""  onclick="return false;">
           <input name="redux_builder_amp[amp-license]['.$pathExploded.'][item_name]" type="hidden" value="'.$extension['item_name'].'">';
        }
            if (isset($extension['store_url'])){
            $pluginReview .= '<input name="redux_builder_amp[amp-license]['.$pathExploded.'][store_url]" type="hidden" value="'.$extension['store_url'].'">'; 
            }
             $pluginReview .= '<input name="redux_builder_amp[amp-license]['.$pathExploded.'][plugin_active_path]" type="hidden" value="'.$extension['plugin_active_path'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][name]" type="hidden" value="'.$extension['name'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][status]" type="hidden" value="'.$license_status.'">';
             $pluginReview .= '<input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][success]" type="hidden" value="'.$allResponseData['success'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][license]" type="hidden" value="'.$allResponseData['license'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][item_name]" type="hidden" value="'.$allResponseData['item_name'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][expires]" type="hidden" value="'.$allResponseData['expires'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][customer_name]" type="hidden" value="'.$allResponseData['customer_name'].'">
            <input name="redux_builder_amp[amp-license]['.$pathExploded.'][all_data][customer_email]" type="hidden" value="'.$allResponseData['customer_email'].'">
            <input class="amp-ls-solve" name="redux_builder_amp[amp-license]['.$pathExploded.'][license]" type="hidden" value="'. base64_encode($amplicense).'">
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
    if ( isset($extension['class']) && $extension['class'] && !$currentStatus ) {
        $secondPageClickClass = $secondPageClickClass. ' ' . $extension['class'];
    }
    $ampforwp_extension_list_html .= '<li class="first '.esc_attr($currentStatus).' '.esc_attr($secondPageClickClass).'" data-ext-details=\''.json_encode($extension).'\' data-ext-secure="'.wp_create_nonce('verify_extension').'">
        '.$onclickUrl.'
        <div class="align_left"><img src="'.esc_url($extension['img_src']).'" /></div>
        <div class="extension_desc">
        <h2>'.esc_html($extension['name']).'</h2>
        <p>'.esc_html($extension['desc']).'</p>
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
			if( 1 === $is_extension_active && 'PWA For WordPress' != $extension['item_name']){
				return true;
			}
		}
	}	
    if(class_exists('AMPExtensionManager')){
        return true;
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
                                    <h4>Ratings</h4>
                                </div>
                                <p>Easily add Rating to the posts. Supports 3 popular rating plugins.</p>
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
                            <div class="fe-2">
                                <div class="fe-t">
                                    <img src="'.AMPFORWP_IMAGE_DIR . '/tick.png" />
                                    <h4>45+ AMP Extensions</h4>
                                </div>
                                <p>Super Charge your AMP pages with Powerful AMP Extensions</p>
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
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=1">
                        <h5>PERSONAL</h5>
                        <span class="d-amt"><sup>$</sup>149</span>
                        <span class="amt"><sup>$</sup>149</span>
                        <span class="s-amt">(Save $59)</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">1 Site License</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">Save $800+</span>
                        <span class="pri-by">Buy Now</span>
                    </a>
                </div>
                <div class="pri-tb rec">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=2">
                        <h5>MULTIPLE</h5>
                        <span class="d-amt"><sup>$</sup>199</span>
                        <span class="amt"><sup>$</sup>199</span>
                        <span class="s-amt">(Save $79)</span>
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
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=3">
                        <h5>WEBMASTER</h5>
                        <span class="d-amt"><sup>$</sup>249</span>
                        <span class="amt"><sup>$</sup>249</span>
                        <span class="s-amt">(Save $99)</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">10 Site License</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">Save 83%</span>
                        <span class="pri-by">Buy Now</span>
                    </a>
                </div>
                <div class="pri-tb">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=4">
                        <h5>FREELANCER</h5>
                        <span class="d-amt"><sup>$</sup>299</span>
                        <span class="amt"><sup>$</sup>299</span>
                        <span class="s-amt">(Save $119)</span>
                        <span class="bil">Billed Annually</span>
                        <span class="s">25 Site License</span>
                        <span class="e">E-mail support</span>
                        <span class="f">Pro Features</span>
                        <span class="sv">Save 90%</span>
                        <span class="pri-by">Buy Now</span>
                    </a>
                </div>
                <div class="pri-tb">
                    <a href="https://accounts.ampforwp.com/order?edd_action=add_to_cart&download_id=24570&edd_options[price_id]=5">
                        <h5>AGENCY</h5>
                        <span class="d-amt"><sup>$</sup>499</span>
                        <span class="amt"><sup>$</sup>499</span>
                        <span class="s-amt">(Save $199)</span>
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
                <h2>Trusted by more that 200000+ Users!</h2>
                <p>More than 200k Websites, Blogs & E-Commerce website are powered by our AMP making it the #1 Rated AMP plugin in WordPress Community.</p>
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
                            <span>What\'s the time span for your contracts?</span>
                            <p>All the plans are year-to-year which are subscribed annually.</p>
                        </li>
                        <li>
                            <span>What payment methods are accepted?</span>
                            <p>We accepts PayPal and Credit Card payments.</p>
                        </li>
                        <li>
                            <span>Do you offer support if I need help?</span>
                            <p>Yes! Top-notch customer support for our paid customers is key for a quality product, so we’ll do our very best to resolve any issues you encounter via our support page.</p>
                        </li>
                        <li>
                            <span>Can I use the plugins after my subscription is expired?</span>
                            <p>Yes, you can use the plugins but you will not get future updates for those plugins.</p>
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
                            <p>Yes, you will get updates for all the premium plugins until your subscription is active.</p>
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
$layouts = ampforwp_upcomming_layouts_demo();
if(is_array($layouts)){
    foreach($layouts as $k=>$val){
    	$upcomingLayoutsDesign .=  '<div class="amp_layout_upcomming"> 
        <div class="amppb_ad-layout-layout">
            <div class="amppb_ad-layout-wrapper">
            <div class="amppb_ad-layout_pro"><a href="https://ampforwp.com/amp-layouts/" target="_blank">PRO</a></div>
                <h4 class="amppb_ad-layout-title">'.esc_html($val['name']).'</h4>
                <div class="amppb_ad-layout-screenshot"> <img src="'.esc_url($val['image']).'" onclick="window.open(\''.esc_url($val['link']).'\')"> </div>
                <div class="amppb_ad-layout-button">
                    <a target="_blank" href="'.esc_url($val['link']).'" class="button">'. esc_html__('View Theme','accelerated-mobile-pages').'</a> 
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
$amppro_settings_url = admin_url('admin.php?page=amp_options&tabid=opt-go-premium');
$amppro_enter_keyurl = admin_url('admin.php?tabid=opt-go-premium&page=amp_options');
// AMP Pro Extension Manager plugin activation & license key check #4613
if(class_exists('AMPExtensionManager')){
    $ampforwp_is_productActivated = true;
    $ampforwppro_license_info   = get_option('ampforwppro_license_info');
    if(empty($ampforwppro_license_info) || !isset($ampforwppro_license_info->license)){
        $amppro_enter_keyurl  = admin_url('admin.php?page=amp-extension-manager');
    }
    if(isset($ampforwppro_license_info->license) && $ampforwppro_license_info->license == "valid"){
          $ampforwp_nameOfUser = isset($ampforwppro_license_info->customer_name)?$ampforwppro_license_info->customer_name:'';
        $amppro_settings_url = admin_url('admin.php?page=amp-extension-manager');
    }
}
$upg_to_pro_url = '#';
$upg_to_pro_target = '';
if(get_theme_support('amp-template-mode')){
    $upg_to_pro_url = 'https://ampforwp.com/membership/#utm_source=options-panel&utm_medium=view_pro_features_btn&utm_campaign=AMP%20Plugin';
    $upg_to_pro_target = 'target="_blank"';
}
$proDetailsProvide = '<a class="technical_support_btn_txt" href="https://ampforwp.com/support/" target="_blank">'.esc_html__('Technical Support','accelerated-mobile-pages').'</a> <a class="premium_features_btn" href="https://ampforwp.com/membership/#utm_source=options-panel&utm_medium=view_pro_features_btn&utm_campaign=AMP%20Plugin" target="_blank">Upgrade to PRO</a> ';
if($ampforwp_nameOfUser!=""){
    if (class_exists('AMPExtensionManager') ) {        
        $license_info = get_option( 'ampforwppro_license_info');
        if (defined('AMPFORWPPRO_PLUGIN_DIR') && !empty($license_info)){
            $ampforwp_pro_manager = AMPFORWPPRO_PLUGIN_DIR.'inc/amp-ext-manager-lic-data.php';
            if( file_exists($ampforwp_pro_manager) ){
                require_once $ampforwp_pro_manager;
            }
            $settings_url = esc_url( admin_url('admin.php?page=amp-extension-manager') );
        }
    }
}

  if ( !class_exists( 'AMPExtensionManager' ) ) {
    if ( !defined('AMPFORWPPRO_PLUGIN_DIR') ){
        $expiredLicensedata  = array();
        foreach ($extension_listing_array as $key => $extension) {
            $currentStatus = "";
            $license_key        = '';
            $license_status     = 'inactive';
            $license_status_msg = '';
            $license_user_name = '';    
            $remainingExpiresDays = '';

            if($extension['plugin_active_path'] != "" && is_plugin_active($extension['plugin_active_path']) ){
                $ampforwp_is_productActivated = true;
                $currentStatus = "not-active invalid";
                $pathExploded = explode("/", $extension['plugin_active_path']);
                $pathExploded = $pathExploded[0];
                
                $amplicense = '';
                $allResponseData = '';
                $allResponseData = array('success'=>'',
                                'license'=> '',
                                'item_name'=> '',
                                'expires'=> '',
                                'customer_name'=> '',
                                'customer_email'=> '',
                                );
                $allResponseData = isset($selectedOption['amp-license'][$pathExploded]['all_data']) ? $selectedOption['amp-license'][$pathExploded]['all_data'] : NULL ;
                if ($allResponseData!=NULL) {
                $selectedOption = (array) get_option('redux_builder_amp',true);
                $expiredLicensedata[$pathExploded] = $selectedOption['amp-license'][$pathExploded]['status'] == 'expired' ? 1 : 0 ;
                $remainingExpiresDays =  date('Y-m-d', strtotime($allResponseData['expires'])) ;
                $license_info_lifetime = $allResponseData['expires'];
                $today = date('Y-m-d');
                $exp_date = $remainingExpiresDays; 
                $date1 = date_create($today);
                $date2 = date_create($exp_date);
                $diff = date_diff($date1,$date2);
                $days = $diff->format("%a");
                if( $license_info_lifetime == 'lifetime' ){
                    $days = 'Lifetime';
                    if ($days == 'Lifetime') {
                        $expire_msg = " Your License is Valid for Lifetime ";
                    }
                }
                elseif($today > $exp_date){
                    $days = -$days;
                }
            }
            
            $license_status = '';
            $isset_Checker = isset($selectedOption['amp-license'][$pathExploded]['status']) ? $selectedOption['amp-license'][$pathExploded]['status'] : NULL;
            if ($isset_Checker != NULL) {
            if(isset($selectedOption['amp-license'][$pathExploded]['status']) && $selectedOption['amp-license'][$pathExploded]['status']==='valid' || $selectedOption['amp-license'][$pathExploded]['status']==='expired'){
            $license_status = $selectedOption['amp-license'][$pathExploded]['status'];
            $license_user_name = substr($ampforwp_nameOfUser, 0, strpos($ampforwp_nameOfUser, ' '));
            $check_for_Caps = ctype_upper($license_user_name); 
            if ( $check_for_Caps == 1 ) {
                $license_user_name =  strtolower($license_user_name);
                $license_user_name =  ucwords($license_user_name);
            }
            else{
                $license_user_name =  ucwords($license_user_name);
            }
            $currentStatus = 'active valid';

            if($ampforwp_nameOfUser=="" && isset($selectedOption['amp-license'][$pathExploded]['all_data']['customer_name'])){
                $ampforwp_nameOfUser = $selectedOption['amp-license'][$pathExploded]['all_data']['customer_name'];
            }

            if(isset($selectedOption['amp-license'][$pathExploded]['all_data']) && $selectedOption['amp-license'][$pathExploded]['all_data']!=""){
                $allResponseData = $selectedOption['amp-license'][$pathExploded]['all_data'];
                $remainingExpiresDays =  date('Y-m-d', strtotime($allResponseData['expires'])) ;
              $license_info_lifetime = $allResponseData['expires']; 
              $today = date('Y-m-d');
              $exp_date = $remainingExpiresDays; 
              $date1 = date_create($today);
              $date2 = date_create($exp_date);
              $diff = date_diff($date1,$date2);
              $days = $diff->format("%a");
              if( $license_info_lifetime == 'lifetime' ){
                $days = 'Lifetime';
                if ($days == 'Lifetime') {
                    $expire_msg = " Your License is Valid for Lifetime ";
                }
            }
            elseif($today > $exp_date){
                $days = -$days;
            }
        }

        if(isset($selectedOption['amp-license'][$pathExploded])){
        while ( strlen($selectedOption['amp-license'][$pathExploded]['license']) > 32 ) {
            $selectedOption['amp-license'][$pathExploded]['license'] = base64_decode($selectedOption['amp-license'][$pathExploded]['license']);
            $amplicense = $selectedOption['amp-license'][$pathExploded]['license'];}
            $license_key = $selectedOption['amp-license'][$pathExploded]['license'];
        }

        $lic_status = isset($selectedOption['amp-license'][$pathExploded]['status']) ? $selectedOption['amp-license'][$pathExploded]['status'] : '';
            $lic_uname = isset($selectedOption['amp-license'][$pathExploded]['all_data']['customer_name']) ? $selectedOption['amp-license'][$pathExploded]['all_data']['customer_name'] : '';
            $license_user_name = substr($lic_uname, 0, strpos($lic_uname, ' ')); 
            $check_for_Caps = ctype_upper($license_user_name); 
            if ( $check_for_Caps == 1 ) {
            $license_user_name =  strtolower($license_user_name);
            $license_user_name =  ucwords($license_user_name);}
            else{ $license_user_name =  ucwords($license_user_name); }

            if ( isset( $license_user_name ) && $license_user_name!=="" && isset( $days ) ){
                if (  $license_status == 'valid' || $lic_status == 'expired' ) {
                    if ($lic_status == 'expired') { $days = -1; }

                    $one_of_plugin_expired = 0;
                    if ( in_array( 1, $expiredLicensedata ) ){
                            $one_of_plugin_expired = 1;
                        }
                    if ( !in_array( 0, $expiredLicensedata ) ){
                            $one_of_plugin_expired = 0;
                        }
                $exp_id = '';
                $expire_msg = '';
                $renew_mesg = '';
                $span_class = '';
                $expire_msg_before = '';
                $ZtoS_days = '';
                $refresh_addon = '';
                $user_refr = '';
                $alert_icon = '';
                $ext_settings_url = 'ext_url'; 
                $settings_url = esc_url(admin_url('edit.php?post_type=ampforwp&page=structured_data_options'));
                if ( $days == 'Lifetime' ) {
                    $expire_msg = " ".esc_html('Valid for Lifetime')." ";
                    // $expire_msg = " Active ";
                    $expire_msg_before = '<span class="before_msg_active">'.esc_html('Your License is').'</span>';
                    $span_class = "ampforwp_addon_icon dashicons dashicons-yes pro_icon ampforwppro_icon";
                    $color = 'color:green';
                }
                else if( $days>=0 && $days<=30 ){
                    $renew_url = "https://accounts.ampforwp.com/order/?edd_license_key=".esc_attr($license_key)."&download_id=".esc_attr($allResponseData['item_name'])."";

                    if ($one_of_plugin_expired == 1) {
                    $expire_msg_before = '<span class="before_msg_active">'.esc_html('One of your').' <span class="lessthan_30" style="color:red;">'.esc_html('license key is').'</span></span>';
                    $spann_class = "<span class='ampforwp_addon_icon dashicons dashicons-no lttn'></span>"; 
                    $expire_msg = '<span class="one_of_expired">'.esc_html("Expired").'</span> '.$spann_class.' <a target="blank" class="renewal-license" href="'.$renew_url.'"><span class="renew-lic">'.esc_html__('Renew', 'accelerated-mobile-pages').'</span></a>';
                }
                else
                    {
                        $expire_msg_before = '<span class="before_msg">'.esc_html('Your License is').'</span> <span class="ampforwp-addon-alert">'.esc_html('expiring in').' '.$days.' '.esc_html('days').'</span><a target="blank" class="renewal-license" href="'.$renew_url.'"><span class="renew-lic">'.esc_html__('Renew', 'accelerated-mobile-pages').'</span></a>';
                    }
                    $color = 'color:red';
                    $alert_icon = '<span class="ampforwp_addon_icon dashicons dashicons-warning pro_warning"></span>';
                    $trans_check = get_transient( 'ampforwp_addon_set_transient' );
                    if ( $trans_check !== 'ampforwp_addon_set_transient_value' ){
                    $refresh_addon = '<a id='.$pathExploded.' data-nonce='.wp_create_nonce('verify_extension').' data-days="'.$days.'"  class="days_remain">
                    <i addon-is-expired class="dashicons dashicons-update-alt" id="refresh_expired_addon"></i>
                    </a>';
                    }
                }
                elseif($days<0){
                    $ext_settings_url = 'ext_settings_url';
                    $renew_url = "https://accounts.ampforwp.com/order/?edd_license_key=".esc_attr($license_key)."&download_id=".esc_attr($allResponseData['item_name'])."";
                    if ($one_of_plugin_expired == 1) {
                    $expire_msg_before = '<span class="ampforwp_addon_inactive"><span class="ooy">'.esc_html('One of your').'</span> <span class="lthan_0" style="color:red;">'.esc_html('license key is').'</span></span>';
                    }else{
                        $expire_msg_before = '<span class="ampforwp_addon_inactive">'.esc_html('Your').' <span class="lthan_0" style="color:red;">'.esc_html('License has been').'</span></span>';
                        $user_refr = '<a class="user_refr" id='.$pathExploded.' data-nonce='.wp_create_nonce('verify_extension').' data-days="'.$days.'"  >
                    <i addon-is-expired class="dashicons dashicons-update-alt" id="user_refr_addon"></i>
                    </a>';
                    }
                    $expire_msg = " Expired ";
                    $exp_class = 'expired';
                    $exp_id = 'exp';
                    $exp_class_2 = 'renew_license_key_';
                    $span_class = "ampforwp_addon_icon dashicons dashicons-no ltz";
                    $renew_mesg = '<a target="blank" class="renewal-license" href="'.$renew_url.'"><span class="renew-lic">'.esc_html__('Renew', 'accelerated-mobile-pages').'</span></a>';
                    $color = 'color:red';

                    $trans_check = get_transient( 'ampforwp_addon_set_transient' );
                    if ( $trans_check !== 'ampforwp_addon_set_transient_value' ){
                        $refresh_addon = '<a id='.$pathExploded.' data-nonce='.wp_create_nonce('verify_extension').' data-days="'.$days.'"  class="days_remain">
                    <i addon-is-expired class="dashicons dashicons-update-alt" id="refresh_expired_addon"></i>
                    </a>';
                    }
}
                    else{
                        if ($one_of_plugin_expired == 1) {
                        $expire_msg_before = '<span class="before_msg_active">'.esc_html('One of your').' <span class="less_than_30" style="color:red;">'.esc_html('license key is').'</span></span>';    
                        }else{
                        $expire_msg_before = '<span class="before_msg_active">'.esc_html('Your License is').'</span>';                        
                        }
                        if ($one_of_plugin_expired == 1) {
                            $renew_url = "https://accounts.ampforwp.com/order/?edd_license_key=".esc_attr($license_key)."&download_id=".esc_attr($allResponseData['item_name'])."";
                        $expire_msg = " <span class='one_of_expired'>".esc_html('Expired')."</span> ";
                        $renew_mesg = '<a target="blank" class="renewal-license" href="'.$renew_url.'"><span class="renew-lic">'.esc_html__('Renew', 'accelerated-mobile-pages').'</span></a>';
                        }
                        else{
                            $expire_msg = " Active ";
                        }
                        if ($one_of_plugin_expired == 1) {
                        $span_class = "ampforwp_addon_icon dashicons dashicons-no pro_icon";                        
                        }
                        else{
                            $span_class = "ampforwp_addon_icon dashicons dashicons-yes pro_icon ampforwppro_icon";
                        }
                        if ($one_of_plugin_expired == 1) { $color = 'color:red';}
                        else{ $color = 'color:green'; }
                    }
                    if($days<0){ $exp_id = 'exp'; }
                    $proDetailsProvide = "<div class='ampforwp-addon-main'>
                    <span class='ampforwp-addon-info'>
                    ".$alert_icon."<span class='activated-plugins'>".esc_html('Hi')." <span class='ampforwp-addon_key_user_name'>".esc_html($license_user_name)."</span>".','."
                <span id='active-plugins-dr' data-days=".$days." class=".$days."> ".$expire_msg_before." </span>
                <span class='expiredinner_span' data-remain-days=".$days." id=".$exp_id.">".$expire_msg."</span>
                <span class='".$span_class."'></span>".$renew_mesg.$refresh_addon.$user_refr ;
                $proDetailsProvide .= $ZtoS_days."
                </span>
                </div>";
            }
        }
    }
}
}
}
}
}
 else if( $ampforwp_nameOfUser!="" && !class_exists('AMPExtensionManager') ){
    $proDetailsProvide = "<span class='extension-menu-call'><span class='activated-plugins'>Hello, ".esc_html($ampforwp_nameOfUser)."</span> <a class='' href='".esc_url(admin_url('admin.php?page=amp_options&tabid=opt-go-premium'))."'><i class='dashicons-before dashicons-admin-generic'></i></a></span>";
 }

if(function_exists('amp_activate') ){
    $proDetailsProvide = "<a class='premium_features_btn_txt' href=\"#\"> AMP by Automattic compatibility has been activated</a>";
}

$user = wp_get_current_user();
$permissions = "manage_options";
$amp_access = ampforwp_get_setting('ampforwp-role-based-access');

if( in_array( 'administrator', $user->roles ) ) {
    $permissions = "manage_options";
}elseif( in_array( 'editor', $user->roles ) && in_array('editor', $amp_access) ){
    $permissions = 'edit_pages';
}elseif( in_array( 'author', $user->roles ) && in_array('author', $amp_access)){
    $permissions = 'edit_posts';
}
if (class_exists('WPSEO_Options') && in_array( 'wpseo_manager', $user->roles ) && in_array('wpseo_manager', $amp_access)) {
    $permissions = 'edit_pages'; 
}
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'              => 'redux_builder_amp', // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'          =>  esc_html__( 'AMPforWP Options','accelerated-mobile-pages' ), // Name that appears at the top of your panel
    'menu_type'             => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'        => true, // Show the sections below the admin menu item or not
    'menu_title'            => esc_html__( 'AMP', 'accelerated-mobile-pages' ),
    'page_title'            => esc_html__('Accelerated Mobile Pages Options','accelerated-mobile-pages'),
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
    'page_permissions'      => $permissions, // Permissions needed to access the options panel.
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
            'title'   => esc_html__( 'Theme Information 1', 'accelerated-mobile-pages' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'accelerated-mobile-pages' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'accelerated-mobile-pages' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'accelerated-mobile-pages' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'accelerated-mobile-pages' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */

    /*
     *
     * ---> START SECTIONS
     *
     */
    // AMP by Automattic Compatibility
    if(function_exists('amp_activate') ){
        Redux::setSection( $opt_name, array(
              'id'    => 'automatic-amp-features',
              'title'      => esc_html__( 'AMP By Automattic Settings', 'accelerated-mobile-pages' ),
              'icon' => '',
                )   
        );
        ampforwp_admin_advertisement_options($opt_name);
        ampforwp_page_builders_support_options($opt_name);
        ampforwp_admin_performance_options($opt_name);
        ampforwp_analytics_options($opt_name);
        ampforwp_structure_data_options($opt_name);
        ampforwp_notice_bar_options($opt_name);
        ampforwp_push_notification_options($opt_name);
        ampforwp_admin_contact_form_options($opt_name);
    }


    // New AMP UX
     if(!function_exists('ampforwp_generate_ux_admin_button')){
        function ampforwp_generate_ux_admin_button($id='',$type='',$label=''){
            $option = "";
            if($type=="button"){
                if($id=="ampforwp-ux-website-type-section"){
                    $amp_website_type = ampforwp_get_setup_info('ampforwp-ux-website-type-section');
                    if($amp_website_type){
                    $option = '<div class="filled-lbl-blk">
                                    <p class="msg">'.esc_attr($amp_website_type).'</p>
                                    <span class="lbl">Change</span>
                                </div>';
                    }else{
                        $option = '<div class="button btn-red">'.esc_attr($label).'</div>';
                    }
                }else if($id=="ampforwp-ux-privacy-section"){
                    $setup_txt = ampforwp_get_setup_info('ampforwp-ux-privacy-section');
                    if($setup_txt!=""){
                    $option = '<div class="filled-lbl-blk">
                                    <p class="msg">'.esc_attr($setup_txt).'</p>
                                    <span class="lbl">Change</span>
                                </div>';
                    }else{
                        $option = '<div class="button btn-red">'.esc_attr($label).'</div>';
                    }    
                }else if($id=="ampforwp-ux-need-type-section"){
                    $need_type=ampforwp_get_setup_info('ampforwp-ux-need-type-section');
                    if($need_type!=""){
                    $option = '<div class="filled-lbl-blk">
                                    <p class="msg">'.esc_attr($need_type).'</p>
                                    <span class="lbl">Change</span>
                                </div>';
                    }else{
                        $option = '<div class="button btn-red">'.esc_attr($label).'</div>';
                    }
                }else if($id=="ampforwp-ux-design-section"){
                    $opt_med_url = ampforwp_get_setup_info('ampforwp-ux-design-section');
                    if($opt_med_url!=""){
                    $option = '<div class="filled-lbl-blk">
                                    <p class="msg">Configured</p>
                                    <span class="lbl">Change</span>
                                </div>';
                    }else{
                        $option = '<div class="button btn-red">'.esc_attr($label).'</div>';
                    }
                }else if($id=="ampforwp-ux-analytics-section"){
                    $analytics_txt = ampforwp_get_setup_info('ampforwp-ux-analytics-section');
                    if($analytics_txt!=""){
                    $option = '<div class="filled-lbl-blk">
                                    <p class="msg">'.esc_attr($analytics_txt).'</p>
                                    <span class="lbl">Change</span>
                                </div>';
                    }else{
                        $option = '<div class="button btn-red">'.esc_attr($label).'</div>';
                    }
                }else{
                    $option = '<div class="button btn-red">'.esc_attr($label).'</div>';
                }
            }else{
                $option = '<div class="button btn-list">'.esc_attr($label).'</div>';
            }
            return $option;
        }
    }
  $setup_ids = array(
                        'ampforwp-ux-website-type-section',
                        'ampforwp-ux-need-type-section',
                        'ampforwp-ux-analytics-section'
                    );
    $amp_ux_icon = "amp-ux-warning-okay";
    for($sid = 0; $sid < count($setup_ids); $sid++ ){
        $check = ampforwp_get_setup_info($setup_ids[$sid]);
        if($check==""){
            $amp_ux_icon = "amp-ux-warning";
        }
    }
    $is_aafwp = "not-exist";
    $aafwp_active_url = '';
    $aafwp_default = 0;
    $ampforwp_admin_url = admin_url();
    $adfwp_a_open = "";
    $adfwp_a_close = "";
 
    $adv_data_href = 'data-href=ampforwp-ux-advertisement-section';
    if(function_exists('adsforwp_check_plugin')){
        $plugin_file = "ads-for-wp/ads-for-wp.php";
        $is_sdfwp = "active";
        $aafwp_active_url = $ampforwp_admin_url.'admin.php?page=adsforwp&amp;tab=general&amp;reference=ampforwp';
        $adfwp_a_open = '<a href="'.esc_url($aafwp_active_url).'" target="_blank">';
        $adfwp_a_close = '</a>';
        $adv_data_href = 'data-href=';
    }
        Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Setup', 'accelerated-mobile-pages' ),
            'id'         => 'ampforwp-new-ux',
            'icon'         => "el el-warning ux-setup-icon $amp_ux_icon",
            'fields'     => array(      
                                   array(       
                                               'id' => 'ampforwp-setup-ux-website-type',        
                                               'type' => 'text',        
                                               'title' => '',       
                                               'default'=>''        
                                    )       
                               ),
            'desc'   => '<div class="amp-ux-section">
                            <h2 class="amp-section-desc">Quick &amp; Easy Setup</h2>
                        <div class="amp-ux-section-fields">
                                <div class="amp-ux-section-field" data-id="website-type" data-href="ampforwp-ux-website-type-section">
                                   <div class="amp-ux-elem-field">
                                        <h4 class="amp-ux-elem-title">Website Type</h4>
                                        <div class="amp-ux-elem-but-block amp-ux-valid-require">'.ampforwp_generate_ux_admin_button("ampforwp-ux-website-type-section","button","SELECT").'</div>
                                    </div>
                                </div>
                                <div class="amp-ux-section-field" data-href="ampforwp-ux-need-type-section">
                                    <div class="amp-ux-elem-field">
                                        <h4 class="amp-ux-elem-title">
                                            Where do you need AMP?
                                        </h4>
                                        <div class="amp-ux-elem-but-block amp-ux-valid-require">'.ampforwp_generate_ux_admin_button("ampforwp-ux-need-type-section","button","CHOOSE").'</div>
                                    </div>
                                </div>
                                <div class="amp-ux-section-field" data-href="ampforwp-ux-design-section">
                                   <div class="amp-ux-elem-field">
                                        <h4 class="amp-ux-elem-title">Design and Presentation</h4>
                                     <div class="amp-ux-elem-but-block">'.ampforwp_generate_ux_admin_button("ampforwp-ux-design-section","button","SET UP").'</div>
                                    </div>
                                </div>
                                <div class="amp-ux-section-field" data-href="ampforwp-ux-analytics-section">
                                     <div class="amp-ux-elem-field">
                                        <h4 class="amp-ux-elem-title">Analytics Tracking</h4>
                                        <div class="amp-ux-elem-but-block amp-ux-valid-require">'.ampforwp_generate_ux_admin_button("ampforwp-ux-analytics-section","button","CONFIG").'</div>
                                    </div>
                                </div>
                                <div class="amp-ux-section-field" data-href="ampforwp-ux-privacy-section">
                                     <div class="amp-ux-elem-field">
                                        <h4 class="amp-ux-elem-title">Privacy Settings</h4>
                                        <div class="amp-ux-elem-but-block">'.ampforwp_generate_ux_admin_button("ampforwp-ux-privacy-section","button","CHOOSE").'</div>
                                    </div>
                                </div>'.
                                $adfwp_a_open.
                                '<div class="amp-ux-section-field" '.esc_attr($adv_data_href).'>
                                    <div class="amp-ux-elem-field">
                                        <h4 class="amp-ux-elem-title">Advertisement</h4>
                                        <div class="amp-ux-elem-but-block stup">View Setup</div>
                                    </div>
                                </div>'.
                                 $adfwp_a_close.
                                '<div class="amp-ux-section-field" data-href="ampforwp-ux-thirdparty-section">
                                    <div class="amp-ux-elem-field">
                                        <h4 class="amp-ux-elem-title">3rd Party Compatibility</h4>
                                        <div class="amp-ux-elem-but-block">'.ampforwp_generate_ux_admin_button("ampforwp-ux-thirdparty-section","label","View List").'</div>
                                    </div>
                                </div>
                        </div>
                    </div>',
        ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Settings', 'accelerated-mobile-pages' ),
          'id'    => 'basic',
          'icon' => 'el el-cogs',
          'desc'  => '',
          'class'  =>'amp-opt-settings',
    ));
    
    function ampforwp_default_logo_settings($param=""){
        $custom_logo_id = '';
        $image          = '';
        $value          = '';
        $current_page = ampforwp_get_admin_current_page();
        if($current_page=="amp_options"){
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image = wp_get_attachment_image_src( $custom_logo_id , 'full');
            if( $image ){
                return $image[0];
            }
        }
        return $value;
    }
    function ampforwp_custom_logo_dimensions_options(){
        $opCheck = ampforwp_get_setting('ampforwp-custom-logo-dimensions');
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
                    'title'   => esc_html__('Custom Post Types', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'   => esc_html__('Enable AMP Support on Custom Post Types', 'accelerated-mobile-pages'),
                    'multi'   => true,
                    //'data' => 'post_type',
                    'options' => ampforwp_get_cpt_generated_post_types(),
                );
    }
function ampforwp_get_categories($id){
	$data =	get_transient($id);

	if($data){
		return $data;
	}
	
    $result = array();
    $selected_categories = ampforwp_get_setting($id);
    
	if(is_numeric($selected_categories)){
		$temp_array = array();
		$temp_array[0] = $selected_categories;
		$selected_categories = $temp_array;
	}
	if(isset($selected_categories) && $selected_categories) {
		$get_required_data = array_filter( $selected_categories );
		if ( count( $get_required_data ) != 0 ) {
			$categories = get_terms( 'category', array( 'include' => $get_required_data ) );
			foreach ( $categories as $category ) {
				$result[ esc_attr( $category->term_id ) ] = esc_html( $category->name );
			}
			set_transient( $id, $result);
		}
	}
	return $result;
}
function ampforwp_get_all_tags($id){

	$data =  get_transient($id);
	if ( $data) {
		return $data;
	}

    $result = array();
    $selected_tags = ampforwp_get_setting($id);

	if ( $selected_tags ){
		if(is_numeric($selected_tags)){
			$temp_array = array();
			$temp_array[0] = $selected_tags;
			$selected_tags = $temp_array;
		}
		$get_required_data = array_filter( $selected_tags );

		if ( count( $get_required_data ) != 0 ) {
			$tags = get_terms( 'post_tag', array( 'include' => $get_required_data ) );
			foreach($tags as  $tag ) {
				$result[esc_attr($tag->term_id)] = esc_html($tag->name);
			}
			set_transient( $id, $result);
		}
	}
	return $result;
}
    function ampforwp_get_user_roles(){
        global $wp_roles;
        $allroles = array();
        foreach ( $wp_roles->roles as $key=>$value ){
            $allroles[esc_attr($key)] = esc_html($value['name']);
        }
        return $allroles;
    }
    function ampforwp_default_user_roles(){
        $roles = '';
        $metabox_access = ampforwp_get_setting('amp-meta-permissions');
        if($metabox_access == 'admin'){
            $rba = ampforwp_get_setting('ampforwp-role-based-access');
            if(empty($rba)){
                $roles = array('administrator');
            }else{
                $roles = ampforwp_get_setting('ampforwp-role-based-access');
            }
        }else{
            $rba = ampforwp_get_setting('ampforwp-role-based-access');
            if(empty($rba)){
                $roles = array('administrator','editor');
            }else{
                $roles = ampforwp_get_setting('ampforwp-role-based-access');
            } 
        }
        return $roles;
    }
    function ampforwp_get_generated_custom_taxonomies(){
        $taxonomies = '';
        $taxonomies = get_transient('ampforwp_get_taxonomies');
        return $taxonomies;
    }
    $amp_custom_tax_option = array();
    $taxonomies = ampforwp_get_generated_custom_taxonomies();
    if( !empty($taxonomies) && $taxonomies != false){
        $amp_custom_tax_option = array(
                    'id'      => 'ampforwp-custom-taxonomies',
                    'type'    => 'select',
                    'title'   => esc_html__('Custom Taxonomies', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'   => esc_html__('Enable AMP Support on Archives for Custom Taxonomies.', 'accelerated-mobile-pages'),
                    'multi'   => true,
                    'options' => ampforwp_get_generated_custom_taxonomies(),
                    'required' => array('ampforwp-archive-support', '=' , '1')
                );
    }
    $design_types = ampforwp_get_setting('amp-design-selector');
    $secondary_text = 'Content';
    if($design_types == 1 || $design_types == 2 || $design_types == 3){
        $secondary_text = 'Secondary';
    }
    $show_for_admin = '';
    if(!current_user_can('administrator') ){
        $show_for_admin = 'hide';
    }
    // AMP to WP Default value
    function ampforwp_amp2wp_default(){
        $default = 0;
        if (true == ampforwp_get_setting('ampforwp-amp-takeover')){
            return $default;
        }
        $theme = '';
        $theme = wp_get_theme(); // gets the current theme

        if ( 'AMP WordPress Theme' == $theme->name || 'AMP WordPress Theme' == $theme->parent_theme ) {
            $default = 1;
        }
        return $default;
    }
        Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'accelerated-mobile-pages' ),
        'id'         => 'opt-text-subsection',
        'subsection' => true,
        'fields'     => array(
           array(
                       'id' => 'amp-logo',
                       'type' => 'section',
                       'title' => esc_html__('Branding', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),

             array(
                'id'       => 'opt-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('Logo', 'accelerated-mobile-pages'),
                'tooltip-subtitle'=>esc_html__('Upload a logo for the AMP version. (Recommended logo size: 190x36)', 'accelerated-mobile-pages'),
                'default' => array('url' => ampforwp_default_logo_settings() ),
            ),
           array(
                'id'       => 'ampforwp-custom-logo-dimensions',
                'title'    => esc_html__('Resize', 'accelerated-mobile-pages'),
                'type'     => 'switch',
                'default'  => 0,
                'required'=>array('opt-media','!=',''),
            ),
            array(
                'id'       => 'ampforwp-custom-logo-dimensions-options',
                'title'    => esc_html__('Resize Method', 'accelerated-mobile-pages'),
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
                'title'    => esc_html__('Resize Your Logo', 'accelerated-mobile-pages'),
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
                'title'    => esc_html__('Logo Width', 'accelerated-mobile-pages'),
                'tooltip-subtitle'    => __('Default width is 190 pixels', 'accelerated-mobile-pages'),
                'default' => '190',
                 'required'=>array('ampforwp-custom-logo-dimensions-options','=','prescribed'),
            ),
           array(
                'class' => 'child_opt',
                'id'       => 'opt-media-height',
                'type'     => 'text',
                'title'    => esc_html__('Logo Height', 'accelerated-mobile-pages'),
                'tooltip-subtitle'    => __('Default height is 36 pixels', 'accelerated-mobile-pages'),
                'default' => '36',
                'required'=>array('ampforwp-custom-logo-dimensions-options','=','prescribed'),

            ),
           array(
                       'id' => 'amp-support',
                       'type' => 'section',
                       'title' => esc_html__('AMP Support', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
           array(
               'id'        =>'amp-on-off-for-all-posts',
               'type'      => 'switch',
               'title'     => esc_html__('Posts', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('Enable AMP Support on Posts', 'accelerated-mobile-pages'),
               'default'   => 1,
            ),
			array(
               'id'        =>'amp-on-off-for-all-pages',
               'type'      => 'switch',
               'title'     => esc_html__('Pages', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('Enable AMP Support on Pages.', 'accelerated-mobile-pages'),
               'default'   => 1,
            ),
           array(
               'id'       => 'ampforwp-homepage-on-off-support',
               'type'     => 'switch',
               'title'    => esc_html__('Homepage', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable AMP Support on Homepage.', 'accelerated-mobile-pages'),
               'default'  => '1'
            ),
           array(
                'id'        =>'amp-frontpage-select-option',
                'type'      => 'switch',
                'title'     => esc_html__('Custom Front Page', 'accelerated-mobile-pages'),
                'default'   => 0,
                'tooltip-subtitle'  => esc_html__('Set Custom Front Page as Homepage', 'accelerated-mobile-pages'),
                'true'      => 'true',
                'false'     => 'false',
                'required'  => array('ampforwp-homepage-on-off-support','=','1'),
            ),
           array(
                'id'       => 'amp-frontpage-select-option-pages',
                'type'     => 'select',
               'class' => 'child_opt child_opt_arrow',
                'title'    => esc_html__('Select Page as Front Page', 'accelerated-mobile-pages'),
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
               'title'    => esc_html__('Title on Static Front Page', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable/Disable display of title on the Static Front Page.', 'accelerated-mobile-pages'),
               'default' => 0,
               'required' => array('amp-frontpage-select-option', '=' , '1'),
            ),

           array(
               'id'       => 'ampforwp-archive-support',
               'type'     => 'switch',
               'title'    => esc_html__('Archives [Category & Tags]', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable AMP Support on Archives.', 'accelerated-mobile-pages'),
               'default'  => '1'
             ),
           array(
               'id'       => 'ampforwp-archive-support-cat',
               'type'     => 'switch',
               'class' => 'child_opt child_opt_arrow',
               'title'    => esc_html__('Category', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable AMP Support on Categories.', 'accelerated-mobile-pages'),
               'default'  => '1',
               'required' => array('ampforwp-archive-support', '=' , '1')
             ),
           array(
               'id'       => 'ampforwp-archive-support-tag',
               'type'     => 'switch',
               'class' => 'child_opt child_opt_arrow',
               'title'    => esc_html__('Tags', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable AMP Support on Tags.', 'accelerated-mobile-pages'),
               'default'  => '1',
               'required' => array('ampforwp-archive-support', '=' , '1')
             ),
           $amp_cpt_option,
           $amp_custom_tax_option,
           array(
               'id'       => 'ampforwp-amp-takeover',
               'type'     => 'switch',
               'title'    => esc_html__('AMP Takeover (Beta)', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Make your non-amp to load the AMP (AMP & NON-AMP both will be AMP with same design)', 'accelerated-mobile-pages'),
               'default'  => '0'
             ),
      )
    ) );//END
/*    $pb_title = 'Page Builder';
    $theme = wp_get_theme(); // gets the current theme
    if( class_exists('Vc_Manager') || ( class_exists('ET_Builder_Plugin') || 'Divi' == $theme->name || 'Divi' == $theme->parent_theme ) || did_action( 'elementor/loaded' ) ){
        if(class_exists('Vc_Manager') ){
           $pb_title =  'WPBakery Page Builder Support';
        }
        if( class_exists('ET_Builder_Plugin') || 'Divi' == $theme->name || 'Divi' == $theme->parent_theme ){
            $pb_title =  'Divi Builder Support';
        }
        if(did_action( 'elementor/loaded' ) ){
            $pb_title =  'Elementor Support';
        }
    }
   // AMP Content Page Builder SECTION
   Redux::setSection( $opt_name, array(
       'title'      => esc_html__(  $pb_title, 'accelerated-mobile-pages' ),
       'id'         => 'amp-content-builder',
       'class'      => 'ampforwp_new_features ',
       'subsection' => true,
       'fields' => $pb_for_amp,
       )

   ) ;*/

    // Ads Section
    if ( ! function_exists('amp_activate') ) {
        ampforwp_admin_advertisement_options($opt_name);
    }
    if ( ! function_exists('ampforwp_seo_default') ) {
        function ampforwp_seo_default() {
            $default = '';
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
            if ( is_plugin_active('wordpress-seo/wp-seo.php') ) {
                $default = 'yoast';
            }
            elseif ( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) {
                $default = 'aioseo';
            }
            elseif ( defined( 'RANK_MATH_FILE' ) ) {
                $default = 'rank_math';
            }
            elseif ( function_exists('genesis_theme_support') ) {
                $default = 'genesis';
            }
            elseif ( is_plugin_active('wp-seopress/seopress.php') ) {
                $default = 'seopress';
            }
            elseif ( function_exists( 'the_seo_framework' ) ) {
                $default = 'seo_framework';
            }
            elseif ( class_exists('SQ_Classes_ObjController') ) {
                $default = 'squirrly';
            }
            return $default;
        }
    }
    $seo_options = array(
                    'yoast'       => 'Yoast',
                    'aioseo'     => 'All in One SEO',
                    'rank_math' => 'Rank Math SEO',
                    'genesis'    => 'Genesis',
                    'seopress'    => 'SEOPress',
                    'bridge'    => 'Bridge Qode SEO',
                    'seo_framework'    => 'The SEO Framework',
                    'squirrly'    => 'Squirrly SEO',
                    'smartcrawl'    => 'SmartCrawl'
                );
 // SEO SECTION
  Redux::setSection( $opt_name, array(
      'title'      => esc_html__( 'SEO', 'accelerated-mobile-pages' ),
      'id'         => 'amp-seo',
      'subsection' => true,
       'fields'     => array(
            array(
                  'id' => 'ampforwp-seo-general-section',
                  'type' => 'section',
                  'title' => esc_html__('General', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1,
              ),
            array(
               'id'       => 'ampforwp-seo-meta-desc',
               'type'     => 'switch',
               'title'     => esc_html__('Meta Description', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => esc_html__('The meta tag that displays in head', 'accelerated-mobile-pages'),
               'default'  => 1
            ),
            array(
               'id'       => 'ampforwp-seo-og-meta-tags',
               'type'     => 'switch',
               'title'     => esc_html__('OpenGraph Meta Tags', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => esc_html__('Enable/Disable Default OpenGraph Meta Tags', 'accelerated-mobile-pages'),
               'default'  => 0,
            ),
            array(
               'id'       => 'ampforwp-seo-custom-additional-meta',
               'type'     => 'textarea',
               'title'    => esc_html__('Head Section', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Adds additional Meta to the head section', 'accelerated-mobile-pages', 'accelerated-mobile-pages'),
               'placeholder'  => esc_html__('<!-- Paste your Additional HTML , that goes between <head> </head> tags -->','accelerated-mobile-pages')
            ),
            array(
                  'id' => 'ampforwp-seo-plugins-section',
                  'type' => 'section',
                  'title' => esc_html__('SEO Plugin Integration', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                    'accordion-open'=> 1,
              ),
           array(
                'id'       => 'ampforwp-seo-selection',
                'type'     => 'select',
                'title'    => esc_html__('Select SEO Plugin', 'accelerated-mobile-pages'),
               'options'  => $seo_options,
                'default'  => ampforwp_seo_default(),
            ),
           array( 
               'class' => 'child_opt child_opt_arrow',
               'id'       => 'ampforwp-seo-rank_math-meta',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Adds Social and Open Graph Meta Tags from Rank Math', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Meta Tags from Rank Math', 'accelerated-mobile-pages' ),
               'default'  => '1',
               'required'  => array('ampforwp-seo-selection', '=' , 'rank_math'),
           ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-rank_math-schema',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Adds Rank Math ld+json for AMP page', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Rank Math ld+json data', 'accelerated-mobile-pages' ),
               'default'  => '1',
               'required'  => array('ampforwp-seo-selection', '=' , 'rank_math'),
           ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-rank_math-canonical',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Pull Canonical from Rank Math for AMP pages', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Canonical from Rank Math', 'accelerated-mobile-pages' ),
               'default'  => '1',
               'required'  => array('ampforwp-seo-selection', '=' , 'rank_math'),
           ),
           array( 
               'class' => 'child_opt child_opt_arrow',
               'id'       => 'ampforwp-seo-yoast-meta',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Adds Social and Open Graph Meta Tags from Yoast', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Meta Tags from Yoast', 'accelerated-mobile-pages' ),
               'default'  => '1',
               'required'  => array('ampforwp-seo-selection', '=' , 'yoast'),
           ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-yoast-description',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Adds Yoast Custom description to ld+json for AMP page', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Yoast Description in ld+json', 'accelerated-mobile-pages' ),
               'default'  => 0,
               'required'  => array('ampforwp-seo-selection', '=' , 'yoast'),
           ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-yoast-canonical',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Pull Canonical from Yoast for AMP pages', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Canonical from Yoast', 'accelerated-mobile-pages' ),
               'default'  => 0,
               'required'  => array('ampforwp-seo-selection', '=' , 'yoast'),
           ),
           array(
                'id'       => 'ampforwp-yoast-bread-crumb',
                'class'    => 'child_opt child_opt_arrow',
                'type'     => 'switch',
                'default'  =>  false,
                'title'    => esc_html__('Breadcrumbs From Yoast', 'accelerated-mobile-pages'),
                'required'  => array(
                    array('ampforwp-bread-crumb', '=' , '1'),
                    array('ampforwp-seo-selection', '=' , 'yoast')
                ),
            ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-yoast-schema',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Fetch Schema from the Yoast Seo for AMP Pages', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Schema from Yoast', 'accelerated-mobile-pages' ),
               'default'  => 0,
               'required'  => array('ampforwp-seo-selection', '=' , 'yoast'),
           ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-yoast-seo-analysis',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Get the Yoast Analysis from AMP PageBuilder Content', 'accelerated-mobile-pages'),
               'title'    => esc_html__( 'Yoast Analysis for AMP PageBuilder', 'accelerated-mobile-pages' ),
               'default'  => 1,
               'required'  => array(array('ampforwp-seo-selection', '=' , 'yoast'),array('ampforwp-amp-takeover', '=' , '1')),
           ),
           array(
                'id'       => 'ampforwp-seo-aioseo',
                'type'     => 'info',
                'style'    => 'success',
                'desc'     => esc_html__("All in One SEO works out of the Box with our plugin. It deosn't requires any extra config except Canonicals.", 'accelerated-mobile-pages'),
                'required' => array('ampforwp-seo-selection', '=', 'aioseo')
            ),
           array(
               'class' => 'child_opt',
               'id'       => 'ampforwp-seo-aioseo-canonical',
               'type'     => 'switch',
               'tooltip-subtitle'     => esc_html__('Pull Canonical from All In One SEO for AMP pages', 'accelerated-mobile-pages'),
               'title'    =>esc_html__( 'Canonical from All In One SEO', 'accelerated-mobile-pages' ),
               'default'  => 0,
               'required'  => array('ampforwp-seo-selection', '=' , 'aioseo'),
           ),
            array(
                'id' => 'ampforwp-seo-index-noindex-sub-section',
                'type' => 'section',
                'title' => esc_html__('Advanced Indexing', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1,
            ),
            array(
               'id'       => 'amp-paginated-pages-indexing',
               'type'     => 'switch',
               'title'    => esc_html__('Remove Paginated Pages Indexing', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => sprintf( '%s<a href="%s" target="_blank">%s</a>', esc_html__("You can read more about it ",'accelerated-mobile-pages'),esc_url('https://ampforwp.com/tutorials/article/how-to-remove-paginated-pages-indexing-in-amp/'),esc_html__('here','accelerated-mobile-pages')),
               'default' => 0,
            ),
            array(
               'id'       => 'amp-inspection-tool',
               'type'     => 'switch',
               'title'    => esc_html__('URL Inspection Tool Compatibility', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => sprintf( '%s<a href="%s" target="_blank">%s</a>', esc_html__("You can read about it ",'accelerated-mobile-pages'),esc_url('https://webmasters.googleblog.com/2018/06/new-url-inspection-tool-more-in-search.html'),esc_html__('here','accelerated-mobile-pages')),
               'default' => 1,
            ),
           array(
               'id'       => 'ampforwp-robots-archive-sub-pages-sitewide',
               'type'     => 'switch',
               'title'    => esc_html__('Archive subpages (sitewide)', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__("Such as /page/2 so on and so forth",'accelerated-mobile-pages'),
               'default' => 0,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-author-pages',
               'type'     => 'switch',
               'title'    => esc_html__('Author Archives', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__("Enable it to set Indexing for Author Archives",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-date-pages',
               'type'     => 'switch',
               'title'    => esc_html__('Date Archives', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__("Enable it to set Indexing for Date Archives",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-category-pages',
               'type'     => 'switch',
               'title'    => esc_html__('Categories', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__("Enable it to set Indexing for Categories",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
           array(
               'id'       => 'ampforwp-robots-archive-tag-pages',
               'type'     => 'switch',
               'title'    => esc_html__('Tags', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__("Enable it to set Indexing for Tags",'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex',
               'required'  => array('amp-inspection-tool', '=' , '0'),
               'switch-text' => true,
           ),
       )
  )
  );

  if ( ! function_exists('amp_activate') ) {    
    // PageBuilders section
    ampforwp_page_builders_support_options($opt_name);
    // Performance section
    ampforwp_admin_performance_options($opt_name);
    // Analytics section
    ampforwp_analytics_options($opt_name);
    // Structured Data section
    ampforwp_structure_data_options($opt_name);
    // Notifications section
    ampforwp_notice_bar_options($opt_name);
    // Push Notifications section
    ampforwp_push_notification_options($opt_name);
   // Contact Form section
    ampforwp_admin_contact_form_options($opt_name);
  }

// comments 
 Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Comments', 'accelerated-mobile-pages' ),
    'desc' => $comment_desc,
    'id'         => 'disqus-comments',
    'subsection' => true,
    'fields'     => array(
    	array(  
	            'id' => 'ampforwp-display-comments',
	            'type' => 'section',
	            'title' => esc_html__('Display', 'accelerated-mobile-pages'),
	            'indent' => true,
	            'layout_type' => 'accordion',
	            'accordion-open'=> 1, 
	          ),
	      array(
	                 'id'       => 'ampforwp-display-on-pages',
	                 'type'     => 'switch',
	                 'title'    => esc_html__('Display on Pages', 'accelerated-mobile-pages'),
	                 'tooltip-subtitle' => esc_html__('Enable/Disable comments on pages using this switch.', 'accelerated-mobile-pages'),
	                 'default'  => 1
	             ),
	       array(
	                 'id'       => 'ampforwp-display-on-posts',
	                 'type'     => 'switch',
	                 'title'    => esc_html__('Display on Posts', 'accelerated-mobile-pages'),
	                 'tooltip-subtitle' => esc_html__('Enable/Disable comments on posts using this switch.', 'accelerated-mobile-pages'),
	                 'default'  => 1
	             ),
    	
        array(  
            'id' => 'ampforwp-comments',
            'type' => 'section',
            'title' => esc_html__('Discussion', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          ),
        array(
                'title'     =>esc_html__('WordPress Comments','accelerated-mobile-pages'),
                'id'        => 'wordpress-comments-support',
                'tooltip-subtitle'  => esc_html__('Enable/Disable WordPress comments using this switch.', 'accelerated-mobile-pages'),
                'type'      => 'switch',
                'default'  => 1,
                ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-number-of-comments',
                         'type'     => 'text',
                         'tooltip-subtitle'     => esc_html__('This refers to the normal comments','accelerated-mobile-pages'),
                         'title'    => esc_html__('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array('wordpress-comments-support' , '=' , 1
                                        ),
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-display-avatar',
                         'type'     => 'switch',
                         'title'    => esc_html__('User Avatar', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Enable/Disable user Avatar.', 'accelerated-mobile-pages'),
                         'default'  => 1,
                          'required' => array('wordpress-comments-support' , '=' , 1
                                        ),
                     ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-nofollow-comment-btn',
                         'type'     => 'switch',
                         'title'    => esc_html__('No follow button', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Add or remove No follow in comment button', 'accelerated-mobile-pages'),
                         'default'  => 1,
                          'required' => array('wordpress-comments-support' , '=' , 1 ),
                    ),
                     array(
                         'id'       => 'ampforwp-disqus-comments-support',
                         'type'     => 'switch',
                         'title'    => esc_html__('Disqus', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                        esc_html__('Enable/Disable Disqus comments using this switch and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-disqus-comments-in-amp/'), esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('to view the tutorial','accelerated-mobile-pages')),
                         'default'  => 0
                     ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-disqus-comments-name',
                         'type'     => 'text',
                         'title'    => esc_html__('Disqus Name', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Eg: https://xyz.disqus.com', 'accelerated-mobile-pages'),
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                         'default'  => ''
                     ),

                     array(
                        'class' => 'child_opt', 
                         'id'       => 'ampforwp-disqus-host-position',
                         'type'     => 'switch',
                         'title'    => esc_html__('Host on AMPforWP API', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Use AMPforWP secure servers to serve Comments file. Recommended if your site is non HTTPS', 'accelerated-mobile-pages'),
                         'default'  => 1,
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                     ),

                     array(
                        'class' => 'child_opt', 
                         'id'       => 'ampforwp-disqus-host-file',
                         'type'     => 'text',
                         'title'    => esc_html__('Disqus Host File', 'accelerated-mobile-pages'),
                         'desc' => '<a href="https://ampforwp.com/host-disqus-comments/" target="_blank"> Click here to know, How to Setup Disqus Host file on your servers </a>',
                         'tooltip-subtitle' => esc_html__('Enter the URL of host file', 'accelerated-mobile-pages'),
                         'placeholder' => 'https://comments.example.com/disqus.php',
                         'required' => array('ampforwp-disqus-host-position', '=' , '0'),
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-layout',
                         'title'    => esc_html__('Disqus Layout', 'accelerated-mobile-pages'),
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
                         'title'    => esc_html__('Disqus Iframe Height', 'accelerated-mobile-pages'),
                         'placeholder' => 'Enter the height',
                         'default' => '420',
                         'required'=>array('ampforwp-disqus-comments-support','=','1'),
                     ),
                     array(
                         'id'       => 'ampforwp-facebook-comments-support',
                         'type'     => 'switch',
                         'title'    => esc_html__('Facebook Comments', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Enable/Disable Facebook comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-fb-moderation-app-id',
                         'type'     => 'text',
                         'tooltip-subtitle'     => 
                         sprintf('%s <a href="https://developers.facebook.com/docs/plugins/comments/#moderation-setup-instructions" target="_blank">%s</a>.',esc_html__( 'If your site has many comments boxes, we recommend you specify a Facebook app ID as the managing entity, which means that all app administrators can moderate comments. Doing this enables a moderator interface on Facebook where comments from all plugins administered by your app ID can be easily moderated together. For details, see the','accelerated-mobile-pages' ),esc_html__('Facebook Moderation Setup documentation','accelerated-mobile-pages') ),
                         'title'    => esc_html__('Facebook APP ID', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'required' => array(
                            array('ampforwp-facebook-comments-support', '=' , 1),
                         ),
                    ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-fb-moderation-admin-id',
                         'type'     => 'text',
                         'tooltip-subtitle'     => 
                         sprintf('%s <a href="https://developers.facebook.com/docs/plugins/comments/#moderation-setup-instructions" target="_blank">%s</a>.',esc_html__( 'To assign a Facebook account to be the admin of a comments plugin implementation, see the','accelerated-mobile-pages' ),esc_html__('Facebook Moderation Setup documentation','accelerated-mobile-pages') ),
                         'title'    => esc_html__('Facebook Admin User ID', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'desc'  => 'You can add multiple ID(S) separated by comma(,) sign',
                         'required' => array(
                            array('ampforwp-facebook-comments-support', '=' , 1),
                         ),
                    ),
                     array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'       => 'ampforwp-facebook-comments-title',
                        'type'     => 'text',
                        'title'    => esc_html__('Title', 'accelerated-mobile-pages'),
                        'default'  => 'Leave a Comment',
                        'required' =>
                            array('ampforwp-facebook-comments-support', '=' , 1),
                      ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-number-of-fb-no-of-comments',
                         'type'     => 'text',
                         'tooltip-subtitle'     => 
                         sprintf('%s <a href="https://developers.facebook.com/docs/plugins/comments" target="_blank">%s</a>.',esc_html__( 'Enter the number of comments to show, Currently Facebook SDK limits this to max 100. For details, see the','accelerated-mobile-pages' ),esc_html__('Facebook comments documentation','accelerated-mobile-pages') ),
                         'title'    => esc_html__('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array(
                            array('ampforwp-facebook-comments-support', '=' , 1),
                         ),
                    ),
                     array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-fb-comments-lang',
                         'type'     => 'text',
                         'tooltip-subtitle'     => esc_html__('Enter the Language code','accelerated-mobile-pages'),
                         'title'    => esc_html__('Language', 'accelerated-mobile-pages'),
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
                         'title'    => esc_html__('Vuukle Comments', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Enable/Disable Vuukle comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-vuukle-comments-apiKey',
                         'type'     => 'text',
                         'tooltip-subtitle'     => esc_html__('Enter the API key of Vuukle','accelerated-mobile-pages'),
                         'title'    => esc_html__('API Key', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'desc'     => "For Example xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                         'required' => array(
                            array('ampforwp-vuukle-comments-support', '=' , 1),
                         ),
                    ),
                     array(
                         'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-vuukle-comments-emoji',
                         'type'     => 'switch',
                         'title'    => esc_html__('Vuukle Emoji', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Enable/Disable Vuukle comments emoji using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 1,
                         'required' => array(
                            array('ampforwp-vuukle-comments-support', '=' , 1),
                         ),
                    ),
                     //SpotIM Options
                    array(
                         'id'       => 'ampforwp-spotim-comments-support',
                         'type'     => 'switch',
                         'title'    => esc_html__('Spot.IM Conversation', 'accelerated-mobile-pages'),
                         'tooltip-subtitle' => esc_html__('Enable/Disable Spot.IM Conversation using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                    array(
                        'class' => 'child_opt child_opt_arrow', 
                         'id'       => 'ampforwp-spotim-comments-apiKey',
                         'type'     => 'text',
                         'tooltip-subtitle'     => esc_html__('Enter the SPOT_ID of Spot.IM','accelerated-mobile-pages'),
                         'title'    => esc_html__('SPOT ID', 'accelerated-mobile-pages'),
                         'default'  => '',
                         'desc'     => "For Example xxxxxxxx-xxxx-xxxx-xxxx",
                         'required' => array(
                            array('ampforwp-spotim-comments-support', '=' , 1),
                         ),
                    ),

                 )
 ) );

function ampforwp_fb_instant_article() {
    $feedname = '';
    $fb_instant_article_feed = ''; 
    $input = ''; 

    $feedname   = 'instant_articles';
    if(get_option('permalink_structure') == ''){
        $feedname = '?feed=instant_articles';
    }
    $fb_instant_article_feed = trailingslashit( get_home_url() ).$feedname ;
    $input      =  '<a href=" '. esc_url_raw($fb_instant_article_feed)  . '" target="_blank">' .  esc_url_raw( $fb_instant_article_feed ). '</a>' ;

    return strip_tags($input, '<a>');
}

// Facebook Instant Articles
Redux::setSection( $opt_name, array(
   'title'      => esc_html__( 'Instant Articles', 'accelerated-mobile-pages' ),
   'id'         => 'fb-instant-article',
   'subsection' => true,
   'fields'     => array(
        array(  
            'id' => 'ampforwp-fbia_1',
            'type' => 'section',
            'title' => esc_html__('Facebook Instant Articles Setup', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          ),
                     array(
                        'id'        =>'fb-instant-article-switch',
                        'type'      => 'switch',
                        'title'     => esc_html__('Instant Articles', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => esc_html__('Re-Save permalink when you enable this option, please have a look', 'accelerated-mobile-pages').' <a href="https://ampforwp.com/flush-rewrite-urls/">'.esc_html__('here', 'accelerated-mobile-pages').'</a> '.esc_html__('on how to do it', 'accelerated-mobile-pages'),
                    ),    
                    array(
                        'id'       => 'fb-instant-article-feed-url',
                        'type' => 'info',
                        'style' => 'critical',
                        'desc' => ampforwp_fb_instant_article(),
                        'title'    => esc_html__('Facebook Instant Articles Feed URL', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'    => 'fb-instant-page-id',
                        'type'  => 'text',
                        'title' => esc_html__('Facebook Page ID', 'accelerated-mobile-pages'),
                        'desc' => esc_html__('Follow ','accelerated-mobile-pages').'<a href="https://www.facebook.com/instant_articles/signup" target="_blank">'.esc_html__('these instructions.','accelerated-mobile-pages').'</a>'.esc_html__(' to sign up to Instant Articles and get your Facebook Page ID.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),

           array(
                       'id' => 'amp-fbia_2',
                       'type' => 'section',
                       'title' => esc_html__('Facebook Instant Articles Settings', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
                       'required'  => array('fb-instant-article-switch', '=', 1),
            ),
                    array(
                       'id'       => 'fb-instant-article-order-by',
                        'type'      => 'select',
                        'title'     => esc_html__('Show instant article on', 'accelerated-mobile-pages'),
                        'default'   => '1',
                        'tooltip-subtitle' => esc_html__('Select the type to show instant article on Publish Date/Updated Date.', 'accelerated-mobile-pages'),
                        'options'   => array(
                            '1'     => 'Published Date',
                            '2'     => 'Updated Date'
                        ),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'ampforwp-fb-instant-article-posts',
                        'type'      => 'text',
                        'title'     => esc_html__('Number of Posts', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Enter the number of posts to generate for Instant Articles.', 'accelerated-mobile-pages'),
                         'desc' => esc_html__('Leave this empty to generate All Posts (50).', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1),
                        'default'   => '50'
                    ),
                    array(
                        'id'       => 'ampforwp-instant-article-author-meta',
                        'type'      => 'switch',
                        'title'     => esc_html__('Author Meta', 'accelerated-mobile-pages'),
                        'default'   => 1, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'tooltip-subtitle' => esc_html__('Enable/Disable Author Meta', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'ampforwp-instant-article-author-bio',
                        'type'      => 'switch',
                        'title'     => esc_html__('Author Bio', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'tooltip-subtitle' => esc_html__('Enable/Disable Author Bio', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'ampforwp-ia-related-articles',
                        'type'      => 'switch',
                        'title'     => esc_html__('Related Articles', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'tooltip-subtitle' => esc_html__('Show/Hide Related Articles', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),  
                    array(
                        'id'       => 'fb-instant-article-ads',
                        'type'      => 'switch',
                        'title'     => esc_html__('Advertisement', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => esc_html__('Switch this on to enable advertising on Instant Article pages.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fb-instant-article-ad-type',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Advertisement Format', 'accelerated-mobile-pages'),
                        'default'   => '1',
                        'desc' => esc_html__('Select the type of advertising on Instant Article pages you want to display.', 'accelerated-mobile-pages'),
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
                        'title'    => esc_html__('Enter your Audience Network Placement ID', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s">%s</a>.', esc_html__('You can find out more about this','accelerated-mobile-pages'), esc_url('https://developers.facebook.com/docs/instant-articles/monetization/audience-network'),esc_html__('here','accelerated-mobile-pages') ),
                        'desc' => sprintf('<a href="%s" target="_blank">%s</a> %s', esc_url('https://ampforwp.com/tutorials/article/how-to-enter-audience-network-placement-id-of-advertisement-in-the-instant-article/'), esc_html__('Click here','accelerated-mobile-pages'), esc_html__('on how to get Audience Network Placement Id.','accelerated-mobile-pages')),
                        'required'  => array('fb-instant-article-ad-type', '=', '1')
                    ),
                    array(
                        'id'       => 'fb-instant-article-custom-iframe-ad',
                        'type'     => 'text',
                        'placeholder'=> 'https://www.adserver.com/ss',
                        'title'    => esc_html__('Enter your Custom iframe ad source URL'),
                        'required'  => array('fb-instant-article-ad-type', '=', '2')
                    ),
                    array(
                        'id'       => 'fb-instant-article-custom-embed-ad',
                        'type'     => 'textarea',
                        'placeholder'=> '',
                        'title'    => esc_html__('Enter your Custom Embed ad code'),
                        'required'  => array('fb-instant-article-ad-type', '=', '3')
                    ),
                    array(
                        'id'       => 'fb-instant-article-ad-density-setup',
                        'type'     => 'select',
                        'title'    => esc_html__('How often should ads show in Instant Article pages', 'accelerated-mobile-pages'),
                        'options'  => array(
                            'default' => esc_html__('Every 250 words', 'accelerated-mobile-pages' ),
                            'medium' => esc_html__('Every 350 words', 'accelerated-mobile-pages' ),
                            'low' => esc_html__('Every 500 words', 'accelerated-mobile-pages' ),
                        ),
                        'required'  => array('fb-instant-article-ads', '=', 1),
                        'default'  => 'default',
                    ),
                    array(
                        'id'       => 'fb-instant-article-analytics',
                        'type'      => 'switch',
                        'title'     => esc_html__('Analytics', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => esc_html__('Switch this on to enable analytics on Instant Article pages.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fb-instant-article-analytics-code',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Enter your Analytics script code', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Do not enter iframe tag. Find out more about support <a href="https://developers.facebook.com/docs/instant-articles/analytics">here</a> ', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-analytics', '=', 1)
                    ),
                     array(
                        'id'       => 'fb-instant-crawler-ingestion',
                        'type' => 'switch',
                        'title'    => esc_html__('Crawler Ingestion', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a>', 
                        esc_html__('Add ia:markup meta tag. Find out more about', 'accelerated-mobile-pages'), esc_url('https://developers.facebook.com/docs/instant-articles/crawler-ingestion'), esc_html__('here','accelerated-mobile-pages')),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                 array(
                        'id'       => 'fb-instant-feedback',
                        'type' => 'switch',
                        'title'    => esc_html__('Feedback for Media', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Allow like and comment for media', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                 array(
                        'id'        =>'hide-amp-ia-categories',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Categories to Hide in IA'),
                        'tooltip-subtitle' => esc_html__( 'Hide IA from all the posts of a selected category.', 'accelerated-mobile-pages' ),
                        'multi'     => true, 
                        'ajax'      => true, 
                        'data-action'     => 'ampforwp_categories',
                        'options' => ampforwp_get_categories('hide-amp-ia-categories'),
                        'data'      => 'categories',
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),  
                    array(
                        'id'       => 'fbia-header-text-area',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Custom HTML in Head Tag', 'accelerated-mobile-pages'),
                        'desc' => esc_html__('Add custom HTML in Head Tag in Instant Articles Markup. Click','accelerated-mobile-pages').' <a href="https://developers.facebook.com/docs/instant-articles/guides/articlecreate" target="_blank">'.esc_html__('here', 'accelerated-mobile-pages').'</a>'. esc_html__(' for more info on Instant Articles Markup', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fbia-body-text-area',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Custom HTML in Body Tag', 'accelerated-mobile-pages'),
                        'desc' => esc_html__('Add custom HTML in Body Tag in Instant Articles Markup. Click','accelerated-mobile-pages').' <a href="https://developers.facebook.com/docs/instant-articles/guides/articlecreate" target="_blank">'.esc_html__('here', 'accelerated-mobile-pages').'</a>'. esc_html__(' for more info on Instant Articles Markup', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fbia-footer-text-area',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Custom HTML in Footer Tag', 'accelerated-mobile-pages'),
                        'desc' => esc_html__('Add custom HTML in Footer Tag in Instant Articles Markup. Click','accelerated-mobile-pages').' <a href="https://developers.facebook.com/docs/instant-articles/guides/articlecreate" target="_blank">'.esc_html__('here', 'accelerated-mobile-pages').'</a>'. esc_html__(' for more info on Instant Articles Markup', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
    ),
   )
);
function ampforwp_get_post_percent(){
    $total_post = $post_count = $post_percent = '';
    $args=array(
        'fields'        => 'ids',
        'post_type'    => 'post',
        'posts_per_page'=> 1,
        'ignore_sticky_posts'=>1,
        'has_password' => false ,
        'post_status'=> 'publish',
        'no_found_rows' => true,
        'meta_query' => array(
            array(
                'key' => 'ampforwp-amp-on-off', 
                'compare' => 'NOT EXISTS',
            )
        )
    );
    $my_query   = new wp_query( $args );
    $post_count = $my_query->post_count;    
    if ($post_count == 0) {
        return 100;
    }
    $count_posts = wp_count_posts();
    if($count_posts){
        $total_post = $count_posts->publish;
    }
    $post_count = $total_post-$post_count;
    $post_percent = ($post_count/$total_post)*100;
    $post_percent = $post_percent - 24;
    return round($post_percent);
}
$post_percent = 0;
$current_page = ampforwp_get_admin_current_page();
$refresh_btn = "";
$refresh_text = esc_html__('All post metas are upto date.', 'accelerated-mobile-pages');  ;
if($current_page=="amp_options"){
    $post_percent = ampforwp_get_post_percent();
    if ($post_percent != 100) {
       $refresh_btn = "<span class='button button-primary button-small' id='ampforwp-refersh-related-post' target='_blank' data-id='".intval($post_percent)."' data-nonce='".wp_create_nonce( 'ampforwp_refresh_related_poost')."'><i class='el el-refresh'></i> Refresh</span>";
       $refresh_text = esc_html__('It will refresh only 30 records at once, please try refreshing until it will complete to 100%', 'accelerated-mobile-pages');  
    }
}
 // Hide AMP Bulk Tools
Redux::setSection( $opt_name, array(
   'title'      => esc_html__( 'Tools', 'accelerated-mobile-pages' ),
   'id'         => 'hide-amp-section',
   'subsection' => true,
   'fields'     => array(
                        array(
                                   'id' => 'hide-amp-bulk-tools',
                                   'type' => 'section',
                                   'title' => esc_html__('Hide AMP Bulk Tools', 'accelerated-mobile-pages'),
                                   'indent' => true,
                                   'layout_type' => 'accordion',
                                   'accordion-open'=> 1,
                        ),
                        array(
                           'id'       => 'amp-pages-meta-default',
                           'type'     => 'select',
                           'title'    => esc_html__( 'Individual AMP Page (Bulk Edit)', 'accelerated-mobile-pages' ),
                           'tooltip-subtitle' => esc_html__( 'Allows you to Show or Hide AMP from All pages, so it can be changed individually later. This option will change the  Default value of AMP metabox in Pages', 'accelerated-mobile-pages' ),
                           'desc' => esc_html__( 'NOTE: Changes will overwrite the previous settings.', 'accelerated-mobile-pages' ),
                           'options'  => array(
                               'show' => esc_html__('Show by Default', 'accelerated-mobile-pages' ),
                               'hide' => esc_html__('Hide by default', 'accelerated-mobile-pages' ),
                           ),
                           'default'  => 'show',
                           'required'=>array('amp-on-off-for-all-pages','=','1'),
                        ),       
                        array(
                        'id'        =>'hide-amp-categories2',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Categories to Hide AMP posts'),
                        'tooltip-subtitle' => esc_html__( 'Hide AMP from all the posts of a selected category.', 'accelerated-mobile-pages' ),
                        'multi'     => true, 
                        'ajax'      => true,
                        'options' => ampforwp_get_categories('hide-amp-categories2'),
                        'data-action'     => 'ampforwp_categories', 
                        'data'      => 'categories',
                        ),  
                    array(
                        'id'        =>'hide-amp-tags-bulk-option2',
                        'type'      => 'select',
                        'title'     => esc_html__('Select Tags to Hide AMP posts'),
                        'tooltip-subtitle' => esc_html__( 'Hide AMP from all the posts of a selected tags.', 'accelerated-mobile-pages' ),
                        'multi'     => true,
                        'ajax'      => true,
                        'options' => ampforwp_get_all_tags('hide-amp-tags-bulk-option2'),
                        'data-action' => 'ampforwp_tags', 
                        'data'      => 'tags',

                       ),
                        array(
                               'id' => 'amp-other-tools',
                               'type' => 'section',
                               'title' => esc_html__('Others', 'accelerated-mobile-pages'),
                               'indent' => true,
                               'layout_type' => 'accordion',
                               'accordion-open'=> 1,
                        ),
                        array(
                            'id'       => 'ampforwp-query-monitor',
                            'type'      => 'switch',
                            'title'     => esc_html__('Show Query Monitor data in AMP', 'accelerated-mobile-pages'),
                            'default'   => 1,
                            'tooltip-subtitle' => esc_html__('Enable/Disable Query Monitor for amp when logged in as admin and Query Monitor Plugin installed', 'accelerated-mobile-pages'),
                        ),
                        array(
                                'id'       => 'ampforwp-refersh-related-post',
                               'type'     => 'raw',
                               'title'     => esc_html__('Refresh Related Post', 'accelerated-mobile-pages'),
                               'content'   => $refresh_btn /* XXS OK */." 
                                <div class='ref-rel-bar-cont'>
                                  <div id='ref_rel_post_bar' class='ref-rel-post-bar' style='width:".intval($post_percent)."%;'>".intval($post_percent)."%</div>
                                </div>",
                               'tooltip-subtitle' => esc_html__('If related post is not showing up properly, please refresh it and check it once again.', 'accelerated-mobile-pages'),
                               'full_width' => false,
                               'description' => $refresh_text, /* XXS OK */
                        ),
                    )   
                 )
    );

 // Advance Settings SECTION
function ampforwp_featured_video_default(){
            $default = '';
            if(function_exists( 'csco_setup' )){
                $default = 'csco_post_embed';
            }
            return $default;
}
Redux::setSection( $opt_name, array(
   'title'      => esc_html__( 'Advance Settings', 'accelerated-mobile-pages' ),
   'desc'       => esc_html__( 'This section has some advanced settings, please use it with care','accelerated-mobile-pages'),
   'id'         => 'amp-advance',
   'subsection' => true,
   'fields'     => array(

                    array(
                        'id'       => 'amp-mobile-redirection',
                        'type'     => 'switch',
                        'title'    => esc_html__('Mobile Redirection', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('
                        Enable AMP for your mobile users. Give your visitors a Faster mobile User Experience.','accelerated-mobile-pages'),
                        'default' => 0,

                    ),
                    array(
                        'id'       => 'amp-mob-redirection-pres-link',
                        'class'    => 'child_opt child_opt_arrow',
                        'type'     => 'switch',
                        'title'    => esc_html__('Preserve Original Permalinks', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Enable/Disable Mobile redirection for preserve original permalinks.','accelerated-mobile-pages'),
                        'default' => 0,
                        'required' => array( 'amp-mobile-redirection', '=' , 1 )
                    ),
                    array(
                        'id'       => 'amp-tablet-redirection',
                        'class'    => 'child_opt child_opt_arrow',
                        'type'     => 'switch',
                        'title'    => esc_html__('Tablets', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Enable/Disable Mobile redirection for Tablets.','accelerated-mobile-pages'),
                        'default' => 1,
                        'required' => array( 'amp-mobile-redirection', '=' , 1 )
                    ),
                     array(
                       'id'    => 'amp-server-side-rendering',
                       'type'  => 'switch',
                       'title' => esc_html__('Server Side Rendering', 'accelerated-mobile-pages'),
                       'tooltip-subtitle' => esc_html__('Improve the Google Page Speed and Loading time with Server Side Rendering', 'accelerated-mobile-pages'),
                       'default'  => 0
                   ),
                    array(
                        'id'       => 'amp-redirection-search',
                        'type'     => 'switch',
                        'title'    => esc_html__('Search Result Page in AMP', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Disable this option if you want your search pages in Non-AMP.','accelerated-mobile-pages'),
                        'default' => 1,
                    ),
                    array(
                        'id'       => 'amp-desktop-redirection',
                        'type'     => 'switch',
                        'title'    => esc_html__('Disable AMP on Desktop', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('
                        Enable this option to give your visitors normal version on Desktop when accessing AMP','accelerated-mobile-pages'),
                        'default' => 0,
                    ),
                    array(
                        'id'       => 'convert-internal-nonamplinks-to-amp',
                        'type'     => 'switch',
                        'title'    => esc_html__('Change Internal Links to AMP', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Enable if you want all your links inside the article to go to /amp/. All the outbound links will remain untouched.','accelerated-mobile-pages'),
                        'default' => 0,
                    ),
                    array(
                        'id'       => 'hide-amp-version-from-source',
                        'type'     => 'switch',
                        'title'    => esc_html__('Hide AMP Version', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Enable if you want hide AMP version in view source page(generator).','accelerated-mobile-pages'),
                        'default' => 0,
                    ),
                    array(
                        'id'       => 'ampforwp-cat-description',
                        'type'     => 'switch',
                        'title'    => esc_html__('Category Description', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Disable this option if you dont want to show category description in AMP','accelerated-mobile-pages'),
                        'default' => 1,
                    ),
                    array(
                        'id'       => 'ampforwp-smooth-scrolling-for-links',
                        'type'     => 'switch',
                        'title'    => esc_html__('Smooth Scrolling For Links', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Enable this option if you want smooth scrolling for jumping links','accelerated-mobile-pages'),
                        'default' => 0,
                    ),
                    // End-point option
                    $amp_endpoint,
                    array(
                   'id'       => 'ampforwp-amp-convert-to-wp',
                   'type'     => 'switch',
                   'title'    => esc_html__('Convert AMP to WP theme (Beta)', 'accelerated-mobile-pages'),
                   'tooltip-subtitle'  => sprintf( '%s<a href="%s" target="_blank">%s</a>%s', esc_html__("It makes your AMP & Non-AMP Same! (AMP will output AMP Compatible code, while WordPress will have the WP code but with the same design and ",'accelerated-mobile-pages'),esc_url('https://ampforwp.com/tutorials/article/how-to-convert-your-non-amp-website-to-amp/'),esc_html__('Click Here','accelerated-mobile-pages'),esc_html__(' for more info','accelerated-mobile-pages')),
                   'default'  => ampforwp_amp2wp_default(),
                   'required' => array(
                    array('amp-design-selector', '=', '4'),
                    array('ampforwp-amp-takeover', '=' , '0'),
                    )
                ), 
                    array(
                       'id'       => 'ampforwp-right-click-disable',
                       'type'     => 'switch',
                       'title'    => esc_html__('Disable Right Click', 'accelerated-mobile-pages'),
                       'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option if you want a disable the right click in AMP to protect your data from copying', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-disable-right-click-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                       'default'  => false,
                ),
                    array(
                       'id'       => 'ampforwp-meta-viewport',
                       'type'     => 'switch',
                       'title'    => esc_html__('Full Meta Viewport', 'accelerated-mobile-pages'),
                       'tooltip-subtitle' => esc_html__('Enable this option if you want full meta viewport','accelerated-mobile-pages'),
                       'default'  => 0,
                ),
                    array(
                    'id'       => 'ampforwp-meta-viewport-notice',
                    'type'     => 'info',
                    'style'    => 'info',
                    'desc'     => esc_html__('Enabling this causes a 300-350ms tap delay which can decrease FID ( First Input Delay ). Please use this with caution.', 'accelerated-mobile-pages'),
                    'required' => array('ampforwp-meta-viewport', '=', 1)
                ),
                    array(
                       'id'       => 'ampforwp-search-google',
                       'type'     => 'switch',
                       'title'    => esc_html__('Search Results in Google', 'accelerated-mobile-pages'),
                       'tooltip-subtitle' => esc_html__('Enable this option if you want the search results as Google search','accelerated-mobile-pages'),
                       'default'  => 0,
                ),
                    array(
                        'id'       => 'amp-header-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Enter HTML in Head', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => esc_html__('check your markup here (enter markup between HEAD tag) : https://validator.ampproject.org/', 'accelerated-mobile-pages'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'amp-body-text-area',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Enter HTML in Body (beginning of body tag) ', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => esc_html__('check your markup here (enter markup in the beginning of body tag) : https://validator.ampproject.org/', 'accelerated-mobile-pages'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'amp-footer-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => esc_html__('Enter HTML in Footer', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => esc_html__('check your markup here (enter markup between BODY tag) : https://validator.ampproject.org/',
                        'accelerated-mobile-pages'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'amp-prefetch-options',
                        'type'     => 'repeater',
                        'title'    => esc_html__('DNS Priority URL(s)', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'  => sprintf( '%s<a href="%s" target="_blank">%s</a>%s', esc_html__("DNS Priority ask your browser to do a DNS lookup and connection before you need any resources from that domain. ",'accelerated-mobile-pages'),esc_url('https://ampforwp.com/tutorials/article/how-to-use-dns-prefetch-urls-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'),esc_html__(' for more info','accelerated-mobile-pages')),
                        'repeat-fields'=> array(
                                        array(
                                                'id'       => 'amp-dns-urls-type',
                                                'type'     => 'select',  
                                                'options'  => array(
                                                                        'prefetch'=>'Prefetch',
                                                                        'dns-prefetch'=>'DNS-Prefetch',
                                                                        'preload'=>'Preload',
                                                                        'preconnect'=>'Preconnect'
                                                                ),
                                        ),
                                        array(
                                                'id'       => 'amp-dns-urls-field',
                                                'type'     => 'text',
                                        ),
                                    ),
                        ),
                    array(
                        'id'       => 'ampforwp-auto-amp-menu-link',
                        'type'     => 'switch',
                        'title'    => esc_html__('Auto Add AMP in Menu URL', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Automatically add <code>AMP</code> at the end of menu url', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,
                        //'required'  => array('ampforwp-amp-menu', '=' , '1')
                    ),
					//Category Base Removal in AMP
					array(
                        'id'       => 'ampforwp-category-base-removel-link',
                        'type'     => 'switch',
                        'title'    => esc_html__('Category base remove in AMP', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Category base removal in <code>AMP</code> from url', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,
                        
                    ),
					//Tag base Removal in AMP
					array(
                        'id'       => 'ampforwp-tag-base-removal-link',
                        'type'     => 'switch',
                        'title'    => esc_html__('Tag base remove in AMP', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Tag base remove in <code>AMP</code> from url', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,
                        
                    ),
                    
                    // Featured Image from Custom Fields
                    array(
                        'id'       => 'ampforwp-custom-fields-featured-image-switch',
                        'type'     => 'switch',
                        'title'    => esc_html__('Featured Image from Custom Fields', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('This will allow you to add Featured Image from Custom Fields', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                    array(
                       'id'       => 'ampforwp-custom-fields-featured-image',
                       'type'     => 'text',
                       'title'    => esc_html__('Custom Field For Featured Image', 'accelerated-mobile-pages'),
                       'default'  => esc_html__ ('','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('Write the Custom Field of Featured Image','accelerated-mobile-pages'),
                       'required' => array( 'ampforwp-custom-fields-featured-image-switch', '=' , 1 )
                   ),
                    // Grab the First Image for Featured Image if there is none
                    array(
                        'id'       => 'ampforwp-featured-image-from-content',
                        'type'     => 'switch',
                        'title'    => esc_html__('Featured Image from The Content', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Show the first image of the content as Featured Image if there is no featured image', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                    // Duplicate Featured Image
                    array(
                        'id'       => 'ampforwp-duplicate-featured-image',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show Featured Image if already preset in content.', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Turn On the support if you want to show the Featured Image if it already exists in post content.', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                    // DEFAULT FALLBACK IMAGE
                    array(
                        'id'       => 'ampforwp_default_fallback_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => esc_html__('Default Fallback Image', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'=>esc_html__('Update the image you want show as default fallback image)', 'accelerated-mobile-pages'),
                        'default' => array('url' => AMPFORWP_IMAGE_DIR . '/SD-default-image.png' ),
                    ),
                    // Retina Images
                    array(
                        'id'       => 'ampforwp-retina-images',
                        'type'     => 'switch',
                        'title'    => esc_html__('Retina Images', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Enable if your current images looking blured on Apple Devices.', 'accelerated-mobile-pages'),
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
                        'title'    => esc_html__('Retina Images Resolution', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Select the Resolution', 'accelerated-mobile-pages'),
                        'default'   => '2',   
                        'required' => array('ampforwp-retina-images', '=', 1)
                    ),
                    array(
                        'id'       => 'amp-meta-permissions',
                        'type'     => 'select',
                        'title'    => esc_html__('Show Metabox in Post Editor to', 'accelerated-mobile-pages'),
                        'options'  => array(
                            'all'       => 'All users who can post',
                            'admin'     => 'Only to Admin'
                        ),
                        'default'  => 'all',
                    ),
                     array(
                        'id'       => 'ampforwp-development-mode',
                        'type'     => 'switch',
                        'title'    => esc_html__('Dev Mode in AMP'),
                        'tooltip-subtitle' => esc_html__('This will enable the Development mode in AMP', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ),
                      array(
                        'id'       => 'ampforwp-development-mode-notice',
                        'type'     => 'info',
                        'style'    => 'info',
                        'desc'     => esc_html__('Add /amp at the end of url to view the AMP version of the site. Search Engines will not be able to Crawl the AMP site when in Dev Mode.', 'accelerated-mobile-pages'),
                        'title'    => esc_html__('Dev Mode', 'accelerated-mobile-pages'),
                        'required' => array('ampforwp-development-mode', '=', 1)
                    ),
                      
                    array(
                        'id'       => 'ampforwp-wptexturize',
                        'type'     => 'switch',
                        'title'    => esc_html__('Disable wptexturize'),
                        'tooltip-subtitle' => esc_html__('Enable this option to Disable wptexturize Globally', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 0,                        
                    ), 
                    array(
                        'id'      => 'ampforwp-role-based-access',
                        'type'    => 'select',
                        'class'   => $show_for_admin,
                        'title'   => esc_html__('Role Based Access', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'   => esc_html__('Allows Administrator to show AMP Options based on User Role.', 'accelerated-mobile-pages'),
                        'multi'   => true,
                        'options' => ampforwp_get_user_roles(),
                        'default'  => ampforwp_default_user_roles()
                    ),
                    // Delete Data on Deletion
                    array(
                        'id'       => 'ampforwp-delete-on-uninstall',
                        'type'     => 'switch',
                         'title'    => esc_html__('Delete Data on Uninstall?', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'tooltip-subtitle'      => esc_html__('Enable this if you would like AMPforWP to completely remove all of its data when uninstalling via Plugins > Delete.'),
                    ),
   ),

) );

// WooCommerce Compatibility
$e_commerce_support[] =  array(
            'id' => 'ampforwp-woocommerce',
            'type' => 'section',
            'title' => esc_html__('WooCommerce Compatibility', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          );
$e_commerce_support[] =  array(
               'id'        =>'amp-enable-woocommerce',
               'type'      => 'switch',
               'title'     => esc_html__('WooCommerce Support', 'accelerated-mobile-pages'),
               'default'   => '',
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           );
    if(!function_exists( 'amp_woocommerce_add_woocommerce_support' ) && !function_exists( 'amp_woocommerce_pro_container_starts' ) ){
        $e_commerce_support[]= array(
            'id'   => 'info_normal_woocommerce',
            'type' => 'info',
            'required' => array('amp-enable-woocommerce', '=' , '1'),
             'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/woocommerce/" target="_blank">AMP WooCommerce PRO extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/woocommerce/" target="_blank">'.esc_html__('Click here for more info','accelerated-mobile-pages').'</a>)</div></div>',
             );
    }
    elseif ( function_exists( 'amp_woocommerce_add_woocommerce_support' ) && !function_exists( 'amp_woocommerce_pro_container_starts' ) ) {

        $e_commerce_support[]= array(
            'id'   => 'info_normal_woocommerce_pro',
            'type' => 'info',
            'required' => array('amp-enable-woocommerce', '=' , '1'),
            'desc' =>sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>%s</b> %s<a href="https://ampforwp.com/wpml-for-amp/" target="_blank"> %s</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/wpml-for-amp/" target="_blank">%s</a>)</div></div>',
                   esc_html__('ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),
                   esc_html__('This feature requires','accelerated-mobile-pages'),
                   esc_html__('WPML extension','accelerated-mobile-pages'),
                   esc_html__('Click here for more info','accelerated-mobile-pages')
             ),             
            );
    }
    elseif ( function_exists( 'amp_woocommerce_pro_container_starts' ) ) {
        $e_commerce_support[]= array(
            'id'   => 'info_woocommerce_pro',
            'type' => 'info',
            'style' => 'success',
            'required' => array('amp-enable-woocommerce', '=' , '1'),
            'desc'     => esc_html__(' AMP WooCommerce is activated', 'accelerated-mobile-pages'),           
        );
    }
 // EDD Compatibility
$e_commerce_support[] =  array(
            'id' => 'ampforwp-edd-compatibility',
            'type' => 'section',
            'title' => esc_html__('Easy Digital Downloads Compatibility', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          );
$e_commerce_support[] = array(
               'id'        =>'amp-edd-support',
               'type'      => 'switch',
               'title'     => esc_html__('Easy Digital Downloads Support', 'accelerated-mobile-pages'),
               'default'   => '',
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           );
    if(!is_plugin_active( 'edd-for-amp/edd-for-amp.php' ) ){
        $e_commerce_support[]= array(
                        'id'   => 'info_normal_edd',
                        'type' => 'info',
                        'required' => array('amp-edd-support', '=' , '1'),
                        'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/edd-for-amp/" target="_blank">EDD for AMP extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/edd-for-amp/" target="_blank">'.esc_html__('Click here for more info','accelerated-mobile-pages').'</a>)</div></div>',               
           );}
 
   // E Commerce SECTION
   Redux::setSection( $opt_name, array(
       'title'      => esc_html__( 'E-Commerce', 'accelerated-mobile-pages' ),
       'id'         => 'amp-e-commerce',
       'subsection' => true,
       'fields'     => $e_commerce_support
   ) );
   
   // Translation Panel
           Redux::setSection( $opt_name, array(
               'title'      => esc_html__( 'Translation Panel', 'accelerated-mobile-pages' ),
               'desc'       => esc_html__( 'Please translate the following words of page accordingly else default content is in English Language', 'accelerated-mobile-pages' ),
               'id'         => 'amp-translator',
               'subsection' => true,
               'fields'     => array(
                   array(
                       'id'       => 'amp-use-pot',
                       'type'     => 'switch',
                       'title'    => esc_html__('Use POT file method of Translation', 'accelerated-mobile-pages'),
                       'tooltip-subtitle' => esc_html__('Else you can use normal translation method', 'accelerated-mobile-pages'),
                       'desc'     => esc_html__('Use this if you want Multilingual Translations', 'accelerated-mobile-pages'),
                       'default'  => 0
                   ),
                   array(
                       'id'       => 'amp-translator-breadcrumbs-homepage-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Breadcrumbs Homepage Title', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Homepage','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-fourohfour',
                       'type'     => 'text',
                       'title'    => esc_html__('404 Error', 'accelerated-mobile-pages'),
                       'default'  => esc_html__("Oops! That page can't be found.","accelerated-mobile-pages"),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-more-posts-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Show more Posts', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Show more Posts','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-previous-posts-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Show previous Posts', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Show previous Posts','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-top-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Top', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Top','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-non-amp-page-text',
                       'type'     => 'text',
                       'title'    => esc_html__('View Non-AMP Version', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('View Non-AMP Version','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-related-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Related Post', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Related Post','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-incontent-related-text',
                       'type'     => 'text',
                       'title'    => esc_html__('In-Content Related Post', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Related Post','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-recent-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Recent Posts', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Recent Posts','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-navigate-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Navigate', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Navigate','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-on-text',
                       'type'     => 'text',
                       'title'    => esc_html__('On', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('On','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-next-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Next', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Next','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-previous-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Previous', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Previous','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-page-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Page', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Page','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archives-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Archives', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Archives','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-breadcrumbs-search-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Search results for', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Search results for','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-footer-text',
                       'type'     => 'textarea',
                       'title'    => esc_html__('Footer', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('All Rights Reserved','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 ),
                       'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                    esc_html__('If you want to add the current year then use this shortcode [ampforwp_current_year] and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-current-year-in-amp-footer/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                   ),
                   array(
                       'id'       => 'amp-translator-categories-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Categories', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Categories: ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-tags-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Tags', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Tags: ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-by-text',
                       'type'     => 'text',
                       'title'    => esc_html__('By', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('By','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-published-by',
                       'type'     => 'text',
                       'title'    => esc_html__('Published by', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Published by','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-in-designthree',
                       'type'     => 'text',
                       'title'    => esc_html__('in', 'accelerated-mobile-pages'),
                       'default'  =>esc_html__( 'in','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-view-comments-text',
                       'type'     => 'text',
                       'title'    => esc_html__('View Comments', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('View Comments','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-leave-a-comment-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Leave a Comment', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Leave a Comment','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-comments-closed',
                       'type'     => 'text',
                       'title'    => esc_html__('Comments are closed.', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Comments are closed.','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-at-text',
                       'type'     => 'text',
                       'title'    => esc_html__('at', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('at','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-says-text',
                       'type'     => 'text',
                       'title'    => esc_html__('says', 'accelerated-mobile-pages'),
                       'default'  =>esc_html__( 'says','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-Edit-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Edit', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Edit','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-ago-date-text',
                       'type'     => 'text',
                       'title'    => esc_html__('ago', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('ago','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-published-date-text',
                       'type'     => 'text',
                       'title'    => esc_html__('This post was published on ', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('This post was published on ','accelerated-mobile-pages'),
                       'placeholder'=> esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-modified-date-text',
                       'type'     => 'text',
                       'title'    => esc_html__('This post was last modified on ', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('This post was last modified on ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archive-cat-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Category (archive title)', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Category: ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archive-tag-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Tag (archive title)', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Tag: ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-more-text',
                       'type'     => 'text',
                       'title'    => esc_html__('View More Posts (Widget Button)', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('View More Posts','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                    array(
                       'id'       => 'amp-translator-next-read-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Next Read', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Next Read: ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                    array(
                       'id'       => 'amp-translator-read-more',
                       'type'     => 'text',
                       'title'    => esc_html__('Read More', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Read More','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                    ),
                    array(
                       'id'       => 'amp-translator-via-text',
                       'type'     => 'text',
                       'title'    => esc_html__('via', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('via','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                     array(
                       'id'       => 'amp-translator-share-text',
                       'type'     => 'text',
                       'title'    => esc_html__('Share', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Share','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-search-text',
                       'type'     => 'text',
                       'title'    => esc_html__(' You searched for: ', 'accelerated-mobile-pages'),
                       'default'  => esc_html__(' You searched for: ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-search-no-found',
                       'type'     => 'text',
                       'title'    => esc_html__(' It seems we can\'t find what you\'re looking for. ', 'accelerated-mobile-pages'),
                       'default'  => esc_html__(' It seems we can\'t find what you\'re looking for. ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                     array(
                       'id'       => 'amp-translator-and-text',
                       'type'     => 'text',
                       'title'    => esc_html__(' and ', 'accelerated-mobile-pages'),
                       'default'  => esc_html__(' and ','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id' => 'design-3-search-subsection',
                       'type' => 'section',
                       'title' => esc_html__('Search bar Translation Text', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'required' => array( 'amp-use-pot', '=' , 0 ),
                       'layout_type' => 'accordion',
                        'accordion-open'=> 0,
                   ),
                   array(
                      'id'       => 'ampforwp-search-placeholder',
                      'type'     => 'text',
                      'title'    => esc_html__('Type Here', 'accelerated-mobile-pages'),
                      'default'  => esc_html__('Type Here','accelerated-mobile-pages'),
                      'desc' => esc_html__('This is the text that gets shown in for Search Box','accelerated-mobile-pages'),
                      'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                      'required' => array( 'amp-use-pot', '=' , 0 )
                  ),
                array(
                      'id'       => 'ampforwp-search-widget-label',
                      'type'     => 'text',
                      'title'    => esc_html__('Search Widget Label', 'accelerated-mobile-pages'),
                      'default'  => esc_html__('Search for:','accelerated-mobile-pages'),
                      'desc' => esc_html__('This is the text that gets shown as Search Box Label','accelerated-mobile-pages'),
                      'required' => array(
                                        array( 'amp-use-pot', '=' , 0 ),
                                        array('amp-design-selector', '!=' , '4')
                                    )
                  ),
                  array(
                     'id'       => 'ampforwp-search-label',
                     'type'     => 'text',
                     'title'    => esc_html__('Type your search query and hit enter', 'accelerated-mobile-pages'),
                     'desc' => esc_html__('This is the text that gets shown above Search Box','accelerated-mobile-pages'),
                     'default'  => esc_html__('Type your search query and hit enter: ','accelerated-mobile-pages'),
                     'placeholder'=>esc_html__('write here','accelerated-mobile-pages'),
                     'required' => array(
                                        array( 'amp-use-pot', '=' , 0 ),
                                        array('amp-design-selector', '!=' , '4')
                                    )

                 )
    ) ));


// Appearance Section
Redux::setSection( $opt_name, array(
              'title'      => esc_html__( 'Design', 'accelerated-mobile-pages' ),
              'icon' => 'el el-adjust-alt',
              'desc'  => '',
              'class'  =>'amp-opt-design',
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
				'title'=>esc_html__('Design One', 'accelerated-mobile-pages' ),
				'value'=>1,
				'alt'=>esc_html__('Design One', 'accelerated-mobile-pages' ),
				'img'=>AMPFORWP_PLUGIN_DIR_URI.'/images/design-1.png',
			),
			array(
                'demo_link' => 'https://ampforwp.com/demo/#two',
				'upgrade'=>true,
				'title'=>esc_html__('Design Two', 'accelerated-mobile-pages' ),
				'value'=>2,
				'alt'=>esc_html__('Design Two', 'accelerated-mobile-pages' ),
				'img'=>AMPFORWP_PLUGIN_DIR_URI.'/images/design-2.png',
			),
			array(
                'demo_link' => 'https://ampforwp.com/demo/#three',
				'upgrade'=>true,
				'title'=>esc_html__('Design Three', 'accelerated-mobile-pages' ),
				'value'=>3,
				'alt'=>esc_html__('Design Three', 'accelerated-mobile-pages' ),
				'img'=>AMPFORWP_PLUGIN_DIR_URI.'/images/design-3.png',
			),
            array(
                'demo_link' => 'https://ampforwp.com/demo/amp-pagebuilder/amp/',
                'upgrade' => true,
                'title' => esc_html__('Swift', 'accelerated-mobile-pages' ),
                'value' => 4,
                'alt' => esc_html__('Swift', 'accelerated-mobile-pages' ),
                'img' => AMPFORWP_PLUGIN_DIR_URI.'/images/swift.png',
            ),
        );
    
    $pluginsData = array();
    $pluginsData = get_transient( 'ampforwp_themeframework_active_plugins' );
    if( empty( $pluginsData )){
        $activePlugins = get_option( 'active_plugins', array() );
        if(is_multisite()){
            $activePlugins_multi = get_site_option('active_sitewide_plugins'); 
            $activePlugins_multi = array_keys($activePlugins_multi); 
            $activePlugins = array_merge($activePlugins, $activePlugins_multi); 
        }
        if(count( $activePlugins)>0){
            foreach ( $activePlugins as $key => $value) {
                $plugin = get_plugin_data(WP_PLUGIN_DIR.'/'.$value);
                if(!empty($plugin['AMP'])){//$plugin['AMP']
                    $imageUrl = '';
                    if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR.$plugin['TextDomain'].'/screenshot.png')){
                        $imageUrl = plugins_url($plugin['TextDomain'].'/screenshot.png');
                    }
                    $pluginsData[$plugin['TextDomain']] = array(
                        'demo_link' => esc_html($plugin['AMP Demo']),
                        'upgrade'   => true,
                        'title'     => $plugin['AMP'],
                        'value'     => esc_html($plugin['TextDomain']),
                        'alt'       => esc_attr($plugin['AMP']),
                        'img'       => esc_url($imageUrl),
                    );
                }
            }
            set_transient( 'ampforwp_themeframework_active_plugins', $pluginsData );
        }
    }
    if ( is_array($pluginsData) ) {
        $themeDesign =  array_merge($themeDesign, $pluginsData);
    }
    $themeDesign = apply_filters( 'ampforwp_themeframe_available_designs', $themeDesign );

    // Themes Section
 Redux::setSection( $opt_name, array(
                'title'      => esc_html__( 'Themes', 'accelerated-mobile-pages' ),                'class' => 'ampforwp-new-element',

        'id'         => 'amp-theme-settings',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'amp-design-selector',
                'class' => 'amp-design-selector',
                'type'     => 'demolink_image_select',
                'title'    => esc_html__( 'Themes Selector', 'accelerated-mobile-pages' ),
                'subtitle' => esc_html__( 'Select your design from dropdown', 'accelerated-mobile-pages' ).' or <br /><a href="https://ampforwp.com/themes/" style="position: relative;
    top: 20px;text-decoration: none;
    background: #eee;padding: 5px 8px 5px 9px;
    border-radius: 30px;" target="_blank">View More AMP Themes →</a>',
                'options'  => $themeDesign,
                'default'  => '4'
                ),
            array(
                'id'       => 'ampforwp_layouts_core',
                'type'     => 'raw',
                'subtitle'     => '<a class="amp-layouts-desc" href="https://ampforwp.com/amp-layouts/" target="_blank">What is Layouts?</a>',
                'title'    => esc_html__('AMP Layouts', 'accelerated-mobile-pages'),
                'required' => array('amp-design-selector', '=' , '4'),
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
                'required' => array('amp-design-selector', '!=' , 'amp-theme-framework-master'),
                'desc' => $amptfad
            ),            
            )
        ) );
/*---------------------*/

    $amp_fontparts = array(
            array(
                       'id' => 'colorscheme-section',
                       'type' => 'section',
                       'title' => esc_html__('Color Scheme', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            // Swift
            array(
                    'id'        => 'swift-color-scheme',
                    'title'     => esc_html__('Global Color Scheme', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => esc_html__('Choose the color for title, anchor link','accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                    'color'      => '#005be2',
                     ),
                    'required' => array(
                        array('amp-design-selector', '=' , '4')
                     )
            ),
            array(
                    'id'        => 'swift-hover-color-scheme',
                    'title'     => esc_html__('Hover Color Scheme', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => esc_html__('Choose the color when hover for title, anchor links','accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                    'color'      => '#005be2',
                     ),
                    'required' => array(
                        array('amp-design-selector', '=' , '4')
                     )
            ),
            array(
                    'id'        => 'swift-btn-hover-color-scheme',
                    'title'     => esc_html__('Button Hover Color', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => esc_html__('Choose the color when hover for Button','accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                    'color'      => '#fff',
                     ),
                    'required' => array(
                        array('amp-design-selector', '=' , '4')
                     )
            ),
             array(
                    'id'        => 'amp-opt-color-rgba-colorscheme',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Color Scheme','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#AD0B15',
                    ),
                    'required' => array(
                        array('amp-design-selector', '=' , '3')
                     )
              ),
             array(
                    'id'        => 'amp-opt-color-rgba-font',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Color Scheme Font Color','accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Anchor Link Color','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#AD0B15',
                    ),
                    'required' => array(
                        array('amp-design-selector', '=' , '3')
                    )
              ), 
             // Design 2
             array(
                    'id'        => 'amp-opt-color-rgba-link-design2',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Anchor Link Color','accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Anchor Link Color','accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Call Button Color','accelerated-mobile-pages'),
                    'default'   => array(
                    'color'     => '#0a89c0',
                    ),
                    'required' => array(
                        array('ampforwp-callnow-button', '=' , '1')
                    )
             ),
               array(
                    'id'    => 'mobile-theme-color',
                    'type'  => 'switch',
                    'title' => esc_html__('Mobile Theme Color', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => esc_html__('Enable this option to Choose mobile theme color','accelerated-mobile-pages'),
                    'default'   => 0,
            ),
            array(
                    'id'        => 'mobile-theme-color-picker',
                    'class' => 'child_opt child_opt_arrow',
                    'title'     => esc_html__('Theme Color', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => esc_html__('Choose the Mobile theme color color','accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                        'color'  => '#ffffff',
                         ),
                    'required' => array(
                        array('mobile-theme-color','=',1)
                      )
              ), 
               array(
                           'id' => 'typography-section',
                           'type' => 'section',
                           'title' => esc_html__('Typography', 'accelerated-mobile-pages'),
                           'indent' => true,
                            
                            'layout_type' => 'accordion',
                            'accordion-open'=> 1,
                ));
    if(ampforwp_levelup_compatibility('levelup_theme')){

        $fonts_settings[] = array(
                'id'       => 'ampforwp_page_levelup_manage_fonts',
                'type'     => 'raw',
                'desc' => 'Levelup theme using default fonts. <a href="'.admin_url( '/customize.php?autofocus[section]=theme_field_settings' ).'">Manage fonts</a>'
            );
       $amp_fontparts = array_merge($amp_fontparts ,$fonts_settings);    

    }else{
        $selectedOption = (array) get_option('redux_builder_amp',true);
        if(!isset($selectedOption['amp-design-selector'])){
            $selectedOption['amp-design-selector'] = '4';
        }
        $googleSupportFontEnabled = array('1','2','3','4');
        $googleSupportFontEnabled = apply_filters( 'amp_theme_font_support',  $googleSupportFontEnabled);
        $enabledGoogleFonts = false;
        if(in_array($selectedOption['amp-design-selector'], $googleSupportFontEnabled) ){
            $enabledGoogleFonts = true;
        }
        $fonts_settings =  array(
            array(
                       'id' => 'ampforwp-d1-font',
                       'type' => 'switch',
                       'title' => esc_html__('Merriweather Font', 'accelerated-mobile-pages'),
                       'tooltip-subtitle'  => esc_html__('Enable/Disable Merriweather Font','accelerated-mobile-pages'),
                        'default'   => true,
                        'required' => array(
                            array('amp-design-selector', '=' , '1')
                         )
            ),
            array(
               'id' => 'ampforwp-google-font-switch',
               'type' => 'switch',
               'title' => esc_html__('Google Fonts', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('Enable/Disable Google Font','accelerated-mobile-pages'),
                'default'   => $enabledGoogleFonts,
            ),
            array(
                'id'        =>'google_font_api_key',
                'type'      =>'text',
                'title'     =>esc_html__('Google Font API key','accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('You can get the Link ','accelerated-mobile-pages').'<a target="_blank" href="https://developers.google.com/fonts/docs/developer_api?refresh=1&pli=1#APIKey">'.esc_html__('form here','accelerated-mobile-pages').'</a>',
                'default'   =>'',
                'required' => array(
                    array('ampforwp-google-font-switch', '=', '1')
                 )
            ),
            array(
                'id'       => 'amp_font_selector',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-families',
                'title'    => esc_html__( 'Global Font Family ', 'accelerated-mobile-pages' ),
                'tooltip-subtitle' => esc_html__( 'Select your design from dropdown or ', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'None',
                ),
                'default'  => '',
                'required' => array(
                    array('ampforwp-google-font-switch', '=', '1')
                )

            ),
            array(
                'id'       => 'amp_font_type',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-family-weights',
                'multi'    => true,
                'title'    => esc_html__( 'Global Font Weight Selector', 'accelerated-mobile-pages' ),
                'tooltip-subtitle' => esc_html__( 'Select your design from dropdown', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'none',
                ),
                'default'  => '',
                'required' => array(
                    array('ampforwp-google-font-switch', '=', '1')
                )

            ),
            array(
                'id'        =>'google_current_font_data',
                'type'      =>'text',
                'class'     => 'hide',
                'title'     =>esc_html__('Google Font Current Font','accelerated-mobile-pages'),
                'default'   =>'',
                'required' => array(
                    array('ampforwp-google-font-switch', '=', '1')
                )
            ),
            array(
                    'id'       => 'content-font-family-enable',
                    'type'     => 'switch',
                    'class'    => 'ampforwp-google-font-class secondary-font-selector',
                    'title'    => sprintf('%s', esc_html__( $secondary_text . 'Font Selector', 'accelerated-mobile-pages' ) ),
                    'default'  => '0' ,
                    'required' => array(
                        array('ampforwp-google-font-switch', '=', '1')
                    )   
            ),
            array(
                'id'       => 'amp_font_selector_content_single',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-families secondary-font-family-selector',
                'title'    => sprintf('%s', esc_html__( $secondary_text.' Font Family Selector', 'accelerated-mobile-pages') ),
                'tooltip-subtitle' => esc_html__( 'Select your design from dropdown or ', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'None',
                ),
                'default'  => '',
                'required' => array(
                    array('ampforwp-google-font-switch', '=', '1'),
                    array('content-font-family-enable', '=' , '1')
                )

            ),
            array(
                'id'       => 'amp_font_type_content_single',
                'type'     => 'select',
                'class'    => 'ampforwp-google-font-class ampwp-font-family-weights secondary-font-family-weights',
                'multi'    => true,
                'title'    => sprintf('%s',  esc_html__( $secondary_text. ' Font Family Weight Selector', 'accelerated-mobile-pages' ) ),
                'tooltip-subtitle' => esc_html__( 'Select your design from dropdown', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => 'none',
                ),
                'default'  => '',
                'required' => array(
                    array('ampforwp-google-font-switch', '=', '1'),
                    array('content-font-family-enable', '=' , '1')
                )

            ),
            array(
                'id'        =>'google_current_font_data_content_single',
                'type'      =>'text',
                'class'     => 'hide',
                'title'     =>esc_html__('Google Font Current Font','accelerated-mobile-pages'),
                'default'   =>'',
                'required' => array(
                    array('ampforwp-google-font-switch', '=', '1'),
                )
            ),
            array(
               'id' => 'ampforwp-local-font-switch',
               'type' => 'switch',
               'title' => esc_html__('Local Fonts', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('Enable/Disable Local Font','accelerated-mobile-pages'),
                'default'   => '',
            ),
            array(
               'id' => 'ampforwp-local-font-upload',
               'type' => 'media',
               'url'      => true,
               'mode'      => 'zip',
               'class'    => 'child_opt child_opt_arrow',
               'title' => esc_html__('Upload Local Font', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('Upload Local Font','accelerated-mobile-pages'),
               'required' => array('ampforwp-local-font-switch', '=', '1'),
                'default' => '',
            ),
        );
            $amp_fontparts = array_merge($amp_fontparts ,$fonts_settings);   
    }
    if( function_exists('ampforwp_custom_theme_files_register') ){
       global $redux_builder_amp;
       $newspaper_theme_checker = '';
       $newspaper_theme_checker = ampforwp_get_setting('ampforwp-infinite-scroll-home');
       if($newspaper_theme_checker){
           $redux_builder_amp['ampforwp-infinite-scroll-home'] = false;
           update_option( 'redux_builder_amp', $redux_builder_amp );
       }
    }
    if( !function_exists('ampforwp_custom_theme_files_register') ){
        $newspaper_theme_check = array(
                        'id'       => 'ampforwp-infinite-scroll-home',
                        'type'     => 'switch',
                        'class'    => 'child_opt child_opt_arrow',
                        'title'    => esc_html__('Home & Archives', 'accelerated-mobile-pages'),
                        'default' => true,
                        'required' => array( 'ampforwp-infinite-scroll', '=' , 1 )
                    );
    }
    $global_settings = array(
                array(
                       'id' => 'general_sdbar',
                       'type' => 'section',
                       'title' => esc_html__('General', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
              array(
                        'id'    => 'gnrl-sidebar',
                        'type'  => 'switch',
                        'title' => esc_html__('Sidebar', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option if you want a sidebar in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-setup-sidebar-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                        'required' => array( array('amp-design-selector', '=' , '4') ),
                ),
              array(
                        'id'    => 'gbl-sidebar',
                        'class' => 'child_opt child_opt_arrow',
                        'type'  => 'switch',
                        'title' => esc_html__('Homepage Sidebar', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array( array('gnrl-sidebar', '=' , '1') ),
                ),
                array(
                        'id'    => 'swift-sidebar',
                        'class' => 'child_opt child_opt_arrow',
                        'type'  => 'switch',
                        'title' => esc_html__('Single Sidebar', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('gnrl-sidebar', '=' , '1'), 
                                    
                ),
                array(
                      'id'       => 'page_sidebar',
                      'class' => 'child_opt child_opt_arrow',
                      'type'     => 'switch',
                      'title'    => esc_html__('Page Sidebar', 'accelerated-mobile-pages'),
                      'default'  =>  '0',
                      'required' => array('gnrl-sidebar', '=' , '1'), 
                  ),
                array(
                        'id'        => 'sidebar-bgcolor',
                        'class' => 'child_opt child_opt_arrow',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Sidebar Background','accelerated-mobile-pages'),
                        'default'   => array(
                            'color'     => '#f7f7f7',
                        ),
                        'required' => array( array('gnrl-sidebar', '=',1) )
                ),
                array(
                        'id'       => 'sbr-heading-color',
                        'type'     => 'color_rgba',
                        'class' => 'child_opt',
                        'title'    => esc_html__('Heading', 'accelerated-mobile-pages'),
                        'default'  => array(
                            'color'     => '#333',
                        ),
                        'required' => array(
                          array('gnrl-sidebar','=',1)
                        )           
                ),
                array(
                        'id'       => 'sbr-text-color',
                        'type'     => 'color_rgba',
                        'class' => 'child_opt',
                        'title'    => esc_html__('Text', 'accelerated-mobile-pages'),
                        'default'  => array(
                            'color'     => '#333',
                        ),
                        'required' => array(
                          array('gnrl-sidebar','=',1)
                        )           
                ),
                array(
                        'id'       => 'ampforwp-infinite-scroll',
                        'type'     => 'switch',
                        'title'    => esc_html__('Infinite Scroll (Experimental)', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a>', esc_html__('Read more about it', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/infinite-scroll-feature-in-amp/'), esc_html__('here:','accelerated-mobile-pages')),
                        'default' => false,
                    ),
                    $newspaper_theme_check,
                    array(
                        'id'       => 'ampforwp-infinite-scroll-single',
                        'type'     => 'switch',
                        'class'    => 'child_opt child_opt_arrow',
                        'title'    => esc_html__('Single', 'accelerated-mobile-pages'),
                        'default' => true,
                        'required' => array( 'ampforwp-infinite-scroll', '=' , 1 )
                    ),
                    array(
                        'id'       => 'ampforwp-infinite-scroll-single-category',
                        'type'     => 'switch',
                        'class'    => 'child_opt child_opt_arrow',
                        'title'    => esc_html__('Same Category', 'accelerated-mobile-pages'),
                        'default' => false,
                         'required' => array(
                                        array('ampforwp-infinite-scroll', '=' , '1'),
                                        array('ampforwp-infinite-scroll-single', '=' , '1')
                                    ),
                    ),
                    array(
                        'id'       => 'ampforwp-infinite-scroll-single-tag',
                        'type'     => 'switch',
                        'class'    => 'child_opt child_opt_arrow',
                        'title'    => esc_html__('Same Tag', 'accelerated-mobile-pages'),
                        'default' => false,
                         'required' => array(
                                        array('ampforwp-infinite-scroll', '=' , '1'),
                                        array('ampforwp-infinite-scroll-single', '=' , '1')
                                    ),
                    ),
                array(
                       'id' => 'google-icons',
                       'type' => 'section',
                       'title' => esc_html__('Font Icon Library', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                        'required' => array( array('amp-design-selector', '=' , '4') ),
                ),
                array(
                    'id'       => 'ampforwp_font_icon',
                    'type'     => 'select',
                    'title'    => esc_html__('Font Icon Library', 'accelerated-mobile-pages'),
                    'options'  => array(
                        'swift-icons'       => 'Swift Icons',
                        'fontawesome-icons'     => 'Font Awesome Icons',
                        'css-icons' => 'CSS Icons'
                    ),
                    'default'  => 'swift-icons',
                ),
                array(
                           'id' => 'design-advanced',
                           'type' => 'section',
                           'title' => esc_html__('Advanced', 'accelerated-mobile-pages'),
                           'indent' => true,
                           'layout_type' => 'accordion',
                            'accordion-open'=> 1,
                ),
                array(
                        'id'       => 'css_editor',
                        'type'     => 'ace_editor',
                        'title'    => esc_html__('Custom CSS', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('You can customize the Stylesheet of the AMP version by using this option.', 'accelerated-mobile-pages'),
                        'mode'     => 'css',
                        'theme'    => 'monokai',
                        'desc'     => '',
                        'default'  => ''
                ),
            );
    $amp_fontparts = array_merge($amp_fontparts ,$global_settings); 
    // Global Theme Settings
    Redux::setSection($opt_name, array(
        'title'      => esc_html__( 'Global', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-global-subsection',
        'subsection' => true,
        'fields'     => $amp_fontparts
    ));

    // Header Elements default Color
    function ampforwp_get_element_default_color() {
        $option = $default_value = '';
        $option = ampforwp_get_setting('amp-opt-color-rgba-colorscheme');
        if ( !empty($option['color']) ) {
            $default_value = $option['color'];
        }
        if ( empty( $default_value ) ) {
          $default_value = '#333';
        }
      return $default_value;
    }

  // Header Section
  Redux::setSection( $opt_name, array(
                'title'      => esc_html__( 'Header', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-header-settings',
        'subsection' => true,
        'tab'       => true,
        'fields'     => array(
            // Swift
            // Tab 1
           array(
                       'id' => 'header_section_1',
                       'type' => 'section',
                       'title' => esc_html__('Header Design', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                        'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'    => 'header-type',
                   'title'  => esc_html__('Header Type', 'accelerated-mobile-pages'),
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
                   'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
           array(
                       'id' => 'header_section_2',
                       'type' => 'section',
                       'title' => esc_html__('Navigation Menu Design', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            array(
                    'id'       => 'ampforwp-amp-menu-swift',
                    'type'     => 'switch',
                    'title'    => esc_html__('Navigation Menu', 'accelerated-mobile-pages'),
                    'required' => array('amp-design-selector', '=' , '4'),
                    'default'  => '1'         
            ),
            array(
                    'id'    => 'menu-type',
                   'title'  => esc_html__('Menu Type', 'accelerated-mobile-pages'),
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Menu overlay 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/menu-1.png'
                                ),
                    ),
                   'default'=> '1',
                    'required' =>   array(
                                        array('amp-design-selector', '=' , '4'),
                                        array('ampforwp-amp-menu-swift', '=' , '1')
                                    ),
             ),
            array(
                    'id'       => 'menu-search',
                    'type'     => 'switch',
                    'title'    => esc_html__('Menu Search', 'accelerated-mobile-pages'),
                    'required' =>   array(
                                        array('amp-design-selector', '=' , '4'),
                                        array('ampforwp-amp-menu-swift', '=' , '1')
                                    ),
                    'default'  => '1'         
            ),
            array(
                    'id'       => 'menu-search-after-menu',
                    'class'    => 'child_opt child_opt_arrow',
                    'type'     => 'switch',
                    'title'    => esc_html__('After Menu', 'accelerated-mobile-pages'),
                    'required' => array('menu-search', '=' , '1'),
                    'default'  => '1'         
            ),
            array(
                    'id'       => 'menu-search-before-menu',
                    'class'    => 'child_opt child_opt_arrow',
                    'type'     => 'switch',
                    'title'    => esc_html__('Before Menu', 'accelerated-mobile-pages'),
                    'required' => array('menu-search', '=' , '1'),
                    'default'  => '0'         
            ),
            array(
                'id'       => 'amp-swift-menu-cprt',
                'type'     => 'switch',
                'title'    => esc_html__( 'Menu Copyright', 'accelerated-mobile-pages' ),
                'required' => array(
                    array('amp-design-selector', '=' , '4'),
                    array('ampforwp-amp-menu-swift', '=' , '1')
                ),
                'default'  => '1'
            ),
            array(
                    'id'       => 'primary-menu',
                    'type'     => 'switch',
                    'title'    => esc_html__('Alternative Menu', 'accelerated-mobile-pages'),
                    'true'      => 'true',
                    'false'     => 'false',
                    'default'   => '1',
                    'required' => array( 
                                    array('amp-design-selector', '=' , '4'),
                                    array('ampforwp-amp-menu-swift', '=' , '1')
                                ),
            ),
            array(
                    'id'             => 'primary-menu-padding-control',
                    'type'           => 'spacing',
                    'output'         => array('.p-menu'),
                    'class' => 'child_opt child_opt_arrow',
                    'mode'           => 'padding',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Alt Menu Padding', 'accelerated-mobile-pages'),
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
                'title'     => esc_html__('Alt Menu Text', 'accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'rgba'  => 'rgba(53, 53, 53,1)',
                    ),
                    'required' => array(
                      array('primary-menu','=',1)
                    )  
              ),
            array(
                'class' => 'child_opt',
                'id'        => 'primary-menu-background-scheme',
                'title'     => esc_html__('Alt Menu Background', 'accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'rgba'  => 'rgba(239, 239, 239,1)',
                    ),
                    'required' => array(
                      array('primary-menu','=',1)
                    )  
              ),
            array(
                'id'       => 'drp-dwn',
                'type'     => 'switch',
                'class' => 'child_opt child_opt_arrow',
                'title'    => esc_html__('Dropdown Support', 'accelerated-mobile-pages'),
                'true'      => 'true',
                'false'     => 'false',
                'default'   => 0,
                'required' => array( array('primary-menu','=',1) ),
            ),
            array(
                'id'        => 'signin-button',
                'title'     => esc_html__('Call To Action', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('You can do the customization here ','accelerated-mobile-pages'),
                'type'      => 'switch',
                'default'   => '1',
                    'required' => array(
                      array('header-type','=',2)
                    )  
              ),
            array(
                'id'        => 'signin-button-text',
                 'class' => 'child_opt child_opt_arrow',
                'title'     => esc_html__('CTA Text', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('You can write your required text ','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => 'Sign up free',
                    'required' => array(
                      array('signin-button','=',1)
                    )  
              ),
            array(
                'id'        => 'signin-button-link',
                'class' => 'child_opt child_opt_arrow',
                'title'     => esc_html__('CTA Link', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('You can add the Link here ','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => '#',
                    'required' => array(
                      array('signin-button','=',1)
                    )  
              ),
            // CTA No Follow links
            array(
                'id'        =>  'ampforwp-header-cta-link-nofollow',
                'type'      =>  'switch',
                'class' => 'child_opt child_opt_arrow',
                'title'     =>  esc_html__('No Follow Link', 'accelerated-mobile-pages'),
                'default'   =>  0,
                'required' => array('signin-button', '=', '1')
            ),
            array(
                'id'        => 'signin-button-style',
                'class' => 'child_opt child_opt_arrow',
                'title'     => esc_html__('CTA Styles', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('You can change the button here','accelerated-mobile-pages'),
                'type'      => 'switch',
                'default'   => '0',
                    'required' => array(
                      array('signin-button','=',1)
                    )  
              ),
            array(
                'id'        => 'signin-button-new-tab',
                'class'     => 'child_opt child_opt_arrow',
                'title'     => esc_html__('New Tab', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('Open the button link in new tab','accelerated-mobile-pages'),
                'type'      => 'switch',
                'default'   => '1',
                'required'  => array('signin-button', '=', '1')
            ),
            array(
                'id'        => 'signin-button-border-line',
                'class' => 'child_opt child_opt_arrow',
                'title'     => esc_html__('CTA Border Line', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('You can change the button border line','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => '2',
                    'required' => array(
                      array('signin-button-style','=',1)
                    )  
              ),
            array(
                'id'        => 'signin-button-text-color',
                'class' => 'child_opt child_opt_arrow',
                'title'     => esc_html__('CTA Text Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('Choose the color for Button Text','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'color'  => '#000',
                    ),
                'required' => array(
                  array('signin-button-style','=',1)
                )  
            ),
            array(
                'id'        => 'signin-button-border-color',
                'class' => 'child_opt child_opt_arrow',
                'title'     => esc_html__('CTA Border Line Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('Choose the color for Button Border Line','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                     'color'  => '#000',
                    ),
                'required' => array(
                  array('signin-button-style','=',1)
                )  
            ),
            array(
                    'id'    => 'border-type',
                    'class' => 'child_opt child_opt_arrow',
                   'title'  => esc_html__('CTA Type', 'accelerated-mobile-pages'),
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
                'class' => 'child_opt child_opt_arrow',
                'title'     => esc_html__('Customize Border Radius', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('You can change the border radius','accelerated-mobile-pages'),
                'type'      => 'text',
                'default'   => '10',
                    'required' => array(
                      array('border-type','=',3)
                    )  
              ),
            array(
                    'id'    => 'cta-responsive-view',
                    'class' => 'child_opt child_opt_arrow',
                   'title'  => esc_html__('CTA Position on Mobile', 'accelerated-mobile-pages'),
                   'type'   => 'select',
                   'options'=> array(
                        '1' =>  'Header',
                        '2' =>  'Menu',
                    ),
                   'default'=> '1',
                   'required' => array( array('signin-button', '=' ,1) ),
            ),
             array(
                    'id'       => 'ampforwp-amp-menu',
                    'type'     => 'switch',
                    'title'    => esc_html__('Navigation Menu', 'accelerated-mobile-pages'),
                    'desc'       => sprintf( '%s <a href="%s" target="_blank">%s</a>',esc_html__( 'Add Menus to your AMP pages by clicking on this','accelerated-mobile-pages'), esc_url(trailingslashit(get_admin_url().'nav-menus.php?action=locations')),esc_html__('link','accelerated-mobile-pages')),
                    'tooltip-subtitle' => esc_html__('Enable/Disable Menu from header', 'accelerated-mobile-pages'),
                    'true'      => 'true',
                    'false'     => 'false',
                    'default'   => 1,
                    'required' => array(array('amp-design-selector', '!=' , '4')),

            ),
            // Design 1 Menu slider position option
            array(
                  'id'    => 'header-overlay-position-d1',
                  'title'  => esc_html__('Menu Overlay Position', 'accelerated-mobile-pages'),
                  'type'   => 'select',
                  'options'=> array(
                      '1' =>  'Right',
                      '2' =>  'Left'
                    ),
                    'default'=> '1',
                    'required' => array(
                        array('amp-design-selector', '=' , '1'),
                        array('ampforwp-amp-menu', '=' , '1')
                  )    
            ),
            // Design 2 Menu slide poistion option
            array(
                  'id'    => 'header-overlay-position-d2',
                  'title'  => esc_html__('Menu Overlay Position', 'accelerated-mobile-pages'),
                  'type'   => 'select',
                  'options'=> array(
                      '1' =>  'Right',
                      '2' =>  'Left'
                    ),
                    'default'=> '1',
                    'required' => array(
                        array('amp-design-selector', '=' , '2'),
                        array('ampforwp-amp-menu', '=' , '1')
                  )    
            ),
            // Design 3 Menu slider position option
            array(
                  'id'    => 'header-overlay-position-d3',
                  'title'  => esc_html__('Menu Overlay Position', 'accelerated-mobile-pages'),
                  'type'   => 'select',
                  'options'=> array(
                      '1' =>  'Left',
                      '2' =>  'Right'
                    ),
                    'default'=> '1',
                    'required' => array(
                        array('amp-design-selector', '=' , '3'),
                        array('ampforwp-amp-menu', '=' , '1')
                  )    
            ),
            
           array(
                       'id' => 'header_section_3',
                       'type' => 'section',
                       'title' => esc_html__('Header Settings', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            // Call Now button
             array(
                    'id'       => 'ampforwp-callnow-button',
                    'type'     => 'switch',
                    'title'    => esc_html__('Call Now Button', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Enter Phone Number', 'accelerated-mobile-pages'),
                    'default'   => '',
             ),
             array(
                    'id'        =>'amp-on-off-support-for-non-amp-home-page',
                    'type'      => 'switch',
                    'title'     => esc_html__('Non-AMP link in Header', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => esc_html__('If you want users in header to go to non-AMP website from the Header', 'accelerated-mobile-pages'),
                    'default'   => 0,
            ),
             array(
                    'id'        => 'amp-opt-sticky-head',
                    'type'      => 'switch',
                    'title'     => esc_html__('Make Header UnSticky','accelerated-mobile-pages'), 
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                    ),
                    'tooltip-subtitle'     => esc_html__('Turning it ON will remove the sticky head from the design.', 'accelerated-mobile-pages' ),
                    'default'  => '0'
            ),
             array(
                    'id'       => 'amp-design-3-search-feature',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '3')
                    ),
                    'default'  => '1'
            ),
             
             array(
                    'id'       => 'amp-design-2-search-feature',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '2')
                    ),
                    'default'  => '0'
            ),

             array(
                    'id'       => 'amp-design-1-search-feature',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '1')
                    ),
                    'default'  => '0'
            ),
            array(
                    'id'       => 'amp-swift-search-feature',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Search', 'accelerated-mobile-pages' ),
                    'required' => array(
                        array('amp-design-selector', '=' , '4'),
                        array('header-type', '!=' , '2'),
                    ),
                    'default'  => '1'
            ),
            array(
                'id'        => 'amp-sticky-header', 
                "type"      =>"switch",
                'title'     => esc_html__( 'Sticky Header', 'accelerated-mobile-pages' ),
                'default'   => 0,
                'required'  => array(
                    array('amp-design-selector', '=' , '4')
                )
            ),
            array(
                       'id' => 'header_design_section',
                       'type' => 'section',
                       'title' => esc_html__('Header Design Options', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
            ),
            // Design 1 Fields
            array(
                    'id'        => 'amp-d1-background-color',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Header Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#04415D',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1')
                    )
            ),
              array(
                    'id'        => 'amp-d1-elements-color',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Header Elements Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color' => '#ffffff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1')
                    )
            ),
            // Design 2 Fields
            array(
                    'id'        => 'amp-d2-background-color',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Header Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#0074A7',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2')
                    )
            ),
              array(
                    'id'        => 'amp-d2-elements-color',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Header Elements Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color' => '#ffffff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2')
                    )
            ), 
            // Design 3 Fields
             array(
                    'id'        => 'amp-opt-color-rgba-headercolor',
                    'type'      => 'color_rgba',
                    'title'     => esc_html__('Header Background','accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Header Elements','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => ampforwp_get_element_default_color(),
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                    )
            ),
            // Design 4 Fields
              array(
                'id'        => 'swift-background-scheme',
                'title'     => esc_html__('Header Background', 'accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'color'  => '#fff',
                ),
                'required' => array('header-type', '<' , '8')     
              ),
              array(  
                'id'        => 'swift-element-color-control',
                'title'     => esc_html__('Header Elements', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('Color of the Text and Icons on top of Header','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'default'   => array(
                    'color'  => '#333',
                ),
                'required' => array('header-type', '<' , '8')
              ), 

            // Navigation Menu Designs Options for Design 1, 2 and 3
            array(
                   'id' => 'navigation_design_section',
                   'type' => 'section',
                   'title' => esc_html__('Navigation Menu Design Options', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
                    'required'  => array(
                        array('amp-design-selector', '!=' , '4'),
                        array('ampforwp-amp-menu', '=' , '1'),
                    )
            ),
            // Design1 Menu Color Options
             array(
                    'id'        => 'amp-d1-sidebar-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#efefef',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-menu-bg-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Elements Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#fafafa',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-menu-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Elements Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#0a89c0',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-submenu-bg-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Sub Menu Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#ffffff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-menu-brdr-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Border Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#efefef',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-menu-icon-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Arrow Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#ccc',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-cross-btn-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Close Button Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#ffffff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-cross-bg-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Close Button Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'rgba'     => 'rgba(0, 0, 0, 0.25)',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d1-cross-hover-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Close Button Hover color','accelerated-mobile-pages'),
                    'default'   => array(
                        'rgba'     => 'rgba(0, 0, 0, 0.45)',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '1'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            // Design 2 Menu Color Options
            array(
                    'id'        => 'amp-d2-sidebar-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#efefef',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-menu-bg-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Elements Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#fafafa',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-menu-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Elements Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#0a89c0',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-submenu-bg-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Sub Menu Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#ffffff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-menu-brdr-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Border Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#efefef',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-menu-icon-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Arrow Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#ccc',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-cross-btn-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Close Button Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#ffffff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-cross-bg-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Close Button Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'rgba'     => 'rgba(0, 0, 0, 0.25)',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-d2-cross-hover-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Close Button Hover color','accelerated-mobile-pages'),
                    'default'   => array(
                        'rgba'     => 'rgba(0, 0, 0, 0.45)',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '2'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            // Design 3 Menu color options
            array(
                    'id'        => 'amp-opt-color-rgba-menu-bg-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Background','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#131313',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-opt-color-rgba-menu-elements-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Elements Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#eeeeee',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-opt-color-rgba-submenu-bgcolor',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Sub Menu Background Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#666666',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-opt-color-rgba-submenu-hover-bgcolor',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Sub Menu Hover Background Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#666666',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-opt-color-rgba-menu-label-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Label Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#aaa',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),
            array(
                    'id'        => 'amp-opt-color-rgba-menu-brdr-color',
                    'type'      => 'color_rgba',
                    'class' => 'child_opt',
                    'title'     => esc_html__('Menu Border Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#555555',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3'),
                      array('ampforwp-amp-menu', '=' , '1')
                    )
            ),

             // Tab 1 end    
            // Tab 2
            array(
                   'id' => 'header-tab-2',
                   'type' => 'section',
                   'title' => esc_html__('Advanced Header Options', 'accelerated-mobile-pages'),
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
                    'title' => esc_html__('Advanced Header Design', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'       => 'swift-width-control',
                    'class' => 'child_opt',
                    'type'     => 'text',
                    'title'    => esc_html__('Header Width', 'accelerated-mobile-pages'),
                    'default'  => '1100px',
                    'required' => array(
                      array('customize-options','=',1)
                    )           
            ),
            array(
                    'class' => 'child_opt',
                    'id'       => 'swift-height-control',
                    'type'     => 'text',
                    'title'    => esc_html__('Header Height', 'accelerated-mobile-pages'),
                    'default'  => '60px',
                    'required' => array(
                      array('customize-options','=',1)
                    )           
            ),
            array(
                    'class' => 'child_opt',
                    'id'    => 'margin-padding-options',
                    'type'  => 'switch',
                    'title' => esc_html__('Margin / Padding ', 'accelerated-mobile-pages'),
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
                    'title'          => esc_html__('Padding', 'accelerated-mobile-pages'),
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
                    'title'          => esc_html__('Margin', 'accelerated-mobile-pages'),
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
                    'title' => esc_html__('Border and Boxshadow', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array(
                      array('customize-options','=',1)
                    ) 
            ),

            array(
                    'class' => 'child_opt',
                  'id'       => 'swift-border-line-control',
                  'type'     => 'text',
                  'title'    => esc_html__('Border', 'accelerated-mobile-pages'), 
                  'tooltip-subtitle'     => esc_html__('Border at the bottom', 'accelerated-mobile-pages'),
                  'default'  => '1',
                  'required' => array(
                        array('border-line','=',1)
                      )  
              ),
            array(
                    'class' => 'child_opt',
                  'id'       => 'swift-border-color-control',
                  'type'     => 'color_rgba',
                  'title'    => esc_html__('Border Color', 'accelerated-mobile-pages'), 
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
                  'title'    => esc_html__('Box Shadow', 'accelerated-mobile-pages'), 
                  'default'  => 0,
                  'required' => array(
                        array('border-line','=',1)
                      )  
              ),
              array(
                    'class' => 'child_opt',
                    'id'        => 'swift-header-overlay',
                    'title'     => esc_html__('Menu Background', 'accelerated-mobile-pages'),
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
                    'id'        => 'swift-element-overlay-color-control',
                    'title'     => esc_html__('Menu Color', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Menu Border Color ', 'accelerated-mobile-pages'),
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
                   'title'  => esc_html__('Menu Overlay Position', 'accelerated-mobile-pages'),
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
                    'title'    => esc_html__('Menu Overlay Width', 'accelerated-mobile-pages'),
                    'default'  => '90%',
                    'required' => array(
                      array('customize-options','=',1)
                    )           
            ),
            
            // Tab 2 end

          )
        )
      );

    $ampforwp_home_loop = array();
    $ampforwp_home_loop = get_option('ampforwp_custom_post_types');
    $ampforwp_home_loop['post'] = 'Posts';
    unset($ampforwp_home_loop['page']);
    unset($ampforwp_home_loop['category']);

 // HomePage Section
  Redux::setSection( $opt_name, array(
                'title'      => esc_html__( 'HomePage', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-homepage-settings',
        'subsection' => true,
        'fields'     => array(
                array(
                       'id' => 'ampforwp-homepage-section-general',
                       'type' => 'section',
                       'title' => esc_html__('General', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
                array(
                        'id'       => 'amp-design-3-featured-slider',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Featured Slider', 'accelerated-mobile-pages' ),
                        'required' => array(
                           array('amp-design-selector', '=' , '3')
                        ),
                        'default'  => '1'
                      ),
                array(
                        'id'       => 'amp-design-3-featured-content',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Featured Slider Content', 'accelerated-mobile-pages' ),
                        'required' => array(
                           array('amp-design-3-featured-slider', '=' , '1')
                        ),
                        'options'   => array(
                            '0'     => 'Recent Posts',
                            '1'     => 'Categories',
                            '2'     => 'Tags'
                        ),
                        'default'  => '1'  
                ),
                 array(
                        'id'       => 'amp-design-3-category-selector',
                        'type'     => 'select',
                        'class'    => 'child_opt',
                        'title'    => esc_html__( 'Featured Slider Category', 'accelerated-mobile-pages' ),
                        'required' => array(
                          array('amp-design-selector', '=' , '3'),
                          array('amp-design-3-featured-slider', '=' , '1'),
                          array('amp-design-3-featured-content', '=', '1'),
                        ),
                        'ajax'      => true,
                        'options' => ampforwp_get_categories('amp-design-3-category-selector'),
                        'data-action' => 'ampforwp_categories', 
                        'data'      => 'categories',
                  ),
                 array(
                    'id'       => 'amp-design-3-tag-selector',
                    'type'     => 'select',
                        'class'    => 'child_opt',
                    'title'    => esc_html__( 'Featured Slider from Tags', 'accelerated-mobile-pages' ),
                    'required' => array(
                    array('amp-design-selector', '=' , '3'),
                    array('amp-design-3-featured-slider', '=' , '1'),
                    array('amp-design-3-featured-content', '=' , '2'),
                        ),  
                        'ajax'      => true,
                        'options'   => ampforwp_get_all_tags('amp-design-3-tag-selector'),
                        'data-action' => 'ampforwp_tags', 
                        'data'      => 'tags',         
                ),
                 array(
                        'id'        =>'ampforwp-featur-slider-num-posts',
                        'type'      =>'text',
                        'class'    => 'child_opt',
                        'title'     =>esc_html__('Number of Posts','accelerated-mobile-pages'),
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
                        'title'     => esc_html__('Autoplay', 'accelerated-mobile-pages'),
                        'default'   => '1',
                        'required' => array(
                         array('amp-design-3-featured-slider', '=' , '1'),
                     )
                ),
                 array(
                        'id'        =>'ampforwp-featur-slider-autop-delay',
                        'type'      =>'text',
                        'class'    => 'child_opt',
                        'title'     =>esc_html__('Delay in Autoplay','accelerated-mobile-pages'),
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
                        'title'     => esc_html__('Excerpt', 'accelerated-mobile-pages'),
                        'default'   => '1',
                ),
                array(
                        'id'        =>'amp-design-1-excerpt',
                        'class' => 'child_opt',
                        'type'      =>'text',
                        'tooltip-subtitle'  =>esc_html__('Enter the number of words Eg: 10','accelerated-mobile-pages'),
                        'title'     =>esc_html__('Excerpt Length','accelerated-mobile-pages'),
                        'required' => array(
                         array('amp-design-selector', '=' , '1'),
                         array('excerpt-option', '=' , '1'),
                             ),
                        'validate'  =>'numeric',
                        'default'   =>'20',
                ),
                array(
                        'id'        => 'excerpt-option-design-1',
                        'class' => 'child_opt',
                        'type'      => 'switch',
                        'title'     => esc_html__('Excerpt on Small Screens', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '1'),
                         array('excerpt-option', '=' , '1'),
                     )                        
                ),
                array(
                        'id'        => 'ampforwp-design1-cats-home',
                        'type'      => 'switch',
                        'title'     => esc_html__('Category label', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '1'),
                     )
                ),

            // Excerpt Length for design2 #1122
                array(
                        'id'        =>'amp-design-2-excerpt',
                        'class' => 'child_opt',
                        'type'      =>'text',
                        'tooltip-subtitle'  =>esc_html__('Enter the number of words Eg: 10','accelerated-mobile-pages'),
                        'title'     =>esc_html__('Excerpt Length','accelerated-mobile-pages'),
                        'required' => array(
                         array('amp-design-selector', '=' , '2'),   
                         array('excerpt-option', '=' , '1')
                        ),
                        'validate'  =>'numeric',
                        'default'   =>'20',
                ),
                array(

                        'id'        => 'excerpt-option-design-2',
                        'class' => 'child_opt',
                        'type'      => 'switch',
                        'title'     => esc_html__('Excerpt on Small Screens', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '2'),
                         array('excerpt-option', '=' , '1'),
                     )                        
                ),

            // Excerpt Length for design3 #1122
                 array(
                        'id'        =>'amp-design-3-excerpt',
                        'class' => 'child_opt',
                        'type'      =>'text',
                        'tooltip-subtitle'  =>esc_html__('Enter the number of words Eg: 10','accelerated-mobile-pages'),
                        'title'     =>esc_html__('Excerpt Length','accelerated-mobile-pages'),
                        'required' => array(
                         array('amp-design-selector', '=' , '3'),
                         array('excerpt-option', '=' , '1') ),
                        'validate'  =>'numeric',
                        'default'   =>'15',
                ),
                array(
                        'id'        => 'excerpt-option-design-3',
                        'class' => 'child_opt',
                        'type'      => 'switch',
                        'title'     => esc_html__('Excerpt on Small Screens', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '3'),
                         array('excerpt-option', '=' , '1'),
                     )                         
                ),

            // Excerpt length for Swift
                array(
                        'id'        =>'amp-swift-excerpt-len',
                        'class' => 'child_opt',
                        'type'      =>'text',
                        'tooltip-subtitle'  => esc_html__('Enter the number of words Eg: 20','accelerated-mobile-pages'),
                        'title'     => esc_html__('Excerpt Length','accelerated-mobile-pages'),
                        'required' => array(
                         array('amp-design-selector', '=' , '4'),
                         array('excerpt-option', '=' , '1'),
                        ),
                        'validate'  =>'numeric',
                        'default'   =>'20',
                ),    
                array(
                        'id'        => 'excerpt-option-design-4',
                        'class' => 'child_opt',
                        'type'      => 'switch',
                        'title'     => esc_html__('Excerpt on Small Screens', 'accelerated-mobile-pages'),
                        'default'   => '0',
                        'required' => array(
                         array('amp-design-selector', '=' , '4'),
                         array('excerpt-option', '=' , '1'),
                     )                         
                ),      
             // Featured Time
                array(
                        'id'        =>'amp-design-1-featured-time',
                        'type'      =>'switch',
                        'title'     =>esc_html__('Published Time','accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Display published time of the post on homepage', 'accelerated-mobile-pages'),
                        'required' => array(array('amp-design-selector', '=' , '1') ), 
                        'default'   =>'1',
                ),

                array(
                        'id'        =>'amp-design-3-featured-time',
                        'type'      =>'switch',
                        'title'     =>esc_html__('Published Time','accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Display published time of the post on homepage', 'accelerated-mobile-pages'),
                        'required' => array(array('amp-design-selector', '=' , '3') ), 
                        'default'   =>'1',
                ),
                array(
                       'id' => 'ampforwp-homepage-section-loop',
                       'type' => 'section',
                       'title' => esc_html__('Loop Display Controls', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
                array(
                        'id'       => 'ampforwp-homepage-loop-type',
                        'type'     => 'select',
                        'multi'    => true,
                        'title'    => esc_html__( 'Post Type in Loop', 'accelerated-mobile-pages' ),
                        'options'  => $ampforwp_home_loop,
                        'default'   => 'post',
                ),
                array(
                    'id'           => 'ampforwp-homepage-loop-cats',
                    'type'         => 'select',
                    'title'        => esc_html__( 'Exclude Categories', 'accelerated-mobile-pages' ),
                    'multi'        => true, 
                    'ajax'         => true,
                    'options'      => ampforwp_get_categories('ampforwp-homepage-loop-cats'),
                    'data-action'  => 'ampforwp_categories', 
                    'data'         => 'categories',
                ),
                array(
                    'id'    => 'ampforwp-homepage-loop-readmore-link',
                    'type'  => 'switch',
                    'title' => esc_html__('Read More Link', 'accelerated-mobile-pages'),
                    'default'   => 0,
                ),
                // Homepage thumbnail
                array(
                        'id'       => 'ampforwp-homepage-posts-image-modify-size',
                        'type'     => 'switch',
                        'title'    => esc_html__('Change Image Size', 'accelerated-mobile-pages'),
                         'default'  => 0,
                 ),
                array(
                    'class' => 'child_opt child_opt_arrow',
                        'id'       => 'ampforwp-homepage-posts-design-1-2-width',
                        'type'     => 'text',
                        'title'    => esc_html__('Image Width', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Defaults to 100', 'accelerated-mobile-pages'),
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
                        'title'    => esc_html__('Image Height', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Defaults to 75', 'accelerated-mobile-pages'),
                        'default'  => 75,
                        'required' => array(
                          array('amp-design-selector','!=',3),
                          array('amp-design-selector','!=',4),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                    'class' => 'child_opt',
                        'id'       => 'ampforwp-design-3-homepage-posts-width',
                        'type'     => 'text',
                        'title'    => esc_html__('Image Width', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Defaults to 300', 'accelerated-mobile-pages'),
                        'default'  => 300,
                        'required' => array(
                          array('amp-design-selector','=',3),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                    'class' => 'child_opt',
                        'id'       => 'ampforwp-design-3-homepage-posts-height',
                        'type'     => 'text',
                        'title'    => esc_html__('Image Height', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Defaults to 300', 'accelerated-mobile-pages'),
                        'default'  => 300,
                        'required' => array(
                          array('amp-design-selector','=',3),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                    'class' => 'child_opt',
                        'id'       => 'ampforwp-swift-homepage-posts-width',
                        'type'     => 'text',
                        'title'    => esc_html__('Image Width', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Defaults to 346', 'accelerated-mobile-pages'),
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
                        'title'    => esc_html__('Image Height', 'accelerated-mobile-pages'),
                        'tooltip-subtitle' => esc_html__('Defaults to 188', 'accelerated-mobile-pages'),
                        'default'  => 188,
                        'required' => array(
                          array('amp-design-selector','=',4),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                ),
                array(
                        'class' => 'child_opt',
                        'id'    => 'ampforwp-homepage-posts-first-image-modify-size',
                        'type'  => 'switch',
                        'title' => esc_html__('Apply for first image', 'accelerated-mobile-pages'),
                        'default'  => 0,
                        'tooltip-subtitle' => esc_html__('Inherit the above Height and Width size for homepage first image', 'accelerated-mobile-pages'),
                        'required' => array(
                          array('amp-design-selector','=',4),
                          array('ampforwp-homepage-posts-image-modify-size','=',1)
                        )
                 ),
                array(
                    'id'        => 'amforwp-homepage-date-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Date in Loop', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'tooltip-subtitle'  => esc_html__('Enabel this option to show data below each post of Home page loop'),
                ),
                array(
                    'id'        => 'amforwp-homepage-author-switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Author Name in Loop', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'tooltip-subtitle'  => esc_html__('Enabel this option to show author name below each post of Home page loop'),
                ),
        )
    ));
$yoast_primary_cat = '';
if(class_exists('WPSEO_Options')){
    $yoast_primary_cat =  array(
              'id'       => 'ampforwp-cats-single-primary',
              'type'     => 'switch',
              'class' => 'child_opt child_opt_arrow', 
              'title'    => esc_html__('Show Only Primary Category', 'accelerated-mobile-pages'),
              'default'  =>  '0', 
              'required' => array('ampforwp-cats-single' , '=' , 1),        
           );
}
if(!is_plugin_active( 'amp-newspaper-theme/ampforwp-custom-theme.php' ) ){
$single_page_options = array(
                array(
                       'id' => 'ampforwp-single_section_1',
                       'type' => 'section',
                       'title' => esc_html__('Single Post Design', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                        'required' => array( array('amp-design-selector', '=' , '4') ),
                ),
            // Swift
            array(
                    'id'    => 'single-design-type',
                   'title'  => esc_html__('Single Design', 'accelerated-mobile-pages'),
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
                   'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            
            array(
                       'id' => 'ampforwp-single_section_2',
                       'type' => 'section',
                       'title' => esc_html__('Single Elements', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
            array(
                    'id'    => 'swift-featued-image',
                    'type'  => 'switch',
                    'title' => esc_html__('Featured Image', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                    esc_html__('Enable this option to show featured image in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-use-featured-images-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'    => 'swift-featued-image-type',
                    'class' => 'child_opt child_opt_arrow',
                    'type'  => 'select',
                    'title'    => esc_html__('Featured Image Size', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'     => esc_html__('Select Featured Image Size','accelerated-mobile-pages'),
                    'options'  => array(
                        '1' => 'Full Screen Image',
                        '2' => 'Image Fit above the Content',
                    ),
                    'default'  => '1',
                    'required' => array( 
                                        array('amp-design-selector', '=' , '4'),
                                        array('swift-featued-image', '=' , '1'),
                                        array('single-design-type', '=' , '1')
                                    ),
            ),
            array(
                    'id'    => 'swift-featued-image-size',
                    'class' => 'child_opt child_opt_arrow',
                    'type'  => 'select',
                    'title'    => esc_html__('Size', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'     => esc_html__('Select Featured Image Size','accelerated-mobile-pages'),
                    'options'  => array(
                        'thumbnail' => 'Thumbnail',
                        'medium' => 'Medium',
                        'medium_large' => 'Medium Large',
                        'large' => 'Large',
                        'full' => 'Full',
                    ),
                    'default'  => 'full',
                    'required' => array( 
                                        array('amp-design-selector', '=' , '4'),
                                        array('swift-featued-image', '=' , '1'),
                                    ),
            ),
            // Author name 
            array(
                 'id'       => 'amp-author-name',
                 'type'     => 'switch',
                 'title'    => esc_html__( 'Author Name', 'accelerated-mobile-pages' ),
                 'default'  => '1',
                 'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                    esc_html__('Enable this option to show author name in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-show-author-name-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                  'required' => array(
                    array('amp-design-selector' , '=' , '4'),
                )
             ),
            array(
                 'id'       => 'amp-author-name-display',
                 'type'     => 'switch',
                 'class'    => 'child_opt child_opt_arrow', 
                 'title'    => esc_html__( 'Below Title on Mobile', 'accelerated-mobile-pages' ),
                 'default'  => 0,
                  'tooltip-subtitle'  => esc_html__('Enable this option to show author name below the title in mobile view','accelerated-mobile-pages'),
                  'required' => array(
                    array('amp-author-name' , '=' , '1'),
                )
            ),
            array(
                    'id'    => 'swift-date',
                    'type'  => 'switch',
                    'title' => esc_html__('Published Date', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                     esc_html__('Enable this option to show published date in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-published-date-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),

                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                 'id'       => 'amp-published-date-display',
                 'type'     => 'switch',
                 'class'    => 'child_opt child_opt_arrow', 
                 'title'    => esc_html__( 'Below Title on Mobile', 'accelerated-mobile-pages' ),
                 'default'  => 0,
                  'tooltip-subtitle' => esc_html__('Enable this option to show published date below the title in mobile view','accelerated-mobile-pages'),
                  'required' => array(
                    array('swift-date' , '=' , '1'),
                )
            ),
         //Breadcrumb ON/OFF
          array(
              'id'       => 'ampforwp-bread-crumb',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => esc_html__('Breadcrumbs', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
               esc_html__('Enable this option to show breadcrumbs in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-breadcrumbs-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),

           ),
          //Breadcrumb for Tags
          array(
                'class' => 'child_opt child_opt_arrow', 
                'id'       => 'ampforwp-bread-crumb-type',
                'type'     => 'select',
                'tooltip-subtitle'     => esc_html__('Select option to enable breadcrumb with tags or category','accelerated-mobile-pages'),
                'title'    => esc_html__('Breadcrumb Type', 'accelerated-mobile-pages'),
                'options'  => array(
                    'tags' => 'Tags',
                    'category' => 'Category',
                ),
                'default'  => 'category',
                'required' => array('ampforwp-bread-crumb' , '=' , 1),
            ),
          array(
                        'class' => 'child_opt child_opt_arrow', 
                        'id'       => 'ampforwp-bread-crumb-post',
                        'type'     => 'switch',
                        'tooltip-subtitle'     => esc_html__('enable or disable the post title on breadcrumb','accelerated-mobile-pages'),
                        'title'    => esc_html__('Post title on Breadcrumb', 'accelerated-mobile-pages'),
                        'default'  => '0',
                        'required' => array('ampforwp-bread-crumb' , '=' , 1),
            ),
          //Categories  ON/OFF
         array(
              'id'       => 'ampforwp-cats-single',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => esc_html__('Categories', 'accelerated-mobile-pages'),
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                esc_html__('Enable this option to show categories in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-show-categories-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),           
              
           ),
         $yoast_primary_cat,
         //Tags  ON/OFF
         array(
              'id'       => 'ampforwp-tags-single',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => esc_html__('Tags', 'accelerated-mobile-pages'),
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                esc_html__('Enable this option to show tags in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-show-tags-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

           ),
          //Categories and Tags Links
          array(
              'id'       => 'ampforwp-cats-tags-links-single',
              'type'     => 'switch',
              'default'  =>  '1',
              'title'    => esc_html__('Categories & Tags Links', 'accelerated-mobile-pages'),
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                esc_html__('Enable this option to make categories and tags links in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-categories-tags-links-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

           ),
          
          // Excerpt ON/OFF
          array(
              'id'        => 'enable-excerpt-single',
              'type'      => 'switch',
              'title'     => esc_html__('Excerpt', 'accelerated-mobile-pages'),
              'default'   => 0,
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                esc_html__('Enable this option to show excerpt in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-excerpt-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

          ),
          //deselectable next previous links
          array(
              'id'        => 'enable-single-next-prev',
              'type'      => 'switch',
              'title'     => esc_html__('Next-Previous Links', 'accelerated-mobile-pages'),
              'default'   => 1,
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                esc_html__('Enable this option to show next and previous links in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-next-previous-links-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

         ),   
         array(
              'id'        => 'single-next-prev-to-nonamp',
              'type'      => 'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     => esc_html__('Link to Non-AMP page', 'accelerated-mobile-pages'),
              'default'   => 0,
              'required' => array('enable-single-next-prev' , '=' , '1')       
          ), 
        // Author Bio
         array(
             'id'       => 'amp-author-description',
             'type'     => 'switch',
             'title'    => esc_html__( 'Author Bio', 'accelerated-mobile-pages' ),
             'default'  => '1',
             'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
             esc_html__('Enable this option to show author bio in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-author-bio-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 
         ),
         // Author name 
         array(
             'id'       => 'amp-author-bio-name',
             'class' => 'child_opt child_opt_arrow',
             'type'     => 'switch',
             'title'    => esc_html__( 'Author Name', 'accelerated-mobile-pages' ),
             'default'  => '1',
             'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
              esc_html__('Enable this option to show author name in author bio and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-author-name-in-author-bio-section/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
             'required' => array(
                array('amp-design-selector' , '=' , '4'),
                array('amp-author-description' , '=' , '1'),
            )
         ),
         // Author Image
         array(
             'id'       => 'amp-author-bio-image',
             'class' => 'child_opt child_opt_arrow',
             'type'     => 'switch',
             'title'    => esc_html__( 'Author Image', 'accelerated-mobile-pages' ),
             'default'  => '1',
             'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
              esc_html__('Enable this option to show author image in author bio and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-author-image-in-author-bio-section/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 
             'required' => array(
                array('amp-design-selector' , '=' , '4'),
                array('amp-author-description' , '=' , '1'),
            )
         ),
         array(
                    'id'       => 'amp-author-bio-image-width',
                    'type'     => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title'    => esc_html__('Width', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '60',
                    'required' => array('amp-author-bio-image' , '=' , '1'),
            ),
         array(
                    'id'       => 'amp-author-bio-image-height',
                    'type'     => 'text',
                    'class' => 'child_opt child_opt_arrow',
                    'title'    => esc_html__('Height', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '60',
                    'required' => array('amp-author-bio-image' , '=' , '1'),
            ),
         // Author description
         array(
             'id'       => 'amp-author-box-description',
             'class' => 'child_opt child_opt_arrow',
             'type'     => 'switch',
             'title'    => esc_html__( 'Author Description', 'accelerated-mobile-pages' ),
             'default'  => '1',
             'required' => array(
                array('amp-design-selector' , '=' , '4'),
                array('amp-author-description' , '=' , '1'),
            )
         ),        
         // Author Pages
         array(
             'id'       => 'ampforwp-author-page-url',
             'class'    => 'child_opt child_opt_arrow',
             'type'     => 'switch',
             'title'    => esc_html__( 'Link to Author Pages', 'accelerated-mobile-pages' ),
             'default'  => '0',
             'required' => array('amp-author-description' , '=' , '1'),
         ),
        // Pagination //#1015 
        array(
            'id'       => 'amp-pagination',
            'type'     => 'switch',
            'title'    => esc_html__( 'Post Pagination', 'accelerated-mobile-pages' ),
           'default'   => 1,
            'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
            esc_html__('Enable this option to show pagination in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-post-pagination-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

        ),
        array(
            'id'       => 'ampforwp-pagination-select',
                'class' => 'child_opt child_opt_arrow',
            'type'     => 'select',
            'title'    => esc_html__('Post Pagination Type', 'accelerated-mobile-pages'),
            'options'  => array(
                '1' => 'Numbering',
                '2' => 'Next-Previous',
            ),
            'default'  => '1',
            'required' => array('amp-pagination' , '=' , '1'),
        ),
        array(
            'id'       => 'ampforwp-pagination-link-type',
            'class'    => 'child_opt child_opt_arrow',
            'type'     => 'switch',
             'title'    => esc_html__('Change Pagination Links to /amp', 'accelerated-mobile-pages'),
            'default'  => '0',
            'required' => array('amp-pagination' , '=' , '1'),
            'tooltip-subtitle' => sprintf('%s', 
             esc_html__('Enable this option if post pagination link with ?amp=1 does not work. It will change pagination link ?amp=1 to /amp', 'accelerated-mobile-pages')), 
        ),
        array(
            'id'       => 'ampforwp-swift-recent-posts',
            'type'     => 'switch',
            'title'    => esc_html__('Recent Posts below Related', 'accelerated-mobile-pages'),
            'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
             esc_html__('Enable this option to show recent posts in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-recent-posts-below-related-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 
            'default'  => 1,
            'required' => array('amp-design-selector' , '=' , '4'),
        ),
        array(
                    'id'        => 'amforwp-recentpost-date-switch',
                    'type'      => 'switch',
                    'class' => 'child_opt child_opt_arrow',
                    'title'     => esc_html__('Recent Posts Date', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'tooltip-subtitle'  => esc_html__('Enable this option to show data below each post of Recent post loop'),
                    'required' => array('ampforwp-swift-recent-posts' , '=' , '1'),
            ),
        array(
                    'id'        => 'amforwp-recentpost-image-switch',
                    'type'      => 'switch',
                    'class' => 'child_opt child_opt_arrow',
                    'title'     => esc_html__('Image', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'tooltip-subtitle'  => esc_html__('Enable this option to show image for each post of Recent post loop'),
                    'required' => array('ampforwp-swift-recent-posts' , '=' , '1'),
            ),
        array(
                    'id'        => 'amforwp-recentpost-excerpt-switch',
                    'type'      => 'switch',
                    'class' => 'child_opt child_opt_arrow',
                    'title'     => esc_html__('Excerpt', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'tooltip-subtitle'  => esc_html__('Enable this option to show excerpt for each post of Recent post loop'),
                    'required' => array('ampforwp-swift-recent-posts' , '=' , '1'),
            ),
        array(
            'id'        =>'amp-swift-recentpost-excerpt-len',
            'class' => 'child_opt',
            'type'      =>'text',
            'tooltip-subtitle'  => esc_html__('Enter the number of words Eg: 15','accelerated-mobile-pages'),
            'title'     => esc_html__('Excerpt Length','accelerated-mobile-pages'),
            'required' => array(
             array('amp-design-selector', '=' , '4'),
             array('amforwp-recentpost-excerpt-switch', '=' , '1'),
            ),
            'validate'  =>'numeric',
            'default'   =>'15',
        ),
        array(
                    'id'       => 'ampforwp-recentpost-posts-link',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => esc_html__('Link to Non-AMP', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array('ampforwp-swift-recent-posts' , '=' , '1'),
            ),
        array(
                    'id'       => 'ampforwp-number-of-recent-posts',
                    'type'     => 'text',
                'class' => 'child_opt',
                    'title'    => esc_html__('Number of Recent Post', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '6',
                    'required' => array('ampforwp-swift-recent-posts' , '=' , '1'),
            ),
            array(
              'id'        =>  'ampforwp-recent-post-utm-tracking-switch',
              'type'      =>  'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('UTM Tracking', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                        esc_html__('Enable this option to add utm tracking to all your recent post links and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-utm-tracking-to-all-your-recent-post-links/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
              'default'   =>  0,
              'required' => array('ampforwp-swift-recent-posts', '=', '1')
            ),
            array(
               'id'       => 'ampforwp-recent-posts-utm-tracking',
               'title'    => esc_html__('Campaign Source', 'accelerated-mobile-pages'),
               'desc'  =>esc_html__('Use \'&\' for adding parameters in the tracking. Example: utm_source=xxx&utm_medium=xxx','accelerated-mobile-pages'),
               'type'     => 'text',
               'class' => 'child_opt child_opt_arrow',
               'required'  => array('ampforwp-recent-post-utm-tracking-switch', '=' , '1'),
               'default'  => '',
            ),
            array(
                       'id' => 'ampforwp-single_section_3',
                       'type' => 'section',
                       'title' => esc_html__('Related Post Settings', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                ),
          // Related Post
            array(
                    'id'       => 'ampforwp-single-related-posts-switch',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Related Posts', 'accelerated-mobile-pages' ),
                   'default'   => 1,
                    'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                     esc_html__('Enable this option to show related posts in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-related-posts-on-single-pages/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

            ),
            array(
                   'id'    => 'rp_design_type',
                   'title'  => esc_html__('Related Post Designs', 'accelerated-mobile-pages'),
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
                        '3' => array(
                                'alt'=>' Single Design With Sidebar ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/rlp-3.png'
                                ),                       
                    ),
                   'default'=> '1',
                   'required' => array( array('amp-design-selector', '=' , '4'),
                                 array('ampforwp-single-related-posts-switch', '=' , '1'),
                                 array('single-design-type', '=' , '1')
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-select-type-of-related',
                    'type'     => 'select',
                'class' => 'child_opt child_opt_arrow',
                    'title'    => esc_html__('Related Post by', 'accelerated-mobile-pages'),
                    'data'     => 'page',
                'tooltip-subtitle' => esc_html__('select the type of related posts', 'accelerated-mobile-pages'),
                    'options'  => array(
                        '1' => 'Tags',
                        '2' => 'Categories',
                    ),
               'default'  => '2',
               'required' => array( 
                                array('ampforwp-single-related-posts-switch', '=' , '1'),
                            ),
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-image',
                    'type'     => 'switch',
                'class' => 'child_opt',
                    'title'    => esc_html__('Image', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-change-image-size',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => esc_html__('Change Image Size', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                 array('amp-design-selector','=',4),
                                 array('ampforwp-single-related-posts-switch', '=' , '1'),
                                 array('ampforwp-single-related-posts-image', '=' , '1')
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-image-width',
                    'class' => 'child_opt child_opt_arrow',
                    'type'     => 'text',
                    'title'    => esc_html__('Image Width', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => esc_html__('Defaults to 346', 'accelerated-mobile-pages'),
                    'default'  => 346,
                    'required' => array(
                      array('amp-design-selector','=',4),
                      array('ampforwp-single-related-posts-change-image-size','=',1)
                    )
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-image-height',
                    'class' => 'child_opt',
                    'type'     => 'text',
                    'title'    => esc_html__('Image Height', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => esc_html__('Defaults to 188', 'accelerated-mobile-pages'),
                    'default'  => 188,
                    'required' => array(
                      array('amp-design-selector','=',4),
                      array('ampforwp-single-related-posts-change-image-size','=',1)
                    )
            ),
            array(
                    'id'       => 'ampforwp-single-related-posts-excerpt',
                    'type'     => 'switch',
                'class' => 'child_opt',
                    'title'    => esc_html__('Excerpt', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1') 
                                ),
            ),
            // Excerpt ON/OFF of Related Posts
          array(
              'id'        => 'enable-excerpt-single-related-posts',
              'type'      => 'text',
              'class'     => 'child_opt',
              'title'     => esc_html__('Excerpt Length', 'accelerated-mobile-pages'),
              'default'   => 15,
              'tooltip-subtitle'  => esc_html__('Excerpt will be displayed on related posts', 'accelerated-mobile-pages'),
              'required'  => array( 
                array('ampforwp-single-related-posts-excerpt', '=' , '1') ),
          ),
          array(
                 'id'        => 'excerpt-option-small-rp',
                 'class' => 'child_opt',
                 'type'      => 'switch',
                 'title'     =>  esc_html__('Excerpt on Small Screens', 'accelerated-mobile-pages'),
                 'default'   => '0',
                 'required' => array(
                     array('amp-design-selector', '!=' , '4'),
                     array('ampforwp-single-related-posts-excerpt', '=' , '1'),
                    )                         
                ),
          array(
                 'id'        => 'excerpt-option-rp-read-more',
                 'class' => 'child_opt',
                 'type'      => 'switch',
                 'title'     =>  esc_html__('Read More Link', 'accelerated-mobile-pages'),
                 'default'   => '0',
                 'required' => array(
                     array('ampforwp-single-related-posts-excerpt', '=' , '1'),
                    )                         
                ),
            array(
                    'id'       => 'ampforwp-single-related-posts-link',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => esc_html__('Link to Non-AMP', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1') 
                                ),
            ),
            array(
                    'id'       => 'ampforwp-single-order-of-related-posts',
                    'type'     => 'switch',
                'class' => 'child_opt',
                    'title'    => esc_html__('Sort Related Posts Randomly', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1'),
                                ),
            ),
            array(
                    'id'       => 'ampforwp-sort-related-posts-randomly-notice',
                    'type'     => 'info',
                    'style'    => 'info',
                    'desc'     => esc_html__('Enabling this might have some performance effects for sites who have large number of posts. Please use this with caution.', 'accelerated-mobile-pages'),
                    'required' => array('ampforwp-single-order-of-related-posts', '=', 1)
            ),
            array(
                    'id'       => 'ampforwp-number-of-related-posts',
                    'type'     => 'text',
                'class' => 'child_opt',
                    'title'    => esc_html__('Number of Related Post', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '3',
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1'),
                                ),
            ),
            array(
                    'id'       => 'ampforwp-related-posts-days-switch',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => esc_html__('By Last X Days', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => esc_html__('Show Related Posts From Past Few Days', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( 
                                    array('ampforwp-single-related-posts-switch', '=' , '1'),
                                ),
            ),
            array(
                    'id'       => 'ampforwp-related-posts-days-text',
                    'type'     => 'text',
                    'class' => 'child_opt',
                    'title'    => esc_html__('Number of Days', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '7',
                    'required' => array( 
                                    array('ampforwp-related-posts-days-switch', '=' , '1'),
                                ),
            ),
             array(
              'id'        =>  'ampforwp-related-post-utm-tracking-switch',
              'type'      =>  'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('UTM Tracking', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                        esc_html__('Enable this option to add utm tracking to all your related post links and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-utm-tracking-to-all-your-related-post-links/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
              'default'   =>  0,
              'required' => array('ampforwp-single-related-posts-switch', '=', '1')
            ),
           array(
               'id'       => 'ampforwp-related-posts-utm-tracking',
               'title'    => esc_html__('Campaign Source', 'accelerated-mobile-pages'),
               'desc'  =>esc_html__('Use \'&\' for adding parameters in the tracking. Example: utm_source=xxx&utm_medium=xxx','accelerated-mobile-pages'),
               'type'     => 'text',
               'class' => 'child_opt child_opt_arrow',
               'required'  => array('ampforwp-related-post-utm-tracking-switch', '=' , '1'),
               'default'  => '',
            ),
             // DESIGN 3 RECENT POST BELOW RELATED
            array(
                'id'       => 'ampforwp-design3-recent-posts',
                'type'     => 'switch',
                'title'    => esc_html__('Recent Posts below Related', 'accelerated-mobile-pages'),
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                            esc_html__('Enable this option to show recent posts in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-recent-posts-below-related-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 
                'default'  => 0,
                'required' => array('amp-design-selector' , '=' , '3'),
            ),
            array(
                        'id'        => 'amforwp-design3-recentpost-date-switch',
                        'type'      => 'switch',
                        'class' => 'child_opt child_opt_arrow',
                        'title'     => esc_html__('Recent Posts Date', 'accelerated-mobile-pages'),
                        'default'   => 1,
                        'tooltip-subtitle'  => esc_html__('Enable this option to show data below each post of Recent post loop'),
                        'required' => array('ampforwp-design3-recent-posts' , '=' , '1'),
                ),
            array(
                        'id'        => 'amforwp-design3-recentpost-image-switch',
                        'type'      => 'switch',
                        'class' => 'child_opt child_opt_arrow',
                        'title'     => esc_html__('Image', 'accelerated-mobile-pages'),
                        'default'   => 1,
                        'tooltip-subtitle'  => esc_html__('Enable this option to show image for each post of Recent post loop'),
                        'required' => array('ampforwp-design3-recent-posts' , '=' , '1'),
                ),
            array(
                    'id'        => 'amforwp-design3-recentpost-excerpt-switch',
                    'type'      => 'switch',
                    'class' => 'child_opt child_opt_arrow',
                    'title'     => esc_html__('Excerpt', 'accelerated-mobile-pages'),
                    'default'   => 1,
                    'tooltip-subtitle'  => esc_html__('Enable this option to show excerpt for each post of Recent post loop'),
                    'required' => array('ampforwp-design3-recent-posts' , '=' , '1'),
            ),
             array(
                    'id'        =>'amp-design3-recentpost-excerpt-len',
                    'class' => 'child_opt',
                    'type'      =>'text',
                    'tooltip-subtitle'  => esc_html__('Enter the number of words Eg: 15','accelerated-mobile-pages'),
                    'title'     => esc_html__('Excerpt Length','accelerated-mobile-pages'),
                    'required' => array(
                     array('amp-design-selector', '=' , '3'),
                     array('amforwp-design3-recentpost-excerpt-switch', '=' , '1'),
                    ),
                    'validate'  =>'numeric',
                    'default'   =>'15',
            ),  
            array(
                        'id'       => 'ampforwp-design3-number-of-recent-posts',
                        'type'     => 'text',
                    'class' => 'child_opt',
                        'title'    => esc_html__('Number of Recent Post', 'accelerated-mobile-pages'),
                        'default'  => '6',
                        'required' => array('ampforwp-design3-recent-posts' , '=' , '1'),
                ),
            array(
                    'id'       => 'ampforwp-inline-related-posts',
                    'type'     => 'switch',
                    'title'    => esc_html__('In-Content Related Post', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                    esc_html__('Enable this option to show inline related posts in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-in-content-related-posts-on-single-pages/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

                'default'  => 0,
            ),
            array(
                    'id'       => 'ampforwp-inline-related-posts-type',
                    'type'     => 'select',
                    'title'    => esc_html__('In-content Related Post by', 'accelerated-mobile-pages'),
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
                    'title'    => esc_html__('Sort Related Posts Randomly', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array( array('ampforwp-inline-related-posts', '=' , '1') ),
            ),
            array(
                'id'       => 'ampforwp-incontent-related-posts-excerpt',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => esc_html__('Excerpt', 'accelerated-mobile-pages'),
                'default'  => 1,
                'required' => array( 
                                array('ampforwp-inline-related-posts', '=' , '1') 
                            ),
            ),       
            array(
                    'id'       => 'ampforwp-number-of-inline-related-posts',
                    'type'     => 'text',
                'class' => 'child_opt',
                    'title'    => esc_html__('Display No. of Related Posts', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                'default'  => '3',
                'required' => array( array('ampforwp-inline-related-posts', '=' , '1') ),
            ),
            array(
                    'id'       => 'ampforwp-inline-related-posts-display-type',
                    'type'     => 'select',
                    'title'    => esc_html__('Related Post Display', 'accelerated-mobile-pages'),
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
                    'title'    => esc_html__('Related Post After No. of Paragraphs', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '3',
                    'required' => array( array('ampforwp-inline-related-posts', '=' , '1'),array('ampforwp-inline-related-posts-display-type', '=' , 'paragraphs') ),
            ),
            array(
                    'id'       => 'ampforwp-in-content-related-posts-days-switch',
                    'type'     => 'switch',
                    'class' => 'child_opt',
                    'title'    => esc_html__('By Last X Days', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => esc_html__('Show In Content Related Posts From Past Few Days', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array('ampforwp-inline-related-posts', '=' , '1'),                     
            ),
            array(
                    'id'       => 'ampforwp-in-content-related-posts-days-text',
                    'type'     => 'text',
                    'class' => 'child_opt',
                    'title'    => esc_html__('Number of Days', 'accelerated-mobile-pages'),
                    'validate' => 'numeric',
                    'default'  => '7',
                    'required' => array('ampforwp-in-content-related-posts-days-switch', '=' , '1'),  
                ),
            $jetpack_rp,
            array(
                   'id' => 'single-tab-2',
                   'type' => 'section',
                   'title' => esc_html__('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),
            // Lightbox 
           array(
              'id'       => 'ampforwp-amp-img-lightbox',
              'type'     => 'switch',
              'default'  =>  '0',
              'title'    => esc_html__('Lightbox for Images', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
               esc_html__('Enable this option to show lightbox for images in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-lightbox-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

           ),
            array(
              'id'       => 'ampforwp-amp-video-lightbox',
              'type'     => 'switch',
              'default'  =>  '0',
              'title'    => esc_html__('Lightbox for Youtube Video', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
               esc_html__('Enable this option to show lightbox for Youtube in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-lightbox-for-youtube-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 
            ),
           // video-docking 
           array(
              'id'       => 'ampforwp-amp-video-docking',
              'type'     => 'switch',
              'title'    => esc_html__('Video Docking', 'accelerated-mobile-pages'),
              'tooltip-subtitle'    => esc_html__('On scroll, the video will minimize to an automatically calculated corner.', 'accelerated-mobile-pages'),
              'default'  =>  0,
           ),
           // Dropcap 
           array(
              'id'       => 'ampforwp-dropcap',
              'type'     => 'switch',
              'default'  =>  '0',
              'title'    => esc_html__('Dropcap', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
               esc_html__('Enable this option to show dropcap in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-use-dropcap-feature-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

              'required'  => array(
                    array('amp-design-selector', '=' , '4')
                )
           ),
           array(
                'class' => 'child_opt',
                'id'       => 'ampforwp-dropcap-font',
                'type'     => 'text',
                'title'    => esc_html__('Font Size', 'accelerated-mobile-pages'),
                'tooltip-subtitle'    => esc_html__('Default font size is 75 pixels', 'accelerated-mobile-pages'),
                'default' => '75',
                 'required'=>array('ampforwp-dropcap','=', '1'),
            ),
            array(
                    'class' => 'child_opt',
                    'id'        => 'ampforwp-dropcap-color',
                    'title'     => esc_html__('Color', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'  => esc_html__('Choose the color for dropcap','accelerated-mobile-pages'),
                    'type'      => 'color_rgba',
                    'default'   => array(
                    'color'      => '#000',
                     ),
                    'required'=>array('ampforwp-dropcap','=', '1'),
            ),
            // Content  h1 - h6 font sizes //#2059 
            array(
                'id'       => 'swift_cnt',
                'type'     => 'switch',
                'title'    =>  esc_html__( 'H1 - H6 Font Sizes', 'accelerated-mobile-pages' ),
                'default'   => 0,
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                 esc_html__('Enable this option to change default heading size in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-change-font-size-of-h1-h6/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

            ),
            array(
                'id'       => 'swift_cnt_h1',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => esc_html__('H1', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h1_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => esc_html__('H1 Font Size', 'accelerated-mobile-pages'),
                'default'  => '28px',
                'required' => array('swift_cnt_h1' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h2',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => esc_html__('H2', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h2_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => esc_html__('H2 Font Size', 'accelerated-mobile-pages'),
                'default'  => '25px',
                'required' => array('swift_cnt_h2' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h3',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => esc_html__('H3', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h3_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => esc_html__('H3 Font Size', 'accelerated-mobile-pages'),
                'default'  => '22px',
                'required' => array('swift_cnt_h3' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h4',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => esc_html__('H4', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h4_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => esc_html__('H4 Font Size', 'accelerated-mobile-pages'),
                'default'  => '19px',
                'required' => array('swift_cnt_h4' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h5',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => esc_html__('H5', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h5_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => esc_html__('H5 Font Size', 'accelerated-mobile-pages'),
                'default'  => '17px',
                'required' => array('swift_cnt_h5' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                'id'       => 'swift_cnt_h6',
                'type'     => 'switch',
                'class' => 'child_opt',
                'title'    => esc_html__('H6', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array('swift_cnt' , '=' , '1'),
            ),
            array(
                'id'       => 'swift_h6_sz',
                'type'     => 'text',
                'class' => 'child_opt',
                'title'    => esc_html__('H6 Font Size', 'accelerated-mobile-pages'),
                'default'  => '15px',
                'required' => array('swift_cnt_h6' , '=' , '1'),
                              array('swift_cnt' , '=' , '1')
            ),
            array(
                    'id'    => 'single-new-features',
                    'type'  => 'switch',
                    'title' => esc_html__('Advanced Single Options', 'accelerated-mobile-pages'),
                    'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                    esc_html__('Enable this option to use advanced options for single posts in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-enable-advanced-single-options-in-single-page/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

                    'default'   => 0,
            ),
            array(
                    'id'       => 'breadcrumb-border',
                    'type'     => 'switch',
                    'title'    => esc_html__('Breadcrumbs Border', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( array('single-new-features', '=' , '1'),array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'       => 'ampforwp-underline-content-links',
                    'type'     => 'switch',
                    'title'    => esc_html__('Underline on Links', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array( array('single-new-features', '=' , '1') ),
            ),
            array(
                       'id' => 'ampforwp-single_section_5',
                       'type' => 'section',
                       'title' => esc_html__('WordPress Content Gallery', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                        'required' => array('amp-design-selector', '=' , '4'),
                ),
            array(
                   'id'    => 'ampforwp-gallery-design-type',
                   'title'  => esc_html__('Select Gallery Designs', 'accelerated-mobile-pages'),
                   'class' => 'child_opt child_opt_arrow',
                   'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                    esc_html__('Select the design which you want for displaying the gallery in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/add-image-gallery-carousel-in-amp-version/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')), 

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
                   'required' => array( array('amp-design-selector', '=' , '4'),
                                 
                                ),
            ),
            array(
               'id' => 'ampforwp-gallery-lightbox', 
               'type' => 'switch',
               'title' => esc_html__('Lightbox for Gallery', 'accelerated-mobile-pages'),
               'class' => 'child_opt child_opt_arrow',
               'default'    =>  1,
               'tooltip-subtitle'  => esc_html__('Enable this option to show lightbox for gallery in AMP','accelerated-mobile-pages'), 
               'required'   =>  array('ampforwp-gallery-design-type' , '!=' , '3'),
             ),
            array(
               'id' => 'single-sneakp-section', 
               'type' => 'section',
               'title' => esc_html__('Content Sneak Peek', 'accelerated-mobile-pages'),
               'indent' => true,
               'layout_type' => 'accordion',
                'accordion-open'=> 1,
             ),
            array(
                'id'       => 'content-sneak-peek',
                'type'     => 'switch',
                'title'    => esc_html__('Content Sneak Peek', 'accelerated-mobile-pages'),
                'default'  => 0,
                'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                esc_html__('Enable this option to hide all your content and show just a preview of your content in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-content-sneak-peek-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
            ),
            array(
                'id'       => 'content-sneak-peek-height',
                'type'     => 'text',
                'class'    => 'child_opt',
                'title'    => esc_html__('Content Height', 'accelerated-mobile-pages'),
                'default'  => '600px',
                'required' => array('content-sneak-peek' , '=' , '1'),
            ),
            array(
                'id'       => 'content-sneak-peek-btn-text',
                'type'     => 'text',
                'class'    => 'child_opt',
                'title'    => esc_html__('Button Text', 'accelerated-mobile-pages'),
                'default'  => 'Show Full Article',
                'required' => array('content-sneak-peek' , '=' , '1'),
            ),
            array(
                'id'        => 'content-sneak-peek-txt-color',
                'title'     => esc_html__('Text Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('Choose the color for button\'s text','accelerated-mobile-pages'),
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
                'title'     => esc_html__('Button Color', 'accelerated-mobile-pages'),
                'tooltip-subtitle'  => esc_html__('Choose the color for button','accelerated-mobile-pages'),
                'type'      => 'color_rgba',
                'class'    => 'child_opt',
                'default'   => array(
                'color'      => '#000',
                 ),
                'required' => array(
                    array('content-sneak-peek', '=' , '1')
                 )
            ),
    $fields = array(
        'id'   => 'info_normal',
        'type' => 'info',
        'class' => 'extension_banner_bg',
        'desc' => $single_extension_listing 
    )
);
}
else{
      $single_page_options = array(         
        array(
            'id'      => 'amp_newspaper_settings_info',
            'type'    => 'Info',
            'desc' => '<div style="background: #FFF9C4;padding: 12px;line-height: 2.4;margin:-25px -14px -18px -17px;font-size:16px"><b>It seems that you have activated the amp newspaper theme plugin.</b><br><div class="extension-menu-call"> <a href="{ampforwp-theme-subsection-shortcode}" class="redux-group-tab-link-a current" >Go to newspaper theme settings.</a></div></div>',
              ),
           );
       }
   // Single Section
  Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single', 'accelerated-mobile-pages' ),
        'id'         => 'amp-single',
        'subsection' => true,
        'fields'     => $single_page_options
    ) );


  // Footer Section
  Redux::setSection( $opt_name, array(
                'title'      => esc_html__( 'Footer', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-footer-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                   'id' => 'footer-tab-1',
                   'type' => 'section',
                   'title' => esc_html__('Footer Design', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
             ),
                // Swift
                  array(
                    'id'    => 'footer-type',
                   'title'  => esc_html__('Footer Type', 'accelerated-mobile-pages'),
                   'type'   => 'image_select',
                   'options'=> array(
                        '1' => array(
                                'alt'=>' Footer Design 1 ',
                                'img' =>AMPFORWP_PLUGIN_DIR_URI.'/images/footer-1.png'
                                ),
                    ),
                   'default'=> '1',
                   'required' => array( array('amp-design-selector', '=' , '4') ),
                ),
                    array(
                   'id' => 'footer-tab-3', 
                   'type' => 'section',
                   'title' => esc_html__('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),

                 array(
                        'id'    => 'swift-menu',
                        'type'  => 'switch',
                        'title' => esc_html__('Menu', 'accelerated-mobile-pages'),
                        'default'   => 1,
                        'required' => array( array('amp-design-selector', '=' , '4') ),
                        'tooltip-subtitle'       => sprintf( '%s <a href="%s" target="_blank">%s</a>',esc_html__( 'Add Menus to your AMP pages by clicking on this','accelerated-mobile-pages'), esc_url(trailingslashit(get_admin_url().'nav-menus.php?action=locations')),esc_html__('link','accelerated-mobile-pages')),
                ),
                array(
                        'id'       => 'amp-footer-link-non-amp-page',
                        'type'     => 'switch',
                        'title'    => esc_html__('Link to Non-AMP page in Footer', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 1
                ),
                array(
                  'id'       => 'amp-footer-link-non-amp-page-alternate',
                  'type'     => 'switch',
                  'class'    => 'child_opt child_opt_arrow',
                  'default'  =>  0,
                  'title'    => esc_html__('Not redirecting to Non-AMP? Enable it', 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => esc_html__('Enable this option if View Non-AMP Version link does not work properly, due to server configuration or server cache'),
                  'required' => array('amp-footer-link-non-amp-page','=','1'),
                ),
                array(
                        'id'       => 'ampforwp-footer-top',
                        'type'     => 'switch',
                        'title'    => esc_html__('Back to Top link', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 1,
                ),

                array(
                        'id'       => 'amp-design-3-credit-link',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Credit link', 'accelerated-mobile-pages' ),
                        'required' => array(
                          array('amp-design-selector', '=' , '3')
                        ),
                        'default'  => '1'
                ),
                array(
                        'id'       => 'ampforwp-nofollow-view-nonamp',
                        'type'     => 'switch',
                        'title'    => esc_html__('Make "View Non-AMP" link nofollow', 'accelerated-mobile-pages'),
                        'default'   => 0
                ),
                array(
                   'id' => 'amp-footer-design-options',
                   'type' => 'section',
                   'title' => __('Footer Design Options', 'accelerated-mobile-pages'),
                   'indent' => true,
                   //'start'  => true,
                   //'label' => 'Tab 2',
                   'required' => array(
                            array('amp-design-selector', '!=' , '4')
                    ),
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),
                // Design 1
                array(
                        'id'       => 'ampforwp-footer-background-color-1',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Background Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#FFFFFF'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '1')
                        )
                ),
                array(
                        'id'       => 'd1-footer-hdng-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Heading Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#353535'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '1')
                        )
                ),
                array(
                        'id'       => 'd1-footer-txt-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Text Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#353535'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '1')
                        )
                ),
                array(
                        'id'       => 'd1-footer-link-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Link Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#04415D'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '1')
                        )
                ),
                array(
                        'id'       => 'd1-footer-link-hvr-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Link Hover Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#353535'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '1')
                        )
                ),
                array(
                        'id'       => 'd1-footer-brdr-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Border Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#c2c2c2'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '1')
                        )
                ),
                array(
                        'id'       => 'd1-footer-cpr-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Copyrights Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#696969'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '1')
                        )
                ),
                // Design 2
                array(
                        'id'       => 'ampforwp-footer-background-color-2',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Background Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#FFFFFF'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '2')
                        )
                ),
                array(
                        'id'       => 'd2-footer-hdng-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Heading Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#222222'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '2')
                        )
                ),
                array(
                        'id'       => 'd2-footer-txt-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Text Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#222222'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '2')
                        )
                ),
                array(
                        'id'       => 'd2-footer-link-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Link Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#0074A7'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '2')
                        )
                ),
                array(
                        'id'       => 'd2-footer-brdr-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Border Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#eeeeee'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '2')
                        )
                ),
                // Design 3
                array(
                        'id'       => 'ampforwp-footer-background-color-3',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Background Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#151515'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '3')
                        )
                ),
                array(
                        'id'       => 'd3-footer-hdng-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Heading Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#aaaaaa'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '3')
                        )
                ),
                array(
                        'id'       => 'd3-footer-txt-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Text Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#eeeeee'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '3')
                        )
                ),
                array(
                        'id'       => 'd3-footer-link-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Link Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#ffffff'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '3')
                        )
                ),
                array(
                        'id'       => 'd3-footer-brdr-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Border Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#3c3c3c'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '3')
                        )
                ),
                array(
                        'id'       => 'd3-footer-cpr-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Copyrights Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#ffffff'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '3')
                        )
                ),
                array(
                        'id'       => 'd3-footer-pwrd-color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Footer Powered by Color', 'accelerated-mobile-pages'),
                        'default'   => array(
                                'color' => '#cac8c8'
                        ),
                        'required'  => array(
                            array('amp-design-selector', '=' , '3')
                        )
                ),
            array(
                   'id' => 'footer-tab-2',
                   'type' => 'section',
                   'title' => esc_html__('Advanced Footer Options', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'required' => array(
                            array('amp-design-selector', '=' , '4')
                    ),
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),
            array(
                    'id'    => 'footer-customize-options',
                    'type'  => 'switch',
                    'title' => esc_html__('Advanced Footer Design', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'required' => array( array('amp-design-selector', '=' , '4') ),
            ),
            array(
                    'id'        => 'swift-footer-txt-clr',
                    'title'     => esc_html__('Footer Text Color', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Footer Link Color', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Footer Link Hover Color', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Footer 1 Background', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Footer 1 Gapping', 'accelerated-mobile-pages'),
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
                    'title'    => esc_html__('Footer 1 Font Size', 'accelerated-mobile-pages'),
                    'default'  => '14px',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
              ),
            array(
                    'id'       => 'swift-head-size',
                    'type'     => 'text',
                    'title'    => esc_html__('Footer 1 Heading Font Size', 'accelerated-mobile-pages'),
                    'default'  => '12px',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
            ),
            array(
                    'id'       => 'swift-head-fntwgth',
                    'type'     => 'text',
                    'title'    => esc_html__('Footer 1 Heading Font Weight', 'accelerated-mobile-pages'),
                    'default'  => '500',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
            ),
            array(
                    'id'        => 'swift-footer-heading-clr',
                    'title'     => esc_html__('Footer 1 Heading Color', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Footer 2 Background', 'accelerated-mobile-pages'),
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
                    'title'     => esc_html__('Footer 2 Gapping', 'accelerated-mobile-pages'),
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
                    'title'    => esc_html__('Footer 2 Font Size', 'accelerated-mobile-pages'),
                    'default'  => '12px',
                    'required' => array(
                        array('footer-customize-options','=',1)
                      )
            ),
            array(
                    'id'        => 'swift-footer-brdrclr',
                    'title'     => esc_html__('Footer 2 Border Color', 'accelerated-mobile-pages'),
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
                   'title'  => esc_html__('Footer 2 Menu Position', 'accelerated-mobile-pages'),
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
                'title'      => esc_html__( 'Page', 'accelerated-mobile-pages' ),
        'id'         => 'amp-theme-page-settings',
        'subsection' => true,
        'fields'     => array(
                array(
                   'id' => 'page-tab-1', 
                   'type' => 'section',
                   'title' => esc_html__('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),
            array(
                  'id'       => 'ampforwp_pages_title',
                  'type'     => 'switch',
                  'default'  =>  '1',
                  'title'    => esc_html__('Title', 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => esc_html__('Enable Title on Pages.','accelerated-mobile-pages'),
                  'required' => array('amp-design-selector','=','4'),
            ),      
         // Meta ON/OFF Pages
            array(
                  'id'       => 'featured_image_swift_page',
                  'type'     => 'switch',
                  'default'  =>  '0',
                  'title'    => esc_html__('Featured Image', 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => esc_html__('Enable Featured Image on Pages.'),
                  'required' => array('amp-design-selector','=','4'),
            ),
            array(
                  'id'       => 'featured_image_swift_page_builder',
                  'type'     => 'switch',
                  'class'    => 'child_opt child_opt_arrow',
                  'default'  =>  '1',
                  'title'    => esc_html__('Featured Image on Pagebuilder', 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => esc_html__('Enable Featured Image on Pagebuilder Pages.'),
                  'required' => array('featured_image_swift_page','=','1'),
            ),
            array(
                  'id'       => 'ampforwp_pages_breadcrumbs',
                  'type'     => 'switch',
                  'default'  =>  '0',
                  'title'    => esc_html__('Breadcrumbs', 'accelerated-mobile-pages'),
                  'tooltip-subtitle' => esc_html__('Enable Breadcrumbs on Pages.','accelerated-mobile-pages'),
            ),
            array(
                      'id'       => 'meta_page',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => esc_html__('Meta Information', 'accelerated-mobile-pages'),
                  ),
             array(
                      'id'       => 'ampforwp_subpages_list',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => esc_html__('Subpages/ChildPages', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => esc_html__('Shows a List of Subpages'),                  
                  ),
             array(
                      'id'       => 'ampforwp-page-social',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => esc_html__('Social Icons', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => esc_html__('Enable Social Sharing on Pages'),                  
                  ),
             array(
                      'id'       => 'ampforwp-page-sticky-social',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => esc_html__('Sticky Social Icons', 'accelerated-mobile-pages'),
                      'tooltip-subtitle' => esc_html__('Enable Social Sticky Icons on Pages'),                  
                  ),
            )
    ));

    // Social Section
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Sharing', 'accelerated-mobile-pages' ),
        'id'         => 'amp-social',
        'desc'      => esc_html__('All the Social sharing and the social profile related settings are here','accelerated-mobile-pages'),
        'subsection' => true,
        'fields'     => array(
            array(
           'id' => 'social-settings',
           'type' => 'section',
           'title' => esc_html__('Social Settings', 'accelerated-mobile-pages'),
           'indent' => true,
           'layout_type' => 'accordion',
            'accordion-open'=> 1,
         ),
        // Social Icons Option #3613
        array(
              'id'        =>  'ampforwp-social-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Social Share', 'accelerated-mobile-pages'),
              'default'   =>  1,
        ),    
        // Social Icons Position [Swift] #1722
            array(
                'id'       => 'swift-social-position',
                'class' => 'child_opt child_opt_arrow',
                'type'     => 'select',
                'title'    => esc_html__( 'Position', 'accelerated-mobile-pages' ),
                'options'  => array(
                                'default' => 'Single Sidebar (left side)',
                                'above-content' => 'Above Content',
                                'below-content' => 'Below Content'
                                ),
                'default'  => 'default',
                'required' => array(array('amp-design-selector', '=', '4'),array('ampforwp-social-share', '=', '1') )
            ), 
        // Social Share links to AMP
          array(
              'id'        =>  'ampforwp-social-share-amp',
              'type'      =>  'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('Social Share links to AMP', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                        esc_html__('Enable this option to share all your social links to AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-share-social-links-to-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
              'default'   =>  0,
              'required' => array(array('ampforwp-social-share', '=', '1'))
          ), 
          // Social No Follow links 
          array(
              'id'        =>  'ampforwp-social-no-follow',
              'type'      =>  'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('No Follow All Your Social Links', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                        esc_html__('Enable this option to add no-follow to all your social links and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-no-follow-to-all-your-social-share-links/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
              'default'   =>  0,
              'required' => array(array('ampforwp-social-share', '=', '1'))
          ),
          array(
              'id'        =>  'ampforwp-social-no-referrer',
              'type'      =>  'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('No Referrer All Your Social Links', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                        esc_html__('Enable this option to add noreferrer to all your social links and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-noreferrer-to-all-your-social-share-links/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
              'default'   =>  0,
              'required' => array(array('ampforwp-social-share', '=', '1'))
          ),
          array(
              'id'        =>  'ampforwp-social-no-opener',
              'type'      =>  'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('No Opener All Your Social Links', 'accelerated-mobile-pages'),
              'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                        esc_html__('Enable this option to add noopener to all your social links and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-noopener-to-all-your-social-share-links/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
              'default'   =>  0,
              'required' => array(array('ampforwp-social-share', '=', '1'))
            ),
           $sassy_ss,
            // AddThis Support  
        array(
           'id' => 'add-this-support',
           'type' => 'section',
           'title' => esc_html__('AddThis Share Buttons', 'accelerated-mobile-pages'),
           'indent' => true,
           'layout_type' => 'accordion',
           'accordion-open'=> 1,
         ), 
        
          array(
              'id'        =>  'enable-add-this-option',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Smart Sorting Share Buttons', 'accelerated-mobile-pages'),
              'tooltip-subtitle'    => sprintf('%s <a href="https://www.addthis.com/register" target="_blank">%s</a>, %s <a href="https://www.addthis.com/academy/how-to-customize-your-share-buttons-on-the-amp-for-wp-plugin" target="_blank">%s</a>',esc_html__('You are using the default AddThis share buttons. To customize your share buttons, create a free account at','accelerated-mobile-pages'),esc_html__('AddThis.com','accelerated-mobile-pages'),esc_html__('then activate the Inline Share Buttons. Once your buttons are activated, replace the default Pub ID and Tool ID with your personalized IDs. For instructions, visit','accelerated-mobile-pages'),esc_html__('here','accelerated-mobile-pages')),
              'default'   =>  true,
          ),
            array(
               'id' => 'addthis-floating-share',
               'type' => 'switch',
               'class' => 'child_opt child_opt_arrow',
               'title' => esc_html__('Addthis Floating Share', 'accelerated-mobile-pages'),
               'default'  =>  '0',
               'required' => array(array('enable-add-this-option', '=', '1'))
            ),
            array(
               'id' => 'addthis-inline-share',
               'type' => 'switch',
               'class' => 'child_opt child_opt_arrow',
               'title' => esc_html__('Addthis Inline Share', 'accelerated-mobile-pages'),
               'default'  =>  '1',
               'required' => array(array('enable-add-this-option', '=', '1'))
            ),
           array(
                'id'       => 'swift-add-this-position',
                'type'     => 'select',
                'class' => 'child_opt child_opt_arrow',
                'title'    => esc_html__( 'Position', 'accelerated-mobile-pages' ),
                'options'  => array( 
                                'default'       => 'Single Sidebar (left side)', 
                                'above-content' => 'Above Content',
                                'below-content' => 'Below Content'
                                ),
                'default'  => 'below-content',
                'required' => array(
                                array('amp-design-selector', '=', '4'),
                                array('enable-add-this-option', '=', '1'),
                                array('single-design-type', '=', '1'),
                                array('addthis-inline-share', '=', '1'),
                                 )
            ), 
           array(
                'id'       => 'swift-layout-addthis-pos',
                'type'     => 'select',
                'class' => 'child_opt child_opt_arrow',
                'title'    => esc_html__( 'Position', 'accelerated-mobile-pages' ),
                'options'  => array(
                                'above-content' => 'Above Content',
                                'below-content' => 'Below Content'
                                ),
                'default'  => 'below-content',
                'required' => array(
                                array('amp-design-selector', '=', '4'),
                                array('enable-add-this-option', '=', '1'),
                                array('single-design-type', '!=', '1'),
                                array('single-design-type', '!=', '6'),
                                array('addthis-inline-share', '=', '1'),
                                 )
            ), 
           array(
                'id'       => 'swift-layout-6-addthis-pos',
                'type'     => 'select',
                'class' => 'child_opt child_opt_arrow',
                'title'    => esc_html__( 'Position', 'accelerated-mobile-pages' ),
                'options'  => array(
                                'above-content' => 'Above Content',
                                'below-content' => 'Below Content'
                                ),
                'default'  => 'above-content',
                'required' => array(
                                array('amp-design-selector', '=', '4'),
                                array('enable-add-this-option', '=', '1'),
                                array('single-design-type', '=', '6'),
                                array('addthis-inline-share', '=', '1'),
                                 )
            ), 
           array(
                'id'       => 'design-1-2-3-addthis-pos',
                'type'     => 'select',
                'class' => 'child_opt child_opt_arrow',
                'title'    => esc_html__( 'Position', 'accelerated-mobile-pages' ),
                'options'  => array(
                                'above-content' => 'Above Content',
                                'below-content' => 'Below Content'
                                ),
                'default'  => 'below-content',
                'required' => array(
                                array('amp-design-selector', '!=', '4'),
                                array('enable-add-this-option', '=', '1'),
                                array('addthis-inline-share', '=', '1'),
                                 )
            ), 
          array(
               'id'       => 'add-this-pub-id',
               'title'    => esc_html__('Pub ID', 'accelerated-mobile-pages'),
               'type'     => 'text',
               'class' => 'child_opt child_opt_arrow',
               'required'  => array('enable-add-this-option', '=' , '1'),
               'default'  => esc_html__('ra-5cc8551aa4f16f5c','accelerated-mobile-pages'),
          ),
          array(
               'id'       => 'add-this-widget-id',
               'title'    => esc_html__('Tool ID', 'accelerated-mobile-pages'),
               'type'     => 'text',
               'class' => 'child_opt child_opt_arrow',
               'required'  => array('enable-add-this-option', '=' , '1'),
               'default'  => esc_html__('cwgj','accelerated-mobile-pages'),
          ),
         //End AddThis Support    
        //Start Social Sticky Icon
        array(
           'id' => 'sticky-social-settings',
           'type' => 'section',
           'title' => esc_html__('Sticky Social', 'accelerated-mobile-pages'),
           'indent' => true,
           'layout_type' => 'accordion',
           'accordion-open'=> 1,
        ), 
        // Social Sticky Icons ON/OFF
        array(
          'id'        => 'enable-single-social-icons',
          'type'     => 'switch',
          'default'  =>  '1',
          'title'     => esc_html__('Sticky Social Sharing bar', 'accelerated-mobile-pages'),
        ),
         //End Social Sticky Icon  
          array(
           'id' => 'social-shre',
           'type' => 'section',
           'title' => esc_html__('Social Sharing', 'accelerated-mobile-pages'),
           'indent' => true,
           'layout_type' => 'accordion',
            'accordion-open'=> 1,
            'required' => array(array('ampforwp-social-share', '=', '1'))
         ),
          // Facebook Like 
          array(
              'id'        =>  'ampforwp-facebook-like-button',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Facebook Like Button', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          array(
              'id'        =>  'ampforwp-facebook-like-data-action',
              'type'      =>  'switch',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('Add Recommend Label', 'accelerated-mobile-pages'),
              'tooltip-subtitle'  => esc_html__('Button text will be replaced from \'Like\' to \'Recommend\'', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required'  => array('ampforwp-facebook-like-button', '=' , '1'),
          ),
          array(
              'id'        =>  'ampforwp-facebook-like-width',
              'type'      =>  'text',
              'class' => 'child_opt child_opt_arrow',
              'title'     =>  esc_html__('Width for Facebook like button', 'accelerated-mobile-pages'),
              'required'  => array('ampforwp-facebook-like-data-action', '=' , '1'),
              'tooltip-subtitle'  => esc_html__('Enter the width of Facebook like button in px, default value is 140.', 'accelerated-mobile-pages'),
              'default'   =>  '140',
          ),
          // Facebook ON/OFF
          array(
              'id'        =>  'enable-single-facebook-share',
              'type'      =>  'switch',
              //'required'  => array('enable-single-social-icons', '=' , '1'),
              'title'     =>  esc_html__('Facebook', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Facebook app ID
          array(
               'id'       => 'amp-facebook-app-id',
               'class' => 'child_opt child_opt_arrow',
               'title'    => esc_html__('Facebook App ID', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('In order to use Facebook share you need to register an app ID, <a href="https://developers.facebook.com/apps" style="color:#93FCFF;" >You can register one here: https://developers.facebook.com/apps.', 'accelerated-mobile-pages'),
               'type'     => 'text',
               'required'  => array(array('enable-single-facebook-share', '=' , '1'),array('amp-design-selector', '!=' , '4')),
               'placeholder'  => esc_html__('Enter your facebook app id','accelerated-mobile-pages'),
               'default'  => '',
          ),
          // Facebook Messenger ON/OFF
          array(
              'id'        =>  'enable-single-facebook-share-messenger',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Facebook Messenger', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Facebook app ID
          array(
               'id'       => 'amp-facebook-app-id-messenger',
               'title'    => esc_html__('Facebook App ID', 'accelerated-mobile-pages'),
               'class' => 'child_opt child_opt_arrow',
               'tooltip-subtitle' => sprintf( '%s <a style="color:#93FCFF;" href="%s" target="_blank">%s</a> %s <a style="color:#93FCFF;" href="%s" target="_blank">%s</a>',esc_html__('In order to use Facebook share you need to register an app ID','accelerated-mobile-pages'),esc_url("https://developers.facebook.com/apps"),esc_html__('here','accelerated-mobile-pages'),esc_html__('You can register one','accelerated-mobile-pages'),esc_url('https://developers.facebook.com/apps'),esc_html__('here','accelerated-mobile-pages') ),
               'type'     => 'text',
               'required'  => array('enable-single-facebook-share-messenger', '=' , '1'),
               'placeholder'  => esc_html__('Enter your facebook app id','accelerated-mobile-pages'),
               'default'  => '',
          ),
          // Twitter ON/OFF
          array(
              'id'        =>  'enable-single-twitter-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Twitter', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          array(
              'id'        =>  'enable-single-twitter-share-handle',
              'type'      =>  'text',
              'class' => 'child_opt',
              'title'     =>  esc_html__('Twitter Handle', 'accelerated-mobile-pages'),
              'required'  => array('enable-single-twitter-share', '=' , '1'),
              'placeholder'  => esc_html__('username','accelerated-mobile-pages'),
              'default'   =>  '',
          ),
           array(
              'id'        =>  'enable-single-twitter-share-link',
              'type'      =>  'switch',
              'class' => 'child_opt',
              'title'     =>  esc_html__('Pretty Permalinks for Twitter Share?', 'accelerated-mobile-pages'),
              'tooltip-subtitle'  => esc_html__('Enable this to have pretty links for twitter sharing'),
              'default'   =>  0,
              'required'  => array('enable-single-twitter-share', '=' , '1'),
          ),
          // Email ON/OFF
          array(
              'id'        =>  'enable-single-email-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Email', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // Pinterest ON/OFF
          array(
              'id'        =>  'enable-single-pinterest-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Pinterest', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // LinkedIn ON/OFF
          array(
              'id'        =>  'enable-single-linkedin-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('LinkedIn', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // WhatsApp
          array(
              'id'        =>  'enable-single-whatsapp-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('WhatsApp', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // LINE
          array(
              'id'        =>  'enable-single-line-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Line', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
           // VKontakte
          array(
              'id'        =>  'enable-single-vk-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('VKontakte', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Odnoklassniki
          array(
              'id'        =>  'enable-single-odnoklassniki-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Odnoklassniki', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Reddit
          array(
              'id'        =>  'enable-single-reddit-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Reddit', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Tumblr
          array(
              'id'        =>  'enable-single-tumblr-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Tumblr', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Telegram
          array(
              'id'        =>  'enable-single-telegram-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Telegram', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // StumbleUpon
          array(
              'id'        =>  'enable-single-stumbleupon-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('StumbleUpon', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Wechat
          array(
              'id'        =>  'enable-single-wechat-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Wechat', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Viber
          array(
              'id'        =>  'enable-single-viber-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Viber', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
           // Hatena BookMark
           array(
              'id'        =>  'enable-single-hatena-bookmarks',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Hatena Bookmarks', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
        // Pocket
           array(
              'id'        =>  'enable-single-pocket-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Pocket', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Yummly
          array(
              'id'        =>  'enable-single-yummly-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Yummly', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '4')
        ),
          ),
          // MeWe
          array(
              'id'        =>  'enable-single-mewe-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('MeWe', 'accelerated-mobile-pages'),
              'default'   =>  0,
        ),
          // Flipboard
          array(
              'id'        =>  'enable-single-flipboard-share',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Flipboard', 'accelerated-mobile-pages'),
              'default'   =>  0,
        ),
        array(
               'id' => 'social-prfl',
               'type' => 'section',
               'title' => esc_html__('Social Media Profile Links', 'accelerated-mobile-pages'),
               'indent' => true,
               'required' => array(
                        array('amp-design-selector', '=' , '4')
                ),
               'layout_type' => 'accordion',
                'accordion-open'=> 1,
             ),
             array(
                'id'       => 'menu-social',
                'type'     => 'switch',
                'title'    => esc_html__('Menu Social Profile', 'accelerated-mobile-pages'),
                'default'  => 0,
                'required' => array(
                        array('amp-design-selector', '=' , '4')
                ),     
            ),
            array(
                    'id'       => 'enbl-fb',
                    'type'     => 'switch',
                    'title'    => esc_html__('Facebook', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social', '=' ,1)
                    )     
            ),
            array(
                    'id'       => 'enbl-fb-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Facebook URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-fb','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-tw',
                    'type'     => 'switch',
                    'title'    => esc_html__('Twitter', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-tw-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Twitter URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-tw','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-gol',
                    'type'     => 'switch',
                    'title'    => esc_html__('Google', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-gol-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Google URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-gol','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-lk',
                    'type'     => 'switch',
                    'title'    => esc_html__('Linkedin', 'accelerated-mobile-pages'),
                    'default'  => 1,
                    'required' => array(
                      array('menu-social','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-lk-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Linkedin URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-lk','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-pt',
                    'type'     => 'switch',
                    'title'    => esc_html__('Pinterest', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-pt-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Pinterest URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-pt','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-yt',
                    'type'     => 'switch',
                    'title'    => esc_html__('Youtube', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-yt-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Youtube URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-yt','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-inst',
                    'type'     => 'switch',
                    'title'    => esc_html__('Instagram', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-inst-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Instagram URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-inst','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-vk',
                    'type'     => 'switch',
                    'title'    => esc_html__('VKontakte', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-vk-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('VKontakte URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-vk','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-rd',
                    'type'     => 'switch',
                    'title'    => esc_html__('Reddit', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-rd-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Reddit URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-rd','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-tbl',
                    'type'     => 'switch',
                    'title'    => esc_html__('Tumblr', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-tbl-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Tumblr URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-tbl','=',1)
                    )           
            ),
            array(
                    'id'       => 'enbl-telegram',
                    'type'     => 'switch',
                    'title'    => esc_html__('Telegram', 'accelerated-mobile-pages'),
                    'default'  => 0,
                    'required' => array(
                      array('menu-social','=',1)
                    )          
            ),
            array(
                    'id'       => 'enbl-telegram-prfl-url',
                    'type'     => 'text',
                    'title'    => esc_html__('Telegram URL', 'accelerated-mobile-pages'),
                    'default'  => '#',
                    'required' => array(
                      array('enbl-telegram','=',1)
                    )           
            ),
          array(
       'id' => 'social-media-profiles-subsection',
       'type' => 'section',
       'title' => esc_html__('Social Media Profiles (Design #3)', 'accelerated-mobile-pages'),
       'tooltip-subtitle' => esc_html__('Please enter your personal/organizational social media profiles here', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Twitter ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-twittter-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Twitter URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Facebook ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-facebook-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Facebook URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Pintrest ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-pintrest-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Pintrest URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Google Plus ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-google-plus-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Google Plus URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('LinkedIn', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-linkdin-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('LinkedIn URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Youtube ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-youtube-profile-url',
              'type'      =>  'text',
              'default'   =>  '#',
              'title'     =>  esc_html__('Youtube URL', 'accelerated-mobile-pages'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-youtube-profile', '=' , '1')
              ),
          ),
          //#7
          array(
              'id'        =>  'enable-single-instagram-profile',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Instagram ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-instagram-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  esc_html__('Instagram URL', 'accelerated-mobile-pages'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-instagram-profile', '=' , '1')
              ),
          ),
          //#8
          array(
              'id'        =>  'enable-single-VKontakte-profile',
              'type'      =>  'switch',
              'title'     =>  esc_html__('VKontakte ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-VKontakte-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  esc_html__('VKontakte URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Reddit', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-reddit-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Reddit URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Snapchat ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-snapchat-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Snapchat URL', 'accelerated-mobile-pages'),
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
              'title'     =>  esc_html__('Tumblr', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-Tumblr-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Tumblr URL', 'accelerated-mobile-pages'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-Tumblr-profile', '=' , '1')
              ),
          ),
          //#13
          array(
              'id'        =>  'enable-single-telegram-profile',
              'type'      =>  'switch',
              'title'     =>  esc_html__('Telegram', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-telegram-profile-url',
              'type'      =>  'text',
              'title'     =>  esc_html__('Telegram URL', 'accelerated-mobile-pages'),
              'default'   =>  '#',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-telegram-profile', '=' , '1')
              ),
          ),
        )
    ) );

    // Date SECTION
   Redux::setSection( $opt_name, array(
       'title'      => esc_html__( 'Date', 'accelerated-mobile-pages' ),
       'id'         => 'ampforwp-date-section',
       'subsection' => true,
        'fields'     => array(
            
                array(
                   'id' => 'date-tab-1', 
                   'type' => 'section',
                   'title' => esc_html__('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),
                // Date on Single Design 3
             array(
                'id'       => 'amp-design-3-date-feature',
                'type'     => 'switch',
                'title'    => esc_html__( 'Date in Posts', 'accelerated-mobile-pages' ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'tooltip-subtitle'     => esc_html__('Display date along with author and category in posts', 'accelerated-mobile-pages' ),
                'default'  => '0'
            ),
            // Show Date As
             array(
                    'id'       => 'ampforwp-post-date-global',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Show Date As', 'accelerated-mobile-pages' ),
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
                    'title'     =>esc_html__('Date Format','accelerated-mobile-pages'),
                    'tooltip-subtitle' => esc_html__('Select the Date Format of Posts', 'accelerated-mobile-pages'),
                    'options'   => array(
                                    '1' => 'Ago',
                                    '2' => 'Traditional view'
                                    ), 
                    'default'   =>'1',
            ),
            array(
                    'id'        =>'ampforwp-post-date-format-text',
                    'type'      =>'text',
                    'title'     =>esc_html__('Text for the Date Format','accelerated-mobile-pages'),
                    'desc'  =>esc_html__('Example: English - % days ago, Spain - ago % days','accelerated-mobile-pages'),
                    'required' => array( array('ampforwp-post-date-format', '=', '1') ),
                    'default'   =>'% days ago',
            ),
            array(
                    'id'        =>'ampforwp-post-time',
                    'type'      =>'switch',
                    'title'     => esc_html__('Time','accelerated-mobile-pages'),
                    'tooltip-subtitle' => esc_html__('Enable or Disable Time In Posts', 'accelerated-mobile-pages'),
                    'default'   =>'1',
                    'required' => array( array('ampforwp-post-date-format', '=', '2') ),
            ),
        // Post Modified Date
            array(
              'id'        => 'post-modified-date',
              'type'      => 'switch',
              'title'     => esc_html__('Date Notice', 'accelerated-mobile-pages'),
              'default'   => 0,
              'tooltip-subtitle'  => esc_html__('Show Modified date of an article at the end of the post.', 'accelerated-mobile-pages'),
            ),
            array(
                    'id'        =>'ampforwp-post-date-notice-type',
                    'type'      =>'select',
                    'class' => 'child_opt child_opt_arrow',
                    'title'     =>esc_html__('Notice Type','accelerated-mobile-pages'),
                    'tooltip-subtitle' => esc_html__('Select Date Format of Posts', 'accelerated-mobile-pages'),
                    'options'   => array(
                                    'modified' => 'Modified Date Notice',
                                    'published' => 'Published Date Notice'
                                    ), 
                    'default'   =>'modified',
                    'required' => array( array('post-modified-date', '=', '1') ),
            ),
            array(
              'id'        => 'ampforwp-post-date-notice-time',
              'class' => 'child_opt child_opt_arrow',
              'type'      => 'switch',
              'title'     => esc_html__('Time', 'accelerated-mobile-pages'),
              'default'   => 1,
              'tooltip-subtitle'  => esc_html__('Show Modified date of an article at the end of the post.', 'accelerated-mobile-pages'),
              'required' => array( array('ampforwp-post-date-notice-type', '!=', ''),array('post-modified-date', '=', '1') ),
            ),        
        )

    ) );
   if ( 4 == ampforwp_get_setting('amp-design-selector')) {
    $post_builder = '';
   }
   else{
    $post_builder = '<br /><a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"  target="_blank"><img class="ampforwp-post-builder-img" src="'.AMPFORWP_IMAGE_DIR . '/amp-post-builder.png" width="489" height="72" /></a>';
    }
    // Misc SECTION
   Redux::setSection( $opt_name, array(
       'title'      => esc_html__( 'Misc', 'accelerated-mobile-pages' ),
       'desc'       => $post_builder,
       'id'         => 'amp-design',
       'subsection' => true,
        'fields'     => array(
                array(
                   'id' => 'misc-tab-1', 
                   'type' => 'section',
                   'title' => esc_html__('General', 'accelerated-mobile-pages'),
                   'indent' => true,
                   'layout_type' => 'accordion',
                    'accordion-open'=> 1,
             ),

                // RTL
                array(
                        'id'        =>'amp-rtl-select-option',
                        'type'      => 'switch',
                        'title'     => esc_html__('RTL Support', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'tooltip-subtitle'  => esc_html__('Enable Right to Left language support', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                    ),
           array(
               'id'       => 'ampforwp-sub-categories-support',
               'type'     => 'switch',
               'title'    => esc_html__('Sub-Categories under Category', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Display sub-categories on category pages', 'accelerated-mobile-pages'),
               'default'  => '0'
             ),
        )

    ) );
    
// Extension Section
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Extensions', 'accelerated-mobile-pages' ),
        'id'         => 'opt-go-premium',
        'subsection' => false,
        'desc' => $extension_listing,
        'icon' => 'el el-puzzle',
    ) );

if(!ampforwp_check_extensions()){
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Upgrade to Pro', 'accelerated-mobile-pages' ),
        'id'         => 'opt-choose',
        'subsection' => false,
       'desc' => $freepro_listing,
        'icon' => 'el el-download',
    ) );
}

if(function_exists('ampforwp_plugin_supporter_activator')){
if(!function_exists('ampforwp_create_controls_for_plugin_manager')){
// Plugin Manager
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Plugins Manager', 'accelerated-mobile-pages' ),
        'id'         => 'opt-plugins-manager',
        'subsection' => false,
        'desc' => sprintf('%s <a href="http://ampforwp.com/plugins-manager" target="_blank"> %s</a>',
                esc_html__('You can Disable Plugins only in AMP which are causing AMP validation errors.','accelerated-mobile-pages'),
                esc_html__('More Information.','accelerated-mobile-pages')
             ), 
        'icon'  => 'el el-magic',
       'fields' => array(

            array(
                'id'       => 'ampforwp-plugin-manager-core',
                'type'     => 'switch',
                 'title'    => esc_html__('Enable Plugin Manager', 'accelerated-mobile-pages'),
                'default'   => 0
            ),
           array(
        'id'   => 'info_normal',
        'type' => 'info',
        'required' => array('ampforwp-plugin-manager-core', '=' , '1'), 
        'desc' =>sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/plugins-manager" target="_blank">%s</a>.<br /><div style="margin-top:4px;">(<a href="https://ampforwp.com/plugins-manager" target="_blank">%s</a>)</div></div>',
                esc_html__('ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),
                esc_html__('This feature requires','accelerated-mobile-pages'),
                esc_html__('AMP Plugin Manager','accelerated-mobile-pages'),
                esc_html__('Click here for more info','accelerated-mobile-pages')
             ),              
           ),
        )        
) );
}
}
Redux::setExtensions( $opt_name, AMPFORWP_PLUGIN_DIR.'includes/options/extensions/demolink_image_select' );
// Documentation Section
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Documentation', 'accelerated-mobile-pages' ),
        'subsection' => false,
        'desc' => '<div class="fp-cnt doc-cnt"><h1>'.esc_html__('Documentation','accelerated-mobile-pages').'</h1><p>'.esc_html__('Without documentation, software is just a black box that aren’t anywhere near as useful as they could be because their inner workings are hidden from those who need them. Documentation turns your software into a glass box by explaining to users as well as developers how it operates.','accelerated-mobile-pages').'</p><a class="buy" href="https://ampforwp.com/tutorials/" target="_blank">'.esc_html__('View Documentation','accelerated-mobile-pages').'</a></div>',
    ) );
/*
* <--- END SECTIONS
*/