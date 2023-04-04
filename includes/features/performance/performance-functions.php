<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// 86. minify the content of pages
add_filter('ampforwp_the_content_last_filter','ampforwp_minify_html_output');
function ampforwp_minify_html_output($content_buffer){
    $content_buffer = str_replace('srcset=""', '', $content_buffer);
    $content_buffer = preg_replace('/<style amp-runtime(=""|)><\/style>/', '', $content_buffer);
    //Removed trbidi attribute #3687
    $content_buffer = str_replace('trbidi="on"', '', $content_buffer);
    $content_buffer = str_replace("trbidi='on'", '', $content_buffer);
    $content_buffer = str_replace('action=""', 'action-xhr="#"', $content_buffer);
    //Picture-tag is not working in AMP #4051
    if(preg_match('/<picture(.*?)<amp-img(.*?)><\/amp-img>(.*?)<\/picture>/s', $content_buffer)){
        $content_buffer = preg_replace('/<picture(.*?)<amp-img(.*?)><\/amp-img>(.*?)<\/picture>/s', '<noscript><picture$1</picture></noscript><amp-img$2></amp-img>$3', $content_buffer);
    }
    if(class_exists('SiteOrigin_Widgets_Bundle')){
        $content_buffer = preg_replace('/<amp-video id="sow-player(.*?)" class="(.*?)"(.*?)<\/amp-video>/', '<amp-video id="sow-player$1" class="$2" autoplay $3</amp-video>', $content_buffer);
    }
    if(preg_match('/<script type="text\/javascript">.*?NREUM.*?;<\/script>/s', $content_buffer)!=0){
        $content_buffer = preg_replace('/<script type="text\/javascript">.*?NREUM.*?;<\/script>/s', '', $content_buffer);
    }
    $content_buffer = preg_replace('/<div(.*?)class="playbuzz"(.*?)data-id="(.*?)"(.*?)><\/div>/', '<amp-playbuzz data-item="$3" height="1000"></amp-playbuzz>', $content_buffer);
	if (defined('W3TC') && strpos($content_buffer, 'frameborder') !== false) {
		add_filter("w3tc_minify_html_enable",'__return_false');
	}
    if(class_exists('Cli_Optimizer') && preg_match('/<style type="text\/css">@font-face(.*?)<\/style>/s', $content_buffer)!=0){
        $content_buffer = preg_replace('/<style type="text\/css">@font-face(.*?)<\/style>/s', '', $content_buffer);
    }
    if(preg_match('/<script(.*?)type="text\/javascript"(.*?)>[\s\S]*?<\/script>/', $content_buffer) && !ampforwp_get_setting('ampforwp-query-monitor') ){
        $content_buffer = preg_replace('/<script(.*?)type="text\/javascript"(.*?)>[\s\S]*?<\/script>/', '', $content_buffer);
    }
    if(preg_match('/<amp-story-player(.*?)<\/amp-story-player>/s', $content_buffer)){
        $content_buffer = preg_replace('/<amp-story-player(.*?)<\/amp-story-player>/s', '<amp-story-player width="360" height="600" $1</amp-story-player>', $content_buffer);
    }
    if(preg_match('/<input(.*?)type="image"(.*?)>/', $content_buffer)){
        $content_buffer = preg_replace('/<input(.*?)type="image"(.*?)src="(.*?)"(.*?)>/', '<amp-img src="$3" layout="responsive" width="150" height="50" style="width:150px;height:50px;"></amp-img>', $content_buffer);
    }
    if(preg_match('/<figcaption class="ampforwp-blocks-gallery-caption">(.*?)<\/figcaption>/', $content_buffer)){
        $content_buffer = preg_replace('/&lt;/', '<', $content_buffer);
        $content_buffer = preg_replace('/&gt;/', '>', $content_buffer);
    }
    if(function_exists('googlesitekit_activate_plugin') && preg_match('/<script custom-element="amp-auto-ads"(.*?)src="(.*?)" async><\/script>(.*?)<amp-auto-ads/', $content_buffer)==0){
        $content_buffer = preg_replace('/<script custom-element="amp-auto-ads"(.*?)src="(.*?)" async><\/script>/', '', $content_buffer);
    }
    if(preg_match('/<form(.*?)for="categories-dropdown-(.*?)"(.*?)class="postform(.*?)>/', $content_buffer)){
        $content_buffer = preg_replace('/<form(.*?)for="categories-dropdown-(.*?)"(.*?)class="postform(.*?)>/', '<form id="amp-wp-widget-categories-1" on="change:amp-wp-widget-categories-1.submit" $1for="categories-dropdown-$2"$3class="postform$4>', $content_buffer);
    }
    if(preg_match('/<a(.*?)( a )(.*?)<\/a>/', $content_buffer)){
        $content_buffer = preg_replace('/<a(.*?)( a )(.*?)<\/a>/', '<a$1 $3</a>', $content_buffer);
    }
    if(preg_match('/<a(.*?)( a>)(.*?)<\/a>/', $content_buffer)){
        $content_buffer = preg_replace('/<a(.*?)( a>)(.*?)<\/a>/', '<a$1>$3</a>', $content_buffer);
    }
    if (function_exists('aioseo_pro_just_activated') && preg_match('/<link rel="canonical" href="([^>]*)\/amp\/" \/>/', $content_buffer)) {
        $content_buffer = preg_replace('/<link rel="canonical" href="([^>]*)\/amp\/" \/>/','<link rel="canonical" href="$1/" />', $content_buffer);
    }
    if(preg_match('/<script(.*?)src="https:\/\/www.google-analytics.com\/analytics.js"><\/script>/', $content_buffer)){
        $content_buffer = preg_replace('/<script(.*?)src="https:\/\/www.google-analytics.com\/analytics.js"><\/script>/', '', $content_buffer);
    }
    if(preg_match('/<blockquote class="imgur-embed(.*?)"(.*?)data-id="(.*?)"(.*?)<\/blockquote>/', $content_buffer)){
        $content_buffer = preg_replace('/<blockquote class="imgur-embed(.*?)"(.*?)data-id="(.*?)"(.*?)<\/blockquote>/', '<amp-imgur data-imgur-id="$3" layout="responsive" width="500" height="600"></amp-imgur>', $content_buffer);
    }
    if ( class_exists( 'Jetpack' ) && preg_match('/<div(.*?)id="v-(.*?)-(.*?)"(.*?)class="video-player">(.*?)<\/div>/', $content_buffer)) {
        $content_buffer = preg_replace('/<div(.*?)id="v-(.*?)-(.*?)"(.*?)class="video-player">(.*?)<\/div>/', '<div$1id="v-$2-$3"$4class="video-player"><amp-iframe width="300" height="150" sandbox="allow-scripts allow-same-origin" layout="responsive" src="https://videopress.com/embed/$2"></amp-iframe></div>', $content_buffer);
    }
    if (class_exists('AddWidgetAfterContent') && preg_match('/<form(.*?)><label(.*?)for="cat"(.*?)name="cat"(.*?)<\/form>/s', $content_buffer)) {
        $content_buffer = preg_replace('/<form(.*?)><label(.*?)for="cat"(.*?)name="cat"(.*?)<\/form>/s', '<form$1 id="amp-wp-widget-categories-1" on="change:amp-wp-widget-categories-1.submit" target="_top"><label$2for="cat"$3name="cat"$4</form>', $content_buffer);
    }
    if(function_exists('vp_pfui_admin_init') && function_exists('penci_setup') && preg_match('/<amp-iframe src="(.*?)anchor.fm(.*?)"(.*?)<\/amp-iframe>/', $content_buffer)){
        $content_buffer = preg_replace('/<amp-iframe src="(.*?)anchor.fm(.*?)"(.*?)<\/amp-iframe>/', '<amp-iframe src="$1anchor.fm$2" scrolling="no" $3</amp-iframe>', $content_buffer);
    }
    if(class_exists('Mfn_Builder_Front') && preg_match_all('/<div\sclass="section mcb-section(.*?)<div class="amp-wp-content">/s', $content_buffer, $matches)){
        $match = $matches[0][0];
        $mfn_content = str_replace("img", 'amp-img', $match);
        $content_buffer = preg_replace('/<div\sclass="section mcb-section(.*?)<div class="amp-wp-content">/s', $mfn_content , $content_buffer);
    }
    if(preg_match('/<animatetransform(.*?)<\/animatetransform>/', $content_buffer)){
        $content_buffer = preg_replace('/<animatetransform(.*?)<\/animatetransform>/', '', $content_buffer);
    }
    if( function_exists('aioseo') && preg_match('/<script type="text\/javascript"(.*?)>/', $content_buffer)){
        $content_buffer = preg_replace('/<script type="text\/javascript"(.*?)>/', '', $content_buffer); 
        $content_buffer = preg_replace('/window.ga=window.ga||function()(.*?)/', '', $content_buffer); 
        $content_buffer = preg_replace('/\|\|\(\)\{\(ga\.q=ga\.q\|\|\[\]\).push\(arguments\)};ga\.l(.*?);/', '', $content_buffer);
        $content_buffer = preg_replace('/ga\(\'create\',(.*?),\s{\s\'cookieDomain\':\s\'(.*?)\'\s}\s\);/', '', $content_buffer);
        $content_buffer = preg_replace('/ga\(\'(.*?)\',(.*?)\'(.*?)\'\);/', '', $content_buffer);
   }
    if(preg_match('/<picture(.*?)<\/picture>/s', $content_buffer)){
        $content_buffer = preg_replace('/<picture(.*?)<\/picture>/s', '<noscript><picture$1</picture></noscript>', $content_buffer);
    }
    if(class_exists('Avada') && preg_match('/<lite-youtube(.*?)videoid="(.*?)"(.*?)><\/lite-youtube>/s', $content_buffer)){
        $content_buffer = preg_replace('/<lite-youtube(.*?)videoid="(.*?)"(.*?)><\/lite-youtube>/', '<amp-youtube width="480" height="270" layout="responsive" data-videoid="$2"></amp-youtube>', $content_buffer);
    }    
    if (function_exists('qoxag_setup')) {
        $content_buffer = preg_replace('/<link rel="stylesheet"(.*?)href="(.*?).css">/', '', $content_buffer);
    }
    if(preg_match('/<fw-embed-feed(.*?)<\/fw-embed-feed>/', $content_buffer)){
        $content_buffer = preg_replace('/<fw-embed-feed(.*?)<\/fw-embed-feed>/', '', $content_buffer);
    }

    if(preg_match('/<blockquote\sclass="wp-embedded-content"(.*?)<a href="(.*?)"(.*?)<\/blockquote>/', $content_buffer)){
        $content_buffer = preg_replace('/<blockquote\sclass="wp-embedded-content"(.*?)<a href="(.*?)"(.*?)<\/blockquote>/', '<amp-wordpress-embed width="400" height="400" data-url="$2" ></amp-wordpress-embed>', $content_buffer);
        $content_buffer = preg_replace('/<amp-iframe(.*?)class="wp-embedded-content(.*?)<\/amp-iframe>/', '', $content_buffer);
    }
    if (function_exists('wp_faq_schema_load_plugin_textdomain')) {
        $content_buffer = preg_replace('/<div\sclass="">(.*?)<\/div>/s', '$1', $content_buffer);
        $content_buffer = preg_replace('/<h4>/s', '<section><h4>', $content_buffer);
        $content_buffer = preg_replace('/<\/p>/s', '</p></section>', $content_buffer);
        $content_buffer = preg_replace('/<div\sclass="wp-faq-schema-items">(.*?)<\/div>/s', '<amp-accordion expand-single-section>$1</amp-accordion>', $content_buffer);
    } 
   if(preg_match('/<amp-iframe(.*?)src="(.*?)youtube.com\/embed\/(.*?)"(.*?)width="(.*?)"(.*?)height="(.*?)"(.*?)<\/amp-iframe>/', $content_buffer)){
        // Youtube Embed with Query Parameters
        $content_buffer = preg_replace('/<amp-iframe(.*?)src="(.*?)youtube.com\/embed\/(.*?)\?(.*?)"(.*?)width="(.*?)"(.*?)height="(.*?)"(.*?)<\/amp-iframe>/', '<amp-youtube data-videoid="$3" layout="responsive" width="$6" height="$8"></amp-youtube>', $content_buffer);
        $content_buffer = preg_replace('/<amp-iframe(.*?)src="(.*?)youtube.com\/embed\/(.*?)"(.*?)width="(.*?)"(.*?)height="(.*?)"(.*?)<\/amp-iframe>/', '<amp-youtube data-videoid="$3" layout="responsive" width="$5" height="$7"></amp-youtube>', $content_buffer);
    }
    if(preg_match('/<amp-iframe\sclass="instagram-media(.*?)"(.*?)src="https:\/\/instagram.com\/p\/(.*?)\/(.*?)"(.*?)><\/amp-iframe>/', $content_buffer)){
        $content_buffer = preg_replace('/<amp-iframe\sclass="instagram-media(.*?)"(.*?)src="https:\/\/instagram.com\/p\/(.*?)\/(.*?)"(.*?)><\/amp-iframe>/', '<amp-instagram data-shortcode="$3" data-captioned width="400" height="400"layout="responsive"></amp-instagram>', $content_buffer); 
    }

    if(preg_match('/<blockquote\sclass="instagram-media\s(.*?)"(.*?)data-instgrm-permalink="(.*?)p\/(.*?)"(.*?)<\/blockquote>/', $content_buffer)){
        $content_buffer = preg_replace('/<blockquote\sclass="instagram-media\s(.*?)"(.*?)data-instgrm-permalink="(.*?)p\/(.*?)"(.*?)<\/blockquote>/', '<amp-instagram data-shortcode="$4" width="400" height="400"layout="responsive"></amp-instagram>', $content_buffer); 
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
    $buffer = str_ireplace(array ('<script', '/script>', '<pre', '/pre>', '<textarea', '/textarea>', '<style', '/style>','<p', '/p>'), array ('M1N1FY-ST4RT<script', '/script>M1N1FY-3ND', 'M1N1FY-ST4RT<pre', '/pre>M1N1FY-3ND', 'M1N1FY-ST4RT<textarea', '/textarea>M1N1FY-3ND', 'M1N1FY-ST4RT<style', '/style>M1N1FY-3ND','M1N1FY-ST4RT<p', '/p>M1N1FY-3ND'), $buffer);
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

        if(function_exists('tec_amp_compatibility_orgs_venues_support')){
            global $wp;
            $current_url = home_url(add_query_arg(array($_GET), $wp->request));
            if(preg_match('/months/', $current_url)){
                $process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/\s+/' ), array('> ', ' <', '  '), $process);
            }else{
                $process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/\s+/' ), array('> ', ' <', ' '), $process);
            }
        }else{
            if( is_user_logged_in() && class_exists('QM_Plugin') && ampforwp_get_setting('ampforwp-query-monitor')){
                $pref = get_user_option( "show_admin_bar_front", get_current_user_id() );
                if($pref==="true"){
                    $process = preg_replace('/\>[^\S ]+' . $mod, '> ', $process);
                }
            }else{
                $process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/\s+/' ), array('> ', ' <', ' '), $process);
            }
        }

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
    $message .= sprintf( 'Accelerated Mobile Pages: htaccess file is not readable or writable for Leverage Browser Caching. Please change permission of htaccess file and for more info <a href="https://ampforwp.com/tutorials/article/how-to-fix-leverage-browser-caching-error/" target="_blank">%s</a>',esc_html__('Click Here','accelerated-mobile-pages' ));
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
    $expires = ampforwp_get_setting('ampforwp_leverage_browser_caching_expires');
    if (empty($expires)) {
        $expires = '3 month';
    }
    if ($expires == 90) {
        $expires = '3 month';
    }
    else if ($expires == 1) {
        $expires = '1 day';
    }else{
        $expires = $expires . ' days';
    }    
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
    $htaccess_cntn .= 'ExpiresByType text/css "access '.esc_html($expires).'"' . "\n";
    $htaccess_cntn .= 'ExpiresByType text/javascript "access '.esc_html($expires).'"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/javascript "access '.esc_html($expires).'"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/x-javascript "access '.esc_html($expires).'"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/xhtml-xml "access '.esc_html($expires).'"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/pdf "access '.esc_html($expires).'"' . "\n";
    $htaccess_cntn .= 'ExpiresByType application/x-shockwave-flash "access '.esc_html($expires).'"' . "\n";
    $htaccess_cntn .= '</IfModule>' . "\n";
    $htaccess_cntn .= '# END Caching AMPFORWPLBROWSERCEND' . "\n";
    return $htaccess_cntn;
}

function ampforwp_white_list_selectors($completeContent){
    $white_list = array();
    if(ampforwp_get_setting('ampforwp_css_tree_shaking')==1 && ampforwp_get_setting('content-sneak-peek')==1 ){
        $white_list[] = '.hide';
    }
    if(ampforwp_get_setting('ampforwp_css_tree_shaking')==1){
       $white_list[] = '.amp-carousel-img img';
    }
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
        if( function_exists('ampforwp_purify_amphtmls') || ampforwp_get_setting('ampforwp-amp-convert-to-wp') ){
            // compatibility with AMP Pagebuilder Compatibility
            return $completeContent;
        }
        //for fonts
        $completeContent = str_replace(array('"\\', "'\\"), array('":backSlash:',"':backSlash:"), $completeContent);   
        /***Replacements***/
        if(!empty($completeContent)){
            $tmpDoc = AMPforWP\AMPVendor\AMP_DOM_Utils::get_dom_from_content($completeContent); 
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
                
                $data = $obj->get_stylesheets();
                $comment = $obj->get_comments();
                
                foreach($data as $styles){
                    $sheet .= $styles;
                }
                $sheet.=$font_css;
                $sheet.=$white_lists;
                $sheet = stripcslashes($sheet);
                if(strpos($sheet, '-keyframes')!==false){
                    $sheet = preg_replace("/@(-o-|-moz-|-webkit-|-ms-)*keyframes\s(.*?){([0-9%a-zA-Z,\s.]*{(.*?)})*[\s\n]*}/s", "", $sheet);
                }
                
                //TRANSPOSH PLUGIN RTL ISSUE FIXED #3895
                if(class_exists('transposh_plugin')){
                     ampforwp_clear_css_on_transposh_rtl($sheet);
                }
                if(preg_match('/<style\samp-custom>(.*?)<\/style>/s', $completeContent,$matches)){
                    $completeContent = preg_replace("/<style\samp-custom>(.*?)<\/style>/s", "".$comment."<style amp-custom>".$sheet."</style>", $completeContent);
                }else if(preg_match('/<style\samp-custom>(.*)<\/style>/s', $completeContent,$matches)){
                    $completeContent = preg_replace("/<style\samp-custom>(.*)<\/style>/s", "".$comment."<style amp-custom>".$sheet."</style>", $completeContent);
                }else if(preg_match('/<style\samp-custom>.*<\/style>/s', $completeContent,$matches)){
                     $completeContent = preg_replace("/<style\samp-custom>.*<\/style>/s", "".$comment."<style amp-custom>".$sheet."</style>", $completeContent);
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
if((current_user_can('activate_plugins') || current_user_can('deactivate_plugins')) && ampforwp_get_setting( 'ampforwp_css_tree_shaking' ) ){
    add_action('activate_plugin','ampforwp_clear_tree_shaking_on_activity');
    add_action('deactivate_plugin','ampforwp_clear_tree_shaking_on_activity');
}
function ampforwp_clear_tree_shaking_on_activity($plugin='', $network=''){
    if ( (current_user_can('activate_plugins') || current_user_can('deactivate_plugins')) && ampforwp_get_setting( 'ampforwp_css_tree_shaking' ) ){
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
    }
}

add_action( 'save_post', 'ampforwp_clear_tree_shaking_post');
if( !function_exists("ampforwp_clear_tree_shaking_post") ) {
	function ampforwp_clear_tree_shaking_post() {
        global $post;
        $transient_filename = '';
		if ( current_user_can( 'edit_posts' ) && is_user_logged_in() ){
			if(ampforwp_get_setting('ampforwp_css_tree_shaking')){
				if(ampforwp_is_home()){
					$transient_filename = "home";
				}elseif(ampforwp_is_blog()){
					$transient_filename = "blog";
				}elseif(ampforwp_is_front_page()){
					$transient_filename = "post-".ampforwp_get_frontpage_id();
				}elseif(is_singular()){
                    $transient_filename = "post-".ampforwp_get_the_ID();
                }elseif(is_archive()){
                    $page_id = get_queried_object_id();
                    $transient_filename = "archive-".intval($page_id);
                }elseif(is_object($post)){
                    $transient_filename = "post-".$post->ID;
                }               
                if( is_user_logged_in() ){
                    $transient_filename = $transient_filename.'-admin';
                }
                if($transient_filename != ''){
    				$upload_dir = wp_upload_dir();
    				$ts_file = $upload_dir['basedir'] . '/' . 'ampforwp-tree-shaking/_transient_'.esc_attr($transient_filename).".css";
    				if(file_exists($ts_file) && is_file($ts_file)){
    					unlink($ts_file);
    				}
                }
			}
		}
	}
}

if(!function_exists('ampforwp_clear_css_on_transposh_rtl')){
    function ampforwp_clear_css_on_transposh_rtl($css){
        if(class_exists('transposh_plugin')){
            $rtl_lang_arr = array('ar', 'he', 'fa', 'ur', 'yi');
            if(isset($_GET['lang'])){
                if(in_array(esc_attr($_GET['lang']), $rtl_lang_arr)){
                    if(!preg_match('/m-ctr{margin-right:0%}/', $css)){
                        if(ampforwp_get_setting('ampforwp_css_tree_shaking')){
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
                        }
                    }
                }
            }
        }
    }
}
// Tree shaking feature #2949 --- ends here ---