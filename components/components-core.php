<?php
$loadComponent = array();
$scriptComponent = array();
$supportComponent = array('AMP-search','AMP-menu','AMP-logo','AMP-social-icons','AMP-sidebar','AMP-featured-image','AMP-author-box','AMP-loop','AMP-categories-tags','AMP-comments','AMP-post-navigation','AMP-related-posts','AMP-post-pagination','AMP-call-now');
//$removeScriptComponent = array('amp-carousel');
add_filter( 'amp_post_template_data', 'ampforwp_framework_add_and_form_scripts',20);
function ampforwp_framework_add_and_form_scripts($data) {
	global $scriptComponent, $loadComponent; //$removeScriptComponent;
	
	if(count($scriptComponent)>0){
		foreach ($scriptComponent as $key => $value) {
			if ( empty( $data['amp_component_scripts'][$key] ) ) {
				$data['amp_component_scripts'][$key] = $value;
			}
		}
	}
	/*if(count($removeScriptComponent)>0){
		foreach ($removeScriptComponent as $key => $value) {
			if ( empty( $data['amp_component_scripts'][$key] ) ) {
				unset($data['amp_component_scripts']['$key']);
			}
		}	
	}*/
	return $data;
}

//Component Loader
function add_amp_theme_support($componentName){
	global $wpdb;
	global $loadComponent,$supportComponent;
	if($supportComponent){
		if(in_array($componentName, $supportComponent)){
			$loadComponent[$componentName] = true;
			loadComponents($componentName);
			return true;
		}
	}
	return false;
}
//Include the Component file
function loadComponents($componentName){
	global $wpdb;
	if(empty($componentName)) return '';
	$componentName = str_replace("AMP-", "", $componentName);

	$file = AMP_FRAMEWORK_COMOPNENT_DIR_PATH.'/'.$componentName.'/'.$componentName.".php";
	if(!file_exists($file)){
		return '';
	}
	include_once($file);
}
	
/**
 * Component Functions
 **/

//Search Component Utilities
function amp_search(){
	global $loadComponent;
	if(isset($loadComponent['AMP-search']) && $loadComponent['AMP-search']==true){
		 ampforwp_framework_get_search_form();
	}
}

// Logo Component Utilitis
function amp_logo(){
	global $loadComponent;
	if(isset($loadComponent['AMP-logo']) && $loadComponent['AMP-logo']==true){
		 ampforwp_framework_get_logo();
	}
}

// Title
function amp_title(){
		global $redux_builder_amp, $post;
	$ID = '';
	if(is_home() && $redux_builder_amp['amp-frontpage-select-option'] == 1){
		if( $redux_builder_amp['ampforwp-title-on-front-page'] ) {
			$ID = $redux_builder_amp['amp-frontpage-select-option-pages'];
		}
	}
	else
		$ID = $post->ID;
	if( $ID!=null ){
		do_action('ampforwp_above_the_title',$this); ?>
			<h1 class="amp-post-title"> <?php 
				$ampforwp_title = get_the_title($ID);
				$ampforwp_title =  apply_filters('ampforwp_filter_single_title', $ampforwp_title);
				echo wp_kses_data( $ampforwp_title ); ?>
			</h1>
        <?php do_action('ampforwp_below_the_title',$this); ?>
<?php
    }
}


//Menus
function amp_menu(){
		global $loadComponent;
		if(isset($loadComponent['AMP-menu']) && $loadComponent['AMP-menu']==true){
			amp_menu_html();
		}
	}

// Social Icons component
function amp_social($social_icons=""){
	global $loadComponent;
	$amp_social = array();
	//Supported social icons	 
	$amp_social = array('twitter','facebook','pinterest','google-plus','linkedin','youtube','instagram','reddit','VKontakte','snapchat','tumblr');
	if(isset($loadComponent['AMP-social-icons']) && $loadComponent['AMP-social-icons']==true){
		if($social_icons!=null){
		 ampforwp_framework_get_social_icons($social_icons);
		}
		else 
		 ampforwp_framework_get_social_icons($amp_social);
	}
}

