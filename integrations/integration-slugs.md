Integration slugs
=================

The following integration slugs are used by the MailChimp for WordPress plugin. 

- buddypress
- contact-form-7
- custom
- easy-digital-downloads
- memberpress
- ninja-forms
- woocommerce
- wp-comment-form
- wp-registration-form

([source](https://github.com/ibericode/mailchimp-for-wordpress/tree/master/integrations))



You can use these names in the following filter or action hooks.

```php
mc4wp_integration_{slug}_data
mc4wp_integration_{slug}_subscriber_data
mc4wp_integration_{slug}_lists
mc4wp_integration_{slug}_checkbox_attributes
mc4wp_integration_{slug}_before_checkbox_wrapper
mc4wp_integration_{slug}_after_checkbox_wrapper
````

_Example_

```php
add_filter( 'mc4wp_integration_woocommerce_subscriber_data', function( MC4WP_MailChimp_Subscriber $subscriber ) {
    $subscriber->merge_fields[ "COUNTRY" ] = sanitize_text_field( $_POST['billing_country'] );
    return $subscriber;
});
```