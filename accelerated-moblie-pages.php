<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP for WP - Accelerated Mobile Pages for WordPress
Version: 1.0.86
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: https://ampforwp.com/
Donate link: https://www.paypal.me/Kaludi/25
License: GPL2+
Text Domain: accelerated-mobile-pages
Domain Path: /languages/
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define('AMPFORWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('AMPFORWP_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('AMPFORWP_DISQUS_URL',plugin_dir_url(__FILE__).'includes/disqus.html');
define('AMPFORWP_IMAGE_DIR',plugin_dir_url(__FILE__).'images');
define('AMPFORWP_MAIN_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
define('AMPFORWP_VERSION','1.0.86');
define('AMPFORWP_EXTENSION_DIR',plugin_dir_path(__FILE__).'includes/options/extensions');
define('AMPFORWP_ANALYTICS_URL',plugin_dir_url(__FILE__).'includes/features/analytics');
if(!defined('AMPFROWP_HOST_NAME')){
	$urlinfo = get_bloginfo('url');
	$url = parse_url($urlinfo);
	$host = $url['host'];
	define('AMPFROWP_HOST_NAME', esc_attr($host));
}
// any changes to AMP_QUERY_VAR should be refelected here
function ampforwp_generate_endpoint(){
    $ampforwp_slug = '';
    $get_permalink_structure = '';

   	$ampforwp_slug = "amp";

    return $ampforwp_slug;
}

define('AMPFORWP_AMP_QUERY_VAR', apply_filters( 'amp_query_var', ampforwp_generate_endpoint() ) );

// Rewrite the Endpoints after the plugin is activate, as priority is set to 11
function ampforwp_add_custom_post_support() {
	// Adding rewrite rules only when we are in standard mode
	if (is_amp_plugin_active()) {
		return;
	}
	global $redux_builder_amp;
	add_rewrite_endpoint( AMPFORWP_AMP_QUERY_VAR, EP_PAGES | EP_PERMALINK | EP_AUTHORS | EP_ALL_ARCHIVES | EP_ROOT );
	// Pages
	if ( isset($redux_builder_amp['amp-on-off-for-all-pages']) && $redux_builder_amp['amp-on-off-for-all-pages'] ) {
		add_post_type_support( 'page', AMPFORWP_AMP_QUERY_VAR );
	}
	// Custom Post Types
	if ( isset($redux_builder_amp['ampforwp-custom-type'] ) && $redux_builder_amp['ampforwp-custom-type'] ) {
	        foreach ( $redux_builder_amp['ampforwp-custom-type'] as $custom_post ) {
	            add_post_type_support( $custom_post, AMP_QUERY_VAR );
	        }
	}
}
add_action( 'init', 'ampforwp_add_custom_post_support',11);

// Frontpage and Blog page check from reading settings.
function ampforwp_name_blog_page() {
	if ( ! $page_for_posts = get_option('page_for_posts')) return;
	$page_for_posts = get_option( 'page_for_posts' );
	$post = get_post($page_for_posts); 
	if ( $post ) {
		$slug = $post->post_name;
		return $slug;
	}
}
function ampforwp_custom_post_page() {
	$front_page_type = get_option( 'show_on_front' );
	if ( $front_page_type ) {
		return $front_page_type;
	}
}

function ampforwp_get_the_page_id_blog_page(){
	$page = "";
	$output = "";
	if ( ampforwp_name_blog_page() ) {
		$page = get_page_by_path( ampforwp_name_blog_page() );
		if( $page )
			$output = $page->ID;
	}

	return $output;
}

/**
 * All in One SEO Plugin Conflict
 * for stopping redirecting
 * on amp query string
 * @since 1.0.82
*/
if( in_array( 'all-in-one-seo-pack/all_in_one_seo_pack.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_filter( 'aioseo_unrecognized_allowed_query_args', 'AMP_for_WP_QueryStringAllowed_for_AIOSEO_Plugin', -1 );
    function AMP_for_WP_QueryStringAllowed_for_AIOSEO_Plugin($allowedQueryArgs) {
        return array_merge($allowedQueryArgs, array(
            'nonamp',
            'namp',
            'nonamphead',
        ));
    }
}

// Add Custom Rewrite Rule to make sure pagination & redirection is working correctly
function ampforwp_add_custom_rewrite_rules() {
	
	// Adding rewrite rules only when we are in standard mode
	if (is_amp_plugin_active()) {
		return;
	}
	global $redux_builder_amp, $wp_rewrite;
    // For Homepage
    add_rewrite_rule(
      'amp/?$',
      'index.php?amp',
      'top'
    );
    do_action('ampforwp_rewrite_rules_hook');
	// For Homepage with Pagination
    add_rewrite_rule(
        'amp/'.$wp_rewrite->pagination_base.'/([0-9]{1,})/?$',
        'index.php?amp=1&paged=$matches[1]',
        'top'
    );
     // For Pagination with index.php
    add_rewrite_rule(
        'index.php/amp/'.$wp_rewrite->pagination_base.'/([0-9]{1,})/?$',
        'index.php?amp=1&paged=$matches[1]',
        'top'
    );
	// For /Blog page with Pagination
	if( ampforwp_name_blog_page() ) {
	    add_rewrite_rule(
	        ampforwp_name_blog_page(). '/amp/'.$wp_rewrite->pagination_base.'/([0-9]{1,})/?$',
	        'index.php?amp=1&paged=$matches[1]&page_id=' .ampforwp_get_the_page_id_blog_page(),
	        'top'
	    );
	    // Pagination to work with Extensions like.hml
	    add_rewrite_rule(
	        ampforwp_name_blog_page(). '(.+?)/amp/'.$wp_rewrite->pagination_base.'/([0-9]{1,})/?$',
	        'index.php?amp=1&paged=$matches[2]&page_id=' .ampforwp_get_the_page_id_blog_page(),
	        'top'
	    );
	}

    // For Author pages
    add_rewrite_rule(
        'author\/([^/]+)\/amp\/?$',
        'index.php?amp=1&author_name=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        'author\/([^/]+)\/amp\/'.$wp_rewrite->pagination_base.'\/?([0-9]{1,})\/?$',
        'index.php?amp=1&author_name=$matches[1]&paged=$matches[2]',
        'top'
    );

    // For category pages
    $rewrite_category = '';
    $rewrite_category = get_transient('ampforwp_category_base');

    if ( false == $rewrite_category ) {
    	$rewrite_category = get_option('category_base');
    	if (  empty($rewrite_category) ) {
	    	$rewrite_category = 'category';
	    }
    	set_transient('ampforwp_category_base', $rewrite_category);
    }

    add_rewrite_rule(
      $rewrite_category.'\/(.+?)\/amp/?$',
      'index.php?amp=1&category_name=$matches[1]',
      'top'
    );
    // For category pages with Pagination
    add_rewrite_rule(
      $rewrite_category.'/(.+?)\/amp\/'.$wp_rewrite->pagination_base.'\/?([0-9]{1,})\/?$',
      'index.php?amp=1&category_name=$matches[1]&paged=$matches[2]',
      'top'
    );

    // For category pages with Pagination (Custom Permalink Structure)
	$permalink_structure = '';
	$permalink_structure = get_transient('ampforwp_permalink_structure');
    if ( false == $permalink_structure ) {
		$permalink_structure = get_option('permalink_structure');
		set_transient('ampforwp_permalink_structure', $permalink_structure );
    }
	$permalink_structure = preg_replace('/(%.*%)/', '', $permalink_structure);
	$permalink_structure = preg_replace('/\//', '', $permalink_structure);
	if ( $permalink_structure ) {
	  	add_rewrite_rule(
	      $permalink_structure.'\/'.$rewrite_category.'\/(.+?)\/amp\/'.$wp_rewrite->pagination_base.'\/?([0-9]{1,})\/?$',
	      'index.php?amp=1&category_name=$matches[1]&paged=$matches[2]',
	      'top'
	    );
  	}

    // For tag pages
    $rewrite_tag = '';
    $rewrite_tag = get_transient('ampforwp_tag_base');
    if ( false == $rewrite_tag ) {   	
		$rewrite_tag = get_option('tag_base');
	    if ( empty($rewrite_tag) ) {
	    	$rewrite_tag = 'tag';
	    }
	    set_transient('ampforwp_tag_base',$rewrite_tag);
    }

    add_rewrite_rule(
      $rewrite_tag.'\/(.+?)\/amp/?$',
      'index.php?amp=1&tag=$matches[1]',
      'top'
    );
    // For tag pages with Pagination
    add_rewrite_rule(
      $rewrite_tag.'\/(.+?)\/amp\/'.$wp_rewrite->pagination_base.'\/?([0-9]{1,})\/?$',
      'index.php?amp=1&tag=$matches[1]&paged=$matches[2]',
      'top'
    );
    // For tag pages with Pagination (Custom Permalink Structure)
    if ( $permalink_structure ) {
	  	add_rewrite_rule(
	      $permalink_structure.'\/'.$rewrite_tag.'\/(.+?)\/amp\/'.$wp_rewrite->pagination_base.'\/?([0-9]{1,})\/?$',
	      'index.php?amp=1&tag=$matches[1]&paged=$matches[2]',
	      'top'
	    );
  	}
  	// Rewrite rule for date archive
  	add_rewrite_rule(
      '([0-9]{4})/([0-9]{1,2})\/amp\/?$',
      'index.php?year=$matches[1]&monthnum=$matches[2]&amp=1',
      'top'
    );
    // Rewrite rule for date archive with pagination #2289
  	add_rewrite_rule(
      '([0-9]{4})/([0-9]{1,2})/amp/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$',
      'index.php?year=$matches[1]&monthnum=$matches[2]&amp=1&paged=$matches[3]',
      'top'
    );
	//Rewrite rule for custom Taxonomies
	$taxonomies = array();
    if( function_exists('ampforwp_generate_taxonomies_transient')){
    	//Rewrite rule for custom Taxonomies
		$taxonomies = ampforwp_generate_taxonomies_transient();
    }

  	if(!function_exists('amp_woocommerce_pro_add_woocommerce_support') ) {
		if( class_exists( 'WooCommerce' ) ) {
			$wc_permalinks = '';
			$wc_permalinks = get_transient('ampforwp_woocommerce_permalinks');
			if( false == $wc_permalinks ) {
				$wc_permalinks 	= get_option( 'woocommerce_permalinks' );
				set_transient('ampforwp_woocommerce_permalinks', $wc_permalinks);		
			}
			if ( $wc_permalinks && !empty( $taxonomies) ) {
				$taxonomies = array_merge($taxonomies, $wc_permalinks);
			}
		}
	}
	$post_types = ampforwp_get_all_post_types();
	if ( $post_types ) {
		foreach ($post_types as $post_type ) {
			if ( 'post' !=  $post_type && 'page' != $post_type ){
				add_rewrite_rule(
			      $post_type.'\/amp/?$',
			      'index.php?amp&post_type='.$post_type,
			      'top'
			    );
			    if ( class_exists( 'Lsvr_Permalink_Settings_Knowledge_Base' ) ) {
				    $lsvr_value = get_post_type_archive_link( 'lsvr_kba' );
				    $lsvr_value = explode("/",$lsvr_value);
				    $lsvr_value = array_filter($lsvr_value);
				    $lsvr_value = end($lsvr_value);
				    add_rewrite_rule(
				      $lsvr_value.'\/amp/?$',
				      'index.php?amp&post_type='.$post_type,
				      'top'
				    );
				}
			    add_rewrite_rule(
			      $post_type.'\/(.+?)\/amp\/?$',
			      'index.php?amp&'.$post_type.'=$matches[1]',
			      'top'
			    );
			    add_rewrite_rule(
			      $post_type.'\/(.+?)\/amp\/?$',
			      'index.php?amp&'.$post_type.'=$matches[1]',
			      'top'
			    );
			    add_rewrite_rule(
			      $post_type.'\/amp/'.$wp_rewrite->pagination_base.'/([0-9]{1,})/?$',
			      'index.php?amp=1&post_type='.$post_type.'&paged=$matches[1]',
			      'top'
			   );
			}
		}
	}
	
	$taxonomies = apply_filters( 'ampforwp_modify_rewrite_tax', $taxonomies );
	if ( $taxonomies ) {
		$taxonomySlug = '';
		foreach ( $taxonomies  as  $taxonomyName => $taxonomyLabel ) {
			$taxonomies = get_taxonomy( $taxonomyName );
			if(isset($taxonomies->rewrite['slug']) && !empty($taxonomies->rewrite['slug']) ){
				$taxonomySlug = $taxonomies->rewrite['slug'];
			}else{
				$taxonomySlug = $taxonomyName;
			}
			if ( ! empty( $taxonomySlug ) ) {
			    add_rewrite_rule(
			      $taxonomySlug.'\/([^/]+)\/amp/?$',
			      'index.php?amp&'.$taxonomyName.'=$matches[1]',
			      'top'
			    );
			    // For Custom Taxonomies with pages
			    add_rewrite_rule(
			      $taxonomySlug.'\/([^/]+)\/amp\/'.$wp_rewrite->pagination_base.'\/?([0-9]{1,})\/?$',
			      'index.php?amp&'.$taxonomyName.'=$matches[1]&paged=$matches[2]',
			      'top'
			    );
			}
		}
	}
	if (ampforwp_get_setting('ampforwp-pagination-link-type')) {
		add_rewrite_rule(
	      '(.+?)-[0-9]+\/([0-9]{1,})\/amp$',
	      'index.php?amp=1&name=$matches[1]&paged=$matches[2]',
	      'top'
	    );
		add_rewrite_rule(
	      '(.+?)\/([0-9]{1,})\/amp$',
	      'index.php?amp=1&name=$matches[1]&paged=$matches[2]',
	      'top'
	    ); 
    }
}
add_action( 'init', 'ampforwp_add_custom_rewrite_rules', 25 );
// Delete category_base transient when it is updated #2924
add_action('update_option_category_base', 'ampforwp_update_option_category_base');
function ampforwp_update_option_category_base(){
	delete_transient('ampforwp_category_base');
}
// Delete category_base transient when it is updated #2924
add_action('update_option_tag_base', 'ampforwp_update_option_tag_base');
function ampforwp_update_option_tag_base(){
	delete_transient('ampforwp_tag_base');
}
// Delete permalink_structure transient when it is updated #2924
add_action('update_option_permalink_structure', 'ampforwp_update_option_permalink_structure');
function ampforwp_update_option_permalink_structure(){
	delete_transient('ampforwp_permalink_structure');
	// Delete ampforwp_woocommerce_permalinks transient when it is updated #2924
	if( class_exists( 'WooCommerce' ) ) {
		delete_transient('ampforwp_woocommerce_permalinks');
	}
}
// add re-write rule for Products
add_action( 'init', 'ampforwp_custom_rewrite_rules_for_product_category' );
if ( ! function_exists('ampforwp_custom_rewrite_rules_for_product_category') ) {
	function ampforwp_custom_rewrite_rules_for_product_category(){
		
		// Adding rewrite rules only when we are in standard mode
		if (is_amp_plugin_active()) {
			return;
		}
		if ( class_exists('WooCommerce') ) {
			$permalinks = wp_parse_args( (array) get_option( 'woocommerce_permalinks', array() ), array(
				'product_base'           => '',
				'category_base'          => '',
				'tag_base'               => '',
				'attribute_base'         => '',
				'use_verbose_page_rules' => false,
			) );
			// Ensure rewrite slugs are set.
			$permalinks['product_rewrite_slug']   = untrailingslashit( empty( $permalinks['product_base'] ) ? _x( 'product', 'slug', 'accelerated-mobile-pages' )             : $permalinks['product_base'] );
			$permalinks['category_rewrite_slug']  = untrailingslashit( empty( $permalinks['category_base'] ) ? _x( 'product-category', 'slug', 'accelerated-mobile-pages' )   : $permalinks['category_base'] );
			$permalinks['tag_rewrite_slug']       = untrailingslashit( empty( $permalinks['tag_base'] ) ? _x( 'product-tag', 'slug', 'accelerated-mobile-pages' )             : $permalinks['tag_base'] );
			$permalinks['attribute_rewrite_slug'] = untrailingslashit( empty( $permalinks['attribute_base'] ) ? '' : $permalinks['attribute_base'] );



			add_rewrite_rule( 
				 $permalinks['product_rewrite_slug']."\/amp\/page\/([0-9]{1,})/?$",
				 'index.php?post_type=product&paged=$matches[1]&amp=1',
				 'top' 
				);
			add_rewrite_rule( 
				 $permalinks['category_rewrite_slug'].'\/(.+?)\/amp\/page\/?([0-9]{1,})/?$',
				 'index.php?product_cat=$matches[1]&paged=$matches[2]&amp=1',
				 'top' 
				);	
			add_rewrite_rule(
			      $permalinks['category_rewrite_slug'].'\/(.+?)\/amp\/?$',
			      'index.php?amp&product_cat=$matches[1]',
			      'top'
			    );


			add_rewrite_rule( 
				 $permalinks['tag_rewrite_slug'].'\/(.+?)\/amp\/page\/?([0-9]{1,})/?$',
				 'index.php?product_tag=$matches[1]&paged=$matches[2]&amp=1',
				 'top' 
				);	
			add_rewrite_rule(
			      $permalinks['tag_rewrite_slug'].'\/(.+?)\/amp\/?$',
			      'index.php?amp&product_tag=$matches[1]',
			      'top'
			    );
		 }
	}
}

function ampforwp_plugin_info(){
	$data = array();
	$date = new DateTime();
	$data = array('activation_data' => $date->getTimestamp() );
	add_option( 'ampforwp_plugin_info', $data );
}
add_action('upgrader_process_complete','ampforwp_plugin_info' );

register_activation_hook( __FILE__, 'ampforwp_rewrite_activation', 20 );
function ampforwp_rewrite_activation() {

	if ( ! did_action( 'ampforwp_init' ) ) {
 		ampforwp_init();
	}

	flush_rewrite_rules();

    ampforwp_add_custom_post_support();
    ampforwp_add_custom_rewrite_rules();
    ampforwp_plugin_info();

    // Flushing rewrite urls ONLY on activation
	global $wp_rewrite;
	$wp_rewrite->flush_rules();

	delete_option('ampforwp_rewrite_flush_option');

    // Set transient for Welcome page
	set_transient( 'ampforwp_welcome_screen_activation_redirect', true, 30 );

}

add_action( 'admin_init', 'ampforwp_flush_after_update');
function ampforwp_flush_after_update() {
	// Flushing rewrite urls ONLY on after Update is installed
	$older_version = "";
	$older_version = get_transient('ampforwp_current_version_check');
	if ( empty($older_version) || ( $older_version <  AMPFORWP_VERSION ) ) {
		flush_rewrite_rules();
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		set_transient('ampforwp_current_version_check', AMPFORWP_VERSION);
	}
}


add_action('init', 'ampforwp_flush_rewrite_by_option', 20);

function ampforwp_flush_rewrite_by_option(){

	global $wp_rewrite;
	$get_current_permalink_settings  = "";

	$get_current_permalink_settings  = get_option('ampforwp_rewrite_flush_option');

	if ( $get_current_permalink_settings ) {
		return;
	}
	// Adding double check to make sure, we are not updating and calling database unnecessarily
	if ( empty( $get_current_permalink_settings ) ) {
		$wp_rewrite->flush_rules();
		update_option('ampforwp_rewrite_flush_option', 'true');
	}

}

register_deactivation_hook( __FILE__, 'ampforwp_rewrite_deactivate', 20 );
function ampforwp_rewrite_deactivate() {
	// Flushing rewrite urls ONLY on deactivation
	global $wp_rewrite;
	
	foreach ( $wp_rewrite->endpoints as $index => $endpoint ) {
		if ( AMP_QUERY_VAR === $endpoint[1] ) {
			unset( $wp_rewrite->endpoints[ $index ] );
			break;
		}
	}

	flush_rewrite_rules();

	$wp_rewrite->flush_rules();

	// Remove transient for Welcome page
	delete_transient( 'ampforwp_welcome_screen_activation_redirect');
	// Remove admin notice after dismissing it
	delete_transient( 'ampforwp_automattic_activation_notice');

}

if( !function_exists('ampforwp_upcomming_layouts_demo') ){
	function ampforwp_upcomming_layouts_demo(){
		return array(
			array(	
			"name"=>'Creative Services',	
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-9.png',	
			"link"=>'https://ampforwp.com/layouts-9/',	
			),
			array(	
			"name"=>'App',	
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-8.png',	
			"link"=>'https://ampforwp.com/layouts-8/',	
			),
			array(	
			"name"=>'Business Blog',	
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-7.png',	
			"link"=>'https://ampforwp.com/layouts-7/',	
			),
			array(	
			"name"=>'Journal',	
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-6.png',	
			"link"=>'https://ampforwp.com/layouts-6/',	
			),
			array(	
			"name"=>'Studio',	
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-5.png',	
			"link"=>'https://ampforwp.com/layouts-5/',	
			),
			array(	
			"name"=>'Agency',	
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-4.png',	
			"link"=>'https://ampforwp.com/layouts-4/',	
			),	
			array(	
			"name"=>'Elegance',	
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-3.png',	
			"link"=>'https://ampforwp.com/layouts-3/',	
			),
			array(
			"name"=>'Weekly Magazine',
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-2.png',
			"link"=>'https://ampforwp.com/layouts-2/',
			),
            array( 
			"name"=>'News',
			"image"=>''.AMPFORWP_IMAGE_DIR . '/layouts-1.png',
			"link"=>'https://ampforwp.com/layouts-1/',
			),
			
			);
	}
}

require_once dirname( __FILE__ ).'/includes/options/redux-core/framework.php';
require_once dirname( __FILE__ ).'/includes/options/extensions/loader.php';
add_action('after_setup_theme', 'ampforwp_include_options_file' );

function ampforwp_include_options_file(){	
	if ( is_admin() ) {
		// Register all the main options	
		require_once dirname( __FILE__ ).'/includes/options/admin-config.php';
		require_once dirname( __FILE__ ).'/templates/report-bugs.php';
		// Global UX Fields
		$amp_ux_fields = array();
		require_once AMPFORWP_PLUGIN_DIR."includes/ampforwp-fields-array.php";
	}
}

// Modules 
add_action('after_setup_theme','ampforwp_add_module_files');
function ampforwp_add_module_files() {
	
	global $redux_builder_amp;
	if ( function_exists('ampforwp_custom_theme_files_register') ) {
		if ( ! function_exists( 'bstw' ) ) {
			require_once AMPFORWP_PLUGIN_DIR .'/includes/vendor/tinymce-widget/tinymce-widget.php';
		}
		require_once AMPFORWP_PLUGIN_DIR .'/includes/modules/ampforwp-blurb.php';
		require_once AMPFORWP_PLUGIN_DIR .'/includes/modules/ampforwp-button.php';
	}
}

/*
 * Load Files only in the backend
 * As we don't need plugin activation code to run everytime the site loads
*/
if ( is_admin() ) {
	add_action( 'plugins_loaded', 'amp_update_db_check' );
	// Include Welcome page only on Admin pages
	require AMPFORWP_PLUGIN_DIR .'/includes/welcome.php';

 	// Add Settings Button in Plugin backend
 	if ( ! function_exists( 'ampforwp_plugin_settings_link' ) ) {
 		
 		// Deactivate Parent Plugin notice
 		add_filter( 'plugin_action_links', 'ampforwp_plugin_settings_link', 10, 5 );

 		function ampforwp_plugin_settings_link( $actions, $plugin_file ) {
 			static $plugin;
 			if ( ! isset($plugin))
 				$plugin = plugin_basename(__FILE__);
 				if ( $plugin === $plugin_file ) {
 					$amp_activate = '';
 					if ( function_exists('amp_activate') ) {
 						$amp_activate = ' | <span style="color:black;">Status: Addon Mode</span style=>';
 					}
 					$settings = array( 'settings' => '<a href="admin.php?page=amp_options&tab=8">' . esc_html__('Settings', 'accelerated-mobile-pages') . '</a> | <a href="https://ampforwp.com/extensions/#utm_source=plugin-panel&utm_medium=plugin-extension&utm_campaign=features">' . esc_html__('Premium Features', 'accelerated-mobile-pages') . '</a> | <a href="https://ampforwp.com/membership/#utm_source=plugin-panel&utm_medium=plugin-extension&utm_campaign=pro">' . esc_html__('Pro', 'accelerated-mobile-pages') . '</a>'. $amp_activate );
 					
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					$actions = array_merge( $actions, $settings );
 				}
 		return $actions;
 		}
 	}
} // is_admin() closing

// Fallback for file exists #3156
if( ! function_exists('ampforwp_require_file') ){
	function ampforwp_require_file($path){
		if(file_exists($path)){ 
			return require_once $path;
		}
		else{
			return false;
		}
	}
}

// AMP endpoint Verifier
function ampforwp_is_amp_endpoint() {
	if ( (function_exists('ampforwp_is_non_amp') && ampforwp_is_non_amp()) && ! is_admin()) {
		return apply_filters('ampforwp_is_amp_endpoint_takeover', ampforwp_is_non_amp() );
	}
	else {
		return apply_filters('ampforwp_is_amp_endpoint', false !== ampforwp_get_query_var( 'amp', false ) );
	}
}
/* 
* Customizing get_query_var to fix fatal error logs get() on null 
* when ampforwp_is_amp_endpoint() function is used by third party plugin
* [Fatal error with Nitropack #5427] 
*/
function ampforwp_get_query_var( $var, $default = '' ) {
	global $wp_query;
	if( ! isset( $wp_query ) || ! method_exists( $wp_query, 'get' ) ) return $default;
	return $wp_query->get( $var, $default );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( ! class_exists( 'Ampforwp_Init', false ) ) {
	class Ampforwp_Init {

		public function __construct(){

			require AMPFORWP_PLUGIN_DIR .'/includes/features/functions.php';
			// Load Files required for the plugin to run
			if( function_exists('amp_activate') ){
				require_once AMPFORWP_PLUGIN_DIR."includes/features/amp_bridge.php";
			}
			else{
				require AMPFORWP_PLUGIN_DIR .'/includes/includes.php';
				// Redirection Code added
				require AMPFORWP_PLUGIN_DIR.'/includes/redirect.php';

				require AMPFORWP_PLUGIN_DIR .'/classes/class-init.php';
				new Ampforwp_Loader();
				
			}
			//Other Features
			require_once AMPFORWP_PLUGIN_DIR."includes/features/advertisement/ads-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/advertisement/mgid-ads-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/performance/performance-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/analytics/analytics-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/structure-data/structured-data-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/notice-bar/notice-bar-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/push-notification/push-notification-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/mb-helper-function.php";
			
		}
	}
}
/*
 * Start the plugin.
 * Gentlemen start your engines
 */
function ampforwp_plugin_init() {
	
	if ( defined( 'AMPFORWP__FILE__' ) && defined('AMPFORWP_PLUGIN_DIR') ) {
		new Ampforwp_Init();
	}
}
add_action('init','ampforwp_plugin_init', 9);

/*
* customized output widget
* to be used be used in before or after Loop
*/
ampforwp_require_file( AMPFORWP_PLUGIN_DIR.'/templates/woo-widget.php' );
ampforwp_require_file( AMPFORWP_PLUGIN_DIR.'/templates/amp-code-widget.php' );

/*
* 	Including core AMP plugin files and removing any other things if necessary
*/
function ampforwp_bundle_core_amp_files(){
	// Bundling Default plugin
	require_once AMPFORWP_PLUGIN_DIR .'/includes/vendor/amp/amp.php';
	ampforwp_require_file( AMPFORWP_PLUGIN_DIR .'/templates/template-mode/template-mode.php' );

	define( 'AMPFORWP__FILE__', __FILE__ );
	if ( ! defined('AMP__VENDOR__DIR__') ) {
		define( 'AMP__VENDOR__DIR__', plugin_dir_path(__FILE__) . 'includes/vendor/amp/' );
	}
	if ( ! defined('AMP_QUERY_VAR') ){
		define('AMP_QUERY_VAR', 'amp');
	}
	define( 'AMP__VENDOR__VERSION', '0.4.2' );
	require_once( AMP__VENDOR__DIR__ . '/back-compat/back-compat.php' );
	require_once( AMP__VENDOR__DIR__ . '/includes/amp-helper-functions.php' );
	require_once( AMP__VENDOR__DIR__ . '/includes/admin/functions.php' );
	require_once( AMP__VENDOR__DIR__ . '/includes/settings/class-amp-customizer-settings.php' );
	require_once( AMP__VENDOR__DIR__ . '/includes/settings/class-amp-customizer-design-settings.php' );
	// Widgets
	require_once ( AMP__VENDOR__DIR__ . '/includes/widgets/class-amp-widget-categories.php' );
	require_once ( AMP__VENDOR__DIR__ . '/includes/widgets/class-amp-widget-archives.php' );
	require_once ( AMP__VENDOR__DIR__ . '/includes/widgets/class-amp-widget-media-video.php' );
	require_once ( AMP__VENDOR__DIR__ . '/includes/widgets/class-amp-widget-recent-comments.php' );
	require_once ( AMP__VENDOR__DIR__ . '/includes/widgets/class-amp-widget-text.php' );
	//Removed JNews AMP Extender #3526
	if ( function_exists( 'jnews_get_option' ) ){
		remove_action( 'plugins_loaded', 'jnews_amp' );
		remove_filter( 'amp_content_sanitizers', 'jnews_amp_content_sanitize');
	}
	if (function_exists('wpda_hb_pro__plugins_loaded')) {
		$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH),'/' );
    	if( function_exists('ampforwp_is_amp_inURL') && ampforwp_is_amp_inURL($url_path)) {
			remove_action('plugins_loaded', 'wpda_hb_pro__plugins_loaded');
		}
	}
} 
add_action('plugins_loaded','ampforwp_bundle_core_amp_files', 8);

if ( ! function_exists('ampforwp_init') ) {
	add_action( 'init', 'ampforwp_init' );
	function ampforwp_init() {
		if ( false === apply_filters( 'amp_is_enabled', true ) ) {
			return;
		}
		if( ! defined('AMP_QUERY_VAR')){
			define( 'AMP_QUERY_VAR', apply_filters( 'amp_query_var', 'amp' ) );
		}

		if ( ! defined('AMP__VENDOR__DIR__') ) {
			define( 'AMP__VENDOR__DIR__', plugin_dir_path(__FILE__) . 'includes/vendor/amp/' );
		}

		do_action( 'amp_init' );

		load_plugin_textdomain( 'accelerated-mobile-pages', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		
		// Adding rewrite rules only when we are in standard mode
		if (!is_amp_plugin_active()) {
		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
		}
		add_post_type_support( 'post', AMP_QUERY_VAR );

		add_filter( 'request', 'AMPforWP\\AMPVendor\\amp_force_query_var_value' );
		add_action( 'wp', 'AMPforWP\\AMPVendor\\amp_maybe_add_actions');

		// Redirect the old url of amp page to the updated url. #1033 (Vendor Update)
		add_filter( 'old_slug_redirect_url', 'ampforwp_redirect_old_slug_to_new_url' );

		if ( class_exists( 'Jetpack' ) && ! (defined( 'IS_WPCOM' ) && IS_WPCOM) && ( defined('JETPACK__VERSION') && JETPACK__VERSION < 6.9 ) ) {
			require_once( AMP__VENDOR__DIR__ . '/jetpack-helper.php' );
		}
		// AMP by Automattic Compatibility #2287
		// Remove the FrontPage query added by AMP to make our FrontPage/Homepage works
		if ( function_exists('amp_activate') ) {
			remove_action( 'parse_query', 'amp_correct_query_when_is_front_page' );
			remove_action( 'wp', 'amp_maybe_add_actions' );
		}
	}
}


function amp_update_db_check() {
	global $redux_builder_amp;
	$ampforwp_current_version = AMPFORWP_VERSION;
	if ( isset( $_GET['ampforwp-dismiss-theme'] ) && trim( $_GET['ampforwp-dismiss-theme']) === "ampforwp_dismiss_admin_notices" && wp_verify_nonce($_GET['ampforwp_notice'], 'ampforwp_notice') ) {
		update_option( 'ampforwp_theme_notice', true );
		wp_redirect("admin.php?page=amp_options");
	}
   	if ( get_option( 'AMPforwp_db_version' ) !== $ampforwp_current_version ) {

   		if ( isset( $_GET['ampforwp-dismiss'] ) && trim( $_GET['ampforwp-dismiss']) === "ampforwp_dismiss_admin_notices" && wp_verify_nonce($_GET['ampforwp_notice'], 'ampforwp_notice') ) {
			update_option( 'AMPforwp_db_version', $ampforwp_current_version );
			wp_redirect(remove_query_arg('ampforwp-dismiss'), 301);
		}
    }
}


// Admin notice for AMP WordPress Theme
function ampforwp_ampwptheme_notice() {
 	$theme = '';
	$theme = wp_get_theme(); // gets the current theme

	if ( ('AMP WordPress Theme' == $theme->name || 'AMP WordPress Theme' == $theme->parent_theme) && true != get_option('ampforwp_theme_notice') ) {    
		add_thickbox(); ?>
		<div id="some" class="notice-warning settings-error notice is-dismissible">
			<span style="margin: 0.5em 0.5em 0 0"><?php echo esc_html__('AMP WordPress Theme is installed', 'accelerated-mobile-pages'); ?></span><br>
			<span style="margin: 0.5em 0.5em 0 0"><?php echo esc_html__('One Last Step Required:', 'accelerated-mobile-pages'); ?> <a href="#TB_inline?width=600&height=550&inlineId=my-content-id" class="thickbox"><?php echo esc_html__('Finish Setup', 'accelerated-mobile-pages') ?></a></span><br>
		</div>
		<div id="my-content-id" style="display:none;">
	     <p>
	     	<iframe width="100%" height="480" src="https://www.youtube.com/embed/" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'ampforwp-dismiss-theme', 'ampforwp_dismiss_admin_notices' ), 'ampforwp_notice', 'ampforwp_notice' ) ) ?>"><?php echo esc_html__('Take me to the Options Panel', 'accelerated-mobile-pages'); ?></a>
	     </p>
		</div>
	<?php }
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	$amp_plugin_manager_version = array();

	$plugin_manager_active = is_plugin_active('amp-plugin-manager/ampforwp-3rd-party-plugin-creator.php'); 
	$amp_plugin_manager_active = is_plugin_active('plugin-manager/ampforwp-3rd-party-plugin-creator.php');

	if ( $plugin_manager_active) {
		$amp_plugin_manager = get_plugin_data(AMPFORWP_MAIN_PLUGIN_DIR.'/amp-plugin-manager/ampforwp-3rd-party-plugin-creator.php');
		$amp_plugin_manager_version = $amp_plugin_manager['Version'];
	}
	if ( $amp_plugin_manager_active) {
		$plugin_manager = get_plugin_data(AMPFORWP_MAIN_PLUGIN_DIR.'/plugin-manager/ampforwp-3rd-party-plugin-creator.php');
		$amp_plugin_manager_version =  $plugin_manager['Version'];
	}

	if ( $plugin_manager_active || $amp_plugin_manager_active ) {
		$screen = get_current_screen();
		if ( '1.0' == $amp_plugin_manager_version  && 'plugins' === $screen->base) { ?>
			<div id="ampforwp_pluginmanager" class="notice-warning settings-error notice is-dismissible"><p><b><?php echo esc_html__(' Attention','accelerated-mobile-pages'); ?>:</b> <?php echo esc_html__(' AMPforWP Plugin Manager requires an upgrade. Please','accelerated-mobile-pages'); ?> <b><a href="https://ampforwp.com/plugins-manager/?update=plugins-manager#utm_source=plugin-page&utm_medium=plugin-manager-update&utm_campaign=update-notice" target="_blank"><?php echo esc_html__('Download &amp; install the latest version', 'accelerated-mobile-pages'); ?></a></b> <?php echo esc_html__('for free','accelerated-mobile-pages'); ?>.
				</p>
			</div>
		<?php }
	}
}
if ( ! defined('AMP_FRAMEWORK_COMOPNENT_DIR_PATH') ) {
	define('AMP_FRAMEWORK_COMOPNENT_DIR_PATH', AMPFORWP_PLUGIN_DIR ."/components"); 
}
require_once( AMP_FRAMEWORK_COMOPNENT_DIR_PATH . '/components-core.php' );
require ( AMPFORWP_PLUGIN_DIR.'/install/index.php' );
if ( !function_exists('amp_activate') ) {
	require_once(  AMPFORWP_PLUGIN_DIR. 'base_remover/base_remover.php' );
	require_once(  AMPFORWP_PLUGIN_DIR. 'includes/thirdparty-compatibility.php' );
	$enablePb = false;
	if(is_admin()){
		global $pagenow;
		if( is_multisite() ){
		$current_url = $_SERVER['REQUEST_URI'];
		$post_old = preg_match('/post\.php/', $current_url);
		$post_new = preg_match('/post-new\.php/', $current_url);
			if($post_old || $post_new){ 
				$enablePb = true;
			}
		}elseif( ('post.php' || 'post-new.php') == $pagenow ) {
			$enablePb = true;
		}
		if (defined('DOING_AJAX') && DOING_AJAX) {
			$enablePb = true;
		}
	}else{
		$enablePb = true;
	}
	if ($enablePb && ampforwp_get_setting('ampforwp-pagebuilder')== true ){	
		require_once(  AMPFORWP_PLUGIN_DIR. 'pagebuilder/amp-page-builder.php');
	} 
}
if(is_admin()){
	require_once(  AMPFORWP_PLUGIN_DIR. 'includes/modules-upgrade.php' );
	add_action( "redux/options/redux_builder_amp/saved", 'ampforwp_update_data_when_saved', 10, 2 );
	add_action( "redux/options/redux_builder_amp/reset", 'ampforwp_update_data_when_reset' );
	add_action( "redux/options/redux_builder_amp/section/reset", 'ampforwp_update_data_when_reset' );
	add_action( "redux/options/redux_builder_amp/saved", 'ampforwp_save_local_font', 10, 2 );
}

