<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//  Advertisement code
if( !class_exists('adsforwp_output_functions') ){
	add_action('ampforwp_after_header','ampforwp_header_advert');
	add_action('ampforwp_design_1_after_header','ampforwp_header_advert');
	add_action('amp_post_template_footer','ampforwp_footer_advert',10);
	add_action('ampforwp_before_post_content','ampforwp_before_post_content_advert');
	add_action('ampforwp_inside_post_content_before','ampforwp_before_post_content_advert');
	add_action('ampforwp_after_post_content','ampforwp_after_post_content_advert');
	add_action('ampforwp_below_the_title','ampforwp_below_the_title_advert');
	add_action('ampforwp_above_related_post','ampforwp_above_related_post_advert');
}
// Below Header Global
function ampforwp_header_advert() {
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	$is_dboc = '';
	$output = $advert_width = $advert_height = $client_id = $data_slot = '';
	$is_dboc = ampforwp_get_data_consent();
	$post_id = get_the_ID();
	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
  	}
  	// If page builder is enabled then 'Return' and show no ads  
  	if ( checkAMPforPageBuilderStatus( $post_id ) ) {
	    return;
  	}
	$responsive = false;
	if ( isset($redux_builder_amp['enable-amp-ads-resp-1']) && $redux_builder_amp['enable-amp-ads-resp-1'] ) {
		$responsive = true;
	}
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-1'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-1'];
	if ( ampforwp_get_setting('enable-amp-ads-1')  && ampforwp_get_setting('enable-amp-ads-type-1') == 'adsense' ) {
		if ( 1 == $redux_builder_amp['enable-amp-ads-select-1'] ) {
			$advert_width  = '300';
			$advert_height = '250';
       	} elseif ( 2 == $redux_builder_amp['enable-amp-ads-select-1'] ) {
          	$advert_width  = '336';
			$advert_height = '280';
		} elseif ( 3 == $redux_builder_amp['enable-amp-ads-select-1'] ) {
          	$advert_width  = '728';
			$advert_height = '90';
       	} elseif ( 4 == $redux_builder_amp['enable-amp-ads-select-1'] ) {
          	$advert_width  = '300';
			$advert_height = '600';
        } elseif ( 5 == $redux_builder_amp['enable-amp-ads-select-1'] ) {
          	$advert_width  = '320';
			$advert_height = '100';
  		} elseif ( 6 == $redux_builder_amp['enable-amp-ads-select-1'] ) {
          	$advert_width  = '200';
			$advert_height = '50';
  		} elseif ( 7 == $redux_builder_amp['enable-amp-ads-select-1'] ) {
          	$advert_width  = '320';
			$advert_height = '50';
  		}
  		if ( $responsive ) {
  			$advert_width  = '100vw';
			$advert_height = '320';
  		}
		$output = '<div class="amp-ad-wrapper amp_ad_1">';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '1') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output .= '<amp-ad class="amp-ad-1"
					type="adsense"
					width='. esc_attr($advert_width) .' height='. esc_attr($advert_height) . '
					data-ad-client="'. ampforwp_get_setting('enable-amp-ads-text-feild-client-1').'"
					data-ad-slot="'.  ampforwp_get_setting('enable-amp-ads-text-feild-slot-1') .'"';
		if($is_dboc){
			$output .= 'data-block-on-consent="_till_accepted"';
		}
		if ( $responsive ) {
			$output .= 'data-auto-format="rspv"
					   data-full-width>';
		   	$output .= '<div overflow></div></amp-ad>';
		}
		else
			$output .= '></amp-ad>';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '2') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output .= ' </div>';
	}
	$output = apply_filters('ampforwp_modify_ads',$output,$advert_width,$advert_height, $client_id, $data_slot);
	$output = apply_filters('ampforwp_modify_ad_1',$output );
	echo $output; // escaped above 
}

