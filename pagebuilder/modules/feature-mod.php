<?php 
$output = '
<div class="fea-mod">
	<h3 class="t-txt">{{content_title}}</h3>
	<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}"></amp-img>
	<p>{{content}}</p>
</div>

';
$css = '
.row-setting-9{
	display:inline-flex;
	width:100%;
}
.feature-mod{
	background:#ccc;
	 display: flex;
}
.feature-mod .fea-mod{
   width:100%;
   display:inline-block;
   text-align:{{align_type}};
   padding: 20px 40px;
}
.feature-mod .fea-mod .t-txt{
   font-size:30px;
   line-height:1.5;
   color:{{font_color_picker}};
   margin:{{margin_css}};
   padding:{{padding_css}};
}

';
return array(
		'label' =>'Feature',
		'name' =>'feature-mod',
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
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Color',
								'tab'		=>'customizer',
								'default'	=>'#333',
								'content_type'=>'css'
							),
	 					array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Image Upload',
		           				 'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 					),
	 					array(
				               'type'  =>'text',
				              'name'=>"image_height",
				              'label'=>"Image height",
				              'tab'  => "customizer",
				              'default'=>'150',
				              'content_type'=>'html',
				            ),
				        array(
				               'type'  =>'text',
				              'name'=>"image_width",
				              'label'=>"Image width",
				              'tab'  => "customizer",
				              'default'=>'150',
				              'content_type'=>'html',
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
		 						'type'		=>'textarea',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
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