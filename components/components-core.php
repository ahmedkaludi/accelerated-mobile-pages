<?php
use AMPforWP\AMPVendor\AMP_Post_Template;
use AMPforWP\AMPVendor\AMP_HTML_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
$ampforwpTemplate = '';
$loadComponent = array();
$scriptComponent = array();
$search_found = false;
$supportComponent = array('AMP-search','AMP-menu','AMP-alter-menu','AMP-logo','AMP-social-icons','AMP-sidebar','AMP-featured-image','AMP-author-box','AMP-loop','AMP-categories-tags','AMP-comments','AMP-post-navigation','AMP-related-posts','AMP-post-pagination','AMP-call-now', 'AMP-breadcrumb','AMP-gdpr', 'AMP-google-font', 'AMP-google-font');

add_filter( 'amp_post_template_data', 'ampforwp_framework_add_and_form_scripts',20);
function ampforwp_framework_add_and_form_scripts($data) {
	global $scriptComponent, $loadComponent; 
	
	if(count($scriptComponent)>0){
		foreach ($scriptComponent as $key => $value) {
			if ( empty( $data['amp_component_scripts'][$key] ) ) {
				$data['amp_component_scripts'][$key] = $value;
			}
		}
	}
	return $data;
}

//Component Loader
function add_amp_theme_support($componentName){
	global $wpdb;
	global $loadComponent,$supportComponent;
	if($supportComponent){
		if(in_array($componentName, $supportComponent)){
			$loadComponent[$componentName] = true;
			ampforwp_loadComponents($componentName);
			return true;
		}
	}
	return false;
}
//Include the Component file
function ampforwp_loadComponents($componentName){
	global $wpdb;
	if(empty($componentName)) return '';
	$componentName = str_replace("AMP-", "", $componentName);

	$file = AMP_FRAMEWORK_COMOPNENT_DIR_PATH.'/'.esc_attr($componentName).'/'.esc_attr($componentName).".php";
	if(!file_exists($file)){
		return '';
	}
	include_once( esc_attr($file));
}

