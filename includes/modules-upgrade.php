<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
 add_action('wp_ajax_ampforwp_enable_modules_upgread', 'ampforwp_enable_modules_upgread');
function ampforwp_enable_modules_upgread(){
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'install_plugins' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    $plugins = array();
    $redirectSettingsUrl = '';
    $currentActivateModule = sanitize_text_field( wp_unslash($_REQUEST['activate']));
    switch($currentActivateModule){
        case 'pwa': 
            $nonceUrl = add_query_arg(
                                    array(
                                        'action'        => 'activate',
                                        'plugin'        => 'pwa-for-wp',
                                        'plugin_status' => 'all',
                                        'paged'         => '1',
                                        '_wpnonce'      => wp_create_nonce( 'activate-plugin_pwa-for-wp' ),
                                    ),
                        esc_url(network_admin_url( 'plugins.php' ))
                        );
            $plugins[] = array(
                            'name' => 'pwa-for-wp',
                            'path_' => 'https://downloads.wordpress.org/plugin/pwa-for-wp.zip',
                            'path' => $nonceUrl,
                            'install' => 'pwa-for-wp/pwa-for-wp.php',
                        );
            $redirectSettingsUrl = admin_url('admin.php?page=pwaforwp&reference=ampforwp');
        break;
        case 'structure_data':
            $nonceUrl = add_query_arg(
                                    array(
                                        'action'        => 'activate',
                                        'plugin'        => 'schema-and-structured-data-for-wp',
                                        'plugin_status' => 'all',
                                        'paged'         => '1',
                                        '_wpnonce'      => wp_create_nonce( 'schema-and-structured-data-for-wp' ),
                                    ),
                        network_admin_url( 'plugins.php' )
                        );
            $plugins[] = array(
                            'name' => 'schema-and-structured-data-for-wp',
                            'path_' => 'https://downloads.wordpress.org/plugin/schema-and-structured-data-for-wp.zip',
                            'path' =>  add_query_arg(
                                    array(
                                        'action'        => 'activate',
                                        'plugin'        => 'schema-and-structured-data-for-wp',
                                        'plugin_status' => 'all',
                                        'paged'         => '1',
                                        '_wpnonce'      => $nonceUrl,
                                    )
                                    ),
                            'install' => 'schema-and-structured-data-for-wp/structured-data-for-wp.php',
                        );
            $redirectSettingsUrl = admin_url('admin.php?page=structured_data_options&tab=general&reference=ampforwp');
        break;
        case 'adsforwp':
            $nonceUrl = add_query_arg(
                                    array(
                                        'action'        => 'activate',
                                        'plugin'        => 'ads-for-wp',
                                        'plugin_status' => 'all',
                                        'paged'         => '1',
                                        '_wpnonce'      => wp_create_nonce( 'ads-for-wp' ),
                                    ),
                        network_admin_url( 'plugins.php' )
                        );
            $plugins[] = array(
                            'name' => 'ads-for-wp',
                            'path_' => 'https://downloads.wordpress.org/plugin/ads-for-wp.zip',
                            'path' =>  add_query_arg(
                                    array(
                                        'action'        => 'activate',
                                        'plugin'        => 'ads-for-wp',
                                        'plugin_status' => 'all',
                                        'paged'         => '1',
                                        '_wpnonce'      => $nonceUrl,
                                    )
                                    ),
                            'install' => 'ads-for-wp/ads-for-wp.php',
                        );
            $redirectSettingsUrl = admin_url('edit.php?post_type=adsforwp');
        break;
        case 'wp_quads': 
            $nonceUrl = add_query_arg(
                                    array(
                                        'action'        => 'activate',
                                        'plugin'        => 'quick-adsense-reloaded',
                                        'plugin_status' => 'all',
                                        'paged'         => '1',
                                        '_wpnonce'      => wp_create_nonce( 'activate-plugin_quick-adsense-reloaded' ),
                                    ),
                        esc_url(network_admin_url( 'plugins.php' ))
                        );
            $plugins[] = array(
                            'name' => 'quick-adsense-reloaded',
                            'path_' => 'https://downloads.wordpress.org/plugin/quick-adsense-reloaded.zip',
                            'path' => $nonceUrl,
                            'install' => 'quick-adsense-reloaded/quick-adsense-reloaded.php',
                        );
            $redirectSettingsUrl = admin_url('admin.php?page=quads-settings');        
        break;
        case 'cwvpsb': 
            $nonceUrl = add_query_arg(
                                    array(
                                        'action'        => 'activate',
                                        'plugin'        => 'core-web-vitals-pagespeed-booster',
                                        'plugin_status' => 'all',
                                        'paged'         => '1',
                                        '_wpnonce'      => wp_create_nonce( 'core-web-vitals-pagespeed-booster' ),
                                    ),
                        esc_url(network_admin_url( 'plugins.php' ))
                        );
            $plugins[] = array(
                            'name' => 'core-web-vitals-pagespeed-booster',
                            'path_' => 'https://downloads.wordpress.org/plugin/core-web-vitals-pagespeed-booster.zip',
                            'path' => $nonceUrl,
                            'install' => 'core-web-vitals-pagespeed-booster/core-web-vitals-pagespeed-booster.php',
                        );
            $redirectSettingsUrl = admin_url('admin.php?page=cwvpsb');        
        break;
        default:
            $plugins = array();
        break;
    }
    if(count($plugins)>0){
       echo json_encode( array( "status"=>200, "message"=>"Module successfully Added",'redirect_url'=>esc_url($redirectSettingsUrl) , "slug"=>$plugins[0]['name'], 'path'=> $plugins[0]['path'] ) );
    }else{
        echo json_encode(array("status"=>300, "message"=>"Modules not Found"));
    }
    wp_die();
} 

