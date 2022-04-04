<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function amp_gdpr_output(){
	global $redux_builder_amp;
    $headline   = $accept = $reject = $settings = $user_data = $form_url = '';
    $headline   = $redux_builder_amp['amp-gdpr-compliance-headline-text'];
    $accept   = $redux_builder_amp['amp-gdpr-compliance-accept-text'];
    $reject   = $redux_builder_amp['amp-gdpr-compliance-reject-text'];
    $settings   = $redux_builder_amp['amp-gdpr-compliance-settings-text'];
    $user_data  = $redux_builder_amp['amp-gdpr-compliance-textarea'];
    $form_url   = admin_url('admin-ajax.php?action=amp_consent_submission&verify_nonce='.wp_create_nonce('amp_consent'));
    $form_url   = preg_replace('#^https?:#', '', $form_url);
    $more_info  = $redux_builder_amp['amp-gdpr-compliance-for-more-privacy-info'];
    $privacy_page = '';
    $privacy_button_text = '';
    if(isset($redux_builder_amp['amp-gdpr-compliance-select-privacy-page']) && $redux_builder_amp['amp-gdpr-compliance-select-privacy-page']){
    $privacy_page = get_permalink($redux_builder_amp['amp-gdpr-compliance-select-privacy-page']);}

    if(isset($redux_builder_amp['amp-gdpr-compliance-privacy-page-button-text']) && $redux_builder_amp['amp-gdpr-compliance-privacy-page-button-text']){
    $privacy_button_text = $redux_builder_amp['amp-gdpr-compliance-privacy-page-button-text'];
    }
    $gdpr_countries = array("AT","BE", "BG", "HR", "CY", "CZ", "DK", "EE", "FI", "FR", "DE", "GR", "HU", "IS", "IE", "IT", "LV", "LI", "LT", "LU", "MT", "NL", "NO", "PL", "PT", "RO", "SK", "SI", "ES", "SE", "GB", "AX", "IC", "EA", "GF", "PF", "TF", "GI", "GP", "GG", "JE", "MQ", "YT", "NC", "RE", "BL", "MF", "PM", "SJ", "VA", "WF", "EZ", "CH","BR");
    $gdpr_countries = apply_filters( 'ampforwp_gdpr_country_list' , $gdpr_countries ); 
    $gdpr_text = array("headline"=>$headline,"user_data"=>$user_data,"accept"=>$accept,"reject"=>$reject,"settings"=>$settings,"more_info "=>$more_info,"privacy_button_text"=>$privacy_button_text );
	$gdpr_text = apply_filters('ampforwp_modify_gdpr_output',$gdpr_text);
	$headline = $gdpr_text['headline'];
	$user_data = $gdpr_text['user_data'];
	$accept = $gdpr_text['accept'];
	$reject = $gdpr_text['reject'];
	$settings = $gdpr_text['settings'];
	$more_info = isset($gdpr_text['more_info']) ? $gdpr_text['more_info'] : "";
	$privacy_button_text = $gdpr_text['privacy_button_text'];
    ?>
    <amp-geo layout="nodisplay">
        <script type="application/json">
            {
               "ISOCountryGroups": {
               		"eea":[ <?php echo '"'.implode('","', array_values($gdpr_countries)).'"';?> ]
                }
            }
        </script>
    </amp-geo>      
    <amp-consent id="ampforwpConsent" layout="nodisplay">
	    <script type="application/json">{
	        "consents": {
	          "consent1": {
	            "promptIfUnknownForGeoGroup": "eea",
	            "promptUI": "gdpr_c"
	          }
	        },
	        "postPromptUI": "post-consent-ui"
	    }</script>
          <div class="gdpr" id="gdpr_c">
            <div class="gdpr_w">
              <div class="gdpr_x" role="button" tabindex="0" on="tap:ampforwpConsent.dismiss">X</div>
              <div class="gdpr-l">
	              	<div class="gdpr_t">
		                <h3><?php echo esc_html__($headline,'accelerated-mobile-pages'); ?></h3>
		                <p><?php echo esc_html__($user_data,'accelerated-mobile-pages'); ?></p>
		                <?php if (ampforwp_get_setting('amp-gdpr-newguidelines-switch')) { ?>
		                <p>You can control the ways in which we improve and personalize your experience. Please choose whether you wish to allow the following:</p>
		          		<div class="choices">
				            <label class="consentLabel" for="consent-purpose-marketing">
				              <input id="consent-purpose-marketing" type="checkbox" on="change:siteConsent.setPurpose(purpose-marketing=event.checked)">
				              Marketing cookies
				            </label>
				            <label class="consentLabel" for="consent-purpose-conversion">
				              <input id="consent-purpose-conversion" type="checkbox" on="change:siteConsent.setPurpose(purpose-conversion=event.checked)">
				              Conversion tracking cookies
				            </label>
				            <label class="consentLabel" for="consent-purpose-analytics">
				              <input id="consent-purpose-analytics" type="checkbox" on="change:siteConsent.setPurpose(purpose-analytics=event.checked)">
				              Analytics
				            </label>
		        		</div>
		        	<?php } ?>
	                </div><?php if(isset($redux_builder_amp['amp-gdpr-compliance-select-privacy-page']) && $redux_builder_amp['amp-gdpr-compliance-select-privacy-page']){?>
	                <div class="gdpr_fmi">
	                   <span><?php echo esc_html__($more_info,'accelerated-mobile-pages'); ?></span>
	                  <a class="gdpr_fmi pri_page_link" href="<?php echo esc_attr($privacy_page); ?>" target="_blank"><?php echo esc_html__($privacy_button_text,'accelerated-mobile-pages'); ?></a> 
	                </div><?php } ?>
	            </div>
              <div id="gdpr_yn" class="gdpr_yn">
              	<div class="gdpr-btns">
	                <form class="acp" action-xhr="<?php echo esc_url($form_url); ?>" method="post" target="_top">
	                  <button type="submit" on="tap:ampforwpConsent.accept" class="btn gdpr_y btn"><?php echo esc_html__($accept,'accelerated-mobile-pages'); ?></button>
	                </form>
	                <form class="rej" action-xhr="<?php echo esc_url($form_url); ?>" method="post" target="_top">
	                  <button type="submit" on="tap:ampforwpConsent.reject" class="btn gdpr_n"><?php echo esc_html__($reject,'accelerated-mobile-pages'); ?></button>
	                 </form>
	             </div>
              </div>
            </div>
          </div>
          <div id="post-consent-ui">
            <a href="#" on="tap:ampforwpConsent.prompt()" class="btn"><?php echo esc_html__($settings,'accelerated-mobile-pages'); ?></a> 
          </div>
      </amp-consent>
<?php 
}
global $loadComponent;
if (ampforwp_get_setting('amp-gdpr-compliance-switch') || (isset($loadComponent['AMP-gdpr']) && true == $loadComponent['AMP-gdpr'] )) {
	if(!isset($_COOKIE['ampforwp_gdpr_action'])){
		// Scripts
		add_filter('amp_post_template_data' , 'ampforwp_gdpr_data', 15);
		// CSS
		add_action('amp_post_template_css' , 'ampforwp_gdpr_css');
	}
	// Consent Submission
	add_action('wp_ajax_amp_consent_submission','amp_consent_submission');
	add_action('wp_ajax_nopriv_amp_consent_submission','amp_consent_submission');
}

