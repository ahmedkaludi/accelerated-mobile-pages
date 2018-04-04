<?php
function ampforwp_framework_get_comments(){
global $redux_builder_amp;
/*if ( ! comments_open() ) {
	return;
}*/
if ( $redux_builder_amp['ampforwp-facebook-comments-support'] ) { 
	echo ampforwp_framework_get_facebook_comments();
}
if ( $redux_builder_amp['ampforwp-disqus-comments-support'] )  {
	 ampforwp_framework_get_disqus_comments();
}
if ( comments_open() && true == $redux_builder_amp['wordpress-comments-support'] ) { ?>
	<div class="amp-comments">
	<?php
		global $redux_builder_amp;
		$max_page = '';
		// Gather comments for a specific page/post
		$postID = get_the_ID();
		$comments = get_comments(array(
				'post_id' => $postID,
				'status' => 'approve' //Change this to the type of comments to be displayed
		));
		if ( $comments ) { ?>
			<div class="amp-comments-wrapper">
	            <h3><span><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'], 'View Comments' )?></span></h3>
	            <ul>
						<?php
						// Display the list of comments
					function ampforwp_custom_translated_comment($comment, $args, $depth){
										$GLOBALS['comment'] = $comment;
										global $redux_builder_amp;
										$comment_author_img_url = "";
										$comment_author_img_url = ampforwp_get_comments_gravatar( $comment ); 
										
										?>
										<li id="li-comment-<?php comment_ID() ?>"
										<?php comment_class(); ?> >
											<article id="comment-<?php comment_ID(); ?>" class="comment-body">
												<footer class="comment-meta">
												<?php if($comment_author_img_url){ ?>
		                 							<amp-img src="<?php echo esc_url($comment_author_img_url); ?>" width="40" height="40" layout="fixed" class="comment-author-img"></amp-img>
		                 						<?php } ?>
													<div class="comment-author vcard">
														 <?php
														 printf(__('<b class="fn">%s</b> <span class="says">'.ampforwp_translation($redux_builder_amp['amp-translator-says-text'],'says').':</span>'), get_comment_author_link()) ?>
													</div>
													<div class="comment-metadata">
														<a href="<?php echo htmlspecialchars( trailingslashit( get_comment_link( $comment->comment_ID ) ) ) ?>">
															<?php printf( ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at %2$s') , get_comment_date(),  get_comment_time())?>
														</a>
														<?php edit_comment_link(  ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' )  ) ?>
													</div>
												</footer>
												<div class="comment-content">
							                        <?php
							                          	$comment_content = get_comment_text();
							                        	$comment_content = wpautop( $comment_content );
							                          $sanitizer = new AMPFORWP_Content( $comment_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 
							                          		'AMP_Img_Sanitizer' => array(),
							                          		'AMP_Video_Sanitizer' => array(),
							                          		'AMP_Style_Sanitizer' => array() ) ) );
							                         $sanitized_comment_content =  $sanitizer->get_amp_content();
							                          echo make_clickable( $sanitized_comment_content );   ?>
												</div>
											<?php do_action('ampforwp_reply_comment_form', $comment, $args, $depth); ?>
											</article>
										</li>
										<?php }
					wp_list_comments( array(
                        //Allow comment pagination
                        'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE , 
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
				'echo' => false,
				'add_fragment' => '#comments',
				'show_all' => true				
			);
		    if ( paginate_comments_links($args) ) { ?>
				<div class="cmts-wrap">
	     			<?php echo paginate_comments_links( $args ); ?>
	     		</div>
     		<?php } ?>
			</div>
	    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	    if( ! is_plugin_active( 'amp-comments/amp-comments.php' ) ) { ?>
	  		<div class="amp-comment-button">
	  		   <a href="<?php echo ampforwp_comment_button_url(); ?>" rel="nofollow"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
	  		</div>
	    <?php } ?>
	    <?php
		} else {
	    global $redux_builder_amp ;
	    if (!comments_open()) {
	      return;
	    } ?>
	    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	    if( ! is_plugin_active( 'amp-comments/amp-comments.php' ) ) { ?>
	      <div class="amp-comment-button">
	  	       <a href="<?php echo ampforwp_comment_button_url(); ?>" rel="nofollow"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
	       </div>
	     <?php } ?>
	<?php } ?>
	</div>
	<?php do_action('ampforwp_after_comment_hook');

	}

}

//Facebook Comments
function ampforwp_framework_get_facebook_comments(){
global $redux_builder_amp;
	$facebook_comments_markup = '';
	if ( $redux_builder_amp['ampforwp-facebook-comments-support'] ) {
	if( ampforwp_is_non_amp() && isset($redux_builder_amp['ampforwp-amp-convert-to-wp']) && $redux_builder_amp['ampforwp-amp-convert-to-wp']) {
		$facebook_comments_markup = '<div class="fb-comments" data-href="' . get_permalink() . '" data-width="800px" data-numposts="'.$redux_builder_amp['ampforwp-number-of-fb-no-of-comments'].'"></div>';
	}
	else {  
		$facebook_comments_markup = '<section class="amp-facebook-comments">';
		$facebook_comments_markup .= '<amp-facebook-comments width=486 height=357
	    		layout="responsive" data-numposts=';
		$facebook_comments_markup .= '"'. $redux_builder_amp['ampforwp-number-of-fb-no-of-comments']. '" ';

		$facebook_comments_markup .= 'data-href=" ' . get_permalink() . ' "';
	    $facebook_comments_markup .= '></amp-facebook-comments></section>';
	}
		return $facebook_comments_markup;
	}
}

//Disqus Comments
function ampforwp_framework_get_disqus_comments(){
	global $redux_builder_amp;
	$width = $height = 420;

	$layout = "";
	$layout = 'responsive';
	if ( isset($redux_builder_amp['ampforwp-disqus-layout']) && 'fixed' == $redux_builder_amp['ampforwp-disqus-layout'] ) {
		$layout = 'fixed';
	
		if ( isset($redux_builder_amp['ampforwp-disqus-height']) && $redux_builder_amp['ampforwp-disqus-height'] ) {
			$height = $redux_builder_amp['ampforwp-disqus-height'];
		}
	}

	if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
		global $post; $post_slug=$post->post_name;

		$disqus_script_host_url = "https://ampforwp.appspot.com/?api=". AMPFORWP_DISQUS_URL;

		if( $redux_builder_amp['ampforwp-disqus-host-position'] == 0 ) {
			$disqus_script_host_url = esc_url( $redux_builder_amp['ampforwp-disqus-host-file'] );
		}

		$disqus_url = $disqus_script_host_url.'?disqus_title='.$post_slug.'&url='.get_permalink().'&disqus_name='. esc_url( $redux_builder_amp['ampforwp-disqus-comments-name'] ) ."/embed.js"  ;
		?>
		<section class="amp-disqus-comments">
			<amp-iframe
				height=<?php echo $height ?>
				width=<?php echo $width ?>
				layout="<?php echo $layout ?>"
				sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
				frameborder="0"
				src="<?php echo $disqus_url ?>" >
				<div overflow tabindex="0" role="button" aria-label="Read more"><?php echo __('Disqus Comments Loading...','accelerated-mobile-pages') ?></div>
			</amp-iframe>
		</section>
	<?php
	}
}

// Comments Scripts
add_filter( 'amp_post_template_data', 'ampforwp_framework_comments_scripts' );
function ampforwp_framework_comments_scripts( $data ) {

	$facebook_comments_check = ampforwp_framework_get_facebook_comments();
	global $redux_builder_amp;
	if ( $facebook_comments_check && $redux_builder_amp['ampforwp-facebook-comments-support'] && is_singular() && !is_front_page()) {
			if ( empty( $data['amp_component_scripts']['amp-facebook-comments'] ) ) {
				$data['amp_component_scripts']['amp-facebook-comments'] = 'https://cdn.ampproject.org/v0/amp-facebook-comments-0.1.js';
			}
		}
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] && is_singular()  && comments_open() ) {
		if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
		}
	}	
		return $data;
}