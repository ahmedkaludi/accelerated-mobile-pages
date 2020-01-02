<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// 86. minify the content of pages
add_filter('ampforwp_the_content_last_filter','ampforwp_minify_html_output');
function ampforwp_minify_html_output($content_buffer){
    $content_buffer = str_replace('srcset=""', '', $content_buffer);
    //Removed trbidi attribute #3687
    $content_buffer = str_replace('trbidi="on"', '', $content_buffer);
    $content_buffer = str_replace("trbidi='on'", '', $content_buffer);
	if (defined('W3TC') && strpos($content_buffer, 'frameborder') !== false) {
		add_filter("w3tc_minify_html_enable",'__return_false');
	}
    global $redux_builder_amp;
    if(!$redux_builder_amp['ampforwp_cache_minimize_mode']){
           return $content_buffer;       
    }
    $buffer = $content_buffer ; 


    $minify_javascript = 'yes';
    $minify_html_comments = 'yes';
    $minify_html_utf8 = 'yes';
    if ( $minify_html_utf8 == 'yes' && function_exists('mb_detect_encoding') && mb_detect_encoding($buffer, 'UTF-8', true) )
        $mod = '/u';
    else
        $mod = '/s';
    $buffer = str_replace(array (chr(13) . chr(10), chr(9)), array (chr(10), ' '), $buffer);
    $buffer = str_ireplace(array ('<script', '/script>', '<pre', '/pre>', '<textarea', '/textarea>', '<style', '/style>'), array ('M1N1FY-ST4RT<script', '/script>M1N1FY-3ND', 'M1N1FY-ST4RT<pre', '/pre>M1N1FY-3ND', 'M1N1FY-ST4RT<textarea', '/textarea>M1N1FY-3ND', 'M1N1FY-ST4RT<style', '/style>M1N1FY-3ND'), $buffer);
    $split = explode('M1N1FY-3ND', $buffer);
    $buffer = ''; 
    for ($i=0; $i<count($split); $i++) {
        $ii = strpos($split[$i], 'M1N1FY-ST4RT');
        if ($ii !== false) {
            $process = substr($split[$i], 0, $ii);
            $asis = substr($split[$i], $ii + 12);
            if (substr($asis, 0, 7) == '<script') {
                $split2 = explode(chr(10), $asis);
                $asis = '';
                for ($iii = 0; $iii < count($split2); $iii ++) {
                    if ($split2[$iii])
                        $asis .= trim($split2[$iii]) . chr(10);
                    if ( $minify_javascript != 'no' )
                        if (strpos($split2[$iii], '//') !== false && substr(trim($split2[$iii]), -1) == ';' )
                            $asis .= chr(10);
                }
                if ($asis)
                    $asis = substr($asis, 0, -1);
                if ( $minify_html_comments != 'no' )
                    $asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
                if ( $minify_javascript != 'no' )
                    $asis = str_replace(array (';' . chr(10), '>' . chr(10), '{' . chr(10), '}' . chr(10), ',' . chr(10)), array(';', '>', '{', '}', ','), $asis);
            } else if (substr($asis, 0, 6) == '<style') {
                $asis = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $asis);
                if ( $minify_html_comments != 'no' )
                    $asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
                $asis = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}', '::-' ), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ', ', '}', ' ::-'), $asis);
            }
        } else {
            $process = $split[$i];
            $asis = '';
        } 

        $process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/\s+/' ), array('> ', ' <', ' '), $process);

        if ( $minify_html_comments != 'no' )
            $process = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->' . $mod, '', $process);
        $buffer .= $process.$asis;
    }
    $buffer = str_replace(array (chr(10) . '<script', chr(10) . '<style', '*/' . chr(10), 'M1N1FY-ST4RT'), array('<script', '<style', '*/', ''), $buffer);
    $minify_html_xhtml = 'no';
    $minify_html_relative = 'no';
    $minify_html_scheme = 'no';
    if ( $minify_html_xhtml == 'yes' && strtolower( substr( ltrim( $buffer ), 0, 15 ) ) == '<!doctype html>' )
        $buffer = str_replace( ' />', '>', $buffer );
    if ( $minify_html_relative == 'yes' )
        $buffer = str_replace( array ( 'https://' . AMPFROWP_HOST_NAME . '/', 'http://' . AMPFROWP_HOST_NAME . '/', '//' . AMPFROWP_HOST_NAME . '/' ), array( '/', '/', '/' ), $buffer );
    if ( $minify_html_scheme == 'yes' )
        $buffer = str_replace( array( 'http://', 'https://' ), '//', $buffer );
     
    $content_buffer = $buffer ;

    return $content_buffer;

}


