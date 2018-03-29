<?php		
 $output = '{{if_condition_content_layout_type==1}}
             <div class="cntn-1">
              {{if_condition_check_for_image==1}}
                <div class="cntn-img">
                  {{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
                </div>
              {{ifend_condition_check_for_image_1}}
              {{if_condition_check_for_content==1}}
                <div class="cntn-desc">
                  <h1>{{heading}}</h1>
                  {{content_title}}
                  <a href="{{btn_lnk}}">{{cntn_btn}}</a>
                </div>
              {{ifend_condition_check_for_content_1}}
             </div>
            {{ifend_condition_content_layout_type_1}}
            {{if_condition_content_layout_type==2}}
            <div class="cntn-1">
              {{if_condition_check_for_content==1}}
              <div class="cntn-desc">
                <h1>{{heading}}</h1>
                {{content_title}}
                <a href="{{btn_lnk}}">{{cntn_btn}}</a>
              </div>
              {{ifend_condition_check_for_content_1}}
              {{if_condition_check_for_image==1}}
                <div class="cntn-img">
                  {{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
                </div>
              {{ifend_condition_check_for_image_1}}
            </div>
            {{ifend_condition_content_layout_type_2}}
            {{if_condition_content_layout_type==3}}
            <div class="cntn-1">
              <div class="cntn-img">
                {{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
              </div>
              <div class="cntn-desc">
                <h1>{{heading}}</h1>
                {{content_title}}
                <a href="{{btn_lnk}}">{{cntn_btn}}</a>
              </div>
            </div>
            {{ifend_condition_content_layout_type_3}}
          ';
 

 $frontCss = '
{{if_condition_content_layout_type==1}}
{{module-class}} .cntn-1{
  display:flex;
  width:100%;
  align-items:center;
}
  {{if_condition_check_for_image==1}}
    {{module-class}} .cntn-img{
      width:{{img_width}};
    }
    .cntn-img img{width:100%;height:auto;}
  {{ifend_condition_check_for_image_1}}
  {{if_condition_check_for_content==1}}
    {{module-class}} .cntn-desc{
      width:50%;
      padding-left:4%;
      text-align: left;
    }
    {{module-class}} .cntn-desc h1{
      font-size:{{font-size}};
      color:#000;
      line-height:1.2;
    }
  {{ifend_condition_check_for_content_1}}
{{ifend_condition_content_layout_type_1}}
{{if_condition_content_layout_type==2}}
{{module-class}} .cntn-1{
  display:flex;
  width:100%;
  align-items:center;
}
  {{if_condition_check_for_image==1}}
    {{module-class}} .cntn-img{
      width:{{img_width}};
    }
    .cntn-img img{width:100%;height:auto;}
  {{ifend_condition_check_for_image_1}}
  {{if_condition_check_for_content==1}}
    {{module-class}} .cntn-desc{
      width:50%;
      padding-left:0;
      padding-right:4%;
      text-align: left;
    }
    {{module-class}} .cntn-desc h1{
      font-size:{{font-size}};
      color:#000;
      line-height:1.2;
    }
  {{ifend_condition_check_for_content_1}}
{{ifend_condition_content_layout_type_2}}
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
                            array(
                              'value'=>'2',
                              'label'=>'',
                              'demo_image'=> AMPFORWP_PLUGIN_DIR_URI.'/images/cat-dg-1.png'
                            ),
                            array(
                              'value'=>'3',
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
                'type'    =>'checkbox_bool',
                'name'    =>"check_for_image",
                'label'   => 'Enable Image',
                'tab'   =>'customizer',
                'default' =>1,
                'options' =>array(
                        array(
                          'label'=>'Yes',
                          'value'=>1,
                        )
                      ),
                'content_type'=>'html',
              ),
            array(    
              'type'    =>'upload',   
              'name'    =>"img_upload",   
              'label'   =>'Upload Image',
              'tab'     =>'customizer',
              'default' =>'', 
              'content_type'=>'html',
              'required'  => array('check_for_image'=>'1')
            ),
            array(    
              'type'    =>'text',   
              'name'    =>"img_width",   
              'label'   =>'Width',
              'tab'     =>'customizer',
              'default' =>'50%', 
              'content_type'=>'css',
              'required'  => array('check_for_image'=>'1')
            ),
            array(
                'type'    =>'checkbox_bool',
                'name'    =>"check_for_content",
                'label'   => 'Enable Content',
                'tab'   =>'customizer',
                'default' =>1,
                'options' =>array(
                        array(
                          'label'=>'Yes',
                          'value'=>1,
                        )
                      ),
                'content_type'=>'html',
              ),
            array(    
              'type'    =>'text',   
              'name'    =>"cntn_width",   
              'label'   =>'Width',
              'tab'     =>'customizer',
              'default' =>'50%', 
              'content_type'=>'css',
              'required'  => array('check_for_content'=>'1')
            ),
            array(    
              'type'    =>'text',   
              'name'    =>"heading",   
              'label'   =>'Heading',
              'tab'     =>'customizer',
              'default' =>'Heading', 
              'content_type'=>'html',
              'required'  => array('check_for_content'=>'1')
            ),
            array(    
              'type'    =>'text',   
              'name'    =>"font-size",   
              'label'   =>'Font Size',
              'tab'     =>'customizer',
              'default' =>'40px', 
              'content_type'=>'css',
              'required'  => array('check_for_content'=>'1')
            ),    			
            array(    
                'type'    =>'text-editor',    
                'name'    =>"content_title",    
                'label'   =>'Content',
                'tab'     =>'customizer',
                'default' =>'Write your content in Text Editor',  
                'content_type'=>'html',
                'required'  => array('check_for_content'=>'1')
              ),
            array(    
              'type'    =>'text',   
              'name'    =>"cntn_btn",   
              'label'   =>'Button',
              'tab'     =>'customizer',
              'default' =>'Button', 
              'content_type'=>'html',
              'required'  => array('check_for_content'=>'1')
            ),
            array(    
              'type'    =>'text',   
              'name'    =>"btn_lnk",   
              'label'   =>'Button Link',
              'tab'     =>'customizer',
              'default' =>'#', 
              'content_type'=>'html',
              'required'  => array('check_for_content'=>'1')
            ),  

            
 					),		
 		'front_template'=> $output,
    'front_css'=>$frontCss,
    'front_common_css'=>'',	
 );