//If user has subscription with ID 10 add the user to interest-id-1, once the subscription expires, remove the user from that interest group.
//Replace the '10' and "interest-id-1" with your own subscription ID and interest group ID


add_filter( 'mailchimp_sync_subscriber_data', function( $subscriber, $user ) {

if( WC_Subscriptions_Manager::user_has_subscription( $user->ID, '10', 'active' ) ) {
$subscriber->interests[ "interest-id-1" ] = true;
} else {
$subscriber->interests[ "interest-id-1" ] = false;
}

//You can repeat this code for other subscriptions 
//Replace the '20' and "interest-id-2" with your own subscription ID and interest group ID

if( WC_Subscriptions_Manager::user_has_subscription( $user->ID, '20', 'active' ) ) {
$subscriber->interests[ "interest-id-2" ] = true;
} else {
$subscriber->interests[ "interest-id-2" ] = false;
}

return $subscriber;
}, 10, 2 );
