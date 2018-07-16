<?php 
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
	global $redux_builder_amp; ?>
	<div class="ss-ic">
						<span class="shr-txt"><?php echo ampforwp_translation($redux_builder_amp['amp-translator-share-text'], 'Share' ); ?></span>
						<ul>
							<?php if($redux_builder_amp['enable-single-facebook-share']){?>
							<li>
								<a class="s_fb" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-twitter-share']){?>
							<li>
								<a class="s_tw" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo esc_attr(rawurlencode(get_the_title())); ?>">
								</a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-gplus-share']){?>
							<li>
								<a class="s_gp" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-email-share']){?>
							<li>
								<a class="s_em" target="_blank" href="mailto:?subject=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&body=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-pinterest-share']){
								$image = '';
								if (ampforwp_has_post_thumbnail( ) ){
	 								$image = ampforwp_get_post_thumbnail( 'url', 'full' );
	 							}?>
							<li>
								<a class="s_pt" target="_blank" href="https://pinterest.com/pin/create/button/?media=<?php echo esc_url($image); ?>&url=<?php esc_url(the_permalink()); ?>&description=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-linkedin-share']){?>
							<li>
								<a class="s_lk" target="_blank" href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-whatsapp-share']){?>
							<li>
								<a class="s_wp" target="_blank" href="whatsapp://send?text=<?php the_permalink(); ?>" data-action="share/whatsapp/share"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-vk-share']){?>
							<li>
								<a class="s_vk" target="_blank" href="http://vk.com/share.php?url=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-odnoklassniki-share']){?>
							<li>
								<a class="s_od" target="_blank" href="https://ok.ru/dk?st.cmd=addShare&st._surl=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-reddit-share']){?>
							<li>
								<a class="s_rd" target="_blank" href="https://reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-tumblr-share']){?>
							<li>
								<a class="s_tb" target="_blank" href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-telegram-share']){?>
							<li>
								<a class="s_tg" target="_blank" href="https://telegram.me/share/url?url=<?php the_permalink(); ?>&text=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-digg-share']){?>
							<li>
								<a class="s_dg" target="_blank" href="http://digg.com/submit?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-stumbleupon-share']){?>
							<li>
								<a class="s_su" target="_blank" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-wechat-share']){?>
							<li>
								<a class="s_wc" target="_blank" href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['enable-single-viber-share']){?>
							<li>
								<a class="s_vb" target="_blank" href="viber://forward?text=<?php the_permalink(); ?>"></a>
							</li>
							<?php } ?>
							<?php if ( isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
							<li>
								<a class="s_ym" target="_blank" href="http://www.yummly.com/urb/verify?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&yumtype=button"></a>
							</li>
							<?php } ?>
							<?php if ( isset($redux_builder_amp['enable-single-hatena-bookmarks']) && $redux_builder_amp['enable-single-hatena-bookmarks']){?>
							<li>
								<a class="s_hb" target="_blank" href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if ( isset($redux_builder_amp['enable-single-pocket-share']) && $redux_builder_amp['enable-single-pocket-share']){?>
							<li>
								<a class="s_pk" target="_blank" href="https://getpocket.com/save?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
							</li>
							<?php } ?>
							<?php if($redux_builder_amp['ampforwp-facebook-like-button']){?>
							<li>
							<?php if( ampforwp_is_non_amp() && isset($redux_builder_amp['ampforwp-amp-convert-to-wp']) && $redux_builder_amp['ampforwp-amp-convert-to-wp']) { ?>	
								<div class="fb-like" 
    								data-href="<?php echo esc_url(get_the_permalink());?>" 
									data-layout="button_count" 
    								data-action="like" 
    								data-show-faces="true">
  								</div>
							<?php }
							else { ?>
								<amp-facebook-like width=90 height=28
				 					layout="fixed"
				 					data-size="large"
				    				data-layout="button_count"
				    				data-href="<?php echo esc_url(get_the_permalink());?>">
								</amp-facebook-like>
							<?php } ?>
							</li>
							<?php } ?>

						</ul>
		            </div>
<?php }
// Remove default sticky social from Swift
remove_action('amp_post_template_footer','ampforwp_sticky_social_icons');
remove_action('amp_post_template_css','amp_social_styles',11);
