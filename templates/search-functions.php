<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// 46. search search search everywhere #615
add_action('pre_amp_render_post','ampforwp_search_related_functions',12);
function ampforwp_search_related_functions(){
	global $redux_builder_amp;
	if ( $redux_builder_amp['amp-design-selector'] == 1 ||
	     $redux_builder_amp['amp-design-selector'] == 2 ||
	     $redux_builder_amp['amp-design-selector'] == 3 ) {

				add_filter( 'ampforwp_post_template_data', 'ampforwp_add_lightbox_and_form_scripts');
				add_action('ampforwp_search_form','ampforwp_the_search_form');
	}
}

add_action('ampforwp_global_after_footer','ampforwp_lightbox_html_output');
function ampforwp_lightbox_html_output() {
	if ( is_search_enabled_in_ampforwp() ) {
	  global $redux_builder_amp;
		if( $redux_builder_amp['amp-design-1-search-feature'] ||
		    $redux_builder_amp['amp-design-2-search-feature'] ||
		    $redux_builder_amp['amp-design-3-search-feature'] ) { ?>

						<amp-lightbox id="search-icon" layout="nodisplay">
						    <?php do_action('ampforwp_search_form'); ?>
						    <button on="tap:search-icon.close" class="closebutton">X</button>
						    <i class="icono-cross"></i>
						</amp-lightbox>
<?php }
	}
}

add_action( 'ampforwp_header_search' , 'ampforwp_search_button_html_output' );
function ampforwp_search_button_html_output(){
	if ( is_search_enabled_in_ampforwp() ) {
	 global $redux_builder_amp;
	 if( $redux_builder_amp['amp-design-1-search-feature'] ||
	     $redux_builder_amp['amp-design-2-search-feature'] ||
			 $redux_builder_amp['amp-design-3-search-feature'] ) { ?>
        <div class="searchmenu">
					<button on="tap:search-icon" aria-label="Search">
						<i class="icono-search"></i>
					</button>
				</div>
   <?php }
 	}
}

function ampforwp_add_lightbox_and_form_scripts( $data ) {
	if ( is_search_enabled_in_ampforwp() ) {
		global $redux_builder_amp;
		// Add Scripts only when Search is Enabled
		if( $redux_builder_amp['amp-design-1-search-feature'] ||
		    $redux_builder_amp['amp-design-2-search-feature'] ||
		    $redux_builder_amp['amp-design-3-search-feature'] ) {
					if ( empty( $data['amp_component_scripts']['amp-lightbox'] ) ) {
						$data['amp_component_scripts']['amp-lightbox'] = 'https://cdn.ampproject.org/v0/amp-lightbox-0.1.js';
					}
					if ( empty( $data['amp_component_scripts']['amp-form'] ) ) {
						$data['amp_component_scripts']['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
					}
		}
	}
	return $data;
}

function ampforwp_the_search_form() {
    echo ampforwp_get_search_form();
}
function ampforwp_get_search_form() {
	if ( is_search_enabled_in_ampforwp() ) {
		global $redux_builder_amp;
		$action_url = '';
		$amp_query_variable = '';
		$amp_query_variable_val = '';
		$label = esc_html__(ampforwp_translation(ampforwp_get_setting('ampforwp-search-label'), 'Type your search query and hit enter'));
		$action_url = esc_url( get_bloginfo('url') );
		$action_url = preg_replace('#^http?:#', '', $action_url);
		$placeholder = ampforwp_translation($redux_builder_amp['ampforwp-search-placeholder'], 'Type Here' );
		$value = get_search_query();
		$name = 's';
		$mob_pres_link = false;
		if(function_exists('ampforwp_mobile_redirect_preseve_link')){
		   $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
		}
		if ( ampforwp_get_setting('ampforwp-amp-takeover') == false && $mob_pres_link == false) {
			$amp_query_variable = 'amp';
			$amp_query_variable_val = '1';
		}
		if (ampforwp_get_setting('ampforwp-search-google')) {
			$action_url = 'https://www.google.com/search';
			$amp_query_variable = '';
			$value = 'site:'.get_bloginfo('url').$value;
			$name = 'q';
		}
	  $form = '<form role="search" method="get" id="searchform" class="searchform" target="_top" action="' . esc_url($action_url)  .'">
<div>
<label aria-label="Type your query" class="screen-reader-text" for="s">' . esc_html__($label,'accelerated-mobile-pages') . '</label>
<input type="text" placeholder="AMP" value="'.esc_attr($amp_query_variable_val).'" name="'.esc_attr($amp_query_variable).'" class="hide" id="ampforwp_search_query_item" />
<input type="text" placeholder="'.esc_attr($placeholder).'" value="' . esc_attr($value).'" name="'.esc_attr($name).'" id="s" />
<label aria-label="Submit amp search" for="amp-search-submit" >
<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
</label>
</div>
</form>';
	    return $form;
		}
}