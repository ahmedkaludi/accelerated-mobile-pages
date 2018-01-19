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
    -ms-flex-preferred-size: calc(33.333% - 20px);
    flex-basis: calc(33.33% - 30px);
}
.cat_mod .cat_mod_l{
  line-height:0;
}
.cat_mod h4{
  border-bottom: 2px solid {{border_color_picker}};
  padding-bottom: 8px;
  margin-bottom: 5px;
}
.cat_mod_l amp-img{
  width:150px;
  height:150px;
}
.cat_mod .cat_mod_r{
  display:flex;
  flex-direction: column;
}
.cat_mod .cat_mod_r a{
  font-size: 20px;
  line-height: 25px;
  font-weight: 500;
  color: #191919;
  margin: 0px 0px 5px 0px;
}
.cat_mod .cat_mod_r p{
  color: #444;
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
              'container_css'=>'Design'
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
                'type'    =>'color-picker',
                'name'    =>'border_color_picker',
                'label'   =>'Border Color',
                'tab'   =>'container_css',
                'default' =>'#eee',
                'content_type'=>'css'
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
                   $contenthtml.= '<a href="'.trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR .'"><amp-img  class="ampforwp_wc_shortcode_img"  src="'. $thumb_url.'" width="'.$thumb_url_array[1].'" height="'.$thumb_url_array[2].'" layout="responsive"></amp-img></a>';	
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