<?php global $redux_builder_amp;
$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
$template = new AMP_Post_Template( $post_id );?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<link rel="canonical" href="<?php echo home_url('/');?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<?php
		$amp_custom_content_enable = get_post_meta($template->data['post_id'], 'ampforwp_custom_content_editor_checkbox', true);
		if ( ! $amp_custom_content_enable ) {
			$amp_component_scripts = $template->data['amp_component_scripts'];
			foreach ($amp_component_scripts as $ampforwp_service => $ampforwp_js_file) { ?>
				<script custom-element="<?php echo $ampforwp_service; ?>"  src="<?php echo $ampforwp_js_file; ?>" async></script> <?php
			}
		} ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="single-post amp-wp-frontpage design_1_wrapper">
	<?php $this->load_parts( array( 'header-bar' ) ); ?>
	<?php do_action('ampforwp_frontpage_above_loop') ?>
	<article class="amp-wp-article">

		<?php if( $redux_builder_amp['ampforwp-title-on-front-page'] ) { ?>
			<header class="amp-wp-article-header ampforwp-title">
				<h1 class="amp-wp-title">
						<?php echo get_the_title( $post_id ) ; ?>
				</h1>
			</header>
		<?php } ?>

		<?php do_action( 'ampforwp_after_header', $this );  ?>

		<div class="amp-wp-content the_content"> <?php

			do_action( 'ampforwp_before_post_content', $this );

			// Normal Front Page Content
			if ( ! $amp_custom_content_enable ) {
				echo $template->data['post_amp_content'];
			} else {
				// Custom/Alternative AMP content added through post meta
				echo $template->data['ampforwp_amp_content'];
			}

			do_action( 'ampforwp_after_post_content', $this );
			?>

		</div>
	<?php $data = get_option( 'ampforwp_design' );
		$enable_comments = false;

		if ($data['elements'] == '') {
		 	$data['elements'] = "meta_info:1,title:1,featured_image:1,content:1,meta_taxonomy:1,social_icons:1,comments:1,related_posts:1";
		}
		if( isset( $data['elements'] ) || ! empty( $data['elements'] ) ){
			$options = explode( ',', $data['elements'] );
		};
		if ($options): foreach ($options as $key=>$value) {
			switch ($value) {
					case 'comments:1':
						$enable_comments = true;
					break;
			}
		} endif;
	if ( $enable_comments ) { ?>
		<div class="ampforwp-comment-wrapper">
			<?php
			// TODO : Create a separate  function and add the comment code that and use DRY method instead of repeating the code. #682
				global $redux_builder_amp;
				// Gather comments for a specific page/post
				$postID = get_the_ID();
				$postID = $redux_builder_amp['amp-frontpage-select-option-pages'];
				$comments = get_comments(array(
						'post_id' => $postID,
						'status' => 'approve' //Change this to the type of comments to be displayed
				));
			if ( $comments ) { ?>
				<div class="amp-wp-content comments_list">
				    <h3><?php global $redux_builder_amp; echo $redux_builder_amp['amp-translator-view-comments-text'] ?></h3>
				    <ul>
				    <?php
						$page = (get_query_var('page')) ? get_query_var('page') : 1;
						$total_comments = get_comments( array(
							'orderby' 	=> 'post_date' ,
							'order' 	=> 'DESC',
							'post_id'	=> $postID,
							'status' 	=> 'approve',
							'parent'	=>0 )
						);
						$pages = ceil(count($total_comments)/AMPFORWP_COMMENTS_PER_PAGE);
					    $pagination_args = array(
							'base'         =>  @add_query_arg('page','%#%'),
							'format'       => '?page=%#%',
							'total'        => $pages,
							'current'      => $page,
							'show_all'     => False,
							'end_size'     => 1,
							'mid_size'     => 2,
							'prev_next'    => True,
							'prev_text'    => $redux_builder_amp['amp-translator-previous-text'],
							'next_text'    => $redux_builder_amp['amp-translator-next-text'],
							'type'         => 'plain'
						);

						// Display the list of comments
						function ampforwp_custom_translated_comment($comment, $args, $depth){
							$GLOBALS['comment'] = $comment;
							global $redux_builder_amp; ?>
							<li id="li-comment-<?php comment_ID() ?>"
							<?php comment_class(); ?> >
								<article id="comment-<?php comment_ID(); ?>" class="comment-body">
									<footer class="comment-meta">
										<div class="comment-author vcard">
											<?php
											printf(__('<b class="fn">%s</b> <span class="says">'.$redux_builder_amp['amp-translator-says-text'].':</span>'), get_comment_author_link()) ?>
										</div>
										<!-- .comment-author -->
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
				                        <p><?php
				                          // $pattern = "~[^a-zA-Z0-9_ !@#$%^&*();\\\/|<>\"'+.,:?=-]~";
				                          $emoji_content = get_comment_text();
				                          // $emoji_free_comments = preg_replace($pattern,'',$emoji_content);
				                          echo $emoji_content; ?>
				                        </p>
									</div>
										<!-- .comment-content -->
								</article>
							 <!-- .comment-body -->
							</li>
						<!-- #comment-## -->
							<?php
						}// end of ampforwp_custom_translated_comment()
						wp_list_comments( array(
						  'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE, //Allow comment pagination
						  'page'              	=> $page,
						  'style' 				=> 'li',
						  'type'				=> 'comment',
						  'max_depth'   		=> 5,
						  'avatar_size'			=> 0,
							'callback'				=> 'ampforwp_custom_translated_comment',
						  'reverse_top_level' 	=> false //Show the latest comments at the top of the list
						), $comments);
						echo paginate_links( $pagination_args );?>
				    </ul>
				</div>
				<div class="comment-button-wrapper">
				    <a href="<?php echo get_permalink().'?nonamp=1'.'#commentform' ?>" rel="nofollow"><?php esc_html_e( $redux_builder_amp['amp-translator-leave-a-comment-text']  ); ?></a>
				</div><?php
			} else {
			    if ( !comments_open() ) {
			      return;
				} ?>
			    <div class="comment-button-wrapper">
			       <a href="<?php echo get_permalink().'?nonamp=1'.'#commentform'  ?>" rel="nofollow"><?php esc_html_e( $redux_builder_amp['amp-translator-leave-a-comment-text']  ); ?></a>
			    </div>
			<?php } ?>
		</div> <?php
	} ?>

		<div class="amp-wp-content post-pagination-meta">
			<?php $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?>
		</div>

		<?php if($redux_builder_amp['enable-single-social-icons'] == true)  { ?>
			<div class="sticky_social">
				<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
			    	<amp-social-share type="facebook"   width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  {
						$data_param_data = $redux_builder_amp['enable-single-twitter-share-handle']; ?>
						<amp-social-share type="twitter"
															width="50"
															height="28"
															data-param-url="CANONICAL_URL"
															data-param-text=<?php echo $data_param_data ?>
						></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
			    	<amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
			    	<amp-social-share type="email"      width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
			    	<amp-social-share type="pinterest"  width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
			    	<amp-social-share type="linkedin"   width="50" height="28"></amp-social-share>
			  	<?php } ?>
			</div>
		<?php } ?>
	</article>
	<?php do_action('ampforwp_frontpage_below_loop') ?>
	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
