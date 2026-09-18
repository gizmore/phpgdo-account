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
use GDO\User\GDT_User;

/** Edit all user settings for a selected account. */
final class EditUser extends Method
{
	public function isTrivial(): bool { return false; }

	public function getPermission(): ?string { return 'staff'; }

	public function getMethodTitle(): string
	{
		return t('mt_account_edit_user', [$this->getUser()->renderUserName()]);
	}

	public function gdoParameters(): array
	{
		return [
			GDT_User::make('user')->deleted()->notNull(),
		];
	}

	private function getUser(): GDO_User
	{
		return $this->gdoParameterValue('user');
	}

	public function onRenderTabs(): void
	{
		Module_Account::instance()->renderAccountBar();
	}

	public function execute(): GDT
	{
		$user = $this->getUser();
		$response = GDT_Tuple::make();
		$response->addField(GDT_Panel::make()->text('info_account_edit_user', [$user->renderUserName()]));
		foreach ($this->getModules() as $module)
		{
			if ($this->hasEditableSettings($module))
			{
				$inputs = $this->getInputs();
				$inputs['module'] = $module->getModuleName();
				$inputs['user'] = $user->getID();
				$method = Settings::make();
				$response->addField(GDT_Method::make()->method($method)->inputs($inputs)->noChecks()->execute());
			}
		}
		return $response;
	}

	private function hasEditableSettings(GDO_Module $module): bool
	{
		return $module->hasUserSettings() || !empty($module->getSettingsConfigs());
	}

	/** @return GDO_Module[] */
	private function getModules(): array
	{
		$modules = ModuleLoader::instance()->getEnabledModules();
		usort($modules, static fn(GDO_Module $a, GDO_Module $b): int => strcasecmp($a->renderName(), $b->renderName()));
		return $modules;
	}
}
