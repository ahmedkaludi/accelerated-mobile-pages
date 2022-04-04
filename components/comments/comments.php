<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_framework_get_comments(){
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	do_action('ampforwp_comment_start_hook');
	if ( $display_comments_on ) {
		if ( $redux_builder_amp['ampforwp-facebook-comments-support']  ) { 
		 	echo ampforwp_framework_get_facebook_comments(); 
		}

		if ( $redux_builder_amp['ampforwp-disqus-comments-support'] )  {
			 ampforwp_framework_get_disqus_comments();
		}
		if ( $redux_builder_amp['ampforwp-vuukle-comments-support'] )  {
			 ampforwp_framework_get_vuukle_comments();
		}
		if ( $redux_builder_amp['ampforwp-spotim-comments-support']  )  {
			 ampforwp_framework_get_spotim_comments();
		}
	  
		if ( isset($redux_builder_amp['wordpress-comments-support']) && true == $redux_builder_amp['wordpress-comments-support'] ) {
			do_action('ampforwp_before_comment_hook'); ?>
				<div class="amp-comments">
					<?php
					// Gather comments for a specific page/post
					$postID = $comments = $max_page =  "";
					$postID = get_the_ID();
					if ( ampforwp_is_front_page() ) {
						$postID = ampforwp_get_frontpage_id();
					}
					$comment_order = get_option( 'comment_order' );
					$comments = get_comments(array(
							'post_id' => $postID,
							'order' => esc_attr($comment_order),
							'status' => 'approve' //Change this to the type of comments to be displayed
					));
					
					if ( $comments ) { ?>
						<div id="comments" class="amp-comments-wrapper">
				            <h3><span><?php echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'], 'View Comments' ));?></span></h3>
				            <ul><?php
								// Display the list of comments
								function ampforwp_custom_translated_comment($comment, $args, $depth){
									$GLOBALS['comment'] = $comment;
									global $redux_builder_amp;
									$comment_author_img_url = "";
									$comment_author_img_url = ampforwp_get_comments_gravatar( $comment ); 
									
									?>
									<li id="li-comment-<?php comment_ID() ?>"
									<?php comment_class(); ?> >
										<article id="comment-<?php comment_ID(); ?>" class="cmt-body">
											<footer class="cmt-meta">
											<?php if($comment_author_img_url){ ?>
			         							<amp-img src="<?php echo esc_url($comment_author_img_url); ?>" width="40" height="40" layout="fixed" class="cmt-author-img"></amp-img>
			         						<?php } ?>
												<div class="cmt-author vcard">
													 <?php
													 printf('<b class="fn">%s</b> <span class="says">'.esc_html(ampforwp_translation(ampforwp_get_setting('amp-translator-says-text'),'says')).':</span>', get_comment_author_link()) ?>
												</div>
												<div class="cmt-metadata">
													<a href="<?php echo htmlspecialchars( trailingslashit( get_comment_link( $comment->comment_ID ) ) ) ?>">
														<?php printf( ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at %2$s') , get_comment_date(),  get_comment_time())?>
													</a>
													<?php edit_comment_link(  ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' )  ) ?>
												</div>
											</footer>
											<div class="cmt-content">
						                        <?php
						                          	$comment_content = get_comment_text();
						                        	$comment_content = wpautop( $comment_content );
						                          $sanitizer = new AMPFORWP_Content( $comment_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 
						                          		'AMP_Img_Sanitizer' => array(),
						                          		'AMP_Video_Sanitizer' => array(),
						                          		'AMP_Style_Sanitizer' => array(),
						                          		'AMP_Iframe_Sanitizer' =>
						                          			array(
                                   								'add_placeholder' => true,
                                							) ) ) );
						                         $sanitized_comment_content =  $sanitizer->get_amp_content();
						                          echo make_clickable( $sanitized_comment_content );   ?>
											</div>
										<?php do_action('ampforwp_reply_comment_form', $comment, $args, $depth); ?>
										</article>
									<?php 
								}
								wp_list_comments( array(
			                        //Allow comment pagination
			                        'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE , 
			                        'style' 			=> 'li',
			                        'type'				=> 'comment',
			                        'max_depth'   		=> 5,
			                        'avatar_size'		=> 0,
			                        'callback'			=> 'ampforwp_custom_translated_comment',
			                        'reverse_top_level' => false //Show the latest comments at the top of the list
								), $comments);  ?>
						    </ul> <?php 
							    $max_page = get_comment_pages_count($comments, AMPFORWP_COMMENTS_PER_PAGE);
							    $args = array(
									'base' 			=> add_query_arg( array('cpage' => '%#%', 'amp' => '1'), get_permalink() ),
									'format' 		=> '',
									'total' 		=> $max_page,
									'echo' 			=> false,
									'add_fragment' 	=> '#comments',		
								);
								if(true == ampforwp_get_setting('ampforwp-amp-takeover')){
									$args['base'] = get_the_permalink().'comment-page-%#%';
								}
						    if ( paginate_comments_links($args) ) { ?>
								<div class="cmts-wrap">
					     			<?php echo paginate_comments_links( $args ); ?>
					     		</div>
				     		<?php } ?>
						</div> <!-- .amp-comments-wrapper -->
						<?php // if amp-comments extension is enabled then hide this button
					} // if ( $comments )
					if ( ! defined( 'AMP_COMMENTS_VERSION' ) && comments_open($postID) ) { ?>
						<div class="amp-comment-button">
							<?php if ( comments_open($postID) ) {
								$nofollow = '';
								if(true ==ampforwp_get_setting('ampforwp-nofollow-comment-btn')){
									$nofollow = 'rel=nofollow';
								}
							 ?>
							 <a href="<?php echo ampforwp_comment_button_url(); ?>" title="<?php echo ampforwp_get_setting('amp-translator-leave-a-comment-text')?>" <?php echo esc_html($nofollow) ?> ><?php echo esc_html(ampforwp_translation( ampforwp_get_setting('amp-translator-leave-a-comment-text'), 'Leave a Comment' ) ); ?></a> <?php } ?>
						</div>	 
				<?php } ?>
				</div>
			<?php do_action('ampforwp_after_comment_hook');
		}
	} // end $display_comments_on
	do_action('ampforwp_comment_end_hook');
}

