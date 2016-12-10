<div class="amp-wp-article-content">

	<!--Post Content here-->
	<div class="amp-wp-content the_content">

		<?php do_action('ampforwp_before_post_content') //Post before Content here ?>

			<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>

		<?php do_action('ampforwp_after_post_content') ; //Post After Content here ?>

	</div>
	<!--Post Content Ends here-->

	<!--Post Next-Previous Links-->
	<?php global $redux_builder_amp;
		if($redux_builder_amp['enable-single-next-prev']) { ?>
			<!--IF Starts here-->
			<div class="amp-wp-content post-pagination-meta">
				<div id="pagination">

					<!--Next Link code-->
					<div class="next">
						<?php $next_post = get_next_post();
							if (!empty( $next_post )) { ?>
									<a href="<?php echo trailingslashit(get_permalink( $next_post->ID )) . AMP_QUERY_VAR; ?>"><?php echo $next_post->post_title; ?> &raquo;</a> <?php
								} ?>
					</div>
					<!--Next Link code-->

					<!--Prev Link code-->
					<div class="prev">
							<?php $prev_post = get_previous_post();
								 if (!empty( $prev_post )) { ?>
								   <a href="<?php echo trailingslashit(get_permalink( $prev_post->ID )). AMP_QUERY_VAR; ?>"> &laquo; <?php echo $prev_post->post_title ?></a> <?php
								 } ?>
					</div>
					<!--Prev Link code-->

					<!--Clearfix code-->
					<div class="clearfix"></div>
					<!--Clearfix code-->

				</div>
			</div>
			<!--IF Ends here-->
		<?php } ?>
	<!--Post Next-Previous Links End here-->
</div>
