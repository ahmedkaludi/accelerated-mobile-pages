<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp; 
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
$font_content = '';
$font_content = ampforwp_get_setting('amp_font_selector_content_single');
$header_type = ampforwp_get_setting('header-type');
$header_bg_color = ampforwp_get_setting('swift-background-scheme','rgba');
if(!defined('AMPFORWP_LAYOUTS_FILE')){
	if( !in_array($header_type, array(1,2,3,10)) ){
		$header_type = 1;
		$header_bg_color = 'rgba(255,255,255,1)';
	}
}
if ( empty($header_bg_color)) {
	$header_bg_color = 'rgba(255,255,255,1)';	
}
$ampforwp_font_icon = ampforwp_get_setting('ampforwp_font_icon');
if ( empty($ampforwp_font_icon) ) {
	$ampforwp_font_icon = 'swift-icons';
}
?>
<?php if(1==ampforwp_get_setting('ampforwp-google-font-switch') && ( !isset($redux_builder_amp['amp_font_selector']) || $redux_builder_amp['amp_font_selector'] == 1 || empty($redux_builder_amp['amp_font_selector']) ) ) {
	$google_font_api = ampforwp_get_setting('google_font_api_key');
if(!ampforwp_levelup_compatibility('levelup_theme_and_elementor') && !empty($google_font_api) ){ // Level up Condition starts ?>
@font-face {font-family: 'Poppins';font-display: swap;font-style: normal;font-weight: 300;src: local('Poppins Light'), local('Poppins-Light'), url('<?php echo $icon_url ?>fonts/Poppins-Light.ttf');}
@font-face {font-family: 'Poppins';font-display: swap;font-style: normal;font-weight: 400;src: local('Poppins Regular'), local('Poppins-Regular'), url('<?php echo $icon_url ?>fonts/Poppins-Regular.ttf');}
@font-face {font-family: 'Poppins';font-display: swap;font-style: normal;font-weight: 500;src: local('Poppins Medium'), local('Poppins-Medium'), url('<?php echo $icon_url ?>fonts/Poppins-Medium.ttf');} 
@font-face {font-family: 'Poppins';font-display: swap;font-style: normal;font-weight: 600;src: local('Poppins SemiBold'), local('Poppins-SemiBold'), url('<?php echo $icon_url ?>fonts/Poppins-SemiBold.ttf'); }
@font-face {font-family: 'Poppins';font-display: swap;font-style: normal;font-weight: 700;src: local('Poppins Bold'), local('Poppins-Bold'), url('<?php echo $icon_url ?>fonts/Poppins-Bold.ttf'); }
<?php } // Level up Condition ends 
} ?>
<?php
$hovercolor = '';
$hovercolor = ampforwp_get_setting('swift-hover-color-scheme');
$hovercolor = $hovercolor['color'];

$swift_cs_color = '#005be2';
$swift_btn_hvr_color = '#fff';
$swift_cs = ampforwp_get_setting('swift-color-scheme');
if( !empty($swift_cs['color']) ) {
	$swift_cs_color = $swift_cs['color'];
}
$swift_btn_hvr_color = ampforwp_get_setting('swift-btn-hover-color-scheme','color'); ?>
body{<?php  
	$theme = wp_get_theme();
	$fontFamily = "font-family: 'Arial', 'Helvetica', 'sans-serif';";
if( !ampforwp_levelup_compatibility('levelup_theme') && 1==ampforwp_get_setting('ampforwp-google-font-switch') ){
	$fontFamily = "font-family: 'Poppins', sans-serif;";
	if(ampforwp_get_setting('amp_font_selector') != 1 && !empty($redux_builder_amp['amp_font_selector'])){ 
		$fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector']."';";
	}
}
echo sanitize_text_field($fontFamily); ?>font-size: 16px; line-height:1.25; }
ol, ul{ list-style-position: inside }
p, ol, ul, figure{ margin: 0 0 1em; padding: 0; }
a, a:active, a:visited{ text-decoration: none; color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;}
body a:hover{
	color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;
}
pre{ white-space: pre-wrap;}
.left{float:left}
.right{float:right}
.hidden, .hide, .logo .hide{ display:none }
.screen-reader-text {border: 0;clip: rect(1px, 1px, 1px, 1px);clip-path: inset(50%);height: 1px;margin: -1px;overflow: hidden;padding: 0;position: absolute;width: 1px;word-wrap: normal;}
.clearfix{ clear:both }
blockquote{ background: #f1f1f1; margin: 10px 0 20px 0; padding: 15px;}
blockquote p:last-child {margin-bottom: 0;}
.amp-wp-unknown-size img {object-fit: contain;}
.amp-wp-enforced-sizes{ max-width: 100% }
html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}nav ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent}table{border-collapse:collapse;border-spacing:0}hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}input,select{vertical-align:middle}
*,*:after,*:before {
box-sizing: border-box;-ms-box-sizing: border-box;-o-box-sizing: border-box;}
.alignright {float: right;margin-left:10px;}
.alignleft {float: left;margin-right:10px;}
.aligncenter {display: block;margin-left: auto;margin-right: auto;text-align: center;}
amp-iframe { max-width: 100%; margin-bottom : 20px; }
amp-wistia-player {margin:5px 0px;}
.wp-caption {padding: 0;}
figcaption ,.wp-caption-text {font-size: 12px;line-height: 1.5em;margin: 0;padding: .66em 10px .75em;text-align: center;}
amp-carousel > amp-img > img {object-fit: contain;}
.amp-carousel-container {position: relative;width: 100%;height: 100%;} 
.amp-carousel-img img {object-fit: contain;}
amp-instagram{box-sizing: initial;}
figure.aligncenter amp-img {margin: 0 auto;}
.rr span,.loop-date,.fbp-cnt .amp-author,.display-name,.author-name{color:#191919;}
.fsp-cnt .loop-category li {padding: 8px 0px;}
.fbp-cnt h2.loop-title {padding: 8px 0px;}
<?php global $post;
if( class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID) &&  (is_page() || ampforwp_is_front_page() ) && ( function_exists( 'amp_pagebuilder_compatibility_init' ) || class_exists('Elementor_For_Amp') ) ) { }
else{ ?>.cntr {max-width: 1100px;margin: 0 auto;width:100%;padding:0px 20px} <?php } ?>
<?php if(!ampforwp_levelup_compatibility('levelup_elementor') ){  // Level up Condition starts 
if ( $ampforwp_font_icon  == 'swift-icons' || ( $ampforwp_font_icon == 'fontawesome-icons'  && checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) ){ ?>
@font-face {font-family: 'icomoon';font-display: swap;font-style: normal;font-weight: normal;src:  local('icomoon'), local('icomoon'), url('<?php echo $icon_url ?>fonts/icomoon.ttf');}
<?php } // Swift icomoon icons condition ends ?> 
header .cntr{
<?php if( ampforwp_get_setting('swift-width-control') ){?>
	max-width:<?php echo esc_html(ampforwp_get_setting('swift-width-control'));?>;
	margin: 0 auto;
<?php }?>
}
<?php if($redux_builder_amp['amp-sticky-header'] == '1'){?>
.h_m{position:fixed;z-index:999;top:0px;width: 100vw;display:inline-block;
	<?php if($header_bg_color){?>background: <?php echo ampforwp_sanitize_color($header_bg_color); ?>;<?php }?>
	<?php if(ampforwp_get_setting('swift-border-line-control')){?>border-bottom: <?php echo esc_html(ampforwp_get_setting('swift-border-line-control')) ?>px solid;<?php } ?>
	<?php if($redux_builder_amp['swift-border-color-control']['rgba']){?>border-color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-border-color-control'] ['rgba']) ?>;<?php } ?>
	<?php if($redux_builder_amp['swift-boxshadow-checkbox-control']){?>box-shadow:0px 0px 2px 2px #ccc;<?php }?>
	<?php if($redux_builder_amp['swift-padding-control']){?>padding: <?php echo esc_html($redux_builder_amp['swift-padding-control']['padding-top']) .' '.esc_html($redux_builder_amp['swift-padding-control']['padding-right']) .' '.esc_html($redux_builder_amp['swift-padding-control']['padding-bottom'])  .' '.esc_html($redux_builder_amp['swift-padding-control']['padding-left']) ; ?>;<?php } ?>
	<?php if($redux_builder_amp['swift-margin-control']){?>margin: <?php echo esc_html($redux_builder_amp['swift-margin-control']['margin-top']) .' '.esc_html($redux_builder_amp['swift-margin-control']['margin-right']) .' '.esc_html($redux_builder_amp['swift-margin-control']['margin-bottom'])  .' '.esc_html($redux_builder_amp['swift-margin-control']['margin-left']) ; ?>;<?php } ?>
}
.content-wrapper{<?php if($redux_builder_amp['swift-height-control']){?>margin-top:<?php echo esc_html($redux_builder_amp['swift-height-control'])?>;<?php } ?>}
<?php } else{ ?>
.h_m{
	position: static;
	<?php if($header_bg_color){?>background: <?php echo ampforwp_sanitize_color($header_bg_color); ?>;<?php }?>
	<?php if($redux_builder_amp['swift-border-line-control']){?>border-bottom: <?php echo esc_html($redux_builder_amp['swift-border-line-control']) ?>px solid;<?php } ?>
	<?php if($redux_builder_amp['swift-border-color-control']['rgba']){?>border-color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-border-color-control'] ['rgba']) ?>;<?php } ?>
	<?php if($redux_builder_amp['swift-boxshadow-checkbox-control']){?>box-shadow:0px 0px 2px 2px #ccc;<?php }?>
	<?php if($redux_builder_amp['swift-padding-control']){?>padding: <?php echo esc_html($redux_builder_amp['swift-padding-control']['padding-top']) .' '.esc_html($redux_builder_amp['swift-padding-control']['padding-right']) .' '.esc_html($redux_builder_amp['swift-padding-control']['padding-bottom'])  .' '.esc_html($redux_builder_amp['swift-padding-control']['padding-left'] ); ?>;<?php } ?>
	<?php if($redux_builder_amp['swift-margin-control']){?>margin: <?php echo esc_html($redux_builder_amp['swift-margin-control']['margin-top']) .' '.esc_html($redux_builder_amp['swift-margin-control']['margin-right']) .' '.esc_html($redux_builder_amp['swift-margin-control']['margin-bottom'])  .' '.esc_html($redux_builder_amp['swift-margin-control']['margin-left']) ; ?>;<?php } ?>
}
.content-wrapper{
	margin-top:0px;
} 
<?php } // Sickt CSS Ends ?>
.h_m_w{width:100%;clear:both;display: inline-flex;<?php if(ampforwp_get_setting('swift-height-control')){?>height:<?php echo esc_html(ampforwp_get_setting('swift-height-control'))?>;<?php } ?>}
.icon-src:before{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e8b6";font-family: 'icomoon';font-size: 23px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f002";font-family: "Font Awesome 5 Free";font-weight:600;font-size:18px;
<?php } ?>
}
.isc:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e8cc";font-family: 'icomoon';font-size: 20px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f07a";font-family: "Font Awesome 5 Free";font-weight:600;font-size:16px;
<?php } ?>
}
.h-ic a:after, .h-ic a:before{
	<?php if(isset($redux_builder_amp['swift-element-color-control'] ['rgba']) && $redux_builder_amp['swift-element-color-control'] ['rgba']){?>color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-color-control']['rgba'])?>;<?php } ?>}
<?php if ( true == ampforwp_get_setting('ampforwp-callnow-button') ) { ?>
.h-call a:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e0cd";font-family: 'icomoon';
<?php } 
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f095";font-family: "Font Awesome 5 Free";font-weight:600;font-size:15px;
<?php } ?>
}
<?php
$callnowcolor = ampforwp_get_setting('amp-opt-color-rgba-colorscheme-call');
	if ( !empty($callnowcolor['color']) ) { ?>
		.h-call a:after{color:<?php echo ampforwp_sanitize_color($callnowcolor['color']);?>;}
	<?php }
 } ?>
<?php if (function_exists('is_shop') && is_shop()){ ?>
.h-shop a:after{align-self: center;}
<?php } ?>
.h-ic{margin:0px 10px; align-self: center;}
.amp-logo a{line-height:0;display:inline-block;<?php if(isset($redux_builder_amp['swift-element-color-control'] ['rgba']) && $redux_builder_amp['swift-element-color-control'] ['rgba']){?>color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-color-control']['rgba'])?>;<?php } ?>}
.logo h1{margin: 0;font-size: 17px;font-weight: 700;text-transform: uppercase;display:inline-block;}
.h-srch a{line-height:1;display:block;}
.amp-logo amp-img{margin: 0 auto;}
@media(max-width:480px){ .h-sing {font-size: 13px;} }
<?php //header-type-1


if($header_type == '1'){?>
.logo{z-index: 2;flex-grow: 1;align-self: center;text-align:center;line-height:0;}
.h-1{display:flex;order:1;}
.h-nav{order: -1;align-self: center;flex-basis: 30px;}
.h-ic:last-child{margin-right:0;}
<?php } ?>
<?php //hyder-type-2

if($header_type == '2'){?>
.h-logo{order:-1;align-self: center;flex-grow:1;text-align:center;}
.h-2{order: 1;justify-content: flex-end;display: flex;}
.h-nav{order: -1;align-self: center;}
.h-sing{font-size: 18px;font-weight: 600;align-self: center;}
.h-sing a{display: inline-block;padding:9px 15px;<?php if(ampforwp_get_setting('signin-button-border-line')){?>border: <?php echo esc_html(ampforwp_get_setting('signin-button-border-line'))?>px solid;<?php } ?><?php if($redux_builder_amp['signin-button-border-color']['rgba']){?>border-color: <?php echo ampforwp_sanitize_color($redux_builder_amp['signin-button-border-color']['rgba'])?>;<?php } ?><?php if($redux_builder_amp['signin-button-text-color']['rgba']){?>color: <?php echo ampforwp_sanitize_color($redux_builder_amp['signin-button-text-color']['rgba'])?>;<?php } ?>}
<?php if($redux_builder_amp['border-type'] == '2'){?>.h-sing a{border-radius:100px;}.h-sing a:before{border-radius:100px;}<?php } ?>
<?php if($redux_builder_amp['border-type'] == '3'){?><?php if($redux_builder_amp['border-radius'] ){ ?>.h-sing a{border-radius:<?php echo esc_html(ampforwp_get_setting('border-radius'))?>px;}<?php } ?><?php } ?>
<?php } ?>
<?php //header-type-3

if($header_type == '3'){?>
.h-logo{order:-1;align-self: center;z-index:2;}
.h-nav{order:0;align-self: center;margin:0px 0px 0px 10px;}
.h-srch a:after{position:relative;left:5px;}
.h-3{order: 1;display: inline-flex;flex-grow: 1;justify-content: flex-end;}
.h-ic:first-child {margin-left: 0;} 
<?php } ?>

<?php //search overlay

if( true == $redux_builder_amp['amp-swift-search-feature'] ){ ?>
.lb-t {position: fixed;top: -50px;width: 100%;width: 100%;opacity: 0;transition: opacity .5s ease-in-out;overflow: hidden;z-index:9;<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>background: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-header-overlay'] ['rgba']) ?>;<?php } ?>}
.lb-t img {margin: auto;position: absolute;top: 0;left:0;right:0;bottom: 0;max-height: 0%;max-width: 0%;border: 3px solid white;box-shadow: 0px 0px 8px rgba(0,0,0,.3);box-sizing: border-box;transition: .5s ease-in-out;}
a.lb-x {display: block;width:50px;height:50px;box-sizing: border-box;background: tranparent;color: black;text-decoration: none;position: absolute;top: -80px;right: 0;transition: .5s ease-in-out;}
a.lb-x:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e5cd";font-family: 'icomoon';font-size: 30px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f00d";font-family: "Font Awesome 5 Free";font-weight:600;font-size:22px;
<?php } ?>
	line-height: 0;display: block;text-indent: 1px;
<?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;<?php } ?> }
.lb-t:target {opacity: 1;top: 0;bottom: 0;left:0;z-index:2;}
.lb-t:target img {max-height: 100%;max-width: 100%;}
.lb-t:target a.lb-x {top: 25px;}
<?php if ( is_admin_bar_showing() ) {?>.lb-t:target a.lb-x {top: 70px;}<?php } ?>
.lb img{cursor:pointer;}
.lb-btn form{position: absolute;top: 200px;left: 0;right: 0;margin: 0 auto;text-align: center;}
.lb-btn .s{padding:10px;}
.lb-btn .icon-search{padding:10px;cursor:pointer;}
.amp-search-wrapper{width: 80%;margin: 0 auto;position: relative;}
.overlay-search:before {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e8b6";font-family: 'icomoon';font-size: 24px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f002";font-family: "Font Awesome 5 Free";font-weight:600;font-size:18px;
<?php } ?>
	position: absolute;right:0;cursor: pointer;top:4px;
<?php if($redux_builder_amp['swift-element-overlay-color-control']['rgba']){?>color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;<?php }  ?>}
.amp-search-wrapper .icon-search {cursor: pointer;background:transparent;border: none;display: inline-block;width: 30px;height: 30px;opacity: 0;position: absolute;z-index:100;right: 0;top: 0;}
.lb-btn .s {padding: 10px;background: transparent;border: none;border-bottom: 1px solid #504c4c;width:100%;
color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;}
<?php } ?>
<?php //menu type-1 

