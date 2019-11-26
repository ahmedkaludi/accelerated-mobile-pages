<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $ampforwpMainArray;
function amp_basicAlloptions(){
	global $ampforwpMainArray;
	ob_start();
	do_action('ampforwp_after_header');
	$hookAfterHeader = ob_get_contents();
	ob_end_clean();
	if(isset($ampforwpMainArray['ampforwp_after_header'])){
		$ampforwpMainArray['ampforwp_after_header'] .= $hookAfterHeader;
	}else{
		$ampforwpMainArray['ampforwp_after_header'] = $hookAfterHeader;
	}

	ob_start();
	do_action('ampforwp_before_post_content');
	$hookbeforeContent = ob_get_contents();
	ob_end_clean();
	if(isset($ampforwpMainArray['ampforwp_before_post_content'])){
		$ampforwpMainArray['ampforwp_before_post_content'] .= $hookbeforeContent;
	}else{
		$ampforwpMainArray['ampforwp_before_post_content'] = $hookbeforeContent;
	}
	
	ob_start();
	do_action('ampforwp_after_post_content');
	$hookafterContent = ob_get_contents();
	ob_end_clean();
	if(isset($ampforwpMainArray['ampforwp_after_post_content'])){
		$ampforwpMainArray['ampforwp_after_post_content'] .= $hookafterContent;
	}else{
		$ampforwpMainArray['ampforwp_after_post_content'] = $hookafterContent;
	}

	ob_start();
	do_action('ampforwp_below_the_title');
	$hook_below_the_title = ob_get_contents();
	ob_end_clean();
	if(isset($ampforwpMainArray['ampforwp_below_the_title'])){
		$ampforwpMainArray['ampforwp_below_the_title'] .= $hook_below_the_title;
	}else{
		$ampforwpMainArray['ampforwp_below_the_title'] = $hook_below_the_title;
	}

	//One signal
	ob_start();
	do_action('ampforwp_body_beginning');
	$hook_body_beginning = ob_get_contents();
	ob_end_clean();
	if(isset($ampforwpMainArray['ampforwp_body_beginning'])){
		$ampforwpMainArray['ampforwp_body_beginning'] .= $hook_body_beginning;
	}else{
		$ampforwpMainArray['ampforwp_body_beginning'] = $hook_body_beginning;
	}

	ob_start();
	do_action('ampforwp_global_after_footer');
	$hook_global_after_footer = ob_get_contents();
	ob_end_clean();
	if(isset($ampforwpMainArray['ampforwp_global_after_footer'])){
		$ampforwpMainArray['ampforwp_global_after_footer'] .= $hook_global_after_footer;
	}else{
		$ampforwpMainArray['ampforwp_global_after_footer'] = $hook_global_after_footer;
	}

	ob_start();
	do_action('amp_footer_link');
	$hook_global_after_footer = ob_get_contents();
	ob_end_clean();
	if(isset($ampforwpMainArray['amp_footer_link'])){
		$ampforwpMainArray['amp_footer_link'] .= $hook_global_after_footer;
	}else{
		$ampforwpMainArray['amp_footer_link'] = $hook_global_after_footer;
	}
}
add_action("pre_amp_render_post", "amp_basicAlloptions",4);

add_filter("ampforwp_the_content_last_filter", "ampforwp_add_basic_hooks");
function ampforwp_add_basic_hooks($content_buffer){
	global $ampforwpMainArray;

	// Below Header Global
	$content_buffer = preg_replace('[<article(.*?)>]', $ampforwpMainArray['ampforwp_after_header']."\n<article$1> " , $content_buffer, 1);
	if (preg_match("#<article(.+?)>(.+?)<\/header>(.+?)<div(.*?)>#si", $content_buffer, $match)){
		// Below Title Single
		$content_buffer = preg_replace('#<article(.+?)>(.+?)<\/header>(.+?)<div(.*?)>#si',  "<article$1> $2</header>$3".$ampforwpMainArray['ampforwp_before_post_content']."\n<div$4>" , $content_buffer);
	}
	
	$content_buffer = preg_replace('#<article(.+?)>(.+?)<footer(.+?)>#si',  "<article$1>$2".$ampforwpMainArray['ampforwp_after_post_content']."<footer$3>" , $content_buffer);

	if (preg_match("#<article(.+?)>(.+?)<\/header>#si", $content_buffer, $match)){
		$content_buffer = preg_replace('#<article(.+?)>(.+?)<\/header>#si',  "<article$1>$2".$ampforwpMainArray['ampforwp_below_the_title']."\n</header>" , $content_buffer);
	}

	$content_buffer = preg_replace('#<body(.+?)>(.+?)<header(.+?)>#si',  "<body$1>".$ampforwpMainArray['ampforwp_body_beginning']."\n$2<header$3>" , $content_buffer);
	$content_buffer = preg_replace('#<\/article>(.+?)<\/footer>#si',  "</article>$1</footer>".$ampforwpMainArray['ampforwp_global_after_footer'] , $content_buffer);
	
	return $content_buffer;
}

if(!function_exists('ampforwp_is_non_amp')){
	function ampforwp_is_non_amp() {
		return false;
	}
}

if(!function_exists('checkAMPforPageBuilderStatus')){
	function checkAMPforPageBuilderStatus(){
		return false;
	}
}