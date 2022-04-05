<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_notice_bar_options($opt_name){
  // If CTA is not Activated
  $cta_desc = "";
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
     if(!is_plugin_active( 'AMP-cta/amp-cta.php' )){
  $cta_AD_URL = "http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=call-to-action_banner_in_notification_bar&utm_campaign=AMP%20Plugin";
  $cta_desc = '<a href="'.$cta_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/cta-banner.png" width="560" height="85" /></a>';
  }
 // Notifications SECTION
   Redux::setSection( $opt_name, array(
       'title'      => esc_html__( 'Notice Bar & GDPR', 'accelerated-mobile-pages' ),
          'desc'       => $cta_desc ,
       'id'         => 'amp-notifications',
       'class'      => '',
       'subsection' => true,
       'fields'     => array(
           array(
            'id' => 'ampforwp-notice_2',
            'type' => 'section',
            'title' => esc_html__('Notice Bar (Cookie Consent)', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
            'required'  => array('amp-gdpr-compliance-switch', '=' , '0')
                  ),
           
           array(
               'id'        =>'amp-enable-notifications',
               'type'      => 'switch',
               'title'     => esc_html__('Notifications', 'accelerated-mobile-pages'),
               'default'   => '',
               'tooltip-subtitle'  => esc_html__('Show notifications on all of your AMP pages for cookie purposes, or anything else.', 'accelerated-mobile-pages'),
               'true'      => 'Enabled',
               'false'     => 'Disabled',
               'required'  => array('amp-gdpr-compliance-switch', '=' , '0')
           ),
           array(
           'class' => 'child_opt child_opt_arrow',
           'id'       => 'amp-notification-text',
           'title'    => esc_html__('Notice Content', 'accelerated-mobile-pages'),
           'type'     => 'textarea',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => esc_html__('This website uses cookies.','accelerated-mobile-pages'),
           'placeholder' => esc_html__('Enter Text here','accelerated-mobile-pages'),
           'tooltip-subtitle' => esc_html__('Enter the message you want to show in the notice bar. You can also paste HTML in it but only <span><a><b><i><br> tags are allowed.', 'accelerated-mobile-pages'),
           ),
           array(
           'class' => 'child_opt',
           'id'       => 'amp-accept-button-text',
           'title'    => esc_html__('Button Text', 'accelerated-mobile-pages'),
           'type'     => 'text',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => esc_html__('Accept','accelerated-mobile-pages'),
           'placeholder' => esc_html__('Enter Text here','accelerated-mobile-pages'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-enable-links',
               'type'      => 'switch',
               'title'     => esc_html__('Link', 'accelerated-mobile-pages'),
               'default'   => '',
               'true'      => 'Enabled',
               'false'     => 'Disabled',
               'required' => array('amp-enable-notifications', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-notice-bar-select-privacy-page',
               'type'      => 'text',
               'title'     => esc_html__('Enter the URL of Privacy Page', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('Enter URL of Privacy Page where the user can read your Website Privacy', 'accelerated-mobile-pages'),
               'default'   => '#',
               'required' => array('amp-enable-links', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-notice-bar-privacy-page-button-text',
               'type'      => 'text',
               'title'     => esc_html__('Privacy Page Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Read More',
               'required' => array('amp-enable-links', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'ampforwp-notifications-nofollow',
               'type'      => 'switch',
               'title'     => esc_html__('No Follow link', 'accelerated-mobile-pages'),
               'default'   => 0,
               'tooltip-subtitle'  => esc_html__('Add nofollow to the notification link.', 'accelerated-mobile-pages'),
               'required' => array('amp-enable-links', '=' , '1'),
           ),
           array(
            'id' => 'ampforwp-notice_1',
            'type' => 'section',
            'title' => esc_html__('GDPR (General Data Protection Regulation)', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
                  ),
           array(
               'id'        =>'amp-gdpr-compliance-switch',
               'type'      => 'switch',
               'title'     => esc_html__('GDPR Compliancy', 'accelerated-mobile-pages'),
               'default'   => 0,
               'tooltip-subtitle' => 'Currently It is available to only EEA countries. Check <a href="https://github.com/ampproject/amphtml/blob/master/extensions/amp-geo/0.1/amp-geo-presets.js" target="_blank">here</a> for the list of EEA Countries'
           ),
           array(
                    'id'    => 'gdpr-type',
                   'title'  => esc_html__('GDPR Designs', 'accelerated-mobile-pages'),
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
                    'id'    => 'amp-gdpr-type2-position',
                   'title'  => esc_html__('GDPR Popup Position', 'accelerated-mobile-pages'),
                   'type'   => 'select',
                   'options'=> array(
                        '1' =>  'Top',
                        '2' =>  'Bottom'
                    ),
                   'default'=> '1',
                  'required' => array(
                      array('gdpr-type','=',2)
                    )    
            ),
           array(
               'class'  => 'child_opt child_opt_arrow',
               'id'        =>'amp-gdpr-compliance-headline-text',
               'type'      => 'text',
               'title'     => esc_html__('Headline Text', 'accelerated-mobile-pages'),
               'default'   => 'Headline',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'tooltip-subtitle'  => 'This is the message that you want to share with the audience',
               'id'        =>'amp-gdpr-compliance-textarea',
               'type'      => 'textarea',
               'title'     => esc_html__('Message to Visitor', 'accelerated-mobile-pages'),
               'subtitle'     => esc_html__('', 'accelerated-mobile-pages'),
               'default'   => '',
               'required' =>  array(  array('amp-gdpr-compliance-switch', '=' , '1', ), array('gdpr-type', '=' , '1' ) ),
           ),
           
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-accept-text',
               'type'      => 'text',
               'title'     => esc_html__('Accept Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Accept',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-reject-text',
               'type'      => 'text',
               'title'     => esc_html__('Reject Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Reject',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-settings-text',
               'type'      => 'text',
               'title'     => esc_html__('Settings Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Privacy Settings',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-for-more-privacy-info',
               'type'      => 'text',
               'title'     => esc_html__('For More information', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('text before the privacy page button.', 'accelerated-mobile-pages'),
               'default'   => 'For More information about Privacy',
               'required' =>  array(  array('amp-gdpr-compliance-switch', '=' , '1', ), array('gdpr-type', '=' , '1' ) ),
           ),
          
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-select-privacy-page',
               'type'      => 'select',
               'title'     => esc_html__('Select the Privacy Page', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => esc_html__('Select the Privacy Page to display.', 'accelerated-mobile-pages'),
               'default'   => 0,
               'data'      => 'pages',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-gdpr-compliance-privacy-page-button-text',
               'type'      => 'text',
               'title'     => esc_html__('Privacy Page Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Click Here',
               'required' => array('amp-gdpr-compliance-switch', '=' , '1'),
           ),
           array(
               'id'        =>'amp-gdpr-newguidelines-switch',
               'type'      => 'switch',
               'class'  => 'child_opt',
               'title'     => esc_html__('New Guidelines', 'accelerated-mobile-pages'),
               'default'   => 0,
           ),
            array(
            'id' => 'ampforwp-notice-quantcast',
            'type' => 'section',
            'title' => esc_html__('Quantcast Notice Bar in AMP', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
                  ),
           array(
               'id'        =>'amp-quantcast-notice-switch',
               'type'      => 'switch',
               'title'     => esc_html__('Quantcast Notice Bar', 'accelerated-mobile-pages'),
               'default'   => 0,
               'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to add quantcast notice bar in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-quantcast-notice-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-quantcast-id',
               'type'      => 'text',
               'title'     => esc_html__('Account Id', 'accelerated-mobile-pages'),
               'placeholder'=> 'Quantcast Account Id',
               'required' => array('amp-quantcast-notice-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-quantcast-hashcode',
               'type'      => 'text',
               'title'     => esc_html__('Hash Code', 'accelerated-mobile-pages'),
               'placeholder'=> '3BDXDqoakCk4Q4LzQqBGVQ',
               'required' => array('amp-quantcast-notice-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-quantcast-publishercountrycode',
               'type'      => 'text',
               'title'     => esc_html__('Publisher Country Code', 'accelerated-mobile-pages'),
               'placeholder'=> 'US',
               'required' => array('amp-quantcast-notice-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-quantcast-publishername',
               'type'      => 'text',
               'title'     => esc_html__('Publisher Name', 'accelerated-mobile-pages'),
               'placeholder'=> 'TestMeOut',
               'required' => array('amp-quantcast-notice-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-quantcast-privacy-mode',
               'type'      => 'text',
               'title'     => esc_html__('Privacy Mode', 'accelerated-mobile-pages'),
               'placeholder'=> 'GDPR',
               'required' => array('amp-quantcast-notice-switch', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-quantcast-lang',
               'type'      => 'text',
               'title'     => esc_html__('Language', 'accelerated-mobile-pages'),
               'placeholder'=> 'en',
               'required' => array('amp-quantcast-notice-switch', '=' , '1'),
           ),
           array(
           'class' => 'amp-popup-fld',
           'id'   => 'info_normal_amp_popup',
           'type'     => 'info',
            'desc' => '<a href="https://ampforwp.com/amp-popup/"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/popup_ext.png" width="560" height="85" /></a>',   
           ),    
       ),

   ) );
}