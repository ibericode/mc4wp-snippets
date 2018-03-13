<?php

// only sync users with an active WooSubscription
add_filter( 'mailchimp_sync_should_sync_user', function( $should, $user ) {
    $active = WC_Subscriptions_Manager::user_has_subscription( $user->ID );
    return $should && $active;
}, 10, 2);
