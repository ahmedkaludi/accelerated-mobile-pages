<?php global $redux_builder_amp; 
$width  = 346;
$height = 188;
if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
    $width  = $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
    $height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
} ?>
<?php while(amp_loop('start')): ?>
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
<?php endwhile; amp_loop('end');  ?>