//Facebook Comments
function ampforwp_framework_get_facebook_comments(){
global $redux_builder_amp;
	$facebook_comments_markup = $lang = $locale = '';
	$lang = ampforwp_get_setting('ampforwp-fb-comments-lang');
	if ( $redux_builder_amp['ampforwp-facebook-comments-support'] ) {
	if( ampforwp_is_non_amp() && isset($redux_builder_amp['ampforwp-amp-convert-to-wp']) && $redux_builder_amp['ampforwp-amp-convert-to-wp']) {
		$facebook_comments_markup = '<div class="fb-comments" data-href="' . get_permalink() . '" data-width="800px" data-numposts="'.$redux_builder_amp['ampforwp-number-of-fb-no-of-comments'].'"></div>';
	}
	else {  
		$facebook_comments_markup = '<section class="amp-facebook-comments">';
		if(true == ampforwp_get_setting('ampforwp-facebook-comments-title')){
			$facebook_comments_markup .= '<h5>'. esc_html__(ampforwp_translation(ampforwp_get_setting('ampforwp-facebook-comments-title'), 'Leave a Comment'),'accelerated-mobile-pages') .'</h5>';
		}
		$facebook_comments_markup .= '<amp-facebook-comments width=486 height=357
	    		layout="responsive" '.'data-locale = "'.esc_attr($lang).'"'.' data-numposts=';
		$facebook_comments_markup .= '"'. esc_attr($redux_builder_amp['ampforwp-number-of-fb-no-of-comments']). '"';
	    if(ampforwp_get_data_consent()){
	    	$facebook_comments_markup .= ' data-block-on-consent ';
	    }
		$facebook_comments_markup .= 'data-href="' . esc_html(get_permalink()) . '"';
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
	}
	$height = ampforwp_get_setting('ampforwp-disqus-height');
	if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
		global $post; $post_slug = rawurlencode($post->post_name);

		$disqus_script_host_url = "https://ampforwp.appspot.com/?api=". AMPFORWP_DISQUS_URL;

		if( $redux_builder_amp['ampforwp-disqus-host-position'] == 0 ) {
			$disqus_script_host_url = esc_url( $redux_builder_amp['ampforwp-disqus-host-file'] );
		}

		$disqus_url = $disqus_script_host_url.'?disqus_title='.$post_slug.'&url='.rawurlencode(get_permalink()).'&disqus_name='. esc_url( ampforwp_get_setting('ampforwp-disqus-comments-name') ) ."/embed.js"  ;
		?>
		<section class="amp-disqus-comments">
			<amp-iframe
				height=<?php echo esc_attr($height); ?>
				width=<?php echo esc_attr($width); ?>
				layout="<?php echo esc_attr($layout); ?>"
				sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
				resizable
				frameborder="0"
				<?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?>
				src="<?php echo esc_url($disqus_url); ?>" title="<?php echo esc_html__('Disqus Comments.','accelerated-mobile-pages'); ?>">
				<div overflow tabindex="0" role="button" aria-label="Read more"><?php echo esc_html__('Disqus Comments Loading...','accelerated-mobile-pages') ?></div>
			</amp-iframe>
		</section>
	<?php
	}
}
function ampforwp_framework_get_vuukle_comments(){
	echo ampforwp_vuukle_comments_markup();
}
function ampforwp_framework_get_spotim_comments(){
	global $post;
	$spotId ='';
	if( true == ampforwp_get_setting('ampforwp-spotim-comments-apiKey') && ampforwp_get_setting('ampforwp-spotim-comments-apiKey') !== ""){
		$spotId = ampforwp_get_setting('ampforwp-spotim-comments-apiKey');
	}
	$srcUrl = 'https://amp.spot.im/production.html?spot_im_highlight_immediate=true';
	$srcUrl = add_query_arg('spotId' ,$spotId, $srcUrl);
	$srcUrl = add_query_arg('postId' , $post->ID, $srcUrl);
	$spotim_html = '<amp-iframe width="375" height="815" resizable sandbox="allow-scripts allow-same-origin allow-popups allow-top-navigation" layout="responsive"
	  frameborder="0" src="'.esc_url($srcUrl).'">
	  <amp-img placeholder height="815" layout="fill" src="//amp.spot.im/loader.png"></amp-img>
	  <div overflow class="spot-im-amp-overflow" tabindex="0" role="button" aria-label="Read more">'.esc_html__('Load more...','accelerated-mobile-pages').'</div>
	</amp-iframe>';
	echo $spotim_html; // escaped above
}

