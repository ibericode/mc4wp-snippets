<?php

/**
 * Add "wc-processing" to the order statuses which are sent to MailChimp
 */
add_filter( 'mc4wp_ecommerce_order_statuses', function( $statuses ) {
   $statuses[] = 'wc-processing';
   return $statuses;
});