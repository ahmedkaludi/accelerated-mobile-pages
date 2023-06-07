<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Remove ResponsifyWP #1131
add_action('plugins_loaded', 'ampforwp_filter_remove_function_responsifywp');
function ampforwp_filter_remove_function_responsifywp(){
  if(is_plugin_active('responsify-wp/responsify-wp.php')){
	add_filter('rwp_add_filters','removeFilterOfResponsify');
	function removeFilterOfResponsify($filter){
	  return '';
	}
  }
}

add_action('pre_amp_render_post','ampforwp_thirdparty_compatibility');
function ampforwp_thirdparty_compatibility(){
	// Remove Schema theme Lazy Load #1170
	remove_filter( 'wp_get_attachment_image_attributes', 'mts_image_lazy_load_attr', 10, 3 );
	remove_filter('the_content', 'mts_content_image_lazy_load_attr');
	//Remove CSS header from the GoodLife Theme #2673
	remove_filter('amp_post_template_file', 'thb_custom_amp_templates');
	remove_action( 'amp_post_template_css', 'thb_amp_additional_css_styles' );
	// Viewport appear more than once in Zox news theme. #2971
	if ( function_exists( 'mvp_setup' ) && ampforwp_get_setting('amp-design-selector') != 4 ) {
		remove_action( 'amp_post_template_head','ampforwp_add_meta_viewport');
	}
	//Menu css is not loading when directory plus theme is active. #2963
	remove_filter('wp_nav_menu_args',array('AitMenu','modify_arguments'),100);
	// #3124 enfold theme shortcodes removed
	add_filter('the_content','ampforwp_remove_enfold_theme_shortcodes_tags');

	if ( in_array( 'wordproof-timestamp/wordproof-timestamp.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_filter('amp_post_template_data','ampforwp_compatibility_filter_tags_for_wordproof_plugin');
	}
	if ( in_array( 'opensea/opensea.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_filter('amp_post_template_data','ampforwp_compatibility_for_opensea_plugin');
	}
	add_filter('amp_post_template_data','ampforwp_add_target_attribute_in_form_tags');
	// AMP is not working due to JCH Optimize Pro plugin #3185
	remove_action('shutdown', 'jch_buffer_end', -1);
	//ShortPixel Plugin Compatibility to remove picture tag in amp #3439
	remove_filter( 'the_content', 'shortPixelConvertImgToPictureAddWebp', 10000 );
	remove_filter( 'the_excerpt', 'shortPixelConvertImgToPictureAddWebp', 10000 );
	remove_filter( 'post_thumbnail_html', 'shortPixelConvertImgToPictureAddWebp');
	//Validation error with Authentic theme #3535
	remove_filter( 'amp_post_template_data', 'csco_amp_post_template_data', 10, 2 );
	//Breaking the layout with diginex theme #4068
	if(function_exists('airkit_widgetFileAutoloader')){
		remove_filter( 'amp_post_template_file', 'airkit_amp_set_custom_style_path', 10, 3 );
	}
	//Validation errors in amp category page due to HotWP PRO #3455
	if(function_exists('hotwp_get_option') && is_category()){
		remove_all_filters('get_the_archive_title');
	}
	if(function_exists('thb_remove_youtube_controls')){
		remove_filter( 'embed_handler_html', 'thb_remove_youtube_controls', 10, 2 );
	}
	if (function_exists('gpress_switch_theme')) {
		remove_filter('the_content', 'add_data_atts');
	}
	if(class_exists( 'Jetpack_RelatedPosts' ) && false == ampforwp_get_setting('ampforwp-jetpack-related-posts')){
		$jprp = Jetpack_RelatedPosts::init();
        remove_filter( 'the_content', array( $jprp, 'filter_add_target_to_dom' ), 40 );
	}
	if(function_exists('heateor_sss_save_default_options') && false == ampforwp_get_setting('ampforwp-sassy_social-switch') ){
		add_filter('heateor_sss_disable_sharing','ampforwp_removing_sassy_social_share');
	}
	if(function_exists('defer_parsing_of_js')){
		remove_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
	}
	if(class_exists('gdlr_core_page_builder')){
		add_filter('the_content','ampforwp_gdlr_core_page_builder_content',12);
	}
	if(function_exists('vicomi_feelbacks_template')){
		remove_action('the_content', 'vicomi_feelbacks_template');
	}
	if(class_exists('FinalTiles_Gallery')){
		add_filter('wp_is_mobile','ampforwp_final_tiles_grid_gallery');
	}
	if(class_exists('Getty_Images')){
		add_filter( 'embed_oembed_html', 'ampforwp_get_gitty_image_embed',10,4);
		add_filter( 'ampforwp_the_content_last_filter','ampforwp_getty_image_compatibility',10);
	}
	if(function_exists('megashop_setup')){
        remove_filter( 'wp_nav_menu_args', 'TT_nav_menu_args' );
    }
    if (function_exists('vinkmag_action_setup')) {
    	remove_action( 'amp_post_template_head', 'vinkmag_amp_fonts', 1 );
    }
    if(function_exists('zeen_lazyload_images')){
        add_filter('zeen_lazy_embedded_images','ampforwp_zeen_lazyload');
    }
	$yoast_canonical = $yoast_canonical_post = $yoast_canonical_page = '';
	$yoast_canonical = get_option( 'wpseo_titles' );
	if(isset($yoast_canonical['noindex-post'])){
		$yoast_canonical_post = $yoast_canonical['noindex-post'];
	}
	if(isset($yoast_canonical['noindex-page'])){
		$yoast_canonical_page = $yoast_canonical['noindex-page'];
	}
	if (class_exists('WPSEO_Options') && 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && $yoast_canonical_post && $yoast_canonical_page && WPSEO_Meta::get_value( 'meta-robots-noindex', ampforwp_get_the_ID()) != 2) {
		add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
	}elseif(class_exists('WPSEO_Options') && 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && is_page() && $yoast_canonical_page ){
		add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
	}elseif(class_exists('WPSEO_Options') && 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && is_single() && $yoast_canonical_post ){
		add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
	}elseif (class_exists('WPSEO_Options') && 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && WPSEO_Meta::get_value( 'meta-robots-noindex', ampforwp_get_the_ID()) == 1) {
		add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
	}
}
function ampforwp_removing_sassy_social_share(){	
	return 1;
}

//Updater to check license
require_once AMPFORWP_PLUGIN_DIR . '/includes/updater/update.php';

//Facility to create child theme For AMP
	add_filter( 'amp_post_template_file', 'ampforwp_child_custom_header_file', 20, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_child_designing_custom_template', 20, 3 );
	add_filter( 'amp_post_template_file', 'ampforwp_child_custom_footer_file', 20, 3 );
	function ampforwp_theme_template_directry(){
		$folder_name = 'ampforwp';
		$folder_name = apply_filters('ampforwp_template_locate', $folder_name);	
		return get_stylesheet_directory() . '/' . $folder_name;
	}
	// Custom Header
	function ampforwp_child_custom_header_file( $file, $type, $post ) {
		$currentFile = $file;
		if ( 'header' === $type ) {
			$file = ampforwp_theme_template_directry() . '/header.php';
			
		}
		if ( 'header-bar' === $type ) {
			$file = ampforwp_theme_template_directry() . '/header-bar.php';
		}
		if(!file_exists($file)){
			$file = $currentFile;
		}
		return $file;
	}

	// Custom Template Files
	function ampforwp_child_designing_custom_template( $file, $type, $post ) {
	if(is_page() && !is_page_template()){
		return $file;
	}  
	 global $redux_builder_amp;
	 $currentFile = $file;
	 $filePath = ampforwp_theme_template_directry();
		// Single file
	    if ( is_single() ) {
			if( 'single' === $type && ! ('product' === $post->post_type) ) {
				$file = $filePath . '/single.php';
		 	}
		}
		if ( is_page() ) {
			if( 'single' === $type && ! ('product' === $post->post_type) ) {
				$file = $filePath . '/page.php';
		 	}
		}
	    // Loop Template
	    if ( 'loop' === $type ) {
			$file = $filePath . '/loop.php';
		}
	    // Archive
		if ( is_archive() ) {
	        if ( 'single' === $type ) {
	            $file = $filePath . '/archive.php';
	        }
	    }
	    if ( is_404() && 'single' === $type) {   
	        $file = $filePath . '/404.php';        
	    }
	    $ampforwp_custom_post_page = ampforwp_custom_post_page();
	    // Homepage
		if ( is_home() ) {
			if ( 'single' === $type ) {
	        	$file = $filePath . '/index.php';
	        
		        if ( $redux_builder_amp['amp-frontpage-select-option'] == 1 ) {
					$file = $filePath . '/page.php';
		        }
		        if ( ampforwp_is_blog() ) {
				 	$file = $filePath . '/index.php';
				}
		    }
	    }
	    // is_search
		if ( is_search() ) {
	        if ( 'single' === $type ) {
	            $file = $filePath . '/search.php';
	        }
	    }
	    // Template parts
	    if ( 4 != ampforwp_get_setting('amp-design-selector') ) {
	    	if ( 'ampforwp-the-title' === $type ) {
				$file = $filePath .'/elements/title.php' ;
			}
			if ( 'ampforwp-meta-info' === $type ) {
				$file = $filePath .'/elements/meta-info.php' ;
			}
			if ( 'ampforwp-featured-image' === $type ) {
				$file = $filePath .'/elements/featured-image.php' ;
			}
			if ( 'ampforwp-bread-crumbs' === $type ) {
				$file = $filePath .'/elements/bread-crumbs.php' ;
			}
			if ( 'ampforwp-the-content' === $type ) {
				$file = $filePath .'/elements/content.php' ;
			}
			if ( 'ampforwp-meta-taxonomy' === $type ) {
				$file = $filePath .'/elements/meta-taxonomy.php' ;
			}
			if ( 'ampforwp-social-icons' === $type ) {
				$file = $filePath .'/elements/social-icons.php' ;
			}
			if ( 'ampforwp-comments' === $type ) {
				$file = $filePath .'/elements/comments.php' ;
			}
			if ( 'ampforwp-simple-comment-button' === $type ) {
				$file = $filePath .'/elements/simple-comment-button.php' ;
			}
			if ( 'ampforwp-related-posts' === $type ) {
				$file = $filePath .'/elements/related-posts.php' ;
			}
	    }
	    //For template pages
	    switch ( true ) {
	    	case ampforwp_is_front_page():
				$templates[] = $filePath . "/front-page.php";
				 foreach ( $templates as $key => $value ) {
					if ( 'single' == $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case ampforwp_is_home():
				$templates[] = $filePath . "/home.php";
				$templates[] = $filePath . "/index.php";
				 foreach ( $templates as $key => $value ) { 
					if ( 'single' == $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				} 
	    	break;
	    	case (is_tax()):
	    			$term = get_queried_object();
					$templates = array();
					if ( ! empty( $term->slug ) ) {
						$taxonomy = $term->taxonomy;
						$slug_decoded = urldecode( $term->slug );
						if ( $slug_decoded !== $term->slug ) {
							$templates[] = $filePath . "/taxonomy-$taxonomy-{$slug_decoded}.php";
						}
						$templates[] = $filePath . "/taxonomy-$taxonomy-{$term->slug}.php";
						$templates[] = $filePath . "/taxonomy-$taxonomy.php";
					}
					$templates[] = $filePath . "/taxonomy.php";
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
						$templates[] = $filePath . "/category-{$slug_decoded}.php";
					}
					$templates[] = $filePath . "/category-{$category->slug}.php";
					$templates[] = $filePath . "/category-{$category->term_id}.php";
				}
				$templates[] = $filePath . '/category.php';
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
						$templates[] = $filePath . "/tag-{$slug_decoded}.php";
					}
					$templates[] = $filePath . "/tag-{$tag->slug}.php";
					$templates[] = $filePath . "/tag-{$tag->term_id}.php";
				}
				$templates[] = $filePath . '/tag.php';
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
					$templates[] = $filePath . "/author-{$author->user_nicename}.php";
					$templates[] = $filePath . "/author-{$author->ID}.php";
				}
				$templates[] = $filePath . "/author.php";

				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case (is_archive()):
	    	$ptype = esc_attr(get_query_var( 'post_type' ));
	    		$post_types = array_filter( (array) $ptype );
				$templates = array();
				if ( count( $post_types ) == 1 ) {
					$post_type = reset( $post_types );
					$templates[] = $filePath . "/archive-{$post_type}.php";
				}
				$templates[] = $filePath . '/archive.php';
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
				$ptype = esc_attr(get_query_var( 'post_type' ));
				$post_types = array_filter( (array) $ptype );

				$templates = array();

				if ( count( $post_types ) == 1 ) {
					$post_type = reset( $post_types );
					$templates[] = $filePath . "/archive-{$post_type}.php";
				}
				$templates[] = $filePath . '/archive.php';
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
						$templates[] = $filePath.'/'.$template;
					}

					$name_decoded = urldecode( $object->post_name );
					if ( $name_decoded !== $object->post_name ) {
						$templates[] = $filePath . "/single-{$object->post_type}-{$name_decoded}.php";
					}

					$templates[] = $filePath . "/single-{$object->post_type}-{$object->post_name}.php";
					$templates[] = $filePath . "/single-{$object->post_type}.php";
				}

				$templates[] = $filePath . "/single.php";
				
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
					$templates[] = $filePath.'/'.$template;
				if ( $pagename ) {
					$pagename_decoded = urldecode( $pagename );
					if ( $pagename_decoded !== $pagename ) {
						$templates[] = $filePath . "/page-{$pagename_decoded}.php";
					}
					$templates[] = $filePath . "/page-{$pagename}.php";
				}
				if ( $id )
					$templates[] = $filePath . "/page-{$id}.php";
				$templates[] = $filePath . "/page.php";

				foreach ( $templates as $key => $value ) {
					if ( 'single' == $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    }
	    if(!file_exists($file)){
			$file = $currentFile;
		}
	 	return $file;
	}

	// Custom Footer
	function ampforwp_child_custom_footer_file( $file, $type, $post ) {
		$currentFile = $file;
		if ( 'footer' === $type ) {
			$file = ampforwp_theme_template_directry() . '/footer.php';
		}
		if(!file_exists($file)){
			$file = $currentFile;
		}
		return $file;
	}

add_action("ampforwp_pagebuilder_layout_filter","ampforwp_add_upcomminglayouts");
function ampforwp_add_upcomminglayouts($layoutTemplate){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if(function_exists('ampforwp_upcomming_layouts_demo') && !is_plugin_active('amp-layouts/amp-layouts.php') ){
		$layouts_demo = ampforwp_upcomming_layouts_demo();
		if(is_array($layouts_demo)){
			foreach($layouts_demo as $k=>$val){
				$layoutTemplate[$val['name'].'-upcomming'] =  array(
									'Upcoming'=>array(
											'name'=> $val['name'],
											'preview_demo'=>$val['link'],
											'preview_img'=>$val['image'],
											'layout_json'=>'{"rows":[],"totalrows":"23","totalmodules":"94",}',
												)
										);
			}
		}
	}
		return $layoutTemplate;

}

if(is_admin()){
	add_action( 'redux/options/redux_builder_amp/saved', 'ampforwp_extension_individual_amp_page',10,2);
	function ampforwp_extension_individual_amp_page($options, $changed_values){
		if(isset($changed_values['amp-pages-meta-default']) && $options['amp-pages-meta-default']=='hide'){
			delete_transient('ampforwp_current_version_check');
		}
	}

	add_filter("redux/options/redux_builder_amp/data/category_list_hierarchy", 'ampforwp_redux_category_list_hierarchy',10,1);
	function ampforwp_redux_category_list_hierarchy($data){
		if(!is_array($data)){ $data = array(); }// To avoid PHP Fatal error:  Cannot use string offset as an array
		$cats = get_categories();
		if ( ! empty ( $cats ) ) {
	        foreach ( $cats as $cat ) {
	        	if($cat->category_parent!=0){
	        		$data[ $cat->category_parent ]['child'][$cat->term_id] = $cat->name;
	        	}else{
	            	$data[ $cat->term_id ]['name'] = $cat->name;
	        	}
	        }//foreach
	    } // If

	    $data['set_category_hirarchy'] = 1;
		return $data;
	}


}//Is_admin Closed

/**
 * Added filter to Add tags & attribute
 *  sanitizer in all content filters
 */
add_filter("amp_content_sanitizers",'ampforwp_allows_tag_sanitizer');
add_filter("ampforwp_content_sanitizers",'ampforwp_allows_tag_sanitizer');

function ampforwp_allows_tag_sanitizer($sanitizer_classes){
	$sanitizer_classes['AMP_Tag_And_Attribute_Sanitizer'] = array();
	return $sanitizer_classes;
};

add_action( 'activated_plugin', 'ampforwp_active_update_transient' );
function ampforwp_active_update_transient($plugin){
	delete_transient( 'ampforwp_themeframework_active_plugins' ); 
}
add_action( 'deactivated_plugin', 'ampforwp_deactivate_update_transient' );
function ampforwp_deactivate_update_transient($plugin){
	delete_transient( 'ampforwp_themeframework_active_plugins' ); 
	$check_plugin  = strpos($plugin, ampforwp_get_setting('amp-design-selector'));
	if ( false !== $check_plugin ) {
		$selectedOption = get_option('redux_builder_amp',true);		
		$selectedOption['amp-design-selector'] = 4;
		update_option('redux_builder_amp',$selectedOption);
	}
}
// #2894 Backward compatibility for SEO Options
add_action( 'upgrader_process_complete', 'ampforwp_update_seo_options');
function ampforwp_update_seo_options(){ 
	$current_seo = ampforwp_get_setting('ampforwp-seo-selection');
	if ( $current_seo != (1 || 2) ) {
		return;
	}
	if ( 1 == $current_seo || 2 == $current_seo ) {
		$selectedOption = get_option('redux_builder_amp',true);	
		if ( 1 == $current_seo ) {
			$selectedOption['ampforwp-seo-selection'] = 'yoast';
		}
		if ( 2 == $current_seo ) {
			$selectedOption['ampforwp-seo-selection'] = 'aiseo';
		}	
		update_option('redux_builder_amp',$selectedOption);
	}
}

//Compatibility with the footnotes plugin. #2447
add_action('amp_post_template_css','ampforwp_footnote_support');
if ( ! function_exists('ampforwp_footnote_support') ) {
function ampforwp_footnote_support(){
if(class_exists('MCI_Footnotes')){?>
.footnote_tooltip {
    display: none;
}
<?php 
}
}
}

// Simple Author Box Compatibility #2268
add_action('amp_post_template_css', 'ampforwp_simple_author_box');
function ampforwp_simple_author_box(){
	if( class_exists('Simple_Author_Box') ){ ?>
		.saboxplugin-wrap .saboxplugin-gravatar amp-img {max-width: 100px;height: auto;}
	<?php }
	// Compatibility with Use Any Font plugin #2774
	if ( function_exists('uaf_activate') ) {
		$uaf_use_absolute_font_path = get_option('uaf_use_absolute_font_path'); // Check if user want to use absolute font path.	
		if (empty($uaf_use_absolute_font_path)){
			$uaf_use_absolute_font_path = 0;
		}		
		$uaf_upload 	= wp_upload_dir();
		$uaf_upload_dir = $uaf_upload['basedir'];
		$uaf_upload_dir = $uaf_upload_dir . '/useanyfont/';
		$uaf_upload_url = $uaf_upload['baseurl'];
		$uaf_upload_url = $uaf_upload_url . '/useanyfont/';	
		$uaf_upload_url = preg_replace('#^https?:#', '', $uaf_upload_url);
		
		if ($uaf_use_absolute_font_path == 0){ // If user use relative path
			$url_parts = parse_url($uaf_upload_url);
			@$uaf_upload_url = "$url_parts[path]$url_parts[query]$url_parts[fragment]";
		}
		$fontsRawData 	= get_option('uaf_font_data');
		$fontsData		= json_decode($fontsRawData, true);
		if (!empty($fontsData)):
			foreach ($fontsData as $key=>$fontData): ?>
				@font-face {
					font-family: '<?php echo esc_html($fontData['font_name']); ?>';
					font-style: normal;
					src: url('<?php echo esc_url($uaf_upload_url.$fontData['font_path']); ?>.eot');
					src: local('<?php echo esc_html($fontData['font_name']) ?>'), url('<?php echo esc_url($uaf_upload_url.$fontData['font_path']) ?>.eot') format('embedded-opentype'), url('<?php echo esc_url($uaf_upload_url.$fontData['font_path']) ?>.woff') format('woff');
				}		            
            	.<?php echo esc_html($fontData['font_name']) ?>{font-family: '<?php echo esc_html($fontData['font_name']) ?>';}
        	<?php endforeach;
		endif;

		$fontsImplementRawData 	= get_option('uaf_font_implement');
		$fontsImplementData		= json_decode($fontsImplementRawData, true);
		if (!empty($fontsImplementData)):
			foreach ($fontsImplementData as $key=>$fontImplementData): ?>
				<?php echo $fontImplementData['font_elements']; // escaped above ?>{
					font-family: '<?php echo esc_html($fontsData[$fontImplementData['font_key']]['font_name']); ?>';
				}
			<?php endforeach;
		endif;	
	}
}

