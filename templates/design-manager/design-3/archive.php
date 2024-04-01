<?php use AMPforWP\AMPVendor\AMP_HTML_Utils;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php global $redux_builder_amp, $wp, $wp_query;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
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

<body <?php ampforwp_body_class('amp_home_body design_3_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this );

if ( get_query_var( 'paged' ) ) {
      $paged = get_query_var('paged');
  } elseif ( get_query_var( 'page' ) ) {
      $paged = get_query_var('page');
  } else {
      $paged = 1;
  }

 ?>

<main>
	<?php do_action('ampforwp_post_before_loop') ?>
	<?php $count = 1; ?>
	<?php

	    $exclude_ids = ampforwp_exclude_posts();

		$q = new WP_Query( array(
			'post_type'           => 'post',
			'orderby'             => 'date',
			'no_found_rows' 	  => true,
			'ignore_sticky_posts' => 1,
			'paged'               => esc_attr($paged),
			'post__not_in' 		  => $exclude_ids,
			'has_password' => false ,
			'post_status'=> 'publish'
		) ); ?>

 	<?php if ( is_archive() ) { ?>
 		<div class="amp-wp-content">
 	<?php 
 			if( is_author() ){
 				$author_name = get_query_var('author_name');
 				$author = get_query_var('author');
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', esc_attr($author_name)) : get_userdata(esc_attr($author));
				if( true == ampforwp_gravatar_checker($curauth->user_email) ){
					$curauth_url = get_avatar_url( $curauth->user_email, array('size'=>180) );
				if(class_exists( 'UM_Functions' )){
                   $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
                   $author_id = $author->ID;
                   if(isset($author_id)){
                   		$curauth_url = "".esc_url(get_site_url())."/wp-content/uploads/ultimatemember/".intval($author_id)."/profile_photo-190x190.jpg";
 					}
                }
					if($curauth_url){ ?>
						<div class="amp-wp-content author-img">
							<amp-img <?php if(ampforwp_get_data_consent()){?>data-block-on-consent <?php } ?> src="<?php echo esc_url($curauth_url); ?>" width="90" height="90" layout="responsive"></amp-img>
						</div>
					<?php }
				}
			}

			if(ampforwp_default_logo()){
				the_archive_title( '<h1 class="amp-wp-content page-title archive-heading">', '</h1>' );
			}else{
 				the_archive_title( '<h2 class="amp-wp-content page-title archive-heading">', '</h2>' );
 			}
 			if(function_exists('ampforwp_category_image_compatibility')){
 				ampforwp_category_image_compatibility('echo','taxonomy-image');	
 			}
			$arch_desc 		= $sanitizer->get_amp_content();
			if( $arch_desc ) {  
				if($paged <= '1' && ampforwp_get_setting('ampforwp-cat-description')) {?>
					<div class="taxonomy-description">
						<?php echo do_shortcode($arch_desc);// amphtml content, no kses ?>
				  </div>
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

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
  		$ampforwp_amp_post_url  = ampforwp_url_controller( get_permalink() );

			if( in_array( 'ampforwp-custom-type-amp-endpoint' , $redux_builder_amp ) ) {
	  		if (isset($redux_builder_amp['ampforwp-custom-type-amp-endpoint']) && $redux_builder_amp['ampforwp-custom-type-amp-endpoint']) {
	  			$ampforwp_amp_post_url = trailingslashit( get_permalink() ) . '?amp';
	  		}
			}?>

		<div class="amp-wp-content amp-loop-list <?php if ( ! ampforwp_has_post_thumbnail() ) {  ?>amp-loop-list-noimg<?php } ?>">
			<?php if ( ampforwp_has_post_thumbnail() ) {
				$thumb_url = ampforwp_get_post_thumbnail();
				$thumb_width  	= ampforwp_get_post_thumbnail('width');
				$thumb_height 	= ampforwp_get_post_thumbnail('height');
				if(ampforwp_get_setting('ampforwp-homepage-posts-image-modify-size')){
					$thumb_width  	= ampforwp_get_setting('ampforwp-design-3-homepage-posts-width');
					$thumb_height 	= ampforwp_get_setting('ampforwp-design-3-homepage-posts-height');
				}
				if($thumb_url){
					?>
					<div class="home-post_image">
						<a href="<?php echo esc_url( $ampforwp_amp_post_url ); ?>">
							<amp-img
							layout="responsive"
							src=<?php echo esc_url($thumb_url); ?>
							<?php ampforwp_thumbnail_alt(); ?>
							width=<?php echo esc_attr($thumb_width); ?>
							height=<?php echo esc_attr($thumb_height); ?>
						></amp-img>
					</a>
				</div>
				<?php } 
			}?>

			<div class="amp-wp-post-content">
                <ul class="amp-wp-tags">
					<?php foreach((get_the_category()) as $category) { 
						if ( true == $redux_builder_amp['ampforwp-archive-support'] ) { ?>
						<li class="amp-cat-<?php echo esc_attr($category->term_id);?>"><a href="<?php echo ampforwp_url_controller( get_category_link( $category->term_id ) ); ?>" ><?php echo esc_attr($category->cat_name) ?></a></li>
					<?php }
					else { ?>
					   <li class="amp-cat-<?php echo esc_attr($category->term_id);?>"><?php echo esc_attr($category->cat_name) ?></li>
					<?php }
					} ?> 
                </ul>
                <?php 
					$title_name = '<a href="'.esc_url( $ampforwp_amp_post_url ).'">'.get_the_title().'</a>';
					if( ampforwp_default_logo() ){ ?>
						<h2 class="amp-wp-title"><?php echo $title_name;//escaped above ?></h2>
					<?php }else{ ?>
						<h3 class="amp-wp-title"><?php echo $title_name;//escaped above ?></h3>
					<?php } ?>
					<?php if( ampforwp_check_excerpt() ) {
						$class = 'large-screen-excerpt-design-3';
						if ( true == $redux_builder_amp['excerpt-option-design-3'] ) {
							$class = 'small-screen-excerpt-design-3';
						}
						amp_loop_excerpt( ampforwp_get_setting('amp-design-3-excerpt'), 'p', $class );
					} ?>
                <div class="featured_time"><?php
                   $post_date =  human_time_diff( get_the_time('U', get_the_ID() ), current_time('timestamp') ) .' '. ampforwp_translation( $redux_builder_amp['amp-translator-ago-date-text'],'ago' );
                	$post_date = apply_filters('ampforwp_modify_post_date',$post_date);
                	echo  esc_attr($post_date) ;?>
                </div>
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
        	<?php
        	 if ( get_next_posts_link('next', $wp_query->max_num_pages) ){ ?><div class="next"><?php echo apply_filters('ampforwp_next_posts_link',get_next_posts_link( ampforwp_translation($redux_builder_amp['amp-translator-next-text'], 'Show more Posts' ).'&raquo;', 0), $paged);?></div><?php }?>
        	<?php if ( get_previous_posts_link() ){ ?><div class="prev"><?php echo apply_filters( 'ampforwp_previous_posts_link', get_previous_posts_link( '&laquo; '. ampforwp_translation($redux_builder_amp['amp-translator-previous-text'], 'Show Previous Posts' )), $paged ); ?></div><?php }?>
			<div class="clearfix"></div>
		</div>
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