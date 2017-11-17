<div class="amp-wp-article-content">

	<!--Post Content here-->
	<div class="amp-wp-content the_content">
		<?php global $redux_builder_amp;
			
			do_action('ampforwp_before_post_content',$this); //Post before Content here 

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
			    else{
			    	 $queried_var = 0;
			    }
			    echo $ampforwp_new_content[$queried_var];
		 	} else{
		 		echo $ampforwp_the_content;
		 	}//#1015 pegazee
		 	do_action('ampforwp_after_post_content',$this) ; //Post After Content here ?>
	</div>
	<!--Post Content Ends here-->

	<!--Post Next-Previous Links-->
	<?php global $redux_builder_amp;
		if($redux_builder_amp['enable-single-next-prev'] && !is_page() ) { ?>
			<div class="amp-wp-content post-pagination-meta">
				<div id="pagination">
                <?php $next_post = get_next_post();
                    if (!empty( $next_post )) { ?>
                    <span><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-next-read-text'], 'Next Read' ); ?></span> <a href="<?php echo 
                    ampforwp_url_controller( get_permalink( $next_post->ID ) ); ?>"><?php echo $next_post->post_title; ?> &raquo;</a> <?php
                    } ?>
				</div>
			</div>
		<?php } ?>
	<!--Post Next-Previous Links End here-->

</div>