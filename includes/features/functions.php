<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if(ampforwp_get_setting('amp-gdpr-compliance-switch')) {
    add_amp_theme_support('AMP-gdpr');
}
// Custom AMP Content
require AMPFORWP_PLUGIN_DIR  .'templates/custom-amp-content.php';
// Custom AMPFORWP Sanitizers
require AMPFORWP_PLUGIN_DIR  .'templates/custom-sanitizer.php';
// Load aq resizer only in AMP mode
add_action('pre_amp_render_post','ampforwp_include_aqresizer');
function ampforwp_include_aqresizer(){
    //Removed Jetpack Mobile theme option #2584
    remove_action('option_stylesheet', 'jetpack_mobile_stylesheet');
    require AMPFORWP_PLUGIN_DIR  .'includes/vendor/aq_resizer.php';
    /*
    Enable Treeshaking
    */
    if( ampforwp_get_setting('ampforwp_css_tree_shaking') ){ 
        add_filter('ampforwp_the_content_last_filter','ampforwp_tree_shaking_purify_amphtml',11);
    }
}
 //  Some Extra Styling for Admin area
add_action( 'admin_enqueue_scripts', 'ampforwp_add_admin_styling' );
function ampforwp_add_admin_styling($hook_suffix){
    global $redux_builder_amp, $amp_ux_fields;
    // Style file to add or modify css inside admin area
    wp_register_style( 'ampforwp_admin_css', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/admin-style.css', false, AMPFORWP_VERSION );
    wp_enqueue_style( 'ampforwp_admin_css' );

    // Admin area scripts file
    $dep = array('wp-color-picker');
    $dep = apply_filters('ampforwp_modify_script_dependency', $dep);
    wp_register_script( 'ampforwp_admin_js', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/admin-script.js', $dep , AMPFORWP_VERSION );

    // Localize the script with new data
    $redux_data = array();
    global $pagenow;
    if ('plugins.php' == $pagenow) {
        add_action('admin_notices', 'ampforwp_adpushup_notice' );
    }
    if( current_user_can("manage_options") && $hook_suffix=='toplevel_page_amp_options' ){
        $redux_data = $redux_builder_amp;
        wp_dequeue_script( 'insert-post-adschart-admin' );
        if(function_exists('brokers_page_template_redirect')){
            wp_dequeue_script( 'broker-js' );
            wp_dequeue_script( 'broker-min-js' );
        }
        if(function_exists('html5blank_header_scripts')){
            wp_dequeue_script( 'jquery-js' );
        }
        if(function_exists('megashop_setup')){
            wp_dequeue_script( 'adminjs' );
        }
        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');
        if(class_exists('WC_Ecpay_Apple_Pay')){
            remove_all_actions('admin_footer');
        }
        if (function_exists('wps_pf_pr_filter_register')) {
            wp_dequeue_script('wpspf-main-js-3');
        }
        if (function_exists('aeccglobal_setup')) {
            remove_action( 'admin_footer', 'js_update_show_in_slider' );
        }
        add_action('admin_notices', 'ampforwp_dev_mode_notice');
        add_action('admin_notices', 'ampforwp_plugins_manager_notice');
        add_action('admin_notices', 'ampforwp_ampwptheme_notice');
        add_action('admin_notices', 'ampforwp_automattic_activation' );
        add_action('admin_notices', 'ampforwp_admin_notices' );
        add_action('admin_notices', 'ampforwp_seo_selection_notice' );
        add_action('admin_notices', 'ampforwp_mobile_redirection_notice' );
        add_action('admin_notices', 'ampforwp_category_base_remove_notice' );
        add_action('admin_notices', 'ampforwp_internal_feedback_notice' );
        add_action('admin_notices', 'ampforwp_adpushup_notice' );
        if ( defined('AMPFORWPPRO_PLUGIN_DIR')  ) {     
            $license_info = get_option( 'ampforwppro_license_info');
            if (!$license_info) {
               add_action('admin_notices', 'ampforwp_pro_extension_manager_notice' );
            }
        }
        $setup_ids = array(
                        'ampforwp-ux-website-type-section',
                        'ampforwp-ux-need-type-section',
                        'ampforwp-ux-analytics-section'
                    );
        for($sid = 0; $sid < count($setup_ids); $sid++ ){
            $check = ampforwp_get_setup_info($setup_ids[$sid]);
            if($check == ""){
                add_action('admin_notices', 'ampforwp_incomplate_setup_notice' );
            }
        }
    }else{
        $redux_data['ampforwp-amp-takeover'] =  ampforwp_get_setting('ampforwp-amp-takeover');
    }
    if( current_user_can("manage_options") && $hook_suffix == 'options-reading.php' && 0 == $redux_builder_amp['amp-frontpage-select-option']) {
        $redux_data['frontpage'] = 'false';
        $redux_data['admin_url'] = esc_url(admin_url("admin.php?page=amp_options&tabid=opt-text-subsection#redux_builder_amp-ampforwp-homepage-on-off-support"));
    }
    $amp_fields = json_encode($amp_ux_fields, true);
    $screen = get_current_screen();
    if ( 'toplevel_page_amp_options' == $screen->base ) {
        $opt = get_option("ampforwp_option_panel_view_type");
        wp_localize_script( 'ampforwp_admin_js', 'amp_option_panel_view', array($opt));
    }else{
        $opt = get_option("ampforwp_option_panel_view_type");
        if($opt==1 || $opt==2){
            $opt="3".intval($opt);
        }else{
            $opt = "31";
        }
        wp_localize_script( 'ampforwp_admin_js', 'amp_option_panel_view', array($opt));
    }
    wp_localize_script( 'ampforwp_admin_js', 'amp_fields', array($amp_fields));
    $redux_data = apply_filters("ampforwp_custom_localize_data", $redux_data);
    wp_localize_script( 'ampforwp_admin_js', 'redux_data', $redux_data );
    wp_localize_script( 'ampforwp_admin_js', 'ampforwp_nonce',
        array( 
            'security' => wp_create_nonce( 'ampforwp-verify-request' )
        )
    );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'ampforwp_admin_js' );
}
// 96. ampforwp_is_front_page() ampforwp_is_home() and ampforwp_is_blog is created
function ampforwp_is_front_page(){
    global $redux_builder_amp;
    $front_page = false;
    // Reading settings me frontpage set
    $get_front_page_reading_settings  = get_option('page_on_front');

    // Homepage support on   
    $get_amp_homepage_settings        =  ampforwp_get_setting('ampforwp-homepage-on-off-support');

    // AMP Custom front page from AMP panel
    $get_custom_frontpage_settings    =  ampforwp_get_setting('amp-frontpage-select-option');

    // Frontpage id should be assigned
    if ( ampforwp_get_setting('amp-frontpage-select-option-pages') ) {
        $get_amp_custom_frontpage_id      =  $redux_builder_amp['amp-frontpage-select-option-pages'];
    }
    // Passing Frontpage id true for polylang static pages
    if ( (class_exists('polylang') || class_exists('Polylang_Pro')) && function_exists('poly_archive_url') ) {
        if( !ampforwp_get_setting('amp-frontpage-select-option-pages') && $get_custom_frontpage_settings  && 'page' === get_option( 'show_on_front' )){
            $get_amp_custom_frontpage_id = true;
        }
    }
    // TRUE: When we have "Your latest posts" in reading settings and custom frontpage in amp
    if ( 'posts' == get_option( 'show_on_front') && is_home() && $get_amp_homepage_settings && $get_custom_frontpage_settings)
        $front_page = true;

     // TRUE: When we have " A static page" in reading settings and custom frontpage in amp
    if ( 'page' == get_option( 'show_on_front') && (is_home() || is_front_page()) && $get_front_page_reading_settings && $get_amp_homepage_settings && $get_custom_frontpage_settings && !empty($get_amp_custom_frontpage_id)) {

        $front_page = true;

        $current_page = get_queried_object();
        if ( $current_page ) {
          $current_page =  $current_page->ID;
        }
        if ( get_option( 'page_for_posts') == $current_page ) {
            $front_page = false ;
        }
        
    }

    $front_page = apply_filters('ampforwp_is_front_page', $front_page);
    return $front_page;

}

function ampforwp_is_home(){
    global $redux_builder_amp;

    $output  = false;
    if ( ampforwp_is_front_page() == false && ampforwp_is_blog () == false && is_home() ) {
       $output  = true;
    }
    return $output;
}

function ampforwp_is_blog(){
  $get_blog_details = "";
  $get_blog_details = ampforwp_get_blog_details();

  return $get_blog_details ;
}
// Polylang frontpage
function ampforwp_polylang_front_page() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if( is_plugin_active( 'polylang/polylang.php' )  || is_plugin_active( 'polylang-pro/polylang.php' ) ){
        global $polylang;
        $page_id = $polylang->curlang->page_on_front;
        $frontpage_id = get_option('page_on_front');
        // is_front_page is not working here so had to do this way
        // Check current page id with translated page id
        if ( function_exists('pll_get_post') && $page_id == pll_get_post($frontpage_id) && ! is_page() && ! is_single() && ! is_archive() && ! is_search() && ! ampforwp_is_blog() ){
            return true;
        }
    }
    return false;
}
// Get The ID for AMP #2867
function ampforwp_get_the_ID($post_id=''){
    $post_id = get_the_ID();
    if(ampforwp_is_front_page()){
    $post_id = ampforwp_get_frontpage_id();
    }
    if(ampforwp_is_blog()){
    $post_id = ampforwp_get_blog_details('id');
    }
    return $post_id;
}

