<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<?php do_action('amp_experiment_meta', $this); ?>
    <link rel="preconnect" href="//cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body <?php ampforwp_body_class('amp_home_body design_1_wrapper');?>>
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>
<?php do_action( 'below_the_header_design_1', $this ); ?>


<?php do_action('ampforwp_home_above_loop') ?>

<article class="amp-wp-article ampforwp-custom-index amp-wp-home">

	<?php do_action('ampforwp_post_before_loop') ?>
	
		<?php
			$count = 1;
			if ( get_query_var( 'paged' ) ) {
		        $paged = get_query_var('paged');
		    } elseif ( get_query_var( 'page' ) ) {
		        $paged = get_query_var('page');
		    } else {
		        $paged = 1;
		    }

		    $exclude_ids = ampforwp_exclude_posts();

			$args = array(
				'post_type'           => 'post',
				'orderby'             => 'date',
				'paged'               => esc_attr($paged),
				'post__not_in' 		  => $exclude_ids,
                'has_password' => false ,
                'post_status'=> 'publish',
                'no_found_rows'	=> true
			);
			$filtered_args = apply_filters('ampforwp_query_args', $args);
			$q = new WP_Query( $filtered_args ); 
			$blog_title = ampforwp_get_blog_details('title');
			if( ampforwp_is_blog() && $blog_title){  ?>
				<h1 class="page-title"><?php echo esc_attr($blog_title) ?></h1>
			<?php }
			
				
			 if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post(); ?>
		        <div class="amp-wp-content amp-wp-article-header amp-loop-list">
		        	<h2 class="amp-wp-title"><?php  $ampforwp_post_url = get_permalink(); ?><a href="<?php echo ampforwp_url_controller( $ampforwp_post_url ); ?>"><?php the_title() ?></a></h2>

					<div class="amp-wp-content-loop">
						<div class="amp-wp-meta">
			              <?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author') ) );
			              global $redux_builder_amp;
			              		if($redux_builder_amp['amp-design-selector'] == '1' && $redux_builder_amp['amp-design-1-featured-time'] == '1'){
			               ?>
			              <time> <?php
                          		$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                   				 $post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    			echo  esc_attr($post_date) ;?>
                    		</time> <?php
			 		 		}
			 		 	if( isset($redux_builder_amp['ampforwp-design1-cats-home']) && $redux_builder_amp['ampforwp-design1-cats-home'] ) {
			 		 		foreach((get_the_category()) as $category) { ?>
			 		 		<ul class="amp-wp-tags">
					   			<li class="amp-cat-<?php echo esc_attr($category->term_id);?>"> <?php echo  '  ' . esc_attr($category->cat_name) ?> </li> </ul>
							<?php }
						} ?>
					</div>

						<?php if ( ampforwp_has_post_thumbnail() ) {
							$width = 100;
							$height = 75;
							if ( true == $redux_builder_amp['ampforwp-homepage-posts-image-modify-size'] ) {
								$width = $redux_builder_amp['ampforwp-homepage-posts-design-1-2-width'];
								$height = $redux_builder_amp['ampforwp-homepage-posts-design-1-2-height'];
							}
							$image_args = array("tag"=>'div',"tag_class"=>'home-post-image','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height); ?>
								<?php amp_loop_image($image_args);
							}?>
						<?php if( ampforwp_check_excerpt() ) { amp_loop_excerpt( ampforwp_get_setting('amp-design-1-excerpt') ); } ?>
	
					</div>
		        </div>
		         <?php 
		         do_action('ampforwp_between_loop',$count,$this);
		         $count++;
		    	
		    endwhile;  ?>
 			<?php do_action('ampforwp_loop_before_pagination') ?>
		    <div class="amp-wp-content pagination-holder">
		    	<?php	
				if (function_exists('wp_pagenavi')) {
					wp_pagenavi();
				}else{?>
		        <div id="pagination">
		        	<?php if ( get_next_posts_link('next', $q->max_num_pages) ){ ?><div class="next"><?php echo apply_filters('ampforwp_next_posts_link', get_next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Next' ).'&raquo;', 0), $paged ) ?></div><?php }?>
		        	<?php if ( get_previous_posts_link() ){ ?><div class="prev"><?php echo apply_filters( 'ampforwp_previous_posts_link', get_previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' )), $paged ); ?></div><?php }?>
		            <div class="clearfix"></div>
		        </div>
		        <?php } ?>
		    </div>

		<?php endif; ?>

	<?php do_action('ampforwp_post_after_loop') ?>

</article>

<?php do_action('ampforwp_home_below_loop') ?>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>
