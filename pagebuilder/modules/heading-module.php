<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '{{if_header_type}}<{{header_type}} {{if_id}}id="{{id}}"{{ifend_id}} class="h-txt {{user_class}}">{{content_title}}</{{header_type}}>{{ifend_header_type}}';
$css = '
{{module-class}}{width:100%;text-align:{{align_type}};margin:{{margin_css}};padding:{{padding_css}};}
{{module-class}} .h-txt{font-size:{{text-size}};color:{{font_color_picker}};letter-spacing:{{letter-spacing}};font-weight:{{font_type}};line-height:{{line-height}};}
';
return array(
		'label' =>'Heading',
		'name' =>'heading',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(
	 							'type'	=>'select',		
	 							'name'  =>"header_type",		
	 							'label' =>"Heading Type",
								'tab'     =>'customizer',
	 							'default' =>'h1',
	 							'options_details'=>array(
	 												'h1'=>'H1',
	 												'h2'=>'H2',
	 												'h3'=>'H3',
	 												'h4'=>'H4',
	 												'h5'=>'H5',
	 												'h6'=>'H6'
	 													),
	 							'content_type'=>'html',
	 							'output_format'=>''
	 					),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
		           				'required'  	=>  array('header_type'=> array('h1','h2','h3','h4','h5','h6'))
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'54px',	
		           				'content_type'=>'css',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"line-height",		
		 						'label'		=>'Line Height',
		           				 'tab'     =>'design',
		 						'default'	=>'1.4',	
		           				'content_type'=>'css',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"letter-spacing",		
		 						'label'		=>'Letter Spacing',
		           				 'tab'     =>'design',
		 						'default'	=>'0px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'font_type',		
	 							'label' =>"Font Weight",
								'tab'     =>'design',
	 							'default' =>'500',
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
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#26292c',
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