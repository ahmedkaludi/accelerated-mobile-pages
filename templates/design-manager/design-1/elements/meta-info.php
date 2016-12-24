<div class="amp-wp-article-header ampforwp-meta-info">

	<?php $post_author = $this->get( 'post_author' ); ?>
	<?php
	if ( $post_author ) : ?>
		<?php
		$string = get_avatar($post_author->user_email);
		$token = strtok($string, " ");
		$token = strtok(" ");
		$token = strtok(" ");
	?>
		<div class="amp-wp-meta amp-wp-byline">
			<?php if ( function_exists( 'get_avatar_url' ) ) : ?>
				<amp-img <?php echo $token; ?> width="24" height="24" layout="fixed"></amp-img>
			<?php endif; ?>
			<span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>
		</div>
	<?php endif; ?>

	<div class="amp-wp-meta amp-wp-posted-on">
		<time datetime="<?php echo esc_attr( date( 'c', $this->get( 'post_publish_timestamp' ) ) ); ?>">
			<?php
			global $redux_builder_amp;
			echo esc_html(
				sprintf(
					_x( '%s '.$redux_builder_amp['amp-translator-ago-date-text'], '%s = human-readable time difference', 'amp' ),
					human_time_diff( $this->get( 'post_publish_timestamp' ), current_time( 'timestamp' ) )
				)
			);
			?>
		</time>
	</div>

</div>
