<?php
namespace GDO\Account\lang;
return [
	'module_account' => 'Accounts',
	'btn_account' => 'Account',
	'link_account_form' => 'Account',
	'link_account_delete' => 'Delete',
	'link_settings' => 'Settings',
	'prune' => 'Prune',
	##########################################################
	'cfg_adult_age' => 'Adult age',
	'tt_cfg_adult_age' => 'Specify what the min age is for adult content.',
	'cfg_account_changetime' => 'Demographic change timeout',
	'cfg_allow_real_name' => 'Allow change of Realname',
	'cfg_allow_guest_settings' => 'Allow guests to change account',
	'cfg_allow_country_change' => 'Allow change of country',
	'cfg_allow_lang_change' => 'Allow change of language',
	'cfg_allow_birthday_change' => 'Allow change of birthdate',
	'cfg_allow_gender_change' => 'Allow change of gender',
	'cfg_allow_email_change' => 'Allow change of email',
	'cfg_feature_account_deletion' => 'Allow account deletion',
	'cfg_feature_demographic_mail_confirm' => 'Enable email confirmation',
	##########################################################
	'box_content_account_settings' => 'Here you find settings for all enabled modules with configuration variables.<br/>Note that we distingush variables which are just informative for you, and settings which you can toggle.',
	'mt_account_settings' => '%s Settings',
	'div_user_settings' => 'Personal %s settings',
	'div_variables' => 'Your %s variables',
	'msg_settings_saved' => 'Your settings for the %s module have been saved.<br/>%s',
	##########################################################
	'mt_account_form' => 'Account',
	'infobox_account_form' => 'Please note that you cannot change your "Realname" after it has been set, and it is <b>visible to anyone!</b><br/>Your demographic options can be set once every %s.',
	'section_login' => 'Login Settings',
	'section_email' => 'E-Mail Settings',
	'section_demographic' => 'Demography',
	'section_options' => 'Options',
	'user_hide_online' => 'Hide your online status',
	'user_want_adult' => 'Show adult content',
	'user_show_birthdays' => 'Show my and other\'s birthday',
	'msg_real_name_now' => 'Your realname is now set to %s.',
	'msg_user_hide_online_on' => 'Your online status is now hidden.',
	'msg_user_show_birthdays_on' => 'You have enabled Birthday announcementa and your own Birthday is shown to others.',
	'msg_user_want_adult_on' => 'You have now enabled adult content for your account.',
	'msg_mail_sent' => 'We have sent you an E-Mail with instructions how to proceed.',
	'msg_demo_changed' => 'Your demographic settings have been changed.',
	'msg_email_fmt_now_html' => 'Your preferred E-Mail format is now set to HTML.',
	'msg_email_fmt_now_text' => 'Your preferred E-Mail format is now set to PLAINTEXT.',
	'err_demo_wait' => 'You have to wait %s before you can change your demographic options again.',
	'email_fmt' =>'E-Mail Format',
	##########################################################
	'mt_account_delete' => 'Delete Account',
	'box_info_deletion' => 'You can choose between disabling your account, and preserving your identity on %s,
Or completely prune your account and all information associated.
If you like, you can leave us a message with feedback on why you wanted to leave.',
	'btn_delete_account' => 'Mark Deleted',
	'btn_prune_account' => 'Prune Account',
	'msg_account_marked_deleted' => 'Your account has been marked as deleted.',
	'msg_account_pruned' => 'Your account has been wiped from the database.',
	##########################################################
	'mt_change_mail' => 'Change E-Mail',
	'err_email_retype' => 'Please recheck your E-Mail, as you did not retype it correctly.',
	'btn_changemail' => 'Change E-Mail',
	##########################################################
	'mail_subj_account_deleted' => '[%s] %s Account Deletion',
	'mail_body_account_deleted' => '
Hello %s,
	
The user %s has just executed the following operation on his account: %s.
	
He has left the following note: (may be empty)
----------------------------------------------
%s
----------------------------------------------
Kind Regards
The %s Script',
##########################################################
	'mail_subj_chmail_a' => '[%s] Change E-Mail',
	'mail_body_chmail_a' => '
Hello %s,
	
You want to change your E-Mail on %s to your new Address: <b>%s</b>.
	
If you want to accept this change, please visit the following link.
	
%s
	
Kind Regards
The %2$s Team',
##########################################################
	'mail_subj_chmail_b' => '[%s] Confirm E-Mail',
	'mail_body_chmail_b' => '
Hello %s,
	
You want to change your E-Mail on %s to this one (%s).
	
If you want to accept the change, please visit the following link.
	
%s
	
Kind Regards,
The %2$s Team.',
##########################################################
	'mail_subj_demochange' => '[%s] Change Demography',
	'mail_body_demochange' => '
Hello %s,
	
You want to change your demographic settings on %s.
Please check if the following settings are correct,
because you can only change them once every %s.
	
Country: %s
Language: %s
Gender: %s
	
If the information is correct, you can accept these settings by visiting this link.
	
%s
	
Otherwise, please ignore this E-Mail and try again anytime.
	
Kind Regards
The %2$s Team',
##########################################################
	'mail_subj_account_alert' => '[%s] Access Alert',
	'mail_body_account_alert' => '
Hello %s,
	
There has been access to your %s account with an unusual configuration.
	
UserAgent: %s
IP Address: %s
Hostname/ISP: %s
	
You can check your access history here.
	
%s
	
You can toggle your access alerts here.
	
%s
	
Kind Regards,
The %2$s Team',
##########################################################
	'table_account_access' => '%s IPs logged for you',
	'confirm_account_prune' => 'Do you really delete your account from the database and all information associated with it? This cannot be undone!',
	'confirm_account_delete' => 'Do you really want to mark your account as deleted? This is not final. An admin could recover your account later.',
	'msg_mail_changed' => 'Your email has been changed to %s.',
	'md_account_access' => 'Review logins for your account.',
	# 6.11.0
	'div_user_textual_settings' => 'Textual settings',
	
	# 7.0.0
	'mt_account_settings' => 'Settings',
	'mt_account_allsettings' => 'All Settings',
	'mt_account_config' => 'Config',
	'msg_settings_saved' => 'Your settings for %s have been changed:<br/>%s',
	
	'btn_save_settings' => 'Save %s settings',

	'info_all_settings' => 'Here you can control your settings for all modules. Almost every setting has ACL visibility options to control what to show in your profile',
];
