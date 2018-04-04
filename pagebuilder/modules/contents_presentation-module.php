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
            <div class="cntn-2">
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
            <div class="cntn-3">
              <div class="cntn-blk">
                <div class="cntn-desc">
                  <h1>{{heading}}</h1>
                  {{content_title}}
                  <a href="{{btn_lnk}}">{{cntn_btn}}</a>
                </div>
                <div class="cntn-img">
                  {{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
                </div>
              </div>
            </div>
            {{ifend_condition_content_layout_type_3}}
            {{if_condition_content_layout_type==4}}
            <div class="cntn-4">
              <div class="cntn-blk">
                <div class="cntn-img">
                  {{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" layout="responsive" alt="{{image_alt}}"></amp-img>{{ifend_img_upload}}
                </div>
                <div class="cntn-desc">
                  <h1>{{heading}}</h1>
                  {{content_title}}
                  <a href="{{btn_lnk}}">{{cntn_btn}}</a>
                </div>
              </div>
            </div>
            {{ifend_condition_content_layout_type_4}}
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
      line-height:0;
    }
    {{module-class}} .cntn-img amp-img{
      max-width:{{ampimg_width}};
      margin:0 auto;
    }
    {{module-class}} .cntn-img img{width:100%;height:auto;}
  {{ifend_condition_check_for_image_1}}
  {{if_condition_check_for_content==1}}
    {{module-class}} .cntn-desc{
      width:{{cntn_width}};
      color:{{heading_color}};
      font-size:16px;
      text-align: {{align_type}};
      padding:{{padding_gap}};
    }
    {{module-class}} .cntn-desc h1{
      font-size:{{font-size}};
      line-height:1.2;
      font-weight: 600;
    }
    {{module-class}} .cntn-desc a{
      color:{{btn_color}};
      font-size:{{btn-font-size}};
      line-height:1.4;
      font-weight:500;
      margin-top: 10px;
      display:block;
    }
  {{ifend_condition_check_for_content_1}}
@media(max-width:768px){
    {{module-class}} .cntn-1{
      display:inline-block;
    }
    {{module-class}} .cntn-img{
      width:100%;
      padding:0;
    }
    {{module-class}} .cntn-desc{
      width:100%;
      margin-top:30px;
    }
}
{{ifend_condition_content_layout_type_1}}
{{if_condition_content_layout_type==2}}
{{module-class}} .cntn-2{
  display:flex;
  width:100%;
  align-items:center;
}
  {{if_condition_check_for_image==1}}
    {{module-class}} .cntn-img{
      width:{{img_width}};
      line-height:0;
    }
    {{module-class}} .cntn-img amp-img{
      max-width:{{ampimg_width}};
      margin:0 auto;
    }
    {{module-class}} .cntn-img img{width:100%;height:auto;}
  {{ifend_condition_check_for_image_1}}
  {{if_condition_check_for_content==1}}
    {{module-class}} .cntn-desc{
      width:{{cntn_width}};
      color:{{heading_color}};
      padding:{{padding_gap}};
      font-size:16px;
      text-align: {{align_type}};
    }
    {{module-class}} .cntn-desc h1{
      font-size:{{font-size}};
      line-height:1.2;
      font-weight: 600;
      margin-bottom:15px;
    }
    {{module-class}} .cntn-desc a{
      color:{{btn_color}};
      font-size:{{btn-font-size}};
      line-height:1.4;
      font-weight:500;
      margin-top: 10px;
      display:block;
    }
  {{ifend_condition_check_for_content_1}}
@media(max-width:768px){
  {{module-class}} .cntn-2{
      display:inline-block;
    }
    {{module-class}} .cntn-img{
      width:100%;
      padding:0;
      margin-top:30px;
    }
    {{module-class}} .cntn-desc{
      width:100%;
      padding:0;
    }
}
{{ifend_condition_content_layout_type_2}}
{{if_condition_content_layout_type==3}}
  {{module-class}} .cntn-3{
    width:100%;
    display:inline-block;
    padding:20px;
  }
  {{module-class}} .cntn-blk{
      width:100%;
      background: {{bg_clr}} url({{blk_background_image}});
      background-repeat: no-repeat;
      background-size: cover;
      height: auto;
      background-position:center;
  }
  {{if_condition_check_for_content==1}}
    {{module-class}} .cntn-desc{
      width:100%;
      color:{{heading_color}};
      font-size:16px;
      text-align: {{align_type}};
      padding:{{padding_gap}};
    }
    {{module-class}} .cntn-desc h1{
        font-size:{{font-size}};
        line-height:1.2;
        font-weight: 600;
        margin-bottom:15px;
    }
    {{module-class}} .cntn-desc a{
      color:{{btn_color}};
      font-size:{{btn-font-size}};
      line-height:1.4;
      font-weight:500;
      margin-top: 10px;
      display:block;
    }
  {{ifend_condition_check_for_content_1}}
  {{if_condition_check_for_image==1}}
    {{module-class}} .cntn-img{
       width:100%;
       height:auto;
      line-height:0;
    }
    {{module-class}} .cntn-img amp-img{
      max-width:{{ampimg_width}};
      margin:0 auto;
    }
    {{module-class}} .cntn-img img{width:100%;height:auto;}
  {{ifend_condition_check_for_image_1}}
@media(max-width:768px){
  .col-2{
    width:100%;
    float:none;
  }
  {{module-class}} .cntn-3{
    padding:0;
  }
}
{{ifend_condition_content_layout_type_3}}
{{if_condition_content_layout_type==4}}
 {{module-class}} .cntn-4{
    width:100%;
    display:inline-block;
    padding:20px;
  }
  {{module-class}} .cntn-blk{
    width:100%;
    background: {{bg_color}} url({{blk_background_image}});
    background-repeat: no-repeat;
    background-size: cover;
    height: auto;
    background-position:center;
  }
  {{if_condition_check_for_content==1}}
    {{module-class}} .cntn-desc{
      width:100%;
      color:{{heading_color}};
      font-size:16px;
      text-align: {{align_type}};
      padding:{{padding_gap}};
    }
    {{module-class}} .cntn-desc h1{
        font-size:{{font-size}};
        line-height:1.2;
        font-weight: 600;
        margin-bottom:15px;
    }
    {{module-class}} .cntn-desc a{
      color:{{btn_color}};
      font-size:{{btn-font-size}};
      line-height:1.4;
      font-weight:500;
      margin-top: 10px;
      display: block;
    }
  {{ifend_condition_check_for_content_1}}
  {{if_condition_check_for_image==1}}
    {{module-class}} .cntn-img{
      width:100%;
      height:auto;
      line-height:0;
    }
    {{module-class}} .cntn-img amp-img{
      max-width:{{ampimg_width}};
      margin:0 auto;
    }
    {{module-class}} .cntn-img img{width:100%;height:auto;}
  {{ifend_condition_check_for_image_1}}
@media(max-width:768px){
  .col-2{
    width:100%;
    float:none;
  }
  {{module-class}} .cntn-4{
    padding:0;
  }
}
{{ifend_condition_content_layout_type_4}}

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
                            array(
                              'value'=>'4',
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
                'label'   => 'Image',
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
              'type'    =>'text',   
              'name'    =>"ampimg_width",   
              'label'   =>'Image Wrapper',
              'tab'     =>'customizer',
              'default' =>'100%', 
              'content_type'=>'css',
              'required'  => array('check_for_image'=>'1')
            ),
            array(
                'type'    =>'checkbox_bool',
                'name'    =>"check_for_content",
                'label'   => 'Content',
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
                'type'    =>'spacing',
                'name'    =>"padding_gap",
                'label'   =>'Gapping',
                'tab'   =>'customizer',
                'default' =>
                            array(
                                'top'=>'0px',
                                'right'=>'0px',
                                'bottom'=>'0px',
                                'left'=>'0px',
                            ),
                'content_type'=>'css',
                'required'  => array('check_for_content'=>'1')
              ),        
            array(    
              'type'    =>'text',   
              'name'    =>"font-size",   
              'label'   =>'Font Size',
              'tab'     =>'container_css',
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
            array(    
                'type'  =>'select',   
                'name'  =>'align_type',   
                'label' =>"Align",
                'tab'     =>'container_css',
                'default' =>'center',
                'options_details'=>array(
                          'center'    =>'Center',
                          'left'      =>'Left',
                          'right'     =>'Right',                           ),
                'content_type'=>'css',
              ),  
            array(
                'type'    =>'color-picker',
                'name'    =>"heading_color",
                'label'   =>'Heading',
                'tab'   =>'container_css',
                'default' =>'#000',
                'content_type'=>'css'
              ),
            array(
                'type'    =>'color-picker',
                'name'    =>"btn_color",
                'label'   =>'Button',
                'tab'   =>'container_css',
                'default' =>'#0070c9',
                'content_type'=>'css'
              ),
            array(    
              'type'    =>'text',   
              'name'    =>"btn-font-size",   
              'label'   =>'Button Font Size',
              'tab'     =>'container_css',
              'default' =>'18px', 
              'content_type'=>'css',
              'required'  => array('check_for_content'=>'1')
            ),
            array(
                'type'    =>'upload',
                'name'    =>"blk_background_image",
                'label'   =>"Background Image",
                'tab'   =>'container_css',
                'default' =>'',
                'content_type'=>'css',
                'required'  => array('content_layout_type'=>'3')
                ),
            array(
                'type'    =>'color-picker',
                'name'    =>"bg_clr",
                'label'   =>'Background',
                'tab'   =>'container_css',
                'default' =>'#fff',
                'content_type'=>'css',
                'required'  => array('content_layout_type'=>'3')
              ),
            array(
                'type'    =>'color-picker',
                'name'    =>"bg_color",
                'label'   =>'Background',
                'tab'   =>'container_css',
                'default' =>'#fff',
                'content_type'=>'css',
                'required'  => array('content_layout_type'=>'4')
              ),
            
 					),		
 		'front_template'=> $output,
    'front_css'=>$frontCss,
    'front_common_css'=>'',	
 );