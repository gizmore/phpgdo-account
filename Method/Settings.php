<?php
namespace GDO\Account\Method;

use GDO\Form\GDT_Form;
use GDO\Core\GDT;
use GDO\Core\GDT_Module;
use GDO\Core\GDO_Module;
use GDO\UI\GDT_Accordeon;
use GDO\Form\GDT_Submit;
use GDO\Form\MethodForm;
use GDO\User\GDO_User;
use GDO\Form\GDT_AntiCSRF;

/**
 * Offers users to change and view their settings for a single module.
 *
 * @author gizmore
 * @version 7.0.1
 * @since 6.1.0
 */
final class Settings extends MethodForm
{
	public function showInSitemap() : bool { return false; }

	public function gdoParameters(): array
	{
		return [
			GDT_Module::make('module')->installed()->notNull(),
		];
	}

	public function getModule(): GDO_Module
	{
		return $this->gdoParameterValue('module');
	}

	public function createForm(GDT_Form $form): void
	{
		$this->initUserSettingValues();

		$module = $this->getModule();
		$mname = $module->getName();
		$form->noTitle();
		$form->noFocus();
		$form->addFields(...array_values($module->getSettingsCacheContainers()));
		$form->addField(GDT_AntiCSRF::make());
		$form->actions()->addFields(
			GDT_Submit::make("save_{$mname}")->label(
				'btn_save_settings', [
					$mname
				]));
	}
	
	private function initUserSettingValues() : void
	{
		$module = $this->getModule();
		foreach ($module->getSettingsCache() as $gdt)
		{
// 			if ($gdt instanceof GDT_Field)
			{
				$gdt = $module->setting($gdt->name);
				if ($acl = $module->getSettingACL($gdt->name))
				{
					$acl->setupLabels($gdt);
				}
			}
		}
	}

	public function renderPage(): GDT
	{
		$module = $this->getModule();
		$mname = $module->getName();
		$form = $this->getForm();
		$accordeon = GDT_Accordeon::make("acc_{$mname}");
		$accordeon->titleRaw($module->renderName());
		$accordeon->addField($form)->opened();
		return $accordeon;
	}

	public function formValidated(GDT_Form $form)
	{
		$messages = [];
		$module = $this->getModule();
		$user = GDO_User::current();
		foreach ($module->getSettingsCache() as $key => $gdt)
		{
			if ($gdt->isWriteable())
			{
				if ($gdt->hasChanged())
				{
					$old = $gdt->getInitial();
					$new = $this->gdoParameterVar($key);
					$module->saveUserSetting($user, $key, $new);
					$messages[] = t('msg_setting_changed', [$gdt->renderLabel(), $gdt->displayVar($old), $gdt->displayVar($new)]);
				}
			}
		}
		if (count($messages))
		{
			$this->message('msg_settings_saved', [$module->renderName(), implode(' ', $messages)]);
		}
		return $this->renderPage();
	}

}
