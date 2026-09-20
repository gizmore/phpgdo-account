<?php
namespace GDO\Account\Method;

use GDO\Core\GDO_Module;
use GDO\Core\GDT;
use GDO\Core\GDT_Checkbox;
use GDO\Core\GDT_Field;
use GDO\Core\GDT_Module;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Form;
use GDO\Form\GDT_Submit;
use GDO\Form\MethodForm;
use GDO\Language\Trans;
use GDO\UI\GDT_Accordeon;
use GDO\UI\GDT_Divider;
use GDO\UI\TextStyle;
use GDO\User\GDO_User;
use GDO\User\GDT_User;

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

    public function getMethodTitle(): string
    {
        return t('mt_account_settings', [$this->getSettingsModule()->gdoHumanName()]);
    }

	public function gdoParameters(): array
	{
		return [
			GDT_Module::make('module')->installed()->notNull(),
			GDT_User::make('user')->deleted(),
			GDT_Checkbox::make('opened')->initial('0'),
		];
	}

	public function hasPermission(GDO_User $user, string &$error, array &$args): bool
	{
		$target = $this->gdoParameterValue('user');
		if (!$target || $target->getID() === $user->getID() || $user->isStaff())
		{
			return true;
		}
		$error = 'err_permission_required';
		$args = [];
		return false;
	}

	protected function createForm(GDT_Form $form): void
	{
		$module = $this->getSettingsModule();
		$mname = $module->getName();

//		$form->titleNone();
		$form->noFocus();
        $this->initUserSettingValues();
		$form->addFields(...$this->getFormFields($module));
//		$form->addField(GDT_AntiCSRF::make()->fixed());
		$form->actions()->addFields(
			GDT_Submit::make("save_{$mname}")->label('btn_save_settings', [
				$mname,
			])
				->onclick([
					$this,
					'saveSettings',
				]));

	}

	public function getSettingsModule(): GDO_Module
	{
		return $this->gdoParameterValue('module');
	}

	public function getSettingsUser(): GDO_User
	{
		return $this->gdoParameterValue('user') ?: GDO_User::current();
	}

	private function initUserSettingValues(): void
	{
		$module = $this->getSettingsModule();
		$user = $this->getSettingsUser();
		foreach ($module->getSettingsCache() as $gdt)
		{
			$gdt = $module->userSetting($user, $gdt->name);
			if ($acl = $module->getUserConfigACLField($gdt->name, $user))
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
		return $gdt->isSerializable() && (!$gdt instanceof GDT_Divider) && $gdt->isWriteable();
	}

	/** @return GDT[] */
	private function getFormFields(GDO_Module $module): array
	{
		return array_filter(array_values($module->getSettingsCacheContainers()), [$this, 'filterHiddenSettings']);
	}

	public function saveSettings()
	{
		$messages = [];
		$module = $this->getSettingsModule();
		$user = $this->getSettingsUser();
		$form = $this->getForm();
		foreach ($module->getSettingsCache() as $key => $gdt)
		{
			if (!$gdt instanceof GDT_Field)
			{
				continue;
			}
			$old = $gdt->var;
			$formField = $form->getField($key) ?: $gdt;
            $new = $formField->getVar();
			/** @var $gdt GDT * */
			if (($gdt->isWriteable() || GDO_User::current()->isStaff()) && ($old !== $new))
			{
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

		# Staff may also change module-level config fields shown above.
		if (GDO_User::current()->isStaff())
		{
			foreach ($module->getConfig() as $schema)
			{
				$key = $schema->getName();
				if ((!($schema instanceof GDT_Field)) || (!$field = $form->getField($key)))
				{
					continue;
				}
				$config = $module->getConfigColumn($key);
				$old = $config->getVar();
				$new = $field->getVar();
				if ($old !== $new)
				{
					$module->saveConfigValue($key, $new);
					$messages[] = t('msg_modulevar_changed', [
						TextStyle::bold($config->renderLabel()),
						TextStyle::italic($config->displayVar($old)),
						TextStyle::italic($config->displayVar($new)),
					]);
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
