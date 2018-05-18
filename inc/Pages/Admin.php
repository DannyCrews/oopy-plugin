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

		$this->subpages = [
			[
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CPT',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_cpt',
				'callback' => function() { echo '<h1>CPT Manager</h1>'; }
			],
			[
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_taxonomies',
				'callback' => function() { echo '<h1>Taxonomies Manager</h1>'; }
			],
			[
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Custom Widgets',
				'menu_title' => 'Widgets',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_widgets',
				'callback' => function() { echo '<h1>Widgets Manager</h1>'; }
			]
		];
	}

	public function register()
	{
		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}
}