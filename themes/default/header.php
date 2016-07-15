<!doctype html>
<html amp>

<head>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>

<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>

	<title>
		<?php 
			global $query_string;

			if ( is_home() )
				bloginfo( 'name' );

			if ( get_search_query() )
				echo 'Results for: "' . get_search_query() .'"';

			if ( is_month() )
				the_time('F Y');

			if ( is_category() )
				single_cat_title();

			if ( is_single() )
				the_title();

			if ( is_page() )
				the_title();

			if ( is_tag() )
				single_tag_title();

			if ( is_404() )
				echo 'Page Not Found!';
		?>
	</title>

	<link rel="canonical" href="<?php the_permalink(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">

    <?php
    /* 
     * Added the custom style through the custom Hook called "amp_custom_style" and not used wp_enqueue, because of the strict rules of AMP.
     * 
    */
     do_action('amp_custom_style'); ?>

</head>

<body id="<?php if ( !is_single() && !is_page() ) { ?>home<?php } ?>">

<header class="container">
    
    <div id="headerwrap">
        <div id="header">
            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        </div>
    </div>
</header>

 
<div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">     <a href="#" class="toggle-text">Navigate</a></div>
 
<amp-sidebar id='sidebar'
      layout="nodisplay"
      side="right">
    <div class="toggle-navigationv2">
        <div role="button" tabindex="0" on='tap:sidebar.close' class="close-nav">X</div>
        <?php wp_nav_menu( array( 'theme_location' => 'amp-menu' ) ); ?>
    </div>
</amp-sidebar>
 
<?php if ( is_single() ) {  
    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
    <?php } 
} ?>
<main role="main">