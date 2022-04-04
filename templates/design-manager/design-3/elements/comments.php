<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
do_action('ampforwp_before_comment_hook',$this);
	global $redux_builder_amp;
	$enable_comments = "";
	$display_comments_on = "";
	if ( isset($redux_builder_amp['wordpress-comments-support']) && $redux_builder_amp['wordpress-comments-support']==true ) {
		$enable_comments =  true;
	}
	$display_comments_on = ampforwp_get_comments_status();
	if ( $enable_comments && $display_comments_on ) { ?>
		<div id="comments" class="ampforwp-comment-wrapper"> <?php 
			// Gather comments for a specific page/post
			$postID = $comments =  "";
			$postID 	= get_the_ID();
			$comment_order = get_option( 'comment_order' );
			$comments 	= get_comments( 
				array( 'post_id' 	=> $postID, 'order' => esc_attr($comment_order), 'status' 	=> 'approve' )
			);
			if ( $comments ) {
				$comment_nums = '';
				$max_page 	  = '';
				$comment_nums =  get_comments_number();
				$comment_nums = " ($comment_nums) " ?>

				<div class="amp-wp-content comments_list cmts_list">
			        <h3><?php echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'] , 'View Comments' )). $comment_nums?></h3>
			        <ul> <?php // Display the list of comments
						function ampforwp_custom_translated_comment($comment, $args, $depth){
							global $redux_builder_amp;
							$GLOBALS['comment'] = $comment;
							$cmt 				= "";
							$default_gravatar 	= "";
							$comment_author_img_url = "";
							
							$cmt 				= get_comment_ID();
							$default_gravatar 	= get_avatar_data($cmt ) ;
							$comment_author_img_url = ampforwp_get_comments_gravatar( $comment ); ?>
							<li id="li-comment-<?php comment_ID() ?>" <?php comment_class(); ?> >
								<article id="comment-<?php comment_ID(); ?>" class="cmt-body">
									<footer class="cmt-meta">
									   <?php if($comment_author_img_url){ ?>
			 								<amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo esc_url($comment_author_img_url); ?>" width="40" height="40" layout="fixed" class="cmt-author-img"></amp-img>
			 							<?php } ?>         							
										<div class="cmt-author vcard">
											<?php  printf('<b class="fn">%s</b> <span class="says">'.esc_html(ampforwp_translation(ampforwp_get_setting('amp-translator-says-text'),'says')).':</span>', get_comment_author_link()) ?>
										</div>
										<!-- .cmt-author -->
										<div class="cmt-metadata">
											<a href="<?php echo esc_url(htmlspecialchars( untrailingslashit( get_comment_link( $comment->comment_ID ) ) )) ?>">
												<?php printf( esc_attr(ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at  %2$s') ), get_comment_date(),  get_comment_time())?>
											</a>
											<?php edit_comment_link( ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' ) ) ?>
										</div>
										<!-- .cmt-metadata -->
									</footer>
										<!-- .cmt-meta -->
									<div class="cmt-content">
			                        <?php $comment_content = get_comment_text();
			                        	// Added <p> tag in comments #873
			                        	$comment_content = wpautop( $comment_content );

			                        	$sanitizer = new AMPFORWP_Content( $comment_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 
			                          		'AMP_Img_Sanitizer' => array(),
			                          	  	'AMP_Video_Sanitizer' => array(),
					                  	  	'AMP_Style_Sanitizer' => array(),
					                  	  	'AMP_Iframe_Sanitizer' => 
					                  	  		array(
				                                   'add_placeholder' => true,
				                                )
			                          	 ) ) );
			                        	$sanitized_comment_content = $sanitizer->get_amp_content();
			                        	echo make_clickable( $sanitized_comment_content );//amphtml content, no kses ?>      
									</div>
									<?php do_action('ampforwp_reply_comment_form', $comment, $args, $depth);  ?>
								</article> <!-- .cmt-body -->
							<?php
						}// end of ampforwp_custom_translated_comment()

						wp_list_comments( array(
							'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE , //Allow comment pagination
							'style' 			=> 'li',
							'type'				=> 'comment',
							'max_depth'   		=> 5,
							'avatar_size'		=> 0,
							'callback'			=> 'ampforwp_custom_translated_comment',
							'reverse_top_level' => false //Show the latest comments at the top of the list
						), $comments);  ?>
				    </ul>
				    <?php 
				    $max_page = get_comment_pages_count($comments, AMPFORWP_COMMENTS_PER_PAGE);
				    $args = array(
						'base' 			=> add_query_arg( array('cpage' => '%#%', 'amp' => '1'), get_permalink() ),
						'format' 		=> '',
						'total' 		=> $max_page,
						//'current' => 0,
						'echo' 			=> true,
						'add_fragment' 	=> '#comments',				
					);
					if(true == ampforwp_get_setting('ampforwp-amp-takeover')){
						$args['base'] = get_the_permalink().'comment-page-%#%';
					}
			 		paginate_comments_links( $args ); ?>
				</div> <?php
			} // end if ( $comments ) 

			// if amp-comments extension is enabled then hide this button
			if ( ! defined( 'AMP_COMMENTS_VERSION' ) ) { ?>
				<div class="cmt-button-wrapper">
					<?php if ( comments_open() ) {
						$nofollow = '';
						if(true ==ampforwp_get_setting('ampforwp-nofollow-comment-btn')){
							$nofollow = 'rel=nofollow';
						}
						?>
				    	<a href="<?php echo esc_url(ampforwp_comment_button_url()); ?>" <?php echo esc_html($nofollow) ?> title="<?php echo ampforwp_get_setting('amp-translator-leave-a-comment-text') ?>"><?php echo  ampforwp_translation( ampforwp_get_setting('amp-translator-leave-a-comment-text'), 'Leave a Comment'  ); ?></a> <?php
					}?>
				</div> <?php 
			} ?>
		</div><?php 
	} // end if ( $enable_comments ) 

do_action('ampforwp_after_comment_hook', $this);