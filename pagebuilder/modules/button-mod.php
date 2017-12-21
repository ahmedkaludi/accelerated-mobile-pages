<?php 
$output = '
<div class="button-blk">
	<a href="{{btn_link}}" target="_blank" class="btn-txt">{{content_title}}</a>
</div>


';
$css = '
.btn-bg{
	background:#eee;
	width:100%;
	margin:0 auto;
	padding:15px 0px;
}
.button-mod .button-blk{
   width:100%;
   display:inline-block;
   text-align:{{align_type}};
}
.button-mod .button-blk .btn-txt{
   font-size:{{text-size}};
   line-height:1.5;
   color:{{font_color_picker}};
   background:{{bg_color_picker}};
   display: inline-block;
   font-weight:bold;
   padding: 10px 75px;
   font-weight: 500;
}

';
return array(
		'label' =>'Button',
		'name' =>'button-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
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
		 						'default'	=>'26px',	
		           				'content_type'=>'css',
	 						),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'align_type',		
	 							'label' =>"Alignment",
								'tab'     =>'customizer',
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
								'tab'		=>'customizer',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Background color',
								'tab'		=>'customizer',
								'default'	=>'#2cbf55',
								'content_type'=>'css',
							),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'customizer',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
													),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'customizer',
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