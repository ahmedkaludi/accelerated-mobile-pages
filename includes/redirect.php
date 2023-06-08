<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'template_redirect', 'ampforwp_redirection', 10 );
function ampforwp_redirection() {
  global $redux_builder_amp, $wp, $post;
  $hide_cats_amp = $url = $archive_check = $go_to_url = $archive_check_tax = '';
  $hide_cats_amp = is_category_amp_disabled();
  // No redirection if Post/Page is AMP Disabled #3287
  if ( ( is_singular() || ampforwp_is_front_page() || ampforwp_is_blog() ) && 'hide-amp' == get_post_meta( ampforwp_get_the_ID(),'ampforwp-amp-on-off',true) ) {
    return;
  }
  if ( ampforwp_posts_to_remove() && is_object($post) && $post->post_type == 'post' ) {
      return;
  }
  // Redirection for Homepage and Archive Pages when Turned Off from options panel
  if ( ampforwp_is_amp_endpoint() ) {
     if(is_tax()){
        $term_id = get_queried_object()->term_id;
        $term = get_term( $term_id );
        $taxonomy_name = $term->taxonomy;
        
        $custom_taxonomies = ampforwp_get_setting('ampforwp-custom-taxonomies');
        if(!empty($custom_taxonomies)){
          if(( is_archive() && !in_array( $taxonomy_name,$custom_taxonomies) ) ){
              $archive_check_tax = true;
          }
        }
      }else{
          if( ( (function_exists('is_shop') && !is_shop() ) && is_archive() &&  0 == ampforwp_get_setting('ampforwp-archive-support')) || ( !function_exists('is_shop') &&is_archive() &&  0 == ampforwp_get_setting('ampforwp-archive-support')) || (is_category() && 0 == ampforwp_get_setting('ampforwp-archive-support-cat')) || (is_tag() && 0 == ampforwp_get_setting('ampforwp-archive-support-tag')) ){
          $archive_check = true;
        }
      }
      if( !function_exists('amp_woocommerce_pro_add_woocommerce_support') && ( (function_exists('is_product_category') && is_product_category()) || (function_exists('is_product_tag') && is_product_tag()) || (function_exists('is_shop') && is_shop() ) )){
            $archive_check = true;
       }
    if ( (true == $archive_check_tax) || ( true == $archive_check ) || true == $hide_cats_amp || ((ampforwp_is_home() || ampforwp_is_front_page()) && 0 == ampforwp_get_setting('ampforwp-homepage-on-off-support')) ) {
      $url = $wp->request;
      if( ampforwp_is_home() && get_query_var('amp') ) {
        $url = 'amp';
      } 
      $redirection_location = add_query_arg( '', '', home_url( $url ) );
      
      $redirection_location = trailingslashit($redirection_location );
      
      $redirection_location = dirname($redirection_location);
      wp_safe_redirect( $redirection_location );
      exit;
    }
  }
$current_url = home_url(add_query_arg(array($_GET), $wp->request));
  //AMP on Search Pages #3977
if(is_search() && 0 == ampforwp_get_setting('amp-redirection-search')){
      if(strpos( $current_url, "amp=1&")!==false){
        $redirect_search = str_replace("amp=1&", '', $current_url);
        wp_safe_redirect( $redirect_search, 301 );
        exit;
      }else{
        return;
      }
}        
  if (ampforwp_get_setting('amp-desktop-redirection')) {
    require_once AMPFORWP_PLUGIN_DIR.'/includes/vendor/Mobile_Detect.php';
    $mobile_detect = new AMPforWP_Mobile_Detect;
    $isMobile = $mobile_detect->isMobile();
    if (!$isMobile ) {
        $current_url = home_url(add_query_arg(array($_GET), $wp->request));
        if (ampforwp_get_setting('amp-core-end-point')) {
          $current_url = explode('?', $current_url);
        }else{
          $current_url = explode('/', $current_url);
        }
        $check =  AMPFORWP_AMP_QUERY_VAR;
      if (in_array( $check  , $current_url ) ) {
          $current_url = array_flip($current_url);
          unset($current_url['amp']);
          $current_url = array_flip($current_url);
          $current_url = implode('/', $current_url);
          wp_safe_redirect( $current_url );
          exit;
      }
    } 
  }  
  // Redirect ?nonamp=1 to normal url #3269
  $current_url = $check = '';
  $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . AMPFROWP_HOST_NAME .  
                htmlspecialchars( $_SERVER['REQUEST_URI'] );              
  if(function_exists('googlesitekit_activate_plugin')){
    $current_url = remove_query_arg( '_gl', $current_url);
    $current_url = remove_query_arg(array('', '_gl'));
  }
  $current_url = explode('/', $current_url);
  $check =  '?nonamp=1';
  if (( isset($_GET['nonamp']) && 1 == $_GET['nonamp'] ) && function_exists('session_start') && !isset($_SESSION)){
      session_start();
      $_SESSION['ampforwp_mobile'] = 'exit';     
  }
  if (in_array( $check  , $current_url ) ) {
      $current_url = array_flip($current_url);
      unset($current_url['?nonamp=1']);
      $current_url = array_flip($current_url);
      $current_url = implode('/', $current_url);
      if(ampforwp_get_setting('amp-footer-link-non-amp-page-alternate')){
        $current_url = user_trailingslashit(esc_url($current_url))."?namp=1";
      }else{
        $current_url = user_trailingslashit(esc_url($current_url));
      }
      wp_safe_redirect( $current_url );
      exit;
  }


 // HIDE/SHOW TAG AND CATEGORY #4326
   if(ampforwp_is_amp_endpoint() ) {
      if(is_tag() || is_category() || is_tax()){
          $term_id = get_queried_object()->term_id;
          $tax_status = ampforwp_get_taxonomy_meta($term_id,'status');
          if($tax_status==false){
            $go_to_url =  home_url(add_query_arg($_GET,$wp->request));
            $go_to_url = str_replace("/amp", '', $go_to_url);
            $go_to_url =  remove_query_arg('amp',$go_to_url);
            wp_safe_redirect( esc_url($go_to_url) );
            exit;
          }
      }else if(is_single()){
          $tax_status = ampforwp_get_taxonomy_meta('','post_status');
          if($tax_status==false){
            $go_to_url =  home_url(add_query_arg($_GET,$wp->request));
            $go_to_url = str_replace("/amp", '', $go_to_url);
            $go_to_url =  remove_query_arg('amp',$go_to_url);
            wp_safe_redirect( esc_url($go_to_url) );
            exit;
          }
      }
  }

  //Auto redirect /amp to ?amp when 'Change End Point to ?amp' option is enabled #2480
  if ( ampforwp_is_amp_endpoint() && true == ampforwp_get_setting('amp-core-end-point') ){
    $current_url = $endpoint = $new_url = '';
    $current_url = home_url($wp->request);
    $amp = AMPFORWP_AMP_QUERY_VAR;
    $endpoint = '?'.$amp;
    $checker =  explode('/', $current_url); 
     $amp_check = in_array($amp, $checker);
     if ( true == $amp_check && $amp == end($checker) ) {
        $pos = strrpos( $current_url , '/'.$amp);
        $search_length  = strlen('/'.$amp);
        $new_url    = substr_replace( $current_url , $endpoint , $pos , $search_length );
        wp_safe_redirect( $new_url );
        exit;
    }
  }
  $mob_pres_link = false;
  if(function_exists('ampforwp_mobile_redirect_preseve_link')){
    $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
  }

  //Stop Mobile Redirection
  $stop_mob_redirection = false;
  $stop_mob_redirection = apply_filters('ampforwp_modify_mobile_redirection',$stop_mob_redirection);
  if($stop_mob_redirection === true){
    return;
  }

  // AMP Takeover
  if ( (ampforwp_get_setting('ampforwp-amp-takeover') || $mob_pres_link == true) && !ampforwp_is_non_amp() ) {
    $redirection_location = '';
    $current_location     = '';
    $home_url             = '';
    $blog_page_id         = '';
    $amp_on_off         = '';
    $current_location     = home_url( $wp->request);
    $home_url             = get_bloginfo('url');

    /*
     * If certain conditions does not match then return early and exit from redirection
     */

    // #4541
    $this_url = home_url(add_query_arg(array($_GET), $wp->request));
    if(preg_match('/robots\.txt/', $this_url)){
      return;
    }
    // return if the current page is Feed page, as we don't need anything on feedpaged
    if ( is_feed() ) {
      return;
    }
    if ( function_exists('is_embed') && is_embed() ){
      return;
    }
    // Homepage
    if ( ( ampforwp_is_home() || $current_location == $home_url ) && ! $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
      return;
    }

    // Frontpage
    if ( is_front_page() && $current_location == $home_url && ampforwp_is_front_page()) {
      return;
    }

    // Archive
    if ( is_archive() && ! $redux_builder_amp['ampforwp-archive-support'] ) {
      return;
    }

    //blogpage
    if ( is_home() && $redux_builder_amp['amp-on-off-for-all-pages']==false ) {
      return;
    }

    // Enabling AMP Takeover only when selected in Custom Post Type 
    $supported_types_for_takeover = array();
    $supported_types_for_takeover = ampforwp_get_all_post_types();
    if( $supported_types_for_takeover ){
            $current_type = get_post_type(get_the_ID());
            if(!in_array($current_type, $supported_types_for_takeover)){ 
              return ;
            }
    }
    // Single and Pages
    if ( is_singular() ) {
      $amp_metas = json_decode(get_post_meta( get_the_ID(),'ampforwp-post-metas',true), true );
      if(!empty($amp_metas['ampforwp-amp-on-off'])){
        if ( 'hide-amp' == $amp_metas['ampforwp-amp-on-off'] ) {
          $amp_on_off = true;
        }
      }
    }
    if ( ( is_single() && !$redux_builder_amp['amp-on-off-for-all-posts'] ) || ( is_page() && !$redux_builder_amp['amp-on-off-for-all-pages'] ) || ($amp_on_off) ) {
      return;
    }

    // Blog page
    if ( ampforwp_is_blog() ) {
      $blog_page_id         = get_option('page_for_posts');
      $redirection_location = get_the_permalink($blog_page_id);
    }

    // if the current page is ampfrontpage or normal frontpage take it to homepage of site
    if ( ampforwp_is_front_page() || is_front_page() ) {
      $redirection_location = $home_url;
    }

    // Single.php and page.php
    if ( ( is_single() && $redux_builder_amp['amp-on-off-for-all-posts'] ) || ( is_page() && $redux_builder_amp['amp-on-off-for-all-pages'] ) ) {
      $redirection_location = get_the_permalink();
      $url_path = '';
      if (true == ampforwp_get_setting('amp-core-end-point')) {
        $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_QUERY),'/' );
        if (strpos($url_path, '&') !== false) {
          $url_path = explode('&', $url_path);
          $url_path = end($url_path);
          if ($url_path != AMPFORWP_AMP_QUERY_VAR) {
            $redirection_location .= '?'. $url_path;
          }
        }
      }
    }
    $ampforwp_amp_post_on_off_meta = "";
    $ampforwp_amp_post_on_off_meta = get_post_meta(  ampforwp_get_the_ID(),'ampforwp-amp-on-off',true);
    if(false == $ampforwp_amp_post_on_off_meta && !ampforwp_is_home()){ 
      return;
    }
    /* Fallback, if for any reason, $redirection_location is still NULL
     * then redirect it to homepage. 
     */
    if ( empty( $redirection_location ) ) {
      $redirection_location = $home_url;
    }

    wp_safe_redirect( $redirection_location );
    exit;  
  }

  // Mobile redirection
  if ( ampforwp_get_setting('amp-mobile-redirection') && false == ampforwp_get_setting('ampforwp-development-mode')) {
    require_once AMPFORWP_PLUGIN_DIR.'/includes/vendor/Mobile_Detect.php';
    $post_type                  = '';
    $supported_types            = '';
    $supported_amp_post_types   = array();
    $url_to_redirect            = '';
    $supported_types            = ampforwp_get_all_post_types();
    $supported_types            = apply_filters('get_amp_supported_post_types',$supported_types);
    $post_type                  = get_post_type();
  
    $supported_amp_post_types   = in_array( $post_type , $supported_types );
    $url_to_redirect            = ampforwp_amphtml_generator();
    $mobile_detect = $isTablet = '';
    // instantiate the Mobile detect class
    $mobile_detect = new AMPforWP_Mobile_Detect;
    $isMobile = $mobile_detect->isMobile();
    $isTablet = $mobile_detect->isTablet();
    $isTabletUserAction = ampforwp_get_setting('amp-tablet-redirection');
    
    $redirectToAMP = false;
    if( $isMobile && $isTabletUserAction && $isTablet ){ //Only For tablet
      $redirectToAMP = true;
    }else if($isMobile && !$isTablet){ // Only for mobile
      $redirectToAMP = true;
    }

    // No mobile redirection on oembeds #2003
    if ( function_exists('is_embed') && is_embed() ){
      return;
    }
    // Return if Dev mode is enabled
    if ( isset($redux_builder_amp['ampforwp-development-mode']) && $redux_builder_amp['ampforwp-development-mode'] ) {
      return;
    }
    // Return if the set value is not met and do not start redirection
    if ( 'disable' == ampforwp_meta_redirection_status() ) {
        return;
    }
    if ( false == $supported_amp_post_types && !ampforwp_is_front_page() ) {
      return;
    }
    if ( is_archive() && 0 == $redux_builder_amp['ampforwp-archive-support'] ) {
      return;
    }
    if ( is_feed() ) { 
      return; 
    }
    if(get_query_var( 'json' )){
      return; 
    }
    if(get_query_var( 'robots' )){
      return; 
    }
    // #1192 Password Protected posts exclusion
    if ( post_password_required( $post ) ) { 
      return; 
    }

    // Return if some categories are selected as Hide #999
    if ( is_category_amp_disabled() ) {
      return;
    }

    // If we are in AMP mode then retrun and dont start redirection
    if ( ampforwp_is_amp_endpoint() ) {
        return;
    } 

    if ( is_page() && 0 == ampforwp_get_setting('amp-on-off-for-all-pages') && !ampforwp_is_front_page() ) {
        return;
    }

    if ( is_home() && is_front_page() && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
    }
    if ( is_front_page() && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
    }

    if ( function_exists('session_id') && ! session_id() && $redirectToAMP) {
        session_start();
    }

    if ( isset( $_SESSION['ampforwp_mobile'] ) && (isset($_SESSION['ampforwp_amp_mode']) && 'mobile-on' == $_SESSION['ampforwp_amp_mode']) && 'exit' == $_SESSION['ampforwp_mobile'] ) {
        return;
    }

    if ( $isMobile && (isset($_SESSION['ampforwp_amp_mode']) && 'mobile-on' == $_SESSION['ampforwp_amp_mode']) && ( isset($_GET['nonamp']) && 1 == $_GET['nonamp'] ) ){
        // non mobile session variable creation
        session_start();
        $_SESSION['ampforwp_mobile'] = 'exit';
        if ( ampforwp_is_amp_endpoint() ) {
            session_destroy();
        }
    }

    if ( function_exists('weglot_plugin_loaded') ) {
      $url_to_redirect = ampforwp_get_weglot_url();
      $url_to_redirect = ampforwp_url_controller($url_to_redirect); 
    }
    // Check if we are on Mobile phones then start redirection process
    if ( $redirectToAMP ) {
      if(isset($_GET['namp']) && $_GET['namp']==1){
        return;
      }
      if(class_exists('stcr\\stcr_manage') ){
        $check_url = implode(', ', $current_url);
        if(in_array('comment-subscriptions', $current_url) && strpos($check_url,'srp')!=false && strpos($check_url,'srk')!=false){
          return true;
        }
      }
      if(!isset($_GET['nonamphead']) && isset($_SESSION['nonamphead']) && in_array($url_to_redirect, $_SESSION['nonamphead'])){
           return;
        }
        if (( ! isset($_SESSION['ampforwp_amp_mode']) || ! isset($_GET['nonamp'])) && !isset($_GET['nonamphead']) ) {

          $_SESSION['ampforwp_amp_mode'] = 'mobile-on';

          if ( $url_to_redirect ) {
            wp_redirect( $url_to_redirect , 301 );
            exit();
          }        
          // if nothing matches then return back
          return;
        }
    }
    if(class_exists('stcr\\stcr_manage') ){
        $check_url = implode(', ', $current_url);
        if(in_array('comment-subscriptions', $current_url) && strpos($check_url,'srp')!=false && strpos($check_url,'srk')!=false){
          return true;
        }
      }
    if(ampforwp_is_amp_endpoint()==false && $redirectToAMP==false){
      if(!isset($_GET['nonamphead']) && isset($_SESSION['nonamphead']) && in_array($url_to_redirect, $_SESSION['nonamphead'])){
           return;
        }
        if (( ! isset($_SESSION['ampforwp_amp_mode']) || ! isset($_GET['nonamp'])) && !isset($_GET['nonamphead']) ) {
          $_SESSION['ampforwp_amp_mode'] = 'mobile-on';
          if ( $url_to_redirect ) { 
            add_action('wp_head', 'ampforwp_mobile_redirection_js');
          }
          return;
      }
    }  
    // #1947 when nonamp=1 it should redirect to original link
    $go_to_url  = "";
    $url        = "";
    $url = ampforwp_amphtml_generator();
    if ( empty($url) ) {
      $url = home_url( $wp->request );
    }
    $nonamp_checker = get_query_var( 'nonamp');
    $nonamphead_checker = get_query_var( 'nonamphead');
     if($url){
        if( $nonamp_checker == 1 ){ 
            $go_to_url = remove_query_arg('nonamp', $url);
            $go_to_url = explode('/', $go_to_url);
            $go_to_url = array_flip($go_to_url);
            if(true == ampforwp_get_setting('amp-core-end-point') || isset($go_to_url['?amp']) ){
              unset($go_to_url['?amp']);
            }
            if(isset($go_to_url['amp'])){
              unset($go_to_url['amp']);
            }
            $go_to_url = array_flip($go_to_url);     
            $go_to_url  = implode('/', $go_to_url);
            
          wp_safe_redirect( $go_to_url, 301 );
          exit;
        }elseif($nonamphead_checker == 1){
            $go_to_url = home_url( $wp->request );
            if($go_to_url){
                $_SESSION['nonamphead'][ampforwp_url_controller($go_to_url)] = ampforwp_url_controller($go_to_url);
              }
              wp_safe_redirect( $go_to_url, 301 );
              exit;
        }else{
          return;
        }
    }
  session_destroy();
  return;
  }
}

// #1947 when nonamp=1 it should redirect to original link so that google
add_filter( 'query_vars', 'ampforwp_custom_query_var' );
function ampforwp_custom_query_var($vars) {
  $vars[] = 'nonamp';
  $vars[] = 'nonamphead';
  return $vars;
}
// #1947 ends here
