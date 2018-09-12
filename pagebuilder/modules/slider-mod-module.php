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
	</div>
	<div class="amp-g-cnt">
		{{repeater_ampcontent}}
	</div>
	<p class="dots">
		<span on="tap:AMP.setState({howSectionSelected: {howSlide: howSectionSelected.howSlide == 0 ? {{repeater_max_count}} : howSectionSelected.howSlide - 1}})" role="button" tabindex="0">
		</span>
		{{repeater_bullet}}
		<span on="tap:AMP.setState({howSectionSelected: {howSlide: howSectionSelected.howSlide == {{repeater_max_count}} ? 0 : howSectionSelected.howSlide + 1}})" role="button" tabindex="0">
		</span>
	</p>
</div>
{{ifend_condition_carousel_layout_type_3}}
{{if_condition_carousel_layout_type==4}}
	<div class="amp-sld4">
		<amp-carousel id="card-carousel" height="300" type="carousel"  >
			{{repeater_testimonilas}}
		</amp-carousel>
	</div>
	
{{ifend_condition_carousel_layout_type_4}}

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
    display: grid;
    grid-template-columns: 500px 500px;
    margin: 0 auto;
    text-align: center;
    justify-content: center;
     grid-template-areas: 
                       "slider content"
                       "dots content"
                       
}
.amp-gallery{
    text-align: center;
    grid-area: slider;
}
.amp-g-cnt{
    text-align: left;
    margin-left: 100px;
    vertical-align: middle;
    grid-area: content;
}
.dots{margin-top:30px;grid-area: dots;}
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
@media(max-width:1000px){
	.amp-sld3 {
	    grid-template-columns: 360px 360px;
	}
}
@media(max-width:768px){
	.amp-sld3 {
		grid-template-columns: 100%;
		grid-template-areas: 
                       "slider slider"
                       "content content"
                       "dots dots"
     }
    .amp-g-cnt {
	    text-align: center;
	    margin: 40px 0px 0px 0px;
	}
	.amp-g-cnt {
	    overflow-x: auto;
	    overflow-y: hidden;
	    white-space: nowrap;
	}
	.amp-cnt{
	    display: inline-block;
	    margin:20px;
	}
	.amp-desc{
		white-space: pre-wrap;
	}
}
{{ifend_condition_carousel_layout_type_3}}
{{if_condition_carousel_layout_type==4}}
.card {
    width: 425px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 20px 50px 1px rgba(0,0,0,.1);
    margin: 40px;
    word-wrap: break-word;
    text-align:center;
}
.cardContent {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    padding:30px;
}
.tstmnl{
	font-size: {{cnt-size}};
    line-height: 1.5;
    font-weight: {{cnt_fnt_wgt}};
    color:{{cnt_color}};
    white-space: pre-wrap;
    margin-bottom:20px;
}
.cardContent .ath-info{
    display: flex;
    align-items: center;
    justify-content: center;
    color:{{athr_color}};
    font-size:{{athr-size}};
    font-weight:{{athr_fnt_wgt}};
}
.athr-nm{
	margin-left:10px;
}
.amp-sld4{
	width:100%;
	position: relative;
    padding: 30px 0px;
    display: inline-block;
}
.amp-sld4 .amp-carousel-button {
    top: auto;
    bottom: 0;
    border-radius: 50%;
    background: {{pn_color}};
    cursor: pointer;
}
.amp-sld4 .amp-carousel-button-next:after{
	content: ">";
    display: inline-block;
    color: #fff;
    position: absolute;
    top: -1px;
    font-weight: 500;
    font-size: 22px;
    right: 0px;
    left: 0;
    margin: 0 auto;
    text-align: center;
}
.amp-sld4 .amp-carousel-button-prev:before{
	content: "<";
    display: inline-block;
    color: #fff;
    position: absolute;
    top: -1px;
    font-weight: 500;
    font-size: 22px;
    right: 0px;
    left: 0;
    margin: 0 auto;
    text-align: center;
}
.amp-sld4 .amp-carousel-button-prev{
	left: 40%;
}
.amp-sld4 .amp-carousel-button-next{
	right:40%;
}
@media(max-width:767px){
	.card {
    	width: 100%;
    	margin: 40px 0px 40px 0px;
    }
    .amp-sld4 .amp-carousel-button-next {
	    right: 30%;
	}
	.amp-sld4 .amp-carousel-button-prev{
		left: 30%;
	}
}
{{ifend_condition_carousel_layout_type_4}}
';
if ( 1 == $redux_builder_amp['amp-design-selector'] || 2 == $redux_builder_amp['amp-design-selector'] || 3 == $redux_builder_amp['amp-design-selector'] ) {
		$css .='
			.dots span:last-child:before{
				content: "\25be";
				transform: rotate(270deg);
			    display: inline-block;
			    color: #fff;
			    position: relative;
			    top: 3px;
			    right: 0px;
			    font-weight: 500;
			    font-size: 22px;
			}
			.dots span:first-child:before{
				content: "\25be";
				transform: rotate(90deg);
			    display: inline-block;
			    color: #fff;
			    position: relative;
			    top: 3px;
			    right: 0px;
			    font-weight: 500;
			    font-size: 22px;
			} ';
} else { 
		$css .='
			.dots span:last-child:before{
				content: "\e313";
			    font-family: "icomoon";
			    transform: rotate(270deg);
			    display: inline-block;
			    color: #fff;
			    position: relative;
			    top: -1px;
			    left:1px;
			    font-weight: 500;
			    font-size: 22px;
			}
			.dots span:first-child:before{
				content: "\e313";
			    font-family: "icomoon";
			    transform: rotate(90deg);
			    display: inline-block;
			    color: #fff;
			    position: relative;
			    top: -1px;
			    right: 1px;
			    font-weight: 500;
			    font-size: 22px;
			}';
	}
