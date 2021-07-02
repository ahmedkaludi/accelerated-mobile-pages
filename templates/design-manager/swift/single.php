<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; ?>
<?php amp_header(); 
$paged = get_query_var( 'paged' );
$page = get_query_var( 'page' );
$page = intval($page); ?>
<?php if(ampforwp_get_setting('single-design-type') == '1'){?>
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
				   <?php amp_excerpt(); ?>
			    </div>
			<?php } ?>
			<?php 
			if( true == ampforwp_get_setting('amp-author-name') && true == ampforwp_get_setting('amp-author-name-display') ) {?>
			    <div class="sp-athr mob-athr">
			        <span class="athr-tx"><?php echo ampforwp_translation(ampforwp_get_setting('amp-translator-published-by'), 'Published by' ); ?></span>
			            <?php amp_author_box( 
							array('author_pub_name'=>true,'author_info'=>true)
						); ?>
			    </div>
			 <?php } 
			if( true == ampforwp_get_setting('swift-date') && true == ampforwp_get_setting('amp-published-date-display')) { ?>
			            <div class="post-date mob-date">
			            	<?php amp_date(); ?><?php edit_post_link(); ?>
			            </div>
					<?php do_action('ampforwp_post_views_ctr'); ?> 
		            <?php } ?>
		</div>
		<?php 
	   	if($paged==0 && $page==0){
	   		if ( ampforwp_get_setting('swift-featued-image') && ampforwp_has_post_thumbnail() ) { ?>
			<?php if ( ampforwp_get_setting('swift-featued-image-type') == 1 || empty(ampforwp_get_setting('swift-featued-image-type')) ) { ?>
			<div class="sf-img">
				<?php amp_featured_image();?>
			</div>
			<?php }	// Swift Featured Image Type 1
		}
	}
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
						<?php 
				    if($paged==0 && $page==0){
						if ( ampforwp_get_setting('swift-featued-image') && ampforwp_has_post_thumbnail() ) { ?>
							<?php if ( ampforwp_get_setting('swift-featued-image-type') == 2) { ?>
								<div class="sf-img">
									<?php amp_featured_image();?>	
								</div>	
							<?php }	// Swift Featured Image Type 2
						} // Swift Featured Image 
					}?>
						<?php 
					// if you want to add anything before or after the content then you can use 'ampforwp_before_post_content' or 'ampforwp_after_post_content' hooks and here is the list of all our hooks - https://ampforwp.com/tutorials/article/hooks-in-ampforwp/
					amp_content(); 
					?>
					</div>
					<?php do_action( 'ampforwp_after_the_post_content_wrp' ); ?>
					<?php if (isset($redux_builder_amp['swift-social-position']) && 'below-content' == $redux_builder_amp['swift-social-position']){
						ampforwp_swift_social_icons(); 
						}
						if ( 'below-content' ==  ampforwp_get_setting('swift-add-this-position') ){
							echo ampforwp_addThis_support();
						} ?>
					<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
					<?php 
 						$author_box = array();
						if( true == ampforwp_get_setting('amp-author-description') ) { ?>	
						<?php
						$author_box = array( 'avatar'=>true,
													'avatar_size'=>60,	
													'author_description'=>true,	
													'ads_below_the_author'=>true);
						if( true == ampforwp_get_setting('amp-author-bio-name')){
							$author_box['author_pub_name'] = true ;
						}
						amp_author_box( $author_box ); ?>	
					<?php } ?>
					<?php amp_post_navigation();?>
					<?php if ((true == ampforwp_get_setting('wordpress-comments-support') && comments_open()) || true == ampforwp_get_setting('ampforwp-disqus-comments-support') || true == ampforwp_get_setting('ampforwp-facebook-comments-support') ||true == ampforwp_get_setting('ampforwp-vuukle-comments-support') ||true == ampforwp_get_setting('ampforwp-spotim-comments-support') ){ ?>
					<div class="cmts">
						<?php amp_comments();?>
					</div>
					<?php } ?>
						<?php do_action('ampforwp_post_after_design_elements'); ?>
					<?php } ?>
				</div>
				<?php if(!checkAMPforPageBuilderStatus(get_the_ID()) && (true == ampforwp_get_setting('enable-single-post-social-icons') || true == ampforwp_get_setting('amp-author-name') || true == ampforwp_get_setting('swift-date') || true == ampforwp_get_setting('ampforwp-single-related-posts-switch'))){ ?>
				<div class="sp-lt">
					<?php if (isset($redux_builder_amp['swift-social-position']) && 'default' == $redux_builder_amp['swift-social-position']){
						ampforwp_swift_social_icons(); 
						}
						if ( 'default' ==  ampforwp_get_setting('swift-add-this-position') ){
								echo ampforwp_addThis_support(); 
						} ?>
		              <?php if( true == ampforwp_get_setting('amp-author-name') ) { ?>
			            <div class="sp-athr desk-athr">
			            	<span class="athr-tx"><?php echo ampforwp_translation($redux_builder_amp['amp-translator-published-by'], 'Published by' ); ?></span>
			            	<?php amp_author_box( 
										array('author_pub_name'=>true,'author_info'=>true)
										); ?>
			            </div>
			         <?php } ?>    
		            <?php if( true == $redux_builder_amp['ampforwp-tags-single'] && amp_tags_list()){ ?>
			            <div class="tags">
			            	<?php amp_tags_list();?>
			            </div>
		            <?php } 
		             if( true == ampforwp_get_setting('swift-date') ) { ?>
			            <div class="post-date desk-date">
			            	<?php amp_date(); ?><?php edit_post_link(); ?>
			            </div>
                          <?php do_action('ampforwp_post_views_ctr'); ?>
		            <?php }
		            if ( ampforwp_get_setting('rp_design_type') == '1' && true == ampforwp_get_setting('ampforwp-single-related-posts-switch')) {
					$my_query = ampforwp_related_post_loop_query();
				  	if( $my_query->have_posts() ) { $r_count = 1;?>
				  	<div class="srp">
			            <ul class="clearfix">
					        <?php ampforwp_related_post(); ?>
					        <?php
					          $current_id = ampforwp_get_the_ID();	
					          while( $my_query->have_posts() ) {
					            $my_query->the_post();
					          if(ampforwp_get_the_ID()==$current_id){
					            continue;
					          }
					        ?>
					        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
					        	<?php if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) { if(ampforwp_has_post_thumbnail()){?>
						            <div class="rlp-image">     
						                 <?php 
							                $r_width = 220;
											$r_height = 134;

									 if ( ampforwp_get_setting('ampforwp-single-related-posts-change-image-size') ) {
											$r_width = ampforwp_get_setting('ampforwp-single-related-posts-image-width');
											$r_height = ampforwp_get_setting('ampforwp-single-related-posts-image-height');
										}
							                 ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>esc_attr($r_width),'image_crop_height'=>esc_attr($r_height)) );
							            ?>
									</div>
								<?php } } ?>	
								<div class="rlp-cnt">
									<?php 
									$show_excerpt_opt = ampforwp_get_setting('ampforwp-single-related-posts-excerpt');
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
	      			<?php do_action('ampforwp_below_related_post'); ?>
		            <?php wp_reset_postdata(); } ?>
				</div>
				<?php } ?>
		    </div>
		</div>
	</div>
