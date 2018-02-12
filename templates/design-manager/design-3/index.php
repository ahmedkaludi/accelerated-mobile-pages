<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
  <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
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
		  if( isset($redux_builder_amp['amp-design-3-category-selector']) && $redux_builder_amp['amp-design-3-category-selector'] ){
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
					<?php if ( ampforwp_has_post_thumbnail() ) { 
						$thumb_url = ampforwp_get_post_thumbnail();
						if($thumb_url){
							?>
							 <amp-img src=<?php echo $thumb_url ?> width=450 height=270></amp-img>
						<?php } 
					}?>
                  <a href="<?php echo ampforwp_url_controller( get_the_permalink() ); ?>">
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
	<?php $count = 1; ?>
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
			<h1 class="amp-wp-content page-title archive-heading"><?php echo $blog_title ?> </h1>
		<?php }	
		 if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post(); ?>

		<div class="amp-wp-content amp-loop-list <?php if ( ! ampforwp_has_post_thumbnail() ){?>amp-loop-list-noimg<?php } ?>">
			<?php if ( ampforwp_has_post_thumbnail() ) {  
				$thumb_url 	  	= ampforwp_get_post_thumbnail('url');
				$thumb_width  	= ampforwp_get_post_thumbnail('width');
				$thumb_height 	= ampforwp_get_post_thumbnail('height');
				if($thumb_url){
					?>
					<div class="home-post_image">
						<a href="<?php echo ampforwp_url_controller( get_the_permalink() ); ?>">
							<amp-img
								layout="responsive"
								src=<?php echo esc_url( $thumb_url ); ?>
								<?php ampforwp_thumbnail_alt(); ?>
								width=<?php echo $thumb_width; ?>
								height=<?php echo $thumb_height; ?>
							></amp-img>
						</a>
					</div>
				<?php }
				} ?>

			<div class="amp-wp-post-content">
                <ul class="amp-wp-tags">
					<?php foreach((get_the_category()) as $category) { 
					if ( true == $redux_builder_amp['ampforwp-archive-support'] ) { ?>
						<li class="amp-cat-<?php echo $category->term_id;?>"><a href="<?php echo esc_url(ampforwp_url_controller( get_category_link( $category->term_id ) )); ?>" ><?php echo $category->cat_name ?></a></li>
					<?php }
					else { ?>
					   <li class="amp-cat-<?php echo $category->term_id;?>"><?php echo $category->cat_name ?></li>
					<?php } 
					} ?>
                </ul>
				<h2 class="amp-wp-title"> <a href="<?php echo ampforwp_url_controller( get_the_permalink() ); ?>"> <?php the_title(); ?></a></h2>


				<?php
					if(has_excerpt()){
						$content = get_the_excerpt();
					}else{
						$content = get_the_content();
					}
				?>
		        <p class="large-screen-excerpt-design-3">
				<?php 
					$excerpt_length		='';
					$excerpt_length 	= 15;
					$final_content_1 	= ""; 					
					$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );

					if ( false === has_filter('ampforwp_modify_index_content' ) ) {
						$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
					}
					echo $final_content;

					?> </p>
		        <p class="small-screen-excerpt-design-3"> <?php    
					if($redux_builder_amp['excerpt-option-design-3']== true) {
						$excerpt_length = '';
						$excerpt_length = $redux_builder_amp['amp-design-3-excerpt']; 
						$final_content 	= ""; 					
						$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );
						if ( false === has_filter('ampforwp_modify_index_content' ) ) {
							$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
						}
						echo $final_content;
					} ?> 
				</p>
		        <?php 
		        	global $redux_builder_amp;
                  	if($redux_builder_amp['amp-design-selector'] == '3' && $redux_builder_amp['amp-design-3-featured-time'] == '1'){
                  		?>
                <div class="featured_time"><?php 
                	$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    $post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    echo  $post_date ; ?></div><?php
                }?>

		    </div>
            <div class="cb"></div>
	</div>

	<?php 
	do_action('ampforwp_between_loop',$count,$this);
		         $count++;
	endwhile;  ?>

	<div class="amp-wp-content pagination-holder">

		<div id="pagination">
			<div class="next"><?php next_posts_link( ampforwp_translation( $redux_builder_amp['amp-translator-show-more-posts-text']. ' &raquo;' , 'Show more Posts'), 0 ) ?></div>
					<?php if ( $paged > 1 ) { ?>
						<div class="prev"><?php previous_posts_link( '&laquo; '.ampforwp_translation($redux_builder_amp['amp-translator-show-previous-posts-text'], 'Show previous Posts') ); ?></div>
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