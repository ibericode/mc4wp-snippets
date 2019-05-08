<?php

/**
 * This adds the "My tag" tag to all new subscribers added by User Sync.
 *
 * Caveat: This only works for NEW subscribers. So if an email address is already on the list, the tag won't be applied.
 */
add_filter( 'mailchimp_sync_subscriber_data', function(MC4WP_MailChimp_Subscriber $subscriber) {
   $subscriber->tags[] = 'My tag';
   return $subscriber;
});
