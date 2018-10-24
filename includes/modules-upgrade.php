<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
function ampforwp_enable_plugins_modules($plugins)
{
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    $args = array(
            'path' => WP_PLUGIN_DIR .'/',
            'preserve_zip' => false
    );
     foreach($plugins as $plugin)
    {
            $is_downloaded = ampforwp_plugin_download($plugin['path'], $args['path'].$plugin['name'].'.zip');
            if($is_downloaded){
                ampforwp_plugin_unpack($args, $args['path'].$plugin['name'].'.zip');
                ampforwp_plugin_activate($plugin['install']);
            }
    }
}
function ampforwp_plugin_download($url, $path) 
{
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    $response = wp_remote_get( $url );
    if ( is_array( $response ) ) {
      $body = $response['body']; // use the content
      if(file_put_contents($path, $body))
            return true;
        else
            return false;
    }else{
        return false;
    }
}
function ampforwp_plugin_unpack($args, $target)
{
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    if($zip = zip_open($target))
    {
            while($entry = zip_read($zip)){
                    $is_file = substr(zip_entry_name($entry), -1) == '/' ? false : true;
                    $file_path = $args['path'].zip_entry_name($entry);
                    if($is_file){
                            if(zip_entry_open($zip,$entry,"r")){
                                    $fstream = zip_entry_read($entry, zip_entry_filesize($entry));
                                    file_put_contents($file_path, $fstream );
                                    chmod($file_path, 0777);
                            }
                            zip_entry_close($entry);
                    }
                    else{
                            if(zip_entry_name($entry)){
                                    mkdir($file_path);
                                    chmod($file_path, 0777);
                            }
                    }
            }
            zip_close($zip);
    }
    if($args['preserve_zip'] === false)
    {
            unlink($target);
    }
}
function ampforwp_plugin_activate($installer)
{
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    $current = get_option('active_plugins');
    $plugin = plugin_basename(trim($installer));
     if(!in_array($plugin, $current))
    {
            $current[] = $plugin;
            sort($current);
            do_action('activate_plugin', trim($plugin));
            update_option('active_plugins', $current);
            do_action('activate_'.trim($plugin));
            do_action('activated_plugin', trim($plugin));
            return true;
    }
    else{
        return false;
    }
}
 add_action('wp_ajax_ampforwp_enable_modules_upgread', 'ampforwp_enable_modules_upgread');
function ampforwp_enable_modules_upgread(){
    if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'verify_module' ) ) {
        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        exit();
    }
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' ) ) {
        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
        exit();
    }
    $plugins = array();
    $redirectSettingsUrl = '';
    $currentActivateModule = sanitize_text_field( wp_unslash($_REQUEST['activate']));
    switch($currentActivateModule){
        case 'pwa': 
            $plugins[] = array(
                            'name' => 'pwa-for-wp',
                            'path' => 'https://downloads.wordpress.org/plugin/pwa-for-wp.zip',
                            'install' => 'pwa-for-wp/pwa-for-wp.php',
                        );
            $redirectSettingsUrl = admin_url('admin.php?page=pwaforwp&reference=ampforwp');
        break;
        case 'structure_data':
            $plugins[] = array(
                            'name' => 'schema-and-structured-data-for-wp',
                            'path' => 'https://downloads.wordpress.org/plugin/schema-and-structured-data-for-wp.zip',
                            'install' => 'schema-and-structured-data-for-wp/structured-data-for-wp.php',
                        );
            $redirectSettingsUrl = admin_url('admin.php?page=structured_data_options&tab=general&reference=ampforwp');
        break;
        default:
            $plugins = array();
        break;
    }
    if(count($plugins)>0){
       ampforwp_enable_plugins_modules($plugins); 
        //Do's After Activation of plugins
       if($currentActivateModule=='structure_data'){
            ampforwp_import_structure_data();
       }
       echo json_encode( array( "status"=>200, "message"=>"Module successfully Added",'redirect_url'=>$redirectSettingsUrl ) );
    }else{
        echo json_encode(array("status"=>300, "message"=>"Modules not Found"));
    }
    wp_die();
} 


function ampforwp_admin_notice_module_reference_install() {
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' ) && !is_admin() ) {
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
 *  Finish setub and Import default settings 
 *
 */
//On module upgrade
function ampforwp_import_structure_data(){
    // Exit if the user does not have proper permissions
    if(! current_user_can( 'manage_options' ) ) {
        return ;
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
            update_post_meta( $insertedPageId, 'data_array', $post_data_array);
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
                update_post_meta( $insertedPageId, 'data_array', $post_data_array);
                update_post_meta( $insertedPageId, 'schema_type', $ampforwp_sd_type_posts);
                update_post_meta( $insertedPageId, 'schema_options', $schema_options_array);
            }
       
    update_option('sd_data', $sd_data_update);
    update_option('ampforwp_structure_data_module_upgrade','migrated');
    return true;
}   