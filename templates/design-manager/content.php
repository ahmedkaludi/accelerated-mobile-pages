<div class="amp-wp-article-content">
		<?php do_action('ampforwp_inside_post_content_before') ?>
		
				<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
				
		<?php do_action('ampforwp_inside_post_content_after') ?>
</div>
