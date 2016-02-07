<?php get_header(); ?>

	<div id="contentwrap">
 

		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

		<div id="title">
			<h2><?php the_title(); ?></h2>
		</div>

		<div class="post">
			<?php if ( has_post_thumbnail() ) : $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
			<a href="<?php the_permalink(); ?>" class="thumbnail"> </a>
			<?php endif; ?>

			<?php the_content(); ?>
			<?php wp_link_pages( 'before=<p>&after=</p>&next_or_number=number&pagelink=Page %' ); ?>
		</div>

		<?php endwhile; ?>
		<?php endif;?>
	
	</div>

<?php get_footer(); ?>