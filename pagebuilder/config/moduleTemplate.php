<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$moduleTemplate = array();
$layoutTemplate = array();

	add_action("plugins_loaded", "ampforwp_module_templates");


if(!function_exists("ampforwp_module_templates")){
	function ampforwp_module_templates(){
		global $moduleTemplate, $layoutTemplate;

		$dir = AMP_PAGE_BUILDER.'/modules/';
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	if(is_file($dir.$file) && strpos($file, '-module.php') == true){
		        		$moduleTemplate[str_replace("-module.php", "", $file)] = include $dir.$file;
		        	}
		        }
		        closedir($dh);
		        $moduleTemplate = apply_filters("ampforwp_pagebuilder_modules_filter", $moduleTemplate);
		    }
		}


		$dir = AMP_PAGE_BUILDER.'/layouts/';
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {

		        while (($file = readdir($dh)) !== false) {
		        	if(is_dir($dir.$file) && strpos($file, '-layouts') == true){
		        		$layoutTemplate[str_replace('-layouts', "", $file)] = array();
		        		$layoutdir = $dir.$file."/";
		        		if ($dhInside = opendir($layoutdir)) {
		        			$layOutPreview = "";
		        			while (($layoutfile = readdir($dhInside)) !== false) {
			        			if(is_file($layoutdir.$layoutfile) && strpos($layoutfile, '-layout.php') == true){
					        		$layoutTemplate[str_replace('-layouts', "", $file)][str_replace(".php", "", $layoutfile)] = include $layoutdir.$layoutfile;
					        	}
					        }
					         closedir($dhInside);
		        		}
		        	}
		        	/*if(is_file($dir.$file) && strpos($file, '-layout.php') == true){
		        		$layoutTemplate[str_replace(".php", "", $file)] = include $dir.$file;
		        	}*/
		        }
		        closedir($dh);
		        $layoutTemplate = apply_filters("ampforwp_pagebuilder_layout_filter", $layoutTemplate);
		    }
		}
	}//Function closed
}//If Fucntion check closed

//Row Contents
$output = '<section {{if_row_id}}id={{row_id}}{{ifend_row_id}} class="ap_m {{row_class}} {{grid_type}} {{if_condition_check_for_slant==1}}slant_clr{{ifend_condition_check_for_slant_1}}">
	{{if_condition_background_type==video}}
	<div class="amp_video">
		<div class="amp-txt">
	      <h1>{{title}}</h1>
	      {{content_title}}
	  	</div>
		<amp-iframe class="vdo" width="854" height="480"
	          sandbox="allow-scripts allow-same-origin"
	          layout="responsive"
	          frameborder="0"
	          src="{{row_background_video}}">
	    </amp-iframe>
    	{{if_condition_check_for_overlay==1}}
    		<div class="overlay"></div>
    	{{ifend_condition_check_for_overlay_1}}
    </div>
    {{ifend_condition_background_type_video}}
    ';
$outputEnd = '<div class="cb"></div> </section>';
$front_css = '
{{if_condition_background_type==image}}
{{row-class}}{
	background-image: url({{row_background_image}});
	background-repeat: no-repeat;
    background-size: cover;
    height: auto;
    background-position:{{align_type}};
    {{if_condition_check_for_parallax==1}}
		min-height: 550px;
	    background-attachment: fixed;
	{{ifend_condition_check_for_parallax_1}}
}
{{ifend_condition_background_type_image}}

{{row-class}}.amppb-fluid{width:{{fluid-width}};}
{{row-class}}.amppb-fluid .col, {{row-class}}.amppb-fluid .col-2-wrap{margin:0 auto;max-width:{{fluid-wrapper}}; }
{{row-class}}.amppb-fixed .col {max-width:{{content-width}};width:{{fixed-width}};margin: 0 auto;}

