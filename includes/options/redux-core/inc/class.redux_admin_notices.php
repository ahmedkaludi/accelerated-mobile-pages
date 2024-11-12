<?php
    namespace ReduxCore\ReduxFramework;
    /**
     * Redux Framework Admin Notice Class
     * Makes instantiating a Redux object an absolute piece of cake.
     *
     * @package     Redux_Framework
     * @author      Kevin Provance
     * @author      Dovy Paukstys
     * @subpackage  Core
     */

    // Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    // Don't duplicate me!
    if ( ! class_exists( 'ReduxCore\\ReduxFramework\\Redux_Admin_Notices' ) ) {

        /**
         * Redux API Class
         * Simple API for Redux Framework
         *
         * @since       1.0.0
         */
        class Redux_Admin_Notices {

            static public $_parent;

            public static function load() {
                add_action( 'wp_ajax_redux_hide_admin_notice', array(
                    'ReduxCore\\ReduxFramework\\Redux_Admin_Notices',
                    'dismissAdminNoticeAJAX'
                ) );
            }

            /**
             * adminNotices - Evaluates user dismiss option for displaying admin notices
             *
             * @since       3.2.0
             * @access      public
             * @return      void
             */
            public static function adminNotices( $notices = array() ) {
                global $current_user, $pagenow;

                // Check for an active admin notice array
                if ( ! empty( $notices ) ) {

                    // Enum admin notices
                    foreach ( $notices as $notice ) {

                        $add_style = '';
                        if ( strpos( $notice['type'], 'redux-message' ) != false ) {
                            $add_style = 'style="border-left: 4px solid ' . esc_attr( $notice['color'] ) . '!important;"';
                        }

                        if ( true == $notice['dismiss'] ) {

                            // Get user ID
                            $userid = $current_user->ID;

                            if ( ! get_user_meta( $userid, 'ignore_' . $notice['id'] ) ) {

                                // Check if we are on admin.php.  If we are, we have
                                // to get the current page slug and tab, so we can
                                // feed it back to Wordpress.  Why>  admin.php cannot
                                // be accessed without the page parameter.  We add the
                                // tab to return the user to the last panel they were
                                // on.
                                $pageName = '';
                                $curTab   = '';
                                if ( $pagenow == 'admin.php' || $pagenow == 'themes.php' ) {

                                    // Get the current page.  To avoid errors, we'll set
                                    // the redux page slug if the GET is empty.
                                    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
                                    $pageName = empty( $_GET['page'] ) ? '&amp;page=' . self::$_parent->args['page_slug'] : '&amp;page=' . esc_attr( sanitize_text_field( wp_unslash( $_GET['page'] ) ) );

                                    // Ditto for the current tab.
                                    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
                                    $curTab = empty( $_GET['tab'] ) ? '&amp;tab=0' : '&amp;tab=' . esc_attr( sanitize_text_field( wp_unslash( $_GET['tab'] ) ) );
                                }

                                global $wp_version;
                                // Print the notice with the dismiss link
                                if ( version_compare( $wp_version, '4.2', '>' ) ) {
                                    $output    = "";
                                    $css_id    = esc_attr( $notice['id'] ) . $pageName . $curTab;
                                    $css_class = esc_attr( $notice['type'] ) . ' redux-notice notice is-dismissible redux-notice';
                                    $output .= "<div {$add_style} id='$css_id' class='$css_class'> \n";
                                    $nonce = wp_create_nonce( $notice['id'] . $userid . 'nonce' );
                                    $output .= "<input type='hidden' class='dismiss_data' id='" . esc_attr( $notice['id'] ) . $pageName . $curTab . "' value='{$nonce}'> \n";
                                    $output .= '<p>' . wp_kses_post( $notice['msg'] ) . '</p>';
                                    $output .= "</div> \n";
                                    echo $output;
                                } else {
                                    echo '<div ' . $add_style . ' class="' . esc_attr( $notice['type'] ) . ' notice is-dismissable"><p>' . wp_kses_post( $notice['msg'] ) . '&nbsp;&nbsp;<a href="?dismiss=true&amp;id=' . esc_attr( $notice['id'] ) . $pageName . $curTab . '">' . esc_html__( 'Dismiss', 'accelerated-mobile-pages' ) . '</a>.</p></div>';
                                }
                            }
                        } else {
                            // Standard notice
                            echo '<div ' . $add_style . ' class="' . esc_attr( $notice['type'] ) . ' notice"><p>' . wp_kses_post( $notice['msg'] ) . '</a>.</p></div>';
                        }
                        ?>
                        <script>
                            jQuery( document ).ready(
                                function( $ ) {
                                    $( 'body' ).on(
                                        'click', '.redux-notice.is-dismissible .notice-dismiss', function( event ) {
                                            var $data = $( this ).parent().find( '.dismiss_data' );
                                            $.post(
                                                ajaxurl, {
                                                    action: 'redux_hide_admin_notice',
                                                    id: $data.attr( 'id' ),
                                                    nonce: $data.val()
                                                }
                                            );
                                        }
                                    );
                                }
                            );
                        </script>
                        <?php
                        /*

                         */

                    }


                    // Clear the admin notice array
                    self::$_parent->admin_notices = array();
                }
            }

            /**
             * dismissAdminNotice - Updates user meta to store dismiss notice preference
             *
             * @since       3.2.0
             * @access      public
             * @return      void
             */
            public static function dismissAdminNotice() {
                global $current_user;

                // Verify the dismiss and id parameters are present.
                if ( isset( $_GET['dismiss'] ) && isset( $_GET['id'] ) ) {
                    if ( 'true' == $_GET['dismiss'] || 'false' == $_GET['dismiss'] ) {

                        // Get the user id
                        $userid = $current_user->ID;

                        // Get the notice 
                        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
                        $id  = esc_attr( sanitize_text_field( wp_unslash( $_GET['id'] ) ) );
                        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: We are not processing form information.
                        $val = esc_attr( sanitize_text_field( wp_unslash( $_GET['dismiss'] ) ) );
                        if ( isset( $_POST['nonce'] ) &&  ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), $id . $userid . 'nonce' ) ) {
                            die( 0 );
                        } else {
                        // Add the dismiss request to the user meta.
                        update_user_meta( $userid, 'ignore_' . $id, $val );
                        }
                    }
                }
            }

            /**
             * dismissAdminNotice - Updates user meta to store dismiss notice preference
             *
             * @since       3.2.0
             * @access      public
             * @return      void
             */
            public static function dismissAdminNoticeAJAX() {
                global $current_user;

                // Get the notice id
                // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Reason: verify nonce in line 187.
                $id = explode( '&', intval($_POST['id']) );
                $id = $id[0];
                // Get the user id
                $userid = $current_user->ID;

                if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), $id . $userid . 'nonce' ) ) {
                    die( 0 );
                } else {
                    // Add the dismiss request to the user meta.
                    update_user_meta( $userid, 'ignore_' . $id, true );
                }
            }
        }

        Redux_Admin_Notices::load();
    }
