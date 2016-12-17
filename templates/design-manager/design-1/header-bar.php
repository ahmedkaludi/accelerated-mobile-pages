<?php global $redux_builder_amp; ?>
<header id="#top" class="amp-wp-header">
  <div class="ampforwp-logo-area" >
    <?php
    if($redux_builder_amp['amp-on-off-support-for-non-amp-home-page']){
    ?>
      <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ) ); ?>">
      <?php
    }else{
      ?>
      <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ) ) . '?' .AMP_QUERY_VAR; ?>">

    <?php }?>

      <?php if (true == ($redux_builder_amp['opt-media']['url'])) {  ?>
        <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="logo" class="amp-logo"></amp-img>
      <?php } else {
        echo esc_html( $this->get( 'blog_name' ) );
      } ?>
    </a>

    <?php
    if($redux_builder_amp['amp-on-off-support-for-non-amp-home-page']){
    ?>
    <a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>">
    <?php }else{ ?>
    <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ) ) . '?' .AMP_QUERY_VAR; ?>">
    <?php } ?>
        <?php $site_icon_url = $this->get( 'site_icon_url' );
            if ( $site_icon_url ) : ?>
            <amp-img src="<?php echo esc_url( $site_icon_url ); ?>" width="32" height="32" class="amp-wp-site-icon"></amp-img>
        <?php endif; ?>
    </a>

  <div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
      <a href="#" class="toggle-text">
          <span></span>
          <span></span>
          <span></span>
      </a>
  </div>

  </div>

</header>
<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
      <?php wp_nav_menu( array( 'theme_location' => 'amp-menu' ) ); ?>
  </div>
</amp-sidebar>

<?php

do_action('ampforwp_design_1_after_header');
