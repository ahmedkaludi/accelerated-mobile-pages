<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
amp_header(); ?>
<div class="sp">
<div class="cntr menu-btn">
<?php global $redux_builder_amp; 
$allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>';
$content = '<h2 class="amp-post-title">'.strip_tags(ampforwp_translation($redux_builder_amp['amp-translator-fourohfour'],'Oops! That page can’t be found.'), $allowed_tags).'</h2>';
$content = apply_filters('amp_custom_404_not_found',$content); 
echo $content; ?>
</div>
</div>
<?php amp_footer()?>