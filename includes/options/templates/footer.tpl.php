<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
	/**
	 * The template for the panel footer area.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 		Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.5.8.3
	 */
?>
<div id="redux-sticky-padder" style="display: none;">&nbsp;</div>
<div id="redux-footer-sticky">
	<div id="redux-footer">

		<div class="redux-action_bar redux-save">
			<?php submit_button( __( 'Save Changes', 'accelerated-mobile-pages' ), 'primary', 'redux_save', false  ); ?>
			<span class="spinner"></span>
		</div>

		<div class="redux-action_bar">

			<?php if ( false === $this->parent->args['hide_reset'] ) : ?>
                <?php submit_button( __( 'Reset Section', 'accelerated-mobile-pages' ), 'secondary', $this->parent->args['opt_name'] . '[defaults-section]', false, array( 'id' => 'redux-defaults-section' ) ); ?>
                <?php submit_button( __( 'Reset All', 'accelerated-mobile-pages' ), 'secondary', $this->parent->args['opt_name'] . '[defaults]', false, array( 'id' => 'redux-defaults' ) ); ?>
            <?php endif; ?>

		</div>

		<div class="redux-ajax-loading" alt="<?php _e( 'Working...', 'accelerated-mobile-pages' ) ?>">&nbsp;</div>
		<div class="clear"></div>

	</div>
</div>
