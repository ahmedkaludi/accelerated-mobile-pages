<?php 
$reasons = array(
    		1 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="temporary"/>' . __('It is only temporary', 'ampforwp-for-wp') . '</label></li>',
		2 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="stopped showing ads"/>' . __('I stopped showing ads on my site', 'ampforwp-for-wp') . '</label></li>',
		3 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="missing feature"/>' . __('I miss a feature', 'ampforwp-for-wp') . '</label></li>
		<li><input type="text" name="ampforwp_disable_text[]" value="" placeholder="Please describe the feature"/></li>',
		4 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="technical issue"/>' . __('Technical Issue', 'ampforwp-for-wp') . '</label></li>
		<li><textarea name="ampforwp_disable_text[]" placeholder="' . __('Can we help? Please describe your problem', 'ampforwp-for-wp') . '"></textarea></li>',
		5 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="other plugin"/>' . __('I switched to another plugin', 'ampforwp-for-wp') .  '</label></li>
		<li><input type="text" name="ampforwp_disable_text[]" value="" placeholder="Name of the plugin"/></li>',
		6 => '<li><label><input type="radio" name="ampforwp_disable_reason" value="other"/>' . __('Other reason', 'ampforwp-for-wp') . '</label></li>
		<li><textarea name="ampforwp_disable_text[]" placeholder="' . __('Please specify, if possible', 'ampforwp-for-wp') . '"></textarea></li>',
    );
shuffle($reasons);
?>


<div id="ampforwp-reloaded-feedback-overlay" style="display: none;">
    <div id="ampforwp-reloaded-feedback-content">
	<form action="" method="post">
	    <h3><strong><?php _e('If you have a moment, please let us know why you are deactivating:', 'ampforwp-for-wp'); ?></strong></h3>
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
	    <input id="ampforwp-reloaded-feedback-submit" class="button button-primary" type="submit" name="ampforwp_disable_submit" value="<?php _e('Submit & Deactivate', 'ampforwp-for-wp'); ?>"/>
	    <a class="button"><?php _e('Only Deactivate', 'ampforwp-for-wp'); ?></a>
	    <a class="ampforwp-for-wp-feedback-not-deactivate" href="#"><?php _e('Don\'t deactivate', 'ampforwp-for-wp'); ?></a>
	</form>
    </div>
</div>