if( true == ampforwp_get_setting('ampforwp_leverage_browser_caching_mode')){
    ampforwp_leverage_browser_caching();
}else{
    ampforwp_leverage_browser_caching_remove();
}

function ampforwp_leverage_browser_caching_remove(){
    $htaccess_file = wp_normalize_path( ABSPATH . '.htaccess' );
    if ( file_exists( $htaccess_file ) ) {

        if ( is_readable( $htaccess_file ) && is_writable( $htaccess_file ) ) {
            $unique_string    = 'AMPFORWPLBROWSERCSTART';
            $htaccess_cntn    = file_get_contents( $htaccess_file );
            $valid            = false;

            if ( strpos( $htaccess_cntn, $unique_string ) !== false ) {
                $valid = true;
            }
            if ( $valid ) {
                $pattern          = '/#\s?AMPFORWPLBROWSERCSTART.*?AMPFORWPLBROWSERCEND/s';
                $htaccess_cntn    = preg_replace( $pattern, '', $htaccess_cntn );
                $htaccess_cntn    = preg_replace( "/\n+/","\n", $htaccess_cntn );
                file_put_contents( $htaccess_file, $htaccess_cntn );
            }
        } else {
            
        }
    } else {
        
    }
}
function ampforwp_leverage_browser_caching(){
    global $pagenow;
    $htaccess_file = wp_normalize_path( ABSPATH . '.htaccess' );
    if ( file_exists( $htaccess_file ) ) {
        if ( is_readable( $htaccess_file ) && is_writable( $htaccess_file ) ) {
            $unique_string    = 'AMPFORWPLBROWSERCSTART';
            $htaccess_cntn    = file_get_contents( $htaccess_file );
            $valid            = false;
            if ( strpos( $htaccess_cntn, $unique_string ) !== false ) {
                $valid = true;
            }
            if ( ! $valid ) {
                $htaccess_cntn = $htaccess_cntn . ampforwp_code_to_add_in_htaccess();
                file_put_contents( $htaccess_file, $htaccess_cntn );
            }
        } else {
            if( $pagenow == 'admin.php' && isset($_GET['page']) && esc_attr($_GET['page']) == 'amp_options'){
                add_action( 'admin_notices', 'ampforwp_no_htaccess_access_notice' );
            }
        }
    }else {
        if( $pagenow == 'admin.php' && isset($_GET['page']) && esc_attr($_GET['page']) == 'amp_options'){
            add_action( 'admin_notices', 'ampforwp_no_htaccess_notice');
        }
    }
}

