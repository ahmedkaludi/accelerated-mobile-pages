<?php
global $redux_builder_amp;
if (!comments_open() || ( isset($redux_builder_amp['wordpress-comments-support']) && $redux_builder_amp['wordpress-comments-support']==false ) ) {
  return;
}
?>
<?php do_action('ampforwp_before_comment_hook',$this); ?>
<div class="ampforwp-comment-wrapper">
<?php
	global $redux_builder_amp;
	// Gather comments for a specific page/post
	$postID = get_the_ID();
	$comments = get_comments(array(
			'post_id' => $postID,
			'status' => 'approve' //Change this to the type of comments to be displayed
	));
	if ( $comments ) { 
		$comment_nums = '';
		$max_page 	  = '';
		$comment_nums =  get_comments_number();
		$comment_nums = " ($comment_nums) " ?>
		<div class="amp-wp-content comments_list">
            <h3><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'] , 'View Comments' ). $comment_nums?>
            </h3>
            <ul>
					<?php
					// Display the list of comments
				function ampforwp_custom_translated_comment($comment, $args, $depth){
									$GLOBALS['comment'] = $comment;
									global $redux_builder_amp;
									$cmt = "";
									$default_gravatar = "";
									$cmt = get_comment_ID();
									$default_gravatar = get_avatar_data($cmt ) ;
									$comment_author_img_url = "";
									$comment_author_img_url = ampforwp_get_comments_gravatar( $comment ); ?>
									<li id="li-comment-<?php comment_ID() ?>"
									<?php comment_class(); ?> >
										<article id="comment-<?php comment_ID(); ?>" class="comment-body">
											<footer class="comment-meta">
											   <?php if($comment_author_img_url){ ?>
                     							<amp-img src="<?php echo esc_url($comment_author_img_url); ?>" width="40" height="40" layout="fixed" class="comment-author-img"></amp-img>
                     							<?php }  

                     							else {  ?>
                     							<amp-img src="<?php echo esc_url($default_gravatar['url']); ?>" width="40" height="40" layout="fixed" class="comment-author-img"></amp-img>
                     							<?php }  ?>
                     							
												<div class="comment-author vcard">
												<?php 
													 printf(__('<b class="fn">%s</b> <span class="says">'.ampforwp_translation($redux_builder_amp['amp-translator-says-text'],'says').':</span>'), get_comment_author_link()) ?>
												</div>
												<!-- .comment-author -->
												<div class="comment-metadata">
													<a href="<?php echo htmlspecialchars( untrailingslashit( get_comment_link( $comment->comment_ID ) ) ) ?>">
														<?php printf( ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at  %2$s') , get_comment_date(),  get_comment_time())?>
													</a>
													<?php edit_comment_link( ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' ) ) ?>
												</div>
												<!-- .comment-metadata -->
											</footer>
												<!-- .comment-meta -->
											<div class="comment-content">
					                        <?php
					                        	$comment_content = get_comment_text();
					                        	// Added <p> tag in comments #873
					                        	$comment_content = wpautop( $comment_content );

					                          $sanitizer = new AMPFORWP_Content( $comment_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 
					                          		'AMP_Img_Sanitizer' => array(),
					                          	  	'AMP_Video_Sanitizer' => array(),
							                  	  	'AMP_Style_Sanitizer' => array()
					                          	 ) ) );
					                          $sanitized_comment_content = $sanitizer->get_amp_content();
					                          echo make_clickable( $sanitized_comment_content ); ?>
                        
											</div>
												<?php  do_action('ampforwp_reply_comment_form', $comment, $args, $depth);  ?>
												<!-- .comment-content -->
										</article>
									 <!-- .comment-body -->
									</li>
								<!-- #comment-## -->
									<?php
								}// end of ampforwp_custom_translated_comment()

				wp_list_comments( array(
				  'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE , //Allow comment pagination
				  'style' 				=> 'li',
				  'type'				=> 'comment',
				  'max_depth'   		=> 5,
				  'avatar_size'			=> 0,
					'callback'				=> 'ampforwp_custom_translated_comment',
				  'reverse_top_level' 	=> true //Show the latest comments at the top of the list
				), $comments);  ?>
		    </ul>
		    <?php 
		    $max_page = get_comment_pages_count($comments, AMPFORWP_COMMENTS_PER_PAGE);
		    $args = array(
				'base' => add_query_arg( array('cpage' => '%#%', 'amp' => '1'), get_permalink() ),
				'format' => '',
				'total' => $max_page,
				//'current' => 0,
				'echo' => true,
				'add_fragment' => '#comments',
				'show_all' => true				
			);

     paginate_comments_links( $args ); ?>
		</div>
    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if( ! is_plugin_active( 'amp-comments/amp-comments.php' ) ) { ?>
  		<div class="comment-button-wrapper">
  		    <a href="<?php echo ampforwp_comment_button_url(); ?>" rel="nofollow"><?php echo  ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
  		</div>
    <?php } ?>
    <?php } else {
       global $redux_builder_amp ;
       if (!comments_open()) {
         return;
       } ?>
       <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
       if( ! is_plugin_active( 'amp-comments/amp-comments.php' ) ) { ?>
         <div class="comment-button-wrapper">
  	        <a href="<?php echo ampforwp_comment_button_url(); ?>" rel="nofollow"><?php echo  ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
          </div>
        <?php } ?>
<?php  } ?>
</div>
<?php do_action('ampforwp_after_comment_hook',$this);