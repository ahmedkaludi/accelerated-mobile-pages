<div class="wrap about-wrap" xmlns="http://www.w3.org/1999/html">
    <h1><?php esc_html_e( 'Redux Framework - Support', 'accelerated-mobile-pages' ); ?></h1>
    <div class="about-text">
        <?php esc_html_e( 'We are an open source project used by developers to make powerful control panels.', 'accelerated-mobile-pages' ); ?>
    </div>
    <div class="redux-badge">
        <i class="el el-redux"></i>
        <span>
        <?php 
        /* translators: %s: version */
        /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped,WordPress.WP.I18n.MissingTranslatorsComment */
        printf( __( 'Version %s', 'accelerated-mobile-pages' ), esc_html(ReduxFramework::$_version) ); ?></span>
    </div>

    <?php $this->actions(); ?>
    <?php $this->tabs(); ?>

    <div id="support_div" class="support">

        <!-- multistep form -->
        <form id="supportform">
            <ul id="progressbar" class=" breadcrumb">
                <li class="active"><?php esc_html_e( 'Generate a Support URL', 'accelerated-mobile-pages' ); ?></li>
                <li href="#"><?php esc_html_e( 'Select Support Type', 'accelerated-mobile-pages' ); ?></li>
                <li href="#"><?php esc_html_e( 'How to Get Support', 'accelerated-mobile-pages' ); ?></li>
            </ul>

            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">
                    <?php esc_html_e( 'Submit a Support Request', 'accelerated-mobile-pages' ); ?>
                </h2>

                <h3 class="fs-title" style="margin-top:0;">
                    <?php 
                    esc_html_e( 'To get started, we will need to generate a support hash.', 'accelerated-mobile-pages' ); ?>
                </h3>

                <p>
                    <?php 
                    /* translators: %s: href */
                    echo sprintf( wp_kses( __( 'This will provide to your developer all the information they may need to remedy your issue. This action WILL send information securely to a remote server. To see the type of information sent, please look at the  <a href="%s">Status tab</a>.', 'accelerated-mobile-pages' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'tools.php?page=redux-status' ) ) ); ?>
                </p>

                <p>
                    <a href="#" class="docs button button-primary button-large redux_support_hash">
                        <?php esc_html_e( 'Generate a Support URL', 'accelerated-mobile-pages' ); ?>
                    </a>
                </p>
                <input type="button" 
                       name="next" 
                       class="next hide action-button"
                       value="Next"
                />
            </fieldset>

            <fieldset>
                <h2 class="fs-title">
                    <?php esc_html_e( 'Select Your Support Type', 'accelerated-mobile-pages' ); ?>
                </h2>

                <h3 class="fs-subtitle" style="text-align: center;">
                    <?php esc_html_e( 'What type of user are you?', 'accelerated-mobile-pages' ); ?>
                </h3>

                <table id="user_type">
                    <tr>
                        <td id="is_user">
                            <i class="el el-user"></i><br/>
                            <?php esc_html_e( 'User', 'accelerated-mobile-pages' ); ?><br/>
                            <small>
                                <?php esc_html_e( 'I am a user, using a pre-built product.', 'accelerated-mobile-pages' ); ?>
                            </small>
                        </td>
                        <td id="is_developer">
                            <i class="el el-github"></i><br/>
                            <?php esc_html_e( 'Developer', 'accelerated-mobile-pages' ); ?><br/>
                            <small>
                                <?php esc_html_e( 'I am a developer, building a product using Redux.', 'accelerated-mobile-pages' ); ?>
                            </small>
                        </td>
                    </tr>
                </table>

                <input type="button" 
                       name="next" 
                       class="next action-button hide" 
                       value="Next"
                />
            </fieldset>
            
            <fieldset id="final_support">
                <h2 class="fs-title">
                    <?php esc_html_e( 'How to Get Support', 'accelerated-mobile-pages' ); ?>
                </h2>

                <div class="is_developer">
                    <p>
                        <?php esc_html_e( 'Please proceed to the Redux Framework issue tracker and supply us with your support URL below. Please also provide any information that will help us to reproduce your issue.', 'accelerated-mobile-pages' ); ?>
                    </p>
                    <a href="<?php echo esc_url('https://github.com/reduxframework/redux-framework/issues') ?>" target="_blank">
                        <h4>https://github.com/reduxframework/redux-framework/issues</h4>
                    </a>
                </div>
                
                <div class="is_user">
                    <p align="left">
                        <?php esc_html_e( 'Listed below are the Wordpress plugins and/or theme installed on your site that utilize Redux Framework. We do not directly support products created with our framework.  It is the responsibility of the plugin or theme developer to support their work. You will need to contact the author(s) of the products listed below with your support questions.', 'accelerated-mobile-pages' ); ?>
                    </p>
                    <p>
                        <strong>
                            <?php esc_html_e( 'Please be sure to include for your developer - via cut and paste - the Support URL in the box below.', 'accelerated-mobile-pages' ); ?>
                        </strong>
                    </p>
<?php
                        $redux = ReduxFrameworkInstances::get_all_instances();
                        
                        if ( ! empty( $redux ) ) {
                            echo '<code style="line-height: 30px;">';
                            foreach ( $redux as $panel ) {
                                echo '&nbsp;' . esc_html($panel->args['display_name']) . '';
                                if ( ! empty( $panel->args['display_version'] ) ) {
                                    echo ' v' . esc_html($panel->args['display_version']);
                                }
                                echo '&nbsp;<br />';
                            }
                            echo '</code><br />';
                        }
?>
                </div>
                <textarea type="text" 
                          id="support_hash" 
                          name="hash" 
                          placeholder="Support Hash" 
                          readonly="readonly"
                          class="hash" 
                          value="http://support.redux.io/"></textarea>

                <p>
                    <em>
                        <?php
                        /* translators: %s: href */
                         echo sprintf( wp_kses( __( 'Should the developer not be responsive, read the <a href="%s" target="_blank">following article</a> before asking for support from us directly.', 'accelerated-mobile-pages' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( 'http://docs.reduxframework.com/core/support-defined/' ) );?>
                    </em>
                </p>
                <input type="button" 
                       name="previous" 
                       class="previous action-button" 
                       value="Go Back"
                />
            </fieldset>
        </form>
        <div class="clear" style="clear:both;"></div>
    </div>
</div>