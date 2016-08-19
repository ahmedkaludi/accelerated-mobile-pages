<?php global $redux_builder_amp; ?>
  <?php if($redux_builder_amp['enable-amp-ads-2'] == true) { ?>
      <div class="amp-ad-wrapper">
        <div class="disclosure-message">
<p>ADVERTISEMENT</p>
</div>
      <amp-ad class="amp-ad-2"
      <?php if($redux_builder_amp['enable-amp-ads-select-2'] == 1) : ?>
        width=300 height=250
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 2) :?>
        width=336 height=280
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 3) :?>
        width=728 height=90
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 4) :?>
        width=300 height=600
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 5) :?>
        width=320 height=100
      <?php endif?>
        type="adsense"
        data-ad-client="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-client-2']; ?>"
        data-ad-slot="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-slot-2']; ?>">
      </amp-ad>
      </div>
  <?php } ?>
</main>

    <footer class="container">
        <div id="footer">
          <a href="https://technutty.co.uk">
<amp-img src="https://mufasa.technutty.co.uk/wp-content/uploads/2016/08/17021358/TechNuttyAmpLogo.png" width="190" height="36" alt="logo" class="amp-logo -amp-element -amp-layout-fixed -amp-layout-size-defined -amp-layout" id="AMP_1">

</amp-img>
</a>
  <p><?php echo $redux_builder_amp['amp-footer-text']; ?> </p>
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
    <?php //wp_footer(); ?>

    <amp-user-notification layout=nodisplay
      id="amp-user-notification1">
  TechNutty uses cookiees to personalise your experience, make the site more performant, and to remember settings.
    <button on="tap:amp-user-notification1.dismiss">I accept</button>
  </amp-user-notification>

<amp-analytics type="googleanalytics" id="analytics1">
<script type="application/json">
{
  "vars": {
    "account": "<?php echo $redux_builder_amp['ga-feild']; ?>"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>

	</body>
</html>
