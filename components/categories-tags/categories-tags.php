<?php 
/* 
TODO: 1: Connect with options panel(archive support and translational panel)
2: Do we have to change the classes names as well?
*/
global $post;
function ampforwp_framework_get_categories_list(){
	global $post, $redux_builder_amp;
	 $ampforwp_categories = get_the_terms( $post->ID, 'category' );
		if ( $ampforwp_categories ) : ?>
		<div class="amp-category">
				<span><?php echo ampforwp_translation($redux_builder_amp['amp-translator-categories-text'], 'Categories' ); ?></span>
				<?php foreach ($ampforwp_categories as $cat ) {
						if( true == $redux_builder_amp['ampforwp-archive-support'] && true == $redux_builder_amp['ampforwp-cats-tags-links-single']) {
								echo ('<span class="amp-cat amp-cat-'.$cat->term_id.'"><a href="'. ampforwp_url_controller( get_category_link( $cat->term_id ) )   .'" > '. $cat->name .'</a></span>');//#934
						} else {
							 echo '<span class="amp-cat">'. $cat->name .'</span>';
						}
			} ?>
		</div>
	<?php endif; 
}
function ampforwp_framework_get_tags_list(){
	global $post, $redux_builder_amp;
	 	$ampforwp_tags = get_the_terms( $post->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) :?>
				<div class="amp-tags">
					<?php /* if($redux_builder_amp['amp-rtl-select-option']==0) {
					  		 global $redux_builder_amp; printf( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'] .' ', 'accelerated-mobile-pages' ));
							 		}*/
							 		?>
					<span><?php echo ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags' ); ?></span>
					<?php foreach ( $ampforwp_tags as $tag ) {
						if( true == $redux_builder_amp['ampforwp-archive-support'] && true == $redux_builder_amp['ampforwp-cats-tags-links-single'] ) {
                			echo ('<span class="amp-tag amp-tag-'.$tag->term_id.'"><a href="'. ampforwp_url_controller( get_tag_link( $tag->term_id ) ).'" >'.$tag->name .'</a></span>');//#934
						} else {
							 	echo ('<span class="amp-tag">'.$tag->name.'</span>');
						}
					}
					/*	if($redux_builder_amp['amp-rtl-select-option']) {
						  		 global $redux_builder_amp; printf( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'] .' ', 'accelerated-mobile-pages' ));
						}*/ ?>
				</div>
	<?php endif; 
}