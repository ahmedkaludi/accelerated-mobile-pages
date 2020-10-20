<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( is_customize_preview() ) {
	// Load all the elements in the customizer as we want all the elements in design-manager
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_title' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_meta_info' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_featured_image' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_content' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_meta_taxonomy' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_social_icons' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_comments' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_related_posts' );
	add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_bread_crumbs' );
}
	// Design Selector
add_action('pre_amp_render_post','ampforwp_design_selector', 11 );
function ampforwp_design_selector() {
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
    if( function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path)) {
	$design = ampforwp_get_setting('amp-design-selector');
	if ( empty( $design )){
    	$design = 4;
    }
    if ( 4 != $design) {
    	$data = get_option( 'ampforwp_design',array());
    }

	// Adding default Value
	if (empty($data)){
	 	$data['elements'] = "bread_crumbs:1,meta_info:1,title:1,featured_image:1,content:1,meta_taxonomy:1,social_icons:1,comments:1,related_posts:1";
	}
	
	if( isset( $data['elements'] ) || ! empty( $data['elements'] ) ){
		$options = explode( ',', $data['elements'] );
	};

	if ($options): foreach ($options as $key=>$value) {
		if ( ! is_customize_preview() ) {
			switch ($value) {
				case 'bread_crumbs:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_bread_crumbs' );
						break;		
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
				case 'meta_taxonomy:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_meta_taxonomy' );
						break;
				case 'social_icons:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_social_icons' );
						break;
				case 'comments:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_comments' );
						break;
				case 'related_posts:1':
						add_filter( 'ampforwp_design_elements', 'ampforwp_add_element_related_posts' );
						break;
				
			}
		}
	}
	endif;
}
    $design = '';
	$design = ampforwp_get_setting('amp-design-selector');
	if ( empty( $design )){
    	return 4;
    }

    if ( $design ) {
		if ( file_exists(AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. $design . '/style.php') ) {
			return ampforwp_get_setting('amp-design-selector');
		}
		elseif ( 4 == $design && file_exists(AMPFORWP_PLUGIN_DIR . 'templates/design-manager/swift/style.php') ) {
      			return ampforwp_get_setting('amp-design-selector');
    	}
		else {
			if ( file_exists( WP_PLUGIN_DIR.'/'.$design.'/functions.php' ) ){
	    		return $design;
			} else {
				return 4;
			}
		}
    	return 2;
    } 
    return 2;
}

add_action('pre_amp_render_post','ampforwp_stylesheet_file_insertion', 12 );
function ampforwp_stylesheet_file_insertion() {

        if ( ! ampforwp_design_selector() ) {
          $ampforwp_design_selector   = 4;
        } else {
          $ampforwp_design_selector  = ampforwp_design_selector();
        }
        // Add StyleSheet
        if ( file_exists(AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. $ampforwp_design_selector . '/style.php') && 4 != $ampforwp_design_selector ) {
	        //require AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. $ampforwp_design_selector . '/style.php';
	    }else {
	    	require AMPFORWP_PLUGIN_DIR."/components/theme-loader.php";
	    }
}
if(4 != ampforwp_design_selector()){
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_the_title', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_meta_info', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_featured_image', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_bread_crumbs', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_the_content', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_social_icons', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_meta_taxonomy', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_comments', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_design_element_related_posts', 10, 3 );
	add_filter('ampforwp_design_elements', 'ampforwp_empty_design_elements', 12);
}
// Post Title
function ampforwp_add_element_the_title( $meta_parts ) {
	$meta_parts[] = 'ampforwp-the-title';
	return $meta_parts;
}

function ampforwp_design_element_the_title( $file, $type, $post ) {
	if ( 'ampforwp-the-title' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/title.php' ;
	}
	return $file;
}


// Meta Info
function ampforwp_add_element_meta_info( $meta_parts ) {
	$meta_parts[] = 'ampforwp-meta-info';
	return $meta_parts;
}

function ampforwp_design_element_meta_info( $file, $type, $post ) {
	if ( 'ampforwp-meta-info' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/meta-info.php' ;
	}
	return $file;
}

// Featured Image
function ampforwp_add_element_featured_image( $meta_parts ) {
	$meta_parts[] = 'ampforwp-featured-image';
	return $meta_parts;
}

function ampforwp_design_element_featured_image( $file, $type, $post ) {
	if ( 'ampforwp-featured-image' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/featured-image.php';
	}
	return $file;
}

// Bread-Crumbs
function ampforwp_add_element_bread_crumbs( $meta_parts ) {
	$meta_parts[] = 'ampforwp-bread-crumbs';
	return $meta_parts;
}

function ampforwp_design_element_bread_crumbs( $file, $type, $post ) {
	if ( 'ampforwp-bread-crumbs' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/bread-crumbs.php' ;
	}
	return $file;
}
// The Content
function ampforwp_add_element_the_content( $meta_parts ) {
	$meta_parts[] = 'ampforwp-the-content';
	return $meta_parts;
}

function ampforwp_design_element_the_content( $file, $type, $post ) {
	if ( 'ampforwp-the-content' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/content.php';
	}
	return $file;
}

// Meta Texonomy
function ampforwp_add_element_meta_taxonomy( $meta_parts ) {
	$meta_parts[] = 'ampforwp-meta-taxonomy';
	return $meta_parts;
}

function ampforwp_design_element_meta_taxonomy( $file, $type, $post ) {
	if ( 'ampforwp-meta-taxonomy' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/meta-taxonomy.php';
	}
	return $file;
}

// Social Icons
function ampforwp_add_element_social_icons( $meta_parts ) {
	$meta_parts[] = 'ampforwp-social-icons';
	return $meta_parts;
}

function ampforwp_design_element_social_icons( $file, $type, $post ) {
	if ( 'ampforwp-social-icons' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/social-icons.php';
	}
	return $file;
}


// Comments
function ampforwp_add_element_comments( $meta_parts ) {
	$meta_parts[] = 'ampforwp-comments';
	return $meta_parts;
}

function ampforwp_design_element_comments( $file, $type, $post ) {
	if ( 'ampforwp-comments' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/comments.php';
	}
	return $file;
}

// Related Posts
function ampforwp_add_element_related_posts( $meta_parts ) {
	$meta_parts[] = 'ampforwp-related-posts';
	return $meta_parts;
}

function ampforwp_design_element_related_posts( $file, $type, $post ) {
	if ( 'ampforwp-related-posts' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/design-'. ampforwp_design_selector() .'/elements/related-posts.php';
	}
	return $file;
}

// Empty meta parts when Pagebuilder is enabled
function ampforwp_empty_design_elements($meta_parts) {
	if( checkAMPforPageBuilderStatus(get_the_ID()) ){
		$meta_parts = array();
		$meta_parts[] = 'ampforwp-the-content';
	}
	return $meta_parts;
} ?>