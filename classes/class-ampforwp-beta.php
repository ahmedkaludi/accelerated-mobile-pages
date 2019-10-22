<?php 
add_action( 'admin_post_ampforwp_beta', 'post_ampforwp_beta' );
function post_ampforwp_beta(){
	check_admin_referer('ampforwp_beta');
	if(!current_user_can('install_plugins')){
		wp_die(
			'', esc_html__( 'Current user cannot install plugin', 'accelerated-mobile-pages' ), array(
				'response' => 200,
			)
		);
	}
	$getVersion = '0.9.98.14';
	$plugin_slug = basename( 'accelerated-mobile-pages', '.php' );
	if(isset($_GET['installation']) && $_GET['installation']=='beta'){
		$getVersion = '0.9.98-beta';
	}elseif(isset($_GET['changeversion'])){
		$getVersion = sanitize_text_field($_GET['changeversion']);
	}
	$beta = new AMPforWP_Beta(
		[
			'version' => 'beta',
			'plugin_name' => 'accelerated-mobile-pages',
			'plugin_slug' => esc_html__($plugin_slug,'accelerated-mobile-pages'),
			'package_url' => sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', $plugin_slug, $getVersion ),
			'plugin_version'=> esc_html__($getVersion,'accelerated-mobile-pages'),
		]
	);

	$beta->ampforwp_beta_run();
	wp_die(
		'', esc_html__( 'Activate the '.$getVersion, 'accelerated-mobile-pages' ), [
			'response' => 200,
		]
	);
}


class AMPforWP_Beta {

	protected $package_url;

	protected $version;

	protected $plugin_name;

	protected $plugin_slug;

	protected $plugin_version;

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
			'plugin' => esc_attr($this->plugin_name),
			'nonce' => 'upgrade-plugin_' . $this->plugin_name,
			'title' => '<img src="' . esc_url($logo_url) . '" alt="accelerated-mobile-pages">' . esc_html__( 'Activate the '. $this->plugin_version .' Version', 'accelerated-mobile-pages' ),
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
				background: #ff2fa3;
				text-align: center;
				color: #000 !important;
				padding: 40px !important;
				text-transform: uppercase;
				letter-spacing: 1px;
			}

			h1 img {
				max-width: 300px;
				display: block;
				margin: auto auto 20px;
			}
		</style>
		<?php
	}


}

class AMPFORWP_ROLLBACK{
	/*
	* Rollback functions
	*/
	function __construct(){
		add_action("wp_ajax_ampforwp_get_rollbackdata", array($this, 'ampforwp_get_rollbackdata'));
	}
	function ampforwp_get_rollbackdata(){
		$allTags = $this->get_all_tags();
		$activationUrl = wp_nonce_url( admin_url( 'admin-post.php?action=ampforwp_beta&changeversion='.(is_array($allTags)? key($allTags): '') ), 'ampforwp_beta' );
		echo json_encode(array('status'=> 200, 'versions'=>$allTags, 'url' => $activationUrl, 'text'=>'Activate'));
		wp_die();
	}

	public function get_all_tags(){
		$plugins = get_site_transient( 'update_plugins' );
		if( isset($plugins->response['accelerated-mobile-pages/accelerated-moblie-pages.php']) ){
			delete_transient('ampforwp_plugin_all_tag_versions');
		}
		$transient = get_transient( 'ampforwp_plugin_all_tag_versions' );
		if( is_array($transient) ){
			$allversions = $transient;
		}else{
			$url = 'https://api.wordpress.org/plugins/info/1.0/accelerated-mobile-pages.json';
			$response = wp_remote_get( $url );

			// Do we have an error?
			if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
				return null;
			}

			// Nope: Return that bad boy
			$svn_tags = wp_remote_retrieve_body( $response );
			$allversions = $this->set_svn_versions_data( $svn_tags );
			$allversions = array_reverse($allversions);
			$allversions = array_combine($allversions, $allversions);
			set_transient( 'ampforwp_plugin_all_tag_versions', $allversions );
		}
		return esc_html($allversions);
	} 

	function set_svn_versions_data($html){
		if ( ( $json = json_decode( $html ) ) && ( $html != $json ) ) {
			$versions = array_keys( (array) $json->versions );
		} else {
			$DOM = new DOMDocument();
			$DOM->loadHTML( $html );

			$versions = array();

			$items = $DOM->getElementsByTagName( 'a' );

			foreach ( $items as $item ) {
				$href = str_replace( '/', '', $item->getAttribute( 'href' ) ); // Remove trailing slash

				if ( strpos( $href, 'http' ) === false && '..' !== $href ) {
					$versions[$href] = $href;
				}
			}
		}
		usort( $versions, 'version_compare' );
		return esc_html($versions);


	}
}
function ampforwp_rollback_call(){
	$obj = new AMPFORWP_ROLLBACK();
	return $obj;
}
ampforwp_rollback_call();