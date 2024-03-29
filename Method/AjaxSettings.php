<?php
namespace GDO\Account\Method;

use GDO\Core\GDT;
use GDO\Core\GDT_JSON;
use GDO\Core\MethodAjax;
use GDO\Core\ModuleLoader;
use GDO\User\GDO_User;

/**
 * Get all user settings for the current user via ajax.
 *
 * @version 7.0.1
 * @since 6.7.0
 * @author gizmore
 */
final class AjaxSettings extends MethodAjax
{

	public function isUserRequired(): bool
	{
		return true;
	}

	public function execute(): GDT
	{
		$user = GDO_User::current();
		$json = ['user' => $user->toJSON()];
		$modules = ModuleLoader::instance()->getEnabledModules();
		foreach ($modules as $module)
		{
			$modulename = $module->getName();

			foreach ($module->getSettingsCache() as $gdt)
			{
				$gdt = $module->userSetting($user, $gdt->getName()); # to assign current user to gdt
				if ($gdt->isSerializable() && ($gdt->isACLCapable() || ($gdt->getName() === 'profile_visibility'))  && (!$gdt->isHidden()))
				{
					$json[$modulename] = $json[$modulename] ?? [];
					$json[$modulename][$gdt->getName()] = [
						'type' => $gdt->gdoClassName(),
						'options' => $gdt->configJSON(),
					];
				}
			}
		}
		return GDT_JSON::make()->value($json);
	}

}
