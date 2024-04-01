<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<?php do_action('amp_experiment_meta', $this); ?>
  	<link rel="preconnect" href="//cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body <?php ampforwp_body_class('amp_home_body design_3_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php if ( has_action('ampforwp_area_above_loop') ) : ?>
	<div class="amp-wp-content">
		<?php do_action('ampforwp_area_above_loop'); ?>
	</div>
<?php endif; ?>

<?php do_action( 'ampforwp_after_header', $this );

if ( get_query_var( 'paged' ) ) {
      $paged = get_query_var('paged');
  } elseif ( get_query_var( 'page' ) ) {
      $paged = get_query_var('page');
  } else {
      $paged = 1;
  }

 ?>

<?php if( $redux_builder_amp['amp-design-3-featured-slider'] == 1 && $paged === 1 ) {
		$num_posts = 4;$autoplay = 'autoplay';$delay = 'delay="4000"';
		if ( isset($redux_builder_amp['ampforwp-featur-slider-autop-delay']) && $redux_builder_amp['ampforwp-featur-slider-autop-delay'] ) {
			$delay = 'delay="'.esc_attr( ampforwp_get_setting("ampforwp-featur-slider-autop-delay") ).'"';
		}
		if ( isset($redux_builder_amp['ampforwp-featur-slider-num-posts']) && $redux_builder_amp['ampforwp-featur-slider-num-posts'] ) {
			$num_posts = $redux_builder_amp['ampforwp-featur-slider-num-posts'];
		}
		if ( isset($redux_builder_amp['ampforwp-featur-slider-autop']) && false == $redux_builder_amp['ampforwp-featur-slider-autop'] ) {
			$autoplay 	= '';
			$delay 		= '';
		}
 ?>
		<div class="amp-featured-wrapper">
		<div class="amp-featured-area">
		  <amp-carousel width="450"
		      height="270" layout="responsive"
		      type="slides" <?php echo esc_attr($autoplay.' ');
		      echo $delay; //escaped above ?> >
		<?php
		  global $redux_builder_amp;
		  if( ( isset($redux_builder_amp['amp-design-3-featured-content']) && $redux_builder_amp['amp-design-3-featured-content'] == '1' ) && (isset($redux_builder_amp['amp-design-3-category-selector']) && $redux_builder_amp['amp-design-3-category-selector'] ) ){
		    $args = array(
		                   'cat' => $redux_builder_amp['amp-design-3-category-selector'],
		                   'posts_per_page' => $num_posts,
		                   'has_password' => false ,
		                   'post_status'=> 'publish'
		                 );
		  } else {
		    //if user does not give a category
		    $args = array(
		                   'posts_per_page' => $num_posts,
		                   'has_password' => false ,
		                   'post_status'=> 'publish'
		                 );
		    }
		  if( ( isset($redux_builder_amp['amp-design-3-featured-content']) && $redux_builder_amp['amp-design-3-featured-content'] == '2') && ( isset($redux_builder_amp['amp-design-3-tag-selector']) && $redux_builder_amp['amp-design-3-tag-selector'] ) ){
		  	$args = array(
		                   'tag__in' => $redux_builder_amp['amp-design-3-tag-selector'],
		                   'posts_per_page' => $num_posts,
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
                  <a href="<?php echo ampforwp_url_controller( get_the_permalink() ); ?>">
                  	<?php if ( ampforwp_has_post_thumbnail() ) { 
						$thumb_url = ampforwp_get_post_thumbnail('url','full');
						$thumb_url_array = ampforwp_aq_resize( $thumb_url, 450,270, true, false, true ); //resize & crop the image
						$thumb_url = $thumb_url_array[0];
						$thumb_width = $thumb_url_array[1];
						$thumb_height = $thumb_url_array[2]; 
						if($thumb_url){
							?>
							 <amp-img src=<?php echo esc_url($thumb_url) ?> width=<?php echo esc_attr($thumb_width); ?> height=<?php echo esc_attr($thumb_height); ?> layout="responsive"></amp-img>
						<?php } 
					}?>
                  <div class="featured_title">
		            <div class="featured_time"><?php 
		            	$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    	$post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    	echo esc_attr($post_date); ?></div>
		            <h2><?php the_title() ?></h2>
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
	<?php $count = 1; ?>
	<?php

	    $exclude_ids = ampforwp_exclude_posts();
			$args_new =  array(
				'post_type'           => 'post',
				'orderby'             => 'date',
				'paged'               => esc_attr($paged),
				'post__not_in' 		  => $exclude_ids,
				'has_password' => false,
				'no_found_rows' 	  => true,
				'post_status'=> 'publish'
			);

			$filtered_args = apply_filters('ampforwp_query_args', $args_new);


		$q = new WP_Query( $filtered_args );  
		$blog_title = ampforwp_get_blog_details('title');
		if( ampforwp_is_blog() && $blog_title){  ?>
			<h1 class="amp-wp-content page-title archive-heading"><?php echo esc_attr($blog_title) ?></h1>
		<?php }	
		 if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post(); ?>

		<div class="amp-wp-content amp-loop-list <?php if ( ! ampforwp_has_post_thumbnail() ){?>amp-loop-list-noimg<?php } ?>">
			<?php if ( ampforwp_has_post_thumbnail() ) {  
				$thumb_url 	  	= ampforwp_get_post_thumbnail('url');
				$thumb_width  	= ampforwp_get_post_thumbnail('width');
				$thumb_height 	= ampforwp_get_post_thumbnail('height');
				if(ampforwp_get_setting('ampforwp-homepage-posts-image-modify-size')){
					$thumb_id 			= get_post_thumbnail_id();
					$thumb_width  	= ampforwp_get_setting('ampforwp-design-3-homepage-posts-width');
					$thumb_height 	= ampforwp_get_setting('ampforwp-design-3-homepage-posts-height');
					$thumb_url_modify 	= wp_get_attachment_image_src($thumb_id, 'full' , true);
					$thumb_mod_url = $thumb_url_modify[0];
					if($thumb_id==0 || $thumb_id==""){
						if( true ==ampforwp_get_setting('ampforwp-featured-image-from-content') && ampforwp_get_featured_image_from_content('url') ){
							$thumb_url 	  = ampforwp_get_post_thumbnail('url');
							$thumb_mod_url = $thumb_url;
						}
					}
 					$thumb_crop_url = ampforwp_aq_resize( $thumb_mod_url, $thumb_width , $thumb_height , true, false );
					$thumb_url = $thumb_crop_url[0];
				}
				if($thumb_url){
					?>
					<div class="home-post_image">
						<a href="<?php echo ampforwp_url_controller( get_the_permalink() ); ?>">
							<amp-img
								layout="responsive"
								src=<?php echo esc_url( $thumb_url ); ?>
								<?php ampforwp_thumbnail_alt(); ?>
								width=<?php echo esc_attr($thumb_width); ?>
								height=<?php echo esc_attr($thumb_height); ?>
							></amp-img>
						</a>
					</div>
				<?php }
				} ?>

			<div class="amp-wp-post-content">
                <ul class="amp-wp-tags">
					<?php foreach((get_the_category()) as $category) { 
					if ( true == $redux_builder_amp['ampforwp-archive-support'] ) { ?>
						<li class="amp-cat-<?php echo esc_attr($category->term_id);?>"><a href="<?php echo ampforwp_url_controller( get_category_link( $category->term_id ) ); ?>" ><?php echo esc_attr($category->cat_name) ?></a></li>
					<?php }
					else { ?>
					   <li class="amp-cat-<?php echo esc_attr($category->term_id);?>"><?php echo esc_attr($category->cat_name) ?></li>
					<?php } 
					} ?>
                </ul>
				<h2 class="amp-wp-title"><a href="<?php echo ampforwp_url_controller( get_the_permalink() ); ?>"> <?php the_title(); ?></a></h2>
				<?php if( ampforwp_check_excerpt() ) {
					$class = 'large-screen-excerpt-design-3';
					if ( true == $redux_builder_amp['excerpt-option-design-3'] ) {
						$class = 'small-screen-excerpt-design-3';
					}
					amp_loop_excerpt( ampforwp_get_setting('amp-design-3-excerpt'), 'p', $class );
				} ?>
				<?php
              	if($redux_builder_amp['amp-design-selector'] == '3' && $redux_builder_amp['amp-design-3-featured-time'] == '1'){
                  		?>
                <div class="featured_time"><?php 
                	$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    $post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    echo esc_attr($post_date); ?></div><?php
                }?>

		    </div>
            <div class="cb"></div>
	</div>

	<?php 
	do_action('ampforwp_between_loop',$count,$this);
		         $count++;
	endwhile;  ?>
	<?php do_action('ampforwp_loop_before_pagination') ?>
	<div class="amp-wp-content pagination-holder">
		<?php	
		if (function_exists('wp_pagenavi')) {
	      wp_pagenavi();
	    }else{?>
		<div id="pagination">
        	<?php if ( get_next_posts_link('next', $q->max_num_pages) ){ ?><div class="next"><?php echo apply_filters('ampforwp_next_posts_link',get_next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Show more Posts' ).'&raquo;', 0), $paged);?></div><?php }?>
        	<?php if ( get_previous_posts_link() ){ ?><div class="prev"><?php echo apply_filters( 'ampforwp_previous_posts_link', get_previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Show Previous Posts' )), $paged ); ?></div><?php }?>
			<div class="clearfix"></div>
		</div>
		<?php } ?>	
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