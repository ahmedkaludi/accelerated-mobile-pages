<?php
global $redux_builder_amp;
wp_reset_postdata();
global $post;
  $ampforwp_backto_nonamp = '';
  if ( is_home() ) {
    if($redux_builder_amp['amp-mobile-redirection']==1)
       $ampforwp_backto_nonamp = trailingslashit(home_url()).'?nonamp=1' ;
    else
       $ampforwp_backto_nonamp = trailingslashit(home_url()) ;
  }
  if ( is_single() ){
    if($redux_builder_amp['amp-mobile-redirection']==1)
      $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )).'?nonamp=1' ;
    else
      $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )) ;
  }
  if ( is_page() ){
    if($redux_builder_amp['amp-mobile-redirection']==1)
        $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )).'?nonamp=1';
    else
      $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID ));
  }
  if( is_archive() ) {
    global $wp;
    if($redux_builder_amp['amp-mobile-redirection']==1){
        $ampforwp_backto_nonamp = esc_url( untrailingslashit(home_url( $wp->request )).'?nonamp=1'  );
        $ampforwp_backto_nonamp = preg_replace('/\/amp\?nonamp=1/','/?nonamp=1',$ampforwp_backto_nonamp);
      }
    else{
        $ampforwp_backto_nonamp = esc_url( untrailingslashit(home_url( $wp->request )) );
        $ampforwp_backto_nonamp = preg_replace('/amp/','',$ampforwp_backto_nonamp);
      }
  } ?>
<footer class="amp-wp-footer">
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
		<h2><?php echo esc_html( $this->get( 'blog_name' ) ); ?></h2>
		<p class="copyright_txt">
			<?php
			global $allowed_html;
			echo wp_kses( ampforwp_translation($redux_builder_amp['amp-translator-footer-text'], 'Footer' ) , $allowed_html) ;
 		?>
		</p>

		<p class="back-to-top">
			<a href="#top"> <?php echo ampforwp_translation( $redux_builder_amp['amp-translator-top-text'], 'Top' ); ?>
			</a>
			<?php
			//24. Added an options button for switching on/off link to non amp page
			if($redux_builder_amp['amp-footer-link-non-amp-page']=='1'){
				if ( $ampforwp_backto_nonamp ) { ?>
				  |
					<a href="<?php echo $ampforwp_backto_nonamp; ?>" rel="nofollow"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-non-amp-page-text'], 'View Non-AMP Version' ) ;?>
					</a> <?php
				}//End of inner condition
			}//End of outer condition?>
		</p>
	</div>
</footer>
<?php do_action('ampforwp_global_after_footer'); ?>