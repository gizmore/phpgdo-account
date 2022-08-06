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
 * @version 7.0.0
 * @see Settings
 */
final class AllSettings extends Method
{
	/**
	 * Render account bar.
	 */
	public function beforeExecute() : void
	{
		Module_Account::instance()->renderAccountBar();
	}

	/**
	 * @return GDO_Module[]
	 */
	private function getModules() : array
	{
		return ModuleLoader::instance()->getEnabledModules();
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
			if ($module->getUserSettings())
			{
				$inputs = $this->getInputs();
				$inputs['module'] = $module->getName();
				$method = Settings::make();#->withAppliedInputs($inputs);
				$gdtmet = GDT_Method::make()->inputs($inputs)->method($method);
				$response->addField($gdtmet->execute(true));
			}
		}
		return $response;
	}
	
}
