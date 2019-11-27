<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Loading the Components
// Big Post Image
add_image_size( 'amp-featured-large', 723, 394, true ); 
// Small Post Image
add_image_size( 'amp-featured-small', 346, 188, true );
//Single post leftside Image
add_image_size( 'amp-single-img', 220, 134, true );
//Search
add_amp_theme_support('AMP-search');
//Logo
add_amp_theme_support('AMP-logo');
//Social Icons
add_amp_theme_support('AMP-social-icons');
//Menu
add_amp_theme_support('AMP-menu');
add_amp_theme_support('AMP-alter-menu');
//Call Now
add_amp_theme_support('AMP-call-now');
//Breadcrumb
add_amp_theme_support('AMP-breadcrumb');
// Featured Image
add_amp_theme_support('AMP-featured-image');
//Author box
add_amp_theme_support('AMP-author-box');
//Loop
add_amp_theme_support('AMP-loop');
// Categories and Tags list
add_amp_theme_support('AMP-categories-tags');
// Comments
add_amp_theme_support('AMP-comments');
//Post Navigation
add_amp_theme_support('AMP-post-navigation');
// Related Posts
add_amp_theme_support('AMP-related-posts');
// Post Pagination
add_amp_theme_support('AMP-post-pagination');
// Icons example
add_amp_icon( array( 'widgets', 'search', 'shopping-cart' ) );

