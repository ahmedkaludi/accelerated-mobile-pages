<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    class Redux_Embedded implements themecheck {
        protected $error = array();

        function check( $php_files, $css_files, $other_files ) {

            $ret = true;
            $check = Redux_ThemeCheck::get_instance();
            $redux = $check::get_redux_details( $php_files );

            if ( $redux ) {
                if ( ! isset( $_POST['redux_wporg'] ) ) {
                    checkcount();
                    /* translators: %s: href */
                    $this->error[] = '<div class="redux-error">' . sprintf( __( '<span class="tc-lead tc-recommended">RECOMMENDED</span>: If you are submitting to WordPress.org Theme Repository, it is <strong>strongly</strong> suggested that you read <a href="%s" target="_blank">this document</a>, or your theme will be rejected because of Redux.', 'accelerated-mobile-pages' ), 'https://docs.reduxframework.com/core/wordpress-org-submissions/' ) . '</div>';
                    $ret           = false;
                } else {
                    // TODO Granular WP.org tests!!!
                    checkcount();
                    // Embedded CDN package
                    //use_cdn

                    // Arguments
                    checkcount();
                    $args = '<ol>';
                    $args .= "<li><code>'save_defaults' => false</code></li>";
                    $args .= "<li><code>'use_cdn' => false</code></li>";
                    $args .= "<li><code>'customizer_only' => true</code> Non-Customizer Based Panels are Prohibited within WP.org Themes</li>";
                    $args .= "<li><code>'database' => 'theme_mods'</code> (" . __( 'Optional', 'accelerated-mobile-pages' ) . ")</li>";
                    $args .= '</ol>';
                    $this->error[] = '<div class="redux-error">' . __( '<span class="tc-lead tc-recommended">RECOMMENDED</span>: The following arguments MUST be used for WP.org submissions, or you will be rejected because of your Redux configuration.', 'accelerated-mobile-pages' ) . $args . '</div>';


                }


            }


            return $ret;
        }


        function getError() {
            return $this->error;
        }
    }

    $themechecks[] = new Redux_Embedded;