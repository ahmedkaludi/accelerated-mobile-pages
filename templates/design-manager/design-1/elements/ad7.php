<?php
	$optimize = '';
	global $redux_builder_amp;
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-7'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-7'];
	if( true == ampforwp_get_setting('ampforwp-ads-data-loading-strategy-7')){
		$optimize = 'data-loading-strategy=1';
	}
	if ( ampforwp_get_setting('enable-amp-ads-7') ) {
		
		if(ampforwp_get_setting('enable-amp-ads-select-7') == 1)  {
						$advert_width  = '300';
						$advert_height = '250';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-7') == 2) {
						$advert_width  = '336';
						$advert_height = '280';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-7') == 3)  {
						$advert_width  = '728';
						$advert_height = '90';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-7') == 4)  {
						$advert_width  = '300';
						$advert_height = '600';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-7') == 5)  {
						$advert_width  = '320';
						$advert_height = '100';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-7') == 6)  {
						$advert_width  = '200';
						$advert_height = '50';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-7') == 7)  {
						$advert_width  = '320';
						$advert_height = '50';
		}

	$responsive = false;
	if ( ampforwp_get_setting('enable-amp-ads-resp-7') ) {
		$responsive = true;
	}	

	if ( $responsive ) {
	      			$advert_width  = '100vw';
					$advert_height = '320';
	      		}	
	$output = '<div class="amp-ad-wrapper amp_ad_7">
				<amp-ad class="amp-ad-7" '. $optimize .'
					type="adsense" 
					width='. $advert_width .' height='. $advert_height . '
					data-ad-client="'. $client_id .'"
					data-ad-slot="'.  $data_slot .'"></amp-ad></div>';
					
	echo $output;				
		
	}
 
?>