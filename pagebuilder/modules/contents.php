<?php		
 $output = '<div><h4>{{content_title}}</h4>		
 			<div>{{category_selection}}</div>		
 	</div>';		
 		
 		
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
 		'label' =>'Posts',		
 		'name' => 'contents',		
 		'fields' => array(		
 						array(		
 						'type'		=>'text',		
 						'name'		=>"content_title",		
 						'label'		=>'Title of content',		
 						'default'	=>'Category',		
 						),		
 						array(		
 							'type'	=>'select',		
 							'name'=>"category_selection",		
 							'label'=>"Select content type",		
 							'default'=>'recent_option',		
 							'options' => $options,		
 							'options_details'=>$categoriesArray		
 						),		
 						array(		
 						'type'		=>'text',		
 						'name'		=>"show_total_posts",		
 						'label'		=>'No of posts',		
 						'default'	=>'3',		
 						),
 						array(		
 						'type'		=>'select',
 						'name'		=>"ampforwp_show_excerpt",
 						'label'		=>"Show content excerpt(Default: yes)",		
						'default'	=>'yes',		
						'options'	=> '<option value="yes">Yes</option><option value="no">No</option>',		
						'options_details'=>array('yes'=>'Yes', 'no'=>'No')
 						)		
 					),		
 		'front_template'=> $output		
 );		
 function contentHtml($the_query,$fieldValues){		
 	$contenthtml = '';		
 	$ampforwp_show_excerpt = (isset($fieldValues['ampforwp_show_excerpt'])? $fieldValues['ampforwp_show_excerpt']: 'yes');		
 	if ( $the_query->have_posts() ) {		
         $contenthtml.= '<div class="amp-wp-content amp_cb_module amp-category-block"><ul>';		
         while ( $the_query->have_posts() ) {		
             $the_query->the_post();		
             $ampforwp_post_url = get_permalink();		
             $contenthtml.='<li class="amp-category-post">';		
                 if ( has_post_thumbnail() ) {		
                   $thumb_id = get_post_thumbnail_id();		
                   $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);		
                   $thumb_url = $thumb_url_array[0];		
                   $contenthtml.= '<a href="'.trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR .'"><amp-img  class="ampforwp_wc_shortcode_img"  src="'. $thumb_url.'" width="150" height="150" layout="responsive"></amp-img></a>';		
                 }		
 		
               $contenthtml.= '<a class="ampforwp_wc_shortcode_title" href="'. trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR.'">		
                   '.get_the_title().'		
               </a>'; 		
 		
               if( $ampforwp_show_excerpt == 'yes' ) { 		
 				if( has_excerpt() ) {		
                     $content = get_the_excerpt();		
                   } else {		
                     $content = get_the_content();		
                   }		
                 $contenthtml.= '<div class="ampforwp_wc_shortcode_excerpt"> 		
 							<p class="ampforwp_cat_wdgt_excerpt_text">		
 							'.wp_trim_words( strip_tags( strip_shortcodes( $content ) ) , '15'  ).'</p>		
 						</div>';		
 			} 		
 		
             $contenthtml.= '</li>';		
         }		
 		
       		
         $contenthtml.= '</ul></div>';		
 		
     }		
     /* Restore original Post Data */		
     wp_reset_postdata();		
     return $contenthtml;		
 }