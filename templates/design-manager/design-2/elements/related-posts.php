<?php
		$orig_post = $post;
		global $post,  $redux_builder_amp;

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
			} //end of block for categories
			//code block for tags
		 if($redux_builder_amp['ampforwp-single-select-type-of-related']==1) {
					$ampforwp_tags = get_the_tags($post->ID);
						if ($ampforwp_tags) {
										$tag_ids = array();
										foreach($ampforwp_tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
										$args=array(
										   'tag__in' => $tag_ids,
										    'post__not_in' => array($post->ID),
										    'posts_per_page'=> 3,
										    'caller_get_posts'=>1,
										);
					}
			}//end of block for tags
			$my_query = new wp_query( $args );
					if( $my_query->have_posts() ) { ?>
						<div class="amp-wp-content relatedpost">
						    <div class="related_posts">
										<ol class="clearfix">
												<h3><?php echo esc_html( $redux_builder_amp['amp-translator-related-text'] ); ?></h3>
												<?php
										    while( $my_query->have_posts() ) {
												    $my_query->the_post();
															$related_post_permalink = get_permalink();
															$related_post_permalink = trailingslashit($related_post_permalink);
															$related_post_permalink = $related_post_permalink . AMP_QUERY_VAR ;;
														?>
														<li class="<?php if ( has_post_thumbnail() ) { echo'has_related_thumbnail'; } else { echo 'no_related_thumbnail'; } ?>"><a href="<?php echo esc_url( $related_post_permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									            <?php
										            $thumb_id_2 = get_post_thumbnail_id();
										            $thumb_url_array_2 = wp_get_attachment_image_src($thumb_id_2, 'thumbnail', true);
										            $thumb_url_2 = $thumb_url_array_2[0];
									            ?>

															<?php if ( has_post_thumbnail() ) { ?>
									            	<amp-img src="<?php echo esc_url( $thumb_url_2 ); ?>" width="150" height="150" layout="responsive"></amp-img>
															<?php } ?>
								                <div class="related_link">
								                    <a href="<?php echo esc_url( $related_post_permalink ); ?>"><?php the_title(); ?></a>
								                    <?php if(has_excerpt()){
																			$content = get_the_excerpt();
																		}else{
																			$content = get_the_content();
																		}
																		?>
								                    <p><?php echo wp_trim_words( $content , '15' ); ?></p>
								                </div>
								            </li>
														<?php
													}

					        } ?>
									</ol>
						    </div>
						</div> <?php
	      $post = $orig_post;
	      wp_reset_postdata();
//related posts code ends here
		?>
