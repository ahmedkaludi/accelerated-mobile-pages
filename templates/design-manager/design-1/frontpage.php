<?php global $redux_builder_amp;
$post_id = $redux_builder_amp['amp-frontpage-select-option-pages'];
$template = new AMP_Post_Template( $post_id );?>
<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<?php
		$amp_custom_content_enable = get_post_meta($template->data['post_id'], 'ampforwp_custom_content_editor_checkbox', true);
		if ( $amp_custom_content_enable ) {
			$amp_component_scripts = $template->data['amp_component_scripts'];
			foreach ($amp_component_scripts as $ampforwp_service => $ampforwp_js_file) { ?>
				<script custom-element="<?php echo $ampforwp_service; ?>"  src="<?php echo $ampforwp_js_file; ?>" async></script> <?php
			}
		}	 ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="single-post amp-wp-frontpage">
<?php $this->load_parts( array( 'header-bar' ) ); ?>
	<h1 id='title'>
		<?php global  $redux_builder_amp;
					$ID = $redux_builder_amp['amp-frontpage-select-option-pages'];
					echo get_the_title( $ID ) ;
		?>
	</h1>
	<?php do_action( 'ampforwp_after_header', $this );  ?>

	<div class="amp-wp-content the_content"> <?php

		do_action( 'ampforwp_before_post_content', $this );

		// Normal Front Page Content
		if ( ! $amp_custom_content_enable ) {
			echo $template->data['post_amp_content'];
		} else {
			// Custom/Alternative AMP content added through post meta
			echo $template->data['ampforwp_amp_content'];
		}

		do_action( 'ampforwp_after_post_content', $this );
		?>

	</div>

	<div class="amp-wp-content post-pagination-meta">
		<?php $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?>
	</div>

	<?php if($redux_builder_amp['enable-single-social-icons'] == true)  { ?>
		<div class="sticky_social">
			<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
		    	<amp-social-share type="facebook"   width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  { ?>
		    	<amp-social-share type="twitter"    width="50" height="28"></amp-social-share>
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

	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
