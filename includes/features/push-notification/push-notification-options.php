<?php
use ReduxCore\ReduxFramework\Redux;
function ampforwp_push_notification_options($opt_name){
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
}