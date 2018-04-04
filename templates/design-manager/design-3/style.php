<?php
//add_action('amp_post_template_css', 'ampforwp_additional_style_input_3');
//function ampforwp_additional_style_input_3( $amp_template ) {
  global $redux_builder_amp;
  global $post;
  $post_id = '';
  $post_id = $post->ID;
  $get_customizer = new AMP_Post_Template( $post_id );
  // Get content width
  $colorscheme    = $redux_builder_amp['amp-opt-color-rgba-colorscheme']['color'];
  $headercolor    = $redux_builder_amp['amp-opt-color-rgba-headercolor']['color'];
  $font_color     = $redux_builder_amp['amp-opt-color-rgba-font']['color'];
  $link_color     = $redux_builder_amp['amp-opt-color-rgba-link']['color'];
  $headerelements = $redux_builder_amp['amp-opt-color-rgba-headerelements']['color'];
  $sticky_head    = $redux_builder_amp['amp-opt-sticky-head'];

  $content_max_width       = absint( $get_customizer->get( 'content_max_width' ) );
  // Get template colors
  $header_background_color = $get_customizer->get_customizer_setting( 'header_background_color' );
  $header_color            = $get_customizer->get_customizer_setting( 'header_color' );
  ?>

/*  Widgets styling */
.amp-wp-content.widget-wrapper { margin: 20px 17px 17px 17px;}

