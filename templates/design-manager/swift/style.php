<?php global $redux_builder_amp; ?>
<?php if(!isset($redux_builder_amp['amp_font_selector']) || $redux_builder_amp['amp_font_selector'] == 1 || empty($redux_builder_amp['amp_font_selector'])){?>
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 300;src: local('Poppins Light'), local('Poppins-Light'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Light.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 400;src: local('Poppins Regular'), local('Poppins-Regular'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Regular.ttf');}
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 500;src: local('Poppins Medium'), local('Poppins-Medium'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Medium.ttf');} 
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 600;src: local('Poppins SemiBold'), local('Poppins-SemiBold'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-SemiBold.ttf'); }
@font-face {font-family: 'Poppins';font-style: normal;font-weight: 700;src: local('Poppins Bold'), local('Poppins-Bold'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Bold.ttf'); }
<?php } ?>
body{<?php $fontFamily = "font-family: 'Poppins', sans-serif;";
if(isset($redux_builder_amp['amp_font_selector']) && $redux_builder_amp['amp_font_selector'] != 1 && !empty($redux_builder_amp['amp_font_selector'])){ 
$fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector']."';"; }  
echo $fontFamily;?>
font-size: 16px; line-height:1.25; }
ol, ul{ list-style-position: inside }
p, ol, ul, figure{ margin: 0 0 1em; padding: 0; }
a, a:active, a:visited{ text-decoration: none; color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;}
a:hover, a:active, a:focus{}
pre{ white-space: pre-wrap;}
.left{float:left}
.right{float:right}
.hidden{ display:none }
.clearfix{ clear:both }
blockquote{ background: #f1f1f1; margin: 10px 0 20px 0; padding: 15px;}
blockquote p:last-child {margin-bottom: 0;}
.amp-wp-unknown-size img {object-fit: contain;}
.amp-wp-enforced-sizes{ max-width: 100% }
html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}nav ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent}table{border-collapse:collapse;border-spacing:0}hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}input,select{vertical-align:middle}
*,*:after,*:before {
box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;-ms-box-sizing: border-box;-o-box-sizing: border-box;}
.alignright {float: right;margin-left:10px;}
.alignleft {float: left;margin-right:10px;}
.aligncenter {display: block;margin-left: auto;margin-right: auto;}
amp-iframe { max-width: 100%; margin-bottom : 20px; }
.wp-caption {padding: 0;}
.wp-caption-text {font-size: 12px;line-height: 1.5em;margin: 0;padding: .66em 10px .75em;text-align: center;}
amp-carousel > amp-img > img {object-fit: contain;}
.amp-carousel-container {position: relative;width: 100%;height: 100%;} 
.amp-carousel-img img {object-fit: contain;}
@font-face {font-family: 'icomoon';font-style: normal;font-weight: normal;src:  local('icomoon'), local('icomoon'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.ttf');}
.cntr {max-width: 1100px;margin: 0 auto;width:100%;padding:0px 20px}
header .cntr{
<?php if($redux_builder_amp['swift-width-control']){?>
	max-width:<?php echo $redux_builder_amp['swift-width-control']?>;
<?php }?>
}
.h_m{position:fixed;z-index:9999;top:0px;width: 100vw;display:inline-block;
<?php if($redux_builder_amp['swift-background-scheme']['rgba']){?>background: <?php echo $redux_builder_amp['swift-background-scheme'] ['rgba'] ?>;<?php }?>
<?php if($redux_builder_amp['swift-border-line-control']){?>border-bottom: <?php echo $redux_builder_amp['swift-border-line-control'] ?>px solid;<?php } ?>
<?php if($redux_builder_amp['swift-border-color-control']['rgba']){?>border-color:<?php echo $redux_builder_amp['swift-border-color-control'] ['rgba'] ?>;<?php } ?>
<?php if($redux_builder_amp['swift-boxshadow-checkbox-control']){?>box-shadow:0px 0px 2px 2px #ccc;<?php }?>
<?php if($redux_builder_amp['swift-padding-control']){?>padding: <?php echo $redux_builder_amp['swift-padding-control']['padding-top'] .' '.$redux_builder_amp['swift-padding-control']['padding-right'] .' '.$redux_builder_amp['swift-padding-control']['padding-bottom']  .' '.$redux_builder_amp['swift-padding-control']['padding-left'] ; ?>;<?php } ?>
<?php if($redux_builder_amp['swift-margin-control']){?>margin: <?php echo  $redux_builder_amp['swift-margin-control']['margin-top'] .' '.$redux_builder_amp['swift-margin-control']['margin-right'] .' '.$redux_builder_amp['swift-margin-control']['margin-bottom']  .' '.$redux_builder_amp['swift-margin-control']['margin-left'] ; ?>;<?php } ?>}
.h_m_w{width:100%;clear:both;display: inline-flex;<?php if($redux_builder_amp['swift-height-control']){?>height:<?php echo $redux_builder_amp['swift-height-control']?>;<?php } ?>}
.h-ic a:after, .h-ic a:before{font-family: 'icomoon';font-size: 23px;<?php if($redux_builder_amp['swift-element-color-control'] ['rgba']){?>color: <?php echo $redux_builder_amp['swift-element-color-control']['rgba']?>;<?php } ?>}
.h-ic{align-self: center;}
.h-call a:after{content: "\e0cd";lign-self: center;}
.h-shop a:after{align-self: center;}
.h-ic{margin:0px 10px;}
.amp-logo a{line-height:0;display:inline-block;color:#000;}
.logo h1{margin: 0;font-size: 17px;font-weight: 700;text-transform: uppercase;display:inline-block;}
.h-srch a{line-height:1;display:block;}
.amp-logo amp-img{margin: 0 auto;}
@media(max-width:480px){ .h-sing {font-size: 13px;} }
<?php //header-type-1


if($redux_builder_amp['header-type'] == '1'){?>
.logo{z-index: 2;flex-grow: 1;align-self: center;text-align:center;line-height:0;}
.h-1{display:flex;order:1;}
.h-nav{order: -1;align-self: center;}
.h-ic:last-child{margin-right:0;}
<?php } ?>
<?php //hyder-type-2

if($redux_builder_amp['header-type'] == '2'){?>
.h-logo{order:-1;align-self: center;flex-grow:1;text-align:center;}
.h-2{order: 1;justify-content: flex-end;display: flex;}
.h-nav{order: -1;align-self: center;}
.h-sing{font-size: 18px;font-weight: 600;align-self: center;}
.h-sing a{display: inline-block;padding:9px 15px;<?php if($redux_builder_amp['signin-button-border-line']){?>border: <?php echo $redux_builder_amp['signin-button-border-line']?>px solid;<?php } ?><?php if($redux_builder_amp['signin-button-border-color']['rgba']){?>border-color: <?php echo $redux_builder_amp['signin-button-border-color']['rgba']?>;<?php } ?><?php if($redux_builder_amp['signin-button-text-color']['rgba']){?>color: <?php echo $redux_builder_amp['signin-button-text-color']['rgba']?>;<?php } ?>}
<?php if($redux_builder_amp['border-type'] == '2'){?>.h-sing a{border-radius:100px;}.h-sing a:before{border-radius:100px;}<?php } ?>
<?php if($redux_builder_amp['border-type'] == '3'){?><?php if($redux_builder_amp['border-radius'] ){ ?>.h-sing a{border-radius:<?php echo $redux_builder_amp['border-radius']?>px;}<?php } ?><?php } ?>
<?php } ?>
<?php //header-type-3

if($redux_builder_amp['header-type'] == '3'){?>
.h-logo{order:-1;align-self: center;z-index:2;}
.h-nav{order:0;align-self: center;margin:0px 0px 0px 10px;}
.h-srch a:after{position:relative;left:5px;}
.h-3{order: 1;display: inline-flex;flex-grow: 1;justify-content: flex-end;}
.h-ic:first-child {margin-left: 0;} 
<?php } ?>
<?php //search overlay

if( true == $redux_builder_amp['amp-swift-search-feature'] ){ ?>
.lb-t {position: fixed;top: -50px;width: 100%;width: 100%;opacity: 0;-webkit-transition: opacity .5s ease-in-out;transition: opacity .5s ease-in-out;overflow: hidden;z-index:9;<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>background: <?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;<?php } ?>}
.lb-t img {margin: auto;position: absolute;top: 0;left:0;right:0;bottom: 0;max-height: 0%;max-width: 0%;border: 3px solid white;box-shadow: 0px 0px 8px rgba(0,0,0,.3);box-sizing: border-box;-webkit-transition: .5s ease-in-out;transition: .5s ease-in-out;}
a.lb-x {display: block;width:50px;height:50px;box-sizing: border-box;background: tranparent;color: black;text-decoration: none;position: absolute;top: -80px;right: 0;-webkit-transition: .5s ease-in-out;transition: .5s ease-in-out;}
a.lb-x:after {content: "\e5cd";font-family: 'icomoon';font-size: 30px;line-height: 0;display: block;text-indent: 1px;
<?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;<?php } ?> }
.lb-t:target {opacity: 1;top: 0;bottom: 0;left:0;z-index:1;}
.lb-t:target img {max-height: 100%;max-width: 100%;}
.lb-t:target a.lb-x {top: 25px;}
.lb img{cursor:pointer;}
.lb-btn form{position: absolute;top: 200px;left: 0;right: 0;margin: 0 auto;text-align: center;}
.lb-btn #s{padding:10px;}
.lb-btn #amp-search-submit{padding:10px;cursor:pointer;}
.amp-search-wrapper{width: 80%;margin: 0 auto;position: relative;}
.overlay-search:before {content: "\e8b6";position: absolute;right:0;font-size: 24px;font-family: 'icomoon';cursor: pointer;top:4px;
<?php if($redux_builder_amp['swift-element-overlay-color-control']['rgba']){?>color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;<?php }  ?>}
.lb-btn #amp-search-submit {cursor: pointer;background:transparent;border: none;display: inline-block;width: 30px;height: 30px;opacity: 0;position: absolute;z-index:100;right: 0;top: 0;}
.lb-btn #s {padding: 10px;background: transparent;border: none;border-bottom: 1px solid #504c4c;width:100%;
color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;}
<?php } ?>
<?php //menu type-1 

if($redux_builder_amp['menu-type'] == '1'){?>
.m-ctr{<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>background: <?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;<?php } ?>}
.tg, .fsc{display: none;}
.fsc{width: 100%;height: -webkit-fill-available;position: absolute;cursor: pointer;top:0;left:0;}
<?php if($redux_builder_amp['header-position-type'] == '1'){?>
.tg:checked + .hamb-mnu > .m-ctr {margin-left: 0;border-right: 1px solid <?php echo $redux_builder_amp['swift-element-menu-border-color']['rgba']?>;}
.tg:checked + .hamb-mnu > .m-ctr .c-btn {position: fixed;right: 0px;top:0px;}
.m-ctr{margin-left: -100%;float: left;}
<?php } ?>
<?php if($redux_builder_amp['header-position-type'] == '2'){?>
.tg:checked + .hamb-mnu > .m-ctr {margin-left: calc(100% - <?php echo $redux_builder_amp['header-overlay-width']?>);}
.m-ctr{margin-left: 100%;float: right;}
<?php } ?>
.tg:checked + .hamb-mnu > .fsc{display: block;background: rgba(0,0,0,.9);height:100vh;}
.t-btn, .c-btn{cursor: pointer;}
.t-btn:after{content:"\e5d2";display:inline-block;font-family: "icomoon";font-size:28px;<?php if($redux_builder_amp['swift-element-color-control']['rgba']){ ?>color: <?php echo $redux_builder_amp['swift-element-color-control']['rgba']?>;<?php } ?>}
.c-btn:after{content: "\e5cd";font-family: "icomoon";font-size: 20px;<?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;<?php } ?>line-height: 0;display: block;text-indent: 1px;}
.c-btn{float: right;padding: 20px 10px;}
.m-ctr{transition: margin 0.3s ease-in-out;}
.m-ctr{<?php if($redux_builder_amp['header-overlay-width']){?>width:<?php echo $redux_builder_amp['header-overlay-width']?>;<?php } ?>height: auto;position: absolute;z-index:99;padding: 2% 0% 100vh 0%;}
.m-menu{display: inline-block;width: 100%;padding: 2px 20px 10px 20px;}
.m-scrl{overflow-y: auto;display: inline-block;width: 100%;overflow: scroll;max-height: 94vh;}
::-webkit-scrollbar { display: none; }
.m-menu ul li.menu-item-has-children:after{content: "\e313";font-family: 'icomoon';background-size: 16px;display: inline-block;top: 1px;padding: 5px;font-size:25px;transform: rotate(270deg);border-radius: 35px;color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;}
.m-menu li li.menu-item-has-children:after{right:10px;}
.m-menu li li.menu-item-has-children:hover:after{right:10px;}
.m-menu li.menu-item-has-children:hover:after{transform:rotate(360deg);top:1px;right:0px;}
.m-menu .amp-menu li ul{font-size:14px;}
.m-menu .amp-menu {list-style-type: none;padding: 0;}
.amp-menu > li a{<?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;<?php } ?> padding: 13px 7px;margin-bottom:0;}
.menu-btn{margin-top:30px;text-align:center;}
.menu-btn a{color:#fff;border:2px solid #ccc;padding:15px 30px;display:inline-block;}
.amp-menu li.menu-item-has-children>ul>li {width:100%;}
.m-menu .amp-menu li.menu-item-has-children>ul>li{
	padding-left:0;
	border-bottom: 1px solid <?php echo $redux_builder_amp['swift-element-menu-border-color']['rgba']?>;
	margin:0px 10px;
}
.m-menu .amp-menu .sub-menu li:last-child{border:none;}
.m-menu .amp-menu>li a {padding: 12px 7px;}
.m-menu > li{font-size:17px;}
<?php } ?>
.content-wrapper{<?php if($redux_builder_amp['swift-height-control']){?>margin-top:<?php echo $redux_builder_amp['swift-height-control']?>;<?php } ?>}
<?php //primary menu

if($redux_builder_amp['primary-menu']){?>
.p-m-fl{width:100%;border-bottom: 1px solid rgba(0, 0, 0, 0.05);<?php if($redux_builder_amp['primary-menu-background-scheme']['rgba']){?>background:<?php echo $redux_builder_amp['primary-menu-background-scheme']['rgba']; ?><?php } ?>}
.p-menu{width:100%;text-align:center;margin: 0px auto;max-width: 1100px;overflow-x: auto;overflow-y:hidden;white-space: nowrap;<?php if($redux_builder_amp['primary-menu-padding-control']){?>padding: <?php echo $redux_builder_amp['primary-menu-padding-control']['padding-top'] .' '.$redux_builder_amp['primary-menu-padding-control']['padding-right'] .' '.$redux_builder_amp['primary-menu-padding-control']['padding-bottom']  .' '.$redux_builder_amp['primary-menu-padding-control']['padding-left'] ; ?>;<?php } ?>}
::-webkit-scrollbar {display: none;}
.p-menu ul li{display: inline-block;margin-right: 21px;font-size: 12px;line-height: 20px;letter-spacing: 1px;font-weight: 400;}
.p-menu ul li a{padding:0;<?php if($redux_builder_amp['primary-menu-text-scheme']['rgba']){?>color:<?php echo $redux_builder_amp['primary-menu-text-scheme']['rgba']?>;<?php } ?>text-transform:uppercase;}
.p-menu ul li.menu-item-has-children:hover > ul{display:none;font-size:13px;}
.p-menu ul li.menu-item-has-children:after{display:none;}
<?php } ?>
<?php //Home and Archive

if( is_home() || is_archive() || is_search() || (function_exists('is_shop') && is_shop()) ) { ?>
.hmp{margin-top:34px;display:inline-block;width:100%;  }
.fbp{width:100%;display:inline-block;clear:both;margin:15px 15px 20px 15px;}
.fbp-img a{display:block;line-height:0;}
.fbp-img{float:left;width:66%;}
.fbp-cnt{float:left;width:31%;margin-left:30px;}
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
.loop-category li:hover a{color:#005be2;}
.fbp-cnt p, .fsp-cnt p{color:#444;font-size:13px;line-height:1.5;letter-spacing: 0.10px;}
.fbp:hover h2 a, .fsp:hover h2 a{color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;}
.fsp h2 a{color:#191919;}  
.fsp{margin: 15px;flex-basis: calc(33.33% - 30px);}
.fsp-img {margin-bottom:10px;}
.fsp h2{margin:0px 0px 5px 0px;font-size:20px;line-height:1.4;font-weight:500;}
.at-dt{font-size:11px;color:#808080;margin:12px 0px 9px 0px; display: inline-flex;}
.pt-dt{font-size:11px;color:#808080;margin: 8px 0px 0px 0px;display: inline-flex;}
.arch-tlt{margin:30px 0px 30px;display:inline-block;width:100%;}
.amp-archive-title, .amp-loop-label{font-weight:600;}
.amp-archive-desc{font-size: 14px;margin:8px 0px 0px 0px;color: #333;line-height:20px;}
.author-img amp-img {border-radius: 50%;margin: 0px 12px 10px 0px;display: block; width:50px;}
.author-img{float: left;}
.amp-sub-archives{margin:10px 0px 0px 10px;}
.amp-sub-archives ul li{list-style-type: none;display: inline-block;font-size: 12px;margin-right: 10px;font-weight: 500;}
.amp-sub-archives ul li a{color:#005be2;}
.loop-pagination{margin:20px 0px 20px 0px;}
.right a, .left a{background: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;padding: 8px 22px 12px 25px;color: #fff;line-height: 1;border-radius: 46px;font-size: 14px;display: inline-block;}
.right a:after{content:"»";display: inline-block;padding-left: 6px;font-size: 20px;line-height: 20px;height: 20px;position: relative;top: 1px;}
.left a:before{content:"«";display: inline-block;padding-right: 6px;font-size: 20px;line-height: 20px;height: 20px;position: relative;top: -1px;}

@media(max-width:1110px){
    .amppb-fluid .col{max-width:95%}
    .sf-img .wp-caption-text{width:100%;padding:10px 40px;}
    .fbp-img{width:62%;}
    .fbp-img amp-img img{width:100%;}
    .fbp-cnt h2 {font-size: 28px;line-height: 34px;}
}
@media(max-width:768px){
    .fbp-img {width: 100%;float:none;}
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
}
@media(max-width:425px){
    .fbp {margin: 0px 15px 15px 15px;}
    .fsp{margin:15px;}
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
<?php //page and frontpage

if( is_page() || ampforwp_is_front_page() || ampforwp_polylang_front_page() ){?>
    <?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
        .sp {width: 100%;margin-top: 20px;display: inline-block;}
        .breadcrumbs {padding-bottom: 10px;border-bottom: 1px solid #eee;display: inline-block;width: 100%;font-size: 10px;text-transform: uppercase;}
        #breadcrumbs li{list-style-type:none;}
        #breadcrumbs a {color: #999;}
        #breadcrumbs a:hover {color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;}
        .amp-post-title{font-size: 48px;line-height: 58px;color: #333;margin: 0;padding-top: 15px;}
        .cntn-wrp{font-size: 18px;color: #000;line-height: 1.7;}
        .cntn-wrp p{margin:0px 0px 30px 0px;}
    <?php } else{ ?>
        .cntn-wrp{font-size: 18px;color: #000;line-height: 1.7;}
        .sp {width: 100%;margin-top: 20px;display: inline-block;}
    <?php } ?>
<?php } ?>
<?php if($redux_builder_amp['single-design-type'] == '1' || $redux_builder_amp['single-design-type'] == '4'){?>
<?php // Single

if(is_single() ) { ?>
.tl-exc{font-size: 16px;color: #444;margin-top: 10px;line-height:20px;}
.amp-category span:nth-child(1) {display: none;}
.amp-category span a, .amp-category span{color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;font-size: 12px;font-weight: 500;text-transform: uppercase;}
.amp-category span:after{content:"/";display:inline-block;margin:0px 5px 0px 5px;position:relative;top:1px;color:rgba(0, 0, 0, 0.25);}
.amp-category span:last-child:after{display:none;}
.sp{width:100%;margin-top:20px;display:inline-block;}
.amp-post-title{font-size:48px;line-height:58px;color: #333;margin:0;padding-top:15px;}
.sf-img {width: 100%;display: inline-block;height: auto;margin-top: 33px;}
.sf-img figure{margin:0;}
.sf-img .wp-caption-text{width: 1100px;text-align: left;margin: 0 auto;color: #a1a1a1;font-size: 14px;line-height:20px;font-weight: 500;border-bottom: 1px solid #ccc;padding: 15px 0px;}
.sf-img .wp-caption-text:before{content:"\e412";font-family: 'icomoon';position: relative;top: 4px;opacity: 0.4;font-size:24pxmargin-right: 5px;}
.sp-cnt{margin-top: 40px;clear: both;width: 100%;display: inline-block; }
.sp-rl{display:inline-flex;width:100%;}
.sp-lt{display: flex;flex-direction: column;flex: 1 0 20%;order: 0;}
.sp-rt{width: 72%;margin-left: 60px;flex-direction: column;justify-content: space-around;order: 1;}
.ss-ic, .sp-athr, .amp-tags, .post-date{padding-bottom:20px;border-bottom:1px dotted #ccc;}
.shr-txt, .athr-tx, .amp-tags > span:nth-child(1), .amp-related-posts-title, .related-title, .r-pf h3{margin-bottom: 12px;}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{display: block;}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{text-transform: uppercase;font-size: 12px;color: #666;font-weight: 400;}
.loop-date, .post-edit-link{display:inline-block;}
.post-date .post-edit-link{color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;float: right;}
.sp-athr, .amp-tags, .post-date, .srp{margin-top:20px;}
.sp-athr .author-details a, .sp-athr .author-details, .amp-tags span a, .amp-tag {font-size: 15px;color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;font-weight: 400;line-height: 1.5;}
.amp-tags .amp-tag:after{content: "/";display: inline-block;padding: 0px 10px;position: relative;top: -1px;color: #ccc;font-size: 12px;}
.amp-tags .amp-tag:last-child:after{display:none;}
.ss-ic li:before{border-radius: 2px;text-align:center;padding: 4px 6px;}



.cntn-wrp{font-size:18px;color:#000;line-height:1.7;}
.sp-artl h1, h2, h3, h4, h5, h6{margin-bottom:5px;}
.cntn-wrp p{margin:0px 0px 30px 0px;}
.sp-rt p strong, .pg p strong{font-weight: 700;}
.srp .amp-related-posts amp-img{float: left;width: 100%;margin: 0px;height:100%;}
.srp ul li{display: inline-block;line-height: 1.3;margin-bottom: 24px;list-style-type:none;width:100%;}
.srp ul li:last-child{margin-bottom:0px;}
.has_thumbnail:hover {opacity:0.7;}
.has_thumbnail:hover .related_link a{color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;}
.related_link{margin-top:10px;}
.related_link a{color:#333;}
.amp-related-posts ul{list-style-type:none;}
.r-pf{margin-top: 40px;display: inline-block;width: 100%;}
.r-pf .loop-wrapper{margin:0;}
<?php if( 1 == $redux_builder_amp['ampforwp-inline-related-posts'] && is_single() ){ ?>
/** In content releated post desing styles **/
.related_posts .has_related_thumbnail{display: inline-flex;width: 29%;flex-direction: column;margin:0px 30px 30px 0px;justify-content: space-evenly;}
.related_link a{color: #000;font-size: 14px;line-height: 1.5;font-weight: 400;margin-top: 7px;display: inline-block;}
.related_link p{font-size: 12px;margin: 0;padding-top: 10px;}
<?php } ?>
<?php if( 1 == $redux_builder_amp['amp-author-description'] ) {?>
.sp-rt .amp-author {padding: 20px 20px;border-radius: 0;background: #f9f9f9;border: 1px solid #ececec;display: inline-block;width: 100%;}
.sp-rt .amp-author-image{float:left;}
.sp-rt .author-details a{color: #222;font-size: 14px;font-weight: 500;}
.sp-rt .author-details a:hover{color:#005be2;text-decoration:underline;}
.amp-author-image amp-img{border-radius: 50%;margin: 0px 12px 5px 0px;display: block; width:50px;}
.author-details p{margin: 0;font-size: 13px;line-height: 20px;color: #666;padding-top: 4px;}
<?php } ?>
<?php //Breadcrumbs
if( 1 == $redux_builder_amp['ampforwp-bread-crumb'] ) {?>
.breadcrumbs{padding-bottom: 8px;margin-bottom: 20px;
<?php if( 1 == $redux_builder_amp['breadcrumb-border'] ) {?>
border-bottom: 1px solid #eee;
<?php }?>}
.breadcrumb ul li{display: inline-block;list-style-type: none;font-size: 10px;text-transform: uppercase;margin-right: 5px;}
.breadcrumb ul li a{color: #999;letter-spacing: 1px;}
.breadcrumb ul li a:hover{color:#005be2;}
.breadcrumbs li a:after{content: "\e315";display: inline-block;color: #bdbdbd;font-family: 'icomoon';padding-left: 5px;font-size: 12px;position: relative;top: 1px;}
.breadcrumbs li:last-child a:after {display: none;}
<?php } //Breadcrumbs Ends?>
#pagination{margin-top: 30px;border-top: 1px dotted #ccc;padding: 20px 5px 0px 5px;;font-size: 16px;line-height: 24px;font-weight:400;}
.next{float: right;width: 45%;text-align:right;position:relative;margin-top:10px;}
.next a, .prev a{color:#333;}
.prev{float: left;width: 45%;position:relative;margin-top:10px;}
.prev span{text-transform: uppercase;font-size: 12px;color: #666;display: block;position: absolute;top: -26px;}
.next span{text-transform: uppercase;font-size: 12px;color: #666;display: block;font-weight: 400;position: absolute;top: -26px;right:0}
.next:hover a, .prev:hover a{color:<?php echo $redux_builder_amp['swift-color-scheme']['color'] ?>;}
.prev:after{border-left:1px dotted #ccc;content: "";height: calc(100% - -10px);right: -50px;position: absolute;top: 50%;transform: translate(0px, -50%);width: 2px;}
.ampforwp_post_pagination{width:100%;text-align:center;display:inline-block;}
.ampforwp_post_pagination p{margin: 0;font-size: 18px;color: #444;font-weight: 500;margin-bottom:10px;}
.ampforwp_post_pagination p a{color:#005be2;padding:0px 10px;}
.cmts{width:100%;display:inline-block;clear:both;margin-top:40px;}
.amp-comment-button{background-color: <?php echo $redux_builder_amp['swift-color-scheme']['color'] ?>;font-size: 15px;float: none;width: 100%;margin: 30px auto 0px auto;text-align: center;border-radius: 3px;font-weight: 600;width:250px;}
.form-submit #submit{background-color: #005be2;font-size: 14px;text-align: center;border-radius: 3px;font-weight: 500;color: #fff;cursor: pointer;margin: 0;border: 0;padding: 11px 21px;}
#respond p {margin: 12px 0;}
.amp-comment-button a{color: #fff;display: block;padding: 7px 0px 8px 0px;}
.comment-form-comment #comment {border-color: #ccc;width: 100%;padding: 20px;}
.cmts h3{margin: 0;font-size: 12px;padding-bottom: 6px;border-bottom: 1px solid #eee;font-weight: 400;letter-spacing: 0.5px;text-transform: uppercase;color: #444;}
.cmts h3:after{content: "";display: block;width: 115px;border-bottom: 1px solid #005be2;position: relative;top: 7px;}
.cmts ul{margin-top:16px;}
.cmts ul li{list-style: none;margin-bottom: 20px;padding-bottom: 20px;border-bottom: 1px solid #eee;}
.cmts .amp-comments-wrapper ul .children{margin-left:30px; }
.cmts .comment-author.vcard .says{display:none;}
.cmts .comment-author.vcard .fn{font-size: 12px;font-weight: 500;color: #333;}
.cmts .comment-metadata{font-size: 11px;margin-top: 8px;}
.amp-comments-wrapper ul li:hover .comment-meta .comment-metadata a{color:<?php echo $redux_builder_amp['swift-color-scheme']['color'] ?>;;}
.cmts .comment-metadata a{color: #999;}
.comment-content{margin-top:6px;width:100%;display:inline-block;}
.comment-content p{font-size: 14px;color: #333;line-height: 22px;font-weight: 400;margin: 0;}
.comment-meta amp-img{float:left;margin-right:10px;border-radius:50%;width:40px;}
.sp-rt .amp-author {margin-top: 5px;}
.cntn-wrp a{margin:10px 0px;color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;}
.loop-wrapper{display: flex;flex-wrap: wrap;margin: -15px;}
.loop-category li{display: inline-block;list-style-type: none;margin-right: 10px;font-size: 10px;font-weight: 600;letter-spacing: 1.5px;}
.loop-category li a{color:#555;text-transform: uppercase;}
.loop-category li:hover a{color:#005be2;}
.fsp-cnt p{color:#444;font-size:13px;line-height:20px;letter-spacing: 0.10px;}
.fsp:hover h2 a{color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;}
.fsp h2 a{color:#191919;}  
.fsp{margin: 15px;flex-basis: calc(33.33% - 30px);}
.fsp-img {margin-bottom:10px;}
.fsp h2{margin:0px 0px 5px 0px;font-size:20px;line-height:25px;font-weight:500;}
.fsp-cnt .loop-category{margin-bottom:8px;}
.fsp-cnt .loop-category li {font-weight: 500;}
.pt-dt{font-size:11px;color:#808080;margin: 8px 0px 0px 0px;display: inline-flex;}
blockquote{margin-bottom:20px;}
blockquote p {font-size: 34px; line-height: 1.4; font-weight: 700; position: relative; padding: 30px 0 0 0; }
blockquote p:before {content: "";border-top: 8px solid #000;width: 115px;line-height: 40px;display: inline-block;position: absolute;top: 0;}

<?php // Comments Pagination 
if( 1 == $redux_builder_amp['wordpress-comments-support']){?>
.cmts-wrap{display:flex;width:100%;margin-top: 30px;padding-bottom:30px;border-bottom:1px solid #eee;}
.cmts-wrap .page-numbers:after{display:none;}
.cmts .page-numbers{margin:0px 10px;}
.cmts .prev, .cmts .next{margin:0 auto;}
.cmts-wrap a{color:#333;}
.cmts-wrap a:hover{color:<?php echo $redux_builder_amp['swift-color-scheme']['color'] ?>;}
.cmts-wrap .current{color:<?php echo $redux_builder_amp['swift-color-scheme']['color'] ?>;}
<?php } // Comments Pagination CSS Ends
if ( isset($redux_builder_amp['ampforwp-disqus-comments-support']) && $redux_builder_amp['ampforwp-disqus-comments-support'] ) {?>
.amp-disqus-comments { text-align:center } <?php 
} ?>

@media(max-width:1110px){
    .cntr{width:100%;padding:0px 20px;}
    .sp-rt {margin-left: 30px;}
}
@media(max-width:768px){
    .tl-exc {font-size: 14px;margin-top: 3px;line-height: 22px;}
    .sp-rl {display: inline-block;width: 100%;}
    .srp .related_link{font-size:20px;line-height:1.4;font-weight:600;}
    .sp-lt {width: 100%;margin-top: 20px;}
    .sp-cnt{margin-top: 15px;}
    .rlp-image{width:200px;float:left;margin-right:15px;display: flex;flex-direction: column;}
    .rlp-cnt{display: flex;}
    .r-pf h3{margin-bottom:0;padding-top:20px;border-top:1px dotted #ccc; }
    .r-pf {margin-top:20px;}
    .cmts{margin:20px 0px 20px 0px;}
    .sp-rt {width: 100%;margin-left: 0;}
    .sp-rt .amp-author {padding: 20px 15px;}
    #pagination {margin: 20px 0px 20px 0px;border-top: none;}
    .amp-post-title{padding-top:10px;}
    .fsp{flex-basis: calc(100% - 30px);}
    .fsp-img{width:40%;float:left;margin-right:20px;}
    .fsp-cnt{width:54%;float:left;}
}
@media(max-width:480px){
    .r-pf .cntr{padding:0}
    .cntn-wrp p{line-height:1.65;}
    .related_posts .has_related_thumbnail {width: 100%;}
    .rlp-image {width: 100%;float: none;margin-right: 0px;}
    .rlp-cnt {width: 100%;float: none;}
    .amp-post-title {font-size: 32px;line-height: 44px;}
    .amp-category span a {font-size: 12px;}
    .sf-img{margin-top:20px;}
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
}
@media(max-width:425px){
    .sp-rt .amp-author {margin-bottom: 10px;}
    #pagination {margin: 20px 0px 10px 0px;}
    .fsp h2 {font-size: 24px;font-weight:600;}
    .r-pf h3{padding: 15px 0px 0px 15px;}
}
@media(max-width:320px){
    .cntn-wrp p {font-size: 16px;}  
}
<?php } } ?>
<?php if ( isset($redux_builder_amp['ampforwp-dropcap']) && $redux_builder_amp['ampforwp-dropcap'] ) { ?>
.cntn-wrp:first-child::first-letter {
    float: left;
    font-size: 75px;
    line-height: 1;
    padding-right: 8px;
}
<?php } //Drop Cap CSS ends
// Menu Search CSS
if ( $redux_builder_amp['menu-search'] ) { ?>
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
	border: 1px solid <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
	background:<?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
	width:100%;
	border-radius:60px;
}
.m-srch #s{
	padding:10px 15px;
	border:none;
	width:100%;
	color:<?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;
	background:<?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
	border-radius: 60px;
}
.m-srch{
	border-top: 1px solid <?php echo $redux_builder_amp['swift-element-menu-border-color']['rgba']?>;
    padding: 20px;
}
.m-srch .overlay-search:before{
	color:<?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;
	padding-right:10px;
	top:6px;
}
<?php } // Menu Search CSS Ends
if ( $redux_builder_amp['menu-social'] ) { ?>
.m-s-i {
	padding:25px 0px 15px 0px;
	border-top: 1px solid <?php echo $redux_builder_amp['swift-element-menu-border-color']['rgba']?>;
	text-align: center;
}
.m-s-i li{
	font-family: 'icomoon';
    list-style-type: none;
    font-size: 20px;
    display: inline-block;
    margin: 0px 15px 10px 0px;
    vertical-align: middle;
}
.m-s-i li:last-child{
	margin-right:0;
}
.m-s-i li a{
	background: transparent;
	color:<?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
}
<?php if($redux_builder_amp['enbl-fb']){?>
	.s_fb:after {content: "\e92d";}
<?php } 
if($redux_builder_amp['enbl-tw']){ ?>
	.s_tw:after {content: "\e942";}
<?php }
if($redux_builder_amp['enbl-gol']){?>
	.s_gp:after {content: "\e931";}
<?php }
if($redux_builder_amp['enbl-lk']){?>
	.s_lk:after {content: "\e934";}
<?php }
if($redux_builder_amp['enbl-pt']){?>
	.s_pt:after {content: "\e937";}
<?php } 
if($redux_builder_amp['enbl-yt']){?>
	.s_yt:after {content: "\e947";}
<?php }
if($redux_builder_amp['enbl-inst']){?>
	.s_inst:after {content: "\e932";}
<?php }
if($redux_builder_amp['enbl-vk']){?>
	.s_vk:after {content: "\e944";}
<?php }
if($redux_builder_amp['enbl-rd']){?>
	.s_rd:after {content: "\e938";}
<?php }
if($redux_builder_amp['enbl-tbl']){?>
	.s_tbl:after {content: "\e940";}
<?php } ?>
<?php } // Menu social CSS Ends
if( $redux_builder_amp['amp-swift-menu-cprt']){?>
.cp-rgt{
	font-size:11px;
	line-height:1.2;
	color:<?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
	padding: 20px;
	text-align: center;
	border-top: 1px solid <?php echo $redux_builder_amp['swift-element-menu-border-color']['rgba']?>;
}
.cp-rgt a{
	color:<?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
	border-bottom:1px solid <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
	margin-left:10px;
}
.cp-rgt .view-non-amp{
	display:none;
}
<?php } //Menu Copy Right CSS Ends
if($redux_builder_amp['single-design-type'] == '4'){
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
    margin: -15px;
}
.sp-artl .srp .has_thumbnail{
    margin: 15px;
    flex-basis: calc(33.33% - 30px);
}
.sf-img .wp-caption-text{
	width:100%;
}
@media(max-width:768px){
.sp-artl .srp .has_thumbnail{
    flex-basis: calc(100% - 30px);
}
}

<?php } //is_single condition is added
if ($redux_builder_amp['swift-sidebar']) { ?>
.sp-artl{
	display:inline-flex;
	width:100%;
}
.sp-left {
    display: flex;
    flex-direction: column;
    width: 70%;
    padding-right: 20px;
}
.sp-artl .srp .has_thumbnail{
    margin: 15px;
	flex-basis: calc(49.33% - 30px);
}
.sp-artl .fsp{
	flex-basis: calc(49.33% - 30px);
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
    flex-basis: calc(100% - 30px);
}

}
<?php } // sidebar CSS ends
} // single design 4 ends?>
<?php // Header and Archive Sidebar
if ($redux_builder_amp['gbl-sidebar']) { ?>
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
.fbp-cnt {
    float: left;
    width: 30%;
    margin-left: 20px;
}
.b-w .fsp, .arch-psts .fsp{
	flex-basis: calc(49.33% - 30px);
}
.b-w .sdbr-right{
	margin-top:30px;
}
@media(max-width:768px){
.fbp-cnt{
	width:100%;
}

}
<?php }
if ($redux_builder_amp['gbl-sidebar'] || $redux_builder_amp['swift-sidebar'] ) { ?>
/*** Sidebar CSS ***/
.sdbr-right{
	<?php if( $redux_builder_amp['sidebar-bgcolor']['rgba'] ) {?>
		background:<?php echo $redux_builder_amp['sidebar-bgcolor']['rgba']?>;
	<?php } ?>
	display:flex;
	flex-direction:column;
	width:30%;
}
.amp-sidebar{
	padding:20px;
	font-size: 16px;
    line-height: 1.5;
   	<?php if( $redux_builder_amp['sbr-text-color']['rgba'] ) {?>
		color: <?php echo $redux_builder_amp['sbr-text-color']['rgba'] ?>;
	<?php } ?>
}
.amp-sidebar ul li{
	list-style-type: none;
    margin-bottom: 15px;
}
.amp-sidebar h4{
<?php if( $redux_builder_amp['sbr-heading-color']['rgba'] ) {?>
	color: <?php echo $redux_builder_amp['sbr-heading-color']['rgba'] ?>;
<?php } ?>
    margin-bottom:15px;
}
.amp-sidebar p{
	margin-bottom:15px;
}
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
    flex-basis: calc(100% - 30px);
}
}
<?php } //Header and Archive Sidebar CSS Ends ?>
<?php 

//Footer
if ( isset($redux_builder_amp['footer-type']) && '1' == $redux_builder_amp['footer-type'] ) { ?>
.footer{font-size: 12px;margin-top: 80px;}
.f-menu ul li .sub-menu{display:none;}
.f-menu ul li{display:inline-block;margin-right:20px;}
.f-menu ul li a {padding:0;font-size:14px;color:#7a7a7a;}
.f-menu ul > li:hover a{color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;}
.f-menu{margin-bottom:30px;}
.rr{font-size: 12px;color: #333;}
.f-menu ul li.menu-item-has-children:hover > ul{display:none;}
.f-menu ul li.menu-item-has-children:after{display:none;}
<?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
.f-w-f1{padding:70px 0px; width:100%; border-top: 1px solid #eee;}
<?php endif; ?>
.f-w{display: inline-flex;width: 100%;flex-wrap:wrap;}
.f-w-f2{text-align: center;border-top: 1px solid #eee;padding:50px 0px;}
.w-bl{margin-left: 0;display: flex;flex-direction: column;position: relative;flex: 1 0 22%;margin:0 15px 30px;line-height:1.4;}
.w-bl h4{color: #999;font-size: 12px;font-weight: 500;margin-bottom: 20px;text-transform: uppercase;letter-spacing: 1px;padding-bottom: 4px;}
.w-bl ul li, .ampforwp_wc_shortcode_title{list-style-type: none;font-size: 14px;line-height:1.5;margin-bottom: 15px;}
.w-bl ul li:last-child{margin-bottom:0;}
.w-bl ul li a{text-decoration: none;}
.w-bl .menu li .sub-menu{display:none;}

.ampforwp_wc_shortcode_title{
	margin-top: 12px;
    display: inline-block;
}
.ampforwp_wc_shortcode_excerpt{
	font-size:15px;
	line-height:1.4;
}
<?php /*** New footer Features ***/
if( true ==  $redux_builder_amp['footer-customize-options']) { ?>
.f-w{
	flex-wrap:wrap;
}
.f-w-f1{
<?php if( $redux_builder_amp['swift-footer-bg']['rgba'] ) {?>
	background:<?php echo $redux_builder_amp['swift-footer-bg']['rgba']?>;
<?php } ?>
	padding: 50px 0px 30px 0px;
}
.f-w .w-bl{
    flex: 1 0 30%;
    margin-bottom:30px;
}
.w-bl h4{
<?php if( $redux_builder_amp['swift-footer-heading-clr']['rgba'] ) {?>
	color: <?php echo $redux_builder_amp['swift-footer-heading-clr']['rgba'] ?>;
<?php } ?>
    font-weight: 600;
    text-transform: none;
    font-size: 16px;
}
.w-bl a, .f-menu ul li a, .rr a{
<?php if( $redux_builder_amp['swift-footer-link-clr']['rgba'] ) {?>
	color: <?php echo $redux_builder_amp['swift-footer-link-clr']['rgba'] ?>;
<?php } ?>
	transition:0.3s ease-in-out 0s;
}
.w-bl a:hover, .f-menu ul li a:hover, .rr a:hover{
<?php if( $redux_builder_amp['swift-footer-link-hvr']['rgba'] ) {?>
	color: <?php echo $redux_builder_amp['swift-footer-link-hvr']['rgba'] ?>;
<?php } ?>
}
.w-bl p{
<?php if( $redux_builder_amp['swift-footer-txt-clr']['rgba'] ) {?>
	color: <?php echo $redux_builder_amp['swift-footer-txt-clr']['rgba'] ?>;
<?php } ?>
	font-size: 15px;
    line-height: 1.4;
    margin-bottom:15px;
}
.f-w-f2{
<?php if( $redux_builder_amp['swift-footer2-bg']['rgba'] ) {?>
	background:<?php echo $redux_builder_amp['swift-footer2-bg']['rgba']?>;
<?php } ?>
	border:none;
	display: inline-block;
    clear: both;
    width: 100%;
    padding:43px 0px;
}
.rr {
<?php if( $redux_builder_amp['swift-footer-txt-clr']['rgba'] ) {?>
	color: <?php echo $redux_builder_amp['swift-footer-txt-clr']['rgba'] ?>;
<?php } ?>
font-size:15px;
}
<?php if($redux_builder_amp['footer2-position-type'] == '2'){?>
.f-menu{
	display:inline-block;
	float:right;
	margin:0;
}
.f-menu ul li{
	margin:0;
} 
.f-menu ul li a span{
	font-size:15px;
    font-weight: 500;
}
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
}
@media(max-width:768px){
.f-menu{
	float:none;
}
.rr {
	float:none;
    font-size: 13px;
    margin-top:15px;
}
}
<?php } ?>
<?php } // New footer feature closed ?>
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
    .f-w{display:block;}
    .w-bl{margin-bottom:40px;}
    .w-bl{flex:100%;}
    .w-bl ul li {margin-bottom: 11px;}
    .f-menu ul li {display: inline-block;line-height: 1.8;margin-right: 13px;}
    .f-menu .amp-menu > li a {padding: 0;font-size: 12px;color: #7a7a7a;}
    .rr {margin-top: 15px;font-size: 11px;}
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
if(is_single()){ ?>
.ss-ic ul li{font-family: 'icomoon';list-style-type:none;display:inline-block;}
.ss-ic li a{color: #fff;padding: 5px;border-radius: 3px;margin: 0px 10px 10px 0px;display: inline-block;}
<?php if($redux_builder_amp['enable-single-facebook-share'] || $redux_builder_amp['enbl-fb'] ){?>
.ss-ic ul li .s_fb{	color:#fff;background:#3b5998;}
.s_fb:after{content: "\e92d";}
<?php } 
if($redux_builder_amp['enable-single-twitter-share'] || $redux_builder_amp['enbl-tw']){?>
.s_tw{background:#1da1f2;}
.s_tw:after{content: "\e942";}
<?php } 
if($redux_builder_amp['enable-single-gplus-share'] || $redux_builder_amp['enbl-gol']){?>
.s_gp{background:#dd4b39;}
.s_gp:after{content: "\e931";}
<?php } 
if($redux_builder_amp['enable-single-linkedin-share'] || $redux_builder_amp['enbl-lk']){?>
.s_lk{background:#0077b5;}
.s_lk:after{content: "\e934";}
<?php }
if($redux_builder_amp['enable-single-pinterest-share'] || $redux_builder_amp['enbl-pt']){?>
.s_pt{background:#bd081c;}
.s_pt:after{content:"\e937";}
<?php } 
if($redux_builder_amp['enable-single-email-share']){?>
.s_em{background:#b7b7b7;}
.s_em:after{content: "\e930";}
<?php }
if($redux_builder_amp['enable-single-whatsapp-share']){?>
.s_wp{background:#075e54;}
.s_wp:after{content: "\e946";}
<?php } 
if($redux_builder_amp['enable-single-odnoklassniki-share']){?>
.s_od{background:#ed812b;}
.s_od:after{content: "\e936";}
<?php } 
if($redux_builder_amp['enable-single-vk-share']){?>
.s_vk{background:#45668e;}
.s_vk:after{content: "\e944";}
<?php } 
if($redux_builder_amp['enable-single-reddit-share']){?>
.s_rd{background:#ff4500;}
.s_rd:after{content: "\e938";}
<?php } 
if($redux_builder_amp['enable-single-tumblr-share']){?>
.s_tb{background:#35465c;}
.s_tb:after{content: "\e940";}
<?php } 
if($redux_builder_amp['enable-single-telegram-share']){?>
.s_tg{background:#0088cc;}
.s_tg:after{content: "\e93f";}
<?php } 
if($redux_builder_amp['enable-single-digg-share']){?>
.s_dg{background:#005be2;}
.s_dg:after{content: "\e919";}
<?php }
if($redux_builder_amp['enable-single-stumbleupon-share']){?>
.s_su{background:#eb4924;}
.s_su:after{content: "\e93e";}
<?php }
if($redux_builder_amp['enable-single-wechat-share']){?>
.s_wc{background:#7bb32e;}
.s_wc:after{content: "\e945";}
<?php } 
if($redux_builder_amp['enable-single-viber-share']){?>
.s_vb{background:#59267c;}
.s_vb:after{content: "\e943";}
<?php }
if(isset($redux_builder_amp['enable-single-yummly-share']) && $redux_builder_amp['enable-single-yummly-share']){?>
.s_ym{background:#e26426}
.s_ym:after{content: "\e948";}
<?php } ?>
.s_stk{background: #f1f1f1;display:inline-block;width: 100%;padding:0;position:fixed;bottom: 0;text-align: center;border: 0;}
.s_stk ul{width:100%;display:inline-flex;}
.s_stk ul li{flex-direction: column;flex-basis: 0;flex: 1 0 5%;max-width: calc(100% - 10px);display: flex;}
.s_stk li a{margin:0;border-radius: 0;padding:12px;}
.rr {margin-bottom: 30px;display: inline-block;}
<?php } ?>
.content-wrapper a, .breadcrumb ul li a, .srp ul li, .rr a{transition: all 0.3s ease-in-out 0s;}
[class^="icon-"], [class*=" icon-"] {font-family: 'icomoon';speak: none;font-style: normal;font-weight: normal;font-variant: normal;text-transform: none;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
.amp-ad-wrapper{width:100%;text-align:center;}
.amp-ad-wrapper span { display: inherit; font-size: 12px; line-height: 1;}
<?php if( isset($redux_builder_amp['enable-amp-ads-1'] ) && $redux_builder_amp['enable-amp-ads-1'] ) { ?>.amp_ad_1{margin: -2px 0px -17px 0px;}<?php } 
if( isset($redux_builder_amp['enable-amp-ads-2'] ) && $redux_builder_amp['enable-amp-ads-2'] ) { ?>.amp_ad_2{margin: 20px 0px -23px 0px; }<?php } 
if( isset($redux_builder_amp['enable-amp-ads-3'] ) && $redux_builder_amp['enable-amp-ads-3'] ) { ?>.amp-ad-3{margin: 0px 0px -4px 0px;}<?php }
if( isset($redux_builder_amp['enable-amp-ads-4'] ) && $redux_builder_amp['enable-amp-ads-4'] ) { ?>.amp_ad_4{margin: 20px 0px 20px 0px;}<?php }
if( isset($redux_builder_amp['enable-amp-ads-5'] ) && $redux_builder_amp['enable-amp-ads-5'] ) { ?>.amp_ad_5{margin: 10px 0px -17px 0px;}<?php }
if( isset($redux_builder_amp['enable-amp-ads-6'] ) && $redux_builder_amp['enable-amp-ads-6'] ) { ?>.amp-ad-6{ margin: 0px 0px 20px 0px;}<?php } ?>
.amp-ad-wrapper {margin-top: 10px; margin-bottom: 10px}
#amp-user-notification1{padding: 5px;text-align: center;background: #fff;border-top: 1px solid #005be2;}
#amp-user-notification1 p {display: inline-block;margin: 20px 0px;}
amp-user-notification button {padding: 8px 10px;background: #005be2;color: #fff;margin-left: 5px;border: 0;}
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
.fbp-img {float: right;}
.fbp-cnt {margin-right: 30px;margin-left:0}
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
.comment-meta amp-img {float: right;margin-left: 10px;}
.archive .author-img {float: right;}
.archive  .author-img amp-img {margin: 0px 0px 10px 12px;}
.amp-archive-title, .amp-archive-desc{text-align:right;}
@media(max-width:1024px){
.fbp-img{float:right;}
.fbp-cnt{width:33%;}
}
@media(max-width:768px){
.fbp-cnt {width:100%;float:none;margin-right:0;}
.fsp-img {float: right;margin-right: 0;margin-left:20px;}
.rlp-image {float: right;margin-left: 15px;margin-right: 0;}
.sp-rt{margin-right:0}
}
@media(max-width:480px){
.fbp-cnt{width:100%;margin-right:0;}
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
    margin-right: calc(100% - <?php echo $redux_builder_amp['header-overlay-width']?>);
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
<?php } //RTL End ?>