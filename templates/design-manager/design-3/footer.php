<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="footer_wrapper container">
      <div id="footer">
      <?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
          <div class="f-w-blk">
              <div class="d3f-w">
                <?php 
                $sidebar_output = '';
                $sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-footer-widget-area');
                if ( $sanitized_sidebar) {
                  $sidebar_output = $sanitized_sidebar->get_amp_content();
                  $sidebar_output = ampforwp_show_yoast_seo_local_map($sidebar_output);
                  $sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
                  $sidebar_output = preg_replace_callback('/<form(.*?)>(.*?)<\/form>/s', function($match){
                  if(strpos($match[1], 'target=') === false){
                    return '<form'.$match[1].' target="_top">'.$match[2].'</form>';
                  }else{
                    return '<form'.$match[1].'>'.$match[2].'</form>';
                  } 
                }, $sidebar_output);
                } 
                echo do_shortcode($sidebar_output); 
                ?>
              </div>
          </div>
        <?php endif; ?>       
        <?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
          <div class="footer_menu">
           <nav>
              <?php
              $menu_args = array(
                                'theme_location' => 'amp-footer-menu',
                                'link_before'    => '<span>',
                                'link_after'     => '</span>',
                                'echo'           => false,
                            );
              amp_menu( true, $menu_args, 'footer' ); ?>
           </nav>
          </div>
        <?php } ?>

        <?php if ( ampforwp_checking_any_social_profiles() ) { ?>
          <div class="so_i">
            <ul>

            <?php if ( ampforwp_get_setting('enable-single-twittter-profile') && '' !== ampforwp_get_setting('enable-single-twittter-profile-url') ) { ?>
              <li class="icon-twitter"><a title="twitter profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-twittter-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-facebook-profile') && '' !== ampforwp_get_setting('enable-single-facebook-profile-url') ) { ?>
              <li class="icon-facebook"><a title="facebook profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-facebook-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-pintrest-profile') && '' !== ampforwp_get_setting('enable-single-pintrest-profile-url') ) { ?>
              <li class="icon-pinterest"><a title="pinterest profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-pintrest-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-google-plus-profile') && '' !== ampforwp_get_setting('enable-single-google-plus-profile-url') ) { ?>
              <li class="icon-google-plus"><a title="google plus profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-google-plus-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php  if ( ampforwp_get_setting('enable-single-linkdin-profile') && '' !== ampforwp_get_setting('enable-single-linkdin-profile-url') ) { ?>
              <li class="icon-linkedin"><a title="linkedin profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-linkdin-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php  if ( ampforwp_get_setting('enable-single-youtube-profile') && '' !== ampforwp_get_setting('enable-single-youtube-profile-url') ) { ?>
              <li class="icon-youtube-play"><a title="youtube profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-youtube-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-instagram-profile') && '' !== ampforwp_get_setting('enable-single-instagram-profile-url') ) { ?>
              <li class="icon-instagram"><a title="instagram profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-instagram-profile-url']); ?>" target ="_blank">  </a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-reddit-profile') && '' !== ampforwp_get_setting('enable-single-reddit-profile-url') ) { ?>
              <li class="icon-reddit-alien"><a title="reddit profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-reddit-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-VKontakte-profile') && '' !== ampforwp_get_setting('enable-single-VKontakte-profile-url') ) { ?>
              <li class="icon-vk"><a title="vkontakte profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-VKontakte-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-snapchat-profile') && '' !== ampforwp_get_setting('enable-single-snapchat-profile-url') ) { ?>
              <li class="icon-snapchat-ghost"><a title="snapchat profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-snapchat-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>

              <?php if ( ampforwp_get_setting('enable-single-Tumblr-profile') && '' !== ampforwp_get_setting('enable-single-Tumblr-profile-url') ) { ?>
              <li class="icon-tumblr"><a title="tumblr profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-Tumblr-profile-url']); ?>" target ="_blank"></a></li>
              <?php } ?>
               <?php if ( ampforwp_get_setting('enable-single-telegram-profile') && '' !== ampforwp_get_setting('enable-single-telegram-profile-url') ) { ?>
              <li class="icon-telegram"><a title="telegram profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url(ampforwp_get_setting('enable-single-telegram-profile-url')); ?>" target ="_blank"><amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ1NS43MzEgNDU1LjczMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDU1LjczMSA0NTUuNzMxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8cmVjdCB4PSIwIiB5PSIwIiBzdHlsZT0iZmlsbDojNjFBOERFOyIgd2lkdGg9IjQ1NS43MzEiIGhlaWdodD0iNDU1LjczMSIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTguODQ0LDEwMC42TDU0LjA5MSwyMTkuMzU5Yy05Ljg3MSwzLjg0Ny05LjI3MywxOC4wMTIsMC44ODgsMjEuMDEybDc3LjQ0MSwyMi44NjhsMjguOTAxLDkxLjcwNiAgIGMzLjAxOSw5LjU3OSwxNS4xNTgsMTIuNDgzLDIyLjE4NSw1LjMwOGw0MC4wMzktNDAuODgybDc4LjU2LDU3LjY2NWM5LjYxNCw3LjA1NywyMy4zMDYsMS44MTQsMjUuNzQ3LTkuODU5bDUyLjAzMS0yNDguNzYgICBDMzgyLjQzMSwxMDYuMjMyLDM3MC40NDMsOTYuMDgsMzU4Ljg0NCwxMDAuNnogTTMyMC42MzYsMTU1LjgwNkwxNzkuMDgsMjgwLjk4NGMtMS40MTEsMS4yNDgtMi4zMDksMi45NzUtMi41MTksNC44NDcgICBsLTUuNDUsNDguNDQ4Yy0wLjE3OCwxLjU4LTIuMzg5LDEuNzg5LTIuODYxLDAuMjcxbC0yMi40MjMtNzIuMjUzYy0xLjAyNy0zLjMwOCwwLjMxMi02Ljg5MiwzLjI1NS04LjcxN2wxNjcuMTYzLTEwMy42NzYgICBDMzIwLjA4OSwxNDcuNTE4LDMyNC4wMjUsMTUyLjgxLDMyMC42MzYsMTU1LjgwNnoiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" height="16" width="16"></amp-img> </a></li>
              <?php }?>
            </ul>
          </div>
          <?php } ?>
            <p class="rightslink"><?php
             $allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>'; 
              if (function_exists('pll__')) {
                echo strip_tags( pll__(ampforwp_get_setting('amp-translator-footer-text')) ,$allowed_tags );
              }else {
                echo strip_tags( ampforwp_translation(do_shortcode(ampforwp_get_setting('amp-translator-footer-text')), 'All Rights Reserved') ,$allowed_tags );
              }
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