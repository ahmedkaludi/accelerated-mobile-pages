<?php do_action('ampforwp_before_meta_info_hook',$this);
global $redux_builder_amp;
if ( is_single() || (is_page() && $redux_builder_amp['meta_page']) ) : ?>
<div class="amp-wp-article-header ampforwp-meta-info <?php if( is_page() && ! $redux_builder_amp['meta_page'] ) {?> hide-meta-info <?php  }?>">
	<div class="amp-wp-content post-title-meta">

			<ul class="amp-wp-meta amp-meta-wrapper">
<?php $post_author = $this->get( 'post_author' ); ?>
<?php if ( $post_author ) : ?>
	<?php $author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 24 ) ); ?>
	<div class="amp-wp-meta amp-wp-byline">
		<?php 
		if(is_single() || ( is_page() && $redux_builder_amp['meta_page'] ) ) {
			echo ampforwp_get_author_details( $post_author , 'meta-info' ); ?>
		<li class="amp-wp-meta-date"> <?php global $redux_builder_amp;
		$date = get_the_date( get_option( 'date_format' ) );
		if( 2 == $redux_builder_amp['ampforwp-post-date-global'] ){
			$date = get_the_modified_date( get_option( 'date_format' )) . ', ' . get_the_modified_time() ;
		}
		echo esc_attr(apply_filters('ampforwp_modify_post_date', ampforwp_translation($redux_builder_amp['amp-translator-on-text'], 'On') . ' ' . $date )) ?></li>
		<?php }  ?>
	</div>
<?php endif; ?>

<?php
if( isset($redux_builder_amp['ampforwp-cats-single']) && $redux_builder_amp['ampforwp-cats-single']) {
  $ampforwp_categories = get_the_terms( $this->ID, 'category' );
  if ( $ampforwp_categories ) : ?>
  	<div class="amp-wp-meta amp-wp-tax-category ampforwp-tax-category">
  		<span>
			<?php printf( esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-categories-text'], 'Categories:' )). ' ');?>
			</span>
      <?php foreach ($ampforwp_categories as $cat ) {
      		if( isset($redux_builder_amp['ampforwp-archive-support']) && $redux_builder_amp['ampforwp-archive-support'] && isset($redux_builder_amp['ampforwp-cats-tags-links-single']) && $redux_builder_amp['ampforwp-cats-tags-links-single']) {
            		echo ('<span class="amp-cat-'.$cat->term_id.'"><a href="'. ampforwp_url_controller( get_category_link( $cat->term_id ) ) . '" >'.$cat->name .'</a></span>');//#934
				} else {
					echo ('<span>'.esc_attr($cat->name) .'</span>');
				}
      }

			
			 ?>
  	</div>
  <?php endif; }  ?>

			</ul>
	</div>
</div>
<?php endif; ?>
<?php do_action('ampforwp_after_meta_info_hook',$this);
