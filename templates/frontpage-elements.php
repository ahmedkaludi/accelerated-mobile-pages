<?php
add_action('pre_amp_render_post', 'ampforwp_frontpage_file', 11);
function ampforwp_frontpage_file() {
	global $redux_builder_amp;

	// Title 
		// Design #2
		add_action('ampforwp_design_2_frontpage_title','ampforwp_design_2_frontpage_title'); 
		// Design #3
		add_action('ampforwp_design_3_frontpage_title','ampforwp_design_3_frontpage_title');

	// Content
	if ( $redux_builder_amp['amp-design-selector'] == '1') {
		add_action('ampforwp_frontpage_above_loop', 'ampforwp_design_1_frontpage_content', 10 , 2);
	}
	if ( $redux_builder_amp['amp-design-selector'] == '2') {
		add_action('ampforwp_frontpage_above_loop', 'ampforwp_design_2_frontpage_content', 10 , 2);
	}
	if ( $redux_builder_amp['amp-design-selector'] == '3') {
		add_action('ampforwp_frontpage_above_loop', 'ampforwp_design_3_frontpage_content', 10 , 2);
	}
}

// TODO: refine this file. #890

// Design #1
function ampforwp_design_1_frontpage_content( $template, $post_id ){ 
	global $redux_builder_amp;
	//WPML Static Front Page Support #1111
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 	$post_id = get_option('page_on_front');
 	
	 }
	$amp_custom_content_enable = get_post_meta($post_id, 'ampforwp_custom_content_editor_checkbox', true);?>

	<article class="amp-wp-article">

		<?php if( $redux_builder_amp['ampforwp-title-on-front-page'] ) { ?>
			<header class="amp-wp-article-header ampforwp-title">
				<h1 class="amp-wp-title"><?php echo get_the_title( $post_id );?></h1>
			</header>
			
		<?php } ?>

		<?php do_action( 'ampforwp_after_header', $template );  ?>

		<div class="amp-wp-content the_content">

			<?php do_action('ampforwp_before_featured_image_hook', $template ); ?>
		<?php 	$featured_image = $template->get( 'featured_image' );
			if ( $featured_image )  {
					$amp_html = $featured_image['amp_html'];
					$caption = $featured_image['caption']; ?>
					<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
						<figure class="amp-wp-article-featured-image wp-caption">
							<?php echo $amp_html; // amphtml content; no kses ?>
							<?php if ( $caption ) : ?>
								<p class="wp-caption-text">
									<?php echo wp_kses_data( $caption ); ?>
								</p>
							<?php endif; ?>
						</figure>
					</div> <?php
			} 
		do_action('ampforwp_after_featured_image_hook', $template );

			do_action( 'ampforwp_before_post_content', $template );

			// Normal Front Page Content
			if ( ! $amp_custom_content_enable ) {
				echo $template->get('post_amp_content');
			} else {
				// Custom/Alternative AMP content added through post meta
				echo $template->get('ampforwp_amp_content');
			}

			do_action( 'ampforwp_after_post_content', $template );
			?>

		</div>

		<?php ampforwp_frontpage_comments(); ?>

		<div class="amp-wp-content post-pagination-meta">
			<?php $template->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?>
		</div>
	</article> <?php 
}


