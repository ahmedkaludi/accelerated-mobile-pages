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
			add_theme_support('ampforwp-has-nav-child', true);

			$this->start_accordion( $output, $depth );

			$output .= '<h6 ' . $class_names . '>';
			$output .= $this->get_anchor_tag( $item, $depth, $args, $id );
			$output .= '</h6>';

			$this->start_accordion_child_wrapper( $output, $depth );

		} else {

			$output .= '<li ' . $class_names . '>';
			$output .= $this->get_anchor_tag( $item, $depth, $args, $id );
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
add_filter( 'amp_post_template_data', 'ampforwp_add_design3_required_scripts' );
function ampforwp_add_design3_required_scripts( $data ) {
	global $redux_builder_amp;

	// Add Scripts only when Search is Enabled
	if( $redux_builder_amp['amp-design-3-search-feature'] ) {
		if ( empty( $data['amp_component_scripts']['amp-lightbox'] ) ) {
			$data['amp_component_scripts']['amp-lightbox'] = 'https://cdn.ampproject.org/v0/amp-lightbox-0.1.js';
		}
		if ( empty( $data['amp_component_scripts']['amp-form'] ) ) {
			$data['amp_component_scripts']['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
		}
	}
	// Add Scripts only when AMP Menu is Enabled	
	if( has_nav_menu( 'amp-menu' ) ) { 
		if ( empty( $data['amp_component_scripts']['amp-accordion'] ) ) {
			$data['amp_component_scripts']['amp-accordion'] = 'https://cdn.ampproject.org/v0/amp-accordion-0.1.js';
		}	
	}
	// Add Scripts only when Homepage AMP Featured Slider is Enabled
	if( is_home() ) { 

		if ( $redux_builder_amp['amp-design-3-featured-slider'] == 1 ) {
			
			if ( empty( $data['amp_component_scripts']['amp-carousel'] ) ) {
				$data['amp_component_scripts']['amp-carousel'] = 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js';
			}
    	} 
    }
	return $data;
}

// Search Form
function ampforwp_get_search_form() {
    $form = '<form role="search" method="get" id="searchform" class="searchform" target="_top" action="' . get_bloginfo('url')  .'">
                <div>
                    <label class="screen-reader-text" for="s">' . _x( 'Type your search query and hit enter:', 'label' ) . '</label>
                    <input type="text" placeholder="AMP" value="1" name="amp" class="hide" id="ampsomething" />
                    <input type="text" placeholder="Type here" value="' . get_search_query() . '" name="s" id="s" />
                    <input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
                </div>
            </form>';
    return $form;
}
function ampforwp_the_search_form() {
    echo ampforwp_get_search_form();
}