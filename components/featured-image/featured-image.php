<?php 
function ampforwp_framework_get_featured_image(){
global $post, $redux_builder_amp;
$post_id = $post->ID;
if(is_home() && $redux_builder_amp['amp-frontpage-select-option'] == 1){
	$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
}	
 if (has_post_thumbnail( $post_id ) ):  ?>
				<figure class="amp-featured-image"> <?php  
					$thumb_id = get_post_thumbnail_id($post_id);
					$image = wp_get_attachment_image_src( $thumb_id, 'full' ); 
					$caption = get_the_post_thumbnail_caption( $post_id ); 
					$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
					if($thumb_alt){
						$alt = $thumb_alt;
					}
					else{
						$alt = get_the_title( $post_id );
					}
					?>
				<amp-img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" layout=responsive alt="<?php echo esc_attr($alt); ?>" >  </amp-img>
					<?php if ( $caption ) : ?>
						<p class="wp-caption-text">
							<?php echo wp_kses_data( $caption ); ?>
						</p>
					<?php endif; ?>
				</figure>
			<?php endif; 
}