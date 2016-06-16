<?php

add_filter( 'mc4wp_integration_woocommerce_merge_vars', function( $merge_vars ) {

    // The ID of the interest category / grouping
    $grouping_id = 4605;

    // The groups to add to (full name, should match exactly)
    $groups = array( "Group name 1", "Group Name 2" );

    // init empty array as GROUPINGS key
    if( ! isset( $merge_vars['GROUPINGS'] ) ) {
        $merge_vars['GROUPINGS'] = array();
    }

    // add grouping + groups info
    $merge_vars['GROUPINGS'][ $grouping_id ] = $groups;
    return $merge_vars;
});