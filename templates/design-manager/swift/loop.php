<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp, $search_found; 
$width  = 346;
$height = 188;
if( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ){
    $width  = $redux_builder_amp['ampforwp-swift-homepage-posts-width'];
    $height = $redux_builder_amp['ampforwp-swift-homepage-posts-height'];
} ?>
<?php while(ampforwp_loop('start')):
$search_found = true; ?>
<div class="fsp">
	<?php if(ampforwp_has_post_thumbnail()){ $args = array("tag"=>'div',"tag_class"=>'image-container','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height, 'responsive'=> true); ?>
    <div class="fsp-img">
    	<?php ampforwp_loop_image($args); ?>
    </div><?php } ?>
    <div class="fsp-cnt">
    	<?php ampforwp_loop_category(); ?>
	    <?php ampforwp_loop_title(); ?>
	    <?php if( ampforwp_check_excerpt() ) { ampforwp_loop_excerpt(20); } ?>
	    <div class="pt-dt">
            <?php ampforwp_loop_date(); ?>
        </div>
    </div>
</div>
<?php endwhile; ampforwp_loop('end');  ?>
<?php do_action('ampforwp_loop_before_pagination') ?>