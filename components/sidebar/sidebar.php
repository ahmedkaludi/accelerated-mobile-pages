<?php
if(!function_exists('ampforwp_framework_get_sideabr')){
	function ampforwp_framework_get_sideabr($data=array()){
		if(!isset($data['action'])){
			echo 'action not found';
		}
		$action = $data['action'];
		unset($data['action']);
		switch(strtolower($action)) {
			case 'start':
				echo sideber_begin($data);
				do_action('amp_sidebar_start');
				break;
			case 'end':
				do_action('amp_sidebar_end');
				echo sideber_end();
				break;
			case 'open-button':
				echo sidebar_opening_button($data);
				break;
			case 'close-button':
				echo sidebar_close_button($data);
				break;
			default:
				echo 'action not found';
				break;
		}
	}
}
function sidebar_close_button($data=array() ){
	$id = 'sidebar';
	$class = 'amp-sidebar-close';
	if(isset($data['id'])){
		$id = $data['id'];
	}
	if(isset($data['class'])){
		$class .= $data['class'];
	}
	return '<div role="button" tabindex="0" on="tap:'.$id.'.close" class="'.$class.'">X</div>';
}
function sidebar_opening_button($data=array()){
	$id = 'sidebar';
	$class = 'amp-sidebar-button';
	if(isset($data['id'])){
		$id = $data['id'];
	}
	if(isset($data['class'])){
		$class = $data['class'];
	}
	return '<div on="tap:'.$id.'.toggle" role="button" tabindex="0" class="'.$class.'">
						<a href="#" class="amp-sidebar-toggle">
							<span></span>
							<span></span>
							<span></span>
						</a>
				</div>';
}
function sideber_begin($data=array()){
	$attribute = '';
	if(count($data)>0){
		foreach ($data as $key => $value) {
			$attribute .= $key.'="'.$value.'" ' ;
		}
	}else{
		$attribute = "id='sidebar' layout='nodisplay' side='right'";
	}
	return '<amp-sidebar '.$attribute.'>';
}

function sideber_end(){
	return '</amp-sidebar>';
}
ampforwp_add_sidebar_scripts();
function ampforwp_add_sidebar_scripts(){
	global $scriptComponent;
	if ( empty( $scriptComponent['amp-sidebar'] ) ) {
			$scriptComponent['amp-sidebar'] = 'https://cdn.ampproject.org/v0/amp-sidebar-0.1.js';
		}
}