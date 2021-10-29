<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

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

    $class_names = join( ' ', apply_filters( 'ampforwp_nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $lmenu = "";
    if($item->url=="" || $item->url=="#"){
      $lmenu = "link-menu";
    }
    $jump_link = false;
    $parse_url = wp_parse_url($item->url);
    if( function_exists('ampforwp_get_setting') && ampforwp_get_setting('amp-design-selector') == 4 && (strpos($item->url, '#') === 0 || isset($parse_url['fragment']) ) ){
      $jump_link = true;
    }

    $class_names = ' class="' . esc_attr( $class_names ) . ' '.esc_attr($lmenu).'"';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $has_children = 1;

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr(  $atts['title'] ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $atts['target']     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $atts['rel']        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $atts['href']        ) .'"' : '';
    
    if($jump_link == true){
      $attributes .= 'on="tap:AMP.setState({ offcanvas_menu: false })" role="button " tabindex="0"';
    }

    // Check if menu item is in main menu
    if ( $depth == 0 && $has_children > 0  ) {
        // These lines adds your custom class and attribute
        $attributes .= ' class="dropdown-toggle"';
        $attributes .= ' data-toggle="dropdown"';
    }
    global $is_safari; 
    if ($is_safari || ( isset($_SERVER["HTTP_USER_AGENT"]) && strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))) {
      $attributes .= 'on="tap:sidebar.close"';
    }
    $item_output = isset($args->before) ? $args->before : 1;
  
    $item_output .= '<a'. $attributes .'>';
    $item_output .= (isset($args->link_before) ? $args->link_before : 1 ). apply_filters( 'the_title', $item->title, $item->ID ) . (isset($args->link_after) ? $args->link_after : 1 );
    $item_output .= '</a>';
  
  // Add the caret if menu level is 0
    if ( $has_children > 0  ) {
        //$item_output .= '<label for="drop-"'.$depth.' class="toggle">+</label>';
    }
    $item_output .= isset($args->after) ? $args->after : 1;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

}
/*Sidebar Nav menu Walker end*/