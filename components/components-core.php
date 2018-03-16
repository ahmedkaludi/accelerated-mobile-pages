<?php
global $redux_builder_amp;
$loadComponent = array();
$scriptComponent = array();
$supportComponent = array('AMP-search','AMP-menu','AMP-logo','AMP-social-icons','AMP-sidebar','AMP-featured-image','AMP-author-box','AMP-loop','AMP-categories-tags','AMP-comments','AMP-post-navigation','AMP-related-posts','AMP-post-pagination','AMP-call-now', 'AMP-breadcrumb');
//$removeScriptComponent = array('amp-carousel');'
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

// Icons
$amp_icons_css = array();
function add_amp_icon($args=array()){
	global $amp_icons_css;
	$amp_icons_css_array = include AMPFORWP_PLUGIN_DIR .'includes/icons/amp-icons.php';
	foreach ($args as $key ) {
		if(isset($amp_icons_css_array[$key]))
			$amp_icons_css[$key] = $amp_icons_css_array[$key]; 
	}
	add_action('amp_css', 'amp_icon_css');
	
}
function amp_icon_css(){
	global $amp_icons_css;
	foreach ($amp_icons_css as $key => $value) {
	    echo $value;
	}
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
	elseif ( ampforwp_polylang_front_page() ) {
		$ID = pll_get_post(get_option('page_on_front'));
	}
	else
		$ID = $post->ID;
	if( $ID!=null ){
		do_action('ampforwp_above_the_title'); ?>
			<h1 class="amp-post-title"> <?php 
				$ampforwp_title = get_the_title($ID);
				$ampforwp_title =  apply_filters('ampforwp_filter_single_title', $ampforwp_title);
				echo wp_kses_data( $ampforwp_title ); ?>
			</h1>
        <?php do_action('ampforwp_below_the_title'); ?>
<?php
    }
}

