<?php
require_once AMPFORWP_PLUGIN_DIR."classes/class-ampforwp-fields.php";
$ampforwp_fields = new AMPforWP_Fields();
$ampforwp_fields->section_start(array('id'=>'ampforwp-ux-website-type-section','class'=>'section-1'));
$ampforwp_fields->setField('select',array('title'=>'Select','class'=>'select_class','id'=>'select_id','options'=>array('Blog'=>'Blog','News'=>'News'),'default'=>'Blog'));
$ampforwp_fields->setField('checkbox',array('title'=>'Checkbox','class'=>'checkbox_class','id'=>'checkbox_id'));
$ampforwp_fields->setField('switch',array('title'=>'switch','class'=>'switch_class','id'=>'switch_id'));
$ampforwp_fields->setField('text',array('title'=>'Text','class'=>'text_class','id'=>'text_id'));
$ampforwp_fields->section_end();
 ?>