// WP-AppBox CSS #2791
add_action('amp_post_template_css', 'ampforwp_app_box_styles');
function ampforwp_app_box_styles(){
	if ( function_exists('wpAppbox_createAppbox') ) { ?>
		.wpappbox{clear:both;background-color:#F9F9F9;line-height:1.4;color:#545450;margin:16px 0;font-size:15px;border:1px solid #E5E5E5;box-shadow:0 0 8px 1px rgba(0,0,0,.11);border-radius:8px;display:inline-block;width:100%}.wpappbox a{transition:all .3s ease-in-out 0s}.wpappbox.compact .appicon{height:66px;width:68px;float:left;padding:6px;margin-right:15px}.appicon amp-img{max-width:92px;height:60px;border-radius:5%}.wpappbox a:hover amp-img{opacity:.9;filter:alpha(opacity=90);-webkit-filter:grayscale(100%)}.wpappbox .appicon{position:relative;height:112px;width:112px;float:left;padding:10px;background:#FFF;text-align:center;border-right:1px solid #E5E5E5;border-top-left-radius:6px;border-bottom-left-radius:6px;margin-right:10px}.wpappbox .appdetails{margin-top:15px}.wpappbox .appbuttons a{font-size:13px;box-shadow:0 1px 3px 0 rgba(0,0,0,.15);background:#F1F1F1;border-bottom:0;color:#323232;padding:3px 5px;display:inline-block;margin:12px 0 0;border-radius:3px;cursor:pointer;font-weight:400}.wpappbox .appbuttons a:hover{color:#fff;background:#111}.wpappbox div.applinks,div.wpappbox.compact a.applinks{float:right;position:relative;background:#FFF;text-align:center;border-left:1px solid #E5E5E5;border-top-right-radius:6px;border-bottom-right-radius:6px}.wpappbox div.applinks{height:112px;width:92px;display:block}.wpappbox .apptitle,.wpappbox .developer{margin-bottom:15px}.wpappbox .developer a{color:#333}.wpappbox .apptitle a{font-size:18px;font-weight:500;color:#333}.wpappbox .apptitle a:hover,.wpappbox .developer a:hover{color:#5588b5}.wpappbox .appbuttons span,.wpappbox .qrcode{display:none}.wpappbox.screenshots>div.screenshots{width:auto;margin:0 auto;padding:10px;clear:both;border-top:1px solid #E5E5E5}.wpappbox .screenshots .slider>ul>li{padding:0;margin:0 6px 0 0;list-style-type:none;display:inline-block}.wpappbox .screenshots .slider{overflow-x:scroll;overflow-y:hidden;height:320px;margin-top:0}.wpappbox .screenshots .slider>ul{display:inline-flex;width:100%}.wpappbox .screenshots .slider>ul>li amp-img{height:320px;}.wpappbox .slider li:before{display: none;}
		div.wpappbox div.appbuttons {position: absolute;bottom: 30px;width: 92px;}
		<?php $wpappbox_image_path = plugins_url().'/wp-appbox/img/'; ?>
		div.wpappbox:not(.colorful) div.applinks {filter: grayscale(100%);}
		div.wpappbox .applinks, div.wpappbox div.applinks{background-color: #FFF;}
		div.wpappbox.amazonapps a.applinks, div.wpappbox.amazonapps div.applinks {background: url(<?php echo esc_url($wpappbox_image_path.'amazonapps.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.appstore a.applinks, div.wpappbox.appstore div.applinks {background: url(<?php echo esc_url($wpappbox_image_path.'appstore.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.chromewebstore a.applinks, div.wpappbox.chromewebstore div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'chromewebstore.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.firefoxaddon a.applinks, div.wpappbox.firefoxaddon div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'firefoxaddon.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.googleplay a.applinks, div.wpappbox.googleplay div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'googleplay.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}	
		div.wpappbox.operaaddons a.applinks, div.wpappbox.operaaddons div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'operaaddons.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.steam a.applinks, div.wpappbox.steam div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'steam.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.windowsstore a.applinks, div.wpappbox.windowsstore div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'windowsstore.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.wordpress a.applinks, div.wpappbox.wordpress div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'wordpress.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox.xda a.applinks, div.wpappbox.xda div.applinks{background: url(<?php echo esc_url($wpappbox_image_path.'xda.png'); ?>);background-repeat: no-repeat;background-size: auto 42px;background-position: center 7px;}
		div.wpappbox div.stars-monochrome {background: url(<?php echo esc_url($wpappbox_image_path.'stars-sprites-monochrome.png'); ?>) no-repeat;}
		div.wpappbox div.rating-stars {width: 65px;height: 13px;margin-left: 5px;margin-top: 4px;display: inline-block;}
		div.wpappbox div.stars50 {background-position: 0 -130px;}
		div.wpappbox div.stars45 {background-position: 0 -117px;}
		div.wpappbox div.stars40 {background-position: 0 -104px;}
		div.wpappbox div.stars35 {background-position: 0 -91px;}	
		div.wpappbox div.stars30 {background-position: 0 -78px;}
		div.wpappbox div.stars25 {background-position: 0px -65px;}
		div.wpappbox div.stars20 {background-position: 0px -52px;}
		div.wpappbox div.stars15 {background-position: 0px -39px;}
		div.wpappbox div.stars10 {background-position: 0px -26px;}
		div.wpappbox div.stars5 {background-position: 0px -12px;}
		div.wpappbox div.stars0 {background-position: 0px -0px;}
		@media(max-width:500px){.appicon amp-img{max-width:70px;height:70px}.wpappbox .appicon{height:90px;width:90px;display:inline-block;vertical-align:middle;}.wpappbox .apptitle a{font-size:14px}.wpappbox{font-size:13px;text-align:center;padding:10px 0}.wpappbox .apptitle,.wpappbox .developer{margin-bottom:6px}.wpappbox .appdetails{text-align:left;padding-left:10px}.wpappbox .screenshots .slider{height:290px}.wpappbox .screenshots .slider>ul>li amp-img{max-width:160px;height:280px}
		.wpappbox div.applinks{display:none;}.wpappbox .screenshots .slider>ul {display: inline;white-space: nowrap;}}
	<?php 
	} // ampforwp_app_box_styles Function Ends 
}

// SEOPress Compatibility #1589
add_action('amp_post_template_head', 'ampforwp_seopress_social');
function ampforwp_seopress_social(){
	if ( 'seopress' == ampforwp_get_setting('ampforwp-seo-selection') ) {
		$options = $facebook = $twitter = $advanced_options = $seopress_social_og_title = $seopress_social_og_desc = '';
		$post_id = ampforwp_get_the_ID();
		$options = get_option("seopress_social_option_name");
		$advanced_options = get_option("seopress_advanced_option_name");
		if ( !empty($options) ) {
			if (isset($options['seopress_social_facebook_og'])) {
				global $wp;
				if (isset($advanced_options['seopress_advanced_advanced_trailingslash']) ) {
					$current_url = home_url(add_query_arg(array(), $wp->request));
				} else {
					$current_url = trailingslashit(home_url(add_query_arg(array(), $wp->request)));
				}
				if (is_search()) {
					$seopress_social_og_url = '<meta property="og:url" content="'.esc_url(htmlspecialchars(urldecode(get_home_url().'/search/'.get_search_query()))).'" />';
				} else {
					$seopress_social_og_url = '<meta property="og:url" content="'.esc_url(htmlspecialchars(urldecode($current_url),ENT_COMPAT, 'UTF-8')).'" />';
				}
				//Hook on post OG URL - 'seopress_social_og_url'
				if (has_filter('seopress_social_og_url')) {
					$seopress_social_og_url = apply_filters('seopress_social_og_url', $seopress_social_og_url);
			    }			
				echo $seopress_social_og_url."\n"; // escaped above
			}
			if (isset($options['seopress_social_facebook_og'])) {
				$seopress_social_og_site_name = '<meta property="og:site_name" content="'.esc_html(get_bloginfo('name')).'" />';
				//Hook on post OG site name - 'seopress_social_og_site_name'
				if (has_filter('seopress_social_og_site_name')) {
					$seopress_social_og_site_name = apply_filters('seopress_social_og_site_name', $seopress_social_og_site_name);
			    }
				echo $seopress_social_og_site_name."\n"; // escaped above
			}
			if (isset($options['seopress_social_facebook_og'])) {
				$seopress_social_og_locale = '<meta property="og:locale" content="'.esc_attr(get_locale()).'" />';
				//Polylang
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if ( is_plugin_active( 'polylang/polylang.php' ) || is_plugin_active( 'polylang-pro/polylang.php' )) {
					//@credits Polylang
					if (did_action('pll_init') && function_exists('PLL')) {
						$alternates = array();

						foreach ( PLL()->model->get_languages_list() as $language ) {
							if ( PLL()->curlang->slug !== $language->slug && PLL()->links->get_translation_url( $language ) && isset( $language->facebook ) ) {
								$alternates[] = $language->facebook;
							}
						}
						// There is a risk that 2 languages have the same Facebook locale. So let's make sure to output each locale only once.
						$alternates = array_unique( $alternates );

						foreach ( $alternates as $lang ) {
							$seopress_social_og_locale .= "\n";
							$seopress_social_og_locale .= '<meta property="og:locale:alternate" content="'.esc_attr($lang).'" />';
						}
					}
				}
				//Hook on post OG locale - 'seopress_social_og_locale'
				if (has_filter('seopress_social_og_locale')) {
					$seopress_social_og_locale = apply_filters('seopress_social_og_locale', $seopress_social_og_locale);
			    }
				if (isset($seopress_social_og_locale) && $seopress_social_og_locale !='') {
					echo $seopress_social_og_locale."\n"; // escaped above
				}
			}
			if (isset($options['seopress_social_facebook_og'])) {
				if (is_home() || is_front_page()) {
					$seopress_social_og_type = '<meta property="og:type" content="website" />';
				} elseif (is_singular('product') || is_singular('download')) {
					$seopress_social_og_type = '<meta property="og:type" content="product" />';
				} elseif (is_singular()) {
					global $post;
					$seopress_video_disabled     	= get_post_meta($post->ID,'_seopress_video_disabled', true);
				  	$seopress_video     			= get_post_meta($post->ID,'_seopress_video');

				  	if (!empty($seopress_video[0][0]['url']) && $seopress_video_disabled =='') {
						$seopress_social_og_type = '<meta property="og:type" content="video.other" />';
				  	} else {
				  		$seopress_social_og_type = '<meta property="og:type" content="article" />';
				  	}
				} 
				elseif (is_search() || is_archive() || is_404()) {
					$seopress_social_og_type = '<meta property="og:type" content="object" />';
				}
				if (isset($seopress_social_og_type)) {
					//Hook on post OG type - 'seopress_social_og_type'
					if (has_filter('seopress_social_og_type')) {
						$seopress_social_og_type = apply_filters('seopress_social_og_type', $seopress_social_og_type);
				    }
					echo $seopress_social_og_type."\n"; // escaped above
				}
			}
			if ( isset($options['seopress_social_facebook_og']) && ( isset($options['seopress_social_accounts_facebook']) && '' != $options['seopress_social_accounts_facebook'] ) ) {
				if (is_singular() && !is_home() && !is_front_page()) {
					global $post;
					$seopress_video_disabled     	= get_post_meta($post->ID,'_seopress_video_disabled', true);
				  	$seopress_video     			= get_post_meta($post->ID,'_seopress_video');

				  	if (!empty($seopress_video[0][0]['url']) && $seopress_video_disabled =='') {		
						//do nothing
					} else {
						$seopress_social_og_author = '<meta property="article:author" content="'.esc_url($options['seopress_social_accounts_facebook']).'" />';
						$seopress_social_og_author .= "\n";
						$seopress_social_og_author .= '<meta property="article:publisher" content="'.esc_url($options['seopress_social_accounts_facebook']).'" />';
					}
				}
				if (isset($seopress_social_og_author)) {
					//Hook on post OG author - 'seopress_social_og_author'
					if (has_filter('seopress_social_og_author')) {
						$seopress_social_og_author = apply_filters('seopress_social_og_author', $seopress_social_og_author);
				    }
					echo $seopress_social_og_author."\n"; // escaped above
				}
			}
			if (isset($options['seopress_social_facebook_og'])) {
				$title = '';
				$title = ampforwp_get_seopress_title();
				if ( is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_title',true) ){
					$title = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_title',true);
				}
				if ((is_tax() || is_category() || is_tag()) && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_title',true) )  {
					$title = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_title',true);
				}
				if ( '' != get_post_meta($post_id,'_seopress_social_fb_title',true) ){
					$title = get_post_meta($post_id,'_seopress_social_fb_title',true);
				}
				if ( '' == $title && '' != get_the_title() ){
					$title = get_the_title();
				}
				$seopress_social_og_title .= '<meta property="og:title" content="'.esc_attr($title).'" />'; 
			 	$seopress_social_og_title .= "\n";
			 	//Hook on post OG title - 'seopress_social_og_title'
				if (has_filter('seopress_social_og_title')) {
					$seopress_social_og_title = apply_filters('seopress_social_og_title', $seopress_social_og_title);
			    }
			    if (isset($seopress_social_og_title) && $seopress_social_og_title !='') {
			    	echo $seopress_social_og_title; // escaped above
			    }
			}

			if (isset($options['seopress_social_facebook_og'])) {
				$description = ampforwp_generate_meta_desc();
				if ( is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_desc',true) ) {
					$description = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_desc',true);
				}
				if (is_tax() || is_category() || is_tag() && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_desc',true) ) {
					$description = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_desc',true);
				}
				if ( '' != get_post_meta($post_id,'_seopress_social_fb_desc',true) ) {
					$description = get_post_meta($post_id,'_seopress_social_fb_desc',true);
				}
				$seopress_social_og_desc .= '<meta property="og:description" content="'.esc_html($description).'" />';
				$seopress_social_og_desc .= "\n";
				//Hook on post OG description - 'seopress_social_og_desc'
				if (has_filter('seopress_social_og_desc')) {
					$seopress_social_og_desc = apply_filters('seopress_social_og_desc', $seopress_social_og_desc);
			    }
			    if (isset($seopress_social_og_desc) && $seopress_social_og_desc !='') {
			    	echo $seopress_social_og_desc; // escaped above
				}
			}
			if (isset($options['seopress_social_facebook_og'])) {
				$url = '';
				if ( ampforwp_is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_img',true) ){
					$url = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_img',true);
				}
				if (is_tax() || is_category() || is_tag() && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_img',true) ) {
					$url = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_img',true);
				}
				if ( '' != get_post_meta(ampforwp_get_the_ID(),'_seopress_social_fb_img',true) ) {
					$url = get_post_meta(ampforwp_get_the_ID(),'_seopress_social_fb_img',true);
				}
				if ( '' == $url && has_post_thumbnail() ) {
					$url = get_the_post_thumbnail_url();
				}
				if (function_exists('attachment_url_to_postid') || has_post_thumbnail(ampforwp_get_the_ID()) ) {
					$image_id = attachment_url_to_postid( $url );
					if(empty($image_id)){
						$image_id = get_post_thumbnail_id( ampforwp_get_the_ID() );
					}
					if ( !$image_id ){
						return;
					}

					$image_src = wp_get_attachment_image_src( $image_id, 'full' );

					//OG:IMAGE
					$seopress_social_og_img = '';
					$seopress_social_og_img .= '<meta property="og:image" content="'.esc_url($url).'" />';
					$seopress_social_og_img .= "\n";

					//OG:IMAGE:SECURE_URL IF SSL
					if (is_ssl()) {
						$seopress_social_og_img .= '<meta property="og:image:secure_url" content="'.esc_url($url).'" />';
						$seopress_social_og_img .= "\n";
					}

					//OG:IMAGE:WIDTH + OG:IMAGE:HEIGHT
					if (!empty($image_src)) {
						$seopress_social_og_img .= '<meta property="og:image:width" content="'.esc_attr($image_src[1]).'" />';
						$seopress_social_og_img .= "\n";
						$seopress_social_og_img .= '<meta property="og:image:height" content="'.esc_attr($image_src[2]).'" />';
						$seopress_social_og_img .= "\n";
					}

					//OG:IMAGE:ALT
					if (get_post_meta($image_id, '_wp_attachment_image_alt', true) !='') {
						$seopress_social_og_img .= '<meta property="og:image:alt" content="'.esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)).'" />';
						$seopress_social_og_img .= "\n";
					}
					//Hook on post OG thumbnail - 'seopress_social_og_thumb'
					if (has_filter('seopress_social_og_thumb')) {
						$seopress_social_og_img = apply_filters('seopress_social_og_thumb', $seopress_social_og_img);
				    }
				    if (isset($seopress_social_og_img) && $seopress_social_og_img !='') {
			    		echo $seopress_social_og_img; // escaped above
				    }
				}
			}
			if (isset($options['seopress_social_facebook_og']) && isset($options['seopress_social_facebook_link_ownership_id'])) {
				$seopress_social_link_ownership_id = '<meta property="fb:pages" content="'.esc_attr($options['seopress_social_facebook_link_ownership_id']).'" />';	
				echo $seopress_social_link_ownership_id."\n"; // escaped above
			}
			if (isset($options['seopress_social_facebook_og']) && isset($options['seopress_social_facebook_link_ownership_id']) ) {
				$seopress_social_admin_id = '<meta property="fb:admins" content="'.esc_attr($options['seopress_social_facebook_admin_id']).'" />';		
				echo $seopress_social_admin_id."\n"; // escaped above
			}
			if (isset($options['seopress_social_facebook_og']) && isset($options['seopress_social_facebook_link_ownership_id']) ) {
				$seopress_social_app_id = '<meta property="fb:app_id" content="'.esc_attr($options['seopress_social_facebook_app_id']).'" />';		
				echo $seopress_social_app_id."\n"; // escaped above
			}
			if (isset($options['seopress_social_twitter_card'])) {
				if ( isset($options['seopress_social_twitter_card_img_size']) && $options['seopress_social_twitter_card_img_size'] =='large') {
					$seopress_social_twitter_card_summary = '<meta name="twitter:card" content="summary_large_image">';
				} else {
					$seopress_social_twitter_card_summary = '<meta name="twitter:card" content="summary" />';
				}
				//Hook on post Twitter card summary - 'seopress_social_twitter_card_summary'
				if (has_filter('seopress_social_twitter_card_summary')) {
					$seopress_social_twitter_card_summary = apply_filters('seopress_social_twitter_card_summary', $seopress_social_twitter_card_summary);
			    }
				echo $seopress_social_twitter_card_summary."\n"; // escaped above
			}
			if (isset($options['seopress_social_twitter_card']) && isset($options['seopress_social_accounts_twitter']) ) {
				$seopress_social_twitter_card_site = '<meta name="twitter:site" content="'.esc_attr($options['seopress_social_accounts_twitter']).'" />';	
				//Hook on post Twitter card site - 'seopress_social_twitter_card_site'
				if (has_filter('seopress_social_twitter_card_site')) {
					$seopress_social_twitter_card_site = apply_filters('seopress_social_twitter_card_site', $seopress_social_twitter_card_site);
			    }
				echo $seopress_social_twitter_card_site."\n"; // escaped above
			}
			if (isset($options['seopress_social_twitter_card'])) {
				//Init
				$seopress_social_twitter_card_creator ='';
				if ($options['seopress_social_twitter_card'] =='1' && get_the_author_meta('twitter') ) {

					$seopress_social_twitter_card_creator .= '<meta name="twitter:creator" content="@'.esc_attr(get_the_author_meta('twitter')).'" />';

				} elseif ($options['seopress_social_twitter_card'] =='1' && isset($options['seopress_social_accounts_twitter']) && $options['seopress_social_accounts_twitter'] !='' ) {
					$seopress_social_twitter_card_creator .= '<meta name="twitter:creator" content="'.esc_attr($options['seopress_social_accounts_twitter']).'" />';
				}
				//Hook on post Twitter card creator - 'seopress_social_twitter_card_creator'
				if (has_filter('seopress_social_twitter_card_creator')) {
					$seopress_social_twitter_card_creator = apply_filters('seopress_social_twitter_card_creator', $seopress_social_twitter_card_creator);
			    }
			    if (isset($seopress_social_twitter_card_creator) && $seopress_social_twitter_card_creator !='') {
			    	echo $seopress_social_twitter_card_creator."\n"; // escaped above
				}
			}
			if (isset($options['seopress_social_twitter_card'])) {
				$title = $seopress_social_twitter_card_title = '';
				$title = ampforwp_get_seopress_title();
				if ( is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_twitter_title',true) ){
					$title = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_twitter_title',true);
				}elseif ( is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_title',true) ){
					$title = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_title',true);
				}
				if ((is_tax() || is_category() || is_tag()) && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_twitter_title',true) )  {
					$title = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_twitter_title',true);
				}elseif ((is_tax() || is_category() || is_tag()) && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_title',true) )  {
					$title = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_title',true);
				}
				if ( '' != get_post_meta(ampforwp_get_the_ID(),'_seopress_social_twitter_title',true) ){
					$title = get_post_meta(ampforwp_get_the_ID(),'_seopress_social_twitter_title',true);
				}elseif ( '' != get_post_meta($post_id,'_seopress_social_fb_title',true) ){
					$title = get_post_meta($post_id,'_seopress_social_fb_title',true);
				}
				if ( '' == $title && '' != get_the_title() ){
					$title = get_the_title();
				}
				$seopress_social_twitter_card_title .= '<meta name="twitter:title" content="'.esc_attr($title).'" />';
				//Hook on post Twitter card title - 'seopress_social_twitter_card_title'
				if (has_filter('seopress_social_twitter_card_title')) {
					$seopress_social_twitter_card_title = apply_filters('seopress_social_twitter_card_title', $seopress_social_twitter_card_title);
			    }
			    if (isset($seopress_social_twitter_card_title) && $seopress_social_twitter_card_title !='') {
			    	echo $seopress_social_twitter_card_title."\n"; // escaped above
			    }
			}
			if (isset($options['seopress_social_twitter_card'])) {
				$seopress_social_twitter_card_desc = $description  = '';
				$description = ampforwp_generate_meta_desc();
				if ( is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_twitter_desc',true) ) {
					$description = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_twitter_desc',true);
				}elseif ( is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_desc',true) ) {
					$description = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_desc',true);
				}
				if (is_tax() || is_category() || is_tag() && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_twitter_desc',true) ) {
					$description = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_twitter_desc',true);
				}elseif (is_tax() || is_category() || is_tag() && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_desc',true) ) {
					$description = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_desc',true);
				}

				if ( '' != get_post_meta(ampforwp_get_the_ID(),'_seopress_social_twitter_desc',true) ) {
					$description = get_post_meta(ampforwp_get_the_ID(),'_seopress_social_twitter_desc',true);
				}elseif ( '' != get_post_meta(ampforwp_get_the_ID(),'_seopress_social_fb_desc',true) ) {
					$description = get_post_meta(ampforwp_get_the_ID(),'_seopress_social_fb_desc',true);
				}
				$seopress_social_twitter_card_desc .= '<meta name="twitter:description" content="'.esc_html($description).'" />';
				//Hook on post Twitter card description - 'seopress_social_twitter_card_desc'
				if (has_filter('seopress_social_twitter_card_desc')) {
					$seopress_social_twitter_card_desc = apply_filters('seopress_social_twitter_card_desc', $seopress_social_twitter_card_desc);
			    }
			    if (isset($seopress_social_twitter_card_desc) && $seopress_social_twitter_card_desc !='') {
			    	echo $seopress_social_twitter_card_desc."\n"; // escaped above
			    }
			}
			if (isset($options['seopress_social_twitter_card'])) {
				$url = '';
				if ( ampforwp_is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_twitter_img',true) ){
					$url = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_twitter_img',true);
				}elseif ( ampforwp_is_home() && '' != get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_img',true) ){
					$url = get_post_meta(get_option( 'page_for_posts' ),'_seopress_social_fb_img',true);
				}
				if (is_tax() || is_category() || is_tag() && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_twitter_img',true) ) {
					$url = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_twitter_img',true);
				}elseif (is_tax() || is_category() || is_tag() && '' != get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_img',true) ) {
					$url = get_term_meta(get_queried_object()->{'term_id'},'_seopress_social_fb_img',true);
				}
				if ( '' != get_post_meta(ampforwp_get_the_ID(),'_seopress_social_twitter_img',true) ) {
					$url = get_post_meta(ampforwp_get_the_ID(),'_seopress_social_twitter_img',true);
				}elseif ( '' != get_post_meta(ampforwp_get_the_ID(),'_seopress_social_fb_img',true) ) {
					$url = get_post_meta(ampforwp_get_the_ID(),'_seopress_social_fb_img',true);
				}
				if ( '' == $url && has_post_thumbnail() ) {
					$url = get_the_post_thumbnail_url();
				}
				if (function_exists('attachment_url_to_postid')) {
					$image_id = attachment_url_to_postid( $url );
					if ( !$image_id ){
						return;
					}

					$image_src = wp_get_attachment_image_src( $image_id, 'full' );

					//OG:IMAGE
					$seopress_twitter_img = '';
					$seopress_twitter_img .= '<meta property="twitter:image" content="'.esc_url($url).'" />';
					$seopress_twitter_img .= "\n";

					//OG:IMAGE:SECURE_URL IF SSL
					if (is_ssl()) {
						$seopress_twitter_img .= '<meta property="twitter:image:secure_url" content="'.esc_url($url).'" />';
						$seopress_twitter_img .= "\n";
					}

					//OG:IMAGE:WIDTH + OG:IMAGE:HEIGHT
					if (!empty($image_src)) {
						$seopress_twitter_img .= '<meta property="twitter:image:width" content="'.esc_attr($image_src[1]).'" />';
						$seopress_twitter_img .= "\n";
						$seopress_twitter_img .= '<meta property="twitter:image:height" content="'.esc_attr($image_src[2]).'" />';
						$seopress_twitter_img .= "\n";
					}

					//OG:IMAGE:ALT
					if (get_post_meta($image_id, '_wp_attachment_image_alt', true) !='') {
						$seopress_twitter_img .= '<meta property="twitter:image:alt" content="'.esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)).'" />';
						$seopress_twitter_img .= "\n";
					}

					//Hook on post OG thumbnail - 'seopress_social_og_thumb'
					if (has_filter('seopress_social_og_thumb')) {
						$seopress_twitter_img = apply_filters('seopress_social_og_thumb', $seopress_twitter_img);
				    }
				    if (isset($seopress_twitter_img) && $seopress_twitter_img !='') {
				    	echo $seopress_twitter_img; // escaped above
				    }
				}
			}
		}
	}
}

// yoast author twitter handle #2133
if ( ! function_exists('ampforwp_yoast_twitter_handle') ) {
	function ampforwp_yoast_twitter_handle() {
		$twitter = '';
		if (  class_exists('WPSEO_Frontend') ) {
		    global $post;
		    $twitter = get_the_author_meta( 'twitter', $post->post_author );
		}
		if($twitter){
			if ( function_exists('mvp_setup') ) {
				return ' <span><a class="zox_tw" href="https://twitter.com/'.esc_attr($twitter).'" target="_blank"></a></span>';
			}else{
				$parse = parse_url($twitter);	
				if(isset($parse['host']) && $parse['host'] == 'twitter.com'){
					$twitter_url = $twitter;
				}else{
					$twitter_url = 'https://twitter.com/'.esc_attr($twitter);
				}
				if(ampforwp_design_selector()==4){
					return ' <span><a class="author-tw" href="'.esc_url($twitter_url).'" target="_blank"></a></span>';
				}else{
					return '<a title="twitter share" href="'.esc_url($twitter_url).'" class="amp-social-icon-rounded-author amp-social-twitter">
				    <amp-img src="'.AMPFORWP_IMAGE_DIR . '/twitter-icon.webp'.'" width="16" height="16" ></amp-img></a>';
				}
			}
		    
		}
		return '';
	}
}
// #3124 enfold theme shortcodes removed
add_action('init','ampforwp_enfold_theme_compatibility',2);
if(!function_exists('ampforwp_enfold_theme_compatibility')){
	function ampforwp_enfold_theme_compatibility(){
		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
	  	$explode_path = explode('/', $url_path);  
	    if ( AMPFORWP_AMP_QUERY_VAR === end( $explode_path)   ) {
			remove_filter('avia_load_shortcodes','add_shortcode_folder',11);
	    }
	}
}
if(!function_exists('ampforwp_remove_enfold_theme_shortcodes_tags')){
	function ampforwp_remove_enfold_theme_shortcodes_tags($content){
		$content = preg_replace('/\[av_(.*?)]/', ' ', $content);
		$content = preg_replace('/\[\/av_(.*?)]/', ' ', $content);
		return $content;
	}
}

//Need to AMP compatible with this plugin HTTP / HTTPS Remover #3123
add_action('wp_loaded','ampforwp_http_remover_support');
function ampforwp_http_remover_support(){
	if ( class_exists('HTTP_HTTPS_REMOVER')){
	  	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
	  	if (true == ampforwp_get_setting('amp-core-end-point')) {
	  		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_QUERY),'/' );
	  	}
      	$explode_path = explode('/', $url_path);
	    if ( AMPFORWP_AMP_QUERY_VAR === end( $explode_path)) {
	        global $http_https_remover;
			remove_action('wp_loaded', array(
				$http_https_remover,
				'letsGo'
			), 99, 1);
	    }
	}
}
//AMP Woocommerce function
function ampforwp_woocommerce_conditional_check(){	
	$showSingleCss = false;
	if(!defined('AMP_WOOCOMMERCE_PLUGIN_URI')){
		$showSingleCss = false;
	}else{
		if(function_exists('is_product') && is_product()){
			$showSingleCss = true;
		}elseif(function_exists('is_cart') && is_cart()){
			$showSingleCss = true;
		}elseif(function_exists('is_shop') && is_shop()){
			$showSingleCss = true;
		}elseif(function_exists('is_checkout') && is_checkout()){
			$showSingleCss = true;
		}elseif(function_exists('is_account_page') && is_account_page()){
			$showSingleCss = true;
		}
	}
	return apply_filters('ampforwp_woocommerce_conditional_check', $showSingleCss);
}

