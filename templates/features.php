<?php
/* This file will contain all the Extra FEATURES.

1. Add Home REL canonical
2. Custom Design
3. Custom Style files
4. Custom Header files
4.5 Added hook to add more layout.
5. Customize with Width of the site
6. Add required Javascripts for extra AMP features
7. Footer for AMP Pages
8. Add Main tag as a Wrapper
9. Advertisement code
10. Add Analytics to AMP Pages
11. Strip unwanted codes and tags from the_content
12. Add Logo URL in the structured metadata
13. Add Custom Placeholder Image for Structured Data.
14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
15. Disable New Relic's extra script that its adds in AMP pages.  
16. Remove Unwanted Scripts
17. Archives Canonical in AMP version
18. Custom Canonical for Homepage
19. Remove Canonical tags
*/
// Adding AMP-related things to the main theme 
	global $redux_builder_amp;
	
	// 1. Add Home REL canonical
	// Add AMP rel-canonical for home and archive pages 

	add_action('amp_init','ampforwp_allow_homepage');
	function ampforwp_allow_homepage(){
		add_action( 'wp', 'ampforwp_add_endpoint_actions' );
	}

	function ampforwp_add_endpoint_actions() {
		if ( is_home() || is_archive() ) {

			$is_amp_endpoint = is_amp_endpoint();

			if ( $is_amp_endpoint ) {
				amp_prepare_render();
			} else {
				add_action( 'wp_head', 'ampforwp_home_archive_rel_canonical' );
			}
			
		}
	}

	function ampforwp_home_archive_rel_canonical() {

		if ( is_home() || is_front_page() || is_archive() ) {

			if ( is_home() || is_front_page() ){
				$amp_url = home_url('/?amp');
			}
            elseif( is_archive()){
                global $wp;
                $archive_current_url = add_query_arg( '', '', home_url( $wp->request ) );
				$amp_url = $archive_current_url . '/?amp';
            } 
            else {
				$amp_url = trailingslashit( get_permalink().'amp' ); 
			}

			printf( '<link rel="amphtml" href="%s" />', esc_url( $amp_url ) );	
		}
	}


	// 2. Custom Design
	
	// Add Homepage AMP file code
	add_filter( 'amp_post_template_file', 'ampforwp_custom_template', 10, 3 );
	function ampforwp_custom_template( $file, $type, $post ) {
	   	// Custom Homepage and Archive file

        global $redux_builder_amp;
        if($redux_builder_amp['amp-frontpage-select-option'] == 0)  {
            if ( is_home() || is_archive() ) {
                if ( 'single' === $type ) {
                    $file = AMPFORWP_PLUGIN_DIR . '/templates/index.php';
                }
            }
        } elseif ($redux_builder_amp['amp-frontpage-select-option'] == 1) {
            if ( is_home() || is_archive() ) {
                if ( 'single' === $type ) {
                    $file = AMPFORWP_PLUGIN_DIR . '/templates/frontpage.php';
                }
            }
        }        
		// Custom Single file
	    if ( is_single() || is_page() ) {
	    	if ( 'single' === $type ) {
				$file = AMPFORWP_PLUGIN_DIR . '/templates/single.php';
			}
		}
	    return $file;
	}

	// 3. Custom Style files
	add_filter( 'amp_post_template_file', 'ampforwp_set_custom_style', 10, 3 );
	function ampforwp_set_custom_style( $file, $type, $post ) {
			if ( 'style' === $type ) {
				$file = AMPFORWP_PLUGIN_DIR . '/templates/style.php';
			}
			return $file;
	}

	// 4. Custom Header files
	add_filter( 'amp_post_template_file', 'mohammed_amp_set_custom_header', 10, 3 );
	function mohammed_amp_set_custom_header( $file, $type, $post ) {
			if ( 'header-bar' === $type ) {
				$file = AMPFORWP_PLUGIN_DIR . '/templates/header.php';
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
	add_action('amp_post_template_head','ampforwp_register_additional_scripts');
	function ampforwp_register_additional_scripts() {  
		global $redux_builder_amp; ?> 
    	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
      <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
			<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<?php if($redux_builder_amp['amp-enable-notifications'] == true)  { ?>
			<script async custom-element="amp-user-notification" src="https://cdn.ampproject.org/v0/amp-user-notification-0.1.js"></script>
	  <?php } ?>
		<?php if( $redux_builder_amp['enable-single-social-icons'] == true )  { ?>
			<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
		<?php } ?>
			<!-- AMP Advertisement Script  -->
			<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>

	<?php } 


	// 7. Footer for AMP Pages
	add_action('amp_post_template_footer','ampforwp_footer');
	function ampforwp_footer() {  
			global $redux_builder_amp;
			if ( is_home() ) {
				$ampforwp_backto_nonamp = home_url();
			} elseif ( is_single() ){
				$ampforwp_backto_nonamp = get_permalink( $post->ID );
			} else {
				$ampforwp_backto_nonamp = '';
			}
			?>

	    <footer class="container">
	        <div id="footer">
	            <p><a href="#header"> <?php _e('Top','ampforwp');?></a> <?php if ( $ampforwp_backto_nonamp ) { ?>  |  
	            	<a href="<?php echo $ampforwp_backto_nonamp; ?>"><?php _e('View Non-AMP Version','ampforwp');?></a> <?php  } ?>
	            </p>
	            <p><?php echo $redux_builder_amp['amp-footer-text']; ?> </p>
	        </div>
		</footer>
		
		<!-- Cookie Notification Code 
			added by @nicholasgriffintn in pull #121 -->
		<?php if($redux_builder_amp['amp-enable-notifications'] == true)  { ?>
			<amp-user-notification layout=nodisplay id="amp-user-notification1">
           <p><?php echo $redux_builder_amp['amp-notification-text']; ?> </p>
           <button on="tap:amp-user-notification1.dismiss"><?php echo $redux_builder_amp['amp-accept-button-text']; ?></button>
      </amp-user-notification>
	  <?php } ?>


	<?php }  

	// 8. Add Main tag as a Wrapper
	add_action('ampforwp_after_header','ampforwp_main_tag_begins');
	function ampforwp_main_tag_begins() {
		echo ' <main>';
	}

	add_action('amp_post_template_footer','ampforwp_main_tag_ends',9);
	function ampforwp_main_tag_ends() {
		echo '</main>';
	}	

	// 9. Advertisement code
		// Below Header Global
		add_action('ampforwp_after_header','ampforwp_header_advert');

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

	// 10. Add Analytics to AMP Pages
		add_action('amp_post_template_footer','ampforwp_google_analytics',11);
		function ampforwp_google_analytics() {  ?>
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
		<?php }

	// 11. Strip unwanted codes and tags from the_content
		add_action( 'pre_amp_render_post','ampforwp_strip_invalid_content');
		function ampforwp_strip_invalid_content(){
			add_filter( 'the_content', 'ampforwp_the_content_filter', 20 );
		}
		function ampforwp_the_content_filter( $content ) {
				 $content = preg_replace('/property=[^>]*/', '', $content);
				 $content = preg_replace('/vocab=[^>]*/', '', $content);
				 $content = preg_replace('/value=[^>]*/', '', $content);
				 $content = preg_replace('/contenteditable=[^>]*/', '', $content);
				 $content = preg_replace('/time=[^>]*/', '', $content);
				 $content = preg_replace('/non-refundable=[^>]*/', '', $content);
				 $content = preg_replace('/security=[^>]*/', '', $content);
				 $content = preg_replace('/deposit=[^>]*/', '', $content);
				 $content = preg_replace('/for=[^>]*/', '', $content);
				 $content = preg_replace('/style=[^>]*/', '', $content);
				 $content = preg_replace('/nowrap="nowrap"/', '', $content);
				 $content = preg_replace('#<comments-count.*?>(.*?)</comments-count>#i', '', $content);
				 $content = preg_replace('#<col.*?>#i', '', $content);
				 $content = preg_replace('#<table.*?>#i', '<table width="100%">', $content);
				 $content = preg_replace('#<style scoped.*?>(.*?)</style>#i', '', $content);
				 $content = preg_replace('/href="javascript:void*/', ' ', $content);
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
				return $metadata;
		}
		
		
	// 13. Add Custom Placeholder Image for Structured Data.
	// if there is no image in the post, then use this image to validate Structured Data.
add_filter( 'amp_post_template_metadata', 'ampforwp_update_metadata_featured_image', 10, 2 );
function ampforwp_update_metadata_featured_image( $metadata, $post ) {
			global $redux_builder_amp;
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
			return $metadata;
}

// 14. Adds a meta box to the post editing screen for AMP on-off on specific pages.
/**
 * Adds a meta box to the post editing screen for AMP on-off on specific pages
 */
function ampforwp_title_custom_meta() {
    add_meta_box( 'ampforwp_title_meta', __( 'Show AMP for Current Page?' ), 'ampforwp_title_callback', 'post','side' );
	
		add_meta_box( 'ampforwp_title_meta', __( 'Show AMP for Current Page?' ), 'ampforwp_title_callback', 'page','side' );
}
add_action( 'add_meta_boxes', 'ampforwp_title_custom_meta' );

/**
 * Outputs the content of the meta box for AMP on-off on specific pages
 */
function ampforwp_title_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ampforwp_title_nonce' );
    $ampforwp_stored_meta = get_post_meta( $post->ID );
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
			if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
				newrelic_disable_autorum();
			}
			return $data;
		}
}

