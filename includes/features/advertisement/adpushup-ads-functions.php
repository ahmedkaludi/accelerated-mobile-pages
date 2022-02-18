<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter('ampforwp_modify_ad_1','ampforwp_adpushup_ad_1');
add_filter('ampforwp_modify_ad_2','ampforwp_adpushup_ad_2',10,1);
add_filter('ampforwp_modify_ad_3','ampforwp_adpushup_ad_3',10,1);
add_filter('ampforwp_modify_ad_4','ampforwp_adpushup_ad_4',10,1);
add_filter('ampforwp_modify_ad_5','ampforwp_adpushup_ad_5',10,1);
add_filter('ampforwp_modify_ad_6','ampforwp_adpushup_ad_6',10,1);

function ampforwp_adpushup_ad_1($output){
	if( ampforwp_get_setting('enable-amp-ads-1')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-1') ) {
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-1');
		if(ampforwp_get_setting('ampforwp-adpushup-select-1') == 1)  {
			$width  = '300';
			$height = '250';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-1') == 2) {
			$width  = '336';
			$height = '280';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-1') == 3)  {
			$width  = '728';
			$height = '90';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-1') == 4)  {
			$width  = '300';
			$height = '600';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-1') == 5)  {
			$width  = '320';
			$height = '100';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-1') == 6)  {
			$width  = '200';
			$height = '50';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-1') == 7)  {
			$width  = '320';
			$height = '50';
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
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-2');
		if(ampforwp_get_setting('ampforwp-adpushup-select-2') == 1)  {
			$width  = '300';
			$height = '250';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-2') == 2) {
			$width  = '336';
			$height = '280';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-2') == 3)  {
			$width  = '728';
			$height = '90';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-2') == 4)  {
			$width  = '300';
			$height = '600';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-2') == 5)  {
			$width  = '320';
			$height = '100';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-2') == 6)  {
			$width  = '200';
			$height = '50';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-2') == 7)  {
			$width  = '320';
			$height = '50';
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
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-3');
		if(ampforwp_get_setting('ampforwp-adpushup-select-3') == 1)  {
			$width  = '300';
			$height = '250';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-3') == 2) {
			$width  = '336';
			$height = '280';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-3') == 3)  {
			$width  = '728';
			$height = '90';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-3') == 4)  {
			$width  = '300';
			$height = '600';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-3') == 5)  {
			$width  = '320';
			$height = '100';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-3') == 6)  {
			$width  = '200';
			$height = '50';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-3') == 7)  {
			$width  = '320';
			$height = '50';
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
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-4');
		if(ampforwp_get_setting('ampforwp-adpushup-select-4') == 1)  {
			$width  = '300';
			$height = '250';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-4') == 2) {
			$width  = '336';
			$height = '280';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-4') == 3)  {
			$width  = '728';
			$height = '90';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-4') == 4)  {
			$width  = '300';
			$height = '600';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-4') == 5)  {
			$width  = '320';
			$height = '100';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-4') == 6)  {
			$width  = '200';
			$height = '50';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-4') == 7)  {
			$width  = '320';
			$height = '50';
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
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-5');
		if(ampforwp_get_setting('ampforwp-adpushup-select-5') == 1)  {
			$width  = '300';
			$height = '250';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-5') == 2) {
			$width  = '336';
			$height = '280';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-5') == 3)  {
			$width  = '728';
			$height = '90';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-5') == 4)  {
			$width  = '300';
			$height = '600';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-5') == 5)  {
			$width  = '320';
			$height = '100';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-5') == 6)  {
			$width  = '200';
			$height = '50';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-5') == 7)  {
			$width  = '320';
			$height = '50';
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
		$site_id 	= ampforwp_get_setting('ampforwp-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('ampforwp-adpushup-slotpath-6');
		if(ampforwp_get_setting('ampforwp-adpushup-select-6') == 1)  {
			$width  = '300';
			$height = '250';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-6') == 2) {
			$width  = '336';
			$height = '280';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-6') == 3)  {
			$width  = '728';
			$height = '90';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-6') == 4)  {
			$width  = '300';
			$height = '600';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-6') == 5)  {
			$width  = '320';
			$height = '100';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-6') == 6)  {
			$width  = '200';
			$height = '50';
		} elseif (ampforwp_get_setting('ampforwp-adpushup-select-6') == 7)  {
			$width  = '320';
			$height = '50';
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