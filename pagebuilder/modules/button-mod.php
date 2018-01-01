<?php 
$output = '
	<a href="{{btn_link}}" target="_blank" class="btn-txt">{{content_title}}</a>
{{if_sub_heading}}<span>{{sub_heading}}</span> {{ifend_sub_heading}}
';
$css = '
.button-mod{
   width:100%;
   display: inline-block;
   text-align:{{align_type}};
   margin:{{margin_css}};
   padding:{{padding_css}};
}
.button-mod .btn-txt{
   font-size:{{text-size}};
   color:{{font_color_picker}};
   background:{{bg_color_picker}};
   display: inline-block;
   padding: {{btn-hgt}} {{btn-wdt}};
   font-weight: {{font_weight}};
}
.button-mod span{
    display: block;
    font-size: 12px;
    color: #888;
    font-weight: 300;
    margin-top: 10px;
}
';
return array(
		'label' =>'Button',
		'name' =>'button-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Get started free',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_link",		
		 						'label'		=>'Link (Make sure its will link Or #)',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),

	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'20px',	
		           				'content_type'=>'css',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"sub_heading",		
		 						'label'		=>'Small Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'No Credit card required',	
		           				'content_type'=>'html', 
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'font_weight',		
	 							'label' =>"Font Style",
								'tab'     =>'design',
	 							'default' =>'400',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
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
		 						'type'		=>'text',		
		 						'name'		=>"btn-hgt",		
		 						'label'		=>'Vertical Gap',
		           				 'tab'     =>'design',
		 						'default'	=>'10px',	
		           				'content_type'=>'css',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn-wdt",		
		 						'label'		=>'Horizontal Gap',
		           				 'tab'     =>'design',
		 						'default'	=>'80px',	
		           				'content_type'=>'css',
	 						),	
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Background color',
								'tab'		=>'design',
								'default'	=>'#2cbf55',
								'content_type'=>'css',
							),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'0px',
                                'bottom'=>'20px',
                                'left'=>'0px',
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
		'front_common_css'=>'',
	);

?>