// Design #2
function ampforwp_design_2_frontpage_content($template, $post_id){ 
	global $redux_builder_amp;
	//WPML Static Front Page Support #1111
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 	$post_id = get_option('page_on_front');
 	
 	}
	$amp_custom_content_enable = get_post_meta($post_id, 'ampforwp_custom_content_editor_checkbox', true);?>

	<main>
		<div class="amp-wp-content the_content"> 
			
		<?php do_action('ampforwp_before_featured_image_hook', $template ); ?>
		<?php 	$featured_image = $template->get( 'featured_image' );
			if ( $featured_image )  {
					$amp_html = $featured_image['amp_html'];
					$caption = $featured_image['caption']; ?>
					<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
						<figure class="amp-wp-article-featured-image wp-caption">
							<?php echo $amp_html; // amphtml content; no kses ?>
							<?php if ( $caption ) : ?>
								<p class="wp-caption-text">
									<?php echo wp_kses_data( $caption ); ?>
								</p>
							<?php endif; ?>
						</figure>
					</div> <?php
			} 
		do_action('ampforwp_after_featured_image_hook', $template ); 

			// Normal Front Page Content
			if ( ! $amp_custom_content_enable ) {
				echo $template->get('post_amp_content');
			} else {
				// Custom/Alternative AMP content added through post meta
				echo $template->get('ampforwp_amp_content');
			}

			do_action( 'ampforwp_after_post_content', $template ); ?>

		</div>

		<?php ampforwp_frontpage_comments(); ?>

		<div class="amp-wp-content post-pagination-meta">
			<?php $template->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?>
		</div> 
	</main>

	<?php 
}

// Design #3
function ampforwp_design_3_frontpage_content($template, $post_id){ 
	global $redux_builder_amp;
	//WPML Static Front Page Support #1111
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 	$post_id = get_option('page_on_front');
 	
 	}
	$amp_custom_content_enable = get_post_meta( $post_id, 'ampforwp_custom_content_editor_checkbox', true);?>
	<main>
		<div class="amp-wp-content the_content"> 

			<?php do_action('ampforwp_before_featured_image_hook', $template ); ?>
		<?php 	$featured_image = $template->get( 'featured_image' );
			if ( $featured_image )  {
					$amp_html = $featured_image['amp_html'];
					$caption = $featured_image['caption']; ?>
					<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
						<figure class="amp-wp-article-featured-image wp-caption">
							<?php echo $amp_html; // amphtml content; no kses ?>
							<?php if ( $caption ) : ?>
								<p class="wp-caption-text">
									<?php echo wp_kses_data( $caption ); ?>
								</p>
							<?php endif; ?>
						</figure>
					</div> <?php
			} 
		do_action('ampforwp_after_featured_image_hook', $template );

			// Normal Front Page Content
			if ( ! $amp_custom_content_enable ) {
				echo $template->get('post_amp_content');
			} else {
				// Custom/Alternative AMP content added through post meta
				echo $template->get('ampforwp_amp_content');
			}

			do_action( 'ampforwp_after_post_content', $template ); ?>

		</div>

		<?php ampforwp_frontpage_comments(); ?>

		<div class="amp-wp-content post-pagination-meta">
			<?php $template->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?>
		</div>
	</main>
	<?php 
}


// Frontpage Title for Design #2 
function ampforwp_design_2_frontpage_title() {
	global  $redux_builder_amp; 
	//WPML Static Front Page Support #1111
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 	$post_id = get_option('page_on_front');
 	
 	}
	if( $redux_builder_amp['ampforwp-title-on-front-page'] ) { ?>
		<header class="amp-wp-article-header ampforwp-title">
			<h1 class="amp-wp-title"><?php if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){$ID = get_option('page_on_front');}else{$ID = $redux_builder_amp['amp-frontpage-select-option-pages'];}echo get_the_title( $ID );?></h1>
		</header>	
		
	<?php } 
}

// Frontpage Title for Design #3 
function ampforwp_design_3_frontpage_title() { 
	global  $redux_builder_amp;
	//WPML Static Front Page Support #1111
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 	$post_id = get_option('page_on_front');
 	
 }
	if( $redux_builder_amp['ampforwp-title-on-front-page'] ) { ?>
		<main><header class="amp-wp-article-header ampforwp-title amp-wp-content">
			<h1 class="amp-wp-title"><?php 
			//WPML Static Front Page Support #1111
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' )){
 				$ID = get_option('page_on_front');
 	
 				}
 				else{
				$ID = $redux_builder_amp['amp-frontpage-select-option-pages'];
			}
				echo get_the_title( $ID );?></h1>
		</header></main><?php 
		
	}
}