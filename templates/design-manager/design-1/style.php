<?php
add_action('amp_post_template_css', 'ampforwp_additional_style_input');

function ampforwp_additional_style_input( $amp_template ) {
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
/* Generic WP styling */

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

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

.amp-wp-unknown-size img {
	/** Worst case scenario when we can't figure out dimensions for an image. **/
	/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
	object-fit: contain;
}

/* Template Styles */

.amp-wp-content,
.amp-wp-title-bar div {
	<?php if ( $content_max_width > 0 ) : ?>
	margin: 0 auto;
	max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
	<?php endif; ?>
}

html {
	background: <?php echo sanitize_hex_color( $header_background_color ); ?>;
}

body {
	background: <?php echo sanitize_hex_color( $theme_color ); ?>;
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: 'Merriweather', 'Times New Roman', Times, Serif;
	font-weight: 300;
	line-height: 1.75em;
}

p,
ol,
ul,
figure {
	margin: 0 0 1em;
	padding: 0;
}

a,
a:visited {
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
}

a:hover,
a:active,
a:focus {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
}

/* Quotes */

blockquote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	background: rgba(127,127,127,.125);
	border-left: 2px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}

/* UI Fonts */

.amp-wp-meta,
.amp-wp-header div,
.amp-wp-title,
.wp-caption-text,
.amp-wp-tax-category,
.amp-wp-tax-tag,
.amp-wp-comments-link,
.amp-wp-footer p,
.back-to-top {
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif;
}

/* Header */

.amp-wp-header {
	background-color: <?php echo sanitize_hex_color( $header_background_color ); ?>;
}

.amp-wp-header div {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
	font-size: 1em;
	font-weight: 400;
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: .875em 16px;
	position: relative;
}

.amp-wp-header a {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
	text-decoration: none;
}

/* Site Icon */

.amp-wp-header .amp-wp-site-icon {
	/** site icon is 32px **/
	background-color: <?php echo sanitize_hex_color( $header_color ); ?>;
	border: 1px solid <?php echo sanitize_hex_color(  $header_color ); ?>;
	border-radius: 50%;
	position: absolute;
	right: 18px;
	top: 10px;
}

/* Article */

.amp-wp-article {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-weight: 400;
	margin: 1.5em auto;
	max-width: 840px;
	overflow-wrap: break-word;
	word-wrap: break-word;
}

/* Article Header */

.amp-wp-article-header {
	align-items: center;
	align-content: stretch;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 1.5em 16px 1.5em;
}
.amp-wp-title {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	display: block;
	flex: 1 0 100%;
	font-weight: 900;
	margin: 0;
	width: 100%;
}

/* Article Meta */

.amp-wp-meta {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	display: inline-block;
	flex: 2 1 50%;
	font-size: .875em;
	line-height: 1.7em;
	margin: 0;
	padding: 0;
}
.ampforwp-meta-info{
    margin-top: 0px;
}
.amp-wp-article-header .amp-wp-meta:last-of-type {
	text-align: right;
}

.amp-wp-article-header .amp-wp-meta:first-of-type {
	text-align: left;
}

.amp-wp-byline amp-img,
.amp-wp-byline .amp-wp-author {
	display: inline-block;
	vertical-align: middle;
}

.amp-wp-byline amp-img {
	border: 1px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	border-radius: 50%;
	position: relative;
	margin-right: 6px;
}

.amp-wp-posted-on {
	text-align: right;
}

/* Featured image */

