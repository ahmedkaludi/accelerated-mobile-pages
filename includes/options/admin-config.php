<?php
// Admin Panel Options

if ( ! class_exists( 'Redux' ) ) {
    return;
}

// Option name where all the Redux data is stored.
$opt_name = "redux_builder_amp";

// All the possible arguments for Redux.
//$amp_redux_header = '<span id="name"><span style="color: #4dbefa;">U</span>ltimate <span style="color: #4dbefa;">W</span>idgets</span>';

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'              => 'redux_builder_amp', // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'          =>  __( 'Accelerated Mobile Pages Options','ampforwp' ), // Name that appears at the top of your panel
    'menu_type'             => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'        => true, // Show the sections below the admin menu item or not
    'menu_title'            => __( 'AMP', 'ampforwp' ),
    'page_title'            => 'Accelerated Mobile Pages Options',
    'display_version'       => AMPFORWP_VERSION,
    'update_notice'         => false,
    'intro_text'            => '<a href="https://wordpress.org/support/plugin/accelerated-mobile-pages" target="_blank">Need Help? Support Forum</a> | <a href="https://wordpress.org/plugins/accelerated-mobile-pages/faq/" target="_blank">FAQ</a> |  <a href="https://wordpress.org/plugins/accelerated-mobile-pages/changelog/" target="_blank">Change Log</a> | <a href="https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages" target="_blank">Reviews</a>| <a href="https://www.paypal.me/Kaludi/5" target="_blank">Donate</a>',
    'global_variable'       => '', // Set a different name for your global variable other than the opt_name
    'dev_mode'              => false, // Show the time the page took to load, etc
    'customizer'            => false, // Enable basic customizer support,
    'async_typography'      => false, // Enable async for fonts,
    'disable_save_warn'     => true,
    'open_expanded'         => false,
    // OPTIONAL -> Give you extra features
    'page_priority'         => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'           => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'      => 'manage_options', // Permissions needed to access the options panel.
    'last_tab'              => '', // Force your panel to always open to a specific tab (by id)
    'page_icon'             => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
    'page_slug'             => 'amp_options', // Page slug used to denote the panel
    'save_defaults'         => true, // On load save the defaults to DB before user clicks save or not
    'default_show'          => false, // If true, shows the default value next to each field that is not the default value.
    'default_mark'          => '', // What to print by the field's title if the value shown is default. Suggested: *
    'admin_bar'             => false,
    'admin_bar_icon'        => 'dashicons-admin-generic',
    // CAREFUL -> These options are for advanced use only
    'output'                => false, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'            => false, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
    'footer_credit'         => false, // Disable the footer credit of Redux. Please leave if you can help it.
    'footer_text'           => "",
    'show_import_export'    => true,
    'system_info'           => true,

);

    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ahmedkaludi/Accelerated-Mobile-Pages',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );


