<?php global $redux_builder_amp; ?>
/* Global Styling */
body{
	background: #f1f1f1;
    font: 16px/1.4 Sans-serif;
}
a { 
	color: #312C7E;
	text-decoration: none
}
.clearfix, .cb{
    clear: both
}

/* Template Styles */
.amp-wp-content, .amp-wp-title-bar div {
	<?php $content_max_width = absint( $this->get( 'content_max_width' ) ); ?>
	<?php if ( $content_max_width > 0 ) : ?>
	max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
	margin: 0 auto;
	<?php endif; ?>
}

/* Slide Navigation code */
.nav_container{
    padding: 18px 15px;
    background: #312C7E;
    color: #fff;
    text-align: center
}
amp-sidebar {
  width: 250px; 
}
.amp-sidebar-image {
  line-height: 100px;
  vertical-align:middle;
}
.amp-close-image {
   top: 15px;
   left: 225px;
   cursor: pointer;
}

.toggle-navigationv2 ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
} 
.toggle-navigationv2 ul ul li a  {
    padding-left: 35px;
    background: #fff;
    display: inline-block
}
.toggle-navigationv2 ul li a{
    padding: 15px 25px;
    width: 100%;
    display: inline-block;
    background: #fafafa;
    font-size: 14px;
    border-bottom: 1px solid #efefef;
}
.close-nav{
    font-size: 12px;
    background: rgba(0, 0, 0, 0.25);
    letter-spacing: 1px;
    display: inline-block;
    padding: 10px;
    border-radius: 100px;
    line-height: 8px;
    margin: 14px;
    left: 191px;
    color: #fff;
}
.close-nav:hover{
    background: rgba(0, 0, 0, 0.45);
}
.toggle-navigation ul{
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: inline-block;
    width: 100%
}
.menu-all-pages-container:after{
    content: "";
    clear: both
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
.toggle-text{
    color: #fff;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 3px;
    display: inherit;
    text-align: center;
}
.toggle-text:before{
    content: "...";
    font-size: 32px;
    position: ;
    font-family: georgia;
    line-height: 0px;
    margin-left: 0px;
    letter-spacing: 1px;
    top: -3px;
    position: relative;
    padding-right: 10px;
}
.nav_container:hover + .toggle-navigation,
.toggle-navigation:hover,
.toggle-navigation:active,
.toggle-navigation:focus{
    display: inline-block;
    width: 100%;
} 


/* Pagination */
.amp-wp-content.pagination-holder {
    background: none;
    padding: 0;
    box-shadow: none;
    height: auto;
    min-height: auto;
}
#pagination{ 
    width: 100%;
    margin-top: 15px;
}
#pagination .next{
    float: right;
    margin-bottom: 22px;
}
#pagination .prev{
    float: left
}
#pagination .next a, #pagination .prev a{
    margin-bottom: 12px;
    background: #fefefe;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    box-shadow: 0 2px 3px rgba(0,0,0,.05);
    padding: 11px 15px;
    font-size: 12px; 
    color: #666;
}

/* Sticky Social bar in Single */
.sticky_social{
    width: 100%;
    bottom: 0;
    display: block;
    left: 0;
    box-shadow: 0px 4px 7px #000;
    background: #fff;
    padding: 7px 0px 0px 0px;
    position: fixed;
    margin: 0;
    z-index: 999;
    text-align: center;
}



/* Header */
#header{
    background: #fff;
    text-align: center; 
}
#header h1{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    line-height: 1;
    padding: 15px;
    margin: 0;
}
.amp-logo{
    margin: 15px 0px 10px 0px; 
} 

main  {
   padding: 30px 15% 10px 15%;
}
main .amp-wp-content{
    margin-bottom: 12px;
    background: #fefefe;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    box-shadow: 0 2px 3px rgba(0,0,0,.05);
    padding: 15px; 
}
.home-post_image {
    float: right;
    margin-left: 15px;
    margin-bottom: -6px;
}
.amp-wp-title {
    margin-top: 0px;
}
h2.amp-wp-title {
    line-height: 30px;
}
h2.amp-wp-title a{
    font-weight: 300;
    color: #000;
    font-size: 20px;
}
h2.amp-wp-title , .amp-wp-post-content p{
    margin: 0 0 0 5px;
}
.amp-wp-post-content p{
    font-size: 12px;
    color: #999;
    line-height: 20px;
    margin: 3px 0 0 5px;
}


/* Footer */ 
#footer{
    background : #fff;
    font-size: 13px;
    text-align: center;
    letter-spacing: 0.2px;
    padding: 20px 0;
}
#footer p:first-child{
    margin-bottom: 12px;
}
#footer p{
    margin: 0
}



