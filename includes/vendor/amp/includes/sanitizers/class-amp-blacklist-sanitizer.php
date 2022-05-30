<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( AMP__VENDOR__DIR__ . '/includes/sanitizers/class-amp-base-sanitizer.php' );

/**
 * Strips blacklisted tags and attributes from content.
 *
 * See following for blacklist:
 *     https://github.com/ampproject/amphtml/blob/master/spec/amp-html-format.md#html-tags
 */
class AMP_Blacklist_Sanitizer extends AMP_Base_Sanitizer {
	const PATTERN_REL_WP_ATTACHMENT = '#wp-att-([\d]+)#';

	protected $DEFAULT_ARGS = array(
		'add_blacklisted_protocols' => array(),
		'add_blacklisted_tags' => array(),
		'add_blacklisted_attributes' => array(),
	);

	public function sanitize() {
		$blacklisted_tags = $this->get_blacklisted_tags();
		// Blacklisted tags for non-content #2835
		if ( isset($this->args['non-content']) && 'non-content' === $this->args['non-content'] ) {
			$blacklisted_tags = ampforwp_sidebar_blacklist_tags($blacklisted_tags);
		}
		$blacklisted_attributes = $this->get_blacklisted_attributes();
		$blacklisted_protocols = $this->get_blacklisted_protocols();

		$body = $this->get_body_node();
		$this->strip_tags( $body, $blacklisted_tags );
		$this->strip_attributes_recursive( $body, $blacklisted_attributes, $blacklisted_protocols );
	}

	private function strip_attributes_recursive( $node, $bad_attributes, $bad_protocols ) {
		if ( XML_ELEMENT_NODE !== $node->nodeType ) {
			return;
		}

		$node_name = $node->nodeName;

		if($node->nodeName=='a' && $node->hasAttribute('href')){
			$href = $node->getAttribute('href');
			if( strpos($href,'tel:') ){
				$disallowed = array('http://', 'https://');
				foreach($disallowed as $d){
			      if(strpos($href, $d) === 0) {
			         $href = str_replace($d, '', $href);
			      }
			   }
			   $node->setAttribute('href',$href);
			}
			if( function_exists('googlesitekit_activate_plugin') ){	
                if(strpos($href,'#') !== 0){
			    $node->setAttribute('href', \ampforwp_findInternalUrl($href));
			    }
		    }else{
			  $node->setAttribute('href', \ampforwp_findInternalUrl($href));
		    }   

		}
		
		// Some nodes may contain valid content but are themselves invalid.
		// Remove the node but preserve the children.
 		if ( 'font' === $node_name ) {
			$this->replace_node_with_children( $node, $bad_attributes, $bad_protocols );
			return;
		} elseif ( 'a' === $node_name && false === $this->validate_a_node( $node ) ) {
			$this->replace_node_with_children( $node, $bad_attributes, $bad_protocols );
			return;
		}

		if ( $node->hasAttributes() ) {
			$length = $node->attributes->length;
			for ( $i = $length - 1; $i >= 0; $i-- ) {
				$attribute = $node->attributes->item( $i );
				$attribute_name = '';
				if (isset($attribute->name)) {
					$attribute_name = strtolower( $attribute->name );
				}
				if ( in_array( $attribute_name, $bad_attributes, true ) ) {
					$node->removeAttribute( $attribute_name );
					continue;
				}

				// on* attributes (like onclick) are a special case
				if ( 0 === stripos( $attribute_name, 'on' ) && 'on' !== $attribute_name ) {
					$node->removeAttribute( $attribute_name );
					continue;
				} elseif ( 'a' === $node_name ) {
					$this->sanitize_a_attribute( $node, $attribute );
				}
			}
		}

		$length = $node->childNodes->length;
		for ( $i = $length - 1; $i >= 0; $i-- ) {
			$child_node = $node->childNodes->item( $i );

			$this->strip_attributes_recursive( $child_node, $bad_attributes, $bad_protocols );
		}
	}

