<?php global $redux_builder_amp; ?>
<?php amp_header(); ?>
<?php if($redux_builder_amp['single-design-type'] == '1'){?>
<div class="sp">
	<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
		<div class="cntr">
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
					<div class="cntn-wrp">
						<?php amp_content(); ?>
					</div>
					<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
					<?php if( $redux_builder_amp['amp-author-description'] ) { ?>
						<?php amp_author_box( 
											array(	'avatar'=>true,
													'avatar_size'=>60,
													'author_description'=>true)
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
								<a class="s_pt" target="_blank" href="https://pinterest.com/pin/create/button/?media=<?php echo esc_url($image); ?>&url=<?php esc_url(the_permalink()); ?>&description=<?php the_title(); ?>"></a>
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
							<?php if ( isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
							<li>
								<a class="s_ym" target="_blank" href="http://www.yummly.com/urb/verify?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&yumtype=button"></a>
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
		            <?php if( isset($redux_builder_amp['amp-author-name']) && $redux_builder_amp['amp-author-name'] ) { ?>
			            <div class="sp-athr">
			            	<span class="athr-tx"><?php echo ampforwp_translation($redux_builder_amp['amp-translator-published-by'], 'Published by' ); ?></span>
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
		            if ( isset($redux_builder_amp['ampforwp-single-related-posts-switch']) && $redux_builder_amp['ampforwp-single-related-posts-switch'] ) {
					$my_query = related_post_loop_query();
				  	if( $my_query->have_posts() ) { $r_count = 1;?>
				  	<div class="srp">
			            <ul class="clearfix">
					        <?php ampforwp_related_post(); ?>
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
		            <?php wp_reset_postdata(); } ?>
				</div>
				<?php } ?>
		    </div>
		</div>
	</div>
<?php } 
do_action("ampforwp_single_design_type_handle");
	?>
<?php if($redux_builder_amp['single-design-type'] == '1' && isset($redux_builder_amp['ampforwp-swift-recent-posts']) && $redux_builder_amp['ampforwp-swift-recent-posts']=='1' && !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
<div class="r-pf">
	<div class="cntr">
		<h3><?php echo ampforwp_translation($redux_builder_amp['amp-translator-recent-text'], 'Recent Posts' ); ?></h3>
	<?php while( amp_loop('start', array( 'posts_per_page' => 6 ) ) ): ?>
		<div class="fsp">
			<?php
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
	<div class="sp">
	<div class="cntr">
		<div class="sp-wrap">
			<div class="sp-artl">
				<div class="sp-left">
					<?php if( !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
						<?php amp_breadcrumb();?>
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
								<div class="cntn-wrp">
									<?php amp_content(); ?>
								</div>
								<?php if( !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
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
											<a class="s_pt" target="_blank" href="https://pinterest.com/pin/create/button/?media=<?php echo esc_url($image); ?>&url=<?php esc_url(the_permalink()); ?>&description=<?php the_title(); ?>"></a>
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
										<?php if ( isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
										<li>
											<a class="s_ym" target="_blank" href="http://www.yummly.com/urb/verify?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&yumtype=button"></a>
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
												'author_description'=>true)
										); ?>
								<?php } ?>
								<?php amp_post_navigation();?>
								<div class="cmts">
									<?php amp_comments();?>
									<?php do_action('ampforwp_post_after_design_elements'); ?>
								</div>
					            <?php
					            if ( isset($redux_builder_amp['ampforwp-single-related-posts-switch']) && $redux_builder_amp['ampforwp-single-related-posts-switch'] ) {
								$my_query = related_post_loop_query();
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
				<div class="sdbr-right">
					<?php 
						ob_start();
						dynamic_sidebar('swift-sidebar');
						$swift_footer_widget = ob_get_contents();
						ob_end_clean();
						$sanitizer_obj = new AMPFORWP_Content( 
											$swift_footer_widget,
											array(), 
											apply_filters( 'ampforwp_content_sanitizers', 
												array( 'AMP_Img_Sanitizer' => array(), 
													'AMP_Style_Sanitizer' => array(), 
													'AMP_Blacklist_Sanitizer' => array(),
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