<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '<div class="amp_pb_module amp_text {{css_class}}">
<p>{{text_editor}}</p>
</div>';
return array(
		'label' =>'Text',
		'name' =>'text',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields'=> array(
					array(
						'type'		=>'text-editor',
						'name'		=>"text_editor",
						'label'		=>'Content',
						'tab'		=>'customizer',
						'default'	=>'Content Goes Here',
						'content_type'=>'html'
						),
					array(
						'type'		=>'text',
						'name'		=>"css_class",
						'label'		=>'Custom CSS Class',
						'tab'		=> "customizer",
						'default'	=>'Content Goes Here',
						'content_type'=>'html'
						),
					array(
						'type'		=>'color-picker',
						'name'		=>"color_picker",
						'label'		=>'Background color',
						'tab'		=>'customizer',
						'default'	=>'',
						'content_type'=>'css',
						'output_format'=>"color: %default%",
						
					),
        ),
		'front_template'=>$output,
		'front_css'=>'',
		'front_common_css'=>'',
	);
?>