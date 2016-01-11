<?php

/**
 * Adds the user to "Group 1" and "Group 2" of the Interest Grouping with ID 5405
 *
 * @param array $data The data that is sent to MailChimp
 * @param WP_User $user The user that is being synchronized
 *
 * @return array Our modified data array
 */
function myprefix_add_grouping_data( array $data, WP_User $user ) {
	$grouping_1 = array(
		'id' => 5405,
		'groups' => array( 'Group 1', 'Group 2' )
	);

	$data['GROUPINGS'] = array( $grouping_1 );
	return $data;
}

add_filter( 'mailchimp_sync_user_data', 'myprefix_add_grouping_data', 10, 2 );