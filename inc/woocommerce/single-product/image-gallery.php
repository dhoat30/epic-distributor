<?php 
// Remove sale badge (commented out)
// add_filter('woocommerce_sale_flash', 'webduel_hide_sale_flash');
// function webduel_hide_sale_flash(){
//     return false;
// }

// Start product images container
add_action('woocommerce_before_single_product_summary', function(){ 
    echo '<div class="product-images">';
}, 5);

// Close product images container
add_action('woocommerce_before_single_product_summary', function(){ 
    echo '</div>';
}, 20);

// Add custom product image & gallery 
function custom_woocommerce_product_gallery() {
    global $product;

    // Get the main (featured) image URL with a fallback to the full image if the 'woocommerce_single' size isn't available.
    $main_image_id = $product->get_image_id();
    $main_image_url = wp_get_attachment_image_url($main_image_id, 'woocommerce_single');
    $main_image_thumbnail_url = wp_get_attachment_image_url($main_image_id, 'woocommerce_gallery_thumbnail');

    if (!$main_image_url) {
        $main_image_url = wp_get_attachment_url($main_image_id); // Fallback to the original image
    }

    // Show the main product image first with <picture> element for responsive images
    echo '<div class="product-main-image">';
    echo '<picture>';
    echo '<source srcset="' . esc_url(wp_get_attachment_image_url($main_image_id, 'woocommerce_thumbnail')) . '" media="(max-width: 480px)">';
    echo '<img src="' . esc_url(wp_get_attachment_image_url($main_image_id, 'woocommerce_single')) . '" alt="' . esc_attr($product->get_name()) . '" >';
    echo '</picture>';
    echo '</div>';

    $images = $product->get_gallery_image_ids();
    
    if (!empty($images)) { 
        echo '<ul class="custom-slick-slider gallery">'; // Slick Slider Wrapper
        
        // Include the main image in the slider with fallback
        echo '<li><img alt="' . esc_attr($product->get_name()) . '" width="100px" height="100px" loading="lazy" src="' . esc_url($main_image_thumbnail_url) . '" data-large_image="' . esc_url($main_image_url) . '"></li>';

        // Loop through gallery images
        foreach ($images as $image_id) {
            $thumbnail_url = wp_get_attachment_image_url($image_id, 'woocommerce_gallery_thumbnail');
            if (!$thumbnail_url) {
                $thumbnail_url = wp_get_attachment_url($image_id); // Fallback to the original image
            }
            $image_url = wp_get_attachment_image_url($image_id, 'woocommerce_single');
            if (!$image_url) {
                $image_url = wp_get_attachment_url($image_id); // Fallback to the original image
            }
            
            echo '<li><img alt="' . esc_attr($product->get_name()) . '" width="100px" height="100px" loading="lazy" src="' . esc_url($thumbnail_url) . '" data-large_image="' . esc_url($image_url) . '"></li>';
        }
        echo '</ul>';
    }
}
add_action('woocommerce_before_single_product_summary', 'custom_woocommerce_product_gallery', 10);

// Remove default WooCommerce product gallery
add_action('woocommerce_before_single_product_summary', 'custom_remove_default_gallery', 1);

function custom_remove_default_gallery() {
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
}