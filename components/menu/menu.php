<?php
class Ampforwp_Walker_Nav_Menu extends Walker_Nav_Menu {

  function start_lvl(&$output, $depth=0, $args = array()) {
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

function amp_menu_html($echo){
	if( has_nav_menu( 'amp-menu' ) ) {
	    $menu_html_content = wp_nav_menu( array(
	            'theme_location' => 'amp-menu',
	            'container'=>'aside',
	            'menu'=>'ul',
	            'menu_class'=>'amp-menu',
	            'echo' => false,
				'walker' => new Ampforwp_Walker_Nav_Menu()
	        ) );
	    $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
	    $sanitizer_obj = new AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
	    $sanitized_menu =  $sanitizer_obj->get_amp_content();
    	return $sanitized_menu;
	}
}

//Load styling for Menu
add_action('amp_post_template_css','amp_menu_styles',11); 
function amp_menu_styles(){ ?>
    aside{width:150px}.amp-menu{list-style-type:none;margin:0;padding:0}.amp-menu li{position:relative;display:block}.amp-menu li.menu-item-has-children ul{display:none}.p-menu .amp-menu li.menu-item-has-children:hover>ul{display:block}.amp-menu [id^=drop]:checked + ul { display: block; }.amp-menu li.menu-item-has-children>ul>li{padding-left:10px}	/* .amp-menu li.menu-item-has-children:after{content:" > ";position:absolute;padding:10px;right:0;top:0;z-index:10000;line-height:1;} */.p-menu .amp-menu>li a{padding:7px;display:block;margin-bottom:1px}.amp-menu>li ul{list-style-type:none;margin:0;padding:0;position:relative}
<?php }