// Excerpt
function amp_excerpt( $no_of_words=15 ) {
	global $redux_builder_amp, $post;
	$post_id = '';
	if ( ampforwp_is_front_page() ) {
		$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}
	else
		$post_id = $post->ID;
	if ( $post_id != null && true == $redux_builder_amp['enable-excerpt-single'] ) {  ?>
			<p><?php 
				 if ( has_excerpt() ) {
					$content = get_the_excerpt();
				} else {
					$content = get_the_content();
				}
				echo wp_trim_words( strip_shortcodes( $content ) , $no_of_words ); 
			?></p>
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
function amp_social( $social_icons="" ) {
	global $loadComponent;
	$amp_social = array();
	//Supported social icons	 
	$amp_social = array( 'twitter', 'facebook', 'pinterest', 'google-plus', 'linkedin', 'youtube', 'instagram', 'reddit', 'VKontakte', 'Odnoklassniki', 'snapchat', 'tumblr' );
	if ( isset($loadComponent['AMP-social-icons']) && true == $loadComponent['AMP-social-icons'] ) {
		if ( null != $social_icons ) {
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
function amp_author_box($args=array() ){
	global $loadComponent;
	if(isset($loadComponent['AMP-author-box']) && $loadComponent['AMP-author-box']==true){
		ampforwp_framework_get_author_box($args);
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
function amp_related_posts($argsdata = array()){
	global $loadComponent;
	if(isset($loadComponent['AMP-related-posts']) && $loadComponent['AMP-related-posts']==true){
		echo ampforwp_framework_get_related_posts( $argsdata);
	}
}

// Post Pagination
function amp_post_pagination($args='' ){
	global $loadComponent;
	if(isset($loadComponent['AMP-post-pagination']) && $loadComponent['AMP-post-pagination']==true){
		  ampforwp_framework_get_post_pagination($args);
	}
}

// Call Now
function amp_call_now(){
	global $loadComponent;
	if(isset($loadComponent['AMP-call-now']) && $loadComponent['AMP-call-now']==true){
		amp_call_button_html_output();
	}
}

// Breadcrumb
function amp_breadcrumb(){
	global $loadComponent;
	if ( isset($loadComponent['AMP-breadcrumb']) && true == $loadComponent['AMP-breadcrumb'] ) {
		echo amp_breadcrumb_output();
	}
}

//Get Core of AMP HTML
function amp_header_core(){
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = new AMP_Post_Template($post_id);
	global $redux_builder_amp;
	$html_tag_attributes = AMP_HTML_Utils::build_attributes_string( $thisTemplate->get( 'html_tag_attributes' ) );
	
	$bodyClass = '';
    if ( is_single() || is_page() ) {
			$bodyClass = 'single-post';
			$bodyClass .= ( is_page()? ' amp-single-page ' : ' amp-single ');
  		
	}
	// Archive
	if ( is_archive() ) {
        $bodyClass = 'amp-archive';
    }
    $ampforwp_custom_post_page  =  ampforwp_custom_post_page();
    // Homepage
	if ( is_home() ) {
		
    	$bodyClass = 'amp-index amp-home'.esc_attr( $thisTemplate->get( 'body_class' ) ); 
    	if ($redux_builder_amp['amp-frontpage-select-option'] == 1) {
			$bodyClass = 'single-post design_3_wrapper';
        }
        if ( $ampforwp_custom_post_page == "page" && ampforwp_name_blog_page() ) {
			$current_url = home_url( $GLOBALS['wp']->request );
			$current_url_in_pieces = explode( '/', $current_url );
		
			if( in_array( ampforwp_name_blog_page() , $current_url_in_pieces )  ) {
				 $bodyClass = 'amp-index' .esc_attr( $thisTemplate->get( 'body_class' ) ); 
			}  
		}
    
    }
    // is_search
	if ( is_search() ) {
        $bodyClass = 'amp_home_body archives_body design_3_wrapper';
    }
    if( true == $redux_builder_amp['amp-rtl-select-option'] ){
    	$bodyClass .= ' rtl ';
    }
	?><!doctype html>
	<html <?php echo ampforwp_amp_nonamp_convert('amp '); ?><?php echo AMP_HTML_Utils::build_attributes_string( $thisTemplate->get( 'html_tag_attributes' ) ); ?>>
		<head>
		<meta charset="utf-8"> 

		    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
		    <?php do_action( 'amp_meta', $thisTemplate ); ?>
		    <?php 
		    	if(ampforwp_amp_nonamp_convert("", "check")){
		    		echo '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">';
		    		wp_head();

		    	}else{
		    		do_action( 'amp_post_template_head', $thisTemplate );
		    	} ?>		
			<style amp-custom>
				<?php $thisTemplate->load_parts( array( 'style' ) ); ?>
				<?php do_action( 'amp_post_template_css', $thisTemplate ); ?>
				<?php do_action( 'amp_css', $thisTemplate ); ?>
				<?php echo $redux_builder_amp['css_editor']; ?>
			</style>

		</head>
		<body <?php ampforwp_body_class($bodyClass); ?>>
		<?php do_action('amp_start', $thisTemplate); ?>
		<?php do_action('ampforwp_body_beginning', $thisTemplate);  
}

function amp_header(){
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = new AMP_Post_Template($post_id);
	$thisTemplate->load_parts( array( 'header' ) ); 
	do_action( 'amp_after_header', $thisTemplate );
	do_action( 'ampforwp_after_header', $thisTemplate );
 	do_action('ampforwp_post_before_design_elements') ?>
<?php } 

function amp_footer(){
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = new AMP_Post_Template($post_id);		
	do_action( 'amp_before_footer', $thisTemplate );
	do_action( 'amp_post_template_above_footer', $thisTemplate );

	$thisTemplate->load_parts( array( 'footer' ) );

}

function amp_footer_core(){
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = new AMP_Post_Template($post_id);
	if(ampforwp_amp_nonamp_convert("", "check")){
		wp_footer();
	}
	else {
		do_action( 'amp_post_template_footer', $thisTemplate );
		do_action('ampforwp_global_after_footer');
		do_action('amp_end',$thisTemplate);
	}
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

// Back to Top
function amp_back_to_top_link(){
	 global $redux_builder_amp;
    if( '1' == $redux_builder_amp['ampforwp-footer-top'] ) { ?>
        <a href="#top"><?php echo ampforwp_translation( $redux_builder_amp['amp-translator-top-text'], 'Top'); ?> </a> 
      <?php }
}

function amp_loop_template(){
	$post_id = get_queried_object_id();
	$thisTemplate = new AMP_Post_Template($post_id);
	do_action('amp_before_loop',$thisTemplate);
	$thisTemplate->load_parts( array( 'loop' ) );
	do_action('amp_after_loop',$thisTemplate);
}

// The Content
function amp_content($post_id= ''){ 
global $redux_builder_amp, $post;


if ( empty( $post_id )) {
	
	$post_id = get_queried_object_id();
	if ( ampforwp_is_front_page() ) {
		$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
	}
	elseif ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
}

$thisTemplate = new AMP_Post_Template($post_id); ?>
    <?php do_action('ampforwp_before_post_content',$thisTemplate); 
	$amp_custom_content_enable = get_post_meta( $thisTemplate->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);
	// Normal Content
	if ( ! $amp_custom_content_enable ) {
			$ampforwp_the_content = $thisTemplate->get( 'post_amp_content' ); // amphtml content; no kses
		} else {
			// Custom/Alternative AMP content added through post meta  
			$ampforwp_the_content = $thisTemplate->get( 'ampforwp_amp_content' );
		} 
	$ampforwp_the_content = apply_filters('ampforwp_modify_the_content',$ampforwp_the_content);
	echo $ampforwp_the_content;
	do_action('ampforwp_after_post_content',$thisTemplate); ?>
<?php }

function amp_date( $args=array() ) {

    global $redux_builder_amp;
    if ( 2 == $redux_builder_amp['ampforwp-post-date-format'] ) {
    	$args['format'] = 'traditional';
    }
    if ( (isset($args['format']) && $args['format'] == 'traditional') || 'time' == $args ) {
      $post_date = esc_html( get_the_date() ) . ' '.esc_html( get_the_time());
        } else {
          $post_date = human_time_diff(
                    get_the_time('U', get_the_ID() ), 
                    current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],
                    'ago');
        }
        $post_date = apply_filters('ampforwp_modify_post_date', $post_date);
        if(isset($args['custom_format']) && $args['custom_format']!=""){
	    	$post_date = date($args['custom_format'],get_the_time('U', get_the_ID() ));
	    }
        if ( 'date' == $args || 'time' == $args ) {
          echo $post_date .' ';
        }
        else
          echo '<div class="loop-date">'.$post_date.'</div>';
  }

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

// RTL Styling
add_action('amp_css', 'amp_theme_framework_rtl_styles');
if( ! function_exists('amp_theme_framework_rtl_styles') ){
	function amp_theme_framework_rtl_styles(){
		global $redux_builder_amp;
		if( true === $redux_builder_amp['amp-rtl-select-option'] ){ ?>
			body.rtl {direction: rtl;}
			body amp-carousel{ direction: ltr;}
		<?php }
	}
}

// Author Meta
function amp_author_meta( $args ) {
	global $post;
	$author_name = false;
	$avatar = false;
	$avatar_size = 40;
	if ( isset($args['name']) ) {
		$author_name = $args['name'];
	}
	if ( 'name' === $args ) {
		$author_name = true;
	}
	if ( 'avatar' === $args || 'image' === $args ) {
		$avatar = true;
	}
	if ( isset($args['image']) ) {
		$avatar = $args['image'];
	}
	if ( isset($args['image_size']) ) {
		$avatar_size = $args['image_size'];
	}
	$post_author = get_userdata($post->post_author);
	$author_link = get_author_posts_url($post_author->ID);
	if ( $author_name ) {
		echo ' <a href="'. esc_url(ampforwp_url_controller($author_link)).'"> ' .esc_html( $post_author->display_name ).'</a>';
 	}
 	if ( $avatar && true == ampforwp_gravatar_checker($post_author->user_email) ) {
		$author_avatar_url = get_avatar_url( $post_author->ID, array( 'size' => $avatar_size ) );
            ?>
        <amp-img src="<?php echo esc_url($author_avatar_url); ?>" width="<?php echo $avatar_size; ?>" height="<?php echo $avatar_size; ?>" layout="fixed"></amp-img> 
    <?php }
    elseif ( $avatar && false == ampforwp_gravatar_checker($post_author->user_email ) ) {
    	$avatar_img = get_avatar( $post_author->user_email, $avatar_size );
    	$amp_html_sanitizer = new AMPFORWP_Content( $avatar_img, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array() ) ) );
	    $amp_html =  $amp_html_sanitizer->get_amp_content();
		echo $amp_html;
     } 
	 
}