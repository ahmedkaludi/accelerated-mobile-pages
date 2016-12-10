<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
		<?php do_action( 'amp_post_template_head', $this ); ?>

		<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
		</style>
	</head>
	<body>
	<?php $this->load_parts( array( 'header-bar' ) ); ?>

	<?php do_action( 'ampforwp_after_header', $this ); ?>

	<main>
		<!--Loop 1-->
		<!--Get all the posts here-->
		<?php
		$args = array( 'post_type' =>'post',
									 'posts_per_page' => 20);
		$our_required_post_ids = array();
		$query_posts_before = new WP_Query($args);

		 if ( $query_posts_before->have_posts() ) : while ( $query_posts_before->have_posts() ) : $query_posts_before->the_post(); ?>

				<?php array_push($our_required_post_ids,get_the_ID()) ;?>

		<?php endwhile; wp_reset_postdata(); ?>
		<?php else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

		<!--FIltering them here-->
		<?php
		$i=0;
		while($i<20){
			$ID = $our_required_post_ids[$i];
			$value = get_post_meta($ID);

			if($value['ampforwp-amp-on-off'][0] === 'hide-amp'){
				unset($our_required_post_ids[$i]);
			}
			$i++;
		}
		 ?>
		<!--Filter Posts IDs here Ends-->

		<!--loop 2-->
		<!--Filter Posts from Query Starts here-->
		<?php $args = array( 'post_type' =>'post',
									 			 'posts_per_page' => 20);
		$query_posts = new WP_Query($args);
		$count = 0;
		if($query_posts->have_posts()) : while($query_posts->have_posts()) : $query_posts->the_post();?>

			<!--Main Business Logic lies here-->
			<?php if(in_array(get_the_ID(),$our_required_post_ids) && $count < 10) { $count++;?>
					<?php $ampforwp_amp_post_url = trailingslashit( get_permalink() ) . AMP_QUERY_VAR ;

			?>

			<div class="amp-wp-content amp-loop-list">
				<?php if ( has_post_thumbnail()  ) {
					?>
					<?php
					$thumb_id = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
					$thumb_url = $thumb_url_array[0];
					?>
					<div class="home-post_image"><a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>"><amp-img src=<?php echo $thumb_url ?> width=100 height=75></amp-img></a></div>
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
			        <p><?php echo wp_trim_words( $content , '15' ); ?></p>

			    </div>
		</div>

		<?php } ?>
	<!--Main Business Logic Ends here-->
	<?php endwhile; wp_reset_postdata(); ?>
	<!--Filter Posts from Query Starts here-->

	<!--Finally adding pagination links here-->
		<div class="amp-wp-content pagination-holder">
			<div id="pagination">
				<div class="next"><?php next_posts_link( $redux_builder_amp['amp-translator-next-text'] . ' &raquo;', 0 ) ?></div>
				<div class="prev"><?php previous_posts_link( '&laquo; '. $redux_builder_amp['amp-translator-previous-text'] ); ?></div>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php endif; ?>
	<!--Finally adding pagination links Ends here-->
	<!--loop 2 Ends here-->
	</main>


	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $this ); ?>

	</body>
</html>
