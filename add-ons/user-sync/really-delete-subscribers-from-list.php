<?php

/**
* Instructs MailChimp User Sync to hard-delete subscribers instead of updating their subscriber status.
*/
add_filter( 'mailchimp_sync_delete_subscribers', '__return_true' );
