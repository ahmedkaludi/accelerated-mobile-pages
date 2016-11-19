<div class="amp-wp-article-header ampforwp-meta-taxonomy">

	<?php 
	global $redux_builder_amp;
	$categories = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'ampforwp' ), '', $this->ID ); ?>
	<?php if ( $categories ) : ?>
		<div class="amp-wp-meta amp-wp-tax-category">
			<?php printf( esc_html__( $redux_builder_amp['amp-translator-categories-text'] . ' %s', 'ampforwp' ), $categories ); ?>
		</div>
	<?php endif; ?>

	<?php
	$tags = get_the_tag_list(
		'',
		_x( ', ', 'Used between list items, there is a space after the comma.', 'ampforwp' ),
		'',
		$this->ID
	); ?>
	<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
		<div class="amp-wp-meta amp-wp-tax-tag">
			<?php printf( esc_html__( $redux_builder_amp['amp-translator-tags-text'] .' %s', 'ampforwp' ), $tags ); ?>
		</div>
	<?php endif; ?>

</div>