/**
 * Redirects the old AMP URL to the new AMP URL.
 * If post slug is updated the amp page with old post slug will be redirected to the updated url.
 *
 * @param  string $link New URL of the post.
 *
 * @return string $link URL to be redirected.
 */
 if ( ! function_exists( 'ampforwp_redirect_old_slug_to_new_url' ) ) {
	function ampforwp_redirect_old_slug_to_new_url( $link ) {

		if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
			$link = trailingslashit( trailingslashit( $link ) . AMPFORWP_AMP_QUERY_VAR );
		}

		return $link;
	}
}

// Hide Post Builder if Swift is enabled
add_filter('amp_customizer_is_enabled', 'ampforwp_customizer_is_enabled');
if ( ! function_exists('ampforwp_customizer_is_enabled') ) {
	function ampforwp_customizer_is_enabled($value){
		global $redux_builder_amp;
		if ( 4 == ampforwp_get_setting('amp-design-selector') && ! function_exists('amp_activate') ) {
			$value = false;
		}
		return $value;
	}
}

// Get Settings from Redux #2177 & #2911
function ampforwp_get_setting( $opt_name='', $child_option='', $sanitize_method='' ){
	global $redux_builder_amp;
	if (is_plugin_active('amp/amp.php')) {
		unset($redux_builder_amp['ampforwp-seo-selection']);
	}
	if(empty($redux_builder_amp)){
		$redux_builder_amp =  (array) get_option('redux_builder_amp');
	}
	$opt_value = '';
	if ( isset($redux_builder_amp[$opt_name]) ) {
		$opt_value = $redux_builder_amp[$opt_name];
		if ( '' !== $child_option && isset($redux_builder_amp[$opt_name][$child_option]) ){
			$opt_value = $redux_builder_amp[$opt_name][$child_option];
		}
	}
	if ( '' !== $sanitize_method && function_exists($sanitize_method) ){
		return $sanitize_method($opt_value);
	}
	return $opt_value;
}

