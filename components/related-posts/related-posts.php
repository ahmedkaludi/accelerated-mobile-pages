<?php 
/*
	@data parameter have options for
	show_excerpt
*/
function ampforwp_framework_get_related_posts($argsdata=array()){
 	global $post,  $redux_builder_amp;
	do_action('ampforwp_above_related_post'); //Above Related Posts
	$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-related-posts'];
	$int_number_of_related_posts = round(abs(floatval($string_number_of_related_posts)));
	$my_query = related_post_loop_query();
	if( $my_query->have_posts() ) { ?>
		<div class="amp-related-posts">
			<ul class="clearfix">
				<?php ampforwp_related_post(); ?>
				<?php
			    while( $my_query->have_posts() ) {
				    $my_query->the_post();
				    
				?>
					<li class="<?php if ( has_post_thumbnail() ) { echo'has_thumbnail'; } else { echo 'no_thumbnail'; } ?>">
			            <?php
			            $related_post_permalink = ampforwp_url_controller( get_permalink() );
			            ampforwp_get_relatedpost_image('thumbnail');
			            ampforwp_get_relatedpost_content($argsdata);
			            ?> 
			        </li><?php
				}

			} ?>
			</ul>
		</div>
<?php wp_reset_postdata(); ?>
<?php do_action('ampforwp_below_related_post_hook'); 
}


function related_post_loop_query(){
	global $post,  $redux_builder_amp;
	$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-related-posts'];
	$int_number_of_related_posts = round(abs(floatval($string_number_of_related_posts)));
	$args = null;

	if($redux_builder_amp['ampforwp-single-select-type-of-related']==2){
	    $categories = get_the_category($post->ID);
				if ($categories) {
						$category_ids = array();
						foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
						$args=array(
						    'category__in' => $category_ids,
						    'post__not_in' => array($post->ID),
						    'posts_per_page'=> $int_number_of_related_posts,
						    'ignore_sticky_posts'=>1,
								'has_password' => false ,
								'post_status'=> 'publish'
						);
					}
		} 
    // tags
	 if($redux_builder_amp['ampforwp-single-select-type-of-related']==1) {
				$ampforwp_tags = get_the_tags($post->ID);
					if ($ampforwp_tags) {
									$tag_ids = array();
									foreach($ampforwp_tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
									$args=array(
									   'tag__in' => $tag_ids,
									    'post__not_in' => array($post->ID),
									    'posts_per_page'=> $int_number_of_related_posts,
									    'ignore_sticky_posts'=>1,
											'has_password' => false ,
											'post_status'=> 'publish'
									);
				}
		}
		$my_query = new wp_query( $args );
		return $my_query;
}

function ampforwp_related_post(){ 
	global $redux_builder_amp;
	?>
   <h3 class="amp-related-posts-title"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-related-text'], 'Related Post' ); ?></h3>
<?php } 


function ampforwp_get_relatedpost_image( $imagetype ='thumbnail'){
	$related_post_permalink = ampforwp_url_controller( get_permalink() );
	?>
	<a href="<?php echo esc_url( $related_post_permalink ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
	    <?php
	        $thumb_id_2 = get_post_thumbnail_id();
	        $thumb_url_array_2 = wp_get_attachment_image_src($thumb_id_2, $imagetype, true);
	        $thumb_url_2 = $thumb_url_array_2[0];
	    
	     if ( has_post_thumbnail() ) { ?>
	    	<amp-img src="<?php echo esc_url( $thumb_url_2 ); ?>" width="<?php echo $thumb_url_array_2[1]; ?>" height="<?php echo $thumb_url_array_2[2]; ?>" layout="responsive"></amp-img>
		<?php } ?>
	    </a>
<?php
}
function ampforwp_get_relatedpost_content($argsdata=array()){
	$related_post_permalink = ampforwp_url_controller( get_permalink() );
?>
	<div class="related_link">
			                <a href="<?php echo esc_url( $related_post_permalink ); ?>"><?php the_title(); ?></a>

			                <?php
			                $show_excerpt = (isset($argsdata['show_excerpt'])? $argsdata['show_excerpt'] : true);
			                if($show_excerpt){
			                     if(has_excerpt()){
										$content = get_the_excerpt();
									}else{
										$content = get_the_content();
									}
							?><p><?php 
							echo wp_trim_words( strip_shortcodes( $content ) , '15' ); 
							?></p><?php 
							} 
							$show_author = (isset($argsdata['show_author'])? $argsdata['show_author'] : true);
							if($show_author){
								$author_args = isset($argsdata['author_args'])? $argsdata['author_args'] : array();
								ampforwp_framework_get_author_box($author_args);
							}
						?>
						</div>
<?php
}