	private function strip_tags( $node, $tag_names ) {
		$attr = '';
		foreach ( $tag_names as $tag_name ) {
			$elements = $node->getElementsByTagName( $tag_name );
			$length = $elements->length;
			if ( 0 === $length ) {
				continue;
			}

			for ( $i = $length - 1; $i >= 0; $i-- ) {
				$element = $elements->item( $i );
				if( is_null( $element ) ) continue; //Null check added.
				// Allow script with application/ld+json #1958
				if ( $element->hasAttributes() ) {
					$attr = $element->getAttribute('type');
					if ( '' !== $attr && 'application/ld+json' === $attr ) {
						$element->nodeValue = htmlspecialchars($element->textContent);
						continue;
					}
				}
				$parent_node = $element->parentNode;
				$spec_name = 'amp-script extension local script';
				$checkAllowedFlag = 0 ;
				foreach ( AMP_Allowed_Tags_Generated::get_allowed_tag( 'script' ) as $spec_rule ) {
					if ( isset( $spec_rule[ AMP_Rule_Spec::TAG_SPEC ]['spec_name'] ) && $spec_name === $spec_rule[ AMP_Rule_Spec::TAG_SPEC ]['spec_name'] ) {
						if($element->getAttribute( 'id' ) && $element->getAttribute( 'target' ) == 'amp-script')
							$checkAllowedFlag = 1 ;
					}
				}

				//white listing form element #4010
				$form_classes = '';
				$form_method = '';
				if($element->tagName=='form'){
					$form_classes 	= $element->getAttribute('class');
					$form_method 	= $element->getAttribute('method');
				}else if($parent_node->tagName=='form'){
					$form_classes	= $parent_node->getAttribute('class');
					$form_method 	= $parent_node->getAttribute('method');
				}
				$allow_form = 0;
				$allow_form = apply_filters('ampforwp_whitelist_form_element',$allow_form,$element);
				if((strpos($form_classes, 'ampforwp-form-allow') !== false || $allow_form==1) && strtolower($form_method)=='post'){
					$checkAllowedFlag = 1;
				}
				
				if($form_method!=''){
					if(strtolower($form_method)=='get'){
						$checkAllowedFlag = 1;
					}
				}
				//white listing form element close #4010


				if( $parent_node->tagName != 'amp-state' && $checkAllowedFlag == 0){
 					$parent_node->removeChild( $element );
				}
 				if ( 'body' !== $parent_node->nodeName && AMP_DOM_Utils::is_node_empty( $parent_node ) ) {
					$parent_node->parentNode->removeChild( $parent_node );
				}
			}
		}
	}

	private function sanitize_a_attribute( $node, $attribute ) {
		$attribute_name = '';
		if (isset($attribute->name)) {
			$attribute_name = strtolower( $attribute->name );
		}
		if ( 'rel' === $attribute_name ) {
			$old_value = $attribute->value;
			$new_value = trim( preg_replace( self::PATTERN_REL_WP_ATTACHMENT, '', $old_value ) );
			if ( empty( $new_value ) ) {
				$node->removeAttribute( $attribute_name );
			} elseif ( $old_value !== $new_value ) {
				$node->setAttribute( $attribute_name, $new_value );
			}
		} elseif ( 'rev' === $attribute_name ) {
			// rev removed from HTML5 spec, which was used by Jetpack Markdown.
			$node->removeAttribute( $attribute_name );
		} elseif ( 'target' === $attribute_name ) {
			// _blank is the only allowed value and it must be lowercase.
			// replace _new with _blank and others should simply be removed.
			$old_value = strtolower( $attribute->value );
			if ( '_blank' === $old_value || '_new' === $old_value ) {
				// _new is not allowed; swap with _blank
				$node->setAttribute( $attribute_name, '_blank' );
			} else {
				// only _blank is allowed
				$node->removeAttribute( $attribute_name );
			}
		}
	}

