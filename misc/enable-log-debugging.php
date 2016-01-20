<?php
/*
Plugin Name: MailChimp for WordPress - Debug Log
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Log all the things.
Author: ibericode
Version: 1.0
Author URI: https://ibericode.com/
*/

add_filter( 'mc4wp_debug_log_level', function() { return 100; });