<div class="amp-wp-article-content"> <?php

	do_action('ampforwp_inside_post_content_before'); 
		$amp_custom_content_enable = get_post_meta( $this->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);

		// Normal Front Page Content
		if ( ! $amp_custom_content_enable ) {
			echo $this->get( 'post_amp_content' ); // amphtml content; no kses
		} else {
			// Custom/Alternative AMP content added through post meta  
			echo $this->get( 'ampforwp_amp_content' );
		} 
		
	do_action('ampforwp_inside_post_content_after') ?>

</div>
