<?php global $redux_builder_amp; ?>
/***** AMP Framework Reset *****/
<?php    if(!isset($redux_builder_amp['amp_font_selector']) || $redux_builder_amp['amp_font_selector'] == 1 || empty($redux_builder_amp['amp_font_selector'])){
?>
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 300;
  src: local('Poppins Light'), local('Poppins-Light'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Light.ttf');
}
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 400;
  src: local('Poppins Regular'), local('Poppins-Regular'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Regular.ttf');
}
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 500;
  src: local('Poppins Medium'), local('Poppins-Medium'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Medium.ttf');
} 
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 600;
  src: local('Poppins SemiBold'), local('Poppins-SemiBold'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-SemiBold.ttf'); 
}
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 700;
  src: local('Poppins Bold'), local('Poppins-Bold'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Poppins-Bold.ttf'); 
}
<?php } ?>
body{ 
    <?php 
    $fontFamily = "font-family: 'Poppins', sans-serif;";
    if(isset($redux_builder_amp['amp_font_selector']) && $redux_builder_amp['amp_font_selector'] != 1 && !empty($redux_builder_amp['amp_font_selector'])){ 
        $fontFamily = "font-family: '".$redux_builder_amp['amp_font_selector']."';"; } 
   
echo $fontFamily;
?>
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
/* CSS Reset */
html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent}body{line-height:1}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}nav ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:none}a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent}ins{background-color:#ff9;color:#000;text-decoration:none}mark{background-color:#ff9;color:#000;font-style:italic;font-weight:bold}del{text-decoration:line-through}abbr[title],dfn[title]{border-bottom:1px dotted;cursor:help}table{border-collapse:collapse;border-spacing:0}hr{display:block;height:1px;border:0;border-top:1px solid #ccc;margin:1em 0;padding:0}input,select{vertical-align:middle}
*,*:after,*:before {
box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;-ms-box-sizing: border-box;-o-box-sizing: border-box;}

/* Image Alignment */
.alignright {
    float: right;
    margin-left:10px;
}
.alignleft {
    float: left;
    margin-right:10px;
}
.aligncenter {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
amp-iframe { max-width: 100%; margin-bottom : 20px; }

/* Captions */
.wp-caption {
    padding: 0;
}
.wp-caption-text {
    font-size: 12px;
    line-height: 1.5em;
    margin: 0;
    padding: .66em 10px .75em;
    text-align: center;
}

/* AMP Media */
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
    margin: 0 -16px 1.5em;
}
amp-carousel > amp-img > img {
    object-fit: contain;
}
.amp-carousel-container {position: relative;width: 100%;height: 100%;} 
.amp-carousel-img img {object-fit: contain;}

/*** Font-icons ***/
@font-face {
    font-family: 'icomoon';
    font-style: normal;
    font-weight: normal;
    src:  local('icomoon'), local('icomoon'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.ttf');
}

/***** Container *****/
.cntr {
    max-width: 1100px;
    margin: 0 auto;
}
/***** AMP Sidebar *****/
<?php if($redux_builder_amp['menu-type'] == '1'){?>
amp-sidebar, .lb-t {
<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>
    background: <?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;
 <?php } ?>
}
amp-sidebar{
    width:100%;
    padding:0 5% 0 5%;
}
/* AMP Sidebar Toggle button */
.amp-sidebar-button{
    position:relative;
}
.amp-sidebar-toggle span  {
    display: block;
    height: 2px;
    margin-bottom: 5px;
    width: 22px;
    <?php 
    if($redux_builder_amp['swift-element-color-control']['rgba']){ ?>
        background: <?php echo $redux_builder_amp['swift-element-color-control']['rgba']?>;
    <?php } ?>
}
.amp-sidebar-toggle span:last-child{
    margin-bottom:0;
}
.amp-sidebar-toggle span:nth-child(2){
    top: 7px;
}
.amp-sidebar-toggle span:nth-child(3){
    top:14px;
}
/* AMP Sidebar close button */
.amp-sidebar-close{
    position: absolute;
    right: -3px;
    top: 10px;
    color: transparent;
}
/***** AMP Navigation Menu with Dropdown Support *****/
.toggle-navigation ul{
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: inline-block;
    width: 100%
}
.toggle-navigation ul li{
    font-size: 13px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.11);
    padding: 11px 0px;
    width: 25%;
    float: left;
    text-align: center;
    margin-top: 6px
}
.toggle-navigation ul ul{
    display: none
}
.toggle-navigation ul li a{
    color: #eee;
    padding: 15px;
}
.toggle-navigation{
    display: none;
    background: #444;
}
/***** Header *****/
header{
    position:fixed;
    z-index:9999;
    top:0px;
}
.header, .header-2, .header-3{
    width:100%;
    display:inline-block;
    <?php if($redux_builder_amp['swift-background-scheme']['rgba']){?>
    background: <?php echo $redux_builder_amp['swift-background-scheme'] ['rgba'] ?>;
     <?php }?>
    <?php if($redux_builder_amp['swift-border-line-control']){?>
        border-bottom: <?php echo $redux_builder_amp['swift-border-line-control'] ?>px solid;
    <?php } ?>
    <?php if($redux_builder_amp['swift-border-color-control']['rgba']){?>
        border-color:<?php echo $redux_builder_amp['swift-border-color-control'] ['rgba'] ?>;
    <?php } ?>
    <?php if($redux_builder_amp['swift-boxshadow-checkbox-control']){?>
        box-shadow:0px 0px 2px 2px #ccc;
    <?php }?>
    <?php if($redux_builder_amp['swift-padding-control']){?>
         padding: <?php echo $redux_builder_amp['swift-padding-control']['padding-top'] .' '. 
                             $redux_builder_amp['swift-padding-control']['padding-right'] .' '. 
                             $redux_builder_amp['swift-padding-control']['padding-bottom']  .' '. 
                             $redux_builder_amp['swift-padding-control']['padding-left'] ; ?>;
    <?php } ?>

    <?php if($redux_builder_amp['swift-margin-control']){?>
        margin: <?php echo  $redux_builder_amp['swift-margin-control']['margin-top'] .' '. 
                            $redux_builder_amp['swift-margin-control']['margin-right'] .' '. 
                            $redux_builder_amp['swift-margin-control']['margin-bottom']  .' '. 
                            $redux_builder_amp['swift-margin-control']['margin-left'] ; ?>;
    <?php } ?>
}

.head, .head-2, .head-3{
    width:100%;
    clear:both;
    display: inline-flex;
    <?php if($redux_builder_amp['swift-height-control']){?>
        height:<?php echo $redux_builder_amp['swift-height-control']?>;
    <?php } ?>
}
.h-ic a:after, .h-ic a:before{
    <?php if($redux_builder_amp['swift-element-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-color-control']['rgba']?>;
    <?php } ?>
    font-family: 'icomoon';
    font-size: 23px;
}
.h-ic{
    align-self: center;
}
.h-1{
    display:flex;
    order:1;
}
.h-2{
    order: 1;
    justify-content: flex-end;
    display: flex;
}
.h-call a:after{
    content: "\e0cd";
    align-self: center;
}
.h-shop a:after{
     align-self: center;
}
.h-nav{
    order: -1;
    align-self: center;
}
.h-3 .h-nav{
    order:0;
    margin:0px 0px 0px 10px;
}
.logo{
    z-index: 2;
    flex-grow: 1;
    align-self: center;
    text-align:center;
}
.h-3{
    order: 1;
    display: inline-flex;
    flex-grow: 1;
    justify-content: flex-end;
}
.h-3 .h-srch a:after{
    position:relative;
    left:5px;
} 
.h-ic{
    margin:0px 10px;
}
.h-ic:first-child{
    margin-left:0;
}
.h-ic:last-child{
    margin-right:0;
}
.head-3 .h-logo{
    order:-1;
    align-self: center;
    z-index:2;
}
.amp-logo a{
    line-height:0;
   display:inline-block;
    color:#000;
}
.logo h1{
   margin: 0;
    font-size: 17px;
    font-weight: 700;
    text-transform: uppercase;
    display:inline-block;
}
.h-srch a{
    line-height:1;
    display:block;
}
<?php
$logoStyle = "max-width:190px;width:". ampforwp_default_logo('width')."px;";
if( isset($redux_builder_amp['ampforwp-custom-logo-dimensions-options']) && 
    $redux_builder_amp['ampforwp-custom-logo-dimensions-options']=='flexible' && 
    $redux_builder_amp['ampforwp-custom-logo-dimensions-slider']){

   $logoStyle = "max-width: ".$redux_builder_amp['ampforwp-custom-logo-dimensions-slider']."%;
width:". ampforwp_default_logo('width')."px;";
}
?>
.amp-logo amp-img{ <?php echo $logoStyle; ?>margin: 0 auto;}

.amp-sidebar-close:after{
    content: "\e5cd";
    font-family: 'icomoon';
    font-size: 16px;
   <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?>
    text-indent: 1px;
    cursor: pointer;
    padding: 12px 16px;
}
.m-menu ul li.menu-item-has-children:after{
    content: "\e313";
    font-family: 'icomoon';
    background-size: 16px;
    display: inline-block;
    background: rgba(255, 255, 255, 0.29);
    top: 4px;
    padding: 5px;
    font-size:16px;
    border-radius: 35px;
    color:#fff;
}
.m-menu ul li ul li.menu-item-has-children:after{
   right:10px;
}
.m-menu ul li ul li.menu-item-has-children:hover:after{
    right:10px;
}
.m-menu ul li.menu-item-has-children:hover:after{
    -webkit-transform:rotate(180deg);
    transform:rotate(180deg);
    top:4px;
    right:0px;
}
.m-menu .amp-menu li:hover li:hover>a{background:transparent;}
.amp-menu li.menu-item-has-children ul{
    font-size:13px;
}
.amp-menu li:hover a {background: transparent none repeat scroll 0 0;}
.m-menu .amp-menu {
    list-style-type: none;
    margin: 45px 0 0 0;
    padding: 0;
}
.amp-menu > li a{
    <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?> 
    padding: 13px 7px;
    margin-bottom:0;
}
.menu-btn{
    margin-top:30px;
    text-align:center;
}
.menu-btn a{
    color:#fff;
    border:2px solid #ccc;
    padding:15px 30px;
    display:inline-block;
}
/*** Light Box ***/
.lb-t{
    position: fixed;
    top: -50px;
    width: 100%;
    width: 100%;
    opacity: 0;
    -webkit-transition: opacity .5s ease-in-out;
    transition: opacity .5s ease-in-out;
    overflow: hidden;
    z-index:9;
}
.lb-t img {
    margin: auto;
    position: absolute;
    top: 0;
    left:0;
    right:0;
    bottom: 0;
    max-height: 0%;
    max-width: 0%;
    border: 3px solid white;
    box-shadow: 0px 0px 8px rgba(0,0,0,.3);
    box-sizing: border-box;
    -webkit-transition: .5s ease-in-out;
    transition: .5s ease-in-out;
}
a.lb-x {
    display: block;
    width:50px;
    height:50px;
    box-sizing: border-box;
    background: tranparent;
    color: black;
    text-decoration: none;
    position: absolute;
    top: -80px;
    right: 0;
    -webkit-transition: .5s ease-in-out;
    transition: .5s ease-in-out;
}
a.lb-x:after {
    content: "\e5cd";
    font-family: 'icomoon';
    font-size: 30px;
    <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?> 
    line-height: 0;
    display: block;
    text-indent: 1px;
}
.lb-t:target {
    opacity: 1;
    top: 0;
    bottom: 0;
    left:0;
    z-index:1;
}
.lb-t:target img {
    max-height: 100%;
    max-width: 100%;
}
.lb-t:target a.lb-x {
    top: 25px;
}
.lb img{
    cursor:pointer;
}
.lb-btn form{
    position: absolute;
    top: 200px;
    left: 0;
    right: 0;
    margin: 0 auto;
    text-align: center;
}
.lb-btn form #s{
    padding:10px;
}
.lb-btn form #amp-search-submit{
    padding:10px;
    cursor:pointer;
}
.amp-search-wrapper{
    width: 80%;
    margin: 0 auto;
    position: relative;
}
.overlay-search:before {
    content: "\e8b6";
    position: absolute;
    right:0;
    font-size: 24px;
    font-family: 'icomoon';
    cursor: pointer;
    <?php if($redux_builder_amp['swift-element-overlay-color-control']['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php }  ?>
    top:4px;
}
.lb-btn form #amp-search-submit {
    cursor: pointer;
    background:transparent;
    border: none;
    display: inline-block;
    width: 30px;
    height: 30px;
    opacity: 0;
    position: absolute;
    z-index:100;
    right: 0;
    top: 0;
}
.lb-btn form #s {
    padding: 10px;
    background: transparent;
    border: none;
    border-bottom: 1px solid #504c4c;
    color: #fff;
    width:100%;
}
/*** Header - Styles ***/

