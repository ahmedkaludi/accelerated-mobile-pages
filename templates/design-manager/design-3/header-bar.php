<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="left">
    <?php global $redux_builder_amp; ?>
    <div class="toggle-navigationv2">
      <div class="navigation_heading"><?php echo esc_html( $redux_builder_amp['amp-translator-navigate-text'] ); ?></div> 
      <?php
          wp_nav_menu( array(
              'theme_location' => 'amp-menu',
              'walker' => new AMPforWP_Menu_Walker()
          ) ); ?>
          <div class="social_icons">
            <ul>
                <li class="icon-twitter"></li>  
                <li class="icon-facebook"></li>  
                <li class="icon-pinterest"></li>  
                <li class="icon-google-plus"></li>  
                <li class="icon-linkedin"></li>  
                <li class="icon-youtube-play"></li>  
                <li class="icon-instagram"></li>  
                <li class="icon-tumblr"></li>  
                <li class="icon-vk"></li>  
                <li class="icon-whatsapp"></li>  
                <li class="icon-reddit-alien"></li>  
                <li class="icon-snapchat-ghost"></li>  
            </ul>
          </div>
  </div>
</amp-sidebar>

<div id="designthree" class="designthree main_container">
<header class="container">
  <div id="headerwrap">
      <div id="header">
        <div class="hamburgermenu">
            <button class="toast pull-left" on='tap:sidebar.toggle'><span></span></button>
        </div>
        <div class="headerlogo">
        <?php global $redux_builder_amp;
          if ($redux_builder_amp['amp-on-off-support-for-non-amp-home-page']) {
            $ampforwp_home_url = trailingslashit( get_bloginfo('url') );
          }else{
            $ampforwp_home_url = trailingslashit( get_bloginfo('url') ) . '?' . AMP_QUERY_VAR;
          }
        ?>
        <?php if ( true == ($redux_builder_amp['opt-media']['url']) ) {  ?>
          <a href="<?php echo esc_url( $ampforwp_home_url ); ?>">
              <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="logo" class="amp-logo"></amp-img>
          </a>
        <?php } else { ?>
          <h1><a href="<?php echo esc_url( $ampforwp_home_url ); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php } ?>
        </div>
        <div class="searchmenu"><button on="tap:search-icon"><i class="icono-search"></i></button>          </div>
      </div>
  </div>
</header>