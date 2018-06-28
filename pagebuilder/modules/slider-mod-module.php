<?php 
$output = '
{{if_condition_carousel_layout_type==1}}
	<amp-carousel width="400" height="300" layout="responsive" type="slides" autoplay delay="{{delay}}">
		{{repeater_image}}
	</amp-carousel>
{{ifend_condition_carousel_layout_type_1}}
{{if_condition_carousel_layout_type==2}}
	<amp-carousel id="carousel-with-preview-{{unique_cell_id}}" width="400" height="300" layout="responsive" type="slides">
		{{repeater_image}}
	</amp-carousel>
	<div class="slid-prv">
		{{repeater_button}}
	</div>
{{ifend_condition_carousel_layout_type_2}}
{{if_condition_carousel_layout_type==3}}
	<div class="amp-gallery">
		<amp-carousel class="howSectionImageInPhone" id="how-carousel" width="1024" height="682"
            layout="responsive" type="slides" loop [slide]="howSectionSelected.howSlide" on="slideChange:AMP.setState({howSectionSelected: {howSlide: event.index}})">
		{{repeater_image}}
		</amp-carousel>
		<p class="dots how-dots l-mobile">
			<span on="tap:AMP.setState({howSectionSelected: {howSlide: howSectionSelected.howSlide == 0 ? 4 : howSectionSelected.howSlide - 1}})" role="button" tabindex="0">
			</span>
			{{repeater_bullet}}
			<span on="tap:AMP.setState({howSectionSelected: {howSlide: howSectionSelected.howSlide == 4 ? 0 : howSectionSelected.howSlide + 1}})" role="button" tabindex="0">
			</span>
		</p>
	</div>
{{ifend_condition_carousel_layout_type_3}}

';
$css = '
{{if_condition_carousel_layout_type==1}}
.amp-img{
	width:100%;
	height:auto;
	max-width:100%;
}
{{module-class}}{text-align:{{align_type}};margin:{{margin_css}};padding:{{padding_css}};width:{{width}}}
{{ifend_condition_carousel_layout_type_1}}
{{if_condition_carousel_layout_type==2}}
.slid-prv button{
	height: 90px;
    width: 90px;
    margin: 0 9px 0 0px;
    padding: 0;
}
.slid-prv amp-img{
	width:100%;
	height:100%;
}
{{ifend_condition_carousel_layout_type_2}}
{{if_condition_carousel_layout_type==3}}
.amp-gallery{
	width: 500px;
    text-align: center;
}
.dots{wisth:100%;margin-top:30px;}
.dots span{display:inline-block;background:#666;border-radius:6px;width:10px;height:10px;margin-bottom:4px;margin-left:10px;margin-right:10px;z-index:10;vertical-align:middle;cursor: pointer;}
.dots span.how-current{background:#ee476f;width:12px;height:12px;margin-bottom:4px;margin-left:10px;margin-right:10px}
.dots span:last-child{width:34px;height:34px;border-radius:34px;background-color:#000;}
.dots span:first-child{width:34px;height:34px;border-radius:34px;background-color:#000;
	background-position:50% 50%;background-repeat:no-repeat;}
{{ifend_condition_carousel_layout_type_3}}
';

return array(
		'label' =>'Slider',
		'name' =>'slider-mod',
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
				            'name'    =>"carousel_layout_type",
				            'label'   =>"Select Layout",
				            'tab'     =>'layout',
				            'default' =>'1',    
				            'options_details'=>array(
				                            array(
				                              'value'=>'1',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/slider-1.png'
				                            ),
				                            array(
				                              'value'=>'2',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/slider-2.png'
				                            ),
				                            array(
				                              'value'=>'3',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/slider-1.png'
				                            ),
				                          ),
				            'content_type'=>'html',
				            ),
                        array(		
	 						'type'		=>'text',		
	 						'name'		=>"width",		
	 						'label'		=>'Image Size',
	           				 'tab'      =>'customizer',
	 						'default'	=>'90%',	
	           				'content_type'=>'css',
 						),
 						array(		
	 						'type'		=>'text',		
	 						'name'		=>"delay",		
	 						'label'		=>'Slider Delay',
	           				 'tab'      =>'customizer',
	 						'default'	=>'2000',	
	           				'content_type'=>'html',
 						),
				        array(
								'type'		=>'checkbox',
								'name'		=>"image_layout",
								'tab'		=>'customizer',
								'default'	=>array('responsive'),
								'options'	=>array(
												array(
													'label'=>'Responsive',
													'value'=>'responsive',
												),
											),
								'content_type'=>'html',
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
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'auto',
                                'bottom'=>'20px',
                                'left'=>'auto',
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
							array(		
	 						'type'		=>'require_script',		
	 						'name'		=>"carousel_script",		
	 						'label'		=>'amp-carousel',
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-carousel-0.1.js',	
	           				'content_type'=>'js',
 						),

			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
		'repeater'=>array(
	          'tab'=>'customizer',
	          'fields'=>array(
			                array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Upload',
		           				'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
							
	                
	              ),
	          'front_template'=>
	          		array(
	          			"image"=>'
								{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}} alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
							',
						"button"=>'<button on="tap:carousel-with-preview-{{unique_cell_id}}.goToSlide(index={{repeater_unique}})">
			        {{if_img_upload}}<amp-img src="{{img_upload-thumbnail}}" width="150" height="150" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}} alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
			      </button>',
			      "bullet"=> '<span class="{{if_condition_repeater_unique==0}}how-current{{ifend_condition_repeater_unique_0}}" [class]="howSectionSelected.howSlide == {{repeater_unique}} ? \'how-current\' : \'\'" on="tap:AMP.setState({howSectionSelected: {howSlide: {{repeater_unique}}}})" role="button" tabindex="{{repeater_unique}}"></span>'
			      	
	          		)
	        	
	          ),
	);
?>