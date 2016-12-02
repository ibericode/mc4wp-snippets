<?php

/**
 * This will filter the order data before it is sent to MailChimp and replace the "order ID" with the "order number"
 */
add_filter( 'mc4wp_ecommerce360_order_data', function( $data ) {
    $order = wc_get_order( $data['id'] );
    $data['id'] = $order->get_order_number();
    return $data;
});