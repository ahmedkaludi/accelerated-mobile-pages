<?php
add_action( 'parse_query', 'ampforwp_correct_query_front_page' );
function ampforwp_correct_query_front_page(WP_Query $query){
	if ( !is_admin() && ampforwp_is_front_page() && ampforwp_get_frontpage_id()){
		$query->is_home     = false;
		$query->is_page     = true;
		$query->is_singular = true;
		$query->set( 'page_id', 2 );
	}elseif( !is_admin() && ampforwp_is_home() && $query->is_main_query() ){
		$query->is_home     = true;
		$query->is_page     = false;
		$query->is_singular = true;
		$query->set( 'offset', '1' );
	}elseif( is_archive() && $query->is_archive ){
		
	}
}
add_filter("ampforwp_content_sanitizers", 'content_sanitizers_remove_blacklist', 999);
add_filter("amp_content_sanitizers", 'content_sanitizers_remove_blacklist', 999);
function content_sanitizers_remove_blacklist($sanitizer_classes){
	if(isset($sanitizer_classes['AMP_Blacklist_Sanitizer'])) {
		unset($sanitizer_classes['AMP_Blacklist_Sanitizer']);
		$sanitizer_classes['AMP_Tag_And_Attribute_Sanitizer']= array();
	}
	if(isset($sanitizer_classes['AMP_Base_Sanitizer'])) {
		unset($sanitizer_classes['AMP_Base_Sanitizer']);
		
	}
		return $sanitizer_classes;
}
add_action( 'init', 'remove_amp_init', 100 );
function remove_amp_init(){
	remove_action( 'admin_init', 'AMP_Options_Manager::register_settings' );
	remove_action( 'wp_loaded', 'amp_post_meta_box' );
	remove_action( 'wp_loaded', 'amp_add_options_menu' );
	remove_action( 'parse_query', 'amp_correct_query_when_is_front_page' );
}

add_filter( 'amp_post_status_default_enabled', 'ampforwp_blog_front_page_enabled_support' );
function ampforwp_blog_front_page_enabled_support($enabled){

  return true;
}





// Add Homepage AMP file code
  add_filter( 'amp_post_template_file', 'ampforwp_custom_template', 10, 3 );
  function ampforwp_custom_template( $file, $type, $post ) {
        global $redux_builder_amp, $wp_query;
       // Custom Homepage and Archive file
    $slug = array();
    $current_url_in_pieces = array();
    $ampforwp_custom_post_page  =  ampforwp_custom_post_page();
            
         
      if ( 'single' === $type ) {
          // Archive Pages
          if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] && 'single' === $type )  {

              $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/archive.php';
          }
      // Search pages
          if ( is_search() &&
              ( $redux_builder_amp['amp-design-1-search-feature'] ||
                $redux_builder_amp['amp-design-2-search-feature'] ||
                $redux_builder_amp['amp-design-3-search-feature'] )
              )  {
              $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/search.php';
          }
    }

    // for type page 
      if ( is_single() || is_page() ) {
      if('page' === $type ) {
         $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/single.php';
       }
    }
    // Polylang compatibility
    // For Frontpage
    if ( 'single' === $type && ampforwp_polylang_front_page() && true == $redux_builder_amp['amp-frontpage-select-option'] ) {
      $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
    }

    if('page' === $type){
      // Homepage and FrontPage
          	if ( is_home() || ( get_the_ID() === (int) get_option( 'page_for_posts' ) )  ) {
					$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';

                if ( ampforwp_is_blog() ) {
            		$file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
                }
        	}
            if ( $wp_query->is_page &&  $redux_builder_amp['amp-frontpage-select-option'] && get_the_ID() === (int) get_option( 'page_for_posts' ) )  {
               
                $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
              }

    }

      return $file;
  }

  /*
*
* Use the code at the beginning of a plugin that you want to be laoded at last 
*
*/
function ampforwp_load_plugin_last() {
	$wp_path_to_this_file = preg_replace('/(.*)plugins\/(.*)$/', WP_PLUGIN_DIR."/$2", __FILE__);
	$this_plugin = plugin_basename(trim($wp_path_to_this_file));
	$active_plugins = get_option('active_plugins');
	$this_plugin_key = array_search($this_plugin, $active_plugins);
        array_splice($active_plugins, $this_plugin_key, 1);
        array_push($active_plugins, $this_plugin);
        update_option('active_plugins', $active_plugins);
}
add_action("activated_plugin", "ampforwp_load_plugin_last");