<?php 
use AMPforWP\AMPVendor\AMP_Post_Template;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; 
// add_action( 'amp_post_template_head', function() {
//     remove_action( 'amp_post_template_head', 'amp_post_template_add_fonts' );
// }, 9 );
// add_action('amp_post_template_css', 'ampforwp_additional_style_input_2');

// function ampforwp_additional_style_input_2( $amp_template ) {
	global $redux_builder_amp;
	global $post;
	$post_id = '';
	$post_id = ampforwp_get_the_ID();
	$get_customizer = new AMP_Post_Template( $post_id );
	// Get content width
	$content_max_width       = absint( $get_customizer->get( 'content_max_width' ) );
	// Get template colors
	$theme_color             = $get_customizer->get_customizer_setting( 'theme_color' );
	$text_color              = $get_customizer->get_customizer_setting( 'text_color' );
	$muted_text_color        = $get_customizer->get_customizer_setting( 'muted_text_color' );
	$border_color            = $get_customizer->get_customizer_setting( 'border_color' );
	$link_color              = $get_customizer->get_customizer_setting( 'link_color' );
	$header_background_color = $get_customizer->get_customizer_setting( 'header_background_color' );
	$header_color            = $get_customizer->get_customizer_setting( 'header_color' );
	?>

<?php // Menu elemensts colors
$header_bg_clr          = ampforwp_get_setting('amp-d2-background-color','rgba');
$header_elements_clr    = ampforwp_get_setting('amp-d2-elements-color','color');
$menu_sidebar_clr       = ampforwp_get_setting('amp-d2-sidebar-color','color');
$menu_bg_clr            = ampforwp_get_setting('amp-d2-menu-bg-color','color');
$menu_elements_clr      = ampforwp_get_setting('amp-d2-menu-color','color');
$submenu_bg_clr         = ampforwp_get_setting('amp-d2-submenu-bg-color','color');
$menu_bdr_clr           = ampforwp_get_setting('amp-d2-menu-brdr-color','color');
$menu_icon_clr          = ampforwp_get_setting('amp-d2-menu-icon-color','color');
$cross_btn_clr          = ampforwp_get_setting('amp-d2-cross-btn-color','color');
$cross_btn_bg_clr       = ampforwp_get_setting('amp-d2-cross-bg-color','rgba');
$cross_btn_hvr_clr      = ampforwp_get_setting('amp-d2-cross-hover-color','rgba');

if(empty($header_bg_clr)){
	$header_bg_clr ='#0074A7';
}
if(empty($header_elements_clr)){
	$header_elements_clr ='#ffffff';
}
if(empty($menu_sidebar_clr)){
	$menu_sidebar_clr ='#efefef';
}
if(empty($menu_bg_clr)){
	$menu_bg_clr ='#fafafa';
}
if(empty($menu_elements_clr)){
	$menu_elements_clr ='#0a89c0';
}
if(empty($submenu_bg_clr)){
	$submenu_bg_clr ='#ffffff';
}
if(empty($menu_bdr_clr)){
	$menu_bdr_clr ='#efefef';
}
if(empty($menu_icon_clr)){
	$menu_icon_clr ='#ccc';
}
if(empty($cross_btn_clr)){
	$cross_btn_clr ='#ffffff';
}
if(empty($cross_btn_bg_clr)){
	$cross_btn_bg_clr ='rgba(0, 0, 0, 0.25)';
}
if(empty($cross_btn_hvr_clr)){
	$cross_btn_hvr_clr ='rgba(0, 0, 0, 0.45)';
}

