<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = 
'<amp-accordion {{if_id}}id="{{id}}"{{ifend_id}} {{if_user_class}}class="{{user_class}}{{ifend_user_class}}">{{repeater}}</amp-accordion>';
$css = '
{{module-class}}.accordion-mod{margin:{{margin_css}};padding:{{padding_css}};}
amp-accordion section[expanded] .show-more {display: none;}
amp-accordion section:not([expanded]) .show-less {display: none;}
{{module-class}}.accordion-mod .acc-lbl{background: none;border: 0;padding: 0;margin:10px 0px 15px 0;color: {{acc_color_picker}};font-size: 22px;line-height: 1.5em;font-weight: normal;    }
{{module-class}}.accordion-mod .acc-desc{margin-bottom:0;margin:-5px 0px 20px 23px;padding: 0;color:#666;font-size: 14px;line-height: 1.5em;}';
$front_css = '.accordion-mod {{acc_head_type}}:before{content: "+";font-size: 24px;color: #999;margin-right: 10px;position: relative;top: 1px;}
.accordion-mod {{acc_head_type}}:hover{color:#000;}
.accordion-mod section[expanded] {{acc_head_type}}:before{content:"-"}
.accordion-mod h5:before{content: "+";font-size: 24px;color: #999;margin-right: 10px;position: relative;top: 1px;}
.accordion-mod section[expanded] h5:before{content:"-"}
.apac:before,.apac section[expanded]:before{display:none;}';
return array(
		'label' =>'Accordion',
		'name' =>'accordion-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(
								'type'		=>'color-picker',
								'name'		=>"acc_color_picker",
								'label'		=>'Color',
								'tab'		=>'design',
								'default'	=>'#555555',
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
		 						'type'		=>'require_script',		
		 						'name'		=>"accordion_script",		
		 						'label'		=>'amp-accordion',
		 						'default'	=>'https://cdn.ampproject.org/v0/amp-accordion-0.1.js',
		 						'content_type'=>'js',
	 						),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'0',
													'right'=>'0',
													'top'=>'0',
													'bottom'=>'0'
												),
								'content_type'=>'css',
							),

			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
		'repeater'=>array(
          'tab'=>'customizer',
          'front_css'=> $front_css,
          'fields'=>array(
		                array(		
		 						'type'		=>'text',		
		 						'name'		=>"acc_title",		
		 						'label'		=>'Text',
		           				'tab'       =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
	 						),
		                array(		
	 							'type'	=>'select',		
	 							'name'  =>'acc_head_type',		
	 							'label' =>"Header Type",
								'tab'     =>'customizer',
	 							'default' =>'h5',
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
		 						'type'		=>'textarea',		
		 						'name'		=>"ass_desc",		
		 						'label'		=>'Description',
		           				'tab'       =>'customizer',
		 						'default'	=>'Description',	
		           				'content_type'=>'html',
	 						),  
	 					 array(		
		 						'type'		=>'checkbox_bool',		
		 						'name'		=>'open_accordion',		
		 						'label'		=>'Open By Default',
		           				'tab'     =>'customizer',
		 						'default'	=>0,	
		 						'options'	=>array(
												array(
													'label'=>'Yes',
													'value'=>1,
												)
											),
		           				'content_type'=>'html',
	 						),   	              
              ),
          'front_template'=>
        	'<section {{if_condition_open_accordion==1}}
				expanded{{ifend_condition_open_accordion_1}}>
			   <{{acc_head_type}} class="acc-lbl">{{acc_title}}</{{acc_head_type}}>
			    <div class="acc-desc">{{ass_desc}}</div>
			</section>'
          ),
	);



?>