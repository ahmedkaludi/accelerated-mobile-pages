<?php 
/* This file will contain all the FEATURES to add like.

 1. Add homepage and Page support
 2. Add Home REL canonical
 3. Custom Single and homepage code
 4. Custom Style files
 5. Custom Header
 6. 
 7. Customize with Width of the site
 8. Customize endpoints
 9. Add required Javascripts for extra AMP features
10. Footer for AMP Pages
*/

	global $redux_builder_amp;

// Adding AMP-related things to the main theme 
	
	// 2. Add Home REL canonical
	// Add AMP rel-canonical for home and archive pages 

	add_action('amp_init','allow_homepage');

	function allow_homepage(){
		add_action( 'wp', 'new_amp_maybe_add_actions' );
	}

	function new_amp_maybe_add_actions() {
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

		if ( is_home() || is_archive() ) {

			if ( is_home() ){
				$amp_url = home_url('/?amp');
			} else {
				$amp_url = trailingslashit( get_permalink().'amp' ); 
			}

			printf( '<link rel="amphtml" href="%s" />', esc_url( $amp_url ) );	
		}
	}
	


	// 3. Custom Single and homepage code
	// Add Homepage AMP file code
	
	add_filter( 'amp_post_template_file', 'ampforwp_custom_template', 10, 3 );
	function ampforwp_custom_template( $file, $type, $post ) {
	   	// Custom Homepage and Archive file
	    if ( is_home() || is_archive() ) {
	    	if ( 'single' === $type ) {
				$file = AMPFORWP_PLUGIN_DIR . '/templates/index.php';
			}
		}
		// Custom Single file
	    if ( is_single() ) {
	    	if ( 'single' === $type ) {
				$file = AMPFORWP_PLUGIN_DIR . '/templates/single.php';
			}
		}
	    return $file;
	}


	// 4. Custom Style files
	add_filter( 'amp_post_template_file', 'mohammed_amp_set_custom_style', 10, 3 );
	function mohammed_amp_set_custom_style( $file, $type, $post ) {
	if ( 'style' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . '/templates/style.php';
	}
	return $file;
	}

	// 5. Custom Header files
	add_filter( 'amp_post_template_file', 'mohammed_amp_set_custom_header', 10, 3 );
	function mohammed_amp_set_custom_header( $file, $type, $post ) {
	if ( 'header-bar' === $type ) {
		$file = AMPFORWP_PLUGIN_DIR . '/templates/header.php';
	}
	return $file;
	}


	// 7.  Customize with Width of the site
	add_filter( 'amp_content_max_width', 'ampforwp_change_content_width' );

	function ampforwp_change_content_width( $content_max_width ) {
		return 1000;
	}

	// 9. Add required Javascripts for extra AMP features
	add_action('amp_post_template_head','ampforwp_register_additional_scripts');
	function ampforwp_register_additional_scripts() {  
		global $redux_builder_amp; ?> 
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
		<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<?php if( $redux_builder_amp['enable-single-social-icons'] == true )  { ?>
      		<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
		<?php } ?>
		<!-- AMP Advertisement Script  -->
		<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>

	<?php } 


	// 10. Footer for AMP Pages
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


	<?php }  

	// 11. Add Main tag as a Wrapper
	add_action('ampforwp_after_header','ampforwp_main_tag_begins');
	function ampforwp_main_tag_begins() {
		echo ' <main>';
	}

	add_action('amp_post_template_footer','ampforwp_main_tag_ends',9);
	function ampforwp_main_tag_ends() {
		echo '</main>';
	}	

	// 12. Advertisement code
		
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
	      		}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-1"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . ' 
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-1'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-1'] .' ">';
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
	      		}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-2"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . ' 
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-2'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-2'] .' ">';
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
	      		}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-3"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . ' 
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-3'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-3'] .' ">';
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
	      		}
				$output = '<div class="amp-ad-wrapper">';
				$output	.=	'<amp-ad class="amp-ad-4"
							type="adsense"
							width='. $advert_width .' height='. $advert_height . ' 
							data-ad-client="'. $redux_builder_amp['enable-amp-ads-text-feild-client-4'].'"
							data-ad-slot="'.  $redux_builder_amp['enable-amp-ads-text-feild-slot-4'] .' ">';
				$output	.=	'</amp-ad>';
				$output	.=   ' </div>';
				echo $output;
			}
		}


add_action('amp_post_template_footer','ampforwp_google_analytics',11);
function ampforwp_google_analytics() {  ?>
	<amp-analytics type="googleanalytics" id="analytics1">
		<script type="application/json">
		{
		  "vars": {
		    "account": "<?php echo $redux_builder_amp['ga-feild']; ?>" 
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
}

?> 