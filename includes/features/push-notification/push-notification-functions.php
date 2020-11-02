<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// 94. OneSignal Push Notifications
add_action( 'ampforwp_body_beginning' , 'ampforwp_onesignal_notifications' , 11 );
if( ! function_exists( ' ampforwp_onesignal_notifications ' ) ){
	function ampforwp_onesignal_notifications(){ 
	global $redux_builder_amp;
	$checker = false;
	if ( (!checkAMPforPageBuilderStatus(get_the_ID()) &&  is_single() ) || true == ampforwp_get_setting('ampforwp-web-push-onesignal-header') || true == ampforwp_get_setting('ampforwp-web-push-onesignal-sticky') ){
		$checker = true;
	}
	elseif ( !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) &&  (is_page() || ampforwp_is_front_page()) && true == ampforwp_get_setting('ampforwp-one-signal-page')){
		$checker = true;
	}
	if('1' == ampforwp_get_setting('ampforwp-web-push') && $checker ){
		$onesignal_domain 		= '';
		$onesignal_domain_sw 	= '';
		$onesignal_subdomain 	= '';
		$onesignal_app_id		= '';
		$helper_iframe_url		= '';
		$permission_dialog_url  = '';
		$service_worker_url		= '';
		// HTTPS sites
		$onesignal_domain 		= AMPFORWP_PLUGIN_DIR_URI.'includes/onesignal-integration/';
		$onesignal_domain_sw 	= trailingslashit( home_url() );
		$onesignal_app_id		= $redux_builder_amp['ampforwp-one-signal-app-id'];
		$helper_iframe_url = $onesignal_domain .'amp-helper-frame.html?appId=' . $onesignal_app_id;

		$permission_dialog_url = $onesignal_domain .'amp-permission-dialog.html?appId=' . $onesignal_app_id;

		$service_worker_url = plugins_url('onesignal-free-web-push-notifications/sdk_files/OneSignalSDKWorker.js.php?appId=' . $onesignal_app_id);
		// HTTP sites
		if(isset($redux_builder_amp['ampforwp-onesignal-http-site'] ) && $redux_builder_amp['ampforwp-onesignal-http-site'] ){
			$onesignal_subdomain = $redux_builder_amp['ampforwp-onesignal-subdomain'];
			if ( $onesignal_subdomain ) {
				$onesignal_subdomain = $onesignal_subdomain.'.';
			}
			$helper_iframe_url = 'https://' . $onesignal_subdomain . 'os.tc/amp/helper_frame?appId=' . $onesignal_app_id . '';
			$permission_dialog_url = 'https://' . $onesignal_subdomain . 'os.tc/amp/permission_dialog?appId=' . $onesignal_app_id . '';
			$service_worker_url = 'https://' . $onesignal_subdomain . 'os.tc/OneSignalSDKWorker.js?appId=' . $onesignal_app_id . '';
		}	?>
	 <amp-web-push
	    id="amp-web-push"
	    layout="nodisplay"
	    helper-iframe-url="<?php echo esc_url($helper_iframe_url); ?>"
	    permission-dialog-url="<?php echo esc_url($permission_dialog_url); ?>"
	    service-worker-url="<?php echo esc_url($service_worker_url); ?>">
	 </amp-web-push> 
<?php 
		}
	}
}
if(function_exists('amp_activate')){
	add_action('ampforwp_after_post_content', 'ampforwp_notification_widget');
	function ampforwp_notification_widget(){
		global $redux_builder_amp; 
		if($redux_builder_amp==null){
			$redux_builder_amp = get_option('redux_builder_amp',true);
		}
		if( isset( $redux_builder_amp['ampforwp-web-push-onesignal-below-content'] ) && true == $redux_builder_amp['ampforwp-web-push-onesignal-below-content'] && !checkAMPforPageBuilderStatus(get_the_ID()) ){
				ampforwp_onesignal_notifications_widget();
			}
	}
	add_action('ampforwp_before_post_content', 'ampforwp_notification_widget_other_position');
	function ampforwp_notification_widget_other_position(){
		global $redux_builder_amp; 
		if($redux_builder_amp==null){
			$redux_builder_amp = get_option('redux_builder_amp',true);
		}
			if( isset( $redux_builder_amp['ampforwp-web-push-onesignal-above-content'] ) &&  true == $redux_builder_amp['ampforwp-web-push-onesignal-above-content'] && !checkAMPforPageBuilderStatus(get_the_ID()) ){
				ampforwp_onesignal_notifications_widget();
			}
		}
}else{

	// OneSignal Push Notifications Widget
	add_action('pre_amp_render_post', 'ampforwp_onesignal_notifications_widget_position');
	if( ! function_exists( 'ampforwp_onesignal_notifications_widget_position' ) ){
		function ampforwp_onesignal_notifications_widget_position(){
			global $redux_builder_amp;
			if ( isset($redux_builder_amp['ampforwp-web-push-onesignal-header']) && $redux_builder_amp['ampforwp-web-push-onesignal-header'] ) {
				add_action('ampforwp_push_notification_widget', 'ampforwp_onesignal_widget_swift'); 
				add_action('ampforwp_call_button', 'ampforwp_onesignal_widget');
			}
			if ( isset($redux_builder_amp['ampforwp-web-push-onesignal-sticky']) && $redux_builder_amp['ampforwp-web-push-onesignal-sticky'] ) {
				add_action('amp_post_template_footer','ampforwp_onesignal_sticky');
			}
			if( isset( $redux_builder_amp['ampforwp-web-push-onesignal-below-content'] ) && true == $redux_builder_amp['ampforwp-web-push-onesignal-below-content'] && !checkAMPforPageBuilderStatus(get_the_ID()) ){
				add_action('ampforwp_after_post_content', 'ampforwp_onesignal_notifications_widget');
			}

			if( isset( $redux_builder_amp['ampforwp-web-push-onesignal-above-content'] ) &&  true == $redux_builder_amp['ampforwp-web-push-onesignal-above-content'] && !checkAMPforPageBuilderStatus(get_the_ID()) ){
				add_action('ampforwp_inside_post_content_before', 'ampforwp_onesignal_notifications_widget');
				add_action('ampforwp_before_post_content', 'ampforwp_onesignal_notifications_widget');
			}
		}
	}
}


