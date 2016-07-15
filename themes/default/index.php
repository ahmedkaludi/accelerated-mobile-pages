<?php get_header(); ?>
	<div id="contentwrap"> 
		<div id="title">
			<h2>
				<?php if ( is_category() ) : ?>
					<?php single_cat_title(); ?> Archives
				<?php elseif ( is_day() ) : ?>
					Archive for <?php the_time( 'F jS, Y' ); ?>
				<?php elseif ( is_month() ) : ?>
					Archive for <?php the_time( 'F, Y' ); ?>
				<?php elseif ( is_year() ) : ?>
					Archive for <?php the_time('Y'); ?>
				<?php endif; ?>
			</h2>
		</div>

		<?php $access_key = 1; ?>
		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

		<div class="post">
			<?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];            
			?>   

			<?php if ( has_post_thumbnail() ) { ?><div class="post_image"><a href="<?php the_permalink(); ?>"><amp-img src=<?php echo $thumb_url ?> width=100 height=75></amp-img></a></div><?php } ?>


            <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" accesskey="<?php echo $access_key; $access_key++; ?>"><?php the_title(); ?></a></h2>
            <?php $content = get_the_content();?>
            <p><?php echo wp_trim_words( $content , '15' ); ?></p>
		</div>

		<?php endwhile; ?>
		<?php endif; ?>

		<div id="pagination">
			<div class="next"><?php next_posts_link( 'Next &raquo;', 0 ) ?></div>
			<div class="prev"><?php previous_posts_link( '&laquo; Previous' ); ?></div>
			<div class="clearfix"></div>
		</div>
	</div>

<?php get_footer(); ?>