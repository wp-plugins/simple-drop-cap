<?php

// action for adding options page
add_action( 'admin_menu', 'wpsdc_create_menu' );

// funtion for wpsdc plugin menu
function wpsdc_create_menu()
{
	// add options page for simple drop cap plugin
	add_options_page( 'Simple Drop Cap Settings', 'Simple Drop Cap', 'manage_options', 'wpsdc_settings_menu', 'wpsdc_settings_page' );

}

// function for creating wpsdc options field
function wpsdc_settings_page()
{
	ob_start();
	?>
		<div class="wrap">
			<h2>Simple Drop Cap Settings</h2>

			<p>If you find a bug or need a support request, please post your request <a href="http://wordpress.org/support/plugin/simple-drop-cap" target="_blank">here</a>.

			<br>

			And if you find this plugin helpful, please leave a review and comment <a href="http://wordpress.org/support/view/plugin-reviews/simple-drop-cap" target="_blank">here</a>. Thank you :)</p>

			<form method="post" action="options.php">

				<?php settings_fields( 'wpsdc-settings-group' ); // set plugin option group for the form ?>

				<?php $wpsdc_options = get_option( 'wpsdc_options' ); // get plugin options from the database ?>
		
				<h3>Style Settings</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Display Mode</th>
							<td>
								<input type="radio" id="option_display_mode_normal" name="wpsdc_options[option_display_mode]" value="normal" <?php checked( 'normal', $wpsdc_options['option_display_mode'] ); ?> >Normal Mode

								<br>

								<small><a href="http://wordpress.org/plugins/simple-drop-cap/screenshots/" target="_blank">Click here</a> for the example.</small>

								<br>
								<br>

								<input type="radio" id="option_display_mode_float" name="wpsdc_options[option_display_mode]" value="float" <?php checked( 'float', $wpsdc_options['option_display_mode'] ); ?> >Float Mode

								<br>

								<small><a href="http://wordpress.org/plugins/simple-drop-cap/screenshots/" target="_blank">Click here</a> for the example.</small>

								<br>
								<br>

								<input type="radio" id="option_display_mode_custom" name="wpsdc_options[option_display_mode]" value="custom" <?php checked( 'custom', $wpsdc_options['option_display_mode'] ); ?> >Custom Mode							

								<br>

								<small>Use your own specified CSS styles. This will override all styling options.</small>
							</td>
						</tr>						
						<tr valign="top">
							<th scope="row">Drop Cap Color</th>
							<td>
								<input type="text" class="font-color-field" name="wpsdc_options[option_font_color]" value="<?php echo esc_attr( $wpsdc_options['option_font_color'] ); ?>" >
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Custom CSS Style</th>
							<td>						
								<small>Specify your custom CSS styles for custom mode in the box below.</small>
								<br>
								<textarea rows="7" cols="50" name="wpsdc_options[option_custom_css]" id="wpsdc_options[option_custom_css]"><?php echo esc_textarea( $wpsdc_options['option_custom_css'] ); ?></textarea>
							</td>
						</tr>
					</tbody>	
				</table>

				<h3>Usage Settings</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Drop Cap Automation</th>
							<td>
								<input type="checkbox" name="wpsdc_options[option_enable_all_posts]" value="1" <?php checked( $wpsdc_options['option_enable_all_posts'], '1' ); ?>>
								<label for="wpsdc_options[option_enable_all_posts]">Automatically transform the first letter of all posts, pages, and custom post types into a drop cap.</label>
								<br>
								<small>This also will disable [dropcap] shortcode on post, page, and custom post type.</small>
							</td>
						</tr>
					</tbody>	
				</table>

				<?php @submit_button(); ?>

			</form>
		</div>
	<?php
	echo ob_get_clean();
}