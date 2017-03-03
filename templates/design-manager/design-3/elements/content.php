<div class="amp-wp-article-content">

	<!--Post Content here-->
	<div class="amp-wp-content the_content">

		<?php do_action('ampforwp_before_post_content') //Post before Content here ?>

			<?php
			$amp_custom_content_enable = get_post_meta( $this->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);

			// Normal Front Page Content
			if ( ! $amp_custom_content_enable ) {
				echo $this->get( 'post_amp_content' ); // amphtml content; no kses
			} else {
				// Custom/Alternative AMP content added through post meta
				echo $this->get( 'ampforwp_amp_content' );
			}
			
			// echo $this->get( 'post_amp_content' ); // amphtml content; no kses
			?>

		<?php do_action('ampforwp_after_post_content') ; //Post After Content here ?>

	</div>
	<!--Post Content Ends here-->

	<!--Post Next-Previous Links-->
	<?php global $redux_builder_amp;
		if($redux_builder_amp['enable-single-next-prev']) { ?>
			<div class="amp-wp-content post-pagination-meta">
				<div id="pagination">
                <?php $next_post = get_next_post();
                    if (!empty( $next_post )) { ?>
                    <span><?php global $redux_builder_amp; echo $redux_builder_amp['amp-translator-next-read-text']; ?></span> <a href="<?php echo trailingslashit(get_permalink( $next_post->ID )) . AMPFORWP_AMP_QUERY_VAR; ?>"><?php echo $next_post->post_title; ?> &raquo;</a> <?php
                    } ?>
				</div>
			</div>
		<?php } ?>
	<!--Post Next-Previous Links End here-->
    
</div>