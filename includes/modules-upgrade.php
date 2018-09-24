<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
function ampforwp_enable_plugins_modules($plugins)
{
    $args = array(
            'path' => ABSPATH.'wp-content/plugins/',
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
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    if(file_put_contents($path, $data))
            return true;
    else
            return false;
}
function ampforwp_plugin_unpack($args, $target)
{
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
                                    //echo "save: ".$file_path."<br />";
                            }
                            zip_entry_close($entry);
                    }
                    else{
                            if(zip_entry_name($entry)){
                                    mkdir($file_path);
                                    chmod($file_path, 0777);
                                    //echo "create: ".$file_path."<br />";
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
    $plugins = array();
    $redirectSettingsUrl = '';
    $currentActivateModule = $_REQUEST['activate'];
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
            update_option('ampforwp_structure_data_module_upgread', true );
       }
       echo json_encode( array( "status"=>200, "message"=>"Module successfully Added",'redirect_url'=>$redirectSettingsUrl ) );
    }else{
        echo json_encode(array("status"=>300, "message"=>"Modules not Found"));
    }
    wp_die();
} 


function ampforwp_admin_notice_module_reference_install() {
    $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : '';
    $message = '';
    if($reference=='ampforwp'){
        switch( $page ){
            case 'pwaforwp':
                $message = 'AMPforWP PWA Module has been activated. You may configure it below:';
            break;
            case 'structured_data_options':
                $message = 'You are welcome AMP Upgread Modules of schema and structured data for wp';
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