.head-2 .h-logo{
    order:-1;
    align-self: center;
   flex-grow:1;
   text-align:center;
}
.amp-logo{
    line-height:0;
}
.h-sing{
    font-size: 18px;
    font-weight: 600;
    align-self: center;
}
.h-sing a{
    <?php if($redux_builder_amp['signin-button-border-line']){?>
        border: <?php echo $redux_builder_amp['signin-button-border-line']?>px solid;
    <?php } ?>
    <?php if($redux_builder_amp['signin-button-border-color']['rgba']){?>
        border-color: <?php echo $redux_builder_amp['signin-button-border-color']['rgba']?>;
    <?php } ?>
    padding:9px 15px;
    <?php if($redux_builder_amp['signin-button-text-color']['rgba']){?>
        color: <?php echo $redux_builder_amp['signin-button-text-color']['rgba']?>;
    <?php } ?>
    display: inline-block;
    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px transparent;
    position: relative;
    -webkit-transition-property: color;
    transition-property: color;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
}
 <?php if($redux_builder_amp['border-type'] == '2'){?>
.h-sing a{
    border-radius:100px;
}
.h-sing a:before{
    border-radius:100px;
}
<?php } ?>
 <?php if($redux_builder_amp['border-type'] == '3'){?>
<?php if($redux_builder_amp['border-radius'] ){ ?>
.h-sing a{
    border-radius:<?php echo $redux_builder_amp['border-radius']?>px;
}
.h-sing a:before{
    border-radius:<?php echo $redux_builder_amp['border-radius']?>px;
}
<?php } ?>
<?php } ?>
.h-sing a:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #005be2;
    -webkit-transform: scaleX(0);
    transform: scaleX(0);
    -webkit-transform-origin: 0 50%;
    transform-origin: 0 50%;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out;
}
.h-sing a:hover, .h-sing a:focus, .h-sing a:active {
    color: #fff;
}
.h-sing a:hover:before, .h-sing a:focus:before, .h-sing a:active:before {
    -webkit-transform: scaleX(1);
    transform: scaleX(1);
}

/*** Primary Menu ***/
.content-wrapper{
    <?php if($redux_builder_amp['swift-height-control']){?>
    margin-top:<?php echo $redux_builder_amp['swift-height-control']?>;
    <?php } ?>
}
.p-m-fl{
    width:100%;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    <?php if($redux_builder_amp['primary-menu-background-scheme']['rgba']){?>
        background:<?php echo $redux_builder_amp['primary-menu-background-scheme']['rgba']; ?>
    <?php } ?>
}
.p-menu{
    width:100%;
    text-align:center;
    margin: 0px auto;
    max-width: 1100px;
    overflow-x: scroll;
    overflow-y:hidden;
    white-space: nowrap;
    <?php if($redux_builder_amp['primary-menu-padding-control']){?>
         padding: <?php echo $redux_builder_amp['primary-menu-padding-control']['padding-top'] .' '. 
                             $redux_builder_amp['primary-menu-padding-control']['padding-right'] .' '. 
                             $redux_builder_amp['primary-menu-padding-control']['padding-bottom']  .' '. 
                             $redux_builder_amp['primary-menu-padding-control']['padding-left'] ; ?>;
    <?php } ?>
}
::-webkit-scrollbar {
display: none;
}
.p-menu ul li{
    display: inline-block;
    margin-right: 21px;
    font-size: 12px;
    line-height: 20px;
    letter-spacing: 1px;
    font-weight: 400;
}
.p-menu ul li a{
    padding:0;
    <?php if($redux_builder_amp['primary-menu-text-scheme']['rgba']){?>
    color:<?php echo $redux_builder_amp['primary-menu-text-scheme']['rgba']?>;
    <?php } ?>
    text-transform:uppercase;
}
.p-menu .amp-menu li.menu-item-has-children:hover > ul{
    display:none;
    font-size:13px;
}
.p-menu .amp-menu li.menu-item-has-children:after{
    display:none;
}
<?php } ?>
<?php if(is_home() || is_archive()){ ?>
/**** Big post ***/
.hmp{
  margin-top:34px;  
}
.fbp{
    width:100%;
    display:inline-block;
    clear:both;
    margin:15px 15px 20px 15px;
}
.fbp-img a{
    display:block;
    line-height:0;
}
.fbp-img{
    float:left;
    width:66%;
}
.fbp-cnt{
    float:left;
    width:31%;
    margin-left:30px;
}
.fbp-cnt .loop-category{
    margin-bottom:12px;
}
.fsp-cnt .loop-category{
    margin-bottom:7px;
}
.fsp-cnt .loop-category li {
  font-weight: 500;
}
.fbp-cnt h2 {
    margin: 0px;
    font-size: 32px;
    line-height: 38px;
    font-weight:700;
}
.fbp-cnt h2 a{
    color:#191919;
}
.fbp-cnt .amp-author {
    padding-left:6px;
}
.fbp:hover .author-name a{
    text-decoration:underline;
}
.fbp-cnt .author-details a{
    color:#808080;
}
.fbp-cnt .author-details a:hover{
    color: #005be2;
}
<?php }?>

