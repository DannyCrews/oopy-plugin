<?php
/**
 * @package  OopyPlugin
 */
namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

/**
*
*/
class Admin extends BaseController
{

	public $settings;

	public $pages = [];

	public function __construct()
	{
		$this->settings = new SettingsApi();

		$this->pages = [
			[
				'page_title' => 'Ooopy Plugin',
				'menu_title' => 'Oopy',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_plugin',
				'callback' => function() { echo '<h1>Oopy Plugin</h1>'; },
				'icon_url' => 'dashicons-store',
				'position' => 110
			]
		];
	}

	public function register()
	{
		$this->settings->addPages( $this->pages )->register();
	}
}