// Above Footer Global
function ampforwp_footer_advert() {
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	$optimize = '';
	$is_dboc = '';
	$output = $advert_width = $advert_height = $client_id = $data_slot = '';
	$is_dboc = ampforwp_get_data_consent();
	$post_id = get_the_ID();
	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
  	}
  	// If page builder is enabled then 'Return' and show no ads  
  	if ( checkAMPforPageBuilderStatus( $post_id ) ) {
	    return;
  	}
	$responsive = false;
	if ( isset($redux_builder_amp['enable-amp-ads-resp-2']) && $redux_builder_amp['enable-amp-ads-resp-2'] ) {
		$responsive = true;
	}
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-2'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-2'];
	$optimize = ampforwp_ad_optimize();
	if ( ampforwp_get_setting('enable-amp-ads-2') && ampforwp_get_setting('enable-amp-ads-type-1') == 'adsense' ) {
		if($redux_builder_amp['enable-amp-ads-select-2'] == 1)  {
			$advert_width  = '300';
			$advert_height = '250';
       	} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 2) {
          	$advert_width  = '336';
			$advert_height = '280';
		} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 3)  {
          	$advert_width  = '728';
			$advert_height = '90';
       	} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 4)  {
          	$advert_width  = '300';
			$advert_height = '600';
        } elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 5)  {
          	$advert_width  = '320';
			$advert_height = '100';
  		} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 6)  {
          	$advert_width  = '200';
			$advert_height = '50';
  		} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 7)  {
          	$advert_width  = '320';
			$advert_height = '50';
  		}
  		if ( $responsive ) {
  			$advert_width  = '100vw';
			$advert_height = '320';
  		}
		$output = '<div class="amp-ad-wrapper amp_ad_2">';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '1') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=	'<amp-ad class="amp-ad-2" 
					type="adsense" '. esc_attr($optimize) .'
					width='. esc_attr($advert_width) .' height='. esc_attr($advert_height) . '
					data-ad-client="'. ampforwp_get_setting('enable-amp-ads-text-feild-client-2').'"
					data-ad-slot="'.  ampforwp_get_setting('enable-amp-ads-text-feild-slot-2') .'"';
		if($is_dboc){
			$output .= 'data-block-on-consent="_till_accepted"';
		}
		if ( $responsive ) {
			$output .= 'data-auto-format="rspv"
					   data-full-width>';
		   	$output .= '<div overflow></div></amp-ad>';
		}
		else
			$output .= '></amp-ad>';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '2') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=   ' </div>';
	}
	$output = apply_filters('ampforwp_modify_ads',$output,$advert_width,$advert_height, $client_id, $data_slot);
	$output = apply_filters('ampforwp_modify_ad_2',$output );
	echo $output; // escaped above
}

