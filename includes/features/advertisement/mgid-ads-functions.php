<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// MGID
if( !class_exists('adsforwp_output_functions') ){
	add_filter('ampforwp_modify_ad_1','ampforwp_mgid_markup_ad_1',10,1);
	add_filter('ampforwp_modify_ad_2','ampforwp_mgid_markup_ad_2',10,1);
	add_filter('ampforwp_modify_ad_3','ampforwp_mgid_markup_ad_3',10,1);
	add_filter('ampforwp_modify_ad_4','ampforwp_mgid_markup_ad_4',10,1);
	add_filter('ampforwp_modify_ad_5','ampforwp_mgid_markup_ad_5',10,1);
	add_filter('ampforwp_modify_ad_6','ampforwp_mgid_markup_ad_6',10,1);
	add_filter('ampforwp_modify_ad_7','ampforwp_mgid_markup_ad_7',10,1);
	add_filter('ampforwp_modify_ad_8','ampforwp_mgid_markup_ad_8',10,1);
}

function ampforwp_mgid_markup_ad_1($output){
	$wh_value = '';
	if( ampforwp_get_setting('enable-amp-ads-1')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-1') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con');
		$flexible = '';
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_1">
						<amp-ad class="amp-ad-1"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}

function ampforwp_mgid_markup_ad_2($output){
	if( ampforwp_get_setting('enable-amp-ads-2')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-2') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width-2');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height-2');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub-2');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget-2');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con-2');
		$flexible = '';
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible-2')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_2">
						<amp-ad class="amp-ad-2"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}

function ampforwp_mgid_markup_ad_3($output){
	if( ampforwp_get_setting('enable-amp-ads-3')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-3') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width-3');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height-3');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub-3');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget-3');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con-3');
		$flexible = '';
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible-3')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_3">
						<amp-ad class="amp-ad-3"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}

function ampforwp_mgid_markup_ad_4($output){
	if( ampforwp_get_setting('enable-amp-ads-4')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-4') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width-4');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height-4');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub-4');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget-4');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con-4');
		$flexible = '';
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible-4')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_4">
						<amp-ad class="amp-ad-4"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}

function ampforwp_mgid_markup_ad_5($output){
	if( ampforwp_get_setting('enable-amp-ads-5')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-5') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width-5');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height-5');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub-5');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget-5');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con-5');
		$flexible = '';
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible-5')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_5">
						<amp-ad class="amp-ad-5"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}

function ampforwp_mgid_markup_ad_6($output){
	if( ampforwp_get_setting('enable-amp-ads-6')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-6') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width-6');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height-6');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub-6');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget-6');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con-6');
		$flexible = '';
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible-6')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_6">
						<amp-ad class="amp-ad-6"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}

function ampforwp_mgid_markup_ad_7($output){
	if( ampforwp_get_setting('enable-amp-ads-7')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-7') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width-7');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height-7');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub-7');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget-7');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con-7');
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible-7')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_7">
						<amp-ad class="amp-ad-7"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}

function ampforwp_mgid_markup_ad_8($output){
	if( ampforwp_get_setting('enable-amp-ads-8')  && 'mgid' == ampforwp_get_setting('enable-amp-ads-type-8') ) {
		$width 		= ampforwp_get_setting('enable-amp-ads-mgid-width-8');
		$height 	= ampforwp_get_setting('enable-amp-ads-mgid-height-8');
		$data_pub 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-pub-8');
		$data_wid 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-widget-8');
		$data_cont 	= ampforwp_get_setting('enable-amp-ads-mgid-field-data-con-8');
		if(true == ampforwp_get_setting('enable-amp-ads-mgid-flexible-8')){
			$width = '600';
			$height = '600';
			$flexible = 'layout=responsive';
		}
		$output = 	'<div class="amp-ad-wrapper amp_ad_8">
						<amp-ad class="amp-ad-8"
							width="'.esc_attr( $width ).'" 
							height="'.esc_attr( $height ).'"
							'.esc_html($flexible).'
							type="mgid"
							data-publisher="'.esc_attr( $data_pub ).'"
							data-widget="'.esc_attr( $data_wid ).'"
							data-container="'.esc_attr( $data_cont ).'">
						</amp-ad>
		 				'.ampforwp_ads_sponsorship().'
		 			</div>';
	}
	return $output;
}