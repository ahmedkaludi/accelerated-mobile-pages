<?php $output = '<div class="amp_pb_module amp_text {{css_class}}">
<p>{{text_editor}}</p>
<p>{{checkboxs0}}:{{checkboxs1}}: :{{checkboxs2}}</p><p>{{selected_radio_option}}</p></div>';
return array(
		'label' =>'Sample Module',
		'name' =>'samplemodule',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields'=> array(
					array(
						'type'		=>'text-editor',
						'name'		=>"text_editor",
						'label'		=>'Content Text Editor',
						'tab'		=>'customizer',
						'default'	=>'Content Goes Here',
						),
					array(
						'type'		=>'color-picker',
						'name'		=>"color_picker",
						'label'		=>'Color Picker',
						'tab'		=>'customizer',
						'default'	=>'#dd0000',
						),
					array(
						'type'		=>'icon-selector',
						'name'		=>"icon_selector_one",
						'label'		=>'Icone selector',
						'tab'		=>'customizer',
						'default'	=>'',
						),
					array(
						'type'		=>'gradient-selector',
						'name'		=>"slected_gradient",
						'label'		=>'Select gradient',
						'tab'		=>'customizer',
						'default'	=>'background: linear-gradient(45deg, rgb(48, 73, 107), rgb(48, 184, 210));',
						),
					array(
						'type'		=>'margin-padding',
						'name'		=>"margin_padding_css",
						'label'		=>'Set Margin Padding',
						'tab'		=>'container_css',
						'default'	=>array(
										'margin'=> array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
													),
										'padding'=> array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
													),
										),
						),
					array(
						'type'		=>'checkbox',
						'name'		=>array("checkboxs0", "checkboxs1", "checkboxs2"),
						'label'		=>'Select types',
						'tab'		=>'container_css',
						'default'	=>array('jack'),//Chackbox for AMP
						'options'	=>array(
										array(
											'label'=>'Jack',
											'value'=>'jack',
										),
										array(
											'label'=>'John',
											'value'=>'john',
										),
										array(
											'label'=>'Mike',
											'value'=>'mike',
										),
									)
						),
					array(
						'type'		=>'radio',
						'name'		=>"selected_radio_option",
						'label'		=>'Select types',
						'tab'		=>'container_css',
						'default'	=>'',
						'options'	=>array(
										array(
											'label'=>'Jack',
											'value'=>'jack',
										),
										array(
											'label'=>'John',
											'value'=>'john',
										),
										array(
											'label'=>'Mike',
											'value'=>'mike',
										),
									)
						),
					array(
						'type'		=>'text',
						'name'		=>"css_class",
						'label'		=>'Custom CSS Class',
						'tab'		=> "container_css",
						'default'	=>'Content Goes Here',
						)
        ),
		'front_template'=>$output,
		'front_css'=>'',	
	);
?>