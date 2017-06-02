<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
  <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php
	global $redux_builder_amp;
	if ( is_home() || is_front_page()  || ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) ){
		global $wp;
		$current_archive_url = home_url( $wp->request );
		$amp_url 	= trailingslashit($current_archive_url);
		$remove 	= '/'. AMPFORWP_AMP_QUERY_VAR;
		$amp_url 	= str_replace($remove, '', $amp_url) ;
	} ?>
	<link rel="canonical" href="<?php echo $amp_url ?>">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="amp_home_body design_2_wrapper">
<?php $this->load_parts( array( 'header-bar' ) ); ?>
<?php do_action( 'ampforwp_after_header', $this ); ?>
<?php do_action('ampforwp_home_above_loop') ?>
<main>
	<?php do_action('ampforwp_post_before_loop') ?>

	<?php
		if ( get_query_var( 'paged' ) ) {
	        $paged = get_query_var('paged');
	    } elseif ( get_query_var( 'page' ) ) {
	        $paged = get_query_var('page');
	    } else {
	        $paged = 1;
	    }

	    $exclude_ids = get_option('ampforwp_exclude_post');

		$args = array(
			'post_type'           => 'post',
			'orderby'             => 'date',
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' => false ,
			'post_status'=> 'publish'
		);
		$filtered_args = apply_filters('ampforwp_query_args', $args);
		$q = new WP_Query( $filtered_args ); ?>

 	<?php if ( is_archive() ) {
 			the_archive_title( '<h3 class="page-title">', '</h3>' );
 			the_archive_description( '<div class="taxonomy-description">', '</div>' );
 		} ?>

	<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();
		$ampforwp_amp_post_url = trailingslashit( trailingslashit( get_permalink() ) . AMPFORWP_AMP_QUERY_VAR ) ; ?>

		<div class="amp-wp-content amp-loop-list">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php
				$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
				$thumb_url = $thumb_url_array[0];
				?>
				<div class="home-post_image">
					<a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>">
						<amp-img src=<?php echo $thumb_url ?>
							<?php if( $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ) { ?>
							 width=<?php global $redux_builder_amp; echo $redux_builder_amp['ampforwp-homepage-posts-design-1-2-width'] ?>
							 height=<?php global $redux_builder_amp; echo $redux_builder_amp['ampforwp-homepage-posts-design-1-2-height'] ?>
						 <?php } else { ?>
							 width=100
							 height=75
						 <?php } ?>
						></amp-img>
					</a>
			</div>
			<?php } ?>

			<div class="amp-wp-post-content">

				<h2 class="amp-wp-title"> <a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>"> <?php the_title(); ?></a></h2>

				<?php
					if(has_excerpt()){
						$content = get_the_excerpt();
					}else{
						$content = get_the_content();
					}
				?>
		        <p><?php echo wp_trim_words( strip_shortcodes( $content ) , '15'  ); ?></p>

		    </div>
            <div class="cb"></div>
	</div>

	<?php endwhile;  ?>

	<div class="amp-wp-content pagination-holder">

		<div id="pagination">
			<div class="next"><?php next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text'] . ' &raquo;' , 'Next'), 0 ) ?></div>
			<div class="prev"><?php previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' ) ); ?></div>

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