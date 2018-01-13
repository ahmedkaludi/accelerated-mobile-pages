<?php global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="footer_wrapper container">
      <div id="footer">      
        <?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
         <?php // schema.org/SiteNavigationElement missing from menus #1229 ?>
          <div class="footer_menu">
           <nav itemscope="" itemtype="https://schema.org/SiteNavigationElement">
              <?php
              $menu = wp_nav_menu( array(
                  'theme_location' => 'amp-footer-menu',
                  'link_before'    => '<span itemprop="name">',
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
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-twittter-profile-url']); ?>" target ="_blank"><li class="icon-twitter"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-facebook-profile'] && '' !== $redux_builder_amp['enable-single-facebook-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-facebook-profile-url']); ?>" target ="_blank"><li class="icon-facebook"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-pintrest-profile'] && '' !== $redux_builder_amp['enable-single-pintrest-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-pintrest-profile-url']); ?>" target ="_blank"><li class="icon-pinterest"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-google-plus-profile'] && '' !== $redux_builder_amp['enable-single-google-plus-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-google-plus-profile-url']); ?>" target ="_blank"><li class="icon-google-plus"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-linkdin-profile'] && '' !== $redux_builder_amp['enable-single-linkdin-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-linkdin-profile-url']); ?>" target ="_blank"><li class="icon-linkedin"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-youtube-profile'] && '' !== $redux_builder_amp['enable-single-youtube-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-youtube-profile-url']); ?>" target ="_blank"><li class="icon-youtube-play"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-instagram-profile'] && '' !== $redux_builder_amp['enable-single-instagram-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-instagram-profile-url']); ?>" target ="_blank">  <li class="icon-instagram"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-reddit-profile'] && '' !== $redux_builder_amp['enable-single-reddit-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-reddit-profile-url']); ?>" target ="_blank"><li class="icon-reddit-alien"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-VKontakte-profile'] && '' !== $redux_builder_amp['enable-single-VKontakte-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-VKontakte-profile-url']); ?>" target ="_blank"><li class="icon-vk"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-snapchat-profile'] && '' !== $redux_builder_amp['enable-single-snapchat-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-snapchat-profile-url']); ?>" target ="_blank"><li class="icon-snapchat-ghost"></li></a>
              <?php } ?>

              <?php global $redux_builder_amp;
              if ( $redux_builder_amp['enable-single-Tumblr-profile'] && '' !== $redux_builder_amp['enable-single-Tumblr-profile-url'] ) { ?>
              <a href="<?php echo esc_url($redux_builder_amp['enable-single-Tumblr-profile-url']); ?>" target ="_blank"><li class="icon-tumblr"></li></a>
              <?php } ?>

            </ul>
          </div>
          <?php } 
          if ( '1' == $redux_builder_amp['ampforwp-footer-top-design3'] ) { ?>
            <p class="rightslink back-to-top">
             <a href="#">
                  <?php echo esc_attr(ampforwp_translation( $redux_builder_amp['amp-translator-top-text'], 'Top')); ?> 
                </a> </p> <?php } ?>
          <p class="rightslink">
            <?php
              global $allowed_html; 
              echo wp_kses( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'Footer') ,$allowed_html );
              if ( '1' == $redux_builder_amp['amp-footer-link-non-amp-page'] ) {
                if ( $redux_builder_amp['amp-translator-footer-text'] ) { ?> | <?php ampforwp_view_nonamp(); }
                else {
                  ampforwp_view_nonamp();
                } 
              } ?>
          </p>
          <?php if ( true == $redux_builder_amp['amp-design-3-credit-link'] ) { ?>
            <p class="poweredby">
                <a href="https://ampforwp.com" rel="nofollow">Powered by AMPforWP</a>
            </p>
          <?php } ?>
      </div>
  </footer>
</div><!--Design3 Ends-->
<?php do_action('ampforwp_global_after_footer'); ?>