<?php		
require_once  ABSPATH . WPINC . '/category.php';
 $output = '<div class="pb_mod cat_mod"><h4>{{content_title}}</h4>		
 			<div class="wrap">{{category_selection}}</div>		
 	</div>';		
 

 $frontCss = '
.cat_mod ul{
    display: flex;
    flex-wrap: wrap;
    margin: -15px;
    padding:0;
    list-style-type:none;
 }
.cat_mod ul li {
    margin: 15px 15px 25px 15px;
    flex-basis: calc(33.33% - 30px);
}
.cat_mod .cat_mod_l{
  line-height:0;
}
.cat_mod {
  margin:{{margin_css}};
   padding:{{padding_css}};
{{if_bg_clr}}
 background:{{bg_color_picker}};
  padding:40px;
{{ifend_bg_clr}}
}

.cat_mod h4{
  border-bottom: 2px solid {{border_color_picker}};
  padding-bottom: 8px;
  margin-bottom: 5px;
  font-size:{{label-size}};
  color: {{label_color_picker}};
  font-weight: {{label-weight}}
}

.cat_mod .cat_mod_r{
  display:flex;
  flex-direction: column;
}
.cat_mod .cat_mod_r a{
  font-size: {{cat-size}};
  line-height: 1.3;
  font-weight: {{cat-weight}};
  color: {{text_color_picker}};
  margin: 0px 0px 5px 0px;
}
.cat_mod .cat_mod_r p{
  color: {{text_color_picker}};
  font-size: 13px;
  line-height: 20px;
  letter-spacing: 0.10px;
  margin-bottom:0;
}
';

 $categories = get_categories( array(		
                   'orderby' => 'name',		
                   'order'   => 'ASC'		
               ) );		
 $categoriesArray = array('recent_option'=>'Recent Posts');		
 $options = '<option value="recent_option">Recent Posts</option>';		
 foreach($categories as $category){		
 	$categoriesArray[$category->term_id] = $category->name;		
 	$options.= '<option value="'.$category->term_id.'">'.$category->name.'</option>';		
 }		



 return array(		
 		'label' =>'Category',		
 		'name' => 'contents',
    'default_tab'=> 'customizer',
    'tabs' => array(
              'customizer'=>'Content',
              'container_css'=>'Design',
              'advanced' => 'Advanced'
            ),
 		'fields' => array(
 						array(		
 						'type'		=>'text',		
 						'name'		=>"content_title",		
 						'label'		=>'Category Block',
            'tab'     =>'customizer',
 						'default'	=>'Category',	
            'content_type'=>'html',
 						),
            array(
                'type'    =>'checkbox',
                'name'    =>"bg_clr",
                'tab'   =>'container_css',
                'label'   =>'Background Type',
                'default' =>array(), 
                'options' =>array(
                        array(
                          'label'=>'', 
                          'value'=>"yes",
                        ),
                      ),
                'content_type'=>'css',
              ),
            array(
                'type'    =>'color-picker',
                'name'    =>'bg_color_picker',
                'label'   =>'Background Color',
                'tab'   =>'container_css',
                'default' =>'#fff',
                'content_type'=>'css',
                'required'  => array('bg_clr'=>"yes")
              ),
            array(    
            'type'    =>'text',   
            'name'    =>"label-size",    
            'label'   =>'label Font Size ',
            'tab'     =>'container_css',
            'default' =>'18px', 
            'content_type'=>'css',
            ),
            array(    
            'type'    =>'text',   
            'name'    =>"label-weight",    
            'label'   =>'label Font Weight ',
            'tab'     =>'container_css',
            'default' =>'600', 
            'content_type'=>'css',
            ),
            array(    
            'type'    =>'text',   
            'name'    =>"cat-size",    
            'label'   =>'Font Size ',
            'tab'     =>'container_css',
            'default' =>'20px', 
            'content_type'=>'css',
            ),
            array(    
            'type'    =>'text',   
            'name'    =>"cat-weight",    
            'label'   =>'Font Weight ',
            'tab'     =>'container_css',
            'default' =>'500', 
            'content_type'=>'css',
            ),
            array(
                'type'    =>'color-picker',
                'name'    =>'border_color_picker',
                'label'   =>'Border Color',
                'tab'   =>'container_css',
                'default' =>'#eee',
                'content_type'=>'css'
              ),
            array(
              'type'    =>'color-picker',
              'name'    =>'label_color_picker',
              'label'   =>'Lable Color',
              'tab'   =>'container_css',
              'default' =>'#000',
              'content_type'=>'css'
            ),
            array(
              'type'    =>'color-picker',
              'name'    =>'text_color_picker',
              'label'   =>'Text Color',
              'tab'   =>'container_css',
              'default' =>'#191919',
              'content_type'=>'css'
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
            'name'    =>"img-width",    
            'label'   =>'Image Width',
            'tab'     =>'customizer',
            'default' =>'346', 
            'content_type'=>'html',
            ),
            array(    
            'type'    =>'text',   
            'name'    =>"img-height",    
            'label'   =>'Image Height',
            'tab'     =>'customizer',
            'default' =>'188', 
            'content_type'=>'html',
            ),
 					),		
 		'front_template'=> $output,
    'front_css'=>$frontCss,
    'front_common_css'=>'',	
 );		
 function contentHtml($the_query,$fieldValues){		
 	$contenthtml = '';		
 	$ampforwp_show_excerpt = (isset($fieldValues['ampforwp_show_excerpt'])? $fieldValues['ampforwp_show_excerpt']: 'yes');		
 	if ( $the_query->have_posts() ) {		
         $contenthtml.= '<ul>';		
         while ( $the_query->have_posts() ) {		
             $the_query->the_post();		
             $ampforwp_post_url = get_permalink();		
             $contenthtml.='<li>';		
                 if ( has_post_thumbnail() ) {	
                   $contenthtml.= '
                   <div class="cat_mod_l">
                   ';		             
                   $thumb_id = get_post_thumbnail_id();		
                   $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);	
                   $thumb_url = $thumb_url_array[0];
                   $width = $fieldValues['img-width'];
                   $height = $fieldValues['img-height'];
                   $thumb_url_array = aq_resize( $thumb_url, $width, $height, true, false ); //resize & crop the image
                   $contenthtml.= '<a href="'.trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR .'"><amp-img  class="ampforwp_wc_shortcode_img"  src="'. $thumb_url_array[0].'" width="'. $thumb_url_array[1] . '" height="' . $thumb_url_array[2] . '" layout="fixed"></amp-img></a>';
                    $contenthtml.= '
                    </div>
                    ';	             
                 }
             $contenthtml.= '<div class="cat_mod_r">';		             
               $contenthtml.= '<a href="'. trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR.'">'.get_the_title().'</a>'; 		
 		
               if( $ampforwp_show_excerpt == 'yes' ) { 		
 				if( has_excerpt() ) {		
                     $content = get_the_excerpt();		
                   } else {		
                     $content = get_the_content();		
                   }	
                 $contenthtml.= ' 
                 <p>'.wp_trim_words( strip_tags( strip_shortcodes( $content ) ) , '15'  ).'</p>';		
 			} 		
             $contenthtml.= '</div>';		
 		
             $contenthtml.= '</li>';		
         }		
 		
       		
         $contenthtml.= '</ul>';		
 		
     }		
     /* Restore original Post Data */		
     wp_reset_postdata();		
     return $contenthtml;		
 }