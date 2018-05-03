<?php 
$output = 
'<div class="amp-gallery-mod">
	<div class="amp_gallery_wrapper">{{repeater}}</div>
</div>
';
$commoncss = '';
$css = '
.gal-mod{text-align:{{align_type}};padding:{{padding_css}};margin:{{margin_css}};}
.gallery{text-align:{{align_type}};padding:{{padding_css}};margin:{{margin_css}};}
{{module-class}} .amp_gallery_wrapper amp-img{width:{{width}};margin:0 2%;display:inline-flex;}
';
return array(
		'label' =>'Gallery',
		'name' =>'gallery',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"width",		
		 						'label'		=>'Width',
		           				 'tab'      =>'customizer',
		 						'default'	=>'500px',	
		           				'content_type'=>'css',
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
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'auto',
                                'bottom'=>'20px',
                                'left'=>'auto',
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
		'repeater'=>array(
          'tab'=>'customizer',
          'fields'=>array(
		                array(		
	 						'type'		=>'upload',		
	 						'name'		=>"img_upload",		
	 						'label'		=>'Image',
	           				'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
 						),
 						array(
								'type'		=>'checkbox',
								'name'		=>"image_layout",
								'tab'		=>'design',
								'default'	=>array('responsive'),
								'options'	=>array(
												array(
													'label'=>'Responsive',
													'value'=>'responsive',
												),
											),
								'content_type'=>'html',
							),
              ),
          'front_template'=>'{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}}  alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}'
          ),
	);



?>