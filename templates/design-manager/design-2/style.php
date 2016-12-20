<?php global $redux_builder_amp; ?>
<?php
add_action( 'amp_post_template_head', function() {
    remove_action( 'amp_post_template_head', 'amp_post_template_add_fonts' );
}, 9 );
add_action('amp_post_template_css', 'ampforwp_additional_style_input_2');

function ampforwp_additional_style_input_2( $amp_template ) {
	global $redux_builder_amp;
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
    margin-bottom: 10px;
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
.ampforwp-social-icons-wrapper{
    margin: 0.65em 0px 0.65em 0px;
    height: 28px;
}
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
.whatsapp-share-icon {
    width: 50px;
    height: 20px;
    display: inline-block;
    background: #5cbe4a;
    padding: 4px 0px;
    position: relative;
    top: -4px;
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
.comment-button-wrapper{
    margin-bottom: 40px;
    margin-top: 25px;
    text-align:center
}
.comment-button-wrapper a{
    color: #fff;
    background: #312c7e;
    font-size: 13px;
    padding: 10px 20px 10px 20px;
    box-shadow: 0 0px 3px rgba(0,0,0,.04);
    border-radius: 80px;
}
h1.amp-wp-title {
    text-align: center;
    margin: 0.7em 0px 0.6em 0px;
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
.single-post .post-pagination-meta{
    min-height:auto
}
.single-post .ampforwp-social-icons{
    display:inline-block
}
.post-pagination-meta .amp-wp-tax-category,
.post-title-meta .amp-wp-tax-tag {
    display : none;
}
.amp-meta-wrapper{
	border-bottom: 1px solid #DADADA;
    padding-bottom:10px;
    display:inline-block;
    width:100%;
    margin-bottom:0
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
figure{
    margin: 0;
}
figcaption{
    font-size: 11px;
    margin-bottom: 11px;
    background: #eee;
    padding: 6px 8px;
}
.amp-wp-byline amp-img {
    display: none;
}
.amp-wp-author:before {
    content: "By ";
    color: #555;
}
.amp-wp-author{
    margin-right: 1px;
}
.amp-wp-meta {
    font-size: 12px;
    color: #555;
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
    font-size: 13px;
    border: 0;
    display: inline-block;
    margin: 0.5em 0px 0.7em 0px;
    width: 100%;
}
main .amp-wp-content.featured-image-content {
	padding: 0px;
	border: 0;
	margin-bottom: 0;
	box-shadow: none
}
.amp-wp-content.post-pagination-meta{
    max-width: 1030px;    
}
.single-post .ampforwp-social-icons.ampforwp-social-icons-wrapper {
    display: block;
    margin: 2em auto 0.9em auto ;
    max-width: 1030px;
}
.amp-wp-article-header.amp-wp-article-category.ampforwp-meta-taxonomy {
    margin: 10px auto;
    max-width: 1030px;
}

/* Related Posts */
main .amp-wp-content.relatedpost {
	background: none;
	box-shadow: none;
	max-width: 1030px;
    padding:0px 0 0 0;
    margin:1.8em auto 1.5em auto
}
.related_posts h3, .comments_list h3{
    font-size: 14px;
    font-weight: bold;
    letter-spacing: 0.4px;
    margin: 15px 0 10px 0;
    color: #333;
}
.related_posts ol{
    list-style-type:none;
    margin:0;
    padding:0
}
.related_posts ol li{
    display:inline-block;
    width:100%;
    margin-bottom: 12px;
    background: #fefefe;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    box-shadow: 0 2px 3px rgba(0,0,0,.05);
    padding: 0px;
}
.related_posts .related_link{
    margin-top:18px;
    margin-bottom:10px;
    margin-right:10px
}
.related_posts .related_link a{
    font-weight: 300;
    color: #000;
    font-size: 18px;
}
.related_posts ol li amp-img{
    width:100px;
    float:left;
    margin-right:15px
}
.related_posts ol li p{
    font-size: 12px;
    color: #999;
    line-height: 1.2;
    margin: 12px 0 0 0;
}
.no_related_thumbnail{
    padding: 15px 18px;
}
.no_related_thumbnail .related_link{
    margin: 16px 18px 20px 19px;
}

/* Comments */
.ampforwp-comment-wrapper{
    margin:1.8em 0px 1.5em 0px
}
main .amp-wp-content.comments_list {
	background: none;
	box-shadow: none;
	max-width: 1030px;
	padding:0
}
.comments_list div{
    display:inline-block;
}
.comments_list ul{
    margin:0;
    padding:0
}
.comments_list ul.children{
    padding-bottom:10px;
}
.comments_list ul li p{
    margin:0;
    font-size:15px;
    clear:both;
    padding-top:16px;
}
.comments_list ul li{
    font-size:13px;
    list-style-type:none;
    margin-bottom: 12px;
    background: #fefefe;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,.05);
    box-shadow: 0 2px 3px rgba(0,0,0,.05);
    padding: 0px;
    max-width: 1000px;
}
.comments_list ul li .comment-body{
    padding: 25px;
    width: 91%;
}
.comments_list ul li .comment-body .comment-author{
    margin-right:5px
}
.comment-author{ float:left }
.single-post footer.comment-meta{
    /* float:right */
		padding-bottom: 0;
}
.comments_list li li{
    margin: 20px 20px 10px 20px;
    background: #f7f7f7;
    box-shadow: none;
    border: 1px solid #eee;
}
.comments_list li li li{
    margin:20px 20px 10px 20px
}

/* ADS */
.amp_home_body .amp_ad_1{
    margin-top: 10px;
    margin-bottom: -20px;
}
.single-post .amp_ad_1{
    margin-top: 10px;
    margin-bottom: -20px;
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
.amp-wp-content blockquote {
    background-color: #fff;
    border-left: 3px solid;
    margin: 0;
    padding: 15px 20px 8px 24px;
    background: #f3f3f3;
}

pre {
	    white-space: pre-wrap;
}
/* Responsive */
    @media screen and (max-width: 800px) {
        .single-post main{
            padding: 12px 10px 10px 10px
        }
    }

@media screen and (max-width: 630px) {
		.related_posts ol li p{
			display:none
		}
    .related_link {
        margin: 16px 18px 20px 19px;
    }
}
@media screen and (max-width: 510px) {
				.ampforwp-tax-category span{
					display:none
				}
	    .related_posts ol li p{
        line-height: 1.6;
        margin: 7px 0 0 0;
    }
    .related_posts .related_link {
        margin: 17px 18px 17px 19px;
    }
    .comments_list ul li .comment-body{
        width:auto
    }
}
@media screen and (max-width: 425px) {
    .related_posts .related_link p{
        display:none
    }
    .related_posts .related_link {
        margin: 13px 18px 14px 19px;
    }
    .related_posts .related_link a{
        font-size: 18px;
        line-height: 1.7;
    }
		.amp-meta-wrapper{
			display: inline-block;
	    margin-bottom: 0px;
	    margin-top: 8px;
			width:100%
		}
		.ampforwp-tax-category{
			padding-bottom:0
		}
		h1.amp-wp-title{
			margin: 16px 0px 13px 0px;
		}
		.amp-wp-byline{
			padding:0
		}
		.amp-meta-wrapper .amp-wp-meta-date{
			display:none
		}
		.related_posts .related_link a {
    	font-size: 17px;
    	line-height: 1.5;
		}
}
@media screen and (max-width: 375px) {
	#pagination .next a, #pagination .prev a{
		padding: 10px 6px;
		font-size: 11px;
		color: #666;
	}
	.related_posts h3, .comments_list h3{
		margin-top:15px;
	}
	#pagination .next{
		margin-bottom:15px;
	}
	.related_posts .related_link a {
		font-size: 15px;
    line-height: 1.6;
	}
}
@media screen and (max-width: 340px) {
	.related_posts .related_link a {
			font-size: 15px;
	}
		.single-post main{
				padding: 10px 5px 10px 5px
		}
		.the_content .amp-ad-wrapper{
				text-align: center;
				margin-left: -13px;
		}
}
@media screen and (max-width: 320px) {
	.related_posts .related_link a {
    font-size: 13px;
	}
	h1.amp-wp-title{
		font-size:17px;
		padding:0px 4px
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
#pagination{
	display:inline-block
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
    color: <?php echo sanitize_hex_color( $header_background_color ); ?>;;
}
.amp-wp-content blockquote{
	border-color:<?php echo sanitize_hex_color( $header_background_color ); ?>;;
}
.nav_container, .comment-button-wrapper a {
    background:  <?php echo sanitize_hex_color( $header_background_color ); ?>;;
}
.nav_container a{
    color:<?php echo sanitize_hex_color( $header_color ); ?>
}
amp-user-notification  {
	border-color:  <?php echo sanitize_hex_color( $header_background_color ); ?>;;
}
amp-user-notification button {
	background-color:  <?php echo sanitize_hex_color( $header_background_color ); ?>;;
}
<?php if( $redux_builder_amp['enable-single-social-icons'] == true )  { ?>
    .single-post footer {
        padding-bottom: 60px;
    }
.amp-ad-2{ margin-bottom: 50px; }
<?php } ?>
/**/
.alignleft{
	margin-right: 12px;
	margin-bottom:5px;
	float: left;
}
.alignright{
	float:right;
	margin-left: 12px;
	margin-bottom:5px;
}
.aligncenter{
	text-align:center;
	margin: 0 auto
}

.amp-wp-author:before{
	content: " <?php global $redux_builder_amp; echo $redux_builder_amp['amp-translator-by-text']; ?>  ";
}

.ampforwp-tax-category a:after,
.ampforwp-tax-tag a:after {
	content: ', ';
}
.ampforwp-tax-category a:last-child:after,
.ampforwp-tax-tag a:last-child:after  {
	content: ' ';
}

	/* New V0.8.7(drag and drop) style */
	.amp-wp-article-content img {
	    max-width: 100%;
	}




	/* Custom Style Code */
	<?php echo $redux_builder_amp['css_editor'];
} ?>
