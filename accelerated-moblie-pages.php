<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP for WP - Accelerated Mobile Pages for WordPress
Version: 0.9.64
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: https://ampforwp.com/
Donate link: https://www.paypal.me/Kaludi/25
License: GPL2+
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define('AMPFORWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('AMPFORWP_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('AMPFORWP_DISQUS_URL',plugin_dir_url(__FILE__).'includes/disqus.php');
define('AMPFORWP_IMAGE_DIR',plugin_dir_url(__FILE__).'images');
define('AMPFORWP_MAIN_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
define('AMPFORWP_VERSION','0.9.64');

// any changes to AMP_QUERY_VAR should be refelected here
function ampforwp_generate_endpoint(){
    $ampforwp_slug = '';
    $get_permalink_structure = '';
    $get_permalink_structure = get_option('permalink_structure');
    
    if(empty( $get_permalink_structure )) {
        $ampforwp_slug = '&amp=1';
    }else{
        $ampforwp_slug = "amp";
    }
    return $ampforwp_slug;
}

define('AMPFORWP_AMP_QUERY_VAR', apply_filters( 'amp_query_var', ampforwp_generate_endpoint() ) );

load_plugin_textdomain( 'accelerated-mobile-pages', false, trailingslashit(AMPFORWP_PLUGIN_DIR) . 'languages' );

// Rewrite the Endpoints after the plugin is activate, as priority is set to 11
function ampforwp_add_custom_post_support() {
	global $redux_builder_amp;
	if( isset($redux_builder_amp['amp-on-off-for-all-pages']) && $redux_builder_amp['amp-on-off-for-all-pages'] ) {
		add_rewrite_endpoint( AMPFORWP_AMP_QUERY_VAR, EP_PAGES | EP_PERMALINK | EP_AUTHORS  | EP_ALL_ARCHIVES |  EP_ROOT );
		add_post_type_support( 'page', AMPFORWP_AMP_QUERY_VAR );
	}
}
add_action( 'init', 'ampforwp_add_custom_post_support',11);

// Frontpage and Blog page check from reading settings.
function ampforwp_name_blog_page() {
	if(!$page_for_posts = get_option('page_for_posts')) return;
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
	    require_once dirname( __FILE__ ).'/includes/options/extensions/loader.php';
	    require_once dirname( __FILE__ ).'/includes/options/redux-core/framework.php';
	}
	// Register all the main options
	require_once dirname( __FILE__ ).'/includes/options/admin-config.php';
	require_once dirname( __FILE__ ).'/templates/report-bugs.php';
	
	
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
 		add_filter( 'plugin_action_links', 'ampforwp_plugin_settings_link', 10, 5 );

 		function ampforwp_plugin_settings_link( $actions, $plugin_file )  {
 			static $plugin;
 			if (!isset($plugin))
 				$plugin = plugin_basename(__FILE__);
 				if ($plugin == $plugin_file) {
 					$settings = array('settings' => '<a href="admin.php?page=amp_options&tab=8">' . __('Settings', 'accelerated-mobile-pages') . '</a> | <a href="https://ampforwp.com/priority-support/#utm_source=options-panel&utm_medium=extension-tab_priority_support&utm_campaign=AMP%20Plugin">' . __('Premium Support', 'accelerated-mobile-pages') . '</a>');
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					$actions = array_merge( $actions, $settings );
					/*if ( is_plugin_active( 'amp/amp.php' ) ) {
					    //if parent plugin is activated
								$actions = array_merge( $actions, $settings );
					} else{
						if(is_plugin_active( 'amp/amp.php' )){
							$actions = array_merge( $actions, $settings );
						}else{
						$please_activate_parent_plugin = array(__('Please Activate Parent plugin','accelerated-mobile-pages') => '<a href="'.get_admin_url() .'index.php?page=ampforwp-welcome-page">' . __('<span style="color:#b30000">'.__('Action Required: Continue Installation','accelerated-mobile-pages').'</span>', 'accelerated-mobile-pages') . '</a>');
						$actions = array_merge( $please_activate_parent_plugin,$actions );
					}
					}*/

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
		add_thickbox();
		unset($actions['activate']);
		$a = '<span style="cursor:pointer;color:#0089c8" class="warning_activate_amp" onclick="alert(\'AMP is already bundled with AMPforWP. Please do not install this plugin with AMPforWP to avoid conflicts. \')">Activate</span>';
		array_unshift ($actions,$a);
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


function AMP_update_db_check() {
	$ampforWPCurrentVersion = AMPFORWP_VERSION;
   	if (get_option( 'AMPforwp_db_version' ) != $ampforWPCurrentVersion) {

   		if ( isset( $_GET['ampforwp-dismiss'] ) && trim($_GET['ampforwp-dismiss'])=="ampforwp_dismiss_admin_notices" ) {
			update_option( 'AMPforwp_db_version', $ampforWPCurrentVersion );
			 wp_redirect(admin_url('/index.php'), 301);
		}

        add_action('admin_notices', 'ampforwp_update_notice');
    }
}
add_action( 'plugins_loaded', 'AMP_update_db_check' );

function ampforwp_update_notice() {
	$ampforWPCurrentVersion = AMPFORWP_VERSION;
?>
    <div class="notice-success notice  is-dismissible amp-update-notice" style="           display: table;
    position: relative;
    height: 70px;
    padding: 0;
    border: 0;
    overflow: hidden;
    margin-bottom: 10px;
" id="gf_dashboard_message">
        <div style="     padding: 15px 15px 10px 15px;
    display: inline-block;">
        <img style="  width: 40px;
    display: inline;
    height: 40px;" src="data:image/png;base64,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" width="128" height="128" />
	 <div style="    display: inline;
    position: relative;
    margin-left: 5px;
    font-weight: 300;
    top: -14px;
    font-size: 20px;"> <?php _e( 'A Big Update of AMP in '.$ampforWPCurrentVersion, 'accelerated-mobile-pages' ); ?></div>
	    <a href="https://ampforwp.com/new/" target="_blank" style="
    position: relative;
    top: -17px;
    background: #ECEFF1;
    text-decoration: none;
    color: #111;
    font-size: 10px;
    padding: 4px 6px 5px 5px;
    border-radius: 4px;
    margin-left: 5px;
    text-transform: uppercase;
    border: 1px solid rgba(207, 216, 220, 0.9);" href="admin.php?page=acmforwp_update">What's New?</a> 
    </div>
<div style="display:inline-block;float:right;height: 70px;background: #333;width: 50px;text-align: center;">
	        <a title="Close this Notification" style="color: #fff;
    text-decoration: none;
    top: 26px;
    position: relative;
    padding: 24px 18px;
    font-size: 17px;
    font-weight: 300;
    background: #333;
    z-index: 100;" href="<?php echo add_query_arg( 'ampforwp-dismiss', 'ampforwp_dismiss_admin_notices' ) ?>">X</a>
	    </div> 
        
<div style="float: right;display: inline-block;/* height: 55px; */background: #4CAF50;padding: 12px 20px 11px 60px;background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIuMDAxIDUxMi4wMDEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMi4wMDEgNTEyLjAwMTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIxMjhweCIgaGVpZ2h0PSIxMjhweCI+CjxnPgoJPGc+CgkJPGc+CgkJCTxwYXRoIGQ9Ik0zNjYuOTA1LDM2NS4wNzFsODcuOTAyLTg1LjY4M2M2LjA4Ny01LjkzNSw4LjIzNi0xNC42NDMsNS42MS0yMi43MjljLTIuNjI5LTguMDg1LTkuNDg2LTEzLjg2Ni0xNy44OTgtMTUuMDg3ICAgICBsLTU1Ljg3OS04LjEyYy00LjQxMy0wLjY0Ny04LjUyMSwyLjQxOS05LjE2MSw2LjgzN2MtMC42NDMsNC40MTksMi40MTgsOC41MjEsNi44MzcsOS4xNjNsNTUuODc5LDguMTIgICAgIGMyLjI3OCwwLjMzLDQuMTM1LDEuODk2LDQuODQ3LDQuMDgzYzAuNzExLDIuMTksMC4xMjksNC41NDgtMS41MTksNi4xNTRsLTkwLjk0Nyw4OC42NWMtMS45MDUsMS44NTgtMi43NzMsNC41MzMtMi4zMjMsNy4xNTUgICAgIGwyMS40NjksMTI1LjE3OGMwLjM4OSwyLjI2OC0wLjUyNyw0LjUxOC0yLjM4Nyw1Ljg2OWMtMS44MTYsMS4zMTgtNC4zMzksMS41MDItNi4zMjIsMC40NTlsLTExMi40MTQtNTkuMTAxICAgICBjLTIuMzU1LTEuMjM3LTUuMTY5LTEuMjM3LTcuNTI0LDBsLTExMi40MTQsNTkuMTAxYy0yLjAzOCwxLjA3LTQuNDYsMC44OTMtNi4zMjItMC40NThjLTEuODYxLTEuMzUzLTIuNzc1LTMuNjAyLTIuMzg4LTUuODcgICAgIGwyMS40Ny0xMjUuMTc3YzAuNDUtMi42MjItMC40Mi01LjI5Ny0yLjMyNC03LjE1NWwtOTAuOTQ2LTg4LjY0OWMtMS42NDgtMS42MDctMi4yMjktMy45NjYtMS41Mi02LjE1NSAgICAgYzAuNzEyLTIuMTg4LDIuNTY3LTMuNzUzLDQuODQ2LTQuMDgzbDEyNS42ODQtMTguMjYzYzIuNjMzLTAuMzgyLDQuOTEtMi4wMzYsNi4wODctNC40MjJsNTYuMjA5LTExMy44OTEgICAgIGMxLjAxOS0yLjA2MywzLjA4LTMuMzQ1LDUuMzgyLTMuMzQ1czQuMzY0LDEuMjgxLDUuMzgzLDMuMzQ1bDU2LjIwNywxMTMuODljMS4xNzgsMi4zODUsMy40NTMsNC4wMzksNi4wODgsNC40MjJsNDIuMzk1LDYuMTYgICAgIGM0LjQwNSwwLjY0MSw4LjUyLTIuNDE4LDkuMTYxLTYuODM3YzAuNjQzLTQuNDE4LTIuNDE4LTguNTIxLTYuODM3LTkuMTYybC0zOC4xOS01LjU0OWwtNTQuMzI2LTExMC4wNzcgICAgIGMtMy43NjEtNy42MjQtMTEuMzc5LTEyLjM1OS0xOS44OC0xMi4zNTljLTguNTAxLDAtMTYuMTE5LDQuNzM2LTE5Ljg3OSwxMi4zNThsLTU0LjMyOCwxMTAuMDc4TDUxLjE0OSwyNDEuNTcyICAgICBjLTguNDEyLDEuMjIyLTE1LjI3LDcuMDAzLTE3Ljg5NywxNS4wODljLTIuNjI2LDguMDg0LTAuNDc4LDE2Ljc5Miw1LjYxLDIyLjcyOGw4Ny45MDIsODUuNjgybC0yMC43NSwxMjAuOTg5ICAgICBjLTEuNDM4LDguMzc3LDEuOTQsMTYuNjg1LDguODE4LDIxLjY4M2MzLjg4OCwyLjgyMyw4LjQzNCw0LjI1OCwxMy4wMTEsNC4yNThjMy41MjMsMCw3LjA2NS0wLjg1LDEwLjMzNy0yLjU2OWwxMDguNjU0LTU3LjEyMiAgICAgbDEwOC42NTcsNTcuMTI0YzMuMTcsMS42NjMsNi43MzUsMi41NDMsMTAuMzEyLDIuNTQzYzQuNzE0LDAsOS4yMTktMS40NjQsMTMuMDM0LTQuMjM0YzYuODc2LTQuOTk4LDEwLjI1Ni0xMy4zMDcsOC44MTctMjEuNjgzICAgICBMMzY2LjkwNSwzNjUuMDcxeiIgZmlsbD0iI0ZGRkZGRiIvPgoJCQk8cGF0aCBkPSJNMzg5LjQyOCwyMDIuMzEzYzAuNzA2LTUuMTc5LDcuNzgtMTMuNTY1LDI5LjgxNi0xMi4xNjVjMS4zNTUsMC4wODYsMi42NTEsMC4xMjgsMy45MDEsMC4xMjggICAgIGMyNy42OTktMC4wMDIsMzAuMDU0LTIwLjYzOSwzMS42My0zNC40OThjMC44NzQtNy42NzcsMS42OTktMTQuOTI4LDUuMjc1LTIwLjA1M2MyLjU1My0zLjY2MiwxLjY1My04LjcwMS0yLjAwNy0xMS4yNTQgICAgIGMtMy42NjItMi41NTItOC43MDEtMS42NTUtMTEuMjU1LDIuMDA2Yy01LjkxNCw4LjQ4MS03LjA2MywxOC41Ny04LjA3NiwyNy40NzNjLTEuNzQ2LDE1LjM0My0yLjQxLDIxLjA4Ny0xOC40MzgsMjAuMDYzICAgICBjLTE3LjY2NC0xLjEyNy0zMC44NiwyLjY1Ni0zOS4yMzIsMTEuMjQyYy02Ljg1NCw3LjAyOS03LjY0NCwxNC43MjItNy43MTEsMTUuNTc2bDE2LjExNywxLjI3NSAgICAgQzM4OS40NDksMjAyLjEwNiwzODkuNDQ3LDIwMi4xNzksMzg5LjQyOCwyMDIuMzEzeiIgZmlsbD0iI0ZGRkZGRiIvPgoJCQk8cGF0aCBkPSJNMjg2Ljc3NSw5MS4xN2MwLjE2LTAuMDg2LDAuMjU0LTAuMTE5LDAuMjU0LTAuMTE5bDYuNTIxLDE0Ljc5NWM3LjkzNC0zLjQ5NiwxOS45NDUtMTcuMTkyLDguNjE3LTQzLjk5OSAgICAgYy00LjEzNS05Ljc4OS0yLjEyNS0xMS4xMzEsOS4yNS0xNi42MThjMTEuMTEtNS4zNjEsMjcuOTAyLTEzLjQ2MiwyMy40NzEtMzguNTUxYy0wLjc3NS00LjM5Ny00Ljk2Mi03LjMyNy05LjM2Ny02LjU1NSAgICAgYy00LjM5NywwLjc3Ny03LjMzLDQuOTcxLTYuNTU0LDkuMzY3YzIuMjA1LDEyLjQ4LTMuMTc3LDE1LjY3OC0xNC41NzYsMjEuMTc3Yy0xMC4yMzcsNC45MzktMjcuMzcsMTMuMjA1LTE3LjExNiwzNy40NzQgICAgIEMyOTMuNDU5LDgyLjc3OSwyODkuODcxLDg5LjUwNSwyODYuNzc1LDkxLjE3eiIgZmlsbD0iI0ZGRkZGRiIvPgoJCQk8cGF0aCBkPSJNODAuMjY4LDg0Ljc0OWMxMi4zMTQsMi43OTYsMTQuNTc2LDMuNjUzLDEyLjc0LDE0LjEyYy01LjAyOCwyOC42NjUsOS43NSwzOS4zMTksMTguMjY2LDQwLjk0NiAgICAgYzAuNTEzLDAuMDk5LDEuMDIzLDAuMTQ2LDEuNTI3LDAuMTQ2YzMuODAyLDAsNy4xOS0yLjY5NSw3LjkzMS02LjU2N2MwLjgzOC00LjM4Ni0yLjAzNy04LjYyLTYuNDIzLTkuNDU4ICAgICBjLTAuMDg5LTAuMDE3LTguODI3LTIuNi01LjM3Ni0yMi4yNzNjNC41NDktMjUuOTUtMTQuMDAxLTMwLjE2My0yNS4wODUtMzIuNjhjLTEyLjM0MS0yLjgwMy0xOC4zMDMtNC43MTItMTguOTUzLTE3LjM2OSAgICAgYy0wLjIyOS00LjQ1OC00LjAwNi03Ljg5NC04LjQ4OC03LjY1OWMtNC40NTgsMC4yMjktNy44ODgsNC4wMjktNy42NTgsOC40ODhDNTAuMDU2LDc3Ljg4OCw2OC4yMzcsODIuMDE2LDgwLjI2OCw4NC43NDl6IiBmaWxsPSIjRkZGRkZGIi8+CgkJCTxwYXRoIGQ9Ik0xMDUuMjM5LDE4MS4xMTNjMCw2LjEyMSwyLjM4MiwxMS44NzQsNi43MSwxNi4yMDFjNC4zMjgsNC4zMjgsMTAuMDgxLDYuNzExLDE2LjIwMSw2LjcxMSAgICAgYzYuMTIsMCwxMS44NzQtMi4zODMsMTYuMjAyLTYuNzFjNC4zMjgtNC4zMjgsNi43MTItMTAuMDgxLDYuNzEyLTE2LjIwMnMtMi4zODQtMTEuODc0LTYuNzExLTE2LjIwMiAgICAgYy00LjMyOS00LjMyOC0xMC4wODItNi43MTEtMTYuMjAzLTYuNzExcy0xMS44NzMsMi4zODMtMTYuMjAxLDYuNzExQzEwNy42MjEsMTY5LjIzOSwxMDUuMjM5LDE3NC45OTIsMTA1LjIzOSwxODEuMTEzeiAgICAgIE0xMjMuMzgyLDE3Ni4zNDJjMS4yNzMtMS4yNzMsMi45NjgtMS45NzUsNC43NjktMS45NzVjMS44MDIsMCwzLjQ5NSwwLjcwMiw0Ljc3LDEuOTc2YzEuMjc1LDEuMjc0LDEuOTc4LDIuOTY4LDEuOTc4LDQuNzcgICAgIHMtMC43MDIsMy40OTQtMS45NzYsNC43NjljLTEuMjc1LDEuMjc0LTIuOTY5LDEuOTc2LTQuNzcyLDEuOTc2Yy0xLjgsMC0zLjQ5NC0wLjcwMi00Ljc3LTEuOTc2ICAgICBjLTEuMjczLTEuMjczLTEuOTc1LTIuOTY3LTEuOTc1LTQuNzY5QzEyMS40MDUsMTc5LjMxMiwxMjIuMTA2LDE3Ny42MTgsMTIzLjM4MiwxNzYuMzQyeiIgZmlsbD0iI0ZGRkZGRiIvPgoJCQk8cGF0aCBkPSJNMzE1LjI4NSwxMjkuMTg5Yy04LjkzMyw4LjkzNC04LjkzMywyMy40NywwLjAwMSwzMi40MDRjNC4zMjgsNC4zMjgsMTAuMDgyLDYuNzEsMTYuMjAxLDYuNzEgICAgIGM2LjExOSwwLDExLjg3NC0yLjM4MiwxNi4yMDItNi43MWM4LjkzMy04LjkzNCw4LjkzMy0yMy40NywwLTMyLjQwM2MtNC4zMjctNC4zMjgtMTAuMDgzLTYuNzExLTE2LjIwMi02LjcxMSAgICAgQzMyNS4zNjgsMTIyLjQ3OSwzMTkuNjEzLDEyNC44NiwzMTUuMjg1LDEyOS4xODl6IE0zMzYuMjU0LDE1MC4xNmMtMS4yNzMsMS4yNzMtMi45NjcsMS45NzQtNC43NjksMS45NzQgICAgIGMtMS44MDIsMC0zLjQ5NS0wLjcwMS00Ljc3LTEuOTc0Yy0yLjYzLTIuNjMtMi42My02LjkxLTAuMDAxLTkuNTM5YzEuMjc0LTEuMjc0LDIuOTY4LTEuOTc1LDQuNzcxLTEuOTc1ICAgICBjMS44MDEsMCwzLjQ5NCwwLjcwMSw0Ljc2OSwxLjk3NEMzMzguODg0LDE0My4yNSwzMzguODg0LDE0Ny41MywzMzYuMjU0LDE1MC4xNnoiIGZpbGw9IiNGRkZGRkYiLz4KCQkJPHBhdGggZD0iTTc1LjY5NSwzMzYuOTI2Yy00LjMyOS00LjMyNi0xMC4wODItNi43MDktMTYuMjAyLTYuNzA5Yy02LjEyLDAtMTEuODczLDIuMzgzLTE2LjIwMSw2LjcxICAgICBjLTguOTM0LDguOTM1LTguOTM0LDIzLjQ3LDAsMzIuNDA0YzQuMzI3LDQuMzI4LDEwLjA4LDYuNzEyLDE2LjIwMSw2LjcxMnMxMS44NzQtMi4zODQsMTYuMjAzLTYuNzExICAgICBDODQuNjI5LDM2MC4zOTYsODQuNjI5LDM0NS44NjIsNzUuNjk1LDMzNi45MjZ6IE02NC4yNjIsMzU3Ljg5OGMtMS4yNzMsMS4yNzQtMi45NjcsMS45NzctNC43NywxLjk3NyAgICAgYy0xLjgsMC0zLjQ5NC0wLjcwMi00Ljc2OS0xLjk3N2MtMi42MzEtMi42MjktMi42MzEtNi45MDktMC4wMDEtOS41MzhjMS4yNzMtMS4yNzMsMi45NjctMS45NzUsNC43Ny0xLjk3NSAgICAgczMuNDk2LDAuNzAxLDQuNzcsMS45NzVDNjYuODkzLDM1MC45ODksNjYuODkzLDM1NS4yNjksNjQuMjYyLDM1Ny44OTh6IiBmaWxsPSIjRkZGRkZGIi8+CgkJCTxwYXRoIGQ9Ik00NzMuMTUsMzM2LjkyNmMtNC4zMjktNC4zMjYtMTAuMDgyLTYuNzA5LTE2LjIwMS02LjcwOWMtNi4xMjEsMC0xMS44NzMsMi4zODMtMTYuMjAyLDYuNzEgICAgIGMtOC45MzMsOC45MzUtOC45MzMsMjMuNDcsMCwzMi40MDRjNC4zMjgsNC4zMjgsMTAuMDgxLDYuNzEyLDE2LjIwMiw2LjcxMmM2LjEyLDAsMTEuODczLTIuMzg0LDE2LjIwMi02LjcxMSAgICAgQzQ4Mi4wODQsMzYwLjM5Niw0ODIuMDg0LDM0NS44NjIsNDczLjE1LDMzNi45MjZ6IE00NjEuNzE5LDM1Ny44OThjLTEuMjc0LDEuMjc0LTIuOTY4LDEuOTc3LTQuNzcsMS45NzcgICAgIGMtMS44MDEsMC0zLjQ5NS0wLjcwMi00Ljc2OS0xLjk3N2MtMi42MzEtMi42MjktMi42MzEtNi45MDktMC4wMDItOS41MzhjMS4yNzQtMS4yNzMsMi45NjgtMS45NzUsNC43NzEtMS45NzUgICAgIGMxLjgwMSwwLDMuNDk2LDAuNzAxLDQuNzcsMS45NzVDNDY0LjM0OSwzNTAuOTg5LDQ2NC4zNDksMzU1LjI2OSw0NjEuNzE5LDM1Ny44OTh6IiBmaWxsPSIjRkZGRkZGIi8+CgkJCTxwYXRoIGQ9Ik0xODYuODkyLDkzLjI0NWM2LjEyLDAsMTEuODczLTIuMzgzLDE2LjIwMS02LjcxMWM0LjMyNy00LjMyOCw2LjcxMS0xMC4wODIsNi43MTEtMTYuMjAyICAgICBjMC02LjEyMS0yLjM4NC0xMS44NzQtNi43MTEtMTYuMmMtNC4zMjgtNC4zMjktMTAuMDgxLTYuNzEyLTE2LjIwMS02LjcxMmMtNi4xMjIsMC0xMS44NzQsMi4zODMtMTYuMjAyLDYuNzExICAgICBjLTQuMzI4LDQuMzI3LTYuNzEyLDEwLjA4LTYuNzEyLDE2LjIwMXMyLjM4NCwxMS44NzQsNi43MTEsMTYuMjAyQzE3NS4wMTgsOTAuODYxLDE4MC43Nyw5My4yNDUsMTg2Ljg5Miw5My4yNDV6ICAgICAgTTE4Mi4xMjIsNjUuNTYyYzEuMjczLTEuMjc0LDIuOTY4LTEuOTc1LDQuNzcxLTEuOTc1YzEuOCwwLDMuNDkzLDAuNzAxLDQuNzY5LDEuOTc2YzEuMjczLDEuMjczLDEuOTc3LDIuOTY3LDEuOTc3LDQuNzY5ICAgICBjMCwxLjgwMi0wLjcwMywzLjQ5NS0xLjk3Nyw0Ljc3MWMtMS4yNzQsMS4yNzMtMi45NjgsMS45NzUtNC43NjksMS45NzVjLTEuODAyLDAtMy40OTYtMC43MDItNC43NzEtMS45NzYgICAgIGMtMS4yNzQtMS4yNzQtMS45NzYtMi45NjctMS45NzYtNC43N0MxODAuMTQ2LDY4LjUzMSwxODAuODQ4LDY2LjgzNiwxODIuMTIyLDY1LjU2MnoiIGZpbGw9IiNGRkZGRkYiLz4KCQkJPGNpcmNsZSBjeD0iNjQuNDA5IiBjeT0iMTYwLjIyIiByPSIxMC40OTYiIGZpbGw9IiNGRkZGRkYiLz4KCQkJPGNpcmNsZSBjeD0iNDExLjM5IiBjeT0iMzc0LjExNSIgcj0iMTAuNDk2IiBmaWxsPSIjRkZGRkZGIi8+CgkJCTxjaXJjbGUgY3g9IjczLjc1IiBjeT0iNDM5LjM0MyIgcj0iMTAuNDk3IiBmaWxsPSIjRkZGRkZGIi8+CgkJCTxwYXRoIGQ9Ik0zODcuOTI5LDE0OC45NTFjMi4xMDcsMCw0LjIxMy0wLjgxOSw1Ljc5OS0yLjQ0OGwxMS4yMy0xMS41NTNjMy4xMTEtMy4yMDEsMy4wMzktOC4zMTktMC4xNjItMTEuNDMxICAgICBjLTMuMTk5LTMuMTEyLTguMzE4LTMuMDM5LTExLjQzMSwwLjE2MmwtMTEuMjMsMTEuNTUyYy0zLjExMSwzLjIwMS0zLjA0LDguMzE5LDAuMTYyLDExLjQzMSAgICAgQzM4My44NjgsMTQ4LjE5MiwzODUuODk5LDE0OC45NTEsMzg3LjkyOSwxNDguOTUxeiIgZmlsbD0iI0ZGRkZGRiIvPgoJCQk8cGF0aCBkPSJNMTQ4LjgyMiwxMzYuMTgybDE0LjkzNyw2LjA0YzAuOTkzLDAuNDAxLDIuMDIsMC41OTEsMy4wMjcsMC41OTFjMy4xOTcsMCw2LjIyNy0xLjkwOSw3LjQ5Ny01LjA1NiAgICAgYzEuNjc0LTQuMTM5LTAuMzI1LTguODUxLTQuNDY0LTEwLjUyNGwtMTQuOTM4LTYuMDRjLTQuMTQ2LTEuNjc2LTguODUxLDAuMzI2LTEwLjUyNCw0LjQ2NCAgICAgQzE0Mi42ODQsMTI5Ljc5NywxNDQuNjgzLDEzNC41MDgsMTQ4LjgyMiwxMzYuMTgyeiIgZmlsbD0iI0ZGRkZGRiIvPgoJCQk8cGF0aCBkPSJNOTYuMDMzLDM5Mi42NzNsLTE0LjkzOC02LjA0Yy00LjE0Ni0xLjY3NC04Ljg1MSwwLjMyNS0xMC41MjQsNC40NjRjLTEuNjczLDQuMTQsMC4zMjYsOC44NTIsNC40NjUsMTAuNTI0bDE0LjkzOCw2LjA0MSAgICAgYzAuOTkzLDAuNCwyLjAxOSwwLjU5MSwzLjAyNiwwLjU5MWMzLjE5NywwLDYuMjI3LTEuOTA4LDcuNDk3LTUuMDU2QzEwMi4xNzEsMzk5LjA1OSwxMDAuMTcyLDM5NC4zNDcsOTYuMDMzLDM5Mi42NzN6IiBmaWxsPSIjRkZGRkZGIi8+CgkJCTxwYXRoIGQ9Ik00MzYuOTQ1LDQyMC4yODRsLTE0LjkzNy02LjA0Yy00LjE0Ni0xLjY3My04Ljg1MiwwLjMyNi0xMC41MjQsNC40NjVjLTEuNjc0LDQuMTQsMC4zMjUsOC44NTIsNC40NjQsMTAuNTI0bDE0LjkzOCw2LjA0ICAgICBjMC45OTMsMC40LDIuMDE5LDAuNTkyLDMuMDI3LDAuNTkyYzMuMTk2LDAsNi4yMjYtMS45MSw3LjQ5Ny01LjA1N0M0NDMuMDgzLDQyNi42NjksNDQxLjA4NSw0MjEuOTU3LDQzNi45NDUsNDIwLjI4NHoiIGZpbGw9IiNGRkZGRkYiLz4KCQk8L2c+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==);url(data: image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIuMDAxIDUxMi4wMDEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMi4wMDEgNTEyLjAwMTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSIzMnB4IiBoZWlnaHQ9IjMycHgiPgo8Zz4KCTxnPgoJCTxnPgoJCQk8cGF0aCBkPSJNMzY2LjkwNSwzNjUuMDcxbDg3LjkwMi04NS42ODNjNi4wODctNS45MzUsOC4yMzYtMTQuNjQzLDUuNjEtMjIuNzI5Yy0yLjYyOS04LjA4NS05LjQ4Ni0xMy44NjYtMTcuODk4LTE1LjA4NyAgICAgbC01NS44NzktOC4xMmMtNC40MTMtMC42NDctOC41MjEsMi40MTktOS4xNjEsNi44MzdjLTAuNjQzLDQuNDE5LDIuNDE4LDguNTIxLDYuODM3LDkuMTYzbDU1Ljg3OSw4LjEyICAgICBjMi4yNzgsMC4zMyw0LjEzNSwxLjg5Niw0Ljg0Nyw0LjA4M2MwLjcxMSwyLjE5LDAuMTI5LDQuNTQ4LTEuNTE5LDYuMTU0bC05MC45NDcsODguNjVjLTEuOTA1LDEuODU4LTIuNzczLDQuNTMzLTIuMzIzLDcuMTU1ICAgICBsMjEuNDY5LDEyNS4xNzhjMC4zODksMi4yNjgtMC41MjcsNC41MTgtMi4zODcsNS44NjljLTEuODE2LDEuMzE4LTQuMzM5LDEuNTAyLTYuMzIyLDAuNDU5bC0xMTIuNDE0LTU5LjEwMSAgICAgYy0yLjM1NS0xLjIzNy01LjE2OS0xLjIzNy03LjUyNCwwbC0xMTIuNDE0LDU5LjEwMWMtMi4wMzgsMS4wNy00LjQ2LDAuODkzLTYuMzIyLTAuNDU4Yy0xLjg2MS0xLjM1My0yLjc3NS0zLjYwMi0yLjM4OC01Ljg3ICAgICBsMjEuNDctMTI1LjE3N2MwLjQ1LTIuNjIyLTAuNDItNS4yOTctMi4zMjQtNy4xNTVsLTkwLjk0Ni04OC42NDljLTEuNjQ4LTEuNjA3LTIuMjI5LTMuOTY2LTEuNTItNi4xNTUgICAgIGMwLjcxMi0yLjE4OCwyLjU2Ny0zLjc1Myw0Ljg0Ni00LjA4M2wxMjUuNjg0LTE4LjI2M2MyLjYzMy0wLjM4Miw0LjkxLTIuMDM2LDYuMDg3LTQuNDIybDU2LjIwOS0xMTMuODkxICAgICBjMS4wMTktMi4wNjMsMy4wOC0zLjM0NSw1LjM4Mi0zLjM0NXM0LjM2NCwxLjI4MSw1LjM4MywzLjM0NWw1Ni4yMDcsMTEzLjg5YzEuMTc4LDIuMzg1LDMuNDUzLDQuMDM5LDYuMDg4LDQuNDIybDQyLjM5NSw2LjE2ICAgICBjNC40MDUsMC42NDEsOC41Mi0yLjQxOCw5LjE2MS02LjgzN2MwLjY0My00LjQxOC0yLjQxOC04LjUyMS02LjgzNy05LjE2MmwtMzguMTktNS41NDlsLTU0LjMyNi0xMTAuMDc3ICAgICBjLTMuNzYxLTcuNjI0LTExLjM3OS0xMi4zNTktMTkuODgtMTIuMzU5Yy04LjUwMSwwLTE2LjExOSw0LjczNi0xOS44NzksMTIuMzU4bC01NC4zMjgsMTEwLjA3OEw1MS4xNDksMjQxLjU3MiAgICAgYy04LjQxMiwxLjIyMi0xNS4yNyw3LjAwMy0xNy44OTcsMTUuMDg5Yy0yLjYyNiw4LjA4NC0wLjQ3OCwxNi43OTIsNS42MSwyMi43MjhsODcuOTAyLDg1LjY4MmwtMjAuNzUsMTIwLjk4OSAgICAgYy0xLjQzOCw4LjM3NywxLjk0LDE2LjY4NSw4LjgxOCwyMS42ODNjMy44ODgsMi44MjMsOC40MzQsNC4yNTgsMTMuMDExLDQuMjU4YzMuNTIzLDAsNy4wNjUtMC44NSwxMC4zMzctMi41NjlsMTA4LjY1NC01Ny4xMjIgICAgIGwxMDguNjU3LDU3LjEyNGMzLjE3LDEuNjYzLDYuNzM1LDIuNTQzLDEwLjMxMiwyLjU0M2M0LjcxNCwwLDkuMjE5LTEuNDY0LDEzLjAzNC00LjIzNGM2Ljg3Ni00Ljk5OCwxMC4yNTYtMTMuMzA3LDguODE3LTIxLjY4MyAgICAgTDM2Ni45MDUsMzY1LjA3MXoiIGZpbGw9IiNjY2NjY2MiLz4KCQkJPHBhdGggZD0iTTM4OS40MjgsMjAyLjMxM2MwLjcwNi01LjE3OSw3Ljc4LTEzLjU2NSwyOS44MTYtMTIuMTY1YzEuMzU1LDAuMDg2LDIuNjUxLDAuMTI4LDMuOTAxLDAuMTI4ICAgICBjMjcuNjk5LTAuMDAyLDMwLjA1NC0yMC42MzksMzEuNjMtMzQuNDk4YzAuODc0LTcuNjc3LDEuNjk5LTE0LjkyOCw1LjI3NS0yMC4wNTNjMi41NTMtMy42NjIsMS42NTMtOC43MDEtMi4wMDctMTEuMjU0ICAgICBjLTMuNjYyLTIuNTUyLTguNzAxLTEuNjU1LTExLjI1NSwyLjAwNmMtNS45MTQsOC40ODEtNy4wNjMsMTguNTctOC4wNzYsMjcuNDczYy0xLjc0NiwxNS4zNDMtMi40MSwyMS4wODctMTguNDM4LDIwLjA2MyAgICAgYy0xNy42NjQtMS4xMjctMzAuODYsMi42NTYtMzkuMjMyLDExLjI0MmMtNi44NTQsNy4wMjktNy42NDQsMTQuNzIyLTcuNzExLDE1LjU3NmwxNi4xMTcsMS4yNzUgICAgIEMzODkuNDQ5LDIwMi4xMDYsMzg5LjQ0NywyMDIuMTc5LDM4OS40MjgsMjAyLjMxM3oiIGZpbGw9IiNjY2NjY2MiLz4KCQkJPHBhdGggZD0iTTI4Ni43NzUsOTEuMTdjMC4xNi0wLjA4NiwwLjI1NC0wLjExOSwwLjI1NC0wLjExOWw2LjUyMSwxNC43OTVjNy45MzQtMy40OTYsMTkuOTQ1LTE3LjE5Miw4LjYxNy00My45OTkgICAgIGMtNC4xMzUtOS43ODktMi4xMjUtMTEuMTMxLDkuMjUtMTYuNjE4YzExLjExLTUuMzYxLDI3LjkwMi0xMy40NjIsMjMuNDcxLTM4LjU1MWMtMC43NzUtNC4zOTctNC45NjItNy4zMjctOS4zNjctNi41NTUgICAgIGMtNC4zOTcsMC43NzctNy4zMyw0Ljk3MS02LjU1NCw5LjM2N2MyLjIwNSwxMi40OC0zLjE3NywxNS42NzgtMTQuNTc2LDIxLjE3N2MtMTAuMjM3LDQuOTM5LTI3LjM3LDEzLjIwNS0xNy4xMTYsMzcuNDc0ICAgICBDMjkzLjQ1OSw4Mi43NzksMjg5Ljg3MSw4OS41MDUsMjg2Ljc3NSw5MS4xN3oiIGZpbGw9IiNjY2NjY2MiLz4KCQkJPHBhdGggZD0iTTgwLjI2OCw4NC43NDljMTIuMzE0LDIuNzk2LDE0LjU3NiwzLjY1MywxMi43NCwxNC4xMmMtNS4wMjgsMjguNjY1LDkuNzUsMzkuMzE5LDE4LjI2Niw0MC45NDYgICAgIGMwLjUxMywwLjA5OSwxLjAyMywwLjE0NiwxLjUyNywwLjE0NmMzLjgwMiwwLDcuMTktMi42OTUsNy45MzEtNi41NjdjMC44MzgtNC4zODYtMi4wMzctOC42Mi02LjQyMy05LjQ1OCAgICAgYy0wLjA4OS0wLjAxNy04LjgyNy0yLjYtNS4zNzYtMjIuMjczYzQuNTQ5LTI1Ljk1LTE0LjAwMS0zMC4xNjMtMjUuMDg1LTMyLjY4Yy0xMi4zNDEtMi44MDMtMTguMzAzLTQuNzEyLTE4Ljk1My0xNy4zNjkgICAgIGMtMC4yMjktNC40NTgtNC4wMDYtNy44OTQtOC40ODgtNy42NTljLTQuNDU4LDAuMjI5LTcuODg4LDQuMDI5LTcuNjU4LDguNDg4QzUwLjA1Niw3Ny44ODgsNjguMjM3LDgyLjAxNiw4MC4yNjgsODQuNzQ5eiIgZmlsbD0iI2NjY2NjYyIvPgoJCQk8cGF0aCBkPSJNMTA1LjIzOSwxODEuMTEzYzAsNi4xMjEsMi4zODIsMTEuODc0LDYuNzEsMTYuMjAxYzQuMzI4LDQuMzI4LDEwLjA4MSw2LjcxMSwxNi4yMDEsNi43MTEgICAgIGM2LjEyLDAsMTEuODc0LTIuMzgzLDE2LjIwMi02LjcxYzQuMzI4LTQuMzI4LDYuNzEyLTEwLjA4MSw2LjcxMi0xNi4yMDJzLTIuMzg0LTExLjg3NC02LjcxMS0xNi4yMDIgICAgIGMtNC4zMjktNC4zMjgtMTAuMDgyLTYuNzExLTE2LjIwMy02LjcxMXMtMTEuODczLDIuMzgzLTE2LjIwMSw2LjcxMUMxMDcuNjIxLDE2OS4yMzksMTA1LjIzOSwxNzQuOTkyLDEwNS4yMzksMTgxLjExM3ogICAgICBNMTIzLjM4MiwxNzYuMzQyYzEuMjczLTEuMjczLDIuOTY4LTEuOTc1LDQuNzY5LTEuOTc1YzEuODAyLDAsMy40OTUsMC43MDIsNC43NywxLjk3NmMxLjI3NSwxLjI3NCwxLjk3OCwyLjk2OCwxLjk3OCw0Ljc3ICAgICBzLTAuNzAyLDMuNDk0LTEuOTc2LDQuNzY5Yy0xLjI3NSwxLjI3NC0yLjk2OSwxLjk3Ni00Ljc3MiwxLjk3NmMtMS44LDAtMy40OTQtMC43MDItNC43Ny0xLjk3NiAgICAgYy0xLjI3My0xLjI3My0xLjk3NS0yLjk2Ny0xLjk3NS00Ljc2OUMxMjEuNDA1LDE3OS4zMTIsMTIyLjEwNiwxNzcuNjE4LDEyMy4zODIsMTc2LjM0MnoiIGZpbGw9IiNjY2NjY2MiLz4KCQkJPHBhdGggZD0iTTMxNS4yODUsMTI5LjE4OWMtOC45MzMsOC45MzQtOC45MzMsMjMuNDcsMC4wMDEsMzIuNDA0YzQuMzI4LDQuMzI4LDEwLjA4Miw2LjcxLDE2LjIwMSw2LjcxICAgICBjNi4xMTksMCwxMS44NzQtMi4zODIsMTYuMjAyLTYuNzFjOC45MzMtOC45MzQsOC45MzMtMjMuNDcsMC0zMi40MDNjLTQuMzI3LTQuMzI4LTEwLjA4My02LjcxMS0xNi4yMDItNi43MTEgICAgIEMzMjUuMzY4LDEyMi40NzksMzE5LjYxMywxMjQuODYsMzE1LjI4NSwxMjkuMTg5eiBNMzM2LjI1NCwxNTAuMTZjLTEuMjczLDEuMjczLTIuOTY3LDEuOTc0LTQuNzY5LDEuOTc0ICAgICBjLTEuODAyLDAtMy40OTUtMC43MDEtNC43Ny0xLjk3NGMtMi42My0yLjYzLTIuNjMtNi45MS0wLjAwMS05LjUzOWMxLjI3NC0xLjI3NCwyLjk2OC0xLjk3NSw0Ljc3MS0xLjk3NSAgICAgYzEuODAxLDAsMy40OTQsMC43MDEsNC43NjksMS45NzRDMzM4Ljg4NCwxNDMuMjUsMzM4Ljg4NCwxNDcuNTMsMzM2LjI1NCwxNTAuMTZ6IiBmaWxsPSIjY2NjY2NjIi8+CgkJCTxwYXRoIGQ9Ik03NS42OTUsMzM2LjkyNmMtNC4zMjktNC4zMjYtMTAuMDgyLTYuNzA5LTE2LjIwMi02LjcwOWMtNi4xMiwwLTExLjg3MywyLjM4My0xNi4yMDEsNi43MSAgICAgYy04LjkzNCw4LjkzNS04LjkzNCwyMy40NywwLDMyLjQwNGM0LjMyNyw0LjMyOCwxMC4wOCw2LjcxMiwxNi4yMDEsNi43MTJzMTEuODc0LTIuMzg0LDE2LjIwMy02LjcxMSAgICAgQzg0LjYyOSwzNjAuMzk2LDg0LjYyOSwzNDUuODYyLDc1LjY5NSwzMzYuOTI2eiBNNjQuMjYyLDM1Ny44OThjLTEuMjczLDEuMjc0LTIuOTY3LDEuOTc3LTQuNzcsMS45NzcgICAgIGMtMS44LDAtMy40OTQtMC43MDItNC43NjktMS45NzdjLTIuNjMxLTIuNjI5LTIuNjMxLTYuOTA5LTAuMDAxLTkuNTM4YzEuMjczLTEuMjczLDIuOTY3LTEuOTc1LDQuNzctMS45NzUgICAgIHMzLjQ5NiwwLjcwMSw0Ljc3LDEuOTc1QzY2Ljg5MywzNTAuOTg5LDY2Ljg5MywzNTUuMjY5LDY0LjI2MiwzNTcuODk4eiIgZmlsbD0iI2NjY2NjYyIvPgoJCQk8cGF0aCBkPSJNNDczLjE1LDMzNi45MjZjLTQuMzI5LTQuMzI2LTEwLjA4Mi02LjcwOS0xNi4yMDEtNi43MDljLTYuMTIxLDAtMTEuODczLDIuMzgzLTE2LjIwMiw2LjcxICAgICBjLTguOTMzLDguOTM1LTguOTMzLDIzLjQ3LDAsMzIuNDA0YzQuMzI4LDQuMzI4LDEwLjA4MSw2LjcxMiwxNi4yMDIsNi43MTJjNi4xMiwwLDExLjg3My0yLjM4NCwxNi4yMDItNi43MTEgICAgIEM0ODIuMDg0LDM2MC4zOTYsNDgyLjA4NCwzNDUuODYyLDQ3My4xNSwzMzYuOTI2eiBNNDYxLjcxOSwzNTcuODk4Yy0xLjI3NCwxLjI3NC0yLjk2OCwxLjk3Ny00Ljc3LDEuOTc3ICAgICBjLTEuODAxLDAtMy40OTUtMC43MDItNC43NjktMS45NzdjLTIuNjMxLTIuNjI5LTIuNjMxLTYuOTA5LTAuMDAyLTkuNTM4YzEuMjc0LTEuMjczLDIuOTY4LTEuOTc1LDQuNzcxLTEuOTc1ICAgICBjMS44MDEsMCwzLjQ5NiwwLjcwMSw0Ljc3LDEuOTc1QzQ2NC4zNDksMzUwLjk4OSw0NjQuMzQ5LDM1NS4yNjksNDYxLjcxOSwzNTcuODk4eiIgZmlsbD0iI2NjY2NjYyIvPgoJCQk8cGF0aCBkPSJNMTg2Ljg5Miw5My4yNDVjNi4xMiwwLDExLjg3My0yLjM4MywxNi4yMDEtNi43MTFjNC4zMjctNC4zMjgsNi43MTEtMTAuMDgyLDYuNzExLTE2LjIwMiAgICAgYzAtNi4xMjEtMi4zODQtMTEuODc0LTYuNzExLTE2LjJjLTQuMzI4LTQuMzI5LTEwLjA4MS02LjcxMi0xNi4yMDEtNi43MTJjLTYuMTIyLDAtMTEuODc0LDIuMzgzLTE2LjIwMiw2LjcxMSAgICAgYy00LjMyOCw0LjMyNy02LjcxMiwxMC4wOC02LjcxMiwxNi4yMDFzMi4zODQsMTEuODc0LDYuNzExLDE2LjIwMkMxNzUuMDE4LDkwLjg2MSwxODAuNzcsOTMuMjQ1LDE4Ni44OTIsOTMuMjQ1eiAgICAgIE0xODIuMTIyLDY1LjU2MmMxLjI3My0xLjI3NCwyLjk2OC0xLjk3NSw0Ljc3MS0xLjk3NWMxLjgsMCwzLjQ5MywwLjcwMSw0Ljc2OSwxLjk3NmMxLjI3MywxLjI3MywxLjk3NywyLjk2NywxLjk3Nyw0Ljc2OSAgICAgYzAsMS44MDItMC43MDMsMy40OTUtMS45NzcsNC43NzFjLTEuMjc0LDEuMjczLTIuOTY4LDEuOTc1LTQuNzY5LDEuOTc1Yy0xLjgwMiwwLTMuNDk2LTAuNzAyLTQuNzcxLTEuOTc2ICAgICBjLTEuMjc0LTEuMjc0LTEuOTc2LTIuOTY3LTEuOTc2LTQuNzdDMTgwLjE0Niw2OC41MzEsMTgwLjg0OCw2Ni44MzYsMTgyLjEyMiw2NS41NjJ6IiBmaWxsPSIjY2NjY2NjIi8+CgkJCTxjaXJjbGUgY3g9IjY0LjQwOSIgY3k9IjE2MC4yMiIgcj0iMTAuNDk2IiBmaWxsPSIjY2NjY2NjIi8+CgkJCTxjaXJjbGUgY3g9IjQxMS4zOSIgY3k9IjM3NC4xMTUiIHI9IjEwLjQ5NiIgZmlsbD0iI2NjY2NjYyIvPgoJCQk8Y2lyY2xlIGN4PSI3My43NSIgY3k9IjQzOS4zNDMiIHI9IjEwLjQ5NyIgZmlsbD0iI2NjY2NjYyIvPgoJCQk8cGF0aCBkPSJNMzg3LjkyOSwxNDguOTUxYzIuMTA3LDAsNC4yMTMtMC44MTksNS43OTktMi40NDhsMTEuMjMtMTEuNTUzYzMuMTExLTMuMjAxLDMuMDM5LTguMzE5LTAuMTYyLTExLjQzMSAgICAgYy0zLjE5OS0zLjExMi04LjMxOC0zLjAzOS0xMS40MzEsMC4xNjJsLTExLjIzLDExLjU1MmMtMy4xMTEsMy4yMDEtMy4wNCw4LjMxOSwwLjE2MiwxMS40MzEgICAgIEMzODMuODY4LDE0OC4xOTIsMzg1Ljg5OSwxNDguOTUxLDM4Ny45MjksMTQ4Ljk1MXoiIGZpbGw9IiNjY2NjY2MiLz4KCQkJPHBhdGggZD0iTTE0OC44MjIsMTM2LjE4MmwxNC45MzcsNi4wNGMwLjk5MywwLjQwMSwyLjAyLDAuNTkxLDMuMDI3LDAuNTkxYzMuMTk3LDAsNi4yMjctMS45MDksNy40OTctNS4wNTYgICAgIGMxLjY3NC00LjEzOS0wLjMyNS04Ljg1MS00LjQ2NC0xMC41MjRsLTE0LjkzOC02LjA0Yy00LjE0Ni0xLjY3Ni04Ljg1MSwwLjMyNi0xMC41MjQsNC40NjQgICAgIEMxNDIuNjg0LDEyOS43OTcsMTQ0LjY4MywxMzQuNTA4LDE0OC44MjIsMTM2LjE4MnoiIGZpbGw9IiNjY2NjY2MiLz4KCQkJPHBhdGggZD0iTTk2LjAzMywzOTIuNjczbC0xNC45MzgtNi4wNGMtNC4xNDYtMS42NzQtOC44NTEsMC4zMjUtMTAuNTI0LDQuNDY0Yy0xLjY3Myw0LjE0LDAuMzI2LDguODUyLDQuNDY1LDEwLjUyNGwxNC45MzgsNi4wNDEgICAgIGMwLjk5MywwLjQsMi4wMTksMC41OTEsMy4wMjYsMC41OTFjMy4xOTcsMCw2LjIyNy0xLjkwOCw3LjQ5Ny01LjA1NkMxMDIuMTcxLDM5OS4wNTksMTAwLjE3MiwzOTQuMzQ3LDk2LjAzMywzOTIuNjczeiIgZmlsbD0iI2NjY2NjYyIvPgoJCQk8cGF0aCBkPSJNNDM2Ljk0NSw0MjAuMjg0bC0xNC45MzctNi4wNGMtNC4xNDYtMS42NzMtOC44NTIsMC4zMjYtMTAuNTI0LDQuNDY1Yy0xLjY3NCw0LjE0LDAuMzI1LDguODUyLDQuNDY0LDEwLjUyNGwxNC45MzgsNi4wNCAgICAgYzAuOTkzLDAuNCwyLjAxOSwwLjU5MiwzLjAyNywwLjU5MmMzLjE5NiwwLDYuMjI2LTEuOTEsNy40OTctNS4wNTdDNDQzLjA4Myw0MjYuNjY5LDQ0MS4wODUsNDIxLjk1Nyw0MzYuOTQ1LDQyMC4yODR6IiBmaWxsPSIjY2NjY2NjIi8+CgkJPC9nPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=);background-size: 34px;background-repeat: no-repeat;text-align: right;background-position: 16px 17px;">
<a class="star_icon" href="https://wordpress.org/support/view/plugin-reviews/accelerated-mobile-pages?rate=5#new-post" target="_blank" style=" color: #fff;
    text-decoration: none;
    font-size: 16px;
    line-height: 23px; font-weight: 300;"> Appreciate it?  <br> <span style="font-size: 11px;text-transform: uppercase;" title="Give Us 5 Star">Leave a Review →</span></a>

	    </div>
	    </div>
 
    
    <?php
    //update_option( 'AMPforwp_db_version', $ampforWPCurrentVersion );
}

if(!defined('AMP_FRAMEWORK_COMOPNENT_DIR_PATH')){
	define('AMP_FRAMEWORK_COMOPNENT_DIR_PATH', plugin_dir_path( __FILE__ )."/components"); 
}

require_once( AMP_FRAMEWORK_COMOPNENT_DIR_PATH . '/components-core.php' );
require_once(  AMPFORWP_PLUGIN_DIR. 'pagebuilder/amp-page-builder.php' );
require_once(  AMPFORWP_PLUGIN_DIR. 'base_remover/base_remover.php' );
require_once(  AMPFORWP_PLUGIN_DIR. 'includes/thirdparty-compatibility.php' );


require ( AMPFORWP_PLUGIN_DIR.'/install/index.php' );