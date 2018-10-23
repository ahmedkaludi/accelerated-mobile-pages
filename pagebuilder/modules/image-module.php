<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '{{if_selected_image}}<amp-img src="{{selected_image}}" class="{{css_class}}" width="{{image_width}}" height="{{image_height}}" layout="responsive"  alt="{{image_alt}}"></amp-img>{{ifend_selected_image}}';
return array(
		'label' =>'Image',
		'name' => 'image',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields' => array(
					array(
						'type'	=>'upload',
						'name'  => "selected_image",
						'label' => "Select Image",
						'tab'	=> "customizer",
						'default'	=>plugins_url('accelerated-mobile-pages/images/150x150.png'),
						'content_type'=>'html',
						),
				 	array(
			 			'type'	=>'text',
						'name'=>"css_class",
						'label'=>"Custom CSS Class",
						'tab'	=> "container_css",
						'default'=>'',
						'content_type'=>'html',
						)
					),
		'front_template'=> $output,
		'front_css'=>'',	
		'front_common_css'=>'',
);