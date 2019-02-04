<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '<div {{if_id}}id="{{id}}"{{ifend_id}} class="amp_pb_module amp_blurb {{css_class}} {{user_class}}"><img src="{{blurb_image}}" width="{{image_width}}" height="{{image_height}}" layout="responsive"/>
<h4>{{text_title}}</h4>
<p>{{text_description}}</p>
</div>'; 

return array(
		'label' =>'Blurb',
		'name' =>'blurb',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css',
              'advanced'=> 'Advanced'
            ),
		'fields'=> array( 
					array(
						'type'		=>'text',
						'name'		=>"text_title",
						'label'		=>"Title",
						'tab'		=>'customizer',
						'default'	=>'Heart Of The Landing Page',
						'content_type'=>'html'
						),
					array(
						'type'		=>'textarea',
						'name'		=>"text_description",
						'label'		=>"Description",
						'tab'		=>'customizer',
						'default'	=>'This is a sample text which is being used for the dummy purpose to avoid confusion.',
						'content_type'=>'html',
						),
					array(
						'type'		=>'upload',
						'name'		=>"blurb_image",
						'label'		=>"Image",
						'tab'		=>'customizer',
						'default'	=>plugins_url('accelerated-mobile-pages/images/150x150.png'),
						'content_type'=>'html',
						),
					array(
	                    'type'    	=> 'text',
	                    'name'    	=> 'css_class',
	                    'label'   	=> 'Custom CSS Class',
	                    'tab'	 	=>'container_css',
	                    'default' 	=> '',
	                    'content_type'=>'html',
						),
					array(
						'type'		=>'text',
						'name'		=>"id",
						'label'		=>'ID',
						'tab'		=>'advanced',
						'default'	=>'',
						'content_type'=>'html'
					),  
					array(
						'type'		=>'text',
						'name'		=>"user_class",
						'label'		=>'Class',
						'tab'		=>'advanced',
						'default'	=>'',
						'content_type'=>'html'
					),
					),
		'front_template'=> $output,
		'front_css'=>'',	
		'front_common_css'=>'',
	);
?>