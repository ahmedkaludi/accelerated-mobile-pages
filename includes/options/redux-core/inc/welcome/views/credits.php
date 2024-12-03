<div class="wrap about-wrap">
    <h1><?php esc_html_e( 'Redux Framework - A Community Effort', 'accelerated-mobile-pages' ); ?></h1>

    <div class="about-text">
        <?php esc_html_e( 'We recognize we are nothing without our community. We would like to thank all of those who help Redux to be what it is. Thank you for your involvement.', 'accelerated-mobile-pages' ); ?>
    </div>
    <div class="redux-badge">
        <i class="el el-redux"></i>
        <span>
            <?php /* translators: %s: version */ 
            /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped,WordPress.WP.I18n.MissingTranslatorsComment */
            printf( __( 'Version %s', 'accelerated-mobile-pages' ), esc_html(ReduxFramework::$_version )); ?>
        </span>
    </div>

    <?php $this->actions(); ?>
    <?php $this->tabs(); ?>

    <p class="about-description">
        <?php /* translators: %s: href */
        /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped,WordPress.WP.I18n.MissingTranslatorsComment */
        echo sprintf( __( 'Redux is created by a community of developers world wide. Want to have your name listed too? <a href="%d" target="_blank">Contribute to Redux</a>.', 'accelerated-mobile-pages' ), 'https://github.com/reduxframework/redux-framework/blob/master/CONTRIBUTING.md' );?>
    </p>

    <?php echo wp_kses_post($this->contributors()); ?>
</div>