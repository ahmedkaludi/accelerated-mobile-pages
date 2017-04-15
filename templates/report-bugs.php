<?php
if ( ! function_exists( 'ampforwp_reporting_bugs' ) ) {
	function ampforwp_reporting_bugs($sections){

$sections[] = array(
      'title'      => __( 'Report an Issue /<br> Request a Feature', 'accelerated-mobile-pages' ),
      // 'id'         => 'opt-structured-data',
      // 'subsection' => true,
      'icon' => 'el el-warning-sign ',
      'desc'  => "<p><br />".__("<h3>Tell Us What's Happening</h3><strong>We need your help in improving this plugin!</strong></p>
<p>We take every issue and bug report very seriously. Me and my team personally goes through your feedback and works hard on solving them.</p>",'accelerated-mobile-pages')."
<p>
<a href='https://goo.gl/forms/zIks2sTbhBZK0A3L2' style='background: #E91E63;
    padding: 10px 16px;
    text-decoration: none;
    color: #fff;
    margin-top: 10px;
    display: inline-block;
    font-size: 16px;
    border-radius: 3px;' target='_blank'>Report an Error</a>
<a href='https://goo.gl/forms/GVeHSzpZVWBok2oo2' style='background: #4CAF50;
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
  add_filter("redux/options/redux_builder_amp/sections", 'ampforwp_reporting_bugs', PHP_INT_MAX);
?>