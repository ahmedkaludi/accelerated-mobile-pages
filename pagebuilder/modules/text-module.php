<?php $output = '<div {{if_id}}id="{{id}}"{{ifend_id}} class="amp_pb_module amp_text {{css_class}}">
<p>{{text_editor}}</p>
</div>';
return array(
		'label' =>'Text',
		'name' =>'text',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css',
              'advanced'=>'Advanced'
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
					array(
						'type'		=>'text',
						'name'		=>"id",
						'label'		=>'ID',
						'tab'		=>'advanced',
						'default'	=>'',
						'content_type'=>'html'
					),
        ),
		'front_template'=>$output,
		'front_css'=>'',
		'front_common_css'=>'',
	);
?>