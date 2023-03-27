<?php
namespace GDO\Account\Method;

use GDO\Admin\MethodAdmin;
use GDO\Core\GDT;
use GDO\Core\GDT_Response;
use GDO\Core\Method;

/**
 * Admin dashboard for the account menu.
 *
 * @author gizmore
 */
final class Admin extends Method
{

	use MethodAdmin;

	public function getMethodTitle(): string
	{
		return t('admin');
	}

	public function execute(): GDT
	{
		return GDT_Response::make();
	}

}