//Sidebar
function amp_sidebar($tag='start',$data=array()){
	global $loadComponent;
	if(isset($loadComponent['AMP-sidebar']) && $loadComponent['AMP-sidebar']==true){
		ampforwp_framework_get_sideabr($tag,$data);
	}
}

//Featured Image
function amp_featured_image( ){
	global $loadComponent;
	if(isset($loadComponent['AMP-featured-image']) && $loadComponent['AMP-featured-image']==true){
		ampforwp_framework_get_featured_image( );
	}
}

// Author Box
function amp_author_box( $author_url="" ){
	global $loadComponent;
	if(isset($loadComponent['AMP-author-box']) && $loadComponent['AMP-author-box']==true){
		ampforwp_framework_get_author_box($author_url );
	}
}

// Categories List
function amp_categories_list( ){
	global $loadComponent;
	if(isset($loadComponent['AMP-categories-tags']) && $loadComponent['AMP-categories-tags']==true){
		ampforwp_framework_get_categories_list( );
	}
}
// Tags List
function amp_tags_list( ){
	global $loadComponent;
	if(isset($loadComponent['AMP-categories-tags']) && $loadComponent['AMP-categories-tags']==true){
		ampforwp_framework_get_tags_list( );
	}
}

// Comments
function amp_comments( ){
	global $loadComponent;
	if(isset($loadComponent['AMP-comments']) && $loadComponent['AMP-comments']==true){
		ampforwp_framework_get_comments( );
	}
}

// Post Navigation
function amp_post_navigation( ){
	global $loadComponent;
	if(isset($loadComponent['AMP-post-navigation']) && $loadComponent['AMP-post-navigation']==true){
		echo ampforwp_framework_get_post_navigation( );
	}
}

// Related Posts
function amp_related_posts( ){
	global $loadComponent;
	if(isset($loadComponent['AMP-related-posts']) && $loadComponent['AMP-related-posts']==true){
		echo ampforwp_framework_get_related_posts( );
	}
}

// Post Pagination
function amp_post_pagination($args='' ){
	global $loadComponent;
	if(isset($loadComponent['AMP-post-pagination']) && $loadComponent['AMP-post-pagination']==true){
		  ampforwp_framework_get_post_pagination();
	}
}

// Call Now
function amp_call_now(){
	global $loadComponent;
	if(isset($loadComponent['AMP-call-now']) && $loadComponent['AMP-call-now']==true){
		amp_call_button_html_output();
	}
}

//Get Core of AMP HTML
function amp_header_core(){
	$post_id = get_queried_object_id();
	$thisTemplate = new AMP_Post_Template($post_id);
	global $redux_builder_amp;
	$html_tag_attributes = AMP_HTML_Utils::build_attributes_string( $thisTemplate->get( 'html_tag_attributes' ) );
	
	$bodyClass = '';
    if ( is_single() || is_page() ) {
			$bodyClass = 'single-post';
			$bodyClass .= ( is_page()? 'amp-single-page' : 'amp-single');
  		
	}
	// Archive
	if ( is_archive() ) {
        $bodyClass = 'amp-archive';
    }
    $ampforwp_custom_post_page  =  ampforwp_custom_post_page();
    // Homepage
	if ( is_home() ) {
		
    	$bodyClass = 'amp-index '.esc_attr( $thisTemplate->get( 'body_class' ) ); 
    	if ($redux_builder_amp['amp-frontpage-select-option'] == 1) {
			$bodyClass = 'single-post design_3_wrapper';
        }
        if ( $ampforwp_custom_post_page == "page" && ampforwp_name_blog_page() ) {
			$current_url = home_url( $GLOBALS['wp']->request );
			$current_url_in_pieces = explode( '/', $current_url );
		
			if( in_array( ampforwp_name_blog_page() , $current_url_in_pieces )  ) {
				 $bodyClass = 'amp-index '.esc_attr( $thisTemplate->get( 'body_class' ) ); 
			}  
		}
    
    }
    // is_search
	if ( is_search() ) {
        if ( 'single' === $type ) {
            $bodyClass = 'amp_home_body archives_body design_3_wrapper';
        }
    }
	?><!doctype html>
	<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $thisTemplate->get( 'html_tag_attributes' ) ); ?>>
		<head>
		<meta charset="utf-8">
		    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
		    <?php do_action( 'amp_meta', $thisTemplate ); ?>
		    <?php do_action( 'amp_post_template_head', $thisTemplate ); ?>			
			<style amp-custom>
				<?php $thisTemplate->load_parts( array( 'style' ) ); ?>
				<?php do_action( 'amp_post_template_css', $thisTemplate ); ?>
				<?php do_action( 'amp_css', $thisTemplate ); ?>
			</style>

		</head>
		<body class="<?php echo $bodyClass; ?>">
		<?php do_action('amp_start', $thisTemplate); ?>
		<?php do_action('ampforwp_body_beginning', $thisTemplate);  
}

