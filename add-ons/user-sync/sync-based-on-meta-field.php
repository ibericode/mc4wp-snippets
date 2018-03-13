<?php

/**
* Only synchronise users with a meta field named "mailchimp_opted_in" with boolean value true
*/
add_filter( 'mailchimp_sync_should_sync_user', function( $should, $user ) {
	if( ! $should ) {
		return false;
	}

	// return "true" if meta field value equals "1"
    $meta_value = get_user_meta( $user->ID, 'mailchimp_opted_in', true );
    if($meta_value && $meta_value == "1" ) {
    	return true;
    }

    // return false to indicate this subscriber did not opt-in and should be unsubscribed.
    return false;
}, 10, 2 );
