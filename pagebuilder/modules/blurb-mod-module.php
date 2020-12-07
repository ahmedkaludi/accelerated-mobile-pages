<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '<div {{if_id}}id="{{id}}"{{ifend_id}} class="ln-fx {{if_user_class}}{{user_class}}{{ifend_user_class}}">{{repeater}}</div>';
$css = '
{{if_condition_blurb_layout_type==1}}
{{module-class}} .ln-fx{width:100%;display:flex; flex-wrap:wrap;margin:{{margin_css}};padding:{{padding_css}};}

{{module-class}}.blurb-mod{margin:{{margin_css}};padding:{{padding_css}};}

{{module-class}} .blu-mod .blurb-txt{font-size: {{text-size}};font-weight: {{fnt_wght}};color:{{font_color_picker}};}
{{module-class}} .blu-mod .ico-pic{font-size:{{ic-size}};color:{{ic_color_picker}};
	margin:{{ic_margin_gap}};display:inline-block;background:{{bg_color_picker}};border-radius:50%;padding:15px;}
{{module-class}} .blu-mod{font-size: 15px;line-height: 1.7;}
{{module-class}} .blu-mod p{margin: {{mrgn_css}};}


 {{module-class}} .blu-mod{
 	margin: {{margin_gpg}};
 	padding: {{padding_gpg}};
 	width: {{if_condition_dsgn_clmns==2_col}} 48%; {{ifend_condition_dsgn_clmns_2_col}}
 		   {{if_condition_dsgn_clmns==3_col}} 31%; {{ifend_condition_dsgn_clmns_3_col}}
 		   {{if_condition_dsgn_clmns==4_col}} 22.5%; {{ifend_condition_dsgn_clmns_4_col}}
 	text-align: {{align_type}};position: relative;color: {{des_color}};background: {{bg_color}};
 {{if_condition_check_for_bdr==1}}border:1px solid {{bdr_color}};{{ifend_condition_check_for_bdr_1}}
}
{{if_condition_dsgn_clmns==2_col}}
 {{module-class}} .blu-mod:nth-child(even){margin-right:0;}
{{ifend_condition_dsgn_clmns_2_col}}

{{if_condition_dsgn_clmns==3_col}}
 {{module-class}} .blu-mod:nth-child(3), .blu-mod:nth-child(6), .blu-mod:nth-child(9){margin-right:0;}
{{ifend_condition_dsgn_clmns_3_col}}

{{if_condition_dsgn_clmns==4_col}}
 {{module-class}} .blu-mod:nth-child(4), .blu-mod:nth-child(8), .blu-mod:nth-child(12){margin-right:0;}
{{ifend_condition_dsgn_clmns_4_col}}

{{if_condition_check_for_bdr==1}}
	border:1px solid #ccc;
{{ifend_condition_check_for_bdr_1}}

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
if(ampforwp_get_setting('amp-rtl-select-option')){
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
              'layout' => 'Layout',
              'design'=>'Design',
              'advanced' => 'Advanced'
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
								'type'		=>'text',
								'name'		=>"ic-size",
								'label'		=>'Icon Size',
								'tab'		=>'design',
								'default'	=>'35px',
								'content_type'=>'css'
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
								'type'		=>'spacing',
								'name'		=>"ic_margin_gap",
								'label'		=>'Icon Gapping',
								'tab'		=>'design',
								'default'	=>
					                            array(
					                                'top'=>'0px',
					                                'right'=>'0px',
					                                'bottom'=>'30px',
					                                'left'=>'0px',
					                            ),
								'content_type'=>'css',
							),
						array(
								'type'		=>'text',
								'name'		=>"text-size",
								'label'		=>'Heading Font Size',
								'tab'		=>'design',
								'default'	=>'26px',
								'content_type'=>'css'
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'fnt_wght',		
	 							'label' =>"Heading Font Weight",
								'tab'     =>'design',
	 							'default' =>'500',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Heading Color',
								'tab'		=>'design',
								'default'	=>'#222222',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"des_color",
								'label'		=>'Description Color',
								'tab'		=>'design',
								'default'	=>'#555',
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
								'type'		=>'spacing',
								'name'		=>"mrgn_css",
								'label'		=>'Content Gapping',
								'tab'		=>'design',
								'default'	=>array(
													'left'=>'0px',
													'right'=>'0px',
													'top'=>'15px',
													'bottom'=>'0px'
												),
								'content_type'=>'css',
							),
						array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_bdr",
                                'label'     => 'Border',
                                'tab'       =>'design',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'html',
                            ),
						array(
								'type'		=>'color-picker',
								'name'		=>"bdr_color",
								'label'		=>'Border Color',
								'tab'		=>'design',
								'default'	=>'#ccc',
								'content_type'=>'css',
								'required'  => array('check_for_bdr'=>'1'),
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
                                'label'     => 'Icon Border',
                                'tab'       =>'design',
                                'default'   =>0,
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
	 							'type'	=>'select',		
	 							'name'  =>'dsgn_clmns',		
	 							'label' =>"DIfferent Designs by Columns",
								'tab'     =>'design',
	 							'default' =>'3_col',
	 							'options_details'=>array(
	 												'2_col'    =>'2 Columns',
	 												'3_col'    =>'3 Columns',
	 												'4_col'    =>'4 Columns', 													),
	 							'content_type'=>'css',
	 							'required'  => array('blurb_layout_type'=>'1'),
	 						),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_gpg",
								'label'		=>'Margin',
								'tab'		=>'design',
								'default'	=>
                            array(
                                'top'=>'0',
                                'right'=>'3%',
                                'bottom'=>'3%',
                                'left'=>'0',
                            ),
								'content_type'=>'css',
							),
						array(
							'type'		=>'spacing',
							'name'		=>"padding_gpg",
							'label'		=>'Padding',
							'tab'		=>'design',
							'default'	=>array(
												'left'=>'30px',
												'right'=>'30px',
												'top'=>'50px',
												'bottom'=>'50px'
											),
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
	 							'type'	=>'select',		
	 							'name'  =>'blurb_head_type',
	 							'label' => esc_html__('Header Type', 'accelerated-mobile-pages'),
								'tab'     =>'customizer',
	 							'default' =>'h3',
	 							'options_details'=>array(
	 												'h1'  	=>'H1',
	 												'h2'  	=>'H2',
	 												'h3'  	=>'H3',
	 												'h4'  	=>'H4',
	 												'h5'  	=>'H5',
	 												'h6'  	=>'H6',
	 											),
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
				<{{blurb_head_type}} class="blurb-txt">{{content_title}}</{{blurb_head_type}}>
				{{content}}
			</div> 
		{{ifend_condition_blurb_layout_type_1}}
		'
          ),
	);

?>