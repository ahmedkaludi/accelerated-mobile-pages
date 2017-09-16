<?php
function amp_archive_title(){
	global $redux_builder_amp;
	if ( is_archive() ) {
	    the_archive_title( '<h3 class="amp-archive-title">', '</h3>' );
	    the_archive_description( '<div class="amp-archive-desc">', '</div>' );
	}
	if(is_search()){
		$label = 'You searched for:';
		if(function_exists('ampforwp_translation')){
			$label = ampforwp_translation( $redux_builder_amp['amp-translator-search-text'], 'You searched for:');
		}
		echo '<h3 class="amp-loop-label">'.$label . '  ' . get_search_query().'</h3>';
	}
}

$amp_q ='';
function call_loops_standard($data=array()){
	global $amp_q;
	if (get_query_var( 'paged' ) ) {
	    $paged = get_query_var('paged');
	} elseif ( get_query_var( 'page' ) ) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}
	
	if ( is_archive() ) {
		$exclude_ids = get_option('ampforwp_exclude_post');
		$qobj = get_queried_object();
		$args =  array(
			'post_type'           => 'post',
			'orderby'             => 'date',
			'ignore_sticky_posts' => 1,
			'tax_query' => array(
					        array(
					          'taxonomy' => $qobj->taxonomy,
					          'field' => 'id',
					          'terms' => $qobj->term_id,
					    //    using a slug is also possible
					    //    'field' => 'slug', 
					    //    'terms' => $qobj->name
					        )
					        ),
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' => false ,
			'post_status'=> 'publish'
		  );
		$filtered_args = apply_filters('ampforwp_query_args', $args);
		$amp_q = new WP_Query( $filtered_args );
	}
	if ( is_home() ) {
		$exclude_ids = get_option('ampforwp_exclude_post');

		$args = array(
			'post_type'           => 'post',
			'orderby'             => 'date',
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password'		  => false ,
			'post_status'		  => 'publish'
		);
		$filtered_args = apply_filters('ampforwp_query_args', $args);
		$amp_q = new WP_Query( $filtered_args );
	}

	if ( is_search() ) {
		$exclude_ids = get_option('ampforwp_exclude_post');
		$args = array(
			's' 				  => get_search_query() ,
			'ignore_sticky_posts' => 1,
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' 		  => false ,
			'post_status'		  => 'publish'
		);
		$amp_q = new WP_Query( $args );
	}

}
//call_loops_standered();
/****
 * AMP Loop Functions
 * 
 *
 *
 *
 *
 */
//add_action("init", 'call_loops_standered');
	
	function amp_loop($selection,$data=array()){
		global $amp_q;
		if(empty($amp_q) || is_null($amp_q)){
			call_loops_standard();
            echo "<div class='loop-wrapper'>";
		}
		if ( !isset($ampLoopData['no_data']) ) :
			switch($selection){
				case 'start':
					return amp_start_loop();
				break;	
				case 'end':
					return amp_end_loop();
				break;		
			}
		else : // If no posts exist.
			 return false;
		endif; // End loop.
	}

	function amp_start_loop(){
		global $amp_q;
		$post_status = $amp_q->have_posts();
		$amp_q->the_post();
		return $post_status;
	}
	function amp_end_loop(){
		wp_reset_postdata();
        echo "</div>";
	}

	function amp_pagination(){
		global $amp_q, $redux_builder_amp;
		if (get_query_var( 'paged' ) ) {
		    $paged = get_query_var('paged');
		} elseif ( get_query_var( 'page' ) ) {
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}
		$pre_link = '';
        if ( $paged > 1 ) { 
          $pre_link = '<div class="left">'.get_previous_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-show-previous-posts-text'], 'Show previous Posts' ) ) .'</div>';
        }

        echo '<div class="loop-pagination">
          <div class="right">'. get_next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-show-more-posts-text'] , 'Show more Posts'), $amp_q->max_num_pages ) .'</div>
            '.$pre_link.'
          <div class="clearfix"></div>
        </div>';
    }

	/***
	* Get Title of post
	*/
	function amp_loop_title($data=array()){
		$data = array_filter($data);
		$tag = 'h2';
		if(isset($data['tag']) && $data['tag']!=""){
			$tag = $data['tag'];
		}
		$attributes = 'class="loop-title"';
		if(isset($data['attributes']) && $data['attributes']!=""){
			$attributes = $data['attributes'];
		}
		echo '<'.$tag.' '.$attributes.'>';
			if(!isset($data['link']) ){
				echo '<a href="'. amp_loop_permalink(true) .'">';
			}
		echo the_title('','',false);
		
			if(!isset($data['link']) ){
				echo  '</a>';
			}
		echo '</'.$tag.'>';
	}

	function amp_loop_date(){
		global $redux_builder_amp;
		$post_date =  human_time_diff(
        						get_the_time('U', get_the_ID() ), 
        						current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],
        						'ago');
        
        echo '<div class="loop-date">'.$post_date.'</div>';
	}

	function amp_loop_excerpt($no_of_words=15,$tag = 'p'){
		//excerpt
		if(has_excerpt()){
			$content = get_the_excerpt();
		}else{
			$content = get_the_content();
		}
		$content =  strip_shortcodes( $content );
		echo '<'.$tag.'>'. wp_trim_words(  $content, $no_of_words ) .'</'.$tag.'>';
	}
	function amp_loop_all_content($tag = 'p'){
		$fullContent = strip_shortcodes( get_the_content() );
		echo '<'.$tag.'>'. $fullContent .'</'.$tag.'>';
	}

	function amp_loop_permalink($return,$amp_query_var ='amp'){
		if($return){
			return user_trailingslashit(trailingslashit( get_permalink() ) . AMPFORWP_AMP_QUERY_VAR) ;
		}
		echo user_trailingslashit(trailingslashit( get_permalink() ) . AMPFORWP_AMP_QUERY_VAR) ;
	}
	function amp_loop_image($data=array()){
		global $ampLoopData,$counterOffset;
		if (has_post_thumbnail()  ) { 
			$tag = 'div';
			$tag_class = '';
			$imageClass = 'class =';
			if(isset($data['tag']) && $data['tag']!=""){
				$tag = $data['tag'];
			}
			if(isset($data['tag_class']) && $data['tag_class']!=""){
				$tag_class = $data['tag_class'];
			}
			if(isset($data['image_class']) && $data['image_class']!=""){
				$imageClass .= '"'.$data['image_class'].'"';
			}

			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];
			

			echo '<'.$tag.' class="loop-img '.$tag_class.'">';
			echo '<a href="'.amp_loop_permalink(true).'">';
			echo '<amp-img '.$imageClass.' layout="responsive" src="'. $thumb_url .'" width=150 height=150></amp-img>';
			echo '</a>';
			echo '</'.$tag.'>';
	     } 
	} 

	// Category
	function amp_loop_category(){
		echo ' <ul class="loop-category">';
		if(count(get_the_category()) > 0){
			foreach((get_the_category()) as $category) {
				echo '<li class="amp-cat-'. $category->term_id.'">'. $category->cat_name.'</li>';
			}
		}
		echo '</ul>';
	}




