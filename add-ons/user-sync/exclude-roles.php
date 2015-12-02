<?php

/**
 * Allows you to define an array of user roles to be excluded from Sync.
 *
 * @param boolean $sync
 * @param WP_User $user
 */
add_filter( 'mailchimp_sync_should_sync_user', function( $sync, $user ) {

	// setup array of roles which should be excluded from Syncing.
	$excluded_roles = array(
		'role_nosync',
		'another_role'
	);

	// check each role
	foreach( $excluded_roles as $excluded_role ) {

		// do not synchronize user if it has the excluded role.
		if( in_array( $excluded_role, $user->roles ) ) {
			return false;
		}
	}

	// use default value (from settings)
	return $sync;
}, 10, 2);