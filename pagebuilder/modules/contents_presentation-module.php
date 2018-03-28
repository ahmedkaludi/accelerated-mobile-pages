<?php		
 $output = '{{if_condition_content_layout_type==1}}
             <div class="cntn-1">
              <div class="cntn-img">
                {{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
              </div>
              <div class="cntn-desc">
                <h2>Checking </h2>
                <p>CheckingCheckingCheckingCheckingCheckingCheckingCheckingCheckingChecking</p>
                <a href="#">Learn</a>
              </div>
             </div>
            {{ifend_condition_content_layout_type_1}}
          ';
 

 $frontCss = '
{{if_condition_content_layout_type==1}}
.cntn-1{
  display:flex;
  width:100%;
  align-items:center;
}
.cntn-img{
  width:50%;
}

.cntn-desc{
  width:50%;
}
.cntn-1 h2{font-size:30px;color:#000;}
{{ifend_condition_content_layout_type_1}}

';

 return array(		
 		'label' =>'Content',		
 		'name' => 'contents_presentation',
    'default_tab'=> 'customizer',
    'tabs' => array(
              'customizer'=>'Content',
              'container_css'=>'Design',
              'advanced' => 'Advanced',
              'layout' => 'Layout'
            ),
 		'fields' => array(
            array(    
            'type'    =>'layout-image-picker',
            'name'    =>"content_layout_type",
            'label'   =>"Select Layout",
            'tab'     =>'layout',
            'default' =>'1',    
            'options_details'=>array(
                            array(
                              'value'=>'1',
                              'label'=>'',
                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/cat-dg-1.png'
                            ),
                            
                          ),
            'content_type'=>'html',
            ),
            array(
                'type'    =>'spacing',
                'name'    =>"margin_css",
                'label'   =>'Margin',
                'tab'   =>'advanced',
                'default' =>
                            array(
                                'top'=>'20px',
                                'right'=>'0px',
                                'bottom'=>'20px',
                                'left'=>'0px',
                            ),
                'content_type'=>'css',
              ),
              array(
                'type'    =>'spacing',
                'name'    =>"padding_css",
                'label'   =>'Padding',
                'tab'   =>'advanced',
                'default' =>array(
                          'left'=>'0px',
                          'right'=>'0px',
                          'top'=>'0px',
                          'bottom'=>'0px'
                        ),
                'content_type'=>'css',
              ),
              array(    
              'type'    =>'upload',   
              'name'    =>"img_upload",   
              'label'   =>'Image',
                    'tab'     =>'customizer',
              'default' =>'', 
                    'content_type'=>'html',
            ),  			
            
            array(    
                'type'    =>'text-editor',    
                'name'    =>"content_title",    
                'label'   =>'Content',
                       'tab'     =>'customizer',
                'default' =>'Write your content in Text Editor',  
                'content_type'=>'html',
              ),

            
 					),		
 		'front_template'=> $output,
    'front_css'=>$frontCss,
    'front_common_css'=>'',	
 );