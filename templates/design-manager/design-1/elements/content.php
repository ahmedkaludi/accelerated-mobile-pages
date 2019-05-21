<?php global $redux_builder_amp; ?>
<?php do_action('ampforwp_before_content_hook',$this); ?>

<div class="amp-wp-article-content">
	<div class="amp-wp-content the_content">
	<?php amp_content(); ?>
	</div>
	<!--Post Next-Previous Links-->
	<?php
		if($redux_builder_amp['enable-single-next-prev'] && !is_page() ) { ?>
			<!--IF Starts here-->
			<div class="amp-wp-content post-pagination-meta">
				<div id="pagination">
					<?php $next_post = get_next_post();
					if (!empty( $next_post )) { ?>
						<div class="next">
							<?php $next_text = $next_post->post_title; ?>
								<a href="<?php echo ampforwp_url_controller( get_permalink( $next_post->ID ) ); ?>"><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a>
						</div>
					<?php } 
					
					$prev_post = get_previous_post();
					if (!empty( $prev_post )) { ?>
						<div class="prev">
							<?php $prev_text = $prev_post->post_title; ?>
							<a href="<?php echo ampforwp_url_controller( get_permalink( $prev_post->ID ) ); ?>"> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a>
						</div>
					<?php } ?>
					<div class="cb"></div>
				</div>
			</div>
			<!--IF Ends here-->
		<?php } ?>
	<!--Post Next-Previous Links End here-->

</div>
