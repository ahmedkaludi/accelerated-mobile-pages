<?php global $redux_builder_amp;
  wp_reset_postdata();?>
  <footer class="container">
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

        <p>
            <a href="#header">
              <?php echo ampforwp_translation( $redux_builder_amp['amp-translator-top-text'], 'Top'); ?> </a> <?php
                if($redux_builder_amp['amp-footer-link-non-amp-page']=='1') { ?> |  <?php ampforwp_view_nonamp(); 
                } ?>
        
            <?php
              global $allowed_html;
              echo wp_kses( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'Footer'),$allowed_html);
              ?>
        </p>
      </div>
  </footer>
<?php do_action('ampforwp_global_after_footer'); ?>
