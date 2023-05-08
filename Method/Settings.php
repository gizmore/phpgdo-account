<?php
namespace GDO\Account\Method;

use GDO\Core\GDO_Module;
use GDO\Core\GDT;
use GDO\Core\GDT_Checkbox;
use GDO\Core\GDT_Module;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_Submit;
use GDO\Form\MethodForm;
use GDO\Language\Trans;
use GDO\UI\GDT_Accordeon;
use GDO\UI\TextStyle;
use GDO\User\GDO_User;

/**
 * Offers users to change and view their settings for a single module.
 *
 * @version 7.0.1
 * @since 6.1.0
 * @author gizmore
 * @see AllSettings for all modules at once.
 */
final class Settings extends MethodForm
{

	public function isShownInSitemap(): bool
	{
		return false;
	}

	public function isTrivial(): bool
	{
		return false;
	}

	public function gdoParameters(): array
	{
		return [
			GDT_Module::make('module')->installed()->notNull(),
			GDT_Checkbox::make('opened')->initial('0'),
		];
	}

	protected function createForm(GDT_Form $form): void
	{
		$module = $this->getSettingsModule();
		$mname = $module->getName();

		$form->noTitle();
		$form->noFocus();
		$form->addFields(
			...array_filter(array_values($module->getSettingsCacheContainers()), [
			$this,
			'filterHiddenSettings',
		]));
		$form->addField(GDT_AntiCSRF::make()->fixed());
		$form->actions()->addFields(
			GDT_Submit::make("save_{$mname}")->label('btn_save_settings', [
				$mname,
			])
				->onclick([
					$this,
					'saveSettings',
				]));

		$this->initUserSettingValues();
	}

	public function getSettingsModule(): GDO_Module
	{
		return $this->gdoParameterValue('module');
	}

	private function initUserSettingValues(): void
	{
		$module = $this->getSettingsModule();
		foreach ($module->getSettingsCache() as $gdt)
		{
			$gdt = $module->setting($gdt->name);
			if ($acl = $module->getUserConfigACLField($gdt->name, GDO_User::current()))
			{
				$acl->setupLabels($gdt);
			}
			$tt = "tt_cfg_{$gdt->name}";
			if (Trans::hasKey($tt))
			{
				$gdt->tooltip($tt);
			}
		}
	}

	public function resetForm(bool $removeInput = false): void
	{
		# Do **NOT** reset the form :)
		# This is quite rare to need for stuff to work.
		# Settings are a bit tricky.
		# $initial always holds the default value for all users, unlike other GDT usage.
		# Quirky but ok.
	}

	public function filterHiddenSettings(GDT $gdt): bool
	{
		return !$gdt->isHidden();
	}

	public function saveSettings()
	{
		$messages = [];
		$module = $this->getSettingsModule();
		$user = GDO_User::current();
		foreach ($module->getSettingsCache() as $key => $gdt)
		{
			/** @var $gdt GDT * */
			if ($gdt->isWriteable() && $gdt->hasChanged())
			{
				$old = $gdt->var;
				$new = $gdt->getVar();
				$module->saveUserSetting($user, $key, $new);
				$messages[] = t('msg_modulevar_changed',
					[
						TextStyle::bold($gdt->renderLabel()),
						TextStyle::italic($gdt->displayVar($old)),
						TextStyle::italic($gdt->displayVar($new)),
					]);
			}

			# The fields ACL relation value.
			if ($acl = $module->getUserConfigACLField($key, $user))
			{
				$aclr = $acl->aclRelation;
				if ($aclr->hasChanged())
				{
					$messages[] = t('msg_modulevar_changed',
						[
							TextStyle::bold($aclr->renderLabel()),
							TextStyle::italic($aclr->displayVar($aclr->var)),
							TextStyle::italic($aclr->displayVar($aclr->getVar())),
						]);
					$module->saveUserSettingACLRelation($user, $key, $aclr->getVar());
				}
			}
		}
		if (count($messages))
		{
			$this->message('msg_settings_saved', [
				$module->renderName(),
				implode("<br/>\n", $messages),
			]);
		}
		return $this->renderPage();
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

	public function isOpened(): bool
	{
		return $this->submitted || $this->gdoParameterVar('opened');
	}

}
