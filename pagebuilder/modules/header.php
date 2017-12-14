<?php 
$output = '
<div class="head-tlt">
	<h1 class="h-txt">Pipedrive gets your sales organised</h1>
</div>

';
$css = '
.head-tlt{
   width:100%;
   display:inline-block;
   text-align:center;
}
.head-tlt .h-txt{
   font-size:70px;
   line-height:74px;
}

';
return array(
		'label' =>'Header',
		'name' =>'header',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields' => array(
						array(		
	 							'type'	=>'select',		
	 							'name'  =>"header_type",		
	 							'label' =>"Select Header type",
								'tab'     =>'customizer',
	 							'default' =>'',
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
		 						'label'		=>'Header Title',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'switch',		
		 						'name'		=>"text_size_enable",		
		 						'label'		=>'Header Title Size',
		           				 'tab'     =>'customizer',
		 						'default'	=>'1',	
		           				'content_type'=>'html',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Header Title',
		           				 'tab'     =>'customizer',
		 						'default'	=>'60px',	
		           				'content_type'=>'html',
		           				'required'  => array('text_size_enable'=>1),
	 						),		
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Font color',
								'tab'		=>'customizer',
								'default'	=>'#7ca078',
								'content_type'=>'css',
								'output_format'=>"color: %default%"
							),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Set Margin',
								'tab'		=>'customizer',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
													),
								'content_type'=>'css',
								'output_format'=>"margin: %left%px %right%px %top%px %bottom%px"
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Set Padding',
								'tab'		=>'customizer',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
												),
								'content_type'=>'css',
								'output_format'=>"padding: %left%px %right%px %top%px %bottom%px"
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
	);

?>