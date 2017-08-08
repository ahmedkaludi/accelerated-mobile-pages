<?php global $redux_builder_amp; global $wp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php
	if ( is_archive() ) {
		$description 	= get_the_archive_description();
		$sanitizer = new AMPFORWP_Content( $description, array(), 
			apply_filters( 'ampforwp_content_sanitizers',
				array( 
					'AMP_Style_Sanitizer' 		=> array(),
					'AMP_Blacklist_Sanitizer' 	=> array(),
					'AMP_Img_Sanitizer' 		=> array(),
					'AMP_Video_Sanitizer' 		=> array(),
					'AMP_Audio_Sanitizer' 		=> array(),
					'AMP_Iframe_Sanitizer' 		=> array(
						'add_placeholder' 		=> true,
					)
				) ) );
	} ?>
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<?php
	$amp_component_scripts = $sanitizer->amp_scripts;
	if ( $sanitizer && $amp_component_scripts) {	
		foreach ($amp_component_scripts as $ampforwp_service => $ampforwp_js_file) { ?>
			<script custom-element="<?php echo $ampforwp_service; ?>"  src="<?php echo $ampforwp_js_file; ?>" async></script> <?php
		}
	}?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?> design_1_wrapper">

<?php $this->load_parts( array( 'header-bar' ) ); ?>

<article class="amp-wp-article ampforwp-custom-index amp-wp-home">

	<?php do_action('ampforwp_post_before_loop') ?>

	  <?php if ( is_archive() ) {
	    the_archive_title( '<h3 class="page-title">', '</h3>' );
	    
			$arch_desc 		= $sanitizer->get_amp_content();
			if( $arch_desc ) {  
				if($wp->query_vars['paged'] <= '1') {?>
					<div class="amp-wp-content taxonomy-description">
						<?php echo $arch_desc ; ?>
				    </div> <?php
				}
			}	
	  } ?>

		<?php  if ( have_posts() ) : while ( have_posts() ) : the_post();

			$ampforwp_amp_post_url =  trailingslashit( get_permalink() ) . AMPFORWP_AMP_QUERY_VAR ;

			$ampforwp_amp_post_url  = trailingslashit( $ampforwp_amp_post_url );

				if( in_array( 'ampforwp-custom-type-amp-endpoint' , $redux_builder_amp ) ) {
					if ( $redux_builder_amp['ampforwp-custom-type-amp-endpoint']) {
		  			$ampforwp_amp_post_url = trailingslashit( get_permalink() ) . '?amp';
		  		}
				} ?>
	        <div class="amp-wp-content amp-wp-article-header amp-loop-list">

		        <h1 class="amp-wp-title">
		            <a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>"><?php the_title() ?></a>
		        </h1>

				<div class="amp-wp-content-loop">

          <div class="amp-wp-meta">
							<time> <?php
										$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    					$post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    					echo  $post_date ; ?>
							</time>
          </div>

					<?php if ( has_post_thumbnail() ) { ?>
						<?php
						$thumb_id = get_post_thumbnail_id();
						$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
						$thumb_url = $thumb_url_array[0];
						?>
						<div class="home-post-image">
							<a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>">
								<amp-img
									src=<?php echo $thumb_url ?>
									<?php ampforwp_thumbnail_alt(); ?>
									<?php if( $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ) { ?>
										width=<?php global $redux_builder_amp; echo $redux_builder_amp['ampforwp-homepage-posts-design-1-2-width'] ?>
										height=<?php global $redux_builder_amp; echo $redux_builder_amp['ampforwp-homepage-posts-design-1-2-height'] ?>
									<?php } else { ?>
										width=100
										height=75
									<?php } ?>
								></amp-img>
							</a>
						</div>
					<?php }
						if( has_excerpt() ){
							$content = get_the_excerpt();
						}else{
							$content = get_the_content();
						} ?>
					<p><?php global $redux_builder_amp;
								$excertp_length = $redux_builder_amp['amp-design-1-excerpt'];
								echo wp_trim_words( strip_shortcodes( $content ) ,  $excertp_length ); ?></p>
				</div>
	        </div>
	    <?php endwhile;  ?>
		    <div class="amp-wp-content pagination-holder">

		        <div id="pagination">
		            <div class="next"><?php next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text']. ' &raquo;' , 'Next'), 0 ) ?></div>
		            <div class="prev"><?php previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' ) ); ?></div>
		            <div class="clearfix"></div>
		        </div>

		    </div>
		<?php endif; ?>

	<?php do_action('ampforwp_post_after_loop') ?>

</article>

<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>