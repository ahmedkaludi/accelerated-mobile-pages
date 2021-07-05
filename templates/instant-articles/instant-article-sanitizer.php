<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
add_filter( 'ampforwp_fbia_content', 'ampforwp_ia_modify_gutenburg_gallery');
add_filter( 'ampforwp_fbia_content', 'ampforwp_fbia_headlines');
add_filter( 'ampforwp_fbia_content', 'ampforwp_fbia_filter_dom');
add_filter( 'ampforwp_fbia_content', 'ampforwp_fbia_address_tag');

// DOM Document Filter
if(class_exists("DOMDocument")){
	add_filter( 'ampforwp_fbia_content_dom', 'ampforwp_fbia_list_items_with_content');
	add_filter( 'ampforwp_fbia_content_dom', 'ampforwp_fbia_validate_images');
	add_filter( 'ampforwp_fbia_content_dom','ampforwp_fbia_resize_images');
	// The empty P tags class should run last
	add_filter( 'ampforwp_fbia_content_dom','ampforwp_fbia_no_empty_p_tags');
	// Wrap the Tables and Iframes inside Figure
	add_filter( 'ampforwp_fbia_content_dom','ampforwp_fbia_wrap_elements');
	// Video Filter
	add_filter( 'ampforwp_fbia_content_dom','ampforwp_fbia_video_element');
	// Embeds sanitizer
	add_filter( 'ampforwp_fbia_content_dom','ampforwp_fbia_wrap_embed_elements');
	add_filter( 'post_gallery', 'ampforwp_gallery_shortcode_markup_modify', 10, 3 );
	}
function ampforwp_fbia_headlines($content){
		// Replace h3, h4, h5, h6 with h2
		$content = preg_replace(
			'/<h[3,4,5,6][^>]*>(.*)<\/h[3,4,5,6]>/sU',
			'<h2>$1</h2>',
			$content
		);
		return $content;
	}
function ampforwp_fbia_address_tag($content){
		$content = preg_replace(
			'/<address[^>]*>(.*)<\/address>/sU',
			'<p>$1</p>',
			$content
		);
		return $content;
	}
function ampforwp_fbia_filter_dom($content){
		$DOMDocument = ampforwp_fbia_get_content_DOM($content);

		$DOMDocument = apply_filters("ampforwp_fbia_content_dom", $DOMDocument);

		$content = ampforwp_fbia_get_content_from_DOM($DOMDocument);

		return $content;
	}
function ampforwp_ia_modify_gutenburg_gallery($content){
	
	$allMatches = preg_replace_callback('/<ul\sclass=\"wp-block-gallery(.*?)\"(.*?)>(.*?)<\/ul>/', function($matches) {
        
        return '<figure class="op-slideshow">'.$matches[3].'</figure>';
    }, $content);
    
    $fbiagallery = preg_replace_callback('/<li(.*?)><figure><img(.*?)src=\"(.*?)\"(.*?)\/><\/figure><\/li>/', function($match) {
       
        return '<figure><img src="'.$match[3].'" /></figure>';
    }, $allMatches);
    return $fbiagallery;
}

function ampforwp_gallery_shortcode_markup_modify( $output, $attr, $instance ){
	global $wp;
	$post = get_post(ampforwp_get_the_ID());
	if ( is_feed() && isset($wp->query_vars['feed']) && 'instant_articles' == $wp->query_vars['feed'] ) {
		
			$atts = shortcode_atts( array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $post ? $post->ID : 0,
				'itemtag'    => 'figure',
				'icontag'    => 'div',
				'captiontag' => 'figcaption',
				'columns'    => 3,
				'size'       => 'thumbnail',
				'include'    => '',
				'exclude'    => '',
				'link'       => ''
			), $attr, 'gallery' );

			if ( ! empty( $atts['include'] ) ) {
				$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
				$attachments = array();
				foreach ( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			} elseif ( ! empty( $atts['exclude'] ) ) {
				$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
			} else {
				$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
			}
			if ( empty( $attachments ) ) {
				return '';
			}

				// Build the gallery html output
				$output = "<figure class=\"op-slideshow\">";
				// Iterate over the available images
					$i = 0;
					foreach ( $attachments as $id => $attachment ) {
						$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "gallery-$id" ) : '';
						$image_output = wp_get_attachment_image( $id, "full", false, $attr );

						$image_meta  = wp_get_attachment_metadata( $id );
						$orientation = '';
						if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
							$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
						}
						$output .= "<figure>";
						$output .= $image_output;
						if ( trim($attachment->post_excerpt) ) {
							// $output .= "
							// 	<figcaption>
							// 	" . wptexturize($attachment->post_excerpt) . "
							// 	</figcaption>";
						}
						$output .= "</figure>";
					}
				$output .= "</figure>";
				return $output;
		}

		return $output;
}

