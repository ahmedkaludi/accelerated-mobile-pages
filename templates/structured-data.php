<?php

// Structured Data Type
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_type', 10, 2 );
function ampforwp_structured_data_type( $metadata , $post ){
	global $redux_builder_amp;
	$sd_type_posts = '';
	$sd_type_pages = '';
	$post_types = '';
	if( isset($redux_builder_amp['ampforwp-sd-type-posts']) ) {
		if( $redux_builder_amp['ampforwp-sd-type-posts'] == 1 ){
			$sd_type_posts = 'BlogPosting';
		}
		elseif($redux_builder_amp['ampforwp-sd-type-posts'] == 2 ){
			$sd_type_posts = 'NewsArticle';
			 
		}
		elseif($redux_builder_amp['ampforwp-sd-type-posts'] == 3  ){
			$sd_type_posts = 'Recipe';
			 
		}
		elseif($redux_builder_amp['ampforwp-sd-type-posts'] == 4  ){
			$sd_type_posts = 'Product';
			 
		}
	}
	if(  isset($redux_builder_amp['ampforwp-sd-type-pages'] ) ) {
		if( $redux_builder_amp['ampforwp-sd-type-pages'] == 1){ 
			$sd_type_pages = 'BlogPosting';
		}
		elseif( $redux_builder_amp['ampforwp-sd-type-pages'] == 2){ 
			$sd_type_pages = 'NewsArticle';
		}
		elseif( $redux_builder_amp['ampforwp-sd-type-pages'] == 3){ 
			$sd_type_pages = 'Recipe';
		}
		elseif( $redux_builder_amp['ampforwp-sd-type-pages'] == 4){ 
			$sd_type_pages = 'Product';
		}
	} 
	$post_types = ampforwp_get_all_post_types();
	if ( $post_types ) { // If there are any custom public post types.
    	foreach ( $post_types  as $post_type ) {
        	if($post->post_type == 'post'){
        		 if($sd_type_posts){
        			$metadata['@type'] = $sd_type_posts;
        		}
        	}
        	if($post->post_type == 'page'){
        		if($sd_type_posts){
        			$metadata['@type'] = $sd_type_pages;
        		}
        	}
        }
    }
   // $custom_post_types = get_option('ampforwp_custom_post_types');
	return $metadata;
}
