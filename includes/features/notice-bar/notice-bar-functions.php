<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if(is_plugin_active('amp/amp.php')){
	add_action('amp_post_template_css' , 'ampforwp_notification_bar_css');
	function ampforwp_notification_bar_css(){?>
		#amp-user-notification1 p { display: inline-block; margin: 20px 0px; }
		#amp-user-notification1 { padding: 5px; text-align: center; background: #fff; border-top: 1px solid #005be2; }
		amp-user-notification button { padding: 8px 10px; background: red; color: #fff; margin-left: 5px; border: 0; }
		amp-user-notification a{background:red;}
	<?php }
	//add_action('amp_post_template_head' , 'ampforwp_load_geo_script_autoamp');
	function ampforwp_load_geo_script_autoamp(){
		global $redux_builder_amp;
	    if($redux_builder_amp==null){
				$redux_builder_amp = get_option('redux_builder_amp',true);
		}
		echo "<script type='text/javascript' src='https://cdn.ampproject.org/v0/amp-geo-0.1.js' async custom-element=\"amp-geo\"></script>";
		 
	}
}//if end

add_action('ampforwp_global_after_footer','ampforwp_footer');
function ampforwp_footer() {
		global $redux_builder_amp; ?>
	<!--Plugin Version :<?php echo (AMPFORWP_VERSION); ?> -->
<?php if($redux_builder_amp['amp-enable-notifications'] == true && (isset($redux_builder_amp['amp-gdpr-compliance-switch']) && $redux_builder_amp['amp-gdpr-compliance-switch'] == 0) ) { ?>
	<!-- Thanks to @nicholasgriffintn for Cookie Notification Code-->
  <amp-user-notification layout=nodisplay id="amp-user-notification1">
       <p><?php $cookie_message = ampforwp_get_setting('amp-notification-text'); echo strip_tags($cookie_message, '<span><a><b><i><br>');?></p>
       <?php if ( ampforwp_get_setting('amp-enable-links') ){ ?>
	       <a class="amp-not-privacy amp-not-page-link" href="<?php echo esc_url( ampforwp_get_setting('amp-notice-bar-select-privacy-page')); ?>" <?php ampforwp_nofollow_notification(); ?> target="_blank"><?php echo esc_attr(ampforwp_get_setting('amp-notice-bar-privacy-page-button-text')); ?>
	       </a> 
        <?php } ?>
       <button on="tap:amp-user-notification1.dismiss"><?php echo esc_html__(ampforwp_get_setting('amp-accept-button-text'),'accelerated-mobile-pages'); ?></button>
  </amp-user-notification>
<?php } 
if(ampforwp_get_setting('ampforwp-web-push-onesignal') && ampforwp_get_setting('ampforwp-web-push-onesignal-popup') && is_single()){ ?>
<amp-user-notification id="onesignal-popup-id" class="onesignal-popup" layout="nodisplay">
	<div class="onesignal-popup_wrapper">
    <?php echo ampforwp_onesignal_notifications_widget() ?>
    <button class="onesignal-popup_x" on="tap:onesignal-popup-id.dismiss">X</button></div>
</amp-user-notification>
<?php } }

// 50. Properly adding noditification Scritps the AMP way
add_filter( 'amp_post_template_data', 'ampforwp_add_notification_scripts', 75 );
function ampforwp_add_notification_scripts( $data ) {
	global $redux_builder_amp;

	if ( $redux_builder_amp['amp-enable-notifications'] == true && (isset($redux_builder_amp['amp-gdpr-compliance-switch']) && $redux_builder_amp['amp-gdpr-compliance-switch'] == 0)) {
					if ( empty( $data['amp_component_scripts']['amp-user-notification'] ) ) {
						$data['amp_component_scripts']['amp-user-notification'] = 'https://cdn.ampproject.org/v0/amp-user-notification-0.1.js';
					}
	}

	return $data;
}
	
// GDPR Compliancy #2040
add_action('amp_init', 'ampforwp_gdpr_init');
if ( ! function_exists('ampforwp_gdpr_init') ) {
	function ampforwp_gdpr_init() {
		if ( ampforwp_get_setting('amp-gdpr-compliance-switch')  ) {
			if(!isset($_COOKIE['ampforwp_gdpr_action'])){
				// gdpr component 
				add_action('amp_footer_link' , 'amp_gdpr' );
				if ( is_plugin_active('amp/amp.php') ) {
					add_action('amp_post_template_footer' , 'amp_gdpr' );
				}
			}
		}
	}
}