if( ! function_exists('ampforwp_onesignal_notifications_widget') ){
	function ampforwp_onesignal_notifications_widget(){
	 $checker = false;
	 if ( is_single() || ( (is_page() || ampforwp_is_front_page()) && true == ampforwp_get_setting('ampforwp-one-signal-page'))){
	 	$checker = true;
	}
	if('1' == ampforwp_get_setting('ampforwp-web-push') && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && $checker ){?>
		<!-- A subscription widget -->
	<div class="amp-web-push-container">
		<amp-web-push-widget visibility="unsubscribed" layout="fixed" width="245" height="45">
		  <button class="subscribe" on="tap:amp-web-push.subscribe">
		    <amp-img
		             class="subscribe-icon"
		             width="24"
		             height="24"
		             layout="fixed"
		             src="data:image/svg+xml;base64,PHN2ZyBjbGFzcz0ic3Vic2NyaWJlLWljb24iIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Ik0xMS44NCAxOS44ODdIMS4yMnMtLjk0Ny0uMDk0LS45NDctLjk5NWMwLS45LjgwNi0uOTQ4LjgwNi0uOTQ4czMuMTctMS41MTcgMy4xNy0yLjYwOGMwLTEuMDktLjUyLTEuODUtLjUyLTYuMzA1czIuODUtNy44NyA2LjI2LTcuODdjMCAwIC40NzMtMS4xMzQgMS44NS0xLjEzNCAxLjMyNSAwIDEuOCAxLjEzNyAxLjggMS4xMzcgMy40MTMgMCA2LjI2IDMuNDE4IDYuMjYgNy44NyAwIDQuNDYtLjQ3NyA1LjIyLS40NzcgNi4zMSAwIDEuMDkgMy4xNzYgMi42MDcgMy4xNzYgMi42MDdzLjgxLjA0Ni44MS45NDdjMCAuODUzLS45OTYuOTk1LS45OTYuOTk1SDExLjg0ek04IDIwLjk3N2g3LjExcy0uNDkgMi45ODctMy41MyAyLjk4N1M4IDIwLjk3OCA4IDIwLjk3OHoiIGZpbGw9IiNGRkYiLz48L3N2Zz4=">
		    </amp-img>
		    <?php echo ampforwp_translation( ampforwp_get_setting('ampforwp-onesignal-translator-subscribe'), 'Subscribe to updates' ); ?>
		  </button>
		</amp-web-push-widget>
		<!-- An unsubscription widget -->
		<amp-web-push-widget visibility="subscribed" layout="fixed" width="230" height="45">
		   <button class="unsubscribe" on="tap:amp-web-push.unsubscribe">
		   	<?php echo ampforwp_translation( ampforwp_get_setting('ampforwp-onesignal-translator-unsubscribe'), 'Unsubscribe from updates' ); ?>
		   </button>
		</amp-web-push-widget>
	</div>
	<?php }
	}
}
//OneSignal Push Notifications Script
add_filter('amp_post_template_data', 'ampforwp_onesignal_notifications_script');
if(!function_exists('ampforwp_onesignal_notifications_script')){
	function ampforwp_onesignal_notifications_script( $data ){
	global $redux_builder_amp;
	$checker = false;
	if ( (!checkAMPforPageBuilderStatus(get_the_ID()) && is_single() ) || true == ampforwp_get_setting('ampforwp-web-push-onesignal-header') || true == ampforwp_get_setting('ampforwp-web-push-onesignal-sticky') ){
		$checker = true;
	}
	if('1' == ampforwp_get_setting('ampforwp-web-push') && $checker ){
		if ( empty( $data['amp_component_scripts']['amp-web-push'] ) ) {
				$data['amp_component_scripts']['amp-web-push'] = 'https://cdn.ampproject.org/v0/amp-web-push-0.1.js';
			}
		}
	return $data;
	}
}
// OneSignal Push Notifications Styling
add_action('amp_post_template_css' , 'ampforwp_onesignal_notifications_styling' , 99);
if(!function_exists('ampforwp_onesignal_notifications_styling')){
	function ampforwp_onesignal_notifications_styling(){
	$checker = false;
	if ( is_single() || ( (is_page() || ampforwp_is_front_page()) && true == ampforwp_get_setting('ampforwp-one-signal-page'))){
		$checker = true;
	}
	if('1' == ampforwp_get_setting('ampforwp-web-push') && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && $checker ){?>
    amp-web-push-widget button.subscribe { display: inline-flex; align-items: center; border-radius: 2px; border: 0; box-sizing: border-box; margin: 0; padding: 10px 15px; cursor: pointer; outline: none; font-size: 15px; font-weight: 400; background: #4A90E2; color: white; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.5); -webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
    amp-web-push-widget button.subscribe .subscribe-icon {margin-right: 10px;}
    amp-web-push-widget button.subscribe:active {transform: scale(0.99);}
    amp-web-push-widget button.unsubscribe {display: inline-flex; align-items: center; justify-content: center; height: 45px; border: 0; margin: 0; cursor: pointer; outline: none; font-size: 15px; font-weight: 400; background: #4a90e2; color: #fff; -webkit-tap-highlight-color: rgba(0,0,0,0); box-sizing: border-box; padding: 10px 15px;}
    amp-web-push-widget.amp-invisible{ display:none;}
    .amp-web-push-container{width: 245px; margin:0 auto}
    .amp-web-push-bell-cn{width: 24px; margin:0 auto}
    .icon-add_alert:after{content:"\e7f7"}
    .amp-web-push-sticky{position:fixed;top:70%;right:0;}
    .awp-sticky{background-color:#0084ff;border-radius: 60%;padding:10px 10px 6px 10px;line-height:1;display:inline-block;}
<?php }
	}	
}
// Onesignal Header Widget [ Swift ]
function ampforwp_onesignal_widget_swift() { ?>
	<div class="amp-web-push-bell-cn">
		<amp-web-push-widget visibility="unsubscribed" layout="fixed" width="30" height="30">
		  <a class="subscribe icon-add_alert" on="tap:amp-web-push.subscribe">
		  </a>
		</amp-web-push-widget>
		<!-- An unsubscription widget -->
		<amp-web-push-widget visibility="subscribed" layout="fixed" width="30" height="30">
		   <a class="unsubscribe icon-add_alert" on="tap:amp-web-push.unsubscribe">
		   </a>
		</amp-web-push-widget>
	</div>
<?php }
// Onesignal Header Widget
function ampforwp_onesignal_widget() { ?>
	<div class="amp-web-push-bell-cn">
		<amp-web-push-widget visibility="unsubscribed" layout="fixed" width="30" height="30">
		  <a class="subscribe" on="tap:amp-web-push.subscribe">
		  	<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMzIgMzIiIGZpbGw9IiMwMDAwMDAiID48cGF0aCBkPSJNMjUuMDc0IDIxLjM3NXYtOC41NjhjMC00LjQ2Mi0zLjIzLTguMTYyLTcuNDc0LTguOTE1di0uNjhjMC0uNTktLjQ3OC0xLjA2Ny0xLjA2Ni0xLjA2N2gtMS4wNjZjLS41OSAwLTEuMDY2LjQ3Ny0xLjA2NiAxLjA2NnYuNjg1Yy00LjIzNy43Ni03LjQ1MyA0LjQ1OC03LjQ1MyA4LjkxMnY4LjU2OGwtMy43NDMgMy4wM3YxLjcyOGgyNS41OXYtMS43M2wtMy43Mi0zLjAyOHptMi42NTUgMy42OUg0LjI3di0uMTUzbDMuNzQyLTMuMDN2LTkuMDc2YzAtNC40MSAzLjU4Ny03Ljk5NyA3Ljk5Ny03Ljk5N3M3Ljk5OCAzLjU4NiA3Ljk5OCA3Ljk5NnY5LjA3NWwzLjcyIDMuMDN2LjE1NXpNMTYgMjkuODU2YzEuNDcyIDAgMi42NjgtMS4xOTIgMi42NjgtMi42NjZoLTUuMzM1YzAgMS40NzMgMS4xOTUgMi42NjYgMi42NjcgMi42NjZ6Ij48L3BhdGg+PC9zdmc+" width="50" height="20" />
		  </a>
		</amp-web-push-widget>
		<!-- An unsubscription widget -->
		<amp-web-push-widget visibility="subscribed" layout="fixed" width="30" height="30">
		   <a class="unsubscribe" on="tap:amp-web-push.unsubscribe">
		   	<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMzIgMzIiIGZpbGw9IiMwMDAwMDAiID48cGF0aCBkPSJNMjUuMDc0IDIxLjM3NXYtOC41NjhjMC00LjQ2Mi0zLjIzLTguMTYyLTcuNDc0LTguOTE1di0uNjhjMC0uNTktLjQ3OC0xLjA2Ny0xLjA2Ni0xLjA2N2gtMS4wNjZjLS41OSAwLTEuMDY2LjQ3Ny0xLjA2NiAxLjA2NnYuNjg1Yy00LjIzNy43Ni03LjQ1MyA0LjQ1OC03LjQ1MyA4LjkxMnY4LjU2OGwtMy43NDMgMy4wM3YxLjcyOGgyNS41OXYtMS43M2wtMy43Mi0zLjAyOHptMi42NTUgMy42OUg0LjI3di0uMTUzbDMuNzQyLTMuMDN2LTkuMDc2YzAtNC40MSAzLjU4Ny03Ljk5NyA3Ljk5Ny03Ljk5N3M3Ljk5OCAzLjU4NiA3Ljk5OCA3Ljk5NnY5LjA3NWwzLjcyIDMuMDN2LjE1NXpNMTYgMjkuODU2YzEuNDcyIDAgMi42NjgtMS4xOTIgMi42NjgtMi42NjZoLTUuMzM1YzAgMS40NzMgMS4xOTUgMi42NjYgMi42NjcgMi42NjZ6Ij48L3BhdGg+PC9zdmc+" width="50" height="20" />
		   </a>
		</amp-web-push-widget>
	</div>
<?php }

// Onesignal Sticky Widget
function ampforwp_onesignal_sticky(){ ?>
	<div class="amp-web-push-bell-cn amp-web-push-sticky">
		<amp-web-push-widget visibility="unsubscribed" layout="fixed" width="24" height="24">
		  <a class="subscribe awp-sticky" on="tap:amp-web-push.subscribe">
		  	<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMzIgMzIiIGZpbGw9IiMwMDAwMDAiID48cGF0aCBkPSJNMjUuMDc0IDIxLjM3NXYtOC41NjhjMC00LjQ2Mi0zLjIzLTguMTYyLTcuNDc0LTguOTE1di0uNjhjMC0uNTktLjQ3OC0xLjA2Ny0xLjA2Ni0xLjA2N2gtMS4wNjZjLS41OSAwLTEuMDY2LjQ3Ny0xLjA2NiAxLjA2NnYuNjg1Yy00LjIzNy43Ni03LjQ1MyA0LjQ1OC03LjQ1MyA4LjkxMnY4LjU2OGwtMy43NDMgMy4wM3YxLjcyOGgyNS41OXYtMS43M2wtMy43Mi0zLjAyOHptMi42NTUgMy42OUg0LjI3di0uMTUzbDMuNzQyLTMuMDN2LTkuMDc2YzAtNC40MSAzLjU4Ny03Ljk5NyA3Ljk5Ny03Ljk5N3M3Ljk5OCAzLjU4NiA3Ljk5OCA3Ljk5NnY5LjA3NWwzLjcyIDMuMDN2LjE1NXpNMTYgMjkuODU2YzEuNDcyIDAgMi42NjgtMS4xOTIgMi42NjgtMi42NjZoLTUuMzM1YzAgMS40NzMgMS4xOTUgMi42NjYgMi42NjcgMi42NjZ6Ij48L3BhdGg+PC9zdmc+" width="24" height="24" />
		  </a>
		</amp-web-push-widget>
		<!-- An unsubscription widget -->
		<amp-web-push-widget visibility="subscribed" layout="fixed" width="24" height="24">
		   <a class="unsubscribe" on="tap:amp-web-push.unsubscribe">
		   	<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMzIgMzIiIGZpbGw9IiMwMDAwMDAiID48cGF0aCBkPSJNMjUuMDc0IDIxLjM3NXYtOC41NjhjMC00LjQ2Mi0zLjIzLTguMTYyLTcuNDc0LTguOTE1di0uNjhjMC0uNTktLjQ3OC0xLjA2Ny0xLjA2Ni0xLjA2N2gtMS4wNjZjLS41OSAwLTEuMDY2LjQ3Ny0xLjA2NiAxLjA2NnYuNjg1Yy00LjIzNy43Ni03LjQ1MyA0LjQ1OC03LjQ1MyA4LjkxMnY4LjU2OGwtMy43NDMgMy4wM3YxLjcyOGgyNS41OXYtMS43M2wtMy43Mi0zLjAyOHptMi42NTUgMy42OUg0LjI3di0uMTUzbDMuNzQyLTMuMDN2LTkuMDc2YzAtNC40MSAzLjU4Ny03Ljk5NyA3Ljk5Ny03Ljk5N3M3Ljk5OCAzLjU4NiA3Ljk5OCA3Ljk5NnY5LjA3NWwzLjcyIDMuMDN2LjE1NXpNMTYgMjkuODU2YzEuNDcyIDAgMi42NjgtMS4xOTIgMi42NjgtMi42NjZoLTUuMzM1YzAgMS40NzMgMS4xOTUgMi42NjYgMi42NjcgMi42NjZ6Ij48L3BhdGg+PC9zdmc+" width="50" height="20" />
		   </a>
		</amp-web-push-widget>
	</div>
<?php }
add_action( 'ampforwp_body_beginning' , 'ampforwp_truepush_notifications');
function ampforwp_truepush_notifications(){
	$checker = false;
	if (!checkAMPforPageBuilderStatus(get_the_ID()) && is_single() ){
			$checker = true;
	}
	if('4' == ampforwp_get_setting('ampforwp-web-push') && $checker ){
		$app_id	= ampforwp_get_setting('ampforwp-truepush-app-id');
		$public_key = ampforwp_get_setting('ampforwp-truepush-public-key');
		$domain_path = AMPFORWP_PLUGIN_DIR_URI.'includes/truepush-integration/';
		$helper_iframe_url = $domain_path .'amp-web-push-helper-frame.html?appId=' . $app_id;
		$permission_dialog_url = $domain_path .'amp-web-push-permission-dialog.html?publicKey=' . $public_key;
		$service_worker_url = $domain_path .'sw.js';?>
	 <amp-web-push
	    id="amp-web-push"
	    layout="nodisplay"
	    helper-iframe-url="<?php echo esc_url_raw($helper_iframe_url); ?>"
	    permission-dialog-url="<?php echo esc_url_raw($permission_dialog_url); ?>"
	    service-worker-url="<?php echo esc_url($service_worker_url); ?>">
	 </amp-web-push>
	<?php }
}
add_action('amp_post_template_css' , 'ampforwp_truepush_styling');
function ampforwp_truepush_styling(){?>
	amp-web-push-widget button.amp-subscribe {
	  display: inline-flex;
	  align-items: center;
	  border-radius: 5px;
	  border: 0;
	  box-sizing: border-box;
	  margin: 0;
	  padding: 10px 15px;
	  cursor: pointer;
	  outline: none;
	  font-size: 15px;
	  font-weight: 500;
	  background: #4A90E2;
	  margin-top: 7px;
	  color: white;
	  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.5);
	  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	  }
<?php }
function ampforwp_truepush_markup(){
	if (!checkAMPforPageBuilderStatus(get_the_ID()) && is_single() && '4' == ampforwp_get_setting('ampforwp-web-push')) {?>
		<amp-web-push-widget visibility="unsubscribed" layout="fixed" width="250" height="45">
		<button on="tap:amp-web-push.subscribe" class="amp-subscribe"><?php echo ampforwp_translation( ampforwp_get_setting('ampforwp-truepush-translator-subscribe'), 'Subscribe to updates' ); ?></button>
		</amp-web-push-widget>
	<?php }
}
if(ampforwp_get_setting('ampforwp-web-push-truepush-below-content')){
	add_action('ampforwp_after_post_content', 'ampforwp_truepush_markup');
}

if(ampforwp_get_setting('ampforwp-web-push-truepush-above-content')){
	add_action('ampforwp_before_post_content', 'ampforwp_truepush_markup');
}