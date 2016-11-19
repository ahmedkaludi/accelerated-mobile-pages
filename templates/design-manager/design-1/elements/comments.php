<div class="ampforwp-comment-wrapper">
<?php  
	global $redux_builder_amp;
	// Gather comments for a specific page/post 
	$postID = get_the_ID();
	$comments = get_comments(array(
			'post_id' => $postID,
			'status' => 'approve' //Change this to the type of comments to be displayed
	));
	if ( $comments ) { ?>
		<div class="amp-wp-content comments_list">
			<h3><?php esc_html_e( $redux_builder_amp['amp-translator-view-comments-text']  ); ?></h3>
		    <ul>
		        <?php
		        // Display the list of comments
				wp_list_comments( array(
				  'per_page' 			=> 10, //Allow comment pagination
				  'style' 				=> 'li',
				  'type'				=> 'comment',
				  'max_depth'   		=> 0,
				  'avatar_size'			=> 0,
				  'reverse_top_level' 	=> false //Show the latest comments at the top of the list
				), $comments);  ?>
		    </ul>
		</div>
		<div class="comment-button-wrapper">
		    <a href="<?php echo get_permalink().'#commentform' ?>"><?php esc_html_e( $redux_builder_amp['amp-translator-leave-a-comment-text']  ); ?></a>
		</div><?php 
	}
?>
</div>
