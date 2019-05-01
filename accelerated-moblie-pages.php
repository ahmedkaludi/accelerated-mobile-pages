<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP for WP - Accelerated Mobile Pages for WordPress
Version: 0.9.97.50.1
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
define('AMPFORWP_VERSION','0.9.97.50.1');
define('AMPFORWP_EXTENSION_DIR',plugin_dir_path(__FILE__).'includes/options/extensions');
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

// Add Custom Rewrite Rule to make sure pagination & redirection is working correctly
function ampforwp_add_custom_rewrite_rules() {
	global $redux_builder_amp, $wp_rewrite;
    // For Homepage
    add_rewrite_rule(
      'amp/?$',
      'index.php?amp',
      'top'
    );
	// For Homepage with Pagination
    add_rewrite_rule(
        'amp/'.$wp_rewrite->pagination_base.'/([0-9]{1,})/?$',
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
    $rewrite_category = get_option('category_base');
    if ( ! empty($rewrite_category) ) {
    	$rewrite_category = get_option('category_base');
    } else {
    	$rewrite_category = 'category';
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
	$permalink_structure = get_option('permalink_structure');
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
	$rewrite_tag = get_option('tag_base');
    if ( ! empty($rewrite_tag) ) {
    	$rewrite_tag = get_option('tag_base');
    } else {
    	$rewrite_tag = 'tag';
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
    // Rewrite rule for date archive with pagination #2289
  	add_rewrite_rule(
      '([0-9]{4})/([0-9]{1,2})/amp/'.$wp_rewrite->pagination_base.'/?([0-9]{1,})/?$',
      'index.php?year=$matches[1]&monthnum=$matches[2]&amp=1&paged=$matches[3]',
      'top'
    );
	//Rewrite rule for custom Taxonomies
	$args = array(
	  		'public'   => true,
	  		'_builtin' => false,  
	); 
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$taxonomies = get_taxonomies( $args, $output, $operator ); 

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  	if(!is_plugin_active('amp-woocommerce-pro/amp-woocommerce.php' )) {
		if( class_exists( 'WooCommerce' ) ) {
			$wc_permalinks 	= get_option( 'woocommerce_permalinks' );
			
			if ( $wc_permalinks ) {
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
				}
			}
		}
	$taxonomies = apply_filters( 'ampforwp_modify_rewrite_tax', $taxonomies );
	if ( $taxonomies ) {
		foreach ( $taxonomies  as $key => $taxonomy ) { 
			if ( ! empty( $taxonomy ) ) {
			    add_rewrite_rule(
			      $taxonomy.'\/(.+?)\/amp/?$',
			      'index.php?amp&'.$key.'=$matches[1]',
			      'top'
			    );
			    // For Custom Taxonomies with pages
			    add_rewrite_rule(
			      $taxonomy.'\/(.+?)\/amp\/'.$wp_rewrite->pagination_base.'\/?([0-9]{1,})\/?$',
			      'index.php?amp&'.$taxonomy.'=$matches[1]&paged=$matches[2]',
			      'top'
			    );
			}
		}
	}
}
add_action( 'init', 'ampforwp_add_custom_rewrite_rules', 25 );
// add re-write rule for Products
add_action( 'init', 'ampforwp_custom_rewrite_rules_for_product_category' );
if ( ! function_exists('ampforwp_custom_rewrite_rules_for_product_category') ) {
	function ampforwp_custom_rewrite_rules_for_product_category(){
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
	}
}

// Modules 
add_action('after_setup_theme','ampforwp_add_module_files');
function ampforwp_add_module_files() {
	
	global $redux_builder_amp;
	if ( isset($redux_builder_amp['ampforwp-content-builder']) && $redux_builder_amp['ampforwp-content-builder'] ) {
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

// AMP endpoint Verifier
function ampforwp_is_amp_endpoint() {
	if ( ampforwp_is_non_amp() && ! is_admin()) {
		return apply_filters('ampforwp_is_amp_endpoint_takeover', ampforwp_is_non_amp() );
	}
	else {
		return apply_filters('ampforwp_is_amp_endpoint', false !== get_query_var( 'amp', false ) );
	}
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( ! class_exists( 'Ampforwp_Init', false ) ) {
	class Ampforwp_Init {

		public function __construct(){

			require AMPFORWP_PLUGIN_DIR .'/includes/features/functions.php';
			// Load Files required for the plugin to run
			if(is_plugin_active('amp/amp.php')){
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
			require_once AMPFORWP_PLUGIN_DIR."includes/features/performance/performance-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/analytics/analytics-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/structure-data/structured-data-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/notice-bar/notice-bar-functions.php";
			require_once AMPFORWP_PLUGIN_DIR."includes/features/push-notification/push-notification-functions.php";
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
require AMPFORWP_PLUGIN_DIR.'/templates/category-widget.php';
require AMPFORWP_PLUGIN_DIR.'/templates/woo-widget.php';


/*
* 	Including core AMP plugin files and removing any other things if necessary
*/
function ampforwp_bundle_core_amp_files(){
	// Bundling Default plugin
	require_once AMPFORWP_PLUGIN_DIR .'/includes/vendor/amp/amp.php';

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

		load_plugin_textdomain( 'accelerated-mobile-pages', false, trailingslashit(AMPFORWP_PLUGIN_DIR) . 'languages' );

		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
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
		if ( isset($redux_builder_amp['ampforwp-update-notification-bar'] ) && $redux_builder_amp['ampforwp-update-notification-bar'] && current_user_can( 'manage_options' ) ) {

	        add_action('admin_notices', 'ampforwp_update_notice');
	    }
    }
}


// Admin notice for AMP WordPress Theme
add_action('admin_notices', 'ampforwp_ampwptheme_notice');
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

	// AMP with AMPforWP notice #2287
	if ( function_exists('amp_activate') ) { ?>
		<div class="notice-warning settings-error notice is-dismissible"><p><?php echo esc_html__('AMP by Automattic is activated so the AMPforWP is now in the "Addon Mode". ','accelerated-mobile-pages') ?><a href="https://ampforwp.com/tutorials/article/guide-to-amp-by-automattic-compatibility-in-ampforwp/" target="_blank"><?php echo esc_html__('Learn More','accelerated-mobile-pages'); ?></a></p></div>
	<?php }
}

function ampforwp_update_notice() {
	$screen = '';
	$screen = get_current_screen();
	$ampforwp_current_version = AMPFORWP_VERSION;
	if ( 'toplevel_page_amp_options' == $screen->base ) { ?>
    <div class="notice-success notice is-dismissible amp-update-notice">
        <div class="amp-update-notice-text-box">
        	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAn1BMVEUAAADuHCXwHiTuHSTtHST/IjjuHSXuHCTvHSXvHCXwHi3/JyfuHSTuHCTvHSTvHCTxHSb/NDTyHyj0IyruHSTvHSXvHSbuHST1ICftHCXuHCXuHSXwHiXvHyfuHSTuHSTvHSXuHCTuHCTuHCTuHCTvHSXyHibuHCTuHCXuHCXuHCXuHibwICjuHCTuHCTuHSTwHSbuHCXuHCTuHCTtHCSisK2PAAAANHRSTlMA+1T35wiIxm9kEQzu4Yx/NgQlFZV6PrAa16RpUi7MhE3y3LmYXynrz5FYSSC9q55EddGypVN9ggAABlxJREFUeNrVm+mymkAQhQfZBVQEFNz3fbtm3v/ZYqUqyWww0603Vfn+mcr1wMz06QUk/yfZIPRua79KYst2Vgd/fS9aU5f8E6JFx4+pktWPryn5VtKH51u0kXgY9Mk30cv31IhZkH1e/VJU1BzrR+uzJ2I6sigQ5yv63NoPKYa42/6M/JpiWXrvr0I7p+/gnN7U3+7pm1x3BM/Op+9je+iACO2mI+aPcq8ItmHQ7WyGVVOUHHDWFI1qN3Y0HmSiSfYX3atddxhPmNCv1As6HNdvqvuYP6mSDXgbTsq78cdt7YV3HOU2lDD9QBnVZnuZnlXOkYAOwlzjaxjv3PfMs+5dvvsiAh6hofwdD1P9GxUZlQTMeSXlyAkxQrr/6kEwuF1bDKEBav87aCfrH8SDNIWf/3hB8Lgb0cMu2vgXI/9C3uK0FArXTHN4hW27p+RNdomQHZv9vxK2Hyf6ODIfSuE7u6QBIf984fQnNuc5bSGpN4RCSDlCnH7L2ghH8cofxKx2u2z+/rH6SSTu7IyyrEkN/if2f2JROXAz3hW3NfUff/7R+iNVX+Nwm6DMa+09F/8pVn+v3OIeV7PlRAFnWvEFq09PJg7bU1wiZVmg9YekBi4/z4jEmjuAaP24rG1xOEtsNS5A5eL0m73jwdWIjQv0QOtfjX32LCQhrv5B69uNZ7dcsmFWf3HLEqtPA0CtMeB8go3SAuW/8l3JpFWdIResBURYfZvpmfRma7ELXbH5GqNv+JdpIiY7OQaXbaz+08C9x4zS8+8/s1MQD6tvmXQ+LpuUpn8Whk1Dfbg+5Mo93m9li/Kx+isz99yx/arqqsZgfS6s9bDF0UWuhOw2Uj8HNP5i0RkxLjRE6ifG5pHJnr9A70DLklKLHqZfdMgvOvQvO5g+Jn3Jcj5zSTh9B3JyFlJ5HDObgtKnLQKAPXKeeCrGEH3syZ0JZ37A5mi4vroMNCyMKrEhzAD66BayYFJyyvtgjNHfp1DzFDLPjUkEAH18ATMVStO1HAR6fZbVpvPi+CJ/sXlxPzaNdF22PeBtIAfoa0garsDmz08lhCVeX+7+1DDlR/D6mGjqYZy+U1ce8Ipd3giDt/SNu9snv+aWaM14fRNvEE6dcCQ+pT829eLj66Oj2YIP6/PHfv76uOKOBF7f/D4Svjk5mM4lBjh9mSWzVvyR2DS2Vas6Reh4VahI1oYlad9MvwCVpRP+AUnV2FXNPqAvFSBSem7AnXS9X8xfdF/kPhPCZq21VIBI6RlGeeD158CyOBbTs2yg+uUEd9Y/hALEfWc4UcL1SSIOpFfs8xQgZ4i+HE2FuCQ2dEK5BuuTUNryL/yIcgLV52tQ2pYmRHOQftuB6xNHHlnH7OAIwh124dLtdhRz4ilA/4FZuFwxLw5wg/ooAenLAzErUgyOHPM+54hxj4lyIDaTl0VPDzVbvikLp0CaIetxK4x+31IOxDJL7Cj0zIH68pOxG5cfoIOyqYXRL+2azNeiwEhMZ6jHu0da09a7DnAJCpR+adcG/BcFBULfZupfXAjYJW8qjB0bzJ19lP656eltF1LZjVH6LlvXWxcxsS3Z5WmuDS9LjD6ZNz+c9yjDoXET1rr+T99YWfItRg6lZj3SFqWfcd9/1L5BdKr/phiqLz8cd5STtStlWO6aYikE63eF29O/w5KUNfkUpR8avczkUZaqrS4DMfoLi5oEmcs3Wr4qFO4Y/YFtOEDoL/mVilRl4BauH1OWofm7dLNMKgMR+gtbM0PlCwaOlWCYR4R+yOy/8IRXfwyo0+NfBjq9GX96By8TymExf+A+wfrZWtDP9al+T3mGf/asAOsPHMpzMym3l5Qnefy+Nmj+nVOBq2vUcVma14rRLxbPItM3IqnAMkih8uWNSvoZwDlEqm0Kkj8yNyH5mp6pQyWSsWvc/2xkeXoDTV8uKyrjeDuTlmFxs6hMDg3gK+hnZPIP0iQ7QVqYzKGziGpWPhw5VEnCGCrcRWSs2Yj/gWM2CDs/WA9VexneR9XY+9XTn1VJrPlvAUGzdejbXHcf/KkZ/sdmeHozisc6RuR9Wges/L1PPsPZR8jb+YV8jsHagsnvOyX5LOXX0/zmb4uUfAPTTmKy8wY/SMNzEdxW9ulzRL6bXegpfuAY+/diAb51PGn/3AqDrpcf58V4Oxlk5H/lJxdt5e+wtfWRAAAAAElFTkSuQmCC" width="128" height="128" />
	 		<div class="amp-update-notice-text"> <?php echo esc_html__('AMP has been updated to '.$ampforwp_current_version, 'accelerated-mobile-pages' ); ?></div>
	    	<a href="https://ampforwp.com/new/" target="_blank" href="admin.php?page=acmforwp_update"><?php echo esc_html__('What\'s New ?', 'accelerated-mobile-pages');?></a> 
    	</div>
		<div class="amp-update-notice-dismiss">
        	<a title="Close this Notification" href="<?php echo esc_url( wp_nonce_url(add_query_arg( 'ampforwp-dismiss', 'ampforwp_dismiss_admin_notices' ), 'ampforwp_notice', 'ampforwp_notice') ) ?>">X</a>
    	</div> 
		<div class="amp-update-notice-review-box">
			<a class="star_icon" href="https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages?rate=5#new-post" target="_blank"> <?php echo esc_html__('Appreciate it?','accelerated-mobile-pages')?>  <br> <span title="Give Us 5 Star"><?php echo esc_html__('Leave a Review', 'accelerated-mobile-pages') ?> →</span></a>
		</div>
	</div>
<?php }
}
if ( ! defined('AMP_FRAMEWORK_COMOPNENT_DIR_PATH') ) {
	define('AMP_FRAMEWORK_COMOPNENT_DIR_PATH', AMPFORWP_PLUGIN_DIR ."/components"); 
}
require_once( AMP_FRAMEWORK_COMOPNENT_DIR_PATH . '/components-core.php' );
require ( AMPFORWP_PLUGIN_DIR.'/install/index.php' );
if ( !is_plugin_active('amp/amp.php') ) {
	require_once(  AMPFORWP_PLUGIN_DIR. 'base_remover/base_remover.php' );
	require_once(  AMPFORWP_PLUGIN_DIR. 'includes/thirdparty-compatibility.php' );
	require_once(  AMPFORWP_PLUGIN_DIR. 'pagebuilder/amp-page-builder.php' );
}
if(is_admin()){
	require_once(  AMPFORWP_PLUGIN_DIR. 'includes/modules-upgrade.php' );
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

// Get Settings from Redux #2177
function ampforwp_get_setting( $opt_name='' ){
	global $redux_builder_amp;
	if(empty($redux_builder_amp)){
		$redux_builder_amp =  (array) get_option('redux_builder_amp');
	}
	$opt_value = '';
	if ( isset($redux_builder_amp[$opt_name]) ) {
		$opt_value = $redux_builder_amp[$opt_name];
	}
	return $opt_value;
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

   if ( ampforwp_get_setting('ampforwp-custom-type')) {
        foreach (ampforwp_get_setting('ampforwp-custom-type') as $key) {
            $selected_post_types[$key] = $key;
        }
        $post_types = array_merge($post_types, $selected_post_types);
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
	if ( !class_exists('Redux') && class_exists('ReduxCore\\ReduxFramework\\Redux') ) {
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
add_action('admin_notices', 'ampforwp_plugins_manager_notice');
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
		if ( true == ampforwp_get_setting('ampforwp-infinite-scroll') ) {
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
add_action('parse_query','ampforwp_vendor_is_amp_endpoint'); 
function ampforwp_vendor_is_amp_endpoint(){
	if ( ! function_exists('amp_activate') && ! function_exists('is_amp_endpoint' ) ) {
		function is_amp_endpoint(){
			if( true == WP_DEBUG_LOG && false == WP_DEBUG_DISPLAY ){
				_doing_it_wrong(
					__FUNCTION__,
					sprintf(
						/* translators: 1: is_amp_endpoint(), 2: ampforwp_is_amp_endpoint */
						esc_html__( '%1$s is deprecated from AMPforWP, please use %2$s instead. Check %3$s for more info', 'accelerated-mobile-pages' ),
						'is_amp_endpoint()',
						'ampforwp_is_amp_endpoint','https://ampforwp.com/tutorials/article/detect-amp-page-function/'
					),
					'5.1.1'
				);
			}
			return false !== get_query_var( AMP_QUERY_VAR, false );
		}
	}
}