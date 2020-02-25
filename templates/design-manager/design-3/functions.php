<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
add_filter( 'amp_post_template_data', 'ampforwp_add_design3_required_fonts' );
function ampforwp_add_design3_required_fonts( $data ) {
//	$data['font_urls']['roboto_slab_pt_serif'] = 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|PT+Serif:400,700';
	unset($data['font_urls']['merriweather']);
	return $data;
}

// Add required Javascripts for Design 3
add_filter( 'amp_post_template_data', 'ampforwp_add_design3_required_scripts', 100 );
function ampforwp_add_design3_required_scripts( $data ) {
	global $redux_builder_amp;
	global $wp;
	$current_url = '';
	$current_url_in_pieces = '';

	$current_url = home_url( $wp->request );
	$current_url_in_pieces = explode( '/', $current_url );
	// Add Scripts only when Homepage AMP Featured Slider is Enabled
	if( is_home() ) {
		if ( $redux_builder_amp['amp-design-3-featured-slider'] == 1 && $redux_builder_amp['amp-design-selector'] == 3 && $redux_builder_amp['amp-frontpage-select-option'] == 0 && get_query_var('paged') <= 1 ||  get_option( 'page_for_posts' ) && get_query_var('paged') <= 1 && in_array( ampforwp_name_blog_page() , $current_url_in_pieces ) ) {

			if ( empty( $data['amp_component_scripts']['amp-carousel'] ) ) {
				$data['amp_component_scripts']['amp-carousel'] = 'https://cdn.ampproject.org/v0/amp-carousel-0.2.js';
			}
    	}
    }
	return $data;
}