<?php
namespace GDO\Account\Method;

use GDO\Admin\MethodAdmin;
use GDO\Core\Method;

/**
 * Admin dashboard for the account menu.
 *
 *
 * @author gizmore
 *
 */
final class Admin extends Method
{

	use MethodAdmin;

	public function execute() {}

	public function getMethodTitle(): string
	{
		return t('admin');
	}

}
