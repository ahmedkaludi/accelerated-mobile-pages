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
	// AMP is not working due to JCH Optimize Pro plugin #3185
	remove_action('shutdown', 'jch_buffer_end', -1);
	//ShortPixel Plugin Compatibility to remove picture tag in amp #3439
	remove_filter( 'the_content', 'shortPixelConvertImgToPictureAddWebp', 10000 );
	remove_filter( 'the_excerpt', 'shortPixelConvertImgToPictureAddWebp', 10000 );
	remove_filter( 'post_thumbnail_html', 'shortPixelConvertImgToPictureAddWebp');
	//Validation error with Authentic theme #3535
	remove_filter( 'amp_post_template_data', 'csco_amp_post_template_data', 10, 2 );
	//Validation errors in amp category page due to HotWP PRO #3455
	if(function_exists('hotwp_get_option') && is_category()){
		remove_all_filters('get_the_archive_title');
	}
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
		.wpappbox{clear:both;background-color:#F9F9F9;line-height:1.4;color:#545450;margin:16px 0;font-size:15px;border:1px solid #E5E5E5;box-shadow:0 0 8px 1px rgba(0,0,0,.11);border-radius:8px;display:inline-block;width:100%}.wpappbox a{transition:all .3s ease-in-out 0s}.wpappbox.compact .appicon{height:66px;width:68px;float:left;padding:6px;margin-right:15px}.appicon amp-img{max-width:92px;height:92px;border-radius:5%}.wpappbox a:hover amp-img{opacity:.9;filter:alpha(opacity=90);-webkit-filter:grayscale(100%)}.wpappbox .appicon{position:relative;height:112px;width:112px;float:left;padding:10px;background:#FFF;text-align:center;border-right:1px solid #E5E5E5;border-top-left-radius:6px;border-bottom-left-radius:6px;margin-right:10px}.wpappbox .appdetails{margin-top:15px}.wpappbox .appbuttons a{font-size:13px;box-shadow:0 1px 3px 0 rgba(0,0,0,.15);background:#F1F1F1;border-bottom:0;color:#323232;padding:3px 5px;display:inline-block;margin:12px 0 0;border-radius:3px;cursor:pointer;font-weight:400}.wpappbox .appbuttons a:hover{color:#fff;background:#111}.wpappbox div.applinks,div.wpappbox.compact a.applinks{float:right;position:relative;background:#FFF;text-align:center;border-left:1px solid #E5E5E5;border-top-right-radius:6px;border-bottom-right-radius:6px}.wpappbox div.applinks{height:112px;width:92px;display:block}.wpappbox .apptitle,.wpappbox .developer{margin-bottom:15px}.wpappbox .developer a{color:#333}.wpappbox .apptitle a{font-size:18px;font-weight:500;color:#333}.wpappbox .apptitle a:hover,.wpappbox .developer a:hover{color:#5588b5}.wpappbox .appbuttons span,.wpappbox .qrcode{display:none}.wpappbox.screenshots>div.screenshots{width:auto;margin:0 auto;padding:10px;clear:both;border-top:1px solid #E5E5E5}.wpappbox .screenshots .slider>ul>li{padding:0;margin:0 6px 0 0;list-style-type:none;display:inline-block}.wpappbox .screenshots .slider{overflow-x:scroll;overflow-y:hidden;height:320px;margin-top:0}.wpappbox .screenshots .slider>ul{display:inline-flex;width:100%}.wpappbox .screenshots .slider>ul>li amp-img{height:320px;display:inline-block;}
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
		.wpappbox div.applinks{display:none;}}
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
				if (function_exists('attachment_url_to_postid')) {
					$image_id = attachment_url_to_postid( $url );
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
				return ' <span><a href="https://twitter.com/'.esc_attr($twitter).'" target="_blank">@'.esc_html($twitter).'</a></span>';
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