</div>
<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp ?>

<?php 
do_action( 'levelup_foot');
if(!ampforwp_levelup_compatibility('hf_builder_foot') ){
if ( isset($redux_builder_amp['footer-type']) && '1' == $redux_builder_amp['footer-type'] ) { 
	$hide_infine_scroll = '';   
	if (true == ampforwp_get_setting('ampforwp-infinite-scroll-new-features')) {
	$hide_infine_scroll = 'next-page-hide';
	}
	?>
<footer class="footer" <?php echo esc_html($hide_infine_scroll) ?>>
	<?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
	<div class="f-w-f1">
		<div class="cntr">
			<div class="f-w">
				<?php 
				$sidebar_output = '';
				$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-footer-widget-area');
				if ( $sanitized_sidebar) {
					$sidebar_output = $sanitized_sidebar->get_amp_content();
					$sidebar_output = ampforwp_show_yoast_seo_local_map($sidebar_output);
					$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
					$sidebar_output = preg_replace_callback('/<form(.*?)>(.*?)<\/form>/s', function($match){
					if(strpos($match[1], 'target=') === false){
						return '<form'.$match[1].' target="_top">'.$match[2].'</form>';
					}else{
						return '<form'.$match[1].'>'.$match[2].'</form>';
					}	
					}, $sidebar_output);
				}
	            echo do_shortcode($sidebar_output); // amphtml content, no kses
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="f-w-f2">
		<div class="cntr">
			<?php if( ampforwp_get_setting('swift-menu') ){ if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
			<div class="f-menu">
				<nav>
	              <?php
	              $menu_args = array(
	                  'theme_location' => 'amp-footer-menu',
	                  'link_before'     => '<span>',
	                  'link_after'     => '</span>',
	                  'echo' => false
	              );
	              $menu = amp_menu(true, $menu_args, 'footer'); ?>
	           </nav>
			</div>
			<?php } }?>
			<div class="rr">
				<?php amp_non_amp_link(); ?>
            <?php do_action('amp_footer_link'); ?>
			</div>
		</div>
	</div>
</footer>
<?php }
}
// Social share in AMP 
	$amp_permalink = $facebook_app_id = $amp_permalink_fb_messenger = '';
	$facebook_app_id = ampforwp_get_setting('amp-facebook-app-id-messenger');
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
		$twitter_amp_permalink = wp_get_shortlink();
	}