.loop-wrapper{
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: -15px;
}
.loop-category li{
    display: inline-block;
    list-style-type: none;
    margin-right: 10px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
}
.loop-category li a{
    color:#555;
    text-transform: uppercase;
}
.loop-category li:hover a{
    color:#005be2;
}
.fbp-cnt p, .fsp-cnt p{
    color:#444;
    font-size:13px;
    line-height:20px;
    letter-spacing: 0.10px;
}
.fbp:hover h2 a, .fsp:hover h2 a{
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
}
.fsp h2 a{
    color:#191919;
}  
/**** Small post ***/
.fsp{
    margin: 15px 15px 25px 15px;
    flex-basis: calc(33.33% - 30px);
}
.fsp-cnt{
    margin-top:10px;
}
.fsp-img a{
    display:block;
    line-height:0;
}
.fsp h2{
    margin:0px 0px 5px 0px;
    font-size:20px;
    line-height:25px;
    font-weight:500;
}
.at-dt{
    font-size:11px;
    color:#808080;
    margin:12px 0px 9px 0px; 
    display: inline-flex;
}
.pt-dt{
    font-size:11px;
    color:#808080;
    margin: 8px 0px 0px 0px;
    display: inline-flex;
}
/*** Archives ***/
.arch-tlt{
    margin:30px 0px 30px;
}
.amp-archive-title, .amp-loop-label{
    font-weight:600;
}
.amp-archive-desc{
    font-size: 14px;
    margin:8px 0px 0px 0px;
    color: #333;
    line-height:20px;
}
.author-img amp-img {border-radius: 50%;margin: 0px 12px 10px 0px;display: block; width:50px;}
.author-img{float: left;}
.amp-sub-archives{
    margin:10px 0px 0px 10px;
}
.amp-sub-archives ul li{
    list-style-type: none;
    display: inline-block;
    font-size: 12px;
    margin-right: 10px;
    font-weight: 500;
}
.amp-sub-archives ul li a{
    color:#005be2;
}
/*** loop-pagination ***/
.loop-pagination{
    margin-top:20px;
}
.right a, .left a{
    background: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    padding: 8px 22px 12px 25px;
    color: #fff;
    line-height: 1;
    border-radius: 46px;
    font-size: 14px;
    display: inline-block;
}
.right a:after{
    content:"»";
    display: inline-block;
    padding-left: 6px;
    font-size: 20px;
    line-height: 20px;
    height: 20px;
    position: relative;
    top: 1px;
}
.left a:before{
    content:"«";
    display: inline-block;
    padding-right: 6px;
    font-size: 20px;
    line-height: 20px;
    height: 20px;
    position: relative;
    top: -1px;
}
<?php if($redux_builder_amp['single-design-type'] == '1'){?>
<?php if(is_single()){ ?>
/*** Single ***/
.tl-exc{
    font-size: 16px;
    color: #444;
    margin-top: 10px;
    line-height:20px;
}
.amp-category span:nth-child(1) {
    display: none;
}
.amp-category span a, .amp-category span{
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
}
.amp-category span:after{
    content:"/";
    display:inline-block;
    margin:0px 5px 0px 5px;
    position:relative;
    top:1px;
    color:rgba(0, 0, 0, 0.25);
}
.amp-category span:last-child:after{
    display:none;
}
.sp{
    width:100%;
    margin-top:20px;
}
.amp-post-title{
    font-size:48px;
    line-height:58px;
    color: #333;
    margin:0;
    padding-top:15px;
}
.sf-img {
    width: 100%;
    display: inline-block;
    height: auto;
    margin-top: 33px;
}
.sf-img figure{
    margin:0;
}
.sf-img .wp-caption-text{
    width: 1100px;
    text-align: left;
    margin: 0 auto;
    color: #a1a1a1;
    font-size: 14px;
    line-height:20px;
    font-weight: 500;
    border-bottom: 1px solid #ccc;
    padding: 15px 0px;
}
.sf-img .wp-caption-text:before{
    content:"\e412";
    font-family: 'icomoon';
    position: relative;
    top: 4px;
    opacity: 0.4;
    font-size:24px;
    margin-right: 5px;
}
.sp-cnt{
    margin-top: 40px;
    clear: both;
    width: 100%;
    display: inline-block; 
}
.sp-rl{
    display:inline-flex;
    width:100%;
}
.sp-lt{
    display: flex;
    flex-direction: column;
    flex: 1 0 20%;
    order: 0;
}
.sp-rt{
    width: 72%;
    margin-left: 60px;
    flex-direction: column;
    justify-content: space-around;
    order: 1;
}
.ss-icons, .sp-athr, .amp-tags, .post-date{
    padding-bottom:20px;
    border-bottom:1px dotted #ccc;
}
.shr-txt, .athr-tx, .amp-tags > span:nth-child(1), .amp-related-posts-title, .related-title, .r-pf h3{
    margin-bottom: 12px;
}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{
    display: block;
}
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    font-weight: 400;
}
.loop-date, .post-edit-link{
    display:inline-block;
}
.post-date .post-edit-link{
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    float: right;
}
.sp-athr, .amp-tags, .post-date, .srp{
    margin-top:20px;
}
.sp-athr .author-details a, .sp-athr .author-details, .amp-tags span a, .amp-tag {
    font-size: 15px;
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    font-weight: 400;
    line-height: 1.5;
}
.amp-tags .amp-tag:after{
    content: "/";
    display: inline-block;
    padding: 0px 10px;
    position: relative;
    top: -1px;
    color: #ccc;
    font-size: 12px;
}
.amp-tags .amp-tag:last-child:after{
    display:none;
}
.ss-icons .icon-twitter :before{
    color:#1da1f2;
}
.ss-icons ul{
    text-align:left;
}
.ss-icons li{
    margin: 0px 10px 10px 0px;
}
.ss-icons li:before{
    border-radius: 2px;
    text-align:center;
    padding: 4px 6px;
}

.swift-sticky-social{ width: 100%; bottom: 0; display: block; left: 0; box-shadow: 0px 4px 7px #000; background: #fff; position: fixed; margin: 0; z-index: 10; text-align: center; }
.cntn-wrp{
    font-size:18px;
    color:#000;
        line-height:1.7;
}
.cntn-wrp p{
    margin:0px 0px 30px 0px;
}
.sp-rt p strong, .pg p strong{
    font-weight: 700;
}
.rlp-cnt .related_link p, .rlp-cnt .amp-author{
    display:none;
}
.srp .amp-related-posts amp-img{
    float: left;
    width: 100%;
    margin: 0px;
    height:100%;
}
.srp ul li{
    display: inline-block;
    line-height: 1.3;
    margin-bottom: 24px;
    list-style-type:none;
    width:100%;
}
.srp ul li:last-child{
    margin-bottom:0px;
}
.has_thumbnail:hover {
    opacity:0.7;
}
.has_thumbnail:hover .related_link a{
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
}
.srp .related_link{
    margin-top:10px;
}
.srp .related_link a{
    color:#333;
}
.amp-related-posts ul{
    list-style-type:none;
}
.r-pf{
    margin-top: 40px;
    display: inline-block;
    width: 100%;
}
.r-pf .loop-wrapper{
    margin-top:0;
}
<?php if( 1 == $redux_builder_amp['ampforwp-inline-related-posts'] && is_single() ){ ?>
/** In content releated post desing styles **/
.related_posts .has_related_thumbnail{
    display: inline-flex;
    width: 29%;
    flex-direction: column;
    margin:0px 30px 30px 0px;
    justify-content: space-evenly;
}
.related_link a{
    color: #000;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 400;
    margin-top: 7px;
    display: inline-block;
}
.related_link p{
    font-size: 12px;
    margin: 0;
    padding-top: 10px;
}
<?php } ?>
<?php if( 1 == $redux_builder_amp['amp-author-description'] ) {?>
.sp-rt .amp-author {
    padding: 20px 20px;
    border-radius: 0;
    background: #f9f9f9;
    border: 1px solid #ececec;
    display: inline-block;
    width: 100%;
}
.sp-rt .amp-author .amp-author-image{
    float:left;
}
.sp-rt .amp-author .author-details a{
    color: #222;
    font-size: 14px;
    font-weight: 500;
}
.sp-rt .author-details a:hover{
    color:#005be2;
    text-decoration:underline;
}
.amp-author-image amp-img{border-radius: 50%;margin: 0px 12px 5px 0px;display: block; width:50px;}

.author-details p{
    margin: 0;
    font-size: 13px;
    line-height: 20px;
    color: #666;
    padding-top: 4px;
}
<?php } ?>
<?php if( 1 == $redux_builder_amp['ampforwp-bread-crumb'] ) {?>
/** Breadcrumbs **/
.breadcrumb{
    width: 100%;
    display: inline-block;
    padding-bottom: 8px;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
}
.breadcrumb ul li{
    display: inline-block;
    list-style-type: none;
    font-size: 10px;
    text-transform: uppercase;
    margin-right: 5px;
}
.breadcrumb ul li a{
    color: #999;
    letter-spacing: 1px;
}
.breadcrumb ul li a:hover{
    color:#005be2;
}
.item-home:after{
   content: "\e315";
    display: inline-block;
    color: #bdbdbd;
    font-family: 'icomoon';
    padding-left: 5px;
    font-size: 12px;
    position: relative;
    top: 1px;
}
<?php } ?>
/** Pagination**/
#pagination{
    margin-top: 30px;
    border-top: 1px dotted #ccc;
    padding: 20px 5px 0px 5px;;
    font-size: 16px;
    line-height: 24px;
    font-weight:400;
}
.next{
    float: right;
    width: 45%;
    text-align:right;
    position:relative;
    margin-top:10px;
}
.next a, .prev a{
    color:#333;
}
.prev{
    float: left;
    width: 45%;
    position:relative;
    margin-top:10px;
}
.prev span{
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    display: block;
    position: absolute;
    top: -26px;
}
.next span{
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    display: block;
    font-weight: 400;
    position: absolute;
    top: -26px;
    right:0
}
.next:hover a, .prev:hover a{
    color:#005be2;
}
.prev:after{
    border-left:1px dotted #ccc;
    content: "";
    height: calc(100% - -10px);
    right: -50px;
    position: absolute;
    top: 50%;
    transform: translate(0px, -50%);
    width: 2px;
}
/** Post Pagination **/
.ampforwp_post_pagination{
    width:100%;
    text-align:center;
    display:inline-block;
}
.ampforwp_post_pagination p{
   margin: 0;
    font-size: 18px;
    color: #444;
    font-weight: 500;
    margin-bottom:10px;
}
.ampforwp_post_pagination p a{
    color:#005be2;
    padding:0px 10px;
}
/**** 
* Comments
*****/
.cmts{
    width:100%;
    display:inline-block;
    clear:both;
    margin-top:40px;
}
.amp-comment-button{
    background-color: #005be2;
    font-size: 15px;
    font-family: 'Open Sans',sans-serif;
    float: none;
    width: 100%;
    margin: 0 auto;
    text-align: center;
    border-radius: 3px;
    font-weight: 600;
    width:250px;
}
.form-submit #submit{
    background-color: #005be2;
    font-size: 14px;
    text-align: center;
    border-radius: 3px;
    font-weight: 500;
    color: #fff;
    cursor: pointer;
    margin: 0;
    border: 0;
    padding: 11px 21px;
}
#respond p {
    margin: 12px 0;
}
.amp-comment-button a{
    color: #fff;
    display: block;
    padding: 7px 0px 8px 0px;
}
.comment-form-comment #comment {
    border-color: #ccc;
    width: 100%;
    padding: 20px;
}
.cmts h3{
    margin: 0;
    font-size: 12px;
    padding-bottom: 6px;
    border-bottom: 1px solid #eee;
    font-weight: 400;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #444;
}
.cmts h3:after{
    content: "";
    display: block;
    width: 115px;
    border-bottom: 1px solid #005be2;
    position: relative;
    top: 7px;
}
.cmts ul{
    margin-top:16px;
}
.cmts ul li{
    list-style: none;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}
