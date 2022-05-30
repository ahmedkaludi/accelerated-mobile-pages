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
	$icon_url = plugin_dir_url(__FILE__);
    $icon_url = ampforwp_font_url($icon_url);
	// Add @font-face for Design-1,2,3
	if ( 1 == $redux_builder_amp['amp-design-selector'] || 2 == $redux_builder_amp['amp-design-selector'] || 3 == $redux_builder_amp['amp-design-selector'] ) { ?>
		@font-face {font-family: 'icomoon';font-style: normal;font-weight: normal;font-display: swap;src:  local('icomoon'), local('icomoon'), url('<?php echo esc_url($icon_url) ?>icomoon/icomoon.ttf');}
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
	global $post;
	$ID = ampforwp_get_the_ID();
	if ( ampforwp_polylang_front_page() ) {
		$ID = pll_get_post(get_option('page_on_front'));
	}
	elseif( ampforwp_is_front_page() && ampforwp_get_setting('ampforwp-title-on-front-page') == false) {
			$ID = null;
		}
	if( $ID!=null ){
		do_action('ampforwp_above_the_title'); 
		$ampforwp_title = get_the_title($ID);
		$ampforwp_title =  apply_filters('ampforwp_filter_single_title', $ampforwp_title);
		if(!empty($ampforwp_title) && ampforwp_default_logo() && ampforwp_get_setting('opt-media','url')!=''){
			$title_tag = '<h1 class="amp-post-title">' . wp_kses_data( $ampforwp_title ) . '</h1>'; 
		}else{ 
			$title_tag = '<h2 class="amp-post-title">' . wp_kses_data( $ampforwp_title ) . '</h2>'; 
		}
		$title_tag = apply_filters('ampforwp_modify_title_tag',$title_tag,$ampforwp_title);
		echo $title_tag; // Escaped above 
		do_action('ampforwp_below_the_title');
    }
}

