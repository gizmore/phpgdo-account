<?php
namespace GDO\Account;

use GDO\Core\GDO;
use GDO\UI\GDT_Message;
use GDO\User\GDT_Username;
use GDO\User\GDO_User;
use GDO\Core\GDT_CreatedAt;
/**
 * An account deletion note.
 * 
 * @author gizmore
 * @version 7.0.0
 * @since 3.1.0
 */
final class GDO_AccountDelete extends GDO
{
	public function gdoCached() : bool { return false; }
	
	###########
	### GDO ###
	###########
	public function gdoColumns() : array
	{
		return [
			GDT_Username::make('accrm_username')->notNull(),
			GDT_Message::make('accrm_note')->notNull(),
			GDT_CreatedAt::make('accrm_created'),
		];
	}

	##############
	### Static ###
	##############
	public static function insertNote(GDO_User $user, string $note)
	{
		return self::blank([
			'accrm_username' => $user->getName(),
			'accrm_note' => $note,
		])->insert();
	}
	
}
