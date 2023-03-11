<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_get_default_analytics($param=""){
    $default = ''; 
    $default = ampforwp_get_setting('amp-analytics-select-option');
    if($param == $default){
        return true;
    }
    else
        return false;
  }
function ampforwp_analytics_options($opt_name){
  // Analytics SECTION
   Redux::setSection( $opt_name,    array(
                'title' => esc_html__('Analytics'),
                // 'icon' => 'el el-th-large',
                'id' => 'analytics',
                'subsection' => true,
                'fields' =>
                    array(
                    array(
                        'id'       => 'amp-analytics-select-option',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Analytics Type', 'accelerated-mobile-pages' ),
                        'class'    => 'hide',
                        'tooltip-subtitle' => esc_html__( 'Select your Analytics provider.', 'accelerated-mobile-pages' ),
                        'options'  => array(
                            '1' => esc_html__('Google Analytics', 'accelerated-mobile-pages' ),
                            '2' => esc_html__('Segment Analytics', 'accelerated-mobile-pages' ),
                            '3' => esc_html__('Matomo (Piwik) Analytics', 'accelerated-mobile-pages' ),
                            '4' => esc_html__('Quantcast Measurement', 'accelerated-mobile-pages' ),
                            '5' => esc_html__('comScore', 'accelerated-mobile-pages' ),
                            '6' => esc_html__('Effective Measure', 'accelerated-mobile-pages' ),
                            '7' => esc_html__('StatCounter', 'accelerated-mobile-pages' ),
                            '8' => esc_html__('Histats Analytics', 'accelerated-mobile-pages'),
                            '9' => esc_html__('Yandex Metrika', 'accelerated-mobile-pages'),
                            '10' => esc_html__('Chartbeat Analytics', 'accelerated-mobile-pages'),
                            '11' => esc_html__('Alexa Metrics', 'accelerated-mobile-pages'),
                            '12' => esc_html__('AFS Analytics', 'accelerated-mobile-pages'),
                            '13' => esc_html__('Adobe Analytics', 'accelerated-mobile-pages'),
                            '14' => esc_html__('Facebook Pixel', 'accelerated-mobile-pages'),
                            '15' => esc_html__('Clicky Analytics', 'accelerated-mobile-pages'),
                        ),
                        'default'  => '1',
                    ),  

                array(
                      'id' => 'ampforwp-analytics_1',
                      'type' => 'section',
                      'title' => esc_html__('Primary Analytics Provider', 'accelerated-mobile-pages'),
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
                          'title'    => esc_html__( 'Tracking ID', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1'),
                            array('ampforwp-ga-field-advance-switch', '=' , '0')
                          ),
                          'tooltip-subtitle' => esc_html__( 'Enter your Google Analytics ID. Example: UA-XXXXX-Y', 'accelerated-mobile-pages' ),
                          'default'  => 'UA-XXXXX-Y',
                      ),
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-ga-field-anonymizeIP',
                          'type'     => 'switch',
                          'title'    => esc_html__( 'IP Anonymization', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1')
                          ),
                          'default'  => 1,
                      ),
                      array(
                          'class'    => 'child_opt',
                          'id'       => 'ampforwp-ga-field-linker',
                          'type'     => 'switch',
                          'title'    => esc_html__( 'AMP Linker', 'accelerated-mobile-pages' ),
                          'required' => array('ampforwp-ga-switch', '=' , '1'),
                          'tooltip-subtitle' => sprintf( '<a href="%s" target="_blank">%s</a> %s', 
                                            esc_url('https://amphtml.wordpress.com/2018/09/17/measuring-user-journeys-across-the-amp-cache-and-your-website/amp/'), 
                                            esc_html__( 'Click Here','accelerated-mobile-pages' ), 
                            esc_html__( 'for more details on AMP Linker','accelerated-mobile-pages' ) ),             
                          'default'  => 0,
                      ),
                      array(
                          'class'    => 'child_opt',
                          'id'       => 'ampforwp-ga-field-author',
                          'type'     => 'switch',
                          'title'    => esc_html__( 'Author Pageview', 'accelerated-mobile-pages' ),
                          'required' => array('ampforwp-ga-switch', '=' , '1'),
                          'tooltip-subtitle' => sprintf( '<a href="%s" target="_blank">%s</a> %s', 
                                            esc_url('https://ampforwp.com/tutorials/article/how-to-track-author-pageview-analytics-in-amp'),
                                            esc_html__( 'Click Here','accelerated-mobile-pages' ), 
                            esc_html__( 'for more details on Author Pageview','accelerated-mobile-pages' ) ),             
                          'default'  => 0,
                      ),
                       array(
                            'class'=>'child_opt child_opt_arrow',
                            'id'            =>'ampforwp-ga-field-author-index',
                            'type'          => 'text',
                            'title'         => esc_html__('Index of Author','accelerated-mobile-pages'),
                            'default' => '',
                            'tooltip-subtitle'  => 'Index number of author in custom dimension section',
                            'required' => 
                                array('ampforwp-ga-field-author', '=' , '1'),
                        ),
                      // Advance Tracking options for Google Analytics
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-ga-field-advance-switch',
                          'type'     => 'switch',
                          'title'    => esc_html__( 'Customize Configuration', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1')
                          ),
                          'default'  => 0,
                      ),
                      array(
                          'class' => 'child_opt',
                        'id'       => 'ampforwp-ga-field-advance',
                        'type'     => 'ace_editor',
                        'title'    => esc_html__('Analytics Code in JSON Format', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'    => sprintf( '%s<a href="%s" target="_blank">%s</a>', esc_html__( 'Tutorial: ','accelerated-mobile-pages' ), esc_url('https://ampforwp.com/tutorials/article/add-advanced-google-analytics-amp/'),  esc_html__( 'How To Add Advanced Google Analytics in AMP?','accelerated-mobile-pages' ) ),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1'),
                            array('ampforwp-ga-field-advance-switch', '=' , '1')
                        ),
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'desc'     => '',
                        'default'  => ('{
    "vars" : {
      "gtag_id": "UA-xxxxxxx-x",
      "config" : {
        "UA-xxxxxxx-x": { "groups": "default" }
      }
    },
    "triggers": {
        "trackPageview": {
            "on": "visible",
            "request": "pageview"
        }
    }
}')
                    ),

                      // Google Analytics 4
                       array(
                          'id' => 'ampforwp-ga4-switch',
                          'type'  => 'switch',
                          'title' => 'Google Analytics 4',
                          'tooltip-subtitle' => esc_html__( 'Enable Google Analytics 4 in AMP.', 'accelerated-mobile-pages' ),
                          'default'  => 0,
                        ),
                        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'       => 'ampforwp-ga4-id',
                            'type'     => 'text',
                            'title'    => esc_html__( 'GA4 Measurement ID', 'accelerated-mobile-pages' ),
                            'required' => array(
                              array('ampforwp-ga4-switch', '=' , '1'),
                            ),
                            'tooltip-subtitle' => esc_html__( 'Enter your Your Measurement ID Example: G-XXXXXXXX', 'accelerated-mobile-pages' ),
                            'default'  => 'G-XXXXXXXX',
                        ),
                        array(
                            'class'    => 'child_opt',
                            'id'       => 'ampforwp-ga4-dpe',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Default Pageview Enabled', 'accelerated-mobile-pages' ),
                            'required' => array('ampforwp-ga4-switch', '=' , '1'),             
                            'tooltip-subtitle' => esc_html__( 'If this option is enabled then page_view event fire on the page load', 'accelerated-mobile-pages' ),
                            'default'  => 1,
                        ),
                        array(
                            'class'    => 'child_opt',
                            'id'       => 'ampforwp-ga4-gce',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Google Consent Enabled', 'accelerated-mobile-pages' ),
                            'required' => array('ampforwp-ga4-switch', '=' , '1'),
                            'tooltip-subtitle' => esc_html__( 'If this option is enabled then &gcs parameter will be added to the payloads with the current Consent Status', 'accelerated-mobile-pages' ),             
                            'default'  => 0,
                        ),
                        array(
                            'class'    => 'child_opt',
                            'id'       => 'ampforwp-ga4-wvt',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Webvitals Tracking', 'accelerated-mobile-pages' ),
                            'required' => array('ampforwp-ga4-switch', '=' , '1'),
                            'tooltip-subtitle' => esc_html__( 'If this option is enabled then webvitals event will fire 5 seconds after the page is visible', 'accelerated-mobile-pages' ),             
                            'default'  => 0,
                        ),
                        array(
                            'class'    => 'child_opt',
                            'id'       => 'ampforwp-ga4-ptt',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Performance Timing Tracking', 'accelerated-mobile-pages' ),
                            'required' => array('ampforwp-ga4-switch', '=' , '1'),
                            'tooltip-subtitle' => esc_html__( 'If this option is enabled then performance_timing event including the current page load performance timings', 'accelerated-mobile-pages' ),             
                            'default'  => 0,
                        ),

                      //GTM
                        array(
                            'id'       => 'amp-use-gtm-option',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Google Tag Manager', 'accelerated-mobile-pages' ),
                            'tooltip-subtitle' => esc_html__( 'Enable GTM Support in AMP.', 'accelerated-mobile-pages' ),
                            'default'  => 0,
                        ),
                        array(
                            'class'=>'child_opt child_opt_arrow',
                            'id'            =>'amp-gtm-id',
                            'type'          => 'text',
                            'title'         => esc_html__('Tag Manager ID (Container ID)','accelerated-mobile-pages'),
                            'default'       => '',
                            'tooltip-subtitle'  => sprintf('Eg: GTM-5XXXXXP (<a href="%s" style="color:#f1f1f1;">%s</a>)', esc_url('https://ampforwp.com/tutorials/article/gtm-in-amp/'), esc_html( 'Getting Started?', 'accelerated-mobile-pages') ),
                            //  'validate' => 'not_empty',
                              'required' => array(
                                array('amp-use-gtm-option', '=' , '1')
                              ),
                        ),
                        array(
                            'class'=>'child_opt child_opt_arrow',
                            'id'            =>'amp-gtm-analytics-code',
                            'type'          => 'text',
                            'title'         => esc_html__('Analytics ID','accelerated-mobile-pages'),
                            'default'       => '',
                            'tooltip-subtitle'  => 'Eg: UA-XXXXXX-Y',
                            'required' => array(
                              array('amp-use-gtm-option', '=' , '1'),
                              array('ampforwp-gtm-field-advance-switch', '=' , '0'),
                        ),
                        ),
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-gtm-field-advance-switch',
                          'type'     => 'switch',
                          'title'    => esc_html__( 'Advanced Google Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                              array('amp-use-gtm-option', '=' , '1'),
                        ),
                          'default'  => 0,
                      ),
                        array(
                          'class' => 'child_opt',
                        'id'       => 'ampforwp-gtm-field-advance',
                        'type'     => 'ace_editor',
                        'title'    => esc_html__('Analytics Code in JSON Format', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'    => sprintf( '%s<a href="%s" target="_blank">%s</a>', esc_html__( 'Tutorial: ','accelerated-mobile-pages' ), esc_url('https://ampforwp.com/tutorials/article/how-to-track-a-click-event-in-gtm-amp/'),  esc_html__( 'How To Add Advanced Google Tag Manager in AMP?','accelerated-mobile-pages' ) ),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '1'),
                            array('ampforwp-gtm-field-advance-switch', '=' , '1')
                        ),
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'desc'     => '',
                        'default'  => ('{
                      "vars": { "account": "UA-XXXXXX-Y"}
}')
                    ),
                        array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-gtm-field-anonymizeIP',
                          'type'     => 'switch',
                          'title'    => esc_html__( 'IP Anonymization', 'accelerated-mobile-pages' ),
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
                        'desc' => sprintf('<a href="%s" target="_blank">%s</a>', esc_url('https://ampforwp.com/tutorials/article/set-google-amp-client-id-api/'), esc_html__( 'Check this Tutorial to set it up', 'accelerated-mobile-pages' ) ),
                        'title'    => esc_html__('Set up Google AMP Client ID API', 'accelerated-mobile-pages'),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '1'),
                          ),
                        ),

                      array(
                        'id' => 'ampforwp-analytics-conversion-goals',
                        'type' => 'section',
                        'title' => esc_html__('Google Analytics Conversion Goals', 'accelerated-mobile-pages'),
                        'indent' => true,
                        'layout_type' => 'accordion',
                          'accordion-open'=> 1, 
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                          ),
                        ),


                    array(
                        'id' => 'ampforwp-analytics-conversion-goals-switch',
                        'type'  => 'switch',
                        'title' => 'Conversion Tracking for GA',
                        'default' => 0,
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                    array( 
                          'id'   => 'ampforwp-analytics-conversion-goals-info',
                          'type' => 'info',
                          'required' => array(
                              array('ampforwp-analytics-conversion-goals-switch', '=' , true),  
                              ),
                           'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/addons/conversion-goals-tracking-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/addons/conversion-goals-tracking-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Conversion Goals Tracking for AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
                           ),


                array(
                      'id' => 'ampforwp-analytics_2',
                      'type' => 'section',
                      'title' => esc_html__('General Analytics Providers', 'accelerated-mobile-pages'),
                      'indent' => true,
                      'layout_type' => 'accordion',
                        'accordion-open'=> 1, 
                  ),
                    array(
                        'id'            =>'amp-fb-pixel',
                        'type'          => 'switch',
                        'title'         => esc_html__('Facebook Pixel','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track facebook pixel in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-facebook-pixel-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'            =>'amp-fb-pixel-id',
                        'type'          => 'text',
                        'title'         => esc_html__('Facebook Pixel ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'desc'  => 'Example: 153246987501548',
                        'required' => array(
                          array('amp-fb-pixel', '=' , '1')),
                    ),                       
                    // Segment Analytics 
                      array(
                        'id' => 'ampforwp-Segment-switch',
                        'type'  => 'switch',
                        'title' => 'Segment Analytics',
                        'default' => ampforwp_get_default_analytics('2'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track segment analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-segment-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                      array(
                        'id'       => 'sa-feild',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Segment Analytics', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Enter your Segment Analytics Key.', 'accelerated-mobile-pages' ),
                        'required' => array(
                          array('ampforwp-Segment-switch', '=' , '1')
                        ),
                        'default'  => 'SEGMENT-WRITE-KEY',
                      ),
                     // Piwik Analytics 
                      array(
                        'id' => 'ampforwp-Piwik-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('Matomo (Piwik) Analytics', 'accelerated-mobile-pages' ),
                        'default' => ampforwp_get_default_analytics('3'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track matomo (piwik) analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-matomo-piwik-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                      array(
                          'id'       => 'pa-feild',
                          'class' => 'child_opt',
                          'type'     => 'multi_text',
                          'title'    => esc_html__( ' Enter Your Piwik Analytics URL', 'accelerated-mobile-pages' ),
                          'desc'=>sprintf( 'Example - 
                          https://YOUR_PIWIK_BASE_INSTALLATION_URL/piwik.php?idsite=1&amp;rec=1&amp;
                          action_name=TITLE&amp;urlref=DOCUMENT_REFERRER&amp;url=CANONICAL_URL&amp;
                          rand=RANDOM <a href="https://ampforwp.com/tutorials/article/how-to-add-matomo-piwik-analytics-in-amp/" target="_blank">%s</a>',esc_html__('View integration tutorial','accelerated-mobile-pages' )),
                          'required' => array(
                            array('ampforwp-Piwik-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => sprintf('%s<a href="%s" target="_blank">%s</a>', esc_html__( 'Tutorial: ','accelerated-mobile-pages' ), esc_url('https://ampforwp.com/tutorials/article/how-to-add-matomo-piwik-analytics-in-amp/'), esc_html__( 'How to add Matomo Piwik Analytics in AMP?','accelerated-mobile-pages') ),
                          'default'  => '',
                      ),
                      // Quantcast 
                        array(
                        'id' => 'ampforwp-Quantcast-switch',
                        'type'  => 'switch',
                        'title' => 'Quantcast Measurement',
                        'default' => ampforwp_get_default_analytics('4'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track quantcast analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-quantcast-measurement-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                      array(
                        'id'            =>'amp-quantcast-analytics-code',
                        'type'          => 'text',
                        'title'         => esc_html__('p-code','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                        array('ampforwp-Quantcast-switch', '=' , '1')),
                      ),

                       // Adobe 

                    array(
                      'id' => 'ampforwp-adobe-switch',

                      'type' => 'switch',

                      'title' => 'Adobe Analytics',

                      'default' => 0,

                      // 'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 

                      // esc_html__('Enable this option to track Adobe analytics in AMP and', 'accelerated-mobile-pages'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),

                    ),
                    
                    array(
                      'id'       => 'ampforwp-adobe-host',

                      'type'     => 'text',

                      'title'    => __( 'Host Name', 'accelerated-mobile-pages' ),

                      'required' => array(
                        
                        array('ampforwp-adobe-switch', '=' , '1')
                      ),

                      'tooltip-subtitle' => __( 'Enter the Website domain', 'accelerated-mobile-pages' ),
                      'default'  => '',
                      'desc' => 'For example: metrics.example.com',
                ),

                array(

                  'id'       => 'ampforwp-adobe-reportsuiteid',
                  
                  'type'     => 'text',

                  'title'    => __( 'ReportSuite ID', 'accelerated-mobile-pages' ),

                  'required' => array(
                    array('ampforwp-adobe-switch', '=' , '1')
                  ),

                  'tooltip-subtitle' => __( 'Enter the ReportSuite ID', 'accelerated-mobile-pages' ),
                  'default'  => '',
                  'desc' => 'For example: 00000003',
            ),
  
                 
                      // comScore  
                      array(
                        'id' => 'ampforwp-comScore-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('comScore','accelerated-mobile-pages'),
                        'default' => ampforwp_get_default_analytics('5'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track comScore analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-comscore-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                      array(
                        'id'            =>'amp-comscore-analytics-code-c1',
                        'type'          => 'text',
                        'title'         => esc_html__('C1','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                        array('ampforwp-comScore-switch', '=' , '1')),
                      ),
                      array(
                        'id'            =>'amp-comscore-analytics-code-c2',
                        'type'          => 'text',
                        'title'         => esc_html__('C2','accelerated-mobile-pages'),
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
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track effective measure analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-effective-measure-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                      array(
                          'id'       => 'eam-feild',
                          'type'     => 'text',
                          'title'    => esc_html__( 'Effective Measure Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Effective-switch', '=' , '1')
                          ),
                          'desc'     => esc_html__( 'Example: https://s.effectivemeasure.net/d/6/i?pu=CANONICAL_URL&ru=DOCUMENT_REFERRER&rnd=RANDOM', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => esc_html__('Enter your Effective Measure URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                     // StatCounter 
                      array(
                        'id' => 'ampforwp-StatCounter-switch',
                        'type'  => 'switch',
                        'title' => 'StatCounter',
                        'default' => ampforwp_get_default_analytics('7'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track statcounter analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-statcounter-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                      array(
                          'id'       => 'sc-feild',
                          'type'     => 'text',
                          'title'    => esc_html__( 'StatCounter', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-StatCounter-switch', '=' , '1')
                          ),
                          'desc'     => esc_html__( 'Example: https://c.statcounter.com/PROJECT_ID/0/SECURITY_CODE/1/', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => esc_html__('Enter your StatCounter URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                    // Histats Analytics  
                      array(
                        'id' => 'ampforwp-Histats-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('Histats Analytics','accelerated-mobile-pages'),
                        'default' => ampforwp_get_default_analytics('8'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track histats analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-get-histats-analytics-id/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                       array(
                          'id'       => 'histats-field',
                          'type'     => 'text',
                          'title'    => esc_html__( 'Histats Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Histats-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => esc_html__( 'Enter your Histats Analytics ID.', 'accelerated-mobile-pages' ),
                          'desc' => 'Tutorial: <a href="https://ampforwp.com/tutorials/how-to-get-histats-analytics-id/">How to get Histats Analytics ID for AMP?</a>',
                          'default'  => ampforwp_get_setting('histats-feild'),
                      ),

                         // Adobe 

                    array(
                      'id' => 'ampforwp-adobe-switch',

                      'type' => 'switch',

                      'title' => 'Adobe Analytics',

                      'default' => 0,

                      // 'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 

                      // esc_html__('Enable this option to track Adobe analytics in AMP and', 'accelerated-mobile-pages'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),

                    ),
                    
                    array(
                      'id'       => 'ampforwp-adobe-host',

                      'type'     => 'text',

                      'title'    => __( 'Host Name', 'accelerated-mobile-pages' ),

                      'required' => array(
                        
                        array('ampforwp-adobe-switch', '=' , '1')
                      ),

                      'tooltip-subtitle' => __( 'Enter the Website domain', 'accelerated-mobile-pages' ),
                      'default'  => '',
                      'desc' => 'For example: metrics.example.com',
                ),

                array(

                  'id'       => 'ampforwp-adobe-reportsuiteid',
                  
                  'type'     => 'text',

                  'title'    => __( 'ReportSuite ID', 'accelerated-mobile-pages' ),

                  'required' => array(
                    array('ampforwp-adobe-switch', '=' , '1')
                  ),

                  'tooltip-subtitle' => __( 'Enter the ReportSuite ID', 'accelerated-mobile-pages' ),
                  'default'  => '',
                  'desc' => 'For example: reportSuiteID1, reportSuiteID2',
            ),
                     // Yandex Metrika  
                       array(
                        'id' => 'ampforwp-Yandex-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('Yandex Metrika','accelerated-mobile-pages'),
                        'default' => ampforwp_get_default_analytics('9'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track yandex metrika analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-yandex-metrika-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                       array(
                        'id'            =>'amp-Yandex-Metrika-analytics-code',
                        'type'          => 'text',
                        'title'         => esc_html__('Yandex Metrika Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('ampforwp-Yandex-switch', '=' , '1')),
                        'tooltip-subtitle' => esc_html__( 'Enter your Counter ID.', 'accelerated-mobile-pages' ),
                      ),
                      // Chartbeat Analytics 
                       array(
                        'id' => 'ampforwp-Chartbeat-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('Chartbeat Analytics','accelerated-mobile-pages'),
                        'default' => ampforwp_get_default_analytics('10'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track chartbeat analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-chartbeat-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                  
                       array(
                        'id'            =>'amp-Chartbeat-analytics-code',
                        'type'          => 'text',
                        'title'         => esc_html__('Chartbeat Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('ampforwp-Chartbeat-switch', '=' , '1')),
                        'tooltip-subtitle' => esc_html__( 'Enter your Account ID.', 'accelerated-mobile-pages' ),
                      ),
                     // Alexa Metrics
                         array(
                        'id' => 'ampforwp-Alexa-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('Alexa Metrics', 'accelerated-mobile-pages' ),
                        'default' => ampforwp_get_default_analytics('11'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track alexa metrics analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/add-alexa-metrics-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                     array(
                          'id'       => 'ampforwp-alexa-account',
                          'type'     => 'text',
                          'title'    => esc_html__( 'Alexa Metrics Account', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Alexa-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => esc_html__( 'Enter Account Number given by Alexa Metrics', 'accelerated-mobile-pages' ),
                          'default'  => '',
                      ),
                      array(
                          'id'       => 'ampforwp-alexa-domain',
                          'type'     => 'text',
                          'title'    => esc_html__( 'Alexa Metrics Domain', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Alexa-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => esc_html__( 'Enter the domain', 'accelerated-mobile-pages' ),
                          'default'  => '',
                      ),
                    // AFS Analytics
                         array(
                        'id' => 'ampforwp-afs-analytics-switch',
                        'type'  => 'switch',
                        'title' => 'AFS Analytics',
                        'default' => ampforwp_get_default_analytics('12'),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track afs analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-afs-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                          'id'       => 'ampforwp-afs-siteid',
                          'type'     => 'text',
                          'title'    => esc_html__( 'Website ID', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-afs-analytics-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => esc_html__( 'Enter the Website ID', 'accelerated-mobile-pages' ),
                          'default'  => '',
                          'desc' => 'example: 00000003',
                      ), 
                    //Clicky Analytics    
                    array(
                        
                        'id'            =>'amp-clicky-switch',
                        'type'          => 'switch',
                        'title'         => esc_html__('Clicky Analytics','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track clicky analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-clicky-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'       => 'clicky-site-id',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Clicky Site ID', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                            esc_html__( 'Enter your Clicky Analytics Site ID. If you dont have account in Clicky, Please click','accelerated-mobile-pages'),
                            esc_url('https://clicky.com/help/faq/common/site-preferences'),
                            esc_html__('here','accelerated-mobile-pages'),
                            esc_html__( 'to create an account.','accelerated-mobile-pages' )
                        ),
                        'required' => array(
                          array('amp-clicky-switch', '=' , '1')
                        ),
                        'placeholder'  => esc_html__('YOUR_SITE_ID_HERE','accelerated-mobile-pages'),
                    ),
                    //Call Rail Analytics    
                    array(
                        'id'            =>'ampforwp-callrail-switch',
                        'type'          => 'switch',
                        'title'         => esc_html__('Call Rail Analytics','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track callrail analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-callrail-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'       => 'ampforwp-callrail-config-url',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Config URL', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Enter your Call Rail Analytics Site Config URL','accelerated-mobile-pages'),
                        'desc'=>sprintf( '<a href="https://ampforwp.com/tutorials/article/how-to-add-callrail-analytics-in-amp/" target="_blank">%s</a>',esc_html__('View integration tutorial','accelerated-mobile-pages' )),
                        'required' => array('ampforwp-callrail-switch', '=' , '1')
                    ),
                    array(
                        'id'       => 'ampforwp-callrail-number',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Tell Number', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Enter your Tell Number for Call Rail Analytics','accelerated-mobile-pages'),
                        'required' => array('ampforwp-callrail-switch', '=' , '1')
                    ),
                    array(
                        'id'       => 'ampforwp-callrail-analytics-url',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Analytics Config URL', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Enter your Analytics Config URL','accelerated-mobile-pages'),
                        'required' => array('ampforwp-callrail-switch', '=' , '1')
                    ),
                    //iotechnologies Analytics    
                    array(
                        'id'            =>'ampforwp-iotech-switch',
                        'type'          => 'switch',
                        'title'         => esc_html__('IO Technologies Analytics','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track io technologies analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-iotechnologies-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'       => 'ampforwp-iotech-projectid',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Project ID', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Enter Your Project ID Here','accelerated-mobile-pages'),
                        'required' => array('ampforwp-iotech-switch', '=' , '1')
                    ),
                    //Dotmetrics  Analytics    
                    array(
                        'id'            =>'ampforwp-dotmetrics-switch',
                        'type'          => 'switch',
                        'title'         => esc_html__('Dotmetrics Analytics','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track dotmetrics analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-dotmetrics-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'       => 'ampforwp-dotmetrics-id',
                        'type'     => 'text',
                        'title'    => esc_html__( 'User ID', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Enter Your User ID Here','accelerated-mobile-pages'),
                        'required' => array('ampforwp-dotmetrics-switch', '=' , '1')
                    ),

                    //Top.Mail.Ru Analytics    
                    array(
                        'id'            =>'ampforwp-topmailru-switch',
                        'type'          => 'switch',
                        'title'         => esc_html__('Top Mail Ru Analytics','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track topmailru analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-topmailru-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'       => 'ampforwp-topmailru-id',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Counter ID', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Enter Your Counter ID Here','accelerated-mobile-pages'),
                        'required' => array('ampforwp-topmailru-switch', '=' , '1')
                    ),

                    //Plausible Analytics 
                    array(
                        'id'            =>'ampforwp-plausible-switch',
                        'type'          => 'switch',
                        'title'         => esc_html__('Plausible Analytics','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track plausible analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-plausible-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    // AT internet Analytics    
                    array(
                        'id'            =>'amp-atinternet-switch',
                        'type'          => 'switch',
                        'title'         => esc_html__('AT internet Analytics','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track AT internet analytics in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-atinternet-analytics-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'       => 'amp-atinternet-site-id',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Site ID', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' =>  
                            esc_html__( 'Enter your AT internet Analytics Site ID here','accelerated-mobile-pages'),
                        'required' => array(
                          array('amp-atinternet-switch', '=' , '1')
                        ),
                        'placeholder'  => esc_html__('YOUR_SITE_ID_HERE','accelerated-mobile-pages'),
                    ),
                    // Marfeel Analytics
                       array(
                        'id'            =>'amp-marfeel-pixel',
                        'type'          => 'switch',
                        'title'         => esc_html__('Marfeel Pixel','accelerated-mobile-pages'),
                        'default'       => 0,
                        'tooltip-subtitle' => sprintf('%s <a href="%s" target="_blank">%s</a> %s', 
                         esc_html__('Enable this option to track marfeel pixel in AMP and', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-facebook-pixel-in-amp/'),esc_html__('Click Here','accelerated-mobile-pages'), esc_html__('for more info','accelerated-mobile-pages')),
                    ),
                    array(
                        'id'            =>'amp-marfeel-account-id',
                        'type'          => 'text',
                        'title'         => esc_html__('Marfeel Account ID','accelerated-mobile-pages'),
                        'default'       => '0',
                        'desc'  => 'Example: 153246987501548',
                        'required' => array(
                          array('amp-marfeel-pixel', '=' , '1')),
                    ), 
                        )
            )
   );
}