// Setup funtion
if(!function_exists('ampforwp_get_setup_info')){
	function ampforwp_get_setup_info($ux_option=''){
		$ux_content = "";
		if($ux_option=="ampforwp-ux-website-type-section"){
			$ux_content = ampforwp_get_setting('ampforwp-setup-ux-website-type');
			if(ampforwp_get_setting('ampforwp-sd-type-posts') && preg_match("/Other/", $ux_content)==0 && $ux_content!=="Local Business"){
				$ux_content = ampforwp_get_setting('ampforwp-sd-type-posts');
			}else{
				$ux_content = ampforwp_get_setting('ampforwp-setup-ux-website-type');
			}
			if($ux_content=="NewsArticle" || $ux_content=="News"){
				$ux_content="News";
			}else if($ux_content=="BlogPosting" || $ux_content=="Blog" || $ux_content==""){
				$ux_content="Blog";
			}else if($ux_content=="Product"){
				$ux_content="Ecommerce";
			}
			if(preg_match("/Other/", $ux_content)!=0){
				$other = explode("-", $ux_content);
				if(isset($other[1])){
					$ux_content=$other[1];
				}else{
					$ux_content="WebPage";
				}
			}
			
		}else if($ux_option=="ampforwp-ux-need-type-section"){
			$home   = ampforwp_get_setting('ampforwp-homepage-on-off-support');
            $posts  = ampforwp_get_setting('amp-on-off-for-all-posts');
            $pages  = ampforwp_get_setting('amp-on-off-for-all-pages');
            $archive = ampforwp_get_setting('ampforwp-archive-support');
            $ntype_arr = array();
            if($home==1){$ntype_arr[] = "Home";}
            if($posts==1){$ntype_arr[] = "Posts";}
            if($pages==1){$ntype_arr[] = "Pages";}
            if($archive==1){$ntype_arr[] = "Archive";}
            $ux_content = implode(", ", $ntype_arr);
		}else if($ux_option=="ampforwp-ux-design-section"){
            $ux_content = ampforwp_get_setting('opt-media','url');
		}else if($ux_option=="ampforwp-ux-analytics-section"){
            $ga_field       = ampforwp_get_setting('ga-feild');
            $ga_field_gtm     = ampforwp_get_setting('amp-gtm-id');
            $amp_fb_pixel_id = ampforwp_get_setting('amp-fb-pixel-id');
            $sa_feild = ampforwp_get_setting('sa-feild');
            $pa_feild = ampforwp_get_setting('pa-feild');
            $quantcast_c = ampforwp_get_setting('amp-quantcast-analytics-code');
            $comscore_c1 = ampforwp_get_setting('amp-comscore-analytics-code-c1');
            $comscore_c1 = ampforwp_get_setting('amp-comscore-analytics-code-c2');
            $eam_c = ampforwp_get_setting('eam-feild');
            $sc_c = ampforwp_get_setting('sc-feild');
            $histats_c = ampforwp_get_setting('histats-field');
            $yemdex_c = ampforwp_get_setting('amp-Yandex-Metrika-analytics-code');
            $chartbeat_c = ampforwp_get_setting('amp-Chartbeat-analytics-code');
            $alexa_c = ampforwp_get_setting('ampforwp-alexa-account');
            $alexa_d = ampforwp_get_setting('ampforwp-alexa-domain');
            $afs_c = ampforwp_get_setting('ampforwp-afs-siteid');
            $clicky_side_id = ampforwp_get_setting('clicky-site-id');
           	$cr_config_url = ampforwp_get_setting('ampforwp-callrail-config-url');
           	$cr_number = ampforwp_get_setting('ampforwp-callrail-number');
           	$cr_analytics_url = ampforwp_get_setting('ampforwp-callrail-analytics-url');
            $analytics_txt = "";
            $analytic_arr = array();
			$host = ampforwp_get_setting('ampforwp-adobe-host');
			$ReportSuiteId = ampforwp_get_setting('ampforwp-adobe-reportsuiteid');
            if(ampforwp_get_setting('ampforwp-ga-switch') && $ga_field!="UA-XXXXX-Y" && $ga_field!=""){$analytic_arr[]="Google Analytics";}
            if(ampforwp_get_setting('amp-use-gtm-option') && $ga_field_gtm!="" && $ga_field_gtm!=""){$analytic_arr[]="Google Tag Manager";}
            if(ampforwp_get_setting('amp-fb-pixel') && $amp_fb_pixel_id!=""){$analytic_arr[]="Facebook Pixel";}
           if(ampforwp_get_setting('ampforwp-Segment-switch') && $sa_feild!="SEGMENT-WRITE-KEY" && $sa_feild!=""){$analytic_arr[]="Segment Analytics";}
            if(ampforwp_get_setting('ampforwp-Piwik-switch') && $pa_feild!="#" && $pa_feild!=""){ $analytic_arr[]="Matomo Analytics";}
            if(ampforwp_get_setting('ampforwp-Quantcast-switch') && $quantcast_c!=""){ $analytic_arr[]="Quantcast Measurement";}
            if(ampforwp_get_setting('ampforwp-comScore-switch') && $comscore_c1!="" && $comscore_c1!=""){$analytic_arr[]="comScore";}
            if(ampforwp_get_setting('ampforwp-Effective-switch') && $eam_c!="#" && $eam_c!=""){$analytic_arr[]="Effective Measure";}
            if(ampforwp_get_setting('ampforwp-StatCounter-switch') && $sc_c!="#" && $sc_c!=""){$analytic_arr[]="StatCounter";}
            if(ampforwp_get_setting('ampforwp-Histats-switch') && $histats_c!=""){$analytic_arr[]="Histats Analytics";}
            if(ampforwp_get_setting('ampforwp-Yandex-switch') && $yemdex_c!=""){$analytic_arr[]="Yandex Metrika";}
            if(ampforwp_get_setting('ampforwp-Chartbeat-switch') && $chartbeat_c!=""){$analytic_arr[]="Chartbeat Analytics";}
            if(ampforwp_get_setting('ampforwp-Alexa-switch') && $alexa_c!="" && $alexa_d!=""){$analytic_arr[]="Alexa Metrics";}
			if(ampforwp_get_setting('ampforwp-adobe-switch') && $host!=="" && $ReportSuiteId!=""){$analytic_arr[]="Adobe Analytics";}
            if(ampforwp_get_setting('ampforwp-afs-analytics-switch') && $afs_c!=""){$analytic_arr[]="AFS Analytics";}
            if(ampforwp_get_setting('amp-clicky-switch') && $clicky_side_id!=""){$analytic_arr[]="Clicky Analytics";}
            if(ampforwp_get_setting('ampforwp-callrail-switch') && $cr_config_url!="" && $cr_number!="" && $cr_analytics_url!=""){$analytic_arr[]="Call Rail Analytics";}
            $ux_content = implode(", ", $analytic_arr);
        }else if($ux_option=="ampforwp-ux-privacy-section"){
			$ux_cookie_enable = ampforwp_get_setting('amp-enable-notifications');
			$ux_compiance_switch = ampforwp_get_setting('amp-gdpr-compliance-switch');
			$policy_arr = array();
			if($ux_cookie_enable){
				$policy_arr[] = "Cookie Consent";
			}
			if($ux_compiance_switch){
				$policy_arr[] = "GDPR";
			}
			$ux_content = implode(", ", $policy_arr);
		}else if($ux_option=="ampforwp_ux_extension_check"){
			include_once( ABSPATH . 'wp-admin/includes/plugin.php');
			$ux_content = array();
			if(defined('WPCF7_VERSION')){
				$ux_content[] = 'contact_form_7';
			}
			if(class_exists('Ninja_Forms')){
				$ux_content[] = 'ninja_forms';
			}
			if(function_exists('caldera_forms_fallback_shortcode')){
				$ux_content[] = 'caldera_forms';
			}
			if(function_exists('wpforms')){
				$ux_content[] = 'wpforms';
			}
			if(function_exists('WC')){
				$ux_content[] = 'woocommerce';
			}
			if(class_exists('Easy_Digital_Downloads')){
				$ux_content[] = 'easy_digital_downloads';
			}
			if(defined('POLYLANG_BASENAME')){
				$ux_content[] = 'polylang';
			}
			if(class_exists('bbPress')){
				$ux_content[] = 'bbpress';
			}
			if(function_exists('activate_shortcodes_ultimate')){
				$ux_content[] = 'shortcodes';
			}
			if(class_exists('toc')){
				$ux_content[] = 'toc';
			}
			if(class_exists('WPCOM_Liveblog')){
				$ux_content[] = 'liveblog';
			}
			if(defined('TRIBE_EVENTS_FILE')){
				$ux_content[] = 'eventcalendar';
			}
			if(function_exists('run_wp_recipe_maker') || function_exists('yasr_fs') || function_exists('wp_review_constants') || function_exists('postratings_init') || class_exists('WPCustomerReviews3') || defined('KKSR_PLUGIN') || function_exists('taqyeem_init') || class_exists('Multi_Rating')){
				$ux_content[] = 'ratings';
			}
			if(class_exists('GFForms')){
				$ux_content[] = 'gravityform';
			}
			if(function_exists('cp_display_version_warning')){
				$ux_content[] = 'classipress';
			}
			if(function_exists('elementor_load_plugin_textdomain') || function_exists('et_divi_theme_body_class')){
				if(function_exists('elementor_load_plugin_textdomain')){
					$ux_content[] = 'Elementor';
				}else if(function_exists('et_divi_theme_body_class')){
					$ux_content[] = 'Divi';
				}
			}
			if(function_exists('wpml_upgrade')){
				$ux_content[] = 'wpml';
			}
		}
		return $ux_content;
	}
}
// Register widgets
add_action('amp_init', 'ampforwp_widgets');
function ampforwp_widgets(){
	add_action( 'widgets_init', 'ampforwp_register_widgets' );
}
function ampforwp_register_widgets() {
	global $wp_widget_factory;
	foreach ( $wp_widget_factory->widgets as $registered_widget ) {
		$registered_widget_class_name = get_class( $registered_widget );
		if ( ! preg_match( '/^WP_Widget_(.+)$/', $registered_widget_class_name, $matches ) ) {
			continue;
		}
		$amp_class_name = 'AMP_Widget_' . $matches[1];
		if ( ! class_exists( $amp_class_name ) || is_a( $amp_class_name, $registered_widget_class_name ) ) {
			continue;
		}

		unregister_widget( $registered_widget_class_name );
		register_widget( $amp_class_name );
	}
}
// Post Types
function ampforwp_get_all_post_types(){
    global $redux_builder_amp;
    $post_types          = array();
    $selected_post_types = array();

    if( ampforwp_get_setting('amp-on-off-for-all-posts') ){
    		$post_types['post'] = 'post';
    }
    if( ampforwp_get_setting('amp-on-off-for-all-pages') ){
    	$post_types['page'] = 'page';
    }
    if( ampforwp_get_setting('ampforwp-archive-support') && ampforwp_get_setting('ampforwp-archive-support-cat') ){
    	$post_types['category'] = 'category';
    }
    if( ampforwp_get_setting('ampforwp-archive-support') && ampforwp_get_setting('ampforwp-archive-support-tag')){
    	$post_types['tag'] = 'post_tag';
    }
    $custom_taxonomies = ampforwp_get_setting('ampforwp-custom-taxonomies');
	if(ampforwp_get_setting('ampforwp-archive-support') && !empty($custom_taxonomies) ){
		foreach($custom_taxonomies as $taxonomy){
			$terms = get_taxonomy( $taxonomy );
			$taxonomy_name = ( isset($terms->name) ? $terms->name : '' );
			if( isset($terms->name) && !empty($terms->name)){
				$post_types[$terms->name] = $terms->name;
			}
		}
	}
	 
   	if ( ampforwp_get_setting('ampforwp-custom-type')) {
        foreach (ampforwp_get_setting('ampforwp-custom-type') as $key) {
            $selected_post_types[$key] = $key;
        }
        $post_types = array_merge($post_types, $selected_post_types);
    }
    if(class_exists('WPUltimateRecipe') && function_exists('ampforwp_is_home') && ampforwp_is_home()){
	    	$post_types['recipe'] = 'recipe';
	}
    return $post_types;
}

