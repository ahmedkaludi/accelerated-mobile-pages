<?php
global $redux_builder_amp;
  wp_reset_postdata();

  $ampforwp_backto_nonamp = '';
  if ( is_home() ) {
    $ampforwp_backto_nonamp = home_url();
  }
  if ( is_single() ){
    $ampforwp_backto_nonamp = get_permalink( $post->ID );
  }
  if( is_archive() ) {
    global $wp;
    $ampforwp_backto_nonamp = esc_url( home_url( $wp->request ) );
  }
  ?>
<footer class="amp-wp-footer">
	<div>
		<h2><?php echo esc_html( $this->get( 'blog_name' ) ); ?></h2>
		<p class="copyright_txt">
			<?php
			global $allowed_html;
			echo wp_kses($redux_builder_amp['amp-translator-footer-text'],$allowed_html) ;
 		?>
		</p>

		<p class="back-to-top">
			<a href="#top"> <?php echo esc_html( $redux_builder_amp['amp-translator-top-text'] ); ?>
			</a>
			<?php
			//24. Added an options button for switching on/off link to non amp page
			if($redux_builder_amp['amp-footer-link-non-amp-page']=='1'){
				if ( $ampforwp_backto_nonamp ) { ?>
				  |
					<a href="<?php echo $ampforwp_backto_nonamp; ?>"><?php echo esc_html( $redux_builder_amp['amp-translator-non-amp-page-text'] ) ;?>
					</a> <?php
				}//End of inner condition
			}//End of outer condition?>
		</p>

	</div>
</footer>
