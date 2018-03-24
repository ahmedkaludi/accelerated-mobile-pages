<?php amp_header(); ?>
<div class="sp">
	<div <?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>class="cntr"<?php } ?>>
		<?php if(!checkAMPforPageBuilderStatus(get_the_ID())){ ?>
			<?php if ( true == $redux_builder_amp['ampforwp-bread-crumb'] ) {
				amp_breadcrumb();
			}?>
		 	<?php amp_title(); ?>
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
