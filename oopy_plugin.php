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

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

// if ( ! function_exists( 'add_action' ) ) {
// 	echo 'Hey, you can\t access this file, you silly human!';
// 	exit;
// }

class OopyPlugin
{
	function __construct() {
		add_action( 'init', array( $this, 'custom_post_type' ) );
	}

	function activate() {
		// generated a CPT
		$this->custom_post_type();
		// flush rewrite rules
		flush_rewrite_rules();
	}

	function deactivate() {
		// flush rewrite rules
		flush_rewrite_rules();
	}

	function custom_post_type() {
		register_post_type( 'book', array( 'public' => true, 'label' => 'Books' ) );
	}
}

if ( class_exists( 'OopyPlugin' ) ) {
	$oopyPlugin = new OopyPlugin();
}
// activation
register_activation_hook( __FILE__, array( $oopyPlugin, 'activate' ) );
// deactivation
register_deactivation_hook( __FILE__, array( $oopyPlugin, 'deactivate' ) );


