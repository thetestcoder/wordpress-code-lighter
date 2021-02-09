<?php

/**
 * Plugin Name:       Code Lighter
 * Description:       A Plugin that help you to highlight your code at front side.
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * Author:            The Test Coder
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       code-lighter
 *
 * Code Lighter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Code Lighter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Code Lighter. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */


if (!function_exists('add_action')) {
    echo "Hi There! I'm just a plugin, not much i can do when called directly";
    exit;
}

//setup
define('CODE_LIGHTER_PLUGIN_URL', __FILE__);

//includes file
include('inc/activate.php');
include('inc/deactivate.php');
include('inc/enqueue.php');
include('admin/pages/settings.php');


//registering hooks
register_activation_hook(CODE_LIGHTER_PLUGIN_URL, 'code_lighter_activate');
register_deactivation_hook(CODE_LIGHTER_PLUGIN_URL, 'code_lighter_deactivate');


// action hooks
add_action('wp_enqueue_scripts', 'code_lighter_enqueue');

//filter hooks


//shortcodes


//custom functions


//class init