<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
<div {{if_id}}id="{{id}}"{{ifend_id}} class="ln-fx {{user_class}}">{{repeater}}</div>';
$css = '
{{if_condition_pricing_layout_type==1}}
.pricing-mod{margin:{{margin_css}};padding:{{padding_css}};}
{{module-class}} .ln-fx{width:100%;display:inline-flex; display: flex;flex-wrap: wrap;} 
.pri-mod{display: flex;flex-direction: column;flex: 1 0 25%;text-align:center;background:#f4f4f4;position:relative;padding:30px 50px;margin:0 10px;overflow: hidden;}
.pri-mod .pri-tlt{font-size: 20px;font-weight: 400;margin-bottom:10px;}
.pri-mod span{display:block;}
.pri-lbl{font-size: 45px;font-weight: 500;}
.pri-desc{font-size: 12px;color: #666;margin-top: 5px;}
.pri-mod .btn-txt{background:{{btn_bg_color}};color: {{font_color_picker}};padding: 10px 30px;display: block;margin: 24px auto 0 auto;}
.pri-recom{font-size: 11px;position: absolute;right: 0;top: 0px;display: block;font-weight: 700;height: 32px;line-height: 32px;color: #fff;z-index: 1;min-width: 80px;transform: rotate(45deg) translate(23%,57%);}
.pri-recom:after{content: "";position: absolute;border-bottom: 32px solid #2cbf55;border-left: 32px solid transparent;border-right: 32px solid transparent;height: 0;width: 188%;z-index: -1;left: -47%;}
.pri-cnt{color: #444;margin-top: 25px;font-size: 14px;}
.pricing-mod .pri-cnt p{margin-bottom:10px;}
.feature-pri{top: -30px;}
@media(max-width:768px){
	.pri-mod{flex:1 0 100%;margin:0px 0px 20px 0px;}
	.feature-pri{top:0;}
}
{{ifend_condition_pricing_layout_type_1}}

';
if( ampforwp_get_setting('amp-design-selector') != 4 ) {
 $css .= '@media(max-width:768px){
	.pri-mod{flex:100%;margin:0px 0px 20px 0px;}
}';
}
return array(
		'label' =>'Pricing',
		'name' =>'pricing-mod',
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
				            'name'    =>"pricing_layout_type",
				            'label'   =>"Select Layout",
				            'tab'     =>'layouts',
				            'default' =>'1',    
				            'options_details'=>array(
				                            array(
				                              'value'=>'1',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/pricing-mod-1.png'
				                            ),
				                          ),
				            'content_type'=>'html',
				            ),
						
	 					array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Button Text',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
	 					array(
								'type'		=>'color-picker',
								'name'		=>"btn_bg_color",
								'label'		=>'Button Background',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
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
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"price_label",		
		 						'label'		=>'Price',
		           				'tab'       =>'customizer',
		 						'default'	=>'$0.00',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"price_desc",		
		 						'label'		=>'Description',
		           				'tab'       =>'customizer',
		 						'default'	=>'Price Desc',	
		           				'content_type'=>'html',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_title",		
		 						'label'		=>'Button',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Button',	
		           				'content_type'=>'html',
	 						),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_link",		
		 						'label'		=>'URL',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),
	 					array(		
	 							'type'	=>'select',		
	 							'name'  =>'page_link_open_price',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'     =>'Same page'
	 											),
	 							'content_type'=>'html',
	 						),
	 					array(
			                    'type'    =>'checkbox_bool',
			                    'name'    =>"check_for_nofollow_price",
			                    'label'   => 'Nofollow Link',
			                    'tab'   =>'customizer',
			                    'default' =>0,
			                    'options' =>array(
			                            array(
			                              'label'=>'Yes',
			                              'value'=>1,
			                            )
			                          ),
			                    'content_type'=>'html',
                            ),
						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"text_desc",		
		 						'label'		=>'Content',
		           				'tab'       =>'customizer',
		 						'default'	=>'Content',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"recommended_text",		
		 						'label'		=>'Recommended Text (Leave Empty to remove)',
		           				'tab'       =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
                
              ),
          'front_template'=>
          '{{if_condition_pricing_layout_type==1}}
	          	<div class="pri-mod {{if_recommended_text}}feature-pri {{ifend_recommended_text}}">
					<h4 class="pri-tlt">{{content_title}}</h4>
					{{if_recommended_text}}<span class="pri-recom">{{recommended_text}}</span>{{ifend_recommended_text}}
					<span class="pri-lbl">{{price_label}}</span>
					<span class="pri-desc">{{price_desc}}</span>
					<a href="{{btn_link}}" {{if_condition_page_link_open_price==new_page}}target="_blank"{{ifend_condition_page_link_open_price_new_page}} {{if_condition_check_for_nofollow_price==1}}rel="nofollow"{{ifend_condition_check_for_nofollow_price_1}}  class="btn-txt">{{btn_title}}</a>
					<div class="pri-cnt">
						{{text_desc}}
					</div>
				</div>
			{{ifend_condition_pricing_layout_type_1}}
			'
          ),

	);

?>