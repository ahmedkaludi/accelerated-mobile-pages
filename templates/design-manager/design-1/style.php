<?php
use AMPforWP\AMPVendor\AMP_Post_Template;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//add_action('amp_post_template_css', 'ampforwp_additional_style_input');
//function ampforwp_additional_style_input( $amp_template ) {
	global $redux_builder_amp;
	global $post;
	$post_id = '';
	$post_id = $post->ID;
	$get_customizer = new AMP_Post_Template( $post_id );
	$content_max_width       = absint( $get_customizer->get( 'content_max_width' ) );
	$theme_color             = $get_customizer->get_customizer_setting( 'theme_color' );
	$text_color              = $get_customizer->get_customizer_setting( 'text_color' );
	$muted_text_color        = $get_customizer->get_customizer_setting( 'muted_text_color' );
	$border_color            = $get_customizer->get_customizer_setting( 'border_color' );
	$link_color              = $get_customizer->get_customizer_setting( 'link_color' );
	$header_background_color = $get_customizer->get_customizer_setting( 'header_background_color' );
	$header_color            = $get_customizer->get_customizer_setting( 'header_color' );
?>
<?php // Design 1 Menu elemensts colors
$header_bg_clr          = ampforwp_get_setting('amp-d1-background-color','rgba');
$header_elements_clr    = ampforwp_get_setting('amp-d1-elements-color','color');
$menu_sidebar_clr       = ampforwp_get_setting('amp-d1-sidebar-color','color');
$menu_bg_clr            = ampforwp_get_setting('amp-d1-menu-bg-color','color');
$menu_elements_clr      = ampforwp_get_setting('amp-d1-menu-color','color');
$submenu_bg_clr         = ampforwp_get_setting('amp-d1-submenu-bg-color','color');
$menu_bdr_clr           = ampforwp_get_setting('amp-d1-menu-brdr-color','color');
$menu_icon_clr          = ampforwp_get_setting('amp-d1-menu-icon-color','color');
$cross_btn_clr          = ampforwp_get_setting('amp-d1-cross-btn-color','color');
$cross_btn_bg_clr       = ampforwp_get_setting('amp-d1-cross-bg-color','rgba');
$cross_btn_hvr_clr      = ampforwp_get_setting('amp-d1-cross-hover-color','rgba');

