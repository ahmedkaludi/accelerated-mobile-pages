<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; ?>
<?php do_action('ampforwp_before_content_hook',$this); ?>

<div class="amp-wp-article-content">
	<?php 
	if ( 'above-content' ==  ampforwp_get_setting('design-1-2-3-addthis-pos') ){
		echo ampforwp_addThis_support(); 
	}	?>
	<div class="amp-wp-content the_content">
	<?php amp_content(); ?>
	</div>
	<?php do_action( 'ampforwp_after_the_post_content_wrp' ); ?>
	<?php 
	if ( 'below-content' ==  ampforwp_get_setting('design-1-2-3-addthis-pos') ){
		echo ampforwp_addThis_support();
	} ?>
	<!--Post Next-Previous Links-->
	<?php
		if(true == ampforwp_get_setting('enable-single-next-prev') && !is_page() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID())) { ?>
			<!--IF Starts here-->
			<div class="amp-wp-content post-pagination-meta">
				<div id="pagination">
					<?php $next_post = get_next_post();
					if (!empty( $next_post )) { 
						if(false == ampforwp_get_setting('single-next-prev-to-nonamp')){ ?>
						<div class="next">
							<?php $next_text = $next_post->post_title;
								$next_link = ampforwp_url_controller( get_permalink( $next_post->ID ));
								if(true == ampforwp_get_setting('single-next-prev-to-nonamp')){
								$next_link = get_permalink( $next_post->ID );
								} ?>
								<a href="<?php echo esc_url($next_link); ?>"><?php echo apply_filters('ampforwp_next_link',$next_text ); ?> &raquo;</a> <?php
									 } ?>		
						</div>
					<?php } 
					
					$prev_post = get_previous_post();
					if (!empty( $prev_post )) { ?>
						<div class="prev">
							<?php $prev_text = $prev_post->post_title;
							 	$prev_link = ampforwp_url_controller( get_permalink( $prev_post->ID ));
								if(true == ampforwp_get_setting('single-next-prev-to-nonamp')){
								$prev_link = get_permalink( $prev_post->ID );
								} ?>
								   <a href="<?php echo esc_url($prev_link); ?>"> &laquo; <?php echo apply_filters('ampforwp_prev_link',$prev_text ); ?></a> <?php } ?>
	
						</div> 
					<div class="cb"></div>
				</div>
			</div>
			<!--IF Ends here-->
		<?php } ?>
	<!--Post Next-Previous Links End here-->

</div>
