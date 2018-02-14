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

function ampforwp_swift_social_icons(){
	global $redux_builder_amp;
	if( true == $redux_builder_amp['enable-single-facebook-share'] ) {
		$social_icons[] = 'facebook';
	}
	if( true == $redux_builder_amp['enable-single-twitter-share'] ) {
		$social_icons[] = 'twitter';
	}
	if( true == $redux_builder_amp['enable-single-gplus-share'] ) {
		$social_icons[] = 'google-plus';
	}
	if( true == $redux_builder_amp['enable-single-email-share'] ) {
		$social_icons[] = 'email';
	}
	if( true == $redux_builder_amp['enable-single-pinterest-share'] ) {
		$social_icons[] = 'pinterest';
	}
	if( true == $redux_builder_amp['enable-single-linkedin-share'] ) {
		$social_icons[] = 'linkedin';
	}
	if( true == $redux_builder_amp['enable-single-whatsapp-share'] ) {
		$social_icons[] = 'whatsapp';
	}
	if( true == $redux_builder_amp['enable-single-line-share'] ) {
		$social_icons[] = 'line';
	}
	if( true == $redux_builder_amp['enable-single-vk-share'] ) {
		$social_icons[] = 'VKontakte';
	}
	if( true == $redux_builder_amp['enable-single-odnoklassniki-share'] ) {
		$social_icons[] = 'Odnoklassniki';
	}
	if( true == $redux_builder_amp['ampforwp-facebook-like-button'] ) {
		$social_icons[] = 'facebook-like';
	}
	return $social_icons;
}
// Remove default sticky social from Swift
remove_action('amp_post_template_footer','ampforwp_sticky_social_icons');
remove_action('amp_post_template_css','amp_social_styles',11);
