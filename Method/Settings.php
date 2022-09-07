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
use GDO\Util\Arrays;
use GDO\Core\GDT_Checkbox;

/**
 * Offers users to change and view their settings for a single module.
 *
 * @author gizmore
 * @version 7.0.1
 * @since 6.1.0
 * @see AllSettings for all modules at once.
 */
final class Settings extends MethodForm
{
	public function isShownInSitemap() : bool { return false; }

	public function gdoParameters(): array
	{
		return [
			GDT_Module::make('module')->installed()->notNull(),
			GDT_Checkbox::make('opened')->initial('0'),
		];
	}
	
	public function isOpened() : bool
	{
		return $this->submitted || $this->gdoParameterVar('opened');
	}

	public function getSettingsModule(): GDO_Module
	{
		return $this->gdoParameterValue('module');
	}

	public function createForm(GDT_Form $form): void
	{
		$module = $this->getSettingsModule();
		$mname = $module->getName();
		
		$form->noTitle();
		$form->noFocus();
		
		$form->addFields(...array_values($module->getSettingsCacheContainers()));
		$form->addField(GDT_AntiCSRF::make());
		
		$form->actions()->addFields(
			GDT_Submit::make("save_{$mname}")->label(
				'btn_save_settings', [
					$mname
				])->onclick([$this, 'saveSettings']));
		
		$this->initUserSettingValues();
	}
	
	public function resetForm(bool $removeInput = false) : void
	{
		# Do **NOT** reset the form :)
		# This is quite rare to need for stuff to work.
		# Settings are a bit tricky.
		# $initial always holds the default value for all users, unlike other GDT usage.
		# Quirky but ok.
	}
	
	private function initUserSettingValues() : void
	{
		$module = $this->getSettingsModule();
		foreach ($module->getSettingsCache() as $gdt)
		{
			$gdt = $module->setting($gdt->name);
			if ($acl = $module->getSettingACL($gdt->name))
			{
				$acl->setupLabels($gdt);
			}
// 			$gdt->tooltip('test');
		}
	}

	public function renderPage(): GDT
	{
		$module = $this->getSettingsModule();
		$mname = $module->getName();
		$form = $this->getForm();
		$accordeon = GDT_Accordeon::make("acc_{$mname}");
		$accordeon->titleRaw($module->renderName());
		$accordeon->addField($form)->opened($this->isOpened());
		return $accordeon;
	}

	public function saveSettings()
	{
		$messages = [];
		$module = $this->getSettingsModule();
		$user = GDO_User::current();
		foreach (Arrays::unique($module->getSettingsCache()) as $key => $gdt)
		{
			/** @var $gdt GDT **/
			if ($gdt->isWriteable() && $gdt->hasChanged())
			{
				$old = $gdt->var;
				$new = $gdt->getVar();
				foreach ($gdt->getGDOData() as $key => $var)
				{
// 					$gdt->inputs($this->inputs);
					$module->saveUserSetting($user, $key, $var);
				}
				$messages[] = t('msg_modulevar_changed', [
					$gdt->renderLabel(),
					$gdt->displayVar($old), $gdt->displayVar($new)]);
			}
		}
		if (count($messages))
		{
			$this->message('msg_settings_saved', [$module->renderName(), implode(' ', $messages)]);
		}
		return $this->renderPage();
	}

}
