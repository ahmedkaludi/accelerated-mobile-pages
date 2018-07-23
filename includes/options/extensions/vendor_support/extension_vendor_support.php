<?php
namespace ReduxCore\ReduxFramework;
    /**
     * The Redux Framework Plugin
     * A simple, truly extensible and fully responsive options framework
     * for WordPress themes and plugins. Developed with WordPress coding
     * standards and PHP best practices in mind.
     * Plugin Name:     Redux Vendor Support
     * Plugin URI:      http://reduxframeworks.com/vendor-support
     * Description:     Registration of Redux support libraries for local installations.
     * Author:          Team Redux
     * Author URI:      http://reduxframework.com
     * Version:         1.0.1
     * Text Domain:     redux-framework
     * License:         GPL3+
     * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
     * Domain Path:     /ReduxFramework/ReduxCore/languages
     * Depends:         ReduxFramework
     *
     * @copyright       2012-2015 Redux Framework
     */

// Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        die;
    }

    if ( ! class_exists( 'ReduxCore\\ReduxFramework\\ReduxFramework_extension_vendor_support' ) ) {
        if ( file_exists( dirname( __FILE__ ) . '/vendor_support/extension_vendor_support.php' ) ) {
            require dirname( __FILE__ ) . '/vendor_support/extension_vendor_support.php';
            new ReduxFramework_extension_vendor_support();
        }
    }