.amp-wp-article-featured-image {
	margin: 1.5em 16px 1.5em;
}
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}
/* Front page */
.amp-wp-frontpage .the_content {
		padding: 10px;
}
/* Article Content */
.amp-wp-article a{
    text-decoration:none
}
.amp-wp-article-content {
	margin: 0 16px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-left: 1em;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft {
	margin: 0 16px 1em 0;
}

/* Captions */

.wp-caption {
	padding: 0;
}

.wp-caption.alignleft {
	margin-right: 16px;
}

.wp-caption.alignright {
	margin-left: 16px;
}

.wp-caption-text {
	border-bottom: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
	text-align: center;
}

/* AMP Media */

amp-carousel {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $get_customizer->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Article Footer Meta */

.amp-wp-article-footer .amp-wp-meta {
	display: block;
}
.amp-wp-tax-category span{
    margin-right:5px;
}
.amp-wp-tax-category,
.amp-wp-tax-tag {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 1.5em 16px;
}

.amp-wp-comments-link {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
	border-style: solid;
	border-color: <?php echo sanitize_hex_color( $border_color ); ?>;
	border-width: 1px 1px 2px;
	border-radius: 4px;
	background-color: transparent;
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 600;
	line-height: 18px;
	margin: 0 auto;
	max-width: 200px;
	padding: 11px 16px;
	text-decoration: none;
	width: 50%;
	-webkit-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
}

/* AMP Footer */

.amp-wp-footer {
	border-top: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: calc(1.5em - 1px) 0 0;
    padding-bottom:25px;
}

.amp-wp-footer div {
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: 1.25em 16px 1.25em;
	position: relative;
}

.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 .5em;
}

.amp-wp-footer p {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .8em;
	line-height: 1.5em;
	margin: 0 15px 0 0;
}

.amp-wp-footer a {
	text-decoration: none;
}
.copyright_txt{ float:left }
.back-to-top { float:right }


	/* Header */
	.amp-wp-header {
	}
	.amp-wp-header .nav_container {
        float: right;
        top: -11px;
        line-height: 1;
        right: 60px;
	}
	.toggle-text  {
		position: absolute;
		right: 0;
        height: 22px;
        width: 28px;
	}
	.toggle-text span  {
        display: block;
        position: absolute;
        height: 2px;
        width: 25px;
        background: #ffffff;
        border-radius: 19px;
        opacity: 1;
        left: 0;
    }
	.toggle-text span:nth-child(2)  {
        top: 9px;
    }
	.toggle-text span:nth-child(3)  {
        top: 18px;
    }
	/* Homepage */
    .amp-wp-home .amp-wp-meta{
        margin:5px 0px
    }
		.amp-wp-home .amp-wp-content p {
			display: inline-block;
			width: 100%;
		}
	.ampforwp-custom-index .amp-wp-title a {
		text-decoration: none;
		color: <?php echo sanitize_hex_color( $text_color ); ?>;
	}
	.amp-wp-meta {
		display: flex;
	}
	.amp-wp-posted-on {
		display: initial
	}
	.ampforwp-custom-index .amp-wp-content {
		margin-bottom: 30px;
	}
		/* Home Pagination */
        .pagination-holder{
            margin: 1.5em 16px 1.5em
        }
		#pagination .next {
			display: inline-block;
			float: right
		}
		#pagination .prev {
			display: inline-block;
		}
		.amp-wp-home .amp-wp-content p {
			display: inline;
		}

		.home-post-image {
			float: right ;
			margin: 0 0 10px 20px;

		}

	/* Single */
	.amp-wp-article-content amp-img {
		max-width : 100%;
	}
	.amp-wp-meta.amp-wp-tax-category,
	.amp-wp-meta.amp-wp-tax-tag {
		margin : 0
	}
	.amp-wp-meta.amp-wp-tax-tag  {
		display : initial
	}
	/* Social Icons */
    .ampforwp-social-icons{
        margin: 1.5em 16px 1.5em;
    }
	.whatsapp-share-icon {
	    width: 50px;
	    height: 20px;
	    display: inline-block;
	    background: #5cbe4a;
	    padding: 4px 0px;
	    position: relative;
	    top: -4px;
	    text-align: center
	}
    .comment-button-wrapper a{
        font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif;
        border-style: solid;
        border-color: #c2c2c2;
        border-width: 1px 1px 2px;
        border-radius: 4px;
        background-color: transparent;
        color: #0a89c0;
        cursor: pointer;
        display: block;
        font-size: 14px;
        font-weight: 600;
        text-align:center;
        line-height: 18px;
        margin: 0 auto;
        max-width: 200px;
        padding: 11px 16px;
        text-decoration: none;
        width: 50%;
        -webkit-transition: background-color 0.2s ease;
        transition: background-color 0.2s ease;
    }
	/* Related Posts */
    .relatedpost{
        margin: 2em 16px 2em;
    }
	main .amp-wp-content.relatedpost {
		background: none;
		box-shadow: none;
		max-width: 1030px;
	}
	.related_posts h3, .comments_list h3{
	    font-size: 14px;
	    font-weight: bold;
	    letter-spacing: 0.4px;
	    margin: 25px 0 10px 0;
	    color: #333;
	}
	.related_posts ol{
	    list-style-type:none;
	    margin:0;
	    padding:0;
        font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif
}
	.related_posts ol li{
	    display:inline-block;
	    width:100%;
	    margin-bottom: 12px;
	    padding: 0px;
	}
	.related_posts .related_link a{
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

	/* Comments */
    .comments_list{
        margin: 2.5em 16px 2.5em
    }
	main .amp-wp-content.comments_list {
		background: none;
		box-shadow: none;
		max-width: 1030px;
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
        margin: 0;
        font-size: 14px;
        clear: both;
        padding-top: 5px;
	}
	.comments_list ul li{
        font-family:sans-serif;
	    font-size:11px;
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
    .comments_list ul li .says{
        margin-right: 4px;
    }
    .comments_list ul li p{
    font-family:'Merriweather', 'Times New Roman', Times, Serif
    }
	.comments_list ul li .comment-body{
	    padding: 10px 0px 15px 0px;
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

	/* Slide Navigation code */
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
        font-family:sans-serif;
	    padding: 0;
	}
	.toggle-navigationv2 ul ul li a  {
	    padding-left: 35px;
	    background: #fff;
	    display: inline-block
	}
	.toggle-navigationv2 ul li a{
        padding: 10px 15px 10px 25px;
        width: 88%;
        display: inline-block;
        text-decoration: none;
        background: #fafafa;
        font-size: 13px;
        border-bottom: 1px solid #efefef;
	}
	.close-nav{
	    font-size: 12px;
        font-family: sans-serif;
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
	.nav_container:hover + .toggle-navigation,
	.toggle-navigation:hover,
	.toggle-navigation:active,
	.toggle-navigation:focus{
	    display: inline-block;
	    width: 100%;
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
		    background:  <?php echo sanitize_hex_color( $header_background_color ); ?>;
		    color: <?php echo sanitize_hex_color( $header_color ); ?>;
		    margin-left: 5px;
				border: 0;
		}
		amp-user-notification button:hover {
			cursor: pointer
		}

	/* Advertisement */
		.amp-ad-wrapper {
			text-align: center
		}
	/* Sticky Social bar in Single */
		<?php if( $redux_builder_amp['enable-single-social-icons'] == true && is_single() )  { ?>
			body {
				padding-bottom: 43px;
			}
		<?php } ?>
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
		.amp-wp-author:before{
		}
		.amp-wp-tax-category a:after,
		.amp-wp-tax-tag a:after {
			content: ', ';
		}
		.amp-wp-tax-category a:last-child:after,
		.amp-wp-tax-tag a:last-child:after  {
			content: ' ';
		}

		pre {
			    white-space: pre-wrap;
		}

		<?php if($redux_builder_amp['enable-single-social-icons']){ ?>
			.amp-wp-footer {
				padding-bottom: 60px;
			}
		<?php } ?>

		.amp-ad-wrapper.amp_ad_1 {
			 padding-top : 20px;
		}

			/* Custom Style Code */
			<?php echo $redux_builder_amp['css_editor'];
		} ?>
