<?php
// This snippet needs the  Webhook to be turned on under Mailchimp for WP > Usersync
// It will change the user role when someone subscribes on unsubscribes from the Audience. 
// Replace 'customer' and 'subscriber' with the slugs of the roles you are using for this. 

add_action( 'mc4wp_user_sync_webhook_unsubscribe', function($data, $user) {
$user->remove_role( 'customer' );
$user->add_role( 'subscriber' );
}, 10, 2);

add_action( 'mc4wp_user_sync_webhook_subscribe', function($data, $user) {
$user->remove_role( 'subscriber' );
$user->add_role( 'customer' );
}, 10, 2);
