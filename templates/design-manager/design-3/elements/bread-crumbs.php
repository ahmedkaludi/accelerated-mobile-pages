<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; 
if ( ( (is_single() && 1 == ampforwp_get_setting('ampforwp-bread-crumb')) || (is_page() && ampforwp_get_setting('ampforwp_pages_breadcrumbs')) ) && !checkAMPforPageBuilderStatus(get_the_ID()) ) {   
    $home_non_amp = $archive_non_amp = '';
    if ( false == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        $home_non_amp = 'nonamp';
    }
    if ( false == $redux_builder_amp['ampforwp-archive-support'] ) {
        $archive_non_amp = 'nonamp';
    } ?>
<div class="amp-wp-content breadcrumb"> <?php  
    // Settings
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = ampforwp_translation($redux_builder_amp['amp-translator-breadcrumbs-homepage-text'] , 'Homepage' );
    if (function_exists('pll__')) {
        $home_title = pll__(esc_html__( ampforwp_get_setting('amp-translator-breadcrumbs-homepage-text'), 'accelerated-mobile-pages'));
    }
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() && !ampforwp_polylang_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . esc_attr($breadcrums_id) . '" class="' . esc_attr($breadcrums_class) . '">';
           
        // Home page 
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . ampforwp_url_controller( get_home_url('', '/'), $home_non_amp ) . '" title="' . esc_attr($home_title) . '">' . esc_html($home_title) . '</a></li>';

        if ( is_archive() && !is_tax() && !is_category() && !is_tag() && !is_author() ) {


            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
        } else if  ( is_author() ) {
                global $author;
                
                $userdata = get_userdata( $author ); 
                $author_url= get_author_posts_url($userdata->ID);
                $author_url = trailingslashit($author_url);
                // Display author name
                echo '<li class="item-current item-current-' . esc_attr($userdata->user_nicename) . '"><a class="bread-current bread-current-' . esc_attr($userdata->user_nicename) . '" title="' . esc_attr($userdata->display_name) . '" href="'. ampforwp_url_controller( $author_url, $archive_non_amp ). '">' . 'Author: ' . esc_html($userdata->display_name) . '</a></li>';

        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                if ( false != $post_type_archive){
                    echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '" href="' .ampforwp_url_controller( $post_type_archive, $archive_non_amp ) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . esc_html($post_type_object->labels->name) . '</a></li>'; 
                }
                else {
                    echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type ). '"><span class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '">' . esc_html($post_type_object->labels->name) . '</span></li>';  
                }             
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . esc_html($custom_tax_name) . '</strong></li>';
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                if ( false != $post_type_archive){
                    echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' .esc_attr($post_type) . '" href="' .ampforwp_url_controller( $post_type_archive, $archive_non_amp ) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . esc_html($post_type_object->labels->name) . '</a></li>'; 
                }
                else {
                    echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><span class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '">' . esc_html($post_type_object->labels->name) . '</span></li>';  
                }
            }
            /*Breadcrumb with tags Start*/
            $tags_breadcrumbs = '';
            if(ampforwp_get_setting('ampforwp-bread-crumb-type') == 'tags'){
                $post_tags = wp_get_post_tags($post->ID);
                if(!empty($post_tags)){
                    foreach( $post_tags as $post_obj){
                        $tag_name = $post_obj->name;
                        $tag_id = $post_obj->term_id;
                        $tag_name = $post_obj->name;
                        $tag_link = get_tag_link($tag_id);
                        if(ampforwp_get_setting('ampforwp-archive-support-tag') == true && ampforwp_get_setting('ampforwp-archive-support') == true){
                            $tag_link = ampforwp_url_controller( $tag_link );
                        }
                        $tags_breadcrumbs .= '<li class="item-tag item-tag-' . esc_attr($tag_id) . ' item-tag-' . esc_attr($tag_name) . '"><a class="bread-tag bread-tag-' . esc_attr($tag_id) . ' bread-tag-' . esc_attr($tag_name) . '" href="' . esc_url($tag_link) . '" title="'.esc_attr($tag_name).'">'.esc_html($tag_name).'</a></li>';                 
                    }
                    if(ampforwp_get_setting('ampforwp-bread-crumb-post')){
                        if (class_exists('WPSEO_Premium') && !empty(WPSEO_Meta::get_value( 'bctitle', ampforwp_get_the_ID()))) {
                            $bc_title = WPSEO_Meta::get_value( 'bctitle', ampforwp_get_the_ID() );
                        }else{
                            $bc_title = get_the_title(ampforwp_get_the_ID());
                        }
                            $tags_breadcrumbs .='<li class="item-post item-post-' . esc_attr(ampforwp_get_the_ID()) . '"><span class="bread-post">'.wp_kses_data( $bc_title ). '</span></li>';
                    } 
                    echo $tags_breadcrumbs; // escaped above
                }
            }
            if(ampforwp_get_setting('ampforwp-bread-crumb-type') == 'category'){
             // Get post category info
                $category = get_the_category();
                if(!empty($category)) {

                    // Get last category post is in
                    $last_category = array_values($category);
                    $last_category = end($last_category);
                      $category_name = get_category($last_category);
                    // Get parent any categories and create array
                    $get_cat_parents = rtrim(get_category_parents($last_category->term_id, false, '>'),'>');
                    if(class_exists( 'WPSEO_Options' )){
                        $primary_cateogory = get_post_meta(ampforwp_get_the_ID(), '_yoast_wpseo_primary_category', true);
                    if(isset($primary_cateogory) && $primary_cateogory!=""){
                        $pcname = get_the_category_by_ID($primary_cateogory);
                        $category_name = $pcname;
                        $get_cat_parents = rtrim(get_category_parents($primary_cateogory, false, '>'),'>');
                       }
                   }
                        // Get parent any categories and create array 
                        $cat_parents = explode('>',$get_cat_parents);
                    // Loop through parent categories and store in variable $cat_display
                    $cat_display = '';
                    foreach($cat_parents as $parents) {
                        $categories = get_the_category();
                        $cat_id = $categories[0]->cat_ID;
                        $cat_link = get_category_link($cat_id);
                         if(ampforwp_get_setting('ampforwp-archive-support-cat') == true && ampforwp_get_setting('ampforwp-archive-support') == true){
                            $cat_link = ampforwp_url_controller( $cat_link );
                        }
                        $cat_display .= '<li class="item-cat item-cat-' . $cat_id . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $parents. '" href="'. esc_url($cat_link).'" title="'.esc_attr($parents).'">'.esc_html($parents).'</a></li>';
                    }
                        if(ampforwp_get_setting('ampforwp-bread-crumb-post')){
                            if (class_exists('WPSEO_Premium') && !empty(WPSEO_Meta::get_value( 'bctitle', ampforwp_get_the_ID()))) {
                               $bc_title = WPSEO_Meta::get_value( 'bctitle', ampforwp_get_the_ID() );
                            }else{
                                $bc_title = get_the_title(ampforwp_get_the_ID());
                            }
                            $cat_display .='<li class="item-post item-post-' . esc_attr(ampforwp_get_the_ID()) . '"><span class="bread-post">'.wp_kses_data( $bc_title ). '</span></li>';
                        } 
                }
            }
            /*Breadcrumb with tags End*/
           
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                if ( $taxonomy_terms ) {
                    $cat_id         = $taxonomy_terms[0]->term_id;
                    $cat_nicename   = $taxonomy_terms[0]->slug;
                    $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                    $cat_link       = trailingslashit($cat_link);
                    $cat_name       = $taxonomy_terms[0]->name;
                }
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display; // escaped above
    
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . esc_attr($cat_id) . ' item-cat-' . esc_attr($cat_nicename) . '"><a class="bread-cat bread-cat-' . esc_attr($cat_id) . ' bread-cat-' . esc_attr($cat_nicename) . '" href="' . ampforwp_url_controller( $cat_link, $archive_non_amp ) . '" title="' . esc_attr($cat_name) . '">' . esc_attr($cat_name) . '</a></li>';                
            }  
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . esc_attr($ancestor) . '"><a class="bread-parent bread-parent-' . esc_attr($ancestor) . '" href="' . ampforwp_url_controller( get_permalink( $ancestor ), $archive_non_amp )  . '" title="' . esc_attr(get_the_title($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a></li>';
                }
                   
                // Display parent pages
                echo $parents; // escaped above
                   
                // Current page
                   
            } 
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . intval($term_id);
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . esc_attr($get_term_id) . ' item-tag-' . esc_attr($get_term_slug) . '"><strong class="bread-current bread-tag-' . esc_attr($get_term_id) . ' bread-tag-' . esc_attr($get_term_slug) . '">' . esc_html($get_term_name) . '</strong></li>';          
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . esc_attr(get_the_time('Y')) . '"><a class="bread-year bread-year-' . esc_attr(get_the_time('Y')) . '" href="' . esc_url(get_year_link( get_the_time('Y') )) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')) . esc_html(ampforwp_translation($redux_builder_amp['amp-translator-archives-text'], 'Archives')) . '</a></li>';
            
            // Month link
            echo '<li class="item-month item-month-' . esc_attr(get_the_time('m')) . '"><a class="bread-month bread-month-' . esc_attr(get_the_time('m')) . '" href="' . esc_attr(get_month_link( get_the_time('Y'), get_the_time('m') )) . '" title="' . esc_attr(get_the_time('M')) . '">' . esc_attr(get_the_time('M')) . esc_html(ampforwp_translation($redux_builder_amp['amp-translator-archives-text'], 'Archives')) . ' </a></li>';
            
               
            // Day display
            echo '<li class="item-current item-' . esc_attr(get_the_time('j')) . '"><strong class="bread-current bread-' . esc_attr(get_the_time('j')) . '"> ' . esc_attr(get_the_time('jS')) . ' ' . esc_attr(get_the_time('M')) . esc_html(ampforwp_translation($redux_builder_amp['amp-translator-archives-text'], 'Archives')) . ' </strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . esc_attr(get_the_time('Y')) . '"><a class="bread-year bread-year-' . esc_attr(get_the_time('Y')) . '" href="' . esc_url(get_year_link( get_the_time('Y') )) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')) . esc_html(ampforwp_translation($redux_builder_amp['amp-translator-archives-text'], 'Archives')) . ' </a></li>';
            
            // Month display
            echo '<li class="item-month item-month-' . esc_attr(get_the_time('m')) . '"><strong class="bread-month bread-month-' . esc_attr(get_the_time('m')) . '" title="' . esc_attr(get_the_time('M')) . '">' . esc_attr(get_the_time('M')) . esc_html(ampforwp_translation($redux_builder_amp['amp-translator-archives-text'], 'Archives')) . ' </strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . esc_attr(get_the_time('Y')) . '"><strong class="bread-current bread-current-' . esc_attr(get_the_time('Y')) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')) . esc_html(ampforwp_translation($redux_builder_amp['amp-translator-archives-text'], 'Archives')). ' </strong></li>';
               
        }   else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current item-current-' . esc_attr(get_query_var('paged')) . '"><strong class="bread-current bread-current-' . esc_attr(get_query_var('paged')) . '" title="Page ' . esc_attr(get_query_var('paged')) . '">'. esc_html(ampforwp_translation($redux_builder_amp['amp-translator-page-text'], 'Page')) . ' ' . esc_attr(get_query_var('paged')) . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . esc_attr(get_search_query()) . '"><strong class="bread-current bread-current-' . esc_attr(get_search_query()) . '" title="Search results for: ' . esc_attr(get_search_query()) . '">
            ' . esc_html(ampforwp_translation($redux_builder_amp['amp-translator-breadcrumbs-search-text'], 'Search results for')) . ': ' . esc_attr(get_search_query()) . '</strong></li>';
           
        } 
        echo '</ul>';
      
    }?>
</div>
<?php }