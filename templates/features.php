<?php
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
		10.1 Analytics Support added for Google Analytics
		10.2 Analytics Support added for segment.com
		10.3 Analytics Support added for Piwik
		10.4 Analytics Support added for quantcast
		10.5 Analytics Support added for comscore
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
*/
// Adding AMP-related things to the main theme
	global $redux_builder_amp;


	// 0.9. AMP Design Manager Files
	require AMPFORWP_PLUGIN_DIR  .'templates/design-manager.php';
	// Custom AMP Content
	require AMPFORWP_PLUGIN_DIR  .'templates/custom-amp-content.php';
	// Custom AMPFORWP Sanitizers
 	require AMPFORWP_PLUGIN_DIR  .'templates/custom-sanitizer.php';
	// Custom Frontpage items
 	require AMPFORWP_PLUGIN_DIR  .'templates/frontpage-elements.php';
 	require AMPFORWP_PLUGIN_DIR . '/classes/class-ampforwp-youtube-embed.php' ; 

 	// TODO: Update this function 
 	function ampforwp_include_customizer_files(){
 		$amp_plugin_data;
		$amp_plugin_activation_check; 

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );

		if ( $amp_plugin_activation_check ) {
			$amp_plugin_data = get_plugin_data( AMPFORWP_MAIN_PLUGIN_DIR. 'amp/amp.php' );
	 		if ( $amp_plugin_data['Version'] > '0.4.2' ) {
	 			return require AMPFORWP_PLUGIN_DIR  .'templates/customizer/customizer-new.php' ;
	 		} else {
	 			return require AMPFORWP_PLUGIN_DIR  .'templates/customizer/customizer.php' ;
	 		}
		} else {
			return require AMPFORWP_PLUGIN_DIR  .'templates/customizer/customizer.php' ;
		}
 	} 
 	ampforwp_include_customizer_files();
//0.

