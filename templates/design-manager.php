<?php

if ( is_customize_preview() ) {
	// Load all the elements in the customizer as we want all the elements in design-manager
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_title' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_meta_info' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_featured_image' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_content' );
} 


	$data = get_option( 'ampforwp_design' );
	if( isset( $data['elements'] ) || ! empty( $data['elements'] ) ){
		$options = explode( ',', $data['elements'] );
	};

	if ($options): foreach ($options as $key=>$value) {
		if ( ! is_customize_preview() ) {
			switch ($value) {
				case 'title:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_title' );
						break;
				case 'meta_info:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_meta_info' );
						break;
				case 'featured_image:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_featured_image' );
						break;
				case 'content:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_content' );
						break;
			}
		}
	}
	endif;
	

// File path
define('DESIGN_MANAGER_FILE_PATH', AMPFORWP_PLUGIN_DIR . 'templates/design-manager/');


// Post Title 
function ampforwp_add_element_the_title( $meta_parts ) {
	$meta_parts[] = 'ampforwp-the-title';
	return $meta_parts;
}

add_filter( 'amp_post_template_file', 'ampforwp_design_element_the_title', 10, 3 );

function ampforwp_design_element_the_title( $file, $type, $post ) {
	if ( 'ampforwp-the-title' === $type ) {
		$file = DESIGN_MANAGER_FILE_PATH.'title.php' ;
	}
	return $file;
}


// Meta Info
function ampforwp_add_element_meta_info( $meta_parts ) {
	$meta_parts[] = 'ampforwp-meta-info';
	return $meta_parts;
}

add_filter( 'amp_post_template_file', 'ampforwp_design_element_meta_info', 10, 3 );

function ampforwp_design_element_meta_info( $file, $type, $post ) {
	if ( 'ampforwp-meta-info' === $type ) {
		$file = DESIGN_MANAGER_FILE_PATH.'meta-info.php' ;
	}
	return $file;
}


// Featured Image
function ampforwp_add_element_featured_image( $meta_parts ) {
	$meta_parts[] = 'ampforwp-featured-image';
	return $meta_parts;
}

add_filter( 'amp_post_template_file', 'ampforwp_design_element_featured_image', 10, 3 );

function ampforwp_design_element_featured_image( $file, $type, $post ) {
	if ( 'ampforwp-featured-image' === $type ) {
		$file = DESIGN_MANAGER_FILE_PATH.'featured-image.php';
	}
	return $file;
}


// The Content
function ampforwp_add_element_the_content( $meta_parts ) {
	$meta_parts[] = 'ampforwp-the-content';
	return $meta_parts;
}

add_filter( 'amp_post_template_file', 'ampforwp_design_element_the_content', 10, 3 );

function ampforwp_design_element_the_content( $file, $type, $post ) {
	if ( 'ampforwp-the-content' === $type ) {
		$file = DESIGN_MANAGER_FILE_PATH.'content.php';
	}
	return $file;
}
?>