// Icons
$amp_icons_css = array();
function add_amp_icon($args=array()){
	global $amp_icons_css, $redux_builder_amp;
	$amp_icons_css_array = include AMPFORWP_PLUGIN_DIR .'includes/icons/amp-icons.php';
	foreach ($args as $key ) {
		if(isset($amp_icons_css_array[$key]))
			$amp_icons_css[$key] = $amp_icons_css_array[$key]; 
	}
	// Design-1,2,3
	if ( 1 == $redux_builder_amp['amp-design-selector'] || 2 == $redux_builder_amp['amp-design-selector'] || 3 == $redux_builder_amp['amp-design-selector'] ) {
		add_action('amp_post_template_css', 'amp_icon_css',999);

	}
	else
		add_action('amp_css', 'amp_icon_css');  
	
}
function amp_icon_css(){
	global $amp_icons_css, $redux_builder_amp;
	foreach ($amp_icons_css as $key => $value) {
		// TODO: https://github.com/ahmedkaludi/accelerated-mobile-pages/issues/2651 
	    echo $value;
	}

	// Add @font-face for Design-1,2,3
	if ( 1 == $redux_builder_amp['amp-design-selector'] || 2 == $redux_builder_amp['amp-design-selector'] || 3 == $redux_builder_amp['amp-design-selector'] ) { ?>
		@font-face {font-family: 'icomoon';font-style: normal;font-weight: normal;font-display: swap;src:  local('icomoon'), local('icomoon'), url('<?php echo esc_url(plugin_dir_url(__FILE__)) ?>icomoon/icomoon.ttf');}
		[class^="icon-"], [class*=" icon-"] {font-family: 'icomoon';speak: none;font-style: normal;font-weight: normal;font-variant: normal;text-transform: none;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
	<?php }
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
	if( ampforwp_is_front_page() && ampforwp_get_frontpage_id() ){
		if( $redux_builder_amp['ampforwp-title-on-front-page'] ) {
			$ID = ampforwp_get_frontpage_id();
		}
	}
	elseif ( ampforwp_polylang_front_page() ) {
		$ID = pll_get_post(get_option('page_on_front'));
	}
	else
		$ID = $post->ID;
	if( $ID!=null ){
		do_action('ampforwp_above_the_title'); 
		$ampforwp_title = get_the_title($ID);
		$ampforwp_title =  apply_filters('ampforwp_filter_single_title', $ampforwp_title);
		if(!empty($ampforwp_title) && ampforwp_default_logo()){
		?>
			<h1 class="amp-post-title"><?php echo wp_kses_data( $ampforwp_title ); ?></h1>
		<?php
		}else{?>
			<h2 class="amp-post-title"><?php echo wp_kses_data( $ampforwp_title ); ?></h2>
		<?php }
		do_action('ampforwp_below_the_title');
    }
}

// Excerpt
function amp_excerpt( $no_of_words=15 ) {
	global $redux_builder_amp, $post;
	$post_id = '';
	$no_of_words = (int) $no_of_words;

	if ( ampforwp_is_front_page() ) {
		$post_id = ampforwp_get_frontpage_id();
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
			/* `wp_trim_words` will strip all the tags 
			   as it has `wp_strip_all_tags` inside to clean */
			echo wp_trim_words( strip_shortcodes( $content ) , $no_of_words );  
		?></p><?php
    }
}


//Menus
function amp_menu($echo=true, $menu_args=array(), $type='header'){
	if ( ($type == 'header' && ! has_nav_menu( 'amp-menu' )) || ( 'footer' == $type && ! has_nav_menu( 'amp-footer-menu' ) ) ) {
		return false;
	}
	global $loadComponent;
	if(isset($loadComponent['AMP-menu']) && $loadComponent['AMP-menu']==true){
		if ( false != get_transient('ampforwp_header_menu') && 'header' == $type ){
			$amp_menu = get_transient('ampforwp_header_menu');
		}
		elseif (false != get_transient('ampforwp_footer_menu') && 'footer' == $type) {
			$amp_menu = get_transient('ampforwp_footer_menu');
		}
		else{
			$amp_menu = amp_menu_html($echo, $menu_args, $type);
		}
		if ( false == $echo ) {
			return $amp_menu;
		}
		else
			echo $amp_menu; // escaped above
	}
}
// Alternative Menus
function amp_alter_menu($echo=true){
	global $loadComponent;
	if ( ! has_nav_menu('amp-alternative-menu') ) {
		return false;
	}
	if(isset($loadComponent['AMP-alter-menu']) && $loadComponent['AMP-alter-menu']==true){
		if ( false == $echo ) {
			return amp_menu_html($echo, array(),'amp-alternative-menu');
		}
		else
			echo amp_menu_html($echo, array(), 'amp-alternative-menu');
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
function amp_categories_list( $separator = '' ){
	global $loadComponent;
	if(isset($loadComponent['AMP-categories-tags']) && $loadComponent['AMP-categories-tags']==true){
		ampforwp_framework_get_categories_list( $separator );
	}
}
// Tags List
function amp_tags_list( $separator = '' ){
	global $loadComponent;
	if(isset($loadComponent['AMP-categories-tags']) && $loadComponent['AMP-categories-tags']==true){
		ampforwp_framework_get_tags_list( $separator );
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
		echo ampforwp_framework_get_post_navigation();
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

// Breadcrumb
function amp_breadcrumb(){
	global $loadComponent;
	if ( isset($loadComponent['AMP-breadcrumb']) && true == $loadComponent['AMP-breadcrumb'] ) {
		echo amp_breadcrumb_output();
	}
}

// GDPR component 
function amp_gdpr(){
	global $loadComponent;
	if ( isset($loadComponent['AMP-gdpr']) && true == $loadComponent['AMP-gdpr'] ) {
		echo amp_gdpr_output();
	}
}

//Get Core of AMP HTML
function amp_header_core(){
	global $ampforwpTemplate;
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = $ampforwpTemplate;
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

    add_action('amp_post_template_head','ampforwp_sanitize_archive_desc');
	function ampforwp_sanitize_archive_desc(){
	    $description 	= get_the_archive_description();
	    if ($description) {
	    	$sanitizer = new AMPFORWP_Content( $description, array(), 
				apply_filters( 'ampforwp_content_sanitizers',
					array( 
						'AMP_Style_Sanitizer' 		=> array(),
						'AMP_Blacklist_Sanitizer' 	=> array(),
						'AMP_Img_Sanitizer' 		=> array(),
						'AMP_Video_Sanitizer' 		=> array(),
						'AMP_Audio_Sanitizer' 		=> array(),
						'AMP_Iframe_Sanitizer' 		=> array(
							'add_placeholder' 		=> true,
						)
					) ) ); 
			    		
					$amp_component_scripts = $sanitizer->amp_scripts;
			    	
				if ( $sanitizer && $amp_component_scripts) {	
					foreach ($amp_component_scripts as $ampforwp_service => $ampforwp_js_file) { ?>
						<script custom-element="<?php echo esc_attr($ampforwp_service); ?>"  src="<?php echo esc_url($ampforwp_js_file); ?>" async></script> <?php
					}
				}   
		}
	}
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
	<html <?php echo esc_attr(ampforwp_amp_nonamp_convert('amp ')); ?><?php echo AMP_HTML_Utils::build_attributes_string( $thisTemplate->get( 'html_tag_attributes' ) ); ?>>
		<head>
		<meta charset="utf-8"> 
			<?php do_action('amp_experiment_meta', $thisTemplate); ?>
		    <link rel="dns-prefetch" href="//cdn.ampproject.org">
		    <?php do_action( 'amp_meta', $thisTemplate ); ?>
		    <?php 
		    	if(ampforwp_amp_nonamp_convert("", "check")){
		    		echo '<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=2,user-scalable=yes">';
		    		wp_head();

		    	}else{
		    		if(is_search() && false == ampforwp_get_setting('amp-inspection-tool') && false == ampforwp_get_setting('ampforwp-robots-search-pages')){?>
		    			<meta name="robots" content="noindex,nofollow"/>
		    		<?php }
		    		do_action( 'amp_post_template_head', $thisTemplate );
		    	} ?>		
			<style amp-custom>
				<?php $thisTemplate->load_parts( array( 'style' ) ); ?>
				<?php do_action( 'amp_post_template_css', $thisTemplate ); ?>
				<?php do_action( 'amp_css', $thisTemplate ); ?>
				<?php $custom_css = ampforwp_get_setting('css_editor');
					  $custom_css = str_replace(array('.accordion-mod'), array('.apac'), $custom_css);
					  $sanitized_css = ampforwp_sanitize_i_amphtml($custom_css);
					  echo $sanitized_css; // sanitized above ?>
			</style>
			<?php do_action('ampforwp_before_head', $thisTemplate);  ?>
		</head>
		<body <?php ampforwp_body_class($bodyClass); ?>>
		<?php do_action('amp_start', $thisTemplate); ?>
		<?php do_action('ampforwp_body_beginning', $thisTemplate);  
}

function amp_header(){
	global $ampforwpTemplate;
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = $ampforwpTemplate;
	$thisTemplate->load_parts( array( 'header' ) ); 
	do_action( 'amp_after_header', $thisTemplate );
	do_action( 'ampforwp_after_header', $thisTemplate );
 	do_action('ampforwp_post_before_design_elements') ?>
<?php } 

function amp_footer(){
	global $ampforwpTemplate;
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = $ampforwpTemplate;		
	do_action( 'amp_before_footer', $thisTemplate );
	do_action( 'amp_post_template_above_footer', $thisTemplate );

	$thisTemplate->load_parts( array( 'footer' ) );

}

function amp_footer_core(){
	global $ampforwpTemplate;
	$post_id = get_queried_object_id();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = $ampforwpTemplate;
	if(ampforwp_amp_nonamp_convert("", "check")){
		wp_footer();
	}
	else {
		do_action( 'amp_post_template_footer', $thisTemplate );
		do_action('ampforwp_global_after_footer');
		do_action('amp_end',$thisTemplate);
	}
	amp_back_to_top_link();
	// Close the body and Html tags ?>
	</body>
		</html><?php
}

function amp_non_amp_link(){
	$allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>'; 
    global $redux_builder_amp;
    echo '<span>' . strip_tags(ampforwp_translation($redux_builder_amp['amp-translator-footer-text'],'All Rights Reserved'),$allowed_tags) . '</span>' ;
    if($redux_builder_amp['amp-footer-link-non-amp-page']=='1') { ampforwp_view_nonamp(); }
}

// Back to Top
function amp_back_to_top_link(){
	 global $redux_builder_amp;
    if(true == ampforwp_get_setting('ampforwp-footer-top')){?>
        <a id="scrollToTopButton" title="back to top" on="tap:backtotop.scrollTo(duration=500)" class="btt" ></a> 
        <?php if(ampforwp_get_setting('ampforwp-amp-convert-to-wp')==false){?>
        <amp-animation id="showAnim"
		  layout="nodisplay">
		  <script type="application/json">
		    {
		      "duration": "400ms",
		      "fill": "both",
		      "iterations": "1",
		      "direction": "alternate",
		      "animations": [{
		        "selector": "#scrollToTopButton",
		        "keyframes": [{
		          "opacity": "1",
		          "visibility": "visible"
		        }]
		      }]
		    }
		  </script>
		</amp-animation>
		<amp-animation id="hideAnim"
		  layout="nodisplay">
		  <script type="application/json">
		    {
		      "duration": "400ms",
		      "fill": "both",
		      "iterations": "1",
		      "direction": "alternate",
		      "animations": [{
		        "selector": "#scrollToTopButton",
		        "keyframes": [{
		          "opacity": "0",
		          "visibility": "hidden"
		        }]
		      }]
		    }
		  </script>
		</amp-animation>
	<?php }else if(ampforwp_get_setting('ampforwp-amp-convert-to-wp')==true){?>
      	<script>
      		var elem = document.getElementById('scrollToTopButton');
      		elem.addEventListener("click", function(){
      			window.scrollTo({
				  top: 0,
				  behavior: 'smooth'
				});
      		});
      	</script>
      	<?php
      }
    }
}

function amp_loop_template(){
	global $ampforwpTemplate;
	$post_id = get_queried_object_id();
	$thisTemplate = $ampforwpTemplate;
	do_action('amp_before_loop',$thisTemplate);
	$thisTemplate->load_parts( array( 'loop' ) );
	do_action('amp_after_loop',$thisTemplate);
}

// The Content
function amp_content($post_id= ''){ 
	global $redux_builder_amp, $post, $ampforwpTemplate;

	if ( empty( $post_id )) {
		$post_id = get_queried_object_id();
		if ( ampforwp_is_front_page() ) {
			$post_id = ampforwp_get_frontpage_id();
		}
		elseif ( ampforwp_polylang_front_page() ) {
			$post_id = pll_get_post(get_option('page_on_front'));
		}
	}

	$thisTemplate = $ampforwpTemplate;
	 if ( 1 == ampforwp_get_setting('amp-design-selector')  ) {
		do_action('ampforwp_inside_post_content_before',$thisTemplate); 
	}
	else{
		do_action('ampforwp_before_post_content',$thisTemplate);
	}
	$amp_custom_content_enable = get_post_meta( $thisTemplate->get( 'post_id' ) , 'ampforwp_custom_content_editor_checkbox', true);
	// Normal Content
	if ( ! $amp_custom_content_enable ) {
			$ampforwp_the_content = $thisTemplate->get( 'post_amp_content' ); // amphtml content; no kses
		} else {
			// Custom/Alternative AMP content added through post meta  
			$ampforwp_the_content = $thisTemplate->get( 'ampforwp_amp_content' );
		} 
	// Muffin Builder Compatibility #1455 #1893
	if ( function_exists('mfn_builder_print') && ! $amp_custom_content_enable ) {
		ob_start();
	  	mfn_builder_print( $thisTemplate->get( 'post_id' ) );
		$content = ob_get_contents();
		ob_end_clean();
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
	 	if ( ! get_post_meta( $post_id, 'mfn-post-hide-content', true ) && ampforwp_is_front_page() ) {
	 		$ampforwp_custom_amp_editor_content = '';
			$ampforwp_custom_amp_editor_content = $ampforwp_the_content;
	 		$ampforwp_the_content =  $sanitizer_obj->get_amp_content();
	 		$ampforwp_the_content .=  $ampforwp_custom_amp_editor_content;		      
		}
		else{
			$ampforwp_the_content =  $sanitizer_obj->get_amp_content();
		}		
	}
	if(function_exists('ampforwp_sassy_share_icons')){
		$ampforwp_the_content = ampforwp_sassy_share_icons($ampforwp_the_content);
	}
	$ampforwp_the_content = apply_filters('ampforwp_modify_the_content',$ampforwp_the_content);
	echo $ampforwp_the_content; // amphtml content, no kses
	do_action('ampforwp_after_post_content',$thisTemplate); 
}

function amp_date( $args=array() ) {
    if ( 2 == ampforwp_get_setting('ampforwp-post-date-format') ) {
    	$args = array('format' => 'traditional');
    }
    if ( true == ampforwp_get_setting('ampforwp-post-time') && (isset($args['format']) && $args['format'] == 'traditional') && 2 == ampforwp_get_setting('ampforwp-post-date-global') ) {
      	$post_date =  get_the_modified_date( get_option( 'date_format' )). ' '. get_the_modified_time();
    }
    elseif ( false == ampforwp_get_setting('ampforwp-post-time') && (isset($args['format']) && $args['format'] == 'traditional') && 2 == ampforwp_get_setting('ampforwp-post-date-global') ){
    	 $post_date =  get_the_modified_date( get_option( 'date_format' ));
    }
    elseif ( true == ampforwp_get_setting('ampforwp-post-time') && (isset($args['format']) && $args['format'] == 'traditional') || 'time' == $args ){
    	 $post_date =  get_the_date(). ' '. get_the_time();
    }
    elseif ( false == ampforwp_get_setting('ampforwp-post-time') ){
    	 $post_date =  get_the_date();
    }else{
    	$epoch = get_the_time('U', get_the_ID() );
        $post_date = human_time_diff(
                    get_the_time('U', get_the_ID() ), 
                    current_time('timestamp') ) .' '. ampforwp_translation(ampforwp_get_setting('amp-translator-ago-date-text'),
                    'ago');
    }
    $post_date = apply_filters('ampforwp_modify_post_date', $post_date);

   	if(isset($args['custom_format']) && $args['custom_format']!=""){
	    $post_date = date($args['custom_format'],get_the_time('U', get_the_ID() ));
	}
    if ( 'date' == $args || 'time' == $args ) {
        echo esc_html( $post_date ) .' ';
    }
    else
    echo '<div class="loop-date">'.esc_html( $post_date ).'</div>';
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
		echo ' <a href="'. ampforwp_url_controller($author_link).'"> ' .esc_html( $post_author->display_name ).'</a>';
 	}
 	if ( $avatar && true == ampforwp_gravatar_checker($post_author->user_email) ) {
		$author_avatar_url = get_avatar_url( $post_author->ID, array( 'size' => $avatar_size ) );
            ?>
        <amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo esc_url($author_avatar_url); ?>" width="<?php echo esc_attr($avatar_size); ?>" height="<?php echo esc_attr($avatar_size); ?>" layout="fixed"></amp-img> 
    <?php }
    elseif ( $avatar && false == ampforwp_gravatar_checker($post_author->user_email ) ) {
    	$avatar_img = get_avatar( $post_author->user_email, $avatar_size );
    	$amp_html_sanitizer = new AMPFORWP_Content( $avatar_img, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array() ) ) );
	    $amp_html =  $amp_html_sanitizer->get_amp_content();
		echo $amp_html; // amphtml content, no kses
     } 
	 
}

// amp-animation CSS #2819
add_action('amp_post_template_css','ampforwp_backtotop_global_css');
function ampforwp_backtotop_global_css(){?>
	amp-img.amp-wp-enforced-sizes[layout=intrinsic] > img, .amp-wp-unknown-size > img { object-fit: contain; }
	.rtl amp-carousel {direction: ltr;}
	.rtl .amp-menu .toggle:after{left:0;right:unset;}
	.sharedaddy li{display:none}
<?php if( true == ampforwp_get_setting('ampforwp-footer-top') ) { ?>
  .btt{
      position: fixed;
      <?php if( (is_single() && ampforwp_get_setting('enable-single-social-icons')) || (is_page() && true == ampforwp_get_setting('ampforwp-page-sticky-social')) ){ ?>
      bottom: 55px;
      <?php } else { ?>
        bottom: 20px;
      <?php } ?>
      right: 20px;
      background: rgba(71, 71, 71, 0.5);
      color: #fff;
      border-radius: 100%;
      width: 50px;
      height: 50px;
  }
  .btt:hover{color:#fff;background:#474747;}
  .btt:before{
    content: '\25be';
    display: block;
    font-size: 35px;
    font-weight: 600;
    color: #fff;
    transform: rotate(180deg);
    text-align: center;
    line-height: 1.5;
  }
<?php } }

// Fallback for amp_call_now #2782
if ( !function_exists('amp_call_now') ) {
	function amp_call_now(){
		ampforwp_call_button_html_output();
	}
}
// AddThis Support #2416
function ampforwp_addThis_support(){
	$data_pub_id = ampforwp_get_setting('add-this-pub-id');
	$data_widget_id = ampforwp_get_setting('add-this-widget-id');
	$addthisWidth = '';
	$amp_addthis = '';
	if ( ( is_single() || (is_page() && ampforwp_get_setting('ampforwp-page-social')) ) && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) {
	 	if( ampforwp_get_setting('enable-add-this-option') ) {
	
	 		if( 4 == ampforwp_get_setting('amp-design-selector') && 'default' ==  ampforwp_get_setting('swift-add-this-position') ){
	 			$addthisWidth = 290; 
	 		}
	 		else{
				$addthisWidth = 320; 
			}
			if( ampforwp_get_setting('addthis-inline-share') == true){
				$amp_addthis .= '<amp-addthis width="'.$addthisWidth.'" height="92" data-pub-id="'.esc_attr($data_pub_id).'" data-widget-id="'. esc_attr($data_widget_id).'"></amp-addthis>';
			}

			do_action('ampforwp_before_social_icons_hook');
			return $amp_addthis;
			do_action('ampforwp_after_social_icons_hook');
		}
	}
}

add_action('amp_post_template_footer','ampforwp_addthis_floating_social_share');
function ampforwp_addthis_floating_social_share(){
	$data_pub_id = ampforwp_get_setting('add-this-pub-id');
	$data_widget_id = ampforwp_get_setting('add-this-widget-id');
	if ( ( is_single() || (is_page() && ampforwp_get_setting('ampforwp-page-social')) ) && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) {
	 	if( ampforwp_get_setting('enable-add-this-option') ) {
			if( ampforwp_get_setting('addthis-floating-share') == true ){
				echo '<amp-addthis width="320" height="92" data-pub-id="'.esc_attr($data_pub_id).'" data-widget-id="'. esc_attr($data_widget_id).'" data-widget-type="floating"></amp-addthis>';
			}
		}
	}
}