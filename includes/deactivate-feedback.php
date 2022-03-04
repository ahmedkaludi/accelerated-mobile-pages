<?php 
$reasons = array(
    	1 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="temporary"/>' . esc_html__('It is only temporary', 'accelerated-mobile-pages') . '</label></li>',
		2 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="stopped"/>' . esc_html__('I stopped using AMP on my site', 'accelerated-mobile-pages') . '</label></li>',
		3 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="missing"/>' . esc_html__('I miss a feature', 'accelerated-mobile-pages') . '</label></li>
		<li><input type="text" class="mb-box missing" name="ampforwp_disable_text[]" value="" placeholder="Please describe the feature"/></li>',
		4 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="technical"/>' . esc_html__('Technical Issue', 'accelerated-mobile-pages') . '</label></li>
		<li><textarea  class="mb-box technical" name="ampforwp_disable_text[]" placeholder="' . esc_html__('How Can we help? Please describe your problem', 'accelerated-mobile-pages') . '"></textarea></li>',
		5 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="another"/>' . esc_html__('I switched to another plugin', 'accelerated-mobile-pages') .  '</label></li>
		<li><input type="text"  class="mb-box another" name="ampforwp_disable_text[]" value="" placeholder="Name of the plugin"/></li>',
		6 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="other"/>' . esc_html__('Other reason', 'accelerated-mobile-pages') . '</label></li>
		<li><textarea  class="mb-box other" name="ampforwp_disable_text[]" placeholder="' . esc_html__('Please specify, if possible', 'accelerated-mobile-pages') . '"></textarea></li>',
    );
shuffle($reasons);
?>


<div id="ampforwp-reloaded-feedback-overlay" style="display: none;">
    <div id="ampforwp-reloaded-feedback-content">
	<form action="" method="post">
	    <h3><strong><?php echo esc_html__('If you have a moment, please let us know why you are deactivating:', 'accelerated-mobile-pages'); ?></strong></h3>
	    <ul>
                <?php 
                foreach ($reasons as $reason){
                    echo $reason;
                }
                ?>
	    </ul>
	    <?php if ($email) : ?>
    	    <input type="hidden" name="ampforwp_disable_from" value="<?php echo $email; ?>"/>
	    <?php endif; ?>
	    <input id="ampforwp-reloaded-feedback-submit" class="button button-primary" type="submit" name="ampforwp_disable_submit" value="<?php echo esc_html__('Submit & Deactivate', 'accelerated-mobile-pages'); ?>"/>
	    <a class="button"><?php echo esc_html__('Only Deactivate', 'accelerated-mobile-pages'); ?></a>
	    <a class="ampforwp-for-wp-feedback-not-deactivate" href="#"><?php echo esc_html__('Don\'t deactivate', 'accelerated-mobile-pages'); ?></a>
	</form>
    </div>
</div>