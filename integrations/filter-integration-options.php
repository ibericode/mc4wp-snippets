<?php


add_filter( 'mc4wp_gravity-forms_integration_options', function( $opts ) {
	$opts['update_existing'] = true;
	return $opts;
});