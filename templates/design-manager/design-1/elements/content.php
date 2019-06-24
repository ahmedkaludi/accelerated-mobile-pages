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

					<!--Next Link code-->
					<div class="next">
						<?php $next_post = get_next_post();
							if (!empty( $next_post )) {
								$next_text = $next_post->post_title;
								if(false == ampforwp_get_setting('single-next-prev-to-nonamp')){ ?>
									<a href="<?php echo ampforwp_url_controller( get_permalink( $next_post->ID ) ); ?>"><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a> <?php
									} else{ ?>
									<a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a>	
								<?php } } ?>
					</div>
					<!--Next Link code-->

					<!--Prev Link code-->
					<div class="prev">
							<?php $prev_post = get_previous_post();
								 if (!empty( $prev_post )) {
									 $prev_text = $prev_post->post_title;
									if(false == ampforwp_get_setting('single-next-prev-to-nonamp')){ ?>
								   <a href="<?php echo ampforwp_url_controller( get_permalink( $prev_post->ID ) ); ?>"> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a> <?php
								   } else{ ?> 
								   	<a href="<?php echo get_permalink( $prev_post->ID ); ?>"> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a>
								 <?php } } ?>
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
