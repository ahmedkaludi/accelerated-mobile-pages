<?php
    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_builder_amp";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'redux_builder_amp',
        'display_name' => 'Accelerated Mobile Pages Options',
        //'display_version' => '0.7.1',
        'page_slug' => 'amp_options',
        'page_title' => 'Accelerated Mobile Pages Options',
        'update_notice' => false,
        'intro_text' => '<a href="https://wordpress.org/support/plugin/accelerated-mobile-pages" target="_blank">Need Help? Support Forum</a> | <a href="https://wordpress.org/plugins/accelerated-mobile-pages/faq/" target="_blank">FAQ</a> |  <a href="https://wordpress.org/plugins/accelerated-mobile-pages/changelog/" target="_blank">Change Log</a> | <a href="https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages" target="_blank">Reviews</a>| <a href="https://www.paypal.me/Kaludi/5" target="_blank">Donate</a>',
        'footer_text' => '',
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'AMP',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'default_mark' => '',
        'class' => 'amp_options_class',
        'hints' => array(
            'icon' => 'el el-adjust-alt',
            'icon_position' => 'left',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ahmedkaludi/Accelerated-Mobile-Pages',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Basic Field', 'redux-framework-demo' ),
        'id'     => 'basic',
        'desc'   => __( 'Basic field with no subsections.', 'redux-framework-demo' ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'opt-blank',
                'title'    => __( 'Example Text', 'redux-framework-demo' ),
                'desc'     => __( 'Example description.', 'redux-framework-demo' ),
                'subtitle' => __( 'Example subtitle.', 'redux-framework-demo' ),
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Welcome', 'redux-framework-demo' ),
        'id'    => 'basic',
        'desc'  => __( '<div class="amp-faq">Thank you for using Accelerated Mobile Pages plugin.  <b> <a href="http://ampforwp.com/new/" target="_blank"> What\'s New in this Version?</a></b>'. '<p>' . sprintf( __( 'We are actively working on updating the plugin. We have built user friendly options which allows you to make changes on your AMP version. I have put togeather some frequently asked questions below.', 'redux-framework-demo' ), 'redux-framework-demo' ) . '</p>'
			               . '<h2>' . __( 'Frequently Asked Questions', 'redux-framework-demo' ) . '</h2>'
			               . '<p><strong>' . __( 'How to Setup Navigation Menu?', 'redux-framework-demo' ) . '</strong><br/>' . __( 'We have created a Seperate Navigation menu for AMP version which you can setup from the WordPress Menus, then navigate to Menu Locations, their you will notice AMP Menu. You can assign existing menus to this locations.', 'redux-framework-demo' ) . '</p>'
			               . '<p><strong>' . __( 'I added /?amp on the end of one of my URLs and a minimalist version of my page appeared. It looks just like on one of your screenshots, so I guess its installed properly. Okay what now? Is it just enough to install it and the plugin will do the rest?', 'redux-framework-demo' ) . '</strong><br/>' . __( 'After you see the minimalist view if you use the url with ?amp then it means that it has been installed properly. You dont need any extra steps to enable it.', 'redux-framework-demo' ) . '</p>'
			               . '<p><strong>' . __( 'The plugin supposed to redirect all mobile visitors to AMP version of site or not? ', 'redux-framework-demo' ) . '</strong><br/>' . __( 'When you view the website from the mobile, it is not supposed to redirect you to the amp version, amp version is always ready for google in the backend, if Google wants to serve to the people, then it will get the amp version and serve to the customers.
', 'redux-framework-demo' ) . '</p>'

                           . '<p><strong>' . __( 'I am worried that it will cause Duplicate content?', 'redux-framework-demo' ) . '</strong><br/>' . __( 'In the AMP version, we are using Canonical tag to solve this. I am 100% sure that using this plugin will not duplicate the content.
', 'redux-framework-demo' ) . '</p>'


                           . '<p><strong>' . __( 'How do I know that my site is AMP enabled?
', 'redux-framework-demo' ) . '</strong><br/>' . __( 'Add /?amp at the end of your website url and you will get amp version of your website.', 'redux-framework-demo' ) . '</p>'

 			               . '<p><strong>' . sprintf( __( 'I have addded /?amp at the end of the url and still I am not able to see the AMP version of my site?
', 'redux-framework-demo' ), 'redux-framework-demo' ) . '</strong><br/>'
 	   					   . sprintf( __( 'Please check if you have "Pretty Permalinks" enabled. If not then activate it.', 'redux-framework-demo' ), '' )
						   . '</p>'

 			               . '<p><strong>' . sprintf( __( 'How do I report Bug reports?
', 'redux-framework-demo' ), 'redux-framework-demo' ) . '</strong><br/>'
 	   					   . sprintf( __( 'Before you submit a new bug, please check if there already is an existing bug report for it. If so, it may be far more valuable to add to the existing one, than to create a new bug report. You can submit bug reports and feature requests at

 %1$sGitHub Issues Page%2$s.

                           ', 'redux-framework-demo' ), '<a target="_blank" href="' . esc_url( 'https://github.com/ahmedkaludi/Accelerated-Mobile-Pages/issues' ) . '">', '</a>' )
						   . '</p>'

 	   					   . sprintf( __( '

                      <h2>%1$sLike this plugin? Support us by leaving a 5 Star Rating%2$s</h2><br />
                     ', 'redux-framework-demo' ), '<a target="_blank" href="' . esc_url( 'https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages?rate=5#postform' ) . '">', '</a>' )
						   . '</p></div>'

				 , 'redux-framework-demo' ),
        'icon'  => 'el el-home'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'General', 'redux-framework-demo' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/text/" target="_blank">http://docs.reduxframework.com/core/fields/text/</a>',
        'id'         => 'opt-text-subsection',
        'subsection' => true,
        'fields'     => array(
            $fields =  array(
                'id'       => 'opt-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Logo', 'redux-framework-demo'),
                'subtitle' => __('Upload a logo for the AMP version.', 'redux-framework-demo'),
                'desc'    => __('Recommend logo size is: 190x36', 'redux-framework-demo')
            ),
            array(
                'id'       => 'amp-analytics-select-option',
                'type'     => 'select',
                'title'    => __( 'Analytics Type', 'redux-framework-demo' ),
                'subtitle' => __( 'Select your Analytics provider.', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => __('Google Analytics', 'redux-framework-demo' ),
                    '2' => __('Segment Analytics', 'redux-framework-demo' ),
                    '3' => __('Piwik Analytics', 'redux-framework-demo' )
                ),
                'default'  => '1'
            ),
              array(
                  'id'       => 'ga-feild',
                  'type'     => 'text',
                  'title'    => __( 'Google Analytics', 'redux-framework-demo' ),
                  'required' => array('amp-analytics-select-option', '=' , '1'),
                  'subtitle' => __( 'Enter your Google Analytics ID.', 'redux-framework-demo' ),
                  'desc'     => __('Example: UA-XXXXX-Y', 'redux-framework-demo' ),
                  'default'  => 'UA-XXXXX-Y',
              ),
              array(
                'id'       => 'sa-feild',
                'type'     => 'text',
                'title'    => __( 'Segment Analytics', 'redux-framework-demo' ),
                'subtitle' => __( 'Enter your Segment Analytics Key.', 'redux-framework-demo' ),
                'required' => array('amp-analytics-select-option', '=' , '2'),
                'default'  => 'SEGMENT-WRITE-KEY',
              ),
              array(
                  'id'       => 'pa-feild',
                  'type'     => 'text',
                  'title'    => __( 'Piwik Analytics', 'redux-framework-demo' ),
                  'required' => array('amp-analytics-select-option', '=' , '3'),
                  'desc'     => __( 'Example: https://piwik.example.org/piwik.php?idsite=YOUR_SITE_ID&rec=1&action_name=TITLE&urlref=DOCUMENT_REFERRER&url=CANONICAL_URL&rand=RANDOM', 'redux-framework-demo' ),
                  'subtitle' => __('Enter your Piwik Analytics URL.', 'redux-framework-demo' ),
                  'default'  => '#',
              ),

            array(
                'id'        =>'amp-frontpage-select-option',
                'type'      => 'switch',
                'title'     => __('Front Page', 'redux-framework-demo'),
                'default'   => 0,
                'subtitle'  => __('Custom AMP front page', 'redux-framework-demo'),
                'true'      => 'true',
                'false'     => 'false',
            ),
            array(
                'id'       => 'amp-frontpage-select-option-pages',
                'type'     => 'select',
                'title'    => __('Select Page as Front Page', 'redux-framework-demo'),
                'required' => array('amp-frontpage-select-option', '=' , '1'),
                // Must provide key => value pairs for select options
                'data'     => 'page',
                'args'     => array(
                    'post_type' => 'page',
                    'posts_per_page' => 500
                ),
                'default'  => '2',
            ),

            // array(
            //     'id'       => 'amp-footer-text',
            //     'title'    => __('Footer', 'redux-framework-demo'),
            //     'type'     => 'text',
            //     'subtitle'  => __('Enter Footer text', 'redux-framework-demo'),
            //     'placeholder'  => 'Copyright &copy; 2016',
            //     'default'  => 'Copyright &copy; 2016',
            // ),

            array(
                'id'       => 'amp-footer-link-non-amp-page',
                'type'     => 'switch',
                'title'    => __('Link to Non-AMP page', 'redux-framework-demo'),
                'subtitle' => __('Enable / Disable Link to Non-AMP page in the footer', 'redux-framework-demo'),
                'true'      => 'true',
                'false'     => 'false',
                'default'   => 1
            ),

        array(
            'id'        =>'amp-rtl-select-option',
            'type'      => 'switch',
            'title'     => __('RTL Support', 'redux-framework-demo'),
            'default'   => 0,
            'subtitle'  => __('Enable Right to Left language support', 'redux-framework-demo'),
            'true'      => 'true',
            'false'     => 'false',
        ),
        // array(
        //     'id'       => 'amp-navigation-text',
        //     'title'    => __('Navigation Text', 'redux-framework-demo'),
        //     'type'     => 'text',
        //     'subtitle' =>__('Enter text to appear on Navigation Button', 'redux-framework-demo'),
        //     'placeholder'=>'Navigate',
        //     'default'  => 'Navigate'
        // ),
            array(
              'id'       => 'ampforwp-amp-archive-pages-on-off',
            'type'     => 'switch',
            'title'    => __('AMP on Archive Pages', 'redux-framework-demo'),
            'subtitle' => __('Enable / Disable AMP in the categories and tags pages', 'redux-framework-demo'),
            'true'      => 'true',
            'false'     => 'false'
            ),
            array(
                'id'        =>'amp-on-off-for-all-pages',
                'type'      => 'switch',
                'title'     => __('AMP on Pages', 'redux-framework-demo'),
                'subtitle'  => __('Enable or Disable AMP on all Pages', 'redux-framework-demo'),
                'default'   => 0,
            ),
            array(
                'id'        =>'amp-on-off-support-for-non-amp-home-page',
                'type'      => 'switch',
                'title'     => __('Non-AMP HomePage link in Header', 'redux-framework-demo'),
                'subtitle'  => __('If you want users in header to go to non-AMP website from the Header, then you can enable this option', 'redux-framework-demo'),
                'default'   => 0,
            ),
          //  array(
          //      'id'       => 'amp-ad-places',
          //      'type'     => 'select',
          //      'title'    => __( 'Ads on Page', 'redux-framework-demo' ),
          //      'subtitle' => __( 'select your preferece for Ads on Post Types', 'redux-framework-demo' ),
          //      'options'  => array(
          //          '1' => __('Only on Posts', 'redux-framework-demo' ),
          //          '2' => __('Only on Pages', 'redux-framework-demo' ),
          //          '3' => __('on Both', 'redux-framework-demo' ),
          //      ),
          //      'default'  => '3'
          //  ),

      )
    ) );//END

    // AMP Design SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Design', 'redux-framework-demo' ),
       'desc'       => __( '<b>Quick Links: <a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'">AMP Page Builder & Color Settings</a></b>'),
       'id'         => 'amp-design',
       'subsection' => true,
        'fields'     => array(

            $fields =  array(
                'id'       => 'amp-design-selector',
                'type'     => 'select',
                'title'    => __( 'Design Selector', 'redux-framework-demo' ),
                'subtitle' => __( 'Select your design.', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => __('Design One', 'redux-framework-demo' ),
                    '2' => __('Design two', 'redux-framework-demo' )
                ),
                'default'  => '2'
            ),

        array(
            'id'       => 'css_editor',
            'type'     => 'ace_editor',
            'title'    => __('Custom CSS', 'redux-framework-demo'),
            'subtitle' => __('You can customize the Stylesheet of the AMP version by using this option.', 'redux-framework-demo'),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'desc'     => '',
            'default'  => "/******* Paste your Custom CSS in this Editor *******/"
        ),
        )

   )

   );



   // SEO SECTION
  Redux::setSection( $opt_name, array(
      'title'      => __( 'SEO', 'redux-framework-demo' ),
      'desc'       => __( '', 'redux-framework-demo'),
      'id'         => 'amp-seo',
      'desc'       => '<strong>Note : <br/> This section only works if  Yoast SEO Plugin is Activated (Exception : Additional Meta Tags Section) </strong>',
      'subsection' => true,
       'fields'     => array(

           array(
               'id'       => 'ampforwp-seo-yoast-meta',
               'type'     => 'switch',
               'subtitle'     => __('Adds Social and Open Graph Meta Tags from Yoast', 'redux-framework-demo'),
               'title'    => __( 'Add Meta Tags from Yoast', 'redux-framework-demo' ),
               'default'  => '1'
           ),
           array(
               'id'       => 'ampforwp-seo-yoast-custom-description',
               'type'     => 'switch',
               'subtitle'     => __('Adds Yoast Custom description to ld+json for AMP page', 'redux-framework-demo'),
               'title'    => __( 'Yoast Custom Description for AMP page', 'redux-framework-demo' ),
               'default'  => '1'
           ),

           array(
               'id'       => 'ampforwp-seo-custom-additional-meta',
               'type'     => 'textarea',
               'title'    => __('Additional tags for Head section AMP page', 'redux-framework-demo'),
               'subtitle' => __('Adds additional Meta to the head section', 'redux-framework-demo', 'redux-framework-demo'),
               'desc' => __('Only link and meta tags allowed', 'redux-framework-demo'),
               'placeholder'  => "<!-- Paste your Additional HTML , that goes between <head> </head> tags -->"
           ),

       )

  )

  );
    // AMP Menu SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Menu', 'redux-framework-demo' ),
       'desc'       => __( 'Add Menus to your AMP pages by clicking on this <a href="'.trailingslashit(get_admin_url()).'nav-menus.php?action=locations">link</a>'),
       'id'         => 'amp-menus',
       'subsection' => true)

   ) ;

$AD_URL = "http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=advertisement-tab&utm_campaign=AMP%20Plugin";
$desc = '';
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(!is_plugin_active( 'amp-incontent-ads/amptoolkit-incontent-ads.php' ) ){
  $desc = '<a href="'.$AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-retina.png" width="560" height="85" /></a>';
}
    // ADS SECTION
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Advertisement', 'redux-framework-demo' ),
        'desc' => $desc,
        'id'         => 'amp-ads',
        'subsection' => true,
        'fields'     => array(
            // Ad 1 Starts
            array(
                'id'        =>'enable-amp-ads-1',
                'type'      => 'switch',
                'title'     => __('AD #1', 'redux-framework-demo'),
                'default'   => 0,
                'subtitle'  => __('Below the Header (SiteWide)', 'redux-framework-demo'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
                    'id'       => 'enable-amp-ads-select-1',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'redux-framework-demo'),
                    'required' => array('enable-amp-ads-1', '=' , '1'),
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
                    'id'        =>'enable-amp-ads-text-feild-client-1',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-1', '=' , '1'),
                    'title'     => __('Data AD Client', 'redux-framework-demo'),
                    'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'redux-framework-demo'),
                    'default' 	=> '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                    'id'        => 'enable-amp-ads-text-feild-slot-1',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'redux-framework-demo'),
                    'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'redux-framework-demo'),
                    'default' 	=> '',
                    'required' => array('enable-amp-ads-1', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
        // Ad 1 ends

        // Ad 2 Starts
             array(
                'id'=>'enable-amp-ads-2',
                'type' => 'switch',
                'title' => __('AD #2', 'redux-framework-demo'),
                'default' => 0,
                'subtitle'     => __('Below the Footer (SiteWide)', 'redux-framework-demo'),
                'true' => 'Enabled',
                'false' => 'Disabled',
                ),
                array(
                    'id'       => 'enable-amp-ads-select-2',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'redux-framework-demo'),
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
                    'id'       =>'enable-amp-ads-text-feild-client-2',
                    'type'     => 'text',
                    'required' => array('enable-amp-ads-2', '=' , '1'),
                    'title'    => __('Data AD Client', 'redux-framework-demo'),
                    'subtitle'     => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'redux-framework-demo'),
                    'default' 	=> '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                    'id'       => 'enable-amp-ads-text-feild-slot-2',
                    'type'     => 'text',
                    'title'    => __('Data AD Slot', 'redux-framework-demo'),
                    'subtitle'     => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'redux-framework-demo'),
                    'default' 	=> '',
                    'required' => array('enable-amp-ads-2', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
        // Ad 2 ends

        // Ad 3 starts
             array(
                    'id'        => 'enable-amp-ads-3',
                    'type'      => 'switch',
                    'title'     => __('AD #3', 'redux-framework-demo'),
                    'default'   => 0,
                    'subtitle'  => __('Above the Post Content (Single Post)', 'redux-framework-demo'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                array(
                    'id'        => 'enable-amp-ads-select-3',
                    'type'      => 'select',
                    'title'     => __('AD Size', 'redux-framework-demo'),
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
                    'id'        =>'enable-amp-ads-text-feild-client-3',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-3', '=' , '1'),
                    'title'     => __('Data AD Client', 'redux-framework-demo'),
                    'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'redux-framework-demo'),
                    'default' 	=> '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                    'id'        => 'enable-amp-ads-text-feild-slot-3',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'redux-framework-demo'),
                    'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'redux-framework-demo'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-3', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),
        // Ad 3 ends

        // Ad 4 Starts
            array(
                'id'        => 'enable-amp-ads-4',
                'type'      => 'switch',
                'title'     => __('AD #4', 'redux-framework-demo'),
                'default'   => 0,
                'subtitle'  => __('Below the Post Content (Single Post)', 'redux-framework-demo'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
                    'id'       => 'enable-amp-ads-select-4',
                    'type'     => 'select',
                    'title'    => __('AD Size', 'redux-framework-demo'),
                    'required' => array('enable-amp-ads-4', '=' , '1'),
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
                    'id'        =>'enable-amp-ads-text-feild-client-4',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-4', '=' , '1'),
                    'title'     => __('Data AD Client', 'redux-framework-demo'),
                    'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'redux-framework-demo'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                    'id'        => 'enable-amp-ads-text-feild-slot-4',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'redux-framework-demo'),
                    'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'redux-framework-demo'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-4', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                )
        // Ad 4 ends
        ),
    ) );


    // Single Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Single', 'redux-framework-demo' ),
        'desc'       => __( 'Additional Options to control the look of Single  <a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"> Click here </a> ', 'redux-framework-demo' ),
        'id'         => 'amp-single',
        'subsection' => true,
        'fields'     => array(
          // Social Icons ON/OFF
          array(
              'id'        => 'enable-single-social-icons',
              'type'      => 'switch',
              'title'     => __('Sticky Social Icons', 'redux-framework-demo'),
              'default'   => 1,
              'subtitle'  => __('Enable Social Icons in single', 'redux-framework-demo'),
          ),
          //deselectable next previous links
          array(
              'id'        => 'enable-single-next-prev',
              'type'      => 'switch',
              'title'     => __('Next-Previous Links', 'redux-framework-demo'),
              'default'   => 1,
              'subtitle'  => __('Enable Next-Previous links in single', 'redux-framework-demo'),
          ),
          // Width and Height of Image
          array(
             'id'           => 'enable-single-featured-img-width',
             'type'         => 'text',
             'title'        => __('Featured Image Width', 'redux-framework-demo'),
             'default'      => 512,
             'subtitle'     => __('Custom featured image width in Units : Px', 'redux-framework-demo'),
             'placeholder'  =>'Width here',
           ),
           array(
              'id'          => 'enable-single-featured-img-height',
              'type'        => 'text',
              'title'       => __('Featured Image Height', 'redux-framework-demo'),
              'default'     => 300,
              'subtitle'    => __('Custom featured image height in Units : Px', 'redux-framework-demo'),
              'placeholder' =>'Height here',
          ),
          // Related Post
	        array(
    		        'id'       => 'ampforwp-single-select-type-of-related',
    		        'type'     => 'select',
    		        'title'    => __('Show Related Post from', 'redux-framework-demo'),
    		        'data'     => 'page',
                'subtitle' => __('select the type of related posts', 'redux-framework-demo'),
    		        'options'  => array(
    			        '1' => 'Tags',
    			        '2' => 'Categories'
    		        ),
               'default'  => '2',
	        ),
        ),

    ) );

    // Social Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social', 'redux-framework-demo' ),
        'id'         => 'amp-social',
        'subsection' => true,
        'fields'     => array(
          // Facebook ON/OFF
          array(
              'id'        =>  'enable-single-facebook-share',
              'type'      =>  'switch',
              //'required'  => array('enable-single-social-icons', '=' , '1'),
              'title'     =>  __('Facebook', 'redux-framework-demo'),
              'default'   =>  0,
          ),
          // Facebook app ID
          array(
               'id'       => 'amp-facebook-app-id',
               'title'    => __('Facebook App ID', 'redux-framework-demo'),
               'subtitle' => __('In order to use Facebook share you need to register an app ID, you can register one here: https://developers.facebook.com/apps.', 'redux-framework-demo'),
               'type'     => 'text',
               'required'  => array('enable-single-facebook-share', '=' , '1'),
               'placeholder'  => 'Enter your facebook app id',
               'default'  => ''
          ),
          // Twitter ON/OFF
          array(
              'id'        =>  'enable-single-twitter-share',
              'type'      =>  'switch',
              'title'     =>  __('Twitter', 'redux-framework-demo'),
              'default'   =>  1,
          ),
          // GooglePlus ON/OFF
          array(
              'id'        =>  'enable-single-gplus-share',
              'type'      =>  'switch',
              'title'     =>  __('GooglePlus', 'redux-framework-demo'),
              'default'   =>  1,
          ),
          // Email ON/OFF
          array(
              'id'        =>  'enable-single-email-share',
              'type'      =>  'switch',
              'title'     =>  __('Email', 'redux-framework-demo'),
              'default'   =>  1,
          ),
          // Pinterest ON/OFF
          array(
              'id'        =>  'enable-single-pinterest-share',
              'type'      =>  'switch',
              'title'     =>  __('Pinterest', 'redux-framework-demo'),
              'default'   =>  1,
          ),
          // LinkedIn ON/OFF
          array(
              'id'        =>  'enable-single-linkedin-share',
              'type'      =>  'switch',
              'title'     =>  __('LinkedIn', 'redux-framework-demo'),
              'default'   =>  1,
          ),
          // WhatsApp
          array(
              'id'        =>  'enable-single-whatsapp-share',
              'type'      =>  'switch',
              'title'     =>  __('WhatsApp', 'redux-framework-demo'),
              'default'   =>  1,
          ),
        )
    ) );

    // Structured Data
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Structured Data', 'redux-framework-demo' ),
        'id'         => 'opt-structured-data',
        'subsection' => true,
        'fields'     => array(
            array(
              'id'       => 'amp-structured-data-logo',
              'type'     => 'media',
              'url'      => true,
              'title'    => __('Default Structured Data Logo', 'redux-framework-demo'),
              'subtitle' => __('Upload the logo you want to show in Google Structured Data. ', 'redux-framework-demo'),
            ),
            array(
              'id'      => 'amp-structured-data-placeholder-image',
              'type'    => 'media',
              'url'     => true,
              'title'   => __('Default Post Image', 'redux-framework-demo'),
              'subtitle'    => __('Upload the Image you want to show as Placeholder Image.', 'redux-framework-demo'),
              'placeholder'  => 'when there is no featured image set in the post',
            ),
            array(
            'id'       => 'amp-structured-data-placeholder-image-width',
            'title'    => __('Default Post Image Width', 'redux-framework-demo'),
            'type'     => 'text',
            'placeholder' => '550',
            'subtitle' => 'Please don\'t add "PX" in the image size.',
            'default'  => ''
            ),
            array(
              'id'       => 'amp-structured-data-placeholder-image-height',
              'title'    => __('Default Post Image Height', 'redux-framework-demo'),
              'type'     => 'text',
              'placeholder' => '350',
              'subtitle' => 'Please don\'t add "PX" in the image size.',
              'default'  => ''
             ),
        )
    ) );

    // Notifications SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Notifications', 'redux-framework-demo' ),
       'desc'       => __( 'Add notifications to your AMP pages'),
       'id'         => 'amp-notifications',
       'subsection' => true,
       'fields'     => array(
           array(
               'id'        =>'amp-enable-notifications',
               'type'      => 'switch',
               'title'     => __('Enable Notifications', 'redux-framework-demo'),
               'default'   => '',
               'subtitle'  => __('Show notifications on all of your AMP pages for cookie purposes, or anything else.', 'redux-framework-demo'),
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           ),
           array(
           'id'       => 'amp-notification-text',
           'title'    => __('Notification text', 'redux-framework-demo'),
           'type'     => 'text',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => 'This website uses cookies.',
           'placeholder' => 'Enter Text here',
           ),
            array(
           'id'       => 'amp-accept-button-text',
           'title'    => __('Notification accept button text', 'redux-framework-demo'),
           'type'     => 'text',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => 'Accept',
           'placeholder' => 'Enter Text here',
           ),

       ),

   ) );

   // Translation Panel
           Redux::setSection( $opt_name, array(
               'title'      => __( 'Translation Panel', 'redux-framework-demo' ),
               'desc'       => __( 'Please translate the following words of page accordingly else default content is in English Language', 'redux-framework-demo' ),
               'id'         => 'amp-translator',
               'subsection' => true,
               'fields'     => array(
                   array(
                       'id'       => 'amp-translator-top-text',
                       'type'     => 'text',
                       'title'    => __('Top', 'redux-framework-demo'),
                       'default'  => 'Top',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-non-amp-page-text',
                       'type'     => 'text',
                       'title'    => __('View Non-AMP Version', 'redux-framework-demo'),
                       'default'  => 'View Non-AMP Version',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-related-text',
                       'type'     => 'text',
                       'title'    => __('Related Post', 'redux-framework-demo'),
                       'default'  => 'Related Post',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-navigate-text',
                       'type'     => 'text',
                       'title'    => __('Navigate', 'redux-framework-demo'),
                       'default'  => 'Navigate',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-on-text',
                       'type'     => 'text',
                       'title'    => __('On', 'redux-framework-demo'),
                       'default'  => 'On',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-next-text',
                       'type'     => 'text',
                       'title'    => __('Next', 'redux-framework-demo'),
                       'default'  => 'Next',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-previous-text',
                       'type'     => 'text',
                       'title'    => __('Previous', 'redux-framework-demo'),
                       'default'  => 'Previous',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-footer-text',
                       'type'     => 'textarea',
                       'title'    => __('Footer', 'redux-framework-demo'),
                       'default'  => 'All Rights Reserved',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-categories-text',
                       'type'     => 'text',
                       'title'    => __('Categories', 'redux-framework-demo'),
                       'default'  => 'Categories: ',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-tags-text',
                       'type'     => 'text',
                       'title'    => __('Tags', 'redux-framework-demo'),
                       'default'  => 'Tags: ',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-by-text',
                       'type'     => 'text',
                       'title'    => __('By', 'redux-framework-demo'),
                       'default'  => 'By',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-view-comments-text',
                       'type'     => 'text',
                       'title'    => __('View Comments', 'redux-framework-demo'),
                       'default'  => 'View Comments',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-leave-a-comment-text',
                       'type'     => 'text',
                       'title'    => __('Leave a Comment', 'redux-framework-demo'),
                       'default'  => 'Leave a Comment',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-at-text',
                       'type'     => 'text',
                       'title'    => __('at', 'redux-framework-demo'),
                       'default'  => 'at',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-says-text',
                       'type'     => 'text',
                       'title'    => __('says', 'redux-framework-demo'),
                       'default'  => 'says',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-Edit-text',
                       'type'     => 'text',
                       'title'    => __('Edit', 'redux-framework-demo'),
                       'default'  => 'Edit',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-ago-date-text',
                       'type'     => 'text',
                       'title'    => __('ago', 'redux-framework-demo'),
                       'default'  => 'ago',
                       'placeholder'=>'write here'
                   ),
               )
           ) );


