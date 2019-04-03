<?php global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="container">
      <div id="footer">
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
                  echo $sanitized_menu;//amphtml content, no kses ?>
            </nav>
          </div>
        <?php } ?>
        <p class="rightslink back-to-top"><?php 
          if ( true == ampforwp_get_setting('ampforwp-footer-top') || true == ampforwp_get_setting('amp-footer-link-non-amp-page') ) {
            amp_back_to_top_link();
            if(true == ampforwp_get_setting('amp-footer-link-non-amp-page')){
              ampforwp_view_nonamp();
            }
          };        
              $allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>'; 
              echo strip_tags( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'Footer') ,$allowed_tags );
        ?></p>
        <?php do_action('amp_footer_link'); ?>
      </div>
  </footer>
<?php do_action('ampforwp_global_after_footer'); ?>