define('AMPFORWP_COMMENTS_PER_PAGE',  ampforwp_define_comments_number() );
	// Define number of comments
	function ampforwp_define_comments_number(){
		global $redux_builder_amp;
		return $redux_builder_amp['ampforwp-number-of-comments'];
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
			amp_prepare_render();
		} else {
			add_action( 'wp_head', 'ampforwp_home_archive_rel_canonical' );
		}

		$cpage_var = get_query_var('cpage');

		if ( $cpage_var >= 1) : 
			remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical' );
		endif;			
	}

	function ampforwp_home_archive_rel_canonical() {
		global $redux_builder_amp;
		global $wp;
	    if( is_attachment() ) {
        return;
	    }
	    if( is_home() && !$redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
	    }
	    if( is_front_page() && ! $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
	    }
	    if ( is_archive() && !$redux_builder_amp['ampforwp-archive-support'] ) {
				return;
			}
		// #872 no-amphtml if selected as hide from settings
		if(is_archive() && $redux_builder_amp['ampforwp-archive-support']){
			$categories = get_the_category();
			$category_id = $categories[0]->cat_ID;
			$get_categories_from_checkbox =  $redux_builder_amp['hide-amp-categories']; 
			// Check if $get_categories_from_checkbox has some cats then only show
			if ( $get_categories_from_checkbox ) {
				$get_selected_cats = array_filter($get_categories_from_checkbox);
				foreach ($get_selected_cats as $key => $value) {
					$selected_cats[] = $key;
				}  
				if($selected_cats && $category_id){
					if(in_array($category_id, $selected_cats)){
						return;
					}
				}
			} 
		}	
      	if( is_page() && !$redux_builder_amp['amp-on-off-for-all-pages'] ) {
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

	    if ( is_home()  || is_front_page() || is_archive() ){
	        global $wp;
	        $current_archive_url = home_url( $wp->request );
	        $amp_url = trailingslashit($current_archive_url).'amp';

	    } else {
	      $amp_url = amp_get_permalink( get_queried_object_id() );
	    }

	        global $post;
	        $ampforwp_amp_post_on_off_meta = get_post_meta( get_the_ID(),'ampforwp-amp-on-off',true);
	        if(  is_singular() && $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
	          //dont Echo anything
	        } else {
				$supported_types = array('post','page');

				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if( is_plugin_active( 'amp-custom-post-type/amp-custom-post-type.php' ) ) {
					if ( $redux_builder_amp['ampforwp-custom-type'] ) {
						foreach($redux_builder_amp['ampforwp-custom-type'] as $custom_post){
							$supported_types[] = $custom_post;
						}
					}
				}

				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if( is_plugin_active( 'amp-woocommerce/amp-woocommerce.php' ) ) {
					if( !in_array("product", $supported_types) ){
						$supported_types[]= 'product';
					}
				}

				$type = get_post_type();
				$supported_amp_post_types = in_array( $type , $supported_types );

				$query_arg_array = $wp->query_vars;

				if( array_key_exists( 'paged' , $query_arg_array ) ) {
					if ( ( is_home() ||  is_front_page() ) && $wp->query_vars['paged'] >= '2' ) {
						$new_url =  home_url('/');
						$new_url = $new_url . AMPFORWP_AMP_QUERY_VAR . '/' . $wp->request ;
						$amp_url = $new_url ;
					}
					if ( is_archive() && $wp->query_vars['paged'] >= '2' ) {
						$new_url 		=  home_url('/');
						$category_path 	= $wp->request;
						$explode_path  	= explode("/",$category_path);
						$inserted 		= array(AMPFORWP_AMP_QUERY_VAR);
						array_splice( $explode_path, -2, 0, $inserted );
						$impode_url = implode('/', $explode_path);

						$amp_url = $new_url . $impode_url ;
					}
					if( is_search() && $wp->query_vars['paged'] >= '2' ) {
						$current_search_url =trailingslashit(get_home_url()) . $wp->request .'/'."?amp=1&s=".get_search_query();
					}
				}

				if( is_search() ) {
					$current_search_url =trailingslashit(get_home_url())."?amp=1&s=".get_search_query();
					$amp_url = untrailingslashit($current_search_url);
				}

        $amp_url = apply_filters('ampforwp_modify_rel_canonical',$amp_url);

				if( $supported_amp_post_types) {
					printf( '<link rel="amphtml" href="%s" />', esc_url( $amp_url ) );
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
	   	// Custom Homepage and Archive file

        global $redux_builder_amp;
		$slug = array();
		$current_url_in_pieces = array();

		$ampforwp_custom_post_page  =  ampforwp_custom_post_page();
		        
        // Homepage and FrontPage
        if ( is_home() ) {
        	if ( 'single' === $type ) {

        		$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';

		       if ($redux_builder_amp['amp-frontpage-select-option'] == 1) {
		           
		            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
	            }           
        	

		        if ( $ampforwp_custom_post_page == "page" && ampforwp_name_blog_page() ) {
					$current_url = home_url( $GLOBALS['wp']->request );
					$current_url_in_pieces = explode( '/', $current_url );
				
					if( in_array( ampforwp_name_blog_page() , $current_url_in_pieces )  ) {
						 $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
					}  
				}
			}	
		}



        // Archive Pages
        if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] )  {

            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/archive.php';
        }


				// Search pages
      	if ( is_search() &&
						( $redux_builder_amp['amp-design-1-search-feature'] ||
						  $redux_builder_amp['amp-design-2-search-feature'] ||
							$redux_builder_amp['amp-design-3-search-feature'] )
						)  {
            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/search.php';
        }


		// Custom Single file
	    if ( is_single() || is_page() ) {

			if('single' === $type && !('product' === $post->post_type )) {
			 	$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/single.php';
		 	}
		}
	    return $file;
	}

	// 3. Custom Style files
	add_filter( 'amp_post_template_file', 'ampforwp_set_custom_style', 10, 3 );
	function ampforwp_set_custom_style( $file, $type, $post ) {
		if ( 'style' === $type ) {
			$file = '';
		}
		return $file;
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

	// 4.5 Added hook to add more layout.
	do_action('ampforwp_after_features_include');


	// 5.  Customize with Width of the site
	add_filter( 'amp_content_max_width', 'ampforwp_change_content_width' );
	function ampforwp_change_content_width( $content_max_width ) {
		return 1000;
	}

	// 6. Add required Javascripts for extra AMP features
	add_action('amp_post_template_head','ampforwp_register_additional_scripts', 20);
	function ampforwp_register_additional_scripts() {
		global $redux_builder_amp;
		 if( $redux_builder_amp['enable-single-social-icons'] == true || AMPFORWP_DM_SOCIAL_CHECK === 'true' )  { ?>
			<?php if( is_single() ) {
							if( is_socialshare_or_socialsticky_enabled_in_ampforwp() ) { ?>
				<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
			<?php   }
						}
		} 
		// Check if any of the ads are enabled then only load ads script
		//	moved this code to its own function and done the AMP way
	}
	// 6.1 Adding Analytics Scripts
	add_filter('amp_post_template_data','ampforwp_register_analytics_script', 20);
	function ampforwp_register_analytics_script( $data ){ 
		global $redux_builder_amp;
		if( $redux_builder_amp['amp-analytics-select-option'] && $redux_builder_amp['amp-analytics-select-option'] != '3' && $redux_builder_amp['amp-analytics-select-option'] != '6' && $redux_builder_amp['amp-analytics-select-option'] != '7' && $redux_builder_amp['amp-analytics-select-option'] != '8'){
			if ( empty( $data['amp_component_scripts']['amp-analytics'] ) ) {
				$data['amp_component_scripts']['amp-analytics'] = 'https://cdn.ampproject.org/v0/amp-analytics-0.1.js';
			}
		}
		return $data;
	}

	add_filter( 'amp_post_template_data', 'ampforwp_add_amp_related_scripts', 20 );
	function ampforwp_add_amp_related_scripts( $data ) {
		global $redux_builder_amp;
		// Adding Sidebar Script
		if ( empty( $data['amp_component_scripts']['amp-sidebar'] ) ) {
			$data['amp_component_scripts']['amp-sidebar'] = 'https://cdn.ampproject.org/v0/amp-sidebar-0.1.js';
		}

		return $data;
	}

	// 7. Footer for AMP Pages
	add_filter( 'amp_post_template_file', 'ampforwp_custom_footer', 10, 3 );
	function ampforwp_custom_footer( $file, $type, $post ) {
		if ( 'footer' === $type ) {
			$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/footer.php';
		}
		return $file;
	}

	add_action('ampforwp_global_after_footer','ampforwp_footer');
	function ampforwp_footer() {
			global $redux_builder_amp; ?>
		<!--Plugin Version :<?php echo (AMPFORWP_VERSION); ?> -->
	<?php if($redux_builder_amp['amp-enable-notifications'] == true)  { ?>
		<!-- Thanks to @nicholasgriffintn for Cookie Notification Code-->
	  <amp-user-notification layout=nodisplay id="amp-user-notification1">
	       <p><?php echo $redux_builder_amp['amp-notification-text']; ?> </p>
	       <button on="tap:amp-user-notification1.dismiss"><?php echo $redux_builder_amp['amp-accept-button-text']; ?></button>
	  </amp-user-notification>
	<?php }
	}

	// 8. Add Main tag as a Wrapper
	// Removed this code after moving to design manager

	// 9. Advertisement code
		// Below Header Global
		add_action('ampforwp_after_header','ampforwp_header_advert');
		add_action('ampforwp_design_1_after_header','ampforwp_header_advert');

		function ampforwp_header_advert() {
			global $redux_builder_amp;

			if($redux_builder_amp['enable-amp-ads-1'] == true) {
				if($redux_builder_amp['enable-amp-ads-select-1'] == 1)  {
					$advert_width  = '300';
					$advert_height = '250';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 2) {
		          	$advert_width  = '336';
					$advert_height = '280';
				} elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 3)  {
		          	$advert_width  = '728';
					$advert_height = '90';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 4)  {
		          	$advert_width  = '300';
					$advert_height = '600';
	            } elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 5)  {
		          	$advert_width  = '320';
					$advert_height = '100';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 6)  {
		          	$advert_width  = '200';
					$advert_height = '50';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 7)  {
		          	$advert_width  = '320';
					$advert_height = '50';
	      		}
				$output = '<div class="amp-ad-wrapper amp_ad_1">';
				$output	.=	'<amp-ad class="amp-ad-1"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . '
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-1'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-1'] .'">';
				$output	.=	'</amp-ad>';
				$output	.=   ' </div>';
				echo $output;
			}
		}

		// Above Footer Global
		add_action('amp_post_template_above_footer','ampforwp_footer_advert',10);

		function ampforwp_footer_advert() {
			global $redux_builder_amp;

			if($redux_builder_amp['enable-amp-ads-2'] == true) {
				if($redux_builder_amp['enable-amp-ads-select-2'] == 1)  {
					$advert_width  = '300';
					$advert_height = '250';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 2) {
		          	$advert_width  = '336';
					$advert_height = '280';
				} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 3)  {
		          	$advert_width  = '728';
					$advert_height = '90';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 4)  {
		          	$advert_width  = '300';
					$advert_height = '600';
	            } elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 5)  {
		          	$advert_width  = '320';
					$advert_height = '100';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 6)  {
		          	$advert_width  = '200';
					$advert_height = '50';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-2'] == 7)  {
		          	$advert_width  = '320';
					$advert_height = '50';
	      		}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-2"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . '
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-2'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-2'] .'">';
				$output	.=	'</amp-ad>';
				$output	.=   ' </div>';
				echo $output;
			}
		}

		// Below Title Single
		add_action('ampforwp_before_post_content','ampforwp_before_post_content_advert');
		add_action('ampforwp_inside_post_content_before','ampforwp_before_post_content_advert');

		function ampforwp_before_post_content_advert() {
			global $redux_builder_amp;

			if($redux_builder_amp['enable-amp-ads-3'] == true) {
				if($redux_builder_amp['enable-amp-ads-select-3'] == 1)  {
					$advert_width  = '300';
					$advert_height = '250';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 2) {
		          	$advert_width  = '336';
					$advert_height = '280';
				} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 3)  {
		          	$advert_width  = '728';
					$advert_height = '90';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 4)  {
		          	$advert_width  = '300';
					$advert_height = '600';
	            } elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 5)  {
		          	$advert_width  = '320';
					$advert_height = '100';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 6)  {
		          	$advert_width  = '200';
					$advert_height = '50';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-3'] == 7)  {
		          	$advert_width  = '320';
					$advert_height = '50';
	      		}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-3"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . '
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-3'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-3'] .'">';
				$output	.=	'</amp-ad>';
				$output	.=   ' </div>';
				echo $output;
			}
		}

		// Below Content Single
			add_action('ampforwp_after_post_content','ampforwp_after_post_content_advert');
			// Hook updated
		//	add_action('ampforwp_inside_post_content_after','ampforwp_after_post_content_advert');
		function ampforwp_after_post_content_advert() {
			global $redux_builder_amp;

			if($redux_builder_amp['enable-amp-ads-4'] == true) {
				if($redux_builder_amp['enable-amp-ads-select-4'] == 1)  {
					$advert_width  = '300';
					$advert_height = '250';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 2) {
		          	$advert_width  = '336';
					$advert_height = '280';
				} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 3)  {
		          	$advert_width  = '728';
					$advert_height = '90';
	           	} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 4)  {
		          	$advert_width  = '300';
					$advert_height = '600';
	            } elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 5)  {
		          	$advert_width  = '320';
					$advert_height = '100';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 6)  {
		          	$advert_width  = '200';
					$advert_height = '50';
	      		} elseif ($redux_builder_amp['enable-amp-ads-select-4'] == 7)  {
		          	$advert_width  = '320';
					$advert_height = '50';
	      		}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-4"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . '
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-4'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-4'] .'">';
				$output	.=	'</amp-ad>';
				$output	.=   ' </div>';
				echo $output;
			}
		}

		// Below The Title

		add_action('ampforwp_below_the_title','ampforwp_below_the_title_advert');


		function ampforwp_below_the_title_advert() {
			global $redux_builder_amp;

			if($redux_builder_amp['enable-amp-ads-5'] == true) {
				if($redux_builder_amp['enable-amp-ads-select-5'] == 1)  {
					$advert_width  = '300';
					$advert_height = '250';
				} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 2) {
								$advert_width  = '336';
					$advert_height = '280';
				} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 3)  {
								$advert_width  = '728';
					$advert_height = '90';
				} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 4)  {
								$advert_width  = '300';
					$advert_height = '600';
				} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 5)  {
								$advert_width  = '320';
					$advert_height = '100';
				} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 6)  {
								$advert_width  = '200';
					$advert_height = '50';
				} elseif ($redux_builder_amp['enable-amp-ads-select-5'] == 7)  {
								$advert_width  = '320';
					$advert_height = '50';
						}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-5"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . '
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-5'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-5'] .'">';
				$output	.=	'</amp-ad>';
				$output	.=   ' </div>';
				echo $output;
			}
		}


		// Above Related post

		add_action('ampforwp_above_related_post','ampforwp_above_related_post_advert');


		function ampforwp_above_related_post_advert() {
			global $redux_builder_amp;

			if($redux_builder_amp['enable-amp-ads-6'] == true) {
				if($redux_builder_amp['enable-amp-ads-select-6'] == 1)  {
					$advert_width  = '300';
					$advert_height = '250';
				} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 2) {
								$advert_width  = '336';
					$advert_height = '280';
				} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 3)  {
								$advert_width  = '728';
					$advert_height = '90';
				} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 4)  {
								$advert_width  = '300';
					$advert_height = '600';
				} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 5)  {
								$advert_width  = '320';
					$advert_height = '100';
				} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 6)  {
								$advert_width  = '200';
					$advert_height = '50';
				} elseif ($redux_builder_amp['enable-amp-ads-select-6'] == 7)  {
								$advert_width  = '320';
					$advert_height = '50';
						}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-6"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . '
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-6'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-6'] .'">';
				$output	.=	'</amp-ad>';
				$output	.=   ' </div>';
				echo $output;
			}
		}


	// 10. Analytics Area
		add_action('amp_post_template_footer','ampforwp_analytics',11);
		function ampforwp_analytics() {

			// 10.1 Analytics Support added for Google Analytics
				global $redux_builder_amp;
				if ( $redux_builder_amp['amp-analytics-select-option']=='1' ){ ?>
						<amp-analytics type="googleanalytics" id="analytics1">
							<script type="application/json">
							{
							  "vars": {
							    "account": "<?php global $redux_builder_amp; echo $redux_builder_amp['ga-feild']; ?>"
							  },
							  "triggers": {
							    "trackPageview": {
							      "on": "visible",
							      "request": "pageview"
							    }
							  }
							}
							</script>
						</amp-analytics>
						<?php
					}//code ends for supporting Google Analytics

			// 10.2 Analytics Support added for segment.com
				if ( $redux_builder_amp['amp-analytics-select-option']=='2' ) { ?>
						<amp-analytics type="segment">
							<script type="application/json">
							{
							  "vars": {
							    "writeKey": "<?php global $redux_builder_amp; echo $redux_builder_amp['sa-feild']; ?>",
									"name": "<?php echo the_title(); ?>"
							  }
							}
							</script>
						</amp-analytics>
						<?php
					}

			// 10.3 Analytics Support added for Piwik
				if( $redux_builder_amp['amp-analytics-select-option']=='3' ) { ?>
						<amp-pixel src="<?php global $redux_builder_amp; echo $redux_builder_amp['pa-feild']; ?>"></amp-pixel>
				<?php }

				// 10.4 Analytics Support added for quantcast
					if ( $redux_builder_amp['amp-analytics-select-option']=='4' ) { ?>
							<amp-analytics type="quantcast">
								<script type="application/json">
								{
								  "vars": {
								    "pcode": "<?php echo $redux_builder_amp['amp-quantcast-analytics-code']; ?>",
										"labels": [ "AMPProject" ]
								  }
								}
								</script>
							</amp-analytics>
							<?php
						}

				// 10.5 Analytics Support added for comscore
					if ( $redux_builder_amp['amp-analytics-select-option']=='5' ) { ?>
							<amp-analytics type="comscore">
								<script type="application/json">
								{
								  "vars": {
								    "c1": "<?php echo $redux_builder_amp['amp-comscore-analytics-code-c1']; ?>",
								    "c2": "<?php echo $redux_builder_amp['amp-comscore-analytics-code-c2']; ?>"
								  }
								}
								</script>
							</amp-analytics>
							<?php
						}

			// 10.6 Analytics Support added for Effective Measure
				if( $redux_builder_amp['amp-analytics-select-option']=='6' ) { ?>
					<!-- BEGIN EFFECTIVE MEASURE CODE -->
					<amp-pixel src="<?php global $redux_builder_amp; echo $redux_builder_amp['eam-feild']; ?>" />
					<!--END EFFECTIVE MEASURE CODE -->
				<?php }

			//	10.7 Analytics Support added for StatCounter
				if( $redux_builder_amp['amp-analytics-select-option']=='7' ) { ?>
					<!-- BEGIN StatCounter CODE -->
					<div id="statcounter">
					<amp-pixel src="<?php global $redux_builder_amp; echo $redux_builder_amp['sc-feild']; ?>" >
					</amp-pixel> 
					</div>
					<!--END StatCounter CODE -->
				<?php }
			//	10.8 Analytics Support added for Histats Analytics
				if( $redux_builder_amp['amp-analytics-select-option']=='8' ) { ?>
					<!-- BEGIN Histats CODE -->
					<div id="histats">
					<amp-pixel src="//sstatic1.histats.com/0.gif?<?php global $redux_builder_amp; echo $redux_builder_amp['histats-feild']; ?>&101" >
					</amp-pixel> 
					</div>
					<!--END Histats CODE -->
				<?php }
			// 10.9 Analytics Support added for Yandex Metrika Analytics
				global $redux_builder_amp;
				if ( $redux_builder_amp['amp-analytics-select-option']=='9' ){ ?>
						<amp-analytics type="metrika"> 
    					<script type="application/json"> 
      					  { 
            					"vars": { 
               							 "counterId": "<?php global $redux_builder_amp; echo $redux_builder_amp['amp-Yandex-Metrika-analytics-code']; ?>" 
          								  }, 
           						 "triggers": { 
             							   "notBounce": { 
                  								  "on": "timer", 
                  								  "timerSpec": { 
                       							  "immediate": false, 
                        						  "interval": 15, 
                      							  "maxTimerLength": 16 
                  							  					}, 
                   						   "request": "notBounce" 
               											 } 
           									  } 
        				   } 
    					</script> 
						</amp-analytics> 
						<?php }//code ends for supporting Yandex Metrika Analytics
			// 10.10 Analytics Support added for Chartbeat Analytics
				global $redux_builder_amp;
				if ( $redux_builder_amp['amp-analytics-select-option']=='10' ){ ?>
						<amp-analytics type="chartbeat">
 						 <script type="application/json">
   						 {
     						'vars': {
        							'accountId':"<?php global $redux_builder_amp; echo $redux_builder_amp['amp-Chartbeat-analytics-code']; ?>",
        							'title': "<?php the_title(); ?>",
      								'authors': "<?php the_author_meta('display_name');?>",      
        							'dashboardDomain': "<?php echo site_url();?>"        
     								  }
   						 }
 						 </script>
						</amp-analytics>
						<?php
					}//code ends for supporting Chartbeat Analytics
		}//analytics function ends here

	// 11. Strip unwanted codes and tags from the_content
		add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content');
		function ampforwp_strip_invalid_content() {
			add_filter( 'the_content', 'ampforwp_the_content_filter', 2 );
		}
		function ampforwp_the_content_filter( $content ) {
				 $content = preg_replace('/property=[^>]*/', '', $content);
				 $content = preg_replace('/vocab=[^>]*/', '', $content);
				//  $content = preg_replace('/type=[^>]*/', '', $content);
				 $content = preg_replace('/value=[^>]*/', '', $content);
				//  $content = preg_replace('/date=[^>]*/', '', $content);
				 $content = preg_replace('/noshade=[^>]*/', '', $content);
				 $content = preg_replace('/contenteditable=[^>]*/', '', $content);
				//  $content = preg_replace('/time=[^>]*/', '', $content);
				 $content = preg_replace('/non-refundable=[^>]*/', '', $content);
				 $content = preg_replace('/security=[^>]*/', '', $content);
				 $content = preg_replace('/deposit=[^>]*/', '', $content);
				 $content = preg_replace('/for=[^>]*/', '', $content);
				 $content = preg_replace('/nowrap="nowrap"/', '', $content);
				 $content = preg_replace('#<comments-count.*?>(.*?)</comments-count>#i', '', $content);
				 $content = preg_replace('#<time.*?>(.*?)</time>#i', '', $content);
				 $content = preg_replace('#<badge.*?>(.*?)</badge>#i', '', $content);
				 $content = preg_replace('#<plusone.*?>(.*?)</plusone>#i', '', $content);
				 $content = preg_replace('#<col.*?>#i', '', $content);
				 $content = preg_replace('#<table.*?>#i', '<table width="100%">', $content);
				 /* Removed So Inline style can work
				 $content = preg_replace('#<style scoped.*?>(.*?)</style>#i', '', $content); */
				 $content = preg_replace('/href="javascript:void*/', ' ', $content);
				 $content = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $content);
				 //for removing attributes within html tags
				 $content = preg_replace('/(<[^>]+) onclick=".*?"/', '$1', $content);
				 /* Removed So Inline style can work
				 $content = preg_replace('/(<[^>]+) style=".*?"/', '$1', $content);
				 */
				 //$content = preg_replace('/(<[^>]+) rel=".*?"/', '$1', $content);
				 $content = preg_replace('/<div(.*?) rel=".*?"(.*?)/', '<div $1', $content);
				 $content = preg_replace('/(<[^>]+) ref=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) date=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) time=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) imap=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) date/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) spellcheck/', '$1', $content);
				 $content = preg_replace('/<font(.*?)>(.*?)<\/font>/', '$2', $content);

				 //removing scripts and rel="nofollow" from Body and from divs
				 //issue #268
				 //$content = str_replace(' rel="nofollow"',"",$content);
				 $content = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $content);
				/// simpy add more elements to simply strip tag but not the content as so
				/// Array ("p","font");
				$tags_to_strip = Array("thrive_headline","type","date","time","place","state","city" );
				$tags_to_strip = apply_filters('ampforwp_strip_bad_tags', $tags_to_strip);
				foreach ($tags_to_strip as $tag)
				{
				   $content = preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/",'',$content);
				}
				// regex on steroids from here on
				 // issue #420
				 $content = preg_replace("/<div\s(class=.*?)(href=((".'"|'."'".')(.*?)("|'."'".')))\s(width=("|'."'".')(.*?)("|'."'"."))>(.*)<\/div>/i", '<div $1>$11</div>', $content);
				 $content = preg_replace('/<like\s(.*?)>(.*)<\/like>/i', '', $content);
				 $content = preg_replace('/<g:plusone\s(.*?)>(.*)<\/g:plusone>/i', '', $content);
				 $content = preg_replace('/imageanchor="1"/i', '', $content);
				 $content = preg_replace('/<plusone\s(.*?)>(.*?)<\/plusone>/', '', $content);
				 $content = preg_replace('/xml:lang=[^>]*/', '', $content);

				//				 $content = preg_replace('/<img*/', '<amp-img', $content); // Fallback for plugins
				// Removing the type attribute from the <ul>
				 $content = preg_replace('/<ul(.*?)type=".*?"(.*?)/','<ul $1',$content);
				return $content;
		}


	// 11.1 Strip unwanted codes and tags from wp_footer for better compatibility with Plugins
		if ( ! is_customize_preview() ) {
			add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content_footer');
		}
		function ampforwp_strip_invalid_content_footer() {
			add_filter( 'wp_footer', 'ampforwp_the_content_filter_footer', 1 );
		}
		function ampforwp_the_content_filter_footer( $content ) {
            remove_all_actions('wp_footer');
				return $content;
		}

	// 11.5 Strip unwanted codes the_content of Frontpage
    add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content_frontpage');
        function ampforwp_strip_invalid_content_frontpage(){
            if ( is_front_page() || is_home() ) {
			add_filter( 'the_content', 'ampforwp_the_content_filter_frontpage', 20 );
            }
		}
		function ampforwp_the_content_filter_frontpage( $content ) {
				 $content = preg_replace('/<img*/', '<amp-img', $content); // Fallback for plugins
				return $content;
		}

		// 12. Add Logo URL in the structured metadata
	    add_filter( 'amp_post_template_metadata', 'ampforwp_update_metadata', 10, 2 );
	    function ampforwp_update_metadata( $metadata, $post ) {
	        global $redux_builder_amp;
	        $structured_data_logo = '';
	        $structured_data_main_logo = '';
	        $ampforwp_sd_height = '';
	        $ampforwp_sd_width = '';
	        $ampforwp_sd_height = $redux_builder_amp['ampforwp-sd-logo-height'];
	        $ampforwp_sd_width = $redux_builder_amp['ampforwp-sd-logo-width'];
	        if (! empty( $redux_builder_amp['opt-media']['url'] ) ) {
	          $structured_data_main_logo = $redux_builder_amp['opt-media']['url'];
	        }
	        if (! empty( $redux_builder_amp['amp-structured-data-logo']['url'] ) ) {
	          $structured_data_logo = $redux_builder_amp['amp-structured-data-logo']['url'];
	        }
	        if ( $structured_data_logo ) {
	          $structured_data_logo = $structured_data_logo;
	        } else {
	          $structured_data_logo = $structured_data_main_logo;
	        }
	        $metadata['publisher']['logo'] = array(
	          '@type'   => 'ImageObject',
	          'url'     =>  $structured_data_logo ,
	          'height'  => $ampforwp_sd_height,
	          'width'   => $ampforwp_sd_width,
	        );

	        //code for adding 'description' meta from Yoast SEO

	        if($redux_builder_amp['ampforwp-seo-yoast-description']){
	         if ( class_exists('WPSEO_Frontend') ) {
	           $front = WPSEO_Frontend::get_instance();
	           $desc = $front->metadesc( false );
	           if ( $desc ) {
	             $metadata['description'] = $desc;
	           }

	           // Code for Custom Frontpage Yoast SEO Description
	           $post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	           if ( class_exists('WPSEO_Meta') ) {
	             $custom_fp_desc = WPSEO_Meta::get_value('metadesc', $post_id );
	             if ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] ) {
	               if ( $custom_fp_desc ) {
	                 $metadata['description'] = $custom_fp_desc;
	               } else {
	                 unset( $metadata['description'] );
	               }
	             }
	           }
	         }
	        }
	        //End of code for adding 'description' meta from Yoast SEO
	        return $metadata;
	    }


	// 13. Add Custom Placeholder Image for Structured Data.
	// if there is no image in the post, then use this image to validate Structured Data.
	add_filter( 'amp_post_template_metadata', 'ampforwp_update_metadata_featured_image', 10, 2 );
	function ampforwp_update_metadata_featured_image( $metadata, $post ) {
			global $redux_builder_amp;
			global $post;
			$post_id = get_the_ID() ;
			$post_image_id = get_post_thumbnail_id( $post_id );
			$structured_data_image = wp_get_attachment_image_src( $post_image_id, 'full' );
			$post_image_check = $structured_data_image;
			$structured_data_image_url = '';

			if ( $post_image_check == false) {
				if (! empty( $redux_builder_amp['amp-structured-data-placeholder-image']['url'] ) ) {
					$structured_data_image_url = $redux_builder_amp['amp-structured-data-placeholder-image']['url'];
				}
					$structured_data_image = $structured_data_image_url;
					$structured_data_height = intval($redux_builder_amp['amp-structured-data-placeholder-image-height']);
					$structured_data_width = intval($redux_builder_amp['amp-structured-data-placeholder-image-width']);

					$metadata['image'] = array(
						'@type' 	=> 'ImageObject',
						'url' 		=> $structured_data_image ,
						'height' 	=> $structured_data_height,
						'width' 	=> $structured_data_width,
					);
			}
			// Custom Structured Data information for Archive, Categories and tag pages.
			if ( is_archive() ) {
					$structured_data_image = $redux_builder_amp['amp-structured-data-placeholder-image']['url'];
					$structured_data_height = intval($redux_builder_amp['amp-structured-data-placeholder-image-height']);
					$structured_data_width = intval($redux_builder_amp['amp-structured-data-placeholder-image-width']);

					$structured_data_archive_title 	= "Archived Posts";
					$structured_data_author				=  get_userdata( 1 );
							if ( $structured_data_author ) {
								$structured_data_author 		= $structured_data_author->display_name ;
							} else {
								$structured_data_author 		= "admin";
							}

					$metadata['image'] = array(
						'@type' 	=> 'ImageObject',
						'url' 		=> $structured_data_image ,
						'height' 	=> $structured_data_height,
						'width' 	=> $structured_data_width,
					);
					$metadata['author'] = array(
						'@type' 	=> 'Person',
						'name' 		=> $structured_data_author ,
					);
					$metadata['headline'] = $structured_data_archive_title;
			}

			if( in_array( "image" , $metadata )  ) {
				if ( $metadata['image']['width'] < 696 ) {
		 			$metadata['image']['width'] = 700 ;
	     	}
			}


			return $metadata;
	}

