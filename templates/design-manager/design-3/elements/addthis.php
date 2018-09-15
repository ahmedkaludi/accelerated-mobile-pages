<?php 
global $redux_builder_amp;
$data_pub_id = ampforwp_get_setting('add-this-pub-id');
$data_widget_id = ampforwp_get_setting('add-this-widget-id');
if( ampforwp_get_setting('enable-add-this-option') ) {
$amp_addthis = '<amp-addthis width="320" height="92" data-pub-id="'.$data_pub_id.'" data-widget-id="'.$data_widget_id.'"></amp-addthis>';
echo $amp_addthis;
}
?>
