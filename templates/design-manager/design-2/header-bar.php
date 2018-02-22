<?php global $redux_builder_amp; ?>
<header class="container">
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
<div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
	<a href="#" class="toggle-text"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-navigate-text'], 'Navigate' ); ?></a>
</div>

<amp-sidebar id='sidebar'
    layout="nodisplay"
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
        <?php // #1229 ?>
        <nav id ="primary-amp-menu" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
         <?php
            $menu_html_content = wp_nav_menu( array(
                                      'theme_location' => 'amp-menu' ,
                                      'link_before'     => '<span itemprop="name">',
                                      'link_after'     => '</span>',
                                      'menu'           =>'ul',
                                      'echo' => false,
                                      'menu_class' => 'menu amp-menu'
                                    ) );
            $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
            $sanitizer_obj = new AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
            $sanitized_menu =  $sanitizer_obj->get_amp_content();
            echo $sanitized_menu; ?>
        </nav>
  </div>
</amp-sidebar>
<?php } ?>