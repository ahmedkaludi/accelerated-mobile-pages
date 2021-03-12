<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
	{{if_condition_img_hyperlink==1}}<a href="{{hyperlink_link_img}}" {{if_condition_img_link_open==new_page}}target="_blank"{{ifend_condition_img_link_open_new_page}}>{{ifend_condition_img_hyperlink_1}}
		{{if_img_upload}}<figure><amp-img src="{{img_upload}}" {{if_id}}id="{{id}}"{{ifend_id}} width="{{image_width}}" height="{{image_height}}" srcset="{{image_srcset}}" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}}  alt="{{image_alt}}" class="{{user_class}}"></amp-img>{{if_condition_image_caption==1}}<figcaption><center>{{image_caption}}</center></figcaption>{{ifend_condition_image_caption_1}}</figure>{{ifend_img_upload}}
	{{if_condition_img_hyperlink==1}}</a>{{ifend_condition_img_hyperlink_1}}';

$css = '
{{module-class}}{text-align:{{align_type}};margin:{{margin_css}};padding:{{padding_css}};width:{{width}}}
{{if_condition_check_for_fullwidth==1}}
@media(max-width:425px){
{{module-class}}{
	width:100%;
}	
}
{{ifend_condition_check_for_fullwidth_1}}
';

return array(
		'label' =>'Image',
		'name' =>'image-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Upload',
		           				'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
                            array(		
		 						'type'		=>'text',		
		 						'name'		=>"width",		
		 						'label'		=>'Image Size',
		           				 'tab'      =>'customizer',
		 						'default'	=>'90%',	
		           				'content_type'=>'css',
	 						),

	 					array(		
		 						'type'		=>'checkbox_bool',		
		 						'name'		=>"image_caption",		
		 						'label'		=> esc_html__('Caption','accelerated-mobile-pages'),
		           				'tab'     	=>'customizer',
		 						'default'	=> 1,
		 						'content_type'=>'html',	
		           				'options'	=>array(
												array(
													'label'=>'Image Caption',
													'value'=>1,
												),
											),
	 						),
	 					array(		
		 						'type'		=>'checkbox_bool',		
		 						'name'		=>"img_hyperlink",		
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
		 						'type'		=>'text',		
		 						'name'		=>"hyperlink_link_img",		
		 						'label'		=>'URL',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
		           				'required'  => array('img_hyperlink'=>'1'),
	 						),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'img_link_open',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'    =>'Same page'
	 											),
	 							'content_type'=>'html',
	 							'required'  => array('img_hyperlink'=>'1'),
	 						),

				        array(
								'type'		=>'checkbox',
								'name'		=>"image_layout",
								'tab'		=>'customizer',
								'default'	=>array('responsive'),
								'options'	=>array(
												array(
													'label'=>'Responsive',
													'value'=>'responsive',
												),
											),
								'content_type'=>'html',
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
				                'type'    =>'checkbox_bool',
				                'name'    =>"check_for_fullwidth",
				                'label'   => 'Full Width for Responsive',
				                'tab'   =>'design',
				                'default' =>1,
				                'options' =>array(
				                        array(
				                          'label'=>'Yes',
				                          'value'=>1,
				                        )
				                      ),
				                'content_type'=>'html',
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
	);

?>