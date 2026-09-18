<?php
declare(strict_types=1);
namespace GDO\Account\Method;

use GDO\Account\Module_Account;
use GDO\Core\GDO_Module;
use GDO\Core\GDT;
use GDO\Core\GDT_Method;
use GDO\Core\GDT_Tuple;
use GDO\Core\Method;
use GDO\Core\ModuleLoader;
use GDO\UI\GDT_Panel;
use GDO\User\GDO_User;

/**
 * Show settings for all modules.
 *
 * @version 7.0.3
 * @since 7.0.0
 * @author gizmore
 * @see Settings
 */
final class AllSettings extends Method
{

	public function getMethodTitle(): string
	{
		return t('link_settings');
	}

	public function isUserRequired(): bool
	{
		return true;
	}

	/**
	 * Render account bar.
	 */
	public function onRenderTabs(): void
	{
		Module_Account::instance()->renderAccountBar();
	}

	/**
	 * Create a Settings method for every module.
	 */
	public function execute(): GDT
	{
		$response = GDT_Tuple::make();
		$response->addField(GDT_Panel::make()->text('info_all_settings'));
		foreach ($this->getModules() as $module)
		{
			if ($this->hasEditableSettings($module))
			{
				$inputs = $this->getInputs();
				$inputs['module'] = $module->getModuleName();
				$method = Settings::make();
				$gdtmet = GDT_Method::make()->method($method)->inputs($inputs)->noChecks();
				$response->addField($gdtmet->execute());
			}
		}
		return $response;
	}


	/**
	 * @return GDO_Module[]
	 */
	private function getModules(): array
	{
		$modules = ModuleLoader::instance()->getEnabledModules();
		usort($modules, function (GDO_Module $a, GDO_Module $b)
		{
			return strcasecmp($a->renderName(), $b->renderName());
		});
		return $modules;
	}

	private function hasEditableSettings(GDO_Module $module): bool
	{
		return $module->hasUserSettings() ||
			(GDO_User::current()->isStaff() && !empty($module->getSettingsConfigs()));
	}

}
