<?php
/**
 * @package  OopyPlugin
 */
class OopyPluginActivate
{
	public static function activate() {
		flush_rewrite_rules();
	}
}