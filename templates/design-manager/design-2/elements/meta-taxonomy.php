<?php
			global $redux_builder_amp; 
			$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
				if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) : ?>
						<div class="amp-wp-content amp-wp-meta amp-wp-tax-tag ampforwp-tax-tag">
							<?php printf( __( $redux_builder_amp['amp-translator-tags-text'] .': ', 'amp' ));
								foreach ($ampforwp_tags as $tag) {
										 echo ('<a href="'.get_tag_link($tag->term_taxonomy_id).'?' . AMP_QUERY_VAR .'" >'.$tag->name .'</a>');
								} ?>
						</div> <?php 
				endif; ?>
