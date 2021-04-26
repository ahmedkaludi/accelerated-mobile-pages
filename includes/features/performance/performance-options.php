<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 function ampforwp_admin_performance_options($opt_name){
  // Display only If AMP Cache is Not Installed
  $cache_desc ="";
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
     if(!is_plugin_active( 'amp-cache/ampforwp-cache.php' )){
  $cache_AD_URL = "http://ampforwp.com/amp-cache/#utm_source=options-panel&utm_medium=performance-tab&utm_campaign=AMP%20Plugin";
  $cache_desc = '<a href="'.$cache_AD_URL.'"  target="_blank"><img class="ampforwp-ad-img-banner" src="'.AMPFORWP_IMAGE_DIR . '/amp_cache_b.png" width="560" height="85" /></a>';
  }
  // Performance SECTION
  Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Performance', 'accelerated-mobile-pages' ),
        'id'         => 'amp-performance',
        'desc' => $cache_desc,
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
               'title'     => esc_html__('Minify', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => esc_html__('Improve the Page Speed and Loading time with Minification option', 'accelerated-mobile-pages'),
               'default'  => 1
           ),
           array(
               'id'       => 'ampforwp_leverage_browser_caching_mode',
               'type'     => 'switch',
               'title'     => esc_html__('Leverage Browser Caching', 'accelerated-mobile-pages'),
               'tooltip-subtitle'     => esc_html__('Improve the Page Speed and Loading time with Leverage Browser Caching option', 'accelerated-mobile-pages'),
               'default'  => 0
           ),
           array(
               'id'       => 'ampforwp_leverage_browser_caching_expires',
               'class'    => 'child_opt child_opt_arrow',
               'type'     => 'text',
               'default'  => '90',
               'title'    => esc_html__('Days to Expiration', 'accelerated-mobile-pages'),
               'required' => array('ampforwp_leverage_browser_caching_mode', '=' , '1'),
           ),
           array(
               'id'       => 'ampforwp_css_tree_shaking',
               'type'     => 'switch',
               'title'     => esc_html__('Optimize CSS (beta)', 'accelerated-mobile-pages'),
              'tooltip-subtitle'     => esc_html__('Improve size of the CSS and Page Speed with Tree Shaking Feature.', 'accelerated-mobile-pages'),
               'default'  => 0
           ),
           array(

               'id'       => 'ampforwp_css_tree_shaking_clear_cache',
               'type'     => 'raw',
               'class' => 'child_opt child_opt_arrow',
               'title'     => esc_html__('Want to clear the Cache?', 'accelerated-mobile-pages'),
               'content'   => "<span class='button button-primary button-small' id='ampforwp-clear-clearcss-data' target='_blank'  data-nonce='".wp_create_nonce( 'ampforwp_clear_tree_shaking')."'><i class='el el-trash'></i> Clear Cache</span><span id='ampforwp-clear-clcss-msg' ></span>",
               'tooltip-subtitle' => esc_html__('This will remove all the generated cache.', 'amp-pagebuilder-compatibility'),
               'full_width' => false,
               'section_id'=>'amp-content-builder',
               'required'=>array('ampforwp_css_tree_shaking','=','1')
           )






       )

  )

  );
}

