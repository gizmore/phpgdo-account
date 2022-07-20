<?php
namespace GDO\Account;

use GDO\Core\GDO;
use GDO\Core\GDT_CreatedAt;
use GDO\Core\GDT_Serialize;
use GDO\Core\GDT_Token;
use GDO\User\GDT_User;
use GDO\User\GDO_User;
use GDO\Core\GDT_Module;
use GDO\Core\GDT_Name;

/**
 * A table to store tokens associated with a userid type and serialized data.
 * Used to change demographic options on a bunch via mail,
 * and to change the email.
 * Could be used in more stuff, like Recovery.
 * 
 * @author gizmore
 * @version 7.0.0
 * @since 3.0.0
 */
final class GDO_AccountChange extends GDO
{
	public function gdoCached() : bool { return false; }
	
	###########
	### GDO ###
	###########
	public function gdoColumns() : array
	{
		return [
			GDT_User::make('accchg_user')->primary(),
			GDT_Module::make('accchg_module')->primary(),
			GDT_Name::make('accchg_setting')->primary(),
			GDT_Token::make('accchg_token')->notNull(),
			GDT_Serialize::make('accchg_data'),
			GDT_CreatedAt::make('accchg_time'),
		];
	}
	
	##############
	### Getter ###
	##############
	public function getUser() : GDO_User { return $this->gdoValue('accchg_user'); }
	public function getUserID() : string { return $this->gdoVar('accchg_user'); }
	public function getTimestamp() : int { return $this->gdoValue('accchg_time'); }
	public function getToken() : string { return $this->gdoVar('accchg_token'); }
	public function getData() : array { return $this->gdoValue('accchg_data'); }
	
	##############
	### Static ###
	##############
	/**
	 * @param string $userid
	 * @param string $type
	 * @param mixed $data
	 * @return self
	 */
	public static function addRow(string $userid, array $data=null)
	{
		$row = self::blank(['accchg_user' => $userid]); # @TODO Here, a GDO::blankValues() is missing.
		$row->setValue('accchg_data', $data);
		return $row->replace();
	}
	
	/**
	 * @param string $userid
	 * @param string $type
	 * @param string $token
	 * @return self
	 */
	public static function getRow($userid, $type, $token=true)
	{
		$condition = 'accchg_user=%s AND accchg_type=%s' . ($token===true?'':' AND accchg_token=%s');
		$condition = sprintf($condition, quote($userid), quote($type), quote($token));
		return self::table()->select()->where($condition)->exec()->fetchObject();
	}

}