{{row-class}}{
	{{if_condition_check_for_brdr==1}}
		border-width:{{border_sz}};
		border-color: {{border_clr_pkr}};
    	border-style: solid;
	{{ifend_condition_check_for_brdr_1}}
	color: {{font_color_picker}};
	background-color: {{color_picker}};
	{{if_selected_gradient}}{{selected_gradient}};{{ifend_selected_gradient}}
	margin: {{margin_css}};
	padding:{{padding_css}};
	
	{{shadow}}
}
{{if_condition_check_for_slant==1}}
{{row-class}}.st{position:relative;}
{{ifend_condition_check_for_slant_1}}
{{if_condition_check_for_enbtp==1}}
{{row-class}}.st:before{
	content:"";
	height:110px;
	width:100%;
	display:block;
	background-image:url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' preserveAspectRatio=\'none\' viewBox=\'0 0 100 100\'><polygon fill=\'{{color_picker}}\' points=\'0,0 100,0 100,44 0,0\' /></svg>");
	background-repeat:no-repeat;
	top: -110px;
    position: absolute;
	{{if_condition_align_type_slant==left}}
		transform: rotate(-180deg);
	{{ifend_condition_align_type_slant_left}}
	{{if_condition_align_type_slant==right}}
		transform: rotate(-180deg) scaleX(-1);
	{{ifend_condition_align_type_slant_right}}
}
{{ifend_condition_check_for_enbtp_1}}

{{if_condition_check_for_enbbt==1}}
{{row-class}}.st:after{
	content:"";
	height:110px;
	width:100%;
	display:block;
	background-image:url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' preserveAspectRatio=\'none\' viewBox=\'0 0 100 100\'><polygon fill=\'{{color_picker}}\' points=\'0,0 100,0 100,44 0,0\' /></svg>");
	background-repeat:no-repeat;
	bottom: -110px;
    position: absolute;
	{{if_condition_align_type_slate_btn==lft}}
		transform: rotate(-0deg) scaleX(-1);
	{{ifend_condition_align_type_slate_btn_lft}}
	{{if_condition_align_type_slate_btn==rht}}
		transform: rotate(0deg);
	{{ifend_condition_align_type_slate_btn_rht}}    
 }
{{ifend_condition_check_for_enbbt_1}}
{{if_condition_background_type==video}}
{{row-class}} .amp_video{
  position: relative;
}
{{row-class}} .amp_video .amp-txt{
  	font-size: {{cnt_size}};
  	line-height: {{cnt_ln_hgt}};
  	font-weight: {{cnt_font_type}};
  	{{if_condition_check_for_overlay==0}}
  		color:{{cnt_color}};
  	{{ifend_condition_check_for_overlay_0}}
	position: absolute;
	top: 10%;
	bottom: auto;
	left: 20%;
	right: 20%;
	margin: 0 auto;
	text-align: center;
	z-index: 9;
}
{{row-class}} .amp-txt h1{
  font-size: {{tlt_size}};
  font-weight: {{tlt_wgt}};
  letter-spacing: {{letter_spacing}};
  line-height: {{tlt_ln_hgt}};
  {{if_condition_check_for_overlay==0}}
  	color:{{tlt_color}};
  {{ifend_condition_check_for_overlay_0}}
  margin-bottom:20px;
}
{{if_condition_check_for_overlay==1}}
{{row-class}} .overlay{
	background: #000;
	bottom: 0;
	left: 0;
	position: absolute;
	right: 0;
	top: 0;
	opacity: 0.4;
}
{{row-class}} .amp-txt{
	color:{{overlay_cnt_color}};
}
{{ifend_condition_check_for_overlay_1}}
{{ifend_condition_background_type_video}}

@media(max-width:768px){
	{{row-class}}.amppb-fluid{width:100%;}
	{{row-class}}.amppb-fluid .col, {{row-class}}.amppb-fluid .col-2-wrap{max-width:90%;}
}