.cmts .amp-comments-wrapper ul .children{
    margin-left:30px;
}
.cmts .comment-author.vcard .says{
    display:none;
}
.cmts  .comment-author.vcard .fn{
    font-size: 12px;
    font-weight: 500;
    color: #333;
}
.cmts .comment-metadata{
    font-size: 11px;
    margin-top: 8px;
}
.amp-comments-wrapper ul li:hover .comment-meta .comment-metadata a{
    color:#005be2;
}
.cmts .comment-metadata a{
    color: #999;
}
.comment-content{
    margin-top:6px;
    width:100%;
    display:inline-block;
}
.comment-content p{
    font-size: 14px;
    color: #333;
    line-height: 22px;
    font-weight: 400;
    margin: 0;
}
.comment-meta amp-img{
    float:left;
    margin-right:10px;
    border-radius:50%;
}
.sp-rt .amp-author {
    margin-top: 5px;
}
.cntn-wrp a{
    margin:10px 0px;
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    display:inline-block;
}
@media(max-width:1110px){
.sp-rt {
    margin-left: 30px;
}
}
@media(max-width:768px){
.tl-exc {
    font-size: 14px;
    margin-top: 3px;
    line-height: 22px;
}
.sp-rl {
    display: inline-block;
    width: 100%;
}
.srp .related_link{
    font-size:20px;
    line-height:1.4;
    font-weight:600;
}
.sp-lt {
    width: 100%;
    margin-top: 20px;
}
.sp-cnt{
    margin-top: 15px;
}
.rlp-image{
    width:200px;
    float:left;
    margin-right:15px;
    display: flex;
    flex-direction: column;
}
.rlp-cnt{
    display: flex;
}
.r-pf h3{
    margin-bottom:0;
    padding-top:20px;
   border-top:1px dotted #ccc; 
}
.r-pf {
   margin-top:20px;
}
.cmts{
    margin:20px 0px 20px 0px;
}
.sp-rt {
    width: 100%;
    margin-left: 0;
}
.sp-rt .amp-author {
    padding: 20px 15px;
}
#pagination {
    margin: 20px 0px 20px 0px;
    border-top: none;
}
.amp-post-title{
    padding-top:10px;
}
}
@media(max-width:767px){
/** Sticky **/
.swift-sticky-social .amp-social{
    width:100%;
}
.swift-sticky-social .amp-social ul{
    display:inline-flex;
    width:100%;
}
.swift-sticky-social .amp-social ul a {
    display: flex;
    flex-direction: column;
    flex: 1 0 100%;
    width: auto;
    flex-basis: 0;
    -webkit-box-flex: 1;
}
}
@media(max-width:480px){
.cntn-wrp p{
    line-height:1.65;
}
.related_posts .has_related_thumbnail {
    width: 100%;
}
.rlp-image {
    width: 100%;
    float: none;
    margin-right: 0px;
}
.rlp-cnt {
    width: 100%;
    float: none;
}
.amp-post-title {
    font-size: 32px;
    line-height: 44px;
}
.amp-category span a {
    font-size: 12px;
}
.sf-img{
    margin-top:20px;
}
.sp{
    margin-top: 20px;
}
.menu-btn a{
    padding:10px 20px;
    font-size:14px;
}
.next, .prev{
    float: none;
    width: 100%;
}
#pagination {
    padding: 10px 0px 0px;
}
#respond {
    margin: 0;
}
.next a {
    margin-bottom: 45px;
    display:inline-block;
}
.prev:after{
    display:none;
}
.author-details p {
    font-size: 12px;
    line-height: 18px;
}
.sf-img .wp-caption-text{
    width:100%;
    padding:10px 15px;
}
}
@media(max-width:425px){
.sp-rt .amp-author {
    margin-bottom: 10px;
}
#pagination {
    margin: 20px 0px 10px 0px;
}
}
@media(max-width:320px){
.cntn-wrp p {
    font-size: 16px;
}  
}
<?php } } ?>
/*** Footer ***/
<?php if($redux_builder_amp['footer-type'] == '1'){?>
.footer{
    font-size: 12px;
    margin-top: 80px;
}
.f-menu ul li .sub-menu{
    display:none;
}
<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
.footer{
    margin-top: 0px;
}
<?php } ?>
.f-menu ul li{
    display:inline-block;
    margin-right:20px;
}
.f-menu ul li a {
    padding:0;
    font-size:14px;
    color:#7a7a7a;
}
.f-menu ul > li:hover a{
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
}
.f-menu{
    margin-bottom:30px;
}
.rr{
    font-size: 12px;
    color: #333;
}
.f-menu ul li.menu-item-has-children:hover > ul{
    display:none;
}
.f-menu ul li.menu-item-has-children:after{
    display:none;
}
<?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
.f-w-f1{
  padding:70px 0px; 
  width:100%; 
  border-top: 1px solid #eee;
}
<?php endif; ?>
.f-w{
    display: inline-flex;
    width: 100%;
}
.f-w-f2{
    text-align: center;
    border-top: 1px solid #eee;
    padding:50px 0px;
}
.w-bl{
    margin-left: 0;
    display: flex;
    flex-direction: column;
    position: relative;
    -webkit-box-flex: 1;
    flex: 1 0 22%;
    margin:0 15px;
}
.w-bl h4{
    color: #999;
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding-bottom: 4px;
}
.w-bl ul li{
    list-style-type: none;
    font-size: 14px;
    line-height:1.5;
    margin-bottom: 15px;
}
.w-bl ul li:last-child{
    margin-bottom:0;
}
.w-bl ul li a{
    text-decoration: none;
}
@media(max-width:768px){
.footer {
    margin-top: 60px;
}
.w-bl{
    flex:1 0 22%;
}
.f-menu ul li {
    margin-bottom:10px;
}
}
@media(max-width:480px){
.footer {
    margin-top: 50px;
}
<?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
.f-w-f1 {
    padding: 45px 0px 10px 0px;
}
<?php endif; ?>
.f-w-f2 {
    padding: 25px 0px;
}
.f-w{
    display:block;
}
.w-bl{
    margin-bottom:40px;
}
.w-bl ul li {
    margin-bottom: 11px;
}
.f-menu ul li {
    display: inline-block;
    line-height: 1.8;
    margin-right: 13px;
}
.f-menu .amp-menu > li a {
    padding: 0;
    font-size: 12px;
    color: #7a7a7a;
}
.rr {
    margin-top: 15px;
    font-size: 11px;
}
}
@media(max-width:425px){
.footer {
    margin-top: 35px;
}
<?php if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : ?>
.f-w-f1 {
    padding: 35px 0px 10px 0px;
}
<?php endif; ?>
.w-bl h4 {
    margin-bottom: 15px;
}
}
<?php } ?>
<?php if(is_single()){ ?>
/** Sticky Social Icons **/
.swift-sticky-social{
    background:#f1f1f1;
    display:inline-block;
    width:100%;
    line-height:0;
}
.rr {
    margin-bottom: 30px;
    display: inline-block;
}
.swift-sticky-social .amp-social ul a li{
    display:block;
    list-style-type:none;
}
.swift-sticky-social .amp-social ul a li:before{
    width:100%;
    display:inline-block;
    padding:10px 0px;
}
.swift-sticky-social .amp-social ul a{
    color:#fff;
    float:left;
    font-size:20px; 
    width:153px;
}
<?php } ?>
/*** Transitions ***/
.content-wrapper a, .breadcrumb ul li a, .srp ul li{
    transition: all 0.3s ease-in-out 0s;
  -webkit-transition: all 0.3s ease-in-out 0s;
}
/*** Responsive ***/
@media(max-width:1110px){
.cntr{
    width:100%;
    padding:0px 40px;
}
.amppb-fluid .col{max-width:95%}
.sf-img .wp-caption-text{
    width:100%;
    padding:10px 40px;
}
.fbp-img{
    width:62%;
}
.fbp-img amp-img img{
    width:100%;
}
.fbp-cnt h2 {
    font-size: 28px;
    line-height: 34px;
}
}
@media(max-width:980px){

}
@media(max-width:768px){
.fbp-img {
    width: 100%;
    float:none;
}
.hmp{
    margin:0;
}
.fbp-cnt {
    float: none;
    width: 100%;
    margin-left: 0px;
    margin-top:10px;
    display:inline-block;
}
.fbp-cnt .loop-category{
    margin-bottom:5px;
}
.fbp{
    margin: 15px 15px 15px 15px;
}
.fbp-cnt p{
    margin-top:8px;
}
.fsp{
    flex-basis: calc(100% - 30px);
    padding: 5px 0px 0px;
}
.fsp-img{
    width:40%;
    float:left;
    margin-right:20px;
}
.fsp-cnt{
    width:54%;
    float:left;
    margin-top:0;
    position:relative;
    top:-5px;
}
.fsp h2{
    margin: 0px 0px 7px 0px;
}
.fsp-cnt .loop-category {
    margin-bottom: 8px;
}
.at-dt{
    margin: 10px 0px 0px 0px;
}
.hmp .loop-wrapper {
    margin-top: 10px;
}
.arch-tlt{
    margin:20px 0px;
}
.amp-loop-label {
    font-size: 16px;
}
}
@media(max-width:480px){
.cntr{
    width: 100%;
    padding: 0px 20px;
}
.hmp .loop-wrapper {
    margin-top: 0;
}
.cntr.b-w{
    padding:0 12px;
}
.at-dt {
    margin: 7px 0px 0px 0px;
}
.right, .left{
    float:none;
    text-align:center;
}
.right{
    margin-bottom:30px;
}
.fsp-img{
    width:100%;
    float:none;
    margin-right:0px;
}
.fsp-cnt{
    width:100%;
    float:none;
    margin-top:15px;
}
.fsp{
    border:none; 
    padding:0;
}
.h-sing {
    font-size: 13px;
}

}
@media(max-width:425px){
header .cntr, .footer .cntr, .sp .cntr{
    padding:0 20px;
}
.cntr.b-w, .cntr{
    padding: 0 0;
}
.fbp-cnt{
    margin:0;
    padding:12px;
}
.fbp {
    margin: 0px 15px 15px 15px;
}
.fsp{
    margin:15px;
}
.fsp-cnt {
    padding: 0px 15px 0px 14px;
}
.amp-archive-title, .amp-loop-label{
    padding:0 20px;
}
.amp-sub-archives {
    margin: 10px 0px 0px 30px;
}
.author-img {
    padding-left: 20px;
}
.amp-archive-desc{
    padding:0px 20px;
}
.loop-pagination {
    margin-top: 15px;
}
.fbp-cnt h2, .fsp h2 {
    font-size: 24px;
    line-height: 30px;
    font-weight:600;
}
}
@media(max-width:375px){
.fbp-cnt p, .fsp-cnt p{
    line-height: 19px;
    letter-spacing: 0;
}
}
@media(max-width:320px){
.right a, .left a {
    padding: 10px 30px 14px;
}
}

