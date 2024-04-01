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
	<?php if(is_search() && false == ampforwp_get_setting('amp-inspection-tool') && false == ampforwp_get_setting('ampforwp-robots-search-pages')){?>
	<meta name="robots" content="noindex,nofollow"/><?php } ?>
  <link rel="preconnect" href="//cdn.ampproject.org">
	<?php $paged = get_query_var( 'paged' );
		$current_search_url =trailingslashit(get_home_url())."?s=".get_search_query();
		$amp_url = untrailingslashit($current_search_url);
		if ($paged > 1 ) {
			global $wp;
			$current_archive_url 	= home_url( $wp->request );
			$amp_url 				= trailingslashit($current_archive_url);
			$remove 				= '/'. AMPFORWP_AMP_QUERY_VAR;
			$amp_url				= str_replace($remove, '', $amp_url) ;
			$amp_url 				= $amp_url ."?s=".get_search_query();
		} ?>
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body <?php ampforwp_body_class('amp_home_body design_2_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>
<?php do_action( 'ampforwp_after_header', $this ); ?>
<main>
	<?php do_action('ampforwp_post_before_loop') ?>
	<?php $count = 1; ?>
	<?php
		if ( get_query_var( 'paged' ) ) {
	        $paged = get_query_var('paged');
	    } elseif ( get_query_var( 'page' ) ) {
	        $paged = get_query_var('page');
	    } else {
	        $paged = 1;
	    }

	    $exclude_ids = ampforwp_exclude_posts();

		$q = new WP_Query( apply_filters('ampforwp_query_args', array(
			's' 				  => get_search_query() ,
			'ignore_sticky_posts' => 1,
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' 		  => false,
			'no_found_rows' 	  => true,
			'post_status'		  => 'publish'
		) ) );
		if ( function_exists( 'relevanssi_do_query' ) ) {
			relevanssi_do_query( $q );
		};?>

		<div class="amp-wp-content amp-archive-heading">
		<?php if( ampforwp_default_logo() ){ ?>
			<h1 class="page-title"><?php echo ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:' ) . '  ' . get_search_query();?></h1>
		<?php }else{ ?>	
			<h2 class="page-title"><?php echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-search-text'], 'You searched for:' ) . '  ' . get_search_query());?></h2>
		<?php } ?>
 		</div>
		<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post();
			$ampforwp_amp_post_url = ampforwp_url_controller( get_permalink() ); ?>
		<div class="amp-wp-content amp-loop-list">
			<?php if ( ampforwp_has_post_thumbnail() ) {  
					$width = 100;
					$height = 75; 
					$image_args = array("tag"=>'div',"tag_class"=>'home-post_image','image_size'=>'full','image_crop'=>'true','image_crop_width'=>$width,'image_crop_height'=>$height); ?>
					<?php amp_loop_image($image_args); ?>
				<?php } ?>
			<div class="amp-wp-post-content">
				<?php 
					$title_name = '<a href="'.esc_url( $ampforwp_amp_post_url ).'">'.get_the_title().'</a>';
					if( ampforwp_default_logo() ){ ?>
						<h2 class="amp-wp-title"><?php echo $title_name;//escaped above ?></h2>
					<?php }else{ ?>
					<h3 class="amp-wp-title"><?php echo $title_name; //escaped above ?></h3>
					<?php } ?>
				<?php if( ampforwp_check_excerpt() ) {
					$class = 'large-screen-excerpt';
					if ( true == $redux_builder_amp['excerpt-option-design-2'] ) {
						$class = 'small-screen-excerpt';
					}
					amp_loop_excerpt( ampforwp_get_setting('amp-design-2-excerpt'), 'p', $class );
				} ?>
		    </div>
            <div class="cb"></div>
		</div>
		<?php
		do_action('ampforwp_between_loop',$count,$this);
		         $count++;
		 endwhile; ?>
		<div class="amp-wp-content pagination-holder">
			<div id="pagination">
				<?php if ( get_next_posts_link('next', $q->max_num_pages) ){ ?><div class="next"><?php next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text'] , 'Next') . ' &raquo;', $q->max_num_pages ) ?></div><?php }?>
				<?php if ( get_previous_posts_link() ){ ?><div class="prev"><?php previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Previous' ) ); ?></div><?php }?>
				<div class="clearfix"></div>
			</div>
		</div>
	<?php else: ?>
		<div class="amp-wp-content amp-loop-list">
			<div class="amp-wp-post-content">
				<?php echo esc_attr(ampforwp_translation($redux_builder_amp['amp-translator-search-no-found'], 
				'It seems we can\'t find what you\'re looking for. ')); ?>
		    </div>
            <div class="cb"></div>
		</div>
	<?php endif; ?>
	 <?php wp_reset_postdata(); ?>
	<?php do_action('ampforwp_post_after_loop') ?>
</main>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>