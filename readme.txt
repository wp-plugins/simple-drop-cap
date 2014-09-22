=== Simple Drop Cap ===
Contributors: maurisrx
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D2ZLXZ8VQKPE2
Tags: post, page, shortcode, edit, text, widget
Requires at least: 3.0
Tested up to: 4.0
Stable tag: 1.0.6
License: GPLv2

Simple drop cap plugin. Transform the first letter of a word into a drop cap or initial letter simply by wrapping the word with shortcode [dropcap].

== Description ==

This plugin helps you transform the first letter of a word into a drop cap or initial letter simply by wrapping the word with shortcode [dropcap]. If you don't know what a drop cap is, please read [this article](http://en.wikipedia.org/wiki/Initial) from Wikipedia.

= How to use this plugin: =

1. For WP version 3.9 or higher, on post or page editing interface, select the word you want to transform into a drop cap.
2. Click "Drop Cap" button which is located on tinymce editor tools.
3. For WP version below 3.9, you can manually wrap a word with the shortcode like this: [dropcap]word[/dropcap].
4. You can also use the dropcap shortcode on a widget.

== Installation ==

= How to install this plugin: =

1. Upload 'simple-drop-cap' to the '/wp-content/plugins/' directory.
2. Activate the plugin through the plugin dashboard.

== Frequently Asked Questions ==

= How do I change the style of the drop cap? =

You can change it directly in 'includes/scripts.php' file on line 12. Specific style change feature probably will be added in the next version of the plugin.

== Screenshots ==

1. Float Mode
2. Normal Mode
3. Drop Cap on a Widget

== Changelog ==

= 1.0 =
* First official release

= 1.0.1 =
* Add prefix to variables

= 1.0.3 =
* Fix widget support
* Cleaner code

= 1.0.4 =
* Fix dropcap in post excerpt
* Use custom wp_trim_excerpt() function

= 1.0.5 =
* Enable dropcap button on all post type

= 1.0.6 =
* Add multi byte character support

== Upgrade Notice ==

Upgrade notice will be added for future upgrades.