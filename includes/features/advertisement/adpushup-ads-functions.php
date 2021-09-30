<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter('ampforwp_modify_ad_1','ampforwp_adpushup_ad_1',10,1);
add_filter('ampforwp_modify_ad_2','ampforwp_adpushup_ad_2',10,1);
add_filter('ampforwp_modify_ad_3','ampforwp_adpushup_ad_3',10,1);
add_filter('ampforwp_modify_ad_4','ampforwp_adpushup_ad_4',10,1);
add_filter('ampforwp_modify_ad_5','ampforwp_adpushup_ad_5',10,1);
add_filter('ampforwp_modify_ad_6','ampforwp_adpushup_ad_6',10,1);

function ampforwp_adpushup_ad_1($output){
	if( ampforwp_get_setting('enable-amp-ads-1')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-1') ) {
		$width 		= ampforwp_get_setting('ampforwp-adpushup-width-1');
		$height 	= ampforwp_get_setting('ampforwp-adpushup-height-1');
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-1');
		if (empty($width)) {
			$width = "300";
		}
		if (empty($height)) {
			$height = "250";
		}
		if (!empty($site_id) && !empty($slotpath)) {
			$output = '<div class="amp-ad-wrapper amp_ad_1">
						<amp-ad class="amp-ad-1"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							type="adpushup"
							data-siteid="'.esc_attr( $site_id ).'"
							data-slotpath="'.esc_attr( $slotpath ).'" >
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
		}
	}
	return $output;
}
function ampforwp_adpushup_ad_2($output){
	if( ampforwp_get_setting('enable-amp-ads-2')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-2') ) {
		$width 		= ampforwp_get_setting('ampforwp-adpushup-width-2');
		$height 	= ampforwp_get_setting('ampforwp-adpushup-height-2');
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-2');
		if (empty($width)) {
			$width = "300";
		}
		if (empty($height)) {
			$height = "250";
		}
		if (!empty($site_id) && !empty($slotpath)) {
			$output = '<div class="amp-ad-wrapper amp_ad_2">
						<amp-ad class="amp-ad-2"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							type="adpushup"
							data-siteid="'.esc_attr( $site_id ).'"
							data-slotpath="'.esc_attr( $slotpath ).'" >
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
		}
	}
	return $output;
}
function ampforwp_adpushup_ad_3($output){
	if( ampforwp_get_setting('enable-amp-ads-3')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-3') ) {
		$width 		= ampforwp_get_setting('ampforwp-adpushup-width-3');
		$height 	= ampforwp_get_setting('ampforwp-adpushup-height-3');
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-3');
		if (empty($width)) {
			$width = "300";
		}
		if (empty($height)) {
			$height = "250";
		}
		if (!empty($site_id) && !empty($slotpath)) {
			$output = '<div class="amp-ad-wrapper amp_ad_3">
						<amp-ad class="amp-ad-3"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							type="adpushup"
							data-siteid="'.esc_attr( $site_id ).'"
							data-slotpath="'.esc_attr( $slotpath ).'" >
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
		}
	}
	return $output;
}
function ampforwp_adpushup_ad_4($output){
	if( ampforwp_get_setting('enable-amp-ads-4')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-4') ) {
		$width 		= ampforwp_get_setting('ampforwp-adpushup-width-4');
		$height 	= ampforwp_get_setting('ampforwp-adpushup-height-4');
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-4');
		if (empty($width)) {
			$width = "300";
		}
		if (empty($height)) {
			$height = "250";
		}
		if (!empty($site_id) && !empty($slotpath)) {
			$output = '<div class="amp-ad-wrapper amp_ad_4">
						<amp-ad class="amp-ad-4"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							type="adpushup"
							data-siteid="'.esc_attr( $site_id ).'"
							data-slotpath="'.esc_attr( $slotpath ).'" >
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
		}
	}
	return $output;
}
function ampforwp_adpushup_ad_5($output){
	if( ampforwp_get_setting('enable-amp-ads-5')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-5') ) {
		$width 		= ampforwp_get_setting('ampforwp-adpushup-width-5');
		$height 	= ampforwp_get_setting('ampforwp-adpushup-height-5');
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-5');
		if (empty($width)) {
			$width = "300";
		}
		if (empty($height)) {
			$height = "250";
		}
		if (!empty($site_id) && !empty($slotpath)) {
			$output = '<div class="amp-ad-wrapper amp_ad_5">
						<amp-ad class="amp-ad-5"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							type="adpushup"
							data-siteid="'.esc_attr( $site_id ).'"
							data-slotpath="'.esc_attr( $slotpath ).'" >
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
		}
	}
	return $output;
}
function ampforwp_adpushup_ad_6($output){
	if( ampforwp_get_setting('enable-amp-ads-6')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-6') ) {
		$width 		= ampforwp_get_setting('ampforwp-adpushup-width-6');
		$height 	= ampforwp_get_setting('ampforwp-adpushup-height-6');
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-6');
		if (empty($width)) {
			$width = "300";
		}
		if (empty($height)) {
			$height = "250";
		}
		if (!empty($site_id) && !empty($slotpath)) {
			$output = '<div class="amp-ad-wrapper amp_ad_6">
						<amp-ad class="amp-ad-6"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							type="adpushup"
							data-siteid="'.esc_attr( $site_id ).'"
							data-slotpath="'.esc_attr( $slotpath ).'" >
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
		}
	}
	return $output;
}