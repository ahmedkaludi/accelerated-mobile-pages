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
 <?php } else { ?> background: #333; <?php } ?>
    width: 65%;
    padding-left:5%;
    padding-right:5%;
}
<?php if($redux_builder_amp['swift-header-overlay-width-control']){?>
amp-sidebar {
    width: 100%;
    padding-right: 20%;
    padding-left: 10%;
}
<?php } ?>
    /* AMP Sidebar Toggle button */
    .amp-sidebar-button{
        position:relative;
    }
    .amp-sidebar-toggle  {
    }
    .amp-sidebar-toggle span  {
        display: block;
        height: 2px;
        margin-bottom: 5px;
        width: 22px;
        background: #000;
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
    .header{
        width:100%;
        <?php if($redux_builder_amp['swift-background-scheme']['rgba']){?>
        background: <?php echo $redux_builder_amp['swift-background-scheme'] ['rgba'] ?>;
         <?php } else { ?> background:rgba(255,61,37,1); <?php } ?>
        <?php if($redux_builder_amp['swift-border-checkbox-control']){?>
            border-bottom: 1px solid rgba(0,0,0,0.12);
        <?php } ?>
        <?php if($redux_builder_amp['swift-boxshadow-checkbox-control']){?>
            box-shadow:0px 0px 2px 2px #ccc;
        <?php }?>
        <?php if($redux_builder_amp['swift-padding-control']){?>
             padding: <?php echo $redux_builder_amp['swift-padding-control']?>;
        <?php } else { ?> padding:0px 0px 0px 0px; <?php } ?>
        <?php if($redux_builder_amp['swift-margin-control']){?>
            margin: <?php echo $redux_builder_amp['swift-margin-control']?>;
        <?php } else { ?> margin:0px 0px 0px 0px; <?php } ?>
    }
    .head, .head-2{
        width:100%;
        clear:both;
        display: inline-flex;
        <?php if($redux_builder_amp['swift-height-control']){?>
            height:<?php echo $redux_builder_amp['swift-height-control']?>;
        <?php } else { ?> height:60px; <?php } ?>
    }
    .h-nav{
        display: flex;
        flex: 1 45%;
        align-self: center;
    }
    .logo{
        z-index: 2;
        display: flex;
        flex: 1 50%;
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
    .srch{
        z-index: 1;
        line-height: 0;
        display: flex;
        flex: 0 0%;
        align-self: center;
    }
.amp-sidebar-close:after{cursor:pointer;content:"";background-image:url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ3Ljk3MSA0Ny45NzEiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ3Ljk3MSA0Ny45NzE7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPGc+Cgk8cGF0aCBkPSJNMjguMjI4LDIzLjk4Nkw0Ny4wOTIsNS4xMjJjMS4xNzItMS4xNzEsMS4xNzItMy4wNzEsMC00LjI0MmMtMS4xNzItMS4xNzItMy4wNy0xLjE3Mi00LjI0MiwwTDIzLjk4NiwxOS43NDRMNS4xMjEsMC44OCAgIGMtMS4xNzItMS4xNzItMy4wNy0xLjE3Mi00LjI0MiwwYy0xLjE3MiwxLjE3MS0xLjE3MiwzLjA3MSwwLDQuMjQybDE4Ljg2NSwxOC44NjRMMC44NzksNDIuODVjLTEuMTcyLDEuMTcxLTEuMTcyLDMuMDcxLDAsNC4yNDIgICBDMS40NjUsNDcuNjc3LDIuMjMzLDQ3Ljk3LDMsNDcuOTdzMS41MzUtMC4yOTMsMi4xMjEtMC44NzlsMTguODY1LTE4Ljg2NEw0Mi44NSw0Ny4wOTFjMC41ODYsMC41ODYsMS4zNTQsMC44NzksMi4xMjEsMC44NzkgICBzMS41MzUtMC4yOTMsMi4xMjEtMC44NzljMS4xNzItMS4xNzEsMS4xNzItMy4wNzEsMC00LjI0MkwyOC4yMjgsMjMuOTg2eiIgZmlsbD0iI0ZGRkZGRiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=);background-size:18px;display:inline-block;width:18px;height:18px;background-repeat:no-repeat;position:relative;top:10px}
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
        background: rgba(0,0,0,.9);
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
    a.lb-x:before {
        content: "";
        display: block;
        height: 30px;
        width: 2px;
        background: #ffffff;
        position: absolute;
        left: 26px;
        top:10px;
        -webkit-transform:rotate(45deg);
        -moz-transform:rotate(45deg);
        -o-transform:rotate(45deg);
        transform:rotate(45deg);
    }
    a.lb-x:after {
        content: "";
        display: block;
        height: 30px;
        width: 2px;
        background: #ffffff;
        position: absolute;
        left: 26px;
        top:10px;
        -webkit-transform:rotate(-45deg);
        -moz-transform:rotate(-45deg);
        -o-transform:rotate(-45deg);
        transform:rotate(-45deg);
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
        top: 0px;
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
    .lb-btn form #amp-search-submit {
        cursor: pointer;
        background:transparent url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU2Ljk2NiA1Ni45NjYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU2Ljk2NiA1Ni45NjY7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPHBhdGggZD0iTTU1LjE0Niw1MS44ODdMNDEuNTg4LDM3Ljc4NmMzLjQ4Ni00LjE0NCw1LjM5Ni05LjM1OCw1LjM5Ni0xNC43ODZjMC0xMi42ODItMTAuMzE4LTIzLTIzLTIzcy0yMywxMC4zMTgtMjMsMjMgIHMxMC4zMTgsMjMsMjMsMjNjNC43NjEsMCw5LjI5OC0xLjQzNiwxMy4xNzctNC4xNjJsMTMuNjYxLDE0LjIwOGMwLjU3MSwwLjU5MywxLjMzOSwwLjkyLDIuMTYyLDAuOTIgIGMwLjc3OSwwLDEuNTE4LTAuMjk3LDIuMDc5LTAuODM3QzU2LjI1NSw1NC45ODIsNTYuMjkzLDUzLjA4LDU1LjE0Niw1MS44ODd6IE0yMy45ODQsNmM5LjM3NCwwLDE3LDcuNjI2LDE3LDE3cy03LjYyNiwxNy0xNywxNyAgcy0xNy03LjYyNi0xNy0xN1MxNC42MSw2LDIzLjk4NCw2eiIgZmlsbD0iI0ZGRkZGRiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
        border: none;
        text-indent: -999px;
        background-size: 18px;
        display: inline-block;
        width: 20px;
        height: 20px;
        background-repeat: no-repeat;
        opacity: 0.7;
        position: relative;
        top: 12px;
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
.header-2{
    width:100%;
}
.h-logo{
    display: flex;
    flex: 1 50%;
    align-self: center;
}
.h-sing{
    font-size: 18px;
    font-weight: 600;
    display: flex;
    flex: 0 17%;
    align-self: center;
}
.h-sing a{
    border:2px solid #000;
    padding:10px 25px;
    color:#333;
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
    max-width: 1024px;
    overflow-x: scroll;
    overflow-y:hidden;
    white-space: nowrap;
    padding:0px 24px;
}
::-webkit-scrollbar {
display: none;
}
.p-menu ul{
    margin:30px 0px 0px 0px;
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
    color:#666;
    text-transform:uppercase;
}
.p-menu ul li:hover a{
    color:#005be2;
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
.p-menu{
    padding:0 40px;
}
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
.p-menu{
    padding: 0 20px;
}
.p-menu ul{
    margin:25px 0px 0px 0px;
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

}
/****
* RTL Styles
*****/
    <?php  if( is_rtl() ) {?> <?php } ?>









