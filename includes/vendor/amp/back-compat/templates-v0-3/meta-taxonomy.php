<?php $categories = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'accelerated-mobile-pages' ) ); ?>
<?php if ( $categories ) : ?>
	<li class="amp-wp-tax-category">
		<span class="screen-reader-text">Categories:</span>
		<?php
		echo esc_html($categories); ?>
	</li>
<?php endif; ?>

<?php $tags = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'accelerated-mobile-pages' ) ); ?>
<?php if ( $tags && ! is_wp_error( $tags ) ) : ?>
	<li class="amp-wp-tax-tag">
		<span class="screen-reader-text">Tags:</span>
		<?php echo esc_html($tags); ?>
	</li>
<?php endif; ?>