if( (is_single() && $redux_builder_amp['enable-single-social-icons']) || (is_page() && true == $redux_builder_amp['ampforwp-page-sticky-social']) ){ ?>
<div class="s_stk ss-ic">
	<ul>
		<?php if(ampforwp_get_setting('ampforwp-facebook-like-button')){?>
		<li>
			<?php if( ampforwp_is_non_amp() && ampforwp_get_setting('ampforwp-amp-convert-to-wp')) { ?>	
					<div class="fb-like" 
    						<?php ampforwp_rel_attributes_social_links(); ?> data-href="<?php echo esc_url(get_the_permalink());?>" 
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
								<amp-facebook-like <?php echo "width=". esc_attr($fblikewidth) ."" ?> height=35 style="margin: 0 auto;margin-top: 5px;"
				 					layout="fixed"
				 					data-size="large"
				 					data-action="recommend"
				    				data-layout="button_count" <?php ampforwp_rel_attributes_social_links(); ?>
				    				data-href="<?php echo esc_url(get_the_permalink());?>">
								</amp-facebook-like>

							<?php }
					else { ?>
						<amp-facebook-like width=90 height=35 style="margin: 0 auto;"
				 			layout="fixed"
				 			data-size="large"
				    		data-layout="button_count"
				    		<?php ampforwp_rel_attributes_social_links(); ?>
				    		data-href="<?php echo esc_url(get_the_permalink());?>">
						</amp-facebook-like>
							<?php } ?>
			</li>
			<?php } ?>
					<?php if(ampforwp_get_setting('enable-single-facebook-share')){
								$facebook_icon = '';
                                if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
                                $facebook_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDg2LjAzNyAxMDA3IiBmaWxsPSIjZmZmZmZmIiA+PHBhdGggZD0iTTEyNCAxMDA1VjUzNkgwVjM2N2gxMjRWMjIzQzEyNCAxMTAgMTk3IDUgMzY2IDVjNjggMCAxMTkgNyAxMTkgN2wtNCAxNThzLTUyLTEtMTA4LTFjLTYxIDAtNzEgMjgtNzEgNzV2MTIzaDE4M2wtOCAxNjlIMzAydjQ2OUgxMjMiPjwvcGF0aD48L3N2Zz4=" width="16" height="16" alt="facebook"></amp-img>';    
                                }

					?>
		<li>
			<a title="facebook share" class="s_fb" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://www.facebook.com/sharer.php?u=<?php echo esc_url($amp_permalink); ?>"><?php echo $facebook_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(true == ampforwp_get_setting('enable-single-facebook-share-messenger')&& $amp_permalink_fb_messenger!=''){?>
			<li>
			<a title="facebook share messenger"  <?php ampforwp_rel_attributes_social_links(); ?> target="_blank" href="fb-messenger://share/?link=<?php echo esc_url($amp_permalink_fb_messenger); ?>">
				<div class="a-so-i a-so-facebookmessenger">
					<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/messenger.png') ?>" width="20" height="20" />
				</div>
			</a>
		</li>
		<?php } ?>
		<?php 
		$data_param = '';
		if(ampforwp_get_setting('enable-single-twitter-share')){
			$data_param_data = ampforwp_get_setting('enable-single-twitter-share-handle');
			$data_param_data = str_replace('@', '', $data_param_data);
			$data_param = ( '' == $data_param_data ) ? '' : '&via='.$data_param_data.''; 
			$twitter_icon = '';
			if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
				$twitter_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjQwLjAxNzEgNjAxLjA4NjkiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCA1MzAuMTU1YzEwLjQyIDEuMDE1IDIwLjgyNiAxLjU0OCAzMS4yMiAxLjU0OCA2MS4wNSAwIDExNS41MjgtMTguNzMgMTYzLjM4Ny01Ni4xNy0yOC40MjQtLjM1Mi01My45MzMtOS4wNC03Ni40NzctMjYuMDQzLTIyLjU3LTE2Ljk5LTM3Ljk4NC0zOC42NzUtNDYuMzIzLTY1LjA1NiA2LjkzMyAxLjQxOCAxNS4xMDIgMi4wOTUgMjQuNDU2IDIuMDk1IDEyLjE1IDAgMjMuNzY3LTEuNTc1IDM0Ljg2Mi00LjY4NC0zMC41MTctNS44NjctNTUuNzY2LTIwLjg5Mi03NS43MS00NC45OTctMTkuOTU0LTI0LjEzMi0yOS45Mi01MS45Ny0yOS45Mi04My41Mjh2LTEuNTc0YzE4LjM5NiAxMC40MiAzOC4zMTIgMTUuODA2IDU5LjgyOCAxNi4xMy0xOC4wMTctMTEuNzk4LTMyLjM0LTI3LjMwNC00Mi45MTUtNDYuNTctMTAuNTc2LTE5LjI0LTE1Ljg3LTQwLjEzLTE1Ljg3LTYyLjY3NCAwLTIzLjU5OCA2LjA4Ny00NS42MDggMTguMjEtNjYuMDk2IDMyLjYgNDAuNTg2IDcyLjQyIDcyLjkzOCAxMTkuNDMyIDk3LjA1NiA0NyAyNC4wOSA5Ny4zNyAzNy41MyAxNTEuMTU4IDQwLjMyNi0yLjQzMi0xMS40NDctMy42NTUtMjEuNTE2LTMuNjU1LTMwLjE4IDAtMzYuMDg1IDEyLjg0LTY2Ljk1NCAzOC41MDUtOTIuNjIgMjUuNjgtMjUuNjY2IDU2LjcwNC0zOC41MDUgOTMuMTUzLTM4LjUwNSAzNy43OSAwIDY5LjcwMiAxMy44OCA5NS43MyA0MS42NCAzMC4xNjgtNi4yNTcgNTcuOTI4LTE3LjAxNSA4My4yNTYtMzIuMjYtOS43MTggMzEuNTU4LTI4LjgxNSA1NS44NDUtNTcuMjM4IDcyLjg0NyAyNS4zMjgtMy4xMSA1MC4zMDQtMTAuMDU2IDc0LjkzLTIwLjgxNC0xNi42NTIgMjYuMDE3LTM4LjMzNyA0OC43NDItNjUuMDU3IDY4LjE1MnYxNy4xOTdjMCAzNC45OTItNS4xMjQgNzAuMTI4LTE1LjM0OCAxMDUuMzU1LTEwLjIxMiAzNS4yMTQtMjUuODUgNjguODUzLTQ2LjgzIDEwMC45NzItMjAuOTk2IDMyLjA2NS00Ni4wNSA2MC42Mi03NS4xOSA4NS41Ny0yOS4xMjYgMjQuOTc2LTY0LjA4IDQ0Ljg1My0xMDQuODUgNTkuNTktNDAuNzU0IDE0Ljc1My04NC41NTMgMjIuMDktMTMxLjM5NyAyMi4wOUMxMjguODYyIDU4OC45NCA2MS43NCA1NjkuMzUgMCA1MzAuMTU0eiI+PC9wYXRoPjwvc3ZnPg==" width="16" height="16" alt="twitter"></amp-img>';}
								 ?>
		<li>
			<a title="twitter share" class="s_tw" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://twitter.com/intent/tweet?url=<?php echo esc_url($twitter_amp_permalink); ?>&text=<?php echo esc_attr(ampforwp_sanitize_twitter_title(get_the_title())); ?><?php echo esc_attr($data_param); ?>"><?php echo $twitter_icon; ?>
			t</a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-email-share')){
								$email_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$email_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgODk2IDEwMjYiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCAxOTN2NjQwaDg5NlYxOTNIMHptNzY4IDY0TDQ0OCA1MjEgMTI4IDI1N2g2NDB6TTY0IDMyMWwyNTIuMDMgMTkxLjYyNUw2NCA3MDVWMzIxem02NCA0NDhsMjU0LTIwNi4yNUw0NDggNjEzbDY1Ljg3NS01MC4xMjVMNzY4IDc2OUgxMjh6bTcwNC02NEw1NzkuNjI1IDUxMi45MzggODMyIDMyMXYzODR6Ij48L3BhdGg+PC9zdmc+" width="16" height="16" alt="email"></amp-img>';
								}

								?>
		<li>
			<a title="email" class="s_em" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="mailto:?subject=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&body=<?php echo esc_url($amp_permalink); ?>"><?php echo $email_icon; ?></a>
		</li>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-pinterest-share']){
			$image = '';
			$pinterest_icon = '';
	 				if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
	 					$pinterest_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNOC42MTcgMTMuMjI3QzguMDkgMTUuOTggNy40NSAxOC42MiA1LjU1IDIwYy0uNTg3LTQuMTYyLjg2LTcuMjg3IDEuNTMzLTEwLjYwNS0xLjE0Ny0xLjkzLjEzOC01LjgxMiAyLjU1NS00Ljg1NSAyLjk3NSAxLjE3Ni0yLjU3NiA3LjE3MiAxLjE1IDcuOTIyIDMuODkuNzggNS40OC02Ljc1IDMuMDY2LTkuMkMxMC4zNy0uMjc0IDMuNzA4IDMuMTggNC41MjggOC4yNDZjLjIgMS4yMzggMS40NzggMS42MTMuNTEgMy4zMjItMi4yMy0uNDk0LTIuODk2LTIuMjU0LTIuODEtNC42LjEzOC0zLjg0IDMuNDUtNi41MjcgNi43Ny02LjkgNC4yMDItLjQ3IDguMTQ1IDEuNTQzIDguNjkgNS40OTQuNjEzIDQuNDYyLTEuODk2IDkuMjk0LTYuMzkgOC45NDYtMS4yMTctLjA5NS0xLjcyNy0uNy0yLjY4LTEuMjh6Ij48L3BhdGg+PC9zdmc+" width="16" height="16" alt="pinterest"></amp-img>';
	 							}
			if (ampforwp_has_post_thumbnail( ) ){
				$image = ampforwp_get_post_thumbnail( 'url', 'full' );
			}?>
		<li>
			<a title="pinterest share" class="s_pt" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://pinterest.com/pin/create/button/?media=<?php echo esc_url($image); ?>&url=<?php echo esc_url($amp_permalink); ?>&description=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"><?php echo $pinterest_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-linkedin-share')){
								$linkedin_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$linkedin_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTA0NiAxMDA3IiBmaWxsPSIjZmZmZmZmIiA+PHBhdGggZD0iTTIzNyAxMDA1VjMzMEgxM3Y2NzVoMjI0ek0xMjUgMjM4Yzc4IDAgMTI3LTUyIDEyNy0xMTdDMjUxIDU1IDIwMyA0IDEyNyA0IDUwIDQgMCA1NCAwIDEyMWMwIDY1IDQ5IDExNyAxMjQgMTE3aDF6bTIzNiA3NjdoMjI0VjYyOGMwLTIwIDEtNDAgNy01NSAxNi00MCA1My04MiAxMTUtODIgODEgMCAxMTQgNjIgMTE0IDE1M3YzNjFoMjI0VjYxOGMwLTIwNy0xMTEtMzA0LTI1OC0zMDQtMTIxIDAtMTc0IDY4LTIwNCAxMTRoMXYtOThIMzYwYzMgNjMgMCA2NzUgMCA2NzV6Ij48L3BhdGg+PC9zdmc+" width="16" height="16" alt="linkedin"></amp-img>';
								}
								?>
		<li>
			<a title="linkedin share" class="s_lk" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://www.linkedin.com/shareArticle?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"><?php echo $linkedin_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-whatsapp-share')){
								$whatsapp_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$whatsapp_icon = '<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTAgOTAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkwIDkwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IldoYXRzQXBwIiBkPSJNOTAsNDMuODQxYzAsMjQuMjEzLTE5Ljc3OSw0My44NDEtNDQuMTgyLDQzLjg0MWMtNy43NDcsMC0xNS4wMjUtMS45OC0yMS4zNTctNS40NTVMMCw5MGw3Ljk3NS0yMy41MjIgICBjLTQuMDIzLTYuNjA2LTYuMzQtMTQuMzU0LTYuMzQtMjIuNjM3QzEuNjM1LDE5LjYyOCwyMS40MTYsMCw0NS44MTgsMEM3MC4yMjMsMCw5MCwxOS42MjgsOTAsNDMuODQxeiBNNDUuODE4LDYuOTgyICAgYy0yMC40ODQsMC0zNy4xNDYsMTYuNTM1LTM3LjE0NiwzNi44NTljMCw4LjA2NSwyLjYyOSwxNS41MzQsNy4wNzYsMjEuNjFMMTEuMTA3LDc5LjE0bDE0LjI3NS00LjUzNyAgIGM1Ljg2NSwzLjg1MSwxMi44OTEsNi4wOTcsMjAuNDM3LDYuMDk3YzIwLjQ4MSwwLDM3LjE0Ni0xNi41MzMsMzcuMTQ2LTM2Ljg1N1M2Ni4zMDEsNi45ODIsNDUuODE4LDYuOTgyeiBNNjguMTI5LDUzLjkzOCAgIGMtMC4yNzMtMC40NDctMC45OTQtMC43MTctMi4wNzYtMS4yNTRjLTEuMDg0LTAuNTM3LTYuNDEtMy4xMzgtNy40LTMuNDk1Yy0wLjk5My0wLjM1OC0xLjcxNy0wLjUzOC0yLjQzOCwwLjUzNyAgIGMtMC43MjEsMS4wNzYtMi43OTcsMy40OTUtMy40Myw0LjIxMmMtMC42MzIsMC43MTktMS4yNjMsMC44MDktMi4zNDcsMC4yNzFjLTEuMDgyLTAuNTM3LTQuNTcxLTEuNjczLTguNzA4LTUuMzMzICAgYy0zLjIxOS0yLjg0OC01LjM5My02LjM2NC02LjAyNS03LjQ0MWMtMC42MzEtMS4wNzUtMC4wNjYtMS42NTYsMC40NzUtMi4xOTFjMC40ODgtMC40ODIsMS4wODQtMS4yNTUsMS42MjUtMS44ODIgICBjMC41NDMtMC42MjgsMC43MjMtMS4wNzUsMS4wODItMS43OTNjMC4zNjMtMC43MTcsMC4xODItMS4zNDQtMC4wOS0xLjg4M2MtMC4yNy0wLjUzNy0yLjQzOC01LjgyNS0zLjM0LTcuOTc3ICAgYy0wLjkwMi0yLjE1LTEuODAzLTEuNzkyLTIuNDM2LTEuNzkyYy0wLjYzMSwwLTEuMzU0LTAuMDktMi4wNzYtMC4wOWMtMC43MjIsMC0xLjg5NiwwLjI2OS0yLjg4OSwxLjM0NCAgIGMtMC45OTIsMS4wNzYtMy43ODksMy42NzYtMy43ODksOC45NjNjMCw1LjI4OCwzLjg3OSwxMC4zOTcsNC40MjIsMTEuMTEzYzAuNTQxLDAuNzE2LDcuNDksMTEuOTIsMTguNSwxNi4yMjMgICBDNTguMiw2NS43NzEsNTguMiw2NC4zMzYsNjAuMTg2LDY0LjE1NmMxLjk4NC0wLjE3OSw2LjQwNi0yLjU5OSw3LjMxMi01LjEwN0M2OC4zOTgsNTYuNTM3LDY4LjM5OCw1NC4zODYsNjguMTI5LDUzLjkzOHoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="16" height="16" alt="whatsapp"></amp-img>';
								}
								?>
		<li>
			<a title="whatsapp share" class="s_wp" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://api.whatsapp.com/send?text=<?php echo esc_attr(htmlspecialchars(get_the_title()))."&nbsp;".esc_url($amp_permalink); ?>" data-action="share/whatsapp/share"><?php echo $whatsapp_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-line-share') == true){ 
			$line_share = 'http://line.me/R/msg/text/';
			$line_amp_permalink = add_query_arg($amp_permalink,'', $line_share );
			?>
			<li>
			<a title="line share" class="s_li" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($line_amp_permalink); ?>">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="15" height="15" alt="line"/>

			L</a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-vk-share')){
								$vk_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$vk_icon = '<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMDQuMzYgMzA0LjM2IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMDQuMzYgMzA0LjM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGcgaWQ9IlhNTElEXzFfIj4KCTxwYXRoIGlkPSJYTUxJRF84MDdfIiBzdHlsZT0iZmlsbC1ydWxlOmV2ZW5vZGQ7Y2xpcC1ydWxlOmV2ZW5vZGQ7IiBkPSJNMjYxLjk0NSwxNzUuNTc2YzEwLjA5Niw5Ljg1NywyMC43NTIsMTkuMTMxLDI5LjgwNywyOS45ODIgICBjNCw0LjgyMiw3Ljc4Nyw5Ljc5OCwxMC42ODQsMTUuMzk0YzQuMTA1LDcuOTU1LDAuMzg3LDE2LjcwOS02Ljc0NiwxNy4xODRsLTQ0LjM0LTAuMDJjLTExLjQzNiwwLjk0OS0yMC41NTktMy42NTUtMjguMjMtMTEuNDc0ICAgYy02LjEzOS02LjI1My0xMS44MjQtMTIuOTA4LTE3LjcyNy0xOS4zNzJjLTIuNDItMi42NDItNC45NTMtNS4xMjgtNy45NzktNy4wOTNjLTYuMDUzLTMuOTI5LTExLjMwNy0yLjcyNi0xNC43NjYsMy41ODcgICBjLTMuNTIzLDYuNDIxLTQuMzIyLDEzLjUzMS00LjY2OCwyMC42ODdjLTAuNDc1LDEwLjQ0MS0zLjYzMSwxMy4xODYtMTQuMTE5LDEzLjY2NGMtMjIuNDE0LDEuMDU3LTQzLjY4Ni0yLjMzNC02My40NDctMTMuNjQxICAgYy0xNy40MjItOS45NjgtMzAuOTMyLTI0LjA0LTQyLjY5MS0zOS45NzFDMzQuODI4LDE1My40ODIsMTcuMjk1LDExOS4zOTUsMS41MzcsODQuMzUzQy0yLjAxLDc2LjQ1OCwwLjU4NCw3Mi4yMiw5LjI5NSw3Mi4wNyAgIGMxNC40NjUtMC4yODEsMjguOTI4LTAuMjYxLDQzLjQxLTAuMDJjNS44NzksMC4wODYsOS43NzEsMy40NTgsMTIuMDQxLDkuMDEyYzcuODI2LDE5LjI0MywxNy40MDIsMzcuNTUxLDI5LjQyMiw1NC41MjEgICBjMy4yMDEsNC41MTgsNi40NjUsOS4wMzYsMTEuMTEzLDEyLjIxNmM1LjE0MiwzLjUyMSw5LjA1NywyLjM1NCwxMS40NzYtMy4zNzRjMS41MzUtMy42MzIsMi4yMDctNy41NDQsMi41NTMtMTEuNDM0ICAgYzEuMTQ2LTEzLjM4MywxLjI5Ny0yNi43NDMtMC43MTMtNDAuMDc5Yy0xLjIzNC04LjMyMy01LjkyMi0xMy43MTEtMTQuMjI3LTE1LjI4NmMtNC4yMzgtMC44MDMtMy42MDctMi4zOC0xLjU1NS00Ljc5OSAgIGMzLjU2NC00LjE3Miw2LjkxNi02Ljc2OSwxMy41OTgtNi43NjloNTAuMTExYzcuODg5LDEuNTU3LDkuNjQxLDUuMTAxLDEwLjcyMSwxMy4wMzlsMC4wNDMsNTUuNjYzICAgYy0wLjA4NiwzLjA3MywxLjUzNSwxMi4xOTIsNy4wNywxNC4yMjZjNC40MywxLjQ0OCw3LjM1LTIuMDk2LDEwLjAwOC00LjkwNWMxMS45OTgtMTIuNzM0LDIwLjU2MS0yNy43ODMsMjguMjExLTQzLjM2NiAgIGMzLjM5NS02Ljg1Miw2LjMxNC0xMy45NjgsOS4xNDMtMjEuMDc4YzIuMDk2LTUuMjc2LDUuMzg1LTcuODcyLDExLjMyOC03Ljc1N2w0OC4yMjksMC4wNDNjMS40MywwLDIuODc3LDAuMDIxLDQuMjYyLDAuMjU4ICAgYzguMTI3LDEuMzg1LDEwLjM1NCw0Ljg4MSw3Ljg0NCwxMi44MTdjLTMuOTU1LDEyLjQ1MS0xMS42NSwyMi44MjctMTkuMTc0LDMzLjI1MWMtOC4wNDMsMTEuMTI5LTE2LjY0NSwyMS44NzctMjQuNjIxLDMzLjA3MiAgIEMyNTIuMjYsMTYxLjU0NCwyNTIuODQyLDE2Ni42OTcsMjYxLjk0NSwxNzUuNTc2TDI2MS45NDUsMTc1LjU3NnogTTI2MS45NDUsMTc1LjU3NiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="16" height="16" alt="vk"></amp-img>';
								}
								?>
		<li>
			<a title="vkontakte share" class="s_vk" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="http://vk.com/share.php?url=<?php echo esc_url($amp_permalink); ?>"><?php echo $vk_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-odnoklassniki-share')){
								$odnoklassniki_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$odnoklassniki_icon = '<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDk1LjQ4MSA5NS40ODEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDk1LjQ4MSA5NS40ODE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDMuMDQxLDY3LjI1NGMtNy40MDItMC43NzItMTQuMDc2LTIuNTk1LTE5Ljc5LTcuMDY0Yy0wLjcwOS0wLjU1Ni0xLjQ0MS0xLjA5Mi0yLjA4OC0xLjcxMyAgICBjLTIuNTAxLTIuNDAyLTIuNzUzLTUuMTUzLTAuNzc0LTcuOTg4YzEuNjkzLTIuNDI2LDQuNTM1LTMuMDc1LDcuNDg5LTEuNjgyYzAuNTcyLDAuMjcsMS4xMTcsMC42MDcsMS42MzksMC45NjkgICAgYzEwLjY0OSw3LjMxNywyNS4yNzgsNy41MTksMzUuOTY3LDAuMzI5YzEuMDU5LTAuODEyLDIuMTkxLTEuNDc0LDMuNTAzLTEuODEyYzIuNTUxLTAuNjU1LDQuOTMsMC4yODIsNi4yOTksMi41MTQgICAgYzEuNTY0LDIuNTQ5LDEuNTQ0LDUuMDM3LTAuMzgzLDcuMDE2Yy0yLjk1NiwzLjAzNC02LjUxMSw1LjIyOS0xMC40NjEsNi43NjFjLTMuNzM1LDEuNDQ4LTcuODI2LDIuMTc3LTExLjg3NSwyLjY2MSAgICBjMC42MTEsMC42NjUsMC44OTksMC45OTIsMS4yODEsMS4zNzZjNS40OTgsNS41MjQsMTEuMDIsMTEuMDI1LDE2LjUsMTYuNTY2YzEuODY3LDEuODg4LDIuMjU3LDQuMjI5LDEuMjI5LDYuNDI1ICAgIGMtMS4xMjQsMi40LTMuNjQsMy45NzktNi4xMDcsMy44MWMtMS41NjMtMC4xMDgtMi43ODItMC44ODYtMy44NjUtMS45NzdjLTQuMTQ5LTQuMTc1LTguMzc2LTguMjczLTEyLjQ0MS0xMi41MjcgICAgYy0xLjE4My0xLjIzNy0xLjc1Mi0xLjAwMy0yLjc5NiwwLjA3MWMtNC4xNzQsNC4yOTctOC40MTYsOC41MjgtMTIuNjgzLDEyLjczNWMtMS45MTYsMS44ODktNC4xOTYsMi4yMjktNi40MTgsMS4xNSAgICBjLTIuMzYyLTEuMTQ1LTMuODY1LTMuNTU2LTMuNzQ5LTUuOTc5YzAuMDgtMS42MzksMC44ODYtMi44OTEsMi4wMTEtNC4wMTRjNS40NDEtNS40MzMsMTAuODY3LTEwLjg4LDE2LjI5NS0xNi4zMjIgICAgQzQyLjE4Myw2OC4xOTcsNDIuNTE4LDY3LjgxMyw0My4wNDEsNjcuMjU0eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik00Ny41NSw0OC4zMjljLTEzLjIwNS0wLjA0NS0yNC4wMzMtMTAuOTkyLTIzLjk1Ni0yNC4yMThDMjMuNjcsMTAuNzM5LDM0LjUwNS0wLjAzNyw0Ny44NCwwICAgIGMxMy4zNjIsMC4wMzYsMjQuMDg3LDEwLjk2NywyNC4wMiwyNC40NzhDNzEuNzkyLDM3LjY3Nyw2MC44ODksNDguMzc1LDQ3LjU1LDQ4LjMyOXogTTU5LjU1MSwyNC4xNDMgICAgYy0wLjAyMy02LjU2Ny01LjI1My0xMS43OTUtMTEuODA3LTExLjgwMWMtNi42MDktMC4wMDctMTEuODg2LDUuMzE2LTExLjgzNSwxMS45NDNjMC4wNDksNi41NDIsNS4zMjQsMTEuNzMzLDExLjg5NiwxMS43MDkgICAgQzU0LjM1NywzNS45NzEsNTkuNTczLDMwLjcwOSw1OS41NTEsMjQuMTQzeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="16" height="16" alt="odnoklassniki"></amp-img>';
								}
								?>
		<li>
			                <?php $feature_img = '';
								if (ampforwp_has_post_thumbnail() ){
								   $feature_img = ampforwp_get_post_thumbnail( 'url', 'medium' );
								}
							   ?>
			<a title="odnoklassniki share" class="s_od" target="_blank" <?php esc_html(ampforwp_rel_attributes_social_links()); ?> href="https://connect.ok.ru/offer?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&imageUrl=<?php echo esc_url($feature_img); ?>"><?php echo $odnoklassniki_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-reddit-share')){
							$reddit_icon = '';
							if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
								$reddit_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDQ5IDUxMiIgZmlsbD0iI2ZmZmZmZiIgPjxwYXRoIGQ9Ik00NDkgMjUxYzAgMjAtMTEgMzctMjcgNDUgMSA1IDEgOSAxIDE0IDAgNzYtODkgMTM4LTE5OSAxMzhTMjYgMzg3IDI2IDMxMWMwLTUgMC0xMCAxLTE1LTE2LTgtMjctMjUtMjctNDUgMC0yOCAyMy01MCA1MC01MCAxMyAwIDI0IDUgMzMgMTMgMzMtMjMgNzktMzkgMTI5LTQxaDJsMzEtMTAzIDkwIDE4YzgtMTQgMjItMjQgMzktMjRoMWMyNSAwIDQ0IDIwIDQ0IDQ1cy0xOSA0NS00NCA0NWgtMWMtMjMgMC00Mi0xNy00NC00MGwtNjctMTQtMjIgNzRjNDkgMyA5MyAxNyAxMjUgNDAgOS04IDIxLTEzIDM0LTEzIDI3IDAgNDkgMjIgNDkgNTB6TTM0IDI3MWM1LTE1IDE1LTI5IDI5LTQxLTQtMy05LTUtMTUtNS0xNCAwLTI1IDExLTI1IDI1IDAgOSA0IDE3IDExIDIxem0zMjQtMTYyYzAgOSA3IDE3IDE2IDE3czE3LTggMTctMTctOC0xNy0xNy0xNy0xNiA4LTE2IDE3ek0xMjcgMjg4YzAgMTggMTQgMzIgMzIgMzJzMzItMTQgMzItMzItMTQtMzEtMzItMzEtMzIgMTMtMzIgMzF6bTk3IDExMmM0OCAwIDc3LTI5IDc4LTMwbC0xMy0xMnMtMjUgMjQtNjUgMjRjLTQxIDAtNjQtMjQtNjQtMjRsLTEzIDEyYzEgMSAyOSAzMCA3NyAzMHptNjctODBjMTggMCAzMi0xNCAzMi0zMnMtMTQtMzEtMzItMzEtMzIgMTMtMzIgMzEgMTQgMzIgMzIgMzJ6bTEyNC00OGM3LTUgMTEtMTMgMTEtMjIgMC0xNC0xMS0yNS0yNS0yNS02IDAtMTEgMi0xNSA1IDE0IDEyIDI0IDI3IDI5IDQyeiI+PC9wYXRoPjwvc3ZnPg==" width="16" height="16" alt="reddit"></amp-img>';
							}
							?>
		<li>
			<a title="reddit share" class="s_rd" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://reddit.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"><?php echo $reddit_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-tumblr-share')){
								$tumblr_icon ='';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
								$tumblr_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMzYuMDAyIDI4djE0LjYzNmMwIDMuNzE0LS4wNDggNS44NTMuMzQ2IDYuOTA2LjM5IDEuMDQ3IDEuMzcgMi4xMzQgMi40MzcgMi43NjMgMS40MTguODUgMy4wMzQgMS4yNzMgNC44NTcgMS4yNzMgMy4yNCAwIDUuMTU1LS40MjggOC4zNi0yLjUzNHY5LjYyYy0yLjczMiAxLjI4Ni01LjExOCAyLjAzOC03LjMzNCAyLjU2LTIuMjIuNTE0LTQuNjE2Ljc3NC03LjE5Ljc3NC0yLjkyOCAwLTQuNjU1LS4zNjgtNi45MDItMS4xMDMtMi4yNDctLjc0Mi00LjE2Ni0xLjgtNS43NS0zLjE2LTEuNTkyLTEuMzctMi42OS0yLjgyNC0zLjMwNC00LjM2M3MtLjkyLTMuNzc2LS45Mi02LjcwM1YyNi4yMjRoLTguNTl2LTkuMDYzYzIuNTE0LS44MTUgNS4zMjQtMS45ODcgNy4xMTItMy41MSAxLjc5Ny0xLjUyNyAzLjIzNS0zLjM1NiA0LjMyLTUuNDk2QzI0LjUzIDYuMDIyIDI1LjI3NiAzLjMgMjUuNjgzIDBoMTAuMzJ2MTZINTJ2MTJIMzYuMDA0eiI+PC9wYXRoPjwvc3ZnPg==" width="16" height="16" alt="tumblr"></amp-img>';}?>
		<li>
			<a title="tumblr share" class="s_tb" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url($amp_permalink) ?>"><?php echo $tumblr_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-telegram-share')){
							$telegram_icon = '';
							if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
								$telegram_icon = '<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ1NS43MzEgNDU1LjczMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDU1LjczMSA0NTUuNzMxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8cmVjdCB4PSIwIiB5PSIwIiBzdHlsZT0iZmlsbDojNjFBOERFOyIgd2lkdGg9IjQ1NS43MzEiIGhlaWdodD0iNDU1LjczMSIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTguODQ0LDEwMC42TDU0LjA5MSwyMTkuMzU5Yy05Ljg3MSwzLjg0Ny05LjI3MywxOC4wMTIsMC44ODgsMjEuMDEybDc3LjQ0MSwyMi44NjhsMjguOTAxLDkxLjcwNiAgIGMzLjAxOSw5LjU3OSwxNS4xNTgsMTIuNDgzLDIyLjE4NSw1LjMwOGw0MC4wMzktNDAuODgybDc4LjU2LDU3LjY2NWM5LjYxNCw3LjA1NywyMy4zMDYsMS44MTQsMjUuNzQ3LTkuODU5bDUyLjAzMS0yNDguNzYgICBDMzgyLjQzMSwxMDYuMjMyLDM3MC40NDMsOTYuMDgsMzU4Ljg0NCwxMDAuNnogTTMyMC42MzYsMTU1LjgwNkwxNzkuMDgsMjgwLjk4NGMtMS40MTEsMS4yNDgtMi4zMDksMi45NzUtMi41MTksNC44NDcgICBsLTUuNDUsNDguNDQ4Yy0wLjE3OCwxLjU4LTIuMzg5LDEuNzg5LTIuODYxLDAuMjcxbC0yMi40MjMtNzIuMjUzYy0xLjAyNy0zLjMwOCwwLjMxMi02Ljg5MiwzLjI1NS04LjcxN2wxNjcuMTYzLTEwMy42NzYgICBDMzIwLjA4OSwxNDcuNTE4LDMyNC4wMjUsMTUyLjgxLDMyMC42MzYsMTU1LjgwNnoiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="16" height="16" alt="telegram"></amp-img>';
							}?>
		<li>
			<a title="telegram share" class="s_tg" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://telegram.me/share/url?url=<?php echo esc_url($amp_permalink); ?>&text=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"><?php echo $telegram_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-stumbleupon-share')){
								$stumbleupon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$stumbleupon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjcwLjIyMzMgNjAxLjA4NjkiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCA0MzcuMjQ3di05Mi42NzJoMTE0LjY4OHY5MS42NjRjMCA5LjU2NyAzLjQwOCAxNy44MjMgMTAuMjQgMjQuODNzMTUuMTg0IDEwLjQ5NyAyNS4wODggMTAuNDk3IDE4LjMzNi0zLjQyNCAyNS4zNDQtMTAuMjRjNy4wMDgtNi44NDggMTAuNDk2LTE1LjIgMTAuNDk2LTI1LjA4OFYyMTkuNjQ2YzAtMzkuOTM1IDE0Ljc1Mi03My45ODQgNDQuMjg4LTEwMi4xNDQgMjkuNTM2LTI4LjE2IDY0LjYwOC00Mi4yNCAxMDUuMjE2LTQyLjI0IDQwLjYwOCAwIDc1LjY4IDE0LjE2IDEwNS4yMTYgNDIuNDk2IDI5LjUyIDI4LjMzNSA0NC4zMDUgNjIuNjQgNDQuMzA1IDEwMi45MXY0Ny4xMDRsLTY4LjYyMyAyMC40OC00NS41Ny0yMS41MDN2LTQwLjk2YzAtOS45MDMtMy40MDctMTguMjU2LTEwLjI1NS0yNS4wODgtNi44MTYtNi44MzItMTUuMTgzLTEwLjI0LTI1LjA3Mi0xMC4yNC05LjkwMyAwLTE4LjMzNiAzLjQwOC0yNS4zNDQgMTAuMjRzLTEwLjQ5NiAxNS4xODUtMTAuNDk2IDI1LjA5djIxMy41MDNjMCA0MC45NzYtMTQuNjcyIDc1Ljg3Mi00NC4wMzIgMTA0LjcyLTI5LjM0NCAyOC44NDgtNjQuNTEyIDQzLjI0OC0xMDUuNDcyIDQzLjI0OC00MS4zMSAwLTc2LjY0LTE0LjU5Mi0xMDUuOTg0LTQzLjc3NkMxNC42ODggNTE0LjMwMy4wMDIgNDc4Ljg4LjAwMiA0MzcuMjQ3em0zNzAuNjg4IDEuNTM2di05My42OTVsNDUuNTY4IDIxLjUyIDY4LjYyNC0yMC40OTd2OTQuMjI2YzAgOS45MDMgMy40MDggMTguMzM2IDEwLjIyNCAyNS4zNDQgNi44NDcgNy4wMDcgMTUuMiAxMC40OTYgMjUuMDg3IDEwLjQ5NiA5LjkwNiAwIDE4LjI3NC0zLjUwNCAyNS4wOS0xMC40OTYgNi44MTYtNi45OTMgMTAuMjU1LTE1LjQ0IDEwLjI1NS0yNS4zNDR2LTk1Ljc0NGgxMTQuNjg4djkyLjY3MmMwIDQxLjI5NS0xNC41OSA3Ni42NC00My43NzYgMTA1Ljk4My0yOS4xODQgMjkuMzYtNjQuNDMyIDQ0LjAzMi0xMDUuNzI4IDQ0LjAzMnMtNzYuNjI1LTE0LjQ5Ny0xMDUuOTg1LTQzLjUyYy0yOS4zNi0yOS4wNC00NC4wNDgtNjQuMDE3LTQ0LjA0OC0xMDQuOTc4eiI+PC9wYXRoPjwvc3ZnPg==" width="16" height="16" alt="stumbleupon"></amp-img>';
								}?>
		<li>
			<a title="stumbleupon share" class="s_su" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"><?php echo $stumbleupon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-wechat-share')){
								$wechat_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$wechat_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjA0OCAxODk2LjA4MzMiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNNTgwIDQ2MXEwLTQxLTI1LTY2dC02Ni0yNXEtNDMgMC03NiAyNS41VDM4MCA0NjFxMCAzOSAzMyA2NC41dDc2IDI1LjVxNDEgMCA2Ni0yNC41dDI1LTY1LjV6bTc0MyA1MDdxMC0yOC0yNS41LTUwdC02NS41LTIycS0yNyAwLTQ5LjUgMjIuNVQxMTYwIDk2OHEwIDI4IDIyLjUgNTAuNXQ0OS41IDIyLjVxNDAgMCA2NS41LTIydDI1LjUtNTF6bS0yMzYtNTA3cTAtNDEtMjQuNS02NlQ5OTcgMzcwcS00MyAwLTc2IDI1LjVUODg4IDQ2MXEwIDM5IDMzIDY0LjV0NzYgMjUuNXE0MSAwIDY1LjUtMjQuNVQxMDg3IDQ2MXptNjM1IDUwN3EwLTI4LTI2LTUwdC02NS0yMnEtMjcgMC00OS41IDIyLjVUMTU1OSA5NjhxMCAyOCAyMi41IDUwLjV0NDkuNSAyMi41cTM5IDAgNjUtMjJ0MjYtNTF6bS0yNjYtMzk3cS0zMS00LTcwLTQtMTY5IDAtMzExIDc3VDg1MS41IDg1Mi41IDc3MCAxMTQwcTAgNzggMjMgMTUyLTM1IDMtNjggMy0yNiAwLTUwLTEuNXQtNTUtNi41LTQ0LjUtNy01NC41LTEwLjUtNTAtMTAuNWwtMjUzIDEyNyA3Mi0yMThRMCA5NjUgMCA2NzhxMC0xNjkgOTcuNS0zMTF0MjY0LTIyMy41VDcyNSA2MnExNzYgMCAzMzIuNSA2NnQyNjIgMTgyLjVUMTQ1NiA1NzF6bTU5MiA1NjFxMCAxMTctNjguNSAyMjMuNVQxNzk0IDE1NDlsNTUgMTgxLTE5OS0xMDlxLTE1MCAzNy0yMTggMzctMTY5IDAtMzExLTcwLjVUODk3LjUgMTM5NiA4MTYgMTEzMnQ4MS41LTI2NFQxMTIxIDY3Ni41dDMxMS03MC41cTE2MSAwIDMwMyA3MC41dDIyNy41IDE5MlQyMDQ4IDExMzJ6Ij48L3BhdGg+PC9zdmc+" width="16" height="16" alt="wechat"></amp-img>';}?>
		<li>
			<a title="wechat share" class="s_wc" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url=<?php echo esc_url($amp_permalink); ?>"><?php echo $wechat_icon; ?></a>
		</li>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-viber-share')){
								$viber_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$viber_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAyNiAxMjM0IiBmaWxsPSIjZmZmZmZmIiA+PHBhdGggZD0iTTkwNCA3OTRxLTY5IDYxLTIwMCA4Ny41VDQzNCA4OTdsLTE3NiAxMzJWODY0cS04Ny0yNy0xMzYtNzAtNTgtNTEtOTAtMTQ2LjV0LTMyLTE5NSAzMi0xOTUgOTAuNS0xNDcgMTY3LjUtNzlUNTEzIDR0MjIzIDI3LjUgMTY3LjUgNzkgOTAuNSAxNDcgMzIgMTk1LTMyIDE5NVQ5MDQgNzk0ek02MzkgNTQ5bDY1IDExcS04LTEyMC05Mi41LTIwNVQ0MDcgMjYybDExIDY1cTg2IDExIDE0OCA3M3Q3MyAxNDl6TTQyOSAzOTRsMTIgNzJxNDAgMjAgNTkgNTlsNzIgMTJxLTEyLTUzLTUxLTkxLjVUNDI5IDM5NHptLTEwNyA1OXYtNjRxMC0xNy0xMi41LTM0VDI4MyAzMzAuNXQtMjEtMS41bC00NiA0N3EtMzkgMzktMTEuNSAxMjEuNXQxMDUgMTYwIDE2MCAxMDVUNTkwIDc1MWw0Ny00N3E3LTYtLjUtMjAuNVQ2MTIgNjU3dC0zNC0xMmgtNjRsLTM3IDMycS00NC0xMi0xMDkuNS03Ny41VDI5MCA0ODl6bTY0LTMyMGwxMCA2NXExMDAgMiAxODUgNTIuNXQxMzUgMTM1VDc2OSA1NzBsNjUgMTFxMC05MS0zNS41LTE3NFQ3MDMgMjY0dC0xNDMtOTUuNVQzODYgMTMzeiI+PC9wYXRoPjwvc3ZnPg==" width="16" height="16" alt="viber"></amp-img>';
								}?>
		<li>
			<a class="s_vb" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="viber://forward?text=<?php echo esc_url($amp_permalink); ?>"><?php echo $viber_icon; ?></a>
		</li>
		<?php } ?>
		<?php if ( ampforwp_get_setting('enable-single-yummly-share')){
								$yummly_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$yummly_icon = '<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgODk2IDEwMjYiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCAxOTN2NjQwaDg5NlYxOTNIMHptNzY4IDY0TDQ0OCA1MjEgMTI4IDI1N2g2NDB6TTY0IDMyMWwyNTIuMDMgMTkxLjYyNUw2NCA3MDVWMzIxem02NCA0NDhsMjU0LTIwNi4yNUw0NDggNjEzbDY1Ljg3NS01MC4xMjVMNzY4IDc2OUgxMjh6bTcwNC02NEw1NzkuNjI1IDUxMi45MzggODMyIDMyMXYzODR6Ij48L3BhdGg+PC9zdmc+" width="16" height="16" alt="yummly"></amp-img>';
								}?>
		<li>
			<a title="yummly share" class="s_ym" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="http://www.yummly.com/urb/verify?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&yumtype=button"><?php echo $yummly_icon; ?></a>
		</li>
		<?php } ?>
		<?php if ( ampforwp_get_setting('enable-single-hatena-bookmarks')){
								$hatena_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$hatena_icon = '<amp-img src="data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'512\' height=\'512\' viewBox=\'0 0 512 512\'%3e%3cpath d=\'M 64 96 L 64 416 L 212 416 C 252 416 292 404 308 368 C 328 332 320 276 284 252 C 272 244 260 240 248 236 C 276 232 300 212 300 184 C 304 156 296 120 268 108 C 236 96 192 96 160 96 L 64 96 z M 364 96 L 364 308 L 444 308 L 444 96 L 364 96 z M 144 156 C 144 156 188 156 200 160 C 224 168 224 208 196 212 C 188 216 144 216 144 216 L 144 156 z M 144 280 C 144 280 188 280 208 284 C 232 288 240 312 228 332 C 220 348 204 348 188 348 L 144 348 L 144 280 z M 404 328 A 44 44 0 0 0 360 372 A 44 44 0 0 0 404 416 A 44 44 0 0 0 448 372 A 44 44 0 0 0 404 328 z\' style=\'fill:%23ffffff\'/%3e%3c/svg%3e" width="16" height="16" alt="hatena"></amp-img>';
								}?>
		<li>
			<a title="hatena share" class="s_hb" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="http://b.hatena.ne.jp/entry/<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"><?php echo $hatena_icon; ?></a>
		</li>
		<?php } ?>
		<?php if ( ampforwp_get_setting('enable-single-pocket-share')){
								$pocket_icon = '';
								if('css-icons' == ampforwp_get_setting('ampforwp_font_icon')){
									$pocket_icon = '<amp-img src="data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'2500\' height=\'2251\' viewBox=\'75.247 261.708 445.529 401.074\'%3e%3cpath fill=\'%23EF4056\' d=\'M114.219 261.708c-24.275 1.582-38.972 15.44-38.972 40.088v147.611c0 119.893 119.242 214.114 222.393 213.37 115.986-.837 223.137-98.779 223.137-213.37V301.796c0-24.741-15.626-38.693-40.088-40.088h-366.47zm93.943 120.079L297.64 466.8l89.571-85.013c40.088-16.835 57.574 28.927 41.111 42.321L311.685 535.443c-3.813 3.628-24.183 3.628-27.996 0L167.051 424.107c-15.72-14.789 4.743-61.295 41.111-42.32z\'/%3e%3c/svg%3e" width="16" height="16" style="background: #fff;" alt="pocket"></amp-img>';
								}?>
		<li>
			<a title="pocket share" class="s_pk" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://getpocket.com/save?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>"><?php echo $pocket_icon; ?></a>
		</li>
		<?php } ?>
		<?php if ( true == ampforwp_get_setting('enable-single-mewe-share')){?>
			<li>
					<a title="mewe share" class="s_mewe" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://mewe.com/share?link=<?php echo esc_url($amp_permalink); ?>">
					<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/favicon-mewe.svg') ?>" width="15" height="15" /></a>
			</li>
		<?php } ?>
		<?php if ( true == ampforwp_get_setting('enable-single-flipboard-share') ) { ?>
			<li>
				<a title="flipboard share" class="s_flipboard" <?php ampforwp_rel_attributes_social_links(); ?> href="https://share.flipboard.com/bookmarklet/popout?v=<?php echo esc_html(get_the_title(ampforwp_get_the_ID())); ?>&url=<?php echo urlencode(esc_url($amp_permalink)); ?>" target="_blank">
					<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/flipboard.png') ?>" width="15" height="15" />
				</a>
			</li>
		<?php } ?>		
	</ul>
</div>
<?php } 
do_action("ampforwp_advance_footer_options");
?>
<?php amp_footer_core(); ?>