<?php global $redux_builder_amp; ?><!doctype html>
<html amp>

  <head>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-user-notification" src="https://cdn.ampproject.org/v0/amp-user-notification-0.1.js"></script>
    <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <?php if( $redux_builder_amp['enable-single-social-icons'] == true )  { ?>
      <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
    <?php } ?>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <script async custom-element="amp-sticky-ad" src="https://cdn.ampproject.org/v0/amp-sticky-ad-0.1.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

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

<body id="<?php if ( !is_single() && !is_page() ) { ?>home<?php } ?>" class="<?php if( is_single()
&& $redux_builder_amp['enable-single-social-icons'] == true )  { ?>sticky-ad-enabled <?php }?>">

  <header class="container">
      <div id="headerwrap">
          <div id="header">

              <div on='tap:sidebar.toggle' role="button" tabindex="0" class="nav_container">     <a href="#" class="toggle-text"><i class="fa fa-bars" aria-hidden="true"></i></a></div>

            <?php global $redux_builder_amp; ?>

            <?php if (true == ($redux_builder_amp['opt-media']['url'])): ?>
              <a href="<?php bloginfo('url'); ?>">
                  <amp-img src="<?php echo $redux_builder_amp['opt-media']['url']; ?>" width="190" height="36" alt="logo" class="amp-logo"></amp-img>
              </a>
            <?php endif; ?>
            <?php if (false == ($redux_builder_amp['opt-media']['url'])): ?>
            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
            <?php endif ?>

          </div>
      </div>
  </header>

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
      <?php if($redux_builder_amp['enable-amp-ads-1'] == true) : ?>
      <div class="amp-ad-wrapper">
        <div class="disclosure-message">
<p>ADVERTISEMENT</p>
</div>
      <amp-ad class="amp-ad-1"
      <?php if($redux_builder_amp['enable-amp-ads-select-1'] == 1) : ?>
        width=300 height=250
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 2) :?>
        width=336 height=280
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 3) :?>
        width=728 height=90
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 4) :?>
        width=300 height=600
      <?php elseif ($redux_builder_amp['enable-amp-ads-select-1'] == 5) :?>
        width=320 height=100
      <?php endif?>
        type="adsense"
        data-ad-client="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-client-1']; ?>"
        data-ad-slot="<?php echo $redux_builder_amp['enable-amp-ads-text-feild-slot-1']; ?>">
      </amp-ad>
      </div>
  <?php elseif ($redux_builder_amp['enable-amp-ads-1'] == false) : endif ?>
