<!doctype html>
    <html lang="en" prefix="op: http://media.facebook.com/op#">
    <head>
      <meta charset="utf-8">
      <link rel="canonical" href="<?php the_permalink(); ?>">
      <meta property="op:markup_version" content="v1.0">
    </head>
    <body>
        <article>
            <header>
                <!-- title -->
				<h1><?php the_title(); ?></h1>

				<!-- kicker -->
				<!-- TODO -->

                <!-- publication date/time -->
				<time class="op-published" datetime="<?php echo get_the_date("c"); ?>"><?php echo get_the_date(get_option('date_format') . ", " . get_option('time_format')); ?></time>

				<!-- modification date/time -->
				<time class="op-modified" datetime="<?php echo get_the_modified_date("c"); ?>"><?php echo get_the_modified_date(get_option('date_format') . ", " . get_option('time_format')); ?></time>

				<!-- author(s) -->
                <address>
                    <a><?php the_author_meta('display_name'); ?></a>
                    <?php the_author_meta('description'); ?>
                </address>

				<!-- cover -->
				<?php if(has_post_thumbnail($post->ID)):
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
					$attachment = get_post(get_post_thumbnail_id($post->ID));
					$thumbnail_url = $thumb[0];
				?>
                    <figure>
                        <img src="<?php echo $thumbnail_url; ?>" />
                        <?php if (strlen(apply_filters("the_content", $attachment->post_excerpt)) > 0): ?>
                            <figcaption><?php echo apply_filters("the_content", $attachment->post_excerpt); ?></figcaption>
                        <?php endif; ?>
                    </figure>
				<?php endif; ?>

            </header>

            <!-- body -->
            <?php 
            echo apply_filters('fbia_content', apply_filters('the_content', get_the_content( '' ))); ?>
            <footer>
            </footer>
        </article>
    </body>
</html>