<?php

add_filter( 'mctb_merge_vars', function($data) {

	// make sure we have an array to work with
	if( ! isset( $data['INTERESTS'] ) ) {
		$data['INTERESTS'] = array();
	}

	// replace "interest-id" with the actual ID of your interest.
	$data['INTERESTS'][] = "interest-id";

	return $data;
});
