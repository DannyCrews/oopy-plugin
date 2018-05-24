<?php
/**
 * @package  OopyPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;

/**
*
*/
class Admin extends BaseController
{

	public $settings;

	public $callbacks;
	public $callbacks_mngr;

	public $pages = [];

	public $subpages = [];

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

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
		$args = [];

		foreach ( $this->managers as $key => $value ) {
			$args[] = [
				'option_group' => 'oopy_plugin_settings',
				'option_name' => $key,
				'callback' => [ $this->callbacks_mngr, 'checkboxSanitize' ]
			];
		}

		$this->settings->setSettings( $args );
	}


	public function setSections()
	{
		$args = [
			[
				'id' => 'oopy_admin_index',
				'title' => 'Settings Manager',
				'callback' => [ $this->callbacks_mngr, 'adminSectionManager' ],
				'page' => 'oopy_plugin'
			]
		];

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = [];

		foreach ( $this->managers as $key => $value ) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'oopy_plugin',
				'section' => 'oopy_admin_index',
				'args' => array(
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}
		$this->settings->setFields( $args );
	}
}