<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
do_action('ampforwp_before_meta_info_hook',$this); ?>
<?php global $redux_builder_amp;
if ( is_single() || (is_page() && $redux_builder_amp['meta_page']) ) : ?>
<div class="amp-wp-content amp-wp-article-header ampforwp-meta-info">
	<div class="amp-wp-content post-title-meta">

	<ul class="amp-wp-meta amp-meta-wrapper">
<?php $post_author = $this->get( 'post_author' ); ?>
<?php if ( $post_author ) : ?>
  <li>
	<div class="amp-wp-meta amp-wp-byline">
  <?php if ( is_single() ) { 
    echo ampforwp_get_author_details( $post_author , 'meta-info' ); 
  } ?>
<?php if( is_page() && $redux_builder_amp['meta_page'] ) {
    echo ampforwp_get_author_details( $post_author , 'meta-info' );
    } ?>
<?php 
if( isset($redux_builder_amp['ampforwp-cats-single']) && $redux_builder_amp['ampforwp-cats-single']) {
  $ampforwp_categories = get_the_terms( $this->ID, 'category' );
  if ( $ampforwp_categories ) : ?>
  	<span class="amp-wp-meta amp-wp-tax-category ampforwp-tax-category  ">
      <?php
        global $redux_builder_amp; printf( esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-in-designthree'] , 'in' ) .' ')); 

        foreach ($ampforwp_categories as $cat ) {
            if( true == ampforwp_get_setting('ampforwp-cats-tags-links-single')){
                $cat_link = get_category_link( $cat->term_id );
                if( true == ampforwp_get_setting('ampforwp-archive-support') &&  true == ampforwp_get_setting('ampforwp-archive-support-cat')){
                  $cat_link = ampforwp_url_controller(get_category_link( $cat->term_id ));
                }
                echo ('<span class="amp-cat-'.esc_attr($cat->term_id).'"><a href="'.esc_url($cat_link). '" >'. esc_html($cat->name) .'</a></span>');
                do_action('ampforwp_post_views_ct'); 
            }else{
              echo '<span class="amp-cat">'. esc_html($cat->name) .'</span>';
            }
       }
			?>
  	</span>
<?php endif;  } ?>

<?php if ( $redux_builder_amp['amp-design-3-date-feature'] ) : ?>
	<span class="ampforwp-design3-single-date"><?php global $redux_builder_amp;
  $date = get_the_date( get_option( 'date_format' ));
   if(1 == ampforwp_get_setting('ampforwp-post-date-global') && true == ampforwp_get_setting('ampforwp-post-time')){
    $date = get_the_date( get_option( 'date_format' )) . ', ' . get_the_time();
  }
  elseif( 2 == ampforwp_get_setting('ampforwp-post-date-global') && true == ampforwp_get_setting('ampforwp-post-time')){
    $date = get_the_modified_date( get_option( 'date_format' ) ) . ', ' . get_the_modified_time() ;
  }
  elseif(1 == ampforwp_get_setting('ampforwp-post-date-global')){
    $date = get_the_date( get_option( 'date_format' ));
  }
  elseif(2 == ampforwp_get_setting('ampforwp-post-date-global')){
    $date = get_the_modified_date( get_option( 'date_format' ) );
  }
  echo esc_attr(apply_filters('ampforwp_modify_post_date', ampforwp_translation($redux_builder_amp['amp-translator-on-text'], 'On') . ' ' . $date )) ?></span>
<?php endif; ?>

	</div>
<?php endif; ?>

      </li>
			</ul>
	</div>
</div>
<?php endif; ?>
<?php do_action('ampforwp_after_meta_info_hook',$this);
