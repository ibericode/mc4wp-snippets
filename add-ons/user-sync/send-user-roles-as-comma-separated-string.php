<?php

add_filter( 'mailchimp_sync_subscriber_data', function( $subscriber, $user ) {
    // add to merge fields, change "mailchimp_field_name" to the name of your merge field in MailChimp.
    $subscriber->merge_fields[ 'ROLES' ] = join( ',', $user->roles );
    return $subscriber;
}, 10, 2 );
