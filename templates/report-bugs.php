<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! function_exists( 'ampforwp_reporting_bugs' ) ) {
	function ampforwp_reporting_bugs($sections){

$sections[] = array(
      'title'      => esc_html__( 'Send Feedback', 'accelerated-mobile-pages' ),
      // 'id'         => 'opt-structured-data',
      // 'subsection' => true,
      'icon' => 'el el-group',
      'desc'  =>    '<p><strong>' . esc_html__("We need your help in improving this plugin!", "accelerated-mobile-pages") . '</strong></p>
                    <p>' . esc_html__("We take every issue and bug report very seriously. Me and my team personally goes through your feedback and works hard on solving them.", "accelerated-mobile-pages") . '</p>
                    <p>' . sprintf( __("<a href=\"%s\" style=\"background: #E91E63; padding: 10px 16px; text-decoration: none; color: #fff; margin-top: 10px; display: inline-block; font-size: 16px; border-radius: 3px;\" target=\"_blank\">Report an Error</a> <a href=\"%s\" style=\"background: #4CAF50; padding: 10px 16px; text-decoration: none; margin-left:9px; color: #fff; margin-top: 10px; display: inline-block; font-size: 16px; border-radius: 3px;\" target=\"_blank\">Request a Feature</a>", "accelerated-mobile-pages" ), "https://ampforwp.com/support/", "https://ampforwp.com/support/" ) . '</p>
                    <br />'
);

	    return $sections;
	}
}
?>