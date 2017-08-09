<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP for WP - Accelerated Mobile Pages for WordPress
Version: 0.9.58.1
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: https://ampforwp.com/
Donate link: https://www.paypal.me/Kaludi/25
License: GPL2
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define('AMPFORWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('AMPFORWP_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('AMPFORWP_DISQUS_URL',plugin_dir_url(__FILE__).'includes/disqus.php');
define('AMPFORWP_IMAGE_DIR',plugin_dir_url(__FILE__).'images');
define('AMPFORWP_MAIN_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
define('AMPFORWP_VERSION','0.9.58.1');
// any changes to AMP_QUERY_VAR should be refelected here
define('AMPFORWP_AMP_QUERY_VAR', apply_filters( 'amp_query_var', 'amp' ) );

load_plugin_textdomain( 'accelerated-mobile-pages', false, trailingslashit(AMPFORWP_PLUGIN_DIR) . 'languages' );

// Rewrite the Endpoints after the plugin is activate, as priority is set to 11
function ampforwp_add_custom_post_support() {
	global $redux_builder_amp;
	if( $redux_builder_amp['amp-on-off-for-all-pages'] ) {
		add_rewrite_endpoint( AMPFORWP_AMP_QUERY_VAR, EP_PAGES | EP_PERMALINK | EP_AUTHORS  | EP_ALL_ARCHIVES |  EP_ROOT );
		add_post_type_support( 'page', AMPFORWP_AMP_QUERY_VAR );
	}
}
add_action( 'init', 'ampforwp_add_custom_post_support',11);

// Frontpage and Blog page check from reading settings.
function ampforwp_name_blog_page() {
	$page_for_posts  =  get_option( 'page_for_posts' );
	$post = get_post($page_for_posts); 
	if ( $post ) {
		$slug = $post->post_name;
		return $slug;
	}
}
function ampforwp_custom_post_page() {
	$front_page_type  =  get_option( 'show_on_front' );
	if ( $front_page_type ) {
		return $front_page_type;
	}
}

function ampforwp_get_the_page_id_blog_page(){
	$page = "";
	$output = "";
	if ( ampforwp_name_blog_page() ) {
		$page = get_page_by_path( ampforwp_name_blog_page() );
		$output = $page->ID;
	}

	return $output;
}

// Add Custom Rewrite Rule to make sure pagination & redirection is working correctly
function ampforwp_add_custom_rewrite_rules() {
    // For Homepage
    add_rewrite_rule(
      'amp/?$',
      'index.php?amp',
      'top'
    );
	// For Homepage with Pagination
    add_rewrite_rule(
        'amp/page/([0-9]{1,})/?$',
        'index.php?amp&paged=$matches[1]',
        'top'
    );
	// For /Blog page with Pagination
	//if ( ampforwp_custom_post_page() && ampforwp_name_blog_page() ) {
	    add_rewrite_rule(
	        ampforwp_name_blog_page(). '/amp/page/([0-9]{1,})/?$',
	        'index.php?amp&paged=$matches[1]&page_id=' .ampforwp_get_the_page_id_blog_page(),
	        'top'
	    );
	//}

    // For Author pages
    add_rewrite_rule(	
        'author\/([^/]+)\/amp\/?$',
        'index.php?amp&author_name=$matches[1]',
        'top'
    );

    add_rewrite_rule(	
        'author\/([^/]+)\/amp\/page\/?([0-9]{1,})\/?$',
        'index.php?amp=1&author_name=$matches[1]&paged=$matches[2]',
        'top'
    );

    // For category pages
    $rewrite_category = get_option('category_base');
    if (! empty($rewrite_category)) {
    	$rewrite_category = get_option('category_base');
    } else {
    	$rewrite_category = 'category';
    }

    add_rewrite_rule(
      $rewrite_category.'\/(.+?)\/amp/?$',
      'index.php?amp&category_name=$matches[1]',
      'top'
    );
    // For category pages with Pagination
    add_rewrite_rule(
      $rewrite_category.'\/(.+?)\/amp\/page\/?([0-9]{1,})\/?$',
      'index.php?amp&category_name=$matches[1]&paged=$matches[2]',
      'top'
    );

    // For tag pages
	$rewrite_tag = get_option('tag_base');
    if (! empty($rewrite_tag)) {
    	$rewrite_tag = get_option('tag_base');
    } else {
    	$rewrite_tag = 'tag';
    }
    add_rewrite_rule(
      $rewrite_tag.'\/(.+?)\/amp/?$',
      'index.php?amp&tag=$matches[1]',
      'top'
    );
    // For tag pages with Pagination
    add_rewrite_rule(
      $rewrite_tag.'\/(.+?)\/amp\/page\/?([0-9]{1,})\/?$',
      'index.php?amp&tag=$matches[1]&paged=$matches[2]',
      'top'
    );
    
	//Rewrite rule for custom Taxonomies
	$args = array(
	  'public'   => true,
	  '_builtin' => false	  
	); 
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$taxonomies = get_taxonomies( $args, $output, $operator ); 
	if ( $taxonomies ) {
	  foreach ( $taxonomies  as $taxonomy ) {	   
	    add_rewrite_rule(
	      $taxonomy.'\/(.+?)\/amp/?$',
	      'index.php?amp&'.$taxonomy.'=$matches[1]',
	      'top'
	    );
	    // For Custom Taxonomies with pages
	    add_rewrite_rule(
	      $taxonomy.'\/(.+?)\/amp\/page\/?([0-9]{1,})\/?$',
	      'index.php?amp&'.$taxonomy.'=$matches[1]&paged=$matches[2]',
	      'top'
	    );
	  }
	}
}
add_action( 'init', 'ampforwp_add_custom_rewrite_rules' );

register_activation_hook( __FILE__, 'ampforwp_rewrite_activation', 20 );
function ampforwp_rewrite_activation() {

	// Run AMP deactivation code while activation  
	ampforwp_deactivate_amp_plugin();

		if ( ! did_action( 'ampforwp_init' ) ) {
	 		ampforwp_init();		 	
		}

	flush_rewrite_rules();

    ampforwp_add_custom_post_support();
    ampforwp_add_custom_rewrite_rules();

    // Flushing rewrite urls ONLY on activation
	global $wp_rewrite;
	$wp_rewrite->flush_rules();

    // Set transient for Welcome page
	set_transient( 'ampforwp_welcome_screen_activation_redirect', true, 30 );

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

add_action( 'admin_init','ampforwp_parent_plugin_check');
function ampforwp_parent_plugin_check() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );
	if ( $amp_plugin_activation_check ) {
		// set_transient( 'ampforwp_parent_plugin_check', true, 30 );
	} else {
		delete_option( 'ampforwp_parent_plugin_check');
	}
}

// Redux panel inclusion code
	if ( !class_exists( 'ReduxFramework' ) ) {
	    require_once dirname( __FILE__ ).'/includes/options/redux-core/framework.php';
	}
	// Register all the main options
	require_once dirname( __FILE__ ).'/includes/options/admin-config.php';
	require_once dirname( __FILE__ ).'/templates/report-bugs.php';
	
	
// Modules 
add_action('after_setup_theme','ampforwp_add_module_files');
function ampforwp_add_module_files() {
	
	global $redux_builder_amp;
	if ( $redux_builder_amp['ampforwp-content-builder'] ) {
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

	// Include Welcome page only on Admin pages
	require AMPFORWP_PLUGIN_DIR .'/includes/welcome.php';

	// Deactivate Parent Plugin notice
    // add_action('init','ampforwp_plugin_notice');
	function  ampforwp_plugin_notice() {

		if ( ! defined( 'AMP__FILE__' ) ) {
			add_action( 'admin_notices', 'ampforwp_plugin_not_found_notice' );
			function ampforwp_plugin_not_found_notice() {

            $current_screen = get_current_screen();

            if( $current_screen ->id == "plugin-install" || $current_screen ->id == "dashboard_page_ampforwp-welcome-page" || $current_screen ->id == "ampforwp-welcome-page" ) {
                return;
            }

            ?>

				<div class="notice notice-warning is-dismissible ampinstallation">

						<?php add_thickbox(); ?>
				        <p>
                        <strong><?php _e( 'AMP Installation requires one last step:','accelerated-mobile-pages' ); ?></strong> <?php _e( 'AMP by Automattic plugin is not active', 'accelerated-mobile-pages' ); ?>
				         <strong>	<span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;"><a href="index.php?page=ampforwp-welcome-page"><?php _e( 'Continue Installation', 'accelerated-mobile-pages' ); ?></a>
                             </span> </strong>
				        </p>
				</div> <?php
			}

			add_action('admin_head','ampforwp_required_plugin_styling');
			function ampforwp_required_plugin_styling() {
				if ( ! defined( 'AMP__FILE__' ) ) { ?>
					<style>
						#toplevel_page_amp_options a .wp-menu-name:after {
							content: "1";
							background-color: #d54e21;
							color: #fff;
							border-radius: 10px;
							font-size: 9px;
						    line-height: 17px;
						    font-weight: 600;
						    padding: 3px 7px;
						    margin-left: 5px;
						}
					</style>
					<?php
				}
				?>
				<style>
                    .notice, .notice-error, .is-dismissible, .ampinstallation{}
					.plugin-card.plugin-card-amp:before{
                        content: __("FINISH INSTALLATION: Install & Activate this plugin ↓",'accelerated-mobile-pages');
                        font-weight: bold;
                        float: right;
                        position: relative;
                        color: #dc3232;
                        top: -28px;
                        font-size: 18px;
					}
                    .plugin-action-buttons a{
                        color: #fff
                    }
					.plugin-card.plugin-card-amp {
						background: rgb(0, 165, 92);
						color: #fff;
					}
					.plugin-card.plugin-card-amp .column-name a,
					.plugin-card.plugin-card-amp .column-description a,
					.plugin-card.plugin-card-amp .column-description p {
						color: #fff;
					}
					.plugin-card-amp .plugin-card-bottom {
						background: rgba(229, 255, 80, 0);
					}
				</style> <?php
			}
		}
	}

 	// Add Settings Button in Plugin backend
 	if ( ! function_exists( 'ampforwp_plugin_settings_link' ) ) {
 		
 		// Deactivate Parent Plugin notice
 		// add_filter( 'plugin_action_links', 'ampforwp_plugin_settings_link', 10, 5 );

 		function ampforwp_plugin_settings_link( $actions, $plugin_file )  {
 			static $plugin;
 			if (!isset($plugin))
 				$plugin = plugin_basename(__FILE__);
 				if ($plugin == $plugin_file) {
 					$settings = array('settings' => '<a href="admin.php?page=amp_options&tab=8">' . __('Settings', 'accelerated-mobile-pages') . '</a> | <a href="https://ampforwp.com/priority-support/#utm_source=options-panel&utm_medium=extension-tab_priority_support&utm_campaign=AMP%20Plugin">' . __('Premium Support', 'accelerated-mobile-pages') . '</a>');
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					if ( is_plugin_active( 'amp/amp.php' ) ) {
					    //if parent plugin is activated
								$actions = array_merge( $actions, $settings );
					} else{
						if(is_plugin_active( 'amp/amp.php' )){
							$actions = array_merge( $actions, $settings );
						}else{
						$please_activate_parent_plugin = array(__('Please Activate Parent plugin','accelerated-mobile-pages') => '<a href="'.get_admin_url() .'index.php?page=ampforwp-welcome-page">' . __('<span style="color:#b30000">'.__('Action Required: Continue Installation','accelerated-mobile-pages').'</span>', 'accelerated-mobile-pages') . '</a>');
						$actions = array_merge( $please_activate_parent_plugin,$actions );
					}
					}

 				}
 		return $actions;
 		}
 	}

} // is_admin() closing

	// AMP endpoint Verifier
	function ampforwp_is_amp_endpoint() {
		return false !== get_query_var( 'amp', false );
	}

if ( ! class_exists( 'Ampforwp_Init', false ) ) {
	class Ampforwp_Init {

		public function __construct(){

			// Load Files required for the plugin to run
			require AMPFORWP_PLUGIN_DIR .'/includes/includes.php';

			// Redirection Code added
			require AMPFORWP_PLUGIN_DIR.'/includes/redirect.php';

			require AMPFORWP_PLUGIN_DIR .'/classes/class-init.php';
			new Ampforwp_Loader;

		}
	}
}
/*
 * Start the plugin.
 * Gentlemen start your engines
 */
function ampforwp_plugin_init() {
	
	if ( defined( 'AMP__FILE__' ) && defined('AMPFORWP_PLUGIN_DIR') ) {
		new Ampforwp_Init;
	}
}
add_action('init','ampforwp_plugin_init',9);

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

	define( 'AMP__FILE__', __FILE__ );
	if ( ! defined('AMP__DIR__') ) {
		define( 'AMP__DIR__', plugin_dir_path(__FILE__) . 'includes/vendor/amp/' );
	}
	define( 'AMP__VERSION', '0.4.2' );

	require_once( AMP__DIR__ . '/back-compat/back-compat.php' );
	require_once( AMP__DIR__ . '/includes/amp-helper-functions.php' );
	require_once( AMP__DIR__ . '/includes/admin/functions.php' );
	require_once( AMP__DIR__ . '/includes/settings/class-amp-customizer-settings.php' );
	require_once( AMP__DIR__ . '/includes/settings/class-amp-customizer-design-settings.php' );
} 
add_action('plugins_loaded','ampforwp_bundle_core_amp_files', 8);

