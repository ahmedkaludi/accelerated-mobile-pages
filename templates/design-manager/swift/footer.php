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
	<ul>
		<li><a class="ic-fb" href="https://facebook.com/ampforwp"><span class="icon-facebook"></span></a></li>
		<li><a class="ic-tw" href="https://twitter.com/ampforwp"><span class="icon-twitter"></span></a></li>
		<li><a class="ic-gl" href="#"><span class="icon-google-plus"></span></a></li>
		<li><a class="ic-pi" href="https://www.pinterest.com/ampforwp/"><span class="icon-pinterest"></span></a></li>
		<li><a class="ic-li" href="https://linkedin.com/ampforwp"><span class="icon-linkedin"></span></a></li>
	</ul>
</div>
<?php amp_footer_core(); ?>