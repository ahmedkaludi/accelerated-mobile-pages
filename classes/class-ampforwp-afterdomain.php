<?php 
if ( ! class_exists('AMPforWP_Afterdomain_Endpoint') ) {
	/**
	 *  Class: Afterdomain Endpoint 
	 *  To use Afterdomain as AMP endpoint  
	 */
	class AMPforWP_Afterdomain_Endpoint
	{
	protected $start_points = array();
	protected $end_points = array();
	protected $amp;	
		function __construct( )
		{
			// AMPHTML
			add_filter('ampforwp_modify_rel_canonical', array( $this , 'amp_afterdomain_amphtml')  );
			// URL Controller
			add_filter('ampforwp_url_controller', array( $this , 'ampforwp_url_controller') );
		}
		public function amp_afterdomain_amphtml( $amphtml ) {
			$amphtml = str_replace('/amp', '', $amphtml);
			$amphtml = $this->ampforwp_add_afterdomain($amphtml);
			return $amphtml;
		}

		public function ampforwp_add_afterdomain($url){
			$site_domain = str_replace(
							array(
								'http://www.',
								'https://www.',
								'http://',
								'https://',
							),
							'',
							home_url()
						);

			$delimiter = preg_quote( rtrim( $site_domain, '/' ), $delimiter );
			if ( ! preg_match( '#^https?://w*\.?' . $delimiter . '/?([^/]*)/?([^/]*)/?(.*?)$#', $url, $matched ) ) {

				return false;
			}
			if ( $matched[1] === 'wp-content' ) { // Do not convert link which is started with wp-content 
				return false;
			}

			$before_sp = '';
			$path      = '/';

			if ( $matched[1] ) {
				$matched[0] = ''; 
				$path = implode( '/', array_filter( $matched ) );
			}

			$path = rtrim( $path, '/' );
			$path .= substr( $url, - 1 ) === '/' ? '/' : '';
			$before_sp = '';
			$permalink_structure = get_option( 'permalink_structure' );
			$prefix              = substr( $permalink_structure, 0, strpos( $permalink_structure, '%' ) );
			$url_prefix = ltrim( $prefix, '/' );
			$url =  trailingslashit( home_url( $url_prefix ) );
			$url .= AMPFORWP_AMP_QUERY_VAR;
			if ( $path ) {

					$url .= '/' . ltrim( $path, '/' );
			} 
		 	return $url;
		}

		public function ampforwp_url_controller( $url ) {

			$url = str_replace('/amp', '', $url);
			$url = $this->ampforwp_add_afterdomain($url);
			return $url;
		}
	}
	// Initiate the Class
	new AMPforWP_Afterdomain_Endpoint();
}