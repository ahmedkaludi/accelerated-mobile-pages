<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '<div class="amp_pb_module amp_btn {{css_class}}">
<a href="{{button_link}}">{{button_txt}}</a></div>';
return array(
		'label' =>'Button',
		'name' =>'button',
          'default_tab'=> 'customizer',
          'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields'=> array(
				 	array(
                    'type'    => 'text',
                    'name'    => 'button_txt',
                    'label'   => 'Button Text',
                    'tab'     => 'customizer',
                    'default' => 'Click Here',
                    'content_type'=>'html',
						),
				 	array(
                    'type'    => 'text',
                    'name'    => 'button_link',
                    'label'   => 'Button Link',
                    'tab'     =>'customizer',
                    'default' => '#',
                    'content_type'=>'html',
						),
				 	array(
                    'type'    => 'text',
                    'name'    => 'css_class',
                    'label'   => 'Custom CSS Class',
                    'tab'     =>'container_css',
                    'default' => '',
                    'content_type'=>'html',
						)
            
        ),
		'front_template'=>$output,
        'front_css'=>'', 
        'front_common_css'=>'',
	);
?>