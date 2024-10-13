<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Add menu in admin page
function fyffw_menu() { 
    add_menu_page( 
        'Find Your Fit', 
        'Find Your Fit', 
        'edit_posts', 
        'fyffw_settings', 
        'fyffw_menu_callback', 
        'dashicons-button' 
       );
  }
add_action('admin_menu', 'fyffw_menu');

// Menu callback
function fyffw_menu_callback() {
    ?>
    <div id="fyffwSettingsDiv" >
        <h2>Find Your Fit Settings</h2>
        <form method="post" action="options.php" >
            <?php
            // We initialize form settings with WordPress settings API
            settings_fields( 'fyffw_settings_group' );
            do_settings_sections( 'fyffw_settings' );
            
            $fyffwVariationValue = get_option( 'fyffwSelectVariation', 'show' );
            ?>
            
            <label for="fyffwSelectVariation" id="adminLabel">For non-variation products: </label>
            <select name="fyffwSelectVariation" id="fyffwSelectVariation">
            <option value="show" <?php selected( $fyffwVariationValue, 'show'); ?>>Show</option>
            <option value="hide" <?php selected( $fyffwVariationValue, 'hide'); ?>>Hide</option>
            </select>

            <br><br>
            
            <label for="fyffwSelectCategory" id="adminLabel">Select the categories you want to hide:</label>
            <select name="fyffwSelectCategory[]" id="fyffwSelectCategory" multiple="multiple" style="width: 80%;">
                <?php
                // Let's pull WooCommerce categories
                $all_categories = get_terms( array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => false,
                    'parent' => 0,
                ) );

                $selected_categories = get_option( 'fyffwSelectCategory' );

                if(!empty($all_categories)) {
                    foreach ($all_categories as $category) {
                        $selected = (is_array($selected_categories) && in_array($category->term_id, $selected_categories)) ? 'selected="selected"' : '';
                        echo '<option value="' . esc_attr( $category->term_id ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $category->name ) . '</option>';
                    }
                }
                ?>
            </select>

            <br><br>

            <?php

            $fyffwImgOption = get_option( 'fyffwSelectStyle', 'fyffwSelectStyle2' );
            
            ?>

            <label for="fyffw-radio-button-container">Choose the style of your button:</label>
            <div class="fyffw-radio-button-container">
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle1" <?php checked( $fyffwImgOption, 'fyffwSelectStyle1'); ?> id="fyffwSelectInput1" >
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image.png?v=3" alt="fyffwSelectStyle1" width="140px" id="fyffwSelectImg1" >
                </label>
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle2" <?php checked( $fyffwImgOption, 'fyffwSelectStyle2'); ?> id="fyffwSelectInput2">
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image-2.png" alt="fyffwSelectStyle2" width="140px" id="fyffwSelectImg2">
                </label>
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle3" <?php checked( $fyffwImgOption, 'fyffwSelectStyle3'); ?> id="fyffwSelectInput3">
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image-3.png" alt="fyffwSelectStyle3" width="140px" id="fyffwSelectImg3">
                </label>
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle4" <?php checked( $fyffwImgOption, 'fyffwSelectStyle4'); ?> id="fyffwSelectInput4">
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image-4.png?v=3" alt="fyffwSelectStyle4" width="140px" id="fyffwSelectImg4">
                </label>
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle5" <?php checked( $fyffwImgOption, 'fyffwSelectStyle5'); ?> id="fyffwSelectInput5">
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image-5.png?v=2" alt="fyffwSelectStyle5" width="140px" id="fyffwSelectImg5">
                </label>
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle6" <?php checked( $fyffwImgOption, 'fyffwSelectStyle6'); ?> id="fyffwSelectInput6">
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image-6.png?v=3" alt="fyffwSelectStyle6" width="140px" id="fyffwSelectImg6">
                </label>
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle7" <?php checked( $fyffwImgOption, 'fyffwSelectStyle7'); ?> id="fyffwSelectInput7">
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image-7.png?v=2" alt="fyffwSelectStyle7" width="140px" id="fyffwSelectImg7">
                </label>
                <label>
                <input type="radio" name="fyffwSelectStyle" value="fyffwSelectStyle8" <?php checked( $fyffwImgOption, 'fyffwSelectStyle8'); ?> id="fyffwSelectInput8">
                <img src="\wp-content\plugins\find-your-fit\assets\images\button-image-8.png" alt="fyffwSelectStyle8" width="140px" id="fyffwSelectImg8">
                </label>
            </div>

            <br><br>

            <?php

            $fyffwLocationOption = get_option( 'fyffwSelectLocation', 'beforeAddToCartForm' );
            
            ?>

            <label for="fyffwSelectLocation" id="adminLabel">Set the location of the button on the product page: </label>
            <select name="fyffwSelectLocation" id="fyffwSelectLocation">
            <option value="beforeAddToCartForm" <?php selected( $fyffwLocationOption, 'beforeAddToCartForm'); ?>>Before Add To Cart Form</option>
            <option value="singleProductSummary" <?php selected( $fyffwLocationOption, 'singleProductSummary'); ?>>Single Product Summary</option>
            <option value="beforeVariationsForm" <?php selected( $fyffwLocationOption, 'beforeVariationsForm'); ?>>Before Variations Form</option>
            <option value="beforeAddToCartQuantity" <?php selected( $fyffwLocationOption, 'beforeAddToCartQuantity'); ?>>Before Add To Cart Quantity</option>
            <option value="afterAddToCartButton" <?php selected( $fyffwLocationOption, 'afterAddToCartButton'); ?>>After Add To Cart Button</option>
            <option value="productMetaStart" <?php selected( $fyffwLocationOption, 'productMetaStart'); ?>>Product Meta Start</option>
            <option value="productMetaEnd" <?php selected( $fyffwLocationOption, 'productMetaEnd'); ?>>Product Meta End</option>
            </select>

            <br><br>

            <?php

            $fyffwSizeOption = get_option( 'fyffwSizeLocation', 'defaultSize' );
            
            ?>

            <label for="fyffwSizeLocation" id="adminLabel">Adjustment of size estimation up and down: </label>
            <select name="fyffwSizeLocation" id="fyffwSizeLocation">
            <option value="reduceSize" <?php selected( $fyffwSizeOption, 'reduceSize'); ?>>Reduce Size</option>
            <option value="defaultSize" <?php selected( $fyffwSizeOption, 'defaultSize'); ?>>Default Size</option>
            <option value="increaseSize" <?php selected( $fyffwSizeOption, 'increaseSize'); ?>>Increase Size</option>
            </select>            

            <?php submit_button();  ?>
            
        </form>
    </div>
    <?php
}

