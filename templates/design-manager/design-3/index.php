<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
  <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body <?php ampforwp_body_class('amp_home_body design_3_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<div class="amp-wp-content">
	<?php do_action('ampforwp_area_above_loop'); ?>
</div>

<?php do_action( 'ampforwp_after_header', $this );

if ( get_query_var( 'paged' ) ) {
      $paged = get_query_var('paged');
  } elseif ( get_query_var( 'page' ) ) {
      $paged = get_query_var('page');
  } else {
      $paged = 1;
  }

 ?>

<?php global $redux_builder_amp; if( $redux_builder_amp['amp-design-3-featured-slider'] == 1 && $paged === 1 ) { ?>
		<div class="amp-featured-wrapper">
		<div class="amp-featured-area">
		  <amp-carousel width="450"
		      height="270" layout="responsive"
		      type="slides" autoplay
		      delay="4000">
		<?php
		  global $redux_builder_amp;
		  if( $redux_builder_amp['amp-design-3-category-selector'] ){
		    $args = array(
		                   'cat' => $redux_builder_amp['amp-design-3-category-selector'],
		                   'posts_per_page' => 4,
		                   'has_password' => false ,
		                   'post_status'=> 'publish'
		                 );
		  } else {
		    //if user does not give a category
		    $args = array(
		                   'posts_per_page' => 4,
		                   'has_password' => false ,
		                   'post_status'=> 'publish'
		                 );
		  }

		   $category_posts = new WP_Query($args);
		   if($category_posts->have_posts()) :
		      while($category_posts->have_posts()) :
		         $category_posts->the_post();
		?>
		      <div>
					<?php if ( has_post_thumbnail() || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) ) { 
						if ( has_post_thumbnail()) {    
							$thumb_id = get_post_thumbnail_id();
							$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium_large', true);
							$thumb_url = $thumb_url_array[0];
							}
						else{
							$thumb_url = ampforwp_cf_featured_image_src();
						}
						?>
						 <amp-img src=<?php echo $thumb_url ?> width=450 height=270></amp-img>
					<?php } ?>
                  <a href="<?php echo user_trailingslashit( trailingslashit( get_the_permalink() ) . AMPFORWP_AMP_QUERY_VAR ); ?>">
                  <div class="featured_title">
		            <div class="featured_time"><?php 
		            	$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    	$post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    	echo  $post_date ; ?></div>
		            <h1><?php the_title() ?></h1>
		        </div>
                  </a>
		      </div>
		<?php endwhile; else: ?><?php endif; ?>
		  </amp-carousel>
		</div>
		</div>
<?php } ?>
<?php do_action('ampforwp_home_above_loop') ?>
<main>
	<?php do_action('ampforwp_post_before_loop') ?>
	<?php

	    $exclude_ids = get_option('ampforwp_exclude_post');
			$args_new =  array(
				'post_type'           => 'post',
				'orderby'             => 'date',
				'paged'               => esc_attr($paged),
				'post__not_in' 		  => $exclude_ids,
				'has_password' => false,
				'post_status'=> 'publish'
			);

			$filtered_args = apply_filters('ampforwp_query_args', $args_new);


		$q = new WP_Query( $filtered_args );  
		$blog_title = ampforwp_get_blog_details('title');
		if($blog_title){  ?>
			<h1 class="amp-wp-content page-title"><?php echo $blog_title ?> </h1>
		<?php }	
		 if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();
		$ampforwp_amp_post_url = trailingslashit( get_permalink() ) . AMPFORWP_AMP_QUERY_VAR ; ?>

		<div class="amp-wp-content amp-loop-list <?php if ( has_post_thumbnail() || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) ) { } else{?>amp-loop-list-noimg<?php } ?>">
			<?php if ( has_post_thumbnail() || ( ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src() ) ) {  
				if ( has_post_thumbnail()) { 
					$thumb_id = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
					$thumb_url = $thumb_url_array[0];
				}
				else{
					$thumb_url = ampforwp_cf_featured_image_src();
				}
				?>
				<div class="home-post_image">
					<a href="<?php echo esc_url( user_trailingslashit( $ampforwp_amp_post_url ) ); ?>">
						<amp-img
							layout="responsive"
							src=<?php echo $thumb_url ?>
							<?php ampforwp_thumbnail_alt(); ?>
							width=450
							height=270
						></amp-img>
					</a>
				</div>
			<?php } ?>

			<div class="amp-wp-post-content">
                <ul class="amp-wp-tags">
					<?php foreach((get_the_category()) as $category) { ?>
					   <li class="amp-cat-<?php echo $category->term_id;?>"><?php echo $category->cat_name ?></li>
					<?php } ?>
                </ul>
				<h2 class="amp-wp-title"> <a href="<?php echo esc_url( user_trailingslashit( $ampforwp_amp_post_url ) ); ?>"> <?php the_title(); ?></a></h2>


				<?php
					if(has_excerpt()){
						$content = get_the_excerpt();
					}else{
						$content = get_the_content();
					}
				?>
		        <p><?php echo wp_trim_words( strip_shortcodes( $content ) , '15' ); ?></p>
                <div class="featured_time"><?php 
                	$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    $post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    echo  $post_date ; ?></div>

		    </div>
            <div class="cb"></div>
	</div>

	<?php endwhile;  ?>

	<div class="amp-wp-content pagination-holder">

		<div id="pagination">
			<div class="next"><?php next_posts_link( ampforwp_translation( $redux_builder_amp['amp-translator-show-more-posts-text'] , 'Show more Posts'), 0 ) ?></div>
					<?php if ( $paged > 1 ) { ?>
						<div class="prev"><?php previous_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-show-previous-posts-text'], 'Show previous Posts') ); ?></div>
					<?php } ?>
			<div class="clearfix"></div>
		</div>
	</div>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	<?php do_action('ampforwp_post_after_loop') ?>

</main>
<?php do_action('ampforwp_home_below_loop') ?>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>