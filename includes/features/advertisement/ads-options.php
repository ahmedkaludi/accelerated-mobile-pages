<?php
 use ReduxCore\ReduxFramework\Redux;

 function ampforwp_admin_advertisement_options($opt_name){
    $advertisementdesc = '';
    if(!is_plugin_active( 'amp-incontent-ads/amptoolkit-incontent-ads.php' ) && !is_plugin_active( 'ads-for-wp/ads-for-wp.php' ) ){
        $AD_URL = "http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=advertisement-tab&utm_campaign=AMP%20Plugin";
    $advertisementdesc = '<a href="'.$AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-retina.png" width="560" height="85" /></a>';
    }
// ADS SECTION
 Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Advertisement', 'accelerated-mobile-pages' ),
            'desc' => $advertisementdesc,
            'class'      => 'ampforwp_new_features ',
            'id'         => 'amp-ads',
            'subsection' => true,
            'fields'     => apply_filters('ampforwp_ads_option_fields', $fields = array() ),
        ) );   
 }

 //
 add_filter('ampforwp_ads_option_fields', 'ampforwp_add_ads_fields');
 function ampforwp_add_ads_fields($fields){
        if ( !is_plugin_active('ads-for-wp/ads-for-wp.php') ) {

                $fields[] = array(
                       'id' => 'amp-ads_1',
                       'type' => 'section',
                       'title' => esc_html__('Advertisement Positions', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
                );
                    // Ad 1 Starts
                $fields[] =    array(
                        'id'        =>'enable-amp-ads-1',
                        'type'      => 'switch',
                        'title'     => esc_html__('AD #1', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'desc'  => esc_html__('Below the Header (SiteWide)', 'accelerated-mobile-pages'),
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    );
                $fields[] =        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-1',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-1', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                '1' => esc_html__('300x250','accelerated-mobile-pages'),
                                '2' => esc_html__('336x280','accelerated-mobile-pages'),
                                '3' => esc_html__('728x90','accelerated-mobile-pages'),
                                '4' => esc_html__('300x600','accelerated-mobile-pages'),
                                '5' => esc_html__('320x100','accelerated-mobile-pages'),
                                '6' => esc_html__('200x50','accelerated-mobile-pages'),
                                '7' => esc_html__('320x50','accelerated-mobile-pages'),                      ),
                            'default'  => '2',
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-text-feild-client-1',
                            'type'      => 'text',
                            'required'  => array('enable-amp-ads-1', '=' , '1'),
                            'title'     => esc_html__('Data AD Client', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-text-feild-slot-1',
                            'type'      => 'text',
                            'title'     => esc_html__('Data AD Slot', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array('enable-amp-ads-1', '=' , '1'),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-1',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array('enable-amp-ads-1', '=' , '1'),
                        );
                // Ad 1 ends

                // Ad 2 Starts
                $fields[] =     array(
                        'id'=>'enable-amp-ads-2',
                        'type' => 'switch',
                        'title' => esc_html__('AD #2', 'accelerated-mobile-pages'),
                        'default' => 0,
                        'desc'     => esc_html__('Below the Footer (SiteWide)', 'accelerated-mobile-pages'),
                        'true' => 'Enabled',
                        'false' => 'Disabled',
                        );
                $fields[] =        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-2',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-2', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                '1' => '300x250',
                                '2' => '336x280',
                                '3' => '728x90',
                                '4' => '300x600',
                                '5' => '320x100',
                                '6' => '200x50',
                                '7' => '320x50'
                            ),
                            'default'  => '2',
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'       =>'enable-amp-ads-text-feild-client-2',
                            'type'     => 'text',
                            'required' => array('enable-amp-ads-2', '=' , '1'),
                            'title'    => esc_html__('Data AD Client', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'     => esc_html__('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                        );
                $fields[] =       array(
                            'class' => 'child_opt',
                            'id'       => 'enable-amp-ads-text-feild-slot-2',
                            'type'     => 'text',
                            'title'    => esc_html__('Data AD Slot', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'     => esc_html__('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array('enable-amp-ads-2', '=' , '1'),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-2',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array('enable-amp-ads-2', '=' , '1'),
                        );
                // Ad 2 ends

                // Ad 3 starts
                $fields[] =     array(
                            'id'        => 'enable-amp-ads-3',
                            'type'      => 'switch',
                            'title'     => esc_html__('AD #3', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'desc'  => esc_html__('Above the Post Content', 'accelerated-mobile-pages'),
                            'true'      => 'Enabled',
                            'false'     => 'Disabled',
                        );
                $fields[] =     array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'        => 'made-amp-ad-3-global',
                            'type'      => 'select',
                            'title'     => esc_html__('Display on', 'accelerated-mobile-pages'),
                            'options'   => array (
                                                '1'    => 'Single',
                                                '2'    => 'Pages',
                                                '3'    => 'Custom Post Types',
                                                '4'    => 'Global'
                                             ),
                            'multi'     => true,
                            'default'   => '1',
                            'desc'  => esc_html__('Display the Ad on only post or on all posts and pages ', 'accelerated-mobile-pages'),
                            'required'  => array('enable-amp-ads-3', '=' , '1')
                        );
                $fields[] =        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'        => 'enable-amp-ads-select-3',
                            'type'      => 'select',
                            'title'     => esc_html__('AD Size', 'accelerated-mobile-pages'),
                            'required'  => array('enable-amp-ads-3', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'   => array(
                                    '1'     => '300x250',
                                    '2'     => '336x280',
                                    '3'     => '728x90',
                                    '4'     => '300x600',
                                    '5' => '320x100',
                                    '6' => '200x50',
                                    '7' => '320x50'
                            ),
                            'default'  => '2',
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-text-feild-client-3',
                            'type'      => 'text',
                            'required'  => array('enable-amp-ads-3', '=' , '1'),
                            'title'     => esc_html__('Data AD Client', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-text-feild-slot-3',
                            'type'      => 'text',
                            'title'     => esc_html__('Data AD Slot', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required'  => array('enable-amp-ads-3', '=' , '1'),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-3',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array('enable-amp-ads-3', '=' , '1'),
                        );
                // Ad 3 ends

                // Ad 4 Starts
                $fields[] =    array(
                        'id'        => 'enable-amp-ads-4',
                        'type'      => 'switch',
                        'title'     => esc_html__('AD #4', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'desc'  => esc_html__('Below the Post Content (Single Post)', 'accelerated-mobile-pages'),
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    );
                $fields[] =        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-4',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-4', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                '1' => esc_html__('300x250','accelerated-mobile-pages'),
                                '2' => esc_html__('336x280','accelerated-mobile-pages'),
                                '3' => esc_html__('728x90','accelerated-mobile-pages'),
                                '4' => esc_html__('300x600','accelerated-mobile-pages'),
                                '5' => esc_html__('320x100','accelerated-mobile-pages'),
                                '6' => esc_html__('200x50','accelerated-mobile-pages'),
                                '7' => esc_html__('320x50','accelerated-mobile-pages')
                            ),
                            'default'  => '2',
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-text-feild-client-4',
                            'type'      => 'text',
                            'required'  => array('enable-amp-ads-4', '=' , '1'),
                            'title'     => esc_html__('Data AD Client', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-text-feild-slot-4',
                            'type'      => 'text',
                            'title'     => esc_html__('Data AD Slot', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required'  => array('enable-amp-ads-4', '=' , '1'),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-4',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array('enable-amp-ads-4', '=' , '1'),
                        );
                // Ad 4 ends

                //Ad 5 Starts
                $fields[] =array(
                    'id'        => 'enable-amp-ads-5',
                    'type'      => 'switch',
                    'title'     => esc_html__('AD #5', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'desc'  => esc_html__('Below The Title (Single Post)', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                );
                $fields[] =    array(
                            'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-5',
                        'type'     => 'select',
                        'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                        'required' => array('enable-amp-ads-5', '=' , '1'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '1' => esc_html__('300x250','accelerated-mobile-pages'),
                            '2' => esc_html__('336x280','accelerated-mobile-pages'),
                            '3' => esc_html__('728x90','accelerated-mobile-pages'),
                            '4' => esc_html__('300x600','accelerated-mobile-pages'),
                            '5' => esc_html__('320x100','accelerated-mobile-pages'),
                            '6' => esc_html__('200x50','accelerated-mobile-pages'),
                            '7' => esc_html__('320x50','accelerated-mobile-pages')
                        ),
                        'default'  => '2',
                    );
                $fields[] =    array(
                            'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-text-feild-client-5',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-5', '=' , '1'),
                        'title'     => esc_html__('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => esc_html__('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    );
                $fields[] =    array(
                            'class' => 'child_opt',
                        'id'        => 'enable-amp-ads-text-feild-slot-5',
                        'type'      => 'text',
                        'title'     => esc_html__('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => esc_html__('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('enable-amp-ads-5', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    );
                $fields[] =    array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-5',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array('enable-amp-ads-5', '=' , '1'),
                        );

                //Ad 6 Starts
                if ( ! function_exists('amp_activate') ) {
                    $fields[] =array(
                        'id'        => 'enable-amp-ads-6',
                        'type'      => 'switch',
                        'title'     => esc_html__('AD #6', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'desc'  => esc_html__('Above the Related Posts (Single Post)', 'accelerated-mobile-pages'),
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    );
                    $fields[] =    array(
                                'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-6',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-6', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                '1' => esc_html__('300x250','accelerated-mobile-pages'),
                                '2' => esc_html__('336x280','accelerated-mobile-pages'),
                                '3' => esc_html__('728x90','accelerated-mobile-pages'),
                                '4' => esc_html__('300x600','accelerated-mobile-pages'),
                                '5' => esc_html__('320x100','accelerated-mobile-pages'),
                                '6' => esc_html__('200x50','accelerated-mobile-pages'),
                                '7' => esc_html__('320x50','accelerated-mobile-pages')
                            ),
                            'default'  => '2',
                        );
                    $fields[] =    array(
                                'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-text-feild-client-6',
                            'type'      => 'text',
                            'required'  => array('enable-amp-ads-6', '=' , '1'),
                            'title'     => esc_html__('Data AD Client', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                        );
                    $fields[] =    array(
                                'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-text-feild-slot-6',
                            'type'      => 'text',
                            'title'     => esc_html__('Data AD Slot', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required'  => array('enable-amp-ads-6', '=' , '1'),
                            'placeholder'=> '70XXXXXX12'
                        );
                    $fields[] =    array(
                                'class' => 'child_opt',
                                'id'        =>'enable-amp-ads-resp-6',
                                'type'      => 'switch',
                                'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                                'default'   => 0,
                                'required' => array('enable-amp-ads-6', '=' , '1'),
                        );
                }
            }                   
                $fields[] =    array(
                            'id' => 'ampforwp-ads-section',
                            'class'=> is_plugin_active('ads-for-wp/ads-for-wp.php')? "adsactive": '',
                            'type' => 'section',
                            'title' => esc_html__('Introducing Ads for WP', 'accelerated-mobile-pages'),
                            'indent' => true,
                            'layout_type' => 'accordion',
                            'accordion-open'=> 1, 
                        );
        $fields[] =   array(
                  'id'       => 'ampforwp-ads-module',
                  'class'=> is_plugin_active('ads-for-wp/ads-for-wp.php')? "adsactive": '',
                  'type'     => 'raw',
                  'content'  => '<div class="ampforwp-ads-data-update">
                                        '.(!is_plugin_active('ads-for-wp/ads-for-wp.php')? esc_html__('A Revolutionary new Ad plugin from our team which is dedicated to make the #1 Ad solution in the world.','accelerated-mobile-pages'): esc_html__('Thank you for upgrading the Ads for WP','accelerated-mobile-pages')).'
                                        <div class="row">
                                            
                                                '.(!is_plugin_active('ads-for-wp/ads-for-wp.php')? '
                                                <div class="col-3"><ul>
                                                    <li>'. esc_html__('Add Unlimited Incontent Ads','accelerated-mobile-pages') .'</li>
                                                    <li>'. esc_html__('Group Ads','accelerated-mobile-pages') .'</li>
                                                    <li>'. esc_html__('Display type','accelerated-mobile-pages') .'</li>
                                                </ul> </div>' : '')
                                            .'
                                            <div>
                                                '.(!is_plugin_active('ads-for-wp/ads-for-wp.php')? 
                                                    '
                        <div class="install-now ampforwp-activation-call-module-upgrade button  " id="ampforwp-adsforwp-activation-call" data-secure="'.wp_create_nonce('verify_module').'">
                            <p>' . esc_html__('Upgrade for Free','accelerated-mobile-pages') .'</p>
                        </div>' :
                                                    '<a href="'.admin_url('admin.php?page=adsforwp&tab=general&reference=ampforwp').'"><div class="ampforwp-recommendation-btn updated-message"><p>Go to Ads for WP settings</p></div></a>'
                                                )
                                                .'
                                                 &nbsp;<br/><a href="https://ampforwp.com/tutorials/article/what-is-ads-for-wp-update-all-about/" class="amp_recommend_learnmore" target="_blank">Learn more</a>
                                            </div>
                                    </div>' 
                                    
        );
        if ( !is_plugin_active('ads-for-wp/ads-for-wp.php') ) {
                $fields[] =     array(
                            'id' => 'amp-ads_2',
                           'type' => 'section',
                           'title' => esc_html__('Ad Performance', 'accelerated-mobile-pages'),
                           'indent' => true,
                           'layout_type' => 'accordion',
                           'accordion-open'=> 1,
                );

                $fields[] =    array(
                        'id'        =>'ampforwp-ads-data-loading-strategy',
                        'type'      => 'switch',
                        'title'     => esc_html__('Optimize For Viewability', 'accelerated-mobile-pages'),
                        'desc'=>'Enable this option only if your Ads are either 600px away from the top or not within the first 75% of the viewport and <a href="https://www.ampproject.org/docs/reference/components/amp-iframe" target="_blank">Click here for more information</a>',
                        'default'   => 0,
                        'tooltip-subtitle'  => esc_html__('This will increase the loading speed of the Ads', 'accelerated-mobile-pages'),
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    );
                $fields[] =    array(
                            'id' => 'amp-ads_3',
                           'type' => 'section',
                           'title' => esc_html__('General', 'accelerated-mobile-pages'),
                           'indent' => true,
                           'layout_type' => 'accordion',
                           'accordion-open'=> 1,
                );
                $fields[] =    array(
                        'id'        =>'ampforwp-ads-sponsorship',
                        'type'      => 'switch',
                        'title'     => esc_html__('Sponsorship Label', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    );
                $fields[] =    array(
                            'id'        =>'ampforwp-ads-sponsorship-label',
                            'type'      => 'text',
                            'required'  => array('ampforwp-ads-sponsorship', '=' , '1'),
                            'title'     => esc_html__('Sponsorship Label Text', 'accelerated-mobile-pages'),
                            'class' => 'child_opt child_opt_arrow',
                            'default'   => '',
                            'placeholder'=> 'Sponsored'
                        );
        }

           return $fields;
 }