// is_search_enabled_in_ampforwp function ( Design 1,2 and 3 ) #2681
if( !function_exists( 'is_search_enabled_in_ampforwp' ) ) {
	function is_search_enabled_in_ampforwp() {
		if( ( ampforwp_get_setting('amp-design-selector')==1 && ampforwp_get_setting('amp-design-1-search-feature') ) ||
	 			(	ampforwp_get_setting('amp-design-selector')==2 && ampforwp_get_setting('amp-design-2-search-feature') ) ||
				(	ampforwp_get_setting('amp-design-selector')==3 && ampforwp_get_setting('amp-design-3-search-feature') ) ) {
					return true;
				}
			return false;
	}
}
// Fallback for Redux class #2377
add_action('after_setup_theme', 'ampforwp_redux_class' );
function ampforwp_redux_class(){	
	if ( !class_exists('Redux') && class_exists('ReduxCore\\ReduxFramework\\Redux') && !class_exists('QuadMenu') && !function_exists('volcanno_plugins_loaded')) {
		class Redux extends ReduxCore\ReduxFramework\Redux
		{
			# Do nothing, it will inherit all the methods
		}
	}
}
add_filter('plugin_row_meta' , 'ampforwp_add_plugin_meta_links', 10, 2);
if ( ! function_exists('ampforwp_add_plugin_meta_links') ) {
function ampforwp_add_plugin_meta_links($meta_fields, $file) {
    if ( plugin_basename(__FILE__) == $file ) {
      $plugin_url = "https://wordpress.org/support/plugin/accelerated-mobile-pages/reviews/?rate=5#new-post";
      $meta_fields[] = "<a href='" . esc_url($plugin_url) ."' target='_blank' title='" . esc_html__('Rate', 'accelerated-mobile-pages') . "'>
            <i class='ampforwp-rate-stars'>"
        . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
        . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
        . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
        . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
        . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
        . "</i></a>";      
       
    }

    return $meta_fields;
  }
}
// AMPforWP Global Data variable
$ampforwp_data = array();

