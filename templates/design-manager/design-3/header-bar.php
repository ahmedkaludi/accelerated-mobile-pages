<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="left">
    <?php global $redux_builder_amp; ?>
    <div class="toggle-navigationv2">

      <?php
      if( has_nav_menu( 'amp-menu' ) ) { ?>
        <div class="navigation_heading"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-navigate-text'] , 'Navigate' ); ?></div>
      <?php
        wp_nav_menu( array(
            'theme_location' => 'amp-menu',
            'walker' => new AMPforWP_Menu_Walker()
        ) );
      }
           ?>
          <div class="social_icons">
            <ul>

                          <?php global $redux_builder_amp;
                          if( $redux_builder_amp['enable-single-twittter-profile'] && $redux_builder_amp['enable-single-twittter-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-twittter-profile-url']; ?>" target ="_blank"><li class="icon-twitter"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-facebook-profile']  && $redux_builder_amp['enable-single-facebook-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-facebook-profile-url']; ?>" target ="_blank"><li class="icon-facebook"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-pintrest-profile']  && $redux_builder_amp['enable-single-pintrest-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-pintrest-profile-url']; ?>" target ="_blank"><li class="icon-pinterest"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-google-plus-profile']  && $redux_builder_amp['enable-single-google-plus-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-google-plus-profile-url']; ?>" target ="_blank"><li class="icon-google-plus"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-linkdin-profile']  && $redux_builder_amp['enable-single-linkdin-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-linkdin-profile-url']; ?>" target ="_blank"><li class="icon-linkedin"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-youtube-profile']  && $redux_builder_amp['enable-single-youtube-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-youtube-profile-url']; ?>" target ="_blank"><li class="icon-youtube-play"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-instagram-profile']  && $redux_builder_amp['enable-single-instagram-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-instagram-profile-url']; ?>" target ="_blank">  <li class="icon-instagram"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-reddit-profile']  && $redux_builder_amp['enable-single-reddit-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-reddit-profile-url']; ?>" target ="_blank"><li class="icon-reddit-alien"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-VKontakte-profile']  && $redux_builder_amp['enable-single-VKontakte-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-VKontakte-profile-url']; ?>" target ="_blank"><li class="icon-vk"></li></a>
                            <?php } ?>


                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-snapchat-profile']  && $redux_builder_amp['enable-single-snapchat-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-snapchat-profile-url']; ?>" target ="_blank"><li class="icon-snapchat-ghost"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-Tumblr-profile']   && $redux_builder_amp['enable-single-Tumblr-profile-url'] !== '') { ?>
                            <a href="<?php echo $redux_builder_amp['enable-single-Tumblr-profile-url']; ?>" target ="_blank"><li class="icon-tumblr"></li></a>
                            <?php } ?>

            </ul>
          </div>
  </div>
</amp-sidebar>

<div id="designthree" class="designthree main_container">
<header class="container">
  <div id="headerwrap">
      <div id="header">
        <div class="hamburgermenu">
            <button class="toast pull-left" on='tap:sidebar.toggle'><span></span></button>
        </div>
        <div class="headerlogo">
        <?php global $redux_builder_amp;
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
        <?php do_action('ampforwp_call_button'); ?>
        <?php do_action('ampforwp_header_search');
        do_action('ampforwp_header_bottom_design3'); ?>

      </div>
  </div>
</header>