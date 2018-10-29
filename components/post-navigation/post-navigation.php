<?php 
function ampforwp_framework_get_post_navigation(){
	global $redux_builder_amp;
	if($redux_builder_amp['enable-single-next-prev']) { ?>
		<div id="pagination">
			<?php $next_post = get_next_post();
				if (!empty( $next_post )) {
				$next_text = $next_post->post_title; ?>	
					<div class="next">
						<a href="<?php echo ampforwp_url_controller( get_permalink( $next_post->ID ) ); ?>">	<span><?php echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Next' )); ?></span><?php echo esc_html(apply_filters('ampforwp_next_link',$next_text )); ?> &raquo;</a>
					</div>
				<?php } ?>				


			<?php $prev_post = get_previous_post();
			 if (!empty( $prev_post )) {
				 $prev_text = $prev_post->post_title; ?>
				<div class="prev">
			    	<a href="<?php echo ampforwp_url_controller( get_permalink( $prev_post->ID ) ); ?>">	<span><?php echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' )); ?></span> &laquo; <?php echo esc_html(apply_filters('ampforwp_prev_link',$prev_text )); ?></a>
			    </div>
			<?php } ?>
			<div class="clearfix"></div>
		</div>
	<?php }
}