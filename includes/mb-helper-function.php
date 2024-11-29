<?php


// Exit if accessed directly
if( !defined( 'ABSPATH' ) )
    exit;

/**
 * Helper method to check if user is in the plugins page.
 *
 * @author 
 * @since  1.4.0
 *
 * @return bool
 */
function ampforwp_is_plugins_page() {
    
    if ( function_exists( 'get_current_screen' ) ){

        $screen = get_current_screen();

            if ( is_object( $screen ) ) {
                if ( $screen->id == 'plugins' || $screen->id == 'plugins-network' ) {
                    return true;
                }
            }
    }
    
    return false;

}

/**
 * display deactivation logic on plugins page
 * 
 * @since 1.4.0
 */


function ampforwp_add_deactivation_feedback_modal() {
      
    if( is_admin() && ampforwp_is_plugins_page() ) {

        $email = '';
        $current_user = wp_get_current_user();
        if( ($current_user instanceof WP_User) ) {
            $email = trim( $current_user->user_email );
        } 
    
        require_once AMPFORWP_PLUGIN_DIR."/includes/deactivate-feedback.php";   

    }
    
}

/**
 * send feedback via email
 * 
 * @since 1.4.0
 */
function ampforwp_send_feedback() {
 /* phpcs:ignore WordPress.Security.NonceVerification.Missing */
    if( isset( $_POST['data'] ) ) {
        /* phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized,WordPress.Security.NonceVerification.Missing */
        parse_str( wp_unslash( $_POST['data'] ), $form );
    }

    $text = '';
    if( isset( $form['ampforwp_disable_text'] ) ) {
        $text = implode( "\n\r", $form['ampforwp_disable_text'] );
    }

    $headers = array();

    $from = isset( $form['ampforwp_disable_from'] ) ? $form['ampforwp_disable_from'] : '';
    if( $from ) {
        $headers[] = "From: $from";
        $headers[] = "Reply-To: $from";
    }

    $subject = isset( $form['ampforwp_disable_reason'] ) ? $form['ampforwp_disable_reason'] : '(no reason given)';

    $subject = $subject.' - Accelerated Mobile Pages';

    if($subject == 'technical - Accelerated Mobile Pages'){

          $text = trim($text);

          if(!empty($text)){

            $text = 'technical issue description: '.$text;

          }else{

            $text = 'no description: '.$text;
          }
      
    }

    wp_mail( 'team@magazine3.in', $subject, $text, $headers );

    die();
}

add_action( 'wp_ajax_ampforwp_send_feedback', 'ampforwp_send_feedback' );

add_action( 'admin_enqueue_scripts', 'ampforwp_enqueue_makebetter_email_js' );

function ampforwp_enqueue_makebetter_email_js() {
 
    if( is_admin() && ampforwp_is_plugins_page() ) {
    
        wp_enqueue_script( 'ampforwp-make-better-js', AMPFORWP_PLUGIN_DIR_URI . 'includes/make-better-admin.js', array( 'jquery' ), AMPFORWP_VERSION, true );
    
        wp_enqueue_style( 'ampforwp-make-better-css', AMPFORWP_PLUGIN_DIR_URI . 'includes/make-better-admin.css', false , AMPFORWP_VERSION);

    }
    
}

add_filter( 'admin_footer', 'ampforwp_add_deactivation_feedback_modal' );
