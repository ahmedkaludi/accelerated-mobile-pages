<?php 
$output = '
<div class="srvs">
	<h2><a href="{{srvs_url}}">{{srvs_title}}</a></h2>
	<span class="s-hdng">{{srvs_subhdng}}</span>
	<div class="lst">
		{{repeater}}
	</div>
	<div class="srvs-btn">
		<a href="{{srvs_btn_url}}">
			<span class="btn-txt">{{srvs_btn}}</span>
			<span class="ico-pic icon-{{icon-picker}}"></span>
		</a>
	</div>
</div>
';
$css = '
{{module-class}}.service{
	margin:{{margin_css}};
	padding:{{padding_css}};
}
{{module-class}} .srvs h2{
	font-size:{{hdng_size}};
	line-height:1.4;
	color:#333;
	font-weight:{{hdng_font_type}};
	margin-bottom:15px;
}
{{module-class}} .srvs h2 a{
	color:{{hdng_color}};
}
{{module-class}} .s-hdng{
	font-size:{{sb_hd_size}};
	line-height:1.4;
	color:{{sb_hdng_color}};
	font-weight:{{sb_hdng_font_type}};
}
{{module-class}} .lst{
	font-size:{{lst_size}};
	line-height:1.4;
	color:{{lst_color}};
	font-weight:{{lst_font_type}};
	margin-top: 20px;
}
{{module-class}} .lst li{
	list-style-type:none;
	margin-bottom: 10px;
}
{{module-class}} .srvs-btn{
	font-size: {{btn_size}};
    text-align: right;
    line-height:1.2;
    font-weight:{{btn_font_type}};
    margin-top: 30px;
    width: 100%;
    display: inline-block;
}
{{module-class}} .srvs-btn a{
	color:{{btn_color}};
}
{{module-class}} .ico-pic{
	font-size:{{ico-size}};
	color:{{ico_color}};
	margin:{{icon_gapping}};
}
';
return array(
		'label' =>'Services',
		'name' =>'service',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"srvs_title",		
		 						'label'		=>'Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Services Title',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"srvs_url",		
		 						'label'		=>'Heading URL',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"srvs_subhdng",		
		 						'label'		=>'Sub Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Sub Heading',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"srvs_btn",		
		 						'label'		=>'Button',
		           				'tab'     =>'customizer',
		 						'default'	=>'Learn More',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"srvs_btn_url",		
		 						'label'		=>'Button URL',
		           				'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'icon-selector',		
		 						'name'		=>"icon-picker",		
		 						'label'		=>'Button Icon',
		           				'tab'       =>'customizer',
		 						'default'	=>'check_circle',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"hdng_size",		
		 						'label'		=>'Heading Size',
		           				 'tab'     =>'design',
		 						'default'	=>'30px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'hdng_font_type',		
	 							'label' =>"Heading Font Weight",
								'tab'     =>'design',
	 							'default' =>'600',
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
								'name'		=>"hdng_color",
								'label'		=>'Heading Color',
								'tab'		=>'design',
								'default'	=>'#243952',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"sb_hd_size",		
		 						'label'		=>'Sub Heading Size',
		           				 'tab'     =>'design',
		 						'default'	=>'24px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'sb_hdng_font_type',		
	 							'label' =>"Sub Heading Font Weight",
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
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"sb_hdng_color",
								'label'		=>'Sub Heading Color',
								'tab'		=>'design',
								'default'	=>'#243952',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"lst_size",		
		 						'label'		=>'List Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'20px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'lst_font_type',		
	 							'label' =>"List Font Weight",
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
								'name'		=>"lst_color",
								'label'		=>'List Color',
								'tab'		=>'design',
								'default'	=>'#b6b6b6',
								'content_type'=>'css',
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_size",		
		 						'label'		=>'Button Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'24px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'btn_font_type',		
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
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"btn_color",
								'label'		=>'Button Color',
								'tab'		=>'design',
								'default'	=>'#50c867',
								'content_type'=>'css',
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"ico-size",		
		 						'label'		=>'Icon Size',
		           				 'tab'     =>'design',
		 						'default'	=>'24px',	
		           				'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"ico_color",
								'label'		=>'Icon Color',
								'tab'		=>'design',
								'default'	=>'#50c867',
								'content_type'=>'css'
							),
						array(
								'type'		=>'spacing',
								'name'		=>"icon_gapping",
								'label'		=>'Icon Gapping',
								'tab'		=>'design',
								'default'	=>
                            array(
                                'top'=>'0px',
                                'right'=>'0px',
                                'bottom'=>'0px',
                                'left'=>'0px',
                            ),
								'content_type'=>'css',
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
        	'<li class="li-txt">{{list_title}}</li>
			'
          ),
	);

?>