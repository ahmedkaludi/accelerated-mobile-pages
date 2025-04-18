<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp, $wp,$wp_query; ?>
<!doctype html>
<html amp <?php 
//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>
>
<head>
	<meta charset="utf-8">
	<?php do_action('amp_experiment_meta', $this); ?>
    <link rel="preconnect" href="//cdn.ampproject.org">
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
			<script custom-element="<?php echo esc_attr($ampforwp_service); ?>"  src="<?php echo esc_url($ampforwp_js_file); ?>" async></script> <?php
		}
	}?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body <?php ampforwp_body_class('archives_body design_1_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>
<?php do_action( 'below_the_header_design_1', $this ); ?>

<article class="amp-wp-article ampforwp-custom-index amp-wp-home">

	<?php do_action('ampforwp_post_before_loop') ?>
	<?php $count = 1; ?>

	  <?php if ( is_archive() ) {
	  	if( is_author() ){
	  		$author_name = get_query_var('author_name');
	  		$author = get_query_var('author');
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', esc_attr($author_name)) : get_userdata(esc_attr($author));
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
	    	if(function_exists('ampforwp_category_image_compatibility')){
	    		ampforwp_category_image_compatibility('echo','amp-wp-content taxonomy-image');
	    	}
			$arch_desc 		= $sanitizer->get_amp_content();
			if( $arch_desc || have_posts() ) {  
				if ( get_query_var( 'paged' ) ) {
		        $paged = get_query_var('paged');
		    } elseif ( get_query_var( 'page' ) ) {
		        $paged = get_query_var('page');
		    } else {
		        $paged = 1;
		    }
				if($paged <= '1' && ampforwp_get_setting('ampforwp-cat-description')) {?>
					<div class="amp-wp-content taxonomy-description">
						<?php echo do_shortcode($arch_desc);// amphtml content, no kses ?>
				    </div> <?php
				}
			}
			if(is_category() && 1 == $redux_builder_amp['ampforwp-sub-categories-support']){
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
	 					 echo '<li><a href="' . esc_url(get_term_link( $cat_child )) . '">' . esc_attr($cat_child->name) . '</a></li>'; 
	 				}
	 				echo "</ul></div>";
	 			}
	 		}	
	  } ?>
	  	<?php  do_action('ampforwp_between_loop',$count); ?>
		<?php  if ( have_posts() ) : while ( have_posts() ) : the_post();

			$ampforwp_amp_post_url = ampforwp_url_controller( get_permalink() );

				if( in_array( 'ampforwp-custom-type-amp-endpoint' , $redux_builder_amp ) ) {
					if ( isset($redux_builder_amp['ampforwp-custom-type-amp-endpoint']) && $redux_builder_amp['ampforwp-custom-type-amp-endpoint']) {
		  			$ampforwp_amp_post_url = trailingslashit( get_permalink() ) . '?amp';
		  		}
				} ?>
	        <div class="amp-wp-content amp-wp-article-header amp-loop-list">
	        <?php 
	        	$title_name = '<a href="'.esc_url( $ampforwp_amp_post_url ).'">'.get_the_title().'</a>';
	        	if( ampforwp_default_logo() ){ ?>
		        	<h2 class="amp-wp-title">
						<?php 
						//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo $title_name; //escaped above 
						?>
					</h2>
				<?php }else{ ?>
					<h3 class="amp-wp-title">
						<?php 
							//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo $title_name; //escaped above 
						?>
					</h3>
				<?php } ?>

				<div class="amp-wp-content-loop">

          <div class="amp-wp-meta">
							<time> <?php
										$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                    					$post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    					echo  esc_attr($post_date) ; ?>
							</time>
          </div>

				<?php if (ampforwp_has_post_thumbnail() ) {
					$width = 100;
					$height = 75;
					if ( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ) {
						$width = $redux_builder_amp['ampforwp-homepage-posts-design-1-2-width'];
						$height = $redux_builder_amp['ampforwp-homepage-posts-design-1-2-height'];
					}
					$image_args = array("tag"=>'div',"tag_class"=>'home-post-image','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height); ?>
						<?php amp_loop_image($image_args); ?>
					<?php } ?>
					<?php if( ampforwp_check_excerpt() ) { amp_loop_excerpt( ampforwp_get_setting('amp-design-1-excerpt') ); } ?>
				</div>
	        </div>
	    <?php 
	     do_action('ampforwp_between_loop',$count,$this);
		         $count++;
	     endwhile;  ?>
	     <?php do_action('ampforwp_loop_before_pagination') ?>
		 <?php $infinite_scroll = ( int ) ampforwp_get_setting( 'ampforwp-infinite-scroll' );
		$infinite_scroll_home = ( int ) ampforwp_get_setting( 'ampforwp-infinite-scroll-home' );
		if ( $infinite_scroll === 0 || ( $infinite_scroll === 1 && $infinite_scroll_home === 0 ) ) {
			?>
		    <div class="amp-wp-content pagination-holder">

		        <div id="pagination">
		        	<?php if ( get_next_posts_link('next', $wp_query->max_num_pages) ){ ?><div class="next">
						<?php 
							//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo apply_filters('ampforwp_next_posts_link', get_next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Next' ).'&raquo;', 0), $paged ) 
						?></div><?php }?>
		        	<?php if ( get_previous_posts_link() ){ ?><div class="prev">
						<?php 
							//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo apply_filters( 'ampforwp_previous_posts_link', get_previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' )), $paged ); ?></div><?php }?>
		            <div class="clearfix"></div>
		        </div>

		    </div>
		<?php } ?>
		<?php endif; ?>

	<?php do_action('ampforwp_post_after_loop') ?>

</article>

<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>