<?php 
do_action("ampforwp_single_design_type_handle_d1"); 
	?>
<?php if( ampforwp_get_setting('single-design-type') == '1' && ampforwp_get_setting('rp_design_type') == '2'){
       if ( true == ampforwp_get_setting('ampforwp-single-related-posts-switch') && !checkAMPforPageBuilderStatus(get_the_ID()) ) {
		$my_query = ampforwp_related_post_loop_query();
	  	if( $my_query->have_posts() ) { $r_count = 1;?>
	  	<div class="srp">
	  		<div class="cntr">
	  		<?php ampforwp_related_post(); ?>
	            <ul class="clearfix">
			        <?php
			          $current_id = ampforwp_get_the_ID();	
			          while( $my_query->have_posts() ) {
			            $my_query->the_post();
			          if(ampforwp_get_the_ID()==$current_id){
			            continue;
			           }
			        ?>
			        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
			        	<?php if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) { if(ampforwp_has_post_thumbnail()){?>
				            <div class="rlp-image">     
				                <?php 
				                $r_width = 220;
								$r_height = 134;
								if ( ampforwp_get_setting('ampforwp-single-related-posts-change-image-size') ) {
										$r_width = ampforwp_get_setting('ampforwp-single-related-posts-image-width');
										$r_height = ampforwp_get_setting('ampforwp-single-related-posts-image-height');
									}
				                 ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>esc_attr($r_width),'image_crop_height'=>esc_attr($r_height)) );?>
							</div>
						<?php } } ?>	
						<div class="rlp-cnt">
							<?php
							$show_excerpt_opt = ampforwp_get_setting('ampforwp-single-related-posts-excerpt');
							$argsdata = array(
									'show_author' =>  false,
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
			<?php do_action('ampforwp_below_related_post'); ?>
		</div>
    <?php wp_reset_postdata(); }  } ?>
