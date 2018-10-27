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
				<span><?php echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-categories-text'], 'Categories' )); ?></span>
				<?php foreach ($ampforwp_categories as $cat ) {
						if( true == $redux_builder_amp['ampforwp-archive-support'] && true == $redux_builder_amp['ampforwp-cats-tags-links-single']) {
								echo ('<span class="amp-cat amp-cat-'.esc_attr($cat->term_id).'"><a href="'. ampforwp_url_controller( get_category_link( $cat->term_id ) )   .'" > '. esc_html($cat->name) .'</a></span>');//#934
						} else {
							 echo '<span class="amp-cat">'. esc_html($cat->name) .'</span>';
						}
			} ?>
		</div>
	<?php endif; 
}
function ampforwp_framework_get_tags_list(){
	global $post, $redux_builder_amp;
	 	$ampforwp_tags = get_the_terms( $post->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags )  ) :?>
				<div class="amp-tags">
					<span><?php echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags' )); ?></span>
					<?php foreach ( $ampforwp_tags as $tag ) {
						if( true == $redux_builder_amp['ampforwp-archive-support'] && true == $redux_builder_amp['ampforwp-cats-tags-links-single'] ) {
                			echo ('<span class="amp-tag amp-tag-'.esc_attr($tag->term_id).'"><a href="'. ampforwp_url_controller( get_tag_link( $tag->term_id ) ).'" >'.esc_html($tag->name) .'</a></span>');//#934
						} else {
							 	echo ('<span class="amp-tag">'.esc_html($tag->name).'</span>');
						}
					}?>
				</div>
	<?php endif; 
}