// Above Post Content
function ampforwp_before_post_content_advert() {
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	$is_global = '';
	$display_on = '';
	$is_dboc = '';
	$output = $advert_width = $advert_height = $client_id = $data_slot = '';
	$is_dboc = ampforwp_get_data_consent();
	$post_id = get_the_ID();
	// If page builder is enabled then 'Return' and show no ads  
  	if ( checkAMPforPageBuilderStatus( $post_id ) ) {
	    return;
  	}
	$responsive = false;
	if ( isset($redux_builder_amp['enable-amp-ads-resp-3']) && $redux_builder_amp['enable-amp-ads-resp-3'] ) {
		$responsive = true;
	}
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-3'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-3'];
	if(isset($redux_builder_amp['made-amp-ad-3-global']) && $redux_builder_amp['made-amp-ad-3-global']){
		if($redux_builder_amp['made-amp-ad-3-global'] == 1){
			$is_global = is_single();
		}
		else{
			$is_global = is_singular();
		}
	}
	if(isset($redux_builder_amp['made-amp-ad-3-global']) && $redux_builder_amp['made-amp-ad-3-global']){
		$is_global = (array) $redux_builder_amp['made-amp-ad-3-global'];
		foreach ($is_global as $enable_for) {
			$display_on = false;
			if('1' == $enable_for && ( 'post' == get_post_type() )){
				$display_on = is_single();
			}if('2' == $enable_for){
				$display_on = is_page();
			}if('3' == $enable_for && ( 'post' != get_post_type() )){
				$display_on = is_single();
			}if('4' == $enable_for){
				$display_on = is_singular();
			}
			
			if ( ampforwp_get_setting('enable-amp-ads-3')  && ampforwp_get_setting('enable-amp-ads-type-1') == 'adsense' && $display_on  ) {
				if($redux_builder_amp['enable-amp-ads-select-3'] == 1)  {
					$advert_width  = '300';
					$advert_height = '250';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 2) {
		          	$advert_width  = '336';
					$advert_height = '280';
				} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 3)  {
		          	$advert_width  = '728';
					$advert_height = '90';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 4)  {
		          	$advert_width  = '300';
					$advert_height = '600';
	            } elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 5)  {
		          	$advert_width  = '320';
					$advert_height = '100';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 6)  {
		          	$advert_width  = '200';
					$advert_height = '50';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 7)  {
		          	$advert_width  = '320';
					$advert_height = '50';
	      		}
	      		if ( $responsive ) {
	      			$advert_width  = '100vw';
					$advert_height = '320';
	      		}
				$output = '<div class="amp-ad-wrapper amp_ad_3">';
				if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '1') {
					$output .= ampforwp_ads_sponsorship();
				}
				$output	.=	'<amp-ad class="amp-ad-3" 
							type="adsense"
							width='. esc_attr($advert_width).' height='. esc_attr($advert_height) . '
							data-ad-client="'. ampforwp_get_setting('enable-amp-ads-text-feild-client-3').'"
							data-ad-slot="'.  ampforwp_get_setting('enable-amp-ads-text-feild-slot-3') .'"';
				if($is_dboc){
					$output .= 'data-block-on-consent="_till_accepted"';
				}
				if ( $responsive ) {
					$output .= 'data-auto-format="rspv"
							   data-full-width>';
				   	$output .= '<div overflow></div></amp-ad>';
				}
				else
					$output .= '></amp-ad>';
				if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '2') {
					$output .= ampforwp_ads_sponsorship();
				}
				$output	.=   ' </div>';
			}
			$output = apply_filters('ampforwp_modify_ads',$output,$advert_width,$advert_height, $client_id, $data_slot);
			$output = apply_filters('ampforwp_modify_ad_3',$output );
			echo $output; // escaped above
		}
	}
}
add_action('pre_amp_render_post', 'ampforwp_after_post_firefox_ad');
function ampforwp_after_post_firefox_ad(){
	if(true == ampforwp_get_setting('enable-amp-ads-4') && true == ampforwp_get_setting('content-sneak-peek')){
		remove_action('ampforwp_after_post_content','ampforwp_after_post_content_advert');
		add_action('ampforwp_after_the_post_content_wrp','ampforwp_after_post_content_advert');
	}
}
// Below Content Single
// Hook updated
//	add_action('ampforwp_inside_post_content_after','ampforwp_after_post_content_advert');
function ampforwp_after_post_content_advert() {
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	$optimize = '';
	$post_id = get_the_ID();
	$is_dboc = '';
	$output = $advert_width = $advert_height = $client_id = $data_slot = '';
	$is_dboc = ampforwp_get_data_consent();
	// If page builder is enabled then 'Return' and show no ads  
  	if ( checkAMPforPageBuilderStatus( $post_id ) ) {
	    return;
  	}
	$responsive = false;
	if ( isset($redux_builder_amp['enable-amp-ads-resp-4']) && $redux_builder_amp['enable-amp-ads-resp-4'] ) {
		$responsive = true;
	}
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-4'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-4'];
	$optimize = ampforwp_ad_optimize();
	if ( ampforwp_get_setting('enable-amp-ads-4')  && ampforwp_get_setting('enable-amp-ads-type-4') == 'adsense' && is_single()  ) {
		if($redux_builder_amp['enable-amp-ads-select-4'] == 1)  {
			$advert_width  = '300';
			$advert_height = '250';
       	} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 2) {
          	$advert_width  = '336';
			$advert_height = '280';
		} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 3)  {
          	$advert_width  = '728';
			$advert_height = '90';
       	} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 4)  {
          	$advert_width  = '300';
			$advert_height = '600';
        } elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 5)  {
          	$advert_width  = '320';
			$advert_height = '100';
  		} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 6)  {
          	$advert_width  = '200';
			$advert_height = '50';
  		} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 7)  {
          	$advert_width  = '320';
			$advert_height = '50';
  		}
  		if ( $responsive ) {
  			$advert_width  = '100vw';
			$advert_height = '320';
  		}
		$output = '<div class="amp-ad-wrapper amp_ad_4">';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '1') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=	'<amp-ad class="amp-ad-4"
					type="adsense" '. esc_attr($optimize) .'
					width='. esc_attr($advert_width) .' height='. esc_attr($advert_height) . '
					data-ad-client="'. ampforwp_get_setting('enable-amp-ads-text-feild-client-4').'"
					data-ad-slot="'. ampforwp_get_setting('enable-amp-ads-text-feild-slot-4') .'"';
		if($is_dboc){
			$output .= 'data-block-on-consent="_till_accepted"';
		}
		if ( $responsive ) {
			$output .= 'data-auto-format="rspv"
					   data-full-width>';
		   	$output .= '<div overflow></div></amp-ad>';
		}
		else
			$output .= '></amp-ad>';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '2') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=   ' </div>';
	}
	$output = apply_filters('ampforwp_modify_ads',$output,$advert_width,$advert_height, $client_id, $data_slot);
	$output = apply_filters('ampforwp_modify_ad_4',$output );
	echo $output; // escaped above
}

