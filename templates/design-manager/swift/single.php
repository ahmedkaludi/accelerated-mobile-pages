<?php global $redux_builder_amp; ?>
<?php amp_header(); ?>
<?php if($redux_builder_amp['single-design-type'] == '1'){?>
<div class="sp sgl">
	<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
		<div class="cntr">
			<?php if ( true == $redux_builder_amp['ampforwp-bread-crumb'] ) {
				amp_breadcrumb();
			}?>
			<?php amp_categories_list();?>
			<?php amp_title(); ?>
			<?php if( true == $redux_builder_amp['enable-excerpt-single'] ){ ?>
				<div class="tl-exc">
				   <?php amp_excerpt(250); ?>
			    </div>
			<?php } ?>
		</div>
		<?php if ( isset($redux_builder_amp['swift-featued-image']) && $redux_builder_amp['swift-featued-image'] && ampforwp_has_post_thumbnail() ) { ?>
			<div class="sf-img">
				<?php amp_featured_image();?>
			</div>
		<?php }
	} ?>
	<div class="sp-cnt">
		<div class="cntr">
			<div class="sp-rl">
				<div class="sp-rt">
					<?php if (isset($redux_builder_amp['swift-social-position']) && 'above-content' == $redux_builder_amp['swift-social-position']){
							ampforwp_swift_social_icons(); 
						}
						if ( 'above-content' ==  ampforwp_get_setting('swift-add-this-position') ){
							echo ampforwp_addThis_support(); 
						}	?>
					<div class="cntn-wrp artl-cnt">
						<?php amp_content(); ?>
					</div>
					<?php if (isset($redux_builder_amp['swift-social-position']) && 'below-content' == $redux_builder_amp['swift-social-position']){
						ampforwp_swift_social_icons(); 
						}
						if ( 'below-content' ==  ampforwp_get_setting('swift-add-this-position') ){
							echo ampforwp_addThis_support();
						} ?>
					<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
					<?php if( $redux_builder_amp['amp-author-description'] ) { ?>
						<?php amp_author_box( 
											array(	'avatar'=>true,
													'avatar_size'=>60,
													'author_description'=>true,
													'ads_below_the_author'=>true)
											); ?>
					<?php } ?>
					<?php amp_post_navigation();?>
					<div class="cmts">
						<?php amp_comments();?>
						<?php do_action('ampforwp_post_after_design_elements'); ?>
					</div>
					<?php } ?>
				</div>
				<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
				<div class="sp-lt">
					<?php if (isset($redux_builder_amp['swift-social-position']) && 'default' == $redux_builder_amp['swift-social-position']){
						ampforwp_swift_social_icons(); 
						}
						if ( 'default' ==  ampforwp_get_setting('swift-add-this-position') ){
								echo ampforwp_addThis_support(); 
						} ?>
		            <?php if( isset($redux_builder_amp['amp-author-name']) && $redux_builder_amp['amp-author-name'] ) { ?>
			            <div class="sp-athr">
			            	<span class="athr-tx"><?php echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-published-by'], 'Published by' )); ?></span>
			            	<?php amp_author_box(); ?>
			            </div>
			         <?php } ?>   
		            <?php if( true == $redux_builder_amp['ampforwp-tags-single'] && amp_tags_list()){ ?>
			            <div class="tags">
			            	<?php amp_tags_list();?>
			            </div>
		            <?php } 
		            if( true == $redux_builder_amp['swift-date'] ) { ?>
			            <div class="post-date">
			            	<?php amp_date(); ?><?php edit_post_link(); ?>
			            </div>

		            <?php }
		            if ( ampforwp_get_setting('rp_design_type') == '1' && true == ampforwp_get_setting('ampforwp-single-related-posts-switch')) {
					$my_query = ampforwp_related_post_loop_query();
				  	if( $my_query->have_posts() ) { $r_count = 1;?>
				  	<div class="srp">
			            <ul class="clearfix">
					        <?php ampforwp_related_post(); ?>
					        <?php
					          while( $my_query->have_posts() ) {
					            $my_query->the_post();
					        ?>
					        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
					        	<?php if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) { if(ampforwp_has_post_thumbnail()){?>
						            <div class="rlp-image">     
						                 <?php ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>220,'image_crop_height'=>134) );?>
									</div>
								<?php } } ?>	
								<div class="rlp-cnt">
									<?php 
									$show_excerpt_opt = $redux_builder_amp['ampforwp-single-related-posts-excerpt'];
									$argsdata = array(
											'show_author' => false,
											'show_excerpt' => $show_excerpt_opt
												);
									ampforwp_get_relatedpost_content($argsdata); ?> 
						        </div>
					        </li><?php
			            			do_action('ampforwp_between_related_post',$r_count);
                 							 $r_count++;
					        }
					      } ?>
	      				</ul>
	      			</div>
		            <?php wp_reset_postdata(); } ?>
				</div>
				<?php } ?>
		    </div>
		</div>
	</div>
