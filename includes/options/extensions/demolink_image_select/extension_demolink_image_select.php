<?php
namespace ReduxCore\ReduxFramework;
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;
// Don't duplicate me!
if( !class_exists( 'ReduxFramework_extension_demolink_image_select' ) ) {
    /**
     * Main ReduxFramework demolink_image_select extension class
     *
     * @since       3.1.6
     */
    class ReduxFramework_extension_demolink_image_select {
        
        // Set the version number of your extension here
        public static $version       = '1.0.0';
        // Set the name of your extension here
        public $ext_name             = 'Demolink Image Select';
        
        // Set the minumum required version of Redux here (optional).
        // Leave blank to require no minimum version.
        // This allows you to specify a minimum required version of Redux in the event
        // you do not want to support older versions.
        public $min_redux_version    = '3.0.0';
        // Protected vars
        protected $parent;
        public $extension_url;
        public $extension_dir;
        public static $theInstance;
        /**
        * Class Constructor. Defines the args for the extions class
        *
        * @since       1.0.0
        * @access      public
        * @param       array $sections Panel sections.
        * @param       array $args Class constructor arguments.
        * @param       array $extra_tabs Extra panel tabs.
        * @return      void
        */
        public function __construct( $parent ) {
            
            $this->parent = $parent;
            
            if (is_admin() && !$this->is_minimum_version()) {
                return;
            }
            
            $this->field_name = 'demolink_image_select';
            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', AMPFORWP_EXTENSION_DIR.'/'.$this->field_name ) );
                $this->extension_url = plugin_dir_url(__FILE__);
            }
            
            self::$theInstance = $this;
            add_filter( 'redux/'.$this->parent->args['opt_name'].'/field/class/'.$this->field_name, array( &$this, 'overload_field_path' ) ); // Adds the local field
        }
        public function getInstance() {
            return self::$theInstance;
        }
        // Forces the use of the embeded field path vs what the core typically would use    
        public function overload_field_path($field) {
            return dirname(__FILE__).'/'.$this->field_name.'/field_'.$this->field_name.'.php';
        }
        private function is_minimum_version () {
            $redux_ver = ReduxFramework::$_version;
            if ($this->min_redux_version != '') {
                if (version_compare($redux_ver, $this->min_redux_version) < 0) {
                    $msg = '<strong>' . esc_html__( 'The', 'redux-framework') . ' ' .  $this->ext_name . ' ' .  esc_html__('extension requires', 'redux-framework') . ' Redux Framework ' . esc_html__('version', 'redux-framework') . ' ' . $this->min_redux_version . ' ' .  esc_html__('or higher.','redux-framework' ) . '</strong>&nbsp;&nbsp;' . esc_html__( 'You are currently running', 'redux-framework') . ' Redux Framework ' . esc_html__('version','redux-framework' ) . ' ' . $redux_ver . '.<br/><br/>' . esc_html__('This field will not render in your option panel, and featuress of this extension will not be available until the latest version of','redux-framework' ) . ' Redux Framework ' . esc_html__('has been installed.','redux-framework' );
                    
                    $data = array(
                        'parent'    => $this->parent,
                        'type'      => 'error',
                        'msg'       => $msg,
                        'id'        => $this->ext_name . '_notice_' . self::$version,
                        'dismiss'   => false
                    );
                    
                    if (method_exists('Redux_Admin_Notices', 'set_notice')) {
                        Redux_Admin_Notices::set_notice($data);
                    } else {
                        echo '<div class="error">';
                        echo     '<p>';
                        echo         $msg;
                        echo     '</p>';
                        echo '</div>';
                    }
                    return false;
                }
            }
            
            return true;
        }
    } // class
} // if