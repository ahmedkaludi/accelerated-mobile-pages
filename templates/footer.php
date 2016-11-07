<?php global $redux_builder_amp; ?>
<footer class="amp-wp-footer">
	<div>
		<h2><?php echo esc_html( $this->get( 'blog_name' ) ); ?></h2>
		<p> <?php echo $redux_builder_amp['amp-footer-text']; ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'amp' ) ); ?>"><?php printf( __( 'Powered by %s', 'amp' ), 'WordPress' ); ?></a>
		</p>
		<a href="#top" class="back-to-top"><?php _e( 'Back to top', 'amp' ); ?></a>
	</div>
</footer>
