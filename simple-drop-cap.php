<?php 
/**
 * Plugin Name: Simple Drop Cap
 * Plugin URI: http://wordpress.org/plugins/simple-drop-cap/
 * Description: Simple drop cap plugin. Transform the first letter of a word into a drop cap or initial letter simply by wrapping the word with shortcode [dropcap].
 * Author: Yudhistira Mauris
 * Author URI: http://www.yudhistiramauris.com
 * Version: 1.1.4
 * License: GPLv2
 */

/**  Copyright 2014 Yudhistira Mauris (email: contact@yudhistiramauris.com)
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License, version 2, as 
 *   published by the Free Software Foundation.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program; if not, write to the Free Software
 *   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/************************
 * GLOBAL VARIABLES
 ***********************/



/************************
 * INCLUDES
 ***********************/

include ('includes/register-shortcode.php');
include ('includes/create-setting-menu-page.php');
include ('includes/register-settings.php');
include ('includes/register-tinymce-button.php');
include ('includes/scripts.php');