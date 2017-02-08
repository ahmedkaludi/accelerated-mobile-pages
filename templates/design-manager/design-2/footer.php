<?php global $redux_builder_amp;
  wp_reset_postdata();

  $ampforwp_backto_nonamp = " ";
  if ( is_home() ) {
    $ampforwp_backto_nonamp = untrailingslashit(home_url()).'?nonamp=1';
  }
  if ( is_single() ){
    global $post;
    $ampforwp_backto_nonamp = untrailingslashit(get_permalink( $post->ID )).'?nonamp=1';
  }
  if ( is_page() ){
    global $post;
    $ampforwp_backto_nonamp = untrailingslashit(get_permalink( $post->ID )).'?nonamp=1';
  }
  if( is_archive() ) {
    global $wp;
    $ampforwp_backto_nonamp = esc_url( untrailingslashit(home_url( $wp->request )).'?nonamp=1' );
  }
  ?>

<footer class="container">
        <div id="footer">
        <a class="non-amp-link full-footer-link" href="<?php echo $ampforwp_backto_nonamp; ?>"></a>
        <a class="to-top-link full-footer-link" href="#header"></a>
          <a href="https://technutty.co.uk">
<amp-img src="https://technutty.co.uk/TechNuttyAmpLogo.png" width="600" height="60" alt="logo" class="amp-logo" layout=responsive id="AMP_1">

</amp-img>
</a>
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

            <div class="meta-footer">
            <a href="https://technutty.co.uk/about/'">About</a> / <a href="https://technutty.co.uk/contact/'">Contact</a> / <a href="https://technutty.co.uk/terms-and-conditions/'">Terms and Conditions</a> / <a href="https://technutty.co.uk/privacy-policy/'">Privacy Policy</a> 
                                             <ul>
<button onclick="window.location.href='<?php echo $ampforwp_backto_nonamp; ?>'" class="bttn-footer-link bttn-tn bttn-non-amp">View the Non-AMP version</button>                                      
<button onclick="window.location.href='#header'" class="bttn-footer-link bttn-tn bttn-primary">Top</button>
<button onclick="window.location.href='https://technutty.co.uk/about/'" class="bttn-footer-link bttn-tn bttn-primary">About</button>
<button onclick="window.location.href='https://technutty.co.uk/contact/'" class="bttn-footer-link bttn-tn bttn-primary">Contact</button>
<button onclick="window.location.href='https://technutty.co.uk/newsletter/'" class="bttn-footer-link bttn-tn bttn-primary">Newsletter</button>
<button onclick="window.location.href='https://technutty.co.uk/terms-and-conditions/'" class="bttn-footer-link bttn-tn bttn-primary">T&Cs</button>
<button onclick="window.location.href='https://technutty.co.uk/privacy-policy/'" class="bttn-footer-link bttn-tn bttn-primary">Privacy Policy</button>
                                               </ul>

            																                       </div>
        </div>
    </footer>

<?php do_action('ampforwp_global_after_footer'); ?>

