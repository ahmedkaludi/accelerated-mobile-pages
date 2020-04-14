<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; ?>
<?php do_action('ampforwp_admin_menu_bar_front'); 
      do_action('ampforwp_reading_progress_bar'); ?>
<header id="#top" class="amp-wp-header">
  <div class="ampforwp-logo-area" >
    <?php do_action('ampforwp_header_top_design1'); ?>
    <?php amp_logo(); ?>
        <?php $site_icon_url = $this->get( 'site_icon_url' );
            if ( $site_icon_url ) : ?>
            <amp-img src="<?php echo esc_url( $site_icon_url ); ?>" width="32" height="32" class="amp-wp-site-icon"></amp-img>
        <?php endif; ?>
    <?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
    <div on='tap:sidebar.toggle' role="button" aria-label="Navigation" tabindex="0" class="nav_container">
        <a class="toggle-text">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    <?php } ?>
    <?php do_action('ampforwp_header_search'); ?>
    <?php do_action('ampforwp_call_button');
    do_action('ampforwp_header_bottom_design1'); ?>



  </div>
</header>
<?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="<?php echo (ampforwp_get_setting('header-overlay-position-d1') == 1 )? 'right':'left'; ?>">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
      <nav id ="primary-amp-menu">
        <?php
        $menu_args = array(
                        'theme_location' => 'amp-menu' ,
                        'link_before'     => '<span>',
                        'link_after'     => '</span>',
                        'menu'=>'ul',
                        'echo' => false,
                        'menu_class' => 'menu amp-menu',
                        'walker' => new Ampforwp_Walker_Nav_Menu()
                    );     
        amp_menu( true, $menu_args, 'header' );?>
    </nav>
    <?php do_action('ampforwp_after_amp_menu'); ?>
  </div>
</amp-sidebar>
<?php }
do_action('ampforwp_design_1_after_header');