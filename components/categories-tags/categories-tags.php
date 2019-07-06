<?php 
/* 
TODO: 1: Connect with options panel(archive support and translational panel)
2: Do we have to change the classes names as well?
*/
global $post;
function ampforwp_framework_get_categories_list( $separator = '',$showlimit = 'all' ){
	global $post, $redux_builder_amp;
	$count = 1;
	 $ampforwp_categories = get_the_terms( $post->ID, 'category' );
	 	if(ampforwp_get_setting('ampforwp-cats-single') == '1'){
		if ( $ampforwp_categories ) : ?>
		<div class="amp-category">
				<span><?php echo ampforwp_translation($redux_builder_amp['amp-translator-categories-text'], 'Categories' ); ?></span>
				<?php foreach ($ampforwp_categories as $key=>$cat ) {
					$term_id   = $cat->term_id;
				    $term_name   = $cat->name;
				    $term_url   = get_category_link( $cat->term_id );
					if(false == ampforwp_get_setting('ampforwp-cats-tags-links-single')){
						    $term_url =  false;
					    } 
					elseif( true == ampforwp_get_setting('ampforwp-archive-support') && true == ampforwp_get_setting('ampforwp-cats-tags-links-single')) {  	
							// #934
		            	     $term_url   = ampforwp_url_controller( $term_url );
		         		}

		            echo ('<span class="amp-cat amp-cat-'. esc_attr($term_id) . '" >
		            '. ($term_url? ' <a href="'. esc_url( $term_url)  . '" title="'. esc_html($term_name)  . '" > ':'').  esc_html($term_name). ($term_url?  '</a> ':'').' </span>');
		          	if($showlimit!='all' && $showlimit==$count){
		          		break;
		          	}
					if($separator && count($ampforwp_categories)-1 > $key){
							echo esc_html($separator);
						}
						$count++;
					} ?>
		</div>
	<?php endif; 
}	
}
function ampforwp_framework_get_tags_list( $separator = '' ){
	global $post, $redux_builder_amp;
	 	$ampforwp_tags = get_the_terms( $post->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags )  ) :?>
				<div class="amp-tags">
					<?php /* if($redux_builder_amp['amp-rtl-select-option']==0) {
					  		 global $redux_builder_amp; printf( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'] .' ', 'accelerated-mobile-pages' ));
							 		}*/
							 		?>
					<span><?php echo ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags' ); ?></span>
					<?php foreach ( $ampforwp_tags as $key=>$tag ) {
						if( true == $redux_builder_amp['ampforwp-archive-support'] && true == $redux_builder_amp['ampforwp-cats-tags-links-single'] ) {
                			echo ('<span class="amp-tag amp-tag-'.$tag->term_id.'"><a href="'. ampforwp_url_controller( get_tag_link( $tag->term_id ) ).'" title="'.esc_html($tag->name).'" > '.$tag->name .'</a></span>');//#934
						} else {
							 	echo ('<span class="amp-tag"> '.$tag->name.'</span>');
						}
						if(!empty($separator) && count($ampforwp_tags)-1 > $key){
							echo $separator;
						}
					}
					/*	if($redux_builder_amp['amp-rtl-select-option']) {
						  		 global $redux_builder_amp; printf( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'] .' ', 'accelerated-mobile-pages' ));
						}*/ ?>
				</div>
	<?php endif; 
}