<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
  <?php
  global $redux_builder_amp;
  if ( $redux_builder_amp['ampforwp-disqus-comments-support'] ) {
  ?>
  <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
  <?php } ?>
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?> single-post <?php if(is_page()){ echo'amp-single-page'; };?>">

<?php $this->load_parts( array( 'header-bar' ) ); ?>

<article class="amp-wp-article">
	<?php do_action('ampforwp_post_before_design_elements') ?>

	<?php $this->load_parts( apply_filters( 'ampforwp_design_elements', array( 'empty-filter' ) ) ); ?>

	<?php do_action('ampforwp_post_after_design_elements') ?>
</article>

<?php
global $redux_builder_amp;
if ( $redux_builder_amp['ampforwp-disqus-comments-support'] ) {
?>
<!--
official Disqus doc : https://github.com/disqus/disqus-install-examples/tree/master/google-amp
real comments implementation : https://labs.tomasino.org/disqus-in-amp/
this guy is using this URL : https://comments.tomasino.org/
-->
<section class="post-comments" id="comments">
	<amp-iframe
		height="350"
		sandbox="allow-forms allow-modals allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
		resizable
		frameborder="0"
    <?php global $post;
    $post_slug=$post->post_name;
    global $redux_builder_amp;
    ?>
		src="<?php echo "https://ampforwp.com/goto/".AMPFORWP_DISQUS_URL.'?disqus_title='.$post_slug.'&url='.get_permalink().'&disqus_name='.$redux_builder_amp['ampforwp-disqus-comments-name'].'/embed.js'
    ?>">
		<div overflow tabindex="0" role="button" aria-label="Read more">Read more!</div>
	</amp-iframe>
</section>
<?php } ?>
<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>

