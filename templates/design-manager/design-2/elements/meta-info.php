<div class="amp-wp-article-header ampforwp-meta-info">
	<div class="amp-wp-content post-title-meta">

			<ul class="amp-wp-meta">
				<?php $post_author = $this->get( 'post_author' ); ?>
				<?php if ( $post_author ) : ?>
					<?php $author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 24 ) ); ?>
					<div class="amp-wp-meta amp-wp-byline">
						<?php if ( function_exists( 'get_avatar_url' ) ) : ?>
							<amp-img src="<?php echo esc_url( $author_avatar_url ); ?>" width="24" height="24" layout="fixed"></amp-img>
						<?php endif; ?>
						<span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>
					</div>
				<?php endif; ?>


				<li> <?php _e(' on ','ampforwp'); the_time( get_option( 'date_format' ) ) ?></li>

				<?php $categories = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'amp' ), '', $this->ID ); ?>
				<?php if ( $categories ) : ?>
					<div class="amp-wp-meta amp-wp-tax-category">
						<?php printf( esc_html__( 'Categories: %s', 'amp' ), $categories ); ?>
					</div>
				<?php endif; ?>

				<li class="cb"></li>
			</ul>
	</div>
</div>
