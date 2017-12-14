<?php global $redux_builder_amp; ?>
<?php amp_header(); ?>
<div class="sp">
	<div class="cntr">
		<?php amp_breadcrumb();?>
		<?php amp_categories_list();?>
		<?php amp_title(); ?>
		<?php if( true == $redux_builder_amp['enable-excerpt-single'] ){ ?>
			<div class="tl-exc">
			   <?php amp_excerpt(20); ?>
		    </div>
	    <?php } ?>
	</div>
	<div class="sf-img">
		<?php amp_featured_image();?>
	</div>
	<div class="sp-cnt">
		<div class="cntr">
			<div class="sp-rl">
				<div class="sp-rt">
					<div class="cntn-wrp">
						<?php amp_content(); ?>
					</div>
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
				</div>
				<div class="sp-lt">
					<div class="ss-icons">
						<span class="shr-txt"><?php echo ampforwp_translation($redux_builder_amp['amp-translator-share-text'], 'Share' ); ?></span>
						<?php amp_social([
		                'twitter' => 'https://twitter.com/ampforwp',
		                'facebook' => 'https://facebook.com/ampforwp',
		                'linkedin'  => 'https://linkedin.com/ampforwp'
		            	]);?> 
		            </div>
		            <div class="sp-athr">
		            	<span class="athr-tx"><?php echo ampforwp_translation($redux_builder_amp['amp-translator-published-by'], 'Published by' ); ?></span>
		            	<?php amp_author_box(); ?>
		            </div>
		            <?php if( true == $redux_builder_amp['ampforwp-tags-single'] && amp_tags_list()){ ?>
			            <div class="tags">
			            	<?php amp_tags_list();?>
			            </div>
		            <?php } ?>
		            <div class="post-date">
		            	<?php amp_date(); ?><?php edit_post_link(); ?>
		            </div>
		            <?php
					$my_query = related_post_loop_query();
				  	if( $my_query->have_posts() ) { ?>
				  	<div class="srp">
			            <ul class="clearfix">
					        <?php ampforwp_related_post(); ?>
					        <?php
					          while( $my_query->have_posts() ) {
					            $my_query->the_post();
					        ?>
					        <li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
					            <div class="rlp-image">     
					                 <?php ampforwp_get_relatedpost_image('full',array('image_crop'=>'true','image_crop_width'=>220,'image_crop_height'=>134) );?>
								</div>
								<div class="rlp-cnt">
									<?php ampforwp_get_relatedpost_content($argsdata); ?> 
						        </div>
					        </li><?php
					        }
					      } ?>
	      				</ul>
	      			</div>
		            <?php wp_reset_postdata(); ?>
				</div>
		    </div>
		</div>
	</div>
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
	<?php amp_footer()?>
</div>