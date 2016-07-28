<?php


/**
 * Add users with the "subscriber" role to a group called "Member"
 *
 * All other roles: add to "Paused"
 */
add_filter( 'mailchimp_sync_user_data', function( $data, $user ) {
	// determine status
	$status = in_array( 'subscriber', $user->roles ) ? "Member" : "Paused";

	$grouping_info = array(
		'id' => 'grouping-id',
		'groups' => array( $status )
	);

	// add grouping info to data
	$data['GROUPINGS'] = array( $grouping_info );

	return $data;
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