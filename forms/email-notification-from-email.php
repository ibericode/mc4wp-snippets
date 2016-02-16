<?php

/**
 * Sets the email address & name to send the form notification email from.
 *
 * This example just sets a static name & email address
 */
add_filter( 'mc4wp_form_email_notification_headers', function( $headers ) {
	$headers['From'] = 'John Doe <johndoe@outlook.com>';
	return $headers;
});


// -- //


/**
 * Sets the email address & name to send the form notification email from.
 *
 * This example uses the values from the "FNAME" and "EMAIL" field
 */
add_filter( 'mc4wp_form_email_notification_headers', function( $headers, $form ) {
	$headers['From'] = sprintf( '%s <%s>', $form->data['FNAME'], $form->data['EMAIL'] );
	return $headers;
}, 10, 2 );