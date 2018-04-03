<?php
// Redirection for Homepage and Archive Pages when Turned Off from options panel
function ampforwp_check_amp_page_status() {
  global $redux_builder_amp, $wp;
  $hide_cats_amp = '';
  $hide_cats_amp = is_category_amp_disabled();
  if ( ampforwp_is_amp_endpoint() ) {
    if ( (is_archive() && 0 == $redux_builder_amp['ampforwp-archive-support']) || true == $hide_cats_amp || ((ampforwp_is_home() || ampforwp_is_front_page()) && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support']) ) {
      $redirection_location = add_query_arg( '', '', home_url( $wp->request ) );
      
      $redirection_location = trailingslashit($redirection_location );
      
      $redirection_location = dirname($redirection_location);
      wp_safe_redirect( $redirection_location );
      exit;
    }
  }
  // AMP Takeover
  if ( isset($redux_builder_amp['ampforwp-amp-takeover']) && $redux_builder_amp['ampforwp-amp-takeover'] && !ampforwp_is_non_amp() ) {
    $redirection_location = '';
    if ( is_singular() ) {
      $redirection_location = get_the_permalink();
    }
    if ( ampforwp_is_home() || ampforwp_is_front_page() || is_archive() || ampforwp_is_blog() ) {
      $redirection_location = add_query_arg( '', '', home_url( $wp->request ) );
      
      $redirection_location = trailingslashit($redirection_location );
      
      $redirection_location = dirname($redirection_location);
    }
    wp_safe_redirect( $redirection_location );
    exit;
  }
}
add_action( 'template_redirect', 'ampforwp_check_amp_page_status', 10 );


// Redirection code
function ampforwp_page_template_redirect() {
  global $redux_builder_amp, $post, $wp;
  $post_type                  = '';
  $supported_types            = '';
  $supported_amp_post_types   = array();
  $url_to_redirect            = '';

  $supported_types            = ampforwp_get_all_post_types();
  $supported_types            = apply_filters('get_amp_supported_post_types',$supported_types);
  $post_type                  = get_post_type();
  $supported_amp_post_types   = in_array( $post_type , $supported_types );
  $url_to_redirect            = ampforwp_amphtml_generator();


  if ( isset($redux_builder_amp['amp-mobile-redirection']) && $redux_builder_amp['amp-mobile-redirection'] ) {
    // Return if Dev mode is enabled
    if ( isset($redux_builder_amp['ampforwp-development-mode']) && $redux_builder_amp['ampforwp-development-mode'] ) {
      return;
    }
    // Return if the set value is not met and do not start redirection
    if ( 'disable' == ampforwp_meta_redirection_status() ) {
        return;
    }
    if ( false == $supported_amp_post_types ) {
      return;
    }
    if ( is_archive() && 0 == $redux_builder_amp['ampforwp-archive-support'] ) {
      return;
    }
    if ( is_feed() ) { 
      return; 
    }
    // #1192 Password Protected posts exclusion
    if ( post_password_required( $post ) ) { 
      return; 
    }

    // Return if some categories are selected as Hide #999
    if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) {
      $selected_cats = array();
      $categories = get_the_category();
      $category_id = $categories[0]->cat_ID;
      $get_categories_from_checkbox = $redux_builder_amp['hide-amp-categories']; 
      // Check if $get_categories_from_checkbox has some cats then only show
      if ( $get_categories_from_checkbox ) {
        $get_selected_cats = array_filter($get_categories_from_checkbox);
        foreach ( $get_selected_cats as $key => $value ) {
          $selected_cats[] = $key;
        }  
        if ( $selected_cats && $category_id ) {
          if ( in_array($category_id, $selected_cats) ) {
            return;
          }
        }
      } 
    }

    // If we are in AMP mode then retrun and dont start redirection
    if ( ampforwp_is_amp_endpoint() ) {
        return;
    } 

    if ( is_page() && 0 == $redux_builder_amp['amp-on-off-for-all-pages'] ) {
        return;
    }

    if ( is_home() && is_front_page() && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
    }
    if ( is_front_page() && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
    }

    if ( ! session_id() ) {
        session_start();
    }

    if ( isset( $_SESSION['ampforwp_mobile'] ) && 'mobile-on' == $_SESSION['ampforwp_amp_mode'] && 'exit' == $_SESSION['ampforwp_mobile'] ) {
        return;
    }

    if ( wp_is_mobile() && 'mobile-on' == $_SESSION['ampforwp_amp_mode'] && 1 == $_GET['nonamp'] ) {
        // non mobile session variable creation
        session_start();
        $_SESSION['ampforwp_mobile'] = 'exit';
        if ( ampforwp_is_amp_endpoint() ) {
            session_destroy();
        }
    }

    // Check if we are on Mobile phones then start redirection process
    if ( wp_is_mobile() ) {

        if ( ! isset($_SESSION['ampforwp_amp_mode']) || ! isset($_GET['nonamp']) ) {

          $_SESSION['ampforwp_amp_mode'] = 'mobile-on';

          if ( $url_to_redirect ) {
            wp_redirect( $url_to_redirect , 301 );
            exit();
          }
          
          // if nothing matches then return back
          return;
        }
    }
  }
}
add_action( 'template_redirect', 'ampforwp_page_template_redirect', 30 );


add_action( 'template_redirect', 'ampforwp_page_template_redirect_archive', 10 );
function ampforwp_page_template_redirect_archive() {

  if ( is_404() ) {
    if ( ampforwp_is_amp_endpoint() ) {
      global $wp;
      $ampforwp_404_url   = add_query_arg( '', '', home_url( $wp->request ) );
      $ampforwp_404_url = trailingslashit($ampforwp_404_url );
      $ampforwp_404_url = dirname($ampforwp_404_url);
      wp_redirect( esc_url( $ampforwp_404_url )  , 301 );
      exit();
    }
  }
}