// Excerpt
function amp_excerpt( $no_of_words=260 ) {
	global $post;
	$post_id = $content = '';
	$no_of_words = (int) $no_of_words;
	$post_id = ampforwp_get_the_ID();
	if ( $post_id != null && true == ampforwp_get_setting('enable-excerpt-single') ) { ?>
		<p><?php 
			 if ( has_excerpt() ) {
				$content = get_the_excerpt();
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
		$amp_menu = "";
		$header_menu = get_transient('ampforwp_header_menu');
		$footer_menu = get_transient('ampforwp_footer_menu');
		if ( 'header' == $type && false != $header_menu ){
 			$amp_menu = $header_menu;
		}
		elseif ('footer' == $type && false != $footer_menu) {
			$amp_menu = $footer_menu;
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
	$gdpr = apply_filters('ampforwp_on_off_gdpr', true);
	if ( isset($loadComponent['AMP-gdpr']) && true == $loadComponent['AMP-gdpr'] && $gdpr) {
		echo amp_gdpr_output();
	}
}

//Get Core of AMP HTML
function amp_header_core(){
	global $ampforwpTemplate;
	$post_id = ampforwp_get_the_ID();
	if ( ampforwp_polylang_front_page() ) {
		$post_id = pll_get_post(get_option('page_on_front'));
	}
	$thisTemplate = $ampforwpTemplate;
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
   if ( !function_exists('ampforwp_sanitize_archive_desc') ) {
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
	}
    // Homepage
	if ( is_home() ) {
		
    	$bodyClass = 'amp-index amp-home'.esc_attr( $thisTemplate->get( 'body_class' ) ); 
    	if (ampforwp_get_setting('amp-frontpage-select-option') == 1) {
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
     if( true == ampforwp_get_setting('amp-rtl-select-option') ){
    	$bodyClass .= ' rtl ';
    }
    $lightbox = '';
    if( false == ampforwp_get_setting('ampforwp-amp-img-lightbox') ){
    	$lightbox = 'data-amp-auto-lightbox-disable';
    }
	?><!doctype html>
	<html <?php echo esc_attr(ampforwp_amp_nonamp_convert('amp ')); ?><?php echo AMP_HTML_Utils::build_attributes_string( $thisTemplate->get( 'html_tag_attributes' ) ); ?>>
		<head>
		<meta charset="utf-8"> 
			<?php do_action('amp_experiment_meta', $thisTemplate); ?>
		    <link rel="preconnect" href="//cdn.ampproject.org">
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
				if (function_exists('heateor_sss_run') && ampforwp_get_setting('ampforwp_css_tree_shaking') ) {
					  global $wp_filesystem;
					  if(!is_object($wp_filesystem)){
							require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
			    			require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
			    			$wp_filesystem = new WP_Filesystem_Direct( array() );
		    			}
					  $custom_css .= $wp_filesystem->get_contents(AMPFORWP_PLUGIN_DIR."/includes/sassy-style-optimized.css");
					}
					  $custom_css = str_replace(array('.accordion-mod'), array('.apac'), $custom_css);
					  $sanitized_css = ampforwp_sanitize_i_amphtml($custom_css);
					  echo $sanitized_css; // sanitized above ?>
			</style>
			<?php do_action('ampforwp_before_head', $thisTemplate);  ?>
		</head>
		<body <?php echo esc_attr($lightbox); ?> <?php ampforwp_body_class($bodyClass); ?>>
		<?php do_action('amp_start', $thisTemplate); ?>
		<?php do_action('ampforwp_admin_menu_bar_front'); ?>
		<?php do_action('ampforwp_body_beginning', $thisTemplate);  
}

function amp_header(){
	global $ampforwpTemplate;
	$post_id = ampforwp_get_the_ID();
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
	$post_id = ampforwp_get_the_ID();
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
	$post_id = ampforwp_get_the_ID();
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
	// Close the body and Html tags ?>
	</body>
		</html><?php
}

function amp_non_amp_link(){
	$allowed_tags = '<p><a><b><strong><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><table><tr><th><td><em><span>'; 
    if (function_exists('pll__')) {
		echo '<span>' . strip_tags(pll__(ampforwp_get_setting('amp-translator-footer-text'),'All Rights Reserved'),$allowed_tags) . '</span>';
	}else {
		echo '<span>' . strip_tags(ampforwp_translation(do_shortcode(ampforwp_get_setting('amp-translator-footer-text')),'All Rights Reserved'),$allowed_tags) . '</span>';
	}
    if(ampforwp_get_setting('amp-footer-link-non-amp-page')=='1') { ampforwp_view_nonamp(); }
}

// Back to Top
function amp_back_to_top_link(){
    if(true == ampforwp_get_setting('ampforwp-footer-top')){?>
        <a id="scrollToTopButton" title="back to top" on="tap:backtotop.scrollTo(duration=500)" class="btt" href="#" ></a>
        <?php 
        if(ampforwp_get_setting('ampforwp-amp-convert-to-wp') == true){?>
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
		$post_id = ampforwp_get_the_ID();
		if ( ampforwp_polylang_front_page() ) { 
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
	$ampforwp_pb = get_post_meta(ampforwp_get_the_ID(),'ampforwp_page_builder_enable', true);	
	// Muffin Builder Compatibility #1455 #1893 #4983
	if ( isset($ampforwp_pb) && $ampforwp_pb != "yes" && class_exists('Mfn_Builder_Front') && ! $amp_custom_content_enable ) {
		$mfn_page = get_post_field( 'mfn-page-items-seo', ampforwp_get_the_ID());
		if (!empty($mfn_page)) {
		$mfn_builder = $content = '';
		$mfn_builder = new Mfn_Builder_Front(ampforwp_get_the_ID());
		if (! empty($mfn_builder) ) {
			$content = $mfn_builder->show();
		}
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
		if( true === ampforwp_get_setting('amp-rtl-select-option') ){ ?>
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
	.amp-wp-content table , .cntn-wrp.artl-cnt table{height: auto;}
	amp-img.amp-wp-enforced-sizes[layout=intrinsic] > img, .amp-wp-unknown-size > img { object-fit: contain; }
	.rtl amp-carousel {direction: ltr;}
	.rtl .amp-menu .toggle:after{left:0;right:unset;}
	.sharedaddy li{display:none}
	sub {vertical-align: sub;font-size: small;}
	sup {vertical-align: super;font-size: small;}
	amp-call-tracking a {display: none;}
	@media only screen and (max-width: 480px) {
	svg {max-width: 250px;max-height: 250px;}
	}
	h2.amp-post-title {
    word-break: break-word;
    word-wrap: break-word;
	}
	<?php if (function_exists('wp_pagenavi')) {?>
	  .wp-pagenavi {
	      border: 1px solid #BFBFBF;
	      padding: 10px;
	  }
	  .wp-pagenavi span.pages {
	      margin-right: 10px;
	  }
	  .wp-pagenavi a.previouspostslink {
	      margin-left: 20px;
	  }
	  .wp-pagenavi a.page.smaller, .wp-pagenavi a.page.larger, .wp-pagenavi span.current
	  {
	      padding: 0 5px;
	  }
	  .wp-pagenavi span.extend {
	      display: none;
	  }
	  .wp-pagenavi a.last , .amp-archive a.first {
	      margin-left: 10px;
	  }
  <?php } ?> 
  <?php if (true == ampforwp_get_setting('ampforwp-right-click-disable')) {?>
    	.*{
		-moz-user-select:none;
		-webkit-user-select:none;
		cursor: default;
		}
		html{
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		-webkit-tap-highlight-color: rgba(0,0,0,0);
		}
    <?php } ?> 
	<?php if (class_exists('UAGB_Admin')) {?>
	.wp-block-uagb-faq svg {display: none;}
	<?php } ?>
	<?php if (function_exists('on_bsf_aiosrs_pro_activate')) {?>
	  span.wpsp-icon.wpsp-faq-icon-wrap svg , span.wpsp-icon-active.wpsp-faq-icon-wrap svg{
	    display: none;}
  <?php } ?>
	<?php if (class_exists('Jetpack_Gallery_Settings')) {?>
	.wp-block-jetpack-slideshow_container.swiper-container amp-selector {
    	display: none;
	}
	.wp-block-jetpack-slideshow_slide.amp-carousel-slide {
	    height: auto;
	    margin-bottom: 20px;
	}
	<?php } ?>
	<?php if (function_exists('generateblocks_load_plugin_textdomain')) {?>
	.gb-container .wp-block-image img{vertical-align:middle;}.gb-container .gb-shape{position:absolute;overflow:hidden;pointer-events:none;line-height:0;}.gb-container .gb-shape svg{fill:currentColor;}.gb-container-cc6b793f{background-color:var(--contrast-3);position:relative;overflow:hidden;}.gb-container-cc6b793f:before{content:"";background-image:url(https://testing.digitalsquare.be/wp-content/uploads/2021/01/kanwardeep-kaur-HjfkPgfg0XY-unsplash-1-min.jpg);background-repeat:no-repeat;background-position:30% center;background-size:cover;z-index:0;position:absolute;top:0;right:0;bottom:0;left:0;transition:inherit;opacity:0.8;}.gb-container-cc6b793f > .gb-inside-container{padding:200px 0 475px;max-width:1440px;margin-left:auto;margin-right:auto;z-index:1;position:relative;}.gb-container-cc6b793f.gb-has-dynamic-bg:before{background-image:var(--background-url);}.gb-container-cc6b793f.gb-no-dynamic-bg:before{background-image:none;}.gb-container-c243e5b5{margin-top:-100px;max-width:1440px;margin-left:auto;margin-right:auto;position:relative;z-index:1;border-style: solid;border-width:0;}.gb-container-c243e5b5 > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-7eda8503{background-color:var(--base-3);border-bottom-style: solid;border-bottom-width:5px;border-left-style: solid;border-left-width:5px;border-color:var(--accent);}.gb-container-7eda8503 > .gb-inside-container{padding:60px;}.gb-grid-wrapper > .gb-grid-column-7eda8503{width:50%;}.gb-container-d910fc66{border-radius:0;border-style: solid;border-width:0;}.gb-container-d910fc66 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-d910fc66{width:25%;}.gb-container-575f7b5e > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-575f7b5e{width:75%;}.gb-container-90ba54e2 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-90ba54e2{width:100%;}.gb-container-37100832{background-color:var(--contrast);color:var(--base-3);position:relative;overflow:hidden;}.gb-container-37100832:before{content:"";background-image:url(https://testing.digitalsquare.be/wp-content/uploads/2021/01/briana-tozour-3ao0ld_ude0-unsplash-1-min.jpg);background-repeat:no-repeat;background-position:center center;background-size:cover;z-index:0;position:absolute;top:0;right:0;bottom:0;left:0;transition:inherit;opacity:0.2;}.gb-container-37100832 > .gb-inside-container{padding:60px;z-index:1;position:relative;}.gb-grid-wrapper > .gb-grid-column-37100832{width:50%;}.gb-container-37100832.gb-has-dynamic-bg:before{background-image:var(--background-url);}.gb-container-37100832.gb-no-dynamic-bg:before{background-image:none;}.gb-container-5cbbf9a2{margin-top:150px;}.gb-container-5cbbf9a2 > .gb-inside-container{padding:0 40px 40px 0;max-width:1440px;margin-left:auto;margin-right:auto;z-index:4;position:relative;}.gb-container-c6220c51{color:var(--base-3);}.gb-container-c6220c51 > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-c6220c51 a, .gb-container-c6220c51 a:visited{color:var(--base-3);}.gb-container-c6220c51 a:hover{color:var(--accent);}.gb-container-119df869{background-color:var(--contrast);position:relative;overflow:hidden;border-radius:0;border-right-style: solid;border-right-width:1px;border-left-style: solid;border-left-width:0;border-color:var(--accent);}.gb-container-119df869:before{content:"";background-image:url(https://testing.digitalsquare.be/wp-content/uploads/2021/01/brigitte-tohm-yRH0JI2S2KA-unsplash-min-scaled-1.jpg);background-repeat:no-repeat;background-position:center center;background-size:cover;z-index:0;position:absolute;top:0;right:0;bottom:0;left:0;transition:inherit;border-radius:0;opacity:0.4;}.gb-container-119df869 > .gb-inside-container{padding:380px 20px 20px;z-index:1;position:relative;}.gb-grid-wrapper > .gb-grid-column-119df869{width:25%;}.gb-container-119df869.gb-has-dynamic-bg:before{background-image:var(--background-url);}.gb-container-119df869.gb-no-dynamic-bg:before{background-image:none;}.gb-container-016766a3{background-color:var(--contrast);position:relative;overflow:hidden;border-radius:0;border-right-style: solid;border-right-width:1px;border-left-style: solid;border-left-width:1px;border-color:var(--accent);}.gb-container-016766a3:before{content:"";background-image:url(https://testing.digitalsquare.be/wp-content/uploads/2021/01/loverna-journey-5p83zEQlJV0-unsplash-min-scaled-1.jpg);background-repeat:no-repeat;background-position:center center;background-size:cover;z-index:0;position:absolute;top:0;right:0;bottom:0;left:0;transition:inherit;border-radius:0;opacity:0.4;}.gb-container-016766a3 > .gb-inside-container{padding:380px 20px 20px;z-index:1;position:relative;}.gb-grid-wrapper > .gb-grid-column-016766a3{width:25%;}.gb-container-016766a3.gb-has-dynamic-bg:before{background-image:var(--background-url);}.gb-container-016766a3.gb-no-dynamic-bg:before{background-image:none;}.gb-container-9b5246c4{background-color:var(--contrast);position:relative;overflow:hidden;border-radius:0;border-right-style: solid;border-right-width:1px;border-left-style: solid;border-left-width:1px;border-color:var(--accent);}.gb-container-9b5246c4:before{content:"";background-image:url(https://testing.digitalsquare.be/wp-content/uploads/2021/01/alex-loup-UxMUMFgUxos-unsplash-min-scaled-1.jpg);background-repeat:no-repeat;background-position:center center;background-size:cover;z-index:0;position:absolute;top:0;right:0;bottom:0;left:0;transition:inherit;border-radius:0;opacity:0.4;}.gb-container-9b5246c4 > .gb-inside-container{padding:380px 20px 20px;z-index:1;position:relative;}.gb-grid-wrapper > .gb-grid-column-9b5246c4{width:25%;}.gb-container-9b5246c4.gb-has-dynamic-bg:before{background-image:var(--background-url);}.gb-container-9b5246c4.gb-no-dynamic-bg:before{background-image:none;}.gb-container-4b60d420{background-color:var(--contrast);position:relative;overflow:hidden;border-radius:0;border-left-style: solid;border-left-width:1px;border-color:var(--accent);}.gb-container-4b60d420:before{content:"";background-image:url(https://testing.digitalsquare.be/wp-content/uploads/2021/01/kilarov-zaneit-YUiCiMuOdtY-unsplash-min-scaled-1.jpg);background-repeat:no-repeat;background-position:center center;background-size:cover;z-index:0;position:absolute;top:0;right:0;bottom:0;left:0;transition:inherit;border-radius:0;opacity:0.4;}.gb-container-4b60d420 > .gb-inside-container{padding:380px 20px 20px;z-index:1;position:relative;}.gb-grid-wrapper > .gb-grid-column-4b60d420{width:25%;}.gb-container-4b60d420.gb-has-dynamic-bg:before{background-image:var(--background-url);}.gb-container-4b60d420.gb-no-dynamic-bg:before{background-image:none;}.gb-container-7fd6aa2d{margin-top:150px;}.gb-container-7fd6aa2d > .gb-inside-container{padding:0 40px 40px 0;max-width:1440px;margin-left:auto;margin-right:auto;z-index:4;position:relative;}.gb-container-30069074 > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-3e262987{margin-top:150px;max-width:1440px;margin-left:auto;margin-right:auto;color:#ffffff;position:relative;overflow:hidden;border-radius:10px;}.gb-container-3e262987:before{content:"";background-image:url(https://testing.digitalsquare.be/wp-content/uploads/2021/01/wherda-arsianto-KS0WsajSK4E-unsplash-min-scaled-1.jpg);background-repeat:no-repeat;background-position:center center;background-size:cover;z-index:0;position:absolute;top:0;right:0;bottom:0;left:0;transition:inherit;border-radius:10px;}.gb-container-3e262987 > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;z-index:1;position:relative;}.gb-container-3e262987 a, .gb-container-3e262987 a:visited{color:#ffffff;}.gb-container-3e262987.gb-has-dynamic-bg:before{background-image:var(--background-url);}.gb-container-3e262987.gb-no-dynamic-bg:before{background-image:none;}.gb-container-13ee4214{background-color:rgba(0, 0, 0, 0.4);}.gb-container-13ee4214 > .gb-inside-container{padding:100px 0 100px 70px;}.gb-grid-wrapper > .gb-grid-column-13ee4214{width:50%;}.gb-container-cb7831a7{margin-left:-3px;border-left-style: solid;border-left-width:6px;border-color:var(--accent);}.gb-container-cb7831a7 > .gb-inside-container{padding:0 70px 0 0;}.gb-grid-wrapper > .gb-grid-column-cb7831a7{width:50%;}.gb-container-3bdf6c9f{margin-top:150px;}.gb-container-3bdf6c9f > .gb-inside-container{padding:0 40px 40px 0;max-width:1440px;margin-left:auto;margin-right:auto;z-index:4;position:relative;}.gb-container-9b8d79d5 > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-d414f3d6{margin-top:150px;}.gb-container-d414f3d6 > .gb-inside-container{padding:0 40px 40px 0;max-width:1440px;margin-left:auto;margin-right:auto;z-index:4;position:relative;}.gb-container-a1195352{margin-top:50px;background-color:var(--base-2);position:relative;}.gb-container-a1195352 > .gb-inside-container{padding:80px 0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-a1195352 > .gb-shapes .gb-shape-1{color:var(--base-3);left:0;right:0;top:-1px;transform:scaleY(-1);}.gb-container-a1195352 > .gb-shapes .gb-shape-1 svg{height:47px;width:calc(100% + 1.3px);position:relative;left:50%;transform:translateX(-50%);min-width:100%;}.gb-container-68f95b0d{background-color:var(--base-3);border-top-right-radius:20px;border-bottom-left-radius:20px;border-bottom-style: solid;border-bottom-width:10px;border-color:var(--accent);}.gb-container-68f95b0d > .gb-inside-container{padding:30px;}.gb-grid-wrapper > .gb-grid-column-68f95b0d{width:33.33%;}.gb-container-b213d7c9 > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-c373ec39 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-c373ec39{width:25%;}.gb-container-46b8f51d > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-46b8f51d{width:75%;}.gb-container-148d55cb{background-color:var(--base-3);border-top-right-radius:20px;border-bottom-left-radius:20px;border-bottom-style: solid;border-bottom-width:10px;border-color:var(--accent);}.gb-container-148d55cb > .gb-inside-container{padding:30px;}.gb-grid-wrapper > .gb-grid-column-148d55cb{width:33.33%;}.gb-container-571ef50b > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-1f43e011 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-1f43e011{width:25%;}.gb-container-daa4e669 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-daa4e669{width:75%;}.gb-container-a8927d00{background-color:var(--base-3);border-top-right-radius:20px;border-bottom-left-radius:20px;border-bottom-style: solid;border-bottom-width:10px;border-color:var(--accent);}.gb-container-a8927d00 > .gb-inside-container{padding:30px;}.gb-grid-wrapper > .gb-grid-column-a8927d00{width:33.33%;}.gb-container-b38c9489 > .gb-inside-container{padding:0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-a89373cf > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-a89373cf{width:25%;}.gb-container-0f7f37a3 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-0f7f37a3{width:75%;}.gb-container-1e37de14{background-color:var(--contrast-2);}.gb-container-1e37de14 > .gb-inside-container{padding:0 30px;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-1e37de14 a, .gb-container-1e37de14 a:visited{color:var(--base);}.gb-container-1e37de14 a:hover{color:var(--accent);}.gb-container-b3e34c3c > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-b3e34c3c{width:50%;}.gb-container-fcfab6f6 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-fcfab6f6{width:50%;}.gb-container-73cd57e1{background-color:var(--contrast);color:var(--base-3);}.gb-container-73cd57e1 > .gb-inside-container{padding:60px 30px;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-73cd57e1 a, .gb-container-73cd57e1 a:visited{color:var(--base-3);}.gb-container-73cd57e1 a:hover{color:var(--accent);}.gb-container-53cb46e2 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-53cb46e2{width:66.66%;}.gb-container-e1bd60bb{text-align:right;}.gb-container-e1bd60bb > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-e1bd60bb{width:33.33%;}.gb-container-0f87c806{margin-top:60px;border-top-style: solid;border-top-width:1px;border-color:var(--base-3);}.gb-container-0f87c806 > .gb-inside-container{padding:60px 0 0;max-width:1440px;margin-left:auto;margin-right:auto;}.gb-container-e6861bde > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-e6861bde{width:50%;}.gb-container-7c528044 > .gb-inside-container{padding:0;}.gb-grid-wrapper > .gb-grid-column-7c528044{width:50%;}.gb-grid-wrapper{display:flex;flex-wrap:wrap;}.gb-grid-wrapper > .gb-grid-column > .gb-container{display:flex;flex-direction:column;height:100%;}.gb-grid-column{box-sizing:border-box;}.gb-grid-wrapper .wp-block-image{margin-bottom:0;}.gb-grid-wrapper-7e06c8d5 > .gb-grid-column{padding-left:0px;}.gb-grid-wrapper-371c8e31{align-items:center;margin-left:-30px;}.gb-grid-wrapper-371c8e31 > .gb-grid-column{padding-left:30px;padding-bottom:20px;}.gb-grid-wrapper-2208a82e > .gb-grid-column{padding-left:0px;}.gb-grid-wrapper-b244dd7b{align-items:center;}.gb-grid-wrapper-b244dd7b > .gb-grid-column{padding-left:0px;}.gb-grid-wrapper-75aee70c{margin-left:-50px;}.gb-grid-wrapper-75aee70c > .gb-grid-column{padding-left:50px;}.gb-grid-wrapper-5d463c83{align-items:center;margin-left:-30px;}.gb-grid-wrapper-5d463c83 > .gb-grid-column{padding-left:30px;}.gb-grid-wrapper-f33bb32e{align-items:center;margin-left:-30px;}.gb-grid-wrapper-f33bb32e > .gb-grid-column{padding-left:30px;}.gb-grid-wrapper-0e54e814{align-items:center;margin-left:-30px;}.gb-grid-wrapper-0e54e814 > .gb-grid-column{padding-left:30px;}.gb-grid-wrapper-fe2866ee{align-items:center;margin-left:-30px;}.gb-grid-wrapper-fe2866ee > .gb-grid-column{padding-left:30px;}.gb-grid-wrapper-b76f312f{align-items:flex-start;margin-left:-40px;}.gb-grid-wrapper-b76f312f > .gb-grid-column{padding-left:40px;}.gb-grid-wrapper-9cc30ed9{margin-left:-30px;}.gb-grid-wrapper-9cc30ed9 > .gb-grid-column{padding-left:30px;}.gb-icon{display:inline-flex;line-height:0;}.gb-icon svg{height:1em;width:1em;fill:currentColor;}.gb-highlight{background:none;color:unset;}h6.gb-headline-7a2bf4ed{margin-bottom:5px;}p.gb-headline-4a926537{margin-bottom:0;}h2.gb-headline-2305eeb2{text-align:center;text-transform:uppercase;padding-top:17%;margin-bottom:20px;}p.gb-headline-d750c5ec{text-align:center;}h2.gb-headline-12cdc19e{text-align:left;color:var(--base-2);font-size:180px;font-weight:bold;text-transform:capitalize;line-height:0.9em;margin-bottom:5px;}p.gb-headline-469c3887{text-align:right;color:var(--contrast-3);font-size:26px;padding:0 10px;margin-top:-92px;margin-bottom:0;border-right-style: solid;border-right-width:10px;border-color:var(--accent);}p.gb-headline-e9550e29{font-size:17px;margin-bottom:0;}p.gb-headline-535218b9{font-size:17px;margin-bottom:0;}p.gb-headline-f4d34bb3{font-size:17px;margin-bottom:0;}p.gb-headline-c6ac5e85{font-size:17px;margin-bottom:0;}h2.gb-headline-6dde0834{text-align:left;color:var(--base-2);font-size:180px;font-weight:bold;text-transform:capitalize;line-height:0.9em;margin-bottom:5px;}p.gb-headline-da47bd9e{text-align:right;color:var(--contrast-3);font-size:26px;padding:0 10px;margin-top:-92px;margin-bottom:0;border-right-style: solid;border-right-width:10px;border-color:var(--accent);}h2.gb-headline-0fb829d3{text-transform:capitalize;}h2.gb-headline-febd1c35{text-align:right;font-size:180px;margin-bottom:0;}h2.gb-headline-e8c44a0e{text-align:left;color:var(--base-2);font-size:180px;font-weight:bold;text-transform:capitalize;line-height:0.9em;margin-bottom:5px;}p.gb-headline-5beba68e{text-align:right;color:var(--contrast-3);font-size:26px;padding:0 10px;margin-top:-92px;margin-bottom:0;border-right-style: solid;border-right-width:10px;border-color:var(--accent);}h2.gb-headline-22a2d754{text-align:left;color:var(--base-2);font-size:180px;font-weight:bold;text-transform:capitalize;line-height:0.9em;margin-bottom:5px;}p.gb-headline-765dd33c{text-align:right;color:var(--contrast-3);font-size:26px;padding:0 10px;margin-top:-92px;margin-bottom:0;border-right-style: solid;border-right-width:10px;border-color:var(--accent);}h5.gb-headline-cf24c2bc{margin-bottom:0;}h5.gb-headline-5d2b017c{margin-bottom:0;}h5.gb-headline-5d31c3ed{margin-bottom:0;}h5.gb-headline-d1d015b1{margin-bottom:0;}h5.gb-headline-eb08b8c7{margin-bottom:0;}h5.gb-headline-d81c16e6{margin-bottom:0;}p.gb-headline-41582601{padding-right:100px;}p.gb-headline-95746454{margin-bottom:20px;}p.gb-headline-bf8e162e{text-align:right;margin-bottom:0;display:flex;justify-content:flex-end;align-items:center;}p.gb-headline-bf8e162e .gb-icon{padding-top:.1em;padding-right:0.5em;}p.gb-headline-bf8e162e .gb-icon svg{width:1em;height:1em;}p.gb-headline-97c10964{font-size:17px;margin-bottom:0;}.gb-button-wrapper{display:flex;flex-wrap:wrap;align-items:flex-start;justify-content:flex-start;clear:both;}.gb-button-wrapper-b2ef5dc5{margin-bottom:50px;justify-content:center;}.gb-button-wrapper-17b6ddfb{justify-content:flex-end;}.gb-button-wrapper-d060803e{justify-content:flex-end;}.gb-button-wrapper .gb-button{display:inline-flex;align-items:center;justify-content:center;text-align:center;text-decoration:none;transition:.2s background-color ease-in-out, .2s color ease-in-out, .2s border-color ease-in-out, .2s opacity ease-in-out, .2s box-shadow ease-in-out;}.gb-button-wrapper .gb-button .gb-icon{align-items:center;}.gb-button-wrapper a.gb-button-75c71516,.gb-button-wrapper a.gb-button-75c71516:visited{background-color:var(--accent);color:var(--base-3);font-size:17px;padding:8.5px 17px;border-radius:5px;border-style: solid;border-width:0;}.gb-button-wrapper a.gb-button-75c71516:hover,.gb-button-wrapper a.gb-button-75c71516:active,.gb-button-wrapper a.gb-button-75c71516:focus{background-color:var(--accent-2);}.gb-button-wrapper a.gb-button-871dac18,.gb-button-wrapper a.gb-button-871dac18:visited{background-color:#ffffff;color:#4e4e4e;font-size:15px;padding:15px 20px;border-radius:5px;border-style: solid;border-width:0;}.gb-button-wrapper a.gb-button-871dac18:hover,.gb-button-wrapper a.gb-button-871dac18:active,.gb-button-wrapper a.gb-button-871dac18:focus{background-color:#4d4d4d;color:#ffffff;}.gb-button-wrapper a.gb-button-54543b97,.gb-button-wrapper a.gb-button-54543b97:visited{padding:15px 8px;display:inline-flex;align-items:center;}a.gb-button-54543b97 .gb-icon{font-size:1em;}.gb-button-wrapper a.gb-button-4e922aff,.gb-button-wrapper a.gb-button-4e922aff:visited{padding:15px 8px;display:inline-flex;align-items:center;}a.gb-button-4e922aff .gb-icon{font-size:1em;}.gb-button-wrapper a.gb-button-e673a98b,.gb-button-wrapper a.gb-button-e673a98b:visited{padding:15px 8px;display:inline-flex;align-items:center;}a.gb-button-e673a98b .gb-icon{font-size:1em;}.gb-button-wrapper a.gb-button-fda4ad1f,.gb-button-wrapper a.gb-button-fda4ad1f:visited{padding:15px 8px;display:inline-flex;align-items:center;}a.gb-button-fda4ad1f .gb-icon{font-size:1em;}.gb-button-wrapper a.gb-button-f063470d,.gb-button-wrapper a.gb-button-f063470d:visited{font-size:14px;padding:15px 8px;}.gb-button-wrapper a.gb-button-aa1acb51,.gb-button-wrapper a.gb-button-aa1acb51:visited{font-size:14px;padding:15px 8px;}.gb-button-wrapper a.gb-button-dad7e0bf,.gb-button-wrapper a.gb-button-dad7e0bf:visited{font-size:14px;padding:15px 8px;}.gb-button-wrapper a.gb-button-907cc664,.gb-button-wrapper a.gb-button-907cc664:visited{font-size:17px;margin-right:30px;}.gb-button-wrapper a.gb-button-907cc664:hover,.gb-button-wrapper a.gb-button-907cc664:active,.gb-button-wrapper a.gb-button-907cc664:focus{color:#f2f5fa;}.gb-button-wrapper a.gb-button-a6a340bc,.gb-button-wrapper a.gb-button-a6a340bc:visited{font-size:17px;}.gb-button-wrapper a.gb-button-a6a340bc:hover,.gb-button-wrapper a.gb-button-a6a340bc:active,.gb-button-wrapper a.gb-button-a6a340bc:focus{color:#f2f5fa;}.gb-button-wrapper a.gb-button-22bfa10d,.gb-button-wrapper a.gb-button-22bfa10d:visited{padding:15px 14px;display:inline-flex;align-items:center;}.gb-button-wrapper a.gb-button-22bfa10d:hover,.gb-button-wrapper a.gb-button-22bfa10d:active,.gb-button-wrapper a.gb-button-22bfa10d:focus{color:var(--accent);}a.gb-button-22bfa10d .gb-icon{font-size:1.1em;}.gb-button-wrapper a.gb-button-5f028951,.gb-button-wrapper a.gb-button-5f028951:visited{padding:15px 14px;display:inline-flex;align-items:center;}.gb-button-wrapper a.gb-button-5f028951:hover,.gb-button-wrapper a.gb-button-5f028951:active,.gb-button-wrapper a.gb-button-5f028951:focus{background-color:rgba(34, 34, 34, 0);color:var(--accent);}a.gb-button-5f028951 .gb-icon{font-size:1.1em;}.gb-button-wrapper a.gb-button-f37cc1b6,.gb-button-wrapper a.gb-button-f37cc1b6:visited{padding:15px 14px;display:inline-flex;align-items:center;}.gb-button-wrapper a.gb-button-f37cc1b6:hover,.gb-button-wrapper a.gb-button-f37cc1b6:active,.gb-button-wrapper a.gb-button-f37cc1b6:focus{background-color:rgba(34, 34, 34, 0);color:var(--accent);}a.gb-button-f37cc1b6 .gb-icon{font-size:1.1em;}.gb-button-wrapper a.gb-button-c3a240b5,.gb-button-wrapper a.gb-button-c3a240b5:visited{padding:15px 14px;display:inline-flex;align-items:center;}.gb-button-wrapper a.gb-button-c3a240b5:hover,.gb-button-wrapper a.gb-button-c3a240b5:active,.gb-button-wrapper a.gb-button-c3a240b5:focus{background-color:rgba(34, 34, 34, 0);color:var(--accent);}a.gb-button-c3a240b5 .gb-icon{font-size:1.1em;}.gb-button-wrapper a.gb-button-44c4c3d6,.gb-button-wrapper a.gb-button-44c4c3d6:visited{padding:15px 14px;display:inline-flex;align-items:center;}.gb-button-wrapper a.gb-button-44c4c3d6:hover,.gb-button-wrapper a.gb-button-44c4c3d6:active,.gb-button-wrapper a.gb-button-44c4c3d6:focus{background-color:rgba(34, 34, 34, 0);color:var(--accent);}a.gb-button-44c4c3d6 .gb-icon{font-size:1.1em;}@media (min-width: 1025px) {.gb-grid-wrapper > div.gb-grid-column-90ba54e2{padding-bottom:0;}}@media (max-width: 1024px) {.gb-container-cc6b793f > .gb-inside-container{padding:100px 20px 200px;}.gb-container-c243e5b5{margin-top:0;}.gb-container-7eda8503 > .gb-inside-container{padding:40px 20px;}.gb-grid-wrapper > .gb-grid-column-7eda8503 > .gb-container{justify-content:center;}.gb-container-37100832 > .gb-inside-container{padding:40px 20px;}.gb-grid-wrapper > .gb-grid-column-37100832 > .gb-container{justify-content:center;}.gb-container-5cbbf9a2{margin-top:60px;}.gb-container-119df869 > .gb-inside-container{padding-top:150px;padding-bottom:20px;}.gb-container-016766a3 > .gb-inside-container{padding-top:150px;}.gb-container-9b5246c4 > .gb-inside-container{padding-top:150px;padding-bottom:20px;}.gb-container-4b60d420 > .gb-inside-container{padding-top:150px;padding-bottom:20px;}.gb-container-7fd6aa2d{margin-top:60px;}.gb-container-3e262987{margin-top:60px;}.gb-container-13ee4214 > .gb-inside-container{padding-right:30px;padding-left:30px;}.gb-container-cb7831a7 > .gb-inside-container{padding-right:30px;padding-left:30px;}.gb-container-3bdf6c9f{margin-top:60px;}.gb-container-d414f3d6{margin-top:60px;}.gb-container-a1195352 > .gb-inside-container{padding-right:20px;padding-left:20px;}.gb-container-148d55cb{margin-top:0;}.gb-grid-wrapper > .gb-grid-column-53cb46e2{width:100%;}.gb-grid-wrapper > .gb-grid-column-e1bd60bb{width:50%;}.gb-grid-wrapper-371c8e31{align-items:center;}.gb-grid-wrapper-75aee70c{margin-left:-30px;}.gb-grid-wrapper-75aee70c > .gb-grid-column{padding-left:30px;}.gb-grid-wrapper-b76f312f > .gb-grid-column{padding-bottom:40px;}h2.gb-headline-b60612dd{text-align:left;font-size:35px;margin-bottom:10px;}h2.gb-headline-2305eeb2{text-align:right;font-size:35px;}p.gb-headline-d750c5ec{text-align:right;}h2.gb-headline-12cdc19e{font-size:90px;}p.gb-headline-469c3887{font-size:17px;}h2.gb-headline-6dde0834{font-size:90px;}p.gb-headline-da47bd9e{font-size:17px;}h2.gb-headline-febd1c35{font-size:130px;}h2.gb-headline-e8c44a0e{font-size:90px;}p.gb-headline-5beba68e{font-size:17px;}h2.gb-headline-22a2d754{font-size:90px;}p.gb-headline-765dd33c{font-size:17px;}p.gb-headline-41582601{padding-right:0;}p.gb-headline-95746454{text-align:left;}p.gb-headline-bf8e162e{text-align:left;justify-content:flex-start;}.gb-button-wrapper-b2ef5dc5{justify-content:flex-end;}.gb-button-wrapper a.gb-button-22bfa10d{padding-right:10px;padding-left:10px;}}@media (max-width: 1024px) and (min-width: 768px) {.gb-grid-wrapper > div.gb-grid-column-e1bd60bb{padding-bottom:0;}}@media (max-width: 767px) {.gb-container-cc6b793f > .gb-inside-container{padding:80px 20px 100px;}.gb-container-c243e5b5{margin-top:0;}.gb-container-7eda8503{margin-top:0;}.gb-container-7eda8503 > .gb-inside-container{padding:40px 20px;}.gb-grid-wrapper > .gb-grid-column-7eda8503{width:100%;}.gb-grid-wrapper > .gb-grid-column-d910fc66{width:25%;}.gb-grid-wrapper > .gb-grid-column-575f7b5e{width:75%;}.gb-grid-wrapper > .gb-grid-column-90ba54e2{width:100%;order:-1;}.gb-container-37100832 > .gb-inside-container{padding:40px 20px;}.gb-grid-wrapper > .gb-grid-column-37100832{width:100%;}.gb-container-5cbbf9a2 > .gb-inside-container{padding-right:0;padding-bottom:20px;}.gb-container-119df869{border-style: solid;border-width:0 0 1px;}.gb-grid-wrapper > .gb-grid-column-119df869{width:100%;}.gb-container-016766a3{border-style: solid;border-width:1px 0;}.gb-grid-wrapper > .gb-grid-column-016766a3{width:100%;}.gb-container-9b5246c4{border-style: solid;border-width:1px 0;}.gb-grid-wrapper > .gb-grid-column-9b5246c4{width:100%;}.gb-container-4b60d420{border-style: solid;border-width:1px 0 0;}.gb-grid-wrapper > .gb-grid-column-4b60d420{width:100%;}.gb-container-7fd6aa2d > .gb-inside-container{padding-right:0;padding-bottom:20px;}.gb-container-3e262987 > .gb-inside-container{padding:20px;}.gb-container-13ee4214 > .gb-inside-container{padding-top:30px;padding-bottom:30px;}.gb-grid-wrapper > .gb-grid-column-13ee4214{width:100%;}.gb-container-cb7831a7{margin-left:0;}.gb-grid-wrapper > .gb-grid-column-cb7831a7{width:100%;order:-1;}.gb-container-3bdf6c9f > .gb-inside-container{padding-right:0;padding-bottom:20px;}.gb-container-d414f3d6 > .gb-inside-container{padding-right:0;padding-bottom:20px;padding-left:0;}.gb-container-a1195352{margin-top:25px;}.gb-container-a1195352 > .gb-inside-container{padding-top:80px;padding-bottom:40px;}.gb-container-68f95b0d{margin-top:0;}.gb-grid-wrapper > .gb-grid-column-68f95b0d{width:100%;}.gb-grid-wrapper > .gb-grid-column-c373ec39{width:33.33%;}.gb-grid-wrapper > .gb-grid-column-46b8f51d{width:66.66%;}.gb-container-148d55cb{margin-top:0;}.gb-grid-wrapper > .gb-grid-column-148d55cb{width:100%;}.gb-grid-wrapper > .gb-grid-column-1f43e011{width:33.33%;}.gb-grid-wrapper > .gb-grid-column-daa4e669{width:66.66%;}.gb-container-a8927d00{margin-top:0;}.gb-grid-wrapper > .gb-grid-column-a8927d00{width:100%;}.gb-grid-wrapper > .gb-grid-column-a89373cf{width:33.33%;}.gb-grid-wrapper > .gb-grid-column-0f7f37a3{width:66.66%;}.gb-grid-wrapper > .gb-grid-column-b3e34c3c{width:100%;}.gb-container-fcfab6f6{text-align:center;}.gb-grid-wrapper > .gb-grid-column-fcfab6f6{width:100%;}.gb-grid-wrapper > .gb-grid-column-53cb46e2{width:100%;}.gb-grid-wrapper > .gb-grid-column-e1bd60bb{width:100%;}.gb-grid-wrapper > .gb-grid-column-e6861bde{width:100%;}.gb-grid-wrapper > .gb-grid-column-7c528044{width:100%;}.gb-grid-wrapper-7e06c8d5 > .gb-grid-column{padding-bottom:0px;}.gb-grid-wrapper-2208a82e > .gb-grid-column{padding-bottom:0px;}.gb-grid-wrapper-b244dd7b > .gb-grid-column{padding-bottom:20px;}.gb-grid-wrapper-75aee70c > .gb-grid-column{padding-bottom:20px;}p.gb-headline-4a926537{font-size:15px;}h2.gb-headline-b60612dd{font-size:30px;}h2.gb-headline-2305eeb2{font-size:30px;padding-top:0;}p.gb-headline-d750c5ec{font-size:17px;}h2.gb-headline-12cdc19e{font-size:58px;}p.gb-headline-469c3887{font-size:15px;margin-top:-70px;padding-right:0;}p.gb-headline-e9550e29{font-size:17px;}p.gb-headline-535218b9{font-size:17px;}p.gb-headline-f4d34bb3{font-size:17px;}p.gb-headline-c6ac5e85{font-size:17px;}h2.gb-headline-6dde0834{font-size:60px;}p.gb-headline-da47bd9e{font-size:15px;margin-top:-70px;padding-right:0;}p.gb-headline-34272f97{font-size:15px;}h2.gb-headline-febd1c35{text-align:center;font-size:100px;}h2.gb-headline-e8c44a0e{font-size:60px;}p.gb-headline-5beba68e{font-size:15px;margin-top:-70px;padding-right:0;}h2.gb-headline-22a2d754{font-size:57px;}p.gb-headline-765dd33c{font-size:15px;margin-top:-70px;padding-right:0;}.gb-button-wrapper-b2ef5dc5{margin-bottom:0;}.gb-button-wrapper-3a5c1d30{justify-content:center;}.gb-button-wrapper-17b6ddfb{justify-content:center;flex-direction:column;align-items:center;}.gb-button-wrapper-d060803e{justify-content:flex-start;}.gb-button-wrapper-0a1d34a0{margin-left:10px;}.gb-button-wrapper a.gb-button-22bfa10d{padding-right:10px;padding-left:10px;}.gb-button-wrapper a.gb-button-5f028951{padding-right:10px;padding-left:10px;}.gb-button-wrapper a.gb-button-f37cc1b6{padding-right:10px;padding-left:10px;}.gb-button-wrapper a.gb-button-c3a240b5{padding-right:10px;padding-left:10px;}.gb-button-wrapper a.gb-button-44c4c3d6{padding-right:10px;padding-left:10px;}}
	<?php } ?>
	<?php if (ampforwp_get_setting('amp-quantcast-notice-switch')) {?>
		#postPromptUI button {
           background: #368bd6;
           color: white;
           padding: 5px 15px;
           border: none;
           outline: none;
           display: flex;
           align-items: center;
           position: fixed;
           right: 0;
           bottom: 0;
           border-radius: 3px 0 0 3px;
           max-height: 30px;
           max-width: 110px;
           cursor: pointer;
        }
	<?php } ?>	
	
	<?php if( ampforwp_get_setting('amp_font_selector_heading')) { ?>
		h1,h2,h3,h4,h5,h6{
		font-family:<?php echo ampforwp_get_setting('amp_font_selector_heading'); ?>
		}	
	<?php } ?>	
	<?php if( ampforwp_get_setting('ampforwp-infinite-scroll-new-features')) { ?>
		footer.footer {
    		margin: 0;
		}
		footer .f-w-f2 {
		    padding: 0;
		}
	<?php } ?>
	<?php if( function_exists('rehub_framework_plugin_activate') ) { ?>
		.table_view_charts{ margin: 10px 0; overflow: hidden;}
		.top_chart_wrap, .top_chart .swiper-container{float: left; width: calc(100% - 160px); position: relative; }
		.top_chart_controls{ float: right; margin-bottom: 10px}
		.top_chart_controls .controls {text-decoration: none; width: 30px;height: 30px;cursor: pointer;opacity: 0.8;text-align: center;float: left;border: 1px solid #ddd;color: #444;}
		.top_chart_controls .controls.next:after, .top_chart_controls .controls.prev:after{line-height: 30px;font-size: 18px;} 
		.top_chart_controls .controls.next:after {content: "\f105"; }
		.top_chart_controls .controls.prev:after {content: "\f104";}
		.top_chart_pagination a span{ display: none;}
		.top_chart_pagination a{width: 8px;height: 8px;margin: 11px 2px;float: left; background-color: #ccc; cursor: pointer; border-radius: 50%}
		.top_chart_pagination a.selected {cursor: default;}
		.top_chart_pagination{ float: left; margin: 0 7px}
		.table_view_charts .top_chart_item, .table_view_charts .top_chart_first{border-top:1px solid #ddd; float: left;  position: relative;}
		.table_view_charts .top_chart_item li:first-child, .table_view_charts .top_chart_first li:first-child{background-color: #fff}
		.table_view_charts .top_chart_first {  width: 160px; clear: both;}
		.table_view_charts .top_chart_item{width: 220px; background: #fff;display: inline; max-width: 260px }
		.table_view_charts li { border-bottom: 1px solid #e8e8e8; border-right:1px solid #e8e8e8; border-left:1px solid transparent; list-style: none !important; margin:0; padding: 8px; overflow: hidden; font-size: 14px;line-height: 20px;}
		.table_view_charts li p, .post .table_view_charts ul li{margin: 0}
		.table_view_charts .top_chart_first ul li{  background-color: #f8f8f8; text-align: right; border-left: 1px solid #e8e8e8;}
		.table_view_charts li.heading_row_chart { font-weight: bold; font-size: 15px; line-height: 18px; background-color: #fff !important; border-right-color: #fff !important;border-left-color: #fff !important; padding: 17px 0 17px 4px}
		.table_view_charts .top_chart_item li{text-align: center;}
		.table_view_charts .top_chart_item li.meta_value_left{text-align: inherit;}
		.table_view_charts .top_chart_item figure{height: auto; margin: 0 auto; text-align: center; width: auto; padding: 0; height: 150px}
		.table_view_charts .top_chart_item figure a{width: auto; height: auto; display: block; border:none;}
		.table_view_charts .top_chart_item figure > a img{ height:auto; width: auto; max-height: 150px; max-width: 100%; border: none; vertical-align: middle; padding: 0}
		.table_view_charts .top_chart_item .star { margin: 0 auto !important}
		.table_view_charts .top_chart_item .rehub_meta_field_icon{ font-size: 18px; color: #41BD28}
		.table_view_charts .top_chart_item .rehub_meta_field_icon .rhi-ban{color: #dc0000}
		.table_view_charts .top_chart_item .title_row_chart a{color: #111;text-decoration: none; }
		.table_view_charts ul{ padding: 0; margin: 0}
		.table_view_charts h2{ font-size: 17px; line-height: 17px; margin: 10px 0 0 0; padding: 0}
		.meta_value_row_chart ul li{border: none;text-align: left;margin: 0 0 12px 0;padding: 0;}
		.table_view_charts .is-sticky li{z-index: 999999;background-color: #fff}
		.table_view_charts .sticky-wrapper li { transition: all 1s ease 0.5s; top: 0; position: relative; }
		.table_view_charts div.sticky-wrapper.is-sticky li { transition: all 1.5s ease; z-index: 100; max-height: 200px }
		.table_view_charts .sticky-wrapper.is-sticky .sticky-cell .price-in-compare-flip { display:none }
		.table_view_charts .sticky-wrapper.is-sticky .row_chart_0.image_row_chart.row-is-different { height:170px !important; }
		.table_view_charts .top_chart_item .sticky-wrapper.is-sticky figure{height: 100px}
		.table_view_charts .top_chart_item .sticky-wrapper.is-sticky figure > a img{max-height: 100px}
		.top_chart_item:not(.activecol) .is-sticky {opacity: 0}
		.re-compare-show-diff, .diff-label{cursor: pointer;}
		.re-compare-show-diff{padding: 4px; margin-right: 5px}
		.table_view_charts li.low-opacity{opacity: 0.1}
		.imagefull_row_chart del{display: none;}
		.imagefull_row_chart .greencolor{display: block;}
		.table_view_charts .rh-star-ajax .title_star_ajax small { display: block;}
		.table_view_charts .user-rate{ float: none;margin: 0 auto}
		.table_view_charts .rehub_offer_coupon:not(.coupon_btn){ margin: 0 auto 10px auto;}
		.loading.table_view_charts:before{ font-size: 45px; color: #ccc}
		.top_chart_controls {display: none;}
		.loading.table_view_charts{ text-align: center; border: 1px solid #f9f9f9; background-color: #f9f9f9}
		.table_view_charts ul li ul li{border: none !important}
		.top_chart_wrap.woocommerce .rev-in-compare-flip{left: 15px; right: auto;}
		.price-woo-compare-chart{font-size: 19px; display: block; }
		.price-woo-compare-chart del{display: none;}
		@media screen and (max-width: 767px) {
		.table_view_charts .is-sticky h2{font-size: 14px}
		.top_chart_item{ width: 186px}}
		@media (max-width: 468px) {
		.table_view_charts li.heading_row_chart{font-size: 14px}
		.rev-in-compare-flip{display: none;}
		.table_view_charts h2, .top_chart_item .price-woo-compare-chart{font-size: 15px; margin-top: 5px}
		.table_view_charts .top_chart_item figure, .table_view_charts .top_chart_item .sticky-wrapper.is-sticky figure{height: 80px}
		.table_view_charts .top_chart_item figure > a img{max-height: 80px}
		.table_view_charts{margin: 10px -15px}
		.table_view_charts .top_chart_item .sticky-wrapper.is-sticky figure > a img{max-height: 80px}
		.table_view_charts .top_chart_wrap, .top_chart .swiper-container{float: left; width: calc(100% - 90px);}  
		.table_view_charts .top_chart_first{ width: 90px; overflow: hidden;}
		.table_view_charts .top_chart_first li { font-size: 12px}
		.table_view_charts li{font-size: 13px;}
		.top_chart:not(.loading) .chart_helper{display: inline-block;}
		.table_view_charts .top_chart_item {max-width: 150px;}
		.single-post main .amp-wp-article-content h2 {font-size: 12px;}
		}
	<?php } ?>
<?php if( function_exists('wptb_render_table')) { ?>
		@-webkit-keyframes show{0%{opacity:0}to{opacity:1}}@keyframes show{0%{opacity:0}to{opacity:1}}@-webkit-keyframes wptb-flip{0%{transform:rotateY(0deg)}to{transform:rotateY(360deg)}}@keyframes wptb-flip{0%{transform:rotateY(0deg)}to{transform:rotateY(360deg)}}@-webkit-keyframes wptb-jump{0%{transform:translateY(25%)}to{transform:translateY(-25%)}}@keyframes wptb-jump{0%{transform:translateY(25%)}to{transform:translateY(-25%)}}@-webkit-keyframes wptb-rotate-simple{0%{transform:rotateZ(0deg)}to{transform:rotateZ(360deg)}}@keyframes wptb-rotate-simple{0%{transform:rotateZ(0deg)}to{transform:rotateZ(360deg)}}@-webkit-keyframes wptb-beat{0%,30%,to{transform:scale(1)}15%{transform:scale(1.5)}}@keyframes wptb-beat{0%,30%,to{transform:scale(1)}15%{transform:scale(1.5)}}.wptb-table-container{overflow:auto;position:relative;width:100%;margin:30px auto}.wptb-table-container[data-wptb-horizontal-scroll-status=true]{width:100%;overflow-x:auto!important}.wptb-table-container[data-wptb-horizontal-scroll-status=true] .wptb-table-container-matrix{padding:10px 0}.wptb-table-container-matrix{margin:auto}.wptb-frontend-table-after .wptb-frontend-table-edit-link,.wptb-frontend-table-after .wptb-frontend-table-powered-by,.wptb-rating-stars-box ul li{display:inline-block}.wptb-frontend-table-powered-by{float:right}.wptb-frontend-table-edit-link{clear:both}.wptb-table-container table{table-layout:fixed;font-size:15px;width:auto;display:table;border-collapse:collapse}.wptb-table-container-matrix table{margin:auto}.wptb-table-container-matrix.wptb-matrix-hide{visibility:visible;opacity:0;position:absolute;top:0;left:0;right:0;bottom:0;z-index:-1;overflow:hidden}table.wptb-preview-table-mobile{width:100%}.wptb-preview-table-mobile.wptb-mobile-hide{display:none}table.wptb-preview-table{opacity:0;-webkit-animation:show .3s 1;animation:show .3s 1;-webkit-animation-fill-mode:forwards;animation-fill-mode:forwards;-webkit-animation-delay:.7s;animation-delay:.7s;overflow:visible}.wptb-preview-table tr:nth-of-type(2n+1),.wptb-table-container table.wptb-preview-table-mobile tr td:nth-of-type(2n+1){background-color:#eee}.wptb-table-container table.wptb-preview-table-mobile tr:nth-of-type(2n+1){background-color:inherit}.wptb-table-container table td{padding:15px;position:relative;box-sizing:content-box;vertical-align:middle}.wptb-table-container-matrix.wptb-matrix-hide .wptb-preview-table td{width:auto!important}.wptb-table-container table td p{word-wrap:break-word;overflow-wrap:break-word;margin:0!important;word-break:break-word}.wptb-table-container table tr td ul{margin:0!important;padding:1em .2em .4em}.wptb-table-container table tr td ul li p{font-size:15px}.wptb-row td:empty::before{content:" ";display:block;min-height:19px;box-sizing:border-box;border:0}.wptb-ph-element{position:relative;border:1px solid #fff0}.wptb-elem-placeholder{display:none}.wptb-image-wrapper::after{content:"";display:block;height:0;width:100%;clear:both}.wptb-image-wrapper a{display:block;max-width:100%;position:relative;margin:auto}.wptb-cell .wptb-ph-element a{box-shadow:none}.wptb-image-wrapper img{width:100%;height:auto}.wptb-text-container>div,.wptb-text-container>div>p{font-size:inherit;color:inherit}.wptb-button-wrapper{display:flex;align-items:center;justify-content:center}.wptb-button-container .wptb-button-wrapper a{text-decoration:none!important}.wptb-button-wrapper>a,.wptb-cell img,.wptb-table img{max-width:100%}.wptb-size-s .wptb-button{border-radius:.2rem;padding:.35rem .6rem;max-width:100%}.wptb-size-s .wptb-button p{font-size:.875rem;line-height:1.5}.wptb-size-l .wptb-button,.wptb-size-m .wptb-button{border-radius:.3rem;padding:.475rem .85rem;max-width:100%}.wptb-size-m .wptb-button p{font-size:1.125rem;line-height:1.5}.wptb-size-l .wptb-button{padding:.6rem 1.2rem}.wptb-size-l .wptb-button p{font-size:inherit;line-height:1.5}.wptb-size-xl .wptb-button{border-radius:.4rem;padding:.8rem 1.35rem;max-width:100%}.wptb-size-xl .wptb-button p{font-size:1.35rem;line-height:1.5}.wptb-button,.wptb-button .wptb-button-icon{display:flex;justify-content:center;align-items:center}.wptb-button{background:#329d3f;color:#fff;transition:all .2s ease-out;cursor:pointer}.wptb-button .wptb-button-icon{margin:0 5px;order:-1;width:25px;height:25px}.wptb-button .wptb-button-icon svg{fill:currentColor;width:100%;height:100%}.wptb-button-icon[data-wptb-button-icon-src=""]{display:none}.wptb-plugin-button-order-right .wptb-button-icon,[data-wptb-button-icon-position=right] .wptb-button-icon{order:2}.wptb-ph-element .wptb-button p{color:inherit}[class*=wptb-element-text-] p{color:inherit!important;font-size:inherit!important}.wptb-list-container.wptb-ph-element ul li{list-style:none;margin:0 0 10px;position:relative}.wptb-list-container.wptb-ph-element ul li:last-child{margin-bottom:0}.wptb-list-container li p{word-wrap:break-word;line-height:inherit;padding-left:20px}.wptb-list-container li p::before{content:attr(data-list-style-type-index);display:inline-block;line-height:20px;padding:0 5px 0 0;font-size:15px;font-family:verdana,sans-serif;cursor:text;min-width:-webkit-fit-content;min-width:-moz-fit-content;min-width:fit-content;margin-left:-20px}.wptb-list-container li p.wptb-list-style-type-disc::before{content:'\25CF'}.wptb-list-container li p.wptb-list-style-type-circle::before{content:'\25CB'}.wptb-list-container li p.wptb-list-style-type-square::before{content:'\25A0'}.wptb-list-container li p.wptb-list-style-type-none::before{content:'';padding-right:0}.wptb-star_rating-container{text-align:center}.wptb-rating-stars-box{text-align:center;display:inline-block;padding:7px}.wptb-rating-stars-box ul{list-style-type:none;-moz-user-select:none;-webkit-user-select:none;padding:.5em .2em .2em}.wptb-rating-stars-box ul>li.wptb-rating-star{color:#ccc;margin:0;position:relative;width:20px;height:20px}.wptb-rating-stars-box ul>li.wptb-rating-star span{position:absolute;height:100%;width:100%;top:0;left:0;z-index:10;display:block}.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-rating-star-left-signal-part,.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-rating-star-right-signal-part{height:100%;width:50%;z-index:20}.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-rating-star-left-signal-part{left:0}.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-rating-star-left-signal-part span.wptb-rating-star-zero-set{left:0;width:40%;height:100%;top:0;z-index:30px}.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-rating-star-right-signal-part{right:0;left:auto}.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-filled-rating-star,.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-half-filled-rating-star,.wptb-rating-stars-box ul>li.wptb-rating-star.wptb-rating-star-selected-half span.wptb-filled-rating-star,.wptb-rating-stars-box ul>li.wptb-rating-star.wptb-rating-star-selected-half span.wptb-not-filled-rating-star{display:none}.wptb-rating-stars-box ul>li.wptb-rating-star span.wptb-not-filled-rating-star{fill:#ccc}.wptb-rating-stars-box ul>li.wptb-rating-star.wptb-rating-star-selected-full span.wptb-filled-rating-star,.wptb-rating-stars-box ul>li.wptb-rating-star.wptb-rating-star-selected-half span.wptb-half-filled-rating-star{display:block;fill:#ff912c}.wptb-rating-stars-box ul>li.wptb-rating-star.wptb-rating-star-selected-full span.wptb-half-filled-rating-star,.wptb-rating-stars-box ul>li.wptb-rating-star.wptb-rating-star-selected-full span.wptb-not-filled-rating-star{display:none}.wptb-number-rating-box{text-align:center;font-size:20px}.wptb-number-rating-box>div{vertical-align:top;display:inline-block;color:#888;text-align:center;height:25px;font-size:25px;line-height:25px}.wptb-column-title-mobile-container{display:none;position:absolute;top:0;bottom:0;left:0;right:50%}.wptb-column-title-mobile-container.wptb-column-title-mobile-container-clone{position:relative;width:50%;right:auto;left:auto;top:auto;bottom:auto}.wptb-column-title-mobile-container .wptb-column-title-mobile{display:table;width:100%;table-layout:fixed;height:100%;word-wrap:break-word;overflow-wrap:break-word}.wptb-table-container.wptb-section-small table{min-width:auto}.wptb-cell ul{padding:0}.wptb-table-container.wptb-section-small table tr td{display:block;width:100%;box-sizing:border-box;position:relative;min-height:60px;overflow:hidden}.wptb-table-container.wptb-section-small table.wptb-table-preview-head td .wptb-column-title-mobile-container{display:block}.wptb-table-container table.wptb-table-preview-head td .wptb-column-title-mobile-container .wptb-column-title-mobile::before{content:attr(data-wptb-title-column);display:table-cell;width:50%;vertical-align:middle;padding:inherit}.wptb-table-container.wptb-section-small table.wptb-table-preview-head td.wptb-column-title-mobile-not-elements{padding:0!important}.wptb-table-container table.wptb-table-preview-head td .wptb-column-title-mobile-container.wptb-column-title-mobile-not-elements .wptb-column-title-mobile::before{padding-left:0}.wptb-table-container.wptb-section-small table.wptb-table-preview-head td .wptb-ph-element{display:inline-block;width:50%;margin-left:50%;padding-left:inherit;box-sizing:border-box}.wptb-table-container.wptb-section-small table td{border-width:0 1px 1px!important}.wptb-table-container.wptb-section-small table tr td:nth-of-type(1){border-top-width:3px!important}.wptb-table-container.wptb-section-small table tr td:nth-last-of-type(1){border-top-width:0!important}.wptb-table-container.wptb-section-small table.wptb-table-preview-head tr:first-child{display:none}@media only screen and (max-width:600px){.wptb-table-container table{min-width:auto}.wptb-table-container table.wptb-table-preview-head.wptb-table-preview-static-indic tr td{display:block;width:100%!important;box-sizing:border-box;position:relative;min-height:60px;overflow:hidden}.wptb-table-container table.wptb-table-preview-head.wptb-table-preview-static-indic td.wptb-column-title-mobile-not-elements{padding:0!important}.wptb-table-container table.wptb-table-preview-head.wptb-table-preview-static-indic td .wptb-column-title-mobile-container{display:block}.wptb-table-container table.wptb-table-preview-head.wptb-table-preview-static-indic td .wptb-ph-element{display:inline-block;width:50%;margin-left:50%;padding-left:inherit}.wptb-table-container table.wptb-table-preview-head.wptb-table-preview-static-indic td{border-width:0 1px 1px!important}.wptb-table-container table.wptb-table-preview-head.wptb-table-preview-static-indic tr td:nth-of-type(1){border-top-width:1px!important}.wptb-table-container table.wptb-table-preview-head.wptb-table-preview-static-indic tr:first-child{display:none}}.wptb-plugin-responsive-base{min-width:auto!important;width:100%!important}.wptb-plugin-box-shadow-md{box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -1px rgba(0,0,0,.06)}.wptb-plugin-filter-box-shadow-md{filter:drop-shadow(4px 6px 2px rgba(0,0,0,.1))}.wptb-plugin-filter-box-shadow-md-close{filter:drop-shadow(4px 1px 2px rgba(0,0,0,.1))}.wptb-cell[data-wptb-cell-vertical-alignment=top]{vertical-align:baseline}.wptb-cell[data-wptb-cell-vertical-alignment=center]{vertical-align:middle}.wptb-cell[data-wptb-cell-vertical-alignment=bottom]{vertical-align:bottom}.wptb-preview-table-mobile[data-wptb-sortable-table-horizontal="1"] td[data-x-index="0"]::after,.wptb-preview-table-mobile[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical]::after,.wptb-preview-table[data-wptb-sortable-table-horizontal="1"] td[data-x-index="0"]::after,.wptb-preview-table[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical]::after{position:absolute;top:0;bottom:0;z-index:100;display:grid;font-family:dashicons;font-size:35px;align-content:center;text-align:center}.wptb-preview-table-mobile[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=ask]::after,.wptb-preview-table[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=ask]::after{content:"\f142";right:0}.wptb-preview-table-mobile[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=desk].sortable-hover::after,.wptb-preview-table[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=desk].sortable-hover::after{content:"\f142";cursor:pointer;opacity:.7}.wptb-preview-table-mobile[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=desk]::after,.wptb-preview-table[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=desk]::after{content:"\f140";right:0}.wptb-preview-table-mobile[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=ask].sortable-hover::after,.wptb-preview-table[data-wptb-sortable-table-vertical="1"] td[data-sorted-vertical=ask].sortable-hover::after{content:"\f140";cursor:pointer;opacity:.7}.wptb-preview-table-mobile[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=ask]::after,.wptb-preview-table[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=ask]::after{content:"\f141";left:0}.wptb-preview-table-mobile[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=desk].sortable-hover::after,.wptb-preview-table[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=desk].sortable-hover::after{content:"\f141";cursor:pointer;opacity:.7}.wptb-preview-table-mobile[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=desk]::after,.wptb-preview-table[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=desk]::after{content:"\f139"}.wptb-preview-table-mobile[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=ask].sortable-hover::after,.wptb-preview-table[data-wptb-sortable-table-horizontal="1"] td[data-sorted-horizontal=ask].sortable-hover::after{content:"\f139";cursor:pointer;opacity:.7}.wptb-lazy-load-img[data-wptb-lazy-load-status=false]{opacity:0}.wptb-lazy-load-img[data-wptb-lazy-load-status=true]{opacity:1}.wptb-lazy-load-buffer-element-container{position:relative}.wptb-lazy-load-buffer-element{position:absolute;top:0;left:0;width:100%;height:100%;border-radius:5px}.wptb-lazy-load-buffer-element,.wptb-lazy-load-buffer-icon-wrapper{display:flex;justify-content:center;align-items:center}.wptb-lazy-load-buffer-icon-wrapper[data-wptb-lazy-load-icon-animation=heartBeat] svg{-webkit-animation:wptb-beat 1.3s ease-out forwards infinite;animation:wptb-beat 1.3s ease-out forwards infinite}.wptb-lazy-load-buffer-icon-wrapper[data-wptb-lazy-load-icon-animation=rotate] svg{-webkit-animation:wptb-rotate-simple 1s ease-out forwards infinite;animation:wptb-rotate-simple 1s ease-out forwards infinite}.wptb-lazy-load-buffer-icon-wrapper[data-wptb-lazy-load-icon-animation=jump] svg{-webkit-animation:wptb-jump .5s ease-out alternate infinite;animation:wptb-jump .5s ease-out alternate infinite}.wptb-lazy-load-buffer-icon-wrapper[data-wptb-lazy-load-icon-animation=flip] svg{-webkit-animation:wptb-flip 1s ease-out forwards infinite;animation:wptb-flip 1s ease-out forwards infinite}.wptb-plugin-width-full{width:100%!important}.wptb-scroll-indicator-container{position:absolute;width:50px;height:100%;background-color:red;top:0}
		<?php } ?>	
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
      text-decoration: none;
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
<?php } 
	if ( ! ampforwp_woocommerce_conditional_check() ) {
		if ( is_singular() || is_home() && true == ampforwp_get_setting( 'amp-frontpage-select-option' ) && ampforwp_get_blog_details() == false && ! checkAMPforPageBuilderStatus( ampforwp_get_the_ID() ) ) { ?>
            /* Tables */
            .wp-block-table{ min-width :240px;}
            table.wp-block-table.alignright,table.wp-block-table.alignleft,table.wp-block-table.aligncenter{width: auto;}
            table.wp-block-table.aligncenter{width: 50%;}
            table.wp-block-table.alignfull,table.wp-block-table.alignwide{display: table;}
            table { overflow-x: auto; }
            table a:link { font-weight: bold; text-decoration: none; }
            table a:visited { color: #999999; font-weight: bold; text-decoration: none; }
            table a:active, table a:hover { color: #bd5a35; text-decoration: underline; }
            table { font-family: Arial, Helvetica, sans-serif; color: #666; font-size: 15px; text-shadow: 1px 1px 0px #fff; background: inherit; margin: 0px; width: 95%; }
            table th { padding: 21px 25px 22px 25px; border-top: 1px solid #fafafa; border-bottom: 1px solid #e0e0e0; background: #ededed; }
            table th:first-child { text-align: left; padding-left: 20px; }
            table tr:first-child th:first-child { -webkit-border-top-left-radius: 3px; border-top-left-radius: 3px; }
            table tr:first-child th:last-child { -webkit-border-top-right-radius: 3px; border-top-right-radius: 3px; }
            table tr { text-align: center; padding-left: 20px; border: 2px solid #eee;}
            table td:first-child {padding-left: 20px; border-left: 0; }
            table td { padding: 18px; border-top: 1px solid #ffffff; border-bottom: 1px solid #e0e0e0; border-left: 1px solid #e0e0e0;}
            table tr.even td { background: #f6f6f6; background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));  }
            table tr:last-child td {border-bottom: 0;}
            table tr:last-child td:first-child { -webkit-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px; }
            table tr:last-child td:last-child {  -webkit-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; }
            @media screen and (min-width: 650px) { table {display: inline-table;}  }

		<?php }
	}?>
    .has-text-align-left { text-align: left;}
    .has-text-align-right { text-align: right;}
    .has-text-align-center { text-align: center;}
    <?php if (ampforwp_get_setting('ampforwp-web-push-onesignal') && ampforwp_get_setting('ampforwp-web-push-onesignal-popup') && is_single()) { ?>
    @media (min-width:1281px){
		.onesignal-popup{
	    position: fixed; 
		top: 0; 
		bottom: 0;
		left: 0;
		right: 0;
		background: rgba(0, 0, 0, 0.7);
		color: #333;
		z-index:9999999;
		line-height:1.3;
		height: 100vh;
		width: 100vw
		}
		.onesignal-popup_wrapper{
		padding: 2rem;
		background: #fff;
		max-width: 700px;
		width: 95%;
		margin: 5% auto;
		text-align: center;
		position:fixed;
		left: 0;
		right: 0;
		margin:10% auto;
		}
		.onesignal-popup_x{
		position: absolute;
		right: 24px; 
		top: 16px; 
		cursor:pointer;
		}
 	}
 	html {
    scroll-behavior: smooth;
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
				$amp_addthis .= '<div class="amp-wp-content"><amp-addthis width="'.$addthisWidth.'" height="92" data-pub-id="'.esc_attr($data_pub_id).'" data-widget-id="'. esc_attr($data_widget_id).'"></amp-addthis></div>';
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

	// Added json for amp sidebar menu checkbox 
		if( ampforwp_get_setting('amp-design-selector') == 4){ ?>	
			<amp-state id="sidemenu">
				<script type="application/json">
				  <?php echo json_encode(array('offcanvas_menu'=> false));?>
				</script>
			</amp-state>
		<?php }
}