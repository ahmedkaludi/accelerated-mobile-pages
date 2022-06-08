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
    global $pagenow;

    return ( 'plugins.php' === $pagenow );
}

/**
 * display deactivation logic on plugins page
 * 
 * @since 1.4.0
 */


function ampforwp_add_deactivation_feedback_modal() {
    
  
    if( !is_admin() && !ampforwp_is_plugins_page()) {
        return;
    }

    $current_user = wp_get_current_user();
    if( !($current_user instanceof WP_User) ) {
        $email = '';
    } else {
        $email = trim( $current_user->user_email );
    }

    require_once AMPFORWP_PLUGIN_DIR."/includes/deactivate-feedback.php";
    
}

/**
 * send feedback via email
 * 
 * @since 1.4.0
 */
function ampforwp_send_feedback() {

    if( isset( $_POST['data'] ) ) {
        parse_str( $_POST['data'], $form );
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

    $success = wp_mail( 'team@magazine3.in', $subject, $text, $headers );

    die();
}
add_action( 'wp_ajax_ampforwp_send_feedback', 'ampforwp_send_feedback' );



add_action( 'admin_enqueue_scripts', 'ampforwp_enqueue_makebetter_email_js' );

function ampforwp_enqueue_makebetter_email_js(){
 
    if( !is_admin() && !ampforwp_is_plugins_page()) {
        return;
    }

    wp_enqueue_script( 'ampforwp-make-better-js', AMPFORWP_PLUGIN_DIR_URI . 'includes/make-better-admin.js', array( 'jquery' ), AMPFORWP_VERSION);

    wp_enqueue_style( 'ampforwp-make-better-css', AMPFORWP_PLUGIN_DIR_URI . 'includes/make-better-admin.css', false , AMPFORWP_VERSION);
}

if( is_admin() && ampforwp_is_plugins_page()) {
    add_filter('admin_footer', 'ampforwp_add_deactivation_feedback_modal');
}


