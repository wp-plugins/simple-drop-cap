<?php

// action for registering setting options
add_action( 'admin_init', 'wpsdc_register_settings' );

// function for registering wpsdc setting options
function wpsdc_register_settings()
{
	// register wpsdc settings
	register_setting( 'wpsdc-settings-group', 'wpsdc_options', 'wpsdc_sanitize_options' );

	// set array of options
	$wpsdc_options_arr = array(
		'option_display_mode' => 'float'
	);

	// insert the array of options into database
	add_option( 'wpsdc_options', $wpsdc_options_arr );
}

// function for sanitizing options
function wpsdc_sanitize_options( $input )
{
	$input['option_display_mode'] = wp_filter_nohtml_kses( $input['option_display_mode'] );
	return $input;
}