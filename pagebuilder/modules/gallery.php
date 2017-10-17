<?php
$output = '<img src="{{selected_image}}" class="{{css_class}}" width="{{image_width}}" height="{{image_height}}">';
$options = '<option value="thumbnail">Thumbnail</option><option value="medium">Medium</option><option value="large">Large</option>';
$frontCss = '';
return array(
		'label' =>'Gallery or Slider',
		'name' => 'gallery_image',
		'frontend_script' => array(),
		'frontend_css'=> $frontCss,
		'fields' => array(
						array(
							'type'	=>'multi_upload',
							'name'  => "gallary_selected_image",
							'label' => "Select gallary Images",
							'default'	=>plugins_url('accelerated-mobile-pages/images/150x150.png')
							),
						array(
							'type'	=>'select',
							'name'  =>"image_size_selection",
							'label' =>"Select content type",
							'default'=>'thumbnail',
							'options' => $options,
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