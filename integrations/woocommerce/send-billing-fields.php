<?php
/**
 * This will send additional WooCommerce checkout fields to MailChimp.
 *
 * To add more fields, change the $field_map variable and use the following format:
 *
 *      WooCommerce field => MailChimp field.
 *
 * Example:
 *
 *      "billing_country" => "COUNTRY"
 *
 * This means that the WooCommerce "billing_country" field will be sent to the "COUNTRY" field in MailChimp.
 *
 * @return array
 */
add_filter( 'mc4wp_merge_vars', function( $merge_vars ) {

	$field_map = array(
		'billing_country' => 'COUNTRY',
		'billing_phone' => 'PHONE',
	);

	foreach( $field_map as $woocommerce_field => $mailchimp_field ) {

		if( ! empty( $_POST[ $woocommerce_field ] ) ) {
			$merge_vars[ $mailchimp_field ] = sanitize_text_field( $_POST[ $woocommerce_field ] );
		}

	}


	return $merge_vars;
} );
