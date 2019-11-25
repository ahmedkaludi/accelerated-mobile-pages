<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$output = '
	<amp-iframe {{if_id}}id="{{id}}"{{ifend_id}} class="{{user_class}}" width="{{width}}" height="{{height}}"
    sandbox="allow-scripts allow-same-origin"
    {{if_condition_mode_type==place}}src="https://www.google.com/maps/embed/v1/place?key={{map_key}}&q={{address}}"{{ifend_condition_mode_type_place}}
    {{if_condition_mode_type==view}}src="https://www.google.com/maps/embed/v1/view?key={{map_key}}&center={{latitude}},{{longitude}}&zoom={{zooming}}&maptype={{map_type}}"{{ifend_condition_mode_type_view}}>
    {{if_map_placeholder}}<amp-img layout="fill" src="{{map_placeholder}}" placeholder></amp-img>{{ifend_map_placeholder}}
</amp-iframe>';

$css = '';

return array(
		'label' => esc_html__('Map', 'accelerated-mobile-pages'),
		'name' =>'map',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						
                            array(		
		 						'type'		=>'text',		
		 						'name'		=>"width",		
		 						'label'		=>esc_html__('Map Width','accelerated-mobile-pages'),
		           				'tab'      =>'design',
		 						'default'	=>'600',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"height",		
		 						'label'		=>esc_html__('Map Height','accelerated-mobile-pages'),
		           				'tab'      =>'design',
		 						'default'	=>'450',	
		           				'content_type'=>'html',
	 						),
	 						
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"map_key",		
		 						'label'		=>esc_html__('API Key','accelerated-mobile-pages'),
		           				'tab'      =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
		           				'helpmessage'	=> '<a href="https://developers.google.com/maps/documentation/embed/get-api-key#quick-guide" target="_blank">Get API Key</a><br><b> Note: According to the AMP standards - use this module only if your MAP is either 600px away from the top or not within the first 75% of the viewport</b>',
	 						),
	 						array(		
	 							'type'	=>'select',		
	 							'name'  =>'mode_type',		
	 							'label' =>esc_html__("Select Mode Type",'accelerated-mobile-pages'),
								'tab'     =>'customizer',
	 							'default' =>'place',
	 							'options_details'=>array(
		 												'place' =>'Place Mode',
		 												'view'  =>'View Mode',
	 												),
	 							'content_type'=>'html',
	 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"address",		
			 						'label'		=>esc_html__('Address','accelerated-mobile-pages'),
			           				'tab'     =>'customizer',
			 						'default'	=>'Eiffel Tower,Paris France',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'place'),
		 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"latitude",		
			 						'label'		=>esc_html__('Latitude','accelerated-mobile-pages'),
			           				'tab'     =>'customizer',
			 						'default'	=>'-33.8569',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
		 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"longitude",		
			 						'label'		=>esc_html__('Longitude','accelerated-mobile-pages'),
			           				'tab'     =>'customizer',
			 						'default'	=>'151.2152',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
		 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"zooming",		
			 						'label'		=>esc_html__('Zooming','accelerated-mobile-pages'),
			           				'tab'     =>'customizer',
			 						'default'	=>'18',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
		 						),
		 						array(		
			 						'type'		=>'select',		
			 						'name'		=>"map_type",		
			 						'label'		=>esc_html__('Map Type','accelerated-mobile-pages'),
			           				'tab'     =>'customizer',
			 						'default'	=>'roadmap',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
			           				'options_details'=>array(
		 												'satellite' =>'SATELLITE',
		 												'roadmap'  =>'ROADMAP',
		 												'hybrid' => 'HYBRID',
		 												'terrain' => 'TERRAIN'
	 												),
		 						),
			 					array(
			 						'type'		=>'upload',		
			 						'name'		=>"map_placeholder",		
			 						'label'		=>esc_html__('Upload Placeholder','accelerated-mobile-pages'),
			           				'tab'     =>'customizer',
			 						'default'	=>'',	
			           				'content_type'=>'html',
			 					),
			 					array(
								'type'		=>'text',
								'name'		=>"id",
								'label'		=>esc_html__('ID','accelerated-mobile-pages'),
								'tab'		=>'advanced',
								'default'	=>'',
								'content_type'=>'html'
							),
			 					array(
								'type'		=>'text',
								'name'		=>"user_class",
								'label'		=>esc_html__('Class','accelerated-mobile-pages'),
								'tab'		=>'advanced',
								'default'	=>'',
								'content_type'=>'html'
							),
							
			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);

?>