/* Global Styling */
body{ font: 16px/1.4 Sans-serif; }
a{ color: #312C7E; text-decoration: none }
.clearfix, .cb{ clear: both }
.alignleft{ margin-right: 12px; margin-bottom:5px; float: left; }
.alignright{ float:right; margin-left: 12px; margin-bottom:5px; }
.aligncenter{ text-align:center; margin: 0 auto }
#statcounter{width: 1px;height:1px;}
amp-anim { max-width: 100%; }
.amp-wp-content amp-iframe{max-width:100%}
@font-face {
    font-family: 'Roboto Slab';
    font-style: normal;
    font-weight: 400;
    src:  local('Roboto Slab Regular'), local('RobotoSlab-Regular'), url('<?php echo esc_url(plugin_dir_url(__FILE__).'fonts/robotoslab/RobotoSlab-Regular.ttf'); ?>');
}
@font-face {
    font-family: 'Roboto Slab';
    font-style: normal;
    font-weight: 700;
    src:  local('Roboto Slab Bold'), local('RobotoSlab-Bold'), url('<?php echo esc_url(plugin_dir_url(__FILE__).'fonts/robotoslab/RobotoSlab-Bold.ttf'); ?>');
}

@font-face {
    font-family: 'PT Serif';
    font-style: normal;
    font-weight: 400;
    src:  local('PT Serif'), local('PTSerif-Regular'), url('<?php echo esc_url(plugin_dir_url(__FILE__).'fonts/ptserif/PT_Serif-Web-Regular.ttf'); ?>');
}
@font-face {
    font-family: 'PT Serif';
    font-style: normal;
    font-weight: 700;
    src:  local('PT Serif Bold'), local('PTSerif-Bold'), url('<?php echo esc_url(plugin_dir_url(__FILE__).'fonts/ptserif/PT_Serif-Web-Bold.ttf'); ?>');
}

/* Template Styles */
.amp-wp-content, .amp-wp-title-bar div {
    <?php if ( $content_max_width > 0 ) : ?>
    max-width: <?php echo esc_attr( sprintf( '%dpx', $content_max_width ) ); ?>;
    margin: 0 auto;
    <?php endif; ?>
}

/* Slide Navigation code */
amp-sidebar{ width: 280px; background: #131313; font-family: 'Roboto Slab', serif; }
.amp-sidebar-image{ line-height: 100px; vertical-align:middle; }
.amp-close-image{ top: 15px; left: 225px; cursor: pointer; }
.navigation_heading{ padding: 20px 20px 15px 20px; color: #aaa; font-size: 10px; font-family: sans-serif; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #555; display: inline-block; width: 100%}
.toggle-navigationv2 ul{ list-style-type: none; margin: 15px 0 0 0; padding: 0}
.toggle-navigationv2 ul li a{ padding: 10px 15px 10px 20px; display: inline-block; font-size: 14px; color:#eee; width:94% }
.amp-menu li{position:relative}
.toggle-navigationv2 ul li a:hover{background:#666;color:#fff}
.amp-menu li.menu-item-has-children ul{display:none;margin:0;background:#222}
.amp-menu li.menu-item-has-children ul ul{background:#444}
.amp-menu li.menu-item-has-children ul ul ul{background:#666}
.amp-menu li.menu-item-has-children:hover > ul{display:block}
.amp-menu li.menu-item-has-children:after{content:'\25be';position:absolute;padding: 10px 15px 10px 30px;right:0;font-size:18px;color:#ccc;top:0;z-index:10000;line-height:1}
.toggle-navigationv2 .social_icons{ margin-top: 25px; border-top: 1px solid #555; padding: 25px 0px; color: #fff; width: 100%; }
.menu-all-pages-container:after{ content: ""; clear: both }
.toggle-text{ color: #fff; font-size: 12px; text-transform: uppercase; letter-spacing: 3px; display: inherit; text-align: center; }
.toggle-text:before{ content: "..."; font-size: 32px; position: ; font-family: georgia; line-height: 0px; margin-left: 0px; letter-spacing: 1px; top: -3px; position: relative; padding-right: 10px; }
.toggle-navigation:hover, .toggle-navigation:active, .toggle-navigation:focus{ display: inline-block; width: 100%; }
<?php if ( ! is_singular() ) { ?>
/* Pagination */
.amp-wp-content.pagination-holder{ background: none; padding: 0; box-shadow: none; height: auto; min-height: auto; }
#pagination{ width: 100%; margin-top: 20px; }
#pagination .next, #pagination .prev{ margin: 0px 6% 10px 6%; }
#pagination .next a, #pagination .prev a{ opacity:0.9; background: #f42f42; width: 100%; color: #fff; display: inline-block; text-align: center; font-size: 16px; line-height: 1; padding: 18px 0%; border-radius: 4px; }
<?php }
 if ( is_single() ) {?>
/* Sticky Social bar in Single */
.sticky_social{ width: 100%; bottom: 0; display: block; left: 0; box-shadow: 0px 4px 7px #000; background: #fff; padding: 7px 0px 0px 0px; position: fixed; margin: 0; z-index: 10; text-align: center; }
.amp-social-icon{ width: 50px; height: 28px; display: inline-block; background: #5cbe4a;position: relative; top: -8px; padding-top: 0px; }
.amp-social-icon amp-img{ top: 4px; }
.custom-amp-socialsharing-line{background:#00b900}
.sticky_social .whatsapp-share-icon{ padding: 4px 0px 14px 0px; height: 28px; top: -4px; position: relative; }
.sticky_social .line-share-icon{ padding: 4px 0px 14px 0px; height: 28px; top: -4px; position: relative; }
<?php }?>
/*Sticky Head For Design 3*/
#header{ background: #fff; text-align: center; height:50px; box-shadow:0 0 32px rgba(0,0,0,.15); }
header{ padding-bottom:50px; }
#headerwrap{ position: fixed; z-index:1000; width: 100%; top:0; }
<?php if ( $sticky_head ) { ?>
  header{ padding-bottom:0px; }
#headerwrap{ position: relative;}
<?php } ?>
#header h1{ text-align: center; font-size: 16px; position: relative; font-weight: bold; line-height: 50px; padding: 0; margin: 0; text-transform: uppercase }
main .amp-wp-content{ font-size: 18px; line-height: 29px; color:#111 }
.single-post main .amp-wp-article-content h1{ font-size:2em}
.single-post main .amp-wp-article-content h1, .single-post main .amp-wp-article-content h2, .single-post main .amp-wp-article-content h3, .single-post main .amp-wp-article-content h4, .single-post main .amp-wp-article-content h5, .single-post main .amp-wp-article-content h6{ font-family: 'Roboto Slab', serif; margin: 0px 0px 5px 0px; line-height: 1.6; }
.home-post_image{ float: left; width:33%; padding-right: 2%; overflow:hidden; max-height: 225px }
.amp-wp-title{ margin-top: 0px; }
h2.amp-wp-title{ font-family: 'Roboto Slab', serif; font-weight: 700; font-size: 20px; margin-bottom: 7px; line-height: 1.3; }
h2.amp-wp-title a{ color: #000; }
.amp-wp-tags{ list-style-type: none; padding: 0; margin: 0 0 9px 0; display: inline-flex; }
.amp-wp-tags li{ display: inline; background: #F6F6F6; color: #9e9e9e; line-height: 1; border-radius: 50px; padding: 8px 18px; font-size: 12px; margin-right: 8px; top: -3px; position: relative; }
.amp-wp-tags li a{ color: #9e9e9e; }
.amp-loop-list{ position:relative; border-bottom: 1px solid #ededed; padding: 25px 15px 25px 15px }
body .amp-loop-list-noimg .amp-wp-post-content{ width:100% }
.amp-loop-list .amp-wp-post-content{ float: left; width: 65%; }
.amp-loop-list .featured_time{ color:#b3b3b3; padding-left:0 }
.amp-wp-post-content p{ color: grey; line-height: 1.5; font-size: 14px; margin: 8px 0 10px; font-family:'PT Serif', serif }
<?php if ( 1 == $redux_builder_amp['enable-excerpt-single'] ) { ?>
/* For Excerpt */
.amp-wp-post-content .small-screen-excerpt-design-3 {display: none;} .amp-wp-post-content .large-screen-excerpt-design-3 { display: block; }
<?php } ?>
/* Footer */
#footer{ background: #151515; color: #eee; font-size: 13px; text-align: center; letter-spacing: 0.2px; padding: 35px 0 35px 0; margin-top: 30px; }
#footer a{ color:#fff }
#footer p:first-child{ margin-bottom: 12px; }
#footer .social_icons{ margin: 0px 20px 25px 20px; border-bottom: 1px solid #3c3c3c; padding-bottom: 25px; }
#footer p{ margin: 0 }
.back-to-top{padding-bottom: 8px;}
.rightslink, #footer .rightslink a{ font-size:13px; color:#999 }
.poweredby{ padding-top:10px; font-size:10px; }
#footer .poweredby a{ color:#666 }
.footer_menu ul{ list-style-type: none; padding: 0; text-align: center; margin: 0px 20px 25px 20px; line-height: 27px; font-size: 13px }
.footer_menu ul li{ display:inline; margin:0 10px; }
.footer_menu ul li:first-child{ margin-left:0 }
.footer_menu ul li:last-child{ margin-right:0 }
.footer_menu ul ul{ display:none }
<?php if ( is_singular() || $redux_builder_amp['amp-frontpage-select-option'] && ampforwp_get_blog_details() == false ) { ?>
/* Single */
.single-post main{ margin: 20px 17px 17px 17px; }
.amp-wp-article-content{ font-family:'PT Serif', serif; }
.single-post .post-featured-img{ margin:0 -17px 0px -17px }
.amp-wp-article-featured-image.wp-caption .wp-caption-text, .ampforwp-gallery-item .wp-caption-text{color: #696969; font-size: 11px; line-height: 1.5; background: #eee; margin: 0; padding: .66em .75em; text-align: center; }
.ampforwp-gallery-item.amp-carousel-slide { padding-bottom: 20px;}
.ampforwp-title{ padding: 0px 0px 0px 0px; margin-top: 12px; margin-bottom: 12px; }
.comment-button-wrapper{ margin-bottom: 50px; margin-top: 30px; text-align:center }
.comment-button-wrapper a{ color: #fff; background: #312c7e; font-size: 14px; padding: 12px 22px 12px 22px; font-family: 'Roboto Slab', serif; border-radius: 2px; text-transform: uppercase; letter-spacing: 1px; }
h1.amp-wp-title{ margin: 0; color: #333333; font-size: 48px; line-height: 58px; font-family: 'Roboto Slab', serif; }
.post-pagination-meta{ min-height:75px }
.single-post .post-pagination-meta{ font-size:15px; font-family:sans-serif; min-height:auto; margin-top:-5px; line-height:26px; }
.single-post .post-pagination-meta span{ font-weight:bold }
.single-post .amp_author_area .amp_author_area_wrapper{ display: inline-block; width: 100%; line-height: 1.4; margin-top: 22px; font-size: 16px; color:#333; font-family: sans-serif; }
.single-post .amp_author_area amp-img{ margin: 0; float: left; margin-right: 12px; border-radius: 60px; }
.amp-wp-article-tags .ampforwp-tax-tag, .amp-wp-article-tags .ampforwp-tax-tag a{ font-size: 12px; color: #555; font-family: sans-serif; margin: 20px 0 0 0; }
.amp-wp-article-tags span{ background: #eee; margin-right: 10px; padding: 5px 12px 5px 12px; border-radius: 3px; display: inline-block; margin: 5px; }
.ampforwp-social-icons{ margin-bottom: 70px; margin-top: 25px; min-height: 40px; }
.ampforwp-social-icons amp-social-share{ border-radius:60px; background-size:22px; margin-right:6px; }
.amp-social-icon-rounded{padding: 11px 12px 9px 12px; top: -13px; position: relative; line-height: 1; display: inline-block; height: inherit; border-radius: 60px; }
.amp-social-line{background:#00b900}
.amp-social-vk{background:#45668e}
.amp-social-odnoklassniki{background:#ed812b}.amp-social-reddit{background:#ff4500}.amp-social-telegram{background:#0088cc}.amp-social-tumblr{background:#35465c}.amp-social-digg{background:#005be2}.amp-social-stumbleupon{background:#eb4924}.amp-social-wechat{background:#7bb32e}.amp-social-viber{background:#8f5db7}
.amp-social-facebook{background:#3b5998}.amp-social-twitter{background:#1da1f2}.amp-social-gplus{background:#dd4b39}.amp-social-email{background:#000000}.amp-social-pinterest{background:#bd081c}.amp-social-linkedin{background:#0077b5}.amp-social-whatsapp{background:#5cbe4a}
.ampforwp-custom-social{display:inline-block; margin-bottom:5px}
.amp-wp-tax-tag { list-style: none; display: inline-block; }
figure{ margin: 0 0 20px 0; }
figure amp-img{ max-width:100%; }
figcaption{ font-size: 11px; line-height: 1.6; margin-bottom: 11px; background: #eee; padding: 6px 8px; }
.amp-wp-byline amp-img{ display: none; }
.amp-wp-author{ margin-right: 1px; }
.amp-wp-meta, .amp-wp-meta a{ font-size: 13px; color: #acacac; margin: 20px 0px 20px 0px; padding: 0; }
.amp-ad-wrapper{ text-align: center }
.the_content p{ margin-top: 0px; margin-bottom: 30px; }
.amp-wp-tax-tag{ }
main .amp-wp-content.featured-image-content{ padding: 0px; border: 0; margin-bottom: 0; box-shadow: none }
.amp-wp-content .amp-wp-article-featured-image amp-img {margin: 0 auto;}
.single-post .amp-wp-article-content amp-img{ max-width:100% }
<?php if ( is_single() ) {
 if ( $redux_builder_amp['ampforwp-single-select-type-of-related'] ) { ?>
/* Related Posts */
main .amp-wp-content.relatedpost{ background: none; box-shadow: none; padding:0px 0 0 0; margin:1.8em auto 1.5em auto }
.single-post main,.related-title,.single-post .comments_list h3{ font-size: 20px; color: #777; font-family:'Roboto Slab', serif; border-bottom: 1px solid #eee; font-weight: 400; padding-bottom: 1px; margin-bottom: 10px; }
.related-title {display:block}
.related_posts ol{ list-style-type:none; margin:0; padding:0 }
.related_posts ol li{ display:inline-block; width:100%; margin-bottom: 12px; padding: 0px; }
.related_posts .related_link a{ color: #444; font-size: 16px; font-family: 'Roboto Slab', serif; font-weight: 600; }
.related_posts ol li amp-img{ float:left; margin-right:15px }
.related_posts ol li p{ font-size: 12px; color: #999; line-height: 1.2; margin: 12px 0 0 0; }
.no_related_thumbnail{ padding: 15px 18px; }
.no_related_thumbnail .related_link{ margin: 16px 5px 20px 5px; }
.related-post_image{ float: left; padding-right: 2%; width: 31.6%; overflow: hidden; margin-right: 15px; max-height: 122px; max-width: 110px; } 
.related-post_image amp-img{ width: 144%; left: -20%; }
<?php }
}
if ( isset($redux_builder_amp['wordpress-comments-support']) && 1 == $redux_builder_amp['wordpress-comments-support'] ) { ?>
/* Comments */
.page-numbers{ padding: 9px 10px; background: #fff; font-size: 14px; }
.comment-body .comment-content{ font-family:'PT Serif', serif; margin-top: 2px; }
main .amp-wp-content.comments_list{ background: none; box-shadow: none; padding:0 }
.comments_list div{ display:inline-block; }
.comments_list ul{ margin:0; padding:0 }
.comments_list ul.children{ padding-bottom:10px; margin-left: 3%; width: 96%; }
.comments_list ul li p{ margin:0; font-size:16px; clear:both; padding-top:5px; word-break: break-word;}
.comments_list ul li{ font-size: 12px; list-style-type: none; margin-bottom: 22px; padding-bottom: 20px; max-width: 1000px; border-bottom: 1px solid #eee; }
.comments_list ul ul li{ border-left: 2px solid #eee; padding-left: 15px; border-bottom: 0; padding-bottom: 0px; }
.comments_list ul li .comment-body .comment-author{ margin-right:5px }
.comment-author{ float:left }
.single-post footer.comment-meta{ color:#666; padding-bottom: 0; line-height: 1.9; }
.comment-author-img{float: left; margin-right: 5px; border-radius: 60px; }
.comment-metadata a{ color:#888 }
.comments_list li li{ margin: 20px 20px 10px 20px; background: #f7f7f7; box-shadow: none; border: 1px solid #eee; }
.comments_list li li li{ margin:20px 20px 10px 20px }
.comment-content amp-img{max-width: 300px;}
<?php } ?>
<?php if ( isset($redux_builder_amp['ampforwp-disqus-comments-support']) && $redux_builder_amp['ampforwp-disqus-comments-support'] ) {?>
.amp-disqus-comments { text-align:center } <?php 
} ?>
/* ADS */
.amp_ad_1{ margin-top: 15px; margin-bottom: 10px; }
.single-post .amp_ad_1{ margin-bottom: -15px; }
.amp-ad-2{ margin-bottom: -5px;    margin-top: 20px; }
html .single-post .ampforwp-incontent-ad-1 { margin-bottom: 10px; }
.amp-ad-3{ margin-bottom:10px; }
.amp-ad-4{ margin-top:2px; }
.amp-wp-content blockquote{ background-color: #fff; border-left: 3px solid; margin: 0; padding: 15px 20px; background: #f3f3f3; }
.amp-wp-content blockquote p{ margin-bottom:0 }
pre{ white-space: pre-wrap; }

#designthree{ background-color: #FFF; overflow: visible;
/*    animation: closing .3s normal forwards ease-in-out,closingFix .6s normal forwards ease-in-out;
    -webkit-transform-origin: right center;
    transform-origin: right center;*/
}
<?php }?>
/* Sidebar */
#sidebar[aria-hidden="false"]+#designthree { max-height: 100vh; overflow: hidden; animation: opening .3s normal forwards ease-in-out; -webkit-transform: translate3d(60%, 0, 0) scale(0.8); transform: translate3d(60%, 0, 0) scale(0.8); }
@keyframes opening{ 0% { transform: translate3d(0, 0, 0) scale(1); } 100% { transform: translate3d(60%, 0, 0) scale(0.8); } }
@keyframes closing{ 0% { transform: translate3d(60%, 0, 0) scale(0.8); } 100% { transform: translate3d(0, 0, 0) scale(1); } }
@keyframes closingFix{ 0% { max-height: 100vh; overflow: hidden; } 100% { max-height: none; overflow: visible; } }
.hamburgermenu{ float:left; position:relative; z-index: 9999; }

/* Category 3 */
.amp-category-block{ margin: 30px 0px 10px 0px }
.amp-category-block a{ color:#666}
.amp-category-block ul{ list-style-type:none}
.category-widget-gutter h4{ margin-bottom: 0px;}
.category-widget-gutter ul{ margin-top: 10px; list-style-type:none; padding:0 }
.amp-category-block-btn{ display: block; text-align: center; font-size: 13px; margin-top: 15px; border-bottom: 1px solid #f1f1f1; text-decoration: none; padding-bottom: 8px;}
.design_2_wrapper .amp-category-block{ max-width: 840px; margin: 1.5em auto; }
.amp-category-block ul, .category-widget-wrapper{ max-width: 1000px; margin: 0 auto; padding:0px 15px 5px 15px }
.amp-category-post{ width: 32%; display: inline-block; word-wrap: break-word;float: left;}
.amp-category-post amp-img{ margin-bottom:5px; }
.amp-category-block li:nth-child(3){ margin: 0 1%; }
.searchmenu{ margin-right: 15px; margin-top: 11px; position: absolute; top: 0; right: 0; }
.searchmenu button{ background:transparent; border:none }
.amp-logo amp-img{margin: 0 auto; position:relative;top:9px;max-width:190px;}
.headerlogo{ margin: 0 auto; width: 80%; text-align: center; }
.headerlogo a{ color:#F42; display:inline-block}

/*Navigation Menu*/
.toast { display: block; position: relative; height: 50px; padding-left: 20px; padding-right: 15px; width: 49px; background:none; border:0 }
.toast:after, .toast:before, .toast span{ position: absolute; display: block; width: 19px; height: 2px; border-radius: 2px; background-color: #F42; -webkit-transform: translate3d(0, 0, 0) rotate(0deg); transform: translate3d(0, 0, 0) rotate(0deg); }
.toast:after, .toast:before{ content: ''; left: 20px; -webkit-transition: all ease-in .4s; transition: all ease-in .4s; }
.toast span{ opacity: 1; top: 24px; -webkit-transition: all ease-in-out .4s; transition: all ease-in-out .4s; }
.toast:before{ top: 17px; }
.toast:after{ top: 31px; }
#sidebar[aria-hidden="false"]+#designthree .toast span{ opacity: 0; -webkit-transform: translate3d(200%, 0, 0); transform: translate3d(200%, 0, 0); }
#sidebar[aria-hidden="false"]+#designthree .toast:before{ -webkit-transform-origin: left bottom; transform-origin: left bottom; -webkit-transform: rotate(43deg); transform: rotate(43deg); }
#sidebar[aria-hidden="false"]+#designthree .toast:after{ -webkit-transform-origin: left top; transform-origin: left top; -webkit-transform: rotate(-43deg); transform: rotate(-43deg); }

/* CSS3 icon */
[class*=icono-]{ display: inline-block; vertical-align: middle; position: relative; font-style: normal; color: #f42; text-align: left; text-indent: -9999px; direction: ltr }
[class*=icono-]:after, [class*=icono-]:before{ content: ''; pointer-events: none; }
.icono-search{ -webkit-transform: translateX(-50%); -ms-transform: translateX(-50%); transform: translateX(-50%) }
.icono-share{ height: 9px; position: relative; width: 9px; color: #dadada; border-radius: 50%; box-shadow: inset 0 0 0 32px, 22px -11px 0 0, 22px 11px 0 0; top: -15px; margin-right: 35px; }
.icono-share:after, .icono-share:before{ position: absolute; width: 24px; height: 1px; box-shadow: inset 0 0 0 32px; left: 0; }
.icono-share:before{ top: 0px; -webkit-transform: rotate(-25deg); -ms-transform: rotate(-25deg); transform: rotate(-25deg); }
.icono-share:after{ top: 8px; -webkit-transform: rotate(25deg); -ms-transform: rotate(25deg); transform: rotate(25deg); }
.icono-search{ border: 1px solid; width: 10px; height: 10px; border-radius: 50%; -webkit-transform: rotate(45deg); -ms-transform: rotate(45deg); transform: rotate(45deg); margin: 4px 4px 8px 8px; }
.icono-search:before{ position: absolute; left: 50%; -webkit-transform: rotate(270deg); -ms-transform: rotate(270deg); transform: rotate(270deg); width: 2px; height: 9px; box-shadow: inset 0 0 0 32px; top: 0px; border-radius: 0 0 1px 1px; left: 14px; }
.closebutton{ background: transparent; border: 0; color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(255, 255, 255, 0.7); border-radius: 30px; width: 32px; height: 32px; font-size: 12px; text-align: center; position: absolute; top: 12px; right: 20px; outline:none }
amp-lightbox{ background: rgba(0, 0, 0,0.85); }
.searchform label{ color: #f7f7f7; display: block; font-size: 10px; letter-spacing: 0.3px; line-height: 0; opacity:0.6 }
.searchform{ background: transparent; left: 20%; position: absolute; top: 35%; width: 60%; max-width: 100%; transition-delay: 0.5s; }
.searchform input{ background: transparent; border: 1px solid #666; color: #f7f7f7; font-size: 14px; font-weight: 400; line-height: 1; letter-spacing: 0.3px; text-transform: capitalize; padding: 20px 0px 20px 30px; margin-top: 15px; width: 100%; }
#searchsubmit{opacity:0}
.featured_time{ font-size: 12px; color: #fff; opacity: 0.8; padding-left: 20px; }
.archives_body main{ margin-top:20px }
.taxonomy-description p{margin-top: 5px;font-size: 14px;line-height: 1.5;}
.amp-sub-archives li{width: 50%;} .amp-sub-archives ul{padding: 0;list-style: none;display: flex;font-size: 12px;line-height: 1.2;margin: 5px 0 10px 0px;} .author-img amp-img{border-radius: 50%;margin: 0px 12px 10px 0px;display: block; width:50px;}.author-img{float: left;padding-bottom: 25px;}
<?php  if (  ampforwp_is_home() || ampforwp_is_blog() ) {?>
/* AMP carousel */
.amp-carousel-button-prev, .amp-carousel-button-next{ top:30px;border-radius:60px; }
.amp-featured-wrapper{ background:#333 }
.amp-featured-area{ margin: 0 auto; max-width: 450px; max-height: 270px; }
.amp-carousel-slide h1{ font-size: 30px; font-family: 'PT Serif', serif; margin: 0; font-weight: normal; line-height: 38px; color: #fff; padding: 10px 20px 20px 20px; }
.amp-featured-area .amp-carousel-slide amp-img:before{ z-index:100; bottom: 0; content: ""; display: block; height: 100%; position:absolute; width: 100%; background: -webkit-gradient(linear, 50% 0%, 50% 75%, color-stop(0%, rgba(0,0,0,0)), color-stop(150%, #000000)) repeat scroll 0 0 rgba(0,0,0,0.2); background: -webkit-linear-gradient(rgba(0,0,0,0),#000000 75%) repeat scroll 0 0 rgba(0,0,0,0); background: -moz-linear-gradient(rgba(0,0,0,0),#000000 75%) repeat scroll 0 0 rgba(0,0,0,0); background: -o-linear-gradient(rgba(0,0,0,0),#000000 75%) repeat scroll 0 0 rgba(0,0,0,0); background: linear-gradient(rgba(0,0,0,0),#000000 75%) repeat scroll 0 0 rgba(0,0,0,0); }
.featured_title{ position:absolute; z-index:110; bottom:0 }
.featured_meta{ color:#acacac; font-size:12px; margin:0 15px; }
.featured_meta_left{ float:left }
.featured_meta_right{ float:right }
<?php }
if ( is_singular() || is_home() && $redux_builder_amp['amp-frontpage-select-option'] && ampforwp_get_blog_details() == false ) { ?>
/* Tables */
table { display: -webkit-box; display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; overflow-x: auto; }
table a:link { font-weight: bold; text-decoration: none; }
table a:visited { color: #999999; font-weight: bold; text-decoration: none; }
table a:active, table a:hover { color: #bd5a35; text-decoration: underline; }
table { font-family: Arial, Helvetica, sans-serif; color: #666; font-size: 12px; text-shadow: 1px 1px 0px #fff; background: #eee; margin: 0px; width: 100%; }
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
<?php } ?>
<?php if ( 1 == $redux_builder_amp['amp-enable-notifications'] || isset($redux_builder_amp['ampforwp-cta-subsection-notification-sticky']) && 1 == $redux_builder_amp['ampforwp-cta-subsection-notification-sticky'] ) {?>
/* Notifications */
#amp-user-notification1 p{ display: inline-block; }
amp-user-notification{ padding: 5px; text-align: center; background: #fff; border-top: 1px solid; }
amp-user-notification button{ padding: 8px 10px; background: #000; color: #fff; margin-left: 5px; border: 0; }
amp-user-notification button:hover{ cursor: pointer }
<?php } ?>
.archive-heading{padding: 10px 15px 0 15px;}
/* Responsive */
@media screen and (min-width: 650px) { table {display: inline-table;}  }
@media screen and (max-width: 768px){ .amp-wp-meta{ margin:10px 0px 15px 0px } .home-post_image{ width: 40%; } .amp-loop-list .amp-wp-post-content{ width: 58%; } .amp-loop-list .featured_time{line-height:1} .single-post main .amp-wp-content h1{  line-height:1.4;  font-size: 30px;}  }
@media screen and (max-width: 600px){ .amp-loop-list .amp-wp-tags{display:none} }
@media screen and (max-width: 530px){ .home-post_image{ width: 35%; } .amp-loop-list .amp-wp-post-content{ width: 63%; } .amp-wp-post-content p { font-size: 12px; } .related_posts ol li p { line-height: 1.6; margin: 7px 0 0 0;} .comments_list ul li .comment-body {width:auto} .amp-category-block li:nth-child(3) {margin:0} }
@media screen and (max-width: 425px){ .home-post_image{ /*    width: 125px;*/ width: 31.6%; overflow: hidden; /* margin-right: 13px; */ margin-right: 3%; max-height: 122px } .home-post_image amp-img{ width: 144%; left: -20%; } h2.amp-wp-title{    margin-bottom: 7px;  line-height: 1.31578947; font-size: 19px; position:relative;top:-3px } h2.amp-wp-title a{ color:#262626} .amp-loop-list{padding:25px 15px 22px 15px} .amp-loop-list .amp-wp-post-content{ width: 63%; } .amp-loop-list .amp-wp-post-content .large-screen-excerpt-design-3, .related_posts .related_link p{ display:none } .amp-loop-list .amp-wp-post-content .small-screen-excerpt-design-3 { display: block; } .related_posts .related_link a{ font-size: 18px; line-height: 1.7; } .ampforwp-tax-category{ padding-bottom:0 } .amp-wp-byline{ padding:0 } .related_posts .related_link a{ font-size: 17px; line-height: 1.5; } .single-post main .amp-wp-content h1{ line-height: 1.3; font-size: 26px;} .icono-share{display:none} .ampforwp-social-icons amp-social-share{ margin-right: 3px;} main .amp-wp-content{ font-size: 16px; line-height: 26px;} .single-post .amp_author_area .amp_author_area_wrapper{font-size:13px;} .amp-category-post{ font-size:12px; color:#666 } }
@media screen and (max-width: 400px){ .amp-wp-title{ font-size: 19px; } }
@media screen and (max-width: 375px){ .single-post main .amp-wp-content h1{ line-height: 1.3; font-size: 24px;} .amp-carousel-slide h1{ font-size: 28px; line-height: 32px; } #pagination .next a, #pagination .prev a{ color: #666; font-size: 14px; padding: 15px 0px; margin-top: -5px; }.related-title,.comments_list h3{ margin-top:15px; } #pagination .next{ margin-bottom:15px; } .related_posts .related_link a{ font-size: 15px; line-height: 1.6; } }
@media screen and (max-width: 340px){ .single-post main .amp-wp-content h1{ line-height: 1.3; font-size: 22px;} h2.amp-wp-title{ line-height: 1.31578947; font-size: 17px; } .related_posts .related_link a{ font-size: 15px; } .the_content .amp-ad-wrapper{ text-align: center; margin-left: -13px; } }
@media screen and (max-width: 320px){ .related_posts .related_link a{ font-size: 13px; } .ampforwp-social-icons amp-social-share{ margin-right: 1px; } }
.entry-content amp-anim{display:table-cell;}
<?php if ( true == $redux_builder_amp['amp-rtl-select-option'] ) { ?>
.amp-carousel-slide h1{ direction: rtl; }
.featured_time{ text-align: right; padding-right: 20px; }
main .amp-wp-content{ direction: rtl; }
.home-post_image{ float: right; padding-right: 0%; padding-left: 2%; margin-right: 0%; overflow: hidden;}
.searchmenu{ margin-right: 15px; margin-top: 11px; position: absolute; top: 0; right: inherit; }
.searchform label{ text-align: right; right: -30px; position: relative; }
.searchform input{ text-align: right; padding: 15px; }
.closebutton{ left:20px; }
.hamburgermenu{ float: right; }
.toast{ display: block; position: relative; height: 50px; padding-left: 20px; padding-right: 15px; width: 60px; background: none; border: 0; }
.amp-ad-wrapper, .amp-wp-article amp-ad{ direction: ltr; }
.related_posts ol li amp-img{ float: right; margin-left: 15px; }
.single-post .amp_author_area amp-img{ float: right; margin-left: 12px; }
.amp-wp-article, .footer_wrapper container{ direction: rtl; }
.single-post .post-pagination-meta span{ float: right; }
.amp-wp-article-tags span{ background: #eee; margin-right: 10px; padding: 5px 12px 5px 12px; border-radius: 3px; display: inline-block; margin: 5px; }
.amp_author_area_wrapper strong{ float: right; }
.amp-menu li.menu-item-has-children:after { left: 0; right: auto; }
amp-sidebar { direction: rtl; }
amp-carousel{direction: ltr;}
<?php } ?>

a {  color: <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-colorscheme']['color']) ?> }
body a {  color: <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-link']['color']); ?> }

.amp-wp-content blockquote { border-color:  <?php echo esc_attr(sanitize_hex_color( $header_background_color )); ?>; }
amp-user-notification { border-color:  <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-colorscheme']['color']); ?>;}
amp-user-notification button { background-color:  <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-colorscheme']['color']); ?>;}
<?php if ( true == $redux_builder_amp['enable-single-social-icons'] && is_socialshare_or_socialsticky_enabled_in_ampforwp() ) { ?>
.single-post footer { padding-bottom: 41px;}
<?php } ?>
.amp-wp-author:before{ content: " <?php global $redux_builder_amp; echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-published-by'], 'Published by' ));?>  ";}
.ampforwp-tax-category span:last-child:after { content: ' ';}
.ampforwp-tax-category span:after{ content: ', ';}
.amp-wp-article-content img { max-width: 100%;}
@font-face {
  font-family: 'icomoon';
  src:  url('<?php echo esc_url(plugin_dir_url(__FILE__) .'fonts/icomoon.eot'); ?>');
  src:  url('<?php echo esc_url(plugin_dir_url(__FILE__) .'fonts/icomoon.eot'); ?>') format('embedded-opentype'),
    url('<?php echo esc_url(plugin_dir_url(__FILE__) .'fonts/icomoon.ttf'); ?>') format('truetype'),
    url('<?php echo esc_url(plugin_dir_url(__FILE__) .'fonts/icomoon.woff'); ?>') format('woff'),
    url('<?php echo esc_url(plugin_dir_url(__FILE__) .'fonts/icomoon.svg'); ?>') format('svg');
  font-weight: normal;
  font-style: normal;
}
[class^="icon-"], [class*=" icon-"]{ font-family: 'icomoon'; speak: none; font-style: normal; font-weight: normal; font-variant: normal; text-transform: none; line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.icon-twitter:before{ content: "\f099";background:#1da1f2 }
.icon-facebook:before{ content: "\f09a";background:#3b5998 }
.icon-facebook-f:before{ content: "\f09a";background:#3b5998 }
.icon-pinterest:before{ content: "\f0d2";background:#bd081c }
.icon-google-plus:before{ content: "\f0d5";background:#dd4b39 }
.icon-linkedin:before{ content: "\f0e1";background:#0077b5 }
.icon-youtube-play:before{ content: "\f16a";background:#cd201f }
.icon-instagram:before{ content: "\f16d";background:#c13584 }
.icon-tumblr:before{ content: "\f173";background:#35465c }
.icon-vk:before{ content: "\f189";background:#45668e }
.icon-whatsapp:before{ content: "\f232";background:#075e54 }
.icon-reddit-alien:before{ content: "\f281";background:#ff4500 }
.icon-snapchat-ghost:before{ content: "\f2ac"; background:#fffc00 }
.social_icons{ font-size: 15px; display: inline-block; }
.social_icons ul{ list-style-type:none; padding:0;margin:0; text-align:center }
.social_icons li{ box-sizing: initial; display:inline-block; margin:5px; }
.social_icons li:before{ box-sizing: initial; color:#fff; padding: 10px; display: inline-block; border-radius: 70px; width: 18px; height: 18px; line-height: 20px; text-align: center; }
#ampsomething { display: none; }
#header, .headerlogo a{ background:<?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-headercolor']['color']); ?>  }
.comment-button-wrapper a, #pagination .next a, #pagination .prev a{ background: <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-colorscheme']['color']); ?> ; }
.toast:after, .toast:before, .toast span{ background: <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-headerelements']['color']); ?> ; }
[class*=icono-], .headerlogo a{ color: <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-headerelements']['color']); ?> }
#pagination .next a, #pagination .prev a , #pagination .next a, #pagination .prev a , .comment-button-wrapper a{ color:  <?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-font']['color']); ?> ;}
<?php if ( ! has_nav_menu( 'amp-menu' ) ) { ?>
.toggle-navigationv2 .social_icons { border-top: 0px; }
.toggle-navigationv2 a { color:#fff; }
<?php } ?>
<?php if ( $redux_builder_amp['ampforwp-callnow-button'] ) { ?>
.callnow{ position: absolute; top: 15px; right: 20px }
.callnow a:before { content: ""; position: absolute; right: 23px; width: 4px; height: 8px; border-width: 6px 0 6px 3px; border-style: solid; border-color:<?php echo esc_attr($redux_builder_amp['amp-opt-color-rgba-colorscheme-call']['color']); ?>; background: transparent; transform: rotate(-30deg); box-sizing: initial; border-top-left-radius: 3px 5px; border-bottom-left-radius: 3px 5px; }
<?php } ?>
<?php
if ( class_exists('TablePress') ) { ?>
.tablepress-table-description{ clear: both; display: block; }
.tablepress{ border-collapse: collapse; border-spacing: 0; width: 100%; margin-bottom: 1em; border: none; }
.tablepress th, .tablepress td{ padding: 8px; border: none; background: none; text-align: left; }
.tablepress tbody td{ vertical-align: top; }
.tablepress tbody td, .tablepress tfoot th{ border-top: 1px solid #dddddd; }
.tablepress tbody tr:first-child td{ border-top: 0; }
.tablepress thead th{ border-bottom: 1px solid #dddddd; }
.tablepress thead th, .tablepress tfoot th{ background-color: #d9edf7; font-weight: bold; vertical-align: middle; }
.tablepress .odd td{ background-color: #f9f9f9; }
.tablepress .even td{ background-color: #ffffff; }
.tablepress .row-hover tr:hover td{ background-color: #f3f3f3; }
@media (min-width: 768px) and (max-width: 1600px){ .tablepress{ overflow-x: none; } }
@media (min-width: 320px) and (max-width: 767px){ .tablepress{ display: inline-block; overflow-x: scroll; } }
<?php }  
if ( ! is_home() && 1 == $redux_builder_amp['ampforwp-bread-crumb'] ) { ?>
.breadcrumb{width: 100%;}
.breadcrumb ul, .category-single ul{ padding:0; margin:0;}
.breadcrumb ul li{display:inline;}
.breadcrumb ul li a, .breadcrumb ul li span{ font-size:12px;}
.breadcrumb ul li a::after {content: "►";display: inline-block;font-size: 8px;padding: 0 6px 0 7px;vertical-align: middle;opacity: 0.5;position:relative;top:-1px}
.breadcrumb ul li:hover a::after{color:#c3c3c3;}
.breadcrumb ul li:last-child a::after{display:none;}
<?php } ?> 
.amp-menu > li > a > amp-img, .sub-menu > li > a > amp-img { display: inline-block; margin-right: 4px; }
.menu-item amp-img {width: 16px; height: 11px; display: inline-block; margin-right: 5px; }
.amp-carousel-container {position: relative;width: 100%;height: 100%;} 
.amp-carousel-img img {object-fit: contain;}
.amp-ad-wrapper span { display: inherit; font-size: 12px; line-height: 1;}
<?php // Ads (sitewide)
if ( (isset($redux_builder_amp['enable-amp-ads-1'] ) && $redux_builder_amp['enable-amp-ads-1']) || (isset($redux_builder_amp['enable-amp-ads-2'] ) && $redux_builder_amp['enable-amp-ads-2']) ) { ?> .amp-ad-wrapper{ text-align: center } .amp_ad_1{ margin-top: 15px; margin-bottom: 10px; } .single-post .amp_ad_1{ margin-bottom: -15px; } .amp-ad-2{ margin-bottom: -5px; margin-top: 20px; } .amp-ad-wrapper{ text-align: center; margin-left: -13px; }.amp-ad-wrapper, .amp-wp-article amp-ad{ direction: ltr; } <?php }
if ( true == $redux_builder_amp['amp-pagination'] ) { ?>
.ampforwp_post_pagination{width:100%;text-align:center;display:inline-block;}
<?php }  
echo $redux_builder_amp['css_editor']; 
//} ?>