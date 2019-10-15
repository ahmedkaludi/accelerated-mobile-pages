<?php 
function ampforwp_framework_get_featured_image(){
	do_action('ampforwp_before_featured_image_hook');
	ampforwp_get_featured_image_markup();
	do_action('ampforwp_after_featured_image_hook');
}