//    // CSS
//    Redux::setSection( $opt_name, array(
//        'title'      => __( 'Custom CSS Editor', 'redux-framework-demo' ),
//       // 'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
//        'id'         => 'opt-css-editor',
//        'subsection' => true,
//        'fields'     => array(
//            array(
//                'id'       => 'css_editor',
//                'type'     => 'ace_editor',
//                'title'    => __('Custom CSS', 'redux-framework-demo'),
//                'subtitle' => __('You can customize the Stylesheet of the AMP version by using this option.', 'redux-framework-demo'),
//                'mode'     => 'css',
//                'theme'    => 'monokai',
//                'desc'     => '',
//                'default'  => "/******* Paste your Custom CSS in this Editor *******/"
//            ),
//        )
//    ) );
//


// // Advance Settings SECTION
// Redux::setSection( $opt_name, array(
//    'title'      => __( 'Advance Settings', 'redux-framework-demo' ),
//    'desc'       => __( 'This section has Advance settings'),
//    'id'         => 'amp-advance',
//    'subsection' => true,
//    'fields'     => array(
//
//    ),
//
// ) );
//

// Extension Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Extensions', 'redux-framework-demo' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-go-premium',
        'subsection' => false,
        'desc' => '<a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=extension-tab_advanced-amp-ads&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-extension.png" width="345" height="500" /></a>

        <a href="http://ampforwp.com/custom-post-type/#utm_source=options-panel&utm_medium=extension-tab_custom-post-type&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-custom-post-type-extension.png" width="345" height="500" /></a>

        <a href="http://ampforwp.com/doubleclick-for-publishers/#utm_source=options-panel&utm_medium=extension-tab_doubleclick&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-DoubleClick-extensions.png" width="345" height="500" /></a>

        <a href="http://ampforwp.com/amp-ratings/#utm_source=options-panel&utm_medium=extension-tab_amp-ratings&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-rating-extension.png" width="345" height="500" /></a>

 
        <a href="http://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=extension-tab_coming-soon&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/extension-coming-soon.png" width="345" height="500" /></a>',
        'icon' => 'el el-info-circle',
    ) );
/*
* <--- END SECTIONS
*/