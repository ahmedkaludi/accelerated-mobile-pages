<?php global $redux_builder_amp;
amp_header() ?>
<div class="cntr archive">
	<div class="arch-tlt">
		<?php amp_archive_title(); ?>
	</div>
	<div class="arch-dsgn">
		<div class="arch-psts">
			<?php amp_loop_template(); ?>
			<?php amp_pagination(); ?>
		</div>
		<?php 

		if(isset($redux_builder_amp['gbl-sidebar']) && $redux_builder_amp['gbl-sidebar'] == '1'){ ?>
		<div class="sdbr-right">
			<?php 
				ob_start();
				dynamic_sidebar('swift-sidebar');
				$swift_footer_widget = ob_get_contents();
				ob_end_clean();
				$sanitizer_obj = new AMPFORWP_Content( 
									$swift_footer_widget,
									array(), 
									apply_filters( 'ampforwp_content_sanitizers', 
										array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), 
										) 
									) 
								);
				 $sanitized_footer_widget =  $sanitizer_obj->get_amp_content();
	              echo $sanitized_footer_widget;
			?>
		</div>
		<?php } ?>
	</div>
</div>
<?php amp_footer()?>