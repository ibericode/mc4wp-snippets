<?php

/**
 * This disables the "logging" functionality in the Premium add-on.
 */
add_filter( 'mc4wp_premium_enabled_plugins', function( $plugins ) {
	return array_diff( $plugins, array( 'logging' ) );
});