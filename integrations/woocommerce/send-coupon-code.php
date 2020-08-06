<?php

/**
 * This will send additional WooCommerce checkout fields to MailChimp.
 *
 * @return array
 */
add_filter( 'mc4wp_integration_woocommerce_data', function( $data, $order_id ) {
	$order = wc_get_order( $order_id );
	
    if( $order->get_used_coupons() ) {
        
        foreach( $order->get_used_coupons() as $coupon) {
	        $custom_coupon_code_field = $coupon;
        }
    }

	// if it's a custom checkout field, usually you can get its value like this:
	$data[ 'NAME_OF_FIELD_IN_MAILCHIMP' ] = $custom_coupon_code_field;

	return $data;
}, 10, 2);