// Gallery Images
function ampforwp_non_amp_gallery($matches){
	$images =  $matches[2];
	$images = preg_replace_callback("/<img(.*?)>/", function($m){
		return '<li class="mySlides fade">'.$m[0]. /* $m[0] is already sanitized, XSS OK */'</li>';
	}, $images);
	$imagesHTML = '<ul class="slideshow-container">'.$images. /* $images is already sanitized, XSS OK */'<a class="nonamp-prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="nonamp-next" onclick="plusSlides(1)">&#10095;</a></ul>';
	return $imagesHTML;
}
// MISTAPE PLUGIN COMPATIBILITY #3974
if(function_exists('deco_mistape_init')){
	add_action('amp_post_template_css', 'ampforwp_mistape_plugin_style'); 
}
if(!function_exists('ampforwp_mistape_plugin_style')){
	function ampforwp_mistape_plugin_style(){
		$css = '.mistape_caption{font-size:80%;opacity:.8}.mistape-logo svg{display:block;height:22px;width:22px;fill:#e42029}.mistape_caption .mistape-link{text-decoration:none;border:none;box-shadow:none}.mistape-link:hover{text-decoration:none;border:none}';
		echo ampforwp_css_sanitizer($css);
	}
}
if(!function_exists('ampforwp_mistape_plugin_compatibility')){
	function ampforwp_mistape_plugin_compatibility($content){
		if(function_exists('deco_mistape_init')){
			$rep = '<a href="https://mistape.com" target="_blank" rel="nofollow" class="mistape-link mistape-logo"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="-12 -10 39.9 40" enable-background="new -12 -10 39.9 40" xml:space="preserve">';
			$content = preg_replace('/<span\sclass=\"mistape-link-wrap">(.*?)<\/span>/', $rep.'$1</svg></a>', $content);
		}
		return $content;
	}
}
function ampforwp_valid_amp_componet_script(){
	$ce_valid_scripts = array('amp-3d-gltf','amp-3q-player','amp-access','amp-analytics','amp-access-laterpay','amp-access-poool','amp-accordion','amp-action-macro','amp-ad-exit','amp-ad','amp-embed','amp-addthis','amp-anim','amp-animation','amp-apester-media','amp-app-banner','amp-audio','amp-auto-ads','amp-autocomplete','amp-base-carousel','amp-beopinion','amp-bind','amp-bodymovin-animation','amp-brid-player','amp-brightcove','amp-byside-content','amp-call-tracking','amp-carousel','amp-connatix-player','amp-consent','amp-dailymotion','amp-date-countdown','amp-date-picker','amp-delight-player','amp-dynamic-css-classes','amp-embedly-card','amp-experiment','amp-facebook-comments','amp-facebook-like','amp-facebook-page','amp-facebook','amp-fit-text','amp-font','amp-form','amp-fx-collection','amp-fx-flying-carpet','amp-geo','amp-gfycat','amp-gist','amp-google-document-embed','amp-google-vrview-image','amp-hulu','amp-iframe','amp-ima-video','amp-image-lightbox','amp-image-slider','amp-imgur','amp-inputmask','amp-instagram','amp-install-serviceworker','amp-izlesene','amp-jwplayer','amp-kaltura-player','amp-lightbox-gallery','amp-lightbox','amp-link-rewriter','amp-list','amp-live-list','amp-mathml','amp-mega-menu','amp-megaphone','amp-minute-media-player','amp-form','amp-mustache','amp-next-page','amp-nexxtv-player','amp-o2-player','amp-ooyala-player','amp-orientation-observer','amp-pan-zoom','amp-pinterest','amp-playbuzz','amp-position-observer','amp-powr-player','amp-reach-player','amp-recaptcha-input','amp-redbull-player','amp-reddit','amp-riddle-quiz','amp-script','amp-selector','amp-sidebar','amp-skimlinks','amp-smartlinks','amp-social-share','amp-soundcloud','amp-springboard-player','amp-sticky-ad','amp-story-auto-ads','amp-story','amp-subscriptions-google','amp-subscriptions','amp-timeago','amp-truncate-text','amp-twitter','amp-user-notification','amp-video-docking','amp-video-iframe','amp-video','amp-vimeo','amp-vine','amp-viqeo-player','amp-viz-vega','amp-vk','amp-web-push','amp-wistia-player','amp-yotpo','amp-youtube','amp-story-player','amp-wordpress-embed');
	$ce_valid_scripts = apply_filters('ampforwp_valid_amp_component_script',$ce_valid_scripts);
	return $ce_valid_scripts;
}
//iframes are not working with WP optimize premium #4290
add_filter('wp_optimize_lazy_load_hook_these','ampforwp_wp_optimize_iframe');
function ampforwp_wp_optimize_iframe($content){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
	$explode_path = explode('/', $url_path);
	if ( AMPFORWP_AMP_QUERY_VAR === end( $explode_path)) {
		$content = array_flip($content);
		unset($content['the_content']);
	}
	return $content;
}
add_action('init','ampforwp_include_required_yoast_files');
function ampforwp_include_required_yoast_files(){
	if(class_exists('WPSEO_Premium') && defined('WPSEO_VERSION') && version_compare(WPSEO_VERSION,'15.8', '>=') && !method_exists('WPSEO_Meta_Columns', 'get_context_for_post_id')){
		return;
	}
	// Yoast SEO 14+ support helper class #4574
	$include_file = $include_yoast_files = $include_yoast_premium_files= '';
	$include_yoast_files = WP_PLUGIN_DIR . '/wordpress-seo/admin/class-meta-columns.php';
	$include_yoast_premium_files = WP_PLUGIN_DIR . '/wordpress-seo-premium/admin/class-meta-columns.php';
	if ( file_exists($include_yoast_files) && function_exists('wpseo_init') ) {
		$include_file = $include_yoast_files;
	}
	if ( file_exists($include_yoast_premium_files) && class_exists('WPSEO_Premium')) {
		$include_file = $include_yoast_premium_files;
	}
	if ( file_exists($include_file) ){
		require_once($include_file);
		class Ampforwp_Yoast_Data extends WPSEO_Meta_Columns {

			 public function get_context_for_post_id($id) { 
			 	if ( method_exists('WPSEO_Meta_Columns', 'get_context_for_post_id')) {
			 		return parent::get_context_for_post_id($id); 
			 	}
			 	return false;
			 }
		}
	}
}
// Load ampforwp markup prior to marfeel amp #4560
add_action('plugin_loaded','ampforwp_execute_amp_prior_marfeel', 10);
function ampforwp_execute_amp_prior_marfeel(){
  global $wp_filter;
  if(function_exists('mrfp_activate_marfeel_press') && isset($wp_filter['plugins_loaded']->callbacks[9])){
     $current_url = filter_input(INPUT_SERVER, 'REQUEST_URI');
     $amp_endpoint  = explode('/', $current_url);
		foreach ($wp_filter['plugins_loaded']->callbacks[9] as $key => $value) {
			   if((in_array('amp', $amp_endpoint ) || in_array('?amp', $amp_endpoint) || in_array('?amp=1', $amp_endpoint) ) && isset($value['function']['1']) && $value['function']['1'] == 'marfeel_press_init'){    
				     unset($wp_filter['plugins_loaded']->callbacks[9][$key]);
				}
		}
    }
    //Removed OMGF Host Google Fonts Locally in AMP #4775
    if(function_exists( 'omgf_pro_init' ) ){
        $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
        if( function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path)) {
            remove_action( 'plugins_loaded', 'omgf_pro_init', 49 );
        }
    }
}
function ampforwp_is_amp_inURL($url){
	if (ampforwp_get_setting('amp-core-end-point')) {
		global $wp;
		$url = home_url(add_query_arg(array($_GET), $wp->request));
		$urlArray = explode("/", $url);
		if( in_array( '?' . AMPFORWP_AMP_QUERY_VAR , $urlArray ) ) {
        	return true;
    	}
    	else {
    		foreach($urlArray as $index => $string) {
	        if (strpos($string, '?' . AMPFORWP_AMP_QUERY_VAR) !== FALSE)
	            return true;
	    	}
    	}
	}
	if (ampforwp_get_setting('ampforwp-amp-takeover')) {
		return true;
	}
	if(get_option('permalink_structure') == '' && isset($_GET['amp'])){
        return true;
    }
    if (class_exists('AMPforWP_Subdomain_Endpoint') && ampforwp_get_setting('amp-subdomain-url-format')) {
		return true;
	}
	$mob_pres_link = false;
    if(function_exists('ampforwp_mobile_redirect_preseve_link')){
       $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
    }
    if ($mob_pres_link == true) {
        return true;
    }
    $urlArray = explode("/", $url);
    if( !in_array( AMPFORWP_AMP_QUERY_VAR , $urlArray ) ) {
        return false;
    }
    return true;
}
function ampforwp_show_yoast_seo_local_map($content){
	if(function_exists('wpseo_local_seo_init') && preg_match('/wpseo-map-canvas/', $content)){
		$options = get_option( 'wpseo_local' );
		$local_address = $options['location_address'];
		$location_city = $options['location_city'];
		$location_state = $options['location_state'];
		$location_zipcode = $options['location_zipcode'];
		$location_country = $options['location_country'];
		$address = $local_address.", ".$location_city.", ".$location_state.", ".$location_zipcode.", ".$location_country;
		$location_coords_lat = $options['location_coords_lat'];
		$location_coords_long = $options['location_coords_long'];
		$googlemaps_api_key = $options['googlemaps_api_key'];
		$map_str = '<iframe width="350" height="250" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key='.esc_attr($googlemaps_api_key).'&q='.urlencode($address).'&center='.esc_attr($location_coords_lat).','.esc_attr($location_coords_long).'" allowfullscreen>
				</iframe>';
		$sanitizer = new AMPFORWP_Content( $map_str, array(), 
		apply_filters( 'ampforwp_content_sanitizers',
			array( 
					'AMP_Style_Sanitizer' 		=> array(),
					'AMP_Blacklist_Sanitizer' 	=> array(),
					'AMP_Img_Sanitizer' 		=> array(),
					'AMP_Video_Sanitizer' 		=> array(),
					'AMP_Audio_Sanitizer' 		=> array(),
					'AMP_Iframe_Sanitizer' 		=> array(
						'add_placeholder' 		=> true,
					)
				) ) );
		$map_str = $sanitizer->get_amp_content();
		$content = preg_replace('/(<div\sid="(.*?)"(.*?)class="wpseo-map-canvas(.*?)">)(.*?)(<\/div>)/s', '$1'.$map_str.'$6', $content);
		preg_match('/(<div\sid="(.*?)"(.*?)class="wpseo-map-canvas(.*?)">)(.*?)(<\/div>)/s', $content,$match);
		if(isset($match[4])){
			$content = str_replace($match[4], '', $content);
		}
		$content = preg_replace('/<div id="wpseo-directions-wrapper">(.*?)<\/div>/s','', $content);
	}
	return $content;
}
function ampforwp_final_tiles_grid_gallery($mobile){
	$mobile = false;
    return $mobile;
}
if(!function_exists('ampforwp_category_image_compatibility')){
	function ampforwp_category_image_compatibility($type='',$class=''){
		$cat_image = '';
		if(function_exists('z_taxonomy_image_url')){
			$cat_url 	= z_taxonomy_image_url();
			$r_width 	= 220;
			$r_height 	= 134;
			if(function_exists('ampforwp_get_retina_image_settings')){
				$ret_config = ampforwp_get_retina_image_settings(intval($r_width),intval($r_height));
				$r_width  = intval($ret_config['width']);
				$r_height = intval($ret_config['height']);
			}
			if (!empty($cat_url)) {
				$cat_image = '<div class="'.esc_attr($class).'"><amp-img src="'.esc_url($cat_url).'" width="'.intval($r_width).'" height="'.intval($r_height).'" layout="fixed"></amp-img></div>';
			}
		}
		if($type==''){
			$type='echo';
		}
		if($type=='return'){
			return $cat_image;
		}else if($type=='echo'){
			echo $cat_image;
		}
	}
}

