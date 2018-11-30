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
		// Muffin Builder Compatibility #1455 #1893
		if ( function_exists('mfn_builder_print') && !$amp_custom_content_enable) {
			ob_start();
		  	mfn_builder_print( get_the_ID() );
			$content = ob_get_contents();
			ob_end_clean();
			$sanitizer_obj = new AMPFORWP_Content( $content,
								array(), 
								apply_filters( 'ampforwp_content_sanitizers', 
									array( 'AMP_Img_Sanitizer' => array(), 
										'AMP_Blacklist_Sanitizer' => array(),
										'AMP_Style_Sanitizer' => array(), 
										'AMP_Video_Sanitizer' => array(),
				 						'AMP_Audio_Sanitizer' => array(),
				 						'AMP_Iframe_Sanitizer' => array(
											 'add_placeholder' => true,
										 ),
									) 
								) 
							);
			$ampforwp_the_content =  $sanitizer_obj->get_amp_content();
		}
	    
		//Filter to modify the Content
		$ampforwp_the_content = apply_filters('ampforwp_modify_the_content', $ampforwp_the_content);
	    echo $ampforwp_the_content; // amphtml content, no kses			
		do_action('ampforwp_after_post_content',$this) ; ?>
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
