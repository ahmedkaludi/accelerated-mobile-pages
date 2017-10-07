<?php add_action( 'admin_init', 'ampforwp_welcome_screen_do_activation_redirect' );
function ampforwp_welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( 'ampforwp_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( 'ampforwp_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to welcome page
  wp_safe_redirect( add_query_arg( array( 'page' => 'ampforwp-welcome-page' ), admin_url( 'index.php' ) ) );
}

// add_action( 'admin_init', 'ampforwp_welcome_screen_do_activation_redirect_parent' );
function ampforwp_welcome_screen_do_activation_redirect_parent() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );

	// Bail if option is already set or plugin is deactivated
	if ( get_option( 'ampforwp_parent_plugin_check' ) || $amp_plugin_activation_check == false ) {
		return;
	}

	// Bail if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
		return;
	}

	// Redirect to welcome page
	wp_safe_redirect( add_query_arg( array( 'page' => 'ampforwp-welcome-page' ), admin_url( 'index.php' ) ) );

 	update_option( 'ampforwp_parent_plugin_check', true );
}

add_action('admin_menu', 'ampforwp_welcome_screen_pages');

function ampforwp_welcome_screen_pages() {
  add_dashboard_page(
    __('Welcome To AMPforWP plugin','accelerated-mobile-pages'),
    __('Welcome to AMP','accelerated-mobile-pages'),
    'manage_options',
    'ampforwp-welcome-page',
    'ampforwp_welcome_screen_content'
  );
}

function ampforwp_welcome_screen_content() {
  ?>
  	<div class="wrap">
	    <?php // echo ampforwp_plugin_parent_activation(); ?>

	    <div class="clear"></div>

	    <div class="ampforwp-post-installtion-instructions">

		    <h1 class="amp_installed_heading"><?php echo __('AMP is now Installed!','accelerated-mobile-pages') ?></h1>
			<div class="amp_installed_text"><p><?php echo __('Thank you so much for installing the AMPforWP plugin!','accelerated-mobile-pages') ?></p>
			<p><?php echo __('Our team works really hard to deliver good user experience to you.','accelerated-mobile-pages') ?></p></div>
            <div class="amp_user_onboarding">
            <div class="amp_new_user amp_user_onboarding_choose">
                <div class="amp_user_avatar"></div>
                <h3>I'm a New User!</h3>
                <p>We have recommend you to go through AMP installation wizard which helps setup the Basic AMP and get started immediatly.</p>
                <a href="<?php echo admin_url('plugins.php?page=ampforwptourinstaller&ampforwp_install=1');?>">Run Installation Wizard</a>
            </div>
            <div class="amp_expert_user amp_user_onboarding_choose">
                <div class="amp_user_avatar"></div>
                <h3>I'm an Experienced User!</h3>
                <p>We have many settings in Options Panel to help you setup the AMP perfectly to according to your taste & needs.</p>
                <a href="<?php echo admin_url('admin.php?page=amp_options');?>">AMP Options Panel</a>                    
            </div>
            <div class="clear"></div>
            </div>
 


		    <h1 style="color: #008606;font-weight: 300;margin-top: 35px;">
		    	<i class="dashicons dashicons-editor-help" style="font-size: 34px;margin-right: 18px;margin-top: -1px;"></i><?php echo __('Need Help?','accelerated-mobile-pages') ?>
		    </h1>
			<div class="amp_installed_text"><p><?php echo __('We\'re bunch of passionate people that are dedicated towards helping our users. We will be happy to help you!','accelerated-mobile-pages') ?></p></div>
		    
            <div class="getstarted_wrapper">
            <div class="getstarted_options">
            <p><b>Getting Started</b></p>
				<ul class="getstarted_ul">
					<li><a href="https://ampforwp.com/tutorials/article-categories/installation-updating/" target="_blank">Installation &amp; Setup</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/settings-options/" target="_blank">Settings &amp; Options</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/setup-amp/" target="_blank">Setup AMP</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/page-builder/" target="_blank">Page Builder</a></li>
				</ul>  
            </div>
            <div class="getstarted_options">
            <p><b>Useful Links</b></p>
				<ul class="getstarted_ul">
					<li><a href="https://ampforwp.com/tutorials/article-categories/extension/" target="_blank">Extensions &amp; Themes Docs</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/extending/" target="_blank">Developers Docs</a></li>
					<li><a href="https://ampforwp.com/amp-theme-framework/" target="_blank">Create a Custom Theme for AMP</a></li>
					<li><a href="https://ampforwp.com/tutorials/article-categories/how-to/" target="_blank">General How To's</a></li>
				</ul>  
            </div>
            <div class="clear"></div>
            </div>

		</div>

	</div> <?php
}

function ampforwp_plugin_parent_activation() {

	add_thickbox(); // @since 1.0.53

	include( ABSPATH . "wp-admin/includes/plugin-install.php" );
	global $tabs, $tab, $paged, $type, $term;
	$tabs = array();
	$tab = "slug";
	$per_page = 1;
	$args = array
    (
        "slug"      => "amp",
		"page" 		=> $paged,
		"per_page" 	=> $per_page,
		"fields" 	=> array( "last_updated" => true, "short_description" => true,  "downloaded" => false, "icons" => true ),
		//"locale" 	=> get_locale(),
	);
	$args = apply_filters( "install_plugins_table_api_args_$tab", $args );
    $api = plugins_api( "plugin_information", $args );
	$item = $api;

	$plugins_allowedtags = array(
		'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ),
		'abbr' => array( 'title' => array() ), 'acronym' => array( 'title' => array() ),
		'code' => array(), 'pre' => array(), 'em' => array(), 'strong' => array(),
		'div' => array( 'class' => array() ), 'span' => array( 'class' => array() ),
		'p' => array(), 'ul' => array(), 'ol' => array(), 'li' => array(),
		'h1' => array(), 'h2' => array(), 'h3' => array(), 'h4' => array(), 'h5' => array(), 'h6' => array(),
		'img' => array( 'src' => array(), 'class' => array(), 'alt' => array() )
		);

	?>
	<form id="plugin-filter">

		<div class="wrap">
			<div class="ampforwp-pre-installtion-instructions">
				<h1 style="color:#388E3C;font-weight:500"><i class="dashicons dashicons-warning"></i><?php echo __('Almost done. One last step remaining.</h1>
				<p><b>This plugin requires the following plugin: <i>AMP</i></b></p>
				<p>Automattic, the company behind WordPress has created a framework for AMP (also known as Default AMP plugin) which we are using as the core.</p><p>To complete the installation, you just need to click on the \'Finish Installation\' button and default AMP plugin will be installed. Remember, to activate the plugin and you will be redirected to this screen again.</p>','accelerated-mobile-pages') ?>
				<div id="ampforwp-network-status"></div>
			</div>

		<div style="margin-top:30px;" class="wp-list-table widefat plugin-install">
			<div id="the-list">

				<?php
				function ampforwp_plugin_activation_link($plugin) {
				    $activateUrl = sprintf(admin_url('plugins.php?action=activate&plugin=%s&plugin_status=all&paged=1&s'), $plugin);
				    // change the plugin request to the plugin to pass the nonce check
				    $_REQUEST['plugin'] = $plugin;
				    $activateUrl = wp_nonce_url($activateUrl, 'activate-plugin_' . $plugin, '_wpnonce');

				    return $activateUrl;
				}

//				foreach ( (array) $item as $plugin ) {
                    $plugin = $item;
					if ( is_object( $plugin ) ) {
						$plugin = (array) $plugin;
					}

					$title = wp_kses( $plugin['name'], $plugins_allowedtags );
					// Remove any HTML from the description.
					$description = strip_tags( $plugin['short_description'] );
					$version = wp_kses( $plugin['version'], $plugins_allowedtags );

					$name = strip_tags( $title . ' ' . $version );

					$author = wp_kses( $plugin['author'], $plugins_allowedtags );
					if ( ! empty( $author ) ) {
						$author = ' <cite>' . sprintf( __( 'By %s' ), $author ) . '</cite>';
					}

					$action_links = array();

					if ( current_user_can( 'install_plugins' ) || current_user_can( 'update_plugins' ) ) {
						$status = install_plugin_install_status( $plugin );

						if ( $status['status'] == 'latest_installed' && is_plugin_inactive( $status['file'] ) ) {
							$status['activation'] = 'not_activated';
						} elseif ( $status['status'] == 'latest_installed' && is_plugin_active( $status['file'] ) ) {
						 	$status['activation'] = 'activated';

						} elseif ( $status['status'] == 'update_available' && is_plugin_active( $status['file'] ) ) {
						 	$status['activation'] = 'activated_update_required';

						} else {
							$status['activation'] = 'not_installed';
						}

						$activation_link = ampforwp_plugin_activation_link($status['file']);

						switch ( $status['status'] ) {
							case 'install':
								if ( $status['url'] ) {
									/* translators: 1: Plugin name and version. */
									$action_links[] = '<a class="install-now button-secondary ampforwp-button-install" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf( __( 'Install %s now','accelerated-mobile-pages' ), $name ) ) . '">' . __( 'Install Now','accelerated-mobile-pages' ) . '</a>';
								}

								break;
							case 'update_available':
								if ( $status['url'] ) {
									/* translators: 1: Plugin name and version */
									$action_links[] = '<a class="button ampforwp-button-update" href="' . $status['url'] . '" aria-label="' . esc_attr( sprintf( __( 'Update %s now','accelerated-mobile-pages' ), $name ) ) . '">' . __( 'Update Now','accelerated-mobile-pages' ) . '</a>';
								}

								break;
							case 'latest_installed':
								if ( $status['activation'] == 'not_activated') {
									$action_links[] = '<a class="install-now button-secondary ampforwp-button-install" href="' . $activation_link . '" aria-label="' . esc_attr( sprintf( __( 'Activate %s ','accelerated-mobile-pages' ), $name ) ) . '">' . __( 'Activate','accelerated-mobile-pages' ) . '</a>';
								}
								break;
							case 'newer_installed':
								$action_links[] = '<span class="button button-disabled" title="' . esc_attr__( 'This plugin is already installed and is up to date','accelerated-mobile-pages' ) . ' ">' . _x( 'Installed', 'plugin','accelerated-mobile-pages' ) . '</span>';
								break;
						}
					}

					$details_link   = self_admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=' . $plugin['slug'] .
										'&amp;TB_iframe=true&amp;width=750&amp;height=550' );

					/* translators: 1: Plugin name and version. */
					$action_links[] = '<a href="' . esc_url( $details_link ) . '" class="thickbox" aria-label="' . esc_attr( sprintf( __( 'More information about %s' ), $name ) ) . '" data-title="' . esc_attr( $name ) . '">' . __( 'More Details','accelerated-mobile-pages' ) . '</a>';

					if ( !empty( $plugin['icons']['svg'] ) ) {
						$plugin_icon_url = $plugin['icons']['svg'];
					} elseif ( !empty( $plugin['icons']['2x'] ) ) {
						$plugin_icon_url = $plugin['icons']['2x'];
					} elseif ( !empty( $plugin['icons']['1x'] ) ) {
						$plugin_icon_url = $plugin['icons']['1x'];
					} else {
						$plugin_icon_url = $plugin['icons']['default'];
					}

					/**
					 * Filter the install action links for a plugin.
					 *
					 * @since 2.7.0
					 *
					 * @param array $action_links An array of plugin action hyperlinks. Defaults are links to Details and Install Now.
					 * @param array $plugin       The plugin currently being listed.
					 */
					$action_links = apply_filters( 'plugin_install_action_links', $action_links, $plugin );
				?>
				<div class="plugin-card drop-shadow lifted" >
					<div class="plugin-card-top" style="min-height: 135px !important;">
		            <?php if ( isset( $plugin["slug"] ) && $plugin["slug"] == 'easy-media-gallery' ) {echo '<div class="most_popular"></div>';} ?>
						<span href="<?php echo esc_url( $details_link ); ?>" class="thickbox plugin-icon"><img width="128" height="128" src="<?php echo esc_attr( $plugin_icon_url ) ?>" /></span>
						<div class="name column-name" style="margin-right: 20px !important;">
							<h4><?php echo $title; ?></h4>
						</div>
						<div class="desc column-description" style="margin-right: 20px !important;">
							<p><?php echo $description; ?></p>
							<p class="authors"><?php echo __('by Automattic','accelerated-mobile-pages') ?></p>
						</div>
					</div>
					<div class="ampforwp-button-con">
						<?php
							if ( $action_links ) {
								echo '<ul class="ampforwp-plugin-action-buttons ampforwp-custom-btn">';
									echo '<li>' . $action_links[0] . '</li>';
								echo '</ul>';
							} ?>
					</div>
				</div>
				<?php
