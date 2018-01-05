<?php

if( class_exists( 'WP_CLI_Command' ) ) {
	class MC4WP_Ecommerce_Subscribe_Guest_Customers_Command extends WP_CLI_Command  {

		/**
		 * Subscribes email address found in guest orders to a MailChimp list
		 *
		 * @param $args
		 * @param $assoc_args
		 *
		 * ## OPTIONS
		 *
		 * <list_id>
		 * : The MailChimp list ID to subscribe guest customers to
		 *
		 * ## EXAMPLES
		 *
		 *     wp mc4wp-ecommerce-subscribe-guest-customers run
		 *
		 * @subcommand run
		 */
		public function add_order( $args, $assoc_args = array() ) {
			if( empty( $assoc_args['list_id'] ) ) {
				WP_CLI::warning("Please provide a list_id argument.");
				return;
			}

			$guest_orders = wc_get_orders( array( 
				'type' => array( 'shop_order' ), 
				'customer' => 0, 
				'limit' => -1 
			) ); 

			WP_CLI::line( sprintf( '%d guest orders found.', count( $guest_orders ) ) );

			$mailchimp = new MC4WP_MailChimp();
			$mailchimp_list_id = $assoc_args['list_id'];

			$args = array(
				'status' => 'pending', // set to "subscribed" to skip double opt-in (not recommended)
			);

			foreach( $guest_orders as $order ) {
				$email_address = $order->get_billing_email();
				if( empty( $email_address ) ) {
					WP_CLI::line( 'Skipping guest order #%d because it has no billing_email property.', $order->get_order_number() );
					continue;
				}

				// query MailChimp to see if this guest is subscribed
				if( $mailchimp->list_has_subscriber( $mailchimp_list_id, $email_address ) ) {
					WP_CLI::line( sprintf( '%s is already subscribed.', $email_address ) );
					continue;
				}

				// if not, subscribe this guest
				$mailchimp->list_subscribe( $mailchimp_list_id, $email_address, $args );
				WP_CLI::line( sprintf( 'Subscribed %s', $email_address ) );
			}

	        WP_CLI::success( 'Done.' );
		}
	}
}

// register command when running cli
if (defined('WP_CLI') && WP_CLI) {
	WP_CLI::add_command('mc4wp-ecommerce-subscribe-guest-customers', 'MC4WP_Ecommerce_Subscribe_Guest_Customers_Command');
}
