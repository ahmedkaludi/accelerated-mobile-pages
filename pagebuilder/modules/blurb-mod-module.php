<?php 
$output = '<div class="ln-fx">{{repeater}}</div>';
$css = '
{{if_condition_blurb_layout_type==1}}
{{module-class}}.blurb-mod{margin:{{margin_css}};padding:{{padding_css}};}
.blu-mod{margin: 0 3% 3% 0;width: 31%;text-align: {{align_type}};padding: 50px 30px;position: relative;color: #26292c;background: {{bg_color}};}
.blu-mod:nth-child(3), .blu-mod:nth-child(6), .blu-mod:nth-child(9){margin-right:0;}
{{module-class}} .ln-fx{width:100%;display:flex; flex-wrap:wrap;margin:{{margin_css}};padding:{{padding_css}};}
.blu-mod .blurb-txt{font-size: {{text-size}};font-weight: 500;color:{{font_color_picker}};}
.blu-mod .ico-pic{font-size:35px;color:{{ic_color_picker}};margin-bottom:30px;display:inline-block;background:{{bg_color_picker}};border-radius:50%;padding:15px;}
{{module-class}} .blu-mod p{margin: 15px 0px 0px 0px;font-size: 15px;color: #555;line-height: 1.7;}
{{ifend_condition_blurb_layout_type_1}}
{{if_condition_check_for_border==1}}
	{{if_condition_blurb_layout_type==1}}
	{{module-class}} .blu-mod .ico-pic{
		border-radius:100%;
		padding:20px;
		border:{{border_width}} solid {{border_color}};
	}
	{{ifend_condition_blurb_layout_type_1}}
{{ifend_condition_check_for_border_1}}
@media(max-width:768px){
	{{module-class}} .blu-mod{width: 100%;margin-right:0}
}


';
global $redux_builder_amp;
if($redux_builder_amp['amp-rtl-select-option']){
	$css .= '/** RTL CSS **/
	.blu-mod{
	    margin: 0 0% 3% 3%;
	}
	.blu-mod:nth-child(3), .blu-mod:nth-child(6), .blu-mod:nth-child(9){
	    margin-left:0;
	}
	@media(max-width:768px){
		/** RTL CSS **/
		.blu-mod{
			width: 100%;
			margin-left:0
		}
	}';
}
//$commonCss = '';
return array(
		'label' =>'Blurb',
		'name' =>'blurb-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced',
			  'layout' => 'Layout'
            ),
		'fields' => array(
						array(    
				            'type'    =>'layout-image-picker',
				            'name'    =>"blurb_layout_type",
				            'label'   =>"Select Layout",
				            'tab'     =>'layout',
				            'default' =>'1',    
				            'options_details'=>array(
				                            array(
				                              'value'=>'1',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/blur-mod-1.png'
				                            ),
				                          ),
				            'content_type'=>'html',
				            ),
						array(
								'type'		=>'color-picker',
								'name'		=>"ic_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Icon Background',
								'tab'		=>'design',
								'default'	=>'#43c45d',
								'content_type'=>'css',
							),
						array(
								'type'		=>'text',
								'name'		=>"text-size",
								'label'		=>'Font Size',
								'tab'		=>'design',
								'default'	=>'26px',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Text Color',
								'tab'		=>'design',
								'default'	=>'#222222',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color",
								'label'		=>'Background Color',
								'tab'		=>'design',
								'default'	=>'#f4f4f4',
								'content_type'=>'css'
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
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_border",
                                'label'     => 'Border',
                                'tab'       =>'design',
                                'default'   =>1,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'html',
                                
                            ),
						array(
                                'type'      =>'text',
                                'name'      =>"border_width",
                                'label'     =>'Border Width',
                                'tab'       =>'design',
                                'default'   =>'3px',
                                'content_type'=>'css',
                                'required'  => array('check_for_border'=>'1'),
                                
                            ),
						array(
                                'type'      =>'color-picker',
                                'name'      =>"border_color",
                                'label'     =>'Border Color',
                                'tab'       =>'design',
                                'default'   =>'#fff',
                                'content_type'=>'css',
                                'required'  => array('check_for_border'=>'1'),
                                
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
//		'front_common_css'=>$commonCss,
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
		'repeater'=>array(
          'tab'=>'customizer', 
          'fields'=>array(
		               array(		
		 						'type'		=>'icon-selector',		
		 						'name'		=>"icon-picker",		
		 						'label'		=>'Icon',
		           				'tab'       =>'customizer',
		 						'default'	=>'check_circle',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Description',	
		           				'content_type'=>'html',
	 					),
                
              ),
          'front_template'=>
        '{{if_condition_blurb_layout_type==1}}
        	<div class="blu-mod">
				<span class="ico-pic icon-{{icon-picker}}"></span>
				<h3 class="blurb-txt">{{content_title}}</h3>
				{{content}}
			</div> 
		{{ifend_condition_blurb_layout_type_1}}
		'
          ),
	);

?>