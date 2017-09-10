<?php
if(!defined('AMPFORWP_CUSTOM_THEME')){
	define('AMPFORWP_CUSTOM_THEME',AMPFORWP_MAIN_PLUGIN_DIR."/".$ampforwp_design_selector);
}


	require_once(  AMPFORWP_CUSTOM_THEME . '/functions.php' );
	//Filter the Template files to override previous ones
	add_filter( 'amp_post_template_file', 'ampforwp_custom_header_file', 10, 2 );
	add_filter( 'amp_post_template_file', 'ampforwp_designing_custom_template', 10, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_custom_footer_file', 10, 2 );

	// Custom Header
	function ampforwp_custom_header_file( $file, $type ) {
		if ( 'header' === $type ) {
			$file = AMPFORWP_CUSTOM_THEME . '/header.php';
		}
		return $file;
	}

	// Custom Template Files
	function ampforwp_designing_custom_template( $file, $type, $post ) { 
	 global $redux_builder_amp;
		// Single file
	    if ( is_single() || is_page() ) {
			if('single' === $type && !('product' === $post->post_type )) {
				$file = AMPFORWP_CUSTOM_THEME . '/single.php';
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
	    $ampforwp_custom_post_page  =  ampforwp_custom_post_page();
	    // Homepage
		if ( is_home() ) {
			if ( 'single' === $type ) {
	        	$file = AMPFORWP_CUSTOM_THEME . '/index.php';
	        
		        if ($redux_builder_amp['amp-frontpage-select-option'] == 1) {
					$file = AMPFORWP_CUSTOM_THEME . '/page.php';
		        }
		        if ( $ampforwp_custom_post_page == "page" && ampforwp_name_blog_page() ) {
					$current_url = home_url( $GLOBALS['wp']->request );
					$current_url_in_pieces = explode( '/', $current_url );
				
					if( in_array( ampforwp_name_blog_page() , $current_url_in_pieces )  ) {
						 $file = AMPFORWP_CUSTOM_THEME . '/index.php';
					}  
				}
		    }
	    }
	    // is_search
		if ( is_search() ) {
	        if ( 'single' === $type ) {
	            $file = AMPFORWP_CUSTOM_THEME . '/search.php';
	        }
	    }
	    
	 	return $file;
	}

	// Custom Footer
	function ampforwp_custom_footer_file($file, $type ){
		if ( 'footer' === $type ) {
			$file = AMPFORWP_CUSTOM_THEME . '/footer.php';
		}
		return $file;
	}
	// Load the Core Styles of Custom Theme
	add_action('amp_css', 'ampforwp_custom_style');
	function ampforwp_custom_style() { 
		global $redux_builder_amp; 
		require_once( AMPFORWP_CUSTOM_THEME . '/style.php' );
		// Custom CSS
		echo $redux_builder_amp['css_editor']; 
	}

	// Loading Custom Google Fonts in the theme
	/*add_action( 'amp_post_template_head', 'amp_post_template_add_custom_google_font');
	function amp_post_template_add_custom_google_font( $amp_template ) {
	    $font_urls = $amp_template->get( 'font_urls', array() );
		$font_urls['source_serif_pro'] = 'https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600|Source+Sans+Pro:400,700';  ?>
	<link rel="stylesheet" href="<?php echo esc_url( $font_urls['source_serif_pro'] ); ?>">
	<?php }*/


