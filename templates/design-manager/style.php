<?php
add_action('amp_post_template_css', 'ampforwp_additional_style_input');

function ampforwp_additional_style_input( $amp_template ) { 

	$get_customizer = new AMP_Post_Template( $post_id );
	$text_color 	= $get_customizer->get_customizer_setting( 'text_color' );
	?>
	
	/* Header */
	.amp-wp-header {
	
	}
	.amp-wp-header .nav_container {
		
	}
	.toggle-text  { 
		position: absolute;
		right: 0;
	}
	.toggle-text span {
		font-size: 80px;
		position: absolute;
		line-height: 0;
	}

	/* Homepage */
	.ampforwp-custom-index .amp-wp-title a {
		text-decoration: none;
		color: <?php echo sanitize_hex_color( $text_color ); ?>;
	}

	.amp-wp-meta {
		display: flex;
	}
	.amp-wp-posted-on {
		display: initial
	}
	.ampforwp-custom-index .amp-wp-content {
		margin-bottom: 30px;
	}

	/* Single */
	.amp-wp-article-content amp-img {
		max-width : 100%;
	}

	<?php 
}
?>