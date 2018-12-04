<?php 
 add_amp_theme_support('AMP-gdpr');
 //  Some Extra Styling for Admin area
add_action( 'admin_enqueue_scripts', 'ampforwp_add_admin_styling' );
function ampforwp_add_admin_styling(){
    global $redux_builder_amp;
    // Style file to add or modify css inside admin area
    wp_register_style( 'ampforwp_admin_css', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/admin-style.css', false, AMPFORWP_VERSION );
    wp_enqueue_style( 'ampforwp_admin_css' );

    // Admin area scripts file
    wp_register_script( 'ampforwp_admin_js', untrailingslashit(AMPFORWP_PLUGIN_DIR_URI) . '/includes/admin-script.js', false, AMPFORWP_VERSION );

    // Localize the script with new data
    wp_localize_script( 'ampforwp_admin_js', 'redux_data', $redux_builder_amp );

    wp_enqueue_script( 'ampforwp_admin_js' );
}
// 96. ampforwp_is_front_page() ampforwp_is_home() and ampforwp_is_blog is created
function ampforwp_is_front_page(){
    global $redux_builder_amp;

    // Reading settings me frontpage set
    $get_front_page_reading_settings  = get_option('page_on_front');

    // Homepage support on   
    $get_amp_homepage_settings        =  $redux_builder_amp['ampforwp-homepage-on-off-support'];

    // AMP Custom front page from AMP panel
    $get_custom_frontpage_settings    =  $redux_builder_amp['amp-frontpage-select-option'];

    // Frontpage id should be assigned
    if ( isset($redux_builder_amp['amp-frontpage-select-option-pages'])) {
        $get_amp_custom_frontpage_id      =  $redux_builder_amp['amp-frontpage-select-option-pages'];
    }

    // TRUE: When we have "Your latest posts" in reading settings and custom frontpage in amp
    if ( 'posts' == get_option( 'show_on_front') && is_home() && $get_amp_homepage_settings && $get_custom_frontpage_settings)
        return true;

     // TRUE: When we have " A static page" in reading settings and custom frontpage in amp
    if ( 'page' == get_option( 'show_on_front') && (is_home() || is_front_page()) && $get_front_page_reading_settings && $get_amp_homepage_settings && $get_custom_frontpage_settings && $get_amp_custom_frontpage_id) {

        $current_page = get_queried_object();
        if ( $current_page ) {
          $current_page =  $current_page->ID;
        }
        if ( get_option( 'page_for_posts') == $current_page ) {
            return false ;
        }
        return true;
    }

  return false ;

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

// 27. Clean the Defer issue
// TODO : Get back to this issue. #407
function ampforwp_the_content_filter_full( $content_buffer ) {
    if ((!is_plugin_active('amp/amp.php') && function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) 
        || 
        (is_plugin_active('amp/amp.php') && function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() )) {
        $content_buffer = preg_replace("/' defer='defer/", "", $content_buffer);
        $content_buffer = preg_replace("/' defer onload='/", "", $content_buffer);
        $content_buffer = preg_replace("/' defer /", "", $content_buffer);
        $content_buffer = preg_replace("/onclick=[^>]*/", "", $content_buffer);
        $content_buffer = preg_replace("/<\\/?thrive_headline(.|\\s)*?>/",'',$content_buffer);
        // Remove Extra styling added by other Themes/ Plugins
        $content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)<!doctype html>/','<!doctype html>',$content_buffer);
        $content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)(\/\*)/','$4',$content_buffer);
        $content_buffer = preg_replace("/<\\/?g(.|\\s)*?>/",'',$content_buffer);
        $content_buffer = preg_replace('/(<[^>]+) spellcheck="false"/', '$1', $content_buffer);
        $content_buffer = preg_replace('/(<[^>]+) spellcheck="true"/', '$1', $content_buffer);
        $content_buffer = preg_replace("/about:blank/", "#", $content_buffer);
        $content_buffer = preg_replace("/<script data-cfasync[^>]*>.*?<\/script>/", "", $content_buffer);
        $content_buffer = preg_replace('/<font(.*?)>(.*?)<\/font>/', '$2', $content_buffer);
        //$content_buffer = preg_replace('/<style type=(.*?)>|\[.*?\]\s\{(.*)\}|<\/style>(?!(<\/noscript>)|(\n<\/head>)|(<noscript>))/','',$content_buffer);

        // xlink attribute causes Validatation Issues #1149
        $content_buffer = preg_replace('/xlink="href"/','',$content_buffer);
        $content_buffer = preg_replace('/!important/', '' , $content_buffer);

        $content_buffer = apply_filters('ampforwp_the_content_last_filter', $content_buffer);

    }
    if(function_exists('ampforwp_amp_nonamp_convert') && ampforwp_amp_nonamp_convert("", "check")){
      $content_buffer = ampforwp_amp_nonamp_convert($content_buffer, "filter");
    }
    return $content_buffer;
}
add_action('wp_loaded', function(){ ob_start('ampforwp_the_content_filter_full'); }, 999);


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
    if ( $redux_builder_amp['ampforwp-seo-meta-description'] ) {
        if ( ampforwp_is_home() || ampforwp_is_blog() ) {
            $desc = addslashes( strip_tags( get_bloginfo( 'description' ) ) );
        }
        if ( is_archive() ) {
            $desc = addslashes( strip_tags( get_the_archive_description() ) );
        }
        if ( is_single() || is_page() ) {
            if ( has_excerpt() ) {
                $desc = get_the_excerpt();
            } else {
                global $post;
                $id = $post->ID;
                $desc = $post->post_content;
            }
            $desc = preg_replace('/\[(.*?)\]/',' ', $desc);
            $desc = addslashes( wp_trim_words( strip_tags( $desc ) , '15' ) );
        }
        if ( is_search() ) {
            $desc = addslashes( ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . ' ' . get_search_query() );
        }
        if ( ampforwp_is_front_page() ) {
            $post_id = ampforwp_get_frontpage_id();
            $desc = addslashes( wp_trim_words(  strip_tags( get_post_field('post_content', $post_id) ) , '15' ) );
        }

        // Yoast 
        if ( class_exists('WPSEO_Frontend') && 1 == $redux_builder_amp['ampforwp-seo-selection'] ) {
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
        if ( class_exists('All_in_One_SEO_Pack') && 2 == $redux_builder_amp['ampforwp-seo-selection'] ) {
            $aisop_class = $aisop_desc = $opts = '';
            $aisop_class = new All_in_One_SEO_Pack();
            $aisop_desc = $aisop_class->get_main_description();
            $opts = $aisop_class->get_current_options( array(), 'aiosp' );
            if ( (is_category() || is_tax() || is_tag()) && $aisop_class->show_page_description() ) {
                $aisop_desc = $opts['aiosp_description'];
            }
            if ( $aisop_desc ) {
                $desc = $aisop_desc;
            }
        }

        //Genesis #1013
        if ( function_exists('genesis_meta') ) {
            $genesis_description = '';
            if ( is_home() && is_front_page() && ! $redux_builder_amp['amp-frontpage-select-option'] ) {
                $genesis_description = genesis_get_seo_option( 'home_description' ) ? genesis_get_seo_option( 'home_description' ) : get_bloginfo( 'description' );
            }
            elseif ( is_home() && get_option( 'page_for_posts' ) && get_queried_object_id() ) {
                $post_id = get_option( 'page_for_posts' );
                if ( null !== $post_id || is_singular() ) {
                    if ( genesis_get_custom_field( '_genesis_description', $post_id ) ) {
                        $genesis_description = genesis_get_custom_field( '_genesis_description', $post_id );
                        if ( $genesis_description ) {
                            $desc = $genesis_description;
                        }
                    }
                }
            }
            elseif ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] && get_option( 'page_on_front' ) ) {
                $post_id = get_option('page_on_front');
                if ( null !== $post_id || is_singular() ) {
                    if ( genesis_get_custom_field( '_genesis_description', $post_id ) ) {
                        $genesis_description = genesis_get_custom_field( '_genesis_description', $post_id );
                        }
                    }
                }
            else {
                $genesis_description = genesis_get_seo_meta_description();
            }

            if ( $genesis_description ) {
                    $desc = $genesis_description;
                }
        }
        // SEOPress
        if ( is_plugin_active('wp-seopress/seopress.php') && 3 == $redux_builder_amp['ampforwp-seo-selection'] ) {
            $seopress_description = $seopress_options = '';
                $seopress_options = get_option("seopress_titles_option_name");
            if ( get_post_meta($post_id,'_seopress_titles_description',true) ) {
                $seopress_description = get_post_meta($post_id,'_seopress_titles_description',true);
            }
            if ( ampforwp_is_home() || ampforwp_is_blog() ) {
                $seopress_variables_array = array('%%sitetitle%%','%%tagline%%');
                $seopress_replace_array = array( get_bloginfo('name'), get_bloginfo('description') );
                $seopress_description = $seopress_options['seopress_titles_home_site_desc'];
                $seopress_description = str_replace($seopress_variables_array, $seopress_replace_array, $seopress_description);

            }
            if ( is_archive() ) {
                $seopress_description = get_term_meta(get_queried_object()->{'term_id'},'_seopress_titles_description',true);
            }
            if ( $seopress_description ) {
                $desc = $seopress_description;
            }
        }
        // The SEO Framework
        if ( function_exists( 'the_seo_framework' ) && 5 == $redux_builder_amp['ampforwp-seo-selection'] ) {
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
 global $redux_builder_amp;
 $single_translation_enabled = $redux_builder_amp['amp-use-pot'];
   if ( !$single_translation_enabled ) {
     return $redux_style_translation;
   } else {
     return __($pot_style_translation,'accelerated-mobile-pages');
   }
}

// END Point
function ampforwp_end_point_controller( $url, $check='' ) {
	global $redux_builder_amp;
	$checker = $setting = $new_url = '';
	$setting = ampforwp_get_setting('amp-core-end-point');
	$endpoint = AMPFORWP_AMP_QUERY_VAR;
	$endpoint = '?' . $endpoint;
	if ( $setting ) {
		$new_url = untrailingslashit($url.$endpoint);
	}
	else {
		$new_url = $url . user_trailingslashit( AMP_QUERY_VAR, 'single_amp' );
	}
	$new_url = apply_filters( 'ampforwp_modify_endpoint', $new_url, $url, $setting, $endpoint );
	return $new_url;
}