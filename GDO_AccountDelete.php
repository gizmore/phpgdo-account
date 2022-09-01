<?php
namespace GDO\Account;

use GDO\Core\GDO;
use GDO\UI\GDT_Message;
use GDO\User\GDT_Username;
use GDO\User\GDO_User;
use GDO\Core\GDT_CreatedAt;
use GDO\Core\GDT_AutoInc;
/**
 * An account deletion note.
 * 
 * @author gizmore
 * @version 7.0.1
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
			GDT_AutoInc::make('accrm_id'),
			GDT_Username::make('accrm_username')->notNull()->unique(false),
			GDT_Message::make('accrm_note'),
			GDT_CreatedAt::make('accrm_created'),
		];
	}

	##############
	### Static ###
	##############
	public static function insertNote(GDO_User $user, string $note)
	{
		return self::blank([
			'accrm_username' => $user->renderUserName(),
			'accrm_note' => $note,
		])->insert();
	}
	
}
