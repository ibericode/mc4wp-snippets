<?php

/**
 * Insert a sign-up form after the 3rd paragraph.
 */
add_filter( 'the_content', function( $content ) {

	if( is_single() ) {
		$content .= mc4wp_get_form();
	}

	return $content;
});


