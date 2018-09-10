<?php
use ReduxCore\ReduxFramework\Redux;
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
           'type'     => 'textarea',
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
               'class'  => 'child_opt',
               'id'        =>'amp-notice-bar-select-privacy-page',
               'type'      => 'select',
               'title'     => __('Select the Privacy Page', 'accelerated-mobile-pages'),
               'tooltip-subtitle'  => __('Select the Privacy Page to display.', 'accelerated-mobile-pages'),
               'default'   => 0,
               'data'      => 'pages',
               'required' => array('amp-enable-notifications', '=' , '1'),
           ),
           array(
               'class'  => 'child_opt',
               'id'        =>'amp-notice-bar-privacy-page-button-text',
               'type'      => 'text',
               'title'     => __('Privacy Page Button Text', 'accelerated-mobile-pages'),
               'default'   => 'Read More',
               'required' => array('amp-enable-notifications', '=' , '1'),
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
       ),

   ) );
   }