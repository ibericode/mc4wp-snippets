<?php

/**
 * This code hooks into the MailChimp User Sync webhook listener.
 *
 * When a request comes in that is not an unsubscribe request and for which no user exists yet, a new user will be created.
 */
add_filter( 'mailchimp_sync_webhook_user', function( $user, $data ) {

	// have user already? use that.
	if( $user instanceof \WP_User ) {
		return $user;
	}

	// do not run when someone unsubscribed through MailChimp
	if( $_REQUEST['type'] === 'unsubscribe' ) {
		return $user;
	}

	// No user yet and this is not an unsubscribe request, let's create a new one!
	$user_id = wp_create_user( $data['email'], wp_generate_password(), $data['email'] );

	// send notification to user
	wp_new_user_notification( $user_id );

	// return complete user object
	return get_userdata( $user_id );
}, 10, 2 );