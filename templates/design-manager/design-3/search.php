<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
  <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php $paged = get_query_var( 'paged' );
	$current_search_url =trailingslashit(get_home_url())."?s=".get_search_query();
	$amp_url = untrailingslashit($current_search_url);
	if ($paged > 1 ) {
		global $wp;
		$current_archive_url 	= home_url( $wp->request );
		$amp_url 				= trailingslashit($current_archive_url);
		$remove 				= '/'. AMPFORWP_AMP_QUERY_VAR;
		$amp_url				= str_replace($remove, '', $amp_url) ;
		$amp_url 				= $amp_url ."?s=".get_search_query();
	} ?>
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body <?php ampforwp_body_class('amp_home_body archives_body design_3_wrapper');?>>
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>



<main>
	<?php do_action('ampforwp_post_before_loop') ?>
	<?php $count = 1; ?>
	<?php
		if ( get_query_var( 'paged' ) ) {
	        $paged = get_query_var('paged');
	    } elseif ( get_query_var( 'page' ) ) {
	        $paged = get_query_var('page');
	    } else {
	        $paged = 1;
	    }

	    $exclude_ids = get_option('ampforwp_exclude_post');

		$q = new WP_Query( array(
			's' 				  => get_search_query() ,
			'ignore_sticky_posts' => 1,
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' 		  => false ,
			'post_status'		  => 'publish'
		) ); ?>



     <?php global $redux_builder_amp; ?>
 		<h1 class="amp-wp-content page-title archive-heading"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-search-text'], 'You searched for:') . '  ' . get_search_query();?>  </h1>

	<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();?>

		<div class="amp-wp-content amp-loop-list">
			<?php if ( ampforwp_has_post_thumbnail() ) { 
				$thumb_url = ampforwp_get_post_thumbnail();
				$thumb_width  	= ampforwp_get_post_thumbnail('width');
				$thumb_height 	= ampforwp_get_post_thumbnail('height');
				if($thumb_url){
				?>
					<div class="home-post_image"><a href="<?php echo ampforwp_url_controller( get_permalink() ); ?>"><amp-img layout="responsive" src=<?php echo esc_url($thumb_url); ?> width=<?php echo $thumb_width; ?> height=<?php echo $thumb_height; ?> ></amp-img></a></div>
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
				<h2 class="amp-wp-title"> <a href="<?php echo ampforwp_url_controller( get_permalink() ); ?>"> <?php the_title(); ?></a></h2>


				<?php
					if(has_excerpt()){
						$content = get_the_excerpt();
					}else{
						$content = get_the_content();
					}
				?>
		        <p class="large-screen-excerpt-design-3">
				<?php 
					$excerpt_length	='';
					$excerpt_length = 15;
					$final_content 	= ""; 					
					$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );

					if ( false === has_filter('ampforwp_modify_index_content' ) ) {
						$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
					}
					echo $final_content;
				?></p>
		        <p class="small-screen-excerpt-design-3" > <?php    
					if($redux_builder_amp['excerpt-option-design-3']== true) {
						$excerpt_length ='';
						$excerpt_length = $redux_builder_amp['amp-design-3-excerpt'];
						$final_content  = ""; 					
						$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );

						if ( false === has_filter('ampforwp_modify_index_content' ) ) {
							$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
						}
						echo $final_content;
					} ?> 
				</p>
                <div class="featured_time"><?php 
                	$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    $post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    echo  $post_date ; ?>
                </div>
		    </div>
            <div class="cb"></div>
	</div>

	<?php 
	do_action('ampforwp_between_loop',$count,$this);
		         $count++;
	endwhile;  ?>

	<div class="amp-wp-content pagination-holder">


		<div id="pagination">
			<div class="next"><?php next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-show-more-posts-text']. ' &raquo;' , 'Show more Posts'), 0 ) ?></div>
				<?php if ( $paged > 1 ) { ?>
					<div class="prev"><?php previous_posts_link( '&laquo; '.ampforwp_translation($redux_builder_amp['amp-translator-show-previous-posts-text'], 'Show previous Posts' ) ); ?></div>
				<?php } ?>
			<div class="clearfix"></div>
		</div>
	</div>
	<?php else : ?>
		<div class="amp-wp-content">
 			<?php echo ampforwp_translation($redux_builder_amp['amp-translator-search-no-found'], 'It seems we can\'t find what you\'re looking for. '); ?>
 		</div>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	<?php do_action('ampforwp_post_after_loop') ?>
</main>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>