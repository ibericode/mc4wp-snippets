<?php

/**
 * Combine the values of "FIELD_ONE" and "FIELD_TWO" into a single "COMBINED_FIELD" field.
 *
 * @param array $data
 *
 * @return array
 */
function alter_mc4wp_form_data( $data ) {

	// get values for both fields
	$field1 = ( isset( $data['FIELD_ONE'] ) ) ? $data['FIELD_ONE'] : '';
	$field2 = ( isset( $data['FIELD_TWO'] ) ) ? $data['FIELD_TWO'] : '';

	// merge the two fields into one
	$data['COMBINED_FIELD'] = $field1 . ' ' . $field2;

	// return customized data
	return $data;
}

add_filter( 'mc4wp_form_data', 'alter_mc4wp_form_data' );