<?php
/**
 * @snippet       Product Images @ Woo Checkout
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 * @community     https://businessbloomer.com/club/
 */
  
add_filter( 'woocommerce_cart_item_name', 'bbloomer_product_image_review_order_checkout', 9999, 3 );
  
function bbloomer_product_image_review_order_checkout( $name, $cart_item, $cart_item_key ) {
    if ( ! is_checkout() ) return $name;
    $product = $cart_item['data'];
    $thumbnail = $product->get_image( array( '80', '80' ), array( 'class' => 'alignleft' ) );
    return $thumbnail . $name;
}