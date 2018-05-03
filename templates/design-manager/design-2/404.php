<?php global $redux_builder_amp;?>
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
<body <?php ampforwp_body_class('single-post design_2_wrapper');?> >
<?php do_action('ampforwp_body_beginning', $this); ?>
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>
	<main>
		<article class="amp-wp-content the_content">
            <h1 class="amp-wp-title">
			<?php do_action('ampforwp_post_before_design_elements') ?>
<?php global $redux_builder_amp; echo
ampforwp_translation( $redux_builder_amp['amp-translator-fourohfour'], 'Oops! That page can’t be found.'); ?>
            </h1>
			<?php do_action('ampforwp_post_after_design_elements') ?>
		</article>
	</main>

<?php do_action( 'amp_post_template_above_footer', $this ); ?>	
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>