<?php
namespace ReduxCore\ReduxFramework;
/* Loader.php is for loading custom extensions for redux and in 
 * accelerated-mobile-pages\includes\options\extensions folder
 * 
 * More on loading on extensions is here https://github.com/ReduxFramework/redux-extensions-loader
*/
if(!function_exists('ampforwp_register_custom_extension_loader')) :
    function ampforwp_register_custom_extension_loader($ReduxFramework) {
        $path    = AMPFORWP_PLUGIN_DIR.'/includes/options/extensions/';
            $folders = scandir( $path, 1 );
            foreach ( $folders as $folder ) {
                if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
                    continue;
                }
                $extension_class = 'ReduxCore\\ReduxFramework\\ReduxFramework_extension_' . $folder;
                if ( ! class_exists( $extension_class ) ) {
                    // In case you wanted override your override, hah.
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
                    if ( $class_file ) {
                        require_once( $class_file );
                    }
                }
                if ( !class_exists('Redux_Framework_Plugin') && ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
                    $ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
                }
            }
    }

    add_action("redux/extensions/redux_builder_amp/before", 'ReduxCore\\ReduxFramework\\ampforwp_register_custom_extension_loader', 0);
endif;