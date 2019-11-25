<?php global $redux_builder_amp; ?>
<?php do_action('ampforwp_admin_menu_bar_front'); 
ampforwp_pagescroll_progress_bar(); ?>
<header class="container design2-header">
  <div id="headerwrap">
      <div id="header">
        <?php do_action('ampforwp_header_top_design2'); ?>
        <?php amp_logo(); ?>
        <?php if(true == ampforwp_get_setting('d123-signin-button') ) { ?>
          <div class="d1-cta-wrap">   
            <a target="_blank" <?php ampforwp_nofollow_cta_header_link(); ?> href="<?php echo esc_url(ampforwp_get_setting('d123-signin-button-link'))?>"><?php echo esc_html__(ampforwp_get_setting('d123-signin-button-text'), 'accelerated-mobile-pages'); ?></a>
          </div>
        <?php } ?>
        <?php do_action('ampforwp_header_search'); ?>
        <?php do_action('ampforwp_call_button');
        do_action('ampforwp_header_bottom_design2'); ?>
      </div>
  </div>
</header>

<?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
<div on='tap:sidebar.toggle' aria-label="Navigation" role="button" tabindex="0" class="nav_container">
	<a href="#" class="toggle-text"><?php echo esc_attr(ampforwp_translation( $redux_builder_amp['amp-translator-navigate-text'], 'Navigate' )); ?></a>
</div>

<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="<?php echo (ampforwp_get_setting('header-overlay-position-d2') == 1 )? 'right':'left'; ?>">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
        <nav id ="primary-amp-menu">
          <?php
          $menu_args =  array(
                          'theme_location' => 'amp-menu' ,
                          'link_before'     => '<span>',
                          'link_after'     => '</span>',
                          'menu'           =>'ul',
                          'echo' => false,
                          'menu_class' => 'menu amp-menu',
                          'walker' => true
                        );
          amp_menu(true, $menu_args, 'header' ); ?>
        </nav>
        <?php do_action('ampforwp_after_amp_menu'); ?>
  </div>
</amp-sidebar>
<?php } ?>