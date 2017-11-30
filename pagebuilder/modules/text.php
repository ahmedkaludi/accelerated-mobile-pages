<?php $output = '<div class="amp_pb_module amp_text {{css_class}}">
<p>{{text_editor}}</p></div>';
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
						'type'		=>'textarea',
						'name'		=>"text_editor",
						'label'		=>'Content',
						'tab'		=> 'customizer',
						'default'	=>'Content Goes Here',
						),
            
					array(
						'type'		=>'text',
						'name'		=>"css_class",
						'label'		=>'Custom CSS Class',
						'tab'		=> "customizer",
						'default'	=>'Content Goes Here',
						)
        ),
		'front_template'=>$output,
		'front_css'=>'',	
	);
?>