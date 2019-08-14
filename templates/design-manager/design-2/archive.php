<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;?>
<?php global $redux_builder_amp; global $wp;  
		$is_full_content = false;
		if(isset($redux_builder_amp['ampforwp-full-post-in-loop']) && $redux_builder_amp['ampforwp-full-post-in-loop']){
			$is_full_content = true;
		} ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<?php do_action('amp_experiment_meta', $this); ?>
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
	}
	 ?>
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

<body <?php ampforwp_body_class('design_2_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>

<main>
	<?php do_action('ampforwp_post_before_loop') ?>
	<?php $count = 1; ?>

 	<?php if ( is_archive() ) { ?>
 		<div class="amp-wp-content amp-archive-heading">
		<?php
			if( is_author() ){
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
				if( true == ampforwp_gravatar_checker($curauth->user_email) ){
					$curauth_url = get_avatar_url( $curauth->user_email, array('size'=>180) );
					if($curauth_url){ ?>
						<div class="author-archive">
							<amp-img src="<?php echo esc_url($curauth_url); ?>" width="90" height="90" layout="fixed"></amp-img>
						</div>
					<?php }
				}
			} 
			if(ampforwp_default_logo()){
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			}else{
 			the_archive_title( '<h2 class="page-title">', '</h2>' );
 			}
			$arch_desc 		= $sanitizer->get_amp_content();
			if ( get_query_var( 'paged' ) ) {
		        $paged = get_query_var('paged');
		    } elseif ( get_query_var( 'page' ) ) {
		        $paged = get_query_var('page');
		    } else {
		        $paged = 1;
		    }
			if( $arch_desc ) { 
				if($paged <= '1') {?>
					<div class="amp-wp-content taxonomy-description">
						<?php echo $arch_desc ; ?>
				  </div> <?php
				}
			}
			if(is_category() && 1 == $redux_builder_amp['ampforwp-sub-categories-support'] ){
				$parent_cat_id 	= '';
			    $cat_childs		= array();
 			    $parent_cat_id 	= get_queried_object_id();
 			 	$cat_childs 	= get_terms( array(
 			  						'taxonomy' => get_queried_object()->taxonomy,
 			  						'parent'   => $parent_cat_id)
									);
	 			if(!empty($cat_childs)){
	 				echo "<div class='amp-sub-archives'><ul>";
	 				foreach ($cat_childs as $cat_child ) {
	 					 echo '<li><a href="' . get_term_link( $cat_child ) . '">' . $cat_child->name . '</a></li>'; 
	 				}
	 				echo "</ul></div>";
	 			}
	 		} ?>
 		</div>
 		<?php
 	} ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		$ampforwp_amp_post_url =  ampforwp_url_controller( get_permalink() );

			if( in_array( "ampforwp-custom-type-amp-endpoint" , $redux_builder_amp ) ) {
				if (isset($redux_builder_amp['ampforwp-custom-type-amp-endpoint']) && $redux_builder_amp['ampforwp-custom-type-amp-endpoint']) {
				 $ampforwp_amp_post_url = trailingslashit( get_permalink() ) . '?amp';
			 }
			} ?>

		<div class="amp-wp-content amp-loop-list">
			<?php if ( (ampforwp_has_post_thumbnail() && !$is_full_content) || (ampforwp_get_setting('ampforwp-featured-video') == true && !empty(ampforwp_get_setting('ampforwp-featured-video-metakey'))) ) {  
				$width = 100;
				$height = 75;
				if ( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ) {
					$width = $redux_builder_amp['ampforwp-homepage-posts-design-1-2-width'];
					$height = $redux_builder_amp['ampforwp-homepage-posts-design-1-2-height'];
				}
				$image_args = array("tag"=>'div',"tag_class"=>'home-post_image','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height); ?>
						<?php amp_loop_image($image_args); ?>
				<?php } ?>

			<div class="amp-wp-post-content">
				<?php 
        		$title_name = '<a href="'.esc_url( $ampforwp_amp_post_url ).'">'.get_the_title().'</a>';
        		if( ampforwp_default_logo() ){ ?>
    		   		<h2 class="amp-wp-title"><?php echo $title_name; ?></h2>
				<?php }else{ ?>
					<h3 class="amp-wp-title"><?php echo $title_name ?></h3>
				<?php }
				
				if( $is_full_content ){
					ampforwp_loop_full_content_featured_image();
				}

				if( ampforwp_check_excerpt() && !$is_full_content ) {
					$class = 'large-screen-excerpt';
					if ( true == $redux_builder_amp['excerpt-option-design-2'] ) {
						$class = 'small-screen-excerpt';
					}
					if(has_excerpt()){
						$content = get_the_excerpt();
					}else{
						$content = get_the_content();
					}
					?>
			        <p class="<?php echo $class; ?>">
					<?php 
						$excerpt_length		='';
						$excerpt_length 	= $redux_builder_amp['amp-design-2-excerpt'];
						$excerpt_length	= (int) $excerpt_length;
						$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );

						if ( false === has_filter('ampforwp_modify_index_content' ) ) {
							$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
						}
						echo $final_content; ?> </p>
				<?php }
				if($is_full_content){
					ob_start();
					the_content();
					$content = ob_get_clean();
		            $sanitizer_obj = new AMPFORWP_Content( $content,
		                  array(
          				    'AMP_Twitter_Embed_Handler'     => array(),
          				    'AMP_YouTube_Embed_Handler'     => array(),
			                  'AMP_DailyMotion_Embed_Handler' => array(),
			                  'AMP_Vimeo_Embed_Handler'       => array(),
			                  'AMP_SoundCloud_Embed_Handler'  => array(),
          				    'AMP_Instagram_Embed_Handler'   => array(),
          				    'AMP_Vine_Embed_Handler'        => array(),
          				    'AMP_Facebook_Embed_Handler'    => array(),
			                  'AMP_Pinterest_Embed_Handler'   => array(),
          				    'AMP_Gallery_Embed_Handler'     => array(),
              			), 
		                  apply_filters( 'ampforwp_content_sanitizers', 
		                    array( 'AMP_Img_Sanitizer' => array(), 
		                      'AMP_Blacklist_Sanitizer' => array(),
		                      'AMP_Style_Sanitizer' => array(), 
		                      'AMP_Video_Sanitizer' => array(),
		                       'AMP_Audio_Sanitizer' => array(),
		                       'AMP_Iframe_Sanitizer' => array(
		                         'add_placeholder' => true,
		                       ),
		                    ) 
		                  ) 
		                );
		        		$content =  $sanitizer_obj->get_amp_content();
		        	$final_content = apply_filters( 'ampforwp_loop_content', $content );
		        	echo $final_content;
				} ?> 
		    </div>
            <div class="cb"></div>
		</div>

	<?php
	do_action('ampforwp_between_loop',$count,$this);
		         $count++;
	 endwhile;  ?>
	 	<?php do_action('ampforwp_loop_before_pagination') ?>
		<div class="amp-wp-content pagination-holder">
			<div id="pagination">
				<div class="next"><?php echo apply_filters('ampforwp_next_posts_link',get_next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Next' ).'&raquo;', 0), $paged);?></div>
            <div class="prev"><?php echo apply_filters( 'ampforwp_previous_posts_link', get_previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' )), $paged ); ?></div>
				<div class="clearfix"></div>
			</div>
		</div>

	<?php endif; ?>
	<?php do_action('ampforwp_post_after_loop') ?>
</main>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>

</html>