/**** Font-Icons ****/

[class^="icon-"], [class*=" icon-"] {
  font-family: 'icomoon';
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;

  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/*** ADS CODE ***/
.amp-ad-wrapper{
    width:100%;
    text-align:center;
}
<?php if( isset($redux_builder_amp['enable-amp-ads-1'] ) && $redux_builder_amp['enable-amp-ads-1'] ) { ?>
.amp-ad-1{
   margin: -2px 0px -17px 0px;
}
<?php } 
if( isset($redux_builder_amp['enable-amp-ads-2'] ) && $redux_builder_amp['enable-amp-ads-2'] ) { ?>
.amp-ad-2{
   margin: 20px 0px -23px 0px; 
}
<?php } 
if( isset($redux_builder_amp['enable-amp-ads-3'] ) && $redux_builder_amp['enable-amp-ads-3'] ) { ?>
.amp-ad-3{
    margin: 0px 0px -4px 0px;
}
<?php }
if( isset($redux_builder_amp['enable-amp-ads-4'] ) && $redux_builder_amp['enable-amp-ads-4'] ) { ?>
.amp-ad-4{
    margin: 20px 0px 20px 0px;
}
<?php }
if( isset($redux_builder_amp['enable-amp-ads-5'] ) && $redux_builder_amp['enable-amp-ads-5'] ) { ?>
.amp-ad-5{
    margin: 10px 0px -17px 0px;
}
<?php }
if( isset($redux_builder_amp['enable-amp-ads-6'] ) && $redux_builder_amp['enable-amp-ads-6'] ) { ?>
.amp-ad-6{
    margin: 0px 0px 20px 0px;
}
<?php } ?>
/*** Notification styles ***/
#amp-user-notification1{
    padding: 5px;
    text-align: center;
    background: #fff;
    border-top: 1px solid #005be2;
}
#amp-user-notification1 p {
    display: inline-block;
    margin: 20px 0px;
}
amp-user-notification button {
    padding: 8px 10px;
    background: #005be2;
    color: #fff;
    margin-left: 5px;
    border: 0;
}
/***
/****
* RTL Styles
*****/
<?php  if( true == $redux_builder_amp['amp-rtl-select-option'] ) {?> 
/*** Header ***/
.body{
    direction:rtl;
}
.h-1 {
    order: -1;
}
.h-nav{
    order: 1;
}
.h-2 {
    order: -2;
}
.h-3 {
    order: -2;
    justify-content: flex-start;
}
.h-3 .h-srch{
    margin-left:0;
}
.h-3 .h-nav {
    order: -1;
    margin: 0px 10px 0px 0;
}
.fbp-img {
    float: right;
}
.fbp-cnt {
    margin-right: 30px;
    margin-left:0
}
.fbp-cnt, .fsp-cnt{
    text-align:right;
}
.right a, .left a{
    direction:rtl;
}
.right a:after{
    padding:0px 6px 0px 0px;
    top:-1px;
}
.left a:before{
    padding:0px 0px 0px 6px;
    top:1px;
}
.w-bl{
    direction:rtl;
}
.loop-wrapper{
    direction:rtl;
}
/** Single Page **/
.breadcrumb, .amp-category{
   direction:rtl;
}
.item-home:after {
    padding-right: 5px;
}
.amp-post-title{
    text-align: right;
}
.post-date .post-edit-link {
    float: left;
}
.sp-rt{
    order: 0;
    direction: rtl;
    margin-right: 50px;
    margin-left:0;
}
.sp-rt .amp-author .amp-author-image {
    float: right;
}
.amp-author-image amp-img {
    margin: 0px 0px 5px 12px;
}
.prev {
    float: right;
}
.next {
    float: left;
}
.r-pf{
    direction:rtl;
}
.prev:after {
    left: -25px;
    right:auto;
}
.f-menu, .p-menu{
    direction:rtl;
}
.sp-lt {
    direction: rtl;
}
.comment-meta amp-img {
    float: right;
    margin-left: 10px;
}
/*** Archive ***/
.archive .author-img {
    float: right;
}
.archive  .author-img amp-img {
    margin: 0px 0px 10px 12px;
}
.amp-archive-title, .amp-archive-desc{
    text-align:right;
}
/** Responsive **/
@media(max-width:1024px){
.fbp-img{
    float:right;
}
.fbp-cnt{
    width:33%;
}
}
@media(max-width:768px){
.fbp-cnt {
    width:100%;
    float:none;
    margin-right:0;
}
.fsp-img {
    float: right;
    margin-right: 0;
    margin-left:20px;
}
.rlp-image {
   float: right;
    margin-left: 15px;
    margin-right: 0;
}
}
@media(max-width:480px){
.fbp-cnt{
    width:100%;
    margin-right:0;
}
.next a {
    text-align: left;
}
.next span{
    right:auto;
    left:0;
}
.post-date .post-edit-link {
    float: left;
}
.fsp-cnt{
    width:100%;
    float:none;
    display:inline-block;
}

}
<?php } ?>

