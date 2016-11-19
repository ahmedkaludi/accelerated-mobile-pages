<?php global $redux_builder_amp; ?>
<header id="#top" class="amp-wp-header">
  <div class="ampforwp-logo-area" >

    <a href="<?php echo esc_url( trailingslashit( $this->get( 'home_url' ) ) ) . '?' .AMP_QUERY_VAR; ?>">
      <?php if (true == ($redux_builder_amp['opt-media']['url'])) {  ?>
        <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="logo" class="amp-logo"></amp-img>
      <?php } else {
        echo esc_html( $this->get( 'blog_name' ) ); 
      } ?>
    </a>
  
  <div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
      <a href="#" class="toggle-text"> <?php echo esc_html( $redux_builder_amp['amp-translator-navigate-text'] ); ?></a>
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
