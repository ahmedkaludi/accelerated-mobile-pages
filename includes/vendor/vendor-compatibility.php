<?php
  add_action( 'parse_query', 'ampforwp_correct_query_front_page' );
function ampforwp_correct_query_front_page(WP_Query $query){
  if ( start_non_amp_to_amp_conversion()) {
    return false;
  }
  if ( false !== $query->get( amp_get_slug(), false ) ) {
    global $redux_builder_amp;
    $amp_is_frontpage = $amp_frontpage_id = '';
    if ( isset($redux_builder_amp['amp-frontpage-select-option']) && true == $redux_builder_amp['amp-frontpage-select-option'] ) {
      $amp_is_frontpage = true;
      $amp_frontpage_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
      $amp_frontpage_id = apply_filters('ampforwp_modify_frontpage_id', $amp_frontpage_id);
    }
    if ( (ampforwp_is_home() || ampforwp_is_front_page()) && $amp_is_frontpage && !ampforwp_is_blog() ){
      $query->is_home     = false;
      $query->is_page     = true;
      $query->is_singular = true;
      $query->set( 'page_id', $amp_frontpage_id );
    }elseif( ampforwp_is_home() || ampforwp_is_blog() ){
  		$query->is_home     = true;
  		$query->is_page     = false;
  		$query->is_singular = true;
  		$query->set( 'offset', '1' );
  	}
  }

}