<?php  }
do_action("ampforwp_single_design_type_handle");
	?>
<?php if($redux_builder_amp['rp_design_type'] == '2' || $redux_builder_amp['rp_design_type'] == '3'){
       if ( isset($redux_builder_amp['ampforwp-single-related-posts-switch']) && $redux_builder_amp['ampforwp-single-related-posts-switch'] ) {
		$my_query = ampforwp_related_post_loop_query();
	  	if( $my_query->have_posts() ) { $r_count = 1;?>
	  	<div class="srp">
	  		<div class="cntr">
	  		<?php ampforwp_related_post(); ?>
	            <ul class="clearfix">
			        <?php
			          while( $my_query->have_posts() ) {
			            $my_query->the_post();
			        ?>
			        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
			        	<?php if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) { if(ampforwp_has_post_thumbnail()){?>
				            <div class="rlp-image">     
				                 <?php ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>220,'image_crop_height'=>134) );?>
							</div>
						<?php } } ?>	
						<div class="rlp-cnt">
							<?php $argsdata = array(
									'show_author' => false,
									'show_excerpt' =>false
										);
							ampforwp_get_relatedpost_content($argsdata); ?> 
				        </div>
			        </li><?php
	            			do_action('ampforwp_between_related_post',$r_count);
	     							 $r_count++;
			        }
			      } ?>
				</ul>
			</div>
		</div>
    <?php wp_reset_postdata(); }  } ?>	
<?php if($redux_builder_amp['single-design-type'] == '1' && isset($redux_builder_amp['ampforwp-swift-recent-posts']) && $redux_builder_amp['ampforwp-swift-recent-posts']=='1' && !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
<div class="r-pf">
	<div class="cntr">
		<h3><?php echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-recent-text'], 'Recent Posts' )); ?></h3>
	<?php while( amp_loop('start', array( 'posts_per_page' => 6 ) ) ): ?>
		<div class="fsp">
			<?php if( ampforwp_has_post_thumbnail() ){
				$width 	= 346;
				$height = 188;
				if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
					$width 	= $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
					$height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
				}
				$args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
			    <div class="fsp-img">
			    	<?php amp_loop_image($args); ?>
			    </div>
		    <?php } ?>
		    <div class="fsp-cnt">
		    	<?php amp_loop_category(); ?>
			    <?php amp_loop_title(); ?>
			    <?php amp_loop_excerpt(20); ?>
			    <div class="pt-dt">
			    	<?php amp_loop_date(); ?>
			    </div>
		    </div>
		</div>
	<?php endwhile; amp_loop('end');  ?>
	</div>
