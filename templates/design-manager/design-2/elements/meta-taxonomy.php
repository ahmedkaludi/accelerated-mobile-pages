<?php
	global $redux_builder_amp; 
	$tags = get_the_tag_list(
		'',
		_x( ', ', 'Used between list items, there is a space after the comma.', 'ampforwp' ),
		'',
		$this->ID
	); ?>
	<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
		<div class="amp-wp-content amp-wp-article-header ampforwp-meta-taxonomy">
			<div class="amp-wp-meta amp-wp-tax-tag">
				<?php printf( esc_html__( $redux_builder_amp['amp-translator-tags-text'] .' %s', 'ampforwp' ), $tags ); ?>
			</div>
		</div>
	<?php endif; ?>
