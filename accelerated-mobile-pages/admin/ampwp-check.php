<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'AmpWP_check' ) ) {
	/**
	 * Class that does all the checks to determine if we are dealing with a Mobile browser
	 *
	 * @package AmpWP
	 * @since 1.0
	 */
	class AmpWP_check {

		private $browser	= '';
		private $activated	= FALSE;
		private $theme		= '';

		/**
		 * Initialize the checking for a mobile browser
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		public function ampwp_detect_device() {
			// ?amp will render the selected non-touch mobile theme
			// ?noamp renders the standard selected WordPress theme
			if ( isset( $_GET['amp'] ) ) {
				$this->browser		= 'mobile';
				$this->activated	= TRUE;
				$this->theme		= 'default';
			} else if ( isset( $_GET['noamp'] ) ) {
				$this->activated	= FALSE;
			} else if ( $this->is_mobile( $_SERVER['HTTP_USER_AGENT'], $_SERVER['HTTP_ACCEPT'] ) ) {
				if ( $this->is_bot( $_SERVER['HTTP_USER_AGENT'] ) ) {
					$this->browser		= 'mobile';
					$this->activated	= TRUE;
					$this->theme		= 'default';
				} else {
					$this->browser		= 'mobile';
					$this->activated	= TRUE;
					$this->theme		= 'default';
				}
			}

			if ( $_SESSION['AMPWP_MOBILE_BROWSER'] != $this->browser && isset( $_SESSION['AMPWP_MOBILE_BROWSER'] ) ) {
				session_unset();
				session_destroy();
			}

			$_SESSION['AMPWP_MOBILE_BROWSER'] 	= $this->browser;
			$_SESSION['AMPWP_MOBILE_ACTIVE'] 	= $this->activated;
			$_SESSION['AMPWP_MOBILE_THEME'] 		= $this->theme;
		}

		/**
		 * Checks if the browser / device is a search engine spider
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		private function is_bot( $user_agent ) {
			if ( preg_match( '/(askjeeves|baiduspider|baiduspider-mobile|baiduspider-mobile-gate|fastcrawler|fastmobilecrawl|gigabot|googlebot|googlebot-mobile|ia_archiver|infoseek|larbin|lmspider|lycos|lycos_spider|mediapartners-google|msnbot|msnbot-mobile|muscatferret|naverbot|nutch|omniexplorer_bot|pompos|roboobot|scooter|slurp|teoma|turnitinbot|yahoo|yahooseeker|youdaobot|yodaoBot-mobile|zyborg)/i', $user_agent ) ) {
				return TRUE;
			}

			return FALSE;
		}

		/**
		 * Checks if the browser / device is a mobile device
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		private function is_mobile( $user_agent, $http_accept = NULL, $http_profile = NULL, $wap_profile = NULL ) {
			if ( preg_match( '/(alcatel|android|avantgo|bada|benq|blackberry|configuration\/cldc|docomo|ericsson|hp |hp-|hpwos|htc |htc_|htc-|iemobile|iphone|ipod|kddi|kindle|maemo|meego|midp|mmp|motorola|mobi|mobile|netfront|nokia|opera mini|opera mobi|openweb|palm|palmos|pocket|portalmmm|ppc;|sagem|sharp|series60|series70|series80|series90|smartphone|sonyericsson|spv|symbian|teleca q|telus|treo|up.browser|up.link|vodafone|webos|windows ce|windows phone os 7|xda|zte)/i', $user_agent ) ) {
				return TRUE;
			} else if ( in_array( strtolower( substr( $user_agent, 0, 3 ) ), array( 'lg ' => 'lg ', 'lg-' => 'lg-', 'lg_' => 'lg_', 'lge' => 'lge' ) ) ) {
				return TRUE;
			} else if ( in_array( strtolower( substr( $user_agent , 0, 4 ) ), array( 'acs-' => 'acs-', 'amoi' => 'amoi', 'doco' => 'doco', 'eric' => 'eric', 'huaw' => 'huaw', 'lct_' => 'lct_', 'leno' => 'leno', 'mobi' => 'mobi', 'mot-' => 'mot-', 'moto' => 'moto', 'nec-' => 'nec-', 'phil' => 'phil', 'sams' => 'sams', 'sch-' => 'sch-', 'shar' => 'shar', 'sie-' => 'sie-', 'wap_' => 'wap_', 'zte-' => 'zte-' ) ) ) {
				return TRUE;
			} else if ( ( ( stripos( strtolower( $http_accept ), 'text/vnd.wap.wml' ) > 0 ) || ( stripos( strtolower( $http_accept ), 'application/vnd.wap.xhtml+xml' ) > 0 ) ) || ( ( isset( $wap_profile ) || isset( $http_profile ) ) ) ) {
				return TRUE;
			}

			return FALSE;
		}

		/**
		 * Checks if the browser / device is a tablet (constantly being updated)
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		private function is_tablet( $user_agent ) {
			if ( preg_match( '/(a100|a500|a501|a510|a700|dell streak|et-701|ipad|gt-n7000|gt-p1000|gt-p6200|gt-p6800|gt-p7100|gt-p7310|gt-p7510|lg-v905h|lg-v905r|kindle|rim tablet|sch-i800|silk|sl101|tablet|tf101|tf201|xoom)/i', $user_agent ) ) {
				return TRUE;
			}

			return FALSE;
		}

		/**
		 * Checks if the browser / device is a touch screen / smart phone (constantly being updated)
		 *
		 * @package AmpWP
		 * @since 1.0
		 */
		private function is_touch( $user_agent ) {
			if ( preg_match( '/(ipod|iphone)/i', $user_agent ) ) {
				return TRUE;
			} else if ( preg_match( '/android (\d+\.\d+(\.\d+)*)/i', $user_agent, $version ) ) {
				if ( $version[1] >= '2.1' ) {
					return TRUE;
				}
			} else if ( preg_match( '/(bada|blackberry9670|blackberry 9670|blackberry9800|blackberry 9800|blackberry9810|blackberry 9810|dolfin|maemo|meego|s8000|windows phone os 7)/i', $user_agent ) ) {
				return TRUE;
			} else if ( preg_match( '/webos\/(\d+\.\d+(\.\d+)*)/i', $user_agent, $version ) ) {
				if ( $version[1] >= '1.4' ) {
					return TRUE;
				}
			}

			return FALSE;
		}
	}
}
?>