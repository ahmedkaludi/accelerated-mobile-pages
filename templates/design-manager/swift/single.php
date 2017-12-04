<?php amp_header(); ?>
<div class="sp">
	<div class="cntr">
		<?php amp_categories_list();?>
		<?php amp_title(); ?>
	</div>
	<div class="sf-img">
		<?php amp_featured_image();?>
	</div>
	<div class="sp-cnt">
		<div class="cntr">
			<div class="sp-rl">
				<div class="sp-rt">
					<?php amp_content(); ?>
					<?php amp_post_pagination();?>
					<div class="cmts">
						<?php amp_comments();?>
					</div>
					<?php amp_post_navigation();?>
				</div>
				<div class="sp-lt">
					<div class="ss-icons">
						<span class="shr-txt">SHARE</span>
						<?php amp_social([
		                'twitter' => 'https://twitter.com/ampforwp',
		                'facebook' => 'https://facebook.com/ampforwp',
		                'linkedin'  => 'https://linkedin.com/ampforwp'
		            	]);?> 
		            </div>
		            <div class="sp-athr">
		            	<span class="athr-tx">WRITTEN BY</span>
		            	<?php amp_author_box(); ?>
		            </div>
		            <div class="tags">
		            	<span class="lbl-tx">TAGS</span>
		            	<?php amp_tags_list();?>
		            </div>
		            <div class="post-date">
		            	<?php amp_date(); ?>
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
					                 <?php ampforwp_get_relatedpost_image('medium');?>
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
		<?php amp_loop_template(); ?>
	</div>
	<?php amp_footer()?>
</div>