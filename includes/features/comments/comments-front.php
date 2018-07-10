<?php
/*
	#2229 Function to check the option for comments to display on post, page or both.
 */
function ampforwp_get_comments_status(){
	global $redux_builder_amp;
	$display_comments_on = "";
	if ( (isset($redux_builder_amp['ampforwp-display-on-pages']) && $redux_builder_amp['ampforwp-display-on-pages']==false ) && (isset($redux_builder_amp['ampforwp-display-on-posts']) && $redux_builder_amp['ampforwp-display-on-posts']==true ) ) {
		$display_comments_on =  is_single();
	}
	if ( (isset($redux_builder_amp['ampforwp-display-on-pages']) && $redux_builder_amp['ampforwp-display-on-pages']==true ) && (isset($redux_builder_amp['ampforwp-display-on-posts']) && $redux_builder_amp['ampforwp-display-on-posts']==false ) ) {
		$display_comments_on =  is_page();
	}
	if ( (isset($redux_builder_amp['ampforwp-display-on-pages']) && $redux_builder_amp['ampforwp-display-on-pages']==true ) && (isset($redux_builder_amp['ampforwp-display-on-posts']) && $redux_builder_amp['ampforwp-display-on-posts']==true ) ) {
		$display_comments_on =  is_singular();
	}
	$display_comments_on = apply_filters('ampforwp_comments_visibility', $display_comments_on);
	return $display_comments_on;
}

// Vuukle Comments Support #2075

add_action('ampforwp_post_after_design_elements','ampforwp_vuukle_comments_support');
function ampforwp_vuukle_comments_support() {
	global $redux_builder_amp;
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
		 && $redux_builder_amp['ampforwp-vuukle-comments-support']==1
		 && comments_open() 
		) {
		echo ampforwp_vuukle_comments_markup();
	}
}
function ampforwp_vuukle_comments_markup() {
	global $redux_builder_amp;
	$apiKey = $locale = '';
	if( isset($redux_builder_amp['ampforwp-vuukle-comments-apiKey']) && $redux_builder_amp['ampforwp-vuukle-comments-apiKey'] !== ""){
		$apiKey = $redux_builder_amp['ampforwp-vuukle-comments-apiKey'];
	}
	$display_comments_on = false;
	$display_comments_on = ampforwp_get_comments_status();

	$srcUrl = 'https://cdn.vuukle.com/amp.html?';
	$srcUrl = add_query_arg('url' ,get_permalink(), $srcUrl);
	$srcUrl = add_query_arg('host' ,site_url(), $srcUrl);
	$srcUrl = add_query_arg('id' , $post->ID, $srcUrl);
	$srcUrl = add_query_arg('apiKey' , $apiKey, $srcUrl); 
	$srcUrl = add_query_arg('title' , $post->post_title, $srcUrl); 

	$vuukle_html ='';
	if ( $display_comments_on ) {
		$vuukle_html .= '<amp-iframe width="600" height="350" layout="responsive" sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms" resizable frameborder="0" src="'.$srcUrl.'">

			<div overflow tabindex="0" role="button" aria-label="Show comments" class="afwp-vuukle-support">Show comments</div>';
	}
	return $vuukle_html;
}
add_filter( 'amp_post_template_data', 'ampforwp_add_vuukle_scripts' );
function ampforwp_add_vuukle_scripts( $data ) {
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
		 && $redux_builder_amp['ampforwp-vuukle-comments-support']
		 && $display_comments_on  && comments_open() 
		) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
			if ($redux_builder_amp['ampforwp-vuukle-Ads-before-comments']==1
			 && empty( $data['amp_component_scripts']['amp-ad'] ) ) {
				$data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
			}
	}
	return $data;
}
//spotim #2076
add_action('ampforwp_post_after_design_elements','ampforwp_spotim_comments_support');
function ampforwp_spotim_comments_support() {
	global $redux_builder_amp;
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-spotim-comments-support'])
		 && $redux_builder_amp['ampforwp-spotim-comments-support']==1
		) {
		echo ampforwp_spotim_comments_markup();
	}
}
function ampforwp_spotim_comments_markup() {
	global $post, $redux_builder_amp; 
	$display_comments_on = false;
	$display_comments_on = ampforwp_get_comments_status();
	if (! $display_comments_on ) {
		return '';
	}
	$spotId ='';
	if( isset($redux_builder_amp['ampforwp-spotim-comments-apiKey']) && $redux_builder_amp['ampforwp-spotim-comments-apiKey'] !== ""){
		$spotId = $redux_builder_amp['ampforwp-spotim-comments-apiKey'];
	}
	$srcUrl = 'https://amp.spot.im/production.html?';
	$srcUrl = add_query_arg('spotId' ,get_permalink(), $srcUrl);
	$srcUrl = add_query_arg('postId' , $post->ID, $srcUrl);
	$spotim_html = '<amp-iframe width="375" height="815" resizable sandbox="allow-scripts allow-same-origin allow-popups allow-top-navigation" layout="responsive"
	  frameborder="0" src="'.$srcUrl.'">
	  <amp-img placeholder height="815" layout="fill" src="//amp.spot.im/loader.png"></amp-img>
	  <div overflow class="spot-im-amp-overflow" tabindex="0" role="button" aria-label="Read more">Load more...</div>
	</amp-iframe>';
	return $spotim_html;
}
//spotim script
add_filter( 'amp_post_template_data', 'ampforwp_add_spotim_scripts' );
function ampforwp_add_spotim_scripts( $data ) {
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-spotim-comments-support'])
		 && $redux_builder_amp['ampforwp-spotim-comments-support']
		 && $display_comments_on  && comments_open() 
		) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
	}
	return $data;
}
//spotim css
add_action('amp_post_template_css','ampforwp_spotim_vuukle_styling',60);
function ampforwp_spotim_vuukle_styling(){
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( isset($redux_builder_amp['ampforwp-spotim-comments-support'])
	 	&& $redux_builder_amp['ampforwp-spotim-comments-support']
	 	&& $display_comments_on  && comments_open() ) {
		?>.spot-im-amp-overflow {
	    background: white;
	    font-size: 15px;
	    padding: 15px 0;
	    text-align: center;
	    font-family: Helvetica, Arial, sans-serif;
	    color: #307fe2;
	  }<?php
	}
	if ( isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
	 	&& $redux_builder_amp['ampforwp-vuukle-comments-support']
	 	&& $display_comments_on  && comments_open() ) { ?>
		.afwp-vuukle-support{
			display: block;text-align: center;background: #1f87e5;color: #fff;border-radius: 4px;
		} <?php 
	}
}