//				} ?>

		     	</div>
			</div>
		</div>
	</form>

	<?php
}

// add_action('admin_footer','ampforwp_offline_admin_notice');
function ampforwp_offline_admin_notice() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$amp_plugin_activation_check = is_plugin_active( 'amp/amp.php' );

	if ( $amp_plugin_activation_check ) { ?>
		<style>
            #layout-builder h2{
                    background-image: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjMxNHB4IiBoZWlnaHQ9IjMxNXB4IiB2aWV3Qm94PSIwIDAgMzE0IDMxNSIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KICAgIDwhLS0gR2VuZXJhdG9yOiBTa2V0Y2ggNDEgKDM1MzI2KSAtIGh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaCAtLT4KICAgIDx0aXRsZT5TaGFwZTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPjwvZGVmcz4KICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSIjODI4NzhjIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxnIGlkPSIyNjA3MSIgZmlsbD0iIzgyODc4YyI+CiAgICAgICAgICAgIDxnIGlkPSJDYXBhXzEiPgogICAgICAgICAgICAgICAgPGcgaWQ9Il94MzJfNDAuX1Bvd2VyIj4KICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMTU3LjAwNywwIEM3MC4yOTIsMCAwLDcwLjI5MiAwLDE1Ny4wMDcgQzAsMjQzLjcxNSA3MC4yOTIsMzE0LjAxNCAxNTcuMDA3LDMxNC4wMTQgQzI0My43MTYsMzE0LjAxNCAzMTQuMDE0LDI0My43MTUgMzE0LjAxNCwxNTcuMDA3IEMzMTQuMDE0LDcwLjI5MiAyNDMuNzE2LDAgMTU3LjAwNywwIFogTTE1Ny4wMDcsMjgyLjYxMiBDODcuNjM0LDI4Mi42MTIgMzEuNDAyLDIyNi4zNzIgMzEuNDAyLDE1Ny4wMDcgQzMxLjQwMiw4Ny42MzQgODcuNjM0LDMxLjQwMiAxNTcuMDA3LDMxLjQwMiBDMjI2LjM3MSwzMS40MDIgMjgyLjYxMSw4Ny42MzQgMjgyLjYxMSwxNTcuMDA3IEMyODIuNjEyLDIyNi4zNzIgMjI2LjM3MiwyODIuNjEyIDE1Ny4wMDcsMjgyLjYxMiBaIE0yMDQuMTExLDE0MS4zNjggTDE2My40NzksMTQxLjUzMyBDMTU5LjEzOSwxNDEuNTUzIDE1Ny41NDQsMTM4LjYyMyAxNTkuOTA1LDEzNC45NzkgTDIwMy4zOTcsNjguMTA5IEMyMDguMTI2LDYwLjg0MSAyMDYuOTg0LDU5LjkyMiAyMDAuODYxLDY2LjA1MyBMMTA1LjMwNSwxNjEuNiBDOTkuMTcyLDE2Ny43MzIgMTAxLjIzMiwxNzIuNjc2IDEwOS45MDYsMTcyLjY0MSBMMTQyLjY3OSwxNzIuNTA4IEMxNTEuMzQ3LDE3Mi40NzIgMTU0LjU1MiwxNzguMzM1IDE0OS44MjQsMTg1LjYwNSBMMTA2LjMzNCwyNTIuNDc3IEMxMDMuOTcyLDI1Ni4xMTIgMTA0LjU0MiwyNTYuNTgxIDEwNy42MiwyNTMuNTI3IEwxNzUuOTE1LDE4NS43MTcgQzE3OC45ODgsMTgyLjY1OSAxODMuOTUsMTc3LjY4NiAxODYuOTgzLDE3NC41OTYgTDIwOC43ODgsMTUyLjQ4NSBDMjE0Ljg3NSwxNDYuMzE3IDIxMi43NzUsMTQxLjMzIDIwNC4xMTEsMTQxLjM2OCBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICAgICAgICAgIDwvZz4KICAgICAgICAgICAgPC9nPgogICAgICAgIDwvZz4KICAgIDwvZz4KPC9zdmc+") !important;
    background-size: 20px;
    background-repeat: no-repeat;
    background-position: 6px;
    padding-left: 35px !important;
            }
			.dashboard_page_ampforwp-welcome-page .plugin-card.drop-shadow.lifted,
			.ampforwp-pre-installtion-instructions{display: none;}
		</style>
	<?php } else { ?>
		<style>
			.ampforwp-post-installtion-instructions{ display: none; }
		</style>
	<?php }
    $current_screen = get_current_screen();
     if( $current_screen ->id === "dashboard_page_ampforwp-welcome-page" ) {?>
    	<script>
      (function(){
        const statusContainer = document.getElementById('ampforwp-network-status');
    		if(! navigator.onLine) {
    			statusContainer.innerHTML = __("<h1 style='color:#E91E63'> You seems to have been Offline. Please connect to network to continue the installation.</h1>",'accelerated-mobile-pages');
            } else {
              if( statusContainer ) {
            	statusContainer.innerHTML =  "";
              }
            }
      })();

    	</script>
  <?php } ?>
	<?php
}


