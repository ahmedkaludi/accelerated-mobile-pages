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
        $menu_args = array(
                        'theme_location' => 'amp-menu',
                        'link_before'     => '<span>',
                        'link_after'     => '</span>',
                        'menu'=>'ul',
                        'menu_class'=>'amp-menu',
                        'echo'=>false,
                        'walker' => true
                    );
        amp_menu( true, $menu_args, 'header' ); ?>     
      </nav>
      <?php } 
      do_action('ampforwp_after_amp_menu'); ?>
          <div class="social_icons">
            <ul>
              <?php if( ampforwp_get_setting('enable-single-twittter-profile') && ampforwp_get_setting('enable-single-twittter-profile-url') !== '') { ?>
                <li class="icon-twitter"><a title="twitter profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-twittter-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-facebook-profile')  && ampforwp_get_setting('enable-single-facebook-profile-url') !== '') { ?>
                <li class="icon-facebook"><a title="facebook profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-facebook-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting( 'enable-single-pintrest-profile')  && ampforwp_get_setting('enable-single-pintrest-profile-url') !== '') { ?>
                <li class="icon-pinterest"><a title="pinterest profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-pintrest-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-google-plus-profile')  && ampforwp_get_setting('enable-single-google-plus-profile-url') !== '') { ?>
                <li class="icon-google-plus"><a title="google plus profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-google-plus-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-linkdin-profile')  && ampforwp_get_setting('enable-single-linkdin-profile-url') !== '') { ?>
                <li class="icon-linkedin"><a title="linkedin profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-linkdin-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-youtube-profile')  && ampforwp_get_setting('enable-single-youtube-profile-url') !== '') { ?>
                <li class="icon-youtube-play"><a title="youtube profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-youtube-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-instagram-profile')  && ampforwp_get_setting('enable-single-instagram-profile-url') !== '') { ?>
                <li class="icon-instagram"><a title="instagram profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-instagram-profile-url']); ?>" target ="_blank"></a>  </li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-reddit-profile')  && ampforwp_get_setting('enable-single-reddit-profile-url') !== '') { ?>
                <li class="icon-reddit-alien"><a title="reddit profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-reddit-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-VKontakte-profile')  && ampforwp_get_setting('enable-single-VKontakte-profile-url') !== '') { ?>
                <li class="icon-vk"><a title="vkontakte profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-VKontakte-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>


                <?php if( ampforwp_get_setting('enable-single-snapchat-profile')  && ampforwp_get_setting('enable-single-snapchat-profile-url') !== '') { ?>
                <li class="icon-snapchat-ghost"><a title="snapchat profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-snapchat-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-Tumblr-profile')   && ampforwp_get_setting('enable-single-Tumblr-profile-url') !== '') { ?>
                <li class="icon-tumblr"><a title="tumblr profile" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-Tumblr-profile-url']); ?>" target ="_blank"></a></li>
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