?>
/* Global Styling */
body{ 
	background: #f1f1f1;
	font-size:16px;
	line-height:1.4;
	<?php $fontFamily = "font-family: sans-serif;"; ?>
  	<?php if( 1 == ampforwp_get_setting('ampforwp-google-font-switch') ) {
      $fontFamily = "font-family: sans-serif;";
      if(ampforwp_get_setting('amp_font_selector') != 1 && !empty(ampforwp_get_setting('amp_font_selector') )){ 
        $fontFamily = "font-family: ".ampforwp_get_setting('amp_font_selector').";";
      }
    }
    echo sanitize_text_field($fontFamily); ?>
}
<?php // secondary font family
$font_content = '';
$font_content = ampforwp_get_setting('amp_font_selector_content_single'); ?>
.amp-wp-post-content p, .amp-wp-content.the_content{
	<?php $fontFamily = "font-family: sans-serif;"; 
    if(1==ampforwp_get_setting('ampforwp-google-font-switch') && 1 == ampforwp_get_setting('content-font-family-enable')){ 
      if(!empty($font_content) && $font_content != 1 ){  
        $fontFamily = "font-family: ".esc_attr($font_content).";";
      }  
    }
echo sanitize_text_field($fontFamily); // secondary font family ends here ?>
}
a {	color: #312C7E;	text-decoration: none }
.clearfix, .cb { clear: both }
amp-iframe{ max-width: 100%; margin-bottom : 20px; }
amp-anim { max-width: 100%; }
.amp-wp-article amp-addthis{display: inherit;margin-top: 20px;margin-left: -10px;}
amp-wistia-player {margin:5px 0px;}
.alignleft{ margin-right: 12px; margin-bottom:5px; float: left; }
.alignright{ float:right; margin-left: 12px; margin-bottom:5px; }
.aligncenter{display: block; text-align:center; margin: 0 auto }
#statcounter{width: 1px;height:1px;}
ol, ul {list-style-position: inside;}
.hide{display:none}
/* Template Styles */
.amp-wp-content, .amp-wp-title-bar div {
	<?php echo ampforwp_font_selector('content'); ?>
    <?php if ( $content_max_width > 0 ) : ?>
    max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
    margin: 0 auto;
    <?php endif;
    if((is_singular() || ampforwp_is_front_page() ) && checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){?>
      max-width:100%;
    <?php } ?>
}
figure.aligncenter amp-img {
 margin: 0 auto;
 }
/* Slide Navigation code */
.nav_container{ padding: 18px 15px; background: #312C7E; color: #fff; text-align: center }
amp-sidebar{ width: 250px; }
amp-sidebar{background:<?php echo ampforwp_sanitize_color($menu_sidebar_clr); ?>;}
.amp-sidebar-image{ line-height: 100px; vertical-align:middle; }
.amp-close-image{ top: 15px; left: 225px; cursor: pointer; }
.toggle-navigationv2 ul{ list-style-type: none; margin: 0; padding: 0; }
.toggle-navigationv2 ul ul li a{ padding-left: 35px; background:<?php echo ampforwp_sanitize_color($submenu_bg_clr); ?>; display: inline-block }
.toggle-navigationv2 ul li a{ padding: 15px 25px; width: 100%; display: inline-block; background: <?php echo ampforwp_sanitize_color($menu_bg_clr); ?>; font-size: 14px; border-bottom: 1px solid <?php echo ampforwp_sanitize_color($menu_bdr_clr); ?>;color:<?php echo ampforwp_sanitize_color($menu_elements_clr); ?>;}
.close-nav{ font-size: 12px; background: <?php echo ampforwp_sanitize_color($cross_btn_bg_clr); ?>; letter-spacing: 1px; display: inline-block; padding: 10px; border-radius: 100px; line-height: 8px; margin: 14px;color: <?php echo ampforwp_sanitize_color($cross_btn_clr); ?>; 
position:relative;
<?php if (ampforwp_get_setting('header-overlay-position-d2') == 1 ) {?>
right:0px;
<?php } // 
if (ampforwp_get_setting('header-overlay-position-d2') == 2 ) {?>
left:191px;
<?php } ?>
}
.close-nav:hover{ background: <?php echo ampforwp_sanitize_color($cross_btn_hvr_clr); ?>;}
.toggle-navigation ul{ list-style-type: none; margin: 0; padding: 0; display: inline-block; width: 100% }
.menu-all-pages-container:after{ content: ""; clear: both }
.toggle-navigation ul li{ font-size: 13px; border-bottom: 1px solid rgba(0, 0, 0, 0.11); padding: 11px 0px; width: 25%; float: left; text-align: center; margin-top: 6px }
.toggle-navigation ul ul{ display: none }
.toggle-navigation ul li a{ color: #eee; padding: 15px; }
.toggle-navigation{ display: none; background: #444; }
.toggle-text{ color: #fff; font-size: 12px; text-transform: uppercase; letter-spacing: 3px; display: inherit; text-align: center; }
.toggle-text:before{ content: "..."; font-size: 32px; font-family: georgia; line-height: 0px; margin-left: 0px; letter-spacing: 1px; top: -3px; position: relative; padding-right: 10px; }
.nav_container:hover + .toggle-navigation, .toggle-navigation:hover, .toggle-navigation:active, .toggle-navigation:focus{ display: inline-block; width: 100%; }
/* Category 2 */
.category-widget-wrapper{ padding:30px 15% 10px 15% }
.amp-category-block ul{ list-style-type:none;padding:0 }
.amp-category-block-btn{ display: block; text-align: center; font-size: 13px; margin-top: 15px; border-bottom: 1px solid #f1f1f1; text-decoration: none; padding-bottom: 8px;}
.category-widget-gutter h4{ margin-bottom: 0px;}
.category-widget-gutter ul{ margin-top: 10px; list-style-type:none; padding:0 }
.amp-category-post{ width: 32%;display: inline-block; word-wrap: break-word;float: left;}
.amp-category-post amp-img{ margin-bottom:5px; }
.amp-category-block li:nth-child(3){ margin: 0 1%;}
<?php if(function_exists('amp_woocommerce_pro_add_woocommerce_support') && ampforwp_get_setting('amp-swift-cart-btn')){?>
.searchmenu{  
    right: 42px;
}
<?php }else{?>
.searchmenu{  
    right: 15px;
}
<?php }?>
.searchmenu{  
    top: 31%;
    position: absolute; }
.searchmenu button{ background:transparent; border:none }
.closebutton{ background: transparent; border: 0; color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(255, 255, 255, 0.7); border-radius: 30px; width: 32px; height: 32px; font-size: 12px; text-align: center; position: absolute; top: 12px; right: 20px; outline:none }
amp-lightbox{ background: rgba(0, 0, 0,0.85); }
/* CSS3 icon */

[class*=icono-]:after, [class*=icono-]:before { content: ''; pointer-events: none; }
.icono-search:before{ position: absolute; left: 50%; -webkit-transform: rotate(270deg); -ms-transform: rotate(270deg); transform: rotate(270deg); width: 2px; height: 9px; box-shadow: inset 0 0 0 32px; top: 0px; border-radius: 0 0 1px 1px; left: 14px; }
[class*=icono-] { display: inline-block; vertical-align: middle; position: relative; font-style: normal; color: #f42; text-align: left; text-indent: -9999px; direction: ltr }
<?php if( true == ampforwp_get_setting('amp-design-2-search-feature') ) {  ?>
.icono-search { -webkit-transform: translateX(-50%); -ms-transform: translateX(-50%); transform: translateX(-50%) }
.icono-search { border: 1px solid; width: 10px; height: 10px; border-radius: 50%; -webkit-transform: rotate(45deg); -ms-transform: rotate(45deg); transform: rotate(45deg); margin: 4px 4px 8px 8px; }
.searchform label{ color: #f7f7f7; display: block; font-size: 10px; letter-spacing: 0.3px; line-height: 0; opacity:0.6 }
.searchform{ background: transparent; left: 20%; position: absolute; top: 35%; width: 60%; max-width: 100%; transition-delay: 0.5s; }
.searchform input{ background: transparent; border: 1px solid #666; color: #f7f7f7; font-size: 14px; font-weight: 400; line-height: 1; letter-spacing: 0.3px; text-transform: capitalize; padding: 20px 0px 20px 30px; margin-top: 15px; width: 100%; }
#searchsubmit{opacity:0}
<?php } // search condition ends ?>
.headerlogo a, [class*=icono-]{ color: #F42F42 }
<?php if( !ampforwp_woocommerce_conditional_check() ) { ?>
/* Pagination */
.amp-wp-content.pagination-holder { background: none; padding: 0; box-shadow: none; height: auto; min-height: auto; }
#pagination{ width: 100%; margin-top: 15px; }
#pagination .next{ float: right;max-width:50%;text-align: right;}
#pagination .prev{ float: left;max-width:50%; }
#pagination .next a, #pagination .prev a{ margin-bottom: 12px; -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px; -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05); -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05); box-shadow: 0 2px 3px rgba(0,0,0,.05); padding: 11px 15px; font-size: 12px;}
#pagination .next a, #pagination .prev a{
	color:#666666;
    background:#fefefe;
    display:inline-block;
}
<?php } // AMP Woocommerce condition ends ?>
<?php 
if(is_single() || is_page() ){?>
/* Sticky Social bar in Single */
.ampforwp-social-icons-wrapper{ margin: 0.65em 0px 0.65em 0px; height: 28px; }
.s_so{ width: 100%; bottom: 0; display: block; left: 0; box-shadow: 0px 4px 7px #000; background: #fff; padding: 7px 0px 0px 0px; position: fixed; margin: 0; z-index: 10; text-align: center; }
.a-so-i{ width: 50px; height: 28px; display: inline-block; background: #5cbe4a;position: relative; top: -8px; padding-top: 0px; margin-bottom:5px; }
.a-so-i amp-img{ top: 4px; }
amp-social-share[type="facebookmessenger"] {
  background-image: url(https://img.icons8.com/color/100/000000/facebook-messenger.png);
  max-height: 33px;   
}
<?php if ( true == ampforwp_get_setting('enable-single-facebook-share-messenger') ) { ?>
.a-so-i.a-so-facebookmessenger {background: #d5e1e6;text-align: center;}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-line-share') ) { ?>
.custom-amp-socialsharing-line{background:#00b900}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-mewe-share') ) { ?>
.custom-amp-socialsharing-mewe{background:#b8d6e6}
.a-so-mewe{background:#b8d6e6}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-flipboard-share') ) { ?>
.custom-amp-socialsharing-flipboard{background:#f52828;position: relative;
    top: -12px;}
.a-so-flipboard{background:#f52828;text-align: center;position: relative;
    top: -12px;}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-vk-share') ) { ?>
.ampforwp-social-icons .custom-amp-socialsharing-vk, .a-so-vk{background:#45668e}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-odnoklassniki-share') ) { ?>
.a-so-odnoklassniki{background:#ed812b}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-reddit-share') ) { ?>
.a-so-reddit{background:#ff4500}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-telegram-share') ) { ?>
.a-so-telegram{background:#61A8DE}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-tumblr-share') ) { ?>
.a-so-tumblr{background:#35465c}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-stumbleupon-share') ) { ?>
.a-so-stumbleupon{background:#eb4924}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-wechat-share') ) { ?>
.a-so-wechat{background:#7bb32e}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-viber-share') ) { ?>
.a-so-viber{background:#8f5db7}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-hatena-bookmarks') ) { ?>
.a-so-hatena{background:#00a4de}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-pocket-share') ) { ?>
.a-so-pocket{background:#e8e8e8}
<?php } ?>
<?php }?>
/* Header */
header.container{line-height: 0;}
#header{ background: #fff; text-align: center;padding:17px 0px 17px 0px;display: inline-block;width: 100%;position:relative}
#header h1{ text-align: center; font-size: 20px; font-weight: bold; line-height: 1; padding: 4px 3px; margin: 0; }
.amp-logo{left: 0;right: 0;display:inline-block} 
.amp-logo amp-img{ margin: 15px 0px 10px 0px; }
.amp-logo amp-img{margin: 0 auto;}
main { padding: 30px 15% 10px 15%; }
<?php if (checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && (is_singular() || ampforwp_is_front_page() )){ ?>
	main { padding: 0px; }
<?php } ?>
.amp-wp-content.widget-wrapper{padding:12px 10px 10px 10px;}
main .amp-wp-content{ margin-bottom: 12px;  padding: 15px; }
.amp-loop-list, .featured-image-content, .the_content, .taxonomy-description, .taxonomy-image{background: #fff; -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px; -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05); -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05); box-shadow: 0 2px 3px rgba(0,0,0,.05);}
.home-post_image{ float: right; margin-left: 15px; margin-bottom: -6px; }
.amp-wp-title{ margin-top: 0px; }
h2.amp-wp-title , h3.amp-wp-title{ line-height: 30px; }
h2.amp-wp-title a , h3.amp-wp-title a{ font-weight: 300; color: #000; font-size: 20px; }
h2.amp-wp-title , h3.amp-wp-title , .amp-wp-post-content p{ margin: 0 0 0 5px; word-wrap: break-word;}
/* For Excerpt */
.amp-wp-post-content .large-screen-excerpt, .amp-wp-post-content .small-screen-excerpt {
	display: block;
}
.amp-wp-post-content p{ font-size: 12px; color: #999; line-height: 20px; margin: 3px 0 0 5px; }
main .amp-archive-heading{ background : none; box-shadow: none; padding: 5px; }
.amp-sub-archives li{width: 50%;} .amp-sub-archives ul{padding: 0;list-style: none;display: flex;font-size: 12px;line-height: 1.2;margin: 5px 0 10px 0px;}.page-title{font-size: 1.17em;padding: 6px 0;}
<?php if(is_author()){ ?> .author-archive amp-img{border-radius: 50%;margin: 0px 8px 10px;display: block;}.author-archive{float: left;} .amp-wp-content .taxonomy-description{background: #f1f1f1; padding:0px} .page-title{padding:0} <?php } ?>

/* Footer */
<?php
$footer_back_color    = ampforwp_get_setting('ampforwp-footer-background-color-2','color');
$footer_hdng_color    = ampforwp_get_setting('d2-footer-hdng-color','color');
$footer_txt_color     = ampforwp_get_setting('d2-footer-txt-color','color');
$footer_link_color    = ampforwp_get_setting('d2-footer-link-color','color');
$footer_brdr_color    = ampforwp_get_setting('d2-footer-brdr-color','color');

if (empty($footer_back_color)) {
 $footer_back_color = '#FFFFFF'; 
} 
if (empty($footer_hdng_color)) {
 $footer_hdng_color = '#222222'; 
} 
if (empty($footer_txt_color)) {
 $footer_txt_color = '#222222'; 
} 
if (empty($footer_link_color)) {
 $footer_link_color = '#0074A7';
} 
if (empty($footer_brdr_color)) {
 $footer_brdr_color = '#eeeeee'; 
} 


?>
#footer{ background: <?php echo ampforwp_sanitize_color($footer_back_color);?>; font-size: 13px; text-align: center; letter-spacing: 0.2px; padding: 20px 0;color: <?php echo ampforwp_sanitize_color($footer_txt_color);?>;}
#footer a{color:<?php echo ampforwp_sanitize_color($footer_link_color);?>;}
#footer p:first-child{ margin-bottom: 12px; }
#footer p{ margin: 0 }
.footer_menu ul{ list-style-type: none; padding: 0; text-align: center; margin: 0px 20px 25px 20px; line-height: 27px; font-size: 13px }
.footer_menu ul li{ display:inline; margin:0 10px; }
.footer_menu ul li:first-child{ margin-left:0 }
.footer_menu ul li:last-child{ margin-right:0 }
.footer_menu ul ul{ display:none }
a.btt:hover {
    cursor: pointer;
}
.nav_container { 
	background:  <?php echo ampforwp_sanitize_color($header_bg_clr); ?>
}
.nav_container a, .nav_container a:hover, .nav_container a:focus{ 
	color:<?php echo sanitize_hex_color( $header_elements_clr ); ?> 
}
<?php if( !ampforwp_woocommerce_conditional_check() ) { ?>
<?php if(is_singular() || is_home() && true == ampforwp_get_setting('amp-frontpage-select-option') && ampforwp_get_blog_details() == false && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ){ ?>
/* Single */
.cmt-button-wrapper{ margin-bottom: 0px; margin-top: 60px; text-align:center }
.cmt-button-wrapper a{ color: #fff; background: #312c7e; font-size: 13px; padding: 10px 20px 10px 20px; box-shadow: 0 0px 3px rgba(0,0,0,.04); border-radius: 80px; }
h1.amp-wp-title , h2.amp-wp-title{ text-align: center; margin: 0.7em 0px 0.6em 0px; font-size: 1.5em; }
.amp-wp-content.post-title-meta, .amp-wp-content.post-pagination-meta{ background: none; padding:  0; box-shadow:none }
.post-pagination-meta{ min-height:75px }
.single-post .post-pagination-meta{ min-height:auto }
.single-post .ampforwp-social-icons{ display:block }
.post-pagination-meta .amp-wp-tax-category, .post-title-meta .amp-wp-tax-tag{ display : none; }
.amp-meta-wrapper{ border-bottom: 1px solid #DADADA; padding-bottom:10px; display:inline-block; width:100%; margin-bottom:0 }
.amp-wp-meta{ padding-left: 0; }
.amp-wp-tax-category{ float:right }
.amp-wp-tax-tag, .amp-wp-meta li{ list-style: none; display: inline-block; }
li.amp-wp-tax-category{ float: right }
.amp-wp-byline, .amp-wp-posted-on{ float: left }
.amp-wp-content amp-img{ max-width: 100%; }
figure{ margin: 0; }
figcaption{ font-size: 11px; margin-bottom: 11px; background: #eee; padding: 6px 8px;text-align:center; }

.amp-wp-author:before{ content: "By "; color: #555; }
.amp-wp-author{ margin-right: 1px; }
.amp-wp-meta{ font-size: 12px; color: #555; }
.amp-wp-author-name:before{content:'By';}
.amp-ad-wrapper{ text-align: center }
<?php if ( !checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>
.single-post main{ padding:12px 15% 10px 15% }
<?php } ?>
.the_content p{ margin-top: 5px; color: #333; font-size: 15px; line-height: 26px; margin-bottom: 15px;word-break: break-word; }
.the_content small{font-size:11px;line-height:1.2;color:#111;margin-bottom: 5px;display: inline-block;}
.amp-wp-tax-tag{ font-size: 13px; border: 0; display: inline-block; margin: 0.5em 0px 0.7em 0px; width: 100%; }
main .amp-wp-content.featured-image-content{ padding: 0px; border: 0; margin-bottom: 0; box-shadow: none;text-align: center; }
.amp-wp-article-featured-image amp-img {margin: 0 auto;}
.amp-wp-article-featured-image.wp-caption .wp-caption-text, .ampforwp-gallery-item .wp-caption-text{color: #696969; font-size: 11px; line-height: 15px; background: #eee; margin: 0; padding: .66em .75em; text-align: center;}
.ampforwp-gallery-item.amp-carousel-slide { padding-bottom: 20px;}
.amp-wp-content.post-pagination-meta{ max-width: 1030px;margin:0 auto; }
.single-post .ampforwp-social-icons.ampforwp-social-icons-wrapper{ margin: 0.9em auto 0.9em auto ; max-width: 1030px; }
.amp-wp-article-header.amp-wp-article-category.ampforwp-meta-taxonomy{ margin: 10px auto; max-width: 1030px; } .ampforwp_single_excerpt { margin-bottom:15px; font-size: 15px; text-align:center}
.single-post .amp_author_area amp-img{ margin: 0; float: left; margin-right: 12px; border-radius: 60px; }
.single-post .amp_author_area .amp_author_area_wrapper{ display: inline-block; width: 100%; line-height: 1.4; margin-top: 2px; font-size: 13px; color:#333;}
.a-so-twitter{background:#1da1f2}
.a-so-i-rounded-author {padding: 10px 0px 10px 10px;display: inline-table;border-radius: 50%;cursor: pointer;}
<?php if(is_single()){
if( $redux_builder_amp['ampforwp-single-select-type-of-related'] ){ ?>
/* Related Posts */
main .amp-wp-content.relatedpost{ background: none; box-shadow: none; max-width: 1030px; padding:0px 0 0 0; margin:1.8em auto 1.5em auto }
 .rp .related-title, .cmts_list h3{ font-size: 14px; font-weight: bold; letter-spacing: 0.4px; margin: 15px 0 10px 0; color: #333; }
.rp .related-title {
	display: block;
}
.rp ol{ list-style-type:none; margin:0; padding:0 }
.rp ol li{ display:inline-block; width:100%; margin-bottom: 12px; background: #fefefe; -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px; -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05); -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05); box-shadow: 0 2px 3px rgba(0,0,0,.05); padding: 0px; }
.rp .related_link{ margin-top:18px; margin-bottom:10px; margin-right:10px }
.rp .related_link a{ font-weight: 300; color: #000; font-size: 18px; }
.rp ol li amp-img{ width:100px; float:left; margin-right:15px }
.rp ol li p{ font-size: 12px; color: #999; line-height: 1.2; margin: 12px 0 0 0;word-break: break-word;}
.no_related_thumbnail{ padding: 15px 18px; }
.no_related_thumbnail .related_link{ margin: 16px 18px 20px 19px; }
<?php } }
 ?>
/* Comments */
.page-numbers{padding: 9px 10px;background: #fff;font-size: 14px}
.ampforwp-comment-wrapper{margin:1.8em 0px 1.5em 0px}
main .amp-wp-content.cmts_list {background: none;box-shadow: none;max-width: 1030px;padding:0}
.cmts_list div{ display:inline-block;}
.cmts_list ul{ margin:0;padding:0}
.cmts_list ul.children{ padding-bottom:10px; margin-left: 4%; width: 96%;} 
.cmts_list ul li p{ margin:0;font-size:15px;clear:both;padding-top:16px; word-break: break-word;}
.cmts_list ul li{ font-size:13px;list-style-type:none; margin-bottom: 12px; background: #fefefe; -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px; -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05); -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05); box-shadow: 0 2px 3px rgba(0,0,0,.05);padding: 0px;max-width: 1000px;width:100%;}
.cmts_list ul li .cmt-body{ padding: 25px;width: 91%;}
.cmts_list ul li .cmt-body .cmt-author{ margin-right:5px}
.cmt-author{ float:left }
.cmt-author-img{float: left; margin-right: 5px; border-radius: 60px;}
.single-post footer.cmt-meta{ padding-bottom: 0; line-height: 1.7;}
.cmts_list li li{ margin: 20px 20px 10px 20px;background: #f7f7f7;box-shadow: none;border: 1px solid #eee;}
.cmts_list li li li{ margin:20px 20px 10px 20px}
.cmt-content amp-img{max-width: 300px;}
<?php } ?>
<?php if ( isset($redux_builder_amp['ampforwp-disqus-comments-support']) && $redux_builder_amp['ampforwp-disqus-comments-support'] ) {?>
.amp-disqus-comments { text-align:center } <?php 
} ?>
.amp-facebook-comments{margin-top:45px}
/* ADS */
.amp_home_body .amp_ad_1{ margin-top: 10px; margin-bottom: -20px; }
.single-post .amp_ad_1{ margin-top: 10px; margin-bottom: -20px; }
html .single-post .ampforwp-incontent-ad-1 { margin-bottom: 10px; }
.amp-ad-4{ margin-top:10px; }
.amp-wp-content blockquote { border-left: 3px solid; margin: 0; padding: 15px 20px 8px 24px; background: #f3f3f3; }
pre { white-space: pre-wrap; }
/* Tables */
table { display: -webkit-box; display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; overflow-x: auto; }
table a:link { font-weight: bold; text-decoration: none; }
table a:visited { color: #999999; font-weight: bold; text-decoration: none; }
table a:active,
table a:hover { color: #bd5a35; text-decoration: underline; }
table { color: #666; font-size: 12px; text-shadow: 1px 1px 0px #fff; background: inherit; margin: 0px; width: 95%; }
table th { padding: 21px 25px 22px 25px; border-top: 1px solid #fafafa; border-bottom: 1px solid #e0e0e0; background: #ededed; background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb)); background: -moz-linear-gradient(top, #ededed, #ebebeb); }
table th:first-child { text-align: left; padding-left: 20px; }
table tr:first-child th:first-child { -moz-border-radius-topleft: 3px; -webkit-border-top-left-radius: 3px; border-top-left-radius: 3px; }
table tr:first-child th:last-child { -moz-border-radius-topright: 3px; -webkit-border-top-right-radius: 3px; border-top-right-radius: 3px; }
table tr { text-align: center; padding-left: 20px;border: 2px solid #eee; }
table td:first-child { text-align: left; padding-left: 20px; border-left: 0; }
table td { padding: 18px; border-top: 1px solid #ffffff; border-bottom: 1px solid #e0e0e0; border-left: 1px solid #e0e0e0; background: #fafafa; background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa)); background: -moz-linear-gradient(top, #fbfbfb, #fafafa); }
table tr.even td { background: #f6f6f6; background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6)); background: -moz-linear-gradient(top, #f8f8f8, #f6f6f6); }
table tr:last-child td {border-bottom: 0;}
table tr:last-child td:first-child { -moz-border-radius-bottomleft: 3px; -webkit-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px; }
table tr:last-child td:last-child { -moz-border-radius-bottomright: 3px; -webkit-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; }
table tr:hover td { background: #f2f2f2; background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0)); background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0); }
.hide-meta-info{ display: none; }
<?php if( $redux_builder_amp['amp-enable-notifications'] == 1 || isset($redux_builder_amp['ampforwp-cta-subsection-notification-sticky']) && $redux_builder_amp['ampforwp-cta-subsection-notification-sticky'] == 1 ){ ?>
/* Notifications */
#amp-user-notification1 p { display: inline-block; }
amp-user-notification { padding: 5px; text-align: center; background: #fff; border-top: 1px solid; }
amp-user-notification button { padding: 8px 10px; background: #000; color: #fff; margin-left: 5px; border: 0; }
.amp-not-privacy{color:<?php echo sanitize_hex_color( $header_background_color ); ?>;text-decoration: none;font-size: 15px;margin-left: 2px;}
amp-user-notification button:hover { cursor: pointer }
<?php } ?>
/* Responsive */
@media screen and (min-width: 650px) { table {display: inline-table;}  }
@media screen and (max-width: 800px) { .single-post main{ padding: 12px 10px 10px 10px } }
@media screen and (max-width: 630px) { .related_link { margin: 16px 18px 20px 19px; } .amp-category-post {line-height: 1.45;font-size: 14px; } .amp-category-block li:nth-child(3) {margin:0 0.6%} }
@media screen and (max-width: 510px) { .ampforwp-tax-category span{ display:none }
.rp ol li p{ line-height: 1.6; margin: 7px 0 0 0; }
.rp .related_link { margin: 17px 18px 17px 19px; }
.cmts_list ul li .cmt-body{ width:auto }
}
@media screen and (max-width: 425px) { .alignright, .alignleft {float: none;} .rp .related_link { margin: 13px 18px 14px 19px; } .rp .related_link a{ font-size: 18px; line-height: 1.7; } .amp-meta-wrapper{ display: inline-block; margin-bottom: 0px; margin-top: 8px; width:100% } .ampforwp-tax-category{ padding-bottom:0 } h1.amp-wp-title{ margin: 16px 0px 13px 0px; } .amp-wp-byline{ padding:0 }   .rp .related_link a { font-size: 17px; line-height: 1.5; } .amp-wp-post-content .large-screen-excerpt, .related_link .large-screen-excerpt {display:none;} }
@media screen and (max-width: 375px) { #pagination .next a, #pagination .prev a{ padding: 10px 6px; font-size: 11px; color: #666; } .rp .related-title, .cmts_list h3{ margin-top:15px; } #pagination .next{ margin-bottom:15px;} .rp .related_link a { font-size: 15px; line-height: 1.6; } }
@media screen and (max-width: 340px) { .rp .related_link a { font-size: 15px; } .single-post main{ padding: 10px 5px 10px 5px } .the_content .amp-ad-wrapper{ text-align: center; margin-left: -13px; } .amp-category-post {line-height: 1.45;font-size: 12px; } .amp-category-block li:nth-child(3) {margin:0%} }
@media screen and (max-width: 320px) { .rp .related_link a { font-size: 13px; } h1.amp-wp-title{ font-size:17px; padding:0px 4px	} }
@media screen and (max-width: 400px) { .amp-wp-title{ font-size: 19px; margin: 21px 10px -1px 10px; } }
@media screen and (max-width: 767px) { .amp-wp-post-content .small-screen-excerpt { display: block; } main, .amp-category-block, .category-widget-wrapper{ padding: 15px 18px 0px 18px; } .toggle-navigation ul li{ width: 50% } 
#pagination .next{ width:100%;}
#pagination .prev{ float: none;width:100%; }   }
@media screen and (max-width: 495px) { h2.amp-wp-title a{ font-size: 17px; line-height: 26px;} }
<?php if($redux_builder_amp['amp-rtl-select-option'] == true) { ?>
header, amp-sidebar, article, footer, main { direction: rtl; }
.amp-wp-header .amp-wp-site-icon { position: relative;float: left; }
.amp-wp-header .nav_container { float: left;right: initial;left: -11px; }
.amp-wp-header .amp-wp-site-icon { top: -3px;right: initial;left: -11px; }
.amp-wp-byline, .amp-wp-posted-on { float:right }
.amp-wp-tax-category { float:left }
.rp ol li amp-img { float:right; margin-right:0px; margin-left:15px }
main .amp-archive-heading { direction:rtl }
.searchform { direction:rtl }
.closebutton { right:0; left:20px }
.amp-meta-wrapper { padding-right:0 }
.cmt-author { float:right; margin-left:5px; }
.amp-ad-wrapper, .amp-wp-article amp-ad{ direction: ltr; }
.toggle-navigationv2 ul li a { padding: 15px 8px; width: 95%;}
amp-carousel{direction: ltr;} .tt-lb{float:right;margin-left:5px;}
.amp-wp-content.widget-wrapper{margin:20px auto;}
.amp_widget_above_the_footer{direction:rtl;}
@media(max-width:768px){
.amp-wp-content.widget-wrapper{margin: 15px;}
}
<?php } ?>
.amp-wp-tax-tag a, a, .amp-wp-author, .headerlogo a, [class*=icono-] { color: <?php echo sanitize_hex_color( $header_background_color ); ?>;; }
body a {color: <?php echo ampforwp_sanitize_color($redux_builder_amp['amp-opt-color-rgba-link-design2']['color']);?> }
.amp-wp-content blockquote{ border-color:<?php echo sanitize_hex_color( $header_background_color ); ?>;; }
.cmt-button-wrapper a { background:  <?php echo sanitize_hex_color( $header_background_color ); ?>;; }
amp-user-notification { border-color:  <?php echo sanitize_hex_color( $header_background_color ); ?>;; }
amp-user-notification button { background-color:  <?php echo sanitize_hex_color( $header_background_color ); ?>;; }
<?php if( ampforwp_get_setting('enable-single-social-icons') == true && is_socialshare_or_socialsticky_enabled_in_ampforwp() && is_single() )  { ?>
.single-post footer { padding-bottom: 40px; }
.amp-ad-2{ margin-bottom: 50px; }
.body.single-post .s_so{z-index:99999;}
.body.single-post .adsforwp-stick-ad, .body.single-post amp-sticky-ad{padding-top:4px;padding-bottom:48px;}
.body.single-post .ampforwp-sticky-custom-ad{
	bottom: 43px;
    padding: 4px 0px 0px;
}
.body.single-post .afw a{line-height:0;}
.body.single-post amp-sticky-ad amp-sticky-ad-top-padding{height:0px;}
<?php }  
if( ampforwp_get_setting('ampforwp-advertisement-sticky-type') == 3) {?>
  .btt{z-index:9999;}
<?php } // advanced ads type 3 ends here ?>
/**/
.amp-wp-author:before{ content: " <?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-by-text'], 'By '); ?>  "; }
.ampforwp-tax-category span:first-child:after { content: ' '; }
.ampforwp-tax-category span:after,.ampforwp-tax-tag span:after { content: ', '; }
.ampforwp-tax-category span:last-child:after, .ampforwp-tax-tag span:last-child:after { content: ' '; }
.amp-wp-article-content img { max-width: 100%; }
<?php if ($redux_builder_amp['ampforwp-callnow-button']) { ?>
.callnow{ left: 58px; top: 36%; position: absolute;
} 
.callnow a:before { content: ""; position: absolute; right: 23px; width: 4px; height: 8px; border-width: 6px 0 6px 3px; border-style: solid; border-color:<?php echo ampforwp_sanitize_color($redux_builder_amp['amp-opt-color-rgba-colorscheme-call']['color']); ?>; background: transparent; transform: rotate(-30deg); box-sizing: initial; border-top-left-radius: 3px 5px; border-bottom-left-radius: 3px 5px; }
<?php } ?>
<?php if ( class_exists('TablePress') ) { ?>
.tablepress-table-description {	clear: both; display: block; }
.tablepress { border-collapse: collapse; border-spacing: 0; width: 100%; margin-bottom: 1em; border: none; }
.tablepress th, .tablepress td { padding: 8px; border: none; background: none; text-align: left; }
.tablepress tbody td { vertical-align: top; }
.tablepress tbody td, .tablepress tfoot th { border-top: 1px solid #dddddd; }
.tablepress tbody tr:first-child td { border-top: 0; }
.tablepress thead th { border-bottom: 1px solid #dddddd; }
.tablepress thead th, .tablepress tfoot th { background-color: #d9edf7;	font-weight: bold; vertical-align: middle; }
.tablepress .odd td {	background-color: #f9f9f9; }
.tablepress .even td { background-color: #ffffff; }
.tablepress .row-hover tr:hover td { background-color: #f3f3f3; }
@media (min-width: 768px) and (max-width: 1600px) {.tablepress { overflow-x: none; } }
@media (min-width: 320px) and (max-width: 767px) {.tablepress { display: inline-block; overflow-x: scroll; } }
<?php }  ?>
<?php } // AMP Woocommerce condition Ends Here?>
.design_2_wrapper .amp-loop-list .amp-wp-meta {display: none;}
<?php if(!is_home() && ((is_single() && true == ampforwp_get_setting('ampforwp-bread-crumb') ) || (is_page() && ampforwp_get_setting('ampforwp_pages_breadcrumbs')) ) && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) { ?>
.breadcrumb{line-height: 1;margin-bottom:6px;}
.breadcrumb ul, .category-single ul{padding:0; margin:0;}
.breadcrumb ul li{display:inline;}
.breadcrumb ul li a, .breadcrumb ul li span{font-size:12px;}
.breadcrumb ul li a::after {content: "►";display: inline-block;font-size: 8px;padding: 0 6px 0 7px;vertical-align: middle;opacity: 0.5;position:relative;top: -0.5px;}
.breadcrumb ul li:hover a::after{color:#c3c3c3;}
.breadcrumb .bread-post{color: #555;}
.breadcrumb ul li:last-child a::after{display:none;}
<?php } ?> 
.amp-menu > li > a > amp-img, .sub-menu > li > a > amp-img { display: inline-block; margin-right: 4px; }
.menu-item amp-img {width: 16px; height: 11px; display: inline-block; margin-right: 5px;}
.amp-carousel-container {position: relative;width: 100%;height: 100%;} 
.amp-carousel-img img {object-fit: contain;}
/* Slide Navigation code */
.amp-menu li{position:relative;margin:0;}
.amp-menu li.menu-item-has-children ul{display:none;margin:0;background:#222}
.amp-menu li.menu-item-has-children ul ul{background:#444}
.amp-menu input{display:none}
.amp-menu [id^=drop]:checked + label + ul{ display: block;}
.amp-menu .toggle:after{content:'\25be';position:absolute;padding: 10px 15px 10px 30px;right:0;font-size:18px;color:<?php echo ampforwp_sanitize_color($menu_icon_clr); ?>;top:5px;z-index:10000;line-height:1}
.amp-ad-wrapper span { display: inherit; font-size: 12px; line-height: 1;}
<?php // Ads (sitewide)
if( ( isset($redux_builder_amp['enable-amp-ads-1'] ) && $redux_builder_amp['enable-amp-ads-1'] ) || ( isset($redux_builder_amp['enable-amp-ads-2'] ) && $redux_builder_amp['enable-amp-ads-2'] ) ){ ?> .amp-ad-wrapper{ text-align: center } .amp-ad-wrapper{ text-align: center; margin-left: -13px; } .amp-ad-wrapper, .amp-wp-article amp-ad{ direction: ltr; } .amp-ad-2{ margin-bottom: 50px; } .amp_home_body .amp_ad_1{ margin-top: 10px; margin-bottom: -20px; }<?php }
if ( true == $redux_builder_amp['amp-pagination'] ) { ?>
.ampforwp_post_pagination{width:100%;text-align:center;display:inline-block;}
<?php } 
$custom_css = ampforwp_get_setting('css_editor');
$custom_css = str_replace(array('.accordion-mod'), array('.apac'), $custom_css);
$sanitized_css = ampforwp_sanitize_i_amphtml($custom_css);
echo $sanitized_css;//sanitized above
//} ?>
<?php 
if (ampforwp_get_setting('enable-amp-ads-resp-1')){?>
.amp-ad-1 {
    max-width: 1000px;
}
<?php } ?>
<?php 
if (ampforwp_get_setting('enable-amp-ads-resp-2')){?>
.amp-ad-2 {
    max-width: 1000px;
}
<?php } ?>
<?php 
if (ampforwp_get_setting('enable-amp-ads-resp-3')){?>
.amp-ad-3 {
    max-width: 1000px;
}
<?php } ?>
<?php 
if (ampforwp_get_setting('enable-amp-ads-resp-4')){?>
.amp-ad-4 {
    max-width: 1000px;
}
<?php } ?>
<?php 
if (ampforwp_get_setting('enable-amp-ads-resp-5')){?>
.amp-ad-5 {
    max-width: 1000px;
}
<?php } ?>
<?php 
if (ampforwp_get_setting('enable-amp-ads-resp-6')){?>
.amp-ad-6 {
    max-width: 1000px;
}
<?php } ?> 
<?php // Widgets CSS
if ( is_active_sidebar( 'ampforwp-above-footer'  ) || is_active_sidebar( 'ampforwp-below-header'  ) || is_active_sidebar( 'ampforwp-above-loop'  ) || is_active_sidebar( 'ampforwp-below-loop'  ) ) : ?>
.f-w{display: inline-flex;width:100%;flex-wrap:wrap;}
.w-bl{margin-left: 0;display: flex;flex-direction: column;position: relative;flex: 1 0 22%;margin:0 15px 30px;line-height:1.5;font-size:14px;}
.w-bl h4{font-size: <?php echo ampforwp_get_setting('swift-head-size'); ?>;font-weight: <?php echo ampforwp_get_setting('swift-head-fntwgth'); ?>;margin-bottom: 20px;text-transform: uppercase;letter-spacing: 1px;padding-bottom: 4px;}
.w-bl ul{padding:0;margin:0;}
.w-bl ul li{list-style-type: none;margin-bottom: 15px;}
.w-bl ul li:last-child{margin-bottom:0;}
.w-bl ul li a{text-decoration: none;}
.w-bl .menu li .sub-menu, .w-bl .lb-x{display:none;}
.w-bl table {
    border-collapse: collapse;
    margin: 0 0 1.5em;
    width: 100%;
}
.w-bl tr {
    border-bottom: 1px solid #eee;
}
.w-bl th, .w-bl td {
    text-align: center;
}
.w-bl td {
  padding: 0.4em;
}
.w-bl th:first-child, .w-bl td:first-child {
    padding-left: 0;
}
.w-bl thead th {
    border-bottom: 2px solid #bbb;
    padding-bottom: 0.5em;
    padding: 0.4em;
}
.w-bl .calendar_wrap caption{
  font-size: 14px;
    margin-bottom: 10px;
}
.w-bl form{
  display:inline-flex;
  flex-wrap:wrap;
  align-items: center;
}
.w-bl .search-submit{
  text-indent: -9999px;
    padding: 0;
    margin: 0;
    background: transparent;
    line-height: 0;
    display: inline-block;
    opacity: 0;
}
.w-bl .search-field{
  border: 1px solid #ccc;
    padding: 6px 10px;
}
<?php endif; ?>
@media(max-width:480px){
  <?php if ( is_active_sidebar( 'ampforwp-above-footer'  ) || is_active_sidebar( 'ampforwp-below-header'  ) || is_active_sidebar( 'ampforwp-above-loop'  ) || is_active_sidebar( 'ampforwp-below-loop'  ) ) : ?>
    .f-w{ display: inline-block;}
    .w-bl{flex:1 0 100%;}
  <?php endif; ?>
}
 <?php if(true == ampforwp_get_setting('ampforwp-smooth-scrolling-for-links')){?>
    html {
   scroll-behavior: smooth;
  }
<?php } 
// Infinate Scroll Home & Archive page CSS
if( true == ampforwp_get_setting('ampforwp-infinite-scroll') && ampforwp_get_setting('ampforwp-infinite-scroll-home') ){ ?>
	amp-next-page{
		margin:30px -22% 0px -22%;
	}
	@media(max-width:767px){
		amp-next-page {
	    	margin: 17px -2.6% 0px -2.5%;
		}
	}
	@media(max-width:450px){
		amp-next-page {
		    margin: 17px -4.6% 0px -4.6%;
		}
	}
<?php } 
// image floats removed in mobile view #2525
if(is_singular() || ampforwp_is_front_page()){?>
@media(max-width:480px){
.amp-wp-content .alignright , .amp-wp-content .alignleft {
  float:none;
  margin:0 auto;
}
}
<?php } ?> 
@media (min-width: 768px){
.wp-block-columns {
    display:flex;
}
.wp-block-column {
    max-width:50%;
    margin: 0px 10px;
}
}
/*** H-1 to H-6 Font Sizes ***/ 
.amp-wp-content.the_content h1, .amp-wp-content.the_content h2, .amp-wp-content.the_content h3, .amp-wp-content.the_content h4, .amp-wp-content.the_content h5, .amp-wp-content.the_content h6{margin: 15px 0px;}
<?php  // H1 - H6 Font Sizes 
if( ampforwp_get_setting('swift_cnt') &&  ampforwp_get_setting('swift_cnt_h1') ){ ?>
  .amp-wp-content.the_content h1{font-size:<?php echo esc_html( ampforwp_get_setting('swift_h1_sz') )?>;}
<?php } else { ?>
  .amp-wp-content.the_content h1 {font-size: 32px;}
<?php } //H1 ends
if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h2') ){ ?>
  .amp-wp-content.the_content h2{font-size:<?php echo esc_html( ampforwp_get_setting('swift_h2_sz') )?>;}
<?php } else { ?>
  .amp-wp-content.the_content h2 {font-size: 27px;}
<?php } // H2 Ends
if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h3') ){ ?>
  .amp-wp-content.the_content h3{font-size:<?php echo esc_html( ampforwp_get_setting('swift_h3_sz') )?>;}
<?php } else { ?>
  .amp-wp-content.the_content h3 {font-size: 24px;}
<?php } // H3 Ends
if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h4') ){ ?> 
  .amp-wp-content.the_content h4{font-size:<?php echo esc_html( ampforwp_get_setting('swift_h4_sz') )?>;}
<?php } else { ?>
  .amp-wp-content.the_content h4 {font-size: 20px;}
<?php } // H4 Ends
if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h5') ){ ?>
  .amp-wp-content.the_content h5{font-size:<?php echo esc_html( ampforwp_get_setting('swift_h5_sz') )?>;}
<?php } else { ?>
  .amp-wp-content.the_content h5 {font-size: 17px;}
<?php } // H5 Ends
if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h6') ){ ?>
  .amp-wp-content.the_content h6{font-size:<?php echo esc_html( ampforwp_get_setting('swift_h6_sz') )?>;}
<?php } else { ?>
  .amp-wp-content.the_content h6 {font-size: 15px;}
<?php } // H6 Ends
// swift Content Heading Sizes Ends
if(class_exists('MCI_Footnotes')){ ?>
	div#footnote_references_container{
		display: unset;
	}
	#fn_span{
    margin-left: 14px;
  }
<?php } ?>
<?php // Footer Widget Satyling
if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
.f-w-blk {
  max-width: 1000px;
  margin: 0 auto 20px auto;
  padding:20px 0px 0px 0px;
  border-bottom: 1px solid <?php echo ampforwp_sanitize_color($footer_brdr_color);?>;
}
.d3f-w .w-bl h4 {
    font-size: 12px;
    font-weight: 500;
    margin:0px 0px 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding-bottom: 4px;
    color:<?php echo ampforwp_sanitize_color( $footer_hdng_color ); ?>
}
.d3f-w .w-bl ul{
    margin:0;
    padding:0;
}
.d3f-w .w-bl ul li {
    list-style-type: none;
    margin-bottom: 15px;
}
.d3f-w {
    display: inline-flex;
    width: 100%;
    flex-wrap: wrap;
    text-align: left;
}
.d3f-w .w-bl {
    display: flex;
    flex-direction: column;
    position: relative;
    flex: 1 0 22%;
    margin: 0 15px 30px;
    line-height: 1.5;
    font-size: 14px;
    padding:0;
}
@media (max-width: 1000px){
  .d3f-w .f-w {
    margin: 0;
  }
  .d3f-w .w-bl{
    flex: 1 0 18%;
    margin:0px 10px 20px;
  }
}
@media (max-width: 480px){
  .d3f-w .w-bl {
      flex: 100%;
  }
  .f-w-blk {
    padding: 20px 10px 0px 10px;
  }
}
<?php endif; ?>
<?php // Notification CSS
if( ampforwp_get_setting('amp-enable-notifications') && ampforwp_get_setting('enable-single-social-icons') && is_single() ) { ?>
amp-user-notification{
  bottom:41px;
  z-index: 999999;
}
<?php } //amp-enable-notifications Condition Ends Here ?>   
amp-facebook-like{
  max-height: 28px;
}
<?php 
if(true == ampforwp_get_setting('ampforwp-single-related-posts-excerpt')){?>
	.rp .related_link a.readmore-rp {
	    font-size: 13px;
		margin-left: 5px;
		color: #999;
		font-weight: normal;
	}
<?php } ?>
.link-menu .toggle {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0px;
  right: 0;
  cursor:pointer;
}
.ampforwp-blocks-gallery-caption{
    font-size: 16px;
}

<?php if(ampforwp_get_setting('ampforwp-gallery-design-type')==3){?>
.ampforwp-gallery-item.amp-carousel-containerd3 {
    float: left;
}
.amp-carousel-containerd3 figcaption {
    max-width: 150px;
    border:none;
}
<?php } ?>