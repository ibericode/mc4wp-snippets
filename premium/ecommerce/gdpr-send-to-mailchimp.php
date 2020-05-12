<?php

/**
 * Example how only send data to mail chimp if has the status `subscribed` or `pending`.
 */

/**
 * Check if a list member has status pending or subscribed based on there email
 *
 * @see https://mailchimp.com/developer/reference/lists/list-members/
 *
 * @param string $email
 *
 * @return bool
 */
function mailchimp_list_member_has_status_pending_or_subscribed($email) {

	if(!is_string($email)) {
		throw new InvalidArgumentException(
			sprintf("mailchimp_list_member_has_status_pending_or_subscribed() expects parameter 1 to be string, %s given", gettype($email))
		);
	}

    if(!mc4wp()->has('ecommerce.options')) {
        return false;
    }

    $options = mc4wp('ecommerce.options');

    if (!isset($options['store']['list_id'])) {
        return false;
    }

    //get the list ecommerce
    $list = $options['store']['list_id'];

	try {
	    //Send the request to get the status
		$list_member = mc4wp_get_api_v3()->get_list_member($list, $email);
	} catch (Exception $e) {
	    //In case of an exception return false
		return false;
	}

    //Check the status
	return in_array($list_member->status, array('subscribed', 'pending'), true);
}

/**
 * Only is called whe
 *
 * @param
 */
add_filter('mc4wp_ecommerce_send_cart_to_mailchimp', function ($value, $customer) {
    $email = null;

    switch (get_class($customer)) {
        case stdClass::class:
            $email = $customer->billing_email;
            break;
        case WP_User::class:
            $email = $customer->user_email;
            break;
        case WC_Customer::class:
            $email = $customer->get_email();
            break;
    }

    if (! $email) {
        return false;
    }

	return mailchimp_list_member_has_status_pending_or_subscribed($email);
}, 10, 2);

/**
 * This filter will be called when a client updates his profile.
 *
 * @param bool $value
 *
 * @see ecommerce3/includes/class-ecommerce.php#186
 */
add_filter('mc4wp_ecommerce_send_customer_to_mailchimp', function ($value, $customer) {
    if (! $customer instanceof WP_User ||
        ! $customer->has_prop('user_email')
    ) {
        return false;
    }

	return mailchimp_list_member_has_status_pending_or_subscribed(
	    $customer->get('user_email')
    );
}, 10, 2);

add_filter('mc4wp_ecommerce_send_order_to_mailchimp', function ($value, WC_Order $order) {
    if (! $order->has_billing_address()) {
        return false;
    }
	return mailchimp_list_member_has_status_pending_or_subscribed($order->get_billing_email());
}, 10, 2);