if(empty($header_bg_clr)){
  $header_bg_clr ='#04415D';
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

$icon_url =  plugin_dir_url(__FILE__) ;
$ds = ampforwp_get_setting('amp-design-selector');
$design = "swift";
if($ds!=4){
  $design = "design-$ds";
}
preg_match('/accelerated-mobile-pages/i', $icon_url, $matches);
if(count($matches)==0){
  $icon_url = plugin_dir_url('accelerated-mobile-pages/accelerated-moblie-pages.php').'templates/design-manager/'.esc_attr($design).'/';
}
$icon_url = ampforwp_font_url($icon_url);
?>
#statcounter{width: 1px;height:1px;}
.amp-wp-article amp-addthis{bottom: -38px;margin-left: 6px;}
<?php if(1==ampforwp_get_setting('ampforwp-google-font-switch') && ( ampforwp_get_setting('amp_font_selector') == 1 || empty(ampforwp_get_setting('amp_font_selector') ) ) ) {?> 
@font-face {
  font-family: 'Merriweather';
  font-display: swap;
  font-style: normal;
  font-weight: 400;
    src:  local('Merriweather'), local('Merriweather-Regular'), url('<?php echo esc_url($icon_url) ?>fonts/Merriweather-Regular.ttf');
}
@font-face {
  font-family: 'Merriweather';
  font-display: swap;
  font-style: normal;
  font-weight: 700;
    src:  local('Merriweather Bold'), local('Merriweather-Bold'), url('<?php echo esc_url($icon_url) ?>fonts/Merriweather-Bold.ttf');
}
@font-face {
    font-family: 'Merriweather';
    font-display: swap;
    font-style: italic;
    font-weight: 400;
    src:  local('Merriweather Italic'), local('Merriweather-Italic'), url('<?php echo esc_url($icon_url) ?>fonts/Merriweather-Italic.ttf');
}
@font-face {
  font-family: 'Merriweather';
  font-display: swap;
  font-style: italic;
  font-weight: 700;
    src:  local('Merriweather Bold Italic'), local('Merriweather-BoldItalic'), url('<?php echo esc_url($icon_url) ?>fonts/Merriweather-BoldItalic.ttf');
}
<?php } // fonts condition ends here ?>
.clearfix, .cb{clear:both}
.alignright{ float: right; }
.alignleft{ float: left; }
.aligncenter{ display: block; margin-left: auto; margin-right: auto; max-width: 100%;text-align:center; }
.amp-wp-enforced-sizes{ max-width: 100%; margin: 0 auto; }
.amp-wp-unknown-size img{ object-fit: contain; }
amp-iframe{ max-width: 100%; margin-bottom : 20px; }
amp-wistia-player {margin:5px 0px;}
.hide{display:none}
div#pagination a {color: #04415D;}
.amp-wp-article amp-addthis{bottom: -38px;}
.amp-wp-content,.amp-wp-title-bar div {<?php if ( $content_max_width > 0 ) : ?> margin: 0 auto;max-width: <?php echo esc_attr(sprintf( '%dpx', $content_max_width )); ?>; <?php endif; if((is_singular() || ampforwp_is_front_page()) && checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){?>
      max-width:100%;
    <?php } ?> }
html{background: <?php echo sanitize_hex_color( $header_background_color ); ?>;} 
body, .cmts_list ul li{
  background: <?php echo sanitize_hex_color( $theme_color ); ?>;
  color: <?php echo sanitize_hex_color( $text_color ); ?>;
  font-weight: 300;
  line-height: 1.75em;
  <?php $fontFamily = "font-family: 'Arial', 'Helvetica', 'sans-serif'";
    if( 1 == ampforwp_get_setting('ampforwp-d1-font') ) {
      $fontFamily = "font-family: 'Merriweather','Times New Roman', 'Times'"; 
     }
   ?>
  <?php if( 1 == ampforwp_get_setting('ampforwp-google-font-switch') ) {
      $fontFamily = "font-family: 'Merriweather', 'Times New Roman', 'Times, Serif';";
      if(ampforwp_get_setting('amp_font_selector') != 1 && !empty(ampforwp_get_setting('amp_font_selector') )){ 
        $fontFamily = "font-family: '".ampforwp_get_setting('amp_font_selector')."';";
      }
    }
  echo sanitize_text_field($fontFamily); ?>
}
ol, ul {list-style-position: inside;}
p,ol,ul,figure {margin: 0 0 1em;padding: 0;} a,a:visited {color:<?php echo ampforwp_sanitize_color($redux_builder_amp['amp-opt-color-rgba-link-design1']['color']); ?>;}a:hover,a:active,a:focus {color: <?php echo sanitize_hex_color( $text_color ); ?>;} .wp-caption amp-img{max-width: 100%}
blockquote {color: <?php echo sanitize_hex_color( $text_color ); ?>;background: rgba(127,127,127,.125);border-left: 2px solid <?php echo sanitize_hex_color( $link_color ); ?>;margin: 8px 0 24px 0;padding: 16px;} blockquote p:last-child {margin-bottom: 0;}

<?php // secondary font family
$font_content = '';
$font_content = ampforwp_get_setting('amp_font_selector_content_single'); ?>
.amp-wp-meta,.amp-wp-header .ampforwp-logo-area,.amp-wp-title,.wp-caption-text,.amp-wp-tax-category,.amp-wp-tax-tag,.amp-wp-comments-link,.amp-wp-footer p,.back-to-top, .cmt-button-wrapper a,.rp ol, .rp span, .single-post .amp_author_area .amp_author_area_wrapper{
<?php $fontFamily = "font-family: 'Segoe UI';"; 
    if(1==ampforwp_get_setting('ampforwp-google-font-switch') && 1 == ampforwp_get_setting('content-font-family-enable')){ 
      if(!empty($font_content) && $font_content != 1 ){  
        $fontFamily = "font-family: '".esc_attr($font_content)."';";
      }  
    }
echo sanitize_text_field($fontFamily); // secondary font family ends here ?>
}

.amp-wp-header {background-color: <?php echo ampforwp_sanitize_color( $header_bg_clr ); ?>;}
.amp-wp-header .ampforwp-logo-area {color: <?php echo sanitize_hex_color( $header_color ); ?>;font-size: 1em;font-weight: 400;margin: 0 auto;max-width: calc(840px - 32px);padding: .875em 16px;position: relative;}  .amp-wp-header .amp-wp-site-icon {background-color: <?php echo sanitize_hex_color( $header_color ); ?>;border: 1px solid <?php echo sanitize_hex_color(  $header_color ); ?>;border-radius: 50%;position: absolute;right: 18px;top: 10px;}
<?php if( !ampforwp_woocommerce_conditional_check() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) || ampforwp_is_home()) { ?>
.amp-wp-article {color: <?php echo sanitize_hex_color( $text_color ); ?>;font-weight: 400;margin: 1.5em auto;max-width: 840px;overflow-wrap: break-word;word-wrap: break-word;} .amp-wp-article-header {align-items: center;align-content: stretch;display: flex;flex-wrap: wrap;justify-content: space-between;margin: 1.5em 16px 1.5em;}
.amp-wp-title {color: <?php echo sanitize_hex_color( $text_color ); ?>;display: block;flex: 1 0 100%;font-weight: 900;font-size:1.5em;margin: 0;width: 100%;}.amp-wp-meta {color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;display: inline-block;flex: 2 1 50%;font-size: .875em;line-height: 1.7em;margin: 0;padding: 0;}.ampforwp-meta-info{margin-top: 0px;}.amp-wp-article-header .amp-wp-meta:last-of-type {text-align: right;float:right;display:initial}.amp-wp-article-header .amp-wp-meta:first-of-type {text-align: left;}.amp-wp-byline amp-img,.amp-wp-byline .amp-wp-author {display: inline-block;vertical-align: middle;}.amp-wp-byline amp-img {border: 1px solid <?php echo sanitize_hex_color( $link_color ); ?>;border-radius: 50%;position: relative;margin-right: 6px;}.amp-wp-posted-on {text-align: right;}.hide-meta-info{ display: none; }
.amp-wp-article-featured-image {margin: 1.5em 16px 1.5em;text-align:center;}.amp-wp-article-featured-image amp-img {margin: 0 auto;}.amp-wp-article-featured-image.wp-caption .wp-caption-text, .ampforwp-gallery-item .wp-caption-text {margin: 0 18px;}.amp-wp-frontpage .the_content {padding: 10px;}
.ampforwp-gallery-item.amp-carousel-slide { padding-bottom: 20px;}
.amp-wp-frontpage .ampforwp-title {margin-left:10px;}.amp-wp-article a{text-decoration:none}.amp-wp-article-content {margin: 0 16px;}.amp-wp-article-content ul,.amp-wp-article-content ol {margin-left: 1em;}.amp-wp-article-content amp-img {margin: 0 auto;}.amp-wp-article-content amp-img.alignright {margin: 0 0 1em 16px;}.amp-wp-article-content amp-img.alignleft {margin: 0 16px 1em 0;}
<?php if ( isset($redux_builder_amp['ampforwp-disqus-comments-support']) && $redux_builder_amp['ampforwp-disqus-comments-support'] ) {?>
.amp-disqus-comments { text-align:center } .amp-disqus-comments {padding: 15px;}.amp-disqus-comments amp-iframe{background: none;} <?php 
} ?>
 .wp-caption {padding: 0;}.wp-caption.alignleft {margin-right: 16px;}.wp-caption.alignright { margin-left: 16px;}figcaption ,.wp-caption-text {border-bottom: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;font-size: .875em;line-height: 1.5em;margin: 0;padding: .66em 10px .75em;text-align: center;} amp-carousel {background: <?php echo sanitize_hex_color( $border_color ); ?>;margin: 0 -16px 1.5em;} amp-iframe,amp-youtube,amp-instagram,amp-vine {background: <?php echo sanitize_hex_color( $border_color ); ?>;margin: 0 -16px 1.5em; } .amp-wp-article-content amp-carousel amp-img {border: none;} amp-carousel > amp-img > img {object-fit: contain; } .amp-wp-iframe-placeholder { background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $get_customizer->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;background-size: 48px 48px;min-height: 48px;} .amp-wp-article-footer .amp-wp-meta {display: block;} .amp-wp-tags{ list-style-type: none; padding: 0; margin: 0 0 9px 0; display: inline-flex; } .amp-wp-tags li{display:inline; padding-left: 5px; } .amp-wp-tax-category span{margin-right:5px;} .amp-wp-tax-category, .amp-wp-tax-tag { color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;font-size: .875em;line-height: 1.5em;margin: 1.5em 16px;}.ampforwp-comment-button {margin-bottom:20px;} .amp-wp-comments-link {color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;font-size: .875em;line-height: 1.5em;text-align: center;margin: 2.25em 0 1.5em;} .amp-wp-comments-link a { border-style: solid;border-color: <?php echo sanitize_hex_color( $border_color ); ?>;border-width: 1px 1px 2px;border-radius: 4px;background-color: transparent;color: <?php echo sanitize_hex_color( $link_color ); ?>;cursor: pointer; display: block;font-size: 14px;font-weight: 600;line-height: 18px;margin: 0 auto;max-width: 200px;padding: 11px 16px;text-decoration: none;width: 50%;-webkit-transition: background-color 0.2s ease;transition: background-color 0.2s ease;} .page-title {margin: 0 15px; font-size: 1.17em; }.amp-sub-archives li{width: 50%;} .amp-sub-archives ul{padding: 0;list-style: none;display: flex;font-size: 12px;line-height: 1.2;margin: 5px 1.5em 10px 1.5em;} .author-archive amp-img{border-radius: 50%;margin: 0px 8px 10px;display: block;}.author-archive{float: left;} .amp-wp-content.taxonomy-description{margin: 0 15px;}
 .amp-wp-content.taxonomy-image{margin: 15px 15px 0px 15px;}
<?php } // AMP Woocommerce CSS Ends ?>

