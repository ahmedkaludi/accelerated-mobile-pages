<?php do_action('ampforwp_above_the_title',$this); ?>
<header class="amp-wp-article-header ampforwp-title">
	<h1 class="amp-wp-title"> <?php 
		$ampforwp_title = $this->get( 'post_title' ) ;
		$ampforwp_title =  apply_filters('ampforwp_filter_single_title', $ampforwp_title);
		echo wp_kses_data( $ampforwp_title ); ?>
	</h1>
</header>
<?php do_action('ampforwp_below_the_title',$this);