// Swift Social Icons
function ampforwp_swift_social_icons(){
	if(true == ampforwp_get_setting('ampforwp-social-share')){
	global $redux_builder_amp;
	$amp_permalink = $facebook_app_id = $amp_permalink_fb_messenger = '';
	$facebook_app_id = ampforwp_get_setting('amp-facebook-app-id-messenger');
	// Social share in AMP 
	if ( ampforwp_get_setting('ampforwp-social-share-amp')  ) {
		$amp_permalink = ampforwp_url_controller(get_the_permalink());
	} else{
		$amp_permalink = get_the_permalink();
	}
	if($facebook_app_id){
		$amp_permalink_fb_messenger = untrailingslashit($amp_permalink). '&app_id='. $facebook_app_id;
	}
	$twitter_amp_permalink = $amp_permalink;
	if(false == ampforwp_get_setting('enable-single-twitter-share-link')){
		$twitter_amp_permalink =  wp_get_shortlink();
	}
	?>
	<div class="ss-ic">
						<span class="shr-txt"><?php echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-share-text'], 'Share' )); ?></span>
						<ul>
							<?php if( true == ampforwp_get_setting('ampforwp-facebook-like-button')){?>
							<li>
							<?php if( ampforwp_is_non_amp() && true == ampforwp_get_setting('ampforwp-amp-convert-to-wp')) { ?>	
								<div class="fb-like" <?php ampforwp_nofollow_social_links(); ?>
    								data-href="<?php echo esc_url(get_the_permalink());?>" 
									data-layout="button_count" 
    								data-action="like" 
    								data-show-faces="true">
  								</div>
							<?php }
							else if(true == ampforwp_get_setting('ampforwp-facebook-like-button') && true == ampforwp_get_setting('ampforwp-facebook-like-data-action') ){
								$fblikewidth = ampforwp_get_setting('ampforwp-facebook-like-width');
								if(empty($fblikewidth)){
									$fblikewidth = "140";
								}
								?>
								<amp-facebook-like <?php echo "width=". esc_attr($fblikewidth) ."" ?> height=28
				 					layout="fixed"
				 					data-size="large"
				 					data-action="recommend"
				    				data-layout="button_count" <?php ampforwp_nofollow_social_links(); ?>
				    				data-href="<?php echo esc_url(get_the_permalink());?>">
								</amp-facebook-like>

							<?php }
							else { ?>
								<amp-facebook-like width=90 height=28
				 					layout="fixed"
				 					data-size="large"
				    				data-layout="button_count"
				    				<?php ampforwp_nofollow_social_links(); ?>
				    				data-href="<?php echo esc_url(get_the_permalink());?>">
								</amp-facebook-like>
							<?php } ?>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-facebook-share']){?>
							<li>
								<a class="s_fb" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://www.facebook.com/sharer.php?u=<?php echo esc_url($amp_permalink); ?>" aria-label="facebook share"></a>
							</li>
							<?php } ?>
							<?php if(ampforwp_get_setting('enable-single-facebook-share-messenger')){?>
							<li>
								<a title="facebook share messenger" class="s_fb_ms" target="_blank" href="fb-messenger://share/?link=<?php echo esc_url($amp_permalink_fb_messenger); ?>" aria-label="facebook share messenger"></a>
							</li>
							<?php } ?>
							<?php 
							$data_param = '';
							if(ampforwp_get_setting('enable-single-twitter-share')){
								$data_param_data = ampforwp_get_setting('enable-single-twitter-share-handle');
								$data_param = ( '' == $data_param_data ) ? '' : '&via='.$data_param_data.''; ?>
							<li>
								<a class="s_tw" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://twitter.com/intent/tweet?url=<?php echo esc_url($twitter_amp_permalink); ?>&text=<?php echo esc_attr(ampforwp_sanitize_twitter_title(get_the_title())); ?><?php echo esc_attr($data_param); ?>" aria-label="twitter share">
								</a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-email-share']){?>
							<li>
								<a class="s_em" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="mailto:?subject=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&body=<?php echo esc_url($amp_permalink); ?>" aria-label="email share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-pinterest-share']){
								$image = '';
								if (ampforwp_has_post_thumbnail( ) ){
	 								$image = ampforwp_get_post_thumbnail( 'url', 'full' );
	 							}?>
							<li>
								<a class="s_pt" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://pinterest.com/pin/create/button/?media=<?php echo esc_url($image); ?>&url=<?php esc_url(the_permalink()); ?>&description=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" aria-label="pinterest share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-linkedin-share']){?>
							<li>
								<a class="s_lk" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://www.linkedin.com/shareArticle?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" aria-label="linkedin share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-whatsapp-share']){?>
							<li>
								<a class="s_wp" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://api.whatsapp.com/send?text=<?php echo esc_url($amp_permalink); ?>" data-action="share/whatsapp/share" aria-label="whatsapp share"></a>
							</li>
							<?php } ?>
							<?php if(ampforwp_get_setting('enable-single-line-share') == true)  { 
							$line_share = 'http://line.me/R/msg/text/';
							$line_amp_permalink = add_query_arg($amp_permalink,'', $line_share );	
							?>
			<li>
			<a title="line share" class="s_li" <?php ampforwp_nofollow_social_links(); ?> href="<?php echo esc_url($line_amp_permalink); ?>" aria-label="line share">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="15" height="15" />

			</a>
		</li>
		<?php } ?>
							<?php if($redux_builder_amp['enable-single-vk-share']){?>
							<li>
								<a class="s_vk" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="http://vk.com/share.php?url=<?php echo esc_url($amp_permalink); ?>" aria-label="vk share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-odnoklassniki-share']){?>
							<li>
								<a class="s_od" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://ok.ru/dk?st.cmd=addShare&st._surl=<?php echo esc_url($amp_permalink); ?>" aria-label="odnoklassniki share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-reddit-share']){?>
							<li>
								<a class="s_rd" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://reddit.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" aria-label="reddit share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-tumblr-share']){?>
							<li>
								<a class="s_tb" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url($amp_permalink); ?>" aria-label="tumbler share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-telegram-share']){?>
							<li>
								<a class="s_tg" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://telegram.me/share/url?url=<?php echo esc_url($amp_permalink); ?>&text=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" aria-label="telegram share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-stumbleupon-share']){?>
							<li>
								<a class="s_su" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" aria-label="stumbleupon share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-wechat-share']){?>
							<li>
								<a class="s_wc" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url=<?php echo esc_url($amp_permalink); ?>" aria-label="wechat share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-viber-share']){?>
							<li>
								<a class="s_vb" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="viber://forward?text=<?php echo esc_url($amp_permalink); ?>" aria-label="viber share"></a>
							</li>
							<?php } ?>
							<?php if ( isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
							<li>
								<a class="s_ym" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="http://www.yummly.com/urb/verify?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&yumtype=button" aria-label="yummly share"></a>
							</li>
							<?php } ?>
							<?php if ( isset($redux_builder_amp['enable-single-hatena-bookmarks']) && $redux_builder_amp['enable-single-hatena-bookmarks']){?>
							<li>
								<a class="s_hb" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="http://b.hatena.ne.jp/entry/<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" aria-label="hatena share"></a>
							</li>
							<?php } ?>
							<?php if ( isset($redux_builder_amp['enable-single-pocket-share']) && $redux_builder_amp['enable-single-pocket-share']){?>
							<li>
								<a class="s_pk" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://getpocket.com/save?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>" aria-label="pocket share"></a>
							</li>
							<?php } ?>
							<?php if ( true == ampforwp_get_setting('enable-single-mewe-share')){?>
							<li>
								<a title="mewe share" class="s_mewe" target="_blank" <?php ampforwp_nofollow_social_links(); ?> href="https://mewe.com/share?link=<?php echo esc_url($amp_permalink); ?>" aria-label="mewe share">
								<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/favicon-mewe.svg') ?>" width="15" height="15" /></a>
							</li>
							<?php } ?>	
							<?php if ( true == ampforwp_get_setting('enable-single-flipboard-share') ) { ?>
								<li>
									<a title="flipboard share" class="s_flipboard" <?php ampforwp_nofollow_social_links(); ?> href="https://share.flipboard.com/bookmarklet/popout?v=<?php echo esc_html(get_the_title(ampforwp_get_the_ID())); ?>&url=<?php echo urlencode(esc_url($amp_permalink)); ?>" target="_blank" aria-label="flipboard share">
										<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/flipboard.png') ?>" width="15" height="15" />
									</a>
								</li>
							<?php } ?>
						</ul>
		            </div>
<?php } }
// Remove default sticky social from Swift
remove_action('amp_post_template_footer','ampforwp_sticky_social_icons');
remove_action('amp_post_template_css','amp_social_styles',11);
//Twitter title #2744
function ampforwp_sanitize_twitter_title($post_title){
	$post_title = html_entity_decode( $post_title, ENT_QUOTES, 'UTF-8' );
    $post_title = rawurlencode( $post_title );
    $post_title = esc_html( $post_title );
    return $post_title;
}