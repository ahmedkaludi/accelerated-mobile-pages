<?php 
$output = '
<div class="head-tlt">
	<{{header_type}} class="h-txt">{{content_title}}</{{header_type}}>
</div>

';
$css = '
{{module-class}}{
	width:100%;
	display:inline-block;
}
{{module-class}} .head-tlt{
   width:100%;
   text-align:{{align_type}};
   margin:{{margin_css}};
   padding:{{padding_css}};
}
{{module-class}} .h-txt{
   font-size:{{text-size}};
   line-height:1.5;
   color:{{font_color_picker}};
   font-weight:{{font_type}};
}
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
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),

	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'70px',	
		           				'content_type'=>'css',
	 						),
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
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'font_type',		
	 							'label' =>"Font Style",
								'tab'     =>'design',
	 							'default' =>'normal',
	 							'options_details'=>array(
	 												'normal'    =>'Normal',
	 												'bold'  	=>'Bold',
	 												'itlic'    =>'Italic', 													),
	 							'content_type'=>'css',
	 						),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>15,
													'bottom'=>15
													),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
												),
								'content_type'=>'css',
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
	);

?>