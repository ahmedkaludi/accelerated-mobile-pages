<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="single-post">
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>


	<div class="amp-wp-content post-title-meta">
		<?php if($redux_builder_amp['enable-single-post-meta'] == true) { ?>
			<ul class="amp-wp-meta">
				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author') ) ); ?>

				<li> <?php _e(' on ','ampforwp'); the_time( get_option( 'date_format' ) ) ?></li>

				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array('meta-taxonomy' ) ) ); ?>

				<li class="cb"></li>
			</ul>
		<?php } ?>
		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
	</div>
	<div class="amp-wp-content featured-image-content">
    <?php if($redux_builder_amp['enable-single-featured-img'] == true) {
        if ( has_post_thumbnail() ) { ?>
        <?php
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
        $thumb_url = $thumb_url_array[0];
        ?>
        <div class="post-featured-img"><amp-img src=<?php echo $thumb_url ?> width=512 height=300 layout=responsive></amp-img></div>
    <?php } } ?>
	</div>
	<div class="amp-wp-content the_content">

        <?php do_action( 'ampforwp_before_post_content', $this ); ?>

		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
		<?php do_action( 'ampforwp_after_post_content', $this ); ?>
	</div>

	<div class="amp-wp-content post-pagination-meta">
		<?php if($redux_builder_amp['ampforwp-single-tags-on-off'] == true) {
				$this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) );

			} ?>


    <?php if($redux_builder_amp['enable-next-previous-pagination'] == true) { ?>
		<div id="pagination">
			<div class="next"><?php next_post_link(); ?></div>
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="clearfix"></div>
		</div>
    <?php } ?>
	</div>

	<?php if($redux_builder_amp['enable-single-social-icons'] == true)  { ?>
		<div class="sticky_social">
			<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
		    	<amp-social-share type="facebook"    data-param-app_id="<?php echo $redux_builder_amp['amp-facebook-app-id']; ?>" width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  { ?>
		    	<amp-social-share type="twitter"    width="50" height="28"></amp-social-share>
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
		    	<amp-social-share type="linkedin" width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-whatsapp-share'] == true)  { ?>
						<a href="whatsapp://send">
						<div class="whatsapp-share-icon">
						    <amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTAgOTAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkwIDkwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IldoYXRzQXBwIiBkPSJNOTAsNDMuODQxYzAsMjQuMjEzLTE5Ljc3OSw0My44NDEtNDQuMTgyLDQzLjg0MWMtNy43NDcsMC0xNS4wMjUtMS45OC0yMS4zNTctNS40NTVMMCw5MGw3Ljk3NS0yMy41MjIgICBjLTQuMDIzLTYuNjA2LTYuMzQtMTQuMzU0LTYuMzQtMjIuNjM3QzEuNjM1LDE5LjYyOCwyMS40MTYsMCw0NS44MTgsMEM3MC4yMjMsMCw5MCwxOS42MjgsOTAsNDMuODQxeiBNNDUuODE4LDYuOTgyICAgYy0yMC40ODQsMC0zNy4xNDYsMTYuNTM1LTM3LjE0NiwzNi44NTljMCw4LjA2NSwyLjYyOSwxNS41MzQsNy4wNzYsMjEuNjFMMTEuMTA3LDc5LjE0bDE0LjI3NS00LjUzNyAgIGM1Ljg2NSwzLjg1MSwxMi44OTEsNi4wOTcsMjAuNDM3LDYuMDk3YzIwLjQ4MSwwLDM3LjE0Ni0xNi41MzMsMzcuMTQ2LTM2Ljg1N1M2Ni4zMDEsNi45ODIsNDUuODE4LDYuOTgyeiBNNjguMTI5LDUzLjkzOCAgIGMtMC4yNzMtMC40NDctMC45OTQtMC43MTctMi4wNzYtMS4yNTRjLTEuMDg0LTAuNTM3LTYuNDEtMy4xMzgtNy40LTMuNDk1Yy0wLjk5My0wLjM1OC0xLjcxNy0wLjUzOC0yLjQzOCwwLjUzNyAgIGMtMC43MjEsMS4wNzYtMi43OTcsMy40OTUtMy40Myw0LjIxMmMtMC42MzIsMC43MTktMS4yNjMsMC44MDktMi4zNDcsMC4yNzFjLTEuMDgyLTAuNTM3LTQuNTcxLTEuNjczLTguNzA4LTUuMzMzICAgYy0zLjIxOS0yLjg0OC01LjM5My02LjM2NC02LjAyNS03LjQ0MWMtMC42MzEtMS4wNzUtMC4wNjYtMS42NTYsMC40NzUtMi4xOTFjMC40ODgtMC40ODIsMS4wODQtMS4yNTUsMS42MjUtMS44ODIgICBjMC41NDMtMC42MjgsMC43MjMtMS4wNzUsMS4wODItMS43OTNjMC4zNjMtMC43MTcsMC4xODItMS4zNDQtMC4wOS0xLjg4M2MtMC4yNy0wLjUzNy0yLjQzOC01LjgyNS0zLjM0LTcuOTc3ICAgYy0wLjkwMi0yLjE1LTEuODAzLTEuNzkyLTIuNDM2LTEuNzkyYy0wLjYzMSwwLTEuMzU0LTAuMDktMi4wNzYtMC4wOWMtMC43MjIsMC0xLjg5NiwwLjI2OS0yLjg4OSwxLjM0NCAgIGMtMC45OTIsMS4wNzYtMy43ODksMy42NzYtMy43ODksOC45NjNjMCw1LjI4OCwzLjg3OSwxMC4zOTcsNC40MjIsMTEuMTEzYzAuNTQxLDAuNzE2LDcuNDksMTEuOTIsMTguNSwxNi4yMjMgICBDNTguMiw2NS43NzEsNTguMiw2NC4zMzYsNjAuMTg2LDY0LjE1NmMxLjk4NC0wLjE3OSw2LjQwNi0yLjU5OSw3LjMxMi01LjEwN0M2OC4zOTgsNTYuNTM3LDY4LjM5OCw1NC4zODYsNjguMTI5LDUzLjkzOHoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="30" height="20" />
						    </div>
							</a>
        <?php } ?>
		</div>
	<?php } ?>

		<?php
		//related posts code starts here
					$orig_post = $post;
		    	global $post;
