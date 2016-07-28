<?php

/**
 * Combine the values of "FIELD_ONE" and "FIELD_TWO" into a single "COMBINED_FIELD" field.
 *
 * @param array $merge_vars
 * @param MC4WP_Form $form
 *
 * @return array
 */
function myprefix_combine_fields( $merge_vars, MC4WP_Form $form ) {

	// get values for both fields
	$field1 = ( isset( $merge_vars['FIELD_ONE'] ) ) ? $merge_vars['FIELD_ONE'] : '';
	$field2 = ( isset( $merge_vars['FIELD_TWO'] ) ) ? $merge_vars['FIELD_TWO'] : '';

	// merge the two fields into one
	$merge_vars['COMBINED_FIELD'] = $field1 . ' ' . $field2;

	// return customized data
	return $merge_vars;
}

add_filter( 'mc4wp_form_data', 'myprefix_combine_fields', 10, 2 );