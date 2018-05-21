<?php
/**
 * @package  OopyPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
*
*/
class Admin extends BaseController
{

	public $settings;

	public $callbacks;

	public $pages = [];

	public $subpages = [];

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages()
	{
		$this->pages = [
			[
				'page_title' => 'Oopy Plugin',
				'menu_title' => 'Oopy',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_plugin',
				'callback' => [ $this->callbacks, 'adminDashboard' ],
				'icon_url' => 'dashicons-store',
				'position' => 110
			]
		];
	}

	public function setSubpages()
	{
		$this->subpages = [
			[
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Custom Post Types',
				'menu_title' => 'CPT',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_cpt',
				'callback' => [ $this->callbacks, 'adminCpt' ]
			],
			[
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Custom Taxonomies',
				'menu_title' => 'Taxonomies',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_taxonomies',
				'callback' => [ $this->callbacks, 'adminTaxonomy' ]
			],
			[
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Custom Widgets',
				'menu_title' => 'Widgets',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_widgets',
				'callback' => [ $this->callbacks, 'adminWidget' ]
			]
		];
	}

	public function setSettings()
	{
		$args = [
			[
				'option_group' => 'oopy_options_group',
				'option_name' => 'text_example',
				'callback' => [ $this->callbacks, 'oopyOptionsGroup' ]
			],
			[
				'option_group' => 'oopy_options_group',
				'option_name' => 'first_name'
			]
		]
		;
		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = [
			[
				'id' => 'oopy_admin_index',
				'title' => 'Settings',
				'callback' => [ $this->callbacks, 'oopyAdminSection' ],
				'page' => 'oopy_plugin'
			]
		];

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = [
			[
				'id' => 'text_example',
				'title' => 'Text Example',
				'callback' => [ $this->callbacks, 'oopyTextExample' ],
				'page' => 'oopy_plugin',
				'section' => 'oopy_admin_index',
				'args' => [
					'label_for' => 'text_example',
					'class' => 'example-class'
				]
			],
			[
				'id' => 'first_name',
				'title' => 'First Name',
				'callback' => [ $this->callbacks, 'oopyFirstName' ],
				'page' => 'oopy_plugin',
				'section' => 'oopy_admin_index',
				'args' => [
					'label_for' => 'first_name',
					'class' => 'example-class'
				]
			]
		];

		$this->settings->setFields( $args );
	}

}