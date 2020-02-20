<li class="amp-wp-posted-on">
	<?php global $post; ?>
    <time datetime="<?php echo esc_attr( mysql2date( DATE_W3C, $post->post_date_gmt, false ) ); ?>">
		<?php
		echo esc_html(
			sprintf(
				_x( '%s ago', '%s = human-readable time difference', 'accelerated-mobile-pages' ),
				human_time_diff( $this->get( 'post_publish_timestamp' ), current_time( 'timestamp' ) )
			)
		);
		?>
	</time>
</li>
