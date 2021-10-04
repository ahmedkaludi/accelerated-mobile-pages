<?php
use ReduxCore\ReduxFramework\Redux;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_page_builders_support_options($opt_name){
$divi_pb_for_ampchecker = $elemntr_pb_for_ampchecker = $avada_pb_for_ampchecker = $avia_pb_for_ampchecker = $oxygen_pb_for_ampchecker = $ux_pb_for_ampchecker = $beaver_builder_pb_for_ampchecker = $muffin_builder_pb_for_ampchecker = array();
if(!function_exists('amp_pagebuilder_compatibility_init')){
    $divi_pb_for_ampchecker = array( 
                    'id'   => 'divi_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-divi-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
   
    $elemntr_pb_for_ampchecker = array( 
                    'id'   => 'elemntr_pb_for_amp_info_normal',
                    'type' => 'info',
                    'required' => array(
                        array('ampforwp-elementor-pb-for-amp', '=' , true),  
                        ),
                     'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
               );
  
//}   
    $avada_pb_for_ampchecker = array( 
                'id'   => 'avada_pb_for_amp_info_normal',
                'type' => 'info',
                'required' => array(
                    array('ampforwp-avada-pb-for-amp', '=' , true),  
                    ),
                 'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder compatibility For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
           );
   
      $avia_pb_for_ampchecker = array( 
                'id'   => 'avia_pb_for_amp_info_normal',
                'type' => 'info',
                'required' => array(
                    array('ampforwp-avia-pb-for-amp', '=' , true),  
                    ),
                 'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder compatibility For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
           );
      $oxygen_pb_for_ampchecker = array( 
                'id'   => 'oxygen_pb_for_amp_info_normal',
                'type' => 'info',
                'required' => array(
                    array('ampforwp-oxygen-pb-for-amp', '=' , true),  
                    ),
                 'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder compatibility For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
           );
      $ux_pb_for_ampchecker = array( 
                'id'   => 'ux_pb_for_amp_info_normal',
                'type' => 'info',
                'required' => array(
                    array('ampforwp-ux-pb-for-amp', '=' , true),  
                    ),
                 'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder compatibility For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
            );
      $beaver_builder_pb_for_ampchecker = array( 
                'id'   => 'beaver_b_pb_for_amp_info_normal',
                'type' => 'info',
                'required' => array(
                    array('ampforwp-beaver-pb-for-amp', '=' , true),  
                    ),
                 'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder compatibility For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
           );
      $muffin_builder_pb_for_ampchecker = array( 
                'id'   => 'muffin_b_pb_for_amp_info_normal',
                'type' => 'info',
                'required' => array(
                    array('ampforwp-muffin-pb-for-amp', '=' , true),  
                    ),
                 'desc' => sprintf('<div style="background: #FFF9C4;padding: 12px;line-height: 1.6;margin: -45px -14px -18px -17px;"><b>%s</b> %s <a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a> extension.<br /> <div style="margin-top:4px;">(<a href="https://ampforwp.com/page-builder-compatibility-for-amp/" target="_blank">%s</a>)</div></div>',esc_html__( 'ONE LAST STEP REQUIRED:','accelerated-mobile-pages'),esc_html__( 'This feature requires', 'accelerated-mobile-pages' ),esc_html__( 'Page Builder compatibility For AMP', 'accelerated-mobile-pages'),esc_html__( 'Click here for more info', 'accelerated-mobile-pages' )),               
           );
}
     $pb_for_amp[] =  array(
                'id' => 'ampforwp-pagebuilder-accor',
                'type' => 'section',
                'title' => esc_html__('AMPforWP PageBuilder', 'accelerated-mobile-pages'),
                'indent' => true,
                'layout_type' => 'accordion',
                'accordion-open'=> 1, 
            );
    $pb_for_amp[] = array(
               'id'       => 'ampforwp-pagebuilder',
               'type'     => 'switch',
               'title'    => esc_html__('AMPforWP PageBuilder', 'accelerated-mobile-pages'),
               'tooltip-subtitle' => esc_html__('Enable or Disable the AMP PageBuilder', 'accelerated-mobile-pages'),
               'default'  => true
             );
    if(function_exists('et_setup_theme')){   
      $pb_for_amp[] =  array(
                  'id' => 'ampforwp-divi-pb-for-amp-accor',
                  'type' => 'section',
                  'title' => esc_html__('Divi Builder Compatibility', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1, 
              );
      $pb_for_amp[] = array(
                 'id'       => 'ampforwp-divi-pb-for-amp',
                 'type'     => 'switch',
                 'title'    => esc_html__('Divi Builder Support','accelerated-mobile-pages'),
                 'tooltip-subtitle' => esc_html__('Enable or Disable the Divi Builder support for AMP', 'accelerated-mobile-pages'),
                 'default'  => true
              );
    }
    $pb_for_amp[] = $divi_pb_for_ampchecker;
    if(function_exists('elementor_load_plugin_textdomain')){
      $pb_for_amp[] =  array(
                  'id' => 'ampforwp-elementor-pb-for-amp-accor',
                  'type' => 'section',
                  'title' => esc_html__('Elementor Compatibility', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1, 
              );
      $pb_for_amp[] = array(
                 'id'       => 'ampforwp-elementor-pb-for-amp',
                 'type'     => 'switch',
                 'title'    => esc_html__('Elementor Support','accelerated-mobile-pages'),
                 'tooltip-subtitle' => esc_html__('Enable or Disable the Elementor support for AMP', 'accelerated-mobile-pages'),
                 'default'  => false
              ); 
    }
    $pb_for_amp[] = $elemntr_pb_for_ampchecker;
    if(function_exists('Avada')){
      $pb_for_amp[] =  array(
                  'id' => 'ampforwp-avada-pb-for-amp-accor',
                  'type' => 'section',
                  'title' => esc_html__('Avada(Fusion builder) Compatibility', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1, 
              );
      $pb_for_amp[] = array(
                 'id'       => 'ampforwp-avada-pb-for-amp',
                 'type'     => 'switch',
                 'title'    => esc_html__('Avada(Fusion builder) Support','accelerated-mobile-pages'),
                 'tooltip-subtitle' => esc_html__('Enable or Disable the Avada support for AMP', 'accelerated-mobile-pages'),
                 'default'  => false
              );  
    }
    $pb_for_amp[] = $avada_pb_for_ampchecker;
    if(function_exists('avia_lang_setup')){
      $pb_for_amp[] =  array(
                  'id' => 'ampforwp-avia-pb-for-amp-accor',
                  'type' => 'section',
                  'title' => esc_html__('Avia(Enfold) Compatibility', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1, 
              );
      $pb_for_amp[] = array(
                 'id'       => 'ampforwp-avia-pb-for-amp',
                 'type'     => 'switch',
                 'title'    => esc_html__('Avia(Enfold) Support','accelerated-mobile-pages'),
                 'tooltip-subtitle' => esc_html__('Enable or Disable the Avia support for AMP', 'accelerated-mobile-pages'),
                 'default'  => false
              ); 
    }
    $pb_for_amp[] = $avia_pb_for_ampchecker;
    if (is_plugin_active('oxygen/functions.php')) {
      $pb_for_amp[] =  array(
                  'id' => 'ampforwp-oxygen-pb-for-amp-accor',
                  'type' => 'section',
                  'title' => esc_html__('Oxygen Compatibility', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1, 
              );
      $pb_for_amp[] = array(
                 'id'       => 'ampforwp-oxygen-pb-for-amp',
                 'type'     => 'switch',
                 'title'    => esc_html__('Oxygen Support','accelerated-mobile-pages'),
                 'tooltip-subtitle' => esc_html__('Enable or Disable the Oxygen support for AMP', 'accelerated-mobile-pages'),
                 'default'  => false
              ); 
    }
    $pb_for_amp[] = $oxygen_pb_for_ampchecker;
    if(function_exists('flatsome_setup')){
      $pb_for_amp[] =  array(
                    'id' => 'ampforwp-uxpb-for-amp-accordion-section',
                    'type' => 'section',
                    'title' => esc_html__('UX Builder Compatibility', 'accelerated-mobile-pages'),
                    'indent' => true,
                    'layout_type' => 'accordion',
                    'accordion-open'=> 1, 
                );
        $pb_for_amp[] = array(
                   'id'       => 'ampforwp-ux-pb-for-amp',
                   'type'     => 'switch',
                   'title'    => esc_html__('UX Builder Support','accelerated-mobile-pages'),
                   'tooltip-subtitle' => esc_html__('Enable or Disable the UX Builder support for AMP', 'accelerated-mobile-pages'),
                   'default'  => false
                );
    }

    $pb_for_amp[] = $ux_pb_for_ampchecker;
    if (is_plugin_active('beaver-builder-lite-version/fl-builder.php')) {
      $pb_for_amp[] =  array(
                  'id' => 'ampforwp-beaver-pb-for-amp-accor',
                  'type' => 'section',
                  'title' => esc_html__('Beaver Compatibility', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1, 
              );
      $pb_for_amp[] = array(
                 'id'       => 'ampforwp-beaver-pb-for-amp',
                 'type'     => 'switch',
                 'title'    => esc_html__('Beaver Builder Support','accelerated-mobile-pages'),
                 'tooltip-subtitle' => esc_html__('Enable or Disable the Beaver support for AMP', 'accelerated-mobile-pages'),
                 'default'  => false
              ); 
    }
    $pb_for_amp[] = $beaver_builder_pb_for_ampchecker;
    $theme = wp_get_theme();
    if ( 'Betheme' == $theme->name || 'Betheme Child' == $theme) {
      $pb_for_amp[] =  array(
                  'id' => 'ampforwp-muffin-pb-for-amp-accor',
                  'type' => 'section',
                  'title' => esc_html__('Muffin Compatibility', 'accelerated-mobile-pages'),
                  'indent' => true,
                  'layout_type' => 'accordion',
                  'accordion-open'=> 1, 
              );
      $pb_for_amp[] = array(
                 'id'       => 'ampforwp-muffin-pb-for-amp',
                 'type'     => 'switch',
                 'title'    => esc_html__('Muffin Builder Support','accelerated-mobile-pages'),
                 'tooltip-subtitle' => esc_html__('Enable or Disable the Muffin support for AMP', 'accelerated-mobile-pages'),
                 'default'  => false
              ); 
    }
    $pb_for_amp[] = $muffin_builder_pb_for_ampchecker;
    $pb_title = 'Page Builder';
    $theme = wp_get_theme(); // gets the current theme
      if( class_exists('ET_Builder_Plugin') || 'Divi' == $theme->name || 'Divi' == $theme->parent_theme ){
        $pb_title =  'Divi Builder Support';
      }
      if(function_exists('elementor_load_plugin_textdomain')){
        $pb_title =  'Elementor Support';
      }
      if ( class_exists( 'FusionBuilder' ) ) {
        $pb_title =  'Avada Fusion Builder Support';
      }
       if(function_exists('avia_lang_setup')){
        $pb_title =  'Avia Builder Support';
      }
      if(function_exists('flatsome_setup')){
        $pb_title = 'UX Builder Support';
      }
      if(class_exists('FLBuilderAdminPointers')){
        $pb_title = 'Beaver Builder Support';
      }
      if ( 'Betheme' == $theme->name || 'Betheme Child' == $theme) {
        $pb_title = 'Muffin Builder Support';
      }
Redux::setSection( $opt_name, array(
       'title'      => esc_html__( $pb_title, 'accelerated-mobile-pages' ),
       'id'         => 'amp-content-builder',
       'subsection' => true,
       'fields' => $pb_for_amp,
       )
   );
}