<?php
global $redux_builder_amp;
// Slide in Menu
class AMPforWP_Menu_Walker extends Walker_Nav_Menu {
	protected $accordion_started = FALSE;
	protected $accordion_childs_started = FALSE;
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
	}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $this->accordion_childs_started ) {
			$this->end_accordion_child_wrapper( $output, $depth );
		}

		if ( $this->accordion_started ) {
			$this->end_accordion( $output, $depth );
		}

	}
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			 $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
			 $classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			 $classes[] = 'menu-item-' . $item->ID;
			 $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			 $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			 if ( $this->has_children ) {
				 set_transient( 'ampforwp_has_nav_child', true, 3 );
				 $this->start_accordion( $output, $depth );
				 $output .= '<h6 ' . $class_names . '>';
				 $output .= strip_tags( $this->get_anchor_tag( $item, $depth, $args, $id ) , '<a>');
				 $output .= '</h6>';
				 $this->start_accordion_child_wrapper( $output, $depth );
			 } else {
				 $output .= '<li ' . $class_names . '>';
				 $output .= strip_tags( $this->get_anchor_tag( $item, $depth, $args, $id ) , '<a>');
				 $output .= '</li>';
			 }
		 }


	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
	}
	public function start_accordion( &$output, $depth = 0 ) {

		$output .= "<amp-accordion><section>";

		$this->accordion_started = TRUE;
		$this->enqueue_accordion = TRUE;
	}
	public function end_accordion( &$output, $depth = 0 ) {

		$output .= "</section></amp-accordion>";

		$this->accordion_started = FALSE;
	}
	public function start_accordion_child_wrapper( &$output, $depth = 0 ) {

		$output .= "\n<div>\n";

		$this->accordion_childs_started = TRUE;
	}
	public function end_accordion_child_wrapper( &$output, $depth = 0 ) {

		$output .= "</div>\n";

		$this->accordion_childs_started = FALSE;
	}
	public function get_anchor_tag( $item, $depth, $args, $id ) {

		$current_el = '';

		parent::start_el( $current_el, $item, $depth, $args, $id );

		// Unwrap li tag
		if ( preg_match( '#<\s*li\s* [^>]* > (.+) #ix', $current_el, $matched ) ) {
			return $matched[1];
		}

		return $this->make_anchor_tag( $item, $args, $depth );
	}

	protected function make_anchor_tag( $item, $args, $depth ) {

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		return $item_output;
	}
}

// Add required Fonts for Design 3
add_filter( 'amp_post_template_data', 'ampforwp_add_design3_required_fonts' );
function ampforwp_add_design3_required_fonts( $data ) {

	$data['font_urls']['roboto_slab_pt_serif'] = 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|PT+Serif:400,700';
	unset($data['font_urls']['merriweather']);

	return $data;

}

// Add required Javascripts for Design 3
add_filter( 'amp_post_template_data', 'ampforwp_add_design3_required_scripts', 100 );
function ampforwp_add_design3_required_scripts( $data ) {
	global $redux_builder_amp;
	$amp_menu_has_child = get_transient( 'ampforwp_has_nav_child' );

	// Add Scripts only when AMP Menu is Enabled
	if( has_nav_menu( 'amp-menu' ) ) {
		if ( empty( $data['amp_component_scripts']['amp-accordion'] ) ) {
			$data['amp_component_scripts']['amp-accordion'] = 'https://cdn.ampproject.org/v0/amp-accordion-0.1.js';
		}
	}
	// Add Scripts only when Homepage AMP Featured Slider is Enabled
	if( is_home() ) {
 
		if ( $redux_builder_amp['amp-design-3-featured-slider'] == 1 && $redux_builder_amp['amp-design-selector'] == 3 && $redux_builder_amp['amp-frontpage-select-option'] == 0 ||  get_option( 'page_for_posts' ) && get_queried_object_id() ) {

			if ( empty( $data['amp_component_scripts']['amp-carousel'] ) ) {
				$data['amp_component_scripts']['amp-carousel'] = 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js';
			}
    	}
    }
	return $data;
}

