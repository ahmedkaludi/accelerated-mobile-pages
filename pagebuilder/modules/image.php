<?php
$output = '<amp-img src="{{selected_image}}" class="{{css_class}}" width="{{image_width}}" height="{{image_height}}" layout="responsive"></amp-img>';
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
						'name'=>"image_height",
						'label'=>"Image height",
						'tab'	=> "customizer",
						'default'=>'150',
						'content_type'=>'html',
						),
					array(
			 			'type'	=>'text',
						'name'=>"image_width",
						'label'=>"Image width",
						'tab'	=> "customizer",
						'default'=>'150',
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
);