<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Aqua Resizer plugin
 * Version 1.2.2
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://sam.zoy.org/wtfpl/
 *
 * Thanks to Aqua Resizer Team for some excellent contributions!
 *
 *
 * Title         : Aqua Resizer
 * Description   : Resizes WordPress images on the fly
 * Version       : 1.2.2
 * Author        : Syamil MJ
 * Author URI    : http://aquagraphite.com
 * License       : WTFPL - http://sam.zoy.org/wtfpl/
 * Documentation : https://github.com/sy4mil/Aqua-Resizer/
 *
 * @param string  $url      - (required) must be uploaded using wp media uploader
 * @param int     $width    - (required)
 * @param int     $height   - (optional)
 * @param bool    $crop     - (optional) default to soft crop
 * @param bool    $single   - (optional) returns an array if false
 * @param bool    $upscale  - (optional) resizes smaller images
 * @uses  wp_upload_dir()
 * @uses  image_resize_dimensions()
 * @uses  wp_get_image_editor()
 *
 * @return str|array
 */

if(!class_exists('Aq_Resize')) {
    class Aq_Exception extends Exception {}

    class Aq_Resize
    {
        /**
         * The singleton instance
         */
        static private $instance = null;

        /**
         * Should an Aq_Exception be thrown on error?
         * If false (default), then the error will just be logged.
         */
        public $throwOnError = false;

        /**
         * No initialization allowed
         */
        private function __construct() {}

        /**
         * No cloning allowed
         */
        private function __clone() {}

        /**
         * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
         */
        static public function getInstance() {
            if(self::$instance == null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Run, forest.
         */
        public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
            try {
                // Validate inputs.
                if (!$url)
                    throw new Aq_Exception('$url parameter is required');
                if (!$width)
                    throw new Aq_Exception('$width parameter is required');

                // Caipt'n, ready to hook.
                if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

                // Define upload path & dir.
                $upload_info = wp_upload_dir();
                $upload_dir = $upload_info['basedir'];
                $upload_url = $upload_info['baseurl'];

                $http_prefix = "http://";
                $https_prefix = "https://";
                $relative_prefix = "//"; // The protocol-relative URL

                /* if the $url scheme differs from $upload_url scheme, make them match
                   if the schemes differe, images don't show up. */
                if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
                    $upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
                }
                elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
                    $upload_url = str_replace($https_prefix,$http_prefix,$upload_url);
                }
                elseif(!strncmp($url,$relative_prefix,strlen($relative_prefix))){ //if url begins with // make $upload_url begin with // as well
                    $upload_url = str_replace(array( 0 => "$http_prefix", 1 => "$https_prefix"),$relative_prefix,$upload_url);
                }
                $is_cdn  = false;
                $cdn_url = '';
                $cdn_url_main = '';

                // Check if $img_url is not local.
                if ( false === strpos( $url, $upload_url ) ) {
                    $is_cdn  = true;
                    $cdn_url_main = $cdn_url = $url;
                    // Return the original array
                    $wp_upload_dir = wp_upload_dir();
                    $dir_baseurl    = $wp_upload_dir['baseurl'];
                    $dir_baseurl    = explode('/', $dir_baseurl);
                    $dir_name       = end($dir_baseurl); 
                    $cdn_url        = explode($dir_name, $cdn_url);
                    if ( ! isset($cdn_url[1]) ) {
                       $cdn_url = array();
                       $cdn_url[1] = '';
                    }
                    $hybid_url = $upload_url . $cdn_url[1];
                    // this will append crop path in the url to generate the image locally 
                    $url = $hybid_url;
                }
                // Define path of image.
                $rel_path = str_replace( $upload_url, '', $url );
                $img_path = '';
                if($rel_path){
                    $img_path = $upload_dir . $rel_path;
                }

                // Check if img path exists, and is an image indeed.
                if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ){
                    // Return the Original CDN array
                    return array (
                                0 => $cdn_url_main,
                                1 => $width,
                                2 => $height
                            );
                }
                // Get image info.
                $info = pathinfo( $img_path );
                $ext = $info['extension'];
                list( $orig_w, $orig_h ) = getimagesize( $img_path );

                // Get image size after cropping.
                $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
                if(!empty($dims[4])){
                    $dst_w = $dims[4];
                }else{
                    $dst_w = '';
                }
                if(!empty($dims[5])){
                    $dst_h = $dims[5];
                }else{
                    $dst_h = '';
                }
                

                // Return the original image only if it exactly fits the needed measures.
                if ( ! $dims || ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                    $img_url = $url;
                    $dst_w = $orig_w;
                    $dst_h = $orig_h;
                } else {
                    // Use this to check if cropped image already exists, so we can return that instead.
                    $suffix = "{$dst_w}x{$dst_h}";
                    $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                    $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                    if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
                        // Can't resize, so return false saying that the action to do could not be processed as planned.
                        throw new Aq_Exception('Unable to resize image because image_resize_dimensions() failed');
                    }
                    // Else check if cache exists.
                    elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                        $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                    }
                    // Else, we resize the image and return the new resized image url.
                    else {

                        $editor = wp_get_image_editor( $img_path );

                        if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) ) {

                            // Return the Original array
                            return array (
                                        0 => $url,
                                        1 => $width,
                                        2 => $height
                                    );
                        }

                        $resized_file = $editor->save();

                        if ( ! is_wp_error( $resized_file ) ) {
                            $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                            $img_url = $upload_url . $resized_rel_path;
                        } else {
                            throw new Aq_Exception('Unable to save resized image file: ' . $resized_file->get_error_message());
                        }

                    }
                }
                 // Check if it is CDN then reglue the url to its original state
                if ( $is_cdn ) {
                    
                    $img_url = explode('/', $img_url);
                    $cdn_url = explode('/', $cdn_url_main);
                    $img_end = end($img_url);
                    $cdn_end = end($cdn_url);
                    $cdn_url_main = str_replace($cdn_end, $img_end, $cdn_url_main);
                    $img_url = $cdn_url_main;
                }

                // Okay, leave the ship.
                if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

                // Return the output.
                if ( $single ) {
                    // str return.
                    $image = $img_url;
                } else {
                    // array return.
                    $image = array (
                        0 => $img_url,
                        1 => $dst_w,
                        2 => $dst_h
                    );
                }

                return $image;
            }
            catch (Aq_Exception $ex) {
                // Throwing errors for the images stored on CDN #2285
                /*error_log('Aq_Resize.process() error: ' . $ex->getMessage());*/

                if ($this->throwOnError) {
                    // Bubble up exception.
                    throw $ex;
                }
                else {
                    // Return false, so that this patch is backwards-compatible.
                    return false;
                }
            }
        }

        /**
         * Callback to overwrite WP computing of thumbnail measures
         */
        function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            if ( ! $crop ) return null; // Let the wordpress default function handle this.

            // Here is the point we allow to use larger image size than the original one.
            $aspect_ratio = $orig_w / $orig_h;
            $new_w = $dest_w;
            $new_h = $dest_h;

            if ( ! $new_w ) {
                $new_w = intval( $new_h * $aspect_ratio );
            }

            if ( ! $new_h ) {
                $new_h = intval( $new_w / $aspect_ratio );
            }

            $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

            $crop_w = round( $new_w / $size_ratio );
            $crop_h = round( $new_h / $size_ratio );

            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );

            return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
        }
    }
}





