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
use GDO\Core\GDT_Field;
use GDO\Form\GDT_AntiCSRF;

/**
 * Offers users to change and view their settings for a single module.
 *
 * @author gizmore
 * @version 7.0.0
 * @since 6.1.0
 */
final class Settings extends MethodForm
{

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
		$module = $this->getModule();
		$mname = $module->getName();
		$form->noTitle();
		foreach ($module->getSettingsCache() as $gdt)
		{
			if ($gdt instanceof GDT_Field)
			{
				$gdt->initial($module->settingVar($gdt->getName()));
				$form->addField($gdt);
			}
		}
		$form->addField(GDT_AntiCSRF::make());
		$form->actions()->addFields(
			GDT_Submit::make("save_{$mname}")->label(
				'btn_save_settings', [
					$mname
				]));
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
				$old = $gdt->getInitial();
				$new = $this->gdoParameterVar($key);
				if ($old !== $new)
				{
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
