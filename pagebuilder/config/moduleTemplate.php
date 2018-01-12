<?php
$moduleTemplate = array();
$dir = AMP_PAGE_BUILDER.'/modules/';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
        	if(is_file($dir.$file)){
        		$moduleTemplate[str_replace(".php", "", $file)] = include $dir.$file;
        	}
        }
        closedir($dh);
        $moduleTemplate = array_filter($moduleTemplate);
    }
}

$layoutTemplate = array();
$dir = AMP_PAGE_BUILDER.'/layouts/';
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {

        while (($file = readdir($dh)) !== false) {
        	if(is_file($dir.$file)){
        		$layoutTemplate[str_replace(".php", "", $file)] = include $dir.$file;
        	}
        }
        closedir($dh);
        $layoutTemplate = array_filter($layoutTemplate);
    }
}


//Row Contents
$output = '<section class="amp_pb_module {{row_class}} {{grid_type}}">';
$outputEnd = '<div class="cb"></div> </section>';
$front_css = '
{{row-class}}{
	color: {{font_color_picker}};
	background-color: {{color_picker}};
	{{selected_gradient}};
	margin: {{margin_css}};
	padding:{{padding_css}};
	border: {{border_css}};
	border-style:{{border_type}};
	{{shadow}}
}
';
$containerCommonSettings = array(
			'label'	=> 'Row Settings',
			'settingType'  =>'row',
			'default_tab'=> 'customizer',
			'tabs' => array(
			  'customizer'=>'Basic',
			  'container_css'=>'Advance',
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
	 												'gradient'=>'Gradient'
	 													),
	 							'content_type'=>'css',
	 							'output_format'=>''
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

							array(
								'type'		=>'checkbox',
								'name'		=>"want_border",
								'label'		=>'Border',
								'tab'		=>'customizer',
								'default'	=>array(0),
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
								'output_format'=>"bodrer: %left%px %right%px %top%px %bottom%px",
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
	 						),
							array(
								'type'		=>'checkbox',
								'name'		=>"shadow",
								'label'		=>'Shadow',
								'tab'		=>'customizer',
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
								'tab'		=>'customizer',
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
								'tab'		=>'customizer',
								'default'	=>array(
													'top'=>'20px',
													'right'=>'0px',
													'bottom'=>'20px',
													'left'=>'0px'
												),
								'content_type'=>'css',
								'output_format'=>"padding: %left% %right% %top% %bottom%"
							),
						),
			'front_template_start'=>$output,
			'front_template_end'=>$outputEnd,
			'front_css'=>$front_css,
			);
