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
class AuthController extends BaseController
{
	public $callbacks;

	public $subpages = [];

	public function register()
	{
		if ( ! $this->activated( 'login_manager' ) ) return;
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->setSubpages();

		$this->settings->addSubPages( $this->subpages )->register();
	}

	public function setSubpages()
	{
		$this->subpages = [
			[
				'parent_slug' => 'oopy_plugin',
				'page_title' => 'Login Manager',
				'menu_title' => 'Login Manager',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_auth',
				'callback' => [ $this->callbacks, 'adminAuth' ]
			]
		];
	}
}