// 14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
/**
 * Adds a meta box to the post editing screen for AMP on-off on specific pages
*/
function ampforwp_get_all_post_types(){
	global $redux_builder_amp;

    $post_types = array('post' => 'post', 'page' => 'page');
    if ( $redux_builder_amp['ampforwp-custom-type'] ) {
    	$post_types = array_merge($post_types, $redux_builder_amp['ampforwp-custom-type']);
    }
    return $post_types;
}
function ampforwp_title_custom_meta() {
  global $redux_builder_amp;

    $post_types = ampforwp_get_all_post_types();

    if ( $post_types ) { // If there are any custom public post types.

        foreach ( $post_types  as $post_type ) {

          if( $post_type == 'amp-cta' || $post_type == 'amp-optin' ) {
							continue;
          }

          if( $post_type !== 'page' ) {
            add_meta_box( 'ampforwp_title_meta', __( 'Show AMP for Current Page?','accelerated-mobile-pages' ), 'ampforwp_title_callback', $post_type,'side' );
           
          }

          if( $redux_builder_amp['amp-on-off-for-all-pages'] && $post_type == 'page' ) {
              add_meta_box( 'ampforwp_title_meta', __( 'Show AMP for Current Page?' ,'accelerated-mobile-pages'), 'ampforwp_title_callback','page','side' );
               }

          
          }

        }
    }

add_action( 'add_meta_boxes', 'ampforwp_title_custom_meta' );

/**
 * Outputs the content of the meta box for AMP on-off on specific pages
 */
function ampforwp_title_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ampforwp_title_nonce' );
    $ampforwp_stored_meta = get_post_meta( $post->ID );

    	// TODO: Move the data storage code, to Save meta Box area as it is not a good idea to update an option everytime, try adding this code inside ampforwp_title_meta_save()
    	// This code needs a rewrite.
		if ( $ampforwp_stored_meta['ampforwp-amp-on-off'][0] == 'hide-amp') {
			$exclude_post_value = get_option('ampforwp_exclude_post');
			if ( $exclude_post_value == null ) {
				$exclude_post_value[] = 0;
			}
			if ( $exclude_post_value ) {
				if ( ! in_array( $post->ID, $exclude_post_value ) ) {
					$exclude_post_value[] = $post->ID;
					update_option('ampforwp_exclude_post', $exclude_post_value);
				}
			}
		} else {
			$exclude_post_value = get_option('ampforwp_exclude_post');
			if ( $exclude_post_value == null ) {
				$exclude_post_value[] = 0;
			}
			if ( $exclude_post_value ) {
				if ( in_array( $post->ID, $exclude_post_value ) ) {
					$exclude_ids = array_diff($exclude_post_value, array($post->ID) );
					update_option('ampforwp_exclude_post', $exclude_ids);
				}
			}

		}
        ?>
    <p>
        <div class="prfx-row-content">
            <label for="meta-radio-one">
                <input type="radio" name="ampforwp-amp-on-off" id="meta-radio-one" value="default"  checked="checked" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-amp-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-amp-on-off'][0], 'default' ); ?>>
                <?php _e( 'Show' )?>
            </label>
            <label for="meta-radio-two">
                <input type="radio" name="ampforwp-amp-on-off" id="meta-radio-two" value="hide-amp" <?php if ( isset ( $ampforwp_stored_meta['ampforwp-amp-on-off'] ) ) checked( $ampforwp_stored_meta['ampforwp-amp-on-off'][0], 'hide-amp' ); ?>>
                <?php _e( 'Hide' )?>
            </label>
        </div>
    </p>



    <?php
}

/**
 * Adds a meta box to the post editing screen for Mobile Redirection on-off on specific pages
 */ 

