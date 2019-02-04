<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
<div {{if_id}}id="{{id}}"{{ifend_id}} class="ln-fx {{user_class}}">{{repeater}}</div>';
$css = '
.icons-mod{margin:{{margin_css}};padding:{{padding_css}};}
.ln-fx{width:100%;display:inline-flex;}
.ico-mod{display: flex;flex-direction: column;justify-content: space-between;margin: 0 auto;text-align: center;}
.ico-mod .ico-pic{font-size:40px;display:inline-block;color:{{ico_color_picker}};background: {{bg_color_picker}};border-radius:{{border-size}};padding: 20px;}
';
return array(
		'label' =>'Icons',
		'name' =>'icons-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"border-size",		
		 						'label'		=>'Border Radius',
		           				 'tab'     =>'design',
		 						'default'	=>'60px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"bg_color_picker",
								'label'		=>'Icon Background color',
								'tab'		=>'design',
								'default'	=>'#2cbf55',
								'content_type'=>'css',
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"ico_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'design',
								'default'	=>'#ffffff',
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
		 						'type'		=>'icon-selector',		
		 						'name'		=>"icon-picker",		
		 						'label'		=>'Icons',
		           				'tab'       =>'customizer',
		 						'default'	=>'check_circle',	
		           				'content_type'=>'html',
	 						),
                
              ),
          'front_template'=>
        '<div class="ico-mod">
          <span class="ico-pic icon-{{icon-picker}}"></span>
        </div> '
          ),

	);

?>