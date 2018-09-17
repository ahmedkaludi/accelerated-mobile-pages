<?php global $redux_builder_amp;
amp_header(); ?>
<div class="sp">
	<div <?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>class="cntr"<?php } ?>>
		<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
			<?php if ( true == $redux_builder_amp['ampforwp-bread-crumb'] ) {
				amp_breadcrumb();
			}?>
		 	<?php amp_title(); ?>
		<?php } ?>
		<?php if ( isset($redux_builder_amp['featured_image_swift_page']) && $redux_builder_amp['featured_image_swift_page'] && ampforwp_has_post_thumbnail() ) { ?>
			<div class="sf-img">
				<?php amp_featured_image();?>
			</div>
		<?php } ?>
       <div class="pg">
			<div class="cntn-wrp">
				<?php if( ampforwp_get_setting('gbl-sidebar') == '1' && ampforwp_is_front_page() ){ ?>				
					<div class="cntr pgb">
						<div class="pg-lft">
							<?php amp_content(); ?>
						</div>
						<?php if(isset($redux_builder_amp['gbl-sidebar']) && $redux_builder_amp['gbl-sidebar'] == '1'){ ?>
							<div class="sdbr-right"> <?php 
								ob_start();
								dynamic_sidebar('swift-sidebar');
								$swift_widget = ob_get_contents();
								ob_end_clean();
								$sanitizer_obj = new AMPFORWP_Content( 
									$swift_widget,
									array(), 
									apply_filters( 'ampforwp_content_sanitizers', 
										array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), 
										)
									) 
								);
								$sanitized_content =  $sanitizer_obj->get_amp_content();
					            echo $sanitized_content;?>
							</div>
						<?php } ?>
					</div><!-- /.cntr -->
				<?php } else { ?>
					<?php amp_content(); ?>
				<?php } ?>
			</div>
			<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ 
			if( is_page() && isset($redux_builder_amp['ampforwp-page-social']) && $redux_builder_amp['ampforwp-page-social'] ) { ?>
				<div class="ss-ic">
					<span class="shr-txt"><?php echo ampforwp_translation($redux_builder_amp['amp-translator-share-text'], 'Share' ); ?></span>
					<ul>
						<?php if($redux_builder_amp['enable-single-facebook-share']){?>
						<li>
							<a title="facebook share" class="s_fb" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-twitter-share']){?>
						<li>
							<a title="twitter share" class="s_tw" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo esc_attr(rawurlencode(get_the_title())); ?>">
							</a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-gplus-share']){?>
						<li>
							<a title="google plus share" class="s_gp" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-email-share']){?>
						<li>
							<a title="email" class="s_em" target="_blank" href="mailto:?subject=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&body=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-pinterest-share']){
							$image = '';
							if (ampforwp_has_post_thumbnail( ) ){
 								$image = ampforwp_get_post_thumbnail( 'url', 'full' );
 							}?>
						<li>
							<a title="pinterest share" class="s_pt" target="_blank" href="https://pinterest.com/pin/create/button/?media=<?php echo esc_url($image); ?>&url=<?php esc_url(the_permalink()); ?>&description=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-linkedin-share']){?>
						<li>
							<a title="linkedin share" class="s_lk" target="_blank" href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-whatsapp-share']){?>
						<li>
							<a title="whatsapp share" class="s_wp" target="_blank" href="whatsapp://send?text=<?php the_permalink(); ?>" data-action="share/whatsapp/share"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-vk-share']){?>
						<li>
							<a title="vkontakte share" class="s_vk" target="_blank" href="http://vk.com/share.php?url=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-odnoklassniki-share']){?>
						<li>
							<a title="odnoklassniki share" class="s_od" target="_blank" href="https://ok.ru/dk?st.cmd=addShare&st._surl=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-reddit-share']){?>
						<li>
							<a title="reddit share" class="s_rd" target="_blank" href="https://reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-tumblr-share']){?>
						<li>
							<a title="tumblr share" class="s_tb" target="_blank" href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-telegram-share']){?>
						<li>
							<a title="telegram share" class="s_tg" target="_blank" href="https://telegram.me/share/url?url=<?php the_permalink(); ?>&text=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-digg-share']){?>
						<li>
							<a title="digg share" class="s_dg" target="_blank" href="http://digg.com/submit?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-stumbleupon-share']){?>
						<li>
							<a title="stumbleupon share" class="s_su" target="_blank" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-wechat-share']){?>
						<li>
							<a title="wechat share" class="s_wc" target="_blank" href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if($redux_builder_amp['enable-single-viber-share']){?>
						<li>
							<a title="viber share" class="s_vb" target="_blank" href="viber://forward?text=<?php the_permalink(); ?>"></a>
						</li>
						<?php } ?>
						<?php if ( isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
						<li>
							<a title="yummly share" class="s_ym" target="_blank" href="http://www.yummly.com/urb/verify?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&yumtype=button"></a>
						</li>
						<?php } ?>
						<?php if ( isset($redux_builder_amp['enable-single-hatena-bookmarks']) && $redux_builder_amp['enable-single-hatena-bookmarks']){?>
						<li>
							<a title="hatena share" class="s_hb" target="_blank" href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
						</li>
						<?php } ?>
						<?php if ( isset($redux_builder_amp['enable-single-pocket-share']) && $redux_builder_amp['enable-single-pocket-share']){?>
						<li>
							<a title="pocket share" class="s_pk" target="_blank" href="https://getpocket.com/save?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"></a>
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
	        	<?php } ?>
			<div class="cmts">
				<?php amp_comments();?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php amp_footer()?>
