<div class="wrap about-wrap">
    <h1><?php esc_html_e( 'Redux Framework - Changelog', 'accelerated-mobile-pages' ); ?></h1>

    <div class="about-text">
        <?php esc_html_e( 'Our core mantra at Redux is backwards compatibility. With hundreds of thousands of instances worldwide, you can be assured that we will take care of you and your clients.', 'accelerated-mobile-pages' ); ?>
    </div>
    <div class="redux-badge">
        <i class="el el-redux"></i>
        <span>
            <?php 
            /* translators: %s: version */
            /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped,WordPress.WP.I18n.MissingTranslatorsComment */
            printf( __( 'Version %s', 'accelerated-mobile-pages' ), esc_html(ReduxFramework::$_version) ); 
            ?>
        </span>
    </div>

    <?php $this->actions(); ?>
    <?php $this->tabs(); ?>

    <div class="changelog">
        <div class="feature-section">
            <?php echo wp_kses_post($this->parse_readme()); ?>
        </div>
    </div>

</div>