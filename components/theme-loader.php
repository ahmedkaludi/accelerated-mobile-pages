<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	$amp_main_dir = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/swift';
	if ( 4 != $ampforwp_design_selector ) {
		$amp_main_dir = WP_PLUGIN_DIR.'/'. esc_attr($ampforwp_design_selector);
	}
	$amp_theme_dir = apply_filters('ampforwp_theme_dir', $amp_main_dir);
	if ( ! is_dir($amp_theme_dir)) {
		$amp_theme_dir  = $amp_main_dir;
	}
	define('AMPFORWP_CUSTOM_THEME', $amp_theme_dir );
	// Include functions.php 
	$function_file =  AMPFORWP_CUSTOM_THEME . '/functions.php';
	if ( ! file_exists($function_file)) {
		$function_file = $amp_main_dir .'/functions.php';
	}
	if ( file_exists($function_file)){
		require_once( $function_file );	
	}
	//Filter the Template files to override previous ones
	add_filter( 'amp_post_template_file', 'ampforwp_designing_custom_template', 10, 3 );

	// Custom Template Files
	function ampforwp_designing_custom_template( $file, $type, $post ) {
	 global $redux_builder_amp;

		// 404 Template
	 	if( 'single' === $type && is_404() ) {
			$file = AMPFORWP_CUSTOM_THEME . '/404.php';
	 	}
	 	// single Template
		if ( is_page() ) { 
			if( 'single' === $type && ! ('product' === $post->post_type) ) {
				$file = AMPFORWP_CUSTOM_THEME . '/page.php';
		 	}
		}
	    // Loop Template
	    if ( 'loop' === $type ) {
			$file = AMPFORWP_CUSTOM_THEME . '/loop.php';
		}
	    // Archive
		if ( is_archive() ) {
	        if ( 'single' === $type ) {
	            $file = AMPFORWP_CUSTOM_THEME . '/archive.php';
	        }
	    }
	    $ampforwp_custom_post_page = ampforwp_custom_post_page();
	    // Homepage
		if ( is_home() ) {
			if ( 'single' === $type ) {
	        	$file = AMPFORWP_CUSTOM_THEME . '/index.php';
	        
		        if ( $redux_builder_amp['amp-frontpage-select-option'] == 1 ) {
					$file = AMPFORWP_CUSTOM_THEME . '/page.php';
		        }
		        if ( ampforwp_is_blog() ) {
				 	$file = AMPFORWP_CUSTOM_THEME . '/index.php';
				}
		    }
	    }
	    // is_search
		if ( is_search() ) {
	        if ( 'single' === $type ) {
	            $file = AMPFORWP_CUSTOM_THEME . '/search.php';
	        }
	    }

	    //For template pages
	    switch ( true ) {
	    	case (is_tax()):
	    			$term = get_queried_object();
					$templates = array();
					if ( ! empty( $term->slug ) ) {
						$taxonomy = $term->taxonomy;
						$slug_decoded = urldecode( $term->slug );
						if ( $slug_decoded !== $term->slug ) {
							$templates[] = AMPFORWP_CUSTOM_THEME . "/taxonomy-$taxonomy-{$slug_decoded}.php";
						}
						$templates[] = AMPFORWP_CUSTOM_THEME . "/taxonomy-$taxonomy-{$term->slug}.php";
						$templates[] = AMPFORWP_CUSTOM_THEME . "/taxonomy-$taxonomy.php";
					}
					$templates[] = AMPFORWP_CUSTOM_THEME . "/taxonomy.php";
					foreach ( $templates as $key => $value ) {
						if ( 'single' === $type && file_exists($value) ) {
							$file = $value;
							break;
						}
					}
	    	break;
	    	case (is_category()):
	    		$category = get_queried_object();
				$templates = array();
				if ( ! empty( $category->slug ) ) {
					$slug_decoded = urldecode( $category->slug );
					if ( $slug_decoded !== $category->slug ) {
						$templates[] = AMPFORWP_CUSTOM_THEME . "/category-{$slug_decoded}.php";
					}
					$templates[] = AMPFORWP_CUSTOM_THEME . "/category-{$category->slug}.php";
					$templates[] = AMPFORWP_CUSTOM_THEME . "/category-{$category->term_id}.php";
				}
				$templates[] = AMPFORWP_CUSTOM_THEME . '/category.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case (is_tag()):
	    		$tag = get_queried_object();
				$templates = array();
				if ( ! empty( $tag->slug ) ) {
					$slug_decoded = urldecode( $tag->slug );
					if ( $slug_decoded !== $tag->slug ) {
						$templates[] = AMPFORWP_CUSTOM_THEME . "/tag-{$slug_decoded}.php";
					}
					$templates[] = AMPFORWP_CUSTOM_THEME . "/tag-{$tag->slug}.php";
					$templates[] = AMPFORWP_CUSTOM_THEME . "/tag-{$tag->term_id}.php";
				}
				$templates[] = AMPFORWP_CUSTOM_THEME . '/tag.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case is_author():
	    		$author = get_queried_object();

				$templates = array();

				if ( $author instanceof WP_User ) {
					$templates[] = AMPFORWP_CUSTOM_THEME . "/author-{$author->user_nicename}.php";
					$templates[] = AMPFORWP_CUSTOM_THEME . "/author-{$author->ID}.php";
				}
				$templates[] = AMPFORWP_CUSTOM_THEME . "/author.php";

				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case (is_archive()):
	    		$p_type = esc_attr(get_query_var( 'post_type' ));
	    		$post_types = array_filter( (array) $p_type );
				$templates = array();
				if ( count( $post_types ) == 1 ) {
					$post_type = reset( $post_types );
					$templates[] = AMPFORWP_CUSTOM_THEME . "/archive-{$post_type}.php";
				}
				$templates[] = AMPFORWP_CUSTOM_THEME . '/archive.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case (is_post_type_archive()):
	    		$post_type = get_query_var( 'post_type' );
				if ( is_array( $post_type ) )
					$post_type = reset( $post_type );

				$obj = get_post_type_object( $post_type );
				if ( ! ($obj instanceof WP_Post_Type) || ! $obj->has_archive ) {
					//return '';
					break;
				}
				$p_type = esc_attr(get_query_var( 'post_type' ));
				$post_types = array_filter( (array) $p_type );

				$templates = array();

				if ( count( $post_types ) == 1 ) {
					$post_type = reset( $post_types );
					$templates[] = AMPFORWP_CUSTOM_THEME . "/archive-{$post_type}.php";
				}
				$templates[] = AMPFORWP_CUSTOM_THEME . '/archive.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case is_single(): 
	    		$object = get_queried_object();

				$templates = array();

				if ( ! empty( $object->post_type ) ) {
					$template = get_page_template_slug( $object );
					if ( $template && 0 === validate_file( $template ) ) {
						$templates[] = AMPFORWP_CUSTOM_THEME.'/'.$template;
					}

					$name_decoded = urldecode( $object->post_name );
					if ( $name_decoded !== $object->post_name ) {
						$templates[] = AMPFORWP_CUSTOM_THEME . "/single-{$object->post_type}-{$name_decoded}.php";
					}

					$templates[] = AMPFORWP_CUSTOM_THEME . "/single-{$object->post_type}-{$object->post_name}.php";
					$templates[] = AMPFORWP_CUSTOM_THEME . "/single-{$object->post_type}.php";
				}

				$templates[] = AMPFORWP_CUSTOM_THEME . "/single.php";
				
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case is_page():
	    		$id = get_queried_object_id();
				$template = get_page_template_slug();
				$pagename = get_query_var('pagename');

				if ( ! $pagename && $id ) {
					// If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
					$post = get_queried_object();
					if ( $post )
						$pagename = $post->post_name;
				}

				$templates = array();
				if ( $template && 0 === validate_file( $template ) )
					$templates[] = AMPFORWP_CUSTOM_THEME.'/'.$template;
				if ( $pagename ) {
					$pagename_decoded = urldecode( $pagename );
					if ( $pagename_decoded !== $pagename ) {
						$templates[] = AMPFORWP_CUSTOM_THEME . "/page-{$pagename_decoded}.php";
					}
					$templates[] = AMPFORWP_CUSTOM_THEME . "/page-{$pagename}.php";
				}
				if ( $id )
					$templates[] = AMPFORWP_CUSTOM_THEME . "/page-{$id}.php";
				$templates[] = AMPFORWP_CUSTOM_THEME . "/page.php";

				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    }
	    // Polylang Frontpage #1779
	    if ( 'single' === $type && ampforwp_polylang_front_page() && true == $redux_builder_amp['amp-frontpage-select-option'] ) {
			$file = AMPFORWP_CUSTOM_THEME . '/page.php';
		}
		if ( ! file_exists($file)) {

			$exploded_path  =  explode('/', $file);
			$file_name  	= end($exploded_path);

			$amp_fallback_theme_dir = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/swift';

			$file = $amp_fallback_theme_dir .'/'. $file_name;
		}
	 	return $file;
	}