function ampforwp_fbia_get_content_DOM($content){
		$libxml_previous_state = libxml_use_internal_errors( true );
		$DOMDocument = new DOMDocument( '1.0', get_option( 'blog_charset' ) );

		// DOMDocument isn’t handling encodings too well, so let’s help it a little
		if ( function_exists( 'mb_convert_encoding' ) ) {
			$content = mb_convert_encoding( $content, 'HTML-ENTITIES', get_option( 'blog_charset' ) );
		}

		$result = $DOMDocument->loadHTML( '<!doctype html><html><body>' . utf8_decode( $content ) . '</body></html>' );
		libxml_clear_errors();
		libxml_use_internal_errors( $libxml_previous_state );

		return $DOMDocument;
	}

function ampforwp_fbia_get_content_from_DOM($DOMDocument){
		$body = $DOMDocument->getElementsByTagName( 'body' )->item( 0 );
		$filtered_content = '';
		foreach ( $body->childNodes as $node ) {
			if ( method_exists( $DOMDocument, 'saveHTML' ) &&  version_compare(phpversion(), '5.3.6', '>=') ) {
				$filtered_content .= $DOMDocument->saveHTML( $node );// Requires PHP 5.3.6
			} else {
				$temp_content = $DOMDocument->saveXML( $node );
				$iframe_pattern = "#<iframe([^>]+)/>#is"; // self-closing iframe element
				$temp_content = preg_replace( $iframe_pattern, "<iframe$1></iframe>", $temp_content );
				$filtered_content .= $temp_content;
			}
		}
		//Instagram embeds are not loading on the Facebook instance Article #5066
		if (preg_match('/<blockquote class="instagram-media"/', $filtered_content)) {
	      $filtered_content = preg_replace( '/<blockquote class="instagram-media"(.*?)>(.*?)<\/blockquote><\/iframe><\/figure>(.*?)<script(.*?)src="(.*?)instagram(.*?)"><\/script>/s', '<blockquote class="instagram-media"$1>$2</blockquote><script$4src="$5instagram$6"></script></iframe></figure>$3', $filtered_content );
	    }
		return $filtered_content;
	}	

function ampforwp_fbia_list_items_with_content($DOMDocument){

		// A set of inline tags, that are allowed within the li element
		$allowed_tags = array(
			"p", "b", "u", "i", "em", "span", "strong", "#text", "a"
		);

		// Find all the list items
		$elements = $DOMDocument->getElementsByTagName( 'li' );

		// Iterate over all the list items
		for ( $i = 0; $i < $elements->length; ++$i ) {
			$element = $elements->item( $i );

			// If the list item has more than one child node, we might get a conflict, so wrap
			if($element->childNodes->length > 1){
				// Iterate over all child nodes
				for ( $n = 0; $n < $element->childNodes->length; ++$n ) {
					$childNode = $element->childNodes->item($n);

					// If this child node is not one of the allowed tags remove from the DOM tree
					if(!in_array($childNode->nodeName, $allowed_tags)){
						$element->removeChild($childNode);
					}
				}
			}
		}

		return $DOMDocument;
	}	

