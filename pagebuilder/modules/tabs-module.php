<?php 
$output = '
<amp-selector role="tablist" layout="container" class="ampTabContainer">
	{{repeater_tab_content}}
</amp-selector>
';
$css = '
{{if_condition_carousel_layout_type==1}}
.amp-img{
	width:100%;
	height:auto;
	max-width:100%;
}
{{module-class}}{margin:{{margin_css}};padding:{{padding_css}};width:{{width}}}

.ampTabContainer {
    display: flex;
    flex-wrap: wrap;
}
.tabs amp-selector [option][selected] {
    cursor: pointer;
    outline:none;
    border-radius: 50px;
}
.tabs amp-selector [option][selected] h2{
	color:#383E61;
}
.tabButton[selected] {
    outline: none;
    background:#EEF3F7;
}
.tabButton h2{
	color:#EEF3F7;
	padding:15px;
}
.tabButton {
    list-style: none;
    flex-grow: 1;
    text-align: center;
    cursor: pointer;
} 
.tabContent {
    display: none;
    width: 100%;
    order: 1;
    
}
.tabButton[selected]+.tabContent {
    display: block;
    margin-top:30px;
}

';

return array(
		'label' =>'Tabs',
		'name' =>'tabs',
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
	 						'name'		=>"selector_script",		
	 						'label'		=>'amp-selector',
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-selector-0.1.js',	
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
		 						'type'		=>'text',		
		 						'name'		=>"tab_hdng",		
		 						'label'		=>'Tab Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Tab Heading',	
		           				'content_type'=>'html',
	 						),
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
		 						'name'		=>"tab_tlt",		
		 						'label'		=>'Title',
		           				'tab'       =>'customizer',
		 						'default'	=>'Title',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				'tab'       =>'customizer',
		 						'default'	=>'Description',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"tab_btn",		
		 						'label'		=>'Button Text',
		           				'tab'       =>'customizer',
		 						'default'	=>'Button',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_lnk",		
		 						'label'		=>'Button Link',
		           				'tab'       =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),
	              ),
	          'front_template'=>
	          		array(
	          			"tab_content" => 
								'<div role="tab"class="tabButton" {{if_condition_repeater_unique==0}}selected{{ifend_condition_repeater_unique_0}} option="{{repeater_unique}}">
								    <h2>{{tab_hdng}}</h2>
								</div>
								<div role="tabpanel" class="tabContent">
									<div class="tab-img">
										{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}} alt="{{image_alt}}"></amp-img>
										{{ifend_img_upload}}
								    </div>
								    <div class="tab-cntn">
								    	<h3>{{tab_tlt}}</h3>
								    	{{content}}
								    	<a href="{{btn_lnk}}">{{tab_btn}}</a>
								    </div>
								</div>
								',
						
			      
			      
	          		)
	        	
	          ),
	);
?>