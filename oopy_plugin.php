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

if ( !class_exists( 'OopyPlugin' ) ) {

	class OopyPlugin
	{

		public $plugin;

		function __construct() {
			$this->plugin = plugin_basename( __FILE__ );
		}

		function register() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
			add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
		}

		public function settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=oopy_plugin">Settings</a>';
			array_push( $links, $settings_link );
			return $links;
		}

		public function add_admin_pages() {
			add_menu_page( 'Oopy Plugin', 'Oopy', 'manage_options', 'oopy_plugin', array( $this, 'admin_index' ), 'dashicons-store', 110 );
		}

		public function admin_index() {
			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
		}

		protected function create_post_type() {
			add_action( 'init', array( $this, 'custom_post_type' ) );
		}

		function custom_post_type() {
			register_post_type( 'book', array( 'public' => true, 'label' => 'Books' ) );
		}

		function enqueue() {
			// enqueue all our scripts
			wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
			wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
		}

		function activate() {
				require_once plugin_dir_path( __FILE__ ) . 'inc/oopy-plugin-activate.php';
				OopyPluginActivate::activate();
			}
	}

	$oopyPlugin = new OopyPlugin();
	$oopyPlugin->register();

	// activation
	register_activation_hook( __FILE__, array( $oopyPlugin, 'activate' ) );

	// deactivation
	require_once plugin_dir_path( __FILE__ ) . 'inc/oopy-plugin-deactivate.php';
	register_deactivation_hook( __FILE__, array( 'OopyPluginDeactivate', 'deactivate' ) );
}