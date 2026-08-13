<?php
namespace GDO\Account\Method;

use GDO\Core\GDT;
use GDO\Core\GDT_JSON;
use GDO\Core\MethodAjax;
use GDO\Core\ModuleLoader;
use GDO\UI\GDT_Error;
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
		return false;
	}

	public function execute(): GDT
	{
		$user = GDO_User::current();
		$json = ['user' => $user->toJSON()];
		$modules = ModuleLoader::instance()->getEnabledModules();
		foreach ($modules as $module)
		{
			$modulename = $module->getName();
			$moduleSort = (int)$module->gdoValue('module_sort');
			foreach ($module->getSettingsCache() as $gdt)
			{
				$gdt = $module->userSetting($user, $gdt->getName()); # to assign current user to gdt
				if ($gdt->isSerializable() && (!$gdt->isHidden()))
				{
					$acl = $module->getUserConfigACLField($gdt->getName(), $user);
					$json[$modulename] = $json[$modulename] ?? [];
					$json[$modulename][$gdt->getName()] = [
						'module' => $modulename,
						'module_sort' => $moduleSort,
						'name' => $gdt->getName(),
						'label' => $gdt->labelKey ?? $gdt->getName(),
						'type' => $gdt->gdoClassName(),
						'options' => $gdt->configJSON(),
						'writeable' => $gdt->isWriteable(),
						'acl' => $acl ? $acl->aclRelation->getVar() : null,
					];
				}
			}
		}
		return GDT_JSON::make()->value($json);
	}

}