</div>
</div>
<?php } ?>
<?php if($redux_builder_amp['single-design-type'] == '4'){?>
	<div class="sp sgl">
	<div class="cntr">
		<div class="sp-wrap">
			<div class="sp-artl">
				<div class="sp-left">
					<?php if( !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
						<?php if ( true == $redux_builder_amp['ampforwp-bread-crumb'] ) {
							amp_breadcrumb();
						}?>
						<?php amp_categories_list();?>
						<?php amp_title(); ?>
						<?php if( true == $redux_builder_amp['enable-excerpt-single'] ){ ?>
							<div class="tl-exc">
							   <?php amp_excerpt(20); ?>
						    </div>
						<?php } ?>
						<?php if ( isset($redux_builder_amp['swift-featued-image']) && $redux_builder_amp['swift-featued-image'] && ampforwp_has_post_thumbnail() ) { ?>
							<div class="sf-img">
								<?php amp_featured_image();?>
							</div>
						<?php }
					}?>
					<div class="sp-cnt">
						<div class="sp-rl">
							<div class="sp-rt">
								<div class="cntn-wrp artl-cnt">
									<?php amp_content(); ?>
								</div>
								<?php if( !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
								<div class="ss-ic">
									<span class="shr-txt"><?php echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-share-text'], 'Share' )); ?></span>
									<ul>
										<?php if($redux_builder_amp['enable-single-facebook-share']){?>
										<li>
											<a class="s_fb" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
										</li>
										<?php } ?>
										<?php if($redux_builder_amp['enable-single-twitter-share']){?>
										<li>
											<a class="s_tw" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>">
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
										<?php if(ampforwp_get_setting('enable-single-line-share') == true)  {
										$line_share = 'http://line.me/R/msg/text/';
										$amp_permalink = get_the_permalink();
										$amp_permalink = add_query_arg($amp_permalink,'', $line_share );	
										?>
			<li>
			<a title="line share" class="s_li" href="http://line.me/R/msg/text/?<?php echo esc_url($amp_permalink); ?>">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="15" height="15" />

			</a>
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
										<?php if ( isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
										<li>
											<a class="s_ym" target="_blank" href="http://www.yummly.com/urb/verify?url=<?php the_permalink(); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&yumtype=button"></a>
										</li>
										<?php } ?>
										<?php if($redux_builder_amp['ampforwp-facebook-like-button']){?>
										<li>
											<amp-facebook-like width=90 height=28
							 					layout="fixed"
							 					data-size="large"
							    				data-layout="button_count"
							    				data-href="<?php echo esc_url(get_the_permalink());?>">
											</amp-facebook-like>
										</li>
										<?php } ?>

									</ul>
					            </div>
					            <?php if( true == $redux_builder_amp['ampforwp-tags-single'] && amp_tags_list()){ ?>
						            <div class="tags">
						            	<?php amp_tags_list();?>
						            </div>
					            <?php } 
					            if( true == $redux_builder_amp['swift-date'] ) { ?>
						            <div class="post-date">
						            	<?php amp_date(); ?><?php edit_post_link(); ?>
						            </div>
					            <?php }
					             if( $redux_builder_amp['amp-author-description'] ) { ?>
									<?php amp_author_box( 
										array(	'avatar'=>true,
												'avatar_size'=>60,
												'author_description'=>true,
												'ads_below_the_author'=>true)
										); ?>
								<?php } ?>
								<?php amp_post_navigation();?>
								<div class="cmts">
									<?php amp_comments();?>
									<?php do_action('ampforwp_post_after_design_elements'); ?>
								</div>
					            <?php
					            if ( isset($redux_builder_amp['ampforwp-single-related-posts-switch']) && $redux_builder_amp['ampforwp-single-related-posts-switch'] ) {
								$my_query = ampforwp_related_post_loop_query();
							  	if( $my_query->have_posts() ) { $r_count = 1;?>
							  	<div class="srp">
							  		<?php ampforwp_related_post(); ?>
						            <ul class="clearfix">
								        <?php
								          while( $my_query->have_posts() ) {
								            $my_query->the_post();
								        ?>
								        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
								        	<?php if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) { ?>
									            <div class="rlp-image">     
									                 <?php ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>220,'image_crop_height'=>134) );?>
												</div>
											<?php } ?>	
											<div class="rlp-cnt">
												<?php 
												$show_excerpt_opt = $redux_builder_amp['ampforwp-single-related-posts-excerpt'];

												$argsdata = array(
														'show_author' => false,
														'show_excerpt' => $show_excerpt_opt
															);
												ampforwp_get_relatedpost_content($argsdata); ?> 
									        </div>
								        </li><?php
						            			do_action('ampforwp_between_related_post',$r_count);
			                 							 $r_count++;
								        }
								      } ?>
				      				</ul>
				      			</div>
					            <?php wp_reset_postdata(); } 
					        	} ?>
							</div><!-- /.sp-rt -->
					    </div><!-- /.sp-rl -->
					</div><!-- /.sp-cntn -->
					<?php if( $redux_builder_amp['single-design-type'] == '4' && isset($redux_builder_amp['ampforwp-swift-recent-posts']) && $redux_builder_amp['ampforwp-swift-recent-posts']=='1' && !checkAMPforPageBuilderStatus(get_the_ID()) ) {?>
					<div class="r-pf">
						<h3><?php echo ampforwp_translation($redux_builder_amp['amp-translator-recent-text'], 'Recent Posts' ); ?></h3>
						<?php while( amp_loop('start', array( 'posts_per_page' => 6 ) ) ): ?>
							<div class="fsp">
								<?php
								if(ampforwp_has_post_thumbnail()){
									$width 	= 346;
									$height = 188;
									if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
										$width 	= $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
										$height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
									} 
									$args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
								    <div class="fsp-img">
								    	<?php amp_loop_image($args); ?>
								    </div>
							    <?php } ?>
							    <div class="fsp-cnt">
							    	<?php amp_loop_category(); ?>
								    <?php amp_loop_title(); ?>
								    <?php amp_loop_excerpt(20); ?>
								    <div class="pt-dt">
								    	<?php amp_loop_date(); ?>
								    </div>
							    </div>
							</div>
						<?php endwhile; amp_loop('end');  ?>
					</div>
					<?php } ?>
				</div><!-- /.sp-left -->
				<?php if( $redux_builder_amp['swift-sidebar'] == '1' && !checkAMPforPageBuilderStatus(get_the_ID()) ){ ?>
				<?php if ( is_active_sidebar( 'swift-sidebar' ) ) : ?>
				<div class="sdbr-right">
					<?php 
						$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-sidebar');
						if ( $sanitized_sidebar) {
							$sidebar_output = $sanitized_sidebar->get_amp_content();
							$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
						}
			            echo do_shortcode($sidebar_output); // amphtml content, no kses
					?>
				</div>
			<?php endif; ?>
				<?php } ?>
			</div><!-- /.sp-artl -->
		</div><!-- /.sp-wrap -->
	</div><!-- /.container -->
<?php //} 
do_action("ampforwp_single_design_type_handle");
	?>
</div>
<?php }// New single desing Ends?>
	<?php amp_footer()?>