add_action('admin_footer','afdfddf');
function afdfddf(){?>
    <style>
    .getstarted_wrapper{ display: inline-block; margin: 0px 0px 5px 0px; }
    .getstarted_options{float: left; margin-right: 15px;
    background: #fff; border: 1px solid #ddd; padding: 5px 25px 10px 23px; border-radius: 2px;}
    .getstarted_links{float: right; background: #fff; border: 1px solid #ddd; padding: 10px 30px 10px 30px; border-radius: 2px; }
    .ampforwp-post-installtion-instructions, .ampforwp-pre-installtion-instructions{     margin-left: 15px;margin-top: 15px;}
        .getstarted_ul li{        list-style-type: decimal;
    list-style-position: inside;
    line-height: 23px;
    font-size: 15px; }
.getstarted_options p {
font-size: 16px;
    margin-top: 13px;
    margin-bottom: 10px;
    color: #333;
}
.getstarted_ul a {
    text-decoration: none;
    color: #ed1c26;
}
.getstarted_ul a:hover {
    text-decoration: underline;
    color: #222
}
.getstarted_ul {
    margin-top: 6px;
}
        a.getstarted_btn{
        	background: #666;
		    color: #fff;
		    padding: 9px 35px 9px 35px;
		    font-size: 13px;
		    line-height: 1;
		    text-decoration: none;
		    margin-top: 8px;
		    display: inline-block;}
        .dashicons-warning, .dashicons-yes{
            font-family: dashicons;
            font-style: normal;
            position: relative;
            top: 1px;
            font-size: 32px;
            margin-right: 18px;
        }
        .dashicons-yes{
            margin-right: 25px;
        }
        .dashicons-yes:before {
            content: "\f147";
            background: #388e3c;
            color: #fff;
            border-radius: 40px;
            padding-right: 3px;
            padding-top: 1px;
        }
		.ampforwp-plugin-action-buttons {
			text-align:right;
			margin-top: 0;
		}
		.ampforwp-plugin-action-buttons li {
			display: inline-block;
			margin-left: 1em;
		}
		.ampforwp-button-con {
			padding-right: 15px;
		}
		.ampforwp-button-install {
			background: none repeat scroll 0% 0% #2EA2CC !important;
			border-color: #0074A2 !important;
			box-shadow: 0px 1px 0px rgba(120, 200, 230, 0.5) inset, 0px 1px 0px rgba(0, 0, 0, 0.15) !important;
			color: #FFF !important;
		}
		.ampforwp-button-install:focus {
		    box-shadow: 0px 0px 0px 1px #5B9DD9, 0px 0px 2px 1px rgba(30, 140, 190, 0.8) !important;
		}
		.ampforwp-button-install:hover {
		    color: #FFF !important;
			background: none repeat scroll 0% 0% #5B9DD9 !important;
		}
		.ampforwp-button-update {
			background: none repeat scroll 0% 0% #E74F34 !important;
			border-color: #C52F2F !important;
			box-shadow: 0px 1px 0px rgba(255, 235, 235, 0.5) inset, 0px 1px 0px rgba(0, 0, 0, 0.15) !important;
			color: #FFF !important;
		}
		.ampforwp-button-update:focus {
		    box-shadow: 0px 0px 0px 1px #DA3232, 0px 0px 2px 1px rgba(255, 140, 140, 0.8) !important;
		}
		.ampforwp-button-update:hover {
		    color: #FFF !important;
			background: none repeat scroll 0% 0% #DA3232 !important;
		}
		.drop-shadow {
		    position:relative;
		    background:#fff;
			margin-bottom:40px;
		}
		.drop-shadow:before,
		.drop-shadow:after {
		    content:"";
		    position:absolute;
		    z-index:-2;
        } .authors{font-style: italic}
        .ampforwp-custom-btn a{  font-size: 18px !important; background: #388E3C !important; border: 0px !important; border-radius: 2px !important; box-shadow: none !important; padding: 8px 20px !important; height: auto !important}
        .plugin-card-top h4{margin-top: 10px;}
        
/*User Onboarding start*/   
.amp_user_onboarding_choose {
    float: left;
    text-align: center;
    max-width: 260px;
    background: #fff;
    padding: 25px 20px 25px 20px;
    border-radius: 5px;
    margin-right: 20px;
    box-shadow: 1px 1px 5px rgba(221, 221, 221, 0.75);
    transition: 0.25s all;
} 
.amp_user_onboarding_choose:hover{            
    box-shadow: 1px 1px 10px rgba(212, 212, 212, 1);
}
.amp_user_onboarding_choose a {
    background: #fff;
    border: 1px solid #ed1c25;
    color: #ed1c25;
    text-decoration: none;
    padding: 8px 15px;
    margin-top: 5px;
    font-weight: 500;
    display: inline-block;
    font-size: 14px;
    border-radius: 30px;
    transition: 0.2s all; 
    box-shadow: none;
}
.amp_user_onboarding_choose:hover a{
    background: #ed1c25;
    color: #fff;
}
.amp_user_onboarding_choose h3 {
    font-size: 18px;
    font-weight: 600;
}
.amp_new_user .amp_user_avatar{
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMi4wMDIgNTEyLjAwMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyLjAwMiA1MTIuMDAyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHBhdGggc3R5bGU9ImZpbGw6I0RGRTRFODsiIGQ9Ik00NTYuMTE3LDI1Ni4wMDFjMC0yLjM2MS0wLjA0NS00LjcxNS0wLjEzMS03LjA2Yy0wLjA4NS0yLjMyOSwxLjQ3My00LjM5OSwzLjcyMy01LjAwM2w0MS4wMTUtMTAuOTkxYzIuNjgzLTAuNzE5LDQuMjc2LTMuNDc3LDMuNTU3LTYuMTZsLTE4LjY1NC02OS42MjhjLTAuNzE5LTIuNjgzLTMuNDc2LTQuMjc2LTYuMTYtMy41NTdsLTQwLjk5MiwxMC45NzZjLTIuMjUyLDAuNjAzLTQuNjMtMC40MTgtNS43MjYtMi40NzZjLTQuOTYyLTkuMzIzLTEwLjYzNy0xOC4yMTEtMTYuOTYxLTI2LjU4M2MtMS40MDgtMS44NjMtMS4zMy00LjQ1NCwwLjE3MS02LjI0M2wyNy4yODgtMzIuNTI3YzEuNzg1LTIuMTI4LDEuNTA4LTUuMy0wLjYyLTcuMDg2bC01NS4yMi00Ni4zMzljLTIuMTI4LTEuNzg2LTUuMzAxLTEuNTA4LTcuMDg3LDAuNjJsLTI3LjI3NiwzMi41MDVjLTEuNDk5LDEuNzg2LTQuMDM1LDIuMzE5LTYuMTExLDEuMjU4Yy0xNC40MDktNy4zNjUtMjkuODI1LTEzLjAzLTQ1Ljk4Ny0xNi43MzljLTIuMjcyLTAuNTIxLTMuODctMi41NjEtMy44Ny00Ljg5MlYxMy42NTJjMC0yLjc3OC0yLjI1Mi01LjAzLTUuMDMtNS4wM2gtNzIuMDkxYy0yLjc3OCwwLTUuMDMsMi4yNTItNS4wMyw1LjAzdjQyLjQyNGMwLDIuMzM1LTEuNjA2LDQuMzcxLTMuODgzLDQuODkzYy0xMC4zNTksMi4zNzQtMjAuNDEzLDUuNTYtMzAuMDg2LDkuNDc1Yy0yLjE2NCwwLjg3Ni00LjY0NSwwLjEzMS01Ljk4NC0xLjc4MmwtMjQuMzM0LTM0Ljc0NGMtMS41OTQtMi4yNzUtNC43My0yLjgyOC03LjAwNS0xLjIzNUw4NC41ODEsNzQuMDM1Yy0yLjI3NiwxLjU5My0yLjgyOSw0LjczLTEuMjM1LDcuMDA2bDI0LjM2MiwzNC43OWMxLjMzNCwxLjkwNSwxLjIwNSw0LjQ5MS0wLjM1Miw2LjIxN2MtNy4wNDIsNy44MDgtMTMuNDc3LDE2LjE3My0xOS4yMzIsMjUuMDE4Yy0xLjI3MSwxLjk1NC0zLjcyOSwyLjc2Mi01LjkxOSwxLjk2NUw0Mi4zMSwxMzQuNTE0Yy0yLjYxLTAuOTUtNS40OTcsMC4zOTYtNi40NDcsMy4wMDZsLTI0LjY1Nyw2Ny43MzljLTAuOTUsMi42MSwwLjM5Niw1LjQ5NywzLjAwNiw2LjQ0N2wzOS45MDEsMTQuNTI0YzIuMTg5LDAuNzk3LDMuNTU2LDIuOTkzLDMuMjczLDUuMzA1Yy0wLjk4Myw4LjAxOS0xLjUwMywxNi4xODItMS41MDMsMjQuNDY1YzAsMi4zNjEsMC4wNDUsNC43MTUsMC4xMzEsNy4wNmMwLjA4NSwyLjMyOS0xLjQ3Myw0LjM5OS0zLjcyMyw1LjAwM2wtNDEuMDE1LDEwLjk5MWMtMi42ODMsMC43MTktNC4yNzYsMy40NzctMy41NTcsNi4xNmwxOC42NTQsNjkuNjI4YzAuNzE5LDIuNjgzLDMuNDc2LDQuMjc2LDYuMTYsMy41NTdsNDAuOTkyLTEwLjk3NmMyLjI1Mi0wLjYwMyw0LjYzLDAuNDE4LDUuNzI2LDIuNDc2YzQuOTYyLDkuMzIzLDEwLjYzNywxOC4yMTEsMTYuOTYxLDI2LjU4M2MxLjQwOCwxLjg2MywxLjMzLDQuNDU0LTAuMTcxLDYuMjQzbC0yNy4yODgsMzIuNTI3Yy0xLjc4NSwyLjEyOC0xLjUwOCw1LjMsMC42Miw3LjA4Nmw1NS4yMiw0Ni4zMzljMi4xMjgsMS43ODYsNS4zMDEsMS41MDgsNy4wODctMC42MmwyNy4yNzYtMzIuNTA1YzEuNDk5LTEuNzg2LDQuMDM1LTIuMzE5LDYuMTExLTEuMjU4YzE0LjQwOSw3LjM2NSwyOS44MjUsMTMuMDMsNDUuOTg3LDE2LjczOWMyLjI3MiwwLjUyMSwzLjg3LDIuNTYxLDMuODcsNC44OTJ2NDIuNDI0YzAsMi43NzgsMi4yNTIsNS4wMyw1LjAzLDUuMDNoNzIuMDkxYzIuNzc4LDAsNS4wMy0yLjI1Miw1LjAzLTUuMDN2LTQyLjQyNGMwLTIuMzM1LDEuNjA2LTQuMzcxLDMuODgzLTQuODkzYzEwLjM1OS0yLjM3NCwyMC40MTMtNS41NiwzMC4wODYtOS40NzVjMi4xNjQtMC44NzYsNC42NDUtMC4xMzEsNS45ODQsMS43ODJsMjQuMzM0LDM0Ljc0NGMxLjU5NCwyLjI3NSw0LjczLDIuODI4LDcuMDA1LDEuMjM1bDU5LjA1Mi00MS4zNTFjMi4yNzYtMS41OTQsMi44MjktNC43MywxLjIzNS03LjAwNmwtMjQuMzYyLTM0Ljc5Yy0xLjMzNC0xLjkwNS0xLjIwNS00LjQ5MSwwLjM1Mi02LjIxN2M3LjA0Mi03LjgwOCwxMy40NzctMTYuMTczLDE5LjIzMi0yNS4wMThjMS4yNzEtMS45NTQsMy43MjktMi43NjIsNS45MTktMS45NjVsMzkuODk0LDE0LjUxN2MyLjYxLDAuOTUsNS40OTctMC4zOTYsNi40NDctMy4wMDZsMjQuNjU3LTY3LjczOWMwLjk1LTIuNjEtMC4zOTYtNS40OTctMy4wMDYtNi40NDdsLTM5LjkwMS0xNC41MjRjLTIuMTg5LTAuNzk3LTMuNTU2LTIuOTkzLTMuMjczLTUuMzA1QzQ1NS41OTYsMjcyLjQ0Nyw0NTYuMTE3LDI2NC4yODMsNDU2LjExNywyNTYuMDAxeiBNMjU3LjExMywzODMuNTY5Yy03MS4zMzMsMC42MDgtMTI5LjI4OS01Ny4zNDgtMTI4LjY4MS0xMjguNjgxYzAuNTgyLTY4LjE4Miw1OC4yNzQtMTI1Ljg3NCwxMjYuNDU1LTEyNi40NTVjNzEuMzMzLTAuNjA4LDEyOS4yODksNTcuMzQ4LDEyOC42ODEsMTI4LjY4MUMzODIuOTg2LDMyNS4yOTYsMzI1LjI5NCwzODIuOTg4LDI1Ny4xMTMsMzgzLjU2OXoiLz48cGF0aCBzdHlsZT0iZmlsbDojQzRDQ0NFOyIgZD0iTTQ2NS44OSwyNDIuNDk4bDQyLjI2LTExLjMyYzIuNzctMC43NCw0LjQxLTMuNTksMy42Ny02LjM1bC0xOS4yMi03MS43NGMtMC43NC0yLjc3LTMuNTgtNC40MS02LjM1LTMuNjdsLTQxLjY0LDExLjE1YzIuOTYsMTQuMzgsNC41MSwyOS4yNiw0LjUxLDQ0LjUxYzAsMTIxLjQ0LTk4LjQ0LDIxOS44Ny0yMTkuODcsMjE5Ljg3Yy01NC41MiwwLTEwNC40Mi0xOS44NS0xNDIuODQtNTIuNzNjMS42LDIuMzIsMy4yNSw0LjYsNC45NSw2Ljg1YzEuNDUsMS45MiwxLjM3LDQuNTktMC4xOCw2LjQzbC0yOC4xMSwzMy41MmMtMS44NCwyLjE5LTEuNTYsNS40NiwwLjY0LDcuM2w1Ni44OSw0Ny43NWMyLjIsMS44NCw1LjQ2LDEuNTUsNy4zLTAuNjRsMjguMTEtMzMuNWMxLjU0LTEuODQsNC4xNi0yLjM4LDYuMy0xLjI5YzE0Ljg0LDcuNTksMzAuNzMsMTMuNDIsNDcuMzgsMTcuMjVjMi4zNCwwLjUzLDMuOTksMi42MywzLjk5LDUuMDR2NDMuNzFjMCwyLjg2LDIuMzIsNS4xOCw1LjE4LDUuMThoNzQuMjhjMi44NiwwLDUuMTgtMi4zMiw1LjE4LTUuMTh2LTQzLjcxYzAtMi40MSwxLjY2LTQuNTEsNC01LjA1YzEwLjY4LTIuNDQsMjEuMDQtNS43MiwzMS05Ljc2YzIuMjMtMC45LDQuNzktMC4xMyw2LjE3LDEuODRsMjUuMDcsMzUuOGMxLjY0LDIuMzQsNC44NywyLjkxLDcuMjIsMS4yN2w2MC44NC00Mi42MWMyLjM1LTEuNjQsMi45Mi00Ljg3LDEuMjgtNy4yMmwtMjUuMTEtMzUuODRjLTEuMzctMS45Ny0xLjI0LTQuNjMsMC4zNy02LjQxYzcuMjUtOC4wNCwxMy44OC0xNi42NiwxOS44MS0yNS43OGMxLjMxLTIuMDEsMy44NS0yLjg0LDYuMS0yLjAybDQxLjExLDE0Ljk2YzIuNjksMC45Nyw1LjY2LTAuNDEsNi42NC0zLjFsMjUuNDEtNjkuOGMwLjk3LTIuNjktMC40MS01LjY2LTMuMS02LjY0bC00MS4xMS0xNC45N2MtMi4yNi0wLjgyLTMuNjctMy4wOC0zLjM4LTUuNDZjMS4wMi04LjI2LDEuNTUtMTYuNjgsMS41NS0yNS4yMWMwLTIuNDMtMC4wNC00Ljg2LTAuMTMtNy4yN0M0NjEuOTcsMjQ1LjI1OCw0NjMuNTcsMjQzLjExOCw0NjUuODksMjQyLjQ5OHoiLz48Zz48cGF0aCBzdHlsZT0iZmlsbDojMDAwMTAwOyIgZD0iTTI5Mi4wNDYsNTEwLjkyOGgtNzIuMDkxYy02LjkzNCwwLTEyLjU3NS01LjY0MS0xMi41NzUtMTIuNTc1di00MC40MjdjLTE1LjE3Ny0zLjY0Mi0yOS45MzUtOS4wMTUtNDMuOTI2LTE1Ljk5MWwtMjUuOTg5LDMwLjk3MmMtMi4xNTksMi41NzMtNS4xOTEsNC4xNTEtOC41MzcsNC40NDRjLTMuMzQ0LDAuMjk0LTYuNjA2LTAuNzM1LTkuMTc5LTIuODk0bC04LjY4Mi03LjI4NGMtMy4xOTItMi42NzktMy42MDgtNy40MzgtMC45My0xMC42M2MyLjY3OC0zLjE5Myw3LjQzNy0zLjYwOSwxMC42My0wLjkzbDYuNzU1LDUuNjY4bDI1LjY1NS0zMC41NzRjMy43OS00LjUxNiwxMC4wOTItNS44MDEsMTUuMzI1LTMuMTI2YzE0LjAyOCw3LjE2OCwyOC45MTMsMTIuNTg3LDQ0LjI0LDE2LjEwNWM1LjcyOCwxLjMxNSw5LjcyOCw2LjM1MSw5LjcyOCwxMi4yNDZ2MzkuOTA4aDY3LjA2MXYtMzkuOTFjMC01Ljg5NSw0LjAwNC0xMC45MzEsOS43MzgtMTIuMjQ3YzkuODQyLTIuMjU5LDE5LjU4LTUuMzI3LDI4Ljk0Ni05LjExOWM1LjQ1Mi0yLjIwNSwxMS42MTctMC4zNzgsMTQuOTk2LDQuNDQ4bDIyLjg4NywzMi42ODZsNTQuOTMzLTM4LjQ2NWwtMjIuOTE3LTMyLjcyOGMtMy4zOC00LjgzLTIuOTk3LTExLjI0MywwLjkyOS0xNS41OThjNi43NzQtNy41MTIsMTMtMTUuNjE1LDE4LjUwNi0yNC4wODJjMy4yLTQuOTIzLDkuMjk5LTYuOTU3LDE0LjgyNi00Ljk0M2wzNy41MjgsMTMuNjU5bDIyLjkzNi02My4wMTdsLTM3LjUzMS0xMy42NmMtNS41MzEtMi4wMTMtOC44OTUtNy40ODctOC4xODItMTMuMzExYzAuOTU1LTcuODA3LDEuNDM5LTE1LjczMSwxLjQzOS0yMy41NDljMC0yLjIxNy0wLjA0MS00LjUwMi0wLjEyMy02Ljc5MWMtMC4yMDktNS44NjgsMy42Mi0xMS4wMzIsOS4zMTItMTIuNTU3bDM4LjU4Ni0xMC4zMzlsLTE3LjM1Ni02NC43NzZsLTM4LjU1NSwxMC4zM2MtNS42ODQsMS41MjItMTEuNTgtMS4wMzUtMTQuMzQtNi4yMThjLTQuNzQ3LTguOTIxLTEwLjI0LTE3LjUzLTE2LjMyNi0yNS41OWMtMy41NDQtNC42OTUtMy4zNzQtMTEuMTI2LDAuNDEzLTE1LjYzOWwyNS42NzEtMzAuNTkzbC01MS4zNzItNDMuMTA2TDM1OC44Miw4MS4yOTljLTMuNzksNC41MTYtMTAuMDkyLDUuODAxLTE1LjMyNSwzLjEyNmMtMTQuMDI4LTcuMTY4LTI4LjkxMy0xMi41ODctNDQuMjQtMTYuMTA1Yy01LjcyOC0xLjMxNS05LjcyOC02LjM1MS05LjcyOC0xMi4yNDZ2LTM5LjkxaC02Ny4wNjF2MzkuOTFjMCw1Ljg5NS00LjAwNCwxMC45MzEtOS43MzgsMTIuMjQ3Yy05Ljg0MiwyLjI1OS0xOS41OCw1LjMyNy0yOC45NDYsOS4xMTljLTUuNDUyLDIuMjA2LTExLjYxNywwLjM3OC0xNC45OTYtNC40NDhsLTIyLjg4Ny0zMi42ODZMOTAuOTY4LDc4Ljc3bDIyLjkxNywzMi43MjhjMy4zOCw0LjgzLDIuOTk3LDExLjI0My0wLjkyOSwxNS41OThjLTYuNzc0LDcuNTEyLTEzLDE1LjYxNS0xOC41MDYsMjQuMDgyYy0zLjIsNC45MjMtOS4yOTksNi45NTctMTQuODI2LDQuOTQzbC0zNy41MjgtMTMuNjU5bC0yMi45MzcsNjMuMDE5bDM3LjUzMSwxMy42NmM1LjUzMSwyLjAxNCw4Ljg5NCw3LjQ4Nyw4LjE4MiwxMy4zMTFjLTAuOTU1LDcuODA3LTEuNDM5LDE1LjczMS0xLjQzOSwyMy41NDljMCwyLjIxNywwLjA0MSw0LjUwMiwwLjEyMyw2Ljc5MWMwLjIwOSw1Ljg2OC0zLjYyLDExLjAzMi05LjMxMiwxMi41NTdsLTM4LjU4NiwxMC4zMzlsMTcuMzU2LDY0Ljc3NmwzOC41NTUtMTAuMzNjNS42ODMtMS41MjMsMTEuNTc5LDEuMDM1LDE0LjM0LDYuMjE4YzQuNzQ3LDguOTIxLDEwLjI0LDE3LjUzLDE2LjMyNiwyNS41OWMzLjU0NCw0LjY5NSwzLjM3NCwxMS4xMjYtMC40MTMsMTUuNjM5TDc2LjE1LDQxOC4xNzNsNC40NDIsMy43MjhjMy4xOTIsMi42NzgsMy42MDgsNy40MzgsMC45MywxMC42MjljLTIuNjc5LDMuMTkyLTcuNDM4LDMuNjA4LTEwLjYyOSwwLjkzbC02LjM2OS01LjM0NGMtMi41NzMtMi4xNTgtNC4xNTItNS4xOS00LjQ0NS04LjUzNnMwLjczNS02LjYwNiwyLjg5NC05LjE3OWwyNi4wMDQtMzAuOTljLTUuNjc4LTcuNjc3LTEwLjg1OS0xNS43OTYtMTUuNDMtMjQuMTg1bC0zOS4wNTgsMTAuNDY1Yy0zLjI0NCwwLjg2OS02LjYzMiwwLjQyMy05LjU0Mi0xLjI1NmMtMi45MDktMS42NzktNC45ODktNC4zOTEtNS44NTktNy42MzVMMC40MywyODcuMTYzYy0xLjc5NC02LjY5NywyLjE5NC0xMy42MDYsOC44OTEtMTUuNDAxbDM5LjA5MS0xMC40NzRjLTAuMDQ2LTEuNzgyLTAuMDctMy41NTItMC4wNy01LjI4N2MwLTcuNzU1LDAuNDQyLTE1LjYwNCwxLjMxNC0yMy4zNjJsLTM4LjAyMS0xMy44MzhjLTMuMTU3LTEuMTQ4LTUuNjc3LTMuNDU4LTcuMDk3LTYuNTAyYy0xLjQyLTMuMDQ1LTEuNTY4LTYuNDYtMC40MTktOS42MTdsMjQuNjU2LTY3Ljc0MmMxLjE0OC0zLjE1NiwzLjQ1OC01LjY3Nyw2LjUwMi03LjA5NmMzLjA0NC0xLjQyMSw2LjQ1OC0xLjU3LDkuNjE2LTAuNDJsMzguMDE5LDEzLjgzOGM1LjI3OS03Ljk0NywxMS4xNDQtMTUuNTgsMTcuNDctMjIuNzM4TDc3LjE2NSw4NS4zNjVjLTEuOTI3LTIuNzUxLTIuNjY3LTYuMDg4LTIuMDgzLTkuMzk3YzAuNTg0LTMuMzA4LDIuNDItNi4xOSw1LjE3Mi04LjExN2w1OS4wNTQtNDEuMzVjNS42ODEtMy45NzYsMTMuNTM4LTIuNTkxLDE3LjUxNCwzLjA4OGwyMy4xODQsMzMuMTFjOC44OTUtMy40OTgsMTguMDg2LTYuMzk0LDI3LjM3NS04LjYyNFYxMy42NDljMC02LjkzNCw1LjY0MS0xMi41NzUsMTIuNTc1LTEyLjU3NWg3Mi4wOTFjNi45MzQsMCwxMi41NzUsNS42NDEsMTIuNTc1LDEyLjU3NXY0MC40MjdjMTUuMTc3LDMuNjQyLDI5LjkzNSw5LjAxNSw0My45MjYsMTUuOTkxbDI1Ljk4OS0zMC45NzJjMi4xNTktMi41NzMsNS4xOTEtNC4xNTEsOC41MzctNC40NDRjMy4zNDktMC4yOTQsNi42MDYsMC43MzUsOS4xNzksMi44OTRsNTUuMjI1LDQ2LjM0YzIuNTczLDIuMTU4LDQuMTUyLDUuMTksNC40NDUsOC41MzZzLTAuNzM1LDYuNjA2LTIuODk0LDkuMTc5bC0yNi4wMDQsMzAuOTljNS42NzgsNy42NzcsMTAuODU5LDE1Ljc5NiwxNS40MywyNC4xODVsMzkuMDU4LTEwLjQ2NWMzLjI0My0wLjg2OSw2LjYzMi0wLjQyMyw5LjU0MiwxLjI1NmMyLjkwOSwxLjY3OSw0Ljk4OSw0LjM5MSw1Ljg1OSw3LjYzNWwxOC42NTksNjkuNjM2YzEuNzk0LDYuNjk3LTIuMTk0LDEzLjYwNi04Ljg5MSwxNS40MDFsLTM5LjA5MSwxMC40NzRjMC4wNDYsMS43ODIsMC4wNywzLjU1MiwwLjA3LDUuMjg3YzAsNy43NTUtMC40NDIsMTUuNjA0LTEuMzE0LDIzLjM2MmwzOC4wMjEsMTMuODM5YzMuMTU3LDEuMTQ4LDUuNjc3LDMuNDU4LDcuMDk3LDYuNTAyYzEuNDIsMy4wNDUsMS41NjgsNi40NiwwLjQxOSw5LjYxN2wtMjQuNjU2LDY3Ljc0MmMtMS4xNDgsMy4xNTYtMy40NTgsNS42NzctNi41MDIsNy4wOTZjLTMuMDQ1LDEuNDItNi40NTksMS41NjktOS42MTYsMC40MmwtMzguMDE5LTEzLjgzOGMtNS4yNzksNy45NDctMTEuMTQ0LDE1LjU4LTE3LjQ3LDIyLjczOGwyMy4yMTcsMzMuMTU3YzEuOTI3LDIuNzUxLDIuNjY3LDYuMDg4LDIuMDgzLDkuMzk3Yy0wLjU4NCwzLjMwOC0yLjQyLDYuMTktNS4xNzIsOC4xMTdsLTU5LjA1NCw0MS4zNWMtNS42ODEsMy45NzctMTMuNTM3LDIuNTkxLTE3LjUxNC0zLjA4OGwtMjMuMTg0LTMzLjExYy04Ljg5NSwzLjQ5OC0xOC4wODYsNi4zOTQtMjcuMzc1LDguNjI0djQwLjQyN0MzMDQuNjIxLDUwNS4yODcsMjk4Ljk4LDUxMC45MjgsMjkyLjA0Niw1MTAuOTI4eiIvPjxwYXRoIHN0eWxlPSJmaWxsOiMwMDAxMDA7IiBkPSJNMjI0Ljg5NSwxMzEuNDY4Yy0wLjc5NS0yLjAyNS0yLjQyNi0zLjYwOS00LjQ3NC00LjM0NGwtMzMuMzk0LTExLjk4NWMtMy45MjMtMS40MDYtOC4yNDMsMC42MzEtOS42NSw0LjU1MmMtMS40MDgsMy45MjIsMC42MzEsOC4yNDMsNC41NTMsOS42NTFsMTQuNjgsNS4yNjhjLTQ1LjkyOCwyMi40MTYtNzUuNzI1LDY5LjE3LTc1LjcyNSwxMjEuMzljMCw0OS44MjQsMjcuMjgyLDk1LjQ0OSw3MS4yLDExOS4wNzFjMS4xMzcsMC42MTIsMi4zNjEsMC45MDIsMy41NjgsMC45MDJjMi42ODcsMCw1LjI4OS0xLjQ0LDYuNjUxLTMuOTcyYzEuOTc0LTMuNjcsMC41OTktOC4yNDUtMy4wNzEtMTAuMjE5Yy0zOS4wMTktMjAuOTg3LTYzLjI1OC02MS41MjEtNjMuMjU4LTEwNS43ODJjMC00NS44MzgsMjUuODQyLTg2LjkzNSw2NS44MTQtMTA3LjExN2wtNy4zMTIsMTQuMTI0Yy0xLjkxNiwzLjctMC40NjksOC4yNTMsMy4yMzEsMTAuMTY5YzEuMTA5LDAuNTc0LDIuMjk0LDAuODQ2LDMuNDYzLDAuODQ2YzIuNzMsMCw1LjM2NS0xLjQ4Niw2LjcwNy00LjA3OGwxNi42OTctMzIuMjVDMjI1LjU3MiwxMzUuNzY0LDIyNS42OSwxMzMuNDk0LDIyNC44OTUsMTMxLjQ2OHoiLz48cGF0aCBzdHlsZT0iZmlsbDojMDAwMTAwOyIgZD0iTTI5Mi4xODYsMTI1Ljc4NmMtNC4wMTQtMS4xMTItOC4xNzMsMS4yMzgtOS4yODcsNS4yNTRjLTEuMTE0LDQuMDE2LDEuMjM5LDguMTczLDUuMjU0LDkuMjg3YzUxLjczOSwxNC4zNDksODcuODc0LDYxLjkxNiw4Ny44NzQsMTE1LjY3NGMwLDI5LjkyLTExLjA3Myw1OC41OC0zMS4xOCw4MC43MDJjLTE2Ljc3NSwxOC40NTYtMzguNjQ0LDMxLjEwNC02Mi42MzksMzYuNDUybDkuMTE0LTEzLjEwOWMyLjM3OC0zLjQyMSwxLjUzMy04LjEyMy0xLjg4OC0xMC41MDJjLTMuNDIzLTIuMzgtOC4xMjMtMS41MzMtMTAuNTAyLDEuODg4bC0yMC43MywyOS44MThjLTEuMjQyLDEuNzg3LTEuNjUyLDQuMDIyLTEuMTI1LDYuMTMzczEuOTM5LDMuODkzLDMuODc0LDQuODg2bDMxLjU2MiwxNi4yMDdjMS4xMDMsMC41NjYsMi4yOCwwLjgzNCwzLjQ0LDAuODM0YzIuNzM5LDAsNS4zODEtMS40OTYsNi43MTgtNC4xYzEuOTA0LTMuNzA3LDAuNDQyLTguMjU1LTMuMjY2LTEwLjE1OGwtMTMuOTQ1LTcuMTZjMjcuMDMyLTYuMDE2LDUxLjY2Ni0yMC4yNTYsNzAuNTU0LTQxLjAzOGMyMi42MzYtMjQuOTA1LDM1LjEwMy01Ny4xNzEsMzUuMTAzLTkwLjg1MUMzOTEuMTE3LDE5NS40ODYsMzUwLjQzNSwxNDEuOTQsMjkyLjE4NiwxMjUuNzg2eiIvPjwvZz48cGF0aCBzdHlsZT0iZmlsbDojRjRFNTk4OyIgZD0iTTI1NC4yNzMsMTI0LjU5MWwtOTEuMTE3LDE1Ny4zODdjLTIuMDU0LDMuNTQ4LDAuNTA2LDcuOTg4LDQuNjA2LDcuOTg4aDc4LjYxM2MzLjcyNiwwLDYuMjk5LDMuNzMxLDQuOTc0LDcuMjE0bC0zMi41NTgsODUuNmMtMi4xNjksNS43MDIsNS40MDIsOS45NzcsOS4xNjQsNS4xNzNsMTE5LjE4OS0xNTIuMTk1YzIuNzM2LTMuNDkzLDAuMjQ3LTguNjAzLTQuMTktOC42MDNoLTg1Ljc1NmMtMy4yMTQsMC01LjY5NS0yLjgyOC01LjI3Ny02LjAxNGwxMi4yMzMtOTMuMTlDMjY0LjkxMiwxMjIuMTgxLDI1Ny4xODgsMTE5LjU1NSwyNTQuMjczLDEyNC41OTF6Ii8+PHBhdGggc3R5bGU9ImZpbGw6I0VBQ0U4ODsiIGQ9Ik0yMjguOTgyLDM1NS45OTZsNTQuMTA4LTk5Ljc4NWMyLjE2OC0zLjk5OC0wLjcyNy04Ljg1OS01LjI3NC04Ljg1OUgyMTMuMDVjLTQuMzI2LDAtNy4yMy00LjQzOS01LjQ5Ny04LjQwMmw0Ny40NTctMTA4LjU3MWMyLjA2OS00LjczMiw5LjE4My0yLjc1Myw4LjUxMSwyLjM2N2wtMTEuNTQ4LDg3Ljk4OGMtMC40NDYsMy40LDIuMiw2LjQxNiw1LjYyOSw2LjQxNmg4NS43ODhjNC4yNjEsMCw2LjY1MSw0LjkwNyw0LjAyNCw4LjI2MmwtMTE4LjA2LDE1MC43NDljLTQuMDA2LDUuMTE1LTEyLjA2NywwLjU2NC05Ljc1OC01LjUwOGw5LjMzMS0yNC41MzdDMjI4Ljk0MywzNTYuMDc1LDIyOC45NjEsMzU2LjAzNSwyMjguOTgyLDM1NS45OTZ6Ii8+PHBhdGggc3R5bGU9ImZpbGw6IzAwMDEwMDsiIGQ9Ik0yMjMuODY4LDM5Ny42MDJjLTIuMTY0LDAtNC4zNjgtMC41NjMtNi40MjktMS43MjZjLTUuNjcyLTMuMjAyLTguMDE3LTkuNjktNS43MDItMTUuNzc5bDMxLjQxMi04Mi41ODdIMTY3Ljc2Yy00LjY1NSwwLTguODIxLTIuNDA3LTExLjE0Ny02LjQ0Yy0yLjMyNS00LjAzMi0yLjMyMS04Ljg0NSwwLjAxMS0xMi44NzNsOTEuMTE4LTE1Ny4zODdjMy4xMTMtNS4zNzYsOS4zOTUtNy43MzQsMTUuMjc3LTUuNzM1YzUuODgyLDEuOTk5LDkuNDI1LDcuNjk3LDguNjE2LDEzLjg1N2wtMTEuOTAzLDkwLjY3N2gxNS4zODFjNC4xNjcsMCw3LjU0NSwzLjM3OCw3LjU0NSw3LjU0NXMtMy4zNzgsNy41NDUtNy41NDUsNy41NDVoLTE3LjkxNWMtMy43MDQsMC03LjIyOS0xLjU5Ny05LjY3Mi00LjM4MXMtMy41NjgtNi40ODgtMy4wODYtMTAuMTZsMTAuNzg1LTgyLjE1NEwxNzEuNjE3LDI4Mi40Mmg3NC43NTdjNC4yMzEsMCw4LjE5MSwyLjA3OSwxMC41OTMsNS41NjNjMi40MDIsMy40ODMsMi45MzgsNy45MjQsMS40MzQsMTEuODc5bC0yNy4zNDUsNzEuODkzTDMzOC4zODksMjM0LjdoLTEyLjA4MmMtNC4xNjcsMC03LjU0NS0zLjM3OC03LjU0NS03LjU0NXMzLjM3OC03LjU0NSw3LjU0NS03LjU0NWgxNi42NDdjNC45NjIsMCw5LjM5NSwyLjc3MSwxMS41NjgsNy4yMzNjMi4xNzMsNC40NjEsMS42MjIsOS42Ni0xLjQzNywxMy41NjdsLTExOS4xOSwxNTIuMTk1QzIzMS4zMzcsMzk1Ljg3LDIyNy42NjQsMzk3LjYwMiwyMjMuODY4LDM5Ny42MDJ6Ii8+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PC9zdmc+);
}
.amp_expert_user .amp_user_avatar{
	background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ3MCA0NzAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ3MCA0NzA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48cGF0aCBzdHlsZT0iZmlsbDojQjJBRkFGOyIgZD0iTTM3OC42MDYsMzE0LjU4NmgxNVYxNi4yODVjLTguNzMsMy4wOTYtMTUsMTEuNDM3LTE1LDIxLjIxNVYzMTQuNTg2eiIvPjxyZWN0IHg9IjM3MS45MzkiIHk9IjMyOS41ODYiIHN0eWxlPSJmaWxsOiNGRjM4MkU7IiB3aWR0aD0iMjguMzMzIiBoZWlnaHQ9IjEyNS40MTQiLz48cGF0aCBzdHlsZT0iZmlsbDojNjU1RjVFOyIgZD0iTTMzOC43MjIsMzc2LjYzNmMtMy4zMzUsMi4zMjMtNy45MjcsMS41NzYtMTAuMzM4LTEuNzIzYy0xNS4wODItMjAuNjM1LTM1LjExMy0zNi43NjctNTcuNzg2LTQ3LjI1MkwxNzEuNzg3LDQ1NWgxNjIuNjUzYzQuMTQzLDAsNy41LDMuMzU3LDcuNSw3LjVoMTV2LTQ3LjkyNkMzNTIuNTc0LDQwMS4wMjUsMzQ2LjQwOSwzODguMjg1LDMzOC43MjIsMzc2LjYzNnoiLz48cGF0aCBzdHlsZT0iZmlsbDojM0YzNzM2OyIgZD0iTTE1Mi44LDQ1NWw0Ni4wNC01OS4zMzJMMTQ2LjAyMiwzMjcuNkM5Ny4yNjMsMzUwLjIxMyw2Mi43MzcsMzk4LjUwMSw1OS45MTQsNDU1SDE1Mi44eiIvPjxwYXRoIHN0eWxlPSJmaWxsOiNGRkJDOTk7IiBkPSJNMTQxLjQ4LDIxMC44NDFoMTMzLjcwNmMyLjM4Ny03LjA3MiwzLjctMTQuNjMzLDMuNy0yMi41cy0xLjMxNC0xNS40MjgtMy43LTIyLjVIMTQxLjQ4Yy0yLjM4Niw3LjA3Mi0zLjcsMTQuNjMzLTMuNywyMi41UzEzOS4wOTQsMjAzLjc2OSwxNDEuNDgsMjEwLjg0MXogTTIyMC41MzQsMTg4LjM0MWMwLTQuMTQzLDMuMzU3LTcuNSw3LjUtNy41aDE3LjI3YzQuMTQzLDAsNy41LDMuMzU3LDcuNSw3LjVzLTMuMzU3LDcuNS03LjUsNy41aC05LjkyYy0wLjY5NCwzLjQyMy0zLjcyMiw2LTcuMzUsNmMtNC4xNDMsMC03LjUtMy4zNTctNy41LTcuNVYxODguMzQxeiBNMTcxLjM2MiwxODAuODQxaDE3LjI3YzQuMTQzLDAsNy41LDMuMzU3LDcuNSw3LjV2NmMwLDQuMTQzLTMuMzU3LDcuNS03LjUsNy41Yy0zLjYyOCwwLTYuNjU1LTIuNTc3LTcuMzUtNmgtOS45MmMtNC4xNDMsMC03LjUtMy4zNTctNy41LTcuNVMxNjcuMjIsMTgwLjg0MSwxNzEuMzYyLDE4MC44NDF6Ii8+PHBhdGggc3R5bGU9ImZpbGw6IzNGMzczNjsiIGQ9Ik0xNDguNjE0LDIyNS44NDFjMTIuNTAxLDE5LjgzNywzNC41ODksMzMuMDUzLDU5LjcxOSwzMy4wNTNzNDcuMjE4LTEzLjIxNiw1OS43MTktMzMuMDUzSDE0OC42MTR6Ii8+PHBhdGggc3R5bGU9ImZpbGw6IzNGMzczNjsiIGQ9Ik0xNDguNjE0LDE1MC44NDFoMTE5LjQzOWMtMTIuNTAxLTE5LjgzNy0zNC41OS0zMy4wNTQtNTkuNzItMzMuMDU0UzE2MS4xMTUsMTMxLjAwNCwxNDguNjE0LDE1MC44NDF6Ii8+PHBhdGggc3R5bGU9ImZpbGw6IzFDMTkxODsiIGQ9Ik00MTcuNzcyLDMxNC41ODZoLTkuMTY2VjcuNWMwLTQuMTQzLTMuMzU3LTcuNS03LjUtNy41Yy0yMC42NzgsMC0zNy41LDE2LjgyMi0zNy41LDM3LjV2Mjc3LjA4NmgtOS4xNjdjLTQuMTQzLDAtNy41LDMuMzU3LTcuNSw3LjVzMy4zNTcsNy41LDcuNSw3LjVoMi41VjQ2Mi41YzAsNC4xNDMsMy4zNTcsNy41LDcuNSw3LjVoNDMuMzMzYzQuMTQzLDAsNy41LTMuMzU3LDcuNS03LjVWMzI5LjU4NmgyLjVjNC4xNDMsMCw3LjUtMy4zNTcsNy41LTcuNVM0MjEuOTE1LDMxNC41ODYsNDE3Ljc3MiwzMTQuNTg2eiBNMzkzLjYwNiwxNi4yODV2Mjk4LjMwMWgtMTVWMzcuNUMzNzguNjA2LDI3LjcyMiwzODQuODc2LDE5LjM4MSwzOTMuNjA2LDE2LjI4NXogTTM3MS45MzksMzI5LjU4NmgyOC4zMzNWNDU1aC0yOC4zMzNWMzI5LjU4NnoiLz48cGF0aCBzdHlsZT0iZmlsbDojMUMxOTE4OyIgZD0iTTMzNC40MzksNDU1SDE3MS43ODdsOTguODEyLTEyNy4zMzljMjIuNjczLDEwLjQ4NSw0Mi43MDUsMjYuNjE3LDU3Ljc4Niw0Ny4yNTJjMi40MSwzLjI5OCw3LjAwMiw0LjA0NiwxMC4zMzgsMS43MjNjMC4wNDctMC4wMzMsMC4wOTYtMC4wNiwwLjE0My0wLjA5NGMzLjM0NC0yLjQ0NCw0LjA3My03LjEzNywxLjYyOS0xMC40OGMtMTQuODgxLTIwLjM2LTM0LjU0Ny0zNy4yNTEtNTYuODcxLTQ4Ljg0NmMtMy44OTEtMi4wMjEtNy44NzItMy44NjctMTEuOTE4LTUuNTYzYy0wLjI4MS0wLjE0Mi0wLjU2OC0wLjI2Mi0wLjg1OS0wLjM2NmMtMTkuNzExLTguMTMyLTQxLjA2My0xMi4zOTMtNjIuNTEzLTEyLjM5M2MtMjEuOTg5LDAtNDIuOTczLDQuMzcxLTYyLjE0NCwxMi4yNzNjLTAuNDYyLDAuMTM4LTAuOTE0LDAuMzIyLTEuMzUxLDAuNTUzQzg2LjA3MSwzMzYuNTYxLDQ0LjcyOCwzOTQuNzkyLDQ0LjcyOCw0NjIuNWMwLDQuMTQzLDMuMzU3LDcuNSw3LjUsNy41aDI4Mi4yMTJjNC4xNDMsMCw3LjUtMy4zNTcsNy41LTcuNVMzMzguNTgyLDQ1NSwzMzQuNDM5LDQ1NXogTTE0Ni4wMjIsMzI3LjZsNTIuODE4LDY4LjA2OEwxNTIuOCw0NTVINTkuOTE0QzYyLjczNywzOTguNTAxLDk3LjI2MywzNTAuMjEzLDE0Ni4wMjIsMzI3LjZ6Ii8+PHBhdGggc3R5bGU9ImZpbGw6IzFDMTkxODsiIGQ9Ik0xMjIuNzgsMTg4LjM0MWMwLDExLjM3NywyLjI1MSwyMi4yMzQsNi4zMDEsMzIuMTczYzAuMTEyLDAuMzcsMC4yNTcsMC43MjUsMC40MjIsMS4wNjhjMTIuOTk5LDMwLjcxLDQzLjQzOSw1Mi4zMTEsNzguODMsNTIuMzExYzM1LjM5MSwwLDY1LjgzMi0yMS42MDEsNzguODMxLTUyLjMxMWMwLjE2NS0wLjM0NCwwLjMxLTAuNjk4LDAuNDIyLTEuMDY5YzQuMDUtOS45MzksNi4zMDEtMjAuNzk2LDYuMzAxLTMyLjE3M2MwLTExLjM3OC0yLjI1MS0yMi4yMzUtNi4zMDEtMzIuMTc1Yy0wLjExMi0wLjM2OS0wLjI1Ni0wLjcyMi0wLjQyMS0xLjA2NGMtMTIuOTk4LTMwLjcxMi00My40MzktNTIuMzE0LTc4LjgzMi01Mi4zMTRjLTM1LjM5MiwwLTY1LjgzMywyMS42MDMtNzguODMxLDUyLjMxNWMtMC4xNjQsMC4zNDItMC4zMDksMC42OTUtMC40MiwxLjA2NEMxMjUuMDMxLDE2Ni4xMDYsMTIyLjc4LDE3Ni45NjMsMTIyLjc4LDE4OC4zNDF6IE0yNjguMDUzLDE1MC44NDFIMTQ4LjYxNGMxMi41MDEtMTkuODM3LDM0LjU4OS0zMy4wNTQsNTkuNzE5LTMzLjA1NFMyNTUuNTUyLDEzMS4wMDQsMjY4LjA1MywxNTAuODQxeiBNMjA4LjMzMywyNTguODk0Yy0yNS4xMywwLTQ3LjIxOC0xMy4yMTYtNTkuNzE5LTMzLjA1M2gxMTkuNDM4QzI1NS41NTEsMjQ1LjY3NywyMzMuNDYzLDI1OC44OTQsMjA4LjMzMywyNTguODk0eiBNMjc1LjE4NiwxNjUuODQxYzIuMzg3LDcuMDcyLDMuNywxNC42MzMsMy43LDIyLjVzLTEuMzE0LDE1LjQyOC0zLjcsMjIuNUgxNDEuNDhjLTIuMzg2LTcuMDcyLTMuNy0xNC42MzMtMy43LTIyLjVzMS4zMTQtMTUuNDI4LDMuNy0yMi41SDI3NS4xODZ6Ii8+PHBhdGggc3R5bGU9ImZpbGw6IzFDMTkxODsiIGQ9Ik0xNzEuMzYyLDE5NS44NDFoOS45MmMwLjY5NCwzLjQyMywzLjcyMiw2LDcuMzUsNmM0LjE0MywwLDcuNS0zLjM1Nyw3LjUtNy41di02YzAtNC4xNDMtMy4zNTctNy41LTcuNS03LjVoLTE3LjI3Yy00LjE0MywwLTcuNSwzLjM1Ny03LjUsNy41UzE2Ny4yMiwxOTUuODQxLDE3MS4zNjIsMTk1Ljg0MXoiLz48cGF0aCBzdHlsZT0iZmlsbDojMUMxOTE4OyIgZD0iTTIyOC4wMzQsMjAxLjg0MWMzLjYyOCwwLDYuNjU1LTIuNTc3LDcuMzUtNmg5LjkyYzQuMTQzLDAsNy41LTMuMzU3LDcuNS03LjVzLTMuMzU3LTcuNS03LjUtNy41aC0xNy4yN2MtNC4xNDMsMC03LjUsMy4zNTctNy41LDcuNXY2QzIyMC41MzQsMTk4LjQ4MywyMjMuODkyLDIwMS44NDEsMjI4LjAzNCwyMDEuODQxeiIvPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48L3N2Zz4=);

}
.amp_user_avatar {
    padding: 30px;
    background-repeat: no-repeat;
    margin: 0 auto;
    display: inline-block;
}
/*User Onboarding end*/        
.amp_installed_heading{ color:#388E3C;font-weight:500;margin-top: 20px; }
.amp_installed_heading:before{
    content: "";
	background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB3aWR0aD0iMjUycHgiIGhlaWdodD0iMjUycHgiIHZpZXdCb3g9IjAgMCAyNTIgMjUyIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPiAgICAgICAgPHRpdGxlPkNhcGFfMTwvdGl0bGU+ICAgIDxkZXNjPkNyZWF0ZWQgd2l0aCBTa2V0Y2guPC9kZXNjPiAgICA8ZGVmcz48L2RlZnM+ICAgIDxnIGlkPSJQYWdlLTEiIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPiAgICAgICAgPGcgaWQ9IkFydGJvYXJkLTIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0yLjAwMDAwMCwgLTIuMDAwMDAwKSIgZmlsbD0iI0VEMUMyNCI+ICAgICAgICAgICAgPGcgaWQ9IkNhcGFfMSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMi4wMDAwMDAsIDIuMDAwMDAwKSI+ICAgICAgICAgICAgICAgIDxnIGlkPSJfeDMyXzQwLl9Qb3dlciI+ICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMTI1LjYwNTYsMCBDNTYuMjMzNiwwIDAsNTYuMjMzNiAwLDEyNS42MDU2IEMwLDE5NC45NzIgNTYuMjMzNiwyNTEuMjExMiAxMjUuNjA1NiwyNTEuMjExMiBDMTk0Ljk3MjgsMjUxLjIxMTIgMjUxLjIxMTIsMTk0Ljk3MiAyNTEuMjExMiwxMjUuNjA1NiBDMjUxLjIxMTIsNTYuMjMzNiAxOTQuOTcyOCwwIDEyNS42MDU2LDAgWiBNMTI1LjYwNjAwNiwyMjguNDkwNDEyIEM2OC43ODE4MzU5LDIyOC40OTA0MTIgMjIuNzIxNiwxODIuNDIzNjI0IDIyLjcyMTYsMTI1LjYwNjAwNiBDMjIuNzIxNiw2OC43ODE4MzU5IDY4Ljc4MTgzNTksMjIuNzIxNiAxMjUuNjA2MDA2LDIyLjcyMTYgQzE4Mi40MjI4MDQsMjIuNzIxNiAyMjguNDg5NTkzLDY4Ljc4MTgzNTkgMjI4LjQ4OTU5MywxMjUuNjA2MDA2IEMyMjguNDkwNDEyLDE4Mi40MjM2MjQgMTgyLjQyMzYyNCwyMjguNDkwNDEyIDEyNS42MDYwMDYsMjI4LjQ5MDQxMiBaIE0xNjcuNzAwMjE0LDExNC43ODAxNSBMMTMzLjUxNDgzMiwxMTQuOTE4OTcxIEMxMjkuODYzNDExLDExNC45MzU3OTggMTI4LjUyMTQ3MSwxMTIuNDcwNjY4IDEzMC41MDc4NzgsMTA5LjQwNDgyIEwxNjcuMDk5NDk2LDUzLjE0NDMyNDEgQzE3MS4wNzgxOTksNDcuMDI5NDU1MiAxNzAuMTE3Mzg3LDQ2LjI1NjI2MjUgMTY0Ljk2NTg1NCw1MS40MTQ1MjYzIEw4NC41NzA2NDA2LDEzMS44MDIxNjggQzc5LjQxMDY5NDEsMTM2Ljk2MTI3MyA4MS4xNDM4NTczLDE0MS4xMjA4NjUgODguNDQxNjUyMSwxNDEuMDkxNDE4IEwxMTYuMDE0OTMyLDE0MC45Nzk1MTkgQzEyMy4zMDc2NzksMTQwLjk0OTIzMSAxMjYuMDA0MTc4LDE0NS44ODIwMTUgMTIyLjAyNjMxNiwxNTEuOTk4NTY3IEw4NS40MzYzODA4LDIwOC4yNjA3NDUgQzgzLjQ0OTEzMjUsMjExLjMxOTAyMSA4My45Mjg2OTcxLDIxMS43MTM2MSA4Ni41MTgzNDU4LDIwOS4xNDQxNTQgTDE0My45Nzc3NTMsMTUyLjA5Mjc5NyBDMTQ2LjU2MzE5NSwxNDkuNTE5OTc1IDE1MC43Mzc5MzEsMTQ1LjMzNTk4NSAxNTMuMjg5NzE5LDE0Mi43MzYyNCBMMTcxLjYzNTE2NywxMjQuMTMzMzQxIEMxNzYuNzU2NDEyLDExOC45NDM5NDggMTc0Ljk4OTU5NSwxMTQuNzQ4MTc5IDE2Ny43MDAyMTQsMTE0Ljc4MDE1IFoiIGlkPSJTaGFwZSI+PC9wYXRoPiAgICAgICAgICAgICAgICA8L2c+ICAgICAgICAgICAgPC9nPiAgICAgICAgPC9nPiAgICA8L2c+PC9zdmc+);
      width: 30px;
    height: 30px;
    position: absolute;
    display: inline-block;
    background-repeat: no-repeat;
    background-size: 30px;
    left: 0px;
    top: 10px;           
}
.wrap .amp_installed_heading{
    color: #333;
    padding-left: 40px;
    position: relative;
    font-weight: 300;            
}
.amp_installed_text{ margin: 10px 0px 20px 0px; max-width: 700px}
.amp_installed_text p {
    margin: 0;
    font-size: 18px;
    font-weight: 300;
    line-height: 27px;
    color: #666;
}
.amp_user_onboarding_choose p{color: #444}
	</style>
<?php }