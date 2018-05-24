<?php
/**
 * @package  OopyPlugin
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		if ( get_option( 'oopy_plugin' ) ) {
			return;
		}

		$default = [];

		update_option( 'oopy_plugin', $default );
	}
}