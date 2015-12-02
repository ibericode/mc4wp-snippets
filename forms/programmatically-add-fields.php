<?php

/**
 * Programmatically adds another field to be sent to MailChimp.
 *
 * @param array      $merge_vars
 * @param MC4WP_Form $form
 *
 * @return array
 */
function myprefix_send_additional_field( array $merge_vars, MC4WP_Form $form ) {

	// a static field
	$merge_vars['MY_FIELD'] = 'Some value';

	// the name of the form
	$merge_vars['FORM'] = $form->name;

	return $merge_vars;
}

add_filter( 'mc4wp_form_merge_vars', 'myprefix_send_additional_field', 10, 2 );