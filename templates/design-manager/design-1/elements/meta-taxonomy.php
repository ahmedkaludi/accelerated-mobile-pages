<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
	if( isset($redux_builder_amp['ampforwp-cats-single']) && $redux_builder_amp['ampforwp-cats-single'] || isset($redux_builder_amp['ampforwp-tags-single']) && $redux_builder_amp['ampforwp-tags-single'] ) { ?>
<div class="amp-wp-article-header amp-wp-article-category ampforwp-meta-taxonomy ">

	
	<?php do_action('ampforwp_before_meta_taxonomy_hook',$this); 

	if( isset($redux_builder_amp['ampforwp-cats-single']) && $redux_builder_amp['ampforwp-cats-single']) { ?>

	<?php $ampforwp_categories = get_the_terms( $this->ID, 'category' );
		if ( $ampforwp_categories ) : ?>
		<div class="amp-wp-meta amp-wp-tax-category">
				<span><?php global $redux_builder_amp; printf(esc_attr( ampforwp_translation($redux_builder_amp['amp-translator-categories-text'], 'Categories:' ) .' ' )); ?></span>
				<?php foreach ($ampforwp_categories as $cat ) {
					$term_id   = $cat->term_id;
		            $term_name   = $cat->name;
		            $term_url   = get_category_link( $cat->term_id );
		          	if(true == ampforwp_get_setting('ampforwp-cats-tags-links-single')){
						$cat_link = get_category_link( $cat->term_id );
						if(true == ampforwp_get_setting('ampforwp-cats-tags-links-single') && ampforwp_get_setting('ampforwp-archive-support-cat') == true ){
							$cat_link = ampforwp_url_controller($cat_link);
						}
		                echo ('<span class="amp-cat-'.esc_attr($cat->term_id).'"><a href="'. esc_url($cat_link) .'" title="'.esc_html($cat->name).'" > '. esc_html($cat->name) .'</a></span>');//#934
					}else{
						echo '<span class="amp-cat">'. esc_html($cat->name) .'</span>';
					}
			} ?>
		</div>
	<?php endif; } ?>


	<?php	
		if( isset($redux_builder_amp['ampforwp-tags-single']) && $redux_builder_amp['ampforwp-tags-single']) {

			$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) :?>
				<div class="amp-wp-meta amp-wp-tax-tag ampforwp-tax-tag">
					<?php  if($redux_builder_amp['amp-rtl-select-option']==0) {
					  		 printf( esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags:' ) .' ' ));
							 		}
						foreach ($ampforwp_tags as $tag) {
							if(ampforwp_get_setting('ampforwp-cats-tags-links-single') == true){
								$tag_link = get_tag_link( $tag->term_id );
								if(ampforwp_get_setting('ampforwp-archive-support') == true && ampforwp_get_setting('ampforwp-archive-support-tag') == true){
									$tag_link = ampforwp_url_controller($tag_link);
								}
								echo ('<span class="amp-tag-'.$tag->term_id.'"><a href="'.esc_url($tag_link).'" >'.esc_html($tag->name) .'</a></span>');//#934
							}else{
								echo ('<span>'.esc_html($tag->name).'</span>');
							}
						}
						if($redux_builder_amp['amp-rtl-select-option']) {
						  	echo '<span class="tt-lb">'.esc_attr( ampforwp_translation($redux_builder_amp['amp-translator-tags-text'], 'Tags:' ) .' ' ).'</span>';
						}?>
				</div>
	<?php endif; }?>

</div> <?php } ?>

<?php

if( array_key_exists( 'amp-author-description' , $redux_builder_amp ) && is_single() && !class_exists('Simple_Author_Box') ) {
	if( $redux_builder_amp['amp-author-description'] ) { ?>
	<div class="amp-wp-content amp_author_area ampforwp-meta-taxonomy">
	    <div class="amp_author_area_wrapper">
	        <?php $post_author = $this->get( 'post_author' );
	            if ( $post_author ) {
	            	//If Avatar is set up in WP user avatar: grab it
	            	$author_avatar_url = ampforwp_get_wp_user_avatar();
	            	//Else : Get the Gravatar
	            	if($author_avatar_url == null){
	            		$author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 70 ) );
	            	}
	                if ( $author_avatar_url ) { ?>
	                    <amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo esc_url($author_avatar_url); ?>" width="70" height="70" layout="fixed"></amp-img>
	                    <?php
	                } 
	                echo ampforwp_get_author_details( $post_author , 'meta-taxonomy' );
	               	echo ampforwp_yoast_twitter_handle();  
	               	echo esc_html($post_author->description);
	            } ?>
	    </div>
	</div> <?php
	}
}
do_action('ampforwp_after_meta_taxonomy_hook',$this);