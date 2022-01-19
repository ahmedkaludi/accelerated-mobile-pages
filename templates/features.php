<?php
use AMPforWP\AMPVendor\AMP_Content;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/* This file will contain all the Extra FEATURES.
0.9. AMP Design Manager Files
	1. Add Home REL canonical
	2. Custom Design
	3. Custom Style files
	4. Custom Header files
		4.1 Custom Meta-Author files
		4.2 Custom Meta-Taxonomy files
		4.5 Added hook to add more layout.
	5. Customize with Width of the site
	6. Add required Javascripts for extra AMP features
		6.1 Adding Analytics Scripts
	7. Footer for AMP Pages
	8. Add Main tag as a Wrapper ( removed in 0.8.9 )
	9. Advertisement code
	10. Analytics Area
		10.1  Analytics Support added for Google Analytics
		10.2  Analytics Support added for segment.com
		10.3  Analytics Support added for Piwik
		10.4  Analytics Support added for quantcast
		10.5  Analytics Support added for comscore
		10.6  Analytics Support added for Effective Measure
		10.7  Analytics Support added for StatCounter
		10.8  Analytics Support added for Histats Analytics
		10.9  Analytics Support added for Yandex Metrika
		10.10 Analytics Support added for Chartbeat Analytics
		10.11 Analytics Support added for Alexa Metrics
	11. Strip unwanted codes and tags from the_content
	12. Add Logo URL in the structured metadata
	13. Add Custom Placeholder Image for Structured Data.
	14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
	15. Disable New Relic's extra script that its adds in AMP pages.
	16. Remove Unwanted Scripts
	17. Archives Canonical in AMP version
	18. Custom Canonical for Homepage
	19. Remove Canonical tags
	20. Remove the default Google font for performance ( removed in 0.8.9 )
	21. Remove Schema data from All In One Schema.org Rich Snippets Plugin
	22. Removing author links from comments Issue #180
	23. The analytics tag appears more than once in the document. This will soon be an error
	24. Seperate Sticky Single Social Icons
	25. Yoast meta Support
	26. Extending Title Tagand De-Hooking the Standard one from AMP
    27. Fixing the defer tag issue [Finally!]
    28. Properly removes AMP if turned off from Post panel
    29. Remove analytics code if Already added by Glue or Yoast SEO
    30. TagDiv menu issue removed
    31. removing scripts added by cleantalk
    32. various lazy loading plugins Support
    33. Google tag manager support added
    34. social share boost compatibility Ticket #387
	35. Disqus Comments Support
	36. remove photon support in AMP
	37. compatibility with wp-html-compression
	38. #529 editable archives
  	39. #560 Header and Footer Editable html enabled script area
  	40. Meta Robots
  	41. Rewrite URL only on save #511
	42. registeing AMP sidebars
	43. custom actions for widgets output
	44. auto adding /amp for the menu
	45. search,frontpage,homepage structured data
	46. search search search everywhere #615
	47. social js properly adding when required
	48. Remove all unwanted scripts on search pages
	49. Properly adding ad Script the AMP way
	50. Properly adding noditification Scritps the AMP way
	51. Adding Digg Digg compatibility with AMP
	52. Adding a generalized sanitizer function for purifiying normal html to amp-html
	53. Removed AMP-WooCommerce Code and added it in AMP-WooCommerce #929
	54. Change the default values of post meta for AMP pages.
	55. Call Now Button Feature added
	56. Multi Translation Feature #540
	57. Adding Updated date at in the Content
	58. YouTube Shortcode compatablity with AMP #557
	59. Comment Button URL
	60. Remove Category Layout modification code added by TagDiv #842 and #796
	61. Add Gist Support
	62. Adding Meta viewport via hook instead of direct #878
	63. Frontpage Comments #682 
	64. PageBuilder  
	65. Remove Filters code added through Class by other plugins
	66. Make AMP compatible with Squirrly SEO
	69. Post Pagination #834 #857
	70. Hide AMP by specific Categories #872
	71. Alt tag for thumbnails #1013 and For Post ID in Body tag #1006
	72. Blacklist Sanitizer Added back #1024
	73. View AMP Site below View Site In Dashboard #1076
	74. Featured Image check from Custom Fields 
	75. Dev Mode in AMP
	76. Body Class for AMP pages
	77. AMP Blog Details
	78. Saved Custom Post Types for AMP in Options for Structured Data
	79. Favicon for AMP
	80. Mobile Preview styling
	81. Duplicate Featured Image Support
	82. Grab Featured Image from The Content
	83. Advance Analytics(Google Analytics)
	84. Inline Related Posts
	85. Caption for Gallery Images
	86. minify the content of pages
	87. Post Thumbnail
	88. Author Details
	89. Facebook Pixel
	90. Set Header last modified information
	91. Comment Author Gravatar URL
	92. View AMP in Admin Bar
	93. added AMP url purifire for amphtml
	94. OneSignal Push Notifications
	95. Modify menu link attributes for SiteNavigationElement Schema Markup #1229 #1345
	96. ampforwp_is_front_page() ampforwp_is_home() and ampforwp_is_blog is created
	97. Change the format of the post date on Loops #1384 
	98. Create Dynamic url of amp according to the permalink structure #1318
	99. Merriweather Font Management
	100. Flags compatibility in Menu
	101. Function for Logo attributes 
	102. SD Feature Image Guidlines #2838
*/
// AMP Components	
// AMP LOGO
add_amp_theme_support('AMP-logo');
// AMP Loop
add_amp_theme_support('AMP-loop');
// GDPR
if(ampforwp_get_setting('amp-gdpr-compliance-switch')) {
    add_amp_theme_support('AMP-gdpr');
}
// Menu
add_amp_theme_support('AMP-menu');
// Adding AMP-related things to the main theme
	global $redux_builder_amp;

	// 0.9. AMP Design Manager Files
	require AMPFORWP_PLUGIN_DIR  .'templates/design-manager.php';
	// Custom Frontpage items
 	require AMPFORWP_PLUGIN_DIR  .'templates/frontpage-elements.php';
 	require AMPFORWP_PLUGIN_DIR . '/classes/class-ampforwp-youtube-embed.php' ;
 	// Custom Post Types
 	require AMPFORWP_PLUGIN_DIR  .'templates/ampforwp-custom-post-type.php';
 	
 	// TODO: Update this function 
 	function ampforwp_include_customizer_files(){
 		global $redux_builder_amp;
 		$amp_plugin_data;
		$amp_plugin_activation_check; 

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );
		if ( isset ($redux_builder_amp['amp-design-selector']) && 4 != $redux_builder_amp['amp-design-selector'] ) {
			return require AMPFORWP_PLUGIN_DIR  .'templates/customizer/customizer.php' ;
		}
 	} 
 	ampforwp_include_customizer_files();
//0.

define('AMPFORWP_COMMENTS_PER_PAGE',  ampforwp_define_comments_number() );
	// Define number of comments
	function ampforwp_define_comments_number(){
		global $redux_builder_amp;
		$number_of_comments = '';
		if(isset($redux_builder_amp['ampforwp-number-of-comments'])){
			$number_of_comments = $redux_builder_amp['ampforwp-number-of-comments'];
		}
		return $number_of_comments;
	}
	
	// 1. Add Home REL canonical
	// Add AMP rel-canonical for home and archive pages

	add_action('amp_init','ampforwp_allow_homepage');
	function ampforwp_allow_homepage() {
		add_action( 'wp', 'ampforwp_add_endpoint_actions' );
	}


	function ampforwp_add_endpoint_actions() {

		$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

		if ( $ampforwp_is_amp_endpoint ) {
			AMPforWP\AMPVendor\amp_prepare_render();
		} else {
			add_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
		}

		$cpage_var = get_query_var('cpage');

		if ( $cpage_var >= 1) : 
			remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
		endif;			
	}

	function ampforwp_amphtml_generator(){
		global $redux_builder_amp;
		global $wp, $post;
		$post_id = '';
		$endpoint_check = false;
		$endpoint_check = ampforwp_get_setting('amp-core-end-point');
	    if( is_attachment() ) {
        return;
	    }
	    if(get_query_var('paged') && true == ampforwp_get_setting('amp-paginated-pages-indexing')) {
		    return;
		}
	    if( is_home() && is_front_page() && !ampforwp_get_setting('ampforwp-homepage-on-off-support') ) {
        return;
	    }
	    if( is_front_page() && ! ampforwp_get_setting('ampforwp-homepage-on-off-support') ) {
        return;
	    }

	     // HIDE/SHOW TAG AND CATEGORY #4326
	  if(is_tag() || is_category() || is_tax()){
          $term_id = get_queried_object()->term_id;
          $tax_status = ampforwp_get_taxonomy_meta($term_id,'status');
          if($tax_status==false){
           	return;
          }
      }else if(is_single()){
          $tax_status = ampforwp_get_taxonomy_meta('','post_status');
          if($tax_status==false){
            return;
          }
      }

	     // Skip this condition for woocommerce product archive and shop pages.
	     if( function_exists('amp_woocommerce_pro_add_woocommerce_support') && (function_exists('is_product_category') && !is_product_category()) && (function_exists('is_product_tag') && !is_product_tag()) && (function_exists('is_shop') && !is_shop() ) ){
		    	if( is_archive() && ( !ampforwp_get_setting('ampforwp-archive-support') || ( is_category() && !ampforwp_get_setting('ampforwp-archive-support-cat') ) || ( is_tag() && !ampforwp_get_setting('ampforwp-archive-support-tag') ))){
					return;
				}	
	    }

	  // When amp woocommerce pro plugin is not active.
      if ( is_archive() && !function_exists('amp_woocommerce_pro_add_woocommerce_support') ) {
	    	if(!ampforwp_get_setting('ampforwp-archive-support')){
				return;
			}
	    	if( is_category() && !ampforwp_get_setting('ampforwp-archive-support-cat') ){
	    		return;
	    	}
	    	if( is_tag() && !ampforwp_get_setting('ampforwp-archive-support-tag') ){
	    		return;
	    	}
	    }
		// #1192 Password Protected posts exclusion
		if(post_password_required( $post )){
				return;
			}
		// #2018 404 exclusion
		if(is_404()){
			return;
		}
		// #1443 AMP should be skip on the check out page  
		if(class_exists( 'WooCommerce' )){
		      if(function_exists('is_checkout') && is_checkout()){
		        return;
		      }
		      if(function_exists('is_account_page') && is_account_page()){
		        return;
		      }
		    }
		// Search results on/off option #3786
		    if(is_search() && 0 == ampforwp_get_setting('amp-redirection-search')){
		     	return;
		    }
		if(function_exists('yith_wishlist_constructor')){
			$class = get_body_class();
			if(in_array("woocommerce-wishlist", $class)){
				return;
			} 
		}    
		// #872 no-amphtml if selected as hide from settings
		if ( is_category_amp_disabled() ) {
			return;
		}
      	if ( is_page() && ! ampforwp_get_setting('amp-on-off-for-all-pages') && ! is_home() && ! is_front_page() ) {
			return;
		}
		if ( is_home() && ! ampforwp_is_blog() && !ampforwp_get_setting('ampforwp-homepage-on-off-support') ) {
			return;
		}
		if (!ampforwp_is_home() && !ampforwp_is_front_page() && !ampforwp_is_blog() && !is_category() && !is_tag() && !is_singular( array('page', 'attachment', 'post')) && !function_exists('amp_woocommerce_pro_add_woocommerce_support')){
			global $post_type;
			if (empty(ampforwp_get_setting('ampforwp-custom-type'))) {
				return;
			}
		}
		$page_for_posts = intval(get_option( 'page_for_posts' ));
		$post_id = ampforwp_get_the_ID();
		if ( ampforwp_is_blog() && ! ampforwp_get_setting('amp-on-off-for-all-pages') && ($page_for_posts != $post_id ) ) {
			return;
		}
			$query_arg_array = $wp->query_vars;
			if( in_array( "cpage" , $query_arg_array ) ) {
				if( is_front_page() &&  $wp->query_vars['cpage'] >= '2' ) {
				 return;
			 }
			 if( is_singular() &&  $wp->query_vars['cpage'] >= '2' ) {
				 return;
			 }
			}

	    if ( is_home() || is_front_page() || is_archive() ){
	        global $wp;
	        $current_archive_url = home_url( $wp->request );
	        // If its custom permalink with /index.php/ #3279
	        if ( is_archive() && false !== strpos($wp->matched_rule, 'index.php') && false === strpos($current_archive_url, 'index.php') ) {
				$current_archive_url = home_url( 'index.php/' . $wp->request );
			}
	        $amp_url = trailingslashit($current_archive_url);
	        if ($endpoint_check && (is_tax() || is_post_type_archive())) {
	        	$amp_url =  ampforwp_url_controller($amp_url);	
	        }
	    } else {
	      $amp_url = AMPforWP\AMPVendor\amp_get_permalink( get_queried_object_id() );
	    }
        global $post;
        if ( is_singular() ) {
        	$post_id = get_the_ID();
        	
        }
        if ( ampforwp_is_blog() ) {
        	$post_id = ampforwp_get_blog_details('id');
        }
        $ampforwp_amp_post_on_off_meta = get_post_meta( $post_id,'ampforwp-amp-on-off',true);
        if ( ( is_singular() || ampforwp_is_blog() ) && $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
          //dont Echo anything
        } else {
			$supported_types = ampforwp_get_all_post_types();
			if(isset($supported_types['web-story'])){
		    	$supported_types['web-story'] = '';
		    }
			$supported_types = apply_filters('get_amp_supported_post_types',$supported_types);

			$type = get_post_type();
			if(is_home() || is_front_page()){
		      if( ampforwp_get_setting('ampforwp-homepage-on-off-support') == 1 
		          && ampforwp_get_setting('amp-on-off-for-all-posts') == 0 
		          && ampforwp_get_setting('amp-on-off-for-all-pages') == 0 ){

                  $supported_types['post'] = 'post';
      			}
		    }
			$supported_amp_post_types = in_array( $type , $supported_types );

			$query_arg_array = $wp->query_vars;
			if( array_key_exists( 'paged' , $query_arg_array ) ) {
				if ( (is_home() || is_archive()) && $wp->query_vars['paged'] >= '2' ) {
					$new_url 		=  home_url('/');
					// If its custom permalink with /index.php/ #3537
					if ( (is_home() || is_archive()) && false !== strpos($wp->matched_rule, 'index.php') && false === strpos( home_url( $wp->request ), 'index.php') ) {
						$new_url = home_url( 'index.php' );
						$o_url = home_url();
						$new_url = str_replace($o_url, $new_url, $amp_url);
						$new_url = user_trailingslashit($new_url);
						$amp_url = $new_url;
					}
					$category_path 	= $wp->request;
					if ( null != $category_path && true != $endpoint_check) {
						$explode_path  	= explode("/",$category_path);
						$inserted 		= array(AMPFORWP_AMP_QUERY_VAR);
						array_splice( $explode_path, -2, 0, $inserted );
						$impode_url = implode('/', $explode_path);
						$amp_url = $new_url . $impode_url ;
					}
				}
				if( is_search() && $wp->query_vars['paged'] >= '2' ) {
					$current_search_url =trailingslashit(get_home_url()) . $wp->request .'/'."?amp=1&s=".get_search_query();
				}
			}
			if (!$endpoint_check) {
	        	$amp_url = user_trailingslashit($amp_url);
	        }

			if( is_search() ) {
				$current_search_url =trailingslashit(get_home_url())."?amp=1&s=".get_search_query();
				$amp_url = untrailingslashit($current_search_url);
			}
			// URL Purifier
			if(!ampforwp_get_setting('amp-core-end-point') && !ampforwp_get_setting('ampforwp-amp-takeover')){
				$amp_url = ampforwp_url_purifier($amp_url);
			}
			if(true == ampforwp_get_setting('amp-core-end-point') && (!is_home() && !is_front_page() && !is_archive())){
				$amp_url = add_query_arg( 'amp', '', get_the_permalink() );
			}	
	        $amp_url = apply_filters('ampforwp_modify_rel_canonical',$amp_url);

	        if( $supported_amp_post_types || ampforwp_is_front_page() ) {
	        	if(true == ampforwp_get_setting('amp-core-end-point')){
		        	if( class_exists('SitePress') ){
				        if( get_option('permalink_structure') ){
				            global $sitepress_settings, $wp;
				            $wpml_lang_checker = false;
				            if($sitepress_settings[ 'language_negotiation_type' ] == 3){
				            	$amp_url = esc_url($amp_url);
					            $active_langs = $sitepress_settings['active_languages'];
					            foreach ($active_langs as $active_lang) {
					                if (preg_match('/\?lang='.$active_lang.'/', $amp_url)){
					                    $amp_url = preg_replace('/&#038;amp=1/', '', $amp_url);
					                    $amp_url = preg_replace('/#038;amp/', '', $amp_url);
					                    $amp_url = str_replace('?lang='.$active_lang, '?amp=1', $amp_url);
					                    $amp_url = add_query_arg( 'lang',$active_lang, $amp_url);
					                }
					            }
				            }
				        }
				    }
				}	
				if (is_category() && class_exists('WPSEO_Options') && method_exists('WPSEO_Options', 'get') && WPSEO_Options::get( 'stripcategorybase' ) == true && false == ampforwp_get_setting('ampforwp-category-base-removel-link')) {
					return;
				}
				if (is_category() && class_exists('RankMath') && RankMath\Helper::get_settings( 'general.strip_category_base' ) == true && false == ampforwp_get_setting('ampforwp-category-base-removel-link')) {
					return;
				}	
				if (is_preview()) {
					$amp_url = preg_replace('/(.*?)&(.*?)/', '$1&amp&$2', $amp_url);
				}	
				if(ampforwp_get_setting('amp-core-end-point') && ampforwp_get_setting('ampforwp-amp-takeover') && is_singular()){
					 $amp_url = get_the_permalink();
				}else if(ampforwp_get_setting('amp-core-end-point') && (ampforwp_is_home() || ampforwp_is_front_page() || ampforwp_is_blog() || is_category() || is_tag() || is_front_page())){
					 $amp_url = ampforwp_url_controller($amp_url);
				}
				return esc_url_raw($amp_url);
			}
		}
		return;
	}

	// AMPHTML when using custom page and then creating a blog page
	add_action('amp_init','ampforwp_allow_homepage_as_blog');
	function ampforwp_allow_homepage_as_blog() {
		if(function_exists('mfn_opts_setup')){
			remove_action( 'pre_get_posts', 'mfn_search' );
		}
		add_action( 'wp', 'ampforwp_static_blog' , 11 );
	}
	function ampforwp_static_blog(){
		global $page;
		$modify_canonical = ampforwp_is_front_page();
		$get_front_page_reading_settings  = get_option('page_on_front');
		// Homepage support on   
    	$get_amp_homepage_support        =  ampforwp_get_setting('ampforwp-homepage-on-off-support');
 		if ( 'page' == get_option( 'show_on_front') && is_front_page() && $get_front_page_reading_settings && $get_amp_homepage_support ){
			$modify_canonical = true;
		}
		if ( true == $modify_canonical && $page >= 2 && is_page() && false == ampforwp_get_setting('amp-core-end-point') ) {
			add_filter('ampforwp_modify_rel_canonical','ampforwp_modify_amphtml_static_blog');
		}
	}

	function ampforwp_modify_amphtml_static_blog($amp_url) {
		$explode_url = $amp_endpoint = $offset = "";

		$explode_url 	= explode('/', $amp_url);
		$explode_url 	= array_flip($explode_url);
		unset($explode_url[AMPFORWP_AMP_QUERY_VAR]); 
		$explode_url 	= array_flip($explode_url);
		$amp_endpoint 	= array(AMPFORWP_AMP_QUERY_VAR);
		$offset 		= count($explode_url) - 2; 
		array_splice( $explode_url, $offset, 0, $amp_endpoint );
		$amp_url 		= implode('/', $explode_url);
		return $amp_url;
	}

	function ampforwp_home_archive_rel_canonical() {

		$amp_url = "";

		$amp_url = ampforwp_amphtml_generator();

		if ( $amp_url ) {
			printf('<link rel="amphtml" href="%s" />', esc_url($amp_url));
			if(false==ampforwp_get_setting('hide-amp-version-from-source')){
				printf('<meta name="generator" content="%s %s"/>', esc_html__('AMP for WP'), esc_attr(AMPFORWP_VERSION) );
			}
		}

	} //end of ampforwp_home_archive_rel_canonical()

	// Remove default wordpress rel canonical
	add_filter('amp_frontend_show_canonical','ampforwp_remove_default_canonical');
	if (! function_exists('ampforwp_remove_default_canonical') ) {
		function ampforwp_remove_default_canonical() {
			return false;
		}
	}

	// 2. Custom Design

	// Add Homepage AMP file code
	add_filter( 'amp_post_template_file', 'ampforwp_custom_template', 10, 3 );
	function ampforwp_custom_template( $file, $type, $post ) {
        global $redux_builder_amp;
	   	// Custom Homepage and Archive file
		$slug = array();
		$current_url_in_pieces = array();
		$ampforwp_custom_post_page  =  ampforwp_custom_post_page();
		        
    	if ( 'single' === $type ) {
	        // Homepage and FrontPage
	        if ( is_home() || ( true == $redux_builder_amp['ampforwp-amp-takeover'] && is_front_page() ) ) {

	        	$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
			}
            if ( ampforwp_is_blog() ) {
			 	$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
            }
        
          $mob_pres_link = false;
		  if(function_exists('ampforwp_mobile_redirect_preseve_link')){
		    $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
		  }
          if ( ampforwp_is_front_page() || ( (true == ampforwp_get_setting('ampforwp-amp-takeover') || $mob_pres_link == true) && is_front_page() && ampforwp_get_setting('amp-frontpage-select-option')) ) {
		            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
	         }

	        // Archive Pages
	        if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] && 'single' === $type )  {

	            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/archive.php';
	        }
			// Search pages
	      	if ( is_search() )  {
	            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/search.php';
	        }
	        // 404 Pages #2042        	
	        if ( is_404() && 'single' === $type )  {
	        	add_filter('ampforwp_modify_rel_url','ampforwp_404_canonical');
	            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/404.php';
	        }
		}

		// Polylang compatibility
		// For Frontpage
		if ( 'single' === $type && ampforwp_polylang_front_page() && true == $redux_builder_amp['amp-frontpage-select-option'] ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
		}
	    return $file;
	}

add_filter('amp_post_template_dir','ampforwp_new_dir');
function ampforwp_new_dir( $dir ) {
		global $redux_builder_amp;
		if ( 1 == $redux_builder_amp['amp-design-selector'] || 2 == $redux_builder_amp['amp-design-selector'] || 3 == $redux_builder_amp['amp-design-selector'] ) {
			$dir = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector();
		}
		else {
			$dir = AMPFORWP_CUSTOM_THEME;
		}
		return $dir;
}

	//3.5
	add_filter( 'amp_post_template_file', 'ampforwp_empty_filter', 10, 3 );
	function ampforwp_empty_filter( $file, $type, $post ) {
		if ( 'empty-filter' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/empty-filter.php';
		}
		return $file;
	}

	// 4. Custom Header files
	add_filter( 'amp_post_template_file', 'ampforwp_custom_header', 10, 3 );
	function ampforwp_custom_header( $file, $type, $post ) {
		if ( 'header-bar' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/header-bar.php';
		}
		return $file;
	}

	// 4.1 Custom Meta-Author files
	add_filter( 'amp_post_template_file', 'ampforwp_set_custom_meta_author', 10, 3 );
	function ampforwp_set_custom_meta_author( $file, $type, $post ) {
		if ( 'meta-author' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/empty-filter.php';
		}
		return $file;
	}
	// 4.2 Custom Meta-Taxonomy files
	add_filter( 'amp_post_template_file', 'ampforwp_set_custom_meta_taxonomy', 10, 3 );
	function ampforwp_set_custom_meta_taxonomy( $file, $type, $post ) {
		if ( 'meta-taxonomy' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . 'templates/design-manager/empty-filter.php';
		}
		return $file;
	}

	// 5.  Customize with Width of the site
	add_filter( 'amp_content_max_width', 'ampforwp_change_content_width' );
	function ampforwp_change_content_width( $content_max_width ) {
		return 1000;
	}
 
	// 6. Add required Javascripts for extra AMP features
		// Code updated and added the JS proper way #336 
	add_filter('amp_post_template_data','ampforwp_add_amp_social_share_script', 20);
	function ampforwp_add_amp_social_share_script( $data ){
		global $redux_builder_amp;
		$social_check = $social_check_page = false;
		if ( is_page() && isset($redux_builder_amp['ampforwp-page-social']) && $redux_builder_amp['ampforwp-page-social'] )	{
			$social_check_page = true;
		}		
		if ( 4 == ampforwp_get_setting('amp-design-selector') ) {
			$social_check = true;
		}
		if ( '4' !== ampforwp_get_setting('amp-design-selector') && defined('AMPFORWP_DM_SOCIAL_CHECK') && 'true' === AMPFORWP_DM_SOCIAL_CHECK ) {
			$social_check = true;
		}
		if( ampforwp_get_setting('enable-single-social-icons') == true || defined('AMPFORWP_DM_SOCIAL_CHECK') && AMPFORWP_DM_SOCIAL_CHECK === 'true' )  {
				if( (is_singular() || $social_check_page ) &&  is_socialshare_or_socialsticky_enabled_in_ampforwp() ) {
					if ( empty( $data['amp_component_scripts']['amp-social-share'] ) ) {
						$data['amp_component_scripts']['amp-social-share'] = 'https://cdn.ampproject.org/v0/amp-social-share-0.1.js';
					}
				}
			}

		// Facebook Like Script
		$fb_like = false;
	    $isBBPress = (function_exists('is_bbpress') ? is_bbpress() : false );
	    if ( true == ampforwp_get_setting('ampforwp-facebook-like-button') ){
	     if ( is_single() && ( true == ampforwp_get_setting('enable-single-social-icons') || (true == ampforwp_get_setting('ampforwp-social-share') && $social_check) ) && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && !$isBBPress) {
	        $fb_like = true;    
	      }
	      if ( is_page() && ( true == ampforwp_get_setting('ampforwp-page-sticky-social') || ( $social_check_page && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) ) ) {
	        $fb_like = true;
	      }
	      if ( true == ampforwp_get_setting('enable-single-social-icons') && checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && is_singular()) {
	        $fb_like = true;
	      }
	    }
	    if ( true == $fb_like ) {
	      if(empty($data['amp_component_scripts']['amp-facebook-like'])){
	        $data['amp_component_scripts']['amp-facebook-like'] = 'https://cdn.ampproject.org/v0/amp-facebook-like-0.1.js';
	      }      
	    }
		return $data;
	}	

	add_filter( 'amp_post_template_data', 'ampforwp_add_amp_related_scripts', 20 );
	function ampforwp_add_amp_related_scripts( $data ) {
		global $redux_builder_amp;
		// Adding Sidebar Script
		if ( isset($redux_builder_amp['ampforwp-amp-menu']) && $redux_builder_amp['ampforwp-amp-menu'] && 4 != $redux_builder_amp['amp-design-selector'] ) { 
			if ( empty( $data['amp_component_scripts']['amp-sidebar'] ) ) {
				$data['amp_component_scripts']['amp-sidebar'] = 'https://cdn.ampproject.org/v0/amp-sidebar-0.1.js';
			}
		}
		return $data;
	}

	// 8. Add Main tag as a Wrapper
	// Removed this code after moving to design manager

	// 9. Advertisement code
		// Moved to ads-functions.php		 
	// 10. Analytics Area
		// Moved to analytics-functions.php
	// 11. Strip unwanted codes and tags from the_content
		add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content');
		function ampforwp_strip_invalid_content() {
			add_filter( 'the_content', 'ampforwp_the_content_filter', 2 );
		}
		function ampforwp_the_content_filter( $content ) {
				 $content = preg_replace('/property=[^>]*/', '', $content);
				 $content = preg_replace('/vocab=[^>]*/', '', $content);
				 $content = preg_replace('/noshade=[^>]*/', '', $content);
				 $content = preg_replace('/contenteditable=[^>]*/', '', $content);
				 $content = preg_replace('/non-refundable=[^>]*/', '', $content);
				 $content = preg_replace('/security=[^>]*/', '', $content);
				 $content = preg_replace('/deposit=[^>]*/', '', $content);
				 $content = preg_replace('/nowrap="nowrap"/', '', $content);
				 $content = preg_replace('#<comments-count.*?>(.*?)</comments-count>#i', '', $content);
				 $content = preg_replace('#<badge.*?>(.*?)</badge>#i', '', $content);
				 $content = preg_replace('#<plusone.*?>(.*?)</plusone>#i', '', $content);
				 $content = preg_replace('#<col.*?>#i', '', $content);
				 //Removed because class is being removed from table #2699
				 $content = preg_replace('/href="javascript:void*/', ' ', $content);
				 // Convert the Wistia embed into URL to build amp-wistia-player and remove unnecesarry wistia code
				 $content = preg_replace('/<script src="(https?).*(\/\/fast|support)(\.wistia\.com\/)(embed\/medias\/)([0-9|\w]+)(.*?)<\/script>/', "$1:$2$3$4$5\n", $content);
				 $content = preg_replace('/<div class="wistia_responsive_padding" (.*?)>/', "", $content);
				 $content = preg_replace('/<div class="wistia_responsive_wrapper" (.*?)>/', "", $content);
				 $content = preg_replace('/<div class="wistia_embed (.*?)>/', "", $content);
				 $content = preg_replace('/<div class="wistia_swatch" (.*?)>/', "", $content);
				 $content = preg_replace('/<img(.*?)src="https:\/\/fast.wistia.com\/embed\/(.*?)"(.*?)\/>/', "", $content);
				 
				 $content = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $content);
				 //for removing attributes within html tags
				 $content = preg_replace('/(<[^>]+) onclick=".*?"/', '$1', $content);
				 // Remove alt attribute from the div tag #2093 
				 $content = preg_replace('/<div(.*?) alt=".*?"(.*?)/', '<div $1', $content);
				 $content = preg_replace('/(<[^>]+) ref=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) imap=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) spellcheck/', '$1', $content);
				 $content = preg_replace('/<font(.*?)>(.*?)<\/font>/', '$2', $content);
				 $content = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $content);
				/// simpy add more elements to simply strip tag but not the content as so
				/// Array ("p","font");
				$tags_to_strip = Array("thrive_headline","type","place","state","city" );
				$tags_to_strip = apply_filters('ampforwp_strip_bad_tags', $tags_to_strip);
				foreach ($tags_to_strip as $tag)
				{
				   $content = preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/",'',$content);
				}
				// regex on steroids from here on
				 $content = preg_replace('/<like\s(.*?)>(.*)<\/like>/i', '', $content);
				 $content = preg_replace('/<g:plusone\s(.*?)>(.*)<\/g:plusone>/i', '', $content);
				 $content = preg_replace('/imageanchor="1"/i', '', $content);
				 $content = preg_replace('/<plusone\s(.*?)>(.*?)<\/plusone>/', '', $content);
				 $content = preg_replace('/xml:lang=[^>]*/', '', $content);
				// Removing the type attribute from the <ul> (Improved after 0.9.63)
				 $content = preg_replace('/<ul(.*?)\btype=".*?"(.*?)/','<ul $1',$content);
				 //Convert the Twitter embed into url for better sanitization #1010
				  $content = preg_replace("/<blockquote(\s)class=\"twitter-(.*?)\"[^>](.*?)<a href=\"(https:\/\/twitter.com\/([a-zA-Z0-9_]{1,20})\/status\/)(.*?)\">(.*?)<\/blockquote>/si", "\n$4$6", $content);
				  // Convert the Soundcloud embed into URL to build amp-soundcloud
				  $content = preg_replace('/<iframe .*(https?).*(\/\/api\.soundcloud\.com\/tracks\/)([0-9]+)(.*)<\/iframe>/', "$1:$2$3", $content);
				  // for readability attibute in div tag
				  $content = preg_replace('/readability=[^>]*/', '', $content);
				  // removing sl-processed attribute
				  $content = preg_replace('/(<[^>]+) sl-processed=".*?"/', '$1', $content);
				  // ga-on
				  $content = preg_replace('/(<[^>]+) ga-on=".*?"/', '$1', $content);
				  // ga-event-category
				  $content = preg_replace('/(<[^>]+) ga-event-category=".*?"/', '$1', $content);
				   // aria-current
				  $content = preg_replace('/(<[^>]+) aria-current=".*?"/', '$1', $content);
				  // Gallery Break fix 
				  $content = preg_replace('/[^\[]\[gallery(.*?)ids=(.*?)\]/', '</p>[gallery$1ids=$2]</p>', $content);
				  // value attribute from anchor tag #2262
				  $content = preg_replace('/<a(.*?)(value=".*?")(.*?)>/', '<a$1$3>', $content);
				  //Compatibility with Cloudflare stream. #3230
				  $content = preg_replace('/<stream[^>]* src="(.*?)"><\/stream>/', '<amp-iframe width="175" height="100" sandbox="allow-scripts allow-same-origin" layout="responsive" allowfullscreen src="https://iframe.cloudflarestream.com/$1"></amp-iframe>', $content);
				  //Compatibility with amp-connatix-player #3524
				  $content = preg_replace('/<script id="(.*?)">(.*?)playerId:\s\'(.*?)\'(.*?)mediaId:\s\'(.*?)\'(.*?)<\/script>/s', '<amp-connatix-player data-player-id="$3" data-media-id = "$5" layout="responsive" width="16" height="9"></amp-connatix-player>', $content);
				  // Fixed CSS syntax error when redgifs iframe is embedded # 4422
				   if(preg_match("/<div\s+style='(.*?)\)'><iframe(.*?)redgifs\.com(.*?)<\/iframe>/", $content)){
				  	  $content = preg_replace("/<div\s+style='(.*?)\)'><iframe(.*?)redgifs\.com(.*?)<\/iframe>/", "<div style='$1'><iframe$2redgifs.com$3</iframe>", $content);
				   }

				return $content;
		}

	// TODO: Remove this function if it's not in use
	// 11.1 Strip unwanted codes and tags from wp_footer for better compatibility with Plugins
		if ( ! is_customize_preview() && ! ampforwp_is_non_amp("non_amp_check_convert") ) {
			add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content_footer');
		}
		function ampforwp_strip_invalid_content_footer() {
			add_filter( 'wp_footer', 'ampforwp_the_content_filter_footer', 1 );
		}
		function ampforwp_the_content_filter_footer( $content ) {
            remove_all_actions('wp_footer');
				return $content;
		}

	// 12. Add Logo URL in the structured metadata
	// Moved to structured-data-functions.php

	// 13. Add Custom Placeholder Image for Structured Data.
	// if there is no image in the post, then use this image to validate Structured Data.
	// Moved to structured-data-functions.php

// 14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
/**
 * Adds a meta box to the post editing screen for AMP on-off on specific pages
*/
function ampforwp_title_custom_meta() {
    global $redux_builder_amp;
    global $post_id;
    $post_types = ampforwp_get_all_post_types();

    if ( $post_types && (ampforwp_role_based_access_options() == true && ( current_user_can('edit_posts') || current_user_can('edit_pages') ) ) ) { // If there are any custom public post types.

        foreach ( $post_types  as $post_type ) {

          if( $post_type == 'amp-cta' || $post_type == 'amp-optin' ) {
							continue;
          }
          // Posts
	      if( ampforwp_get_setting('amp-on-off-for-all-posts') && $post_type == 'post' ) {
	        add_meta_box( 'ampforwp_title_meta', esc_html__( 'Show AMP for Current Post?','accelerated-mobile-pages' ), 'ampforwp_title_callback', 'post','side' );      
	      }
	      // Pages
          $frontpage_id = ampforwp_get_the_ID();
          $page_for_posts = intval(get_option( 'page_for_posts' ));
          if( ampforwp_get_setting('amp-on-off-for-all-pages') && $post_type == 'page' || ( true == ampforwp_get_setting('amp-frontpage-select-option') && $post_id == $frontpage_id ) || ($post_id == $page_for_posts)) {
              add_meta_box( 'ampforwp_title_meta', esc_html__( 'Show AMP for Current Page?' ,'accelerated-mobile-pages'), 'ampforwp_title_callback','page','side' );
          }
          // Custom Post Types
          if( $post_type !== 'page' && $post_type !== 'post' ) {
            add_meta_box( 'ampforwp_title_meta', esc_html__( 'Show AMP for Current Page?','accelerated-mobile-pages' ), 'ampforwp_title_callback', $post_type,'side' );          
          }
          
          }

        }
    }

add_action( 'add_meta_boxes', 'ampforwp_title_custom_meta' );

/**
 * Outputs the content of the meta box for AMP on-off on specific pages
 */
function ampforwp_title_callback( $post ) {
	global $redux_builder_amp;
    wp_nonce_field( basename( __FILE__ ), 'ampforwp_title_nonce' );
    $ampforwp_stored_meta = get_post_meta( $post->ID );
    $hide_show = '';
    if(isset($ampforwp_stored_meta['ampforwp-amp-on-off'])){
    	$hide_show = $ampforwp_stored_meta['ampforwp-amp-on-off'];
    }else{
    	$hide_show = ampforwp_get_setting('amp-pages-meta-default');
    }
    if(!isset($ampforwp_stored_meta['ampforwp-amp-on-off'])){
    	$ampforwp_stored_meta['ampforwp-amp-on-off'][0] = 'default';
    }
    $preview_query_args = array();
	$preview_link = $list_of_posts = $skip_this_post = '';
	$preview_query_args = array(AMPFORWP_AMP_QUERY_VAR => 1);
	$preview_link = get_preview_post_link($post, $preview_query_args );
	$exclude_post_value = array();
	if ( ampforwp_posts_to_remove() && $post->post_type == 'post' ) {
		$ampforwp_stored_meta['ampforwp-amp-on-off'][0] = 'hide-amp';
	}
	$exclude_post_value = ampforwp_exclude_posts();
	// if hide-amp is selected, add it in the $exclude_post_value
	if ( 'hide-amp' == ( isset($ampforwp_stored_meta['ampforwp-amp-on-off'][0]) && $ampforwp_stored_meta['ampforwp-amp-on-off'][0] ) && 'page' != $post->post_type ) {
		if ( ! in_array($post->ID, $exclude_post_value) ) {
			$exclude_post_value[] = $post->ID;
			set_transient('ampforwp_exclude_post_transient', $exclude_post_value);
		} 
	}
	if ( ( 'default' == ( isset($ampforwp_stored_meta['ampforwp-amp-on-off'][0]) && $ampforwp_stored_meta['ampforwp-amp-on-off'][0] ) || !isset($ampforwp_stored_meta['ampforwp-amp-on-off'][0]) ) && 'page' != $post->post_type ) {
		if ( in_array($post->ID, $exclude_post_value) ) {
			$exclude_post_value = array_flip($exclude_post_value);
			unset($exclude_post_value[$post->ID] );
			$exclude_post_value = array_flip($exclude_post_value);
			set_transient('ampforwp_exclude_post_transient', $exclude_post_value);
		} 
	}
	if ($post->post_type == 'page' && ampforwp_get_setting('amp-pages-meta-default') == 'hide' && ($hide_show=='hide' || $hide_show=='hide-amp')) {
		$ampforwp_stored_meta['ampforwp-amp-on-off'][0] = 'hide-amp';
	}?>
    <p>
        <div class="prfx-row-content">
            <label class="meta-radio-two" for="ampforwp-on-off-meta-radio-one">
                <input type="radio" name="ampforwp-amp-on-off" id="ampforwp-on-off-meta-radio-one" value="default"  checked="checked" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-amp-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-amp-on-off'][0], 'default' ); ?>>
                <?php esc_html_e( 'Show', 'accelerated-mobile-pages' )?>
            </label>
            <label class="meta-radio-two" for="ampforwp-on-off-meta-radio-two">
                <input type="radio" name="ampforwp-amp-on-off" id="ampforwp-on-off-meta-radio-two" value="hide-amp" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-amp-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-amp-on-off'][0], 'hide-amp' ); ?>>
                <?php esc_html_e( 'Hide', 'accelerated-mobile-pages' )?>
            </label>
             <?php
             if($post->post_status == 'publish') {
	             add_thickbox(); ?>
	             <div class="ampforwp-preview-button-container"> 
					<input alt="#TB_inline?height=1135&amp;width=718&amp;inlineId=ampforwp_preview" title="AMP Mobile Preview" class="thickbox ampforwp-preview-button preview button amp-preview-button" type="button" value="Preview AMP" />  
				 </div>
			<?php } ?>   
        </div>
    </p>
    <!-- AMP Preview --> 
    <div id="ampforwp_preview" style="display:none">
	 	<div id="ampforwp-preview-format">
	        <div class="row">
	            <div class="col-sm-12 margin-top-bottom text-center">
	            	<div class="ampforwp-preview-phone-frame-wrapper">
	                    <div class="ampforwp-preview-phone-frame">
	                        <div class="ampforwp-preview-container" id="amp-preview-iframe" data-src="<?php echo $preview_link; ?>">
	                        </div> 
	                    </div>
	                </div>
	            </div>
	        </div>
    	</div>
	</div>   
<?php 
	if ( get_option('page_on_front') == $post->ID && false == $redux_builder_amp['amp-frontpage-select-option'] ) {
		echo sprintf(('<p class="afp"><b> %s </b> <a class="" target= "_blank" href="%s">%s</a></p>'), esc_html__('We have detected that you have not setup the FrontPage for AMP,','accelerated-mobile-pages'),admin_url("admin.php?page=amp_options&tabid=opt-text-subsection#redux_builder_amp-ampforwp-homepage-on-off-support"),esc_html__('Click here to setup','accelerated-mobile-pages'));
	}
	if ( true == $redux_builder_amp['amp-frontpage-select-option'] && $post->ID == $redux_builder_amp['amp-frontpage-select-option-pages'] ) {
		echo sprintf('<p>%s</p>', esc_html__('AMP FrontPage'));
	}
}

/**
 * Adds a meta box to the post editing screen for Mobile Redirection on-off on specific pages
 */ 

function ampforwp_mobile_redirection() {
  	global $redux_builder_amp;
    $post_types = ampforwp_get_all_post_types();

    if ( $post_types && ampforwp_role_based_access_options() == true ) { // If there are any custom public post types.

        foreach ( $post_types  as $post_type ) {

	        if( $post_type == 'amp-cta' || $post_type == 'amp-optin' ) {
				continue;
	        }
	         // Posts
	         if( ampforwp_get_setting('amp-on-off-for-all-posts') && $post_type == 'post' ) {
	        	if ( ampforwp_get_setting('amp-mobile-redirection') ) {
	        		add_meta_box( 'ampforwp_title_meta_redir', esc_html__( 'Mobile Redirection for Current Page?','accelerated-mobile-pages' ), 'ampforwp_title_callback_redirection', 'post','side' );
	        	}
	        }
	        // Pages
          	if( ampforwp_get_setting('amp-on-off-for-all-pages') && $post_type == 'page' ) {
	          	if ( ampforwp_get_setting('amp-mobile-redirection') ) {
		          	add_meta_box( 'ampforwp_title_meta_redir', esc_html__( 'Mobile Redirection for Current Page?' ,'accelerated-mobile-pages'), 'ampforwp_title_callback_redirection','page','side' );
	               }
	            }
	          // Custom Post Types
	         if( $post_type !== 'page' && $post_type !== 'post' ) {
	        	if (ampforwp_get_setting('amp-mobile-redirection') ) {
	        		add_meta_box( 'ampforwp_title_meta_redir', esc_html__( 'Mobile Redirection for Current Page?','accelerated-mobile-pages' ), 'ampforwp_title_callback_redirection', $post_type,'side' );
	        		}
	        	}
          	}

        }
    }

add_action( 'add_meta_boxes', 'ampforwp_mobile_redirection' );

/**
 * Outputs the content of the meta box for Mobile Redirection on-off on specific pages
 */
function ampforwp_title_callback_redirection( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ampforwp_title_nonce' );
    $ampforwp_redirection_stored_meta = get_post_meta( $post->ID );?>
    <p>
        <div class="prfx-row-content">
            <label for="meta-redirection-radio-one">
                <input type="radio" name="ampforwp-redirection-on-off" id="meta-redirection-radio-one" value="enable"  checked="checked" <?php if ( isset ( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'] ) ) checked( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'][0], 'enable' ); ?>>
                <?php esc_html_e( 'Enable', 'accelerated-mobile-pages' )?>
            </label>
            <label for="meta-redirection-radio-two">
                <input type="radio" name="ampforwp-redirection-on-off" id="meta-redirection-radio-two" value="disable" <?php if ( isset ( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'] ) ) checked( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'][0], 'disable' ); ?>>
                <?php esc_html_e( 'Disable', 'accelerated-mobile-pages' )?>
            </label>
        </div>
    </p>

    <?php
}

function ampforwp_meta_redirection_status(){
	global $post;
	$ampforwp_redirection_post_on_off_meta = '';

	if ( (! is_404() && ampforwp_is_search_has_results() )  && (is_singular() ||  ampforwp_is_front_page()) ) {
		$ampforwp_redirection_post_on_off_meta = get_post_meta( $post->ID,'ampforwp-redirection-on-off',true);
	}

	if ( empty( $ampforwp_redirection_post_on_off_meta ) ) {
		$ampforwp_redirection_post_on_off_meta = 'enable';
	}
	$ampforwp_redirection_post_on_off_meta = apply_filters('ampforwp_disable_mobile_redirection', $ampforwp_redirection_post_on_off_meta);
	return $ampforwp_redirection_post_on_off_meta;

}

// Added the check to see if any search results exists
function ampforwp_is_search_has_results() {
    return 0 != $GLOBALS['wp_query']->found_posts;
}

/**
 * Saves the custom meta input for AMP on-off on specific pages
 */
function ampforwp_title_meta_save( $post_id ) {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
         return ;
    }
	$ampforwp_amp_status = '';

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'ampforwp_title_nonce' ] ) && wp_verify_nonce( $_POST[ 'ampforwp_title_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    $is_valid_nonce_ia = ( isset( $_POST[ 'ampforwp_ia_nonce' ] ) && wp_verify_nonce( $_POST[ 'ampforwp_ia_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce || !$is_valid_nonce_ia) {
        return;
    }

    // Checks for radio buttons and saves if needed
    if( isset( $_POST[ 'ampforwp-amp-on-off' ] ) ) {
        $ampforwp_amp_status = sanitize_text_field( $_POST[ 'ampforwp-amp-on-off' ] );
        update_post_meta( $post_id, 'ampforwp-amp-on-off', $ampforwp_amp_status );
    }
    if( isset( $_POST[ 'ampforwp-ia-on-off' ] ) ) {
        $ampforwp_amp_status = sanitize_text_field( $_POST[ 'ampforwp-ia-on-off' ] );
        update_post_meta( $post_id, 'ampforwp-ia-on-off', $ampforwp_amp_status );
    }
     if( isset( $_POST[ 'ampforwp-redirection-on-off' ] ) ) {
        $ampforwp_redirection_status = sanitize_text_field( $_POST[ 'ampforwp-redirection-on-off' ] );
        update_post_meta( $post_id, 'ampforwp-redirection-on-off', $ampforwp_redirection_status );
    }

}
add_action( 'save_post', 'ampforwp_title_meta_save' );

// 15. Disable New Relic's extra script that its adds in AMP pages.
add_action( 'amp_post_template_data', 'ampforwp_disable_new_relic_scripts' );
if ( ! function_exists('ampforwp_disable_new_relic_scripts') ) {
		function ampforwp_disable_new_relic_scripts( $data ) {
			if ( ! function_exists( 'newrelic_disable_autorum' ) ) {
				return $data;
			}
			if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
				newrelic_disable_autorum();
			}
			return $data;
		}
}
// TODO: Remove this function if its not in use
// 16. Remove Unwanted Scripts
if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
	add_action( 'wp_enqueue_scripts', 'ampforwp_remove_unwanted_scripts',20 );
}
function ampforwp_remove_unwanted_scripts() {
  wp_dequeue_script('jquery');
}
// Remove Print Scripts and styles
function ampforwp_remove_print_scripts() {
	if ( ampforwp_is_amp_endpoint() ) {
	    function ampforwp_remove_all_scripts() {
	        global $wp_scripts;
	        $wp_scripts->queue = array();
	    }
	    add_action('wp_print_scripts', 'ampforwp_remove_all_scripts', 100);
	    function ampforwp_remove_all_styles() {
	        global $wp_styles;
	        $wp_styles->queue = array();
	    }
	    add_action('wp_print_styles', 'ampforwp_remove_all_styles', 100);

			// Remove Print Emoji for Nextgen Gallery support
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}
}
// TODO: Remove this function if its not in use
// add_action( 'template_redirect', 'ampforwp_remove_print_scripts' );

// 19. Remove Canonical tags
function ampforwp_amp_remove_actions() {
    if ( is_home() || is_front_page() || is_archive() || is_search() ) {
        remove_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
    }
}
add_action( 'amp_post_template_head', 'ampforwp_amp_remove_actions', 9 );

// 21. Remove Schema data from All In One Schema.org Rich Snippets Plugin 
add_action( 'pre_amp_render_post', 'ampforwp_remove_schema_data' );
function ampforwp_remove_schema_data() {
	$amp_custom_content_enable = '';
	remove_filter('the_content','display_rich_snippet');
    	// Ultimate Social Media PLUS Compatiblity Added
	remove_filter('the_content','sfsi_plus_beforaftereposts');
	remove_filter('the_content','sfsi_plus_beforeafterblogposts');

	$amp_custom_content_enable = get_post_meta( ampforwp_get_the_ID() , 'ampforwp_custom_content_editor_checkbox', true);
	// Thrive Content Builder
	if ($amp_custom_content_enable == 'yes') {
		remove_filter( 'the_content', 'tve_editor_content', 10 );
	}

	// Removed GTranslate Flags from AMP pages #819
	remove_filter('wp_nav_menu_items', 'gtranslate_menu_item', 10, 2);

	// Remove elements of WP Like Button plugin #841
	remove_filter('the_content', 'fb_like_button');
	remove_filter('the_excerpt', 'fb_like_button');

	// Compatibility issue with the rocket lazy load  #907
    remove_filter( 'the_content' , 'rocket_lazyload_images', PHP_INT_MAX );
    remove_filter( 'the_content', 'rocket_lazyload_iframes', PHP_INT_MAX );
	add_filter( 'do_rocket_lazyload', '__return_false' );

	// Compatibility with the CIARO theme #4220
	if(defined('CAIRO_THEME_VERSION')){
		remove_filter( 'amp_post_template_file', 'amp_set_custom_template');
	}

	// Remove Popups and other elements added by Slider-in Plugin
	define('WDSI_BOX_RENDERED', true, false); // when third argument is true, getting Deprecated debug warning in php 7.3.2
	
	// Remove Filters added by third party plugin through class
	if ( function_exists('ampforwp_remove_filters_for_class')) {
		//Remove Disallowed 'like' tag from facebook Like button by Ultimate Facebook
		ampforwp_remove_filters_for_class( 'the_content', 'Wdfb_UniversalWorker', 'inject_facebook_button', 10 );
		//Removing the Monarch social share icons from AMP
		ampforwp_remove_filters_for_class( 'the_content', 'ET_Monarch', 'display_inline', 10 );
		ampforwp_remove_filters_for_class( 'the_content', 'ET_Monarch', 'display_media', 9999 );
		//Compatibility with wordpress twitter bootstrap #525
		ampforwp_remove_filters_for_class( 'the_content', 'ICWP_WPTB_CssProcessor_V1', 'run', 10 );
		//Perfect SEO url + Yoast SEO Compatibility #982
		ampforwp_remove_filters_for_class( 'wpseo_canonical', 'PSU', 'canonical', 10 );
		// SmartMag Compatibility 
		ampforwp_remove_filters_for_class( 'amp_post_template_dir', 'Bunyad_Theme_Amp', 'template_dir', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_data', 'Bunyad_Theme_Amp', 'setup_data', 10 );
		// Remove Jannah Image Lazy Load #2224
		ampforwp_remove_filters_for_class( 'wp_get_attachment_image_attributes', 'TIELABS_FILTERS', 'lazyload_image_attributes', 8 );
		// Social Share by Supsystic Compatibility #1509
		ampforwp_remove_filters_for_class( 'the_content', 'SocialSharing_Projects_Handler', 'applyContentCallback', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_head', 'SocialSharing_Projects_Handler', 'addedStylesForAMP', 10 );
		// Remove JPG, PNG Compression and Optimization Plugin Lazy Load #2322
		ampforwp_remove_filters_for_class( 'the_content', 'Wp_Image_compression', 'filter_images', 200 );
		// Remove Publisher theme menu in amp #2672
		ampforwp_remove_filters_for_class( 'wp_nav_menu_args', 'BF_Menus', 'walker_front', 10 );
		// Removing Smush Pro Lazy Load plugin #2990
		ampforwp_remove_filters_for_class( 'the_content', 'WP_Smush_Lazy_Load', 'set_lazy_load_attributes', 100 );
		ampforwp_remove_filters_for_class( 'post_thumbnail_html', 'WP_Smush_Lazy_Load', 'set_lazy_load_attributes', 100 );
		// Removing A3 Lazy Load plugin #2872
		ampforwp_remove_filters_for_class( 'the_content', 'A3_Lazy_Load', 'filter_content_images', 100 );
		//optimole plugin images get removed in AMP #3073
		ampforwp_remove_filters_for_class( 'optml_content_url', 'Optml_Url_Replacer', 'build_image_url', 1, 2 );
		//Removed style tag appending before Html tag for themify pagebuilder #3376 
		ampforwp_remove_filters_for_class( 'the_content', 'Themify_Builder', 'builder_show_on_front', 11 );
		ampforwp_remove_filters_for_class( 'the_content', 'Themify_Builder', 'builder_clear_static_content', 1 );
		if(defined('EZOIC__PLUGIN_NAME')){
			ampforwp_remove_filters_for_class( 'shutdown', 'Ezoic_Namespace\Ezoic_Integration_Public', 'ez_buffer_end', 0 );
		}	
		if (class_exists('AddWidgetAfterContent')) {
			ampforwp_remove_filters_for_class( 'the_content', 'AddWidgetAfterContent', 'insert_after_content', 10 );
		}
		// Yoast Schema Compatibility #3332
		if( ampforwp_get_setting('ampforwp-seo-selection') != "yoast"){
			ampforwp_remove_filters_for_class( 'amp_post_template_head', 'WPSEO_Schema', 'json_ld', 9 );
		}
		//SiteOrigin Page builder compatibilty with AMP Frontpage
		if ( ampforwp_is_front_page() ) {
				ampforwp_remove_filters_for_class( 'the_content', 'SiteOrigin_Panels', 'generate_post_content', 10 );
		}
		//Addition HTTP added in canonical from Yoast SEO Multilingual #4970
		if (class_exists('WPML_WPSEO_Filters')) {
			ampforwp_remove_filters_for_class( 'wpseo_canonical', 'WPML_WPSEO_Filters', 'canonical_filter', 10 );
		}
		//SiteOrigin Page builder compatibilty
		//Neglect SOPB If Custom AMP Editor is checked
	      if ( $amp_custom_content_enable === 'yes') {
				ampforwp_remove_filters_for_class( 'the_content', 'SiteOrigin_Panels', 'generate_post_content', 10 );
				ampforwp_remove_filters_for_class( 'the_content', 'Elementor\Frontend', 'apply_builder_in_content', 9 );
			}
			if(class_exists('Wppr_Public')){
				remove_action('amp_post_template_css', array('Wppr_Public', 'amp_styles')); 
				remove_action('wppr_review_option_rating_css', array('Wppr_Public', 'amp_width_support')); 
			}
			if (class_exists('WPSEO_Video_Embed')) {
		 		ampforwp_remove_filters_for_class( 'render_block', 'WPSEO_Video_Embed', 'replace_youtube_block_html', 10 );
			}		
	}
	//Removing the WPTouch Pro social share links from AMP
		remove_filter( 'the_content', 'foundation_handle_share_links_bottom', 100 );
	//Removing the space added by the Google adsense #967
		remove_filter( 'the_content', 'ga_strikable_add_optimized_adsense_code');
	//Removing Social Media Share Buttons & Social Sharing Icons #1135
		remove_filter('the_content', 'sfsi_social_buttons_below');
	// Removing WordPress Social Share Buttons #1272
    	remove_filter ('the_content', 'FTGSB');
    // Jannah Theme Lazy Load Compatibility
    	remove_filter( 'wp_get_attachment_image_attributes', 'jannah_lazyload_image_attributes', 8, 3 );
    // Goodlife Theme Lazy Load Compatibility
    	remove_filter( 'post_thumbnail_html', 'thb_src_attribute', 10, 3 );
    // MediaAce lazy load compatibility
    	remove_filter( 'wp_get_attachment_image_attributes', 'mace_lazy_load_attachment', 10, 3);
		remove_filter( 'the_content', 'mace_lazy_load_content_image' );
	// SEO Post Content Links compatibility
	if ( class_exists('cl_core') ) {
		remove_action('the_content', array( 'cl_core', 'getPost' ) );
	}
	// Theia Post Slider compatibility
	if ( class_exists('TpsContent') ) {
		remove_action('the_post', 'TpsContent::the_post', 999999);
	}
	// Jarida Theme Compatibility #1842
	remove_filter( 'option_posts_per_page', 'tie_option_posts_per_page' );

	// IWappPress Compatibility #1876 #1864
	remove_action('loop_start', 'iWappPress_remove_post_date');

	// Facebook Button by BestWebSoft Compatibility #1740
	remove_filter( 'the_content', 'fcbkbttn_display_button' );
	
	// Click Mag compatibility #2796
	remove_filter( 'amp_post_template_file', 'mvp_amp_set_custom_template', 10, 3 );
	remove_action('amp_post_template_head','mvp_amp_google_font');

	// Digg Digg Compatibility
    remove_filter('the_excerpt', 'dd_hook_wp_content');
    remove_filter('the_content', 'dd_hook_wp_content');

	// Removing Voux theme's lazyloading #2263
	remove_filter( 'the_content', 'thb_lazy_images_filter', 200 );
	remove_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );
	//Custom Frontpage not working when we select the option to display blog in enfold theme #2943
	remove_filter('pre_option_page_for_posts', 'avia_page_for_posts_filter');
		// WP Rocket #3062
	if ( function_exists('rocket_init') ) {
		global $wp_filter;
		remove_filter( 'wp_resource_hints', 'rocket_dns_prefetch', 10, 2 );
		add_filter( 'do_rocket_lazyload', '__return_false' );
		unset( $wp_filter['rocket_buffer'] );
		// this filter is documented in inc/front/protocol.php.
		$do_rocket_protocol_rewrite = apply_filters( 'do_rocket_protocol_rewrite', false );
 		if ( function_exists('get_rocket_option') && ( get_rocket_option( 'do_cloudflare', 0 ) && get_rocket_option( 'cloudflare_protocol_rewrite', 0 ) || $do_rocket_protocol_rewrite ) ) {
			remove_filter( 'rocket_buffer', 'rocket_protocol_rewrite', PHP_INT_MAX );
			remove_filter( 'wp_calculate_image_srcset', 'rocket_protocol_rewrite_srcset', PHP_INT_MAX );
		}
	}
	//remove filter for Impreza theme lazyload feature 
	remove_filter( 'the_content', 'us_filter_content_for_lazy_load', 99, 1 );

	if( function_exists('rehub_framework_register_scripts')){
		remove_filter("ampforwp_template_locate", "rhampforwp_update_template_folder");
		remove_filter('amp_post_template_file', 'rehub_amp_delete_custom_title_section',11,3);
	}
	
	// Publisher theme lazy load #3063
	if( class_exists('Publisher') ){
		remove_filter( 'post_thumbnail_html', 'publisher_lazy_loading_img_tags', 6 );
		remove_filter( 'the_content', 'publisher_lazy_loading_img_tags', 6 );
	}
	if(ampforwp_get_setting('ampforwp-seo-yoast-schema') == false && ampforwp_get_setting('ampforwp-seo-selection') == 'yoast'){
		if( class_exists('WPSEO_Schema') ){
			add_filter('wpseo_json_ld_output', 'ampforwp_remove_yoast_json', 10, 1);
		}
	}
}
function ampforwp_remove_yoast_json($data){
    $data = array();
    return $data;
}	
// 22. Removing author links from comments Issue #180
if( ! function_exists( 'ampforwp_disable_comment_author_links' ) ) {
	function ampforwp_disable_comment_author_links( $author_link ){
		$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();
		if ( $ampforwp_is_amp_endpoint ) {
			return strip_tags( $author_link );
		} else {
			return $author_link;
		}
	}
	add_filter( 'get_comment_author_link', 'ampforwp_disable_comment_author_links' );
}

// 23. The analytics tag appears more than once in the document. This will soon be an error
remove_action( 'amp_post_template_head', 'quads_amp_add_amp_ad_js');

// 24. Seperate Sticky Single Social Icons
// TO DO: we can directly call social-icons.php instead of below code
add_action('amp_post_template_footer','ampforwp_sticky_social_icons');
function ampforwp_sticky_social_icons(){
	global $redux_builder_amp;
	// Social share in AMP 
	$amp_permalink = $facebook_app_id = $amp_permalink_fb_messenger = "";
	$facebook_app_id = ampforwp_get_setting('amp-facebook-app-id-messenger');
	if ( ampforwp_get_setting('ampforwp-social-share-amp')  ) {
		$amp_permalink = ampforwp_url_controller(get_the_permalink());
	} else{
		$amp_permalink = get_the_permalink();
	}
	if($facebook_app_id){
		$amp_permalink_fb_messenger = untrailingslashit($amp_permalink). '&app_id='. $facebook_app_id;
	}
	if( (ampforwp_get_setting('enable-single-social-icons') == true && is_single()) || (is_page() && true == $redux_builder_amp['ampforwp-page-sticky-social']))  { 
		$image = '';
		if ( ampforwp_has_post_thumbnail( ) ){
			$image = ampforwp_get_post_thumbnail( 'url', 'full' );
		}
		$permalink = '';
		if(false == ampforwp_get_setting('enable-single-twitter-share-link')){
			$permalink = wp_get_shortlink();
		}
		else
			$permalink = $amp_permalink;
		?>
			<div class="s_so">
			<?php if ( true == ampforwp_get_setting('ampforwp-facebook-like-button') && false == ampforwp_get_setting('ampforwp-facebook-like-data-action')) {
			$facebook_like_url = '';
			$facebook_like_url = $amp_permalink;
			if ( $facebook_like_url ) { ?>
				<amp-facebook-like width=90 height=18
				 	layout="fixed"
				 	data-size="large"
				    data-layout="button_count"
				    <?php ampforwp_rel_attributes_social_links(); ?>
				    data-href="<?php echo esc_url($facebook_like_url); ?>">
				</amp-facebook-like>
			<?php }
			}elseif ( true == ampforwp_get_setting('ampforwp-facebook-like-button') && true == ampforwp_get_setting('ampforwp-facebook-like-data-action')){
			$fblikewidth = ampforwp_get_setting('ampforwp-facebook-like-width');
				if(empty($fblikewidth)){
					$fblikewidth = "140";
				}
			?>
			<amp-facebook-like <?php echo "width=". esc_attr($fblikewidth) ."" ?> height=18 style="margin-bottom:-18px;"
				layout="fixed"
				data-size="large"
				data-action="recommend"
				data-layout="button_count" <?php ampforwp_rel_attributes_social_links(); ?>
				data-href="<?php echo esc_url(get_the_permalink());?>">
			</amp-facebook-like><?php } ?> 
				<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
			    	<amp-social-share type="facebook" data-param-app_id="<?php echo esc_attr($redux_builder_amp['amp-facebook-app-id']); ?>" width="50" height="28"></amp-social-share>
			    <a title="facebook share" class="s_fb" target="_blank" <?php ampforwp_rel_attributes_social_links(); ?> href="https://www.facebook.com/sharer.php?u=<?php echo esc_url($amp_permalink); ?>"></a>	
			  	<?php } ?>
			  	<?php if(true == ampforwp_get_setting('enable-single-facebook-share-messenger')  && $amp_permalink_fb_messenger!=''){?>
			<a title="facebook share messenger"  <?php ampforwp_rel_attributes_social_links(); ?> target="_blank" href="fb-messenger://share/?link=<?php echo esc_url($amp_permalink_fb_messenger); ?>">
				<div class="a-so-i a-so-facebookmessenger">
					<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/messenger.png') ?>" width="20" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-twitter-share') == true)  {
	    $data_param_data = ampforwp_get_setting('enable-single-twitter-share-handle');
	    $data_param_data = str_replace('@', '', $data_param_data);?>
	          <amp-social-share type="twitter"
	                            width="50"
	                            height="28"
	                            aria-label="twitter"
	                            <?php ampforwp_rel_attributes_social_links(); ?>
	                            data-param-url=""
                        		data-param-text="TITLE <?php echo esc_url($permalink).' '.ampforwp_translation( $redux_builder_amp['amp-translator-via-text'], 'via' ).' '.esc_attr($data_param_data) ?>"
	          ></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
			    	<amp-social-share type="email"      width="50" height="28" aria-label="email" <?php ampforwp_rel_attributes_social_links(); ?>></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
			    	<amp-social-share type="pinterest"  width="50" height="28" aria-label="pinterest" <?php ampforwp_rel_attributes_social_links(); ?> data-param-media = "<?php echo esc_url($image); ?>"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
			    	<amp-social-share type="linkedin" width="50" height="28" aria-label="linkedin" <?php ampforwp_rel_attributes_social_links(); ?>></amp-social-share>
			  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-whatsapp-share'] == true)  { ?>
			<a title="whatsapp share" <?php ampforwp_rel_attributes_social_links(); ?> href="https://api.whatsapp.com/send?text=<?php echo esc_attr(htmlspecialchars(get_the_title()))."&nbsp;".esc_url($amp_permalink);?>">
			<div class="a-so-i">
			    <amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTAgOTAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkwIDkwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IldoYXRzQXBwIiBkPSJNOTAsNDMuODQxYzAsMjQuMjEzLTE5Ljc3OSw0My44NDEtNDQuMTgyLDQzLjg0MWMtNy43NDcsMC0xNS4wMjUtMS45OC0yMS4zNTctNS40NTVMMCw5MGw3Ljk3NS0yMy41MjIgICBjLTQuMDIzLTYuNjA2LTYuMzQtMTQuMzU0LTYuMzQtMjIuNjM3QzEuNjM1LDE5LjYyOCwyMS40MTYsMCw0NS44MTgsMEM3MC4yMjMsMCw5MCwxOS42MjgsOTAsNDMuODQxeiBNNDUuODE4LDYuOTgyICAgYy0yMC40ODQsMC0zNy4xNDYsMTYuNTM1LTM3LjE0NiwzNi44NTljMCw4LjA2NSwyLjYyOSwxNS41MzQsNy4wNzYsMjEuNjFMMTEuMTA3LDc5LjE0bDE0LjI3NS00LjUzNyAgIGM1Ljg2NSwzLjg1MSwxMi44OTEsNi4wOTcsMjAuNDM3LDYuMDk3YzIwLjQ4MSwwLDM3LjE0Ni0xNi41MzMsMzcuMTQ2LTM2Ljg1N1M2Ni4zMDEsNi45ODIsNDUuODE4LDYuOTgyeiBNNjguMTI5LDUzLjkzOCAgIGMtMC4yNzMtMC40NDctMC45OTQtMC43MTctMi4wNzYtMS4yNTRjLTEuMDg0LTAuNTM3LTYuNDEtMy4xMzgtNy40LTMuNDk1Yy0wLjk5My0wLjM1OC0xLjcxNy0wLjUzOC0yLjQzOCwwLjUzNyAgIGMtMC43MjEsMS4wNzYtMi43OTcsMy40OTUtMy40Myw0LjIxMmMtMC42MzIsMC43MTktMS4yNjMsMC44MDktMi4zNDcsMC4yNzFjLTEuMDgyLTAuNTM3LTQuNTcxLTEuNjczLTguNzA4LTUuMzMzICAgYy0zLjIxOS0yLjg0OC01LjM5My02LjM2NC02LjAyNS03LjQ0MWMtMC42MzEtMS4wNzUtMC4wNjYtMS42NTYsMC40NzUtMi4xOTFjMC40ODgtMC40ODIsMS4wODQtMS4yNTUsMS42MjUtMS44ODIgICBjMC41NDMtMC42MjgsMC43MjMtMS4wNzUsMS4wODItMS43OTNjMC4zNjMtMC43MTcsMC4xODItMS4zNDQtMC4wOS0xLjg4M2MtMC4yNy0wLjUzNy0yLjQzOC01LjgyNS0zLjM0LTcuOTc3ICAgYy0wLjkwMi0yLjE1LTEuODAzLTEuNzkyLTIuNDM2LTEuNzkyYy0wLjYzMSwwLTEuMzU0LTAuMDktMi4wNzYtMC4wOWMtMC43MjIsMC0xLjg5NiwwLjI2OS0yLjg4OSwxLjM0NCAgIGMtMC45OTIsMS4wNzYtMy43ODksMy42NzYtMy43ODksOC45NjNjMCw1LjI4OCwzLjg3OSwxMC4zOTcsNC40MjIsMTEuMTEzYzAuNTQxLDAuNzE2LDcuNDksMTEuOTIsMTguNSwxNi4yMjMgICBDNTguMiw2NS43NzEsNTguMiw2NC4zMzYsNjAuMTg2LDY0LjE1NmMxLjk4NC0wLjE3OSw2LjQwNi0yLjU5OSw3LjMxMi01LjEwN0M2OC4zOTgsNTYuNTM3LDY4LjM5OCw1NC4zODYsNjguMTI5LDUzLjkzOHoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="50" height="20" alt="whatsapp" />
			    </div>
				</a>
	        <?php } ?>
        <?php if(ampforwp_get_setting('enable-single-line-share') == true)  { 
				$line_share = 'http://line.me/R/msg/text/';
				$line_amp_permalink = add_query_arg($amp_permalink,'', $line_share );
	        ?>
			<a title="line share" <?php ampforwp_rel_attributes_social_links(); ?> href="<?php echo esc_url($line_amp_permalink); ?>">
				<div class="a-so-i custom-amp-socialsharing-line">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="50" height="20"  alt="line" />
				</div>
			</a>
		<?php } ?>
		<?php if($redux_builder_amp['enable-single-vk-share'] == true)  { ?>
			<a title="vkontakte share" <?php ampforwp_rel_attributes_social_links(); ?> href="http://vk.com/share.php?url=<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="a-so-i a-so-vk"> 
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMDQuMzYgMzA0LjM2IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMDQuMzYgMzA0LjM2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGcgaWQ9IlhNTElEXzFfIj4KCTxwYXRoIGlkPSJYTUxJRF84MDdfIiBzdHlsZT0iZmlsbC1ydWxlOmV2ZW5vZGQ7Y2xpcC1ydWxlOmV2ZW5vZGQ7IiBkPSJNMjYxLjk0NSwxNzUuNTc2YzEwLjA5Niw5Ljg1NywyMC43NTIsMTkuMTMxLDI5LjgwNywyOS45ODIgICBjNCw0LjgyMiw3Ljc4Nyw5Ljc5OCwxMC42ODQsMTUuMzk0YzQuMTA1LDcuOTU1LDAuMzg3LDE2LjcwOS02Ljc0NiwxNy4xODRsLTQ0LjM0LTAuMDJjLTExLjQzNiwwLjk0OS0yMC41NTktMy42NTUtMjguMjMtMTEuNDc0ICAgYy02LjEzOS02LjI1My0xMS44MjQtMTIuOTA4LTE3LjcyNy0xOS4zNzJjLTIuNDItMi42NDItNC45NTMtNS4xMjgtNy45NzktNy4wOTNjLTYuMDUzLTMuOTI5LTExLjMwNy0yLjcyNi0xNC43NjYsMy41ODcgICBjLTMuNTIzLDYuNDIxLTQuMzIyLDEzLjUzMS00LjY2OCwyMC42ODdjLTAuNDc1LDEwLjQ0MS0zLjYzMSwxMy4xODYtMTQuMTE5LDEzLjY2NGMtMjIuNDE0LDEuMDU3LTQzLjY4Ni0yLjMzNC02My40NDctMTMuNjQxICAgYy0xNy40MjItOS45NjgtMzAuOTMyLTI0LjA0LTQyLjY5MS0zOS45NzFDMzQuODI4LDE1My40ODIsMTcuMjk1LDExOS4zOTUsMS41MzcsODQuMzUzQy0yLjAxLDc2LjQ1OCwwLjU4NCw3Mi4yMiw5LjI5NSw3Mi4wNyAgIGMxNC40NjUtMC4yODEsMjguOTI4LTAuMjYxLDQzLjQxLTAuMDJjNS44NzksMC4wODYsOS43NzEsMy40NTgsMTIuMDQxLDkuMDEyYzcuODI2LDE5LjI0MywxNy40MDIsMzcuNTUxLDI5LjQyMiw1NC41MjEgICBjMy4yMDEsNC41MTgsNi40NjUsOS4wMzYsMTEuMTEzLDEyLjIxNmM1LjE0MiwzLjUyMSw5LjA1NywyLjM1NCwxMS40NzYtMy4zNzRjMS41MzUtMy42MzIsMi4yMDctNy41NDQsMi41NTMtMTEuNDM0ICAgYzEuMTQ2LTEzLjM4MywxLjI5Ny0yNi43NDMtMC43MTMtNDAuMDc5Yy0xLjIzNC04LjMyMy01LjkyMi0xMy43MTEtMTQuMjI3LTE1LjI4NmMtNC4yMzgtMC44MDMtMy42MDctMi4zOC0xLjU1NS00Ljc5OSAgIGMzLjU2NC00LjE3Miw2LjkxNi02Ljc2OSwxMy41OTgtNi43NjloNTAuMTExYzcuODg5LDEuNTU3LDkuNjQxLDUuMTAxLDEwLjcyMSwxMy4wMzlsMC4wNDMsNTUuNjYzICAgYy0wLjA4NiwzLjA3MywxLjUzNSwxMi4xOTIsNy4wNywxNC4yMjZjNC40MywxLjQ0OCw3LjM1LTIuMDk2LDEwLjAwOC00LjkwNWMxMS45OTgtMTIuNzM0LDIwLjU2MS0yNy43ODMsMjguMjExLTQzLjM2NiAgIGMzLjM5NS02Ljg1Miw2LjMxNC0xMy45NjgsOS4xNDMtMjEuMDc4YzIuMDk2LTUuMjc2LDUuMzg1LTcuODcyLDExLjMyOC03Ljc1N2w0OC4yMjksMC4wNDNjMS40MywwLDIuODc3LDAuMDIxLDQuMjYyLDAuMjU4ICAgYzguMTI3LDEuMzg1LDEwLjM1NCw0Ljg4MSw3Ljg0NCwxMi44MTdjLTMuOTU1LDEyLjQ1MS0xMS42NSwyMi44MjctMTkuMTc0LDMzLjI1MWMtOC4wNDMsMTEuMTI5LTE2LjY0NSwyMS44NzctMjQuNjIxLDMzLjA3MiAgIEMyNTIuMjYsMTYxLjU0NCwyNTIuODQyLDE2Ni42OTcsMjYxLjk0NSwxNzUuNTc2TDI2MS45NDUsMTc1LjU3NnogTTI2MS45NDUsMTc1LjU3NiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if(ampforwp_get_setting('enable-single-odnoklassniki-share')){
			        $feature_img = '';
	               if (ampforwp_has_post_thumbnail() ){
					$feature_img = ampforwp_get_post_thumbnail( 'url', 'medium' );
					} 
		       ?>
			<a title="odnoklassniki share" <?php esc_html(ampforwp_rel_attributes_social_links()); ?> href="https://connect.ok.ru/offer?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(htmlspecialchars(get_the_title())); ?>&imageUrl=<?php echo esc_url($feature_img); ?>" target="_blank">
				<div class="a-so-i a-so-odnoklassniki"> 
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCIgdmlld0JveD0iMCAwIDk1LjQ4MSA5NS40ODEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDk1LjQ4MSA5NS40ODE7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDMuMDQxLDY3LjI1NGMtNy40MDItMC43NzItMTQuMDc2LTIuNTk1LTE5Ljc5LTcuMDY0Yy0wLjcwOS0wLjU1Ni0xLjQ0MS0xLjA5Mi0yLjA4OC0xLjcxMyAgICBjLTIuNTAxLTIuNDAyLTIuNzUzLTUuMTUzLTAuNzc0LTcuOTg4YzEuNjkzLTIuNDI2LDQuNTM1LTMuMDc1LDcuNDg5LTEuNjgyYzAuNTcyLDAuMjcsMS4xMTcsMC42MDcsMS42MzksMC45NjkgICAgYzEwLjY0OSw3LjMxNywyNS4yNzgsNy41MTksMzUuOTY3LDAuMzI5YzEuMDU5LTAuODEyLDIuMTkxLTEuNDc0LDMuNTAzLTEuODEyYzIuNTUxLTAuNjU1LDQuOTMsMC4yODIsNi4yOTksMi41MTQgICAgYzEuNTY0LDIuNTQ5LDEuNTQ0LDUuMDM3LTAuMzgzLDcuMDE2Yy0yLjk1NiwzLjAzNC02LjUxMSw1LjIyOS0xMC40NjEsNi43NjFjLTMuNzM1LDEuNDQ4LTcuODI2LDIuMTc3LTExLjg3NSwyLjY2MSAgICBjMC42MTEsMC42NjUsMC44OTksMC45OTIsMS4yODEsMS4zNzZjNS40OTgsNS41MjQsMTEuMDIsMTEuMDI1LDE2LjUsMTYuNTY2YzEuODY3LDEuODg4LDIuMjU3LDQuMjI5LDEuMjI5LDYuNDI1ICAgIGMtMS4xMjQsMi40LTMuNjQsMy45NzktNi4xMDcsMy44MWMtMS41NjMtMC4xMDgtMi43ODItMC44ODYtMy44NjUtMS45NzdjLTQuMTQ5LTQuMTc1LTguMzc2LTguMjczLTEyLjQ0MS0xMi41MjcgICAgYy0xLjE4My0xLjIzNy0xLjc1Mi0xLjAwMy0yLjc5NiwwLjA3MWMtNC4xNzQsNC4yOTctOC40MTYsOC41MjgtMTIuNjgzLDEyLjczNWMtMS45MTYsMS44ODktNC4xOTYsMi4yMjktNi40MTgsMS4xNSAgICBjLTIuMzYyLTEuMTQ1LTMuODY1LTMuNTU2LTMuNzQ5LTUuOTc5YzAuMDgtMS42MzksMC44ODYtMi44OTEsMi4wMTEtNC4wMTRjNS40NDEtNS40MzMsMTAuODY3LTEwLjg4LDE2LjI5NS0xNi4zMjIgICAgQzQyLjE4Myw2OC4xOTcsNDIuNTE4LDY3LjgxMyw0My4wNDEsNjcuMjU0eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCTxwYXRoIGQ9Ik00Ny41NSw0OC4zMjljLTEzLjIwNS0wLjA0NS0yNC4wMzMtMTAuOTkyLTIzLjk1Ni0yNC4yMThDMjMuNjcsMTAuNzM5LDM0LjUwNS0wLjAzNyw0Ny44NCwwICAgIGMxMy4zNjIsMC4wMzYsMjQuMDg3LDEwLjk2NywyNC4wMiwyNC40NzhDNzEuNzkyLDM3LjY3Nyw2MC44ODksNDguMzc1LDQ3LjU1LDQ4LjMyOXogTTU5LjU1MSwyNC4xNDMgICAgYy0wLjAyMy02LjU2Ny01LjI1My0xMS43OTUtMTEuODA3LTExLjgwMWMtNi42MDktMC4wMDctMTEuODg2LDUuMzE2LTExLjgzNSwxMS45NDNjMC4wNDksNi41NDIsNS4zMjQsMTEuNzMzLDExLjg5NiwxMS43MDkgICAgQzU0LjM1NywzNS45NzEsNTkuNTczLDMwLjcwOSw1OS41NTEsMjQuMTQzeiIgZmlsbD0iI0ZGRkZGRiIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-reddit-share'] ) { ?>
			<a title="reddit share" <?php ampforwp_rel_attributes_social_links(); ?> href="https://reddit.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
				<div class="a-so-i a-so-reddit"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDQ5IDUxMiIgZmlsbD0iI2ZmZmZmZiIgPjxwYXRoIGQ9Ik00NDkgMjUxYzAgMjAtMTEgMzctMjcgNDUgMSA1IDEgOSAxIDE0IDAgNzYtODkgMTM4LTE5OSAxMzhTMjYgMzg3IDI2IDMxMWMwLTUgMC0xMCAxLTE1LTE2LTgtMjctMjUtMjctNDUgMC0yOCAyMy01MCA1MC01MCAxMyAwIDI0IDUgMzMgMTMgMzMtMjMgNzktMzkgMTI5LTQxaDJsMzEtMTAzIDkwIDE4YzgtMTQgMjItMjQgMzktMjRoMWMyNSAwIDQ0IDIwIDQ0IDQ1cy0xOSA0NS00NCA0NWgtMWMtMjMgMC00Mi0xNy00NC00MGwtNjctMTQtMjIgNzRjNDkgMyA5MyAxNyAxMjUgNDAgOS04IDIxLTEzIDM0LTEzIDI3IDAgNDkgMjIgNDkgNTB6TTM0IDI3MWM1LTE1IDE1LTI5IDI5LTQxLTQtMy05LTUtMTUtNS0xNCAwLTI1IDExLTI1IDI1IDAgOSA0IDE3IDExIDIxem0zMjQtMTYyYzAgOSA3IDE3IDE2IDE3czE3LTggMTctMTctOC0xNy0xNy0xNy0xNiA4LTE2IDE3ek0xMjcgMjg4YzAgMTggMTQgMzIgMzIgMzJzMzItMTQgMzItMzItMTQtMzEtMzItMzEtMzIgMTMtMzIgMzF6bTk3IDExMmM0OCAwIDc3LTI5IDc4LTMwbC0xMy0xMnMtMjUgMjQtNjUgMjRjLTQxIDAtNjQtMjQtNjQtMjRsLTEzIDEyYzEgMSAyOSAzMCA3NyAzMHptNjctODBjMTggMCAzMi0xNCAzMi0zMnMtMTQtMzEtMzItMzEtMzIgMTMtMzIgMzEgMTQgMzIgMzIgMzJ6bTEyNC00OGM3LTUgMTEtMTMgMTEtMjIgMC0xNC0xMS0yNS0yNS0yNS02IDAtMTEgMi0xNSA1IDE0IDEyIDI0IDI3IDI5IDQyeiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-tumblr-share'] ) { ?>
			<a title="tumblr share" <?php ampforwp_rel_attributes_social_links(); ?> href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(get_the_title()); ?>&caption=<?php echo esc_attr(get_the_excerpt()); ?>" target="_blank">
				<div class="a-so-i a-so-tumblr"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMzYuMDAyIDI4djE0LjYzNmMwIDMuNzE0LS4wNDggNS44NTMuMzQ2IDYuOTA2LjM5IDEuMDQ3IDEuMzcgMi4xMzQgMi40MzcgMi43NjMgMS40MTguODUgMy4wMzQgMS4yNzMgNC44NTcgMS4yNzMgMy4yNCAwIDUuMTU1LS40MjggOC4zNi0yLjUzNHY5LjYyYy0yLjczMiAxLjI4Ni01LjExOCAyLjAzOC03LjMzNCAyLjU2LTIuMjIuNTE0LTQuNjE2Ljc3NC03LjE5Ljc3NC0yLjkyOCAwLTQuNjU1LS4zNjgtNi45MDItMS4xMDMtMi4yNDctLjc0Mi00LjE2Ni0xLjgtNS43NS0zLjE2LTEuNTkyLTEuMzctMi42OS0yLjgyNC0zLjMwNC00LjM2M3MtLjkyLTMuNzc2LS45Mi02LjcwM1YyNi4yMjRoLTguNTl2LTkuMDYzYzIuNTE0LS44MTUgNS4zMjQtMS45ODcgNy4xMTItMy41MSAxLjc5Ny0xLjUyNyAzLjIzNS0zLjM1NiA0LjMyLTUuNDk2QzI0LjUzIDYuMDIyIDI1LjI3NiAzLjMgMjUuNjgzIDBoMTAuMzJ2MTZINTJ2MTJIMzYuMDA0eiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-telegram-share'] ) { ?>
			<a title="telegram share" <?php ampforwp_rel_attributes_social_links(); ?> href="https://telegram.me/share/url?url=<?php echo esc_url($amp_permalink); ?>&text=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
				<div class="a-so-i a-so-telegram"> 
			    	<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ1NS43MzEgNDU1LjczMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDU1LjczMSA0NTUuNzMxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPGc+Cgk8cmVjdCB4PSIwIiB5PSIwIiBzdHlsZT0iZmlsbDojNjFBOERFOyIgd2lkdGg9IjQ1NS43MzEiIGhlaWdodD0iNDU1LjczMSIvPgoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTguODQ0LDEwMC42TDU0LjA5MSwyMTkuMzU5Yy05Ljg3MSwzLjg0Ny05LjI3MywxOC4wMTIsMC44ODgsMjEuMDEybDc3LjQ0MSwyMi44NjhsMjguOTAxLDkxLjcwNiAgIGMzLjAxOSw5LjU3OSwxNS4xNTgsMTIuNDgzLDIyLjE4NSw1LjMwOGw0MC4wMzktNDAuODgybDc4LjU2LDU3LjY2NWM5LjYxNCw3LjA1NywyMy4zMDYsMS44MTQsMjUuNzQ3LTkuODU5bDUyLjAzMS0yNDguNzYgICBDMzgyLjQzMSwxMDYuMjMyLDM3MC40NDMsOTYuMDgsMzU4Ljg0NCwxMDAuNnogTTMyMC42MzYsMTU1LjgwNkwxNzkuMDgsMjgwLjk4NGMtMS40MTEsMS4yNDgtMi4zMDksMi45NzUtMi41MTksNC44NDcgICBsLTUuNDUsNDguNDQ4Yy0wLjE3OCwxLjU4LTIuMzg5LDEuNzg5LTIuODYxLDAuMjcxbC0yMi40MjMtNzIuMjUzYy0xLjAyNy0zLjMwOCwwLjMxMi02Ljg5MiwzLjI1NS04LjcxN2wxNjcuMTYzLTEwMy42NzYgICBDMzIwLjA4OSwxNDcuNTE4LDMyNC4wMjUsMTUyLjgxLDMyMC42MzYsMTU1LjgwNnoiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="50" height="20" />

				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-stumbleupon-share'] ) { ?>
			<a title="stumbleupon share" <?php ampforwp_rel_attributes_social_links(); ?> href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($amp_permalink); ?>&title=<?php echo esc_attr(get_the_title()); ?>" target="_blank">
				<div class="a-so-i a-so-stumbleupon"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNjcwLjIyMzMgNjAxLjA4NjkiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNMCA0MzcuMjQ3di05Mi42NzJoMTE0LjY4OHY5MS42NjRjMCA5LjU2NyAzLjQwOCAxNy44MjMgMTAuMjQgMjQuODNzMTUuMTg0IDEwLjQ5NyAyNS4wODggMTAuNDk3IDE4LjMzNi0zLjQyNCAyNS4zNDQtMTAuMjRjNy4wMDgtNi44NDggMTAuNDk2LTE1LjIgMTAuNDk2LTI1LjA4OFYyMTkuNjQ2YzAtMzkuOTM1IDE0Ljc1Mi03My45ODQgNDQuMjg4LTEwMi4xNDQgMjkuNTM2LTI4LjE2IDY0LjYwOC00Mi4yNCAxMDUuMjE2LTQyLjI0IDQwLjYwOCAwIDc1LjY4IDE0LjE2IDEwNS4yMTYgNDIuNDk2IDI5LjUyIDI4LjMzNSA0NC4zMDUgNjIuNjQgNDQuMzA1IDEwMi45MXY0Ny4xMDRsLTY4LjYyMyAyMC40OC00NS41Ny0yMS41MDN2LTQwLjk2YzAtOS45MDMtMy40MDctMTguMjU2LTEwLjI1NS0yNS4wODgtNi44MTYtNi44MzItMTUuMTgzLTEwLjI0LTI1LjA3Mi0xMC4yNC05LjkwMyAwLTE4LjMzNiAzLjQwOC0yNS4zNDQgMTAuMjRzLTEwLjQ5NiAxNS4xODUtMTAuNDk2IDI1LjA5djIxMy41MDNjMCA0MC45NzYtMTQuNjcyIDc1Ljg3Mi00NC4wMzIgMTA0LjcyLTI5LjM0NCAyOC44NDgtNjQuNTEyIDQzLjI0OC0xMDUuNDcyIDQzLjI0OC00MS4zMSAwLTc2LjY0LTE0LjU5Mi0xMDUuOTg0LTQzLjc3NkMxNC42ODggNTE0LjMwMy4wMDIgNDc4Ljg4LjAwMiA0MzcuMjQ3em0zNzAuNjg4IDEuNTM2di05My42OTVsNDUuNTY4IDIxLjUyIDY4LjYyNC0yMC40OTd2OTQuMjI2YzAgOS45MDMgMy40MDggMTguMzM2IDEwLjIyNCAyNS4zNDQgNi44NDcgNy4wMDcgMTUuMiAxMC40OTYgMjUuMDg3IDEwLjQ5NiA5LjkwNiAwIDE4LjI3NC0zLjUwNCAyNS4wOS0xMC40OTYgNi44MTYtNi45OTMgMTAuMjU1LTE1LjQ0IDEwLjI1NS0yNS4zNDR2LTk1Ljc0NGgxMTQuNjg4djkyLjY3MmMwIDQxLjI5NS0xNC41OSA3Ni42NC00My43NzYgMTA1Ljk4My0yOS4xODQgMjkuMzYtNjQuNDMyIDQ0LjAzMi0xMDUuNzI4IDQ0LjAzMnMtNzYuNjI1LTE0LjQ5Ny0xMDUuOTg1LTQzLjUyYy0yOS4zNi0yOS4wNC00NC4wNDgtNjQuMDE3LTQ0LjA0OC0xMDQuOTc4eiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-wechat-share'] ) { ?>
			<a title="wechat share" <?php ampforwp_rel_attributes_social_links(); ?> href="http://api.addthis.com/oexchange/0.8/forward/wechat/offer?url=<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="a-so-i a-so-wechat"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjA0OCAxODk2LjA4MzMiIGZpbGw9IiNmZmZmZmYiID48cGF0aCBkPSJNNTgwIDQ2MXEwLTQxLTI1LTY2dC02Ni0yNXEtNDMgMC03NiAyNS41VDM4MCA0NjFxMCAzOSAzMyA2NC41dDc2IDI1LjVxNDEgMCA2Ni0yNC41dDI1LTY1LjV6bTc0MyA1MDdxMC0yOC0yNS41LTUwdC02NS41LTIycS0yNyAwLTQ5LjUgMjIuNVQxMTYwIDk2OHEwIDI4IDIyLjUgNTAuNXQ0OS41IDIyLjVxNDAgMCA2NS41LTIydDI1LjUtNTF6bS0yMzYtNTA3cTAtNDEtMjQuNS02NlQ5OTcgMzcwcS00MyAwLTc2IDI1LjVUODg4IDQ2MXEwIDM5IDMzIDY0LjV0NzYgMjUuNXE0MSAwIDY1LjUtMjQuNVQxMDg3IDQ2MXptNjM1IDUwN3EwLTI4LTI2LTUwdC02NS0yMnEtMjcgMC00OS41IDIyLjVUMTU1OSA5NjhxMCAyOCAyMi41IDUwLjV0NDkuNSAyMi41cTM5IDAgNjUtMjJ0MjYtNTF6bS0yNjYtMzk3cS0zMS00LTcwLTQtMTY5IDAtMzExIDc3VDg1MS41IDg1Mi41IDc3MCAxMTQwcTAgNzggMjMgMTUyLTM1IDMtNjggMy0yNiAwLTUwLTEuNXQtNTUtNi41LTQ0LjUtNy01NC41LTEwLjUtNTAtMTAuNWwtMjUzIDEyNyA3Mi0yMThRMCA5NjUgMCA2NzhxMC0xNjkgOTcuNS0zMTF0MjY0LTIyMy41VDcyNSA2MnExNzYgMCAzMzIuNSA2NnQyNjIgMTgyLjVUMTQ1NiA1NzF6bTU5MiA1NjFxMCAxMTctNjguNSAyMjMuNVQxNzk0IDE1NDlsNTUgMTgxLTE5OS0xMDlxLTE1MCAzNy0yMTggMzctMTY5IDAtMzExLTcwLjVUODk3LjUgMTM5NiA4MTYgMTEzMnQ4MS41LTI2NFQxMTIxIDY3Ni41dDMxMS03MC41cTE2MSAwIDMwMyA3MC41dDIyNy41IDE5MlQyMDQ4IDExMzJ6Ij48L3BhdGg+PC9zdmc+" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-viber-share'] ) { ?>
			<a title="viber share" <?php ampforwp_rel_attributes_social_links(); ?> href="viber://forward?text=<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="a-so-i a-so-viber"> 
					<amp-img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAyNiAxMjM0IiBmaWxsPSIjZmZmZmZmIiA+PHBhdGggZD0iTTkwNCA3OTRxLTY5IDYxLTIwMCA4Ny41VDQzNCA4OTdsLTE3NiAxMzJWODY0cS04Ny0yNy0xMzYtNzAtNTgtNTEtOTAtMTQ2LjV0LTMyLTE5NSAzMi0xOTUgOTAuNS0xNDcgMTY3LjUtNzlUNTEzIDR0MjIzIDI3LjUgMTY3LjUgNzkgOTAuNSAxNDcgMzIgMTk1LTMyIDE5NVQ5MDQgNzk0ek02MzkgNTQ5bDY1IDExcS04LTEyMC05Mi41LTIwNVQ0MDcgMjYybDExIDY1cTg2IDExIDE0OCA3M3Q3MyAxNDl6TTQyOSAzOTRsMTIgNzJxNDAgMjAgNTkgNTlsNzIgMTJxLTEyLTUzLTUxLTkxLjVUNDI5IDM5NHptLTEwNyA1OXYtNjRxMC0xNy0xMi41LTM0VDI4MyAzMzAuNXQtMjEtMS41bC00NiA0N3EtMzkgMzktMTEuNSAxMjEuNXQxMDUgMTYwIDE2MCAxMDVUNTkwIDc1MWw0Ny00N3E3LTYtLjUtMjAuNVQ2MTIgNjU3dC0zNC0xMmgtNjRsLTM3IDMycS00NC0xMi0xMDkuNS03Ny41VDI5MCA0ODl6bTY0LTMyMGwxMCA2NXExMDAgMiAxODUgNTIuNXQxMzUgMTM1VDc2OSA1NzBsNjUgMTFxMC05MS0zNS41LTE3NFQ3MDMgMjY0dC0xNDMtOTUuNVQzODYgMTMzeiI+PC9wYXRoPjwvc3ZnPg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-hatena-bookmarks'] ) { ?>
			<a title="hatena share" <?php ampforwp_rel_attributes_social_links(); ?> href="http://b.hatena.ne.jp/entry/<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="a-so-i a-so-hatena"> 
					<amp-img src="data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'%3e%3cpath d='M 64 96 L 64 416 L 212 416 C 252 416 292 404 308 368 C 328 332 320 276 284 252 C 272 244 260 240 248 236 C 276 232 300 212 300 184 C 304 156 296 120 268 108 C 236 96 192 96 160 96 L 64 96 z M 364 96 L 364 308 L 444 308 L 444 96 L 364 96 z M 144 156 C 144 156 188 156 200 160 C 224 168 224 208 196 212 C 188 216 144 216 144 216 L 144 156 z M 144 280 C 144 280 188 280 208 284 C 232 288 240 312 228 332 C 220 348 204 348 188 348 L 144 348 L 144 280 z M 404 328 A 44 44 0 0 0 360 372 A 44 44 0 0 0 404 416 A 44 44 0 0 0 448 372 A 44 44 0 0 0 404 328 z' style='fill:%23ffffff'/%3e%3c/svg%3e" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == $redux_builder_amp['enable-single-pocket-share'] ) { ?>
			<a title="pocket share" <?php ampforwp_rel_attributes_social_links(); ?> href="https://getpocket.com/save?url=<?php echo esc_url($amp_permalink); ?>" target="_blank">
				<div class="a-so-i a-so-pocket"> 
					<amp-img src="data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='2500' height='2251' viewBox='75.247 261.708 445.529 401.074'%3e%3cpath fill='%23EF4056' d='M114.219 261.708c-24.275 1.582-38.972 15.44-38.972 40.088v147.611c0 119.893 119.242 214.114 222.393 213.37 115.986-.837 223.137-98.779 223.137-213.37V301.796c0-24.741-15.626-38.693-40.088-40.088h-366.47zm93.943 120.079L297.64 466.8l89.571-85.013c40.088-16.835 57.574 28.927 41.111 42.321L311.685 535.443c-3.813 3.628-24.183 3.628-27.996 0L167.051 424.107c-15.72-14.789 4.743-61.295 41.111-42.32z'/%3e%3c/svg%3e" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if(true == ampforwp_get_setting('enable-single-mewe-share'))  {?>
			<a title="mewe share" <?php ampforwp_rel_attributes_social_links(); ?> href="https://mewe.com/share?link=<?php echo esc_url($amp_permalink); ?>">
				<div class="a-so-i custom-amp-socialsharing-mewe">
					<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/favicon-mewe.svg') ?>" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
		<?php if ( true == ampforwp_get_setting('enable-single-flipboard-share') ) { ?>
			<a title="flipboard share" <?php ampforwp_rel_attributes_social_links(); ?> href="https://share.flipboard.com/bookmarklet/popout?v=<?php echo esc_html(get_the_title(ampforwp_get_the_ID())); ?>&url=<?php echo urlencode(esc_url($amp_permalink)); ?>" target="_blank">
				<div class="a-so-i custom-amp-socialsharing-flipboard">
					<amp-img src="<?php echo esc_url(AMPFORWP_IMAGE_DIR . '/flipboard.png') ?>" width="15" height="15" />
				</div>
			</a>
		<?php } ?>	
	</div> 
	<?php }
}

//	25. Yoast meta Support 
add_action('pre_amp_render_post','ampforwp_add_proper_post_meta');
function ampforwp_add_proper_post_meta(){
	if ( class_exists('WPSEO_Options') ) {
		add_action( 'amp_post_template_head', 'ampforwp_custom_yoast_meta_homepage' );
		// Homepage/Frontpage/Blog
		add_action('pre_amp_render_post','ampforwp_yoast_the_excerpt',33);
		if(is_home()){
			// Title
			add_filter('wpseo_opengraph_title', 'ampforwp_yoast_opengraph_title');
			add_filter('wpseo_twitter_title', 'ampforwp_yoast_twitter_title');
			// Description
			add_filter('wpseo_opengraph_desc', 'ampforwp_yoast_opengraph_desc');
			add_filter('wpseo_twitter_description', 'ampforwp_yoast_twitter_desc');
			// og url
			add_filter('wpseo_opengraph_url', 'ampforwp_custom_og_url_homepage');		
			// This is causing the 2nd debug issue reported in #740
			if ( !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) {
				add_action('wpseo_twitter', 'ampforwp_custom_twitter_image_homepage');
			}
			add_action('wpseo_add_opengraph_images', 'ampforwp_custom_og_image_homepage');
		}
	}
}
function ampforwp_yoast_the_excerpt(){
	if(!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){
		add_filter('get_the_excerpt','ampforwp_yoast_excerpt',9);
	}
}
function ampforwp_yoast_excerpt($desc){
	 if(ampforwp_is_front_page() && empty($desc)){
	 	$get_meta_excerpt = get_post_meta(ampforwp_get_the_ID(), '_yoast_wpseo_metadesc', true);
	 	if(isset($get_meta_excerpt)){
	 		$desc = $get_meta_excerpt;
	 	}
	 	if ( ! is_string( $desc ) || ( is_string( $desc ) && $desc === '' ) ) {
	 		$post_content = get_post(ampforwp_get_the_ID())->post_content;
	 		$desc = wp_trim_words( strip_shortcodes( $post_content ) , 15 );
	 	}
	 }
	return $desc;
}
function ampforwp_custom_yoast_meta_homepage(){
	if ( 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && ampforwp_get_setting('ampforwp-seo-yoast-meta') && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) {
				if ( class_exists('WPSEO_Options')) {
					if( method_exists('WPSEO_Options', 'get_option')){
						$options = WPSEO_Options::get_option( 'wpseo_social' );
						if ( $options['twitter'] === true ) {
							WPSEO_Twitter::get_instance();
						}
						if ( $options['opengraph'] === true ) {
							$GLOBALS['wpseo_og'] = new WPSEO_OpenGraph;
						}
					}
				}
				do_action( 'wpseo_opengraph' );
	}
}

// Title
function ampforwp_yoast_opengraph_title($title){
	$new_title = ampforwp_yoast_social_title('og');
	if(!empty($new_title)){
		$title = $new_title;
	}
	return $title;
}
function ampforwp_yoast_twitter_title($title){
	$new_title = ampforwp_yoast_social_title('twitter');
	if(!empty($new_title)){
		$title = $new_title;
	}
	return $title;
}

function ampforwp_yoast_social_title($type) {
	//Added the opengraph for frontpage in AMP #2454
	if(ampforwp_is_front_page() || ampforwp_is_blog() ){
		$title = $page_id = $post = '';
		$page_id = ampforwp_get_the_ID();
		if( 'og' == $type ) {
			$title = WPSEO_Meta::get_value( 'opengraph-title', $page_id );
		}
		if( 'twitter' == $type ) {
			$title = WPSEO_Meta::get_value('twitter-title',$page_id );
		}
		if (empty($title) ){
			$title .= get_post_meta($page_id, '_yoast_wpseo_title', true);
			$title = wpseo_replace_vars( $title,$post );
		}
		if (empty($title) ){
			$title = get_the_title($page_id);
		}
		return esc_attr($title);
	}
	return  esc_attr( get_bloginfo( 'name' ) );
}
// Description
function ampforwp_yoast_opengraph_desc($desc){
	if ( ampforwp_yoast_social_desc('og') ){
		$desc = ampforwp_yoast_social_desc('og');
	}
	return $desc;
}
function ampforwp_yoast_twitter_desc($desc){
	if ( ampforwp_yoast_social_desc('twitter') ){
		$desc = ampforwp_yoast_social_desc('twitter');
	}
	return $desc;
}
function ampforwp_yoast_social_desc($type) {
	if(ampforwp_is_front_page() || ampforwp_is_blog()){
		$desc = $page_id = '';
		$page_id = ampforwp_get_the_ID();
		if ( 'og' == $type ) {
			$desc = trim( WPSEO_Meta::get_value( 'opengraph-description', $page_id ) );
		}
		if ( 'twitter' == $type ) {
			$desc = trim( WPSEO_Meta::get_value( 'twitter-description', $page_id ) );
		}
		if (empty($desc) ){
	 		$desc = get_post_meta($page_id, '_yoast_wpseo_metadesc', true); 
	 	}
		if (empty($desc)){
			$desc = wp_trim_words(get_post_field('post_content', $page_id), 26);
		}
		return esc_attr($desc);			
	}	
	return  esc_attr( get_bloginfo( 'description' ) );
}
function ampforwp_custom_og_url_homepage() {
	return esc_url( get_bloginfo( 'url' ) );
}
function ampforwp_custom_twitter_image_homepage(){
	$twitter = $WPSEO_get = '';
	$WPSEO_Options = WPSEO_Options::get_instance();
 	if( method_exists($WPSEO_Options, 'get') ){
		$WPSEO_get = WPSEO_Options::get( 'twitter_site', '' );
	}
	if ( ampforwp_get_the_ID() ) {
		$post_id = ampforwp_get_the_ID();
		$post = get_post($post_id);
		// twitter:image
		$img = WPSEO_Meta::get_value('twitter-image', $post_id );
		if ( $img !== '' ) {
			$metatag_key = apply_filters( 'wpseo_twitter_metatag_key', 'name' );
			$name = 'image';
			$value = esc_url($img);
			// Output meta.
			echo '<meta ', esc_attr( $metatag_key ), '="twitter:', esc_attr( $name ), '" content="', $value, '" />', "\n";
		}
		// twitter:creator
		$twitter = ltrim( trim( get_the_author_meta( 'twitter', $post->post_author ) ), '@' );
		$twitter = apply_filters( 'wpseo_twitter_creator_account', $twitter );
	}
	if ( is_string( $twitter ) && $twitter !== '' ) {
		echo '<meta ', esc_attr( 'name' ), '="twitter:', esc_attr( 'creator' ), '" content="','@' . esc_attr($twitter), '" />', "\n";
	}
	elseif ( $WPSEO_get !== '' && is_string( $WPSEO_get ) ) {
		echo '<meta ', esc_attr( 'name' ), '="twitter:', esc_attr( 'creator'), '" content="', '@' . esc_attr(WPSEO_Options::get( 'twitter_site' )), '" />', "\n";
	}
}
function ampforwp_custom_og_image_homepage() {
	if ( class_exists('WPSEO_Options') ) {
		global $wpseo_og;
		$post_id = ampforwp_get_frontpage_id();
		$image_url = WPSEO_Meta::get_value( 'opengraph-image', $post_id );
		$image_id = WPSEO_Meta::get_value( 'opengraph-image-id', $post_id );
		$image = wp_get_attachment_image_src($image_id,'full');
		$image_tags = array();
		if(is_array($image)){
			$image_tags = array(
				'width'     => esc_attr(isset($image[1]) ? $image[1] : '750'),
				'height'    => esc_attr(isset($image[2]) ? $image[2] : '500'),
			);
		}else{
			$image_tags = array(
				'width'     => '750',
				'height'    => '500',
			);
		}

		if ( method_exists($wpseo_og, 'og_tag') ) {
			$wpseo_og->og_tag( 'og:image', esc_url( $image_url ) );
			foreach ( $image_tags as $key => $value ) {
				if ( ! empty( $value ) ) {
					$wpseo_og->og_tag( 'og:image:' . $key, $value );
				}
			}
		}
	}
}


/**
 * PR by Sybre Waaijer:
 * @link https://github.com/ahmedkaludi/accelerated-mobile-pages/pull/761
 *
 * @since version 0.9.48 :
 *   1. Removes unused code.
 *   2. Cleaned up code.
 *   3. Keeps legacy action in place.
 *   4. No longer replaces the title tag.
 *   5. Instead, filters the title tag.
 *   6. Therefore, it works with all SEO plugins.
 *   7. Removed direct Yoast SEO compat -- It's no longer needed.
 *   8. Removed unwanted spaces.
 *   9. Improved performance.
 *   10. Improved security.
 *   11. Added support for CPT and attachment pages.
 */
//26. Extending Title Tagand De-Hooking the Standard one from AMP
add_action( 'pre_amp_render_post', 'ampforwp_remove_title_tags');
function ampforwp_remove_title_tags() {
	return ampforwp_replace_title_tags();
}
function ampforwp_replace_title_tags() {

	add_filter( 'pre_get_document_title', 'ampforwp_add_custom_title_tag', 20 );
	add_filter( 'wp_title', 'ampforwp_add_custom_title_tag', 10, 3 );

	if(class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration') && !ampforwp_is_home() &&  !ampforwp_is_front_page()  && !ampforwp_is_blog()  ){
		remove_filter( 'pre_get_document_title', 'ampforwp_add_custom_title_tag', 20 );
	    remove_filter( 'wp_title', 'ampforwp_add_custom_title_tag', 10, 3 );
	}
	// For Custom homepage
	if(class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration') && ampforwp_is_home() && !ampforwp_is_front_page() ){
		remove_filter( 'pre_get_document_title', 'ampforwp_add_custom_title_tag', 20 );
	    remove_filter( 'wp_title', 'ampforwp_add_custom_title_tag', 10, 3 );
	}

	function ampforwp_add_custom_title_tag( $title = '', $sep = '', $seplocation = '' ) {
		global $redux_builder_amp, $post;
		$site_title = '';
		$genesis_title = '';
		if ( ampforwp_is_front_page() ) {
			$post_id = ampforwp_get_frontpage_id();
			$post = get_post($post_id);
		}
		if ( ampforwp_is_blog() ) {
	 		$post_id = ampforwp_get_blog_details('id');
	 		$post = get_post($post_id);
	 	}
		if ( !$post ) {
			return;
		}
		$post_id = $post->ID;

		//* We can filter this later if needed:
		$sep = ' | ';
		if( class_exists('WPSEO_Options') && method_exists('WPSEO_Options', 'get') && 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) { 
			$separator = WPSEO_Options::get( 'separator' );
			$seperator_options = WPSEO_Option_Titles::get_instance()->get_separator_options();
			// This should always be set, but just to be sure.
			if ( isset( $seperator_options[ $separator ] ) ) {
				// Set the new replacement.
				$sep = $seperator_options[ $separator ];
			}
		}
		if( defined( 'RANK_MATH_FILE' ) && class_exists('RankMath\\Helper') && 'rank_math' == ampforwp_get_setting('ampforwp-seo-selection') ) {
			$sep = RankMath\Helper::get_settings( 'titles.title_separator' );
			$sep = ' '.htmlentities( $sep, ENT_COMPAT, 'UTF-8', false ).' ';
		}
		$sep = apply_filters('ampforwp_title_seperator_type', $sep);

		if ( is_singular() ) {
			$title = ! empty( $post->post_title ) ? $post->post_title : $title;
			$site_title = $title . $sep . get_option( 'blogname' );
		} elseif ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) {
			$site_title = strip_tags( get_the_archive_title( '' ) . $sep . get_bloginfo( 'name' ) );
		}

		if ( is_home() ) {
			// Custom frontpage
			$site_title = get_bloginfo( 'name' ) . $sep . get_option( 'blogdescription' );

			if ( ampforwp_is_front_page() ) {
				//WPML Static Front Page Support for title and description with Yoast #1143
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
				 	$ID = get_option( 'page_on_front' );
				}
				else {
					$ID = ampforwp_get_frontpage_id();
				}
				$site_title = get_the_title( $ID ) .' '. $sep .' '. get_option( 'blogname' );				
			}
			// // Blog page 
			// if ( ampforwp_is_blog() ) {
			// 	$ID = ampforwp_get_blog_details('id');
			// 	$site_title = get_the_title( $ID ) . $sep . get_option( 'blogname' );
			// }
		}

		if ( is_search() ) {
			$site_title = $redux_builder_amp['amp-translator-search-text'] . ' ' . get_search_query();
		}

		// Yoast SEO Title compatibility #2871
		if( class_exists('WPSEO_Frontend') && ('yoast' || 1) == ampforwp_get_setting('ampforwp-seo-selection') ) {
			$yoast_title = $WPSEO_Frontend = $yoast_instance = '';

			if ( class_exists('Yoast\WP\SEO\Presentations\Indexable_Presentation') ) {
				$yoast_instance = new \Yoast\WP\SEO\Presentations\Indexable_Presentation();
			}
			
			if ( !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) {
				$WPSEO_Frontend = WPSEO_Frontend::get_instance();
				$yoast_title = $WPSEO_Frontend->title($site_title);
				if ( ampforwp_is_home() ) {
					$yoast_title = $WPSEO_Frontend->get_title_from_options( 'title-home-wpseo' );
				}
				// For Blog pages and with Blog sub pages for example: site.com/blog/amp/page/3/
				if (ampforwp_is_blog()) {
					$yoast_title = $WPSEO_Frontend->get_content_title();	
				}
			}
			// Custom Front Page Title From Yoast SEO #1163
			if ( ampforwp_is_front_page() || ampforwp_is_blog() && class_exists('Yoast\WP\SEO\Presentations\Indexable_Presentation') ) {
				$yoast_title = get_post_meta(ampforwp_get_the_ID(), '_yoast_wpseo_title', true);
				$yoast_title = wpseo_replace_vars( $yoast_title,$post );
				// Get info for custom front page, blog page and blog post paginated pages for v14+ #4574
				if ( class_exists('Ampforwp_Yoast_Data') ){
					$yoast_data = new Ampforwp_Yoast_Data;
					$context = $yoast_data->get_context_for_post_id(ampforwp_get_the_ID());	
				}
				if ( $context) {
					$yoast_title = $context->title;
				}
			}
		 	if ( $yoast_title ) {
		 		$site_title = apply_filters( 'wpseo_title', $yoast_title, $yoast_instance  );
		 	}
		}

		//Genesis #1013
		if(function_exists('genesis_theme_support') && 'genesis' == ampforwp_get_setting('ampforwp-seo-selection') ){
			if(is_home() && is_front_page() && !$redux_builder_amp['amp-frontpage-select-option']){
				// Determine the doctitle.
			$genesis_title = genesis_get_seo_option( 'home_doctitle' ) ? genesis_get_seo_option( 'home_doctitle' ) : get_bloginfo( 'name' );

			// Append site description, if necessary.
			$genesis_title = genesis_get_seo_option( 'append_description_home' ) ? $genesis_title . " $sep " . get_bloginfo( 'description' ) : $genesis_title;
			}
			elseif ( is_home() && get_option( 'page_for_posts' ) && get_queried_object_id() ) 
			{ 
				$post_id = get_option( 'page_for_posts' );
				if ( null !== $post_id || is_singular() ) {
					if ( genesis_get_custom_field( '_genesis_title', $post_id ) ) {
						$genesis_title = genesis_get_custom_field( '_genesis_title', $post_id );
					}
				}
			}
			elseif( is_home() && get_option( 'page_on_front' ) && $redux_builder_amp['amp-frontpage-select-option'] ){
				$post_id = get_option('page_on_front');
					if ( null !== $post_id || is_singular() ) {
						if ( genesis_get_custom_field( '_genesis_title', $post_id ) ) {
							$genesis_title = genesis_get_custom_field( '_genesis_title', $post_id );
						}
					}
			}
			elseif ( is_archive() ) {
				if ( is_category() || is_tag() || is_tax() ) {
					$term       = get_queried_object();
					$title_meta = get_term_meta( $term->term_id, 'doctitle', true );
					$genesis_title      = ! empty( $title_meta ) ? $title_meta : $title;
				}

				if ( is_author() ) {
					$user_title = get_the_author_meta( 'doctitle', (int) get_query_var( 'author' ) );
					$genesis_title      = $user_title ? $user_title : $title;
				}

				if ( is_post_type_archive() && genesis_has_post_type_archive_support() ) {
					$genesis_title = genesis_get_cpt_option( 'doctitle' ) ? genesis_get_cpt_option( 'doctitle' ) : $title;
				}

			}
			else {
				//$genesis_title = genesis_default_title( $title );
				// genesis_default_title has been depreciated, let's do it with another method #2050
				$genesis_title = genesis_get_custom_field( '_genesis_title' );
			}
			if( $genesis_title ){
				$site_title = $genesis_title;
			}
		}
		// SEOPress #1589
		if ( is_plugin_active('wp-seopress/seopress.php') && 'seopress' == ampforwp_get_setting('ampforwp-seo-selection') ) {
			$seopress_title = ampforwp_get_seopress_title();
			$seopress_title = ampforwp_seopress_title_sanitize($seopress_title);
			if ( $seopress_title ) {
				$site_title = $seopress_title;
			}
		}
		// All in One SEO #2816
	   	if ( class_exists('All_in_One_SEO_Pack') && ampforwp_is_front_page()){
	        $aiseop_title = '';
	        $aiseop_title = get_post_meta( $post_id, '_aioseop_title', true );
	        if ( !empty($aiseop_title) ) {
	          $site_title = $aiseop_title;
	        }
	        add_filter('aioseop_title', '__return_false');
	    }
	    if(class_exists('All_in_One_SEO_Pack') && ampforwp_is_home()){
	        global $aioseop_options;
	        if(!empty($aioseop_options['aiosp_home_title'])){
	        	$aiseop_title = $aioseop_options['aiosp_home_title'];
	        }
	        if ( !empty($aiseop_title) ) {
	           $site_title = $aiseop_title;
	        }
	        add_filter('aioseop_title', '__return_false');
	     }
		// Title From Rank Math SEO #2701 & #3358
		if ( defined( 'RANK_MATH_FILE' ) && 'rank_math' == ampforwp_get_setting('ampforwp-seo-selection') ) {
			$rank_math_title = '';
			$post_id = ampforwp_get_the_ID();
		 	if( ampforwp_is_home() || ampforwp_is_blog() ) {
		 		$rank_math_title = RankMath\Paper\Paper::get_from_options( 'homepage_title' );
		 	}
		 	if ( ampforwp_is_front_page() || is_singular() || ampforwp_is_blog() ) {
		 		$rank_math_title = RankMath\Post::get_meta( 'title', $post_id );
		 		if(empty($rank_math_title)){
		 			$rank_math_title = RankMath\Paper\Paper::get()->get_title();
		 		}
		 	}
		 	if ( is_archive() ) {
		 		$object = get_queried_object();
				$rank_math_title = RankMath\Term::get_meta( 'title', $object, $object->taxonomy );
				if ( '' == $rank_math_title ) {
					$rank_math_title = RankMath\Paper\Paper::get_from_options( "tax_{$object->taxonomy}_title", $object );
				}
		 	}
		 	if ( $rank_math_title ) {
		 		$site_title = $rank_math_title;
		 	}
		}
		//Bridge Qode SEO Compatibility #2538
		if ( function_exists('qode_wp_title') && 'bridge' == ampforwp_get_setting('ampforwp-seo-selection')){
			$site_title = get_post_meta($post_id, "qode_seo_title", true);
		}
		// The SEO Framework Compatibility #2670
		if ( function_exists( 'the_seo_framework' ) && 'seo_framework' == ampforwp_get_setting('ampforwp-seo-selection')  ) {
			$tsf_title = $ampforwp_tsf = '';
			$ampforwp_tsf 	= \the_seo_framework();
			$tsf_title 		= $ampforwp_tsf->get_title();
			if ( $tsf_title ) {
				$site_title = $tsf_title;
			}
		}
		if (class_exists('WPSEO_Frontend') && $sep == 'sc-dash') {
			return esc_html( convert_chars( trim( $site_title ) ) );
		}
		return esc_html( convert_chars( wptexturize( trim( $site_title ) ) ) );
	}
}
// Get SEOPress Title #1589
function ampforwp_get_seopress_title(){
	$seopress_title = $seopress_options = '';
	$post_id = ampforwp_get_the_ID();
	$post = get_post($post_id);
	$seopress_get_current_cpt = get_post_type($post);
	$seopress_options = get_option("seopress_titles_option_name");
	if ( get_post_meta($post_id,'_seopress_titles_title',true) ) {
		$seopress_title = get_post_meta($post_id,'_seopress_titles_title',true);
	}
	elseif ( isset($seopress_options['seopress_titles_single_titles'][$seopress_get_current_cpt]['title'])) {
		$seopress_title = $seopress_options['seopress_titles_single_titles'][$seopress_get_current_cpt]['title'];
		$seopress_title = ampforwp_seopress_title_sanitize($seopress_title);
	}
	if ( ampforwp_is_home() || ampforwp_is_blog() ) {
		$seopress_titles_template_variables_array = array('%%sitetitle%%','%%tagline%%');
		$seopress_titles_template_replace_array = array( get_bloginfo('name'), get_bloginfo('description') );
		$seopress_title = $seopress_options['seopress_titles_home_site_title'];
		$seopress_title = str_replace($seopress_titles_template_variables_array, $seopress_titles_template_replace_array, $seopress_title);
	}
	if ( is_archive() ) {
		$seopress_title = get_term_meta(get_queried_object()->{'term_id'},'_seopress_titles_title',true);
	}
	if ( $seopress_title ) {
		return $seopress_title;
	}
}
// Sanitize SEOPress Title #1589
function ampforwp_seopress_title_sanitize($title){
	global $post;
	$seopress_titles_template_variables_array = array(
		'%%sep%%',
		'%%sitetitle%%',
		'%%sitename%%',
		'%%tagline%%',
		'%%post_title%%',
		'%%post_excerpt%%',
		'%%post_date%%',
		'%%post_modified_date%%',
		'%%post_author%%',
		'%%post_category%%',
		'%%post_tag%%',
		'%%_category_title%%',
		'%%_category_description%%',
		'%%tag_title%%',
		'%%tag_description%%',
		'%%term_title%%',
		'%%term_description%%',
		'%%search_keywords%%',
		'%%current_pagination%%',
		'%%cpt_plural%%',
		'%%archive_title%%',
		'%%archive_date%%',
		'%%archive_date_day%%',
		'%%archive_date_month%%',
		'%%archive_date_year%%',
		'%%wc_single_cat%%',
		'%%wc_single_tag%%',
		'%%wc_single_short_desc%%',
		'%%wc_single_price%%',
		'%%wc_single_price_exc_tax%%',
		'%%currentday%%',
		'%%currentmonth%%',
		'%%currentyear%%',
		'%%currentdate%%',
		'%%currenttime%%',
	);
	$sep = '';
	$seopress_excerpt ='';
	$seopress_excerpt_length = 50;
	$seopress_excerpt_length = apply_filters('seopress_excerpt_length',$seopress_excerpt_length);
	if ($seopress_excerpt !='') {
		$seopress_get_the_excerpt = wp_trim_words(esc_attr(stripslashes_deep(wp_filter_nohtml_kses(strip_shortcodes($seopress_excerpt)))), $seopress_excerpt_length);
	} elseif ($post !='') {
		if (get_post_field('post_content', $post->ID) !='') {
			$seopress_get_the_excerpt = wp_trim_words(esc_attr(stripslashes_deep(wp_filter_nohtml_kses(strip_shortcodes(get_post_field('post_content', $post->ID))))), $seopress_excerpt_length);
		} else {
			$seopress_get_the_excerpt = null;
		}
	} else {
		$seopress_get_the_excerpt = null;
	}
	$seopress_paged = '';
	if (get_query_var('paged') >='1') {
		$seopress_paged = get_query_var('paged');
	}
	$seopress_titles_sep_option = get_option("seopress_titles_option_name");
	if (isset($seopress_titles_sep_option['seopress_titles_sep']) ) {
		$sep = $seopress_titles_sep_option['seopress_titles_sep'];
	} else {
		$sep = '-';
	}
	$the_author_meta ='';
	if(is_single() || is_author()){
		$the_author_meta = get_the_author_meta('display_name', $post->post_author);
	}

	$post_category ='';
	if (is_single() && has_category()) {
		$post_category_array = get_the_terms(get_the_id(), 'category');
		$post_category = $post_category_array[0]->name;
	}

	$post_tag ='';
	if (is_single() && has_tag()) {
		$post_tag_array = get_the_terms(get_the_id(), 'post_tag');
		$post_tag = $post_tag_array[0]->name;
	}

	$get_search_query ='';
	if (get_search_query() !='') {
		$get_search_query = '"'.get_search_query().'"';
	}
	
	$get_search_query = apply_filters('seopress_get_search_query', $get_search_query);

	if ($seopress_excerpt !='') {
		$seopress_get_the_excerpt = wp_trim_words(esc_attr(stripslashes_deep(wp_filter_nohtml_kses(strip_shortcodes($seopress_excerpt)))), $seopress_excerpt_length);
	} elseif ($post !='') {
		if (get_post_field('post_content', $post->ID) !='') {
			$seopress_get_the_excerpt = wp_trim_words(esc_attr(stripslashes_deep(wp_filter_nohtml_kses(strip_shortcodes(get_post_field('post_content', $post->ID))))), $seopress_excerpt_length);
		} else {
			$seopress_get_the_excerpt = null;
		}
	} else {
		$seopress_get_the_excerpt = null;
	}
	
	$woo_single_cat_html ='';
	$woo_single_tag_html ='';
	$woo_single_price ='';
	$woo_single_price_exc_tax ='';
	if ( class_exists('WooCommerce') ) {
		if (is_product()) {
			//Woo Cat product
			$woo_single_cats = get_the_terms( $post->ID, 'product_cat' );
	                         
			if ( $woo_single_cats && ! is_wp_error( $woo_single_cats ) ) {
			 
			    $woo_single_cat = array();
			 
			    foreach ( $woo_single_cats as $term ) {
			        $woo_single_cat[] = $term->name;
			    }
	                         
			    $woo_single_cat_html = stripslashes_deep(wp_filter_nohtml_kses(join( ", ", $woo_single_cat )));
			}

			//Woo Tag product
			$woo_single_tags = get_the_terms( $post->ID, 'product_tag' );
	                         
			if ( $woo_single_tags && ! is_wp_error( $woo_single_tags ) ) {
			 
			    $woo_single_tag = array();
			 
			    foreach ( $woo_single_tags as $term ) {
			        $woo_single_tag[] = $term->name;
			    }

			    $woo_single_tag_html = stripslashes_deep(wp_filter_nohtml_kses(join( ", ", $woo_single_tag )));
			}

			//Woo Price
			$product = wc_get_product($post->ID);
			$woo_single_price = wc_get_price_including_tax( $product );

			//Woo Price tax excluded
			$product = wc_get_product($post->ID);
			$woo_single_price_exc_tax = wc_get_price_excluding_tax( $product );
		}
	}
	$seopress_titles_template_replace_array = array(
		$sep,
		get_bloginfo('name'),
		get_bloginfo('name'),
		get_bloginfo('description'),
		the_title_attribute('echo=0'),
		$seopress_get_the_excerpt,
		get_the_date(),
		get_the_modified_date(),
		$the_author_meta,
		$post_category,
		$post_tag,
		single_cat_title('', false),
		wp_trim_words(stripslashes_deep(wp_filter_nohtml_kses(category_description())),$seopress_excerpt_length),
		single_tag_title('', false),
		wp_trim_words(stripslashes_deep(wp_filter_nohtml_kses(tag_description())),$seopress_excerpt_length),
		single_term_title('', false),
		wp_trim_words(stripslashes_deep(wp_filter_nohtml_kses(term_description())),$seopress_excerpt_length),
		$get_search_query,
		$seopress_paged,
		post_type_archive_title('', false),
		get_the_archive_title(),
		get_the_archive_title(),
		esc_attr(get_query_var('day')),
		esc_attr(get_query_var('monthnum')),
		esc_attr(get_query_var('year')),
		$woo_single_cat_html,
		$woo_single_tag_html,
		$seopress_get_the_excerpt,
		$woo_single_price,
		$woo_single_price_exc_tax,
		date_i18n('j'),
		date_i18n('F'),
		date('Y'),
		date_i18n( get_option( 'date_format' )),
		current_time(get_option( 'time_format' )),
	);
	$seopress_titles_title_template = str_replace($seopress_titles_template_variables_array, $seopress_titles_template_replace_array, $title);
	return $seopress_titles_title_template;
}
// Squirrly SEO Compatibility #3421
add_filter('sq_current_post', 'ampforwp_sq_current_post');
function ampforwp_sq_current_post($post){
	if ( 'squirrly' == ampforwp_get_setting('ampforwp-seo-selection') && ampforwp_is_amp_endpoint() && ( ampforwp_is_front_page() || ampforwp_is_blog() ) ){
		$post = get_post(ampforwp_get_the_ID());
	}
	return $post;
}
function ampforwp_modify_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }  
    return $title;
}
add_action( 'pre_amp_render_post', 'ampforwp_modify_archive_title_in_amp');
function ampforwp_modify_archive_title_in_amp() {
	add_filter( 'get_the_archive_title', 'ampforwp_modify_archive_title' );
} 
// 27. Clean the Defer issue
// Moved to functions.php

// 28. Properly removes AMP if turned off from Post panel
add_filter( 'amp_skip_post', 'ampforwp_skip_amp_post', 10, 3 );
function ampforwp_skip_amp_post( $skip, $post_id, $post ) {
	$ampforwp_amp_post_on_off_meta = get_post_meta( $post->ID , 'ampforwp-amp-on-off' , true );
	if( $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
		$skip = true;
	}
    return $skip;
}

//30. TagDiv menu issue removed
	add_action('init','ampforwp_remove_tagdiv_mobile_menu');
	function ampforwp_remove_tagdiv_mobile_menu() {
		if( class_exists( 'Mobile_Detect' )) {
			remove_action('option_stylesheet', array('td_mobile_theme', 'mobile'));
		}
	}

//31. removing scripts added by cleantalk and 
 	//	#525 WordPress Twitter Bootstrap CSS
add_action('amp_init','ampforwp_remove_js_script_cleantalk');
function ampforwp_remove_js_script_cleantalk() {
	$current_url = '';
	$amp_check =  '';
  
	$current_url = $_SERVER['REQUEST_URI'];
	$current_url = explode('/', $current_url);
	$current_url = array_filter($current_url);
	$amp_check = in_array('amp', $current_url);
	if ( true === $amp_check ) {
		ampforwp_remove_filters_for_class( 'wp_loaded', 'ICWP_WPTB_CssProcessor', 'onWpLoaded', 0 );
	}

	remove_action('wp_loaded', 'ct_add_nocache_script', 1);

}

//32. various lazy loading plugins Support
add_filter( 'amp_init', 'ampforwp_lazy_loading_plugins_compatibility' );
function ampforwp_lazy_loading_plugins_compatibility() {

    // Disable HTTP protocol removing on script, link, img, srcset and form tags.
    remove_filter( 'rocket_buffer', '__rocket_protocol_rewrite', PHP_INT_MAX );
    remove_filter( 'wp_calculate_image_srcset', '__rocket_protocol_rewrite_srcset', PHP_INT_MAX );
    if(function_exists('magplus_after_setup')){
    	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
		if( function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path)) {
    		remove_action( 'template_redirect', 'magplus_pagination_redirect' );
    	}
    }
    //Lazy Load XT
	global $lazyloadxt;
	remove_filter( 'the_content', array( $lazyloadxt, 'filter_html' ) );
	remove_filter( 'widget_text', array( $lazyloadxt, 'filter_html' ) );
	remove_filter( 'post_thumbnail_html', array( $lazyloadxt, 'filter_html' ) );
	remove_filter( 'get_avatar', array( $lazyloadxt, 'filter_html' ) );
}

//Removing bj loading for amp
function ampforwp_remove_bj_load() {
 	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
 		add_filter( 'bjll/enabled', '__return_false' );
 	}
}
add_action( 'bjll/compat', 'ampforwp_remove_bj_load' );

add_action('wp','ampforwp_remove_wp_actions',9);
function ampforwp_remove_wp_actions(){
	//Disable Crazy Lazy for AMP #751
	if( ampforwp_is_amp_endpoint() ){
		remove_action( 'wp', array( 'CrazyLazy', 'instance' ) );
	}
	// Removing Marfeel plugin which was blocking internal pages of AMP #2423
	remove_action('wp', 'render_marfeel_amp_content' );
}
//33. Google tag manager support added
// Moved to analytics-functions.php

//34. social share boost compatibility Ticket #387
function social_sharing_removal_code() {
    remove_filter('the_content','ssb_in_content');
}
add_action('amp_init','social_sharing_removal_code', 9);


//35. Disqus Comments Support 
add_action('ampforwp_post_after_design_elements','ampforwp_add_disqus_support');
function ampforwp_add_disqus_support() {
	global $redux_builder_amp;
	$width = $height = 420;
	$layout = "";
	$layout = 'responsive';
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( isset($redux_builder_amp['ampforwp-disqus-layout']) && 'fixed' == $redux_builder_amp['ampforwp-disqus-layout'] ) {
		$layout = 'fixed';
	}
    $height = ampforwp_get_setting('ampforwp-disqus-height');
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] && 4 != $redux_builder_amp['amp-design-selector'] && $display_comments_on ) {
		if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
			global $post; $post_slug = rawurlencode($post->post_name);

			$disqus_script_host_url = "https://ampforwp.appspot.com/?api=". AMPFORWP_DISQUS_URL;

			if( $redux_builder_amp['ampforwp-disqus-host-position'] == 0 ) {
				$disqus_script_host_url = esc_url( $redux_builder_amp['ampforwp-disqus-host-file'] );
			}

			$disqus_url = $disqus_script_host_url.'?disqus_title='.$post_slug.'&url='.rawurlencode(get_permalink()).'&disqus_name='. esc_url( $redux_builder_amp['ampforwp-disqus-comments-name'] ) ."/embed.js"  ;
			?>
			<section class="amp-wp-content post-comments amp-wp-article-content amp-disqus-comments" id="comments">
				<amp-iframe
					height=<?php echo esc_attr($height) ?>
					width=<?php echo esc_attr($width) ?>
					layout="<?php echo esc_attr($layout) ?>"
					sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
					resizable
					frameborder="0"
					src="<?php echo esc_url($disqus_url) ?>" title="<?php echo esc_html__('Disqus Comments','accelerated-mobile-pages'); ?>">
					<div overflow tabindex="0" role="button" aria-label="Read more"><?php echo esc_html__('Disqus Comments Loading...','accelerated-mobile-pages') ?></div>
				</amp-iframe>
			</section>
		<?php
		}
	}
}

add_filter( 'amp_post_template_data', 'ampforwp_add_disqus_scripts' );
function ampforwp_add_disqus_scripts( $data ) {
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] && is_singular() ) {
		if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
		}
	}
	// remove direction attribute from the AMP HTMl #541
	unset( $data['html_tag_attributes']['dir'] );
	return $data;
}

// Facebook Comments Support #825

add_action('ampforwp_post_after_design_elements','ampforwp_facebook_comments_support');
function ampforwp_facebook_comments_support() {
	global $redux_builder_amp;
	if ( 4 != $redux_builder_amp['amp-design-selector'] ) {
		echo ampforwp_facebook_comments_markup();
	}
}
function ampforwp_facebook_comments_markup() {

	global $redux_builder_amp;
	$facebook_comments_markup = $lang = $locale = '';
	$lang = ampforwp_get_setting('ampforwp-fb-comments-lang');
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( $redux_builder_amp['ampforwp-facebook-comments-support'] && $display_comments_on ) { 

		$facebook_comments_markup = '<section class="amp-wp-content post-comments amp-wp-article-content amp-facebook-comments" id="comments">';
		if(true == ampforwp_get_setting('ampforwp-facebook-comments-title')){
			$facebook_comments_markup .= '<h5>'. esc_html__(ampforwp_translation(ampforwp_get_setting('ampforwp-facebook-comments-title'), 'Leave a Comment'),'accelerated-mobile-pages') .'</h5>';
		}
		$facebook_comments_markup .= '<amp-facebook-comments width=486 height=357
	    	layout="responsive" '.'data-locale = "'.esc_attr($lang).'"'.' data-numposts=';
		$facebook_comments_markup .= '"'. esc_attr($redux_builder_amp['ampforwp-number-of-fb-no-of-comments']). '"';
	    if(ampforwp_get_data_consent()){		
	    	$facebook_comments_markup .= ' data-block-on-consent ';
	    }
		$facebook_comments_markup .= 'data-href=" ' . esc_url(get_permalink()) . '"';
	    $facebook_comments_markup .= '></amp-facebook-comments> </section>';

		return $facebook_comments_markup;
	}
}

add_filter( 'amp_post_template_data', 'ampforwp_add_fbcomments_scripts' );
function ampforwp_add_fbcomments_scripts( $data ) {

	global $redux_builder_amp;
	$facebook_comments_check = "";
	$facebook_comments_check = ampforwp_facebook_comments_markup();

	if ( $facebook_comments_check && $redux_builder_amp['ampforwp-facebook-comments-support'] && ( is_singular() || ampforwp_is_front_page() ) && ( ampforwp_design_selector() == 1 || ampforwp_design_selector() == 2 || ampforwp_design_selector() == 3 )) {
			if ( empty( $data['amp_component_scripts']['amp-facebook-comments'] ) ) {
				$data['amp_component_scripts']['amp-facebook-comments'] = 'https://cdn.ampproject.org/v0/amp-facebook-comments-0.1.js';
			}
		}
		return $data;
	}

//37. compatibility with wp-html-compression
function ampforwp_copat_wp_html_compression() {
	remove_action('template_redirect', 'wp_html_compression_start', -1);
	remove_action('get_header', 'wp_html_compression_start');
	
	if( class_exists('BunnyCDN') ){
		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
		if( function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path)) {
			//Remove Action to remove CDN URL from BunnyCDN Plugin
			remove_action("template_redirect", "doRewrite");
		}
	}
}
add_action('amp_init','ampforwp_copat_wp_html_compression');

//38. Extra Design Specific Features
add_action('pre_amp_render_post','ampforwp_add_extra_functions',12);
function ampforwp_add_extra_functions() {
	global $redux_builder_amp;
	if ( $redux_builder_amp['amp-design-selector'] == 3 ) {
		require AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-3/functions.php';
	}
}

//38. #529 editable archives
add_filter( 'get_the_archive_title', 'ampforwp_editable_archvies_title' );
function ampforwp_editable_archvies_title($title) {
	global $redux_builder_amp;
	$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

	if ( $ampforwp_is_amp_endpoint){
	    if ( is_category() ) {
	            $title = single_cat_title( ampforwp_translation($redux_builder_amp['amp-translator-archive-cat-text'], 'Category (archive title)').' ', false );
	        } elseif ( is_tag() ) {
	            $title = single_tag_title( ampforwp_translation($redux_builder_amp['amp-translator-archive-tag-text'], 'Tag (archive title)').' ', false );
	        }
    }
    return $title;
}

//39. #560 Header and Footer Editable html enabled script area
add_action('amp_post_template_footer','ampforwp_footer_html_output',11);
function ampforwp_footer_html_output() {
  if(true == ampforwp_get_setting('ampforwp-footer-top')){
  	amp_back_to_top_link();
  }
  if( ampforwp_get_setting('amp-footer-text-area-for-html') ) {
    echo ampforwp_get_setting('amp-footer-text-area-for-html') ;
  }
  //Quantcast Support #4951
  if (ampforwp_get_setting('amp-quantcast-notice-switch')) {
  	 $id = $hashcode = $country = $name = '';
  	 $id = ampforwp_get_setting('amp-quantcast-id');
  	 $hashcode = ampforwp_get_setting('amp-quantcast-hashcode');
  	 $country = ampforwp_get_setting('amp-quantcast-publishercountrycode');
  	 $name = ampforwp_get_setting('amp-quantcast-publishername');
  if (!empty($id) && !empty($hashcode) && !empty($country) && !empty($name) ) {?>
	<amp-consent id="quantcast" layout="nodisplay">
    	<script type="application/json">
       	{
		   "consentInstanceId": "quantcast",
           "checkConsentHref": "https://apis.quantcast.mgr.consensu.org/amp/check-consent",
           "consentRequired": "remote",
           "promptUISrc": "https://quantcast.mgr.consensu.org/tcfv2/amp.html",
           "clientConfig": {
               "coreConfig": {
                   "quantcastAccountId": "<?php echo esc_html($id); ?>",
                   "privacyMode": ["GDPR"],
                   "hashCode": "<?php echo esc_html($hashcode); ?>",
                   "publisherCountryCode": "<?php echo esc_html($country); ?>",
                   "publisherName": "<?php echo esc_html($name); ?>",
                   "vendorPurposeIds": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                   "vendorFeaturesIds": [1, 2, 3],
                   "vendorPurposeLegitimateInterestIds": [2, 3, 4, 5, 6, 7, 8, 9, 10],
                   "vendorSpecialFeaturesIds": [1, 2],
                   "vendorSpecialPurposesIds": [1, 2],
                   "googleEnabled": false,
                   "lang_": "en",
                   "displayUi": "always",
                   "publisherConsentRestrictionIds": [],
                   "publisherLIRestrictionIds": [],
                   "publisherPurposeIds": [],
                   "publisherPurposeLegitimateInterestIds": [],
                   "publisherSpecialPurposesIds": [],
                   "publisherFeaturesIds": [],
                   "publisherSpecialFeaturesIds": [],
                   "stacks": [1, 42],
                   "vendorListUpdateFreq": 30
                }
            }
        }
   	   </script>
<!-- PRIVACY BUTTON LOWER RIGHT -->
       <div id="postPromptUI">
           <button role="button" on="tap:quantcast.prompt()">
               <svg style="height:20px">
                   <g fill="none">
                       <g fill="#FFF">
                           <path
                               d="M16 10L15 9C15 9 15 8 15 8L16 7C16 7 16 6 16 6 16 
5 15 4 14 3 14 2 13 2 13 3L12 3C12 3 11 3 11 2L11 1C11 1 10 0 10 0 9 0 7 0 6 0 6 0 
5 1 5 1L5 2C5 3 4 3 4 3L3 3C3 2 2 2 2 3 1 4 0 5 0 6 0 6 0 7 0 7L1 8C1 8 1 9 1 9L0 
10C0 10 0 11 0 11 0 12 1 13 2 14 2 15 3 15 3 14L4 14C4 14 5 14 5 15L5 16C5 16 6 17 
6 17 7 17 9 17 10 17 10 17 11 16 11 16L11 15C11 14 12 14 12 14L13 14C13 15 14 15 14 
14 15 13 16 12 16 11 16 11 16 10 16 10ZM13 13L12 13C11 13 11 13 9 14L9 16C9 16 7 16 7
 16L7 14C5 14 5 13 4 13L3 13C2 13 1 12 1 11L3 10C2 9 2 8 3 7L1 6C1 5 2 4 3 4L4 4C5 4 5 
3 7 3L7 1C7 1 9 1 9 1L9 3C11 3 11 4 12 4L13 4C14 4 15 5 15 6L13 7C14 8 14 9 13 10L15 
11C15 12 14 13 13 13ZM8 5C6 5 5 7 5 9 5 10 6 12 8 12 10 12 11 10 11 9 11 7 10 5 8 5ZM8
 11C7 11 6 10 6 9 6 7 7 6 8 6 9 6 10 7 10 9 10 10 9 11 8 11Z" />
                       </g>
                   </g>
               </svg>
               PRIVACY
           </button>
       </div>
	</amp-consent>
	<amp-geo layout="nodisplay">
	  <script type="application/json">
	    {
	      "ISOCountryGroups": {
	         "<?php echo esc_html($country); ?>": ["<?php echo esc_html($country); ?>"]
	      }
	    }
	   </script>
 	</amp-geo>
<?php } }
}

add_filter( 'amp_post_template_data', 'ampforwp_global_head_scripts');
function ampforwp_global_head_scripts($data){
   $content = $data['post_amp_content'];
   $script_slug = '';
   $script_url = '';
   if( ampforwp_get_setting('amp-header-text-area-for-html') ) {
      $allscripts = ampforwp_get_setting('amp-header-text-area-for-html');
      preg_match_all('/<script(.*?)custom-element=\"(.*?)\"(.*?)src=\"(.*?)\"(.*?)><\/script>/', $allscripts, $matches);
      $script_slug = $matches[2];
      $script_url = $matches[4];
      if($matches){
         foreach ($script_slug as $key => $slug) {
            if(preg_match('/<\/'.$slug.'>/', $content)){
               if ( empty( $data['amp_component_scripts'][$slug] ) ) {
                  $data['amp_component_scripts'][$slug]  = $script_url[$key];
               }
            }
         }
      }
   }
   return $data;
}

add_action('amp_post_template_head','ampforwp_header_html_output',11);
function ampforwp_header_html_output() {
 	if( ampforwp_get_setting('ampforwp-seo-custom-additional-meta') ){
		echo strip_tags( ampforwp_get_setting('ampforwp-seo-custom-additional-meta'), '<link><meta>' );
	}
  if( ampforwp_get_setting('amp-header-text-area-for-html') ) {
  		$allhtml = ampforwp_get_setting('amp-header-text-area-for-html');
  		$allhtml = preg_replace('/<script(.*?)custom-element=\"(.*?)\"(.*?)src=\"(.*?)\"(.*?)><\/script>/','', $allhtml);
	  	echo $allhtml;
  	}
  $mob_pres_link = false;
	if(function_exists('ampforwp_mobile_redirect_preseve_link')){
	   $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	}	
}

add_filter('amp_post_template_data','ampforwp_set_body_content_script', 20);
function ampforwp_set_body_content_script($data){
	if( ampforwp_get_setting('amp-body-text-area') || ampforwp_get_setting('amp-footer-text-area-for-html') ) {
		$head_content =  ampforwp_get_setting('amp-header-text-area-for-html');
    	preg_match_all('/"amp-(.*?)"/', $head_content, $matches1);
    	$body_content =  ampforwp_get_setting('amp-body-text-area');
    	preg_match_all('/<\/amp-(.*?)>/', $body_content, $matches);
    	if(ampforwp_get_setting('amp-footer-text-area-for-html') ) {
	    	$footer_content =  ampforwp_get_setting('amp-footer-text-area-for-html');
	    	preg_match_all('/<\/amp-(.*?)>/', $footer_content, $matches);
	    }
    	if(isset($matches[1][0])){
    		$amp_comp = $matches[1];
    		for($i=0;$i<count($amp_comp);$i++){
    			$comp = $amp_comp[$i];
    			if($comp!='img'){
    				$script_ver = 'latest';
					if($comp == 'auto-ads' || $comp == 'ad'){
						$script_ver = '0.1';
					}
    				$component_url = "https://cdn.ampproject.org/v0/amp-".esc_attr($comp)."-".esc_attr($script_ver).".js";
    				if(isset($matches[1][0])){
    					$thtml = $matches1[1];
    					if(!in_array($comp, $thtml)){
    						$data['amp_component_scripts']["amp-".esc_attr($comp)] = esc_url($component_url);
    					}else{
    						$data['amp_component_scripts']["amp-".esc_attr($comp)] = esc_url($component_url);
    					}
    				} else{
    					$data['amp_component_scripts']["amp-".esc_attr($comp)] = esc_url($component_url); 
    				}   
    			}
    		}
    	}
    	
    }
    return $data;
}

//40. Meta Robots
add_action('amp_post_template_head' , 'ampforwp_talking_to_robots');
function ampforwp_talking_to_robots() {

  global $redux_builder_amp;
  global $wp;
  $meta_content = "";
  $talk_to_robots=false;

  //author archives  index/noindex
  if( is_author() && !$redux_builder_amp['ampforwp-robots-archive-author-pages'] ) {
	$talk_to_robots = true;
  }

  //date archives index/noindex
  if( is_date() && !$redux_builder_amp['ampforwp-robots-archive-date-pages'] ) {
    $talk_to_robots = true;
  }

  //Search pages noindexing by default
  if( is_search() ) {
    $talk_to_robots = true;
  }

  //categorys index/noindex
  if( is_category()  && !$redux_builder_amp['ampforwp-robots-archive-category-pages'] ) {
    $talk_to_robots = true;
  }

  //categorys index/noindex
  if( is_tag() && !$redux_builder_amp['ampforwp-robots-archive-tag-pages'] ) {
    $talk_to_robots = true;
  }

  if( is_archive() || is_home() ) {
    if ( get_query_var( 'paged' ) ) {
          $paged = get_query_var('paged');
      } elseif ( get_query_var( 'page' ) ) {
          $paged = get_query_var('page');
      } else {
          $paged = 1;
      }
      //sitewide archives sub pages index/noindex  ie page 2 onwards
      if( $paged >= 2 && !$redux_builder_amp['ampforwp-robots-archive-sub-pages-sitewide'] ) {
      	$talk_to_robots = true;
      }
    }

	$query_array = $wp->query_vars;
	if( array_key_exists( 'page' , $query_array ) ) {
		$page = $wp->query_vars['page'];
		if ( $redux_builder_amp['amp-frontpage-select-option'] && $page >= '2') {
			$talk_to_robots = true;
		}
	}

  if( $talk_to_robots ) {
  	$meta_content = "noindex,noarchive";
  }
  // Genesis
  if ( function_exists('genesis_get_robots_meta_content') && 'genesis' == ampforwp_get_setting('ampforwp-seo-selection') ) {
  	$meta_content = genesis_get_robots_meta_content();
  }
  // All in One SEO #1720
  if ( class_exists('All_in_One_SEO_Pack') ) {
  	$aios_class = $page = $opts = $aios_meta = $aiosp_noindex = $aiosp_nofollow = '';
  	$noindex       = 'index';
	$nofollow      = 'follow';
  	$aios_class = new All_in_One_SEO_Pack();
  	if (property_exists($aios_class,'get_page_number')) {
  		$page       = $aios_class->get_page_number();
	}
	if (property_exists($aios_class,'get_current_options')) {
		$opts = $aios_class->get_current_options( array(), 'aiosp' );
	}
	if (property_exists($aios_class,'get_robots_meta')) {
  		$aios_meta = $aios_class->get_robots_meta();
 	} 
  	if ( ( is_category() && ! empty( $aioseop_options['aiosp_category_noindex'] ) ) || ( ! is_category() && is_archive() && ! is_tag() && ! is_tax() || ( is_tag() && ! empty( $aioseop_options['aiosp_tags_noindex'] ) ) || ( is_search() && ! empty( $aioseop_options['aiosp_search_noindex'] ) )
		) ){
			$noindex = 'noindex';
		} elseif ( is_single() || is_page() || $aios_class->is_static_posts_page() || is_attachment() || is_category() || is_tag() || is_tax() || ( $page > 1 ) ) {
			$post_type = get_post_type();
			if ( ! empty( $opts ) ) {
				$aiosp_noindex  = htmlspecialchars( stripslashes( $opts['aiosp_noindex'] ) );
				$aiosp_nofollow = htmlspecialchars( stripslashes( $opts['aiosp_nofollow'] ) );
			}
			if ( $aiosp_noindex || $aiosp_nofollow || ! empty( $aioseop_options['aiosp_cpostnoindex'] )
				 || ! empty( $aioseop_options['aiosp_cpostnofollow'] ) || ! empty( $aioseop_options['aiosp_paginated_noindex'] ) || ! empty( $aioseop_options['aiosp_paginated_nofollow'] )
			) {
				if ( ( $aiosp_noindex == 'on' ) || ( ( ! empty( $aioseop_options['aiosp_paginated_noindex'] ) ) && $page > 1 ) ||
					 ( ( $aiosp_noindex == '' ) && ( ! empty( $aioseop_options['aiosp_cpostnoindex'] ) ) && in_array( $post_type, $aioseop_options['aiosp_cpostnoindex'] ) )
				) {
					$noindex = 'noindex';
				}
				if ( ( $aiosp_nofollow == 'on' ) || ( ( ! empty( $aioseop_options['aiosp_paginated_nofollow'] ) ) && $page > 1 ) ||
					 ( ( $aiosp_nofollow == '' ) && ( ! empty( $aioseop_options['aiosp_cpostnofollow'] ) ) && in_array( $post_type, $aioseop_options['aiosp_cpostnofollow'] ) )
				) {
					$nofollow = 'nofollow';
				}
			}
		}
		if ( is_singular() && property_exists($aios_class,'is_password_protected') && $aios_class->is_password_protected() && apply_filters( 'aiosp_noindex_password_posts', false ) ) {
			$noindex = 'noindex';
		}

		$robots_meta = $noindex . ',' . $nofollow;
		if ( $robots_meta == 'index,follow' ) {
			$robots_meta = '';
		}

	  	if ( !empty($robots_meta) ) {
	  		$meta_content = $robots_meta;
	  	}
  	}
  	// Meta Robots Tag From Yoast #1563
  	if ( class_exists('WPSEO_Frontend') && 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && is_singular() && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) {
		$class_instance = '';
	    $class_instance = WPSEO_Frontend::get_instance();
	    // robots() will return and print the meta robots tag
	    $class_instance->robots();
	    // Empty the above meta content to avoid duplicate meta robot tags
	    $meta_content = '';
	}
	$meta_content = apply_filters('ampforwp_robots_meta', $meta_content);
	if ( isset($redux_builder_amp['amp-inspection-tool']) && true == $redux_builder_amp['amp-inspection-tool'] ) {
			$talk_to_robots = $meta_content = '';
	}
	if ( $meta_content ) {
	  	if ( ( is_archive() && $talk_to_robots ) || is_singular() || is_home() ) {	
	  		echo '<meta name="robots" content="' . esc_attr($meta_content) . '"/>';
	  	}
	}

}

// 41. Rewrite URL only on save #511
function ampforwp_auto_flush_on_save($redux_builder_amp) {
	if ( $redux_builder_amp['amp-on-off-for-all-pages'] == 1 || $redux_builder_amp['ampforwp-archive-support'] == 1 || $redux_builder_amp['fb-instant-article-switch'] == 1 ) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
	$options = $new_options = array();
	if ( is_array(ampforwp_get_setting('hide-amp-categories')) && !is_array(ampforwp_get_setting('hide-amp-categories2'))) {
		$options = array_keys(array_filter($redux_builder_amp['hide-amp-categories'] ) );
		foreach ($options as $option ) {
			$new_options[] = $option;
		}
	    $redux_builder_amp['hide-amp-categories2'] = $new_options;
		$redux_builder_amp['hide-amp-categories'] = '';
	    update_option('redux_builder_amp',$redux_builder_amp);
	 }
}
add_action("redux/options/redux_builder_amp/saved",'ampforwp_auto_flush_on_save', 10, 1);

// 42. registeing AMP sidebars
add_action('init', 'ampforwp_add_widget_support');
function ampforwp_add_widget_support() {
	if (function_exists('register_sidebar')) {
		global $redux_builder_amp;

		register_sidebar(array(
			'name' => 'AMP Above Loop [HomePage]',
			'id'   => 'ampforwp-above-loop',
			'description'   => 'This Widget will be display on AMP HomePage Above the loop ',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

		register_sidebar(array(
			'name' => 'AMP Below Loop [HomePage]',
			'id'   => 'ampforwp-below-loop',
			'description'   => 'This Widget will be display on AMP HomePage Below the loop',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

		register_sidebar(array(
			'name' 			=> 'AMP Below the Header [Site Wide]',
			'id'   			=> 'ampforwp-below-header',
			'description'   => 'This Widget will be display after the header bar',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4><span>',
			'after_title'   => '</h4></span>'
		));

		register_sidebar(array(
			'name' 			=> 'AMP Above the Footer [Site Wide]',
			'id'   			=> 'ampforwp-above-footer',
			'description'   => 'This Widget display Above the Footer',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4><span>',
			'after_title'   => '</h4></span>'
		));

	if ( function_exists('ampforwp_custom_theme_files_register') ) {
    $desc = "<b>Update: <a target='_blank' href='https://ampforwp.com/tutorials/article/amp-page-builder-installation/'>Introducing PageBuilder 2.0</a></b><br />Drag and Drop the AMP Modules in this Widget Area and then assign this widget area to a page <a href=http://ampforwp.com/tutorials/page-builder>(Need Help?)</a>";
    $placeholder = 'PLACEHOLDER';
			register_sidebar(array(
				'name' 			=> 'Page Builder (AMP) [Legacy]',
				'id'   			=> 'layout-builder',
                'description' => $placeholder,
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>' 
			));
            
        add_action( 'widgets_admin_page', function() use ( $desc, $placeholder ) {
            add_filter( 'esc_html', function( $safe_text, $text ) use ( $desc, $placeholder ) {

                if ( $text !== $placeholder )
                    return $safe_text;

                remove_filter( current_filter(), __FUNCTION__ );

                return $desc;
            }, 10, 2 );
        });
            
		}

	}
}

// 43. custom actions for widgets output
add_action( 'ampforwp_home_above_loop' , 'ampforwp_output_widget_content_above_loop' );
add_action( 'ampforwp_frontpage_above_loop' , 'ampforwp_output_widget_content_above_loop' );
function ampforwp_output_widget_content_above_loop() {
	$sanitized_sidebar = "";
	$sidebar_output = "";
	$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-above-loop');	
    if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content();
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output)); 
	}
      if ( $sidebar_output ) { ?>
	   	<div class="cntr">
	   		<div class="amp-wp-content widget-wrapper amp_widget_above_loop">
	   			<div class="f-w">
			  		<?php echo do_shortcode($sidebar_output); ?>
					<div class="cb"></div>
				</div>
	  		</div>
	  	</div> 
	<?php }
}

add_action( 'ampforwp_home_below_loop' , 'ampforwp_output_widget_content_below_loop' );
add_action( 'ampforwp_frontpage_below_loop' , 'ampforwp_output_widget_content_below_loop' );
function ampforwp_output_widget_content_below_loop() {
    $sanitized_sidebar = "";
	$sidebar_output = "";
	$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-below-loop');	
 if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content();
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output)); 
	}
    if ( $sidebar_output ) { ?>
	   	<div class="amp-wp-content widget-wrapper">
		   		<div class="amp_widget_below_loop f-w">
		  			<?php echo do_shortcode($sidebar_output); ?> 
		  		</div>
	  	</div> 
	<?php } 
}

add_action( 'ampforwp_after_header' , 'ampforwp_output_widget_content_below_the_header' );
add_action('below_the_header_design_1','ampforwp_output_widget_content_below_the_header');
function ampforwp_output_widget_content_below_the_header() {
	 $sanitized_sidebar = "";
	 $sidebar_output = "";
	 $sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-below-header');
     if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content(); 
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output));
	}
	if ( $sidebar_output ) { ?>
	   	<div class="amp-wp-content widget-wrapper">
	   		<div class="cntr">
			   	<div class="amp_widget_below_the_header f-w">
			  		<?php echo do_shortcode($sidebar_output); ?> 
			 	</div>
			</div>
	  	</div> 
	<?php }
}

add_action( 'amp_post_template_above_footer' , 'ampforwp_output_widget_content_above_the_footer' );
function ampforwp_output_widget_content_above_the_footer() {
	$sanitized_sidebar = "";
	$sidebar_output = "";
	$sanitized_sidebar = ampforwp_sidebar_content_sanitizer('ampforwp-above-footer');
	if ( $sanitized_sidebar) {
		$sidebar_output = $sanitized_sidebar->get_amp_content();
		$sidebar_output = apply_filters('ampforwp_modify_sidebars_content',do_shortcode($sidebar_output));
	}
	if ( $sidebar_output ) { ?>
	   	<div class="amp-wp-content widget-wrapper">
	   		<div class="cntr">
				<div class="amp_widget_above_the_footer f-w">
					<?php echo do_shortcode($sidebar_output); ?> 
				</div>
			</div>
		</div>
	<?php }
}
// Filter the sidebars content to make it work properly with carousels
add_filter('ampforwp_modify_sidebars_content','ampforwp_sidebars_carousel_content');
function ampforwp_sidebars_carousel_content($content){
	$content = str_replace(array(':openbrack:',':closebrack:'), array('[',']'), $content);
	return $content;
}
// Sidebar Content Sanitizer
function ampforwp_sidebar_content_sanitizer($sidebar){
  global $redux_builder_amp;
  $sanitized_sidebar     	= "";
  $non_sanitized_sidebar   	= "";
  $sidebar_data 			= array();
  $blacklist_array	 		= array();
  // Remove some blacklist tags from sidebars only when search,archives and categories widgets are active #2835
  if ( is_active_widget(false,false,'search') || is_active_widget(false,false,'archives') || is_active_widget(false,false,'categories') ) {
  	$blacklist_array['non-content'] = 'non-content';
  }
  ob_start();
  dynamic_sidebar( $sidebar );
  $non_sanitized_sidebar = ob_get_contents();
  ob_end_clean();
  
  if ( $non_sanitized_sidebar ) {
	  $sanitized_sidebar = new AMPforWP_Content( $non_sanitized_sidebar,
	    apply_filters( 'amp_content_embed_handlers', array(
	    	  'AMP_Reddit_Embed_Handler' => array(),
	          'AMP_Twitter_Embed_Handler' => array(),
	          'AMP_YouTube_Embed_Handler' => array(),
	          'AMP_DailyMotion_Embed_Handler' => array(),
			  'AMP_Vimeo_Embed_Handler' => array(),
			  'AMP_SoundCloud_Embed_Handler' => array(),
	          'AMP_Instagram_Embed_Handler' => array(),
	          'AMP_Vine_Embed_Handler' => array(),
	          'AMP_Facebook_Embed_Handler' => array(),
	          'AMP_Pinterest_Embed_Handler' => array(),
	          'AMP_Gallery_Embed_Handler' => array(),
	    ) ),
	    apply_filters(  'amp_sidebar_sanitizers', array(
	           'AMP_Style_Sanitizer' => array(),
	           'AMP_Blacklist_Sanitizer' => $blacklist_array,
	           'AMP_Img_Sanitizer' => array(),
	           'AMP_Video_Sanitizer' => array(),
	           'AMP_Audio_Sanitizer' => array(),
	           'AMP_Playbuzz_Sanitizer' => array(),
	           'AMP_Iframe_Sanitizer' => array(
	             'add_placeholder' => true,
	           ),
	           'AMP_Tag_And_Attribute_Sanitizer' => array(), 
	    )  ), array('non-content'=>'non-content')
	  );
  }
  if ( is_active_widget(false,false,'search') && $sanitized_sidebar) {
  	// Allow some blacklisted tags #1400
	add_filter('ampforwp_modify_sidebars_content','ampforwp_modified_search_sidebar');
  }
  return $sanitized_sidebar;
}

function ampforwp_modified_search_sidebar( $content ) {
	global $redux_builder_amp;
	$mob_pres_link = false;
  if(function_exists('ampforwp_mobile_redirect_preseve_link')){
    $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
  }
	$mob_pres_link = false;
	  if(function_exists('ampforwp_mobile_redirect_preseve_link')){
	    $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	  }
	$dom = '';
	$dom = AMP_DOM_Utils::get_dom_from_content($content);
	$nodes = $dom->getElementsByTagName( 'form' );
	$num_nodes = $nodes->length;
	if ( 0 !== $num_nodes ) {
		for ( $i = 0; $i < $nodes->length; ++$i ) {
			$element = $nodes->item( $i );
			if (ampforwp_get_setting('ampforwp-amp-takeover') == false && $mob_pres_link == false ) {
				$amp_query_variable = 'amp';
				$amp_query_variable_val = '1';
			}
			if ( ! $element->hasAttribute('action-xhr') ){
				$action_url = $element->getAttribute('action');
				$action_url = preg_replace('#^http?:#', '', $action_url);
				$element->setAttribute('action', $action_url);
			}
			$element->setAttribute('target', '_top');
			$input_nodes = $element->getElementsByTagName('input');
			if ( 0 !== $input_nodes->length ) {
				for ( $i = 0; $i < $input_nodes->length; ++$i ) {
					$input_node = $input_nodes->item( $i );
					if ( 'submit' !== $input_node->getAttribute('type') ) {
						$input_submit = $dom->createElement('input');
						$input_submit->setAttribute('type', 'submit');
						$input_submit->setAttribute('class', 'search-submit');
					}
				}
				if ( $input_submit ) {
					$element->appendChild($input_submit);
				}
			}
		}
	}
	// Remove http/https from Audio and Video URLs #1400
	$video_nodes = $dom->getElementsByTagName( 'amp-video' );
	$num_nodes = $video_nodes->length;
	if ( 0 !== $num_nodes ) {
		for ( $i = 0; $i < $video_nodes->length; ++$i ) {
			$element = $video_nodes->item( $i );
			$source = $element->childNodes->item(0);
			$source->setAttribute('src',preg_replace('#^http?:#', '', $source->getAttribute('src') ));
			$source = $element->childNodes->item(1);
			if($source)
				$source->setAttribute('src',preg_replace('#^http?:#', '', $source->getAttribute('src') ));
		}
	}
	$audio = $dom->getElementsByTagName( 'amp-audio' );
	$num_nodes = $audio->length;
	if ( 0 !== $num_nodes ) {
		for ( $i = 0; $i < $audio->length; ++$i ) {
			$element = $audio->item( $i );
			$source = $element->childNodes->item(0);
			$source->setAttribute('src',preg_replace('#^http?:#', '', $source->getAttribute('src') ));
			$source = $element->childNodes->item(1);
			$source->setAttribute('src',preg_replace('#^http?:#', '', $source->getAttribute('src') ));
		}
	}
	$content = AMP_DOM_Utils::get_content_from_dom($dom);
	return $content;
}

function ampforwp_sidebar_blacklist_tags($tags) {
	$form  = array_search('form', $tags);
	$input = array_search('input', $tags);
	$label = array_search('label', $tags);
	$textarea = array_search('textarea', $tags);
	$select = array_search('select', $tags);
	$option = array_search('option', $tags);
	if ( $input ) {
		unset($tags[$input]);
	}
	if ( $label ) {
		unset($tags[$label]);		
	}
	if ( $textarea ) { unset($tags[$textarea]); }
	if ( $select ) { unset($tags[$select]); }
	if ( $option ) { unset($tags[$option]); }
	return $tags;
}
// Sidebar Scripts	
add_filter( 'amp_post_template_data', 'ampforwp_add_sidebar_data', 85 );
function ampforwp_add_sidebar_data( $data ) {
	$sanitized_data_above_loop 	 	= '';
	$sanitized_data_below_loop 	 	= '';
	$sanitized_data_below_header 	= '';
	$sanitized_data_above_footer 	= '';
	$sanitized_data_swift_sidebar 	= '';
	$sanitized_data_swift_footer  	= '';
	// Get the Data
	$sanitized_data_above_loop 	 = ampforwp_sidebar_content_sanitizer('ampforwp-above-loop');
	$sanitized_data_below_loop 	 = ampforwp_sidebar_content_sanitizer('ampforwp-below-loop');
	$sanitized_data_below_header = ampforwp_sidebar_content_sanitizer('ampforwp-below-header');
	$sanitized_data_above_footer = ampforwp_sidebar_content_sanitizer('ampforwp-above-footer');
	$sanitized_data_swift_sidebar = ampforwp_sidebar_content_sanitizer('swift-sidebar');
	$sanitized_data_swift_footer = ampforwp_sidebar_content_sanitizer('swift-footer-widget-area');

	if ( $sanitized_data_above_loop ) {
		// Add Scripts
		if ( $sanitized_data_above_loop->get_amp_scripts() ) {
			foreach ($sanitized_data_above_loop->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Form script #1400
		$dom = AMP_DOM_Utils::get_dom_from_content($sanitized_data_above_loop->get_amp_content());
		if ( 0 !== $dom->getElementsByTagName( 'form' )->length ) {
			if( empty( $data['amp_component_scripts']['amp-form'] ) ){
					$data['amp_component_scripts']['amp-form']  = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
			} 
		}
		// Add Styles
		if ( $sanitized_data_above_loop->get_amp_styles() ) {
			foreach ($sanitized_data_above_loop->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_below_loop ) {
		// Add Scripts
		if ( $sanitized_data_below_loop->get_amp_scripts() ) {
			foreach ($sanitized_data_below_loop->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Form script #1400
		$dom = AMP_DOM_Utils::get_dom_from_content($sanitized_data_below_loop->get_amp_content());
		if ( 0 !== $dom->getElementsByTagName( 'form' )->length ) {
			if( empty( $data['amp_component_scripts']['amp-form'] ) ){
					$data['amp_component_scripts']['amp-form']  = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
			} 
		}
		// Add Styles
		if ( $sanitized_data_below_loop->get_amp_styles() ) {
			foreach ($sanitized_data_below_loop->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_below_header ) {
		// Add Scripts
		if ( $sanitized_data_below_header->get_amp_scripts() ) {
			foreach ($sanitized_data_below_header->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Form script #1400
		$dom = AMP_DOM_Utils::get_dom_from_content($sanitized_data_below_header->get_amp_content());
		if ( 0 !== $dom->getElementsByTagName( 'form' )->length ) {
			if( empty( $data['amp_component_scripts']['amp-form'] ) ){
					$data['amp_component_scripts']['amp-form']  = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
			} 
		}
		// Add Styles
		if ( $sanitized_data_below_header->get_amp_styles() ) {
			foreach ($sanitized_data_below_header->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_above_footer ) {		
		// Add Scripts
		if ( $sanitized_data_above_footer->get_amp_scripts() ) {
			foreach ($sanitized_data_above_footer->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Form script #1400
		$dom = AMP_DOM_Utils::get_dom_from_content($sanitized_data_above_footer->get_amp_content());
		if ( 0 !== $dom->getElementsByTagName( 'form' )->length ) {
			if( empty( $data['amp_component_scripts']['amp-form'] ) ){
					$data['amp_component_scripts']['amp-form']  = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
			} 
		}
		// Add Styles
		if ( $sanitized_data_above_footer->get_amp_styles() ) {
			foreach ($sanitized_data_above_footer->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_swift_sidebar ) {		
		// Add Scripts
		if ( $sanitized_data_swift_sidebar->get_amp_scripts() ) {
			foreach ($sanitized_data_swift_sidebar->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Form script #1400
		$dom = AMP_DOM_Utils::get_dom_from_content($sanitized_data_swift_sidebar->get_amp_content());
		if ( 0 !== $dom->getElementsByTagName( 'form' )->length ) {
			if( empty( $data['amp_component_scripts']['amp-form'] ) ){
					$data['amp_component_scripts']['amp-form']  = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
			} 
		}
		// Add Styles
		if ( $sanitized_data_swift_sidebar->get_amp_styles() ) {
			foreach ($sanitized_data_swift_sidebar->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	if ( $sanitized_data_swift_footer ) {		
		// Add Scripts
		if ( $sanitized_data_swift_footer->get_amp_scripts() ) {
			foreach ($sanitized_data_swift_footer->get_amp_scripts() as $key => $value ) {
				if( empty( $data['amp_component_scripts'][$key] ) ){
					$data['amp_component_scripts'][$key]  = $value;
				}
			}
		}
		// Form script #1400
		$dom = AMP_DOM_Utils::get_dom_from_content($sanitized_data_swift_footer->get_amp_content());
		if ( 0 !== $dom->getElementsByTagName( 'form' )->length ) {
			if( empty( $data['amp_component_scripts']['amp-form'] ) ){
					$data['amp_component_scripts']['amp-form']  = 'https://cdn.ampproject.org/v0/amp-form-0.1.js';
			} 
		}
		// Add Styles
		if ( $sanitized_data_swift_footer->get_amp_styles() ) {
			foreach ($sanitized_data_swift_footer->get_amp_styles() as $key => $value ) {
				if( empty( $data['post_amp_styles'][$key] ) ){
					$data['post_amp_styles'][$key]  = $value;
				}
			}
		}
	}
	return $data; 
}
// 44. auto adding /amp for the menu
add_action('amp_init','ampforwp_auto_add_amp_menu_link_insert');
function ampforwp_auto_add_amp_menu_link_insert() {
	add_action( 'pre_amp_render_post', 'ampforwp_auto_add_amp_in_link_check', 99 );
}

function ampforwp_auto_add_amp_in_link_check() {
	$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();
	$add_amp_menu = get_transient('ampforwp_auto_add_amp_in_menu_link');
	if ( false == $add_amp_menu || ( 'on' && 0 == ampforwp_get_setting('ampforwp-auto-amp-menu-link') ) ) {
		delete_transient('ampforwp_header_menu');
		delete_transient('ampforwp_footer_menu');
		set_transient('ampforwp_auto_add_amp_in_menu_link', 'off');
	}
	if ( $ampforwp_is_amp_endpoint && ampforwp_get_setting('ampforwp-auto-amp-menu-link') == 1 ) {
		if( 'off' == $add_amp_menu ) {
			delete_transient('ampforwp_header_menu');
			delete_transient('ampforwp_footer_menu');
			set_transient('ampforwp_auto_add_amp_in_menu_link', 'on');
		}
		add_filter( 'nav_menu_link_attributes', 'ampforwp_auto_add_amp_in_menu_link', 10, 3 );
	}
}

function ampforwp_auto_add_amp_in_menu_link( $atts, $item, $args ) {
	if($item->type=='post_type' && !in_array($item->object, ampforwp_get_all_post_types()) ){
		return $atts;
	}
	if($item->type=='taxonomy' && !in_array($item->object, ampforwp_get_all_post_types()) ){
		return $atts;
	}
	$mob_pres_link = false;
	if(function_exists('ampforwp_mobile_redirect_preseve_link')){
	  $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	}
	if(ampforwp_get_setting('ampforwp-amp-takeover') || $mob_pres_link == true){
		return $atts;
	}
	$url = $atts['href'];
	if($url){
		$is_external = ampforwp_isexternal($url);
	}
	if($is_external){
		return $atts;
	}
  	if(ampforwp_get_setting('amp-core-end-point') == 1 ){
	    $atts['href'] = user_trailingslashit(trailingslashit( $atts['href'] ) );
		$atts['href'] = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1', $atts['href']);
	}
  	else{
  		if(false === strpos($atts['href'], "#")){
     		$atts['href'] = user_trailingslashit(trailingslashit( $atts['href'] ) . AMPFORWP_AMP_QUERY_VAR);
     	}   
    }
    
    $atts = apply_filters('ampforwp_auto_add_amp_menu_url',$atts);

	return $atts;
}

// 45. searchpage, frontpage, homepage structured data
// Moved to structured-data-functions.php

// 46. search search search everywhere #615
require 'search-functions.php';

// 47. social js properly adding when required
if( !function_exists( 'is_socialshare_or_socialsticky_enabled_in_ampforwp' ) ) {
	function is_socialshare_or_socialsticky_enabled_in_ampforwp() {
		global $redux_builder_amp;
		if(  $redux_builder_amp['enable-single-facebook-share'] ||
				 $redux_builder_amp['enable-single-twitter-share']  ||
				 $redux_builder_amp['enable-single-email-share'] ||
				 $redux_builder_amp['enable-single-pinterest-share']  ||
				 $redux_builder_amp['enable-single-linkedin-share'] )  {
					return true;
				}
			return false;
	}
}

// 48. Remove all unwanted scripts on search pages
add_filter( 'amp_post_template_data', 'ampforwp_remove_scripts_search_page' );
function ampforwp_remove_scripts_search_page( $data ) {
	if( is_search() ) {
		// Remove all unwanted scripts on search pages
		unset( $data['amp_component_scripts']);
	}
	return $data;
}

// 49. Properly adding ad Script the AMP way
// Moved to ads-functions.php

// internal function for checing if social profiles have been set
if( !function_exists('ampforwp_checking_any_social_profiles') ) {
	function ampforwp_checking_any_social_profiles() {
		global $redux_builder_amp;
		if(
			$redux_builder_amp['enable-single-twittter-profile'] 	 ||
			$redux_builder_amp['enable-single-facebook-profile'] 	 ||
			$redux_builder_amp['enable-single-pintrest-profile'] 	 ||
			$redux_builder_amp['enable-single-google-plus-profile']	 ||
			$redux_builder_amp['enable-single-linkdin-profile'] 	 ||
			$redux_builder_amp['enable-single-youtube-profile'] 	 ||
			$redux_builder_amp['enable-single-instagram-profile'] 	 ||
			$redux_builder_amp['enable-single-VKontakte-profile'] 	 ||
			$redux_builder_amp['enable-single-reddit-profile'] 		 ||
			$redux_builder_amp['enable-single-snapchat-profile'] 	 ||
			$redux_builder_amp['enable-single-Tumblr-profile']
	 	) {
			return true;
		}
		return false;
	}
}

// 50. Properly adding noditification Scritps the AMP way
// Moved to notice-bar-functions.php

//52. Adding a generalized sanitizer function for purifiying normal html to amp-html
function ampforwp_content_sanitizer( $content ) {
	global $post;
	$amp_custom_post_content_input = $content;
	if ( !empty( $amp_custom_post_content_input ) ) {
		$amp_custom_content = new AMPFORWP_Content( $amp_custom_post_content_input,
				apply_filters( 'amp_content_embed_handlers', array(
					    'AMP_Reddit_Embed_Handler' => array(),
						'AMP_Twitter_Embed_Handler' => array(),
						'AMP_YouTube_Embed_Handler' => array(),
						'AMP_Instagram_Embed_Handler' => array(),
						'AMP_Vine_Embed_Handler' => array(),
						'AMP_Facebook_Embed_Handler' => array(),
						'AMP_Gallery_Embed_Handler' => array(),
				) ),
				apply_filters(  'amp_content_sanitizers', array(
						 'AMP_Style_Sanitizer' => array(),
						 'AMP_Blacklist_Sanitizer' => array(),
						 'AMP_Img_Sanitizer' => array(),
						 'AMP_Video_Sanitizer' => array(),
						 'AMP_Audio_Sanitizer' => array(),
						 'AMP_Iframe_Sanitizer' => array(
							 'add_placeholder' => true,
						 ),
				),$post  )
		);

		if ( $amp_custom_content ) {
			global $data;
			$data = (array) $data;
			$data['amp_component_scripts'] 	= $amp_custom_content->get_amp_scripts();
			$data['post_amp_styles'] 		= $amp_custom_content->get_amp_styles();
			return $amp_custom_content->get_amp_content();
		}
		return '';
	}
}


//53. Removed AMP-WooCommerce Code and added it in AMP-WooCommerce #929
// Adding the styling for AMP Woocommerce latest Products(AMP-WooCommerce Widgets)
add_action('amp_post_template_css','amp_latest_products_styling',PHP_INT_MAX);
function amp_latest_products_styling() { 
	if ( class_exists( 'woocommerce' ) ) { ?>
		.ampforwp_wc_shortcode{margin-top: 0;padding:0;display:inline-block;width: 100%;}
		.ampforwp_wc_shortcode li{position: relative;width:29%; font-size:12px; line-height: 1; float: left;list-style-type: none;margin:2%;}
		.ampforwp_wc_shortcode .onsale{position: absolute;top: 0;right: 0;background: #ddd;padding: 7px;font-size: 12px;}
		.single-post .ampforwp_wc_shortcode li amp-img{margin:0}
		.ampforwp-wc-title{margin: 8px 0px 10px 0px;font-size: 13px;}
		.ampforwp-wc-price{color:#444}
		.wc_widgettitle{text-align:center;margin-bottom: 0px;}
		.ampforwp-wc-price, .ampforwp_wc_star_rating{float:left;margin-right: 10px;}
	<?php }
}

// 54. Change the default values of post meta for AMP pages. #746
add_action('admin_head','ampforwp_change_default_amp_page_meta');
function ampforwp_change_default_amp_page_meta() {
	if ( ! current_user_can('manage_options') ) {
         return ;
    }
	global $redux_builder_amp;
	$check_meta 		= get_option('ampforwp_default_pages_to');
	$checker			= 'show';
	$control			= $redux_builder_amp['amp-pages-meta-default'];
	$meta_value_to_upate = 'default';

	if ( $control  === 'hide' ) {
		$checker				= 'hide';
		$meta_value_to_upate 	= 'hide-amp';
	}

	// Check and Run only if the value has been changed, else return
	if ( $check_meta === $checker ) {
		return;
	}
	// Get all the pages and update the post meta
	$pages = get_pages(array());
	foreach($pages as $page){
	    update_post_meta($page->ID,'ampforwp-amp-on-off', $meta_value_to_upate);
	}
	// Update the option as the process has been done and update an option
	update_option('ampforwp_default_pages_to', $checker);
	return ;
}


// Adding the meta="description" from yoast or from the content
add_action('amp_post_template_head','ampforwp_meta_description');
function ampforwp_meta_description() {
	global $redux_builder_amp;
	if ( false == ampforwp_get_setting('ampforwp-seo-meta-desc') || ('rank_math' == ampforwp_get_setting('ampforwp-seo-selection') && is_singular() )) {
		return;
	}
	if (function_exists('aioseo_pro_just_activated') && 'aioseo' == ampforwp_get_setting('ampforwp-seo-selection') ) {
		return;
	}
	$desc = ampforwp_generate_meta_desc();
	if ( $desc && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) {
		echo '<meta name="description" content="'. esc_attr( convert_chars( stripslashes( $desc ) ) )  .'"/>';
		}else if(class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')){
		$yoast_desc = addslashes( strip_tags( WPSEO_Meta::get_value('metadesc', ampforwp_get_the_ID() ) ) );
		$yoast_desc_meta = get_option( 'wpseo_titles' );
		if(isset($yoast_desc_meta['metadesc-page'])){
			$yoast_desc_meta = $yoast_desc_meta['metadesc-page'];
		}
		if(empty($yoast_desc)){
			$yoast_desc = $yoast_desc_meta;
		}
		if ($yoast_desc && ampforwp_is_front_page()) {
			echo '<meta name="description" content="'. esc_attr( convert_chars( stripslashes( $yoast_desc ) ) )  .'"/>';
		}
		elseif ($desc && ampforwp_is_home() && 'page' == get_option( 'show_on_front') && empty(get_option( 'page_for_posts')) ){
			echo '<meta name="description" content="'. esc_attr( convert_chars( stripslashes( $desc ) ) )  .'"/>';
		}
	}
}
// All in One Seo Compatibility #1557
if(defined( 'AIOSEO_VERSION' ) && version_compare(AIOSEO_VERSION,'4.0.0', '<')){
	add_filter('aioseop_amp_description', '__return_false');
}
// 55. Call Now Button Feature added
add_action('ampforwp_call_button','ampforwp_call_button_html_output');
function ampforwp_call_button_html_output(){
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
		<div class="callnow">
			<a href="tel:<?php echo esc_attr($redux_builder_amp['enable-amp-call-numberfield']); ?>"></a>
		</div> <?php
  }
}

// 56. Multi Translation Feature #540
// Moved to functions.php

// 57. Adding Updated date at in the Content
add_action('ampforwp_after_post_content','ampforwp_add_modified_date');
function ampforwp_add_modified_date($post_object){
	global $redux_builder_amp;
	if ( is_single() && $redux_builder_amp['post-modified-date'] == true && ( ! checkAMPforPageBuilderStatus( get_the_ID() ) ) ) { ?>
		<div class="ampforwp-last-modified-date">
			<p> <?php
				$date_notice_type = ampforwp_get_setting('ampforwp-post-date-notice-type');
				if( $date_notice_type == "modified" && $post_object->get( 'post_modified_timestamp' ) !== $post_object->get( 'post_publish_timestamp' ) ){
					$date_notice_text = ampforwp_get_setting('amp-translator-modified-date-text');
					$date = $post_object->get( 'post_modified_timestamp' );
					echo esc_html(
						sprintf(
							_x( ampforwp_translation( $date_notice_text ,'This article was last modified on ' ) . ' %s '  , '%s = human-readable time difference', 'accelerated-mobile-pages' ),
							date_i18n( get_option( 'date_format' ) , $date )
						)
					);
				 if(true == ampforwp_get_setting('ampforwp-post-date-notice-time')){
						echo get_the_modified_time();
					}
				}elseif($date_notice_type == "published"){
					$date_notice_text = ampforwp_get_setting('amp-translator-published-date-text');
					$date = $post_object->get( 'post_publish_timestamp' );
					echo esc_html(
						sprintf(
							_x( ampforwp_translation( $date_notice_text ,'This article was last modified on ' ) . ' %s '  , '%s = human-readable time difference', 'accelerated-mobile-pages' ),
							date_i18n( get_option( 'date_format' ) , $date )
						)
					);
					if(true == ampforwp_get_setting('ampforwp-post-date-notice-time')){
						echo get_the_time();
					}
				}
			?>
			</p>
		</div> <?php
	}
}

// 58. YouTube Shortcode compatablity with AMP #557 #971

add_filter('amp_content_embed_handlers','ampforwp_youtube_shortcode_embedder');
function ampforwp_youtube_shortcode_embedder($data){
	 unset($data['AMP_YouTube_Embed_Handler']);
	 $data[ 'AMPforWP_YouTube_Embed_Handler' ] = array();
	return $data;
}
if ( ! function_exists( 'ampforwp_youtube_shortcode') ) {

	function ampforwp_youtube_shortcode( $params, $old_format_support = false ) {
		$str = '';
		$parsed_url = array();
		$youtube_url = 'https://www.youtube.com/watch?v=';
		if(isset( $params['id']) ){
			$parsed_url = parse_url( $params['id'] );
		}
		$server = 'www.youtube.com';

		if ( in_array( $server, $parsed_url ) === false ) {
			if(isset($params['id']) && $params['id']){
			$new_url  = $youtube_url .  $params['id'] ;
			$params['id'] = $new_url;
			}
		}
		if ( $old_format_support && isset( $params[0] ) ) {
			$str = ltrim( $params[0], '=' );
		} elseif ( is_array( $params ) ) {
			foreach ( array_keys( $params ) as $key ) {
			  if ( ! is_numeric( $key ) ) {
			    $str = $key . '=' . $params[ $key ];
			  }
			}
		}
	  return str_replace( array( '&amp;', '&#038;' ), '&', $str );
	}
}
// Add extra params in amp-youtube
add_filter('amp_youtube_params', 'ampforwp_youtube_modified_params');
if( ! function_exists(' ampforwp_youtube_modified_params ') ){
	function ampforwp_youtube_modified_params($amp_youtube){
		$check = '';
		$param = '';
		// Check for extra params
		$check = preg_match('/(.*?)&(.*)/', $amp_youtube['data-videoid']);
		if(1 === $check){
			// Grab the extra param
			$param = preg_replace('/(.*?)&(.*)/', '$2', $amp_youtube['data-videoid']);
			// Parse the string into variables
			parse_str($param, $query_args);
			// Check for rel param
			if(isset($query_args['rel'])){
				// Add the rel param in amp-youtube's data-param
				$amp_youtube['data-param-rel'] = $query_args['rel'];
			}
			// Remove that param from URL
			$amp_youtube['data-videoid'] = preg_replace('/&(.*)/', '', $amp_youtube['data-videoid']);
			// Plyr Plugin Compatibility #1505
			if ( class_exists('Plyr') ) {
				$amp_youtube['data-param-rel'] 		= 0;
				$amp_youtube['data-param-autoplay'] = 0;
				$amp_youtube['data-param-showinfo'] = 0;
			}
		}
		return $amp_youtube;
	}
}
// 59. Comment Button URL
function ampforwp_comment_button_url(){
	global $redux_builder_amp;
	$button_url = "";
	if(ampforwp_get_setting('amp-mobile-redirection')==1){
		$button_url = add_query_arg( array( 'nonamp' => '1' ), get_permalink() );
		$button_url = $button_url. '#commentform';
	}
	elseif ( ampforwp_get_setting('ampforwp-amp-takeover') ) {
  		$button_url = user_trailingslashit(get_the_permalink()).'#comments';
  	}
  	else{
  		$button_url = get_permalink(). '#commentform';
  	}
  	return esc_url( apply_filters( 'ampforwp_comment_button_url', $button_url ) );
}

// 60. Remove Category Layout modification code added by TagDiv #842 and #796
// #1683
add_action('pre_amp_render_post', 'ampforwp_remove_tagdiv_category_layout');
function ampforwp_remove_tagdiv_category_layout(){
	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
		remove_action('pre_get_posts', 'td_modify_main_query_for_category_page',9);
	}
}

// 61. Add Gist Support
add_shortcode('amp-gist', 'ampforwp_gist_shortcode_generator');
function ampforwp_gist_shortcode_generator($atts) {
   extract(shortcode_atts(array(
   	  'id'     =>'' ,
      'layout' => 'fixed-height',
      'height' => 200,      
   ), $atts));  
   if ( empty ( $height ) ) {
   		$height = '250';
   }
  	return '<amp-gist data-gistid='. esc_attr($atts['id']) .' 
  		layout="fixed-height"
  		height="'. esc_attr($height) .'">
  		</amp-gist>';
}

// Code updated and added the JS proper way #336
add_filter('amp_post_template_data','ampforwp_add_amp_gist_script', 100);
function ampforwp_add_amp_gist_script( $data ){
	global $redux_builder_amp;
	$content = "";
    
	$content =   $data['post'];
    if( $content ){
        $content = $content->post_content;
        
        if( is_single() ) {
            if( has_shortcode( $content, 'amp-gist' ) ){ 
                if ( empty( $data['amp_component_scripts']['amp-gist'] ) ) {
                    $data['amp_component_scripts']['amp-gist'] = 'https://cdn.ampproject.org/v0/amp-gist-0.1.js';
                }
            }
        }
    }
		 
	return $data;
}


// 62. Adding Meta viewport via hook instead of direct #878 
add_action( 'amp_post_template_head','ampforwp_add_meta_viewport', 9);
function ampforwp_add_meta_viewport() {
	$output = '';
	$output = '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=2,user-scalable=yes">
	';
	if (ampforwp_get_setting('ampforwp-meta-viewport') == false) {
		$output = '<meta name="viewport" content="width=device-width">';
	}
	if(!class_exists( 'AMPforWP_Mobile_Detect') && !ampforwp_get_setting('amp-mobile-redirection')){
		ampforwp_require_file( AMPFORWP_PLUGIN_DIR.'/includes/vendor/Mobile_Detect.php ');
	}
	if(class_exists('AMPforWP_Mobile_Detect')){
		$mobile_detect = new AMPforWP_Mobile_Detect;
	    $isMobile = $mobile_detect->isMobile();
	    $isTablet = $mobile_detect->isTablet();
	    if( $isMobile || $isTablet ){
	    	$output = '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,user-scalable=yes">';
	    }
	}
	global $is_safari; 
	if ($is_safari) {
		$output .= '<meta name="referrer" content="no-referrer-when-downgrade">';
	}
	echo apply_filters('ampforwp_modify_meta_viewport_filter',$output);
	
}

// 63. Frontpage Comments #682 
function ampforwp_frontpage_comments() {
	global $redux_builder_amp;
	$data = get_option( 'ampforwp_design',array());
	$enable_comments = false;
	$post_id = "";

	$post_id = ampforwp_get_frontpage_id();	

	if (empty($data)) {
	 	$data['elements'] = "meta_info:1,title:1,featured_image:1,content:1,meta_taxonomy:1,social_icons:1,comments:1,related_posts:1";
	}
	if( isset( $data['elements'] ) || ! empty( $data['elements'] ) ){
		$options = explode( ',', $data['elements'] );
	};
	if ($options): foreach ($options as $key=>$value) {
		switch ($value) {
			case 'comments:1':
				$enable_comments = true;
			break;
		}
	} endif;
	if ( $enable_comments ) { ?>
		<div class="ampforwp-comment-wrapper">
			<?php
			$comment_button_url = "";
			$postID = '';
			// Gather comments for a Front from post id
			$postID = ampforwp_get_frontpage_id();
			$comment_order = get_option( 'comment_order' );
			$comments = get_comments(array(
					'post_id' => $postID,
					'order' => esc_attr($comment_order),
					'status' => 'approve' //Change this to the type of comments to be displayed
			));
			$comment_button_url = get_permalink( $post_id );
			$comment_button_url = apply_filters('ampforwp_frontpage_comments_url',$comment_button_url );
			if ( $comments ) { ?>
				<div class="amp-wp-content comments_list cmts_list">
				    <h3><?php global $redux_builder_amp; echo esc_html(ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'] , 'View Comments' ))?></h3>
				    <ul>
				    <?php
						$page = (get_query_var('page')) ? get_query_var('page') : 1;
						$total_comments = get_comments( array(
							'orderby' 	=> 'post_date' ,
							'order' 	=> 'DESC',
							'post_id'	=> $postID,
							'status' 	=> 'approve',
							'parent'	=>0 )
						);
						$pages = ceil(count($total_comments)/AMPFORWP_COMMENTS_PER_PAGE);
					    $pagination_args = array(
							'base'         =>  @add_query_arg('page','%#%'),
							'format'       => '?page=%#%',
							'total'        => $pages,
							'current'      => $page,
							'show_all'     => False,
							'end_size'     => 1,
							'mid_size'     => 2,
							'prev_next'    => True,
							'prev_text'    => ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous'),
							'next_text'    => ampforwp_translation( $redux_builder_amp['amp-translator-next-text'], 'Next'),
							'type'         => 'plain'
						);

						// Display the list of comments
						function ampforwp_custom_translated_comment($comment, $args, $depth){
							$GLOBALS['comment'] = $comment;
							global $redux_builder_amp; ?>
							<li id="li-comment-<?php esc_attr(comment_ID()) ?>"
							<?php comment_class(); ?> >
								<article id="comment-<?php esc_attr(comment_ID()); ?>" class="cmt-body">
									<footer class="cmt-meta">
										<div class="cmt-author vcard">
											<?php
											printf('<b class="fn">%s</b> <span class="says">'.esc_html(ampforwp_translation(ampforwp_get_setting('amp-translator-says-text'),'says')).':</span>', get_comment_author_link()) ?>
										</div>
										<!-- .comment-author -->
										<div class="cmt-metadata">
											<a href="<?php echo esc_url(untrailingslashit( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) )) ?>">
												<?php printf( esc_html(ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at %2$s')) , get_comment_date(),  get_comment_time())?>
											</a>
											<?php edit_comment_link( esc_html(ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' )  )) ?>
										</div>
										<!-- .comment-metadata -->
									</footer>
										<!-- .comment-meta -->
									<div class="cmt-content">
				                        <?php
				                          // $pattern = "~[^a-zA-Z0-9_ !@#$%^&*();\\\/|<>\"'+.,:?=-]~";
				                          $emoji_content = get_comment_text();
				                          // $emoji_free_comments = preg_replace($pattern,'',$emoji_content);
				                          $emoji_content = wpautop( $emoji_content );
					                      $sanitizer = new AMPFORWP_Content( $emoji_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(),
					                      'AMP_Video_Sanitizer' => array() ) ) );
					                      $sanitized_comment_content = $sanitizer->get_amp_content();
					                      echo make_clickable( $sanitized_comment_content );//amphtml content, no kses
				                           ?>
									</div>
										<!-- .comment-content -->
								</article>
							 <!-- .comment-body -->
							</li>
						<!-- #comment-## -->
							<?php
						}// end of ampforwp_custom_translated_comment()
						wp_list_comments( array(
						  'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE, //Allow comment pagination
						  'page'              	=> $page,
						  'style' 				=> 'li',
						  'type'				=> 'comment',
						  'max_depth'   		=> 5,
						  'avatar_size'			=> 0,
							'callback'				=> 'ampforwp_custom_translated_comment',
						  'reverse_top_level' 	=> false //Show the latest comments at the top of the list
						), $comments);
						echo paginate_links( $pagination_args );?>
				    </ul>
				</div>
				<?php 
				
			} 
			if ( comments_open($postID) ) {
				$comment_button_url = add_query_arg( array( 'nonamp' => '1' ),  $comment_button_url );?>
				<div class="cmt-button-wrapper">
				    <a href="<?php echo esc_url( $comment_button_url ) . '#commentform' ?>" rel="nofollow"><?php  echo esc_html(ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  )); ?></a>
				</div><?php
				}?>
		</div> <?php
	} 
}

// 64. PageBuilder 
add_action('pre_amp_render_post','ampforwp_apply_layout_builder_on_pages',20);
function ampforwp_apply_layout_builder_on_pages($post_id) {
	global $redux_builder_amp;
	$sidebar_check = null;
	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
	}

	if ( function_exists('ampforwp_custom_theme_files_register') ) {
		if ( is_page() ) {
			$sidebar_check = get_post_meta( $post_id,'ampforwp_custom_sidebar_select',true); 
		}
		// Add Styling Builder Elements
		add_action('amp_post_template_css', 'ampforwp_pagebuilder_styling', 20);

		if ( 'layout-builder' == $sidebar_check ) {
			// Removed Titles for Pagebuilder elements
			remove_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_title' );
			remove_action('ampforwp_design_2_frontpage_title','ampforwp_design_2_frontpage_title');
			remove_action('ampforwp_design_2_frontpage_title','ampforwp_design_2_frontpage_title');
		}
	}	
}

function ampforwp_remove_post_elements($elements) {
	$elements =  array('empty-filter');
	return $elements ;
}

function ampforwp_pagebuilder_styling() { ?>
.amp_cb_module{font-size:14px;line-height:1.5;margin-top:30px;margin-bottom:10px;padding:0 20px;}
.amp_cb_module h4{margin:17px 0 6px 0;}
.amp_cb_module p{margin: 8px 0px 10px 0px;}
.amp_cb_blurb{text-align: center} 
.amp_cb_blurb amp-img{margin:0 auto;}
.flex-grid {display:flex;justify-content: space-between;}
.amp_module_title{text-align: center;font-size: 14px;margin-bottom: 12px;padding-bottom: 4px;text-transform: uppercase;letter-spacing: 1px;border-bottom: 1px solid #f1f1f1;}
.clmn {flex: 1;padding: 5px}
.amp_cb_btn{margin-top: 20px;text-align: center;margin-bottom: 30px;}
.amp_cb_btn a{background: #f92c8b;color: #fff;font-size: 14px;padding: 9px 20px;border-radius: 3px;box-shadow: 1px 1px 4px #ccc;margin:6px;}
.amp_cb_btn .m_btn{font-size: 16px; padding: 10px 20px;}
.amp_cb_btn .l_btn{font-size: 18px; padding: 15px 48px;font-weight:bold;}
@media (max-width: 430px) { .flex-grid {display: block;} }
<?php }


// Add the scripts and style in header
function ampforwp_generate_pagebuilder_data() {
  $sanitized_sidebar     	= "";
  $non_sanitized_sidebar   	= "";
  $sidebar_data 			= array();
    
  ob_start();
	  dynamic_sidebar( 'layout-builder' );
	  $non_sanitized_sidebar = ob_get_contents();
  ob_end_clean();

  $sanitized_sidebar = new AMPFORWP_Content( $non_sanitized_sidebar,
    apply_filters( 'amp_content_embed_handlers', array(
    	  'AMP_Reddit_Embed_Handler' => array(),
          'AMP_Twitter_Embed_Handler' => array(),
          'AMP_YouTube_Embed_Handler' => array(),
          'AMP_Instagram_Embed_Handler' => array(),
          'AMP_Vine_Embed_Handler' => array(),
          'AMP_Facebook_Embed_Handler' => array(),
          'AMP_Gallery_Embed_Handler' => array(),
    ) ),
    apply_filters(  'amp_content_sanitizers', array(
           'AMP_Style_Sanitizer' => array(),
           'AMP_Blacklist_Sanitizer' => array(),
           'AMP_Img_Sanitizer' => array(),
           'AMP_Video_Sanitizer' => array(),
           'AMP_Audio_Sanitizer' => array(),
           'AMP_Iframe_Sanitizer' => array(
             'add_placeholder' => true,
           ),
    )  )
  );

  $sidebar_data['content'] 	= $sanitized_sidebar->get_amp_content();
  $sidebar_data['script'] 	= $sanitized_sidebar->get_amp_scripts();
  $sidebar_data['style'] 	= $sanitized_sidebar->get_amp_styles();
  
  return $sidebar_data;
}

function ampforwp_builder_checker() {
	global $post, $redux_builder_amp;
	$pagebuilder_check 	= '';
	$post_id 			= '';
	$is_legacy_enabled 	= '';
	$is_legacy_enabled  = function_exists('ampforwp_custom_theme_files_register');
	if ( $post ) {
		$post_id = $post->ID;
	}
	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
	}
	if ( $post_id && $is_legacy_enabled ) {
		$pagebuilder_check = get_post_meta( $post_id,'ampforwp_custom_sidebar_select',true); 
	}
	if ( $pagebuilder_check === 'layout-builder' ) {
		return ampforwp_generate_pagebuilder_data(); 
	}
	return;
}

add_filter( 'amp_post_template_data', 'ampforwp_add_pagebuilder_data' );
function ampforwp_add_pagebuilder_data( $data ) {
	$sanitized_data = '';
	$sanitized_data = ampforwp_builder_checker();

	if ( $sanitized_data ) {
		$data[ 'post_amp_content' ] 		= $sanitized_data['content'];
		$data[ 'amp_component_scripts' ] 	= $sanitized_data['script'];
		$data[ 'post_amp_styles' ] 			= $sanitized_data['style'];
	}
	
	return $data; 
}

/**
 * 65. Remove Filters code added through Class by other plugins
 *
 * Allow to remove method for an hook when, it's a class method used and class don't have variable, but you know the class name :)
 * Code from https://github.com/herewithme/wp-filters-extras 
 */
function ampforwp_remove_filters_for_class( $hook_name = '', $class_name ='', $method_name = '', $priority = 0 ) {
	global $wp_filter;
	// Take only filters on right hook name and priority
	if ( !isset($wp_filter[$hook_name][$priority]) || !is_array($wp_filter[$hook_name][$priority]) )
		return false;
	// Loop on filters registered
	foreach( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
		// Test if filter is an array ! (always for class/method)
		if ( isset($filter_array['function']) && is_array($filter_array['function']) ) {
			// Test if object is a class, class and method is equal to param !
			if ( is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && get_class($filter_array['function'][0]) == $class_name && $filter_array['function'][1] == $method_name ) {
			    // Test for WordPress >= 4.7 WP_Hook class (https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/)
			    if( is_a( $wp_filter[$hook_name], 'WP_Hook' ) ) {
			        unset( $wp_filter[$hook_name]->callbacks[$priority][$unique_id] );
			    }
			    else {
				    unset($wp_filter[$hook_name][$priority][$unique_id]);
			    }
			}
		}
	}
	return false;
}

// BuddyPress Compatibility
add_action('amp_init','ampforwp_allow_homepage_bp');
function ampforwp_allow_homepage_bp() {
	add_action( 'wp', 'ampforwp_remove_rel_on_bp' );
}
function ampforwp_remove_rel_on_bp(){	
		if(function_exists('bp_is_activity_component')||function_exists('bp_is_members_component')||function_exists('bp_is_groups_component'))
		{
			if(bp_is_activity_component()|| bp_is_members_component() || bp_is_groups_component()){
				remove_action( 'wp_head', 'amp_frontend_add_canonical');
				remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 ); 
			}
		}
		// Removing AMP from WPForo Forums Pages #592
		if(class_exists('wpForo')){
			global $wpdb,$wpforo;
			$foid = ampforwp_get_the_ID();
			$fid = $wpforo->pageid;
			if($foid==$fid){
				remove_action( 'wp_head', 'amp_frontend_add_canonical');
				remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
			}

		}	
}

// 66. Make AMP compatible with Squirrly SEO
add_action('pre_amp_render_post','ampforwp_remove_sq_seo');
function ampforwp_remove_sq_seo() {
	$ampforwp_sq_google_analytics =  '';
	$ampforwp_sq_amp_analytics    =  '';

	if ( class_exists( 'SQ_Tools' ) ) {
		$ampforwp_sq_google_analytics = SQ_Tools::$options['sq_google_analytics'];
		$ampforwp_sq_amp_analytics    = SQ_Tools::$options['sq_auto_amp'];
	} 

	if ( $ampforwp_sq_google_analytics && $ampforwp_sq_amp_analytics ) {
		remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
	}
}

//67 View Non AMP
function ampforwp_view_nonamp(){
	global $redux_builder_amp, $post, $wp;
  	$nofollow = $page = $amp_url = $non_amp_url = '';
   	if( true == ampforwp_get_setting('ampforwp-nofollow-view-nonamp') ){
   		$nofollow = 'rel=nofollow';
   	}
	$amp_url = ampforwp_amphtml_generator();
	$amp_url = explode('/', $amp_url);
	$amp_url = array_flip($amp_url);
	$endpoint = AMPFORWP_AMP_QUERY_VAR;
	if (ampforwp_get_setting('amp-core-end-point')) {
		 $endpoint = '?'. $endpoint;
	}
	unset($amp_url[$endpoint]);
	$non_amp_url = array_flip($amp_url);
	$non_amp_url = implode('/', $non_amp_url);
	$query_arg_array 	= $wp->query_vars;
	
	if( array_key_exists( "page" , $query_arg_array  ) ) {
		$page = $wp->query_vars['page'];
	}
	if ( $page >= '2') { 
		$non_amp_url = trailingslashit( $non_amp_url  . '?page=' . $page);
	} 

	if ( ampforwp_get_setting('amp-mobile-redirection')==true && ampforwp_get_setting('amp-mob-redirection-pres-link')==false) {
		$non_amp_url = user_trailingslashit($non_amp_url);
		$non_amp_url = add_query_arg('nonamp','1',$non_amp_url);
	}
	else
		$mob_pres_link = false;
		if(function_exists('ampforwp_mobile_redirect_preseve_link')){
		  $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
		}
		$non_amp_url = user_trailingslashit($non_amp_url);
   	if ( true == ampforwp_get_setting('ampforwp-amp-takeover') || $mob_pres_link == true) {
   		$non_amp_url = '';
   	}
   	$permalink = get_option('permalink_structure');
   	if(strpos($permalink, '/%year%/%monthnum%/%day%/%postname%/') !== false){
    	$non_amp_url = get_permalink(ampforwp_get_the_ID());
	}
	if ( $non_amp_url ) { ?><a class="view-non-amp" href="<?php echo esc_url(apply_filters('ampforwp_view_nonamp_url', $non_amp_url) ) ?>" <?php echo esc_attr($nofollow); ?> title="<?php echo ampforwp_get_setting('amp-translator-non-amp-page-text') ?>"><?php if(function_exists('pll__')){echo pll__(esc_html__( ampforwp_get_setting('amp-translator-non-amp-page-text'), 'accelerated-mobile-pages'));}else{echo esc_html__( ampforwp_get_setting('amp-translator-non-amp-page-text'), 'accelerated-mobile-pages');}?></a> <?php }
}

 //68. Facebook Instant Articles
add_action('init', 'ampforwp_fb_instant_article_feed_generator');
 
function ampforwp_fb_instant_article_feed_generator() {
	if( ampforwp_get_setting('fb-instant-article-switch') ) {	
		add_feed('instant_articles', 'ampforwp_fb_instant_article_feed_function');
		add_action( 'ampforwp_fbia_head', 'ampforwp_fbia_meta_tags' );
		require AMPFORWP_PLUGIN_DIR . '/templates/instant-articles/instant-article-sanitizer.php';
	}
}

function ampforwp_fb_instant_article_feed_function() {
	add_filter('pre_option_rss_use_excerpt', '__return_zero');
	load_template( AMPFORWP_PLUGIN_DIR . '/feeds/instant-article-feed.php' );
}

if ( ! function_exists('ampforwp_fbia_meta_tags') ) {
	function ampforwp_fbia_meta_tags(){
		global $redux_builder_amp;
		// undefined index fb-instant-page-id #2610
		$fb_page_id = '';
		$fb_page_id = ampforwp_get_setting('fb-instant-page-id');
		// Page ID meta Tag
		if( $fb_page_id ) { ?>		
			<meta property="fb:pages" content="<?php echo esc_attr( $fb_page_id ); ?>" />
		<?php }
		// undefined index fb-instant-page-id ends here #2610
		$post = get_post();
		// If there's no current post, return
		if ( ! $post ) {
			return;
		}
		$url = get_permalink();
		$url = add_query_arg( 'ia_markup', '1', $url );
		// ia markup meta tag
		if( ampforwp_get_setting('fb-instant-crawler-ingestion') ) { ?>
			<meta property="ia:markup_url" content="<?php echo esc_url( $url ); ?>" />	
		<?php }
	}
}

// 69. Post Pagination #834 #857
function ampforwp_post_pagination( $args = '' ) {

	wp_reset_postdata();
	global $page, $numpages, $multipage, $more, $redux_builder_amp;
	if ( ampforwp_is_front_page() ) {
		$id = ampforwp_get_frontpage_id();
		$content_post = get_post($id);
		$content = $content_post->post_content;
		$checker = preg_match('/<!--nextpage-->/', $content);
		if ( 1 === $checker ) {
			$multipage = $more = 1;
			$ampforwp_new_content = explode('<!--nextpage-->', $content);
			$queried_var = get_query_var('paged');
			if ( $queried_var > 1 ) {
		      $page = $queried_var;
		    }
			$numpages = count($ampforwp_new_content);
		}	
		}else{
		$amp_current_post_id =ampforwp_get_the_ID();
		$amp_custom_content_enable = get_post_meta( $amp_current_post_id , 'ampforwp_custom_content_editor_checkbox', true);
		if($amp_custom_content_enable=='yes'){
			$content 	= get_post_meta ( $amp_current_post_id, 'ampforwp_custom_content_editor', true );
			$content 	= html_entity_decode($content);
			$checker = preg_match('/<!--nextpage-->/', $content);
			if ( 1 === $checker ) {
				$multipage = $more = 1;
				$ampforwp_new_content = explode('<!--nextpage-->', $content);
				$queried_var = get_query_var('paged');
				if ( $queried_var > 1 ) {
			      $page = $queried_var;
			    }
				$numpages = count($ampforwp_new_content);
			}
			}else if(ampforwp_get_setting('ampforwp-pagination-link-type')==true && is_singular() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){
			$id = ampforwp_get_the_ID();
			$content = get_post_field( 'post_content', $id);
			if ($content) {
				$sanitizer_obj = new AMPFORWP_Content( $content,
              apply_filters( 'amp_content_embed_handlers', array(
          				    'AMP_Reddit_Embed_Handler'     => array(),
                      		'AMP_Twitter_Embed_Handler'     => array(),
          				    'AMP_YouTube_Embed_Handler'     => array(),
                  			'AMP_DailyMotion_Embed_Handler' => array(),
                  			'AMP_Vimeo_Embed_Handler'       => array(),
                  			'AMP_SoundCloud_Embed_Handler'  => array(),
          				    'AMP_Instagram_Embed_Handler'   => array(),
          				    'AMP_Vine_Embed_Handler'        => array(),
          				    'AMP_Facebook_Embed_Handler'    => array(),
                  			'AMP_Pinterest_Embed_Handler'   => array(),
          				    'AMP_Gallery_Embed_Handler'     => array(),
                      		'AMP_Playlist_Embed_Handler'    => array(),
             		 ) ),
              apply_filters(  'amp_content_sanitizers', array(
          				    'AMP_Style_Sanitizer'     => array(),
          				    'AMP_Blacklist_Sanitizer' => array(),
          				    'AMP_Img_Sanitizer'       => array(),
          				    'AMP_Video_Sanitizer'     => array(),
          				    'AMP_Audio_Sanitizer'     => array(),
                  			'AMP_Playbuzz_Sanitizer'  => array(),
          				    'AMP_Iframe_Sanitizer'    => array(
          					       'add_placeholder' => true,
          				    ),
              		)  ) );
			$content =  $sanitizer_obj->get_amp_content();
			$checker = preg_match('/<!--nextpage-->/', $content);
			if ( 1 === $checker ) {
				$multipage = $more = 1;
				$ampforwp_new_content = explode('<!--nextpage-->', $content);
				$queried_var = get_query_var('paged');
				if ( $queried_var > 1 ) {
			      $page = $queried_var;
			    }
				$numpages = count($ampforwp_new_content);
			}
			}
			
		}
	}
	$defaults = array(
		'before'           => '<div class="ampforwp_post_pagination" ><p>' . '<span>' .  ampforwp_translation($redux_builder_amp['amp-translator-page-text'], 'Page') . ':</span>',
		'after'            => '</p></div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Next'),
		'previouspagelink' => ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous'),
		'pagelink'         => '%',
		'echo'             => 1
	);

	$params = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments used in retrieving page links for paginated posts.
	 * @param array $params An array of arguments for page links for paginated posts.
	 */
	$r = apply_filters( 'ampforwp_post_pagination_args', $params );
	if ( isset($redux_builder_amp['ampforwp-pagination-select']) && 2 == $redux_builder_amp['ampforwp-pagination-select'] ) {
		$r['next_or_number'] = 'next';
		$r['before'] = '<div class="ampforwp_post_pagination" ><p>';
		$r['after'] = '</p></div>';
	}
	$output = '';
	if ( $multipage ) {
		if ( 'number' == $r['next_or_number'] ) {
			$output .= $r['before'];
			for ( $i = 1; $i <= $numpages; $i++ ) {
				$link = $r['link_before'] . str_replace( '%', '<span>'.$i.'</span>', $r['pagelink'] ) . $r['link_after'];
				if ( $i != $page || ! $more && 1 == $page ) {
					$link = ampforwp_post_paginated_link_generator( $i ) . $link . '</a>';
				}
				/**
				 * Filters the HTML output of individual page number links.
				 * @param string $link The page number HTML output.
				 * @param int    $i    Page number for paginated posts' page links.
				 */
				$link = apply_filters( 'ampforwp_post_pagination_link', $link, $i );

				// Use the custom links separator beginning with the second link.
				$output .= ( 1 === $i ) ? ' ' : $r['separator'];
				$output .= $link;
			}
			$output .= $r['after'];
		} elseif ( $more ) {
			$output .= $r['before'];
			$prev = $page - 1;
			if ( $prev > 0 ) {
				$link = ampforwp_post_paginated_link_generator( $prev ) . $r['link_before'] . $r['previouspagelink'] . $r['link_after'] . '</a>';
				$output .= apply_filters( 'ampforwp_post_pagination_link', $link, $prev );
			}
			$output .= $r['separator'];
			$text = $page . ' of ' . $numpages;
			$output .= apply_filters( 'ampforwp_post_pagination_page', $text, $page, $numpages);
			$next = $page + 1;
			if ( $next <= $numpages ) {
				$output .= $r['separator'];
				$link = ampforwp_post_paginated_link_generator( $next ) . $r['link_before'] . $r['nextpagelink'] . $r['link_after'] . '</a>';
				$output .= apply_filters( 'ampforwp_post_pagination_link', $link, $next );
			}
			$output .= $r['after'];
		}
	}

	/**
	 * Filters the HTML output of page links for paginated posts.
	 * @param string $output HTML output of paginated posts' page links.
	 * @param array  $args   An array of arguments.
	 */
	$html = apply_filters( 'ampforwp_post_pagination', $output, $args );
	if($redux_builder_amp['amp-pagination']) {
		if ( $r['echo'] ) {
			echo $html;
		}
		return $html;
	}	

}

/**
 * Helper function for ampforwp_post_pagination().
 * @access private
 *
 * @global WP_Rewrite $wp_rewrite
 *
 * @param int $i Page number.
 * @return string Link.
 */
function ampforwp_post_paginated_link_generator( $i ) {
	global $wp_rewrite;
	$post = get_post();
	if ( ampforwp_is_front_page() ) {
		$id = ampforwp_get_frontpage_id();
		$post = get_post($id);
	}
	$query_args = array();
	if ( 1 == $i ) {
		$url = get_permalink();
		if(ampforwp_is_front_page()){
			$url = get_home_url();
		}
	} else {
		if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) ) {
			$url = add_query_arg( 'page', $i, get_permalink() );
			if(ampforwp_is_front_page()){
				$url = add_query_arg( 'page', $i, get_home_url() );
			}
		}
		elseif ( ampforwp_is_front_page() )
			$url = trailingslashit(get_home_url()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
		else
			$url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
	}

	if ( is_preview() ) {

		if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
			$query_args['preview_id'] = wp_unslash( $_GET['preview_id'] );
			$query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
		}

		$url = get_preview_post_link( $post, $query_args, $url );

	}
	$mob_pres_link = false;
	if(function_exists('ampforwp_mobile_redirect_preseve_link')){
	    $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	}
	if ( false == ampforwp_get_setting('ampforwp-amp-takeover') && $mob_pres_link == false) {
		if(ampforwp_get_setting('ampforwp-pagination-link-type')==true && is_singular() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){
		 $url = ampforwp_url_controller($url);
		}else{
		 $url = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1',$url);
		}
	}
	return '<a href="' . esc_url( $url ) . '">';
}
// Modify the content to make Pagination work on Pages and FrontPage #2253
add_filter('ampforwp_modify_the_content','ampforwp_post_paginated_content');
function ampforwp_post_paginated_content($content){
	//Embed pinterest images to the amp #4361
	if(preg_match('/<a(.*?)data-pin-do="embedPin"(.*?)href="(.*?)"><\/a>/', $content)){
 		$content = preg_replace('/<a(.*?)data-pin-do="embedPin"(.*?)href="(.*?)"><\/a>/', '<amp-pinterest width="250" height="500" data-do="embedPin" data-url="$3"></amp-pinterest>', $content);
	}
	if ( is_singular() || ampforwp_is_front_page() ){
		global $redux_builder_amp, $page, $multipage;
		$ampforwp_new_content = $ampforwp_the_content = $checker = '';
		if(ampforwp_get_setting('ampforwp-pagination-link-type')==true && is_singular() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){
			if (get_query_var('paged') > 1) {
				$id = ampforwp_get_the_ID();
				$content = get_post_field( 'post_content', $id);
			}
		  if ($content) {
		  	$sanitizer_obj = new AMPFORWP_Content( $content,
              apply_filters( 'amp_content_embed_handlers', array(
          				    'AMP_Reddit_Embed_Handler'     => array(),
                      		'AMP_Twitter_Embed_Handler'     => array(),
          				    'AMP_YouTube_Embed_Handler'     => array(),
                  			'AMP_DailyMotion_Embed_Handler' => array(),
                  			'AMP_Vimeo_Embed_Handler'       => array(),
                  			'AMP_SoundCloud_Embed_Handler'  => array(),
          				    'AMP_Instagram_Embed_Handler'   => array(),
          				    'AMP_Vine_Embed_Handler'        => array(),
          				    'AMP_Facebook_Embed_Handler'    => array(),
                  			'AMP_Pinterest_Embed_Handler'   => array(),
          				    'AMP_Gallery_Embed_Handler'     => array(),
                      		'AMP_Playlist_Embed_Handler'    => array(),
             		 ) ),
              apply_filters(  'amp_content_sanitizers', array(
          				    'AMP_Style_Sanitizer'     => array(),
          				    'AMP_Blacklist_Sanitizer' => array(),
          				    'AMP_Img_Sanitizer'       => array(),
          				    'AMP_Video_Sanitizer'     => array(),
          				    'AMP_Audio_Sanitizer'     => array(),
                  			'AMP_Playbuzz_Sanitizer'  => array(),
          				    'AMP_Iframe_Sanitizer'    => array(
          					       'add_placeholder' => true,
          				    ),
              		)  ) );
			$content =  $sanitizer_obj->get_amp_content();
		  $queried_var = get_query_var('paged');
		  $con = explode("<!--nextpage-->", $content);
		  if($queried_var>=2){
		  	 if(isset($con[$queried_var-1])){
		  	 	$content = $con[$queried_var-1];
		  	 }
		  }
		}
		$ampforwp_the_content = $content;
		$checker = preg_match('/<!--nextpage-->/', $ampforwp_the_content);
		if ( 1 === $checker && true == ampforwp_get_setting('amp-pagination') ) {
			$multipage = 1;		
			$ampforwp_new_content = explode('<!--nextpage-->', $ampforwp_the_content);
		    $queried_var = get_query_var('page');
		    if ( ampforwp_is_front_page() ) {
		    	$queried_var = get_query_var('paged');
		    }
		    if ( $queried_var > 1 ) {
		      $queried_var = $queried_var -1   ;
		    }
		    else {
		    	 $queried_var = 0;
		    }
		    return $ampforwp_new_content[$queried_var];
		}
		else {
			return $ampforwp_the_content;
		}
		  }	  
	}
	return $content;
}

add_filter('ampforwp_modify_rel_canonical','ampforwp_modify_rel_amphtml_paginated_post');
function ampforwp_modify_rel_amphtml_paginated_post($url) {
	if(is_single()){
			$post_paginated_page='';
			$post_paginated_page = get_query_var('page');
			$permalink_structure = '';
			$permalink_structure = get_option('permalink_structure');
			if($post_paginated_page){
				$url = get_permalink();
				if('' == $permalink_structure){
					$new_url = add_query_arg('page',$post_paginated_page,$url);
				}
				else{
					$new_url = trailingslashit($url) . user_trailingslashit($post_paginated_page);
				}

				$new_url = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'1',$new_url);
				return $new_url;
			}
		} 
	return $url;
}

add_action('amp_post_template_head','ampforwp_modify_rel_canonical_paginated_post',9);
function ampforwp_modify_rel_canonical_paginated_post(){
		if(is_single()){
			$post_paginated_page='';
			$post_paginated_page = get_query_var('page');
			if($post_paginated_page && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')){
				remove_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
				add_action('amp_post_template_head','ampforwp_rel_canonical_paginated_post');
			}
		}
}
function ampforwp_rel_canonical_paginated_post(){
		$post_paginated_page='';
		$new_canonical_url = '';
		$permalink_structure = '';
		$permalink_structure = get_option('permalink_structure');
		global $post;
	    $current_post_id = $post->ID;
	    $new_canonical_url = get_permalink($current_post_id);
	    $new_canonical_url = trailingslashit($new_canonical_url);
		$post_paginated_page = get_query_var('page');
		if($post_paginated_page){
			if('' == $permalink_structure){
				$new_canonical_url = add_query_arg('page',$post_paginated_page,$new_canonical_url);
			}
			else{
				$new_canonical_url = $new_canonical_url.$post_paginated_page;
			}
			?>
			<link rel="canonical" href="<?php echo esc_url($new_canonical_url) ?>/" /><?php  } 
}
add_action('ampforwp_after_post_content','ampforwp_post_pagination');

// Generating Canonical Url for Yoast no index pages.
add_filter( 'wpseo_robots_array', 'ampforwp_yoast_no_index_condition_check',20,2);
function ampforwp_yoast_no_index_condition_check($robots,$object){
	global $yoast_data;
	if($robots['index'] == 'noindex'){
	  $yoast_data['canonical'] = $object->model->permalink;
	  add_action( 'amp_post_template_head', 'ampforwp_generate_yoast_no_index_canonical_url' );
	}
	return $robots;
}

function ampforwp_generate_yoast_no_index_canonical_url(){
   global $yoast_data;
	if(isset($yoast_data['canonical'])){ 
		$canonical_url = $yoast_data['canonical'];
			if(ampforwp_is_home() || ampforwp_is_front_page()){
				   $canonical_url = user_trailingslashit(get_home_url());
			} ?>
	   <link rel="canonical" href="<?php echo esc_url($canonical_url) ?>"/>
	<?php }
 }

//  Modified Homepage wrong canonical url generated by yoast
add_action('pre_amp_render_post','ampforwp_modify_yoast_amp_homepage_canonical');
function ampforwp_modify_yoast_amp_homepage_canonical(){
 add_filter('wpseo_canonical','ampforwp_modify_yoast_homepage_canonical_url',20);
}

 function ampforwp_modify_yoast_homepage_canonical_url($canonical_url){
	if(ampforwp_is_home() || ampforwp_is_front_page()){
	  $canonical_url = user_trailingslashit(get_home_url());
	} 
  return esc_url($canonical_url);
 }

// 70. Hide AMP by specific Categories & Tags #872
function ampforwp_posts_to_remove () {
	if(is_category()){
		if(ampforwp_get_setting('ampforwp-archive-support-cat')==false){
			return false;
		}
	}
	if(is_tag()){
		if(ampforwp_get_setting('ampforwp-archive-support-tag')==false){
			return false;
		}
	}
	if(ampforwp_get_setting('hide-amp-categories2')){
		if ( has_category(array_filter(ampforwp_get_setting('hide-amp-categories2'))) ) {
			return true;
		}
	}
	if( ampforwp_get_setting('hide-amp-tags-bulk-option2') )	{
		if ( has_tag(array_filter(ampforwp_get_setting('hide-amp-tags-bulk-option2') )) ) {
			return true;
		}
	}
    return false;
}

// Excluded Categories 
if ( ! function_exists('ampforwp_exclude_archive') ) {
	function ampforwp_exclude_archive($archive = 'cat'){
		global $redux_builder_amp;
		$exclude = array();
		// Categories
		if ( is_array(ampforwp_get_setting('hide-amp-categories2')) && 'cat' == $archive ) {
			$exclude = array_values(array_filter(ampforwp_get_setting('hide-amp-categories2') ) );
			return $exclude;
		}
		// Tags
		if ( is_array(ampforwp_get_setting('hide-amp-tags-bulk-option2')) && 'tag' == $archive ) {
			$exclude = array_values(array_filter(ampforwp_get_setting('hide-amp-tags-bulk-option2')));
			return $exclude;
		}
	}
}

add_filter( 'amp_skip_post', 'ampforwp_cat_specific_skip_amp_post', 10, 3 );
function ampforwp_cat_specific_skip_amp_post( $skip, $post_id, $post ) {
	$skip_this_post = '';
	$skip_this_post = ampforwp_posts_to_remove();
	$skip_this_post = apply_filters( 'ampforwp_skip_category', $skip_this_post );
	wp_reset_postdata();
	if ( $skip_this_post ) {
	  $skip = true;
	  remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
	  // #999 Disable mobile redirection
	  remove_action( 'template_redirect', 'ampforwp_page_template_redirect', 30 );
	}	
	return $skip;
}

// Exclude Posts from Loops based on Hide AMP Bulk Cats and Tags #2375
add_filter('ampforwp_query_args', 'ampforwp_exclude_archive_args');
function ampforwp_exclude_archive_args( $args ) {
	global $redux_builder_amp;
	if ( ampforwp_exclude_archive() ) {
		$args['category__not_in'] = ampforwp_exclude_archive();
	}
	if ( ampforwp_exclude_archive('tag') ) {
		$args['tag__not_in'] = ampforwp_exclude_archive('tag');
	}
	return $args;
}

add_action('pre_amp_render_post', 'ampforwp_home_archive_canonical_setter');
function ampforwp_home_archive_canonical_setter(){
	add_action('amp_post_template_head','ampforwp_rel_canonical_home_archive');

	// Remove the canonical from the homepage if the Yoast 14 and above version is available
		// Except for the homepage
	if( class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration') ) {

		if ( ampforwp_is_home() && 'page' == get_option( 'show_on_front') && empty(get_option( 'page_for_posts')) && !isset($_GET['lang'])) {
			return ;
		}
		if(ampforwp_is_front_page() && 'page' == get_option( 'show_on_front') && empty(get_option( 'page_for_posts')) && !isset($_GET['lang']) && !ampforwp_get_setting('ampforwp-amp-takeover')){
			return ;
		}
		if(is_search()){
			return;
		}
		if(is_tax()){
			return;
		}
		remove_action('amp_post_template_head','ampforwp_rel_canonical_home_archive');
		if(function_exists('wpseo_premium_init') && ! is_singular() ){
			add_action( 'amp_post_template_head', 'AMPforWP\\AMPVendor\\amp_post_template_add_canonical' );
		}
	}
}

function ampforwp_rel_canonical_home_archive(){
	if (function_exists('aioseo_pro_just_activated')) {
	   return;
	}
	global $redux_builder_amp;
	global $wp;
	$current_archive_url 	= '';
	$amp_url				= '';
	$remove					= '';
	$query_arg_array 		= '';
	$page                   = '' ;
	if ( is_home() || is_front_page() || (is_archive() && ampforwp_get_setting('ampforwp-archive-support')) )	{
		$current_archive_url = home_url( $wp->request );
		$amp_url 	= trailingslashit($current_archive_url);
		$amp_url = explode('/', $amp_url);
		$amp_url = array_flip($amp_url);
		if(isset($amp_url['amp'])){
			unset($amp_url['amp']);
		}
		$amp_url = array_flip($amp_url);
		$amp_url  = implode('/', $amp_url);	
	  	$query_arg_array = $wp->query_vars;
	  	if( array_key_exists( "page" , $query_arg_array  ) ) {
		   $page = $wp->query_vars['page'];
	  	}
	  	if ( $page >= '2') { 
			$amp_url = trailingslashit( $amp_url  . '?page=' . $page);
		} ?>
		<link rel="canonical" href="<?php echo user_trailingslashit( esc_url( apply_filters('ampforwp_modify_rel_url', $amp_url ) ) ) ?>">
	<?php }

	if(is_search()){
		$paged = get_query_var( 'paged' );
		$current_search_url = trailingslashit(get_home_url())."?s=".get_search_query();
		$amp_url = untrailingslashit($current_search_url);
		if ($paged > 1 ) {
			global $wp;
			$current_archive_url 	= home_url( $wp->request );
			$amp_url 				= trailingslashit($current_archive_url);
			$remove 				= '/'. AMPFORWP_AMP_QUERY_VAR;
			$amp_url				= str_replace($remove, '', $amp_url) ;
			$amp_url 				= $amp_url ."?s=".get_search_query();
		} 
		?>
		<link rel="canonical" href="<?php echo untrailingslashit( esc_url( apply_filters('ampforwp_modify_rel_url', $amp_url) ) ); ?>">
	<?php
	}
				
}

// 71. Alt tag for thumbnails #1013
function ampforwp_thumbnail_alt(){
	$thumb_id = '';
	$thumb_alt = '';
	$thumb_id = get_post_thumbnail_id();
	$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true) ;
	if($thumb_alt){
		echo ' alt="' . esc_attr($thumb_alt) . '" ';
	}
}

// 72. Blacklist Sanitizer Added back #1024
add_filter('amp_content_sanitizers', 'ampforwp_add_blacklist_sanitizer');
function ampforwp_add_blacklist_sanitizer($data){
	// Blacklist Sanitizer Added back until we find a better solution to replace it 
	$data['AMP_Blacklist_Sanitizer']  = array();
	return $data;
}

//Compatibility with WP User Avatar #975
function ampforwp_get_wp_user_avatar($object='',$type=''){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if(class_exists('WP_User_Avatar_Functions') && defined('PPRESS_VERSION_NUMBER') && version_compare(PPRESS_VERSION_NUMBER,'3.0', '<')){
				$user_avatar_url = '';
				$user_avatar_url = get_wp_user_avatar_src($object);
				return $user_avatar_url;
			}
}
add_filter('get_amp_supported_post_types','ampforwp_supported_post_types');
function ampforwp_supported_post_types($supported_types){
global $redux_builder_amp;
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if( is_plugin_active( 'amp-custom-post-type/amp-custom-post-type.php' ) ) {					
					if ( isset($redux_builder_amp['ampforwp-custom-type']) && $redux_builder_amp['ampforwp-custom-type'] ) {
						foreach($redux_builder_amp['ampforwp-custom-type'] as $custom_post){
							$supported_types[] = $custom_post;
						}
					}
				}	
				if( is_plugin_active( 'amp-woocommerce/amp-woocommerce.php' ) ) {
					if( !in_array("product", $supported_types) ){
						$supported_types[]= 'product';
					}
				}
	return $supported_types;
}
// is_category_amp_disabled #872 & #2549
function is_category_amp_disabled(){
	if(is_archive() && ampforwp_get_setting('ampforwp-archive-support') ){
		if(is_tag() && is_array(ampforwp_get_setting('hide-amp-tags-bulk-option2') ) )	{
			if ( in_array(get_query_var( 'tag_id' ), ampforwp_get_setting('hide-amp-tags-bulk-option2')) ){
				return true;
			}
		}//tags check area closed
		if ( is_category() && is_array(ampforwp_get_setting('hide-amp-categories2')) ) {
			if ( in_array(get_query_var( 'cat' ), ampforwp_get_setting('hide-amp-categories2') ) ){
				return true;
			}
		}
	}
	return false;
}

// 73. View AMP Site below View Site In Dashboard #1076
add_action( 'admin_bar_menu', 'ampforwp_visit_amp_in_admin_bar',999 );
function ampforwp_visit_amp_in_admin_bar($admin_bar) {
	global $redux_builder_amp;
	if ( ampforwp_get_setting('ampforwp-homepage-on-off-support') && false == ampforwp_get_setting('ampforwp-amp-takeover') ) {
		$args = array(
		    'parent' => 'site-name',
		    'id'     => 'view-amp',
		    'title'  => 'Visit AMP',
		    'href'   => ampforwp_url_controller( get_home_url() ),
		    'meta' => array('target' => '_blank')
		);
		$admin_bar->add_node( $args );
	}       
}

// Things to be added in the Body Tag #1064
add_action('ampforwp_body_beginning','ampforwp_body_beginning_html_output',11);
function ampforwp_body_beginning_html_output(){

  	if( ampforwp_get_setting('amp-body-text-area') ) {
    	echo ampforwp_get_setting('amp-body-text-area') ;
  }
}

add_filter('get_amp_supported_post_types','is_amp_post_support_enabled');
function is_amp_post_support_enabled($supportedTypes){
	global $redux_builder_amp;
	if( isset( $redux_builder_amp['amp-on-off-for-all-posts'] ) ) {
		if($redux_builder_amp['amp-on-off-for-all-posts']!='1'){
			$index = array_search('post',$supportedTypes);
			unset($supportedTypes[$index]);
		}elseif($redux_builder_amp['amp-on-off-for-all-posts']==1){
			$supportedTypes[] = 'post';
			$supportedTypes = array_unique($supportedTypes);
		}
	}
	return $supportedTypes;
}

// 74. Featured Image check from Custom Fields
// Moved to functions.php

function ampforwp_cf_featured_image_src($param=""){
global $redux_builder_amp, $post;
	if($redux_builder_amp['ampforwp-custom-fields-featured-image-switch']){
		$post_id 				= '';
		$custom_fields 			= '';
		$featured_image_field 	= '';
		$output 				= '';
		$custom_fields_name 	= array();
		$post_id 				= get_the_ID();
		$custom_fields 			= get_post_custom($post_id);
		foreach ($custom_fields as $key => $value) {
			$custom_fields_name[] = $key;	 
		}
		$featured_image_field = $redux_builder_amp['ampforwp-custom-fields-featured-image'];
		if(in_array($featured_image_field, $custom_fields_name)){
			$amp_img_src = $custom_fields[$featured_image_field][0];
      $image = @getimagesize($amp_img_src);	
			if(empty($image) || $image==false){
				$img_id  	 = attachment_url_to_postid($amp_img_src);
				$imageDetail = wp_get_attachment_image_src( $img_id , 'full');
				$image[0] 	 = $imageDetail[1];
				$image[1] 	 = $imageDetail[2];
			}
			switch ($param) {
				case 'url':
					$output = $amp_img_src;
					break;
				case 'width':
					$output = $image[0];
					break;
				case 'height':
					$output = $image[1];
						break;	
				default:
					$output = $amp_img_src;
					break;
			}
			return $output;
		}
	}
}

// 75. Dev Mode in AMP
add_action('amp_init','ampforwp_dev_mode');
function ampforwp_dev_mode(){
	global $redux_builder_amp;
	if(isset($redux_builder_amp['ampforwp-development-mode']) && $redux_builder_amp['ampforwp-development-mode']){
		add_action( 'wp', 'ampforwp_dev_mode_remove_amphtml' );		
		add_action( 'amp_post_template_head', 'ampforwp_dev_mode_add_noindex' );		
	}
}
// Remove amphtml from non-AMP
function ampforwp_dev_mode_remove_amphtml(){
	remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
}
// Add noindex,nofollow in the AMP
if ( ! function_exists('ampforwp_dev_mode_add_noindex') ) {
	function ampforwp_dev_mode_add_noindex() {
		global $redux_builder_amp;
		if ( isset( $redux_builder_amp['amp-inspection-tool'] ) && false == $redux_builder_amp['amp-inspection-tool'] ){ 
			echo '<meta name="robots" content="noindex,nofollow"/>';
		}
	}
}
 
// 76. Body Class for AMP pages
if (! function_exists( 'ampforwp_body_class' ) ) {
	function ampforwp_body_class( $class = '' ) {
	    // Separates classes with a single space, collates classes for body element
	    echo 'class="' . esc_attr(join( ' ', ampforwp_get_body_class( $class ) )) . '"';
	}
}

if (! function_exists( 'ampforwp_get_body_class' ) ) {
	function ampforwp_get_body_class( $class = '' ){
		global $wp_query, $redux_builder_amp, $post;
	 
	    $classes = array();
		$post_id = '';
		$post_type = '';

		$classes[] = 'body';

		if ( is_singular() ) {
			$post_id = $post->ID;
			$classes[] = 'single-post';
		}

		if ( ampforwp_is_front_page() ) {
	    	$post_id = ampforwp_get_frontpage_id();
		}

		if ( ampforwp_is_front_page() ) {
			$classes[] = 'amp-frontpage';
		}

		if(true == ampforwp_get_setting('amp-rtl-select-option')){
			$classes[] = 'rtl';
		}
	    $classes[] = $post_id;

	    if ( $post_id ) {
	    	$classes[] = 'post-id-' . $post_id;
	    	$classes[] = 'singular-' . $post_id;
	    }

	    if ( is_page() ) {
	    	$classes[] = 'amp-single-page';
	    }
	    
 
		if ( is_post_type_archive() ) {
			$post_type = get_queried_object();
			$classes[] = 'type-'. $post_type->rewrite['slug'];
		}
 
		if ( is_archive() ) {
			$page_id 	= get_queried_object_id();
			$classes[] 	= 'archives_body archive-'. $page_id;
		}

		if ( ! empty( $class ) ) {
		    if ( !is_array( $class ) )
		        $class = preg_split( '#\s+#', $class );
		    $classes = array_merge( $classes, $class );
		} else {
		    // Ensure that we always coerce class to being an array.
		    $class = array();
		}
		if(is_tax()){
			$term = get_queried_object();
			if ( isset( $term->term_id ) ) {
				$term_class = sanitize_html_class( $term->slug, $term->term_id );
				if ( is_numeric( $term_class ) || ! trim( $term_class, '-' ) ) {
					$term_class = $term->term_id;
				}
				$classes[] = 'tax-' . sanitize_html_class( $term->taxonomy );
				$classes[] = 'term-' . $term_class;
				$classes[] = 'term-' . $term->term_id;
			}
		}else{
			$classes[] = get_post_type();
		}
		$classes[] = AMPFORWP_VERSION;
		$classes = array_map( 'esc_attr', $classes );
	    $classes = apply_filters( 'ampforwp_body_class', $classes, $class );
	 
	    return array_unique( $classes );
	}

}

// Fallback for ticket #1006
function ampforwp_the_body_class(){ return ;}

// 77. AMP Blog Details
// Moved to functions.php

// 78. Saved Custom Post Types for AMP in Options for Structured Data
add_action("redux/options/redux_builder_amp/saved",'ampforwp_save_custom_post_types_sd', 10, 1);
if(! function_exists('ampforwp_save_custom_post_types_sd') ) {
	function ampforwp_save_custom_post_types_sd( $redux_builder_amp ){
		global $redux_builder_amp;
		$post_types 		= array();
		$saved_custom_posts = array();
		$count_current_pt 	= "";
		$count_saved_pt 	= "";
		$array_1 			= "";
		$array_2 			= "";

		$saved_custom_posts = get_option('ampforwp_custom_post_types');
		$post_types = ampforwp_get_all_post_types();

		
		if (empty($post_types)) {
			$post_types = array();
		}

		if (empty($saved_custom_posts)) {
			update_option('ampforwp_custom_post_types',  $post_types);
		}
 		if ( empty( $saved_custom_posts ) ) {
			$saved_custom_posts = array();
 		}

 		$count_current_pt = count( $post_types );
		$count_saved_pt =  count( $saved_custom_posts );

		if ( $count_current_pt > $count_saved_pt) {
			
			$array_1 = $post_types;
			$array_2 = $saved_custom_posts;
		} else {
			$array_1 = $saved_custom_posts;
			$array_2 = $post_types;
		}

		if( array_diff( $array_1, $array_2 ) ){	
			update_option('ampforwp_custom_post_types',  $post_types);
		}

	}
}

// 79. Favicon for AMP
add_action('amp_post_template_head','wp_site_icon');

// 81. Duplicate Featured Image Support
add_filter('ampforwp_allow_featured_image', 'ampforwp_enable_post_and_featured_image');
function ampforwp_enable_post_and_featured_image($show_image){
	global $redux_builder_amp;

	if ( isset($redux_builder_amp['ampforwp-duplicate-featured-image']) && $redux_builder_amp['ampforwp-duplicate-featured-image'] == 1  ) {
		$show_image = true;	 
	}

	return $show_image; 
}

// 82. Grab Featured Image from The Content
function ampforwp_get_featured_image_from_content( $featured_image = "", $size="") {
	if(get_the_post_thumbnail_url()){
		return;
	}
	global $post, $posts;
	$image_url = $image_width = $image_height = $output = $matches = $output_fig = $amp_html_sanitizer = $amp_html = $image_html = $featured_image_output = $matches_fig = $figure = $output_fig_image = $matches_fig_img = '';
	ob_start();
	ob_end_clean();
	// Match all the images from the content
	if(is_object($post)){
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*.+width=[\'"]([^\'"]+)[\'"].*.+height=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

		// Match all the figure tags from the content
		$output_fig = preg_match_all('/\[caption.+id=[\'"]([^\'"]+).*]/i', $post->post_content, $matches_fig);
		if ( $output_fig && $matches_fig[0][0] ) {
			$output_fig_image = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*.+width=[\'"]([^\'"]+)[\'"].*.+height=[\'"]([^\'"]+)[\'"].*>(.*)\[/i', $matches_fig[0][0], $matches_fig_img);
			// Check if the first image is inside the figure and it got caption
			if ( $matches_fig_img[1][0] == $matches[1][0] && $matches_fig_img[4][0]) {
				$figure = true;
			}
		}
	}
	//Grab the First Image
	if ((is_array($matches) && $matches[0]) || $output==0 ) {
		if($output==1){
			$image_url 		= $matches[1][0];
			$image_html 	= $matches[0][0];
			$image_width 	= $matches[2][0];
			$image_height 	= $matches[3][0];
		}
		if($output==0){
			if(preg_match('/<figure\sclass="(.*?)">(<img\ssrc="(.*?)"(.*?)>)<\/figure>/', $post->post_content, $fm)){
				if(isset( $fm[2])){
					$dom = new DOMDocument();
					preg_match('/<img\ssrc="(.*?)"(.*?)>/', $fm[2],$fmatch);
					if(isset($fmatch[0])){
						$image_html = $fmatch[0];
					    $dom->loadHTML($image_html);
					    $x = new DOMXPath($dom);
					    foreach($x->query("//img") as $node){   
					        $node->setAttribute("width","1366");
					        $node->setAttribute("height","600");
					    }
					    $image_html = $dom->saveHtml();
					    preg_match_all('/<img\ssrc="(.*?)">/', $image_html, $fimg);
					    if(isset($fimg[0][0])){
					       $image_html ='<figure class="'.esc_attr($fm[1]).'">'.$fimg[0][0].'</figure>';
						   if(isset($fmatch[1])){
							    $image_url 		= $fmatch[1];
								$image_width 	= 1366;
								$image_height 	= 600;
							}
					    }
					}
				}
				}else{
				preg_match_all('/<img(.*?)src=[\'"]([^\'"]+)[\'"].*.>/i', $post->post_content, $matches);
				if(isset($matches[2][0])){
					$image_html 	= $matches[0][0];
					$image_url 		= $matches[2][0];
					$image_width 	= 1366;
					$image_height 	= 600;
				}
			}
		}
		// Sanitize it
		$amp_html_sanitizer = new AMPFORWP_Content( $image_html, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array() ) ) );
	    $amp_html =  $amp_html_sanitizer->get_amp_content();
	    // If its figure then add the figcaption inside the figure
	    if ( $figure ) {
	   		$amp_html = $amp_html . '<figcaption class="wp-caption-text">' . esc_attr($matches_fig_img[4][0]) . '</figcaption>';
	   	}
	    // Filter to remove that image from the content
	    add_filter('ampforwp_modify_the_content','featured_image_content_filter');
	
		if ( isset( $size ) && '' !== $size) {
			$image_id = attachment_url_to_postid( $image_url );
			if ($image_id) {
				$image_array = wp_get_attachment_image_src($image_id, $size, true);
				$image_url = $image_array[0];
				$image_width = $image_array[1];
				$image_height = $image_array[2]; 
			}
		}
	}
	switch ($featured_image) {
			case 'image':
				$featured_image_output = $amp_html;
			break;
			case 'url':
				$featured_image_output = $image_url;
			break;
			case 'width':
				$featured_image_output = $image_width;
			break;
			case 'height':
				$featured_image_output = $image_height;
			break;
			default:
				$featured_image_output = $amp_html;
			break;
		}	
	return $featured_image_output;
}
// Remove 1st image from the content if Featured image from the content option is enabled
if( ! function_exists( 'featured_image_content_filter' ) ){
	function featured_image_content_filter($content){
		global $redux_builder_amp;
		$featured_image = "";
		$featured_image = ampforwp_get_featured_image_from_content('url');
		if( $featured_image && false == $redux_builder_amp['ampforwp-duplicate-featured-image']){
			// Change the src to use it in the pattern
			$featured_image = str_replace('/', '\/', $featured_image);
			// Remove the figure (due to caption)
			$content = preg_replace('/<figure(.*)src="'.$featured_image.'"(.*?)<\/figure>/', '', $content);
			// Remove the amp-img 
		  if(false == has_post_thumbnail()){
			$content = preg_replace('/<amp-img(.*)src="'.$featured_image.'"(.*?)<\/amp-img>/', '', $content);
		  }
		}
	return $content;
	}
}



// 84. Inline Related Posts

function ampforwp_inline_related_posts(){
	global $post, $redux_builder_amp;
		$string_number_of_related_posts = $redux_builder_amp['ampforwp-number-of-inline-related-posts'];		
		$int_number_of_related_posts = round(abs(floatval($string_number_of_related_posts)));

		// declaring this variable here to prevent debug errors
		$args = null;
		$orderby = 'ID';
		if( isset( $redux_builder_amp['ampforwp-inline-related-posts-order'] ) && $redux_builder_amp['ampforwp-inline-related-posts-order'] ){
			$orderby = 'rand';
		}

		// Custom Post types 
       if( $current_post_type = get_post_type( $post )) {
                // The query arguments
       		//#1263
       		if($current_post_type != 'page'){
                $args = array(
                    'posts_per_page'=> $int_number_of_related_posts,
                    'order' => 'DESC',
                    'orderby' => $orderby,
                    'post_type' => $current_post_type,
                    'no_found_rows'  => true,
                    'post__not_in' => array( $post->ID )

                );  
            } 			
		}//end of block for custom Post types

		if($redux_builder_amp['ampforwp-inline-related-posts-type']==2){
		    $categories = get_the_category($post->ID);
					if ($categories) {
							$category_ids = array();
							foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
							$args=array(
							    'category__in' => $category_ids,
							    'post__not_in' => array($post->ID),
							    'posts_per_page'=> $int_number_of_related_posts,
							    'ignore_sticky_posts'=>1,
								'has_password' => false ,
								'post_status'=> 'publish',
								'no_found_rows'  => true,
								'orderby'    => $orderby
							);
						}
			} //end of block for categories
			//code block for tags
		 if($redux_builder_amp['ampforwp-inline-related-posts-type']==1) {
					$ampforwp_tags = get_the_tags($post->ID);
						if ($ampforwp_tags) {
										$tag_ids = array();
										foreach($ampforwp_tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
										$args=array(
										   'tag__in' => $tag_ids,
										    'post__not_in' => array($post->ID),
										    'posts_per_page'=> $int_number_of_related_posts,
										    'ignore_sticky_posts'=>1,
											'has_password' => false ,
											'post_status'=> 'publish',
											'no_found_rows' 	  => true,
											'orderby'    => $orderby
										);
					}
			}//end of block for tags
			if(true == ampforwp_get_setting('ampforwp-in-content-related-posts-days-switch')){
            $date_range = strtotime ( '-' . ampforwp_get_setting('ampforwp-in-content-related-posts-days-text') .' day' );
            $args['date_query'] = array(
                                    array(
                                        'after' => array(
                                            'year'  => date('Y', esc_html($date_range) ),
                                            'month' => date('m', esc_html($date_range) ),
                                            'day'   => date('d', esc_html($date_range)),
                                            ),
                                        )
                                    );  
            } 
            $args = apply_filters('ampforwp_inlne_related_posts_query_args', $args);
            $inline_related_posts = '';
			$my_query = new wp_query( $args );
					if( $my_query->have_posts() ) {
				$inline_related_posts_img = '';
				$inline_related_posts = '<div class="amp-wp-content relatedpost">
						    <div class="rp">
							<span class="related-title">'.esc_html(ampforwp_translation( ampforwp_get_setting('amp-translator-incontent-related-text'), 'Related Post' )).'</span>
							<ol class="clearfix">';			
				    while( $my_query->have_posts() ) {
					    $my_query->the_post();
						$related_post_permalink = get_permalink();
						$related_post_permalink = trailingslashit($related_post_permalink);
						$related_post_permalink = ampforwp_url_controller( $related_post_permalink );
						$related_post_permalink = ampforwp_modify_url_utm_params($related_post_permalink);
						if ( ampforwp_has_post_thumbnail() ) {
							$title_class = 'has_related_thumbnail';
						} else {
							$title_class = 'no_related_thumbnail'; 
						}
						$inline_related_posts .= '<li class="'.esc_attr($title_class).'">';
						if ( true == $redux_builder_amp['ampforwp-single-related-posts-image'] ) {
                            $inline_related_posts .= '<a href="'.esc_url( $related_post_permalink ).'" rel="bookmark" title="'.esc_attr(get_the_title()).'">';
			          
			           		$thumb_url_2 = ampforwp_get_post_thumbnail('url');
			            
							if ( ampforwp_has_post_thumbnail() ) {
								if( 4 == $redux_builder_amp['amp-design-selector'] ){
									$r_width = 220;
									$r_height = 134;
									if(function_exists('ampforwp_get_retina_image_settings')){
										$ret_config = ampforwp_get_retina_image_settings($r_width,$r_height);
										$r_width  = intval($ret_config['width']);
										$r_height = intval($ret_config['height']);
									}
									$thumb_url_2 = ampforwp_aq_resize( $thumb_url_2, $r_width , $r_height , true, false, true );
									$inline_related_posts_img  = '<amp-img src="'.esc_url( $thumb_url_2[0] ).'" width="' . esc_attr($thumb_url_2[1]) . '" height="' . esc_attr($thumb_url_2[2]) . '" layout="responsive"></amp-img>';
									if(!isset($thumb_url_2[0]) && is_null($thumb_url_2[0]) || wp_check_filetype(ampforwp_get_post_thumbnail('url') == 'svg')){
										$thumb_url = ampforwp_get_post_thumbnail('url');
										$inline_related_posts_img = '<amp-img src="'.esc_url( $thumb_url ).'" width="' . esc_attr(220) . '" height="' . esc_attr(134) . '" layout="responsive"></amp-img>';
									}
								}
								else{
									$r_width = 150;
									$r_height = 150;
									if(function_exists('ampforwp_get_retina_image_settings')){
										$ret_config = ampforwp_get_retina_image_settings($r_width,$r_height);
										$r_width = intval($ret_config['width']);
										$r_height = intval($ret_config['height']);
									}
									$thumb_url_2 = ampforwp_aq_resize( $thumb_url_2, $r_width , $r_height , true, false,true );
									$thumb_url 		= $thumb_url_2[0];
									$thumb_width 	= $thumb_url_2[1];
									$thumb_height 	= $thumb_url_2[2];
									$inline_related_posts_img = '<amp-img src="'.esc_url( $thumb_url ).'" width="'.esc_attr($thumb_width).'" height="'.esc_attr($thumb_height).'" layout="responsive" ></amp-img>';
									if(!isset($thumb_url_2[0]) && is_null($thumb_url_2[0]) || wp_check_filetype(ampforwp_get_post_thumbnail('url') == 'svg')){
										$thumb_url = ampforwp_get_post_thumbnail('url');
										$inline_related_posts_img = '<amp-img src="'.esc_url( $thumb_url ).'" width="' . esc_attr(150) . '" height="' . esc_attr(150) . '" layout="responsive"></amp-img>';
									}
								}
								$inline_related_posts_img = apply_filters("ampforwp_modify_inline_rp_loop_image",$inline_related_posts_img);
								$inline_related_posts .= $inline_related_posts_img;
							} 
							$inline_related_posts .='</a>';
						}
						$inline_related_posts .='<div class="related_link">';
						$inline_related_posts .='<a href="'.esc_url( $related_post_permalink ).'">'.get_the_title().'</a>';
	                    if(ampforwp_get_setting('ampforwp-incontent-related-posts-excerpt')==1){
	                       if( has_excerpt() ){
	                       $content ='<p>'.get_the_excerpt().'</p>';
	                       }else{
	                       $content ='<p>'.get_the_content().'</p>';
	                       }
	                       $inline_related_posts .= '<p>'. wp_trim_words( strip_shortcodes( $content ) , 15 ).'</p>';
	                        }
            			   $inline_related_posts .= '</div>
       			 	</li>';									
					}					     
				$inline_related_posts .= '</ol>
						    </div>
						</div>';
					}
	      wp_reset_postdata();
	      return $inline_related_posts;
//related posts code ends here
}

add_action('pre_amp_render_post','ampforwp_add_inline_related_posts');
function ampforwp_add_inline_related_posts(){
	global $redux_builder_amp;
	if($redux_builder_amp['ampforwp-inline-related-posts'] == 1 && is_single() && ampforwp_inline_related_posts() ){
		if( isset($redux_builder_amp['ampforwp-inline-related-posts-display-type']) && $redux_builder_amp['ampforwp-inline-related-posts-display-type']=='middle' ){
			add_filter('ampforwp_modify_the_content','ampforwp_generate_inline_related_posts');
		}else{
			add_filter('ampforwp_modify_the_content','ampforwp_generate_inline_related_posts_by_paragraph');
		}
		
	}
}
function ampforwp_generate_inline_related_posts($content){
	global $post;
		
	$break_point = '</p>';
	$content_parts = explode($break_point, $content);
	array_walk($content_parts, function(&$value, $key) {
		 	$value = trim($value);
			if( !empty($value) && (strpos($value, "<p>")!==false || strpos($value, "<blockquote>")!==false)){
			         $value .= '</p>';
			         $value .= '</blockquote>';
			}
		}
	);
	if(count($content_parts)>1){
		$no_of_parts = count($content_parts);
		$half_index = floor($no_of_parts / 2);
		$half_content = array_chunk($content_parts, $half_index);
		
		$html ='<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';
		$half_content[0][] = $html;
		$final_content ='';
		foreach ($half_content as $key => $value) {
			$final_content .= implode("", $value);
		}
		$content = $final_content;
	}
	return $content;
}

function  ampforwp_generate_inline_related_posts_by_paragraph($content){
	global $redux_builder_amp;
	$total_count = '';
	$int_number_of_paragraphs = (integer) ampforwp_get_setting('ampforwp-related-posts-after-number-of-paragraphs'); 

	if(isset($int_number_of_paragraphs) && $int_number_of_paragraphs!=''){
		if($int_number_of_paragraphs == 0){
			$content = '<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>'.$content;
		}else{
			$total_count = explode("</p>", $content);
    		$total_count = count($total_count); // call count() only once, it's faster
    		if($total_count < $int_number_of_paragraphs){
    			$content = $content.'<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';
    		}else{
    			$content = preg_replace_callback('#(<p>.*?</p>)#', 'ampforwp_add_related_post_after_paragraph', $content);
    		}
			
		}
	}else{
		$content = $content.'<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';
	}
	
	return $content;
}

function ampforwp_add_related_post_after_paragraph($matches)
{
	global $redux_builder_amp;
	static $count = 0;
	$ret = '';
	$int_number_of_paragraphs = (integer) ampforwp_get_setting('ampforwp-related-posts-after-number-of-paragraphs');
	
  		$ret = $matches[1];

	  	if (++$count == $int_number_of_paragraphs){
	  		$ret .= '<div class="ampforwp-inline-related-post">'.ampforwp_inline_related_posts().'</div>';

	  	}
    
  return $ret;
}

// 85. Caption for Gallery Images
// Add extra key=>value pair into the attachment array
add_filter('amp_gallery_image_params','ampforwp_gallery_new_params', 10, 2);
function ampforwp_gallery_new_params($urls, $attachment_id ){
	$img_caption = $captext = '';
	$new_urls 	 = $caption = array();
	if(isset($urls['caption']) && $urls['caption'] ){
		$img_caption = $urls['caption'];
	}
	$captext = $img_caption;
	if($captext==""){
		$captext = get_post( $attachment_id)->post_excerpt;
	}
	if($captext){
		// Append only when caption is present
		$caption = array('caption'=>$captext);
		$new_urls = array_merge($urls,$caption);
		return $new_urls;
	}
	else{
		//If there's No caption
		return $urls;	
	}
}

if( !function_exists( 'ampforwp_carousel_class_magic' ) ){
	function ampforwp_carousel_class_magic($content){
		$content = str_replace(array(':openbrack:',':closebrack:'), array('[',']'), $content);
	return $content;
	}
}
// 86. minify the content of pages
// Moved to performance-functions.php

// 87. Post Thumbnail
// Checker for Post Thumbnail
if( !function_exists('ampforwp_has_post_thumbnail')){
	function ampforwp_has_post_thumbnail(){
		global $post, $redux_builder_amp;
		if(class_exists('Bunyad') && Bunyad::posts()->meta('featured_video') ){
 			return true;
		}elseif(function_exists('has_post_video') && has_post_video($post->ID)){
			return true;
		}elseif(has_post_thumbnail()){
			return true;
		}
		elseif(ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src()){
			return true;
		}
		elseif(isset($redux_builder_amp['ampforwp-featured-image-from-content']) && $redux_builder_amp['ampforwp-featured-image-from-content'] == true){
			if( ampforwp_get_featured_image_from_content() || ampforwp_get_featured_image_from_content('url') ){				
				return true;
			}
		}
		else
			return false;
	}
}
// Get Post Thumbnail URL
if( !function_exists('ampforwp_get_post_thumbnail')){
	function ampforwp_get_post_thumbnail($param="", $size=""){
		global $post, $redux_builder_amp;
		$thumb_url 		= '';
		$thumb_width 	= '';
		$thumb_height 	= '';
		$output 		= '';
		if ( has_post_thumbnail()) {
			if( empty($size) ) {
				$size = 'medium';
			} 
			$thumb_id 			= get_post_thumbnail_id();
			$thumb_url_array 	= wp_get_attachment_image_src($thumb_id, $size , true);
			$thumb_url 			= $thumb_url_array[0];
			$thumb_width 		= $thumb_url_array[1];
			$thumb_height 		= $thumb_url_array[2];
			$thumb_alt = '';
			$thumb_alt = get_post_meta ( $thumb_id, '_wp_attachment_image_alt', true );
		}
		if(ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src()){
			$thumb_url 		= ampforwp_cf_featured_image_src();
			$thumb_width 	= ampforwp_cf_featured_image_src('width');
			$thumb_height 	= ampforwp_cf_featured_image_src('height');
		}
		if( true == $redux_builder_amp['ampforwp-featured-image-from-content'] && ampforwp_get_featured_image_from_content('url') ){
			$thumb_url 		= ampforwp_get_featured_image_from_content('url', $size);
			$thumb_width 	= ampforwp_get_featured_image_from_content('width', $size);
			$thumb_height 	= ampforwp_get_featured_image_from_content('height', $size);
		}
		switch ($param) {
			case 'url':
				$output = $thumb_url;
				break;
			case 'width':
				$output = $thumb_width;
				break;
			case 'height':
				$output = $thumb_height;
				break;	
			case 'alt':
				$output = $thumb_alt;
				break;	
			default:
				$output = $thumb_url;
				break;
		}
		return $output;
	}	
}

// 88. Author Details
// Author Page URL
if( ! function_exists( 'ampforwp_get_author_page_url' ) ){
	function ampforwp_get_author_page_url(){
		global $redux_builder_amp, $post;
		$author_id = '';
		$author_page_url = '';
		$author_id = get_the_author_meta( 'ID' );
		$author_page_url = get_author_posts_url( $author_id );
		// If Archive support is enabled
		if(  isset($redux_builder_amp['ampforwp-archive-support'] ) && $redux_builder_amp['ampforwp-archive-support'] ){
    		$author_page_url = ampforwp_url_controller( $author_page_url  );
    	}
		return $author_page_url;
	}
}
// Author Meta
if( ! function_exists( 'ampforwp_get_author_details' ) ){
	function ampforwp_get_author_details( $post_author , $params='' ){
		global $redux_builder_amp, $post;
		$post_author_url = '';
		$post_author_name = '';
		$post_author_name = $post_author->display_name;
		$post_author_url = ampforwp_get_author_page_url();
		$and_text = '';
		$and_text = ampforwp_translation($redux_builder_amp['amp-translator-and-text'], 'and' );
		if ( function_exists('coauthors') ) { 
			$post_author_name = coauthors($and_text,$and_text,null,null,false);
		}
		if ( function_exists('coauthors_posts_links') ) {
			$post_author_url = coauthors_posts_links($and_text,$and_text,null,null,false);
		}
		switch ($params) {
			case 'meta-info':
				if( isset($redux_builder_amp['ampforwp-author-page-url']) && $redux_builder_amp['ampforwp-author-page-url'] ) {
					if ( function_exists('coauthors_posts_links') ) {
						return '<span class="amp-wp-author author vcard">'. $post_author_url .'</span>';
					}
					return	'<span class="amp-wp-author author vcard"><a href="'.esc_url($post_author_url).'"  title="'.esc_html( $post_author_name ).'" >'.esc_html( $post_author_name ).'</a></span>';
 				}
				else { 
					return '<span class="amp-wp-author author vcard">' .esc_html( $post_author_name ).'</span>';
				 } 
				break;

			case 'meta-taxonomy':
				if( isset($redux_builder_amp['ampforwp-author-page-url']) && $redux_builder_amp['ampforwp-author-page-url'] ) { 
					if ( function_exists('coauthors_posts_links') ) {
						return	$post_author_url;
					}
	                return	'<a href="' . esc_url($post_author_url) . ' "><strong>' . esc_html( $post_author_name ) . '</strong></a>: '; 
	                 }
                	else{ 
                		return '<strong> ' . esc_html( $post_author_name) . '</strong>: ';
                	}
				break;
		}
	}
}

// 89. Facebook Pixel
// Moved to analytics-functions.php

// 91. Comment Author Gravatar URL
if( ! function_exists('ampforwp_get_comments_gravatar') ){
	function ampforwp_get_comments_gravatar( $comment ) {
		global $redux_builder_amp;
		if(isset($redux_builder_amp['ampforwp-display-avatar']) && $redux_builder_amp['ampforwp-display-avatar']==0){
			return '';
		}
		if (class_exists('FV_Gravatar_Cache')) {
			$options = get_option('fv_gravatar_cache');
			$size = $options['size'];
			if (empty($size)) {
				$size = '96';
			}
			$avatar_url = get_avatar_url($comment);
			$upload_dir = wp_upload_dir(); 
			$upload_dir = $upload_dir['baseurl'] . '/fv-gravatar-cache/';
			$avatar_url = preg_replace('/(.*?)avatar\/(.*?)\?s=(.*?)&(.*?)g/', ''.$upload_dir.'$2x$3.png', $avatar_url);
			preg_match_all('/(.*?)wp-content\/uploads\/fv-gravatar-cache\/(.*?)/U', $avatar_url, $match);
			$url = $match[0][0];
			$headers = get_headers($url, 1);
			if(isset($headers[0]) && !stripos($headers[0], "200 OK")){
			   $avatar_url = $upload_dir.'mystery'. esc_html($size) .'.png';
			}
			return $avatar_url;
		}
	$gravatar_exists = '';
	$gravatar_exists = ampforwp_gravatar_checker($comment->comment_author_email);
	if ( null !== ampforwp_get_wp_user_avatar($comment, 'comment') ) {
		return ampforwp_get_wp_user_avatar($comment, 'comment');
	}
	elseif($gravatar_exists == true){
		return get_avatar_url( $comment, apply_filters( 'ampforwp_get_comments_gravatar', '60' ), '' );
	}
	else
		return apply_filters( 'ampforwp_get_comments_gravatar', '' );   	
	}
}
// Gravatar Checker
if ( ! function_exists('ampforwp_gravatar_checker') ) {
	function ampforwp_gravatar_checker( $email ) {
		$uri = "";
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		$gravatar_server = 0;
		if ( $hash ) {
			$gravatar_server = hexdec( $hash[0] ) % 3;
		} else {
			$gravatar_server = rand( 0, 2 );
		}
		if ( is_ssl() ) {
			$uri = 'https://secure.gravatar.com/avatar/' . $hash;
		} else {
			$uri = sprintf( 'http://%d.gravatar.com/avatar/%s', $gravatar_server, $hash );
		}
		if($uri){
		$response = wp_remote_get(esc_url_raw($uri));
 		$response_code = wp_remote_retrieve_response_code($response);
 		}
		//If its 404
		if ($response_code!=200) {
		 	$has_valid_avatar = FALSE;
		}else {
		 	$has_valid_avatar = TRUE;
	 	}
		return $has_valid_avatar;
	}
}
function ampfowp_add_extra_css(){
    echo '<style>
    #wp-admin-bar-ampforwp-view-amp a{
    background:url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjMxNHB4IiBoZWlnaHQ9IjMxNXB4IiB2aWV3Qm94PSIwIDAgMzE0IDMxNSIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KICAgIDwhLS0gR2VuZXJhdG9yOiBTa2V0Y2ggNDEgKDM1MzI2KSAtIGh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaCAtLT4KICAgIDx0aXRsZT5TaGFwZTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPjwvZGVmcz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSIjODI4NzhjIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSIyNjA3MSIgZmlsbD0iIzgyODc4YyI+CiAgICAgICAgICAgIDxnIGlkPSJDYXBhXzEiPgogICAgICAgICAgICAgICAgPGcgaWQ9Il94MzJfNDAuX1Bvd2VyIj4KICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMTU3LjAwNywwIEM3MC4yOTIsMCAwLDcwLjI5MiAwLDE1Ny4wMDcgQzAsMjQzLjcxNSA3MC4yOTIsMzE0LjAxNCAxNTcuMDA3LDMxNC4wMTQgQzI0My43MTYsMzE0LjAxNCAzMTQuMDE0LDI0My43MTUgMzE0LjAxNCwxNTcuMDA3IEMzMTQuMDE0LDcwLjI5MiAyNDMuNzE2LDAgMTU3LjAwNywwIFogTTE1Ny4wMDcsMjgyLjYxMiBDODcuNjM0LDI4Mi42MTIgMzEuNDAyLDIyNi4zNzIgMzEuNDAyLDE1Ny4wMDcgQzMxLjQwMiw4Ny42MzQgODcuNjM0LDMxLjQwMiAxNTcuMDA3LDMxLjQwMiBDMjI2LjM3MSwzMS40MDIgMjgyLjYxMSw4Ny42MzQgMjgyLjYxMSwxNTcuMDA3IEMyODIuNjEyLDIyNi4zNzIgMjI2LjM3MiwyODIuNjEyIDE1Ny4wMDcsMjgyLjYxMiBaIE0yMDQuMTExLDE0MS4zNjggTDE2My40NzksMTQxLjUzMyBDMTU5LjEzOSwxNDEuNTUzIDE1Ny41NDQsMTM4LjYyMyAxNTkuOTA1LDEzNC45NzkgTDIwMy4zOTcsNjguMTA5IEMyMDguMTI2LDYwLjg0MSAyMDYuOTg0LDU5LjkyMiAyMDAuODYxLDY2LjA1MyBMMTA1LjMwNSwxNjEuNiBDOTkuMTcyLDE2Ny43MzIgMTAxLjIzMiwxNzIuNjc2IDEwOS45MDYsMTcyLjY0MSBMMTQyLjY3OSwxNzIuNTA4IEMxNTEuMzQ3LDE3Mi40NzIgMTU0LjU1MiwxNzguMzM1IDE0OS44MjQsMTg1LjYwNSBMMTA2LjMzNCwyNTIuNDc3IEMxMDMuOTcyLDI1Ni4xMTIgMTA0LjU0MiwyNTYuNTgxIDEwNy42MiwyNTMuNTI3IEwxNzUuOTE1LDE4NS43MTcgQzE3OC45ODgsMTgyLjY1OSAxODMuOTUsMTc3LjY4NiAxODYuOTgzLDE3NC41OTYgTDIwOC43ODgsMTUyLjQ4NSBDMjE0Ljg3NSwxNDYuMzE3IDIxMi43NzUsMTQxLjMzIDIwNC4xMTEsMTQxLjM2OCBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICAgICAgICAgIDwvZz4KICAgICAgICAgICAgPC9nPgogICAgICAgIDwvZz4KICAgIDwvZz4KPC9zdmc+) !important;
    background-size: 18px !important;
    background-repeat: no-repeat !important;
 		background-position: 4px 7px !important;
 		text-indent: -99999px;
 		width: 12px;
}</style>';
}
if ( is_user_logged_in() ) {
	add_action('wp_head', 'ampfowp_add_extra_css');
}	
// 92. View AMP in Admin Bar
add_action( 'wp_before_admin_bar_render', 'ampforwp_view_amp_admin_bar' ); 
if( ! function_exists( 'ampforwp_view_amp_admin_bar' ) ) {
	function ampforwp_view_amp_admin_bar( ) {
		global $wp_admin_bar, $post, $wp_post_types, $redux_builder_amp;
		$post_type_title = $current_url = '';
		$supported_amp_post_types = array();
		
		// Get all post types supported by AMP
		$supported_amp_post_types = ampforwp_get_all_post_types();
		$current_access = false;
		// Check for Admin
		if ( is_admin() ) {
			$current_screen = get_current_screen();
			$current_access = ('post' == $current_screen->base && 'add' != $current_screen->action);
		}elseif(is_user_logged_in()){
			$current_user = wp_get_current_user();
			$current_access = current_user_can('edit_posts',$current_user );
		}
			// Check for Screen base, user ability to read and visibility
			if ($current_access && (isset($post->ID) && $post->ID && current_user_can('read_post', $post->ID ))
				&& ( isset ( $wp_post_types[ $post->post_type ]->public ) && $wp_post_types[$post->post_type]->public )
				&& ( isset ( $wp_post_types[ $post->post_type ]->show_in_admin_bar ) && $wp_post_types[$post->post_type]->show_in_admin_bar ) ) {
				// Check if current post type is AMPed or not
				if( $supported_amp_post_types && in_array($post->post_type, $supported_amp_post_types) ){
					// If AMP on Posts or Pages is off then do nothing
					if($post->post_type == 'post' && !ampforwp_get_setting('amp-on-off-for-all-posts') || $post->post_type == 'page' && !ampforwp_get_setting('amp-on-off-for-all-pages')) {
						return;
					}
					if( is_archive() && is_category() ){
						if(!ampforwp_get_setting('ampforwp-archive-support') || !ampforwp_get_setting('ampforwp-archive-support-cat') ){
							return ;
						}
					}elseif( is_archive() && is_tag() ){
						if(!ampforwp_get_setting('ampforwp-archive-support') || !ampforwp_get_setting('ampforwp-archive-support-tag') ){
							return ;
						}
					}elseif( is_archive() && is_tax()){
						$taxonomies = ampforwp_get_setting('ampforwp-custom-taxonomies');
						if(empty($taxonomies)){
							return ;
						}else{
							$term_id = get_queried_object()->term_id;
							$termObj = get_term( $term_id);
							if( in_array($termObj->taxonomy, $taxonomies)){
							}else{
								return ;
							}
						}
					}

					if( is_archive() && is_category()){
						$term_id = get_queried_object()->term_id;
						$termObj = get_term( $term_id);
						$taxonomy_objects = get_object_taxonomies( 'post', 'objects' );
						$post_type_title = $taxonomy_objects[$termObj->taxonomy]->labels->singular_name;
						if(ampforwp_get_setting('ampforwp-archive-support') == true && ampforwp_get_setting('ampforwp-archive-support-cat') == true){
							$current_url = get_term_link($term_id);
						}
					}elseif( is_archive() && is_tag()){
						$term_id = get_queried_object()->term_id;
						$termObj = get_term( $term_id);
						$taxonomy_objects = get_object_taxonomies( 'post', 'objects' );
						$post_type_title = $taxonomy_objects[$termObj->taxonomy]->labels->singular_name;
						if(ampforwp_get_setting('ampforwp-archive-support') == true && ampforwp_get_setting('ampforwp-archive-support-tag') == true){
							$current_url = get_term_link($term_id);
						}
					}elseif(is_archive() && is_tax()){
						$term_id = get_queried_object()->term_id;
						$termObj = get_term( $term_id);
						$taxonomy_objects = get_taxonomy( $termObj->taxonomy );
						$post_type_title = $taxonomy_objects->labels->singular_name;
						$current_url = get_term_link($term_id);
					}else{
						$post_type_title = ucfirst($post->post_type);
						$current_url = get_permalink( $post->ID );
						if(is_home()){
							$current_url = home_url();
						}
					}
					 if (is_preview()) {
						$current_url = $current_url .'&amp=1&preview=true';
						$wp_admin_bar->add_node(array(
						'id'    => 'ampforwp-view-amp',
						'title' => 'View ' . esc_html($post_type_title) . ' (AMP)' ,
						'href'  => esc_url($current_url)
						));
					}else{
						$wp_admin_bar->add_node(array(
						'id'    => 'ampforwp-view-amp',
						'title' => 'View ' . esc_html($post_type_title) . ' (AMP)' ,
						'href'  => ampforwp_url_controller($current_url)
					));
					}
				}
		}
	}
}

// 94. OneSignal Push Notifications
// Moved to push-notification-functions.php

// 95. Modify menu link attributes for SiteNavigationElement Schema Markup #1229 #1345
add_filter( 'nav_menu_link_attributes', 'ampforwp_nav_menu_link_attributes', 10, 3 );
if( ! function_exists( 'ampforwp_nav_menu_link_attributes' ) ) {
	function ampforwp_nav_menu_link_attributes( $atts, $item, $args ) {
		if ( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
	    // Manipulate link attributes
	    	$atts['itemprop'] = "url";
	    }
	    return $atts;
	}
}

// 96. ampforwp_is_front_page() ampforwp_is_home() and ampforwp_is_blog is created
// Moved to functions.php

// 97. Change the format of the post date on Loops #1384
add_filter('ampforwp_modify_post_date', 'ampforwp_full_post_date_loops');
if( ! function_exists( 'ampforwp_full_post_date_loops' ) ){
	function ampforwp_full_post_date_loops($full_date){
	global $redux_builder_amp;
	if( is_home() || is_archive() ){
		if( 2 == $redux_builder_amp['ampforwp-post-date-format'] ){	
			$full_date =  get_the_date();
			if( 2 == $redux_builder_amp['ampforwp-post-date-global'] ){
				$full_date =  get_the_modified_date();
			}
		}
		if( 1 == $redux_builder_amp['ampforwp-post-date-format'] ){
			$time = ampforwp_get_the_time();
			$date = human_time_diff( $time, current_time('timestamp') );
			if( $redux_builder_amp['ampforwp-post-date-format-text'] ){
				$full_date = $redux_builder_amp['ampforwp-post-date-format-text'];
				// Change the % days into the actual number of days
				$full_date = str_replace('% days', $date, $full_date);
				$full_date = str_replace('ago', ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago'), $full_date);
			}
		}
	}
	if(is_single() && 1 == $redux_builder_amp['ampforwp-post-date-format']){
		$time = ampforwp_get_the_time();
		$date 		= human_time_diff( $time, current_time('timestamp') );
		$full_date 	= human_time_diff( $time, current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago');
		if( $redux_builder_amp['ampforwp-post-date-format-text'] ){
			$full_date = $redux_builder_amp['ampforwp-post-date-format-text'];
			// Change the % days into the actual number of days
			$full_date = str_replace('% days', $date, $full_date);
			$full_date = str_replace('ago', ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago'), $full_date);
		}
	}
	return $full_date;
	}
}
if(!function_exists('ampforwp_get_the_time')){
	function ampforwp_get_the_time(){
		$time = get_the_time('U', get_the_ID());
		if( 2 == ampforwp_get_setting('ampforwp-post-date-global') ){
			$time = get_the_modified_time('U', get_the_ID() );
		}
		if(defined('ECWD_VERSION')){
			global $ecwd_options;
			$tz = $ecwd_options['time_zone'];
			$ewwetz = new DateTime( get_the_time('c', get_the_ID()) );
			if( 2 == ampforwp_get_setting('ampforwp-post-date-global') ){
				$ewwetz = new DateTime( get_the_modified_time('c', get_the_ID()) );
			}
			$ewwetz->setTimezone(new DateTimeZone($tz));
			$time = $ewwetz->format('U');
		}
		return $time;
    }
}
// 99. Merriweather Font Management
add_filter( 'amp_post_template_data', 'ampforwp_merriweather_font_management' );
function ampforwp_merriweather_font_management( $data ) {
	if ( 1 != ampforwp_get_setting('amp-design-selector') || ( false == ampforwp_get_setting('ampforwp-d1-font') && 1 == ampforwp_get_setting('amp-design-selector') ) ) {
		unset($data['font_urls']['merriweather']);
	}
	return $data;
}

// 100. Flags compatibility in Menu
add_filter('ampforwp_menu_content','ampforwp_modify_menu_content');
if( ! function_exists(' ampforwp_modify_menu_content ') ){
	function ampforwp_modify_menu_content($menu){
		$dom 		= '';
		$nodes 		= '';
		$num_nodes 	= '';
		if( !empty( $menu ) ){
			// Create a new document
			$dom = new DOMDocument();
			if( function_exists( 'mb_convert_encoding' ) ){
				$menu = mb_convert_encoding($menu, 'HTML-ENTITIES', 'UTF-8');			
			}
			else{
				$menu =  preg_replace( '/&[^amp|#038].*?;/', 'x', $menu ); // multi-byte characters converted to X
			}

			// To Suppress Warnings
			libxml_use_internal_errors(true);

			$dom->loadHTML($menu);

			libxml_use_internal_errors(false);

			// get all the img's
			$nodes 		= $dom->getElementsByTagName( 'img' );
			$num_nodes 	= $nodes->length;
			for ( $i = $num_nodes - 1; $i >= 0; $i-- ) {
				$node 	= $nodes->item( $i );
				// Set The Width and Height if there in none
				if ( '' === $node->getAttribute( 'width' ) ) {
					$node->setAttribute('width', 15);
				}
				if( '' === $node->getAttribute( 'height' ) ){
					$node->setAttribute('height', 15);
				}
			}
			$menu = $dom->saveHTML();
		}
		return $menu;
	}
}
/*
 * Fetches the logo data 
 * More details about the fix https://github.com/ahmedkaludi/accelerated-mobile-pages/pull/2317
 * Props to: https://github.com/saucal for suggesting the fix.
*/

function ampforwp_default_logo_data() {
	global $redux_builder_amp, $ampwforwp_default_logo_data;

	if( $ampwforwp_default_logo_data ) {
		return $ampwforwp_default_logo_data;
	}

	$logo_id		= '';
	$image 			= array();
	$value 			= '';
	$logo_alt		= '';

	$logo_id = get_theme_mod( 'custom_logo' );
	if(isset($redux_builder_amp['opt-media']['id']) && empty( $logo_id ) ) {
		$logo_id = (integer) $redux_builder_amp['opt-media']['id'];
	}

	if( empty( $logo_id ) ) {
		return false;
	}

	if( ! wp_attachment_is( 'image', $logo_id ) || ampforwp_get_setting('opt-media','url') ) {
		$logo_url = ampforwp_get_setting('opt-media','url');
		$image[0] = ampforwp_get_setting('opt-media','width');
		$image[1] = ampforwp_get_setting('opt-media','height');
		if(empty($image)){
			$image = @getimagesize( $logo_url );
		}
		if ( empty($image[0]) || empty($image[1]) ) {
			$image[0] = '190';
			$image[1] = '36';
		}
	} else {
		$imageDetail = wp_get_attachment_image_src( $logo_id , 'full');
		$logo_url = $imageDetail[0];
		$image[0] = $imageDetail[1];
		$image[1] = $imageDetail[2];
		if ( 0 === $image[1] ) {
			$image[0] = '190';
			$image[1] = '36';
		}
	}

	$logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true);

	$ampwforwp_default_logo_data = array(
		'logo_id' => $logo_id,
		'logo_url' => $logo_url,
		'logo_alt' => $logo_alt,
		'logo_size' => $image
	);
	return $ampwforwp_default_logo_data;
}

// 101. Function for Logo attributes
function ampforwp_default_logo($param=""){
	global $redux_builder_amp;
	$value 		= '';
	$data 		= ampforwp_default_logo_data();
	if( ! $data ) {
		if($param!="width" && $param!="height"){
			return $value;
		}
	}

	switch ($param) {
		case 'url':
				$value = $data['logo_url'];
			break;
		case 'width':
			if (true == ampforwp_get_setting('ampforwp-custom-logo-dimensions') && 'prescribed' ==ampforwp_get_setting('ampforwp-custom-logo-dimensions-options')) {
				$value = trim(ampforwp_get_setting('opt-media-width'));
				if($value==""){
					$value = 190;
				}
			}
			else 
				$value = '';
				if(isset($data['logo_size'][0])){
					$value = $data['logo_size'][0];
				}
			if($value==""){
					$value = 190;
				}
			break;
		case 'height':
			if (true == ampforwp_get_setting('ampforwp-custom-logo-dimensions') && 'prescribed' == ampforwp_get_setting('ampforwp-custom-logo-dimensions-options')) {
				$value = trim(ampforwp_get_setting('opt-media-height'));
				if($value==""){
					$value = 36;
				}
			}
			else
				$value = '';
				if(isset($data['logo_size'][1])){
					$value = $data['logo_size'][1];
				}
				if($value==""){
					$value = 36;
				}
			break;
		case 'alt':
			if(isset($data['logo_alt'][0])){
				$value = $data['logo_alt'];
			}
			else
				$value = get_bloginfo('name');
			break;	
		default:
			$value = $data['logo_url'];
			break;
	}

	return $value;
} 
// Envira Lazy Load compatibility
add_filter('envira_gallery_pre_data', 'ampforwp_envira_lazy_load');
if( ! function_exists(' ampforwp_envira_lazy_load ') ){
	function ampforwp_envira_lazy_load($data){
	if( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ){
		if(function_exists('envira_get_config')){
			$checker = envira_get_config( 'lazy_loading', $data);
			if( 1 === $checker){
				$data['config']['lazy_loading'] = 0;
			}
		}
	}	
	return $data;
	}
}	

#1581 Instagram Sanitizer 

add_filter( 'amp_content_sanitizers', 'ampforwp_instagram_sanitizer', 10, 1 );

function ampforwp_instagram_sanitizer( $sanitizer_classes ) {
  require_once( AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-instagram-sanitizer.php' );
  $sanitizer_classes[ 'AMPFORWP_Instagram_Embed_Sanitizer' ] = array(); 
  return $sanitizer_classes;
}

// Allowed Tags
if ( ! function_exists('ampforwp_allowed_tags') ) {
	function ampforwp_allowed_tags() {
		$allowed_tags = '';
		$allowed_tags = wp_kses_allowed_html('post');
		$allowed_tags['a']['itemprop'] = true;
      	$allowed_tags['span']['itemprop'] = true;

      	return $allowed_tags;
	}
}

// List of Subpages/Childpages on Pages
add_action('ampforwp_after_post_content', 'ampforwp_list_subpages');
if ( ! function_exists('ampforwp_list_subpages') ) {
	function ampforwp_list_subpages() {
		if (class_exists('AddWidgetAfterContent')) {
			$sanitized_output = '';
			$sanitized_output = ampforwp_sidebar_content_sanitizer('add-widget-after-content');
			if ( $sanitized_output) {
				$sanitized_output = $sanitized_output->get_amp_content();?>
				<div class="amp-add-widget-after-content">
					<?php echo do_shortcode($sanitized_output); ?> 
				</div>
			<?php }
		}
		global $post, $redux_builder_amp;
		if ( is_page() && true == $redux_builder_amp['ampforwp_subpages_list'] ) {
			$pages = '';
			$pages = wp_list_pages( array( 
							'echo' => 0,
							'child_of' => $post->ID,
							'title_li' => '', 
			) );
			$pages = preg_replace('/href="(.*?)"/', 'href="$1/amp/"', $pages);
			echo wp_kses($pages, ampforwp_allowed_tags());
		}
	}
}

// Disable wptextturize #1458
add_action('init','ampforwp_wptexturize_disabler');
if ( ! function_exists('ampforwp_wptexturize_disabler') ) {
	function ampforwp_wptexturize_disabler(){
		global $redux_builder_amp;
		if ( isset($redux_builder_amp['ampforwp-wptexturize']) && true == $redux_builder_amp['ampforwp-wptexturize'] ) {
			remove_filter('the_content', 'wptexturize');
			remove_filter('the_title', 'wptexturize');
		}
	}
}

// amp-vimeo proper video id for 3 parameter url
add_filter('amp_vimeo_parse_url','amp_vimeo_parse_url_video_id');
function amp_vimeo_parse_url_video_id($tok){
	  if (in_array("ondemand", $tok) && sizeof($tok)==3){		 
		$tok = '';
		return $tok;
	  }
	  if(sizeof($tok)==3){
       return $tok[1];
      }else{
        return end($tok);
      }
}

// Cart Page URL
if( ! function_exists( 'ampforwp_wc_cart_page_url' ) ){
	function ampforwp_wc_cart_page_url(){
		if(function_exists('amp_woocommerce_pro_add_woocommerce_support') && (function_exists('wc_get_cart_url') || function_exists('get_cart_url'))){
		    global $woocommerce;
		    $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
		    $cart_url = ampforwp_url_controller($cart_url);
		    return $cart_url;
	 	}
	 	else
	 		return '#'; 
	}
}

// Add Google Font support
add_action('amp_post_template_css', 'ampforwp_google_fonts_generator');
if ( ! function_exists( 'ampforwp_google_fonts_generator' ) ) {
  function ampforwp_google_fonts_generator() {
    global $redux_builder_amp;
    if( 1!=ampforwp_get_setting('ampforwp-google-font-switch') || true == ampforwp_get_setting('amp_google_font_restrict')){
    	return;
    }	
	if(isset($redux_builder_amp['google_current_font_data'])){
		$font_data = json_decode(stripslashes($redux_builder_amp['google_current_font_data']));
	}

    $font_weight = "";
    $font_output = "";
    $font_type = "";
    if(isset( $redux_builder_amp['amp_font_type'])){
    	$font_type = $redux_builder_amp['amp_font_type'];
    }

    if ( $font_type && ampforwp_get_setting('amp_font_selector') != 'Segoe UI') {
	    foreach ($font_type as $key => $value) {
			// Font Weight generator
			$font_weight = (int) $value;
			$font_weight =  ( $font_weight != 0 ? $font_weight : 400 );

			// Font Stlye Generator
			$font_style = preg_replace('/\d+/u', '', $value);
			$font_style = ( $font_style == 'italic' ? 'italic' : 'normal' );

			// Local Generator
			// Font Weight 
			$font_local_weight = '';

			if ( $font_weight === 100 ) {
				$font_local_weight = 'Thin';
			}

			if ( $font_weight === 200 ) {
				$font_local_weight = 'Ultra Light';
			}

			if ( $font_weight === 300 ) {
				$font_local_weight = 'Light';
			}

			if ( $font_weight === 400 ) {
				$font_local_weight = 'Regular';
			}

			if ( $font_weight === 500 ) {
				$font_local_weight = 'Medium';
			}

			if ( $font_weight === 600 ) {
				$font_local_weight = 'SemiBold';
			}

			if ( $font_weight === 700 ) {
				$font_local_weight = 'Bold';
			}

			if ( $font_weight === 800 ) {
				$font_local_weight = 'ExtraBold';
			}

			if ( $font_weight === 900 ) {
				$font_local_weight = 'Black';
			}

	      	// Font Style 
	     	$font_local_type = '';
	      	if ('italic' === $font_style) {
	        	$font_local_type = 'Italic';
	      	}

	        $font_output .= "@font-face {  ";
	        $font_output .= "font-family: " . $redux_builder_amp['amp_font_selector']. ';' ;
	        $font_output .= "font-display: optional;";
	        $font_output .= "font-style: " . $font_style . ';';
	        $font_output .= "font-weight: " . $font_weight . ';' ;
	        $font_output .= "src: local('". $redux_builder_amp['amp_font_selector']." ".$font_local_weight." ".$font_local_type."'), local('". $redux_builder_amp['amp_font_selector']."-".$font_local_weight.$font_local_type."'), url(" .str_replace("http://", "https://", $font_data->files->$value) . ');' ;
	        $font_output .= "}";
	    }
    }

    //for Single content Font Family
    if(ampforwp_get_setting('content-font-family-enable') && (is_singular() || (ampforwp_get_setting('amp-design-selector')!=4) ) ){
    	if(ampforwp_get_setting('google_current_font_data_content_single')){
			$font_data = json_decode(stripslashes(ampforwp_get_setting('google_current_font_data_content_single')));
		}
    	$font_output .= "\n";
	    if( ampforwp_get_setting('amp_font_type_content_single') ){
	    	$font_type = ampforwp_get_setting('amp_font_type_content_single');
	    }
	    if ( $font_type && ampforwp_get_setting('amp_font_selector_content_single') != 'Segoe UI') {
		    foreach ($font_type as $key => $value) {
				// Font Weight generator
				$font_weight = (int) $value;
				$font_weight =  ( $font_weight != 0 ? $font_weight : 400 );
				// Font Stlye Generator
				$font_style = preg_replace('/\d+/u', '', $value);
				$font_style = ( $font_style == 'italic' ? 'italic' : 'normal' );
				// Local Generator
				// Font Weight 
				$font_local_weight = '';
				if ( $font_weight === 100 ) {
					$font_local_weight = 'Thin';
				}
				if ( $font_weight === 200 ) {
					$font_local_weight = 'Ultra Light';
				}
				if ( $font_weight === 300 ) {
					$font_local_weight = 'Light';
				}
				if ( $font_weight === 400 ) {
					$font_local_weight = 'Regular';
				}
				if ( $font_weight === 500 ) {
					$font_local_weight = 'Medium';
				}
				if ( $font_weight === 600 ) {
					$font_local_weight = 'SemiBold';
				}
				if ( $font_weight === 700 ) {
					$font_local_weight = 'Bold';
				}
				if ( $font_weight === 800 ) {
					$font_local_weight = 'ExtraBold';
				}
				if ( $font_weight === 900 ) {
					$font_local_weight = 'Black';
				}
		      	// Font Style 
		     	$font_local_type = '';
		      	if ('italic' === $font_style) {
		        	$font_local_type = 'Italic';
		      	}
		        $font_output .= "@font-face {  ";
		        $font_output .= "font-family: " . esc_attr(ampforwp_get_setting('amp_font_selector_content_single')). ';' ;
		        $font_output .= "font-display: optional".';';
		        $font_output .= "font-style: " . esc_attr($font_style) . ';';
		        $font_output .= "font-weight: " . esc_attr($font_weight) . ';' ;
		        $font_output .= "src: local('". esc_attr(ampforwp_get_setting('amp_font_selector_content_single'))." ".esc_attr($font_local_weight)." ".esc_attr($font_local_type)."'), local('". esc_attr(ampforwp_get_setting('amp_font_selector_content_single'))."-".esc_attr($font_local_weight).$font_local_type."'), url(" .esc_url(str_replace("http://", "https://", $font_data->files->$value)) . ');' ;
		        $font_output .= "}";
		    }
	    }
	}

    echo $font_output; // escaped above
  }
}

function swifttheme_footer_widgets_init() {
	register_sidebar( array(
	        'name' => esc_html__( 'AMP Widget Below Header', 'accelerated-mobile-pages' ),
	        'id' => 'ampforwp-below-header',
	        'description' => esc_html__( 'This Widget will be display on Below Header area', 'accelerated-mobile-pages' ),
	        'class'=>'w-bl',
	        'before_widget' => '<div class="w-bl">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	register_sidebar( array(
	        'name' => esc_html__( 'AMP Widget Above Loop', 'accelerated-mobile-pages' ),
	        'id' => 'ampforwp-above-loop',
	        'description' => esc_html__( 'This Widget will be display on Above Loop area', 'accelerated-mobile-pages' ),
	        'class'=>'w-bl',
	        'before_widget' => '<div class="w-bl">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	register_sidebar( array(
	        'name' => esc_html__( 'AMP Widget Below loop', 'accelerated-mobile-pages' ),
	        'id' => 'ampforwp-below-loop',
	        'description' => esc_html__( 'This Widget will be display on Below loop area', 'accelerated-mobile-pages' ),
	        'class'=>'w-bl',
	        'before_widget' => '<div class="w-bl">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	register_sidebar( array(
	        'name' => esc_html__( 'AMP Widget Above Footer', 'accelerated-mobile-pages' ),
	        'id' => 'ampforwp-above-footer',
	        'description' => esc_html__( 'This Widget will be display on Above Footer area', 'accelerated-mobile-pages' ),
	        'class'=>'w-bl',
	        'before_widget' => '<div class="w-bl">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
 	if(ampforwp_design_selector()==4 || ampforwp_design_selector()==3 || ampforwp_design_selector()==2 || ampforwp_design_selector()==1){
	    register_sidebar( array(
	        'name' => esc_html__( 'AMP Footer', 'accelerated-mobile-pages' ),
	        'id' => 'swift-footer-widget-area',
	        'description' => esc_html__( 'The Footer widget area', 'accelerated-mobile-pages' ),
	        'class'=>'w-bl',
	        'before_widget' => '<div class="w-bl">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	    if(true == ampforwp_get_setting('gnrl-sidebar')){
	    register_sidebar( array(
	        'name' => esc_html__( 'AMP Sidebar', 'accelerated-mobile-pages' ),
	        'id' => 'swift-sidebar',
	        'description' => esc_html__( 'The Swift Sidebar', 'accelerated-mobile-pages' ),
	        'class'=>'amp-sidebar',
	        'before_widget' => '<div class="amp-sidebar">',
	        'after_widget' => '</div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
	    ) );
	    }
	}
}
add_action( 'init', 'swifttheme_footer_widgets_init' );

// AMP Takeover
function ampforwp_is_non_amp( $type="" ) {
	global $redux_builder_amp;
	$non_amp = false;
	$ampforwp_amp_post_on_off_meta = $post_id = '';
	$post_id = get_the_ID();
	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
	}
	if ( false !== get_query_var( 'amp', false ) ) {
		return false;
	}
	$mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	if (""===$type  && (ampforwp_get_setting('ampforwp-amp-takeover') || $mob_pres_link == true) ) {
		$non_amp = true;

		
		// Check for Posts
		if ( is_single() && false == ampforwp_get_setting('amp-on-off-for-all-posts') ) {
			return false;
		}
		// Archives
		if ( is_archive() && false == ampforwp_get_setting('ampforwp-archive-support') ) {
			return false;
		}
		// Pages
		if ( is_page() && false == ampforwp_get_setting('amp-on-off-for-all-pages') ) {
			return false;
		}
		//Blogpage
		$page_for_posts = intval(get_option( 'page_for_posts' ));
		if ( $page_for_posts == ampforwp_get_the_ID() ) {
			return true;
		}
		// Homepage
		if ( is_home() && false == ampforwp_get_setting('ampforwp-homepage-on-off-support') ) {
			return false;
		}
		// Search #2681
		if ( is_search() && ( (4 == ampforwp_get_setting('amp-design-selector') && false == ampforwp_get_setting('amp-swift-search-feature') )  ) ){
			return false;
		}
		//Removed AMP Takeover when custom 404 Page is selected in enfold theme #4723
		if ( function_exists('avia_preload_screen') && !empty(avia_get_option('error404_page')) && is_404() ) {
			return false;
		}
		// Enabling AMP Takeover only when selected in Custom Post Type
		$supported_types_for_takeover = array();
	    $supported_types_for_takeover = ampforwp_get_all_post_types();
	    if( $supported_types_for_takeover ){
	            $current_type = get_post_type(get_the_ID());
	            if( $current_type==false){
	            	$non_amp = true;
	            }else{
		            if(!in_array($current_type, $supported_types_for_takeover) && !is_404() && !is_search()){ 
		              return ;
		            }
		        }
	    }
		if ( is_front_page() && false == ampforwp_get_setting('ampforwp-homepage-on-off-support') ) {
			return false;
		}
		if ( is_feed() ) {
			return false;
		}
		if(get_query_var( 'robots' )){
      		return; 
    	}
    	if ( function_exists('is_embed') && is_embed() ){
            return;
        }
		if(is_search() && 0 == ampforwp_get_setting('amp-redirection-search')){
		    return false;
		}
	}elseif(	(
				ampforwp_get_setting('amp-design-selector') == 4)
				&&
				(
			 true == ampforwp_get_setting('ampforwp-amp-convert-to-wp') 
				) 
				|| 
				(
					'non_amp_check_convert' === $type
					&& true == ampforwp_get_setting('ampforwp-amp-convert-to-wp') 
				) ) {
		$non_amp = true;

	}
	// Convert AMP to WP issues fixed #2493
	//Blogposts
	if ( is_home()  && ampforwp_get_setting('ampforwp-homepage-on-off-support') == false ) {
      return;
    }
    // Pages
    
	if ( is_page() && false == ampforwp_get_setting('amp-on-off-for-all-pages') ) {
		return;
	}
	if ( is_singular() || ampforwp_is_front_page() || ampforwp_is_blog() ) {
		$ampforwp_amp_post_on_off_meta = get_post_meta( $post_id,'ampforwp-amp-on-off',true);
		if($ampforwp_amp_post_on_off_meta == 'hide-amp'){
			return false;	
		}
	}
// Removing the AMP on login register etc of Theme My Login plugin	
    
	if (function_exists('tml_register_default_actions')){
        $tml_pages = tml_get_actions();
        $pages = array();
        if ( isset($tml_pages) && $tml_pages ) {
          foreach ($tml_pages as $page) {
            $pages[] = $page->get_slug();
          }
      }
      if(in_array(get_query_var('action'), $pages) ){
        return false;
      }
   }
	return $non_amp;
}
function ampforwp_mobile_redirect_preseve_link(){
	$redirectToAMP = false;
	if(ampforwp_get_setting('amp-mobile-redirection') == true && ampforwp_get_setting('amp-mob-redirection-pres-link') == true){
		require_once AMPFORWP_PLUGIN_DIR.'/includes/vendor/Mobile_Detect.php';
		$mobile_detect = new AMPforWP_Mobile_Detect;
	    $isMobile = $mobile_detect->isMobile();
	    $isTablet = $mobile_detect->isTablet();
	    $isTabletUserAction = ampforwp_get_setting('amp-tablet-redirection');
	    if( $isMobile && $isTabletUserAction && $isTablet ){ //Only For tablet
	      $redirectToAMP = true;
	    }else if($isMobile && !$isTablet){ // Only for mobile
	      $redirectToAMP = true;
	    }
	}
	return $redirectToAMP;
}
// Remove wpautop from specific posts which contain amp-components
add_action('pre_amp_render_post','ampforwp_custom_wpautop');
function ampforwp_custom_wpautop(){
	if ( is_single() ) {
		if ( get_post_meta(get_the_ID(), 'ampforwp-wpautop', true) == 'false') {
			remove_filter('the_content', 'wpautop');
		}
	}
	if(function_exists('ubermenu_get_nav_menu_args')){
    	add_filter( 'ubermenu_nav_menu_args' ,'ampforwp_modify_ubermenu_nav_menu_args' , 10,2);
    }
}
function ampforwp_modify_ubermenu_nav_menu_args($args , $config_id){
	$args['menu_class'] = 'amp-menu  '.$args['menu_class'];
    return $args;
}
// Backward Compatibility for AMP Preview #1529
if ( ! function_exists('get_preview_post_link') ) { 
function get_preview_post_link( $post = null, $query_args = array(), $preview_link = '' ) {
	$post = get_post( $post );
	if ( ! $post ) {
		return;
	}

	$post_type_object = get_post_type_object( $post->post_type );
	if ( is_post_type_viewable( $post_type_object ) ) {
		if ( ! $preview_link ) {
			$preview_link = set_url_scheme( get_permalink( $post ) );
		}

		$query_args['preview'] = 'true';
		$preview_link = add_query_arg( $query_args, $preview_link );
	}
	return apply_filters( 'preview_post_link', $preview_link, $post );
}
}

// Homepage Loop Modifier #1701
add_filter('ampforwp_query_args','ampforwp_homepage_loop');
function ampforwp_homepage_loop( $args ) {
	global $redux_builder_amp;
	if ( is_home() ) {
		$post_type = 'post';
		// Check if Custom Post Type is selected
		if ('' != ampforwp_get_setting('ampforwp-homepage-loop-type') ) {
			$post_type = ampforwp_get_setting('ampforwp-homepage-loop-type');
		}
		$args['post_type'] = $post_type;
		// Exclude Categories if any selected
		if ('' != ampforwp_get_setting('ampforwp-homepage-loop-cats') ) {
			$args['category__not_in'] = ampforwp_get_setting('ampforwp-homepage-loop-cats');
		}
	}
	return $args; 
}
// To get correct comments count #1662
add_filter('get_comments_number', 'ampforwp_comment_count', 0);
function ampforwp_comment_count( $count ) {
	
	/* TODO: Allowed memory size exhausted #1865	 
		get_comments() was trying to access by Id and because the ID is not present on amp frontpages. It is getting exhausted. Need to recreate issue and validate the hypothesis
	*/

	if ( ! is_admin() && function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() && is_single() ) {
		global $id;
		$get_comments = get_comments('status=approve&post_id=' . $id); 	 
 		$comments_by_type = separate_comments($get_comments); 
		return count($comments_by_type['comment']);
	} 
	else {
		return $count;
	}
}
// Glue underline css compatibility #1743 #1932
add_action('amp_post_template_css', 'ampforwp_glue_css_comp', PHP_INT_MAX );
if ( ! function_exists('ampforwp_glue_css_comp') ) {
	function ampforwp_glue_css_comp() {
		global $redux_builder_amp; 
		if (class_exists('YoastSEO_AMP_Frontend') ) { ?>
			a {text-decoration:none;}
			html {background:none;}
		<?php }
		 if ( isset($redux_builder_amp['ampforwp-underline-content-links']) && $redux_builder_amp['ampforwp-underline-content-links'] ) { ?>
			.the_content a {text-decoration:underline;}
		<?php }
	}
}

// Filter for Frontpage id
add_filter('ampforwp_modify_frontpage_id', 'ampforwp_modified_frontpage_id');
if( ! function_exists('ampforwp_modified_frontpage_id') ) {
	function ampforwp_modified_frontpage_id($page_id){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		// WPML Compatibility #1111
	 	if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
		 	$page_id = get_option('page_on_front');	
	 	}
	 	// Polylang Compatibility #1779
	 	elseif( ampforwp_polylang_front_page() ){
	 		$frontpage_id = get_option('page_on_front');
	 		if($frontpage_id){
		 		$page_id = pll_get_post($frontpage_id);
		 	}	
	 	}
	 return $page_id;
	}
}

// AMP to WP Theme Ads
add_filter('ampforwp_modify_ads', 'ampforwp_nonamp_ads',10, 5);
if ( ! function_exists('ampforwp_nonamp_ads') ) {
	function ampforwp_nonamp_ads($output, $width, $height, $client_id, $data_slot) {
		if ( ampforwp_is_non_amp('non_amp_check_convert') ) {

			$output = '	<div class="add-wrapper" style="text-align:center;">
							<script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
							</script>
							<ins class="adsbygoogle" style="display:inline-block;width:'.esc_attr($width).';height:'.esc_attr($height).'" data-ad-client="'.esc_attr($client_id).'" data-ad-slot="'.esc_attr($data_slot).'">
							</ins>
							<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>';
		}
	return $output;
	}
}
//AMP to WP Theme Analytics
add_action('wp_footer','ampforwp_nonamp_analytics');
if ( ! function_exists('ampforwp_nonamp_analytics') ) {
	function ampforwp_nonamp_analytics() {
		global $redux_builder_amp;
		$ga_account = $redux_builder_amp['ga-feild'];
		if ( ampforwp_is_non_amp("non_amp_check_convert") ) {
			echo "	
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '$ga_account', 'auto');
		ga('send', 'pageview');
		</script>";
		}
	}
}
// Coauthors Compatibility #1895
add_filter('coauthors_posts_link', 'ampforwp_coauthors_links');
function ampforwp_coauthors_links($args){
	global $redux_builder_amp;
	if ( function_exists('ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() && true == $redux_builder_amp['ampforwp-archive-support']) {
		$args['href'] = ampforwp_url_controller($args['href']);
	}
	return $args;
}

//remove anchor from the image when lightbox option is enabled #2695
add_action('pre_amp_render_post','ampforwp_remove_ahref_lightbox');
function ampforwp_remove_ahref_lightbox(){	
	if(true == ampforwp_get_setting('ampforwp-amp-img-lightbox') ){
		add_filter( 'the_content', 'ampforwp_remove_ahref_lightbox_in_amp' );
		add_filter('tablepress_table_render_data','amforwp_remove_tp_image_href');
	}
}
function ampforwp_remove_ahref_lightbox_in_amp( $content ) {
	preg_match_all('/(<a(.*?)href=\"(.*?)\"(.*?)>(.*?)<img(.*?)src=\"(.*?)\"(.*?)(.*?)[^>]*>)/', $content, $matches);
	if( count($matches[3])){
		for( $i=0;$i<count($matches[3]);$i++){
			$href_url = $matches[3][$i];
			if (!empty($href_url)) {
				$href_url = explode('/', $href_url);
				$href_url = end($href_url);
				$href_url = pathinfo($href_url, PATHINFO_FILENAME);
			}
			if($matches[3][$i] == $matches[7][$i] || (!empty($href_url) && strpos($matches[7][$i], $href_url) !== false)){
				$href = $matches[3][$i];
				$src = $matches[7][$i];
				$href_src = str_replace( '/', '\/', esc_url($href));
				$image_src = str_replace( '/', '\/', esc_url($src));
				$content = preg_replace('/<a(.*?)href=\"'.$href_src.'\"(.*?)>(<img(.*?)src=\"'.$image_src.'\"(.*?)[^>]*>)<\/a>/i', '$3', $content);	

			}
		}
	}
	return $content;
}
function amforwp_remove_tp_image_href( $orig_table){
	$tablepressData = array();
	$j = 0;
	foreach ($orig_table['data'] as $cols) {
		for($i=0;$i< count($cols);$i++){
			$tablepressData[$j][$i] = preg_replace("/<a[^>]+\>(<img[^>]+\>)<\/a>/i",'$1', $cols[$i]);
		}
		$j++;	
	}
	$orig_table['data'] = $tablepressData;
	return $orig_table;
}
// amp-image-lightbox #1892
if ( ! function_exists('ampforwp_amp_img_lightbox') ) {
	function ampforwp_amp_img_lightbox(){ 
		echo '<amp-image-lightbox id="amp-img-lightbox" layout="nodisplay"></amp-image-lightbox>';
	}
}
// New Image attributes for amp-image-lightbox #1892
add_filter('amp_img_attributes', 'ampforwp_img_new_attrs');
function ampforwp_img_new_attrs($attributes) {
	global $redux_builder_amp;
	if ( ampforwp_get_setting('ampforwp-amp-img-lightbox') ) {	
		$attributes['on'] = 'tap:amp-img-lightbox';
		$attributes['role'] = 'button';
		$attributes['tabindex'] = '0';
	}
	return $attributes;
}
// Facebook Comments script for AMP2WP
add_action('ampforwp_body_beginning', 'ampforwp_amp2wp_fb');
if ( ! function_exists('ampforwp_amp2wp_fb') ) {
	function ampforwp_amp2wp_fb(){
		global $redux_builder_amp;
		if( ampforwp_is_non_amp() && isset($redux_builder_amp['ampforwp-amp-convert-to-wp']) && $redux_builder_amp['ampforwp-amp-convert-to-wp'] && ($redux_builder_amp['ampforwp-facebook-comments-support'] || $redux_builder_amp['ampforwp-facebook-like-button']) ) {
			echo '<div id="fb-root"></div>
					<script>(function(d, s, id) {
		  				var js, fjs = d.getElementsByTagName(s)[0];
		  				if (d.getElementById(id)) return;
		  				js = d.createElement(s); js.id = id;
		  				js.src = "https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12";
		  				fjs.parentNode.insertBefore(js, fjs);
					}(document, "script", "facebook-jssdk"));</script>';
		}
	}
}

// Removing AMPHTML Added by Facebook's Instant Article's Plugin #2043
add_action( 'wp', 'ampforwp_remove_instant_articles_amp_markup' );
function ampforwp_remove_instant_articles_amp_markup(){
	
	if(class_exists('Instant_Articles_AMP_Markup')){
		remove_action( 'wp_head', array('Instant_Articles_AMP_Markup', 'inject_link_rel') );
	}
	// #1696
	  if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
	    if(class_exists('SQ_Classes_ObjController')){
		    $SQ_Classes_ObjController = new SQ_Classes_ObjController();
		    $sq_analytics_class_obj = $SQ_Classes_ObjController::getClass('SQ_Models_Services_Analytics');
		}
	  }
}
// #2042 
function ampforwp_404_canonical(){
	global $wp;
	return home_url( $wp->request );
}
// #2001 removing unused JS from the Paginated Posts
add_filter('ampforwp_post_content_filter', 'ampforwp_paginated_post_content');

function ampforwp_paginated_post_content($content){
	global $numpages;
	if(is_singular()){
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var( 'page' ) ) {
		  	$paged = get_query_var('page');
		} else {
		  	$paged = 1;
		}
	    if( $numpages >= 2 && true == ampforwp_get_setting('amp-pagination') ){
	      	return get_the_content();
	    }
	}

    return $content;
}

// GDPR Compliancy #2040
// Moved to notice-bar-functions.php

// Thrive Leads Compatibility #2067
add_filter('thrive_leads_skip_request', 'ampforwp_skip_thrive_leads');
if ( ! function_exists('ampforwp_skip_thrive_leads') ) {
	function ampforwp_skip_thrive_leads($skip) {
		// Skip thrive leads on AMP
		if ( function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint() ) {
			return true;
		}

		return $skip;
	}
}

// Re-save permalink once the post value changed in Redading Settings #2190

add_action( 'update_option', 'ampforwp_resave_permalink', 10, 3 );
function ampforwp_resave_permalink( $option, $old_value, $value ){
 	if('posts_per_page' === $option){
 		if($old_value != $value){
 			delete_transient( 'ampforwp_current_version_check' );
 		}
 	}
}

// Canonical From Yoast #2118 and All in One SEO #1720 and Rank Math #2701
function ampforwp_generate_canonical(){
	global $redux_builder_amp;
	$canonical = '';
	$canonical = $WPSEO_Frontend = $All_in_One_SEO_Pack = $opts = '';
	if ( 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && true == ampforwp_get_setting('ampforwp-seo-yoast-canonical') && class_exists('WPSEO_Frontend') && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')) {
		$WPSEO_Frontend = WPSEO_Frontend::get_instance();
		$canonical = $WPSEO_Frontend->canonical(false);
	}
	elseif ( 'aioseo' == ampforwp_get_setting('ampforwp-seo-selection') && true == ampforwp_get_setting('ampforwp-seo-aioseo-canonical') && class_exists('All_in_One_SEO_Pack') ) {
		$All_in_One_SEO_Pack = new All_in_One_SEO_Pack();
		$opts = $All_in_One_SEO_Pack->get_current_options( array(), 'aiosp' );
		$canonical = $opts['aiosp_custom_link'];
	}
	elseif ( defined( 'RANK_MATH_FILE' ) && 'rank_math' == ampforwp_get_setting('ampforwp-seo-selection') && ampforwp_get_setting( 'ampforwp-seo-rank_math-canonical' ) ) {
		$canonical = \RankMath\Paper\Paper::get()->get_canonical();
	}
	return $canonical;
}
add_filter('amp_post_template_data', 'ampforwp_modified_canonical', 85);
function ampforwp_modified_canonical( $data ) {
	$canonical = '';
	$canonical = ampforwp_generate_canonical();
	if ( !empty($canonical) ) {
		$data['canonical_url'] = $canonical;
	}
	return $data;
}
if(class_exists('WPSEO_Frontend') && 'yoast' == ampforwp_get_setting('ampforwp-seo-selection') && true == ampforwp_get_setting('ampforwp-seo-yoast-canonical') && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration') ){
	add_filter('ampforwp_modify_rel_url','ampforwp_yoast_canonical');
}
function ampforwp_yoast_canonical($canonical){
	if(ampforwp_is_front_page()){
		$canonical = ampforwp_generate_canonical();
	}
	return $canonical;
}
// #2220 Remove Space Shortcode by Pro Theme from THEMCO
add_action('pre_amp_render_post','ampforwp_remove_space_shortcodes');
function ampforwp_remove_space_shortcodes(){
	add_filter('the_content','ampforwp_remove_pro_theme_space_shortcodes');
}

function ampforwp_remove_pro_theme_space_shortcodes($content){
	if(has_shortcode( $content, 'gap' )){
		remove_shortcode( 'gap' );
		// to remove the useless shortcode from the AMP Content
		add_shortcode( 'gap', 'ampforwp_return_no_gap' );
	}
	return $content;
}

function ampforwp_return_no_gap(){
	return;
}

/*
	#2229 Function to check the option for comments to display on post, page or both.
 */
function ampforwp_get_comments_status(){
	global $redux_builder_amp;
	$display_comments_on = "";
	if ( false == ampforwp_get_setting('ampforwp-display-on-pages') && true == ampforwp_get_setting('ampforwp-display-on-posts')  ) {
		$display_comments_on =  is_single();
	}
	if ( true == ampforwp_get_setting('ampforwp-display-on-pages') && false == ampforwp_get_setting('ampforwp-display-on-posts') ) {
		$display_comments_on =  is_page();
	}
	if ( true == ampforwp_get_setting('ampforwp-display-on-pages') && true == ampforwp_get_setting('ampforwp-display-on-posts')) {
		$display_comments_on =  is_singular();
		if ( ampforwp_is_front_page() ) {
			$display_comments_on =  ampforwp_is_front_page();
		}
	}
	$display_comments_on = apply_filters('ampforwp_comments_visibility', $display_comments_on);
	return $display_comments_on;
}

// Vuukle Comments Support #2075

add_action('ampforwp_post_after_design_elements','ampforwp_vuukle_comments_support');
function ampforwp_vuukle_comments_support() {
	global $redux_builder_amp;
	if ( true == ampforwp_get_setting('ampforwp-vuukle-comments-support') && comments_open() && ampforwp_get_setting('amp-design-selector') != 4) {
		echo ampforwp_vuukle_comments_markup();
	}
}
function ampforwp_vuukle_comments_markup() {
	global $redux_builder_amp,$post;
	$apiKey = $locale = '';
	$tag_name ='';
	$img = get_the_post_thumbnail_url();
	$tags = get_the_tags($post->ID);
	if( isset($redux_builder_amp['ampforwp-vuukle-comments-apiKey']) && $redux_builder_amp['ampforwp-vuukle-comments-apiKey'] !== ""){
		$apiKey = $redux_builder_amp['ampforwp-vuukle-comments-apiKey'];
	}
	$display_comments_on = false;
	$display_comments_on = ampforwp_get_comments_status();
	$siteUrl = trim(site_url(), '/');  
	if (!preg_match('#^http(s)?://#', $siteUrl)) {
	    $siteUrl = 'http://' . $siteUrl;
	}
	if($img ==  false){
		$img = plugins_url('accelerated-mobile-pages/images/150x150.png');
	}  
   	if($tags){
  		foreach($tags as $individual_tag) {
 				$tag_name = $individual_tag->name;
			}
   	}
	$urlParts = parse_url($siteUrl);
	$siteUrl = preg_replace('/^www\./', '', $urlParts['host']);// remove www
	$srcUrl = 'https://cdn.vuukle.com/amp.html?';
	$srcUrl = add_query_arg('url' ,get_permalink(), $srcUrl);
	$srcUrl = add_query_arg('host' ,$siteUrl, $srcUrl);
	$srcUrl = add_query_arg('id' , $post->ID, $srcUrl);
	if(!empty($apiKey)){
		$srcUrl = add_query_arg('apiKey' , $apiKey, $srcUrl);
	}  
	$srcUrl = add_query_arg('title' , urlencode($post->post_title), $srcUrl);
	$srcUrl = add_query_arg('img' , esc_url($img), $srcUrl);
	$srcUrl = add_query_arg('tags' , urlencode($tag_name), $srcUrl);  
	if(ampforwp_get_setting('ampforwp-vuukle-comments-emoji')==false){
		$srcUrl = add_query_arg('emotes' , 'false', $srcUrl);
	}
	$consent = '';
	if(ampforwp_get_data_consent()){
		$consent = 'data-block-on-consent ';
	}
	$vuukle_html ='';
	if ( $display_comments_on ) {
		$vuukle_html .= '<amp-iframe width="600" height="350" '.esc_attr($consent).'layout="responsive" sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms" resizable frameborder="0" src="'.esc_url($srcUrl).'">

			<div overflow tabindex="0" role="button" aria-label="Show comments" class="afwp-vuukle-support">Show comments</div></amp-iframe>';
	}
	return $vuukle_html;
}
add_filter( 'amp_post_template_data', 'ampforwp_add_vuukle_scripts' );
function ampforwp_add_vuukle_scripts( $data ) {
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( ampforwp_get_setting('ampforwp-vuukle-comments-support') && $display_comments_on) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
			if (ampforwp_get_setting('ampforwp-vuukle-Ads-before-comments') && empty( $data['amp_component_scripts']['amp-ad'] ) ) {
				$data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
			}
	}
	return $data;
}
//spotim #2076
add_action('ampforwp_post_after_design_elements','ampforwp_spotim_comments_support');
function ampforwp_spotim_comments_support() {
	global $redux_builder_amp;
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-spotim-comments-support'])
		 && $redux_builder_amp['ampforwp-spotim-comments-support']==1
		) {
		echo ampforwp_spotim_comments_markup();
	}
}
function ampforwp_spotim_comments_markup() {
	global $post;
	$display_comments_on = false;
	$display_comments_on = ampforwp_get_comments_status();
	if (! $display_comments_on ) {
		return '';
	}
	$spotId ='';
	if( true == ampforwp_get_setting('ampforwp-spotim-comments-apiKey') && ampforwp_get_setting('ampforwp-spotim-comments-apiKey') !== ""){
		$spotId = ampforwp_get_setting('ampforwp-spotim-comments-apiKey');
	}
	$srcUrl = 'https://amp.spot.im/production.html?spot_im_highlight_immediate=true';
	$srcUrl = add_query_arg('spotId' ,$spotId, $srcUrl);
	$srcUrl = add_query_arg('postId' , $post->ID, $srcUrl);
	$spotim_html = '<amp-iframe width="375" height="815" resizable sandbox="allow-scripts allow-same-origin allow-popups allow-top-navigation" layout="responsive"
	  frameborder="0" src="'.esc_url($srcUrl).'">
	  <amp-img placeholder height="815" layout="fill" src="//amp.spot.im/loader.png"></amp-img>
	  <div overflow class="spot-im-amp-overflow" tabindex="0" role="button" aria-label="Read more">Load more...</div>
	</amp-iframe>';
	return $spotim_html;
}
//spotim script
add_filter( 'amp_post_template_data', 'ampforwp_add_spotim_scripts' );
function ampforwp_add_spotim_scripts( $data ) {
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( 4 != $redux_builder_amp['amp-design-selector']
		 && isset($redux_builder_amp['ampforwp-spotim-comments-support'])
		 && $redux_builder_amp['ampforwp-spotim-comments-support']
		 && $display_comments_on  && comments_open() 
		) {
			if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
				$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
			}
	}
	return $data;
}
//spotim css
add_action('amp_post_template_css','ampforwp_spotim_vuukle_styling',60);
function ampforwp_spotim_vuukle_styling(){
	global $redux_builder_amp;
	$display_comments_on = "";
	$display_comments_on = ampforwp_get_comments_status();
	if ( isset($redux_builder_amp['ampforwp-spotim-comments-support'])
	 	&& $redux_builder_amp['ampforwp-spotim-comments-support']
	 	&& $display_comments_on  && comments_open() ) {
		?>.spot-im-amp-overflow {
	    background: white;
	    font-size: 15px;
	    padding: 15px 0;
	    text-align: center;
	    font-family: Helvetica, Arial, sans-serif;
	    color: #307fe2;
	  }<?php
	}
	if ( isset($redux_builder_amp['ampforwp-vuukle-comments-support'])
	 	&& $redux_builder_amp['ampforwp-vuukle-comments-support']
	 	&& $display_comments_on  && comments_open() ) { ?>
		.afwp-vuukle-support{
			display: block;text-align: center;background: #1f87e5;color: #fff;border-radius: 4px;
		} <?php 
	}
}


function ampforwp_check_excerpt(){
	global $redux_builder_amp;
 
	$value = '';
	$value =  ( isset( $redux_builder_amp['excerpt-option'] ) &&  $redux_builder_amp['excerpt-option'] ) ;
	if ( null === $value ) {
		$value = '1';
	}
 
	return $value;
}

// Back to top 
add_action( 'ampforwp_body_beginning' ,'ampforwp_back_to_top_markup');
function ampforwp_back_to_top_markup(){
	if(true == ampforwp_get_setting('ampforwp-footer-top')){
		echo '<div id="backtotop"></div>';
	}
}

// rel="next" & rel="prev" pagination meta tags #2343
add_action( 'amp_post_template_head', 'ampforwp_rel_next_prev' );	

function ampforwp_rel_next_prev(){
    global $paged;
    if(ampforwp_is_front_page()){
    	return ;
    }
    if ( get_previous_posts_link() ) { ?>
        <link rel="prev" href="<?php echo esc_url(get_pagenum_link( $paged - 1 )); ?>" /><?php
    }
    if ( get_next_posts_link() ) { ?>
        <link rel="next" href="<?php echo esc_url(get_pagenum_link( $paged + 1 )); ?>" /><?php
    }
}

// Content Sneak Peek #2246
add_action('pre_amp_render_post', 'ampforwp_content_sneak_peek');
if ( ! function_exists('ampforwp_content_sneak_peek') ) {
	function ampforwp_content_sneak_peek() {
		global $redux_builder_amp;
		if ( ampforwp_get_setting('content-sneak-peek') && is_single() && 'post' == get_post_type() ) {		
			add_filter('ampforwp_modify_the_content', 'ampforwp_sneak_peek_content_modifier');
			add_action('amp_post_template_css','ampforwp_sneak_peek_css');
			add_filter('ampforwp_post_template_data','ampforwp_sneak_peek_scripts');
		}

	}
}
// Content Sneak Peek content
function ampforwp_sneak_peek_content_modifier($content){
	
	if ( strlen($content) >= 3000 ) {
		$content = '<div class="fd-h" [class]="contentVisible ? \'show\' : \'fd-h\'">' . $content . '</div>';
		$content = $content . '<div id="fader" class="content-fader" [class]="contentVisible ? \'content-fader hide\' : \'content-fader\'"></div>';
		$content = $content . '<div class="fd-b-c" [class]="contentVisible ? \'fd-b-c hide\' : \'fd-b-c\'"><button class="fd-b" [text]="contentVisible ? \'\' : \''.ampforwp_translation(ampforwp_get_setting('content-sneak-peek-btn-text'), 'Show Full Article').'\'" on="tap:AMP.setState({contentVisible: !contentVisible})">'.ampforwp_translation(ampforwp_get_setting('content-sneak-peek-btn-text'), 'Show Full Article').'</button></div>';
	}
	return $content;
}
// Content Sneak Peek Scripts css
function ampforwp_sneak_peek_css(){
	global $redux_builder_amp;
	$height = $txt_color = $btn_color = '';
	$height = ampforwp_get_setting('content-sneak-peek-height');
	$btn_color = $redux_builder_amp['content-sneak-peek-btn-color']['color'];
	$txt_color = $redux_builder_amp['content-sneak-peek-txt-color']['color'];?>
	.fd-h{height: <?php echo esc_attr($height); ?>;overflow: hidden;position: relative;}
    .fd-b-c{text-align: center;margin: 0px 0px 30px 0px;}
    .fd-b-c .fd-b:hover{cursor:pointer;}
    .fd-b-c .fd-b {border:none;border-radius: 5px;color: <?php echo ampforwp_sanitize_color($txt_color); ?>;font-size: 16px;font-weight: 700;padding: 12px 32px 12px 32px;background-color: <?php echo ampforwp_sanitize_color($btn_color); ?>;
    }
    .fd-h:after {
	    content: "";
	    display: inline-block;
	    position: absolute;
	    background: linear-gradient(to bottom,rgba(255,255,255,0) 0,rgba(255,255,255,1) 100%);
	    width:100%;
	    bottom: 0;
	    top:auto;
	    height:230px;
	}
<?php }
// Content Sneak Peek Scripts
function ampforwp_sneak_peek_scripts($data) {
	if ( empty( $data['amp_component_scripts']['amp-bind'] ) ) {
		$data['amp_component_scripts']['amp-bind'] = 'https://cdn.ampproject.org/v0/amp-bind-0.1.js';
	}
	return $data;
}

// #1575 Thrive Content Support
add_action('amp_init','ampforwp_thrive_architect_content');
function ampforwp_thrive_architect_content(){
	if(function_exists('tve_wp_action') && !function_exists('et_setup_theme')){
		if(checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){
			add_filter( 'ampforwp_modify_the_content','ampforwp_thrive_content');
		}
	}
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
    if ( function_exists( 'ampforwp_is_amp_inURL' ) && ampforwp_is_amp_inURL($url_path)  ) {
		//#3254 Remove action for Woodmart theme lazyload feature 
		remove_action( 'init', 'woodmart_lazy_loading_init', 120 );
	}
}


function ampforwp_thrive_content($content){
	$post_id = "";
	if ( ampforwp_is_front_page() ){
		$post_id = ampforwp_get_frontpage_id();
		$content = get_post_field( 'post_content', $post_id ); 
	}

	$sanitizer_obj = new AMPFORWP_Content( $content,
									array(), 
									apply_filters( 'ampforwp_content_sanitizers', 
										array( 'AMP_Img_Sanitizer' => array(), 
											'AMP_Blacklist_Sanitizer' => array(),
											'AMP_Style_Sanitizer' => array(), 
											'AMP_Video_Sanitizer' => array(),
					 						'AMP_Audio_Sanitizer' => array(),
					 						'AMP_Iframe_Sanitizer' => array(
												 'add_placeholder' => true,
											 ),
										) 
									) 
								);
				$content =  $sanitizer_obj->get_amp_content();
	return $content;
}
// Instant Articles Meta Box
add_action( 'add_meta_boxes', 'ampforwp_ia_meta_box' );
if ( ! function_exists('ampforwp_ia_meta_box') ) {
	function ampforwp_ia_meta_box() {
		global $post;
	    
	    if ( ampforwp_role_based_access_options() == true ) { 
		    if( ampforwp_get_setting('fb-instant-article-switch') && $post->post_type == 'post' ) {
		    	add_meta_box( 'ampforwp_ia_meta', esc_html__( 'Show Instant Article for Current Post?','accelerated-mobile-pages' ), 'ampforwp_ia_meta_callback', 'post','side' );      
		    }
        }
    }
}
// Callback function for Instant Articles Meta Box.
function ampforwp_ia_meta_callback( $post ) {
	global $redux_builder_amp;
    wp_nonce_field( basename( __FILE__ ), 'ampforwp_ia_nonce' );
    $ampforwp_stored_meta = get_post_meta( ampforwp_get_the_ID() );
	if ( ! isset($ampforwp_stored_meta['ampforwp-ia-on-off']) && ! isset($ampforwp_stored_meta['ampforwp-ia-on-off'][0]) && $ampforwp_stored_meta['ampforwp-ia-on-off'][0] == 'hide-ia') {
		$exclude_post_value = get_option('ampforwp_ia_exclude_post');
		if ( $exclude_post_value == null ) {
			$exclude_post_value[] = 0;
		}
		if ( $exclude_post_value ) {
			if ( ! in_array( ampforwp_get_the_ID(), $exclude_post_value ) ) {
				$exclude_post_value[] = ampforwp_get_the_ID();
				update_option('ampforwp_ia_exclude_post', $exclude_post_value);
			}
		}
	} else {
		$exclude_post_value = get_option('ampforwp_ia_exclude_post');
		if ( $exclude_post_value == null ) {
			$exclude_post_value[] = 0;
		}
		if ( $exclude_post_value ) {
			if ( in_array( ampforwp_get_the_ID(), $exclude_post_value ) ) {
				$exclude_ids = array_diff($exclude_post_value, array(ampforwp_get_the_ID()) );
				update_option('ampforwp_ia_exclude_post', $exclude_ids);
			}
		}

	} ?>
    <p>
        <div class="prfx-row-content">
            <label class="meta-radio-two" for="ampforwp-ia-on-off-meta-radio-one">
                <input type="radio" name="ampforwp-ia-on-off" id="ampforwp-ia-on-off-meta-radio-one" value="default"  checked="checked" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-ia-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-ia-on-off'][0], 'default' ); ?>>
                <?php esc_html_e( 'Enable', 'accelerated-mobile-pages' )?>
            </label>
            <label class="meta-radio-two" for="ampforwp-ia-on-off-meta-radio-two">
                <input type="radio" name="ampforwp-ia-on-off" id="ampforwp-ia-on-off-meta-radio-two" value="hide-ia" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-ia-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-ia-on-off'][0], 'hide-ia' ); ?>>
                <?php esc_html_e( 'Disable', 'accelerated-mobile-pages' )?>
            </label> 
        </div>
    </p>
<?php }

// Total Plus compatibility #2511
add_action('current_screen', 'ampforwp_totalplus_comp_admin');
function ampforwp_totalplus_comp_admin() {
	$screen = get_current_screen();
	if ( 'toplevel_page_amp_options' == $screen->base ) {
		remove_action('admin_enqueue_scripts', 'total_plus_admin_scripts', 100);
		// Save option is not showing with a basix theme #3366
		if(function_exists('addPanelCSS')){
			remove_action( 'admin_enqueue_scripts', 'addPanelCSS');
		}
	}
}
// uploading the images with SVG format #2431
function ampforwp_upload_svg($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'ampforwp_upload_svg');

// Ajax functions
add_action( 'wp_ajax_ampforwp_categories', 'ampforwp_ajax_cats' );
function ampforwp_ajax_cats(){
	$ampforwp_nonce = wp_create_nonce( 'ampforwp-verify-request' );
 	if(!wp_verify_nonce($ampforwp_nonce,'ampforwp-verify-request') ){
		echo json_encode(array('status'=>403,'message'=>'user request is not allowed')) ;
		die;
	}
	$return = array();
 	$categories = get_categories(array('search'=> esc_html($_GET['q']),'number'=>500,'hide_empty' => 0));
 	$categories_array = array();
   	if ( $categories ) :
        foreach ($categories as $cat ) {
                $return[] = array($cat->cat_ID,$cat->name);// array( Cat ID, Cat Name )
        }
    endif;
	wp_send_json( $return );
}
add_action( 'wp_ajax_ampforwp_tags', 'ampforwp_ajax_tags' );
function ampforwp_ajax_tags(){
	$ampforwp_nonce = wp_create_nonce( 'ampforwp-verify-request' );
 	if(!wp_verify_nonce($ampforwp_nonce,'ampforwp-verify-request') ){
		echo json_encode(array('status'=>403,'message'=>'user request is not allowed')) ;
		die;
	}
	$return = array();
 	$tags = get_tags(array('search'=> esc_html($_GET['q']),'number'=>500));
   	if ( $tags ) :
        foreach ($tags as $tag ) {
                $return[] = array($tag->term_id,$tag->name);// array( Tag ID, tag Name )
        }
    endif;
	wp_send_json( $return );
} 
add_filter( 'amp_post_template_data', 'ampforwp_backtotop' );
function ampforwp_backtotop( $data ) {
	global $redux_builder_amp;
	if(true == ampforwp_get_setting('ampforwp-footer-top')){
			if ( empty( $data['amp_component_scripts']['amp-position-observer'] ) ) {
				$data['amp_component_scripts']['amp-position-observer'] = 'https://cdn.ampproject.org/v0/amp-position-observer-0.1.js';
			}
			if ( empty( $data['amp_component_scripts']['amp-animation'] ) ) {
				$data['amp_component_scripts']['amp-animation'] = 'https://cdn.ampproject.org/v0/amp-animation-0.1.js';
			}
			
	}
	return $data;
} 

// Jannah Theme Subtitle Support #2732 
add_action('ampforwp_below_the_title','ampforwp_jannah_subtitle');
function ampforwp_jannah_subtitle(){
	if (function_exists('jannah_theme_name') && function_exists('tie_get_postdata')){?>
		<h2 class="amp-wp-content"><?php echo esc_html(tie_get_postdata( 'tie_post_sub_title' ))?></h2>
	<?php
	} 
}

// SD Feature Image Guidlines #2838
add_filter( 'amp_post_template_metadata', 'ampforwp_sd_feature_image_guidlines', 22, 1 );
if ( ! function_exists('ampforwp_sd_feature_image_guidlines') ) {
	function ampforwp_sd_feature_image_guidlines($metadata){
		if ( isset($metadata['image']['width']) && $metadata['image']['width'] <= 1200  ){
			$image_width = 1280;
			$image_height = 720;
			$image = ampforwp_aq_resize( $metadata['image']['url'], $image_width, $image_height, true, false, true );
			$image_url = isset( $image[0] ) ? $image[0] : ''; 
			$metadata['image']['url'] = $image_url;
			$metadata['image']['width'] = $image_width;
			$metadata['image']['height'] = $image_height;
		}
		return $metadata;
	}
}
// Gutenberg Modules CSS #2707
if(ampforwp_get_setting('ampforwp_css_tree_shaking') == true && ampforwp_is_gutenberg_active()){
add_action('amp_post_template_css', 'ampforwp_gutenberg_css');
}
if ( ! function_exists('ampforwp_gutenberg_css') ) {
	function ampforwp_gutenberg_css(){
		$color_data =   get_theme_support('editor-color-palette');
		$background = '#32373c';
		if(isset($color_data[0]) && isset($color_data[0][0]) && isset($color_data[0][0]['color'])){
				$background = $color_data[0][0]['color'];
		}
		?>
		.wp-block-button { color: #fff}
		.wp-block-button a {background-color: <?php echo ampforwp_sanitize_color($background);?>;border-radius: 28px;color: inherit;display: inline-block;padding: 12px 24px;}
		.wp-block-cover{position:relative;background-color: #000;background-size: cover;background-position: center center;min-height: 430px;width: 100%;margin: 1.5em 0 1.5em 0;display: flex;justify-content: center;align-items: center;overflow: hidden;}
		.wp-block-cover-text{color: #fff;font-size: 2em;line-height: 1.25;z-index: 1;}
		.wp-block-cover-image.has-background-dim::before, .wp-block-cover.has-background-dim::before {content: "";position: absolute;top: 0;left: 0;bottom: 0;right: 0;background-color: inherit;opacity: .5;z-index: 1;} <?php
		if ( $color_data ) {
			foreach ($color_data[0] as $key ) { ?>
				.has-<?php echo esc_attr($key['slug']);?>-color { color: <?php echo ampforwp_sanitize_color($key['color']);?>;} .has-<?php echo esc_attr($key['slug']);?>-background-color { background-color: <?php echo ampforwp_sanitize_color($key['color']);?> }
				 <?php 
				}
			}
		}
} 
// Subtitles Plugin Support #2853
add_action('ampforwp_below_the_title','ampforwp_subtitles_support');
if ( ! function_exists('ampforwp_subtitles_support') ) {
function ampforwp_subtitles_support(){
if (class_exists('Subtitles')){
	$post_id = get_the_ID();
	if(ampforwp_is_front_page()){
		$post_id = ampforwp_get_frontpage_id();
	}	
	// exit if no post id is available.
	if (empty($post_id)){
		return;
	}
	$subtitle = "";
	$subtitle = get_post_meta( $post_id, Subtitles::SUBTITLE_META_KEY, true );
	?>
	<h2 class="amp-wp-content"><?php echo esc_html($subtitle) ?></h2>
<?php
} 
}
}

// AMPforWP Global Sanitizer
add_action('pre_amp_render_post','ampforwp_comments_sanitizer', 15);
function ampforwp_comments_sanitizer(){
	global $ampforwp_data;
	$comments_scripts = array();
	$comments = $postID = $comment_text = '';
	$postID = get_the_ID();
	if ( ampforwp_is_front_page() ) {
		$postID = ampforwp_get_frontpage_id();
	}
	if ( ampforwp_get_comments_status() && true == ampforwp_get_setting('wordpress-comments-support') ) {
		$comment_order = get_option( 'comment_order' );
		$comments = get_comments(array(
				'post_id' => $postID,
				'order' => esc_attr($comment_order),
				'status' => 'approve' //Change this to the type of comments to be displayed
		) );
		foreach ($comments as $comment) {
			$comment_data = get_comment( $comment->comment_ID );
			$comment_text =	$comment_data->comment_content;
			$comment_text = wpautop( $comment_text );
	    	$sanitizer = new AMPforWP_Content( $comment_text, apply_filters( 'amp_content_embed_handlers', array(
	    		  'AMP_Reddit_Embed_Handler' => array(),
		          'AMP_Twitter_Embed_Handler' => array(),
		          'AMP_YouTube_Embed_Handler' => array(),
		          'AMP_DailyMotion_Embed_Handler' => array(),
				  'AMP_Vimeo_Embed_Handler' => array(),
				  'AMP_SoundCloud_Embed_Handler' => array(),
		          'AMP_Instagram_Embed_Handler' => array(),
		          'AMP_Vine_Embed_Handler' => array(),
		          'AMP_Facebook_Embed_Handler' => array(),
		          'AMP_Pinterest_Embed_Handler' => array(),
		          'AMP_Gallery_Embed_Handler' => array(),
		    ) ),  apply_filters(  'amp_sidebar_sanitizers', array(
		           'AMP_Style_Sanitizer' => array(),
		           'AMP_Blacklist_Sanitizer' => array(),
		           'AMP_Img_Sanitizer' => array(),
		           'AMP_Video_Sanitizer' => array(),
		           'AMP_Audio_Sanitizer' => array(),
		           'AMP_Playbuzz_Sanitizer' => array(),
		           'AMP_Iframe_Sanitizer' => array(
		             'add_placeholder' => true,
		           ),
		    )  ) );
		    if ( $sanitizer ) {
		    	$sanitizer_scripts = $sanitizer->get_amp_scripts();
		    	if ( $sanitizer_scripts ){
		    		$comments_scripts = array_merge($comments_scripts, $sanitizer_scripts);
		    	}
		    }
		}
		if ( $comments_scripts ) {
			$ampforwp_data['comments']['scripts'] = $comments_scripts;
		}
	}
}
// AMPforWP Global Scripts
add_filter('amp_post_template_data','ampforwp_add_global_scripts');
function ampforwp_add_global_scripts($data){
    global $ampforwp_data;
    $comments_scripts = array();
    // Add Comments Scripts #2827
    if ( $comments_scripts ) {
	  $comments_scripts = $ampforwp_data['comments']['scripts'];
	}
    if ( !empty($comments_scripts) ) {
        foreach ($comments_scripts as $key => $value ) {
            if( empty( $data['amp_component_scripts'][$key] ) ){
                $data['amp_component_scripts'][$key]  = $value;
            }
        }
    }
    // AddThis Support #3068   
	if ( ampforwp_get_setting('enable-add-this-option') && ( is_single() || (is_page() && ampforwp_get_setting('ampforwp-page-social') ) ) && !ampforwp_woocommerce_conditional_check() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && ( ampforwp_get_setting('addthis-floating-share') == true || ampforwp_get_setting('addthis-inline-share') == true))  {
 		if ( empty( $data['amp_component_scripts']['amp-addthis'] ) ) {
			$data['amp_component_scripts']['amp-addthis'] = 'https://cdn.ampproject.org/v0/amp-addthis-0.1.js';
		}
	}
	// Featured video SmartMag theme Compatibility #2559:
	if( function_exists('get_the_post_video') || class_exists('Bunyad') ) {
		if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
			$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
		}
	}
	//Appearance option for Related Posts #1545
	if (  true == ampforwp_get_setting('ampforwp-single-related-posts-switch') && ampforwp_get_setting('rp_design_type') == '3') {
		if ( empty( $data['amp_component_scripts']['amp-carousel'] ) ) {
			$data['amp_component_scripts']['amp-carousel'] = 'https://cdn.ampproject.org/v0/amp-carousel-0.2.js';
		}
	}
    return $data;
}	
if ( ! function_exists('ampforwp_get_weglot_url') ) {
	function ampforwp_get_weglot_url(){
		$url = weglot_get_full_url_no_language();
		$current_lang = weglot_get_current_and_original_language();
		$original_lang = $current_lang['original'];
		$current_lang = $current_lang['current'];
		if($current_lang == $original_lang ){
			return $url;
		 }else{
			$url = trailingslashit($url) . $current_lang;
			return esc_url(user_trailingslashit($url));
		}
		
	}
}
// Rank Math SEO Compatibility #2701
// og tags and Schema
add_action('amp_post_template_head','ampforwp_rank_math');
if ( ! function_exists('ampforwp_rank_math') ) {
	function ampforwp_rank_math(){		
		// Early Bail if Rank Math is not selected in SEO Plugin Integration.
		if ( 'rank_math' !== ampforwp_get_setting('ampforwp-seo-selection') ) {
			return;
		}

		// Remove Canonical & Title Tag added by the Rank Math plugin.
		remove_all_actions( 'rank_math/head', 20 );
		remove_all_actions( 'rank_math/head', 1 );

		// Remove meta tags added by the Rank Math plugin.
		if ( ! ampforwp_get_setting( 'ampforwp-seo-rank_math-meta' ) ) {
			$json_ld_data = isset( $wp_filter['rank_math/json_ld'] ) ? $wp_filter['rank_math/json_ld'] : '';
			remove_all_actions( 'rank_math/opengraph/facebook' );
			remove_all_actions( 'rank_math/opengraph/twitter' );
			add_filter( 'rank_math/frontend/robots', function() {
				return [];
			});
		}else if(ampforwp_is_front_page()){
			add_filter( 'rank_math/frontend/robots', function() {
				return [];
			});
		}
		// Remove ld+json data added by the Rank math plugin.
		if ( ! ampforwp_get_setting( 'ampforwp-seo-rank_math-schema' ) ) {
			remove_all_actions( 'rank_math/json_ld' );
		}
		if(class_exists('RankMath') && true == ampforwp_get_setting('ampforwp-amp-takeover') && ( ampforwp_is_home() || ampforwp_is_front_page())){
			$google = RankMath\Helper::get_settings( 'general.google_verify' );
			$bing = RankMath\Helper::get_settings( 'general.bing_verify' );
			$baidu = RankMath\Helper::get_settings( 'general.baidu_verify' );
			$alexa = RankMath\Helper::get_settings( 'general.alexa_verify' );
			$yandex = RankMath\Helper::get_settings( 'general.yandex_verify' );
			$pinterest = RankMath\Helper::get_settings( 'general.pinterest_verify' );
			$norton = RankMath\Helper::get_settings( 'general.norton_verify' );
			if(!empty($google)){?>
				<meta name="google-site-verification" content='<?php echo esc_html($google) ?>'/>
			<?php }
			if(!empty($bing)){?>
				<meta name="msvalidate.01" content='<?php echo esc_html($bing) ?>'/>
			<?php }
			if(!empty($baidu)){?>
				<meta name="baidu-site-verification" content='<?php echo esc_html($baidu) ?>'/>
			<?php }
			if(!empty($alexa)){?>
				<meta name="alexaVerifyID" content='<?php echo esc_html($alexa) ?>'/>
			<?php }
			if(!empty($yandex)){?>
				<meta name="yandex-verification" content='<?php echo esc_html($yandex) ?>'/>
			<?php }
			if(!empty($pinterest)){?>
				<meta name="p:domain_verify" content='<?php echo esc_html($pinterest) ?>'/>
			<?php }
			if(!empty($norton)){?>
				<meta name="norton-safeweb-site-verification" content='<?php echo esc_html($norton) ?>'/>
			<?php }
		}	
		do_action( 'rank_math/head' );
	}
}
#1160 Embedly Sanitizer 
add_filter( 'amp_content_sanitizers', 'ampforwp_embedly_sanitizer', 10, 1 );
function ampforwp_embedly_sanitizer( $sanitizer_classes ) {
	if ( class_exists('WP_Embedly') ) {
  		require_once( AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-embedly-sanitizer.php' );
  		$sanitizer_classes[ 'AMPforWP_Embedly_Sanitizer' ] = array();
  	}
	return $sanitizer_classes;
}
add_filter('ampforwp_is_amp_endpoint_takeover', "ampforwp_bulktool_takeover");
if (! function_exists('ampforwp_bulktool_takeover') ) {
function ampforwp_bulktool_takeover($data){
	$mob_pres_link = false;
  	if(function_exists('ampforwp_mobile_redirect_preseve_link')){
   	   $mob_pres_link = ampforwp_mobile_redirect_preseve_link();
 	}
	if ( true == ampforwp_get_setting('ampforwp-amp-takeover') || true == ampforwp_get_setting('ampforwp-amp-convert-to-wp') || $mob_pres_link == true) {
		$bulk_option = ampforwp_get_setting('amp-pages-meta-default');
		$ampforwp_stored_meta = get_post_meta( ampforwp_get_the_ID(),'ampforwp-amp-on-off',true);
		if(is_page() && $bulk_option == "hide" && !isset($ampforwp_stored_meta)){
			remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical', 1 );
			return false; 
		}
	}
	return $data;
}
}

add_filter('ampforwp_is_amp_endpoint_takeover','ampforwp_disable_takovr_elementor_preview');
function ampforwp_disable_takovr_elementor_preview($data){
	if ( did_action( 'elementor/loaded' ) ) {
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ){
			return false;
		}else{
			return $data;
		}
	}
	return $data;
}

// Multiple Images #2259
// Moved to structured-data-functions.php

// schema.org/SiteNavigationElement missing from menus #1229 & #2952
// Moved to structured-data-functions.php

// WP Subtitle Support #2831
add_action('ampforwp_below_the_title','ampforwp_wpsubtitle_support');
if (! function_exists('ampforwp_wpsubtitle_support') ) {
function ampforwp_wpsubtitle_support(){
 	if(class_exists('WPSubtitle')){?>
	<h2 class="amp-wp-content"><?php the_subtitle(); ?></h2>
<?php 
}
}
}

// Fallbacks for Vendor AMP #2287
// Class AMP_Base_Sanitizer
if ( ! class_exists('AMP_Base_Sanitizer') && class_exists('AMPforWP\\AMPVendor\\AMP_Base_Sanitizer') ) {
	abstract class AMP_Base_Sanitizer extends AMPforWP\AMPVendor\AMP_Base_Sanitizer
	{

	}
}
// Class AMP_Base_Embed_Handler
if ( ! class_exists('AMP_Base_Embed_Handler') && class_exists('AMPforWP\\AMPVendor\\AMP_Base_Embed_Handler') ) {
	abstract class AMP_Base_Embed_Handler extends AMPforWP\AMPVendor\AMP_Base_Embed_Handler
	{
 	}
}
// Class AMP_HTML_Utils
if ( ! class_exists('AMP_HTML_Utils') && class_exists('AMPforWP\\AMPVendor\\AMP_HTML_Utils') ) {
	class AMP_HTML_Utils extends AMPforWP\AMPVendor\AMP_HTML_Utils{}
}
// Class AMP_DOM_Utils
if ( ! class_exists('AMP_DOM_Utils') && class_exists('AMPforWP\\AMPVendor\\AMP_DOM_Utils') ) {
	class AMP_DOM_Utils extends AMPforWP\AMPVendor\AMP_DOM_Utils{}
}
// Function is_amp_endpoint
add_action('pre_amp_render_post', 'ampforwp_is_amp_endpoint_old');
if ( !function_exists('ampforwp_is_amp_endpoint_old') ) {
	function ampforwp_is_amp_endpoint_old(){
		if ( !function_exists('amp_activate') && ! function_exists('is_amp_endpoint') ){
			function is_amp_endpoint(){
				return ampforwp_is_amp_endpoint();
			}
		}
		// Class AMP_Post_Template
		if ( ! class_exists('AMP_Post_Template') && class_exists('AMPforWP\\AMPVendor\\AMP_Post_Template') ) {
			class AMP_Post_Template extends AMPforWP\AMPVendor\AMP_Post_Template{}
		}
	}
}
// End Fallbacks for Vendor AMP

// ampforwp_post_template_data filter #2287
add_filter('amp_post_template_data', 'ampforwp_post_template_data');
function ampforwp_post_template_data( $data ) {
	// Run through our filter 
	$data = apply_filters('ampforwp_post_template_data', $data );
	return $data;
} 

if(false==ampforwp_get_setting('hide-amp-version-from-source')){
	add_action('amp_meta','ampforwp_generator');
	if ( ! function_exists('ampforwp_generator') ) {
	function ampforwp_generator(){
		if(true == ampforwp_get_setting('ampforwp-amp-convert-to-wp')){
		?>
		<meta name="generator" content="AMP for WP <?php echo esc_attr(AMPFORWP_VERSION)?>" />
	<?php } 
		}
	} 
}

// #2497 Ivory Search Compatibility Added
add_filter('ampforwp_menu_content','ampforwp_modify_ivory_search');
if( ! function_exists(' ampforwp_modify_ivory_search ') ){
	function ampforwp_modify_ivory_search($menu){
		$dom 		= '';
		$nodes 		= '';
		$num_nodes 	= '';
		if( !empty( $menu ) ){
			// Create a new document
			$dom = new DOMDocument();
			if( function_exists( 'mb_convert_encoding' ) ){
				$menu = mb_convert_encoding($menu, 'HTML-ENTITIES', 'UTF-8');			
			}
			else{
				$menu =  preg_replace( '/&.*?;/', 'x', $menu ); // multi-byte characters converted to X
			}
			// To Suppress Warnings
			libxml_use_internal_errors(true);
			$dom->loadHTML($menu);
			libxml_use_internal_errors(false);
			// get all the forms
			$nodes 		= $dom->getElementsByTagName( 'form' );
			$num_nodes 	= $nodes->length;
			for ( $i = $num_nodes - 1; $i >= 0; $i-- ) {
				$node 	= $nodes->item( $i );
				// Set The Width and Height if there in none
				if ( '' === $node->getAttribute( 'target' ) ) {
					$node->setAttribute('target', '_top');
				}
				if ( $node->getAttribute('action')){
					$action_url = '';
					$action_url = $node->getAttribute('action');
					$action_url = preg_replace('#^http?:#', '', $action_url);
					$node->setAttribute('action', $action_url);
				}
			}
			$menu = $dom->saveHTML();
		}
		return $menu;
	}
} 
add_action('amp_post_template_css','ampforwp_ivory_search_css');
function ampforwp_ivory_search_css(){
	if(class_exists('Ivory_Search')){?>
		svg.icon.icon-search {
		    display: none;
		}
		input.search-field {
		    display: inline-block;
		}
		svg.search-icon {
		    display: none;
		}
<?php } }
// Font Awesome Icons added for Swift
add_action('amp_post_template_head', 'ampforwp_fontawesome_canonical_link');
function ampforwp_fontawesome_canonical_link(){ 
  if ( ampforwp_get_setting('ampforwp_font_icon') == 'fontawesome-icons' ){ ?>
  		<link rel="preconnect dns-prefetch" href="//use.fontawesome.com" crossorigin>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <?php }
    }
add_action('amp_post_template_head', 'ampforwp_set_dns_preload_urls');
function ampforwp_set_dns_preload_urls(){
	// Open graph tag is not loading from the SEO framework #4399
	if (function_exists('the_seo_framework') && 'seo_framework' == ampforwp_get_setting('ampforwp-seo-selection')) {
		$og_tsf = \the_seo_framework();
		if($og_tsf){
			echo $og_tsf->og_image();
			echo $og_tsf->og_locale();
			echo $og_tsf->og_type();
			echo $og_tsf->og_title();
			echo $og_tsf->og_image();
			echo $og_tsf->og_description();
			echo $og_tsf->og_sitename();
		}
	}

	$prefetch = ampforwp_get_setting('amp-prefetch-options');
	$data_arr = array();
	if(is_array($prefetch)){
	    foreach ( $prefetch as $k => $value ) {
	    	if(is_array($value)){
		        foreach ($value as $tk => $tval) {
		            $temp_arr = array();
		            $temp_arr['name'][] = $k;
		            $temp_arr['type'][] = $tk;
		            foreach ($tval as $ck => $cval) {
		                $temp_arr['value'][] = $cval;
		            }
		            $data_arr[] = $temp_arr; 
		        }
		    }
	    }
	    if(isset($data_arr[0]) && !empty($data_arr)){
	        $val_count = count($data_arr[0]['value']);
	        for($i=0;$i<$val_count;$i++){
	            for($j=0;$j<count($data_arr);$j++){
	                if(isset($data_arr[$j]['value'][$i])){
	            		$key 	= $data_arr[$j]['value'][$i];
	            	}
	                if(isset($data_arr[$j+1])){
	               	 	$key 	= $data_arr[$j]['value'][$i];
	               	if(isset($data_arr[$j]['value'][$i])){
	               	 	$value 	= $data_arr[$j+1]['value'][$i];
	               	}
	               	 	if($value!=""){
	               	 		?>
	               	 		<link rel="<?php echo esc_attr($key)?>" href="<?php echo esc_url($value);?>" crossorigin>
	               	 		<?php
	               	 	}
	               	}
	            }
	        }
	    }
	}
}
// Yoast BreadCrumbs #1473
add_action('pre_amp_render_post', 'ampforwp_yoast_breadcrumbs');
if ( ! function_exists('ampforwp_yoast_breadcrumbs') ) {
	function ampforwp_yoast_breadcrumbs(){
		if ( ampforwp_get_setting('ampforwp-yoast-bread-crumb') ) {
			// Remove the separator of Yoast
			add_filter('wpseo_breadcrumb_separator','ampforwp_yoast_breadcrumbs_sep');
			function ampforwp_yoast_breadcrumbs_sep($sep) {
				$sep = '';
				return $sep;
			}
			// Remove xmlns:v to avoid validation error
			add_filter('wpseo_breadcrumb_output','ampforwp_yoast_breadcrumbs_modified_output');
			function ampforwp_yoast_breadcrumbs_modified_output($output){
				$output = str_replace('xmlns:v="http://rdf.data-vocabulary.org/#"', '', $output);
				return $output;
			}
			// Change the wrapper to div
			add_filter('wpseo_breadcrumb_output_wrapper', 'ampforwp_yoast_breadcrumbs_wrapper');
			function ampforwp_yoast_breadcrumbs_wrapper($wrap) {
				$wrap = 'div';
				return $wrap;
			}
			// Add the Breadcrumbs class to wrapper
			add_filter('wpseo_breadcrumb_output_class','ampforwp_yoast_breadcrumbs_wrapper_class');
			function ampforwp_yoast_breadcrumbs_wrapper_class($class) {
				$class = 'breadcrumbs';
				return $class;
			}
		}
	}
}
function ampforwp_yoast_breadcrumbs_output(){
	if ( class_exists('WPSEO_Options') && method_exists('WPSEO_Options', 'get') ){
		$breadcrumb = '';
		if ( true == ampforwp_get_setting('ampforwp-yoast-bread-crumb') && true === WPSEO_Options::get( 'breadcrumbs-enable' ) && function_exists('yoast_breadcrumb')) {
			$breadcrumb = yoast_breadcrumb('','', false);
			if( true == ampforwp_get_setting('convert-internal-nonamplinks-to-amp') && preg_match('/<a\s+href="(.*?)">(.*?)<\/a>/', $breadcrumb)){
			   $breadcrumb = preg_replace('/<a\s+href="(.*?)\/">(.*?)<\/a>/', '<a href="$1/'.user_trailingslashit(AMPFORWP_AMP_QUERY_VAR).'">$2</a>', $breadcrumb);
		     }
			return $breadcrumb;
		}
	}
}

// Slide Anything compatibility #2891
add_filter('amp_content_embed_handlers','ampforwp_slide_anything_embed');
function ampforwp_slide_anything_embed($data) {
	if ( function_exists('cpt_slider_plugin_activation') ) {
		require_once( AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-slide-anything-embed.php' );
		$data['AMPFORWP_Slide_Anything_Embed_Handler'] = array();
	}
	return $data;
}

// Revolution Slider compatibility #1464
add_action('pre_amp_render_post', 'ampforwp_initialise_rev_slider');
if ( ! function_exists('ampforwp_initialise_rev_slider') ) {
	function ampforwp_initialise_rev_slider(){
		if ( class_exists('RevSliderOutput') ){
			require AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-rev-slider.php';
		}
	}
}
add_filter('amp_content_embed_handlers','ampforwp_rev_slider_embed');
function ampforwp_rev_slider_embed($data) {
	if ( class_exists('RevSliderOutput') ){
		$data['AMP_Rev_Slider_Embed_Handler'] = array();
	}
	return $data;
}
// Photo Gallery by 10Web Compatibility #1811
add_action('pre_amp_render_post', 'ampforwp_initialise_photo_gallery');
if ( ! function_exists('ampforwp_initialise_photo_gallery') ) {
	function ampforwp_initialise_photo_gallery(){
		if ( class_exists('BWG') ) {
			require AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-photo-gallery-embed.php';
		}
	}
}
add_filter('amp_content_embed_handlers','ampforwp_photo_gallery_embed');
function ampforwp_photo_gallery_embed($data) {
	if ( class_exists('BWG') ) {
		$data['AMPforWP_Photo_Gallery_Embed_Handler'] = array();
	}
	return $data;
}
function ampforwp_rel_attributes_social_links(){ 
	$rel_attributes = array(); 
	if (true == ampforwp_get_setting('ampforwp-social-no-follow')) {
    	$rel_attributes[] = 'nofollow';
	}
	if (true == ampforwp_get_setting('ampforwp-social-no-referrer')) {
    	$rel_attributes[] = 'noreferrer';
	}
	if (true == ampforwp_get_setting('ampforwp-social-no-opener')) {
    	$rel_attributes[] = 'noopener';
	}
	$rel_attributes = apply_filters('ampforwp_rel_attributes_social_links', $rel_attributes);
	$rel_attributes = array_map('esc_attr', $rel_attributes);
	if ( $rel_attributes ) {
		echo 'rel="' . implode(" ",$rel_attributes).'"';
	}
	return;
}
// Fallback added
function ampforwp_nofollow_social_links(){
	ampforwp_rel_attributes_social_links();
	return ;
}

function ampforwp_nofollow_notification(){
	if(true == ampforwp_get_setting('ampforwp-notifications-nofollow')){
		echo 'rel=nofollow';
		return;
	}
	return false;
}
// Featured Video SmartMag theme Compatibility CSS #2559
add_action('amp_post_template_css', 'ampforwp_featured_video_plus_css');
function ampforwp_featured_video_plus_css(){ 
	if( function_exists('get_the_post_video') ) {?>
		.fvp-onload{display:none}
<?php }
	if(class_exists('Bunyad')){ ?>
		.amp-featured-image amp-iframe, .amp-wp-article-featured-image amp-iframe { margin:auto; height:100%; }
		.f_vid { background: #000; }
<?php }
}
function ampforwp_webp_featured_image() {
	$post_id = ampforwp_get_the_ID();

	if ( ! has_post_thumbnail( $post_id )) {
		return false;
	}

	$thumb_id = get_post_thumbnail_id($post_id);
	$image_size = apply_filters( 'ampforwp_featured_image', 'full' ); 
	$image = wp_get_attachment_image_src( $thumb_id, $image_size );
		if( $image ) {	
			if(empty($image[1])){
			$image[1] = 750;
			}
			if(empty($image[2])){
			$image[2] = 500;
			}
		$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
			if($thumb_alt){
				$alt = $thumb_alt;
			}
			else{
				$alt = get_the_title( $post_id );
			}
			$alt = convert_chars( stripslashes( $alt ) );
		$image_output = "<amp-img src='".esc_url($image[0])."' width='".esc_attr($image[1])."' height='".esc_attr($image[2])."' layout='responsive' alt='".esc_attr($alt)."' ></amp-img>";?>
			<?php 
			if(1 == ampforwp_get_setting('amp-design-selector') || 2 == ampforwp_get_setting('amp-design-selector') || 3 == ampforwp_get_setting('amp-design-selector')){?>
			<figure class="amp-wp-article-featured-image">	
				<?php echo $image_output; // escaped above
			?>
			</figure>
		<?php }
	}
}

// Keep the default WordPress form for AMP #3000
add_filter('get_search_form', 'ampforwp_search_form');
if ( ! function_exists('ampforwp_search_form') ) {
	function ampforwp_search_form($form){
		if ( ampforwp_is_amp_endpoint() ) {
		$placeholder = ampforwp_translation(ampforwp_get_setting('ampforwp-search-placeholder'), 'Type Here' );
		if (function_exists('pll__')) {
			$placeholder = pll__(esc_html__( ampforwp_get_setting('ampforwp-search-placeholder'), 'accelerated-mobile-pages'));
		}
		$widgetlabel = ampforwp_translation(ampforwp_get_setting('ampforwp-search-widget-label'), 'Search for:' );	
			$form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" target="_top">
					<label>
						<span class="screen-reader-text">' . esc_html__( $widgetlabel, 'accelerated-mobile-pages' ) . '</span>
						<input type="text" value="" placeholder="' . esc_html__( $placeholder, 'accelerated-mobile-pages' ) . '" name="s" class="search-field">
					</label>
					<input type="text" placeholder="' . esc_html__( $placeholder, 'accelerated-mobile-pages' ) . '" value="1" name="amp" class="hide" id="ampforwp_search_query_item">
				</form>';
		}
		return $form;
	}
}

//Saving all taxonomies in Transient
add_action('init','ampforwp_generate_taxonomies_transient');
function ampforwp_generate_taxonomies_transient(){
	$taxonomies = get_transient('ampforwp_get_taxonomies');
	$tax_arr = array();
	$args = array(
		  		'public'   => true,
		  		'_builtin' => false,  
		); 
	$output = 'objects'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$alltaxonomies = get_taxonomies( $args, $output, $operator );
	if  ($alltaxonomies) {
		foreach ($alltaxonomies as $taxKey => $taxVal) {
			$tax_arr[$taxVal->name] = $taxVal->labels->singular_name;
		}
	}
	if ( false == $taxonomies ) {
		set_transient('ampforwp_get_taxonomies',$tax_arr);
	}else{
		if(count($tax_arr) > count($taxonomies)){
			$result = array_diff_assoc($tax_arr,$taxonomies);
		}elseif( count($taxonomies) > count($tax_arr)){
			$result = array_diff_assoc($taxonomies,$tax_arr);
		}
		if( !empty($result)){
			delete_transient('ampforwp_get_taxonomies');
		}
	}
	return $taxonomies;
}

// Include Opengraph.php #3261
add_action('pre_amp_render_post', 'ampforwp_include_opengraph');
if ( ! function_exists('ampforwp_include_opengraph') ) {
  function ampforwp_include_opengraph(){
    if ( true == ampforwp_get_setting('ampforwp-seo-og-meta-tags') && '' == ampforwp_get_setting('ampforwp-seo-selection') ) {
      require_once AMPFORWP_PLUGIN_DIR."includes/features/opengraph.php";
    }
  }
}

add_action('wp_ajax_ampforwp_import_file_from_file','ampforwp_import_settings_from_file');
function ampforwp_import_settings_from_file(){
	$security = $_POST['security'];
	if ( wp_verify_nonce( $security, 'ampforwp_import_file' ) && current_user_can( 'manage_options' ) ) {
		if(isset($_FILES["file"]["tmp_name"])){
			$content = file_get_contents($_FILES["file"]["tmp_name"]);
			if ( ! empty ( $content ) ) {
				$imported_options = json_decode( $content, true );
			}
			$plugin_options = get_option('redux_builder_amp');
			if ( ! empty ( $imported_options ) && is_array( $imported_options ) && isset ( $imported_options['redux-backup'] ) && $imported_options['redux-backup'] == '1' ) {
				echo $content;
			}
		}
	}
}

add_filter('ampforwp_loop_image_update','ampforwp_recentpost_link_to_nonamp');
function ampforwp_recentpost_link_to_nonamp($image_link_data){
	if( true == ampforwp_get_setting('ampforwp-recentpost-posts-link') ){
		$image_link_data['image_link'] = get_permalink();
	}else{
		$image_link_data['image_link'] = ampforwp_url_controller( get_permalink() ) ;
	}
	return $image_link_data;
}
#3596 link to nonamp option on title for recent posts
add_filter('ampforwp_loop_permalink_update','ampforwp_recentpost_title_link_to_nonamp');
function ampforwp_recentpost_title_link_to_nonamp($title_link){
	if( true == ampforwp_get_setting('ampforwp-recentpost-posts-link') ){
		$title_link  = get_permalink();
	}else{
		$title_link  = ampforwp_url_controller( get_permalink() ) ;
	}
	return $title_link;
}

// Post Meta Revisions #3548 -- start here --
add_filter( '_wp_post_revision_field_amp_page_builder', 'ampforwp_meta_revi_pb_field', 22, 2 );
add_action( 'save_post',                   'ampforwp_meta_revi_save_post', 10, 2 );
add_action( 'wp_restore_post_revision',    'ampforwp_meta_restore_revision', 10, 2 );
add_filter( '_wp_post_revision_fields',    'ampforwp_meta_revi_fields' );
// Displaying the meta field on the revisions screen
function ampforwp_meta_revi_fields( $fields ) {
	$fields['post_title'] = 'Title';
	$fields['post_content'] = 'Content';
	$fields['post_excerpt'] = 'Excerpt';
	$fields['amp-page-builder'] = 'AMP Page Builder';
	return $fields;
}
// Displaying the meta field on the revisions screen
function ampforwp_meta_revi_pb_field( $value, $field ) {
	global $revision;
	return get_metadata( 'post', $revision->ID, $field, true );
}
// Reverting to the correct revision of the meta field when a post is reverted
function ampforwp_meta_restore_revision( $post_id, $revision_id ) {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}
	$post     = get_post( $post_id );
	$revision = get_post( $revision_id );
	$meta     = get_metadata( 'post', $revision->ID, 'amp-page-builder', true );
	if ( false === $meta ) {
		delete_post_meta( $post_id, 'amp-page-builder' );
	}
	else{
		update_post_meta( $post_id, 'amp-page-builder', $meta );
	}
}
// Storing a revision of the meta field when a post is saved
function ampforwp_meta_revi_save_post( $post_id, $post ) {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$parent = get_post( $parent_id );
		$pb_meta = get_post_meta( $parent->ID, 'amp-page-builder', true );
		if ( false !== $pb_meta ){
			add_metadata( 'post', $post_id, 'amp-page-builder', $pb_meta );
		}
	}
}
// Post Meta Revisions #3548 -- end here --


// FOR ADMIN MENU BAR
add_action( 'pre_amp_render_post', 'ampforwp_front_admin_menu_bar' );
function ampforwp_front_admin_menu_bar(){
	if( is_user_logged_in() ){
		$pref = get_user_option( "show_admin_bar_front", get_current_user_id() );
		if($pref==="true"){
			if(class_exists('QM_Plugin') && class_exists('QM_Dispatchers') && ampforwp_get_setting('ampforwp-query-monitor')){
				$dis = QM_Dispatchers::get( 'html' );
				if($dis->did_footer==false){
					$dis->did_footer = true;
					add_action( 'amp_post_template_head', 'ampforwp_query_monitor_script'  );
					add_action( 'amp_post_template_head',  'ampforwp_manual_qm_script', 11 );
				}
			}
			add_action("ampforwp_admin_menu_bar_front", function(){
				add_action('wp_before_admin_bar_render','ampforwp_add_admin_menu_front');
		    	wp_admin_bar_render();
			});
			add_action( 'admin_bar_init', 'ampforwp_init_admin_bar');
			add_action( 'wp_before_admin_bar_render','ampforwp_remove_before_admin_bar_redner',9);
			add_action( 'admin_bar_menu',  'ampforwp_remove_admin_menu_front',999);
			add_action('amp_post_template_css', 'ampforwp_head_css'); 
			
		}
	}
}
function ampforwp_remove_before_admin_bar_redner(){
	remove_action( 'wp_before_admin_bar_render', 'wp_customize_support_script' );
}
function ampforwp_init_admin_bar(){
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
 	remove_action( 'wp_head', 'wp_admin_bar_header' );
}
global $wp_filesystem;
function ampforwp_head_css(){
		global  $ampforwpTemplate, $redux_builder_amp, $wp_filesystem;
		$css = "";
		if( is_user_logged_in() ){
			$pref = get_user_option( "show_admin_bar_front", get_current_user_id() );
			if($pref==="true"){
				require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
		    	require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
			 	$wp_filesystem = new WP_Filesystem_Direct( array() );
				if(ampforwp_get_setting('ampforwp_css_tree_shaking')==1){
					if(ampforwp_is_home()){
						$tscss = "home";
					}elseif(ampforwp_is_blog()){
						$tscss = "blog";
					}elseif(ampforwp_is_front_page()){
						$tscss = "post-".ampforwp_get_frontpage_id();
					}elseif(is_singular()){
						$tscss = "post-".ampforwp_get_the_ID();
					}elseif(is_archive()){
	                    $page_id = get_queried_object_id();
	                    $tscss = "archive-".intval($page_id);
	                }
					$tscss = $tscss.'-admin';
					$upload_dir = wp_upload_dir(); 
			        $ts_file = esc_attr($upload_dir['basedir']) . '/' . 'ampforwp-tree-shaking/_transient_'.esc_attr($tscss).".css";
			        if(file_exists($ts_file)){
			        	 $css = $wp_filesystem->get_contents($ts_file);
			        	 if(preg_match("/#wpadminbar/", $css)==0){
			        	 	$user_dirname = $upload_dir['basedir'] . '/' . 'ampforwp-tree-shaking';
			        	   if(file_exists($user_dirname)){
					            $files = glob($user_dirname . '/*');
					            foreach($files as $file){
					                if(is_file($file) && strpos($file, '_transient')!==false ){
					                    unlink($file);
					                }
					            }
					        }
					    }
			        }
		   		}
				$css = $wp_filesystem->get_contents(AMPFORWP_PLUGIN_DIR."/templates/template-mode/admin-bar.css");
				$incurl = includes_url();
				$incurl = trailingslashit($incurl) .'fonts/dashicons.ttf?50db0456fde2a241f005968eede3f987';
				$css.='@font-face{font-family:dashicons;src:url('.$incurl.'/fonts/dashicons.ttf?50db0456fde2a241f005968eede3f987) format("truetype");
				font-weight:400;font-style:normal}
				#wp-admin-bar-my-account .avatar{float:right;margin-top:7px;margin-left:5px;height:18px;width:18px;border:1px solid #82878c}#wp-admin-bar-wpseo-notifications .yoast-issue-counter{float:right}@media(max-width:782px){#wpadminbar~header #headerwrap{top:46px}}';
				if(ampforwp_get_setting('amp-design-selector')!=3){
					$css.='#wpadminbar~header{margin-top:32px}@media(max-width:782px){#wpadminbar~header{margin-top:46px}}';
				}else{
					$css.='#wpadminbar~header #headerwrap{top:32px}@media(max-width:782px){#wpadminbar~header #headerwrap{margin-top:46px}}';
				}
				echo ampforwp_css_sanitizer($css);
			}
		}
	}
	function ampforwp_css_sanitizer($css){
		$css = preg_replace( '/\s*!important/', '', $css, -1, $important_count );
		$css = preg_replace( '/overflow(-[xy])?\s*:\s*(auto|scroll)\s*;?\s*/', '', $css, -1, $overlow_count );
            $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}', '::-' ), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ', ', '}', ' ::-'), $css);
		return $css;
	}
	function ampforwp_get_remote_content($src){
		if($src){
			$arg = array( "sslverify" => false, "timeout" => 60 ) ;
			$response = wp_remote_get( $src, $arg );
	        if ( wp_remote_retrieve_response_code($response) == 200 && is_array( $response ) ) {
	          $header = wp_remote_retrieve_headers($response); // array of http header lines
	          $contentData =  wp_remote_retrieve_body($response); // use the content
	          return $contentData;
	        }
		}else{
			return $contentData = file_get_contents( $src );
		}
	    return '';
	}
	function ampforwp_add_admin_menu_front(){
		global $wp_admin_bar;
		$dom = new DOMDocument();
		$my_account = $wp_admin_bar->get_node('my-account');
		$title = '';
		if(is_object($my_account)){
		 	$title = ampforwp_content_sanitizer($my_account->title);
		}
		$wp_admin_bar->add_menu( array(
	        'id'        => 'my-account',
	        'title'      => $title
		) );
		$user_info = $wp_admin_bar->get_node('user-info');
		if(is_object($user_info)){
			$title = $user_info->title;
		}
		if($title){
			// To Suppress Warnings
       		libxml_use_internal_errors(true);
			$dom->loadHTML($title);
			libxml_use_internal_errors(false);
			$anchors = $dom -> getElementsByTagName('img'); 
			$src="";
			foreach($anchors as $im){
				$src = $im->getAttribute('src'); 
			}
			$authname = get_the_author_meta('nickname');
			$title = '<span style="background: url('.esc_url($src).');background-repeat: no-repeat;height: 64px;position: absolute;width: 100px;top: 13px;left: -70px;" class="display-name"></span><span class="display-name">'.esc_html__($authname,'accelerated-mobile-pages').'<span>';
			$wp_admin_bar->add_menu( array(
			        'id'        => 'user-info',
			        'title'      => $title
			  ) );
			if(class_exists('WPSEO_Options')){
				$wp_admin_bar->add_menu( array(
				        'id'        => 'wpseo-menu',
				        'title'      => "SEO"
				) );
			}
			$wp_admin_bar->remove_menu( 'ampforwp-view-amp' );
			if(function_exists('autoptimize_autoload')){
				$wp_admin_bar->remove_menu( 'autoptimize' );
			}
			if (is_preview()) {
				$url = get_preview_post_link();
				$wp_admin_bar->add_node(array(
					'id'    => 'ampforwp-view-non-amp',
					'title' => 'View Non-AMP',
					'href'  => esc_url($url)
					));
			} 
			else{
				$url = ampforwp_get_non_amp_url();
				$wp_admin_bar->add_node(array(
					'id'    => 'ampforwp-view-non-amp',
					'title' => 'View Non-AMP' ,
					'href'  =>  esc_url($url)
				));
			} 
		}
	}
	
	function ampforwp_remove_admin_menu_front($wp){
		$node_arr = ['search','admin-bar-likes-widget'];
		for($i=0;$i<count($node_arr);$i++){
			$wp->remove_node($node_arr[$i]);
		}
	}
	function ampforwp_manual_qm_script() {
		wp_print_scripts( array(
			'query-monitor',
		) );
		wp_print_styles( array(
			'query-monitor',
		) );
	}
	function ampforwp_query_monitor_script() {
		global $wp_locale;
		$qm = plugins_url();
		$deps = array(
				'jquery',
			);

			if ( defined( 'QM_NO_JQUERY' ) && QM_NO_JQUERY ) {
				$deps = array();
			}

			$css = 'query-monitor';
			if ( method_exists( 'Dark_Mode', 'is_using_dark_mode' ) && is_user_logged_in() ) {
				if ( Dark_Mode::is_using_dark_mode() ) {
					$css .= '-dark';
				}
			} elseif ( defined( 'QM_DARK_MODE' ) && QM_DARK_MODE ) {
				$css .= '-dark';
			}

			wp_enqueue_style(
				'query-monitor',
				esc_attr($qm)."/query-monitor/assets/{$css}.css",
				array( 'dashicons' )
			);
			wp_enqueue_script(
				'query-monitor',
				esc_attr($qm).'/query-monitor/assets/query-monitor.js',
				$deps,
				false
			);
			wp_localize_script(
				'query-monitor',
				'qm_number_format',
				$wp_locale->number_format
			);
			wp_localize_script(
				'query-monitor',
				'qm_l10n',
				array(
					'ajax_error' => __( 'PHP Errors in Ajax Response', 'query-monitor' ),
					'ajaxurl'    => admin_url( 'admin-ajax.php' ),
					'auth_nonce' => array(
						'on'         => wp_create_nonce( 'qm-auth-on' ),
						'off'        => wp_create_nonce( 'qm-auth-off' ),
						'editor-set' => wp_create_nonce( 'qm-editor-set' ),
					),
				)
			);
	}
	function ampforwp_get_non_amp_url(){
		global $post, $wp;
	  	$nofollow = $page = $amp_url = $non_amp_url = '';
	   	if( true == ampforwp_get_setting('ampforwp-nofollow-view-nonamp') ){
	   		$nofollow = 'rel=nofollow';
	   	}
		$amp_url = untrailingslashit( home_url( $wp->request ) );
		$amp_url = explode('/', $amp_url);
		$amp_url = array_flip($amp_url);
		unset($amp_url[AMPFORWP_AMP_QUERY_VAR]);
		$non_amp_url = array_flip($amp_url);
		$non_amp_url = implode('/', $non_amp_url);
		$query_arg_array 	= $wp->query_vars;
		
		if( array_key_exists( "page" , $query_arg_array  ) ) {
			$page = $wp->query_vars['page'];
		}
		if ( $page >= '2') { 
			$non_amp_url = trailingslashit( $non_amp_url  . '?page=' . $page);
		} 
		if ( ampforwp_get_setting('amp-mobile-redirection') == true && ampforwp_get_setting('amp-mob-redirection-pres-link') == false) {
			$non_amp_url = add_query_arg('nonamp','1',$non_amp_url);
		}
		else
			$non_amp_url = user_trailingslashit($non_amp_url);
	   	$mob_pres_link = false;
	  	if(function_exists('ampforwp_mobile_redirect_preseve_link')){
	    	$mob_pres_link = ampforwp_mobile_redirect_preseve_link();
	  	}
	   	if ( true == ampforwp_get_setting('ampforwp-amp-takeover') || $mob_pres_link == true) {
	   		$non_amp_url = '';
	   	}
		if ( $non_amp_url ) {
			return apply_filters('ampforwp_view_nonamp_url', $non_amp_url);
		}
}
add_action( 'wp_ajax_ampforwp_set_option_panel_view', 'ampforwp_set_option_panel_view' );
function ampforwp_set_option_panel_view(){
	if(!is_admin() && !current_user_can('manage_options')){
		return ;
	}
	if(!wp_verify_nonce($_POST['verify_nonce'],'ampforwp-verify-request') ){
		echo json_encode(array('status'=>403,'message'=>'user request is not allowed')) ;
		die;
	}
	$opt_type = intval($_POST['option_type']);
	if($opt_type==1 || $opt_type==2){
		$opt = get_option("ampforwp_option_panel_view_type");
		if($opt){
			update_option("ampforwp_option_panel_view_type", $opt_type);
		}else{
			add_option("ampforwp_option_panel_view_type", $opt_type);
		}
	}
}
add_action('admin_head', 'ampforwp_remove_admin_help');
if(!function_exists('ampforwp_remove_admin_help')){
	function ampforwp_remove_admin_help(){
		if(!is_admin() && !current_user_can('manage_options')){
			return ;
		}
		$screen = get_current_screen();
		if ( 'toplevel_page_amp_options' == $screen->base ) {
			$screen->remove_help_tabs();
		}
	}
}

if(!function_exists('ampforwp_sassy_icon_style')){
	function ampforwp_sassy_icon_style(){
		global $wp_filesystem;
		$css = get_transient('ampforwp_sassy_css');
		if($css == false){
			if(!is_object($wp_filesystem)){
				require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
    			require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
    			$wp_filesystem = new WP_Filesystem_Direct( array() );
    		}
			$css = $wp_filesystem->get_contents(AMPFORWP_PLUGIN_DIR."/includes/sassy-style.css");
			set_transient('ampforwp_sassy_css', $css);
		}
		echo ampforwp_css_sanitizer($css);
	}
}	
if(function_exists('heateor_sss_run')){
	add_action('amp_post_template_css', 'ampforwp_sassy_icon_style'); 
}	
function ampforwp_nofollow_cta_header_link(){
	if(true == ampforwp_get_setting('ampforwp-header-cta-link-nofollow')){	
		echo 'rel=nofollow';
		return;
	}
	return false;
}	

// Generating canonical url when FlexMLS plugin is active.
if(class_exists('flexmlsConnectPageSearchResults')){
   add_action('pre_amp_render_post','ampforwp_flexmls_canonical');
}
function ampforwp_flexmls_canonical(){
   add_filter('wpseo_canonical','ampforwp_flexmls_generate_canonical_url',99,2);
}

function ampforwp_flexmls_generate_canonical_url($canonical,$object){
   $canonical = $object->model->permalink;
   return esc_url($canonical);
}
// Font Selector
if( ! function_exists('ampforwp_font_selector') ) {
	function ampforwp_font_selector( $container ) {
		global $redux_builder_amp;
		$fontFamily = '';
		if(1==ampforwp_get_setting('ampforwp-google-font-switch')){
			return sanitize_text_field($fontFamily);
		}
		if(empty($container)) {
			$container = 'body';
		}
		if ( 'content' == $container && ampforwp_get_setting('amp_font_selector_content_single') && 1 != ampforwp_get_setting('amp_font_selector_content_single') ) {
			$fontFamily = "font-family: '".ampforwp_get_setting('amp_font_selector_content_single')."';"; 
		}
		if ( 'body' == $container && ampforwp_get_setting('amp_font_selector') && 1 != ampforwp_get_setting('amp_font_selector') ) {
			$fontFamily = "font-family: '".ampforwp_get_setting('amp_font_selector')."'";
		}
		return sanitize_text_field($fontFamily);
	}
}
if(class_exists('WPSEO_Options')){
	add_filter('ampforwp_the_content_last_filter','ampforwp_remove_duplicate_canonical',25);
}
function ampforwp_remove_duplicate_canonical($content){
	if( class_exists( 'DOMDocument' ) && ! empty( $content ) && is_string( $content ) ){
		$comp_dom = new DOMDocument();
		@$comp_dom->loadHTML($content);
		$xpath = new DOMXPath( $comp_dom );
	    $count = 0;
	    $nodes = $xpath->query('//link[@rel="canonical"]');
	    $con = '';
	    foreach ($nodes as $node) {
	    	$count++;
	    }
	    if($count>1){
	    	 if(preg_match("/<link\b[^>]*?\brel=[\'\"]canonical[\'\"][^>]*>/", $content, $matches, PREG_OFFSET_CAPTURE)){
			    $content = preg_replace("/<link\b[^>]*?\brel=[\'\"]canonical[\'\"][^>]*>/", "", $content);
			    $content = substr_replace($content, $matches[0][0], $matches[0][1], 0);
			}
	    }
  }
	return $content;
}
// Font URL controller
if ( ! function_exists('ampforwp_font_url') ) {
	function ampforwp_font_url($font_url){
		return apply_filters('ampforwp_font_url', $font_url);
	}
}
//Need to add full short pixel plugin compatibility #3782
if(class_exists('ShortPixelAPI')){
	add_filter( 'ampforwp_the_content_last_filter','ampforwp_short_pixel_cdn');
}
function ampforwp_short_pixel_cdn($content){
	$api_url = get_option('spai_settings_api_url');
	$compress_level = get_option('spai_settings_compress_level');
	if('0'== $compress_level){
		$compress_level = '+q_lossless';
	}
	if('1'== $compress_level){
		$compress_level = '+q_lossy';
	}
	if('2'== $compress_level){
		$compress_level = '+q_glossy';
	}
	$compress_level .= '+ret_img+to_webp/';
	if(!empty($api_url)){
		$content = preg_replace('/<amp-img(.*?)src="([^"]*)"(.*?)width="([^"]*)" height="([^"]*)"([^>]*)>/','<amp-img$1 src="'.$api_url.'/w_$4'.$compress_level.'$2"$3 width="$4" height="$5"$6>',$content);
	}
	return $content;
}
if(ampforwp_get_setting('ampforwp_css_tree_shaking') == true && ampforwp_is_gutenberg_active()){
	add_action('amp_post_template_css','ampforwp_gutenberg_block_styles');
}
if(!function_exists('ampforwp_gutenberg_block_styles')){
	function ampforwp_gutenberg_block_styles(){
		$gutenberg_styles = $block_css = '';
		ob_start();
		wp_print_styles('wp-block-library');
		$block_css .= ob_get_contents();
	    ob_end_clean();
	    preg_match("/href='(.*?)'/", $block_css, $matches);
	    $style_path = explode('?', $matches[1]);
	    $gutenberg_styles = get_transient('ampforwp_gutenberg_styles');
	    if($gutenberg_styles == false){
	    $response = wp_remote_get( $style_path[0] );
	    if( is_array( $response ) && ! is_wp_error( $response ) ){
		   		set_transient('ampforwp_gutenberg_styles', $response['body'], 24 * HOUR_IN_SECONDS );
			}
	    }
	    echo ampforwp_css_sanitizer($gutenberg_styles);
	}
}

function ampforwp_is_gutenberg_active() {
	$gutenberg    = false;
	$block_editor = false;
	$use_block_editor = '';
	if ( has_filter( 'replace_editor', 'gutenberg_init' ) ) {
		$gutenberg = true;
	}
	if ( version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' ) ) {
		$block_editor = true;
	}
	if ( ! $gutenberg && ! $block_editor ) {
		return false;
	}
	if ( !class_exists('Classic_Editor') ) {
		return true;
	}
	$use_block_editor = ( get_option( 'classic-editor-replace' ) === 'no-replace' );
	return $use_block_editor;
}

add_filter( 'amp_post_template_data', 'ampforwp_pblayout_head_scripts');
$pb_remove_script = array();
function ampforwp_pblayout_head_scripts($data){
   $postId = ampforwp_get_the_ID();
   $ampforwp_pagebuilder_enable = get_post_meta($postId,'ampforwp_page_builder_enable', true);
   if(isset($ampforwp_pagebuilder_enable) && $ampforwp_pagebuilder_enable=="yes"){
      $previousData = get_post_meta($postId,'amp-page-builder');
      $previousData = isset($previousData[0])? $previousData[0]: null;
      $previousData = (str_replace("'", "&apos;", $previousData));
      $totalRows = 1;
      $totalmodules = 1;
      if(!empty($previousData)){
         $jsonData = json_decode($previousData,true);
         if(count($jsonData['rows'])>0){
            $totalRows = $jsonData['totalrows'];
            $totalmodules = $jsonData['totalmodules'];
            $previousData = json_encode($jsonData);
         }else{
            $jsonData['rows'] = array();
            $jsonData['totalrows']=1;
            $jsonData['totalmodules'] = 1;
            $previousData = json_encode($jsonData);
         }
      }
      $jarr = json_decode($previousData);
      if(isset($jarr->settingdata->scripts_data)){
         $script_data = $jarr->settingdata->scripts_data;
         $content = $data['post_amp_content'];
         $script_slug = '';
         $allscripts = $script_data;
         preg_match_all('/<script(.*?)custom-element=\"(.*?)\"(.*?)src=\"(.*?)\"(.*?)><\/script>/', $allscripts, $matches);
         if($matches){
         	if(isset($matches[2])){
         		$script_slug = $matches[2];
	            foreach ($script_slug as $key => $slug) {
	               if(!preg_match('/'.$slug.'/', $content)){
	                  global $pb_remove_script;
	                  $pb_remove_script[]= esc_attr($slug);
	               }
	            }
	        }
            add_filter( 'ampforwp_the_content_last_filter','ampforwp_remove_unused_pb_amp_script',12);
         }
      }
   }
   return $data;
}
function ampforwp_remove_unused_pb_amp_script($data){
   global $pb_remove_script;
   for($i=0;$i<count($pb_remove_script);$i++){
      $data = preg_replace('/<script(.*?)custom-element=\"'.esc_attr($pb_remove_script[$i]).'\"(.*?)src=\"(.*?)\"(.*?)><\/script>/', '', $data);
   }
   return $data;                 
}

if(class_exists('RankMath')){
	add_filter('ampforwp_modify_the_content','ampforwp_rank_math_nofollow_to_external_link');
}
function ampforwp_rank_math_nofollow_to_external_link($content){
	$rank_math_external_link = RankMath\Helper::get_settings( 'general.nofollow_external_links' );
	if($rank_math_external_link){
		preg_match_all('/<a href="(.*?)">(.*?)<\/a>/', $content, $matches);
		for($i=0;$i<count($matches[1]);$i++){
			$url = $matches[1][$i];
			$is_external = ampforwp_isexternal($url);
			if($is_external){
				$url = esc_url($url);
				$url = str_replace("/", "\/", $url);
				$content = preg_replace('/(<a href="'.$url.'.*")/', '$1 rel="nofollow"', $content);
			}
		}
	}
	return $content;
}

if(class_exists('transposh_plugin')){
	add_action('amp_post_template_css','ampforwp_transposh_plugin_rtl_css');
}
if(!function_exists('ampforwp_transposh_plugin_rtl_css')){
	function ampforwp_transposh_plugin_rtl_css() {
    	 $rtl_lang_arr = array('ar', 'he', 'fa', 'ur', 'yi');
    	 if(isset($_GET['lang'])){
	 		if(in_array(esc_attr($_GET['lang']), $rtl_lang_arr)){
	 			if(ampforwp_get_setting('header-position-type') == '1'){?>
					.tg:checked + .hamb-mnu > .m-ctr {
					    margin-right: 0%;
					}
					.m-ctr{
					    margin-right: -100%;
					    float: left;
					}
					<?php } if(ampforwp_get_setting('header-position-type') == '2'){?>
					.tg:checked + .hamb-mnu > .m-ctr {
					    margin-right: calc(100% - <?php echo esc_html(ampforwp_get_setting('header-overlay-width'))?>);
					}
					.m-ctr{
					    margin-right: 100%;
					    float: right;
					}
					<?php }
	 		}
    	}
    }
}


add_filter('ampforwp_the_content_last_filter','ampforwp_remove_unwanted_code',10);
function ampforwp_remove_unwanted_code($content){
// Mediavine validation issue with form and amp-consent #4206
	if(preg_match('/<amp-consent id="mv-consent" layout="nodisplay">(.*?)<\/amp-consent>/s', $content)){
		$content = preg_replace('/<amp-consent id="mv-consent" layout="nodisplay">(.*?)<\/amp-consent>/s', '', $content);
	}
	if(preg_match('/<form class="mv-create-print-form">(.*?)<\/form>/s', $content)){
		$content = preg_replace('/<form class="mv-create-print-form">(.*?)<\/form>/s', '', $content);
	}
	// close #4206
	// Ticket #4539
	if(function_exists('orbital_setup')){
	    if(preg_match('/<script>function orbital_expand_navbar(.*?)<\/script>/', $content)){
	        $content = preg_replace('/<script>function orbital_expand_navbar(.*?)<\/script>/', '', $content);
	    }
	}
	return $content;
}
add_filter('ampforwp_the_content_last_filter','ampforwp_include_required_scripts',12);
function ampforwp_include_required_scripts($content){
	$allscripts = $is_script = '';
	$comp_to_remove_arr = array();
	preg_match_all('/<\/amp-(.*?)>/', $content, $matches);
	if(isset($matches[1][0])){
		$amp_comp = $matches[1];
		$comp_to_remove_json = get_transient('ampforwp_amp_exclude_custom_element');
		$comp_to_include_json = get_transient('ampforwp_amp_included_custom_element');
		if($comp_to_remove_json){
			$comp_to_remove_arr = json_decode($comp_to_remove_json, true);
		}
		$comp_to_include_arr = array();
		if($comp_to_include_json){
			$comp_to_include_arr = json_decode($comp_to_include_json, true);
		}
		$comp = '';
		for($i=0;$i<count($amp_comp);$i++){
			$comp = $amp_comp[$i];
			if(!preg_match('/story/', $comp)){
				$script_ver = 'latest';
				if($comp == 'auto-ads' || $comp == 'ad'){
					$script_ver = '0.1';
				}
				if($comp=='state'){
					$comp = 'bind';
				}
				$comp_url = 'https://cdn.ampproject.org/v0/amp-'.esc_attr($comp).'-'.esc_attr($script_ver).'.js';
				$is_script = false;
				$check_comp = 'amp-'.esc_attr($comp);
				if(!in_array($comp, $comp_to_remove_arr) && !in_array($comp, $comp_to_include_arr) ){
					$ce_valid_scripts = ampforwp_valid_amp_componet_script();
					$is_script = in_array($check_comp, $ce_valid_scripts);
					if($comp=='state'){
						$is_script = true;
					}
					if($comp=='embed'){
						$is_script = false;
					}
					if($is_script==false){
						if ( ini_get( 'allow_url_fopen' ) ) {
							$headers = get_headers($comp_url);
							if(isset($headers[0])){
								$is_script = stripos($headers[0], "200 OK") ? TRUE : FALSE;
							}
						}
					}
					if($is_script){
						$comp_to_include_arr[] = $comp;
						$inc_json = json_encode($comp_to_include_arr);
						set_transient('ampforwp_amp_included_custom_element',$inc_json, 30 * DAY_IN_SECONDS);
					}else{
						$comp_to_remove_arr[] = $comp;
						$ex_json = json_encode($comp_to_remove_arr);
						set_transient('ampforwp_amp_exclude_custom_element',$ex_json, 30 * DAY_IN_SECONDS);
					}
				}
				$comp_to_include_arr = apply_filters('ampforwp_amp_custom_element_to_include',$comp_to_include_arr);
				if(in_array($comp, $comp_to_include_arr)){
					if(!preg_match('/<script(\s|\sasync\s)custom-element="amp-'.esc_attr($comp).'"(.*?)>(.*?)<\/script>/s', $content, $matches)){
						$script_tag = '<head><script custom-element="amp-'.esc_attr($comp).'" src="'.esc_url($comp_url).'" async></script>';
						$content =  str_replace('<head>', $script_tag, $content);
					}
				}
			}
		}
	}
	if (empty($content)) {
		return '';
	}
	$comp_dom = new DOMDocument();
	@$comp_dom->loadHTML($content);
	$xpath       = new DOMXPath( $comp_dom );
	$elements = $xpath->query("*/script[@custom-element]");
	$component_arr = array();
	$elements_arr = array();
    if (!is_null($elements)) {
	  foreach ($elements as $element) {
	    $component_arr[]= $element->getAttribute('custom-element');
	    $elements_arr[] = $comp_dom->saveHTML($element);
	  }
	}
	if (!is_null($elements)) {
		if(!empty($component_arr)){
			$excl_arr = array('amp-bind','amp-access','amp-analytics','amp-access-laterpay','amp-access-poool','amp-dynamic-css-classes','amp-fx-collection','amp-inputmask','amp-lightbox-gallery','amp-inputmask','amp-mustache','amp-subscriptions-google','amp-subscriptions','amp-video-docking','amp-story');
			$inc_elem_arr = array();
			for($r=0;$r<count($comp_to_remove_arr);$r++){
				$inc_elem_arr[] = 'amp-'.$comp_to_remove_arr[$r];
			}
			for($i=0;$i<count($component_arr);$i++){
				if(isset($component_arr[$i])){
					$component = $component_arr[$i];
					if(!in_array($component,$excl_arr)){
						if(!preg_match("/<\/$component>/",  $content) && !$is_script){
							$remove_comp = $elements_arr[$i];
							$content = str_replace($remove_comp, '', $content);
						}else if(in_array($component, $inc_elem_arr )){
							for($rc=0;$rc<count($inc_elem_arr);$rc++){
								$rcomp = $inc_elem_arr[$rc];
								if(preg_match('/<script(\s|\sasync\s)custom-element="'.esc_attr($rcomp).'"(.*?)>(.*?)<\/script>/s', $content,$rmc)){
									if(isset($rmc[0])){
										$remove_comp = $rmc[0];
										$content = str_replace($remove_comp, '', $content);
									}
								}
							}
						}
					}
					// REMOVING DUPLICATE SCRIPT.
					$count_elem = array_count_values($component_arr)[$component];
					if($count_elem>1){
						$content = preg_replace('/<script(\s|\sasync\s)custom-element="'.esc_attr($component).'"(.*?)>(.*?)<\/script>/s','',$content,1,$component_arr[$i]);
					}
				}
			}
		}
	}
	//OTHER COMPONENT CHECK 
	$other_comp_arr = array('amp-mustache'=>'amp-mustache','amp-embed'=>'amp-ad','form'=>'amp-form','amp-access'=>'amp-access','amp-fx'=>'amp-fx-collection');
	if (preg_match('/<amp-carousel(.*?)lightbox(.*?)>/', $content)) {
		 $other_comp_arr['amp-carousel'] = 'amp-lightbox-gallery';
	}
	foreach ($other_comp_arr as $key => $value) {
		$ocomp = $value;
		$celem = 'element';
		if($ocomp=='amp-mustache'){
			$celem = 'template';
		}
		if(preg_match('/(type|template|id)="('.$ocomp.')"/', $content) || preg_match("/<\/$key>/",  $content) || preg_match("/amp-fx/",  $content)){
			if(!preg_match('/<script(\s|\sasync\s)custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'"(.*?)>(.*?)<\/script>/s', $content)){
				$o_comp_url = 'https://cdn.ampproject.org/v0/'.esc_attr($ocomp).'-'.esc_attr($script_ver).'.js';
				$script_tag = '<head><script custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'" src="'.esc_url($o_comp_url).'" async></script>';
				$content =  str_replace('<head>', $script_tag, $content);
			}
		}
	}

	$amp_video = $xpath->query("//amp-video");
	foreach($amp_video as $node) {
		if($node->hasAttribute('dock')){
			if(ampforwp_get_setting('ampforwp-amp-video-docking')){
				$celem = 'element';
				$ocomp = 'amp-video-docking';
				if(!preg_match('/<script(\s|\sasync\s)custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'"(.*?)>(.*?)<\/script>/s', $content)){
					$o_comp_url = 'https://cdn.ampproject.org/v0/'.esc_attr($ocomp).'-'.esc_attr($script_ver).'.js';
					$script_tag = '<head><script custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'" src="'.esc_url($o_comp_url).'" async></script>';
					$content =  str_replace('<head>', $script_tag, $content);
				}
			}else{
				if(preg_match('/<amp-video(.*?) dock|dock=">/', $content)){
					$content = preg_replace('/<amp-video(.*?) dock|dock=">/','<amp-video $1>', $content);
				}
			}
		}
	}

	$amp_youtube = $xpath->query("//amp-youtube");
	foreach($amp_youtube as $node) {
		if($node->hasAttribute('dock')){
			if(ampforwp_get_setting('ampforwp-amp-video-docking')){
				$celem = 'element';
				$ocomp = 'amp-video-docking';
				if(!preg_match('/<script(\s|\sasync\s)custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'"(.*?)>(.*?)<\/script>/s', $content)){
					$o_comp_url = 'https://cdn.ampproject.org/v0/'.esc_attr($ocomp).'-'.esc_attr($script_ver).'.js';
					$script_tag = '<head><script custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'" src="'.esc_url($o_comp_url).'" async></script>';
					$content =  str_replace('<head>', $script_tag, $content);
				}
			}else{
				if(preg_match('/<amp-youtube(.*?) dock|dock=">/', $content)){
					$content = preg_replace('/<amp-youtube(.*?) dock|dock=">/','<amp-youtube $1>', $content);
				}
			}
		}
	}

	$amp_brid_player = $xpath->query("//amp-brid-player");
	foreach($amp_brid_player as $node) {
		if($node->hasAttribute('dock')){
			if(ampforwp_get_setting('ampforwp-amp-video-docking')){
				$celem = 'element';
				$ocomp = 'amp-video-docking';
				if(!preg_match('/<script(\s|\sasync\s)custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'"(.*?)>(.*?)<\/script>/s', $content)){
					$o_comp_url = 'https://cdn.ampproject.org/v0/'.esc_attr($ocomp).'-'.esc_attr($script_ver).'.js';
					$script_tag = '<head><script custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'" src="'.esc_url($o_comp_url).'" async></script>';
					$content =  str_replace('<head>', $script_tag, $content);
				}
			}else{
				if(preg_match('/<amp-brid-player(.*?) dock|dock=">/', $content)){
					$content = preg_replace('/<amp-brid-player(.*?) dock|dock=">/','<amp-brid-player $1>', $content);
				}
			}
		}
	}
	$amp_brightcove = $xpath->query("//amp-brightcove");
	foreach($amp_brightcove as $node) {
		if($node->hasAttribute('dock')){
			if(ampforwp_get_setting('ampforwp-amp-video-docking')){
				$celem = 'element';
				$ocomp = 'amp-video-docking';
				if(!preg_match('/<script(\s|\sasync\s)custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'"(.*?)>(.*?)<\/script>/s', $content)){
					$o_comp_url = 'https://cdn.ampproject.org/v0/'.esc_attr($ocomp).'-'.esc_attr($script_ver).'.js';
					$script_tag = '<head><script custom-'.esc_attr($celem).'="'.esc_attr($ocomp).'" src="'.esc_url($o_comp_url).'" async></script>';
					$content =  str_replace('<head>', $script_tag, $content);
				}
			}else{
				if(preg_match('/<amp-brightcove(.*?) dock|dock=">/', $content)){
					$content = preg_replace('/<amp-brightcove(.*?) dock|dock=">/','<amp-brightcove $1>', $content);
				}
			}
		}
	}
	$allscripts = apply_filters( 'ampforwp_modify_scripts', $allscripts);
	// Scripts added from Options panel should have higher priority #4064
	if( $allscripts || (ampforwp_get_setting('amp-header-text-area-for-html') && ampforwp_get_setting('amp-header-text-area-for-html')!="")) {
	   $allscripts .= ampforwp_get_setting('amp-header-text-area-for-html');
      preg_match_all('/<script(.*?)custom-element=\"(.*?)\"(.*?)src=\"(.*?)\"(.*?)>(.*?)<\/script>/s', $allscripts, $rep);
      if($rep){
		  	if(isset($rep[2]) && isset($rep[4])){
		      	$script_slug = $rep[2];
		      	$script_url = $rep[4];
		      	for($s=0;$s<count($script_slug);$s++){
		      		$slug = $script_slug[$s];
		      		$surl = $script_url[$s];
		      		if(preg_match('/amp/', $slug) && preg_match('/https/', $surl)){
			         	if(preg_match('/<script(.*?)custom-element=\"'.esc_attr($slug).'\"(.*?)src=\"(.*?)\"(.*?)>(.*?)<\/script>/', $content, $conmatch)){
			         		if(isset($conmatch[3]) && $conmatch[3]!=""){
			         			$rep_url = $conmatch[3];
			         			if(preg_match('/https/', $rep_url)){
									$content = str_replace($rep_url, $surl, $content);
			         			}
			         		}
			         	}
			         }
		        }
		    }
      	}
   	}
	return $content;
}	
if(!function_exists('ampforwp_get_retina_image_settings')){
	function ampforwp_get_retina_image_settings($width,$height){
		$data['width'] 	= intval($width);
		$data['height'] = intval($height);
		if ( 1 == ampforwp_get_setting('ampforwp-retina-images') ) {
			$resolution = 2;
			if (ampforwp_get_setting('ampforwp-retina-images-res')) {
				$resolution = ampforwp_get_setting('ampforwp-retina-images-res');
			}
			$width = $width * $resolution;
			$height = $height * $resolution;
			$data['width'] 	= intval($width);
			$data['height'] = intval($height);
		}
		return $data;
	}
}

if(!function_exists('ampforwp_add_fallback_element')){
	function ampforwp_add_fallback_element($content='',$tag=''){
		preg_match_all('/<'.$tag.' (.*?)<\/'.$tag.'>/', $content, $matches);
		if(!empty($matches) && false == ampforwp_get_setting('ampforwp-amp-convert-to-wp')){
			if(isset($matches[0])){
				$con = "";
				for($i=0;$i<count($matches[0]);$i++){
					$match = $matches[0][$i];
					$m_content = $matches[1][$i];
					$m_content = ampforwp_imagify_webp_compatibility($m_content);
					$m_content = ampforwp_ewww_webp_compatibility($m_content);
					$m_content = ampforwp_webp_express_compatibility($m_content);
					$m_content = ampforwp_litespeed_webp_compatibility($m_content);
					$m1_content = ampforwp_set_default_fallback_image($matches[1][$i]);
					preg_match_all('/src="(.*?)"/', $m1_content,$fimgsrc);
					preg_match_all('/width="(.*?)"/', $m1_content,$fimgwidth);
					preg_match_all('/height="(.*?)"/', $m1_content,$fimgheight);
					preg_match_all('/alt="(.*?)"/', $m1_content,$fimgalt);
					if((isset($fimgsrc[1][0]) && preg_match_all('/http/', $fimgsrc[1][0],$fbi)) && isset($fimgwidth[1][0]) && isset($fimgheight[1][0])){
					$data['src'] 	= $fimgsrc[1][0];
					$data['width'] 	= $fimgwidth[1][0];
					$data['height'] = $fimgheight[1][0];
					if(isset($fimgalt[1][0])){
						$data['alt'] 	= $fimgalt[1][0];
					}else{
						$data['alt'] 	= '';
					}
					$fallback_data = apply_filters('ampforwp_fallback_image_params',$data);
					$fsrc 	= $fallback_data['src'];
					$fwidth = $fallback_data['width'];
					$fheight= $fallback_data['height'];
					$falt 	= $fallback_data['alt'];
					$ssrc = $fimgsrc[0][0];
					$swidth = $fimgwidth[0][0];
					$sheight = $fimgheight[0][0];
					$salt = '';
					if(isset($fimgalt[0][0])){
						$salt = $fimgalt[0][0];
					}
					$src_rep = 'src="'.esc_url($fsrc).'"';
					$width_rep = 'width="'.intval($fwidth).'"';
					$height_rep = 'height="'.intval($fheight).'"';
					$alt_rep = 'alt="'.esc_attr($falt).'"';
					$m1_content = str_replace($ssrc, $src_rep, $m1_content);
					$m1_content = str_replace($swidth, $width_rep, $m1_content);
					$m1_content = str_replace($sheight, $height_rep, $m1_content);
					$m1_content = str_replace($salt, $alt_rep, $m1_content);
					if(function_exists('rocket_activation')){
						$m1_content = preg_replace('/srcset="(.*?)"/', '', $m1_content);
					}
					$fallback_img = "<amp-img data-hero ".$m_content."<amp-img fallback data-hero ".$m1_content."</amp-img></amp-img>";//$m_content, $m1_content escaped above.
					$content = str_replace("$match", $fallback_img, $content);
				}
				}
			}
		}
		return $content;
	}
}
if(!function_exists('ampforwp_imagify_webp_compatibility')){
	function ampforwp_imagify_webp_compatibility($content){
		if(function_exists('_imagify_init')){
			preg_match_all('/src="(.*?)"/', $content,$src);
			$imageify_opt = get_option( 'imagify_settings' );
			$convert_to_webp = false;
			if(isset($imageify_opt['convert_to_webp'])){
				$convert_to_webp = $imageify_opt['convert_to_webp'];
			}
			$display_webp = false;
			if(isset($imageify_opt['display_webp'])){
				$display_webp = $imageify_opt['display_webp'];
			}
			if($convert_to_webp && $display_webp){
				$img_url = esc_url($src[1][0]);
				if(!preg_match('/\.webp/', $img_url)){
					$rep_url = esc_url($src[1][0]).".webp";
					if(preg_match('/http(.*)\/wp-content\/uploads/', $rep_url)){
						$upload_dir = wp_upload_dir()['basedir'];
						$img_file = preg_replace('/http(.*)\/wp-content\/uploads/', $upload_dir, $rep_url);
						if(file_exists($img_file)){
							$content = str_replace($img_url, $rep_url, $content);
						}
					}
				}
			}
		}
		$content = str_replace('.webp.webp','.webp',$content);
		return $content;
	}
}
if(!function_exists('ampforwp_set_default_fallback_image')){
	function ampforwp_set_default_fallback_image($content){
		if(!function_exists('_imagify_init') && !function_exists('ewww_image_optimizer_webp_initialize')){
			preg_match_all('/src="(.*?)"/', $content,$cc); // need to check extenstion for fallback.
			if(isset($cc[1][0])){
				$img = $cc[1][0];
				$defaul_fallback_img = ampforwp_get_setting('ampforwp_default_fallback_image');
				if(isset($defaul_fallback_img['url']) && $defaul_fallback_img['url']!=''){
					$defaul_fallback_img = esc_url($defaul_fallback_img['url']);
					$content = str_replace($img, $defaul_fallback_img, $content); // need to change fallback extenstion.
				}
			}

		}
		return $content;
	}
}
if(!function_exists('ampforwp_ewww_webp_compatibility')){
function ampforwp_ewww_webp_compatibility($content){
		if(defined( 'EWWW_IO_CLOUD_PLUGIN' )){
			preg_match_all('/src="(.*?)"/', $content,$src);
			if(isset($src[1][0])){
				$img_url = esc_url($src[1][0]);
				if(!preg_match('/\.webp/', $img_url)){
					$rep_url = esc_url($src[1][0]).".webp";
					if(preg_match('/http(.*)\/wp-content\/uploads/', $rep_url)){
						$upload_dir = wp_upload_dir()['basedir'];
						$img_file = preg_replace('/http(.*)\/wp-content\/uploads/', $upload_dir, $rep_url);
						if(file_exists($img_file)){
							$content = str_replace($img_url, $rep_url, $content);
						}
					}
				}
			}
		}
		$content = str_replace('.webp.webp','.webp',$content);
		return $content;
	}
} 

if(!function_exists('ampforwp_check_image_existance')){
	function ampforwp_check_image_existance($image){
		if(preg_match('/wp-content\/uploads/', $image)){
			$img_arr = explode('wp-content', $image);
			if(!empty($img_arr) && isset($img_arr[1])){
				$img = WP_CONTENT_DIR.$img_arr[1];
				if(!file_exists($img)){
					if(preg_match('/\d+x\d+/', $image,$ma)){
						$t_sizes = explode('x', $ma[0]);
						$width = $t_sizes[0];
						$height = $t_sizes[1];
						$image = preg_replace('/-\d+x\d+/','', $image);
						$resize = ampforwp_aq_resize( $image, $width , $height , true, false, true );
						if(isset($resize[0])){
							$image = $resize[0];
						}
					}
				}
			}
		}
		return $image;
	}
}

if (function_exists('themify_builder_activate')) {
	add_filter('ampforwp_modify_the_content','ampforwp_themify_compatibility');
}
function ampforwp_themify_compatibility($content){
	$get_data =  get_post_meta(ampforwp_get_the_ID(),'_themify_builder_settings_json',true);
	if($get_data){
		$decode = json_decode($get_data,true);
		$cols = '';
		for($i=0;$i<count($decode);$i++){
		if(isset($decode[$i]['cols'])){
			$cols = $decode[$i]['cols'];
		}
		for($j=0;$j<count($cols);$j++){
			if (isset($cols[$j]['modules'])) {
			$modules = $cols[$j]['modules'];
			for($k=0;$k<count($modules);$k++){
				foreach ($modules as $key => $value) {
					foreach ($value['mod_settings'] as $key => $val) {
						$content.=$val;
					}
				}
			}
			}
	    }
		}
	}
	return $content;
}

add_action( 'wp_ajax_ampforwp_referesh_related_post', 'ampforwp_referesh_related_post' );
function ampforwp_referesh_related_post(){
	if(!wp_verify_nonce($_POST['verify_nonce'],'ampforwp_refresh_related_poost') ){
		echo json_encode(array('status'=>403,'message'=>'user request is not allowed')) ;
		die;
	}
	$orderby = 'ID';

	$args=array(
		'fields'        => 'ids',
		'post_type'	   => 'post',
	    'posts_per_page'=> 30,
	    'orderby' => $orderby,
	    'ignore_sticky_posts'=>1,
		'has_password' => false ,
		'post_status'=> 'publish',
		'no_found_rows'	=> true,
		'meta_query' => array(
			array(
					'key' => 'ampforwp-amp-on-off', 
		    		'compare' => 'NOT EXISTS',
				)
		)
	);
	$my_query = new wp_query( $args );
	while( $my_query->have_posts() ) {
		$my_query->the_post();
		update_post_meta(get_the_ID(),'ampforwp-amp-on-off','default');
	}
	/*$args=array(
		'fields'        => 'ids',
	    'post_status'           => 'publish',
        'ignore_sticky_posts'   => true,
        'posts_per_page'        => 50,
        'no_found_rows' => true,
		'meta_query' => array(
			array(
					'key' => 'ampforwp-ia-on-off', 
		    		'compare' => 'NOT EXISTS',
				)
		)
	);
	$my_query = new wp_query( $args );
	while( $my_query->have_posts() ) {
		$my_query->the_post();
		update_post_meta(get_the_ID(),'ampforwp-ia-on-off','default');
	}*/
	$data['response'] = ampforwp_get_post_percent();
	echo json_encode($data);
}

// HIDE/SHOW TAG AND CATEGORY #4326
function ampforwp_save_taxonomy_meta($term_id){
	if(isset($_POST['amp_taxonomy'])){
		$cat_status = sanitize_text_field($_POST['amp_taxonomy']);
		$hide_tax = sanitize_text_field($_POST['hide_tax']);
		add_term_meta($term_id, 'amp_taxonomy', $cat_status );
		add_term_meta( $term_id,'amp_hide_tax', $hide_tax);
	}
}
function ampforwp_update_taxonomy_meta($term_id, $term_id1){
	if(isset($_POST['amp_taxonomy'])){
		$cat_status = sanitize_text_field($_POST['amp_taxonomy']);
		$hide_tax = sanitize_text_field($_POST['hide_tax']);
		update_term_meta( $term_id,'amp_taxonomy', $cat_status);
		update_term_meta( $term_id,'amp_hide_tax', $hide_tax);
	}
}

if ( isset( $_REQUEST['taxonomy'] )) {
	$taxonomy = $_REQUEST['taxonomy'];
	add_action('edited_'.esc_attr($taxonomy), 'ampforwp_update_taxonomy_meta',10,2);
	add_action('create_'.esc_attr($taxonomy), 'ampforwp_save_taxonomy_meta', 10);
	add_action('edited_'.esc_attr($taxonomy), 'ampforwp_update_taxonomy_meta',10,2);
	add_action('create_'.esc_attr($taxonomy), 'ampforwp_save_taxonomy_meta', 10);
	add_action (esc_attr($taxonomy).'_edit_form_fields', 'ampforwp_extra_category_fields');
	add_action (esc_attr($taxonomy).'_add_form_fields', 'ampforwp_extra_category_fields');
}
function ampforwp_extra_category_fields( $tag ) {
	$label = 'Category';
	if(is_object($tag)){
		if($tag->taxonomy=="post_tag"){
			$label = 'Tag';
		}else if($tag->taxonomy!='category'){
			$label = $tag->taxonomy;
		}
	}else{
		if($tag=='post_tag'){
			$label = 'Tag';
		}
	}
?>
<tr class="form-field">
	<?php if(!isset($tag->term_id)){?>
	<th scope="row" valign="top"></th>
	<td>
		<div class="form-field term-parent-wrap">
			<label for="show_amp_taxonomy">AMP</label>
			<select name="amp_taxonomy" id="show_amp_taxonomy" class="postform">
				<option class="level-0" value="show">Show</option>
				<option class="level-0" value="hide">Hide</option>
			</select>
			<p>You can enable or disable AMP on this category. <a href="https://ampforwp.com/tutorials/article/how-to-show-hide-the-amp-from-the-categories-or-product-pages-or-any-custom-taxonomy-in-amp/" target="_blank">Learn More</a>.</p>
		</div>
		<div id="amp-show-hide-tax" class="mrtop-10" style="display: none">
			<div class="hide-show-amp-tax">
				<input type="radio" value="hide-cat" name="hide_tax" checked=""> 
				<strong><?php echo esc_attr($label);?>:</strong>
				Hide from <?php echo esc_attr($label);?> Archive Page.
			</div>
			<div class="mrtop-10 hide-show-amp-tax">
				<input type="radio" value="hide-tax-post" name="hide_tax"> 
				<strong><?php echo esc_attr($label);?> & Posts: </strong>
				 Hide from <?php echo esc_attr($label);?> Archive Page and all it's posts
			</div>
		</div>
		<br>
	</td>
	<?php }else{
		$term_data = ampforwp_get_taxonomy_meta($tag->term_id);
		$visible = '';
		$visible_status = '';
		if(isset($term_data['visible']) && !empty($term_data['visible'])){
			$visible = $term_data['visible'][0];
			$visible_status = $term_data['visible_status'][0];
		}
	?>
		<th scope="row"><label for="show_amp_taxonomy">AMP</label></th>
		<td>
			<select name="amp_taxonomy" id="show_amp_taxonomy" class="postform">
				<option class="level-0" value="show" <?php if($visible=='show'){ echo "selected"; }?>>Show</option>
				<option class="level-0" value="hide" <?php if($visible=='hide'){ echo "selected";} ?>>Hide</option>
			</select><br />
			<span class="description">You can enable or disable AMP on this category. <a href="https://ampforwp.com/tutorials/article/how-to-show-hide-the-amp-from-the-categories-or-product-pages-or-any-custom-taxonomy-in-amp/" target="_blank">Learn More</a>.</span>
			<div id="amp-show-hide-tax" <?php if($visible=='show' || $visible==''){?>style="display: none;"<?php }?> class="edit_hide_tax mrtop-10">
				<div class="hide-show-amp-tax">
				<input type="radio" value="hide-cat" name="hide_tax" <?php if($visible_status=='hide-cat' || $visible_status==''){?> checked <?php }?>> 
				<strong><?php echo esc_attr($label);?>:</strong>
				Hide from <?php echo esc_attr($label);?> Archive Page.
				</div>
				<div class="mrtop-10 hide-show-amp-tax">
					<input type="radio" value="hide-tax-post" name="hide_tax"  <?php if($visible_status=='hide-tax-post'){?> checked <?php }?>> 
					<strong><?php echo esc_attr($label);?> & Posts: </strong>
				 	Hide from <?php echo esc_attr($label);?> Archive Page and all it's posts
				 </div>
			</div>
		</td>
	<?php }?>
</tr>
<?php
}
//4710 Added support to load featured image for lazy load option of Dues theme.
if(function_exists('wpg_lazyload_image_attributes')){
   add_action('wp','ampforwp_dues_theme_load_featured_image');
}
function ampforwp_dues_theme_load_featured_image(){
	if(ampforwp_is_amp_endpoint()){
     remove_filter( 'wp_get_attachment_image_attributes', 'wpg_lazyload_image_attributes', 8, 3 );
	}
}
if(function_exists('rocket_activation')){
	add_filter("ampforwp_the_content_last_filter",'ampforwp_wp_rocket_compatibility',25);
}
function ampforwp_wp_rocket_compatibility($content){  
    $cdn_url = get_option('wp_rocket_settings');
    if($cdn_url['cdn'] == 1){ 
    	$img_cdn_url = '';
    	$cnds_arr = array();
        if(!empty($cdn_url['cdn_zone']) && !empty($cdn_url['cdn_cnames'])){
	        foreach ($cdn_url['cdn_zone'] as $key => $element) { 
	        	if(isset($cdn_url['cdn_cnames'][$key]) && $cdn_url['cdn_cnames'][$key]!=''){
	        		$cnds_arr[$element] = $cdn_url['cdn_cnames'][$key];
	        	}
	        } 
	    }
	    if(isset($cnds_arr['images'])){
	    	$img_cdn_url = $cnds_arr['images'];
	    	$img_cdn_url = apply_filters( 'ampforwp_modify_wp_rocket_cdn_url', $img_cdn_url );
	    }else if(isset($cnds_arr['all'])){
	    	$img_cdn_url = $cnds_arr['all'];
	    }
	    if($img_cdn_url!=''){
	    	$parse_url = parse_url($img_cdn_url);
			if(!isset($parse_url['scheme'])){
			     if(!preg_match('/\/\//', $img_cdn_url)){
			     	$img_cdn_url = '//'.$img_cdn_url;
			     }
			}
	    	$comp_dom = new DOMDocument();
			@$comp_dom->loadHTML($content);
			$xpath = new DOMXPath( $comp_dom );
		    $nodes = $xpath->query('//amp-img[@src]');
		    $home_url = home_url();
		    foreach ($nodes as $node) {
		    	$url = $node->getAttribute('src');
		    	$srcset = $node->getAttribute('srcset');
		    	$is_external = ampforwp_isexternal($url);
				if(!$is_external && !$node->hasAttribute('fallback')){
					$img_src = str_replace($home_url, $img_cdn_url, $url);
					$content = str_replace($url, $img_src, $content);
					$srcset_arr = explode(",", $srcset);
					for($i=0;$i<count($srcset_arr);$i++){
						$original = $srcset_arr[$i];
						$new      = str_replace($home_url, $img_cdn_url, $original);
						if(preg_match('/'.preg_quote($original,'/').'/', $content)){
							$content  = preg_replace('/'.preg_quote($original,'/').'/', $new, $content);
						}
					}
				}
		    }
		}
	}
  	return $content;  
}
// Adding Mobile theme color meta data in header
if(true == ampforwp_get_setting('mobile-theme-color')){
add_action( 'amp_post_template_head', 'ampforwp_mobile_theme_color');
}
function ampforwp_mobile_theme_color(){
		$content_code = ampforwp_get_setting('mobile-theme-color-picker','color');
		if(empty($content_code)){
			$content_code = '#ffffff';  
		}
		?>
		<meta name="theme-color" content="<?php echo ampforwp_sanitize_color($content_code); ?>"/>
		<?php
}

if(function_exists('herald_theme_setup')){
	add_filter('the_content', 'ampforwp_herald_popup_media_in_content', 100, 1 );
	add_filter('bbp_get_topic_content','herald_popup_media_in_content'); 
	add_filter('bbp_get_reply_content','herald_popup_media_in_content');
}
function ampforwp_herald_popup_media_in_content( $content ) {
	if(ampforwp_is_amp_endpoint()){
		if (function_exists('herald_get_option') && herald_get_option( 'on_single_img_popup' ) ) {
			if(preg_match("/<a class=\"herald-popup-img\" href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")><img(.*?)<\/a>/i", $content,$matches)){
				$content = preg_replace( "/<a class=\"herald-popup-img\" href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")><img(.*?)<\/a>/i", '<img on="tap:amp-img-lightbox" role="button" tabindex="0" $5', $content );
			}
		}
	}
	return  $content;
}
// Added TravelTour theme page builder content support.#4540 
function ampforwp_gdlr_core_page_builder_content($content){  
	ob_start();
	do_action('gdlr_core_print_page_builder');
	$content_gdlr = ob_get_contents();
	ob_end_clean();
	if ( $content_gdlr ) {
		$content = $content . $content_gdlr ;
	}
	return $content;  
}
add_filter('wpseo_robots', 'ampforwp_yoast_home_robots');
function ampforwp_yoast_home_robots($string) {
    if (ampforwp_is_home() || ampforwp_is_front_page() && method_exists('WPSEO_Meta', 'get_value') && '1' == WPSEO_Meta::get_value( 'meta-robots-noindex', get_option( 'page_for_posts' )) && '0' == WPSEO_Meta::get_value( 'meta-robots-noindex', ampforwp_get_the_ID())) {
        $string= "index";
    }
    return $string;
}
//Fallback added
if( function_exists('fifu_activate') && !function_exists( 'fifu_amp_url' ) ) {
	function fifu_amp_url($url, $width, $height) {
		$size = get_post_meta(ampforwp_get_the_ID(), 'fifu_image_dimension');
	    if (!empty($size)) {
	        $size = explode(';', $size[0]);
	        $width = $size[0];
	        $height = $size[1];
	    }
	    return array(0 => $url, 1 => $width, 2 => $height);
	}
}
add_filter('ampforwp_post_template_data','ampforwp_amp_bind_script');	
function ampforwp_amp_bind_script($data) {
	if ( empty( $data['amp_component_scripts']['amp-bind'] ) ) {	
		$data['amp_component_scripts']['amp-bind'] = 'https://cdn.ampproject.org/v0/amp-bind-latest.js';
	}	
	return $data;
}
add_filter('ampforwp_post_template_data','ampforwp_amp_story_player_script',12);
function ampforwp_amp_story_player_script($data) {	
	if ( isset($data['post'])) {
		$post_content = $data['post']->post_content;
		if ( (preg_match('/<amp-story-player(.*?)<\/amp-story-player>/s', $post_content) || preg_match('/web-stories/', $post_content )) && empty( $data['amp_component_scripts']['amp-story-player'] ) ) {		
			$data['amp_component_scripts']['amp-story-player'] = 'https://cdn.ampproject.org/v0/amp-story-player-latest.js';	
		}
	}	
	return $data;	
} 

if(!function_exists('ampforwp_video_lightbox')){
	function ampforwp_video_lightbox($content){
		$video_tags_arr = array('amp-youtube');
        add_action('amp_post_template_css','ampforwp_video_lightbox_css',30);
		for($i=0;$i<count($video_tags_arr);$i++){
			$tag = $video_tags_arr[$i];
			preg_match_all('/<'.$tag.' (.*?)<\/'.$tag.'>/', $content, $matches);
			if(!empty($matches)){
				if(isset($matches[0])){
					$con = "";
					for($i=0;$i<count($matches[0]);$i++){
						$match = $matches[0][$i];
						$dom   = AMP_DOM_Utils::get_dom_from_content($match);
	                    $nodes = $dom->getElementsByTagName( 'amp-youtube' );
	                    $video_id ='';
	                    $width  = 800;
	                    $height = 450;
	                    foreach ($nodes as $key => $node) {
	                    	$video_id = $node->getAttribute('data-videoid');
	                    	$width 	=$node->getAttribute('width');
	                        $height =$node->getAttribute('height');
	                    }

						$amp_light_box = '<amp-lightbox id="open-video'.esc_attr($video_id).'" layout="nodisplay">
						<div class="amp-lightbox-video" on="tap:open-video'.esc_attr($video_id).'.close,btn-play'.esc_attr($video_id).'.show" role="button" tabindex="'.$i.'" aria-label="Close Video">
						<div class="amp-video-box">'.$match.'</div>
						</div>
						</amp-lightbox>
						<div class="amp-video-img" id="btn-play'.esc_attr($video_id).'" on="tap:video.show, video.play, btn-play'.esc_attr($video_id).'.hide,open-video'.esc_attr($video_id).'" role="button" tabindex="'.$i.'" aria-label="Play Video">
						<amp-img alt="Video" src="http://i3.ytimg.com/vi/'.esc_attr($video_id).'/hqdefault.jpg" width="'.esc_attr($width).'" height="'.esc_attr($height).'" layout="responsive"></amp-img>
						<div class="amp-video-play-on-image"></div>
						</div>';
						$content = str_replace("$match", $amp_light_box, $content);
					}
				}
			}
		}
		return $content;
	}
}

function ampforwp_video_lightbox_css(){
	echo '.amp-video-box,.amp-video-img{width:100%;margin:0 auto;text-align:center}
.amp-lightbox-video{background:rgba(0,0,0,.8);width:100%;height:100%;position:absolute;display:flex;align-items:center;justify-content:center}
.amp-video-box{max-width:800px}
.amp-video-img{max-width:600px;position:relative}
.amp-video-play-on-image{cursor:pointer;margin:auto;width:56px;height:56px;-webkit-border-radius:50%;border-radius:50%;background-color:rgba(0,0,0,.2);background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAMAAADVRocKAAAAY1BMVEVHcEz///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////80LMUcAAAAIHRSTlMA1d4MSXeg9glf6yEq4hfnnr7Z8qm5U/3Jm1pwFJcmBYTgJ9QAAAIjSURBVGje7VnJdoMwDFSMHVMSQljCklX//5U99NQHGEm22gtz9tPAWNYKsGPHDiou1h3rpvDD4Iumvjp7SWg86yeDM5ipz5KYt53HFfjORn+8KzEI88iizLe4icLlUvtfFZJQ3kXmTzWScTsJPr9FBtovpvn8iExMrJu4jMjGyHh67xIFMOSLOFcoQnUmfr/QPmL1JulfohiGcA/5iBEYt33piFG4br4vjMTGizu1sQRt2FlrjMZNVSBExEBszaoUBOW6JzlMArf6A0XIOzyZoMgkPwDnA5nhsWz/E4wRnBxhVuoTDBMAkGVarma6TQKyTN3iFfttAqJMg1/y1B4JBFSZ+gWCiUZAk+m1QGCIBCSZmoVEhlQCkkxPppP+JiDIZNlxiFmYOXaqnEX2sEwTO9XMq6egTPXsfMMlCMt0mB0v2ARBmYrZYS8gCMjkZ2cHCcG6TMPfE6hLpH7J6m6a+KHN67urdqhQD3bq4Vo94ainTP2kn7RssbqFF7a5buk4dP9T/Ib9KEH5Dg/lBkS/hVJvAiEvU9gPtLFwT0HQh1r9m/IoQX8YEj+t2JwCX+PsT7ojtWH8EIaCJmIo+FQeaxJHs9LBbPkGIt4ilQxjxi8ajj+BgZztra8P8MBcUAi2LCdGXJKsWADgTozeppeuoXJXEPKXfM0FANnDaC7qtlaNbfyq8Uep/rXQYDUvm0M6XKyb6sPPuvdwm5x9wo4dO6j4BoilN6H4pmTiAAAAAElFTkSuQmCC);background-position:center;-webkit-background-size:48px 48px;background-size:48px 48px;position:absolute;top:0;bottom:0;left:0;right:0}';
}

if (class_exists('WPSEO_Options')) {
	add_filter('yoast_seo_development_mode','ampforwp_yoast_seo_development');
	add_filter('wpseo_debug_json_data','ampforwp_remove_homepage_breadcrumb');
}

function ampforwp_yoast_seo_development($dev){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
	if (ampforwp_get_setting('ampforwp-seo-selection') == 'yoast' && ampforwp_get_setting('ampforwp-seo-yoast-schema') && ampforwp_is_home() && function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path)) {
		$dev = true;
	}
	return $dev;
}	
function ampforwp_remove_homepage_breadcrumb($data){
	$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
	if (ampforwp_get_setting('ampforwp-seo-selection') == 'yoast' && ampforwp_get_setting('ampforwp-seo-yoast-schema') && ampforwp_is_home() && function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path)) {
		if (isset($data["@graph"][2]["breadcrumb"])) {
			unset($data["@graph"][2]["breadcrumb"]);
		}
		if ($data["@graph"][3]["@type"] == 'BreadcrumbList') {
			unset($data["@graph"][3]);
		}
	}
	return $data;
}
//Twitter title #2744
function ampforwp_sanitize_twitter_title($post_title){
	$post_title = html_entity_decode( $post_title, ENT_QUOTES, 'UTF-8' );
    $post_title = rawurlencode( $post_title );
    $post_title = esc_html( $post_title );
    return $post_title;
}
if (function_exists('i2_pros_cons_setup')) {
	add_action('amp_post_template_css','ampforwp_i2prosandcons');
}
function ampforwp_i2prosandcons(){
		$options = get_option( 'i2_pros_and_cons');
		$prosHeadingBackground = $options['pros_heading_background'];
		$consHeadingBackground = $options['cons_heading_background'];
		$prosBackground = $options['pros_background'];
		$consBackground = $options['cons_background'];
		$headingFontSize = $options['heading_font_size'];
		$sectionFontSize = $options['body_font_size'];
		$headingColor = $options['heading_color'];
		$sectionColor = $options['body_color'];?>
		.i2-pros-cons-main-wrapper .i2-pros-cons-wrapper {
		    display: table;
		    width: 100%;
		}
		.i2-pros-cons-main-wrapper .i2-pros-cons-wrapper .i2-pros, .i2-pros-cons-main-wrapper .i2-pros-cons-wrapper .i2-cons {
		    display: table-cell;
		    width: 50%;
		    margin-bottom: 15px;
		    position: relative;
		}
		.i2-pros-cons-main-wrapper .i2-pros-cons-wrapper .i2-pros .i2-pros-title, .i2-pros-cons-main-wrapper .i2-pros-cons-wrapper .i2-pros .i2-cons-title, .i2-pros-cons-main-wrapper .i2-pros-cons-wrapper .i2-cons .i2-pros-title, .i2-pros-cons-main-wrapper .i2-pros-cons-wrapper .i2-cons .i2-cons-title {
		    padding: 5px 15px 5px;
		    margin: 0px;
		    display: block;
		}
		.i2-pros-cons-wrapper .i2-pros-title {
		    background-color:<?php echo ampforwp_sanitize_color($prosHeadingBackground); ?>;
		    font-size:<?php echo esc_html($headingFontSize); ?>px;
		}
		.i2-pros-cons-wrapper .i2-cons-title, .i2-pros-cons-wrapper .i2-pros-title {
		    color: #ffffff!important;
		    font-size:<?php echo esc_html($headingFontSize); ?>px;
		}
		.i2-pros {
		    background-color: <?php echo ampforwp_sanitize_color($prosBackground); ?>;
		}
		.i2-cons{
			background-color: <?php echo ampforwp_sanitize_color($consBackground); ?>;
		}
		.i2-pros-cons-wrapper ul li{
			font-size:<?php echo esc_html($sectionFontSize); ?>px;
		}
		.artl-cnt ul li:before {
		    content: "\e315";
		    display: inline-block;
		    width: 0;
		    background: #333;
		    position: absolute;
		    top: 0px;
		    left: 0px;
		    font-family: 'icomoon';
		}
		.i2-pros-cons-wrapper .i2-cons-title {
		    background-color: <?php echo ampforwp_sanitize_color($consHeadingBackground); ?>;
		}
		.i2-pros-cons-wrapper .i2-pros, .i2-pros-cons-wrapper .i2-cons{
		    color: <?php echo ampforwp_sanitize_color($sectionColor); ?>;
		}
		.i2-pros-cons-wrapper .i2-cons-title, .i2-pros-cons-wrapper .i2-pros-title {
		    color: <?php echo ampforwp_sanitize_color($headingColor); ?>;
		}
<?php }
function ampforwp_modify_url_utm_params($url){
	if(true == ampforwp_get_setting('ampforwp-related-post-utm-tracking-switch') && !empty(ampforwp_get_setting('ampforwp-related-posts-utm-tracking'))){
		$modify_url = ampforwp_get_setting('ampforwp-related-posts-utm-tracking');
		$modify_url = apply_filters('ampforwp_modify_related_post_url', $modify_url);
		$url = add_query_arg($modify_url, '' , $url);
		return esc_url_raw($url);
	}							
	return esc_url_raw($url);
}
if(true == ampforwp_get_setting('ampforwp-recent-post-utm-tracking-switch') && !empty(ampforwp_get_setting('ampforwp-recent-posts-utm-tracking'))){
	add_filter('ampforwp_loop_permalink_update','ampforwp_recent_posts_utm_tracking');
}
function ampforwp_recent_posts_utm_tracking($recent_post_permalink){
	if(is_single()){
		$modify_url = ampforwp_get_setting('ampforwp-recent-posts-utm-tracking');
		$modify_url = apply_filters('ampforwp_modify_recent_post_url', $modify_url);
		$recent_post_permalink = add_query_arg($modify_url, '' , $recent_post_permalink);
		return esc_url_raw($recent_post_permalink);
	}
	return esc_url_raw($recent_post_permalink);
}
if(ampforwp_get_setting('ampforwp-facebook-comments-support')){
    add_action('amp_post_template_head','ampforwp_facebook_moderation_tool');
}
function ampforwp_facebook_moderation_tool(){
	$facebook_app_id = ampforwp_get_setting('ampforwp-fb-moderation-app-id');
	if($facebook_app_id!=''){
?>
	<meta property="fb:app_id" content="<?php echo esc_attr($facebook_app_id);?>" />
<?php
	}
	$facebook_admin_id = ampforwp_get_setting('ampforwp-fb-moderation-admin-id');
	if($facebook_admin_id!=''){
		$ids = explode(",", $facebook_admin_id);
		for($i=0;$i<count($ids);$i++){
			$id = $ids[$i];
			if($id!=''){
?>
	<meta property="fb:admins" content="<?php echo esc_attr($id);?>"/>
<?php
			}
		}
	}
}

//Schema Pro FAQ block compatibility #4956
add_filter('ampforwp_modify_the_content','ampforwp_schema_pro_faq_block');
function ampforwp_schema_pro_faq_block($content_buffer){
	if (!function_exists('on_bsf_aiosrs_pro_activate')) {
		return $content_buffer;
	}
	preg_match_all('/<div class="wp-block-wpsp-faq(.*?)class="wpsp-question">(.*?)<\/(.*?)>(.*?)class="wpsp-faq-content"><span><p>(.*?)<\/p>/', $content_buffer, $matches);
	if(is_array($matches)){
		$schema  = array();
		$schema['@context'] = 'https://schema.org';
		$schema['type']     = 'FAQPage';
		for($i=0;$i<count($matches[2]);$i++){
		 	$questions = $matches[2];
		 	$answers = $matches[5];
		 	foreach ( $questions as $key => $question ) {
				$schema['mainEntity'][ $key ]['@type'] = 'Question';
				$schema['mainEntity'][ $key ]['name']  = $question;
			}
			foreach ( $answers as $key => $answer ) {
				$schema['mainEntity'][ $key ]['acceptedAnswer']['@type'] = 'Answer';
				$schema['mainEntity'][ $key ]['acceptedAnswer']['text']  = $answer;
			}
		}
		$schema = '<script type="application/ld+json">'.wp_json_encode( $schema, JSON_UNESCAPED_UNICODE ).'</script>';
		$content_buffer = preg_replace('/(<div class="wp-block-wpsp-faq\s(.*?)<\/div>)/s', ''.$schema.'$1', $content_buffer);
	} 
	return $content_buffer;
}

function ampforwp_get_gitty_image_embed( $html, $url, $attr, $post_ID ) {
	global $getty_img_content;
	$getty_img_content[] = $html;
	return $html; 
}

function ampforwp_getty_image_compatibility($content){
	global $getty_img_content;
	if(is_array($getty_img_content)){
		if(preg_match_all('/<a id="(.*?)"\sclass="gie-single(.*?)">Embed from Getty Images<\/a>/', $content, $matches)){
			if(isset($matches[0])){
				for($i=0;$i<count($matches[0]);$i++){
					$full_content = $matches[0][$i];
					$img_id = $matches[1][$i];
					if(isset($getty_img_content[$i])){
						if(preg_match('/gie\.widgets\.load\({id:\'(.*?)\',sig:\'(.*?)\',w:\'(.*?)\',h:\'(.*?)\',items:\'(.*?)\'/',$getty_img_content[$i],$match)){
							if(isset($match[1]) && isset($match[2]) && isset($match[3]) && isset($match[4]) && isset($match[5])){
								$image_id = $match[1];
								$image_key = $match[2];
								$width = $match[3];
								$height = $match[4];
								$img_emb_id = $match[5];
								$iframe = '<iframe src="//embed.gettyimages.com/embed/'.esc_attr($img_emb_id).'?et='.esc_attr($image_id).'&amp;tld=com&sig='.esc_attr($image_key).'&caption=false&ver=2" scrolling="no" frameborder="0" width="'.esc_attr($width).'" height="'.esc_attr($height).'"></iframe>';
								$description 	= get_the_archive_description();
								$sanitizer = new AMPFORWP_Content( $iframe, array(), 
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
								$iframe_content = $sanitizer->get_amp_content();
								$content = str_replace($full_content, $iframe_content, $content );
								}
							}
						}
					}
				}
			}
		}
		return $content;
	}

if(function_exists('vp_pfui_admin_init') && function_exists('penci_setup')){
	add_action('ampforwp_before_post_content','ampforwp_pennews_audio_embed');
}
function ampforwp_pennews_audio_embed(){
	$audio = get_post_meta(ampforwp_get_the_ID(), '_format_audio_embed', true); 
	if(empty($audio)){
		return;
	}
	$audio = preg_replace('/<iframe(.*?)width="(.*?)%"(.*?)<\/iframe>/', '<iframe$1width="1000"$3</iframe>', $audio);
	$audio_str = substr( $audio, -4 );
	$html ='<div class="audio-iframe">';
	if ( wp_oembed_get( $audio ) ) {
		$html .= wp_oembed_get( $audio );
	}elseif( $audio_str == '.mp3' ) {
		$html .= do_shortcode('[audio src="'. esc_url( $audio ) .'"]');
	}else{
		$html .= do_shortcode( $audio );
	}
	$html .= '</div>';
	$sanitizer = new AMPFORWP_Content( $html, array(), 
		apply_filters( 'ampforwp_content_sanitizers',
			array( 
				'AMP_Audio_Sanitizer' 		=> array(),
				'AMP_Iframe_Sanitizer' 		=> array(
					'add_placeholder' 		=> true,
				)
			) ) );
	$sanitized_html = $sanitizer->get_amp_content();
	echo $sanitized_html;
}	

//Alignment issue with Gutenberg image block #4997
add_filter('ampforwp_modify_the_content','ampforwp_wp_block_cover_image');
function ampforwp_wp_block_cover_image($content_buffer){
	if(ampforwp_get_setting('ampforwp_css_tree_shaking') && ampforwp_is_gutenberg_active()){
		preg_match_all('/<amp-img(.*?)class="wp-block-cover__image-background(.*?)"(.*?)src="(.*?)"(.*?)<\/amp-img>/', $content_buffer, $matches);
		if(is_array($matches) && isset($matches[4][0])){
			$img_url = $matches[4][0];
				if (!empty($img_url)) {
					$content_buffer = preg_replace('/<div(.*?)class="wp-block-cover(.*?)"><amp-img(.*?)<\/amp-img>/', '<div$1style="background-image:url('.$img_url.');" class="wp-block-cover$2"><amp-img$3</amp-img>', $content_buffer); 
					$content_buffer = preg_replace('/<amp-img(.*?)class="wp-block-cover__image-background(.*?)"(.*?)src="(.*?)"(.*?)<\/amp-img>/', '', $content_buffer);
					return $content_buffer;
				}
		} 
	}
	return $content_buffer;
}
 function ampforwp_mobile_redirection_js() {
 	$url_to_redirect = ampforwp_amphtml_generator();?>
    <script>
		if(screen.width<769){
        	window.location = "<?php echo esc_url($url_to_redirect); ?>";
        }
    	</script>
<?php }
function ampforwp_webp_express_compatibility($content){
	if(function_exists('webp_express_process_post')){
		preg_match_all('/src="(.*?)"/', $content,$src);
		if(isset($src[1][0])){
			$img_url = esc_url($src[1][0]);
			if(!preg_match('/\.webp/', $img_url)){
				$config = \WebPExpress\Config::loadConfigAndFix();
				if($config['destination-folder'] == 'mingled'){
					$img_url_webp = $img_url;
				}else{
					$img_url_webp = preg_replace('/http(.*?)\/wp-content(.*?)/', 'http$1/wp-content/webp-express/webp-images$2', $img_url);
					if($config['destination-structure'] == 'doc-root'){
						$img_url_webp = preg_replace('/http(.*?)\/wp-content(.*?)/', 'http$1/wp-content/webp-express/webp-images/doc-root/wp-content$2', $img_url);
					}
				}
				if(!preg_match('/\.webp/', $img_url)){	
					$img_url_webp = esc_url($img_url_webp).".webp";
			 		$content = str_replace($img_url, $img_url_webp, $content); 
				}
			}
	 	}
	}	
	return $content;
}
add_action('amp_post_template_css','ampforwp_set_local_font',33);
if(!function_exists('ampforwp_set_local_font')){
	function ampforwp_set_local_font(){
		if(ampforwp_get_setting('ampforwp-local-font-switch') && ampforwp_get_setting('ampforwp-local-font-upload','url')!=""){
			$upload_dir   = wp_upload_dir();
	        $user_dirname = $upload_dir['basedir'] . '/' . 'ampforwp-local-fonts';
	        if ( file_exists( $user_dirname ) ) {
	            $files = glob( $user_dirname . '/*' );
	            $font_css =  '@font-face {';
	            $i = 0;
	            foreach ( $files as $file ) {
	               	$fonts = explode("/", $file);
	               	$font_name = end($fonts);
					$ext = end(explode(".", $font_name));
					if($ext!='zip'){
						$font_arr = explode('-', $font_name);
		                $font_family = $font_arr[0];
		               	if($i==0){
		               		$font_css .= "font-family: '".esc_attr(ucfirst($font_family))."'; font-style: normal; font-weight: 400;";
		               	}
		               	$font_path =  $upload_dir['baseurl'].'/'.'ampforwp-local-fonts/'.$font_name;
		               	if($ext=='eot'){
		               		$font_css .= "src: url('".esc_url($font_path)."'); src: url('".esc_url($font_path)."?#iefix') format('embedded-opentype'),";
		               	}else if($ext=='svg'){
		               		$font_css .= "src: url('".esc_url($font_path)."?#".esc_attr(ucfirst($font_family))."') format('svg'),";
		               	}else if($ext=='ttf'){
		               		$font_css .= "src: url('".esc_url($font_path)."') format('truetype'),";
		               	}else{
		               		$font_css .= "src: url('".esc_url($font_path)."') format('".esc_attr($ext)."'),";
		               	}
		               	$i++;
					}
	            }
	            $font_css .= '}';
	            echo $font_css;
	        }
		}
	}
}

function ampforwp_year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('ampforwp_current_year', 'ampforwp_year_shortcode');

function ampforwp_litespeed_webp_compatibility($content){
	if(class_exists( 'WP_Offload_Media_Autoloader')){
		return $content;
	}
	if(function_exists( 'run_litespeed_cache' )){
		preg_match_all('/src="(.*?)"/', $content,$src);
		if(isset($src[1][0])){
			$img_url = esc_url($src[1][0]);
			if(!preg_match('/\.webp/', $img_url)){	
				$rep_url = esc_url($src[1][0]).".webp";
				if(preg_match('/http(.*)\/wp-content\/uploads/', $rep_url)){
					$upload_dir = wp_upload_dir()['basedir'];
					$img_file = preg_replace('/http(.*)\/wp-content\/uploads/', $upload_dir, $rep_url);
					if(file_exists($img_file)){
						$content = str_replace($img_url, $rep_url, $content);
					}
				}
			}
		}
	}
	$content = str_replace('.webp.webp','.webp',$content);
	return $content;
}

if (ampforwp_get_setting('amp-core-end-point') && function_exists('get_rocket_cache_query_string') ) {
	add_filter('rocket_cache_query_strings', 'ampforwp_rocket_cache_query_string');
}

function ampforwp_rocket_cache_query_string($query_strings){
	array_push($query_strings,"amp"); 
	return $query_strings;
}