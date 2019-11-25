<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}	
if ( class_exists( 'WP_Widget_Text' ) && ! class_exists('AMP_Widget_Text') ) {
	/**
	 * Class AMP_Widget_Text
	 *
	 * @since 0.7.0
	 * @package AMP
	 */
	class AMP_Widget_Text extends WP_Widget_Text {

		/**
		 * Overrides the parent callback that strips width and height attributes.
		 *
		 * @param array $matches The matches returned from preg_replace_callback().
		 * @return string $html The markup, unaltered.
		 */
		public function inject_video_max_width_style( $matches ) {
			if ( false === get_query_var( AMP_QUERY_VAR, false ) ) {
			//if ( is_amp_endpoint() ) {
				return $matches[0];
			}
			return parent::inject_video_max_width_style( $matches );
		}

	}

}