if(!function_exists('ampforwp_aq_resize')) {

    /**
     * This is just a tiny wrapper function for the class above so that there is no
     * need to change any code in your own WP themes. Usage is still the same :)
     */
    function ampforwp_aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
        if (empty($url)) {
           return;
        }
        // Disable ampforwp_aq_resize and return images without compressing. 
        // Useful for some who wants to disable when using CDN images 
        $disable_aq_resize = false; 
        if (function_exists('imagify_set_activation') || function_exists('ud_check_stateless_media') || function_exists('webp_express_process_post') || class_exists( 'WP_Offload_Media_Autoloader')) {
            $disable_aq_resize = true; 
        }
        $disable_aq_resize = apply_filters('ampforwp_disable_aq_resize', $disable_aq_resize, $url); 
        if (true === $disable_aq_resize ){ 
            return $image = array( 
                0 => $url, 
                1 => $width, 
                2 => $height, 
            ); 
        }
        /* WPML Fix */
        if ( defined( 'ICL_SITEPRESS_VERSION' ) ){
            global $sitepress;
            $url = $sitepress->convert_url( $url, $sitepress->get_default_language() );
        }
        /* WPML Fix */
         /* EWWW Image Optimizer (ExactDN) Compatible*/
        global $exactdn;
        if ( class_exists( 'ExactDN' ) && $exactdn->get_exactdn_domain() ) {
            $args  = array(
                'resize' => "$width,$height",
            );
            $image = array(
                0 => $exactdn->generate_url( $url, $args ),
                1 => $width,
                2 => $height,
            );
            return $image;
        } 
        /* Jetpack Compatible*/
        elseif( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
            $args = array(
                'resize' => "$width,$height"
            );
             $image = array (
                        0 => jetpack_photon_url( $url, $args ),
                        1 => $width,
                        2 => $height
                    );
            return $image;
        }
        elseif( function_exists('fifu_activate') || is_plugin_active('fifu-premium/fifu-premium.php') ){
            return fifu_amp_url($url, $width, $height); 
        } else if (function_exists('wpp_get_option')){
	        $image = array(
		        0 => $url,
		        1 => $width,
		        2 => $height,
	        );
	        return $image;
        }
        else {
            $aq_resize = Aq_Resize::getInstance();
            return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
        }
    }
}
