<?php 
	use AMPforWP\AMPVendor\AMP_DOM_Utils;
	add_filter('ampforwp_theme_dir','ampforwp_convert_to_native_mode');
	function ampforwp_convert_to_native_mode($theme){
		return get_template_directory();
	}
	add_filter( 'ampforwp_the_content_last_filter','ampforwp_santize_native_mode_content',8);
	function ampforwp_santize_native_mode_content($content){
		$content = ampforwp_process_body_content($content);
		$dom = AMP_DOM_Utils::get_dom_from_content($content);
		@$dom->loadHTML($content);
		$xpath = new DOMXPath($dom);
		ampforwp_process_native_content($dom,$xpath);
		return $dom->saveHTML();
	}
	function ampforwp_process_body_content($content){
		preg_match('/<body(.*?)>(.*?)<\/body>/s',$content,$matches);
		$amp_custom_content = new AMP_Content( $matches[2],
	      apply_filters( 'amp_content_embed_handlers', array(
	  				    'AMP_Twitter_Embed_Handler'     => array(),
	  				    'AMP_YouTube_Embed_Handler'     => array(),
						'AMP_DailyMotion_Embed_Handler' => array(),
						'AMP_Vimeo_Embed_Handler'       => array(),
						'AMP_SoundCloud_Embed_Handler'  => array(),
						'AMP_Instagram_Embed_Handler'   => array(),
						'AMP_Vine_Embed_Handler'        => array(),
						'AMP_Facebook_Embed_Handler'    => array(),
						'AMP_Pinterest_Embed_Handler'   => array(),
						'AMP_Gallery_Embed_Handler'     => array(),
						'AMP_Playlist_Embed_Handler'    => array(),
	      ) ),
	      apply_filters(  'amp_content_sanitizers', array(
	  				    'AMP_Style_Sanitizer'     => array(),
	  				    'AMP_Blacklist_Sanitizer' => array(),
	  				    'AMP_Img_Sanitizer'       => array(),
	  				    'AMP_Video_Sanitizer'     => array(),
	  				    'AMP_Audio_Sanitizer'     => array(),
	          			'AMP_Playbuzz_Sanitizer'  => array(),
	  				    'AMP_Iframe_Sanitizer'    => array(
	  					       'add_placeholder' => true,
	  				    ),
	      )  )
	  );
	  $con = $amp_custom_content->get_amp_content();
	  $content = str_replace($matches[2], $con, $content);
	  return $content;	
	}
	function ampforwp_process_native_content($dom,$xpath) {
		$nodes = $xpath->query("//html");
		foreach($nodes as $node) {
		    $node->setAttribute('amp','');
		}
		$nodes = $xpath->query("//script");
	    foreach ($nodes as $node) {
	      	$node->parentNode->removeChild($node);
	    }
	    $node_value = '';
	    $nodes = $xpath->query('//link[@rel="stylesheet"]');
	    foreach ($nodes as $node) {
	      	$href = $node->getAttribute('href');
			$node_value .= ampforwp_native_css_sanitize(file_get_contents($href));
	      	$node->parentNode->removeChild($node);
	    }
	    $nodes = $xpath->query('//style');
	    foreach ($nodes as $node) {
	      	$node_value .= ampforwp_native_css_sanitize($node->nodeValue);
	      	$node->parentNode->removeChild($node);
	    } 
	    $nodes = $xpath->query("//head")->item(0);
	
	    ampforwp_native_boilerplate($dom,$xpath,$nodes);
		// AMP Custom CSS
		$style = $dom->createElement('style',$node_value);
		$domAttribute = $dom->createAttribute('amp-custom');
		$style->appendChild($domAttribute);
		$nodes->insertBefore($style,$nodes->firstChild);

		ampforwp_native_process_v0($dom,$xpath,$nodes);
	}
	function ampforwp_native_boilerplate($dom,$xpath,$nodes){
	    $boiler_css = 'body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}';

	    $noscript_css = 'body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}';

	    // AMP boilerplate in noscript 
	    $noscript = $dom->createElement("noscript");
	    $dom->appendChild($noscript);
	    $noscript_boiler = $dom->createElement("style",$noscript_css);
	    $noscript->appendChild($noscript_boiler);
	    $domAttribute = $dom->createAttribute('amp-boilerplate');
	    $noscript_boiler->appendChild($domAttribute);
	    $nodes->insertBefore($noscript,$nodes->firstChild);
	
		//AMP boilerplate
		$boilerplate = $dom->createElement('style',$boiler_css);
		$domAttribute = $dom->createAttribute('amp-boilerplate');
		$boilerplate->appendChild($domAttribute);
		$nodes->insertBefore($boilerplate,$nodes->firstChild);
	}
	function ampforwp_native_process_v0($dom,$xpath,$nodes){
		// AMP v0.js
		$v0js = $dom->createElement('script');
		$domAttribute = $dom->createAttribute('async');
		$v0js->appendChild($domAttribute);
		$domAttribute = $dom->createAttribute('src');
		$v0js->appendChild($domAttribute);
		$v0js->setAttribute("src", "https://cdn.ampproject.org/v0.js");
		$nodes->insertBefore($v0js,$nodes->firstChild);
		
		// AMP v0.js link
		$v0jslink = $dom->createElement('link');
		$domAttribute = $dom->createAttribute('rel');
		$v0jslink->appendChild($domAttribute);
		$v0jslink->setAttribute("rel", "preload");
		$domAttribute = $dom->createAttribute('as');
		$v0jslink->appendChild($domAttribute);
		$v0jslink->setAttribute("as", "script");
		$domAttribute = $dom->createAttribute('as');
		$v0jslink->appendChild($domAttribute);
		$v0jslink->setAttribute("as", "script");
		$domAttribute = $dom->createAttribute('href');
		$v0jslink->appendChild($domAttribute);
		$v0jslink->setAttribute("href", "https://cdn.ampproject.org/v0.js");
		$nodes->insertBefore($v0jslink,$nodes->firstChild);
	}
	function ampforwp_native_css_sanitize($css){
		$css = preg_replace( '/\s*!important/', '', $css, -1, $important_count );
		$css = preg_replace( '/\s*@charset "UTF-8";/', '', $css, -1, $important_count );
		$css = preg_replace( '/overflow(-[xy])?\s*:\s*(auto|scroll)\s*;?\s*/', '', $css, -1, $overlow_count );
            $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}', '::-' ), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ', ', '}', ' ::-'), $css);
		return $css;
	}
?>