<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; ?>
<?php amp_header(); ?>
<div class="cntr b-w">
	<div class="hmp">
	<?php do_action('ampforwp_home_above_loop') ?>
	<?php
	if (is_home() ){
	 if (get_query_var( 'paged' ) ) {
	                $paged = get_query_var('paged');
	            } elseif ( get_query_var( 'page' ) ) {
	                $paged = get_query_var('page');
	            } else {
	                $paged = 1;
	            } 

}
		$i=1;

		while(amp_loop('start')):
		if($i==1 && $paged==1){ 
			?>
			<div class="fbp">
				<?php if (ampforwp_has_post_thumbnail()  ) { 
					$fimg_width  = 723;
					$fimg_height = 394;
					if( true == ampforwp_get_setting('ampforwp-homepage-posts-image-modify-size') && true== ampforwp_get_setting('ampforwp-homepage-posts-first-image-modify-size') ){
						$fimg_width 	= ampforwp_get_setting('ampforwp-swift-homepage-posts-width');
						$fimg_height = ampforwp_get_setting('ampforwp-swift-homepage-posts-height');
					}

					$argsbig = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$fimg_width,'image_crop_height'=>$fimg_height, 'responsive'=> true); ?>
			    <div class="fbp-img fbp-c">
			    	<?php amp_loop_image($argsbig); ?>
			    </div> <?php } ?>
			    <div class="fbp-cnt fbp-c">
			    	<?php amp_loop_category(); ?>
				    <?php amp_loop_title(); ?>
				    <div class="at-dt">
					    <?php 
				    	if( true == ampforwp_get_setting('amforwp-homepage-date-switch')){	amp_loop_date();
						} 
						?>
					    <?php amp_author_box( 
										array('author_pub_name'=>true,)
										); ?>
					</div>
				    <?php if( ampforwp_check_excerpt() ) { 
				    amp_loop_excerpt(ampforwp_get_setting('amp-swift-excerpt-len'));
			    	} ?>
			    </div>
			</div>
		<?php } else { 
			$width 	= 346;
			$height = 188;
			if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
				$width 	= $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
				$height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
			} ?>
			<div class="fsp">
				<?php if( ampforwp_has_post_thumbnail() ) { 
					$args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
				    <div class="fsp-img">
				    	<?php amp_loop_image($args); ?>
				    </div>
				<?php } ?>    
			    <div class="fsp-cnt">
			    	<?php amp_loop_category(); ?>
				    <?php amp_loop_title(); ?>
				    <?php if( ampforwp_check_excerpt() ) { 
				    amp_loop_excerpt(ampforwp_get_setting('amp-swift-excerpt-len'));
			    	} ?>	
				    <?php if( true == ampforwp_get_setting('amforwp-homepage-date-switch')){?>
				    <div class="pt-dt">
				    	<?php amp_loop_date(); ?>
				    </div>
					<?php }?>
					<?php if( true == ampforwp_get_setting('amforwp-homepage-author-switch')){?>
				    <div class="pt-author" >
				    	<?php amp_author_box( array('author_pub_name'=>true,)); ?>
				    </div>
					<?php } ?>
			    </div>
			</div>
		<?php } $i++; ?>
		<?php endwhile; amp_loop('end');  ?>
		<?php do_action('ampforwp_loop_before_pagination') ?>
	<?php amp_pagination(); ?>
	<?php do_action('ampforwp_home_below_loop') ?>
   </div>
   <?php if(isset($redux_builder_amp['gbl-sidebar']) && $redux_builder_amp['gbl-sidebar'] == '1'){ ?>
		<div class="sdbr-right">
			<?php 
			$sidebar_output = '';
			$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('swift-sidebar');
			if ( $sanitized_sidebar) {
				$sidebar_output = $sanitized_sidebar->get_amp_content();
				$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',$sidebar_output);
			echo $sidebar_output; // amphtml content, no kses
			}
			?>
		</div>
	<?php } ?>
</div>
<?php //amp_loop_template(); ?>

<?php amp_footer(); ?>