/*** Extra CSS for New designs ***/
<?php if($redux_builder_amp['menu-type'] == '2'){?>
amp-sidebar, .lb-t {
<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>
    background: <?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;
 <?php } ?>
}
amp-sidebar {
    width: 100%;
    box-sizing: content-box;
    -webkit-box-sizing:  content-box;
    padding-left: 10%;
    padding-right: 10%;
    margin-top:77px;
}
/* AMP Sidebar Toggle button */
.amp-sidebar-button{
    position:relative;
}
.amp-sidebar-toggle span  {
    display: block;
    height: 2px;
    margin-bottom: 5px;
    width: 22px;
    <?php 
    if($redux_builder_amp['swift-element-color-control']['rgba']){ ?>
        background: <?php echo $redux_builder_amp['swift-element-color-control']['rgba']?>;
    <?php } ?>
}
.amp-sidebar-toggle span:last-child{
    margin-bottom:0;
}
.amp-sidebar-toggle span:nth-child(2){
    top: 7px;
}
.amp-sidebar-toggle span:nth-child(3){
    top:14px;
}
/* AMP Sidebar close button */
.amp-sidebar-close{
    position: absolute;
    right: -3px;
    top: 10px;
    color: transparent;
}
/***** AMP Navigation Menu with Dropdown Support *****/
.toggle-navigation ul{
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: inline-block;
    width: 100%
}
.toggle-navigation ul li{
    font-size: 13px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.11);
    padding: 11px 0px;
    width: 25%;
    float: left;
    text-align: center;
    margin-top: 6px
}
.toggle-navigation ul ul{
    display: none
}
.toggle-navigation ul li a{
    color: #eee;
    padding: 15px;
}
.toggle-navigation{
    display: none;
    background: #444;
}
/***** Header *****/
header{
    position:fixed;
    z-index:9999;
    top:0px;
}
.header, .header-2, .header-3{
    width:100%;
    display:inline-block;
    <?php if($redux_builder_amp['swift-background-scheme']['rgba']){?>
    background: <?php echo $redux_builder_amp['swift-background-scheme'] ['rgba'] ?>;
     <?php }?>
    <?php if($redux_builder_amp['swift-border-line-control']){?>
        border-bottom: <?php echo $redux_builder_amp['swift-border-line-control'] ?>px solid;
    <?php } ?>
    <?php if($redux_builder_amp['swift-border-color-control']['rgba']){?>
        border-color:<?php echo $redux_builder_amp['swift-border-color-control'] ['rgba'] ?>;
    <?php } ?>
    <?php if($redux_builder_amp['swift-boxshadow-checkbox-control']){?>
        box-shadow:0px 0px 2px 2px #ccc;
    <?php }?>
    <?php if($redux_builder_amp['swift-padding-control']){?>
         padding: <?php echo $redux_builder_amp['swift-padding-control']['padding-top'] .' '. 
                             $redux_builder_amp['swift-padding-control']['padding-right'] .' '. 
                             $redux_builder_amp['swift-padding-control']['padding-bottom']  .' '. 
                             $redux_builder_amp['swift-padding-control']['padding-left'] ; ?>;
    <?php } ?>

    <?php if($redux_builder_amp['swift-margin-control']){?>
        margin: <?php echo  $redux_builder_amp['swift-margin-control']['margin-top'] .' '. 
                            $redux_builder_amp['swift-margin-control']['margin-right'] .' '. 
                            $redux_builder_amp['swift-margin-control']['margin-bottom']  .' '. 
                            $redux_builder_amp['swift-margin-control']['margin-left'] ; ?>;
    <?php } ?>
}
.head, .head-2, .head-3{
    width:100%;
    clear:both;
    display: inline-flex;
    <?php if($redux_builder_amp['swift-height-control']){?>
        height:<?php echo $redux_builder_amp['swift-height-control']?>;
    <?php } ?>
}
.h-ic a:after, .h-ic a:before{
    <?php if($redux_builder_amp['swift-element-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-color-control']['rgba']?>;
    <?php } ?>
    font-family: 'icomoon';
    font-size: 23px;
}
.h-ic{
    align-self: center;
}
.h-1{
    display:flex;
    order:1;
}
.h-2{
    order: 1;
    justify-content: flex-end;
    display: flex;
}
.h-call a:after{
    content: "\e0cd";
    align-self: center;
}
.h-shop a:after{
     align-self: center;
}
.h-nav{
    order: -1;
    align-self: center;
}
.h-3 .h-nav{
    order:0;
    margin:0px 0px 0px 10px;
}
.logo{
    z-index: 2;
    flex-grow: 1;
    align-self: center;
    text-align:center;
}
.h-3{
    order: 1;
    display: inline-flex;
    flex-grow: 1;
    justify-content: flex-end;
}
.h-3 .h-srch a:after{
    position:relative;
    left:5px;
} 
.h-ic{
    margin:0px 10px;
}
.h-ic:first-child{
    margin-left:0;
}
.h-ic:last-child{
    margin-right:0;
}
.head-3 .h-logo{
    order:-1;
    align-self: center;
    z-index:2;
}
.amp-logo a{
    line-height:0;
   display:inline-block;
    color:#000;
}
.logo h1{
   margin: 0;
    font-size: 17px;
    font-weight: 700;
    text-transform: uppercase;
    display:inline-block;
}
.h-srch a{
    line-height:1;
    display:block;
}
<?php
$logoStyle = "max-width:190px;width:". ampforwp_default_logo('width')."px;";
if( isset($redux_builder_amp['ampforwp-custom-logo-dimensions-options']) && 
    $redux_builder_amp['ampforwp-custom-logo-dimensions-options']=='flexible' && 
    $redux_builder_amp['ampforwp-custom-logo-dimensions-slider']){

   $logoStyle = "max-width: ".$redux_builder_amp['ampforwp-custom-logo-dimensions-slider']."%;
width:". ampforwp_default_logo('width')."px;";
}
?>
.amp-logo amp-img{ <?php echo $logoStyle; ?>margin: 0 auto;}

