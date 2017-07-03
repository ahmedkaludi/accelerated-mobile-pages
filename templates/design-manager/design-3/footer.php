<?php global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="footer_wrapper container">
      <div id="footer">
        <?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
          <div class="footer_menu"> <?php
              $menu = wp_nav_menu( array(
                  'theme_location' => 'amp-footer-menu',
                  'echo' => false
              ) );
              echo strip_tags( $menu , '<ul><li><a>'); ?>
          </div>
        <?php } ?>

        <?php if( ampforwp_checking_any_social_profiles() ) { ?>
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
          <?php } ?>
          <p class="rightslink">
            <?php
              global $allowed_html;
              echo wp_kses( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'Footer') ,$allowed_html ) ;
              if($redux_builder_amp['amp-footer-link-non-amp-page']=='1') { ?> | <?php ampforwp_view_nonamp(); } ?>
          </p>
          <?php global $redux_builder_amp; if( $redux_builder_amp['amp-design-3-credit-link'] ) { ?>
          <p class="poweredby">
              <a href="https://ampforwp.com" rel="nofollow">Powered by AMPforWP</a>
          <p>
            <?php } ?>
      </div>
  </footer>
</div><!--Design3 Ends-->

 <?php
 do_action('ampforwp_global_after_footer');

 ?>