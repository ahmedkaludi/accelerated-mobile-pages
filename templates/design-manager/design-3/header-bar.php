<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
<amp-sidebar id='sidebar'
    layout="nodisplay"
    <?php if ( true == $redux_builder_amp['amp-rtl-select-option'] ) 
        { echo 'side="right"';} else{ 
          if( ampforwp_get_setting('header-overlay-position-d3') == 1 ){
            echo 'side="left"';
          }else{
            echo 'side="right"';
           } 
          }?> >
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
          <div class="so_i">
            <ul>
              <?php if( ampforwp_get_setting('enable-single-twittter-profile') && ampforwp_get_setting('enable-single-twittter-profile-url') !== '') { ?>
                <li class="icon-twitter"><a title="twitter profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-twittter-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-facebook-profile')  && ampforwp_get_setting('enable-single-facebook-profile-url') !== '') { ?>
                <li class="icon-facebook"><a title="facebook profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-facebook-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting( 'enable-single-pintrest-profile')  && ampforwp_get_setting('enable-single-pintrest-profile-url') !== '') { ?>
                <li class="icon-pinterest"><a title="pinterest profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-pintrest-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-google-plus-profile')  && ampforwp_get_setting('enable-single-google-plus-profile-url') !== '') { ?>
                <li class="icon-google-plus"><a title="google plus profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-google-plus-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-linkdin-profile')  && ampforwp_get_setting('enable-single-linkdin-profile-url') !== '') { ?>
                <li class="icon-linkedin"><a title="linkedin profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-linkdin-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-youtube-profile')  && ampforwp_get_setting('enable-single-youtube-profile-url') !== '') { ?>
                <li class="icon-youtube-play"><a title="youtube profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-youtube-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-instagram-profile')  && ampforwp_get_setting('enable-single-instagram-profile-url') !== '') { ?>
                <li class="icon-instagram"><a title="instagram profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-instagram-profile-url']); ?>" target ="_blank"></a>  </li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-reddit-profile')  && ampforwp_get_setting('enable-single-reddit-profile-url') !== '') { ?>
                <li class="icon-reddit-alien"><a title="reddit profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-reddit-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-VKontakte-profile')  && ampforwp_get_setting('enable-single-VKontakte-profile-url') !== '') { ?>
                <li class="icon-vk"><a title="vkontakte profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-VKontakte-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>


                <?php if( ampforwp_get_setting('enable-single-snapchat-profile')  && ampforwp_get_setting('enable-single-snapchat-profile-url') !== '') { ?>
                <li class="icon-snapchat-ghost"><a title="snapchat profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-snapchat-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                <?php if( ampforwp_get_setting('enable-single-Tumblr-profile')   && ampforwp_get_setting('enable-single-Tumblr-profile-url') !== '') { ?>
                <li class="icon-tumblr"><a title="tumblr profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($redux_builder_amp['enable-single-Tumblr-profile-url']); ?>" target ="_blank"></a></li>
                <?php } ?>

                 <?php if( ampforwp_get_setting('enable-single-telegram-profile')   && ampforwp_get_setting('enable-single-telegram-profile-url') !== '') { ?>
                <li class="icon-telegram"></i><a title="telegram profile" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url(ampforwp_get_setting('enable-single-telegram-profile-url')); ?>" target ="_blank"><amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ1NS43MzEgNDU1LjczMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDU1LjczMSA0NTUuNzMxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8cmVjdCB4PSIwIiB5PSIwIiBzdHlsZT0iZmlsbDojNjFBOERFOyIgd2lkdGg9IjQ1NS43MzEiIGhlaWdodD0iNDU1LjczMSIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTguODQ0LDEwMC42TDU0LjA5MSwyMTkuMzU5Yy05Ljg3MSwzLjg0Ny05LjI3MywxOC4wMTIsMC44ODgsMjEuMDEybDc3LjQ0MSwyMi44NjhsMjguOTAxLDkxLjcwNiAgIGMzLjAxOSw5LjU3OSwxNS4xNTgsMTIuNDgzLDIyLjE4NSw1LjMwOGw0MC4wMzktNDAuODgybDc4LjU2LDU3LjY2NWM5LjYxNCw3LjA1NywyMy4zMDYsMS44MTQsMjUuNzQ3LTkuODU5bDUyLjAzMS0yNDguNzYgICBDMzgyLjQzMSwxMDYuMjMyLDM3MC40NDMsOTYuMDgsMzU4Ljg0NCwxMDAuNnogTTMyMC42MzYsMTU1LjgwNkwxNzkuMDgsMjgwLjk4NGMtMS40MTEsMS4yNDgtMi4zMDksMi45NzUtMi41MTksNC44NDcgICBsLTUuNDUsNDguNDQ4Yy0wLjE3OCwxLjU4LTIuMzg5LDEuNzg5LTIuODYxLDAuMjcxbC0yMi40MjMtNzIuMjUzYy0xLjAyNy0zLjMwOCwwLjMxMi02Ljg5MiwzLjI1NS04LjcxN2wxNjcuMTYzLTEwMy42NzYgICBDMzIwLjA4OSwxNDcuNTE4LDMyNC4wMjUsMTUyLjgxLDMyMC42MzYsMTU1LjgwNnoiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" height="16" width="16"></amp-img></a></li>
                <?php } ?>
            </ul>
          </div>
  </div>
    <div on='tap:sidebar.toggle' role="button" class="cl-btn" tabindex="initial"></div>
</amp-sidebar>
<?php } ?>
<div id="designthree" class="designthree main_container">
<?php do_action('ampforwp_admin_menu_bar_front');
      do_action('ampforwp_reading_progress_bar'); ?>
<header class="container design3-header">
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