<?php
use ReduxCore\ReduxFramework\Redux;
function ampforwp_get_default_analytics($param=""){
    $options = $default = ''; 
    $options = get_option('redux_builder_amp', true);
    $default = $options['amp-analytics-select-option'];
    if($param == $default){
        return true;
    }
    else
        return false;
  }
function ampforwp_analytics_options($opt_name){
  // Analytics SECTION
   Redux::setSection( $opt_name,    array(
                'title' => __('Analytics'),
                // 'icon' => 'el el-th-large',
                'subsection' => true,
                'fields' =>
                    array(
                    array(
                        'id'       => 'amp-analytics-select-option',
                        'type'     => 'select',
                        'title'    => __( 'Analytics Type', 'accelerated-mobile-pages' ),
                        'class'    => 'hide',
                        'tooltip-subtitle' => __( 'Select your Analytics provider.', 'accelerated-mobile-pages' ),
                        'options'  => array(
                            '1' => __('Google Analytics', 'accelerated-mobile-pages' ),
                            '2' => __('Segment Analytics', 'accelerated-mobile-pages' ),
                            '3' => __('Matomo (Piwik) Analytics', 'accelerated-mobile-pages' ),
                            '4' => __('Quantcast Measurement', 'accelerated-mobile-pages' ),
                            '5' => __('comScore', 'accelerated-mobile-pages' ),
                            '6' => __('Effective Measure', 'accelerated-mobile-pages' ),
                            '7' => __('StatCounter', 'accelerated-mobile-pages' ),
                            '8' => __('Histats Analytics', 'accelerated-mobile-pages'),
                            '9' => __('Yandex Metrika', 'accelerated-mobile-pages'),
                            '10' => __('Chartbeat Analytics', 'accelerated-mobile-pages'),
                            '11' => __('Alexa Metrics', 'accelerated-mobile-pages'),
                            '12' => __('AFS Analytics', 'accelerated-mobile-pages'),
                        ),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                        'default'  => '1',
                    ),  

                array(
                      'id' => 'ampforwp-analytics_1',
                      'type' => 'section',
                      'title' => __('Primary Analytic Providers', 'accelerated-mobile-pages'),
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
                          'title'    => __( 'Tracking ID', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1'),
                            array('ampforwp-ga-field-advance-switch', '=' , '0')
                          ),
                          'tooltip-subtitle' => __( 'Enter your Google Analytics ID. Example: UA-XXXXX-Y', 'accelerated-mobile-pages' ),
                          'default'  => 'UA-XXXXX-Y',
                      ),
         
                      // Advance Tracking options for Google Analytics
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-ga-field-advance-switch',
                          'type'     => 'switch',
                          'title'    => __( 'Advanced Google Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1')
                          ),
                          'default'  => 0,
                      ),
                      array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-ga-field-anonymizeIP',
                          'type'     => 'switch',
                          'title'    => __( 'IP Anonymization', 'accelerated-mobile-pages' ),
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
                          'title'    => __( 'AMP Linker', 'accelerated-mobile-pages' ),
                          'required' => array('ampforwp-ga-switch', '=' , '1'),
                          'tooltip-subtitle' => __( '<a href="https://amphtml.wordpress.com/2018/09/17/measuring-user-journeys-across-the-amp-cache-and-your-website/amp/" target="_blank">Click Here</a> for more details on AMP Linker', 'accelerated-mobile-pages' ),
                          'default'  => 0,
                      ),
                      array(
                          'class' => 'child_opt',
                        'id'       => 'ampforwp-ga-field-advance',
                        'type'     => 'ace_editor',
                        'title'    => __('Analytics Code in JSON Format', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'    => __('Tutorial: <a href="https://ampforwp.com/tutorials/article/add-advanced-google-analytics-amp/" target="_blank">How To Add Advanced Google Analytics in AMP?</a>', 'accelerated-mobile-pages'),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-ga-switch', '=' , '1'),
                            array('ampforwp-ga-field-advance-switch', '=' , '1')
                        ),
                        'mode'     => 'javascript',
                        'theme'    => 'monokai',
                        'desc'     => '',
                        'default'  => __('{
    "vars": {
        "account": "UA-xxxxxxx-x"  //Replace this with your Tracking ID
    },
    "triggers": {
        "trackPageview": {
            "on": "visible",
            "request": "pageview",
        },
    /** 
     * Enter your Advanced Analytics code here
    */

    }
}
}','accelerated-mobile-pages')
                    ),

                      //GTM
                        array(
                            'id'       => 'amp-use-gtm-option',
                            'type'     => 'switch',
                            'title'    => __( 'Google Tag Manager', 'accelerated-mobile-pages' ),
                            'tooltip-subtitle' => __( 'Enable GTM Support in AMP.', 'accelerated-mobile-pages' ),
                            'default'  => 1,
                        ),
                        array(
                            'class'=>'child_opt child_opt_arrow',
                            'id'            =>'amp-gtm-id',
                            'type'          => 'text',
                            'title'         => __('Tag Manager ID (Container ID)','accelerated-mobile-pages'),
                            'default'       => '',
                            'tooltip-subtitle'  => __('Eg: GTM-5XXXXXP (<a href="https://ampforwp.com/tutorials/article/gtm-in-amp/" style="color:#f1f1f1;">Getting Started?</a>)','accelerated-mobile-pages'),
                            //  'validate' => 'not_empty',
                              'required' => array(
                                array('amp-use-gtm-option', '=' , '1')
                              ),
                        ),
                       array(
                           'class' => 'child_opt',
                           'id'            =>'amp-gtm-analytics-type',
                           'type'          => 'text',
                           'title'         => __('Analytics Type','accelerated-mobile-pages'),
                           'default'       => '',
                           'desc'  => __('Eg: googleanalytics','accelerated-mobile-pages'),
                            // 'validate' => 'not_empty',
                             'required' => array(
                               array('amp-use-gtm-option', '=' , '1')
                             ),
                       ),
                        array(
                            'class'=>'child_opt',
                            'id'            =>'amp-gtm-analytics-code',
                            'type'          => 'text',
                            'title'         => __('Analytics ID','accelerated-mobile-pages'),
                            'default'       => '',
                            'tooltip-subtitle'  => 'Eg: UA-XXXXXX-Y',
                  // 'validate' => 'not_empty',
                              'required' => array(
                              array('amp-use-gtm-option', '=' , '1')),
                        ),
                        array(
                          'class' => 'child_opt',
                          'id'       => 'ampforwp-gtm-field-anonymizeIP',
                          'type'     => 'switch',
                          'title'    => __( 'IP Anonymization', 'accelerated-mobile-pages' ),
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
                        'desc' => '<a href="https://ampforwp.com/tutorials/article/set-google-amp-client-id-api/" target="_blank">Check this Tutorial to set it up</a>',
                        'title'    => __('Set up Google AMP Client ID API', 'accelerated-mobile-pages'),
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '1'),
                          ),
                        ),


                array(
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                      'id' => 'ampforwp-analytics_2',
                      'type' => 'section',
                      'title' => __('General Analytics Providers', 'accelerated-mobile-pages'),
                      'indent' => true,
                      'layout_type' => 'accordion',
                        'accordion-open'=> 1, 
                  ),
                    array(
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                        'id'            =>'amp-fb-pixel',
                        'type'          => 'switch',
                        'title'         => __('Facebook Pixel','accelerated-mobile-pages'),
                        'default'       => 0,
                    ),
                    array(
                        'id'            =>'amp-fb-pixel-id',
                        'type'          => 'text',
                        'title'         => __('Facebook Pixel ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'desc'  => 'Example: 153246987501548',
                          'required' => array(
                          array('amp-fb-pixel', '=' , '1')),
                    ),                        // Segment Analytics 
                      array(
                        'id' => 'ampforwp-Segment-switch',
                        'type'  => 'switch',
                        'title' => 'Segment Analytics',
                        'default' => ampforwp_get_default_analytics('2'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                      array(
                        'id'       => 'sa-feild',
                        'type'     => 'text',
                        'title'    => __( 'Segment Analytics', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => __( 'Enter your Segment Analytics Key.', 'accelerated-mobile-pages' ),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                          array('ampforwp-Segment-switch', '=' , '1')
                        ),
                        'default'  => 'SEGMENT-WRITE-KEY',
                      ),
                     // Piwik Analytics 
                      array(
                        'id' => 'ampforwp-Piwik-switch',
                        'type'  => 'switch',
                        'title' => 'Matomo (Piwik) Analytics',
                        'default' => ampforwp_get_default_analytics('3'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                      array(
                          'id'       => 'pa-feild',
                          'type'     => 'text',
                          'title'    => __( ' Matomo (Piwik) Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-Piwik-switch', '=' , '1')
                          ),
                          'desc'     => __( 'Example: https://piwik.example.org/piwik.php?idsite=YOUR_SITE_ID&rec=1&action_name=TITLE&urlref=DOCUMENT_REFERRER&url=CANONICAL_URL&rand=RANDOM', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => __('Enter your Matomo (Piwik) Analytics URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                      // Quantcast 
                        array(
                        'id' => 'ampforwp-Quantcast-switch',
                        'type'  => 'switch',
                        'title' => 'Quantcast Measurement',
                        'default' => ampforwp_get_default_analytics('4'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                      array(
                        'id'            =>'amp-quantcast-analytics-code',
                        'type'          => 'text',
                        'title'         => __('p-code','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                        array('ampforwp-Quantcast-switch', '=' , '1')),
                      ),
                      // comScore  
                      array(
                        'id' => 'ampforwp-comScore-switch',
                        'type'  => 'switch',
                        'title' => 'comScore',
                        'default' => ampforwp_get_default_analytics('5'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                      array(
                        'id'            =>'amp-comscore-analytics-code-c1',
                        'type'          => 'text',
                        'title'         => __('C1','accelerated-mobile-pages'),
                        'default'       => 1,
                        'required' => array(
                        array('ampforwp-comScore-switch', '=' , '1')),
                      ),
                      array(
                        'id'            =>'amp-comscore-analytics-code-c2',
                        'type'          => 'text',
                        'title'         => __('C2','accelerated-mobile-pages'),
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
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                      array(
                          'id'       => 'eam-feild',
                          'type'     => 'text',
                          'title'    => __( 'Effective Measure Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-Effective-switch', '=' , '1')
                          ),
                          'desc'     => __( 'Example: https://s.effectivemeasure.net/d/6/i?pu=CANONICAL_URL&ru=DOCUMENT_REFERRER&rnd=RANDOM', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => __('Enter your Effective Measure URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                     // StatCounter 
                      array(
                        'id' => 'ampforwp-StatCounter-switch',
                        'type'  => 'switch',
                        'title' => 'StatCounter',
                        'default' => ampforwp_get_default_analytics('7'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                      array(
                          'id'       => 'sc-feild',
                          'type'     => 'text',
                          'title'    => __( 'StatCounter', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-StatCounter-switch', '=' , '1')
                          ),
                          'desc'     => __( 'Example: https://c.statcounter.com/PROJECT_ID/0/SECURITY_CODE/1/', 'accelerated-mobile-pages' ),
                          'tooltip-subtitle' => __('Enter your StatCounter URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                    // Histats Analytics  
                      array(
                        'id' => 'ampforwp-Histats-switch',
                        'type'  => 'switch',
                        'title' => 'Histats Analytics',
                        'default' => ampforwp_get_default_analytics('8'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                       array(
                          'id'       => 'histats-feild',
                          'type'     => 'text',
                          'title'    => __( 'Histats Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-Histats-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter your Histats Analytics ID.', 'accelerated-mobile-pages' ),
                          'desc' => 'Tutorial: <a href="https://ampforwp.com/tutorials/how-to-get-histats-analytics-id/">How to get Histats Analytics ID for AMP?</a>',
                          'default'  => '',
                      ),
                     // Yandex Metrika  
                       array(
                        'id' => 'ampforwp-Yandex-switch',
                        'type'  => 'switch',
                        'title' => 'Yandex Metrika',
                        'default' => ampforwp_get_default_analytics('9'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                       array(
                        'id'            =>'amp-Yandex-Metrika-analytics-code',
                        'type'          => 'text',
                        'title'         => __('Yandex Metrika Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-Yandex-switch', '=' , '1')),
                        'tooltip-subtitle' => __( 'Enter your Counter ID.', 'accelerated-mobile-pages' ),
                      ),
                      // Chartbeat Analytics 
                       array(
                        'id' => 'ampforwp-Chartbeat-switch',
                        'type'  => 'switch',
                        'title' => 'Chartbeat Analytics',
                        'default' => ampforwp_get_default_analytics('10'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                  
                       array(
                        'id'            =>'amp-Chartbeat-analytics-code',
                        'type'          => 'text',
                        'title'         => __('Chartbeat Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-Chartbeat-switch', '=' , '1')),
                        'tooltip-subtitle' => __( 'Enter your Account ID.', 'accelerated-mobile-pages' ),
                      ),
                     // Alexa Metrics
                         array(
                        'id' => 'ampforwp-Alexa-switch',
                        'type'  => 'switch',
                        'title' => 'Alexa Metrics',
                        'default' => ampforwp_get_default_analytics('11'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                     array(
                          'id'       => 'ampforwp-alexa-account',
                          'type'     => 'text',
                          'title'    => __( 'Alexa Metrics Account', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-Alexa-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter Account Number given by Alexa Metrics', 'accelerated-mobile-pages' ),
                          'default'  => '',
                      ),
                      array(
                          'id'       => 'ampforwp-alexa-domain',
                          'type'     => 'text',
                          'title'    => __( 'Alexa Metrics Domain', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-Alexa-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter the domain', 'accelerated-mobile-pages' ),
                          'default'  => '',
                      ),
                    // AFS Analytics
                         array(
                        'id' => 'ampforwp-afs-analytics-switch',
                        'type'  => 'switch',
                        'title' => 'AFS Analytics',
                        'default' => ampforwp_get_default_analytics('12'),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                    ),
                    array(
                          'id'       => 'ampforwp-afs-siteid',
                          'type'     => 'text',
                          'title'    => __( 'Website ID', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('ampforwp-afs-analytics-switch', '=' , '1')
                          ),
                          'tooltip-subtitle' => __( 'Enter the Website ID', 'accelerated-mobile-pages' ),
                          'default'  => '',
                          'desc' => 'example: 00000003',
                      ),   


                        )
            )
   );
}