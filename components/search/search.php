<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//main output function
function ampforwp_framework_get_search_form() {
		global $redux_builder_amp;
		$action_url = '';
		$amp_query_variable = '';
		$amp_query_variable_val = '';
		$label = esc_html__(ampforwp_translation(ampforwp_get_setting('ampforwp-search-label'), 'Type your search query and hit enter'));
		$action_url = ( get_bloginfo('url') );
		$action_url = preg_replace('#^http?:#', '', $action_url);
		$placeholder = ampforwp_translation($redux_builder_amp['ampforwp-search-placeholder'], 'Type Here' );
		if (function_exists('pll__')) {
			$placeholder = pll__(esc_html__( ampforwp_get_setting('ampforwp-search-placeholder'), 'accelerated-mobile-pages'));
		}
		$rand = rand(10,100);
		$value = get_search_query();
		$name = 's';
		$mob_pres_link = false;
	    if(function_exists('ampforwp_mobile_redirect_preseve_link')){
	      $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	    }
		if (ampforwp_get_setting('ampforwp-amp-takeover') == false && $mob_pres_link == false) { 
			$amp_query_variable = 'amp';
			$amp_query_variable_val = '1';
		}
		if (ampforwp_get_setting('ampforwp-search-google')) {
			$action_url = 'https://www.google.com/search';
			$amp_query_variable = '';
			$value = 'site:'.get_bloginfo('url').$value;
			$name = 'q';
		}
	  $form = '<form role="search" method="get" class="amp-search" target="_top" action="' . esc_url($action_url)  .'">
				<div class="amp-search-wrapper">
					<label aria-label="Type your query" class="screen-reader-text" for="s">' . esc_html__($label,'accelerated-mobile-pages') . '</label>
					<input type="text" placeholder="AMP" value="'.esc_attr($amp_query_variable_val).'" name="'.esc_attr($amp_query_variable).'" class="hidden"/>
					<label aria-label="search text"  for="search-text-'.esc_attr($rand).'"></label>
					<input id="search-text-'.esc_attr($rand).'" type="text" placeholder="'.esc_attr($placeholder).'" value="' . esc_attr($value).'" name="'.esc_attr($name).'" class="s" />
					<label aria-label="Submit amp search" for="amp-search-submit" >
						<input type="submit" class="icon-search" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
					</label>
					<div class="overlay-search">
					</div>
				</div>
				</form>';
		$form = apply_filters( 'ampforwp_search_form_data', $form );		
	    echo $form;	// XSS OK
}
ampforwp_add_scripts();
function ampforwp_add_scripts(){
	global $scriptComponent;
	if ( empty( $scriptComponent['amp-form'] ) ) {
			$scriptComponent['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
		}
}