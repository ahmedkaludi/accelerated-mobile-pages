<?php		
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
require_once  ABSPATH . WPINC . '/category.php';
add_filter('ampforwp_content_module_args','ampforwp_content_module_pagination',10,2);
function ampforwp_content_module_pagination($args, $fieldValues){
  if(isset($fieldValues['pagination']) && $fieldValues['pagination'] == 1 ){
      if( isset($_GET['pageno']) && $_GET['pageno']!=''){
          $paged = intval($_GET['pageno']);
      }else{
          $paged = 1;
      }
      $offset = ( $paged - 1 ) * $args['posts_per_page'] + $args['offset'];
      $args['paged'] = $paged;
      $args['offset'] = $offset;
      
    return $args;
  }else{

    return $args;
  }
}
 $output = '{{if_condition_content_layout_type==1}}
            <div {{if_id}}id="{{id}}"{{ifend_id}} class="pb_mod cm {{user_class}}">
            {{if_content_title}}<h4>{{content_title}}</h4> {{ifend_content_title}}
                <div id="cat-jump{{id}}" class="wrap"><ul>{{category_selection}}</ul></div>
                {{pagination_links}}    
            </div>
          {{ifend_condition_content_layout_type_1}}
          ';
 

 $frontCss = '
{{if_condition_content_layout_type==1}}
.wrap{width:100%;display:inline-block;margin-top:10px;}

