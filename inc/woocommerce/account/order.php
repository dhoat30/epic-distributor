<?php 
add_filter('woocommerce_my_account_my_orders_actions', 'add_order_again_button_my_account_orders', 50, 2);
function add_order_again_button_my_account_orders($actions, $order) {
    // Check if the order status allows for "order again" functionality
    if ($order->has_status('completed')) {
        $actions['order_again'] = array(
            'url'  => wp_nonce_url(add_query_arg('order_again', $order->get_id(), wc_get_endpoint_url('orders')), 'woocommerce-order_again'),
            'name' => __('Order Again', 'woocommerce')
        );
    }

    return $actions;
}