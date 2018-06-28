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
<div class="amp-sld3">
	<div class="amp-gallery">
		<amp-carousel class="howSectionImageInPhone" id="how-carousel" width="1024" height="682"
            layout="responsive" type="slides" loop [slide]="howSectionSelected.howSlide" on="slideChange:AMP.setState({howSectionSelected: {howSlide: event.index}})">
		{{repeater_image}}
		</amp-carousel>
		<p class="dots">
			<span on="tap:AMP.setState({howSectionSelected: {howSlide: howSectionSelected.howSlide == 0 ? {{repeater_max_count}} : howSectionSelected.howSlide - 1}})" role="button" tabindex="0">
			</span>
			{{repeater_bullet}}
			<span on="tap:AMP.setState({howSectionSelected: {howSlide: howSectionSelected.howSlide == {{repeater_max_count}} ? 0 : howSectionSelected.howSlide + 1}})" role="button" tabindex="0">
			</span>
		</p>
	</div>
	<div class="amp-g-cnt">
		{{repeater_ampcontent}}
	</div>
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
.amp-sld3{
	width: 100%;
    display: inline-block;
    margin: 0 auto;
    text-align: center;
}
.amp-gallery{
	width: 500px;
    text-align: center;
    display: inline-block;
    vertical-align: middle;
}
.amp-g-cnt{
	width: 500px;
    display: inline-block;
    text-align: left;
    margin-left: 100px;
    vertical-align: middle;
}
.dots{margin-top:30px;}
.amp-g-cnt .how-current{display: inline-block;}
.amp-g-cnt .how-current h1{color:{{hdng__active_color}};}
.amp-g-cnt h1, .amp-g-cnt p{cursor: pointer;display: inline-block;}
.amp-g-cnt h1{
	font-size:{{text-size}};
	font-weight:{{fnt_wght}};
	line-height:1.4;
	color:{{hdng_color_picker}};
}
.amp-cnt{
	margin-bottom:30px;
}
.amp-desc{
	display:block;
	color:{{cnt_color_picker}};
	font-size:{{cnt-size}};
	font-weight:{{cnt_fnt_wght}};
}
.dots span{display:inline-block;background:#999;border-radius:6px;width:10px;height:10px;margin-bottom:4px;margin-left:10px;margin-right:10px;z-index:10;vertical-align:middle;cursor: pointer;}
.dots span.how-current{background:{{hdng__active_color}};width:12px;height:12px;margin-bottom:4px;margin-left:10px;margin-right:10px}
.dots span:last-child{width:34px;height:34px;border-radius:34px;background-color:{{hdng__active_color}};}
.dots span:first-child{width:34px;height:34px;border-radius:34px;background-color:{{hdng__active_color}};
	background-position:50% 50%;background-repeat:no-repeat;}
.dots span:last-child:before{
	content: ">";
    display: inline-block;
    color: #fff;
    position: relative;
    top: -1px;
    font-weight: 500;
    font-size: 22px;
}
.dots span:first-child:before{
	content: "<";
    display: inline-block;
    color: #fff;
    position: relative;
    top: -1px;
    font-weight: 500;
    font-size: 22px;
}
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
								'type'		=>'text',
								'name'		=>"text-size",
								'label'		=>'Heading Font Size',
								'tab'		=>'design',
								'default'	=>'20px',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'3'),
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
	 							'required'  => array('carousel_layout_type'=>'3'),
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"hdng_color_picker",
								'label'		=>'Heading Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'3'),
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"hdng__active_color",
								'label'		=>'Heading Active Color / Dots Color',
								'tab'		=>'design',
								'default'	=>'#ee476f',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'3'),
							),
						array(
								'type'		=>'text',
								'name'		=>"cnt-size",
								'label'		=>'Content Font Size',
								'tab'		=>'design',
								'default'	=>'16px',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'3'),
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'cnt_fnt_wght',		
	 							'label' =>"Content Font Weight",
								'tab'     =>'design',
	 							'default' =>'300',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
	 							'required'  => array('carousel_layout_type'=>'3'),
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"cnt_color_picker",
								'label'		=>'Content Color',
								'tab'		=>'design',
								'default'	=>'#f1f1f1',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'3'),
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
		           				'required'  => array(array('carousel_layout_type'=>'1', '2', '3') ),
	 						),
							array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Heading',	
		           				'content_type'=>'html',
		           				'required'  => array('carousel_layout_type'=>'3'),
	 						),
	 						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				'tab'       =>'customizer',
		 						'default'	=>'Description',	
		           				'content_type'=>'html',
		           				'required'  => array('carousel_layout_type'=>'3'),
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
			      "bullet"=> '<span class="{{if_condition_repeater_unique==0}}how-current{{ifend_condition_repeater_unique_0}}" [class]="howSectionSelected.howSlide == {{repeater_unique}} ? \'how-current\' : \'\'" on="tap:AMP.setState({howSectionSelected: {howSlide: {{repeater_unique}}}})" role="button" tabindex="{{repeater_unique}}">
			      </span>',
			      "ampcontent"=> '<div class="{{if_condition_repeater_unique==0}}how-current{{ifend_condition_repeater_unique_0}} amp-cnt" [class]="howSectionSelected.howSlide == {{repeater_unique}} ? \'how-current\' : \'\'" on="tap:AMP.setState({howSectionSelected: {howSlide: {{repeater_unique}}}})" role="button" tabindex="{{repeater_unique}}">
			      		<h1>{{content_title}}</h1>
			      		<div class="amp-desc">{{content}}</div>
			      </div>'
			      	
	          		)
	        	
	          ),
	);
?>