function ampforwp_zeen_lazyload($lazyload){
	$lazyload = false;
    return $lazyload;
}

add_action('plugins_loaded', 'ampforwp_jetpack_boost_compatibility' , 1);
function ampforwp_jetpack_boost_compatibility(){
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );	
    if (function_exists('\Automattic\Jetpack_Boost\run_jetpack_boost') && function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path) && !is_admin()) {
 			remove_action( 'plugins_loaded', '\Automattic\Jetpack_Boost\run_jetpack_boost', 1 );
 	}
}
if(!function_exists('ampforwp_get_coauthor_id')){
	function ampforwp_get_coauthor_id()
	{
		$author_name = esc_attr(get_query_var('author_name'));
		$coauthor_id 	 = get_the_author_meta( 'ID' );
		if(!$coauthor_id)
		{
			$coauthors = get_the_coauthor_meta('login');
			foreach($coauthors as $key=>$value)
			{
			if($value==$author_name)
			{
				$coauthor_id = $key;
			}
			}
		}
		return $coauthor_id;
	}
}

if(!function_exists('ampforwp_get_coauthor_meta')){
	function ampforwp_get_coauthor_meta($meta_name=null)
	{ 
		if(!function_exists('get_the_coauthor_meta') || !$meta_name)
		{
			return '';
	    }
		$coauthor_id 	 = get_the_author_meta( 'ID' );
		if(!$coauthor_id)
		{
			$author_name = esc_attr(get_query_var('author_name'));
			$coauthors = get_the_coauthor_meta('login');
			foreach($coauthors as $key=>$value)
			{
				if($value==$author_name)
				{
					$coauthor_id = $key;
				}
			}
		}
		if(!$coauthor_id)
		{
			return '';
		}
		if($meta_name=='avatar_url')
		{
			$meta_value = get_avatar_url($coauthor_id,array('size'=>180));
		}
		else 
		{
			$meta_value = get_the_coauthor_meta($meta_name,$coauthor_id);
		}
		if(is_array($meta_value))
		{ 
			$meta_value=$meta_value[$coauthor_id];
		}
		return esc_html($meta_value);
	}
}

