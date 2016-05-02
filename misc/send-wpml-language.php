<?php
/*
Plugin Name: MailChimp for WordPress - Send WPML language
Plugin URI: https://mc4wp.com/
Description: This sends the current WPML language to MailChimp for every sign-up method.
Author: ibericode
Version: 1.0
Author URI: https://ibericode.com/
*/

add_filter( 'mc4wp_merge_vars', function( $vars ) {

    // do nothing if WPML is not activated
    if( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
        return $vars;
    }

    $vars['MC_LANGUAGE'] = ICL_LANGUAGE_CODE;
    return $vars;
});