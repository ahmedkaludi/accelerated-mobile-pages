<div class="amp-wp-article-header amp-wp-article-category ampforwp-meta-taxonomy ">

	<?php global $redux_builder_amp; ?>
	
	<?php $ampforwp_categories = get_the_terms( $this->ID, 'category' );
		if ( $ampforwp_categories ) : ?>
		<div class="amp-wp-meta amp-wp-tax-category">
				<span><?php global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-categories-text'] .': ', 'amp' )); ?></span>
				<?php foreach ($ampforwp_categories as $cat ) {
				echo (' <a href="'.get_category_link($cat->term_taxonomy_id).'?'. AMP_QUERY_VAR .'" > '. $cat->name .'</a>');
			} ?>
		</div>
	<?php endif; ?>


</div>
