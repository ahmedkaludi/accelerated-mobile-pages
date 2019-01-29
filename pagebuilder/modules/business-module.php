<?php 
$output = '
<div {{if_id}}id="{{id}}"{{ifend_id}} class="bs-md {{user_class}}">
	<div class="map blk">
		<a href="{{map_lnk}}">
			<span class="ico-pic icon-{{map_icon}}"></span>
			<h3 class="bs-tlt">{{map_tlt}}</h3>
			<span class="bs-subhdng">{{map_cnt}}</span>
		</a>
	</div>
	<div class="email blk">
		<a href="mailto:{{mail_id}}">
			<span class="ico-pic icon-{{mail_icon}}"></span>
			<h3 class="bs-tlt">{{mail_tlt}}</h3>
			<span class="bs-subhdng">{{mail_id}}</span>
		</a>
	</div>
	<div class="contact blk">
		<a href="tel:{{cnt_nmbr}}">
			<span class="ico-pic icon-{{contact_icon}}"></span>
			<h3 class="bs-tlt">{{cnt_tlt}}</h3>
			<span class="bs-subhdng">{{cnt_nmbr}}</span>
		</a>
	</div>
</div>';
$css = '
{{module-class}} .bs-md{
	display: inline-flex;
    width: 100%;
    flex-wrap: wrap;
    text-align:{{align_type}};
}
{{module-class}} .blk{
	margin-left: 0;
    display: flex;
    flex-direction: column;
    position: relative;
    flex: 1 0 22%;
    margin: 0 15px 30px;
    line-height: 1.5;
}
{{module-class}} .ico-pic{
	font-size:{{ic-size}};
	color:{{ic_color_picker}};
	margin:{{ic_margin_gap}};
	display:inline-block;
}
{{module-class}} .bs-tlt{
	font-size:{{hdng_txt_size}};
	font-weight:{{hdng_fnt_wght}};
	line-height:1.4;
	color:{{hdng_color}};
}
{{module-class}} .bs-subhdng{
	font-size:{{subh_txt_sze}};
	font-weight:{{subh_fnt_wght}};
	line-height:1.4;
	color:{{subhdng_color}};
}
';
global $redux_builder_amp;
if(ampforwp_get_setting('amp-rtl-select-option')){
	$css .= '/** RTL CSS **/

	';
}
//$commonCss = '';
return array(
		'label' =>'Business',
		'name' =>'business',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'advanced' => 'Advanced',
            ),
		'fields' => array(
						array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_map",
                                'label'     => 'Map',
                                'tab'       =>'customizer',
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
		 						'type'		=>'icon-selector',		
		 						'name'		=>"map_icon",		
		 						'label'		=>'Map Icon',
		           				'tab'       =>'customizer',
		 						'default'	=>'check_circle',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_map'=>'1'),
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"map_tlt",		
		 						'label'		=>'Map Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Address',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_map'=>'1'),
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"map_cnt",		
		 						'label'		=>'Map Sub Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Location',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_map'=>'1'),
	 					),
	 					array(		
		 						'type'		=>'text',		
		 						'name'		=>"map_lnk",		
		 						'label'		=>'Map Link',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_map'=>'1'),
	 					),
	 					array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_mail",
                                'label'     => 'E mail',
                                'tab'       =>'customizer',
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
		 						'type'		=>'icon-selector',		
		 						'name'		=>"mail_icon",		
		 						'label'		=>'Mail Icon',
		           				'tab'       =>'customizer',
		 						'default'	=>'check_circle',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_mail'=>'1'),
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"mail_tlt",		
		 						'label'		=>'Mail Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'General inquiries',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_mail'=>'1'),
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"mail_id",		
		 						'label'		=>'Mail Sub Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'xyz@gmail.com',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_mail'=>'1'),
	 					),
	 					array(
                                'type'      =>'checkbox_bool',
                                'name'      =>"check_for_contact",
                                'label'     => 'Contact',
                                'tab'       =>'customizer',
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
		 						'type'		=>'icon-selector',		
		 						'name'		=>"contact_icon",		
		 						'label'		=>'Contact Icon',
		           				'tab'       =>'customizer',
		 						'default'	=>'check_circle',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_contact'=>'1'),
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"cnt_tlt",		
		 						'label'		=>'Contact Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Call us Today!',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_contact'=>'1'),
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"cnt_nmbr",		
		 						'label'		=>'Contact Sub Heading',
		           				 'tab'     =>'customizer',
		 						'default'	=>'+91 123456',	
		           				'content_type'=>'html',
		           				'required'  => array('check_for_contact'=>'1'),
	 					),
						array(
								'type'		=>'text',
								'name'		=>"ic-size",
								'label'		=>'Icon Size',
								'tab'		=>'design',
								'default'	=>'40px',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"ic_color_picker",
								'label'		=>'Icon Color',
								'tab'		=>'design',
								'default'	=>'#12a7d7',
								'content_type'=>'css'
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
					                                'bottom'=>'10px',
					                                'left'=>'0px',
					                            ),
								'content_type'=>'css',
							),
						array(
								'type'		=>'text',
								'name'		=>"hdng_txt_size",
								'label'		=>'Heading Font Size',
								'tab'		=>'design',
								'default'	=>'14px',
								'content_type'=>'css'
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'hdng_fnt_wght',		
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
								'default'	=>'#222222',
								'content_type'=>'css'
							),
						array(
								'type'		=>'text',
								'name'		=>"subh_txt_sze",
								'label'		=>'Sub Heading Font Size',
								'tab'		=>'design',
								'default'	=>'16px',
								'content_type'=>'css'
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'subh_fnt_wght',		
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
								'name'		=>"subhdng_color",
								'label'		=>'Sub Heading Color',
								'tab'		=>'design',
								'default'	=>'#555',
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
		
	);

?>