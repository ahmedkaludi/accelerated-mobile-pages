<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 function ampforwp_admin_advertisement_options($opt_name){
    $advertisementdesc = '';
    if(!is_plugin_active( 'amp-incontent-ads/amptoolkit-incontent-ads.php' ) && !is_plugin_active( 'ads-for-wp/ads-for-wp.php' ) ){
        $AD_URL = "http://ampforwp.com/advanced-amp-ads/#utm_source=options-panel&utm_medium=advertisement-tab&utm_campaign=AMP%20Plugin";
    $quads_download = '';  
    if(function_exists('quads_loaded')){
        $quads_download = '<a href="'.esc_url(admin_url('admin.php?page=quads-settings')).'">'.esc_html__('Go to WP QUADS Settings', 'accelerated-mobile-pages').' </a>';
    }else{
        $quads_download = '<div class="install-now ampforwp-activation-call-module-upgrade button quads_install_button " id="ampforwp-wp-quads-activation-call" data-secure="'.wp_create_nonce('verify_module').'">'.esc_html__('Install Free Plugin', 'accelerated-mobile-pages').'</div>';
    }
        if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR."quick-adsense-reloaded/quick-adsense-reloaded.php") && !function_exists('quads_loaded')){
           $quads_download = '<div class="install-now button quads_install_button"><a target="_blank" href="'.esc_url(admin_url('plugins.php')).'">'.esc_html__('Activate Plugin', 'accelerated-mobile-pages').'</a></div>';
        }   
    $advertisementdesc = '
    <div class="ads-baner">
        <span class="adt-top">'.esc_html__('The Best AMP integration for Advertisement', 'accelerated-mobile-pages').'</span>
        <div class="ads-baner-inner">
            <span>'.esc_html__('INTRODUCING', 'accelerated-mobile-pages').'</span>
            <img class="ampforwp-quads-logo" src="'.AMPFORWP_IMAGE_DIR . '/wpquads-logo.png" width="180" height="42" />
            <div class="list-of-feat">
                <ul>
                    <li>
                        <h5>'.esc_html__('GENERAL FEATURES', 'accelerated-mobile-pages').'</h5>
                        <ul class="inner-list">
                            <li>'.esc_html__('Unlimited Ads', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Ad after X paragraph', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('After every Nth para', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('For AMP & non-AMP', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Ad after Imaget', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Ad by Word count', 'accelerated-mobile-pages').'</li>
                        </ul>
                    </li>
                    <li>
                        <h5>'.esc_html__('VENDORS', 'accelerated-mobile-pages').'</h5>
                        <ul class="inner-list">
                            <li>'.esc_html__('Adsense', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Ad manager (DFP)', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Yandex Direct', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Custom Code', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('MGID', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('30+ coming soon', 'accelerated-mobile-pages').'</li>
                        </ul>
                    </li>
                    <li>
                        <h5>'.esc_html__('VISIBILITY by', 'accelerated-mobile-pages').'</h5>
                        <ul class="inner-list">
                            <li>'.esc_html__('Post Type', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Specific Post', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Taxonomy', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Page Template', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Category / Tag', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('And 8+ more', 'accelerated-mobile-pages').'</li>
                        </ul>
                    </li>
                    <li>
                        <h5>'.esc_html__('TARGETTING by', 'accelerated-mobile-pages').'</h5>
                        <ul class="inner-list">
                            <li>'.esc_html__('Device type', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('User Agent', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Cookie', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Referre', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('Language', 'accelerated-mobile-pages').'</li>
                            <li>'.esc_html__('And 4+ more', 'accelerated-mobile-pages').'</li>
                        </ul>
                    </li>
                </ul>
                <div class="ad-lnk">
                     '. $quads_download .'
                </div>
            </div>
        </div>
    </div>';
    }
if (!function_exists('adsforwp_admin_notice')) {    
// ADS SECTION
 Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Advertisement', 'accelerated-mobile-pages' ),
            'desc' => $advertisementdesc,
            'class'      => '',
            'id'         => 'amp-ads',
            'subsection' => true,
            'fields'     => apply_filters('ampforwp_ads_option_fields', $fields = array() ),
        ) );   
 }  
 }

 //
 add_filter('ampforwp_ads_option_fields', 'ampforwp_add_ads_fields');
 function ampforwp_add_ads_fields($fields){
        if ( !is_plugin_active('ads-for-wp/ads-for-wp.php') ) {

                $fields[] =     array(
                            'id' => 'amp-ads_0',
                           'type' => 'section',
                           'title' => esc_html__('Optimize Your Revenue With The Publisher Desk', 'accelerated-mobile-pages'),
                           'indent' => true,
                           'layout_type' => 'accordion',
                           'accordion-open'=> 1,
                );

                $fields[] =    array(
                        'id'        =>'ampforwp-ads-publisherdesk',
                        'type'      => 'switch',
                        'title'     => esc_html__('Ad Revenue Optimization', 'accelerated-mobile-pages'),
                        'desc' => sprintf('%s <a href="%s" target="_blank">%s</a>', 
                         esc_html__('Integrate Ads Through The Publisher Desk', 'accelerated-mobile-pages'), esc_url('https://www.publisherdesk.com/amp-for-wp/'),esc_html__('Learn more','accelerated-mobile-pages')),    
                        'default'   => 0,
                    );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'ampforwp-publisherdesk-id',
                            'type'      => 'text',
                            'required' => array('ampforwp-ads-publisherdesk', '=' , '1'),
                            'title'     => esc_html__('Publisher ID', 'accelerated-mobile-pages'),
                            'desc' => sprintf('%s <a href="%s" target="_blank">%s</a>', 
                        esc_html__('Obtain your Publisher ID through', 'accelerated-mobile-pages'), esc_url('https://ampforwp.com/tutorials/article/how-to-add-the-publisher-desk-ads-in-amp/'), esc_html__('these steps','accelerated-mobile-pages')),
                            'default'   => '10001',
                            'placeholder'=> '10001'
                        );

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
                            'class'    => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-type-1',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Type', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-1', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                'adsense'   =>  esc_html__('Adsense', 'accelerated-mobile-pages'),
                                'mgid'      =>  esc_html__('MGID','accelerated-mobile-pages'),
                            ),
                            'default'  => 'adsense',
                        );
                $fields[] =        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-1',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'adsense'),
                                        ),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-1',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                             'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'adsense'),
                                        ),
                        );
                // MGID fields
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-width',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Width', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-height',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Height', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-field-data-pub',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'mgid'),
                                        ),
                            'title'     => esc_html__('Data Publisher', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Publisher (data-publisher) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'site.com'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-widget',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Widget', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Widget (data-widget) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'mgid'),
                                        ),
                            'placeholder'=> '3XXXXX'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-con',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Container', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Container (data-container) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-1', '=' , '1'),
                                            array('enable-amp-ads-type-1', '=' , 'mgid'),
                                        ),
                            'placeholder'=> 'MXXScriptRootCXXXXXX'
                        ); 
                 $fields[] =       array(   
                            'class' => 'child_opt', 
                            'id'        => 'enable-amp-ads-mgid-flexible',  
                            'type'      => 'switch',    
                            'title'     => esc_html__('Flexible AMP widget', 'accelerated-mobile-pages'),   
                            'tooltip-subtitle'      => esc_html__('It will look like usual "fixed size AMP widget", without any specific width-and-height values.', 'accelerated-mobile-pages'),    
                            'default'   => 0,   
                            'required' => array(    
                                            array('enable-amp-ads-1', '=' , '1'),   
                                            array('enable-amp-ads-type-1', '=' , 'mgid'),   
                                        ),  
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
                            'class'    => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-type-2',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Type', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-2', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                'adsense'   =>  esc_html__('Adsense', 'accelerated-mobile-pages'),
                                'mgid'      =>  esc_html__('MGID','accelerated-mobile-pages'),
                            ),
                            'default'  => 'adsense',
                        );
                $fields[] =        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-2',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'adsense'),
                                        ),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-2',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'adsense'),
                                        ),
                        );
                // MGID fields
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-width-2',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-2', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Width', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-height-2',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-2', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Height', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-field-data-pub-2',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'mgid'),
                                        ),
                            'title'     => esc_html__('Data Publisher', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Publisher (data-publisher) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'site.com'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-widget-2',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Widget', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Widget (data-widget) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'mgid'),
                                        ),
                            'placeholder'=> '3XXXXX'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-con-2',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Container', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Container (data-container) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-2', '=' , '1'),
                                            array('enable-amp-ads-type-2', '=' , 'mgid'),
                                        ),
                            'placeholder'=> 'MXXScriptRootCXXXXXX'
                        );
                 $fields[] =       array(    
                            'class' => 'child_opt', 
                            'id'        => 'enable-amp-ads-mgid-flexible-2',    
                            'type'      => 'switch',    
                            'title'     => esc_html__('Flexible AMP widget', 'accelerated-mobile-pages'),   
                            'tooltip-subtitle'      => esc_html__('It will look like usual "fixed size AMP widget", without any specific width-and-height values.', 'accelerated-mobile-pages'),    
                            'default'   => 0,   
                            'required' => array(    
                                            array('enable-amp-ads-2', '=' , '1'),   
                                            array('enable-amp-ads-type-2', '=' , 'mgid'),   
                                        ),  
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
                $fields[] =        array(
                            'class'    => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-type-3',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Type', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-3', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                'adsense'   =>  esc_html__('Adsense', 'accelerated-mobile-pages'),
                                'mgid'      =>  esc_html__('MGID','accelerated-mobile-pages'),
                            ),
                            'default'  => 'adsense',
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
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'adsense'),
                                        ),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-3',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'adsense'),
                                        ),
                        );
                // MGID fields
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-width-3',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-3', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Width', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-height-3',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-3', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Height', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-field-data-pub-3',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'mgid'),
                                        ),
                            'title'     => esc_html__('Data Publisher', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Publisher (data-publisher) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'site.com'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-widget-3',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Widget', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Widget (data-widget) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'mgid'),
                                        ),
                            'placeholder'=> '3XXXXX'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-con-3',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Container', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Container (data-container) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-3', '=' , '1'),
                                            array('enable-amp-ads-type-3', '=' , 'mgid'),
                                        ),
                            'placeholder'=> 'MXXScriptRootCXXXXXX'
                        ); 
                 $fields[] =       array(   
                            'class' => 'child_opt', 
                            'id'        => 'enable-amp-ads-mgid-flexible-3',    
                            'type'      => 'switch',    
                            'title'     => esc_html__('Flexible AMP widget', 'accelerated-mobile-pages'),   
                            'tooltip-subtitle'      => esc_html__('It will look like usual "fixed size AMP widget", without any specific width-and-height values.', 'accelerated-mobile-pages'),    
                            'default'   => 0,   
                            'required' => array(    
                                            array('enable-amp-ads-3', '=' , '1'),   
                                            array('enable-amp-ads-type-3', '=' , 'mgid'),   
                                        ),  
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
                            'class'    => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-type-4',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Type', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-4', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                'adsense'   =>  esc_html__('Adsense', 'accelerated-mobile-pages'),
                                'mgid'      =>  esc_html__('MGID','accelerated-mobile-pages'),
                            ),
                            'default'  => 'adsense',
                        );
                $fields[] =        array(
                            'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-4',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                             'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'adsense'),
                                        ),
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
                             'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'adsense'),
                                        ),
                            'placeholder'=> '70XXXXXX12'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-4',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'adsense'),
                                        ),
                        );
                // MGID fields
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-width-4',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-4', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Width', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-height-4',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-4', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Height', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-field-data-pub-4',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'mgid'),
                                        ),
                            'title'     => esc_html__('Data Publisher', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Publisher (data-publisher) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'site.com'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-widget-4',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Widget', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Widget (data-widget) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'mgid'),
                                        ),
                            'placeholder'=> '3XXXXX'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-con-4',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Container', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Container (data-container) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-4', '=' , '1'),
                                            array('enable-amp-ads-type-4', '=' , 'mgid'),
                                        ),
                            'placeholder'=> 'MXXScriptRootCXXXXXX'
                        ); 
                 $fields[] =       array(   
                            'class' => 'child_opt', 
                            'id'        => 'enable-amp-ads-mgid-flexible-4',    
                            'type'      => 'switch',    
                            'title'     => esc_html__('Flexible AMP widget', 'accelerated-mobile-pages'),   
                            'tooltip-subtitle'      => esc_html__('It will look like usual "fixed size AMP widget", without any specific width-and-height values.', 'accelerated-mobile-pages'),    
                            'default'   => 0,   
                            'required' => array(    
                                            array('enable-amp-ads-4', '=' , '1'),   
                                            array('enable-amp-ads-type-4', '=' , 'mgid'),   
                                        ),  
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
                 $fields[] =        array(
                            'class'    => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-type-5',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Type', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-5', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                'adsense'   =>  esc_html__('Adsense', 'accelerated-mobile-pages'),
                                'mgid'      =>  esc_html__('MGID','accelerated-mobile-pages'),
                            ),
                            'default'  => 'adsense',
                        );
                $fields[] =    array(
                            'class' => 'child_opt child_opt_arrow',
                        'id'       => 'enable-amp-ads-select-5',
                        'type'     => 'select',
                        'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                        'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'adsense'),
                                        ),
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
                        'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'adsense'),
                                        ),
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
                        'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'adsense'),
                                        ),
                        'placeholder'=> '70XXXXXX12'
                    );
                $fields[] =    array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-resp-5',
                            'type'      => 'switch',
                            'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                            'default'   => 0,
                            'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'adsense'),
                                        ),
                        );
                 // MGID fields
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-width-5',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-5', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Width', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-height-5',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-5', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Height', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-field-data-pub-5',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'mgid'),
                                        ),
                            'title'     => esc_html__('Data Publisher', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Publisher (data-publisher) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'site.com'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-widget-5',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Widget', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Widget (data-widget) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'mgid'),
                                        ),
                            'placeholder'=> '3XXXXX'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-con-5',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Container', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Container (data-container) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-5', '=' , '1'),
                                            array('enable-amp-ads-type-5', '=' , 'mgid'),
                                        ),
                            'placeholder'=> 'MXXScriptRootCXXXXXX'
                        ); 
                 $fields[] =       array(   
                            'class' => 'child_opt', 
                            'id'        => 'enable-amp-ads-mgid-flexible-5',    
                            'type'      => 'switch',    
                            'title'     => esc_html__('Flexible AMP widget', 'accelerated-mobile-pages'),   
                            'tooltip-subtitle'      => esc_html__('It will look like usual "fixed size AMP widget", without any specific width-and-height values.', 'accelerated-mobile-pages'),    
                            'default'   => 0,   
                            'required' => array(    
                                            array('enable-amp-ads-5', '=' , '1'),   
                                            array('enable-amp-ads-type-5', '=' , 'mgid'),   
                                        ),  
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
                     $fields[] =        array(
                            'class'    => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-type-6',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Type', 'accelerated-mobile-pages'),
                            'required' => array('enable-amp-ads-6', '=' , '1'),
                            // Must provide key => value pairs for select options
                            'options'  => array(
                                'adsense'   =>  esc_html__('Adsense', 'accelerated-mobile-pages'),
                                'mgid'      =>  esc_html__('MGID','accelerated-mobile-pages'),
                            ),
                            'default'  => 'adsense',
                        );
                    $fields[] =    array(
                                'class' => 'child_opt child_opt_arrow',
                            'id'       => 'enable-amp-ads-select-6',
                            'type'     => 'select',
                            'title'    => esc_html__('AD Size', 'accelerated-mobile-pages'),
                             'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'adsense'),
                                        ),
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
                            'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'adsense'),
                                        ),
                            'placeholder'=> '70XXXXXX12'
                        );
                    $fields[] =    array(
                                'class' => 'child_opt',
                                'id'        =>'enable-amp-ads-resp-6',
                                'type'      => 'switch',
                                'title'     => esc_html__('Responsive Ad unit', 'accelerated-mobile-pages'),
                                'default'   => 0,
                                 'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'adsense'),
                                        ),
                        );   
                     // MGID fields
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-width-6',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-6', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Width', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-height-6',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'mgid'),
                                            array('enable-amp-ads-mgid-flexible-6', '=' , '0'),
                                        ),
                            'title'     => esc_html__('Height', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> '600'
                        );
                $fields[] =        array(
                            'class' => 'child_opt',
                            'id'        =>'enable-amp-ads-mgid-field-data-pub-6',
                            'type'      => 'text',
                            'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'mgid'),
                                        ),
                            'title'     => esc_html__('Data Publisher', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Publisher (data-publisher) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'placeholder'=> 'site.com'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-widget-6',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Widget', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Widget (data-widget) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'mgid'),
                                        ),
                            'placeholder'=> '3XXXXX'
                        );
                 $fields[] =       array(
                            'class' => 'child_opt',
                            'id'        => 'enable-amp-ads-mgid-field-data-con-6',
                            'type'      => 'text',
                            'title'     => esc_html__('Data Container', 'accelerated-mobile-pages'),
                            'tooltip-subtitle'      => esc_html__('Enter the Data Container (data-container) from the MGID AD AMP code.', 'accelerated-mobile-pages'),
                            'default'   => '',
                            'required' => array(
                                            array('enable-amp-ads-6', '=' , '1'),
                                            array('enable-amp-ads-type-6', '=' , 'mgid'),
                                        ),
                            'placeholder'=> 'MXXScriptRootCXXXXXX'
                        ); 
                 $fields[] =       array(   
                            'class' => 'child_opt', 
                            'id'        => 'enable-amp-ads-mgid-flexible-6',    
                            'type'      => 'switch',    
                            'title'     => esc_html__('Flexible AMP widget', 'accelerated-mobile-pages'),   
                            'tooltip-subtitle'      => esc_html__('It will look like usual "fixed size AMP widget", without any specific width-and-height values.', 'accelerated-mobile-pages'),    
                            'default'   => 0,   
                            'required' => array(    
                                            array('enable-amp-ads-6', '=' , '1'),   
                                            array('enable-amp-ads-type-6', '=' , 'mgid'),   
                                        ),  
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
                $is_afwp = "not-exist";
                $afwp_active_url = '';
                $afwp_default = 0;
                if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR."ads-for-wp/ads-for-wp.php")){
                    if(!is_plugin_active('ads-for-wp/ads-for-wp.php')){
                        $is_afwp = "inactive";
                        $plugin_file = "ads-for-wp/ads-for-wp.php";
                        $afwp_active_url = ampforwp_wp_plugin_action_link( $plugin_file, 'activate' );
                    }else{
                        $is_afwp = "active";
                        $ampforwp_admin_url = admin_url();
                        $afwp_active_url = $ampforwp_admin_url.'admin.php?page=adsforwp&amp;tab=general&amp;reference=ampforwp';
                        $afwp_default = 2;
                    }
                }
        $fields[] =   array(
                  'id'       => 'ampforwp-ads-module',
                  'class'=> is_plugin_active('ads-for-wp/ads-for-wp.php')? "adsactive": '',
                  'type'     => 'raw',
                  'content'  => '<div class="ampforwp-ads-data-update"><input type="hidden" value="'.esc_url_raw($afwp_active_url).'" class="ampforwp-activation-url" id="'.esc_attr($is_afwp).'">
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
                        <div class="install-now ampforwp-activation-call-module-upgrade button  button-primary" id="ampforwp-adsforwp-activation-call" data-secure="'.wp_create_nonce('verify_module').'">
                            <p>' . esc_html__('Upgrade for Free','accelerated-mobile-pages') .'</p>
                        </div>' :
                                                    '<a href="'.admin_url('edit.php?post_type=adsforwp').'"><div class="ampforwp-recommendation-btn updated-message"><p>Go to Ads for WP settings</p></div></a>'
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
                $fields[] =  array(
                        'id'    => 'ampforwp-ads-sponsorship-position',
                        'class' => 'child_opt child_opt_arrow', 
                        'type'     => 'select',
                        'title'    => esc_html__( 'Position', 'accelerated-mobile-pages' ),
                        'tooltip-subtitle' => esc_html__( 'Select Sponsorship Position you want to show.', 'accelerated-mobile-pages' ),
                        'options'   => array(
                            '1'     => 'Above the Ads',
                            '2'     => 'Below the Ads',
                                    ),
                        'default'  => '2',
                        'required'  => array('ampforwp-ads-sponsorship','=','1'),
                    );
        }

           return $fields;
 }