// Backward Compatibility
function ampforwp_correct_frontpage() {
    return ampforwp_get_frontpage_id();
}

//Common function to get frontpageID
function ampforwp_get_frontpage_id() {
    $post_id = '';
    if ( ampforwp_is_front_page() ) { 
        $post_id = ampforwp_get_setting('amp-frontpage-select-option-pages');
    }
    $post_id = apply_filters('ampforwp_modify_frontpage_id', $post_id);
    return $post_id;
}

// 27. Clean the Defer issue
// TODO : Get back to this issue. #407
function ampforwp_the_content_filter_full( $content_buffer ) {
    if ((!is_plugin_active('amp/amp.php') && function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) 
        || 
        (function_exists('amp_activate') && function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() )) {
        $content_buffer = preg_replace("/' defer='defer/", "", $content_buffer);
        $content_buffer = preg_replace("/' defer onload='/", "", $content_buffer);
        $content_buffer = preg_replace("/' defer /", "", $content_buffer);
        $content_buffer = preg_replace("/onclick=[^>]*/", "", $content_buffer);
        $content_buffer = preg_replace("/<\\/?thrive_headline(.|\\s)*?>/",'',$content_buffer);
        // Remove Extra styling added by other Themes/ Plugins
        preg_match('/(<style(.*?)>(.*?)<\/style>)<!doctype html>/', $content_buffer, $m1);
        if($m1){
            $content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)<!doctype html>/','<!doctype html>',$content_buffer);
        }
        preg_match('/(<style(.*?)>(.*?)<\/style>)(\/\*)/', $content_buffer, $m2);
        if($m2){
            $content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)(\/\*)/','$4',$content_buffer);
        }
        $content_buffer = preg_replace("/<\\/?g(.|\\s)*?>/",'',$content_buffer);
        $content_buffer = preg_replace('/(<[^>]+) spellcheck="false"/', '$1', $content_buffer);
        $content_buffer = preg_replace('/(<[^>]+) spellcheck="true"/', '$1', $content_buffer);
        $content_buffer = preg_replace("/about:blank/", "#", $content_buffer);
        $content_buffer = preg_replace("/<script data-cfasync[^>]*>.*?<\/script>/", "", $content_buffer);
        $content_buffer = preg_replace('/<font(.*?)>(.*?)<\/font>/', '$2', $content_buffer);
        $content_buffer = preg_replace('/<ta([^a-z]*|\s(.*?))>(.*?)<\/ta>/', '$3', $content_buffer);
        //$content_buffer = preg_replace('/<style type=(.*?)>|\[.*?\]\s\{(.*)\}|<\/style>(?!(<\/noscript>)|(\n<\/head>)|(<noscript>))/','',$content_buffer);

        // xlink attribute causes Validatation Issues #1149
        $content_buffer = preg_replace('/xlink="href"/','',$content_buffer);
        $content_buffer = preg_replace('/!important/', '' , $content_buffer);
        $content_buffer = preg_replace('/<area(.*?)>/', '', $content_buffer);
        //  Compatibility with the footnotes plugin. #2447
        if(class_exists('MCI_Footnotes')){
        $footnote_collapse_link = '';
        $footnote_collapse = false;
        if (method_exists('MCI_Footnotes_Convert', 'toBool')) {
           $footnote_collapse = MCI_Footnotes_Convert::toBool(MCI_Footnotes_Settings::instance()->get(MCI_Footnotes_Settings::C_BOOL_REFERENCE_CONTAINER_COLLAPSE));
        }
        if( $footnote_collapse == true ){
            $footnote_collapse_link = 'on="tap:footnote_references_container.show" role="click" tabindex="1" ';
            $content_buffer = preg_replace( '/<div id=(.*?)footnote_references_container(.*?)\s/m','<div id=$1footnote_references_container$2 hidden ',$content_buffer);
            $content_buffer = preg_replace( '/<div\s(.*?)<a\s(.*?)\+(.*)/m','<div $1 <a on="tap:footnote_references_container.show" $2 + <span on="tap:footnote_references_container.hide" id="fn_span" role="click" tabindex="2" > - </span> $3',$content_buffer);
        }
        $content_buffer = preg_replace( '/<sup(.*?)id="footnote_plugin_tooltip_(.*?)"(.*?)class="footnote_plugin_tooltip_text"(.*?)>(.*?)<\/sup>/m',  '
        <sup$1id="footnote_plugin_tooltip_$2" '.$footnote_collapse_link.' $3class="footnote_plugin_tooltip_text"$4><a href="#footnote_plugin_reference_$2" id="fn_plugin_refer" >$5</a></sup>', $content_buffer);
        }
        $content_buffer = apply_filters('ampforwp_the_content_last_filter', $content_buffer);

    }
    if(function_exists('ampforwp_amp_nonamp_convert') && ampforwp_amp_nonamp_convert("", "check")){
      $content_buffer = ampforwp_amp_nonamp_convert($content_buffer, "filter");
    }
    return $content_buffer;
}
add_action('wp', function(){ ob_start('ampforwp_the_content_filter_full'); }, 999);


// 74. Featured Image check from Custom Fields
function ampforwp_is_custom_field_featured_image(){
    global $redux_builder_amp, $post;
    if(isset($redux_builder_amp['ampforwp-custom-fields-featured-image-switch'], $redux_builder_amp['ampforwp-custom-fields-featured-image']) && $redux_builder_amp['ampforwp-custom-fields-featured-image-switch'] && $redux_builder_amp['ampforwp-custom-fields-featured-image']){
        return true;
        }
    else
        return false;
}

