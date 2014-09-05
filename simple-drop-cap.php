<?php 
/*
Plugin Name: Simple Drop Cap
Plugin URI: http://wordpress.org/plugins/simple-drop-cap/
Description: Simple drop cap plugin. Transform the first letter of a word into a drop cap simply by surrounding the word with shortcode [dropcap].
Author: Yudhistira Mauris
Author URI: http://www.yudhistiramauris.com
Version: 1.0
License: GPLv2
*/

/*  Copyright 2014 Yudhistira Mauris (email: contact@yudhistiramauris.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// action for registering shortcode
add_action( 'init', 'wpsdc_register_shortcode' );

// action for adding options page
add_action( 'admin_menu', 'wpsdc_create_menu' );

// action for loading wpsdc's style
add_action( 'wp_head', 'wpsdc_load_css' );

// add drop cap tinymce button if WP version >= 3.9
global $wp_version;
if ( version_compare( $wp_version, '3.9', '>=' ) ) {
	// action for tinymce button
	add_action( 'admin_head', 'wpsdc_tinymce_button_init' );
}

// function for refistering shortcode
function wpsdc_register_shortcode()
{
	// register shortcode [dropcap]word[/dropcap]
	add_shortcode( 'dropcap', 'wpsdc' );
}

// main function for wpsdc
function wpsdc( $args, $content )
{
	// left trim $content
	$shortcoded_content = ltrim( $content );

	// select first letter of shortcoded $content
	$first_letter_of_shortcoded_content = substr( $shortcoded_content, 0, 1 );

	// select remaining letters of shortcoded content
	$remaining_letters_of_shortcoded_content = substr( $shortcoded_content, 1 );

	// add <span class="wpsdc"> to the first letter for shortcoded content
	$spanned_first_letter = '<span class="wpsdc-drop-cap">' . $first_letter_of_shortcoded_content . '</span>';

	// return the spanned first letter and remaining letters
	return $spanned_first_letter . $remaining_letters_of_shortcoded_content;
}

// funtion for wpsdc plugin menu
function wpsdc_create_menu()
{
	// add options page for simple drop cap plugin
	add_options_page( 'Simple Drop Cap Settings', 'Simple Drop Cap', 'manage_options', 'wpsdc_settings_menu', 'wpsdc_settings_page' );

	// action for registering setting options
	add_action( 'admin_init', 'wpsdc_register_settings' );
}

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

// function for creating wpsdc options field
function wpsdc_settings_page()
{
?>
	<div class="wrap">
		<h2>Simple Drop Cap Settings</h2>

		<p>If you find a bug or need a support request, please post your request <a href="http://wordpress.org/support/plugin/simple-drop-cap" target="_blank">here</a>.

		<br>

		And if you find this plugin helpful, please leave a review and comment <a href="http://wordpress.org/support/view/plugin-reviews/simple-drop-cap" target="_blank">here</a>. Thank you :)</p>

		<form method="post" action="options.php">

			<?php settings_fields( 'wpsdc-settings-group' ); // set plugin option group for the form ?>

			<?php $wpsdc_options = get_option( 'wpsdc_options' ); // get plugin options from the database ?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">Display Mode</th>
					<td>
						<input type="radio" id="option_display_mode_normal" name="wpsdc_options[option_display_mode]" value="normal" <?php checked( 'normal', $wpsdc_options['option_display_mode'] ); ?> />Normal Mode

						<br>

						<small><a href="http://wordpress.org/plugins/simple-drop-cap/screenshots/" target="_blank">Click here</a> for the example.</small>

						<br>
						<br>

						<input type="radio" id="option_display_mode_float" name="wpsdc_options[option_display_mode]" value="float" <?php checked( 'float', $wpsdc_options['option_display_mode'] ); ?> />Float Mode

						<br>

						<small><a href="http://wordpress.org/plugins/simple-drop-cap/screenshots/" target="_blank">Click here</a> for the example.</small>
					</td>
				</tr>
			</table>

			<?php @submit_button(); ?>

		</form>
	</div>
<?php
}

// function for loading wpsdc's style
function wpsdc_load_css()
{
	$wpsdc_options = get_option( 'wpsdc_options' );
	if ( $wpsdc_options['option_display_mode'] == 'normal' ) {
		echo 
		'<style type="text/css">
			.wpsdc-drop-cap {				
				padding : 0;
				font-size : 5em;
				line-height : 0.8em;
			}
		</style>';
	} else {
		echo 
		'<style type="text/css">
			.wpsdc-drop-cap {
				float : left;				
				padding : 0.25em 0.05em 0.25em 0;				
				font-size : 5em;
				line-height : 0.4em;
			}
		</style>';
	}	
}

// function for adding tinymce button
function wpsdc_tinymce_button_init()
{
	global $typenow;
	
	// check user permission
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	// check post type
	if ( ! in_array( $typenow, array( 'post', 'page') ) ) {
		return;
	}

	// check if WYSIWYG editor is enabled
	if ( get_user_option( 'rich_editing' ) == 'true' ) {

		// add filter to register tinymce plugins
		add_filter( 'mce_external_plugins', 'wpsdc_add_tinymce_plugin' );

		// add filter to add buttons to tinymce toolbar
		add_filter( 'mce_buttons', 'wpsdc_add_tinymce_button' );
	}
}

// function for mce_external_plugins callback
function wpsdc_add_tinymce_plugin( $plugin_array )
{
	// add js file into the editor
	$plugin_array['wpsdc_button'] = plugins_url( '/shortcode-button.js', __FILE__ );
	return $plugin_array;
}

// function for mce_buttons callback
function wpsdc_add_tinymce_button( $buttons )
{
	// insert the button to the $buttons array
	array_push( $buttons, 'wpsdc_button' );
	return $buttons;
}
?>