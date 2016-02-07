<?php get_header(); ?>

	<div id="contentwrap">
 		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

        <div class="postmeta">
			<p>By <a href="#"><?php the_author_meta( 'display_name' ); ?></a> on <?php the_time( get_option( 'date_format' ) ) ?>   <span>Posted in <?php the_category( ', ' ) ?></span></p>
		</div>
        
		<div id="title">
			<h2><?php the_title(); ?></h2>
		</div>

		<div class="post"> 

			<?php the_content(); ?>
			<?php wp_link_pages( 'before=<p>&after=</p>&next_or_number=number&pagelink=Page %' ); ?>
		</div>
		
		<div id="posttags">
			<p><?php the_tags( 'Tags: ', ', ' ); ?></p>
		</div>
		
		<div id="pagination">
			<div class="next"><?php next_post_link(); ?></div>
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="clearfix"></div>
		</div>

		<?php endwhile; ?>
		<?php endif;?>
 	</div>

<?php get_footer(); ?>