function ampforwp_no_htaccess_access_notice(){
    $message = '<div class="error"><p>';
    $message .= esc_html__( 'Accelerated Mobile Pages: htaccess file is not readable or writable for Leverage Browser Caching. Please change permission of htaccess file.', 'accelerated-mobile-pages' );
    $message .= '</p></div>';
    echo wp_kses_post( $message );
}
function ampforwp_no_htaccess_notice(){
    $message = '<div class="error"><p>';
    $message .= esc_html__( 'Accelerated Mobile Pages: htaccess file not found. Please create htaccess in your root folder. Leverage Browser Caching works only for Apache server at this moment. If you are using NginX then please disable Leverage Browser Caching from AMP options panel -> Performance -> Leverage Browser Caching', 'accelerated-mobile-pages' );
    $message .= '</p></div>';
    echo wp_kses_post( $message );
}
function ampforwp_code_to_add_in_htaccess(){
    $htaccess_cntn  = "\n";
    $htaccess_cntn .= '# AMPFORWPLBROWSERCSTART Browser Caching' . "\n";
    $htaccess_cntn .= '<IfModule mod_expires.c>' . "\n";
    $htaccess_cntn .= 'ExpiresActive On' . "\n";
    $htaccess_cntn .= 'AddType application/vnd.ms-fontobject .eot' . "\n";
    $htaccess_cntn .= 'AddType application/x-font-ttf .ttf' . "\n";
    $htaccess_cntn .= 'AddType application/x-font-opentype .otf' . "\n";
    $htaccess_cntn .= 'AddType application/x-font-woff .woff' . "\n";
    $htaccess_cntn .= 'AddType image/svg+xml .svg' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/vnd.ms-fontobject "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/x-font-ttf "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/x-font-opentype "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/x-font-woff "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType image/svg+xml "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType image/webp "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType image/gif "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType image/jpg "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType image/jpeg "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType image/png "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType image/x-icon "access 1 year"' . "\n";
    $htaccess_cntn .= 'ExpiresByType text/css "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresByType text/javascript "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresByType text/html "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/javascript "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/x-javascript "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/xhtml-xml "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/pdf "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/x-shockwave-flash "access 3 month"' . "\n";
    $htaccess_cntn .= 'ExpiresDefault "access 3 month"' . "\n";
    $htaccess_cntn .= '</IfModule>' . "\n";
    $htaccess_cntn .= '# END Caching AMPFORWPLBROWSERCEND' . "\n";
    return $htaccess_cntn;
}

function ampforwp_white_list_selectors($completeContent){
    $white_list = array();
    $white_list = (array)apply_filters('ampforwp_tree_shaking_white_list_selector',$white_list);
    $w_l_str = '';
    for($i=0;$i<count($white_list);$i++){
        $f = $white_list[$i];
        preg_match_all('/'.$f.'{(.*?)}/s', $completeContent, $matches);
        if(isset($matches[0][0])){
            $w_l_str .= $matches[0][0];
        }
    }
    return $w_l_str;
}
// Tree shaking feature #2949 --- starts here --- 
if( !function_exists("ampforwp_tree_shaking_purify_amphtml") ){
    function ampforwp_tree_shaking_purify_amphtml($completeContent){
        $white_lists = ampforwp_white_list_selectors($completeContent);
        if( function_exists('ampforwp_purify_amphtmls') ){
            // compatibility with AMP Pagebuilder Compatibility
            return $completeContent;
        }
        //for fonts
        $completeContent = str_replace(array('"\\', "'\\"), array('":backSlash:',"':backSlash:"), $completeContent);   
        /***Replacements***/
        if(!empty($completeContent)){
            $tmpDoc = new DOMDocument();
            libxml_use_internal_errors(true);
            $tmpDoc->loadHTML($completeContent);
            $font_css = '';
            if('swift-icons'==ampforwp_get_setting('ampforwp_font_icon')){
                preg_match_all("/@font-face\s\{(.*?)\}/si", $completeContent, $matches);
                foreach ($matches[0] as $key => $value) {
                    $font_css .= $value;
                }
            }
                preg_match_all("/@font-face{(.*?)\}/si", $completeContent, $matches1);
                foreach ($matches1[0] as $key => $value) {
                    $font_css .= $value;
                }

            // AMP_treeshaking_Style_Sanitizer class is added in the vendor/amp/includes/sanitizers
            if( AMPforWP\AMPVendor\AMP_treeshaking_Style_Sanitizer::has_required_php_css_parser()){ 
                $sheet = '';

                $arg['allow_dirty_styles'] = false;
                $obj = new AMPforWP\AMPVendor\AMP_treeshaking_Style_Sanitizer($tmpDoc, $arg);
                $datatrack = $obj->sanitize();
                // return json_encode($datatrack);

                $data = $obj->get_stylesheets();
                //return json_encode($data);

                $comment = $obj->get_comments();
                //return json_encode($comment);

                foreach($data as $styles){
                    $sheet .= $styles;
                }
                $sheet.=$font_css;
                $sheet.=$white_lists;
                $sheet = stripcslashes($sheet);
                if(strpos($sheet, '-keyframes')!==false){
                    $sheet = preg_replace("/@(-o-|-moz-|-webkit-|-ms-)*keyframes\s(.*?){([0-9%a-zA-Z,\s.]*{(.*?)})*[\s\n]*}/s", "", $sheet);
                }
                preg_match('/<style\samp-custom>(.*)<\/style>/s', $completeContent,$matches);
                if($matches){
                    $completeContent = preg_replace("/<style\samp-custom>(.*)<\/style>/s", "".$comment."<style amp-custom>".$sheet."</style>", $completeContent);
                }
                
            }
        }
        //for fonts
        $completeContent = str_replace(array('":backSlash:', "':backSlash:"), array('"\\', "'\\"), $completeContent);
        return $completeContent;
    }
}