	private function validate_a_node( $node ) {
		// Get the href attribute
		$href = $node->getAttribute( 'href' );

		// If no href is set and this isn't an anchor, it's invalid
		if ( empty( $href ) ) {
			$name_attr = $node->getAttribute( 'name' );
			$id_attr = $node->getAttribute( 'id' );
			$class = $node->getAttribute( 'class' );
			$on = $node->getAttribute( 'on' );
			if ( ! empty( $name_attr ) || ! empty( $id_attr ) || ! empty( $class ) || ! empty( $on ) ) {
				// No further validation is required
				return true;
			} else {
				return false;
			}
		}

		// If this is an anchor link, just return true
		if ( 0 === strpos( $href, '#' ) ) {
			return true;
		}

		// If the href starts with a '/', append the home_url to it for validation purposes.
		if ( 0 === stripos( $href, '/' ) ) {
			$href = untrailingslashit( get_home_url() ) . $href;
		}

		$valid_protocols = array( 'http', 'https', 'mailto', 'sms', 'tel', 'viber', 'whatsapp' , 'ftp','skype', 'tg' , 'Tel');
		$special_protocols = array( 'tel', 'sms','skype' ); // these ones don't valid with `filter_var+FILTER_VALIDATE_URL`
		$protocol = strtok( $href, ':' );

		/* Convert space into %20 and esc url so it can work with the correct 
		urls that have spaces */
		if ( strpos($href, ' ') ){
			$href = esc_url($href);
		}
		/*	Issue was with multibyte string.
		 *  For more info check: https://github.com/ahmedkaludi/accelerated-mobile-pages/issues/2556 and https://github.com/ahmedkaludi/accelerated-mobile-pages/issues/2967
		*/
		if( false === $this->contains_any_multibyte($href) ){
			if ( false === parse_url( $href,PHP_URL_HOST )
				&& ! in_array( $protocol, $special_protocols, true ) ) {
				return false;
			}
		}

		if ( ! in_array( $protocol, $valid_protocols, true ) ) {
			return false;
		}

		return true;
	}

	private function replace_node_with_children( $node, $bad_attributes, $bad_protocols ) {
		// If the node has children and also has a parent node,
		// clone and re-add all the children just before current node.
		if ( $node->hasChildNodes() && $node->parentNode ) {
			foreach ( $node->childNodes as $child_node ) {
				$new_child = $child_node->cloneNode( true );
				$this->strip_attributes_recursive( $new_child, $bad_attributes, $bad_protocols );
				$node->parentNode->insertBefore( $new_child, $node );
			}
		}

		// Remove the node from the parent, if defined.
		if ( $node->parentNode ) {
			$node->parentNode->removeChild( $node );
		}
	}

	private function merge_defaults_with_args( $key, $values ) {
		// Merge default values with user specified args
		if ( ! empty( $this->args[ $key ] )
			&& is_array( $this->args[ $key ] ) ) {
			$values = array_merge( $values, $this->args[ $key ] );
		}

		return $values;
	}

	private function get_blacklisted_protocols() {
		return $this->merge_defaults_with_args( 'add_blacklisted_protocols', array(
			'javascript',
		) );
	}
	private	function contains_any_multibyte($string){
    	if(function_exists('mb_check_encoding')){
    		return !\mb_check_encoding($string, 'ASCII') && \mb_check_encoding($string, 'UTF-8');
    	}
    	else{
    		return false;
    	}
	}
	private function get_blacklisted_tags() {
		return $this->merge_defaults_with_args( 'add_blacklisted_tags', apply_filters('amp_blacklisted_tags' , array(
			'script',
			'noscript',
			'style',
			'frame',
			'frameset',
			'object',
			'param',
			'applet',
			'form',
			'textarea',
			'select',
			'option',
			'link',
			'canvas',

			// Sanitizers run after embed handlers, so if anything wasn't matched, it needs to be removed.
			'embed',
			'embedvideo',

			// Other weird ones
			'comments-count',

			// These are converted into amp-* versions
			//'img',
			//'video',
			//'audio',
			//'iframe',
		) ) );
	}

	private function get_blacklisted_attributes() {
		return $this->merge_defaults_with_args( 'add_blacklisted_attributes', array(
			'style',
			'size',
			'clear',
			'align',
			'valign',
		) );
	}
}
