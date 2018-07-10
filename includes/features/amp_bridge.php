<?php
global $ampforwpMainArray;
function basicAlloptions(){
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
}
add_action("wp_loaded", "basicAlloptions",9);


add_filter("ampforwp_the_content_last_filter", "ampforwp_add_basic_hooks");
function ampforwp_add_basic_hooks($content_buffer){
	global $ampforwpMainArray;

	// Below Header Global
	$content_buffer = preg_replace('[<article(.*?)>]', $ampforwpMainArray['ampforwp_after_header']."\n<article$1> " , $content_buffer, 1);
	// Below Title Single
	$content_buffer = preg_replace('[<header>{1}]', '</header> '.$ampforwpMainArray['ampforwp_before_post_content'] , $content_buffer);
	//$content_buffer = preg_replace('[<\/article>]', '</article> '.$ampforwpMainArray['ampforwp_after_post_content'] , $content_buffer, 1);
	//$content_buffer;
	//ob_start();
	//$hookAfterHeader = do_action('ampforwp_after_header');
	//	$hookAfterHeader = ob_get_contents();
	//ob_end_clean();
	//$contents = explode("</header>", $content_buffer);
	//$content_buffer = $contents[0]."</header>".$ampforwpMainArray['ampforwp_after_header'] .$contents[1];
	//$content_buffer = $contents[0]."</header>".$contents[1];
	return $content_buffer;
}