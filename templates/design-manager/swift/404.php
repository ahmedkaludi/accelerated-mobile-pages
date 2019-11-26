<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
amp_header(); ?>
<div class="sp">
<div class="cntr menu-btn">
<h2 class="amp-post-title">
<?php global $redux_builder_amp; 
$allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>';
echo strip_tags(ampforwp_translation($redux_builder_amp['amp-translator-fourohfour'],'Oops! That page can’t be found.'),$allowed_tags); ?></h2>
</div>
</div>
<?php amp_footer()?>