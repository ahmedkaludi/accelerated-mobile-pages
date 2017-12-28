<?php 
// Loading the Components
// Big Post Image
add_image_size( 'amp-featured-large', 723, 394, true ); 
// Small Post Image
add_image_size( 'amp-featured-small', 346, 188, true );
//Single post leftside Image
add_image_size( 'amp-single-img', 220, 134, true );
//Search
add_amp_theme_support('AMP-search');
//Logo
add_amp_theme_support('AMP-logo');
//Social Icons
add_amp_theme_support('AMP-social-icons');
//Menu
add_amp_theme_support('AMP-menu');
//Call Now
add_amp_theme_support('AMP-call-now');
//Breadcrumb
add_amp_theme_support('AMP-breadcrumb');
//Sidebar
add_amp_theme_support('AMP-sidebar');
// Featured Image
add_amp_theme_support('AMP-featured-image');
//Author box
add_amp_theme_support('AMP-author-box');
//Loop
add_amp_theme_support('AMP-loop');
// Categories and Tags list
add_amp_theme_support('AMP-categories-tags');
// Comments
add_amp_theme_support('AMP-comments');
//Post Navigation
add_amp_theme_support('AMP-post-navigation');
// Related Posts
add_amp_theme_support('AMP-related-posts');
// Post Pagination
add_amp_theme_support('AMP-post-pagination');
// Icons example
add_amp_icon( array( 'widgets', 'search', 'shopping-cart' ) );


add_filter( 'amp_post_template_data', 'ampforwp_framework_header_scripts' ,20);
function ampforwp_framework_header_scripts( $data ) {
	if ( empty( $data['amp_component_scripts']['amp-animation'] ) ) {
		$data['amp_component_scripts']['amp-animation'] = 'https://cdn.ampproject.org/v0/amp-animation-0.1.js';
	}
	if ( empty( $data['amp_component_scripts']['amp-position-observer'] ) ) {
		$data['amp_component_scripts']['amp-position-observer'] = 'https://cdn.ampproject.org/v0/amp-position-observer-0.1.js';
	}
	return $data;
}