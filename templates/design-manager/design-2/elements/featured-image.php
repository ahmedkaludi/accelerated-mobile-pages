<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
	<?php
			if ( has_post_thumbnail() ) { ?>
			<?php
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
			$thumb_url = $thumb_url_array[0];
			?>
			<div class="post-featured-img"><amp-img src=<?php echo $thumb_url ?> width=512 height=300 layout=responsive></amp-img></div>
	<?php } ?>
</div>
