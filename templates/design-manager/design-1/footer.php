<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
wp_reset_postdata(); ?>
<footer class="amp-wp-footer">
	<div id="footer">
    <?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
        <div class="f-w-blk">
            <div class="d3f-w">
              <?php 
              $sidebar_output = '';
              $sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-footer-widget-area');
              if ( $sanitized_sidebar) {
                $sidebar_output = $sanitized_sidebar->get_amp_content();
                $sidebar_output = ampforwp_show_yoast_seo_local_map($sidebar_output);
                $sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
                $sidebar_output = preg_replace_callback('/<form(.*?)>(.*?)<\/form>/s', function($match){
                  if(strpos($match[1], 'target=') === false){
                    return '<form'.$match[1].' target="_top">'.$match[2].'</form>';
                  }else{
                    return '<form'.$match[1].'>'.$match[2].'</form>';
                  } 
                }, $sidebar_output);
              } 
              echo do_shortcode($sidebar_output); 
              ?>
            </div>
        </div>
    <?php endif; ?>
		<?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
      <div class="footer_menu"> 
          <nav>
            <?php 
            $menu_args = array(
                              'theme_location' => 'amp-footer-menu',
                              'link_before'     => '<span>',
                              'link_after'     => '</span>',
                              'echo' => false
                            );
            amp_menu(true, $menu_args, 'footer'); ?>
          </nav>
        </div>
    <?php } ?>
		<h2><?php echo esc_attr( $this->get( 'blog_name' ) ); ?></h2>
    <div class="cpr-links">
		<p class="copyright_txt"><?php
			$allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>';
      if (function_exists('pll__')) {
      echo strip_tags( pll__(ampforwp_get_setting('amp-translator-footer-text')) ,$allowed_tags );
      }else {
        echo strip_tags( ampforwp_translation(do_shortcode(ampforwp_get_setting('amp-translator-footer-text')), 'All Rights Reserved') ,$allowed_tags );
      }?></p>
    <?php
    if ( true == ampforwp_get_setting('amp-footer-link-non-amp-page') ) { ?><p class="rightslink back-to-top"><?php 
    if(true == ampforwp_get_setting('amp-footer-link-non-amp-page')){
      ampforwp_view_nonamp();
    }
    echo "</p>";
      }; 
    ?></div>
  </div>
</footer><?php do_action('amp_footer_link'); ?>
<?php do_action('ampforwp_global_after_footer'); ?>