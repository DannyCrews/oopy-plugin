<?php
/**
 * @package  OopyPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
*
*/
class WidgetController extends BaseController
{
	public $callbacks;

	public $subpages = array();

	public function register()
	{
		if ( ! $this->activated( 'widget_manager' ) ) return;

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->settings->addSubPages( $this->subpages )->register();
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Widget Manager',
				'menu_title' => 'Widget Manager',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_widget',
				'callback' => array( $this->callbacks, 'adminWidget' )
			)
		);
	}
}