// Below The Title
function ampforwp_below_the_title_advert() {
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	$is_dboc = '';
	$output = $advert_width = $advert_height = $client_id = $data_slot = '';
	$is_dboc = ampforwp_get_data_consent();
	$post_id = get_the_ID();
	// If page builder is enabled then 'Return' and show no ads  
  	if ( checkAMPforPageBuilderStatus( $post_id ) ) {
	    return;
  	}
	$responsive = false;
	if ( isset($redux_builder_amp['enable-amp-ads-resp-5']) && $redux_builder_amp['enable-amp-ads-resp-5'] ) {
		$responsive = true;
	}
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-5'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-5'];
	if ( ampforwp_get_setting('enable-amp-ads-5')  && ampforwp_get_setting('enable-amp-ads-type-5') == 'adsense' && is_single()  ) {
		if($redux_builder_amp['enable-amp-ads-select-5'] == 1)  {
			$advert_width  = '300';
			$advert_height = '250';
		} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 2) {
						$advert_width  = '336';
			$advert_height = '280';
		} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 3)  {
						$advert_width  = '728';
			$advert_height = '90';
		} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 4)  {
						$advert_width  = '300';
			$advert_height = '600';
		} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 5)  {
						$advert_width  = '320';
			$advert_height = '100';
		} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 6)  {
						$advert_width  = '200';
			$advert_height = '50';
		} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 7)  {
						$advert_width  = '320';
			$advert_height = '50';
				}
		if ( $responsive ) {
  			$advert_width  = '100vw';
			$advert_height = '320';
  		}		
		$output = '<div class="amp-ad-wrapper amp_ad_5">';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '1') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=	'<amp-ad class="amp-ad-5"
					type="adsense"
					width='. esc_attr($advert_width) .' height='. esc_attr($advert_height) . '
					data-ad-client="'. ampforwp_get_setting('enable-amp-ads-text-feild-client-5').'"
					data-ad-slot="'.  ampforwp_get_setting('enable-amp-ads-text-feild-slot-5') .'"';
		if($is_dboc){
			$output .= 'data-block-on-consent="_till_accepted"';
		}
		if ( $responsive ) {
			$output .= 'data-auto-format="rspv"
					   data-full-width>';
		   	$output .= '<div overflow></div></amp-ad>';
		}
		else
			$output .= '></amp-ad>';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '2') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=   ' </div>';
	}
	$output = apply_filters('ampforwp_modify_ads',$output,$advert_width,$advert_height, $client_id, $data_slot);
	$output = apply_filters('ampforwp_modify_ad_5',$output );
	echo $output; // escaped above
}