@media(max-width:425px){
{{row-class}}{
	{{if_condition_check_for_pdng==1}}
		padding:{{res_pdng}};
	{{ifend_condition_check_for_pdng_1}}
	{{if_condition_check_for_mrgn==1}}
		margin: {{res_mrgn}};
	{{ifend_condition_check_for_mrgn_1}}
}
}
';
$front_common_css = '.amppb-fluid .col{margin:0 auto;max-width:{{fluid-width}}; }
.amppb-fixed .col {max-width: {{fixed-width}};width:1125px;margin: 0 auto;}';
/*border-size: {{border_css}};
	border-style:{{border_type}};*/
$containerCommonSettings = array(
			'label'	=> 'Row Settings',
			'settingType'  =>'row',
			'default_tab'=> 'customizer',
			'tabs' => array(
			  'customizer'=>'Basic',
			  'container_css'=>'Advance',
			  'design'=>'Design'
			),
			'fields' => array(
							array(
								'type'		=>'text',
								'name'		=>"row_label",
								'label'		=>'Row label',
								'tab'    	=>'container_css',
								'default'	=>'',
								'content_type'=>'html',
								),
							array(
								'type'		=>'text',
								'name'		=>'row_id',
								'label'		=>esc_html__('Row ID', 'accelerated-mobile-pages'),
								'tab'    	=>'container_css',
								'default'	=>'',
								'content_type'=>'html',
								),
					
							array(
								'type'		=>'text',
								'name'		=>"row_class",
								'label'		=>'Row class',
								'tab'     	=>'container_css',
								'default'	=>'',
								'content_type'=>'html',
								),
	 						array(
								'type'		=>'radio',
								'name'		=>"grid_type",
								'label'		=>'Grid type',
								'tab'		=>'customizer',
								'default'	=>'amppb-fluid',
								'options'	=>array(
												array(
													'label'=>'Fixed',
													'value'=>'amppb-fixed',
												),
												array(
													'label'=>'Fluid',
													'value'=>'amppb-fluid',
												),
											),
								'content_type'=>'html',
							),

							array(
								'type'		=>'text',
								'name'		=>"fixed-width",
								'label'		=>'Width',
								'tab'		=>'customizer',
								'default'	=>'1100px',
								'content_type'=>'css',
								'required'  => array('grid_type'=>'amppb-fixed')
							),
							array(
								'type'		=>'text',
								'name'		=>"content-width",
								'label'		=>'Content Width',
								'tab'		=>'customizer',
								'default'	=>'95%',
								'content_type'=>'css',
								'required'  => array('grid_type'=>'amppb-fixed')
							),

							array(
								'type'		=>'text',
								'name'		=>"fluid-width",
								'label'		=>'Width',
								'tab'		=>'customizer',
								'default'	=>'100%',
								'content_type'=>'css',
								'required'  => array('grid_type'=>'amppb-fluid')
							),
							array(
								'type'		=>'text',
								'name'		=>"fluid-wrapper",
								'label'		=>'Wrapper',
								'tab'		=>'customizer',
								'default'	=>'90%',
								'content_type'=>'css',
								'required'  => array('grid_type'=>'amppb-fluid')
							),
							array(
								'type'		=>'color-picker',
								'name'		=>"font_color_picker",
								'label'		=>'Text Font',
								'tab'		=>'customizer',
								'default'	=>'#000',
								'content_type'=>'css',
								'output_format'=>"color: %default%"
							),

							array(		
	 							'type'	=>'select',		
	 							'name'  =>"background_type",		
	 							'label' =>"Background Type",
								'tab'     =>'customizer',
	 							'default' =>'color',
	 							'options_details'=>array(
	 												'color'=>'Color',
	 												'gradient'=>'Gradient',
	 												'image'=>'Background Image',
	 												'video'=>'Background Video'
	 													),
	 							'content_type'=>'html',
	 							'output_format'=>''
	 						),
	 						array(		
		 						'type'		=>'require_script',		
		 						'name'		=>"embeded_script",		
		 						'label'		=>'amp-iframe',
		 						'default'	=>'https://cdn.ampproject.org/v0/amp-iframe-0.1.js',
		 						'content_type'=>'js',
		           				'required'  => array('background_type'=>'video'),
	 						),
	 						array(		
	 							'type'	=>'select',		
	 							'name'  =>'align_type',		
	 							'label' =>"Background Position",
								'tab'     =>'customizer',
	 							'default' =>'center',
	 							'options_details'=>array(
	 												'center'    =>'Center',
	 												'left'  	=>'Left',
	 												'right'    =>'Right', 													),
	 							'content_type'=>'css',
	 							'required'  => array('background_type'=>'image')
	 						),
	 						array(
								'type'		=>'upload',
								'name'		=>"row_background_image",
								'label'		=>"Select Image",
								'tab'		=>'customizer',
								'default'	=>'',
								'content_type'=>'css',
								'required'  => array('background_type'=>'image')
								),
	 						array(
								'type'		=>'text',
								'name'		=>"row_background_video",
								'label'		=> esc_html__( 'Background Video URL', 'accelerated-mobile-pages' ),
								'tab'		=>'customizer',
								'default'	=>'',
								'helpmessage'	=> esc_html__('Your video should be 600px away from the top or not within the first 75% of the viewport and it should be added like - https://www.youtube.com/embed/XXXXXXXXXX', 'accelerated-mobile-pages'),
								'content_type'=>'html',
								'required'  => array('background_type'=>'video')
							),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"title",		
		 						'label'		=>'Background Video Heading',
		           				 'tab'      =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
		           				'required'  => array('background_type'=>'video')
	 						),
	 						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Background Video Content',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Write your content in Text Editor',	
		           				'content_type'=>'html',
		           				'required'  => array('background_type'=>'video')
	 						),
	 						array(
		 						'type'		=>'text',		
		 						'name'		=>"tlt_size",		
		 						'label'		=>'Heading Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'35px',	
		           				'content_type'=>'css',
		           				'required'  => array('background_type'=>'video')
	 						),
	 						array(    
				                'type'  =>'select',   
				                'name'  =>'tlt_wgt',    
				                'label' =>"Heading Font Weight",
				                'tab'     =>'design',
				                'default' =>'600',
				                'options_details'=>array(
				                                    '300'   =>'Light',
				                                    '400'   =>'Regular',
				                                    '500'   =>'Medium',
				                                    '600'   =>'Semi Bold',
				                                    '700'   =>'Bold',
				                                ),
				                'content_type'=>'css',
				                'required'  => array('background_type'=>'video')
			              	),
			              	array(
		 						'type'		=>'text',		
		 						'name'		=>"letter_spacing",		
		 						'label'		=>'Heading Letter Spacing',
		           				 'tab'     =>'design',
		 						'default'	=>'1px',	
		           				'content_type'=>'css',
		           				'required'  => array('background_type'=>'video')
	 						),
	 						array(
		 						'type'		=>'text',		
		 						'name'		=>"tlt_ln_hgt",		
		 						'label'		=>'Heading Line Height',
		           				 'tab'     =>'design',
		 						'default'	=>'1.7',	
		           				'content_type'=>'css',
		           				'required'  => array('background_type'=>'video')
	 						),
	 						array(
								'type'		=>'color-picker',
								'name'		=>"tlt_color",
								'label'		=>'Heading Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css',
								'required'  => array('background_type'=>'video')
							),
							array(
		 						'type'		=>'text',		
		 						'name'		=>"cnt_size",		
		 						'label'		=>'Content Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'18px',	
		           				'content_type'=>'css',
		           				'required'  => array('background_type'=>'video')
	 						),
	 						array(    
				                'type'  =>'select',   
				                'name'  =>'cnt_font_type',    
				                'label' =>"Content Font Weight",
				                'tab'     =>'design',
				                'default' =>'400',
				                'options_details'=>array(
				                                    '300'   =>'Light',
				                                    '400'   =>'Regular',
				                                    '500'   =>'Medium',
				                                    '600'   =>'Semi Bold',
				                                    '700'   =>'Bold',
				                                ),
				                'content_type'=>'css',
				                'required'  => array('background_type'=>'video')
			              	),
	 						array(
		 						'type'		=>'text',		
		 						'name'		=>"cnt_ln_hgt",		
		 						'label'		=>'Content Line Height',
		           				 'tab'     =>'design',
		 						'default'	=>'1.7',	
		           				'content_type'=>'css',
		           				'required'  => array('background_type'=>'video')
	 						),
	 						array(
								'type'		=>'color-picker',
								'name'		=>"cnt_color",
								'label'		=>'Content Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css',
								'required'  => array('background_type'=>'video')
							),
							array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_overlay",
                                'label'     => 'Background Video Overlay',
                                'tab'       =>'design',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'html',
                                'required'  => array('background_type'=>'video')
                            ),
                            array(
								'type'		=>'color-picker',
								'name'		=>"overlay_cnt_color",
								'label'		=>'Background Video Content Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css',
								'required'  => array('background_type'=>'video', 'check_for_overlay'=>1)
							),
	 						array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_parallax",
                                'label'     => 'Parallax Effect',
                                'tab'       =>'design',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'css',
                                'required'  => array('background_type'=>'image')
                            ),
                            array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_slant",
                                'label'     => 'Slant Background',
                                'tab'       =>'design',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'html',
                                'required'  => array('background_type'=>'color')
                            ),
                            array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_enbtp",
                                'label'     => 'Enable Top',
                                'tab'       =>'design',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'css',
                                'required'  => array('background_type'=>'color', 'check_for_slant'=>1)
                            ),
                            array(		
	 							'type'	=>'select',		
	 							'name'  =>'align_type_slant',		
	 							'label' =>"Slant Position",
								'tab'     =>'design',
	 							'default' =>'left',
	 							'options_details'=>array(
	 												'left'  	=>'Left',
	 												'right'    =>'Right', 																						),
	 							'content_type'=>'css',
	 							'required'  => array('check_for_slant'=>1, 'check_for_enbtp'=>1)
	 							),
                            array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_enbbt",
                                'label'     => 'Enable Bottom',
                                'tab'       =>'design',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'css',
                                'required'  => array('background_type'=>'color', 'check_for_slant'=>1)
                            ),
                            array(		
	 							'type'	=>'select',		
	 							'name'  =>'align_type_slate_btn',		
	 							'label' =>"Slant Position",
								'tab'     =>'design',
	 							'default' =>'lft',
	 							'options_details'=>array(
	 												'lft'  	=>'Left',
	 												'rht'    =>'Right', 													),
	 							'content_type'=>'css',
	 							'required'  => array('check_for_slant'=>1, 'check_for_enbbt'=>1)
	 						),
							array(
								'type'		=>'color-picker',
								'name'		=>"color_picker",
								'label'		=>'Background Color',
								'tab'		=>'customizer',
								'default'	=>'',
								'content_type'=>'css',
								'output_format'=>"background: %default%",
								'required'  => array('background_type'=>'color')
							),
							array(
								'type'		=>'gradient-selector',
								'name'		=>"selected_gradient",
								'label'		=>'Background Gradient',
								'tab'		=>'customizer',
								'default'	=>'',
								'content_type'=>'css',
								'output_format'=>"%default%",
								'required'  => array('background_type'=>'gradient')
							),

							/*array(
								'type'		=>'checkbox',
								'name'		=>"want_border",
								'label'		=>'Border',
								'tab'		=>'customizer',
								'default'	=>array(),
								'options'	=>array(
												array(
													'label'=>'Enable',
													'value'=>1,
												),
											),
								'content_type'=>'css',
	 							'output_format'=>''
							),


							array(
								'type'		=>'spacing',
								'name'		=>"border_css",
								'label'		=>'Set Border',
								'tab'		=>'customizer',
								'default'	=>array(
													'left'=>0,
													'right'=>0,
													'top'=>0,
													'bottom'=>0
												),
								'content_type'=>'css',
								'required'  => array('want_border'=>1),
							),
							array(		
	 							'type'	=>'select',		
	 							'name'  =>"border_type",		
	 							'label' =>"Select border type",
								'tab'     =>'customizer',
	 							'default' =>'none',
	 							'options_details'=>array(
	 												'dotted'=>'Dotted',
	 												'dashed'=>'dashed',
	 												'solid'=>'solid',
	 												'double'=>'double',
	 												'groove'=>'groove',
	 												'ridge'=>'ridge',
	 												'inset'=>'inset',
	 												'outset'=>'outset',
	 												'none'=>'none',
	 												'hidden'=>'hidden',
	 													),
	 							'content_type'=>'css',
	 							'output_format'=>'border-style: %default%',
	 							'required'  => array('want_border'=>1),
	 						),*/
							array(
								'type'		=>'checkbox',
								'name'		=>"shadow",
								'label'		=>'Background Shadow',
								'tab'		=>'design',
								'default'	=>array(),
								'options'	=>array(
												array(
													'label'=>'Enable',
													'value'=>'box-shadow:-5px 2px 32px 0 rgba(61,69,74,.12);z-index: 10;position: relative;', 
												),
											),
								'content_type'=>'css',
	 							'output_format'=>'%default%'
							),
							array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Set Margin',
								'tab'		=>'container_css',
								'default'	=>
					                            array(
					                                'top'=>'0px',
					                                'right'=>'auto',
					                                'bottom'=>'0px',
					                                'left'=>'auto',
					                            ),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Set Padding',
								'tab'		=>'container_css',
								'default'	=>array(
													'top'=>'20px',
													'right'=>'0px',
													'bottom'=>'20px',
													'left'=>'0px'
												),
								'content_type'=>'css',
								'output_format'=>"padding: %left% %right% %top% %bottom%"
							),
							array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_brdr",
                                'label'     => 'Border',
                                'tab'       =>'container_css',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'css',
                            ),
							array(
								'type'		=>'spacing',
								'name'		=>"border_sz",
								'label'		=>'Border width',
								'tab'		=>'container_css',
								'default'	=>array(
													'top'=>'0px',
													'right'=>'0px',
													'bottom'=>'0px',
													'left'=>'0px'
												),
								'required'  => array('check_for_brdr'=>1),
								'content_type'=>'css',
							),
							array(
								'type'		=>'color-picker',
								'name'		=>"border_clr_pkr",
								'label'		=>'Border Color',
								'tab'		=>'container_css',
								'default'	=>'#ccc',
								'required'  => array('check_for_brdr'=>1),
								'content_type'=>'css',
								
							),
							array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_pdng",
                                'label'     => 'Responsive Padding',
                                'tab'       =>'container_css',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'css',
                            ),
                            array(
								'type'		=>'spacing',
								'name'		=>"res_pdng",
								'label'		=>'Set Padding',
								'tab'		=>'container_css',
								'default'	=>array(
													'top'=>'0px',
													'right'=>'0px',
													'bottom'=>'0px',
													'left'=>'0px'
												),
								'content_type'=>'css',
								'required'  => array('check_for_pdng'=>1),
								
							),
							array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_mrgn",
                                'label'     => 'Responsive Margin',
                                'tab'       =>'container_css',
                                'default'   =>0,
                                'options'   =>array(
                                                array(
                                                    'label'=>'Yes',
                                                    'value'=>1,
                                                )
                                            ),
                                'content_type'=>'css',
                            ),
                            array(
								'type'		=>'spacing',
								'name'		=>"res_mrgn",
								'label'		=>'Set Margin',
								'tab'		=>'container_css',
								'default'	=>
				                            array(
				                                'top'=>'0px',
				                                'right'=>'auto',
				                                'bottom'=>'0px',
				                                'left'=>'auto',
				                            ),
								'content_type'=>'css',
								'required'  => array('check_for_mrgn'=>1),
							),
						),
			'front_template_start'=>$output,
			'front_template_end'=>$outputEnd,
			'front_css'=>$front_css,
			'front_common_css' => $front_common_css,
			);
