<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Analytics Area
add_action('amp_post_template_footer','ampforwp_analytics',11);
function ampforwp_analytics() {
	// 10.1 Analytics Support added for Google Analytics
	global $redux_builder_amp;
	if ( true == ampforwp_get_setting('ampforwp-ga-switch') && false == ampforwp_get_setting('amp-use-gtm-option') ){
		$ga_fields = array();
		$ampforwp_ga_fields = array();
		$ga_account = '';
		$ga_account = ampforwp_get_setting('ga-feild');
		$ga_account = str_replace(' ', '', $ga_account);
		$ga_fields = array(
						'vars'=>array(
							'gtag_id'=>$ga_account,
							),
						);
		$ga_fields['vars']['config'] = array(
						$ga_account=> array(
								'groups'=>'default',
						)
					);
		$ga_fields['triggers'] = array(
						'trackPageview'=> array(
								'on'=>'visible',
								'request'=>'pageview'			
						)
					);
		if (true == ampforwp_get_setting('ampforwp-infinite-scroll')) {
			$url = ampforwp_url_controller(get_the_permalink());
      		$ga_fields['requests'] =  array(
				'nextpage' => esc_url($url) ,	 
			);
			$ga_fields['triggers'] = array(
						'trackPageview'=> array(
								'on'=>'visible',
								'request'=>'pageview'			
						),
						'trackScrollThrough'=> array(
								'on'=>'amp-next-page-scroll',
								'request'=>'nextpage'			
						),
						'trackClickThrough'=> array(
								'on'=>'amp-next-page-click',
								'request'=>'nextpage'			
						)
					);
		}
		if ( true == ampforwp_get_setting('ampforwp-ga-field-anonymizeIP')) {
			$ga_fields['vars']['anonymizeIP'] = 'true';
		}
		if ( ampforwp_get_setting('ampforwp-ga-field-linker') == true ) {
			$ga_fields['vars']['linkers'] = array(
				'enabled'=> true
			);
		}
		if (ampforwp_get_setting('ampforwp-ga-field-author')) {
			$author = ampforwp_get_setting('ampforwp-ga-field-author-index');
			if ($author) {
				$ga_fields['vars']['config'][$author] = get_the_author_meta('display_name');
			}
		}
		$ga_fields = apply_filters('ampforwp_google_analytics_fields', $ga_fields );
		$ampforwp_ga_fields = json_encode( $ga_fields);
		if( ampforwp_get_setting('ampforwp-ga-field-advance-switch') ){
			$ampforwp_ga_fields = apply_filters('ampforwp_advance_google_analytics', $ampforwp_ga_fields );
			$ampforwp_ga_fields = preg_replace('!/\*.*?\*/!s', '', $ampforwp_ga_fields);
			$ampforwp_ga_fields = preg_replace('/\n\s*\n/', '', $ampforwp_ga_fields);
	 		?>
	 		<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="gtag" id="analytics1">
	 		<script type="application/json">
				<?php echo $ampforwp_ga_fields; ?>
			</script>
			</amp-analytics>
	 		<?php } else if (!empty($ga_account) && $ga_account != "UA-XXXXX-Y") { ?>
			<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="gtag" id="analytics1" data-credentials="include" >
				<script type="application/json">
					<?php echo $ampforwp_ga_fields; ?>
				</script>
			</amp-analytics>
			<?php }
		}//code ends for supporting Google Analytics

	// 10.2 Analytics Support added for clicky.com
	if ( true == ampforwp_get_setting('amp-clicky-switch') ) { 
		$clicky_site_id = ampforwp_get_setting('clicky-site-id'); 
		$clicky_fields = array(
						'vars'=>array(
							'site_id'=> $clicky_site_id,
							)
					);
		$clicky_fields = apply_filters('ampforwp_clicky_analytics', $clicky_fields );?>
		<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="clicky">
		<script type="application/json">
			<?php echo json_encode( $clicky_fields); ?>
			</script>
		</amp-analytics>
		<?php
	}

	// 10.2 Analytics Support added for segment.com
	if ( true == ampforwp_get_setting('ampforwp-Segment-switch') ) { 
		$segment = ampforwp_get_setting('sa-feild'); 
		$segment_fields = array(
						'vars'=>array(
							'writeKey'=>$segment,
							'name'=>get_the_title()
							),
					);
		$segment_fields = apply_filters('ampforwp_segment_analytics', $segment_fields );?>
		<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="segment">
		<script type="application/json">
			<?php echo json_encode( $segment_fields); ?>
			</script>
		</amp-analytics>
		<?php
	}

	// 10.3 Analytics Support added for Piwik
		if( true == ampforwp_get_setting('ampforwp-Piwik-switch')){
			$idsite = ampforwp_get_setting('pa-feild');
			$title = urlencode(get_the_title());
			$url = get_the_permalink();
			if (function_exists( 'is_ssl' ) && !is_ssl()) {
				$url = ampforwp_remove_protocol(ampforwp_url_controller($url));
			}else{
				ampforwp_url_controller($url);
			}
			$rand = rand(1111,9999);
			$referer  = $url;
			if(isset($_SERVER['HTTP_REFERER'])) {
		      $referer  = $_SERVER['HTTP_REFERER'];
		    }
			$piwik_api = str_replace("YOUR_SITE_ID", '1', $idsite);
			$piwik_api = str_replace("TITLE", esc_attr($title), $piwik_api);
			$piwik_api = str_replace("DOCUMENT_REFERRER", esc_url($referer), $piwik_api);
			$piwik_api = str_replace("CANONICAL_URL", esc_url($url), $piwik_api);
			$piwik_api = str_replace("RANDOM", intval($rand), $piwik_api);
			?>
			<amp-pixel src="<?php echo $piwik_api; // XXS ok, escaped above?>"></amp-pixel>
		<?php }

		// 10.4 Analytics Support added for quantcast
			if ( true == ampforwp_get_setting('ampforwp-Quantcast-switch')) { 
				$quantcast = ampforwp_get_setting('amp-quantcast-analytics-code');
				$quantcast_fields = array(
						'vars'=>array(
							'pcode'=>$quantcast,
							'labels'=> array("AMPProject")
							),
					); 
				$quantcast_fields = apply_filters('ampforwp_quantcast_analytics', $quantcast_fields );?>
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="quantcast">
						<script type="application/json">
							<?php echo json_encode( $quantcast_fields); ?>
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
						'extraUrlParams'=> array(
							'comscorekw'=> 'amp'
						),
					); 
				$comscore_fields = apply_filters('ampforwp_comscore_analytics', $comscore_fields );?>
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="comscore">
						<script type="application/json">
							<?php echo json_encode( $comscore_fields); ?>
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
		if( true == ampforwp_get_setting('ampforwp-Histats-switch')) { 
			$url = add_query_arg(esc_attr(ampforwp_get_setting('histats-field')), '', '//sstatic1.histats.com/0.gif');
			$url = add_query_arg('101', '', $url);	?>
			<!-- BEGIN Histats CODE -->
			<div id="histats">
				<amp-pixel <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo esc_url_raw($url); ?>" >
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
				$yandex_fields = apply_filters('ampforwp_yandex_analytics', $yandex_fields );?>
				<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="metrika"> 
				<script type="application/json"> 
					<?php echo json_encode( $yandex_fields); ?>
				</script> 
				</amp-analytics> 
				<?php }//code ends for supporting Yandex Metrika Analytics

	// 10.10 Analytics Support added for Chartbeat Analytics
		if ( true == ampforwp_get_setting('ampforwp-Chartbeat-switch')){
		$chartbeat = ampforwp_get_setting('amp-Chartbeat-analytics-code');
		$ampforwp_chartbeat_fields = array(
						'vars'=>array(
							'uid'=>$chartbeat,
							'domain'=>ampforwp_remove_protocol(site_url()),
							'title'=>get_the_title(),
							'authors'=>get_the_author_meta('display_name'),
							),
					
					); 
				$ampforwp_chartbeat_fields = apply_filters('ampforwp_chartbeat_analytics', $ampforwp_chartbeat_fields );?>
				<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="chartbeat">
					 <script type="application/json">
					 <?php echo json_encode( $ampforwp_chartbeat_fields); ?>
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
				$alexa_fields = apply_filters('ampforwp_alexa_analytics', $alexa_fields );?>
				<!-- Start Alexa AMP Certify Javascript -->
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="alexametrics">
						<script type="application/json">
						<?php echo json_encode( $alexa_fields,JSON_UNESCAPED_SLASHES); ?>
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
				$afs_fields = apply_filters('ampforwp_afs_analytics', $afs_fields );?>
				<!-- Start AFS Analytics Javascript -->
					<amp-analytics <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> type="afsanalytics">
						<script type="application/json">
						 <?php echo json_encode( $afs_fields); ?> 
						</script>
					</amp-analytics>
				<!-- End AFS Analytics Javascript -->
					<?php
				}	
				if( true == ampforwp_get_setting('ampforwp-callrail-switch')) {
				$config_url = $number = $analytics_url = '';
				$config_url = ampforwp_get_setting('ampforwp-callrail-config-url');
				$number = ampforwp_get_setting('ampforwp-callrail-number');
				$analytics_url = ampforwp_get_setting('ampforwp-callrail-analytics-url');
				if(!empty($config_url) && !empty($number) && !empty($analytics_url)){?>
			    <amp-call-tracking config="<?php echo esc_url($config_url); ?>"><a href="tel:<?php echo esc_attr($number);?>"><?php echo esc_html($number);?></a></amp-call-tracking><amp-analytics config="<?php echo esc_url($analytics_url); ?>"></amp-analytics>   
			<?php } }	
			if( true == ampforwp_get_setting('ampforwp-dotmetrics-switch')) { 
                $dot_id = '';
                $dot_id = ampforwp_get_setting('ampforwp-dotmetrics-id');
                if(!empty($dot_id)){
                $analytics_url = "https://script.dotmetrics.net/AmpConfig.json?id=".esc_html($dot_id); ?>
                <amp-analytics config="<?php echo esc_url_raw($analytics_url); ?>"></amp-analytics>
                <?php } }
            if( true == ampforwp_get_setting('ampforwp-topmailru-switch')) { 
                $topmailru_id = '';
                $topmailru_id = ampforwp_get_setting('ampforwp-topmailru-id');
                if(!empty($topmailru_id)){ ?>
                <amp-analytics type="topmailru" id="topmailru">
				<script type="application/json">
				{
				    "vars": {
				        "id": "<?php echo esc_attr($topmailru_id);?>"
				    }
				}
				</script>
				</amp-analytics>
                <?php } }    
                if( true == ampforwp_get_setting('ampforwp-plausible-switch')) { 
                $site_url = site_url();?>
                <amp-analytics>
		    		<script type="application/json">
				        {
				            "vars": {
				                "dataDomain": "<?php echo esc_attr($site_url);?>"
				            },
				            "requests": {
				                "event": "https://plausible.io/api/event"
				            },
				            "triggers": {
				                "trackPageview": {
				                    "on": "visible",
				                    "request": "event",
				                    "extraUrlParams": {
				                        "n": "pageview"
				                    }
				                },
				            },
				            "transport": {
				                "beacon": true,
				                "xhrpost": true,
				                "image": false,
				                "useBody": true
				            }
				        }
				    </script>
				</amp-analytics>
                <?php }
			if( true == ampforwp_get_setting('ampforwp-iotech-switch')) {
                $project_id = $id = $title = $author = $categories = $cat_names = '';
                $project_id = ampforwp_get_setting('ampforwp-iotech-projectid');
                if(!empty($project_id)){
	                $id = ampforwp_get_the_ID();
					$title = get_the_title($id);
					$lang = get_locale();
					$author = get_the_author_meta('display_name');
		 			$categories = get_the_terms( $id, 'category' );
					foreach ($categories as $key=>$cat ) {
					    $cat_names .= '|' . $cat->name ;
					}
					$cat_names = substr($cat_names, 1);
					$content = get_post_field( 'post_content', $id );
	    			$word_count = str_word_count( strip_tags( $content ) );
	    			$date = get_post_time('F d, Y g:i a');
				?>
            <amp-analytics>
   			<script type="application/json">
        	{
            "requests": {
                "pageview": "https://tt.onthe.io/?k[]=<?php echo esc_attr($project_id); ?>:pageviews[user_id:${clientId(_io_un)},author:${article_authors},referrer_uri:${documentReferrer},url:${canonicalPath},domain:${canonicalHostname},user_agent:${userAgent},page:${page_title},platform:amp,language:${page_language},category:${article_categories},type_article:${article_type},word_count:${article_word_count},pub_date:${article_publication_date},page_type:${page_type}]",
                "read_top": "https://tt.onthe.io/?k[]=<?php echo esc_attr($project_id); ?>:read_top[user_id:${clientId(_io_un)},author:${article_authors},referrer_uri:${documentReferrer},url:${canonicalPath},domain:${canonicalHostname},user_agent:${userAgent},page:${page_title},platform:amp,language:${page_language},category:${article_categories},type_article:${article_type},word_count:${article_word_count},pub_date:${article_publication_date},page_type:${page_type}]",
                "read_middle": "https://tt.onthe.io/?k[]=<?php echo esc_attr($project_id); ?>:read_middle[user_id:${clientId(_io_un)},author:${article_authors},referrer_uri:${documentReferrer},url:${canonicalPath},domain:${canonicalHostname},user_agent:${userAgent},page:${page_title},platform:amp,language:${page_language},category:${article_categories},type_article:${article_type},word_count:${article_word_count},pub_date:${article_publication_date},page_type:${page_type}]",
                "read_bottom": "https://tt.onthe.io/?k[]=<?php echo esc_attr($project_id); ?>:read_bottom[user_id:${clientId(_io_un)},author:${article_authors},referrer_uri:${documentReferrer},url:${canonicalPath},domain:${canonicalHostname},user_agent:${userAgent},page:${page_title},platform:amp,language:${page_language},category:${article_categories},type_article:${article_type},word_count:${article_word_count},pub_date:${article_publication_date},page_type:${page_type}]",
                "read_finished": "https://tt.onthe.io/?k[]=<?php echo esc_attr($project_id); ?>:read_finished[user_id:${clientId(_io_un)},author:${article_authors},referrer_uri:${documentReferrer},url:${canonicalPath},domain:${canonicalHostname},user_agent:${userAgent},page:${page_title},platform:amp,language:${page_language},category:${article_categories},type_article:${article_type},word_count:${article_word_count},pub_date:${article_publication_date},page_type:${page_type}]",
                "time": "https://tt.onthe.io/?k[]=<?php echo esc_attr($project_id); ?>:time[platform:amp,url:${canonicalPath}]"
            },
            "vars": {
                "page_title": "$<?php echo esc_attr($title) ?>",
                "page_type": "article",
                "page_language": "<?php echo esc_attr($lang) ?>",
                "article_authors": "<?php echo esc_attr($author) ?>",
                "article_categories": "<?php echo esc_attr($cat_names) ?>",
                "article_type": "longread",
                "article_word_count": "<?php echo esc_attr($word_count) ?>",
                "article_publication_date": "<?php echo esc_attr($date) ?>"
            },
            "triggers": {
                "trackPageview": {
                    "on": "visible",
                    "request": "pageview"
                },
                "trackReadTop" : {
                    "on" : "scroll",
                    "scrollSpec": {
                        "verticalBoundaries": [25]
                    },
                    "request": "read_top"
                },
                "trackReadMiddle" : {
                    "on" : "scroll",
                    "scrollSpec": {
                        "verticalBoundaries": [50]
                    },
                    "request": "read_middle"
                },
                "trackReadBottom" : {
                    "on" : "scroll",
                    "scrollSpec": {
                        "verticalBoundaries": [75]
                    },
                    "request": "read_bottom"
                },
                "trackReadFinished" : {
                    "on" : "scroll",
                    "scrollSpec": {
                        "verticalBoundaries": [90]
                    },
                    "request": "read_finished"
                },
                "pageTimer": {
                    "on": "timer",
                    "timerSpec": {
                        "interval": 10
                    },
                    "request": "time"
                }
            },
            "transport": {
                "beacon": false,
                "xhrpost": false,
                "image": true
            }
        }
   			</script>
			</amp-analytics> 
    <?php } }			
}
// 89. Facebook Pixel
add_action('amp_post_template_footer','ampforwp_facebook_pixel',11);
function ampforwp_facebook_pixel() {
	global $redux_builder_amp;
	if( ampforwp_get_setting('amp-fb-pixel') ){
		$amp_pixel = '<amp-pixel ';
		if(ampforwp_get_data_consent()){
			$amp_pixel .= 'data-block-on-consent';
		}
		$amp_pixel .= ' src="https://www.facebook.com/tr?id='.esc_attr(ampforwp_get_setting('amp-fb-pixel-id')).'&ev=PageView&noscript=1"></amp-pixel>';
		echo $amp_pixel; // escaped above 
	}
}
// For Setting up Google AMP Client ID API
add_action( 'amp_post_template_head' , 'ampforwp_analytics_clientid_api' );	
if( ! function_exists( ' ampforwp_analytics_clientid_api ' ) ) {
	function ampforwp_analytics_clientid_api() {
		global $redux_builder_amp;
		if ( true == ampforwp_get_setting('ampforwp-ga-switch') || true == ampforwp_get_setting('amp-use-gtm-option')){ ?>
			<meta name="amp-google-client-id-api" content="googleanalytics">
		<?php }
	}
}

