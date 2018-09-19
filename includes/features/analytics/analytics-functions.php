<?php
// Analytics Area
add_action('amp_post_template_footer','ampforwp_analytics',11);
function ampforwp_analytics() {
	// 10.1 Analytics Support added for Google Analytics
	global $redux_builder_amp;
	if ( true == $redux_builder_amp['ampforwp-ga-switch'] ){
		$ga_fields = array();
		$ampforwp_ga_fields = array();
		$ga_account = '';
		$ga_account = $redux_builder_amp['ga-feild'];
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
		if ( isset($redux_builder_amp['ampforwp-ga-field-anonymizeIP']) && true == $redux_builder_amp['ampforwp-ga-field-anonymizeIP'] ) {
			$ga_fields['vars']['anonymizeIP'] = 'true';
		}
		if ( ampforwp_get_setting('ampforwp-ga-field-linker') == true ) {
			$ga_fields['vars']['linkers'] = 'true';
		}
		$ampforwp_ga_fields = json_encode( $ga_fields);
		$ampforwp_ga_fields = apply_filters('ampforwp_advance_google_analytics', $ampforwp_ga_fields );
	 ?>
			<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="googleanalytics" id="analytics1">
				<script type="application/json">
					<?php echo $ampforwp_ga_fields; ?>
				</script>
			</amp-analytics>
			<?php
		}//code ends for supporting Google Analytics

	// 10.2 Analytics Support added for segment.com
	if ( true == $redux_builder_amp['ampforwp-Segment-switch'] ) { ?>
		<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="segment">
			<script type="application/json">
			{
			  "vars": {
			    "writeKey": "<?php global $redux_builder_amp; echo $redux_builder_amp['sa-feild']; ?>",
					"name": "<?php echo the_title(); ?>"
			  }
			}
			</script>
		</amp-analytics>
		<?php
	}

	// 10.3 Analytics Support added for Piwik
		if( true == $redux_builder_amp['ampforwp-Piwik-switch'] ) { ?>
				<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php global $redux_builder_amp; echo $redux_builder_amp['pa-feild']; ?>"></amp-pixel>
		<?php }

		// 10.4 Analytics Support added for quantcast
			if ( true == $redux_builder_amp['ampforwp-Quantcast-switch'] ) { ?>
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="quantcast">
						<script type="application/json">
						{
						  "vars": {
						    "pcode": "<?php echo $redux_builder_amp['amp-quantcast-analytics-code']; ?>",
								"labels": [ "AMPProject" ]
						  }
						}
						</script>
					</amp-analytics>
					<?php
				}

		// 10.5 Analytics Support added for comscore
			if ( true == $redux_builder_amp['ampforwp-comScore-switch'] ) { ?>
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="comscore">
						<script type="application/json">
						{
						  "vars": {
						    "c1": "<?php echo $redux_builder_amp['amp-comscore-analytics-code-c1']; ?>",
						    "c2": "<?php echo $redux_builder_amp['amp-comscore-analytics-code-c2']; ?>"
						  }
						}
						</script>
					</amp-analytics>
					<?php
				}

	// 10.6 Analytics Support added for Effective Measure
		if( true == $redux_builder_amp['ampforwp-Effective-switch'] ) { ?>
			<!-- BEGIN EFFECTIVE MEASURE CODE -->
			<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php global $redux_builder_amp; echo $redux_builder_amp['eam-feild']; ?>" />
			<!--END EFFECTIVE MEASURE CODE -->
		<?php }

	//	10.7 Analytics Support added for StatCounter
		if( true == $redux_builder_amp['ampforwp-StatCounter-switch'] ) { ?>
			<!-- BEGIN StatCounter CODE -->
			<div id="statcounter">
			<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php global $redux_builder_amp; echo $redux_builder_amp['sc-feild']; ?>" >
			</amp-pixel> 
			</div>
			<!--END StatCounter CODE -->
		<?php }

	//	10.8 Analytics Support added for Histats Analytics
		if( true == $redux_builder_amp['ampforwp-Histats-switch'] ) { ?>
			<!-- BEGIN Histats CODE -->
			<div id="histats">
			<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="//sstatic1.histats.com/0.gif?<?php global $redux_builder_amp; echo $redux_builder_amp['histats-feild']; ?>&101" >
			</amp-pixel> 
			</div>
			<!--END Histats CODE -->
		<?php }

	// 10.9 Analytics Support added for Yandex Metrika Analytics
		if ( true == $redux_builder_amp['ampforwp-Yandex-switch'] ){ ?>
				<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="metrika"> 
				<script type="application/json"> 
					  { 
    					"vars": { 
       							 "counterId": "<?php global $redux_builder_amp; echo $redux_builder_amp['amp-Yandex-Metrika-analytics-code']; ?>" 
  								  }, 
   						 "triggers": { 
     							   "notBounce": { 
          								  "on": "timer", 
          								  "timerSpec": { 
               							  "immediate": false, 
                						  "interval": 15, 
              							  "maxTimerLength": 16 
          							  					}, 
           						   "request": "notBounce" 
       											 } 
   									  } 
				   } 
				</script> 
				</amp-analytics> 
				<?php }//code ends for supporting Yandex Metrika Analytics

	// 10.10 Analytics Support added for Chartbeat Analytics
		if ( true == $redux_builder_amp['ampforwp-Chartbeat-switch'] ){ ?>
				<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="chartbeat">
					 <script type="application/json">
					 {
						'vars': {
							'accountId':"<?php global $redux_builder_amp; echo $redux_builder_amp['amp-Chartbeat-analytics-code']; ?>",
							'title': "<?php the_title(); ?>",
								'authors': "<?php the_author_meta('display_name');?>",      
							'dashboardDomain': "<?php echo site_url();?>"        
								  }
					 }
					 </script>
				</amp-analytics>
				<?php
			}//code ends for supporting Chartbeat Analytics

	// 10.11 Analytics Support added for Alexa Metrics
			if ( true == $redux_builder_amp['ampforwp-Alexa-switch'] ) { ?>
				<!-- Start Alexa AMP Certify Javascript -->
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="alexametrics">
						<script type="application/json">
						{
						  "vars": {
						    "atrk_acct": "<?php echo $redux_builder_amp['ampforwp-alexa-account']; ?>",
						    "domain": "<?php echo $redux_builder_amp['ampforwp-alexa-domain']; ?>"
						  }
						}
						</script>
					</amp-analytics>
				<!-- End Alexa AMP Certify Javascript -->
					<?php
				}
	// 10.12 Analytics Support added for AFS Analytics
			if ( isset($redux_builder_amp['ampforwp-afs-analytics-switch']) && true == $redux_builder_amp['ampforwp-afs-analytics-switch'] ) {
				$afs_account = $redux_builder_amp['ampforwp-afs-siteid'];
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
					$afs_server = 'www10'; ?>
				<!-- Start AFS Analytics Javascript -->
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="afsanalytics">
						<script type="application/json">
						{
						  "vars": {
						    "server": "<?php echo $afs_server; ?>",
						    "websiteid": "<?php echo $afs_account; ?>"
						    "title": "<?php echo esc_attr(get_the_title()); ?>"
						    "url": "<?php echo esc_url(get_the_permalink()); ?>"
						  }
						}
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
		if ( 1 == $redux_builder_amp['amp-analytics-select-option'] || 'googleanalytics' == $redux_builder_amp['amp-gtm-analytics-type']){ ?>
			<meta name="amp-google-client-id-api" content="googleanalytics">
		<?php }
	}
}

// 6.1 Adding Analytics Scripts
add_filter('amp_post_template_data','ampforwp_register_analytics_script', 20);
function ampforwp_register_analytics_script( $data ){ 
	global $redux_builder_amp;
	if( true == $redux_builder_amp['ampforwp-ga-switch'] || true == $redux_builder_amp['ampforwp-Segment-switch'] || true == $redux_builder_amp['ampforwp-Quantcast-switch'] || true == $redux_builder_amp['ampforwp-comScore-switch'] || true == $redux_builder_amp['ampforwp-Yandex-switch'] || true == $redux_builder_amp['ampforwp-Chartbeat-switch']|| true == $redux_builder_amp['ampforwp-Alexa-switch'] || true == $redux_builder_amp['ampforwp-afs-analytics-switch'] ) {
		
		if ( empty( $data['amp_component_scripts']['amp-analytics'] ) ) {
			$data['amp_component_scripts']['amp-analytics'] = 'https://cdn.ampproject.org/v0/amp-analytics-0.1.js';
		}
	}
	return $data;
}