<?php $post_author = $this->get( 'post_author' ); ?>
<?php if ( $post_author ) : ?>
	<?php $author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 24 ) ); ?>
	<div class="amp-wp-meta amp-wp-byline">
		<?php if ( function_exists( 'get_avatar_url' ) ) : ?>
			<amp-img src="<?php echo esc_url( $author_avatar_url ); ?>" width="24" height="24" layout="fixed"></amp-img>
		<?php endif; ?>
		<span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>

		<li class="amp-wp-meta-date"> <?php global $redux_builder_amp;  _e($redux_builder_amp['amp-translator-on-text']." ",'ampforwp'); the_time( get_option( 'date_format' ) ) ?></li>

	</div>
<?php endif; ?>
