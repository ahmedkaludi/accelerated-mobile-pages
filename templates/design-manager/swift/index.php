<?php global $redux_builder_amp; ?>
<?php amp_header(); ?>
<div class="cntr b-w">
	<div class="hmp">
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
				<?php $argsbig = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>723,'image_crop_height'=>394, 'responsive'=> true); ?>
			    <div class="fbp-img">
			    	<?php amp_loop_image($argsbig); ?>
			    </div>
			    <div class="fbp-cnt">
			    	<?php amp_loop_category(); ?>
				    <?php amp_loop_title(); ?>
				    <div class="at-dt">
					    <?php amp_loop_date(); ?>
					    <?php amp_author_box(); ?>
					</div>
				    <?php amp_loop_excerpt(50); ?>
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
				<?php $args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
			    <div class="fsp-img">
			    	<?php amp_loop_image($args); ?>
			    </div>
			    <div class="fsp-cnt">
			    	<?php amp_loop_category(); ?>
				    <?php amp_loop_title(); ?>
				    <?php amp_loop_excerpt(20); ?>
				    <div class="pt-dt">
				    	<?php amp_loop_date(); ?>
				    </div>
			    </div>
			</div>
		<?php } $i++; ?>
		<?php endwhile; amp_loop('end');  ?>
	<?php amp_pagination(); ?>
   </div>
</div>
<?php //amp_loop_template(); ?>

<?php amp_footer(); ?>