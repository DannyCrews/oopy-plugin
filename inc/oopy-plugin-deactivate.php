<?php
/**
 * @package  OopyPlugin
 */
class OopyPluginDeactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
	}
}