function ampforwp_admin_notice_module_reference_install() {
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' )) {
        return ;
    }

    $reference = isset($_GET['reference']) ? sanitize_text_field( wp_unslash($_GET['reference'])) : '';
    $page = isset($_GET['page']) ? sanitize_text_field( wp_unslash($_GET['page'])) : '';
    $message = '';
    if($reference=='ampforwp'){
        switch( $page ){
            case 'pwaforwp':
                $message = 'AMPforWP PWA Module has been activated. You may configure it below:';
            break;
            case 'structured_data_options':
                $message = 'AMPforWP Structured data Module has been Upgraded. You may configure it below:';
            break;
            case 'adsforwp_options':
                $message = 'AMPforWP AdsforWP Module has been Upgraded. You may configure it below:';
            break;
        }
    }
    if($message){ ?>
        <div class="notice notice-success is-dismissible">
            <p><?php echo esc_html(  $message, 'accelerated-mobile-pages' ); ?></p>
        </div>
<?php }
}
add_action( 'admin_notices', 'ampforwp_admin_notice_module_reference_install' );




/**
 *  Finish setup and Import default settings 
 *
 */
// Structured Data
//On module upgrade
add_action('wp_ajax_ampforwp_import_modules_scema', 'ampforwp_import_structure_data');
function ampforwp_import_structure_data(){
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'install_plugins' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    global $redux_builder_amp;
    if(get_option('ampforwp_structure_data_module_upgrade')=='migrated'){
        return false;
    }
    $sd_data_update = array();
        //Structure Data
            $sd_data_update['sd-data-logo-ampforwp'] = $redux_builder_amp['amp-structured-data-logo'];
            $sd_data_update['saswp-logo-width'] = $redux_builder_amp['ampforwp-sd-logo-width'];
            $sd_data_update['saswp-logo-height'] = $redux_builder_amp['ampforwp-sd-logo-height'];
            $sd_data_update['saswp-logo-dimensions'] = ($redux_builder_amp['ampforwp-sd-logo-width'] && $redux_builder_amp['ampforwp-sd-logo-height']) ? 1: 0;
            $sd_data_update['sd_default_image'] = $redux_builder_amp['amp-structured-data-placeholder-image'];
            $sd_data_update['sd_default_image_width'] = $redux_builder_amp['amp-structured-data-placeholder-image-width'];
            $sd_data_update['sd_default_image_height'] = $redux_builder_amp['amp-structured-data-placeholder-image-height'];
            $sd_data_update['sd_default_video_thumbnail'] = $redux_builder_amp['amporwp-structured-data-video-thumb-url'];
            $sd_data_update['saswp-for-amp'] = 1;
            $sd_data_update['saswp-for-wordpress'] = 0;
            $ampforwp_sd_type_posts = $redux_builder_amp['ampforwp-sd-type-posts'];
            $ampforwp_sd_type_pages = $redux_builder_amp['ampforwp-sd-type-pages'];
           
            $postarr = array(
                  'post_type'=>'saswp',
                  'post_title'=>'Page (Migrated from AMPforWP)',
                  'post_status'=>'publish',
                     );
            $insertedPageId = wp_insert_post(  $postarr );
            if($insertedPageId){
            $post_data_array  = array(
                                  array(
                                      'key_1'=>'post_type',
                                      'key_2'=>'equal',
                                      'key_3'=>'page',
                                    )
                                  );
            if(defined('SASWP_VERSION') && version_compare(SASWP_VERSION,'1.0.2', '>=')){
                $post_data_array = array();                                       
                $post_data_array['group-0'] =array(
                                                'data_array' => array(
                                                            array(
                                                            'key_1' => 'post_type',
                                                            'key_2' => 'equal',
                                                            'key_3' => 'page',
                                                  )
                                                )               
                                               );
            }
            
            $schema_options_array = array('isAccessibleForFree'=>False,'notAccessibleForFree'=>0,'paywall_class_name'=>'');
            update_post_meta( $insertedPageId, 'data_group_array', $post_data_array);
            update_post_meta( $insertedPageId, 'schema_type', $ampforwp_sd_type_pages);
            update_post_meta( $insertedPageId, 'schema_options', $schema_options_array);
            }
            $postarr = array(
                      'post_type'=>'saswp',
                      'post_title'=>'Post (Migrated from AMPforWP)',
                      'post_status'=>'publish',
                        );
            $insertedPageId = wp_insert_post(  $postarr );
            if($insertedPageId){
                $post_data_array  = array(
                                      array(
                                          'key_1'=>'post_type',
                                          'key_2'=>'equal',
                                          'key_3'=>'post',
                                        )
                                      );
                if(defined('SASWP_VERSION') && version_compare(SASWP_VERSION,'1.0.2', '>=')){
                    $post_data_array = array();                                       
                    $post_data_array['group-0'] =array(
                                                    'data_array' => array(
                                                                array(
                                                                'key_1' => 'post_type',
                                                                'key_2' => 'equal',
                                                                'key_3' => 'post',
                                                      )
                                                    )               
                                                   );
                }
                $schema_options_array = array('isAccessibleForFree'=>False,'notAccessibleForFree'=>0,'paywall_class_name'=>'');
                update_post_meta( $insertedPageId, 'data_group_array', $post_data_array);
                update_post_meta( $insertedPageId, 'schema_type', $ampforwp_sd_type_posts);
                update_post_meta( $insertedPageId, 'schema_options', $schema_options_array);
            }
       
    update_option('sd_data', $sd_data_update);
    update_option('ampforwp_structure_data_module_upgrade','migrated');
    return true;
    wp_die();
}
// AdsforWP
//On module upgrade
add_action('wp_ajax_ampforwp_import_modules_ads', 'ampforwp_import_ads_data');
function ampforwp_import_ads_data(){
    global $redux_builder_amp;
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'install_plugins' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    $adsforwp_object = new adsforwp_admin_common_functions();
    $result = $adsforwp_object->adsforwp_migrate_ampforwp_ads();
    $result = array_filter($result);
    if($result){           
        echo json_encode(array('status'=>'t', 'message'=>esc_html__('Data has been imported succeessfully','accelerated-mobile-pages')));            
    }else{
        echo json_encode(array('status'=>'f', 'message'=>esc_html__('Plugin data is not available or it is not activated','accelerated-mobile-pages')));
    }
    wp_die();  
}       