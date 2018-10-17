 <?php
 use ReduxCore\ReduxFramework\Redux;

 function ampforwp_admin_advertisement_options($opt_name){
    $advertisementdesc = '';
    if(!is_plugin_active( 'amp-incontent-ads/amptoolkit-incontent-ads.php' ) ){
        $AD_URL = "http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=advertisement-tab&utm_campaign=AMP%20Plugin";
    $advertisementdesc = '<a href="'.$AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-retina.png" width="560" height="85" /></a>';
    }
// ADS SECTION
 Redux::setSection( $opt_name, array(
            'title'      => __( 'Advertisement', 'accelerated-mobile-pages' ),
            'desc' => $advertisementdesc,
            'id'         => 'amp-ads',
            'subsection' => true,
            'fields'     => array(
           array(
                       'id' => 'amp-ads_1',
                       'type' => 'section',
                       'title' => __('Advertisement Positions', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
                // Ad 1 Starts
                array(
                    'id'        =>'enable-amp-ads-1',
                    'type'      => 'switch',
                    'title'     => __('AD #1', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'desc'  => __('Below the Header (SiteWide)', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-1',
                        'type'     => 'select',
                        'title'    => __('AD Size', 'accelerated-mobile-pages'),
                        'required' => array('enable-amp-ads-1', '=' , '1'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '1' => __('300x250','accelerated-mobile-pages'),
                            '2' => __('336x280','accelerated-mobile-pages'),
                            '3' => __('728x90','accelerated-mobile-pages'),
                            '4' => __('300x600','accelerated-mobile-pages'),
                            '5' => __('320x100','accelerated-mobile-pages'),
                            '6' => __('200x50','accelerated-mobile-pages'),
                            '7' => __('320x50','accelerated-mobile-pages'),                      ),
                        'default'  => '2',
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-text-feild-client-1',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-1', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        => 'enable-amp-ads-text-feild-slot-1',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required' => array('enable-amp-ads-1', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-1',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-1', '=' , '1'),
                    ),
            // Ad 1 ends

            // Ad 2 Starts
                 array(
                    'id'=>'enable-amp-ads-2',
                    'type' => 'switch',
                    'title' => __('AD #2', 'accelerated-mobile-pages'),
                    'default' => 0,
                    'desc'     => __('Below the Footer (SiteWide)', 'accelerated-mobile-pages'),
                    'true' => 'Enabled',
                    'false' => 'Disabled',
                    ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-2',
                        'type'     => 'select',
                        'title'    => __('AD Size', 'accelerated-mobile-pages'),
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
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'       =>'enable-amp-ads-text-feild-client-2',
                        'type'     => 'text',
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                        'title'    => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'     => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'       => 'enable-amp-ads-text-feild-slot-2',
                        'type'     => 'text',
                        'title'    => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'     => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-2',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                    ),
            // Ad 2 ends

            // Ad 3 starts
                 array(
                        'id'        => 'enable-amp-ads-3',
                        'type'      => 'switch',
                        'title'     => __('AD #3', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'desc'  => __('Above the Post Content', 'accelerated-mobile-pages'),
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    ),
                 array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'        => 'made-amp-ad-3-global',
                        'type'      => 'select',
                        'title'     => __('Display on', 'accelerated-mobile-pages'),
                        'options'   => array (
                                            '1'    => 'Single',
                                            '2'    => 'Pages',
                                            '3'    => 'Custom Post Types',
                                            '4'    => 'Global'
                                         ),
                        'multi'     => true,
                        'default'   => '1',
                        'desc'  => __('Display the Ad on only post or on all posts and pages ', 'accelerated-mobile-pages'),
                        'required'  => array('enable-amp-ads-3', '=' , '1')
                    ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'        => 'enable-amp-ads-select-3',
                        'type'      => 'select',
                        'title'     => __('AD Size', 'accelerated-mobile-pages'),
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
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-text-feild-client-3',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-3', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        => 'enable-amp-ads-text-feild-slot-3',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('enable-amp-ads-3', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-3',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-3', '=' , '1'),
                    ),
            // Ad 3 ends

            // Ad 4 Starts
                array(
                    'id'        => 'enable-amp-ads-4',
                    'type'      => 'switch',
                    'title'     => __('AD #4', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'desc'  => __('Below the Post Content (Single Post)', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                    array(
                        'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-4',
                        'type'     => 'select',
                        'title'    => __('AD Size', 'accelerated-mobile-pages'),
                        'required' => array('enable-amp-ads-4', '=' , '1'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '1' => __('300x250','accelerated-mobile-pages'),
                            '2' => __('336x280','accelerated-mobile-pages'),
                            '3' => __('728x90','accelerated-mobile-pages'),
                            '4' => __('300x600','accelerated-mobile-pages'),
                            '5' => __('320x100','accelerated-mobile-pages'),
                            '6' => __('200x50','accelerated-mobile-pages'),
                            '7' => __('320x50','accelerated-mobile-pages')
                        ),
                        'default'  => '2',
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-text-feild-client-4',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-4', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        => 'enable-amp-ads-text-feild-slot-4',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('enable-amp-ads-4', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
                    array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-4',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-4', '=' , '1'),
                    ),
            // Ad 4 ends

            //Ad 5 Starts
            array(
                'id'        => 'enable-amp-ads-5',
                'type'      => 'switch',
                'title'     => __('AD #5', 'accelerated-mobile-pages'),
                'default'   => 0,
                'desc'  => __('Below The Title (Single Post)', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
                        'class' => 'child_opt child_opt_arrow',
                    'id'       => 'enable-amp-ads-select-5',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'accelerated-mobile-pages'),
                    'required' => array('enable-amp-ads-5', '=' , '1'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        '1' => __('300x250','accelerated-mobile-pages'),
                        '2' => __('336x280','accelerated-mobile-pages'),
                        '3' => __('728x90','accelerated-mobile-pages'),
                        '4' => __('300x600','accelerated-mobile-pages'),
                        '5' => __('320x100','accelerated-mobile-pages'),
                        '6' => __('200x50','accelerated-mobile-pages'),
                        '7' => __('320x50','accelerated-mobile-pages')
                    ),
                    'default'  => '2',
                ),
                array(
                        'class' => 'child_opt',
                    'id'        =>'enable-amp-ads-text-feild-client-5',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-5', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                        'class' => 'child_opt',
                    'id'        => 'enable-amp-ads-text-feild-slot-5',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-5', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
                array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-5',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-5', '=' , '1'),
                    ),

            //Ad 6 Starts
            array(
                'id'        => 'enable-amp-ads-6',
                'type'      => 'switch',
                'title'     => __('AD #6', 'accelerated-mobile-pages'),
                'default'   => 0,
                'desc'  => __('Above the Related Posts (Single Post)', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
                        'class' => 'child_opt child_opt_arrow',
                    'id'       => 'enable-amp-ads-select-6',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'accelerated-mobile-pages'),
                    'required' => array('enable-amp-ads-6', '=' , '1'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        '1' => __('300x250','accelerated-mobile-pages'),
                        '2' => __('336x280','accelerated-mobile-pages'),
                        '3' => __('728x90','accelerated-mobile-pages'),
                        '4' => __('300x600','accelerated-mobile-pages'),
                        '5' => __('320x100','accelerated-mobile-pages'),
                        '6' => __('200x50','accelerated-mobile-pages'),
                        '7' => __('320x50','accelerated-mobile-pages')
                    ),
                    'default'  => '2',
                ),
                array(
                        'class' => 'child_opt',
                    'id'        =>'enable-amp-ads-text-feild-client-6',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-6', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                        'class' => 'child_opt',
                    'id'        => 'enable-amp-ads-text-feild-slot-6',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-6', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
                array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-6',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-6', '=' , '1'),
                ),
            //Ad 7 Starts
            array(
                'id'        => 'enable-amp-ads-7',
                'type'      => 'switch',
                'title'     => __('AD #7', 'accelerated-mobile-pages'),
                'default'   => 0,
                'desc'  => __('Place wherever you want by going to Design -> Single option', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
                'required' =>array('amp-design-selector', '!=' , '4')
            ),
                array(
                        'class' => 'child_opt child_opt_arrow',
                    'id'       => 'enable-amp-ads-select-7',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'accelerated-mobile-pages'),
                    'required' => array('enable-amp-ads-7', '=' , '1'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        '1' => __('300x250','accelerated-mobile-pages'),
                        '2' => __('336x280','accelerated-mobile-pages'),
                        '3' => __('728x90','accelerated-mobile-pages'),
                        '4' => __('300x600','accelerated-mobile-pages'),
                        '5' => __('320x100','accelerated-mobile-pages'),
                        '6' => __('200x50','accelerated-mobile-pages'),
                        '7' => __('320x50','accelerated-mobile-pages')
                    ),
                    'default'  => '2',
                ),
                array(
                        'class' => 'child_opt',
                    'id'        =>'enable-amp-ads-text-feild-client-7',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-7', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                        'class' => 'child_opt',
                    'id'        => 'enable-amp-ads-text-feild-slot-7',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-7', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
                array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-7',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-7', '=' , '1'),
                ),
         //Ad 8 Starts
            array(
                'id'        => 'enable-amp-ads-8',
                'type'      => 'switch',
                'title'     => __('AD #8', 'accelerated-mobile-pages'),
                'default'   => 0,
                'desc'  => __('Place wherever you want by going to Design -> Single option', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
                'required' =>array('amp-design-selector', '!=' , '4')
            ),
                array(
                        'class' => 'child_opt child_opt_arrow',
                    'id'       => 'enable-amp-ads-select-8',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'accelerated-mobile-pages'),
                    'required' => array('enable-amp-ads-8', '=' , '1'),
                    // Must provide key => value pairs for select options
                    'options'  => array(
                        '1' => __('300x250','accelerated-mobile-pages'),
                        '2' => __('336x280','accelerated-mobile-pages'),
                        '3' => __('728x90','accelerated-mobile-pages'),
                        '4' => __('300x600','accelerated-mobile-pages'),
                        '5' => __('320x100','accelerated-mobile-pages'),
                        '6' => __('200x50','accelerated-mobile-pages'),
                        '7' => __('320x50','accelerated-mobile-pages')
                    ),
                    'default'  => '2',
                ),
                array(
                        'class' => 'child_opt',
                    'id'        =>'enable-amp-ads-text-feild-client-8',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-8', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                        'class' => 'child_opt',
                    'id'        => 'enable-amp-ads-text-feild-slot-8',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'tooltip-subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-8', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
                array(
                        'class' => 'child_opt',
                        'id'        =>'enable-amp-ads-resp-8',
                        'type'      => 'switch',
                        'title'     => __('Responsive Ad unit', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'required' => array('enable-amp-ads-8', '=' , '1'),
                ),           

           array(
                        'id' => 'amp-ads_2',
                       'type' => 'section',
                       'title' => __('Ad Performance', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),

           array(
                        'id' => 'amp-ads_2',
                       'type' => 'section',
                       'title' => __('Ad Performance', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
                array(
                    'id'        =>'ampforwp-ads-data-loading-strategy',
                    'type'      => 'switch',
                    'title'     => __('Optimize For Viewability', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'tooltip-subtitle'  => __('This will increase the loading speed of the Ads', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
           array(
                        'id' => 'amp-ads_3',
                       'type' => 'section',
                       'title' => __('General', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'layout_type' => 'accordion',
                       'accordion-open'=> 1,
            ),
                array(
                    'id'        =>'ampforwp-ads-sponsorship',
                    'type'      => 'switch',
                    'title'     => __('Sponsorship Label', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                array(
                        'id'        =>'ampforwp-ads-sponsorship-label',
                        'type'      => 'text',
                        'required'  => array('ampforwp-ads-sponsorship', '=' , '1'),
                        'title'     => __('Sponsorship Label Text', 'accelerated-mobile-pages'),
                        'class' => 'child_opt child_opt_arrow',
                        'default'   => '',
                        'placeholder'=> 'Sponsored'
                    ),

            ),
        ) );   
 }