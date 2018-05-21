<?php

add_action( 'init', 'remove_amp_init', 100 );
function remove_amp_init(){
	remove_action( 'admin_init', 'AMP_Options_Manager::register_settings' );
	remove_action( 'wp_loaded', 'amp_post_meta_box' );
	remove_action( 'wp_loaded', 'amp_add_options_menu' );
	remove_action( 'parse_query', 'amp_correct_query_when_is_front_page' );
}