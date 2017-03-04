<?php
    /**
     * The template for the header sticky bar.
     * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
     *
     * @author        Redux Framework
     * @package       ReduxFramework/Templates
     * @version:      3.5.7.8
     */
?>
<div id="redux-sticky">
    <div id="info_bar">

        <a href="javascript:void(0);" class="expand_options<?php echo esc_attr(( $this->parent->args['open_expanded'] ) ? ' expanded' : ''); ?>"<?php echo $this->parent->args['hide_expand'] ? ' style="display: none;"' : '' ?>>
            <?php esc_attr_e( 'Expand', 'redux-framework' ); ?>
        </a>

        <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            if ( is_plugin_inactive( 'amp/amp.php' ) ) {?>

            <p style="background: #FFF9C4; padding: 15px; color: #fff; text-align: center; margin: 0;">
                <a style="color: #4c4c4c; text-decoration: none; font-size: 15px; line-height: 1;" href="index.php?page=ampforwp-welcome-page">Action Required 
                    <span style=" box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.2); border-radius: 40px;padding: 6px 18px 8px 20px; margin-left: 12px; color: #fff; background: rgb(48, 63, 159); font-size: 13px;">Finish Installation</span>
                </a>
            </p>
        <?php } ?>

        <div class="redux-action_bar">
            <span class="spinner"></span>
            <?php if ( false === $this->parent->args['hide_save'] ) { ?>
                <?php submit_button( esc_attr__( 'Save Changes', 'redux-framework' ), 'primary', 'redux_save', false ); ?>
            <?php } ?>
            
            <?php if ( false === $this->parent->args['hide_reset'] ) { ?>
                <?php submit_button( esc_attr__( 'Reset Section', 'redux-framework' ), 'secondary', $this->parent->args['opt_name'] . '[defaults-section]', false, array( 'id' => 'redux-defaults-section' ) ); ?>
                <?php submit_button( esc_attr__( 'Reset All', 'redux-framework' ), 'secondary', $this->parent->args['opt_name'] . '[defaults]', false, array( 'id' => 'redux-defaults' ) ); ?>
            <?php } ?>
        </div>
        <div class="redux-ajax-loading" alt="<?php esc_attr_e( 'Working...', 'redux-framework' ) ?>">&nbsp;</div>
        <div class="clear"></div>
    </div>

    <!-- Notification bar -->
    <div id="redux_notification_bar">
        <?php $this->notification_bar(); ?>
    </div>


</div>