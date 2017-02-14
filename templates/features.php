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
	38. Extra Design Specific Features
  39. #529 editable archives
  40. #560 Header and Footer Editable html enabled script area
*/
// Adding AMP-related things to the main theme
	global $redux_builder_amp;


	// 0.9. AMP Design Manager Files
	require 'design-manager.php';
	require 'customizer/customizer.php';
	// Custom AMP Content
	require 'custom-amp-content.php';

//0.


	// 1. Add Home REL canonical
	// Add AMP rel-canonical for home and archive pages

	add_action('amp_init','ampforwp_allow_homepage');
	function ampforwp_allow_homepage() {
		add_action( 'wp', 'ampforwp_add_endpoint_actions' );
	}

	function ampforwp_add_endpoint_actions() {
		// if ( is_home() ) {

			$ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();

			if ( $ampforwp_is_amp_endpoint ) {
				amp_prepare_render();
			} else {
				add_action( 'wp_head', 'ampforwp_home_archive_rel_canonical' );
			}

		// }
	}

	function ampforwp_home_archive_rel_canonical() {
		global $redux_builder_amp;
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
      	if( is_page() && !$redux_builder_amp['amp-on-off-for-all-pages'] ) {
			return;
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
	        if( $ampforwp_amp_post_on_off_meta === 'hide-amp' ) {
	          //dont Echo anything
	        } else {
				$supported_types = array('post','page');
				if ( $redux_builder_amp['ampforwp-custom-type'] ) {
					foreach($redux_builder_amp['ampforwp-custom-type'] as $custom_post){
						$supported_types[] = $custom_post;
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

				if ( is_home() && $wp->query_vars['paged'] >= '2' ) {
					$new_url =  home_url('/');
					$new_url = $new_url . AMP_QUERY_VAR . '/' . $wp->request ;
					$amp_url = $new_url ;
				}
				if ( is_archive() && $wp->query_vars['paged'] >= '2' ) {
					$new_url 		=  home_url('/');
				 	$category_path 	= $wp->request;
				 	$explode_path  	= explode("/",$category_path);
				 	$inserted 		= array(AMP_QUERY_VAR);
					array_splice( $explode_path, -2, 0, $inserted );
					$impode_url = implode('/', $explode_path);

					$amp_url = $new_url . $impode_url ;
				}

        if( is_search() ) {
          $current_search_url =trailingslashit(get_home_url())."?amp=1&s=".get_search_query();
          $amp_url = untrailingslashit($current_search_url);
        }

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
        // Homepage and FrontPage
        if($redux_builder_amp['amp-frontpage-select-option'] == 0)  {
            if ( is_home() ) {
                if ( 'single' === $type ) {
                	$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
                }
            }
        } elseif ($redux_builder_amp['amp-frontpage-select-option'] == 1) {
            if ( is_home() ) {
                if ( 'single' === $type ) {
                    $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
                }
            }

        }

        // Archive Pages
        if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] )  {

            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/archive.php';
        }

        if ( $redux_builder_amp['amp-design-selector'] == 3) {
        	if ( is_search() && $redux_builder_amp['amp-design-3-search-feature'] )  {

	            $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/search.php';
	        }
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
		if( is_page() ) { ?>
			<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
		<?php } ?>
		<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<?php if($redux_builder_amp['amp-enable-notifications'] == true)  { ?>
			<script async custom-element="amp-user-notification" src="https://cdn.ampproject.org/v0/amp-user-notification-0.1.js"></script>
		<?php } ?>
		<?php if( $redux_builder_amp['enable-single-social-icons'] == true || AMPFORWP_DM_SOCIAL_CHECK === 'true' )  { ?>
			<?php if( is_singular() ) { ?>
				<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
			<?php }
		} ?>
		<?php if($redux_builder_amp['amp-frontpage-select-option'] == 1)  { ?>
			<?php if( is_home() ) { ?>
			<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
			<?php }
		} ?>
		<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script><?php
	}
	// 6.1 Adding Analytics Scripts
	add_action('amp_post_template_head','ampforwp_register_analytics_script', 20);
	function ampforwp_register_analytics_script(){ ?>
			<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
			<?php

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
		add_action('amp_post_template_footer','ampforwp_footer_advert',8);
		add_action('amp_post_template_above_footer','ampforwp_footer_advert',10);
        if ( $redux_builder_amp['amp-design-selector'] == 3) {
          remove_action('amp_post_template_footer','ampforwp_footer_advert',8);
        }

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
			add_action('ampforwp_inside_post_content_after','ampforwp_after_post_content_advert');
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
							<script>
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
				 $content = preg_replace('/(<[^>]+) rel=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) ref=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) date=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) time=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) imap=".*?"/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) date/', '$1', $content);
				 $content = preg_replace('/(<[^>]+) spellcheck/', '$1', $content);

				 //removing scripts and rel="nofollow" from Body and from divs
				 //issue #268
				 $content = str_replace(' rel="nofollow"',"",$content);
				 $content = preg_replace('/<script[^>]*>.*?<\/script>/i', '', $content);
				/// simpy add more elements to simply strip tag but not the content as so
				/// Array ("p","font");
				$tags_to_strip = Array("thrive_headline","type","date","time","place","state","city" );
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

				//				 $content = preg_replace('/<img*/', '<amp-img', $content); // Fallback for plugins
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

				$structured_data_logo = $redux_builder_amp['amp-structured-data-logo']['url'];

				if ($structured_data_logo) {
						$structured_data_logo = $structured_data_logo;
				} else {
					$structured_data_logo = $redux_builder_amp['opt-media']['url'];
				}
				$metadata['publisher']['logo'] = array(
					'@type' 	=> 'ImageObject',
					'url' 		=>  $structured_data_logo ,
					'height' 	=> 36,
					'width' 	=> 190,
				);

				//code for adding 'description' meta from Yoast SEO

				if($redux_builder_amp['ampforwp-seo-yoast-custom-description']){
					if ( class_exists('WPSEO_Frontend') ) {
						$front = WPSEO_Frontend::get_instance();
						$desc = $front->metadesc( false );
						if ( $desc ) {
							$metadata['description'] = $desc;
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
			$post_id = $post->ID;
			$post_image_id = get_post_thumbnail_id( $post_id );
			$structured_data_image = wp_get_attachment_image_src( $post_image_id, 'full' );
			$post_image_check = $structured_data_image;

			if ( $post_image_check == false) {
					$structured_data_image = $redux_builder_amp['amp-structured-data-placeholder-image']['url'];
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

			if ( $metadata['image']['width'] < 696 ) {
	 			$metadata['image']['width'] = 700 ;
     	}

			return $metadata;
	}

// 14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
/**
 * Adds a meta box to the post editing screen for AMP on-off on specific pages
*/
function ampforwp_title_custom_meta() {
  add_meta_box( 'ampforwp_title_meta', __( 'Show AMP for Current Page?' ), 'ampforwp_title_callback', 'post','side' );
  global $redux_builder_amp;

	if($redux_builder_amp['amp-on-off-for-all-pages']) {
		add_meta_box( 'ampforwp_title_meta', __( 'Show AMP for Current Page?' ), 'ampforwp_title_callback', 'page','side' );
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
 * Saves the custom meta input for AMP on-off on specific pages
 */
function ampforwp_title_meta_save( $post_id ) {

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
// 			//    $archivelink = esc_url( get_permalink( $id ) . AMP_QUERY_VAR . '/' );
//   		echo "<link rel='canonical' href='$current_archive_url' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical_archive' );

// 18. Custom Canonical for Homepage
// function ampforwp_rel_canonical() {
//     if ( !is_home() )
//     return;
// //    $link = esc_url( get_permalink( $id ) . AMP_QUERY_VAR . '/' );
//     $homelink = get_home_url();
//     echo "<link rel='canonical' href='$homelink' />\n";
// }
// add_action( 'amp_post_template_head', 'ampforwp_rel_canonical' );

// 18.5. Custom Canonical for Frontpage
// function ampforwp_rel_canonical_frontpage() {
//    if ( is_home() || is_front_page() )
//    return;
// //    $link = esc_url( get_permalink( $id ) . AMP_QUERY_VAR . '/' );
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

}

// 22. Removing author links from comments Issue #180
if( ! function_exists( "disable_comment_author_links" ) ) {
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
                            data-param-url="CANONICAL_URL"
                            data-param-text=<?php echo $data_param_data ?>
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
						<div class="whatsapp-share-icon">
						    <amp-img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTAgOTAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDkwIDkwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggaWQ9IldoYXRzQXBwIiBkPSJNOTAsNDMuODQxYzAsMjQuMjEzLTE5Ljc3OSw0My44NDEtNDQuMTgyLDQzLjg0MWMtNy43NDcsMC0xNS4wMjUtMS45OC0yMS4zNTctNS40NTVMMCw5MGw3Ljk3NS0yMy41MjIgICBjLTQuMDIzLTYuNjA2LTYuMzQtMTQuMzU0LTYuMzQtMjIuNjM3QzEuNjM1LDE5LjYyOCwyMS40MTYsMCw0NS44MTgsMEM3MC4yMjMsMCw5MCwxOS42MjgsOTAsNDMuODQxeiBNNDUuODE4LDYuOTgyICAgYy0yMC40ODQsMC0zNy4xNDYsMTYuNTM1LTM3LjE0NiwzNi44NTljMCw4LjA2NSwyLjYyOSwxNS41MzQsNy4wNzYsMjEuNjFMMTEuMTA3LDc5LjE0bDE0LjI3NS00LjUzNyAgIGM1Ljg2NSwzLjg1MSwxMi44OTEsNi4wOTcsMjAuNDM3LDYuMDk3YzIwLjQ4MSwwLDM3LjE0Ni0xNi41MzMsMzcuMTQ2LTM2Ljg1N1M2Ni4zMDEsNi45ODIsNDUuODE4LDYuOTgyeiBNNjguMTI5LDUzLjkzOCAgIGMtMC4yNzMtMC40NDctMC45OTQtMC43MTctMi4wNzYtMS4yNTRjLTEuMDg0LTAuNTM3LTYuNDEtMy4xMzgtNy40LTMuNDk1Yy0wLjk5My0wLjM1OC0xLjcxNy0wLjUzOC0yLjQzOCwwLjUzNyAgIGMtMC43MjEsMS4wNzYtMi43OTcsMy40OTUtMy40Myw0LjIxMmMtMC42MzIsMC43MTktMS4yNjMsMC44MDktMi4zNDcsMC4yNzFjLTEuMDgyLTAuNTM3LTQuNTcxLTEuNjczLTguNzA4LTUuMzMzICAgYy0zLjIxOS0yLjg0OC01LjM5My02LjM2NC02LjAyNS03LjQ0MWMtMC42MzEtMS4wNzUtMC4wNjYtMS42NTYsMC40NzUtMi4xOTFjMC40ODgtMC40ODIsMS4wODQtMS4yNTUsMS42MjUtMS44ODIgICBjMC41NDMtMC42MjgsMC43MjMtMS4wNzUsMS4wODItMS43OTNjMC4zNjMtMC43MTcsMC4xODItMS4zNDQtMC4wOS0xLjg4M2MtMC4yNy0wLjUzNy0yLjQzOC01LjgyNS0zLjM0LTcuOTc3ICAgYy0wLjkwMi0yLjE1LTEuODAzLTEuNzkyLTIuNDM2LTEuNzkyYy0wLjYzMSwwLTEuMzU0LTAuMDktMi4wNzYtMC4wOWMtMC43MjIsMC0xLjg5NiwwLjI2OS0yLjg4OSwxLjM0NCAgIGMtMC45OTIsMS4wNzYtMy43ODksMy42NzYtMy43ODksOC45NjNjMCw1LjI4OCwzLjg3OSwxMC4zOTcsNC40MjIsMTEuMTEzYzAuNTQxLDAuNzE2LDcuNDksMTEuOTIsMTguNSwxNi4yMjMgICBDNTguMiw2NS43NzEsNTguMiw2NC4zMzYsNjAuMTg2LDY0LjE1NmMxLjk4NC0wLjE3OSw2LjQwNi0yLjU5OSw3LjMxMi01LjEwN0M2OC4zOTgsNTYuNTM3LDY4LjM5OCw1NC4zODYsNjguMTI5LDUzLjkzOHoiIGZpbGw9IiNGRkZGRkYiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" width="50" height="20" />
						    </div>
							</a>
        <?php } ?>
		</div>
	<?php }
}
// if ( $ampforwp_social_icons_enabled == true ) {
//
// }

//	add_action('amp_post_template_head','ampforwp_register_social_sharing_script');

function ampforwp_register_social_sharing_script() {


	 ?>
		<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script> <?php
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

add_action( 'amp_post_template_head', 'ampforwp_custom_yoast_meta' );


//26. Extending Title Tagand De-Hooking the Standard one from AMP
add_action('amp_post_template_include_single','ampforwp_remove_title_tags');
function ampforwp_remove_title_tags(){
	remove_action('amp_post_template_head','amp_post_template_add_title');
	add_action('amp_post_template_head','ampforwp_add_custom_title_tag');

	function ampforwp_add_custom_title_tag(){
		global $redux_builder_amp; ?>
		<title>
			<?php
			// title for a single post and single page
			if( is_single() || is_page() ){
				 global $post;
				 $title = $post->post_title;
				 echo $title . ' | ' . get_option( 'blogname' ) ;
			 }
			 // title for archive pages
			 if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] )  {
					 echo strip_tags(get_the_archive_title( '' ));
           echo ' | ';
					 echo strip_tags(get_the_archive_description( '' ));
			 }

			$site_title = get_bloginfo('name') . ' | ' . get_option( 'blogdescription' ) ;
			if ( is_home() ) {
				if  ( $redux_builder_amp['amp-frontpage-select-option']== 1) {
					$ID = $redux_builder_amp['amp-frontpage-select-option-pages'];
					$site_title =  get_the_title( $ID ) . ' | ' . get_option('blogname');
				} else {
        	global $wp;
          $current_archive_url = home_url( $wp->request );
          $current_url_in_pieces = explode('/',$current_archive_url);
          $cnt = count($current_url_in_pieces);
          if( is_numeric( $current_url_in_pieces[  $cnt-1 ] ) ) {
            $site_title .= ' | Page '.$current_url_in_pieces[$cnt-1];
          }
        }
				echo  $site_title ;
			} ?>
		</title>
	 	<?php
	}
}

// 27. Clean the Defer issue
	// TODO : Get back to this issue. #407
		function ampforwp_the_content_filter_full( $content_buffer ) {
            $ampforwp_is_amp_endpoint = ampforwp_is_amp_endpoint();
			if ( $ampforwp_is_amp_endpoint ) {
				$content_buffer = preg_replace("/' defer='defer/", "", $content_buffer);
				$content_buffer = preg_replace("/' defer onload='/", "", $content_buffer);
				$content_buffer = preg_replace("/onclick=[^>]*/", "", $content_buffer);
                $content_buffer = preg_replace("/<\\/?thrive_headline(.|\\s)*?>/",'',$content_buffer);
                // Remove Extra styling added by other Themes/ Plugins
               	$content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)<!doctype html>/','<!doctype html>',$content_buffer);
               	$content_buffer = preg_replace('/(<style(.*?)>(.*?)<\/style>)(\/\*)/','$4',$content_buffer);
                $content_buffer = preg_replace("/<\\/?g(.|\\s)*?>/",'',$content_buffer);
                $content_buffer = preg_replace('/(<[^>]+) spellcheck="false"/', '$1', $content_buffer);
                $content_buffer = preg_replace('/(<[^>]+) spellcheck="true"/', '$1', $content_buffer);
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

//31. removing scripts added by cleantalk
add_action('amp_init','ampforwp_remove_js_script_cleantalk');
function ampforwp_remove_js_script_cleantalk() {
    remove_action('wp_loaded', 'ct_add_nocache_script', 1);
}


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
	if ( $redux_builder_amp['ampforwp-disqus-comments-support'] ) {

		global $post; $post_slug=$post->post_name;

		$disqus_script_host_url = "https://ampforwp.com/goto/". AMPFORWP_DISQUS_URL;

		if( $redux_builder_amp['ampforwp-disqus-host-position'] == 0 ) {
			$disqus_script_host_url = esc_url( $redux_builder_amp['ampforwp-disqus-host-file'] );
		}

		$disqus_url = $disqus_script_host_url.'?disqus_title='.$post_slug.'&url='.get_permalink().'&disqus_name='. esc_url( $redux_builder_amp['ampforwp-disqus-comments-name'] ) ."/embed.js"  ;
		?>
		<section class="amp-wp-content post-comments amp-wp-article-content amp-disqus-comments" id="comments">
			<amp-iframe
				height="350"
				sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
				resizable
				frameborder="0"
				src="<?php echo $disqus_url ?>" >
				<div overflow tabindex="0" role="button" aria-label="Read more"> Disqus Comments Loading...</div>
			</amp-iframe>
		</section>
	<?php
	}
}

 add_filter( 'amp_post_template_data', 'ampforwp_add_disqus_scripts' );
function ampforwp_add_disqus_scripts( $data ) {
	if ( empty( $data['amp_component_scripts']['amp-iframe'] ) ) {
		$data['amp_component_scripts']['amp-iframe'] = 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js';
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
function ampforwp_add_extra_functions(){
	global $redux_builder_amp;
	if ( $redux_builder_amp['amp-design-selector'] == 3) {

		require AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/functions.php';
	}
}

//39. #529 editable archives
add_filter( 'get_the_archive_title', 'ampforwp_editable_archvies_title' );
function ampforwp_editable_archvies_title($title) {
	global $redux_builder_amp;
    if ( is_category() ) {
            $title = single_cat_title( $redux_builder_amp['amp-translator-archive-cat-text'].' ', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( $redux_builder_amp['amp-translator-archive-tag-text'].' ', false );
        }
    return $title;
}

//32. various lazy loading plugins Support
add_filter( 'amp_init', 'ampforwp_lazy_loading_plugins_compatibility' );
function ampforwp_lazy_loading_plugins_compatibility() {

   //WP Rocket
   add_filter( 'do_rocket_lazyload', '__return_false', PHP_INT_MAX );
   add_filter( 'do_rocket_lazyload_iframes', '__return_false', PHP_INT_MAX );

    //Lazy Load XT
		global $lazyloadxt;
		remove_filter( 'the_content', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'widget_text', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'post_thumbnail_html', array( $lazyloadxt, 'filter_html' ) );
		remove_filter( 'get_avatar', array( $lazyloadxt, 'filter_html' ) );

    // Lazy Load
		add_filter( 'lazyload_is_enabled', '__return_false', PHP_INT_MAX );

}

//Removing bj loading for amp
function ampforwp_remove_bj_load() {
 	if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
 		add_filter( 'bjll/enabled', '__return_false' );
 	}
}
add_action( 'bjll/compat', 'ampforwp_remove_bj_load' );

//33. #560 Header and Footer Editable html enabled script area
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