<?php if( ampforwp_get_setting('single-design-type') == '1' && ampforwp_get_setting('rp_design_type') == '3'){
       if ( true == ampforwp_get_setting('ampforwp-single-related-posts-switch') && !checkAMPforPageBuilderStatus(get_the_ID()) ) {
		$my_query = ampforwp_related_post_loop_query();
	  	if( $my_query->have_posts() ) { $r_count = 1;?>
	  	<div class="srp">
	  		<div class="cntr">
	  		<?php ampforwp_related_post(); ?>
	            <amp-carousel height="310" layout="fixed-height" type="carousel">
			        <?php
			          $current_id = ampforwp_get_the_ID();
			          while( $my_query->have_posts() ) {
			            $my_query->the_post();
			           if(ampforwp_get_the_ID()==$current_id){
			            	continue;
			            } 
			        ?>
			        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
			        	<div class="rp-slide">
			        	<?php if ( true == ampforwp_get_setting('ampforwp-single-related-posts-image') ) { if(ampforwp_has_post_thumbnail()){?>
				            <div class="rlp-image">     
				                 <?php 
				                $r_width = 346;
								$r_height = 188;
								if ( ampforwp_get_setting('ampforwp-single-related-posts-change-image-size') ) {
										$r_width = ampforwp_get_setting('ampforwp-single-related-posts-image-width');
										$r_height = ampforwp_get_setting('ampforwp-single-related-posts-image-height');
									}
				                 ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>esc_attr($r_width),'image_crop_height'=>esc_attr($r_height)) );?>
							</div>
						<?php } } ?>	
							<div class="rlp-cnt">
								<?php 
								$show_excerpt_opt = ampforwp_get_setting('ampforwp-single-related-posts-excerpt');
								$argsdata = array(
										'show_author' => false,
										'read_more' => false,
										'show_excerpt' => $show_excerpt_opt
											);
								ampforwp_get_relatedpost_content($argsdata); ?> 
					        </div>
				    	</div>
			        </li><?php
	            			do_action('ampforwp_between_related_post',$r_count);
	     							 $r_count++;
			        }
			      } ?>
				</amp-carousel>
			</div>
		</div>
		<?php do_action('ampforwp_below_related_post'); ?>
	<?php wp_reset_postdata(); }  } ?>	
