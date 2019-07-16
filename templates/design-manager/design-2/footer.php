<?php global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="container">
      <div id="footer">
        <?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
          <div class="f-w-blk">
              <div class="d3f-w">
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
        <?php endif; ?>
        <?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
          <div class="footer_menu"> 
            <nav>
                <?php
                  $menu = wp_nav_menu( array(
                      'theme_location' => 'amp-footer-menu',
                      'link_before'     => '<span>',
                      'link_after'     => '</span>',
                      'echo' => false
                  ) );
                  $menu = apply_filters('ampforwp_menu_content', $menu);
                  $sanitizer_obj = new AMPFORWP_Content( $menu, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
                  $sanitized_menu =  $sanitizer_obj->get_amp_content();
                  echo $sanitized_menu; ?>
            </nav>
          </div>
        <?php } ?>
        <p> <?php  amp_back_to_top_link();
                  if($redux_builder_amp['amp-footer-link-non-amp-page']=='1') {
                    if($redux_builder_amp['ampforwp-footer-top']=='1') { ?>
                      | <?php ampforwp_view_nonamp(); 
                    }
                    else{
                      ampforwp_view_nonamp();
                    }
                  }
              $allowed_html = ampforwp_wp_kses_allowed_html();
              echo wp_kses( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'All Rights Reserved'),$allowed_html);
              ?>
        </p>
        <?php do_action('amp_footer_link'); ?>
      </div>
  </footer>
<?php do_action('ampforwp_global_after_footer'); ?>
