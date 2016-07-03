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