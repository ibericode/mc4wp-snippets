<?php

/**
 * Example how only send data to mail chimp if has the status `subscribed` or `pending`.
 */

/**
 * Send a request to mailchimp to check if member has status subscribed or pending
 *
 * @see https://mailchimp.com/developer/reference/lists/list-members/
 *
 * @param string $email
 *
 * @return bool
 */
function sync_only_subscribed_or_pending_emails($email) {
	if(!is_string($email)) {
		throw new InvalidArgumentException(
			sprintf("sync_only_subscribed_or_pending_emails() expects parameter 1 to be array or %s, %s given", Traversable::class, gettype($emails))
		);
	}

	if(!mc4wp()->has('ecommerce.options')) {
		return false;
	}

	$options = mc4wp('ecommerce.options');

	if (!isset($options['store']['list_id'])) {
		return false;
	}

	$list =  $options['store']['list_id'];

	try {
		$list_member = mc4wp_get_api_v3()->get_list_member($list, $email);
	} catch (Exception $e) {
		return false;
	}

	return in_array($list_member->status, array('subscribed', 'pending'));
}
