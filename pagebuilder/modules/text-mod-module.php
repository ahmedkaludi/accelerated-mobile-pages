<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
	 <div {{if_id}}id="{{id}}"{{ifend_id}} class="{{user_class}}">{{content_title}}</div>
';
$css = '
{{module-class}}.text-mod{width:100%;max-width:{{max-width}};text-align:{{align_type}};margin:{{margin_css}};padding:{{padding_css}};font-size:{{font-size}};
color:{{text_color_picker}};line-height:{{line-height}};letter-spacing:{{letter-spacing}};font-weight:{{font_type}};}
@media(max-width:768px){
{{module-class}}.text-mod{
	max-width:100%;
}
}
';
return array(
		'label' =>'Text',
		'name' =>'text-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Write your content in Text Editor',	
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
	 					array(
		 						'type'		=>'text',		
		 						'name'		=>"font-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'18px',	
		           				'content_type'=>'css',
	 						),
	 					array(    
				                'type'  =>'select',   
				                'name'  =>'font_type',    
				                'label' =>"Font Weight",
				                'tab'     =>'design',
				                'default' =>'400',
				                'options_details'=>array(
				                                    '300'   =>'Light',
				                                    '400'   =>'Regular',
				                                    '500'   =>'Medium',
				                                    '600'   =>'Semi Bold',
				                                    '700'   =>'Bold',
				                                ),
				                'content_type'=>'css',
			              	),
	 					array(
		 						'type'		=>'text',		
		 						'name'		=>"line-height",		
		 						'label'		=>'Line Height',
		           				 'tab'     =>'design',
		 						'default'	=>'1.7',	
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
								'type'		=>'color-picker',
								'name'		=>"text_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#333',
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
	 												'right'    =>'Right',
	 												'justify'	=>'Justify'
	 												),
	 							'content_type'=>'css',
	 						),
	 					array(
								'type'		=>'text',
								'name'		=>"max-width",
								'label'		=>'Max Width',
								'tab'		=>'design',
								'default'	=>'100%',
								'content_type'=>'css'
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