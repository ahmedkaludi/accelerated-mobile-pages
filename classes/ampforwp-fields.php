<?php
require_once AMPFORWP_PLUGIN_DIR."classes/class-ampforwp-fields.php";
$ampforwp_fields = new AMPforWP_Fields();
$ampforwp_fields->section_start(array('id'=>'ampforwp-ux-website-type-section','class'=>'section-1'));
$ampforwp_fields->setField('select',array('title'=>'Select','class'=>'ampforwp-ux-select','id'=>'ampforwp-ux-select','options'=>array('BlogPosting'=>'Blog','NewsArticle'=>'News'),'default'=>(ampforwp_get_setting('ampforwp-sd-type-posts'))));
$ampforwp_fields->setField('checkbox',array('title'=>'Homepage','class'=>'amp-ux-homepage','id'=>'amp-ux-homepage'));
$ampforwp_fields->setField('switch',array('title'=>'Notice Bar','class'=>'amp-ux-switch-on-off','id'=>'amp-ux-notice-switch'));
$ampforwp_fields->setField('text',array('title'=>'Text','class'=>'text_class','id'=>'text_id'));
$ampforwp_fields->setField('color',array('title'=>'Color','class'=>'color_class','id'=>'color_id'));
$ampforwp_fields->setField('media',array('title'=>'media','class'=>'media_class','id'=>'media_id'));
$ampforwp_fields->section_end();
 ?>