add_action('template_redirect', 'ampforwp_callrail_buffer_start', 0);
function ampforwp_callrail_buffer_start() {
	if(ampforwp_is_callrail_switch_active()){
		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );	
		if(function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path) && !is_admin()) {
			add_action('shutdown', 'ampforwp_callrail_buffer_stop', PHP_INT_MAX);
	    	ob_start('ampforwp_callrail_modify_content'); 
		}
	}
}
function ampforwp_callrail_buffer_stop() {
	if(ob_get_length() > 0) {
    	ob_end_flush();
    }
}
function ampforwp_callrail_modify_content($content) {
    //modify $content
    $config_url = $number = $analytics_url = '';
	$config_url = ampforwp_get_setting('ampforwp-callrail-config-url');
	$number = ampforwp_get_setting('ampforwp-callrail-number');
	$analytics_url = ampforwp_get_setting('ampforwp-callrail-analytics-url');
	$call_rail_analytics = '<amp-call-tracking config="'.esc_url($config_url).'"><a href="tel:'.esc_attr($number).'">'.esc_html($number).'</a></amp-call-tracking><amp-analytics config="'.esc_url($analytics_url).'"></amp-analytics>';
	$replace_meta = '<meta>';
	$content = preg_replace("#<meta (.*?)>#is", $replace_meta, $content);
	$content = str_replace($number, $call_rail_analytics, $content);
	$ct_test = '<amp-call-tracking config="'.esc_url($config_url).'"><a href="tel:'.esc_attr($number).'">'.esc_attr($number).'</a></amp-call-tracking>';
	$content = preg_replace('/<a(.*?)><amp-call-tracking(.*?)><a(.*?)<\/a>/', $ct_test, $content);

	return $content;
}

