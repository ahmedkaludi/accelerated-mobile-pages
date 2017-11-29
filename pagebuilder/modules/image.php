<?php
$output = '<amp-img src="{{selected_image}}" class="{{css_class}}" width="{{image_width}}" height="{{image_height}}" layout="responsive"></amp-img>';
return array(
		'label' =>'Image',
		'name' => 'image',
		'fields' => array(
					array(
						'type'	=>'upload',
						'name'  => "selected_image",
						'label' => "Select Image",
						'default'	=>plugins_url('accelerated-mobile-pages/images/150x150.png')
						),
				 	array(
			 			'type'	=>'text',
						'name'=>"image_height",
						'label'=>"Image height",
						'default'=>'150'
						),
					array(
			 			'type'	=>'text',
						'name'=>"image_width",
						'label'=>"Image width",
						'default'=>'150'
						),
					array(
			 			'type'	=>'text',
						'name'=>"css_class",
						'label'=>"Custom CSS Class",
						'default'=>''
						)
					),
		'front_template'=> $output 
);