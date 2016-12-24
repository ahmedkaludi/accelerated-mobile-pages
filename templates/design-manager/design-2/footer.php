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
          <a href="https://technutty.co.uk">
<amp-img src="https://technutty.co.uk/TechNuttyAmpLogo.png" width="600" height="60" alt="logo" class="amp-logo -amp-element -amp-layout-fixed -amp-layout-size-defined -amp-layout" id="AMP_1">

</amp-img>
</a>
  <p>
  <a href="<?php echo $ampforwp_backto_nonamp; ?>"><?php echo esc_html( $redux_builder_amp['amp-translator-non-amp-page-text'] ) ;?> </a>
  </p>
  <br>
  <div class="col-sm-4 meta-social-footer">
                                  <div class="social-footer">
                                     <ul>
                                     <li class="social-link-footer"><a href="http://facebook.com/technutty"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                     <li class="social-link-footer"><a href="http://twitter.com/thetechnuttyuk"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                     <li class="social-link-footer"><a href="https://plus.google.com/u/0/b/113424605348271306286/113424605348271306286/posts"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                      <li class="social-link-footer"><a href="https://technutty.tumblr.com"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
                                      <li class="social-link-footer"><a href="https://in.pinterest.com/technuttyuk/technutty-pins/"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                      <li class="social-link-footer"><a href="https://technutty.co.uk/feed"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                      </ul>
                                   </div>
                              </div>
                              <br>

                              <p><a href="#header"> <?php _e('Top','ampwp');?></a> | <a href="?noamp"><?php _e('View Non-AMP Version','ampwp');?></a></p>
<br>

            <p>Version 4.3 | <a class="noamp" href="https://technutty.co.uk/version-history/">Version History Page</a></p>
<br>
            <div class="meta-footer">
                                             <ul>
                                             <li><a href="https://technutty.co.uk/about/">About Us</a></li>
                                             <li><a href="http://status.technutty.co.uk/">Site Status</a></li>
                                             <li><a href="https://technutty.co.uk/contact/">Contact</a></li>
                                             <li><a href="http://technutty.userecho.com/">Feedback</a></li>
                                             <li><a href="https://technutty.co.uk/terms-and-conditions/">Terms and Conditions</a></li>
                                             <li><a href="https://technutty.co.uk/privacy-policy/">Privacy Policy</a></li>
                                             <li><a href="https://technutty.co.uk/cookies-information-page/">Cookies Information Page</a></li>
                                             </ul>

            																                       </div>
        </div>
    </footer>

<?php do_action('ampforwp_global_after_footer'); ?>
