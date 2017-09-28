<div class="amp-wp-article-content">
	<!--Post Content here-->
	<div class="amp-wp-content the_content">
		<?php global $redux_builder_amp;
if( array_key_exists( 'enable-excerpt-single' , $redux_builder_amp ) ) {
	if($redux_builder_amp['enable-excerpt-single']) {
			if(has_excerpt()){ ?>
				<div class="ampforwp_single_excerpt">
					<?php $content = get_the_excerpt();
					echo $content; ?>
				</div>
			<?php }
		}
}
		do_action('ampforwp_before_post_content',$this) //Post before Content here ?>

			<?php
			$amp_custom_content_enable = get_post_meta( $this->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);

			// Normal Front Page Content
			if ( ! $amp_custom_content_enable ) {
				$ampforwp_the_content = $this->get( 'post_amp_content' ); // amphtml content; no kses
			} else {
				// Custom/Alternative AMP content added through post meta
				$ampforwp_the_content = $this->get( 'ampforwp_amp_content' );
			}
			// echo $this->get( 'post_amp_content' ); // amphtml content; no kses
			
			if($redux_builder_amp['amp-pagination']) {
				$ampforwp_new_content = explode('<!--nextpage-->', $ampforwp_the_content);
			    $queried_var = get_query_var('page');
				if ( $queried_var > 1 ) {
			    	$queried_var = $queried_var -1   ;
			  	}
			  	else{
			  		$queried_var = 0;
			  	}
			  	echo $ampforwp_new_content[$queried_var]; 		  
	 		} else {
	 			echo $ampforwp_the_content;
	 		}//#1015 Pegazee
	 	do_action('ampforwp_after_post_content',$this) ; //Post After Content here 
	 ?>

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
							if (!empty( $next_post )) {
								$next_text = $next_post->post_title;
								?>
									<a href="<?php echo user_trailingslashit( trailingslashit( get_permalink( $next_post->ID ) )  . AMPFORWP_AMP_QUERY_VAR ); ?>"><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a> <?php
								} ?>
					</div>
					<!--Next Link code-->

					<!--Prev Link code-->
					<div class="prev">
							<?php $prev_post = get_previous_post();
								 if (!empty( $prev_post )) {
									 $prev_text = $prev_post->post_title;
									  ?>
								   <a href="<?php echo user_trailingslashit( trailingslashit( get_permalink( $prev_post->ID ) ) . AMPFORWP_AMP_QUERY_VAR ); ?>"> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a> <?php
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
