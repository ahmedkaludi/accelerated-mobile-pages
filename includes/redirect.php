<?php
// Redirection for Homepage and Archive Pages when Turned Off from options panel
function ampforwp_check_amp_page_status() {
  global $redux_builder_amp;
  $hide_cats_amp = '';
  $hide_cats_amp = is_category_amp_disabled();
  if ( ampforwp_is_amp_endpoint() ) {
    if ( (is_archive() && $redux_builder_amp['ampforwp-archive-support'] == 0) || $hide_cats_amp == true || ( is_home() && $redux_builder_amp['ampforwp-homepage-on-off-support'] == 0) ) {
      global $wp;
      $redirection_location  =  add_query_arg( '', '', home_url( $wp->request ) );
      
      $redirection_location  =  trailingslashit($redirection_location );
      
      $redirection_location  =  dirname($redirection_location);
      wp_safe_redirect( $redirection_location );
      exit;
    }
  
  }
}
add_action( 'template_redirect', 'ampforwp_check_amp_page_status', 10 );


// Redirection code
function ampforwp_page_template_redirect() {
  global $redux_builder_amp, $post, $wp;
  $post_type                  = '';
  $supported_types            = '';
  $supported_amp_post_types   = array();

  $supported_types            = array('post','page');
  $supported_types            = apply_filters('get_amp_supported_post_types',$supported_types);
  $post_type                  = get_post_type();
  $supported_amp_post_types   = in_array( $post_type , $supported_types );

  if( isset($redux_builder_amp['amp-mobile-redirection']) && $redux_builder_amp['amp-mobile-redirection']){

    // Return if the set value is not met and do not start redirection
    if( ampforwp_meta_redirection_status()=='disable' ){
        return;
    }
    if( $supported_amp_post_types == false ){
      return;
    }
    if( is_archive() && $redux_builder_amp['ampforwp-archive-support']==0 ){
      return;
    }
    if ( is_feed() ) { 
      return; 
    }
    // #1192 Password Protected posts exclusion
    if( post_password_required( $post )){ 
      return; 
    }

    // Return if some categories are selected as Hide #999
    if(is_archive() && $redux_builder_amp['ampforwp-archive-support']){
      $selected_cats = array();
      $categories = get_the_category();
      $category_id = $categories[0]->cat_ID;
      $get_categories_from_checkbox =  $redux_builder_amp['hide-amp-categories']; 
      // Check if $get_categories_from_checkbox has some cats then only show
      if ( $get_categories_from_checkbox ) {
        $get_selected_cats = array_filter($get_categories_from_checkbox);
        foreach ($get_selected_cats as $key => $value) {
          $selected_cats[] = $key;
        }  
        if($selected_cats && $category_id){
          if(in_array($category_id, $selected_cats)){
            return;
          }
        }
      } 
    }

    // If we are in AMP mode then retrun and dont start redirection
    if ( ampforwp_is_amp_endpoint() ) {
        return;
    } 

    if( is_page() && $redux_builder_amp['amp-on-off-for-all-pages'] == 0 ){
        return;
    }

    if( ampforwp_is_home() &&$redux_builder_amp['ampforwp-homepage-on-off-support'] == 0 ){
        return;
    }

    if ( ! session_id() ) {
        session_start();
    }

    if( isset( $_SESSION['ampforwp_mobile'] ) && $_SESSION['ampforwp_amp_mode']=='mobile-on' && $_SESSION['ampforwp_mobile']=='exit'){
        return;
    }

    if( wp_is_mobile() && $_SESSION['ampforwp_amp_mode']=='mobile-on' && $_GET['nonamp']==1){
        // non mobile session variable creation
        session_start();
        $_SESSION['ampforwp_mobile']='exit';
        if ( ampforwp_is_amp_endpoint() ) {
            session_destroy();
        }
    }

    if ( (is_home() || is_archive()) && $wp->query_vars['paged'] >= '2' ) {
        $new_url    =  home_url('/');
        $category_path  = $wp->request;
        $explode_path   = explode("/",$category_path);
        $inserted     = array(AMPFORWP_AMP_QUERY_VAR);
        array_splice( $explode_path, -2, 0, $inserted );
        $impode_url = implode('/', $explode_path);

        $updated_amp_url = $new_url . $impode_url ;
    }

    // Check if we are on Mobile phones then start redirection process
    if ( wp_is_mobile() ) {

        if( !isset($_SESSION['ampforwp_amp_mode']) || !isset($_GET['nonamp']) ) {

          $_SESSION['ampforwp_amp_mode']='mobile-on';

          if ( ampforwp_is_front_page() ) {

              $post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
              $ampforwp_amp_post_on_off_meta = get_post_meta( $post_id,'ampforwp-amp-on-off',true);
              if( $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
                  return ;
              }
              wp_redirect( user_trailingslashit(trailingslashit( esc_url( ( get_permalink( $post_id ) ) ) ) . AMPFORWP_AMP_QUERY_VAR ) , 301 );
              exit();
          } // ampforwp_is_front_page

          if ( ampforwp_is_home() ) {

              $current_url = home_url(AMPFORWP_AMP_QUERY_VAR) ;
              if ( $wp->query_vars['paged'] >= '2' ) {
                  $current_url = $updated_amp_url;
              }
             wp_redirect( user_trailingslashit( esc_url(  $current_url ) ) ,  301 );
                exit();

          } // is_home()

          if ( ampforwp_is_blog() ) {

              $post_id = ampforwp_get_blog_details('id');
              $ampforwp_amp_post_on_off_meta = get_post_meta( $post_id,'ampforwp-amp-on-off',true);
              if( $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
                  return ;
              }
              wp_redirect( user_trailingslashit(trailingslashit( esc_url( ( get_permalink( $post_id ) ) ) ) . AMPFORWP_AMP_QUERY_VAR ) , 301 );
              exit();
          } // ampforwp_is_blog

          if ( is_archive() ) {
              if ( $redux_builder_amp['ampforwp-archive-support'] == 1 ) {
                  $current_archive_url = trailingslashit( home_url( $wp->request ) ) . AMPFORWP_AMP_QUERY_VAR;
                  if ( $wp->query_vars['paged'] >= '2' ) {
                      $current_archive_url = $updated_amp_url;
                  }
                  wp_redirect( user_trailingslashit( esc_url( $current_archive_url ) ) , 301 );
                  exit();  
              }
          } // is_archive()

          if ( is_singular() ) {

              $ampforwp_amp_post_on_off_meta = get_post_meta( get_the_ID(),'ampforwp-amp-on-off',true);
              if( $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
                 return;
              }

              wp_redirect( user_trailingslashit(trailingslashit( esc_url( ( get_permalink( get_the_ID() ) ) ) ) . AMPFORWP_AMP_QUERY_VAR ) , 301 );
              exit();
          } // is_single()
    
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
    if( ampforwp_is_amp_endpoint() ) {
      global $wp;
      $ampforwp_404_url   = add_query_arg( '', '', home_url( $wp->request ) );
      $ampforwp_404_url = trailingslashit($ampforwp_404_url );
      $ampforwp_404_url = dirname($ampforwp_404_url);
      wp_redirect( esc_url( $ampforwp_404_url )  , 301 );
      exit();
    }
  }
}
// Redirection code is not working properly. Need fix
//add_action( 'template_redirect', 'ampforwp_page_template_redirect_non_amp', 10 );
// function ampforwp_page_template_redirect_non_amp() {

//   if ( (is_home() || is_front_page() || is_archive()) && $_GET['nonamp']==1 ){
//           global $wp;
//           $current_view_nonamp_url = add_query_arg( '', '', home_url( $wp->request ) );
//           $current_view_nonamp_url = trailingslashit($current_view_nonamp_url);
//       wp_redirect( esc_url( $current_view_nonamp_url )  , 301 );
//       exit();
//   }

//   elseif ( is_singular() && $_GET['nonamp']==1 ) {

//       global $wp;
//       $current_view_nonamp_url   = add_query_arg( '', '', get_permalink() );
//       $current_view_nonamp_url = trailingslashit($current_view_nonamp_url );
//       wp_redirect( esc_url( $current_view_nonamp_url) , 301 );
//       exit();
//   }
// }
