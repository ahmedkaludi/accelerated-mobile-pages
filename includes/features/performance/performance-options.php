<?php
use ReduxCore\ReduxFramework\Redux;
 function ampforwp_admin_performance_options($opt_name){
  // Display only If AMP Cache is Not Installed
  $cache_desc ="";
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
     if(!is_plugin_active( 'amp-cache/ampforwp-cache.php' )){
  $cache_AD_URL = "http://ampforwp.com/amp-cache/#utm_source=options-panel&utm_medium=performance-tab&utm_campaign=AMP%20Plugin";
  $cache_desc = '<a href="'.$cache_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp_cache_b.png" width="560" height="85" /></a>';
  }
  // PWA Section
  Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'PWA', 'accelerated-mobile-pages' ),
        'id'         => 'pwa-for-wp',
        'desc'      => '',
        'subsection' => true,
        'fields'     => array(
            array(
                  'id' => 'ampforwp-pwa-for-wp',
                  'type' => 'section',
                  'title' => esc_html__('Progressive Web App (PWA)', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                    'accordion-open'=> 1,
              ),

           array(
               'id'       => 'ampforwp_pwa_module',
               'type'     => 'raw',
               'title'     => esc_html__('PWA Support', 'accelerated-mobile-pages'),
               'content'  => (!is_plugin_active('pwa-for-wp/pwa-for-wp.php')? 
                                '<div class="install-now ampforwp-activation-call-module-upgrade button  " id="ampforwp-pwa-activation-call" data-secure="'.wp_create_nonce('verify_module').'">Activate this Module</div>'
                            : '<div class="col-wrapper">
                                   <a href="'.admin_url('admin.php?page=pwaforwp&reference=ampforwp').'"> <div class="ampforwp-recommendation-btn updated-message"><p>Go to PWA Settings</p></div> </a> 
                                </div>
                            ').'<a class="amp_recommend_learnmore" href="https://ampforwp.com/tutorials/article/what-is-pwa-for-wp-and-why-its-included-in-the-amp/" target="_blank">Learn more</a>'
           ),

       )

  )

  );

  $nginx_notfication = array();

  $server_name = $_SERVER['SERVER_SOFTWARE'];
  if (preg_match("/nginx/", $server_name)){
    $nginx_notfication = array( 
                    'id'   => 'ampforwp_leverage_ngix_option',
                    'type' => 'info',
                    'required' => array(
                         array('ampforwp_leverage_browser_caching_mode', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://www.digitalocean.com/community/questions/leverage-browser-caching-for-nginx" target="_blank">%s</a>.<br /></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'To enable leverage browser caching for Nginx please read', 'accelerated-mobile-pages' ),esc_html__( 'This 
                      Article', 'accelerated-mobile-pages')),               
               );
  }

  // Performance SECTION
  Redux::setSection( $opt_name, array(
        'title'      => __( 'Performance', 'accelerated-mobile-pages' ),
        'id'         => 'amp-performance',
        'desc' => $cache_desc,
        'subsection' => true,
        'fields'     => array(
            array(
                  'id' => 'ampforwp-performance',
                  'type' => 'section',
                  'title' => __('Performance Enhancement', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                    'accordion-open'=> 1,
              ),

           array(
               'id'       => 'ampforwp_cache_minimize_mode',
               'type'     => 'switch',
               'title'     => __('Minify', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => __('Improve the Page Speed and Loading time with Minification option', 'accelerated-mobile-pages'),
               'default'  => 0
           ),
           array(
               'id'       => 'ampforwp_leverage_browser_caching_mode',
               'type'     => 'switch',
               'title'     => esc_html__('Leverage Browser Caching', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => esc_html__('Improve the Page Speed and Loading time with Leverage Browser Caching option', 'accelerated-mobile-pages'),
               'default'  => 0
           ),
           $nginx_notfication
       )

  )

  );
}

