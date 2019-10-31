<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
add_filter("ampforwp_extension_pagebuilder_module_template", 'socialmod', 10, 3);
function socialmod($moduleFrontHtml, $htmlTemplate, $contentArray){
	$amp_permalink ='';
	$current_title = '';
	if ( ampforwp_get_setting('ampforwp-social-share-amp')  ) {
		$amp_permalink = ampforwp_url_controller(get_the_permalink());
	} else{
		$amp_permalink = get_the_permalink();
	}
	$image = '';
	if (ampforwp_has_post_thumbnail( ) ){
		$image = ampforwp_get_post_thumbnail( 'url', 'full' );
	}
	$current_title = get_the_title();
	$moduleFrontHtml = str_replace('{{current_permalink}}', $amp_permalink, $moduleFrontHtml);
	$moduleFrontHtml = str_replace('{{current_title}}', $current_title, $moduleFrontHtml);
	$moduleFrontHtml = str_replace('{{image}}', $image, $moduleFrontHtml);
	// Twitter query_arg
	$twitter_share_url = 'https://twitter.com/intent/tweet';
	$twitter_share_url = add_query_arg('url',get_the_permalink(), $twitter_share_url) ;
	$twitter_share_url = add_query_arg('text', ampforwp_sanitize_twitter_title(get_the_title()), $twitter_share_url) ;
	$moduleFrontHtml = str_replace('{{twitter_permalink}}', $twitter_share_url, $moduleFrontHtml);
	$facebook_mesger ='fb-messenger://share/?link='.untrailingslashit($amp_permalink);
	$moduleFrontHtml = str_replace('{{facebook_messenger}}', $facebook_mesger, $moduleFrontHtml);
	return $moduleFrontHtml;
}
$line_share = 'http://line.me/R/msg/text/';
$line_amp_permalink = add_query_arg($amp_permalink,'', $line_share );


