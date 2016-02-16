<?php

/**
 * Sets the email address & name to send the form notification email from.
 */
add_filter( 'mc4wp_form_email_notification_headers', function( $headers ) {
	$headers['From'] = 'John Doe <johndoe@outlook.com>';
	return $headers;
});