<?php
	/**
	 * The template for the panel header area.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 		Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.5.4.18
	 */
    $tip_title = __( 'Developer Mode Enabled', 'redux-framework' );

    if ( $this->parent->dev_mode_forced ) {
        $is_debug     = false;
        $is_localhost = false;

        $debug_bit = '';
        if ( Redux_Helpers::isWpDebug() ) {
            $is_debug  = true;
            $debug_bit = __( 'WP_DEBUG is enabled', 'redux-framework' );
        }

        $localhost_bit = '';
        if ( Redux_Helpers::isLocalHost() ) {
            $is_localhost  = true;
            $localhost_bit = __( 'you are working in a localhost environment', 'redux-framework' );
        }

        $conjunction_bit = '';
        if ( $is_localhost && $is_debug ) {
            $conjunction_bit = ' ' . __( 'and', 'redux-framework' ) . ' ';
        }

        $tip_msg = __( 'This has been automatically enabled because', 'redux-framework' ) . ' ' . $debug_bit . $conjunction_bit . $localhost_bit . '.';
    } else {
        $tip_msg = __( 'If you are not a developer, your theme/plugin author shipped with developer mode enabled. Contact them directly to fix it.', 'redux-framework' );
    }

?>
<div id="redux-header">
    <?php if ( ! empty( $this->parent->args['display_name'] ) ) { ?>
        <div class="display_header">

            <h2><?php echo $this->parent->args['display_name']; ?></h2>

            <?php if ( ! empty( $this->parent->args['display_version'] ) ) { ?>
                <span><?php echo $this->parent->args['display_version']; ?></span>
            <?php } ?>

        </div>
    <?php } ?>

	<div id="right-elements">
        <div class="links">
            <?php if ( uwl_fs()->is_not_paying() ) {  ?>
                <span class="uwl-premium-message"><?php _e( '20+ awesome widgets, more widgets styling, premium support', 'kho' ); ?> <a href="<?php echo uwl_fs()->get_upgrade_url(); ?>"><?php _e( 'upgrade Now!', 'kho' ); ?></a></span>
            <?php } ?>
            <a href="<?php echo admin_url( 'admin.php?page=uwl_options-contact' ); ?>" class="uwl-support" target="_blank"><?php _e( 'Support Request', 'kho' ); ?></a>
        </div>

		<?php if ( isset( $this->parent->args['share_icons'] ) ) : ?>
            <div id="redux-share">
                <?php foreach ( $this->parent->args['share_icons'] as $link ) : ?>
                    <?php
                    // SHIM, use URL now
                    if ( isset( $link['link'] ) && ! empty( $link['link'] ) ) {
                        $link['url'] = $link['link'];
                        unset( $link['link'] );
                    }
                    ?>

                    <a href="<?php echo esc_url($link['url']) ?>" title="<?php echo esc_attr($link['title']); ?>" target="_blank">

                        <?php if ( isset( $link['icon'] ) && ! empty( $link['icon'] ) ) : ?>
                            <i class="<?php
                                if ( strpos( $link['icon'], 'el-icon' ) !== false && strpos( $link['icon'], 'el ' ) === false ) {
                                    $link['icon'] = 'el ' . $link['icon'];
                                }
                                echo esc_attr($link['icon']);
                            ?>"></i>
                        <?php else : ?>
                            <img src="<?php echo esc_url($link['img']) ?>"/>
                        <?php endif; ?>

                    </a>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
	</div>

	<div class="clear"></div>
</div>