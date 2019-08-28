<?php
require_once AMPFORWP_PLUGIN_DIR."classes/class-ampforwp-fields.php";
$ampforwp_fields = new AMPforWP_Fields();
// Website Type
$ampforwp_fields->section_start(array('id'=>'ampforwp-ux-website-type-section','class'=>'section-1 amp-ux-website-type-section'));
	$ampforwp_fields->setField('select',array('title'=>'Select','class'=>'ampforwp-ux-select','id'=>'ampforwp-ux-select','options'=>array('BlogPosting'=>'Blog','NewsArticle'=>'News'),'default'=>(ampforwp_get_setting('ampforwp-sd-type-posts'))));
$ampforwp_fields->section_end();

$ampforwp_fields->section_start(array('id'=>'ampforwp-ux-need-type-section','class'=>'section-2 amp-ux-need-section'));
$ampforwp_fields->setField('checkbox',array('title'=>'Homepage','class'=>'amp-ux-homepage','id'=>'amp-ux-homepage'));
$ampforwp_fields->section_end();
$ampforwp_fields->setField('switch',array('title'=>'Notice Bar','class'=>'amp-ux-switch-on-off','id'=>'amp-ux-notice-switch','default'=>ampforwp_get_setting('amp-enable-notifications')));
$ampforwp_fields->setField('text',array('title'=>'Text','class'=>'text_class','id'=>'text_id'));
$ampforwp_fields->setField('color',array('title'=>'Global Color Scheme','class'=>'amp-ux-color-scheme','id'=>'amp-ux-color-scheme','default'=>ampforwp_get_setting('swift-color-scheme','color')));
$ampforwp_fields->setField('media',array('title'=>'Logo','class'=>'amp-ux-opt-media-container','id'=>'amp-ux-opt-media', 'default'=>array('id'=>ampforwp_get_setting('opt-media','id'),'url'=>ampforwp_get_setting('opt-media','url'),'width'=>ampforwp_get_setting('opt-media','width'),'height'=>ampforwp_get_setting('opt-media','height'))));
 ?>