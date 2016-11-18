<div class="amp-wp-article-header ampforwp-meta-taxonomy">
	<?php
	$tags = get_the_tag_list(
		'',
		_x( ', ', 'Used between list items, there is a space after the comma.', 'ampforwp' ),
		'',
		$this->ID
	); ?>
	<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
		<div class="amp-wp-meta amp-wp-tax-tag">
			<?php printf( esc_html__( 'Tags: %s', 'ampforwp' ), $tags ); ?>
		</div>
	<?php endif; ?>

</div>
