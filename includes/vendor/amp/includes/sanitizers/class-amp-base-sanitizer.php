<?php
namespace AMPforWP\AMPVendor;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
abstract class AMP_Base_Sanitizer {
	const FALLBACK_HEIGHT = 400;

	protected $DEFAULT_ARGS = array();

	protected $dom;
	protected $args;
	protected $did_convert_elements = false;
	const AMP_IMAGE_LIGHTBOX_ID = 'amp-image-lightbox';
	/**
	 * The root element used for sanitization. Either html or body.
	 *
	 * @var DOMElement
	 */
	protected $root_element;

	public function __construct( $dom, $args = array() ) {
		$this->dom = $dom;
		$this->args = array_merge( $this->DEFAULT_ARGS, $args );
		if ( ! empty( $this->args['use_document_element'] ) ) {
			$this->root_element = $this->dom->documentElement;
		} else {
			$this->root_element = $this->dom->getElementsByTagName( 'body' )->item( 0 );
		}
	}

	abstract public function sanitize();

	public function get_scripts() {
		return array();
	}

	public function get_styles() {
		return array();
	}

	protected function get_body_node() {
		return $this->dom->getElementsByTagName( 'body' )->item( 0 );
	}

	public function sanitize_dimension( $value, $dimension ) {
		if ( empty( $value ) ) {
			return $value;
		}

		// Accepts both integers and floats & prevents negative values #5005
		if ( is_numeric( $value ) ) {
			return max( 0, (float) $value );
		}

		if ( AMP_String_Utils::endswith( $value, 'px' ) ) {
			return absint( $value );
		}

		if ( AMP_String_Utils::endswith( $value, '%' ) ) {
			if ( 'width' === $dimension && isset( $this->args['content_max_width'] ) ) {
				$percentage = absint( $value ) / 100;
				return round( $percentage * $this->args['content_max_width'] );
			}
		}

		return '';
	}

	public function enforce_fixed_height( $attributes ) {
		if ( empty( $attributes['height'] ) ) {
			unset( $attributes['width'] );
			$attributes['height'] = self::FALLBACK_HEIGHT;
		}

		if ( empty( $attributes['width'] ) ) {
			$attributes['layout'] = 'fixed-height';
		}

		return $attributes;
	}

	/**
	 * This is our workaround to enforce max sizing with layout=responsive.
	 *
	 * We want elements to not grow beyond their width and shrink to fill the screen on viewports smaller than their width.
	 *
	 * See https://github.com/ampproject/amphtml/issues/1280#issuecomment-171533526
	 * See https://github.com/Automattic/amp-wp/issues/101
	 */
	public function enforce_sizes_attribute( $attributes ) {
		if ( ! isset( $attributes['width'], $attributes['height'] ) ) {
			return $attributes;
		}

		$max_width = $attributes['width'];
		if ( isset( $this->args['content_max_width'] ) && $max_width >= $this->args['content_max_width'] ) {
			$max_width = $this->args['content_max_width'];
		}

		$attributes['sizes'] = sprintf( '(min-width: %1$dpx) %1$dpx, 100vw', absint( $max_width ) );

		$this->add_or_append_attribute( $attributes, 'class', 'amp-wp-enforced-sizes' );

		return $attributes;
	}

	public function add_or_append_attribute( &$attributes, $key, $value, $separator = ' ' ) {
		if ( isset( $attributes[ $key ] ) ) {
			$attributes[ $key ] .= $separator . $value;
		} else {
			$attributes[ $key ] = $value;
		}
	}

	/**
	 * Decide if we should remove a src attribute if https is required.
	 * If not required, the implementing class may want to try and force https instead.
	 *
	 * @param string $src
	 * @param boolean $force_https
	 * @return string
	 */
	public function maybe_enforce_https_src( $src, $force_https = false ) {
		$protocol = strtok( $src, ':' );
		if ( 'https' !== $protocol ) {
			// Check if https is required
			if ( isset( $this->args['require_https_src'] ) && true === $this->args['require_https_src'] ) {
				// Remove the src. Let the implementing class decide what do from here.
				$src = '';
			} elseif ( ( ! isset( $this->args['require_https_src'] ) || false === $this->args['require_https_src'] )
				&& true === $force_https ) {
				// Don't remove the src, but force https instead
				$src = set_url_scheme( $src, 'https' );
			}
		}

		return $src;
	}


	/**
	 * Removes an invalid child of a node.
	 *
	 * Also, calls the mutation callback for it.
	 * This tracks all the nodes that were removed.
	 *
	 * @since 0.7
	 *
	 * @param DOMNode|DOMElement $node The node to remove.
	 * @param array              $args Additional args to pass to validation error callback.
	 *
	 * @return void
	 */
	public function remove_invalid_child( $node, $args = array() ) {
		if ( isset( $this->args['validation_error_callback'] ) ) {
			call_user_func( $this->args['validation_error_callback'],
				array_merge( compact( 'node' ), $args )
			);
		}
		if ( empty( $this->args['disable_invalid_removal'] ) ) {
			$node->parentNode->removeChild( $node );
		}
	}

	/**
	 * Removes an invalid attribute of a node.
	 *
	 * Also, calls the mutation callback for it.
	 * This tracks all the attributes that were removed.
	 *
	 * @since 0.7
	 *
	 * @param DOMElement     $element   The node for which to remove the attribute.
	 * @param DOMAttr|string $attribute The attribute to remove from the element.
	 * @param array          $args      Additional args to pass to validation error callback.
	 * @return void
	 */
	public function remove_invalid_attribute( $element, $attribute, $args = array() ) {
		if ( isset( $this->args['validation_error_callback'] ) ) {
			if ( is_string( $attribute ) ) {
				$attribute = $element->getAttributeNode( $attribute );
			}
			if ( $attribute ) {
				call_user_func( $this->args['validation_error_callback'],
					array_merge(
						array(
							'node' => $attribute,
						),
						$args
					)
				);
				if ( empty( $this->args['disable_invalid_removal'] ) ) {
					$element->removeAttributeNode( $attribute );
				}
			}
		} elseif ( empty( $this->args['disable_invalid_removal'] ) ) {
			if ( is_string( $attribute ) ) {
				$element->removeAttribute( $attribute );
			} else {
				$element->removeAttributeNode( $attribute );
			}
		}
	}
	/**
	 * Add <amp-image-lightbox> element to body tag if it doesn't exist yet.
	 */
	public function maybe_add_amp_image_lightbox_node() {
 		$nodes = $this->dom->getElementById( self::AMP_IMAGE_LIGHTBOX_ID );
		if ( null !== $nodes ) {
			return;
		}
 		$nodes = $this->dom->getElementsByTagName( 'body' );
		if ( ! $nodes->length ) {
			return;
		}
		$body_node          = $nodes->item( 0 );
		$amp_image_lightbox = AMP_DOM_Utils::create_node( $this->dom, 'amp-image-lightbox', array(
			'id'                           => self::AMP_IMAGE_LIGHTBOX_ID,
			'layout'                       => 'nodisplay',
			'data-close-button-aria-label' => esc_html__( 'Close', 'amp' ),
		) );
		$body_node->appendChild( $amp_image_lightbox );
	}
}