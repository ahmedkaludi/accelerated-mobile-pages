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
      'desc'  => "<p>".esc_html__("<strong>We need your help in improving this plugin!</strong></p>
<p>We take every issue and bug report very seriously. Me and my team personally goes through your feedback and works hard on solving them.</p>",'accelerated-mobile-pages')."
<p>
<a href='https://ampforwp.com/support/' style='background: #E91E63;
    padding: 10px 16px;
    text-decoration: none;
    color: #fff;
    margin-top: 10px;
    display: inline-block;
    font-size: 16px;
    border-radius: 3px;' target='_blank'>Report an Error</a>
<a href='https://ampforwp.com/support/' style='background: #4CAF50;
    padding: 10px 16px;
    text-decoration: none;margin-left:9px;
    color: #fff;
    margin-top: 10px;
    display: inline-block;
    font-size: 16px;
    border-radius: 3px;' target='_blank'>Request a Feature</a></p><br />",
);

	    return $sections;
	}
}
?>