<?php
namespace GDO\Account\Method;

use GDO\Account\Module_Account;
use GDO\Core\Method;
use GDO\Core\GDO_Module;
use GDO\Core\ModuleLoader;
use GDO\Core\GDT_Tuple;
use GDO\Core\GDT_Method;
use GDO\UI\GDT_Panel;

/**
 * Show settings for all modules.
 * 
 * @author gizmore
 * @version 7.0.1
 * @since 7.0.0
 * @see Settings
 */
final class AllSettings extends Method
{
	
	public function isUserRequired() : bool
	{
		return true;
	}
	
	/**
	 * Render account bar.
	 */
	public function onRenderTabs() : void
	{
		Module_Account::instance()->renderAccountBar();
	}

	/**
	 * @return GDO_Module[]
	 */
	private function getModules() : array
	{
		$modules = ModuleLoader::instance()->getEnabledModules();
		usort($modules, function(GDO_Module $a, GDO_Module $b) {
			return strcasecmp($a->renderName(), $b->renderName());
		});
		return $modules;
	}

	/**
	 * Create a Settings method for every module.
	 */
	public function execute()
	{
		$response = GDT_Tuple::make();
		$response->addField(GDT_Panel::make()->text('info_all_settings'));
		foreach ($this->getModules() as $module)
		{
			if ($module->getSettingsCache())
			{
				$inputs = $this->getInputs();
				$inputs['module'] = $module->getName();
				$method = Settings::make();
				$gdtmet = GDT_Method::make()->method($method)->inputs($inputs)->noChecks();
				$response->addField($gdtmet->execute());
			}
		}
		return $response;
	}
	
}
