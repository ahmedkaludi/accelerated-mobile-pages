<header class="container">
  <div id="headerwrap">
      <div id="header">

        <?php global $redux_builder_amp;
        $set_rel_to_noamp=false;

        if( $redux_builder_amp['amp-on-off-support-for-non-amp-home-page'] ) {
                if( $redux_builder_amp['amp-mobile-redirection'] ) {
                  $ampforwp_home_url = untrailingslashit( get_bloginfo('url') ).'?nonamp=1';
                  $set_rel_to_noamp = true;
                  } else {
                    $ampforwp_home_url = untrailingslashit( get_bloginfo('url') );
                 }
        } else {
                 if($redux_builder_amp['ampforwp-homepage-on-off-support']) {
                    $ampforwp_home_url = trailingslashit( get_bloginfo('url') ) . AMPFORWP_AMP_QUERY_VAR;
                 } else {
                        if( $redux_builder_amp['amp-mobile-redirection'] ) {
                          $ampforwp_home_url = untrailingslashit( get_bloginfo('url') ).'?nonamp=1';
                          $set_rel_to_noamp = true;
                         } else {
                          $ampforwp_home_url = untrailingslashit( get_bloginfo('url') );
                         }
                }
          }?>

        <?php if ( true == ($redux_builder_amp['opt-media']['url']) ) {  ?>
          <a href="<?php echo esc_url( $ampforwp_home_url ); ?>" rel="nofollow">
            <span class="header-logo-center">
              <amp-img src="https://technutty.co.uk/wp-content/assets/TechNuttyLogo.svg" width="300" height="68" alt="logo" class="amp-logo" layout=responsive id="AMP_1">
              </amp-img>
            </span>
          </a>
        <?php } else { ?>
          <h3><a href="<?php echo esc_url( $ampforwp_home_url ); ?>"  <?php if($set_rel_to_noamp){echo ' rel="nofollow"';} ?>  ><?php bloginfo('name'); ?></a></h3>
        <?php } ?>
          <?php do_action('ampforwp_header_search'); ?>

      </div>
  </div>
</header>

<amp-install-serviceworker
       src="https://technutty.co.uk/sw.js"
       data-iframe-src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/"
       layout="nodisplay">
     </amp-install-serviceworker>

<!-- <div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
	<a href="#" class="toggle-text"><?php echo esc_html( $redux_builder_amp['amp-translator-navigate-text'] ); ?></a>
</div>

<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
      <?php wp_nav_menu( array( 'theme_location' => 'amp-menu' ) ); ?>

  </div>
</amp-sidebar> -->
