<?php

/**
 * This will set the header of the email notification to the person filling in the form.
 */
add_filter( 'mc4wp_form_email_notification_headers', function( $headers, $form ) {
    $headers[] = sprintf( '%s: %s', 'Reply-To', $form->data['EMAIL'] );
    return $headers;
}, 10, 2 );
