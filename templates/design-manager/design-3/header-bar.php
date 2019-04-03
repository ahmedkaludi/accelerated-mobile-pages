<?php global $redux_builder_amp;
if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
<amp-sidebar id='sidebar'
    layout="nodisplay"
    <?php if ( true == $redux_builder_amp['amp-rtl-select-option'] ) 
        { echo 'side="right"';} else{ echo 'side="left"'; } ?>>
    <?php global $redux_builder_amp; ?>
    <div class="toggle-navigationv2">

      <?php
      if( has_nav_menu( 'amp-menu' ) ) { ?>
        <div class="navigation_heading"><?php echo esc_attr(ampforwp_translation( $redux_builder_amp['amp-translator-navigate-text'] , 'Navigate' )); ?></div>
      
      <?php // Grand child support AND amp-accordion non critical error in Design 3 due to nav #1152 ?>
      <nav id ="primary-amp-menu"> 
        <?php
        require_once AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-walker-nav-menu.php';
        $menu_html_content = wp_nav_menu( array(
            'theme_location' => 'amp-menu',
            'link_before'     => '<span>',
            'link_after'     => '</span>',
            'menu'=>'ul',
            'menu_class'=>'amp-menu',
            'echo'=>false,
            'walker' => new Ampforwp_Walker_Nav_Menu()
        ) );
        $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
        $sanitizer_obj = new AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
        $sanitized_menu =  $sanitizer_obj->get_amp_content();
        echo $sanitized_menu; // amphtml content, no kses
        ?>     
      </nav>
      <?php } 
      do_action('ampforwp_after_amp_menu'); ?>
          <div class="social_icons">
            <ul>

                          <?php global $redux_builder_amp;
                          if( $redux_builder_amp['enable-single-twittter-profile'] && $redux_builder_amp['enable-single-twittter-profile-url'] !== '') { ?>
                            <a title="twitter profile" href="<?php echo esc_url($redux_builder_amp['enable-single-twittter-profile-url']); ?>" target ="_blank"><li class="icon-twitter"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-facebook-profile']  && $redux_builder_amp['enable-single-facebook-profile-url'] !== '') { ?>
                            <a title="facebook profile" href="<?php echo esc_url($redux_builder_amp['enable-single-facebook-profile-url']); ?>" target ="_blank"><li class="icon-facebook"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-pintrest-profile']  && $redux_builder_amp['enable-single-pintrest-profile-url'] !== '') { ?>
                            <a title="pinterest profile" href="<?php echo esc_url($redux_builder_amp['enable-single-pintrest-profile-url']); ?>" target ="_blank"><li class="icon-pinterest"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-google-plus-profile']  && $redux_builder_amp['enable-single-google-plus-profile-url'] !== '') { ?>
                            <a title="google plus profile" href="<?php echo esc_url($redux_builder_amp['enable-single-google-plus-profile-url']); ?>" target ="_blank"><li class="icon-google-plus"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-linkdin-profile']  && $redux_builder_amp['enable-single-linkdin-profile-url'] !== '') { ?>
                            <a title="linkedin profile" href="<?php echo esc_url($redux_builder_amp['enable-single-linkdin-profile-url']); ?>" target ="_blank"><li class="icon-linkedin"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-youtube-profile']  && $redux_builder_amp['enable-single-youtube-profile-url'] !== '') { ?>
                            <a title="youtube profile" href="<?php echo esc_url($redux_builder_amp['enable-single-youtube-profile-url']); ?>" target ="_blank"><li class="icon-youtube-play"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-instagram-profile']  && $redux_builder_amp['enable-single-instagram-profile-url'] !== '') { ?>
                            <a title="instagram profile" href="<?php echo esc_url($redux_builder_amp['enable-single-instagram-profile-url']); ?>" target ="_blank">  <li class="icon-instagram"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-reddit-profile']  && $redux_builder_amp['enable-single-reddit-profile-url'] !== '') { ?>
                            <a title="reddit profile" href="<?php echo esc_url($redux_builder_amp['enable-single-reddit-profile-url']); ?>" target ="_blank"><li class="icon-reddit-alien"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-VKontakte-profile']  && $redux_builder_amp['enable-single-VKontakte-profile-url'] !== '') { ?>
                            <a title="vkontakte profile" href="<?php echo esc_url($redux_builder_amp['enable-single-VKontakte-profile-url']); ?>" target ="_blank"><li class="icon-vk"></li></a>
                            <?php } ?>


                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-snapchat-profile']  && $redux_builder_amp['enable-single-snapchat-profile-url'] !== '') { ?>
                            <a title="snapchat profile" href="<?php echo esc_url($redux_builder_amp['enable-single-snapchat-profile-url']); ?>" target ="_blank"><li class="icon-snapchat-ghost"></li></a>
                            <?php } ?>

                            <?php global $redux_builder_amp;
                            if( $redux_builder_amp['enable-single-Tumblr-profile']   && $redux_builder_amp['enable-single-Tumblr-profile-url'] !== '') { ?>
                            <a title="tumblr profile" href="<?php echo esc_url($redux_builder_amp['enable-single-Tumblr-profile-url']); ?>" target ="_blank"><li class="icon-tumblr"></li></a>
                            <?php } ?>

            </ul>
          </div>
  </div>
    <button class="cl-btn" on='tap:sidebar.toggle'  tabindex="-1"></button>
</amp-sidebar>
<?php } ?>
<div id="designthree" class="designthree main_container">
<header class="container">
  <div id="headerwrap">
      <div id="header">
      <?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
        <div class="hamburgermenu">
            <button class="toast pull-left" on='tap:sidebar.toggle' aria-label="Navigation"><span></span></button>
        </div>
        <?php } ?>
        <div class="headerlogo">
        <?php do_action('ampforwp_header_top_design3'); ?>
        <?php amp_logo(); ?>
        </div>
        <?php do_action('ampforwp_call_button'); ?>
        <?php do_action('ampforwp_header_search');
        do_action('ampforwp_header_bottom_design3'); ?>

      </div>
  </div>
</header>