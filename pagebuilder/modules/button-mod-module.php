<?php 
$output = '{{if_condition_button_repeat_check==1}}{{repeater}}{{ifend_condition_button_repeat_check_1}}
	<div class="btn"><a href="{{btn_link}}" {{if_condition_page_link_open==new_page}}target="_blank"{{ifend_condition_page_link_open_new_page}} class="btn-txt">{{content_title}}</a>
{{if_sub_heading}}<span>{{sub_heading}}</span> {{ifend_sub_heading}}</div>
';
$css = '
{{module-class}} {width:100%;display:inline-block;text-align:{{align_type}};margin:{{margin_css}};padding:{{padding_css}};}
{{module-class}} .btn-txt{
font-size:{{text-size}}; border-radius:{{border-rds}}; color:{{font_color_picker}};background:{{bg_color_picker}};display: inline-block;padding: 10px 20px;width:{{button-width}};font-weight:{{font_weight}};box-sizing:initial}
.button-mod span{display: block;font-size: 12px;color: {{sub_color_picker}};font-weight:300;margin-top:10px}
{{if_condition_display_type==inline}}
.btn{display:inline-block;}
{{ifend_condition_display_type_inline}}
@media(max-width:768px){
{{if_condition_button_repeat_check==1}}
{{module-class}} .btn{margin:0 0 15px 0;}
{{ifend_condition_button_repeat_check_1}}
}
@media(max-width:600px){
{{module-class}} .btn {display: flex;flex-direction: column;align-items: center;}
}
@media(max-width:425px){
	{{module-class}} .btn-txt{width:100%;box-sizing:inherit;}
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
	 							'type'	=>'select',		
	 							'name'  =>'page_link_open',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'    =>'Same page'
	 											),
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
		 						'type'		=>'text',		
		 						'name'		=>'border-rds',		
		 						'label'		=>'Border Radius',
		           				 'tab'     =>'design',
		 						'default'	=>'0px',	
		           				'content_type'=>'css',
	 						),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'display_type',		
	 							'label' =>"Display",
								'tab'     =>'design',
	 							'default' =>'block',
	 							'options_details'=>array(
	 												'block'    =>'Block (Vertical)',
	 												'inline'  	=>'Inline (Horizontal)', 													),
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
							array(		
		 						'type'		=>'checkbox_bool',		
		 						'name'		=>'button_repeat_check',		
		 						'label'		=>'Add Another Button',
		           				'tab'     =>'customizer',
		 						'default'	=>0,	
		 						'options'	=>array(
												array(
													'label'=>'Yes',
													'value'=>1,
												)
											),
		           				'content_type'=>'html',
	 						),
			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
		'repeater'=> array(
			'tab'=>'customizer',
			'required'=>array('button_repeat_check'=>1),
			'fields'=>array(
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
	 							'type'	=>'select',		
	 							'name'  =>'page_link_open',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'    =>'Same page'
	 											),
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
					),
			'front_template'=> 
			'<div class="btn"><a href="{{btn_link}}" {{if_condition_page_link_open==new_page}}target="_blank"{{ifend_condition_page_link_open_new_page}} class="btn-txt">{{content_title}}</a>
			{{if_sub_heading}}<span>{{sub_heading}}</span> {{ifend_sub_heading}}</div>
			'
			),
	);

?>