function ampforwp_deactivate_amp_plugin() {
 
	if ( version_compare( floatval( get_bloginfo( 'version' ) ), '3.5', '>=' ) ) {

	    if ( current_user_can( 'activate_plugins' ) ) {

	        add_action( 'admin_init', 'ampforwp_deactivate_amp' ); 

	        function ampforwp_deactivate_amp() {
	            deactivate_plugins( AMPFORWP_MAIN_PLUGIN_DIR . 'amp/amp.php' );
	        }
	    }
	}
}
add_action( 'plugins_loaded', 'ampforwp_deactivate_amp_plugin' );

function ampforwp_modify_amp_activatation_link( $actions, $plugin_file )  {
	$plugin = '';

	$plugin =  'amp/amp.php'; 
	if (  $plugin == $plugin_file  ) {
		unset($actions['activate']);
	}
 	return $actions;
}
add_filter( 'plugin_action_links', 'ampforwp_modify_amp_activatation_link', 10, 2 );


if ( ! function_exists('ampforwp_init') ) {
	add_action( 'init', 'ampforwp_init' );
	function ampforwp_init() {
		if ( false === apply_filters( 'amp_is_enabled', true ) ) {
			return;
		}

		define( 'AMP_QUERY_VAR', apply_filters( 'amp_query_var', 'amp' ) );

		if ( ! defined('AMP__DIR__') ) {
			define( 'AMP__DIR__', plugin_dir_path(__FILE__) . 'includes/vendor/amp/' );
		}

		do_action( 'amp_init' );

		load_plugin_textdomain( 'amp', false, plugin_basename( AMP__DIR__ ) . '/languages' );

		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK );
		add_post_type_support( 'post', AMP_QUERY_VAR );

		add_filter( 'request', 'amp_force_query_var_value' );
		add_action( 'wp', 'amp_maybe_add_actions' );

		if ( class_exists( 'Jetpack' ) && ! ( defined( 'IS_WPCOM' ) && IS_WPCOM ) ) {
			require_once( AMP__DIR__ . '/jetpack-helper.php' );
		}
	}
}