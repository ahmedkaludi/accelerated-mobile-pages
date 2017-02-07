<?php global $redux_builder_amp;
  wp_reset_postdata();

  $ampforwp_backto_nonamp = " ";
  if ( is_home() ) {
    $ampforwp_backto_nonamp = home_url();
  }
  if ( is_single() ){
    global $post;
    $ampforwp_backto_nonamp = get_permalink( $post->ID );
  }
  if ( is_page() ){
    global $post;
    $ampforwp_backto_nonamp = get_permalink( $post->ID );
  }
  if( is_archive() ) {
    global $wp;
    $ampforwp_backto_nonamp = esc_url( home_url( $wp->request ) );
  }
  ?>
  <footer class="footer_wrapper container">
      <div id="footer">
          <div class="footer_menu">
              <?php wp_nav_menu( array( 'theme_location' => 'amp-footer-menu' ) ); ?>
          </div>
          <div class="social_icons">
            <ul>
              <li class="icon-twitter"></li>  
              <li class="icon-facebook"></li>  
              <li class="icon-pinterest"></li>  
              <li class="icon-google-plus"></li>  
              <li class="icon-linkedin"></li>  
              <li class="icon-youtube-play"></li>  
              <li class="icon-instagram"></li>  
              <li class="icon-tumblr"></li>  
              <li class="icon-vk"></li>  
              <li class="icon-whatsapp"></li>  
              <li class="icon-reddit-alien"></li>  
              <li class="icon-snapchat-ghost"></li>  
            </ul>
          </div>
          <p class="rightslink">
            <?php
              global $allowed_html;
              echo wp_kses($redux_builder_amp['amp-translator-footer-text'],$allowed_html) ;
              ?>
          </p>
          <p class="poweredby">
              <a href="https://ampforwp.com">Powered by AMPforWP</a>
          <p>
      </div>
  </footer>
</div><!--Design3 Ends-->

<amp-lightbox id="search-icon" layout="nodisplay">
    <?php ampforwp_the_search_form() ?>
    <button on="tap:search-icon.close" class="closebutton">X</button>
    <i class="icono-cross"></i>
</amp-lightbox>
<?php do_action('ampforwp_global_after_footer'); ?>