<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
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
<main>
	<article class="amp-wp-article">
		<?php do_action('ampforwp_post_before_design_elements') ?>

		<?php $this->load_parts( apply_filters( 'ampforwp_design_elements', array( 'empty-filter' ) ) ); ?>
<?php
global $redux_builder_amp;

$data = get_option( 'ampforwp_design' );
if( isset( $data['elements'] ) || ! empty( $data['elements'] ) ){
	$options = explode( ',', $data['elements'] );
}
if( $options ) {
$values = array_values($options );
global $post;
$comments_count = wp_count_comments($post->ID);
if( in_array('comments:0',$values) || $comments_count->approved == 0  ) {
 ?>
		<div class="comment-button-wrapper">
		    <a href="<?php echo get_permalink().'#commentform' ?>"><?php esc_html_e( $redux_builder_amp['amp-translator-leave-a-comment-text']  ); ?></a>
		</div>
<?php }
} ?>
		<?php do_action('ampforwp_post_after_design_elements') ?>
	</article>
</main>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