return array(
		'label' =>'Gallery / Slider',
		'name' =>'slider-mod',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'layout' => 'Layout',
              'design'=>'Design',
              'advanced' => 'Advanced'
            ),
		'fields' => array(
						array(    
				            'type'    =>'layout-image-picker',
				            'name'    =>"carousel_layout_type",
				            'label'   =>"Select Layout",
				            'tab'     =>'layout',
				            'default' =>'3',    
				            'options_details'=>array(
				            				array(
				                              'value'=>'3',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/slider-3.png'
				                            ),
				                            array(
				                              'value'=>'4',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/slider-4.png'
				                            ),
				                            array(
				                              'value'=>'2',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/slider-2.png'
				                            ),
				                            array(
				                              'value'=>'1',
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
								'default'	=>'#333',
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
								'default'	=>'#333',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'3'),
							),
						array(
								'type'		=>'text',
								'name'		=>"cnt-size",
								'label'		=>'Testimonial Font Size',
								'tab'		=>'design',
								'default'	=>'15px',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'4'),
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'cnt_fnt_wgt',		
	 							'label' =>"Testimonial Font Weight",
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
	 							'required'  => array('carousel_layout_type'=>'4'),
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"cnt_color",
								'label'		=>'Testimonial Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'4'),
							),
						array(
								'type'		=>'text',
								'name'		=>"athr-size",
								'label'		=>'Author Font Size',
								'tab'		=>'design',
								'default'	=>'14px',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'4'),
							),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'athr_fnt_wgt',		
	 							'label' =>"Author Font Weight",
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
	 							'required'  => array('carousel_layout_type'=>'4'),
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"athr_color",
								'label'		=>'Author Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'4'),
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"pn_color",
								'label'		=>'Prev/Next Background Color',
								'tab'		=>'design',
								'default'	=>'#ee476f',
								'content_type'=>'css',
								'required'  => array('carousel_layout_type'=>'4'),
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
		           				'required'  => array('carousel_layout_type'=>array('1','2','3')),

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
	 						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"test_cntn",		
		 						'label'		=>'Testmonial',
		           				'tab'       =>'customizer',
		 						'default'	=>'Add Your Testmonial',	
		           				'content_type'=>'html',
		           				'required'  => array('carousel_layout_type'=>'4'),
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"aut_name",		
		 						'label'		=>'Author Name',
		           				'tab'       =>'customizer',
		 						'default'	=>'Author Name',	
		           				'content_type'=>'html',
		           				'required'  => array('carousel_layout_type'=>'4'),
	 						),
	 						array(		
		 						'type'		=>'upload',		
		 						'name'		=>"athr_img",		
		 						'label'		=>'Author Image',
		           				'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
		           				'required'  => array('carousel_layout_type'=>'4'),

	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"aut_link",		
		 						'label'		=>'Author Link',
		           				'tab'       =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
		           				'required'  => array('carousel_layout_type'=>'4'),
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
			      </div>',
			      "testimonilas"=>'<div class="{{if_condition_repeater_unique==0}}how-current{{ifend_condition_repeater_unique_0}}" [class]="howSectionSelected.howSlide == {{repeater_unique}} ? \'how-current\' : \'\'" on="tap:AMP.setState({howSectionSelected: {howSlide: {{repeater_unique}}}})" role="button" tabindex="{{repeater_unique}}">
			      		<div class="card">
							<div class="cardContent">
				      			<div class="tstmnl">{{test_cntn}}</div>
				      			<a href="{{aut_link}}" class="ath-info">
					      			<amp-img src="{{athr_img}}" width="50" height="50" alt="{{image_alt}}">
					      			</amp-img>
					      			<span class="athr-nm">{{aut_name}}</span>
					      		</a>
					      	</div>
			      		</div>
			      		</div>
			      '
	          		)
	        	
	          ),
	);
?>