// ampforwp-single-select-type-of-related-switch
				if($redux_builder_amp['ampforwp-single-select-type-of-related-switch']==1){	//code block for categories
					if($redux_builder_amp['ampforwp-single-select-type-of-related']==2){
				    $categories = get_the_category($post->ID);
							if ($categories) {
									$category_ids = array();
									foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
									$args=array(
									    'category__in' => $category_ids,
									    'post__not_in' => array($post->ID),
									    'posts_per_page'=> 3,
									    'caller_get_posts'=>1
									);
								}
							}//end of block for categories

					//code block for tags
					if($redux_builder_amp['ampforwp-single-select-type-of-related']==1) {
						$ampforwp_tags = get_the_tags($post->ID);
							if ($ampforwp_tags) {
											$tag_ids = array();
											foreach($ampforwp_tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
											$args=array(
											   'tag__and' => $tag_ids,
											    'post__not_in' => array($post->ID),
											    'posts_per_page'=> 3,
											    'caller_get_posts'=>1
											);
						}
					}//end of block for tags
				}			$my_query = new wp_query( $args );
							if( $my_query->have_posts() ) { ?>
								<div class="amp-wp-content relatedpost">
								    <div class="related_posts">
												<ol class="clearfix">
														<h3>Related Posts</h3>
														<?php
												    while( $my_query->have_posts() ) {
														    $my_query->the_post();?>
																<li class="<?php if ( has_post_thumbnail() ) { echo'has_related_thumbnail'; } else { echo 'no_related_thumbnail'; } ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
											            <?php
												            $thumb_id_2 = get_post_thumbnail_id();
												            $thumb_url_array_2 = wp_get_attachment_image_src($thumb_id_2, 'thumbnail', true);
												            $thumb_url_2 = $thumb_url_array_2[0];
											            ?>

																	<?php if ( has_post_thumbnail() ) { ?>
											            	<amp-img src="<?php echo $thumb_url_2 ?>" width="150" height="150" layout="responsive"></amp-img>
																	<?php } ?>

<?php
$related_post_permalink = get_permalink();
$related_post_permalink = trailingslashit($related_post_permalink);
?>
										                <div class="related_link">
										                    <a href="<?php
																				echo $related_post_permalink . AMP_QUERY_VAR ;?>"><?php the_title(); ?></a>
										                    <?php $content = get_the_content();?>
										                    <p><?php echo wp_trim_words( $content , '15' ); ?></p>
										                </div>
										            </li>
																<?php
															}

							        } ?>
											</ol>
								    </div>
								</div>
						<?php
				        $post = $orig_post;
				        wp_reset_query();
//related posts code ends here
		?>


		<?php if($redux_builder_amp['ampforwp-single-comments-on-off'] == true) { ?>
		<!-- Comments -->
			<?php
					// Gather comments for a specific page/post
					$postID = get_the_ID();
					$comments = get_comments(array(
							'post_id' => $postID,
							'status' => 'approve' //Change this to the type of comments to be displayed
					));
					if ( $comments ) { ?>
						<div class="amp-wp-content comments_list">
								<h3>View Comments</h3>
						    <ul>
						        <?php
											// Display the list of comments
				              wp_list_comments( array(
				                  'per_page' 					=> 10, //Allow comment pagination
				                  'style' 						=> 'li',
				                  'type'							=> 'comment',
				                  'max_depth'   			=> 0,
				                  'avatar_size'				=> 0,
				                  'reverse_top_level' => false //Show the latest comments at the top of the list
				              ), $comments);

										?>
						    </ul>
						</div>
						<div class="comment-button-wrapper">
						    <a href="<?php echo get_permalink().'#commentform' ?>">Leave a Comment</a>
						</div><?php
				}
			} ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
