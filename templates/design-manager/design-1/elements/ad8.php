<?php

	global $redux_builder_amp;
	$client_id = $redux_builder_amp['enable-amp-ads-text-feild-client-8'];
	$data_slot = $redux_builder_amp['enable-amp-ads-text-feild-slot-8'];

	if ( ampforwp_get_setting('enable-amp-ads-8') ) {
		
		if(ampforwp_get_setting('enable-amp-ads-select-8') == 1)  {
						$advert_width  = '300';
						$advert_height = '250';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-8') == 2) {
						$advert_width  = '336';
						$advert_height = '280';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-8') == 3)  {
						$advert_width  = '728';
						$advert_height = '90';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-8') == 4)  {
						$advert_width  = '300';
						$advert_height = '600';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-8') == 5)  {
						$advert_width  = '320';
						$advert_height = '100';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-8') == 6)  {
						$advert_width  = '200';
						$advert_height = '50';
		} elseif (ampforwp_get_setting('enable-amp-ads-select-8') == 7)  {
						$advert_width  = '320';
						$advert_height = '50';
		}

	$responsive = false;
	if ( ampforwp_get_setting('enable-amp-ads-resp-8') ) {
		$responsive = true;
	}	

	if ( $responsive ) {
	      			$advert_width  = '100vw';
					$advert_height = '320';
	      		}	
	$output = '<div class="amp-ad-wrapper amp_ad_8">
				<amp-ad class="amp-ad-8"
					type="adsense" 
					width='. $advert_width .' height='. $advert_height . '
					data-ad-client="'. $client_id .'"
					data-ad-slot="'.  $data_slot .'"></amp-ad></div>';
					
	echo $output;				
		
	}
 
?>