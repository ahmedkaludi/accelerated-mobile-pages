<div class="amp-wp-article-header ampforwp-meta-info">
	<div class="amp-wp-content post-title-meta">

			<ul class="amp-wp-meta amp-meta-wrapper">
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

<?php
  $ampforwp_categories = get_the_terms( $this->ID, 'category' );
  if ( $ampforwp_categories ) : ?>
  	<div class="amp-wp-meta amp-wp-tax-category ampforwp-tax-category">
  		<span>
				<?php global $redux_builder_amp;
				//if RTL is OFF
				if(!$redux_builder_amp['amp-rtl-select-option']) {
						 global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-categories-text'] .' ', 'amp' ));
							}
				?>
			</span>
      <?php foreach ($ampforwp_categories as $cat ) {
					echo ('<a href="'.trailingslashit(get_category_link($cat->term_taxonomy_id)).'?amp" >'.$cat->name .'</a>');
      }

			//if RTL is ON
			if($redux_builder_amp['amp-rtl-select-option']) {
					 global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-categories-text'] .' ', 'amp' ));
						}
			 ?>
  	</div>
  <?php endif; ?>

			</ul>
	</div>
</div>