<?php if(ampforwp_get_setting('single-design-type') == true && ampforwp_get_setting('ampforwp-swift-recent-posts')=='1' && !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
	<div class="r-pf">
		<div class="cntr">
		<?php 	
			$args = array(
				'posts_per_page' => 2,
				'fields' => 'ids',
			);
		$results = get_posts($args);
 		$check_rp= count($results);
		if ($check_rp > 1) {?>
			<h3><?php 
			if (function_exists('pll__')) {
				echo pll__(esc_html__( ampforwp_get_setting('amp-translator-recent-text'), 'accelerated-mobile-pages'));
			}else {
				echo esc_html(ampforwp_translation(ampforwp_get_setting('amp-translator-recent-text'), 'Recent Posts' ));
			}?></h3>
		<?php }
		$number_of_posts = 6;
		$rcp = ampforwp_get_setting('ampforwp-number-of-recent-posts');
		if( !empty($rcp) ){
			$number_of_posts = (int) ampforwp_get_setting('ampforwp-number-of-recent-posts');
		}
		while( amp_loop('start', array( 'posts_per_page' => $number_of_posts ) ) ): ?>
			<div class="fsp">
				<?php if( ampforwp_has_post_thumbnail() ){
					$width 	= 346;
					$height = 188;
					if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
						$width 	= $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
						$height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
					}
					$args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
					<?php if( ampforwp_get_setting('amforwp-recentpost-image-switch') == true){?>
				    <div class="fsp-img">
				    	<?php amp_loop_image($args); ?>
				    </div>
				<?php } ?>
			    <?php } ?>
			    <div class="fsp-cnt">
			    	<?php amp_loop_category(); ?>
				   	<?php amp_loop_title(); ?>
				    <?php if( true == ampforwp_get_setting('amforwp-recentpost-excerpt-switch') ){
				   				$excep_len = 15;
                                if(ampforwp_get_setting('amp-swift-recentpost-excerpt-len') && is_numeric(ampforwp_get_setting('amp-swift-recentpost-excerpt-len'))){
                                    $excep_len = intval(ampforwp_get_setting('amp-swift-recentpost-excerpt-len'));
                                }
                                amp_loop_excerpt($excep_len);
				   			}
				   		if( true == ampforwp_get_setting('amforwp-recentpost-date-switch')){ ?>
					    <div class="pt-dt">
					    	<?php amp_loop_date(); ?>
					    </div>
				<?php }?>
			    </div>
			</div>
		<?php endwhile; amp_loop('end');  ?>
		</div>
	</div>
