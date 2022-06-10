<?php
namespace GDO\Account\Method;

use GDO\Form\GDT_Form;
use GDO\Core\GDT;
use GDO\Core\GDT_Module;
use GDO\Core\GDO_Module;
use GDO\UI\GDT_Accordeon;
use GDO\Form\GDT_Submit;
use GDO\Form\MethodForm;

/**
 * Offers users to change and view their settings for a single module.
 * 
 * @author gizmore
 * @version 7.0.0
 * @since 6.1.0
 */
final class Settings extends MethodForm
{
	public function gdoParameters() : array
	{
		return [
			GDT_Module::make('module')->installed()->notNull(),
		];
	}
	
	public function getModule() : GDO_Module
	{
		return $this->gdoParameterValue('module');
	}
	
	public function createForm(GDT_Form $form): void
	{
		$module = $this->getModule();
		$mname = $module->getName();
		$form->name("form_{$mname}");
		$form->noTitle();
		$form->addFields(...$module->getSettingsCache());
		$form->actions()->addFields(GDT_Submit::make("save_{$mname}"));
	}
	
	public function renderPage() : GDT
	{
		$module = $this->getModule();
		$mname = $module->getName();
		$form = $this->getForm();
		$accordeon = GDT_Accordeon::make("acc_{$mname}");
		$accordeon->titleRaw($module->renderName());
		$accordeon->addField($form)->opened();
		return $accordeon;
	}
	
	
}