/* Single */ 
h1.amp-wp-title {
    text-align: center;
    margin: 20px 0px 18px 0px;
    font-size: 1.5em;
}
.amp-wp-content.post-title-meta, 
.amp-wp-content.post-pagination-meta {
    background: none; 
    padding:  0;
    box-shadow:none
}
.post-pagination-meta{
    min-height:75px
}
.post-pagination-meta .amp-wp-tax-category,
.post-title-meta .amp-wp-tax-tag {
    display : none; 
}
.amp-wp-meta  {
    padding-left: 0;
}
.amp-wp-tax-category {
    float:right
}
.amp-wp-tax-tag,
.amp-wp-meta li {
    list-style: none;
    display: inline-block;
}
li.amp-wp-tax-category {
    float: right
}
.amp-wp-byline, .amp-wp-posted-on {
    float: left
}
 
.amp-wp-content amp-img {
    max-width: 100%;
}
.amp-wp-byline amp-img {
    display: none;
}
.amp-wp-author:before {
    content: "By ";
    color: #555;
}
.amp-wp-author{
    margin-right: 5px;
}
.amp-wp-meta {
    font-size: 12px;
    padding-bottom: 10px;
    color: #555;
    border-bottom: 1px solid #DADADA;

}
.amp-ad-wrapper {
    text-align: center
}
.single-post main{
    padding:12px 15% 10px 15%
} 
.the_content p{
    margin-top: 5px;
    color: #333;
    font-size: 15px;
    line-height: 26px;
    margin-bottom: 15px;
}
.amp-wp-tax-tag{
    font-size:13px;
}
main .amp-wp-content.featured-image-content {
	padding: 0px;
	border: 0;
	margin-bottom: 0;
	box-shadow: none
}

/* ADS */
.amp_ad_1{
    margin-top: -15px;
    margin-bottom:10px
}
.single-post .amp_ad_1{
    margin-top:0
}
.amp-ad-4{
    margin-top:10px;
}

/* Notifications */
#amp-user-notification1 p {
    display: inline-block;
}
amp-user-notification {
    padding: 5px;
    text-align: center;
    background: #fff;
    border-top: 1px solid;
}
amp-user-notification button {
    padding: 8px 10px;
    background: #000;
    color: #fff;
    margin-left: 5px;
		border: 0;
}
amp-user-notification button:hover {
	cursor: pointer
}

/* Responsive */
    @media screen and (max-width: 800px) { 
        .single-post main{
            padding: 12px 10px 10px 10px
        }
    }
    @media screen and (max-width: 340px) {
        .single-post main{
            padding: 12px 0px 10px 0px
        }
        .the_content .amp-ad-wrapper{
            text-align: center;
            margin-left: -13px;
        }
    }

@media screen and (max-width: 400px) { 
    .amp-wp-title{
        font-size: 19px;
        margin: 21px 10px -1px 10px;
    }
}
    @media screen and (max-width: 767px) {
           .amp-wp-post-content p{
                 display: block
            }
           .amp-wp-post-content p{
               display: none
            } 
        
            main{
                padding: 25px 18px 25px 18px;      
            }
        .toggle-navigation ul li{
            width: 50%
        }
        }
    @media screen and (max-width: 495px) {
        h2.amp-wp-title a{
            font-size: 17px;
            line-height: 26px;
        } 
    }

<?php if($redux_builder_amp['amp-rtl-select-option'] == true) { ?>
/* RTL Start */
.nav_container, .toggle-navigationv2, .amp-loop-list, #pagination, #footer, .amp-wp-meta, .amp-wp-title, .single-post .the_content, .amp-wp-tax-tag, .sticky_social{
    direction:rtl
}
main .amp-loop-list {
    padding-right:20px
}
.amp-loop-list .home-post_image{
    float:left;
    margin-left:0;
    margin-right:15px;
}
#pagination .next{
    float:left
}
#pagination .prev,
.amp-wp-tax-tag{
    float:right
}
.toggle-text:before{
    padding-left:5px;
}
/* RTL End */
<?php } ?>

/* Style Modifer */
<?php $color =  $redux_builder_amp['opt-color-rgba']['color']; ?>
.amp-wp-tax-tag a,
a,
.amp-wp-author {
    color: <?php echo $color ?>;
}
.nav_container {
    background:  <?php echo $color ?>;
}
amp-user-notification  {
	border-color:  <?php echo $color ?>;
}
amp-user-notification button {
	background-color:  <?php echo $color ?>;
}
<?php if( $redux_builder_amp['enable-single-social-icons'] == true )  { ?> 
    .single-post footer {
        padding-bottom: 40px;
    }
<?php } ?>

/* Custom Style Code */
<?php echo $redux_builder_amp['css_editor']; ?>