.amp-sidebar-close:after{
    content: "\e5cd";
    font-family: 'icomoon';
    font-size: 30px;
   <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?>
    text-indent: 1px;
    cursor: pointer;
    padding: 12px 16px;
}
.amp-menu > li a{
    <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?> 
    padding: 13px 7px;
    margin-bottom:0;
}
.menu-btn{
    margin-top:30px;
    text-align:center;
}
.menu-btn a{
    color:#fff;
    border:2px solid #ccc;
    padding:15px 30px;
    display:inline-block;
}
/*** Light Box ***/
.lb-t{
    position: fixed;
    top: -50px;
    width: 100%;
    width: 100%;
    opacity: 0;
    -webkit-transition: opacity .5s ease-in-out;
    transition: opacity .5s ease-in-out;
    overflow: hidden;
    z-index:9;
}
.lb-t img {
    margin: auto;
    position: absolute;
    top: 0;
    left:0;
    right:0;
    bottom: 0;
    max-height: 0%;
    max-width: 0%;
    border: 3px solid white;
    box-shadow: 0px 0px 8px rgba(0,0,0,.3);
    box-sizing: border-box;
    -webkit-transition: .5s ease-in-out;
    transition: .5s ease-in-out;
}
a.lb-x {
    display: block;
    width:50px;
    height:50px;
    box-sizing: border-box;
    background: tranparent;
    color: black;
    text-decoration: none;
    position: absolute;
    top: -80px;
    right: 0;
    -webkit-transition: .5s ease-in-out;
    transition: .5s ease-in-out;
}
a.lb-x:after {
    content: "\e5cd";
    font-family: 'icomoon';
    font-size: 30px;
    <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?> 
    line-height: 0;
    display: block;
    text-indent: 1px;
}
.lb-t:target {
    opacity: 1;
    top: 0;
    bottom: 0;
    left:0;
    z-index:1;
}
.lb-t:target img {
    max-height: 100%;
    max-width: 100%;
}
.lb-t:target a.lb-x {
    top: 25px;
}
.lb img{
    cursor:pointer;
}
.lb-btn form{
    position: absolute;
    top: 200px;
    left: 0;
    right: 0;
    margin: 0 auto;
    text-align: center;
}
.lb-btn form #s{
    padding:10px;
}
.lb-btn form #amp-search-submit{
    padding:10px;
    cursor:pointer;
}
.amp-search-wrapper{
    width: 80%;
    margin: 0 auto;
    position: relative;
}
.overlay-search:before {
    content: "\e8b6";
    position: absolute;
    right:0;
    font-size: 24px;
    font-family: 'icomoon';
    cursor: pointer;
    <?php if($redux_builder_amp['swift-element-overlay-color-control']['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php }  ?>
    top:4px;
}
.lb-btn form #amp-search-submit {
    cursor: pointer;
    background:transparent;
    border: none;
    display: inline-block;
    width: 30px;
    height: 30px;
    opacity: 0;
    position: absolute;
    z-index:100;
    right: 0;
    top: 0;
}
.lb-btn form #s {
    padding: 10px;
    background: transparent;
    border: none;
    border-bottom: 1px solid #504c4c;
    color: #fff;
    width:100%;
}
/*** Header - Styles ***/
.head-2 .h-logo{
    order:-1;
    align-self: center;
   flex-grow:1;
   text-align:center;
}
.amp-logo{
    line-height:0;
}
.h-sing{
    font-size: 18px;
    font-weight: 600;
    align-self: center;
}
.h-sing a{
    <?php if($redux_builder_amp['signin-button-border-line']){?>
        border: <?php echo $redux_builder_amp['signin-button-border-line']?>px solid;
    <?php } ?>
    <?php if($redux_builder_amp['signin-button-border-color']['rgba']){?>
        border-color: <?php echo $redux_builder_amp['signin-button-border-color']['rgba']?>;
    <?php } ?>
    padding:9px 15px;
    <?php if($redux_builder_amp['signin-button-text-color']['rgba']){?>
        color: <?php echo $redux_builder_amp['signin-button-text-color']['rgba']?>;
    <?php } ?>
    display: inline-block;
    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px transparent;
    position: relative;
    -webkit-transition-property: color;
    transition-property: color;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
}
 <?php if($redux_builder_amp['border-type'] == '2'){?>
.h-sing a{
    border-radius:100px;
}
.h-sing a:before{
    border-radius:100px;
}
<?php } ?>
 <?php if($redux_builder_amp['border-type'] == '3'){?>
<?php if($redux_builder_amp['border-radius'] ){ ?>
.h-sing a{
    border-radius:<?php echo $redux_builder_amp['border-radius']?>px;
}
.h-sing a:before{
    border-radius:<?php echo $redux_builder_amp['border-radius']?>px;
}
<?php } ?>
<?php } ?>
.h-sing a:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #005be2;
    -webkit-transform: scaleX(0);
    transform: scaleX(0);
    -webkit-transform-origin: 0 50%;
    transform-origin: 0 50%;
    -webkit-transition-property: transform;
    transition-property: transform;
    -webkit-transition-duration: 0.3s;
    transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out;
}
.h-sing a:hover, .h-sing a:focus, .h-sing a:active {
    color: #fff;
}
.h-sing a:hover:before, .h-sing a:focus:before, .h-sing a:active:before {
    -webkit-transform: scaleX(1);
    transform: scaleX(1);
}
.m-menu li.menu-item-has-children ul {
    display: block;
}
.m-menu ul li.menu-item-has-children:after{
    display:none;
}
.m-menu .menu-item-has-children > a{
    font-size:18px;
    position:relative;
    display:inline-block;
    font-weight:600;
    margin-bottom:15px;
    font-style: italic;
    letter-spacing:1px;
    padding: 6px 0;
    text-transform: uppercase;
}
.m-menu .menu-item-has-children{
    margin-bottom: 50px;
    width: 33%;
    display:inline-block;
}
.m-menu .menu-item-has-children > a:after {
    position: absolute;
    background-color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    content: "";
    height: 3px;
    width: 100%;
    bottom: 0px;
    left: 0;
    opacity: 1;
}
.m-menu .sub-menu li a{
    font-size: 15px;
    padding:8px 0px;
    letter-spacing: 0.4px;
    -webkit-transition: all 0.2s;
    transition: all 0.2s;
    -webkit-transition-property: padding-left, color;
    transition-property: padding-left, color;
}
.m-menu .sub-menu li a:hover {
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    padding-left: 12px;
}
.m-menu .amp-menu li.menu-item-has-children>ul>li {
    padding-left: 0px;
}
.m-menu{
    list-style-type: none;
    margin: 45px 0 0 0;
    padding: 0;
    display:inline-block;
    width:100%;
}
.m-menu .amp-menu li:hover a {background: transparent none repeat scroll 0 0;}
.m-menu .amp-menu li:hover li:hover>a{background:transparent;}
.m-menu .amp-menu{
    margin-bottom:20%;
}
/*** Primary Menu ***/
.content-wrapper{
    <?php if($redux_builder_amp['swift-height-control']){?>
    margin-top:<?php echo $redux_builder_amp['swift-height-control']?>;
    <?php } ?>
}
.p-m-fl{
    width:100%;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    <?php if($redux_builder_amp['primary-menu-background-scheme']['rgba']){?>
        background:<?php echo $redux_builder_amp['primary-menu-background-scheme']['rgba']; ?>
    <?php } ?>
}
.p-menu{
    width:100%;
    text-align:center;
    margin: 0px auto;
    max-width: 1100px;
    overflow-x: scroll;
    overflow-y:hidden;
    white-space: nowrap;
    <?php if($redux_builder_amp['primary-menu-padding-control']){?>
         padding: <?php echo $redux_builder_amp['primary-menu-padding-control']['padding-top'] .' '. 
                             $redux_builder_amp['primary-menu-padding-control']['padding-right'] .' '. 
                             $redux_builder_amp['primary-menu-padding-control']['padding-bottom']  .' '. 
                             $redux_builder_amp['primary-menu-padding-control']['padding-left'] ; ?>;
    <?php } ?>
}
::-webkit-scrollbar {
display: none;
}
.p-menu ul li{
    display: inline-block;
    margin-right: 21px;
    font-size: 12px;
    line-height: 20px;
    letter-spacing: 1px;
    font-weight: 400;
}
.p-menu ul li a{
    padding:0;
    <?php if($redux_builder_amp['primary-menu-text-scheme']['rgba']){?>
    color:<?php echo $redux_builder_amp['primary-menu-text-scheme']['rgba']?>;
    <?php } ?>
    text-transform:uppercase;
}
.p-menu .amp-menu li.menu-item-has-children:hover > ul{
    display:none;
    font-size:13px;
}
.p-menu .amp-menu li.menu-item-has-children:after{
    display:none;
}
/*** Responsive ***/
@media(max-width:768px){
.m-menu .menu-item-has-children{
    width: 100%;
    float: none;
    display:inline-block;
}
.sub-menu li{
    float:left;
    width:50%;
}
}
<?php } ?>

/** Footer **/
<?php if($redux_builder_amp['footer-type'] == '2'){?>
.ftr{
    background:#000;
    padding:10px 0px;
    margin-top:40px;
}
.f-t-2{
    width:100%;
    display:inline-block;
    padding:30px 0px;
}
.f-lg{
    display: inline-block;
    vertical-align: middle;
    margin-right:8%;
    width:17%;
}
.f-mnu{
    width: 50%;
    display: inline-block;
    vertical-align: middle;
}
.f-mnu ul li{
    float:left;
    width:50%;
    font-size:14px;
    margin-bottom:15px;
}
.f-mnu ul li a{
    color:#aaa;
}
.rr{
    text-align:right;
    padding:10px 0px;
    border-top:1px solid #333;
    font-size: 12px;
    width:100%;
}
.rr, .rr a{
    color:#aaa;
}

@media(max-width:768px){
.f-lg{
    width:auto;
}
}
@media(max-width:500px){
.f-lg{
    width:100%;
    margin:0;
    text-align:center;
}
.f-t-2{
    padding:20px;
}
.f-mnu {
    width: 100%;
    margin-top:20px;
    padding:0px 30px;
}
.rr {
    padding-right:20px;
}
}
<?php } ?>

