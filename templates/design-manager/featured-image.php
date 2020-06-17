<?php 
do_action('ampforwp_before_featured_image_hook',$this);
if(ampforwp_get_setting('amp-design-selector')==2 || ampforwp_get_setting('amp-design-selector')==3){
?>
<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
<?php }?>
<?php if( ampforwp_get_setting('amp-design-selector')==3){?>
	<div class="post-featured-img">
<?php } 
	ampforwp_featured_markup();
if( ampforwp_get_setting('amp-design-selector')==3){?>
	</div>
<?php }?>
<?php if(ampforwp_get_setting('amp-design-selector')==2 || ampforwp_get_setting('amp-design-selector')==3){?>
	</div>
  <?php 
}	
do_action('ampforwp_after_featured_image_hook',$this);