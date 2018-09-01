<?php 
add_action( 'admin_post_ampforwp_beta', 'post_ampforwp_beta' );
function post_ampforwp_beta(){
	check_admin_referer('ampforwp_beta');

	$plugin_slug = basename( 'accelerated-mobile-pages', '.php' );

		$beta = new AMPforWP_Beta(
			[
				'version' => 'beta',
				'plugin_name' => 'accelerated-mobile-pages',
				'plugin_slug' => $plugin_slug,
				'package_url' => sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', $plugin_slug, '0.6.0' ),

			]
		);

		$beta->ampforwp_beta_run();
		wp_die(
			'', __( 'Activate the Beta', 'accelerated-mobile-pages' ), [
				'response' => 200,
			]
		);
}

class AMPforWP_Beta {

	protected $package_url;

	protected $version;

	protected $plugin_name;

	protected $plugin_slug;

	public function __construct( $args = [] ) {
		foreach ( $args as $key => $value ) {
			$this->{$key} = $value;
		}
	}

	/**
	 * Change the plugin data when WordPress checks for updates.
	 */
	protected function ampforwp_beta_package() {
		$update_plugins = get_site_transient( 'update_plugins' );
		if ( ! is_object( $update_plugins ) ) {
			$update_plugins = new stdClass();
		}

		$plugin_info = new stdClass();
		$plugin_info->new_version = $this->version;
		$plugin_info->slug = $this->plugin_slug;
		$plugin_info->package = $this->package_url;
		$plugin_info->url = 'https://ampforwp.com/';

		$update_plugins->response[ $this->plugin_name ] = $plugin_info;

		set_site_transient( 'update_plugins', $update_plugins );
	}

	protected function ampfrowp_beta_upgrade() {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

		$logo_url = 'https://ampforwp.com/wp-content/uploads/2017/07/ampforwp-200-1.png';

		$upgrader_args = [
			'url' => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( $this->plugin_name ),
			'plugin' => $this->plugin_name,
			'nonce' => 'upgrade-plugin_' . $this->plugin_name,
			'title' => '<img src="' . $logo_url . '" alt="accelerated-mobile-pages">' . __( 'Activate the Beta Version', 'accelerated-mobile-pages' ),
		];

		$this->ampforwp_beta_page_styling();

		$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin( $upgrader_args ) );
		$upgrader->upgrade( $this->plugin_name );
	}

	public function ampforwp_beta_run() {
		$this->ampforwp_beta_package();
		$this->ampfrowp_beta_upgrade();
	}

	private function ampforwp_beta_page_styling() {
		?>
		<style>
			.wrap {
				overflow: hidden;
			}

			h1 {
				background: #9b0a46;
				text-align: center;
				color: #fff !important;
				padding: 70px !important;
				text-transform: uppercase;
				letter-spacing: 1px;
			}

			h1 img {
				max-width: 300px;
				display: block;
				margin: auto auto 50px;
			}
		</style>
		<?php
	}
}