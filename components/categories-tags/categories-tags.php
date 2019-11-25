<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/* 
TODO: 1: Connect with options panel(archive support and translational panel)
2: Do we have to change the classes names as well?
*/
global $post;
function ampforwp_framework_get_categories_list( $separator = '' ){
	global $post, $redux_builder_amp;
	 $ampforwp_categories = get_the_terms( $post->ID, 'category' );
	 if(ampforwp_get_setting('ampforwp-cats-single') == '1'){
		if ( $ampforwp_categories ) : ?>
		<div class="amp-category">
				<span><?php echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-categories-text'], 'Categories' )); ?></span>
				<?php 
				$anchorTag = $anchorClose = '';
				foreach ($ampforwp_categories as $key=>$cat ) {
					$term_id   = $cat->term_id;
				    $term_name   = $cat->name;
				    if( true == ampforwp_get_setting('ampforwp-cats-tags-links-single') ){
							$url   = get_category_link( $cat->term_id );
							if( true == ampforwp_get_setting('ampforwp-archive-support') && true == ampforwp_get_setting('ampforwp-archive-support-cat')){
								$url = ampforwp_url_controller($url);
							}
							$anchorTag = '<a href="'.esc_url($url).'" title="'.esc_html($term_name).'">';
							$anchorClose = "</a>";
							echo ('<span class="amp-cat amp-cat-'.esc_attr($term_id).'">'.$anchorTag.esc_html($term_name).$anchorClose.'</span>');
					}else{
						echo ('<span class="amp-cat"> '.esc_html($term_name).'</span>');
					}
		          
					if(!empty($separator) && count($ampforwp_categories)-1 > $key){
							echo esc_html($separator);
						}	
			} ?>
		</div>
	<?php endif; 
}
}
function ampforwp_framework_get_tags_list($separator=''){
	global $post, $redux_builder_amp;
	 	$ampforwp_tags = get_the_terms( $post->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags )  ) :?>
				<div class="amp-tags">
					<span><?php echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags' )); ?></span>
					<?php 
					$anchorTag = $anchorClose = '';
					foreach ( $ampforwp_tags as $key=>$tag ) {
						if( true == ampforwp_get_setting('ampforwp-cats-tags-links-single') ){
							$url =  get_tag_link( $tag->term_id );
							if( true == ampforwp_get_setting('ampforwp-archive-support') && true == ampforwp_get_setting('ampforwp-archive-support-tag')){
								$url = ampforwp_url_controller($url);
							}
							$anchorTag = '<a href="'.esc_url($url).'" title="'.esc_html($tag->name).'">';
							$anchorClose = "</a>";
							echo ('<span class="amp-tag amp-tag-'.esc_attr($tag->term_id).'">'.$anchorTag.esc_html($tag->name).$anchorClose.'</span>');
						}else{
							echo ('<span class="amp-tag"> '.esc_html($tag->name).'</span>');
						}
						if(!empty($separator) && count($ampforwp_tags)-1 > $key){
							echo esc_html($separator);
						}
					}?>
				</div>
	<?php endif; 
}