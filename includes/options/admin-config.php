<?php
// Admin Panel Options
if ( ! class_exists( 'Redux' ) ) {
    return;
}
// Option name where all the Redux data is stored.
$opt_name = "redux_builder_amp";
$comment_AD_URL = "http://ampforwp.com/amp-comments/#utm_source=options-panel&utm_medium=comments-tab&utm_campaign=AMP%20Plugin";
$cta_AD_URL = "http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=call-to-action_banner_in_notification_bar&utm_campaign=AMP%20Plugin";
$comment_desc = '<a href="'.$comment_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/comments-banner.png" width="560" height="85" /></a>';
$cta_desc = '<a href="'.$cta_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/cta-banner.png" width="560" height="85" /></a>';
$extension_listing = '
<div class="extension_listing">
<p style="font-size:13px">Take your AMP to the next level with these premium extensions which gives you advanced features.</p>
<ul>
    <li class="first"><a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=extension-tab_advanced-amp-ads&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/click.png" /></div>
        <div class="extension_desc">
        <h2>Advanced AMP ADS</h2>
        <p>Add Advertisement directly in the content</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/contact-form-7/#utm_source=options-panel&utm_medium=extension-tab_cf7&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/cf7.png" /></div>
        <div class="extension_desc">
        <h2>Contact Form 7</h2>
        <p>Add Contact Us Form in AMP.</p>
        <div class="extension_btn">From: $39</div>
        </div>
    </a></li>
    <li class="first"><a href="http://ampforwp.com/opt-in-forms/#utm_source=options-panel&utm_medium=extension-tab_opt-in-forms&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/email.png" /></div>
        <div class="extension_desc">
        <h2>Email Opt-in Forms</h2>
        <p>Capture Leads with Email Subscription.</p>
        <div class="extension_btn">From: $79</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=extension-tab_amp-cta&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/mac-click.png" /></div>
        <div class="extension_desc">
        <h2>Call To Action (CTA)</h2>
        <p>Higher Visibility & More Conversions</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="first"><a href="http://ampforwp.com/custom-post-type/#utm_source=options-panel&utm_medium=extension-tab_custom-post-type&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/comments.png" /></div>
        <div class="extension_desc">
        <h2>Custom Post Type</h2>
        <p>Enable Custom Post type support in AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>

    <li class="second"><a href="http://ampforwp.com/acf-amp/#utm_source=options-panel&utm_medium=extension-tab_opt-in-forms&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/acf.png" /></div>
        <div class="extension_desc">
        <h2>Advanced Custom Fields</h2>
        <p>Easily add ACF support in AMP.</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="first"><a href="http://ampforwp.com/doubleclick-for-publishers/#utm_source=options-panel&utm_medium=extension-tab_doubleclick&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/dfp.png" /></div>
        <div class="extension_desc">
        <h2>DoubleClick For Publishers</h2>
        <p>Enable DFP Support for AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>


    <li class="second"><a href="http://ampforwp.com/amp-ratings/#utm_source=options-panel&utm_medium=extension-tab_amp-ratings&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/star.png" /></div>
        <div class="extension_desc">
        <h2>Star Ratings</h2>
        <p>Star Review Ratings for AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>
    <li class="first"><a href="https://wordpress.org/plugins/amp-woocommerce/" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/woo.png" /></div>
        <div class="extension_desc">
        <h2>AMP WooCommerce</h2>
        <p>Add WooCommerce in AMP in two clicks.</p>
        <div class="extension_btn">FREE</div>
        </div>
    </a></li>

    <li class="second"><a href="http://ampforwp.com/amp-category-base-remove-support/#utm_source=options-panel&utm_medium=extension-tab_amp-category-base-remove-support&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/puzzel.png" /></div>
        <div class="extension_desc">
        <h2>Category Base Removal</h2>
        <p>Remove Category Base Support in AMP</p>
        <div class="extension_btn">FREE</div>
        </div>
    </a></li>
    <li class="first"><a href="https://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=extension-tab_amp-more-comingsoon&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/comments.png" /></div>
        <div class="extension_desc">
        <h2>More Coming Soon</h2>
        <p>Improvements in progress.</p>
        </div>
    </a></li>


</ul>
</div>
';


$gettingstarted_extension_listing = '
<div class="extension_listing getting_started_listing">
<p style="font-size:13px">Take your AMP to the next level with these premium extensions which gives you advanced features.</p>
<ul>
    <li class="first"><a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=gettingstarted-amp-ads&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/click.png" /></div>
        <div class="extension_desc">
        <h2>Advanced AMP ADS</h2>
        <p>Add Advertisement directly in the content</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/opt-in-forms/#utm_source=options-panel&utm_medium=gettingstarted_opt-in-forms&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/email.png" /></div>
        <div class="extension_desc">
        <h2>Email Opt-in Forms</h2>
        <p>Capture Leads with Email Subscription.</p>
        <div class="extension_btn">From: $79</div>
        </div>
    </a></li>
    <li class="first"><a href="http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=gettingstarted_amp-cta&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/mac-click.png" /></div>
        <div class="extension_desc">
        <h2>Call To Action (CTA)</h2>
        <p>Higher Visibility & More Conversions</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/custom-post-type/#utm_source=options-panel&utm_medium=gettingstarted_custom-post-type&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/comments.png" /></div>
        <div class="extension_desc">
        <h2>Custom Post Type</h2>
        <p>Enable Custom Post type support in AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>

    <li class="first"><a href="http://ampforwp.com/acf-amp/#utm_source=options-panel&utm_medium=gettingstarted_acf&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/acf.png" /></div>
        <div class="extension_desc">
        <h2>Advanced Custom Fields</h2>
        <p>Easily add ACF support in AMP.</p>
        <div class="extension_btn">From: $29</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/doubleclick-for-publishers/#utm_source=options-panel&utm_medium=gettingstarted_doubleclick&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/dfp.png" /></div>
        <div class="extension_desc">
        <h2>DoubleClick For Publishers</h2>
        <p>Enable DFP Support for AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>


    <li class="first"><a href="http://ampforwp.com/amp-ratings/#utm_source=options-panel&utm_medium=gettingstarted_amp-ratings&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/star.png" /></div>
        <div class="extension_desc">
        <h2>Star Ratings</h2>
        <p>Star Review Ratings for AMP.</p>
        <div class="extension_btn">From: $19</div>
        </div>
    </a></li>
    <li class="second"><a href="https://wordpress.org/plugins/amp-woocommerce/" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/woo.png" /></div>
        <div class="extension_desc">
        <h2>AMP WooCommerce</h2>
        <p>Add WooCommerce in AMP in two clicks.</p>
        <div class="extension_btn">FREE</div>
        </div>
    </a></li>

    <li class="first"><a href="http://ampforwp.com/amp-category-base-remove-support/#utm_source=options-panel&utm_medium=gettingstarted_amp-category-base-remove-support&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/puzzel.png" /></div>
        <div class="extension_desc">
        <h2>Category Base Removal</h2>
        <p>Remove Category Base Support in AMP</p>
        <div class="extension_btn">FREE</div>
        </div>
    </a></li>
    <li class="second"><a href="https://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=gettingstarted_amp-more-comingsoon&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/comments.png" /></div>
        <div class="extension_desc">
        <h2>More Coming Soon</h2>
        <p>Improvements in progress.</p>
        </div>
    </a></li>


</ul>
</div>
';






$single_extension_listing = '
<div class="extension_listing single_ex_listing">
<h3>Increase the Revenue, Leads and Conversation with these Handpicked extensions</h3>
<ul>
    <li class="first"><a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=gettingstarted-amp-ads&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/click.png" /></div>
        <div class="extension_desc">
        <h2>Advanced AMP ADS</h2>
        <p>Add Advertisement directly in the content</p>
        <div class="extension_btn">View Details</div>
        </div>
    </a></li>
    <li class="second"><a href="http://ampforwp.com/opt-in-forms/#utm_source=options-panel&utm_medium=gettingstarted_opt-in-forms&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/email.png" /></div>
        <div class="extension_desc">
        <h2>Email Opt-in Forms</h2>
        <p>Capture Leads with Email Subscription.</p>
        <div class="extension_btn">View Details</div>
        </div>
    </a></li>
    <li class="first"><a href="http://ampforwp.com/call-to-action/#utm_source=options-panel&utm_medium=gettingstarted_amp-cta&utm_campaign=AMP%20Plugin" target="_blank">
        <div class="align_left"><img src="'.AMPFORWP_IMAGE_DIR . '/mac-click.png" /></div>
        <div class="extension_desc">
        <h2>Call To Action (CTA)</h2>
        <p>Higher Visibility & More Conversions</p>
        <div class="extension_btn">View Details</div>
        </div>
    </a></li>
 </ul>
</div>
';

// All the possible arguments for Redux.
//$amp_redux_header = '<span id="name"><span style="color: #4dbefa;">U</span>ltimate <span style="color: #4dbefa;">W</span>idgets</span>';

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'              => 'redux_builder_amp', // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'          =>  __( 'AMPforWP Options','accelerated-mobile-pages' ), // Name that appears at the top of your panel
    'menu_type'             => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'        => true, // Show the sections below the admin menu item or not
    'menu_title'            => __( 'AMP', 'accelerated-mobile-pages' ),
    'page_title'            => __('Accelerated Mobile Pages Options','accelerated-mobile-pages'),
    'display_version'       => AMPFORWP_VERSION,
    'update_notice'         => false,
    'intro_text'            => '<a href="http://ampforwp.com/tutorials/#utm_source=options-panel&utm_medium=tuts_link_btn&utm_campaign=AMP%20Plugin" target="_blank">'.__('View Documentation','accelerated-mobile-pages').'</a> | <a href="http://ampforwp.com/support/#utm_source=options-panel&utm_medium=contact_link_btn&utm_campaign=AMP%20Plugin" target="_blank">'.__('Contact','accelerated-mobile-pages').'</a> <a class="premium_features_btn" href="http://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=view_premium_features_btn&utm_campaign=AMP%20Plugin">VIEW PREMIUM FEATURES</a> ',
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
        'title' => __('Visit us on GitHub','accelerated-mobile-pages'),
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );


