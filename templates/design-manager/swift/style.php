/**** 
* AMP Framework Reset
*****/
body{ font-family: 'Montserrat'; font-size: 16px; line-height:1.4; }
ol, ul{ list-style-position: inside }
p, ol, ul, figure{ margin: 0 0 1em; padding: 0; }
a, a:active, a:visited{ color:#ed1c24; text-decoration: none }
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
*,*:after,*:before {box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;-ms-box-sizing: border-box;-o-box-sizing: border-box;}

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
/****
* Google fonts
*****/
@font-face {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 400;
    src:  local('Montserrat Regular'), local('Montserrat-Regular'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Montserrat-Regular.ttf');
}
@font-face {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 500;
    src:  local('Montserrat Medium'), local('Montserrat-Medium'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Montserrat-Medium.ttf');
}
@font-face {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 600;
    src:  local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Montserrat-SemiBold.ttf');
}
@font-face {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 700;
    src:  local('Montserrat Bold'), local('Montserrat-Bold'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Montserrat-Bold.ttf');
}
@font-face {
    font-family: 'Montserrat';
    font-style: normal;
    font-weight: 900;
    src:  local('Montserrat Black'), local('Montserrat-Black'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/Montserrat-Black.ttf');
}

/*** Font-icons ***/
@font-face {
    font-family: 'icomoon';
    font-style: normal;
    font-weight: normal;
    src:  local('icomoon'), local('icomoon'), url('<?php echo plugin_dir_url(__FILE__) ?>fonts/icomoon.ttf');
}

/****
* Container
*****/
.cntr {
    max-width: 1100px;
    margin: 0 auto;
}

/****
* AMP Sidebar
*****/
amp-sidebar, .lb-t {
<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>
    background: <?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;
 <?php } ?>
}
amp-sidebar {
    width: 100%;
    padding-left:5%;
    padding-right:5%;
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
    right: 10px;
    top: 10px;
}
/****
* AMP Navigation Menu with Dropdown Support
*****/
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


/**** 
* Header
*****/
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
        height:<?php echo $redux_builder_amp['swift-height-control']?>px;
    <?php } ?>
}
.h-ic a:after{
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
    content: "\e8cc";
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
.logo .amp-logo a{
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
.h-srch .lb:after{
    content: "\e8b6";
}
.amp-logo amp-img{max-width: 190px;margin: 0 auto;width:<?php echo ampforwp_default_logo('width');?>px;}

.amp-sidebar-close:after{
    content: "\e5cd";
    font-family: 'icomoon';
    font-size: 16px;
   <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?>
    text-indent: 1px;
    cursor: pointer;
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
.m-menu ul li.menu-item-has-children:hover:after{-moz-transform:rotate(180deg);-o-transform:rotate(180deg);-webkit-transform:rotate(180deg);-ms-transform:rotate(180deg);transform:rotate(180deg);top:4px;right:0px}
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
    color:#fff;
    padding: 13px 7px;
    display: block;
    margin-bottom:0;
}
.menu-btn{
    margin-top:30px;
    text-align:center;
}
.menu-btn a{
    color:#ffffff;
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
    -moz-transition: opacity .5s ease-in-out;
    -o-transition: opacity .5s ease-in-out;
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
    -moz-transition: .5s ease-in-out;
    -o-transition: .5s ease-in-out;
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
    -moz-transition: .5s ease-in-out;
    -o-transition: .5s ease-in-out;
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
    color: #ffffff;
    width:100%;
}
/*** Header - Styles ***/

.head-2 .h-logo{
    order:-1;
    align-self: center;
   flex-grow:1;
}
.amp-logo{
    line-height:0;
}
.h-sing{
    font-size: 18px;
    font-weight: 600;
    align-self: center;
    margin:0 10px 0px 0px;
}
.h-sing a{
    <?php if($redux_builder_amp['signin-button-border-line']){?>
        border: <?php echo $redux_builder_amp['signin-button-border-line']?>px solid;
    <?php } ?>
    <?php if($redux_builder_amp['signin-button-border-color']['rgba']){?>
        border-color: <?php echo $redux_builder_amp['signin-button-border-color']['rgba']?>;
    <?php } ?>
    padding:10px 25px;
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

/**** 
* Loop
*****/
/**** Big post ***/
.loop-wrapper{
    margin-top:34px;
}
.fbp{
    width:100%;
    display:inline-block;
    clear:both;
    margin:0px 0px 44px 0px;
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
.loop-category li{
    display: inline-block;
    list-style-type: none;
    margin-right: 10px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
}
.loop-category li a{
    color:#555;
    text-transform: uppercase;
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
 .fsp h2 a{
    color:#000;
}
.fbp-cnt h2:hover a, .fsp-cnt h2:hover a{
    color:#005be2;
}
.fbp-cnt p, .fsp-cnt p{
    color:#444;
    font-size:13px;
    line-height:20px;
    letter-spacing: 0.10px;
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
/** Socila Icons **/



/**** Small post ***/
.b-w .fsp:nth-child(4), .b-w .fsp:nth-child(7), .b-w .fsp:nth-child(10){
    margin-right:0;
}
.archive .fsp:nth-child(3), .archive .fsp:nth-child(6), .archive .fsp:nth-child(9), .archive .fsp:nth-child(12){
    margin-right:0;
}
.r-pf .fsp:nth-child(3), .r-pf .fsp:nth-child(6){
    margin-right:0;
}
.fsp{
    display: inline-flex;
    margin: 0px 28px 40px 0px;
    width: 31.3%;
    flex-direction: column;
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

/****
* Archives
*****/
.amp-archive-title, .amp-loop-label{
    font-size:18px;
    font-weight:600;
    margin-top:20px;
}
.amp-archive-desc{
    font-size: 14px;
    margin-top: 10px;
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
/****
* Single
*****/
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
    color: #005be2;
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
    content:"";
    background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDUzMy4zMzMgNTMzLjMzMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTMzLjMzMyA1MzMuMzMzOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxnPgoJPHBhdGggZD0iTTE1OC4zMzMsMzAwYzAsNTkuODMxLDQ4LjUwMiwxMDguMzMzLDEwOC4zMzMsMTA4LjMzM1MzNzUsMzU5LjgzMSwzNzUsMzAwcy00OC41MDItMTA4LjMzMy0xMDguMzMzLTEwOC4zMzMgICBTMTU4LjMzMywyNDAuMTY5LDE1OC4zMzMsMzAweiBNNTAwLDExNi42NjdIMzgzLjMzM0MzNzUsODMuMzMzLDM2Ni42NjcsNTAsMzMzLjMzMyw1MEgyMDBjLTMzLjMzMywwLTQxLjY2NywzMy4zMzMtNTAsNjYuNjY3ICAgSDMzLjMzM0MxNSwxMTYuNjY3LDAsMTMxLjY2NywwLDE1MHYzMDBjMCwxOC4zMzMsMTUsMzMuMzMzLDMzLjMzMywzMy4zMzNINTAwYzE4LjMzMywwLDMzLjMzNC0xNSwzMy4zMzQtMzMuMzMzVjE1MCAgIEM1MzMuMzMzLDEzMS42NjcsNTE4LjMzMywxMTYuNjY3LDUwMCwxMTYuNjY3eiBNMjY2LjY2Nyw0NDcuOTE3Yy04MS42OTIsMC0xNDcuOTE3LTY2LjIyNC0xNDcuOTE3LTE0Ny45MTcgICBjMC04MS42OTIsNjYuMjI0LTE0Ny45MTcsMTQ3LjkxNy0xNDcuOTE3YzgxLjY5MywwLDE0Ny45MTcsNjYuMjI0LDE0Ny45MTcsMTQ3LjkxNyAgIEM0MTQuNTgzLDM4MS42OTMsMzQ4LjM2MSw0NDcuOTE3LDI2Ni42NjcsNDQ3LjkxN3ogTTUwMCwyMTYuNjY3aC02Ni42NjZ2LTMzLjMzM0g1MDBWMjE2LjY2N3oiIGZpbGw9IiMwMDAwMDAiLz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
    background-size: 18px;
    display: inline-block;
    width: 18px;
    height: 18px;
    background-repeat: no-repeat;
    position: relative;
    top: 2px;
    opacity: 0.4;
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
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    order: 1;
}
.ss-icons, .sp-athr, .tags, .post-date{
    padding-bottom:20px;
    border-bottom:1px dotted #ccc;
}
.shr-txt, .athr-tx, .tags .amp-tags > span:nth-child(1), .amp-related-posts-title, .related-title, .r-pf h3{
    margin-bottom: 12px;
}
.shr-txt, .athr-tx, .r-pf h3, .tags .amp-tags > span:nth-child(1), .amp-related-posts-title, .post-date .loop-date, .related-title{
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    display: block;
    font-weight: 400;
}
.sp-athr, .tags, .post-date, .srp{
    margin-top:20px;
}
.sp-athr .author-details a, .sp-athr .author-details, .amp-tags span a, .amp-tag {
    font-size: 15px;
    color: #005be2;
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
.ss-icons .amp-social .icon-twitter :before{
    color:#1da1f2;
}
.ss-icons .amp-social {
    font-size: 16px;
}
.ss-icons .amp-social li{
    margin-right: 15px;
}
.ss-icons .amp-social li:before{
    border-radius: 2px;
    padding:2px;
}

.swift-sticky-social{ width: 100%; bottom: 0; display: block; left: 0; box-shadow: 0px 4px 7px #000; background: #fff; padding: 7px 0px 0px 0px; position: fixed; margin: 0; z-index: 10; text-align: center; }
.cntn-wrp{
    font-size:18px;
    color:#000;
        line-height:1.5;
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
}
.srp ul li:last-child{
    margin-bottom:0px;
}
.has_thumbnail:hover{
    opacity:0.7;
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
<?php if( 1 == $redux_builder_amp['amp-author-description'] ) {?>
.sp-rt .amp-author {
    padding: 20px 20px;
    border-radius: 0;
    background: #f9f9f9;
    border: 1px solid #ececec;
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
    font-size: 18px;
    line-height: 24px;
    font-weight:500;
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
    font-weight: 400;
    position: absolute;
    top: -26px;
}
.next span{
    text-transform: uppercase;
    font-size: 12px;
    color: #666;
    display: block;
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
/*** loop-pagination ***/
.right a, .left a{
    background: #005be2;
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
    color: #ffffff;
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

/**** 
* Footer
*****/
.footer{
    font-size: 12px;
    margin-top: 80px;
    border-top: 1px solid #f2f2f2;
}
.f-menu ul li{
    display:inline-block;
    margin-right:20px;
}
.f-menu .amp-menu > li a {
    padding:0;
    font-size:14px;
    color:#7a7a7a;
}
.f-menu .amp-menu > li:hover a{
    color: #005be2;
}
.rr{
    margin-top: 30px;
    font-size: 12px;
    color: #333;
}
.f-menu .amp-menu li.menu-item-has-children:hover > ul{
    display:none;
}
.f-menu .amp-menu li.menu-item-has-children:after{
    display:none;
}
.f-w-f1{
  padding:70px 0px; 
  width:100%; 
}
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
    -ms-flex-pack: justify;
    justify-content: space-between;
    position: relative;
    -webkit-box-flex: 1;
    -ms-flex: 1 0 100%;
    flex: 1 0 25%;
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
    font-size: 15px;
    margin-bottom: 22px;
}
.w-bl ul li:last-child{
    margin-bottom:0;
}
.w-bl ul li a{
    text-decoration: none;
    color: #333;
}


/*** Transitions ***/
.fbp-cnt h2 a, .p-menu ul li a, .fsp h2 a,
.author-details a, .has_thumbnail, .f-menu ul li a{
    transition: all 0.3s ease-in-out 0s;
  -webkit-transition: all 0.3s ease-in-out 0s;
  -moz-transition: all 0.3s ease-in-out 0s;
  -ms-transition: all 0.3s ease-in-out 0s;
  -o-transition: all 0.3s ease-in-out 0s;
}

/*** Responsive ***/
@media(max-width:1024px){
.cntr{
    width:100%;
    padding:0px 40px;
}
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
.fsp{
    width:31%;
}
.sp-rt {
    margin-left: 30px;
}
.related_posts .has_related_thumbnail {
    margin: 0px 26px 30px 0px;
}

}
@media(max-width:980px){
.fsp {
    width: 30%;
}


}
@media(max-width:768px){
.fbp-img {
    width: 100%;
    float:none;
}
.fbp-cnt {
    float: none;
    width: 100%;
    margin-left: 0px;
    margin-top:15px;
    display:inline-block;
}
.fbp-cnt p{
    margin-top:8px;
}
.fsp{
   width: 100%;
    margin:0px;
    display: inline-block;
    clear: both;
    padding: 20px 0px 15px;
    border-top: 1px solid #f1f1f1;
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
.h-sing {
    font-size:15px;
}
.sp-rt {
    width: 100%;
    margin-left: 0;
}
.fbp {
    margin: 0px 0px 20px 0px;
}
.fsp h2{
    margin: 0px 0px 3px 0px;
}
.fsp-cnt .loop-category {
    margin-bottom: 5px;
}
.at-dt{
    margin: 8px 0px 0px 0px;
}
/** Single Page **/
.tl-exc {
    font-size: 14px;
    margin-top: 3px;
    line-height: 22px;
}
.sp-rl {
    display: inline-block;
    width: 100%;
}
.sp-lt {
    width: 100%;
    margin-top: 40px;
}
.sp-cnt{
    margin-top: 15px;
}
.rlp-image{
    width:200px;
    float:left;
    margin-right:15px;
}
.rlp-cnt{
    width:62%;
    float:left;
}
.cmts{
    margin-top:20px;
}
.loop-wrapper {
    margin-top: 17px;
}
.amp-archive-desc {
    font-size: 13px;
    margin-top: 5px;
    line-height: 18px;
}
.amp-archive-title, .amp-loop-label {
    font-size: 16px;
    margin-top: 15px;
}
.author-img amp-img {    
   margin: 0px 12px 5px 0px;
}
/*** Footer ***/
.footer {
    margin-top: 60px;
}


}
@media(max-width:480px){
.cntr{
    width: 100%;
    padding: 0px 20px;
}
.sf-img .wp-caption-text{
    width:100%;
    padding:10px 15px;
}
.cntr.b-w{
    padding:0 12px;
}
.fbp-cnt .loop-category{
    margin-bottom:5px;
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
    margin: 0;  
    border:none; 
    padding:20px 0px 10px;
}
.h-sing {
    font-size: 13px;
}
.h-sing a {
    padding: 8px 15px;
}
/** Single Page **/
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
    margin-top: 30px;
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
    padding: 40px 5px 0px 5px;
}
.prev {
    margin-top: 50px;
}
.prev:after{
    display:none;
}

/** Footer **/
.footer {
    margin-top: 50px;
}
.f-w-f1 {
    padding: 45px 0px 10px 0px;
}
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
    font-size: 17px;
    margin-bottom: 15px;
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
    margin-top: 20px;
    font-size: 11px;
}
}
@media(max-width:320px){
.right a, .left a {
    padding: 10px 30px;
}
.cntn-wrp p {
    font-size: 16px;
}
}

/**** Font-Icons ****/

[class^="icon-"], [class*=" icon-"] {
  /* use !important to prevent issues with browser extensions that change fonts */
  font-family: 'icomoon' !important;
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;

  /* Better Font Rendering =========== */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/*** ADS CODE ***/
.amp-ad-wrapper{
    width:100%;
    text-align:center;
}
.amp-ad-1{
   margin: -2px 0px -17px 0px;
}
.amp-ad-2{
   margin: 20px 0px -23px 0px; 
}
.amp-ad-3{
    margin: 0px 0px -4px 0px;
}
.amp-ad-4{
    margin: 20px 0px 20px 0px;
}
.amp-ad-5{
    margin: 10px 0px -17px 0px;
}
.amp-ad-6{
    margin: 0px 0px 20px 0px;
}

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
/** Single Page **/
.breadcrumb, .amp-category{
    text-align: right;
}
.amp-post-title{
    text-align: right;
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
.fsp {
    margin: 0px 0px 40px 28px;
}
.b-w .fsp:nth-child(2), .b-w .fsp:nth-child(5), .b-w .fsp:nth-child(8){
    margin-left:0;
}
.r-pf .fsp:nth-child(3), .r-pf .fsp:nth-child(6){
    margin-left:0;
}
.sp-lt {
    direction: rtl;
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
.archive .fsp:nth-child(1), .archive .fsp:nth-child(4), .archive .fsp:nth-child(7), .archive .fsp:nth-child(10){
    margin-left:0;
}
/** Responsive **/
@media(max-width:1024px){
.fbp-img{
    float:right;
}
.fbp-cnt {
    width: 34%;
    margin-left: 0;
    margin-right: 30px;   
}

}


@media(min-width:481px) and (max-width:768px){
.fbp-cnt {
    width:100%;
    floa:none;
}
.fsp-img {
    float: right;
    margin-right: 0;
    margin-left:30px;
}

.fsp {
    margin: 0px 0px 40px 0px;
}
}
@media(max-width:480px){
.fbp-cnt{
    width:100%;
    float:none;
}
.fsp {
    margin: 0px 0px 40px 0px;
}


}
<?php } ?>