function ampforwp_fbia_validate_images($DOMDocument){

		// Find all the image items
		$elements = $DOMDocument->getElementsByTagName( 'img' );

		
		// Iterate over all the list items
		for ( $i = 0; $i < $elements->length; ++$i ) {
			$element = $elements->item( $i );

			if($element->parentNode->nodeName == "figure"){
				// This element is already wrapped in a figure tag, we only need to make sure it's placed right
				$element = $element->parentNode;
				if ( ampforwp_get_setting('fb-instant-feedback') ) {
					$element->setAttribute( 'data-feedback', 'fb:likes, fb:comments' );
				}
				if ( 'figure' == $element->parentNode->nodeName && 'op-slideshow' == $element->parentNode->getAttribute('class') ) {
					return $DOMDocument;
				}
			} else {
				// Wrap this image into a figure tag
				$figure = $DOMDocument->createElement('figure');
				$element->parentNode->replaceChild($figure, $element);
				$figure->appendChild($element);

				// Let's continue working with the figure tag
				$element = $figure;
			}
			if ( ampforwp_get_setting('fb-instant-feedback') ) {
 				$element->setAttribute( 'data-feedback', 'fb:likes, fb:comments' );
			}

			if($element->parentNode->nodeName != "body"){
				// Let's find the highest container if it does not reside in the body already
				$highestParent = $element->parentNode;
				while($highestParent->parentNode->nodeName != "body"){
					$highestParent = $highestParent->parentNode;
				}
				// Insert the figure tag before the highest parent which is not the body tag
				$highestParent->parentNode->insertBefore($element, $highestParent);

			}
		}

		return $DOMDocument;
	}	

function ampforwp_fbia_resize_images($DOMDocument){

		$default_image_size = apply_filters('fbia_default_image_size', 'full');

		// Find all the images
		$elements = $DOMDocument->getElementsByTagName( 'img' );

		// Iterate over all the list items
		for ( $i = 0; $i < $elements->length; ++$i ) {
			$image = $elements->item( $i );

			// Find the "wp-image" class, as it is a safe indicator for WP images and delivers the attachment ID
			if(preg_match("/.*wp-image-(\d*).*/", $image->getAttribute("class"), $matches)){
				if($matches[1]){
					$id = intval($matches[1]);
					// Find the attachment for the ID
					$desired_size = wp_get_attachment_image_src($id, $default_image_size);
					// If we have a valid attachment we change the attributes
					if($desired_size){
						$image->setAttribute("src", $desired_size[0]);
						$image->setAttribute("width", $desired_size[1]);
						$image->setAttribute("height", $desired_size[2]);
					}
				}
			}
		}
		return $DOMDocument;
	}	

function ampforwp_fbia_no_empty_p_tags($DOMDocument){
		$allowed_tags = array(
			"p", "b", "u", "i", "em", "span", "strong", "#text", "a"
		);

		// Find all the paragraph items
		$elements = $DOMDocument->getElementsByTagName( 'p' );

		// Iterate over all the paragraph items
		for ( $i = 0; $i < $elements->length; ++$i ) {
			$element = $elements->item( $i );

			if($element->childNodes->length == 0){
				// This element is empty like <p></p>
				$element->parentNode->removeChild($element);
			} elseif( $element->childNodes->length >= 1 ) {
				// This element actually has children, let's see if it has text

				$elementHasText = false;
				// Iterate over all child nodes
				for ( $n = 0; $n < $element->childNodes->length; ++$n ) {
					$childNode = $element->childNodes->item($n);

					if(in_array($childNode->nodeName, $allowed_tags)){

						// If the child node has text, check if it is empty text
						// isset($childNode->childNodes->length) || !isset($childNode->nodeValue) || trim($childNode->nodeValue,chr(0xC2).chr(0xA0)) == false

						if( (!isset($childNode->childNodes) || $childNode->childNodes->length == 0) && (isset($childNode->nodeValue) && !trim($childNode->nodeValue,chr(0xC2).chr(0xA0)))){
							// this node is empty
							$element->removeChild($childNode);
						} else {
							$elementHasText = true;
						}
					}
				}

				if(!$elementHasText){
					// The element has child nodes, but no text
					$fragment = $DOMDocument->createDocumentFragment();

					// move all child nodes into a fragment
					while($element->hasChildNodes()){
						$fragment->appendChild( $element->childNodes->item( 0 ) );
					}

					// replace the (now empty) p tag with the fragment
					$element->parentNode->replaceChild($fragment, $element);
				}
			}
		}

		return $DOMDocument;
	}
