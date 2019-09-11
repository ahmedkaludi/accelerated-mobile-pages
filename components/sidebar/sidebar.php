<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if(!function_exists('ampforwp_framework_get_sideabr')){
	function ampforwp_framework_get_sideabr($data=array()){
		if(!isset($data['action'])){
			echo esc_attr('action not found');
		}
		$action = $data['action'];
		unset($data['action']);
		switch(strtolower($action)) {
			case 'start':
				echo (ampforwp_sideber_begin($data));
				do_action('amp_sidebar_start');
				break;
			case 'end':
				do_action('amp_sidebar_end');
				echo (ampforwp_sideber_end());
				break;
			case 'open-button':
				echo (ampforwp_sidebar_opening_button($data));
				break;
			case 'close-button':
				echo (ampforwp_sidebar_close_button($data));
				break;
			default:
				echo 'action not found';
				break;
		}
	}
}
function ampforwp_sidebar_close_button($data=array() ){
	$id = 'sidebar';
	$class = 'amp-sidebar-close';
	if(isset($data['id'])){
		$id = $data['id'];
	}
	if(isset($data['class'])){
		$class .= $data['class'];
	}
	return '<div role="button" tabindex="0" on="tap:'.esc_attr( $id ).'.close" class="'.esc_attr( $class ).'">X</div>';
}
function ampforwp_sidebar_opening_button($data=array()){
	$id = 'sidebar';
	$class = 'amp-sidebar-button';
	if(isset($data['id'])){
		$id = $data['id'];
	}
	if(isset($data['class'])){
		$class = $data['class'];
	}
	return '<div on="tap:'.esc_attr( $id ).'.toggle" role="button" tabindex="0" class="'. esc_attr( $class ) .'">
						<a href="#" class="amp-sidebar-toggle">
							<span></span>
							<span></span>
							<span></span>
						</a>
				</div>';
}
function ampforwp_sideber_begin($data=array()){
	$attribute = '';
	if(count($data)>0){
		foreach ($data as $key => $value) {
			$attribute .= esc_attr($key).'="'.esc_attr($value).'" ';
		}
	}else{
		$attribute = "id='sidebar' layout='nodisplay' side='right'";
	}
	return '<amp-sidebar '. $attribute .'>';
}

function ampforwp_sideber_end(){
	return '</amp-sidebar>';
}

ampforwp_add_sidebar_scripts();
function ampforwp_add_sidebar_scripts(){
	global $scriptComponent;
	if ( empty( $scriptComponent['amp-sidebar'] ) ) {
			$scriptComponent['amp-sidebar'] = 'https://cdn.ampproject.org/v0/amp-sidebar-0.1.js';
		}
}