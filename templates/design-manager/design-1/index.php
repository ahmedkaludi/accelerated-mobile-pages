<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php global $redux_builder_amp;
		if ( is_home() || is_front_page() || ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) ){
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

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?> design_1_wrapper">

<?php $this->load_parts( array( 'header-bar' ) ); ?>


<?php do_action('ampforwp_home_above_loop') ?>

<article class="amp-wp-article ampforwp-custom-index amp-wp-home">

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

			<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post(); ?>
		        <div class="amp-wp-content amp-wp-article-header amp-loop-list">

			        <h1 class="amp-wp-title">
			            <?php  $ampforwp_post_url = get_permalink(); ?>
			            <a href="<?php  echo trailingslashit( trailingslashit( $ampforwp_post_url ) . AMPFORWP_AMP_QUERY_VAR );?>"><?php the_title() ?></a>
			        </h1>

					<div class="amp-wp-content-loop">
						<div class="amp-wp-meta">
			              <?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author') ) ); ?>
			              <time> <?php
                          printf( _x( '%1$s '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' ), '%2$s = human-readable time difference', 'accelerated-mobile-pages' ),
                                human_time_diff( get_the_time( 'U' ),
                                current_time( 'timestamp' ) ) ); ?>
                    </time>
			  </div>


						<?php if ( has_post_thumbnail() ) { ?>
							<?php
							$thumb_id = get_post_thumbnail_id();
							$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
							$thumb_url = $thumb_url_array[0];
							?>
							<div class="home-post-image">
								<a href="<?php  echo trailingslashit( trailingslashit( $ampforwp_post_url ) . AMPFORWP_AMP_QUERY_VAR );?>">
									<amp-img
										src=<?php echo $thumb_url ?>
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
						<?php }
							if(has_excerpt()){
								$content = get_the_excerpt();
							}else{
								$content = get_the_content();
							} ?>
						<p><?php echo wp_trim_words( strip_shortcodes( $content ) , '20' ); ?></p>
					</div>
		        </div>
		    <?php endwhile;  ?>

		    <div class="amp-wp-content pagination-holder">

		        <div id="pagination">
		            <div class="next"><?php next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text']. ' &raquo;', 'Next'), 0 ) ?></div>
		            <div class="prev"><?php previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' ) ); ?></div>
		            <div class="clearfix"></div>
		        </div>

		    </div>

		<?php endif; ?>

	<?php do_action('ampforwp_post_after_loop') ?>

</article>

<?php do_action('ampforwp_home_below_loop') ?>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>