if ( ! function_exists('amp_activate') ) {
	add_action('amp_init', 'amp_gtm_remove_analytics_code');
	function amp_gtm_remove_analytics_code() {
	  global $redux_builder_amp;
	  if( isset($redux_builder_amp['amp-use-gtm-option']) && $redux_builder_amp['amp-use-gtm-option'] ) {
	  	
	  	//Add GTM Analytics code right after the body tag
	  	add_action('ampforwp_body_beginning','AMPforWP\\AMPVendor\\amp_post_template_add_analytics_data',10);
	  } 
	}
	//Remove other analytics if GTM is enable
	add_action('amp_post_template_footer','ampforwp_gtm_support', 9);
	function ampforwp_gtm_support(){
	  global $redux_builder_amp;
	  	if( isset($redux_builder_amp['amp-use-gtm-option']) && $redux_builder_amp['amp-use-gtm-option'] ) {
			remove_action( 'amp_post_template_footer', 'AMPforWP\\AMPVendor\\amp_post_template_add_analytics_data' );
		}
	}
}
// Create GTM support

add_action( 'ampforwp_body_beginning', 'ampforwp_add_advance_gtm_fields' );
function ampforwp_add_advance_gtm_fields( $ampforwp_adv_gtm_fields ) {
	if(true == ampforwp_get_setting('amp-use-gtm-option')){
		$gtm_id 	= ampforwp_get_setting('amp-gtm-id');
		$gtm_analytics 	= ampforwp_get_setting('amp-gtm-analytics-code');
		if(true == ampforwp_get_setting('ampforwp-gtm-field-advance-switch') ){
			$ampforwp_adv_gtm_fields = "";
			$ampforwp_adv_gtm_fields = ampforwp_get_setting('ampforwp-gtm-field-advance');
			$ampforwp_adv_gtm_fields = preg_replace('!/\*.*?\*/!s', '', $ampforwp_adv_gtm_fields);
			$ampforwp_adv_gtm_fields = preg_replace('/\n\s*\n/', '', $ampforwp_adv_gtm_fields);
			$ampforwp_adv_gtm_fields = preg_replace('/\/\/(.*?)\s(.*)/m', '$2', $ampforwp_adv_gtm_fields); 
			if($gtm_id!=""){?>
				<amp-analytics config="https://www.googletagmanager.com/amp.json?id=<?php echo esc_attr($gtm_id);?>" <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?>><script type="application/json"><?php echo sanitize_text_field($ampforwp_adv_gtm_fields) ?></script></amp-analytics> <?php
			}
		}else{
			if($gtm_id!="" && empty($gtm_analytics)){ ?>
				<amp-analytics config="https://www.googletagmanager.com/amp.json?id=<?php echo esc_attr($gtm_id);?>" <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?>></amp-analytics> <?php
			}
			if($gtm_id!="" && !empty($gtm_analytics)){ ?>
				<amp-analytics config="https://www.googletagmanager.com/amp.json?id=<?php echo esc_attr($gtm_id);?>" <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?>data-credentials="include"><script type="application/json">{ "vars": { "account": "<?php echo esc_html($gtm_analytics);?>"} }</script></amp-analytics>
			<?php }
		}
	}
}