function ampforwp_gdpr_data( $data ) {
    global $redux_builder_amp;
    if ( empty( $data['amp_component_scripts']['amp-consent'] ) ) {
     	$data['amp_component_scripts']['amp-consent'] = 'https://cdn.ampproject.org/v0/amp-consent-0.1.js';
    }
    if ( empty( $data['amp_component_scripts']['amp-form'] ) ) {
     	$data['amp_component_scripts']['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
    }
    if ( empty( $data['amp_component_scripts']['amp-geo'] ) ) {
    	$data['amp_component_scripts']['amp-geo'] = 'https://cdn.ampproject.org/v0/amp-geo-0.1.js';
     }
    
    return $data;
}

function ampforwp_gdpr_css(){ 
  	global $redux_builder_amp;
    // GDPR popup Design 
	if($redux_builder_amp['gdpr-type'] == '1'){?>			
		.gdpr{position: fixed; top: 0; bottom: 0; left: 0; right: 0; background: rgba(0, 0, 0, 0.7);color: #333;z-index:9999999;line-height:1.3;height: 100vh;width: 100vw}
		.gdpr_w{padding: 2rem;background: #fff;max-width: 700px;width: 95%;margin: 5% auto;text-align: center;position:fixed;left: 0;right: 0;margin:10% auto;}
		.gdpr_t{margin-bottom:15px;}
		.gdpr_t h3{font-size: 30px;margin:0px 0 10px 0;}
		.gdpr_t p{font-size: 16px;line-height: 1.45;margin:0;}
		.gdpr_x {position: absolute; right: 24px; top: 16px; cursor:pointer;}
		.gdpr_yn{margin-top:10px;}
		.gdpr_yn form{display: inline;}
		.gdpr_yn button{background: #37474F;border: none;color: #fff;padding: 8px 30px;font-size: 13px;margin: 0 3px;}
		.gdpr_yn .gdpr_n{background: #fff;color: #222;border: 1px solid #999;}
		amp-consent{margin-left: 10px;top: 2px;width: auto;background: transparent;}
		.gdpr_fmi{
		  width:100%;
		  font-size: 15px;
		  line-height: 1.45;
		  margin: 0;
		}
		#footer .gdpr_fmi span, .gdpr_fmi span {
		    display: inline-block;
		}
		#footer .gdpr_fmi a{
			color: <?php echo ampforwp_sanitize_color( ampforwp_get_setting('swift-color-scheme','color') ); ?>;
		}
	
		@media(max-width:768px){
			.gdpr_w{width: 85%;margin:0 auto;padding:1.5rem;}
		}
		@media(max-width:700px){
		    .gdpr_w{margin:0 auto; width: 85%;}
		    
		}<?php 
	} // GDPR Type 1 End
	// GDPR Notice bar
	if($redux_builder_amp['gdpr-type'] == '2'){
		$position = ampforwp_get_setting('amp-gdpr-type2-position');
		?>
		.gdpr{position: fixed; <?php if($position==1){?>top: 0;<?php }else{?> bottom: 0;<?php }?> left: 0; right: 0; z-index:99999;}
		.gdpr_w{padding:20px 40px;background: #383B75;width: 95%;position: relative;margin: 0% auto;display: inline-flex;}
		.gdpr_t h3, .gdpr_fmi{    
		  font-size: 16px;
		  color:#fff;
		    margin: 0;
		    font-weight: 400;
		}
		.gdpr_fmi a{
		  text-decoration:underline;
		  margin-left: 10px;
		  color:#fff;
		  opacity: .8;
		}
		.gdpr_fmi a:hover{
		  opacity: 1;
		  color:#fff;
		}
		.gdpr-l{
		  display: flex;
		    flex-direction: row;
		    align-items: center;
		    order: 0;
		}
		.gdpr_t, .gdpr_fmi{
		  display:inline-block;
		}
		.gdpr_t p{display:none;}
		.gdpr_x {position: absolute;right: 18px;top: 6px; cursor:pointer;color: #fff;visibility: hidden;}
		.gdpr_yn{
		  text-align: right;
		    order: 0;
		    flex-grow: 1;
		}
		.gdpr_yn form{display: inline;}
		.gdpr_yn button{background: #FFFC26;border: none;color: #333;padding: 8px 40px;font-size: 15px;margin: 0 3px;font-weight: 600;cursor: pointer;}
		.gdpr_yn .gdpr_n{background: transparent;}
		amp-consent{position: relative;margin-left: 10px;width: auto;background: transparent;margin:0;left:40%;}
		.gdpr_fmi span, .gdpr_fmi a:before{
		  display:none;
		}
		.gdpr-btns{
		  display:inline-flex;
		  align-items: center;
		}
		.gdpr_yn .acp{
		  order: 1;
		}
		.rej button{
		  font-size: 15px;
		    padding: 0;
		    font-weight: 500;
		    margin-right: 20px;
		    cursor: pointer;
		    color:#fff;
		}
		.rej button:hover{
		  text-decoration:underline;
		} 
		@media(max-width:768px){
			.gdpr-l{display:inline-block;}
			.gdpr_fmi a{margin:0;}
			.gdpr_t, .gdpr_fmi {
			    display: block;
			    line-height: 1.4;
			}
			.gdpr_w{padding:10px 15px;
				display:inline-block;text-align:left;
			}
			.gdpr_yn {
			    margin-top: 10px;
			    text-align: center;
			}
		}<?php 
	} // GDPR Type 2 End
    
    if ( '1' === $redux_builder_amp['amp-design-selector'] ) { ?>
    	#ampforwpConsent{
		    left: 50%;
		    font-size: 13px;
		    top: -15px;
	    }
	    #ampforwpConsent a{
		    text-decoration:none;
		}
		
    	  <?php
    }
    if ( '3' === $redux_builder_amp['amp-design-selector'] ) {?>
		amp-consent{background:none}
		@media(max-width:425px){
		#footer amp-consent a{font-size:12px;margin-top:7px;display:inline-block;}
		}<?php 
	}
	if ( '4' === $redux_builder_amp['amp-design-selector'] ) {?>
		.gdpr_fmi a:before{
			display:none;
		}
		.gdpr_w{width:100%;}
		.f-w-f2 {
		    padding: 50px 0px;
		}
		<?php 
	} ?>
	footer amp-consent.amp-active {
	    z-index:9999;
	    display: initial;
	    position: inherit;
	    height:20px;
	    width:100%;
	}	
	body[class*="amp-iso-country-"] .amp-active{
    	display: contents;
	}
	#post-consent-ui {
		position: fixed;
		z-index: 9999;
		left: 45%;
		margin-top: 10px;
		top: 0;
	}
<?php }

function amp_consent_submission(){
	if(wp_verify_nonce( $_REQUEST['verify_nonce'], 'amp_consent' ) ) {
		setcookie('ampforwp_gdpr_action','true', time() + (86400 * 30), "/");
       	$current_url = $site_url = $site_host = $amp_site = '';
		$current_url 	= wp_get_referer();
		$site_url 		= parse_url( get_site_url() );
		$site_host 		= $site_url['host'];
		$amp_site 		= $site_url['scheme'] . '://' . $site_url['host'];
		header("AMP-Access-Control-Allow-Source-Origin: ".esc_url($amp_site));
		header("AMP-Redirect-To: ".esc_url($current_url));
    }else{
    	echo json_encode(array("status"=>300,"message"=>'Request not valid'));
        die;
    }
	
}
