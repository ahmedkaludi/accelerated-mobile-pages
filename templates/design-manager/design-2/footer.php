<?php global $redux_builder_amp;
  wp_reset_postdata();

  $ampforwp_backto_nonamp = " ";
  if ( is_home() ) {
    $ampforwp_backto_nonamp = home_url();
  }
  if ( is_single() ){
    $ampforwp_backto_nonamp = get_permalink( $post->ID );
  }
  if ( is_page() ){
    $ampforwp_backto_nonamp = get_permalink( $post->ID );
  }
  if( is_archive() ) {
    global $wp;
    $ampforwp_backto_nonamp = esc_url( home_url( $wp->request ) );
  }
  ?>
  <footer class="container">
      <div id="footer">
          <p><a href="#header"> <?php echo esc_html( $redux_builder_amp['amp-translator-top-text'] ); ?></a> <?php
  				//24. Added an options button for switching on/off link to non amp page
          if($redux_builder_amp['amp-footer-link-non-amp-page']=='1'){ if ( $ampforwp_backto_nonamp ) { ?>
  					 |
          	<a href="<?php echo $ampforwp_backto_nonamp; ?>"><?php echo esc_html( $redux_builder_amp['amp-translator-non-amp-page-text'] ) ;?> </a> <?php  } }?>
          </p>
          <p>
            <?php
              global $allowed_html;
              echo wp_kses($redux_builder_amp['amp-translator-footer-text'],$allowed_html) ;
              ?>
          </p>
      </div>
  </footer>
<?php do_action('ampforwp_global_after_footer'); ?>
