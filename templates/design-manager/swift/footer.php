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
			<?php if ( has_nav_menu( 'amp-footer-menu' ) ) { ?>
			<div class="f-menu">
				<nav itemscope="" itemtype="https://schema.org/SiteNavigationElement">
	              <?php
	              $menu = wp_nav_menu( array(
	                  'theme_location' => 'amp-footer-menu',
	                  'link_before'     => '<span itemprop="name">',
	                  'link_after'     => '</span>',
	                  'echo' => false
	              ) );
	              $menu = apply_filters('ampforwp_menu_content', $menu);
	              $sanitizer_obj = new AMPFORWP_Content( $menu, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
	              $sanitized_menu =  $sanitizer_obj->get_amp_content();
	              echo $sanitized_menu; ?>
	           </nav>
			</div>
			<?php } ?>
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