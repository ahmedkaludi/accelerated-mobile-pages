</div>
<?php global $redux_builder_amp ?>
<?php if ( isset($redux_builder_amp['footer-type']) && '1' == $redux_builder_amp['footer-type'] ) { ?>
<footer class="footer">
	<?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
	<div class="f-w-f1">
		<div class="cntr">
			<div class="f-w">
				<?php 
				ob_start();
				dynamic_sidebar('swift-footer-widget-area');
				$swift_footer_widget = ob_get_contents();
				ob_end_clean();
				$sanitizer_obj = new AMPFORWP_Content( 
									$swift_footer_widget,
									array(), 
									apply_filters( 'ampforwp_content_sanitizers', 
										array( 'AMP_Img_Sanitizer' => array(), 
											'AMP_Blacklist_Sanitizer' => array(),
											'AMP_Style_Sanitizer' => array(), 
											'AMP_Video_Sanitizer' => array(),
					 						'AMP_Audio_Sanitizer' => array(),
					 						'AMP_Iframe_Sanitizer' => array(
												 'add_placeholder' => true,
											 ),
										) 
									) 
								);
				 $sanitized_footer_widget =  $sanitizer_obj->get_amp_content();
	              echo $sanitized_footer_widget;
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="f-w-f2">
		<div class="cntr">
			<?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
			<div class="f-menu">
				<nav itemscope="" itemtype="https://schema.org/SiteNavigationElement">
	              <?php
	              $menu = wp_nav_menu( array(
	                  'theme_location' => 'amp-footer-menu',
	                  'link_before'     => '<span itemprop="name">',
	                  'link_after'     => '</span>',
	                  'echo' => false
	              ) );
	              $menu = apply_filters('ampforwp_menu_content', $menu);
	              $sanitizer_obj = new AMPFORWP_Content( $menu, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
	              $sanitized_menu =  $sanitizer_obj->get_amp_content();
	              echo $sanitized_menu; ?>
	           </nav>
			</div>
			<?php } ?>
			<div class="rr">
				<?php amp_non_amp_link(); ?>
			</div>
		</div>
	</div>
</footer>
<?php } ?>
<?php if(is_single()){ ?>
<?php if($redux_builder_amp['enable-single-social-icons']){?>
<div class="s_stk ss-ic">
	<ul>
		<?php if($redux_builder_amp['enable-single-facebook-share']){?>
		<li>
			<a class="s_fb" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-twitter-share']){?>
		<li>
			<a class="s_tw" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>">
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
			<a class="s_em" target="_blank" href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>"></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-pinterest-share']){
			$image = '';
			if (ampforwp_has_post_thumbnail( ) ){
				$image = ampforwp_get_post_thumbnail( 'url', 'full' );
			}?>
		<li>
			<a class="s_pt" target="_blank" href="https://pinterest.com/pin/create/button/?media=<?php echo esc_url($image); ?>&url=<?php the_permalink(); ?>&description=<?php the_title(); ?>"></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-linkedin-share']){?>
		<li>
			<a class="s_lk" target="_blank" href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"></a>
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
			<a class="s_rd" target="_blank" href="https://reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-tumblr-share']){?>
		<li>
			<a class="s_tb" target="_blank" href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php the_permalink(); ?>"></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-telegram-share']){?>
		<li>
			<a class="s_tg" target="_blank" href="https://telegram.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-digg-share']){?>
		<li>
			<a class="s_dg" target="_blank" href="http://digg.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-stumbleupon-share']){?>
		<li>
			<a class="s_su" target="_blank" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"></a>
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
		<?php if ( isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share'] ) { ?>
		<li>
			<a class="s_ym" target="_blank" href="http://www.yummly.com/urb/verify?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&yumtype=button"></a>
		</li>
		<?php } ?>
	</ul>
</div>
<?php } }
do_action("ampforwp_advance_footer_options");
?>
<?php amp_footer_core(); ?>