<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_push_notification_default() {
    $default = '';
    if(true == ampforwp_get_setting('ampforwp-web-push-onesignal')){
      $default = '1';
    }else{
      $default = '0';
    }
    return $default;
}

function ampforwp_push_notification_options($opt_name){
    // Push Notifications section
  $izt_opt1 = $izt_opt2 = $izt_opt3 = $izt_opt4 = ''; 
  if( function_exists('izoto_html')) {
    $izt_opt1 =  array(
                            'id'        => 'ampforwp-izooto-for-amp-below-content',
                            'type'      => 'switch',
                            'title'     => 'Below the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  1,
                            'tooltip-subtitle'  => 'Show Subscribe Button Below the Content',
                            'required'  => array('ampforwp-web-push', '=' , '2'),
                          );
    $izt_opt2 = array(
                            'id'        => 'ampforwp-izooto-for-amp-above-content',
                            'type'      => 'switch',
                            'title'     => 'Above the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            'tooltip-subtitle'  => 'Show Subscribe Button Above the Content',
                            'required'  => array('ampforwp-web-push', '=' , '2'),
                          );
    $izt_opt3 = array(
                           'id' => 'ampforwp-izooto-for-amp-positioning',
                           'type' => 'section',
                           'title' => esc_html__('Positioning', 'accelerated-mobile-pages'),
                           'required' => array( 
                                            array( 'ampforwp-web-push', '=' , '2' ),
                                            array( 'amp-use-pot', '=' , 0 )
                                        ),   
                           'indent' => true,
                           'layout_type' => 'accordion',
                           'accordion-open'=> 1,
                     );
    $izt_opt4 = array(
                            'required' => array( 
                                        array( 'ampforwp-web-push', '=' , '2' ),
                                    ),   
                            'id'        => 'ampforwp-izooto-for-amp-app-id',
                            'type'      => 'text',
                            'title'     => 'Script ID',
                            'class' => 'child_opt child_opt_arrow',
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/article/how-to-setup-izooto-in-amp/" target="_blank">View Integration Tutorial</a> (HTTPS is required)',
                          );

  }
  $izooto_notice =  ''; 
  if(!function_exists('izoto_html')){
        $izooto_notice = array(
                'id'       => 'izooto-for-amp',
                'type'     => 'info',
                'style'    => 'success',
                'desc'     => 'This feature requires <a href="https://ampforwp.com/addons/iZooto-for-amp/" target="_blank"> iZooto for AMP Extension</a>',
                'required'  => array('ampforwp-web-push', '=' , '2'),
            );
  }


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
                            'id'        => 'ampforwp-web-push',
                            'type'     => 'select',
                            'title'     => esc_html__('Push Notification','accelerated-mobile-pages'),                            
                            'true'      => 'true',
                            'false'     => 'false', 
                            'options'  => array(
                              '0' => esc_html__('Select Integration Service', 'accelerated-mobile-pages' ),
                               '1' => esc_html__('OneSignal', 'accelerated-mobile-pages' ),
                               '2' => esc_html__('iZooto', 'accelerated-mobile-pages' ),
                               '4' => esc_html__('Truepush', 'accelerated-mobile-pages' ),
                              ),
                            'default'   =>  ampforwp_push_notification_default(),
                            ),
                    array(
                            'id'        => 'ampforwp-web-push-onesignal',
                            'type'     => 'select',
                            'class' => 'hide',
                            'title'     => esc_html__('Push Notification','accelerated-mobile-pages'),
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/one-signal-in-amp/" target="_blank">View Integration Tutorial</a> (HTTPS is required)',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'options'  => array(
                               '0' => esc_html__('Select Integration Service', 'accelerated-mobile-pages' ),
                               '1' => esc_html__('OneSignal', 'accelerated-mobile-pages' ),
                               '2' => esc_html__('iZooto', 'accelerated-mobile-pages' ),
                           ),
                            'default'   =>  '1',
                            ),
                    array(
                       'required' => array( 
                                        array( 'ampforwp-web-push', '=' , '1' ),
                                    ),   
                            'id'        => 'ampforwp-one-signal-app-id',
                            'type'      => 'text',
                            'title'     => 'APP ID',
                            'class' => 'child_opt child_opt_arrow',
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/one-signal-in-amp/" target="_blank">View Integration Tutorial</a> (HTTPS is required)',
                            ),
                     array(
                            'id'        => 'ampforwp-truepush-app-id',
                            'type'      => 'text',
                            'title'     => esc_html__('APP ID','accelerated-mobile-pages'),
                            'class' => 'child_opt child_opt_arrow',
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/truepush-in-amp/" target="_blank">'.esc_html__('View Integration Tutorial','accelerated-mobile-pages').'</a>',
                            'required' => array( 
                                        array( 'ampforwp-web-push', '=' , '4' ),
                                    ),  
                          ), 
                    array(
                            'id'        => 'ampforwp-truepush-public-key',
                            'type'      => 'text',
                            'title'     => esc_html__('Public Key','accelerated-mobile-pages'),
                            'class' => 'child_opt child_opt_arrow',
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/truepush-in-amp/" target="_blank">'.esc_html__('View Integration Tutorial','accelerated-mobile-pages').'</a>',
                            'required' => array( 
                                        array( 'ampforwp-web-push', '=' , '4' ),
                                    ),  
                          ),  
                    array(
                            'id'        => 'ampforwp-one-signal-page',
                            'type'      => 'switch',
                            'title'     => esc_html__('Pages','accelerated-mobile-pages'),
                            'class' => 'child_opt child_opt_arrow',
                            'tooltip-subtitle'   => esc_html__('Enable this option to show one signal notification on your pages', 'accelerated-mobile-pages'),
                            'required' => array( 'ampforwp-web-push', '=' , '1' ),        
                    ),
                    $izooto_notice, 
                    $izt_opt4,
                    array(
                       'id' => 'ampforwp-onesignal-positioning',
                       'type' => 'section',
                       'title' => esc_html__('Positioning', 'accelerated-mobile-pages'),
                       'required' => array(
                                        array( 'amp-use-pot', '=' , 0 ),
                                        array( 'ampforwp-web-push', '!=' , 0 )
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
                            'required'  => array('ampforwp-web-push', '=' , '1'),
                            ),                   
                    array(
                            'id'        => 'ampforwp-web-push-onesignal-above-content',
                            'type'      => 'switch',
                            'title'     => 'Above the Content',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            'tooltip-subtitle'  => 'Show Subscribe Button Above the Content',
                            'required'  => array('ampforwp-web-push', '=' , '1'),
                            ),
                    array(
                            'id'        => 'ampforwp-web-push-truepush-below-content',
                            'type'      => 'switch',
                            'title'     => esc_html__('Below Content','accelerated-mobile-pages'),
                            'default'   =>  1,
                            'tooltip-subtitle'  => esc_html__('Show Subscribe Button Below the Content','accelerated-mobile-pages'),
                            'required'  => array('ampforwp-web-push', '=' , '4'),
                            ),                   
                    array(
                            'id'        => 'ampforwp-web-push-truepush-above-content',
                            'type'      => 'switch',
                            'title'     => esc_html__('Above Content','accelerated-mobile-pages'), 
                            'default'   =>  0,
                            'tooltip-subtitle'  => esc_html__('Show Subscribe Button Above the Content','accelerated-mobile-pages'),
                            'required'  => array('ampforwp-web-push', '=' , '4'),
                            ),
                    $izt_opt3,
                    $izt_opt1,$izt_opt2,
                    array(
                            'id'        => 'ampforwp-web-push-onesignal-popup',
                            'type'      => 'switch',
                            'title'     => 'Popup on Desktop',
                            'default'   =>  0,
                            'tooltip-subtitle'  => 'Show Subscribe Button in Popup on Desktop',
                            'required'  => array('ampforwp-web-push-onesignal', '=' , '1'),
                    ),
                    array(
                       'id' => 'translation',
                       'type' => 'section',
                       'title' => esc_html__('Translation', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                        'accordion-open'=> 1,
                        'required'=> array( 'ampforwp-web-push', '!=' , 0 ),
                    ),
                    array(
                       'id'       => 'ampforwp-onesignal-translator-subscribe',
                       'type'     => 'text',
                       'title'    => esc_html__('Subscribe', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Subscribe to updates','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('Add some text','accelerated-mobile-pages'),
                       'required'=> array( array(  'ampforwp-web-push', '=' , '1' )),
                   ),
                     array(
                       'id'       => 'ampforwp-onesignal-translator-unsubscribe',
                       'type'     => 'text',
                       'title'    => esc_html__('Unsubscribe', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Unsubscribe from updates','accelerated-mobile-pages'),
                       'placeholder'=>esc_html__('Add some text','accelerated-mobile-pages'),
                       'required'=> array( array(  'ampforwp-web-push', '=' , '1' )),
                   ),
                   array(
                       'id'       => 'ampforwp-truepush-translator-subscribe',
                       'type'     => 'text',
                       'title'    => esc_html__('Subscribe', 'accelerated-mobile-pages'),
                       'default'  => esc_html__('Subscribe to Notifications','accelerated-mobile-pages'),
                       'required'=> array( array(  'ampforwp-web-push', '=' , '4' )),
                   ),  
                   array(
                       'id' => 'ampforwp-onesignal-exper',
                       'type' => 'section',
                       'title' => esc_html__('Experimental', 'accelerated-mobile-pages'),
                       'required' => array( 
                                        array( 'ampforwp-web-push', '=' , '1' ),
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
                            'required'  => array('ampforwp-web-push', '=' , '1'),
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
                                            array('ampforwp-web-push', '=' , '1'),
                                            array('ampforwp-onesignal-http-site', '=','1')),
                        ),
                )
            ) 
    );
}