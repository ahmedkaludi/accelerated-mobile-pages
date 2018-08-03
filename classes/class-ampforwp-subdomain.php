<?php 
if ( ! class_exists('AMPforWP_Subdomain_Endpoint') ) {
	/**
	 *  Class: Subdomain Endpoint 
	 *  To use Subdomain as AMP endpoint  
	 */
	class AMPforWP_Subdomain_Endpoint
	{
	protected $www;	
	protected $amp = 'amp';	
		function __construct( )
		{
			$this->www = ( false === strpos( get_home_url() , '://www.') ) ? '://' : '://www.';
			add_filter('ampforwp_is_amp_endpoint', array( $this , 'amp_subdomain_endpoint') );
			add_filter('ampforwp_modify_rel_canonical', array( $this , 'amp_subdomain_amphtml') );
			add_filter('ampforwp_font_url', array( $this , 'ampforwp_font_url') );
			add_filter('ampforwp_url_controller', array( $this , 'ampforwp_url_controller') );
		}

		// Return true if there's AMP in subdomain (amp.example.com)
		public function amp_subdomain_endpoint( $bool ) {
			if ( isset($_SERVER['HTTP_HOST']) && is_int(strpos($_SERVER['HTTP_HOST'], 'amp') ) ){
				$bool = true;
			}
			return $bool;
		}

		public function amp_subdomain_amphtml( $amphtml ) {

			$amphtml = str_replace('/amp', '', $amphtml);
			if ( false === strpos( $amphtml, '://' . $this->amp . '.' ) ) {
				$amphtml = str_replace( $this->www, '://' . $this->amp . '.', $amphtml );
			}

			return $amphtml;
		}

		public function ampforwp_font_url( $url ) {
			if ( false === strpos( $url, '://' . $this->amp . '.' ) ) {
				$url = str_replace( $this->www, '://' . $this->amp . '.', $url );
			}
			return $url;
		}

		public function ampforwp_url_controller( $url ) {

			$url = str_replace('/amp', '', $url);
			if ( false === strpos( $url, '://' . $this->amp . '.' ) ) {
				$url = str_replace( $this->www, '://' . $this->amp . '.', $url );
			}
			return $url;
		}
 
	}
	// Initiate the Class
	new AMPforWP_Subdomain_Endpoint();
}