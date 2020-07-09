<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 function ampforwp_admin_contact_form_options($opt_name){
	 // contact form 7 
	$forms_support[] =  array(
	            'id' => 'ampforwp-cfs_1',
	            'type' => 'section',
	            'title' => esc_html__('CF7 Compatibility', 'accelerated-mobile-pages'),
	            'indent' => true,
	            'layout_type' => 'accordion',
	            'accordion-open'=> 1, 
	          );
	$forms_support[] =  array(
	               'id'        =>'amp-enable-contactform',
	               'type'      => 'switch',
	               'title'     => esc_html__('Contact Form 7 Support', 'accelerated-mobile-pages'),
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
	            'title' => esc_html__('Gravity Forms Compatibility', 'accelerated-mobile-pages'),
	            'indent' => true,
	            'layout_type' => 'accordion',
	            'accordion-open'=> 1, 
	        );
	        $forms_support[] = array(
	            'id'        =>'amp-enable-gravityforms_support',
	            'type'      => 'switch',
	            'title'     => esc_html__('Gravity Forms Support', 'accelerated-mobile-pages'),
	            'default'   => '',
	            'true'      => 'Enabled',
	            'false'     => 'Disabled',
	        );
	    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
	    if(!is_plugin_active( 'amp-gravity-forms/amp-gravity-forms.php' ) ){
	        $forms_support[]= array(
	                        'id'   => 'info_normal_gf',
	                        'type' => 'info',
	                        'required' => array('amp-enable-gravityforms_support', '=' , '1'),
	                        'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/gravity-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Gravity Forms extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/gravity-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Click here for more info</a>)</div></div>',               
	        );
	    }
	    // Ninja Forms 
	        $forms_support[] =  array(
	            'id' => 'ampforwp-ninja-forms',
	            'type' => 'section',
	            'title' => esc_html__('Ninja Forms Compatibility', 'accelerated-mobile-pages'),
	            'indent' => true,
	            'layout_type' => 'accordion',
	            'accordion-open'=> 1, 
	        );
	        $forms_support[] = array(
	            'id'        =>'amp-enable-ninja-forms-support',
	            'type'      => 'switch',
	            'title'     => esc_html__('Ninja Forms Support', 'accelerated-mobile-pages'),
	            'default'   => '',
	            'true'      => 'Enabled',
	            'false'     => 'Disabled',
	        );
	    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
	    if(!function_exists('ampforwp_ninja_initiate_plugin') ){
	        $forms_support[]= array(
	                        'id'   => 'info_normal_2',
	                        'type' => 'info',
	                        'required' => array('amp-enable-ninja-forms-support', '=' , '1'),
	                        'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin:-45px -14px -18px -17px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/ninja-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Ninja Forms extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/ninja-forms/#utm_source=options-panel&utm_medium=gf-tab_gf_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Click here for more info</a>)</div></div>',               
	        );
	    }
	 
	   // Contact Form SECTION
	   Redux::setSection( $opt_name, array(
	       'title'      => esc_html__( 'Contact Form', 'accelerated-mobile-pages' ),
	       'id'         => 'amp-contact',
	       'subsection' => true,
	       'fields'     => $forms_support

	   ) );
	}