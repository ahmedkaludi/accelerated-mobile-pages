<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/* * BFCM Banner Integration
 * Loads assets from assets/css and assets/js
 */
add_action('admin_enqueue_scripts', 'amp_for_wp_enqueue_bfcm_assets');

function amp_for_wp_enqueue_bfcm_assets($hook) { 
 
    //var_dump($hook);
    if ( $hook !== 'toplevel_page_amp_options' ) {
        return;
    }
    
    // 2. define settings
    $expiry_date_str = '2025-12-25 23:59:59'; 
    $offer_link      = 'https://ampforwp.com/bfcm-2025/';

    // 3. Expiry Check (Server Side)
    if ( current_time('timestamp') > strtotime($expiry_date_str) ) {
        return; 
    }

    // 4. Register & Enqueue CSS    
    wp_enqueue_style(
        'ampforwp-bfcm-style', 
        plugin_dir_url(__FILE__) . 'css/bfcm-style.css', 
        array(), 
        '1.0.0'
    );

    // 5. Register & Enqueue JS
    wp_enqueue_script(
        'ampforwp-bfcm-script', 
        plugin_dir_url(__FILE__) . 'js/bfcm-script.js', 
        array('jquery'), 
        '1.0.0', 
        true
    );

    // 6. Data Pass (PHP to JS)
    wp_localize_script('ampforwp-bfcm-script', 'bfcmData', array(
        'targetDate' => $expiry_date_str,
        'offerLink'  => $offer_link
    ));
}

