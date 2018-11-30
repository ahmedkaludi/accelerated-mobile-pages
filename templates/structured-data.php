<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// Structured Data Type
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_type', 20, 1 );
function ampforwp_structured_data_type( $metadata ) {
	if ( !is_array($metadata) ) {
		return $metadata;
	}
	global $redux_builder_amp, $post;
	$post_types 	= '';
	$set_sd_post 	= '';
	$set_sd_page 	= '';

	$set_sd_post 	= $redux_builder_amp['ampforwp-sd-type-posts'];
	$set_sd_page 	= $redux_builder_amp['ampforwp-sd-type-pages'];
	$post_types = ampforwp_get_all_post_types();

	if ( $post_types ) { // If there are any custom public post types.
    	foreach ( $post_types  as $post_type ) {

        	if ( isset( $post->post_type ) && ('page' == $post->post_type || 'post' == $post->post_type) ) {
        		continue;
        	}
        	
	       	if ( isset( $post->post_type ) && $post->post_type == $post_type ) {
        		if ( empty( $redux_builder_amp['ampforwp-sd-type-'.$post_type.''] ) && $redux_builder_amp['ampforwp-seo-yoast-description'] == 0 ) {
					return;
				}
				if(isset($metadata['@type']) && $metadata['@type']){
        			$metadata['@type'] = $redux_builder_amp['ampforwp-sd-type-'.$post_type.''];
        		}
        		return $metadata;
        	}
        }
    }

	if ( empty( $set_sd_post ) && is_single() && $redux_builder_amp['ampforwp-seo-yoast-description'] == 0 ) {;
		return;
	}

	if ( empty( $set_sd_page ) && is_singular( $post_type = 'page' ) && $redux_builder_amp['ampforwp-seo-yoast-description'] == 0 ) {
			return;
	}
	if ( isset( $post->post_type ) && 'post' == $post->post_type ) {
		if(isset($metadata['@type']) && $metadata['@type']){
			$metadata['@type'] = $set_sd_post;
		}
	}

	if ( (isset( $post->post_type ) && 'page' == $post->post_type) || ampforwp_is_front_page() || ampforwp_is_blog()) {
		if ( empty( $set_sd_page )){
			return;
		}
		if(isset($metadata['@type']) && $metadata['@type']){
			$metadata['@type'] = $set_sd_page;
		}
	} 

	return $metadata;
}
// VideoObject
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_video_thumb', 20, 1 );
if ( ! function_exists('ampforwp_structured_data_video_thumb') ) {
	function ampforwp_structured_data_video_thumb( $metadata ) {
		if ( !is_array($metadata) ) {
    		return $metadata;
    	}
		global $redux_builder_amp, $post;
		// VideoObject
		if ( isset($metadata['@type']) && 'VideoObject' == $metadata['@type'] ) {
			$post_image_id = '';
			$post_image_id = get_post_thumbnail_id( get_the_ID() );
			$post_image = wp_get_attachment_image_src( $post_image_id, 'full' );
			$structured_data_video_thumb_url = '';
			// If there's no featured image, take default from settings
			if ( false == $post_image ) {
				if ( ! empty( $redux_builder_amp['amporwp-structured-data-video-thumb-url']['url'] ) ) {
						$structured_data_video_thumb_url = $redux_builder_amp['amporwp-structured-data-video-thumb-url']['url'];
					}
			}
			// If featured image is present, take it as thumbnail
			else {
				$structured_data_video_thumb_url = $post_image[0];
			}
			$metadata['name'] = $metadata['headline'];
			$metadata['uploadDate'] = $metadata['datePublished'];
			$metadata['thumbnailUrl'] = $structured_data_video_thumb_url;
		}
		// Recipe
		if ( isset($metadata['@type']) && 'Recipe' == $metadata['@type'] ) {
			$metadata['name'] = $metadata['headline'];
		}
		return $metadata;
	}
}
// #1975 Product
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_product', 20, 1 );
if ( ! function_exists('ampforwp_structured_data_product') ) {
	function ampforwp_structured_data_product( $metadata ) {
		global $redux_builder_amp, $post;
		// Adding Product's Name and unsetting the Google unrecognized data for type Product
		if ( isset($metadata['@type']) && 'Product' == $metadata['@type'] ) {
			$metadata['name'] = $metadata['headline'];
			unset($metadata['dateModified']);
			unset($metadata['datePublished']);
			unset($metadata['publisher']);
			unset($metadata['author']);
			unset($metadata['headline']);
		}
		
		return $metadata;
	}
}