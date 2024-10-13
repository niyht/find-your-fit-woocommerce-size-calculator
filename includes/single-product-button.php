<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Add the button to the WooCommerce single product page
echo '<button name="findButton" id="findButton" class="findButton">   
        <span class="shadow"></span>
        <span class="edge"></span>
        <span class="front">' . esc_html__('Find Your Fit', 'find-your-fit') . '</span>
        
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 74 74"
            height="34"
            width="34"
            class="fyffwSvg"
        >
        <circle stroke-width="3" stroke="black" r="35.5" cy="37" cx="37"></circle>
        <path
            fill="black"
            d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z"
            ></path>
        </svg>

        <svg class="fyffwSvgRuler" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M177.9 494.1c-18.7 18.7-49.1 18.7-67.9 0L17.9 401.9c-18.7-18.7-18.7-49.1 0-67.9l50.7-50.7 48 48c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-48-48 41.4-41.4 48 48c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-48-48 41.4-41.4 48 48c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-48-48 41.4-41.4 48 48c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-48-48 50.7-50.7c18.7-18.7 49.1-18.7 67.9 0l92.1 92.1c18.7 18.7 18.7 49.1 0 67.9L177.9 494.1z"/></svg>

    </button>
    

<div id="lengthDiv" style="display:none;">
    <label for="lengthInput">' . esc_html__('Enter your height', 'find-your-fit') . '</label>
    <input type="number" id="lengthInput">
    <button id="nextLength">' . esc_html__('Next', 'find-your-fit') . '</button>
</div>

<div id="weightDiv" style="display:none;">
    <label for="weightInput">' . esc_html__('Enter your weight', 'find-your-fit') . '</label>
    <input type="number" id="weightInput">
    <button id="nextWeight">' . esc_html__('Next', 'find-your-fit') . '</button>
</div>

<div id="sizeDiv" style="display:none;">
    <h3>' . esc_html__('Enter the size you usually wear', 'find-your-fit') . '</h3>
    <select name="sizeSelect" id="sizeSelect">
        <option value="S">' . esc_html__('S', 'find-your-fit') . '</option>
        <option value="M">' . esc_html__('M', 'find-your-fit') . '</option>
        <option value="L">' . esc_html__('L', 'find-your-fit') . '</option>
        <option value="XL">' . esc_html__('XL', 'find-your-fit') . '</option>
        <option value="XXL">' . esc_html__('XXL', 'find-your-fit') . '</option>
    </select>
    <button id="nextSize">' . esc_html__('Finish', 'find-your-fit') . '</button>
</div>

<div id="finalDiv" style="display:none;">
    <h3>' . esc_html__('This is probably the right size for you:', 'find-your-fit') . '</h3>
    <h3 id="finalSize"></h3>
    <button id="closeButton">' . esc_html__('Close', 'find-your-fit') . '</button>
</div>';
?>
