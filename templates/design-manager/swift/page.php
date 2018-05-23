<?php global $redux_builder_amp;
amp_header(); ?>
<div class="sp">
	<div <?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>class="cntr"<?php } ?>>
		<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
			<?php if ( true == $redux_builder_amp['ampforwp-bread-crumb'] ) {
				amp_breadcrumb();
			}?>
		 	<?php amp_title(); ?>
		<?php } ?>
		<?php if ( isset($redux_builder_amp['swift-featued-image']) && $redux_builder_amp['swift-featued-image'] && ampforwp_has_post_thumbnail() ) { ?>
			<div class="sf-img">
				<?php amp_featured_image();?>
			</div>
		<?php } ?>
       <div class="pg">
			<div class="cntn-wrp">
				<?php amp_content(); ?>
			</div>
			<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
			<div class="cmts">
				<?php amp_comments();?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php amp_footer()?>
