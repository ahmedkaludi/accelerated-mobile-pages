<?php
function ampforwp_framework_get_logo(){
  global $redux_builder_amp; ?>
<div class="amp-logo"><?php
        do_action('amp_header_top');
        $set_rel_to_noamp=false;
        if( $redux_builder_amp['amp-on-off-support-for-non-amp-home-page'] ) {
                if( $redux_builder_amp['amp-mobile-redirection'] ) {
                  $ampforwp_home_url = trailingslashit( get_bloginfo('url') ).'?nonamp=1';
                  $set_rel_to_noamp = true;
                  } else {
                    $ampforwp_home_url = user_trailingslashit( get_bloginfo('url') );
                 }
        } else {
                 if($redux_builder_amp['ampforwp-homepage-on-off-support']) {
                    $ampforwp_home_url = ampforwp_url_controller( get_bloginfo('url') );
                 } else {
                        if( $redux_builder_amp['amp-mobile-redirection'] ) {
                          $ampforwp_home_url = trailingslashit( get_bloginfo('url') ).'?nonamp=1';
                          $set_rel_to_noamp = true;
                         } else {
                          $ampforwp_home_url = trailingslashit( get_bloginfo('url') );
                         }
                }
          }
          $ampforwp_home_url = apply_filters('ampforwp_header_url', $ampforwp_home_url);
          if ( true == ($redux_builder_amp['opt-media']['url']) ) {
          $alt = $logo_url = "";
          $alt      = ampforwp_default_logo('alt'); 
          $logo_url = __( $redux_builder_amp['opt-media']['url'], 'accelerated-mobile-pages' ); 
          ?><a href="<?php echo esc_url( $ampforwp_home_url ); ?>" <?php if($set_rel_to_noamp){ echo ' rel="nofollow"'; } ?>><amp-img src="<?php echo esc_url( $logo_url );  ?>" width="<?php echo esc_attr(ampforwp_default_logo('width')); ?>" height="<?php echo esc_attr(ampforwp_default_logo('height')); ?>" alt="<?php echo esc_attr($alt); ?>" class="amp-logo" layout="responsive"></amp-img></a><?php } else { if(is_single()){ ?>
          <h2> <?php } else{?><h1><?php }?>
          <a href="<?php echo esc_url( $ampforwp_home_url ); ?>"  <?php if($set_rel_to_noamp){ echo ' rel="nofollow"'; } ?>  ><?php bloginfo('name'); ?></a><?php if(is_single()){?></h2><?php } else{?></h1><?php }
         } ?></div>
 <?php }

add_action('amp_post_template_css','amp_framework_logo_styles',11); 
if( !function_exists( 'amp_framework_logo_styles' ) ){
 function amp_framework_logo_styles(){
  global $redux_builder_amp;
  $max_width = '190px';
   $width =  (integer) ampforwp_default_logo('width');
  if ( true == ampforwp_get_setting('ampforwp-custom-logo-dimensions') && true == ampforwp_get_setting('ampforwp-custom-logo-dimensions-options') && 'flexible' == ampforwp_get_setting('ampforwp-custom-logo-dimensions-options') ) {
       $max_width =  (integer) $redux_builder_amp['ampforwp-custom-logo-dimensions-slider'];
       $width =  (integer) ampforwp_default_logo('width');
       $max_width = ceil(($width*$max_width)/100)."px";
  }
   $width .= 'px';
   ?>
    .amp-logo amp-img{width:<?php echo esc_attr($max_width); ?>}
 <?php }
}