function amp_header(){
	$post_id = get_queried_object_id();
	$thisTemplate = new AMP_Post_Template($post_id);
	$thisTemplate->load_parts( array( 'header' ) ); 
	do_action( 'amp_after_header', $thisTemplate );
	do_action( 'ampforwp_after_header', $thisTemplate );
 	do_action('ampforwp_post_before_design_elements') ?>
<?php } 

function amp_footer(){
	$post_id = get_queried_object_id();
	$thisTemplate = new AMP_Post_Template($post_id);		
	do_action( 'amp_before_footer', $thisTemplate );
	do_action( 'amp_post_template_above_footer', $thisTemplate );
	$thisTemplate->load_parts( array( 'footer' ) );
	
}

function amp_footer_core(){
	$post_id = get_queried_object_id();
	$thisTemplate = new AMP_Post_Template($post_id);
	do_action( 'amp_post_template_footer', $thisTemplate );
	do_action('ampforwp_global_after_footer');
	do_action('amp_end',$thisTemplate);
	// Close the body and Html tags ?>
	</body>
		</html><?php
}

function amp_non_amp_link(){
	global $allowed_html;
    global $redux_builder_amp;
    echo wp_kses($redux_builder_amp['amp-translator-footer-text'],$allowed_html) ;
    if($redux_builder_amp['amp-footer-link-non-amp-page']=='1') { ampforwp_view_nonamp(); }
}

function amp_loop_template(){
	$post_id = get_queried_object_id();
	$thisTemplate = new AMP_Post_Template($post_id);
	do_action('amp_before_loop',$thisTemplate);
	$thisTemplate->load_parts( array( 'loop' ) );
	do_action('amp_after_loop',$thisTemplate);
}

// The Content
function amp_content(){ 
global $redux_builder_amp, $post;
$post_id = get_queried_object_id();
if(is_home() && $redux_builder_amp['amp-frontpage-select-option'] == 1){
			$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}
$thisTemplate = new AMP_Post_Template($post_id);
	 ?>
	<div>
	    <?php do_action('ampforwp_before_post_content',$thisTemplate); 
		$amp_custom_content_enable = get_post_meta( $thisTemplate->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);
		// Normal Content
		if ( ! $amp_custom_content_enable ) {
				$ampforwp_the_content = $thisTemplate->get( 'post_amp_content' ); // amphtml content; no kses
			} else {
				// Custom/Alternative AMP content added through post meta  
				$ampforwp_the_content = $thisTemplate->get( 'ampforwp_amp_content' );
			} 
		$ampforwp_the_content = apply_filters('ampforwp_content_filter',$ampforwp_the_content);
		echo $ampforwp_the_content;
    	do_action('ampforwp_after_post_content',$thisTemplate); ?>
	</div>
<?php }

//Load font Compoment
	$fontComponent = array();
	function amp_post_load_custom_fonts(){
		global $fontComponent;
		if(count($fontComponent)){
			$fontComponent = array_unique($fontComponent);
			foreach ($fontComponent as $key => $value) {
			?>
			<link rel="stylesheet" href="<?php echo esc_url( $value ); ?>">
			<?php		
			}
		}
		
	}
	add_action( 'amp_meta', 'amp_post_load_custom_fonts');
	function amp_font($fontName){
		global $fontComponent;
		$fontComponent[] = $fontName;
	}