function ampforwp_mobile_redirection() {
  	global $redux_builder_amp;
    $post_types = ampforwp_get_all_post_types();

    if ( $post_types ) { // If there are any custom public post types.

        foreach ( $post_types  as $post_type ) {

	        if( $post_type == 'amp-cta' || $post_type == 'amp-optin' ) {
				continue;
	        }
	        if( $post_type !== 'page' ) {
	        	if ( $redux_builder_amp['amp-mobile-redirection'] ) {
	        		add_meta_box( 'ampforwp_title_meta_redir', __( 'Mobile Redirection for Current Page?','accelerated-mobile-pages' ), 'ampforwp_title_callback_redirection', $post_type,'side' );
	        	}
	        }

          	if( $redux_builder_amp['amp-on-off-for-all-pages'] && $post_type == 'page' ) {
	          	if ( $redux_builder_amp['amp-mobile-redirection'] ) {
		          	add_meta_box( 'ampforwp_title_meta_redir', __( 'Mobile Redirection for Current Page?' ,'accelerated-mobile-pages'), 'ampforwp_title_callback_redirection','page','side' );
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
    $ampforwp_redirection_stored_meta = get_post_meta( $post->ID );

    	// TODO: Move the data storage code, to Save meta Box area as it is not a good idea to update an option everytime, try adding this code inside ampforwp_title_meta_save()
    	// This code needs a rewrite.
		if ( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'][0] == 'disable') {
			$exclude_post_value = get_option('ampforwp_exclude_post');
			if ( $exclude_post_value == null ) {
				$exclude_post_value[] = 0;
			}
			if ( $exclude_post_value ) {
				if ( ! in_array( $post->ID, $exclude_post_value ) ) {
					$exclude_post_value[] = $post->ID;
					update_option('ampforwp_exclude_post', $exclude_post_value);
				}
			}
		} else {
			$exclude_post_value = get_option('ampforwp_exclude_post');
			if ( $exclude_post_value == null ) {
				$exclude_post_value[] = 0;
			}
			if ( $exclude_post_value ) {
				if ( in_array( $post->ID, $exclude_post_value ) ) {
					$exclude_ids = array_diff($exclude_post_value, array($post->ID) );
					update_option('ampforwp_exclude_post', $exclude_ids);
				}
			}

		}
        ?>
    <p>
        <div class="prfx-row-content">
            <label for="meta-redirection-radio-one">
                <input type="radio" name="ampforwp-redirection-on-off" id="meta-redirection-radio-one" value="enable"  checked="checked" <?php if ( isset ( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'] ) ) checked( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'][0], 'enable' ); ?>>
                <?php _e( 'Enable' )?>
            </label>
            <label for="meta-redirection-radio-two">
                <input type="radio" name="ampforwp-redirection-on-off" id="meta-redirection-radio-two" value="disable" <?php if ( isset ( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'] ) ) checked( $ampforwp_redirection_stored_meta['ampforwp-redirection-on-off'][0], 'disable' ); ?>>
                <?php _e( 'Disable' )?>
            </label>
        </div>
    </p>

    <?php
}

function ampforwp_meta_redirection_status(){
	global $post;
	$ampforwp_redirection_post_on_off_meta = '';

	$ampforwp_redirection_post_on_off_meta = get_post_meta( $post->ID,'ampforwp-redirection-on-off',true);

	if ( empty( $ampforwp_redirection_post_on_off_meta ) ) {
		$ampforwp_redirection_post_on_off_meta = 'enable';
	}

	return $ampforwp_redirection_post_on_off_meta;

}

/**
 * Saves the custom meta input for AMP on-off on specific pages
 */
function ampforwp_title_meta_save( $post_id ) {
	$ampforwp_amp_status = '';

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'ampforwp_title_nonce' ] ) && wp_verify_nonce( $_POST[ 'ampforwp_title_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for radio buttons and saves if needed
    if( isset( $_POST[ 'ampforwp-amp-on-off' ] ) ) {
        $ampforwp_amp_status = sanitize_text_field( $_POST[ 'ampforwp-amp-on-off' ] );
        update_post_meta( $post_id, 'ampforwp-amp-on-off', $ampforwp_amp_status );
    }

     if( isset( $_POST[ 'ampforwp-redirection-on-off' ] ) ) {
        $ampforwp_redirection_status = sanitize_text_field( $_POST[ 'ampforwp-redirection-on-off' ] );
        update_post_meta( $post_id, 'ampforwp-redirection-on-off', $ampforwp_redirection_status );
    }

}
add_action( 'save_post', 'ampforwp_title_meta_save' );

add_filter('amp_frontend_show_canonical','ampforwp_hide_amp_for_specific_pages');
function ampforwp_hide_amp_for_specific_pages($input){
		global $post;
		$ampforwp_amp_status = get_post_meta($post->ID, 'ampforwp-amp-on-off', true);
		if ( $ampforwp_amp_status == 'hide-amp' ) {
			$input = false;
		}
		return $input;
}

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
add_action( 'template_redirect', 'ampforwp_remove_print_scripts' );

// 17. Archives Canonical in AMP version
// function ampforwp_rel_canonical_archive() {
//
// 			//    $archivelink = esc_url( get_permalink( $id ) . AMPFORWP_AMP_QUERY_VAR . '/' );
//   		echo "<link rel='canonical' href='$current_archive_url' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical_archive' );

// 18. Custom Canonical for Homepage
// function ampforwp_rel_canonical() {
//     if ( !is_home() )
//     return;
// //    $link = esc_url( get_permalink( $id ) . AMPFORWP_AMP_QUERY_VAR . '/' );
//     $homelink = get_home_url();
//     echo "<link rel='canonical' href='$homelink' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical' );

// 18.5. Custom Canonical for Frontpage
// function ampforwp_rel_canonical_frontpage() {
//    if ( is_home() || is_front_page() )
//    return;
// //    $link = esc_url( get_permalink( $id ) . AMPFORWP_AMP_QUERY_VAR . '/' );
//    $homelink = get_home_url();
//    echo "<link rel='canonical' href='$homelink' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical_frontpage' );

// 19. Remove Canonical tags
function ampforwp_amp_remove_actions() {
    if ( is_home() || is_front_page() || is_archive() || is_search() ) {
        remove_action( 'amp_post_template_head', 'amp_post_template_add_canonical' );
    }
}
add_action( 'amp_post_template_head', 'ampforwp_amp_remove_actions', 9 );

// 20. Remove the default Google font for performance
// add_action( 'amp_post_template_head', function() {
//     remove_action( 'amp_post_template_head', 'amp_post_template_add_fonts' );
// }, 9 );

// 21. Remove Schema data from All In One Schema.org Rich Snippets Plugin 
add_action( 'pre_amp_render_post', 'ampforwp_remove_schema_data' );
function ampforwp_remove_schema_data() {
	remove_filter('the_content','display_rich_snippet');
    	// Ultimate Social Media PLUS Compatiblity Added
	remove_filter('the_content','sfsi_plus_beforaftereposts');
	remove_filter('the_content','sfsi_plus_beforeafterblogposts');
 

	// Thrive Content Builder
	$amp_custom_content_enable = get_post_meta( get_the_ID() , 'ampforwp_custom_content_editor_checkbox', true);
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

	// Remove Popups and other elements added by Slider-in Plugin
	define('WDSI_BOX_RENDERED', true, true);
	
	// Remove Filters added by third party plugin through class
	if ( function_exists('ampforwp_remove_filters_for_class')) {
		//Remove Disallowed 'like' tag from facebook Like button by Ultimate Facebook
		ampforwp_remove_filters_for_class( 'the_content', 'Wdfb_UniversalWorker', 'inject_facebook_button', 10 );
		//Compatibility with Sassy Social Share Plugin
		ampforwp_remove_filters_for_class( 'the_content', 'Sassy_Social_Share_Public', 'render_sharing', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_head', 'Sassy_Social_Share_Public', 'frontend_scripts', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_css', 'Sassy_Social_Share_Public', 'frontend_inline_style', 10 );
		ampforwp_remove_filters_for_class( 'amp_post_template_css', 'Sassy_Social_Share_Public', 'frontend_amp_css', 10 );
		//Removing the Monarch social share icons from AMP
		ampforwp_remove_filters_for_class( 'the_content', 'ET_Monarch', 'display_inline', 10 );
		ampforwp_remove_filters_for_class( 'the_content', 'ET_Monarch', 'display_media', 9999 );
		//Compatibility with wordpress twitter bootstrap #525
		ampforwp_remove_filters_for_class( 'the_content', 'ICWP_WPTB_CssProcessor_V1', 'run', 10 );
		//Perfect SEO url + Yoast SEO Compatibility #982
		ampforwp_remove_filters_for_class( 'wpseo_canonical', 'PSU', 'canonical', 10 );
	}
	//Removing the WPTouch Pro social share links from AMP
		remove_filter( 'the_content', 'foundation_handle_share_links_bottom', 100 );
	//Removing the space added by the Google adsense #967
		remove_filter( 'the_content', 'ga_strikable_add_optimized_adsense_code');
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
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( !is_plugin_active( 'amp-cta/amp-cta.php' ) )  {
		if($redux_builder_amp['enable-single-social-icons'] == true && is_single() )  { ?>
			<div class="sticky_social">
				<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
			    	<amp-social-share type="facebook"    data-param-app_id="<?php echo $redux_builder_amp['amp-facebook-app-id']; ?>" width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  {
	          $data_param_data = $redux_builder_amp['enable-single-twitter-share-handle'];?>
	          <amp-social-share type="twitter"
	                            width="50"
	                            height="28"
	                            data-param-url=""
                        		data-param-text="TITLE <?php echo wp_get_shortlink().' '.ampforwp_translation( $redux_builder_amp['amp-translator-via-text'], 'via' ).' '.$data_param_data ?>"
	          ></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
			    	<amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
			    	<amp-social-share type="email"      width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
			    	<amp-social-share type="pinterest"  width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
			    	<amp-social-share type="linkedin" width="50" height="28"></amp-social-share>
			  	<?php } ?>
			  	<?php if($redux_builder_amp['enable-single-whatsapp-share'] == true)  { ?>
							<a href="whatsapp://send?text=<?php echo get_the_permalink();?>">
							<div class="custom-amp-socialsharing-icon">
							    <amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTAgOTAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkwIDkwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IldoYXRzQXBwIiBkPSJNOTAsNDMuODQxYzAsMjQuMjEzLTE5Ljc3OSw0My44NDEtNDQuMTgyLDQzLjg0MWMtNy43NDcsMC0xNS4wMjUtMS45OC0yMS4zNTctNS40NTVMMCw5MGw3Ljk3NS0yMy41MjIgICBjLTQuMDIzLTYuNjA2LTYuMzQtMTQuMzU0LTYuMzQtMjIuNjM3QzEuNjM1LDE5LjYyOCwyMS40MTYsMCw0NS44MTgsMEM3MC4yMjMsMCw5MCwxOS42MjgsOTAsNDMuODQxeiBNNDUuODE4LDYuOTgyICAgYy0yMC40ODQsMC0zNy4xNDYsMTYuNTM1LTM3LjE0NiwzNi44NTljMCw4LjA2NSwyLjYyOSwxNS41MzQsNy4wNzYsMjEuNjFMMTEuMTA3LDc5LjE0bDE0LjI3NS00LjUzNyAgIGM1Ljg2NSwzLjg1MSwxMi44OTEsNi4wOTcsMjAuNDM3LDYuMDk3YzIwLjQ4MSwwLDM3LjE0Ni0xNi41MzMsMzcuMTQ2LTM2Ljg1N1M2Ni4zMDEsNi45ODIsNDUuODE4LDYuOTgyeiBNNjguMTI5LDUzLjkzOCAgIGMtMC4yNzMtMC40NDctMC45OTQtMC43MTctMi4wNzYtMS4yNTRjLTEuMDg0LTAuNTM3LTYuNDEtMy4xMzgtNy40LTMuNDk1Yy0wLjk5My0wLjM1OC0xLjcxNy0wLjUzOC0yLjQzOCwwLjUzNyAgIGMtMC43MjEsMS4wNzYtMi43OTcsMy40OTUtMy40Myw0LjIxMmMtMC42MzIsMC43MTktMS4yNjMsMC44MDktMi4zNDcsMC4yNzFjLTEuMDgyLTAuNTM3LTQuNTcxLTEuNjczLTguNzA4LTUuMzMzICAgYy0zLjIxOS0yLjg0OC01LjM5My02LjM2NC02LjAyNS03LjQ0MWMtMC42MzEtMS4wNzUtMC4wNjYtMS42NTYsMC40NzUtMi4xOTFjMC40ODgtMC40ODIsMS4wODQtMS4yNTUsMS42MjUtMS44ODIgICBjMC41NDMtMC42MjgsMC43MjMtMS4wNzUsMS4wODItMS43OTNjMC4zNjMtMC43MTcsMC4xODItMS4zNDQtMC4wOS0xLjg4M2MtMC4yNy0wLjUzNy0yLjQzOC01LjgyNS0zLjM0LTcuOTc3ICAgYy0wLjkwMi0yLjE1LTEuODAzLTEuNzkyLTIuNDM2LTEuNzkyYy0wLjYzMSwwLTEuMzU0LTAuMDktMi4wNzYtMC4wOWMtMC43MjIsMC0xLjg5NiwwLjI2OS0yLjg4OSwxLjM0NCAgIGMtMC45OTIsMS4wNzYtMy43ODksMy42NzYtMy43ODksOC45NjNjMCw1LjI4OCwzLjg3OSwxMC4zOTcsNC40MjIsMTEuMTEzYzAuNTQxLDAuNzE2LDcuNDksMTEuOTIsMTguNSwxNi4yMjMgICBDNTguMiw2NS43NzEsNTguMiw2NC4zMzYsNjAuMTg2LDY0LjE1NmMxLjk4NC0wLjE3OSw2LjQwNi0yLjU5OSw3LjMxMi01LjEwN0M2OC4zOTgsNTYuNTM3LDY4LjM5OCw1NC4zODYsNjguMTI5LDUzLjkzOHoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="50" height="20" />
							    </div>
								</a>
	        <?php } ?>
	        <?php if($redux_builder_amp['enable-single-line-share'] == true)  { ?>
			<a href="http://line.me/R/msg/text/?<?php echo get_the_permalink(); ?>">
				<div class="custom-amp-socialsharing-icon custom-amp-socialsharing-line">
					<amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI5Ni41MjggMjk2LjUyOCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjk2LjUyOCAyOTYuNTI4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI5NS44MzgsMTE1LjM0N2wwLjAwMy0wLjAwMWwtMC4wOTItMC43NmMtMC4wMDEtMC4wMTMtMC4wMDItMC4wMjMtMC4wMDQtMC4wMzZjLTAuMDAxLTAuMDExLTAuMDAyLTAuMDIxLTAuMDA0LTAuMDMyICAgbC0wLjM0NC0yLjg1OGMtMC4wNjktMC41NzQtMC4xNDgtMS4yMjgtMC4yMzgtMS45NzRsLTAuMDcyLTAuNTk0bC0wLjE0NywwLjAxOGMtMy42MTctMjAuNTcxLTEzLjU1My00MC4wOTMtMjguOTQyLTU2Ljc2MiAgIGMtMTUuMzE3LTE2LjU4OS0zNS4yMTctMjkuNjg3LTU3LjU0OC0zNy44NzhjLTE5LjEzMy03LjAxOC0zOS40MzQtMTAuNTc3LTYwLjMzNy0xMC41NzdjLTI4LjIyLDAtNTUuNjI3LDYuNjM3LTc5LjI1NywxOS4xOTMgICBDMjMuMjg5LDQ3LjI5Ny0zLjU4NSw5MS43OTksMC4zODcsMTM2LjQ2MWMyLjA1NiwyMy4xMTEsMTEuMTEsNDUuMTEsMjYuMTg0LDYzLjYyMWMxNC4xODgsMTcuNDIzLDMzLjM4MSwzMS40ODMsNTUuNTAzLDQwLjY2ICAgYzEzLjYwMiw1LjY0MiwyNy4wNTEsOC4zMDEsNDEuMjkxLDExLjExNmwxLjY2NywwLjMzYzMuOTIxLDAuNzc2LDQuOTc1LDEuODQyLDUuMjQ3LDIuMjY0YzAuNTAzLDAuNzg0LDAuMjQsMi4zMjksMC4wMzgsMy4xOCAgIGMtMC4xODYsMC43ODUtMC4zNzgsMS41NjgtMC41NywyLjM1MmMtMS41MjksNi4yMzUtMy4xMSwxMi42ODMtMS44NjgsMTkuNzkyYzEuNDI4LDguMTcyLDYuNTMxLDEyLjg1OSwxNC4wMDEsMTIuODYgICBjMC4wMDEsMCwwLjAwMSwwLDAuMDAyLDBjOC4wMzUsMCwxNy4xOC01LjM5LDIzLjIzMS04Ljk1NmwwLjgwOC0wLjQ3NWMxNC40MzYtOC40NzgsMjguMDM2LTE4LjA0MSwzOC4yNzEtMjUuNDI1ICAgYzIyLjM5Ny0xNi4xNTksNDcuNzgzLTM0LjQ3NSw2Ni44MTUtNTguMTdDMjkwLjE3MiwxNzUuNzQ1LDI5OS4yLDE0NS4wNzgsMjk1LjgzOCwxMTUuMzQ3eiBNOTIuMzQzLDE2MC41NjFINjYuNzYxICAgYy0zLjg2NiwwLTctMy4xMzQtNy03Vjk5Ljg2NWMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDd2NDYuNjk2aDE4LjU4MWMzLjg2NiwwLDcsMy4xMzQsNyw3ICAgQzk5LjM0MywxNTcuNDI3LDk2LjIwOSwxNjAuNTYxLDkyLjM0MywxNjAuNTYxeiBNMTE5LjAzLDE1My4zNzFjMCwzLjg2Ni0zLjEzNCw3LTcsN2MtMy44NjYsMC03LTMuMTM0LTctN1Y5OS42NzUgICBjMC0zLjg2NiwzLjEzNC03LDctN2MzLjg2NiwwLDcsMy4xMzQsNyw3VjE1My4zNzF6IE0xODIuMzA0LDE1My4zNzFjMCwzLjAzMy0xLjk1Myw1LjcyMS00LjgzOCw2LjY1OCAgIGMtMC43MTIsMC4yMzEtMS40NDEsMC4zNDMtMi4xNjEsMC4zNDNjLTIuMTk5LDAtNC4zMjMtMS4wMzktNS42NjYtMi44ODhsLTI1LjIwNy0zNC43MTd2MzAuNjA1YzAsMy44NjYtMy4xMzQsNy03LDcgICBjLTMuODY2LDAtNy0zLjEzNC03LTd2LTUyLjE2YzAtMy4wMzMsMS45NTMtNS43MjEsNC44MzgtNi42NThjMi44ODYtMC45MzYsNi4wNDUsMC4wOSw3LjgyNywyLjU0NWwyNS4yMDcsMzQuNzE3Vjk5LjY3NSAgIGMwLTMuODY2LDMuMTM0LTcsNy03YzMuODY2LDAsNywzLjEzNCw3LDdWMTUzLjM3MXogTTIzMy4zMTEsMTU5LjI2OWgtMzQuNjQ1Yy0zLjg2NiwwLTctMy4xMzQtNy03di0yNi44NDdWOTguNTczICAgYzAtMy44NjYsMy4xMzQtNyw3LTdoMzMuNTdjMy44NjYsMCw3LDMuMTM0LDcsN3MtMy4xMzQsNy03LDdoLTI2LjU3djEyLjg0OWgyMS41NjJjMy44NjYsMCw3LDMuMTM0LDcsN2MwLDMuODY2LTMuMTM0LDctNyw3ICAgaC0yMS41NjJ2MTIuODQ3aDI3LjY0NWMzLjg2NiwwLDcsMy4xMzQsNyw3UzIzNy4xNzcsMTU5LjI2OSwyMzMuMzExLDE1OS4yNjl6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" width="50" height="20" />
				</div>
			</a>
		<?php } ?>
			</div>
	<?php }
		}
}
// if ( $ampforwp_social_icons_enabled == true ) {
//
// }
//	add_action('amp_post_template_head','ampforwp_register_social_sharing_script');
function ampforwp_register_social_sharing_script() {
			if( is_socialshare_or_socialsticky_enabled_in_ampforwp() ) { ?>
				<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
<?php }
}

//	25. Yoast meta Support
function ampforwp_custom_yoast_meta(){
	global $redux_builder_amp;
	if ($redux_builder_amp['ampforwp-seo-yoast-meta']) {
		if(! class_exists('YoastSEO_AMP') ) {
				if ( class_exists('WPSEO_Options')) {
					$options = WPSEO_Options::get_option( 'wpseo_social' );
					if ( $options['twitter'] === true ) {
						WPSEO_Twitter::get_instance();
					}
					if ( $options['opengraph'] === true ) {
						$GLOBALS['wpseo_og'] = new WPSEO_OpenGraph;
					}
					do_action( 'wpseo_opengraph' );
				}
		}//execute only if Glue is deactive
	echo strip_tags($redux_builder_amp['ampforwp-seo-custom-additional-meta'], '<link><meta>' );
	} else {
		echo strip_tags($redux_builder_amp['ampforwp-seo-custom-additional-meta'], '<link><meta>' );
	}
}

function ampforwp_custom_yoast_meta_homepage(){
	global $redux_builder_amp;
	if ($redux_builder_amp['ampforwp-seo-yoast-meta']) {
		if(! class_exists('YoastSEO_AMP') ) {
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

		}//execute only if Glue is deactive
	echo strip_tags($redux_builder_amp['ampforwp-seo-custom-additional-meta'], '<link><meta>' );
	}
}

function ampforwp_add_proper_post_meta(){
	$check_custom_front_page = get_option('show_on_front');
	if ( $check_custom_front_page == 'page' ) {
		add_action( 'amp_post_template_head', 'ampforwp_custom_yoast_meta_homepage' );
		if(is_home()){
			add_filter('wpseo_opengraph_title', 'custom_twitter_title_homepage');
			add_filter('wpseo_twitter_title', 'custom_twitter_title_homepage');
	

			add_filter('wpseo_opengraph_desc', 'custom_twitter_description_homepage');
			add_filter('wpseo_twitter_description', 'custom_twitter_description_homepage');

			add_filter('wpseo_opengraph_url', 'custom_og_url_homepage');
		

		// This is causing the 2nd debug issue reported in #740
		// add_filter('wpseo_twitter_image', 'custom_og_image_homepage');
		add_filter('wpseo_opengraph_image', 'custom_og_image_homepage');
	}
	} else {
		add_action( 'amp_post_template_head', 'ampforwp_custom_yoast_meta' );
	}
}
add_action('pre_amp_render_post','ampforwp_add_proper_post_meta');


function custom_twitter_title_homepage() {
	
		return  esc_attr( get_bloginfo( 'name' ) );
}
function custom_twitter_description_homepage() {
	
	return  esc_attr( get_bloginfo( 'description' ) );
}
function custom_og_url_homepage() {
	return esc_url( get_bloginfo( 'url' ) );
}
function custom_og_image_homepage() {
	if ( class_exists('WPSEO_Options') ) {
		$options = WPSEO_Options::get_option( 'wpseo_social' );
		return  $options['og_default_image'] ;
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

	add_filter( 'pre_get_document_title', 'ampforwp_add_custom_title_tag', 10 );
	add_filter( 'wp_title', 'ampforwp_add_custom_title_tag', 10, 3 );

	function ampforwp_add_custom_title_tag( $title = '', $sep = '', $seplocation = '' ) {
		global $redux_builder_amp;
		$site_title = '';
		$genesis_title = '';

		//* We can filter this later if needed:
		$sep = ' | ';

		if ( is_singular() ) {
			global $post;
			$title = ! empty( $post->post_title ) ? $post->post_title : $title;
			$site_title = $title . $sep . get_option( 'blogname' );
		} elseif ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) {
			$site_title = strip_tags( get_the_archive_title( '' ) . $sep . get_the_archive_description( '' ) );
		}

		if ( is_home() ) {
			// Custom frontpage
			$site_title = get_bloginfo( 'name' ) . $sep . get_option( 'blogdescription' );

			if( get_option( 'page_on_front' ) && $redux_builder_amp['amp-frontpage-select-option'] ){

				$ID = $redux_builder_amp['amp-frontpage-select-option-pages'];
				$site_title = get_the_title( $ID ) . $sep . get_option( 'blogname' );
			}
			// Blog page 
			if ( get_option( 'page_for_posts' ) && get_queried_object_id() ) {
				$ID = get_option( 'page_for_posts' );
				$site_title = get_the_title( $ID ) . $sep . get_option( 'blogname' );
			}
		}

		if ( is_search() ) {
			$site_title = $redux_builder_amp['amp-translator-search-text'] . ' ' . get_search_query();
		}
		//Genesis #1013
		if(function_exists('genesis_title')){
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
			else {
				$genesis_title = genesis_default_title( $title );
			}
			if( $genesis_title ){
				$site_title = $genesis_title;
			}
		}

		return esc_html( convert_chars( wptexturize( trim( $site_title ) ) ) );
	}
}


add_action('amp_post_template_include_single','ampforwp_update_title_for_frontpage');
function ampforwp_update_title_for_frontpage() {
	$check_custom_front_page = get_option('show_on_front');

	if ( $check_custom_front_page == 'page' && is_home() ) {

		remove_action( 'amp_post_template_head', 'amp_post_template_add_title' );
		add_action('amp_post_template_head','ampforwp_frontpage_title_markup');

		add_filter('aioseop_title','ampforwp_aioseop_front_page_title');
	}
}
// Custom Frontpage title for ALL in one SEO.
function ampforwp_aioseop_front_page_title() {
	$sep = ' | ';
	return $site_title = get_bloginfo( 'name' ) . $sep . get_option( 'blogdescription' );
}

function ampforwp_frontpage_title_markup () { 
	$front_page_title = ampforwp_add_custom_title_tag();
	$front_page_title = apply_filters('ampforwp_frontpage_title_filter', $front_page_title);  
	?>

	<title> <?php echo esc_html( $front_page_title ); ?> </title> <?php
}

// 27. Clean the Defer issue
	// TODO : Get back to this issue. #407
		function ampforwp_the_content_filter_full( $content_buffer ) {
            $ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();
			if ( $ampforwp_is_amp_endpoint ) {
				$content_buffer = preg_replace("/' defer='defer/", "", $content_buffer);
				$content_buffer = preg_replace("/' defer onload='/", "", $content_buffer);
				$content_buffer = preg_replace("/' defer /", "", $content_buffer);
				$content_buffer = preg_replace("/onclick=[^>]*/", "", $content_buffer);
                $content_buffer = preg_replace("/<\\/?thrive_headline(.|\\s)*?>/",'',$content_buffer);
                // Remove Extra styling added by other Themes/ Plugins
               	$content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)<!doctype html>/','<!doctype html>',$content_buffer);
               	$content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)(\/\*)/','$4',$content_buffer);
                $content_buffer = preg_replace("/<\\/?g(.|\\s)*?>/",'',$content_buffer);
                $content_buffer = preg_replace('/(<[^>]+) spellcheck="false"/', '$1', $content_buffer);
                $content_buffer = preg_replace('/(<[^>]+) spellcheck="true"/', '$1', $content_buffer);
                $content_buffer = preg_replace("/about:blank/", "#", $content_buffer);
                $content_buffer = preg_replace("/<script data-cfasync[^>]*>.*?<\/script>/", "", $content_buffer);
                $content_buffer = preg_replace('/<font(.*?)>(.*?)<\/font>/', '$2', $content_buffer);
//$content_buffer = preg_replace('/<style type=(.*?)>|\[.*?\]\s\{(.*)\}|<\/style>(?!(<\/noscript>)|(\n<\/head>)|(<noscript>))/','',$content_buffer);

            }
            return $content_buffer;
		}
	   ob_start('ampforwp_the_content_filter_full');



// 28. Properly removes AMP if turned off from Post panel
add_filter( 'amp_skip_post', 'ampforwp_skip_amp_post', 10, 3 );
function ampforwp_skip_amp_post( $skip, $post_id, $post ) {
	$ampforwp_amp_post_on_off_meta = get_post_meta( $post->ID , 'ampforwp-amp-on-off' , true );
	if( $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
		$skip = true;
	}
    return $skip;
}

// 29. Remove analytics code if Already added by Glue or Yoast SEO (#370)
	add_action('init','remove_analytics_code_if_available',20);
	function remove_analytics_code_if_available(){
		if ( class_exists('WPSEO_Options') && class_exists('YoastSEO_AMP') ) {
			$yoast_glue_seo = get_option('wpseo_amp');

			if ( $yoast_glue_seo['analytics-extra'] ) {
				remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
				remove_action('amp_post_template_footer','ampforwp_analytics',11);
			}

			if ( class_exists('Yoast_GA_Options') ) {
				$UA = Yoast_GA_Options::instance()->get_tracking_code();
				if ( $UA ) {
					remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
					remove_action('amp_post_template_footer','ampforwp_analytics',11);
				}
			}
		}
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
    // Disable Concatenate Google Fonts
//    add_filter( 'get_rocket_option_minify_google_fonts', '__return_false', PHP_INT_MAX );
    // Disable CSS & JS magnification
//    add_filter( 'get_rocket_option_minify_js', '__return_false', PHP_INT_MAX );
//    add_filter( 'get_rocket_option_minify_css', '__return_false', PHP_INT_MAX );

    //Lazy Load XT
		global $lazyloadxt;
		remove_filter( 'the_content', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'widget_text', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'post_thumbnail_html', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'get_avatar', array( $lazyloadxt, 'filter_html' ) );

    // Lazy Load
		add_filter( 'lazyload_is_enabled', '__return_false', PHP_INT_MAX );
}
//
// This Caused issue, Please see: https://github.com/ahmedkaludi/accelerated-mobile-pages/issues/713
//
//add_action('amp_init','ampforwp_cache_compatible_activator');
//function ampforwp_cache_compatible_activator(){
//    add_action('template_redirect','ampforwp_cache_plugin_compatible');
//}
//function ampforwp_cache_plugin_compatible(){
//    $ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();
//    if ( ! $ampforwp_is_amp_endpoint ) {
//        return;
//    }
//    /**
//     * W3 total cache
//     */
//    add_filter( 'w3tc_minify_js_enable', array( $this, '_return_false' ) );
//    add_filter( 'w3tc_minify_css_enable', array( $this, '_return_false' ) );
//}

//Removing bj loading for amp
function ampforwp_remove_bj_load() {
 	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
 		add_filter( 'bjll/enabled', '__return_false' );
 	}
}
add_action( 'bjll/compat', 'ampforwp_remove_bj_load' );

//Disable Crazy Lazy for AMP #751
function ampforwp_remove_crazy_lazy_support(){
	if( ampforwp_is_amp_endpoint() ){
		remove_action( 'wp', array( 'CrazyLazy', 'instance' ) );
	}
}
add_action('wp','ampforwp_remove_crazy_lazy_support',9);
//33. Google tag manager support added
// Remove any old scripts that have been loaded by other Plugins
add_action('init', 'amp_gtm_remove_analytics_code');
function amp_gtm_remove_analytics_code() {
  global $redux_builder_amp;
  if( $redux_builder_amp['amp-use-gtm-option'] ) {
    remove_action('amp_post_template_footer','ampforwp_analytics',11);
  	remove_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
  } else {
    remove_filter( 'amp_post_template_analytics', 'amp_gtm_add_gtm_support' );

  }
}

// Create GTM support
add_filter( 'amp_post_template_analytics', 'amp_gtm_add_gtm_support' );
function amp_gtm_add_gtm_support( $analytics ) {
	global $redux_builder_amp;
	if ( ! is_array( $analytics ) ) {
		$analytics = array();
	}

	$analytics['amp-gtm-googleanalytics'] = array(
		'type' => $redux_builder_amp['amp-gtm-analytics-type'],
		'attributes' => array(
			'data-credentials' 	=> 'include',
			'config'			=> 'https://www.googletagmanager.com/amp.json?id='. $redux_builder_amp['amp-gtm-id'] .'&gtm.url=SOURCE_URL'
		),
		'config_data' => array(
			'vars' => array(
				'account' =>  $redux_builder_amp['amp-gtm-analytics-code']
			),
			'triggers' => array(
				'trackPageview' => array(
					'on' => 'visible',
					'request' => 'pageview',
				),
			),
		),
	);

	return $analytics;
}

//34. social share boost compatibility Ticket #387
function social_sharing_removal_code() {
    remove_filter('the_content','ssb_in_content');
}
add_action('amp_init','social_sharing_removal_code', 9);


//35. Disqus Comments Support 
add_action('ampforwp_post_after_design_elements','ampforwp_add_disqus_support');
function ampforwp_add_disqus_support() {
	global $redux_builder_amp;
	if ( !comments_open() ){
		return;
	}//931
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] ) {
		if( $redux_builder_amp['ampforwp-disqus-comments-name'] !== '' ) {
			global $post; $post_slug=$post->post_name;

			$disqus_script_host_url = "https://ampforwp.appspot.com/?api=". AMPFORWP_DISQUS_URL;

			if( $redux_builder_amp['ampforwp-disqus-host-position'] == 0 ) {
				$disqus_script_host_url = esc_url( $redux_builder_amp['ampforwp-disqus-host-file'] );
			}

			$disqus_url = $disqus_script_host_url.'?disqus_title='.$post_slug.'&url='.get_permalink().'&disqus_name='. esc_url( $redux_builder_amp['ampforwp-disqus-comments-name'] ) ."/embed.js"  ;
			?>
			<section class="amp-wp-content post-comments amp-wp-article-content amp-disqus-comments" id="comments">
				<amp-iframe
					height=200
					width=300
					layout="responsive"
					sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
					frameborder="0"
					src="<?php echo $disqus_url ?>" >
					<div overflow tabindex="0" role="button" aria-label="Read more"><?php echo __('Disqus Comments Loading...','accelerated-mobile-pages') ?></div>
				</amp-iframe>
			</section>
		<?php
		}
	}
}

add_filter( 'amp_post_template_data', 'ampforwp_add_disqus_scripts' );
function ampforwp_add_disqus_scripts( $data ) {
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] && is_singular()  && comments_open() ) {
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
	echo ampforwp_facebook_comments_markup();
}
function ampforwp_facebook_comments_markup() {

	global $redux_builder_amp;
	$facebook_comments_markup = '';
	if ( !comments_open() ){
		return;
	}
	if ( $redux_builder_amp['ampforwp-facebook-comments-support'] ) { 

		$facebook_comments_markup = '<section class="amp-wp-content post-comments amp-wp-article-content amp-facebook-comments" id="comments">';
		$facebook_comments_markup .= '<amp-facebook-comments width=486 height=357
	    		layout="responsive" data-numposts=';
		$facebook_comments_markup .= '"'. $redux_builder_amp['ampforwp-number-of-fb-no-of-comments']. '" ';

		$facebook_comments_markup .= 'data-href=" ' . get_permalink() . ' "';
	    $facebook_comments_markup .= '></amp-facebook-comments>';

		return $facebook_comments_markup;
	}
}

