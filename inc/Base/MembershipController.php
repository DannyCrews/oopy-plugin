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
class MembershipController extends BaseController
{
	public $callbacks;

	public $subpages = [];

	public function register()
	{
		if ( ! $this->activated( 'membership_manager' ) ) return;

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
				'page_title' => 'Membership Manager',
				'menu_title' => 'Membership Manager',
				'capability' => 'manage_options',
				'menu_slug' => 'oopy_membership',
				'callback' => [ $this->callbacks, 'adminMembership' ]
			]
		];
	}
}