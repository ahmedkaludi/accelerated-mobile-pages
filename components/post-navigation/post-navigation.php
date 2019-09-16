<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_framework_get_post_navigation(){
	global $redux_builder_amp;
	if($redux_builder_amp['enable-single-next-prev']) { ?>
		<div id="pagination">
					<div class="next">
					<?php $next_post = get_next_post();
						if (!empty( $next_post )) {
						$next_text = $next_post->post_title;
						$next_link = ampforwp_url_controller( get_permalink( $next_post->ID ));
						if(true == ampforwp_get_setting('single-next-prev-to-nonamp')){
						$next_link = get_permalink( $next_post->ID );
						} ?>
						<a href="<?php echo esc_url($next_link); ?>"><span><?php echo ampforwp_translation(ampforwp_get_setting('amp-translator-next-text'), 'Next' ); ?></span><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a> <?php
						} ?>
					</div>

					<div class="prev">
					<?php $prev_post = get_previous_post();
					 if (!empty( $prev_post )) {
						 $prev_text = $prev_post->post_title;
						  $prev_link = ampforwp_url_controller( get_permalink( $prev_post->ID ));
						 if(true == ampforwp_get_setting('single-next-prev-to-nonamp')){
						    $prev_link = get_permalink( $prev_post->ID );
						 } ?>	 
					    <a href="<?php echo esc_url($prev_link); ?>"><span><?php echo ampforwp_translation(ampforwp_get_setting('amp-translator-previous-text'), 'Previous' ); ?></span> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a> <?php
					  } ?>	
					</div>

					<div class="clearfix"></div>
		</div>
	<?php }
}