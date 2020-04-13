<?php
namespace AMPforWP\AMPVendor;
use AMPforWP\AMPVendor\AMP_DOM_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class AMP_Server_Side_Rendering {
	public function ampforwp_server_side_redering($dom,$xpath){
		AMP_Server_Side_Rendering::ampforwp_get_transform_attribute($dom,$xpath);
		AMP_Server_Side_Rendering::ampforwp_remove_ssr_boilerplate($dom,$xpath);
		AMP_Server_Side_Rendering::ampforwp_add_ssr_runtime_css($dom,$xpath);
		return $dom->saveHTML();
	}
	public static function ampforwp_get_transform_attribute($dom,$xpath) {
		$is_boilerplate = AMP_Server_Side_Rendering::ampforwp_check_element_existance($dom,$xpath);
		$nodes = $xpath->query("//html");
		foreach($nodes as $node) {
		    $node->setAttribute('i-amphtml-layout', '');
			if($is_boilerplate){
		    	$node->setAttribute('i-amphtml-no-boilerplate', '');
			}
		    $node->setAttribute('transformed', 'self;v=1');
		}
		return;
	}
	public static function ampforwp_check_element_existance($dom,$xpath){
		$is_boilerplate = true;
		$elem_arr = array('amp-experiment','amp-dynamic-css-classes');
		$nodes = $xpath->query("//script[@custom-element]");
	    foreach ($nodes as $node) {
	      	$element = $node->getAttribute('custom-element');
	      	if(in_array($element, $elem_arr)){
	      		$is_boilerplate = false;
	      	}
	    }
	    return $is_boilerplate;
	}
	public static function ampforwp_remove_ssr_boilerplate($dom,$xpath){
		$is_boilerplate = AMP_Server_Side_Rendering::ampforwp_check_element_existance($dom,$xpath);
		if(!$is_boilerplate){
			return false;
		}
		$nodes = $xpath->query("//style[@amp-boilerplate]");
	    foreach ($nodes as $node) {
	      $node->parentNode->removeChild($node);
	    }
	    return;
	}
	public function ampforwp_add_ssr_runtime_css($dom,$xpath){
		$nodes = $xpath->query("//head")->item(0);
		$runtime_css = get_transient('ampforwp_ssr_runtime_css');
		if(!$runtime_css){
			$runtime_css = AMPFORWP_PLUGIN_DIR .'includes/vendor/ssr/local_fallback/v0.css';
			$runtime_css = file_get_contents($runtime_css);
			set_transient('ampforwp_ssr_runtime_css',$runtime_css);
		}
		$style = $dom->createElement('style',$runtime_css);
		$domAttribute = $dom->createAttribute('amp-runtime');
		$style->appendChild($domAttribute);
		$domAttribute = $dom->createAttribute('i-amphtml-version');
		$domAttribute->value = '011905222334000';
		$style->appendChild($domAttribute);
		$nodes->insertBefore($style,$nodes->firstChild);
		return;
	}
}