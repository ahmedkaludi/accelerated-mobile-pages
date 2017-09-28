<?php
function ampforwp_framework_get_logo(){ 
  global $redux_builder_amp; ?>
<div class="amp-logo">
  <?php 
        do_action('ampforwp_header_top_design3');
        $set_rel_to_noamp=false;

        if( $redux_builder_amp['amp-on-off-support-for-non-amp-home-page'] ) {
                if( $redux_builder_amp['amp-mobile-redirection'] ) {
                  $ampforwp_home_url = trailingslashit( get_bloginfo('url') ).'?nonamp=1';
                  $set_rel_to_noamp = true;
                  } else {
                    $ampforwp_home_url = trailingslashit( get_bloginfo('url') );
                 }
        } else {
                 if($redux_builder_amp['ampforwp-homepage-on-off-support']) {
                    $ampforwp_home_url = user_trailingslashit( trailingslashit( get_bloginfo('url') ) . AMPFORWP_AMP_QUERY_VAR );
                 } else {
                        if( $redux_builder_amp['amp-mobile-redirection'] ) {
                          $ampforwp_home_url = trailingslashit( get_bloginfo('url') ).'?nonamp=1';
                          $set_rel_to_noamp = true;
                         } else {
                          $ampforwp_home_url = trailingslashit( get_bloginfo('url') );
                         }
                }
          }?>

        <?php if ( true == ($redux_builder_amp['opt-media']['url']) ) {  ?>
          <a href="<?php echo esc_url( $ampforwp_home_url ); ?>"  <?php if($set_rel_to_noamp){ echo ' rel="nofollow"'; } ?>  >

            <?php if($redux_builder_amp['ampforwp-custom-logo-dimensions'] == true)  { ?>

                <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="<?php echo $redux_builder_amp['opt-media-width']; ?>" height="<?php echo $redux_builder_amp['opt-media-height']; ?>" alt="<?php bloginfo('name'); ?>" class="amp-logo"></amp-img>

            <?php } else { ?>

                <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="<?php bloginfo('name'); ?>" class="amp-logo"></amp-img>

            <?php } ?>

          </a>
        <?php } else { ?>
          <h1><a href="<?php echo esc_url( $ampforwp_home_url ); ?>"  <?php if($set_rel_to_noamp){ echo ' rel="nofollow"'; } ?>  ><?php bloginfo('name'); ?></a></h1>
        <?php } ?>
 </div>
 <?php }