if(!function_exists('sanitize_hex_color')){
	function sanitize_hex_color( $color ) {
	    if ( '' === $color ) {
	        return '';
	    }

	    // 3 or 6 hex digits, or the empty string.
	    if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
	        return $color;
	    }
	}
}
// color sanitizer
function ampforwp_sanitize_color( $color ) {
    if ( empty( $color ) || is_array( $color ) )
        return 'rgba(0,0,0,0)';
    // If string does not start with 'rgba', then treat as hex
    // sanitize the hex color and finally convert hex to rgba
    if ( false === strpos( $color, 'rgba' ) ) {
        return sanitize_hex_color( $color );
    }
    // By now we know the string is formatted as an rgba color so we need to further sanitize it.
    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}

// AMP Plugins Manager compatibility #2976
if ( false == get_transient('ampforwp-pm-disabler') ) {
	$ampforwp_active_plugins = array_flip(get_option('active_plugins'));
	if (isset($ampforwp_active_plugins['amp-plugin-manager/ampforwp-3rd-party-plugin-creator.php'] ) ){
		$plugin_data = get_plugin_data(AMPFORWP_MAIN_PLUGIN_DIR . 'amp-plugin-manager/ampforwp-3rd-party-plugin-creator.php' );
		if ( version_compare( floatval( $plugin_data['Version'] ), '1.1', '<' ) ){
			unset($ampforwp_active_plugins['amp-plugin-manager/ampforwp-3rd-party-plugin-creator.php']);
			update_option('active_plugins', array_flip($ampforwp_active_plugins));
			set_transient('ampforwp-pm-disabler', true);
			include_once( ABSPATH . 'wp-includes/pluggable.php' );
			wp_redirect(admin_url('plugins.php'));
		}
	}
	elseif(isset($ampforwp_active_plugins['amp-plugin-manager-master/ampforwp-3rd-party-plugin-creator.php'] )){
		$plugin_data = get_plugin_data(AMPFORWP_MAIN_PLUGIN_DIR . 'amp-plugin-manager-master/ampforwp-3rd-party-plugin-creator.php' );
		if ( version_compare( floatval( $plugin_data['Version'] ), '1.1', '<' ) ){
			unset($ampforwp_active_plugins['amp-plugin-manager-master/ampforwp-3rd-party-plugin-creator.php']);
			update_option('active_plugins', array_flip($ampforwp_active_plugins));
			set_transient('ampforwp-pm-disabler', true);
			include_once( ABSPATH . 'wp-includes/pluggable.php' );
			wp_redirect(admin_url('plugins.php'));
		}
	}

}
function ampforwp_plugins_manager_notice(){
	if ( true == get_transient('ampforwp-pm-disabler') ) { ?>
		<div id="ampforwp_pluginmanager" class="notice-warning settings-error notice is-dismissible"><p><b><?php echo esc_html__('Attention: ','accelerated-mobile-pages');?></b><?php echo esc_html__('AMPforWP Plugin Manager has been deactivated and requires an upgrade. Please','accelerated-mobile-pages');?> <b><a target="_blank" href=<?php echo esc_url('https://ampforwp.com/plugins-manager/?update=plugins-manager#utm_source=plugin-page&utm_medium=plugin-manager-update&utm_campaign=update-notice');?>><?php echo esc_html__('Download &amp; install the latest version','accelerated-mobile-pages');?></a></b><?php echo esc_html__(' for free.','accelerated-mobile-pages');?>
				</p>
			</div>
	<?php 
	}
}
add_action( 'activate_plugin', 'ampforwp_delete_plugins_manager_transient' );
function ampforwp_delete_plugins_manager_transient($plugin){
	if ( strpos($plugin, 'ampforwp-3rd-party-plugin-creator.php') || strpos($plugin, 'accelerated-moblie-pages.php') ) {
		delete_transient( 'ampforwp-pm-disabler' );
	}
}
// Infinite scroll/ amp-next-page #2244
add_action('pre_amp_render_post', 'ampforwp_initialise_classes');
if ( ! function_exists('ampforwp_initialise_classes') ) {
	function ampforwp_initialise_classes(){
		if ( true == ampforwp_get_setting('ampforwp-infinite-scroll') || true == ampforwp_get_setting('ampforwp-wcp-infinite-scroll') ) {
			require AMPFORWP_PLUGIN_DIR .'/classes/class-ampforwp-infinite-scroll.php';
		}
	}
}

