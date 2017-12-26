</div>
<footer class="footer">
	<div class="f-w-f1">
		<div class="cntr">
			<div class="f-w">
				
				<?php 
				if ( is_active_sidebar( 'swift-footer-widget-area'  ) ) : 
					dynamic_sidebar( 'swift-footer-widget-area' ); 
				endif;
				?>

			</div>
		</div>
	</div>
	<div class="f-w-f2">
		<div class="cntr">
			<div class="f-menu">
				<?php amp_menu(); ?>
			</div>
			<div class="rr">
				<?php amp_non_amp_link(); ?>
			</div>
		</div>
	</div>
</footer>
<div class="swift-sticky-social">
	<?php amp_social(); ?>
</div>
<?php amp_footer_core(); ?>