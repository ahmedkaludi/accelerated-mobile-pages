<?php 
$output = '
<div class="image-blk">
	<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="{{image_layout}}"></amp-img>
</div>


';
$css = '
.image-mod{
	width:100%;
	margin:20px 0px 0px;
   padding:{{padding_css}};
}
.image-mod .image-blk{
   width:100%;
   display:inline-block;
   text-align:{{align_type}};
}




';
return array(
		'label' =>'Image',
		'name' =>'image-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Customizer',
              'container_css'=>'Container css'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Image Upload',
		           				 'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
						array(
								'type'		=>'checkbox',
								'name'		=>"image_layout",
								'label'		=>'Enable for Responsive Image',
								'tab'		=>'customizer',
								'default'	=>array(),
								'options'	=>array(
												array(
													'label'=>'Enable',
													'value'=>'responsive',
												),
											),
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