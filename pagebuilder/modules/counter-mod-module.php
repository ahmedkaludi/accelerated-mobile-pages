<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
<div {{if_id}}id="{{id}}"{{ifend_id}} class="ln-fx {{user_class}}">{{repeater}}</div>';
$css = '
{{module-class}}.counter-mod{
	margin:{{margin_css}};
	padding:{{padding_css}};
}
{{module-class}} .ln-fx{
	width: 100%;
    display: inline-flex;
     flex-wrap: wrap;
}
{{module-class}} .count-mod{
	display: flex;
	flex-direction: column;
	position: relative;
	flex: 1 0 18%;
	margin:0 30px;
	text-align: {{align_type}};
}
.count-mod h5{
	font-size:{{number-size}};
	color:{{number_color_picker}};
	font-weight:{{font_type}};
}
.count-mod p{
	color:{{text_color_picker}};
	font-size:{{text-size}};
	font-weight:{{font_type}};
}
@media(max-width:768px){
{{module-class}} .count-mod{
	margin: 0px 30px 30px 30px;
}
}
';
global $redux_builder_amp;
if(ampforwp_get_setting('amp-rtl-select-option')){
$css .= '/** RTL CSS **/

';
}
return array(
		'label' =>'Counter',
		'name' =>'counter-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(
								'type'		=>'text',
								'name'		=>"number-size",
								'label'		=>'Number Font Size',
								'tab'		=>'design',
								'default'	=>'70px',
								'content_type'=>'css'
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'font_type',		
	 							'label' =>"Number Font Weight",
								'tab'     =>'design',
	 							'default' =>'700',
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
								'type'		=>'text',
								'name'		=>"text-size",
								'label'		=>'Font Size',
								'tab'		=>'design',
								'default'	=>'16px',
								'content_type'=>'css'
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'font_type',		
	 							'label' =>"Desc Font Weight",
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
								'type'		=>'color-picker',
								'name'		=>"number_color_picker",
								'label'		=>'Number Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"text_color_picker",
								'label'		=>'Text Color',
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
		 						'default'	=>'00',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				'tab'       =>'customizer',
		 						'default'	=>'Description',	
		           				'content_type'=>'html',
	 						),
              		),
          'front_template'=>
	        '<div class="count-mod">
				<h5>{{content_title}}</h5>
				<span>{{content}}</span>
			</div>'
          ),
	);

?>