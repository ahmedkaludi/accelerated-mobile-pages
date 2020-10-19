<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; ?>
<?php do_action('ampforwp_admin_menu_bar_front'); 
      do_action('ampforwp_reading_progress_bar'); ?>
<header class="container design2-header">
  <div id="headerwrap">
      <div id="header">
        <?php do_action('ampforwp_header_top_design2'); ?>
        <?php amp_logo(); ?>
        <?php do_action('ampforwp_header_search'); ?>
        <?php do_action('ampforwp_call_button');
        do_action('ampforwp_header_bottom_design2'); ?>
      </div>
  </div>
</header>

<?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
<div on='tap:sidebar.toggle' aria-label="Navigation" role="button" tabindex="0" class="nav_container">
	<a class="toggle-text"><?php echo esc_attr(ampforwp_translation( $redux_builder_amp['amp-translator-navigate-text'], 'Navigate' )); ?></a>
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