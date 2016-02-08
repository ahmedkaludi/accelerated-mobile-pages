<!doctype html>
<html amp>
<head>

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

	<link rel="canonical" href="<?php the_permalink(); ?>?noamp">
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

<nav>
     <a href="#" class="toggle-text">Navigate</a>
    <div id="toggle-navigation"><?php wp_nav_menu( array( 'theme_location' => 'amp-menu' ) ); ?>
    </div>
</nav>

<?php if ( is_single() ) {  
    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
    <?php } 
} ?>
<main role="main">