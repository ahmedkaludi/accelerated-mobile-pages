<?php

require_once( AMP__DIR__ . '/includes/embeds/class-amp-base-embed-handler.php' );

class AMP_Gallery_Embed_Handler extends AMP_Base_Embed_Handler {
	private static $script_slug = 'amp-carousel';
	private static $script_src = 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js';

	public function register_embed() {
		add_shortcode( 'gallery', array( $this, 'shortcode' ) );
	}

	public function unregister_embed() {
		remove_shortcode( 'gallery' );
	}

	public function get_scripts() {
		if ( ! $this->did_convert_elements ) {
			return array();
		}

		return array( self::$script_slug => self::$script_src );
	}

	public function shortcode( $attr ) {
		$post = get_post();

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) ) {
				$attr['orderby'] = 'post__in';
			}
			$attr['include'] = $attr['ids'];
		}

		$atts = shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'include'    => '',
			'exclude'    => '',
			'size'       => array( $this->args['width'], $this->args['height'] ),
		), $attr, 'gallery' );

		$id = intval( $atts['id'] );

		if ( ! empty( $atts['include'] ) ) {
			$attachments = get_posts( array(
				'include' => $atts['include'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
				'fields' => 'ids',
			) );
		} elseif ( ! empty( $atts['exclude'] ) ) {
			$attachments = get_children( array(
				'post_parent' => $id,
				'exclude' => $atts['exclude'],
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
				'fields' => 'ids',
			) );
		} else {
			$attachments = get_children( array(
				'post_parent' => $id,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => $atts['order'],
				'orderby' => $atts['orderby'],
				'fields' => 'ids',
			) );
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		$urls = array();
		foreach ( $attachments as $attachment_id ) {
			list( $url, $width, $height ) = wp_get_attachment_image_src( $attachment_id, $atts['size'], true );

			if ( ! $url ) {
				continue;
			}

			$urls[] = apply_filters('amp_gallery_image_params', array(
				'url' => $url,
				'width' => $width,
				'height' => $height,
			),$attachment_id);
		}
		return $this->render( array(
			'images' => $urls,
		) );
	}

	public function render( $args ) {
		global $redux_builder_amp,$carousel_markup_all;
		$this->did_convert_elements = true;
		
		$args = wp_parse_args( $args, array(
			'images' => false,
		) );
		
		if ( empty( $args['images'] ) ) {
			return '';
		}

		/*Filter*/
		$carousel_markup = '';
		
		$carousel_markup_all = array(
			'1'=>array(
						'image-with-caption-html'=>'<figure><div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div><figcaption :openbrack:class:closebrack:="expanded? \'expanded\' : \'\'" on="tap:AMP.setState({expanded: !expanded})" tabindex="0" role="button" >{{main_images_caption}}<span :openbrack:text:closebrack:="expanded ? \'less\' : \'more\'">more</span> </figcaption></figure>',
						'image-without-caption-html' =>'<div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div>',
						'gallery_css' => '.collapsible-captions {--caption-height: 32px; --image-height: 100%; --caption-padding:1rem; --button-size: 28px; --caption-color: #f5f5f5;; --caption-bg-color: #111;}
								    .collapsible-captions * {
								      -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
								      box-sizing: border-box;
								    }
								    .collapsible-captions .amp-carousel-container  {position: relative; width: 100%;}
								    .collapsible-captions amp-img img {object-fit: contain; }
								    .collapsible-captions figure { margin: 0; padding: 0; }
								    .collapsible-captions figcaption { position: absolute; bottom: 0;width: 100%;
								      max-height: var(--caption-height);margin-bottom:0;
								      line-height: var(--caption-height);
								      padding: 0 var(--button-size) 0 5px;
								      white-space: nowrap;
								      overflow: hidden;
								      text-overflow: ellipsis;
								      transition: max-height 200ms cubic-bezier(0.4, 0, 0.2, 1);
								      z-index: 1000;
								      color: var(--caption-color);
								      background: rgba(0, 0, 0, 0.6);   
								    }
								    .collapsible-captions figcaption.expanded {
								      line-height: inherit;
								      white-space: normal;
								      text-overflow: auto;
								      max-height: 100px;
								      overflow: auto;
								    }
								    .collapsible-captions figcaption:focus { outline: none; border: none; }
								    .collapsible-captions figcaption span { display: block; position: absolute;
								      top: calc((var(--caption-height) - var(--button-size)) / 2);
								      right: 2px; width: var(--button-size); height: var(--button-size);
								      line-height: var(--button-size); text-align: center; font-size: 12px; color: inherit;
								      cursor: pointer; }
									figcaption{ margin-bottom: 20px; }'
									),
			'2' => array(
						'image-with-caption-html'=>'<figure><div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div><figcaption :openbrack:class:closebrack:="expanded? \'expanded\' : \'\'" on="tap:AMP.setState({expanded: !expanded})" tabindex="0" role="button" >{{main_images_caption}}<span :openbrack:text:closebrack:="expanded ? \'less\' : \'more\'">more</span> </figcaption></figure>',
						'image-without-caption-html' =>'<div class="ampforwp-gallery-item amp-carousel-container">{{main_images}} </div>',
						'carousel_with_thumbnail_html'=>'<button on="tap:carousel-with-carousel-preview-{{unique_id}}.goToSlide(index={{unique_index}})" class="amp-carousel-slide amp-scrollable-carousel-slide">{{thumbnail}}</button>',
						'gallery_css' => '.collapsible-captions {--caption-height: 32px; --image-height: 100%; --caption-padding:1rem; --button-size: 28px; --caption-color: #f5f5f5;; --caption-bg-color: #111;}
					    .collapsible-captions * {
					      -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
					      box-sizing: border-box;
					    }
						    .collapsible-captions .amp-carousel-container  {position: relative; width: 100%;}
						    .collapsible-captions amp-img img {object-fit: contain; }
						    .collapsible-captions figure { margin: 0; padding: 0; }
						    .collapsible-captions figcaption { position: absolute; bottom: 0;width: 100%;
						      max-height: var(--caption-height);margin-bottom:0;
						      line-height: var(--caption-height);
						      padding: 0 var(--button-size) 0 5px;
						      white-space: nowrap;
						      overflow: hidden;
						      text-overflow: ellipsis;
						      transition: max-height 200ms cubic-bezier(0.4, 0, 0.2, 1);
						      z-index: 1000;
						      color: var(--caption-color);
						      background: rgba(0, 0, 0, 0.6);   
						    }
						    .collapsible-captions figcaption.expanded {
						      line-height: inherit;
						      white-space: normal;
						      text-overflow: auto;
						      max-height: 100px;
						      overflow: auto;
						    }
						    .collapsible-captions figcaption:focus { outline: none; border: none; }
						    .collapsible-captions figcaption span { display: block; position: absolute;
						      top: calc((var(--caption-height) - var(--button-size)) / 2);
						      right: 2px; width: var(--button-size); height: var(--button-size);
						      line-height: var(--button-size); text-align: center; font-size: 12px; color: inherit;
						      cursor: pointer; }
							figcaption{ margin-bottom: 20px; }
							.carousel-preview amp-img{height:40px;width:60px;position:relative;}'
									),

		);
		$carousel_markup_all = apply_filters("ampforwp_manage_gallery_markup", $carousel_markup_all);
		$carousel_markup =  $carousel_markup_all[1];
		if( isset($redux_builder_amp['ampforwp-gallery-design-type']) &&  isset($carousel_markup_all[$redux_builder_amp['ampforwp-gallery-design-type'] ] ) ){
			$carousel_markup =  $carousel_markup_all[$redux_builder_amp['ampforwp-gallery-design-type']];
		}
		/*Filter*/
		$amp_images = array();
		foreach ( $args['images'] as $key => $image ) {
			$amp_images[$key] = AMP_HTML_Utils::build_tag(
				'amp-img',
				array(
					'src' => $image['url'],
					'width' => $image['width'],
					'height' => $image['height'],
					'layout' => 'fill',
					'class'  => 'amp-carousel-img',
				)
			);
		$images[$key] = apply_filters('amp_gallery_images', $amp_images[$key], $image, $carousel_markup);
		}
		
		$r = rand(1,100);
			$amp_carousel = AMP_HTML_Utils::build_tag(
							'amp-carousel',
							array(
								'width' => $this->args['width'],
								'height' => $this->args['height'],
								'type' => 'slides',
								'layout' => 'responsive',
								'class'  => 'collapsible-captions',
								'id' => 'carousel-with-carousel-preview-'.$r
							),
							implode( PHP_EOL, $images ));

			$amp_carousel_with_thumbnail_nav = apply_filters('amp_thumbnail_images', $amp_images, $r, $carousel_markup);
			
			$amp_carousel = AMP_HTML_Utils::build_tag(
							'amp-carousel',
							array(
								'width' => $this->args['width'],
								'height' => $this->args['height'],
								'type' => 'slides',
								'layout' => 'responsive',
								'class'  => 'collapsible-captions',
								'id' => 'carousel-with-carousel-preview-'.$r
							),
							implode( PHP_EOL, $images ));
			
		if(!empty($amp_carousel_with_thumbnail_nav)){
			$amp_carousel .= AMP_HTML_Utils::build_tag(
							'amp-carousel',
							array(
								'width' => 'auto',
								'height' => 48,
								'type' => 'carousel',
								'layout' => 'fixed-height',
								'class'  => 'carousel-preview'
							),
							implode( PHP_EOL, $amp_carousel_with_thumbnail_nav ));
		
		}
		$amp_carousel = apply_filters('amp_gallery_markup', $amp_carousel);
		return $amp_carousel;
	}
}
