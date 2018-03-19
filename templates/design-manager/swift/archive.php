
<?php amp_header() ?>
<div class="cntr archive">
	<div class="arch-tlt">
		<?php amp_archive_title(); ?>
	</div>
	<div class="arch-psts">
		<?php amp_loop_template(); ?>
		<?php amp_pagination(); ?>
	</div>
</div>
<?php amp_footer()?>