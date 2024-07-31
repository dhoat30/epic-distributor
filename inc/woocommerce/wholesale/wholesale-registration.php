<?php 

function redirect_from_wholesale_page() {
    // Check if we are on the specific page by slug
    if (is_page('wholesale-account')) {
        // Check if the user is logged in
        if (is_user_logged_in()) {
            // Optionally, check if the user has a specific role, e.g., 'wholesale_customer'
      
                // Redirect non-wholesalers to the homepage or another appropriate page
                $redirectURL = home_url().'/my-account/upgrade-account/'; 
                wp_redirect($redirectURL);
                exit; // Don't forget to call exit
         
        } 
    }
}
add_action('template_redirect', 'redirect_from_wholesale_page');

// get wholesale prices 

function get_wholesale_price_by_product_type($product_id) {
    if (!class_exists('WWP_Wholesale_Roles') || !class_exists('WWP_Wholesale_Prices')) {
        return ''; // Ensure required classes are loaded
    }

    $wholesale_roles = new WWP_Wholesale_Roles();
    $user_wholesale_role = $wholesale_roles->getUserWholesaleRole();

    $product = wc_get_product($product_id);
    if (!$product) {
        return ''; // Check if product exists
    }

    if ('variable' === $product->get_type()) {
        // Handle variable product
        $min_price = null;
        foreach ($product->get_children() as $variation_id) {
            $variation = wc_get_product($variation_id);
            if (!$variation || !$variation->is_purchasable()) {
                continue;
            }
            $price_arr = WWP_Wholesale_Prices::get_product_wholesale_price_on_shop_v3($variation_id, $user_wholesale_role);
            if (isset($price_arr['wholesale_price']) && is_numeric($price_arr['wholesale_price'])) {
                if (is_null($min_price) || $price_arr['wholesale_price'] < $min_price) {
                    $min_price = $price_arr['wholesale_price'];
                }
            }
        }
        return $min_price ? $min_price : ''; // Format price with WooCommerce price formatting
    } else {

        // Handle simple product
        $price_arr = WWP_Wholesale_Prices::get_product_wholesale_price_on_shop_v3($product_id, $user_wholesale_role);
        if (!empty($price_arr['wholesale_price'])) {
            return $price_arr['wholesale_price']; 
        }
    }

    return ''; // Return empty if no wholesale price is set
}