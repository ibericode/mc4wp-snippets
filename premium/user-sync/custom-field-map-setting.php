<?php

add_filter( 'mc4wp_user_sync_settings', function($settings) {
    $settings['field_map'][] = array(
        'mailchimp_field' => 'INTERESTS',
        'user_field' => '_meta_key_for_storing_interest_field',
	);
	return $settings;
});
