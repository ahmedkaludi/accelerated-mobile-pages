<header class="container">
  <div id="headerwrap">
      <div id="header">
        <?php
         global $redux_builder_amp;
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
                    $ampforwp_home_url = trailingslashit( trailingslashit( get_bloginfo('url') ) . AMPFORWP_AMP_QUERY_VAR );
                 } else {
                        if( $redux_builder_amp['amp-mobile-redirection'] ) {
                          $ampforwp_home_url = trailingslashit( get_bloginfo('url') ).'?nonamp=1';
                          $set_rel_to_noamp = true;
                         } else {
                          $ampforwp_home_url = trailingslashit( get_bloginfo('url') );
                         }
                }
          }?>

        <?php
         do_action('ampforwp_header_top_design2');
         if (! empty( $redux_builder_amp['opt-media']['url'] ) ) {  ?>
          <a href="<?php echo esc_url( $ampforwp_home_url ); ?>" <?php if($set_rel_to_noamp){echo ' rel="nofollow"'; } ?> >

            <?php if($redux_builder_amp['ampforwp-custom-logo-dimensions'] == true)  { ?>

                <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="<?php echo $redux_builder_amp['opt-media-width']; ?>" height="<?php echo $redux_builder_amp['opt-media-height']; ?>" alt= "<?php bloginfo('name'); ?>" class="amp-logo"></amp-img>

            <?php } else { ?>

                <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt= "<?php bloginfo('name'); ?>" class="amp-logo"></amp-img>

            <?php } ?>

          </a>
        <?php } else { ?>
          <h3><a href="<?php echo esc_url( $ampforwp_home_url ); ?>"  <?php if($set_rel_to_noamp){echo ' rel="nofollow"';} ?>  ><?php bloginfo('name'); ?></a></h3>
        <?php } ?>
          <?php do_action('ampforwp_header_search'); ?>
          <?php do_action('ampforwp_call_button');
          do_action('ampforwp_header_bottom_design2'); ?>
      </div>
  </div>
</header>


<div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
	<a href="#" class="toggle-text"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-navigate-text'], 'Navigate' ); ?></a>
</div>

<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div> <?php
          $menu = wp_nav_menu( array(
                                    'theme_location' => 'amp-menu' ,
                                    'echo' => false) );
          echo strip_tags( $menu , '<ul><li><a>'); ?>

  </div>
</amp-sidebar>
