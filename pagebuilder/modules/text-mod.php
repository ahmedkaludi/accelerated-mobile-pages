<?php 
$output = '
<div class="text-tlt">
	<span class="t-txt">{{content_title}}</span>
</div>

';
$css = '
{{module-class}}{
	width:100%;
	display:inline-block;
}
{{module-class}} .text-tlt{
   width:100%;
   text-align:{{align_type}};
   margin:{{margin_css}};
   padding:{{padding_css}};
}
{{module-class}} .t-txt{
   font-size:{{font-size}};
   line-height:1.5;
   color:{{text_color_picker}};
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
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),

	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"font-size",		
		 						'label'		=>'Font Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'20px',	
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
								'type'		=>'color-picker',
								'name'		=>"text_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
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