Redux::setArgs( "redux_builder_amp", $args );




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

    function ampforwp_plugin_activation_notice() {
      $output ='';
      include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
      if ( is_plugin_inactive( 'amp/amp.php' ) ) {
         $output = '<h1 style="    color: #388E3C;
    font-weight: 500;
    margin-top: 38px;"><i class="dashicons dashicons-editor-help" style="
    font-size: 36px;
    margin-right: 20px;
    margin-top: -1px;"></i>Need Help?</h1>
<p style="
    font-family: georgia;
    font-size: 20px;
    font-style: italic;
    margin-bottom: 3px;
    line-height: 1.5;
    margin-top: 11px;
    color: #666;">Were bunch of passionate people that are dedicated towards helping our users. We will be happy to help you!</p>



         ';
      }
      return $output ;
    }

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
        'title' => __( 'Getting Started', 'redux-framework-demo' ),
        'id'    => 'basic',
        'desc'  => __( '<div class="amp-faq">Thank you for using Accelerated Mobile Pages plugin. '. ' ' . sprintf( __( 'We are actively working on updating the plugin. We have built user friendly options which allows you to make changes on your AMP version.', 'redux-framework-demo' ), 'redux-framework-demo' ) . ampforwp_plugin_activation_notice()
			               . '<h2>' . __( 'Here are some quick links to help you get started:', 'redux-framework-demo' ) . '</h2>'
			               . '<p><strong>' . __( '1. <a href="http://ampforwp.com/help/" target="_blank">User Documentation</a>: ', 'redux-framework-demo' ) . '</strong>' . __( 'The AMP for WP plugin is easy to setup but we have some tutorials and guides prepared for you which will help you dive deep with the plugin.' ) . '</p>'
			               . '<p><strong>' . __( '2. <a href="https://ampforwp.com/chat/" target="_blank">Chat with Team AMP</a>: ', 'redux-framework-demo' ) . '</strong>' . __( 'We’re bunch of passionate people that are dedicated towards helping our users. We will be happy to help you!' ) . '</p>'
			               . '<p><strong>' . __( '3. <a href="https://ampforwp.com/help/#extend" target="_blank">Developer Docs</a>: ', 'redux-framework-demo' ) . '</strong>' . __( 'We have created special documentations for developers and semi technical users who are willing to modify the plugin according to their own needs.' ) . '</p>'
			               . '<p><strong>' . __( '4. <a href="admin.php?page=amp_options&tab=14" target="_blank">Fixing AMP Validation Errors</a>: ', 'redux-framework-demo' ) . '</strong>' . __( 'We will personally take care that your website’s AMP version is perfectly validated. We will make sure that your AMP version gets approved and indexed by Google Webmaster Tools properly and we will even keep an eye on AMP updates from Google and implement them into your website.' ) . '</p>'
			               . '<p><strong>' . __( '5. <a href="https://ampforwp.com/help/#support-forum" target="_blank">Community Support Forum</a>: ', 'redux-framework-demo' ) . '</strong>' . __( 'We have a special community support forum where you can ask us questions and get help about your AMP related questions. Delivering a good user experience means alot to us and so we try our best to reply each and every question that gets asked.' ) . '</p>'
			               . '<p><strong>' . __( '6. <a href="https://ampforwp.com/help/#contact" target="_blank">Hire Us / Other queries</a>: ', 'redux-framework-demo' ) . '</strong>' . __( 'We try to answer each and every email, so remember to give us some time. For any other queries, please use the contact form. Please be descriptive as possible.' ) . '</p>'
			               . '<p><strong>' . __( '7. <a href="http://ampforwp.com/new/" target="_blank"> What\'s New in this Version?</a>: ', 'redux-framework-demo' ) . '</strong>' . __( 'If you want to know whats new in the latest version of the plugin, then please use this link. ') . '</p>'

 	   					       . sprintf( __( ' </br /></br />
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

             array(
                'id'       => 'opt-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Logo', 'redux-framework-demo'),
                'subtitle' => __('Upload a logo for the AMP version.', 'redux-framework-demo'),
                'desc'    => __('Recommend logo size is: 190x36', 'redux-framework-demo')
            ),
            array(
                'id'       => 'ampforwp-custom-logo-dimensions',
                'title'    => __('Custom Logo Size', 'redux-framework-demo'),
                'type'     => 'switch',
                'default'  => 0,
            ),
             array(
                'id'       => 'opt-media-width',
                'type'     => 'text',
                'title'    => __('Logo Width', 'redux-framework-demo'),
                'desc'    => __('Default width is 190 pixels', 'redux-framework-demo'),
                'default' => '190',
                'required'=>array('ampforwp-custom-logo-dimensions','=','1'),
            ),
             array(
                'id'       => 'opt-media-height',
                'type'     => 'text',
                'title'    => __('Logo Height', 'redux-framework-demo'),
                'desc'    => __('Default height is 36 pixels', 'redux-framework-demo'),
                'default' => '36',
                'required'=>array('ampforwp-custom-logo-dimensions','=','1'),

            ),
           array(
               'id'        =>'amp-on-off-for-all-pages',
               'type'      => 'switch',
               'title'     => __('AMP on Pages', 'redux-framework-demo'),
               'subtitle'  => __('Enable or Disable AMP on all Pages', 'redux-framework-demo'),
               'default'   => 1,
               'desc'      => __( 'Re-Save permalink if you make changes in this option, please have a look <a href="https://ampforwp.com/flush-rewrite-urls/">here</a> on how to do it', 'redux-framework-demo' ),
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
    // Homepage Section
   Redux::setSection( $opt_name, array(
                'title'      => __( 'Homepage', 'redux-framework-demo' ),
        'id'         => 'amp-homepage-settings',
        'subsection' => true,
        'fields'     => array(
              array(
                        'id'       => 'ampforwp-homepage-on-off-support',
                        'type'     => 'switch',
                        'title'    => __('Homepage Support', 'redux-framework-demo'),
                        'subtitle' => __('Enable/Disable Home page using this switch.', 'redux-framework-demo'),
                        'default'  => '1'
            ),
            array(
                'id'        =>'amp-frontpage-select-option',
                'type'      => 'switch',
                'title'     => __('Front Page', 'redux-framework-demo'),
                'default'   => 0,
                'subtitle'  => __('Custom AMP front page', 'redux-framework-demo'),
                'true'      => 'true',
                'false'     => 'false',
                'required'  => array('ampforwp-homepage-on-off-support','=','1'),
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
            array(
               'id'       => 'ampforwp-title-on-front-page',
               'type'     => 'switch',
               'url'      => true,
               'title'    => __('Title on Static Front Page', 'redux-framework-demo'),
               'subtitle' => __('Enable/Disable display of title on the Static Front Page.', 'redux-framework-demo'),
               'default' => 0,
               'required' => array('amp-frontpage-select-option', '=' , '1'),
            ),
            array(
               'id'       => 'ampforwp-homepage-posts-image-modify-size',
               'type'     => 'switch',
               'title'    => __('Override Homepage Thumbnail Size', 'redux-framework-demo'),
               'default'  => 0,
               'required' => array(
                 array('amp-design-selector','!=',3)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-1-2-width',
               'type'     => 'text',
               'title'    => __('Image Width', 'redux-framework-demo'),
               'subtitle' => __('Defaults to 100', 'redux-framework-demo'),
               'default'  => 100,
               'required' => array(
                 array('amp-design-selector','!=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-1-2-height',
               'type'     => 'text',
               'title'    => __('Image Height', 'redux-framework-demo'),
               'subtitle' => __('Defaults to 75', 'redux-framework-demo'),
               'default'  => 75,
               'required' => array(
                 array('amp-design-selector','!=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-3-width',
               'type'     => 'text',
               'title'    => __('Image Width', 'redux-framework-demo'),
               'subtitle' => __('Defaults to 450', 'redux-framework-demo'),
               'default'  => 330,
               'required' => array(
                 array('amp-design-selector','=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-3-height',
               'type'     => 'text',
               'title'    => __('Image Height', 'redux-framework-demo'),
               'subtitle' => __('Defaults to 270', 'redux-framework-demo'),
               'default'  => 198,
               'required' => array(
                 array('amp-design-selector','=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
            array(
                'id'        =>'amp-on-off-support-for-non-amp-home-page',
                'type'      => 'switch',
                'title'     => __('Non-AMP HomePage link in Header and Logo', 'redux-framework-demo'),
                'subtitle'  => __('If you want users in header to go to non-AMP website from the Header, then you can enable this option', 'redux-framework-demo'),
                'default'   => 0,
            )
          )
        )
      );


    // AMP GTM SECTION
   Redux::setSection( $opt_name,    array(
      	        'title' => __('Analytics'),
      	        // 'icon' => 'el el-th-large',
      			    'desc'  => 'You can either use Google Tag Manager or Other Analytics Providers',
                'subsection' => true,
      	        'fields' =>
      	        	array(


                    array(
                        'id'       => 'amp-analytics-select-option',
                        'type'     => 'select',
                        'title'    => __( 'Analytics Type', 'redux-framework-demo' ),
                        'subtitle' => __( 'Select your Analytics provider.', 'redux-framework-demo' ),
                        'options'  => array(
                            '1' => __('Google Analytics', 'redux-framework-demo' ),
                            '2' => __('Segment Analytics', 'redux-framework-demo' ),
                            '3' => __('Piwik Analytics', 'redux-framework-demo' ),
                            '4' => __('Quantcast Measurement', 'redux-framework-demo' ),
                            '5' => __('comScore', 'redux-framework-demo' ),
                        ),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                        'default'  => '1',
                    ),
                      array(
                          'id'       => 'ga-feild',
                          'type'     => 'text',
                          'title'    => __( 'Google Analytics', 'redux-framework-demo' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '1')
                          ),
                          'subtitle' => __( 'Enter your Google Analytics ID.', 'redux-framework-demo' ),
                          'desc'     => __('Example: UA-XXXXX-Y', 'redux-framework-demo' ),
                          'default'  => 'UA-XXXXX-Y',
                      ),
                      array(
                        'id'       => 'sa-feild',
                        'type'     => 'text',
                        'title'    => __( 'Segment Analytics', 'redux-framework-demo' ),
                        'subtitle' => __( 'Enter your Segment Analytics Key.', 'redux-framework-demo' ),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                          array('amp-analytics-select-option', '=' , '2')
                        ),
                        'default'  => 'SEGMENT-WRITE-KEY',
                      ),
                      array(
                          'id'       => 'pa-feild',
                          'type'     => 'text',
                          'title'    => __( 'Piwik Analytics', 'redux-framework-demo' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '3')
                          ),
                          'desc'     => __( 'Example: https://piwik.example.org/piwik.php?idsite=YOUR_SITE_ID&rec=1&action_name=TITLE&urlref=DOCUMENT_REFERRER&url=CANONICAL_URL&rand=RANDOM', 'redux-framework-demo' ),
                          'subtitle' => __('Enter your Piwik Analytics URL.', 'redux-framework-demo' ),
                          'default'  => '#',
                      ),

                      array(
                        'id'        	=>'amp-quantcast-analytics-code',
                        'type'      	=> 'text',
                        'title'     	=> __('p-code'),
                        'default'   	=> '',
                        'required' => array(
                        array('amp-analytics-select-option', '=' , '4')),
                      ),
                      array(
                        'id'        	=>'amp-comscore-analytics-code-c1',
                        'type'      	=> 'text',
                        'title'     	=> __('C1'),
                        'default'   	=> 1,
                        'required' => array(
                        array('amp-analytics-select-option', '=' , '5')),
                      ),
                      array(
                        'id'        	=>'amp-comscore-analytics-code-c2',
                        'type'      	=> 'text',
                        'title'     	=> __('C2'),
                        'default'   	=> '',
                        'required' => array(
                        array('amp-analytics-select-option', '=' , '5')),
                      ),

                      //GTM
                        array(
                            'id'       => 'amp-use-gtm-option',
                            'type'     => 'switch',
                            'title'    => __( 'Use Google Tag Manager', 'redux-framework-demo' ),
                            'subtitle' => __( 'Select your Analytics provider.', 'redux-framework-demo' ),
                            'default'  => 0,
                        ),
                        array(
              						'id'        	=>'amp-gtm-id',
              						'type'      	=> 'text',
              						'title'     	=> __('Tag Manager ID'),
              						'default'   	=> '',
              						'placeholder'	=> 'GTM-5XXXXXP',
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '1')
                          ),
              					),
              					array(
              						'id'        	=>'amp-gtm-analytics-type',
              						'type'      	=> 'text',
              						'title'     	=> __('Analytics Type'),
              						'default'   	=> '',
              						'placeholder'	=> 'googleanalytics',
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '1')
                          ),
              					),
              					array(
              						'id'        	=>'amp-gtm-analytics-code',
              						'type'      	=> 'text',
              						'title'     	=> __('Analytics ID'),
              						'default'   	=> '',
      						        'placeholder'	=> 'UA-XXXXXX-Y',
                          'required' => array(
                          array('amp-use-gtm-option', '=' , '1')),
              					),

      				    )
          	)
   );


//code for fetching ctegories to show as a list in redux settings
   $categories = get_categories( array(
                                      'orderby' => 'name',
                                      'order'   => 'ASC'
                                      ) );
  $categories_array = array();
   if ( $categories ) :
   foreach ($categories as $cat ) {
     $cat_id = $cat->cat_ID;
     $key = "".$cat_id;
     //building assosiative array of ID-cat_name
     $categories_array[ $key ] = $cat->name;
    }
    endif;
    //End of code for fetching ctegories to show as a list in redux settings

    function ampforwp_get_element_default_color() {
        $default_value = get_option('redux_builder_amp', true);
        $default_value = $default_value['amp-opt-color-rgba-colorscheme']['color'];
        if ( empty( $default_value ) ) {
          $default_value = '#333';
        }
      return $default_value;
    }

    // AMP Design SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Design', 'redux-framework-demo' ),
       'desc'       => __( '
       <br /><a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"  target="_blank"><img class="ampforwp-post-builder-img" src="'.AMPFORWP_IMAGE_DIR . '/amp-post-builder.png" width="489" height="72" /></a>
       '),
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
                    '2' => __('Design Two', 'redux-framework-demo' ),
                    '3' => __('Design Three', 'redux-framework-demo' )
                ),
                'default'  => '2'
            ),
            array(
                'id'        => 'amp-opt-color-rgba-colorscheme',
                'type'      => 'color_rgba',
                'title'     => 'Color Scheme',
                'default'   => array(
                    'color'     => '#F42F42',
                ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                )
              ),
            array(
                'id'        => 'amp-opt-color-rgba-headercolor',
                'type'      => 'color_rgba',
                'title'     => 'Header Background Color',
                'default'   => array(
                    'color'     => '#FFFFFF',
                ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                )
              ),
            array(
                    'id'        => 'amp-opt-color-rgba-font',
                    'type'      => 'color_rgba',
                    'title'     => 'Color Scheme Font Color',
                    'default'   => array(
                        'color'     => '#fff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                 )
              ),
            array(
                    'id'        => 'amp-opt-color-rgba-headerelements',
                    'type'      => 'color_rgba',
                    'title'     => 'Header Elements Color',
                    'default'   => array(
                        'color'     => ampforwp_get_element_default_color(),
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                 )
             ),


          array(
                     'id'       => 'amp-design-3-featured-slider',
                     'type'     => 'switch',
                     'title'    => __( 'Featured Slider', 'redux-framework-demo' ),
                     'required' => array(
                        array('amp-design-selector', '=' , '3')
                     ),
                     'default'  => '1'
                 ),
             array(
                'id'       => 'amp-design-3-category-selector',
                'type'     => 'select',
                'title'    => __( 'Featured Slider Category', 'redux-framework-demo' ),
                'options'  => $categories_array,
                'required' => array(
                  array('amp-design-selector', '=' , '3'),
                  array('amp-design-3-featured-slider', '=' , '1')
                ),
            ),
             array(
                'id'       => 'amp-design-3-search-feature',
                'type'     => 'switch',
                'subtitle' => __('HTTPS is mandatory for Search', 'redux-framework-demo'),
                'title'    => __( 'Search', 'redux-framework-demo' ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'desc'     => __('HTTPS is required for search to work on AMP pages.', 'redux-framework-demo' ),
                'default'  => '0'
            ),

             array(
                'id'       => 'amp-design-2-search-feature',
                'subtitle' => __('HTTPS is mandatory for Search', 'redux-framework-demo'),
                'type'     => 'switch',
                'title'    => __( 'Search', 'redux-framework-demo' ),
                'required' => array(
                  array('amp-design-selector', '=' , '2')
                ),
                'desc'     => __('HTTPS is required for search to work on AMP pages.', 'redux-framework-demo' ),
                'default'  => '0'
            ),

             array(
                'id'       => 'amp-design-1-search-feature',
                'subtitle' => __('HTTPS is mandatory for Search', 'redux-framework-demo'),
                'type'     => 'switch',
                'title'    => __( 'Search', 'redux-framework-demo' ),
                'required' => array(
                  array('amp-design-selector', '=' , '1')
                ),
                'desc'     => __('HTTPS is required for search to work on AMP pages.', 'redux-framework-demo' ),
                'default'  => '0'
            ),

             array(
                'id'       => 'amp-design-3-credit-link',
                'type'     => 'switch',
                'title'    => __( 'Credit link', 'redux-framework-demo' ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'default'  => '1'
            ),
             array(
                'id'       => 'amp-design-3-author-description',
                'type'     => 'switch',
                'title'    => __( 'Author Bio in Single', 'redux-framework-demo' ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'default'  => '1'
            ),
            array(
               'id'       => 'amp-design-3-date-feature',
               'type'     => 'switch',
               'title'    => __( 'Display Date on Single', 'redux-framework-demo' ),
               'required' => array(
                 array('amp-design-selector', '=' , '3')
               ),
               'desc'     => __('Display date along with author and category', 'redux-framework-demo' ),
               'default'  => '0'
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

           array(
                  'id' => 'ampforwp-seo-index-noindex-sub-section',
                  'type' => 'section',
                  'title' => __('Advanced Index & No Index Options', 'redux-framework-demo'),
                  'indent' => true
              ),
           array(
               'id'       => 'ampforwp-robots-archive-sub-pages-sitewide',
               'type'     => 'switch',
               'title'    => __('Archive subpages (sitewide)', 'redux-framework-demo'),
               'desc'  => "Such as /page/2 so on and so forth",
               'default' => 0,
               'on' => 'index',
               'off' => 'noindex'
           ),
           array(
               'id'       => 'ampforwp-robots-archive-author-pages',
               'type'     => 'switch',
               'title'    => __('Author Archive pages', 'redux-framework-demo'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'

           ),
           array(
               'id'       => 'ampforwp-robots-archive-date-pages',
               'type'     => 'switch',
               'title'    => __('Date Archive pages', 'redux-framework-demo'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'

           ),
           array(
               'id'       => 'ampforwp-robots-archive-category-pages',
               'type'     => 'switch',
               'title'    => __('Categories', 'redux-framework-demo'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'
           ),
           array(
               'id'       => 'ampforwp-robots-archive-tag-pages',
               'type'     => 'switch',
               'title'    => __('Tags', 'redux-framework-demo'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'
           ),


       )

  )

  );
    // AMP Menu SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Menu', 'redux-framework-demo' ),
       'desc'       => __( 'Add Menus to your AMP pages by clicking on this <a href="'.trailingslashit(get_admin_url()).'nav-menus.php?action=locations">link</a>'),
       'id'         => 'amp-menus',
       'subsection' => true,
       'fields' => array(

            array(
                'id'       => 'ampforwp-auto-amp-menu-link',
                'type'     => 'switch',
                'title'    => __('Auto Add AMP in Menu URL', 'redux-framework-demo'),
                'subtitle' => __('Automatically add <code>AMP</code> at the end of menu url', 'redux-framework-demo'),
                'true'      => 'true',
                'false'     => 'false',
                'default'   => 0
            ),
        )
       )

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
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'id'        => 'enable-amp-ads-text-feild-slot-1',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'redux-framework-demo'),
                        'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'redux-framework-demo'),
                        'default'   => '',
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
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'id'       => 'enable-amp-ads-text-feild-slot-2',
                        'type'     => 'text',
                        'title'    => __('Data AD Slot', 'redux-framework-demo'),
                        'subtitle'     => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'redux-framework-demo'),
                        'default'   => '',
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
                        'default'   => '',
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
	        array(
    		        'id'       => 'ampforwp-number-of-related-posts',
    		        'type'     => 'text',
    		        'title'    => __('Number of Related Post', 'redux-framework-demo'),
                'subtitle' => __('Type the number of related posts you need, Eg : 2', 'redux-framework-demo'),
    		        'validate' => 'numeric',
                'default'  => '3',
	        ),
        ),

    ) );

    // Social Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social Share', 'redux-framework-demo' ),
        'id'         => 'amp-social',
        'desc'      => 'enable social share and your social profiels here',
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
          array(
              'id'        =>  'enable-single-twitter-share-handle',
              'type'      =>  'text',
              'title'     =>  __('Twitter Handle', 'redux-framework-demo'),
              'required'  => array('enable-single-twitter-share', '=' , '1'),
              'placeholder'  => 'Eg: @xyx',
              'default'   =>  '',
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
          array(
       'id' => 'social-media-profiles-subsection',
       'type' => 'section',
       'title' => __('Social Media Profiles (Design #3)', 'redux-framework-demo'),
       'subtitle' => __('Please enter your personal/organizational social media profiles here', 'redux-framework-demo'),
       'indent' => true,
       'required' => array(
                array('amp-design-selector', '=' , '3')
        ),
     ),
          //#1
          array(
              'id'        =>  'enable-single-twittter-profile',
              'type'      =>  'switch',
              'title'     =>  __('Twittter ', 'redux-framework-demo'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-twittter-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Twittter URL', 'redux-framework-demo'),
              'default'   =>  '#',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-twittter-profile', '=' , '1')
              ),
          ),
          //#2
          array(
              'id'        =>  'enable-single-facebook-profile',
              'type'      =>  'switch',
              'title'     =>  __('Facebook ', 'redux-framework-demo'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-facebook-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Facebook URL', 'redux-framework-demo'),
              'default'   =>  '#',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-facebook-profile', '=' , '1')
              ),
          ),
          //#3
          array(
              'id'        =>  'enable-single-pintrest-profile',
              'type'      =>  'switch',
              'title'     =>  __('Pintrest ', 'redux-framework-demo'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-pintrest-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Pintrest URL', 'redux-framework-demo'),
              'default'   =>  '#',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-pintrest-profile', '=' , '1')
              ),
          ),
          //#4
          array(
              'id'        =>  'enable-single-google-plus-profile',
              'type'      =>  'switch',
              'title'     =>  __('Google Plus ', 'redux-framework-demo'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-google-plus-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Google Plus URL', 'redux-framework-demo'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-google-plus-profile', '=' , '1')
              ),
          ),
          //#5
          array(
              'id'        =>  'enable-single-linkdin-profile',
              'type'      =>  'switch',
              'title'     =>  __('Linkdin ', 'redux-framework-demo'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-linkdin-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Linkdin URL', 'redux-framework-demo'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-linkdin-profile', '=' , '1')
              ),
          ),
          //#6
          array(
              'id'        =>  'enable-single-youtube-profile',
              'type'      =>  'switch',
              'title'     =>  __('Youtube ', 'redux-framework-demo'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-youtube-profile-url',
              'type'      =>  'text',
              'default'   =>  '#',
              'title'     =>  __('Youtube URL', 'redux-framework-demo'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-youtube-profile', '=' , '1')
              ),
          ),
          //#7
          array(
              'id'        =>  'enable-single-instagram-profile',
              'type'      =>  'switch',
              'title'     =>  __('Instagram ', 'redux-framework-demo'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-instagram-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  __('Instagram URL', 'redux-framework-demo'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-instagram-profile', '=' , '1')
              ),
          ),
          //#8
          array(
              'id'        =>  'enable-single-VKontakte-profile',
              'type'      =>  'switch',
              'title'     =>  __('VKontakte ', 'redux-framework-demo'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-VKontakte-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  __('VKontakte URL', 'redux-framework-demo'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-VKontakte-profile', '=' , '1')
              ),
          ),
          //#9
          //removed whatsapp
          //#10
          array(
              'id'        =>  'enable-single-reddit-profile',
              'type'      =>  'switch',
              'title'     =>  __('Reddit', 'redux-framework-demo'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-reddit-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Reddit URL', 'redux-framework-demo'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-reddit-profile', '=' , '1')
              ),
          ),
          //#11
          array(
              'id'        =>  'enable-single-snapchat-profile',
              'type'      =>  'switch',
              'title'     =>  __('Snapchat ', 'redux-framework-demo'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-snapchat-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Snapchat URL', 'redux-framework-demo'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-snapchat-profile', '=' , '1')
              ),
          ),
          //#12
          array(
              'id'        =>  'enable-single-Tumblr-profile',
              'type'      =>  'switch',
              'title'     =>  __('Tumblr', 'redux-framework-demo'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-Tumblr-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Tumblr URL', 'redux-framework-demo'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-Tumblr-profile', '=' , '1')
              ),
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
            'default'  => '700'
            ),
            array(
              'id'       => 'amp-structured-data-placeholder-image-height',
              'title'    => __('Default Post Image Height', 'redux-framework-demo'),
              'type'     => 'text',
              'placeholder' => '350',
              'subtitle' => 'Please don\'t add "PX" in the image size.',
              'default'  => '550'
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
                       'id'       => 'amp-translator-show-more-posts-text',
                       'type'     => 'text',
                       'title'    => __('Show more Posts', 'redux-framework-demo'),
                       'default'  => 'Show more Posts',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-show-previous-posts-text',
                       'type'     => 'text',
                       'title'    => __('Show previous Posts', 'redux-framework-demo'),
                       'default'  => 'Show previous Posts',
                       'placeholder'=>'write here'
                   ),
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
                       'id'       => 'amp-translator-published-by',
                       'type'     => 'text',
                       'title'    => __('Published by', 'redux-framework-demo'),
                       'default'  => 'Published by',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-in-designthree',
                       'type'     => 'text',
                       'title'    => __('in', 'redux-framework-demo'),
                       'default'  => 'in',
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
                   array(
                       'id'       => 'amp-translator-archive-cat-text',
                       'type'     => 'text',
                       'title'    => __('Category (archive title)', 'redux-framework-demo'),
                       'default'  => 'Category: ',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-archive-tag-text',
                       'type'     => 'text',
                       'title'    => __('Tag (archive title)', 'redux-framework-demo'),
                       'default'  => 'Tag: ',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-show-more-text',
                       'type'     => 'text',
                       'title'    => __('View More Posts (Widget Button)', 'redux-framework-demo'),
                       'default'  => 'View More Posts',
                       'placeholder'=>'write here'
                   ),
                    array(
                       'id'       => 'amp-translator-next-read-text',
                       'type'     => 'text',
                       'title'    => __('Next Read', 'redux-framework-demo'),
                       'default'  => 'Next Read: ',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-search-text',
                       'type'     => 'text',
                       'title'    => __(' You searched for: ', 'redux-framework-demo'),
                       'default'  => ' You searched for: ',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id'       => 'amp-translator-search-no-found',
                       'type'     => 'text',
                       'title'    => __(' It seems we can\'t find what you\'re looking for. ', 'redux-framework-demo'),
                       'default'  => ' It seems we can\'t find what you\'re looking for. ',
                       'placeholder'=>'write here'
                   ),
                   array(
                       'id' => 'design-3-search-subsection',
                       'type' => 'section',
                       'title' => __('Search bar Translation Text', 'redux-framework-demo'),
                       'indent' => true,
                   ),
                   array(
                      'id'       => 'ampforwp-search-placeholder',
                      'type'     => 'text',
                      'title'    => __('Type Here', 'redux-framework-demo'),
                      'default'  => 'Type Here',
                      'desc' => 'This is the text that gets shown in for Search Box',
                      'placeholder'=>'write here',

                  ),
                  array(
                     'id'       => 'ampforwp-search-label',
                     'type'     => 'text',
                     'title'    => __('Type your search query and hit enter', 'redux-framework-demo'),
                     'desc' => 'This is the text that gets shown above Search Box',
                     'default'  => 'Type your search query and hit enter: ',
                     'placeholder'=>'write here',

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


// Comments
 Redux::setSection( $opt_name, array(
    'title'      => __( 'Comments', 'redux-framework-demo' ),
//    'desc'       => '<a href="https://github.com/disqus/disqus-install-examples/tree/master/google-amp"> Link to Official Disqus documentation. </a>',
    'id'         => 'disqus-comments',
    'subsection' => true,
    'fields'     => array(
                     array(
                         'id'       => 'ampforwp-disqus-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Disqus comments Support', 'redux-framework-demo'),
                         'subtitle' => __('Enable/Disable Disqus comments using this switch.', 'redux-framework-demo'),
                         'default'  => 0
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-comments-name',
                         'type'     => 'text',
                         'title'    => __('Disqus Name', 'redux-framework-demo'),
                         'subtitle' => __('Eg: https://xyz.disqus.com', 'redux-framework-demo'),
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                         'default'  => ''
                     ),

                     array(
                         'id'       => 'ampforwp-disqus-host-position',
                         'type'     => 'switch',
                         'title'    => __('Host Disqus Comments through AMPforWP Servers', 'redux-framework-demo'),
                         'subtitle' => __('Use AMPforWP secure servers to serve Comments file. Recommended if your site is non HTTPS', 'redux-framework-demo'),
                         'default'  => 1,
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                     ),

                     array(
                         'id'       => 'ampforwp-disqus-host-file',
                         'type'     => 'text',
                         'title'    => __('Disqus Host File', 'redux-framework-demo'),
                         'subtitle' => __('<a href="https://ampforwp.com/host-disqus-comments/"> Click here to know, How to Setup Disqus Host file on your servers </a>', 'redux-framework-demo'),
                         'placeholder' => 'https://comments.example.com/disqus.php',
                         'required' => array('ampforwp-disqus-host-position', '=' , '0'),
                     ),
                     array(
                         'id'       => 'ampforwp-number-of-comments',
                         'type'     => 'text',
                         'desc'     => 'This refers to the normal comments',
                         'title'    => __('No of Comments', 'redux-framework-demo'),
                         'default'  => 10,
                         'required' => array('ampforwp-disqus-comments-support' , '=' , 0)
                     ),
                 )
 ) );


// Advance Settings SECTION
Redux::setSection( $opt_name, array(
   'title'      => __( 'Advance Settings', 'redux-framework-demo' ),
   'desc'       => __( 'This section has Advance settings'),
   'id'         => 'amp-advance',
   'subsection' => true,
   'fields'     => array(

                   /* array(
                        'id'       => 'ampforwp-homepage-on-off-support',
                        'type'     => 'switch',
                        'title'    => __('Homepage Support', 'redux-framework-demo'),
                        'subtitle' => __('Enable/Disable Home page using this switch.', 'redux-framework-demo'),
                        'default'  => '1'
                    ),*/
                    array(
                        'id'       => 'ampforwp-archive-support',
                        'type'     => 'switch',
                        'title'    => __('Archive page Support', 'redux-framework-demo'),
                        'subtitle' => __('Enable/Disable Archive pages using this switch.', 'redux-framework-demo'),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'amp-mobile-redirection',
                        'type'     => 'switch',
                        'title'    => __('Mobile Redirection', 'redux-framework-demo'),
                        'subtitle' => __('
                        Enable AMP for your mobile users. Give your visitors a Faster mobile User Experience.','ampforwp'),
                        'default' => 0,

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
                    array(
                        'id'       => 'amp-footer-link-non-amp-page',
                        'type'     => 'switch',
                        'title'    => __('Link to Non-AMP page in Footer', 'redux-framework-demo'),
                        'subtitle' => __('Enable / Disable Link to Non-AMP page in the footer', 'redux-framework-demo'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 1
                    ),
                    array(
                        'id'       => 'amp-header-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => __('Enter HTML in Header', 'redux-framework-demo'),
                        'subtitle' => __('please enter markup that is AMP validated', 'redux-framework-demo'),
                        'desc' => __('check your markup here (enter markup between HEAD tag) : https://validator.ampproject.org/', 'redux-framework-demo'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'amp-footer-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => __('Enter HTML in Footer', 'redux-framework-demo'),
                        'subtitle' => __('please enter markup that is AMP validated', 'redux-framework-demo'),
                        'desc' => __('check your markup here (enter markup between BODY tag) : https://validator.ampproject.org/',
                        'redux-framework-demo'),
                        'default'   => ''
                    ),

   ),

) );


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
        'icon' => 'el el-puzzle',
    ) );



// Priority Support
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Fix AMP Errors', 'redux-framework-demo' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-go-premium-support',
        'subsection' => false,
        'desc' => '        <a href="http://ampforwp.com/priority-support/#utm_source=options-panel&utm_medium=extension-tab_priority_support&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-support-banner" src="'.AMPFORWP_IMAGE_DIR . '/priority-support-banner.png" width="345" height="500" /></a>',
        'icon' => 'el el-hand-right',
    ) );
/*
* <--- END SECTIONS
*/