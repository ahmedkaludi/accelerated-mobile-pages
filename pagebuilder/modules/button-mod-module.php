<?php 
$output = '
	<a href="{{btn_link}}" target="_blank" class="btn-txt">{{content_title}}</a>
{{if_sub_heading}}<span>{{sub_heading}}</span> {{ifend_sub_heading}}
';
$css = '
{{module-class}} {width:100%;display: inline-block;text-align:{{align_type}};margin:{{margin_css}};padding:{{padding_css}};}
{{module-class}} .btn-txt{
font-size:{{text-size}}; color:{{font_color_picker}};background:{{bg_color_picker}};display: inline-block;padding: 10px 20px;width: {{button-width}};font-weight: {{font_weight}};box-sizing: initial;}
.button-mod span{display: block;font-size: 12px;color: {{sub_color_picker}};font-weight: 300;margin-top: 10px;}
@media(max-width:425px){
	{{module-class}} .btn-txt{width:100%;box-sizing: inherit;}
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
		 						'label'		=>'Button Text',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Get started free',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_link",		
		 						'label'		=>'URL',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),

						array(		
		 						'type'		=>'text',		
		 						'name'		=>"sub_heading",		
		 						'label'		=>'Sub Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'No Credit card required',	
		           				'content_type'=>'html', 
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'20px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'font_weight',		
	 							'label' =>"Font Weight",
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
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Background Color',
								'tab'		=>'design',
								'default'	=>'#2cbf55',
								'content_type'=>'css',
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Button Text Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"sub_color_picker",
								'label'		=>'Subheading Text Color',
								'tab'		=>'design',
								'default'	=>'#888',
								'content_type'=>'css'
							),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'align_type',		
	 							'label' =>"Align",
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
		 						'name'		=>'button-width',		
		 						'label'		=>'Width',
		           				 'tab'     =>'design',
		 						'default'	=>'200px',	
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