{{module-class}} .cm ul{
  display:grid;
  width:100%;
  grid-template-columns:1fr 1fr 1fr;
  grid-gap:30px;
}
{{module-class}} .cm ul li {
  list-style-type: none;
}
{{module-class}} .cm .cml{
  line-height:0;
}
{{module-class}} .cm {margin:{{margin_css}};padding:{{padding_css}};}
{{module-class}} .cm h4{border-bottom: 2px solid #eee;padding-bottom: 8px;margin-bottom: 5px;font-size:18px;color: #191919;font-weight: 600;}
{{module-class}} .cm .cmr{display:flex;flex-direction: column;margin-top: 6px;}
{{module-class}} .cm .cmr a{font-size: 16px;line-height: 1.3;font-weight: 500;color: #000;margin: 0px 0px 5px 0px;}
{{module-class}} .cm .cmr p{color: #555;font-size: 13px;line-height: 20px;letter-spacing: 0.10px;margin-bottom:0;}
{{module-class}} .cm .cml{width:100%;}
{{module-class}} .cmp a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
}
{{module-class}} .cmp a.active {
    background-color: dodgerblue;
    color: white;
}
{{module-class}} .cmp a:hover:not(.active) {background-color: #ddd;}
{{module-class}} .cmp{
    width: 100%;
    margin: 30px 0px 0px 0px;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: center;
}
{{module-class}} .cm .cmr p a{
  font-size:13px;
  color:#005be2;
}
@media(max-width:768px){
  {{module-class}} .cm ul{
    grid-template-columns:1fr;
    grid-gap:20px;
  }
  {{module-class}} .cm ul li{
    display:flex;
  }
  {{module-class}} .cml amp-img{width:100%;}
  {{module-class}} .cm .cml{
    margin-right: 20px;
  }
  {{module-class}} .cm .cmr{
    flex: 1 0 55%;
    margin-top: 0;
  }
}
@media(max-width:767px){
  
  {{module-class}} .cmp a{
    padding:5px 12px;
    font-size:16px;
  }
}
@media (max-width: 480px){
  {{module-class}} .cm ul li{
    display:inline-block;
  }
  {{module-class}} .cm .cml{
    margin:0px 0px 20px;
  }
  {{module-class}} .cm .cmr{
    flex: 1 0 100%;
  }
  
}
{{ifend_condition_content_layout_type_1}}
';
if(ampforwp_get_setting('amp-design-selector') == 3 || ampforwp_get_setting('amp-design-selector') == 2){
  $frontCss .= '@media (max-width: 480px){
  {{module-class}} .cm ul{
  width:80%;
  }
  }';
}
$options = '<option value="recent_option">Recent Posts</option>';
$post_types = '';
$categoriesArray = array();
if ( is_admin() ) {
  $post_types = get_post_types(array('public'=>true));
  $post_types = get_option('ampforwp_cpt_generated_post_types');
  $post_types['post'] = 'Post';
 $categories = get_categories( array(   
                   'orderby' => 'name',   
                   'order'   => 'ASC',
                   'number'  => 500   
               ) );   
 $categoriesArray = array('recent_option'=>'Recent Posts');   
 foreach($categories as $category){   
  $categoryName = htmlspecialchars(esc_html($category->name), ENT_QUOTES);
  $categoriesArray[$category->term_id] = $categoryName;
  $options.= '<option value="'.esc_attr($category->term_id).'">'.esc_html($categoryName).'</option>';   
 }    
}
 return array(    
    'label' =>'Category',   
    'name' => 'contents',
    'default_tab'=> 'customizer',
    'tabs' => array(
              'customizer'=>'Content',
              'layout' => 'Layout',
              'container_css'=>'Design',
              'advanced' => 'Advanced'
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
            'type'    =>'text',   
            'name'    =>"content_title",    
            'label'   =>'Category Block',
            'tab'     =>'customizer',
            'default' =>'Category', 
            'content_type'=>'html',
            ),
            array(
                'type'    =>'text',
                'name'    =>"id",
                'label'   =>'ID',
                'tab'   =>'advanced',
                'default' =>'',
                'content_type'=>'html'
            ),
            array(
                'type'    =>'text',
                'name'    =>"user_class",
                'label'   =>'Class',
                'tab'   =>'advanced',
                'default' =>'',
                'content_type'=>'html'
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
				    'type'		=>'text',
				    'name'		=>"ampforwp_pb_cat_pagination_next",
				    'label'		=>'Pagination For Next Label',
				    'tab'     =>'advanced',
				    'default'	=>'First',
				    'content_type'=>'html',
				    'required'  => array('pagination'=>'1'),
			    ),
			    array(
				    'type'		=>'text',
				    'name'		=>"ampforwp_pb_cat_pagination_last",
				    'label'		=>'Pagination For Last Label',
				    'tab'     =>'advanced',
				    'default'	=>'Last',
				    'content_type'=>'html',
				    'required'  => array('pagination'=>'1'),
			    ),
              array(    
              'type'  =>'select',   
              'name'  =>"post_type_selection",   
              'label' =>"Select Post Type",
              'tab'     =>'customizer',
              'default' =>'post',    
              'options' => $post_types,    
              'options_details'=>$post_types ,
              'content_type'=>'html',
              'ajax'  => true,
              'ajax_dep' => 'taxonomy_selection',
              'ajax_action' => 'ampforwp_pb_taxonomy'
            ),
            array(    
              'type'  =>'select',   
              'name'  =>"taxonomy_selection",   
              'label' => esc_html__("Select Taxonomy","accelerated-mobile-pages"),
              'tab'     =>'customizer',
              'default' =>'',    
              'options' => $options,    
              'options_details'=>$categoriesArray ,
              'content_type'=>'html',
              'ajax'  => true,
              'ajax_dep' => 'category_selection',
              'ajax_action' => 'ampforwp_pb_cats'
            ),        
            array(    
              'type'  =>'select',   
              'name'  =>"category_selection",   
              'label' =>"Select Category",
              'tab'     =>'customizer',
              'default' =>'recent_option',    
              'options' => $options,    
              'options_details'=>$categoriesArray ,
              'content_type'=>'html',
            ),    
            array(    
            'type'    =>'text',   
            'name'    =>"show_total_posts",
            'label'   =>'No. of Posts per Page',    
            'tab'     =>'customizer',
            'default' =>'3',
            'content_type'=>'html',
            ),
            array(    
            'type'    =>'text',   
            'name'    =>'posts_offset',
            'label'   => esc_html__('Offset','accelerated-mobile-pages'),  
            'tab'     =>'customizer',
            'default' =>'0',
            'content_type'=>'html',
            ),
            array(    
            'type'    =>'select',
            'name'    =>"ampforwp_show_excerpt",
            'label'   =>"Excerpt",
            'tab'     =>'customizer',
            'default' =>'yes',    
            'options' => '<option value="yes">Yes</option><option value="no">No</option>',    
            'options_details'=>array('yes'=>'Yes', 'no'=>'No'),
            'content_type'=>'html',
            ),
            array(    
            'type'    =>'text',
            'name'    =>"ampforwp_excerpt_length",
            'label'   =>"Excerpt Length",
            'tab'     =>'customizer',
            'default' =>'15',    
            'content_type'=>'html',
            'required'  => array('ampforwp_show_excerpt' => 'yes'),
            ),
            array(    
            'type'    =>'text',
            'name'    =>"ampforwp_read_more",
            'label'   =>esc_html__("Read More Text","accelerated-mobile-pages"),
            'tab'     =>'customizer',
            'default' =>'Read More',    
            'content_type'=>'html',
            'required'  => array('ampforwp_show_excerpt' => 'yes'),
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
            array(
                'type'    =>'checkbox_bool',
                'name'    =>"pagination",
                'tab'   =>'customizer',
                'default' => 0,
                'options' =>array(
                        array(
                          'label'=>'Pagination',
                          'value'=>1,
                        ),
                      ),
                'content_type'=>'html',
              ),
            array(    
              'type'    =>'text',   
              'name'    =>"show_no_page_links",    
              'label'   =>'No. of PageLinks to Show',
              'tab'     =>'customizer',
              'default' => 5, 
              'content_type'=>'html',
              'required'  => array('pagination' => 1),
            ),

            
          ),    
    'front_template'=> $output,
    'front_css'=>$frontCss,
    'front_common_css'=>'', 
    'front_loop_content'=>'  {{if_condition_content_layout_type==1}}
                          <li> 

                              <div class="cml"> 
                               <a href="{{ampforwp_post_url}}">
                               {{if_image}}<amp-img  class="ampforwp_wc_shortcode_img"  src="{{image}}" width="{{width}}" height="{{height}}" srcset="{{image_srcset}}" layout="responsive" alt="{{image_alt}}"> </amp-img>{{ifend_image}}</a>
                              </div>
                              <div class="cmr">
                                <a href="{{ampforwp_post_url}}">{{title}}</a>
                                {{excerptContent}}
                                {{loopdate}}
                                </div>
                            </li></a> 
                       {{ifend_condition_content_layout_type_1}}


                      
                          ',
 );   
 function ampforwp_contentHtml($the_query,$fieldValues,$loopHtml){  
  $contenthtml = '';    
  $ampforwp_show_excerpt = (isset($fieldValues['ampforwp_show_excerpt'])? $fieldValues['ampforwp_show_excerpt']: 'yes');
  $ampforwp_excerpt_length = (isset($fieldValues['ampforwp_excerpt_length'])? $fieldValues['ampforwp_excerpt_length']: 15);
  $ampforwp_excerpt_length = (int) $ampforwp_excerpt_length;
  $mob_pres_link = false;
  if(function_exists('ampforwp_mobile_redirect_preseve_link')){
    $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
  }
  if ( $the_query->have_posts() ) { 
         while ( $the_query->have_posts() ) {   
             $the_query->the_post();    
             $ampforwp_post_url = get_permalink();
             if(ampforwp_get_setting('ampforwp-amp-takeover') == true || $mob_pres_link == true){
                $ampforwp_post_url = user_trailingslashit($ampforwp_post_url);
             }else if(true == ampforwp_get_setting('amp-core-end-point')){
                $ampforwp_post_url = user_trailingslashit($ampforwp_post_url);
                $ampforwp_post_url = add_query_arg( 'amp', '', $ampforwp_post_url);
              }else{
                $ampforwp_post_url = user_trailingslashit($ampforwp_post_url) . AMPFORWP_AMP_QUERY_VAR;
                $ampforwp_post_url = user_trailingslashit($ampforwp_post_url);
             }
             $image = $height = $width = $image_alt = $image_srcset = ""; 
             if ( has_post_thumbnail() ) {  
                   $thumb_id = get_post_thumbnail_id();   
                   $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
                   $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true); 
                   $image_srcset  = wp_get_attachment_image_srcset( $thumb_id, 'full'); 
                   $image = $thumb_url_array[0];
                   $width = $thumb_url_array[1];
                   $height = $thumb_url_array[2];
              }
              if(ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src()){
                $image    = ampforwp_cf_featured_image_src();
                $width  = ampforwp_cf_featured_image_src('width');
                $height   = ampforwp_cf_featured_image_src('height');
              }
              if(!empty($image) && !empty($width) && !empty($height)){
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

                  $pb_content_width_height = apply_filters("ampforwp_pb_content_mod_set_height_width", $width, $height, $fieldValues);  
                  if(is_array($pb_content_width_height)){
                    list($new_width, $new_height) = $pb_content_width_height;
                    if ( !empty($new_width) && !empty($new_height) ) {
                      $width = $new_width; 
                      $height = $new_height; 
                    }   
                  }
                  if ( ampforwp_get_setting('ampforwp-retina-images') ) {
                      $resolution = '';
                      $resolution = 2;
                      if(ampforwp_get_setting('ampforwp-retina-images-res')){
                        $resolution = ampforwp_get_setting('ampforwp-retina-images-res');
                      }
                      $width = $width * $resolution;
                      $height = $height * $resolution;
                    }
                    if(!is_numeric($width) && !is_numeric($height)){
                      $width = '346';
                      $height = '188';
                    }     
              }

              $excerptContent = "";
              $read_more_link = "";
              $readMore = "";
              if( $ampforwp_show_excerpt == 'yes' ) {     
                   if( has_excerpt() ) {    
                     $content = get_the_excerpt();    
                   } else {   
                     $content = get_the_content();    
                   }  
                 if(isset($fieldValues['ampforwp_read_more']) && !empty($fieldValues['ampforwp_read_more']) ){
                    $readMore = $fieldValues['ampforwp_read_more'];
                    $read_more_link = '<a href="'.esc_url($ampforwp_post_url).'" > '.esc_html($readMore).'</a>';
                  }   
                 $excerptContent = '<p>'.wp_trim_words( strip_tags( strip_shortcodes( $content ) ) , (int) $ampforwp_excerpt_length ).$read_more_link.'</p>';
              }
               $loopdate = "";
               $loopdate =  human_time_diff(
                get_the_time('U', get_the_ID() ), 
                current_time('timestamp') ) .' '. ampforwp_translation( ampforwp_get_setting('amp-translator-ago-date-text'),
                'ago');
               $loopdate = apply_filters('ampforwp_modify_post_date',$loopdate);
               $loopdate = '<p>'.esc_html($loopdate).'</p>';      
               $title = get_the_title();
               $postid = get_the_ID();
               $author = get_the_author();
               $tags = get_the_tags(); 
               if(is_array($tags) && count($tags) > 0){  
                  $tags = $tags[0]->name;  
               }
              // get_the_author_meta( string $field = '', int $user_id = false );
               $postdate = get_the_date(  ' F j, Y', $postid );
              $rawhtml = str_replace(array(
                                "{{ampforwp_post_url}}",
                                "{{image}}",
                                "{{image_srcset}}",
                                "{{width}}",
                                "{{height}}",
                                "{{title}}",
                                "{{excerptContent}}",
                                "{{readMore}}",
                                "{{loopdate}}",
                                "{{authorname}}",
                                "{{postdate}}",
                                "{{image_alt}}",
                                "{{tags}}"
                                ), 
                              array(
                                $ampforwp_post_url,
                                $image,
                                $image_srcset,
                                $width,
                                $height,
                                $title,
                                $excerptContent,
                                $readMore,
                                $loopdate,
                                $author,
                                $postdate,
                                $image_alt,
                                $tags,
                              ), 
                              $loopHtml);
            $rawhtml = ampforwp_replaceIfContentConditional("ampforwp_post_url", $ampforwp_post_url, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("image", $image, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("image_srcset", $image_srcset, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("width", $width, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("height", $height, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("title", $title, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("excerptContent", $excerptContent, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("readMore", $readMore, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("loopdate", $loopdate, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("authorname", $author, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("postdate", $postdate, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("image_alt", $image_alt, $rawhtml);
            $rawhtml = ampforwp_replaceIfContentConditional("tags", $tags, $rawhtml);
            $rawhtml = apply_filters( 'ampforwp_pb_cntmod_rawhtml', $rawhtml );
            $contenthtml .= $rawhtml;
            
         }    
      
     }
     
     /* Restore original Post Data */   
     wp_reset_postdata();
     $pagination_links = ampforwp_cat_pagination_links($the_query,$fieldValues);
     //echo $contenthtml;
     //die;

     return array('contents'=>$contenthtml,'pagination_links' => $pagination_links);    
 }

 function  ampforwp_cat_pagination_links($the_query,$fieldValues){
        $pagination_links = '';
        $pagination_text = 'pageno';
        if( ampforwp_is_front_page()){
          $queryUrl = esc_url( ampforwp_url_controller(home_url()) );
        }else{
          $queryUrl = esc_url(ampforwp_url_controller(get_permalink(ampforwp_get_the_ID())));
        }
        if( isset($fieldValues['pagination']) && $fieldValues['pagination'] == 1){
      
        /*Pagination Sart*/
        $offset = $fieldValues['posts_offset'];
        $per_page = $the_query->query['posts_per_page'];
        $offset_num = ceil($offset/$per_page);
        
        if( $the_query->max_num_pages == $offset_num ){
          $total_num_pages = $the_query->max_num_pages;
        }else{
          $total_num_pages = $the_query->max_num_pages - $offset_num;
        }
        if(isset($_GET[$pagination_text]) && $_GET[$pagination_text]!='' ){
            $paged = intval($_GET[$pagination_text]);
        }else{
            $paged = 1;
        }
        $pagination_links .= '<div class="cmp">';
        if( $paged > 1){
          
          $first_page = add_query_arg( array( $pagination_text => 1 ), $queryUrl );
          $first_page .= '#cat-jump'. esc_html($fieldValues['id']);
          $prev_page = add_query_arg( array( $pagination_text => $paged - 1 ), $queryUrl );
          $nextLabel = (isset($fieldValues['ampforwp_pb_cat_pagination_next']) && !empty($fieldValues['ampforwp_pb_cat_pagination_next'])) ? $fieldValues['ampforwp_pb_cat_pagination_next'] : "Next";

          $pagination_links .= "<a class='pagi-first' href = ".esc_url($first_page)."> ".esc_html__($nextLabel,'accelerated-mobile-pages')."</a>";
          //$pagination_links .= "<a href = ".$prev_page."> Prev </a>";
        }

        $count = (integer) $fieldValues['show_no_page_links'];
        if( !$count ){
            $count = 3;
        }
        $startPage = max( 1, $paged - $count);
        $endPage = min( $total_num_pages, $paged + $count);
        for($i = $startPage ; $i <= $endPage ; $i++){
          if( $paged == $i && $startPage!=$endPage){
              $pagination_links .= "<a class='active' href='#/' >".esc_html__($i, 'accelerated-mobile-pages')."</a>";
          }else{
            $allPages = add_query_arg( array( $pagination_text => $i ), $queryUrl ) . '#cat-jump'.esc_html($fieldValues['id']);
            if($startPage!=$endPage){
              $pagination_links .= "<a href =".esc_url($allPages)." >".esc_html__($i, 'accelerated-mobile-pages')."</a>";
            }
          }

        }

        if( $total_num_pages != 1 && $paged < $total_num_pages ){      
          $next_page = add_query_arg( array( $pagination_text => $paged + 1 ), $queryUrl );
          //$pagination_links .= "<a  href =".$next_page." '> Next </a>";
        }
        if( $total_num_pages != $paged ){
	        $lastLabel = (isset($fieldValues['ampforwp_pb_cat_pagination_last']) && !empty($fieldValues['ampforwp_pb_cat_pagination_last'])) ? $fieldValues['ampforwp_pb_cat_pagination_last'] : "Last";
          $next_page = add_query_arg( array( $pagination_text => $total_num_pages ), $queryUrl );
          $next_page .= '#cat-jump'. esc_html($fieldValues['id']);
          $pagination_links .= "<a class='pagi-last' href =".esc_url($next_page)." >".esc_html__($lastLabel, 'accelerated-mobile-pages')."</a>";
        }
        $pagination_links .= '</div>';
        
        /*Pagination End*/
        }
        return  $pagination_links;
     }