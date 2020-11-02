<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $redux_builder_amp;
do_action('ampforwp_above_the_title',$this); ?>
<header class="amp-wp-content amp-wp-article-header ampforwp-title">
	<?php
	$ampforwp_title = $this->get( 'post_title' ) ;
	$ampforwp_title =  apply_filters('ampforwp_filter_single_title', $ampforwp_title);
	if(!empty($ampforwp_title) && ampforwp_default_logo() && ampforwp_get_setting('opt-media','url')!=''){
	?>
	<h1 class="amp-wp-title"><?php echo wp_kses_data( $ampforwp_title );?></h1>
	<?php
	}else{?>
		<h2 class="amp-wp-title"><?php echo wp_kses_data( $ampforwp_title );?></h2>
	<?php }
	?>
	<?php if( array_key_exists( 'enable-excerpt-single' , $redux_builder_amp ) ) {
				if($redux_builder_amp['enable-excerpt-single']) {
					$class = 'large-screen-excerpt-design-3';
					if(true == ampforwp_get_setting('excerpt-option-design-3')){
					$class = 'small-screen-excerpt-design-3';	
					}
					if( has_excerpt() ){ ?>
					<div class="ampforwp_single_excerpt <?php echo esc_attr($class) ?>">
						<?php $content = get_the_excerpt();
						echo wp_kses_post($content); ?>
					</div> <?php
					}
				}
			} ?>
</header>
<?php do_action('ampforwp_below_the_title',$this); ?>