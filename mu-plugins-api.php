<?php
/**
 * Plugin Name: Must-Use Plugins API
 * Description: Custom Request Handler
 * Author: funcyChaos
 * Version: 1.0
 * Author URI:
 */

/**
 * Another way to make get requests.
 * This can be accessed now at /?mup-api=1
 * Checkout https://deliciousbrains.com/comparing-wordpress-rest-api-performance-admin-ajax-php/
 */

if ( ! isset( $_GET['mup-api'] ) ) {
    return;
}

// Define the WordPress "DOING_AJAX" constant.
// if ( ! defined( 'DOING_AJAX' ) ) {
//     define( 'DOING_AJAX', true );
// }

wp_send_json(['response'=>'must use api success']);
wp_die();
