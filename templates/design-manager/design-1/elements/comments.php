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
				<h3><?php global $redux_builder_amp; echo $redux_builder_amp['amp-translator-view-comments-text'] ?></h3>
				<ul>
					<?php
					// Display the list of comments
				function ampforwp_custom_translated_comment($comment, $args, $depth){
									$GLOBALS['comment'] = $comment; ?>
									<?php if('0' === $comment->comment_parent){ ?>
									<li id="li-comment-<?php comment_ID() ?>"
									<?php comment_class(); ?> >
										<article id="comment-<?php comment_ID(); ?>" class="comment-body">
											<footer class="comment-meta">
												<div class="comment-author vcard">
													 <?php global $redux_builder_amp;
													 printf(__('<b class="fn">%s</b> <span class="says">'.$redux_builder_amp['amp-translator-says-text'].':</span>'), get_comment_author_link()) ?>
												</div>
												<!-- .comment-author -->
												<?php if ($comment->comment_approved == '0') : ?>
													 <em><?php _e('Your comment is awaiting moderation.') ?></em>
													 <br />
												<?php endif; ?>
												<!--comment moderation ends here-->
												<div class="comment-metadata">
													<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
														<?php
														printf(__('%1$s '.$redux_builder_amp['amp-translator-at-text'].' %2$s'), get_comment_date(),  get_comment_time())
														?>
													</a>
													<?php edit_comment_link(__('('.$redux_builder_amp['amp-translator-Edit-text'].')'),'  ','') ?>
												</div>
												<!-- .comment-metadata -->
											</footer>
												<!-- .comment-meta -->
											<div class="comment-content">
												<p><?php echo get_comment_text(); ?></p>
											</div>
												<!-- .comment-content -->
										</article>
									 <!-- .comment-body -->
									</li>
								<!-- #comment-## -->
									<?php
									}else {?>
										<li id="li-comment-<?php comment_ID() ?>"
										<?php comment_class(); ?> >
											<article id="comment-<?php comment_ID(); ?>" class="comment-body">
												<footer class="comment-meta">
													 <div class="comment-author vcard">
															<?php global $redux_builder_amp;
															printf(__('<b class="fn">%s</b> <span class="says">'.$redux_builder_amp['amp-translator-says-text'].':</span>'), get_comment_author_link()) ?>
													 </div>
													 <!-- .comment-author -->
													 <?php if ($comment->comment_approved == '0') : ?>
															<em><?php _e('Your comment is awaiting moderation.') ?></em>
															<br />
													 <?php endif; ?>
													 <!--comment moderation ends here-->
													 <div class="comment-metadata">
														 <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
															 <?php
															 printf(__('%1$s '.$redux_builder_amp['amp-translator-at-text'].' %2$s'), get_comment_date(),  get_comment_time())
															 ?>
														 </a>
														 <?php edit_comment_link(__('('.$redux_builder_amp['amp-translator-Edit-text'].')'),'  ','') ?>
													 </div>
													 <!-- .comment-metadata -->
												 </footer>
													 <!-- .comment-meta -->
												 <div class="comment-content">
														 <p><?php echo get_comment_text(); ?></p>
												 </div>
													 <!-- .comment-content -->
													<?php ampforwp_custom_translated_comment_nested($comment, $args, $depth);
														 ?>
										</article>
											<!-- .comment-body -->
									 </li>
									 <!-- #comment-## -->
								 <?php
									}
								}// end of ampforwp_custom_translated_comment()

				function ampforwp_custom_translated_comment_nested($comment, $args, $depth){
							 $GLOBALS['comment'] = $comment; ?>
							 <ul class="children">
							 <li id="li-comment-<?php comment_ID() ?>"
							 <?php comment_class(); ?> >
								 <article id="comment-<?php comment_ID(); ?>" class="comment-body">
									 <footer class="comment-meta">
											<div class="comment-author vcard">
												 <?php global $redux_builder_amp;
												 printf(__('<b class="fn">%s</b> <span class="says">'.$redux_builder_amp['amp-translator-says-text'].':</span>'), get_comment_author_link()) ?>
											</div>
											<!-- .comment-author -->
											<?php if ($comment->comment_approved == '0') : ?>
												 <em><?php _e('Your comment is awaiting moderation.') ?></em>
												 <br />
											<?php endif; ?>
											<!--comment moderation ends here-->
											<div class="comment-metadata">
												<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
													<?php
													printf(__('%1$s '.$redux_builder_amp['amp-translator-at-text'].' %2$s'), get_comment_date(),  get_comment_time())
													?>
												</a>
												<?php edit_comment_link(__('('.$redux_builder_amp['amp-translator-Edit-text'].')'),'  ','') ?>
											</div>
											<!-- .comment-metadata -->
										</footer>
											<!-- .comment-meta -->
										<div class="comment-content">
												<p><?php echo get_comment_text(); ?></p>
										</div>
											<!-- .comment-content -->
							 </article>
								 <!-- .comment-body -->
							</li>
							<!-- #comment-## -->
						</ul>
						<!-- .children -->
						<?php
					}// end of ampforwp_custom_translated_comment_nested()

				wp_list_comments( array(
				  'per_page' 			=> 10, //Allow comment pagination
				  'style' 				=> 'li',
				  'type'				=> 'comment',
				  'max_depth'   		=> 0,
				  'avatar_size'			=> 0,
					'callback'				=> 'ampforwp_custom_translated_comment',
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
