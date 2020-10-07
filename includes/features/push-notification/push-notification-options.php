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
  $izt_opt1 = $izt_opt2 =  $izt_opt3 = $izt_opt4 = '';
  if( function_exists('izoto_html')) {
    $izt_opt1 =  array(
                            'id'        => 'ampforwp-izooto-for-amp-below-content',
                            'type'      => 'switch',
                            'title'     => esc_html__('Below the Content','accelerated-mobile-pages'),
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  1,
                            'tooltip-subtitle'  => esc_html__('Show Subscribe Button Below the Content','accelerated-mobile-pages'),
                            'required'  => array('ampforwp-web-push', '=' , '2'),
                          );
    $izt_opt2 = array(
                            'id'        => 'ampforwp-izooto-for-amp-above-content',
                            'type'      => 'switch',
                            'title'     => esc_html__('Above the Content','accelerated-mobile-pages'),
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            'tooltip-subtitle'  => esc_html__('Show Subscribe Button Above the Content','accelerated-mobile-pages'),
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
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/article/how-to-setup-izooto-in-amp/" target="_blank">'.esc_html__('View Integration Tutorial','accelerated-mobile-pages').'</a> '.esc_html__('(HTTPS is required)','accelerated-mobile-pages').'',
                          );

  }
  if(!function_exists('izoto_html')){
        $izooto_notice = array(
                'id'       => 'izooto-for-amp',
                'type'     => 'info',
                'style'    => 'success',
                'desc'     => ''.esc_html__('This feature requires','accelerated-mobile-pages').' <a href="https://ampforwp.com/addons/iZooto-for-amp/" target="_blank"> '.esc_html__('iZooto for AMP Extension','accelerated-mobile-pages').'</a>',
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
//$izt_opt1,
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
                               '3' => esc_html__('Push Notifications for WP & AMP', 'accelerated-mobile-pages' ),
                               '4' => esc_html__('Truepush', 'accelerated-mobile-pages' ),
                              ),
                            'default'   =>  ampforwp_push_notification_default(),
                            ),
                    array(
                            'id'        => 'ampforwp-web-push-onesignal',
                            'type'     => 'select',
                            'class' => 'hide',
                            'title'     => esc_html__('Push Notification','accelerated-mobile-pages'),
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/one-signal-in-amp/" target="_blank">'.esc_html__('View Integration Tutorial','accelerated-mobile-pages').'</a> '.esc_html__('(HTTPS is required)','accelerated-mobile-pages').'',
                            'true'      => 'true',
                            'false'     => 'false', 
                            'options'  => array(
                               '0' => esc_html__('Select Integration Service', 'accelerated-mobile-pages' ),
                               '1' => esc_html__('OneSignal', 'accelerated-mobile-pages' ),
                               '2' => esc_html__('iZooto', 'accelerated-mobile-pages' ),
                               '3' => esc_html__('Push Notifications for WP & AMP', 'accelerated-mobile-pages' ),
                           ),
                            'default'   =>  '1',
                            ),
                    $izooto_notice,
                    array(
                       'required' => array( 
                                        array( 'ampforwp-web-push', '=' , '1' ),
                                    ),   
                            'id'        => 'ampforwp-one-signal-app-id',
                            'type'      => 'text',
                            'title'     => esc_html__('APP ID','accelerated-mobile-pages'),
                            'class' => 'child_opt child_opt_arrow',
                            'tooltip-subtitle'  => '<a href="https://ampforwp.com/tutorials/one-signal-in-amp/" target="_blank">'.esc_html__('View Integration Tutorial','accelerated-mobile-pages').'</a> '.esc_html__('(HTTPS is required)','accelerated-mobile-pages').'',
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
                            'required' => array( 'ampforwp-web-push', '=' , '1' ),        
                            ),
                         array(
                          'id'       => 'ampforwp-push-notifications-module',
                          'type'     => 'raw',
                          'required'  => array('ampforwp-web-push', '=' , '3'),
                          'content'  => '<div class="ampforwp-st-data-update">'.(!function_exists('push_notification_initialize')? 'Easiest way to send web push notifications:': 'Thank you for upgrading the Push notifications').'<div class="row">'.(!function_exists('push_notification_initialize')? '<div class="col-3"><ul><li>Free & Easy setup</li><li>PWA Friendly (with offline push notifications)</li><li>Native WordPress Integration</li></ul> </div>' : '').'<div class="col-1">'.(!function_exists('push_notification_initialize')?'<div class="install-now ampforwp-activation-call-module-upgrade button  " id="ampforwp-push-notification-activation-call" data-secure="'.wp_create_nonce('verify_module').'"><p>Install Now for Free</p>
                                </div>' : '<a href="'.admin_url('admin.php?page=push-notification&tab=general&reference=ampforwp').'"><div class="ampforwp-recommendation-btn updated-message"><p>Go To Push Notification Settings</p></div></a>') .'&nbsp;<a href="https://pushnotifications.helpscoutdocs.com/" class="amp_recommend_learnmore" target="_blank">Learn more</a></div></div>' ),
                    $izt_opt4,
                    array(
                       'id' => 'ampforwp-onesignal-positioning',
                       'type' => 'section',
                       'title' => esc_html__('Positioning', 'accelerated-mobile-pages'),
                       'required' => array(
                                        array( 'amp-use-pot', '=' , 0 )
                                    ),   
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
                    ),
                    array(
                            'id'        => 'ampforwp-web-push-onesignal-below-content',
                            'type'      => 'switch',
                            'title'     => esc_html__('Below the Content','accelerated-mobile-pages'),
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  1,
                            'tooltip-subtitle'  => esc_html__('Show Subscribe Button Below the Content','accelerated-mobile-pages'),
                            'required'  => array('ampforwp-web-push', '=' , '1'),
                            ),                   
                    array(
                            'id'        => 'ampforwp-web-push-onesignal-above-content',
                            'type'      => 'switch',
                            'title'     => esc_html__('Above the Content','accelerated-mobile-pages'),
                            'true'      => 'true',
                            'false'     => 'false', 
                            'default'   =>  0,
                            'tooltip-subtitle'  => esc_html__('Show Subscribe Button Above the Content','accelerated-mobile-pages'),
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
                            'title'     => esc_html__('HTTP Site','accelerated-mobile-pages'),
                            'tooltip-subtitle'  => esc_html__('For HTTP Sites Only','accelerated-mobile-pages'),
                            'required'  => array('ampforwp-web-push', '=' , '1'),
                            'true'      => 'true',
                            'false'     => 'false',
                            'default'   => 0
                        ),
                    array(
                            'id'        => 'ampforwp-onesignal-subdomain',
                            'type'      => 'text',
                            'title'     => esc_html__('Subdomain','accelerated-mobile-pages'),
                            'desc'      => esc_html__('Example: ampforwp', 'accelerated-mobile-pages'),
                            'required'  => array(
                                            array('ampforwp-web-push', '=' , '1'),
                                            array('ampforwp-onesignal-http-site', '=','1')),
                        ),  
                               
                )
            ) 
    );
}