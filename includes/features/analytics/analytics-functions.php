<?php
// Analytics Area
add_action('amp_post_template_footer','ampforwp_analytics',11);
function ampforwp_analytics() {
	// 10.1 Analytics Support added for Google Analytics
	global $redux_builder_amp;
	if ( true == ampforwp_get_setting('ampforwp-ga-switch')){
		$ga_fields = array();
		$ampforwp_ga_fields = array();
		$ga_account = '';
		$ga_account = ampforwp_get_setting('ga-feild');
		$ga_account = str_replace(' ', '', $ga_account);
		$ga_fields = array(
						'vars'=>array(
							'account'=>$ga_account,
							),
						'triggers'=> array(
							'trackPageview'=> array(
								'on'=>'visible',
								'request'=>'pageview'
							)
						)
					);
		if ( true == ampforwp_get_setting('ampforwp-ga-field-anonymizeIP')) {
			$ga_fields['vars']['anonymizeIP'] = 'true';
		}
		if ( ampforwp_get_setting('ampforwp-ga-field-linker') == true ) {
			$ga_fields['vars']['linkers'] = array(
				'enabled'=> true
			);
		}
		$ampforwp_ga_fields = apply_filters('ampforwp_advance_google_analytics', $ampforwp_ga_fields );
		$ampforwp_ga_fields = json_encode( $ga_fields);
	 ?>
			<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="googleanalytics" id="analytics1">
				<script type="application/json">
					<?php echo $ampforwp_ga_fields; ?>
				</script>
			</amp-analytics>
			<?php
		}//code ends for supporting Google Analytics

	// 10.2 Analytics Support added for segment.com
	if ( true == ampforwp_get_setting('ampforwp-Segment-switch') ) { 
		$segment = ampforwp_get_setting('sa-feild'); 
		$segment_fields = array(
						'vars'=>array(
							'writeKey'=>$segment,
							'name'=>get_the_title()
							),
					);
		$ampforwp_segment_fields = apply_filters('ampforwp_segment_analytics', $ampforwp_segment_fields );
		$ampforwp_segment_fields = json_encode( $segment_fields);
					?>
		<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="segment">
		<script type="application/json">
			<?php echo $ampforwp_segment_fields ?>
			</script>
		</amp-analytics>
		<?php
	}

	// 10.3 Analytics Support added for Piwik
		if( true == ampforwp_get_setting('ampforwp-Piwik-switch')) { ?>
				<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo ampforwp_get_setting('pa-feild'); ?>"></amp-pixel>
		<?php }

		// 10.4 Analytics Support added for quantcast
			if ( true == ampforwp_get_setting('ampforwp-Quantcast-switch')) { 
				$quantcast = ampforwp_get_setting('amp-quantcast-analytics-code');
				$quantcast_fields = array(
						'vars'=>array(
							'pcode'=>$quantcast,
							'labels'=>[ "AMPProject" ]
							),
					); 
				$ampforwp_quantcast_fields = apply_filters('ampforwp_quantcast_analytics', $ampforwp_quantcast_fields );
				$ampforwp_quantcast_fields = json_encode( $quantcast_fields);

				?>
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="quantcast">
						<script type="application/json">
							<?php echo $ampforwp_quantcast_fields ?>
						</script>
					</amp-analytics>
					<?php
				}

		// 10.5 Analytics Support added for comscore
			if ( true == ampforwp_get_setting('ampforwp-comScore-switch')) { 
			$comscore_c1 = ampforwp_get_setting('amp-comscore-analytics-code-c1');
			$comscore_c2 = ampforwp_get_setting('amp-comscore-analytics-code-c2');

				$comscore_fields = array(
						'vars'=>array(
							'c1'=>$comscore_c1,
							'c2'=>$comscore_c2
							),
					); 
				$ampforwp_comscore_fields = apply_filters('ampforwp_comscore_analytics', $ampforwp_comscore_fields );
				$ampforwp_comscore_fields = json_encode( $comscore_fields);
				?>
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="comscore">
						<script type="application/json">
							<?php echo $ampforwp_comscore_fields ?>
					    </script>
					</amp-analytics>
					<?php
				}

	// 10.6 Analytics Support added for Effective Measure
		if( true == ampforwp_get_setting('ampforwp-Effective-switch')) { ?>
			<!-- BEGIN EFFECTIVE MEASURE CODE -->
			<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo ampforwp_get_setting('eam-feild'); ?>" />
			<!--END EFFECTIVE MEASURE CODE -->
		<?php }

	//	10.7 Analytics Support added for StatCounter
		if( true == ampforwp_get_setting('ampforwp-StatCounter-switch')) { ?>
			<!-- BEGIN StatCounter CODE -->
			<div id="statcounter">
			<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo ampforwp_get_setting('sc-feild'); ?>" >
			</amp-pixel> 
			</div>
			<!--END StatCounter CODE -->
		<?php }

	//	10.8 Analytics Support added for Histats Analytics
		if( true == ampforwp_get_setting('ampforwp-Histats-switch')) { ?>
			<!-- BEGIN Histats CODE -->
			<div id="histats">
			<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="//sstatic1.histats.com/0.gif?<?php echo ampforwp_get_setting('histats-feild'); ?>&101" >
			</amp-pixel> 
			</div>
			<!--END Histats CODE -->
		<?php }

	// 10.9 Analytics Support added for Yandex Metrika Analytics
		if ( true == ampforwp_get_setting('ampforwp-Yandex-switch')){ 
		$yandex = ampforwp_get_setting('amp-Yandex-Metrika-analytics-code');
		$yandex_fields = array(
						'vars'=>array(
							'counterId'=>$yandex,
							),
						'triggers'=> array(
							'notBounce'=> array(
								'on'=>'timer',
							'timerSpec'=> array(	
								'immediate'=>'false',
								'interval'=>'15',
								'maxTimerLength'=>'16',
							),
						'request'=>'notBounce'
						)
						
						)
					); 
				$ampforwp_yandex_fields = apply_filters('ampforwp_yandex_analytics', $ampforwp_yandex_fields );
				$ampforwp_yandex_fields = json_encode( $yandex_fields);
				?>
				<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="metrika"> 
				<script type="application/json"> 
					<?php echo $ampforwp_yandex_fields ?>
				</script> 
				</amp-analytics> 
				<?php }//code ends for supporting Yandex Metrika Analytics

	// 10.10 Analytics Support added for Chartbeat Analytics
		if ( true == ampforwp_get_setting('ampforwp-Chartbeat-switch')){
		$chartbeat = ampforwp_get_setting('amp-Chartbeat-analytics-code');
		$chartbeat_fields = array(
						'vars'=>array(
							'accountId'=>$chartbeat,
							'title'=>get_the_title(),
							'authors'=>get_the_author_meta('display_name'),
							'dashboardDomain'=>site_url()

							),
					
					); 
				$ampforwp_chartbeat_fields = apply_filters('ampforwp_chartbeat_analytics', $ampforwp_chartbeat_fields );
				$ampforwp_chartbeat_fields = json_encode( $chartbeat_fields);
		 ?>
				<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="chartbeat">
					 <script type="application/json">
					 <?php echo $ampforwp_chartbeat_fields ?>
					 </script>
				</amp-analytics>
				<?php
			}//code ends for supporting Chartbeat Analytics

	// 10.11 Analytics Support added for Alexa Metrics
			if ( true == ampforwp_get_setting('ampforwp-Alexa-switch')) {
				$alexa = ampforwp_get_setting('ampforwp-alexa-account');
				$domain = ampforwp_get_setting('ampforwp-alexa-domain');
				$alexa_fields = array(
						'vars'=>array(
							'atrk_acct'=>$alexa,
							'domain'=>$domain
							),
					
					); 
				$ampforwp_alexa_fields = apply_filters('ampforwp_alexa_analytics', $ampforwp_alexa_fields );
				$ampforwp_alexa_fields = json_encode( $alexa_fields);

			 ?>
				<!-- Start Alexa AMP Certify Javascript -->
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="alexametrics">
						<script type="application/json">
						<?php echo $ampforwp_alexa_fields ?>
						</script>
					</amp-analytics>
				<!-- End Alexa AMP Certify Javascript -->
					<?php
				}
	// 10.12 Analytics Support added for AFS Analytics
			if ( ampforwp_get_setting('ampforwp-afs-analytics-switch') && true == ampforwp_get_setting('ampforwp-afs-analytics-switch')) {
				$afs_account = ampforwp_get_setting('ampforwp-afs-siteid');
				$afs_server = "www";
				if ($afs_account > 99999)
					$afs_server = 'www1';
				if ($afs_account > 199999)
					$afs_server = 'www2';
				if ($afs_account > 299999)
					$afs_server = 'www3';
				if ($afs_account > 399999)
					$afs_server = 'www4';
				if ($afs_account > 499999)
					$afs_server = 'www5';
				if ($afs_account > 599999)
					$afs_server = 'www6';
				if ($afs_account > 699999)
					$afs_server = 'www7';
				if ($afs_account > 799999)
					$afs_server = 'www8';
				if ($afs_account > 899999)
					$afs_server = 'www9';
				if ($afs_account > 999999)
					$afs_server = 'www10';
				$afs_fields = array(
						'vars'=>array(
							'server'=>$afs_server,
							'websiteid'=>$afs_account,
							'title'=>get_the_title(),
							'url'=>site_url()
							),
					
					); 
				$ampforwp_afs_fields = apply_filters('ampforwp_afs_analytics', $ampforwp_afs_fields );
				$ampforwp_afs_fields = json_encode( $afs_fields);
					 ?>
				<!-- Start AFS Analytics Javascript -->
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="afsanalytics">
						<script type="application/json">
						 <?php echo $ampforwp_afs_fields ?> 
						</script>
					</amp-analytics>
				<!-- End AFS Analytics Javascript -->
					<?php
				}			
}
// For Setting up Google AMP Client ID API
add_action( 'amp_post_template_head' , 'ampforwp_analytics_clientid_api' );	
if( ! function_exists( ' ampforwp_analytics_clientid_api ' ) ) {
	function ampforwp_analytics_clientid_api() {
		global $redux_builder_amp;
		if ( true == ampforwp_get_setting('amp-analytics-select-option') || 'googleanalytics' == ampforwp_get_setting('amp-gtm-analytics-type')){ ?>
			<meta name="amp-google-client-id-api" content="googleanalytics">
		<?php }
	}
}

// 6.1 Adding Analytics Scripts
add_filter('amp_post_template_data','ampforwp_register_analytics_script', 20);
function ampforwp_register_analytics_script( $data ){ 
	global $redux_builder_amp;
	if( true == ampforwp_get_setting('ampforwp-ga-switch') || true == ampforwp_get_setting('ampforwp-Segment-switch') || true == ampforwp_get_setting('ampforwp-Quantcast-switch') || true == ampforwp_get_setting('ampforwp-comScore-switch') || true == ampforwp_get_setting('ampforwp-Yandex-switch') || true == ampforwp_get_setting('ampforwp-Chartbeat-switch') || true == ampforwp_get_setting('ampforwp-Alexa-switch') || true == ampforwp_get_setting('ampforwp-afs-analytics-switch')) {
		
		if ( empty( $data['amp_component_scripts']['amp-analytics'] ) ) {
			$data['amp_component_scripts']['amp-analytics'] = 'https://cdn.ampproject.org/v0/amp-analytics-0.1.js';
		}
	}
	return $data;
}