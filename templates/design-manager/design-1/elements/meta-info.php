<?php do_action('ampforwp_before_meta_info_hook',$this); ?>
<?php global $redux_builder_amp; ?>
<div class="amp-wp-article-header ampforwp-meta-info <?php if( is_page() && ! $redux_builder_amp['meta_page'] ) {?> hide-meta-info <?php  }?>">

	<?php $post_author = $this->get( 'post_author' ); ?>
	<?php
	if ( $post_author ) : ?>
		<div class="amp-wp-meta amp-wp-byline">
		<?php
			$author_image = get_avatar_url( $post_author->user_email, array( 'size' => 24 ) );
			 if ( function_exists( 'get_avatar_url' ) && ( $author_image ) ) {  
			 if( is_single()) { ?>
				<amp-img src="<?php echo esc_url($author_image); ?>" width="24" height="24" layout="fixed"></amp-img>
				<span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>
				<?php } 
			 if( is_page() && $redux_builder_amp['meta_page'] ) { 	?>
				<amp-img src="<?php echo esc_url($author_image); ?>" width="24" height="24" layout="fixed"></amp-img>
				<span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>
				<?php } } ?>
		</div>
	<?php endif; ?>

	<div class="amp-wp-meta amp-wp-posted-on">
		<time datetime="<?php echo esc_attr( date( 'c', $this->get( 'post_modified_timestamp' ) ) ); ?>">
		<?php if( is_single()) {
			global $redux_builder_amp;
			echo esc_html(
				sprintf(
					_x( '%s '.ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' ), '%s = human-readable time difference', 'accelerated-mobile-pages' ),
					human_time_diff( $this->get( 'post_publish_timestamp' ), current_time( 'timestamp' ) )
				)
			);
			}?>
		<?php if( is_page() && $redux_builder_amp['meta_page'] ) {
			echo esc_html(
				sprintf(
					_x( '%s '.ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' ), '%s = human-readable time difference', 'accelerated-mobile-pages' ),
					human_time_diff( $this->get( 'post_publish_timestamp' ), current_time( 'timestamp' ) )
				)
			);
			}?>
		</time>
	</div>

</div>
<?php do_action('ampforwp_after_meta_info_hook',$this);
