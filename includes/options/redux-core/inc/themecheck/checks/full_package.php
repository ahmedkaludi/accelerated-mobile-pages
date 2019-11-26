<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    class Redux_Full_Package implements themecheck {
        protected $error = array();

        function check( $php_files, $css_files, $other_files ) {

            $ret = true;

            $check = Redux_ThemeCheck::get_instance();
            $redux = $check::get_redux_details( $php_files );

            if ( $redux ) {

                $blacklist = array(
                    '.tx'                    => __( 'Redux localization utilities', 'accelerated-mobile-pages' ),
                    'bin'                    => __( 'Redux Resting Diles', 'accelerated-mobile-pages' ),
                    'codestyles'             => __( 'Redux Code Styles', 'accelerated-mobile-pages' ),
                    'tests'                  => __( 'Redux Unit Testing', 'accelerated-mobile-pages' ),
                    'class.redux-plugin.php' => __( 'Redux Plugin File', 'accelerated-mobile-pages' ),
                    'bootstrap_tests.php'    => __( 'Redux Boostrap Tests', 'accelerated-mobile-pages' ),
                    '.travis.yml'            => __( 'CI Testing FIle', 'accelerated-mobile-pages' ),
                    'phpunit.xml'            => __( 'PHP Unit Testing', 'accelerated-mobile-pages' ),
                );

                $errors = array();

                foreach ( $blacklist as $file => $reason ) {
                    checkcount();
                    if ( file_exists( $redux['parent_dir'] . $file ) ) {
                        $errors[ $redux['parent_dir'] . $file ] = $reason;
                    }
                }

                if ( ! empty( $errors ) ) {
                    $error = '<span class="tc-lead tc-required">REQUIRED</span> ' . __( 'It appears that you have embedded the full Redux package inside your theme. You need only embed the <strong>ReduxCore</strong> folder. Embedding anything else will get your rejected from theme submission. Suspected Redux package file(s):', 'accelerated-mobile-pages' );
                    $error .= '<ol>';
                    foreach ( $errors as $key => $e ) {
                        $error .= '<li><strong>' . $e . '</strong>: ' . $key . '</li>';
                    }
                    $error .= '</ol>';
                    $this->error[] = '<div class="redux-error">' . $error . '</div>';
                    $ret           = false;
                }
            }

            return $ret;
        }

        function getError() {
            return $this->error;
        }
    }

    $themechecks[] = new Redux_Full_Package();