$output = '
	 <div {{if_id}}id="{{id}}"{{ifend_id}} class="{{user_class}}">
	 	<div class="social-icons">
	 		<ul>
	 			{{if_condition_fb-like-enable==1}}
	 			<li class="fb-lk">
	 				<amp-facebook-like width=90 height=28
	 					layout="fixed"
	 					data-size="large"
	    				data-layout="button_count"
	    				data-href="{{current_permalink}}">
					</amp-facebook-like>
	 			</li>
	 			{{ifend_condition_fb-like-enable_1}}
	 			{{if_condition_fb-enable==1}}
	 			<li>
					<a class="sm_fb" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://www.facebook.com/sharer.php?u={{current_permalink}}" aria-label="facebook share"></a>
				</li>
				{{ifend_condition_fb-enable_1}}
				{{if_condition_fb-messanger-enable==1}}
	 			<li>
					<a title="facebook share messenger" class="sm_fb_ms" target="_blank" href="{{facebook_messenger}}{{if_sm-fb-app-id}}&app_id={{sm-fb-app-id}}{{ifend_sm-fb-app-id}}" aria-label="facebook share messenger"><amp-img src="'.esc_url(AMPFORWP_IMAGE_DIR . '/messenger.png').'" width="20" height="20" /></amp-img>
					</a>
				</li>
				{{ifend_condition_fb-messanger-enable_1}}
				{{if_condition_tw-enable==1}}
	 			<li>
					<a class="sm_tw" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="{{twitter_permalink}}"  aria-label="twitter share"></a>
				</li>
				{{ifend_condition_tw-enable_1}}
				{{if_condition_em-enable==1}}
	 			<li>
					<a class="sm_em" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="mailto:?subject={{current_title}}&body={{current_permalink}}" aria-label="email share"></a>
				</li>
				{{ifend_condition_em-enable_1}}
				{{if_condition_pin-enable==1}}
	 			<li>
					<a class="sm_pt" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://pinterest.com/pin/create/button/?media={{image}}&url={{current_permalink}}&description={{current_title}}" aria-label="pinterest share"></a>
				</li>
				{{ifend_condition_pin-enable_1}}
				{{if_condition_lnk-enable==1}}
	 			<li>
					<a class="sm_lk" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://www.linkedin.com/shareArticle?url={{current_permalink}}&title={{current_title}}" aria-label="linkedin share"></a>
				</li>
				{{ifend_condition_lnk-enable_1}}
				{{if_condition_wap-enable==1}}
	 			<li>
					<a class="sm_wp" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}}  href="https://api.whatsapp.com/send?text={{current_permalink}}" data-action="share/whatsapp/share" aria-label="whatsapp share"></a>
				</li>
				{{ifend_condition_wap-enable_1}}
				{{if_condition_line-enable==1}}
	 			<li>
					<a title="line share" class="sm_li" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="'.esc_url_raw($line_amp_permalink).'{{current_permalink}}" aria-label="line share">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="15" height="15" />
					</a>
				</li>
				{{ifend_condition_line-enable_1}}
				{{if_condition_vk-enable==1}}
	 			<li>
					<a class="sm_vk" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="http://vk.com/share.php?url={{current_permalink}}" aria-label="vk share"></a>
				</li>
				{{ifend_condition_vk-enable_1}}
				{{if_condition_od-enable==1}}
	 			<li>
					<a class="sm_od" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}}  href="https://ok.ru/dk?st.cmd=addShare&st._surl={{current_permalink}}" aria-label="odnoklassniki share"></a>
				</li>
				{{ifend_condition_od-enable_1}}
				{{if_condition_rd-enable==1}}
	 			<li>
					<a class="sm_rd" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://reddit.com/submit?url={{current_permalink}}&title={{current_title}}" aria-label="reddit share"></a>
				</li>
				{{ifend_condition_rd-enable_1}}
				{{if_condition_tmb-enable==1}}
	 			<li>
					<a class="sm_tb" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://www.tumblr.com/widgets/share/tool?canonicalUrl={{current_permalink}}" aria-label="tumbler share"></a>
				</li>
				{{ifend_condition_tmb-enable_1}}
				{{if_condition_tg-enable==1}}
	 			<li>
					<a class="sm_tg" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://telegram.me/share/url?url={{current_permalink}}&text={{current_title}}" aria-label="telegram share"></a>
				</li>
				{{ifend_condition_tg-enable_1}}
				{{if_condition_stu-enable==1}}
	 			<li>
					<a class="sm_su" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="http://www.stumbleupon.com/submit?url={{current_permalink}}&title={{current_title}}" aria-label="stumbleupon share"></a>
				</li>
				{{ifend_condition_stu-enable_1}}
				{{if_condition_wc-enable==1}}
	 			<li>
					<a class="sm_wc" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url={{current_permalink}}" aria-label="wechat share"></a>
				</li>
				{{ifend_condition_wc-enable_1}}
				{{if_condition_vb-enable==1}}
	 			<li>
					<a class="sm_vb" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="viber://forward?text={{current_permalink}}" aria-label="viber share"></a>
				</li>
				{{ifend_condition_vb-enable_1}}
				{{if_condition_htb-enable==1}}
	 			<li>
					<a class="sm_hb" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="http://b.hatena.ne.jp/entry/{{current_permalink}}&title={{current_title}}" aria-label="hatena share"></a>
				</li>
				{{ifend_condition_htb-enable_1}}
				{{if_condition_pkt-enable==1}}
	 			<li>
					<a class="sm_pk" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://getpocket.com/save?url={{current_permalink}}&title={{current_title}}" aria-label="pocket share"></a>
				</li>
				{{ifend_condition_pkt-enable_1}}
				{{if_condition_yml-enable==1}}
	 			<li class="ymly">
					<a class="sm_ym" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="http://www.yummly.com/urb/verify?url=<{{current_permalink}}&title={{current_title}}&yumtype=button" aria-label="yummly share"><amp-img src="'.esc_url(AMPFORWP_IMAGE_DIR . '/yum.png').'" width="20" height="20" /></amp-img></a></a>
				</li>
				{{ifend_condition_yml-enable_1}}
				{{if_condition_mw-enable==1}}
	 			<li>
					<a title="mewe share" class="sm_mewe" target="_blank" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://mewe.com/share?link={{current_permalink}}" aria-label="mewe share"><amp-img src="'.esc_url(AMPFORWP_IMAGE_DIR . '/favicon-mewe.svg').'" width="15" height="15" /></amp-img></a>
				</li>
				{{ifend_condition_mw-enable_1}}
				{{if_condition_flb-enable==1}}
	 			<li>
					<a title="flipboard share" class="sm_flipboard" {{if_condition_nofollow-enable==1}}rel=nofollow{{ifend_condition_nofollow-enable_1}} href="https://share.flipboard.com/bookmarklet/popout?v={{current_title}}&url={{current_permalink}}" target="_blank" aria-label="flipboard share">
					<amp-img src="'.esc_url(AMPFORWP_IMAGE_DIR . '/flipboard.png').'" width="15" height="15" /></amp-img>
					</a>
				</li>
				{{ifend_condition_flb-enable_1}}
	 		</ul>
	 	</div>
	 </div>
