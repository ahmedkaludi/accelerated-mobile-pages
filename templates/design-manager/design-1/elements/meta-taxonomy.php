<div class="amp-wp-article-header amp-wp-article-category ampforwp-meta-taxonomy ">

	<?php global $redux_builder_amp; ?>

	<?php $ampforwp_categories = get_the_terms( $this->ID, 'category' );
		if ( $ampforwp_categories ) : ?>
		<div class="amp-wp-meta amp-wp-tax-category">
				<span><?php global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-categories-text'] .' ', 'amp' )); ?></span>
				<?php foreach ($ampforwp_categories as $cat ) {
						echo (' <a href="'.trailingslashit(get_category_link($cat->term_taxonomy_id)).'?'. AMP_QUERY_VAR .'" > '. $cat->name .'</a>');
			} ?>
		</div>
	<?php endif; ?>


	<?php	$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) :?>
				<div class="amp-wp-meta amp-wp-tax-tag ampforwp-tax-tag">
					<?php  if($redux_builder_amp['amp-rtl-select-option']==0) {
					  		 global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-tags-text'] .' ', 'amp' ));
							 		}
						foreach ($ampforwp_tags as $tag) {
								echo ('<a href="'.trailingslashit(get_tag_link($tag->term_taxonomy_id)).'?amp" >'.$tag->name .'</a>');
						}
						if($redux_builder_amp['amp-rtl-select-option']) {
						  		 global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-tags-text'] .' ', 'amp' ));
						}?>
				</div>
	<?php endif;?>

</div>
