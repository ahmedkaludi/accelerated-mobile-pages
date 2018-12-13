<?php 
$output = '
	{{repeater}}
';
$css = '
{{module-class}}.list-mod{display:flex;flex-wrap: wrap;margin:{{margin_css}};max-width:{{lst-mod-wdth}};}
{{module-class}}.list-mod .li-mod .ico-pic{font-size:{{ico-size}};display:inline-block;color:{{ico_color_picker}};padding-right: 10px;position: relative;top: 2px;}
{{module-class}}.list-mod .li-txt{font-size:{{text-size}};line-height:1.5;color:{{text_color_picker}};}
{{module-class}}.li-mod{margin-bottom:15px;}

{{module-class}} .li-mod{
	margin: 0 15px 30px;
    {{if_condition_dsgn_clmns==1_col}} 
    	flex: 1 0 100%; 
    {{ifend_condition_dsgn_clmns_1_col}};
    {{if_condition_dsgn_clmns==2_col}} 
    	flex: 1 0 40%; 
    {{ifend_condition_dsgn_clmns_2_col}};
    {{if_condition_dsgn_clmns==3_col}} 
    	flex: 1 0 30%; 
    {{ifend_condition_dsgn_clmns_3_col}};
}
@media(max-width:768px){
	{{module-class}}.list-mod{
		max-width:100%;
	}
}
@media(max-width:425px){
	{{module-class}} .li-mod{
		flex: 1 0 100%;
		margin-bottom: 15px;
	}
}
';
return array(
		'label' =>'Lists',
		'name' =>'list-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
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
		 						'name'		=>"ico-size",		
		 						'label'		=>'Icon Size',
		           				 'tab'     =>'design',
		 						'default'	=>'23px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"ico_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"text-size",		
		 						'label'		=>'Text Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'22px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"text_color_picker",
								'label'		=>'Text Font Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"lst-mod-wdth",		
		 						'label'		=>'Max Width',
		           				 'tab'     =>'design',
		 						'default'	=>'100%',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'dsgn_clmns',		
	 							'label' =>"DIfferent Designs by Columns",
								'tab'     =>'design',
	 							'default' =>'1_col',
	 							'options_details'=>array(
	 												'1_col'    =>'1 Columns',
	 												'2_col'    =>'2 Columns',
	 												'3_col'    =>'3 Columns', 													),
	 							'content_type'=>'css',
	 							'required'  => array('blurb_layout_type'=>'1'),
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
		 						'name'		=>"list_title",		
		 						'label'		=>'List Title',
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
						
                
              ),
          'front_template'=>
        	'<div {{if_id}}id="{{id}}"{{ifend_id}} class="li-mod">
        		<span class="ico-pic icon-{{icon-picker}}"></span>
				<span class="li-txt">{{list_title}}</span>
			</div>'
          ),
	);

?>