/*
* is_archive() || is_search() Support added after 0.7 vendor amp
*/
add_action("wp",function(){ 
  if ( start_non_amp_to_amp_conversion()) {
    return ;
  }
  global $redux_builder_amp;
  $amp_frontpage_id = ampforwp_get_frontpage_id();
  if((is_archive() || is_search() || is_front_page() || ampforwp_is_blog() ) && is_amp_endpoint()){
    remove_action( 'template_redirect', 'amp_render' );
    if ( is_front_page() && $amp_frontpage_id ) {
      $amp_frontpage_post = get_post($amp_frontpage_id);
      amp_render_post($amp_frontpage_post);     
    }
    else
      amp_render_post(0);
    exit;
  }
});
// Sanitizers
add_filter("ampforwp_content_sanitizers", 'content_sanitizers_remove_blacklist', 999);
add_filter("amp_content_sanitizers", 'content_sanitizers_remove_blacklist', 999);
function content_sanitizers_remove_blacklist($sanitizer_classes){
  global $redux_builder_amp;
  // Whitelist sanitizer
	if(isset($sanitizer_classes['AMP_Blacklist_Sanitizer'])) {
		unset($sanitizer_classes['AMP_Blacklist_Sanitizer']);
		$sanitizer_classes['AMP_Tag_And_Attribute_Sanitizer']= array();
	}
	if(isset($sanitizer_classes['AMP_Base_Sanitizer'])) {
		unset($sanitizer_classes['AMP_Base_Sanitizer']);	
	}
  // New image sanitizer For Lightbox and FooGallery support
  if( isset( $sanitizer_classes['AMP_Img_Sanitizer']) ) {
    require_once( AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-img-sanitizer.php' );
    unset($sanitizer_classes['AMP_Img_Sanitizer']);
    $sanitizer_classes['AMPforWP_Img_Sanitizer']= array();
  }
  // New Iframe sanitizer to allow popups
  if(isset( $sanitizer_classes['AMP_Iframe_Sanitizer'] ) ) {
    require_once( AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-iframe-sanitizer.php' );
    unset($sanitizer_classes['AMP_Iframe_Sanitizer']);
    $sanitizer_classes['AMPforWP_Iframe_Sanitizer']= array();
  }
  return $sanitizer_classes;
}
// Embed Handlers
add_filter('amp_content_embed_handlers', 'ampforwp_modified_embed_handlers');
function ampforwp_modified_embed_handlers($handlers){
  // New Gallery Embed Handler for Gallery with Captions
  if(isset($handlers['AMP_Gallery_Embed_Handler'])) {
    require_once(AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-gallery-embed.php');
    unset($handlers['AMP_Gallery_Embed_Handler']);  
    $handlers['AMPforWP_Gallery_Embed_Handler'] = array();
  }
  // New Vimeo Embed Handler
  if (isset($handlers['AMP_Vimeo_Embed_Handler'])) {
    require_once(AMPFORWP_PLUGIN_DIR. 'classes/class-ampforwp-vimeo-embed.php');
    unset($handlers['AMP_Vimeo_Embed_Handler']);  
    $handlers['AMPforWP_Vimeo_Embed_Handler'] = array();
  }
  return $handlers;
}

add_action( 'init', 'remove_amp_init', 100 );
function remove_amp_init(){
	remove_action( 'admin_init', 'AMP_Options_Manager::register_settings' );
	remove_action( 'wp_loaded', 'amp_post_meta_box' );
	remove_action( 'wp_loaded', 'amp_add_options_menu' );
	remove_action( 'parse_query', 'amp_correct_query_when_is_front_page' );
}

add_filter( 'amp_post_status_default_enabled', 'ampforwp_post_status' );
function ampforwp_post_status($enabled){
  global $redux_builder_amp, $post;
  if ( ( is_single() && 'post' === $post->post_type && ! $redux_builder_amp['amp-on-off-for-all-posts'] )  || ( is_page() && ! $redux_builder_amp['amp-on-off-for-all-pages'] ) ){
    $enabled = false;
  }
  if( ( ampforwp_is_home() || ampforwp_is_front_page() ) && ! $redux_builder_amp['ampforwp-homepage-on-off-support'] ){
    // returning false will redirect the homepage to the last post
    // Redirect the Homepage from here itself
    wp_safe_redirect( get_bloginfo('url'), 301 );
    exit;
  }
  return $enabled;
}

// Template Overriding for Home, Blog, FrontPage , Archives and Search
add_filter( 'amp_post_template_file', 'ampforwp_custom_template', 10, 3 );
function ampforwp_custom_template( $file, $type, $post ) {
  if ( current_theme_supports( 'amp' ) || start_non_amp_to_amp_conversion() ) {
    return $file;
  }
  global $redux_builder_amp, $wp_query;
  $slug = array();
  $current_url_in_pieces = array();
  $ampforwp_custom_post_page  =  ampforwp_custom_post_page();
  if ( 'single' === $type ) {
      // Homepage 
      if ( ampforwp_is_home() ) {
          $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
      }
      // Archive Pages
      if ( is_archive() && $redux_builder_amp['ampforwp-archive-support'] )  {

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

  // Polylang compatibility
  // For Frontpage
  if ( 'single' === $type && ampforwp_polylang_front_page() && true == $redux_builder_amp['amp-frontpage-select-option'] ) {
    $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/frontpage.php';
  }
  if( 'page' === $type ) {
      // pages
      if ( is_page() ) {
          $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/single.php';
      }
      // Blog
      if ( ampforwp_is_blog() ) {
          $file = AMPFORWP_PLUGIN_DIR . '/templates/design-manager/design-'. ampforwp_design_selector() .'/index.php';
      }
      // FrontPage
      if ( ampforwp_is_front_page() )  {      
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
//add_action("activated_plugin", "ampforwp_load_plugin_last");


// End-point (?amp) and correct amphtml for pages after 0.7
add_filter( 'amp_get_permalink', 'ampforwp_change_end_point' );
function ampforwp_change_end_point($url){
  global $redux_builder_amp;
  $post_id = get_the_ID();
  $amp_url = $url;
  if( is_page() && is_post_type_hierarchical( get_post_type( $post_id ) )){
    $amp_url = remove_query_arg( 'amp', $amp_url );
    $amp_url = trailingslashit( $amp_url );
    $amp_url = user_trailingslashit( $amp_url . AMPFORWP_AMP_QUERY_VAR );
  }
  if(isset($redux_builder_amp['amp-core-end-point']) && $redux_builder_amp['amp-core-end-point']){
  $amp_url = get_permalink();
    $amp_url = add_query_arg(AMPFORWP_AMP_QUERY_VAR,'',$amp_url);
  }
  return $amp_url;
}

/*
* Function Check wp theme will convert as AMP theme or not
* Its @return true when Convert option Enabled  
*/
function start_non_amp_to_amp_conversion(){
  global $redux_builder_amp;
  if(
      isset( $redux_builder_amp['amp-design-type-selection'] )
      && 'amp-converter' == $redux_builder_amp['amp-design-type-selection']
    ){
    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/'); 
    $pos = strpos($url_path, amp_get_slug());
    if(false!== $pos){
      return true;
    }
      return false;
  }
  return false;
}

// Integer value for date, more info: #1241
add_filter('amp_post_template_data', 'ampforwp_post_template_data');
function ampforwp_post_template_data( $data ) {
  // post publish timestamp. Integer value for date, more info: #1241
  $data['post_publish_timestamp'] = intval($data['post_publish_timestamp']);
  // Placeholder Image. for more info: #1310
  $data['placeholder_image_url'] = AMPFORWP_IMAGE_DIR. '/placeholder-icon.png';

  return $data;
}


add_action('plugins_loaded', function(){
 if(!is_admin()){
    add_filter("ampforwp_update_autoload_class", 'ampforwp_update_class',10,2);
  }
});

function ampforwp_update_class($classList, $currentClass){
  $updateClass = array('AMP_Theme_Support',
                      'AMP_Tag_And_Attribute_Sanitizer', 
                      'AMP_Style_Sanitizer',
                      'AMP_Allowed_Tags_Generated',
                    );
  if(!in_array($currentClass, $updateClass)){
    return true;
  }
  switch ($currentClass) {
    case 'AMP_Theme_Support':
        if ( file_exists(  AMPFORWP_PLUGIN_DIR .'/includes/vendor/vendor-files/vendor/autoload.php' ) ) {
          require_once  AMPFORWP_PLUGIN_DIR .'/includes/vendor/vendor-files/vendor/autoload.php';
        }
        require AMPFORWP_PLUGIN_DIR . "/includes/vendor/vendor-files/class-amp-theme-support.php";
        //AMP_Response_Headers
        require AMPFORWP_PLUGIN_DIR . "/includes/vendor/vendor-files/class-amp-response-headers.php";
        //AMP_Core_Theme_Sanitizer
        require AMPFORWP_PLUGIN_DIR . "/includes/vendor/vendor-files/sanitizer/class-amp-core-theme-sanitizer.php";
      break;
    case "AMP_Tag_And_Attribute_Sanitizer":
        require AMPFORWP_PLUGIN_DIR . "/includes/vendor/vendor-files/sanitizer/class-amp-tag-and-attribute-sanitizer.php";
      break;
    case "AMP_Style_Sanitizer":
        require AMPFORWP_PLUGIN_DIR . "/includes/vendor/vendor-files/sanitizer/class-amp-style-sanitizer.php";
      break;
    case "AMP_Allowed_Tags_Generated":
        require AMPFORWP_PLUGIN_DIR . "/includes/vendor/vendor-files/class-amp-allowed-tags-generated.php";
      break;
    default:
      # code...
      break;
  }
  return false;
}


if(!function_exists('ampforwp_isexternal')){
  function ampforwp_isexternal($url) {
    $components = parse_url($url);
    if ( empty($components['host']) ) return false;  // we will treat url like '/relative.php' as relative
    if ( strcasecmp($components['host'], $_SERVER['HTTP_HOST']) === 0 ) return false; // url host looks exactly like the local host
    return strrpos(strtolower($components['host']), $_SERVER['HTTP_HOST']) !== strlen($components['host']) - strlen($_SERVER['HTTP_HOST']); // check if the url host is a subdomain
  }//Function function_exists
}// ampforwp_isexternal function_exists close

if(!function_exists('ampforwp_findInternalUrl')){
  function ampforwp_findInternalUrl($url){
    if(!ampforwp_isexternal($url) && strpos($url, amp_get_slug())=== False){
      if(strpos($url, "#")!==false){
        $url = explode("#",$url);
        $url = trailingslashit($url[0]).user_trailingslashit(amp_get_slug()).'#'.$url[1];
      }else{
        $url = trailingslashit($url).user_trailingslashit(amp_get_slug());
      }
      return $url;
    }
    return $url;
  }// function Close
}// function_exists ampforwp_findInternalUrl close