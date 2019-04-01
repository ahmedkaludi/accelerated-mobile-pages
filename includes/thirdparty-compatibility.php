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

// Strange spaces when using Sassy Social Share #1185
add_filter('heateor_sss_disable_sharing','ampforwp_removing_sassy_social_share');
function ampforwp_removing_sassy_social_share(){
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		return 1;
	}
}

// Remove Schema theme Lazy Load #1170

add_action('pre_amp_render_post','ampforwp_schema_lazy_load_remover');
function ampforwp_schema_lazy_load_remover(){
	remove_filter( 'wp_get_attachment_image_attributes', 'mts_image_lazy_load_attr', 10, 3 );
	remove_filter('the_content', 'mts_content_image_lazy_load_attr');
}

//Updater to check license
require_once AMPFORWP_PLUGIN_DIR . '/includes/updater/update.php';


if(!function_exists('ampforwp_amp_nonamp_convert')){
	function ampforwp_amp_nonamp_convert($ampData, $type=""){
		$returnData = '';
		if("check" === $type){
			return ampforwp_is_non_amp('non_amp_check_convert');
		}
		if(!ampforwp_is_non_amp('non_amp_check_convert')){
			return $ampData;
		}
		switch($type){
			case 'filter':
				$returnData = str_replace(array(
												"amp-img",
												"<style amp-custom>",
												"<amp-sidebar ",
												"</amp-sidebar>",
												'on="tap:ampforwpConsent.dismiss"',
												'<div id="post-consent-ui"',
												'on="tap:ampforwpConsent.reject"',
												'on="tap:ampforwpConsent.accept"'
												),
											array(
												"img",
												"<style type=\"text/css\">",
												"<sidebar ",
												"</sidebar>",
												'onClick="ampforwp_gdrp_set()"',
												'<script>
												function ampforwp_gdpr_getCookie(name) {
												  var value = "; " + document.cookie;
												  var parts = value.split("; " + name + "=");
												  if (parts.length == 2) return parts.pop().split(";").shift();
												}
												function ampforwp_gdpr(){
											if(ampforwp_gdpr_getCookie(\'ampforwpcookie\') == \'1\'){document.getElementById(\'gdpr_c\').remove();}
											}ampforwp_gdpr();
											function ampforwp_gdrp_set(){document.getElementById(\'ampforwpConsent\').remove(); document.cookie = \'ampforwpcookie=1;expires;path=/\';}
												</script><div id="post-consent-ui"',
												'onClick="ampforwp_gdrp_set()"',
												'onClick="ampforwp_gdrp_set()"',
												)
											, $ampData);

				$nonampCss = '
				.cntr img{height:auto !important;}
				img{height:auto;}
				.amp-featured-image img{width:100%;height:auto;}
				.content-wrapper, .header, .header-2, .header-3{width:100% !important;}
				.image-mod img{width:100%;}
				
				';
				$re = '/<style\s*type="text\/css">(.*?)<\/style>/si';
				$subst = "<style type=\"text/css\">$1 ".$nonampCss."</style>";
				$returnData = preg_replace($re, $subst, $returnData);
				$returnData = preg_replace(
                '/<amp-youtube\sdata-videoid="(.*?)"(.*?)><\/amp-youtube>/',
                 '<iframe src="'. esc_url("https://www.youtube.com/embed/$1").'" style="width:100%;height:360px;" ></iframe>', $returnData);
			break;
		}
		return $returnData;
	}
}

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
	    		$post_types = array_filter( (array) get_query_var( 'post_type' ) );
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

				$post_types = array_filter( (array) get_query_var( 'post_type' ) );

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




if ( ! function_exists( 'ampforwp_isexternal ') ) {
	function ampforwp_isexternal($url) {
	    $components = parse_url($url);

	    // we will treat url like '/relative.php' as relative
	    if ( empty($components['host']) ) return false;  
	    
	    // url host looks exactly like the local host
	    if ( strcasecmp($components['host'], $_SERVER['HTTP_HOST']) === 0 ) return false; 
	    
	    // check if the url host is a subdomain
	    return strrpos(strtolower($components['host']), $_SERVER['HTTP_HOST']) !== strlen($components['host']) - strlen($_SERVER['HTTP_HOST']); 
  	}
} // end ampforwp_isexternal

if(!function_exists('ampforwp_findInternalUrl')){
	function ampforwp_findInternalUrl($url){
	    global $redux_builder_amp;
	    if(isset($redux_builder_amp['convert-internal-nonamplinks-to-amp']) && ! $redux_builder_amp['convert-internal-nonamplinks-to-amp']){
	        return $url;
	    }
		$get_skip_media_path 	= array();
		$skip_media_extensions 	= array();
		$get_skip_media_path 	= pathinfo($url);
		$skip_media_extensions 	= array('jpg','jpeg','gif','png');

		if ( isset( $get_skip_media_path['extension'] ) ){
			if (! in_array( $get_skip_media_path['extension'], $skip_media_extensions ) ){
				$skip_media_extensions[] = $get_skip_media_path['extension'];
			}
		}
		$skip_media_extensions = apply_filters( 'ampforwp_internal_links_skip_media', $skip_media_extensions );

		if ( isset( $get_skip_media_path['extension'] ) ){
			if( in_array( $get_skip_media_path['extension'], $skip_media_extensions ) ) {
				return $url;
			}
		}
		if ( false !== strpos($url, '#') && false === ampforwp_is_amp_inURL($url) && !ampforwp_isexternal($url) ) {
			$url_array = explode('#', $url);
			if ( !empty($url_array) && '' !== $url_array[0]) {
	      		$url = ampforwp_url_controller($url_array[0]).'#'.$url_array[1];
				return $url;
			}
		}
	    if( false === wp_http_validate_url($url) ) {
	        return $url;
	    }
	    if(!ampforwp_isexternal($url) && ampforwp_is_amp_inURL($url)===false){
	      // Skip the URL's that have edit link to it
	      $parts = parse_url($url);
	      if ( isset($parts['query']) && $parts['query']) {
	      	parse_str($parts['query'], $query);
	      }
	      if ( (isset( $query['action'] ) && $query['action']) || (isset( $query['amp'] ) && $query['amp'] ) ) {
	          return $url;
	      }
	      $qmarkAmp = (isset($redux_builder_amp['amp-core-end-point']) ? $redux_builder_amp['amp-core-end-point']: false );//amp-core-end-point
	      if ( $qmarkAmp ){
	      	$url = add_query_arg( 'amp', '1', $url);
			return $url;
	      }
		  else{
	      	if ( get_option('permalink_structure') ) {
		      	if ( strpos($url, "?") && strpos($url, "=") ){
		      		$url = explode('?', $url);
		      		$url = ampforwp_url_controller($url[0]).'?'.$url[1];
		      	}
		      	else
		      		$url = ampforwp_url_controller($url);
	      	}
	      	else
	      		$url = add_query_arg( 'amp', '1', $url );
	      }
	      return $url;
	    }
	    return $url;
	}
} // end ampforwp_findInternalUrl

function ampforwp_is_amp_inURL($url){
	$urlArray = explode("/", $url);
	if( !in_array( AMPFORWP_AMP_QUERY_VAR , $urlArray ) ) {
		return false;
	}
	return true;
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

//Levelup Compatibility
function ampforwp_levelup_compatibility($type='levelup_theme_and_elementor_check'){
	//check theme
	$returnVal = false;
	switch($type){
		case 'levelup_theme':
			if(function_exists('levelup_theme_is_active')){
				$returnVal = levelup_theme_is_active();
			}
		break;
		case 'levelup_elementor':
			if(function_exists('levelup_has_enable_elementor_builder')){
				$returnVal = levelup_has_enable_elementor_builder();				
			}
		break;
		case 'levelup_theme_and_elementor':
			if(function_exists('levelup_theme_is_active') && function_exists('levelup_has_enable_elementor_builder')){
				$returnVal = levelup_theme_is_active() && levelup_has_enable_elementor_builder();
			}
		break;
		case 'hf_builder_foot':
			if(function_exists('levelup_check_hf_builder')){
				$returnVal = levelup_check_hf_builder('foot');
			}
		break;
		case 'hf_builder_head':
			if(function_exists('levelup_check_hf_builder')){
				$returnVal = levelup_check_hf_builder('head');
			}
		break;
	}
	return $returnVal;
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
}