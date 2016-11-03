<?php
add_action('amp_post_template_css', 'ampforwp_additional_style_input');

function ampforwp_additional_style_input( $amp_template ) { 

	$get_customizer = new AMP_Post_Template( $post_id );
	$text_color 	= $get_customizer->get_customizer_setting( 'text_color' );
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

	<?php 
}
?>