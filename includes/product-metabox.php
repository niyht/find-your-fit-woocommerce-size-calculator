<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Create metabox
function fyffw_create_metabox() {
    add_meta_box(
        'fyffw_metabox_id',
        'Find Your Fit Button Visibility',
        'fyffw_metabox_inside',
        'product',
        'normal',
        'default',
    );
};
add_action( 'add_meta_boxes', 'fyffw_create_metabox');

// Metabox inside
function fyffw_metabox_inside($post) {
    // Nonce check
    wp_nonce_field('fyffw_metabox_nonce_action', 'fyffw_metabox_nonce_name');

    // Metabox verilerini almak için farklı meta anahtarları kullan
    $fyffw_button_visibility = get_post_meta( $post->ID , 'fyffw_button_visibility', true );
    $fyffw_size_adjustment = get_post_meta( $post->ID , 'fyffw_size_adjustment', true );

    ?>
    <select name="fyffwSelect" id="fyffwSelect">
        <option value="show" <?php selected( $fyffw_button_visibility, 'show'); ?>>Show</option>
        <option value="hide" <?php selected( $fyffw_button_visibility, 'hide'); ?>>Hide</option>
    </select>

    <br>

    <label for="fyffwSizeLocation" id="adminLabel">Adjustment of size estimation up and down: </label>
        <select name="fyffwSizeLocation" id="fyffwSizeLocation">
        <option value="defaultSize" <?php selected( $fyffw_size_adjustment, 'defaultSize'); ?>>Default Size</option>
        <option value="reduceSize" <?php selected( $fyffw_size_adjustment, 'reduceSize'); ?>>Reduce Size</option>
        <option value="increaseSize" <?php selected( $fyffw_size_adjustment, 'increaseSize'); ?>>Increase Size</option>
        </select>         

    <?php
}

// Save Metabox data
function fyffw_metabox_save( $post_id ) {

    // Nonce check
    if ( ! isset( $_POST['fyffw_metabox_nonce_name'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fyffw_metabox_nonce_name'] ) ), 'fyffw_metabox_nonce_action' ) ) {
        return; 
    }

    // Skip autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check if the user is authorized
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['fyffwSelect'] ) ) {
        // Unslash before sanitization
        $fyffw_selected_value = sanitize_text_field( wp_unslash( $_POST['fyffwSelect'] ) );
        update_post_meta( $post_id, 'fyffw_button_visibility', $fyffw_selected_value );
    }

    if ( isset( $_POST['fyffwSizeLocation'] ) ) {
        // Unslash before sanitization
        $fyffw_size_selected_value = sanitize_text_field( wp_unslash( $_POST['fyffwSizeLocation'] ) );
        update_post_meta( $post_id, 'fyffw_size_adjustment', $fyffw_size_selected_value );
    }
}
add_action( 'save_post', 'fyffw_metabox_save' );


// Display or remove the button on the front-end based on meta value
function fyffw_metabox_hide_function() {

    global $post;
    
    $fyffw_button_visibility = get_post_meta( $post->ID , 'fyffw_button_visibility', true );

    if ($fyffw_button_visibility === 'hide') {
        remove_action( 'woocommerce_before_add_to_cart_form', 'find_your_fit_button_display' );
    }
}
add_action( 'wp', 'fyffw_metabox_hide_function' );

// Run dimensioning functions on the product page
function fyffw_metabox_size_estimation() {
    if ( is_product() ) { // Only works on product pages
        global $post;

        if ($post) {
            $product_id = $post->ID;
            $fyffw_size_adjustment = get_post_meta( $product_id, 'fyffw_size_adjustment', true );

            if (!empty($fyffw_size_adjustment)) {
                $handle = '';

                if($fyffw_size_adjustment === 'defaultSize') {
                    $handle = 'find-your-fit-script';
                } elseif($fyffw_size_adjustment === 'reduceSize') {
                    $handle = 'find-your-fit-script-reduce';
                } elseif($fyffw_size_adjustment === 'increaseSize') {
                    $handle = 'find-your-fit-script-increase';
                }

                // Queuing and localizing scripts only once
                fyffw_enqueue_and_localize_script( $handle );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'fyffw_metabox_size_estimation', 32 );