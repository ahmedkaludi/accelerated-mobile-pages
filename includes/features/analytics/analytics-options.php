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
                      'title' => esc_html__('Primary Analytic Providers', 'accelerated-mobile-pages'),
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
                      // Advance Tracking options for Google Analytics
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-ga-field-advance-switch',
                          'type'     => 'switch',
                          'title'    => esc_html__( 'Advanced Google Analytics', 'accelerated-mobile-pages' ),
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
    "vars": {
        "account": "UA-xxxxxxx-x"
    },
    "triggers": {
        "trackPageview": {
            "on": "visible",
            "request": "pageview"
        }
    }
}')
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
                            'class'=>'child_opt',
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
                        'tooltip-subtitle'    => sprintf( '%s<a href="%s" target="_blank">%s</a>', esc_html__( 'Tutorial: ','accelerated-mobile-pages' ), esc_url('https://ampforwp.com/tutorials/article/add-advanced-google-analytics-amp/'),  esc_html__( 'How To Add Advanced Google Analytics in AMP?','accelerated-mobile-pages' ) ),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '1'),
                            array('ampforwp-gtm-field-advance-switch', '=' , '1')
                        ),
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'desc'     => '',
                        'default'  => ('{
                          "vars": {
                              "account": "UA-xxxxxxx-x"
                          },
                          "triggers": {
                              "trackPageview": {
                                  "on": "visible",
                                  "request": "pageview"
                              }
                          }
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
                    ),
                      array(
                          'id'       => 'pa-feild',
                          'class' => 'child_opt',
                          'type'     => 'text',
                          'title'    => esc_html__( ' Matomo (Piwik) Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('ampforwp-Piwik-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => sprintf('%s<a href="%s" target="_blank">%s</a>', esc_html__( 'Tutorial: ','accelerated-mobile-pages' ), esc_url('https://ampforwp.com/tutorials/article/how-to-add-matomo-piwik-analytics-in-amp/'), esc_html__( 'How to add Matomo Piwik Analytics in AMP?','accelerated-mobile-pages') ),
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
                        'title'         => esc_html__('p-code','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                        array('ampforwp-Quantcast-switch', '=' , '1')),
                      ),
                      // comScore  
                      array(
                        'id' => 'ampforwp-comScore-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('comScore','accelerated-mobile-pages'),
                        'default' => ampforwp_get_default_analytics('5'),
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
                     // Yandex Metrika  
                       array(
                        'id' => 'ampforwp-Yandex-switch',
                        'type'  => 'switch',
                        'title' => esc_html__('Yandex Metrika','accelerated-mobile-pages'),
                        'default' => ampforwp_get_default_analytics('9'),
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

                        )
            )
   );
}