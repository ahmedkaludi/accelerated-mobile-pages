
<?php do_action('ampforwp_before_meta_info_hook',$this); ?>
<?php global $redux_builder_amp; ?>
<div class="amp-wp-content amp-wp-article-header ampforwp-meta-info">
	<div class="amp-wp-content post-title-meta">

			<ul class="amp-wp-meta amp-meta-wrapper">
<?php $post_author = $this->get( 'post_author' ); ?>
<?php if ( $post_author ) : ?>
	<div class="amp-wp-meta amp-wp-byline">
  <?php if ( is_single() ) { ?>
	<span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>
  <?php } ?>
<?php if( is_page() && $redux_builder_amp['meta_page'] ) { ?>
  <span class="amp-wp-author author vcard"><?php echo esc_html( $post_author->display_name ); ?></span>
  <?php } ?>
<?php $ampforwp_categories = get_the_terms( $this->ID, 'category' );
  if ( $ampforwp_categories ) : ?>
  	<span class="amp-wp-meta amp-wp-tax-category ampforwp-tax-category  ">
      <?php
        global $redux_builder_amp; printf( ampforwp_translation($redux_builder_amp['amp-translator-in-designthree'] .' ', 'accelerated-mobile-pages' )); 
        foreach ($ampforwp_categories as $cat ) {
          if( isset($redux_builder_amp['ampforwp-archive-support']) && $redux_builder_amp['ampforwp-archive-support'] && isset($redux_builder_amp['ampforwp-cats-tags-links-single']) && $redux_builder_amp['ampforwp-cats-tags-links-single']) {
            echo ('<span class="amp-cat-'.$cat->term_id.'"><a href="'. user_trailingslashit( trailingslashit(get_category_link($cat->term_id)).'amp') . '" >'.$cat->name .'</a></span>'); 
        } 
      else {
        echo ('<span>'.$cat->name .'</span>');
      }
       }
			?>
  	</span>
<?php endif; ?>

<?php if ( $redux_builder_amp['amp-design-3-date-feature'] ) : ?>
	<span class="ampforwp-design3-single-date"><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-on-text']. ' ', 'On'); the_modified_date( get_option( 'date_format' ) ) ?></span>
<?php endif; ?>

	</div>
<?php endif; ?>


			</ul>
	</div>
</div>
<?php do_action('ampforwp_after_meta_info_hook',$this);
