<?php


/**
 * Add or remove users with the "subscriber" role to a group called "Member"
 */
add_filter( 'mailchimp_sync_subscriber_data', function( $subscriber, $user ) {

    // toggle interest ID based on user role
    if( in_array( 'subscriber', $user->roles ) ) {
        $subscriber->interests[ "interest-id-members" ] = true;
    } else {
        $subscriber->interests[ "interest-id-members" ] = false;
    }

	return $subscriber;
}, 10, 2 );

/**
 * @param MC4WP_MailChimp_Subscriber $subscriber
 * @return MC4WP_MailChimp_Subscriber
 */
function myprefix_add_guests_to_interest( $subscriber ) {
    // do nothing if user is logged in
    if( is_user_logged_in() ) {
        return $subscriber;
    }

    // toggle the interest here, by ID.
    // you can find this ID by going to MailChimp for WP > MailChimp > List Overview
    $subscriber->interests[ "interest-id" ] = true;
    return $subscriber;
}

add_filter( 'mc4wp_subscriber_data', 'myprefix_add_guests_to_interest' );