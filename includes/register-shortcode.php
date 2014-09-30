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
	$wpsdc_shortcoded_content = ltrim ( $content );

	// select first letter of shortcoded $content
	$wpsdc_first_letter_of_shortcoded_content = mb_substr( $wpsdc_shortcoded_content, 0, 1 );

	// select remaining letters of shortcoded content
	$wpsdc_remaining_letters_of_shortcoded_content = mb_substr( $wpsdc_shortcoded_content, 1 );

	// add <span class="wpsdc"> to the first letter for shortcoded content
	$wpsdc_spanned_first_letter = '<span class="wpsdc-drop-cap">' . $wpsdc_first_letter_of_shortcoded_content . '</span>';

	// return the spanned first letter and remaining letters
	return $wpsdc_spanned_first_letter . $wpsdc_remaining_letters_of_shortcoded_content;
}

// add filter to include shortcode to every post, page, and custom page
$wpsdc_options = get_option( 'wpsdc_options' );
if ( isset( $wpsdc_options['option_enable_all_posts'] ) && $wpsdc_options['option_enable_all_posts'] == '1' ) {
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpsdc_filter_content' );

	function wpsdc_filter_content( $content )
	{
		$content = str_replace('[dropcap]', '', $content);

		$content = str_replace('[/dropcap]', '', $content);

		$wpsdc_first_letter_of_filtered_content = mb_substr( $content, 0, 1);

		$wpsdc_remaining_letters_of_filtered_content = mb_substr( $content, 1);

		$wpsdc_dropcapped_first_letter = '[dropcap]' . $wpsdc_first_letter_of_filtered_content . '[/dropcap]';

		// return all content
		$content = $wpsdc_dropcapped_first_letter . $wpsdc_remaining_letters_of_filtered_content;

		return $content;
	}
	add_filter( 'the_content', 'wpautop' );
}

// do shortcode in a text widget
add_filter( 'widget_text', 'do_shortcode' );

// do shortcode in post excerpt, use cutom wp_trim_excerpt()
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'wpsdc_wp_trim_excerpt' );
// add_filter( 'the_excerpt', 'do_shortcode' );

// Copied from wp-includes/post-formatting.php
function wpsdc_wp_trim_excerpt($text = '') {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		// $text = strip_shortcodes( $text );
		// $text = apply_filters( 'the_content', $text );
		$text = str_replace(']]>', ']]&gt;', $text);		
		$excerpt_length = apply_filters( 'excerpt_length', 55 );		
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}

add_filter( 'the_excerpt', 'wpsdc_filter_excerpt' );

function wpsdc_filter_excerpt( $content )
{
	$content = str_replace( '[dropcap]', '', $content ); 
	$content = str_replace( '[/dropcap]', '', $content );
	return $content;
}