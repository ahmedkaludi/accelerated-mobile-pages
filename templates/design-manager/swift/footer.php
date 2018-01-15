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
<?php if(is_single()){ ?>
<div class="swift-sticky-social">
	<?php $social_icons = ampforwp_swift_social_icons();
						amp_social($social_icons);?> 
</div>
<?php } ?>
<?php amp_footer_core(); ?>