/** Footer CSS **/
.amp-wp-footer {margin: calc(1.5em - 1px) 0 0;padding-bottom:25px;}
.amp-wp-footer div{margin:0 auto;max-width:calc(840px - 32px);position:relative}
.amp-wp-footer .footer_menu{padding:1.25em 16px;}
.amp-wp-footer h2{font-size:1em;line-height:1.375em;margin:0 0 .5em}
.amp-wp-footer p {font-size: .8em;line-height: 1.5em;margin: 0 15px 0 0;}
.amp-wp-footer a{text-decoration:none}.copyright_txt{float:left}.back-to-top{float:right}.amp-wp-header .nav_container{float: right;top: 16px;line-height: 1;   right: 65px; position: absolute}.toggle-text{position:absolute;right:0;height:22px;width:28px}.toggle-text span{display:block;position:absolute;height:2px;width:25px;background:<?php echo ampforwp_sanitize_color($header_elements_clr); ?>;border-radius:19px;opacity:1;left:0}.toggle-text span:nth-child(2){top:9px}.toggle-text span:nth-child(3){top:18px}

<?php if( !ampforwp_woocommerce_conditional_check() ) { ?>
.amp-wp-home .amp-wp-meta{margin:5px 0}
.amp-wp-home .amp-wp-content p{display:inline-block;width:100%}.ampforwp-custom-index .amp-wp-title a {text-decoration: none;color: <?php echo sanitize_hex_color( $text_color ); ?>;}
.amp-wp-meta{display:flex}.amp-wp-posted-on{display:initial}
<?php if(ampforwp_is_home() || !checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>
#pagination .next,#pagination .prev{display:inline-block}.ampforwp-custom-index .amp-wp-content{margin-bottom:30px}.pagination-holder{margin:1.5em 16px}#pagination .next{float:right}.amp-wp-home .amp-wp-content p{display:inline}.home-post-image{float:right;margin:0 0 10px 20px}.amp-wp-article-content amp-img{max-width:100%}.amp-wp-meta.amp-wp-tax-category,.amp-wp-meta.amp-wp-tax-tag{margin:0}.amp-wp-meta.amp-wp-tax-tag{display:initial}
<?php } // AMP Woocommerce CSS Ends ?>
.the_content small{font-size:11px;line-height:1.2;color:#111;margin-bottom: 5px;display: inline-block;}
.ampforwp-so-i{margin:1.5em 16px}.a-so-i{ width: 50px; height: 28px; display: inline-block; background: #5cbe4a;position: relative; top: -8px; padding-top: 0px; margin-bottom:5px; }
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
<?php if ( true == ampforwp_get_setting('enable-single-vk-share') ) { ?>
.custom-amp-socialsharing-vk, .a-so-vk{background:#45668e}
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
<?php if ( true == ampforwp_get_setting('enable-single-mewe-share') ) { ?>
.custom-amp-socialsharing-mewe{background:#b8d6e6}
.a-so-mewe{background:#b8d6e6}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-flipboard-share') ) { ?>
.custom-amp-socialsharing-flipboard{background:#f52828}
.a-so-flipboard{background:#f52828;text-align: center;}
.a-so-flipboard amp-img , .a-so-i.custom-amp-socialsharing-flipboard amp-img {top: 2px;}
<?php } ?>
<?php if( !ampforwp_woocommerce_conditional_check() ) { ?>
.cmt-button-wrapper a{border-style:solid;border-color:#c2c2c2;border-width:1px 1px 2px;border-radius:4px;background-color:transparent;color:#0a89c0;cursor:pointer;display:block;font-size:14px;font-weight:600;text-align:center;line-height:18px;margin:0 auto;max-width:200px;padding:11px 16px;text-decoration:none;width:50%;-webkit-transition:background-color .2s ease;transition:background-color .2s ease}.close-nav,.cmts_list div,.rp ol li,.toggle-navigation ul,.toggle-navigationv2 ul li a{display:inline-block}main .amp-wp-content.cmts_list{background:0 0;box-shadow:none;max-width:1030px}.cmts_list h3{font-size:14px;font-weight:700;letter-spacing:.4px;margin:25px 0 10px;color:#333}.cmts_list{margin:2.5em 16px}.cmts_list ul{margin:0;padding:0}.cmts_list ul.children{padding-bottom:10px;margin-left:4%;width:96%}
.cmts_list ul li p{margin:0;font-size:14px;clear:both;padding-top:5px; word-break:break-word;}
.cmts_list ul li{font-size:11px;list-style-type:none;margin-bottom:12px;background:#fefefe;-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;-moz-box-shadow:0 2px 3px rgba(0,0,0,.05);-webkit-box-shadow:0 2px 3px rgba(0,0,0,.05);box-shadow:0 2px 3px rgba(0,0,0,.05);padding:0;max-width:1000px;width:96%}.cmts_list ul li .says{margin-right:4px}.cmts_list li li,.cmts_list li li li{margin:20px 20px 10px}.cmts_list ul li .comment-body{padding:10px 0 15px}.cmt-author{float:left}.single-post footer.comment-meta{padding-bottom:0;     line-height: 1.9;}.cmts_list li li{background:#f7f7f7;box-shadow:none;border:1px solid #eee} .page-numbers{ padding: 9px 10px; background: #fff; font-size: 14px; } .cmt-author-img{float: left; margin-right: 5px; border-radius: 60px;} .comment-content amp-img{max-width: 300px;}
<?php } ?>
<?php } // AMP Woocommerce CSS Ends ?>

/** Menu CSS **/
amp-sidebar{width:250px}
amp-sidebar{background:<?php echo ampforwp_sanitize_color($menu_sidebar_clr); ?>;}
.amp-sidebar-image{line-height:100px;vertical-align:middle}.amp-close-image{top:15px;left:225px;cursor:pointer}.toggle-navigationv2 ul{list-style-type:none;margin:0;font-family:sans-serif;padding:0}.toggle-navigationv2 ul ul li a{padding-left:35px;background:<?php echo ampforwp_sanitize_color($submenu_bg_clr); ?>;display:inline-block}.toggle-navigationv2 ul li a{padding:10px 15px 10px 25px;width:100%;text-decoration:none;background: <?php echo ampforwp_sanitize_color($menu_bg_clr); ?>;font-size:13px;border-bottom:1px solid <?php echo ampforwp_sanitize_color($menu_bdr_clr); ?>;display:inline-block;color: <?php echo ampforwp_sanitize_color($menu_elements_clr); ?>;}
.close-nav{font-size:12px;font-family:sans-serif;background: <?php echo ampforwp_sanitize_color($cross_btn_bg_clr); ?>;letter-spacing:1px;padding:10px;border-radius:100px;line-height:8px;margin:14px;
color: <?php echo ampforwp_sanitize_color($cross_btn_clr); ?>;display:inline-block;
position:relative;
<?php if (ampforwp_get_setting('header-overlay-position-d1') == 1 ) {?>
right:0px;
<?php } // 
if (ampforwp_get_setting('header-overlay-position-d1') == 2 ) {?>
left:191px;
<?php } ?>
}
.close-nav:hover{ background: <?php echo ampforwp_sanitize_color($cross_btn_hvr_clr); ?>;}.toggle-navigation ul{list-style-type:none;margin:0;padding:0;width:100%}.menu-all-pages-container:after{content:"";clear:both}.toggle-navigation ul li{font-size:13px;border-bottom:1px solid rgba(0,0,0,.11);padding:11px 0;width:25%;float:left;text-align:center;margin-top:6px}.toggle-navigation ul ul{display:none}.toggle-navigation ul li a{color:#eee;padding:15px}.toggle-navigation{display:none;background:#444}.nav_container:hover+.toggle-navigation,.toggle-navigation:active,.toggle-navigation:focus,.toggle-navigation:hover{display:inline-block;width:100%}#amp-user-notification1 p{display:inline-block}amp-user-notification{padding:5px;text-align:center;background:#fff;border-top:1px solid} amp-user-notification button {padding: 8px 10px;background:  <?php echo sanitize_hex_color( $header_background_color ); ?>;color: <?php echo sanitize_hex_color( $header_color ); ?>;margin-left: 5px;border: 0;}.amp-not-privacy{color:<?php echo sanitize_hex_color( $header_background_color ); ?>;text-decoration: none;font-size: 15px;}amp-user-notification button:hover {cursor: pointer} .amp-ad-wrapper {text-align: center} <?php if( ampforwp_get_setting('enable-single-social-icons') == true && is_single() )  { ?>
  body {padding-bottom: 43px;}
.body.single-post .s_so{z-index:99999;}
.body.single-post .adsforwp-stick-ad, .body.single-post amp-sticky-ad{padding-top:4px;padding-bottom:52px;}
.body.single-post .ampforwp-sticky-custom-ad{ 
    bottom: 46px;
    padding: 5px 0px 0px;
}
.body.single-post .afw a{line-height:0;}
.body.single-post amp-sticky-ad amp-sticky-ad-top-padding{height:0px;}
 <?php } ?>
.s_so a{text-decoration:none}.s_so{width:100%;bottom:0;display:block;left:0;box-shadow:0 4px 7px #000;background:#fff;padding:7px 0 0;position:fixed;margin:0;z-index:10;text-align:center}
<?php if( ampforwp_get_setting('ampforwp-advertisement-sticky-type') == 3) {?>
  .btt{z-index:9999;}
<?php } // advanced ads type 3 ends here ?>
<?php if( !ampforwp_woocommerce_conditional_check() ) { ?>
.whatsapp-share-icon{width:50px;height:28px;display:inline-block;background:#5cbe4a;padding:4px 0;position:relative;top:-4px}.amp-wp-tax-category span:first-child:after{content:' '}.amp-wp-tax-category span:after,.amp-wp-tax-tag span:after{content:', '}.amp-wp-tax-category span:last-child:after,.amp-wp-tax-tag span:last-child:after{content:' '}pre{white-space:pre-wrap}.amp-ad-wrapper.amp_ad_1{padding-top:20px}
.amp-wp-content-loop{width:100%}
.amp-wp-content-loop ul{margin:0}
.ampforwp_single_excerpt { margin-bottom:15px; }
.ampforwp-ad-above-related-post{padding-top:15px;}
.single-post .amp_author_area amp-img{ margin: 0; float: left; margin-right: 12px; border-radius: 60px; }
.single-post .amp_author_area .amp_author_area_wrapper{ display: inline-block; width: 100%; line-height: 1.4; margin-top: 22px; font-size: 13px; color:#333;}
.a-so-twitter{background:#1da1f2}
.a-so-i-rounded-author {padding: 10px 0px 10px 10px;display: inline-table;border-radius: 50%;cursor: pointer;}
figure.aligncenter amp-img {
 margin: 0 auto;
 }
<?php } // AMP Woocommerce CSS Ends ?>

/* Footer */
<?php 
$footer_back_color    = ampforwp_get_setting('ampforwp-footer-background-color-1','color');
$footer_hdng_color    = ampforwp_get_setting('d1-footer-hdng-color','color');
$footer_txt_color     = ampforwp_get_setting('d1-footer-txt-color','color');
$footer_link_color    = ampforwp_get_setting('d1-footer-link-color','color');
$footer_lnk_hvr_color = ampforwp_get_setting('d1-footer-link-hvr-color','color');
$footer_brdr_color    = ampforwp_get_setting('d1-footer-brdr-color','color');
$footer_cpr_color     = ampforwp_get_setting('d1-footer-cpr-color','color');

if (empty($footer_back_color)) {
  $footer_back_color = '#FFFFFF';
}
if (empty($footer_hdng_color)) {
  $footer_hdng_color = '#353535';
}
if (empty($footer_txt_color)) {
  $footer_txt_color = '#353535';
}
if (empty($footer_link_color)) {
  $footer_link_color = '#04415D';
}
if (empty($footer_lnk_hvr_color)) {
  $footer_lnk_hvr_color = '#353535';
}
if (empty($footer_brdr_color)) {
  $footer_brdr_color = '#c2c2c2';
}
if (empty($footer_cpr_color)) {
  $footer_cpr_color = '#696969';
}
?>
.amp-wp-footer{ border-top: 1px solid <?php echo ampforwp_sanitize_color($footer_brdr_color);?>;background: <?php echo ampforwp_sanitize_color($footer_back_color);?>; color:<?php echo ampforwp_sanitize_color($footer_txt_color);?>; }
.amp-wp-footer a{color:<?php echo ampforwp_sanitize_color($footer_link_color);?>;}
.amp-wp-footer a:hover{color:<?php echo ampforwp_sanitize_color($footer_lnk_hvr_color);?>;}
.amp-wp-footer p {color: <?php echo ampforwp_sanitize_color( $footer_cpr_color ); ?>;}
.amp-wp-footer{ background: <?php echo ampforwp_sanitize_color($footer_back_color);?>; }
.footer_menu ul{ list-style-type: none; padding: 0; text-align: center; margin: 0px 20px 25px 20px; line-height: 27px; font-size: 13px }
.footer_menu ul li{ display:inline; margin:0 10px; }
.footer_menu ul li:first-child{ margin-left:0 }
.footer_menu ul li:last-child{ margin-right:0 }
.footer_menu ul ul{ display:none }
#footer{padding:20px 0px 0px 0px}
#footer h2, .cpr-links{padding:0px 16px;}
a.btt:hover {
    cursor: pointer;
}
/* Category 1 */
.amp-category-block ul{ list-style-type:none }
.amp-category-block-btn{ display: block; text-align: center; font-size: 13px; margin-top: 15px; border-bottom: 1px solid #f1f1f1; text-decoration: none; }
.design_1_wrapper .amp-category-block, .category-widget-wrapper{ max-width: 840px; margin: 1.5em auto; }
.design_1_wrapper .amp-wp-header .nav_container .toggle-text{
  cursor:pointer;
}
.category-widget-gutter{ margin:1.5em 26px 3.5em }
.category-widget-gutter h4{ margin-bottom: 0px;}
.category-widget-gutter ul{ margin-top: 10px; list-style-type:none; padding:0 }
.amp-category-block ul{ margin: 1.5em 26px 3.5em; }
.amp-category-post{ width: 32%; display: inline-block; word-wrap: break-word;float: left;}
.amp-category-post a{ color:#555; text-decoration:none}
.amp-category-post amp-img{ margin-bottom:5px; }
.amp-category-block li:nth-child(3){ margin: 0 1%; }
@media screen and (max-width: 530px){ .amp-category-post {line-height: 1.45;font-size: 14px; } .amp-category-block li:nth-child(3) {margin:0 0.6%} }
@media screen and (max-width: 375px){ .rp .related_link{line-height:1} .amp-category-post {line-height: 1.45;font-size: 12px; } .amp-category-block li:nth-child(3) {margin:0%} }
.searchmenu{ margin-right: 15px; margin-top: 10px; position: absolute; top: 0; right: 91px; }
.searchmenu button{ background:transparent; border:none }
.closebutton{ background: transparent; border: 0; color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(255, 255, 255, 0.7); border-radius: 30px; width: 32px; height: 32px; font-size: 12px; text-align: center; position: absolute; top: 12px; right: 20px; outline:none }
amp-lightbox{ background: rgba(0, 0, 0,0.85); }
<?php if( !ampforwp_woocommerce_conditional_check() ) { ?>
<?php if( true == ampforwp_get_setting('ampforwp-single-select-type-of-related') && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ){ ?>
.rp span{display: block;}.rp ol{list-style-type:none;margin:0;padding:0}.rp ol li{width:100%;margin-bottom:12px;padding:0}.rp .related_link a{color:#000;font-size:18px}.rp ol li amp-img{width:100px;float:left;margin-right:15px}.rp ol li p{font-size:12px;color:#999;line-height:1.2;margin:7px 0 0}.no_related_thumbnail{padding:15px 18px} main .amp-wp-content.relatedpost{background:0 0;box-shadow:none;max-width:1030px}.relatedpost{margin:2em 16px}.rp span{font-size:14px;font-weight:700;letter-spacing:.4px;margin:25px 0 10px;color:#333;}
.rp ol li{display:inline-block}
<?php } ?>
<?php if( is_singular() || is_home() && true == ampforwp_get_setting('amp-frontpage-select-option') && ampforwp_get_blog_details() == false && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) { ?>
/* Tables */
table { display: -webkit-box; display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; overflow-x: auto; }
table a:link { font-weight: bold; text-decoration: none; }
table a:visited { color: #999999; font-weight: bold; text-decoration: none; }
table a:active, table a:hover { color: #bd5a35; text-decoration: underline; }
table { color: #666; font-size: 12px; text-shadow: 1px 1px 0px #fff; background: #eee; margin: 0px; width: 95%; }
table th { padding: 21px 25px 22px 25px; border-top: 1px solid #fafafa; border-bottom: 1px solid #e0e0e0; background: #ededed; background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb)); background: -moz-linear-gradient(top, #ededed, #ebebeb); }
table th:first-child { text-align: left; padding-left: 20px; }
table tr:first-child th:first-child { -moz-border-radius-topleft: 3px; -webkit-border-top-left-radius: 3px; border-top-left-radius: 3px; }
table tr:first-child th:last-child { -moz-border-radius-topright: 3px; -webkit-border-top-right-radius: 3px; border-top-right-radius: 3px; }
table tr { text-align: center; padding-left: 20px; }
table td:first-child { text-align: left; padding-left: 20px; border-left: 0; }
table td { padding: 18px; border-top: 1px solid #ffffff; border-bottom: 1px solid #e0e0e0; border-left: 1px solid #e0e0e0; background: #fafafa; background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa)); background: -moz-linear-gradient(top, #fbfbfb, #fafafa); }
table tr.even td { background: #f6f6f6; background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6)); background: -moz-linear-gradient(top, #f8f8f8, #f6f6f6); }
table tr:last-child td {border-bottom: 0;}
table tr:last-child td:first-child { -moz-border-radius-bottomleft: 3px; -webkit-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px; }
table tr:last-child td:last-child { -moz-border-radius-bottomright: 3px; -webkit-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; }
table tr:hover td { background: #f2f2f2; background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0)); background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0); }
.amp-wp-content table {word-break: break-word;}
<?php } ?>
 .amp-facebook-comments{margin: 0 0}

/* CSS3 icon */
[class*=icono-]:after, [class*=icono-]:before{ content: ''; pointer-events: none; }
.icono-search:before{ position: absolute; left: 50%; -webkit-transform: rotate(270deg); -ms-transform: rotate(270deg); transform: rotate(270deg); width: 2px; height: 9px; box-shadow: inset 0 0 0 32px; top: 0px; border-radius: 0 0 1px 1px; left: 14px; }
[class*=icono-]{ display: inline-block; vertical-align: middle; position: relative; font-style: normal; color: #f42; text-align: left; text-indent: -9999px; direction: ltr }
<?php if( true == ampforwp_get_setting('amp-design-1-search-feature') ) {  ?>
.icono-search{ -webkit-transform: translateX(-50%); -ms-transform: translateX(-50%); transform: translateX(-50%) }
.icono-search{ border: 1px solid; width: 10px; height: 10px; border-radius: 50%; -webkit-transform: rotate(45deg); -ms-transform: rotate(45deg); transform: rotate(45deg); margin: 4px 4px 8px 8px; }
.searchform label{ color: #f7f7f7; display: block; font-size: 10px; line-height: 0; opacity:0.6 }
.searchform{ background: transparent; left: 20%; position: absolute; top: 35%; width: 60%; max-width: 100%; transition-delay: 0.5s; }
.searchform input{ background: transparent; border: 1px solid #666; color: #f7f7f7; font-size: 14px; font-weight: 400; line-height: 1; letter-spacing: 0.3px; text-transform: capitalize; padding: 20px 0px 20px 30px; margin-top: 15px; width: 100%; }
#searchsubmit{opacity:0}
<?php } // search condition ends ?>
.amp-wp-header .ampforwp-search-nav-wrapper{ padding: 0; }
.ampforwp-search-nav-wrapper .searchmenu{ margin-top: 20px; }
.headerlogo a, [class*=icono-]{ top:0; }
.amp-logo h1{font-size: 1em; font-weight: 400; line-height: 1.75em; margin: 0;}
.amp-logo{display:inline-block}
.amp-wp-header a, .headerlogo a, [class*=icono-] {color: <?php echo sanitize_hex_color( $header_elements_clr ); ?>;text-decoration: none;}
@media screen and (min-width: 650px) { table {display: inline-table;}  }
<?php if($redux_builder_amp['enable-single-social-icons'] && is_socialshare_or_socialsticky_enabled_in_ampforwp() ){ ?> .amp-wp-footer{padding-bottom: 20px;}<?php } ?>

<?php if($redux_builder_amp['amp-rtl-select-option'] == true) { ?>
header, amp-sidebar, article, footer{ direction: rtl;}
.home-post-image{float:left; margin: 0 10px 10px 20px;}
.amp-wp-header{text-align: right;}
.toggle-text{left: 40px; right: initial;}
.amp-wp-header .amp-wp-site-icon, .amp-wp-header .nav_container{right:0px;left: 18px;}
#pagination .next{float:left}
.back-to-top{float:left}
.amp-wp-footer p{margin:0 0 0 15px}
.amp-wp-article-header .amp-wp-meta:first-of-type{text-align:right}
.amp-wp-tax-category span{margin-left:5px; margin-right:0px}
.amp-wp-meta.amp-wp-tax-tag{display:inherit}
/*.amp-wp-article-header .amp-wp-meta:last-of-type{text-align:left}*/
.rp ol li amp-img{float:right; margin-left:15px; margin-right:0px}
.amp-wp-header .amp-wp-site-icon,.amp-wp-header .nav_container{float:left;right:0;left:18px}.amp-wp-header .amp-wp-site-icon{position:relative;top:-3px}
.toggle-navigationv2 ul li a{width:100%}
.searchform{direction:rtl}
.closebutton{right:0; left:20px;}
.amp-wp-byline amp-img{ margin:0px 0px 0px 6px;}
.cmt-author{float: right;}
.amp-ad-wrapper,.amp-wp-article amp-ad{ direction: ltr; }
amp-carousel{direction: ltr;} .tt-lb{float:right;margin-left:5px;}
.amp-wp-content.widget-wrapper{margin:20px auto;}
.amp_widget_above_the_footer{direction:rtl;}
@media(max-width:768px){
.amp-wp-content.widget-wrapper{margin: 15px;}
}
<?php } 
} // AMP Woocommerce CSS Ends ?>
<?php if ($redux_builder_amp['ampforwp-callnow-button']) { ?>
.callnow{ position: relative; top: -27px; right: 100px; }
.callnow a:before { content: ""; position: absolute; right: 23px; width: 5px; height: 11px; border-width: 6px 0 6px 3px; border-style: solid; border-color:<?php echo ampforwp_sanitize_color($redux_builder_amp['amp-opt-color-rgba-colorscheme-call']['color']); ?>; background: transparent; transform: rotate(-30deg); box-sizing: initial; border-top-left-radius: 3px 5px; border-bottom-left-radius: 3px 5px; }
<?php } ?>
<?php
if ( class_exists('TablePress') ) { ?>
.tablepress-table-description{clear:both;display:block}.tablepress{border-collapse:collapse;border-spacing:0;width:100%;margin-bottom:1em;border:none}.tablepress td,.tablepress th{padding:8px;border:none;background:0 0;text-align:left}.tablepress tbody td{vertical-align:top}.tablepress tbody td,.tablepress tfoot th{border-top:1px solid #ddd}.tablepress tbody tr:first-child td{border-top:0}.tablepress thead th{border-bottom:1px solid #ddd}.tablepress tfoot th,.tablepress thead th{background-color:#d9edf7;font-weight:700;vertical-align:middle}.tablepress .odd td{background-color:#f9f9f9}.tablepress .even td{background-color:#fff}.tablepress .row-hover tr:hover td{background-color:#f3f3f3}@media (min-width:768px) and (max-width:1600px){.tablepress{overflow-x:none}}@media (min-width:320px) and (max-width:767px){.tablepress{display:inline-block;overflow-x:scroll}}
<?php }
if( !is_home() && ( (is_single() && true == ampforwp_get_setting('ampforwp-bread-crumb')) || (is_page() && ampforwp_get_setting('ampforwp_pages_breadcrumbs') ) ) && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) { ?>
.breadcrumb{line-height: 1; margin: 0.1em 16px 1.5em;}
.breadcrumb{line-height: 1; margin: 0.1em 16px 1.5em;}
.breadcrumb ul{padding:0; margin:0;}
.breadcrumb ul li, .breadcrumbs span{display:inline;font-size:12px;}
.breadcrumb ul li a, .breadcrumb ul li span{font-size:12px;}
.breadcrumb ul li a::after {content: "►";display: inline-block;font-size: 8px;padding: 0 6px 0 7px;vertical-align: middle;opacity: 0.5;position:relative;top: -1px;}
.breadcrumb ul li:hover a::after{color:#c3c3c3;}
.breadcrumb ul li:last-child a::after{display:none;}
<?php } ?> 
.amp-wp-content.widget-wrapper{max-width:840px}
.amp_widget_above_the_footer {margin:0 10px;}
.widget-wrapper li { list-style-position: inside; }
.amp-menu > li > a > amp-img, .sub-menu > li > a > amp-img { display: inline-block; margin-right: 4px; }
.menu-item amp-img {width: 16px; height: 11px; display: inline-block; margin-right: 5px;}
.amp-carousel-container {position: relative;width: 100%;height: 100%;} 
.amp-carousel-img img {object-fit: contain;}
/* Slide Navigation code */
.amp-menu li{position:relative;margin:0;}
.amp-menu li.menu-item-has-children ul{display:none;margin:0;background:#222}
.amp-menu li.menu-item-has-children ul ul{background:#444}
.amp-menu input{display:none;}
.amp-menu [id^=drop]:checked + label + ul{ display: block;}
.amp-menu .toggle:after{content:'\25be';position:absolute;padding: 10px 15px 10px 30px;right:0;font-size:18px;color:<?php echo ampforwp_sanitize_color($menu_icon_clr); ?>;top:5px;z-index:10000;line-height:1}
.amp-ad-wrapper span { display: inherit; font-size: 12px; line-height: 1;}
<?php // Ads (sitewide)
if( ( isset($redux_builder_amp['enable-amp-ads-1'] ) && $redux_builder_amp['enable-amp-ads-1'] ) || ( isset($redux_builder_amp['enable-amp-ads-2'] ) && $redux_builder_amp['enable-amp-ads-2'] ) ){ ?> .amp-ad-wrapper {text-align: center} .amp-ad-wrapper.amp_ad_1{padding-top:20px} .amp-ad-wrapper,.amp-wp-article amp-ad{ direction: ltr; } <?php }
if ( true == $redux_builder_amp['amp-pagination'] ) { ?>
.ampforwp_post_pagination{width:100%;text-align:center;display:inline-block;}
<?php }
$custom_css = ampforwp_get_setting('css_editor');
$custom_css = str_replace(array('.accordion-mod'), array('.apac'), $custom_css);
$sanitized_css = ampforwp_sanitize_i_amphtml($custom_css);
echo $sanitized_css; // sanitized above
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
// Infinate Scroll Single page CSS
if( true == ampforwp_get_setting('ampforwp-infinite-scroll') && ampforwp_get_setting('ampforwp-infinite-scroll-single') ){ ?>
  .single-post amp-next-page{
    margin-top:30px;
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
.amp-wp-content.the_content h1, .amp-wp-content.the_content h2, .amp-wp-content.the_content h3, .amp-wp-content.the_content h4, .amp-wp-content.the_content h5, .amp-wp-content.the_content h6{margin: 15px 0px;line-height: 1.4;}
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
  padding:40px 0px 0px 0px;
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
  bottom:42px;
  z-index: 999999;
}
<?php } //amp-enable-notifications Condition Ends Here ?>
amp-facebook-like{
  max-height: 28px;
}
<?php if(true == ampforwp_get_setting('ampforwp-single-related-posts-excerpt')){?>
  .rp .related_link a.readmore-rp {
      font-size: 13px;
      color:#999;
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
<?php if(ampforwp_get_setting('ampforwp-gallery-design-type')==3){?>
.ampforwp-gallery-item.amp-carousel-containerd3 {
    float: left;
}
.amp-carousel-containerd3 figcaption {
    max-width: 150px;
    border:none;
}
<?php } ?>