// Data Consent
function ampforwp_get_data_consent(){
	global $redux_builder_amp;
	$dboc = false;
	$is_dboc = '';
	if(isset($redux_builder_amp['amp-gdpr-compliance-switch']) && $redux_builder_amp['amp-gdpr-compliance-switch'] ){
		
				$dboc = true;
	}
	return $dboc;
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

function ampforwp_amp_consent_check($attrs){

	if( ampforwp_get_data_consent() ){
		$attrs['data-block-on-consent'] = '';
	}
	$attrs = apply_filters( 'ampforwp_embedd_attrs_handler', $attrs );
	return $attrs;
}

// Fallback for Class AMP_Content sanitizer #2287
add_action('pre_amp_render_post', 'ampforwp_vendor_amp_fallbacks');
function ampforwp_vendor_amp_fallbacks(){
	if ( ! class_exists('AMP_Content') ) {
		class AMP_Content extends AMPforWP\AMPVendor\AMP_Content{}
	}
}
// Class AMP_Blacklist_Sanitizer #2287
add_action('plugins_loaded', 'ampforwp_sanitizers_loader');
function ampforwp_sanitizers_loader(){
	if ( ! class_exists('AMP_Blacklist_Sanitizer') ) {
		if(defined('AMP__VENDOR__DIR__')){
			$amp_blacklist_sanitizer =  realpath( AMP__VENDOR__DIR__ . 'includes/sanitizers/class-amp-blacklist-sanitizer.php') ;
			require_once $amp_blacklist_sanitizer;
			class AMP_Blacklist_Sanitizer extends AMPforWP\AMPVendor\AMP_Blacklist_Sanitizer{}
		} 
	}
}
// is_amp_endpoint Fallback #2287 #3055
add_action('widgets_init','ampforwp_vendor_is_amp_endpoint'); 
function ampforwp_vendor_is_amp_endpoint(){
	global $pagenow;
	if ( ! function_exists('amp_activate') && ! function_exists('is_amp_endpoint' ) && 'plugins.php' !== $pagenow ) {
		function is_amp_endpoint(){
			if(true == ampforwp_get_setting('ampforwp-amp-takeover')){
				return true;
			}
			return false !== get_query_var( AMP_QUERY_VAR, false );
		}
	}
}

// ampforwp_exclude_posts function #3118
if ( ! function_exists('ampforwp_exclude_posts') ) {
	function ampforwp_exclude_posts(){
		$exclude_post_values = array();
		$ampforwp_exclude_post_transient = get_transient('ampforwp_exclude_post_transient');
		if ( false != $ampforwp_exclude_post_transient ) {
			$exclude_post_values = $ampforwp_exclude_post_transient;
		}
		else{
			$ampforwp_exclude_post = get_option('ampforwp_exclude_post');
			if ( false != $ampforwp_exclude_post ) {
				$exclude_post_values = $ampforwp_exclude_post;
				set_transient('ampforwp_exclude_post_transient', $exclude_post_values);
			}
		}
		return $exclude_post_values;
	}
}

// Redux Options Enabler #2939
add_filter( 'redux/options/redux_builder_amp/sections', 'ampforwp_redux_options_enabler',7,1 );
function ampforwp_redux_options_enabler($sections){
	$redux_enabled_options = array();
	// apply_filters to get the options to enable them
	$redux_enabled_options = apply_filters('ampforwp_options_enabler', $redux_enabled_options);
	if(is_array($redux_enabled_options) ) {
		foreach ($sections as $key => $section_value) {
	    	if(count($section_value['fields'])>0){
	    		foreach ($section_value['fields'] as $fieldkey => $field_value) { 
	    			if(isset($field_value['required']) && in_array($field_value['id'], $redux_enabled_options) ){
						unset($sections[$key]['fields'][$fieldkey]['required']);
	    			}
	    		}
	    	}
	    }
	}
    return $sections;
}

// Redux Options Remover #2939
add_filter( 'redux/options/redux_builder_amp/sections', 'ampforwp_redux_options_remover',7,1 );
function ampforwp_redux_options_remover($sections){
	$redux_enabled_options = array();
	// apply_filters to get the options to remove them
	$redux_enabled_options = apply_filters('ampforwp_options_remover', $redux_enabled_options);
	if(is_array($redux_enabled_options) ) {
		foreach ($sections as $key => $section_value) {
	    	if(count($section_value['fields'])>0){
	    		foreach ($section_value['fields'] as $fieldkey => $field_value) { 
	    			if(isset($field_value['required']) && in_array($field_value['id'], $redux_enabled_options) ){
						unset($sections[$key]['fields'][$fieldkey]);
	    			}
	    		}
	    	}
	    }
	}
    return $sections;
}

// AMP with AMPforWP notice #2287
function ampforwp_automattic_activation(){

	if ( function_exists('amp_activate') && get_transient( 'ampforwp_automattic_activation_notice' ) == false) { 
		$automattic_wizard_nonce = wp_create_nonce( "automattic_wizard_nonce" );?>
		<div id="ampforwp-automattic-notice" data-nonce="<?php echo esc_attr($automattic_wizard_nonce);?>"class="updated notice is-dismissible message notice notice-alt ampforwp-setup-notice"><p><?php 
			echo esc_html__('AMP By AMP Project Contributors Plugin is activated so AMPforWP is now in the "Addon Mode". ','accelerated-mobile-pages') ?><a href="https://ampforwp.com/tutorials/article/guide-to-amp-by-automattic-compatibility-in-ampforwp" target="_blank"><?php echo esc_html__('Learn More','accelerated-mobile-pages'); ?></a></p></div><?php 
	}
}

add_action('wp_ajax_ampforwp_automattic_notice_delete','ampforwp_automattic_notice_delete');
function ampforwp_automattic_notice_delete(){
	$automattic_wizard_nonce = $_REQUEST['security'];

	if ( wp_verify_nonce( $automattic_wizard_nonce, 'automattic_wizard_nonce' ) && current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {   
	  set_transient( 'ampforwp_automattic_activation_notice', 1 );
	}
	exit();
}

add_action('current_screen','ampforwp_replace_redux_comments');
function ampforwp_replace_redux_comments($screen){
	if(current_user_can( 'manage_options' )){
		if ( 'toplevel_page_amp_options' == $screen->base ) {
			$replaced_redux_comments = get_transient('replaced_redux_comments_updated');
			if(!$replaced_redux_comments){
			    $redux_val   = get_option('redux_builder_amp',array());  
			    if ( empty($redux_val) || ! is_array($redux_val)) {
					return;
			    }
			    $ga_val   	= $redux_val['ampforwp-ga-field-advance'];
			    if(preg_match('/\/\*(.*?)\*\//s', $ga_val)){
			    	$ga_val = preg_replace('/\/\*(.*?)\*\//s', '', $ga_val);
			    	$redux_val['ampforwp-ga-field-advance'] = $ga_val;
			    	update_option('redux_builder_amp',$redux_val);
			    }
			    if(preg_match('/\/\/Replace this with your Tracking ID/', $ga_val)){
			    	$ga_val = preg_replace('/\/\/Replace this with your Tracking ID/', '', $ga_val);
			    	$redux_val['ampforwp-ga-field-advance'] = $ga_val;
			    	update_option('redux_builder_amp',$redux_val);
			    }
			    // GA CLOSE
			      
				//FOR GTM
			    $gml_val   	= $redux_val['ampforwp-gtm-field-advance'];
			    if(preg_match('/\/\*(.*?)\*\//s', $gml_val)){
			    	$gml_val = preg_replace('/\/\*(.*?)\*\//s', '', $gml_val);
			    	$redux_val['ampforwp-gtm-field-advance'] = $gml_val;
			    	update_option('redux_builder_amp',$redux_val);
			    }
			    if(preg_match('/\/\/Replace this with your Tracking ID/', $gml_val)){
			    	$gml_val = preg_replace('/\/\/Replace this with your Tracking ID/', '', $gml_val);
			    	$redux_val['ampforwp-gtm-field-advance'] = $gml_val;
			    	update_option('redux_builder_amp',$redux_val);
			    }
			    // GLOBAL CSS EDITOR
			    $css_editor   	= $redux_val['css_editor'];
			    if(preg_match('/\/\*(.*?)\*\//s', $css_editor)){
			    	$css_editor = preg_replace('/\/\*(.*?)\*\//s', '', $css_editor);
			    	$redux_val['css_editor'] = $css_editor;
			    	update_option('redux_builder_amp',$redux_val);
			    }
			    set_transient('replaced_redux_comments_updated',1);
		 	}
		}
	}
}
if(!function_exists('ampforwp_wp_plugin_action_link')){
	function ampforwp_wp_plugin_action_link( $plugin, $action = 'activate' ) {
		if ( strpos( $plugin, '/' ) ) {
			$plugin = str_replace( '\/', '%2F', $plugin );
		}
		$url = sprintf( admin_url( 'plugins.php?action=' . $action . '&plugin=%s&plugin_status=all&paged=1&s' ), $plugin );
		$url = wp_nonce_url( $url, $action . '-plugin_' . $plugin );
		return $url;
	}
}
if(!function_exists('ampforwp_get_admin_current_page')){
	function ampforwp_get_admin_current_page(){
		$current_page = '';
		if(is_admin()){
			if(isset($_GET['page'])){
				$current_page = $_GET['page'];
			}
		}
		return $current_page;
	}
}
function ampforwp_update_data_when_saved($options, $changed_values) {
	if(!current_user_can( 'manage_options' )){
		return ;
	}
	$updatedDataForTransient = array(
		'hide-amp-categories2',
		'amp-design-3-category-selector',
		'ampforwp-homepage-loop-cats',
		'hide-amp-tags-bulk-option2',
		'amp-design-3-tag-selector'
	);
	ampforwp_delete_transient_on_update($changed_values);
	foreach ( $changed_values as $key => $value ) {
		if ( in_array( $key, $updatedDataForTransient ) ) {
			delete_transient( $key );
		}
	}
}

function ampforwp_update_data_when_reset($rest_object = '') {
	if(!current_user_can( 'manage_options' )){
		return ;
	}
	if ( isset( $rest_object->parent->transients ) ) {
		$updatedDataForTransient = array(
			'hide-amp-categories2',
			'amp-design-3-category-selector',
			'ampforwp-homepage-loop-cats',
			'hide-amp-tags-bulk-option2',
			'amp-design-3-tag-selector'
		);
		foreach ( $rest_object->parent->transients['changed_values'] as $key => $value ) {
			if ( in_array( $key, $updatedDataForTransient ) ) {
				delete_transient( $key );
			}
		}
	}
}

if(!function_exists('ampforwp_delete_transient_on_update')){
	function ampforwp_delete_transient_on_update($changed_values){
		if(!current_user_can( 'manage_options' )){
			return ;
		}
		$key_for_trans = array('ampforwp-custom-taxonomies');
		$del_trans_arr = array('ampforwp-custom-taxonomies'=>array('ampforwp_header_menu','ampforwp_footer_menu'));
		foreach($changed_values as $key => $value ){
			if(in_array($key,$key_for_trans)){
				$trans_arr = $del_trans_arr[$key];
				for($i=0;$i<count($trans_arr);$i++){
					delete_transient( $trans_arr[$i] );
				}
			}
		}
	}
}
if(!function_exists('ampforwp_save_local_font')){
	function ampforwp_save_local_font(){
		if(ampforwp_get_setting('ampforwp-local-font-switch') && ampforwp_get_setting('ampforwp-local-font-upload','url')!=""){
			$upload_dir = wp_upload_dir(); 
			$user_dirname = $upload_dir['basedir'] . '/' . 'ampforwp-local-fonts';
			if(!file_exists($user_dirname)) wp_mkdir_p($user_dirname);
			$font_url 	= ampforwp_get_setting('ampforwp-local-font-upload','url');
			$abs_path 	= explode("wp-content", $font_url);
			if(isset($abs_path[1])){
		        $permfile   = ABSPATH.'wp-content'.$abs_path[1];
		        $files = explode('/', $abs_path[1]);
		        $file_name = end($files);
		        $copy_to   = esc_attr($user_dirname).'/'.esc_attr($file_name);
		        if(!file_exists($copy_to)){
		        	$files = glob( $user_dirname . '/*' );
		            foreach ( $files as $file ) {
		                unlink( $file );
		            }
	            	copy($permfile, $copy_to);
		        	unzip_file($permfile, $user_dirname );
		        	$files = glob( $user_dirname . '/*' );
		            foreach ( $files as $file ) {
		            	if(is_dir($file)){
		            		rmdir($file);
		            	}
			            $fonts = explode("/", $file);
		               	$font_names = end($fonts);
						$ext = end(explode(".", $font_names));
						if($ext!='ttf' && $ext!='eot' && $ext!='svg'){
							unlink( $file );
						}
		            }
		        }
		    }
		}else if(ampforwp_get_setting('ampforwp-local-font-switch') && ampforwp_get_setting('ampforwp-local-font-upload','url')==""){
			$upload_dir   = wp_upload_dir();
	        $user_dirname = esc_attr($upload_dir['basedir']) . '/' . 'ampforwp-local-fonts';
	        if ( file_exists( $user_dirname ) ) {
	            $files = glob( $user_dirname . '/*' );
	            foreach ( $files as $file ) {
	                 unlink( $file );
	            }
	        }
		}
	}
}

add_action("amp_init", "ampforwp_amp_optimizer");
function ampforwp_amp_optimizer(){
	require_once AMPFORWP_PLUGIN_DIR."/includes/amp-optimizer-addon.php";
}

if(!function_exists('is_amp_plugin_active')){
	function is_amp_plugin_active()
	{
		if (!function_exists('is_plugin_active')) {
			include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		}

		if (is_plugin_active('amp/amp.php')) {
			return true;
		}
		return false;
	}

}