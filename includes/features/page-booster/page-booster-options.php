<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
// Page Booster
function ampforwp_admin_page_booster_options($opt_name){
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Core Web Vitals', 'accelerated-mobile-pages' ),
        'id'         => 'opt-page-booster',
        'class'=>'ampforwp_new_features ',
        'subsection' => true,
        'fields'     => apply_filters('ampforwp_page_booster_custom_fields', $fields = array()
        ),
    ) );
}

add_filter('ampforwp_page_booster_custom_fields', 'ampforwp_add_page_booster_fields');
function ampforwp_add_page_booster_fields($fields){ 
    if( function_exists('cwvpb_on_install') ) {
          $fields[] = array(
              'id' => 'ampforwp-psb_modules_section',
              'type' => 'section',
              'title' => esc_html__('Core Web Vitals Page Speed Booster!', 'accelerated-mobile-pages'),
              'indent' => true,
              'layout_type' => 'accordion',
              'accordion-open'=> 1 
            );

           $fields[] =  array(
               'id'       => 'ampforwp_psb_module',
               'type'     => 'raw',
               'title'     => esc_html__('Core Web Vitals Page Speed Booster', 'accelerated-mobile-pages'),
               'content'  =>'<div class="col-wrapper">
                                   <a href="'.admin_url('admin.php?page=cwvpsb').'"> <div class="ampforwp-recommendation-btn updated-message"><p>Page Speed Booster Settings</p></div> </a>
                            <a class="amp_recommend_learnmore" href="https://ampforwp.com/tutorials/article/what-is-the-cwv-plugin-all-about/" target="_blank">Learn more</a></div>'
            );
           return $fields;
    }
    else {
            $cwvpsb_install = '';  
            if(function_exists('cwvpb_on_install')){
                $cwvpsb_install = '<a href="'.admin_url('admin.php?page=cwvpsb&reference=ampforwp').'"><div class="ampforwp-recommendation-btn updated-message"><p>'.esc_html__('Go to Page Speed Booster settings','accelerated-mobile-pages').'</p></div></a>';
            }else{
                  $cwvpsb_install = '<div class="install-now ampforwp-activation-call-module-upgrade button button-primary" id="ampforwp-page-booster-activation-call" data-secure="'.wp_create_nonce('verify_module').'"><p>'.esc_html__('Install & Setup for Free','accelerated-mobile-pages').'</p></div>';
              }
              if(file_exists(AMPFORWP_MAIN_PLUGIN_DIR."core-web-vitals-pagespeed-booster/core-web-vitals-pagespeed-booster.php") && !function_exists('cwvpb_on_install')){
                        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=core-web-vitals-pagespeed-booster/core-web-vitals-pagespeed-booster.php&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_core-web-vitals-pagespeed-booster/core-web-vitals-pagespeed-booster.php' );
                        $cwvpsb_install = '<div class="install-now ampforwp-activation-plugin button button-primary" id="ampforwp-page-booster-activate" style="color: #fff;text-decoration: none;" data-href="'.$activation_url.'" >'.esc_html__('Activate Plugin','accelerated-mobile-pages').'</div>';
                  }
             $fields[] =    array(
                                'id' => 'ampforwp-psb_modules_section',
                                'type' => 'section',
                                'title' => esc_html__('Presenting You Core Web Vitals!', 'accelerated-mobile-pages'),
                                'indent' => true,
                                'layout_type' => 'accordion',
                                'accordion-open'=> 1, 
                            );
                $fields[] =   array(
                          'id'       => 'ampforwp-psb-module',
                          'type'     => 'raw',
                          'content'  => '<div class="ampforwp-cwvpsb-update">
                                                '.(!is_plugin_active('core-web-vitals-pagespeed-booster/core-web-vitals-pagespeed-booster.php')? 'Improve Performance of the Page:': 'Thank you for upgrading the Structured data').'
                                                <div class="row">
                                                    
                                                        '.(!is_plugin_active('core-web-vitals-pagespeed-booster/core-web-vitals-pagespeed-booster.php')? '
                                                        <div class="col-3"><ul>
                                                            <li>Webp images</li>
                                                            <li>Lazy Load</li>
                                                            <li>Minification</li>
                                                            <li>Remove Unused CSS</li>
                                                            <li>Google Fonts Optimizations</li>
                                                            <li>Delay JavaScript Execution</li>
                                                            <li>Static Cache & More..!</li>
                                                        </ul> </div>' : '')
                                                    .'
                                                    <div class="col-1">
                                                        '. $cwvpsb_install /* $cwvpsb_install XSS escaped */.' 
                                                         &nbsp;<a href="https://ampforwp.com/tutorials/article/what-is-the-cwv-plugin-all-about/" class="amp_recommend_learnmore" target="_blank">Learn more</a>
                                                    </div>
                                            </div>' 
                                            
                );
          
    return $fields;
    }
}
