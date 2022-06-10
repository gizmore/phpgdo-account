<?php
namespace GDO\Account\Method;

use GDO\Form\GDT_Form;
use GDO\Form\MethodForm;
use GDO\Core\GDT_Module;
use GDO\Core\ModuleLoader;
use GDO\Core\GDO_Module;
use GDO\UI\GDT_Accordeon;
use GDO\Form\GDT_Submit;
use GDO\Account\Module_Account;

final class Settings extends MethodForm
{
	public function gdoParameters() : array
	{
		return [
			GDT_Module::make('module')->installed(),
		];
	}
	
	public function beforeExecute() : void
	{
		Module_Account::instance()->renderAccountBar();
	}
	
	/**
	 * @return GDO_Module[string]
	 */
	public function getModules() : array
	{
		return ModuleLoader::instance()->getEnabledModules();
	}
	
	public function createForm(GDT_Form $form): void
	{
		foreach ($this->getModules() as $module)
		{
			$this->createFormForModule($form, $module);
		}
	}
	
	private function createFormForModule(GDT_Form $form, GDO_Module $module)
	{
		$mname = $module->getName();
		$form2 = GDT_Form::make("accform_{$mname}");
		$form2->addFields(...$module->getSettingsCache());
		$form2->actions()->addFields(GDT_Submit::make("save_{$mname}"));
		$accordeon = GDT_Accordeon::make("acc_{$mname}");
		$accordeon->addField($form2);
		$form->addField($accordeon);
	}
	
	
}
