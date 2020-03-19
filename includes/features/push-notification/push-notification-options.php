<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_push_notification_options($opt_name){
    // Push Notifications section
   Redux::setSection( $opt_name, array(
          'title'       => esc_html__( 'Push Notifications', 'accelerated-mobile-pages' ),
//          'icon'        => 'el el-podcast',
          'id'          => 'ampforwp-push-notifications',
          'desc'        => " ",
          'subsection'  => true,
          'fields'      => array(

          array(
            'id' => 'ampforwp-pushnot-1',
            'type' => 'section',
            'title' => esc_html__('Push Notification Support', 'accelerated-mobile-pages'),
            'indent' => true,
            'layout_type' => 'accordion',
            'accordion-open'=> 1, 
          ),
                    array(
                            'id'        => 'ampforwp-web-push-onesignal',
                            'type'     => 'select',
                            'title'     => esc_html__('Push Notification','accelerated-mobile-pages'),
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/one-signal-in-amp/" target="_blank">View Integration Tutorial</a> (HTTPS is required)',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'options'  => array(
                               'onesignal' => esc_html__('OneSignal', 'accelerated-mobile-pages' ),
                               'izooto' => esc_html__('iZooto', 'accelerated-mobile-pages' ),
                           ),
                            'default'   =>  'onesignal',
                            ),
                    array(
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 'onesignal' ),
                                    ),   
                            'id'        => 'ampforwp-one-signal-app-id',
                            'type'      => 'text',
                            'title'     => 'APP ID',
                            'class' => 'child_opt child_opt_arrow',
                            ),
                    array(
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 'izooto' ),
                                    ),   
                            'id'        => 'ampforwp-izooto-for-amp-app-id',
                            'type'      => 'text',
                            'title'     => 'Script ID',
                            'class' => 'child_opt child_opt_arrow',
                            ),
                    array(
                       'id' => 'ampforwp-onesignal-positioning',
                       'type' => 'section',
                       'title' => esc_html__('Positioning', 'accelerated-mobile-pages'),
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 'onesignal' ),
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
                            'required'  => array('ampforwp-web-push-onesignal', '=' , 'onesignal'),
                            ),                   
                    array(
                            'id'        => 'ampforwp-web-push-onesignal-above-content',
                            'type'      => 'switch',
                            'title'     => 'Above the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            'tooltip-subtitle'  => 'Show Subscribe Button Above the Content',
                            'required'  => array('ampforwp-web-push-onesignal', '=' , 'onesignal'),
                            ),

                    array(
                       'id' => 'ampforwp-izooto-for-amp-positioning',
                       'type' => 'section',
                       'title' => esc_html__('Positioning', 'accelerated-mobile-pages'),
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 'izooto' ),
                                        array( 'amp-use-pot', '=' , 0 )
                                    ),   
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
                    ),
                    array(
                            'id'        => 'ampforwp-izooto-for-amp-below-content',
                            'type'      => 'switch',
                            'title'     => 'Below the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  1,
                            'tooltip-subtitle'  => 'Show Subscribe Button Below the Content',
                            'required'  => array('ampforwp-web-push-onesignal', '=' , 'izooto'),
                            ),                   
                    array(
                            'id'        => 'ampforwp-izooto-for-amp-above-content',
                            'type'      => 'switch',
                            'title'     => 'Above the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            'tooltip-subtitle'  => 'Show Subscribe Button Above the Content',
                            'required'  => array('ampforwp-web-push-onesignal', '=' , 'izooto'),
                            ),
                    array(
                       'id' => 'translation',
                       'type' => 'section',
                       'title' => esc_html__('Translation', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                    ),
                    array(
                       'id'       => 'ampforwp-onesignal-translator-subscribe',
                       'type'     => 'text',
                       'title'    => esc_html__('Subscribe', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Subscribe to updates','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('Add some text','accelerated-mobile-pages'),
                   ),
                     array(
                       'id'       => 'ampforwp-onesignal-translator-unsubscribe',
                       'type'     => 'text',
                       'title'    => esc_html__('Unsubscribe', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Unsubscribe from updates','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('Add some text','accelerated-mobile-pages'),
                       'required'=> array( array(  'ampforwp-web-push-onesignal', '=' , 'onesignal' )),
                   ),
                   array(
                       'id' => 'ampforwp-onesignal-exper',
                       'type' => 'section',
                       'title' => esc_html__('Experimental', 'accelerated-mobile-pages'),
                       'required' => array( 
                                        array( 'ampforwp-web-push-onesignal', '=' , 'onesignal' ),
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
                            'required'  => array('ampforwp-web-push-onesignal', '=' , 'onesignal'),
                            'true'      => 'true',
                            'false'     => 'false',
                            'default'   => 0
                        ),
                    array(
                            'id'        => 'ampforwp-onesignal-subdomain',
                            'type'      => 'text',
                            'title'     => 'Subdomain',
                            'desc'      => esc_html__('Example: ampforwp', 'accelerated-mobile-pages'),
                            'required'  => array(
                                            array('ampforwp-web-push-onesignal', '=' , 'onesignal'),
                                            array('ampforwp-onesignal-http-site', '=','1')),
                        ),
                )
            ) 
    );
}