// Comments Scripts
add_filter( 'ampforwp_post_template_data', 'ampforwp_framework_comments_scripts' );
function ampforwp_framework_comments_scripts( $data ) {

	$facebook_comments_check = ampforwp_framework_get_facebook_comments();
	global $redux_builder_amp;
	$is_pb_enabled = '';
	$is_pb_enabled = checkAMPforPageBuilderStatus(get_the_ID());	
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	$isBBPress = (function_exists('is_bbpress') ? is_bbpress() : false );
	if ( $facebook_comments_check && true ==  ampforwp_get_setting('ampforwp-facebook-comments-support') && $display_comments_on && !is_front_page()  && !$is_pb_enabled && !$isBBPress ) {
			if ( empty( $data['amp_component_scripts']['amp-facebook-comments'] ) ) {
				$data['amp_component_scripts']['amp-facebook-comments'] = 'https://cdn.ampproject.org/v0/amp-facebook-comments-0.1.js';
			}
		}
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] && $display_comments_on  && comments_open() && !$is_pb_enabled ) {
		if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
		}
	}
	if ( isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
	 	&& $redux_builder_amp['ampforwp-vuukle-comments-support']
	  	&& $display_comments_on  && comments_open() && !$is_pb_enabled 
	) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
			if (ampforwp_get_setting('ampforwp-vuukle-Ads-before-comments') && empty( $data['amp_component_scripts']['amp-ad'] ) ) {
				$data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
			}
	}
	//spotim
	if ( isset($redux_builder_amp['ampforwp-spotim-comments-support'])
	 	&& $redux_builder_amp['ampforwp-spotim-comments-support']
	 	&& $display_comments_on  && comments_open() ) {
		if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
			$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
		}
		
	}
		return $data;
}