//Meta description #1013
function ampforwp_generate_meta_desc($json=""){
    global $post, $redux_builder_amp;
    $desc = $post_id = '';
    $post_id = ampforwp_get_the_ID();
    if ( true == ampforwp_get_setting('ampforwp-seo-meta-desc') || !empty($json) ) {
        if ( ampforwp_is_home() || ampforwp_is_blog() ) {
            $desc = addslashes( strip_tags( get_bloginfo( 'description' ) ) );
        }
        if ( is_archive() ) {
            $desc = addslashes( strip_tags( get_the_archive_description() ) );
        }
        if ( is_single() || is_page() || ampforwp_is_front_page()) {
            if ( has_excerpt() ) {
                $desc = get_the_excerpt();
            } else {
                $id = ampforwp_get_the_ID();
                $desc = $post->post_content;
            }
            $desc = preg_replace('/\[(.*?)\]/',' ', $desc);
            $desc = addslashes( wp_trim_words( strip_tags( $desc ) , 15 ) );
        }
        if ( is_search() ) {
            $desc = addslashes( ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . ' ' . get_search_query() );
        }
        // Yoast 
        if ( class_exists('WPSEO_Frontend') && ('yoast' == ampforwp_get_setting('ampforwp-seo-selection') || 1 == ampforwp_get_setting('ampforwp-seo-selection')) && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) {
            $front = $yoast_desc = '';
            $front = WPSEO_Frontend::get_instance();
            $yoast_desc = addslashes( strip_tags( $front->metadesc( false ) ) );
            // Static front page
            if ( ampforwp_is_front_page() ) { 
                $post_id = ampforwp_get_frontpage_id();
                if ( class_exists('WPSEO_Meta') ) {
                    $yoast_desc = addslashes( strip_tags( WPSEO_Meta::get_value('metadesc', $post_id ) ) );
                }
            }
            // for search
            if ( is_search() ) {
                $yoast_desc = addslashes( ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . '  ' . get_search_query() );
            }
            if ( $json && false == $redux_builder_amp['ampforwp-seo-yoast-description'] ) {
                $yoast_desc = '';
            }
            if ( $yoast_desc ) {
                $desc = $yoast_desc;
            }
        } 

        // All in One SEO
        if ( class_exists('All_in_One_SEO_Pack') && ( 'aioseo'  == ampforwp_get_setting('ampforwp-seo-selection') || 2 == ampforwp_get_setting('ampforwp-seo-selection'))) {
            $aisop_class = $aisop_desc = $opts = '';
            $aisop_class = new All_in_One_SEO_Pack();
            if ( ampforwp_is_home() ) {
                $post_id = ampforwp_get_blog_details('id');
                $post = get_post($post_id);
            }
            $aisop_desc = $aisop_class->get_aioseop_description($post);
            $opts = $aisop_class->get_current_options( array(), 'aiosp' );
            if ( (is_category() || is_tax() || is_tag()) && $aisop_class->show_page_description() ) {
                $aisop_desc = $opts['aiosp_description'];
            }
            if ( ampforwp_is_front_page() ) {
                $post_id = ampforwp_get_frontpage_id();
                $post = get_post($post_id);
                $aisop_desc = $aisop_class->get_post_description( $post );
            }
            if ( $aisop_desc ) {
                $desc = $aisop_desc;
            }
        }

        //Genesis #1013
        if ( function_exists('genesis_get_seo_meta_description') && 'genesis' == ampforwp_get_setting('ampforwp-seo-selection') ) {
            $genesis_description = '';
            if ( is_home() && is_front_page() && ! ampforwp_get_setting('amp-frontpage-select-option') ) {
                $genesis_description = genesis_get_seo_option( 'home_description' ) ? genesis_get_seo_option( 'home_description' ) : get_bloginfo( 'description' );
            }
            elseif(ampforwp_is_front_page()){
                $genesis_description = strip_tags(genesis_get_custom_field( '_genesis_description', intval($post_id) ));
            }
            elseif ( is_home() && get_option( 'page_for_posts' ) && get_queried_object_id() ) {
                $post_id = get_option( 'page_for_posts' );
                if ( null !== $post_id || is_singular() ) {
                    if ( genesis_get_custom_field( '_genesis_description', intval($post_id) ) ) {
                        $genesis_description = strip_tags(genesis_get_custom_field( '_genesis_description', intval($post_id) ));
                        if ( $genesis_description ) {
                            $desc = $genesis_description;
                        }
                    }
                }
            }
            elseif ( is_home() && ampforwp_get_setting('amp-frontpage-select-option') && get_option( 'page_on_front' ) ) {
                $post_id = get_option('page_on_front');
                if ( null !== $post_id || is_singular() ) {
                    if ( genesis_get_custom_field( '_genesis_description', intval($post_id) ) ) {
                        $genesis_description = strip_tags(genesis_get_custom_field( '_genesis_description', intval($post_id) ));
                        }
                    }
                }
            else {
                $genesis_description = genesis_get_seo_meta_description();
            }

            if ( $genesis_description ) {
                    $desc = esc_html($genesis_description);
                }
        }
        // SEOPress #1589
        if ( is_plugin_active('wp-seopress/seopress.php') && 'seopress' == ampforwp_get_setting('ampforwp-seo-selection') ) {
            $seopress_description = $seopress_options = '';
            $seopress_options = get_option("seopress_titles_option_name");
            if ( get_post_meta($post_id,'_seopress_titles_desc',true) ) {
                $seopress_description = get_post_meta($post_id,'_seopress_titles_desc',true);
            }
            if ( ampforwp_is_home() || ampforwp_is_blog() ) {
                $seopress_variables_array = array('%%sitetitle%%','%%tagline%%');
                $seopress_replace_array = array( get_bloginfo('name'), get_bloginfo('description') );
                $seopress_description = $seopress_options['seopress_titles_home_site_desc'];
                $seopress_description = str_replace($seopress_variables_array, $seopress_replace_array, $seopress_description);

            }
            if ( is_archive() ) {
                $seopress_description = get_term_meta(get_queried_object()->{'term_id'},'_seopress_titles_desc',true);
            }
            if ( $seopress_description ) {
                $desc = $seopress_description;
            }
        }
        // Rank Math SEO #2701
        if ( defined( 'RANK_MATH_FILE' ) && 'rank_math' == ampforwp_get_setting('ampforwp-seo-selection') ) {
            $rank_math_desc = RankMath\Post::get_meta( 'description', $post_id );
            if (ampforwp_is_home()) {
                $rank_math_desc = $desc;
            }
            $desc = $rank_math_desc ? $rank_math_desc : $desc;
        }
        //Bridge Qode SEO Compatibility #2538 
        if ( function_exists('qode_header_meta') && 'bridge' == ampforwp_get_setting('ampforwp-seo-selection')){
        $desc = get_post_meta($post_id, "qode_seo_description", true);
        }
        // The SEO Framework
        if ( function_exists( 'the_seo_framework' ) && 'seo_framework' == ampforwp_get_setting('ampforwp-seo-selection') ) {
            $tsf_desc = $ampforwp_tsf = '';
            $ampforwp_tsf   = \the_seo_framework();
            $tsf_desc       = $ampforwp_tsf->get_description();
            if ( $tsf_desc ) {
                $desc = $tsf_desc;
            }
        }
        // strip_shortcodes  strategy not working here so had to do this way
        // strips shortcodes
        $desc = preg_replace('/\[(.*?)\]/','', $desc);
    }
    return $desc;
}

// 77. AMP Blog Details
if( !function_exists('ampforwp_get_blog_details') ) {
    function ampforwp_get_blog_details( $param = "" ) {
        global $redux_builder_amp;
        $current_url = '';
        $output      = '';
        $slug        = '';
        $title       = '';
        $blog_id     = '';
        $current_url_in_pieces = array();
        if(is_home() && get_option('show_on_front') == 'page' ) {
            $current_url = home_url( $GLOBALS['wp']->request );
            $current_url_in_pieces = explode( '/', $current_url );
            $page_for_posts  =  get_option( 'page_for_posts' );
            if( $page_for_posts ){
                $post = get_post($page_for_posts);
                if ( $post ) {
                    $slug = $post->post_name;
                    $title = $post->post_title;
                    $blog_id = $post->ID;
                }                       
                switch ($param) {
                    case 'title':
                        $output = $title;
                        break;
                    case 'name':
                        $output = $slug;
                        break;
                    case 'id':
                        $output = $blog_id;
                        break;
                    default:
                        if( in_array( $slug , $current_url_in_pieces , true ) || get_query_var('page_id') == $blog_id ) {
                            $output = true;
                        }
                        else
                            $output = false;
                        break;
                }
            }
            else
                $output = false;
        }
        return $output;
    }
}

    // 56. Multi Translation Feature #540
function ampforwp_translation( $redux_style_translation , $pot_style_translation ) {
 $single_translation_enabled = ampforwp_get_setting('amp-use-pot');
   if ( !$single_translation_enabled ) {
     return $redux_style_translation;
   } else {
        if(!empty($redux_style_translation)){
            $pot_style_translation = $redux_style_translation;
        }
        return __($pot_style_translation,'accelerated-mobile-pages');
   }
}

// END Point
function ampforwp_end_point_controller( $url, $check='' ) {
    global $redux_builder_amp;
    $checker = '';
    $endpoint = AMPFORWP_AMP_QUERY_VAR;
    $endpoint = '?' . $endpoint;
    if ( isset($redux_builder_amp['amp-core-end-point']) && true == $redux_builder_amp['amp-core-end-point'] ) {
        $url = untrailingslashit($url.$endpoint);
    }
    else 
        $url = $url . user_trailingslashit( AMP_QUERY_VAR, 'single_amp' );

    return $url;
}

if ( ! function_exists( 'ampforwp_isexternal ') ) {
    function ampforwp_isexternal($url) {
        $components = parse_url($url);

        // we will treat url like '/relative.php' as relative
        if ( empty($components['host']) ) return false;  
        
        // url host looks exactly like the local host
        if ( strcasecmp($components['host'], AMPFROWP_HOST_NAME) === 0 ) return false; 
        
        // check if the url host is a subdomain
        $check =  strrpos(strtolower($components['host']), $_SERVER['HTTP_HOST']) !== strlen($components['host']) - strlen($_SERVER['HTTP_HOST']);// #3561 - it's returing empty that is why it's creating broken link. So checking empty condition and returning 1 to not create amp link.
        if($check==""){ 
            return 1;
        }else{
            return $check; 
        }
    }
} // end ampforwp_isexternal

