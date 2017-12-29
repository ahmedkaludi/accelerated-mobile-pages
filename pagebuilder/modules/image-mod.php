<?php 
$output = '
	<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="{{image_layout}}"></amp-img>
';
$css = '
.image-mod{
	text-align:{{align_type}};
   	margin:{{margin_css}};
    padding:{{padding_css}};
    width:{{width}}
}

';
return array(
		'label' =>'Image',
		'name' =>'image-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Image Upload',
		           				'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
                            array(		
		 						'type'		=>'text',		
		 						'name'		=>"width",		
		 						'label'		=>'Width',
		           				 'tab'      =>'customizer',
		 						'default'	=>'500px',	
		           				'content_type'=>'css',
	 						),

				        array(
								'type'		=>'checkbox',
								'name'		=>"image_layout",
								'label'		=>'Enable for Responsive Image',
								'tab'		=>'customizer',
								'default'	=>array('responsive'),
								'options'	=>array(
												array(
													'label'=>'Enable',
													'value'=>'responsive',
												),
											),
								'content_type'=>'html',
							),

	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'align_type',		
	 							'label' =>"Alignment",
								'tab'     =>'design',
	 							'default' =>'center',
	 							'options_details'=>array(
	 												'center'    =>'Center',
	 												'left'  	=>'Left',
	 												'right'    =>'Right', 													),
	 							'content_type'=>'css',
	 						),	
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'auto',
													'right'=>'auto',
													'top'=>'15px',
													'bottom'=>'15px'
													),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'0px',
													'right'=>'0px',
													'top'=>'0px',
													'bottom'=>'0px'
												),
								'content_type'=>'css',
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
	);

?>