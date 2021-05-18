<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post, $redux_builder_amp;
do_action('ampforwp_above_related_post',$this); //Above Related Posts
$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-related-posts'];		
$int_number_of_related_posts = (int)$string_number_of_related_posts;

// declaring this variable here to prevent debug errors
$args = null;
$orderby = 'ID';
// declaring this variable for counting number of related post
$r_count = 1;
// Check for the order of related posts
if( isset( $redux_builder_amp['ampforwp-single-order-of-related-posts'] ) && $redux_builder_amp['ampforwp-single-order-of-related-posts'] ){
	$orderby = 'rand';
}
// Custom Post types 
if( $current_post_type = get_post_type( $post )) {
// The query arguments
	if($current_post_type != 'page'){
    $args = array(
    	'fields'=>'ids',
        'posts_per_page'=> $int_number_of_related_posts,
        'post__not_in' => array($post->ID),
        'order' => 'DESC',
        'orderby' => $orderby,
        'post_type' => $current_post_type,
        'no_found_rows' 	  => true,
        'meta_query' => array(
			array(
					'key'        => 'ampforwp-amp-on-off',
					'value'      => 'default',
				)
		)
    );
 }   			
}//end of block for custom Post types

if($redux_builder_amp['ampforwp-single-select-type-of-related']==2){
	$categories = get_the_category($post->ID);
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
			'fields'=>'ids',
		    'category__in' 		 => $category_ids,
		    'posts_per_page'	 => $int_number_of_related_posts,
		    'ignore_sticky_posts'=> 1,
            'has_password' 		 => false ,
            'post_status'		 => 'publish',
            'orderby' 			 => $orderby,
            'no_found_rows' 	  => true,
		    'meta_query' => array(
		    	array(
		    		'key' => 'ampforwp-amp-on-off',
			    	'value' => 'default',
		    	)
		    )
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
			  'fields'=>'ids',
			   'tag__in' 			 => $tag_ids,
			    'posts_per_page'	 => $int_number_of_related_posts,
			    'post__not_in' => array($post->ID),
			    'ignore_sticky_posts'=> 1,
            'has_password' 			 => false ,
            'post_status'			 => 'publish',
            'orderby' 				 => $orderby,
			   'no_found_rows' 	  	 => true,
			   'meta_query' => array(
					array(
			    		'key' => 'ampforwp-amp-on-off',
			    		'value' => 'default',
		    		)
				)
			);
	}
}//end of block for tags

// Related Posts Based on Past few Days #2132
if ( isset($redux_builder_amp['ampforwp-related-posts-days-switch']) && true == $redux_builder_amp['ampforwp-related-posts-days-switch'] ) {
	$date_range = strtotime ( '-' . $redux_builder_amp['ampforwp-related-posts-days-text'] .' day' );
	$args['date_query'] = array(
				            array(
				                'after' => array(
				                    'year'  => date('Y', $date_range ),
				                    'month' => date('m', $date_range ),
				                    'day'   => date('d', $date_range ),
				                	),
				            	)
				       		); 
}
if( isset($redux_builder_amp['ampforwp-single-related-posts-switch']) && $redux_builder_amp['ampforwp-single-related-posts-switch'] && $redux_builder_amp['ampforwp-single-select-type-of-related'] ) {
	$args = apply_filters('ampforwp_related_posts_query_args', $args);
	$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) { ?>
			<div class="amp-wp-content relatedpost">
			     <div class="rp">
			    	<span class="related-title">
				    <?php if (function_exists('pll__')) {
			    		echo pll__(esc_html__( ampforwp_get_setting('amp-translator-related-text'), 'accelerated-mobile-pages'));
			    	}else{
			    		echo esc_attr(ampforwp_translation( ampforwp_get_setting('amp-translator-related-text'), 'Related Post' ));
			    	} ?></span>
					<ol class="clearfix">
						<?php
						$current_id = ampforwp_get_the_ID();
					    while( $my_query->have_posts() ) {
						    $my_query->the_post();
						    if(ampforwp_get_the_ID()==$current_id){
				            	continue;
				            }
							$related_post_permalink = ampforwp_url_controller( get_permalink() );
							if ( ampforwp_get_setting('ampforwp-single-related-posts-link') ) {
								$related_post_permalink = get_permalink();
							} 
							$related_post_permalink = ampforwp_modify_url_utm_params($related_post_permalink);
							?>
							<li class="<?php if ( ampforwp_has_post_thumbnail() ) { echo'has_related_thumbnail'; } else { echo 'no_related_thumbnail'; } ?>">
							<?php if ( ampforwp_has_post_thumbnail() ) {
								if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) {
									$width = 150;
									$height = 150;
									$image_args = array("tag"=>'div','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height,'responsive'=> 'true','referer'=>"related_post" );
									amp_loop_image($image_args);
								} 
								}?>
				                <div class="related_link">
				                    <?php $title = get_the_title(); ?>
				                    <a href="<?php echo esc_url( $related_post_permalink ); ?>" title="<?php echo esc_html( $title ); ?>" ><?php the_title(); ?></a>
				                    
				                    <?php if ( isset($redux_builder_amp['ampforwp-single-related-posts-excerpt']) && true == $redux_builder_amp['ampforwp-single-related-posts-excerpt'] ) {
				                    	$class = 'large-screen-excerpt';
		                    			if ( true == ampforwp_get_setting('excerpt-option-small-rp') ) {
											$class = 'small-screen-excerpt';
										}
					                    if(has_excerpt()){
											$content = get_the_excerpt();
										}else{
											$content = get_the_content();
										} ?>
				                    	<p class="<?php echo $class; ?>"><?php 
				                        $excerpt_length = ampforwp_get_setting('enable-excerpt-single-related-posts');
				                        if(empty($excerpt_length)){
											$excerpt_length = 15;
										}
				                    	if (true == ampforwp_get_setting('excerpt-option-rp-read-more')){
											$content .= '...&nbsp;';
										}
				                    	echo wp_trim_words( strip_shortcodes($content) , $excerpt_length ); ?><?php if (true == ampforwp_get_setting('excerpt-option-rp-read-more')){?><a class="readmore-rp" href="<?php echo esc_url( $related_post_permalink ); ?>"><?php echo ampforwp_translation(ampforwp_get_setting('amp-translator-read-more'),'Read More') ?></a></p>
				                    <?php } } ?>
				                </div>
				            </li>
					<?php 
					do_action('ampforwp_between_related_post',$r_count,$this);
     							 $r_count++;
				} ?>
					</ol>
			    </div>
			</div> <?php
			wp_reset_postdata();
			}
} ?>
<?php do_action('ampforwp_below_related_post',$this);