<?php

// 94. OneSignal Push Notifications
add_action( 'ampforwp_body_beginning' , 'ampforwp_onesignal_notifications' , 11 );
if( ! function_exists( ' ampforwp_onesignal_notifications ' ) ){
	function ampforwp_onesignal_notifications(){ 
	global $redux_builder_amp;
	if(isset($redux_builder_amp['ampforwp-web-push-onesignal']) && $redux_builder_amp['ampforwp-web-push-onesignal'] && !checkAMPforPageBuilderStatus(get_the_ID()) && (ampforwp_is_front_page() || is_singular()) ){
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
if(is_plugin_active('amp/amp.php')){
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


if( ! function_exists(' ampforwp_onesignal_notifications_widget') ){
	function ampforwp_onesignal_notifications_widget(){
	global $redux_builder_amp;
	if(isset($redux_builder_amp['ampforwp-web-push-onesignal']) && $redux_builder_amp['ampforwp-web-push-onesignal'] && !checkAMPforPageBuilderStatus(get_the_ID()) ){ ?>
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
		    <?php echo ampforwp_translation( $redux_builder_amp['ampforwp-onesignal-translator-subscribe'], 'Subscribe to updates' ); ?>
		  </button>
		</amp-web-push-widget>
		<!-- An unsubscription widget -->
		<amp-web-push-widget visibility="subscribed" layout="fixed" width="230" height="45">
		   <button class="unsubscribe" on="tap:amp-web-push.unsubscribe">
		   	<?php echo ampforwp_translation( $redux_builder_amp['ampforwp-onesignal-translator-unsubscribe'], 'Unsubscribe from updates' ); ?>
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
	if(isset($redux_builder_amp['ampforwp-web-push-onesignal']) && $redux_builder_amp['ampforwp-web-push-onesignal'] && !checkAMPforPageBuilderStatus(get_the_ID()) && ( ampforwp_is_front_page() || is_singular()) ){
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
	global $redux_builder_amp;
	if(isset($redux_builder_amp['ampforwp-web-push-onesignal']) && $redux_builder_amp['ampforwp-web-push-onesignal'] && !checkAMPforPageBuilderStatus(get_the_ID()) && ( ampforwp_is_front_page() || is_singular()) ){ ?>
    amp-web-push-widget button.subscribe { display: inline-flex; align-items: center; border-radius: 2px; border: 0; box-sizing: border-box; margin: 0; padding: 10px 15px; cursor: pointer; outline: none; font-size: 15px; font-weight: 400; background: #4A90E2; color: white; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.5); -webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
    amp-web-push-widget button.subscribe .subscribe-icon {margin-right: 10px;}
    amp-web-push-widget button.subscribe:active {transform: scale(0.99);}
    amp-web-push-widget button.unsubscribe {display: inline-flex; align-items: center; justify-content: center; height: 45px; border: 0; margin: 0; cursor: pointer; outline: none; font-size: 15px; font-weight: 400; background: #4a90e2; color: #fff; -webkit-tap-highlight-color: rgba(0,0,0,0); box-sizing: border-box; padding: 10px 15px;}
    amp-web-push-widget.amp-invisible{ display:none;}
    .amp-web-push-container{width: 245px; margin:0 auto}
<?php }
	}	
}