<?php 
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
$output = '
<div {{if_id}}id="{{id}}"{{ifend_id}} class="{{user_class}}">
{{if_condition_carousel_layout_type==1}}
	<amp-carousel {{if_condition_lightbox_gallery==1}} lightbox {{ifend_condition_lightbox_gallery_1}}
	width="400" height="300" layout="responsive" type="slides" {{if_condition_slider_autoplay==1}} autoplay {{ifend_condition_slider_autoplay_1}} controls delay="{{delay}}">
		{{repeater_image}}
	</amp-carousel>
{{ifend_condition_carousel_layout_type_1}}
{{if_condition_carousel_layout_type==2}}
	<amp-carousel {{if_condition_lightbox_gallery==1}} lightbox {{ifend_condition_lightbox_gallery_1}} id="carousel-with-preview-{{unique_cell_id}}" width="400" height="300" layout="responsive" type="slides">
		{{repeater_image}}
	</amp-carousel>
	<div class="slid-prv">
		{{repeater_button}}
	</div>
{{ifend_condition_carousel_layout_type_2}}
</div>
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
								'label'		=>'Responsive',
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
								'type'		=> 'checkbox_bool',
								'name'		=> "slider_autoplay",
								'tab'		=> 'customizer',
								'label'		=> 'Autoplay',
								'default'	=> 1,
								'content_type'=> 'html',
								'options'	=> array(
												array(
													'label'=>esc_html__('Autoplay','accelerated-mobile-pages'),
													'value'=>1,
												),
											),
							),
				        array(
								'type'		=>'checkbox_bool',
								'name'		=>"lightbox_gallery",
								'tab'		=>'customizer',
								'label'		=>'Lightbox',
								'default'	=>0,
								'options'	=>array(
												array(
													'label'=>esc_html__('Make a Lightbox for Images','accelerated-mobile-pages'),
													'value'=>1,
												),
											),
								'content_type'=>'html',
							),
				          array(		
		 						'type'		=>'checkbox_bool',		
		 						'name'		=>"img_hyperlink",		
		 						'label'		=>'Hyperlink',
		           				'tab'     	=>'customizer',
		 						'default'	=>0,
		 						'content_type'=>'html',	
		           				'options'	=>array(
												array(
													'label'=>'Make an Hyperlink on Images',
													'value'=>1,
												),
											),
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
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-carousel-0.2.js',	
	           				'content_type'=>'js',
 						),
							array(		
							'type'		=>'require_script',		
	 						'name'		=>"lightbox_script",		
	 						'label'		=>'amp-lightbox-gallery',
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-lightbox-gallery-0.1.js',	
	           				'content_type'=>'js',
	           				'required'  => array('lightbox_gallery'=>1),
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
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"image_ind_alt",		
		 						'label'		=>'Image Alt',
		           				'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"hyperlink_link_img",		
		 						'label'		=>'URL',
		           				 'tab'     =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
		           				'required'  => array('img_hyperlink'=>1),
	 						),
	 						array(		
	 							'type'	=>'select',		
	 							'name'  =>'img_link_open',		
	 							'label' =>"Open link in",
								'tab'     =>'customizer',
	 							'default' =>'new_page',
	 							'options_details'=>array(
	 												'new_page'  	=>'New tab',
	 												'same_page'    =>'Same page'
	 											),
	 							'content_type'=>'html',
	 							'required'  => array('img_hyperlink'=>'1'),
	 						),
							
	                
	              ),
	          'front_template'=>
	          		array(
	          			"image"=>'
								{{if_condition_img_hyperlink==1}}<a href="{{hyperlink_link_img}}" {{if_condition_img_link_open==new_page}}target="_blank"{{ifend_condition_img_link_open_new_page}}>{{ifend_condition_img_hyperlink_1}}
								{{if_img_upload}}<figure><amp-img src="{{img_upload}}" {{if_image_width}}width="{{image_width}}"{{ifend_image_width}} {{if_image_height}}height="{{image_height}}"{{ifend_image_height}} {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}} 
								{{if_condition_image_ind_alt==}}{{if_image_alt}}alt="{{image_alt}}"{{ifend_image_alt}} {{ifend_condition_image_ind_alt_}}
								{{if_image_ind_alt}}alt="{{image_ind_alt}}"{{ifend_image_ind_alt}}></amp-img>{{if_image_caption}}<figcaption>{{image_caption}}</figcaption>{{ifend_image_caption}}</figure>{{ifend_img_upload}}{{if_condition_img_hyperlink==1}}</a>{{ifend_condition_img_hyperlink_1}}
							',
						"button"=>'<button on="tap:carousel-with-preview-{{unique_cell_id}}.goToSlide(index={{repeater_unique}})">
			        {{if_img_upload}}<amp-img src="{{img_upload-thumbnail}}" width="150" height="150" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}} alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
			      </button>'
	          		)
	        	
	          ),
	);
?>