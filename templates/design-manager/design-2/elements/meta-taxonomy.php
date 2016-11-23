<div class="amp-wp-article-header amp-wp-article-category ampforwp-meta-taxonomy ">


<?php
			global $redux_builder_amp; 
			$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) : ?>
				<div class="amp-wp-meta amp-wp-tax-tag ampforwp-tax-tag">
					<?php  global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-tags-text'] .': ', 'amp' ));
						foreach ($ampforwp_tags as $tag) {
								 echo ('<a href="'.get_tag_link($tag->term_taxonomy_id).'?amp" >'.$tag->name .'</a>');
						} ?>
				</div>
			<?php endif;?>
			 
</div>