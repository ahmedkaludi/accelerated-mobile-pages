<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
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

		    $exclude_ids = get_option('ampforwp_exclude_post');

			$args = array(
				'post_type'           => 'post',
				'orderby'             => 'date',
				'paged'               => esc_attr($paged),
				'post__not_in' 		  => $exclude_ids,
                'has_password' => false ,
                'post_status'=> 'publish'
			);
			$filtered_args = apply_filters('ampforwp_query_args', $args);
			$q = new WP_Query( $filtered_args ); 
			$blog_title = ampforwp_get_blog_details('title');
			if($blog_title){  ?>
				<h1 class="page-title"><?php echo $blog_title ?> </h1>
			<?php }
			
				
			 if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post(); ?>
		        <div class="amp-wp-content amp-wp-article-header amp-loop-list">
		        	
			        <h1 class="amp-wp-title">
			            <?php  $ampforwp_post_url = get_permalink(); ?>	            

			            <a href="<?php echo ampforwp_url_controller( $ampforwp_post_url ); ?>"><?php the_title() ?></a>
			        </h1>

					<div class="amp-wp-content-loop">
						<div class="amp-wp-meta">
			              <?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author') ) );
			              global $redux_builder_amp;
			              		if($redux_builder_amp['amp-design-selector'] == '1' && $redux_builder_amp['amp-design-1-featured-time'] == '1'){
			               ?>
			              <time> <?php
                          		$post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                   				 $post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                    			echo  $post_date ;?>
                    		</time> <?php
			 		 		}
			 		 	if( isset($redux_builder_amp['ampforwp-design1-cats-home']) && $redux_builder_amp['ampforwp-design1-cats-home'] ) {
			 		 		foreach((get_the_category()) as $category) { ?>
			 		 		<ul class="amp-wp-tags">
					   			<li class="amp-cat-<?php echo $category->term_id;?>"> <?php echo  '  ' . $category->cat_name ?> </li> </ul>
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
								<?php amp_loop_image($image_args); ?>
							<?php }
														
							if(has_excerpt()){
								$content = get_the_excerpt();
							}else{
								$content = get_the_content();
							} ?>
						<p><?php global $redux_builder_amp;
							if($redux_builder_amp['excerpt-option-design-1']== true) {
								$excerpt_length = $redux_builder_amp['amp-design-1-excerpt'];
								$final_content = ""; 					
								$final_content  = apply_filters('ampforwp_modify_index_content', $content,  $excerpt_length );

								if ( false === has_filter('ampforwp_modify_index_content' ) ) {
									$final_content = wp_trim_words( strip_shortcodes( $content ) ,  $excerpt_length );
								}
								echo $final_content;
							}?></p>
					</div>
		        </div>
		         <?php 
		         do_action('ampforwp_between_loop',$count,$this);
		         $count++;
		    	
		    endwhile;  ?>
 			
		    <div class="amp-wp-content pagination-holder">

		        <div id="pagination">
		            <div class="next"><?php next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text']. ' &raquo;', 'Next'), 0 ) ?></div>
		            <div class="prev"><?php previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' ) ); ?></div>
		            <div class="clearfix"></div>
		        </div>

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
