<?php
 global $redux_builder_amp ; ?>
	<?php if( !comments_open() ) { return; } ?>
	<div class="comment-button-wrapper">
			<a href="<?php echo get_permalink().'#commentform' ?>"><?php esc_html_e( $redux_builder_amp['amp-translator-leave-a-comment-text']  ); ?></a>
	</div>