<?php } // Recent Posts End Here ?>
</div>
<?php } // Single Design 1 ends here  ?>
<?php if($redux_builder_amp['single-design-type'] == '4'){ ?>
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
							   <?php amp_excerpt(); ?>
						    </div>
						<?php } ?>
						<?php 
					   	if($paged==0 && $page==0){
					   		if ( ampforwp_get_setting('swift-featued-image') && ampforwp_has_post_thumbnail() ) { ?>
							<div class="sf-img">
								<?php amp_featured_image();?>
							</div>
						<?php }
						}
					}?>
					<div class="sp-cnt">
						<div class="sp-rl">
							<div class="sp-rt">
							<?php if (true == ampforwp_get_setting('swift-social-position') && 'above-content' == ampforwp_get_setting('swift-social-position')){
								ampforwp_swift_social_icons(); 
							}?>
								<div class="cntn-wrp artl-cnt">
									<?php 
									if ( 'above-content' ==  ampforwp_get_setting('swift-layout-addthis-pos') ){
										echo ampforwp_addThis_support(); 
									} ?>
									<?php amp_content(); 
									if ( 'below-content' ==  ampforwp_get_setting('swift-layout-addthis-pos') ){
											echo ampforwp_addThis_support();
									}	?>
								</div>
								<?php do_action( 'ampforwp_after_the_post_content_wrp' ); ?>
								<?php if( !checkAMPforPageBuilderStatus(get_the_ID()) ) { ?>
								<div class="ss-ic">
								<?php if (true == ampforwp_get_setting('swift-social-position') && 'below-content' == ampforwp_get_setting('swift-social-position')){
									ampforwp_swift_social_icons(); 
								}?>
					            </div>
					            <?php if( true == $redux_builder_amp['ampforwp-tags-single'] && amp_tags_list()){ ?>
						            <div class="tags">
						            	<?php amp_tags_list();?>
						            </div>
					            <?php } 
					             if( true == ampforwp_get_setting('swift-date') ) { ?>
						            <div class="post-date">
						            	<?php amp_date(); ?><?php edit_post_link(); ?>
						            </div>
					            <?php }
					             $author_box = array();
					              if( true == ampforwp_get_setting('amp-author-description') ) { ?>
									<?php
									$author_box = array( 'avatar'=>true,
													'avatar_size'=>60,	
													'author_description'=>true,	
													'ads_below_the_author'=>true);
								if( true == ampforwp_get_setting('amp-author-bio-name')){
									$author_box['author_pub_name'] = true;
								}
								amp_author_box( $author_box );?>
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
								          $current_id = ampforwp_get_the_ID();
								          while( $my_query->have_posts() ) {
								            $my_query->the_post();
								          if(ampforwp_get_the_ID()==$current_id){
								            continue;
								           } 
								        ?>
								        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
								        	<?php if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) { ?>
									            <div class="rlp-image">     
									                <?php 
											            $r_width = 346;
														$r_height = 188;
													if ( ampforwp_get_setting('ampforwp-single-related-posts-change-image-size') ) {
															$r_width = ampforwp_get_setting('ampforwp-single-related-posts-image-width');
															$r_height = ampforwp_get_setting('ampforwp-single-related-posts-image-height');
														}
											             ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>esc_attr($r_width),'image_crop_height'=>esc_attr($r_height)) );?>
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
								       ?>
				      				</ul>
				      			</div>
					            <?php }
					            wp_reset_postdata(); } 
					        	} ?>
							</div><!-- /.sp-rt -->
					    </div><!-- /.sp-rl -->
					</div><!-- /.sp-cntn -->
					<?php if( $redux_builder_amp['single-design-type'] == '4' && ampforwp_get_setting('ampforwp-swift-recent-posts')=='1' && !checkAMPforPageBuilderStatus(get_the_ID()) ) {?>
					<div class="r-pf">
						<h3><?php echo ampforwp_translation($redux_builder_amp['amp-translator-recent-text'], 'Recent Posts' ); ?></h3>
						<?php
						$number_of_posts = 6;
						$rcp = ampforwp_get_setting('ampforwp-number-of-recent-posts');
						if( !empty($rcp) ){
							$number_of_posts = (int) ampforwp_get_setting('ampforwp-number-of-recent-posts');
						}
						while( amp_loop('start', array( 'posts_per_page' => $number_of_posts ) ) ): ?>
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
									<?php 
								if( ampforwp_get_setting('amforwp-recentpost-image-switch') == true){
								?>
								    <div class="fsp-img">
								    	<?php amp_loop_image($args); ?>
								    </div>
								<?php } ?>
							    <?php } ?>
							    <div class="fsp-cnt">
							    	<?php amp_loop_category(); ?>
								    <?php amp_loop_title(); ?>
								    <?php if( true == ampforwp_get_setting('amforwp-recentpost-excerpt-switch') ){
							   				amp_loop_excerpt(20);
							   			} ?>
				<?php if( true == ampforwp_get_setting('amforwp-recentpost-date-switch')){?>
							    <div class="pt-dt">
							    	<?php amp_loop_date(); ?>
							    </div>
				<?php }?>
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
						$sidebar_output = '';
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
</div>
<?php }// New single desing Ends?>
<?php do_action("ampforwp_single_design_type_handle"); ?>
	<?php amp_footer()?>