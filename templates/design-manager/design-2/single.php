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

		<?php do_action('ampforwp_post_after_design_elements') ?>
	</article>
</main>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
