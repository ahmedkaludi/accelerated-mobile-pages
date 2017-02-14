<?php
/*
Plugin Name: Accelerated Mobile Pages
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP for WP - Accelerated Mobile Pages for WordPress
Version: 0.9.43.1
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: https://ampforwp.com/
Donate link: https://www.paypal.me/Kaludi/5
License: GPL2
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define('AMPFORWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('AMPFORWP_DISQUS_URL',plugin_dir_url(__FILE__).'includes/disqus.php');
define('AMPFORWP_IMAGE_DIR',plugin_dir_url(__FILE__).'images');
define('AMPFORWP_VERSION','0.9.43.1');

// Rewrite the Endpoints after the plugin is activate, as priority is set to 11
function ampforwp_add_custom_post_support() {
	global $redux_builder_amp;
	if( $redux_builder_amp['amp-on-off-for-all-pages'] ) {
		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PAGES | EP_PERMALINK | EP_ALL_ARCHIVES | EP_ROOT );
		add_post_type_support( 'page', AMP_QUERY_VAR );
	}
}
add_action( 'init', 'ampforwp_add_custom_post_support',11);

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

}
add_action( 'init', 'ampforwp_add_custom_rewrite_rules' );

register_activation_hook( __FILE__, 'ampforwp_rewrite_activation', 20 );
function ampforwp_rewrite_activation() {

    ampforwp_add_custom_post_support();
    ampforwp_add_custom_rewrite_rules();
    // Flushing rewrite urls ONLY on activation
	global $wp_rewrite;
	$wp_rewrite->flush_rules();

}

register_deactivation_hook( __FILE__, 'ampforwp_rewrite_deactivate', 20 );
function ampforwp_rewrite_deactivate() {
	// Flushing rewrite urls ONLY on deactivation
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}

// Redux panel inclusion code
	if ( !class_exists( 'ReduxFramework' ) ) {
	    require_once dirname( __FILE__ ).'/includes/options/redux-core/framework.php';
	}
	// Register all the main options
	require_once dirname( __FILE__ ).'/includes/options/admin-config.php';

/*
 * Load Files only in the backend
 * As we don't need plugin activation code to run everytime the site loads
*/
if ( is_admin() ) {
	add_action('init','ampforwp_plugin_notice');
	function  ampforwp_plugin_notice() {

		if ( ! defined( 'AMP__FILE__' ) ) {
			add_action( 'admin_notices', 'ampforwp_plugin_not_found_notice' );
			function ampforwp_plugin_not_found_notice() { ?>

				<div class="notice notice-error is-dismissible">

						<?php add_thickbox(); ?>
				        <p>
                        <strong><?php _e( 'AMP Installation requires one last step:', 'ampforwp' ); ?></strong> <?php _e( 'AMP by Automattic plugin is not active', 'ampforwp' ); ?>
				         <strong>	<span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;"><a href="plugin-install.php?s=amp&tab=search&type=term"><?php _e( 'Continue Installation', 'ampforwp' ); ?></a> | <a href="https://www.youtube.com/embed/zzRy6Q_VGGc?TB_iframe=true&?rel=0&?autoplay=1" onclick="javascript:_gaq.push(['_trackEvent','outbound-article','https://www.youtube.com/embed/zzRy6Q_VGGc?TB_iframe=true&?rel=0&?autoplay=1']);" class="thickbox"><?php _e( 'More Information', 'ampforwp' ); ?></a>
                             </span> </strong>
				        </p>
				</div> <?php
			}

			add_action('admin_head','ampforwp_required_plugin_styling');
			function ampforwp_required_plugin_styling() { ?>
				<style>
					.plugin-card.plugin-card-amp:before{
                        content: "Install & Activate this plugin ↓";
                        font-weight: bold;
                        left: 50%;
                        position: relative;
                        top: 9px;
                        font-size: 16px;
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
		} else {
			// add_action('admin_notices', 'ampforwp_permalink_update_notice');
		}

	}

	// display custom admin notice
	function ampforwp_permalink_update_notice() { ?>
		<div class="notice notice-warning is-dismissible">
			<p>
		        <?php _e( 'Congratulation, your site is fully AMP enabled. Update your permalink setting once and you are done.', 'ampforwp' ); ?>
		         <strong>	<span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;"><a href="<?php echo admin_url( 'options-permalink.php'); ?>"><?php _e( 'Update Permalink', 'ampforwp' ); ?></a> | <a href="#"><?php _e( 'Dismiss', 'ampforwp' ); ?></a>
	             </span> </strong>
	        </p>
		</div>
	<?php }

 	// Add Settings Button in Plugin backend
 	if ( ! function_exists( 'ampforwp_plugin_settings_link' ) ) {

 		add_filter( 'plugin_action_links', 'ampforwp_plugin_settings_link', 10, 5 );

 		function ampforwp_plugin_settings_link( $actions, $plugin_file )  {
 			static $plugin;
 			if (!isset($plugin))
 				$plugin = plugin_basename(__FILE__);
 				if ($plugin == $plugin_file) {
 					$settings = array('settings' => '<a href="admin.php?page=amp_options&tab=8">' . __('Settings', 'ampforwp') . '</a> | <a href="https://ampforwp.com/priority-support/#utm_source=options-panel&utm_medium=extension-tab_priority_support&utm_campaign=AMP%20Plugin">' . __('Premium Support', 'ampforwp') . '</a>');
					include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
					if ( is_plugin_active( 'amp/amp.php' ) ) {
					    //if parent plugin is activated
								$actions = array_merge( $actions, $settings );
					} else{
						if(is_plugin_active( 'amp/amp.php' )){
							$actions = array_merge( $actions, $settings );
						}else{
						$please_activate_parent_plugin = array('Please Activate Parent plugin' => '<a href="'.get_admin_url() .'plugin-install.php?s=amp&tab=search&type=term">' . __('<span style="color:#b30000">Action Required: Continue Installation</span>', 'ampforwp') . '</a>');
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