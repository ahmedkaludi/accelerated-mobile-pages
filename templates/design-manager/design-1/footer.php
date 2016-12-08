<?php global $redux_builder_amp; ?>
<footer class="amp-wp-footer">
	<div>
		<h2><?php echo esc_html( $this->get( 'blog_name' ) ); ?></h2>
		<p>
			<?php
			global $allowed_html;
			echo wp_kses($redux_builder_amp['amp-translator-footer-text'],$allowed_html) ;
 		?>
		</p>
		<a href="#top" class="back-to-top"><?php echo esc_html($redux_builder_amp['amp-translator-top-text']) ; ?></a>

	</div>
</footer>