if(!function_exists('ampforwp_findInternalUrl')){
    function ampforwp_findInternalUrl($url){
        if(function_exists('googlesitekit_activate_plugin')){
            if(strpos($url, '_gl') !== false){
               $url = remove_query_arg( '_gl', $url);
                 //remove ? from jump links.
                 if(strpos($url, '?#') === 0){     
                   $url = str_replace('?#', '#', $url);
                 }
            } 
        }
        global $redux_builder_amp;
        if(isset($redux_builder_amp['convert-internal-nonamplinks-to-amp']) && ! $redux_builder_amp['convert-internal-nonamplinks-to-amp']){
            return $url;
        }
        $get_skip_media_path    = array();
        $skip_media_extensions  = array();
        $get_skip_media_path    = pathinfo($url);
        $skip_media_extensions  = array('jpg','jpeg','gif','png');

        if ( isset( $get_skip_media_path['extension'] ) && !empty($get_skip_media_path['extension'])){
            if (! in_array( $get_skip_media_path['extension'], $skip_media_extensions ) && !strpos(get_option( 'permalink_structure' ), $get_skip_media_path['extension'])){
                $skip_media_extensions[] = $get_skip_media_path['extension'];
            }
        }
        $skip_media_extensions = apply_filters( 'ampforwp_internal_links_skip_media', $skip_media_extensions );

        if ( isset( $get_skip_media_path['extension'] ) ){
            if( in_array( $get_skip_media_path['extension'], $skip_media_extensions ) ) {
                return $url;
            }
        }
        if ( false !== strpos($url, '#') && false === ampforwp_is_amp_inURL($url) && !ampforwp_isexternal($url) ) {
            $url_array = explode('#', $url);
            if ( !empty($url_array) && '' !== $url_array[0]) {
                $url = ampforwp_url_controller($url_array[0]).'#'.$url_array[1];
                return $url;
            }
        }
        if( false === wp_http_validate_url($url) ) {
            return $url;
        }
        if(!ampforwp_isexternal($url) && ampforwp_is_amp_inURL($url)===false){
          // Skip the URL's that have edit link to it
          $parts = parse_url($url);
          if ( isset($parts['query']) && $parts['query']) {
            parse_str($parts['query'], $query);
          }
          if ( (isset( $query['action'] ) && $query['action']) || (isset( $query['amp'] ) && $query['amp'] ) ) {
              return $url;
          }
          $qmarkAmp = (isset($redux_builder_amp['amp-core-end-point']) ? $redux_builder_amp['amp-core-end-point']: false );//amp-core-end-point
          if ( $qmarkAmp ){
            $url = add_query_arg( 'amp', '1', $url);
            return $url;
          }
          else{
            if ( get_option('permalink_structure') ) {
                if ( strpos($url, "?") && strpos($url, "=") ){
                    $url = explode('?', $url);
                    $url = ampforwp_url_controller($url[0]).'?'.$url[1];
                }
                else
                    $url = ampforwp_url_controller($url);
            }
            else
                $url = add_query_arg( 'amp', '1', $url );
          }
          return $url;
        }
        return $url;
    }
} // end ampforwp_findInternalUrl

/* AMPforWP allowed html tags #1950
 * ampforwp_wp_kses_allowed_html()
 * This fucntion can be heavy for sanitizing items.
 * As it scans though all the generated AMP tags and attributes.
 * Use it cautiously.
 */ 
function ampforwp_wp_kses_allowed_html(){
    $allowed_html = $allowed_normal_html = $allowed_amp_tags = array();
    $allowed_normal_html = wp_kses_allowed_html( 'post' );
    if ( class_exists('AMP_Allowed_Tags_Generated') ) {
        $allowed_amp_tags = AMP_Allowed_Tags_Generated::get_allowed_tags();
        $allowed_atts = AMP_Allowed_Tags_Generated::get_allowed_attributes();
        foreach ($allowed_atts as $att => $value) {
            $allowed_atts[$att] = true;
        }
        foreach ($allowed_amp_tags as $amp_tag => $values ) {
                $allowed_amp_tags[$amp_tag] = $allowed_atts;
        }
    }
    $allowed_html = array_merge_recursive($allowed_normal_html, $allowed_amp_tags);
    if( $allowed_html ) {
        foreach ( $allowed_html as $tag => $atts ) {
            if ( is_array($atts) ){
                unset($allowed_html[$tag]['style']);
            }
            if ( 'a' == $tag ) {
                $allowed_html[$tag]['data-toggle'] = true;
            }
            if ( 'label' == $tag ) {
                $allowed_html[$tag]['aria-label'] = true;
            }
            if ( 'amp-img' == $tag ) {
                $allowed_html[$tag] = array('width'=>true,'height'=>true,'src'=>true,'layout'=>true,'alt'=>true,'on'=>true,'role'=>true,'tabindex'=>true);
            }
        }
        $allowed_html['input'] = array('class'=>true,'type'=>true,'id'=>true,'placeholder'=>true,'value'=>true,'name'=>true);
    }
    return $allowed_html; 
}
function ampforwp_wp_kses($data){
    $allowed_html = ampforwp_wp_kses_allowed_html();
    $data = wp_kses( stripslashes( $data ), $allowed_html );
    return $data;
}

//93. added AMP url purifire for amphtml
function ampforwp_url_purifier($url){
    global $wp_query,$wp,$redux_builder_amp;
    $get_permalink_structure    = "";
    $endpoint                   = "";
    $endpointq                  = "";
    $queried_var                = "";
    $quried_value               = "";
    $query_arg                  = "";
    $wpml_lang_checker          = true;
    $endpoint                   = AMPFORWP_AMP_QUERY_VAR;
    $get_permalink_structure = get_option('permalink_structure');
    $checker = $redux_builder_amp['amp-core-end-point'];
    $endpointq = '?' . $endpoint;
    if ( empty( $get_permalink_structure ) ) {
        if ( is_home() || is_archive() || is_front_page() ) {
            $url  = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1', $url);
            if ( is_home() && get_query_var('page_id') == ampforwp_get_blog_details('id') ) {
                $quried_value = get_query_var('page_id');
                if ( '' != $quried_value)
                    $url  = add_query_arg('page_id',$quried_value, $url);
            }
            if ( get_query_var('paged') >= 2 ) {
                $quried_value = get_query_var('paged');
                $url  = add_query_arg('paged',$quried_value, $url);
            }
        }
        if ( is_archive() ) {
            if ( is_archive() ) {
                $queried_var    = 'm';
            }
            if ( is_tag() ) {
                $queried_var    = 'tag';
            }
            if ( is_category() ) {
                $queried_var    = 'cat';
            }
            if ( is_author() ) {
                $queried_var    = 'author';
            }
            $quried_value   = get_query_var($queried_var);
            $url  = add_query_arg($queried_var,$quried_value, $url);
        }
    } else {
        if ( is_singular() && true == $checker ) {
            $url = untrailingslashit($url);
        }
        // WPML compatibility
        if( class_exists('SitePress') ){
        if( get_option('permalink_structure') ){
            global $sitepress_settings, $wp;
            $wpml_lang_checker = false;
            if($sitepress_settings[ 'language_negotiation_type' ] == 3){
                if( is_singular() ){
                    $active_langs = $sitepress_settings['active_languages'];
                    $found = '';
                    $wpml_url =get_permalink( get_queried_object_id() );
                    $untrail_wpml_url = untrailingslashit($wpml_url);
                    $explode_url = explode('/', $untrail_wpml_url);
                    $append_amp = AMPFORWP_AMP_QUERY_VAR;
                    foreach ($active_langs as $active_lang) {
                        foreach($explode_url as $a) {
                             if (stripos('?lang='.$active_lang ,$a) !== false){
                                    $url = add_query_arg('amp','1',$wpml_url);
                                    $found = 'found';
                                    break 2;
                            }
                        }
                    }
                    if($found == ''){
                        array_splice( $explode_url, count($explode_url), 0, $append_amp );
                        $impode_url = implode('/', $explode_url);
                        $url = user_trailingslashit($impode_url);
                    }
                }
                if ( is_home()  || is_archive() ){
                    global $wp;
                    $current_archive_url = home_url( $wp->request );
                    $explode_path   = explode("/",$current_archive_url);
                    $inserted       = array(AMPFORWP_AMP_QUERY_VAR);
                    $query_arg_array = $wp->query_vars;
                    if( array_key_exists( 'paged' , $query_arg_array ) ) {
                        $active_langs = $sitepress_settings['active_languages'];
                         $found = '';
                        foreach ($active_langs as $active_lang) {
                             
                            foreach($explode_path as $a) {
                                 if (stripos('?lang='.$active_lang ,$a) !== false){
                                        $url = add_query_arg('amp','1',$current_archive_url);
                                        $found = 'found';
                                        break 2;
                                }
                            }
                         }
                        if($found == ''){
                            array_splice( $explode_path, count($explode_path), 0, $inserted );
                            $impode_url = implode('/', $explode_path);
                            $url = user_trailingslashit($impode_url);
                         
                        }
                    }
                    else{
                        $active_langs = $sitepress_settings['active_languages'];
                         $found = '';
                        foreach ($active_langs as $active_lang) {
                             
                            foreach($explode_path as $a) {
                                 if (stripos('?lang='.$active_lang ,$a) !== false){
                                    $url = add_query_arg('amp','1',$current_archive_url);
                                    $found = 'found';
                                    break 2;
                                }
                            }
                         }
                        if($found == ''){
                            array_splice( $explode_path, count($explode_path), 0, $inserted );
                            $impode_url = implode('/', $explode_path);
                            $url = $impode_url;
                         
                        }
                    }
                }
            }else{
                $wpml_lang_checker = true;
            }
            }
            $url = esc_url($url);
            $active_langs = $sitepress_settings['active_languages'];
            foreach ($active_langs as $active_lang) {
                if (preg_match('/\?lang='.$active_lang.'/', $url)){
                    $url = str_replace('&#038;amp=1', '', $url);
                    if(false == ampforwp_get_setting('amp-core-end-point')){
                        $url = str_replace('?lang='.$active_lang, 'amp/', $url);
                    }else{
                        $url = str_replace('?lang='.$active_lang, '?amp=1', $url);
                    }
                    $url = add_query_arg( 'lang',$active_lang, $url);
                }
            }
        }
        if ( true == $wpml_lang_checker && ( is_home() || is_archive() || is_front_page() ) ) {
            if ( ( is_archive() || is_home() ) && get_query_var('paged') > 1 ) {
                if ( true == $checker )
                    $url = trailingslashit($url).$endpointq;
                else
                    $url = user_trailingslashit( trailingslashit($url) );
            } else {
                if ( true == $checker && false == strpos($url, $endpointq) )
                    $url =  trailingslashit($url) . $endpointq;
                else {
                    $checker =  explode('/', $url);
                    $amp_check = in_array($endpoint, $checker); 
                    if ( false == $amp_check ) {
                        $url = user_trailingslashit( trailingslashit($url) . $endpoint ); 
                    }
                    if ( true == $amp_check ) {
                        $url =  user_trailingslashit( trailingslashit($url) . $endpoint);
                    }  
                }   
            }
        }
    }
    if ( is_singular() && !empty($_SERVER['QUERY_STRING']) ) {
        $query_arg   = wp_parse_args($_SERVER['QUERY_STRING']);
        $query_name = '';
        if(is_single()){
            $query_name = isset($wp_query->query['name'])?$wp_query->query['name']:'';  
        }
        else{
            $query_name = isset($wp_query->query['pagename'])?$wp_query->query['pagename']:'';
        }
        if ( $query_name && isset( $query_arg['q'] ) ){ 
            unset($query_arg['q']); 
        }      
        $url     = add_query_arg( $query_arg, $url);
    }
    return apply_filters( 'ampforwp_url_purifier', $url );
}
// 98. Create Dynamic url of amp according to the permalink structure #1318
function ampforwp_url_controller( $url, $nonamp = '' ) {
    global $redux_builder_amp;
    $non_amp = false;
    $non_amp = apply_filters( 'ampforwp_non_amp_links', $non_amp );
    if($non_amp == true){
        return $url;
    }
    $new_url = "";
    $get_permalink_structure = "";
    $mob_pres_link = false;
    if(function_exists('ampforwp_mobile_redirect_preseve_link')){
      $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
    }
    if ( ampforwp_amp_nonamp_convert("", "check") || ($mob_pres_link == true || true == ampforwp_get_setting('ampforwp-amp-takeover'))) {
        $nonamp = 'nonamp';
    }
    if ( isset($nonamp) && 'nonamp' == $nonamp ) {
        return $url;
    }
    $get_permalink_structure = get_option('permalink_structure');
    if ( $get_permalink_structure ) {
        if(true == ampforwp_get_setting('amp-core-end-point')){
            $new_url = user_trailingslashit($url);
            $new_url = add_query_arg( 'amp', '', $new_url );
        }
        else {
                $new_url = user_trailingslashit( trailingslashit( $url ) . AMPFORWP_AMP_QUERY_VAR);
            // WPML COMPATIBILITY FOR LOOP 
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
                    global $sitepress_settings,$wp;
                    if($sitepress_settings[ 'language_negotiation_type' ] == 3){
                            $current_archive_url = untrailingslashit($url);
                            $explode_path   = explode("/",$current_archive_url);
                            $inserted       = array(AMPFORWP_AMP_QUERY_VAR);
                            $query_arg_array = $wp->query_vars;
                            $active_langs = $sitepress_settings['active_languages'];
                            $found = '';
                            foreach ($active_langs as $active_lang) {
                                foreach($explode_path as $a) {
                                     if (stripos('?lang='.$active_lang ,$a) !== false){
                                            $new_url = add_query_arg('amp','1',$current_archive_url);
                                            $found = 'found';
                                            break 2;
                                    }
                                }
                             }
                            if($found == ''){
                                array_splice( $explode_path, count($explode_path), 0, $inserted );
                                $impode_url = implode('/', $explode_path);
                                $new_url = $impode_url;
                            }
                        }
                    }
                }
    } else {
        $new_url = add_query_arg( 'amp', '1', $url );
    }
    return esc_url( apply_filters( 'ampforwp_url_controller', $new_url ) );
}