function ampforwp_is_callrail_switch_active()
{
	if(ampforwp_get_setting('ampforwp-callrail-switch')){
	    $config_url = $number = $analytics_url = '';
		$config_url = ampforwp_get_setting('ampforwp-callrail-config-url');
		$number = ampforwp_get_setting('ampforwp-callrail-number');
		$analytics_url = ampforwp_get_setting('ampforwp-callrail-analytics-url');
		if(!empty($config_url) && !empty($number) && !empty($analytics_url)){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

add_action('pre_amp_render_post', 'amp_saswp_faq_comp');
function amp_saswp_faq_comp(){
    if ( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
    	remove_shortcode('saswp_tiny_multiple_faq');
    	add_shortcode( 'saswp_tiny_multiple_faq', 'amp_saswp_tiny_multi_faq_render' );
    }
}

function amp_saswp_tiny_multi_faq_render( $atts, $content = null ){
    global $saswp_tiny_multi_faq;
    $output = '';
    $saswp_tiny_multi_faq = shortcode_atts(
        [
            'css_class' => '',
            'count'     => '1',
            'html'      => true,
            'elements'  => [],
        ], $atts );
    foreach ( $atts as $key => $merged_att ) {
        if ( strpos( $key, 'headline' ) !== false || strpos( $key, 'question' ) !== false || strpos( $key,
                'answer' ) !== false || strpos( $key, 'image' ) !== false ) {
            $saswp_tiny_multi_faq['elements'][ explode( '-', $key )[1] ][ substr( $key, 0, strpos( $key, '-' ) ) ] = $merged_att;
        }
    }
    if($saswp_tiny_multi_faq['html'] == 'true'){
        if( !empty($saswp_tiny_multi_faq['elements']) ){
            foreach ($saswp_tiny_multi_faq['elements'] as $value) {
                $output .= '<details>';
                $output .= '<summary>';
                $output .= '<'.esc_attr($value['headline']).'>';
                $output .=  esc_html($value['question']);
                $output .= '</'.esc_attr($value['headline']).'>';
                $output .= '</summary>';
                $output .= '<div>';
                if ( ! empty( $value['image'] ) ) {
                    $image_id       = intval( $value['image'] );                
                    $image_thumburl = wp_get_attachment_image_url( $image_id, [ 150, 150 ] );
                    $output .= '<figure>';
                    $output .= '<a href="'.esc_url(esc_url($image_thumburl)).'"><img class="saswp_tiny_faq_image" src="'.esc_url($image_thumburl).'"></a>';
                    $output .= '</figure>';
                }
                $output .= '<div class="saswp_faq_tiny_content">'.esc_html($value['answer']).'</div>';                
                $output .= '</div>';
                $output .= '</details>';
            }
        }
    }    
    return $output;
} 

add_action('pre_amp_render_post', 'amp_3d_viewer_comp');
function amp_3d_viewer_comp(){
    if ( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
    	remove_shortcode('3d_viewer', ['Shortcode', 'bp3dviewer_cpt_content_func']);
    	add_shortcode( '3d_viewer', 'amp_3dviewer_content_func' );
    }
}

function amp_3dviewer_content_func( $atts ){
	extract( shortcode_atts( array(
	    'id' => '',
	    'src' => '',
	    'alt' => '',
	    'width' => '100%',
	    'height' => '%',
	    'auto_rotate' => 'auto-rotate',
	    'camera_controls' =>'camera-controls',
	    'zooming_3d' => '',
	    'loading' => '',
	), $atts ) ); ob_start(); 
		
	// Options Data
	$modeview_3d = false;
	if($id){
	    $modeview_3d = get_post_meta( $id, '_bp3dimages_', true );
	}else {
	    $id = uniqid();
	}

	$attribute = [];
	
	if( class_exists( 'BP3D' ) && $modeview_3d && is_array($modeview_3d) ) {
		//https://playground.amp.dev/static/samples/glTF/DamagedHelmet.glb
	    $src = BP3D\Helper\Utils::isset2($modeview_3d, 'bp_3d_src', 'url', 'i-do-not-exist.glb');
	    $src = str_replace('http', 'https', $src);
	    $width = BP3D\Helper\Utils::isset2($modeview_3d, 'bp_3d_width', 'width', '100').BP3D\Helper\Utils::isset2($modeview_3d, 'bp_3d_width', 'unit', '%');
	    $height = BP3D\Helper\Utils::isset2($modeview_3d, 'bp_3d_height', 'height', '300').BP3D\Helper\Utils::isset2($modeview_3d, 'bp_3d_height', 'unit', 'px');
	    $camera_controls = $modeview_3d['bp_camera_control'] == 1 ? 'camera-controls' : '';
	    $alt            = !empty($modeview_3d['bp_3d_src']['url']) ? $modeview_3d['bp_3d_src']['title'] : '';
	    $auto_rotate    = $modeview_3d['bp_3d_rotate'] === '1' ? 'auto-rotate' : '';
	    $zooming_3d     = $modeview_3d['bp_3d_zooming'] === '1' ? '' : 'disable-zoom';
	    // Preload
	    $loading   = isset ($modeview_3d['bp_3d_loading']) ? $modeview_3d['bp_3d_loading'] : '';
	    $attribute = apply_filters('bp3d_model_attribute', [], $id, false);
	}
	if( !empty($src) ){ ?>
		<!-- 3D Model html -->
		<div class="bp_grand wrapper_<?php echo esc_attr($id) ?>">   
		<div class="bp_model_parent">
		    <amp-3d-gltf class="model" id="bp_model_id_<?php echo esc_attr($id); ?>" src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr($alt); ?>" layout="fixed" width="320" height="240"></amp-3d-gltf>
		</div>
		</div>
	<?php }
	$output = ob_get_clean(); return $output;
}

//JetPack Boost
add_action('wp','ampforwp_jetpack_defer_js_comp');
function ampforwp_jetpack_defer_js_comp(){
	if( (function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint()) || (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) ){
		add_filter( 'jetpack_boost_should_defer_js', '__return_false' );
	}
} 

add_filter('the_content','ampforwp_newsp_td_get_css', 12);
function ampforwp_newsp_td_get_css($content){
	$tdc_status = get_post_meta( ampforwp_get_the_ID(), 'tdc_content', true);
	if(!empty($tdc_status)){
		global $amp_td_custom_css;
		$amp_td_custom_css = '';
		preg_match_all('/<style>(.*?)<\/style>/s', $content, $matches);
		if($matches[1]){
			foreach ($matches[1] as $key => $value) {
				$amp_td_custom_css .= $value;
			}
		}
		$content = preg_replace('/data-img-url="(.*?)"/', 'data-img-url="$1" style="background-image:url($1)"', $content);
	}
	return $content;
}

add_action('amp_post_template_css','ampforwp_newsp_td_render_css');
function ampforwp_newsp_td_render_css(){
	$tdc_status = get_post_meta( ampforwp_get_the_ID(), 'tdc_content', true);
		if(!empty($tdc_status)){
		global $amp_td_custom_css;
		$cssData = '';
		$newspaper_css_url[] = get_template_directory_uri().'/style.css';
		$newspaper_css_url[] = TDC_URL_LEGACY . '/assets/css/td_legacy_main.css';
		if($newspaper_css_url){
			foreach ($newspaper_css_url as $key => $urlValue) {
		    $cssData = ampforwp_get_remote_content($urlValue);
		    $cssData = preg_replace("/\/\*(.*?)\*\//si", "", $cssData);
		    $newspaper_css .= preg_replace_callback('/url[(](.*?)[)]/', function($matches)use($urlValue){
		            $matches[1] = str_replace(array('"', "'"), array('', ''), $matches[1]);
		                if(!wp_http_validate_url($matches[1]) && strpos($matches[1],"data:")===false){
		                    $urlExploded = explode("/", $urlValue);
		                    $parentUrl = str_replace(end($urlExploded), "", $urlValue);
		                    return 'url('.$parentUrl.$matches[1].")"; 
		                }else{
		                    return $matches[0];
		                }
		            }, $cssData);
			}
	  }
		echo $newspaper_css;
		echo $amp_td_custom_css;
		if(class_exists('td_util') && class_exists('td_block')){
			echo td_util::remove_style_tag(td_block::get_common_css());
		}
	}
}

/**
 * Ampforwp_compatibility_filter_tags_for_wordproof_plugin function
 *
 * @since 1.0.86
 * @param mixed|string $amp_post_template_data
 * @return mixed|string
 */
function ampforwp_compatibility_filter_tags_for_wordproof_plugin( $amp_post_template_data ) 
{
	global $wpdb,$post;
	if(is_single() && isset($post->ID) && !empty($post->ID)){
		
	
		$results = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE post_id = %d AND meta_key LIKE %s",array( $post->ID,'_wordproof_hash_input_%' )),
				ARRAY_N
		);
		if($results)
		{
			$schema_data = reset($results);
			if(isset($schema_data[0])){
			 $schema_data = unserialize($schema_data[0]);
			}
			if(empty($schema_data)) { return $amp_post_template_data; }
			$content = $amp_post_template_data['post_amp_content'];
		// for w-certificate-button
		if( false !== strpos($content, "<w-certificate-button") ) { 
			add_action( 'amp_post_template_css', 'amp_wordproof_compatibility_css' );
			$findRegExforTag = '~<(w-certificate-button)(.*) text="(.*)"?>(.*)<\/\1>~mi';
			$content = preg_replace( $findRegExforTag, "<button on='tap:w-certificate-button'>$3</button>", $content);
		}
		 
		 $lightbox_content = '<amp-lightbox id="w-certificate-button" layout="nodisplay" scrollable>';
		 $lightbox_content.='<div class="amp_wordproof_lightbox" role="button" tabindex="0" on="tap:w-certificate-button.close">';
		 $lightbox_content.='<svg xmlns="http://www.w3.org/2000/svg" class="shield"><use xlink:href="#shield"></use><symbol id="shield" viewBox="0 0 44 58"><path d="M21.799.018c1.463-.176 3.371 1.017 4.736 1.475 4.102 1.375 8.177 2.9 12.235 4.405 1.344.5 4.237.945 4.939 2.296.513.989.191 2.694.191 3.783v8.875c0 8.06.633 16.427-3.742 23.623-1.15 1.889-2.563 3.55-4.151 5.088-1.867 1.807-4.078 3.306-6.315 4.621a81.965 81.965 0 01-5.13 2.788c-.766.38-1.626.968-2.5 1.025-.857.055-1.763-.595-2.5-.96-2.019-1.002-4.003-2.057-5.92-3.24-2.533-1.565-4.924-3.364-6.961-5.537C-.563 40.532.091 30.113.091 20.33v-8.353c0-1.066-.301-2.682.192-3.654.77-1.517 3.831-2.007 5.334-2.525 3.657-1.26 7.287-2.627 10.92-3.96 1.643-.602 3.516-1.61 5.262-1.82m0 3.817c-1.708.222-3.526 1.221-5.131 1.822-2.834 1.06-5.737 1.947-8.552 3.057-.936.37-3.805.823-4.262 1.752-.37.754-.08 2.244-.08 3.077v7.309c0 8.573-.77 17.4 5.19 24.406 1.563 1.837 3.498 3.303 5.467 4.68 1.675 1.17 3.484 2.1 5.263 3.095.63.352 1.62 1.068 2.368 1.021.745-.047 1.602-.686 2.236-1.04 1.46-.817 2.917-1.598 4.342-2.48a30.632 30.632 0 005.915-4.754c6.455-6.7 5.662-15.868 5.662-24.406v-7.7c0-.864.306-2.428-.08-3.208-.424-.86-3.243-1.385-4.13-1.71-3.282-1.204-6.588-2.346-9.867-3.559-1.192-.441-3.056-1.53-4.341-1.362m-1.053 32.417h-.132l-6.183-6.134c-.48-.476-2.081-1.63-2.078-2.35.004-.827 1.785-2.058 2.341-2.61 1.521 1.098 2.898 2.683 4.188 4.042.408.43 1.209 1.572 1.864 1.564.814-.01 2.082-1.798 2.631-2.342l6.447-6.395c.518-.515 1.588-2.044 2.368-2.064.793-.02 2.65 2.02 2.187 2.716-1.094 1.638-3.023 3.048-4.424 4.438z" fill="currentColor"></path></symbol></svg>';
		 if(isset($schema_data->dateCreated)){
		  $datetime = new DateTime($schema_data->dateCreated);
		  $lightbox_content.= '<h5>Last edited '.esc_attr($datetime->format('F j, Y at h:i A')) .' </h5>';
		 }
		 $lightbox_content.= '<h4>This information did not change since the last timestamp</h4><p>This is important, because it proves that the content has not been tampered with and it can be trusted.<p>';
		 $lightbox_content.= '</div></amp-lightbox>';
	
		 // for w-certificate
		if( false !== strpos($content, "<w-certificate") ) { 
			$findRegExforTag = '~<(w-certificate)(.*)?>(.*)<\/\1>~mi';
			$content = preg_replace( $findRegExforTag, $lightbox_content, $content);
		}
	
		$amp_post_template_data['post_amp_content'] = $content;
		}
		
	}


	return $amp_post_template_data;
}

function amp_wordproof_compatibility_css(){
	echo '.amp_wordproof_lightbox{background:rgba(0,0,0,.8);width:100%;height:100%;position:absolute;display:flex;flex-wrap:wrap;color:#fff;justify-content:center;align-content:center;align-items:center}.amp_wordproof_lightbox h4,.amp_wordproof_lightbox h5,.amp_wordproof_lightbox p{padding:0 10px}';
}
/**
 * ampforwp_compatibility_for_opensea_plugin function
 *
 * @since 1.0.86
 * @param mixed|string $amp_post_template_data
 * @return mixed|string
 */
function ampforwp_compatibility_for_opensea_plugin( $amp_post_template_data )
{
	$content = $amp_post_template_data['post_amp_content'];
	if( false !== strpos($content, "<nft-card") ) { 
		add_action( 'amp_post_template_css', 'ampforwp_opensea_compatibility_css' );

		$findRegExforTag = '~<(nft-card) tokenaddress="(.*)" tokenid="(.*)">?>(.*)<\/\1>~mi';
		$content = preg_replace_callback($findRegExforTag, 'ampforwp_compatibility_for_opensea_callback', $content);
	}
	$amp_post_template_data['post_amp_content'] = $content;
	return $amp_post_template_data;
}

function ampforwp_opensea_compatibility_css(){
	echo '.ampforwp_opensea_card .asset-detail-type a {border: 1px solid;border-radius: 20px;display: flex;flex-direction: row;align-items: center;}.ampforwp_opensea_card .asset-detail-type img {width:25px;border-radius:50%;padding:5px;}.ampforwp_opensea_card{background-color:#fff;font-family:Roboto,sans-serif;-webkit-font-smoothing:antialiased;font-style:normal;font-weight:400;line-height:normal;border-radius:5px;perspective:1000px;margin:auto;width:80vw;height:210px;min-height:200px;max-width:670px}.ampforwp_opensea_card .card-inner{position:relative;width:100%;height:100%;text-align:center;transition:transform .6s;transform-style:preserve-3d;box-shadow:0 1px 6px rgba(0,0,0,.25);border-radius:5px}.ampforwp_opensea_card a{text-decoration:none;color:inherit}.ampforwp_opensea_card .card-front{backface-visibility:hidden;background:#fff;border-radius:5px;display:grid;grid-template-columns:1fr 2fr;position:relative;width:100%;height:100%;transform:translateY(0);overflow:hidden}.ampforwp_opensea_card .card-front p{margin:0;padding:0 10px;}.ampforwp_opensea_card .asset-image-container{border-right:1px solid #e2e6ef;background-size:cover;box-sizing:border-box}.ampforwp_opensea_card .asset-image{background-size:contain;background-position:50%;background-repeat:no-repeat;height:100%;box-sizing:border-box}.ampforwp_opensea_card .asset-details-container{display:grid;grid-template-rows:auto;grid-template-columns:1fr 1fr;padding:20px;align-items:center}.ampforwp_opensea_card .asset-detail{display:flex}.ampforwp_opensea_card .asset-detail .asset-detail-type{height:35px;font-size:12px;margin-right:10px}.ampforwp_opensea_card .asset-detail .asset-detail-badge{width:54px;height:30px;font-size:12px}.ampforwp_opensea_card .asset-detail-name{font-weight:400;text-align:left}.ampforwp_opensea_card .asset-detail-price{align-items:flex-end;font-size:18px;font-weight:400;display:flex;flex-flow:row;justify-content:flex-end;line-height:15px;text-align:right;padding:6px 0}.ampforwp_opensea_card .asset-detail-price img{margin:0 4px}.ampforwp_opensea_card .asset-detail-price-current img{width:15px}.ampforwp_opensea_card .asset-detail-price-previous{font-size:14px;color:#828282;line-height:10px}.ampforwp_opensea_card .asset-detail-price-previous img{width:1ex}.ampforwp_opensea_card .asset-detail-price .value{margin-left:5px}.ampforwp_opensea_card .asset-detail-price .previous-value{font-size:14px;color:#828282}.ampforwp_opensea_card .asset-action-buy{grid-column-start:1;grid-column-end:3}.ampforwp_opensea_card .asset-action-buy button{width:100%;background:#3291e9;border-radius:5px;height:35px;color:#fff;font-weight:700;letter-spacing:.5px;cursor:pointer;transition:.2s;outline:0;border-style:none;text-transform:uppercase}.ampforwp_opensea_card .asset-action-buy button:hover{background:#153d62}.ampforwp_opensea_card .asset-link{text-decoration:none;}';
}

function ampforwp_compatibility_for_opensea_callback($matches){
	$default_return="";
	if(isset($matches[2]) && !empty($matches[2]) &&  isset($matches[3]) && !empty($matches[3])){
	
		$response = wp_remote_get( 'https://api.opensea.io/api/v1/asset/'.$matches[2].'/'.$matches[3].'/?',
		array('headers'=>array('X-API-KEY'=>'e4e7b08f1807492e91301de85728ce2e',
		   'accept' => 'application/json'
		 )) );
		 if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			
			$body    = $response['body']; // use the content
			$nft_data = json_decode($body,true);
			
			if(isset($nft_data['token_id']) && isset($nft_data['image_url']) && isset($nft_data['name']) && isset($nft_data['permalink']) && isset($nft_data['asset_contract']['name']) && isset($nft_data['asset_contract']['image_url']) && isset($nft_data['collection']['slug'])){
			$nft_card_html="
			<div class='ampforwp_opensea_card'>
			<div class='card-inner'>
			<div class='card-front'>
			  <div class='asset-image-container'>
				<a target='_blank' href='".esc_url($nft_data['permalink'])."'>
				  <div class='asset-image' style='background-image: url(&quot;".esc_url($nft_data['image_url'])."&quot;); background-size: contain;'></div>
				</a>
			  </div>
				<div class='asset-details-container'>
				  <div class='asset-detail'>
					<div class='asset-detail-type'>
					  <a class='asset-link' target='_blank' href='https://opensea.io/assets/".esc_url($nft_data['collection']['slug'])."'>
					  <img alt='' src='".esc_url($nft_data['asset_contract']['image_url'])."'>
            		  <p>".esc_attr($nft_data['asset_contract']['name'])."</p>
					  </a>
					</div>
				  </div>
				  <div class='spacer'></div>
				  <div class='asset-detail-name'>
					<a class='asset-link' target='_blank' href='".esc_url($nft_data['permalink'])."'>".esc_attr($nft_data['name'])."</a>
				  </div>
				  
				<a class='asset-link' target='_blank' href='".esc_url($nft_data['permalink'])."'>
				<div class='asset-detail-price asset-detail-price-previous'>
				<div class='previous-value'>Prev.&nbsp;</div>  
				<img alt='' src='https://openseauserdata.com/files/6f8e2979d428180222796ff4a33ab929.svg'>
				<div class='asset-detail-price-value'>
				  ";
				  if(isset($nft_data['last_sale']['total_price'])){
					$price_to_show=round($nft_data['last_sale']['total_price']/1000000000000000000,3);
					$nft_card_html.= esc_attr($price_to_show);
				  }
				$nft_card_html.="</div>
			  </div>
			  </a>
			<div class='asset-action-buy'>
			  <button>
				<a class='asset-link' target='_blank' href='".esc_url($nft_data['permalink'])."'> buy this item > </a>
			  </button>
				  </div>
				</div>
		  </div>
		</div>
	</div>";
	return $nft_card_html;
			}
		}

	}
	if(isset($response['response']['code']) && $response['response']['message'] ){
		$default_return = '<center><small> Opensea Error - '.esc_attr($response['response']['code']).' : '.esc_attr($response['response']['message']).'</small></center>' ;
	}
 return $default_return;
}
/**
 * ampforwp_add_target_attribute_in_form_tags function
 *
 * @since 1.0.86
 * @param mixed|string $amp_post_template_data
 * @return mixed|string
 */
function ampforwp_add_target_attribute_in_form_tags( $amp_post_template_data )
{
	$content = $amp_post_template_data['post_amp_content'];
	$pattern = '~<form(?![^>]*\btarget=)[^<]*>~im';

	if( preg_match_all( $pattern, $content, $matches ) ) 
	{
		if( 0 < count( $matches[0] ) )
		{
			$matchesUnique = array_unique( $matches[0] );
			foreach( $matchesUnique as $match )
			{
				$matchStr = trim( str_replace( '>', '', $match ) ); 
				$content = str_replace( $matchStr, $matchStr . ' target="_top"', $content );
			}
		}
	}

	$amp_post_template_data['post_amp_content'] = $content;

	return $amp_post_template_data;
}