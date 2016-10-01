<header class="container">    
  <div id="headerwrap">
      <div id="header">
          
        <?php global $redux_builder_amp; ?>

        <?php if (true == ($redux_builder_amp['opt-media']['url'])) {  ?>
          <a href="<?php bloginfo('url'); ?>">
              <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="logo" class="amp-logo"></amp-img>
          </a>
        <?php } else {?>
        <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php } ?>

      </div>
  </div>
</header>




<div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
	<a href="#" class="toggle-text"><?php echo $redux_builder_amp['amp-navigation-text']; ?></a>
</div>

   
<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
      <?php wp_nav_menu( array( 'theme_location' => 'amp-menu' ) ); ?>
  </div>
</amp-sidebar>