<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter('ampforwp_modify_ad_1','ampforwp_adpushup_markup_ad_1',10,1);
function ampforwp_adpushup_markup_ad_1($output){
	if( ampforwp_get_setting('enable-amp-ads-1')  && 'adpushup' == ampforwp_get_setting('enable-amp-ads-type-1') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-adpushup-width');
		$height 	= ampforwp_get_setting('enable-amp-ads-adpushup-height');
		$site_id 	= ampforwp_get_setting('enable-amp-ads-adpushup-site-id');
		$slotpath 	= ampforwp_get_setting('enable-amp-ads-adpushup-slotpath');
		$output = 	'<div class="amp-ad-wrapper amp_ad_1">
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
	return $output;
}