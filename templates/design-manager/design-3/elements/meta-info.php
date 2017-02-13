<div class="amp-wp-content amp-wp-article-header ampforwp-meta-info">
	<div class="amp-wp-content post-title-meta">

			<ul class="amp-wp-meta amp-meta-wrapper">
<?php $post_author = $this->get( 'post_author' ); ?>
<?php if ( $post_author ) : ?>
	<?php $author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 24 ) ); ?>
	<div class="amp-wp-meta amp-wp-byline">
	<span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>

<?php $ampforwp_categories = get_the_terms( $this->ID, 'category' );
  if ( $ampforwp_categories ) : ?>
  	<span class="amp-wp-meta amp-wp-tax-category ampforwp-tax-category">
            <?php global $redux_builder_amp;
            //if RTL is OFF
            if(!$redux_builder_amp['amp-rtl-select-option']) {
            global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-in-designthree'] .' ', 'amp' )); } ?>
      <?php foreach ($ampforwp_categories as $cat ) {
        if($redux_builder_amp['ampforwp-archive-support']){
            echo ('<span><a href="'.trailingslashit(get_category_link($cat->term_taxonomy_id)).'amp" >'.$cat->name .'</a></span>');
      } else {
        echo ('<span>'.$cat->name .'</span>');
      }
       }
			//if RTL is ON
			if($redux_builder_amp['amp-rtl-select-option']) {
             global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-categories-text'] .' ', 'amp' )); } ?>
  	</span>
<?php endif; ?>

	</div>
<?php endif; ?>


			</ul>
	</div>
</div>
