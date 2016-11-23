<div class="amp-wp-article-content">
		<div class="amp-wp-content the_content">
				<?php do_action('ampforwp_before_post_content') ?>
				
						<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
						
				<?php do_action('ampforwp_after_post_content') ?>
		</div>
		<div class="amp-wp-content post-pagination-meta">
					<div id="pagination">
						<div class="next">
							<?php $next_post = get_next_post();
								if (!empty( $next_post )) { ?>
										<a href="<?php echo get_permalink( $next_post->ID ) . AMP_QUERY_VAR; ?>"><?php echo $next_post->post_title; ?> &raquo;</a> <?php
									} ?>
						</div>
						<div class="prev">
								<?php $prev_post = get_previous_post();
									 if (!empty( $prev_post )) { ?>
									   <a href="<?php echo get_permalink( $prev_post->ID ). AMP_QUERY_VAR; ?>"> &laquo; <?php echo $prev_post->post_title ?></a> <?php
									 } ?>
						</div>
							<div class="clearfix"></div>
					</div>
		</div>
</div>
