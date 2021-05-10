<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
// 12. Add Logo URL in the structured metadata
	    add_filter( 'amp_post_template_metadata', 'ampforwp_update_metadata', 10, 2 );
	    function ampforwp_update_metadata( $metadata, $post ) {
	        global $redux_builder_amp;
	        $structured_data_logo = '';
	        $structured_data_main_logo = '';
	        $ampforwp_sd_height = '';
	        $ampforwp_sd_width = '';
	        $ampforwp_sd_height = ampforwp_get_setting('ampforwp-sd-logo-height');
	        $ampforwp_sd_width = ampforwp_get_setting('ampforwp-sd-logo-width');
	        $ampforwp_sd_logo =  ampforwp_get_setting('amp-structured-data-logo','url');
	        if (ampforwp_get_setting('opt-media','url')!='') {
	          $structured_data_main_logo = ampforwp_get_setting('opt-media','url');
	        }
	        if (! empty( $ampforwp_sd_logo ) ) {
	          $structured_data_logo = esc_url( __(ampforwp_get_setting('amp-structured-data-logo','url'), 'accelerated-mobile-pages') );
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

	       	if('yoast' == ampforwp_get_setting('ampforwp-seo-selection') && ampforwp_get_setting('ampforwp-seo-yoast-description') && !class_exists('Yoast\\WP\\SEO\\Integrations\\Front_End_Integration')){
	         if ( class_exists('WPSEO_Frontend') ) {
	           $front = WPSEO_Frontend::get_instance();
	           $desc = $front->metadesc( false );
	           if ( $desc ) {
	             $metadata['description'] = $desc;
	           }

	           // Code for Custom Frontpage Yoast SEO Description
	           $post_id = ampforwp_get_frontpage_id();
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
			$ampforwp_sd_img_placeholder = ampforwp_get_setting('amp-structured-data-placeholder-image','url');

			if ( $post_image_check == false) {

				if (! empty( $ampforwp_sd_img_placeholder ) ) {
					$structured_data_image_url = esc_url(__(ampforwp_get_setting('amp-structured-data-placeholder-image','url'), 'accelerated-mobile-pages') );
				}
					$structured_data_image = $structured_data_image_url;
					$structured_data_height = intval(ampforwp_get_setting('amp-structured-data-placeholder-image-height'));
					$structured_data_width = intval(ampforwp_get_setting('amp-structured-data-placeholder-image-width'));

					$metadata['image'] = array(
						'@type' 	=> 'ImageObject',
						'url' 		=> $structured_data_image ,
						'height' 	=> $structured_data_height,
						'width' 	=> $structured_data_width,
					);
			}
			// Custom Structured Data information for Archive, Categories and tag pages.
			if ( is_archive() ) {
					$structured_data_image = esc_url( __(ampforwp_get_setting('amp-structured-data-placeholder-image','url'), 'accelerated-mobile-pages') );
					$structured_data_height = intval(ampforwp_get_setting('amp-structured-data-placeholder-image-height'));
					$structured_data_width = intval(ampforwp_get_setting('amp-structured-data-placeholder-image-width'));
					$structured_data_archive_title 	= esc_html(get_the_archive_title());
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
			if ( ! function_exists('amp_activate') ) {
				// Get Image metadata from the Custom Field
				if(ampforwp_is_custom_field_featured_image() && ampforwp_cf_featured_image_src()){
					$metadata['image'] = array(
							'@type' 	=> 'ImageObject',
							'url' 		=> ampforwp_cf_featured_image_src('url') ,
							'width' 	=> ampforwp_cf_featured_image_src('width'),
							'height' 	=> ampforwp_cf_featured_image_src('height'),
					);	
				}

				// Get image metadata from The Content
				if( true == $redux_builder_amp['ampforwp-featured-image-from-content'] && ampforwp_get_featured_image_from_content() ){
					$metadata['image'] = array(
							'@type' 	=> 'ImageObject',
							'url' 		=> ampforwp_get_featured_image_from_content('url') ,
							'width' 	=> ampforwp_get_featured_image_from_content('width'),
							'height' 	=> ampforwp_get_featured_image_from_content('height'),
					);
				}
			}

			if( in_array( "image" , $metadata )  ) {
				if ( $metadata['image']['width'] < 696 ) {
		 			$metadata['image']['width'] = 700 ;
	     		}
			}
		return $metadata;
	}




	// 45. searchpage, frontpage, homepage structured data
add_filter( 'amp_post_template_metadata', 'ampforwp_search_or_homepage_or_staticpage_metadata', 10, 2 );
function ampforwp_search_or_homepage_or_staticpage_metadata( $metadata, $post ) {
		global $redux_builder_amp,$wp;
		$desc = '';
		if( is_search() || is_home() || ( is_home() && $redux_builder_amp['amp-frontpage-select-option'] ) ) {

			if( is_home() || is_front_page() ){
				global $wp;
				$current_url = home_url( $wp->request );
				//$current_url = dirname( $current_url );
				$headline 	 =  get_bloginfo('name') . ' | ' . get_option( 'blogdescription' );
			} else {
				$current_url 	= trailingslashit(get_home_url())."?s=".get_search_query();
				$current_url 	= untrailingslashit( $current_url );
				$headline 		= ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:') . '  ' . get_search_query();
			}
			// creating this to prevent errors
			$structured_data_image_url = '';
			$page = '';
			$ampforwp_sd_img_placeholder = ampforwp_get_setting('amp-structured-data-placeholder-image','url');
			// placeholder Image area
			if (! empty( $ampforwp_sd_img_placeholder ) ) {
				$structured_data_image_url = esc_url(__(ampforwp_get_setting('amp-structured-data-placeholder-image','url'), 'accelerated-mobile-pages'));
			}
			$structured_data_image =  $structured_data_image_url; //  Placeholder Image URL
			$structured_data_height = intval(ampforwp_get_setting('amp-structured-data-placeholder-image-height')); //  Placeholder Image width
			$structured_data_width = intval(ampforwp_get_setting('amp-structured-data-placeholder-image-width')); //  Placeholder Image height
			$current_url_in_pieces = explode( '/', $current_url );
			if( ampforwp_is_front_page() ) {
				 // ID of slected front page
					$ID = ampforwp_get_frontpage_id();
					$headline =  get_the_title( $ID ) . ' | ' . get_option('blogname');
					$static_page_data = get_post( $ID );
					$datePublished = $static_page_data->post_date;
					$dateModified = $static_page_data->post_modified;
					$featured_image_array = wp_get_attachment_image_src( get_post_thumbnail_id($ID), 'full' ); 
					// Featured Image structured Data
					if( $featured_image_array ) {
						$structured_data_image = $featured_image_array[0];
						$structured_data_width  = $featured_image_array[1];
						$structured_data_height  = $featured_image_array[2];
					}
					// Frontpage Author
					$structured_data_author = '';
					$structured_data_author	= get_userdata($static_page_data->post_author );
					if ( $structured_data_author ) {
						$structured_data_author = $structured_data_author->display_name ;
					} else {
						$structured_data_author = "admin";
					}
					$metadata['author']['name'] = $structured_data_author;
				}
				else{
					if( ampforwp_get_blog_details() == true ) {
						$headline = ampforwp_get_blog_details('title') . ' | ' . get_option('blogname');
						$page_for_posts  =  get_option( 'page_for_posts' );
						$blog_data = get_post($page_for_posts); 
						if ( $post ) {
							$datePublished = $blog_data->post_date;
							$dateModified = $blog_data->post_modified;
						}
					}
					else {
						// To DO : check the entire else section .... time for search and homepage...wierd ???
						$datePublished = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) - 2 );
						// time difference is 2 minute between published and modified date
						$dateModified = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );
					}
				}
			$metadata['image'] = array(
				'@type' 	=> 'ImageObject',
				'url' 		=> $structured_data_image ,
				'height' 	=> $structured_data_height,
				'width' 	=> $structured_data_width,
			);
			$metadata['datePublished'] = $datePublished; // proper published date added
			$metadata['dateModified'] = $dateModified; // proper modified date
			$remove 	= '/'. AMPFORWP_AMP_QUERY_VAR;
			$current_url 	= str_replace($remove, '', $current_url);
		  	$query_arg_array = $wp->query_vars;
		  	if( array_key_exists( "page" , $query_arg_array  ) ) {
			   $page = $wp->query_vars['page'];
		  	}
		  	if ( $page >= '2') { 
				$current_url = trailingslashit( $current_url  . '?page=' . $page);
			}
			$metadata['mainEntityOfPage'] = trailingslashit($current_url); // proper URL added
			$metadata['headline'] = $headline; // proper headline added
	}
	// Description for Structured Data
	$desc =   esc_attr( convert_chars( stripslashes( ampforwp_generate_meta_desc('json'))) );
	$metadata['description'] = $desc;
	return $metadata;
}

// Structured Data Type
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_type', 20, 1 );
function ampforwp_structured_data_type( $metadata ) {
	if ( !is_array($metadata) ) {
		return $metadata;
	}
	global $redux_builder_amp, $post;
	$post_types 	= '';
	$set_sd_post 	= '';
	$set_sd_page 	= '';

	$set_sd_post 	= ampforwp_get_setting('ampforwp-sd-type-posts');
	$set_sd_page 	= ampforwp_get_setting('ampforwp-sd-type-pages');
 	$post_types 	= ampforwp_get_all_post_types();
 	if((function_exists('activate_wp_recipe_maker') || function_exists('activate_wp_recipe_maker_premium')) && (isset($set_sd_post) && $set_sd_post == 'Recipe')){
		return;
	}
	if ( $post_types ) { // If there are any custom public post types.
    	foreach ( $post_types  as $post_type ) {

        	if ( isset( $post->post_type ) && ('page' == $post->post_type || 'post' == $post->post_type) ) {
        		continue;
        	}
        	
	       	if ( isset( $post->post_type ) && $post->post_type == $post_type ) {
	       		if(ampforwp_get_setting('ampforwp-sd-type-'.esc_attr($post_type))==''){
	       			return;
	       		}
        		if ( ampforwp_get_setting('ampforwp-sd-type-'.esc_attr($post_type))=='' && ampforwp_get_setting('ampforwp-seo-yoast-description') == 0 ) {
					return;
				}
				if(isset($metadata['@type']) && $metadata['@type']){
        			$metadata['@type'] = ampforwp_get_setting('ampforwp-sd-type-'.esc_attr($post_type));
        		}
        		return $metadata;
        	}
        }
    }

    if( isset( $post->post_type ) && $post->post_type == "post" && empty( $set_sd_post )){
    	return;
    }elseif(isset( $post->post_type ) && $post->post_type == "page" && empty( $set_sd_page )) {
    	return;
    }

	if( empty($set_sd_post) && is_single() && ampforwp_get_setting('ampforwp-seo-yoast-description') == 0) {
		return;
	}

	if ( empty( $set_sd_page ) && is_singular( $post_type = 'page' ) && $redux_builder_amp['ampforwp-seo-yoast-description'] == 0 ) {
			return;
	}
	if ( isset( $post->post_type ) && 'post' == $post->post_type ) {
		if(isset($metadata['@type']) && $metadata['@type']){
			$metadata['@type'] = $set_sd_post;
		}
	}

	if ( (isset( $post->post_type ) && 'page' == $post->post_type) || ampforwp_is_front_page() || ampforwp_is_blog()) {
		if ( empty( $set_sd_page )){
			return;
		}
		if(isset($metadata['@type']) && $metadata['@type']){
			$metadata['@type'] = $set_sd_page;
		}
	}
	if(is_archive()){
		if(isset($metadata['@type']) && $metadata['@type']){
			$metadata['@type'] = 'CollectionPage';
		}
	}
	if(isset($metadata['@type']) && $metadata['@type'] == 'NewsArticle'){
	$content = $post->post_content;
	$metadata['articleBody'] = esc_html($content);
	}
	return $metadata;
}
// VideoObject
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_video_thumb', 20, 1 );
if ( ! function_exists('ampforwp_structured_data_video_thumb') ) {
	function ampforwp_structured_data_video_thumb( $metadata ) {
		if ( !is_array($metadata) ) {
    		return $metadata;
    	}
		global $redux_builder_amp, $post;
		// VideoObject
		if ( isset($metadata['@type']) && 'VideoObject' == $metadata['@type'] ) {
			$post_image_id = '';
			$post_image_id = get_post_thumbnail_id( get_the_ID() );
			$post_image = wp_get_attachment_image_src( $post_image_id, 'full' );
			$structured_data_video_thumb_url = '';
			$ampforwp_sd_video_thumb = ampforwp_get_setting('amporwp-structured-data-video-thumb-url','url') ;
			// If there's no featured image, take default from settings
			if ( false == $post_image ) {
				if ( ! empty( $sd_video_thumb ) ) {
						$structured_data_video_thumb_url = esc_url( __(ampforwp_get_setting('amporwp-structured-data-video-thumb-url','url'), 'accelerated-mobile-pages') );
					}
			}
			// If featured image is present, take it as thumbnail
			else {
				$structured_data_video_thumb_url = $post_image[0];
			}
			$metadata['name'] = $metadata['headline'];
			$metadata['uploadDate'] = $metadata['datePublished'];
			$metadata['thumbnailUrl'] = $structured_data_video_thumb_url;
			$desc = $post->post_content;
			if(ampforwp_is_home()){
				$desc = get_bloginfo('description');
			}
			if($desc){
				$desc = addslashes( wp_trim_words( strip_tags( $desc ) , 30 ) );
				$metadata['description'] = $desc;	
			}	       
		}
		// Recipe
		if ( isset($metadata['@type']) && 'Recipe' == $metadata['@type'] ) {
			$metadata['name'] = $metadata['headline'];
		}
		return $metadata;
	}
}
// #1975 Product
add_filter( 'amp_post_template_metadata', 'ampforwp_structured_data_product', 20, 1 );
if ( ! function_exists('ampforwp_structured_data_product') ) {
	function ampforwp_structured_data_product( $metadata ) {
		global $redux_builder_amp, $post;
		// Adding Product's Name and unsetting the Google unrecognized data for type Product
		if ( isset($metadata['@type']) && 'Product' == $metadata['@type'] ) {
			$metadata['name'] = $metadata['headline'];
			unset($metadata['dateModified']);
			unset($metadata['datePublished']);
			unset($metadata['publisher']);
			unset($metadata['author']);
			unset($metadata['headline']);
		}
		
		return $metadata;
	}
}
// Multiple Images #2259
add_filter( 'amp_post_template_metadata', 'ampforwp_sd_multiple_images', 20, 1 );
if ( ! function_exists('ampforwp_sd_multiple_images') ) {
	function ampforwp_sd_multiple_images($metadata){
		if ( ampforwp_get_setting('ampforwp-sd-multiple-images') ) {
			if ( isset($metadata['image']['width']) && 1200 <= $metadata['image']['width'] ){
				// 16x9
				$image1_width = 1280;
				$image1_height = 720;
				$image1 = ampforwp_aq_resize( $metadata['image']['url'], $image1_width, $image1_height, true, false, true );
				$image1_url = $image1[0];
				// 4x3
				$image2_width = 640;
				$image2_height = 480;
				$image2 = ampforwp_aq_resize( $metadata['image']['url'], $image2_width, $image2_height, true, false, true );
				$image2_url = $image2[0];
				// 1x1
				$image3_width = 300;
				$image3_height = 300;
				$image3 = ampforwp_aq_resize( $metadata['image']['url'], $image3_width, $image3_height, true, false, true );
				$image3_url = $image3[0];
				$metadata['image'] = array($image1_url, $image2_url, $image3_url); 
			}
		}
		return $metadata;
	}
}
// schema.org/SiteNavigationElement missing from menus #1229 & #2952
add_action('amp_post_template_footer','ampforwp_sd_sitenavigation');
function ampforwp_sd_sitenavigation(){
	if (!ampforwp_get_setting('ampforwp-sd-switch')) {
		return;
	}
	if (class_exists('Bunyad_Theme_SmartMag')) {
	    if (!is_single() || !Bunyad::posts()->meta('reviews')) {
	      return;
	    }
	    $schema_type = Bunyad::posts()->meta('review_schema') ? Bunyad::posts()->meta('review_schema') : 'Product';
	    $item_author = Bunyad::posts()->meta('review_item_author') ? Bunyad::posts()->meta('review_item_author') : get_the_author();
	    $item_name   = Bunyad::posts()->meta('review_item_name') ? Bunyad::posts()->meta('review_item_name') : get_the_title();
	    $item_author_type = Bunyad::posts()->meta('review_item_author_type');
	     $image_url = ampforwp_get_post_thumbnail('url','full');
	        $image_width = ampforwp_get_post_thumbnail('width');
	        $image_height = ampforwp_get_post_thumbnail('height');
	        $post_image_meta = false;
	        if (!empty($image_url)) {
	          $post_image_meta = array(
	        '@type' => 'ImageObject',
	        'url' => $image_url,
	        'width' => $image_width,
	        'height' => $image_height,
	      );
	        }
	    $publisher = array(
	      '@type'  => 'Organization',
	      'name'   => get_bloginfo('name'),
	      'sameAs' => get_bloginfo('url')
	    );
	    $description = (
	      Bunyad::posts()->meta('review_verdict_text') 
	        ? Bunyad::posts()->meta('review_verdict_text') 
	        : strip_tags(Bunyad::posts()->excerpt(null, 180, ['add_more' => false]))
	    );
	    $author_data = [
	      '@type' => $item_author_type ? ucfirst($item_author_type) : 'Person',
	      'name'  => $item_author
	    ];
	    $have_author = [
	      'CreativeWorkSeason', 'CreativeWorkSeries', 'Game', 'MediaObject', 'MusicPlaylist', 'MusicRecording'
	    ];
	    // Final schema.
	    $schema      = array(
	      '@context' => 'http://schema.org',
	      '@type'    => 'Review',

	      'itemReviewed' => array(
	        '@type'  => $schema_type,
	        'name'   => $item_name,
	        'image'  => $post_image_meta,
	      ),
	      'author'   => array(
	        '@type' => 'Person',
	        'name'  => get_the_author(),
	      ),
	      'publisher' => $publisher,
	      'reviewRating' => array(
	        '@type'       => 'Rating',
	        'ratingValue' => Bunyad::posts()->meta('review_overall'),
	        'bestRating'  => Bunyad::options()->review_scale,
	      ),
	      'description'   => substr($description, 0, 200),
	      'datePublished' => get_the_date(DATE_W3C),
	    );
	    if ($link = Bunyad::posts()->meta('review_item_link')) {
	      $schema['itemReviewed']['sameAs'] = esc_url($link);
	    }
	    $schema_id     = esc_url(get_permalink()) . '#review';
	    $schema['@id'] = $schema_id;
	    $schema['itemReviewed']['review'] = ['@id' => $schema_id];
	    if (in_array($schema_type, $have_author)) {
	      $schema['itemReviewed']['author'] = $author_data;
	    } 
	    if ($schema_type == 'Product' ) {
	      if (Bunyad::posts()->meta('review_item_author')) {
	        $author_data['@type'] = 'Brand';
	        $schema['itemReviewed']['brand'] = $author_data;
	      }
	      $schema['itemReviewed']['description'] = $description;
	    }else{
	      return;
	    }
	    echo '<script type="application/ld+json">' . json_encode($schema) . "</script>";
    }
    if ( ! class_exists('saswp_fields_generator') && ampforwp_get_setting('ampforwp-sd-navigation-schema')) {
	    $input = array();           
	    $navObj = array();
	    $ampforwp_sd_menu = get_transient('ampforwp_sd_menu');
	    if ( true == get_transient('ampforwp_header_sd_menu') && true == get_transient('ampforwp_footer_sd_menu') && false !=  $ampforwp_sd_menu) {
	    	$navObj[] = $ampforwp_sd_menu;
	    }
	    $menuLocations = get_nav_menu_locations();
	    if(!empty($menuLocations) ){ 
	    	if ( empty($navObj) ) {  
		        foreach($menuLocations as $type => $id){
	                if( $type == 'amp-menu' || $type == 'amp-footer-menu' ){
			            $menuItems = wp_get_nav_menu_items($id);
			            if($menuItems){
		                    foreach($menuItems as $items){
		                      $navObj[] = array(
		                             "@context"  => "https://schema.org",
		                             "@type"     => "SiteNavigationElement",
		                             "@id"       => trailingslashit(get_home_url()).$type,
		                             "name"      => $items->title,
		                             "url"       => $items->url
		                      );

		                    }
		           		}   
		            }
		            if ( 'amp-menu' == $type ) {
		            	set_transient('ampforwp_header_sd_menu', true , 15*DAY_IN_SECONDS );
		            }
		            if ( 'amp-footer-menu' == $type ) {
		            	set_transient('ampforwp_footer_sd_menu', true , 15*DAY_IN_SECONDS );
		            }
	            	set_transient('ampforwp_sd_menu', $navObj , 15*DAY_IN_SECONDS );
		        }
		    }
	        if($navObj){  
	            $input['@context'] = 'https://schema.org'; 
	            $input['@graph']   = $navObj; ?>       
	    		<script type="application/ld+json"><?php echo wp_json_encode( $input, JSON_UNESCAPED_UNICODE ); ?></script>
	        <?php }
	    }
	}
} 