/*** Single ***/
<?php if($redux_builder_amp['single-design-type'] == '2'){?>
<?php if(is_single()){ ?>
<?php if( 1 == $redux_builder_amp['ampforwp-bread-crumb'] ) {?>
/** Breadcrumbs **/
.breadcrumb{
    width: 100%;
    display: inline-block;
    padding-bottom: 8px;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
}
.breadcrumb ul li{
    display: inline-block;
    list-style-type: none;
    font-size: 10px;
    text-transform: uppercase;
    margin-right: 5px;
}
.breadcrumb ul li a{
    color: #999;
    letter-spacing: 1px;
}
.breadcrumb ul li a:hover{
    color:#005be2;
}
.item-home:after{
   content: "\e315";
    display: inline-block;
    color: #bdbdbd;
    font-family: 'icomoon';
    padding-left: 5px;
    font-size: 12px;
    position: relative;
    top: 1px;
}
<?php } ?>
.shr-txt, .athr-tx, .r-pf h3, .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date, .related-title{
    display: block;
}
.shr-txt, .athr-tx, .r-pf h3, .post-date, .related-title{
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    font-weight: 400;
}
.shr-txt, .athr-tx, .related-title, .r-pf h3 {
    margin-bottom: 12px;
}
.sd-2{
    margin-top: 20px;
    width:100%
}
.amp-category span a, .amp-category span {
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    font-size: 16px;
    font-weight: 900;
    text-transform: uppercase;
    font-style:italic;
}
.amp-post-title {
    font-size: 50px;
    line-height: 1.4;
    color: #000;
    margin: 0;
    padding-top: 15px;
    font-weight: 900;
    max-width:900px;
}
.exc {
    font-size: 20px;
    margin-top: 10px;
    color: #313131;
    max-width: 700px;
    line-height: 1.5;
}
.amp-author {
    width:100%;
    display:inline-block;
    margin-top:20px;
}
.amp-author-image, .author-details {
    display:inline-block;
    vertical-align:middle;
}
.author-details, .author-details a{
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    font-weight: 700;
    text-transform: capitalize;
}
.amp-featured-image{
    margin-top:20px;
    width:100%;
}
.artl{
    width: 100%;
    display: inline-flex;
}
.lft{
    display: flex;
    width: 70%;
    flex-direction: column;
    padding-right:3%;
}
.amp-author-image amp-img {
    border-radius: 50%;
    margin: 0px 12px 0px 0px;
}
.cntn-wrp {
    font-size: 18px;
    color: #000;
    line-height: 1.7;
    margin-top:20px;
}
.cntn-wrp a{
    margin:10px 0px;
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
    display:inline-block;
}
.cntn-wrp p {
    margin: 0px 0px 30px 0px;
}
.amp-category span:nth-child(1) {
    display: none;
}
.amp-category span:after {
    content: "/";
    display: inline-block;
    margin: 0px 5px 0px 5px;
    position: relative;
    top: 1px;
    color: rgba(0, 0, 0, 0.25);
}
.amp-category span:last-child:after{
    display:none;
}
.swift-sticky-social {
    width: 100%;
    bottom: 0;
    display: block;
    left: 0;
    box-shadow: 0px 4px 7px #000;
    background: #fff;
    position: fixed;
    margin: 0;
    z-index: 10;
    text-align: center;
}
/** post pagination **/
#pagination {
    margin-top: 10px;
    border-top: 1px dotted #ccc;
    padding: 20px 5px 0px 5px;
    font-size: 16px;
    line-height: 24px;
    font-weight: 400;
}
.prev span {
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    display: block;
    position: absolute;
    top: -26px;
}
.next span {
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    display: block;
    font-weight: 400;
    position: absolute;
    top: -26px;
    right: 0;
}
.prev:after {
    border-left: 1px dotted #ccc;
    content: "";
    height: calc(100% - -10px);
    right: -50px;
    position: absolute;
    top: 50%;
    transform: translate(0px, -50%);
    width: 2px;
}
.next a, .prev a {
    color: #333;
}
.next:hover a, .prev:hover a {
    color: <?php echo $redux_builder_amp['swift-color-scheme']['color']; ?>;
}
.prev {
    float: left;
    width: 45%;
    position: relative;
    margin-top: 10px;
}
.next {
    float: right;
    width: 45%;
    text-align: right;
    position: relative;
    margin-top: 10px;
}
.cat-aud{
    width:100%;
    display:inline-block;
}
.cat-aud .amp-category, .cat-aud .author-details{
    display:inline-block;
    vertical-align:middle;
}
.cat-aud .author-details{
    margin-left:10px;
    font-size: .8125rem;
    display: inline-block;
    height: 20px;
    letter-spacing: .4px;
    color: #757575;
    line-height: 1.83;
    font-weight: 400;
}
.cat-aud .author-details strong{
    padding-right: 6px;
    font-weight: 900;
}
.cat-aud .author-details strong:before{
    content: "|";
    display: inline-block;
    font-weight: normal;
    padding-right: 5px;

}
/** Comments **/
.cmts {
    width: 100%;
    display: inline-block;
    clear: both;
    margin-top: 30px;
}
.cmts h3 {
    margin: 0;
    font-size: 12px;
    padding-bottom: 6px;
    border-bottom: 1px solid #eee;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #777;
}
.cmts ul {
    margin-top: 16px;
}
.cmts ul li {
    list-style: none;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}
.comment-meta amp-img {
    float: left;
    margin-right: 10px;
    border-radius: 50%;
}
.cmts .comment-metadata {
    font-size: 11px;
    margin-top: 8px;
}
.cmts .comment-author.vcard .fn {
    font-size: 12px;
    font-weight: 500;
    color: #333;
}
.cmts .comment-author.vcard .says {
    display: none;
}
.cmts .comment-metadata a {
    color: #999;
}
.comment-content {
    margin-top: 6px;
    width: 100%;
    display: inline-block;
}
.comment-content p {
    font-size: 14px;
    color: #333;
    line-height: 22px;
    font-weight: 400;
    margin: 0;
}
.amp-comment-button {
    background-color: #005be2;
    font-size: 15px;
    float: none;
    width: 100%;
    margin: 0 auto;
    text-align: center;
    border-radius: 3px;
    font-weight: 600;
    width: 250px;
}
.amp-comment-button a {
    color: #fff;
    display: block;
    padding: 7px 0px 8px 0px;
}
/** article info **/
.artl-atr{
    margin-top: 30px;
    border-top: 1px solid #d8d8d8;
}
.artl-atr .amp-author .amp-author-image {
    float:left;
}
.artl-atr .author-details {
    display:block;
}
.artl-atr .author-name{
    color: #424242;
    font-size: 14px;
    font-weight: 700;
    margin-bottom:10px;
    display:inline-block;
}
.artl-atr .author-details p{
    font-size: 12px;
    letter-spacing: .6px;
    line-height: 16px;
    color: #424242;
    font-weight:400;
}
/** Tags **/
.amp-tags{
    margin-top:30px;
}
.amp-tags > span:nth-child(1), .amp-related-posts-title{
    font-weight: 700;
    color: #777;
    font-size: 12px;
    text-transform: uppercase;
    margin-bottom:10px;
}
.amp-tag a{
    padding: 6px 12px;
    margin: 5px 5px 5px 0;
    text-decoration: none;
    font-size: .9375rem;
    letter-spacing: .4px;
    border-radius: 50px;
    display: inline-block;
    color: #9c9c9c;
    border: 1px solid #9c9c9c;
}
/** Related posts **/
.srp {
    margin-top: 30px;
}
.rl-p{
    width:100%;
    display:inline-flex;
}
.rl-p .has_thumbnail {
    list-style-type: none;
    display: flex;
    flex-direction: column;
    flex: 1 0 31%;
    margin: 0 3% 3% 0;
}
.rl-p .has_thumbnail:last-child{
    margin-right:0;
}
.rlp-cnt{
    margin-top:10px;
}
.related_link a{
    font-weight: bold;
    color: #000;
    font-size: 17px;
    line-height:1.4;
}
.rlp-cnt .amp-author, .rlp-cnt p{
    display:none;
}
/** right sidebar  css **/
.rft{
    margin-top:30px;
}
.rc-p {
    width:100%;
    display:inline-block;
    text-align:center;
}
.rc-p .loop-wrapper{
    margin:0;
    text-align: left;
}
.rp{
    width: 100%;
    display: inline-block;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e5e5e5;
}
.rp:last-child{
    border-bottom:none;
    margin:0;
    padding:0;
}
.rc-p h3{
    text-align: center;
    font-size: 16px;
    padding: 5px 15px;
    font-style: italic;
    background: #f83371;
    color: #fff;
    position: relative;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 23px;
    font-weight:700;
    display:inline-block;
}
.rc-p h3:before {
    top: -1px;
    left: -1px;
    border-top: 1.9em solid #fff;
    border-right: .4em solid transparent;
    content: '';
    position: absolute;
    width: 0;
    height: 0;
}
.rc-p h3:after {
    bottom: -1px;
    right: -1px;
    border-bottom: 1.9em solid #fff;
    border-left: .4em solid transparent;
    content: '';
    position: absolute;
    width: 0;
    height: 0;
}
.rp-img{
    width:20%;
    float:left;
    margin-right:15px;
}
.rp-cnt h2{
    font-size:17px;
    font-weight:700;
    line-height:1.4;
}
.rp-cnt h2 a:hover{
    text-decoration:underline;
}
@media(max-width:768px){
.artl {
    width: 100%;
    display: inline-block;
}
.lft{
    width:100%;
    padding:0;
}
.rp-img {
    width: 10%;
}
.amp-post-title {
    font-size: 42px;
}
}
@media(max-width:767px){
.swift-sticky-social .amp-social {
    width: 100%;
}
.amp-social ul{
    display:inline-flex;
    width:100%;
}
.swift-sticky-social .amp-social ul a {
    display: flex;
    flex-direction: column;
    flex: 1 0 100%;
    width: auto;
    flex-basis: 0;
    -webkit-box-flex: 1;
}
}
@media(max-width:425px){
.cntr{
    width:100%;
    padding:0 20px;
}
.cat-aud .amp-category{
    margin-bottom:15px;
}
.cat-aud .author-details{
    margin-left:0;
}
.amp-category span a, .amp-category span {
    font-size: 14px;
}
.exc, .cntn-wrp {
    font-size: 16px;
}
.amp-post-title {
    font-size: 30px;
}
.rl-p{
    display:inline-block;
}
.rl-p .has_thumbnail{
    flex: 1 0 100%;
    margin: 0px 0px 30px 0px;
}
#pagination {
    margin: 20px 0px 10px 0px;
}
.next, .prev {
    float: none;
    width: 100%;
}
.next a {
    margin-bottom: 45px;
    display: inline-block;
}
.rp-img {
    width: 20%;
}
.rp-cnt h2 {
    font-size: 15px;
}
}
<?php } } ?>