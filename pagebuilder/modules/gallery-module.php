<?php 
$output = 
'<div {{if_id}}id="{{id}}"{{ifend_id}} class="amp-gallery-mod {{user_class}}">
	<div class="amp_gallery_wrapper">{{repeater}}</div>
</div>
';
$commoncss = '';
$css = '
.gal-mod{text-align:{{align_type}};padding:{{padding_css}};margin:{{margin_css}};}
.gallery{text-align:{{align_type}};padding:{{padding_css}};margin:{{margin_css}};}
{{module-class}} .amp_gallery_wrapper amp-img{max-width:{{width}};margin:0 2% 15px 2%;display: inline-block;vertical-align: middle;width:100%;}
';
return array(
		'label' =>'Logo',
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
								'type'		=>'checkbox',
								'name'		=>"image_layout",
								'tab'		=>'customizer',
								'label'		=>'Responsive',
								'default'	=>array('responsive'),
								'options'	=>array(
												array(
													'value'=>'responsive',
												),
											),
								'content_type'=>'html',
							),
						array(		
		 						'type'		=>'checkbox_bool',		
		 						'name'		=>"logo_img_link",		
		 						'label'		=>'Hyperlink',
		           				'tab'     	=>'customizer',
		 						'default'	=>0,
		 						'content_type'=>'html',	
		           				'options'	=>array(
												array(
													'label'=>'Make an Hyperlink Image',
													'value'=>1,
												),
											),
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
	 						'type'		=>'text',		
	 						'name'		=>"logo_img_url",		
	 						'label'		=>'URL',
	           				'tab'     =>'customizer',
	 						'default'	=>'#',
	           				'content_type'=>'html',
	           				'required'  => array('logo_img_link'=>1),
 						),
 						array(		
	 							'type'	=>'select',		
	 							'name'  =>'logo_img_link_open',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'    =>'Same page'
	 											),
	 							'content_type'=>'html',
	 							'required'  => array('logo_img_link'=>'1'),
	 						),
 						
              ),
          'front_template'=>'{{if_condition_logo_img_link==1}}<a href="{{logo_img_url}}" {{if_condition_logo_img_link_open==new_page}}target="_blank"{{ifend_condition_logo_img_link_open_new_page}}>{{ifend_condition_logo_img_link_1}}{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}} alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}{{if_condition_logo_img_link==1}}</a>{{ifend_condition_logo_img_link_1}}'
          ),
	);



?>