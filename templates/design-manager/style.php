<?php
add_action('amp_post_template_css', 'ampforwp_additional_style_input');

function ampforwp_additional_style_input( $amp_template ) { 

	$get_customizer = new AMP_Post_Template( $post_id );
	$text_color 		= $get_customizer->get_customizer_setting( 'text_color' );
	$link_color     = $get_customizer->get_customizer_setting( 'link_color' );
	$header_background_color = $get_customizer->get_customizer_setting( 'header_background_color' );
	$header_color            = $get_customizer->get_customizer_setting( 'header_color' );
	?>
	
	/* Header */
	.amp-wp-header { 
	}
	.amp-wp-header .nav_container {
		float: right;
    	top: -9px;
    	line-height : 1
	}
	.toggle-text  { 
		position: absolute;
		right: 0;
	}
	.toggle-text span {
		font-size: 80px;
		position: absolute;
		line-height: 0;
	}

	/* Homepage */
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
		#pagination .next {
			display: inline-block;
			float: right
		}
		#pagination .prev {
			display: inline-block;
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
	
	/* Related Posts */
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
	
	<?php 
} ?>
