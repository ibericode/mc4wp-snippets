<?php

/**
 * This code hooks into the MailChimp User Sync webhook listener.
 *
 * When an "unsubscribe" request comes in, the corresponding WP_User will be deleted.
 */
add_action( 'mailchimp_sync_webhook_unsubscribe', function( $user ) {
	wp_delete_user( $user->ID );
}, 10 );