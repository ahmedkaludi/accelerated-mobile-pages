<?php global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="footer_wrapper container">
    <?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
      <div class="f-w-f1">
        <div class="cntr">
          <div class="f-w">
            <?php 
            $sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-footer-widget-area');
            if ( $sanitized_sidebar) {
              $sidebar_output = $sanitized_sidebar->get_amp_content();
              $sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
            } 
            echo do_shortcode($sidebar_output); 
            ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
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
            <?php
            if ( ampforwp_get_setting('enable-single-twittter-profile') && '' !== ampforwp_get_setting('enable-single-twittter-profile-url') ) { ?>
              <li class="icon-twitter"><a title="twitter profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-twittter-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-facebook-profile') && '' !== ampforwp_get_setting('enable-single-facebook-profile-url') ) { ?>
              <li class="icon-facebook"><a title="facebook profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-facebook-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-pintrest-profile') && '' !== ampforwp_get_setting('enable-single-pintrest-profile-url') ) { ?>
              <li class="icon-pinterest"><a title="pinterest profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-pintrest-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-google-plus-profile') && '' !== ampforwp_get_setting('enable-single-google-plus-profile-url') ) { ?>
              <li class="icon-google-plus"><a title="google plus profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-google-plus-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-linkdin-profile') && '' !== ampforwp_get_setting('enable-single-linkdin-profile-url') ) { ?>
              <li class="icon-linkedin"><a title="linkedin profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-linkdin-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-youtube-profile') && '' !== ampforwp_get_setting('enable-single-youtube-profile-url') ) { ?>
              <li class="icon-youtube-play"><a title="youtube profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-youtube-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-instagram-profile') && '' !== ampforwp_get_setting('enable-single-instagram-profile-url') ) { ?>
              <li class="icon-instagram"><a title="instagram profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-instagram-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-reddit-profile') && '' !== ampforwp_get_setting('enable-single-reddit-profile-url') ) { ?>
              <li class="icon-reddit-alien"><a title="reddit profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-reddit-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-VKontakte-profile') && '' !== ampforwp_get_setting('enable-single-VKontakte-profile-url') ) { ?>
              <li class="icon-vk"><a title="vkontakte profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-VKontakte-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-snapchat-profile') && '' !== ampforwp_get_setting('enable-single-snapchat-profile-url') ) { ?>
              <li class="icon-snapchat-ghost"><a title="snapchat profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-snapchat-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php
              if ( ampforwp_get_setting('enable-single-Tumblr-profile') && '' !== ampforwp_get_setting('enable-single-Tumblr-profile-url') ) { ?>
              <li class="icon-tumblr"><a title="tumblr profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-Tumblr-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

            </ul>
          </div>
          <?php } 
          if(true == ampforwp_get_setting('ampforwp-footer-top')){?>
            <p class="rightslink back-to-top">
             <?php  amp_back_to_top_link(); 
              ?> </p> <?php } ?>
          <p class="rightslink">
            <?php
              $allowed_html = ampforwp_wp_kses_allowed_html();
              echo wp_kses( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'All Rights Reserved') ,$allowed_html );
              if ( '1' == $redux_builder_amp['amp-footer-link-non-amp-page'] ) {
                if ( $redux_builder_amp['amp-translator-footer-text'] ) { ?> | <?php ampforwp_view_nonamp(); }
                else {
                  ampforwp_view_nonamp();
                } 
              } ?>
          </p>
          <?php do_action('amp_footer_link'); ?>

          <?php if ( true == $redux_builder_amp['amp-design-3-credit-link'] ) { ?>
            <p class="poweredby">
                <a title="amp for wp" href="https://ampforwp.com" rel="nofollow">Powered by AMPforWP</a>
            </p>
          <?php } ?>
      </div>
  </footer>
</div><!--Design3 Ends-->
<?php do_action('ampforwp_global_after_footer'); ?>