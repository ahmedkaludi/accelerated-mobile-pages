<?php 
if ( ! class_exists('AMPforWP_Subdomain_Endpoint') ) {
	/**
	 *  Class: Subdomain Endpoint 
	 *  To use Subdomain as AMP endpoint  
	 */
	class AMPforWP_Subdomain_Endpoint
	{
	protected $www;	
	protected $amp;	
		function __construct( )
		{
			$this->www = ( false === strpos( get_home_url() , '://www.') ) ? '://' : '://www.';
			$this->amp = ampforwp_get_setting('ampforwp-subdomain-endpoint') ? ampforwp_get_setting('ampforwp-subdomain-endpoint') : 'amp';
			// Endpoint
			add_filter('ampforwp_is_amp_endpoint', array( $this , 'amp_subdomain_endpoint') );
			// AMPHTML
			add_filter('ampforwp_modify_rel_canonical', array( $this , 'amp_subdomain_amphtml') );
			// Font URLs
			add_filter('ampforwp_font_url', array( $this , 'ampforwp_font_url') );
			// URL Controller
			add_filter('ampforwp_url_controller', array( $this , 'ampforwp_url_controller') );
			// To load the proper file for Index 
			add_filter('amp_post_template_file', array( $this , 'amp_post_template_file'), 11 , 3 );
			// Next Posts Link
			add_filter('ampforwp_next_posts_link', array( $this , 'next_posts_link') , 10 , 2 );
			// Post Pagination links
			add_filter('ampforwp_post_pagination_link', array( $this , 'next_posts_link') , 10 , 2 );
		}

		// Return true if there's a subdomain for AMP (eg: amp.example.com)
		public function amp_subdomain_endpoint( $bool ) {
			if ( isset($_SERVER['HTTP_HOST']) && is_int(strpos($_SERVER['HTTP_HOST'], $this->amp) ) ){
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

		public function amp_post_template_file( $file, $type, $post ) {
			if ( 'single' == $type && is_front_page() && false == ampforwp_get_setting('amp-frontpage-select-option') ) {

				$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';

				if ( defined('AMPFORWP_CUSTOM_THEME') ) {
					$file = AMPFORWP_CUSTOM_THEME . '/index.php';
				}
			}
			return $file;
		}

		public function next_posts_link( $url , $paged ) {

			$url = str_replace('/amp', '', $url);
			$url = str_replace('/?amp=1', '', $url);
			if ( false === strpos( $url, '://' . $this->amp . '.' ) ) {
				$url = str_replace( $this->www, '://' . $this->amp . '.', $url );
			}
			return $url;
		}
 
	}
	// Initiate the Class
	new AMPforWP_Subdomain_Endpoint();
}