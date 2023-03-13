<?php
namespace GDO\Account\Method;

use GDO\Core\Method;
use GDO\Admin\MethodAdmin;

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

	public function execute()
	{
	}

	public function getMethodTitle(): string
	{
		return t('admin');
	}

}