Redux::setArgs( "redux_builder_amp", $args );




    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'accelerated-mobile-pages' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'accelerated-mobile-pages' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'accelerated-mobile-pages' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'accelerated-mobile-pages' )
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
    margin-top: -1px;"></i>'.__('Need Help?','accelerated-mobile-pages').'</h1>
<p style="
    font-family: georgia;
    font-size: 20px;
    font-style: italic;
    margin-bottom: 3px;
    line-height: 1.5;
    margin-top: 11px;
    color: #666;">'.__('Were bunch of passionate people that are dedicated towards helping our users. We will be happy to help you!').'</p>';
      }
      return $output ;
    }

    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Basic Field', 'accelerated-mobile-pages' ),
        'id'     => 'basic',
        'desc'   => __( 'Basic field with no subsections.', 'accelerated-mobile-pages' ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'opt-blank',
                'title'    => __( 'Example Text', 'accelerated-mobile-pages' ),
                'desc'     => __( 'Example description.', 'accelerated-mobile-pages' ),
                'subtitle' => __( 'Example subtitle.', 'accelerated-mobile-pages' ),
            )
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Getting Started', 'accelerated-mobile-pages' ),
        'id'    => 'basic',
        'desc'  => __( '<div class="amp-faq">Thank you for using Accelerated Mobile Pages plugin. '. ' ' .

                      sprintf( __( '  <h2 style="    width: 150px;
    float: right;
    padding: 15px 20px;
    border: 1px solid #ddd;
    font-size: 13px;
    line-height: 20px;"><a href="https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages?rate=5#postform">Like this plugin? Support us by leaving a 5 Star Rating</a></h2>We are actively working on updating the plugin. We have built user friendly options which allows you to make changes on your AMP version.', 'accelerated-mobile-pages' ), 'accelerated-mobile-pages' ) . ampforwp_plugin_activation_notice()
			               . '<h2>' . __( 'Here are some quick links to help you get started:', 'accelerated-mobile-pages' ) . '</h2>'
			               . '<p><strong>' . __( '1. <a href="http://ampforwp.com/help/" target="_blank">User Documentation</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'The AMP for WP plugin is easy to setup but we have some tutorials and guides prepared for you which will help you dive deep with the plugin.' ) . '</p>'
			               . '<p><strong>' . __( '2. <a href="https://ampforwp.com/tutorials/" target="_blank">Tutorials</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We’re bunch of passionate people that are dedicated towards helping our users. We have prepared bunch of tutorials for you' ) . '</p>'
			               . '<p><strong>' . __( '3. <a href="https://ampforwp.com/help/#extend" target="_blank">Developer Docs</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We have created special documentations for developers and semi technical users who are willing to modify the plugin according to their own needs.' ) . '</p>'
			               . '<p><strong>' . __( '4. <a href="https://ampforwp.com/priority-support/" target="_blank">Fixing AMP Validation Errors</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We will personally take care that your website’s AMP version is perfectly validated. We will make sure that your AMP version gets approved and indexed by Google Webmaster Tools properly and we will even keep an eye on AMP updates from Google and implement them into your website.' ) . '</p>'
			               . '<p><strong>' . __( '5. <a href="https://ampforwp.com/help/#support-forum" target="_blank">Community Support Forum</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We have a special community support forum where you can ask us questions and get help about your AMP related questions. Delivering a good user experience means alot to us and so we try our best to reply each and every question that gets asked.' ) . '</p>'
			               . '<p><strong>' . __( '6. <a href="https://ampforwp.com/help/#contact" target="_blank">Hire Us / Other queries</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'We try to answer each and every email, so remember to give us some time. For any other queries, please use the contact form. Please be descriptive as possible.' ) . '</p>'
			               . '<p><strong>' . __( '7. <a href="http://ampforwp.com/new/" target="_blank"> What\'s New in this Version?</a>: ', 'accelerated-mobile-pages' ) . '</strong>' . __( 'If you want to know whats new in the latest version of the plugin, then please use this link. ') . '</p>'

						         . '</p></div>
                                 <br /><p><h3>Take AMP to the Next Level with Premium Extensions</h3></p>
                                 ' .$gettingstarted_extension_listing

				 , 'accelerated-mobile-pages' ),
        'icon'  => 'el el-home'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'General', 'accelerated-mobile-pages' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'accelerated-mobile-pages' ) . '<a href="http://docs.reduxframework.com/core/fields/text/" target="_blank">http://docs.reduxframework.com/core/fields/text/</a>',
        'id'         => 'opt-text-subsection',
        'subsection' => true,
        'fields'     => array(

             array(
                'id'       => 'opt-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => __('Logo', 'accelerated-mobile-pages'),
                'subtitle' => __('Upload a logo for the AMP version.', 'accelerated-mobile-pages'),
                'desc'    => __('Recommend logo size is: 190x36', 'accelerated-mobile-pages')
            ),
            array(
                'id'       => 'ampforwp-custom-logo-dimensions',
                'title'    => __('Custom Logo Size', 'accelerated-mobile-pages'),
                'type'     => 'switch',
                'default'  => 0,
            ),
             array(
                'id'       => 'opt-media-width',
                'type'     => 'text',
                'title'    => __('Logo Width', 'accelerated-mobile-pages'),
                'desc'    => __('Default width is 190 pixels', 'accelerated-mobile-pages'),
                'default' => '190',
                'required'=>array('ampforwp-custom-logo-dimensions','=','1'),
            ),
             array(
                'id'       => 'opt-media-height',
                'type'     => 'text',
                'title'    => __('Logo Height', 'accelerated-mobile-pages'),
                'desc'    => __('Default height is 36 pixels', 'accelerated-mobile-pages'),
                'default' => '36',
                'required'=>array('ampforwp-custom-logo-dimensions','=','1'),

            ),
           array(
               'id'        =>'amp-on-off-for-all-pages',
               'type'      => 'switch',
               'title'     => __('AMP on Pages', 'accelerated-mobile-pages'),
               'subtitle'  => __('Enable or Disable AMP on all Pages', 'accelerated-mobile-pages'),
               'default'   => 1,
               'desc'      => __( 'Re-Save permalink if you make changes in this option, please have a look <a href="https://ampforwp.com/flush-rewrite-urls/">here</a> on how to do it', 'accelerated-mobile-pages' ),
            ),


          //  array(
          //      'id'       => 'amp-ad-places',
          //      'type'     => 'select',
          //      'title'    => __( 'Ads on Page', 'accelerated-mobile-pages' ),
          //      'subtitle' => __( 'select your preferece for Ads on Post Types', 'accelerated-mobile-pages' ),
          //      'options'  => array(
          //          '1' => __('Only on Posts', 'accelerated-mobile-pages' ),
          //          '2' => __('Only on Pages', 'accelerated-mobile-pages' ),
          //          '3' => __('on Both', 'accelerated-mobile-pages' ),
          //      ),
          //      'default'  => '3'
          //  ),

      )
    ) );//END
    // Homepage Section
   Redux::setSection( $opt_name, array(
                'title'      => __( 'Homepage', 'accelerated-mobile-pages' ),
        'id'         => 'amp-homepage-settings',
        'subsection' => true,
        'fields'     => array(
              array(
                        'id'       => 'ampforwp-homepage-on-off-support',
                        'type'     => 'switch',
                        'title'    => __('Homepage Support', 'accelerated-mobile-pages'),
                        'subtitle' => __('Enable/Disable Home page using this switch.', 'accelerated-mobile-pages'),
                        'default'  => '1'
            ),
            array(
                'id'        =>'amp-frontpage-select-option',
                'type'      => 'switch',
                'title'     => __('Front Page', 'accelerated-mobile-pages'),
                'default'   => 0,
                'subtitle'  => __('Custom AMP front page', 'accelerated-mobile-pages'),
                'true'      => 'true',
                'false'     => 'false',
                'required'  => array('ampforwp-homepage-on-off-support','=','1'),
                'desc'      => __( 'Re-Save permalink if front page or custom post page\'s pagination is not working. Please have a look <a href="https://ampforwp.com/flush-rewrite-urls/">here</a> on how to do it', 'accelerated-mobile-pages' ),
            ),
            array(
                'id'       => 'amp-frontpage-select-option-pages',
                'type'     => 'select',
                'title'    => __('Select Page as Front Page', 'accelerated-mobile-pages'),
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
               'title'    => __('Title on Static Front Page', 'accelerated-mobile-pages'),
               'subtitle' => __('Enable/Disable display of title on the Static Front Page.', 'accelerated-mobile-pages'),
               'default' => 0,
               'required' => array('amp-frontpage-select-option', '=' , '1'),
            ),
            array(
               'id'       => 'ampforwp-homepage-posts-image-modify-size',
               'type'     => 'switch',
               'title'    => __('Override Homepage Thumbnail Size', 'accelerated-mobile-pages'),
               'default'  => 0,
               'required' => array(
                 array('amp-design-selector','!=',3)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-1-2-width',
               'type'     => 'text',
               'title'    => __('Image Width', 'accelerated-mobile-pages'),
               'subtitle' => __('Defaults to 100', 'accelerated-mobile-pages'),
               'default'  => 100,
               'required' => array(
                 array('amp-design-selector','!=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-1-2-height',
               'type'     => 'text',
               'title'    => __('Image Height', 'accelerated-mobile-pages'),
               'subtitle' => __('Defaults to 75', 'accelerated-mobile-pages'),
               'default'  => 75,
               'required' => array(
                 array('amp-design-selector','!=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-3-width',
               'type'     => 'text',
               'title'    => __('Image Width', 'accelerated-mobile-pages'),
               'subtitle' => __('Defaults to 450', 'accelerated-mobile-pages'),
               'default'  => 330,
               'required' => array(
                 array('amp-design-selector','=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
           array(
               'id'       => 'ampforwp-homepage-posts-design-3-height',
               'type'     => 'text',
               'title'    => __('Image Height', 'accelerated-mobile-pages'),
               'subtitle' => __('Defaults to 270', 'accelerated-mobile-pages'),
               'default'  => 198,
               'required' => array(
                 array('amp-design-selector','=',3),
                 array('ampforwp-homepage-posts-image-modify-size','=',1)
               )
            ),
            array(
                'id'        =>'amp-on-off-support-for-non-amp-home-page',
                'type'      => 'switch',
                'title'     => __('Non-AMP HomePage link in Header and Logo', 'accelerated-mobile-pages'),
                'subtitle'  => __('If you want users in header to go to non-AMP website from the Header, then you can enable this option', 'accelerated-mobile-pages'),
                'default'   => 0,
            )
          )
        )
      );

   // AMP Content Page Builder SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Page Builder', 'accelerated-mobile-pages' ),
       'desc'       => __( 'With AMP Content Builder, you can easily build landing pages for AMP from the widgets area. <a href="http://ampforwp.com/tutorials/page-builder">(Need Help?)</a>' , 'accelerated-mobile-pages'),
       'id'         => 'amp-content-builder',
       'class' => 'amp_content_builder',
       'subsection' => true,
       'fields' => array(

            array(
                'id'       => 'ampforwp-content-builder',
                'type'     => 'switch',
                'title'    => __('Enable Page Builder for AMP', 'accelerated-mobile-pages'),
                'subtitle' => __('Build AMP Landing pages in minutes.', 'accelerated-mobile-pages'),
                'true'      => 'true',
                'desc' => '<div style="    background: #FFF9C4;
    display: inline-block;
    padding: 12px;
    margin-top: 12px;
    left: 0;
    line-height: 1.6;"><b>Hello!</b> First time here? <br /> <a href="https://ampforwp.com/tutorials/page-builder/" target="_blank">Learn how to use this Feature</a></div>',
                'false'     => 'false',
                'default'   => 1
            ),
        )
       )

   ) ;



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
       'title'      => __( 'Design', 'accelerated-mobile-pages' ),
       'desc'       => '
       <br /><a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"  target="_blank"><img class="ampforwp-post-builder-img" src="'.AMPFORWP_IMAGE_DIR . '/amp-post-builder.png" width="489" height="72" /></a>',
       'id'         => 'amp-design',
       'subsection' => true,
        'fields'     => array(

            $fields =  array(
                'id'       => 'amp-design-selector',
                'type'     => 'select',
                'title'    => __( 'Design Selector', 'accelerated-mobile-pages' ),
                'subtitle' => __( 'Select your design.', 'accelerated-mobile-pages' ),
                'options'  => array(
                    '1' => __('Design One', 'accelerated-mobile-pages' ),
                    '2' => __('Design Two', 'accelerated-mobile-pages' ),
                    '3' => __('Design Three', 'accelerated-mobile-pages' )
                ),
                'default'  => '2'
            ),

            array(
                'id'        => 'amp-opt-sticky-head',
                'type'      => 'switch',
                'title'     => __('Make Header UnSticky','accelerated-mobile-pages'), 
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'desc'     => __('Turning it ON will remove the sticky head from the design.', 'accelerated-mobile-pages' ),
                'default'  => '0'
              ),

            array(
                'id'        => 'amp-opt-color-rgba-colorscheme',
                'type'      => 'color_rgba',
                'title'     => __('Color Scheme','accelerated-mobile-pages'),
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
                'title'     => __('Header Background Color','accelerated-mobile-pages'),
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
                    'title'     => __('Color Scheme Font Color','accelerated-mobile-pages'),
                    'default'   => array(
                        'color'     => '#fff',
                    ),
                    'required' => array(
                      array('amp-design-selector', '=' , '3')
                 )
              ),

            array(
                'id'        => 'amp-opt-color-rgba-link',
                'type'      => 'color_rgba',
                'title'     => __('Anchor Link Color','accelerated-mobile-pages'),
                'default'   => array(
                    'color'     => '#f42f42',
                ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                )
              ),


            array(
                    'id'        => 'amp-opt-color-rgba-headerelements',
                    'type'      => 'color_rgba',
                    'title'     => __('Header Elements Color','accelerated-mobile-pages'),
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
                     'title'    => __( 'Featured Slider', 'accelerated-mobile-pages' ),
                     'required' => array(
                        array('amp-design-selector', '=' , '3')
                     ),
                     'default'  => '1'
                 ),
             array(
                'id'       => 'amp-design-3-category-selector',
                'type'     => 'select',
                'title'    => __( 'Featured Slider Category', 'accelerated-mobile-pages' ),
                'options'  => $categories_array,
                'required' => array(
                  array('amp-design-selector', '=' , '3'),
                  array('amp-design-3-featured-slider', '=' , '1')
                ),
            ),
             array(
                'id'       => 'amp-design-3-search-feature',
                'type'     => 'switch',
                'subtitle' => __('HTTPS is mandatory for Search', 'accelerated-mobile-pages'),
                'title'    => __( 'Search', 'accelerated-mobile-pages' ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'default'  => '0'
            ),
             

             array(
                'id'       => 'amp-design-2-search-feature',
                'subtitle' => __('HTTPS is mandatory for Search', 'accelerated-mobile-pages'),
                'type'     => 'switch',
                'title'    => __( 'Search', 'accelerated-mobile-pages' ),
                'required' => array(
                  array('amp-design-selector', '=' , '2')
                ),
                'default'  => '0'
            ),

             array(
                'id'       => 'amp-design-1-search-feature',
                'subtitle' => __('HTTPS is mandatory for Search', 'accelerated-mobile-pages'),
                'type'     => 'switch',
                'title'    => __( 'Search', 'accelerated-mobile-pages' ),
                'required' => array(
                  array('amp-design-selector', '=' , '1')
                ),
                'default'  => '0'
            ),
             // Excerpt Length #1013
             array(
                'id'        =>'amp-design-1-excerpt',
                'type'      =>'text',
                'subtitle'  =>__('Enter the number of words Eg: 10','accelerated-mobile-pages'),
                'title'     =>__('Excerpt Length','accelerated-mobile-pages'),
                'required' => array(
                  array('amp-design-selector', '=' , '1')
                     ),
                'validate'  =>'numeric',
                'default'   =>'20',
                ),
    // Call Now button
    array(
        'id'       => 'ampforwp-callnow-button',
        'type'     => 'switch',
        'title'    => __('Call Now Button', 'accelerated-mobile-pages'),
        'true'      => 'true',
        'false'     => 'false',
        'default'   => 0
    ),
    array(
        'id'        =>'enable-amp-call-numberfield',
        'type'      => 'text',
        'required'  => array('ampforwp-callnow-button', '=' , '1'),
        'title'     => __('Enter Phone Number', 'accelerated-mobile-pages'),
        'default'   => '',
    ),
    array(
        'id'        => 'amp-opt-color-rgba-colorscheme-call',
        'type'      => 'color_rgba',
        'title'     => __('Call Button Color','accelerated-mobile-pages'),
        'default'   => array(
            'color'     => '#0a89c0',
        ),
        'required' => array(
          array('ampforwp-callnow-button', '=' , '1')
        )
    ),

             array(
                'id'       => 'amp-design-3-credit-link',
                'type'     => 'switch',
                'title'    => __( 'Credit link', 'accelerated-mobile-pages' ),
                'required' => array(
                  array('amp-design-selector', '=' , '3')
                ),
                'default'  => '1'
            ),

        array(
            'id'       => 'css_editor',
            'type'     => 'ace_editor',
            'title'    => __('Custom CSS', 'accelerated-mobile-pages'),
            'subtitle' => __('You can customize the Stylesheet of the AMP version by using this option.', 'accelerated-mobile-pages'),
            'mode'     => 'css',
            'theme'    => 'monokai',
            'desc'     => '',
            'default'  => __('/******* Paste your Custom CSS in this Editor *******/','accelerated-mobile-pages')
        ),
        )

   )

   );

    // Single Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Single', 'accelerated-mobile-pages' ),
//        'desc'       => __( 'Additional Options to control the look of Single  <a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"> Click here </a> ', 'accelerated-mobile-pages' ),
        'id'         => 'amp-single',
        'subsection' => true,
        'fields'     => array(
          // Social Icons ON/OFF
          array(
              'id'        => 'enable-single-social-icons',
              'type'      => 'switch',
              'title'     => __('Sticky Social Icons', 'accelerated-mobile-pages'),
              'default'   => 1,
              'subtitle'  => __('Enable Social Icons in single', 'accelerated-mobile-pages'),
          ),
          // Excerpt ON/OFF
          array(
              'id'        => 'enable-excerpt-single',
              'type'      => 'switch',
              'title'     => __('Excerpt in single', 'accelerated-mobile-pages'),
              'default'   => 0,
              'subtitle'  => __('Enable feature to add Excerpt above Content in single', 'accelerated-mobile-pages'),
          ),
          //deselectable next previous links
          array(
              'id'        => 'enable-single-next-prev',
              'type'      => 'switch',
              'title'     => __('Next-Previous Links', 'accelerated-mobile-pages'),
              'default'   => 1,
              'subtitle'  => __('Enable Next-Previous links in single', 'accelerated-mobile-pages'),
          ),
          // Post Modified Date
          array(
              'id'        => 'post-modified-date',
              'type'      => 'switch',
              'title'     => __('Show Post Modified Date', 'accelerated-mobile-pages'),
              'default'   => 0,
              'subtitle'  => __('Show Modified date of an article at the end of the post.', 'accelerated-mobile-pages'),
          ),
          // Author Bio
         array(
             'id'       => 'amp-author-description',
             'type'     => 'switch',
             'title'    => __( 'Author Bio in Single', 'accelerated-mobile-pages' ),
             'default'  => '1',
         ),
         // Date on Single
         array(
            'id'       => 'amp-design-3-date-feature',
            'type'     => 'switch',
            'title'    => __( 'Display Date on Single', 'accelerated-mobile-pages' ),
            'required' => array(
              array('amp-design-selector', '=' , '3')
            ),
            'desc'     => __('Display date along with author and category', 'accelerated-mobile-pages' ),
            'default'  => '0'
        ),
        // Pagination //#1015 Pegazee
        array(
            'id'       => 'amp-pagination',
            'type'     => 'switch',
            'title'    => __( 'Pagination in Single', 'accelerated-mobile-pages' ),
           'default'   => 0,
           'subtitle'  => __('Enable the feature to add Pagination in single', 'accelerated-mobile-pages'),
        ),
          // Related Post
	        array(
    		        'id'       => 'ampforwp-single-select-type-of-related',
    		        'type'     => 'select',
    		        'title'    => __('Show Related Post from', 'accelerated-mobile-pages'),
    		        'data'     => 'page',
                'subtitle' => __('select the type of related posts', 'accelerated-mobile-pages'),
    		        'options'  => array(
    			        '1' => 'Tags',
    			        '2' => 'Categories'
    		        ),
               'default'  => '2',
	        ),
	        array(
    		        'id'       => 'ampforwp-number-of-related-posts',
    		        'type'     => 'text',
    		        'title'    => __('Number of Related Post', 'accelerated-mobile-pages'),
                'subtitle' => __('Type the number of related posts you need, Eg : 2', 'accelerated-mobile-pages'),
    		        'validate' => 'numeric',
                'default'  => '3',
	        ),
         // Pages
             array(
                       'id' => 'Page',
                       'type' => 'section',
                       'title' => __('Pages', 'accelerated-mobile-pages'),
                       'indent' => true,
                   ),
         // Meta ON/OFF Pages
             array(
                      'id'       => 'meta_page',
                      'type'     => 'switch',
                      'default'  =>  '0',
                      'title'    => __('Meta For Pages', 'accelerated-mobile-pages'),
                      'subtitle' => __('Enable or disable the Meta on Pages'),                  
                  ),

//             array(
//                  'id' => 'ampforwp-comments-banner',
//                  'type' => 'select',
//                   'desc' =>  $comment_desc,
//                  'title' => __(' df', 'accelerated-mobile-pages'),
//                 'class'    => 'new-class',
//
//                //  'desc'       => ' <br /><a href="' . esc_url(admin_url('customize.php?autofocus[section]=amp_design&customize_amp=1')) .'"  target="_blank"><img class="ampforwp-post-builder-img" src="'.AMPFORWP_IMAGE_DIR . '/amp-post-builder.png" width="489" height="72" /></a>',
//              ),
//
    $fields = array(
    'id'   => 'info_normal',
    'type' => 'info',
    'class' => 'extension_banner_bg',
    'desc' => $single_extension_listing )

        ),

    ) );

    $AD_URL = "http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=advertisement-tab&utm_campaign=AMP%20Plugin";
    $desc = '';
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if(!is_plugin_active( 'amp-incontent-ads/amptoolkit-incontent-ads.php' ) ){

        $desc = '<a href="'.$AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-retina.png" width="560" height="85" /></a>';
        }
        // ADS SECTION
        Redux::setSection( $opt_name, array(
            'title'      => __( 'Advertisement', 'accelerated-mobile-pages' ),
            'desc' => $desc,
            'id'         => 'amp-ads',
            'subsection' => true,
            'fields'     => array(
                // Ad 1 Starts
                array(
                    'id'        =>'enable-amp-ads-1',
                    'type'      => 'switch',
                    'title'     => __('AD #1', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'subtitle'  => __('Below the Header (SiteWide)', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                    array(
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
                        'id'        =>'enable-amp-ads-text-feild-client-1',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-1', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'id'        => 'enable-amp-ads-text-feild-slot-1',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required' => array('enable-amp-ads-1', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
            // Ad 1 ends

            // Ad 2 Starts
                 array(
                    'id'=>'enable-amp-ads-2',
                    'type' => 'switch',
                    'title' => __('AD #2', 'accelerated-mobile-pages'),
                    'default' => 0,
                    'subtitle'     => __('Below the Footer (SiteWide)', 'accelerated-mobile-pages'),
                    'true' => 'Enabled',
                    'false' => 'Disabled',
                    ),
                    array(
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
                        'id'       =>'enable-amp-ads-text-feild-client-2',
                        'type'     => 'text',
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                        'title'    => __('Data AD Client', 'accelerated-mobile-pages'),
                        'subtitle'     => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'id'       => 'enable-amp-ads-text-feild-slot-2',
                        'type'     => 'text',
                        'title'    => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'subtitle'     => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required' => array('enable-amp-ads-2', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
            // Ad 2 ends

            // Ad 3 starts
                 array(
                        'id'        => 'enable-amp-ads-3',
                        'type'      => 'switch',
                        'title'     => __('AD #3', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'subtitle'  => __('Above the Post Content (Single Post)', 'accelerated-mobile-pages'),
                        'true'      => 'Enabled',
                        'false'     => 'Disabled',
                    ),
                    array(
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
                        'id'        =>'enable-amp-ads-text-feild-client-3',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-3', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'id'        => 'enable-amp-ads-text-feild-slot-3',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('enable-amp-ads-3', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
            // Ad 3 ends

            // Ad 4 Starts
                array(
                    'id'        => 'enable-amp-ads-4',
                    'type'      => 'switch',
                    'title'     => __('AD #4', 'accelerated-mobile-pages'),
                    'default'   => 0,
                    'subtitle'  => __('Below the Post Content (Single Post)', 'accelerated-mobile-pages'),
                    'true'      => 'Enabled',
                    'false'     => 'Disabled',
                ),
                    array(
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
                        'id'        =>'enable-amp-ads-text-feild-client-4',
                        'type'      => 'text',
                        'required'  => array('enable-amp-ads-4', '=' , '1'),
                        'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                        'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                    ),
                    array(
                        'id'        => 'enable-amp-ads-text-feild-slot-4',
                        'type'      => 'text',
                        'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                        'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                        'default'   => '',
                        'required'  => array('enable-amp-ads-4', '=' , '1'),
                        'placeholder'=> '70XXXXXX12'
                    ),
            // Ad 4 ends

            //Ad 5 Starts
            array(
                'id'        => 'enable-amp-ads-5',
                'type'      => 'switch',
                'title'     => __('AD #5', 'accelerated-mobile-pages'),
                'default'   => 0,
                'subtitle'  => __('Below The Title (Single Post)', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
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
                    'id'        =>'enable-amp-ads-text-feild-client-5',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-5', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                    'id'        => 'enable-amp-ads-text-feild-slot-5',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-5', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                ),

            //Ad 6 Starts
            array(
                'id'        => 'enable-amp-ads-6',
                'type'      => 'switch',
                'title'     => __('AD #6', 'accelerated-mobile-pages'),
                'default'   => 0,
                'subtitle'  => __('Above the Related Posts (Single Post)', 'accelerated-mobile-pages'),
                'true'      => 'Enabled',
                'false'     => 'Disabled',
            ),
                array(
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
                    'id'        =>'enable-amp-ads-text-feild-client-6',
                    'type'      => 'text',
                    'required'  => array('enable-amp-ads-6', '=' , '1'),
                    'title'     => __('Data AD Client', 'accelerated-mobile-pages'),
                    'subtitle'      => __('Enter the Data Ad Client (data-ad-client) from the adsense ad code.', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'placeholder'=> 'ca-pub-2005XXXXXXXXX342'
                ),
                array(
                    'id'        => 'enable-amp-ads-text-feild-slot-6',
                    'type'      => 'text',
                    'title'     => __('Data AD Slot', 'accelerated-mobile-pages'),
                    'subtitle'      => __('Enter the Data Ad Slot (data-ad-slot) from the adsense ad code. ', 'accelerated-mobile-pages'),
                    'default'   => '',
                    'required'  => array('enable-amp-ads-6', '=' , '1'),
                    'placeholder'=> '70XXXXXX12'
                )


            ),
        ) );
    


    // AMP Menu SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Menu', 'accelerated-mobile-pages' ),
       'desc'       => __( 'Add Menus to your AMP pages by clicking on this <a href="'.trailingslashit(get_admin_url()).'nav-menus.php?action=locations">link</a>' , 'accelerated-mobile-pages'),
       'id'         => 'amp-menus',
       'subsection' => true,
       'fields' => array(

            array(
                'id'       => 'ampforwp-auto-amp-menu-link',
                'type'     => 'switch',
                'title'    => __('Auto Add AMP in Menu URL', 'accelerated-mobile-pages'),
                'subtitle' => __('Automatically add <code>AMP</code> at the end of menu url', 'accelerated-mobile-pages'),
                'true'      => 'true',
                'false'     => 'false',
                'default'   => 0
            ),
        )
       )

   ) ;

// Social Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social', 'accelerated-mobile-pages' ),
        'id'         => 'amp-social',
        'desc'      => __('All the Social sharing and the social profile related settings are here','accelerated-mobile-pages'),
        'subsection' => true,
        'fields'     => array(
          // Facebook ON/OFF
          array(
              'id'        =>  'enable-single-facebook-share',
              'type'      =>  'switch',
              //'required'  => array('enable-single-social-icons', '=' , '1'),
              'title'     =>  __('Facebook', 'accelerated-mobile-pages'),
              'default'   =>  0,
          ),
          // Facebook app ID
          array(
               'id'       => 'amp-facebook-app-id',
               'title'    => __('Facebook App ID', 'accelerated-mobile-pages'),
               'subtitle' => __('In order to use Facebook share you need to register an app ID, you can register one here: https://developers.facebook.com/apps.', 'accelerated-mobile-pages'),
               'type'     => 'text',
               'required'  => array('enable-single-facebook-share', '=' , '1'),
               'placeholder'  => __('Enter your facebook app id','accelerated-mobile-pages'),
               'default'  => ''
          ),
          // Twitter ON/OFF
          array(
              'id'        =>  'enable-single-twitter-share',
              'type'      =>  'switch',
              'title'     =>  __('Twitter', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          array(
              'id'        =>  'enable-single-twitter-share-handle',
              'type'      =>  'text',
              'title'     =>  __('Twitter Handle', 'accelerated-mobile-pages'),
              'required'  => array('enable-single-twitter-share', '=' , '1'),
              'placeholder'  => __('Eg: @xyx','accelerated-mobile-pages'),
              'default'   =>  '',
          ),
          // GooglePlus ON/OFF
          array(
              'id'        =>  'enable-single-gplus-share',
              'type'      =>  'switch',
              'title'     =>  __('GooglePlus', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // Email ON/OFF
          array(
              'id'        =>  'enable-single-email-share',
              'type'      =>  'switch',
              'title'     =>  __('Email', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // Pinterest ON/OFF
          array(
              'id'        =>  'enable-single-pinterest-share',
              'type'      =>  'switch',
              'title'     =>  __('Pinterest', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // LinkedIn ON/OFF
          array(
              'id'        =>  'enable-single-linkedin-share',
              'type'      =>  'switch',
              'title'     =>  __('LinkedIn', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // WhatsApp
          array(
              'id'        =>  'enable-single-whatsapp-share',
              'type'      =>  'switch',
              'title'     =>  __('WhatsApp', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          // LINE
          array(
              'id'        =>  'enable-single-line-share',
              'type'      =>  'switch',
              'title'     =>  __('LINE', 'accelerated-mobile-pages'),
              'default'   =>  1,
          ),
          array(
       'id' => 'social-media-profiles-subsection',
       'type' => 'section',
       'title' => __('Social Media Profiles (Design #3)', 'accelerated-mobile-pages'),
       'subtitle' => __('Please enter your personal/organizational social media profiles here', 'accelerated-mobile-pages'),
       'indent' => true,
       'required' => array(
                array('amp-design-selector', '=' , '3')
        ),
     ),
          //#1
          array(
              'id'        =>  'enable-single-twittter-profile',
              'type'      =>  'switch',
              'title'     =>  __('Twitter ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-twittter-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Twitter URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Facebook ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-facebook-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Facebook URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Pintrest ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-pintrest-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Pintrest URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Google Plus ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-google-plus-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Google Plus URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Linkdin ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-linkdin-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Linkdin URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Youtube ', 'accelerated-mobile-pages'),
              'default'   =>  1,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-youtube-profile-url',
              'type'      =>  'text',
              'default'   =>  '#',
              'title'     =>  __('Youtube URL', 'accelerated-mobile-pages'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-youtube-profile', '=' , '1')
              ),
          ),
          //#7
          array(
              'id'        =>  'enable-single-instagram-profile',
              'type'      =>  'switch',
              'title'     =>  __('Instagram ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-instagram-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  __('Instagram URL', 'accelerated-mobile-pages'),
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-instagram-profile', '=' , '1')
              ),
          ),
          //#8
          array(
              'id'        =>  'enable-single-VKontakte-profile',
              'type'      =>  'switch',
              'title'     =>  __('VKontakte ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-VKontakte-profile-url',
              'type'      =>  'text',
              'default'   =>  '',
              'title'     =>  __('VKontakte URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Reddit', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-reddit-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Reddit URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Snapchat ', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-snapchat-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Snapchat URL', 'accelerated-mobile-pages'),
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
              'title'     =>  __('Tumblr', 'accelerated-mobile-pages'),
              'default'   =>  0,
              'required' => array(
                array('amp-design-selector', '=' , '3')
              ),
          ),
          array(
              'id'        =>  'enable-single-Tumblr-profile-url',
              'type'      =>  'text',
              'title'     =>  __('Tumblr URL', 'accelerated-mobile-pages'),
              'default'   =>  '',
              'required' => array(
                array('amp-design-selector', '=' , '3'),
                array('enable-single-Tumblr-profile', '=' , '1')
              ),
          ),
        )
    ) );


   // SEO SECTION
  Redux::setSection( $opt_name, array(
      'title'      => __( 'SEO', 'accelerated-mobile-pages' ),
      'id'         => 'amp-seo',
      'subsection' => true,
       'fields'     => array(

           array(
               'id'       => 'ampforwp-seo-meta-description',
               'type'     => 'switch',
               'title'     => __('Meta Description', 'accelerated-mobile-pages'),
               'subtitle'     => __('The meta tag that displays in head', 'accelerated-mobile-pages'),
               'default'  => 0
           ),

           array(
               'id'       => 'ampforwp-seo-custom-additional-meta',
               'type'     => 'textarea',
               'title'    => __('Additional tags for Head section AMP page', 'accelerated-mobile-pages'),
               'subtitle' => __('Adds additional Meta to the head section', 'accelerated-mobile-pages', 'accelerated-mobile-pages'),
               'desc' => __('Only link and meta tags allowed', 'accelerated-mobile-pages'),
               'placeholder'  => __('<!-- Paste your Additional HTML , that goes between <head> </head> tags -->','accelerated-mobile-pages')
           ),


           array(
                  'id' => 'ampforwp-yoast-seo-sub-section',
                  'type' => 'section',
                  'title' => __('Yoast SEO Options', 'accelerated-mobile-pages'),
                  'indent' => true
              ),

           array(
               'id'       => 'ampforwp-seo-yoast-meta',
               'type'     => 'switch',
               'subtitle'     => __('Adds Social and Open Graph Meta Tags from Yoast', 'accelerated-mobile-pages'),
               'title'    => __( 'Meta Tags from Yoast', 'accelerated-mobile-pages' ),
               'default'  => '1'
           ),
           array(
               'id'       => 'ampforwp-seo-yoast-description',
               'type'     => 'switch',
               'subtitle'     => __('Adds Yoast Custom description to ld+json for AMP page', 'accelerated-mobile-pages'),
               'title'    => __( 'Yoast Description in ld+json', 'accelerated-mobile-pages' ),
               'default'  => 0
           ),

           array(
                  'id' => 'ampforwp-seo-index-noindex-sub-section',
                  'type' => 'section',
                  'title' => __('Advanced Index & No Index Options', 'accelerated-mobile-pages'),
                  'indent' => true
              ),
           array(
               'id'       => 'ampforwp-robots-archive-sub-pages-sitewide',
               'type'     => 'switch',
               'title'    => __('Archive subpages (sitewide)', 'accelerated-mobile-pages'),
               'desc'  => __("Such as /page/2 so on and so forth",'accelerated-mobile-pages'),
               'default' => 0,
               'on' => 'index',
               'off' => 'noindex'
           ),
           array(
               'id'       => 'ampforwp-robots-archive-author-pages',
               'type'     => 'switch',
               'title'    => __('Author Archive pages', 'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'

           ),
           array(
               'id'       => 'ampforwp-robots-archive-date-pages',
               'type'     => 'switch',
               'title'    => __('Date Archive pages', 'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'

           ),
           array(
               'id'       => 'ampforwp-robots-archive-category-pages',
               'type'     => 'switch',
               'title'    => __('Categories', 'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'
           ),
           array(
               'id'       => 'ampforwp-robots-archive-tag-pages',
               'type'     => 'switch',
               'title'    => __('Tags', 'accelerated-mobile-pages'),
               'default' => 1,
               'on' => 'index',
               'off' => 'noindex'
           ),


       )

  )

  );

    // Analytics SECTION
   Redux::setSection( $opt_name,    array(
      	        'title' => __('Analytics'),
      	        // 'icon' => 'el el-th-large',
      			    'desc'  => __('You can either use Google Tag Manager or Other Analytics Providers','accelerated-mobile-pages'),
                'subsection' => true,
      	        'fields' =>
      	        	array(


                    array(
                        'id'       => 'amp-analytics-select-option',
                        'type'     => 'select',
                        'title'    => __( 'Analytics Type', 'accelerated-mobile-pages' ),
                        'subtitle' => __( 'Select your Analytics provider.', 'accelerated-mobile-pages' ),
                        'options'  => array(
                            '1' => __('Google Analytics', 'accelerated-mobile-pages' ),
                            '2' => __('Segment Analytics', 'accelerated-mobile-pages' ),
                            '3' => __('Piwik Analytics', 'accelerated-mobile-pages' ),
                            '4' => __('Quantcast Measurement', 'accelerated-mobile-pages' ),
                            '5' => __('comScore', 'accelerated-mobile-pages' ),
                            '6' => __('Effective Measure', 'accelerated-mobile-pages' ),
                            '7' => __('StatCounter', 'accelerated-mobile-pages' ),
                            '8' => __('Histats Analytics', 'accelerated-mobile-pages'),
                            '9' => __('Yandex Metrika', 'accelerated-mobile-pages'),
                            '10' => __('Chartbeat Analytics', 'accelerated-mobile-pages'),
                        ),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                        ),
                        'default'  => '1',
                    ),
                      array(
                          'id'       => 'ga-feild',
                          'type'     => 'text',
                          'title'    => __( 'Google Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '1')
                          ),
                          'subtitle' => __( 'Enter your Google Analytics ID.', 'accelerated-mobile-pages' ),
                          'desc'     => __('Example: UA-XXXXX-Y', 'accelerated-mobile-pages' ),
                          'default'  => 'UA-XXXXX-Y',
                      ),
                      array(
                        'id'       => 'sa-feild',
                        'type'     => 'text',
                        'title'    => __( 'Segment Analytics', 'accelerated-mobile-pages' ),
                        'subtitle' => __( 'Enter your Segment Analytics Key.', 'accelerated-mobile-pages' ),
                        'required' => array(
                          array('amp-use-gtm-option', '=' , '0'),
                          array('amp-analytics-select-option', '=' , '2')
                        ),
                        'default'  => 'SEGMENT-WRITE-KEY',
                      ),
                      array(
                          'id'       => 'pa-feild',
                          'type'     => 'text',
                          'title'    => __( 'Piwik Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '3')
                          ),
                          'desc'     => __( 'Example: https://piwik.example.org/piwik.php?idsite=YOUR_SITE_ID&rec=1&action_name=TITLE&urlref=DOCUMENT_REFERRER&url=CANONICAL_URL&rand=RANDOM', 'accelerated-mobile-pages' ),
                          'subtitle' => __('Enter your Piwik Analytics URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                      array(
                          'id'       => 'eam-feild',
                          'type'     => 'text',
                          'title'    => __( 'Effective Measure Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '6')
                          ),
                          'desc'     => __( 'Example: https://s.effectivemeasure.net/d/6/i?pu=CANONICAL_URL&ru=DOCUMENT_REFERRER&rnd=RANDOM', 'accelerated-mobile-pages' ),
                          'subtitle' => __('Enter your Effective Measure URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),
                      array(
                          'id'       => 'sc-feild',
                          'type'     => 'text',
                          'title'    => __( 'StatCounter', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '7')
                          ),
                          'desc'     => __( 'Example: https://c.statcounter.com/PROJECT_ID/0/SECURITY_CODE/1/', 'accelerated-mobile-pages' ),
                          'subtitle' => __('Enter your StatCounter URL.', 'accelerated-mobile-pages' ),
                          'default'  => '#',
                      ),

                      array(
                        'id'        	=>'amp-quantcast-analytics-code',
                        'type'      	=> 'text',
                        'title'     	=> __('p-code','accelerated-mobile-pages'),
                        'default'   	=> '',
                        'required' => array(
                        array('amp-analytics-select-option', '=' , '4')),
                      ),
                      array(
                        'id'        	=>'amp-comscore-analytics-code-c1',
                        'type'      	=> 'text',
                        'title'     	=> __('C1','accelerated-mobile-pages'),
                        'default'   	=> 1,
                        'required' => array(
                        array('amp-analytics-select-option', '=' , '5')),
                      ),
                      array(
                        'id'        	=>'amp-comscore-analytics-code-c2',
                        'type'      	=> 'text',
                        'title'     	=> __('C2','accelerated-mobile-pages'),
                        'default'   	=> '',
                        'required' => array(
                        array('amp-analytics-select-option', '=' , '5')),
                      ),
                       array(
                          'id'       => 'histats-feild',
                          'type'     => 'text',
                          'title'    => __( 'Histats Analytics', 'accelerated-mobile-pages' ),
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '8')
                          ),
                          'subtitle' => __( 'Enter your Histats Analytics ID.', 'accelerated-mobile-pages' ),
                          'desc' => 'Tutorial: <a href="https://ampforwp.com/tutorials/how-to-get-histats-analytics-id/">How to get Histats Analytics ID for AMP?</a>',
                          'default'  => '',
                      ),
                       array(
                        'id'            =>'amp-Yandex-Metrika-analytics-code',
                        'type'          => 'text',
                        'title'         => __('Yandex Metrika Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '9')),
                        'subtitle' => __( 'Enter your Counter ID.', 'accelerated-mobile-pages' ),
                      ),
                       array(
                        'id'            =>'amp-Chartbeat-analytics-code',
                        'type'          => 'text',
                        'title'         => __('Chartbeat Analytics ID','accelerated-mobile-pages'),
                        'default'       => '',
                        'required' => array(
                            array('amp-use-gtm-option', '=' , '0'),
                            array('amp-analytics-select-option', '=' , '10')),
                        'subtitle' => __( 'Enter your Account ID.', 'accelerated-mobile-pages' ),
                      ),

                      //GTM
                        array(
                            'id'       => 'amp-use-gtm-option',
                            'type'     => 'switch',
                            'title'    => __( 'Use Google Tag Manager', 'accelerated-mobile-pages' ),
                            'subtitle' => __( 'Select your Analytics provider.', 'accelerated-mobile-pages' ),
                            'default'  => 0,
                        ),
                        array(
              						'id'        	=>'amp-gtm-id',
              						'type'      	=> 'text',
              						'title'     	=> __('Tag Manager ID (Container ID)','accelerated-mobile-pages'),
              						'default'   	=> '',
              						'desc'	=> __('Eg: GTM-5XXXXXP','accelerated-mobile-pages'),
                        //  'validate' => 'not_empty',
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '1')
                          ),
              					),
              					array(
              						'id'        	=>'amp-gtm-analytics-type',
              						'type'      	=> 'text',
              						'title'     	=> __('Analytics Type','accelerated-mobile-pages'),
              						'default'   	=> '',
              						'desc'	=> __('Eg: googleanalytics','accelerated-mobile-pages'),
                         // 'validate' => 'not_empty',
                          'required' => array(
                            array('amp-use-gtm-option', '=' , '1')
                          ),
              					),
              					array(
              						'id'        	=>'amp-gtm-analytics-code',
              						'type'      	=> 'text',
              						'title'     	=> __('Analytics ID','accelerated-mobile-pages'),
              						'default'   	=> '',
      						        'desc'	=> 'Eg: UA-XXXXXX-Y',
                          // 'validate' => 'not_empty',
                          'required' => array(
                          array('amp-use-gtm-option', '=' , '1')),
              					),

      				    )
          	)
   );

    // Structured Data
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Structured Data', 'accelerated-mobile-pages' ),
        'id'         => 'opt-structured-data',
        'subsection' => true,
        'fields'     => array(
            array(
              'id'       => 'amp-structured-data-logo',
              'type'     => 'media',
              'url'      => true,
              'title'    => __('Default Structured Data Logo', 'accelerated-mobile-pages'),
              'subtitle' => __('Upload the logo you want to show in Google Structured Data. ', 'accelerated-mobile-pages'),
            ),
             array(
                'id'       => 'ampforwp-sd-logo-dimensions',
                'title'    => __('Custom Logo Size', 'accelerated-mobile-pages'),
                'type'     => 'switch',
                'default'  => 0,
            ),
             array(
                'id'       => 'ampforwp-sd-logo-width',
                'type'     => 'text',
                'title'    => __('Logo Width', 'accelerated-mobile-pages'),
                'desc'    => __('Default width is 600 pixels', 'accelerated-mobile-pages'),
                'default' => '600',
                'required'=>array('ampforwp-sd-logo-dimensions','=','1'),
            ),
             array(
                'id'       => 'ampforwp-sd-logo-height',
                'type'     => 'text',
                'title'    => __('Logo Height', 'accelerated-mobile-pages'),
                'desc'    => __('Default height is 60 pixels', 'accelerated-mobile-pages'),
                'default' => '60',
                'required'=>array('ampforwp-sd-logo-dimensions','=','1'),

            ),
            array(
              'id'      => 'amp-structured-data-placeholder-image',
              'type'    => 'media',
              'url'     => true,
              'title'   => __('Default Post Image', 'accelerated-mobile-pages'),
              'subtitle'    => __('Upload the Image you want to show as Placeholder Image.', 'accelerated-mobile-pages'),
              'placeholder'  => __('when there is no featured image set in the post','accelerated-mobile-pages'),
            ),
            array(
            'id'       => 'amp-structured-data-placeholder-image-width',
            'title'    => __('Default Post Image Width', 'accelerated-mobile-pages'),
            'type'     => 'text',
            'placeholder' => '550',
            'subtitle' => __('Please don\'t add "PX" in the image size.','accelerated-mobile-pages'),
            'default'  => '700'
            ),
            array(
              'id'       => 'amp-structured-data-placeholder-image-height',
              'title'    => __('Default Post Image Height', 'accelerated-mobile-pages'),
              'type'     => 'text',
              'placeholder' => '350',
              'subtitle' => __('Please don\'t add "PX" in the image size.','accelerated-mobile-pages'),
              'default'  => '550'
             ),
        )
    ) );

    // Contact Form SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Contact Form', 'accelerated-mobile-pages' ),
          'desc'       => 'Contact form 7 forms will automatically be converted into AMP compatible.',
       'id'         => 'amp-contact',
       'subsection' => true,
       'fields'     => array(
           array(
               'id'        =>'amp-enable-contactform',
               'type'      => 'switch',
               'title'     => __('Contact Form 7 Support', 'accelerated-mobile-pages'),
               'default'   => '',
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           ),
           array(
//        'title'    => __('Notification text', 'accelerated-mobile-pages'),
        'id'   => 'info_normal',
        'type' => 'info',
           'required' => array('amp-enable-contactform', '=' , '1'),
                'desc' => '<div style="    background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -35px -12px 0 -12px;"><b>ONE LAST STEP REQUIRED:</b> This feature requires <a href="https://ampforwp.com/contact-form-7/#utm_source=options-panel&utm_medium=cf7-tab_cf7_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Contact Form 7 extension</a>.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/contact-form-7/#utm_source=options-panel&utm_medium=cf7-tab_cf7_installation_link&utm_campaign=AMP%20Plugin" target="_blank">Click here for more info</a>)</div></div>',               
           ),
       ),

   ) );

    // Notifications SECTION
   Redux::setSection( $opt_name, array(
       'title'      => __( 'Notifications', 'accelerated-mobile-pages' ),
          'desc'       => $cta_desc ,
       'id'         => 'amp-notifications',
       'subsection' => true,
       'fields'     => array(
           array(
               'id'        =>'amp-enable-notifications',
               'type'      => 'switch',
               'title'     => __('Enable Notifications', 'accelerated-mobile-pages'),
               'default'   => '',
               'subtitle'  => __('Show notifications on all of your AMP pages for cookie purposes, or anything else.', 'accelerated-mobile-pages'),
               'true'      => 'Enabled',
               'false'     => 'Disabled',
           ),
           array(
           'id'       => 'amp-notification-text',
           'title'    => __('Notification text', 'accelerated-mobile-pages'),
           'type'     => 'text',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => __('This website uses cookies.','accelerated-mobile-pages'),
           'placeholder' => __('Enter Text here','accelerated-mobile-pages'),
           ),
            array(
           'id'       => 'amp-accept-button-text',
           'title'    => __('Notification accept button text', 'accelerated-mobile-pages'),
           'type'     => 'text',
           'required' => array('amp-enable-notifications', '=' , '1'),
           'default'  => __('Accept','accelerated-mobile-pages'),
           'placeholder' => __('Enter Text here','accelerated-mobile-pages'),
           ),

       ),

   ) );


// Comments
 Redux::setSection( $opt_name, array(
    'title'      => __( 'Comments', 'accelerated-mobile-pages' ),
    'desc' => $comment_desc,
    'id'         => 'disqus-comments',
    'subsection' => true,
    'fields'     => array(
                    array(
                         'id'       => 'ampforwp-number-of-comments',
                         'type'     => 'text',
                         'desc'     => __('This refers to the normal comments','accelerated-mobile-pages'),
                         'title'    => __('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array(
                                            array('ampforwp-disqus-comments-support' , '=' , 0),
                                            array('ampforwp-facebook-comments-support' , '=' , 0)
                                        ),
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Disqus comments Support', 'accelerated-mobile-pages'),
                         'subtitle' => __('Enable/Disable Disqus comments using this switch.', 'accelerated-mobile-pages'),
                         'required' => array('ampforwp-facebook-comments-support', '=' , '0'),
                         'default'  => 0
                     ),
                     array(
                         'id'       => 'ampforwp-disqus-comments-name',
                         'type'     => 'text',
                         'title'    => __('Disqus Name', 'accelerated-mobile-pages'),
                         'subtitle' => __('Eg: https://xyz.disqus.com', 'accelerated-mobile-pages'),
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                         'default'  => ''
                     ),

                     array(
                         'id'       => 'ampforwp-disqus-host-position',
                         'type'     => 'switch',
                         'title'    => __('Host Disqus Comments through AMPforWP Servers', 'accelerated-mobile-pages'),
                         'subtitle' => __('Use AMPforWP secure servers to serve Comments file. Recommended if your site is non HTTPS', 'accelerated-mobile-pages'),
                         'default'  => 1,
                         'required' => array('ampforwp-disqus-comments-support', '=' , '1'),
                     ),

                     array(
                         'id'       => 'ampforwp-disqus-host-file',
                         'type'     => 'text',
                         'title'    => __('Disqus Host File', 'accelerated-mobile-pages'),
                         'subtitle' => __('<a href="https://ampforwp.com/host-disqus-comments/"> Click here to know, How to Setup Disqus Host file on your servers </a>', 'accelerated-mobile-pages'),
                         'placeholder' => 'https://comments.example.com/disqus.php',
                         'required' => array('ampforwp-disqus-host-position', '=' , '0'),
                     ),
                     array(
                         'id'       => 'ampforwp-facebook-comments-support',
                         'type'     => 'switch',
                         'title'    => __('Facebook comments Support', 'accelerated-mobile-pages'),
                         'subtitle' => __('Enable/Disable Facebook comments using this switch.', 'accelerated-mobile-pages'),
                         'default'  => 0,
                     ),
                     array(
                         'id'       => 'ampforwp-number-of-fb-no-of-comments',
                         'type'     => 'text',
                         'desc'     => __('Enter the number of comments','accelerated-mobile-pages'),
                         'title'    => __('No of Comments', 'accelerated-mobile-pages'),
                         'default'  => 10,
                         'required' => array(
                                        array('ampforwp-facebook-comments-support', '=' , 1),


                     ),
                         )
                 )
 ) );


   // Translation Panel
           Redux::setSection( $opt_name, array(
               'title'      => __( 'Translation Panel', 'accelerated-mobile-pages' ),
               'desc'       => __( 'Please translate the following words of page accordingly else default content is in English Language', 'accelerated-mobile-pages' ),
               'id'         => 'amp-translator',
               'subsection' => true,
               'fields'     => array(
                   array(
                       'id'       => 'amp-use-pot',
                       'type'     => 'switch',
                       'title'    => __('Use POT file method of Translation', 'accelerated-mobile-pages'),
                       'subtitle' => __('Else you can use normal translation method', 'accelerated-mobile-pages'),
                       'desc'     => __('Use this if you want Multilingual Translations', 'accelerated-mobile-pages'),
                       'default'  => 0
                   ),
                   array(
                       'id'       => 'amp-translator-show-more-posts-text',
                       'type'     => 'text',
                       'title'    => __('Show more Posts', 'accelerated-mobile-pages'),
                       'default'  => __('Show more Posts','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-previous-posts-text',
                       'type'     => 'text',
                       'title'    => __('Show previous Posts', 'accelerated-mobile-pages'),
                       'default'  => __('Show previous Posts','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-top-text',
                       'type'     => 'text',
                       'title'    => __('Top', 'accelerated-mobile-pages'),
                       'default'  => __('Top','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-non-amp-page-text',
                       'type'     => 'text',
                       'title'    => __('View Non-AMP Version', 'accelerated-mobile-pages'),
                       'default'  => __('View Non-AMP Version','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-related-text',
                       'type'     => 'text',
                       'title'    => __('Related Post', 'accelerated-mobile-pages'),
                       'default'  => __('Related Post','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-navigate-text',
                       'type'     => 'text',
                       'title'    => __('Navigate', 'accelerated-mobile-pages'),
                       'default'  => __('Navigate','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-on-text',
                       'type'     => 'text',
                       'title'    => __('On', 'accelerated-mobile-pages'),
                       'default'  => __('On','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-next-text',
                       'type'     => 'text',
                       'title'    => __('Next', 'accelerated-mobile-pages'),
                       'default'  => __('Next','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-previous-text',
                       'type'     => 'text',
                       'title'    => __('Previous', 'accelerated-mobile-pages'),
                       'default'  => __('Previous','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-footer-text',
                       'type'     => 'textarea',
                       'title'    => __('Footer', 'accelerated-mobile-pages'),
                       'default'  => __('All Rights Reserved','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-categories-text',
                       'type'     => 'text',
                       'title'    => __('Categories', 'accelerated-mobile-pages'),
                       'default'  => __('Categories: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-tags-text',
                       'type'     => 'text',
                       'title'    => __('Tags', 'accelerated-mobile-pages'),
                       'default'  => __('Tags: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-by-text',
                       'type'     => 'text',
                       'title'    => __('By', 'accelerated-mobile-pages'),
                       'default'  => __('By','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-published-by',
                       'type'     => 'text',
                       'title'    => __('Published by', 'accelerated-mobile-pages'),
                       'default'  => __('Published by','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-in-designthree',
                       'type'     => 'text',
                       'title'    => __('in', 'accelerated-mobile-pages'),
                       'default'  =>__( 'in','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-view-comments-text',
                       'type'     => 'text',
                       'title'    => __('View Comments', 'accelerated-mobile-pages'),
                       'default'  => __('View Comments','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-leave-a-comment-text',
                       'type'     => 'text',
                       'title'    => __('Leave a Comment', 'accelerated-mobile-pages'),
                       'default'  => __('Leave a Comment','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-at-text',
                       'type'     => 'text',
                       'title'    => __('at', 'accelerated-mobile-pages'),
                       'default'  => __('at','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-says-text',
                       'type'     => 'text',
                       'title'    => __('says', 'accelerated-mobile-pages'),
                       'default'  =>__( 'says','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-Edit-text',
                       'type'     => 'text',
                       'title'    => __('Edit', 'accelerated-mobile-pages'),
                       'default'  => __('Edit','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-ago-date-text',
                       'type'     => 'text',
                       'title'    => __('ago', 'accelerated-mobile-pages'),
                       'default'  => __('ago','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-modified-date-text',
                       'type'     => 'text',
                       'title'    => __('This post was last modified on ', 'accelerated-mobile-pages'),
                       'default'  => __('This post was last modified on ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archive-cat-text',
                       'type'     => 'text',
                       'title'    => __('Category (archive title)', 'accelerated-mobile-pages'),
                       'default'  => __('Category: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-archive-tag-text',
                       'type'     => 'text',
                       'title'    => __('Tag (archive title)', 'accelerated-mobile-pages'),
                       'default'  => __('Tag: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-show-more-text',
                       'type'     => 'text',
                       'title'    => __('View More Posts (Widget Button)', 'accelerated-mobile-pages'),
                       'default'  => __('View More Posts','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                    array(
                       'id'       => 'amp-translator-next-read-text',
                       'type'     => 'text',
                       'title'    => __('Next Read', 'accelerated-mobile-pages'),
                       'default'  => __('Next Read: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                    array(
                       'id'       => 'amp-translator-via-text',
                       'type'     => 'text',
                       'title'    => __('via', 'accelerated-mobile-pages'),
                       'default'  => __('via','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-search-text',
                       'type'     => 'text',
                       'title'    => __(' You searched for: ', 'accelerated-mobile-pages'),
                       'default'  => __(' You searched for: ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id'       => 'amp-translator-search-no-found',
                       'type'     => 'text',
                       'title'    => __(' It seems we can\'t find what you\'re looking for. ', 'accelerated-mobile-pages'),
                       'default'  => __(' It seems we can\'t find what you\'re looking for. ','accelerated-mobile-pages'),
                       'placeholder'=>__('write here','accelerated-mobile-pages'),
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                       'id' => 'design-3-search-subsection',
                       'type' => 'section',
                       'title' => __('Search bar Translation Text', 'accelerated-mobile-pages'),
                       'indent' => true,
                       'required' => array( 'amp-use-pot', '=' , 0 )
                   ),
                   array(
                      'id'       => 'ampforwp-search-placeholder',
                      'type'     => 'text',
                      'title'    => __('Type Here', 'accelerated-mobile-pages'),
                      'default'  => 'Type Here','accelerated-mobile-pages'),
                      'desc' => __('This is the text that gets shown in for Search Box','accelerated-mobile-pages'),
                      'placeholder'=>__('write here','accelerated-mobile-pages'),
                      'required' => array( 'amp-use-pot', '=' , 0 )

                  ),
                  array(
                     'id'       => 'ampforwp-search-label',
                     'type'     => 'text',
                     'title'    => __('Type your search query and hit enter', 'accelerated-mobile-pages'),
                     'desc' => __('This is the text that gets shown above Search Box','accelerated-mobile-pages'),
                     'default'  => __('Type your search query and hit enter: ','accelerated-mobile-pages'),
                     'placeholder'=>__('write here','accelerated-mobile-pages'),
                     'required' => array( 'amp-use-pot', '=' , 0 )

                 )
              ) );

 function fb_instant_article(){
    $feedname = '';
    $fb_instant_article_feed = ''; 
    $feedname = 'instant_articles';
    $fb_instant_article_feed = trailingslashit( site_url() ).$feedname ;
    return esc_url( $fb_instant_article_feed );
}
// Facebook Instant Articles
Redux::setSection( $opt_name, array(
   'title'      => __( 'Facebook Instant Articles', 'accelerated-mobile-pages' ),
   'id'         => 'fb-instant-article',
   'subsection' => true,
   'fields'     => array(
                     array(
                        'id'        =>'fb-instant-article-switch',
                        'type'      => 'switch',
                        'title'     => __('Facebook Instant Articles Support', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => __('Re-Save permalink when you enable this option, please have a look <a href="https://ampforwp.com/flush-rewrite-urls/">here</a> on how to do it', 'accelerated-mobile-pages'),
                    ),    
                    array(
                        'id'       => 'fb-instant-article-feed-url',
                        'type' => 'info',
                        'style' => 'critical',
                        'desc' => fb_instant_article(),
                        'title'    => __('Facebook Instant Articles Feed URL', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),  
                    array(
                        'id'       => 'fb-instant-article-ads',
                        'type'      => 'switch',
                        'title'     => __('Advertisement', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => __('Switch this on to enable advertising on Instant Article pages.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fb-instant-article-ad-id',
                        'type'     => 'text',
                        'title'    => __('Enter your Audience Network Placement ID', 'accelerated-mobile-pages'),
                        'subtitle' => __('You can find out more about this <a href="https://developers.facebook.com/docs/instant-articles/monetization/audience-network">here</a>. ', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-ads', '=', 1)
                    ),
                     array(
                        'id'       => 'fb-instant-article-analytics',
                        'type'      => 'switch',
                        'title'     => __('Analytics', 'accelerated-mobile-pages'),
                        'default'   => 0, 
                        'true'      => 'true',
                        'false'     => 'false',
                        'desc' => __('Switch this on to enable analytics on Instant Article pages.', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-switch', '=', 1)
                    ),
                    array(
                        'id'       => 'fb-instant-article-analytics-code',
                        'type'     => 'textarea',
                        'title'    => __('Enter your Analytics script code', 'accelerated-mobile-pages'),
                        'subtitle' => __('Do not enter iframe tag. Find out more about support <a href="https://developers.facebook.com/docs/instant-articles/analytics">here</a> ', 'accelerated-mobile-pages'),
                        'required'  => array('fb-instant-article-analytics', '=', 1)
                    ),
    ),
   )
);
Redux::setSection( $opt_name, array(
   'title'      => __( 'Hide AMP Bulk Tools', 'accelerated-mobile-pages' ),
   'id'         => 'hide-amp-section',
   'subsection' => true,
   'desc'       => 'Here are some Advanced options to help you exclude AMP from your prefered pages',
   'fields'     => array(

                        array(
                           'id'       => 'amp-pages-meta-default',
                           'type'     => 'select',
                           'title'    => __( 'Individual AMP Page (Bulk Edit)', 'accelerated-mobile-pages' ),
                           'subtitle' => __( 'Allows you to Show or Hide AMP from All pages, so it can be changed individually later. This option will change the  Default value of AMP metabox in Pages', 'accelerated-mobile-pages' ),
                           'desc' => __( 'NOTE: Changes will overwrite the previous settings.', 'accelerated-mobile-pages' ),
                           'options'  => array(
                               'show' => __('Show by Default', 'accelerated-mobile-pages' ),
                               'hide' => __('Hide by default', 'accelerated-mobile-pages' ),
                           ),
                           'default'  => 'show',
                           'required'=>array('amp-on-off-for-all-pages','=','1'),
                        ),       
                        array(
                        'id'        =>'hide-amp-categories',
                        'type'      => 'checkbox',
                        'title'     => __('Select Categories to Hide AMP'),
                        'subtitle' => __( 'Hide AMP from all the posts of a selected category.', 'accelerated-mobile-pages' ),
                        'default'   => 0, 
                        'data'      => 'categories',
                        ), 
                    )   
                 )
    );

// Advance Settings SECTION
Redux::setSection( $opt_name, array(
   'title'      => __( 'Advance Settings', 'accelerated-mobile-pages' ),
   'desc'       => __( 'This section has Advance settings','accelerated-mobile-pages'),
   'id'         => 'amp-advance',
   'subsection' => true,
   'fields'     => array(

                   /* array(
                        'id'       => 'ampforwp-homepage-on-off-support',
                        'type'     => 'switch',
                        'title'    => __('Homepage Support', 'accelerated-mobile-pages'),
                        'subtitle' => __('Enable/Disable Home page using this switch.', 'accelerated-mobile-pages'),
                        'default'  => '1'
                    ),*/
                    array(
                        'id'       => 'ampforwp-archive-support',
                        'type'     => 'switch',
                        'title'    => __('Archive page Support', 'accelerated-mobile-pages'),
                        'subtitle' => __('Enable/Disable Archive pages using this switch.', 'accelerated-mobile-pages'),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'amp-mobile-redirection',
                        'type'     => 'switch',
                        'title'    => __('Mobile Redirection', 'accelerated-mobile-pages'),
                        'subtitle' => __('
                        Enable AMP for your mobile users. Give your visitors a Faster mobile User Experience.','accelerated-mobile-pages'),
                        'default' => 0,

                    ),

                    array(
                        'id'        =>'amp-rtl-select-option',
                        'type'      => 'switch',
                        'title'     => __('RTL Support', 'accelerated-mobile-pages'),
                        'default'   => 0,
                        'subtitle'  => __('Enable Right to Left language support', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                    ),
                    array(
                        'id'       => 'amp-footer-link-non-amp-page',
                        'type'     => 'switch',
                        'title'    => __('Link to Non-AMP page in Footer', 'accelerated-mobile-pages'),
                        'subtitle' => __('Enable / Disable Link to Non-AMP page in the footer', 'accelerated-mobile-pages'),
                        'true'      => 'true',
                        'false'     => 'false',
                        'default'   => 1
                    ),
                    array(
                        'id'       => 'amp-header-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => __('Enter HTML in Header', 'accelerated-mobile-pages'),
                        'subtitle' => __('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => __('check your markup here (enter markup between HEAD tag) : https://validator.ampproject.org/', 'accelerated-mobile-pages'),
                        'default'   => ''
                    ),
                    array(
                        'id'       => 'amp-footer-text-area-for-html',
                        'type'     => 'textarea',
                        'title'    => __('Enter HTML in Footer', 'accelerated-mobile-pages'),
                        'subtitle' => __('please enter markup that is AMP validated', 'accelerated-mobile-pages'),
                        'desc' => __('check your markup here (enter markup between BODY tag) : https://validator.ampproject.org/',
                        'accelerated-mobile-pages'),
                        'default'   => ''
                    ),

   ),

) );    
// Extension Section
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Extensions', 'accelerated-mobile-pages' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'accelerated-mobile-pages' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-go-premium',
        'subsection' => false,
        'desc' => $extension_listing,
//        'desc' => '<a href="http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=extension-tab_advanced-amp-ads&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-ads-extension.png" width="345" height="500" /></a>
//
//        <a href="http://ampforwp.com/custom-post-type/#utm_source=options-panel&utm_medium=extension-tab_custom-post-type&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-custom-post-type-extension.png" width="345" height="500" /></a>
//
//        <a href="http://ampforwp.com/doubleclick-for-publishers/#utm_source=options-panel&utm_medium=extension-tab_doubleclick&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-DoubleClick-extensions.png" width="345" height="500" /></a>
//
//        <a href="http://ampforwp.com/amp-ratings/#utm_source=options-panel&utm_medium=extension-tab_amp-ratings&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp-rating-extension.png" width="345" height="500" /></a>
//
//
//        <a href="http://ampforwp.com/extensions/#utm_source=options-panel&utm_medium=extension-tab_coming-soon&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-extension-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/extension-coming-soon.png" width="345" height="500" /></a>',
//        'icon' => 'el el-puzzle',
    ) );



// Priority Support
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Fix AMP Errors', 'accelerated-mobile-pages' ),
       // 'desc'       => __( 'For full documentation on this field, visit: ', 'accelerated-mobile-pages' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'opt-go-premium-support',
        'subsection' => false,
        'desc' => '        <a href="http://ampforwp.com/priority-support/#utm_source=options-panel&utm_medium=extension-tab_priority_support&utm_campaign=AMP%20Plugin"  target="_blank"><img class="ampforwp-support-banner" src="'.AMPFORWP_IMAGE_DIR . '/priority-support-banner.png" width="345" height="500" /></a>',
        'icon' => 'el el-hand-right',
    ) );
/*
* <--- END SECTIONS
*/