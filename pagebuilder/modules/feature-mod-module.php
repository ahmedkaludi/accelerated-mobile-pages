<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
	<div {{if_id}}id="{{id}}"{{ifend_id}} class="ln-fx {{user_class}}">{{repeater}}</div>';
$css = '
.feature-mod{margin:{{margin_css}};padding:{{padding_css}};}
{{if_condition_feature_layout_type==1}}
{{module-class}} .ln-fx{width:100%;display:flex; flex-wrap:wrap;}
.feat-blk{ margin: 0 3% 3% 0; background: {{background_color_picker}}; width: 47%; text-align: center;padding: 40px; position: relative;color: #26292c;}
.feat-blk p{color: #333;font-size: 18px;padding-top:15px;}
.feat-blk h3{font-size:28px;color:{{font_color_picker}};font-weight:400;padding-bottom:15px;}
.feat-blk amp-img{margin:0 auto;width:100%}
.feat-blk amp-img{width:{{img_width}};}
{{if_condition_check_for_btn==1}}
.feat-blk .fe_btn{
	font-size:{{btn_size}};
	font-weight:{{btn_weight}};
	color:{{btn_color}};
	background:{{btn_bg_color}};
	border-radius:{{bdr_rds}};
	padding: 10px 20px;
    margin-top: 15px;
    display: inline-block;
}
{{ifend_condition_check_for_btn_1}}
@media(max-width:768px){
    .feat-blk{width: 100%;margin-right: 0;}
}
@media(max-width:425px){
	.feat-blk amp-img{width:100%;}
}
{{ifend_condition_feature_layout_type_1}}
';
return array(
		'label' =>'Feature',
		'name' =>'feature-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'layouts'=> 'Layouts',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(    
				            'type'    =>'layout-image-picker',
				            'name'    =>"feature_layout_type",
				            'label'   =>"Select Layout",
				            'tab'     =>'layouts',
				            'default' =>'1',    
				            'options_details'=>array(
				                            array(
				                              'value'=>'1',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/feature-1.png'
				                            ),
				                          ),
				            'content_type'=>'html',
				            ),
						 array(
								'type'		=>'checkbox',
								'name'		=>"image_layout",
								'tab'		=>'customizer',
								'label'		=>'Image Type',
								'default'	=>array('layout="responsive"'), 
								'options'	=>array(
												array(
													'label'=>'Responsive', 
													'value'=>'layout="responsive"',
												),
											),
								'content_type'=>'html',
								'required'  => array('feature_layout_type'=> 1)
							),
				         array(		
		 						'type'		=>'text',		
		 						'name'		=>'img_width',		
		 						'label'		=>'Image Size',
		           				 'tab'      =>'customizer',
		 						'default'	=>'300px',	
		           				'content_type'=>'css',
		           				'required'  => array('feature_layout_type'=> 1)
	 						),
				         array(
				                'type'    =>'checkbox_bool',
				                'name'    =>"check_for_btn",
				                'label'   => 'Enable Button',
				                'tab'   =>'customizer',
				                'default' =>0,
				                'options' =>array(
						                        array(
						                          'label'=>'Yes',
						                          'value'=>1,
						                        )
				                      		),
				                'content_type'=>'html',
				                'required'  => array('feature_layout_type'=> 1)
				            ),
	 					
						array(
								'type'		=>'color-picker',
								'name'		=>"background_color_picker",
								'label'		=>'Background Color',
								'tab'		=>'design',
								'default'	=>'#f4f4f4',
								'content_type'=>'css',
								'required'  => array('feature_layout_type'=> 1)
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Text Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css',
								'required'  => array('feature_layout_type'=> 1)
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
	 							'required'  => array('feature_layout_type'=> 1)
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_size",		
		 						'label'		=>'Button Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'16px',	
		           				'content_type'=>'css',
		           				'required'  => array('feature_layout_type'=> 1)
	 						),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'btn_weight',		
	 							'label' =>"Button Font Weight",
								'tab'     =>'design',
	 							'default' =>'400',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
	 							'required'  => array('feature_layout_type'=> 1)
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"btn_color",
								'label'		=>'Button Text Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css',
								'required'  => array('feature_layout_type'=> 1)
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"btn_bg_color",
								'label'		=>'Background Color',
								'tab'		=>'design',
								'default'	=>'#555',
								'content_type'=>'css',
								'required'  => array('feature_layout_type'=> 1)
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>'bdr_rds',		
		 						'label'		=>'Border Radius',
		           				 'tab'     =>'design',
		 						'default'	=>'0px',	
		           				'content_type'=>'css',
		           				'required'  => array('feature_layout_type'=> 1)
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
                                'right'=>'0px',
                                'bottom'=>'20px',
                                'left'=>'0px',
                            ),
								'content_type'=>'css',
								'required'  => array('feature_layout_type'=> 1)
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
								'required'  => array('feature_layout_type'=> 1)
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
	           				'required'  => array('feature_layout_type'=> 1)
	 						),
	 					array(		
	 						'type'		=>'upload',		
	 						'name'		=>"img_upload",		
	 						'label'		=>'Image',
	           				 'tab'     =>'customizer',
	 						'default'	=>'',	
	           				'content_type'=>'html',
	           				'required'  => array('feature_layout_type'=> 1)
	 					),
				        array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.',	
		           				'content_type'=>'html',
		           				'required'  => array('feature_layout_type'=> 1)
	 					),


	 					array(		
							'type'			=>	'text',		
							'name'			=>	"btn_txt",		
							'label'			=>	'Button Text',
							'tab'     		=>	'customizer',
							'default'		=>	'Learn More',	
							'content_type'	=>	'html',
							'helpmessage'	=>	'Leave empty if do not want to show button.',
							'required'  	=>  array('feature_layout_type'=>'1', 'check_for_btn'=>'1'),					
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_link",		
		 						'label'		=>'URL',
		           				'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
		           				'required'  =>  array('feature_layout_type'=>'1', 'check_for_btn'=>'1'),
	 						),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'page_link_open',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'    =>'Same page'
	 											),
	 							'content_type'=>'html',
	 							'required'  =>  array('feature_layout_type'=>'1', 'check_for_btn'=>'1'),
	 						),
	 					
              ),
          'front_template'=>
        '{{if_condition_feature_layout_type==1}}<div class="feat-blk">
      		<h3 class="t-txt">{{content_title}}</h3>
			{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" {{image_layout}} alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
			<p>{{content}}</p>
			{{if_condition_check_for_btn==1}}
				{{if_btn_txt}}
				<a href="{{btn_link}}" {{if_condition_page_link_open==new_page}}target="_blank"{{ifend_condition_page_link_open_new_page}} class="fe_btn">{{btn_txt}}</a>
				{{ifend_btn_txt}}
			{{ifend_condition_check_for_btn_1}}
      	</div> {{ifend_condition_feature_layout_type_1}}'
          ),

	);

?>