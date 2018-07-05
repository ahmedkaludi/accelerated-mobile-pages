<?php global $redux_builder_amp; ?>
<header id="#top" class="amp-wp-header">
  <div class="ampforwp-logo-area" >
    <?php do_action('ampforwp_header_top_design1'); ?>
    <?php amp_logo(); ?>
        <?php $site_icon_url = $this->get( 'site_icon_url' );
            if ( $site_icon_url ) : ?>
            <amp-img src="<?php echo esc_url( $site_icon_url ); ?>" width="32" height="32" class="amp-wp-site-icon"></amp-img>
        <?php endif; ?>
    </a>
    <?php if(isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu']){ ?>
    <div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">
        <a href="#" class="toggle-text">
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
    side="right">
  <div class="toggle-navigationv2">
      <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div> <?php
       // schema.org/SiteNavigationElement missing from menus #1229 ?>
      <nav id ="primary-amp-menu" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
         <?php
/*Sidebar Nav menu Walker Start*/
  class Ampforwp_Walker_Nav_Menu extends Walker_Nav_Menu {

  function start_lvl(&$output, $depth=0, $args = array(), $has_children = 0) {
  static $column = 1;
    $indent = str_repeat("\t", $depth);
      //$output .= "\n$indent<ul class=\"sub-menu\">\n";

      // Change sub-menu to dropdown menu
  if ($depth > 0 && $has_children > 0 )
    {
    $column += 1;
    $output .= "\n$indent<input type=\"checkbox\" id=\"drop-$column\"><label for=\"drop-$column\" class=\"toggle\"></label><ul class=\"sub-menu\">\n";
  }else{
    $column += 1;
    $output .= "\n$indent<input type=\"checkbox\" id=\"drop-$column\"><label for=\"drop-$column\" class=\"toggle\"></label><ul class=\"sub-menu\">\n";
    
  }
  }
  
  function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    // Most of this code is copied from original Walker_Nav_Menu
    global $wp_query, $wpdb;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $has_children = $wpdb->get_var("SELECT COUNT(meta_id)
                            FROM wp_postmeta
                            WHERE meta_key='_menu_item_menu_item_parent'
                            AND meta_value='".$item->ID."'");

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    // Check if menu item is in main menu
    if ( $depth == 0 && $has_children > 0  ) {
        // These lines adds your custom class and attribute
        $attributes .= ' class="dropdown-toggle"';
        $attributes .= ' data-toggle="dropdown"';
    }

    $item_output = $args->before;
  
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
  
  // Add the caret if menu level is 0
    if ( $has_children > 0  ) {
        //$item_output .= '<label for="drop-"'.$depth.' class="toggle">+</label>';
    }
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

}
/*Sidebar Nav menu Walker end*/

         $menu_html_content = wp_nav_menu( array(
                                  'theme_location' => 'amp-menu' ,
                                  'link_before'     => '<span itemprop="name">',
                                  'link_after'     => '</span>',
                                  'menu'=>'ul',
                                  'echo' => false,
                                  'menu_class' => 'menu amp-menu',
                                  'walker' => new Ampforwp_Walker_Nav_Menu()
                                ) );
        $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
        $sanitizer_obj = new AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
        $sanitized_menu =  $sanitizer_obj->get_amp_content();
        echo $sanitized_menu;
        ?>
    </nav>
    <?php do_action('ampforwp_after_amp_menu'); ?>
  </div>
</amp-sidebar>
<?php }
do_action('ampforwp_design_1_after_header');