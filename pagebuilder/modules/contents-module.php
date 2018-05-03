<?php		
require_once  ABSPATH . WPINC . '/category.php';
 $output = '{{if_condition_content_layout_type==1}}
            <div class="pb_mod cat_mod"><h4>{{content_title}}</h4>   
                <div class="wrap"><ul>{{category_selection}}</ul></div>    
            </div>
          {{ifend_condition_content_layout_type_1}}
          ';
 

 $frontCss = '
{{if_condition_content_layout_type==1}}
.wrap{width:100%;display:inline-block;margin-top:10px;}
.cat_mod ul{display: flex;flex-wrap: wrap;margin: -15px;padding:0;list-style-type:none;}
.cat_mod ul li {margin: 15px 15px 25px 15px;flex-basis: calc(33.33% - 30px);}
.cat_mod .cat_mod_l{line-height:0;}
.cat_mod {margin:{{margin_css}};padding:{{padding_css}};}
.cat_mod h4{border-bottom: 2px solid #eee;padding-bottom: 8px;margin-bottom: 5px;font-size:18px;color: #191919;font-weight: 600;}
.cat_mod .cat_mod_r{display:flex;flex-direction: column;margin-top: 6px;}
.cat_mod .cat_mod_r a{font-size: 16px;line-height: 1.3;font-weight: 500;color: #000;margin: 0px 0px 5px 0px;}
.cat_mod .cat_mod_r p{color: {{text_color_picker}};font-size: 13px;line-height: 20px;letter-spacing: 0.10px;margin-bottom:0;}
.cat_mod .cat_mod_l{width:100%;}
@media(max-width:768px){
  .cat_mod ul li {flex-basis: calc(100% - 30px);margin: 10px 15px;}
  .cat_mod_l amp-img{width:100%;}
  .cat_mod .cat_mod_l{width: 40%;float: left;margin-right: 20px;}
  .cat_mod .cat_mod_r{width: 54%;float: left;margin-top: 0;}
}
@media (max-width: 480px){
  .cat_mod .cat_mod_l{width: 100%;float: none;margin-right: 0px;}
  .cat_mod .cat_mod_r{width: 100%;float: none;margin-top:6px;}
}
{{ifend_condition_content_layout_type_1}}
';

 $categories = get_categories( array(		
                   'orderby' => 'name',		
                   'order'   => 'ASC'		
               ) );		
 $categoriesArray = array('recent_option'=>'Recent Posts');		
 $options = '<option value="recent_option">Recent Posts</option>';		
 foreach($categories as $category){		
  $categoryName = htmlspecialchars($category->name, ENT_QUOTES);
 	$categoriesArray[$category->term_id] = $categoryName;		
 	$options.= '<option value="'.$category->term_id.'">'.$categoryName.'</option>';		
 }		



 return array(		
 		'label' =>'Category',		
 		'name' => 'contents',
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
 						'type'		=>'text',		
 						'name'		=>"content_title",		
 						'label'		=>'Category Block',
            'tab'     =>'customizer',
 						'default'	=>'Category',	
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
 							'type'	=>'select',		
 							'name'  =>"category_selection",		
 							'label' =>"Select Category",
              'tab'     =>'customizer',
 							'default' =>'recent_option',		
 							'options' => $options,		
 							'options_details'=>$categoriesArray	,
              'content_type'=>'html',
 						),		
 						array(		
 						'type'		=>'text',		
 						'name'		=>"show_total_posts",
 						'label'		=>'Count',		
            'tab'     =>'customizer',
 						'default'	=>'3',
            'content_type'=>'html',
 						),
 						array(		
 						'type'		=>'select',
 						'name'		=>"ampforwp_show_excerpt",
 						'label'		=>"Excerpt",
            'tab'     =>'customizer',
						'default'	=>'yes',		
						'options'	=> '<option value="yes">Yes</option><option value="no">No</option>',		
						'options_details'=>array('yes'=>'Yes', 'no'=>'No'),
            'content_type'=>'html',
 						),
            array(    
            'type'    =>'text',   
            'name'    =>"img-width-1",    
            'label'   =>'Image Width',
            'tab'     =>'customizer',
            'default' =>'346', 
            'content_type'=>'html',
            'required'  => array('content_layout_type' => 1),
            ),
            array(    
            'type'    =>'text',   
            'name'    =>"img-height-1",    
            'label'   =>'Image Height',
            'tab'     =>'customizer',
            'default' =>'188', 
            'content_type'=>'html',
            'required'  => array('content_layout_type' => 1),
            ),

            
 					),		
 		'front_template'=> $output,
    'front_css'=>$frontCss,
    'front_common_css'=>'',	
    'front_loop_content'=>'  {{if_condition_content_layout_type==1}}
                          <li> 

                              <div class="cat_mod_l"> 
                               <a href="{{ampforwp_post_url}}">
                               {{if_image}}<amp-img  class="ampforwp_wc_shortcode_img"  src="{{image}}" width="{{width}}" height="{{height}}" layout="responsive" alt="{{image_alt}}"> </amp-img>{{ifend_image}}</a>
                              </div>
                              <div class="cat_mod_r">
                                <a href="{{ampforwp_post_url}}">{{title}}</a>
                                {{excerptContent}}
                                </div>
                            </li></a> 
                       {{ifend_condition_content_layout_type_1}}


                      
                          ',
 );		
 function contentHtml($the_query,$fieldValues,$loopHtml){	
 	$contenthtml = '';		
 	$ampforwp_show_excerpt = (isset($fieldValues['ampforwp_show_excerpt'])? $fieldValues['ampforwp_show_excerpt']: 'yes');		
 	if ( $the_query->have_posts() ) {	
         while ( $the_query->have_posts() ) {		
             $the_query->the_post();		
             $ampforwp_post_url = get_permalink();	
             $ampforwp_post_url = trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR;
             $image = $height = $width = $image_alt = "";	
             if ( has_post_thumbnail() ) {  
                   $thumb_id = get_post_thumbnail_id();   
                   $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
                   $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);  
                   $image = $thumb_url_array[0];
                   $width = $thumb_url_array[1];
                   $height = $thumb_url_array[2];

                   switch($fieldValues['content_layout_type']){
                    case 1:
                      $width = $fieldValues['img-width-1'];
                      $height = $fieldValues['img-height-1'];
                    break;
                    case 2:
                      $width = $fieldValues['img-width-2'];
                      $height = $fieldValues['img-height-2'];
                    break;
                    case 3:
                      $width = $fieldValues['img-width-3'];
                      $height = $fieldValues['img-height-3'];
                    break;
                    case 4:
                      $width = $fieldValues['img-width-4'];
                      $height = $fieldValues['img-height-4'];
                    break;
                    case 5:
                      $width = $fieldValues['img-width-5'];
                      $height = $fieldValues['img-height-5'];
                    break;
                    default:
                    break;
                   }
                   try{
                    $thumb_url = ampforwp_aq_resize( $image, $width, $height, true, false ); //resize & crop the image
                    if($thumb_url!=false){
                      $image   =  $thumb_url[0];
                      $width   =  $thumb_url[1];
                      $height  =  $thumb_url[2];
                    }
                   }catch(Exception $e){
                      error_log($e);
                   }
                  
              }
              $excerptContent = "";
              if( $ampforwp_show_excerpt == 'yes' ) {     
                   if( has_excerpt() ) {    
                     $content = get_the_excerpt();    
                   } else {   
                     $content = get_the_content();    
                   }  
                 $excerptContent = ' 
                 <p>'.wp_trim_words( strip_tags( strip_shortcodes( $content ) ) , '15'  ).'</p>';   
              }
               $title = get_the_title();
               $postid = get_the_ID();
               $author = get_the_author();
              // get_the_author_meta( string $field = '', int $user_id = false );
               $postdate = get_the_date(  ' F j, Y', $postid );
              $rawhtml = str_replace(array(
                                "{{ampforwp_post_url}}",
                                "{{image}}",
                                "{{width}}",
                                "{{height}}",
                                "{{title}}",
                                "{{excerptContent}}",
                                "{{authorname}}",
                                "{{postdate}}",
                                "{{image_alt}}"
                                ), 
                              array(
                                $ampforwp_post_url,
                                $image,
                                $width,
                                $height,
                                $title,
                                $excerptContent,
                                $author,
                                $postdate,
                                $image_alt
                              ), 
                              $loopHtml);
            $rawhtml = ampforwp_replaceIfContentConditional("ampforwp_post_url", $ampforwp_post_url, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("image", $image, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("width", $width, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("height", $height, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("title", $title, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("excerptContent", $excerptContent, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("authorname", $author, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("postdate", $postdate, $rawhtml);
            $contenthtml .= $rawhtml;
            
         }		
 		
       		
 		
     }		
     /* Restore original Post Data */		
     wp_reset_postdata();
     return $contenthtml;		
 }