<?php 
$output = '
	<div class="ln-fx">{{repeater}}</div>';
$css = '
.feature-mod{
	margin:{{margin_css}};
   	padding:{{padding_css}};
}
{{module-class}} .ln-fx{
	width:100%;
	display:flex; 
    flex-wrap:wrap;
}
.feat-blk{ 
    margin: 0 3% 3% 0; 
    background: {{background_color_picker}}; 
    width: 47%; 
    text-align: center;
    padding: 40px; 
    position: relative;
    color: #26292c;
}
.feat-blk p{
    color: #333;
    font-size: 18px;
    padding-top:15px;
}
.feat-blk h3{
   font-size:28px;
   color:{{font_color_picker}};
   font-weight:400;
   padding-bottom:15px;
}
.feat-blk amp-img{margin:0 auto;width:100%}

';
return array(
		'label' =>'Feature',
		'name' =>'feature-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(

						array(
								'type'		=>'color-picker',
								'name'		=>"background_color_picker",
								'label'		=>'Background',
								'tab'		=>'design',
								'default'	=>'#f4f4f4',
								'content_type'=>'css'
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
		'repeater'=>array(
          'tab'=>'customizer',
          'fields'=>array(
                		array(		
	 						'type'		=>'text',		
	 						'name'		=>"content_title",		
	 						'label'		=>'Heading',
	           				'tab'       =>'customizer',
	 						'default'	=>'Your Feature Title',	
	           				'content_type'=>'html',
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
								'default'	=>array('layout="responsive"'), 
								'options'	=>array(
												array(
													'label'=>'Enable', 
													'value'=>'layout="responsive"',
												),
											),
								'content_type'=>'html',
							),
				        array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Your Description',	
		           				'content_type'=>'html',
	 					),
                
              ),
          'front_template'=>
        '<div class="feat-blk">
      		<h3 class="t-txt">{{content_title}}</h3>
			<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" {{image_layout}}></amp-img>
			{{content}}
      	</div> '
          ),

	);

?>