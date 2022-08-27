<?php
namespace GDO\Account;

use GDO\Core\GDO_Module;
use GDO\Core\GDT_Checkbox;
use GDO\User\GDO_User;
use GDO\UI\GDT_Page;
use GDO\UI\GDT_Link;
use GDO\Core\GDT_Hook;
use GDO\UI\GDT_Bar;

/**
 * Member Account Changes.
 * List all settings and make them changeable.
 * 
 * @author gizmore
 * @version 7.0.1
 * @since 3.0.0
 * @see GDO_User
 */
final class Module_Account extends GDO_Module
{
    public int $priority = 25;
    
    ##############
	### Module ###
	##############
	public function onLoadLanguage() : void
	{
		$this->loadLanguage('lang/account');
	}
	
	public function getClasses() : array
	{
	    return [
	        GDO_AccountDelete::class,
	    ];
	}
	
	public function getDependencies() : array
	{
		return [
			'Login',
		];
	}

	##############
	### Config ###
	##############
	public function getConfig() : array
	{
		return [
			GDT_Checkbox::make('feature_account_deletion')->initial('1'),
			GDT_Checkbox::make('feature_account_purge')->initial('1'),
			GDT_Checkbox::make('hook_sidebar')->initial('1'),
		];
	}
	public function cfgFeatureDeletion() : bool { return $this->getConfigValue('feature_account_deletion'); }
	public function cfgFeaturePurge() : bool { return $this->getConfigValue('feature_account_purge'); }
	public function cfgHookRightBar() : bool { return $this->getConfigValue('hook_sidebar'); }
	
	##############
	### Navbar ###
	##############
	private GDT_Bar $accountBar;
	public function getTopNav()
	{
		if (!isset($this->accountBar))
		{
			$this->accountBar = GDT_Bar::make('account_bar')->horizontal();
			GDT_Page::instance()->topResponse()->addField($this->accountBar);
		}
		return $this->accountBar;
	}
	
	public function renderAccountBar()
	{
		$nav = $this->getTopNav();
		$nav->addField(GDT_Link::make('link_settings')->href(href('Account', 'AllSettings')));
		GDT_Hook::callHook('AccountBar', $nav);
		if ($this->cfgFeatureDeletion())
		{
			$nav->addField(GDT_Link::make('mt_account_delete')->href(href('Account', 'Delete')));
		}
	}
	
	public function onInitSidebar() : void
	{
	    if ($this->cfgHookRightBar())
	    {
	        $user = GDO_User::current();
	        if ($user->isUser())
	        {
	            GDT_Page::$INSTANCE->rightBar()->addField(
	                GDT_Link::make('btn_account')->href(
	                    href('Account', 'AllSettings')));
	        }
	    }
	}
	
}
