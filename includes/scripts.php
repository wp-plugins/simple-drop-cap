<?php

// action for loading wpsdc's style
add_action( 'wp_head', 'wpsdc_load_css' );

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