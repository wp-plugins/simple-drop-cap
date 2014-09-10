<?php

// action for registering shortcode
add_action( 'init', 'wpsdc_register_shortcode' );

// function for registering shortcode
function wpsdc_register_shortcode()
{
	// register shortcode [dropcap]word[/dropcap]
	add_shortcode( 'dropcap', 'wpsdc_shortcode' );
}

// main function for wpsdc shortcode
function wpsdc_shortcode( $args, $content )
{
	// left trim $content
	$wpsdc_shortcoded_content = ltrim( $content );

	// select first letter of shortcoded $content
	$wpsdc_first_letter_of_shortcoded_content = substr( $wpsdc_shortcoded_content, 0, 1 );

	// select remaining letters of shortcoded content
	$wpsdc_remaining_letters_of_shortcoded_content = substr( $wpsdc_shortcoded_content, 1 );

	// add <span class="wpsdc"> to the first letter for shortcoded content
	$wpsdc_spanned_first_letter = '<span class="wpsdc-drop-cap">' . $wpsdc_first_letter_of_shortcoded_content . '</span>';

	// return the spanned first letter and remaining letters
	return $wpsdc_spanned_first_letter . $wpsdc_remaining_letters_of_shortcoded_content;
}

// do shortcode in a text widget
add_filter( 'widget_text', 'do_shortcode' );