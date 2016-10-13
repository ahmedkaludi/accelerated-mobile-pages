<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="single-post">
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>


	<div class="amp-wp-content post-title-meta">
		<?php if($redux_builder_amp['enable-single-post-meta'] == true) { ?>
			<ul class="amp-wp-meta">
				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author') ) ); ?>

				<li> <?php _e(' on ','ampforwp'); the_time( get_option( 'date_format' ) ) ?></li> 

				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array('meta-taxonomy' ) ) ); ?>

				<li class="cb"></li>
			</ul>
		<?php } ?>
		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
	</div>
	<div class="amp-wp-content featured-image-content">
    <?php if($redux_builder_amp['enable-single-featured-img'] == true) {
        if ( has_post_thumbnail() ) { ?>
        <?php
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
        $thumb_url = $thumb_url_array[0];            
        ?> 
        <div class="post-featured-img"><amp-img src=<?php echo $thumb_url ?> width=512 height=300 layout=responsive></amp-img></div>
    <?php } } ?>
	</div>
	<div class="amp-wp-content the_content">

        <?php do_action( 'ampforwp_before_post_content', $this ); ?>
		
		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
		<?php do_action( 'ampforwp_after_post_content', $this ); ?>
	</div>

	<div class="amp-wp-content post-pagination-meta">
		<?php if($redux_builder_amp['ampforwp-single-tags-on-off'] == true) { 
				$this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) );
				
			} ?> 


    <?php if($redux_builder_amp['enable-next-previous-pagination'] == true) { ?>
		<div id="pagination">
			<div class="next"><?php next_post_link(); ?></div>
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="clearfix"></div>
		</div>
    <?php } ?>
	</div>

	<?php if($redux_builder_amp['enable-single-social-icons'] == true)  { ?>
		<div class="sticky_social">          
			<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
		    	<amp-social-share type="facebook"    data-param-app_id="<?php echo $redux_builder_amp['amp-facebook-app-id']; ?>" width="50" height="28"></amp-social-share>
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


<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
