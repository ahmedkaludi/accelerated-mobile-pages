<?php global $redux_builder_amp; ?>
<?php do_action('ampforwp_before_content_hook',$this); ?>

<div class="amp-wp-article-content">
	<div class="amp-wp-content the_content">
	<?php
	do_action('ampforwp_inside_post_content_before',$this);
		$amp_custom_content_enable = get_post_meta( $this->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);

		// Normal Front Page Content
		if ( ! $amp_custom_content_enable ) {
			$ampforwp_the_content = $this->get( 'post_amp_content' ); // amphtml content; no kses
		} else {
			// Custom/Alternative AMP content added through post meta
			$ampforwp_the_content = $this->get( 'ampforwp_amp_content' );
		}
		//Filter to modify the Content
		$ampforwp_the_content = apply_filters('ampforwp_modify_the_content', $ampforwp_the_content);
		if($redux_builder_amp['amp-pagination']) {
			$ampforwp_new_content = explode('<!--nextpage-->', $ampforwp_the_content);
		      	$queried_var = get_query_var('page');
		      	if ( $queried_var > 1 ) {
		        	$queried_var = $queried_var -1   ;
		      	}
		      	else {
		      		$queried_var = 0;
		      	}
		    echo $ampforwp_new_content[$queried_var];
		} else {
			echo $ampforwp_the_content;
		}//#1015 Pegazee

		do_action('ampforwp_after_post_content',$this) ; ?>
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
								?>
									<a href="<?php echo ampforwp_url_controller( get_permalink( $next_post->ID ) ); ?>"><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a> <?php
								} ?>
					</div>
					<!--Next Link code-->

					<!--Prev Link code-->
					<div class="prev">
							<?php $prev_post = get_previous_post();
								 if (!empty( $prev_post )) {
									 $prev_text = $prev_post->post_title;
									  ?>
								   <a href="<?php echo ampforwp_url_controller( get_permalink( $prev_post->ID ) ); ?>"> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a> <?php
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
