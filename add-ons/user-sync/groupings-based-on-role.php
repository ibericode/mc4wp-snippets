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
 *  Add guest visitors using a form or checkbox to the "Subscriber" group
 */
add_filter( 'mc4wp_merge_vars', function( $data ) {

	// do nothing if user is logged in (Sync takes care of that)
	if( is_user_logged_in() ) {
		return $data;
	}

	// otherwise, add to "Subscriber" group
	if( ! isset( $data['GROUPINGS'] ) ) {
		$data['GROUPINGS'] = array();
	}

	$data['GROUPINGS']['grouping-id'] = array( 'Subscriber' );
	return $data;
});