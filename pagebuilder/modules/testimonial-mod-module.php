<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$output = '
{{if_condition_testimonial_layout_type==1}}
	<div {{if_id}}id="{{id}}"{{ifend_id}} class="ln-fx {{user_class}}">{{repeater_design_1}}</div>
{{ifend_condition_testimonial_layout_type_1}}

{{if_condition_testimonial_layout_type==3}}
	<amp-carousel {{if_id}}id="{{id}}"{{ifend_id}} class="testi3-slider {{user_class}}" type="slides" width="1200" height="450" layout="responsive" data-next-button-aria-label="Go to next slide"
  		data-previous-button-aria-label="Go to previous slide"">
  		{{repeater_design_3}}
	</amp-carousel>
{{ifend_condition_testimonial_layout_type_3}}
';
$designCss = '';
if ( in_array(ampforwp_get_setting('amp-design-selector'), array(1,2,3)) ) {
	$designCss = '{{module-class}} amp-carousel.testi3-slider, {{module-class}} .testi-mod-blk blockquote{
					background:transparent;
				}
				{{module-class}} amp-carousel .testi-mod-3{
					box-sizing:border-box;
				}
				{{module-class}} .testi-mod-blk blockquote{
					padding:0;
				}
				.amp-wp-content.the_content {{module-class}} .testi-mod-blk h4{
					font-size: {{d3-txt-size}};
				    line-height: 1.2;
				    margin-top: 10px;
				    font-weight: 600;
				    color: {{d3-aut_color_picker}};
				}
				';
}
if ( in_array(ampforwp_get_setting('amp-design-selector'), array(4)) ) { 
	$designCss ='{{module-class}} amp-carousel.testi3-slider .amp-carousel-button-prev{
					border-radius: 100px;
				}
				{{module-class}} amp-carousel.testi3-slider .amp-carousel-button-next {
				    border-radius: 100px;
				}
				{{module-class}} .testi-mod-blk h4{
					font-size: {{d3-txt-size}};
				    line-height: 1.2;
				    margin-top: 10px;
				    font-weight: 600;
				    color: {{d3-aut_color_picker}};
				}
				
				';
}
$css = '
{{if_condition_testimonial_layout_type==1}}
.testimonial-mod{margin:{{margin_css}};padding:{{padding_css}};}
{{module-class}} .ln-fx{
	width:100%;
	display: flex;
	flex-wrap: wrap;
}
{{module-class}} .testi-mod{
	margin: 0 3% 2% 0px;
	position: relative;
	color: #26292c;
	flex:1 0 30%;
}
{{module-class}} .testi-cont{
	width: 100%;
	padding: 8% 7% 6% 8%;
	font-size: {{tst-size}};
	background: #f4f4f4;
	position: relative;
	color:{{tst_color}};
	box-sizing: border-box;
}
{{module-class}} .testi-cont p{margin-bottom:5px;}
.testi-cont:after{content:"";width: 0;height: 0;border-style: solid; border-width: 20px 20px 0 20px;border-color: #f4f4f4 transparent transparent transparent;bottom:-20px;position:absolute;}
.testi-mod:nth-child(3n+3){margin-right:0;}
.auth-info{width:100%;display:inline-block;margin-top: 35px;margin-left:15px;}
.auth-img{float:left;margin-right:15px;}
.auth-img amp-img{border-radius:50%;width:50px;height:50px;}
.auth-cntn{float: left;line-height: 1.8;margin-top: 2px;}
.auth-cntn h5{font-size: {{txt-size}};color: {{aut_color_picker}};font-weight:500;}
.auth-cntn span{font-size: {{dsg-size}};color: {{dsg_color}};font-weight:normal;}
@media(max-width:768px){
	{{module-class}} .testi-mod{flex:1 0 100%;margin-right:0;}

}
{{ifend_condition_testimonial_layout_type_1}}

{{if_condition_testimonial_layout_type==3}}

'.$designCss .'
{{module-class}} amp-carousel .testi-mod-3{
	width: 650px;
    height: auto;
    margin: 0 auto;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    background:{{d3-tst_bg_color}};
    padding:60px 6% 40px 6%;
    border-radius: 10px;
    box-shadow: 0 10px 16px 0 rgba(8, 8, 8, 0.14), 0 1px 9px 0 rgba(0,0,0,0.10);
}
{{module-class}} .testi-mod-3 amp-img{
	max-width: 80px;
    max-height: 80px;
    min-height: 80px;
    border-radius: 100px;
    margin:0 auto;
}
{{module-class}} .testi-mod-blk blockquote {
    border:none;
    quotes: " " "\201D" "" "";
    margin: 0px 0px 30px 0px;
}
{{module-class}} .testi-mod-blk blockquote.blqut div p{
	font-size: {{d3-tst-size}};
	line-height:1.4;
	padding:0px;
	font-weight:normal;
}
{{module-class}} .testi-mod-blk blockquote.blqut div{
    padding: 50px 0px 0px 0px;
    font-weight: 400;
    color: {{d3-tst_color}};
    font-family: sans-serif;
}
{{module-class}} .testi-mod-blk blockquote.blqut div:before { 
	content: open-quote;
	width:auto;
	border:none;
}
{{module-class}} .testi-mod-blk blockquote.blqut div p:before {  
	display:none;
}
{{module-class}} .testi-mod-blk blockquote.blqut div:after { 
	content: close-quote;
	font-weight: bold;
	font-size:80px;
	color:{{d3-bquote_color}};
	font-family:Georgia, "Times New Roman", Times, serif;
	position: absolute;
    top: 10px;
    line-height: 0;
    left: 0;
    right: 0;
    margin: 0 auto;
}
{{module-class}} .testi-mod-blk{
	text-align:center;
	position:relative;
}

{{module-class}} .testi-mod-blk span{
	font-size: {{d3-dsg-size}};
    color: {{d3-dsg_color}};
    display: inherit;
}
{{module-class}} amp-carousel{
	min-height:600px;
}
{{module-class}} amp-carousel.testi3-slider .amp-carousel-button-prev, {{module-class}} amp-carousel.testi3-slider .amp-carousel-button-next{
	border-radius: 100px;
}


@media(max-width:991px){
	
	{{module-class}} amp-carousel.testi3-slider .amp-carousel-button-prev{
		left: 30px;
	}
	{{module-class}} amp-carousel.testi3-slider .amp-carousel-button-next {
		right: 30px;
	}
}

@media(max-width:768px){
	{{module-class}} .testi-mod-blk blockquote p:after{
		top:20px;
	}
	{{module-class}} amp-carousel{
		min-height:450px;
	}
}

@media(max-width:650px){
	{{module-class}} amp-carousel .testi-mod-3{
		width:100%;
		padding:40px 30px 20px 30px;
	}
	{{module-class}} .testi-mod-blk blockquote.blqut div {
    	font-size: 18px;
    }
    {{module-class}} amp-carousel.testi3-slider .amp-carousel-button-prev{
		left: 10px;
	}
	{{module-class}} amp-carousel.testi3-slider .amp-carousel-button-next {
		right: 10px;
	}
	{{module-class}} amp-carousel .testi-mod-3{
		box-shadow: none;
	}
	{{module-class}} .testi-mod-blk blockquote.blqut div p{
		font-size: 20px;
	}
}

{{ifend_condition_testimonial_layout_type_3}}

';
global $redux_builder_amp;
if(ampforwp_get_setting('amp-rtl-select-option')){
$css .= '/** RTL CSS **/
.testi-mod{margin: 0 0 2% 3%;}
.testi-mod:nth-child(3),.testi-mod:nth-child(6),.testi-mod:nth-child(9){margin-left:0;}
.auth-cntn {float: right;}
.auth-img {float: right;margin-left: 15px;}
@media(max-width:768px){
	.testi-mod{width: 100%;margin-right:0}
}
';
}
return array(
		'label' =>'Testimonial',
		'name' =>'testimonial-mod',
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
				            'name'    =>"testimonial_layout_type",
				            'label'   =>"Select Layout",
				            'tab'     =>'layout',
				            'default' =>'1',    
				            'options_details'=>array(
				                            array(
				                              'value'=>'1',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/testmon-1.png'
				                            ),
				                            array(
				                              'value'=>'3',
				                              'label'=>'',
				                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/testmon-3.png'
				                            ),
				                            
				                          ),
				            'content_type'=>'html',
				            ),
						array(
			                    'type'      =>'text',
			                    'name'      =>"txt-size",
			                    'label'     =>'Author Font Size',
			                    'tab'       =>'design',
			                    'default'   =>'13px',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(1,2))
			                ),
						array(
								'type'		=>'color-picker',
								'name'		=>"aut_color_picker",
								'label'		=>'Author Text Color',
								'tab'		=>'design',
								'default'	=>'#333',
								'content_type'=>'css',
								'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(1,2))
								
							),
			            array(
			                    'type'      =>'text',
			                    'name'      =>"dsg-size",
			                    'label'     =>'Designation Font Size',
			                    'tab'       =>'design',
			                    'default'   =>'13px',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(1,2))
			                    
			                ),
			            array(
			                    'type'      =>'color-picker',
			                    'name'      =>"dsg_color",
			                    'label'     =>'Designation Text Color',
			                    'tab'       =>'design',
			                    'default'   =>'#333',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(1,2))
			                    
			                ),
			            array(
			                    'type'      =>'text',
			                    'name'      =>"tst-size",
			                    'label'     =>'Testimonial Font Size',
			                    'tab'       =>'design',
			                    'default'   =>'18px',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(1,2))
			                    
			                ),
			            array(
			                    'type'      =>'color-picker',
			                    'name'      =>"tst_color",
			                    'label'     =>'Testimonial Color',
			                    'tab'       =>'design',
			                    'default'   =>'#333',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(1,2))
			                    
			                ),
			            // Design 3 Fields
			            array(
			                    'type'      =>'color-picker',
			                    'name'      =>"d3-tst_bg_color",
			                    'label'     =>'Testimonial Background Color',
			                    'tab'       =>'design',
			                    'default'   =>'#ECF3FE',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(3))
			                    
			                ),
			             array(
			                    'type'      =>'text',
			                    'name'      =>"d3-tst-size",
			                    'label'     =>'Testimonial Font Size',
			                    'tab'       =>'design',
			                    'default'   =>'25px',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(3))
			                    
			                ),
			            array(
			                    'type'      =>'color-picker',
			                    'name'      =>"d3-tst_color",
			                    'label'     =>'Testimonial Text Color',
			                    'tab'       =>'design',
			                    'default'   =>'#888',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(3))
			                    
			                ),
			            array(
			                    'type'      =>'text',
			                    'name'      =>"d3-txt-size",
			                    'label'     =>'Author Font Size',
			                    'tab'       =>'design',
			                    'default'   =>'13px',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(3))
			                ),
						array(
								'type'		=>'color-picker',
								'name'		=>"d3-aut_color_picker",
								'label'		=>'Author Text Color',
								'tab'		=>'design',
								'default'	=>'#777',
								'content_type'=>'css',
								'required_type'=>'or',
								'required'  => array('testimonial_layout_type'=> array(3))
								
							),
						array(
			                    'type'      =>'text',
			                    'name'      =>"d3-dsg-size",
			                    'label'     =>'Designation Font Size',
			                    'tab'       =>'design',
			                    'default'   =>'10px',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(3))
			                    
			                ),
			            array(
			                    'type'      =>'color-picker',
			                    'name'      =>"d3-dsg_color",
			                    'label'     =>'Designation Text Color',
			                    'tab'       =>'design',
			                    'default'   =>'#333',
			                    'content_type'=>'css',
			                    'required_type'=>'or',
			                    'required'  => array('testimonial_layout_type'=> array(3))
			                ),
			            array(
			                    'type'      =>'color-picker',
			                    'name'      =>"d3-bquote_color",
			                    'label'     =>'Blockquote Icon Color',
			                    'tab'       =>'design',
			                    'default'   =>'#9FBEFA',
			                    'required_type'=>'or',
			                    'content_type'=>'css',
			                    'required'  => array('testimonial_layout_type'=> array(3))
			                ),

			            //Common Fields for all Designs
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
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Testimonial',
		           				 'tab'     =>'customizer',
		 						'default'	=>'Testimonial',	
		           				'content_type'=>'html',
	 					),
	 					array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Avatar',
		           				 'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',
	 						),
	 					
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"content_title",		
		 						'label'		=>'Author Name',
		           				'tab'       =>'design',
		 						'default'	=>'Name',	
		           				'content_type'=>'html',
	 						),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"auth_desig",		
		 						'label'		=>'Designation',
		           				'tab'       =>'design',
		 						'default'	=>'Designation',	
		           				'content_type'=>'html',
	 						),
						
                
              ),
          'front_template'=>array(
        				"design_1" => '
					        <div class="testi-mod">
								<div class="testi-cont">
									{{content}}
								</div>
								<div class="auth-info">
									<div class="auth-img">
										{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
									</div>
									<div class="auth-cntn">
										<h5>{{content_title}}</h5>
										<span>{{auth_desig}}</span>
									</div>
								</div>
							</div>',

						"design_3" => '
							<div class="testi-mod-3">
								<div class="testi-mod-blk">
									<blockquote class="blqut">
										<div class="testi3-cntn">{{content}}</div>
									</blockquote>
									{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
									<h4>{{content_title}}</h4>
									<span>{{auth_desig}}</span>
								</div>
							</div>'
						),
          ),
	);

?>