add_filter( 'amp_post_template_data', 'ampforwp_add_fbcomments_scripts' );
function ampforwp_add_fbcomments_scripts( $data ) {

	$facebook_comments_check = ampforwp_facebook_comments_markup();
	global $redux_builder_amp;
	if ( $facebook_comments_check && $redux_builder_amp['ampforwp-facebook-comments-support'] && is_singular() ) {
			if ( empty( $data['amp_component_scripts']['amp-facebook-comments'] ) ) {
				$data['amp_component_scripts']['amp-facebook-comments'] = 'https://cdn.ampproject.org/v0/amp-facebook-comments-0.1.js';
			}
		}
		return $data;
	}
//36. remove photon support in AMP
//add_action('amp_init','ampforwp_photon_remove');
//function ampforwp_photon_remove(){
//	if ( class_exists( 'Jetpack' ) ) {
//		add_filter( 'jetpack_photon_development_mode', 'ampforwp_diable_photon' );
//	}
//}
//
//function ampforwp_diable_photon() {
//	return true;
//}

//37. compatibility with wp-html-compression
function ampforwp_copat_wp_html_compression() {
	remove_action('template_redirect', 'wp_html_compression_start', -1);
	remove_action('get_header', 'wp_html_compression_start');
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
    if ( is_category() ) {
            $title = single_cat_title( ampforwp_translation($redux_builder_amp['amp-translator-archive-cat-text'], 'Category (archive title)').' ', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( ampforwp_translation($redux_builder_amp['amp-translator-archive-tag-text'], 'Tag (archive title)').' ', false );
        }
    return $title;
}

//39. #560 Header and Footer Editable html enabled script area
add_action('amp_post_template_footer','ampforwp_footer_html_output',11);
function ampforwp_footer_html_output() {
  global $redux_builder_amp;
  if( $redux_builder_amp['amp-footer-text-area-for-html'] ) {
    echo $redux_builder_amp['amp-footer-text-area-for-html'] ;
  }
}

add_action('amp_post_template_head','ampforwp_header_html_output',11);
function ampforwp_header_html_output() {
  global $redux_builder_amp;
  if( $redux_builder_amp['amp-header-text-area-for-html'] ) {
    echo $redux_builder_amp['amp-header-text-area-for-html'] ;
  }
}


//40. Meta Robots
add_action('amp_post_template_head' , 'ampforwp_talking_to_robots');
function ampforwp_talking_to_robots() {

  global $redux_builder_amp;
  global $wp;
  $message_to_robots = '<meta name="robots" content="noindex,nofollow"/>';
  $talk_to_robots=false;

   //author arhives  index/noindex
   if( is_author() && !$redux_builder_amp['ampforwp-robots-archive-author-pages'] ) {
  	$talk_to_robots = true;
   }

  //date ke archives index/noindex
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
	if( in_array( 'page' , $query_array ) ) {
		$page = $wp->query_vars['page'];
		if ( $redux_builder_amp['amp-frontpage-select-option'] && $page >= '2') {
			$talk_to_robots = true;
		}
	}

  if( $talk_to_robots ) {
    	echo $message_to_robots;
  }

}

// 41. Rewrite URL only on save #511
function ampforwp_auto_flush_on_save($redux_builder_amp) {
	if ( $redux_builder_amp['amp-on-off-for-all-pages'] == 1 || $redux_builder_amp['ampforwp-archive-support'] == 1 ) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
}
add_action("redux/options/redux_builder_amp/saved",'ampforwp_auto_flush_on_save', 10, 1);

// 42. registeing AMP sidebars
add_action('init', 'ampforwp_add_widget_support');
function ampforwp_add_widget_support() {
	if (function_exists('register_sidebar')) {
		global $redux_builder_amp;

		register_sidebar(array(
			'name' => 'AMP Above Loop',
			'id'   => 'ampforwp-above-loop',
			'description'   => 'Widget area for above the Loop Output',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'AMP Below Loop',
			'id'   => 'ampforwp-below-loop',
			'description'   => 'Widget area for below the Loop Output',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

		if ( $redux_builder_amp['ampforwp-content-builder'] ) {
    $desc = "Drag and Drop the AMP Modules in this Widget Area and then assign this widget area to a page <a href=http://ampforwp.com/tutorials/page-builder>(Need Help?)</a>";
    $placeholder = 'PLACEHOLDER';
			register_sidebar(array(
				'name' 			=> 'Page Builder (AMP)',
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
	 $non_sanitized_sidebar = "";
	 $sidebar_output = "";
    
    ob_start();
	dynamic_sidebar( 'ampforwp-above-loop' );
	$non_sanitized_sidebar = ob_get_contents();
	ob_end_clean();

	$sanitized_sidebar = new AMPFORWP_Content( $non_sanitized_sidebar,
		apply_filters( 'amp_content_embed_handlers', array(
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

   $sidebar_output = $sanitized_sidebar->get_amp_content();
   echo $sidebar_output;

}

add_action( 'ampforwp_home_below_loop' , 'ampforwp_output_widget_content_below_loop' );
add_action( 'ampforwp_frontpage_below_loop' , 'ampforwp_output_widget_content_below_loop' );
function ampforwp_output_widget_content_below_loop() {
     $sanitized_sidebar = "";
	 $non_sanitized_sidebar = "";
	 $sidebar_output = "";
    
    ob_start();
	dynamic_sidebar( 'ampforwp-below-loop' );
	$non_sanitized_sidebar = ob_get_contents();
	ob_end_clean();

	$sanitized_sidebar = new AMPFORWP_Content( $non_sanitized_sidebar,
		apply_filters( 'amp_content_embed_handlers', array(
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

   $sidebar_output = $sanitized_sidebar->get_amp_content();
   echo $sidebar_output;
}

// 44. auto adding /amp for the menu
add_action('amp_init','ampforwp_auto_add_amp_menu_link_insert');
function ampforwp_auto_add_amp_menu_link_insert() {
	add_action( 'wp', 'ampforwp_auto_add_amp_in_link_check' );
}

function ampforwp_auto_add_amp_in_link_check() {
	global $redux_builder_amp;
	$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

	if ( $ampforwp_is_amp_endpoint && $redux_builder_amp['ampforwp-auto-amp-menu-link'] == 1 ) {
		add_filter( 'nav_menu_link_attributes', 'ampforwp_auto_add_amp_in_menu_link', 10, 3 );
	}
}

function ampforwp_auto_add_amp_in_menu_link( $atts, $item, $args ) {

    $atts['href'] = trailingslashit( $atts['href'] ) . AMPFORWP_AMP_QUERY_VAR;
    return $atts;
}


// 45. searchpage, frontpage, homepage structured data
add_filter( 'amp_post_template_metadata', 'ampforwp_search_or_homepage_or_staticpage_metadata', 10, 2 );
function ampforwp_search_or_homepage_or_staticpage_metadata( $metadata, $post ) {
		global $redux_builder_amp;

		if( is_search() || is_home() || ( is_front_page() && $redux_builder_amp['amp-frontpage-select-option'] )) {

			if( is_home() || is_front_page() ){
				global $wp;
				$current_url = home_url( $wp->request );
				$current_url = dirname( $current_url );
				$headline 	 =  get_bloginfo('name') . ' | ' . get_option( 'blogdescription' );
			} else {
				$current_url 	= trailingslashit(get_home_url())."?s=".get_search_query();
				$current_url 	= untrailingslashit( $current_url );
				$headline 		= ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . '  ' . get_search_query();
			}

			// creating this to prevent errors
			$structured_data_image_url = '';
			// placeholder Image area
			if (! empty( $redux_builder_amp['amp-structured-data-placeholder-image']['url'] ) ) {
				$structured_data_image_url = $redux_builder_amp['amp-structured-data-placeholder-image']['url'];
			}
			$structured_data_image =  $structured_data_image_url; //  Placeholder Image URL
			$structured_data_height = intval($redux_builder_amp['amp-structured-data-placeholder-image-height']); //  Placeholder Image width
			$structured_data_width = intval($redux_builder_amp['amp-structured-data-placeholder-image-width']); //  Placeholder Image height

			if( is_front_page() ) {
				$ID = $redux_builder_amp['amp-frontpage-select-option-pages']; // ID of slected front page
				$headline =  get_the_title( $ID ) . ' | ' . get_option('blogname');
				$static_page_data = get_post( $ID );

				$datePublished = $static_page_data->post_date;
				$dateModified = $static_page_data->post_modified;

				$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $ID ) ); // Featured Image structured Data
				if( $featured_image_array ) {
					$structured_data_image = $featured_image_array[0];
					$structured_data_image = $featured_image_array[1];
					$structured_data_image = $featured_image_array[2];
				}
			} else {
			// To DO : check the entire else section .... time for search and homepage...wierd ???
				$datePublished = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) - 2 );
				// time difference is 2 minute between published and modified date
				$dateModified = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
			}
			$metadata['datePublished'] = $datePublished; // proper published date added
			$metadata['dateModified'] = $dateModified; // proper modified date

			$metadata['image'] = array(
				'@type' 	=> 'ImageObject',
				'url' 		=> $structured_data_image ,
				'height' 	=> $structured_data_height,
				'width' 	=> $structured_data_width,
			);

			$metadata['mainEntityOfPage'] = $current_url; // proper URL added
			$metadata['headline'] = $headline; // proper headline added
	}
	return $metadata;
}


// 46. search search search everywhere #615
require 'search-functions.php';

// 47. social js properly adding when required
if( !function_exists( 'is_socialshare_or_socialsticky_enabled_in_ampforwp' ) ) {
	function is_socialshare_or_socialsticky_enabled_in_ampforwp() {
		global $redux_builder_amp;
		if(  $redux_builder_amp['enable-single-facebook-share'] ||
				 $redux_builder_amp['enable-single-twitter-share']  ||
				 $redux_builder_amp['enable-single-gplus-share']  ||
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
add_filter( 'amp_post_template_data', 'ampforwp_add_ads_scripts' );
function ampforwp_add_ads_scripts( $data ) {
	global $redux_builder_amp;

	if (	$redux_builder_amp['enable-amp-ads-1'] ||
				$redux_builder_amp['enable-amp-ads-2'] ||
				$redux_builder_amp['enable-amp-ads-3'] ||
				$redux_builder_amp['enable-amp-ads-4'] ) {
					if ( empty( $data['amp_component_scripts']['amp-ad'] ) ) {
						$data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
					}
	}

	return $data;
}

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
add_filter( 'amp_post_template_data', 'ampforwp_add_notification_scripts' );
function ampforwp_add_notification_scripts( $data ) {
	global $redux_builder_amp;

	if ( $redux_builder_amp['amp-enable-notifications'] == true ) {
					if ( empty( $data['amp_component_scripts']['amp-user-notification'] ) ) {
						$data['amp_component_scripts']['amp-user-notification'] = 'https://cdn.ampproject.org/v0/amp-user-notification-0.1.js';
					}
	}

	return $data;
}


//51. Adding Digg Digg compatibility with AMP
function ampforwp_dd_exclude_from_amp() {
if(ampforwp_is_amp_endpoint()) {
    remove_filter('the_excerpt', 'dd_hook_wp_content');
    remove_filter('the_content', 'dd_hook_wp_content');
	}
}
add_action('template_redirect', 'ampforwp_dd_exclude_from_amp');

//52. Adding a generalized sanitizer function for purifiying normal html to amp-html
function ampforwp_content_sanitizer( $content ) {
	$amp_custom_post_content_input = $content;
	if ( !empty( $amp_custom_post_content_input ) ) {
		$amp_custom_content = new AMP_Content( $amp_custom_post_content_input,
				apply_filters( 'amp_content_embed_handlers', array(
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

		if ( $amp_custom_content ) {
			global $data;
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
	if( !$redux_builder_amp['ampforwp-seo-meta-description'] ){
		return;
	}
	$desc = "" ;
	$desc = ampforwp_generate_meta_desc();

	// strip_shortcodes  strategy not working here so had to do this way
	// strips shortcodes
	$desc= preg_replace('/\[(.*)?\]/','',$desc);

	if( $desc ) {
		echo '<meta name="description" content="'. esc_html( convert_chars( wptexturize ( $desc ) ) )  .'"/>';
	}
}

// 55. Call Now Button Feature added
add_action('ampforwp_call_button','ampforwp_call_button_html_output');
function ampforwp_call_button_html_output(){
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
		<div class="callnow">
			<a href="tel:<?php echo $redux_builder_amp['enable-amp-call-numberfield']; ?>"></a>
		</div> <?php
  }
}

// 56. Multi Translation Feature #540
function ampforwp_translation( $redux_style_translation , $pot_style_translation ) {
 global $redux_builder_amp;
 $single_translation_enabled = $redux_builder_amp['amp-use-pot'];
   if ( !$single_translation_enabled ) {
     return $redux_style_translation;
   } else {
     return __($pot_style_translation,'accelerated-mobile-pages');
   }
}

// 57. Adding Updated date at in the Content
add_action('ampforwp_after_post_content','ampforwp_add_modified_date');
function ampforwp_add_modified_date($post_id){
	global $redux_builder_amp;
	if ( is_single() && $redux_builder_amp['post-modified-date'] ) { ?>
		<div class="ampforwp-last-modified-date">
			<p> <?php
				$post_object = new AMP_Post_Template($post_id);
				if( $post_object->get( 'post_modified_timestamp' ) !== $post_object->get( 'post_publish_timestamp' ) ){
					echo esc_html(
						sprintf(
							_x( ampforwp_translation( $redux_builder_amp['amp-translator-modified-date-text'],'This article was last modified on ' ) . ' %s '  , '%s = human-readable time difference', 'accelerated-mobile-pages' ),
							date( "F j, Y, g:i a" , $post_object->get( 'post_modified_timestamp' ) )
						)
					);
				} ?>
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

		$youtube_url = 'https://www.youtube.com/watch?v=';
		$parsed_url = parse_url( $params['id'] );
		$server = 'www.youtube.com';

		if ( in_array( $server, $parsed_url ) === false ) {
			if($params['id']){
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

// 59. Comment Button URL
function ampforwp_comment_button_url(){
	global $redux_builder_amp;
	$button_url = "";
	$ampforwp_nonamp = "";
	if($redux_builder_amp['amp-mobile-redirection']==1)
        $ampforwp_nonamp =  '?nonamp=1';
    else
      $ampforwp_nonamp = '';

  	$button_url =  trailingslashit( get_permalink() ) .$ampforwp_nonamp. '#commentform';

  return $button_url; 
}

// 60. Remove Category Layout modification code added by TagDiv #842 and #796
function ampforwp_remove_support_tagdiv_cateroy_layout(){
	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
		remove_action('pre_get_posts', 'td_modify_main_query_for_category_page'); 
	}
}
add_action('pre_get_posts','ampforwp_remove_support_tagdiv_cateroy_layout',9);

// 61. Add Gist Support
add_shortcode('amp-gist', 'ampforwp_gist_shortcode_generator');
function ampforwp_gist_shortcode_generator($atts) {
   extract(shortcode_atts(array(
   	  'id'     =>'' ,
      'layout' => fixed-height,
      'height' => 200,      
   ), $atts));  
   if ( empty ( $height ) ) {
   		$height = '250';
   }
  	return '<amp-gist data-gistid='. $atts['id'] .' 
  		layout="fixed-height"
  		height="'. $height .'">
  		</amp-gist>';
}
add_action('amp_post_template_head','ampforwp_add_gist_script', 10 , 1);
function ampforwp_add_gist_script( $data ){
 	if ( is_single() ) {	 	
		$content =    $data->get('post');
		if (   $content ) {
			$content =    $content->post_content;
		}
		if( has_shortcode( $content , 'amp-gist' ) ){ ?>
		<script async custom-element="amp-gist" src="https://cdn.ampproject.org/v0/amp-gist-0.1.js"></script>
		<?php 
		}
	}
}

// 62. Adding Meta viewport via hook instead of direct #878 
add_action( 'amp_post_template_head','ampforwp_add_meta_viewport', 9);
function ampforwp_add_meta_viewport() {
	$output = '';
	$output = '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	';
	echo apply_filters('ampforwp_modify_meta_viewport_filter',$output);
	
}

// 63. Frontpage Comments #682 
function ampforwp_frontpage_comments() {
	global $redux_builder_amp;
	$data = get_option( 'ampforwp_design' );
	$enable_comments = false;
	$post_id = "";


	$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];

	if ($data['elements'] == '') {
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
			// Gather comments for a Front from post id
			$postID = $redux_builder_amp['amp-frontpage-select-option-pages'];
			$comments = get_comments(array(
					'post_id' => $postID,
					'status' => 'approve' //Change this to the type of comments to be displayed
			));
			$comment_button_url = get_permalink( $post_id );
			$comment_button_url = apply_filters('ampforwp_frontpage_comments_url',$comment_button_url );
			if ( $comments ) { ?>
				<div class="amp-wp-content comments_list">
				    <h3><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'] , 'View Comments' )?></h3>
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
							<li id="li-comment-<?php comment_ID() ?>"
							<?php comment_class(); ?> >
								<article id="comment-<?php comment_ID(); ?>" class="comment-body">
									<footer class="comment-meta">
										<div class="comment-author vcard">
											<?php
											printf(__('<b class="fn">%s</b> <span class="says">'.ampforwp_translation($redux_builder_amp['amp-translator-says-text'],'says').':</span>'), get_comment_author_link()) ?>
										</div>
										<!-- .comment-author -->
										<div class="comment-metadata">
											<a href="<?php echo trailingslashit( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ) ?>">
												<?php printf( ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at %2$s') , get_comment_date(),  get_comment_time())?>
											</a>
											<?php edit_comment_link(  ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' )  ) ?>
										</div>
										<!-- .comment-metadata -->
									</footer>
										<!-- .comment-meta -->
									<div class="comment-content">
				                        <?php
				                          // $pattern = "~[^a-zA-Z0-9_ !@#$%^&*();\\\/|<>\"'+.,:?=-]~";
				                          $emoji_content = get_comment_text();
				                          // $emoji_free_comments = preg_replace($pattern,'',$emoji_content);
				                          $emoji_content = wpautop( $emoji_content );
					                      $sanitizer = new AMPFORWP_Content( $emoji_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array() ) ) );
					                      $sanitized_comment_content = $sanitizer->get_amp_content();
					                      echo make_clickable( $sanitized_comment_content );
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
				if ( comments_open($postID) ) {  ?>
				<div class="comment-button-wrapper">
				    <a href="<?php echo esc_url( trailingslashit( $comment_button_url ) ) .'?nonamp=1'.'#commentform' ?>" rel="nofollow"><?php  echo ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
				</div><?php
				}
			} else {
			    if ( !comments_open() ) { ?>
			    <div class="comment-button-wrapper">
			       <a href="<?php echo esc_url( trailingslashit( $comment_button_url ) ) .'?nonamp=1'.'#commentform'  ?>" rel="nofollow"><?php echo  ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment' ); ?></a>
			    </div>
			<?php } 
			}?>
		</div> <?php
	} 
}


// 64. PageBuilder 
add_action('pre_amp_render_post','ampforwp_apply_layout_builder_on_pages',20);
function ampforwp_apply_layout_builder_on_pages($post_id) {
	global $redux_builder_amp;

	if ( is_home() ) {
		$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}
	$sidebar_check = get_post_meta( $post_id,'ampforwp_custom_sidebar_select',true); 

	if ( $redux_builder_amp['ampforwp-content-builder'] && $sidebar_check === 'layout-builder') {
		// Add Styling Builder Elements
		add_action('amp_post_template_css', 'ampforwp_pagebuilder_styling', 20);

		// Removed Titles for Pagebuilder elements
		remove_filter( 'ampforwp_design_elements', 'ampforwp_add_element_the_title' );
		remove_action('ampforwp_design_2_frontpage_title','ampforwp_design_2_frontpage_title');
		remove_action('ampforwp_design_2_frontpage_title','ampforwp_design_2_frontpage_title');
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

	$post_id = $post->ID;
	if ( is_home() ) {
		$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}
	$pagebuilder_check = get_post_meta( $post_id,'ampforwp_custom_sidebar_select',true); 

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
				remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical' ); 
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
	global $redux_builder_amp;
	 global $post;
  $ampforwp_backto_nonamp = '';
  if ( is_home() ) {
    if($redux_builder_amp['amp-mobile-redirection']==1)
       $ampforwp_backto_nonamp = trailingslashit(home_url()).'?nonamp=1' ;
    else
       $ampforwp_backto_nonamp = trailingslashit(home_url()) ;
  }
  if ( is_single() ){
    if($redux_builder_amp['amp-mobile-redirection']==1)
      $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )).'?nonamp=1' ;
    else
      $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )) ;
  }
  if ( is_page() ){
    if($redux_builder_amp['amp-mobile-redirection']==1)
        $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID )).'?nonamp=1';
    else
      $ampforwp_backto_nonamp = trailingslashit(get_permalink( $post->ID ));
  }
  if( is_archive() ) {
    global $wp;
    if($redux_builder_amp['amp-mobile-redirection']==1){
        $ampforwp_backto_nonamp = esc_url( untrailingslashit(home_url( $wp->request )).'?nonamp=1'  );
        $ampforwp_backto_nonamp = preg_replace('/\/amp\?nonamp=1/','/?nonamp=1',$ampforwp_backto_nonamp);
      }
    else{
        $ampforwp_backto_nonamp = esc_url( untrailingslashit(home_url( $wp->request )) );
        $ampforwp_backto_nonamp = preg_replace('/amp/','',$ampforwp_backto_nonamp);
      }
  } ?>
<?php if ( $ampforwp_backto_nonamp ) { ?> <a href="<?php echo $ampforwp_backto_nonamp; ?>" rel="nofollow"><?php echo esc_html( $redux_builder_amp['amp-translator-non-amp-page-text'] ) ;?> </a> <?php  }
 }

 //68. Facebook Instant Articles
add_action('init', 'fb_instant_article_feed_generator');
 
function fb_instant_article_feed_generator() {
	global $redux_builder_amp;
	if( $redux_builder_amp['fb-instant-article-switch'] ) {	
		add_feed('instant_articles', 'fb_instant_article_feed_function');
	}
}

function fb_instant_article_feed_function() {
	add_filter('pre_option_rss_use_excerpt', '__return_zero');
	load_template( AMPFORWP_PLUGIN_DIR . '/feeds/instant-article-feed.php' );
}

// 69. Post Pagination #834 #857
function ampforwp_post_pagination( $args = '' ) {

	wp_reset_postdata();
	global $page, $numpages, $multipage, $more;

	$defaults = array(
		'before'           => '<p>' . __( 'Page:' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page' ),
		'previouspagelink' => __( 'Previous page' ),
		'pagelink'         => '%',
		'echo'             => 1
	);

	$params = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments used in retrieving page links for paginated posts.
	 * @param array $params An array of arguments for page links for paginated posts.
	 */
	$r = apply_filters( 'ampforwp_post_pagination_args', $params );

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $r['next_or_number'] ) {
			$output .= $r['before'];
			for ( $i = 1; $i <= $numpages; $i++ ) {
				$link = $r['link_before'] . str_replace( '%', $i, $r['pagelink'] ) . $r['link_after'];
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
			$next = $page + 1;
			if ( $next <= $numpages ) {
				if ( $prev ) {
					$output .= $r['separator'];
				}
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
	if ( $r['echo'] ) {
		echo $html;
	}
	return $html;

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
	$query_args = array();
	if ( 1 == $i ) {
		$url = get_permalink();
	} else {
		if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
			$url = add_query_arg( 'page', $i, get_permalink() );
		elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
			$url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
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

	return '<a href="' . esc_url( $url ) . '?amp">';
}

add_filter('ampforwp_modify_rel_canonical','ampforwp_modify_rel_amphtml_paginated_post');
function ampforwp_modify_rel_amphtml_paginated_post($url) {
	if(is_single()){
			$post_paginated_page='';
			$post_paginated_page = get_query_var('page');
			if($post_paginated_page){
				$url = get_permalink();
				$new_url = $url."$post_paginated_page/?amp";
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
			if($post_paginated_page){
				remove_action( 'amp_post_template_head', 'amp_post_template_add_canonical' );
				add_action('amp_post_template_head','ampforwp_rel_canonical_paginated_post');
			}
		}
}
function ampforwp_rel_canonical_paginated_post(){
		$post_paginated_page='';
		$new_canonical_url = '';
		global $post;
	    $current_post_id = $post->ID;
	    $new_canonical_url = get_permalink($current_post_id);
	    $new_canonical_url = trailingslashit($new_canonical_url);
		$post_paginated_page = get_query_var('page');
		if($post_paginated_page){?>
			<link rel="canonical" href="<?php echo $new_canonical_url.$post_paginated_page ?>/" /><?php  } 
}
add_action('ampforwp_after_post_content','ampforwp_post_pagination');


// 70. Hide AMP by specific Categories #872

function ampforwp_posts_to_remove () {
	global $redux_builder_amp;
	$args 							= array();
	$get_categories_from_checkbox 	= '';
	$get_selected_cats 				= '';
	$selected_cats 					= array();
	$posts 							= array();
	$post_id_array 					= array();

	$args = array(
	  'post_type' => 'post',
	);
	$get_categories_from_checkbox =  $redux_builder_amp['hide-amp-categories'];  
	if($get_categories_from_checkbox){
		$get_selected_cats = array_filter($get_categories_from_checkbox);
		foreach ($get_selected_cats as $key => $value) {
			$selected_cats[] = $key;
		}  
	}
	if ( ! empty($get_selected_cats)) {

		$posts = get_posts( array(
		    'category'          => $selected_cats,
		    'numberposts'       => '-1',
		    'post_type'         => $args,
		    'post_status'       => 'publish',
		    'suppress_filters'  => false
		) );
	}

	if ( $posts ) {
		 foreach ($posts as $post) {
		    $post_id_array[] =  $post->ID;
		}
	}
	return $post_id_array;
}

add_filter( 'amp_skip_post', 'ampforwp_cat_specific_skip_amp_post', 10, 3 );
function ampforwp_cat_specific_skip_amp_post( $skip, $post_id, $post ) {
	$list_of_posts = '';
	$skip_this_post = '';

	$list_of_posts = ampforwp_posts_to_remove();
	$skip_this_post = in_array($post_id, $list_of_posts);

	if( $skip_this_post ) {
	  $skip = true;
	  remove_action( 'wp_head', 'ampforwp_home_archive_rel_canonical' );
	  // #999 Disable mobile redirection
	  remove_action( 'template_redirect', 'ampforwp_page_template_redirect', 30 );
	}
	return $skip;
}

add_action('amp_post_template_head','ampforwp_rel_canonical_home_archive');
function ampforwp_rel_canonical_home_archive(){
	global $redux_builder_amp;
	global $wp;
	$current_archive_url 	= '';
	$amp_url				= '';
	$remove					= '';
	$query_arg_array 		= '';

	if ( is_home() && !$redux_builder_amp['amp-frontpage-select-option'] || ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] ) ){
		$current_archive_url = home_url( $wp->request );
		$amp_url 	= trailingslashit($current_archive_url);
		$remove 	= '/'. AMPFORWP_AMP_QUERY_VAR;
		$amp_url 	= str_replace($remove, '', $amp_url) ;?>
	<link rel="canonical" href="<?php echo $amp_url ?>">
	<?php }

	if((is_front_page() || is_home() ) && $redux_builder_amp['amp-frontpage-select-option'] ){
	  	$query_arg_array = $wp->query_vars;
	  	$page = '' ;
	  	if( array_key_exists( "page" , $query_arg_array  ) ) {
		   $page = $wp->query_vars['page'];
	  	}
	  	if ( $page >= '2') { ?>
			<link rel="canonical" href="<?php
			echo trailingslashit( home_url() ) . '?page=' . $page ?>"> <?php
		} else { ?>
			<link rel="canonical" href="<?php
			echo  trailingslashit( home_url() ) ?>"> <?php
		}
	}			
}

// 71. Alt tag for thumbnails #1013 and For Post ID in Body tag #1006
//Alt tag for thumbnails #1013
function ampforwp_thumbnail_alt(){
	$thumb_id = '';
	$thumb_alt = '';
	$thumb_id = get_post_thumbnail_id();
	$thumb_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
 
	if($thumb_alt){ 
		echo "alt = '$thumb_alt'";
	}
}
// For Post ID in Body tag #1006
function ampforwp_get_body_class(){
	global $post;
	global $redux_builder_amp;
	$post_id = '';

	if ( is_singular() ) {
		$post_id = $post->ID;
	}
	if ( $redux_builder_amp['amp-frontpage-select-option']) {
	   	if ( is_home() &&  is_front_page() ) {
	    	$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	   	} elseif ( is_home() ){
	    	$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];   
	   }
	}

	return $post_id;
}

function ampforwp_the_body_class(){
	echo 'post-id-' . ampforwp_get_body_class();
}

// 72. Blacklist Sanitizer Added back #1024
add_filter('amp_content_sanitizers', 'ampforwp_add_blacklist_sanitizer');
function ampforwp_add_blacklist_sanitizer($data){
	// Blacklist Sanitizer Added back until we find a better solution to replace it 
	$data['AMP_Blacklist_Sanitizer']  = array();
	return $data;
}

//Meta description #1013
function ampforwp_generate_meta_desc(){
	global $post;
	global $redux_builder_amp;
	$front = '';
	$desc = '';
	$post_id = '';
	$genesis_description = '';
	if($redux_builder_amp['ampforwp-seo-yoast-description']){
		if ( class_exists('WPSEO_Frontend') ) {
			// general Description of everywhere
			$front = WPSEO_Frontend::get_instance();
			$desc = addslashes( strip_tags( $front->metadesc( false ) ) );

			// Static front page
			// Code for Custom Frontpage Yoast SEO Description
			$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
			if ( class_exists('WPSEO_Meta') ) {
				if ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] ) {
					$desc = addslashes( strip_tags( WPSEO_Meta::get_value('metadesc', $post_id ) ) );
				}
			}
		}
		// for search
		if( is_search() ) {
			$desc = addslashes( ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . '  ' . get_search_query() );
		}
	} 
		
	else {
		if( is_home() ) {
			// normal home page
			$desc= addslashes( strip_tags( get_bloginfo( 'description' ) ) );
		}

		if( is_archive() ) {
			$desc= addslashes( strip_tags( get_the_archive_description() ) );
		}

		if( is_single() || is_page() ) {
				if( has_excerpt() ){
					$desc = get_the_excerpt();
				} else {
					global $post;
					$id = $post->ID;
					$desc = get_post($id)->post_content;
				}
				$desc = addslashes( wp_trim_words( strip_tags( $desc ) , '15'  ) );
		}

		if( is_search() ) {
			$desc = addslashes( ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . ' ' . get_search_query() );
		}

		if( is_home() && $redux_builder_amp['amp-frontpage-select-option'] ) {
			$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'] ;
			$desc = addslashes( wp_trim_words(  strip_tags( get_post_field('post_content', $post_id) ) , '15' ) );
		}
	}

	//Genesis #1013
	if(function_exists('genesis_meta')){
		if(is_home() && is_front_page() && !$redux_builder_amp['amp-frontpage-select-option']){
			$genesis_description = genesis_get_seo_option( 'home_description' ) ? genesis_get_seo_option( 'home_description' ) : get_bloginfo( 'description' );
		}
		elseif ( is_home() && get_option( 'page_for_posts' ) && get_queried_object_id() ) {
			$post_id = get_option( 'page_for_posts' );
			if ( null !== $post_id || is_singular() ) {
				if ( genesis_get_custom_field( '_genesis_description', $post_id ) ) {
					$genesis_description = genesis_get_custom_field( '_genesis_description', $post_id );
					if($genesis_description){
						$desc = $genesis_description;
					}
				}
			}
		}
		elseif(is_home() && $redux_builder_amp['amp-frontpage-select-option'] && get_option( 'page_on_front' )){
			$post_id = get_option('page_on_front');
			if ( null !== $post_id || is_singular() ) {
				if ( genesis_get_custom_field( '_genesis_description', $post_id ) ) {
					$genesis_description = genesis_get_custom_field( '_genesis_description', $post_id );
					}
				}
			}
		else{
			$genesis_description = genesis_get_seo_meta_description();
		}
		if($genesis_description){
				$desc = $genesis_description;
			}
	}
	return $desc;	
}
