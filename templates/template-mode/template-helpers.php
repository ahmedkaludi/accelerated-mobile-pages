<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
function ampforwp_head(){
	 do_action('levelup_head');	
	 do_action('levelup_css');
}