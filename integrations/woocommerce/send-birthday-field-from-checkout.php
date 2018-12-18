<?php

/**
 * The following snippet assumes a checkout field with name "billing_birthdate" and sends the value of that field to a MailChimp list field named MMERGE3
 * 
 * This assumes that the format of the billing_birthdate field is correct.
 */
add_filter( 'mc4wp_integration_woocommerce_data', function( $data ) {
    if( ! empty( $_POST['billing_birthdate'] ) ) {
        $data['MMERGE3'] = $_POST['billing_birthdate'];
    }
    return $data;
});