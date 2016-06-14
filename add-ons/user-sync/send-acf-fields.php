<?php

/**
 * This hooks into the data that is sent to MailChimp.
 *
 * It will then take an ACF field "bar" and send it to the MailChimp "FOO" field.
 */
add_filter( 'mailchimp_sync_user_data', function( $data, $user ) {
    // MailChimp field name: FOO
    // ACF field name: bar
    $data['FOO'] = get_field( 'bar', 'user_' . $user->ID );
    return $$data;
}, 10, 2 );