';
$swift_icon = "";
$font_awesome = "";
$ampforwp_font_icon = ampforwp_get_setting('ampforwp_font_icon');
if ( empty($ampforwp_font_icon) ) {
	$ampforwp_font_icon = 'swift-icons';
}
if ( $ampforwp_font_icon == 'swift-icons' ){ 
	$swift_icon = '
	.social-icons li{font-family: "icomoon";}
	{{if_condition_fb-enable==1}}
		.sm_fb:after {content: "\e92d";}
	{{ifend_condition_fb-enable_1}}
	{{if_condition_tw-enable==1}}
		.sm_tw:after{content: "\e942";}
	{{ifend_condition_tw-enable_1}}
	{{if_condition_em-enable==1}}
		.sm_em:after{content: "\e930";}
	{{ifend_condition_em-enable_1}}
	{{if_condition_pin-enable==1}}
		.sm_pt:after{content: "\e937";}
	{{ifend_condition_pin-enable_1}}
	{{if_condition_lnk-enable==1}}
		.sm_lk:after{content: "\e934";}
	{{ifend_condition_lnk-enable_1}}
	{{if_condition_wap-enable==1}}
		.sm_wp:after{content: "\e946";}
	{{ifend_condition_wap-enable_1}}
	{{if_condition_vk-enable==1}}
		.sm_vk:after{content: "\e944";}
	{{ifend_condition_vk-enable_1}}
	{{if_condition_od-enable==1}}
		.sm_od:after{content: "\e936";}
	{{ifend_condition_od-enable_1}}
	{{if_condition_rd-enable==1}}
		.sm_rd:after{content: "\e938";}
	{{ifend_condition_rd-enable_1}}
	{{if_condition_tmb-enable==1}}
		.sm_tb:after{content: "\e940";}
	{{ifend_condition_tmb-enable_1}}
	{{if_condition_tg-enable==1}}
		.sm_tg:after{content: "\e93f";}
	{{ifend_condition_tg-enable_1}}
	{{if_condition_stu-enable==1}}
		.sm_su:after{content: "\e93e";}
	{{ifend_condition_stu-enable_1}}
	{{if_condition_wc-enable==1}}
		.sm_wc:after{content: "\e945";}
	{{ifend_condition_wc-enable_1}}
	{{if_condition_vb-enable==1}}
		.sm_vb:after{content: "\e943";}
	{{ifend_condition_vb-enable_1}}
	{{if_condition_htb-enable==1}}
		.sm_hb:after{content: "\e948";}
	{{ifend_condition_htb-enable_1}}
	{{if_condition_pkt-enable==1}}
		.sm_pk:after{content: "\e949";}
	{{ifend_condition_pkt-enable_1}}
	{{module-class}} .social-icons li.ymly a{
		padding:8.5px;
	}
	';
}
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ 
	$font_awesome = '
	.social-icons li{font-family: "Font Awesome 5 Brands";}
	{{if_condition_fb-enable==1}}
		.sm_fb:after {content: "\f09a";}
	{{ifend_condition_fb-enable_1}}
	{{if_condition_tw-enable==1}}
		.sm_tw:after{content: "\f099";}
	{{ifend_condition_tw-enable_1}}
	{{if_condition_em-enable==1}}
		.sm_em:after{content: "\f0e0";font-family: "Font Awesome 5 Free";}
	{{ifend_condition_em-enable_1}}
	{{if_condition_pin-enable==1}}
		.sm_pt:after{content: "\f0d2";}
	{{ifend_condition_pin-enable_1}}
	{{if_condition_lnk-enable==1}}
		.sm_lk:after{content: "\f08c";}
	{{ifend_condition_lnk-enable_1}}
	{{if_condition_wap-enable==1}}
		.sm_wp:after{content: "\f232";}
	{{ifend_condition_wap-enable_1}}
	{{if_condition_vk-enable==1}}
		.sm_vk:after{
			content:"";
			display:inline-block;
			background-image:url("'. AMPFORWP_IMAGE_DIR . '/vk-img.png'.'");
			width:16px;
			height:16px;
		}
	{{ifend_condition_vk-enable_1}}
	{{if_condition_od-enable==1}}
		.sm_od:after{content: "\f263";}
	{{ifend_condition_od-enable_1}}
	{{if_condition_rd-enable==1}}
		.sm_rd:after{content: "\f281";}
	{{ifend_condition_rd-enable_1}}
	{{if_condition_tmb-enable==1}}
		.sm_tb:after{content: "\f173";}
	{{ifend_condition_tmb-enable_1}}
	{{if_condition_tg-enable==1}}
		.sm_tg:after{content: "\f3fe";}
	{{ifend_condition_tg-enable_1}}
	{{if_condition_stu-enable==1}}
		.sm_su:after{content: "\f1a3";}
	{{ifend_condition_stu-enable_1}}
	{{if_condition_wc-enable==1}}
		.sm_wc:after{content: "\f1d7";}
	{{ifend_condition_wc-enable_1}}
	{{if_condition_vb-enable==1}}
		.sm_vb:after{content: "\f409";}
	{{ifend_condition_vb-enable_1}}
	{{if_condition_htb-enable==1}}
		.sm_hb:after{
			content:"";
			display:inline-block;
			background-image:url("'. AMPFORWP_IMAGE_DIR . '/hatena-img.png'.'");
			width:16px;
			height:16px;
		}
	{{ifend_condition_htb-enable_1}}
	{{if_condition_pkt-enable==1}}
		.sm_pk:after{content: "\f265";}
	{{ifend_condition_pkt-enable_1}}
	{{module-class}} .social-icons li.ymly a{
		padding:8px;
	}
	';
}	
$css = '
{{module-class}} .social-icons ul {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
}
{{module-class}} .social-icons ul li{
	list-style: none;
    flex-direction: row;
    flex: 1 1 auto;
    margin: 0px 15px 10px 0px;
}
{{module-class}} .social-icons ul li:last-child{
	margin-right:0;
}
{{module-class}} .social-icons li a{
	padding:10px;
	text-align:center;
	color:#fff;
	line-height:1;
	display:block;
}
{{module-class}} .social-icons li a:after{
	font-size:18px;
}
{{if_condition_fb-like-enable==1}}
.fb-lk{
	margin:0 auto
}
{{ifend_condition_fb-like-enable_1}}
{{if_condition_fb-enable==1}}
	a.sm_fb{background:#3b5998;}
{{ifend_condition_fb-enable_1}}
{{if_condition_tw-enable==1}}
	a.sm_tw{background:#1da1f2;}
{{ifend_condition_tw-enable_1}}
{{if_condition_fb-messanger-enable==1}}
	a.sm_fb_ms{background:#f1f1f1;}
{{ifend_condition_fb-messanger-enable_1}}
{{if_condition_em-enable==1}}
	a.sm_em{background:#b7b7b7;}
{{ifend_condition_em-enable_1}}
{{if_condition_pin-enable==1}}
	a.sm_pt{background:#bd081c;}
{{ifend_condition_pin-enable_1}}
{{if_condition_lnk-enable==1}}
	a.sm_lk{background:#0077b5;}
{{ifend_condition_lnk-enable_1}}
{{if_condition_wap-enable==1}}
	a.sm_wp{background:#075e54;}
{{ifend_condition_wap-enable_1}}
{{if_condition_line-enable==1}}
	a.sm_li{background:#00cc00;}
{{ifend_condition_line-enable_1}}
{{if_condition_vk-enable==1}}
	a.sm_vk{background:#45668e;}
{{ifend_condition_vk-enable_1}}
{{if_condition_od-enable==1}}
	a.sm_od{background:#ed812b;}
{{ifend_condition_od-enable_1}}
{{if_condition_rd-enable==1}}
	a.sm_rd{background:#ff4500;}
{{ifend_condition_rd-enable_1}}
{{if_condition_tmb-enable==1}}
	a.sm_tb{background:#35465c;}
{{ifend_condition_tmb-enable_1}}
{{if_condition_tg-enable==1}}
	a.sm_tg{background:#0088cc;}
{{ifend_condition_tg-enable_1}}
{{if_condition_stu-enable==1}}
	a.sm_su{background:#eb4924;}
{{ifend_condition_stu-enable_1}}
{{if_condition_wc-enable==1}}
	a.sm_wc{background:#7bb32e;}
{{ifend_condition_wc-enable_1}}
{{if_condition_vb-enable==1}}
	a.sm_vb{background:#59267c;}
{{ifend_condition_vb-enable_1}}
{{if_condition_htb-enable==1}}
	a.sm_hb{background:#00a4de;}
{{ifend_condition_htb-enable_1}}
{{if_condition_pkt-enable==1}}
	a.sm_pk{background:#ef3f56;}
{{ifend_condition_pkt-enable_1}}
{{if_condition_yml-enable==1}}
	a.sm_ym{background:#e361098c;}
{{ifend_condition_yml-enable_1}}
{{if_condition_mw-enable==1}}
	a.sm_mewe{background:#b8d6e6;}
{{ifend_condition_mw-enable_1}}
{{if_condition_flb-enable==1}}
	a.sm_flipboard{background:#f52828;}
{{ifend_condition_flb-enable_1}}

';
$css = $css . $swift_icon . $font_awesome.'


';
return array(
		'label' =>'Social Share',
		'name' =>'social-share',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"fb-like-enable",
			                'label'   => 'Facebook Like Button',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"fb-enable",
			                'label'   => 'Facebook',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"fb-messanger-enable",
			                'label'   => 'Facebook Messenger',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(    
				                'type'    =>'text',    
				                'name'    =>"sm-fb-app-id",    
				                'label'   =>'Facebook App ID',
				                'tab'     =>'customizer',
				                'default' =>'', 
				                'content_type'=>'html',
				                'required'  => array('fb-messanger-enable'=>'1')
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"tw-enable",
			                'label'   => 'Twitter',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"em-enable",
			                'label'   => 'Email',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"pin-enable",
			                'label'   => 'Pinterest',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"lnk-enable",
			                'label'   => 'LinkedIn',
			                'tab'   =>'customizer',
			                'default' =>1,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"wap-enable",
			                'label'   => 'WhatsApp',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"line-enable",
			                'label'   => 'Line',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"vk-enable",
			                'label'   => 'VKontakte',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"od-enable",
			                'label'   => 'Odnoklassniki',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"rd-enable",
			                'label'   => 'Reddit',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"tmb-enable",
			                'label'   => 'Tumblr',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"tg-enable",
			                'label'   => 'Telegram',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"stu-enable",
			                'label'   => 'StumbleUpon',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"wc-enable",
			                'label'   => 'Wechat',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"vb-enable",
			                'label'   => 'Viber',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"htb-enable",
			                'label'   => 'Hatena Bookmarks',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"pkt-enable",
			                'label'   => 'Pocket',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"yml-enable",
			                'label'   => 'Yummly',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"mw-enable",
			                'label'   => 'MeWe',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"flb-enable",
			                'label'   => 'Flipboard',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
						array(
			                'type'    =>'checkbox_bool',
			                'name'    =>"nofollow-enable",
			                'label'   => 'No Follow All Your Social Links',
			                'tab'   =>'customizer',
			                'default' =>0,
			                'options' =>array(
			                        array(
			                          'label'=>'Yes',
			                          'value'=>1,
			                        )
			                      ),
			                'content_type'=>'html',
			              ),
	 					array(
								'type'		=>'text',
								'name'		=>"max-width",
								'label'		=>'Max Width',
								'tab'		=>'design',
								'default'	=>'100%',
								'content_type'=>'css'
							),
						array(
								'type'		=>'text',
								'name'		=>"id",
								'label'		=>'ID',
								'tab'		=>'advanced',
								'default'	=>'',
								'content_type'=>'html'
							),
						array(
								'type'		=>'text',
								'name'		=>"user_class",
								'label'		=>'Class',
								'tab'		=>'advanced',
								'default'	=>'',
								'content_type'=>'html'
							),	
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'0px',
                                'bottom'=>'20px',
                                'left'=>'0px',
                            ),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'0px',
													'right'=>'0px',
													'top'=>'0px',
													'bottom'=>'0px'
												),
								'content_type'=>'css',
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);