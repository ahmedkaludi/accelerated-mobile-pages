<?php
if ( ( (is_single() && 1 == ampforwp_get_setting('ampforwp-bread-crumb')) || (is_page() && ampforwp_get_setting('ampforwp_pages_breadcrumbs')) ) && !checkAMPforPageBuilderStatus(get_the_ID()) ) { 
    $home_non_amp = $archive_non_amp = '';
    if ( false == ampforwp_get_setting('ampforwp-homepage-on-off-support') ) {
        $home_non_amp = 'nonamp';
    }
    if ( false == ampforwp_get_setting('ampforwp-archive-support') ) {
        $archive_non_amp = 'nonamp';
    } ?>
<div class="amp-wp-content breadcrumb"> <?php 
    if ( ampforwp_yoast_breadcrumbs_output() ) {
        echo ampforwp_yoast_breadcrumbs_output();
    }
    else {  
    // Settings
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = ampforwp_translation(ampforwp_get_setting('amp-translator-breadcrumbs-homepage-text') , 'Homepage' );
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page 
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url(ampforwp_url_controller( get_home_url('', '/'), $home_non_amp )) . '" title="' . $home_title . '">' . $home_title . '</a></li>';

        if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                if ( false != $post_type_archive){
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' .esc_url(ampforwp_url_controller( $post_type_archive, $archive_non_amp )) . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>'; 
                }
                else {
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><span class="bread-cat bread-custom-post-type-' . $post_type . '">' . $post_type_object->labels->name . '</span></li>';  
                }
            }
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
                        $tags_breadcrumbs .= '<li class="item-tag item-tag-' . $tag_id . ' item-tag-' . $tag_name . '"><a class="bread-tag bread-tag-' . $tag_id . ' bread-tag-' . $tag_name . '" href="' . esc_url($tag_link) . '" title="' . $tag_name . '">' . $tag_name . '</a></li>';                
                    }
                    if(ampforwp_get_setting('ampforwp-bread-crumb-post')){
                        $tags_breadcrumbs .='<li class="item-post item-post-' . esc_attr(ampforwp_get_the_ID()) . '"><span class="bread-post">'.wp_kses_data( get_the_title(ampforwp_get_the_ID()) ). '</span></li>';
                    }
                    echo $tags_breadcrumbs;
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
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, false, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_id = get_cat_ID( $parents);
                    $cat_link = get_category_link($cat_id);
                    if(ampforwp_get_setting('ampforwp-archive-support-cat') == true && ampforwp_get_setting('ampforwp-archive-support') == true){
                            $cat_link = ampforwp_url_controller( $cat_link );
                    }
                    $cat_display .= '<li class="item-cat item-cat-' . $cat_id . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $parents. '" href="'. esc_url($cat_link).'" title="'.esc_attr($parents).'">'.esc_html($parents).'</a></li>';
                    if(ampforwp_get_setting('ampforwp-bread-crumb-post')){
                        $cat_display .='<li class="item-post item-post-' . esc_attr(ampforwp_get_the_ID()) . '"><span class="bread-post">'.wp_kses_data( get_the_title(ampforwp_get_the_ID()) ). '</span></li>';
                    }
                }
            }
            }
              
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
                echo $cat_display;
    
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . esc_url(ampforwp_url_controller( $cat_link, $archive_non_amp )) . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';                
            }  
              
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
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . esc_url(ampforwp_url_controller( get_permalink( $ancestor ), $archive_non_amp ))  . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                   
            } 
               
        }
        echo '</ul>';
    } ?>
</div>
<?php }