// Function ampforwp_amp_nonamp_convert
if(!function_exists('ampforwp_amp_nonamp_convert')){
    function ampforwp_amp_nonamp_convert($ampData, $type=""){
        $returnData = '';
        if("check" === $type){
            return ampforwp_is_non_amp('non_amp_check_convert');
        }
        if(!ampforwp_is_non_amp('non_amp_check_convert')){
            return $ampData;
        }
        switch($type){
            case 'filter':
                $returnData = str_replace(array(
                                                "amp-img",
                                                "<style amp-custom>",
                                                "<amp-sidebar ",
                                                "</amp-sidebar>",
                                                'on="tap:ampforwpConsent.dismiss"',
                                                '<div id="post-consent-ui"',
                                                'on="tap:ampforwpConsent.reject"',
                                                'on="tap:ampforwpConsent.accept"'
                                                ),
                                            array(
                                                "img",
                                                "<style type=\"text/css\">",
                                                "<sidebar ",
                                                "</sidebar>",
                                                'onClick="ampforwp_gdrp_set()"',
                                                '<script>
                                                function ampforwp_gdpr_getCookie(name) {
                                                  var value = "; " + document.cookie;
                                                  var parts = value.split("; " + name + "=");
                                                  if (parts.length == 2) return parts.pop().split(";").shift();
                                                }
                                                function ampforwp_gdpr(){
                                            if(ampforwp_gdpr_getCookie(\'ampforwpcookie\') == \'1\'){document.getElementById(\'gdpr_c\').remove();}
                                            }ampforwp_gdpr();
                                            function ampforwp_gdrp_set(){document.getElementById(\'ampforwpConsent\').remove(); document.cookie = \'ampforwpcookie=1;expires;path=/\';}
                                                </script><div id="post-consent-ui"',
                                                'onClick="ampforwp_gdrp_set()"',
                                                'onClick="ampforwp_gdrp_set()"',
                                                )
                                            , $ampData);
                // CSS
                
                if( false !== strpos($returnData, 'amp-carousel') ) {
                    $galleryCss = '* {box-sizing: border-box}.mySlides{display: none}
                        /* Slideshow container */
                        .slideshow-container {
                          max-width: 1000px;
                          position: relative;
                          margin: auto;
                        }
                        /* Next & previous buttons */
                        .nonamp-prev, .nonamp-next {
                            cursor: pointer;
                            position: absolute;
                            top: 50%;
                            width: auto;
                            padding: 10px 15px 10px 15px;
                            margin-top: 0;
                            color: white;
                            font-weight: bold;
                            font-size: 16px;
                            transition: 0.6s ease;
                            border-radius: 0 3px 3px 0;
                            user-select: none;
                            background-color: rgba(0,0,0,0.5);
                        }
                        /* Position the "next button" to the right */
                        .nonamp-next {
                          right: 0;
                          border-radius: 3px 0 0 3px;
                        }
                        .nonamp-prev{
                            left:0;
                            border-radius: 3px 0 0 3px;
                        }
                        /* On hover, add a black background color with a little bit see-through */
                        .nonamp-prev:hover, .nonamp-next:hover {
                          color:#fff;
                        }
                        /* Caption text */
                        .text {
                          color: #f2f2f2;
                          font-size: 15px;
                          padding: 8px 12px;
                          position: absolute;
                          bottom: 8px;
                          width: 100%;
                          text-align: center;
                        }
                        /* Number text (1/3 etc) */
                        .numbertext {
                          color: #f2f2f2;
                          font-size: 12px;
                          padding: 8px 12px;
                          position: absolute;
                          top: 0;
                        }
                        /* The dots/bullets/indicators */
                        .dot {
                          cursor: pointer;
                          height: 15px;
                          width: 15px;
                          margin: 0 2px;
                          background-color: #bbb;
                          border-radius: 50%;
                          display: inline-block;
                          transition: background-color 0.6s ease;
                        }
                        .active, .dot:hover {
                          background-color: #717171;
                        }
                        /* Fading animation */
                        .fade {
                          -webkit-animation-name: fade;
                          -webkit-animation-duration: 1.5s;
                          animation-name: fade;
                          animation-duration: 1.5s;
                        }
                        @-webkit-keyframes fade {
                          from {opacity: .4} 
                          to {opacity: 1}
                        }
                        @keyframes fade {
                          from {opacity: .4} 
                          to {opacity: 1}
                        }
                        /* On smaller screens, decrease text size */
                        @media only screen and (max-width: 300px) {
                          .nonamp-prev, .nonamp-next,.text {font-size: 11px}
                        }';
                    $galleryJs = '<script>
                                    var slideIndex = 0;
                                    showSlides(slideIndex);
                                    function plusSlides(n) {
                                      showSlides(slideIndex += n);
                                    }
                                    function currentSlide(n) {
                                      showSlides(slideIndex = n);
                                    }
                                    function showSlides(n) {
                                      var i;
                                      var slides = document.getElementsByClassName("mySlides");
                                      var dots = document.getElementsByClassName("dot");
                                      var heads = document.getElementsByClassName("heads");
                                      if (n >= slides.length) {slideIndex = 0}    
                                      if (n < 0) {slideIndex = slides.length-1}
                                      for (i = 0; i < slides.length; i++) {
                                          slides[i].style.display = "none";  
                                      }
                                      for (i = 0; i < dots.length; i++) {
                                          dots[i].className = dots[i].className.replace(" how-current", "");
                                      }
                                      for (i = 0; i < heads.length; i++) {
                                          heads[i].className = heads[i].className.replace(" how-current", "");
                                      }
                                      slides[slideIndex].style.display = "block";  
                                      dots[slideIndex].className += " how-current";
                                      heads[slideIndex].className += " how-current";
                                    }
                                    function currentDiv(n) {
                                      showDivs(slideIndex = n);
                                    }
                                    function showDivs(n) {
                                      var i;
                                      var x = document.getElementsByClassName("mySlides");
                                      if (n > x.length) {slideIndex = 1}
                                      if (n < 0) {slideIndex = x.length}
                                      for (i = 0; i < x.length; i++) {
                                        x[i].style.display = "none";
                                      }
                                      x[slideIndex].style.display = "block";
                                    }
                                    </script>';
                }

                $nonampCss = '
                .cntr img{width:100%;height:auto !important;}
                img{height:auto;}
                .slid-prv{width:100%;text-align: center;margin-top: 10px;display: inline-block;}
                .amp-featured-image img{width:100%;height:auto;}
                .content-wrapper, .header, .header-2, .header-3{width:100% !important;}
                .image-mod img{width:100%;}
                
                ';
                $re = '/<style\s*type="text\/css">(.*?)<\/style>/si';
                $subst = "<style type=\"text/css\">$1 ".$nonampCss.$galleryCss."</style>";
                $returnData = preg_replace($re, $subst, $returnData);
                $returnData = preg_replace(
                '/<amp-youtube\sdata-videoid="(.*?)"(.*?)><\/amp-youtube>/',
                 '<iframe src="'. esc_url("https://www.youtube.com/embed/$1").'" style="width:100%;height:360px;" ></iframe>', $returnData);
                $returnData = preg_replace_callback(
                '/<amp-iframe(.*?)src="(.*?)"(.*?)><\/amp-iframe>/', 
                function($matches){
                    return '<iframe src="'.esc_url($matches[2]).'" style="width:100%;height:400px;" ></iframe>';
                }, $returnData);
                $returnData = preg_replace_callback('/<amp-carousel\s(.*?)>(.*?)<\/amp-carousel>/s', 'ampforwp_non_amp_gallery', $returnData );
                $returnData = preg_replace('/on="tap(.*?).goToSlide(.*?)"/', 'onclick="currentDiv$2"', $returnData);
                $returnData = preg_replace('/<span on="tap:AMP\.setState\((.*?)\s:\showSectionSelected\.howSlide - 1(.*?)\)(.*?)/', '<span onclick="plusSlides(-1)$3"', $returnData);
                $returnData = preg_replace('/<span on="tap:AMP\.setState\((.*?)\s:\showSectionSelected\.howSlide \+ 1(.*?)\)(.*?)>/', '<span onclick="plusSlides(+1)$3">', $returnData);
                $returnData = str_replace('</footer>', '</footer>'.$galleryJs, $returnData);
            break;
        }
        return $returnData;
    }
}

// wp_update_nav_menu #3052
add_action('wp_update_nav_menu', 'ampforwp_wp_update_nav_menu', 10 , 1 );
if ( ! function_exists('ampforwp_wp_update_nav_menu') ) {
    function ampforwp_wp_update_nav_menu( $menu_id ) {
        if ( false != get_transient('ampforwp_header_menu') ) {
            delete_transient('ampforwp_header_menu');
        }
        if ( false != get_transient('ampforwp_footer_menu') ) {
            delete_transient('ampforwp_footer_menu');
        }
    }
}
// Delete Menu Transients on Saving AMP Settings #3052
if ( ! function_exists('ampforwp_menu_transient_on_save') ){
    function ampforwp_menu_transient_on_save($redux_builder_amp, $this_transients_changed_values) {
        if ( isset($this_transients_changed_values['amp-design-selector']) ) {
            if ( false != get_transient('ampforwp_header_menu') ) {
                    delete_transient('ampforwp_header_menu');
                }
            if ( false != get_transient('ampforwp_footer_menu') ) {
                delete_transient('ampforwp_footer_menu');
            }
        }
    }
}
add_action("redux/options/redux_builder_amp/saved",'ampforwp_menu_transient_on_save', 10, 2);

// Protocol Remover
if ( ! function_exists('ampforwp_remove_protocol') ) {
    function ampforwp_remove_protocol($url){
        $url = preg_replace('#^https?://#', '//', $url);
        return $url;
    }
}
// #3009
if ( ! function_exists('ampforwp_sanitize_i_amphtml') ) {
    function ampforwp_sanitize_i_amphtml($data){
        if(empty($data)){
            return $data;
        }
        $data = preg_replace_callback('/.i-amphtml-(.*?){(.*?)}/s',function($matches){ if(!empty($matched)){ return ''; } }, $data);
        return $data;
    }
}

function checkAMPforPageBuilderStatus($postId){
    global $post;
    $postId = (is_object($post)? $post->ID: '');
    $response =false;
    if( ampforwp_is_front_page() ){
        $postId = ampforwp_get_frontpage_id();
    }
    if ( empty(  $postId ) ) {
        $response = false;
    }else{
        $amp_builder = get_post_field('amp-page-builder',$postId);
        $amp_pd_data = json_decode($amp_builder);
        $ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
        if( $ampforwp_pagebuilder_enable=='yes' && true == ampforwp_get_setting('ampforwp-pagebuilder') && ( function_exists('amppb_post_content') && !empty($amp_pd_data->rows))){
            $response = true;
        }else{
            $response = false;
        }
    }
    $response = apply_filters( 'ampforwp_pagebuilder_status_modify', $response, $postId );
    return $response;
}

// Gallery Code #3296   
function ampforwp_new_gallery_images($images_markup, $image, $markup_arr){
    add_action('amp_post_template_css', 'ampforwp_additional_gallery_style');
    add_filter('amp_post_template_data','ampforwp_carousel_bind_script');
    add_action('amp_post_template_css', 'ampforwp_additional_style_carousel_caption');
    return $images_markup;
}
if( ! function_exists( 'ampforwp_additional_gallery_style' ) ){
    function ampforwp_additional_gallery_style(){
        global $carousel_markup_all;
        $design_type = '';
        $design_type = ampforwp_get_setting('ampforwp-gallery-design-type');
        
        if(isset($design_type) && $design_type!==''){
            echo $carousel_markup_all[$design_type]['gallery_css'];
        }
    }
}
// amp-bind for carousel with captions
function ampforwp_carousel_bind_script($data){
    if( 1 == ampforwp_get_setting('ampforwp-gallery-design-type') || 2 == ampforwp_get_setting('ampforwp-gallery-design-type') ){
        if ( empty( $data['amp_component_scripts']['amp-bind'] ) ) {
            $data['amp_component_scripts']['amp-bind'] = 'https://cdn.ampproject.org/v0/amp-bind-0.1.js';
        }   
    }
    if( 3 == ampforwp_get_setting('ampforwp-gallery-design-type') || true == ampforwp_get_setting('ampforwp-gallery-lightbox') ){
        if ( empty( $data['amp_component_scripts']['amp-image-lightbox'] ) ) {
            $data['amp_component_scripts']['amp-image-lightbox'] = 'https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js';
        }
    }
    return $data;
}
function ampforwp_new_thumbnail_images($amp_images, $uniqueid, $markup_arr){
    if(!isset($markup_arr['carousel_with_thumbnail_html'])){return '';}
    $amp_thumb_image_buttons = array();
    foreach ($amp_images as $key => $value) {
        $returnHtml = $markup_arr['carousel_with_thumbnail_html'];
        $returnHtml = str_replace('{{thumbnail}}', $value , $returnHtml);
        $returnHtml = str_replace('{{unique_id}}', $uniqueid , $returnHtml);
        $returnHtml = str_replace('{{unique_index}}', $key , $returnHtml);
        $amp_thumb_image_buttons[$key] = $returnHtml;
    }
    return $amp_thumb_image_buttons;
}
// Gallery Styling
if( ! function_exists( 'ampforwp_additional_style_carousel_caption' ) ){
  function ampforwp_additional_style_carousel_caption(){ ?>
    .collapsible-captions {--caption-height: 32px; --image-height: 100%; --caption-padding:1rem; --button-size: 28px; --caption-color: #f5f5f5;; --caption-bg-color: #111;}
    .collapsible-captions * {
      -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
      box-sizing: border-box;
    }
    .collapsible-captions .amp-carousel-container  {position: relative; width: 100%;}
    .collapsible-captions amp-img img {object-fit: contain; }
    .collapsible-captions figure { margin: 0; padding: 0; }
    .collapsible-captions figcaption { position: absolute; bottom: 0;width: 100%;
      max-height: var(--caption-height);margin-bottom:0;
      line-height: var(--caption-height);
      padding: 0 var(--button-size) 0 5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      transition: max-height 200ms cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      color: var(--caption-color);
      background: rgba(0, 0, 0, 0.6);   
    }
    .collapsible-captions figcaption.expanded {
      line-height: inherit;
      white-space: normal;
      text-overflow: auto;
      max-height: 100px;
      overflow: auto;
    }
    .collapsible-captions figcaption:focus { outline: none; border: none; }
    .collapsible-captions figcaption span { display: block; position: absolute;
      top: calc((var(--caption-height) - var(--button-size)) / 2);
      right: 2px; width: var(--button-size); height: var(--button-size);
      line-height: var(--button-size); text-align: center; font-size: 12px; color: inherit;
      cursor: pointer; }
  figcaption{ margin-bottom: 20px; }
<?php }
 }

 function ampforwp_role_based_access_options(){
    $user_role = '';
    $user_role = true;
    $currentUser = wp_get_current_user();
    $amp_roles = ampforwp_get_setting('ampforwp-role-based-access');
    $currentuserrole = (array) $currentUser->roles;
    $hasrole = array_intersect( $currentuserrole, $amp_roles );
    if( empty($hasrole)){
        $user_role = false;
    }
    $user_role = apply_filters('ampforwp_modify_user_access_role', $user_role, $currentUser, $amp_roles, $hasrole );
    return $user_role;
}
if(!function_exists('ampforwp_sassy_share_icons')){
    function ampforwp_sassy_share_icons($ampforwp_the_content) {
        if(function_exists('heateor_sss_run')){
            global $heateor_sss;global $post;
            $share_counts = false;
            $sassy_options = $heateor_sss->options;
            $post_url = get_the_permalink($post);
            if(isset($sassy_options['horizontal_counts'])){
                $post_id = ampforwp_get_the_ID();
                if ( $post_id == 'custom' ) {
                    $share_counts =  get_option( 'heateor_sss_custom_url_shares' ) ;
                } elseif ( $post_url == home_url() ) {
                    $share_counts = get_option( 'heateor_sss_homepage_shares' );
                } elseif ( $post_id > 0 ) {
                    $share_counts = get_post_meta( $post_id, '_heateor_sss_shares_meta', true );
                }
                $total_share = 0;
                if(isset($sassy_options['horizontal_re_providers'])){
                    $share_icons = $sassy_options['horizontal_re_providers'];
                    foreach($share_icons as $i){
                        if(isset($share_counts[$i])){
                            $total_share += round($share_counts[$i]);
                        }
                    }
                }
                $_append = '<a class="heateor_sss_amp heateor-total-share-count">
                                <span class="sss_share_count">'.intval($total_share).'</span> <span class="sss_share_lbl">Shares</span></a>';
                preg_match_all('/<div class="heateorSssClear"><\/div><div class="heateor_sss_sharing_container (.*)">(.*)<div class="heateorSssClear"><\/div><\/div><div class="heateorSssClear"><\/div>/', $ampforwp_the_content, $matches);
                
                $_actual = $matches[0];
                if(isset($matches[1][0])){
                $_replace = '<div class="heateorSssClear"></div><div class="heateor_sss_sharing_container '.$matches[1][0].'"></amp-img></a>'.$_append.'</div><div class="heateorSssClear"></div><div class="heateorSssClear"></div>';
                $ampforwp_the_content = str_replace($_actual, $_replace, $ampforwp_the_content);
                }
            }
        }
        return $ampforwp_the_content;
    }
}

// Notice for Dev Mode
function ampforwp_dev_mode_notice(){ 
    global $redux_builder_amp;
    $message = '';
    if(isset($redux_builder_amp['ampforwp-development-mode']) && $redux_builder_amp['ampforwp-development-mode']) {
            $message =  ' Please turn off Development mode, when you are done.';?>
                    
            <div class="notice notice-success amp-dev-notice" style="position:relative;
            height: 40px; overflow: hidden; ">
                <div class="ampforwp-dev-mode-message" style="margin-top: 10px;">
                    <?php echo '<strong>'. esc_html__('AMP Dev mode is Enabled!', 'accelerated-mobile-pages').'</strong>'. esc_html__($message, 'accelerated-mobile-pages'); ?>             
                </div>  
            </div>
<?php }
}

function ampforwp_seo_selection_notice() {
    $seo = '';
    if(function_exists('genesis_theme_support')){
        $seo = 'Genesis';
    }
    if(class_exists('WPSEO_Options')){
        $seo = 'Yoast SEO';
    }
    if(class_exists('All_in_One_SEO_Pack')){
        $seo = 'All in One SEO';
    }
    if(function_exists( 'the_seo_framework' )){
        $seo = 'The SEO Framework';
    }
    if(function_exists('qode_header_meta')){
        $seo = 'Bridge Qode SEO';
    }
    if(defined( 'RANK_MATH_FILE' )){
        $seo = 'Rank Math SEO';
    }
    if(defined( 'SQ_ALL_PATTERNS' )){
        $seo = 'Squirrly SEO';
    }
    if(class_exists('Smartcrawl_Loader')){
        $seo = 'Smartcrawl SEO';
    }
    if(function_exists('seopress_activation')){
        $seo = 'SEO Press';
    }
    $seosel = false;
    if(class_exists('WPSEO_Options') && 'yoast' != ampforwp_get_setting('ampforwp-seo-selection')){ 
        $seosel = true;
    }
    else if (defined( 'RANK_MATH_FILE' ) && 'rank_math' != ampforwp_get_setting('ampforwp-seo-selection')){
         $seosel = true;
    }
    else if (class_exists('All_in_One_SEO_Pack') && 'aioseo' != ampforwp_get_setting('ampforwp-seo-selection')){
         $seosel = true;
    }
    else if (function_exists( 'the_seo_framework' ) && 'seo_framework' != ampforwp_get_setting('ampforwp-seo-selection')){
         $seosel = true;
    }
    else if (defined( 'SQ_ALL_PATTERNS' ) && 'squirrly' != ampforwp_get_setting('ampforwp-seo-selection')){
         $seosel = true;
    }
    else if (class_exists('Smartcrawl_Loader') && 'smartcrawl' != ampforwp_get_setting('ampforwp-seo-selection')){
         $seosel = true;
    }
    else if (function_exists('genesis_theme_support') && 'genesis' != ampforwp_get_setting('ampforwp-seo-selection') && !class_exists('WPSEO_Options') && !defined( 'RANK_MATH_FILE' ) && !class_exists('All_in_One_SEO_Pack') && !defined( 'SQ_ALL_PATTERNS' ) && !class_exists('Smartcrawl_Loader') && !function_exists('seopress_activation')){
         $seosel = true;
    }
    else if (function_exists('seopress_activation') && 'seopress' != ampforwp_get_setting('ampforwp-seo-selection')){
         $seosel = true;
    }
    else if (function_exists('qode_header_meta') && 'bridge' != ampforwp_get_setting('ampforwp-seo-selection')){
         $seosel = true;
    }
    if($seosel && ( '' != ampforwp_get_setting('ampforwp-seo-selection') ) ){
        echo sprintf(('<div class="notice notice-error"><p>%s</p></div>'), esc_html__('Incorrect SEO plugin has been selected in AMPforWP SEO Settings, Please select '.esc_html($seo).' from SEO Settings.','accelerated-mobile-pages'));
    }

    if('' != ampforwp_get_setting('ampforwp-seo-selection')){
        return;
    }
    
    if(!empty($seo)){
        echo sprintf(('<div class="notice notice-error"><p>%s </p></div>'), esc_html__('The configuration of AMPforWP and '.esc_html($seo).' plugin is seems incorrect. Please go to AMPforWP plugin settings -> SEO -> SEO Plugin Integration and select '.esc_html($seo).' plugin from the drop down.','accelerated-mobile-pages'));
    }
}
add_action('wp_ajax_ampforwp_subscribe_newsletter','ampforwp_subscribe_for_newsletter');
add_action('wp_ajax_nopriv_ampforwp_subscribe_newsletter','ampforwp_subscribe_for_newsletter');
function ampforwp_subscribe_for_newsletter(){
    $api_url = 'http://magazine3.company/wp-json/api/central/email/subscribe';
    $api_params = array(
        'name' => sanitize_text_field($_POST['name']),
        'email'=> sanitize_text_field($_POST['email']),
        'website'=> sanitize_text_field($_POST['website']),
        'type'=> 'amp'
    );
    $response = wp_remote_post( $api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
    $response = wp_remote_retrieve_body( $response );
    echo $response;
    die;
}
function ampforwp_mobile_redirection_notice(){
    if(false == ampforwp_get_setting('amp-mobile-redirection')){
        return;
    }
    $plugin = $option = '';
    if(function_exists('rocket_load_textdomain') && 0 == get_rocket_option( 'do_caching_mobile_files' )){
        $plugin = 'WP Rocket';
        $option = 'Separate cache files for mobile devices';
    }
    if(function_exists('wp_super_cache_init_action')) {
        global $wp_cache_mobile_enabled;
        if(0 == $wp_cache_mobile_enabled){
            $plugin = 'WP Super Cache';
            $option = 'Mobile device support';
        }else{
            return;
        }
    }
    if(function_exists('litespeed_purge_single_post') && !LiteSpeed_Cache_Admin_Rules::get_instance()->get_rewrite_rule_mobile_agents()) { 
          $plugin = 'LiteSpeed Cache';
          $option = 'Cache Mobile';
    }
    if(function_exists('wpfastestcache_activate') && 'on' != $GLOBALS["wp_fastest_cache_options"]->wpFastestCacheMobile) {
          $plugin = 'WP Fastest Cache';
          $option = 'Mobile';
    }
    if(!empty($plugin) && !empty($option)){
    echo sprintf(('<div class="notice notice-error"><p>%s <a target="_blank" href="%s">%s</a></p></div>'), esc_html__('You need to enable the option of "'.esc_html($option).'" in '.esc_html($plugin).' plugin for mobile redirection to work properly in AMP','accelerated-mobile-pages'),esc_url('https://ampforwp.com/tutorials/article/how-to-redirect-all-mobile-visitors-to-amp/'),esc_html__('Click here for more info','accelerated-mobile-pages'));  }
 }
function ampforwp_category_base_remove_notice(){
    if(true == ampforwp_get_setting('ampforwp-category-base-removel-link')){
        return;
    }
    if(class_exists('WPSEO_Options') && method_exists('WPSEO_Options', 'get') && WPSEO_Options::get( 'stripcategorybase' ) == true ){
        echo sprintf(('<div class="notice notice-error"><p>%s <a href="%s">%s</a>%s<a href="%s">%s</a></p></div>'), esc_html__('We have detected that you removed Category Base from Yoast SEO plugin but not from AMPforWP settings. Please','accelerated-mobile-pages'),
        esc_url('admin.php?page=amp_options&tab=17'),
        esc_html__('Click here','accelerated-mobile-pages'),
        esc_html__(' to set up to make sure AMP pages work properly on category pages or ','accelerated-mobile-pages'),
        esc_url('https://ampforwp.com/tutorials/article/how-to-remove-the-category-base-in-the-amp/'),esc_html__('Click here for the tutorial','accelerated-mobile-pages'),esc_html__('Click here for the tutorial','accelerated-mobile-pages'));
    }
}

// HIDE/SHOW TAG AND CATEGORY #4326 
function ampforwp_get_taxonomy_meta($term_id,$type=''){
    if($type=='' || $type=='data'){
        $amp_taxonomy = get_term_meta( $term_id,'amp_taxonomy');
        $amp_hide_tax = get_term_meta( $term_id,'amp_hide_tax');
        $data = array('visible'=>$amp_taxonomy,'visible_status'=>$amp_hide_tax);
        return $data;
    }else if($type=='status'){
        $amp_taxonomy = get_term_meta( $term_id,'amp_taxonomy');
        if(isset($amp_taxonomy[0]) && $amp_taxonomy[0]=='hide'){
            return false;
        }else{
            return true;
        }
    }else if($type=='post_status'){
        $term = wp_get_post_terms(ampforwp_get_the_ID(),array('category','post_tag'));
        foreach ($term as $key => $value) {
            $amp_taxonomy = get_term_meta( $value->term_id,'amp_taxonomy');
            $amp_hide_tax = get_term_meta( $value->term_id,'amp_hide_tax');
            if(isset($amp_taxonomy[0]) && $amp_taxonomy[0]=='hide' && $amp_hide_tax[0]=='hide-tax-post'){
                return false;
            }
        }
        return true;
    }
}

function ampforwp_internal_feedback_notice(){
    $install_date = get_option('ampforwp_plugin_info');
    if (isset($install_date["activation_data"])) {
       $install_date = $install_date["activation_data"];
       $install_date = date("m-d-Y", $install_date);
    }
    $activation_never =  get_option("ampforwp_feedback_remove_notice");
    if (strtotime($install_date) < strtotime('-30 days') && $activation_never !='remove') {?>
        <div class="updated notice ampforwp_remove_notice" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);background-color:white;">
            <p> 
            <?php esc_html_e('Awesome, you\'ve been using AMPforWP for more than 1 month. May I ask you to give it a 5-star rating on WordPress.org?', 'accelerated-mobile-pages'); ?></br>
            <?php esc_html_e('This will help spread the word out about this plugin and will encourage us to continue the development.', 'accelerated-mobile-pages'); ?></br>
            <?php esc_html_e('Much appreciated, thank you very much.', 'accelerated-mobile-pages'); ?></br></br>
            <a href="https://wordpress.org/support/plugin/accelerated-mobile-pages/reviews/?rate=5#new-post" class="button-primary" target="_new" style="font-weight:bold;" title="Ok, you deserved it"> <?php echo esc_html__('Ok, You deserve it', 'accelerated-mobile-pages') ?></a>
            <a class="button-primary" id="ampforwp-close-notice" style="font-weight:bold;"><?php echo esc_html__('Not Now', 'accelerated-mobile-pages') ?></a>
            </p>
        </div>
<?php    }
}
function ampforwp_feedback_remove_notice(){     
    $result = update_option( "ampforwp_feedback_remove_notice", 'remove');
    if($result){
        echo json_encode(array('status'=>'t'));            
    }else{    
        echo json_encode(array('status'=>'f'));                
    }   
    wp_die();                
}
add_action('wp_ajax_ampforwp_feedback_remove_notice', 'ampforwp_feedback_remove_notice');

function ampforwp_adpushup_notice(){
    $remove_notice =  get_option("ampforwp_adpushup_remove_notice");
    if ($remove_notice !='remove' && !ampforwp_get_setting('ampforwp-ads-adpushup')) {?>
        <div class="updated notice ampforwp_remove_notice" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);background-color:white;">
            <p> 
            <?php echo sprintf( 'We have integrated <a href="https://ampforwp.com/tutorials/article/how-to-add-adpushup-ads-in-amp" target="_blank">%s</a> in our AMP plugin, it is a revenue optimization platform that helps publishers increase their ad revenue with fast fetch ad delivery and publishers can get upto 2x of the revenue compared to non-optimized pages',esc_html__('AdPushup ads','accelerated-mobile-pages' ));?></p>
            <a href="<?php echo esc_url('admin.php?page=amp_options&tab=4') ?>" class="button-primary" target="_self" style="font-weight:bold;" title="Ok, you deserved it"> <?php echo esc_html__('Setup AdPushup in AMP', 'accelerated-mobile-pages') ?></a>
            <a class="button-primary" id="ampforwp-close-ad-notice" style="font-weight:bold;"><?php echo esc_html__('Dismiss', 'accelerated-mobile-pages') ?></a>
            </p>
        </div>
<?php    }
}

function ampforwp_adpushup_remove_notice(){    
    $result = '';
    if(current_user_can( 'manage_options' )){
       $result = update_option( "ampforwp_adpushup_remove_notice", 'remove');
    }
    if($result){
        echo json_encode(array('status'=>'t'));            
    }else{    
        echo json_encode(array('status'=>'f'));                
    }   
    wp_die();                
}
add_action('wp_ajax_ampforwp_adpushup_remove_notice', 'ampforwp_adpushup_remove_notice');

function ampforwp_pro_extension_manager_notice(){?>
    <div class="updated notice ampforwp_remove_notice" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);background-color:white;">
    <p> 
    <?php echo esc_html__('AMP Pro Extension Manager has been activated, Please enter your license key', 'accelerated-mobile-pages'); ?>
    <a href="<?php echo esc_url(admin_url('admin.php?page=amp-extension-manager')) ?>" style="font-weight:bold;"> <?php echo esc_html__('here', 'accelerated-mobile-pages') ?></a>
    </p>
    </div>
<?php }

function ampforwp_incomplate_setup_notice(){?>
    <div class="updated notice ampforwp_remove_notice">
    <p> 
    <?php esc_html_e('Your setup is not completed. Please setup for better AMP Experience', 'accelerated-mobile-pages'); ?>
    </p>
    </div>
<?php }