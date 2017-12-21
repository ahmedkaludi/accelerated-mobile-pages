<?php 
$output = '
<div class="fea-mod">
	<h3 class="t-txt">{{content_title}}</h3>
	<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="{{image_layout}}"></amp-img>
	<p>{{content}}</p>
</div>

';
$css = '
.row-setting-21 .col.col-1{
	display:inline-flex;
	width:100%;
}
.feature-sec{
	width:100%;
	margin:0 auto;
}
.feature-mod amp-img{
   width:100%;
   display:inline-block;
}
.feature-mod{
	background:#eee;
    display: flex;
    flex-direction: column;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    flex: 1 0 25%;
}
.fea-mod{
	background: #fff;
    padding: 30px;
    margin: 5% 4%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.fea-mod p{
	padding-top:30px;
}
.feature-mod .fea-mod h3{
   font-size:30px;
   line-height:1.5;
   color:{{font_color_picker}};
   margin:{{margin_css}};
   padding:{{padding_css}};
   font-weight:500;
   padding-bottom:30px;
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