function ampforwp_fbia_wrap_elements( $DOMDocument ){

	$figure_object = $DOMDocument->createElement( 'figure' );
	$figure_object->setAttribute( 'class', 'op-interactive' );

		// The elements to wrap.
		$elements_to_wrap = array( 'iframe', 'table' );

		foreach ( $elements_to_wrap as $element_to_wrap ) {

			foreach ( $elements = $DOMDocument->getElementsByTagName( $element_to_wrap ) as $element ) {
				if ( 'figure' !== $element->parentNode->tagName ) {

					$figure_template = clone $figure_object;
					$element->parentNode->replaceChild( $figure_template, $element );
					$figure_template->appendChild( $element );

				}
			}
		}
	return $DOMDocument;
}
// Video Element
function ampforwp_fbia_video_element( $DOMDocument ){
	$video_elements = $DOMDocument->getElementsByTagName( 'video' );

	// Iterate over all the video items
	for ( $i = 0; $i < $video_elements->length; ++$i ) {
		$video = $video_elements->item( $i );

		if($video->parentNode->nodeName == "figure"){
			// This element is already wrapped in a figure tag, we only need to make sure it's placed right
			$video = $video->parentNode;
		} else {
			// Wrap this video into a figure tag
			$figure = $DOMDocument->createElement('figure');
			$video->parentNode->replaceChild($figure, $video);
			$figure->appendChild($video);
			$video = $figure;
		}
		if ( ampforwp_get_setting('fb-instant-feedback') ) {
			$video->setAttribute( 'data-feedback', 'fb:likes, fb:comments' );
		}
	}
	return $DOMDocument;
}
// Embeds Sanitizer
function ampforwp_fbia_wrap_embed_elements( $DOMDocument ) {
	$figure_object = $DOMDocument->createElement( 'figure' );
	$figure_object->setAttribute( 'class', 'op-interactive' );
	$iframe_object = $DOMDocument->createElement( 'iframe' );
	$body = $DOMDocument->getElementsByTagName( 'body' )->item( 0 );
    $xpath = new DOMXPath($DOMDocument);
    // Instagram
    $class_name = 'instagram-media';
    $blockquotes = $xpath->query("//*[contains(@class,'$class_name')]");
    foreach($blockquotes as $instagram_media){
  		if ( 'iframe' !== $instagram_media->parentNode->tagName ) {
			$iframe = clone $iframe_object;
			$instagram_media->parentNode->replaceChild( $iframe, $instagram_media );
			$iframe->appendChild( $instagram_media );
			if ( 'figure' !== $iframe->parentNode->tagName ) {
				$figure_template = clone $figure_object;
				$iframe->parentNode->replaceChild( $figure_template, $iframe );
				$figure_template->appendChild( $iframe );
			}
		}
    }
	return $DOMDocument;
}
function ampforwp_get_ia_placement_id(){
	global $redux_builder_amp;
	$instant_article_ad_id = $redux_builder_amp['fb-instant-article-ad-id'];
	return $instant_article_ad_id;
}

function ampforwp_get_ia_ad_density(){
	global $redux_builder_amp;
	$instant_article_ad_density = $redux_builder_amp['fb-instant-article-ad-density-setup'];
	return $instant_article_ad_density;
}

function ampforwp_get_ia_analytics_code(){
	global $redux_builder_amp;
	$instant_article_analytics_code = $redux_builder_amp['fb-instant-article-analytics-code'];
	return $instant_article_analytics_code;
}