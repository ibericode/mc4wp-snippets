<?php

add_action( 'mc4wp_form_mailchimp_error', function( $error, $form ) {
    wp_mail( 'email@email.com', "Form API failure", $error );
})
