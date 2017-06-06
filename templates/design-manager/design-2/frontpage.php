<?php global $redux_builder_amp , $wp;
$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
$template = new AMP_Post_Template( $post_id );?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8"> <?php
	$query_arg_array = $wp->query_vars;
  $page = '' ;
  if( array_key_exists( "page" , $query_arg_array  ) ) {
	   $page = $wp->query_vars['page'];
  }

	if ( $page >= '2') { ?>
		<link rel="canonical" href="<?php
		echo trailingslashit( home_url() ) . '?page=' . $page ?>"> <?php
	} else { ?>
		<link rel="canonical" href="<?php
		echo  trailingslashit( home_url() ) ?>"> <?php
	} ?>
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<?php
		$amp_custom_content_enable = get_post_meta($template->data['post_id'], 'ampforwp_custom_content_editor_checkbox', true);
		if ( ! $amp_custom_content_enable ) {
			$amp_component_scripts = $template->data['amp_component_scripts'];
			foreach ($amp_component_scripts as $ampforwp_service => $ampforwp_js_file) {
				if ( $ampforwp_service  ==  'amp-sidebar') {
					continue;
				} ?>
				<script custom-element="<?php echo $ampforwp_service; ?>"  src="<?php echo $ampforwp_js_file; ?>" async></script> <?php
			}
		}	 ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="single-post design_2_wrapper">
<?php $this->load_parts( array( 'header-bar' ) ); ?>

	<?php global  $redux_builder_amp; if( $redux_builder_amp['ampforwp-title-on-front-page'] ) { ?>
		<header class="amp-wp-article-header ampforwp-title">
			<h1 class="amp-wp-title">
				<?php $ID = $redux_builder_amp['amp-frontpage-select-option-pages'];
							echo get_the_title( $ID ) ; ?>
			</h1>
		</header>
<?php } ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>
<?php do_action('ampforwp_frontpage_above_loop') ?>

<main>
	<div class="amp-wp-content the_content"> 

	<?php if (has_post_thumbnail( $post_id ) ):  ?>
		<figure class="amp-wp-article-featured-image wp-caption"> <?php  
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'medium' ); 
			$caption = get_the_post_thumbnail_caption( $post_id ); ?>
			<amp-img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" layout=responsive alt="<?php echo get_the_title( $post_id ) ?>" >  </amp-img>	
			<?php if ( $caption ) : ?>
				<p class="wp-caption-text">
					<?php echo wp_kses_data( $caption ); ?>
				</p>
			<?php endif; ?>
		</figure>
	<?php endif; ?>	

	<?php

		// Normal Front Page Content
		if ( ! $amp_custom_content_enable ) {
			echo $template->data['post_amp_content'];
		} else {
			// Custom/Alternative AMP content added through post meta
			echo $template->data['ampforwp_amp_content'];
		}

		do_action( 'ampforwp_after_post_content', $this ); ?>

	</div>

	<?php ampforwp_frontpage_comments(); ?>

	<div class="amp-wp-content post-pagination-meta">
		<?php $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?>
	</div> <?php


	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( $redux_builder_amp['enable-single-social-icons'] == true && !is_plugin_active( 'amp-cta/amp-cta.php' ) )  { ?>
		<div class="sticky_social">
			<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
		    	<amp-social-share type="facebook"   width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  { $data_param_data = $redux_builder_amp['enable-single-twitter-share-handle'];?>
      		<amp-social-share type="twitter"
      											width="50"
      											height="28"
														data-param-url=""
                        								data-param-text="TITLE <?php echo wp_get_shortlink().' '.ampforwp_translation( $redux_builder_amp['amp-translator-via-text'], 'via' ).' '.$data_param_data ?>"
      		></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
		    	<amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
		    	<amp-social-share type="email"      width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
		    	<amp-social-share type="pinterest"  width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
		    	<amp-social-share type="linkedin"   width="50" height="28"></amp-social-share>
		  	<?php } ?>
		</div>
	<?php } ?>
</main>
	<?php do_action('ampforwp_frontpage_below_loop') ?>
	<?php do_action( 'amp_post_template_above_footer', $this ); ?>
	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>