// Above Related post
function ampforwp_above_related_post_advert() {
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	$optimize = '';
	$is_dboc = '';
	$output = $advert_width = $advert_height = $client_id = $data_slot = '';
	$is_dboc = ampforwp_get_data_consent();
	$post_id = get_the_ID();
	// If page builder is enabled then 'Return' and show no ads  
  	if ( checkAMPforPageBuilderStatus( $post_id ) ) {
	    return;
  	}
	$responsive = false;
	if ( isset($redux_builder_amp['enable-amp-ads-resp-6']) && $redux_builder_amp['enable-amp-ads-resp-6'] ) {
		$responsive = true;
	}
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-6'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-6'];
	$optimize = ampforwp_ad_optimize();
	if ( ampforwp_get_setting('enable-amp-ads-6')  && ampforwp_get_setting('enable-amp-ads-type-6') == 'adsense' ) {
		if($redux_builder_amp['enable-amp-ads-select-6'] == 1)  {
			$advert_width  = '300';
			$advert_height = '250';
		} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 2) {
						$advert_width  = '336';
			$advert_height = '280';
		} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 3)  {
						$advert_width  = '728';
			$advert_height = '90';
		} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 4)  {
						$advert_width  = '300';
			$advert_height = '600';
		} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 5)  {
						$advert_width  = '320';
			$advert_height = '100';
		} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 6)  {
						$advert_width  = '200';
			$advert_height = '50';
		} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 7)  {
						$advert_width  = '320';
			$advert_height = '50';
				}
		if ( $responsive ) {
  			$advert_width  = '100vw';
			$advert_height = '320';
  		}
		$output = '<div class="amp-ad-wrapper amp_ad_6">';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '1') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=	'<amp-ad class="amp-ad-6"
					type="adsense" '. esc_attr($optimize) .'
					width='. esc_attr($advert_width) .' height='. esc_attr($advert_height) . '
					data-ad-client="'. ampforwp_get_setting('enable-amp-ads-text-feild-client-6').'"
					data-ad-slot="'.  ampforwp_get_setting('enable-amp-ads-text-feild-slot-6') .'"';
		if($is_dboc){
			$output .= 'data-block-on-consent="_till_accepted"';
		}
		if ( $responsive ) {
			$output .= 'data-auto-format="rspv"
					   data-full-width>';
		   	$output .= '<div overflow></div></amp-ad>';
		}
		else
			$output .= '></amp-ad>';
		if (ampforwp_get_setting('ampforwp-ads-sponsorship-position') == '2') {
			$output .= ampforwp_ads_sponsorship();
		}
		$output	.=   ' </div>';
	}
	$output = apply_filters('ampforwp_modify_ads',$output,$advert_width,$advert_height, $client_id, $data_slot);
	$output = apply_filters('ampforwp_modify_ad_6',$output );
	echo $output; // escaped above
}
// Ads Sponsorship output
function ampforwp_ads_sponsorship(){
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	if ( isset($redux_builder_amp['ampforwp-ads-sponsorship']) && $redux_builder_amp['ampforwp-ads-sponsorship'] ) {
		return '<span>'.$redux_builder_amp['ampforwp-ads-sponsorship-label'].'</span>';
	}
}
// Ads Optimize For Viewability
if( !function_exists('ampforwp_ad_optimize')){
	function ampforwp_ad_optimize(){
		$optimized_code = '';
		if( true == ampforwp_get_setting('ampforwp-ads-data-loading-strategy')){
			$optimized_code = 'data-loading-strategy=1';
		}
		return $optimized_code;
	}
} 

// Properly adding ad Script the AMP way
add_filter( 'amp_post_template_data', 'ampforwp_add_ads_scripts' );
function ampforwp_add_ads_scripts( $data ) {
	global $redux_builder_amp;
	if($redux_builder_amp==null){
		$redux_builder_amp = get_option('redux_builder_amp',true);
	}
	if ( ampforwp_get_setting('enable-amp-ads-1') || ampforwp_get_setting('enable-amp-ads-2')   || ampforwp_get_setting('enable-amp-ads-3') || ampforwp_get_setting('enable-amp-ads-4') || ampforwp_get_setting('enable-amp-ads-5') || ampforwp_get_setting('enable-amp-ads-6') || ampforwp_get_setting('enable-amp-ads-7') || ampforwp_get_setting('enable-amp-ads-8') ) {
					if ( empty( $data['amp_component_scripts']['amp-ad'] ) ) {
						$data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
					}
	}

	return $data;
}

// CSS for ADS when AMP by Automattic is activated #2287
if ( function_exists('amp_activate') ) {
	add_action('amp_post_template_css', 'ampforwp_amp_ads_css');
	if ( ! function_exists('ampforwp_amp_ads_css') ) {
		function ampforwp_amp_ads_css(){ ?>
			.amp-ad-wrapper {text-align: center}
			.amp_ad_5{margin-left: auto; margin-right: auto;}
		<?php }
	}
}