// 16. Remove Unwanted Scripts
if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
	add_action( 'wp_enqueue_scripts', 'ampforwp_remove_unwanted_scripts',20 );
}
function ampforwp_remove_unwanted_scripts() {
  wp_dequeue_script('jquery'); 
}
// Remove Print Scripts and styles
function ampforwp_remove_print_scripts() {
    if ( is_amp_endpoint() ) {

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
function ampforwp_rel_canonical_archive() {
    if ( !is_archive() )
    return;
global $wp;
$current_archive_url = home_url( $wp->request );
//    $archivelink = esc_url( get_permalink( $id ) . AMP_QUERY_VAR . '/' );
    echo "<link rel='canonical' href='$current_archive_url' />\n";
}
add_action( 'amp_post_template_head', 'ampforwp_rel_canonical_archive' );

// 18. Custom Canonical for Homepage
function ampforwp_rel_canonical() {
    if ( !is_home() ) 
    return;
//    $link = esc_url( get_permalink( $id ) . AMP_QUERY_VAR . '/' );
    $homelink = get_home_url();
    echo "<link rel='canonical' href='$homelink' />\n";
}
add_action( 'amp_post_template_head', 'ampforwp_rel_canonical' );

// 18.5. Custom Canonical for Frontpage
//function ampforwp_rel_canonical_frontpage() {
//    if ( is_home() || is_front_page() ) 
//    return;
////    $link = esc_url( get_permalink( $id ) . AMP_QUERY_VAR . '/' );
//    $homelink = get_home_url();
//    echo "<link rel='canonical' href='$homelink' />\n";
//}
//add_action( 'amp_post_template_head', 'ampforwp_rel_canonical_frontpage' );
 
// 19. Remove Canonical tags
function ampforwp_amp_remove_actions() {
    if ( is_home() || is_front_page() || is_archive() ) {
        remove_action( 'amp_post_template_head', 'amp_post_template_add_canonical' );
    } 
}
add_action( 'amp_post_template_head', 'ampforwp_amp_remove_actions', 9 );