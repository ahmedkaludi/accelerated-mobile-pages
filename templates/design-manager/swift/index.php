<?php amp_header(); ?>
<div class="cntr">
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
				<?php $argsbig = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'amp-featured-large', 'responsive'=> true); ?>
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
		<?php } else { ?>
			<div class="fsp">
				<?php $args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'amp-featured-small', 'responsive'=> true); ?>
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

<?php //amp_loop_template(); ?>

<?php amp_footer(); ?>