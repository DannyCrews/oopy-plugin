<?php
/**
Plugin Name:     Oopy Plugin
Plugin URI:      http://www.bu.edu
Description:     An OOP-based plugin for training
Author:          Dan Crews
Author URI:      http://www.bu.edu
License:         GPLv3 or later
Text Domain:     oopy-plugin
Domain Path:     /languages
Version:         0.1.0

@package         Oopy_Plugin

Oopy Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Oopy Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Oopy Plugin. If not, see https://www.gnu.org/licenses/gpl.html.
 */

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Define CONSTANTS
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN', plugin_basename( __FILE__ ) );

use Inc\Base\Activate;
use Inc\Base\Deactivate;

/**
 * The code that runs during plugin activation
 */
function activate_oopy_plugin() {
	Activate::activate();
}
/**
 * The code that runs during plugin deactivation
 */
function deactivate_oopy_plugin() {
	Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_oopy_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_oopy_plugin' );
/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}