add_action( 'wp_ajax_ampforwp_clear_css_tree_shaking', 'ampforwp_clear_tree_shaking');

add_action( 'redux/options/redux_builder_amp/saved', 'ampforwp_clear_tree_shaking',10,2);
if( !function_exists("ampforwp_clear_tree_shaking") ) {
	function ampforwp_clear_tree_shaking( $options = '', $changed_values = array() ) {
		// If the current user don't have proper permission then return
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
        $nonceCheck = false;
        if(isset($_GET['nonce'])){
            $nonceCheck = wp_verify_nonce( $_GET['nonce'], 'ampforwp_clear_tree_shaking' );
        }	
		if ( is_admin() && ( ( $nonceCheck && ampforwp_get_setting( 'ampforwp_css_tree_shaking' ) && $options == '' ) || ( count( $changed_values ) != 0 && (ampforwp_get_setting( 'ampforwp_css_tree_shaking' ) || isset($changed_values['ampforwp_css_tree_shaking'])) ) ) ) {
			$upload_dir   = wp_upload_dir();
			$user_dirname = $upload_dir['basedir'] . '/' . 'ampforwp-tree-shaking';
			if ( file_exists( $user_dirname ) ) {
				$files = glob( $user_dirname . '/*' );
				//Loop through the file list.
				foreach ( $files as $file ) {
					//Make sure that this is a file and not a directory.
					if ( is_file( $file ) && strpos( $file, '_transient' ) !== false ) {
						//Use the unlink function to delete the file.
						unlink( $file );
					}
				}
			}
			if ( $options == '' && ampforwp_get_setting( 'ampforwp_css_tree_shaking' ) ) {
				echo json_encode( array( "status" => 200, "message" => "CSS Cache Cleared Successfully" ) );
				wp_die();
			}
		}
	}
}
add_action( 'save_post', 'ampforwp_clear_tree_shaking_post');
if( !function_exists("ampforwp_clear_tree_shaking_post") ) {
	function ampforwp_clear_tree_shaking_post() {
		if ( current_user_can( 'edit_posts' ) && is_user_logged_in() ){
			if(ampforwp_get_setting('ampforwp_css_tree_shaking')){
				if(ampforwp_is_home()){
					$transient_filename = "home";
				}elseif(ampforwp_is_blog()){
					$transient_filename = "blog";
				}elseif(ampforwp_is_front_page()){
					$transient_filename = "post-".ampforwp_get_frontpage_id();
				}else{
					$transient_filename = "post-".ampforwp_get_the_ID();
				}
				$upload_dir = wp_upload_dir();
				$ts_file = $upload_dir['basedir'] . '/' . 'ampforwp-tree-shaking/_transient_'.esc_attr($transient_filename).".css";
				if(file_exists($ts_file) && is_file($ts_file)){
					unlink($ts_file);
				}
			}
		}
	}

}
// Tree shaking feature #2949 --- ends here ---