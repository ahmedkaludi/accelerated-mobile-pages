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

       )

  )

  );
}

