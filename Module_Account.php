<?php
namespace GDO\Account;

use GDO\Core\GDO_Module;
use GDO\Core\GDT_Checkbox;
use GDO\User\GDO_User;
use GDO\Core\GDT_Template;
use GDO\UI\GDT_Page;
use GDO\UI\GDT_Link;

/**
 * Member Account Changes.
 * List all settings and make them changeable.
 * 
 * @author gizmore
 * @version 7.0.0
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
	        GDO_AccountChange::class,
	        GDO_AccountDelete::class,
	    ];
	}

	##############
	### Config ###
	##############
	public function getConfig() : array
	{
		return [
			GDT_Checkbox::make('feature_account_deletion')->initial('1'),
		    GDT_Checkbox::make('hook_sidebar')->initial('1'),
		];
	}
	public function cfgFeatureDeletion() { return $this->getConfigValue('feature_account_deletion'); }
	public function cfgHookRightBar() { return $this->getConfigValue('hook_sidebar'); }
	
	##############
	### Navbar ###
	##############
	public function onInitSidebar() : void
	{
	    if ($this->cfgHookRightBar())
	    {
	        $user = GDO_User::current();
	        if ( ($user->isMember()) ||
	            ($user->isGuest() && $this->cfgAllowGuests()) )
	        {
	            GDT_Page::$INSTANCE->rightBar()->addField(
	                GDT_Link::make('btn_account')->href(
	                    href('Account', 'Settings')));
	        }
	        
	    }
	}
	
	public function renderAdminTabs()
	{
        GDT_Page::$INSTANCE->topBar()->addField(
            GDT_Template::templatePHP('Account', 'admin_tabs.php'));
	}

	public function renderAccountTabs()
	{
        GDT_Page::$INSTANCE->topBar()->addField(
            GDT_Template::templatePHP('Account', 'overview.php'));
	}
	
}
