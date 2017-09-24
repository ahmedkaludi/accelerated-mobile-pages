<?php $output = '<div class="amp_pb_module amp_btn {{css_class}}">
<a href="{{button_link}}">{{button_txt}}</a></div>';
return array(
		'label' =>'Button',
		'name' =>'button',
		'fields'=> array(
				 	array(
                    'type'    => 'text',
                    'name'    => 'button_txt',
                    'label'   => 'Button Text',
                    'default' => 'Click Here'
						),
				 	array(
                    'type'    => 'text',
                    'name'    => 'button_link',
                    'label'   => 'Button Link',
                    'default' => '#'
						),
				 	array(
                    'type'    => 'text',
                    'name'    => 'css_class',
                    'label'   => 'Custom CSS Class',
                    'default' => ''
						)
            
        ),
		'front_template'=>$output
	);
?>