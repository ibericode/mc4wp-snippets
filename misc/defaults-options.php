add_filter( 'default_option_mc4wp_checkbox', function( $options ) {
   $options['css'] = 0; //Set value of "Load some default CSS?"" to false
   return $options;
});