if($redux_builder_amp['menu-type'] == '1'){?>
.m-ctr{<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>background: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-header-overlay'] ['rgba']) ?>;<?php } ?>}
.tg, .fsc{display: none;}
.fsc{width: 100%;height: -webkit-fill-available;position: absolute;cursor: pointer;top:0;left:0;z-index:9;}
<?php if($redux_builder_amp['header-position-type'] == '1'){?>
.tg:checked + .hamb-mnu > .m-ctr {margin-left: 0;border-right: 1px solid <?php if(isset($redux_builder_amp['swift-element-menu-border-color']['rgba'])){echo ampforwp_sanitize_color($redux_builder_amp['swift-element-menu-border-color']['rgba']);}?>;}
<?php $overlaybg = ampforwp_get_setting('swift-header-overlay','rgba'); ?>
.tg:checked + .hamb-mnu > .m-ctr .c-btn {position: fixed;right: 5px;top:5px;
	background: <?php echo ampforwp_sanitize_color( $overlaybg ); ?>;
	border-radius: 50px;}
.m-ctr{margin-left: -100%;float: left;}
<?php } ?>
<?php if($redux_builder_amp['header-position-type'] == '2'){?>
.tg:checked + .hamb-mnu > .m-ctr {margin-left: calc(100% - <?php echo esc_html(ampforwp_get_setting('header-overlay-width'))?>);}
.m-ctr{margin-left: 100%;float: right;}
<?php } ?>
.tg:checked + .hamb-mnu > .fsc{display: block;background: rgba(0,0,0,.9);
<?php if(ampforwp_get_setting('amp-sticky-header') == '1'){?>
	height:100vh;
<?php } else { ?>
	height:100%;
<?php } // sticky condition ends ?>
}
.t-btn, .c-btn{cursor: pointer;}
.t-btn:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content:"\e5d2";font-family: "icomoon";font-size:28px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f0c9";font-family: "Font Awesome 5 Free";font-weight:600;font-size:22px;
<?php } ?>
display:inline-block;
<?php if( isset($redux_builder_amp['swift-element-color-control']['rgba']) && $redux_builder_amp['swift-element-color-control']['rgba']){ ?>color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-color-control']['rgba'])?>;<?php } ?>}
.c-btn:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e5cd";font-family: "icomoon";font-size: 20px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f00d";font-family: "Font Awesome 5 Free";font-weight:600;font-size:18px;
<?php } ?>
<?php if(isset($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']) && $redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;<?php } ?>line-height: 0;display: block;text-indent: 1px;}
.c-btn{float: right;padding: 15px 5px;}
header[style] label.c-btn , header[style] .lb-t:target a.lb-x {margin-top: 30px;}
.m-ctr{transition: margin 0.3s ease-in-out;}
.m-ctr{<?php if(ampforwp_get_setting('header-overlay-width')){?>width:<?php echo esc_html(ampforwp_get_setting('header-overlay-width'))?>;<?php } ?>height:100%;position: absolute;z-index:99;padding: 2% 0% 100vh 0%;}
.m-menu{display: inline-block;width: 100%;padding: 2px 20px 10px 20px;}
.m-scrl{overflow-y: scroll;display: inline-block;width: 100%;max-height: 94vh;}
.m-menu .amp-menu .toggle:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e313";font-family: 'icomoon';font-size:25px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f107";font-family: "Font Awesome 5 Free";font-weight:600;font-size:20px;
<?php } ?>
display: inline-block;top: 1px;padding: 5px;
<?php if( true == ampforwp_get_setting('amp-rtl-select-option') ) { ?>
	transform: rotate(450deg);
	left:0;
	right:auto;
<?php } else{ ?>
	transform: rotate(270deg);
	right:0;
	left:auto;
<?php } ?>
cursor: pointer;border-radius: 35px;color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;}
.m-menu .amp-menu li.menu-item-has-children:after{display:none;}
.m-menu .amp-menu li ul{font-size:14px;}
.m-menu .amp-menu {list-style-type: none;padding: 0;}
.m-menu .amp-menu > li a{<?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;<?php } ?> padding: 12px 7px;margin-bottom:0;display:inline-block;}
.menu-btn{margin-top:30px;text-align:center;}
.menu-btn a{color:#fff;border:2px solid #ccc;padding:15px 30px;display:inline-block;}
.amp-menu li.menu-item-has-children>ul>li {width:100%;}
.m-menu .amp-menu li.menu-item-has-children>ul>li{
	padding-left:0;
	border-bottom: 1px solid <?php if(isset($redux_builder_amp['swift-element-menu-border-color']['rgba'])){echo ampforwp_sanitize_color($redux_builder_amp['swift-element-menu-border-color']['rgba']);}?>;
	margin:0px 10px;
}
.m-menu .link-menu .toggle {
	width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    right: 0;
    cursor:pointer;
}
.m-menu .amp-menu .sub-menu li:last-child{border:none;}
.m-menu .amp-menu a {padding: 7px 15px;}
.m-menu > li{font-size:17px;}
.amp-menu .toggle:after{position:absolute;}
/*New Syles*/
<?php if( true == ampforwp_get_setting('amp-rtl-select-option') ) { ?>
	.m-menu .toggle {float :left;}
<?php } else{ ?>
	.m-menu .toggle {float :right;}
<?php } ?>
	.m-menu input{display:none}
	.m-menu .amp-menu [id^=drop]:checked + label + ul{ display: block;}
	.m-menu .amp-menu [id^=drop]:checked + .toggle:after{transform:rotate(360deg);}
/*New Syles*/
<?php } ?>
.hamb-mnu ::-webkit-scrollbar {display: none;}
<?php //primary menu
$pmenu_bg_clr           = ampforwp_get_setting('primary-menu-background-scheme','rgba');
$pmenu_text_clr			= ampforwp_get_setting('primary-menu-text-scheme','rgba');
if(empty($pmenu_bg_clr)){
	$pmenu_bg_clr ='rgba(239, 239, 239,1)';
}
if(empty($pmenu_text_clr)){
	$pmenu_text_clr ='rgba(53, 53, 53,1)';
}
if( ampforwp_get_setting ('primary-menu') ){?>
.p-m-fl{width:100%;border-bottom: 1px solid rgba(0, 0, 0, 0.05);background:<?php echo ampforwp_sanitize_color($pmenu_bg_clr); ?>;}
.p-menu{width:100%;text-align:center;margin: 0px auto;
	padding: <?php echo ' 0px ' .' '.esc_html(ampforwp_get_setting('primary-menu-padding-control')['padding-right']) .' 0px '.esc_html(ampforwp_get_setting('primary-menu-padding-control')['padding-left']) ; ?>;}
.p-menu ul li{display: inline-block;margin-right: 21px;font-size: 12px;line-height: 20px;letter-spacing: 1px;font-weight: 400;position:relative;}
.p-menu ul li a{
	color:<?php echo ampforwp_sanitize_color($pmenu_text_clr); ?>;
	padding: <?php echo esc_html(ampforwp_get_setting('primary-menu-padding-control')['padding-top']) .' 0px '.esc_html(ampforwp_get_setting('primary-menu-padding-control')['padding-bottom'])  .' 0px' ; ?>;display:inline-block;}
.p-menu input{display:none}
.p-menu .amp-menu .toggle:after{display:none;}
<?php // Dropdown CSS
	if($redux_builder_amp['drp-dwn']){?>
	.p-menu ul li ul{display:block;padding: 7px;
     box-shadow: 1px 1px 15px 1px rgba(0, 0, 0, 0.30);border-radius: 4px;}
	.p-menu ul li:hover>ul {display: block;z-index: 9;}
	.p-menu li a{transition: all 0s ease-in-out 0s;}
	.p-menu .amp-menu li ul{background:<?php echo ampforwp_sanitize_color($pmenu_bg_clr); ?>;left: 0;min-width: 200px;opacity: 1;position: absolute;top: 100%;text-align:left;}
	.p-menu .amp-menu li ul li ul{left: 100%;top: 0;}
	.p-menu li:hover > ul{opacity: 1;transform: translateY(0px);visibility: visible;transition: all 0.1s ease-in-out 0s;} 
	.p-menu li ul li{display: block;position: relative;}
	.p-menu ul li.menu-item-has-children .sub-menu li a{padding:8px 10px 8px 10px;}
	.p-menu .amp-menu .toggle:after {cursor: pointer;
	<?php if ( ampforwp_get_setting('ampforwp_font_icon') == 'swift-icons' ){ ?>
		content: "\e313";font-family: 'icomoon';font-size: 16px;top: 3px;transform: rotate(360deg);
		<?php }
	if ( ampforwp_get_setting('ampforwp_font_icon') == 'fontawesome-icons' ){ ?>
		content:"\f107";font-family: "Font Awesome 5 Free";font-weight:600;font-size:14px;right: 0px;top: 1px;
	<?php } ?>
	display: inline-block;position:relative;padding:0px;line-height:0;
	color:<?php echo ampforwp_sanitize_color($pmenu_text_clr); ?>;}
	.p-menu .amp-menu [id^=drop]:checked + .toggle:after {
	    transform: rotate(-180deg);
	}
	.p-menu .amp-menu li.menu-item-has-children>ul>li{padding:0;}
	@media(max-width:768px){
		.p-menu ul li:hover>ul {display:none;}
		.p-menu .amp-menu [id^=drop]:checked + label + ul{display:block;z-index:9;}
		.p-m-fl{position:relative;}
		.p-menu{white-space: nowrap;overflow: scroll;}
		.p-menu ul li{position: unset;}
		.p-menu .amp-menu .dropdown-toggle + [id^=drop]:checked + label + ul {position: absolute;left: 20px;top:45px;right: 20px;bottom: auto;}
		.p-menu .toggle{background: #ddd;border-radius: 4px;padding: 0px 1px 1px 0px;}
		.p-menu .amp-menu [id^=drop]:checked + .toggle:after {left:0px;}
		.p-menu .amp-menu .toggle:after{left:1px;}
		.p-menu .amp-menu li ul{border-bottom: 1px solid #ccc;}
		.p-menu .amp-menu li ul li ul {left: 0px;top: 0;position: relative;box-shadow: none;border-top: 1px solid #ccc;padding: 0 0 0 10px;margin: 5px 0px 5px 0px;}
		.p-menu .amp-menu li ul li ul li ul{border-bottom: none;}
	}
	@media(max-width:450px){
		.p-menu .amp-menu .dropdown-toggle + [id^=drop]:checked + label + ul {
	    	left: 12px;
	    	right: 12px;
		}
	}
	<?php } else { ?>
	.p-menu{white-space: nowrap;}
		@media(max-width:768px){
			.p-menu{overflow: scroll;}
		}

<?php } // Dropdown CSS Ends
  } // Primary CSS Ends 
} // Levelup condition ends ?>

<?php //Home and Archive

if( ampforwp_is_home() || is_archive() || is_search() || (function_exists('is_shop') && is_shop()) || ampforwp_is_blog() ) { ?>
.hmp{margin-top:34px;display:inline-block;width:100%;  }
.fbp{width:100%;display: flex;flex-wrap: wrap;margin:15px 15px 20px 15px;}
.fbp-img a{display:block;line-height:0;}

<?php if(true == ampforwp_get_setting('ampforwp-full-post-in-loop')){?>
.fbp-img{width:100%;}
<?php }else{ 
if( true == ampforwp_get_setting('ampforwp-homepage-posts-image-modify-size') && true== ampforwp_get_setting('ampforwp-homepage-posts-first-image-modify-size') ){
 ?>
<?php }else{?>
.fbp-c{flex: 1 0 100%;}
<?php }?>
.fbp-img{
<?php 
if( true == ampforwp_get_setting('ampforwp-homepage-posts-image-modify-size') && true== ampforwp_get_setting('ampforwp-homepage-posts-first-image-modify-size') ){
	$fimg_width 	= ampforwp_get_setting('ampforwp-swift-homepage-posts-width');
	$fimg_height = ampforwp_get_setting('ampforwp-swift-homepage-posts-height');
?>
height:<?php echo esc_html($fimg_height).'px';?>;width:<?php echo esc_html($fimg_width).'px';?>;
<?php
}else{
 ?>
	flex-basis: calc(65%);
<?php }?>
	margin-right:30px;
}
.fbp-cnt{flex-basis: calc(31%);}
<?php } ?>

.fbp-cnt .loop-category{margin-bottom:12px;}
.fsp-cnt .loop-category{margin-bottom:7px;}
.fsp-cnt .loop-category li {font-weight: 500;}
.fbp-cnt h2 {margin: 0px;font-size: 32px;line-height: 38px;font-weight:700;}
.fbp-cnt h2 a{color:#191919;}
.fbp-cnt .amp-author {padding-left:6px;}
.fbp:hover .author-name a{text-decoration:underline;}
.fbp-cnt .author-details a{color:#808080;}
.fbp-cnt .author-details a:hover{color: #005be2;}
.loop-wrapper{display: flex;flex-wrap: wrap;margin: -15px;}
.loop-category li{display: inline-block;list-style-type: none;margin-right: 10px;font-size: 10px;font-weight: 600;letter-spacing: 1.5px;}
.loop-category li a{color:#555;text-transform: uppercase;}
.loop-category li:hover a{color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;}
.fbp-cnt p, .fsp-cnt p{color:#444;font-size:13px;line-height:1.5;letter-spacing: 0.10px;word-break: break-word;}
.fbp:hover h2 a, .fsp:hover h2 a{color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;}
.fsp h2 a, .fsp h3 a{color:#191919;}
.fsp{margin: 15px;flex-basis: calc(33.33% - 30px);}
.fsp-img {margin-bottom:10px;}
.fsp h2, .fsp h3{margin:0px 0px 5px 0px;font-size:20px;line-height:1.4;font-weight:500;}
.at-dt{font-size:11px;color:#757575;margin:12px 0px 9px 0px; display: inline-flex;}
.pt-dt,.pt-author{font-size:11px;color:#757575;margin: 8px 0px 0px 0px;display: inline-flex;}
.arch-tlt{margin:30px 0px 30px;display:inline-block;width:100%;}
.amp-archive-title, .amp-loop-label{font-weight:600;}
.amp-archive-desc , .amp-archive-image{font-size: 14px;margin:8px 0px 0px 0px;color: #333;line-height:20px;}
.author-img amp-img {border-radius: 50%;margin: 0px 12px 10px 0px;display: block; width:50px;}
.author-img{float: left;}
.amp-sub-archives{margin:10px 0px 0px 10px;}
.amp-sub-archives ul li{list-style-type: none;display: inline-block;font-size: 12px;margin-right: 10px;font-weight: 500;}
.amp-sub-archives ul li a{color:#005be2;}
.loop-pagination{margin:20px 0px 20px 0px;}
.right a, .left a{background: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;padding: 8px 22px 12px 25px;color: #fff;line-height: 1;border-radius: 46px;font-size: 14px;display: inline-block;}
.right a:hover, .left a:hover{color: <?php echo ampforwp_sanitize_color($swift_btn_hvr_color) ?>;}
.right a:after{content:"\00BB";display: inline-block;padding-left: 6px;font-size: 20px;line-height: 20px;height: 20px;position: relative;top: 1px;}
.left a:before{content:"\00AB";display: inline-block;padding-right: 6px;font-size: 20px;line-height: 20px;height: 20px;position: relative;top: 1px;}
.cntn-wrp.srch p { margin: 30px 0px 30px 0px; }
.cntn-wrp.srch{
font-size:18px;color:#000;line-height:1.7;word-wrap: break-word;
<?php
if(1==ampforwp_get_setting('ampforwp-google-font-switch')){
	if(!empty($font_content) && $font_content != 1){ 	
		$fontFamily = "font-family: '".esc_attr($font_content)."';";
	}  
}
echo sanitize_text_field($fontFamily);
?>
}
@media(max-width:1110px){
    .amppb-fluid .col{max-width:95%}
    .sf-img .wp-caption-text{width:100%;padding:10px 40px;}
    <?php 
    	if( true == ampforwp_get_setting('ampforwp-homepage-posts-image-modify-size') && true== ampforwp_get_setting('ampforwp-homepage-posts-first-image-modify-size') ){
			$fimg_width 	= ampforwp_get_setting('ampforwp-swift-homepage-posts-width');
			$fimg_height = ampforwp_get_setting('ampforwp-swift-homepage-posts-height');
	?>
	.fbp-img{height:<?php echo esc_html($fimg_height).'px';?>;width:<?php echo esc_html($fimg_width).'px';?>;}
	<?php }else{
    ?>
    .fbp-img{flex-basis: calc(64%);}
    <?php }?>
    .fbp-img amp-img img{width:100%;}
    .fbp-cnt h2 {font-size: 28px;line-height: 34px;}
}
@media(max-width:768px){
    .fbp-img {flex-basis: calc(100%);margin-right:0;}
    .hmp{margin:0;}
    .fbp-cnt {float: none;width: 100%;margin-left: 0px;margin-top:10px;display:inline-block;}
    .fbp-cnt .loop-category{margin-bottom:5px;}
    .fbp{margin: 15px;}
    .fbp-cnt p{margin-top:8px;}
    .fsp{flex-basis: calc(100% - 30px);}
    .fsp-img{width:40%;float:left;margin-right:20px;}
    .fsp-cnt{width:54%;float:left;}
    .at-dt{margin: 10px 0px 0px 0px;}
    .hmp .loop-wrapper {margin-top: 0;}
    .arch-tlt{margin:20px 0px;}
    .amp-loop-label {font-size: 16px;}
    .loop-wrapper h2 {font-size: 24px;font-weight:600;}
    
}
@media(max-width:480px){
    .cntr.b-w{padding:0px;}
    .at-dt {margin: 7px 0px 0px 0px;}
    .right, .left{float:none;text-align:center;}
    .right{margin-bottom:30px;}
    .fsp-img{width:100%;float:none;margin-right:0px;}
    .fsp-cnt{width:100%;float:none;padding: 0px 15px 0px 14px;}
    .fsp{border:none; padding:0;}
    .fbp-cnt{margin:0;padding:12px;}
    .tg:checked + .hamb-mnu > .m-ctr .c-btn{ position:fixed; right:5px; top:35px; }
}
@media(max-width:425px){
    .hmp .loop-wrapper {margin: 0;}
    .hmp .fbp {margin: 0px 0px 15px 0px;}
    .hmp .fsp {flex-basis: calc(100% - 0px);margin:15px 0px;}
    .amp-archive-title, .amp-loop-label{padding:0 20px;}
    .amp-sub-archives {margin: 10px 0px 0px 30px;}
    .author-img {padding-left: 20px;}
    .amp-archive-desc{padding:0px 20px;}
    .loop-pagination {margin: 15px 0px 15px 0px;}
}
@media(max-width:375px){
    .fbp-cnt p, .fsp-cnt p{line-height: 19px;letter-spacing: 0;}
}
@media(max-width:320px){
    .right a, .left a {padding: 10px 30px 14px;}
}
<?php }?>
<?php if( !ampforwp_levelup_compatibility('levelup_elementor') ){  // Level up Condition starts?>
<?php //page and frontpage

if( is_page() || ampforwp_is_front_page() || ampforwp_polylang_front_page() ){?>
    <?php if(!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>
        .sp {width: 100%;margin-top: 20px;display: inline-block;}
        .breadcrumbs {padding-bottom: 10px;border-bottom: 1px solid #eee;display: inline-block;width: 100%;font-size: 10px;text-transform: uppercase;}
        #breadcrumbs li{list-style-type:none;}
        #breadcrumbs a {color: #999;}
        #breadcrumbs a:hover {color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;}
        .amp-post-title{font-size: 48px;line-height: 58px;color: #333;margin: 0;padding-top: 15px;}
        <?php if ('above-content' ==  ampforwp_get_setting('swift-social-position')){ ?>
	        .pg .ss-ic{padding-bottom: 10px;margin-bottom: 10px;border-bottom: none;margin-top: 15px;}
	        .shr-txt{display:none;}
	        .pg .cmts{margin-top: unset;}
		<?php }
		else{ ?> .shr-txt {text-transform: uppercase;font-size: 12px;color: #666;font-weight: 400;margin-bottom: 12px;display: block;} <?php } ?>
        .cntn-wrp{font-size: 18px;color: #000;line-height: 1.7;}
        .cntn-wrp small {font-size: 11px;line-height: 1.2;color: #111;}
        .cntn-wrp p, .cntn-wrp ul, .cntn-wrp ol{margin:0px 0px 30px 0px;word-break: break-word;}
    <?php } else{ ?>
        .cntn-wrp{font-size: 18px;color: #000;line-height: 1.7;}
        .sp {width: 100%;margin-top: 20px;display: inline-block;}
    <?php } ?>
    blockquote{margin-bottom:20px;}
	blockquote p {font-size: 34px; line-height: 1.4; font-weight: 700; position: relative; padding: 30px 0 0 0; }
	blockquote p:before {content: "";border-top: 8px solid #000;width: 115px;line-height: 40px;display: inline-block;position: absolute;top: 0;}
	.form-submit #submit{background-color: #005be2;font-size: 14px;text-align: center;border-radius: 3px;font-weight: 500;color: #fff;cursor: pointer;margin: 0;border: 0;padding: 11px 21px;}
	#respond p {margin: 12px 0;}
	<?php if( !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && ampforwp_get_comments_status() && true == ampforwp_get_setting('wordpress-comments-support') ){ ?>
	.amp-comment-button{background-color: <?php echo ampforwp_sanitize_color($swift_cs_color) ?>;font-size: 15px;float: none;margin: 30px auto 0px auto;text-align: center;border-radius: 3px;font-weight: 600;width:250px;}
	.cmts{width:100%;display:inline-block;clear:both;margin-top:40px;}
	.amp-comment-button{background-color: <?php echo ampforwp_sanitize_color($swift_cs_color) ?>;font-size: 15px;float: none;margin: 30px auto 0px auto;text-align: center;border-radius: 3px;font-weight: 600;width:250px;}
	.amp-comment-button a{color: #fff;display: block;padding: 7px 0px 8px 0px;}
	.comment-form-comment #comment {border-color: #ccc;width: 100%;padding: 20px;}
	.cmts h3{margin: 0;font-size: 12px;padding-bottom: 6px;border-bottom: 1px solid #eee;font-weight: 400;letter-spacing: 0.5px;text-transform: uppercase;color: #444;}
	.cmts h3:after{content: "";display: block;width: 115px;border-bottom: 1px solid #005be2;position: relative;top: 7px;}
	.cmts ul{margin-top:16px;}
	.cmts ul li{list-style: none;margin-bottom: 20px;padding-bottom: 20px;border-bottom: 1px solid #eee;}
	.cmts .amp-comments-wrapper ul .children{margin-left:30px; }
	.cmts .cmt-author.vcard .says{display:none;}
	.cmts .cmt-author.vcard .fn{font-size: 12px;font-weight: 500;color: #333;}
	.cmts .cmt-metadata{font-size: 11px;margin-top: 8px;}
	.amp-comments-wrapper ul li:hover .cmt-meta .cmt-metadata a{color:<?php echo ampforwp_sanitize_color($swift_cs_color) ?>;;}
	.cmts .cmt-metadata a{color: #999;}
	.cmt-content{margin-top:6px;width:100%;display:inline-block;}
	.cmt-content p{font-size: 14px;color: #333;line-height: 22px;font-weight: 400;margin: 0;}
	.cmt-meta amp-img{float:left;margin-right:10px;border-radius:50%;width:40px;}
	<?php } ?>

	@media (max-width: 480px){
		blockquote p {font-size:20px;}
	}
<?php } ?>
<?php } // Level Condition Ends
if(is_page() || ampforwp_is_front_page()){ ?>
	.pg table {width: 100%;margin-bottom:25px;overflow-x: auto;word-break: normal;}
	.pg td {padding: 0.5em 1em;border: 1px solid #ddd;}
	.pg tr:nth-child(odd) td {background: #f7f7f7;}
	@media(max-width:767px){
		.pg table{display: -webkit-box;}
	}
<?php } // page table css ends ?>
<?php //AMP Woocommerce condition starts
if( !ampforwp_woocommerce_conditional_check() ) { ?>
<?php if(is_singular()){ ?>
/** Pre tag Styling **/
pre {padding: 30px 15px;background: #f7f7f7;white-space: pre-wrap;;font-size: 14px;color: #666666;border-left: 3px solid;border-color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;margin-bottom: 20px;}
.cntn-wrp{
<?php
$fontFamily = "font-family: Arial, Helvetica, sans-serif";
if(1==ampforwp_get_setting('ampforwp-google-font-switch')){
	$fontFamily = "font-family: 'Poppins', sans-serif;";
	if(isset($redux_builder_amp['amp_font_selector_content_single']) && $redux_builder_amp['amp_font_selector_content_single'] != 1 && !empty($redux_builder_amp['amp_font_selector_content_single'])){ 
		$fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector_content_single']."';";
	}  
}
echo sanitize_text_field($fontFamily);
?>
}
<?php } ?>
<?php if( ampforwp_get_setting('single-design-type') == '1' || ampforwp_get_setting('single-design-type') == '4' ){ 
      // Assigning Full size  if feature img type is not set.
		if( ampforwp_get_setting('swift-featued-image') && empty(ampforwp_get_setting('swift-featued-image-type'))){
		    $redux_builder_amp['swift-featued-image-type'] = 1;
		 }
	 ?>
<?php // Single

if(is_single() && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID())) { ?>
table {
    display: -webkit-box;
    overflow-x: auto;
    word-break: normal;
}
.author-tw:after {font-family:icomoon;content: "\e942";color: #fff;background: #1da1f2;padding: 4px;border-radius: 3px;margin: 0px 5px;text-decoration: none;}
.author-tw:hover{text-decoration: none;}
.artl-cnt table{ margin: 0 auto; text-align: center; width: 100%; }
p.nocomments {padding: 10px;color: #fff;}
.tl-exc{font-size: 16px;color: #444;margin-top: 10px;line-height:20px;}
.amp-category span:nth-child(1) {display: none;}
.amp-category span a, .amp-category span{color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;font-size: 12px;font-weight: 500;text-transform: uppercase;}
.amp-category span a:hover {color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;}
.amp-category span:after{content:"/";display:inline-block;margin:0px 5px 0px 5px;position:relative;top:1px;color:rgba(0, 0, 0, 0.25);}
.amp-category span:last-child:after{display:none;}
.sp{width:100%;margin-top:20px;display:inline-block;}
.amp-post-title{font-size:48px;line-height:58px;color: #333;margin:0;padding-top:15px;
<?php if ( ampforwp_get_setting('swift_cnt_h2') && ampforwp_get_setting('swift_h2_sz') && ampforwp_get_setting('opt-media','url')=='') { ?>
	font-size:<?php echo esc_html( ampforwp_get_setting('swift_h2_sz') )?>;<?php }?>
<?php if ( ampforwp_get_setting('swift_cnt_h1') && ampforwp_get_setting('swift_h1_sz') && ampforwp_get_setting('opt-media','url')!='') { ?>
	font-size:<?php echo esc_html( ampforwp_get_setting('swift_h1_sz') )?>;
<?php }?>}
.sf-img {text-align: center;width: 100%;display: inline-block;height: auto;
<?php if ( ampforwp_get_setting('swift-featued-image-type') == 1) { ?>
	margin-top: 33px;
<?php } 
if ( ampforwp_get_setting('swift-featued-image-type') == 2) { ?>
	margin-bottom: 33px;
<?php } ?>
}
.sf-img figure{margin:0;}
.sf-img .wp-caption-text{
	<?php if ( ampforwp_get_setting('swift-featued-image-type') == 1) { ?>
		width: 1100px;
	<?php }
	if ( ampforwp_get_setting('swift-featued-image-type') == 2) { ?>
		width:100%;
	<?php } ?>
	text-align: left;margin: 0 auto;color: #a1a1a1;font-size: 14px;line-height:20px;font-weight: 500;border-bottom: 1px solid #ccc;padding: 15px 0px;}
.sf-img .wp-caption-text:before{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content:"\e412";font-family: 'icomoon';font-size:24px;
<?php }
 if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f030";font-family: "Font Awesome 5 Free";font-weight:600;font-size: 20px;
<?php } ?>
	position: relative;top: 4px;opacity: 0.4;margin-right: 5px;}
<?php if (!checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ){ ?>
.sp-cnt{margin-top: 40px;clear: both;width: 100%;display: inline-block; }
.sp-rl{display:inline-flex;width:100%;}
.sp-rt{width: 72%;margin-left: 60px;flex-direction: column;justify-content: space-around;order: 1;} <?php } ?>
<?php if(true == ampforwp_get_setting('enable-single-post-social-icons') || true == ampforwp_get_setting('amp-author-name') || true == ampforwp_get_setting('swift-date') || true == ampforwp_get_setting('ampforwp-single-related-posts-switch')){ ?>
.sp-lt{display: flex;flex-direction: column;flex: 1 0 20%;order: 0;max-width:237px;}
<?php } ?>
.ss-ic, .sp-athr, .amp-tags, .post-date{padding-bottom:20px;border-bottom:1px dotted #ccc;}
.shr-txt, .athr-tx, .amp-tags > span:nth-child(1), .amp-related-posts-title, .related-title, .r-pf h3{margin-bottom: 12px;}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{display: block;}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{text-transform: uppercase;font-size: 12px;color: #666;font-weight: 400;}
.loop-date, .post-edit-link{display:inline-block;}
.post-date .post-edit-link{color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;float: right;}
.post-date .post-edit-link:hover{color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;}
.sp-athr, .amp-tags, .post-date{margin-top:20px;}
<?php if( true == ampforwp_get_setting('swift-date') && true == ampforwp_get_setting('amp-published-date-display')) { ?>
@media(min-width:768px){
.post-date.mob-date {display: none;}
}
@media(max-width:768px){
.post-date.desk-date {display: none;}
}
<?php } ?>
.sp-athr .author-details a, .sp-athr .author-details, .amp-tags span a, .amp-tag {font-size: 15px;color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;font-weight: 400;line-height: 1.5;}
.amp-tags .amp-tag:after{content: "/";display: inline-block;padding: 0px 10px;position: relative;top: -1px;color: #ccc;font-size: 12px;}
.amp-tags .amp-tag:last-child:after{display:none;}
.ss-ic li:before{border-radius: 2px;text-align:center;padding: 4px 6px;}
.sgl table {width: 100%;margin-bottom:25px;}
.sgl th , .sgl td {padding: 0.5em 1em;border: 1px solid #ddd;}
<?php if( true == ampforwp_get_setting('amp-author-name') && true == ampforwp_get_setting('amp-author-name-display') ) {?>
@media(min-width:768px){
.sp-athr.mob-athr {display: none;}
}
@media(max-width:768px){
.sp-athr.desk-athr {display: none;}
}
<?php } ?>
<?php // Social Sharing Conditional CSS
if($redux_builder_amp['swift-social-position'] == 'above-content'){?>
.shr-txt{display:none;}
.sp-athr{margin-top:0;}
.sp-rt .ss-ic{padding-bottom: 10px;margin-bottom: 10px;border-bottom: none;}
<?php } 
if($redux_builder_amp['swift-social-position'] == 'below-content'){?>
.shr-txt{display:none;}
.sp-athr{margin-top:0;}
.sp-rt .ss-ic{padding-bottom: 10px;margin-bottom: 20px;}
<?php } ?>


.cntn-wrp{font-size:18px;color:#000;line-height:1.7;word-break: break-word;}
.cntn-wrp small{font-size:11px;line-height:1.2;color:#111;}
.cntn-wrp p, .cntn-wrp ul, .cntn-wrp ol{margin:0px 0px 30px 0px;word-break: break-word;}
.cntn-wrp .wp-block-image,.wp-block-embed{margin:15px 0px;}

.wp-block-embed{margin-top:45px;}
figure.wp-block-embed-twitter { margin: 0; }
.wp-block-embed blockquote a{    
	position: absolute;
	height: 285px;
	z-index: 9;
	margin-top: -40px;
}
@media(max-width:768px){
	.wp-block-embed blockquote a{    
		width: 90%;
	    height: 209px;
	    margin-top: -95px;
	}
	.wp-block-embed{
		margin-top: 95px;
	}
}

.artl-cnt ul li, .artl-cnt ol li{list-style-type: none;position: relative;
<?php if( true == ampforwp_get_setting('amp-rtl-select-option') ) {?> 
padding-right:20px;
<?php } else{ ?>
padding-left: 20px;
<?php } ?>
}
.artl-cnt ul li:before{content: "";display: inline-block;width: 5px;height: 5px;background: #333;position: absolute;top:12px;
<?php if( true == ampforwp_get_setting('amp-rtl-select-option') ) {?> 
	right:0;
<?php } else{ ?>
	left: 0px;
<?php } ?>
}
.artl-cnt ol li {list-style-type: decimal;position: unset;padding: 0;}
.sp-rt p strong, .pg p strong{font-weight: 700;}
@supports (-webkit-overflow-scrolling: touch) {
.m-ctr{overflow:initial;}
}
@supports not (-webkit-overflow-scrolling: touch) {
.m-ctr{overflow:scroll;}
}
.m-scrl {
display: inline-block;
width: 100%;
max-height: 94vh;
}
<?php if($redux_builder_amp['rp_design_type'] == '1'){?>
	.srp{margin-top:20px;}
	.srp .amp-related-posts amp-img{float: left;width: 100%;margin: 0px;height:100%;}
	.srp ul li{display: inline-block;line-height: 1.3;margin-bottom: 24px;list-style-type:none;width:100%;}
	.srp ul li:last-child{margin-bottom:0px;}
	.has_thumbnail:hover {opacity:0.7;}
	.has_thumbnail:hover .related_link a{color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;}
<?php } // Related Posts Desing 1 Ends 
if($redux_builder_amp['rp_design_type'] == '2'){?>
	.srp{
		margin-top: 40px;
	    display: inline-block;
	    width: 100%;
	}
	.srp ul{
		display: flex;
	    flex-wrap: wrap;
	    margin: -15px;
	}
	.srp ul li{
		list-style-type:none;
	    margin: 15px;
    	flex-basis: calc(33.33% - 30px);
	}
	.related_link{
	    margin: 0px 0px 5px 0px;
	    font-size: 18px;
	    line-height: 1.4;
	    font-weight: 500;
	}
	.has_thumbnail:hover .related_link a{
		color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;
	}
	.related_link a{color:#191919;} 
<?php } // Related Posts Desing 2 Ends 
if($redux_builder_amp['rp_design_type'] == '3'){?>
	.srp{
		margin-top: 40px;
	    display: inline-block;
	    width: 100%;
	}
	.has_thumbnail{width:333px;}
	.amp-scrollable-carousel-slide{margin:0px 15px 0px 15px;}
	.srp ul li{
		list-style-type:none;
	}
	.rp-slide{
		display: flex;
	    flex-direction: column;
	    justify-content: space-between;
	}
	.related_link{
	    margin: 0px 0px 5px 0px;
	    font-size: 18px;
	    line-height: 1.4;
	    font-weight: 500;
	}
	.has_thumbnail:hover .related_link a{
		color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;
	}
	.rlp-image{margin-bottom:6px;}
	.related_link p{white-space: pre-wrap;}
	.amp-carousel li:last-child{margin-right:0;}
	.related_link a{color:#191919;white-space: pre-wrap;} }
<?php } // Related Posts Desing 3 Ends ?>
.related_link{margin-top:10px;}
.related_link a{color:#333;}
.related_link p{word-break: break-word;color: #444;font-size: 15px;line-height: 20px;
letter-spacing: 0.10px;margin-top: 5px;font-weight: 400;}
.amp-related-posts ul{list-style-type:none;}
.r-pf{margin-top: 40px;display: inline-block;width: 100%;}
<?php if( 1 == $redux_builder_amp['ampforwp-inline-related-posts'] && is_single() ){ ?>
/** In content releated post desing styles **/
.rp .related-title{
	text-transform: uppercase;
    font-size: 12px;
    color: #666;
    font-weight: 400;
}
.rp .related_link a{
	color:#191919;
	margin: 0px 0px 5px 0px;
    font-size: 18px;
    font-weight: 500;
    display: inline-block;
    line-height: 1.5;
}
.rp .related_link {
    padding: 0px;
    margin: 0;
}
.rp .has_related_thumbnail , .rp .no_related_thumbnail{display: inline-flex;width: 29%;flex-direction: column;margin:0px 30px 30px 0px;justify-content: space-evenly;padding:0;}
.rp .no_related_thumbnail{margin:0px;}
.rp .related_link p{word-break: break-word;color: #444;font-size: 13px;line-height: 20px;
letter-spacing: 0.10px;margin-top: 5px;font-weight: 400;}
.rp ol li::before{ content: " ";}
<?php } ?>
<?php if( true == ampforwp_get_setting('amp-author-description') ) { ?>
.sp-rt .amp-author {padding: 20px 20px;border-radius: 0;background: #f9f9f9;border: 1px solid #ececec;display: inline-block;width: 100%;}
.sp-rt .amp-author-image{float:left;}
<?php if (ampforwp_get_setting('ampforwp-author-page-url')) {?>
.sp-rt .author-details a{color: #222;font-size: 14px;font-weight: 500;}
.sp-rt .author-details a:hover{color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;text-decoration:underline;}
<?php } ?>
.amp-author-image amp-img{border-radius: 50%;margin: 0px 12px 5px 0px;display: block; width:50px;}
.author-details p{margin: 0;font-size: 13px;line-height: 20px;color: #666;padding-top: 4px;}
<?php } ?>
#pagination{margin-top: 30px;border-top: 1px dotted #ccc;padding: 20px 5px 0px 5px;;font-size: 16px;line-height: 24px;font-weight:400;}
.next{float: right;width: 45%;text-align:right;position:relative;margin-top:10px;}
.next a, .prev a{color:#333;}
.prev{float: left;width: 45%;position:relative;margin-top:10px;}
.prev span{text-transform: uppercase;font-size: 12px;color: #666;display: block;position: absolute;top: -26px;}
.next span{text-transform: uppercase;font-size: 12px;color: #666;display: block;font-weight: 400;position: absolute;top: -26px;right:0}
.next:hover a, .prev:hover a{color:<?php echo ampforwp_sanitize_color($hovercolor); ?>;}
.prev:after{border-left:1px dotted #ccc;content: "";height: calc(100% - -10px);right: -50px;position: absolute;top: 50%;transform: translate(0px, -50%);width: 2px;}
<?php if ( !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ) {?>
.ampforwp_post_pagination{width:100%;text-align:center;display:inline-block;}
.ampforwp_post_pagination p{margin: 0;font-size: 18px;color: #444;font-weight: 500;margin-bottom:10px;}
.ampforwp_post_pagination p a{color:#005be2;padding:0px 10px;}
<?php if( true == ampforwp_get_setting('wordpress-comments-support')){ ?>
.cmts{width:100%;display:inline-block;clear:both;margin-top:40px;}
.amp-comment-button{background-color: <?php echo ampforwp_sanitize_color($swift_cs_color) ?>;font-size: 15px;float: none;margin: 30px auto 0px auto;text-align: center;border-radius: 3px;font-weight: 600;width:250px;}
.form-submit #submit{background-color: #005be2;font-size: 14px;text-align: center;border-radius: 3px;font-weight: 500;color: #fff;cursor: pointer;margin: 0;border: 0;padding: 11px 21px;}
#respond p {margin: 12px 0;}
.amp-comment-button a{color: #fff;display: block;padding: 7px 0px 8px 0px;}
.amp-comment-button a:hover{color:<?php echo ampforwp_sanitize_color($swift_btn_hvr_color) ?>;}
.cmt-form-comment #comment {border-color: #ccc;width: 100%;padding: 20px;}
.cmts h3{margin: 0;font-size: 12px;padding-bottom: 6px;border-bottom: 1px solid #eee;font-weight: 400;letter-spacing: 0.5px;text-transform: uppercase;color: #444;}
.cmts h3:after{content: "";display: block;width: 115px;border-bottom: 1px solid <?php echo ampforwp_sanitize_color($swift_cs_color) ?>;position: relative;top: 7px;}
.cmts ul{margin-top:16px;}
.cmts ul li{list-style: none;margin-bottom: 20px;padding-bottom: 20px;border-bottom: 1px solid #eee;}
.cmts .amp-comments-wrapper ul .children{margin-left:30px; }
.cmts .cmt-author.vcard .says{display:none;}
.cmts .cmt-author.vcard .fn{font-size: 12px;font-weight: 500;color: #333;}
.cmts .cmt-metadata{font-size: 11px;margin-top: 8px;}
.amp-comments-wrapper ul li:hover .cmt-meta .cmt-metadata a{color:<?php echo ampforwp_sanitize_color($swift_cs_color) ?>;;}
.cmts .cmt-metadata a{color: #999;}
.cmt-content{margin-top:6px;width:100%;display:inline-block;}
.cmt-content p{font-size: 14px;color: #333;line-height: 22px;font-weight: 400;margin: 0;}
.cmt-meta amp-img{float:left;margin-right:10px;border-radius:50%;width:40px;}
<?php } ?>
.sp-rt .amp-author {margin-top: 5px;}
<?php } ?>
.cntn-wrp a{margin:10px 0px;color: <?php echo ampforwp_sanitize_color($swift_cs_color); ?>;}
.loop-wrapper{display: flex;flex-wrap: wrap;margin: -15px;}
.loop-category li{display: inline-block;list-style-type: none;margin-right: 10px;font-size: 10px;font-weight: 600;letter-spacing: 1.5px;}
.loop-category li a{color:#555;text-transform: uppercase;}
.loop-category li:hover a{color:#005be2;}
.fsp-cnt p{color:#444;font-size:13px;line-height:20px;letter-spacing: 0.10px;word-break: break-word;}
.fsp:hover h2 a{color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;}
.fsp h2 a, .fsp h3 a{color:#191919;}  
.fsp{margin: 15px;flex-basis: calc(33.33% - 30px);}
.fsp-img {margin-bottom:10px;}
.fsp h2, .fsp h3{margin:0px 0px 5px 0px;font-size:20px;line-height:25px;font-weight:500;}
.fsp-cnt .loop-category{margin-bottom:20px;}
.fsp-cnt .loop-category li {font-weight: 500;}
.pt-dt,.pt-author{font-size:11px;color:#808080;margin: 8px 0px 0px 0px;display: inline-flex;}
blockquote{margin-bottom:20px;}
blockquote p {font-size: 34px; line-height: 1.4; font-weight: 700; position: relative; padding: 30px 0 0 0; }
blockquote p:before {content: "";border-top: 8px solid #000;width: 115px;line-height: 40px;display: inline-block;position: absolute;top: 0;}

<?php // Comments Pagination 
if( isset($redux_builder_amp['wordpress-comments-support']) && 1 == $redux_builder_amp['wordpress-comments-support']){?>
.cmts-wrap{display:flex;width:100%;margin-top: 30px;padding-bottom:30px;border-bottom:1px solid #eee;}
.cmts-wrap .page-numbers:after{display:none;}
.cmts .page-numbers{margin:0px 10px;}
.cmts .prev, .cmts .next{margin:0 auto;}
.cmts-wrap a{color:#333;}
.cmts-wrap a:hover{color:<?php echo ampforwp_sanitize_color($swift_cs_color) ?>;}
.cmts-wrap .current{color:<?php echo ampforwp_sanitize_color($swift_cs_color) ?>;}
<?php } // Comments Pagination CSS Ends
if ( true == ampforwp_get_setting('ampforwp-disqus-comments-support') ) {?>
.amp-disqus-comments { text-align:center }
.amp-disqus-comments amp-iframe, .amp-disqus-comments iframe{overflow: auto; overflow-y:scroll;-webkit-overflow-scrolling: touch;}
.amp-disqus-comments iframe{width:100%;height:300px;}<?php 
} ?>

@media(max-width:1110px){
<?php if (!checkAMPforPageBuilderStatus(ampforwp_get_the_ID())){ ?>
    .cntr{width:100%;padding:0px 20px;}
    .sp-rt {margin-left: 30px;}
<?php } ?>
}
@media(max-width:768px){
    .tl-exc {font-size: 14px;margin-top: 3px;line-height: 22px;}
    .sp-rl {display: inline-block;width: 100%;}
    <?php if(true == ampforwp_get_setting('enable-single-post-social-icons') || true == ampforwp_get_setting('amp-author-name') || true == ampforwp_get_setting('swift-date') || true == ampforwp_get_setting('ampforwp-single-related-posts-switch')){ ?>
    .sp-lt {width: 100%;margin-top: 20px;max-width:100%;}
    <?php } ?>
    .sp-cnt{margin-top: 15px;}
    .r-pf h3{padding-top:20px;border-top:1px dotted #ccc; }
    .r-pf {margin-top:20px;}
    <?php if(true == ampforwp_get_setting('wordpress-comments-support')){ ?>
    .cmts{margin:20px 0px 20px 0px;}
    <?php } ?>
    .sp-rt {width: 100%;margin-left: 0;}
    .sp-rt .amp-author {padding: 20px 15px;}
    #pagination {margin: 20px 0px 20px 0px;border-top: none;}
    .amp-post-title{padding-top:10px;}
    .fsp{flex-basis: calc(100% - 30px);}
    .fsp-img{width:40%;float:left;margin-right:20px;}
    .fsp-cnt{width:54%;float:left;}
    <?php if($redux_builder_amp['rp_design_type'] == '1'){?>
	    .srp .related_link{font-size:20px;line-height:1.4;font-weight:600;}
	    .rlp-image{width:200px;float:left;margin-right:15px;display: flex;flex-direction: column;}
	    .rlp-cnt{display: flex;}
    <?php } //Related post Design 1 CSS Ends
    if($redux_builder_amp['rp_design_type'] == '2'){?>
    	.srp ul li{flex-basis: calc(100% - 30px);}
    	.srp li .rlp-image{width:40%;float:left;margin-right:20px;}
    	.srp li .rlp-cnt{width:54%;float:left;}
    <?php } //Related post Design 2 CSS Ends?>
    <?php if (checkAMPforPageBuilderStatus(get_the_ID())){ ?>
    	.sp-cnt{margin-top: 0;}
    <?php } ?>
}
@media(max-width:480px){
	.loop-wrapper{margin-top: 15px;}
    .cntn-wrp p{line-height:1.65;}
    .rp .has_related_thumbnail {width: 100%;}
    .rlp-image {width: 100%;float: none;margin-right: 0px;}
    .rlp-cnt {width: 100%;float: none;}
    .amp-post-title {font-size: 32px;line-height: 44px;}
    .amp-category span a {font-size: 12px;}
    .sf-img{
    <?php if ( ampforwp_get_setting('swift-featued-image-type') == 1 ) { ?>
    	margin-top:20px;
    <?php }  
    if ( ampforwp_get_setting('swift-featued-image-type') == 2 ) { ?>
    	margin-bottom:20px;
	<?php } ?>}
    .sp{margin-top: 20px;}
    .menu-btn a{padding:10px 20px;font-size:14px;}
    .next, .prev{float: none;width: 100%;}
    #pagination {padding: 10px 0px 0px;}
    #respond {margin: 0;}
    .next a {margin-bottom: 45px;display:inline-block;}
    .prev:after{display:none;}
    .author-details p {font-size: 12px;line-height: 18px;}
    .sf-img .wp-caption-text{width:100%;padding:10px 15px;}
    .fsp-img{width:100%;float:none;margin-right:0px;}
    .fsp-cnt{width:100%;float:none;}
    .fsp{border:none; padding:0;}
    .fsp-cnt{padding: 0px 15px 0px 14px;}
    .r-pf .fsp-cnt{padding: 0px;}
     blockquote p {font-size:20px;}
     <?php if($redux_builder_amp['rp_design_type'] == '2'){?>
    	.srp li .rlp-image{width:100%;float:none;margin-right:0px;}
    	.srp li .rlp-cnt{width:100%;float:none;}
    <?php } ?>
}
@media(max-width:425px){
    .sp-rt .amp-author {margin-bottom: 10px;}
    #pagination {margin: 20px 0px 10px 0px;}
	.fsp h2, .fsp h3 {font-size: 24px;font-weight:600;}
}
@media(max-width:320px){
    .cntn-wrp p {font-size: 16px;}  
}
<?php } } ?>
<?php if ( is_single() && true == ampforwp_get_setting('ampforwp-dropcap')) { ?>
.cntn-wrp > p:first-of-type::first-letter{
    float: left;
    <?php $fontsize = ampforwp_get_setting('ampforwp-dropcap-font');
     if (empty($fontsize)){?>font-size: 75px;<?php } else {?>	
    font-size: <?php echo esc_html($fontsize) ?>px;
    <?php } ?>
    line-height: 1;
    padding-right: 8px;
    <?php $color = ampforwp_get_setting('ampforwp-dropcap-color','color','ampforwp_sanitize_hex_color');
	if (empty($color)){?>color: #000;<?php } else {?>	
    color: <?php echo $color ?>;
	<?php } ?>
}
<?php } //Drop Cap CSS ends
} // //AMP Woocommerce condition Ends 
// Menu Search CSS
if( !ampforwp_levelup_compatibility('levelup_elementor') ){ // Level up Condition starts
if ( isset($redux_builder_amp['menu-search']) && $redux_builder_amp['menu-search'] ) { ?>
.m-srch #amp-search-submit {
    cursor: pointer;
    background: transparent;
    border: none;
    display: inline-block;
    width: 30px;
    height: 30px;
    opacity: 0;
    position: absolute;
    z-index: 100;
    right: 0;
    top: 0;
}
.m-srch .amp-search-wrapper{
	border: 1px solid <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;
	background:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;
	width:100%;
	border-radius:60px;
}
.m-srch .s{
	padding:10px 15px;
	border:none;
	width:100%;
	color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-header-overlay'] ['rgba']) ?>;
	background:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;
	border-radius: 60px;
}
.m-srch{
	border-top: 1px solid <?php if(isset($redux_builder_amp['swift-element-menu-border-color']['rgba'])){echo ampforwp_sanitize_color($redux_builder_amp['swift-element-menu-border-color']['rgba']);}?>;
    padding: 20px;
}
.m-srch .overlay-search:before{
	color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-header-overlay'] ['rgba']) ?>;
	padding-right:10px;
	top:6px;
}
<?php } // Menu Search CSS Ends
if ( isset($redux_builder_amp['menu-social']) && $redux_builder_amp['menu-social'] ) { ?>
.m-s-i {
	padding:25px 0px 15px 0px;
	border-top: 1px solid <?php if(isset($redux_builder_amp['swift-element-menu-border-color']['rgba'])){ echo ampforwp_sanitize_color($redux_builder_amp['swift-element-menu-border-color']['rgba']);}?>;
	text-align: center;
}
.m-s-i li{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	font-family: 'icomoon';
	font-size: 20px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	font-family: "Font Awesome 5 Brands";
	font-size:16px;
<?php } ?>
    list-style-type: none;
    display: inline-block;
    margin: 0px 15px 10px 0px;
    vertical-align: middle;
}
.m-s-i li:last-child{
	margin-right:0;
}
.m-s-i li a{
	background: transparent;
	color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;
}
<?php if($redux_builder_amp['enbl-fb']){?>
	.s_fb:after {
	<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
		content: "\e92d";
	<?php }
	if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
		content: "\f082";
	<?php } ?>
	}
<?php } 
if($redux_builder_amp['enbl-tw']){ ?>
.s_tw:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e942";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f099";
<?php } ?>
}
<?php }
if($redux_builder_amp['enbl-gol']){?>
.s_gp:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e931";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f0d5";
<?php } ?>
}
<?php }
if($redux_builder_amp['enbl-lk']){?>
.s_lk:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e934";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f08c";
<?php } ?>
}
<?php }
if($redux_builder_amp['enbl-pt']){?>
.s_pt:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content:"\e937";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f0d2";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enbl-yt']){?>
.s_yt:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e947";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f167";
<?php } ?>
}
<?php }
if($redux_builder_amp['enbl-inst']){?>
.s_inst:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e932";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f16d";
<?php } ?>
}
<?php }
if($redux_builder_amp['enbl-vk']){?>
.ss-ic .s_vk:after,.s_vk:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e944";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"";
	display:inline-block;
	background-image:url(<?php echo AMPFORWP_IMAGE_DIR . '/vk-img.png' ?>);
	width:16px;
	height:16px;
<?php } ?>
}
<?php }
if($redux_builder_amp['enbl-rd']){?>
.s_rd:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e938";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f281";
<?php } ?>;
}
<?php }
if($redux_builder_amp['enbl-tbl']){?>
.s_tbl:after {
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e940";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f173";
<?php } ?>
}
<?php } ?>
<?php } // Menu social CSS Ends
if( isset($redux_builder_amp['amp-swift-menu-cprt']) && $redux_builder_amp['amp-swift-menu-cprt']){?>
.cp-rgt{
	font-size:11px;
	line-height:1.2;
	color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;
	padding: 20px;
	text-align: center;
	border-top: 1px solid <?php if(isset($redux_builder_amp['swift-element-menu-border-color']['rgba'])){ echo ampforwp_sanitize_color($redux_builder_amp['swift-element-menu-border-color']['rgba']);}?>;
}
.cp-rgt a{
	color:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;
	border-bottom:1px solid <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-element-overlay-color-control']['rgba'])?>;
	margin-left:10px;
}
.cp-rgt .view-non-amp{
	display:none;
}
a.btt:hover {
    cursor: pointer;
}
<?php } //Menu Copy Right CSS Ends
} //level up CSS Ends
 //AMP Woocommerce condition starts
if( !ampforwp_woocommerce_conditional_check() ) { 
if( ampforwp_get_setting('single-design-type') == '4' ){
if(is_single() ) { ?>
.sp-rt{
	margin:0;
	width:100%;
}
.sp-rt .amp-author {
    margin-top: 20px;
}
.sp-artl .srp ul{
    display: flex;
    flex-wrap: wrap;
}
.sp-artl .srp .has_thumbnail{
    flex-basis: calc(33.33% - 30px);
}
.sf-img .wp-caption-text{
	width:100%;
}
@media(min-width:768px){
li.has_thumbnail:nth-child(even) {
    margin-left: 30px;
}
}
@media(max-width:768px){
.sp-artl .srp .has_thumbnail{
    flex-basis: calc(100% - 30px);
}
.r-pf h3 {
    padding: 15px 0px 0px;
}
.r-pf .loop-wrapper {
    margin-left: -13px;
}
}

<?php } //is_single condition is added
if ( true == ampforwp_get_setting('gnrl-sidebar') &&  true == ampforwp_get_setting('swift-sidebar') && 4 == ampforwp_get_setting('single-design-type')){?>
.sp-artl{
	display:inline-flex;
	width:100%;
}
.sp-left {
    display: flex;
    flex-direction: column;
    width: <?php if ( ! is_active_sidebar( 'swift-sidebar' ) ) { echo '100%';} else{ echo '70%'; } ?>;
    padding-right: 20px;
}
.sp-artl .srp .has_thumbnail{
	flex-basis: calc(49.33% - 30px);
}
.sp-artl .fsp{
	flex-basis: calc(47.33% - 30px);
}
@media(max-width:768px){
.sp-artl {
    display: block;
}
.sp-left{
	width:100%;
	padding:0;
}
.sp-artl .srp .has_thumbnail, .sp-artl .fsp {
    flex-basis: calc(100% - 15px);
}

}
<?php } // sidebar CSS ends
} // single design 4 ends
} // AMP woocommerce Condition  ends ?>
<?php // Header and Archive Sidebar
if ( ampforwp_get_setting('gbl-sidebar') && ampforwp_get_setting('gnrl-sidebar') && is_active_sidebar( 'swift-sidebar' ) ) { ?>
.b-w, .arch-dsgn{
	display: flex;
}
.arch-psts, .b-w .hmp{
	display: flex;
    flex-direction: column;
    width: 70%;
    padding-right: 20px;
}
/*** Home page ***/
.fbp-img{margin:0px 10px 10px 0px;}
.fbp-cnt {flex-basis: calc(100%);}
.b-w .fsp, .arch-psts .fsp{
	flex-basis: calc(49.33% - 30px);
}
.b-w .sdbr-right{
	margin-top:30px;
}
/** Custom Frontpage PB CSS **/
.cntr.pgb{
	max-width:1400px;
}
.pgb {
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 300px;
}
.pg-lft{
    display: flex;
    flex-direction: column;
    width: auto;
    padding-right: 30px;
}
.pgb .sdbr-right{
	width:auto;
}
@media(max-width:768px){
	.fbp-cnt{
		width:100%;
	}
	.fbp-img{margin:0px;}
	.pg-lft{
		width:100%;
		padding:0;
	}
	.pgb {
	    display: inline-block;
	}
}
<?php }
if ( ( true == ampforwp_get_setting('gbl-sidebar') && ( ampforwp_is_front_page() || ampforwp_is_home() || is_archive() || is_search() || ampforwp_is_blog() ) ) || ( true == ampforwp_get_setting('swift-sidebar') || true == ampforwp_get_setting('page_sidebar') && is_singular() ) || (  (function_exists('is_woocommerce') && is_woocommerce()) && function_exists('ampwcpro_layout_selector') &&  ampwcpro_layout_selector() == 'v3layout' ) ) { ?>
<?php // AMP woocommerce condition starts
if( !ampforwp_woocommerce_conditional_check() || (function_exists('is_woocommerce') && is_woocommerce() ) ){ ?>
/*** Sidebar CSS ***/
<?php if ( is_active_sidebar( 'swift-sidebar' ) || is_active_sidebar( 'amp-shop-sidebar' ) || is_active_sidebar( 'amp-product-sidebar' ) ) : ?>
.sdbr-right{
	<?php if( isset($redux_builder_amp['sidebar-bgcolor']['rgba']) && $redux_builder_amp['sidebar-bgcolor']['rgba'] ) {?>
		background:<?php echo ampforwp_sanitize_color($redux_builder_amp['sidebar-bgcolor']['rgba'])?>;
	<?php } ?>
	display:flex;
	flex-direction:column;
	width:30%;
}
.amp-sidebar{
	padding:20px;
	font-size: 14px;
    line-height: 1.5;
   	<?php if(isset($redux_builder_amp['sbr-text-color']['rgba']) &&  $redux_builder_amp['sbr-text-color']['rgba'] ) {?>
		color: <?php echo ampforwp_sanitize_color($redux_builder_amp['sbr-text-color']['rgba']) ?>;
	<?php } ?>
}
.amp-sidebar ul li{
	list-style-type: none;
	border-bottom: 1px solid #ddd;
    border-top: 1px solid #ddd;
    padding: 0.5em 0;
}
.amp-sidebar ul li + li {
    margin-top: -1px;
}
.amp-sidebar ul li ul {
    margin: 0 0 -1px;
    padding: 0;
    position: relative;
}
.amp-sidebar ul li li {
    border: 0;
    padding-left: 24px
}
.amp-sidebar ul li a:hover, .calendar_wrap a:hover{
	box-shadow: inset 0 0 0 rgba(0, 0, 0, 0), 0 3px 0 <?php echo ampforwp_sanitize_color($swift_cs_color) ?>;
}
.amp-sidebar form{
  display:inline-flex;
  flex-wrap:wrap;
  align-items: center;
}
.amp-sidebar .search-submit{
  text-indent: -9999px;
    padding: 0;
    margin: 0;
    background: transparent;
    line-height: 0;
    display: inline-block;
    opacity: 0;
}
.amp-sidebar .hide{
    display: none;
}
.amp-sidebar .search-field{
    border: 1px solid #ccc;
    padding: 6px 10px;
}
.sgl .calendar_wrap td{
	padding:10px;
}
thead th {
    border-bottom: 2px solid #bbb;
    padding: 0.5em;
}
.amp-sidebar .gallery-item {
    display: inline-block;
    text-align: left;
    vertical-align: top;
    margin: 0 0 1.5em;
    padding: 0 1em 0 0;
    width: 50%;
}
.amp-sidebar .gallery-item:hover{
	opacity:0.5;
}
.amp-sidebar h4{
<?php if(isset($redux_builder_amp['sbr-heading-color']['rgba']) &&  $redux_builder_amp['sbr-heading-color']['rgba'] ) {?>
	color: <?php echo ampforwp_sanitize_color($redux_builder_amp['sbr-heading-color']['rgba']) ?>;
<?php } ?>
    font-size: 12px;
    text-transform: uppercase;
    margin-bottom: 2em;
	font-weight: 800;
    letter-spacing: 0.1818em;
}
.amp-sidebar .tagcloud a, .wp_widget_tag_cloud a {
    border: 1px solid #d1d1d1;
    box-shadow: none;
    display: inline-block;
    margin-bottom:5px;
    padding: 4px 10px 5px;
    position: relative;
    transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;
    width: auto;
    word-wrap: break-word;
    z-index: 0;
}
.amp-sidebar .tagcloud a:hover, .wp_widget_tag_cloud a:hover{box-shadow:none;border:1px solid #888;}
.amp-sidebar .tagcloud ul li {
    float: left;
    border-top: 0;
    border-bottom: 0;
    padding: 0;
    margin: 4px 4px 0 0;
}
.amp-sidebar p{
	margin-bottom:15px;
}
<?php endif; ?>
@media(max-width:768px){
.sdbr-right{
	width:100%;
}
.b-w .hmp, .arch-psts{
	width:100%;
	padding:0;
}
.b-w, .arch-dsgn{
	display: block;
}
.b-w .fsp, .arch-psts .fsp{
    flex-basis: calc(100%);
}
}
<?php } // AMP woocommerce condition ends
 } //Header and Archive Sidebar CSS Ends ?>
<?php 
if( !ampforwp_levelup_compatibility('levelup_elementor') ){ // Level up Condition starts 
//Footer
if ( isset($redux_builder_amp['footer-type']) && '1' == $redux_builder_amp['footer-type'] ) { ?>
.footer{margin-top: 80px;}
<?php if($redux_builder_amp['footer2-position-type'] == '1'){?>
.f-menu ul li .sub-menu{display:none;}
.f-menu ul li{display:inline-block;margin-right:20px;}
.f-menu ul li a {padding:0;color:#575656;}
.f-menu ul > li:hover a{color: <?php echo ampforwp_sanitize_color($hovercolor); ?>;}
.f-menu{font-size:14px;line-height:1.4;margin-bottom:30px;}
.rr{font-size: 12px;color: <?php echo ampforwp_sanitize_color(ampforwp_get_setting('swift-footer-txt-clr','rgba')) ?>;}
.rr span{margin:0 10px 0 0px}
.f-menu ul li.menu-item-has-children:hover > ul{display:none;}
.f-menu ul li.menu-item-has-children:after{display:none;}
<?php } ?>
<?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
.f-w-f1{
padding:<?php
if(ampforwp_get_setting('ftr1-gapping') ){
	echo ' ' . esc_html($redux_builder_amp['ftr1-gapping']['padding-top']);
	echo ' ' . esc_html($redux_builder_amp['ftr1-gapping']['padding-right']);
	echo ' ' . esc_html($redux_builder_amp['ftr1-gapping']['padding-bottom']);
	echo ' ' . esc_html($redux_builder_amp['ftr1-gapping']['padding-left']);
}
?>;
width:100%; border-top: 1px solid <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-footer-brdrclr']['rgba'])?>;}
<?php endif; ?>
.f-w{display: inline-flex;width: 100%;flex-wrap:wrap;margin:15px -15px 0px;}
.f-w-f2{text-align: center;border-top: 1px solid <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-footer-brdrclr']['rgba'])?>;
padding:<?php
if(ampforwp_get_setting('ftr2-gapping')){
	echo ' ' . esc_html($redux_builder_amp['ftr2-gapping']['padding-top']);
	echo ' ' . esc_html($redux_builder_amp['ftr2-gapping']['padding-right']);
	echo ' ' . esc_html($redux_builder_amp['ftr2-gapping']['padding-bottom']);
	echo ' ' . esc_html($redux_builder_amp['ftr2-gapping']['padding-left']);
}
?>;
}
.w-bl{margin-left: 0;display: flex;flex-direction: column;position: relative;flex: 1 0 22%;margin:0 15px 30px;line-height:1.5;font-size:14px;}
.w-bl h4{font-size: <?php echo esc_html(ampforwp_get_setting('swift-head-size')); ?>;font-weight: <?php echo esc_html(ampforwp_get_setting('swift-head-fntwgth')) ?>;margin-bottom: 20px;text-transform: uppercase;letter-spacing: 1px;padding-bottom: 4px;}
.w-bl ul li{list-style-type: none;margin-bottom: 15px;}
.w-bl ul li:last-child{margin-bottom:0;}
.w-bl ul li a{text-decoration: none;}
.w-bl .menu li .sub-menu, .w-bl .lb-x{display:none;}
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
.w-bl .search-button:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e8b6";font-family: 'icomoon';font-size: 23px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f002";font-family: "Font Awesome 5 Free";font-weight:600;font-size:18px;
<?php } ?>
	display:inline-block;
    cursor: pointer;
}
.w-bl .search-field{
	border: 1px solid #ccc;
    padding: 6px 10px;
}

<?php /*** New footer Features ***/
if( isset($redux_builder_amp['footer-customize-options']) && true ==  $redux_builder_amp['footer-customize-options']) { ?>
.f-w{
	flex-wrap:wrap;
}
.f-w-f1{
	<?php if( $redux_builder_amp['swift-footer-bg']['rgba'] ) {?>
		background:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-footer-bg']['rgba'])?>; 
	<?php } ?>
		font-size: <?php echo esc_html(ampforwp_get_setting('swift-footer1-cntnsize'))?>; 
	    line-height: 1.5;
    <?php if( ampforwp_get_setting('swift-footer-txt-clr','rgba') ) {?>
		color: <?php echo ampforwp_sanitize_color(ampforwp_get_setting('swift-footer-txt-clr','rgba')) ?>;
	<?php } ?>
}
.w-bl h4{
<?php if( $redux_builder_amp['swift-footer-heading-clr']['rgba'] ) {?>
	color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-footer-heading-clr']['rgba']) ?>;
<?php } ?>
}
.w-bl a, .f-menu ul li a, .rr a{
<?php if( $redux_builder_amp['swift-footer-link-clr']['rgba'] ) {?>
	color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-footer-link-clr']['rgba']) ?>;
<?php } ?>
}
.w-bl a:hover, .f-menu ul li a:hover, .rr a:hover{
<?php if( $redux_builder_amp['swift-footer-link-hvr']['rgba'] ) {?>
	color: <?php echo ampforwp_sanitize_color($redux_builder_amp['swift-footer-link-hvr']['rgba']) ?>;
<?php } ?>
}
.w-bl p{
    margin-bottom:15px;
}
.f-w-f2{
<?php if( $redux_builder_amp['swift-footer2-bg']['rgba'] ) {?>
	background:<?php echo ampforwp_sanitize_color($redux_builder_amp['swift-footer2-bg']['rgba'])?>;
<?php } ?>
	display: inline-block;
    clear: both;
    width: 100%;
}
<?php if($redux_builder_amp['footer2-position-type'] == '2'){?>
.f-w-f2{
	font-size:<?php echo esc_html(ampforwp_get_setting('swift-footer2-fntsize'))?>;
}
.f-menu{
	display:inline-block;
	float:right;
	margin:0;
}
.f-menu ul li{
	margin:0;
	display: inline-block;
}
.f-menu ul li .sub-menu{display:none;}
.f-menu ul li a:after{
	content: "|";
    display: inline-block;
    color: #888888;
    position: relative;
    left: 2px;
    padding: 0px 5px;
}
.f-menu ul li:last-child a:after{
	display:none;
}
.rr{
	display:inline-block;
	float:left;
	color: <?php echo ampforwp_sanitize_color(ampforwp_get_setting('swift-footer-txt-clr','rgba')) ?>;
}
@media(max-width:768px){
.f-menu{
	float:none;
}
.rr {
	float:none;
    font-size: 13px;
    margin-top:15px;
    display:block;
}
}
<?php } ?>
<?php } // New footer feature closed
else{ // Default Footer CSS ?>
	.f-menu {font-size: 14px;line-height: 1.4;margin-bottom: 30px;}
	.f-menu ul li {display: inline-block;margin-right: 20px;}
	.f-menu .sub-menu{display:none;}
	.rr{font-size:13px;color: <?php echo ampforwp_sanitize_color(ampforwp_get_setting('swift-footer-txt-clr','rgba')) ?>;}
<?php } // If advanced footer is disabled Default Footer CSS will be load ?>
@media(max-width:768px){
    .footer {margin-top: 60px;}
    .w-bl{flex:1 0 22%;}
    .f-menu ul li {margin-bottom:10px;}
}
@media(max-width:480px){
    .footer {margin-top: 50px;}
    <?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
    .f-w-f1 { padding: 45px 0px 10px 0px;}
    <?php endif; ?>
    .f-w-f2 {padding: 25px 0px;}
    .f-w{display:block;margin: 15px 0px 0px;}
    .w-bl{margin-bottom:40px;}
    .w-bl{flex:100%;}
    .w-bl ul li {margin-bottom: 11px;}
    .f-menu ul li {display: inline-block;line-height: 1.8;margin-right: 13px;}
    .f-menu .amp-menu > li a {padding: 0;font-size: 12px;color: #7a7a7a;}
    .rr {margin-top: 15px;font-size: 11px;
    	<?php if($redux_builder_amp['amp-gdpr-compliance-switch'] == '1'){?>
			line-height:1.8;
		<?php } ?>
	}
}
@media(max-width:425px){
    .footer {margin-top: 35px;}
    <?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
    .f-w-f1 {padding: 35px 0px 10px 0px;}
    <?php endif; ?>
    .w-bl h4 {margin-bottom: 15px;}
}
<?php if( checkAMPforPageBuilderStatus(get_the_ID()) && (ampforwp_is_front_page() || is_page()) ) { ?>
.footer{margin-top: 0px;}
<?php } ?>
<?php if( ampforwp_is_home() || ampforwp_is_blog() ) { ?>
.footer{margin-top: 40px;}
<?php } ?>
<?php } ?>
<?php

 //Sticky Social Icons
if(is_single() || is_page() ){ ?>
.ss-ic ul li{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	font-family: 'icomoon';
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	font-family: "Font Awesome 5 Brands";
	font-size:16px;
<?php } ?>
list-style-type:none;display:inline-block;}
.ss-ic li a{color: #fff;padding: 5px;border-radius: 3px;margin: 0px 10px 10px 0px;display: inline-block;}
.ss-ic li a.s_tw {color: #1da1f2;}
.ss-ic li a.s_li {color: #00cc00;}
<?php if($redux_builder_amp['enable-single-facebook-share'] || $redux_builder_amp['enbl-fb'] ){?>
.ss-ic ul li .s_fb{	color:#fff;background:#3b5998;}
.s_fb:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
		content: "\e92d";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f09a";
<?php } ?>
}
<?php }
if(ampforwp_get_setting('enable-single-facebook-share-messenger')){?>
.s_fb_ms{color:#fff;background:#3b5998;}
.s_fb_ms:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e935";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f39f";
<?php } ?>
}	
<?php }	
if($redux_builder_amp['enable-single-twitter-share'] || $redux_builder_amp['enbl-tw']){?>
<?php if(function_exists('mvp_setup')){?>
.zox_tw:after{ <?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e942";
	font-family: 'icomoon';
<?php }?>
<?php if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
content:"\f099";
font-family:"Font Awesome 5 Brands";
<?php } ?>
	color: #1da1f2;
}
<?php } ?>
.s_tw{background:#1da1f2;}
.s_tw:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e942";
	color:#fff;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f099";
	color:#fff;
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-linkedin-share'] || $redux_builder_amp['enbl-lk']){?>
.s_lk{background:#0077b5;}
.s_lk:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e934";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f08c";
<?php } ?>
}
<?php }
if($redux_builder_amp['enable-single-pinterest-share'] || isset($redux_builder_amp['enbl-pt']) && $redux_builder_amp['enbl-pt']){?>
.s_pt{background:#bd081c;}
.s_pt:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content:"\e937";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f0d2";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-email-share']){?>
.s_em{background:#b7b7b7;}
.s_em:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e930";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f0e0";
	font-family: "Font Awesome 5 Free";
<?php } ?>
}
<?php }
if($redux_builder_amp['enable-single-whatsapp-share']){?>
.s_wp{background:#075e54;}
.s_wp:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e946";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f232";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-odnoklassniki-share']){?>
.s_od{background:#ed812b;}
.s_od:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e936";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f263";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-vk-share']){?>
.s_vk{background:#45668e;}
.s_vk:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e944";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"";
	display:inline-block;
	background-image:url(<?php echo AMPFORWP_IMAGE_DIR . '/vk-img.png' ?>);
	width:16px;
	height:16px;
<?php } ?>
}
<?php } 
if(ampforwp_get_setting('enable-single-line-share') == true)  { ?>
.s_li{background:#00cc00;}
<?php }
if(ampforwp_get_setting('enable-single-mewe-share') == true)  { ?>
.s_mewe{background:#b8d6e6;}
<?php }
if(ampforwp_get_setting('enable-single-flipboard-share') == true)  { ?>
.s_flipboard{background:#f52828;}
<?php }	
if($redux_builder_amp['enable-single-reddit-share']){?>
.s_rd{background:#ff4500;}
.s_rd:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e938";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f281";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-tumblr-share']){?>
.s_tb{background:#35465c;}
.s_tb:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e940";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f173";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-telegram-share']){?>
.s_tg{background:#0088cc;}
.s_tg:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e93f";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f3fe";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-stumbleupon-share']){?>
.s_su{background:#eb4924;}
.s_su:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e93e";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f1a3";
<?php } ?>
}
<?php }
if($redux_builder_amp['enable-single-wechat-share']){?>
.s_wc{background:#7bb32e;}
.s_wc:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e945";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f1d7";
<?php } ?>
}
<?php } 
if($redux_builder_amp['enable-single-viber-share']){?>
.s_vb{background:#59267c;}
.s_vb:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e943";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f409";
<?php } ?>
}
<?php }
if(isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
.s_ym{background:#e26426}
.s_ym:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e948";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f39f";
<?php } ?>
}
<?php }
if(isset($redux_builder_amp['enable-single-hatena-bookmarks']) && $redux_builder_amp['enable-single-hatena-bookmarks']){?>
.s_hb{background:#00a4de}
.s_hb:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e948";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"";
	display:inline-block;
	background-image:url(<?php echo AMPFORWP_IMAGE_DIR . '/hatena-img.png' ?>);
	width:16px;
	height:16px;
<?php } ?>
}
<?php }
if(isset($redux_builder_amp['enable-single-pocket-share']) && $redux_builder_amp['enable-single-pocket-share']){?>
.s_pk{background:#ef3f56}
.s_pk:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e949";
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f265";
<?php } ?>
}
<?php } ?>
<?php if ( true == ampforwp_get_setting('enable-single-flipboard-share') ) {?>
.s_fd{background:#f52828}
<?php } ?>
<?php if( ampforwp_get_setting('enable-single-social-icons') || (is_page() && ampforwp_get_setting('ampforwp-page-sticky-social')) ){ ?>
.s_stk{background: #f1f1f1;display:inline-block;width: 100%;padding:0;position:fixed;bottom: 0;text-align: center;border: 0;}
.s_stk ul{width:100%;display:inline-flex;}
.s_stk ul li{flex-direction: column;flex-basis: 0;flex: 1 0 5%;max-width: calc(100% - 10px);display: flex;height:40px}
.s_stk li a{margin:0;border-radius: 0;padding:12px;}
<?php } //Sticky CSS Condition ends
 } ?>
<?php } // levelup condition ends ?>
<?php if( ampforwp_get_setting('enable-single-social-icons')  && is_single() ) { ?>
.body.single-post{
  padding-bottom:40px;
}
.s_stk{
	z-index:99999999;
}
.body.single-post .adsforwp-stick-ad, .body.single-post amp-sticky-ad{
	padding-bottom:45px;
	padding-top:5px;
}
.body.single-post .ampforwp-sticky-custom-ad{
	bottom: 40px;
    padding: 3px 0px 0px;
}
.body.single-post .afw a{line-height:0;}
.body.single-post amp-sticky-ad amp-sticky-ad-top-padding{height:0px;}
<?php } //Sticky CSS Condition ends?>
<?php if( ampforwp_get_setting('ampforwp-advertisement-sticky-type') == 3) {?>
	.btt{z-index:9999;}
<?php } // advanced ads type 3 ends here ?>
<?php if(!ampforwp_levelup_compatibility('levelup_elementor') ){  // Level up Condition starts ?>
.content-wrapper a, .breadcrumb ul li a, .srp ul li, .rr a{transition: all 0.3s ease-in-out 0s;}
[class^="icon-"], [class*=" icon-"] {font-family: 'icomoon';speak: none;font-style: normal;font-weight: normal;font-variant: normal;text-transform: none;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
<?php if(true == ampforwp_get_setting('enable-amp-ads-1')||true == ampforwp_get_setting('enable-amp-ads-2')||true == ampforwp_get_setting('enable-amp-ads-3')||true == ampforwp_get_setting('enable-amp-ads-4')||true == ampforwp_get_setting('enable-amp-ads-5')||true == ampforwp_get_setting('enable-amp-ads-6')){?>
body .amp-ad-wrapper{width:100%;text-align:center;margin: 10px 0;}
.amp-ad-wrapper span { display: inherit; font-size: 12px; line-height: 1;}
<?php } ?>
<?php if( isset($redux_builder_amp['enable-amp-ads-1'] ) && $redux_builder_amp['enable-amp-ads-1'] ) { ?>.amp_ad_1{margin: -2px 0px -17px 0px;}<?php } 
if( isset($redux_builder_amp['enable-amp-ads-2'] ) && $redux_builder_amp['enable-amp-ads-2'] ) { ?>.amp_ad_2{margin: 20px 0px -23px 0px; }<?php } 
if( isset($redux_builder_amp['enable-amp-ads-3'] ) && $redux_builder_amp['enable-amp-ads-3'] ) { ?>.amp-ad-3{margin: 0px 0px -4px 0px;}<?php }
if( isset($redux_builder_amp['enable-amp-ads-4'] ) && $redux_builder_amp['enable-amp-ads-4'] ) { ?>.amp_ad_4{margin: 20px 0px 20px 0px;}<?php }
if( isset($redux_builder_amp['enable-amp-ads-5'] ) && $redux_builder_amp['enable-amp-ads-5'] ) { ?>.amp_ad_5{margin: 10px 0px -17px 0px;}<?php }
if( isset($redux_builder_amp['enable-amp-ads-6'] ) && $redux_builder_amp['enable-amp-ads-6'] ) { ?>.amp-ad-6{ margin: 0px 0px 20px 0px;}<?php } ?>
<?php if( true == $redux_builder_amp['amp-enable-notifications'] ) {?>
	#amp-user-notification1{padding: 5px;text-align: center;background: #fff;border-top: 1px solid #005be2;}
	#amp-user-notification1 p {display: inline-block;margin: 20px 0px;}
	amp-user-notification button {padding: 8px 10px;background: <?php echo ampforwp_get_setting('swift-color-scheme','color'); ?>;color: #fff;margin-left: 5px;border: 0;}
	amp-user-notification .amp-not-privacy{color:<?php echo ampforwp_get_setting('swift-color-scheme','color'); ?>;font-size: 15px;margin-left: 5px;}
<?php } // Notice bar CSS Ends?>
<?php } // Levelup Condition ends?>
<?php 

//RTL Styles 
if( true == $redux_builder_amp['amp-rtl-select-option'] ) {?> 
.body{direction:rtl;}
.h-1 {order: -1;}
.h-nav{order: 1;}
.h-2 {order: -2;}
.h-3 {order: -2;justify-content: flex-start;}
.h-3 .h-srch{margin-left:0;}
.h-3 .h-nav {order: -1;margin: 0px 10px 0px 0;}
<?php if ( ampforwp_get_setting('gbl-sidebar') && ampforwp_get_setting('gnrl-sidebar') && is_active_sidebar( 'swift-sidebar' ) ) { ?>
.fbp-img {margin: 0px 0px 10px 10px;}
<?php } else{ ?>
.fbp-img{margin-left: 30px;margin-right: 0;}
<?php } ?>
.fbp-cnt, .fsp-cnt{text-align:right;}
.right a, .left a{direction:rtl;}
.right a:after{padding:0px 6px 0px 0px;top:-1px;}
.left a:before{padding:0px 0px 0px 6px;top:1px;}
.w-bl{direction:rtl;}
.loop-wrapper{direction:rtl;}
.breadcrumb, .amp-category{direction:rtl;}
.item-home:after {padding-right: 5px;}
.amp-post-title{text-align: right;}
.post-date .post-edit-link {float: left;}
.sp-rt{direction: rtl;margin-right: 50px;margin-left:0;}
.sp-rt .amp-author .amp-author-image {float: right;}
.amp-author-image amp-img {margin: 0px 0px 5px 12px;}
.prev {float: right;}
.next {float: left;}
.r-pf{direction:rtl;}
.prev:after {left: -25px;right:auto;}
.f-menu, .p-menu{direction:rtl;}
.sp-lt {direction: rtl;}
.cmt-meta amp-img {float: right;margin-left: 10px;}
.archive .author-img {float: right;}
.archive  .author-img amp-img {margin: 0px 0px 10px 12px;}
.amp-archive-title, .amp-archive-desc{text-align:right;}

@media(max-width:768px){
.fbp-img{margin-left: 0px;margin-right: 0;}
.fsp-img {float: right;margin-right: 0;margin-left:20px;}
.rlp-image {float: right;margin-left: 15px;margin-right: 0;}
.sp-rt{margin-right:0}
}
@media(max-width:480px){
.next a {text-align: left;}
.next span{right:auto;left:0;}
.post-date .post-edit-link {float: left;}
.fsp-cnt{width:100%;float:none;display:inline-block;}
}
<?php } // Menu RTL Styles 
if( true == $redux_builder_amp['amp-rtl-select-option'] ) {?> 
.h-nav {
    order: -1;
}
.h-1 {
    order: 0;
}
.c-btn {
    float: left;
}
.overlay-search:before{
	left:0;
	right:auto;
}
a.lb-x{
	left:0;
	right:auto;
}
<?php if($redux_builder_amp['header-position-type'] == '1'){?>
.tg:checked + .hamb-mnu > .m-ctr {
    margin-right: 0%;
}
.m-ctr{
    margin-right: -100%;
    float: left;
}
<?php } ?>
<?php if($redux_builder_amp['header-position-type'] == '2'){?>
.tg:checked + .hamb-mnu > .m-ctr {
    margin-right: calc(100% - <?php echo esc_html(ampforwp_get_setting('header-overlay-width'))?>);
}
.m-ctr{
    margin-right: 100%;
    float: right;
}
<?php } ?>
.m-menu li.menu-item-has-children:hover:after {
    right: auto;
    left:0;
}
.m-menu ul li.menu-item-has-children:after{
    right: auto;
    left:0;
}
.amp-ad-wrapper{direction:ltr;}
<?php } //RTL End ?>
<?php 
if( !ampforwp_levelup_compatibility('levelup_elementor') ){ // Level up Condition starts 
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
<?php } // levelup condition ends here?>
<?php if (checkAMPforPageBuilderStatus(get_the_ID())){ ?>
	.sp-cnt .cntr {max-width: 100%;margin:0;width:100%;padding:0}
	.amp_mod.text-mod p {margin: 0 0 1.5em;}	
<?php } ?> 
<?php //Breadcrumbs
if( !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) && ( (is_single() && true == ampforwp_get_setting('ampforwp-bread-crumb')) || (is_page() && ampforwp_get_setting('ampforwp_pages_breadcrumbs'))) || (is_archive() && true == ampforwp_get_setting('ampforwp-yoast-bread-crumb') ) ) {?>
.breadcrumbs{padding-bottom: 8px;margin-bottom: 20px;
<?php if( true == ampforwp_get_setting('breadcrumb-border') ) {?>
border-bottom: 1px solid #eee;
<?php }?>}
.breadcrumb ul li,.breadcrumbs span{display: inline-block;list-style-type: none;font-size: 10px;text-transform: uppercase;margin-right: 5px;}
.breadcrumb ul li a, .breadcrumbs span a, .breadcrumbs .bread-post{color: #999;letter-spacing: 1px;}
.breadcrumb ul li a:hover, .breadcrumbs span a:hover{color: <?php echo $hovercolor; ?>;}
.breadcrumbs li a:after, .breadcrumbs span a:after{
<?php if ( $ampforwp_font_icon == 'swift-icons' ){ ?>
	content: "\e315";font-family: 'icomoon';font-size: 12px;
<?php }
if ( $ampforwp_font_icon == 'fontawesome-icons' ){ ?>
	content:"\f105";font-family: "Font Awesome 5 Free";font-weight:600;font-size:11px;
<?php } ?>
	display: inline-block;color: #bdbdbd;padding-left: 5px;position: relative;top: 1px;}
.breadcrumbs li:last-child a:after {display: none;}
.archive .breadcrumbs {margin-top: 20px;}
<?php } //Breadcrumbs Ends?>
<?php if(true == ampforwp_get_setting('ampforwp-smooth-scrolling-for-links')){?>
    html {
   scroll-behavior: smooth;
  }
<?php } 
// Infinate Scroll Home & Archive page CSS
if( true == ampforwp_get_setting('ampforwp-infinite-scroll') && ampforwp_get_setting('ampforwp-infinite-scroll-home') ){?>
	/** Home & Archive CSS **/
	.body amp-next-page{
	   margin:0px -30px 0px -30px
	}
	.amp-next-page-default-separator {
	    padding-top: 30px;
	    border:none;
	}

	@media(max-width:1024px){
	    .body amp-next-page {
	        margin: 0px -20px 0px -20px;
	    }
	    .amp-next-page-default-separator {
	        padding-top: 10px;
	    }
	}
	@media(max-width:480px){
	    .body amp-next-page {
	        margin: 0px;
	    }
	    .fsp, .fbp{
		    margin:15px 0px;
		}
		.loop-wrapper{margin:0;display: inline-block;}
	}

<?php } // Infinate Scroll Single page CSS
if( true == ampforwp_get_setting('ampforwp-infinite-scroll') && ampforwp_get_setting('ampforwp-infinite-scroll-single') ){?>
	.r-pf .fsp {
	    margin: 15px;
	}
	@media(max-width:1024px){
	    .body amp-next-page {
		    margin: 0px 0px 0px 0px;
		}
	}
<?php }
// image floats removed in mobile view #2525
if( function_exists('if_is_levelup') && !if_is_levelup() && !if_levelup_has_builder() ){ // Level up Condition starts 
if(is_singular() || ampforwp_is_front_page()){?>
@media(max-width:480px){
.content-wrapper .alignright , .content-wrapper .alignleft {
  float:none;
  margin:0 auto;
}
}
<?php } ?>
<?php } // levelup condition ends here?> 
@media (min-width: 768px){
.wp-block-columns {
    display:flex;
}
.wp-block-column {
    max-width:50%;
    margin: 0px 10px;
}
}
<?php
if(is_singular() && true == ampforwp_get_setting('amp-sticky-header')){?>
.cntn-wrp a[id]:before, .cntn-wrp div[id]:before{
  display: block; 
  content: " "; 
  margin-top: -107px;
  height: 107px;
  visibility: hidden;}
<?php } 
if(class_exists('MCI_Footnotes')){ ?>
	div#footnote_references_container{
		display: unset;
	}
	#fn_span{
		margin-left: 14px;
	}
<?php } ?>
<?php // Notification CSS
if( ampforwp_get_setting('amp-enable-notifications') && ampforwp_get_setting('enable-single-social-icons') && is_single() ) { ?>
amp-user-notification{
	bottom:40px;
}
<?php } //amp-enable-notifications Condition Ends Here ?> 
amp-facebook-like{
  max-height: 28px;
  top:6px;
  margin-right:-5px;
}
<?php
if( true == ampforwp_get_setting('gnrl-sidebar') && true == ampforwp_get_setting('page_sidebar') && !checkAMPforPageBuilderStatus(ampforwp_get_the_ID()) ){?>
.amp-single-page .cntn-wrp{
    float: left;
    max-width: 69%;
}
@media only screen and (max-width: 768px) {
  .amp-single-page .cntn-wrp{ 
    float: none;
    max-width:100%;
  }
}
<?php }

if(true == ampforwp_get_setting('ampforwp-single-related-posts-excerpt')){?>
	a.readmore-rp {
	    font-size: 13px;
	}
<?php }
if(is_page()){?>
.ss-ic li a{display: initial;}
<?php }

if(true == ampforwp_get_setting('signin-button') && '2' == ampforwp_get_setting('cta-responsive-view')){
	$color = ampforwp_get_setting('signin-button-text-color','rgba');
	$border_color = ampforwp_get_setting('signin-button-border-color','rgba');
	if($color == 'rgba(0,0,0,1)'){
		$color = '#fff';
	}
	if($border_color == 'rgba(0,0,0,1)'){
		$border_color = '#fff';
	}
	?>
	.h-sing.cta-res{display:none}
	@media(max-width:480px){ 
	.h-2 .h-sing {display:none} 
	.h-sing.cta-res {display: block;}
	.h-sing a {margin-left: 25px;
    color: <?php echo ampforwp_sanitize_color($color) ?>;   
    border-color: <?php echo ampforwp_sanitize_color($border_color) ?>;
	}
	}
<?php }
if(true == ampforwp_get_setting('amp-rtl-select-option')){?>
.breadcrumbs li a:after, .breadcrumbs span a:after{
	content: "\e314";
	padding-left: 0px;
	padding-right: 5px;
}
<?php }
if(ampforwp_get_setting('ampforwp-gallery-design-type')==3){?>
.ampforwp-gallery-item.amp-carousel-containerd3 {
    float: left;
}
.amp-carousel-containerd3 figcaption {
    max-width: 150px;
}
.ampforwp-blocks-gallery-caption{
	float: left;
    width: 100%;
    font-size: 16px;
}
<?php }else if(ampforwp_get_setting('ampforwp-gallery-design-type')==2){?>
.ampforwp-blocks-gallery-caption{
    font-size: 16px;
}
<?php }else if(ampforwp_get_setting('ampforwp-gallery-design-type')==1){?>
.ampforwp-blocks-gallery-caption{
    font-size: 16px;
}
<?php } ?>
.m-s-i li a.s_telegram:after {
    content: "\e93f";
}
.cntn-wrp h1, .cntn-wrp h2, .cntn-wrp h3, .cntn-wrp h4, .cntn-wrp h5, h6{margin-bottom:5px;}
<?php // H1 - H6 Font Sizes 
	if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h1') ){ ?>
		.cntn-wrp h1{font-size:<?php echo esc_html( ampforwp_get_setting('swift_h1_sz') )?>;}
	<?php } else { ?>
		.cntn-wrp h1 {font-size: 32px;}
	<?php } //H1 ends
	if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h2') ){ ?>
		.cntn-wrp h2{font-size:<?php echo esc_html($redux_builder_amp['swift_h2_sz'])?>;}
	<?php } else { ?>
		.cntn-wrp h2 {font-size: 27px;}
	<?php } // H2 Ends
	if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h3') ){ ?>
		.cntn-wrp h3{font-size:<?php echo esc_html(ampforwp_get_setting('swift_h3_sz') )?>;}
	<?php } else { ?>
		.cntn-wrp h3 {font-size: 24px;}
	<?php } // H3 Ends
	if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h4') ){ ?>	
		.cntn-wrp h4{font-size:<?php echo esc_html(ampforwp_get_setting('swift_h4_sz') )?>;}
	<?php } else { ?>
		.cntn-wrp h4 {font-size: 20px;}
	<?php } // H4 Ends
	if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h5') ){ ?>
		.cntn-wrp h5{font-size:<?php echo esc_html(ampforwp_get_setting('swift_h5_sz') )?>;}
	<?php } else { ?>
		.cntn-wrp h5 {font-size: 17px;}
	<?php } // H5 Ends
	if(ampforwp_get_setting('swift_cnt') && ampforwp_get_setting('swift_cnt_h6') ){ ?>
		.cntn-wrp h6{font-size:<?php echo esc_html(ampforwp_get_setting('swift_h6_sz') )?>;}
	<?php } else { ?>
		.cntn-wrp h6 {font-size: 15px;}
	<?php } // H6 Ends
 // swift Content Heading Sizes Ends
 if(ampforwp_get_setting('single-new-features') && ampforwp_get_setting('ampforwp-underline-content-links')){ ?> 
.artl-cnt a,.cntn-wrp a{
	text-decoration: underline;
}
<?php } // Underline CSS Ends?> 
figure.amp-featured-image {
    margin: 10px 0;
}
<?php if(function_exists('twentytwenty_theme_support')){?>
	.post-meta-edit-link-wrapper ul.post-meta{
		float: right;
	    margin-top: -16px;
	}
	.post-meta-edit-link-wrapper ul.post-meta li{
		list-style-type: none;
	}
	.post-meta-edit-link-wrapper ul.post-meta li .meta-text{
		margin-left:5px;
	}
<?php } 
if(true == ampforwp_get_setting('ampforwp-facebook-comments-support')){?>
section.amp-facebook-comments h5{  
    font-size: 14px;
    padding-bottom: 4px;
    font-weight: 500;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    border-bottom: 1px dotted #ccc;
}
<?php } 
if ($ampforwp_font_icon == 'css-icons'){?>
.t-btn {
    color: #000;
    position: absolute;
    width: 17px;
    height: 5px;
    border-top: solid 1px currentColor;
    border-bottom: solid 1px currentColor;
}
.t-btn:after {
    content: '';
    position: absolute;
    top: 3px;
    left: 0;
    width: 17px;
    height: 5px;
    border-bottom: solid 1px currentColor;
}
.icon-src,a.lb-x {
    color: #000;
    position: absolute;
    width: 12px;
    height: 12px;
    border: solid 1px #000;
    border-radius: 100%;
    transform: rotate(-45deg);
}
.icon-src:before,a.lb-x:before  {
    content: '';
    position: absolute;
    top: 12px;
    left: 5px;
    height: 6px;
    width: 1px;
    background-color: currentColor;
} 
.overlay-search {
    position: absolute;
    width: 12px;
    height: 12px;
    border: solid 1px #fff;
    border-radius: 100%;
    transform: rotate(-45deg);
    right: 10px;
    top: 0px;
}
.overlay-search:before {
	content: '';
    position: absolute;
    top: 12px;
    left: 5px;
    height: 6px;
    width: 1px;
    background-color: currentColor;

}
.m-srch .overlay-search {
    border: 1px solid #000;
    top: 10px;
}
.m-srch .overlay-search:before {
    padding-right: 0px;
    top: 10px;
}
a.bread-link.bread-home::after {
    content: "►";
    top:-1px;
}
.lb-t:target a.lb-x {
    width: 32px;
    height: 32px;
    top: 50px;
    right: 20px;
}
.lb-t:target a.lb-x:before {
    content: "X";
    color: #fff;
    transform: rotate(45deg);
    background-color: transparent;
    top: -4px;
    height: -17px;
    margin: 10px;
}
#search a.lb-x {
    border: 1px solid #fff;
}
<?php } 
if(ampforwp_get_setting('header-position-type') == '2'){?>
@supports (-webkit-touch-callout: none) {
.tg + .hamb-mnu {
    position:relative;
    overflow:hidden;
}
.tg:checked + .hamb-mnu {
    overflow: scroll;
    position: inherit;
}
}
<?php }
if(ampforwp_get_setting('amp-sticky-header') == '1'){?>
@supports (-webkit-touch-callout: none) {
	.header .tg + .hamb-mnu, .header .tg:checked + .hamb-mnu {
	    position: initial;
	}
}
<?php } 
if(ampforwp_get_setting('amp-sticky-header') == '1' && ampforwp_get_setting('header-position-type') == '2'){?>
	.tg + .hamb-mnu, .tg:checked + .hamb-mnu {
 		overflow: initial;
    	position: initial;
    }
<?php }
if(true == ampforwp_get_setting('ampforwp-cats-single-primary')){?>
.amp-category span , .amp-category span:after{
    display: none;
}
.amp-category span.amp-cat.primary {
    display: block;
}
<?php }
if(function_exists('pll__') && ampforwp_get_setting('header-type') == '2'){?>
.t-btn:after {
    position: absolute;
    left: 280px;
    top: 25px;
}
@media only screen and (max-width: 1024px) {
.t-btn:after {
    left: 20px;
}
}
<?php }