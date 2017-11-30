<?php while(amp_loop('start')): ?>
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
<?php endwhile; amp_loop('end');  ?>
<?php amp_pagination(); ?>