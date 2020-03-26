<?php

add_action( 'mc4wp_user_sync_webhook', function($data, $user) {
    /* $data['merges'] contains an associative array with mailchimp field values */
    /* in this example we take the INTERESTS fields, which is a comma-separated string of interest groups */
    update_user_meta($user->ID, 'user_meta_key', $data['merges']['INTERESTS']);
}, 10, 2);