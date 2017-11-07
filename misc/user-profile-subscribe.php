<?php

$mailchimp_list_id = '01853015ba';

add_action( 'show_user_profile', function() {

});

add_action( 'personal_options_update', function( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return;
    }


});