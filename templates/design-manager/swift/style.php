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
}
.alignleft {
    float: left;
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

amp-sidebar {
<?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>
    background: <?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;
 <?php } ?>
    width: 65%;
    padding-left:5%;
    padding-right:5%;
}
<?php if($redux_builder_amp['swift-header-overlay-width-control']){?>
amp-sidebar {
    width: 100%;
    padding-right: 20%;
    padding-left: 10%;
    max-width:100vw;
}
<?php } ?>
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
.amp-sidebar-toggle span:nth-child(2){
    top: 7px;
}
.amp-sidebar-toggle span:nth-child(3){
    top:14px;
}
/* AMP Sidebar close button */
.amp-sidebar-close{
    background: transparent;
    display: inline-block;
    padding: 5px 10px;
    font-size: 12px;
    color: #333;
    margin-top:20px;
    text-indent: -99999px;
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
    flex-grow: 1;
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
.logo{
    z-index: 2;
    flex-grow: 1;
    align-self: center;
}
.h-3 {
    order: 1;
    display: inline-flex;
    flex-grow: 1;
    justify-content: flex-end;
}
.h-3 .h-nav, .h-ic{
    margin:0px 10px;
}
.head-3 .h-logo{
    order:-1;
    align-self: center;
}
.logo .amp-logo a{
    line-height:0;
    display:block;
    color:#000;
}
.logo h1{
   margin: 0;
    font-size: 17px;
    font-weight: 700;
    text-transform: uppercase;
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
    font-size: 27px;
   <?php if($redux_builder_amp['swift-element-overlay-color-control'] ['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php } ?>
    line-height: 0;
    display: block;
    text-indent: 1px;
    cursor: pointer;
}

.m-menu ul li.menu-item-has-children:after{content:"";background:url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAxMjkgMTI5IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAxMjkgMTI5IiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KICA8Zz4KICAgIDxwYXRoIGQ9Im0xMjEuMywzNC42Yy0xLjYtMS42LTQuMi0xLjYtNS44LDBsLTUxLDUxLjEtNTEuMS01MS4xYy0xLjYtMS42LTQuMi0xLjYtNS44LDAtMS42LDEuNi0xLjYsNC4yIDAsNS44bDUzLjksNTMuOWMwLjgsMC44IDEuOCwxLjIgMi45LDEuMiAxLDAgMi4xLTAuNCAyLjktMS4ybDUzLjktNTMuOWMxLjctMS42IDEuNy00LjIgMC4xLTUuOHoiIGZpbGw9IiNGRkZGRkYiLz4KICA8L2c+Cjwvc3ZnPgo=) no-repeat;background-size:16px;display:inline-block;width:16px;height:16px;top:10px}
.m-menu ul li.menu-item-has-children:hover:after{-moz-transform:rotate(180deg);-o-transform:rotate(180deg);-webkit-transform:rotate(180deg);-ms-transform:rotate(180deg);transform:rotate(180deg);top:4px;right:5px}
.m-menu .amp-menu li:hover li:hover>a{background:transparent}
.amp-menu li:hover a {background: transparent none repeat scroll 0 0;}
.m-menu .amp-menu {
    list-style-type: none;
    margin: 5% 0 0 0;
    padding: 0;
}
.amp-menu > li a{
    color:#fff;
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
    <?php if($redux_builder_amp['swift-header-overlay']['rgba']){?>
        background: <?php echo $redux_builder_amp['swift-header-overlay'] ['rgba'] ?>;
     <?php } ?>
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
.overlay-search:before {
    content: "\e8b6";
    position: absolute;
    right: 13.3%;
    top: 16px;
    font-size: 24px;
    font-family: 'icomoon';
    cursor: pointer;
    <?php if($redux_builder_amp['swift-element-overlay-color-control']['rgba']){?>
        color: <?php echo $redux_builder_amp['swift-element-overlay-color-control']['rgba']?>;
    <?php }  ?>
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
}
.lb-btn form #s {
    padding: 10px;
    background: transparent;
    border: none;
    border-bottom: 1px solid #504c4c;
    color: #ffffff;
    width:70%;
}
/*** Header - Styles ***/

.head-2 .h-logo{
    order:-1;
    align-self: center;
    margin-left:30px;
}
.h-sing{
    font-size: 18px;
    font-weight: 600;
    align-self: center;
    margin:0 10px;
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
    <?php if($redux_builder_amp['primary-menu-background-scheme']['rgba']){?>
        background:<?php echo $redux_builder_amp['primary-menu-background-scheme']['rgba']; ?>
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
.loop-category{
    margin-bottom:5px;
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
    font-weight:900;
}
.fbp-cnt h2 a, .fsp h2 a{
    color:#191919;
}
.fbp-cnt h2:hover a, .fsp-cnt h2:hover a{
    color:#005be2;
}
.fbp-cnt p, .fsp-cnt p{
    color:#333;
    font-size:13px;
    line-height:20px;
}
/** Socila Icons **/



/**** Small post ***/
.fsp{
    display: inline-flex;
    margin: 0px 28px 50px 0px;
    width: 30.5%;
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
    margin:0px 0px 10px 0px;
    font-size:20px;
    line-height:25px;
    font-weight:700;
}
.at-dt, .pt-dt{
    font-size:12px;
    color:#808080;
    margin:8px 0px; 
    display: inline-flex;
}
.amp-author {
    padding-left:6px;
}
.author-details a{
    color:#808080;
}
.author-details a:hover{
    color:#005be2;
    text-decoration:underline;
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
}
/****
* Single
*****/

.amp-category span:nth-child(1) {
    display: none;
}
.amp-category span a{
    color: #005be2;
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
}
.amp-category span:after{
    content:"/";
    display:inline-block;
    margin:0px 3px 0px 5px;
    position:relative;
    top:1px;
}
.amp-category span:last-child:after{
    display:none;
}
.sp{
    width:100%;
    margin-top:40px;
}
.amp-post-title{
    font-size:48px;
    line-height:56px;
    color: #333;
    margin:0;
    padding-top:5px;
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
.sp-lt{
    width: 270px;
    float: left;
}
.sp-rt{
    float:right;
    width:760px;
    margin-left:60px;
}
.ss-icons, .sp-athr, .tags, .post-date{
    padding-bottom:20px;
    border-bottom:1px dotted #ccc;
}
.shr-txt{
    margin-bottom: 15px;
}
.athr-tx, .lbl-tx{
    margin-bottom: 10px;
}
.shr-txt, .athr-tx, .lbl-tx, .amp-related-posts-title{
    text-transform: uppercase;
    font-size: 12px;
    color: #a1a1a1;
    display: block;
    font-weight: 600;
}
.amp-related-posts-title{
    margin:0;
    padding-bottom:15px;
}
.sp-athr, .tags, .post-date, .srp{
    margin-top:20px;
}
.sp-athr .author-details a {
    font-size: 15px;
    text-transform: capitalize;
    color: #005be2;
    font-weight: 500;
}
.tags .amp-tags > span:nth-child(1){
    display:none;
}
.amp-tags span a{
    font-size:15px;
    color: #005be2;
    font-weight: 500;
}
.amp-tags span a:after{
    content: "/";
    display: inline-block;
    padding: 5px;
    position: relative;
    top: 2px;
}
.amp-tags span:last-child a:after{
    display:none;
}
.post-date .loop-date{
    font-size: 13px;
    color: #a1a1a1;
    font-weight: 500;
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
.sp-rt p, .pg p{
    font-size:19px;
    line-height:30px;
    color:#4c4c4c;
    margin:20px 0px;
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
.rlp-cnt a{
    color: #333;
    font-size: 16px;
    line-height: 22px;
    font-weight: 700;
    margin-top: 10px;
    display: inline-block;
}
.srp ul li{
    display: inline-block;
    line-height: 1.3;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px dotted #ccc;
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
.prev a:before{
    content: "PREVIOUS";
    display: block;
    font-size: 12px;
    position: absolute;
    top: -26px;
    color: #005be2;
}
.next a:before{
    content: "Next";
    display: block;
    font-size: 12px;
    position: absolute;
    top: -26px;
    color: #005be2;
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
/*** loop-pagination ***/
.right a, .left a{
    background: #005be2;
    padding: 10px 40px;
    color: #fff;
    border-radius: 3px;
    font-size:16px;
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
    margin-top:20px;
}
.cmts  .amp-comment-button{
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
.cmts .amp-comment-button a{
    color: #ffffff;
    display: block;
    padding: 7px 0px 8px 0px;
}
.cmts h3{
    margin: 0;
    font-size: 17px;
    padding-bottom: 10px;
    border-bottom: 2px solid #eee;
    font-weight: bold;
}
.cmts h3:after{
    content: "";
    display: block;
    width: 145px;
    border-bottom: 2px solid #005be2;
    position: relative;
    top: 12px;
}
.cmts ul{
    margin-top:16px;
}
.cmts ul li{
    list-style:none;
    margin-bottom:25px;
}
.cmts .comment-author.vcard .says{
    display:none;
}
.cmts  .comment-author.vcard .fn{
    font-size: 15px;
    font-weight: 600;
    color: #111;
}
.comment-author.vcard{
    display: inline-block;
    margin-right: 5px;
    vertical-align: middle;
}
.cmts .comment-metadata{
    font-size: 13px;
    font-weight: normal;
    display:inline-block;
}
.cmts .comment-metadata a{
    color: #333;
}
.comment-content{
    margin-top:6px;
    width:100%;
    display:inline-block;
}
.comment-content p{
    font-size: 16px;
    color: #000;
    line-height: 21px;
    font-weight:400;
    margin:0;
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
    padding: 30px 0px;
    font-size: 12px;
    margin-top:40px;
    border-top:1px solid #f2f2f2;
}
.m-rr{
    text-align: center;
    width:100%;
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
    margin-top: 25px;
    font-size: 12px;
    color: #333;
}
.f-menu .amp-menu li.menu-item-has-children:hover > ul{
    display:none;
}
.f-menu .amp-menu li.menu-item-has-children:after{
    display:none;
}
.f-w{
    display: inline-flex;
    width: 100%;
    margin-bottom: 30px;
    border-bottom: 1px solid #eee;
    padding-bottom: 30px;

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
    color:#333;
    font-size:20px;
    line-height:24px;
    font-weight:500;
    margin-bottom:20px;
}
.w-bl ul li{
    list-style-type:none;
    font-size:20px;
    margin-bottom:20px;
}
.w-bl ul li:last-child{
    margin-bottom:0;
}
.w-bl ul li a{
    text-decoration:none;
    color:#666;
}



/*** Transitions ***/
.fbp-cnt h2 a, .p-menu ul li a, .fsp h2 a,
.author-details a, .has_thumbnail{
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
    width:30%;
}
/** Single page **/
.sp-rt {
    width: 650px;
    margin-left: 30px;
}
.sp-lt {
    width: 210px;
}
}
@media(max-width:980px){
.sp-rt {
    width: 600px;
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
    border-top: 1px solid #eee;
}
.fsp-img{
    width:30%;
    float:left;
    margin-right:20px;
}
.fsp-cnt{
    width:62%;
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
.fsp-cnt .loop-date{
    margin-top:10px;
}
.overlay-search:before {
    right: 11%;
}

/** Single Page **/
.sp-lt {
    width: 100%;
}
.sp-cnt{
    margin-top: 25px;
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
    margin-top: 25px;
}
}
@media(max-width:480px){
.cntr {
    width: 100%;
    padding: 0px 20px;
}
.overlay-search:before {
    right: 9%;
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
}
.m-menu .amp-menu {
    margin: 15% 0 0 0;
}
.f-menu ul li{
    margin-bottom:20px;
}
.h-sing {
    font-size: 13px;
}
.h-sing a {
    padding: 8px 15px;
}
/** Single Page **/
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
.f-w{
    display:block;
}
.w-bl{
    margin-bottom:20px;
}
.w-bl h4 {
    font-size: 17px;
    margin-bottom: 15px;
}
.w-bl ul li {
    font-size: 17px;
    margin-bottom: 15px;
}


}
@media(max-width:320px){
.right a, .left a {
    padding: 10px 30px;
}
.amp-menu li{
    font-size:15px;
}
.overlay-search:before {
    right: 6%;
}
}

/**** Font-Icons ****/
@font-face {
  font-family: 'icomoon';
  src:
    url('fonts/icomoon.ttf?wtrpmf') format('truetype'),
    url('fonts/icomoon.woff?wtrpmf') format('woff'),
    url('fonts/icomoon.svg?wtrpmf#icomoon') format('svg');
  font-weight: normal;
  font-style: normal;
}

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

.icon-3d_rotation:before {
  content: "\e84d";
}
.icon-ac_unit:before {
  content: "\eb3b";
}
.icon-alarm:before {
  content: "\e855";
}
.icon-access_alarms:before {
  content: "\e191";
}
.icon-schedule:before {
  content: "\e8b5";
}
.icon-accessibility:before {
  content: "\e84e";
}
.icon-accessible:before {
  content: "\e914";
}
.icon-account_balance:before {
  content: "\e84f";
}
.icon-account_balance_wallet:before {
  content: "\e850";
}
.icon-account_box:before {
  content: "\e851";
}
.icon-account_circle:before {
  content: "\e853";
}
.icon-add:before {
  content: "\e145";
}
.icon-add_a_photo:before {
  content: "\e439";
}
.icon-alarm_add:before {
  content: "\e856";
}
.icon-add_alert:before {
  content: "\e003";
}
.icon-add_box:before {
  content: "\e146";
}
.icon-add_circle:before {
  content: "\e147";
}
.icon-control_point:before {
  content: "\e3ba";
}
.icon-add_location:before {
  content: "\e567";
}
.icon-add_shopping_cart:before {
  content: "\e854";
}
.icon-queue:before {
  content: "\e03c";
}
.icon-add_to_queue:before {
  content: "\e05c";
}
.icon-adjust:before {
  content: "\e39e";
}
.icon-flight:before {
  content: "\e539";
}
.icon-airplay:before {
  content: "\e055";
}
.icon-airport_shuttle:before {
  content: "\eb3c";
}
.icon-alarm_off:before {
  content: "\e857";
}
.icon-alarm_on:before {
  content: "\e858";
}
.icon-album:before {
  content: "\e019";
}
.icon-all_inclusive:before {
  content: "\eb3d";
}
.icon-all_out:before {
  content: "\e90b";
}
.icon-android:before {
  content: "\e859";
}
.icon-announcement:before {
  content: "\e85a";
}
.icon-apps:before {
  content: "\e5c3";
}
.icon-archive:before {
  content: "\e149";
}
.icon-arrow_back:before {
  content: "\e5c4";
}
.icon-arrow_downward:before {
  content: "\e5db";
}
.icon-arrow_drop_down:before {
  content: "\e5c5";
}
.icon-arrow_drop_down_circle:before {
  content: "\e5c6";
}
.icon-arrow_drop_up:before {
  content: "\e5c7";
}
.icon-arrow_forward:before {
  content: "\e5c8";
}
.icon-arrow_upward:before {
  content: "\e5d8";
}
.icon-art_track:before {
  content: "\e060";
}
.icon-aspect_ratio:before {
  content: "\e85b";
}
.icon-poll:before {
  content: "\e801";
}
.icon-assignment:before {
  content: "\e85d";
}
.icon-assignment_ind:before {
  content: "\e85e";
}
.icon-assignment_late:before {
  content: "\e85f";
}
.icon-assignment_return:before {
  content: "\e860";
}
.icon-assignment_returned:before {
  content: "\e861";
}
.icon-assignment_turned_in:before {
  content: "\e862";
}
.icon-assistant:before {
  content: "\e39f";
}
.icon-flag:before {
  content: "\e153";
}
.icon-attach_file:before {
  content: "\e226";
}
.icon-attach_money:before {
  content: "\e227";
}
.icon-attachment:before {
  content: "\e2bc";
}
.icon-audiotrack:before {
  content: "\e3a1";
}
.icon-autorenew:before {
  content: "\e863";
}
.icon-av_timer:before {
  content: "\e01b";
}
.icon-backspace:before {
  content: "\e14a";
}
.icon-cloud_upload:before {
  content: "\e2c3";
}
.icon-battery_alert:before {
  content: "\e19c";
}
.icon-battery_charging_full:before {
  content: "\e1a3";
}
.icon-battery_std:before {
  content: "\e1a5";
}
.icon-battery_unknown:before {
  content: "\e1a6";
}
.icon-beach_access:before {
  content: "\eb3e";
}
.icon-beenhere:before {
  content: "\e52d";
}
.icon-block:before {
  content: "\e14b";
}
.icon-bluetooth:before {
  content: "\e1a7";
}
.icon-blur_circular:before {
  content: "\e3a2";
}
.icon-blur_linear:before {
  content: "\e3a3";
}
.icon-blur_on:before {
  content: "\e3a5";
}
.icon-class:before {
  content: "\e86e";
}
.icon-turned_in:before {
  content: "\e8e6";
}
.icon-turned_in_not:before {
  content: "\e8e7";
}
.icon-border_color:before {
  content: "\e22b";
}
.icon-branding_watermark:before {
  content: "\e06b";
}
.icon-brightness_1:before {
  content: "\e3a6";
}
.icon-brightness_2:before {
  content: "\e3a7";
}
.icon-brightness_3:before {
  content: "\e3a8";
}
.icon-brightness_4:before {
  content: "\e3a9";
}
.icon-brightness_low:before {
  content: "\e1ad";
}
.icon-brightness_high:before {
  content: "\e1ac";
}
.icon-brightness_auto:before {
  content: "\e1ab";
}
.icon-broken_image:before {
  content: "\e3ad";
}
.icon-brush:before {
  content: "\e3ae";
}
.icon-bubble_chart:before {
  content: "\e6dd";
}
.icon-bug_report:before {
  content: "\e868";
}
.icon-build:before {
  content: "\e869";
}
.icon-burst_mode:before {
  content: "\e43c";
}
.icon-domain:before {
  content: "\e7ee";
}
.icon-business_center:before {
  content: "\eb3f";
}
.icon-cached:before {
  content: "\e86a";
}
.icon-cake:before {
  content: "\e7e9";
}
.icon-phone:before {
  content: "\e0cd";
}
.icon-call_end:before {
  content: "\e0b1";
}
.icon-call_made:before {
  content: "\e0b2";
}
.icon-merge_type:before {
  content: "\e252";
}
.icon-call_missed:before {
  content: "\e0b4";
}
.icon-call_missed_outgoing:before {
  content: "\e0e4";
}
.icon-call_received:before {
  content: "\e0b5";
}
.icon-call_split:before {
  content: "\e0b6";
}
.icon-call_to_action:before {
  content: "\e06c";
}
.icon-camera:before {
  content: "\e3af";
}
.icon-photo_camera:before {
  content: "\e412";
}
.icon-camera_enhance:before {
  content: "\e8fc";
}
.icon-camera_front:before {
  content: "\e3b1";
}
.icon-camera_roll:before {
  content: "\e3b3";
}
.icon-cancel:before {
  content: "\e5c9";
}
.icon-redeem:before {
  content: "\e8b1";
}
.icon-card_membership:before {
  content: "\e8f7";
}
.icon-card_travel:before {
  content: "\e8f8";
}
.icon-casino:before {
  content: "\eb40";
}
.icon-center_focus_strong:before {
  content: "\e3b4";
}
.icon-center_focus_weak:before {
  content: "\e3b5";
}
.icon-change_history:before {
  content: "\e86b";
}
.icon-chat:before {
  content: "\e0b7";
}
.icon-chat_bubble:before {
  content: "\e0ca";
}
.icon-chat_bubble_outline:before {
  content: "\e0cb";
}
.icon-check:before {
  content: "\e5ca";
}
.icon-check_box:before {
  content: "\e834";
}
.icon-check_box_outline_blank:before {
  content: "\e835";
}
.icon-check_circle:before {
  content: "\e86c";
}
.icon-navigate_before:before {
  content: "\e408";
}
.icon-navigate_next:before {
  content: "\e409";
}
.icon-child_care:before {
  content: "\eb41";
}
.icon-child_friendly:before {
  content: "\eb42";
}
.icon-chrome_reader_mode:before {
  content: "\e86d";
}
.icon-close:before {
  content: "\e5cd";
}
.icon-clear_all:before {
  content: "\e0b8";
}
.icon-closed_caption:before {
  content: "\e01c";
}
.icon-wb_cloudy:before {
  content: "\e42d";
}
.icon-cloud_circle:before {
  content: "\e2be";
}
.icon-cloud_done:before {
  content: "\e2bf";
}
.icon-cloud_download:before {
  content: "\e2c0";
}
.icon-cloud_off:before {
  content: "\e2c1";
}
.icon-cloud_queue:before {
  content: "\e2c2";
}
.icon-code:before {
  content: "\e86f";
}
.icon-photo_library:before {
  content: "\e413";
}
.icon-collections_bookmark:before {
  content: "\e431";
}
.icon-palette:before {
  content: "\e40a";
}
.icon-colorize:before {
  content: "\e3b8";
}
.icon-comment:before {
  content: "\e0b9";
}
.icon-compare:before {
  content: "\e3b9";
}
.icon-compare_arrows:before {
  content: "\e915";
}
.icon-laptop:before {
  content: "\e31e";
}
.icon-confirmation_number:before {
  content: "\e638";
}
.icon-contact_mail:before {
  content: "\e0d0";
}
.icon-contact_phone:before {
  content: "\e0cf";
}
.icon-contacts:before {
  content: "\e0ba";
}
.icon-content_copy:before {
  content: "\e14d";
}
.icon-content_cut:before {
  content: "\e14e";
}
.icon-content_paste:before {
  content: "\e14f";
}
.icon-control_point_duplicate:before {
  content: "\e3bb";
}
.icon-copyright:before {
  content: "\e90c";
}
.icon-mode_edit:before {
  content: "\e254";
}
.icon-create_new_folder:before {
  content: "\e2cc";
}
.icon-payment:before {
  content: "\e8a1";
}
.icon-crop:before {
  content: "\e3be";
}
.icon-crop_16_9:before {
  content: "\e3bc";
}
.icon-crop_3_2:before {
  content: "\e3bd";
}
.icon-crop_landscape:before {
  content: "\e3c3";
}
.icon-crop_7_5:before {
  content: "\e3c0";
}
.icon-crop_din:before {
  content: "\e3c1";
}
.icon-crop_free:before {
  content: "\e3c2";
}
.icon-crop_original:before {
  content: "\e3c4";
}
.icon-crop_portrait:before {
  content: "\e3c5";
}
.icon-crop_rotate:before {
  content: "\e437";
}
.icon-crop_square:before {
  content: "\e3c6";
}
.icon-dashboard:before {
  content: "\e871";
}
.icon-data_usage:before {
  content: "\e1af";
}
.icon-date_range:before {
  content: "\e916";
}
.icon-dehaze:before {
  content: "\e3c7";
}
.icon-delete:before {
  content: "\e872";
}
.icon-delete_forever:before {
  content: "\e92b";
}
.icon-delete_sweep:before {
  content: "\e16c";
}
.icon-description:before {
  content: "\e873";
}
.icon-desktop_mac:before {
  content: "\e30b";
}
.icon-desktop_windows:before {
  content: "\e30c";
}
.icon-details:before {
  content: "\e3c8";
}
.icon-developer_board:before {
  content: "\e30d";
}
.icon-developer_mode:before {
  content: "\e1b0";
}
.icon-device_hub:before {
  content: "\e335";
}
.icon-phonelink:before {
  content: "\e326";
}
.icon-devices_other:before {
  content: "\e337";
}
.icon-dialer_sip:before {
  content: "\e0bb";
}
.icon-dialpad:before {
  content: "\e0bc";
}
.icon-directions:before {
  content: "\e52e";
}
.icon-directions_bike:before {
  content: "\e52f";
}
.icon-directions_boat:before {
  content: "\e532";
}
.icon-directions_bus:before {
  content: "\e530";
}
.icon-directions_car:before {
  content: "\e531";
}
.icon-directions_run:before {
  content: "\e566";
}
.icon-directions_transit:before {
  content: "\e535";
}
.icon-directions_walk:before {
  content: "\e536";
}
.icon-disc_full:before {
  content: "\e610";
}
.icon-dns:before {
  content: "\e875";
}
.icon-not_interested:before {
  content: "\e033";
}
.icon-do_not_disturb_alt:before {
  content: "\e611";
}
.icon-do_not_disturb_off:before {
  content: "\e643";
}
.icon-remove_circle:before {
  content: "\e15c";
}
.icon-dock:before {
  content: "\e30e";
}
.icon-done:before {
  content: "\e876";
}
.icon-done_all:before {
  content: "\e877";
}
.icon-donut_large:before {
  content: "\e917";
}
.icon-donut_small:before {
  content: "\e918";
}
.icon-drafts:before {
  content: "\e151";
}
.icon-drag_handle:before {
  content: "\e25d";
}
.icon-time_to_leave:before {
  content: "\e62c";
}
.icon-dvr:before {
  content: "\e1b2";
}
.icon-edit_location:before {
  content: "\e568";
}
.icon-eject:before {
  content: "\e8fb";
}
.icon-markunread:before {
  content: "\e159";
}
.icon-enhanced_encryption:before {
  content: "\e63f";
}
.icon-equalizer:before {
  content: "\e01d";
}
.icon-error:before {
  content: "\e000";
}
.icon-error_outline:before {
  content: "\e001";
}
.icon-euro_symbol:before {
  content: "\e926";
}
.icon-ev_station:before {
  content: "\e56d";
}
.icon-insert_invitation:before {
  content: "\e24f";
}
.icon-event_available:before {
  content: "\e614";
}
.icon-event_busy:before {
  content: "\e615";
}
.icon-event_note:before {
  content: "\e616";
}
.icon-event_seat:before {
  content: "\e903";
}
.icon-exit_to_app:before {
  content: "\e879";
}
.icon-expand_less:before {
  content: "\e5ce";
}
.icon-expand_more:before {
  content: "\e5cf";
}
.icon-explicit:before {
  content: "\e01e";
}
.icon-explore:before {
  content: "\e87a";
}
.icon-exposure:before {
  content: "\e3ca";
}
.icon-exposure_zero:before {
  content: "\e3cf";
}
.icon-extension:before {
  content: "\e87b";
}
.icon-face:before {
  content: "\e87c";
}
.icon-fast_forward:before {
  content: "\e01f";
}
.icon-fast_rewind:before {
  content: "\e020";
}
.icon-favorite:before {
  content: "\e87d";
}
.icon-favorite_border:before {
  content: "\e87e";
}
.icon-featured_play_list:before {
  content: "\e06d";
}
.icon-featured_video:before {
  content: "\e06e";
}
.icon-sms_failed:before {
  content: "\e626";
}
.icon-fiber_manual_record:before {
  content: "\e061";
}
.icon-fiber_new:before {
  content: "\e05e";
}
.icon-fiber_smart_record:before {
  content: "\e062";
}
.icon-get_app:before {
  content: "\e884";
}
.icon-file_upload:before {
  content: "\e2c6";
}
.icon-filter:before {
  content: "\e3d3";
}
.icon-filter_9_plus:before {
  content: "\e3da";
}
.icon-filter_b_and_w:before {
  content: "\e3db";
}
.icon-filter_center_focus:before {
  content: "\e3dc";
}
.icon-filter_drama:before {
  content: "\e3dd";
}
.icon-filter_frames:before {
  content: "\e3de";
}
.icon-terrain:before {
  content: "\e564";
}
.icon-filter_list:before {
  content: "\e152";
}
.icon-filter_none:before {
  content: "\e3e0";
}
.icon-filter_tilt_shift:before {
  content: "\e3e2";
}
.icon-filter_vintage:before {
  content: "\e3e3";
}
.icon-find_in_page:before {
  content: "\e880";
}
.icon-find_replace:before {
  content: "\e881";
}
.icon-fingerprint:before {
  content: "\e90d";
}
.icon-first_page:before {
  content: "\e5dc";
}
.icon-fitness_center:before {
  content: "\eb43";
}
.icon-flare:before {
  content: "\e3e4";
}
.icon-flash_on:before {
  content: "\e3e7";
}
.icon-flight_land:before {
  content: "\e904";
}
.icon-flight_takeoff:before {
  content: "\e905";
}
.icon-folder:before {
  content: "\e2c7";
}
.icon-folder_open:before {
  content: "\e2c8";
}
.icon-folder_shared:before {
  content: "\e2c9";
}
.icon-folder_special:before {
  content: "\e617";
}
.icon-font_download:before {
  content: "\e167";
}
.icon-format_align_center:before {
  content: "\e234";
}
.icon-format_align_justify:before {
  content: "\e235";
}
.icon-format_align_left:before {
  content: "\e236";
}
.icon-format_align_right:before {
  content: "\e237";
}
.icon-format_bold:before {
  content: "\e238";
}
.icon-format_clear:before {
  content: "\e239";
}
.icon-format_color_fill:before {
  content: "\e23a";
}
.icon-format_color_reset:before {
  content: "\e23b";
}
.icon-format_color_text:before {
  content: "\e23c";
}
.icon-format_indent_decrease:before {
  content: "\e23d";
}
.icon-format_indent_increase:before {
  content: "\e23e";
}
.icon-format_italic:before {
  content: "\e23f";
}
.icon-format_line_spacing:before {
  content: "\e240";
}
.icon-format_list_bulleted:before {
  content: "\e241";
}
.icon-format_list_numbered:before {
  content: "\e242";
}
.icon-format_paint:before {
  content: "\e243";
}
.icon-format_quote:before {
  content: "\e244";
}
.icon-format_shapes:before {
  content: "\e25e";
}
.icon-format_size:before {
  content: "\e245";
}
.icon-format_strikethrough:before {
  content: "\e246";
}
.icon-format_textdirection_l_to_r:before {
  content: "\e247";
}
.icon-format_textdirection_r_to_l:before {
  content: "\e248";
}
.icon-format_underlined:before {
  content: "\e249";
}
.icon-question_answer:before {
  content: "\e8af";
}
.icon-forward:before {
  content: "\e154";
}
.icon-forward_10:before {
  content: "\e056";
}
.icon-forward_30:before {
  content: "\e057";
}
.icon-forward_5:before {
  content: "\e058";
}
.icon-free_breakfast:before {
  content: "\eb44";
}
.icon-fullscreen:before {
  content: "\e5d0";
}
.icon-fullscreen_exit:before {
  content: "\e5d1";
}
.icon-functions:before {
  content: "\e24a";
}
.icon-g_translate:before {
  content: "\e927";
}
.icon-games:before {
  content: "\e021";
}
.icon-gavel:before {
  content: "\e90e";
}
.icon-gesture:before {
  content: "\e155";
}
.icon-gif:before {
  content: "\e908";
}
.icon-goat:before {
  content: "\e900";
}
.icon-golf_course:before {
  content: "\eb45";
}
.icon-my_location:before {
  content: "\e55c";
}
.icon-location_searching:before {
  content: "\e1b7";
}
.icon-location_disabled:before {
  content: "\e1b6";
}
.icon-star:before {
  content: "\e838";
}
.icon-gradient:before {
  content: "\e3e9";
}
.icon-grain:before {
  content: "\e3ea";
}
.icon-graphic_eq:before {
  content: "\e1b8";
}
.icon-grid_off:before {
  content: "\e3eb";
}
.icon-grid_on:before {
  content: "\e3ec";
}
.icon-people:before {
  content: "\e7fb";
}
.icon-group_add:before {
  content: "\e7f0";
}
.icon-group_work:before {
  content: "\e886";
}
.icon-hd:before {
  content: "\e052";
}
.icon-hdr_strong:before {
  content: "\e3f1";
}
.icon-hdr_weak:before {
  content: "\e3f2";
}
.icon-headset:before {
  content: "\e310";
}
.icon-healing:before {
  content: "\e3f3";
}
.icon-hearing:before {
  content: "\e023";
}
.icon-help:before {
  content: "\e887";
}
.icon-help_outline:before {
  content: "\e8fd";
}
.icon-high_quality:before {
  content: "\e024";
}
.icon-highlight:before {
  content: "\e25f";
}
.icon-highlight_off:before {
  content: "\e888";
}
.icon-restore:before {
  content: "\e8b3";
}
.icon-home:before {
  content: "\e88a";
}
.icon-hot_tub:before {
  content: "\eb46";
}
.icon-local_hotel:before {
  content: "\e549";
}
.icon-hourglass_empty:before {
  content: "\e88b";
}
.icon-hourglass_full:before {
  content: "\e88c";
}
.icon-lock:before {
  content: "\e897";
}
.icon-photo:before {
  content: "\e410";
}
.icon-image_aspect_ratio:before {
  content: "\e3f5";
}
.icon-import_contacts:before {
  content: "\e0e0";
}
.icon-import_export:before {
  content: "\e0c3";
}
.icon-important_devices:before {
  content: "\e912";
}
.icon-inbox:before {
  content: "\e156";
}
.icon-indeterminate_check_box:before {
  content: "\e909";
}
.icon-info:before {
  content: "\e88e";
}
.icon-info_outline:before {
  content: "\e88f";
}
.icon-input:before {
  content: "\e890";
}
.icon-insert_comment:before {
  content: "\e24c";
}
.icon-insert_drive_file:before {
  content: "\e24d";
}
.icon-tag_faces:before {
  content: "\e420";
}
.icon-link:before {
  content: "\e157";
}
.icon-invert_colors:before {
  content: "\e891";
}
.icon-invert_colors_off:before {
  content: "\e0c4";
}
.icon-iso:before {
  content: "\e3f6";
}
.icon-keyboard:before {
  content: "\e312";
}
.icon-keyboard_arrow_down:before {
  content: "\e313";
}
.icon-keyboard_arrow_left:before {
  content: "\e314";
}
.icon-keyboard_arrow_right:before {
  content: "\e315";
}
.icon-keyboard_arrow_up:before {
  content: "\e316";
}
.icon-keyboard_backspace:before {
  content: "\e317";
}
.icon-keyboard_capslock:before {
  content: "\e318";
}
.icon-keyboard_return:before {
  content: "\e31b";
}
.icon-keyboard_tab:before {
  content: "\e31c";
}
.icon-keyboard_voice:before {
  content: "\e31d";
}
.icon-kitchen:before {
  content: "\eb47";
}
.icon-label:before {
  content: "\e892";
}
.icon-label_outline:before {
  content: "\e893";
}
.icon-language:before {
  content: "\e894";
}
.icon-laptop_chromebook:before {
  content: "\e31f";
}
.icon-laptop_mac:before {
  content: "\e320";
}
.icon-last_page:before {
  content: "\e5dd";
}
.icon-open_in_new:before {
  content: "\e89e";
}
.icon-layers:before {
  content: "\e53b";
}
.icon-layers_clear:before {
  content: "\e53c";
}
.icon-leak_add:before {
  content: "\e3f8";
}
.icon-lens:before {
  content: "\e3fa";
}
.icon-library_books:before {
  content: "\e02f";
}
.icon-library_music:before {
  content: "\e030";
}
.icon-lightbulb_outline:before {
  content: "\e90f";
}
.icon-line_weight:before {
  content: "\e91a";
}
.icon-linear_scale:before {
  content: "\e260";
}
.icon-linked_camera:before {
  content: "\e438";
}
.icon-list:before {
  content: "\e896";
}
.icon-live_help:before {
  content: "\e0c6";
}
.icon-live_tv:before {
  content: "\e639";
}
.icon-local_play:before {
  content: "\e553";
}
.icon-local_airport:before {
  content: "\e53d";
}
.icon-local_atm:before {
  content: "\e53e";
}
.icon-local_bar:before {
  content: "\e540";
}
.icon-local_cafe:before {
  content: "\e541";
}
.icon-local_car_wash:before {
  content: "\e542";
}
.icon-local_convenience_store:before {
  content: "\e543";
}
.icon-restaurant_menu:before {
  content: "\e561";
}
.icon-local_drink:before {
  content: "\e544";
}
.icon-local_florist:before {
  content: "\e545";
}
.icon-local_gas_station:before {
  content: "\e546";
}
.icon-shopping_cart:before {
  content: "\e8cc";
}
.icon-local_hospital:before {
  content: "\e548";
}
.icon-local_laundry_service:before {
  content: "\e54a";
}
.icon-local_library:before {
  content: "\e54b";
}
.icon-local_mall:before {
  content: "\e54c";
}
.icon-theaters:before {
  content: "\e8da";
}
.icon-local_offer:before {
  content: "\e54e";
}
.icon-local_parking:before {
  content: "\e54f";
}
.icon-local_pharmacy:before {
  content: "\e550";
}
.icon-local_pizza:before {
  content: "\e552";
}
.icon-print:before {
  content: "\e8ad";
}
.icon-local_shipping:before {
  content: "\e558";
}
.icon-local_taxi:before {
  content: "\e559";
}
.icon-location_city:before {
  content: "\e7f1";
}
.icon-location_off:before {
  content: "\e0c7";
}
.icon-room:before {
  content: "\e8b4";
}
.icon-lock_open:before {
  content: "\e898";
}
.icon-lock_outline:before {
  content: "\e899";
}
.icon-looks:before {
  content: "\e3fc";
}
.icon-sync:before {
  content: "\e627";
}
.icon-loupe:before {
  content: "\e402";
}
.icon-low_priority:before {
  content: "\e16d";
}
.icon-loyalty:before {
  content: "\e89a";
}
.icon-mail_outline:before {
  content: "\e0e1";
}
.icon-map:before {
  content: "\e55b";
}
.icon-markunread_mailbox:before {
  content: "\e89b";
}
.icon-memory:before {
  content: "\e322";
}
.icon-menu:before {
  content: "\e5d2";
}
.icon-message:before {
  content: "\e0c9";
}
.icon-mic:before {
  content: "\e029";
}
.icon-mic_none:before {
  content: "\e02a";
}
.icon-mic_off:before {
  content: "\e02b";
}
.icon-mms:before {
  content: "\e618";
}
.icon-mode_comment:before {
  content: "\e253";
}
.icon-monetization_on:before {
  content: "\e263";
}
.icon-money_off:before {
  content: "\e25c";
}
.icon-monochrome_photos:before {
  content: "\e403";
}
.icon-mood_bad:before {
  content: "\e7f3";
}
.icon-more:before {
  content: "\e619";
}
.icon-more_horiz:before {
  content: "\e5d3";
}
.icon-more_vert:before {
  content: "\e5d4";
}
.icon-motorcycle:before {
  content: "\e91b";
}
.icon-mouse:before {
  content: "\e323";
}
.icon-move_to_inbox:before {
  content: "\e168";
}
.icon-movie_creation:before {
  content: "\e404";
}
.icon-movie_filter:before {
  content: "\e43a";
}
.icon-multiline_chart:before {
  content: "\e6df";
}
.icon-music_note:before {
  content: "\e405";
}
.icon-music_video:before {
  content: "\e063";
}
.icon-nature:before {
  content: "\e406";
}
.icon-nature_people:before {
  content: "\e407";
}
.icon-navigation:before {
  content: "\e55d";
}
.icon-near_me:before {
  content: "\e569";
}
.icon-network_cell:before {
  content: "\e1b9";
}
.icon-network_check:before {
  content: "\e640";
}
.icon-new_releases:before {
  content: "\e031";
}
.icon-next_week:before {
  content: "\e16a";
}
.icon-nfc:before {
  content: "\e1bb";
}
.icon-no_encryption:before {
  content: "\e641";
}
.icon-note:before {
  content: "\e06f";
}
.icon-note_add:before {
  content: "\e89c";
}
.icon-notifications:before {
  content: "\e7f4";
}
.icon-notifications_active:before {
  content: "\e7f7";
}
.icon-notifications_none:before {
  content: "\e7f5";
}
.icon-notifications_off:before {
  content: "\e7f6";
}
.icon-notifications_paused:before {
  content: "\e7f8";
}
.icon-offline_pin:before {
  content: "\e90a";
}
.icon-ondemand_video:before {
  content: "\e63a";
}
.icon-opacity:before {
  content: "\e91c";
}
.icon-open_in_browser:before {
  content: "\e89d";
}
.icon-open_with:before {
  content: "\e89f";
}
.icon-pages:before {
  content: "\e7f9";
}
.icon-pageview:before {
  content: "\e8a0";
}
.icon-pan_tool:before {
  content: "\e925";
}
.icon-panorama:before {
  content: "\e40b";
}
.icon-radio_button_unchecked:before {
  content: "\e836";
}
.icon-panorama_horizontal:before {
  content: "\e40d";
}
.icon-panorama_vertical:before {
  content: "\e40e";
}
.icon-panorama_wide_angle:before {
  content: "\e40f";
}
.icon-party_mode:before {
  content: "\e7fa";
}
.icon-pause:before {
  content: "\e034";
}
.icon-pause_circle_filled:before {
  content: "\e035";
}
.icon-pause_circle_outline:before {
  content: "\e036";
}
.icon-people_outline:before {
  content: "\e7fc";
}
.icon-perm_camera_mic:before {
  content: "\e8a2";
}
.icon-perm_contact_calendar:before {
  content: "\e8a3";
}
.icon-perm_device_information:before {
  content: "\e8a5";
}
.icon-person_outline:before {
  content: "\e7ff";
}
.icon-perm_media:before {
  content: "\e8a7";
}
.icon-person:before {
  content: "\e7fd";
}
.icon-person_add:before {
  content: "\e7fe";
}
.icon-person_pin:before {
  content: "\e55a";
}
.icon-person_pin_circle:before {
  content: "\e56a";
}
.icon-personal_video:before {
  content: "\e63b";
}
.icon-pets:before {
  content: "\e91d";
}
.icon-phone_android:before {
  content: "\e324";
}
.icon-phone_bluetooth_speaker:before {
  content: "\e61b";
}
.icon-phone_forwarded:before {
  content: "\e61c";
}
.icon-phone_in_talk:before {
  content: "\e61d";
}
.icon-phone_iphone:before {
  content: "\e325";
}
.icon-phone_locked:before {
  content: "\e61e";
}
.icon-phone_missed:before {
  content: "\e61f";
}
.icon-phone_paused:before {
  content: "\e620";
}
.icon-phonelink_erase:before {
  content: "\e0db";
}
.icon-phonelink_lock:before {
  content: "\e0dc";
}
.icon-phonelink_off:before {
  content: "\e327";
}
.icon-phonelink_ring:before {
  content: "\e0dd";
}
.icon-phonelink_setup:before {
  content: "\e0de";
}
.icon-photo_album:before {
  content: "\e411";
}
.icon-photo_size_select_actual:before {
  content: "\e432";
}
.icon-picture_in_picture:before {
  content: "\e8aa";
}
.icon-picture_in_picture_alt:before {
  content: "\e911";
}
.icon-pie_chart:before {
  content: "\e6c4";
}
.icon-pie_chart_outlined:before {
  content: "\e6c5";
}
.icon-pin_drop:before {
  content: "\e55e";
}
.icon-play_arrow:before {
  content: "\e037";
}
.icon-play_circle_filled:before {
  content: "\e038";
}
.icon-play_circle_outline:before {
  content: "\e039";
}
.icon-play_for_work:before {
  content: "\e906";
}
.icon-playlist_add:before {
  content: "\e03b";
}
.icon-playlist_add_check:before {
  content: "\e065";
}
.icon-playlist_play:before {
  content: "\e05f";
}
.icon-polymer:before {
  content: "\e8ab";
}
.icon-pool:before {
  content: "\eb48";
}
.icon-portable_wifi_off:before {
  content: "\e0ce";
}
.icon-portrait:before {
  content: "\e416";
}
.icon-power:before {
  content: "\e63c";
}
.icon-power_input:before {
  content: "\e336";
}
.icon-power_settings_new:before {
  content: "\e8ac";
}
.icon-pregnant_woman:before {
  content: "\e91e";
}
.icon-present_to_all:before {
  content: "\e0df";
}
.icon-priority_high:before {
  content: "\e645";
}
.icon-public:before {
  content: "\e80b";
}
.icon-publish:before {
  content: "\e255";
}
.icon-queue_music:before {
  content: "\e03d";
}
.icon-queue_play_next:before {
  content: "\e066";
}
.icon-radio:before {
  content: "\e03e";
}
.icon-radio_button_checked:before {
  content: "\e837";
}
.icon-rate_review:before {
  content: "\e560";
}
.icon-receipt:before {
  content: "\e8b0";
}
.icon-recent_actors:before {
  content: "\e03f";
}
.icon-record_voice_over:before {
  content: "\e91f";
}
.icon-redo:before {
  content: "\e15a";
}
.icon-refresh:before {
  content: "\e5d5";
}
.icon-remove:before {
  content: "\e15b";
}
.icon-remove_circle_outline:before {
  content: "\e15d";
}
.icon-remove_from_queue:before {
  content: "\e067";
}
.icon-visibility:before {
  content: "\e8f4";
}
.icon-remove_shopping_cart:before {
  content: "\e928";
}
.icon-reorder:before {
  content: "\e8fe";
}
.icon-repeat:before {
  content: "\e040";
}
.icon-replay:before {
  content: "\e042";
}
.icon-replay_30:before {
  content: "\e05a";
}
.icon-replay_5:before {
  content: "\e05b";
}
.icon-reply:before {
  content: "\e15e";
}
.icon-reply_all:before {
  content: "\e15f";
}
.icon-report:before {
  content: "\e160";
}
.icon-warning:before {
  content: "\e002";
}
.icon-restaurant:before {
  content: "\e56c";
}
.icon-restore_page:before {
  content: "\e929";
}
.icon-ring_volume:before {
  content: "\e0d1";
}
.icon-room_service:before {
  content: "\eb49";
}
.icon-rotate_90_degrees_ccw:before {
  content: "\e418";
}
.icon-rotate_left:before {
  content: "\e419";
}
.icon-rotate_right:before {
  content: "\e41a";
}
.icon-router:before {
  content: "\e328";
}
.icon-rowing:before {
  content: "\e921";
}
.icon-rss_feed:before {
  content: "\e0e5";
}
.icon-rv_hookup:before {
  content: "\e642";
}
.icon-satellite:before {
  content: "\e562";
}
.icon-save:before {
  content: "\e161";
}
.icon-scanner:before {
  content: "\e329";
}
.icon-school:before {
  content: "\e80c";
}
.icon-screen_lock_landscape:before {
  content: "\e1be";
}
.icon-screen_lock_portrait:before {
  content: "\e1bf";
}
.icon-screen_share:before {
  content: "\e0e2";
}
.icon-search:before{
  content: "\e8b6";
}
.icon-security:before {
  content: "\e32a";
}
.icon-select_all:before {
  content: "\e162";
}
.icon-send:before {
  content: "\e163";
}
.icon-sentiment_dissatisfied:before {
  content: "\e811";
}
.icon-sentiment_neutral:before {
  content: "\e812";
}
.icon-sentiment_satisfied:before {
  content: "\e813";
}
.icon-sentiment_very_dissatisfied:before {
  content: "\e814";
}
.icon-sentiment_very_satisfied:before {
  content: "\e815";
}
.icon-settings:before {
  content: "\e8b8";
}
.icon-settings_applications:before {
  content: "\e8b9";
}
.icon-settings_backup_restore:before {
  content: "\e8ba";
}
.icon-settings_brightness:before {
  content: "\e8bd";
}
.icon-settings_cell:before {
  content: "\e8bc";
}
.icon-settings_ethernet:before {
  content: "\e8be";
}
.icon-settings_input_antenna:before {
  content: "\e8bf";
}
.icon-settings_input_composite:before {
  content: "\e8c1";
}
.icon-settings_input_hdmi:before {
  content: "\e8c2";
}
.icon-settings_input_svideo:before {
  content: "\e8c3";
}
.icon-settings_overscan:before {
  content: "\e8c4";
}
.icon-settings_phone:before {
  content: "\e8c5";
}
.icon-settings_power:before {
  content: "\e8c6";
}
.icon-settings_remote:before {
  content: "\e8c7";
}
.icon-settings_system_daydream:before {
  content: "\e1c3";
}
.icon-settings_voice:before {
  content: "\e8c8";
}
.icon-share:before {
  content: "\e80d";
}
.icon-shop:before {
  content: "\e8c9";
}
.icon-shop_two:before {
  content: "\e8ca";
}
.icon-shopping_basket:before {
  content: "\e8cb";
}
.icon-short_text:before {
  content: "\e261";
}
.icon-show_chart:before {
  content: "\e6e1";
}
.icon-shuffle:before {
  content: "\e043";
}
.icon-signal_cellular_4_bar:before {
  content: "\e1c8";
}
.icon-signal_wifi_4_bar:before {
  content: "\e1d8";
}
.icon-skip_next:before {
  content: "\e044";
}
.icon-skip_previous:before {
  content: "\e045";
}
.icon-slideshow:before {
  content: "\e41b";
}
.icon-slow_motion_video:before {
  content: "\e068";
}
.icon-stay_primary_portrait:before {
  content: "\e0d6";
}
.icon-smoke_free:before {
  content: "\eb4a";
}
.icon-smoking_rooms:before {
  content: "\eb4b";
}
.icon-textsms:before {
  content: "\e0d8";
}
.icon-snooze:before {
  content: "\e046";
}
.icon-sort:before {
  content: "\e164";
}
.icon-sort_by_alpha:before {
  content: "\e053";
}
.icon-spa:before {
  content: "\eb4c";
}
.icon-space_bar:before {
  content: "\e256";
}
.icon-speaker:before {
  content: "\e32d";
}
.icon-speaker_group:before {
  content: "\e32e";
}
.icon-speaker_notes:before {
  content: "\e8cd";
}
.icon-speaker_phone:before {
  content: "\e0d2";
}
.icon-spellcheck:before {
  content: "\e8ce";
}
.icon-star_border:before {
  content: "\e83a";
}
.icon-star_half:before {
  content: "\e839";
}
.icon-stars:before {
  content: "\e8d0";
}
.icon-stay_primary_landscape:before {
  content: "\e0d5";
}
.icon-stop:before {
  content: "\e047";
}
.icon-stop_screen_share:before {
  content: "\e0e3";
}
.icon-storage:before {
  content: "\e1db";
}
.icon-store_mall_directory:before {
  content: "\e563";
}
.icon-straighten:before {
  content: "\e41c";
}
.icon-streetview:before {
  content: "\e56e";
}
.icon-strikethrough_s:before {
  content: "\e257";
}
.icon-style:before {
  content: "\e41d";
}
.icon-subdirectory_arrow_left:before {
  content: "\e5d9";
}
.icon-subdirectory_arrow_right:before {
  content: "\e5da";
}
.icon-subject:before {
  content: "\e8d2";
}
.icon-subscriptions:before {
  content: "\e064";
}
.icon-subtitles:before {
  content: "\e048";
}
.icon-subway:before {
  content: "\e56f";
}
.icon-supervisor_account:before {
  content: "\e8d3";
}
.icon-surround_sound:before {
  content: "\e049";
}
.icon-swap_calls:before {
  content: "\e0d7";
}
.icon-swap_horiz:before {
  content: "\e8d4";
}
.icon-swap_vert:before {
  content: "\e8d5";
}
.icon-swap_vertical_circle:before {
  content: "\e8d6";
}
.icon-switch_camera:before {
  content: "\e41e";
}
.icon-switch_video:before {
  content: "\e41f";
}
.icon-sync_problem:before {
  content: "\e629";
}
.icon-system_update:before {
  content: "\e62a";
}
.icon-system_update_alt:before {
  content: "\e8d7";
}
.icon-tab:before {
  content: "\e8d8";
}
.icon-tablet:before {
  content: "\e32f";
}
.icon-tablet_android:before {
  content: "\e330";
}
.icon-tablet_mac:before {
  content: "\e331";
}
.icon-text_fields:before {
  content: "\e262";
}
.icon-text_format:before {
  content: "\e165";
}
.icon-texture:before {
  content: "\e421";
}
.icon-thumb_down:before {
  content: "\e8db";
}
.icon-thumb_up:before {
  content: "\e8dc";
}
.icon-thumbs_up_down:before {
  content: "\e8dd";
}
.icon-timelapse:before {
  content: "\e422";
}
.icon-timeline:before {
  content: "\e922";
}
.icon-timer:before {
  content: "\e425";
}
.icon-timer_off:before {
  content: "\e426";
}
.icon-title:before {
  content: "\e264";
}
.icon-toc:before {
  content: "\e8de";
}
.icon-today:before {
  content: "\e8df";
}
.icon-toll:before {
  content: "\e8e0";
}
.icon-tonality:before {
  content: "\e427";
}
.icon-touch_app:before {
  content: "\e913";
}
.icon-toys:before {
  content: "\e332";
}
.icon-track_changes:before {
  content: "\e8e1";
}
.icon-traffic:before {
  content: "\e565";
}
.icon-train:before {
  content: "\e570";
}
.icon-tram:before {
  content: "\e571";
}
.icon-transfer_within_a_station:before {
  content: "\e572";
}
.icon-transform:before {
  content: "\e428";
}
.icon-translate:before {
  content: "\e8e2";
}
.icon-trending_down:before {
  content: "\e8e3";
}
.icon-trending_flat:before {
  content: "\e8e4";
}
.icon-trending_up:before {
  content: "\e8e5";
}
.icon-tune:before {
  content: "\e429";
}
.icon-tv:before {
  content: "\e333";
}
.icon-unarchive:before {
  content: "\e169";
}
.icon-undo:before {
  content: "\e166";
}
.icon-unfold_less:before {
  content: "\e5d6";
}
.icon-unfold_more:before {
  content: "\e5d7";
}
.icon-update:before {
  content: "\e923";
}
.icon-usb:before {
  content: "\e1e0";
}
.icon-verified_user:before {
  content: "\e8e8";
}
.icon-vertical_align_bottom:before {
  content: "\e258";
}
.icon-vertical_align_center:before {
  content: "\e259";
}
.icon-vertical_align_top:before {
  content: "\e25a";
}
.icon-vibration:before {
  content: "\e62d";
}
.icon-video_call:before {
  content: "\e070";
}
.icon-video_label:before {
  content: "\e071";
}
.icon-video_library:before {
  content: "\e04a";
}
.icon-videocam:before {
  content: "\e04b";
}
.icon-videocam_off:before {
  content: "\e04c";
}
.icon-videogame_asset:before {
  content: "\e338";
}
.icon-view_agenda:before {
  content: "\e8e9";
}
.icon-view_array:before {
  content: "\e8ea";
}
.icon-view_carousel:before {
  content: "\e8eb";
}
.icon-view_column:before {
  content: "\e8ec";
}
.icon-view_comfy:before {
  content: "\e42a";
}
.icon-view_compact:before {
  content: "\e42b";
}
.icon-view_day:before {
  content: "\e8ed";
}
.icon-view_headline:before {
  content: "\e8ee";
}
.icon-view_list:before {
  content: "\e8ef";
}
.icon-view_module:before {
  content: "\e8f0";
}
.icon-view_quilt:before {
  content: "\e8f1";
}
.icon-view_stream:before {
  content: "\e8f2";
}
.icon-view_week:before {
  content: "\e8f3";
}
.icon-vignette:before {
  content: "\e435";
}
.icon-visibility_off:before {
  content: "\e8f5";
}
.icon-voice_chat:before {
  content: "\e62e";
}
.icon-voicemail:before {
  content: "\e0d9";
}
.icon-vpn_key:before {
  content: "\e0da";
}
.icon-vpn_lock:before {
  content: "\e62f";
}
.icon-wallpaper:before {
  content: "\e1bc";
}
.icon-watch:before {
  content: "\e334";
}
.icon-watch_later:before {
  content: "\e924";
}
.icon-wb_auto:before {
  content: "\e42c";
}
.icon-wb_incandescent:before {
  content: "\e42e";
}
.icon-wb_iridescent:before {
  content: "\e436";
}
.icon-wb_sunny:before {
  content: "\e430";
}
.icon-wc:before {
  content: "\e63d";
}
.icon-web:before {
  content: "\e051";
}
.icon-web_asset:before {
  content: "\e069";
}
.icon-weekend:before {
  content: "\e16b";
}
.icon-whatshot:before {
  content: "\e80e";
}
.icon-widgets:before {
  content: "\e1bd";
}
.icon-wifi:before {
  content: "\e63e";
}
.icon-work:before {
  content: "\e8f9";
}
.icon-wrap_text:before {
  content: "\e25b";
}
.icon-youtube_searched_for:before {
  content: "\e8fa";
}
.icon-zoom_in:before {
  content: "\e8ff";
}
.icon-zoom_out:before {
  content: "\e901";
}
.icon-zoom_out_map:before {
  content: "\e56b";
}





/****
* RTL Styles
*****/
    <?php  if( is_rtl() ) {?> <?php } ?>









