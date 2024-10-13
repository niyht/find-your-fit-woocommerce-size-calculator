<?php
/**
 * Plugin Name: Find Your Fit
 * Description: A WooCommerce plugin to help customers find their fit by entering height, weight, and typical size.
 * Version: 1.0.0
 * Author: Brksoft
 * Text Domain: find-your-fit
 * Domain Path: /languages
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Localizations
function find_your_fit_load_textdomain() {
    load_plugin_textdomain( 'find-your-fit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'find_your_fit_load_textdomain' );

// Define plugin URL path
if ( ! defined( 'FYFFW_PLUGIN_URL' ) ) {
    define( 'FYFFW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

function fyffw_admin_enqueue_scripts() {
    // Use WooCommerce's built-in SelectWoo library
    wp_enqueue_script( 'wc-enhanced-select' ); 
    wp_enqueue_style( 'woocommerce_admin_styles' ); 

    wp_enqueue_script( 'find-your-fit-script', plugin_dir_url( __FILE__ ) . 'assets/js/fyffw-category-search.js', array( 'jquery', 'wc-enhanced-select' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'fyffw_admin_enqueue_scripts' );

// Function to display the product page content
function find_your_fit_button_display() {
    // Include the single-product-button.php file
    if ( is_product() ) { // Ensure it's a product page
        require_once plugin_dir_path( __FILE__ ) . 'includes/single-product-button.php';
    }
}
add_action( 'woocommerce_before_add_to_cart_form', 'find_your_fit_button_display' );

// AJAX handling for size recommendation
function find_your_fit_ajax_handler() {
    check_ajax_referer('find_your_fit_nonce', 'nonce'); // Nonce check

    $height = isset($_POST['height']) ? absint($_POST['height']) : 0;
    $weight = isset($_POST['weight']) ? absint($_POST['weight']) : 0;
    $usual_size = isset($_POST['usual_size']) ? sanitize_text_field( wp_unslash( $_POST['usual_size'] ) ) : '';

    // Simple verification example
    if (!$height || !$weight || !$usual_size) {
        wp_send_json_error(array('message' => __('Please fill in all fields with valid data.', 'find-your-fit')));
    }

    $recommended_size = $usual_size; // Example logic

    wp_send_json_success(array('recommended_size' => $recommended_size));
}
add_action('wp_ajax_find_your_fit', 'find_your_fit_ajax_handler');
add_action('wp_ajax_nopriv_find_your_fit', 'find_your_fit_ajax_handler');

// Include product-metabox.php file
if ( file_exists( plugin_dir_path( __FILE__ ) . 'includes/product-metabox.php' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/product-metabox.php';
}

// Include admin-page.php file
if ( file_exists( plugin_dir_path( __FILE__ ) . 'admin/admin-page.php' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
}