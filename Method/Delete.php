<?php
namespace GDO\Account\Method;

use GDO\Account\GDO_AccountDelete;
use GDO\Account\Module_Account;
use GDO\Core\GDT;
use GDO\Core\GDT_Hook;
use GDO\Core\GDT_Response;
use GDO\Date\Time;
use GDO\Form\GDT_AntiCSRF;
use GDO\Form\GDT_Form;
use GDO\Form\MethodForm;
use GDO\Login\Method\Logout;
use GDO\Mail\Mail;
use GDO\UI\GDT_DeleteButton;
use GDO\UI\GDT_Message;
use GDO\User\GDO_User;

/**
 * Delete or prune your account.
 * Send mail to admins with optional note.
 *
 * @version 7.0.2
 * @since 3.0.0
 * @author gizmore
 */
final class Delete extends MethodForm
{

    public function isCLI(): bool { return true; }

    public function isEnabled(): bool { return Module_Account::instance()->cfgFeatureDeletion(); }

	public function getUserType(): ?string { return 'member'; }

	public function isTrivial(): bool
	{
		return false;
	}

	public function onRenderTabs(): void
	{
		Module_Account::instance()->renderAccountBar();
	}

	protected function createForm(GDT_Form $form): void
	{
		$form->text('box_info_deletion', [sitename()]);
		$form->addFields(
			GDT_Message::make('accrm_note'),
			GDT_AntiCSRF::make(),
		);
		$form->actions()->addFields(
			GDT_DeleteButton::make('submit')->label('btn_delete_account')->confirmText('confirm_account_delete'),
		);
		if (Module_Account::instance()->cfgFeaturePurge())
		{
			$form->actions()->addField(
				GDT_DeleteButton::make('prune')->label('btn_prune_account')->
				confirmText('confirm_account_prune')->
				onclick([$this, 'pruneAccount'])
			);
		}
	}

	public function formValidated(GDT_Form $form): GDT
	{
		return $this->deleteAccount(false);
	}

	public function deleteAccount(bool $prune, bool $logout = true)
	{
		$user = GDO_User::current();

		# Store note in database
		if ($note = $this->gdoParameterVar('accrm_note'))
		{
			GDO_AccountDelete::insertNote($user, $note);
		}

		# Send note as email
		$this->onSendEmail($user, $note, $prune);

		if ($prune) # kill
		{
			$user->delete(); # KILL!

			# Report and logout
			$this->message('msg_account_pruned');
		}
		else # Mark deleted
		{
			$user->saveVar('user_deleted', Time::getDate());
			$user->saveVar('user_deletor', GDO_User::current()->getID());

			# Report and logout
			$this->message('msg_account_marked_deleted');
		}

		GDT_Hook::callWithIPC('UserDeleted', $user);

		if ($logout)
		{
			return Logout::make()->execute();
		}

		return GDT_Response::make();
	}

	private function onSendEmail(GDO_User $user, ?string $note, bool $prune)
	{
		foreach (GDO_User::admins() as $admin)
		{
			$sitename = sitename();
			$adminame = $admin->renderUserName();
			$username = $user->renderUserName();
			$operation = $prune ? tusr($admin, 'btn_prune_account') : tusr($admin, 'btn_delete_account');
			$note = $note ? html($note) : '';
			$args = [$adminame, $username, $operation, $note, $sitename];
			$mail = Mail::botMail();
			$mail->setSubject(tusr($admin, 'mail_subj_account_deleted', [$sitename, $username]));
			$mail->setBody(tusr($admin, 'mail_body_account_deleted', $args));
			$mail->sendToUser($admin);
		}
	}

	/**
	 * We do not test this with gizmore user.
	 */
	public function plugUserID(): string
	{
		return '7';
	}

	############
	### Test ###
	############

	/**
	 * Only run one special test here.
	 */
	public function plugVars(): array
	{
		return [
			['accrm_note_input' => 'I give up!'],
			['submit' => '1'],
		];
	}

	public function pruneAccount()
	{
		return $this->deleteAccount(true);
	}

}