// 83. Advance Analytics(Google Analytics)
add_filter('ampforwp_advance_google_analytics','ampforwp_add_advance_ga_fields');
function ampforwp_add_advance_ga_fields($ga_fields){
	global $redux_builder_amp, $post;
	$url = $title = $id = $author_id = $author_name = '';
	$url = get_the_permalink();
	$tag_names = array();
	if(!is_object($post)){ return $ga_fields; }
	$id = ampforwp_get_the_ID();
	$title = get_the_title($id);
	$category_detail = get_the_category($id);//$post->ID
	$category_name = '';
	if ( ! empty( $category_detail ) ) {
		foreach($category_detail as $cd){
			$category_name_array[] = $cd->cat_name;
		}
		$category_name = implode( ', ', $category_name_array );
	}
	$tags = get_the_tags( $id );
	$focusKeyword = '';
	$seoScore = '';
	if( defined('WPSEO_FILE')){
		$focusKeyword = get_post_meta($id, '_yoast_wpseo_focuskw', true); 
		$seoScore = get_post_meta($id, '_yoast_wpseo_content_score', true); 
	}

	$tagNames = '';
	if( !empty($tags) ){
	    foreach( $tags as $tag ) {
	    	$tag_names[] = $tag->name;
	    }
	    $tagNames = implode( ', ', $tag_names );
	}
	$author_id = get_post_field( 'post_author', $id );
	$author_name = get_the_author_meta( 'display_name' , $author_id );
	$published_at = get_the_date( 'F j, Y' , $id );
	$ampforwp_adv_ga_fields = array();
	$ampforwp_adv_ga_fields = ampforwp_get_setting('ampforwp-ga-field-advance');
	if($ampforwp_adv_ga_fields)	{
		$ampforwp_adv_ga_fields = str_replace('{url}', $url, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{id}', $id, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{title}', $title, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{author_id}', $author_id, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{author_name}', $author_name, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{category}', $category_name, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{published_at}', $published_at, $ampforwp_adv_ga_fields);
		$ampforwp_adv_ga_fields = str_replace('{tags}', $tagNames, $ampforwp_adv_ga_fields);
		if( defined('WPSEO_FILE')){
			$ampforwp_adv_ga_fields = str_replace('{seo_score}', $seoScore, $ampforwp_adv_ga_fields);
			$ampforwp_adv_ga_fields = str_replace('{focus_keyword}', $focusKeyword, $ampforwp_adv_ga_fields);
		}
		return $ampforwp_adv_ga_fields;
	}	
	return $ga_fields;	
}
