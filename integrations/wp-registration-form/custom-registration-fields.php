<?php

/**
 *  Add fields to the WordPress registration form.
 */
add_action( 'register_form', function() {
	?>
	<p>
		<label>Store Name:</label>
		<input type="text" name="STORENAME" placeholder="Your store name" required="required">
	</p>
	<p>
		<label>Website:</label>
		<input type="text" name="WEBSITE" placeholder="Your website" required="required">
	</p>
	<p>
		<label>Telephone:</label>
		<input type="tel" name="TELEPHONE" placeholder="Your telephone" required="required">
	</p>
<?php
});

/**
 * Register the custom fields with MailChimp for WordPress.
 */
add_filter( 'mc4wp_user_merge_vars', function( $merge_vars, $user ) {

	$field_names = array( 'TELEPHONE', 'WEBSITE', 'STORENAME' );
	foreach( $field_names as $field_name ) {
		if( ! empty( $_POST[ $field_name ] ) ) {
			$merge_vars[ $field_name ] = sanitize_text_field( $_POST[ $field_name ] );
		}
	}

	return $merge_vars;
}, 10, 2 );