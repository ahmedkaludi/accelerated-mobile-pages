<?php

// Structured Data Type
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_type', 20, 1 );
function ampforwp_structured_data_type( $metadata ){
	global $redux_builder_amp, $post;
	$post_types 	= '';
	$set_sd_post 	= '';
	$set_sd_page 	= '';	

	$set_sd_post 	= $redux_builder_amp['ampforwp-sd-type-posts'];
	$set_sd_page 	= $redux_builder_amp['ampforwp-sd-type-pages'];

	if ( empty( $set_sd_post ) ) {
		$set_sd_post = 'BlogPosting';
	}

	if ( empty( $set_sd_page ) ) {
		$set_sd_page = 'BlogPosting';
	}
	 
	$post_types = ampforwp_get_all_post_types();

	if ( $post_types ) { // If there are any custom public post types.
    	foreach ( $post_types  as $post_type ) {
    		
        	if($post->post_type == 'post'){
        		$metadata['@type'] = $set_sd_post;
        	}

        	if($post->post_type == 'page'){
        		$metadata['@type'] = $set_sd_page;
        	}

        	if( $post->post_type == 'page' ||  $post->post_type == 'post'  ){
        		continue;
        	}

        	if($post->post_type == $post_type){
        		if ( empty( $redux_builder_amp['ampforwp-sd-type-'.$post_type.''] ) ) {
					$redux_builder_amp['ampforwp-sd-type-'.$post_type.''] = 'BlogPosting';
				}
        		$metadata['@type'] = $redux_builder_amp['ampforwp-sd-type-'.$post_type.''];
        	}


        }
    }

	return $metadata;
}
