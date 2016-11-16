<?php
  $ampforwp_categories = get_the_terms( $this->ID, 'category' );
  if ( $ampforwp_categories ) : ?>
  	<div class="amp-wp-meta amp-wp-tax-category ampforwp-tax-category">
  		<?php global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-categories-text'] .': ', 'amp' ));
      foreach ($ampforwp_categories as $cat ) {
          echo ('<a href="'.get_site_url().'/category/' . $cat->slug .'/?amp" >'.$cat->name .'</a>');
      } ?>
  	</div>
  <?php endif;
  
  $ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
  if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) : ?>
    <div class="amp-wp-meta amp-wp-tax-tag ampforwp-tax-tag">
    	<?php  global $redux_builder_amp; printf( __($redux_builder_amp['amp-translator-tags-text'] .': ', 'amp' ));
        foreach ($ampforwp_tags as $tag) {
            echo ('<a href="'.get_site_url().'/tag/' . $tag->slug .'/?amp" >'.$tag->name .'</a>');
        } ?>
    </div>
  <?php endif; ?>
