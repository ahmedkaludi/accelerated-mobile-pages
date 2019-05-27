<?php
Class AMPforWP_theme_mode{
	public function __construct(){

	}	

	public function init(){
		if(!is_admin()){
			//redirect.php
			remove_action( 'template_redirect', 'ampforwp_check_amp_page_status', 10 );
			remove_action( 'template_redirect', 'ampforwp_page_template_redirect', 10 );
			remove_action( 'template_redirect', 'ampforwp_page_template_redirect_archive', 10 );
			remove_filter( 'query_vars', 'ampforwp_custom_query_var' );
			remove_action( 'template_redirect', 'ampforwp_redirect_to_orginal_url' );
			remove_action('template_redirect', 'ampforwp_redirect_proper_qendpoint' );

			//Main files
			remove_action( 'init', 'ampforwp_add_custom_post_support',11);
			remove_action( 'init', 'ampforwp_add_custom_rewrite_rules', 25 );
			remove_action( 'init', 'ampforwp_custom_rewrite_rules_for_product_category' );


			add_action(	'init', array($this, 'rm_wp_core'), 20 );
			add_filter("ampforwp_is_amp_endpoint",  array($this, 'ampforwp_theme_mode_enable'));
			add_action(	'init', array($this, 'dynamic_sidebar_callback_bkp') );
			add_filter(	'amp_post_template_dir', array($this, 'template_mode_new_dir') );
			add_filter( 'amp_post_template_file', array($this, 'custom_template_file_name'), 11, 3 );
			add_filter(	"post_thumbnail_html", array($this, 'featured_image_html'), 11, 5 );
			add_filter(	"the_content", array($this, 'amp_the_content') );
			add_action(	"levelup_head", array($this, 'amp_head_content') );
			add_action(	"levelup_css", array($this, 'amp_head_css')	);
			add_filter(	"get_search_form", array($this, 'search_form')	);
			add_action(	"levelup_footer", array($this, 'amp_footer_content')	);
		    add_action(	"get_avatar", array($this,'get_avatar'), 11,6);	    
		    add_filter( "the_author_description", array($this, 'author_meta_desctiption_amp'),10, 2 );

		    add_filter("ampforwp_the_content_last_filter",  array($this, "comment_form_conversion") );
		    add_filter("amp_post_template_data", array($this, 'amp_comment_mustache_script') );
		    
		}else{
			require_once AMPFORWP_PLUGIN_DIR.'/template-mode/admin-settings.php';
			add_filter( 'plugin_action_links_accelerated-mobile-pages/accelerated-moblie-pages.php', array($this, 'ampforwp_plugin_settings_link'), 10, 4 );
		}

		add_action( 'wp_ajax_amp_theme_ajaxcomments',  array($this, 'amp_theme_ajaxcomments') ); 
		add_action( 'wp_ajax_nopriv_amp_theme_ajaxcomments',  array($this, 'amp_theme_ajaxcomments') ); 
	}
	function ampforwp_theme_mode_enable($opt){
		return true;
	}
 	
	function ampforwp_plugin_settings_link( $actions, $plugin_file, $plugin_data, $context ) {
				$amp_activate = '';
				$amp_activate = array(' | <span style="color:black;">Status: Template Mode</span style=>');
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			$actions = array_merge( $actions, $amp_activate );
		return $actions;
	}



	function amp_comment_mustache_script($data){
		if ( comments_open()){
			if ( empty( $data['amp_component_scripts']['amp-mustache'] ) ) {
				$data['amp_component_scripts']['amp-mustache'] = 'https://cdn.ampproject.org/v0/amp-mustache-latest.js';
			}
			$data['amp_component_scripts']['amp-form'] = 'https://cdn.ampproject.org/v0/amp-form-latest.js';
		}
		return $data;
	}
	function amp_theme_ajaxcomments(){
		global $redux_builder_amp;
		  header("access-control-allow-credentials:true");
		  header("access-control-allow-headers:Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token");
		  header("Access-Control-Allow-Origin:".$_SERVER['HTTP_ORIGIN']);
		  $siteUrl = parse_url(  get_site_url() );
		  header("AMP-Access-Control-Allow-Source-Origin:".$siteUrl['scheme'] . '://' . $siteUrl['host']);
		  header("access-control-expose-headers:AMP-Access-Control-Allow-Source-Origin");
		  header("Content-Type:application/json;charset=utf-8");
		  $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
		  $text_data = 'Comment Successfully submitted';
		  if ($redux_builder_amp['amp-comments-Successful-message']){
		    $text_data = esc_html__( $redux_builder_amp['amp-comments-Successful-message'], 'accelerated-mobile-pages');
		    
		  }
		        
		  if ( is_wp_error( $comment ) ) {
		    $error_data = intval( $comment->get_error_data() );
		    if ( ! empty( $error_data ) ) {
		      $comment_html = $comment->get_error_message();
		      $comment_html = str_replace("&#8217;","'",$comment_html);
		      $comment_status = array('response' => $comment_html );
		      echo json_encode($comment_status);
		      die;
		    } else {
		      wp_die( 'Unknown error' );
		    }
		  }
		 
		  $user = wp_get_current_user();
		  do_action('set_comment_cookies', $comment, $user);
		 
		  $comment_depth = 1;
		  $comment_parent = $comment->comment_parent;
		  while( $comment_parent ){
		    $comment_depth++;
		    $parent_comment = get_comment( $comment_parent );
		    $comment_parent = $parent_comment->comment_parent;
		  }
		 
		  $GLOBALS['comment'] = $comment;
		  $GLOBALS['comment_depth'] = $comment_depth;
		  $comment_html = $text_data;
		  $comment_status = array('response' => $comment_html );
		  echo json_encode($comment_status);
		  //echo $comment_html;
		  die;
	}

	function comment_form_conversion($content){
		$submit_url =  admin_url('admin-ajax.php?action=amp_theme_ajaxcomments');
		$submit_url = str_replace("http:", "", $submit_url);
		$mustache = '<div submit-success>
						<template type="amp-mustache">
							{{response}}
						</template>
					</div>					 
					<div submit-error>
						<template type="amp-mustache">
					  	{{response}}
						</template>
					</div>';
		$content = preg_replace("/<form(.*?)action=[\"|'](.*?)[\"|'](.*?)id=[\"|']commentform[\"|'](.*?)>/si", '<form$1action-xhr="'.$submit_url.'"$3id="commentform" $4 on="submit-success:commentform.reset()">'.$mustache, $content);
		return $content;
	}

	/**
	* Remove Unwanted hooks from template
	**/
	public function rm_wp_core(){
		    remove_all_actions( 'wp_head' );
		    remove_all_actions( 'wp_print_styles' );
		    remove_all_actions( 'wp_print_head_scripts' );
		    remove_all_actions( 'wp_footer' );
		    remove_all_actions( 'wp_enqueue_scripts' );
		    remove_all_actions( 'after_wp_tiny_mce' );
		    remove_all_actions( 'comment_form' );
		    remove_action( 'amp_post_template_head','ampforwp_add_meta_viewport', 9);
		    remove_filter( 'amp_post_template_file', 'ampforwp_custom_template', 10, 3 );
		    remove_filter('amp_post_template_dir','ampforwp_new_dir');
		    remove_filter( 'amp_post_template_file', 'ampforwp_empty_filter', 10, 3 );
	}
	/**
	* Replacing callback of widgets for conversion
	**/
	public function dynamic_sidebar_callback_bkp(){
		global $wp_registered_widgets, $ampforwp_wp_registered_widgets;
		if(count($wp_registered_widgets)){
			foreach ($wp_registered_widgets as $key => $value) {
				$wp_registered_widgets[$key]['amp_callback'] = $value['callback'];
				$wp_registered_widgets[$key]['amp_params'] = $value['params'];
				$wp_registered_widgets[$key]['params'] = array(array('public function_name'=> $value['id'] ));
				$wp_registered_widgets[$key]['callback'] = array($this, 'ampforwp_template_mode_reg_callback_widgets');
			}
		}
	}

	/**
	* Change Templates directory for AMP theme
	**/
	public function template_mode_new_dir( $dir ) {
			global $redux_builder_amp;
			 $dir = get_template_directory()."/";
			return $dir;
	}

	/**
	* Calling name of template from theme directory
	**/
	// Custom Template Files
	public function custom_template_file_name( $file, $type, $post ) {
	 global $redux_builder_amp;

		// 404 Template
	 	if( 'single' === $type && is_404() ) {
			$file = get_template_directory() . '/404.php';
	 	}
	 	// single Template
		if ( is_page() ) { 
			if( 'single' === $type && ! ('product' === $post->post_type) ) {
				$file = get_template_directory() . '/page.php';
		 	}
		}
	    // Loop Template
	    if ( 'loop' === $type ) {
			$file = get_template_directory() . '/loop.php';
		}
	    // Archive
		if ( is_archive() ) {
	        if ( 'single' === $type ) {
	            $file = get_template_directory() . '/archive.php';
	        }
	    }
	    $ampforwp_custom_post_page = ampforwp_custom_post_page();
	    // Homepage
		if ( is_home() ) {
			if ( 'single' === $type ) {
	        	$file = get_template_directory() . '/index.php';
	        
		        if ( $redux_builder_amp['amp-frontpage-select-option'] == 1 ) {
					$file = get_template_directory() . '/page.php';
		        }
		        if ( ampforwp_is_blog() ) {
				 	$file = get_template_directory() . '/index.php';
				}
		    }
	    }
	    // is_search
		if ( is_search() ) {
	        if ( 'single' === $type ) {
	            $file = get_template_directory() . '/search.php';
	        }
	    }

	    //For template pages
	    switch ( true ) {
	    	case (is_tax()):
	    			$term = get_queried_object();
					$templates = array();
					if ( ! empty( $term->slug ) ) {
						$taxonomy = $term->taxonomy;
						$slug_decoded = urldecode( $term->slug );
						if ( $slug_decoded !== $term->slug ) {
							$templates[] = get_template_directory() . "/taxonomy-$taxonomy-{$slug_decoded}.php";
						}
						$templates[] = get_template_directory() . "/taxonomy-$taxonomy-{$term->slug}.php";
						$templates[] = get_template_directory() . "/taxonomy-$taxonomy.php";
					}
					$templates[] = get_template_directory() . "/taxonomy.php";
					foreach ( $templates as $key => $value ) {
						if ( 'single' === $type && file_exists($value) ) {
							$file = $value;
							break;
						}
					}
	    	break;
	    	case (is_category()):
	    		$category = get_queried_object();
				$templates = array();
				if ( ! empty( $category->slug ) ) {
					$slug_decoded = urldecode( $category->slug );
					if ( $slug_decoded !== $category->slug ) {
						$templates[] = get_template_directory() . "/category-{$slug_decoded}.php";
					}
					$templates[] = get_template_directory() . "/category-{$category->slug}.php";
					$templates[] = get_template_directory() . "/category-{$category->term_id}.php";
				}
				$templates[] = get_template_directory() . '/category.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case (is_tag()):
	    		$tag = get_queried_object();
				$templates = array();
				if ( ! empty( $tag->slug ) ) {
					$slug_decoded = urldecode( $tag->slug );
					if ( $slug_decoded !== $tag->slug ) {
						$templates[] = get_template_directory() . "/tag-{$slug_decoded}.php";
					}
					$templates[] = get_template_directory() . "/tag-{$tag->slug}.php";
					$templates[] = get_template_directory() . "/tag-{$tag->term_id}.php";
				}
				$templates[] = get_template_directory() . '/tag.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case is_author():
	    		$author = get_queried_object();

				$templates = array();

				if ( $author instanceof WP_User ) {
					$templates[] = get_template_directory() . "/author-{$author->user_nicename}.php";
					$templates[] = get_template_directory() . "/author-{$author->ID}.php";
				}
				$templates[] = get_template_directory() . "/author.php";

				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case (is_archive()):
	    		$post_types = array_filter( (array) get_query_var( 'post_type' ) );
				$templates = array();
				if ( count( $post_types ) == 1 ) {
					$post_type = reset( $post_types );
					$templates[] = get_template_directory() . "/archive-{$post_type}.php";
				}
				$templates[] = get_template_directory() . '/archive.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case (is_post_type_archive()):
	    		$post_type = get_query_var( 'post_type' );
				if ( is_array( $post_type ) )
					$post_type = reset( $post_type );

				$obj = get_post_type_object( $post_type );
				if ( ! ($obj instanceof WP_Post_Type) || ! $obj->has_archive ) {
					//return '';
					break;
				}

				$post_types = array_filter( (array) get_query_var( 'post_type' ) );

				$templates = array();

				if ( count( $post_types ) == 1 ) {
					$post_type = reset( $post_types );
					$templates[] = get_template_directory() . "/archive-{$post_type}.php";
				}
				$templates[] = get_template_directory() . '/archive.php';
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case is_single(): 
	    		$object = get_queried_object();

				$templates = array();

				if ( ! empty( $object->post_type ) ) {
					$template = get_page_template_slug( $object );
					if ( $template && 0 === validate_file( $template ) ) {
						$templates[] = get_template_directory().'/'.$template;
					}

					$name_decoded = urldecode( $object->post_name );
					if ( $name_decoded !== $object->post_name ) {
						$templates[] = get_template_directory() . "/single-{$object->post_type}-{$name_decoded}.php";
					}

					$templates[] = get_template_directory() . "/single-{$object->post_type}-{$object->post_name}.php";
					$templates[] = get_template_directory() . "/single-{$object->post_type}.php";
				}

				$templates[] = get_template_directory() . "/single.php";
				
				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    	case is_page():
	    		$id = get_queried_object_id();
				$template = get_page_template_slug();
				$pagename = get_query_var('pagename');

				if ( ! $pagename && $id ) {
					// If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
					$post = get_queried_object();
					if ( $post )
						$pagename = $post->post_name;
				}

				$templates = array();
				if ( $template && 0 === validate_file( $template ) )
					$templates[] = get_template_directory().'/'.$template;
				if ( $pagename ) {
					$pagename_decoded = urldecode( $pagename );
					if ( $pagename_decoded !== $pagename ) {
						$templates[] = get_template_directory() . "/page-{$pagename_decoded}.php";
					}
					$templates[] = get_template_directory() . "/page-{$pagename}.php";
				}
				if ( $id )
					$templates[] = get_template_directory() . "/page-{$id}.php";
				$templates[] = get_template_directory() . "/page.php";

				foreach ( $templates as $key => $value ) {
					if ( 'single' === $type && file_exists($value) ) {
						$file = $value;
						break;
					}
				}
	    	break;
	    }
	    // Polylang Frontpage #1779
	    if ( 'single' === $type && ampforwp_polylang_front_page() && true == $redux_builder_amp['amp-frontpage-select-option'] ) {
			$file = get_template_directory() . '/page.php';
		}
	 	return $file;
	}

	/**
	* Sanitize featured image 
	**/
	//For featured image 
	public function featured_image_html($html, $post_id, $post_thumbnail_id, $size, $attr ){
		$html = $this->ampforwp_template_mode_cnt_sanitizer($html);
		return $html;
	}

	public function amp_the_content($content){
		global  $ampforwpTemplate;
		if(empty($ampforwpTemplate)){ return $content; }
		return $ampforwpTemplate->get( 'post_amp_content' );
	}

	public function amp_head_content(){
		global  $ampforwpTemplate;
		do_action( 'amp_meta', $ampforwpTemplate );
		do_action( 'amp_post_template_head', $ampforwpTemplate );
	}

	public function amp_head_css(){
		global  $ampforwpTemplate, $redux_builder_amp;
		$stylesheetUri = get_stylesheet_uri();

		$css = "";
		echo "<style amp-custom>";
		do_action( 'amp_post_template_css', $ampforwpTemplate ); 
		do_action( 'amp_css', $ampforwpTemplate ); 
		
		$stylesheetCss = $this->ampforwp_get_remote_content($stylesheetUri);
		$stylesheetCss = str_replace("img", 'amp-img', $stylesheetCss);
		$css .= $stylesheetCss;
		$css .= $redux_builder_amp['css_editor']; 
		echo $this->css_sanitizer($css);
		echo "</style>";
	}
	private function css_sanitizer($css){
		$css = preg_replace( '/\s*!important/', '', $css, -1, $important_count );
		$css = preg_replace( '/overflow(-[xy])?\s*:\s*(auto|scroll)\s*;?\s*/', '', $css, -1, $overlow_count );
            $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}', '::-' ), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ', ', '}', ' ::-'), $css);
		return $css;
	}
	public function search_form($form){
		return $this->ampforwp_template_mode_cnt_sanitizer($form);
	}

	public function amp_footer_content(){
		global  $ampforwpTemplate;
		do_action( 'amp_post_template_footer', $ampforwpTemplate );
		do_action('ampforwp_global_after_footer');
		do_action('amp_end',$ampforwpTemplate);
		amp_back_to_top_link();
	}

	public function get_avatar($avatar, $id_or_email, $args_size, $args_default, $args_alt, $args){
		return $this->ampforwp_template_mode_cnt_sanitizer($avatar);
	}

	public function ampforwp_get_remote_content($src){
		if($src){
			$arg = array( "sslverify" => false, "timeout" => 60 ) ;
			$response = wp_remote_get( $src, $arg );
	        if ( wp_remote_retrieve_response_code($response) == 200 && is_array( $response ) ) {
	          $header = wp_remote_retrieve_headers($response); // array of http header lines
	          $contentData =  wp_remote_retrieve_body($response); // use the content
	          return $contentData;
	        }

		}else{
			return $contentData = file_get_contents( $src );
		}
	    return '';
	}



	/**
	* Calling Actual callback of registered widgets 
	**/
	public function ampforwp_template_mode_reg_callback_widgets($indexData){
		global $wp_registered_widgets;
		$index = $indexData['widget_id'];
		$callback = $wp_registered_widgets[$index]['amp_callback'];
		$params = $wp_registered_widgets[$index]['amp_params'];
		$params = array_merge(
				array($indexData),
				$params
			);
		if ( is_callable($callback) ) {	
			ob_start();
			call_user_func_array($callback, $params);
			$data = ob_get_clean();
			echo $this->ampforwp_template_mode_cnt_sanitizer($data);
		}
	}

	/**
	* Remove Sanitize any content
	**/
	public function ampforwp_template_mode_cnt_sanitizer($content){
		$sanitizer_obj = new AMPFORWP_Content( $content,
								array(), 
								apply_filters( 'ampforwp_content_sanitizers', 
									array( 'AMP_Img_Sanitizer' => array(), 
										'AMP_Blacklist_Sanitizer' => array(),
										'AMP_Style_Sanitizer' => array(), 
										'AMP_Video_Sanitizer' => array(),
				 						'AMP_Audio_Sanitizer' => array(),
				 						'AMP_Iframe_Sanitizer' => array(
											 'add_placeholder' => true,
										 ),
									) 
								) 
							);
		 return $sanitizer_obj->get_amp_content();
	}

	public function author_meta_desctiption_amp($field, $user_id){
		return $this->ampforwp_template_mode_cnt_sanitizer($field);
	}


}//Class Closed
//add_action("after_setup_theme",function(){
//if(get_theme_support('amp-template')){
	$ampforwp_theme_mode = new AMPforWP_theme_mode();
	$ampforwp_theme_mode->init();
//}
//});