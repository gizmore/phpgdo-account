<?php
namespace GDO\Account;

use GDO\Core\GDO;
use GDO\Core\GDT_AutoInc;
use GDO\Core\GDT_CreatedAt;
use GDO\UI\GDT_Message;
use GDO\User\GDO_User;
use GDO\User\GDT_Username;

/**
 * An account deletion note.
 *
 * @version 7.0.1
 * @since 3.1.0
 * @author gizmore
 */
final class GDO_AccountDelete extends GDO
{

	public static function insertNote(GDO_User $user, string $note)
	{
		return self::blank([
			'accrm_username' => $user->renderUserName(),
			'accrm_note' => $note,
		])->insert();
	}

	###########
	### GDO ###
	###########

	public function gdoCached(): bool { return false; }

	##############
	### Static ###
	##############

	public function gdoColumns(): array
	{
		return [
			GDT_AutoInc::make('accrm_id'),
			GDT_Username::make('accrm_username')->notNull()->unique(false),
			GDT_Message::make('accrm_note'),
			GDT_CreatedAt::make('accrm_created'),
		];
	}

}
