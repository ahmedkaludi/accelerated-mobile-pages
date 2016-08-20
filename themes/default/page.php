<?php get_header(); ?>

	<div id="contentwrap">

    <?php $access_key = 1; ?>
		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

		<div class="post">

<?php if (is_front_page()): ?>
<!-- LOAD LATEST -->

<?php
$args = array( 'numberposts' => 12, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
$postslist = get_posts( $args );
 foreach ($postslist as $post) :  setup_postdata($post); ?>
 <div class="post">
	 <?php if ( has_post_thumbnail() ) { ?>
			<?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
			$thumb_url = $thumb_url_array[0];
			?>
			<div class="post_image"><a href="<?php the_permalink(); ?>"><amp-img src=<?php echo $thumb_url ?> width=100 height=75></amp-img></a></div>
		<?php } ?>
		<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" accesskey="<?php echo $access_key; $access_key++; ?>"><?php the_title(); ?></a></h2>
		<?php $content = get_the_content();?>
		<p><?php echo wp_trim_words( $content , '15' ); ?></p>
</li>
</div>
<?php endforeach; ?>

<div id="pagination">
	<div class="next"><?php next_posts_link( 'Next &raquo;', 0 ) ?></div>
	<div class="prev"><?php previous_posts_link( '&laquo; Previous' ); ?></div>
	<div class="clearfix"></div>
</div>

<!-- ELSE LOAD CONTENT -->

 <?php else: ?>

	 <div id="title">
		 <h2><?php the_title(); ?></h2>
	 </div>

	 <?php if ( has_post_thumbnail() ) : $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
	 <a href="<?php the_permalink(); ?>" class="thumbnail"> </a>
	 <?php endif; ?>

			<?php the_content(); ?>
			<?php wp_link_pages( 'before=<p>&after=</p>&next_or_number=number&pagelink=Page %' ); ?>

<!-- END IF FRONT PAGE -->
<?php endif; ?>

		</div>

		<?php endwhile; ?>
		<?php endif;?>

	</div>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php the_permalink(); ?>"
  },
  "headline": "Article headline",
  "image": {
    "@type": "ImageObject",

<?php
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
$thumb_url = $thumb_url_array[0];
?>
    "url": "<?php echo $thumb_url ?>",
    "height": 1024,
    "width": 1024
  },
  "datePublished": "<?php echo the_time('c'); ?>",
  "dateModified": "<?php echo the_time('c'); ?>",
  "author": {
    "@type": "Person",
    "name": "<?php the_author_meta( 'nickname', $author_id ); ?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo get_bloginfo( 'name' ); ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php $site_logo = get_theme_mod('custom_logo'); echo wp_get_attachment_url($site_logo) ?>",
      "width": 600,
      "height": 60
    }
  },
  "description": "A most wonderful article"
}



</script>
<?php get_footer(); ?>
