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
		
	}
	// Initiate the Class
	new AMPforWP_Subdomain_Endpoint();
}