function fyffw_register_settings() {
    register_setting( 'fyffw_settings_group', 'fyffwSelectVariation' );
    register_setting( 'fyffw_settings_group', 'fyffwSelectCategory' );
    register_setting( 'fyffw_settings_group', 'fyffwSelectStyle' );
    register_setting( 'fyffw_settings_group', 'fyffwSelectLocation' );
    register_setting( 'fyffw_settings_group', 'fyffwSizeLocation' );
}
add_action( 'admin_init', 'fyffw_register_settings');

// Variations hide function
function fyffw_variations_hide() {
    global $product;
    if ( $product && ! $product->is_type('variable') ) {
        $fyffwVariationValue = get_option( 'fyffwSelectVariation', 'show' );
        if ($fyffwVariationValue === 'hide') {
            remove_action( 'woocommerce_before_add_to_cart_form', 'find_your_fit_button_display' );
        };
    };
};
add_action( 'woocommerce_before_single_product', 'fyffw_variations_hide' );

// Enqueue SelectWoo
function fyffw_enqueue_selectwoo_admin() {
    // Upload WooCommerce's SelectWoo CSS and JS files for admin
    wp_enqueue_style('selectWoo', WC()->plugin_url() . '/assets/css/select2.css', array(), '1.0.0', true );
    wp_enqueue_script('selectWoo', WC()->plugin_url() . '/assets/js/selectWoo/selectWoo.full.min.js', array('jquery' ), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'fyffw_enqueue_selectwoo_admin');

// Remove button for selected categories
function fyffw_selected_categories_hide() {

    global $product;

    $selected_categories = get_option( 'fyffwSelectCategory' );

    if (empty($selected_categories)) {
        return;
    }
    
    // Check if the product belongs to any of the selected categories
    if( has_term($selected_categories, 'product_cat', $product->get_id() ) ){
        remove_action( 'woocommerce_before_add_to_cart_form', 'find_your_fit_button_display' );
    } 
}
add_action( 'woocommerce_before_single_product', 'fyffw_selected_categories_hide' );

// Button style adjustment function
function fyffw_button_style_select() {

    $fyffwImgOption = get_option( 'fyffwSelectStyle', 'fyffwSelectStyle1' );

    if ( is_product() ) {
        // Let's dynamically add CSS files according to the selected style.
        if ($fyffwImgOption === 'fyffwSelectStyle1') {
            wp_enqueue_style( 'find-your-fit-style-1', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-1.css', array(), '1.0.0' );
        } elseif ($fyffwImgOption === 'fyffwSelectStyle2') {
            wp_enqueue_style( 'find-your-fit-style-2', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-2.css', array(), '1.0.0' );
        } elseif ($fyffwImgOption === 'fyffwSelectStyle3') {
            wp_enqueue_style( 'find-your-fit-style-3', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-3.css', array(), '1.0.0' );
        } elseif ($fyffwImgOption === 'fyffwSelectStyle4') {
            wp_enqueue_style( 'find-your-fit-style-4', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-4.css', array(), '1.0.0' );
        } elseif ($fyffwImgOption === 'fyffwSelectStyle5') {
            wp_enqueue_style( 'find-your-fit-style-5', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-5.css', array(), '1.0.0' );
        } elseif ($fyffwImgOption === 'fyffwSelectStyle6') {
            wp_enqueue_style( 'find-your-fit-style-6', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-6.css', array(), '1.0.0' );
        } elseif ($fyffwImgOption === 'fyffwSelectStyle7') {
            wp_enqueue_style( 'find-your-fit-style-7', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-7.css', array(), '1.0.0' );
        } elseif ($fyffwImgOption === 'fyffwSelectStyle8') {
            wp_enqueue_style( 'find-your-fit-style-8', FYFFW_PLUGIN_URL . 'assets/css/fyffw-button-style-8.css', array(), '1.0.0' );
        } 
    }
}
add_action( 'wp_enqueue_scripts', 'fyffw_button_style_select', 20);

// Button location settings
function fyffw_button_location() {

    remove_action( 'woocommerce_before_add_to_cart_form', 'find_your_fit_button_display' );

    $fyffwLocationOption = get_option( 'fyffwSelectLocation', 'beforeAddToCartForm' );

    if ($fyffwLocationOption === 'beforeAddToCartForm') {
        add_action( 'woocommerce_before_add_to_cart_form', 'find_your_fit_button_display' );
    } else if ($fyffwLocationOption === 'singleProductSummary') {
        add_action( 'woocommerce_single_product_summary', 'find_your_fit_button_display' );
    } elseif ($fyffwLocationOption === 'beforeVariationsForm') {
        add_action( 'woocommerce_before_variations_form', 'find_your_fit_button_display' );
    } elseif ($fyffwLocationOption === 'beforeAddToCartQuantity') {
        add_action( 'woocommerce_before_add_to_cart_quantity', 'find_your_fit_button_display' );
    } elseif ($fyffwLocationOption === 'afterAddToCartButton') {
        add_action( 'woocommerce_after_add_to_cart_button', 'find_your_fit_button_display' );
    } elseif ($fyffwLocationOption === 'productMetaStart') {
        add_action( 'woocommerce_product_meta_start', 'find_your_fit_button_display' );
    } elseif ($fyffwLocationOption === 'productMetaEnd') {
        add_action( 'woocommerce_product_meta_end', 'find_your_fit_button_display' );
    }

}
add_action( 'init', 'fyffw_button_location' );

// Common script queuing and localization
function fyffw_enqueue_and_localize_script( $handle ) {
    if ($handle === 'find-your-fit-script') {
        wp_enqueue_script( 'find-your-fit-script', FYFFW_PLUGIN_URL . 'assets/js/fyffw-button.js', array(), '1.0.0', true );
    } elseif ($handle === 'find-your-fit-script-reduce') {
        wp_enqueue_script( 'find-your-fit-script-reduce', FYFFW_PLUGIN_URL . 'assets/js/fyffw-button-reduce-size.js', array(), '1.0.0', true );
    } elseif ($handle === 'find-your-fit-script-increase') {
        wp_enqueue_script( 'find-your-fit-script-increase', FYFFW_PLUGIN_URL . 'assets/js/fyffw-button-increase-size.js', array(), '1.0.0', true );
    }

    // Localization texts for JavaScript to display messages to users
    $localization_data = array(
        // Message prompting the user to enter their height
        'pleaseEnterHeight' => __('Please enter your height.', 'find-your-fit'),

        // Message prompting the user to enter their weight
        'pleaseEnterWeight' => __('Please enter your weight.', 'find-your-fit'),

        // Translators: %1$s is the user's size.
        'sizeCorrect' => __('Based on your usual size and measurements, size %1$s seems correct.', 'find-your-fit'),

        // Translators: %1$s is the user's usual size, %2$s is the recommended size.
        'sizeRecommend' => __('You usually wear size %1$s, but based on your measurements, we recommend size %2$s. You might consider trying both to see which fits best.', 'find-your-fit'),

        // URL for AJAX requests to WordPress' admin-ajax.php
        'ajax_url' => admin_url('admin-ajax.php'),

        // Nonce for security to validate the AJAX request
        'ajax_nonce' => wp_create_nonce('find_your_fit_nonce')
    );

    // Localize depending on the script handle
    wp_localize_script( $handle, 'findYourFitData', $localization_data );
}

// Check and apply general settings
function fyffw_size_estimation() {
    if ( is_product() ) {
        global $post;
        if ($post) {
            $product_id = $post->ID;
            $fyffw_size_adjustment = get_post_meta( $product_id, 'fyffw_size_adjustment', true );
            $fyffwSizeOption = get_option( 'fyffwSizeLocation', 'defaultSize' );

            if(empty($fyffw_size_adjustment)) {
                $handle = '';

                if($fyffwSizeOption === 'defaultSize') {
                    $handle = 'find-your-fit-script';
                } elseif($fyffwSizeOption === 'reduceSize') {
                    $handle = 'find-your-fit-script-reduce';
                } elseif($fyffwSizeOption === 'increaseSize') {
                    $handle = 'find-your-fit-script-increase';
                }

                // Scriptlerin sadece bir kez kuyruklanması ve localize edilmesi
                fyffw_enqueue_and_localize_script( $handle );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'fyffw_size_estimation', 31 );