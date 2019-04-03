<?php global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="footer_wrapper container">
      <div id="footer">      
        <?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
          <div class="footer_menu">
           <nav>
              <?php
              $menu = wp_nav_menu( array(
                  'theme_location' => 'amp-footer-menu',
                  'link_before'    => '<span>',
                  'link_after'     => '</span>',
                  'echo'           => false,
              ) );
              $menu = apply_filters('ampforwp_menu_content', $menu);
              $sanitizer_obj = new AMPFORWP_Content( $menu, array(), apply_filters( 'ampforwp_content_sanitizers', array(
                  'AMP_Img_Sanitizer'   => array(),
                  'AMP_Style_Sanitizer' => array(), 
              )) );
              $sanitized_menu = $sanitizer_obj->get_amp_content();
              echo wp_kses($sanitized_menu, ampforwp_allowed_tags()); ?>
           </nav>
          </div>
        <?php } ?>

        <?php if ( ampforwp_checking_any_social_profiles() ) { ?>
          <div class="social_icons">
            <ul>

            <?php global $redux_builder_amp;
            if ( $redux_builder_amp['enable-single-twittter-profile'] && '' !== $redux_builder_amp['enable-single-twittter-profile-url'] ) { ?>
              <a title="twitter profile" href="<?php echo esc_url($redux_builder_amp['enable-single-twittter-profile-url']); ?>" target ="_blank"><li class="icon-twitter"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-facebook-profile'] && '' !== $redux_builder_amp['enable-single-facebook-profile-url'] ) { ?>
              <a title="facebook profile" href="<?php echo esc_url($redux_builder_amp['enable-single-facebook-profile-url']); ?>" target ="_blank"><li class="icon-facebook"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-pintrest-profile'] && '' !== $redux_builder_amp['enable-single-pintrest-profile-url'] ) { ?>
              <a title="pinterest profile" href="<?php echo esc_url($redux_builder_amp['enable-single-pintrest-profile-url']); ?>" target ="_blank"><li class="icon-pinterest"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-google-plus-profile'] && '' !== $redux_builder_amp['enable-single-google-plus-profile-url'] ) { ?>
              <a title="google plus profile" href="<?php echo esc_url($redux_builder_amp['enable-single-google-plus-profile-url']); ?>" target ="_blank"><li class="icon-google-plus"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-linkdin-profile'] && '' !== $redux_builder_amp['enable-single-linkdin-profile-url'] ) { ?>
              <a title="linkedin profile" href="<?php echo esc_url($redux_builder_amp['enable-single-linkdin-profile-url']); ?>" target ="_blank"><li class="icon-linkedin"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-youtube-profile'] && '' !== $redux_builder_amp['enable-single-youtube-profile-url'] ) { ?>
              <a title="youtube profile" href="<?php echo esc_url($redux_builder_amp['enable-single-youtube-profile-url']); ?>" target ="_blank"><li class="icon-youtube-play"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-instagram-profile'] && '' !== $redux_builder_amp['enable-single-instagram-profile-url'] ) { ?>
              <a title="instagram profile" href="<?php echo esc_url($redux_builder_amp['enable-single-instagram-profile-url']); ?>" target ="_blank">  <li class="icon-instagram"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-reddit-profile'] && '' !== $redux_builder_amp['enable-single-reddit-profile-url'] ) { ?>
              <a title="reddit profile" href="<?php echo esc_url($redux_builder_amp['enable-single-reddit-profile-url']); ?>" target ="_blank"><li class="icon-reddit-alien"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-VKontakte-profile'] && '' !== $redux_builder_amp['enable-single-VKontakte-profile-url'] ) { ?>
              <a title="vkontakte profile" href="<?php echo esc_url($redux_builder_amp['enable-single-VKontakte-profile-url']); ?>" target ="_blank"><li class="icon-vk"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-snapchat-profile'] && '' !== $redux_builder_amp['enable-single-snapchat-profile-url'] ) { ?>
              <a title="snapchat profile" href="<?php echo esc_url($redux_builder_amp['enable-single-snapchat-profile-url']); ?>" target ="_blank"><li class="icon-snapchat-ghost"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-Tumblr-profile'] && '' !== $redux_builder_amp['enable-single-Tumblr-profile-url'] ) { ?>
              <a title="tumblr profile" href="<?php echo esc_url($redux_builder_amp['enable-single-Tumblr-profile-url']); ?>" target ="_blank"><li class="icon-tumblr"></li></a>
              <?php } ?>

            </ul>
          </div>
          <?php } 
           if(true == ampforwp_get_setting('ampforwp-footer-top')){?><p class="rightslink back-to-top"><?php amp_back_to_top_link();?></p><?php 
            } ?>
            <p class="rightslink"><?php
             $allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>'; 
              echo strip_tags( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'Footer') ,$allowed_tags );
              if ( '1' == $redux_builder_amp['amp-footer-link-non-amp-page'] ) {
                if ( $redux_builder_amp['amp-translator-footer-text'] ) { ?> | <?php ampforwp_view_nonamp(); }
                else {
                  ampforwp_view_nonamp();
                } 
              }?>          
            </p>
             <?php do_action('amp_footer_link');

          if ( true == $redux_builder_amp['amp-design-3-credit-link'] ) { ?><p class="poweredby">
                <a title="AMP for WP" href="https://ampforwp.com" rel="nofollow">Powered by AMPforWP</a>
            </p><?php 
          } ?>
      </div>
  </footer>
</div><!--Design3 Ends-->
<?php do_action('ampforwp_global_after_footer'); ?>